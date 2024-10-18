var link        = window.location.href;
var getseperate = link.split('/');
var folderName  = getseperate[0]+'//'+getseperate[2]+'/'+getseperate[3];

function fieldValidation(){
      var transCode  = $('#transcode').val();
      var seriesCode = $('#series_code').val();
      var glCode     = $('#gl_code').val();
      var vr_type    = $('#vr_type').val();
      var pfctCode   = $('#profitId').val();
      
      if(transCode){
        $('#transcode').css('border-color','#d2d6de');
        if(seriesCode){
          $('#series_code').prop('readonly',false);
          $('#series_code').css('border-color','#d2d6de');
          if(vr_type){
              $('#vr_type').prop('readonly',false);
              $('#vr_type').css('border-color','#d2d6de');
              if(pfctCode){
                $('#profitId').prop('readonly',false);
                $('#profitId').css('border-color','#d2d6de');
              }else{
                $('#profitId').prop('readonly',false);
                $('#profitId').css('border-color','#ff0000').focus();
              }
            }else{
              $('#vr_type').prop('disabled',false);
              $('#vr_type').css('border-color','#ff0000').focus();
            }
        }else{
          $('#series_code').prop('readonly',false);
          $('#series_code').css('border-color','#ff0000').focus();
        }
      }else{
        $('#transcode').css('border-color','#ff0000').focus();
      }

      if(transCode && seriesCode && glCode && vr_type && pfctCode){
        $('#glCodeName1').prop('readonly',false);
        $('#acc_code1').prop('readonly',false);
        $('#costCenter1').prop('readonly',false);
        $('#glCodeName1').css('border-color','#ff0000');
      }else{
        $('#glCodeName1').prop('readonly',true);
        $('#acc_code1').prop('readonly',true);
        $('#costCenter1').prop('readonly',true);
        $('#glCodeName1').css('border-color','#d2d6de');
      }
}

$( window ).on( "load", function() {

    var fromdateintrans = $('#FromDateFy').val();
    var todateintrans = $('#ToDateFy').val();

    $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      startDate :fromdateintrans,
      endDate : todateintrans,
      autoclose: 'true'
    });

   $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'
    });

    fieldValidation();

});

/* ------------------ vr date --------------- */

	$('#vr_date').on('change',function(){
	  var transDate = $('#vr_date').val();
	  var slipD =  transDate.split('-');
	  var Tdate = slipD[0];
	  var Tmonth = slipD[1];
	  var Tyear = slipD[2];
	  var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;
	       // console.log(getproperDate);
	  var selectedDate = new Date(getproperDate);
	  var todayDate = new Date();
	        
	    if(selectedDate > todayDate){
	      $('#showmsgfordate').html('Transaction Date Can Not Be Greater Than Today').css('color','red');
	            $('#vr_date').val('');
	            $('#profitId').prop('disabled',true);
	            $('#hidnvrdte').val('');
	            return false;
	    }else{
	      $('#showmsgfordate').html('');
	      $('#profitId').prop('disabled',false);
	       var vrdate     =  $('#vr_date').val();
	      $('#hidnvrdte').val(vrdate);
	      return true;
	    }
	});

/* ------------------ vr date --------------- */


/* ------------------ series code --------------- */

	$("#series_code").bind('change', function () {
  
	    var seriescode =  $(this).val();
	    var xyz = $('#seriesList option').filter(function() {

	      return this.value == seriescode;

	    }).data('xyz');

    	var msg = xyz ?  xyz : 'No Match';

	    $("[data-toggle=tooltip]").mouseenter(function () {
	        $("#seriesText").attr('title', msg);
	    });    

    	if(msg=='No Match'){
	        $(this).val('');
	        $("#seriesText,#vrseqnum,#gl_code,#gl_name").val('');
	        $('#appndplantbtn').css('display','none');
	        $('#firsticon').css('display','block');
	    }else{
	        $('#gl_code,#gl_name').val('');
	        $('#appndplantbtn').css('display','block');
	        $("#seriesText").val(msg);
	    }

	    fieldValidation();

	});

/* ------------------ series code --------------- */

/* ------------------ vr type --------------- */

	$('#vr_type').on('change',function(){
         
	 	if( $("#vr_type option:selected").val()!=''){

        	var vrType =  $('#vr_type').val();

			if(vrType == 'Payment'){
				$('.discription').val('To -');
				$('#vrTypeData').val(vrType);
				//$('#dr_amount1').prop('readonly',false);
				//$('#cr_amount1').prop('readonly',true);
				// $('.bankshowwhenrecpt:visible').hide();
			}else if(vrType == 'Receipt'){
				$('.discription').val('By -');
				$('#vrTypeData').val(vrType);
				//$('#dr_amount1').prop('readonly',true);
				//$('#cr_amount1').prop('readonly',false);
				// $('.bankshowwhenrecpt:hidden').show();
			}else{

			}

	    }else{
	        	
	    }

	 	fieldValidation();  

	});

