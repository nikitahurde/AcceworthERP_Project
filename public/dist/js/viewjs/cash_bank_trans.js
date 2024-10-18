var link        = window.location.href;
var getseperate = link.split('/');
var folderName  = getseperate[0]+'//'+getseperate[2]+'/'+getseperate[3];

/*on window load*/

$( window ).on( "load", function() {
      var fromdateintrans = $('#FromDateFy').val();
     // console.log(fromdateintrans);
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

        var vrDate      = $('#vr_date').val();
        var vrseqnum    = $('#vrseqnum').val();
        var transcode   = $('#transcode').val();
        var series_code = $('#series_code').val();
        var series_name = $('#seriesText').val();
        var gl_code     = $('#gl_code').val();
        var gl_name     = $('#gl_name').val();
        var vr_type     = $('#vr_type').val();
        var profitId    = $('#profitId').val();
        var profit_name = $('#profit_name').val();

        if(vrDate){
          $('#hidnvrdte').val(vrDate);
        }
        if(vrseqnum){
          $('#hidnvrseq').val(vrseqnum);
        }
        if(transcode){
          $('#hidntranscd').val(transcode);
        }
        if(series_code){
          $('#hidnseried').val(series_code);
        }else{
          //$('#series_code').css('border-color','#ff0000').focus();
        }
        if(series_name){
          $('#hidnseriesName').val(series_name);
        }
        if(gl_code){
          $('#hidnglcode').val(gl_code);
        }
        if(gl_name){
          $('#hidnglnme').val(gl_name);
        }
        if(vr_type){
          $('#hidnvrtyp').val(vr_type);
        }
        if(profitId){
          $('#hidnpfitid').val(profitId);
        }
        if(profit_name){
          $('#hidngpfitnme').val(profit_name);
        }

        fieldValidation();

});

/*on window load*/



/*series code*/
$("#series_code").bind('change', function () {
  
    var seriescode =  $(this).val();
    var xyz = $('#seriesList option').filter(function() {

      return this.value == seriescode;

    }).data('xyz');


    var msg = xyz ?  xyz : 'No Match';

    $("#seriesText").val(msg);

    $("[data-toggle=tooltip]").mouseenter(function () {
        $("#seriesText").attr('title', msg);
    });    

    if(msg=='No Match'){
        $(this).val('');
        $("#seriesText").val('');
        document.getElementById("serscode_err").innerHTML = 'The series code field is required.';
        $('#vr_type').prop('disabled',true);
        $('#vr_type').css('border-color','#d2d6de');
        $('#hidnseried,#gl_code,#gl_name,#hidnglcode,#hidnglnme,#hidnseriesName,#hidnvrseq').val('');
        $('#series_code').css('border-color','red').focus();
        $('#firsticon').css('display','block');
    }else{
        $('#gl_code').val('');
        $('#gl_name').val('');
        $('#hidnglcode').val('');
        $('#hidnglnme').val('');
        document.getElementById("serscode_err").innerHTML = '';
        var seriescode1 =  $('#series_code').val();
        $('#hidnseried').val(seriescode1);
        $('#hidnseriesName').val(msg);
    }

    fieldValidation();

});
/*series code*/


/*vr type*/
$('#vr_type').on('change',function(){
         
    if( $("#vr_type option:selected").val()!=''){

        var vrType =  $('#vr_type').val();

         if(vrType == 'Payment'){
          $('.discription').val('To -');
         // $('.bankshowwhenrecpt:visible').hide();
         }else if(vrType == 'Receipt'){
          $('.discription').val('By -');
         // $('.bankshowwhenrecpt:hidden').show();
         }else{

         }

         $('#hidnvrtyp').val(vrType);

    }else{
        $('#hidnvrtyp').val('');
    }

  fieldValidation();  

});
/*vr type*/

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
/*vr date*/


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

/*cost center name*/



/*profit center code*/
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
/*profit center code*/


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


