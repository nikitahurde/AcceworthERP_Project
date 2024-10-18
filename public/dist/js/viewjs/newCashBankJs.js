var link        = window.location.href;
var getseperate = link.split('/');
var folderName  = getseperate[0]+'//'+getseperate[2]+'/'+getseperate[3];

$( window ).on( "load", function() {
	fieldValidation();
});

	function fieldValidation(){

		var tranCode   = $('#transcode').val();
		var seriesCode = $('#series_code').val();	
		var glCode     = $('#gl_code').val();	
		var vrType     = $('#vr_type').val();	
		var pfctCode   = $('#profitId').val();	

		if(tranCode){
        	$('#transcode').css('border-color','#d2d6de');
	        if(seriesCode){
	           $('#series_code').prop('readonly',false);
	           $('#series_code').css('border-color','#d2d6de');
	           if(vrType){
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

      	if(tranCode && seriesCode && glCode && vrType && pfctCode){
	        $('#glCodeName1,#acc_code1').prop('readonly',false);
	        $('#glCodeName1').css('border-color','#ff0000');
      	}else{
	        $('#glCodeName1,#acc_code1').prop('readonly',true);
	        $('#glCodeName1').css('border-color','#d2d6de');
      	}

	}

/* ------------ SERIES -------------- */
	
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
	        $("#seriesText").val('');
	        $('#gl_code,#gl_name').val('');
	        $('#firsticon').css('display','block');
    	}else{
	        $('#gl_code,#gl_name').val('');
	        $("#seriesText").val(msg);
    	}

    	fieldValidation();

	});

/* ------------ SERIES -------------- */


/* --------------  GET GL DETAILS --------------*/
	
	function getgldata(){

	   	$.ajaxSetup({

	            headers: {

	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

	            }

	    });

    	var series_code =  $('#series_code').val();

    	var glDataURL = folderName+'/gl_code_by_series_code';

    	$.ajax({

            url:glDataURL,

            method : "POST",

            type: "JSON",

            data: {series_code: series_code},

            success:function(data){

                var data1 = JSON.parse(data);
                    
                if (data1.response == 'error') {

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                          
                }else if(data1.response == 'success'){

                    if(data1.gl_data==''){

                    }else{
                      $('#glDetailsData').empty();
                      var headData ='<div class="box-row"><div class="box10 texIndbox1">GLSCH Code</div><div class="box10 rateIndbox">GL Code</div><div class="box10 rateIndbox">GL Name</div><div class="box10 rateBox">GL Type</div></div><div class="box-row"><div class="box10 itmdetlheading">'+data1.gl_data.GLSCH_CODE+'</div><div class="box10 itmdetlheading">'+data1.gl_data.GL_CODE+' </div><div class="box10 itmdetlheading">'+data1.gl_data.GL_NAME+'</div><div class="box10 itmdetlheading">'+data1.gl_data.GLSCH_TYPE+'</div></div>';
                        $('#glDetailsData').append(headData);
                    }

                }
            }
    	});

  	}

/* --------------  GET GL DETAILS --------------*/

/* --------------  VR TYPE --------------*/
	
	$('#vr_type').on('change',function(){
         
	    if( $("#vr_type option:selected").val()!=''){

	        var vrType =  $('#vr_type').val();

	         if(vrType == 'Payment'){
	          $('.discription').val('To -');
	         }else if(vrType == 'Receipt'){
	          $('.discription').val('By -');
	         }else{

	         }

	         $('#hidnvrtyp').val(vrType);

	    }else{
	        $('#hidnvrtyp').val('');
	    }

  		fieldValidation();  

	});

/* --------------  VR TYPE --------------*/

/* --------------  PFCT --------------*/
	
	$("#profitId").on('input', function () {  

    	var val = $("#profitId").val();

	    var xyz = $('#profitList option').filter(function(el) {

	      	var getVal = el+'-'+this.value;

	      	return this.value == val;

	  	}).data('xyz');
 
  		var msg = xyz ? xyz : 'No Match';

    	if(msg=='No Match'){  
			$(this).val('');
			$('#hidnpfitid').val('');
			$('#hidngpfitnme').val('');
			$('#profit_name').val('');

    	}else{

			var profitId   =  $('#profitId').val();
			var profitname =  $('#profit_name').val();

			$('#profit_name').val(msg);
			$('#hidnpfitid').val(profitId);
			$('#hidngpfitnme').val(msg);
        
    	}
  		fieldValidation();        
	});

/* --------------  PFCT --------------*/

