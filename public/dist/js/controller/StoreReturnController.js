
	class StoreReturn{


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

      var getreqno =  $('#issue_no').val();
     // var accnum =  $('#account_code').val();

      var issued_no = getreqno.split(' ')
      var issue_no = issued_no[2];
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

        $('#vr_date,#series_code,#Plant_code,#account_code,#due_days,#emp_code,#issue_no,#scrab_code,#cost_center_code').prop('readonly',true); 

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

          data: {ItemCode:ItemCode,issue_no:issue_no},

           success:function(data){

               //console.log(data);

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                  if(data1.mavg_rate){
                      $('#mvrate'+ItemId).val(data1.mavg_rate);
                    }else{
                     $('#mvrate'+ItemId).val('');
                    }
                 
                    if(data1.data==''){

                      var umcode = '';

                      var aumcode = '';

                      var cfactor = '';

                      $('#UnitM'+ItemId).val(umcode);

                      $('#AddUnitM'+ItemId).val(aumcode);

                      $('#Cfactor'+ItemId).val(cfactor);

                    }else{

                      $('#viewItemDetail'+ItemId).removeClass('showdetail');
                      
                      $('#item_post_code'+ItemId).val(data1.getpostCode[0].POST_CODE);

                      $('#UnitM'+ItemId).val(data1.data[0].UM_CODE);

                      $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                      $('#Cfactor'+ItemId).val(data1.data[0].AUM_FACTOR);

                      $('#req_qty'+ItemId).val(data1.req_qty[0].QTYISSUED);
                      $('#req_UnitM'+ItemId).val(data1.req_qty[0].UM);

                      $('#req_A_qty'+ItemId).val(data1.req_qty[0].AQTYISSUED);
                      $('#req_AddUnitM'+ItemId).val(data1.req_qty[0].AUM);
                      $('#remark_data'+ItemId).val(data1.req_qty[0].REMARK);
                      if(data1.BATCH_NO){
                        $('#batchno'+ItemId).html('Bacth No'+'-'+data1.BATCH_NO);
                      $('#batch_no'+ItemId).val(data1.BATCH_NO);
                    
                    }else{
                      $('#batchno'+ItemId).html('');
                      $('#batch_no'+ItemId).val('');
                    }

                   // console.log(data1.req_qty[0].remark);

                      
                      
                        if(data1.req_qty[0].QTYISSUED=='0.000'){
                          $('#qty'+ItemId).prop('readonly',true);
                          $('#deletehidn').prop('disabled',false);
                        }else{
                          $('#qty'+ItemId).prop('readonly',false);
                        }

                      $('#allItemShow'+ItemId).modal('show');
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

    var ItemCode =  $('#ItemCodeId'+viewid).val();
   // alert(requisition);

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
                  $("#glcodeshow").html('--');
                   }

                   if(data1.data[0].POST_CODE){
                  $("#postcodeshow").html(data1.data[0].POST_CODE);
                    }else{
                   $("#postcodeshow").html('--');
                    }
                    if(data1.data[0].RFHEAD1){

                  $("#rfhead1show").html(data1.data[0].RFHEAD1);
                    }else{

                      $("#rfhead1show").html('--');
                    }
                    console.log(data1.data[0].rfhead2);
                  if(data1.data[0].RFHEAD2){
                  $("#rfhead2show").html(data1.data[0].RFHEAD2);
                  }else{
                    $("#rfhead2show").html('--');
                    }

                  if(data1.data[0].RFHEAD3){
                  $("#rfhead3show").html(data1.data[0].RFHEAD3);
                }else{
                  $("#rfhead3show").html('--');
                }
                if(data1.data[0].RFHEAD4){
                  $("#rfhead4show").html(data1.data[0].RFHEAD4);
                }else{
                  $("#rfhead4show").html('--');
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
                      $('#profitctrId').val(data1.data[0].pfct_code);
                      $('#pfctName').val(data1.data[0].pfct_name);
                      $('#getPfctCode').val(data1.data[0].pfct_code);
                      $('#getPfctName').val(data1.data[0].pfct_name);

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
     document.getElementById("empcode_err").innerHTML = 'The Employee code field is required.';
     $('#empName').html('');
     $('#emplyeeName').val('');
     $("#scrab_code").prop('readonly',true);
     $("#cost_center_code").prop('readonly',true);
  }else{
    $('#empName').html(msg);
    $('#emplyeeName').val(empcode);
    document.getElementById("empcode_err").innerHTML = '';
    $('#due_days').prop('readonly',false);
    $("#scrab_code").prop('readonly',false);
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

                //return false;

                if (data1.response == 'error') {

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
      

   getItemByReqNum(getitemreturnurl,itemno){

      var getreqno =  $('#issue_no').val();
      var scrab_code =  $('#scrab_code').val();

     if(getreqno==''){
  
     $('#issue_no').css('border-color','#d2d6de');
     
     $('#issue_no').css('border-color','#ff0000').focus();
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#issue_no').css('border-color','#d2d6de');
    
     
     // $('#asset_code').css('border-color','#ff0000').focus();
     }


      var issued_no = getreqno.split(' ');
      var issue_no = issued_no[2];

      $("#rqnumbyissue").val(reqno);
   //  alert(itemno);
      
      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:getitemreturnurl,

          method : "POST",

          type: "JSON",

          data: {issue_no: issue_no,scrab_code:scrab_code},

           success:function(data){

              console.log(data);
              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){
                 
                  if(data1.data==''){
                    $("#ItemCodeId"+itemno).prop('readonly', true);
                  }else{


                    $("#ItemCodeId"+itemno).prop('readonly', false);
                    $("#ItemList"+itemno).empty();

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



   getItemByScrab(getscraburl,itemno){

      var getscrab_code =  $('#scrab_code').val();
      
     if(getscrab_code==''){
  
     $('#scrab_code').css('border-color','#d2d6de');
   
     $('#scrab_code').css('border-color','#ff0000').focus();
     
     }else{
      $('#scrab_code').css('border-color','#d2d6de');
     
     }


      if(getscrab_code==''){

        $("#issue_no").val('');
        $("#reqList").empty();
      }
        
      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:getscraburl,

          method : "POST",

          type: "JSON",

          data: {getscrab_code: getscrab_code},

           success:function(data){

            //console.log(data);

              var data1 = JSON.parse(data);


              if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){
                 
                  if(data1.data==''){
                    $("#issue_no").prop('readonly', true)

                  }else{

                    $("#reqList").empty();
                    $("#issue_no").prop('readonly', false);

                    $.each(data1.data, function(k, getData){
              //console.log(getData.item_code);
                    var getdate = getData.FY_CODE.split('-');
              //console.log(getdate);
                      $("#reqList").append($('<option>',{

                        value:getdate[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,


                      }));

                    });
                     
                  }

       
                }/*if close*/

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){
                 
                  if(data1.itemdata==''){
                    $("#ItemCodeId"+itemno).prop('readonly', true);
                  }else{


                    $("#ItemCodeId"+itemno).prop('readonly', false);
                    $("#ItemList"+itemno).empty();

                    $.each(data1.itemdata, function(k, getData){



                      $("#ItemList"+itemno).append($('<option>',{

                        value:getData.ITEM_CODE,

                        'data-xyz':getData.ITEM_NAME,
                        text:getData.ITEM_NAME


                      }));

                    });
                     
                  }

       
                }

           }  /*success function close*/

      });  /*ajax close*/
    

  }   


 }