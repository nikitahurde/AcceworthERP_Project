/*window load*/

  $( window ).on( "load", function() {

      var fromdateintrans = $('#FromDateFy').val();

      var todateintrans = $('#ToDateFy').val();

      var fromdateintrans_1 = $('#FromDateFy_1').val();
      var todateintrans_1 = $('#ToDateFy_1').val();

        $('.transdatepicker').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          startDate :fromdateintrans,

          endDate : todateintrans,

          autoclose: 'true'

        });

        $('.partyrefdatepicker').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          startDate :fromdateintrans_1,

          endDate : todateintrans_1,

          autoclose: 'true'

        });

      var series     = $('#series_code').val();
      
      if(series){
        $('#series_code_errr').html('');

        var Plant = $('#Plant_code').val();
        
        if(Plant){
          $('#plant_err').html('');
          $('#Plant_code').prop('readonly',false);
          $('#tax_code').prop('readonly',false);
          
          var due_days = $('#due_days').val();

          if(due_days){
            $('#due_days').css('border-color','#d2d6de');
          }else{
            $('#due_days').css('border-color','#ff0000').focus();
            $('#due_days').prop('readonly',false);
          }
        }else{
          $('#plant_err').html('The Plant Code field is required.');
          $('#Plant_code').css('border-color','#ff0000').focus();
          $('#Plant_code').prop('readonly',false);
          $('#due_days').prop('readonly',true);
        }
          
      }else{
          $('#series_code_errr').html('The Series code field is required.');
          $('#series_code').css('border-color','#ff0000').focus();
          $('#series_code').prop('readonly',false);
       //   $('#Plant_code').css('border-color','#d2d6de');
      }

      var vrdate = $('#vr_date').val();
      var transcode = $('#transcode').val();
      var vrseqnum = $('#vrseqnum').val();
      var seriescode = $('#series_code').val();
      var Tx_Code = $('#tax_code').val();
      var plcode = $('#Plant_code').val();

      if(vrdate){
          $('#getTransDate').val(vrdate);
      }else{}

      if(transcode){
          $('#getTransCode').val(transcode);
      }else{}

      if(vrseqnum){
          $('#getVrNo').val(vrseqnum);
      }else{}

      if(seriescode){
          $('#getSeriesCode').val(seriescode);
      }else{}

      if(Tx_Code){
          $('#getTaxCode').val(Tx_Code);
      }else{}

      if(plcode){
        $('#getPlantCode').val(plcode);
      }

      var partyRefDate    = $('#party_ref_date').val();
      if(partyRefDate){
        $('#getpartyrfDate').val(partyRefDate);
      }


  });


/*window load*/


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
        $('#getTransDate').val('');
        $('#due_date').val('');
        $('#due_days').val('');

         var transac_date = $('#vr_date').val();
          if(transac_date){
            $('#account_code').prop('readonly',false);
          }else{
            $('#account_code').prop('readonly',true);
          }
        return false;

    }else{
      $('#showmsgfordate').html('');
      $('#profitId').prop('disabled',false);
      var tr_Date = $('#vr_date').val();
      var company_code = $('#company_code').val();
      var fy_year = $('#fy_year').val();
      $('#getTransDate').val(tr_Date);
      $('#getCompName').val(company_code);
      $('#getFyYear').val(fy_year);

      var transac_date = $('#vr_date').val();
    
        if(transac_date){
          $('#account_code').prop('readonly',false);
        }else{
          $('#account_code').prop('readonly',true);
        }

      var dueDays = parseInt($('#due_days').val());

      if(dueDays){
            var vr_date = $('#vr_date').val();
            var explodeDate =  vr_date.split('-');
            var expDate= explodeDate[0];
            var expMonth= explodeDate[1];
            var expYear= explodeDate[2];
            var mergeDate = expMonth+'-'+expDate+'-'+expYear;
            var getduedate = new Date(mergeDate);

            getduedate.setDate(getduedate.getDate() + dueDays); 
            var getdate = getduedate.getDate();
            var getMonth=getduedate.getMonth()+1;
            var getYear = getduedate.getFullYear();
            var duedate1 =getYear+'-'+getMonth+'-'+getdate;

            var d = new Date(duedate1);
            var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
            var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

            var duedate =da+'-'+mo+'-'+getYear;

            if(isNaN(dueDays)){
              
              $("#due_date").val('');
               $('#due_days').css('border-color','#ff0000').focus();
               $('#gateduedate').val('');
            }else{

            $("#due_date").val(duedate);
            $('#gateduedate').val(duedate);
            $('#due_days').css('border-color','#d2d6de');

            }

           if (/\D/g.test(this.value))
            {
              // Filter non-digits from input value.
              this.value = this.value.replace(/\D/g, '');
            }
           // $('#ItemCodeId1').prop('readonly',false);
        }else{
         // console.log('no',no);
          $('#due_date').val('');
          $('#gateduedate').val('');
          //$('#ItemCodeId1').prop('readonly',true);
        } 
      return true;
    }


});

