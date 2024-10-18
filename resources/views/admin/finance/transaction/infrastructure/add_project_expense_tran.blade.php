@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .PageTitle{
    margin-right: 1px !important;
  }
  .required-field::before {
    content: "*";
    color: red;
  }
  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .showinmobile{
    display: none;
  }
  .inputboxclr{
    border-color: rgb(210, 214, 222);
    border: 1px solid lightgrey;
    margin-top: 2px;
    width:100%;
  }
  .rowInput{
    margin:0px;
    margin-bottom: 2px;
  }

  @media screen and (max-width: 600px) {

    .showinmobile{
      display: block;
    }
    .PageTitle{
      float: left;
    }
    .hideinmobile{
      display: none;
    }
  }

  table {
    border-collapse: collapse;
  }

  .table-responsive {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
  }

  .table {
      width: 100%;
      margin-bottom: 1rem;
      color: #212529;
  }

  .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #dee2e6;
  }
  .table td, .table th {
      padding: .75rem;
      vertical-align: top;

  }
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 2px;
      padding-bottom: 0px !important;
      vertical-align: top;
  }
  .amountAlign{
    text-align:right;
  }
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
      Project Expense Transaction
      <small> Add Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Master</a></li>
      <li class="active"><a href="{{ url('Transaction/Infrastructure/view-project-expense-tranasction') }}">Project Expense Transaction</a></li>
      <li class="active"><a href="{{ url('Transaction/Infrastructure/view-project-expense-tranasction') }}">Add Project Expense Transaction </a></li>
    </ol>

  </section>