/* ------------------ vr type --------------- */

/* ------------------ pfct code --------------- */

	$("#profitId").on('input', function () {  

	    var val = $("#profitId").val();

	    var xyz = $('#profitList option').filter(function(el) {

	      var getVal = el+'-'+this.value;

	      return this.value == val;

	  }).data('xyz');
 
  		var msg = xyz ? xyz : 'No Match';

    	if(msg=='No Match'){  
	      $(this).val('');
	      $('#profit_name').val('');
    	}else{
	      $('#profit_name').val(msg);
    	}
  	fieldValidation();        
});

/* ------------------ pfct code --------------- */

/* ------------------ sale rep. code --------------- */

	$("#sale_rep_code").on('change', function () {  

	  var val = $("#sale_rep_code").val();

	  var xyz = $('#saleRepList option').filter(function(el) {

	    return this.value == val;

	  }).data('xyz');

	  var msg = xyz ? xyz : 'No Match';

	  if(msg=='No Match'){  
	    $('#sale_rep_code').val('');
	    $('#saleRText').html('');

	  }else{
	    $('#saleRText').html(msg);
	  }

	  fieldValidation();
	          
	});

/* ------------------ sale rep. code --------------- */

/* ------------------ gl code (body) --------------- */

	function glcodeNameData(slno){

  		var getVals =  $('#glCodeName'+slno).val();

    	var xyz = $('#glCodeNameList'+slno+' option').filter(function(el) {

	      	var getVal = el+'-'+this.value;

	      	return this.value == getVals;

	    }).data('xyz');

    	var msg = xyz ?  xyz : 'No Match';

    	if(msg=='No Match'){
	      $('#glCodeName'+slno).val('');
	      $('#genrl_name'+slno).val('');
	      $('#acctTag'+slno).val('');
	      $('#costcTag'+slno).val('');
	      $('#dr_amount'+slno).val('');
	      $('#cr_amount'+slno).val('');
	      //$('#dr_amount'+slno+',#cr_amount'+slno).prop('readonly',true);
	      $('#simulation_btn,#submitdata,#submitdatapdf').prop('disabled',true);
	      $('#glCodeName'+slno).css('border-color','red');
    	}else{
        
	      $('#genrl_name'+slno).val(msg);
	      $('#glCodeName'+slno).css('border-color','#d7d3d3');
    	}
    	$('#vr_date,#series_code,#seriesText,#sale_rep_code,#profitId').prop('readonly',true);
    	$('#vr_type').prop('disabled',true);

		var bankGl      = $('#gl_code').val();
		var accountcode = $('#acc_code').val();

	    if(accountcode == bankGl){
	       $('#glCodeName'+slno).val('');
	       $('#genrl_name'+slno).val('');
	    }

    	var glCode = $('#glCodeName'+slno).val();

    	$.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    	});
    	var gltagURL = folderName+'/get-gl-tag-from-gl-master';
    	$.ajax({
	      	type: 'POST',
	      	url: gltagURL,
	      	data: {glCode: glCode},
      		success: function (data) {
        		var data1 = JSON.parse(data);
        		if(data1.response == 'error') {

          			$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        		}else if(data1.response == 'success'){

                  	var accountTag = data1.data_tag[0].ACCOUNT_TAG;
                  	var costCenterTag = data1.data_tag[0].COST_TAG;

                  	var vrType= $('#vr_type').val();
                  	if(vrType == 'Payment'){
                  		$('#dr_amount'+slno).prop('readonly',false);
											$('#cr_amount'+slno).prop('readonly',true);
                  	}else if(vrType == 'Receipt'){
											$('#dr_amount'+slno).prop('readonly',true);
											$('#cr_amount'+slno).prop('readonly',false);
                  	}

                  	/*if((accountTag == 'YES') || (costCenterTag == 'YES')){
	                    $('#dr_amount'+slno).prop('readonly',true);
	                    $('#cr_amount'+slno).prop('readonly',true);
                  	}else{
	                    $('#dr_amount'+slno).prop('readonly',false);
	                    $('#cr_amount'+slno).prop('readonly',false);
                  	}*/

                  	$('#acctTag'+slno).val(accountTag); 
                  	$('#costcTag'+slno).val(costCenterTag); 

                  	/* --- check account tag YES if YES then account code req ----*/

	                  if(accountTag == 'YES'){
	                    var acCode = $('#acc_code'+slno).val();
	                    if(acCode == ''){
	                      $('#acc_code'+slno).css('border-color','red');
	                      //$('#accReqMsg'+slno).html('*');
	                    }else{}
	                    
	                  }else{
	                    $('#acc_code'+slno).css('border-color','#d7d3d3');
	                    //$('#accReqMsg'+slno).html('');
	                    $('#acc_code'+slno).val('');
	                    $('#acc_name'+slno).val('');
	                  }

                  	/* --- check account tag YES if YES then account code req ----*/

                  	/* --- check cost center tag YES if YES then costcenter code req ----*/

	                  if(costCenterTag == 'YES'){
	                    var costCode = $('#costCenter'+slno).val();
	                    if(costCode == ''){
	                      $('#costCenter'+slno).css('border-color','red');
	                      //$('#accReqMsg'+slno).html('*');
	                    }else{}
	                  }else{
	                    $('#costCenter'+slno).css('border-color','#d7d3d3');
	                    //$('#accReqMsg'+slno).html('');
	                    $('#costCenter'+slno).val('');
	                    $('#costCenter_name'+slno).val('');
	                  }

                  	/* --- check cost center tag YES if YES then costcenter code req ----*/
        		}
      		}
    	});

	}

