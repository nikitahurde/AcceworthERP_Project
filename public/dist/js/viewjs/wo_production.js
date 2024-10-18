var objvalidtn = new jsController();
/*on window load*/

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

    var vr_date = $('#vr_date').val();
    var series_code = $('#series_code').val();
    var series_name = $('#seriesName').val();
    var profitctrId = $('#profitctrId').val();
    var account_code = $('#account_code').val();
    var Plant_code = $('#Plant_code').val();
    var transcode = $('#transcode').val();
    var vrseqnum = $('#vrseqnum').val();
    var headid = $('#headid').val();

 //   alert(headid);

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

    if(series_code){
        $('#getSeriesCode').val(series_code);
    }

    if(series_name){
        $('#getSeriesName').val(series_name);
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

    objvalidtn.checkBlankFieldValidation();


});

/*on window load*/

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

        
      $('#ItemCodeId1').prop('readonly',true);
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

      dueDays = parseInt($('#due_days').val());

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

        
        objvalidtn.checkBlankFieldValidation();

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

   if(Acccode==''){
  
     $('#account_code').css('border-color','#d2d6de');
     $('#cost_center_code').css('border-color','#d2d6de');
     $('#account_code').css('border-color','#ff0000').focus();
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#account_code').css('border-color','#d2d6de');
      $('#cost_center_code').css('border-color','#ff0000').focus();
     // $('#asset_code').css('border-color','#ff0000').focus();
     }
  var xyz = $('#AccountList option').filter(function() {

    return this.value == Acccode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  //$('#appndplantbtn').empty();
  
 $('#appndaccbtn').empty();

  if(msg=='No Match'){
     $(this).val('');
     $('#accountName').val('');
     document.getElementById("acccode_err").innerHTML = 'The Account code field is required.';
      $('#getAccCode').val('');
      $('#emplList').empty();
      $('#emp_code').val('');
      $('#empName').html('');
      $('#emplyeeName').val('');
      $('#accountNameTooltip').css('display','none');
      $('#accountNameTooltip').html('');
      $('#accicon').css("display", "block");
      $('#appndaccbtn').empty();
  }else{
    $('#accountName').val(msg);
    $('#getAccName').val(msg);
    $('#accountNameTooltip').css('display','block');
    $('#accountNameTooltip').html(msg);
     $('#showicon').css("display", "none");
     document.getElementById("acccode_err").innerHTML = '';
     var AccountCode = $('#account_code').val();
     var vrseqnum = $('#vrseqnum').val();
     var transcode = $('#transcode').val();
     $('#getAccCode').val(AccountCode);
     $('#getVrNo').val(vrseqnum);
     $('#getTransCode').val(transcode);
     $('#accicon').css("display", "none");

    $('#appndaccbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getplantdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');

    
  }

   objvalidtn.checkBlankFieldValidation();

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
   ///  alert(plntCode);
     $('#getPlantCode').val(plntCode);
     $('#getPlantName').val(msg);
     $('#planticon').hide();

     $('#appndplantbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getplantdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
    
  }
  
   objvalidtn.checkBlankFieldValidation();

});

$("#series_code").bind('change', function () {
  var Seriescode =  $(this).val();
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
      $('#getSeriesName').val('');
      $('#serisicon').show();
  }else{
    $('#seriesName').val(msg);
     document.getElementById("series_code_errr").innerHTML = '';
     var sers_code = $('#series_code').val();
     $('#getSeriesCode').val(sers_code);
     $('#getSeriesName').val(msg);
     $('#serisicon').hide();
     /*$('#appndbtn').append('<button type="button" data-toggle="modal" data-target="#series_detail" onclick="getcode()" style="background-color:#5eb1f9;border-color: #5eb1f9;"><i class="fa fa-info" aria-hidden="true"></i></button>');*/
     $('#appndbtn').append('<button type="button"  data-toggle="modal" data-target="#series_detail" onclick="getcode()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');


  }

   objvalidtn.checkBlankFieldValidation();

});

$("#fg_code").bind('change', function () {
  var Seriescode =  $(this).val();
  var xyz = $('#fgList1 option').filter(function() {

    return this.value == Seriescode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

    $('#appndbtn').empty();
    $('#serisicon').show();
  
  if(msg=='No Match'){
     $(this).val('');
     $('#seriesName').val('');
      document.getElementById("fg_code_errr").innerHTML = 'The Series code field is required.';
      $('#Plant_code').prop('readonly',true);
      $('#account_code').prop('readonly',true);
      $('#due_days').prop('readonly',true);
      $('#getSeriesCode').val('');
      $('#serisicon').show();
  }else{
    $('#fg_name').val(msg);
     document.getElementById("fg_code_errr").innerHTML = '';
     var fg_code = $('#fg_code').val();
     $('#getFgCode').val(fg_code);
     $('#getFgName').val(msg);
     $('#serisicon').hide();
     /*$('#appndbtn').append('<button type="button" data-toggle="modal" data-target="#series_detail" onclick="getcode()" style="background-color:#5eb1f9;border-color: #5eb1f9;"><i class="fa fa-info" aria-hidden="true"></i></button>');*/
     $('#appndbtn').append('<button type="button"  data-toggle="modal" data-target="#series_detail" onclick="getcode()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');


  }

   objvalidtn.checkBlankFieldValidation();

});


$("#emp_code").bind('change', function () {
  var empcode =  $(this).val();
  var xyz = $('#emplList option').filter(function() {

    return this.value == empcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
     $('#empName').html('');
     $('#emplyeeName').val('');
  }else{
    $('#empName').html(msg);
    $('#emplyeeName').val(empcode);
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


