@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
  .showbox{
    display: block;
  }
  ::placeholder {
    text-align:left;
  }
  table {
    border-collapse: collapse;
  }
  input:focus{border:1px solid yellow;} 
  .numright{
    text-align: right;
  }
  .remarkbtn{
    display: flex;
    height: 26px;
  }
  .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    border-top: 1px solid #cbc4c4;
  }
  .ErrMsgStyle{
    color: red;
    text-align: center;
    font-weight: 700;
    font-size: 16px;
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Payment Advice
      <small>Add Details</small>
    </h1>

    <ul class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

      <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}"> Payment Advice</a></li>

      <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}">Add Payment Advice</a></li>

    </ul>

  </section>

  <section class="content">
    <div class="row">
      <div class="col-sm-12">
        <div class="box box-primary Custom-Box">
          <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Payment Advice Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('view-payment-advice') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Payment Advice</a>

              </div>

          </div><!-- /.box-header -->

          @if(Session::has('alert-success'))

            <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>
                    <i class="icon fa fa-check"></i>
                      Success...!

                </h4>

                {!! session('alert-success') !!}

            </div>

          @endif

          @if(Session::has('alert-error'))

            <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                  <h4>
                    <i class="icon fa fa-ban"></i>
                    Error...!
                  </h4>

                  {!! session('alert-error') !!}

            </div>

          @endif

          <div class="box-body">
            <div class="row">

              <div class="col-md-3">

                <div class="form-group">

                  <label>Date: <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <?php 

                        $FromDate= date("d-m-Y", strtotime($fromDate));  
                        $ToDate= date("d-m-Y", strtotime($toDate));

                        $CurrentDate =date("d-m-Y");  

                      ?>
                      <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
                      <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                      <input type="text" class="form-control transdatepicker" name="date" id="vr_date" value="{{ $CurrentDate }}" placeholder="Select Date" >

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>
                    <!-- /.form-group -->
              </div>
                  <!-- /.col -->

              <div class="col-md-2">
              
                <div class="form-group">

                  <label> T Code : </label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="tracode" value="{{ $trans_head ?? '' }}" id="transcode" placeholder="Enter Transaction Head" readonly>

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div>
                      <!-- /.form-group -->
              </div>
                    <!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Series : 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                    </div>
                      <?php $seriecount = count($series_list); ?>

                    <input list="seriesList"  id="series_code" name="seriescode" class="form-control  pull-left" value="<?php if($seriecount ==1){ echo $series_list[0]->SERIES_CODE;}else{ echo old('seriescode');} ?>" placeholder="Select Series" onchange="getvrnoBySeries()">

                    <datalist id="seriesList">

                      <option  value="">-- Select --</option>
                      @foreach ($series_list as $key)

                      <option value='<?php echo $key->SERIES_CODE?>' <?php if($seriecount ==1){?>selected="selected" <?php } ?>   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div>

                  <small id="serscode_err" style="color: red;" class="form-text text-muted">
                    </small>
                       
                  <small id="series_code_errr" style="color: red;"></small>
                          
                </div>
                    <!-- /.form-group -->
              </div>
                  <!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Series Name: 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                    </div>

                    <input  id="seriesText" name="seriesname" class="form-control  pull-left" value="<?php if($seriecount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()"  readonly>

                  </div>
                    
                </div>
                  <!-- /.form-group -->
              </div>
                 <!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">
                  
                  <label> Vr No: </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                      <input type="hidden" name="" value="" id="vr_last_num">
                      
                      <input type="text" class="form-control rightcontent" name="vr_num" value="" placeholder="Enter Vr No" id="vrseqnum" readonly>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div>
                  <!-- /.form-group -->
              </div>
                  <!-- /.col -->

            </div>
                <!-- /.row -->

            <div class="row">
                
              <div class="col-md-3">

                <div class="form-group">
                
                  <label>Account Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                      </div>

                      <?php $accCount = count($acc_list); ?>
                      <input list="accCList"  id="accCodId" name="acc_code" class="form-control  pull-left" value="<?php if($accCount == 1){ echo $acc_list[0]->ACC_CODE; }else{echo old('acc_code');} ?>" placeholder="Select Account Code" oninput='GetAccountCode();tdsrateByAccCode()' oninput="this.value = this.value.toUpperCase()">

                      <datalist id="accCList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($acc_list as $key)

                        <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>
                    <input type="hidden" id="accType">
                    <input type="hidden" id="tdsByAccCode">
                    <input type="hidden" id="tds_rates">

                    <small id="tdsCodeNotAply" style="color: red;"></small>
                    <small id="tdsRateNotApply" style="color: red;"></small>
                   
                    <small id="profit_center_err" style="color: red;"> </small>

                </div>
                <!-- /.form-group -->
              </div>
                <!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">
                
                  <label>Account Name: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input  id="accCText" name="acc_code" class="form-control  pull-left" value="<?php if($accCount == 1){echo $acc_list[0]->ACC_NAME;}else{} ?>" placeholder="Select Account Name" readonly="">

                  </div>
               
                  <small id="profit_center_err" style="color: red;"> </small>

                </div>
                <!-- /.form-group -->
              </div>
                  <!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">
                
                  <label>Pfct Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                      <?php $pftccount  = count($pfct_list); ?>
                      <input list="profitList"  id="profitId" name="pfctcode" class="form-control  pull-left" value="<?php if($pftccount == 1){echo $pfct_list[0]->PFCT_CODE;}else{echo old('pfct_code');} ?>" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly>

                      <datalist id="profitList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($pfct_list as $key)

                        <option value='<?php echo $key->PFCT_CODE?>'   data-xyz ="<?php echo $key->PFCT_NAME; ?>" ><?php echo $key->PFCT_NAME ; echo " [".$key->PFCT_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>
                 
                    <small id="profit_center_err" style="color: red;"> </small>

                </div>
                <!-- /.form-group -->
              </div>
                <!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">
                
                  <label>Pfct Name: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input id="profitText" name="pfctcode" class="form-control  pull-left" value="<?php if($pftccount == 1){echo $pfct_list[0]->PFCT_NAME;}else{} ?>" placeholder="Select Profit Center Code"  readonly>
                    </div>
                </div>
                <!-- /.form-group -->
              </div>
                  <!-- /.col -->
            </div>
                <!-- /.row -->
            <div class="row">
                
              <div class="col-md-4">

                <div class="form-group">
                  
                  <label>Payment Type: <span class="required-field"></span></label>

                    <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input list="pmttypeList"  id="pmt_type" name="pmt_type" class="form-control  pull-left" value="{{ old('pmt_type')}}" placeholder="Select Payment Type" disabled="">

                        <datalist id="pmttypeList">

                          <option selected="selected" value="">-- Select --</option>

                        </datalist>

                    </div>
            
                    <small id="profit_center_err" style="color: red;"> </small>

                </div>
                  <!-- /.form-group -->
              </div>  
                  <!-- /.col -->
              <div class="col-md-2">
                  
                <div class="">

                  <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="margin-top: 23px;" onclick="btnSearchData();"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                </div>

              </div>
                  <!-- /.col -->
            </div>
                <!-- /.row -->
          </div>
              <!-- /.box body -->
        </div>
            <!-- /.custom box -->
      </div>
          <!-- /.col12 -->
    </div>
        <!-- /.row -->
  </section>
        <!-- /.section -->

  <section class="content" style="margin-top: -10%;">
      <div class="row hidebox" id="showboxdata">
          <div class="col-sm-12">
            <div class="box box-primary Custom-Box">
                <center> <span id="msg"></span></center> 
                <div class="box-body">
                  <div class="ErrMsgStyle" id="dataNFMsg"></div>
                  <form id="paymentAdviceTran">
                    @csrf
                    <div class="table-responsive">
                      <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                        
                          
                      </table>
                    </div>

                    <input type="hidden" name="company_code" id="companyName">
                    <input type="hidden" name="fy_code" id="fisclYear">
                    <input type="hidden" name="contra_date" id="contraDate">
                    <input type="hidden" name="vr_no" id="seqVrNum">
                    <input type="hidden" name="tran_code" id="transContraCode">
                    <input type="hidden" name="series_code" id="CodeSeries">
                    <input type="hidden" name="series_name" id="NameSeries">
                    <input type="hidden" name="pfct_code" id="ProfitCenterCode">
                    <input type="hidden" name="pfct_name" id="ProfitCenterName">

                    <p class="text-center">

                      <button class="btn btn-success" type="button" id="submitdata" disabled><i class="fa fa-floppy-o" aria-hidden="true" ></i>&nbsp;&nbsp; Save</button>
                      <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>
                    </p>

                  </form>
                    <!-- /.form -->
                </div>
                  <!-- /.box body -->
            </div>
              <!-- /.custom box -->
          </div>
            <!-- /.col -->
      </div>
  </section>
        <!-- /.section -->
