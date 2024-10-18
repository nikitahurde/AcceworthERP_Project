var link        = window.location.href;
var getseperate = link.split('/');
var folderName  = getseperate[0]+'//'+getseperate[2]+'/'+getseperate[3];


$( window ).on( "load", function() {
  var fromdateintrans = $('#FromDateFy').val();
 // console.log(fromdateintrans);
  $('.discription').val('To -');
 // $('#discription').val('To -');
 var vrdate        = $('#vr_date').val();
 var vrseqnum      = $('#vrseqnum').val();
 var transcode     = $('#transcode').val();
 var profitId      = $('#profitId').val();
 var profit_name   = $('#profit_name').val();
 var series_code   = $('#series_code').val();
 var seriesText    = $('#seriesText').val();
 var sale_rep_code = $('#sale_rep_code').val();
 var costCent_code = $('#costCent_code').val();
 var costcenName   = $('#costcenName').val();

// alert(profit_name);

 if(vrdate){
  $('#hidnvrdte').val(vrdate);
 }
 if(transcode){
  $('#hidntranscd').val(transcode);
 }
 if(series_code){
  $('#hidnseriesCode').val(series_code);
  $('#hidnseriesName').val(seriesText);
 }
 if(vrseqnum){
  $('#hidnvrseq').val(vrseqnum);
 }
 if(profitId){
  $('#hidnpfitid').val(profitId);
 }
 if(profit_name){
  $('#hidngpfitnme').val(profit_name);
 }
 if(sale_rep_code){
    $('#hidnsaleRepCd').val(sale_rep_code);
 }
 if(costCent_code){
    $('#costCode').val(costCent_code);
    $('#costName').val(costcenName);
 }

});

/*vr date*/
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
      $('#hidnvrdte').val('');
      return false;
    }else if(transDate==''){ 
    }else{
      $('#showmsgfordate').html('');
      $('#hidnvrdte').val(transDate);
      return true;
    }
});
/*vr date*/

