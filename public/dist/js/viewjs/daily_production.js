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



    var vr_date = $('#vr_date').val();

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var Plant_code =  $('#Plant_code').val();


        //console.log(Plant_code);
          $.ajax({

            url:pfctcodeurl,

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);
                  if(data1.data == ''){
                       var profitctr = '';
                       var pfctget = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctCode').val(pfctget);
                    }else{
                      $('#profitctrId').val(data1.data[0].pfct_code);
                      $('#pfctName').val(data1.data[0].pfct_name);
                      $('#getPfctCode').val(data1.data[0].pfct_code);

                    }

                }

            }

          });


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

  $('#appndaccbtn').empty();
  /*$('#accicon').css("display", "block");*/
 // $('#showicon').css("display", "none");

  if(msg=='No Match'){
     $(this).val('');
     $('#accountName').val('');
/*     document.getElementById("acccode_err").innerHTML = 'The Account code field is required.';
*/     
      $('#getAccCode').val('');
      $('#emplList').empty();
      $('#emp_code').val('');
      $('#empName').html('');
      $('#emplyeeName').val('');
      $('#accicon').css("display", "none");
      $('#showicon').css("display", "block");
      $('#appndaccbtn').empty();

  }else{
    $('#accountName').val(msg);
    $('#getAccName').val(msg);
    $('#accountNameTooltip').css('display','block');
    $('#accountNameTooltip').html(msg);
     document.getElementById("acccode_err").innerHTML = '';
     var AccountCode = $('#account_code').val();
     var vrseqnum = $('#vrseqnum').val();
     var transcode = $('#transcode').val();
     $('#getAccCode').val(AccountCode);
     $('#getVrNo').val(vrseqnum);
     $('#getTransCode').val(transcode);
     $('#accicon').css("display", "none");
     $('#showicon').css("display", "none");
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
      $('#fg_name').val('');
      $('#fgUnitM').val('');
      $('#getFgName').val('');
      
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


function ItemCodeGet(ItemId){
   
      var ItemCode =  $('#ItemCodeId'+ItemId).val();

      
      var xyz = $('#ItemList'+ItemId+' option').filter(function() {

          return this.value == ItemCode;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      var prd_qty = $("#qty_prod").val();
     var std_rate = $("#std_rate").val();

   
      var totalhead = (prd_qty * std_rate);

      $("#totalstd").val(totalhead);
      

      if(msg=='No Match'){

             $('#ItemCodeId'+ItemId).val('');

             document.getElementById("Item_Name_id"+ItemId).value = '';

             $('#qty'+ItemId).val('');

             $('#A_qty'+ItemId).val('');
             $('#UnitM'+ItemId).val('');
             $('#AddUnitM'+ItemId).val('');
            $('#viewItemDetail'+ItemId).addClass('showdetail');
            $('#itemNameTooltip'+ItemId).addClass('tooltiphide'); 

            $("#CalcTax"+ItemId).prop('disabled',true);

      }else{

         document.getElementById("Item_Name_id"+ItemId).value = msg;

         
        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide'); 

         $('#itemNameTooltip'+ItemId).html(msg); 

         $('#qty'+ItemId).prop('readonly',false);  
         $('#issueqty'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false); 

        $('#vr_date,#series_code,#Plant_code,#account_code,#due_days,#party_rf_no,#party_ref_date,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5,#emp_code,#fg_code,#qty_prod').prop('readonly',true); 

      }

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });
      if(ItemCode){

        $.ajax({

          url:itemcodeurl,

          method : "POST",

          type: "JSON",

          data: {ItemCode: ItemCode},

           success:function(data){

                var data1 = JSON.parse(data);

                

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                  //console.log(data1.data);
                 
                    if(data1.data==''){

                      var umcode = '';

                      var aumcode = '';

                      var cfactor = '';

                      $('#UnitM'+ItemId).val(umcode);

                      $('#AddUnitM'+ItemId).val(aumcode);

                      $('#issueUnitM'+ItemId).val(umcode);

                      $('#issueAddUnitM'+ItemId).val(aumcode);

                      $('#Cfactor'+ItemId).val(cfactor);

                       $('#stockavlble'+ItemId).html('STOCK : '+data1.totalstock);
                       $('#stockvalue'+ItemId).val(data1.totalstock);


                    }else{

                      $('#UnitM'+ItemId).val(data1.data[0].UM_CODE);

                      $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                      $('#issueUnitM'+ItemId).val(data1.data[0].UM_CODE);

                      $('#issueAddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                      $('#Cfactor'+ItemId).val(data1.data[0].AUM_FACTOR);

                      $('#viewItemDetail'+ItemId).removeClass('showdetail');
                      

                      $('#stockavlble'+ItemId).html('STOCK : '+data1.totalstock);
                       $('#stockvalue'+ItemId).val(data1.totalstock);


                    }

                    
                    console.log('stdRate code',data1.stdRate[0]);

                    if(data1.itypeGl == ''){
                      $('#item_post_code'+ItemId).val('');
                    }else{
                      $('#item_post_code'+ItemId).val(data1.itypeGl[0].POST_CODE);
                    }

                    if(data1.stdRate == ''){
                      $('#item_stdRate'+ItemId).val('');
                      $('#item_MVARate'+ItemId).val('');
                    }else{
                      $('#item_stdRate'+ItemId).val(data1.stdRate[0].STDRATE);
                      $('#item_MVARate'+ItemId).val(data1.stdRate[0].MAVGRATE);
                    }

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

        });  /*ajax close*/

      }else{}

  }/*function close*/


  function FgCodeGet(){
   
      var ItemCode =  $('#fg_code').val();

     
      

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });
      if(ItemCode){

        $.ajax({

          url:itemcodeurl,

          method : "POST",

          type: "JSON",

          data: {ItemCode: ItemCode},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                  //console.log(data1.data);
                 
                    if(data1.data==''){

                      var umcode = '';

                      var aumcode = '';

                      var cfactor = '';

                      $('#fgUnitM').val(umcode);

                     


                    }else{

                      $('#fgUnitM').val(data1.data[0].UM_CODE);

                      


                    }

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

        });  /*ajax close*/

      }else{}

  }




 function qty_parameter(qty){

   var ItemCode =  $('#ItemCodeId'+qty).val();
   

  
    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: qtyparametrurl,

            data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

            success: function (data) {


              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      if(data1.data==''){

                        }else{

                          $('#qua_par_'+qty).empty();
                          // $('#footer_qaulity_btn'+qty).empty();
                          //  $('#footer_ok_btn'+qty).empty();


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);

                        var sr_no=1;
                          $.each(data1.data, function(k, getData) {

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.ICATG_CODE+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+data1.item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+getData.IQUA_CODE+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_decs_"+qty+"_"+sr_no+"' name='iqua_desc[]' class='form-control inputtaxInd' value="+getData.IQUA_UM+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+getData.VALUE_FROM+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+getData.VALUE_TO+" ></div></div> ";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });

                          var butn =  $('#footer_quality_btn'+qty).find(':button').html();

                          

                          console.log('butn',butn);

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+qty+"' onclick='getvalue("+qty+",1)' style='width: 36px;'>Ok</button>";

                           $('#footer_quality_btn'+qty).append(tblData);

                             var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'   onclick='getvalue("+qty+",0)'>Cancel</button>";
                             
                           $('#footer_ok_btn'+qty).append(cancelfooter);

                         }else{
                          
                         }


                        }

                    }
           
            
            },

        });



  }


  function quaParaGet(qpItm){

    var Item_Code =  $('#ItemCodeId'+qpItm).val();
    if(Item_Code){

      var ItemCode =  $('#ItemCodeId'+qpItm).val();

    }else{
      var ItemCode =  $('#Item_CodeId'+qpItm).val();

      /*var ind_value      = $("input[type='radio'][name='itemname']:checked").val();
      
      var res            = ind_value.split("_");
      
      var res1           = res[0];
      
      var res2           = res[1];
      
      var itemcode       = $('#itemcode_'+res1+'_'+res2).val();
      
      var item_Code      =  itemcode.split('(');
      
      var ItemCode      = item_Code[0];*/
    }
    
   

 //  alert(ItemCode);
  //  alert(ItemCode);

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    if(ItemCode){
          setTimeout(function() {

            $.ajax({

              type: 'POST',

              url: qtyitemurl,

              data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

              success: function (data) {

                var data1 = JSON.parse(data);

               console.log('dataquaparamater',data1.data);

                if(data1.data==''){
                      $("#CalcTax"+qpItm).hide();
                    
                      
                      $("#qPnotfountbtn"+qpItm).html('Not Found');

                }else{
                    $("#CalcTax"+qpItm).prop('disabled',false);
                    $("#CalcTax"+qpItm).show();
                    $("#qPnotfountbtn"+qpItm).html('');
                }
             //  console.log(data1.data);
              }

            });

          }, 500);
    }else{}

  }


     function showItemDetail(viewid){

    var Item_Code =  $('#ItemCodeId'+viewid).val();

    if(Item_Code){

      ItemCode =Item_Code;

    }else{
      var ItemCode =  $('#Item_CodeId'+viewid).val();

    }

//alert(ItemCode);return false;
    

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

    $.ajax({

            type: 'POST',

            url: itemcodeurl,

            data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

              console.log(data1.data_hsn);

              if(data1.data==''){
                   
              }else{  
                    //console.log();
                  $("#itemCodeshow"+viewid).html(data1.data_hsn.ITEM_NAME+'<p>('+data1.data_hsn.ITEM_CODE+')</p>');
                  $("#hsncodeshow"+viewid).html(data1.data_hsn.HSN_CODE);
                  $("#taxcodeshow"+viewid).html(data1.data_hsn.TAX_CODE);
                  $("#itemDetailshow"+viewid).html(data1.data_hsn.ITEM_DETAIL);
                  $("#itemtypeshow"+viewid).html(data1.data_hsn.ITEMTYPE_CODE);
                  $("#itemgroupshow"+viewid).html(data1.data_hsn.ITEMGROUP_CODE);
                  $("#itemclassshow"+viewid).html(data1.data_hsn.ITEMCLASS_CODE);
                  $("#itemcategoryshow"+viewid).html(data1.data_hsn.ICATG_CODE);
              }
           //  console.log(data1.data);
            }

        });

  }

   function getplantdata(){

  $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

  var accCode = $('#account_code').val();
 // alert(accCode);
 // console.log(sers_code);



  $.ajax({

            url:acccodeurl,

            method : "POST",

            type: "JSON",

            data: {accCode: accCode},

            success:function(data){



              var data1 = JSON.parse(data);
                
               // console.log(data1);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  
                  $("#plantCodeshow").html(data1.data[0].ACC_NAME+'<p>('+data1.data[0].ACC_CODE+'</p>');
                  $("#plantpfctcodeshow").html(data1.data[0].ATYPE_CODE);
                  if(data1.data[0].ADD1){

                  $("#plantaddshow").html(data1.data[0].ADD1);
                  }else{
                  $("#plantaddshow").html('Null');
                   }

                   if(data1.data[0].ADD2){
                  $("#plantcityshow").html(data1.data[0].ADD2);
                    }else{
                   $("#plantcityshow").html('Null');
                    }
                    if(data1.data[0].ADD3){

                  $("#plantpinshow").html(data1.data[0].ADD3);
                    }else{

                      $("#plantpinshow").html('Null');
                    }
                   // console.log(data1.data[0].city);
                  if(data1.data[0].CITY_CODE){
                  $("#plantdistshow").html(data1.data[0].CITY_CODE);
                  }else{
                    $("#plantdistshow").html('Null');
                    }

                  if(data1.data[0].STATE_CODE){
                  $("#plantstateshow").html(data1.data[0].STATE_CODE);
                }else{
                  $("#plantstateshow").html('Null');
                }
                if(data1.data[0].EMAIL_ID){
                  $("#plantemailshow").html(data1.data[0].EMAIL_ID);
                }else{
                  $("#plantemailshow").html('Null');
                }

                if(data1.data[0].CONTACT_PERSON){
                  $("#plantphoneshow").html(data1.data[0].CONTACT_PERSON);
                }else{
                  $("#plantphoneshow").html('Null');
                }
                

                }

            }

          });
}