</div>


@include('admin.include.footer')

<script type="text/javascript">

  function getvrnoBySeries(){

    var seriesCode = $('#series_code').val();
    var transcode  = $('#transcode').val();

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('get-vr-sequence-by-series') }}",

          method : "POST",

          type: "JSON",

          data: {seriesCode: seriesCode,transcode:transcode},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log('data1.response',data1.response);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.vrno_series == '' || data1.vrno_series ==null){
                    $('#vrseqnum').val('');
                  }else{
                    if(data1.vrno_series){
                      var getlastno = data1.vrno_series.LAST_NO;
                    }else{
                      var getlastno = '';
                    }

                    if(data1.vrnodata == ''){
                      $('#vrseqnum').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);
                    }
                  }

              }

          }

    });

  }

  function inputFieldValidation(){

    var vrDate     = $('#vr_date').val();
    var transCode  = $('#transcode').val();
    var seriesCode = $('#series_code').val();
    var accCode    = $('#accCodId').val();
    var pfctCode   = $('#profitId').val();
    var pmtType    = $('#pmt_type').val();
    var tdsCode    = $('#tdsByAccCode').val();
    var tdsRate    = $('#tds_rates').val();
   
    if(vrDate){
      $('#vr_date').css('border-color','#d2d6de');
      if(seriesCode){
        $('#series_code').css('border-color','#d2d6de');
        if(transCode){
          $('#transcode').css('border-color','#d2d6de');
          if(accCode){
            $('#accCodId').css('border-color','#d2d6de');
            var tdsCode1 = $('#tdsByAccCode').val();
            //console.log('tdsCode ',tdsCode1);
            if(tdsCode){
              $('#tdsCodeNotAply').html('');
              if(tdsRate){
                $('#tdsRateNotApply').html('');
                $('#tdsCodeNotAply').html('');
              }else{
                $('#tdsRateNotApply').html('TDS Rate Is Not Define for The Account');
              }
            }else{
              $('#tdsCodeNotAply').html('TDS Code Is Not Define for The Account');
              
            }
            if(pfctCode){
              $('#profitId').prop('readonly',false);
              $('#profitId').css('border-color','#d2d6de');
              if(pmtType){
                $('#pmt_type').css('border-color','#d2d6de');
              }else{
                $('#pmt_type').css('border-color','#ff0000').focus();
              }
            }else{
              $('#profitId').prop('readonly',false);
              $('#profitId').css('border-color','#ff0000').focus();
            }
          }else{
            $('#tdsCodeNotAply').html('');
            $('#tdsRateNotApply').html('');
            $('#accCodId').css('border-color','#ff0000').focus();
          }
        }else{
          $('#transcode').css('border-color','#ff0000').focus();
        }
      }else{
        $('#series_code').css('border-color','#ff0000').focus();
      }
    }else{
      $('#vr_date').css('border-color','#ff0000').focus();
    }
    
    if(vrDate && transCode && seriesCode && accCode && pfctCode && pmtType && tdsCode && tdsRate){
      $('#btnsearch').prop('disabled',false);
    }else{
      $('#btnsearch').prop('disabled',true);
    }

  }

  $(document).ready(function() {

    $( window ).on( "load", function() {

      var fromdateintrans = $('#FromDateFy').val();

      var todateintrans = $('#ToDateFy').val();


        var series_code = $("#series_code").val();
        var series_name = $("#seriesText").val();
        var profit_code = $("#profitId").val();
        var profit_name = $("#profitText").val();

        if(series_code){

            $("#CodeSeries").val(series_code);
        }

       if(series_name){

          $("#NameSeries").val(series_name);
       }

       if(profit_code){

        $("#ProfitCenterCode").val(profit_code);

       }

        if(profit_name){

        $("#ProfitCenterName").val(profit_name);

       }

       getvrnoBySeries();
       inputFieldValidation();

       // alert(series_name);

        $('.transdatepicker').datepicker({

          format: 'dd-mm-yyyy',
          orientation: 'bottom',
          todayHighlight: 'true',
          startDate :fromdateintrans,
          endDate : todateintrans,
          autoclose: 'true'
        });

    });

    $("#series_code").bind('change', function () {
      var seriescode =  $(this).val();
      var xyz = $('#seriesList option').filter(function() {

        return this.value == seriescode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      $("#seriesText").val(msg);

      if(msg=='No Match'){
         $(this).val('');
         $("#seriesText").val('');
         $('#CodeSeries').val('');
         $('#vrseqnum').val('');
         $('#profitId').prop('readonly',true);
      }else{
        $('#CodeSeries').val(seriescode);
        $('#NameSeries').val(msg);
        $('#profitId').prop('readonly',false);
      }
      inputFieldValidation();
    }); 

    $("#profitId").bind('change', function () {  
      var val = $(this).val();
      var xyz = $('#profitList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      $("#profitText").val(msg);

      if(msg=='No Match'){

         $(this).val('');
         $('#ProfitCenterCode').val('');
         $("#profitText").val('');

      }else{

        $('#ProfitCenterCode').val(val);
        $('#ProfitCenterName').val(msg);
      }
     inputFieldValidation();     
    });

    $("#accCodId").bind('change', function () {  
      var val = $(this).val();
      var xyz = $('#accCList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      $("#accCText").val(msg);

      if(msg=='No Match'){
         $(this).val('');
         $('#tds_rates').val('');
         $("#accCText").val('');
         $("#accType").val('');
         $("#pmt_type").prop('disabled', true); 
         $("#pmt_type").val(''); 
      }else{
         $('#tds_rates').val('');
         $("#accCText").val('');
         $("#accType").val('');
         $("#pmt_type").prop('disabled', false);    
      }

      inputFieldValidation();      
    });

    $("#pmt_type").bind('change', function () {  
      var val = $(this).val();
     
      var xyz = $('#pmttypeList option').filter(function() {

        return this.value == val;

      }).data('xyz');
  
      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $(this).val('');
         $('#pmt_type').val('');
     
      }else{
          
      }
      inputFieldValidation();       
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

    $('#vr_date').on('change',function(){
      var transDate = $('#vr_date').val();
      var compcode = $('#company_code').val();
      var fyyear = $('#fy_year').val();
      var vrseqno = $('#vrseqnum').val();
      var transcode = $('#transcode').val();
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
          $('#contraDate').val('');
           $('#series_code').prop('readonly',true);
          return false;
        }else{
          $('#showmsgfordate').html('');
          $('#contraDate').val(transDate);
          $('#companyName').val(compcode);
          $('#fisclYear').val(fyyear);
          $('#seqVrNum').val(vrseqno);
          $('#transContraCode').val(transcode);
          $('#series_code').prop('readonly',false);
          return true;
        }
    });

  });

  function GetAccountCode(){

      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var accountcode =  $('#accCodId').val();
        console.log('accountcode',accountcode);
        $.ajax({

              url:"{{ url('acc-code-for-cash-bank') }}",

               method : "POST",

               type: "JSON",

               data: {accountcode: accountcode},

               success:function(data){

                    var data1 = JSON.parse(data);
               
                    if (data1.response == 'error') {

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){
                      //console.log('data1.data[0]',data1.data[0]);
                        if(data1.data==''){
                          var nottds = '';
                          $('#tdsByAccCode').val(nottds);
                        }else{
                          
                          $('#accType').val(data1.data[0].ATYPE_CODE);

                          var accType= $('#accType').val();
                          $('#pmttypeList').empty();
                          if(accType == 'E'){
                            var datapayType= '<option value="Bill" data-xyz ="Bill">Bill</option>'+
                                              '<option value="Order/Contract" data-xyz ="Order/Contract">Order/Contract</option>'+
                                              '<option value="Adhoc" data-xyz ="Adhoc">Adhoc</option>'+
                                              '<option value="Employee Trip" data-xyz ="Employee Trip">Employee Trip</option>'+
                                              '<option value="Challan/LR" data-xyz ="Challan/LR">Challan/LR</option>'+
                                              '<option value="GRN" data-xyz ="GRN">GRN</option>'+
                                              '<option value="TRIP ADVANCE" data-xyz ="TRIP ADVANCE">TRIP ADVANCE</option>';
                              $('#pmttypeList').html(datapayType);
                          }else{
                            var datapayType= '<option value="Bill" data-xyz ="Bill">Bill</option>'+
                                              '<option value="Order/Contract" data-xyz ="Order/Contract">Order/Contract</option>'+
                                              '<option value="Adhoc" data-xyz ="Adhoc">Adhoc</option>'+
                                              '<option value="Challan/LR" data-xyz ="Challan/LR">Challan/LR</option>'+
                                              '<option value="GRN" data-xyz ="GRN">GRN</option>'+
                                              '<option value="TRIP ADVANCE" data-xyz ="TRIP ADVANCE">TRIP ADVANCE</option>';
                            $('#pmttypeList').html(datapayType);                   
                          }

                          $('#tdsByAccCode').val(data1.data[0].TDS_CODE);
                          var tdsCd = $('#tdsByAccCode').val();
                          if(tdsCd){
                              $('#tdsCodeNotAply').html('');
                          }else{

                          }
                         
                        }
                    }
               }

          });
  }

  function tdsrateByAccCode(){

    setTimeout(function() {
       $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var tdsCode = $('#tdsByAccCode').val();
      var acCode = $('#accCodId').val();
        $.ajax({

              url:"{{ url('tds-rate-calculate') }}",

               method : "POST",

               type: "JSON",

               data: {tdsCode: tdsCode,acCode:acCode},

               success:function(data){

                    var data1 = JSON.parse(data);
               
                    if (data1.response == 'error') {

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){
                        $('#tdsRateNotApply').html('');
                        $('#tds_rates').val(data1.data[0].TDS_RATE);
                        var tdsRate = $('#tds_rates').val();
                        if(tdsRate){
                            $('#tdsRateNotApply').html('');
                        }else{

                        }

                    }
               }

          });

        }, 500);
  }

  function btnSearchData(){

    var accCode  = $('#accCodId').val();
    var pmt_type = $('#pmt_type').val();


    $.ajaxSetup({

      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $.ajax({
        url:"{{ url('get-data-from-acc-ledger-for-pay-advice') }}",
        method : "POST",
        type: "JSON",
        data: {accCode: accCode,pmt_type:pmt_type},

        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {
              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              if(pmt_type == 'Adhoc'){
                $('#dataNFMsg').html('');
                $('#vr_date,#series_code,#accCodId,#profitId,#pmt_type').prop('readonly',true);
                $('#btnsearch').prop('disabled',true);
                $('#vr_date').datepicker("destroy");
              }else{
                $('#dataNFMsg').html("Data Not Found ... !");
              }
              
          }else if(data1.response == 'success'){

            $('#vr_date,#series_code,#accCodId,#profitId,#pmt_type').prop('readonly',true);
            $('#btnsearch').prop('disabled',true);
            $('#vr_date').datepicker("destroy");

            if(data1.data==''){

            }else{

              if(pmt_type == 'Bill'){
                $('#dataNFMsg').html('');
                $('#tbledata').empty();

                var headData = '<tr><th>Sr No</th><th>Vr Date</th><th>Vr No</th><th>Bill Amt</th><th>Bill Advice & Payment Done</th><th>Bill Advice Done Payment Pending</th><th>Order Amount Payment Done</th><th>Order Advice Pending</th><th>Advice Amt</th><th>TDs Amt</th><th>Net Amt</th></tr>';

                $('#tbledata').append(headData);

                var tdsRate = $('#tds_rates').val();
                var srNo1 =1;

                $.each(data1.data,function(key,value){

                    var bil_adv_pending = 0.00;
                    var bill_Adv_done   = 0.00;
                    var pendingAmt      = 0.00;
                    var paidAmt         = 0.00;

                    var accCode   = value.ACC_CODE;
                    var reftrans  = value.REF_TRAN_CODE;
                    var refvrno   = value.REF_VRNO;
                    var refseries = value.REF_SERIES;
                    
                    var partyvrdate  = value.PARTYBILLDATE;
                    var explodevrP   =  partyvrdate.split('-');
                    var gettransDate = explodevrP[2]+'-'+explodevrP[1]+'-'+explodevrP[0];

                    paidAmt         = value.paidAmt;
                    bil_adv_pending = value.billpendingAmt;
                    bill_Adv_done   = value.billpaidAmt;
                    pendingAmt      = value.pendingAmt;

                    if(bill_Adv_done == null){
                      bill_Adv_done =0.00;
                    }

                    if(bil_adv_pending == null){
                      bil_adv_pending =0.00;
                    }

                    if(paidAmt == null){
                      paidAmt =0.00;
                    }

                    if(pendingAmt == null){
                      pendingAmt=0.00;
                    }

                    adviceAmt = value.billamt -  value.billpaidAmt - value.billpendingAmt-value.paidAmt -value.pendingAmt;

                    var tdsAmount = adviceAmt * tdsRate /100;
                    var net_amount = adviceAmt - tdsAmount;

                    var NewRow = '<tr><td>'+srNo1+'<input type="checkbox" class="checkRowSub" onclick="checkboxFun();" value="'+value.PARTYBILLNO+'" name="slnoNum[]"></td>';

                       NewRow += '<input type="hidden" style="width: 82px;" id="vr_dt_'+srNo1+'" name="vr_date[]" value="'+gettransDate+'"><td>'+gettransDate+'<input type="hidden" style="width: 82px;" id="ref_tcode'+srNo1+'" name="ref_trans_code[]" value="'+value.TRAN_CODE+'"><input type="hidden" style="width: 82px;" id="ref_seris'+srNo1+'" name="ref_series[]" value="'+value.SERIES_CODE+'"></td>';

                       NewRow += '<input type="hidden" style="width: 82px;" id="vr_no_'+srNo1+'" name="refvr_no[]" value="'+value.PARTYBILLNO+'"><td>'+value.PARTYBILLNO+'</td>';
                       NewRow += '<input type="hidden" style="width: 82px;" id="billAmt'+srNo1+'" name="billAmt[]" value="'+ value.billamt+'"><td>'+ value.billamt+'</td>';
                       NewRow += '<input type="hidden" style="width: 82px;" id="bill_Adv_done'+srNo1+'" name="bill_Adv_done[]" value="'+bill_Adv_done+'"><td>'+bill_Adv_done+'</td>';
                       NewRow += '<input type="hidden" style="width: 82px;" id="bil_adv_pending'+srNo1+'" name="bil_adv_pending[]" value="'+bil_adv_pending+'"><td>'+bil_adv_pending+'</td>';
                       NewRow += '<input type="hidden" style="width: 82px;" id="ordr_amt_done'+srNo1+'" name="ordr_amt_done[]" value="'+paidAmt+'"><td>'+paidAmt+'</td>';
                       NewRow += '<input type="hidden" style="width: 82px;" id="ordr_amt_pending'+srNo1+'" name="ordr_amt_pending[]" value="'+pendingAmt+'"><td>'+pendingAmt+'</td>';
                       NewRow += '<td><input type="text" style="width: 82px;" class="numright" id="advice_amt_'+srNo1+'" name="adv_amountt[]" value="'+adviceAmt.toFixed(2)+'" oninput="calTdsAmt('+srNo1+')"><input type="hidden" style="width: 82px;" class="numright" id="advice_amount_temp_'+srNo1+'" name="advice_amount_temp[]" value=""></td>';
                       NewRow += '<td><input type="text" id="tds_amt'+srNo1+'" class="numright" readonly style="width: 76px;" name="tds_amount[]" value="'+tdsAmount.toFixed(2)+'"></td>';
                       NewRow += '<td><div class="remarkbtn"><input type="text" id="net_amt'+srNo1+'" class="numright" readonly style="width: 71px;margin-right: 2px;" name="net_amount[]" value="'+net_amount.toFixed(2)+'"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reamrkModl'+srNo1+'" id="remarkbtn_'+srNo1+'" onclick="showRemarkModel('+srNo1+')">R</button></div> <div id="reamrkModl'+srNo1+'" class="modal " ><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" style="text-align:center;">Remark</h5></div><div class="modal-body"><textarea  class="form-control" name="remarkDes[]"rows="3" value=""></textarea></div><div class="modal-footer"><button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button></div></div></div></div></td>';
                       
                       NewRow += '</tr>';

                       $("#showboxdata").addClass('showbox');
                       $("#tbledata").append(NewRow);

                       srNo1++;

                }); /* /. each loop */

              }else if(pmt_type == 'Order/Contract'){
                  $('#dataNFMsg').html('');
                  $("#tbledata").empty();

                  var headData = '<tr><th>Sr No</th><th>Vr Date</th><th>Vr No</th><th>Advance Amt As Per Order</th><th>Advice & Payment Done</th><th>Advice Done Payment Pending</th><th>Balence</th><th>Advice Amt <span id="errmsg" style="font-size:10px;font-weight: 500;"></span></th><th>TDS Amt</th><th>Net Pay</th></tr>';

                  $("#tbledata").append(headData);

                  var tdsRate = parseFloat($('#tds_rates').val());
                  var srNo =1;
                  var totalOrderAmt=0;
                  var totalPendingAmt=0.00;
                  var totalBal=0.00;
                  var totalAdvAmt=0.00;
                  var totaltdsAmt=0.00;
                  var totalNetAmt=0.00;

                  $.each(data1.data,function(key,value){

                    if(value.ADV_AMT == null){
                      var advAmtSet = 0.00;
                    }else{
                      var advAmtSet =value.ADV_AMT;
                    }

                    totalOrderAmt +=parseFloat(advAmtSet);
                    totalPendingAmt += parseFloat(value.pendingAmt || 0);

                    var vrdate = value.VRDATE;
                    var explodevr =  vrdate.split('-');

                    var gettransDate = explodevr[2]+'-'+explodevr[1]+'-'+explodevr[0];
                     
                    var pendingAmt = 0.00;
                    var paidAmt = 0.00;

                    var accCode = value.ACC_CODE;

                    paidAmt = value.paidAmt;
                    pendingAmt = value.pendingAmt;

                    if(paidAmt == null){
                      paidAmt =0.00;
                    }

                    if(pendingAmt == null){
                      pendingAmt =0.00;
                    }
                                
                    var balence = value.ADV_AMT - paidAmt - pendingAmt;

                    var tdsAmount = advAmtSet * tdsRate /100;
                    
                    var tdsAmtNew = tdsAmount.toFixed(2);
                    var net_amount = balence - parseFloat(tdsAmount);

                    totalBal += parseFloat(balence);
                    totalAdvAmt +=  parseFloat(advAmtSet);
                    totaltdsAmt += parseFloat(tdsAmount);
                    totalNetAmt += parseFloat(net_amount);

                    var NewRow = '<tr><td>'+srNo+'<input type="checkbox" class="checkRowSub" onclick="checkboxFun();" name="slnoNum[]" value="'+value.VRNO+'" name="paymentAdviceF[]"></td>';
                     NewRow += '<input type="hidden" style="width: 82px;" id="vr_dt_'+srNo+'" name="vr_date[]" value="'+value.VRDATE+'"><td style="    width: 12%;">'+gettransDate+'<input type="hidden" style="width: 82px;" id="ref_tcode'+srNo+'" name="ref_trans_code[]" value="'+value.TRAN_CODE+'"><input type="hidden" style="width: 82px;" id="ref_seris'+srNo+'" name="ref_series[]" value="'+value.SERIES_CODE+'"></td>';
                     NewRow += '<input type="hidden" style="width: 82px;" id="vr_no_'+srNo+'" name="refvr_no[]" value="'+value.VRNO+'"><td>'+value.VRNO+'</td>';
                     NewRow += '<input type="hidden" style="width: 82px;" class="totCrAmt" id="cr_amt'+srNo+'" name="cr_amt[]" value="'+advAmtSet+'"><td>'+advAmtSet+'</td>';
                     NewRow += '<input type="hidden" style="width: 82px;" id="paid_amt'+srNo+'" name="ad_pay_done[]" value="'+paidAmt+'"><td>'+paidAmt+'</td>';
                     NewRow += '<input type="hidden" style="width: 82px;" id="pending_amt'+srNo+'" name="getAdvice_amt[]" value="'+pendingAmt+'"><td>'+pendingAmt+'</td>';
                     NewRow += '<input type="hidden" style="width: 82px;" id="balenc_'+srNo+'" name="balence[]" value="'+balence.toFixed(2)+'"><td>'+balence.toFixed(2)+'</td>';
                     NewRow += '<td><input type="text" style="width: 82px;" class="numright" id="advice_amt_'+srNo+'" name="adv_amountt[]" value="'+balence.toFixed(2)+'" oninput="calTdsAmt('+srNo+')"><input type="hidden" style="width: 82px;" class="numright" id="advice_amount_temp_'+srNo+'" name="advice_amount_temp[]" value="'+balence.toFixed(2)+'"></td>';
                     NewRow += '<td><input type="text" id="tds_amt'+srNo+'" class="numright" readonly style="width: 76px;" name="tds_amount[]" value="'+tdsAmtNew+'"></td>';
                     NewRow += '<td><div class="remarkbtn"><input type="text" id="net_amt'+srNo+'" class="numright" readonly style="width: 71px;margin-right: 2px;" name="net_amount[]" value="'+net_amount.toFixed(2)+'"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reamrkModl'+srNo+'" id="remarkbtn_'+srNo+'" onclick="showRemarkModel('+srNo+')">R</button></div> <div id="reamrkModl'+srNo+'" class="modal " ><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" style="text-align:center;">Remark</h5></div><div class="modal-body"><textarea  class="form-control" name="remarkDes[]"rows="3" value=""></textarea></div><div class="modal-footer"><button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button></div></div></div></div></td>';
                     NewRow += '</tr>';

                    $("#showboxdata").addClass('showbox');

                    $("#tbledata").append(NewRow);

                    srNo++;

                  }); /* /. each*/

                  var headData1 = '<tr><th colspan="3"><span>Total</span></th><th><span id="ordr_total">'+totalOrderAmt.toFixed(2)+'</span></th></th><th><span id="paidtotl"></span></th><th><span id="pendingtotl">'+totalPendingAmt.toFixed(2)+'</span></th><th><span id="balencTotl">'+totalBal.toFixed(2)+'</span></th><th><span id="advicTotal">'+totalAdvAmt.toFixed(2)+'</span></th><th><span id="tdstotal">'+totaltdsAmt.toFixed(2)+'</span></th><th><span id="nettotal">'+totalNetAmt.toFixed(2)+'</span></th></tr>';

                  $('#tbledata').append(headData1);

              }else{


              } /* payment type condition*/

            } /* /. get data*/

          } /* /. if success*/

        } /* /. success*/
    }); /* /. ajax*/

    /* ------ when pay type is achoc -------- */

    if(pmt_type == 'Adhoc'){
      $('#dataNFMsg').html('');
      $("#tbledata").empty();

      var headData = '<tr><th>Sr No</th><th>Vr Date</th><th>Vr No</th><th>Order Amt</th><th>Advice & Payment Done</th><th>Advice Done Payment Pending</th><th>Balence</th><th>Advice Amt <span id="errmsg" style="font-size:10px;font-weight: 500;"></span></th><th>TDS Amt</th><th>Net Pay</th></tr><tr><td>1<input type="checkbox" class="checkRowSub" onclick="checkboxFun();" name="slnoNum[]" value="1" name="paymentAdviceF[]"></td><td>--<input type="hidden" style="width: 82px;" id="vr_dt_1" name="vr_date[]" value="--"><input type="hidden" style="width: 82px;" id="ref_tcode1" name="ref_trans_code[]" value="--"><input type="hidden" style="width: 82px;" id="ref_seris1" name="ref_series[]" value="--"></td><td><input type="hidden" style="width: 82px;" id="vr_no_1" name="refvr_no[]" value="1">--</td><td>--</td><td>--</td><td>--</td><td>--</td><td><input type="text" style="width: 82px;" class="numright" id="advice_amt_1" name="adv_amountt[]" value="" oninput="calTdsAmt(1)"></td><td><input type="text" id="tds_amt1" class="numright" readonly="" style="width: 76px;" name="tds_amount[]" value=""></td><td><div class="remarkbtn"><input type="text" id="net_amt1" class="numright" readonly style="width: 71px;margin-right: 2px;" name="net_amount[]" value=""><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reamrkModl1" id="remarkbtn1" onclick="showRemarkModel(1)">R</button></div> <div id="reamrkModl1" class="modal" ><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" style="text-align:center;">Remark</h5></div><div class="modal-body"><textarea  class="form-control" name="remarkDes[]"rows="3" value=""></textarea></div><div class="modal-footer"><button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button></div></div></div></div></tr>';

      $("#tbledata").append(headData);

      $("#showboxdata").addClass('showbox');

    }
    /* ------ when pay type is achoc -------- */

  } /* /. main function*/

  function calTdsAmt(rowval){

      var advice_amt = $('#advice_amt_'+rowval).val();
      var advice_amt_temp = $('#advice_amount_temp_'+rowval).val();
      var balance_amt = $('#balenc_'+rowval).val();

      var tds_rates = $('#tds_rates').val();

      var result_tds = advice_amt * tds_rates /100;
      $('#tds_amt'+rowval).val(result_tds);

     var tdsAmtval =  $('#tds_amt'+rowval).val();

     var netAmount = advice_amt - tdsAmtval;
     $('#net_amt'+rowval).val(netAmount);

     if(parseFloat(balance_amt) < parseFloat(advice_amt)){

        $("#errmsg").html('advice ammount should be less than balance ammount').css('color','red');

        $('#advice_amt_'+rowval).val(advice_amt_temp);
      
     }else{
        $("#errmsg").html('');
     // $('#advice_amt_'+rowval).val(advice_amt);
     }

  }
  function showRemarkModel(srNum){
    //$('#reamrkModl'+srNum).modal('show');
  }

  function checkboxFun(){
    var checkedCount = $("#tbledata input:checked").length;
    if(checkedCount > 0){
      $('#submitdata').prop('disabled',false);
    }else{
      $('#submitdata').prop('disabled',true);
    }
  }

  $(document).ready(function(){

    

    $("#submitdata").click(function () {

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

      });

      var acc_code    = $("#accCodId").val();
      var acc_name    = $("#accCText").val();
      var series_code = $("#series_code").val();
      var trans_code  = $("#transcode").val();
      var vrseq_num  = $("#vrseqnum").val();
      var vr_date  = $("#vr_date").val();
      //alert(acc_code);return false;
      var paymentid = [];
      var slnum     = [];
      var refvrno   = [];
      var adviceamt = [];
      var tdsamt    = [];
      var netpay    = [];
      var reftrans  = [];
      var refseris  = [];
      var remarkDes = [];

            //Loop through all checked CheckBoxes in GridView.
      $(".checkRowSub").each(function (){
          
          if($(this).is(":checked")){

            paymentid.push($(this).val());
            
          }

      });

      $('input[name^="slnoNum"]').each(function (){
          
          slnum.push($(this).val());

      });

      $('textarea[name^="remarkDes"]').each(function (){
          
          remarkDes.push($(this).val());

      });

      $('input[name^="refvr_no"]').each(function (){
          
          refvrno.push($(this).val());

      });

      $('input[name^="adv_amountt"]').each(function (){
          
          adviceamt.push($(this).val());

      });

      $('input[name^="tds_amount"]').each(function (){
          
          tdsamt.push($(this).val());

      });
        
      $('input[name^="net_amount"]').each(function (){
          
          netpay.push($(this).val());

      });

      $('input[name^="ref_trans_code"]').each(function (){
          
          reftrans.push($(this).val());

      });

      $('input[name^="ref_series"]').each(function (){
          
          refseris.push($(this).val());

      });

      $.ajax({

        url:"{{ url('save-payment-advice-perchase-order') }}",

         method : "POST",

         type: "JSON",

         data: {paymentid:paymentid,trans_code:trans_code,series_code:series_code,vrseq_num:vrseq_num,vr_date:vr_date,slnum:slnum,acc_code:acc_code,acc_name:acc_name,reftrans:reftrans,refseris:refseris,refvrno:refvrno,adviceamt:adviceamt,tdsamt:tdsamt,netpay:netpay,remarkDes:remarkDes},

         success:function(data){
           console.log(data);
           
            var obj = JSON.parse(data);

            if(obj.response=='error'){

               var responseVar = false;

              var url = "{{url('finance/view-payment-msg')}}";
              setTimeout(function(){ window.location = url+'/'+responseVar; });
            }else{

              var responseVar = true;

              var url = "{{url('finance/view-payment-msg')}}";
              setTimeout(function(){ window.location = url+'/'+responseVar; });
            }

         } /* /. success*/

      }); /* /. ajax*/

    }); /* /. submit function*/

  })

</script>

@endsection