/* --------------  CHECK AUTOPOSTING ON GL --------------*/

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
			$('#dr_amount1,#cr_amount1').prop('readonly',true);
			$('#glCodeName'+slno).css('border-color','red');
    	}else{
			$('#genrl_name'+slno).val(msg);
			$('#glCodeName'+slno).css('border-color','#d7d3d3');
    	}

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

          			/* --- check account tag YES if YES then account code req ----*/

                  	var accountTag = data1.data_tag[0].ACCOUNT_TAG;
                  	$('#acctTag'+slno).val(accountTag); 
                  	if(accountTag == 'YES'){
                    	var acCode = $('#acc_code'+slno).val();
                    	if(acCode == ''){
							$('#acc_code'+slno).css('border-color','red');
							$('#accReqMsg'+slno).html('*');
							$('#dr_amount'+slno).prop('readonly',true);
							$('#cr_amount'+slno).prop('readonly',true);
							$('#submitdata').prop('disabled',true);
							$('#submitdatapdf').prop('disabled',true);
							$('#deletehidn').prop('disabled',true);
							$('#addmorhidn').prop('disabled',true);
							$('#simulation_btn').prop('disabled',true);
                    	}else{}
                    
                  	}else{
                    	$('#acc_code'+slno).css('border-color','#d7d3d3');
                    	$('#accReqMsg'+slno).html('');
                    	$('#acc_code'+slno).val('');
                    	$('#acc_name'+slno).val('');
                    	$('#dr_amount'+slno).prop('readonly',false);
                    	$('#cr_amount'+slno).prop('readonly',false);
                    
                  	}

                	/* --- check account tag YES if YES then account code req ----*/

        		}
      		}
    	});

	}

/* --------------  CHECK AUTOPOSTING ON GL --------------*/

/* --------------  DEBIT AMOUNT --------------*/
	
	function GetDebitAmount(debitid){

      	var sum = 0;

      	$(".dr_amount").each(function () {

	        //add only if the value is number
	        if (!isNaN(this.value) && this.value.length != 0) {
	            sum += parseFloat(this.value);
	          //  console.log('thi.val',this.value);
	             //DrFirstAmount(sum);
	        }
	     
	      	$("#totldramt").val(sum.toFixed(2));

	      	if(!isNaN(this.value) && this.value.length != 0) {

	         	$('#cr_amount'+debitid).prop('readonly',true);
	         	$('#tds_rate'+debitid).prop('disabled',false);
	         	$('#submitdata').prop('disabled',false);
	          	$('#submitdatapdf').prop('disabled',false);
	 	 		$('#deletehidn').prop('disabled',false);
	          	$('#addmorhidn').prop('disabled',false);
	          	$('#simulation_btn').prop('disabled',false);
	     	}else{

	          	$('#cr_amount'+debitid).prop('readonly',false);
	          	$('#tds_rate'+debitid).prop('disabled',true);
	          	$('#submitdata').prop('disabled',true);
	            $('#submitdatapdf').prop('disabled',true);
	            $('#deletehidn').prop('disabled',true);
	            $('#addmorhidn').prop('disabled',true);
	           	$('#simulation_btn').prop('disabled',true);
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
	            $('#submitdata').prop('disabled',true);
	            $('#submitdatapdf').prop('disabled',true);
	            $('#deletehidn').prop('disabled',true);
	            $('#addmorhidn').prop('disabled',true);
	           $('#simulation_btn').prop('disabled',true);

	          }else{
	             $('#showgreatermsg').html('');
	              $('#submitdata').prop('disabled',false);
	              $('#submitdatapdf').prop('disabled',false);
	              $('#deletehidn').prop('disabled',false);
	              $('#addmorhidn').prop('disabled',false);
	              $('#simulation_btn').prop('disabled',false);
	          }
        	}else if(paymode == 'Receipt'){
	          //$('#billTkCr'+debitid).html('');
	          //$('#billTkDr'+debitid).html('<button type="button" class="btn btn-primary btn-xs viewBilTrak" id="ViewBillTrack'+debitid+'" data-toggle="modal" data-target="#ViewBT_Detail'+debitid+'" onclick="detailBillTrack('+debitid+')">Bill Track </button><div id="AplyIconBT'+debitid+'" style="padding-top: 5px;">');
	          if(totalvalcredit < totalval){
	            $('#showgreatermsg').html('Debit-DR Can Not Be Greater Than Credit-CR For Receipt');
	            $('#submitdata').prop('disabled',true);
	            $('#submitdatapdf').prop('disabled',true);
	            $('#deletehidn').prop('disabled',true);
	            $('#addmorhidn').prop('disabled',true);
	            $('#simulation_btn').prop('disabled',true);
	          }else{
	             $('#showgreatermsg').html('');
	             $('#submitdata').prop('disabled',false);
	             $('#submitdatapdf').prop('disabled',false);
	             $('#deletehidn').prop('disabled',false);
	              $('#addmorhidn').prop('disabled',false);
	              $('#simulation_btn').prop('disabled',false);
	          }
        
        	}
      	}else{
      	}
        
  	}