/* ------------------ gl code (body) --------------- */

/* ----- cost center code ------- */
  
  function costCenterCdData(slno){

  var costCode =  $('#costCenter'+slno).val();

    var xyz = $('#costCenterList'+slno+' option').filter(function(el) {

      return this.value == costCode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
      $('#costCenter_name'+slno).val('');
      $('#costCenter'+slno).val('');
    }else{
        
      $('#costCenter_name'+slno).val(msg);
    }

    chekvalOnGl(slno);
}

/* ----- cost center code ------- */

/* -------------- account code ------------------ */
	
	function GetAccountCode(Accid){

		var account_code =  $('#acc_code'+Accid).val();

      	var xyz = $('#AccList'+Accid+' option').filter(function() {
      		return this.value == account_code;
      	}).data('xyz');

      	var msg = xyz ?  xyz : 'No Match';

      	if(msg=='No Match'){

					$('#tdsByAccCode'+Accid).val('');
					$('#GettdsCode'+Accid).val('');
					$('#GettdsName'+Accid).val('');
					$('#acc_code'+Accid).val('');
					$('#acc_name'+Accid).val('');
					$('#dr_amount'+Accid).val('');
					$("#ref"+Accid).prop('readonly',true);
         
      	}else{
      		$('#acc_name'+Accid).val(msg);
        	$("#accbtn"+Accid).prop('disabled',false);
        	$("#ref"+Accid).prop('readonly',false);
      	}

      	chekvalOnGl(Accid);

      	$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      	});

      	var accountcode =  $('#acc_code'+Accid).val();
      	var accountURL = folderName+'/acc-code-for-cash-bank';
      	$.ajax({
      		url:accountURL,
          	method : "POST",
          	type: "JSON",
          	data: {accountcode: accountcode},
          	success:function(data){
          		var data1 = JSON.parse(data);

          		if (data1.response == 'error') {

                	$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

            	}else if(data1.response == 'success'){
            		console.log('data1.data',data1.data_gl);
            		if(data1.data==''){
            			var nottds ='';
            			$('#tdsByAccCode'+Accid).val(nottds);
            		}else{
            			$('#tdsByAccCode'+Accid).val(data1.data[0].TDS_CODE);
            			
            			var glCodechk = $('#glCodeName'+Accid).val();
            			if(glCodechk == ''){
            				$('#glCodeName'+Accid).val(data1.data[0].GL_CODE);
            				$('#genrl_name'+Accid).val(data1.data[0].GL_NAME);
            			}else{
            				$('#glCodeName'+Accid).css('border-color','#d7d3d3');
            			}

            			if(data1.data_gl == ''){

            			}else{
            				$('#glCodeNameList'+Accid).empty();

            				$.each(data1.data_gl, function(k, getData){
                        $("#glCodeNameList"+Accid).append($('<option>',{
                          value:getData.GL_CODE,
                          'data-xyz':getData.GL_NAME,
                          text:getData.GL_NAME+' ['+getData.GL_NAME+']'
                        }));
                    });
            			}

            			var glCodeblnk = $('#glCodeName'+Accid).val();
            			if(glCodeblnk == ''){
            				$('#glCodeName'+Accid).css('border-color','#ff0000');
            			}else{
            				$('#glCodeName'+Accid).css('border-color','#d7d3d3');
            			}
            		}

            		var payType = $('#vr_type').val();

            			if(payType == 'Payment'){
            				$('#drTdsBtn'+Accid).html("<button type='button' class='btn btn-primary btn-xs tdsBtnSty tdsratebtn tdsratebtnHide' id='tds_rate"+Accid+"' data-toggle='modal' data-target='#tds_rate_model"+Accid+"' onclick='CalculateTdsRate("+Accid+")' disabled>Calc TDS</button><div id='appliedbtn"+Accid+"'></div><div id='canclebtn"+Accid+"'></div>");
            			}else if(payType == 'Receipt'){
            				$('#crTdsBtn'+Accid).html("<button type='button' class='btn btn-primary btn-xs tdsBtnSty tdsratebtn tdsratebtnHide' id='tds_rate"+Accid+"' data-toggle='modal' data-target='#tds_rate_model"+Accid+"' onclick='CalculateTdsRate("+Accid+")' disabled>Calc TDS</button><div id='appliedbtn"+Accid+"'></div><div id='canclebtn"+Accid+"'></div>");
            			}

            		var tdsByAccCodeExist = $('#tdsByAccCode'+Accid).val();

            		if(data1.data_tds == ''){
            			 $('#tds_rate'+Accid).addClass('tdsratebtnHide');
            			 $('#resultofdebit'+Accid).val('');
            			 $('#Applytdsonamt'+Accid).val('');
            			 $('#resultofcredit'+Accid).val('');
            			 $('#Applytdsonamtforcr'+Accid).val('');
            			 $('#GettdsCode'+Accid).val('');
            			 $('#GettdsName'+Accid).val('');
            			 $('#appliedbtn'+Accid).html('');
            		}else{

            			$('#tds_rate'+Accid).removeClass('tdsratebtnHide');
            		}

            		showpaymentAdvice(Accid);
            	}
          	}
      	});
	}

