
	class StoreIssue {


  		constructor(name, year) {
   		
		}


		checkBlankFieldValidation(){

	    var series_code = $('#series_code').val();
	    var Plant_code = $('#Plant_code').val();
	    var account_code = $('#account_code').val();
	    var vr_date = $('#vr_date').val();
	    var due_days = $('#due_days').val();

	    if(vr_date){
	        $('#series_code').css('border-color','#d2d6de');
	        $('#series_code').css('border-color','#ff0000').focus();
	      if(series_code){
	          $('#series_code').prop('readonly',false);
	          $('#series_code').css('border-color','#d2d6de');
	        if(Plant_code){
	          $('#Plant_code').prop('readonly',false);
	          $('#Plant_code').css('border-color','#d2d6de');
	            if(account_code){
	              $('#account_code').css('border-color','#d2d6de');
	              $('#account_code').prop('readonly',false);
	              $('#due_days').prop('readonly',false);
	              $('#due_days').css('border-color','#ff0000').focus();

	              if(due_days){
	              	$('#due_days').css('border-color','#d2d6de');
	              }else{
	              	 $('#due_days').css('border-color','#ff0000').focus();
	              }
	            }else{
	              $('#account_code').prop('readonly',false);
	              $('#series_code,#Plant_code,#due_days').css('border-color','#d2d6de');
	              $('#account_code').css('border-color','#ff0000').focus();
	            }
	        }else{
	          $('#Plant_code').prop('readonly',false);
	          $('#Plant_code').css('border-color','#ff0000').focus();
	          $('#series_code,#account_code,#due_days').css('border-color','#d2d6de');
	        }

	      }else{
	        $('#series_code').prop('readonly',false);
	        $('#series_code').css('border-color','#ff0000').focus();
	        $('#Plant_code,#account_code,#due_days').css('border-color','#d2d6de');
	      }
	    }else{
	      $('#vr_date').css('border-color','#ff0000').focus();
	      $('#series_code,#Plant_code,#account_code,#due_days').css('border-color','#d2d6de');
	    }

	}


	checkBlankFieldValid(){

	    var series_code = $('#series_code').val();
	    var Plant_code = $('#Plant_code').val();
	    var account_code = $('#account_code').val();
	    var vr_date = $('#vr_date').val();
	    var tax_code = $('#tax_code').val();

	    if(vr_date){
	        $('#series_code').css('border-color','#d2d6de');
	        $('#series_code').css('border-color','#ff0000').focus();
	      if(series_code){
	          $('#series_code').prop('readonly',false);
	          $('#series_code').css('border-color','#d2d6de');
	        if(Plant_code){
	          $('#Plant_code').prop('readonly',false);
	          $('#Plant_code').css('border-color','#d2d6de');
	            if(account_code){
	              $('#account_code').css('border-color','#d2d6de');
	              $('#account_code').prop('readonly',false);
	              $('#tax_code').prop('readonly',false);
	              	if(tax_code){
	              		$('#tax_code').css('border-color','#d2d6de');
	                    
	              		$('#due_days').prop('readonly',false);
	              		$('#due_days').css('border-color','#ff0000').focus();
	              	}else{
	              		$('#tax_code').css('border-color','#ff0000').focus();
	              		$('#series_code,#Plant_code,#due_days').css('border-color','#d2d6de');
	              	}
	            }else{
	              $('#account_code').prop('readonly',false);
	              $('#account_code').css('border-color','#ff0000').focus();
	              $('#series_code,#Plant_code,#due_days,#tax_code').css('border-color','#d2d6de');
	            }
	        }else{
	          $('#Plant_code').prop('readonly',false);
	          $('#Plant_code').css('border-color','#ff0000').focus();
	          $('#series_code,#account_code,#due_days,#tax_code').css('border-color','#d2d6de');
	        }

	      }else{
	        $('#series_code').prop('readonly',false);
	        $('#series_code').css('border-color','#ff0000').focus();
	        $('#Plant_code,#account_code,#due_days').css('border-color','#d2d6de');
	      }
	    }else{
	      $('#vr_date').css('border-color','#ff0000').focus();
	      $('#series_code,#Plant_code,#account_code,#due_days').css('border-color','#d2d6de');
	    }

	}



	 ItemCodeGet(ItemId,itemcodeurl,quaitemurl){
   
      var ItemCode =  $('#ItemCodeId'+ItemId).val();

      var getreqno =  $('#req_no').val();

      var post_code = $("#post_code").val();

       $("#getSeriesPostCode"+ItemId).val(post_code);

     // var accnum =  $('#account_code').val();

      var req_no = getreqno.split(' ')
      var reqno = req_no[2];
      //console.log(reqno);

     // console.log('url',quaitemurl);

      
      var xyz = $('#ItemList'+ItemId+' option').filter(function() {

          return this.value == ItemCode;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';


      

      if(msg=='No Match'){

             $('#ItemCodeId'+ItemId).val('');

             document.getElementById("Item_Name_id"+ItemId).value = '';

             $('#qty'+ItemId).val('');

             $('#A_qty'+ItemId).val('');
             $('#UnitM'+ItemId).val('');
             $('#AddUnitM'+ItemId).val('');
            $('#viewItemDetail'+ItemId).addClass('showdetail');
            $('#itemNameTooltip'+ItemId).addClass('tooltiphide'); 

      }else{

         document.getElementById("Item_Name_id"+ItemId).value = msg;

         
        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide'); 

         $('#itemNameTooltip'+ItemId).html(msg); 

         $('#qty'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false); 

        $('#vr_date,#series_code,#Plant_code,#account_code,#due_days,#emp_code,#req_no,#cost_center_code').prop('readonly',true); 

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

          data: {ItemCode: ItemCode,reqno:reqno},

           success:function(data){

                var data1 = JSON.parse(data);

               
                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

              
                    if(data1.data==''){

                      var umcode = '';

                      var aumcode = '';

                      var cfactor = '';

                      $('#UnitM'+ItemId).val(umcode);

                      $('#AddUnitM'+ItemId).val(aumcode);

                      $('#Cfactor'+ItemId).val(cfactor);

                    }else{

                       
                       $('#item_post_code'+ItemId).val(data1.getpostCode[0].POST_CODE);
                      $('#mvrate'+ItemId).val(data1.MAVGRATE);
                      
                     $('#UnitM'+ItemId).val(data1.data[0].UM_CODE);

                      $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                      $('#Cfactor'+ItemId).val(data1.data[0].AUM_FACTOR);

                      $('#scrab_code'+ItemId).val(data1.data_hsn[0].SCRAP_CODE);

                      if(data1.BACTH_NO){
                        $('#batchno'+ItemId).html('Bacth No'+'-'+data1.BACTH_NO);
                        $('#batch_no'+ItemId).val(data1.BACTH_NO);
                    }else{
                       $('#batchno'+ItemId).html('');
                        $('#batch_no'+ItemId).val('');
                    }

                   if(data1.req_qty.length>0){

                    var rqty = data1.req_qty[0].QTYRECD;
                    var rissued = data1.req_qty[0].QTYISSUED;

                    var req_qty = parseFloat(rqty) - parseFloat(rissued);

                    var req_Aqty = data1.req_qty[0].AQTYRECD -  data1.req_qty[0].AQTYISSUED;

                    

                      $('#req_qty'+ItemId).val(req_qty.toFixed(2));
                      $('#req_UnitM'+ItemId).val(data1.req_qty[0].UM);

                      $('#req_A_qty'+ItemId).val(req_Aqty.toFixed(2));
                      $('#req_AddUnitM'+ItemId).val(data1.req_qty[0].AUM);
                      $('#remark_data'+ItemId).val(data1.req_qty[0].REMARK);
                   }else{

                   }
                     


                  
                    
                      
                      
                   // console.log(data1.req_qty[0].remark);

                      $('#viewItemDetail'+ItemId).removeClass('showdetail');
                      
                      if(data1.req_qty.length>0){

                        if(data1.req_qty[0].REQ_QTYISSUED=='0.000'){
                          $('#qty'+ItemId).prop('readonly',true);
                          $('#deletehidn').prop('disabled',false);
                        }else{
                          $('#qty'+ItemId).prop('readonly',false);
                        }
                      }else{}

                     // $('#allItemShow'+ItemId).modal('show');
                    }

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/


      setTimeout(function() {

          $.ajax({

            type: 'POST',

            url: quaitemurl,

            data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

             // console.log(data1);

              if(data1.data==''){
                    $("#CalcTax"+ItemId).hide();
                  
                    
                    $("#qPnotfountbtn"+ItemId).html('Not Found');

              }else{
                  $("#CalcTax"+ItemId).prop('disabled',false);
                  $("#CalcTax"+ItemId).show();
                  $("#qPnotfountbtn"+ItemId).html('');
              }
           //  console.log(data1.data);
            }

        });


      }, 500);

    }else{}

  }




   showItemDetail(viewid,itemcodeurl){

    var Item_Code =  $('#ItemCodeId'+viewid).val();

    if(Item_Code){

      var ItemCode = Item_Code;

    }else{

     var ItemCode =  $('#Item_CodeId'+viewid).val();

    }



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

             console.log(data1);

              if(data1.data==''){
                   
              }else{  
                    //console.log();
                  $("#itemCodeshow"+viewid).html(data1.data_hsn[0].ITEM_NAME+'/'+data1.data_hsn[0].ITEM_CODE);
                  $("#hsncodeshow"+viewid).html(data1.data_hsn[0].HSN_CODE);
                  $("#taxcodeshow"+viewid).html(data1.data_hsn[0].TAX_CODE);
                  $("#itemDetailshow"+viewid).html(data1.data_hsn[0].ITEM_DETAIL);
                  $("#itemtypeshow"+viewid).html(data1.data_hsn[0].ITEMTYPE_CODE);
                  $("#itemgroupshow"+viewid).html(data1.data_hsn[0].ITEMGROUP_CODE);
                  $("#itemclassshow"+viewid).html(data1.data_hsn[0].ITEMCLASS_CODE);
                  $("#itemcategoryshow"+viewid).html(data1.data_hsn[0].ICATG_CODE);
              }
           //  console.log(data1.data);
            }

        });

  }


  vrDate(){

  var transDate = $('#vr_date').val();
  //alert(transDate);
  var slipD =  transDate.split('-');
  var Tdate = slipD[0];
  var Tmonth = slipD[1];
  var Tyear = slipD[2];
  var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;
       // console.log(getproperDate);
  var selectedDate = new Date(getproperDate);
  var todayDate = new Date();
   var dueDays;    	

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

        
       // objvalidtn.checkBlankFieldValidation();

      return true;
    }


}