$('#party_ref_date').on('change',function(){
  var transDate = $('#party_ref_date').val();
  var slipD =  transDate.split('-');
  var Tdate = slipD[0];
  var Tmonth = slipD[1];
  var Tyear = slipD[2];
  var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;
       // console.log(getproperDate);
  var selectedDate = new Date(getproperDate);
  var todayDate = new Date();
        
    if(selectedDate > todayDate){
      $('#showmsgfordate_1').html('Party Ref Date Can Not Be Greater Than Today').css('color','red');
      $('#party_ref_date').val('');
      $('#getpartyrfDate').val('');
            return false;
    }else{
      $('#showmsgfordate_1').html('');
      var party_rfno = $('#party_ref_date').val();
      var consine_code = $('#consine_code').val();
      $('#getpartyrfDate').val(party_rfno);
      $('#getcosine').val(consine_code);
      return true;
    }
});

/*kamini*/

$("#account_code").bind('change', function () {
  var Acccode =  $(this).val();
  var xyz = $('#AccountList option').filter(function() {

    return this.value == Acccode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
      $(this).val('');
      $('#accountName').val('');
      $('#acc_Code_err').html('The Customer code field is required.');
      $('#getAccCode').val('');
      $('#consine_code').val('');
      $('#getcosine').val('');
      $('#getAcc_Name').val('');
      $('#due_days').prop('readonly',true);
      $('#due_days').css('border-color','#d2d6de');
      $('#due_days_errr').html('');
      $('#account_code').css('border-color','#ff0000').focus();
  }else{
      $('#accountName').val(msg);
      $('#getAcc_Name').val(msg);
      $('#acc_Code_err').html('');
      //document.getElementById("acccode_err").innerHTML = '';
      var AccountCode = $('#account_code').val();
      var vrseqnum = $('#vrseqnum').val();
      var transcode = $('#transcode').val();
      $('#getAccCode').val(AccountCode);
      $('#consine_code').val(AccountCode);
      $('#getcosine').val(AccountCode);
      $('#getVrNo').val(vrseqnum);
      $('#getTransCode').val(transcode);
      $('#due_days').prop('readonly',false);
      $('#account_code').css('border-color','#d2d6de');
      $('#due_days').css('border-color','#ff0000').focus();
      $('#due_days_errr').html('The Due Days field is required.');
  }

});

$("#consine_code").bind('change', function () {
  var consicode =  $(this).val();
  var xyz = $('#consineList option').filter(function() {

    return this.value == consicode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  document.getElementById("consineText").innerHTML = msg; 

  if(msg=='No Match'){
     $(this).val('');
     document.getElementById("consineText").innerHTML = '';
     document.getElementById("cosnicode_err").innerHTML = 'The consine code field is required.';
      $('#getcosine').val('');
  }else{
     document.getElementById("cosnicode_err").innerHTML = '';
     var consine_code = $('#consine_code').val();
     $('#getcosine').val(consine_code);
  }

});

$("#Plant_code").bind('change', function () {
  var Plantcode =  $(this).val();
  var xyz = $('#PlantcodeList option').filter(function() {

    return this.value == Plantcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
     $('#plantname').val(''); 
      document.getElementById("plant_err").innerHTML = 'The Plant code field is required.';
      $('#tax_code').prop('readonly',true);
      $('#getPlantCode').val('');
      $('#getPfctCode').val('');
      $('#getPlantName').val('');
      $('#profitctrId').val('');
      $('#pfctName').val('');
      $('#Plant_code').css('border-color','#ff0000').focus();
      $('#due_days').css('border-color','#d2d6de');
      $('#due_days').prop('readonly',true);
  }else{
     document.getElementById("plant_err").innerHTML = '';
     $('#plantname').val(msg);
     $('#getPlantName').val(msg);
     var plntCode = $('#Plant_code').val();
     
     $('#getPlantCode').val(plntCode);
     
      $('#tax_code').prop('readonly',false);
  }

    var due_days = $('#due_days').val();
    if(due_days){
      $('#due_days').css('border-color','#d2d6de');
      $('#Plant_code').css('border-color','#d2d6de');
    }else{
      $('#due_days').prop('readonly',false);
      $('#due_days').css('border-color','#ff0000').focus();
      $('#Plant_code').css('border-color','#d2d6de');
    }
    

});

$("#series_code").bind('change', function () {
  var Seriescode =  $(this).val();
  console.log('Seriescode',Seriescode);
  var xyz = $('#seriesList1 option').filter(function() {

    return this.value == Seriescode;

  }).data('xyz');
  console.log('xyz',xyz);

  var msg = xyz ?  xyz : 'No Match';

  
  if(msg=='No Match'){
     $(this).val('');
     $('#seriesName').val('');
      document.getElementById("series_code_errr").innerHTML = 'The Series code field is required.';
      $('#tax_code').prop('readonly',true);
      $('#getSeriesCode').val('');
      $('#getSeriesName').val('');
      $('#series_code').css('border-color','#ff0000').focus();
      $('#Plant_code').css('border-color','#d2d6de');
      checkAllHeadDataISFill();
  }else{
    $('#seriesName').val(msg);
    $('#getSeriesName').val(msg);
     document.getElementById("series_code_errr").innerHTML = '';
     var sers_code = $('#series_code').val();
     $('#getSeriesCode').val(sers_code);
      $('#tax_code').prop('readonly',false);
      $('#Plant_code').css('border-color','#ff0000').focus();
      $('#series_code').css('border-color','#d2d6de');
      checkAllHeadDataISFill();
  }

});

$("#tax_code").bind('change', function () {
  var Taxcode =  $(this).val();
  var xyz = $('#TaxcodeList option').filter(function() {

    return this.value == Taxcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';


  if(msg=='No Match'){
     $(this).val('');
    
      document.getElementById("Taxcode_errr").innerHTML = 'The Tax code field is required.';
      $('#ItemCodeId1').prop('readonly',true);
      $('#getTaxCode').val('');
      $('#tax_code').css('border-color','#ff0000').focus();
      $('#Plant_code').css('border-color','#d2d6de');
      $('#due_days').css('border-color','#d2d6de');
      $('#due_days').prop('readonly',true);
  }else{
     document.getElementById("Taxcode_errr").innerHTML = '';
     var Tx_Code = $('#tax_code').val();
     $('#getTaxCode').val(Tx_Code);
      $('#ItemCodeId1').prop('readonly',false);
      $('#tax_code').css('border-color','#d2d6de');
      $('#due_days').css('border-color','#ff0000').focus();
      $('#due_days').prop('readonly',false);

  }

});

function CalAQty(quantityId){
    var quantity = $('#qty'+quantityId).val();
    var cfactor = $('#Cfactor'+quantityId).val();
    var total = quantity * cfactor;
   // console.log(total);

    $("#submitdata").prop('disabled', false);
    $("#submitNDown").prop('disabled', false);

    $('#A_qty'+quantityId).val(total);
    var sumqty=0;
    $(".getqtytotal").each(function () {

        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            sumqty += parseFloat(this.value);
          //  console.log('thi.val',this.value);
             //DrFirstAmount(sum);
        }   

        $("#basicTotal").val(sumqty.toFixed(2)); 
    });

}


$('#nextbtn').on('click',function(){
    $('.nav-tabs #firstTab').removeClass('active');
    $('#tab1info').removeClass('in active');
   // / $('#basicInfo').attr("aria-expanded","false");
    $('.nav-tabs #secondTab').addClass('active');
    $('#tab2info').addClass('in active');

    var account_code = $('#account_code').val();
    if(account_code){
      $('#consine_code').val(account_code);
    }else{}



});

$('#previousbtn').on('click',function(){
    $('.nav-tabs #secondTab').removeClass('active');
    $('#tab2info').removeClass('in active');

    $('.nav-tabs #firstTab').addClass('active');
    $('#tab1info').addClass('in active');
});

$('#secondTab').on('click',function(){

    var account_code = $('#account_code').val();
    if(account_code){
      $('#consine_code').val(account_code);
    }else{}
});

function rfheadget(rfhid){
   var headval =  $('#rfhead'+rfhid).val();
   if(headval){
      $('#getrfhead'+rfhid).val(headval);
   }else{
    $('#getrfhead'+rfhid).val('');
   }
}

$('#party_rf_no').on('input',function(){
   var partyrfno =  $('#party_rf_no').val();
   if(partyrfno){
    $('#getpartyrfNo').val(partyrfno);
   }else{
       $('#getpartyrfNo').val('');
   }
});


/*kamini*/


function showbtn(event){
  $("#addmorhidn").prop("disabled", false );
  $("#deletehidn").prop("disabled", false );
 
}

function checkAllHeadDataISFill(){

    var seriesCode = $('#series_code').val();
    var plantCode  = $('#Plant_code').val();
    var vrdate     = $('#vr_date').val();
    var duedays    = $('#due_days').val();

    if(seriesCode && plantCode && vrdate && duedays){
      $('#indentno1').prop('readonly',false);
    }else{
      $('#indentno1').prop('readonly',true);
    }
}