/* -------------- account code ------------------ */

/* -------------- account details ------------------ */

	function getAccDetail(accd){

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    var accCode =  $('#acc_code'+accd).val();

    var accDetailURL = folderName+'/get-acc-data-by-acc-code-cash-bank';

    $.ajax({

          url:accDetailURL,

          method : "POST",

          type: "JSON",

          data: {accCode: accCode},

          success:function(data){

            var data1 = JSON.parse(data);
              
            if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                      
            }else if(data1.response == 'success'){

                if(data1.data==''){

                }else{
                  $('#accNameCodeshow'+accd).html(data1.data[0].ACC_CODE);
                  $('#AcctypCde'+accd).html(data1.data[0].ATYPE_CODE);
                  $('#Addres1show'+accd).html(data1.data[0].ADD1);
                  $('#Addres3show'+accd).html(data1.data[0].ADD3);
                  $('#cityacshow'+accd).html(data1.data[0].CITY_CODE);
                  $('#stateacshow'+accd).html(data1.data[0].STATE_CODE);
                  $('#emailacshow'+accd).html(data1.data[0].EMAIL_ID);
                  $('#phonenoacshow'+accd).html(data1.data[0].CONTACT_NO);
                }

            }
          }
    });

	}

/* -------------- account details ------------------ */

function chekvalOnGl(srNo){
    var acctTag  = $('#acctTag'+srNo).val();
    var costCTag = $('#costcTag'+srNo).val();

    if((costCTag == 'YES') && (acctTag == 'YES')){
      var costCode = $('#costCenter'+srNo).val();
      var accCode  = $('#acc_code'+srNo).val();
   
        if(costCode && accCode){
          /*$('#dr_amount'+srNo).prop('readonly',false);
          $('#cr_amount'+srNo).prop('readonly',false);*/
          $('#submitdata,#submitdatapdf,#simulation_btn').prop('disabled',false);
          $('#costCenter'+srNo).css('border-color','#d7d3d3');
          $('#acc_code'+srNo).css('border-color','#d7d3d3');
        }else{
          /*$('#dr_amount'+srNo).prop('readonly',true);
          $('#cr_amount'+srNo).prop('readonly',true);*/
          $('#submitdata,#submitdatapdf,#simulation_btn').prop('disabled',true);
          $('#costCenter'+srNo).css('border-color','#ff0000');
          $('#acc_code'+srNo).css('border-color','#ff0000');
        }

    }else if((costCTag == 'YES') && (acctTag == 'NO')){
      var costCodeC = $('#costCenter'+srNo).val();
      if(costCodeC){
        /*$('#dr_amount'+srNo).prop('readonly',false);
        $('#cr_amount'+srNo).prop('readonly',false);*/
        $('#submitdata,#submitdatapdf,#simulation_btn').prop('disabled',false);
        $('#costCenter'+srNo).css('border-color','#d7d3d3');
      }else{
        /*$('#dr_amount'+srNo).prop('readonly',true);
        $('#cr_amount'+srNo).prop('readonly',true);*/
        $('#submitdata,#submitdatapdf,#simulation_btn').prop('disabled',true);
        $('#costCenter'+srNo).css('border-color','#ff0000');
      }
    }else if((costCTag == 'NO') && (acctTag == 'YES')){
      var accCodeC = $('#acc_code'+srNo).val();
      if(accCodeC){
        /*$('#dr_amount'+srNo).prop('readonly',false);
        $('#cr_amount'+srNo).prop('readonly',false);*/
        $('#submitdata,#submitdatapdf,#simulation_btn').prop('disabled',false);
        $('#acc_code'+srNo).css('border-color','#d7d3d3');
      }else{
        /*$('#dr_amount'+srNo).prop('readonly',true);
        $('#cr_amount'+srNo).prop('readonly',true);*/
        $('#submitdata,#submitdatapdf,#simulation_btn').prop('disabled',true);
        $('#acc_code'+srNo).css('border-color','#ff0000');
      }
    }else{
      /*$('#dr_amount'+srNo).prop('readonly',false);
      $('#cr_amount'+srNo).prop('readonly',false);*/
      $('#submitdata,#submitdatapdf,#simulation_btn').prop('disabled',false);
      $('#costCenter'+srNo).css('border-color','#d7d3d3');
      $('#acc_code'+srNo).css('border-color','#d7d3d3');
    }

}

