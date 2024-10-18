var link        = window.location.href;
var getseperate = link.split('/');
var folderName  = getseperate[0]+'//'+getseperate[2]+'/'+getseperate[3];


/* ----------- START : WHEN CHANGE DATE ----------- */

$('#dateTime').on('change',function(){

    var transDate = $('#dateTime').val();
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
      $('#dateTime').val('');
      return false;
    }else if(transDate==''){ 

    }else{
      $('#showmsgfordate').html('');
      return true;
    }
});

/* ----------- START : WHEN CHANGE DATE ----------- */

/* ----------- START : GET PFCT DATA AGAINST PLANT ----------- */

  function getpfctByPlant(){

      var Plcode =  $('#Plant_code').val();
      var xyz = $('#PlantcodeList option').filter(function() {
        return this.value == Plcode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#plant_name').val('');
        $('#Plant_code').val('');
        $('#profitctrId').val('');
        $('#pfct_name').val('');
      }else{
        $('#plant_name').val(msg);
      }

      $.ajaxSetup({
            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      var Plant_code =  $('#Plant_code').val();
      var pfctdataURL = folderName+'/Get-Pfct-Code-Name-By-Plant';

      $.ajax({

        url:pfctdataURL,

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
                   var pfctName = '';
                   $('#profitctrId').val(profitctr);
                   $('#pfct_name').val(pfctName);
                }else{
                  $('#profitctrId').val(data1.data[0].PFCT_CODE);
                  $('#pfct_name').val(data1.data[0].PFCT_NAME);
                }


            }

        }

      });

  }

/* ----------- END : GET PFCT DATA AGAINST PLANT ----------- */

/* ----------- START : ACCOUTN FIELD VALIDATION ----------- */

  $('#customerCd').on('change',function(){

      var customer_code = $(this).val();
      console.log('customer_code',customer_code);

      var xyz = $('#customerList option').filter(function() {

          return this.value == customer_code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $("#customerCd").val('');
        $("#customerName").val('');
      }else{
         $("#customerName").val(msg);
      }
  });

/* ----------- END : ACCOUTN FIELD VALIDATION ----------- */

/* ----------- START : ITEM FIELD VALIDATION ----------- */

    $('#item_code').on('change',function(){

        var item_code = $(this).val();
        console.log('item_code',item_code);

        var xyz = $('#itemList option').filter(function() {

            return this.value == item_code;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $("#item_code").val('');
          $("#item_name").val('');
          $("#cfactor").val('');
          $("#um_OfItem").val('');
          $("#aum_OfItem").val('');
          $("#packing_code").val('');
          $("#packing_name").val('');
          $("#Item_Code1").val('');
          $('#packingList').empty();
        }else{
          $("#item_name").val('');
          $("#cfactor").val('');
          $("#um_OfItem").val('');
          $("#aum_OfItem").val('');
          $("#packing_code").val('');
          $("#packing_name").val('');
          $('#packingList').empty();
          $("#item_name").val(msg);
          $("#Item_Code1").val(item_code+'[ '+msg+' ]');
        }
    });

/* ----------- END : ITEM FIELD VALIDATION ----------- */

/* ----------- START : PACKING FIELD VALIDATION ----------- */

    $('#packing_code').on('change',function(){

        var packing_code = $(this).val();

        var xyz = $('#packingList option').filter(function() {

            return this.value == packing_code;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $("#packing_id").val('');
          $("#packing_name").val('');
        }else{
           $("#packing_name").val(msg);
        }
    });

/* ----------- END : PACKING FIELD VALIDATION  ----------- */