/* --------------  DEBIT AMOUNT --------------*/

/* --------------  CREDIT AMOUNT --------------*/
	
	function GetCreditAmount(creditid){

       var sum = 0;

      	$(".cr_amount").each(function () {

        	//add only if the value is number
        	if (!isNaN(this.value) && this.value.length != 0) {
            	sum += parseFloat(this.value);
        	}

      		$("#totlcramt").val(sum.toFixed(2));

      		if (!isNaN(this.value) && this.value.length != 0) {
       			//  $('#dr_amount').prop('disabled',true);
         		$('#dr_amount'+creditid).prop('readonly',true);
          		$('#tds_rate'+creditid).prop('disabled',false);
          		$('#submitdata').prop('disabled',false);
          		$('#submitdatapdf').prop('disabled',false);
          		$('#deletehidn').prop('disabled',false);
          		$('#addmorhidn').prop('disabled',false);
          		$('#simulation_btn').prop('disabled',false);
  			}else{
        		//  $('#dr_amount').prop('disabled',false);
          		$('#dr_amount'+creditid).prop('readonly',false);
           		$('#tds_rate'+creditid).prop('disabled',true);
           		$('#submitdata').prop('disabled',true);
          		$('#submitdatapdf').prop('disabled',true);
          		$('#deletehidn').prop('disabled',true);
          		$('#addmorhidn').prop('disabled',true);
          		$('#simulation_btn').prop('disabled',true);
      		}

      		var crAmount = this.value;

        	$('#WhenTdsCutCredit'+creditid).val(crAmount);

      		var accnamecr = $('#acc_name'+creditid).val();
       		var gettdsratecodeCR = $('#accNtdsrate'+creditid).val();
    	});

      	var paymode = $("#vr_type").val();

      	var totalval = parseFloat($("#totldramt").val());
      	var totalvalcredit = parseFloat($("#totlcramt").val());

      	var DrAmounts = $('#dr_amount'+creditid).val();
      	var ProfitCenter = $('#profitId').val();
      	var seriesCode = $('#series_code').val();
      	var bankName = $('#bankid').val();
      	var vrDate = $('#vr_date').val();
      	var ProfitCenter = $('#profitId').val();

      	if((totalvalcredit > 0.00) && (totalval > 0.00)){

        	if(paymode == 'Payment'){
	            if(totalvalcredit > totalval){
	              	$('#showgreatermsg').html('Credit-CR Can Not Be Greater Than Debit-DR For Payment');
	              	$('#submitdata').prop('disabled',true);
	              	$('#submitdatapdf').prop('disabled',true);
	              	$('#deletehidn').prop('disabled',true);
	              	$('#addmorhidn').prop('disabled',true);
	             	$('#simulation_btn').prop('disabled',true);
	            }else{

	              	$('#showgreatermsg').html('');
	              	$('#submitdata').prop('disabled',false);
	              	$('#submitdatapdf').prop('disabled',false);
	              	$('#deletehidn').prop('disabled',false);
	              	$('#addmorhidn').prop('disabled',false);
	             	$('#simulation_btn').prop('disabled',false);
	            }
          	}else if(paymode == 'Receipt'){
            	('#billTkDr'+creditid).html('');
            	$('#billTkCr'+creditid).html('<button type="button" class="btn btn-primary btn-xs viewBilTrak" id="ViewBillTrack'+creditid+'" data-toggle="modal" data-target="#ViewBT_Detail'+creditid+'" onclick="detailBillTrack('+creditid+')">Bill Track </button><div id="AplyIconBT'+creditid+'" style="padding-top: 5px;">');
            
	            if(totalvalcredit < totalval){
	              	$('#showgreatermsg').html('Debit-DR Can Not Be Greater Than Credit-CR For Receipt');
	              	$('#submitdata').prop('disabled',true);
	              	$('#submitdatapdf').prop('disabled',true);
	              	$('#deletehidn').prop('disabled',true);
	              	$('#addmorhidn').prop('disabled',true);
	             	$('#simulation_btn').prop('disabled',true);
	            }else{
	              	$('#showgreatermsg').html('');
	              	$('#submitdata').prop('disabled',false);
	              	$('#submitdatapdf').prop('disabled',false);
	              	$('#deletehidn').prop('disabled',false);
	              	$('#addmorhidn').prop('disabled',false);
	             	$('#simulation_btn').prop('disabled',false);
	          	}
          
        	}
      	}

	}

/* --------------  CREDIT AMOUNT --------------*/

/* ----------- ENTER ONLY NUMBER --------------- */
	
	function NumberCredit(){
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
  	}

/* ----------- ENTER ONLY NUMBER --------------- */