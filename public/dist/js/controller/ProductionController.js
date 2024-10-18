
class Production{


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


   ItemCodeGet(ItemId,itemcodeurl){
   
      var ItemCode =  $('#ItemCodeId'+ItemId).val();


      var qty_prod =  $('#qty_prod').val();

      $("#prodQty").val(qty_prod);



     // alert(itemcodeurl);
      
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

            $("#CalcTax"+ItemId).prop('disabled',true);

      }else{

         document.getElementById("Item_Name_id"+ItemId).value = msg;

         
        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide'); 

         $('#itemNameTooltip'+ItemId).html(msg); 

         $('#qty'+ItemId).prop('readonly',false);  
         $('#issueqty'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false); 

        $('#vr_date,#series_code,#Plant_code,#account_code,#due_days,#party_rf_no,#party_ref_date,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5,#emp_code,#fg_code,#qty_prod,#cost_center_code').prop('readonly',true); 

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

                console.log(data1);

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


                    }else{

                      $('#UnitM'+ItemId).val(data1.data[0].UM_CODE);

                      $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                      $('#issueUnitM'+ItemId).val(data1.data[0].UM_CODE);

                      $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);
                      $('#issueAddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                      $('#Cfactor'+ItemId).val(data1.data[0].AUM_FACTOR);

                      $('#viewItemDetail'+ItemId).removeClass('showdetail');
                      


                    }

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

        });  /*ajax close*/

      }else{}

  }



  FgCodeGet(itemcodeurl){
   
      var ItemCode =  $('#fg_code').val();

    if(ItemCode==''){
  
     $('#fg_code').css('border-color','#d2d6de');
     $('#qty_prod').css('border-color','#d2d6de');
     $('#fg_code').css('border-color','#ff0000').focus();
     $('#qty_prod').val('');
     $('#cost_center_code').val('');
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#fg_code').css('border-color','#d2d6de');
      $('#qty_prod').css('border-color','#ff0000').focus();
     // $('#asset_code').css('border-color','#ff0000').focus();
     }

     // alert(itemcodeurl);
      
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

                console.log(data1);

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

    quaParaGet(qpItm,quaparaurl){

    var itemcode =  $('#ItemCodeId'+qpItm).val();

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    if(itemcode){
          setTimeout(function() {

            $.ajax({

              type: 'POST',

              url: quaparaurl,

              data: {itemcode:itemcode}, // here $(this) refers to the ajax object not form

              success: function (data) {

                var data1 = JSON.parse(data);

               console.log('data',data1.data);

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


   showItemDetail(viewid,itemcodeurl){

    var ItemCode =  $('#ItemCodeId'+viewid).val();
    


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

   qty_parameter(qty,getquaparaurl){

   var ItemCode = $("#ItemCodeId"+qty).val();

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url:getquaparaurl,

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
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.item_category+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+data1.item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+getData.iqua_char+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_decs_"+qty+"_"+sr_no+"' name='iqua_desc[]' class='form-control inputtaxInd' value="+getData.iqua_desc+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+getData.char_fromvalue+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+getData.char_tovalue+" ></div></div> ";

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


 }