<form id="projectExpense">
  @csrf
  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Add Project Expense Transaction</h2>

            <div class="box-tools pull-right showinmobile">

              <a href="{{ url('Transaction/Infrastructure/view-project-expense-tranasction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Project Expense Transaction</a>

            </div>

            <div class="box-tools pull-right hideinmobile">

              <a href="{{ url('Transaction/Infrastructure/view-project-expense-tranasction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Project Expense Transaction</a>

            </div>

          </div><!-- /.box-header -->

          <div class="box-body">

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label>Project Code : 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>

                    <input list="projectList"  id="project_code" name="project_code" class="form-control  pull-left" value="" placeholder="Select Project Code"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                    <datalist id="projectList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($projectList as $key)

                      <option value='<?php echo $key->PROJECT_CODE; ?>'   data-xyz ="<?php echo $key->PROJECT_NAME; ?>"><?php echo $key->PROJECT_NAME ; echo " [".$key->PROJECT_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div><!-- ./input group -->
                            
                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Project Name : 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>

                    <input type="text"  id="project_name" name="project_name" class="form-control  pull-left" value="" placeholder="Select Project Name"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly>

                  </div><!-- ./input group -->
                            
                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Gl Code : 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>

                    <input list="glList"  id="gl_code" name="gl_code" class="form-control  pull-left" value="" placeholder="Select Gl Code"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="glcodeFun('GLCODE')">

                    <datalist id="glList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($glList as $key)

                      <option value='<?php echo $key->GL_CODE; ?>'   data-xyz ="<?php echo $key->GL_NAME; ?>"><?php echo $key->GL_NAME ; echo " [".$key->GL_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div><!-- ./input group -->
                            
                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Gl Name : 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>

                    <input type="text"  id="gl_name" name="gl_name" class="form-control  pull-left" value="" placeholder="Select Gl Name"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly>

                  </div><!-- ./input group -->
                            
                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Pmt Voucher No: 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>

                    <input list="pmtVrnoList"  id="pmt_vrno" name="pmt_vrno" class="form-control  pull-left" value="" placeholder="Select Pmt Voucher No"  oninput="this.value = this.value.toUpperCase()" onchange="glcodeFun('PMTVRNO')" autocomplete="off">

                    <datalist id="pmtVrnoList">

                      <option selected="selected" value="">-- Select --</option>

                    </datalist>

                  </div><!-- ./input group -->
                  
                  <input type="hidden" name="" id="pmtFyYear">
                  <input type="hidden" name="glTranTblId" id="glTranTblId">

                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

            </div><!-- ./ROW -->

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label>Pmt Amount: 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>

                    <input type="text"  id="paymentAmt" name="pmt_amt" class="form-control  pull-left amountAlign" value="" placeholder="Select Pmt Amount"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly>

                  </div><!-- ./input group -->

                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Prev Allocated Amount: 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>

                    <input type="text"  id="prevAllocatedAmt" name="prevAllocatedAmt" class="form-control pull-left amountAlign" value="" placeholder="Select Prev Allowcated Amount"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly>
                    <input type="hidden" id="prevbalenceAmt">
                  </div><!-- ./input group -->

                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Allocation Amount: 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>

                    <input type="text"  id="allocateAmt" name="allocateAmt" class="form-control  pull-left amountAlign" value="" placeholder="Select Allowcation Amount"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly>

                  </div><!-- ./input group -->

                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Balance Amount: 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>

                    <input type="text"  id="balenceAmt" name="balenceAmt" class="form-control  pull-left amountAlign" value="" placeholder="Select Balance Amount"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly>

                    <input type="hidden" id="baleReflect">

                  </div><!-- ./input group -->

                </div><!-- /.form-group -->
                
              </div><!-- /.col -->
              
            </div><!-- /.row -->

          </div><!-- /.box body -->

        </div><!-- /. CUSTOME BOX -->

      </div><!-- /.COL 12 --> 

    </div><!--  /. ROW -->

  </section><!-- /.SECTION -->

  <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <div class="table-responsive">

              <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                <tr>

                  <th class="tdthtablebordr"><input class='check_all' type='checkbox' onclick="select_all()"/ title="Delete All Row"></th>
                  <th class="tdthtablebordr">Sr.No.</th>
                  <th class="tdthtablebordr">WBS Code</th>
                  <th class="tdthtablebordr">WBS Name</th>
                  <th class="tdthtablebordr">Budget Amt</th>
                  <th class="tdthtablebordr">Expense Dr Amt</th>
                  <th class="tdthtablebordr">Balance Amt</th>
                  <th class="tdthtablebordr">Dr Amt</th>

                </tr>

                <tr class="useful">

                  <td class="tdthtablebordr">
                    <input type="hidden" id="tempItemSave1" value="">
                    <input type='checkbox' class='case' id='firstrow1' onclick="checkcheckbox(1);" title="Delete Single Row" />
                  </td>

                  <td class="tdthtablebordr">
                    <span id='snum'>1.</span>
                    <input type="hidden" name="totlRwCount[]" class="rowCountCls" value="1" id="totlCountRw1">
                  </td>

                  <td class="tdthtablebordr" style="width:10%;">

                    <div class="input-group" style="display:flex;">

                      <input list="WBSList1" class="inputboxclr" id='wbs_code1' name="wbs_code[]" placeholder="Enter WBS Code" onchange="wbsListData(1)" oninput="this.value = this.value.toUpperCase()" autocomplete="off" />

                      <datalist id="WBSList1">

                          <option selected="selected" value="">-- Select --</option>

                      </datalist>

                    </div>

                  </td>

                  <td class="tdthtablebordr"  style="width:50%;">

                    <input type="text" class="inputboxclr" style="margin-bottom: 5px;" id='wbs_name1' name="wbs_name[]" placeholder="Enter WBS Name" readonly />

                  </td>

                  <td class="tdthtablebordr"  style="width:10%;">

                    <input type="text" class="inputboxclr amountAlign" style="margin-bottom: 5px;" id='budgetAmt1' name="budgetAmt[]" placeholder="Enter Budget Amt" readonly />

                  </td>

                  <td class="tdthtablebordr"  style="width:10%;">

                    <input type="text" class="inputboxclr amountAlign" style="margin-bottom: 5px;" id='expenseDrAmt1' name="expenseDrAmt[]" placeholder="Enter Expense Dr Amt" readonly />
                    
                  </td>

                  <td class="tdthtablebordr"  style="width:10%;">

                    <input type="text" class="inputboxclr amountAlign" style="margin-bottom: 5px;" id='balenceExpAmt1' name="balenceExpAmt[]" placeholder="Enter Balence Amt" readonly />
                  </td>

                  <td class="tdthtablebordr"  style="width:10%;">

                    <input type='text' class="debitcreditbox dr_amount inputboxclr amountAlign"  id='dr_amount1' name="dr_amount[]" autocomplete="off" placeholder="Enter Dr Amt" oninput='GetDebitAmount(1)'/>
                    
                  </td>
                  
                </tr>

              </table><!-- /.TABLE -->

            </div><!-- /.TABLE REPONSIVE -->

            <div class="row">

              <div class="col-md-12" style="display: flex;">

                <div style="width:50%">
                  
                  <button type="button" class='btn btn-danger delete' id="deletehidn" ><i class="fa fa-minus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Delete</button>

                  <button type="button" class='btn btn-info addmore' id="addmorhidn" ><i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Add More</button>

                  <small id="showDubDataMsg" style="color: red;"></small>
                  <input type="hidden" name="dublicateName1[]" id="dublicateName" value="">
                  <input type="hidden" name="deletedubName1[]" id="deletedubName" value="">

                </div>

                <div style="width:40%"></div>

                <div style="width:10%">
                  <input class="debitcreditbox inputboxclr numerRight amountAlign" style="background-color: #eeeeee;" type="text" name="totalDrAmt" id="totalDrAmt" readonly>
                </div>
                
              </div>
              
            </div>

            <div class="row" style="text-align: center;">
              <small id="showMsg" style="color:red;"></small><br>
              <small id="blankFieldMsg" style="color:red;"></small><br>
              <button class="btn btn-success" type="button" id="submitdata" onclick="submitProjectExpData()" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>
              
            </div>

          </div><!-- /.BOX-BODY -->

        </div><!-- /.CUSTOM-BOX -->

      </div><!-- /.COL-SM-12 -->

    </div><!-- /.ROW -->

  </section><!-- /. SECTION -->