function getFgByBomNo1(itemno){

      var bom_num =  $('#bom_no').val();
      //var scrab_code =  $('#scrab_code').val();

     // var accnum =  $('#account_code').val();
    

      var bom_no = bom_num.split(' ');
      var bomno = bom_no[2];


      if(bomno){

        $("#Item_CodeId"+itemno).removeClass('itmbyQc');
        $("#ItemCodeId"+itemno).css('display','none');
      }else{
        $("#Item_CodeId"+itemno).addClass('itmbyQc');
        $("#ItemCodeId"+itemno).css('display','block');
      }

      $("#rqnumbyissue").val(bomno);
    // alert(orderno);
      
      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:bomitemurl,

          method : "POST",

          type: "JSON",

          data: {bomno: bomno},

           success:function(data){

              console.log(data);
              var data1 = JSON.parse(data);


              if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){
                 
                  if(data1.data==''){
                    $("#qty_prod").prop('readonly', false);

                  }else{

                    $("#fgList1").empty();


                    $("#qty_prod").val(data1.data[0].PROD_QTY);
                    $("#qty_prod").prop('readonly', true);

                    $.each(data1.data, function(k, getData){



                      $("#fgList1").append($('<option>',{

                        value:getData.ITEM_CODE,

                        'data-xyz':getData.ITEM_NAME,
                        text:getData.ITEM_NAME


                      }));

                    });
                     
                  }

       
                }/*if close*/

           }  /*success function close*/

      });  /*ajax close*/
    

  }


  $(document).ready(function(){



    $("#Plant_code").change(function(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var Plant_code =  $(this).val();

       
        //console.log(Plant_code);
          $.ajax({

            url:planturl,

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);
                  if(data1.data == ''){
                       var profitctr = '';
                       var pfctget = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctCode').val(pfctget);
                    }else{
                      $('#profitctrId').val(data1.data[0].pfct_code);
                      $('#pfctName').val(data1.data[0].pfct_name);
                      $('#getPfctCode').val(data1.data[0].pfct_code);

                    }

                }

            }

          });

      });

});
/*kamini*/


