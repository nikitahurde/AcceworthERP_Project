var objvalidtn = new jsController();
//var root = window.location.protocol + '//' + window.location.host;
//var folderName = 'biztechERP_DEV';
var link = window.location.href;
var getseperate = link.split('/');

var folderName = getseperate[0]+'//'+getseperate[2]+'/'+getseperate[3];

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

    var vr_date         = $('#vr_date').val();
    var series_code     = $('#series_code').val();
    var profitctrId     = $('#profitctrId').val();
    var account_code    = $('#account_code').val();
    var Plant_code      = $('#Plant_code').val();
    var transcode       = $('#transcode').val();
    var vrseqnum        = $('#vrseqnum').val();
    var headid          = $('#headid').val();
    var tax_code        = $('#tax_code').val();
    var partyRefDate    = $('#party_ref_date').val();
    var seriescode_sale = $('#series_code_sale').val();
    var plantcode_sale  = $('#Plant_code_sale').val();
    var saleRep_sale    = $('#sale_rep_code').val();
    var costCent_sale   = $('#costCent_code_sale').val();
    var shipAdd         = $('#shipTAddr').val();
    

    if(seriescode_sale){
      var seriesCd = seriescode_sale.split('[');
    }else{}

    if(plantcode_sale){
      var plantCd = plantcode_sale.split('[');
    }else{}

    if(saleRep_sale){
      var saleRpCd = saleRep_sale.split('[');
    }else{}

    if(costCent_sale){
      var costctCd = costCent_sale.split('[');
    }else{}

    if(saleRep_sale){
      $('#gateSaleRep').val(saleRpCd[0]);
    }

    if(headid){
      
      $('#head_id').val(headid);
      $("#orderheadid").val(headid);
      $("#headQtnId").val(headid);
    }

    if(transcode){
        $('#getTransCode').val(transcode);
    }

    if( vrseqnum){
        $('#getVrNo').val(vrseqnum);
    }

    if(vr_date){
      $('#getTransDate').val(vr_date);
    }

    if(series_code){
        $('#getSeriesCode').val(series_code);
    }
    if(seriescode_sale){
        $('#getSeriesCode').val(seriesCd[0]);
    }

    if(profitctrId){
        $('#getPfctCode').val(profitctrId);
    }

    if(account_code){
        $('#getAccCode').val(account_code);
        $('#getcosine').val(account_code);
    }

    if(Plant_code){
        $('#getPlantCode').val(Plant_code);
    }

    if(plantcode_sale){
        $('#getPlantCode').val(plantCd[0]);
    }

    if(tax_code){
      $('#getTaxCode').val(tax_code);
    }

    if(partyRefDate){
      $('#getpartyrfDate').val(partyRefDate);
    }

    if(costCent_sale){
      $('#gateCostCenter').val(costctCd[0]);
    }



    objvalidtn.checkBlankFieldValidation();


});

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

    if(transDate){
      $('#err_datemsg').html('');
    }else{
      $('#err_datemsg').html('The Date field is required.');
    }
        
    if(selectedDate > todayDate){
      $('#showmsgfordate').html('Transaction Date Can Not Be Greater Than Today').css('color','red');
        $('#vr_date').val('');
        $('#getTransDate').val('');
        $('#due_date').val('');
        $('#gateduedate').val('');
        $('#get_due_date').val('');
        $('#gateduedays').val('');
        $('#due_days').val('');

        return false;

    }else{
      $('#showmsgfordate').html('');
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
              $("#gateduedate").val('');
              $("#get_due_date").val('');
               $('#due_days').css('border-color','#ff0000').focus();
               $('#gateduedays').val('');
            }else{

            $("#due_date").val(duedate);
            $('#gateduedate').val(duedate);
            $('#get_due_date').val(duedate);
            $('#gateduedays').val(dueDays);
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
          $('#get_due_date').val('');
          $('#gateduedays').val('');
          //$('#ItemCodeId1').prop('readonly',true);
        } 
      return true;
    }

     objvalidtn.checkBlankFieldValid();
});

$("#account_code").bind('change', function () {
  var Acccode =  $(this).val();
  
  var xyz = $('#AccountList option').filter(function() {

    return this.value == Acccode;

  }).data('xyz');

  //alert(Acccode);
 // console.log('xyz',xyz);
  //console.log('Acccode',Acccode);

  var msg = xyz ?  xyz : 'No Match';
  $('#accicon').css("display", "block");
  $('#showicon').css("display", "none");
  $('#appndplantbtn').empty();
  if(msg=='No Match'){
     $('#account_code').val('');
     $('#accountName').val('');
     document.getElementById("acccode_err").innerHTML = 'The Account code field is required.';
      $('#getAccCode').val('');
      $('#getAcc_Name').val('');
      $('#getdeptName').val('');
      $('#emplList').empty();
      $('#emp_code').val('');
      $('#empName').html('');
      $('#emplyeeCode').val('');
      $('#emplyeeName').val('');
      $('#AccountText').val('');
      $('#accountNameTooltip').addClass('tooltiphide');
      $('#appndplantbtn').hide();
      $('#contractNo').val('');
      $('#getcontractNo').val('');
      $('#due_days').val('');
      $('#due_date').val('');
      $('#party_rf_no').val('');
      $('#party_ref_date').val('');
      $("#purOrdervrno").val('');
      $("#pur_order_no").val('');
      $("#gateduedate").val('');
      $("#get_due_date").val('');
      $("#gateduedays").val('');
      $('#getcosine').val('');
      $('#stateOfAcc').val('');
      $('#levelget').val('');
      $('#Quotn_compare_no').val('');
      $('#getQuotatnNo').val('');
      $('#itmCountchk').val('');
      $('#qtnCompList').empty();
      $('#TaxcodeList').empty();
      $('#tax_code').val('');
      $('#appndplantbtn1').hide();
      $('#enquiryNum').val('');
      $('#getEnquiryNo').val('');
      $('#shipTAddr').val('');
      $('#gateconsAdd').val('');
      $('#quoComp_no').val('');
      $('#enquirynoList').hide();

       var prevNp    =  $('#Quotn_compare_no').val();
       var pOrdervrno    =  $('#purOrdervrno').val();

       if(prevNp || pOrdervrno){
          $('#Item_CodeId1').removeClass('itmbyQc');
          $('#Item_CodeId1').removeClass('showhideItm');
          $('#ItemCodeId1').css('display','none');
      }else{
          $('#Item_CodeId1').addClass('itmbyQc');
          $('#Item_CodeId1').addClass('showhideItm');
          $('#ItemCodeId1').css('display','block').prop('readonly',false);
      }

  }else{

    $('#Item_CodeId1').addClass('itmbyQc');
    $('#Item_CodeId1').addClass('showhideItm');
          $('#ItemCodeId1').css('display','block').prop('readonly',false);
    //console.log('msg',msg);
    $('#shipTAddr').val('');
    $('#contractNo').val('');
    $('#gateconsAdd').val('');
    $('#quoComp_no').val('');
    $('#accountName').val(msg);
    $('#AccountText').val(msg);
    $('#getdeptName').val(msg);
    $('#getAcc_Name').val(msg);
     document.getElementById("acccode_err").innerHTML = '';
     var AccountCode = $('#account_code').val();
     var transcode = $('#transcode').val();
     $('#getAccCode').val(AccountCode);
     $('#getTransCode').val(transcode);
     $('#accountNameTooltip').removeClass('tooltiphide');
     $('#accountNameTooltip').html(msg);
     $('#getcosine').val(AccountCode);
     $('#accicon').css("display", "none");
     $('#appndplantbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getaccdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
     $('#appndplantbtn').show();
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
      $('#getpartyrfDate').val(party_rfno);
      return true;
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
     $('#plantname').val(''); 
     $('#getPlantName').val(''); 
      document.getElementById("plant_err").innerHTML = 'The Plant code field is required.';
      
      $('#getPlantCode').val('');
      $('#getStateByPlant').val('');
      $('#profitctrId').val('');
      $('#pfctName').val('');
     
  }else{
     document.getElementById("plant_err").innerHTML = '';
     $('#plantname').val(msg);
     $('#getPlantName').val(msg);
     $('#plantText').val(msg);
     var plntCode = $('#Plant_code').val();
     $('#getPlantCode').val(plntCode);
     $('#planticon').hide();
  }

   objvalidtn.checkBlankFieldValid();

    var Plant_code =  $(this).val(); 

    var pfctgetUrl = folderName+'/Get-Pfct-Code-Name-By-Plant';

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $.ajax({

      url:pfctgetUrl,

      method : "POST",

      type: "JSON",

      data: {Plant_code: Plant_code},

      success:function(data){

        var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){
            //console.log('data1.data[0]',data1.data[0]);
            console.log('data1.data',data1.data);
            if(data1.data == ''){
                 var profitctr = '';
                 var pfctget = '';
                 var pfctName = '';
                 var statec = '';
                 $('#profitctrId').val(profitctr);
                 $('#pfctName').val(pfctName);
                 $('#profitText').val(pfctName);
                 $('#getPfctName').val(pfctName);
                 $('#getPfctCode').val(pfctget);
                 $('#getStateByPlant').val(statec);
              }else{
                $('#profitctrId').val(data1.data[0].PFCT_CODE);
                $('#pfctName').val(data1.data[0].PFCT_NAME);
                $('#profitText').val(data1.data[0].PFCT_NAME);
                $('#getPfctName').val(data1.data[0].PFCT_NAME);
                $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                $('#getStateByPlant').val(data1.data[0].STATE_CODE);

              }

          }

      }

    });

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
     $('#getSeriesName').val('');
      document.getElementById("series_code_errr").innerHTML = 'The Series code field is required.';
      $('#tax_code').prop('readonly',true);
      $('#getSeriesCode').val('');
      $('#getGlCode').val('');
      $('#vrseqnum').val('');
      $('#getVrNo').val('');
  }else{
    $('#seriesName').val(msg);
    $('#getSeriesName').val(msg);
    $('#seriesText').val(msg);
    $('#seriesGl').val('');
     document.getElementById("series_code_errr").innerHTML = '';
     var sers_code = $('#series_code').val();
     $('#getSeriesCode').val(sers_code);
      $('#tax_code').prop('readonly',false);

  }

   objvalidtn.checkBlankFieldValid();

});

