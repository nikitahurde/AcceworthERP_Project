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
      var plant_code = $('#Plant_code').val();

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
        var seriecCdoe = series.split('[');
        $('#getSeriesCode').val(seriecCdoe[0]);
      }

      if(account_code){
        var accCde = account_code.split('[');
        $('#getAccCode').val(accCde[0]);
      }

      if(plant_code){
         var plantCde = plant_code.split('[');
        $('#getPlantCode').val(plantCde[0]);
      }

      if(tax_code){
        $('#getTaxCode').val(tax_code);
      }

    
       objvalidtn.checkBlankFieldValid();

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

     objvalidtn.checkBlankFieldValid();


});

$("#series_code").bind('change', function () {
      console.log('hi');
      var Seriescode =  $(this).val();
      var xyz = $('#seriesList1 option').filter(function() {

        return this.value == Seriescode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      
        console.log('msg',msg);
      if(msg=='No Match'){
         $(this).val('');
         $('#getSeriesCode').val('');
      }else{
         $('#series_code').val(Seriescode+'[ '+msg+' ]');
         $('#getSeriesCode').val(Seriescode);
      }

    objvalidtn.checkBlankFieldValid();
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

$("#account_code_sale").bind('change', function () {
  var Acccode =  $(this).val();
  alert(Acccode);return false;
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
     $('#account_code').val(Acccode+' [ '+msg+' ] ');
     $('#accicon').css("display", "none");

     $('#appndplantbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getplantdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
  // $('#appndplantbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getplantdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
 
  }

   objvalidtn.checkBlankFieldValid();

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
  }else{
    $('#pfctName').val(msg);
     document.getElementById("profit_center_err").innerHTML = '';
     var pfctcode = $('#profitctrId').val();
     $('#getPfctCode').val(pfctcode);
   
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
      document.getElementById("plant_err").innerHTML = 'The Plant code field is required.';
      
      $('#getPlantCode').val('');
     
  }else{
    var plntCode = $('#Plant_code').val();
     $('#getPlantCode').val(plntCode);
     $('#Plant_code').val(Plantcode+' [ '+msg+' ]');
     



  }

   objvalidtn.checkBlankFieldValid();

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
      //$('#ItemCodeId1').prop('readonly',true);
      $('#getTaxCode').val('');
  }else{
     document.getElementById("Taxcode_errr").innerHTML = '';
     var Tx_Code = $('#tax_code').val();
     $('#getTaxCode').val(Tx_Code);
      //$('#ItemCodeId1').prop('readonly',false);
      $('#due_days').prop('readonly',false);
  }

   objvalidtn.checkBlankFieldValid();

});

function CalAQty(quantityId){
    var quantity = $('#qty'+quantityId).val();
    var cfactor = $('#Cfactor'+quantityId).val();
    var rate = $('#rate'+quantityId).val();
    var exitqty = $('#existQty'+quantityId).val();
    var total = quantity * cfactor;
   // console.log(total);
    $('#A_qty'+quantityId).val(total.toFixed(3));

    if(quantity){
      $('#rate'+quantityId).prop('readonly',false);
    }else{
       $('#rate'+quantityId).prop('readonly',true);
    }
    

    if(quantity && rate){
      var basicAmt = quantity * rate;
      $('#basic'+quantityId).val(basicAmt);
    }

    var rowcount = $('#data_count'+quantityId).val();

    if(rowcount !=0){
          $('#data_count'+quantityId).val(0);
          $('#get_grand_num'+quantityId).val('');

          $('#appliedbtn'+quantityId).html('');
         
           var cnclbtn ='<input type="hidden" value="0" id="qltyvalue'+quantityId+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

          $('#cancelbtn'+quantityId).html(cnclbtn);

          var amnttotl =0;
           $(".setGrandAmnt").each(function () {
              //add only if the value is number
              if (!isNaN(this.value) && this.value.length != 0) {
                  amnttotl += parseFloat(this.value);
              }

            $("#allgrandAmt").val(amnttotl.toFixed(2));

          }); 

          var dataCl =0;
           $(".dataCountCl").each(function () {
              //add only if the value is number
              if (!isNaN(this.value) && this.value.length != 0) {
                  dataCl += parseFloat(this.value);
              }

            $("#allgetMCount").val(dataCl.toFixed(2));

          });

          var btotal =0;

            $(".basicamt").each(function () {
               
              if (!isNaN(this.value) && this.value.length != 0) {
                  btotal += parseFloat(this.value);
              }

            $("#basicTotal").val(btotal.toFixed(2));

          });


        var grandTotal = parseFloat($('#allgrandAmt').val());
        var basicTotal = parseFloat($('#basicTotal').val());

        if(grandTotal == '0.00'){
          var othrAmt = 0;
          $('#otherTotalAmt').val(othrAmt.toFixed(2));
        }else{

          var otherTotal = grandTotal - basicTotal;

          $('#otherTotalAmt').val(otherTotal.toFixed(2));
        }

        

    }


    var total =0;

      $(".basicamt").each(function () {
         
        if (!isNaN(this.value) && this.value.length != 0) {
            total += parseFloat(this.value);

        }

        $("#basicTotal").val(total.toFixed(2));

      });

      var grTotal =0;

      $(".setGrandAmnt").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            grTotal += parseFloat(this.value);
        }

        $("#allgrandAmt").val(grTotal.toFixed(2));

      }); 

        var grandTotalA = parseFloat($('#allgrandAmt').val());
        var basicTotalA = parseFloat($('#basicTotal').val());


        //var otherTotalA = grandTotalA - basicTotalA;
        

       // $('#otherTotalAmt').val(otherTotalA.toFixed(2));

    
    
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