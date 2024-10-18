var root = window.location.protocol + '//' + window.location.host;
var folderName = 'biztechERP_DEV';

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
    var profitctrId = $('#profitctrId').val();
    var account_code = $('#account_code').val();
    var Plant_code = $('#Plant_code').val();
    var transcode = $('#transcode').val();
    var vrseqnum = $('#vrseqnum').val();
    var headid = $('#headid').val();
    var seriescode_sale = $('#series_code_sale').val();

    if(seriescode_sale){
      var seriesCd = seriescode_sale.split('[');
    }else{}

    if(headid){
      
      $('#head_id').val(headid);
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
    }

    if(Plant_code){
        $('#getPlantCode').val(Plant_code);
    }

    var rowCount = $('#rowCount').val();
    var rowCountEx = $('#rowCountEx').val();
    if(rowCount){
      var bodyRwCnt =rowCount;
    }else if(rowCountEx){
      var bodyRwCnt =rowCountEx;
    }
    var qCNum = $('#Quotn_compare_no').val();

    for(var z=0;z<bodyRwCnt;z++){
        var srNo = z+1;
        $('#viewItemDetail'+srNo).removeClass('showdetail');

        if(qCNum != ''){

          $('#Item_CodeId'+srNo).removeClass('showhideItm');
          $('#ItemCodeId'+srNo).addClass('showhideItm_itm');

        }else{

          $('#Item_CodeId'+srNo).addClass('showhideItm');
          $('#ItemCodeId'+srNo).removeClass('showhideItm_itm');

        }

    }

    

});

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




function CalAQty(quantityId){

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

    var balenQty = $('#balQtyByItem'+quantityId).val();
    var stockAvail = $('#stock_Qty'+quantityId).val();

    if(stockAvail){
        if(stockAvail > balenQty){
          $('#grateQtyShModel'+quantityId).modal('show');
        }else if(stockAvail < balenQty){
          if(quantity > stockAvail){
          $('#yrOpQtyShModel'+quantityId).modal('show');
            
          }
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

          if(chckitms == 1){
            $('#addmorhidn').prop('disabled',true);
          }else{
            $('#addmorhidn').prop('disabled',false);
          }
        
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
          $('#addmorhidn').prop('disabled',false);
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

function OkGetGransVal(aplyid,datacount,countercount,staticvalue){

    if(staticvalue==1){

          $('#aplytaxOrNot'+aplyid).html('1');
          $('#cancelbtn'+aplyid).html('');
          $('#appliedbtn'+aplyid).html('');

          var appliedbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';

          $('#appliedbtn'+aplyid).html(appliedbtn);
          
          $('#submitdata').prop('disabled', false);
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
         
         var cnclbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

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

/* -------------------------- AJAX CODE START ------------------------------- */

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
  
  var accdataUrl = root+'/'+folderName+'/get-acc-data-by-accdetail';

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

function showItemDetail(viewid){

    var ItemCodeOnM =  $('#ItemCodeId'+viewid).val();
    var Item_CodeOnF =  $('#Item_CodeId'+viewid).val();
    if(ItemCodeOnM){
      var ItemCode = ItemCodeOnM;
    }else if(Item_CodeOnF){
      var ItemCode = Item_CodeOnF;
    }

    var itemDetailgetUrl = root+'/'+folderName+'/get-item-um-aum';

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

/* -------------------------- AJAX CODE START ------------------------------- */