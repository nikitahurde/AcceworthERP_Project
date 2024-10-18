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

        var accode = $('#account_code').val();

        if(accode){
          $('#profitctrId').css('border-color','#ff0000').focus();
        }else{
          $('#account_code').css('border-color','#ff0000').focus();
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

  document.getElementById("AccountText").innerHTML = msg; 

  if(msg=='No Match'){
     $(this).val('');
     document.getElementById("AccountText").innerHTML = '';
     document.getElementById("acccode_err").innerHTML = 'The Account code field is required.';
      $('#getAccCode').val('');
       $('#profitctrId').prop('readonly',true);
       $('#account_code').css('border-color','#ff0000').focus();
       $('#profitctrId').css('border-color','#d2d6de');
       
  }else{
     document.getElementById("acccode_err").innerHTML = '';
     var AccountCode = $('#account_code').val();
     var vrseqnum = $('#vrseqnum').val();
     var transcode = $('#transcode').val();
     $('#getAccCode').val(AccountCode);
     $('#getVrNo').val(vrseqnum);
     $('#getTransCode').val(transcode);
     $('#profitctrId').prop('readonly',false);

      $('#profitctrId').css('border-color','#ff0000').focus();
      $('#account_code').css('border-color','#d2d6de');
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

$("#profitctrId").bind('change', function () {
  var Profitcode =  $(this).val();
  var xyz = $('#profitList option').filter(function() {

    return this.value == Profitcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
     $('#profitText').val('');
      document.getElementById("profit_center_err").innerHTML = 'The Profit center code field is required.';
      //$('#vr_type').prop('disabled',true);
      $('#getPfctCode').val('');
       $('#Plant_code').prop('readonly',true);
       $('#profitctrId').css('border-color','#ff0000').focus();
       $('#Plant_code').css('border-color','#d2d6de');

  }else{
     document.getElementById("profit_center_err").innerHTML = '';
     var pfctcode = $('#profitctrId').val();
     $('#getPfctCode').val(pfctcode);
      $('#Plant_code').prop('readonly',false);
      $('#profitText').val(msg);
      $('#Plant_code').css('border-color','#ff0000').focus();
      $('#profitctrId').css('border-color','#d2d6de');
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
    $('#plantText').val('');
      document.getElementById("plant_err").innerHTML = 'The Plant code field is required.';
      $('#series_code').prop('readonly',true);
      $('#getPlantCode').val('');
  }else{
      $('#plantText').val(msg);
     document.getElementById("plant_err").innerHTML = '';
     var plntCode = $('#Plant_code').val();
     $('#getPlantCode').val(plntCode);
      $('#series_code').prop('readonly',false);

      var series_code = $('#series_code').val();

      if(series_code){
        $('#tax_code').css('border-color','#ff0000').focus();
        $('#Plant_code').css('border-color','#d2d6de');
        $('#tax_code').prop('readonly',false);

        var tax_code = $('#tax_code').val();

        if(tax_code){
          $('#party_rf_no').css('border-color','#ff0000').focus();
          $('#tax_code').css('border-color','#d2d6de');
        }else{
          $('#tax_code').css('border-color','#ff0000').focus();
          $('#Plant_code').css('border-color','#d2d6de');
          $('#tax_code').prop('readonly',false);
        }
      }else{
        $('#series_code').css('border-color','#ff0000').focus();
        $('#Plant_code').css('border-color','#d2d6de');
        $('#tax_code').prop('readonly',true);
      }


  }

});

$("#series_code").bind('change', function () {
  var Seriescode =  $(this).val();
  var xyz = $('#seriesList1 option').filter(function() {

    return this.value == Seriescode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  document.getElementById("seriesText").innerHTML = msg; 

  if(msg=='No Match'){
     $(this).val('');
     $('#seriesText').val('');
      document.getElementById("series_code_errr").innerHTML = 'The Series code field is required.';
      $('#tax_code').prop('readonly',true);
      $('#getSeriesCode').val('');
  }else{
    $('#seriesText').val(msg);
     document.getElementById("series_code_errr").innerHTML = '';
     var sers_code = $('#series_code').val();
     $('#getSeriesCode').val(sers_code);
      $('#tax_code').prop('readonly',false);
  }

});

$("#tax_code").bind('change', function () {
  var Taxcode =  $(this).val();
  var xyz = $('#TaxcodeList option').filter(function() {

    return this.value == Taxcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  document.getElementById("TaxcodeText").innerHTML = msg; 

  if(msg=='No Match'){
     $(this).val('');
     document.getElementById("TaxcodeText").innerHTML = '';
      document.getElementById("Taxcode_errr").innerHTML = 'The Tax code field is required.';
      $('#ItemCodeId1').prop('readonly',true);
      $('#getTaxCode').val('');
  }else{
     document.getElementById("Taxcode_errr").innerHTML = '';
     var Tx_Code = $('#tax_code').val();
     $('#getTaxCode').val(Tx_Code);
      $('#ItemCodeId1').prop('readonly',false);
  }

});

function CalAQty(quantityId){
    var quantity = $('#qty'+quantityId).val();
    var cfactor = $('#Cfactor'+quantityId).val();

    var getRate = $('#rate'+quantityId).val();
    var total = quantity * cfactor;
    var basicAmt = quantity * getRate;

   // console.log(total);
    $('#A_qty'+quantityId).val(total);
    $('#basic'+quantityId).val(basicAmt);

    if(quantity){
      $('#rate'+quantityId).prop('readonly',false);
      $('#submitdata').prop('disabled',false);
      $('#CalcTax'+quantityId).prop('disabled',false);
    }else{
       $('#rate'+quantityId).prop('readonly',true);
       $('#submitdata').prop('disabled',true);
       $('#CalcTax'+quantityId).prop('disabled',true);
    }

    var total =0;

      $(".basicamt").each(function () {

          console.log(this.value);

        if (!isNaN(this.value) && this.value.length != 0) {

            total += parseFloat(this.value);

        }

      $("#basicTotal").val(total.toFixed(2));



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
    $('#party_rf_no').css('border-color','#d2d6de');
   }else{
    $('#getpartyrfNo').val('');
    $('#party_rf_no').css('border-color','#ff0000').focus();
   }
});


/*kamini*/

 





function showbtn(event){

  $("#addmorhidn").prop("disabled", false );
  $("#deletehidn").prop("disabled", false );
  
  var balenQty = $('#balQtyByItem'+event).val();
  var balNum = balenQty.split(".");

  var qunatity = parseFloat($('#qty'+event).val());

  if(qunatity > parseFloat(balNum[0])){
    $('#grateQtyShModel'+event).modal('show');
  }else{}

}



function cancleGreatQty(cancleId){
    $('#qty'+cancleId).val('');
    $('#A_qty'+cancleId).val('');
}