</form><!-- /.form -->

</div>

@include('admin.include.footer')

<script>

  function checkcheckbox(slNo){

    var wbsCode = $('#wbs_code'+slNo).val();

    var dublicateName = wbsCode;

    if($('#firstrow'+slNo).is(':checked')) {
      
      var delArry = $("#deletedubName").val();

      if(delArry==''){
        $("#deletedubName").val(dublicateName);
      }else{
        var getPrevVal = $("#deletedubName").val();
        $("#deletedubName").val(getPrevVal+','+dublicateName);
      }

    }else{

      var itmafterUncheck = $('#deletedubName').val();
      var explodIUnChckTm = itmafterUncheck.split(',');
      const index = explodIUnChckTm.indexOf(dublicateName);
      if (index > -1) {
          explodIUnChckTm.splice(index, 1);
      }
      $('#deletedubName').val(explodIUnChckTm);
    }

  }

  /* ---------- DELETE ROW ---------- */ 

    $(".delete").on('click', function() {

        $('.case:checkbox:checked').parents("tr").remove();

        $('.check_all').prop("checked", false); 

        var totdrAmt = 0;

        $(".dr_amount").each(function () {
          
          if (!isNaN(this.value) && this.value.length != 0) {
              totdrAmt += parseFloat(this.value);
          }

          $("#allocateAmt").val(totdrAmt.toFixed(2));
          $("#totalDrAmt").val(totdrAmt.toFixed(2));

        });

        var payAmt     = parseFloat($('#paymentAmt').val());
        var preAlocAmt = parseFloat($('#prevAllocatedAmt').val());
        var alocAmt    = parseFloat($('#allocateAmt').val());

        var remainingBalAmt = payAmt - preAlocAmt - alocAmt;
        $('#balenceAmt').val(remainingBalAmt);

        var whenitmselect = $('#dublicateName').val();
        var splt_arrayOne = whenitmselect.split(',');
        var whenitmcheck = $('#deletedubName').val();
        var splt_arrayTwo = whenitmcheck.split(',');

        splt_arrayOne = splt_arrayOne.filter(function(val) {
            return splt_arrayTwo.indexOf(val) == -1;
        });
         
        splt_arrayTwo = splt_arrayTwo.filter(val => !splt_arrayTwo.includes(val));
        $('#dublicateName').val(splt_arrayOne);

        splt_arrayTwo = splt_arrayTwo.filter(function(val) {
            return splt_arrayOne.indexOf(val) == -1;
        });
         
        splt_arrayOne = splt_arrayOne.filter(val => !splt_arrayOne.includes(val));
        $('#deletedubName').val(splt_arrayOne);

        check();

    });

    function select_all() {

      $('input[class=case]:checkbox').each(function(){ 
        if($('input[class=check_all]:checkbox:checked').length == 0){ 
            $(this).prop("checked", false); 
        }else{
            $(this).prop("checked", true); 
        } 

      });

    }

    function check(){

      obj = $('table tr').find('span');

      if(obj.length==0){
        $('#submitdata').prop('disabled',true);
      }else{

        $.each( obj, function( key, value ) {
          id=value.id;
          $('#'+id).html(key+1);
        });

      }

    }

  /* ---------- DELETE ROW ---------- */ 