$("#shipTAddr").bind('change', function () {

  var ship_Add = $('#shipTAddr').val()
  var xyz = $('#shipTAdd option').filter(function() {
      return this.value == ship_Add;
  }).data('xyz');
  var msg = xyz ? xyz : 'No Match';

  if(msg=='No Match'){
        $('#shipTAddr').val('');
        $('#stateOfAcc').val('');
        $('#tax_code').val('');
        $('#gateconsAdd').val('');
        $('#TaxcodeList').empty();
        $('#addId').val('');
        $('#getcpCode').val('');
  }else{

      $('#gateconsAdd').val(ship_Add);
      $('#addId').val(msg);
      $('#getcpCode').val(msg);
  }

    var addId     = $('#addId').val();
    var account_code = $('#account_code').val();
    var plstateCode  =  $('#getStateByPlant').val();
    console.log('addId',addId);
    console.log('account_code',account_code);
    console.log('plstateCode',plstateCode);
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var st_dataUrl = folderName+'/get-data-by-acc-code-in-trans';
    $.ajax({
      url:st_dataUrl,
      method : "POST",
      type: "JSON",
      data: {addId: addId,account_code:account_code,plstateCode:plstateCode},

      success:function(data){
        var data1 = JSON.parse(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){

            if(data1.getStateCode ==''){

            }else{
             $('#stateOfAcc').val(data1.getStateCode.STATE_CODE);
            }

            if(data1.get_taxCode == ''){

            }else{
              $("#TaxcodeList").empty();
              $.each(data1.get_taxCode, function(k, getTAX){

               
                $("#TaxcodeList").append($('<option>',{

                  value:getTAX.TAX_CODE,

                  'data-xyz':getTAX.TAX_NAME,
                  text:getTAX.TAX_NAME+' ['+getTAX.TAX_CODE+']'

                }));

              }); 
            }
        }

      }

    });
  

  /*var shipToAdd =  $('#shipTAddr').val();
  console.log(shipToAdd);
  var xyz = $('#shipTAdd option').filter(function() {
    console.log('xyz',xyz);
    console.log('this.value',this.value);
    return this.value == shipToAdd;

  }).data('xyz');
  
 var msg = xyz ? xyz : 'No Match';

  alert('msg',msg);

  if(msg=='No Match'){
        // $(this).val('');
        $('#stateOfAcc').val('');
        $('#tax_code').val('');
        $('#gateconsAdd').val('');
        $('#TaxcodeList').empty();
  }else{

      $('#gateconsAdd').val(shipToAdd);
  }
*/
   objvalidtn.checkBlankFieldValid();

});