/* ---------------- debit amount ------------------- */
	
	function GetDebitAmount(debitid){

				$('#resultofdebit'+debitid).val('');
				$('#Applytdsonamt'+debitid).val('');
				$('#acctdsRate'+debitid).val('');
				$('#GettdsCode'+debitid).val('');
				$('#GettdsName'+debitid).val('');
				$('#appliedbtn'+debitid).html('');
				$('#canclebtn'+debitid).html('');

      	var sum = 0;

      	$(".dr_amount").each(function () {

	        //add only if the value is number
	        if (!isNaN(this.value) && this.value.length != 0) {
	            sum += parseFloat(this.value);
	          //  console.log('thi.val',this.value);
	             //DrFirstAmount(sum);
	        }
     
	      	$("#totldramt").val(sum.toFixed(2));

	      	if (!isNaN(this.value) && this.value.length != 0) {
		        /*$('#cr_amount'+debitid).prop('readonly',true);*/
		        $('#tds_rate'+debitid).prop('disabled',false);
		        $('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',false);
	      	}else{
	          	/*$('#cr_amount'+debitid).prop('readonly',false);*/
	          	$('#tds_rate'+debitid).prop('disabled',true);
	          	$('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',true);
	      	}   

	      	var drAmount = this.value;

	      	$('#WhenTdsCutDebit'+debitid).val(drAmount);

    	});

     	var paymode        = $("#vr_type").val();

     	var totalval       = parseFloat($("#totldramt").val());
     	var totalvalcredit = parseFloat($("#totlcramt").val());
    
      	if((totalvalcredit > 0.00) && (totalval > 0.00)){

	        if(paymode == 'Payment'){
	          	$('#billTkCr'+debitid).html('');
	          	$('#billTkDr'+debitid).html('<button type="button" class="btn btn-primary btn-xs viewBilTrak" id="ViewBillTrack'+debitid+'" data-toggle="modal" data-target="#ViewBT_Detail'+debitid+'" onclick="detailBillTrack('+debitid+')">Bill Track </button><div id="AplyIconBT'+debitid+'" style="padding-top: 5px;">');
	       
	          	if(totalvalcredit > totalval){
	            	$('#showgreatermsg').html('Credit-CR Can Not Be Greater Than Debit-DR For Payment');
	            	$('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',true);
	          	}else{
	             	$('#showgreatermsg').html('');
	              	$('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',false);
	          	}
	        }else if(paymode == 'Receipt'){
	          	//$('#billTkCr'+debitid).html('');
	          	//$('#billTkDr'+debitid).html('<button type="button" class="btn btn-primary btn-xs viewBilTrak" id="ViewBillTrack'+debitid+'" data-toggle="modal" data-target="#ViewBT_Detail'+debitid+'" onclick="detailBillTrack('+debitid+')">Bill Track </button><div id="AplyIconBT'+debitid+'" style="padding-top: 5px;">');
	          	if(totalvalcredit < totalval){
	            	$('#showgreatermsg').html('Debit-DR Can Not Be Greater Than Credit-CR For Receipt');
	            	$('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',true);
	          	}else{
	            	$('#showgreatermsg').html('');
	            	$('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',false);
	          	}
	        
	        }
      	}else{
      	}
        
  	}

/* ---------------- debit amount ------------------- */