/* ---------- START : ADD MORE FUNCTINALITY -------- */

  var i=2;

  $(".addmore").on('click',function(){

    count=$('table tr').length;

    var data="<tr class='useful'><td class='tdthtablebordr'><input type='hidden' id='tempItemSave"+i+"' value=''><input type='checkbox' class='case' id='firstrow"+i+"' onclick='checkcheckbox("+i+");' title='Delete Single Row'></td>"+
      "<td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='totlRwCount[]' class='rowCountCls' value='"+i+"' id='totlCountRw"+i+"'></td>"+
      "<td class='tdthtablebordr' style='width:10%;'><div class='input-group' style='display:flex;'><input list='WBSList"+i+"' class='inputboxclr' id='wbs_code"+i+"' name='wbs_code[]' placeholder='Enter WBS Code' onchange='wbsListData("+i+")' oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><datalist id='WBSList"+i+"'><option selected='selected' value=''>-- Select --</option></datalist></div></td>"+
      "<td class='tdthtablebordr'  style='width:50%;'><input type='text' class='inputboxclr' style='margin-bottom: 5px;' id='wbs_name"+i+"' name='wbs_name[]' placeholder='Enter WBS Name' readonly /></td>"+
      "<td class='tdthtablebordr'  style='width:10%;'><input type='text' class='inputboxclr amountAlign' style='margin-bottom: 5px;' id='budgetAmt"+i+"' name='budgetAmt[]' placeholder='Enter Budget Amt' readonly /></td>"+
      "<td class='tdthtablebordr'  style='width:10%;'><input type='text' class='inputboxclr amountAlign' style='margin-bottom: 5px;' id='expenseDrAmt"+i+"' name='expenseDrAmt[]' placeholder='Enter Expense Dr Amt' readonly /></td>"+
      "<td class='tdthtablebordr'  style='width:10%;'><input type='text' class='inputboxclr amountAlign' style='margin-bottom: 5px;' id='balenceExpAmt"+i+"' name='balenceExpAmt[]' placeholder='Enter Balence Amt' readonly /></td>"+
      "<td class='tdthtablebordr'  style='width:10%;'><input type='text' class='debitcreditbox dr_amount inputboxclr amountAlign'  id='dr_amount"+i+"' name='dr_amount[]' autocomplete='off' placeholder='Enter Dr Amt' oninput='GetDebitAmount("+i+")'/></td></tr>";

    $('table').append(data);


    /* --------- START : GET WBS LIST ------------ */

      var projectCode = $('#project_code').val();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

          url:"{{ url('get-all-projectwbs-against-project') }}",
          method : "POST",
          type: "JSON",
          data: {projectCode: projectCode},
          success:function(data){
            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.data_wbs == ''){

              }else{

                var mslno = parseInt(i) - parseInt(1);

                $.each(data1.data_wbs, function(k, getData){

                  $("#WBSList"+mslno).append($('<option>',{

                    value:getData.WBS_CODE,
                    'data-xyz':getData.WBS_NAME,
                    text:getData.WBS_NAME

                  }));

                });
              }

            }/*/.response*/

          }/*/.sucess codn*/

      });/*/. ajax fun*/

    /* --------- END : GET WBS LIST ------------ */

  i++;});

