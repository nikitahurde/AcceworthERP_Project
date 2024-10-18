var link = window.location.href;
var getseperate = link.split('/');

var folderName = getseperate[0]+'//'+getseperate[2]+'/'+getseperate[3];

/* ------- SHOW DATE ------ */
	
	$( window ).on( "load", function() {

      var fromdateintrans = $('#FromDateFy').val();
      var todateintrans = $('#ToDateFy').val();

      $('.transdatepicker').datepicker({

        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        startDate :fromdateintrans,
        endDate : todateintrans,
        autoclose: 'true'
      });

    });

/* ------- SHOW DATE ------ */

/* ------ GET DATA AGAINST PLANT ---------- */
	
	getpfctByPlant = () =>{

		var Plcode =  $('#Plant_code').val();
		var xyz = $('#PlantcodeList option').filter(function() {
			return this.value == Plcode;

		}).data('xyz');

      	var msg = xyz ?  xyz : 'No Match';

      	if(msg=='No Match'){
	        $('#plantname').val('');
	        $('#Plant_code').val('');
	        $('#profitctrId').val('');
	        $('#pfctName').val('');
      	}else{
	        $('#plantname').val(msg);
      	}

      	$.ajaxSetup({
            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      	});

      	var pfctgetUrl = folderName+'/Get-Pfct-Code-Name-By-Plant';

      	var Plant_code =  $('#Plant_code').val();

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

	              if(data1.data == ''){
	                   var profitctr = '';
	                   var pfctName = '';
	                   $('#profitctrId').val(profitctr);
	                   $('#pfctName').val(pfctName);
	                }else{
	                  $('#profitctrId').val(data1.data[0].PFCT_CODE);
	                  $('#pfctName').val(data1.data[0].PFCT_NAME);
	                }
	            }
	        }

	    });
	
	}

/* ------ GET DATA AGAINST PLANT ---------- */

/* ------ RUN FUNCTION ON DEPARTMENT FIELD ---------- */

	deptFun = ()=>{

		var deptCd =  $('#dept_code').val();
	    var xyz = $('#deptList option').filter(function() {
	      return this.value == deptCd;

	    }).data('xyz');

	    var msg = xyz ?  xyz : 'No Match';

	    if(msg=='No Match'){
	      $('#dept_code,#deptname').val('');
	    }else{
	      $('#deptname').val(msg);
	    }

	}

/* ------ RUN FUNCTION ON DEPARTMENT FIELD ---------- */

/* ------ RUN FUNCTION ON COST CENTER FIELD ---------- */

	costCenterFun =()=>{

		var costCd =  $('#cost_center_code').val();
	    var xyz = $('#costList option').filter(function() {
	      return this.value == costCd;

	    }).data('xyz');

	    var msg = xyz ?  xyz : 'No Match';
	   
	    if(msg=='No Match'){
	      $('#cost_center_code,#cost_center_name').val('');
	    }else{
	      $('#cost_center_name').val(msg);
	    }

	}
/* ------ RUN FUNCTION ON COST CENTER FIELD ---------- */

/*------- RUN FUNCTION ON EMP FIELD ------------ */

	empFun = ()=>{

			var empCd =  $('#emp_code').val();
	    var xyz = $('#emplList option').filter(function() {
	      return this.value == empCd;

	    }).data('xyz');

	    var msg = xyz ?  xyz : 'No Match';
	   
	    if(msg=='No Match'){
	      $('#emp_code').val('');
	    }else{
	      $('#emp_name').val(msg);
	    }

	}

/*------- RUN FUNCTION ON EMP FIELD ------------ */

/* --------- RUN FUNCTION ON PREVIOUS TRAN NO FIELD LIKE ISSUE NO,REQ NO ------ */

	prevTranNoFun = (storeActn) =>{

		if(storeActn == 'RETURN'){

			var issueNo = $('#issue_no').val();

	    var xyz = $('#issuNoList option').filter(function() {
	      return this.value == issueNo;

	    }).data('xyz');

	    var msg = xyz ?  xyz : 'No Match';
	   
	    if(msg=='No Match'){
	      $('#issue_no').val('');
	      $('#issueTblHeadID').val('');
	    }else{

	    	$('#issueTblHeadID').val('');
	    	var splitData = msg.split('~');
	    	$('#issueTblHeadID').val(splitData[1]);

	    }

	    var issueNoChk = $('#issue_no').val();

			if(issueNoChk){
				$('#item_codeWT1').removeClass('withpreTran');
				$('#item_codeWOT1').addClass('withpreTran');
			}else{
				$('#item_codeWT1').addClass('withpreTran');
				$('#item_codeWOT1').removeClass('withpreTran');
			}

		}

	}

/* --------- RUN FUNCTION ON PREVIOUS TRAN NO FIELD LIKE ISSUE NO,REQ NO ------ */

/* -------- SELECT ITEM ---------- */

	
/* -------- SELECT ITEM ---------- */

/* ------ RUN FUNCTION ON SIMPLE ITEM FIELD ---------- */

	showItemDetails = (slNo) =>{

    var itemCd = $('#item_codeWOT'+slNo).val();
   
    var xyz = $('#ItemList'+slNo+' option').filter(function() {
      return this.value == itemCd;
    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
 
    if(msg=='No Match'){
      $('#item_codeWOT'+slNo+',#itmC_code'+slNo+',#item_Name'+slNo+',#UnitM'+slNo+',#AddUnitM'+slNo+',#Cfactor'+slNo+'').val('');

    }else{

    	$('#itmC_code'+slNo+',#item_Name'+slNo+',#UnitM'+slNo+',#AddUnitM'+slNo+',#Cfactor'+slNo+'').val('');

      $('#itmC_code'+slNo).val(itemCd);
      $('#item_Name'+slNo).val(msg);
      $('#qty'+slNo).prop('readonly',false);
      var ItemCode = $('#item_codeWOT'+slNo).val();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var itemgetUrl = folderName+'/get-item-um-aum';

      $.ajax({

        url:itemgetUrl,
        method : "POST",
        type: "JSON",
        data: {ItemCode: ItemCode},
        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

            if(data1.data == ''){

            }else{
              $('#req_qty'+slNo+',#req_A_qty'+slNo+'').val(0);
              $('#issue_qty'+slNo+',#issue_A_qty'+slNo+'').val(0);
              $('#UnitM'+slNo).val(data1.data[0].UM_CODE);
              $('#AddUnitM'+slNo).val(data1.data[0].AUM_CODE);
              $('#Cfactor'+slNo).val(data1.data[0].AUM_FACTOR);
            }

          } /* /. success */

         } /* /. success function */

      }); /* /. ajax function */

    }

  } /* /. main function*/

/* ------ RUN FUNCTION ON SIMPLE ITEM FIELD ---------- */

/*-------- RUN FUNCTION ON QUANTITY FIELD ---------- */

	calAQty = (slNo)=>{

    var qty     = parseFloat($('#qty'+slNo).val());
    var cfactor = parseFloat($('#Cfactor'+slNo).val());

    if(qty){
      var calAqty = qty * cfactor;
      $('#A_qty'+slNo).val(calAqty);
    }else{
      $('#A_qty'+slNo).val('');
    }
    
  }

/*-------- RUN FUNCTION ON QUANTITY FIELD ---------- */