PartyRefDate(){ 

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
}


GetAccCode(accCodeurl){


  var deptCode = $("#account_code").val();
 
   if(deptCode==''){
  
     $('#account_code').css('border-color','#d2d6de');
     $('#emp_code').css('border-color','#d2d6de');
     $('#account_code').css('border-color','#ff0000').focus();
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#account_code').css('border-color','#d2d6de');
      $('#emp_code').css('border-color','#ff0000').focus();
     // $('#asset_code').css('border-color','#ff0000').focus();
     }

      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });

      $.ajax({

            url:accCodeurl,

            method : "POST",

            type: "JSON",

            data: {deptCode: deptCode},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);
                  $.each(data1.data, function(k, getData){

                    $("#emplList").empty();
                    $("#emp_code").prop('readonly',false);

                    $("#emplList").append($('<option>',{

                      value:getData.EMP_CODE,

                      'data-xyz':getData.EMP_NAME,
                      text:getData.EMP_NAME


                    }));

                  })

                }

            }

          });

  // objvalidtn.checkBlankFieldValidation();

}


 getcode(seriesurl){

  $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

  var sers_code = $('#series_code').val();
  //console.log(sers_code);

 // alert(sers_code);

  $.ajax({

            url:seriesurl,

            method : "POST",

            type: "JSON",

            data: {sers_code: sers_code},

            success:function(data){


              var data1 = JSON.parse(data);
              console.log(data1.data[0]);


                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  
                  $("#seriesCodeshow").html(data1.data[0].SERIES_CODE);
                  $("#seriesNameshow").html(data1.data[0].SERIES_NAME);
                  $("#trancodeshow").html(data1.data[0].TRAN_CODE);
                  if(data1.data[0].GL_CODE){

                  $("#glcodeshow").html(data1.data[0].GL_CODE);
                  }else{
                  $("#glcodeshow").html('Null');
                   }

                   if(data1.data[0].POST_CODE){
                  $("#postcodeshow").html(data1.data[0].POST_CODE);
                    }else{
                   $("#postcodeshow").html('Null');
                    }
                    if(data1.data[0].RFHEAD1){

                  $("#rfhead1show").html(data1.data[0].RFHEAD1);
                    }else{

                      $("#rfhead1show").html('Null');
                    }
                    
                  if(data1.data[0].RFHEAD2){
                  $("#rfhead2show").html(data1.data[0].RFHEAD2);
                  }else{
                    $("#rfhead2show").html('Null');
                    }

                  if(data1.data[0].RFHEAD3){
                  $("#rfhead3show").html(data1.data[0].rfhead3);
                }else{
                  $("#rfhead3show").html('Null');
                }
                if(data1.data[0].RFHEAD4){
                  $("#rfhead4show").html(data1.data[0].RFHEAD4);
                }else{
                  $("#rfhead4show").html('Null');
                }
                

                }

            }

          });
}

	
	PlantCode(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var Plant_code =  $('#Plant_code').val();



        /* var Plantcodeurl = "<?php echo url('get-pfct-code-name-by-plant-indend'); ?>";*/

          $.ajax({

            url:Plantcodeurl,

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
                       $('#getPfctName').val(pfctName);
                    }else{
                      $('#profitctrId').val(data1.data[0].PFCT_CODE);
                      $('#pfctName').val(data1.data[0].PFCT_NAME);
                      $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                      $('#getPfctName').val(data1.data[0].PFCT_NAME);

                    }

                }

            }

          });

      }



 getplantdata(Plantdetailsurl){

  $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

  var plntCode = $('#Plant_code').val();
  console.log('url',Plantdetailsurl);

 // alert(sers_code);

  $.ajax({

            url:Plantdetailsurl,

            method : "POST",

            type: "JSON",

            data: {plntCode: plntCode},

            success:function(data){


              var data1 = JSON.parse(data);
              console.log(data1.data[0]);


                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  
                  $("#plantCodeshow").html(data1.data[0].plant_name+'/'+data1.data[0].plant_code);
                  $("#plantpfctcodeshow").html(data1.data[0].pfct_code);
                  if(data1.data[0].address1){

                  $("#plantaddshow").html(data1.data[0].address1);
                  }else{
                  $("#plantaddshow").html('Null');
                   }

                   if(data1.data[0].city){
                  $("#plantcityshow").html(data1.data[0].city);
                    }else{
                   $("#plantcityshow").html('Null');
                    }
                    if(data1.data[0].pin){

                  $("#plantpinshow").html(data1.data[0].pin);
                    }else{

                      $("#plantpinshow").html('Null');
                    }
                    console.log(data1.data[0].district);
                  if(data1.data[0].district){
                  $("#plantdistshow").html(data1.data[0].district);
                  }else{
                    $("#plantdistshow").html('Null');
                    }

                  if(data1.data[0].state){
                  $("#plantstateshow").html(data1.data[0].state);
                }else{
                  $("#plantstateshow").html('Null');
                }
                if(data1.data[0].email){
                  $("#plantemailshow").html(data1.data[0].email);
                }else{
                  $("#plantemailshow").html('Null');
                }

                if(data1.data[0].phone1){
                  $("#plantphoneshow").html(data1.data[0].phone1);
                }else{
                  $("#plantphoneshow").html('Null');
                }
                

                }

            }

          });
}