/*profit center code*/
$("#profitId").bind('change', function () {  
  var val = $('#profitId').val();
  var xyz = $('#profitList option').filter(function() {

    return this.value == val;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

 
  document.getElementById("profit_name").value = msg; 

    if(msg=='No Match'){
       $(this).val('');
       $('#profit_name').val('');
       $('#profit_center_err').html('The profit center code is required');
    }else{
      $('#profit_center_err').html('');
      var profitId = $("#profitId").val();
      var profit_name = $("#profit_name").val();
      $('#hidnpfitid').val(profitId);
      $('#hidngpfitnme').val(profit_name);
    }
  fieldValidation();        
});
/*profit center code*/

/*only for enter number*/
  function NumberCredit(){
   // alert('hi');
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
  }
/*only for enter number*/

/*debit amount*/
  function GetDebitAmount(debitid){
    
    $('#GettdsName'+debitid+',#GettdsCode'+debitid+',#tds_RateH'+debitid+',#tds_cutAmtH'+debitid+',#netAmtH'+debitid+'').val('');
    $('#appliedbtn'+debitid).html('');
    $('#canclebtn'+debitid).html('');
    $('#isTDSApply'+debitid).val('0');
    $('#addmorhidn').prop('disabled',false);
    $('#deletehidn').prop('disabled',false);
    

    var dramtF = $('#dr_amount'+debitid).val();

    if(dramtF > 0){

    }else{
      $('#dr_amount'+debitid).val('');
      $('#discription'+debitid).val('');
      $('#rev_code'+debitid).val('');
    }

    var ndramtF = $('#dr_amount'+debitid).val();

    if(ndramtF){
      $('#cr_amount'+debitid).prop('readonly',true);
      $('#rev_code'+debitid).prop('readonly',false);
      $('#tds_rate'+debitid).prop('disabled',false);
    }else{
      $('#cr_amount'+debitid).prop('readonly',false);
      $('#rev_code'+debitid).prop('readonly',true);
      $('#tds_rate'+debitid).prop('disabled',true);
    }
    
    var sum = 0;

      $(".dr_amount").each(function () {

        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }

        $("#totldramt").val(sum.toFixed(2));

        var totalDrAmount = $('#totldramt').val();
        var totalCreditAm = $('#totlcramt').val();
   
        if((totalDrAmount == totalCreditAm)){
            $('#submitdata').prop('disabled',false);
            $('#submitdatapdf').prop('disabled',false);
            $("#transerror").html('');
        }else{
            $('#submitdata').prop('disabled',true);
            $('#submitdatapdf').prop('disabled',true);
        }
    
      });

  }
/*debit amount*/

/*credit amount*/

  function GetCreditAmount(creditid){

    $('#GettdsName'+creditid+',#GettdsCode'+creditid+',#tds_RateH'+creditid+',#tds_cutAmtH'+creditid+',#netAmtH'+creditid+',#tdsBaseAmtH'+creditid+'').val('');
    $('#appliedbtn'+creditid).html('');
    $('#canclebtn'+creditid).html('<small class="label label-danger iconBtnSty"><i class="fa fa-times"></i></small>');
    $('#isTDSApply'+creditid).val('0');

    $('#addmorhidn').prop('disabled',false);
    $('#deletehidn').prop('disabled',false);

    var cramtF = $('#cr_amount'+creditid).val();

    if(cramtF > 0){

    }else{
      $('#cr_amount'+creditid).val('');
      $('#discription'+creditid).val('');
      $('#rev_code'+creditid).val('');
    }

    var tdsByAccCode = $('#tdsByAccCode'+creditid).val();
    if(tdsByAccCode ==''){
      $('#appliedbtn'+creditid).html('');
      $('#canclebtn'+creditid).html('');
    }

    var ncramtF = $('#cr_amount'+creditid).val();
    if(ncramtF){
      $('#dr_amount'+creditid).prop('readonly',true);
      $('#rev_code'+creditid).prop('readonly',false);
      $('#tds_rate'+creditid).prop('disabled',false);
    }else{
      $('#dr_amount'+creditid).prop('readonly',false);
      $('#rev_code'+creditid).prop('readonly',true);
      $('#tds_rate'+creditid).prop('disabled',true);
    }

    var sum = 0;

    $(".cr_amount").each(function () {

      if (!isNaN(this.value) && this.value.length != 0) {
          sum += parseFloat(this.value);
      }
      $("#totlcramt").val(sum.toFixed(2));

    });

    var totalDrAmount = $('#totldramt').val();
    var totalCreditAm = $('#totlcramt').val();

    if((totalDrAmount > 0.00) && (totalCreditAm > 0.00)){
      if((totalDrAmount == totalCreditAm)){
          $('#submitdata').prop('disabled',false);
          $('#submitdatapdf').prop('disabled',false);
      }else{
          $('#submitdata').prop('disabled',true);
          $('#submitdatapdf').prop('disabled',true);
      }
    }
            
  }
/*credit amount*/

/*account code list*/
function AccListData(AccCode){
      var accountcode =  $('#acc_code'+AccCode).val();
    console.log('AccCode',AccCode);

      var accTag = $('#acctTag'+AccCode).val();

       var xyz = $('#AccList'+AccCode+' option').filter(function() {

          return this.value == accountcode;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
            $('#acc_code'+AccCode).val('');
            $('#acc_name'+AccCode).val('');
          }else{
            $('#acc_code'+AccCode).css('border-color','#d7d3d3');
            $('#acc_name'+AccCode).val(msg);
            
          }
          $('#GettdsName'+AccCode+',#GettdsCode'+AccCode+',#tds_RateH'+AccCode+',#tds_cutAmtH'+AccCode+',#netAmtH'+AccCode+',#tdsBaseAmtH'+AccCode+'').val('');
          $('#isTDSApply'+AccCode).val('0');
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var accountcode =  $('#acc_code'+AccCode).val();
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

                if(data1.data==''){
                  var nottds ='';
                  $('#tdsByAccCode'+AccCode).val(nottds);

                }else{

                  $('#tdsByAccCode'+AccCode).val(data1.data[0].TDS_CODE);

                  if(data1.data_gl == ''){

                  }else{

                    var glCodechk = $('#gl_code'+AccCode).val();
                    if(glCodechk == ''){
                      $('#gl_code'+AccCode).val(data1.data[0].GL_CODE);
                      $('#gl_name'+AccCode).val(data1.data[0].GL_NAME);
                    }else{
                      $('#gl_code'+AccCode).css('border-color','#d7d3d3');
                    }

                    $('#GlList'+AccCode).empty();

                    $.each(data1.data_gl, function(k, getData){
                        $("#GlList"+AccCode).append($('<option>',{
                          value:getData.GL_CODE,
                          'data-xyz':getData.GL_NAME,
                          text:getData.GL_NAME+' ['+getData.GL_NAME+']'
                        }));
                    });

                    var glCodeblnk = $('#gl_code'+AccCode).val();
                    if(glCodeblnk == ''){
                      $('#gl_code'+AccCode).css('border-color','#ff0000');
                    }else{
                      $('#gl_code'+AccCode).css('border-color','#d7d3d3');
                    }

                  }

                  chekvalOnGl(AccCode);

                  if(data1.data_tds == ''){
                    $('#tds_rate'+AccCode).addClass('tdsratebtnHide');
                    $('#appliedbtn'+AccCode).html('');
                  }else{

                    $('#tds_rate'+AccCode).removeClass('tdsratebtnHide');
                  }

                }

              }
            }
        });



}
/*account code list*/