$("#trpt_code").bind('change', function () {
  var trptL =  $(this).val();
  var xyz = $('#trptList option').filter(function() {

    return this.value == trptL;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
        $(this).val('');
        $('#trpt_name').val('');
        $('#gettrpt_name').val('');
        $('#gettrpt_code').val('');
  }else{

      $('#trpt_name').val(msg);
      $('#gettrpt_name').val(msg);
      $('#gettrpt_code').val(trptL);
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
      $('#Taxcode_name').html('');
  }else{
     document.getElementById("Taxcode_errr").innerHTML = '';
     var Tx_Code = $('#tax_code').val();
     $('#getTaxCode').val(Tx_Code);
      $('#Taxcode_name').html(msg);
      $('#due_days').prop('readonly',false);
  }

   objvalidtn.checkBlankFieldValid();

});

$("#contractNo").bind('change', function () {
  var contraNo =  $(this).val();
  var xyz = $('#contractNoList option').filter(function() {

    return this.value == contraNo;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';
  console.log('msg',msg);
  if(msg=='No Match'){
     $(this).val('');
     $('#getcontractNo').val('');
     $('#tax_code').val('');
     $('#tax_code').prop('readonly',false);
     $('#due_days').prop('readonly',false);
     $('#quotationNo').prop('readonly',false);
     $('#Item_CodeId1').addClass('itmbyQc');
     $('#Item_CodeId1').addClass('showhideItm');
     $('#ItemCodeId1').css('display','block').prop('readonly',false);
     $('#party_rf_no').prop('readonly',false);
     $('#party_ref_date').prop('disabled',false);
  }else{
     $('#getcontractNo').val(contraNo);
     $('#party_rf_no').prop('readonly',false);
     $('#party_ref_date').prop('disabled',false);
  }

});


$("#transcode").bind('change', function () {
  var tcode =  $(this).val();
  var xyz = $('#transCList option').filter(function() {

    return this.value == tcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';
  //console.log('msg',msg);

  if(msg=='No Match'){
     $(this).val('');
     $('#getTransCode').val('');
     $('#getVrNo').val('');
     $('#vrseqnum').val('');
     $('#series_code').val('');
    // $('#Taxcodenamesh').html('');
     $('#seriesList1').empty();
  }else{
    $('#getTransCode').val(tcode);
    //$('#Taxcodenamesh').html(msg);
  }

});


$("#quotationNo").bind('change', function () {
  var quoNo =  $(this).val();
  var xyz = $('#quotationNoList option').filter(function() {

    return this.value == quoNo;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
     $('#tax_code').val('');
     $('#getquotionNo').val('');
     $('#Item_CodeId1').addClass('itmbyQc');
     $('#Item_CodeId1').addClass('showhideItm');
     $('#ItemCodeId1').css('display','block').prop('readonly',false);
  }else{
     $('#getquotionNo').val(quoNo);
  }

});


$('#due_days').on('input',function(){
      
    var dueDays = parseInt($('#due_days').val());

    var tcode =$('#transcode').val();
    var vrno =$('#vrseqnum').val();

    if(tcode){

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
          $('#get_due_date').val('');
          $('#gateduedays').val('');
        }else{

          $("#due_date").val(duedate);
          $('#gateduedays').val(dueDays);
          $('#gateduedate').val(duedate);
          $('#get_due_date').val(duedate);
          //$("#ItemCodeId1").prop('readonly',false);
          $("#enquiryno1").prop('readonly',false);
          $('#due_days').css('border-color','#d2d6de');

        }

        if (/\D/g.test(this.value))
        {
          // Filter non-digits from input value.
          this.value = this.value.replace(/\D/g, '');
        }
        $('#dueDays_err').html('');
        $('#due_days').css('border-color','#d2d6de');
      }else{
        $('#due_date').val('');
        $('#gateduedate').val('');
        $('#get_due_date').val('');
        $('#gateduedays').val('');
       // $('#ItemCodeId1').prop('readonly',true);
        $('#due_days').css('border-color','#ff0000').focus();
        $('#dueDays_err').html('The Due Days field is required.');
      } 

    }else{

     // $('#vrnoBlnkErr').html('Vr No Is Not Genr').css('color','red');
      $('#tcodeErr').html('T Code Is Required').css('color','red');
      $('#due_days').val('')

    }

    if((tcode == 'T0') || (tcode == 'P0') || (tcode == 'P1') || (tcode == 'P2') || (tcode == 'P3') || (tcode == 'P4') || (tcode == 'W1') || (tcode == 'P5')){
      objvalidtn.checkBlankFieldValid();
    }else if((tcode == 'S0') || (tcode == 'S1') || (tcode == 'S2') || (tcode == 'S3') || (tcode == 'S4')  || (tcode == 'S5')){
      objvalidtn.checkBlankFieldValid_Sale();
    }
    
 
});

function dueDaysCal(){

  var dueDays = parseInt($('#due_days').val());

    var tcode   = $('#transcode').val();
    var vrno    = $('#vrseqnum').val();

    if(tcode){

      if(dueDays){

        var vr_date     = $('#vr_date').val();
        var explodeDate = vr_date.split('-');
        var expDate     = explodeDate[0];
        var expMonth    = explodeDate[1];
        var expYear     = explodeDate[2];
        var mergeDate   = expMonth+'-'+expDate+'-'+expYear;
        var getduedate  = new Date(mergeDate);

        getduedate.setDate(getduedate.getDate() + dueDays); 
        var getdate  = getduedate.getDate();
        var getMonth = getduedate.getMonth()+1;
        var getYear  = getduedate.getFullYear();
        var duedate1 = getYear+'-'+getMonth+'-'+getdate;

        var d  = new Date(duedate1);
        var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
        var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

        var duedate =da+'-'+mo+'-'+getYear;

        if(isNaN(dueDays)){
          
          $("#due_date").val('');
          $('#due_days').css('border-color','#ff0000').focus();
          $('#gateduedate').val('');
          $('#get_due_date').val('');
          $('#gateduedays').val('');
        }else{

          $("#due_date").val(duedate);
          $('#gateduedays').val(dueDays);
          $('#gateduedate').val(duedate);
          $('#get_due_date').val(duedate);
          //$("#ItemCodeId1").prop('readonly',false);
          $("#enquiryno1").prop('readonly',false);
          $('#due_days').css('border-color','#d2d6de');

        }

          if (/\D/g.test(this.value))
          {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
          }
          $('#dueDays_err').html('');
          $('#due_days').css('border-color','#d2d6de');
        }else{
          $('#due_date').val('');
          $('#gateduedate').val('');
          $('#get_due_date').val('');
          $('#gateduedays').val('');
         // $('#ItemCodeId1').prop('readonly',true);
          $('#due_days').css('border-color','#ff0000').focus();
          $('#dueDays_err').html('The Due Days field is required.');
        } 

    }else{

     // $('#vrnoBlnkErr').html('Vr No Is Not Genr').css('color','red');
      $('#tcodeErr').html('T Code Is Required').css('color','red');
      $('#due_days').val('')

    }

    if((tcode == 'T0') || (tcode == 'P0') || (tcode == 'P1') || (tcode == 'P2') || (tcode == 'P3') || (tcode == 'P4') || (tcode == 'W1') || (tcode == 'P5')){
      objvalidtn.checkBlankFieldValid();
    }else if((tcode == 'S0') || (tcode == 'S1') || (tcode == 'S2') || (tcode == 'S3') || (tcode == 'S4')  || (tcode == 'S5')){
      objvalidtn.checkBlankFieldValid_Sale();
    }
  
}

$('#nextbtn').on('click',function(){
    $('.nav-tabs #firstTab').removeClass('active');
    $('#tab1info').removeClass('in active');
   // / $('#basicInfo').attr("aria-expanded","false");
    $('.nav-tabs #secondTab').addClass('active');
    $('#tab2info').addClass('in active');

});

$('#previousbtn').on('click',function(){
    $('.nav-tabs #secondTab').removeClass('active');
    $('#tab2info').removeClass('in active');

    $('.nav-tabs #firstTab').addClass('active');
    $('#tab1info').addClass('in active');
});



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


$('#vendor_qc_name').on('input',function(){
   var vendorQcName =  $('#vendor_qc_name').val();
   if(vendorQcName){
    $('#getvendorqcname').val(vendorQcName);
   }else{
    $('#getvendorqcname').val('');
   }
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
     $('#emplyeeCode').val('');
     $('#emplyeeName').val('');
  }else{
    $('#empName').html(msg);
    $('#emplyeeName').val(msg);
    $('#emplyeeCode').val(empcode);
  }

});

 $("#costCent_code").bind('change', function () {
    
      var costcenter =  $("#costCent_code").val();
     // console.log('costcenter',costcenter);
      var xyz = $('#Costcode_List option').filter(function() {

        return this.value == costcenter;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $("#costCent_code").val('');
         $("#gateCostCenter").val('');
         $("#gateCostCenterName").val('');
         $("#costcenName").val('');
         $('#Costcentr_err').html('The Cost Center field is required.').css('color','red');
      }else{
         $('#gateCostCenter').val(costcenter);
         $('#costCent_code').val(costcenter);
         $('#costcenName').val(msg);
         $('#gateCostCenterName').val(msg);
         $('#Costcentr_err').html('');
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

$('#vehical_no').on('input',function(){
  var vehivalNo = $('#vehical_no').val();
  $('#getvehicalNo').val(vehivalNo);
});

$('#lrNo').on('input',function(){
  var lrNo = $('#lrNo').val();
  $('#getlrno').val(lrNo);
});

$('#eWayBilN').on('input',function(){
  var ewayBilNo = $('#eWayBilN').val();
  $('#getEWayBilNo').val(ewayBilNo);
});

function taxSelectn(rowId){

    var taxCSelect= $("input[type='radio'][name='taxcodeit']:checked").val();
    if(taxCSelect){
      $('#taxslOkBtn'+rowId).prop('disabled',false);
      $('#taxSelErr'+rowId).html('');
    }else{
      $('#taxslOkBtn'+rowId).prop('disabled',true);
      $('#taxSelErr'+rowId).html('Please Select Tax Code');
    }
  }

function CalAQty(quantityId){

  $("#yrOpQtyShModel"+quantityId).modal({
        show:false,
        backdrop:'static',
      });

  $('#aplytaxOrNot'+quantityId).html('0');
  $('#get_grand_num'+quantityId).val('');
  $('#appliedbtn'+quantityId).html('');
  var cnclbtn ='<input type="hidden" value="0" id="qltyvalue'+quantityId+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';
  $('#cancelbtn'+quantityId).html(cnclbtn);

    var quantity = parseFloat($('#qty'+quantityId).val());

    var cfactor = $('#Cfactor'+quantityId).val();

    var tolpervalue =  $('#tolpervalue'+quantityId).val();
    
    var rate = $('#rate'+quantityId).val();
    var total = quantity * cfactor;
    $('#A_qty'+quantityId).val(total.toFixed(3));

    if(quantity){
      $('#rate'+quantityId).prop('readonly',false);
      $('#tolranceshow'+quantityId).prop('disabled',false);
    }else{
       $('#rate'+quantityId).prop('readonly',true);
       $('#tolranceshow'+quantityId).prop('disabled',true);
    }

    var stdRate =  $('#stdRateByItm'+quantityId).val();

    if(stdRate){
       var calstdRate =  quantity * stdRate;
       $('#std_rateitm'+quantityId).val(calstdRate);

        var strttotal =0;

        $(".stdRateAmtC").each(function () {
           
          if (!isNaN(this.value) && this.value.length != 0) {
              strttotal += parseFloat(this.value);
          }

          $("#totalStdRateAmt").val(strttotal.toFixed(2));

        });
    }

    if(quantity && rate){
      var basicAmt = quantity * rate;
      $('#basic'+quantityId).val(basicAmt);
    }

    var balenQty   = $('#balQtyByItem'+quantityId).val();
    var stockAvail = parseFloat($('#stock_Qty'+quantityId).val());
    var quan_tity  = parseFloat($('#qty'+quantityId).val());

    if(stockAvail && balenQty){
        if(stockAvail > balenQty){
          if((quantity > balenQty)){
            $('#grateQtyShModel'+quantityId).modal('show');
          }
        }else if(stockAvail < balenQty){
          if(quantity > stockAvail){
          $('#yrOpQtyShModel'+quantityId).modal('show');
            
          }
        }
    }else if(stockAvail && balenQty==''){
        if(quan_tity > stockAvail){
          $('#yrOpQtyShModel'+quantityId).modal('show');
        }else{
        }
    }else if(balenQty){ 
      if(quantity > balenQty){
      $('#grateQtyShModel'+quantityId).modal('show');
       var basicAmts = balenQty * rate;
        $('#basic'+quantityId).val(basicAmts.toFixed(2));
      }else{}
    }
    
    /*if(stockAvail){
        if(quantity > stockAvail){
          $('#yrOpQtyShModel'+quantityId).modal('show');
        }else{}
    }else if(balenQty){ 
      if(quantity > balenQty){
      $('#grateQtyShModel'+quantityId).modal('show');
       var basicAmts = balenQty * rate;
        $('#basic'+quantityId).val(basicAmts.toFixed(2));
      }else{}
    }*/

    var rowcount = $('#data_count'+quantityId).val();

    if(rowcount !=0){
         // $('#data_count'+quantityId).val(0);
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

}

function cancleGreatQty(cancleId){
  

  var balQtyByItem = $('#balQtyByItem'+cancleId).val();
  var cfactor = $('#Cfactor'+cancleId).val();
  var stockQtyA = $('#stockOpQty'+cancleId).html();

  if(balQtyByItem){
      var aqtyCal = balQtyByItem * cfactor;
      $('#qty'+cancleId).val(balQtyByItem);
      $('#A_qty'+cancleId).val(aqtyCal.toFixed(3));
  }else{
      $('#qty'+cancleId).val('');
      $('#A_qty'+cancleId).val('');
  }

  

  /*if(stockQtyA){
    $('#qty'+cancleId).val('');
    $('#A_qty'+cancleId).val('');
  }else{
    var aqtyCal = balQtyByItem * cfactor;
    $('#qty'+cancleId).val(balQtyByItem);
    $('#A_qty'+cancleId).val(aqtyCal.toFixed(3));
  }*/
  
}

function cancleDisGreatQty(cancleId){

  var balQtyByItem = $('#balQtyByItem'+cancleId).val();
  var cfactor = $('#Cfactor'+cancleId).val();
  var stockQtyA = $('#stockOpQty'+cancleId).html();
  var itemCode = $('#Item_CodeId'+cancleId).val();

  if(balQtyByItem){
      //var aqtyCal = balQtyByItem * cfactor;
      //$('#qty'+cancleId).val(balQtyByItem);
      //$('#A_qty'+cancleId).val(aqtyCal.toFixed(3));
      $('#qty'+cancleId).val('');
      $('#A_qty'+cancleId).val('');
      $('#Item_CodeId'+cancleId).val('');
      $('#Item_Name_id'+cancleId).val('');
      $('#remark_data'+cancleId).val('');
      $('#UnitM'+cancleId).val('');
      $('#selectItem'+cancleId).val('');
      $('#idsun'+cancleId).val('');
      $('#AddUnitM'+cancleId).val('');
      $('#rate'+cancleId).val('');  
      $('#basic'+cancleId).val('');
      $('#stock_Qty'+cancleId).val('');
      $('#hsn_code'+cancleId).val('');
      $('#taxByItem'+cancleId).val('');
      $('#taxratebytax'+cancleId).val('');
      $('#sc_transcode'+cancleId).val('');
      $('#sc_seriescode'+cancleId).val('');
      $('#sc_vrno'+cancleId).val('');
      $('#sc_slno'+cancleId).val('');
      $('#sc_headid'+cancleId).val('');
      $('#sc_bodyid'+cancleId).val('');
      $('#glByItem'+cancleId).val('');
      $('#glnameByItem'+cancleId).val('');
      $('#stdRateByItm'+cancleId).val('');
      $('#Cfactor'+cancleId).val('');
      $('#balQtyByItem'+cancleId).val('');
      $('#qnrate'+cancleId).val('');
      $('#std_rateitm'+cancleId).val('');
      $('#itmC_code'+cancleId).val('');
      $('#stockOpQty'+cancleId).html('');
      $('#showHsnCd'+cancleId).html('');

      var itmafterUncheck = $('#checkitm').val();
           
      var explodIUnChckTm = itmafterUncheck.split(',');

      const index = explodIUnChckTm.indexOf(itemCode);
      if (index > -1) {
        explodIUnChckTm.splice(index, 1);
      }

     $('#checkitm').val(explodIUnChckTm);

     calculateBasicAmt(cancleId);
     $('#viewItemDetail'+cancleId).addClass('showdetail');

  }else{
      $('#qty'+cancleId).val('');
      $('#A_qty'+cancleId).val('');
  }

}

function CalAQty_old(quantityId){
    $('#aplytaxOrNot'+quantityId).val(0);
    var quantity = $('#qty'+quantityId).val();
    var cfactor = $('#Cfactor'+quantityId).val();
    var rate = $('#rate'+quantityId).val();
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

}

function getGrandTotal(getid){

  setTimeout(function() {

    $('.modalspinner').addClass('hideloaderOnModl');

    totalAmount = 0;

    qunatity = $("#qty"+getid).val();
    var funtn;
    for(l=2;l<=12;l++){

        var rate = $("#rate_"+getid+"_"+l).val();   

        var indicator = $("#indicator_"+getid+"_"+l).val();

        //console.log('indicator',indicator);

        var logic = $("#logic_id_"+getid+"_"+l).val();
        var static = $("#static_id_"+getid+"_"+l).val();
        var glCode = $("#tax_gl_code_"+getid+"_"+l).val();

        if(logic == null){

        }else{ 

          if(logic.length >0 || logic.length ==0){

           indicatorCalculation(indicator,rate,logic,l,getid,glCode);

          }
        }

        if((static == 0)){

            $("#changeInd_"+getid+"_"+l).removeClass('showind_Ch');
            $("#indicator_"+getid+"_"+l).prop('readonly',true);

            if(indicator == 'N' || indicator == 'P' || indicator == 'O' || indicator == 'Q'){
              $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',true);
              $("#rate_"+getid+"_"+l).prop('readonly',false);
            }else if(indicator == 'L' || indicator == 'M'){
              $("#rate_"+getid+"_"+l).prop('readonly',true);
              $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',false);
            }

           
            
            
            

            /* if(indicator == 'L' || indicator == 'M'){

                   $("#indicator_"+getid+"_"+l).prop('readonly',true);
                   $("#rate_"+getid+"_"+l).prop('readonly',true);
                   $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',false);
                   $("#changeInd_"+getid+"_"+l).addClass('showind_Ch');
                   
              }*/
        }else{

             $("#indicator_"+getid+"_"+l).prop('readonly',true);
             $("#rate_"+getid+"_"+l).prop('readonly',true);
             $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',true);
             $("#changeInd_"+getid+"_"+l).addClass('showind_Ch');
        }

        if(indicator == 'R'){
            var amntF_R =  parseFloat(qunatity) * parseFloat(rate);

            $('#FirstBlckAmnt_'+getid+"_"+l).val(amntF_R);
        }else{}

        
      
    }

   

  }, 500);

  $('.modalspinner').removeClass('hideloaderOnModl');

} /*function close*/

function indicatorCalculation(indicator,rate,logic,l,incNum,glCode){

   
  var totalLogicVal = 0;

    if(logic.length >0){

      logicVal= "";

      for(j=1; j<=logic.length; j++)

      {

        k = logic.substring(j-1,j);

        var BlocValue = $("#FirstBlckAmnt_"+incNum+"_"+k).val();

        if(BlocValue!="")

          totalLogicVal = parseFloat(totalLogicVal) + parseFloat(BlocValue);

      }

    }

    if(indicator == 'A'){
      roundofrate= ((parseFloat(totalLogicVal) * rate)/100);
      roundof= Math.round(roundofrate) - parseFloat(totalLogicVal);
         $("#FirstBlckAmnt_"+incNum+"_"+l).val(roundof.toFixed(2));
 
    }

    if(indicator=="N"){

        amtMinus= -((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(amtMinus.toFixed(2));

    }

    var inde_M_amt = parseFloat($("#FirstBlckAmnt_"+incNum+"_"+l).val());
    
    if(isNaN(inde_M_amt)){
      indm = '';
      $("#FirstBlckAmnt_"+incNum+"_"+l).val(indm);
    }else{

      if(indicator=="M"){
        var lumMinus; 

        lumMinus= parseFloat($("#FirstBlckAmnt_"+incNum+"_"+l).val()); 

        if(lumMinus > 0){
          var indicatorMAmt1=  -(lumMinus);
        }else if(lumMinus < 0){
          var indicatorMAmt1=  (lumMinus);
        }
        // indicatorMAmt=  -(parseFloat(indicatorMAmt) +  amtMinus);
          indicatorMAmt = indicatorMAmt1;
         $("#FirstBlckAmnt_"+incNum+"_"+l).val(indicatorMAmt);

      }
    }


    if(indicator=="P"){

        addition = ((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(addition.toFixed(2));

    }

    if(indicator=="Q"){

       additionRoundOff = ((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(Math.round(additionRoundOff.toFixed(2)));

    }

    if(indicator=="Z"){

        subtotalview = ((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(subtotalview.toFixed(2));

    }

    
    if(indicator=="O"){

        deductionRoundOff = -((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(Math.round(deductionRoundOff.toFixed(2)));

    }

    var crAmt =0;
    if(l == 2){
      var basicAmt =$('#basic'+incNum).val();
      if(indicator == 'Z'){}else{

        if(glCode ==''){
          var amnt = $("#FirstBlckAmnt_"+incNum+"_"+l).val();
          if(amnt == ''){
            var calAmt = 0;
          }else{
            var calAmt = amnt;
          }
          crAmt = parseFloat(basicAmt)+parseFloat(calAmt);
          $("#cr_amtbytax_"+incNum).val(crAmt.toFixed(2));
        }
      }
    }else{
      if(indicator == 'Z'){}else{
        if(glCode ==''){
          var amntF = $("#FirstBlckAmnt_"+incNum+"_"+l).val();
          var crGet = $("#cr_amtbytax_"+incNum).val();
          if(amntF == ''){
            var cal_amt =0;
          }else{
            var cal_amt =amntF;
          }
         crAmtcal =  parseFloat(crGet)+parseFloat(cal_amt);
         $("#cr_amtbytax_"+incNum).val(crAmtcal.toFixed(2));
        }
      }
    }

} /*function close*/



function ind_forChange(rowid,countid){

    $('#indicatorShow_'+rowid+'_'+countid).modal('show');
    var already_ind = $('#indicator_'+rowid+'_'+countid).val();

    for(var w=1;w<=9;w++){

      var setInd = $('#cInd_'+rowid+'_'+countid+'_'+w).val();

        if(already_ind == 'N' || already_ind == 'O' || already_ind == 'P' || already_ind=='Q' || already_ind=='R'){
                if(setInd == 'L' || setInd == 'M' || setInd == 'Z' || setInd == 'A'){
                  $('#cInd_'+rowid+'_'+countid+'_'+w).prop('disabled',true);
                }
                
        }else if(already_ind == 'L' || already_ind == 'M'){
            if(setInd == 'N' || setInd == 'O' || setInd == 'P' || setInd=='Q' || setInd=='R' || already_ind == 'N' || setInd == 'Z' || setInd == 'A'){
              $('#cInd_'+rowid+'_'+countid+'_'+w).prop('disabled',true);
            }
        }

        if(setInd == already_ind){
          $('#cInd_'+rowid+'_'+countid+'_'+w).prop('checked',true);
        }

    }

}

function setIndOnOk(indid,indnmeid){

  var ind_value= $("input[type='radio'][name='chang_indval']:checked").val();
   //console.log('ind_value',ind_value);

  if(ind_value =='M' || ind_value == 'L'){
      $('#rate_'+indid+'_'+indnmeid).val(100).prop('readonly',true);
      $('#logic_id_'+indid+'_'+indnmeid).val('');
      $('#FirstBlckAmnt_'+indid+'_'+indnmeid).val('');
   
  }else{
       $('#rate_'+indid+'_'+indnmeid).prop('readonly',false);
  } 

  $('#indicator_'+indid+'_'+indnmeid).val(ind_value);

  $('#indicatorShow_'+indid+'_'+indnmeid).modal('hide');

} 

function getQuaPvalue(rowid,isApNot){

  if(isApNot==1){

      $('#cancelQpbtn'+rowid).empty();
      $('#appliedQpbtn'+rowid).empty();

      var appliedbtn ='<small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';

      $('#appliedQpbtn'+rowid).append(appliedbtn);
          
      var dataCl =0;
      $(".quaPcountrow").each(function () {
          //add only if the value is number
          if (!isNaN(this.value) && this.value.length != 0) {
              dataCl += parseFloat(this.value);
          }

        $("#allquaPcount").val(dataCl);

      });

  }else{
           
      $('#appliedQpbtn'+rowid).empty();
      $('#cancelQpbtn'+rowid).empty();

      var cnclbtn ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

      $('#cancelQpbtn'+rowid).append(cnclbtn);
      $('#quaP_count'+rowid).val(0);
         
      var dataCl =0;
      $(".quaPcountrow").each(function () {
            //add only if the value is number
          if (!isNaN(this.value) && this.value.length != 0) {
              dataCl += parseFloat(this.value);
          }

        $("#allquaPcount").val(dataCl);

      });

         
  }

}


function OkGetGransVal(aplyid,datacount,countercount,staticvalue){

    if(staticvalue==1){

          $('#aplytaxOrNot'+aplyid).html('1');
          $('#cancelbtn'+aplyid).html('');
          $('#appliedbtn'+aplyid).html('');

          var appliedbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-success"><i class="fa fa-check"></i>&nbsp; Tax Applied</small>';

          $('#appliedbtn'+aplyid).html(appliedbtn);
          
          $('#submitdata').prop('disabled', false);
          $('#submitNDown').prop('disabled', false);
          $('#submitDown').prop('disabled', false);
          $('#submitNDwn').prop('disabled', false);
          // $('#cancelbtn'+getvalue).html('');
          // $('#cancelbtn'+getvalue).html('');
          //$('#data_count'+aplyid).val(datacount);
          //console.log('if dataI',datacount);

          if(countercount == datacount){
            var g_Amnt = $('#FirstBlckAmnt_'+aplyid+'_'+countercount).val();
            $('#get_grand_num'+aplyid).val(g_Amnt);
          }
      
    }else{
        
         $('#aplytaxOrNot'+aplyid).html('0');
         $('#cancelbtn'+aplyid).html('');
         $('#appliedbtn'+aplyid).html('');
         
         var cnclbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp; Tax Not Applied</small>';

         $('#cancelbtn'+aplyid).html(cnclbtn);
         $('#data_count'+aplyid).val(0);
         $('#get_grand_num'+aplyid).val('');
         
    }

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


      var grandTotal = parseFloat($('#allgrandAmt').val());
      var basicTotal = parseFloat($('#basicTotal').val());

      if(grandTotal == '0.00'){
        var othrAmt = 0;
        $('#otherTotalAmt').val(othrAmt.toFixed(2));
        $('#CalPayTerms').prop('disabled',true);
      }else{
        var otherTotal = grandTotal - basicTotal;
        $('#otherTotalAmt').val(otherTotal.toFixed(2));
        $('#CalPayTerms').prop('disabled',false);
      }
         

}

function calculateBasicAmt(rateid){
    $('#aplytaxOrNot'+rateid).html('0');
    var qunatity = parseFloat($('#qty'+rateid).val());

      var rate = parseFloat($('#rate'+rateid).val());
      var qnrate = parseFloat($('#qnrate'+rateid).val());

      var chckitms = $('#itmCountchk').val();

      if(rate > qnrate){

        $('#greaterRateShModel'+rateid).modal('show');
        $('#rate'+rateid).val(qnrate);
        var basicAmts = qunatity * qnrate;
        $('#basic'+rateid).val(basicAmts.toFixed(2));

        $('#data_count'+rateid).val(0);
        $('#get_grand_num'+rateid).val('');
        $('#aplytaxOrNot'+rateid).html('0');

        $('#appliedbtn'+rateid).html('');
         
           var cnclbtn ='<input type="hidden" value="0" id="qltyvalue'+rateid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelbtn'+rateid).html(cnclbtn);
      }else{

        if(rate){

          /*if(chckitms == 1){
            $('#addmorhidn').prop('disabled',true);
          }else{
            $('#addmorhidn').prop('disabled',false);
          }*/
        
          var result = qunatity * rate;

          /* x=result.toString();
            var lastThree = x.substring(x.length-3);
            var otherNumbers = x.substring(0,x.length-3);
            if(otherNumbers != '')
                lastThree = ',' + lastThree;
            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;*/


         // console.log('res',res);
          $('#basic'+rateid).val(result.toFixed(2));

          $('#CalcTax'+rateid).prop('disabled',false);
          $('#submitdata').prop('disabled',false);
          $('#submitNDown').prop('disabled',false);
          $('#submitDown').prop('disabled',false);
          $('#submitNDwn').prop('disabled',false);
          //$('#addmorhidn').prop('disabled',false);
          $('#deletehidn').prop('disabled',false);

          var rowcount = $('#data_count'+rateid).val();

          if(rowcount !=0){
            //$('#data_count'+rateid).val(0);
            $('#get_grand_num'+rateid).val('');

            $('#appliedbtn'+rateid).html('');
           
             var cnclbtn ='<input type="hidden" value="0" id="qltyvalue'+rateid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

            $('#cancelbtn'+rateid).html(cnclbtn);

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

              //  console.log('btotal ',btotal);

              $("#basicTotal").val(btotal.toFixed(2));

            });

            var basicTotal = parseFloat($('#basicTotal').val());
            var grandTotal = parseFloat($('#allgrandAmt').val());


            if(grandTotal == '0.00'){
              var othrAmt = 0;
              $('#otherTotalAmt').val(othrAmt.toFixed(2));
            }else{
              var otherTotal = grandTotal - basicTotal;
              $('#otherTotalAmt').val(otherTotal.toFixed(2));
            }

         }

        }else{

          $('#basic'+rateid).val('');

          $('#CalcTax'+rateid).prop('disabled',true);
          $('#submitdata').prop('disabled',true);
          $('#submitNDown').prop('disabled',true);
          $('#submitDown').prop('disabled',true);
          $('#submitNDwn').prop('disabled',true);

        }

      }

      var total =0;

      //var basicAmnt = $('#basic'+rateid).val();
      //console.log(basicAmnt);
      $(".basicamt").each(function () {
         // console.log(this.value);
        //add only if   the value is number
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


}

function calculateBasicAmt_olde(rateid){

  $('#aplytaxOrNot'+rateid).html('0');
  var qunatity = parseFloat($('#qty'+rateid).val());

  var rate = parseFloat($('#rate'+rateid).val());
  var qnrate = parseFloat($('#qnrate'+rateid).val());

  var chckitm = $('#itmCountchk').val();


    if(rate){

      if(chckitm == 1){
        $('#addmorhidn').prop('disabled',true);
      }else{
        $('#addmorhidn').prop('disabled',false);
      }

      var result = qunatity * rate;

      $('#basic'+rateid).val(result.toFixed(2));

      $('#CalcTax'+rateid).prop('disabled',false);
      $('#submitdata').prop('disabled',false);
      $('#submitNDown').prop('disabled',false);
      $('#submitDown').prop('disabled',false);
      $('#submitNDwn').prop('disabled',false);
      $('#deletehidn').prop('disabled',false);
      
      var rowcount = $('#data_count'+rateid).val();

      if(rowcount !=0){

          $('#data_count'+rateid).val(0);
          $('#get_grand_num'+rateid).val('');
          $('#appliedbtn'+rateid).html('');
         
           var cnclbtn ='<input type="hidden" value="0" id="qltyvalue'+rateid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

          $('#cancelbtn'+rateid).html(cnclbtn);

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

             // console.log('btotal ',btotal);

            $("#basicTotal").val(btotal.toFixed(2));

          });


        var basicTotal = parseFloat($('#basicTotal').val());
        var grandTotal = parseFloat($('#allgrandAmt').val());

        if(grandTotal == '0.00'){
          var othrAmt = 0;
          $('#otherTotalAmt').val(othrAmt.toFixed(2));
        }else{
          var otherTotal = grandTotal - basicTotal;
          $('#otherTotalAmt').val(otherTotal.toFixed(2));
        }
        

      }

    }else{

        $('#basic'+rateid).val('');
        $('#CalcTax'+rateid).prop('disabled',true);
        $('#submitdata').prop('disabled',true);
        $('#submitNDown').prop('disabled',true);
        $('#submitDown').prop('disabled',true);
        $('#submitNDwn').prop('disabled',true);
        $('#addmorhidn').prop('disabled',true);
        $('#deletehidn').prop('disabled',true);
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

}

function select_all() {

    $('input[class=case]:checkbox').each(function(){ 

      if($('input[class=check_all]:checkbox:checked').length == 0){ 

        $(this).prop("checked", false); 

      }else{

        $(this).prop("checked", true); 

      } 

    });
}


function getvalue(staticvalue){

  if(staticvalue==1){

      $('#paymentcancelbtn').html(''); 
      $('#paymentokbtn').html('');

      var appliedbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue"><small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';

      $('#paymentokbtn').html(appliedbtn);
     
      $('#submitdata').prop('disabled', false);
      $('#submitNDown').prop('disabled', false);
      $('#submitDown').prop('disabled', false);
      $('#submitNDwn').prop('disabled', false);
     // $('#cancelbtn'+getvalue).html('');
  
  }else{
     
      $('#paymentokbtn').html('');
      $('#paymentcancelbtn').html('');
      $('#slectpaytrem').val('');
      $('#selectadvRateInd').val('');
      $('#selectadvance_rate').val('');
      $('#selectadvance_Amt').val('');

     var cnclbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

     $('#paymentcancelbtn').html(cnclbtn);

  }

}

$('#paymentTerms').on('change',function(){

    var payterm = $(this).val();
    if( payterm == 'Adhoc'){
        var crAmt = $('#cr_amt_PT').val();
        $('#advRateInd').val('L');
        $('#advRateInd').attr("style", "pointer-events: none;");
        $('#advance_rate').val('');
        $('#advance_rate').prop('readonly',true);
        $('#advance_Amt').prop('readonly',false);
        $('#advance_Amt').val(crAmt);
    }else{
        $('#advRateInd').attr("style", "pointer-events: auto;");
        $('#advRateInd').val('');
        $('#advance_rate').prop('readonly',false);
        $('#advance_Amt').prop('readonly',true);
        $('#advance_Amt').val('');
    }
});

$('#payment_trem_apply').on('click',function(){

  var paymentTerms = $('#paymentTerms').val();
  var cr_amt_PT = $('#cr_amt_PT').val();
  var advRateInd = $('#advRateInd').val();
  var advance_rate = $('#advance_rate').val();
  var advance_Amt = $('#advance_Amt').val();
    $('#slectpaytrem').val(paymentTerms);
    $('#slectcramt_PT').val(cr_amt_PT);
    $('#selectadvRateInd').val(advRateInd);
    $('#selectadvance_rate').val(advance_rate);
    $('#selectadvance_Amt').val(advance_Amt);

});

$('#advance_Amt').on('input',function(){
  var Adv_amt = $(this).val();
  var crAmt = $('#cr_amt_PT').val();

  if(parseFloat(Adv_amt) > parseFloat(crAmt)){
    $("#errmsg").html('advice ammount should not be greter than cr ammount').css('color','red');
    $('#advance_Amt').val('');
  }else{
    $("#errmsg").html('');
  }

});

$('#advance_rate').on('input',function(){
  var advance_rate = $(this).val();

  var advrate_ind = $("#advRateInd").val();

  if(advance_rate){

    if(advrate_ind=='P'){

          if(advance_rate > 100){

            $("#errmsg").html('advice rate should be less than or equal to 100%').css('color','red');
             $(this).val('');
            $("#advance_Amt").val('');

          }else{
             var cr_amt_PT = $('#cr_amt_PT').val();
              var calAdvAmt = parseFloat(cr_amt_PT) * parseFloat(advance_rate) /100;
              $('#advance_Amt').val(calAdvAmt);
          }
    }
   
  }else{
    $('#advance_Amt').val('');
  }

});

$('#advRateInd').on('change',function(){
    var advRateInd = $(this).val();

    if(advRateInd == 'L'){
      $('#advance_rate').prop('readonly',true);
      $('#advance_Amt').prop('readonly',false);
      var advance_rate = $('#advance_rate').val();

      if(advance_rate){
        $('#advance_rate').val('');
        $('#advance_Amt').val('');
      }else{}

    }else{
      $('#advance_rate').prop('readonly',false);
      $('#advance_Amt').prop('readonly',true);
    }
});

$('#CalPayTerms').on('click',function(){
    var allgrandAmt =  parseFloat($('#allgrandAmt').val());
    $('#cr_amt_PT').val(allgrandAmt.toFixed(2));

    var advance_rate = $('#advance_rate').val();
    if(advance_rate){
      var cr_amt_PT = $('#cr_amt_PT').val();
      var calAdvAmt = parseFloat(cr_amt_PT) * parseFloat(advance_rate) /100;
      $('#advance_Amt').val(calAdvAmt);
    }

    var purheadId     =  $('#Quotn_compare_no').val();
    var transcode     =  $('#transcode').val();
    var contNo        =  $('#contractNo').val();
    if(contNo){
      var sliptContract = contNo.split(' ');
      var contractNo    = sliptContract[2];
    }
    
    var quotationNo   =  $('#quotationNo').val();

      if(purheadId || contNo || quotationNo){

          $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
          });

          var pAdataUrl = folderName+'/get-purchase-head-id-onpayterm';

          $.ajax({

            url:pAdataUrl,

            method : "POST",

            type: "JSON",

            data: {purheadId: purheadId,contractNo:contractNo,quotationNo:quotationNo,transcode:transcode},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  console.log('data1.data[0]',data1.data[0]);
                  if(data1.data == ''){
                     
                    }else{
                       $('#advRateInd').val(data1.data[0].ADV_RATE_I);
                       $('#advance_rate').val(data1.data[0].ADV_RATE);
                       $('#paymentTerms').val(data1.data[0].PMT_TERMS);

                       var cr_amt_PT = $('#cr_amt_PT').val();
                       var advance_rate = $('#advance_rate').val();

                        var calAdvAmt = parseFloat(cr_amt_PT) * parseFloat(advance_rate) /100;
                        $('#advance_Amt').val(calAdvAmt);
                    }

                }

            }

          });

      }else{

      }
});

function check(){

  obj = $('table tr').find('span');

  if(obj.length == 0){
    $('#basicTotal').val(0);
    $('#otherTotalAmt').val(0);
    $('#allgrandAmt').val(0);
    $("#allquaPcount").val(0);
    $("#allgetMCount").val(0);
    $('#addmorhidn').prop('disabled',false);
    $('#submitNDwn').prop('disabled',true);
    $('#submitdata').prop('disabled',true);
    $('#submitNDown').prop('disabled',true);
    $('#submitDown').prop('disabled',true);
    $('#CalPayTerms').prop('disabled',true);

  }else{

    $.each( obj, function( key, value ) {

        id= value.id;

        $('#'+id).html(key+1);

    });

  }
      
}

function when_chng_index(incId){
    var qunatity = $('#qty'+incId).val();
    for(s=2;s<=12;s++){
      var indecatoe = $('#indicator_'+incId+'_'+s).val();
     // console.log('ind',indecatoe);
      if(indecatoe == 'R'){
      var rate = $('#rate_'+incId+'_'+s).val();
      var result = parseFloat(qunatity) * parseFloat(rate);
      $('#FirstBlckAmnt_'+incId+'_'+s).val(result);
      //  console.log('when chng i',result);
      }else{}
    }
}

function getTolerance(tolrn){
  var tolIndex =  $('#tolrance_index'+tolrn).val();
  var tolRate  =  $('#tolrance_rate'+tolrn).val();
  var tolValue =  $('#tolrance_rate_percent'+tolrn).val();
  var qty =  $('#qty'+tolrn).val();

  var sum = parseFloat(qty) + parseFloat(tolValue);

  if(tolIndex){
    $('#settolrnceIndex'+tolrn).val(tolIndex);
    $('#setTolrnceRate'+tolrn).val(tolRate);
    $('#setTolrnceValue'+tolrn).val(sum);
  }

  var appliedbtn ='<input type="hidden" value="'+tolrn+'" id="tolrnvalue'+tolrn+'"><small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';

  $('#appliedtolrnbtn'+tolrn).html(appliedbtn);
  $('#cancelbtolrntn'+tolrn).css('display','none');

}

function ratepercent(ratevalue){

    var tolRate =  $('#tolrance_rate'+ratevalue).val();
    var qty =  $('#qty'+ratevalue).val();
   
    if(tolRate){
      var calculateRatePer = parseFloat(tolRate)*parseFloat(qty)/100;
    }else{
      var calculateRatePer='';
    }

    $('#tolrance_rate_percent'+ratevalue).val(calculateRatePer.toFixed(2));

}

/* ---------- purchase grn  --------- */

  $("#purOrdervrno").bind('change', function () {
    var purVrcode =  $('#purOrdervrno').val();
    console.log('purVrcode',purVrcode);
    var xyz = $('#poVrnoList option').filter(function() {

      return this.value == purVrcode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
    console.log('msg',msg);

    if(msg=='No Match'){
        $(this).val('');
        $('#due_days').val('');
        $('#due_date').val('');
        $('#tax_code').val('');
        $('#itmCountchk').val('');
        $('#party_rf_no').val('').prop('readonly',false);
        $('#due_days').val('').prop('readonly',false);
        $('#tax_code').val('').prop('readonly',false);
        $('#getpartyrfNo').val('');
        $('#party_ref_date').val('').prop('disabled',false);
        $('#getpartyrfDate').val('');
        $('#pur_order_no').val('');

        $('#Item_CodeId1').addClass('itmbyQc');
        $('#Item_CodeId1').addClass('showhideItm');
          $('#ItemCodeId1').css('display','block');

    }else{
       $('#pur_order_no').val(purVrcode);
    }

  });

/* ---------- purchase grn  --------- */


/*sale transaction jquery*/

  $("#series_code_sale").bind('change', function () {
    
      var Seriescode =  $("#series_code_sale").val();
      var xyz = $('#series_List1 option').filter(function() {

        return this.value == Seriescode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      console.log('msg',msg);

      if(msg=='No Match'){
         $("#series_code_sale").val('');
         $('#getSeriesCode').val('');
         $('#seriesGl').val('');
         $('#getSeriesName').val('');
         $('#vrseqnum').val('');
         $('#getVrNo').val('');
         $('#series_code_errr').html('The Series code field is required.').css('color','red');
      }else{
        
        $('#seriesGl').val('');
         $('#series_code_sale').val(Seriescode+'[ '+msg+' ]');
         $('#getSeriesCode').val(Seriescode);
         $('#getSeriesName').val(msg);
         $('#series_code_errr').html('');
         getvrnoBySeries();
      }

    objvalidtn.checkBlankFieldValid_Sale();
  });


  $("#Plant_code_sale").bind('change', function () {
    var Plantcode =  $(this).val();
    var xyz = $('#PlantcodeList option').filter(function() {

      return this.value == Plantcode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
       $(this).val('');
        document.getElementById("plant_err").innerHTML = 'The Plant code field is required.';
        $('#getPlantCode').val('');
        $('#getPlantName').val('');
    }else{
      var plntCode = $('#Plant_code_sale').val();
      $('#plant_err').html('');
       $('#getPlantCode').val(plntCode);
       $('#getPlantName').val(msg);
       $('#Plant_code_sale').val(Plantcode+'[ '+msg+' ]');
       
    }

     objvalidtn.checkBlankFieldValid_Sale();

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      var plcode =  $('#Plant_code_sale').val();
      var splipl = plcode.split('[');
      var Plant_code = splipl[0];
      var palnt_dataUrl = folderName+'/Get-Pfct-Code-Name-By-Plant';
      $.ajax({

        url:palnt_dataUrl,

        method : "POST",

        type: "JSON",

        data: {Plant_code: Plant_code},

        success:function(data){

          var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.data == ''){
                   var profitctr = '';
                   var pfctget = '';
                   var pfctName = '';
                   var statec = '';
                   $('#profitctrId').val(profitctr);
                   $('#pfctName').val(pfctName);
                   $('#getPfctName').val(pfctName);
                   $('#getPfctCode').val(pfctget);
                   $('#getStateByPlant').val(statec);
                }else{

                 var pfctCode = data1.data[0].PFCT_CODE;
                 var pfctName = data1.data[0].PFCT_NAME;
                  $('#profitctrId').val(pfctCode+'[ '+pfctName+' ]');
                  $('#getPfctName').val(pfctName);
                  $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                   $('#getStateByPlant').val(data1.data[0].STATE_CODE);

                }

            }

        }

      });

  });

  $("#account_code_sale").bind('change', function () {

    var Acccode =  $(this).val();


    var xyz = $('#AccountList option').filter(function() {

      return this.value == Acccode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
 
    $('#accicon').css("display", "block");
    $('#showicon').css("display", "none");
    $('#appndplantbtn').empty();
    if(msg=='No Match'){
       $(this).val('');
       $('#accountName').val('');
       document.getElementById("acccode_err").innerHTML = 'The Account code field is required.';
        $('#getAccCode').val('');
        $('#getAccCode').val('');
        $('#getAcc_Name').val('');
        $('#addId').val('');
        $('#getcpCode').val('');
        $('#stateOfAcc').val('');
        $('#due_days').prop('readonly',true);
        $('#appndplantbtn1').hide();
        $('#accountNameTooltip').addClass('tooltiphide');
        $('#saleQuoNo').val('');
        $('#saleQuoList').empty();
        $('#saleenquirynoList').empty();
        $('#saleConNo').val('');
        $('#tax_code_get').val('');
        $('#salenquiryNum').val('');
        $('#due_days').val('');
        $('#due_date').val('');
        $('#getTaxCode').val('');
        $('#get_due_date').val('');
        $('#gateduedays').val('');
        $('#shipTAddrs').val('');
        $('#gateconsAdd').val('');
        $('#accGlCode').val('');
        $('#accGlName').val('');

        var saleQuoNo    =  $('#saleQuoNo').val();

       if(saleQuoNo){
          $('#Item_CodeId1').removeClass('itmbyQc');
          $('#Item_CodeId1').removeClass('itmbyQc');
          $('#ItemCodeId1').css('display','none');
      }else{
          $('#Item_CodeId1').addClass('itmbyQc');
          $('#ItemCodeId1').css('display','block');
      }
    }else{
      $('#Item_CodeId1').addClass('itmbyQc');
          $('#ItemCodeId1').css('display','block');
      $('#saleQuoNo').val('');
      $('#saleConNo').val('');
      $('#tax_code_get').val('');
      $('#due_days').val('');
      $('#salenquiryNum').val('');
      $('#due_date').val('');
      $('#saleQuoList').empty();
      $('#saleenquirynoList').empty();
       $('#shipTAddrs').val('');
       $('#gateconsAdd').val('');
       $('#accGlCode').val('');
        $('#accGlName').val('');
      $('#accountName').val(msg);
      $('#getAcc_Name').val(msg);
      $('#accountNameTooltip').removeClass('tooltiphide');
      $('#accountNameTooltip').html(msg);
      document.getElementById("acccode_err").innerHTML = '';
      var AccountCode = $('#account_code_sale').val();
      var transcode = $('#transcode').val();
      $('#getAccCode').val(AccountCode);
      $('#getcosine').val(AccountCode);
      $('#getTransCode').val(transcode);
      $('#account_code_sale').val(Acccode+'[ '+msg+' ] ');
      $('#accicon').css("display", "none");
      $('#appndplantbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getaccdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
    // $('#appndplantbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getplantdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
      
    }

   objvalidtn.checkBlankFieldValid_Sale();

});

  $("#costCent_code_sale").bind('change', function () {
    
      var costcenter =  $("#costCent_code_sale").val();
     // console.log('costcenter',costcenter);
      var xyz = $('#CostcodeList option').filter(function() {

        return this.value == costcenter;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $("#costCent_code_sale").val('');
         $("#gateCostCenter").val('');
         $("#gateCostCenterName").val('');
         $('#Costcentr_err').html('The Cost Center field is required.').css('color','red');
      }else{
         $('#gateCostCenter').val(costcenter);
         $('#gateCostCenterName').val(msg);
         $('#costCent_code_sale').val(costcenter+'[ '+msg+' ]');
         $('#Costcentr_err').html('');
      }

    objvalidtn.checkBlankFieldValid_Sale();
  });

  $("#sale_rep_code").bind('change', function () {
    
      var saleRepCd =  $("#sale_rep_code").val();
      var xyz = $('#saleRepList option').filter(function() {

        return this.value == saleRepCd;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $("#sale_rep_code").val('');
         $("#gateSaleRep").val('');
         $("#gateSaleRepsName").val('');
         $('#saleR_err').html('The Sale Rep. field is required.').css('color','red');
      }else{
         $('#sale_rep_code').val(saleRepCd+'[ '+msg+' ]');
         $('#gateSaleRep').val(saleRepCd);
         $('#gateSaleRepsName').val(msg);
         $('#saleR_err').html('');
      }

    objvalidtn.checkBlankFieldValid_Sale();
  });

$("#tax_code_get").bind('change', function () {

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
     var Tx_Code = $('#tax_code_get').val();
     $('#getTaxCode').val(Tx_Code);
      //$('#ItemCodeId1').prop('readonly',false);
      $('#due_days').prop('readonly',false);
  }

   objvalidtn.checkBlankFieldValid_Sale();

});

function gettaxByStatCdSale(){

  var shipToAdd =  $('#shipTAddrs').val();

  var xyz = $('#shipTAdd option').filter(function() {

    return this.value == shipToAdd;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  console.log('msg',msg);
  if(msg=='No Match'){
        $(this).val('');
        $('#stateOfAcc').val('');
        $('#shipTAddrs').val('');
        $('#gateconsAdd').val('');
        $('#tax_code').val('');
        $('#addId').val('');
        $('#getcpCode').val('');
        $('#TaxcodeList').empty();
  }else{
      $('#addId').val(msg);
      $('#getcpCode').val(msg);
      $('#gateconsAdd').val(shipToAdd);
      var addId        = $('#addId').val();
      var shipAddr     = $('#shipTAddrs').val();
      var acc_code     = $('#account_code_sale').val();
      var splitCd      = acc_code.split('[');
      var account_code = splitCd[0];
      var plstateCode  =  $('#getStateByPlant').val();

      var add_dataUrl = folderName+'/get-state-wise-tax-code';

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

            url:add_dataUrl,

            method : "POST",

            type: "JSON",

            data: {addId: addId,account_code:account_code,plstateCode:plstateCode},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  if(data1.getStateCode ==''){

                  }else{
                  $('#stateOfAcc').val(data1.getStateCode.STATE_CODE);
                  }

                  if(data1.get_taxCode == ''){

                  }else{
                    $("#TaxcodeList").empty();
                    $.each(data1.get_taxCode, function(k, getTAX){

                     
                      $("#TaxcodeList").append($('<option>',{

                        value:getTAX.TAX_CODE,

                        'data-xyz':getTAX.TAX_NAME,
                        text:getTAX.TAX_NAME+' ['+getTAX.TAX_CODE+']'

                      }));

                    }); 
                  }

                }

            }

      });

  }

  objvalidtn.checkBlankFieldValid_Sale();

}

/*sale transaction jquery*/


/* ------- ajax code start ------- */

  function getaccdata(){

  $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

  var acc_Code    = $('#account_code').val();
  var accCodeSale = $('#account_code_sale').val();

  if(acc_Code){
    var accCode =acc_Code;
  }else if(accCodeSale){
    var splitacc    = accCodeSale.split('[');
    var accsaleCode = splitacc[0];
    var accCode =accsaleCode;
  }
  
  var accdataUrl = folderName+'/get-acc-data-by-accdetail';

  $.ajax({

            url:accdataUrl,

            method : "POST",

            type: "JSON",

            data: {accCode: accCode},

            success:function(data){


              var data1 = JSON.parse(data);
              //console.log(data1.data[0]);


                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  
                  $("#plantCodeshow").html(data1.data.ACC_NAME+'/'+data1.data.ACC_CODE);
                  $("#plantpfctcodeshow").html(data1.data.ACC_CODE);
                  if(data1.data.ADD1){

                  $("#plantaddshow").html(data1.data.ADD1);
                  }else{
                  $("#plantaddshow").html('--');
                   }

                   if(data1.data.CITY_CODE){
                  $("#plantcityshow").html(data1.data.CITY_CODE);
                    }else{
                   $("#plantcityshow").html('--');
                    }
                    if(data1.data.PIN_CODE){

                  $("#plantpinshow").html(data1.data.PIN_CODE);
                    }else{

                      $("#plantpinshow").html('--');
                    }

                  if(data1.data.DIST_CODE){
                  $("#plantdistshow").html(data1.data.DIST_CODE);
                  }else{
                    $("#plantdistshow").html('--');
                    }

                  if(data1.data.STATE_CODE){
                  $("#plantstateshow").html(data1.data.STATE_CODE);
                }else{
                  $("#plantstateshow").html('--');
                }
                if(data1.data.EMAIL_ID){
                  $("#plantemailshow").html(data1.data.EMAIL_ID);
                }else{
                  $("#plantemailshow").html('--');
                }

                if(data1.data.CONTACT_NO){
                  $("#plantphoneshow").html(data1.data.CONTACT_NO);
                }else{
                  $("#plantphoneshow").html('--');
                }
                

                }

            }

          });
}

function changeAum(aumid){

      var ItemCode =  $('#ItemCodeId'+aumid).val();
      var unitM    =  $('#UnitM'+aumid).val();
      var adunitM  =  $('#AddUnitM'+aumid).val();
      var qty = $('#qty'+aumid).val();

      var xyz = $('#aumList'+aumid+' option').filter(function() {

          return this.value == adunitM;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#AddUnitM'+aumid).val('');
        $('#A_qty'+aumid).val('');
      }else{

      }
 
      var changeAumgetUrl = folderName+'/get-cfactor-when-change-aum';

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

            type: 'POST',

            url: changeAumgetUrl,

            data: {ItemCode:ItemCode,unitM:unitM,adunitM:adunitM}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

              if(data1.data==''){
                   
              }else{  

                   $('#Cfactor'+aumid).val(data1.data[0].aum_factor);
                  
                   var calAqty = parseFloat(qty) * parseFloat(data1.data[0].aum_factor);

                   $('#A_qty'+aumid).val(calAqty.toFixed(3));
              }
           
            }

      });

}


function showItemDetail(viewid){

    var ItemCodeOnM =  $('#ItemCodeId'+viewid).val();
    var Item_CodeOnF =  $('#Item_CodeId'+viewid).val();
    if(ItemCodeOnM){
      var ItemCode = ItemCodeOnM;
    }else if(Item_CodeOnF){
      var ItemCode = Item_CodeOnF;
    }

    var itemDetailgetUrl = folderName+'/get-item-um-aum';

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

    $.ajax({

            type: 'POST',

            url: itemDetailgetUrl,

            data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

              console.log(data1.data_hsn);

              if(data1.data==''){
                   
              }else{  

                  $("#itemNameshow"+viewid).html(data1.data_hsn.ITEM_NAME+'<p>('+data1.data_hsn.ITEM_CODE+')</p>');
                  $("#itemCodeshow"+viewid).html(data1.data_hsn.ITEM_NAME+'<p>('+data1.data_hsn.ITEM_CODE+')</p>');
                  $("#hsncodeshow"+viewid).html(data1.data_hsn.HSN_CODE);
                  $("#taxcodeshow"+viewid).html(data1.data_hsn.tax_code);
                  $("#itemDetailshow"+viewid).html(data1.data_hsn.ITEM_DETAIL);
                  $("#itemtypeshow"+viewid).html(data1.data_hsn.ITEMTYPE_CODE);
                  $("#itemgroupshow"+viewid).html(data1.data_hsn.ITEMGROUP_CODE);
                  $("#itemclassshow"+viewid).html(data1.data_hsn.ITEMCLASS_CODE );
                  $("#itemcategoryshow"+viewid).html(data1.data_hsn.ICATG_CODE);
              }
             // console.log(data1.data);
            }

    });

}

function tolranceDetail(itemcode){

     var Codeitem    =  $('#ItemCodeId'+itemcode).val();
     var existTIndex =  $('#settolrnceIndex'+itemcode).val();
     var existTRate  = parseFloat($('#setTolrnceRate'+itemcode).val());
     var qty         =  $('#qty'+itemcode).val();
     var contractNo  =  $('#contractNo').val();
     var tolindex    =  $('#tolindex'+itemcode).val();
     var tolrate     = parseFloat($('#tolrate'+itemcode).val());

      if(contractNo){ 


        var tolpervalue =  $('#tolpervalue'+itemcode).val();

        if(existTIndex){
          $('#tolrance_index'+itemcode).val(existTIndex);
        }else{
          $('#tolrance_index'+itemcode).val(tolindex);
        }

        if(existTRate){
          $('#tolrance_rate'+itemcode).val(existTRate);
          $('#tolrance_rate'+itemcode).prop('readonly',true);
          var rateper =parseFloat(qty) * parseFloat(tolrate)/100;
          $('#tolrance_rate_percent'+itemcode).val(rateper);
        }else{
          $('#tolrance_rate'+itemcode).val(tolrate.toFixed(2));
          $('#tolrance_rate'+itemcode).prop('readonly',true);
          var rateper = parseFloat(qty) * parseFloat(tolrate)/100;
          $('#tolrance_rate_percent'+itemcode).val(rateper.toFixed(2));
        }

      }else{

        if(Codeitem){
          var ItemCode = Codeitem;
        }else{
          var ItemCode =  $('#Item_CodeId'+itemcode).val();
        }

        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        var tolrancUrl = folderName+'/get-tolrnce-data-by-item-code';

        $.ajax({

          url:tolrancUrl,

          method : "POST",

          type: "JSON",

          data: {tolrancUrl: tolrancUrl},

          success:function(data){

              var data1 = JSON.parse(data);
                
                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  if(existTIndex){
                      $('#tolrance_index'+itemcode).val(existTIndex);
                  }else{
                      $('#tolrance_index'+itemcode).val(data1.data.tolerance_basis);
                  }

                  if(existTRate){
                      $('#tolrance_rate'+itemcode).val(existTRate.toFixed(2));
                       var rateper = parseFloat(qty) *parseFloat(existTRate)/100;
                      $('#tolrance_rate_percent'+itemcode).val(rateper.toFixed(2));

                  }else{
                      $('#tolrance_rate'+itemcode).val(data1.data.tolerance_qty);
                      var rateper = parseFloat(qty) * parseFloat(data1.data.tolerance_qty)/100;
                      $('#tolrance_rate_percent'+itemcode).val(rateper.toFixed(2));

                      
                  }

                }

          }

        });

      }

}

function getBYAccCode(){

    var acc_code =  $('#account_code').val();
    var vrDate =  $('#vr_date').val();
    //var stateCode =  $('#getStateByPlant').val();

    $.ajaxSetup({

      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    var databyaccUrl = folderName+'/get-QcNum-by-account';


    $.ajax({

          url:databyaccUrl,

          method : "POST",

          type: "JSON",

          data: {acc_code: acc_code,vrDate:vrDate},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                 $("#qtnCompList").empty();
                  $('#Quotn_compare_no').val('');
                  $('#getQuotatnNo').val('');
                  $('#itmCountchk').val('');
                  $('#qcNotFound').html('Quotation No Not Found');
              }else if(data1.response == 'success'){

                if(data1.data == ''){
                  $("#qtnCompList").empty();
                  $('#Quotn_compare_no').val('');
                  $('#getQuotatnNo').val('');
                  $('#itmCountchk').val('');
                }else{
                  $('#qcNotFound').html('');
                  $("#qtnCompList").empty();
                  $('#Quotn_compare_no').val('');
                  $('#getQuotatnNo').val('');
                  $('#itmCountchk').val('');
                   
                  $.each(data1.data, function(k, getData){

                    $("#qtnCompList").append($('<option>',{

                      value:getData.PQCSHID,

                      'data-xyz':getData.PQCSHID,
                      text:getData.PQCSHID

                    }));

                  });
                    
                }

                if(data1.shpTo_Add == ''){

                }else{
                  $("#shipTAdd").empty();
                  $.each(data1.shpTo_Add, function(k, getTAX){

                    var cpCode =  '['+getTAX.ACC_CODE+'-'+getTAX.ACC_NAME+'] '+getTAX.ADD1;
                   
                    $("#shipTAdd").append($('<option>',{

                      value:cpCode,

                      'data-xyz':getTAX.CPCODE,

                    }));

                  }); 
                }

              }

          }

    });

}

/* -------  ajax code start  --------- */

$('.Number').keypress(function (event) {

  var keycode = event.which;

  if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

      event.preventDefault();

  }

});

jQuery.extend(jQuery.expr[':'], {

      focusable: function (el, index, selector) {

          return $(el).is('a, button, :input, [tabindex]');

      }

});

$(document).on('keypress', 'input,select', function (e) {

    if (e.which == 13) {

        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');

        var index = $canfocus.index(document.activeElement) + 1;

        if (index >= $canfocus.length) index = 0;

        $canfocus.eq(index).focus();
    }

});