/* ---------------- credit amount ------------------- */

  	function GetCreditAmount(creditid){

  		$('#resultofcredit'+creditid).val('');
			$('#Applytdsonamtforcr'+creditid).val('');
				$('#acctdsRate'+creditid).val('');
				$('#GettdsCode'+creditid).val('');
				$('#GettdsName'+creditid).val('');
			$('#appliedbtn'+creditid).html('');
			$('#canclebtn'+creditid).html('');



       	var sum = 0;

  		$(".cr_amount").each(function () {

	        if (!isNaN(this.value) && this.value.length != 0) {
	            sum += parseFloat(this.value);
	        }

	      	$("#totlcramt").val(sum.toFixed(2));

	      	if (!isNaN(this.value) && this.value.length != 0) {
	       
	         	/*$('#dr_amount'+creditid).prop('readonly',true);*/
	          	$('#tds_rate'+creditid).prop('disabled',false);
	          	$('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',false);
	          	
	      	}else{
	          	/*$('#dr_amount'+creditid).prop('readonly',false);*/
	           	$('#tds_rate'+creditid).prop('disabled',true);
	           	$('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',true);
	      	}

	      	var crAmount = this.value;

	    	$('#WhenTdsCutCredit'+creditid).val(crAmount);

    	});

      	var paymode = $("#vr_type").val();

      	var totalval = parseFloat($("#totldramt").val());
      	var totalvalcredit = parseFloat($("#totlcramt").val());

      	if((totalvalcredit > 0.00) && (totalval > 0.00)){

        	if(paymode == 'Payment'){
            	if(totalvalcredit > totalval){
	              $('#showgreatermsg').html('Credit-CR Can Not Be Greater Than Debit-DR For Payment');
	              $('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',true);
            	}else{
	              $('#showgreatermsg').html('');
	              $('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',false);
            	}
          	}else if(paymode == 'Receipt'){
	            $('#billTkDr'+creditid).html('');
	            $('#billTkCr'+creditid).html('<button type="button" class="btn btn-primary btn-xs viewBilTrak" id="ViewBillTrack'+creditid+'" data-toggle="modal" data-target="#ViewBT_Detail'+creditid+'" onclick="detailBillTrack('+creditid+')">Bill Track </button><div id="AplyIconBT'+creditid+'" style="padding-top: 5px;">');
            
       	 		if(totalvalcredit < totalval){
	              $('#showgreatermsg').html('Debit-DR Can Not Be Greater Than Credit-CR For Receipt');
	              $('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',true);
            	}else{
	              $('#showgreatermsg').html('');
	              $('#submitdata,#submitdatapdf,#deletehidn,#addmorhidn,#simulation_btn').prop('disabled',false);
          		}
          
        	}
      	}

	}

/* ---------------- credit amount ------------------- */

/* ---------------- when click on cal tds button ------------- */

	function CalculateTdsRate(TdsId){   
   
      	$.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      	});

		var tdsCode    = $('#tdsByAccCode'+TdsId).val();
		var acCode     = $('#acc_code'+TdsId).val();
		var tdsDataURL = folderName+'/tds-rate-calculate';
      	$.ajax({

            url:tdsDataURL,

            method : "POST",

            type: "JSON",

            data: {tdsCode: tdsCode,acCode:acCode},

            success:function(data){

              var data1 = JSON.parse(data);
                                   
              if (data1.response == 'error') {

                  $('#tds_rate_model'+TdsId).modal('toggle'); 

                  $('#tds_rate'+TdsId).prop('disabled',true);

                  $('#appliedbtn'+TdsId).html('<small class="label label-danger">TDS Not Found...!</small></div>');                      

              }else if(data1.response == 'success'){

                  $('#tds_name'+TdsId).val(data1.tds_name[0].TDS_CODE+' - '+data1.tds_name[0].TDS_NAME);
                  $('#tdsRate'+TdsId).val(data1.data[0].TDS_RATE);
                  //$('#TdsRateByAccCode'+TdsId).val(data1.data[0].TDS_RATE);
                  var dr_amt = parseFloat($('#dr_amount'+TdsId).val());
                  var cr_amount = parseFloat($('#cr_amount'+TdsId).val());

                  if(dr_amt){
                  	var amount = dr_amt;
                  }else if(cr_amount){
                  	var amount = cr_amount;
                  }

                  $('#tds_base_Amt'+TdsId).val(amount);
        		  $('#Net_amount'+TdsId).val(amount);
                  
                  var tdsRateval = parseFloat($('#tdsRate'+TdsId).val());
                  var tdsbaseamtval = parseFloat($('#tds_base_Amt'+TdsId).val());

                  var calculatPercnt = tdsbaseamtval / 100 * tdsRateval;

                  $('#tds_Amt_cal'+TdsId).val(calculatPercnt.toFixed(2));
                  var deductBAmtWTdsAmt = tdsbaseamtval - parseFloat(calculatPercnt);
                  $('#deduct_tds_Amt'+TdsId).val(deductBAmtWTdsAmt.toFixed(2));
                  
              }
            }

      });  
	}

/* ---------------- when click on cal tds button ------------- */