/* ----------- START : EDIT JOURNAL TRAN ---------- */
  
  function EditAccListData(AccCode){
      var accountcode =  $('#acc_code'+AccCode).val();
    console.log('AccCode',AccCode);

      var accTag = $('#acctTag'+AccCode).val();

       var xyz = $('#AccList'+AccCode+' option').filter(function() {

          return this.value == accountcode;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
            $('#acc_code'+AccCode).val('');
            $('#acc_name'+AccCode).val('');
          }else{
            $('#acc_code'+AccCode).css('border-color','#d7d3d3');
            $('#acc_name'+AccCode).val(msg);
            
          }
          //$('#GettdsName'+AccCode+',#GettdsCode'+AccCode+',#tds_RateH'+AccCode+',#tds_cutAmtH'+AccCode+',#netAmtH'+AccCode+',#tdsBaseAmtH'+AccCode+'').val('');
          //$('#isTDSApply'+AccCode).val('0');
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var accountcode =  $('#acc_code'+AccCode).val();
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

                if(data1.data==''){
                  var nottds ='';
                  $('#tdsByAccCode'+AccCode).val(nottds);

                }else{

                  $('#tdsByAccCode'+AccCode).val(data1.data[0].TDS_CODE);

                  if(data1.data_gl == ''){

                  }else{

                    var glCodechk = $('#gl_code'+AccCode).val();
                    if(glCodechk == ''){
                      $('#gl_code'+AccCode).val(data1.data[0].GL_CODE);
                      $('#gl_name'+AccCode).val(data1.data[0].GL_NAME);
                    }else{
                      $('#gl_code'+AccCode).css('border-color','#d7d3d3');
                    }

                    $('#GlList'+AccCode).empty();

                    $.each(data1.data_gl, function(k, getData){
                        $("#GlList"+AccCode).append($('<option>',{
                          value:getData.GL_CODE,
                          'data-xyz':getData.GL_NAME,
                          text:getData.GL_NAME+' ['+getData.GL_NAME+']'
                        }));
                    });

                    var glCodeblnk = $('#gl_code'+AccCode).val();
                    if(glCodeblnk == ''){
                      $('#gl_code'+AccCode).css('border-color','#ff0000');
                    }else{
                      $('#gl_code'+AccCode).css('border-color','#d7d3d3');
                    }

                  }

                  chekvalOnGl(AccCode);

                  if(data1.data_tds == ''){
                    $('#tds_rate'+AccCode).addClass('tdsratebtnHide');
                    $('#appliedbtn'+AccCode).html('');
                  }else{

                    $('#tds_rate'+AccCode).removeClass('tdsratebtnHide');
                  }

                }

              }
            }
        });



}

/* ----------- END : EDIT JOURNAL TRAN ---------- */