/* ---------- END : ADD MORE FUNCTINALITY -------- */

  $(document).ready(function(){

    $('#gl_code').on('change',function(){

      var glcode =  $('#gl_code').val();

      var xyz = $('#glList option').filter(function() {

      return this.value == glcode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

        $('#gl_code').val('');
        $('#gl_name').val('');
         
      }else{
        $('#gl_name').val(msg);
      }

    });

    $('#project_code').on('change',function(){

      var projectcode =  $('#project_code').val();

      var xyz = $('#projectList option').filter(function() {

      return this.value == projectcode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

        $('#project_code').val('');
        $('#project_name').val('');
         
      }else{
        $('#project_name').val(msg);

        var projectCode = $('#project_code').val();

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({

            url:"{{ url('get-all-projectwbs-against-project') }}",
            method : "POST",
            type: "JSON",
            data: {projectCode: projectCode},
            success:function(data){
              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                if(data1.data_wbs == ''){

                }else{

                  $.each(data1.data_wbs, function(k, getData){

                    $("#WBSList1").append($('<option>',{

                      value:getData.WBS_CODE,
                      'data-xyz':getData.WBS_NAME,
                      text:getData.WBS_NAME

                    }));

                  });
                }

              }/*/.response*/

            }/*/.sucess codn*/

        });/*/. ajax fun*/

      }/*/. no match else*/

    });


  });

  function glcodeFun(fieldType){

    var gl_code     = $('#gl_code').val();
    var pmt_vrno    = $('#pmt_vrno').val();
    
    var pmtVrno =  $('#pmt_vrno').val();

    var xyz = $('#pmtVrnoList option').filter(function() {

    return this.value == pmtVrno;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){

      $('#pmt_vrno').val('');
       
    }else{
      
      var slitData = msg.split('~');
      $('#pmtFyYear').val(slitData[1]);
      $('#glTranTblId').val(slitData[2]);
    }

    var pmtFyYear   = $('#pmtFyYear').val();
    var glTranTblId = $('#glTranTblId').val();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        url: "{{ url('/Transaction/Infrastructure/get-vrno-and-alloc-amt-for-expense-gl') }}",
        method: "POST",
        type: "JSON",
        data: {gl_code:gl_code,pmt_vrno:pmt_vrno,fieldType:fieldType,pmtFyYear:pmtFyYear,glTranTblId:glTranTblId},
        success: function(data) {

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>" + data.message + "</p>");

          }else if (data1.response == 'success'){

            if(data1.data_voucherNo == ''){

            }else{

              $("#pmtVrnoList").empty();

              $.each(data1.data_voucherNo, function(k, getData){

                var fY_CODE = getData.FY_CODE; 
                var explodedFY_CODE = fY_CODE.split('-');

                var newVourNo = explodedFY_CODE[0]+'/'+getData.SERIES_CODE+'/'+getData.VRNO;

                $("#pmtVrnoList").append($('<option>',{

                  value:newVourNo,
                  'data-xyz':newVourNo+'~'+fY_CODE+'~'+getData.GLTRANID,
                  text:newVourNo

                }));

              });

            }

            if(data1.data_alocAmt == ''){

            }else{

              var balenceAmt = parseFloat(data1.data_alocAmt[0].DRAMT) - parseFloat(data1.data_alocAmt[0].WBS_ALLOC_AMT);

              $('#paymentAmt').val(data1.data_alocAmt[0].DRAMT);
              $('#prevAllocatedAmt').val(data1.data_alocAmt[0].WBS_ALLOC_AMT);
              $('#prevbalenceAmt').val(balenceAmt.toFixed(2));
              $('#balenceAmt').val(balenceAmt.toFixed(2));
              $('#baleReflect').val(balenceAmt.toFixed(2));
            }


          }/*/.success codn*/

        }/*/.success fun*/

    });/*/.ajax*/

  }

  function wbsListData(srNo){

    var wbsCode = $('#wbs_code'+srNo).val();

    var xyz = $('#WBSList'+srNo+' option').filter(function() {

    return this.value == wbsCode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){

      $('#wbs_code'+srNo).val('');
       
    }else{
      
      $('#wbs_name'+srNo).val(msg);
    }

    var temItem = $('#tempItemSave'+srNo).val();
    var getSelData = $('#dublicateName').val(); 
    var slptData = getSelData.split(',');
    var indexDt = slptData.indexOf(temItem);
    if (indexDt > -1) { // only splice array when item is found
      slptData.splice(indexDt, 1); // 2nd parameter means remove one item only
    }
    $('#dublicateName').val('');
    $('#dublicateName').val(slptData);


    var wbs_Code = $('#wbs_code'+srNo).val();
    var project_code = $('#project_code').val();

   
    console.log('wbs_Code',wbs_Code);
    if(wbs_Code){

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({

          url:"{{ url('get-budget-amount-of-project-wbs') }}",
          method : "POST",
          type: "JSON",
          data: {wbs_Code: wbs_Code,project_code:project_code},
          success:function(data){
            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              console.log('data1.amountData',data1.amountData);

              if(data1.amountData == ''){

              }else{

                $('#budgetAmt'+srNo).val(data1.amountData[0].BUDGET_AMOUNT);
                $('#expenseDrAmt'+srNo).val(data1.amountData[0].DRAMT);

                var balExpAmt = parseFloat(data1.amountData[0].BUDGET_AMOUNT) - parseFloat(data1.amountData[0].DRAMT);

                $('#balenceExpAmt'+srNo).val(balExpAmt.toFixed(2));

                 checkDubicateBodyEntry(srNo,wbs_Code);

              }

            }/*/.success codn*/

          }/*/.success fun*/

        });/*/.ajax*/

    }

  }

  function GetDebitAmount(slno){

    /* 
      alocate_AmtG = drAmount
      baleAlocatG = balexpAmt
      total_bal = balenceAmt
      balence_Amt = prevbalenceAmt
    */

    $('#blankFieldMsg,#showMsg').html('');

    $('#submitdata').prop('disabled',false);

    var drAmount       = parseFloat($('#dr_amount'+slno).val());
    var balexpAmt      = parseFloat($('#balenceExpAmt'+slno).val());
    var balenceAmt     = parseFloat($('#balenceAmt').val());
    var prevbalenceAmt = parseFloat($('#prevbalenceAmt').val());

    var totdrAmt = 0;

    $(".dr_amount").each(function () {
      
      if (!isNaN(this.value) && this.value.length != 0) {
          totdrAmt += parseFloat(this.value);
      }

      $("#allocateAmt").val(totdrAmt.toFixed(2));
      $("#totalDrAmt").val(totdrAmt.toFixed(2));

    });

    if(balenceAmt > balexpAmt){

      var expBalAmt = parseFloat($('#balenceExpAmt'+slno).val());
      var dr_Amount = parseFloat($('#dr_amount'+slno).val());

      if(dr_Amount > expBalAmt){
        $('#showMsg').html('Allocation Amt can not be greater than expense/balance amt');
        $('#dr_amount'+slno).val(0);
      }

      var drTotlif = 0;
      $(".dr_amount").each(function () {
      
        if (!isNaN(this.value) && this.value.length != 0) {
            drTotlif += parseFloat(this.value);
        }

        $("#totalDrAmt").val(drTotlif.toFixed(2));
        $("#allocateAmt").val(drTotlif.toFixed(2));
      
      });

      var prevAlocAmtif  =  parseFloat($('#prevbalenceAmt').val());
      var allocate_Amtif =  parseFloat($('#allocateAmt').val());

      var balencAmtif    = prevAlocAmtif - allocate_Amtif;

      $('#balenceAmt').val(balencAmtif);

    }else{
      
      var refBalAmt = $('#baleReflect').val();

      var newDrAmtTotl = 0;
      $(".dr_amount").each(function () {
      
        if (!isNaN(this.value) && this.value.length != 0) {
            newDrAmtTotl += parseFloat(this.value);
        }
      
      });

      if(newDrAmtTotl > refBalAmt){
        $('#showMsg').html('Allocation Amt can not be greater than expense/balance amt');
        $('#dr_amount'+slno).val(0);
      }

      var drTotl = 0;
      $(".dr_amount").each(function () {
      
        if (!isNaN(this.value) && this.value.length != 0) {
            drTotl += parseFloat(this.value);
        }

        $("#totalDrAmt").val(drTotl.toFixed(2));
        $("#allocateAmt").val(drTotl.toFixed(2));
      
      });

      var prevAlocAmt  =  parseFloat($('#prevbalenceAmt').val());
      var allocate_Amt =  parseFloat($('#allocateAmt').val());

      var balencAmt    = prevAlocAmt - allocate_Amt;

      $('#balenceAmt').val(balencAmt);

    }

  }

    /* ---------- check duplicate entry --------- */

    function checkDubicateBodyEntry(slNo,wbsCode){

      if(wbsCode){
        
        var checkDublicates = wbsCode;
        var existVal = $("#dublicateName").val();

        if(existVal == ''){
          $("#dublicateName").val(checkDublicates);
          $("#tempItemSave"+slNo).val(checkDublicates);
        }else{
          var blnkAry = [];
          var existGet = $("#dublicateName").val();

          if (existGet.indexOf(',') != -1){

            var segments = existGet.split(',');

            for(var i=0;i<segments.length;i++){
              blnkAry.push(segments[i]);
            }

            var checkDub = blnkAry.includes(checkDublicates);

            if(checkDub == true){
              $('#showDubDataMsg').html('Dublicate Details');
              $('#wbs_code'+slNo+',#wbs_name'+slNo+',#budgetAmt'+slNo+',#expenseDrAmt'+slNo+',#balenceExpAmt'+slNo+',#dr_amount'+slNo+'').val('');

            }else if(checkDub == false){
              $('#showDubDataMsg').html('');
              var getPrevVal = $("#dublicateName").val();
              $("#dublicateName").val(getPrevVal+','+checkDublicates);
              $("#tempItemSave"+slNo).val(checkDublicates);
              
            }

          }else{

            var blnkAry1 = [];
            var existGet1 = $("#dublicateName").val();
            blnkAry1.push(existGet1);

            var checkDub1 = blnkAry1.includes(checkDublicates);

            if(checkDub1 == true){
              $('#showDubDataMsg').html('Dublicate Details');
              $('#wbs_code'+slNo+',#wbs_name'+slNo+',#budgetAmt'+slNo+',#expenseDrAmt'+slNo+',#balenceExpAmt'+slNo+',#dr_amount'+slNo+'').val('');
             
            }else if(checkDub1 == false){
              $('#showDubDataMsg').html('');
              var getPrevVal1 = $("#dublicateName").val();
              $("#dublicateName").val(getPrevVal1+','+checkDublicates);    
              $("#tempItemSave"+slNo).val(checkDublicates);
                                 
            }

          }
        }

      }else{
          
      }
    }

  /* ------- CHECK DUBLICATE ENTRY -------- */

  function submitProjectExpData(){


    var rowIDget =[];
    var amntAry =[];

    $(".rowCountCls").each(function () {
        
        rowIDget.push(this.value);

    });

    for(var y=0;y<=rowIDget.length;y++){

      var colIdSlno = rowIDget[y];

      var drAmt = $('#dr_amount'+colIdSlno).val();

      if(drAmt==''){
        amntAry.push('YES');
      }else if(drAmt <= 0){
         amntAry.push('YES');
      }
      
    }

    var amtBlank = amntAry.find(function (element) {
        return element == 'YES';
    });

    if(amtBlank == 'YES'){

      $('#blankFieldMsg').html('<b>Zero amount can not be post.</b>');

    }else{
      $('#blankFieldMsg').html('');
      var data = $("#projectExpense").serialize();

      $.ajaxSetup({
        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
      });

      $.ajax({

          type: 'POST',
          url: "{{ url('/Transaction/Infrastructure/save-project-expense-transaction') }}",
          dataType: "json",
          data: data, 

          success: function (data) {

            var data1 = JSON.parse(JSON.stringify(data));

            if (data1.response == 'Error') {
              var responseVar = false;
              var tranName= 'PROJECTEXPENSE';
              var url = "{{url('/Transaction/Infrastructure/save-Trans-Success-Msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar+'/'+tranName; });
            }else{
              var responseVar = true;
              var tranName= 'PROJECTEXPENSE';
              var url = "{{url('/Transaction/Infrastructure/save-Trans-Success-Msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar+'/'+tranName; });
            }
        
          },
      });

    }

  }
  
</script>

@endsection