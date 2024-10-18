/*on window load*/

var requisition = new StoreRequisition();


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

    var vr_date      = $('#vr_date').val();
    var series_code  = $('#series_code').val();
    var seriesName   = $('#seriesName').val();
    var profitctrId  = $('#profitctrId').val();
    var account_code = $('#account_code').val();
    var Plant_code   = $('#Plant_code').val();
    var transcode    = $('#transcode').val();
    var vrseqnum     = $('#vrseqnum').val();
    var headid       = $('#headid').val();
    var plantname       = $('#plantname').val();
    var pfctCode       = $('#pfctCode').val();
   // var getPfctName     = $('#getPfctName').val();

   // alert(getPfctName);

    if(headid){
      
      $('#head_id').val(headid);
    }

    if(transcode && vrseqnum){
        $('#getVrNo').val(vrseqnum);
        $('#getTransCode').val(transcode);
    }

    if(vr_date){
      $('#getTransDate').val(vr_date);
    }

    if(seriesName){
        $('#getSeriesName').val(seriesName);
    }

    if(series_code){
        $('#getSeriesCode').val(series_code);
        $('#Plant_code').prop('readonly',false);
       
    }

    if(profitctrId){
        $('#getPfctCode').val(profitctrId);
    }

    if(account_code){
        $('#getAccCode').val(account_code);
    }

    if(Plant_code){
        $('#getPlantCode').val(Plant_code);
    }

    if(plantname){
        $('#getPlantName').val(plantname);
    }

    


});

/*on window load*/

/*vr date*/




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
     document.getElementById("acccode_err").innerHTML = 'The Department code field is required.';
      $('#getAccCode').val('');
      $('#emplList').empty();
      $('#emp_code').val('');
      $('#empName').html('');
       $('#emplyeeName').val('');
        $('#emp_code').prop('readonly',true);
  }else{
    $('#accountName').val(msg);
     document.getElementById("acccode_err").innerHTML = '';
     var AccountCode = $('#account_code').val();
     var vrseqnum = $('#vrseqnum').val();
     var transcode = $('#transcode').val();
     $('#getAccCode').val(AccountCode);
     $('#getDeptName').val(msg);
     $('#emp_code').prop('readonly',false);
     $('#getVrNo').val(vrseqnum);
     $('#getTransCode').val(transcode);
    
  }

  // objvalidtn.checkBlankFieldValidation();

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
     $('#pfctName').val('');
      document.getElementById("profit_center_err").innerHTML = 'The Profit center code field is required.';
      //$('#vr_type').prop('disabled',true);
      $('#getPfctCode').val('');
       $('#Plant_code').prop('readonly',true);
        $('#account_code').css('border-color','#d2d6de');
        $('#profitctrId').css('border-color','#ff0000').focus();
  }else{
    $('#pfctName').val(msg);
     document.getElementById("profit_center_err").innerHTML = '';
     var pfctcode = $('#profitctrId').val();
     $('#getPfctCode').val(pfctcode);
     $('#getPfctName').val(msg);
      $('#Plant_code').prop('readonly',false);
      $("#profitctrId").css('border-color','#d2d6de');
      $('#account_code').css('border-color','#ff0000').focus();
  }

});


$("#Plant_code").bind('change', function () {
  var Plantcode =  $(this).val();
  var xyz = $('#PlantcodeList option').filter(function() {

    return this.value == Plantcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

   $('#appndplantbtn').empty();
    $('#planticon').show();

  if(msg=='No Match'){
     $(this).val('');
     $('#plantname').val(''); 
      document.getElementById("plant_err").innerHTML = 'The Plant code field is required.';
     
      $('#getPlantCode').val('');
      $('#profitctrId').val('');
      $('#pfctName').val('');
  }else{
     document.getElementById("plant_err").innerHTML = '';
     $('#plantname').val(msg);
     var plntCode = $('#Plant_code').val();

     $('#account_code').prop('readonly',false);
     //alert(msg);
     $('#getPlantCode').val(plntCode);
     $('#getPlantName').val(msg);
     $('#planticon').hide();

     $('#appndplantbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="requisition.getplantdata(Plantdetailsurl)" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
    
  }
  
   //objvalidtn.checkBlankFieldValidation();

});



  $("#series_code").bind('change', function () {
  var Seriescode =  $(this).val();
  //console.log(Seriescode);
  var xyz = $('#seriesList1 option').filter(function() {

    return this.value == Seriescode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

    $('#appndbtn').empty();
    $('#serisicon').show();
  
  if(msg=='No Match'){
     $(this).val('');
     $('#seriesName').val('');
      document.getElementById("series_code_errr").innerHTML = 'The Series code field is required.';
      $('#Plant_code').prop('readonly',true);
      $('#account_code').prop('readonly',true);
      $('#due_days').prop('readonly',true);
      $('#getSeriesCode').val('');
      $('#serisicon').show();
  }else{
    $('#seriesName').val(msg);
     document.getElementById("series_code_errr").innerHTML = '';
     var sers_code = $('#series_code').val();
     $('#getSeriesCode').val(sers_code);
     $('#getSeriesName').val(msg);
     $('#Plant_code').prop('readonly',false);
      $('#account_code').prop('readonly',false);
     $('#serisicon').hide();
     /*$('#appndbtn').append('<button type="button" data-toggle="modal" data-target="#series_detail" onclick="getcode()" style="background-color:#5eb1f9;border-color: #5eb1f9;"><i class="fa fa-info" aria-hidden="true"></i></button>');*/
     $('#appndbtn').append('<button type="button"  data-toggle="modal" data-target="#series_detail" onclick="requisition.getcode(seriesurl)" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');


  }

   //objvalidtn.checkBlankFieldValidation();

});







/*function addCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}*/



function CalAQty(quantityId){
   // var quantity = parseFloat($('#qty'+quantityId).val().replace(',',''));
    var quantity =$('#qty'+quantityId).val();
    var cfactor = $('#Cfactor'+quantityId).val();
    var total = quantity * cfactor;

  //  var qtynum = quantity.replace(/,/gi, "");
   // var qtyform = qtynum.split(/(?=(?:\d{3})+$)/).join(",");

   // var qtyform = (Math.round(quantity * 100) / 100).toLocaleString();

    //$('#qty'+quantityId).val(qtyform);

    // $('#qty'+quantityId).val(addCommas(quantity));
    // var components = quantity.toString().split(".");

     // components [0] = components [0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    //  return components.join(".");
      //console.log('components',quantity.toLocaleString());
     // $('#qty'+quantityId).val(components.join("."));
    //$('#qtyget'+quantityId).val(quantity);
    ///console.log('quantity',quantity);

    /*x=result.toString();
    var lastThree = x.substring(x.length-3);
    var otherNumbers = x.substring(0,x.length-3);
    if(otherNumbers != '')
        lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;
*/
    $('#A_qty'+quantityId).val(total.toFixed(2));

    if(quantity){
      $('#rate'+quantityId).prop('readonly',false);
      $("#submitdata").prop('disabled', false);
      $("#deletehidn").prop('disabled', false);
      $("#addmorhidn").prop('disabled', false);
    }else{
       $('#rate'+quantityId).prop('readonly',true);
       $('#A_qty'+quantityId).val(0);
        $("#submitdata").prop('disabled', true);
        $("#deletehidn").prop('disabled', true);
        $("#addmorhidn").prop('disabled', true);
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