/*series code*/
  $("#series_code").bind('change', function () {
    var seriescode =  $(this).val();
    var xyz = $('#seriesList option').filter(function() {

      return this.value == seriescode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
       $(this).val('');
       $("#seriesText").val('');
       $("#vrseqnum").val('');
       $("#hidnvrseq").val('');
       $("#hidnseriesCode").val('');
       $("#hidnseriesName").val('');
    }else{
      $('#seriesText').val(msg);
      $('#hidnseriesName').val(msg);
    }
    fieldValidation();
  });
/*series code*/


$("#sale_rep_code").bind('change', function () {
    var seriescode =  $(this).val();
    var xyz = $('#saleRepList option').filter(function() {

      return this.value == seriescode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
       $(this).val('');
       $('#saleRText').val('');
       $('#hidnsaleRepCd').val('');
       $('#hidnsaleRepName').val('');
    }else{
      $('#saleRText').val(msg);
      $('#hidnsaleRepCd').val(seriescode);
      $('#hidnsaleRepName').val(msg);
    }
    fieldValidation();
  });

  function costCListData(id){
    var costName =  $('#cost_code'+id).val();
    var xyz = $('#costCList'+id+' option').filter(function() {

      return this.value == costName;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
      $('#cost_code'+id).val('');
      $('#costC_name'+id).val('');
    }else{
      $('#costC_name'+id).val(msg);
    }

    //chekvalOnGl(id);

  }

  function chekvalOnGl(srNo){
    var acctTag  = $('#acctTag'+srNo).val();
    var costCTag = $('#costCTag'+srNo).val();
    var glCode = $('#gl_code'+srNo).val();
    var drAmnt = $('#dr_amount'+srNo).val();
    var crAmnt = $('#cr_amount'+srNo).val();

    console.log('glCode',glCode);

    if(glCode){
      if(drAmnt){
        $('#dr_amount'+srNo).prop('readonly',false);
        $('#cr_amount'+srNo).prop('readonly',true);
      }else if(crAmnt){
        $('#dr_amount'+srNo).prop('readonly',true);
        $('#cr_amount'+srNo).prop('readonly',false);
      }else{
        $('#dr_amount'+srNo).prop('readonly',false);
        $('#cr_amount'+srNo).prop('readonly',false);
      }

    }else{
      $('#cr_amount'+srNo).prop('readonly',true);
      $('#dr_amount'+srNo).prop('readonly',true);
    }

   //$('#dr_amount'+srNo).prop('readonly',false);
   // $('#cr_amount'+srNo).prop('readonly',false);

    /*if((costCTag == 'YES') && (acctTag == 'YES')){
      var costCode = $('#cost_code'+srNo).val();
      var accCode  = $('#acc_code'+srNo).val();
   
        if(costCode && accCode){
          $('#dr_amount'+srNo).prop('readonly',false);
          $('#cr_amount'+srNo).prop('readonly',false);
          $('#dr_amount'+srNo).val('');
          $('#cr_amount'+srNo).val('');
          $('#cost_code'+srNo).css('border-color','#d7d3d3');
          $('#acc_code'+srNo).css('border-color','#d7d3d3');
        }else{
          $('#dr_amount'+srNo).prop('readonly',true);
          $('#cr_amount'+srNo).prop('readonly',true);
          $('#cost_code'+srNo).css('border-color','#ff0000');
          $('#acc_code'+srNo).css('border-color','#ff0000');
        }

    }else if((costCTag == 'YES') && (acctTag == 'NO')){
      var costCodeC = $('#cost_code'+srNo).val();
      if(costCodeC){
        $('#dr_amount'+srNo).prop('readonly',false);
        $('#cr_amount'+srNo).prop('readonly',false);
        $('#dr_amount'+srNo).val('');
        $('#cr_amount'+srNo).val('');
        $('#cost_code'+srNo).css('border-color','#d7d3d3');
      }else{
        $('#dr_amount'+srNo).prop('readonly',true);
        $('#cr_amount'+srNo).prop('readonly',true);
        $('#cost_code'+srNo).css('border-color','#ff0000');
      }
    }else if((costCTag == 'NO') && (acctTag == 'YES')){
      var accCodeC = $('#acc_code'+srNo).val();
      if(accCodeC){
        $('#dr_amount'+srNo).prop('readonly',false);
        $('#cr_amount'+srNo).prop('readonly',false);
        $('#dr_amount'+srNo).val('');
        $('#cr_amount'+srNo).val('');
        $('#acc_code'+srNo).css('border-color','#d7d3d3');
      }else{
        $('#dr_amount'+srNo).prop('readonly',true);
        $('#cr_amount'+srNo).prop('readonly',true);
        $('#acc_code'+srNo).css('border-color','#ff0000');
      }
    }else{
      $('#dr_amount'+srNo).prop('readonly',false);
      $('#cr_amount'+srNo).prop('readonly',false);
      $('#dr_amount'+srNo).val('');
      $('#cr_amount'+srNo).val('');
      $('#cost_code'+srNo).css('border-color','#d7d3d3');
      $('#acc_code'+srNo).css('border-color','#d7d3d3');
    }*/

      var sum = 0;
      $(".dr_amount").each(function () {

        if (!isNaN(this.value) && this.value.length != 0) {

            sum += parseFloat(this.value);

        }

        $("#totldramt").val(sum.toFixed(2));

      });

      var sumcr = 0;

      $(".cr_amount").each(function () {

        if (!isNaN(this.value) && this.value.length != 0) {

            sumcr += parseFloat(this.value);

        }

      $("#totlcramt").val(sumcr.toFixed(2));

    });

  }


/* ---------------- when click on cal tds button ------------- */

  function CalculateTdsRate(TdsId){   
 
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var tdsCode    = $('#tdsByAccCode'+TdsId).val();
      var acCode     = $('#acc_code'+TdsId).val();

      var tdsURL = folderName+'/tds-rate-calculate';
      
      $.ajax({

          url:tdsURL,

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
                var tdsAmt = Math.round(calculatPercnt);
              
                $('#tds_Amt_cal'+TdsId).val(tdsAmt);
                var deductBAmtWTdsAmt = tdsbaseamtval - parseFloat(tdsAmt);
                $('#deduct_tds_Amt'+TdsId).val(deductBAmtWTdsAmt);
                
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
    var tdsCutAmt      = $('#tds_Amt_cal'+aplytdsval).val();

    $('#tds_RateH'+aplytdsval).val(TdsRate);
    $('#tds_cutAmtH'+aplytdsval).val(tdsCutAmt);
    $('#netAmtH'+aplytdsval).val(deduct_tds_Amt);
    $('#tdsBaseAmtH'+aplytdsval).val(NetAmount);
    $('#isTDSApply'+aplytdsval).val('1');
     
      $('#appliedbtn'+aplytdsval).html('<small class="label label-success iconBtnSty"><i class="fa fa-check"></i></small></div>');
      $('#canclebtn'+aplytdsval).html('');

      $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
      });

      var tdssectionC = $('#tdsByAccCode'+aplytdsval).val();

      var tds_URL = folderName+'/get-tds-name-n-code';
  
      $.ajax({

            url:tds_URL,
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

    $('#netAmtH'+canclbtn+',#tdsBaseAmtH'+canclbtn+',#tds_cutAmtH'+canclbtn+',#tds_RateH'+canclbtn+',#GettdsCode'+canclbtn+',#GettdsName'+canclbtn+',#GettdsName'+canclbtn+'').val('');
    $('#isTDSApply'+canclbtn).val('0');
    $('#canclebtn'+canclbtn).html('<small class="label label-danger iconBtnSty"><i class="fa fa-times"></i></small>');
  }

/* -------------- cancle tds ------------------- */

  function fieldValidation(){
    var series_code     = $('#series_code').val();
    var pfct_code       = $('#profitId').val();
    var saleRes_code    = $('#sale_rep_code').val();
    var costCenter_code = $('#costCent_code').val();

    if(series_code){
      $('#series_code').css('border-color','#d2d6de');
      $('#serscode_err').html('');
      if(pfct_code){
        $('#profitId').css('border-color','#d2d6de');
        $('#profit_center_err').html('');
      }else{
        $('#profitId').css('border-color','#ff0000').focus();
        $('#profit_center_err').html('The profit center code field is required.');
      }
    }else{
      $('#series_code').css('border-color','#ff0000').focus();
      $('#serscode_err').html('The series code field is required.');
    }

    if(series_code && pfct_code){
      $('#acc_code1').prop('readonly',false);
      $('#gl_code1').prop('readonly',false);
      $('#cost_code1').prop('readonly',false);
      $('#gl_code1').css('border-color','#ff0000');
    }else{
      $('#acc_code1').prop('readonly',true);
      $('#gl_code1').prop('readonly',true);
      $('#cost_code1').prop('readonly',true);
      $('#gl_code1').css('border-color','#d7d3d3');
    }
}