/* ---------------- when click on apply tds button ------------- */

	function Applytds(aplytdsval){

		var NetAmount      = $('#Net_amount'+aplytdsval).val();
		var TdsRate        = $('#tdsRate'+aplytdsval).val();
		var DebitAmt       = $('#dr_amount'+aplytdsval).val();
		var CreditAmt      = $('#cr_amount'+aplytdsval).val();
		var deduct_tds_Amt = $('#deduct_tds_Amt'+aplytdsval).val();
	   
	    var calculateResult =  parseFloat(NetAmount) / 100 * parseFloat(TdsRate);

    	if(DebitAmt){
			if(calculateResult){
				$('#resultofdebit'+aplytdsval).val(calculateResult.toFixed(2));
				$('#Applytdsonamt'+aplytdsval).val(deduct_tds_Amt);
			}else{
				$('#resultofdebit'+aplytdsval).val(0);
			 	$('#Applytdsonamt'+aplytdsval).val(0);
			}

      		var getdrCAmt = DebitAmt;
    	}else{
	      if(calculateResult){
	        $('#resultofcredit'+aplytdsval).val(calculateResult.toFixed(2));
	        $('#Applytdsonamtforcr'+aplytdsval).val(deduct_tds_Amt);
	      }else{
	        $('#resultofcredit'+aplytdsval).val(0);
	         $('#Applytdsonamtforcr'+aplytdsval).val(0);
	      }

      		var getdrCAmt =CreditAmt;
    	}

    	$('#acctdsRate'+aplytdsval).val(TdsRate);

	    $('#appliedbtn'+aplytdsval).html('<small class="label label-success iconBtnSty"><i class="fa fa-check"></i></small></div>');
	    $('#canclebtn'+aplytdsval).html('');

    	//var cutamtfrmamt = getdrCAmt -  BaseAmountT;
 
    	//$('#ledgrAmt'+aplytdsval).val(cutamtfrmamt.toFixed(2));
  
	    $.ajaxSetup({
	            headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	            }
	    });

    	var tdssectionC = $('#tdsByAccCode'+aplytdsval).val();
    	var glCodeOfTds = folderName+'/get-tds-name-n-code';
    	$.ajax({

          	url:glCodeOfTds,
          	method : "POST",
          	type: "JSON",
          	data: {tdssectionC: tdssectionC},
          	success:function(data){

            	var data1 = JSON.parse(data);
       
            	if (data1.response == 'error') {

	                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
	            }else if(data1.response == 'success'){

	                if(data1.data==''){
	                  var tdsNAme = '';
	                  var tdsCode = '';
	                  $('#GettdsName'+aplytdsval).val(tdsNAme);
	                  $('#GettdsCode'+aplytdsval).val(tdsCode);
	                }else{
	                  $('#GettdsName'+aplytdsval).val(data1.data.GL_NAME);
	                  $('#GettdsCode'+aplytdsval).val(data1.data.GL_CODE);
	                }  
            	}
          	}

    	});
 
	}

/* ---------------- when click on apply tds button ------------- */

/* -------------- cancle tds ------------------- */

	function cancleBtntds(canclbtn){
	  $('#appliedbtn'+canclbtn).html('');
	  $('#resultofdebit'+canclbtn).val('');
	  $('#Applytdsonamt'+canclbtn).val('');
	  $('#resultofcredit'+canclbtn).val('');
	  $('#acctdsRate'+canclbtn).val('');
	  $('#Applytdsonamtforcr'+canclbtn).val('');
	  $('#GettdsCode'+canclbtn).val('');
	  $('#GettdsName'+canclbtn).val('');
	  $('#canclebtn'+canclbtn).html('<small class="label label-danger iconBtnSty"><i class="fa fa-times"></i></small>');
	}

/* -------------- cancle tds ------------------- */

/* ---------------- show cheque date ------------- */

	function changedate(datevalue){

    	/*var insttype = $("#inst_type"+datevalue).val();

	    if(insttype=='CH'){
	    	$('#cheque_no'+datevalue).prop('readonly',false);
	      $("#showdate"+datevalue).removeClass('datehide');

	    }else{
	    	$('#cheque_no'+datevalue).prop('readonly',true);
	      $("#showdate"+datevalue).addClass('datehide')
	    }*/

			var insttype = $("#inst_type1").val();

	    if(insttype=='CH'){
	    	$('#cheque_no1').prop('readonly',false);
	      $("#showdate1").removeClass('datehide');
	    }else{
	    	$('#cheque_no1').prop('readonly',true);
	      $("#showdate1").addClass('datehide')
	      $('#cheque_no1').val('');
	    }

  	}

/* ---------------- show cheque date ------------- */