/*instrument type*/

    $("#inst_type").bind('change', function () {  

          var val = $(this).val();
          var xyz = $('#InstTypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          var paymode =  $('#vr_type').val();
               if(paymode == 'Payment'){
                $('#discription1').val('To -');
                $('#cheque_no').val('');
               }else if(paymode == 'Receipt'){
                $('#discription1').val('By -');
               // $('.bankshowwhenrecpt:visible').hide();
                $('#cheque_no').val('');
               }else{

               }

          if(msg=='No Match'){

             $(this).val('');

             var paymode =  $('#vr_type').val();
               if(paymode == 'Payment'){
                $('#discription1').val('To -');
               }else if(paymode == 'Receipt'){
                $('#discription1').val('By -');
               }else{

               }
          
          }else{
             var dic = $('#discription1').val();
              var checknum = $('#inst_type').val();
              var fordiscriptn = dic+' '+checknum+' :';
             // console.log(checknum);
              $('#discription1').val(fordiscriptn);
          }
          
          
          if((paymode == 'Receipt') && (val=='CH' || val=='DD' || val=='BA')){
              $('#bankid1').removeClass('bankshowwhenrecpt');
              $('#ShowBankName1').removeClass('bankNameGet');
          }else{
            $('#bankid1').addClass('bankshowwhenrecpt');
            $('#ShowBankName1').addClass('bankNameGet');
          }

          if(val == 'NA'){
            $("#cheque_no").addClass('amntFild');
          }else{
            $("#cheque_no").removeClass('amntFild');
          }
          

    });
/*instrument type*/

/*only for enter number*/
  function NumberCredit(){
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
  }
/*only for enter number*/

/*show check num on input*/
function getdicbypay(slno){

    var chqNo = $('#cheque_no').val();

    var xyz = $('#chequeNoList'+slno+' option').filter(function() {

      return this.value == chqNo;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

    }else{
      $('#updateChqNo'+slno).val(msg);
      var getval =  $('#discription'+slno).val();
      var checkno = $('#cheque_no').val();
      var fordiscriptnbl = getval+' '+checkno;
    
      var getnewdis = $('#discription'+slno).val();
      var res = getnewdis.split(":");

      if(res[1] == ''){
        $('#discription'+slno).val(fordiscriptnbl);
      }else if(res[1] == checkno){

      }else{
         $('#discription'+slno).val('');
         var checkno11 = $('#cheque_no').val();
         var getpre = getval;
         var res1 = getpre.split(":");
         var discrptn = res1[0]+': '+checkno11;
         $('#discription'+slno).val(discrptn);   
      }
    }

}
/*show check num on input*/

/*instrument type for other td*/
function ITypeChng(itypeid){
  //console.log(itypeid);
   var itype =  $('#inst_type'+itypeid).val();

   var xyz = $('#InstTypeList'+itypeid+' option').filter(function() {

          return this.value == itype;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          var paymode =  $('#vr_type').val();
               if(paymode == 'Payment'){
                $('#discription'+itypeid).val('To -');
                $('#cheque_no'+itypeid).val('');

               }else if(paymode == 'Receipt'){
                $('#discription'+itypeid).val('By -');
                $('#cheque_no'+itypeid).val('');
               }else{

               }
         

          if(msg=='No Match'){

             $('#inst_type'+itypeid).val('');

              var paymode =  $('#vr_type').val();
               if(paymode == 'Payment'){
                $('#discription'+itypeid).val('To -');
               }else if(paymode == 'Receipt'){
                $('#discription'+itypeid).val('By -');
               }else{

               }
          }else{
             var dic = $('#discription'+itypeid).val();
              var checknum = $('#inst_type'+itypeid).val();
              var fordiscriptn = dic+' '+checknum;
             // console.log(checknum);
              $('#discription'+itypeid).val(fordiscriptn);
          }
          
          
          if((paymode == 'Receipt') && (itype=='CH' || itype=='DD' || itype=='BA')){
              $('#bankid'+itypeid).removeClass('bankshowwhenrecpt');
              $('#ShowBankName'+itypeid).removeClass('bankNameGet');
          }else{
            $('#bankid'+itypeid).addClass('bankshowwhenrecpt');
            $('#ShowBankName'+itypeid).addClass('bankNameGet');
          }

          if(itype == 'NA'){
            $("#cheque_no"+itypeid).addClass('amntFild');
          }else{
            $("#cheque_no"+itypeid).removeClass('amntFild');
          }
          
} 
/*instrument type for other td*/

/*get check num for other td*/
function GetChkNo(chekNo){

    var disval =  $('#discription'+chekNo).val();
    var checknounic = $('#cheque_no'+chekNo).val();

    var fordiscriptnbl = disval+' '+checknounic;

    var fulldis = $('#discription'+chekNo).val();
    var resunuq = fulldis.split(":");

    if(resunuq[1] == ''){
      $('#discription'+chekNo).val(fordiscriptnbl);
    }else if(resunuq[1] == checknounic){

     }else{
         $('#discription'+chekNo).val('');
         var checknounic11 = $('#cheque_no'+chekNo).val();
         var getpreuniq = disval;
         var res1dis = getpreuniq.split(":");
         var discrptnfinl = res1dis[0]+': '+checknounic11;
         $('#discription'+chekNo).val(discrptnfinl);   
     }

  }
/*get check num for other td*/

/*debit amount*/
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

      if (!isNaN(this.value) && this.value.length != 0) {

        // $('#cr_amount').prop('disabled',true);
         $('#cr_amount'+debitid).prop('readonly',true);
         $('#tds_rate'+debitid).prop('disabled',false);
         $('#submitdata').prop('disabled',false);
          $('#submitdatapdf').prop('disabled',false);
          $('#deletehidn').prop('disabled',false);
          $('#addmorhidn').prop('disabled',false);
          $('#simulation_btn').prop('disabled',false);
      }else{
        //  $('#cr_amount').prop('disabled',false);
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
/*debit amount*/

/*credit amount*/

  function GetCreditAmount(creditid){

       var sum = 0;

      $(".cr_amount").each(function () {

        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
        }

    //  var firstamt = parseFloat($('#cr_amount').val());

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
            $('#billTkDr'+creditid).html('');
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
/*credit amount*/






/*gl name code list*/
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
      $('#dr_amount1,#cr_amount1').prop('readonly',true);
      $('#glCodeName'+slno).css('border-color','red');
    }else{
        
      $('#genrl_name'+slno).val(msg);
      $('#glCodeName'+slno).css('border-color','#d7d3d3');
    }
    $('#vr_date,#series_code,#seriesText,#sale_rep_code,#profitId').prop('readonly',true);
    $('#vr_type').prop('disabled',true);
    var bankGl= $('#gl_code').val();
    var accountcode= $('#acc_code').val();

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

                  if((accountTag == 'YES') || (costCenterTag == 'YES')){
                    $('#dr_amount'+slno).prop('readonly',true);
                    $('#cr_amount'+slno).prop('readonly',true);
                  }else{
                    $('#dr_amount'+slno).prop('readonly',false);
                    $('#cr_amount'+slno).prop('readonly',false);
                  }

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
/*gl name code list*/

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


function chekvalOnGl(srNo){
    var acctTag  = $('#acctTag'+srNo).val();
    var costCTag = $('#costcTag'+srNo).val();

    if((costCTag == 'YES') && (acctTag == 'YES')){
      var costCode = $('#costCenter'+srNo).val();
      var accCode  = $('#acc_code'+srNo).val();
   
        if(costCode && accCode){
          $('#dr_amount'+srNo).prop('readonly',false);
          $('#cr_amount'+srNo).prop('readonly',false);
          $('#costCenter'+srNo).css('border-color','#d7d3d3');
          $('#acc_code'+srNo).css('border-color','#d7d3d3');
        }else{
          $('#dr_amount'+srNo).prop('readonly',true);
          $('#cr_amount'+srNo).prop('readonly',true);
          $('#costCenter'+srNo).css('border-color','#ff0000');
          $('#acc_code'+srNo).css('border-color','#ff0000');
        }

    }else if((costCTag == 'YES') && (acctTag == 'NO')){
      var costCodeC = $('#costCenter'+srNo).val();
      if(costCodeC){
        $('#dr_amount'+srNo).prop('readonly',false);
        $('#cr_amount'+srNo).prop('readonly',false);
        $('#costCenter'+srNo).css('border-color','#d7d3d3');
      }else{
        $('#dr_amount'+srNo).prop('readonly',true);
        $('#cr_amount'+srNo).prop('readonly',true);
        $('#costCenter'+srNo).css('border-color','#ff0000');
      }
    }else if((costCTag == 'NO') && (acctTag == 'YES')){
      var accCodeC = $('#acc_code'+srNo).val();
      if(accCodeC){
        $('#dr_amount'+srNo).prop('readonly',false);
        $('#cr_amount'+srNo).prop('readonly',false);
        $('#acc_code'+srNo).css('border-color','#d7d3d3');
      }else{
        $('#dr_amount'+srNo).prop('readonly',true);
        $('#cr_amount'+srNo).prop('readonly',true);
        $('#acc_code'+srNo).css('border-color','#ff0000');
      }
    }else{
      $('#dr_amount'+srNo).prop('readonly',false);
      $('#cr_amount'+srNo).prop('readonly',false);
      $('#costCenter'+srNo).css('border-color','#d7d3d3');
      $('#acc_code'+srNo).css('border-color','#d7d3d3');
    }

  }


/*bank code*/

function banklistget(BankCode){

   var bankcode = $('#bankid'+BankCode).val();

   var xyz = $('#bankList'+BankCode+' option').filter(function() {

    return this.value == bankcode;

   }).data('xyz');

   var msg = xyz ?  xyz : 'No Match';

  //document.getElementById("bankText"+BankCode).innerHTML = msg; 
  document.getElementById("ShowBankName"+BankCode).value = msg; 

  if(msg=='No Match'){
     $('#bankid'+BankCode).val('');
     //$('#vr_date').prop('disabled',true);
     //document.getElementById("bankText"+BankCode).innerHTML = '';
     document.getElementById("ShowBankName"+BankCode).value = '';
  }else{
    
   // $('#vr_date').prop('disabled',false);
   // console.log('hi');
  }
}

/*bank code*/

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

/* --------below js for edit cash bank page --------*/

/*when edit data*/

  function GetChkNoWhenEdit(chekNoE){

    var disval =  $('#discription'+chekNoE).val();
    var checknounic = $('#cheque_no'+chekNoE).val();

    var fordiscriptnbl = disval+' '+checknounic;

    var fulldis = $('#discription'+chekNoE).val();
    var resunuq = fulldis.split(":");

    if(resunuq[1] == ''){
      $('#discription'+chekNoE).val(fordiscriptnbl);
    }else if(resunuq[1] == checknounic){

     }else{
         $('#discription'+chekNoE).val('');
         var checknounic11 = $('#cheque_no'+chekNoE).val();
         var getpreuniq = disval;
         var res1dis = getpreuniq.split(":");
         var discrptnfinl = res1dis[0]+': '+checknounic11;
         $('#discription'+chekNoE).val(discrptnfinl);   
     }

  }

/*when edit data*/

    function GetDebitAmountEdit(debitid){

          var sum = 0;
    
          var drAmount =   $('#dr_amount'+debitid).val();
          var CrAmount =   $('#cr_amount'+debitid).val();
    
          if(drAmount !=0){
            $('#cr_amount'+debitid).prop('readonly',true);
            
          }else{
             $('#cr_amount'+debitid).prop('readonly',false);
            
          }

    var resultofdebit = $('#resultofdebit'+debitid).val();
    var Applytdsonamt = $('#Applytdsonamt'+debitid).val();

	if(Applytdsonamt){
		$('#Applytdsonamt'+debitid).val('');
	}
        
          $('#WhenTdsCutDebit'+debitid).val(drAmount);
    
          var accname = $('#acc_name'+debitid).val();
    
          var tdsrateexist = $('#TdsRateByAccCode'+debitid).val();
          var tdssectionexist = $('#TdsSection'+debitid).val();
          var gettdsratecode = $('#accNtdsrate'+debitid).val();
          var gettdsratecodeBytds = $('#tdsByAccCode'+debitid).val();
    
          if(gettdsratecodeBytds){
            $('#tds_rate'+debitid).removeClass('tdsratebtnHide');
          }else{
            $('#tds_rate'+debitid).addClass('tdsratebtnHide');
          }

   


    }
    
    
    function GetCreditAmountEdit(creditid){

        var drAmount =   $('#dr_amount'+creditid).val();
        var CrAmount =   $('#cr_amount'+creditid).val();

        if(CrAmount !=0){
          $('#dr_amount'+creditid).prop('readonly',true);
          //$('#dr_amount'+debitid).prop('readonly',false);
        }else{
           $('#dr_amount'+creditid).prop('readonly',false);
          //$('#dr_amount'+debitid).prop('readonly',false);
        }
  	
		var Applytdsonamtforcr = $('#Applytdsonamtforcr'+creditid).val();
  		if(Applytdsonamtforcr){
   
    			$('#Applytdsonamtforcr'+creditid).val('');
  		}
    
        $('#WhenTdsCutCredit'+creditid).val(CrAmount);

      var accnamecr = $('#acc_name'+creditid).val();
       var gettdsratecodeCR = $('#accNtdsrate'+creditid).val();
        var tdsrateexist = $('#TdsRateByAccCode'+creditid).val();
      var tdssectionexist = $('#TdsSection'+creditid).val();
      var gettdsratecodeBytds = $('#tdsByAccCode'+creditid).val();
        //console.log('id',creditid);
      if(gettdsratecodeBytds){
        $('#tds_rate'+creditid).removeClass('tdsratebtnHide');
      }else{
        $('#tds_rate'+creditid).addClass('tdsratebtnHide');
      }

    }

/* --------below js for edit cash bank page --------*/