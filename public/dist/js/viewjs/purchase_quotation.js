/*window load*/
var objvalidtn = new jsController();

  $( window ).on( "load", function() {

      var fromdateintrans = $('#FromDateFy').val();
      var todateintrans = $('#ToDateFy').val();
      var fromdateintrans_1 = $('#FromDateFy_1').val();
      var todateintrans_1 = $('#ToDateFy_1').val();
      var head_id         = $('#headidquo').val();

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

      var transCode = $('#transcode').val();
      var vrdate = $('#vr_date').val();
      var series = $('#series_code').val();
      var account_code = $('#account_code').val();
      var tax_code = $('#tax_code').val();
      var getVrNo = $('#vrseqnum').val();
      var Plant_code = $('#Plant_code').val();

      if(head_id){
        $('#head_id').val(head_id);
      }

      if(getVrNo){
        $('#getVrNo').val(getVrNo);
      }

      if(transCode){
        $('#getTransCode').val(transCode);
      }

      if(vrdate){
        $('#getTransDate').val(vrdate);
      }

      if(series){
        $('#getSeriesCode').val(series);
      }

      if(account_code){
        $('#getAccCode').val(account_code);
        $('#getcosine').val(account_code);
      }

      if(Plant_code){
        $('#getPlantCode').val(Plant_code);
      }

      if(tax_code){
        $('#getTaxCode').val(tax_code);
      }

    
       objvalidtn.checkBlankFieldValid();

  });

/*window load*/


/*vr date*/



/*kamini*/

$("#account_code").bind('change', function () {
  var Acccode =  $(this).val();
  var xyz = $('#AccountList option').filter(function() {

    return this.value == Acccode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  $('#accicon').css("display", "block");
  $('#showicon').css("display", "none");

  if(msg=='No Match'){
     $(this).val('');
     $('#accountName').val('');
     document.getElementById("acccode_err").innerHTML = 'The Account code field is required.';
      $('#getAccCode').val('');
       $('#profitctrId').prop('readonly',true);
       $('#due_days').prop('readonly',true);
       //$('#appndplantbtn').empty();
       $('#appndplantbtn1').hide();
       $('#accountNameTooltip').addClass('tooltiphide');
       $('#enquiryNum').val('');
       $('#itmCountchk').val('');
       $('#getEnquiryNo').val('');
       $('#stateOfAcc').val('');
       $('#enquirynoList').hide();
  }else{
    $('#accountName').val(msg);

    $('#accountNameTooltip').removeClass('tooltiphide');

    $('#accountNameTooltip').html(msg);

     document.getElementById("acccode_err").innerHTML = '';
     var AccountCode = $('#account_code').val();
     var vrseqnum = $('#vrseqnum').val();
     var transcode = $('#transcode').val();
     $('#getAccCode').val(AccountCode);
     $('#getVrNo').val(vrseqnum);
     $('#getTransCode').val(transcode);
     $('#profitctrId').prop('readonly',false);
      $('#account_code').css('border-color','#d2d6de');

      $('#accicon').css("display", "none");

  // $('#appndplantbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getplantdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
 
  }

   objvalidtn.checkBlankFieldValid();

});










function rfheadget(rfhid){
   var headval =  $('#rfhead'+rfhid).val();
   if(headval){
      $('#getrfhead'+rfhid).val(headval);
   }else{
    $('#getrfhead'+rfhid).val('');
   }
}




/*kamini*/



function onkey(event){

   var qty = $("#qty"+event).val();
  if(qty==''){
    $("#tds_rate"+event).prop("disabled", true);
  }
}