/* ---------------- oncheck no ------------- */

  	function getdicbypay(slno){

  		var cheQno =  $('#cheque_no'+slno).val();

      var xyz = $('#chequeNoList'+slno+' option').filter(function() {

          return this.value == cheQno;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      if(msg == 'No Match'){
      	$('#cheque_no'+slno).val('');

      	var getnewdis = $('#discription'+slno).val();
		    var res = getnewdis.split(":");
      	$('#discription'+slno).val(res[0]);
      }else{

      	var getval =  $('#discription'+slno).val();
		    var checkno = $('#cheque_no'+slno).val();
		    var fordiscriptnbl = getval+' '+checkno;
		    
		    var getnewdis = $('#discription'+slno).val();
		    var res = getnewdis.split(":");

		    if(res[1] == ''){
		      $('#discription'+slno).val(fordiscriptnbl);
		    }else if(res[1] == checkno){

		     }else{
		         $('#discription'+slno).val('');
		         var checkno11 = $('#cheque_no'+slno).val();
		         var getpre = getval;
		         var res1 = getpre.split(":");
		         var discrptn = res1[0]+': '+checkno11;
		         $('#discription'+slno).val(discrptn);   
		     }

      }

	    
	    
	}

/* ---------------- oncheck no ------------- */

/* ---------------- simulation  ------------- */

	function simulationcal(){

	    $.ajaxSetup({
	          headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	          }
	    });
	    var dramount     =[];
	    var acc_code     =[];
	    var glCode       =[];
	    var cramount     =[];
	    var reftext      =[];
	    var perticulr    =[];
	    var tdsDebitAmt  =[];
	    var tdsCutDrAmt  =[];
	    var tdsCreditAmt =[];
	    var tdscutCrAmt  =[];
	    var tdsGlName    =[];
	    var acc_Name     =[];
	    var glTDS        =[];
	    $('input[name^="dr_amount"]').each(function (){
	          dramount.push($(this).val());
	    });

	    $('input[name^="cr_amount"]').each(function (){
	          cramount.push($(this).val());
	    });

	    $('input[name^="acc_code"]').each(function (){
	          acc_code.push($(this).val());
	    });

	    $('input[name^="glCodeName"]').each(function (){
	          glCode.push($(this).val());
	    });

	    $('input[name^="particular"]').each(function (){
	          perticulr.push($(this).val());
	    });

	    $('input[name^="ref_text"]').each(function (){
	          reftext.push($(this).val());
	    });

	    $('input[name^="TdsDebitAmount"]').each(function (){
	          tdsDebitAmt.push($(this).val());
	    });

	    $('input[name^="DebitdsAmt"]').each(function (){
	          tdsCutDrAmt.push($(this).val());
	    });

	    $('input[name^="TdsCreditAmount"]').each(function (){
	          tdsCreditAmt.push($(this).val());
	    });

	    $('input[name^="CredittdsAmt"]').each(function (){
	          tdscutCrAmt.push($(this).val());
	    });

	    $('input[name^="gltdscode"]').each(function (){
	          glTDS.push($(this).val());
	    });

	    $('input[name^="gltdsname"]').each(function (){
	          tdsGlName.push($(this).val());
	    });

	    $('input[name^="acc_name"]').each(function (){
	          acc_Name.push($(this).val());
	    });

    	var bankGl = $('#gl_code').val();
    
    	var pAdataUrl = folderName+'/get-data-for-cash-bank-simulation';
    	$.ajax({
	        url:pAdataUrl,
	        method : "POST",
	        type: "JSON",
	        data: {dramount: dramount,cramount:cramount,acc_code:acc_code,glCode:glCode,bankGl:bankGl,perticulr:perticulr,tdsDebitAmt:tdsDebitAmt,tdsCutDrAmt:tdsCutDrAmt,glTDS:glTDS,tdsCreditAmt:tdsCreditAmt,tdscutCrAmt:tdscutCrAmt,tdsGlName:tdsGlName,acc_Name:acc_Name},

        	success:function(data){
          	var data1 = JSON.parse(data);

      			if (data1.response == 'error') {

	            	$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          		}else if(data1.response == 'success'){

              		if(data1.data_sim==''){

              		}else{

                		$('#siml_body').empty();

                		var headData = "<div class='box-row' style='background-color: blanchedalmond;'><div class='box10 texIndbox'>Sr.No.</div><div class='box10 glCodeCl'>Gl Code</div><div class='box10 rateIndbox'>Gl Name</div><div class='box10 rateIndbox'>Perticular</div><div class='box10 rateIndbox'>Debit-DR</div><div class='box10 rateIndbox'>Credit-CR</div><div class='box10 glCodeCl' style='line-height: 1;'>Account Code</div><div class='box10 rateIndbox' style='line-height: 1;'>Account Name</div></div>";
                		$('#siml_body').append(headData);

                		var sr_no =1;
                		$.each(data1.data_sim,function(key,value){

		                  	var accCd = value.IND_ACC_CODE;
		                  	if(accCd){
		                    	var acc_Code = accCd;
		                  	}else{
	                   	 		var acc_Code = '--';
		                  	}

		                  	var accName = value.accName;
		                  	if(accName){
		                    	var acc_name = accName;
		                  	}else{
		                    	var acc_name = '--';
		                  	}

                  			var bodyData = "<div class='box-row'><div class='box10 texIndbox'>"+sr_no+"</div><div class='box10 glCodeCl'>"+value.IND_GL_CODE+"</div><div class='box10 nameIndbox' style='white-space: nowrap;'>"+value.glName+"</div><div class='box10 nameIndbox' style='white-space: nowrap;'>"+value.PERTICULAR+"</div><div class='box10 crdrInput'>"+value.DR_AMT+"</div><div class='box10 crdrInput'>"+value.CR_AMT+"</div><div class='box10 glCodeCl'>"+acc_Code+"</div><div class='box10 nameIndbox' style='white-space: nowrap;'>"+acc_name+"</div></div>";
                  			$('#siml_body').append(bodyData);

                  			sr_no++;
                		});
              		}
          		}

        	}
    	});
	}

/* ---------------- simulation  ------------- */


/* ---------------- only for enter number ----------- */
  function NumberCredit(){
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
  }
/* ------------- only for enter number -------------- */