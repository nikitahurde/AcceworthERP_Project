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

  document.getElementById("AccountText").value = msg; 

  if(msg=='No Match'){
     $(this).val('');
     document.getElementById("AccountText").value = '';
     document.getElementById("acccode_err").innerHTML = 'The Account code field is required.';
      $('#getAccCode').val('');
       $('#profitctrId').prop('readonly',true);
  }else{
     document.getElementById("acccode_err").innerHTML = '';
     var AccountCode = $('#account_code').val();
     var vrseqnum = $('#vrseqnum').val();
     var transcode = $('#transcode').val();
     $('#getAccCode').val(AccountCode);
     $('#getVrNo').val(vrseqnum);
     $('#getTransCode').val(transcode);
     $('#profitctrId').prop('readonly',false);
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

  document.getElementById("profitText").value = msg; 

  if(msg=='No Match'){
     $(this).val('');
     document.getElementById("profitText").value = '';
      document.getElementById("profit_center_err").innerHTML = 'The Profit center code field is required.';
      //$('#vr_type').prop('disabled',true);
      $('#getPfctCode').val('');
       $('#Plant_code').prop('readonly',true);
  }else{
     document.getElementById("profit_center_err").innerHTML = '';
     var pfctcode = $('#profitctrId').val();
     $('#getPfctCode').val(pfctcode);
      $('#Plant_code').prop('readonly',false);
  }

});


$("#Plant_code").bind('change', function () {
  var Plantcode =  $(this).val();
  var xyz = $('#PlantcodeList option').filter(function() {

    return this.value == Plantcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  document.getElementById("plantText").value = msg; 

  if(msg=='No Match'){
     $(this).val('');
     document.getElementById("plantText").value = '';
      document.getElementById("plant_err").innerHTML = 'The Plant code field is required.';
      $('#series_code').prop('readonly',true);
      $('#getPlantCode').val('');
  }else{
     document.getElementById("plant_err").innerHTML = '';
     var plntCode = $('#Plant_code').val();
     $('#getPlantCode').val(plntCode);
      $('#series_code').prop('readonly',false);
  }

});

$("#series_code").bind('change', function () {
  var Seriescode =  $(this).val();
  var xyz = $('#seriesList1 option').filter(function() {

    return this.value == Seriescode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  document.getElementById("seriesText").value = msg; 

  if(msg=='No Match'){
     $(this).val('');
     document.getElementById("seriesText").value = '';
      document.getElementById("series_code_errr").innerHTML = 'The Series code field is required.';
      $('#tax_code').prop('readonly',true);
      $('#getSeriesCode').val('');
  }else{
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
    var total = quantity * cfactor;
   // console.log(total);
    $('#A_qty'+quantityId).val(total);

    if(quantity){
      $('#rate'+quantityId).prop('readonly',false);
    }else{
       $('#rate'+quantityId).prop('readonly',true);
    }
    
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

  $("#tds_rate"+event).prop("disabled", false );
  $("#addmorhidn").prop("disabled", false );
  $("#deletehidn").prop("disabled", false );
 
}

function onkey(event){

   var qty = $("#qty"+event).val();
  if(qty==''){
    $("#tds_rate"+event).prop("disabled", true);
  }
}