EmpCode(){
  var empcode =  $("#emp_code").val();

  if(empcode==''){
  
     $('#emp_code').css('border-color','#d2d6de');
     $('#cost_center_code').css('border-color','#d2d6de');
     $('#emp_code').css('border-color','#ff0000').focus();
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#emp_code').css('border-color','#d2d6de');
      $('#cost_center_code').css('border-color','#ff0000').focus();
     // $('#asset_code').css('border-color','#ff0000').focus();
     }

  var xyz = $('#emplList option').filter(function() {

  	//console.log(this.value);

    return this.value == empcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
     $('#empName').html('');
     $('#emplyeeName').val('');
     //$("#ItemCodeId1").prop('readonly',true);
      document.getElementById("empcode_err").innerHTML = 'The Employee code field is required.';

     $("#req_no").prop('readonly',true);
     $("#job_work_order_no").prop('readonly',true);
     $("#cost_center_code").prop('readonly',true);
  }else{
    $('#empName').html(msg);
    $('#emplyeeName').val(empcode);
    document.getElementById("empcode_err").innerHTML = '';
    $('#due_days').prop('readonly',false);
    $("#ItemCodeId1").prop('readonly',false);
    $("#req_no").prop('readonly',false);
    $("#job_work_order_no").prop('readonly',false);
     $("#cost_center_code").prop('readonly',false);

  }
 //objvalidtn.checkBlankFieldValidation();

}

	submitdata(submitdataurl){


      var trcount=$('table tr').length;

      var valuetax= [];
      for(var y=0;y<trcount;y++){
        var trid = y+1;
       var ifnotaply = $('#qpApplyOrNot'+trid).html();

        valuetax.push(ifnotaply);
       
      }

      var found = valuetax.find(function (element) {
        return element == 0;
        });

     // console.log('found',found);
     // return false;
       
      if(found == 0){
          $("#taxNotAppied").modal('show');
      }else{


          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: submitdataurl,

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                var data1 = JSON.parse(data);

                 console.log(data1);

                // return false;

                 if(data1.response=='error'){

                  var responseVar = false;

                  var url = viewaurl;

                 }else{

                    var responseVar = true;

                  var url = viewaurl;
                 }
                

              setTimeout(function(){ window.location = url+'/'+responseVar; });
                 
              },

          });
      }
  }
      

   getItemByReqNum(getitemurl,itemno){

      var getreqno =  $('#req_no').val();
      var req_no = getreqno.split(' ')
      var reqno = req_no[2];



      var getorderno =  $('#job_work_order_no').val();
      var order_no = getorderno.split(' ')
      var orderno = order_no[2];

      var getjobcardno =  $('#job_card_no').val();
      var jobcardno = getjobcardno.split(' ')
      var jobcard_no = jobcardno[2];

      if(getreqno){
        $("#job_work_order_no").prop('readonly', true);
        $("#job_card_no").prop('readonly', true);
      }else if(orderno){
        $("#req_no").prop('readonly', true);
        $("#job_card_no").prop('readonly', true);
      }else if(jobcard_no){
        $("#req_no").prop('readonly', true);
        $("#job_work_order_no").prop('readonly', true);
      }else{
        $("#job_work_order_no").prop('readonly', false);
        $("#req_no").prop('readonly', false);
        $("#job_card_no").prop('readonly', false);
      }
      //console.log(getreqno);
     // var accnum =  $('#account_code').val();

      

      $("#rqnumbyissue").val(reqno);
      $("#jobcardnumbyissue").val(jobcard_no);

      if(getreqno || getorderno || jobcard_no){

        $("#Item_CodeId"+itemno).removeClass('itmbyQc');
        $("#ItemCodeId"+itemno).css('display','none');
      }else{
        $("#Item_CodeId"+itemno).addClass('itmbyQc');
        $("#ItemCodeId"+itemno).css('display','block');
      }


   //  alert(itemno);
      
      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:getitemurl,

          method : "POST",

          type: "JSON",

          data: {reqno: reqno,orderno: orderno,jobcard_no:jobcard_no},

           success:function(data){

              var data1 = JSON.parse(data);

              console.log(data1.response);

              if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){
                 
                  if(data1.data==''){
                    $("#ItemCodeId"+itemno).prop('readonly',true);

                  }else{

                    $("#ItemList"+itemno).empty();
                    $("#ItemCodeId"+itemno).prop('readonly',false);


                    $.each(data1.data, function(k, getData){

                      $("#ItemList"+itemno).append($('<option>',{

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


   Getqunatity(qtyId){

     var checkqty =$('#qty'+qtyId).val();
     var req_qty  =$('#req_qty'+qtyId).val();
     var mvrate  =$('#mvrate'+qtyId).val();
    

     var gr_amt;
     if(checkqty){

         var quantity =$('#qty'+qtyId).val().replaceAll(',', '');
         var cfactor = $('#Cfactor'+qtyId).val();
         var total = quantity * cfactor;
   
      if (quantity.length < 1){
        ('#qty'+qtyId).val('0.00');
        ('#A_qty'+qtyId).val('0.00');
      }else {
        var val = parseFloat(quantity);
        var formatted = inrFormat(quantity);

       /* if (formatted.indexOf('.') > 0) {
          var split = formatted.split('.');
          formatted = split[0] + '.' + split[1].substring(0, 2);
        }*/
        $('#qty'+qtyId).val(val);
      }

      



     
     $('#A_qty'+qtyId).val(total.toFixed(2));

      if(quantity){
        $('#rate'+qtyId).prop('readonly',false);
        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);
        $("#simulationbtn").prop('disabled', false);

        if(parseFloat(checkqty) > parseFloat(req_qty)){
        
         $('#errmsgqty'+qtyId).html('issue qty less than req qty.').css('color','red');
         $('#qty'+qtyId).val('');
         $('#A_qty'+qtyId).val('');
          $("#submitdata").prop('disabled', true);
          $("#deletehidn").prop('disabled', true);
          $("#simulationbtn").prop('disabled', true);

         
      }else{
        $('#errmsgqty'+qtyId).html('');
         $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#simulationbtn").prop('disabled', false);
        
      }
      }else{
         $('#rate'+qtyId).prop('readonly',true);
         $('#A_qty'+qtyId).val(0.00);
          $("#submitdata").prop('disabled', true);
          $("#deletehidn").prop('disabled', true);
          $("#addmorhidn").prop('disabled', true);
          $("#simulationbtn").prop('disabled', true);
      }

      var totalmvrate =  checkqty * mvrate;

       

          $("#itemmvrate"+qtyId).val(totalmvrate);


      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value.replaceAll(',', ''));

                
            }
          

          $("#basicTotal").val(gr_amt.toFixed(2));

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());

      var mv_amt =0;
       $(".mvrAmt").each(function () {
       
            if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                mv_amt += parseFloat(this.value.replaceAll(',', ''));

                
            }
        

          $("#rateTotal").val(mv_amt);
          
        });

       var allGrandAmount = parseFloat($('#basicTotal').val());

     }else{
      $('#A_qty'+qtyId).val(0.00);

      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value.replaceAll(',', ''));

                
            }

          $("#basicTotal").val(gr_amt.toFixed(2));

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());
     }
    



  }         


 }