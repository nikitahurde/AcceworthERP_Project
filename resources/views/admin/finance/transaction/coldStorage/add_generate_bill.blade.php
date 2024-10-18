@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .required-field::before {
    content: "*";
    color: red;
  }
  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .text-center{
    text-align: center;
  }
  .textRight{
    text-align:right !important;
  }
  .textLeft{
    text-align:left !important;
  }
  .readField{
    background-color: #eeeeee;
  }
  .hideColm{
  display: none;
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
  .inputboxclr{
    border: 1px solid #d7d3d3;
    width: 100%;
    margin-bottom: 2px;
  }
  .tdthtablebordr{
    border: 1px solid #00BB64;
  }
  .space{margin-bottom: 2px;}
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 3px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #00a65a;
    text-align: center;
  }
  .numerRightAlign{
    text-align:right;
  }

</style>

<div class="content-wrapper">
<!-- Content Header (Page header) -->

  <section class="content-header">

    <h1> Bill Transaction<small>Add Details</small></h1>

    <ul class="breadcrumb">

      <li>
        <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
      </li>

      <li>
        <a href="{{ url('/dashboard') }}">Transaction</a>
      </li>

      <li class="active">
        <a href="{{ url('/finance/form-transaction-mast') }}">Bill Transaction</a>
      </li>

    </ul>

  </section>

<form id="billGenerate">

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Bill Transaction</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/sales/view-sales-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

            </div>

          </div><!-- /.box-header -->

          <div class="box-body">

            <div class="overlay-spinner hideloader"></div>
 
              <div class="row">
              
                <div class="col-md-2">

                  <div class="form-group">

                    <label>Date: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <?php 

                        $CurrentDate =date("d-m-Y");
                        $FromDate    = date("d-m-Y", strtotime($fromDate));  
                        $ToDate      = date("d-m-Y", strtotime($toDate));  
                        $spliDate    = explode('-', $CurrentDate);
                        $yearGet     = Session::get('macc_year');
                        $fyYear      = explode('-', $yearGet);
                        $get_Month   = $spliDate[1];
                        $get_year    = $spliDate[2];
                        if($get_Month >3 && $get_year == $fyYear[1]){
                            $vrDate = $ToDate;
                        }else{
                            $vrDate = $CurrentDate;
                        }

                      ?>
                      <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                      <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                      <input type="text" class="form-control transdatepicker" name="vrDate" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

                    </div>

                    <small id="showmsgfortransdate" style="color: red;"></small>

                  </div><!-- /.form-group -->

                </div> <!-- /. col-md-2 -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> T Code : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="tranCd" value="{{$tranlist->TRAN_CODE}}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                      </div>

                  </div><!-- /.form-group -->

                </div> <!--  /. col-md-2 -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Series Code : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input list="seriesList"  id="series_code" name="seriesCode" onchange="getvrnoBySeries()" class="form-control  pull-left" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                        <datalist id="seriesList">

                          <option selected="selected" value="">-- Select --</option>

                          @foreach ($seriesList as $key)

                          <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>

                      </div>

                      <input type="hidden" id="seriesGlCd" name="seriesGlC">
                      <input type="hidden" id="seriesGlNm" name="seriesGlName">
                      <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                      <small id="showSeriesErr" style="color: red;"></small>
                  </div><!-- /.form-group -->

                </div> <!-- /. col-md-2 -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Series Name : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="series_name" value="" id="series_name" placeholder="Enter Series Name" readonly autocomplete="off">

                      </div>

                  </div><!-- /.form-group -->
                  
                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Vr No: </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>


                      <input type="text" class="form-control" name="vrseqnum" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                    </div>


                   </div>
                  <!-- /.form-group -->
                </div> <!-- /. col-md-2 -->

                <div class="col-md-2">

                  <div class="form-group" style="margin-bottom: 0px;">

                    <label>Bilty No: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input list="biltyNoList" class="form-control" id="biltyNo" name="biltyNo" placeholder="Select Bilty No" onchange="getdataofOutwardDone()" maxlength="25" autocomplete="off">

                        <datalist id="biltyNoList">

                          <option selected="selected" value="">-- Select --</option>

                          @foreach ($biltyNoList as $key)

                          <option value='<?php echo $key->BILTY_NO?>'   data-xyz ="<?php echo $key->BILTY_NO; ?>" ><?php echo $key->BILTY_NO ; echo " [".$key->ACC_NAME."]" ; ?></option>

                          @endforeach

                        </datalist>

                      </div>

                  </div><!-- /.form-group -->

                </div> <!-- /.col-md-2 -->

              </div> <!-- /.row -->
              
              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Customer Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input list="accList"  id="acc_code" name="acc_code" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Customer Code" readonly> 
                      </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Customer Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input type="text"  id="acc_name" name="acc_name" class="form-control  pull-left" value="" placeholder="Enter Customer Name" autocomplete="off" readonly> 

                      </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Posting Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
        
                      <input list="postingList"  id="posting_code" name="posting_code" class="form-control  pull-left" value="" placeholder="Enter Posting Code" autocomplete="off"> 

                      <datalist id="postingList">

                        <option selected="selected" value="">-- Select --</option>
                        
                      </datalist>

                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Posting Name : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" name="posting_name" value="" id="posting_name" placeholder="Enter Posting Name" value="" readonly autocomplete="off">

                      </div>

                  </div>
                  
                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Item Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
        
                      <input type="text"  id="item_code" name="item_code" class="form-control  pull-left" value="" placeholder="Enter Item Code" autocomplete="off" readonly> 

                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Item Name : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" name="item_name" value="" id="item_name" placeholder="Enter Item Name" value="" readonly autocomplete="off">

                      </div>

                  </div>
                  
                </div><!-- /.col -->
                
              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Packing Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
        
                      <input type="text"  id="packing_code" name="packing_code" class="form-control  pull-left" value="" readonly placeholder="Enter Packing Code" autocomplete="off"> 

                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Packing Name: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
        
                      <input type="text"  id="packing_name" name="packing_name" class="form-control  pull-left" value="" placeholder="Enter Packing Name" autocomplete="off" readonly=""> 

                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Storage Charge Type: <span class="required-field"></span></label>

                     <div class="input-group">

                      <input type="radio" class="optionsRadios1 stChargeType" name="charge_type" value="PER_UNIT_PER_MONTH" checked="">Per Unit Per Month<input type="radio" class="optionsRadios1 stChargeType" name="charge_type" value="SEASONAL" >Seasonal<input type="radio" class="optionsRadios1 stChargeType" name="charge_type" value="FIXED">Fixed

                    </div>
                    <input type="hidden" value="" name="st_ChargeType" id="st_ChargeType">
                  </div>
              
                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Rate Per Month : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
        
                      <input type="text"  id="ratePerMonth" name="ratePerMonth" class="form-control  pull-left" value="" autocomplete="off" readonly placeholder="Enter Rate Per Month"> 
                    
                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Extra Days charges : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
        
                      <input type="text"  id="extraDaysCharges" name="extraDaysCharges" class="form-control  pull-left" value="" autocomplete="off" readonly placeholder="Enter Extra Days charges"> 
                    
                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->
                
              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Tax Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
        
                      <input list="taxList"  id="taxCode" name="taxCode" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Tax Code"> 

                      <datalist id="taxList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($taxList as $key)

                        <option value='<?php echo $key->TAX_CODE?>'   data-xyz ="<?php echo $key->TAX_NAME; ?>" ><?php echo $key->TAX_NAME ; echo " [".$key->TAX_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>
                  
                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Tax Name: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
        
                      <input type="text"  id="tax_name" name="tax_name" class="form-control  pull-left" value="" placeholder="Enter Tax Name" autocomplete="off" readonly=""> 

                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-1">

                  <button type="button" style="margin-top: 10px;" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1);getGrandTotal(1);" disabled>Calc Tax </button>
                  <input type="hidden" value="" name="taxDataCount" id="data_count1">
                  <div id="aplytaxOrNot1" class="aplynotStatus"></div>
                  <div id="cancelbtn1"></div>
                  <div id="appliedbtn1"></div>
                  
                </div><!-- /.col -->
                
              </div><!-- /.row -->

          </div><!-- /.box-body -->

        </div><!-- /.custom box -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->

  <section class="content"  style="margin-top: -10%;">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-body">

              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbleBodydata">

                </table><!-- /.table -->

              </div><!-- /.table-responsive -->

              <div class="row">

                <div class="col-md-3"></div>
                <div class="col-md-6" style="text-align: center;">
                  <small style="color:red;" id="qtyGreaterMsg"></small>
                </div>
                <div class="col-md-3"></div>
                
              </div>
              <br>
              <div class="row">
                <input type="hidden" name="basicValue" id="basic">
                <input type="hidden" name="netAmt" id="getNetAmnt">
                <div class="col-md-12" style="text-align: center;">

                  <button class="btn btn-primary" type="button" id="simulation" onclick="billSimulation()" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Simulation</button>

                  <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
                  <button class="btn btn-success" type="button" id="submitdata" onclick="submitBillGenerate(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                  <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

                  <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitBillGenerate(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button>
                </div>

              </div><!-- /.row -->

            </div><!-- /. box-body -->

          </div><!-- /. Custom-Box -->

        </div><!-- /.col-sm-12 -->

      </div><!-- /.row -->

    </section><!-- /.section -->

    <!-- ------ CALC TAX MODAL ------------  -->
  
      <div class="modal fade" id="tds_rate_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;overflow-y: scroll;">

            <div class="modal-header">

              <div class="row">
                
                <div class="col-md-6">

                  <div class="form-group">
                      <lable class="settaxcodemodel col-md-4" style="padding: 0px;">Tax Code - </lable>
                               
                      <input type="text" class="settaxcodemodel col-md-8" id="tax_code1" style="border: none; padding: 0px;margin-top: -6px;" readonly>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <h5 class="modal-title settaxcodemodel" id="exampleModalLabel">Tax / Charges / etc Calculation</h5>
                </div>

              </div>

            </div>

            <div class="modal-body table-responsive">

              <div class="modalspinner hideloaderOnModl"></div>

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tax_rate_1">

                </table><!-- /.table -->

            </div>

            <div class="modal-footer">

              <center> <small  id="footer_ok_btn1"></small>
              <small  id="footer_tax_btn1" style="width: 10px;"></small>
             </center>

            
            </div>

          </div>

        </div>

      </div>

    <!-- ------ CALC TAX MODAL ------------  -->

</form>

</div>



<!-- ------ SIMULATION MODAL ------------  -->
  
  <div class="modal fade in" id="simulation_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">

    <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">

      <div class="modal-content" style="border-radius: 5px;">

        <div class="modal-header">

          <div class="row">

            <div class="col-md-12">

              <h5 class="modal-title settaxcodemodel" style="text-align: center;" id="exampleModalLabel">Simulation A/c Ledger</h5>

          </div>

        </div>

        <div class="modal-body table-responsive">

          <table class="table tdthtablebordr" border="1" cellspacing="0"  id="siml_body">
            
          </table>
          
          <center><button type="button" class="btn btn-primary " style="width: 10%;" data-dismiss="modal">Ok</button>
         </center>

        </div>


      </div>

    </div>

  </div>

<!-- ------ SIMULATION MODAL ------------  -->

@include('admin.include.footer')

<script type="text/javascript">

  $(document).ready(function() {

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

      $('#posting_code').on('change',function(){

        var postingCd =  $('#posting_code').val();
        var xyz = $('#postingList option').filter(function() {

          return this.value == postingCd;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
          $('#posting_code').val('');
          $('#posting_name').val('');
        }else{
          $('#posting_name').val(msg);

        }

      });

    });

    $('#vr_date').on('change',function(){
        var trans_date = $('#vr_date').val();
        var slipD =  trans_date.split('-');
        var Tdate = slipD[0];
        var Tmonth = slipD[1];
        var Tyear = slipD[2];
        var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;   
        var selectedDate = new Date(getproperDate);
        var todayDate = new Date();  

        if(selectedDate > todayDate){

          $('#showmsgfortransdate').html('Transaction Date Can Not Be Greater Than Today').css('color','red');
          $('#vr_date').val('');
          return false;

        }else{
          $('#showmsgfortransdate').html('');
          return true;
        }    

    });

    $('#taxCode').on('change',function(){

      var taxCd =  $('#taxCode').val();
      var xyz = $('#taxList option').filter(function() {

        return this.value == taxCd;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#taxCode').val('');
        $('#CalcTax1').prop('disabled',true);
      }else{
        $('#tax_name').val(msg);
        $('#CalcTax1').prop('disabled',false);
      }

    });

  });

  function getvrnoBySeries(){

    var seriesCd =  $('#series_code').val();
    var xyz = $('#seriesList option').filter(function() {

      return this.value == seriesCd;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $('#series_code').val('');
      $('#series_name').val('');
      $('#vrseqnum').val('');
    }else{
       $('#vrseqnum').val('');
      $('#series_name').val(msg);
    }

    var seriesCode = $('#series_code').val(); 
    var transcode = $('#transcode').val();

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

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.vrno_series == ''){

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

                  if(data1.data == ''){

                  }else{
                    $('#seriesGlCd').val(data1.data[0].GL_CODE);
                    $('#seriesGlNm').val(data1.data[0].GL_NAME);
                  }

              }

          } /* /. SUCCESS */

    }); /* /. AJAX */

  }  /* /. MAIN FUNCTION*/


  function getdataofOutwardDone(){

    var biltyNo =  $('#biltyNo').val();
    var tranCd =  $('#transcode').val();


    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('transaction/ColdStorage/data-of-bilty-no') }}",

          method : "POST",

          type: "JSON",

          data: {biltyNo: biltyNo,tranCd:tranCd},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.dataBilty == ''){

                  }else{

                    $('#acc_code').val(data1.dataBilty[0].ACC_CODE);
                    $('#acc_name').val(data1.dataBilty[0].ACC_NAME);
                    $('#item_code').val(data1.dataBilty[0].ITEM_CODE);
                    $('#item_name').val(data1.dataBilty[0].ITEM_NAME);
                    $('#packing_code').val(data1.dataBilty[0].PACKING_CODE);
                    $('#packing_name').val(data1.dataBilty[0].PACKING_NAME);
                    $('#ratePerMonth').val(data1.dataBilty[0].RATE_PER_MONTH);
                    $('#extraDaysCharges').val(data1.dataBilty[0].EXTRA_DAYS_CHARGES);
                    $("input[name=charge_type][value='"+data1.dataBilty[0].STORAGE_TYPE+"']").prop("checked",true);
                    $("input[name=charge_type]").prop("disabled",true);

                    /* ---------- HEAD DATA ---------- */

                    var headData ="<tr><th>Sr.No.</th><th>Cold Storage</th><th>Chamber</th><th>Floor</th><th>Block</th><th>Qty Issued</th><th>Amt</th></tr>";
                    $('#tbleBodydata').append(headData);

                    /* ---------- HEAD DATA ---------- */

                    /* ---------- BODY DATA ---------- */

                    var slno=1;var total=0;
                    $.each(data1.dataBilty, function(k, getData){

                      var outQty    = parseFloat(getData.QTY_ISSUED);
                      var rateMonth = parseFloat(getData.RATE_PER_MONTH);

                      var amt = outQty * rateMonth;

                      total += amt;

                      var bodyData = "<tr><td class='tdthtablebordr' style='width: 4%;'>"+slno+"</td><td class='tdthtablebordr' style='width: 19%;'><div><input class='inputboxclr readField' id='cold_storage"+slno+"' value='"+getData.CS_CODE+"[ "+getData.CS_NAME+" ]' name='cold_storage[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                      "<td class='tdthtablebordr' style='width: 19%;'><div><input class='inputboxclr readField' id='chamber_code"+slno+"' value='"+getData.CHAMBER_CODE+"[ "+getData.CHAMBER_NAME+" ]' name='chamber_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                      "<td class='tdthtablebordr' style='width: 19%;'><div><input class='inputboxclr readField' id='floor_code"+slno+"' value='"+getData.FLOOR_CODE+"[ "+getData.FLOOR_NAME+" ]' name='floor_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                      "<td class='tdthtablebordr' style='width: 19%;'><div><input class='inputboxclr readField' id='block_code"+slno+"' value='"+getData.BLOCK_CODE+"[ "+getData.BLOCK_NAME+" ]' name='block_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                      "<td class='tdthtablebordr' style='width: 10%;'><div><input class='inputboxclr readField textRight' id='outwardQty"+slno+"' value='"+getData.QTY_ISSUED+"' name='outwardQty[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                      "<td class='tdthtablebordr' style='width: 10%;'><div><input class='inputboxclr readField textRight' id='billAmt"+slno+"' value='"+amt.toFixed(2)+"' name='billAmt[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td></tr>";

                      $('#tbleBodydata').append(bodyData);
                    });

                    var extraDaysCharge = data1.dataBilty[0].EXTRA_DAYS_CHARGES;
                    var basicAmount = parseFloat(total) + parseFloat(extraDaysCharge);
                    $('#basic').val(basicAmount);
                    /* ---------- BODY DATA ---------- */

                    /* ---------- HEAD DATA ---------- */

                    var footerData ="<tr><td class='tdthtablebordr textRight' colspan='5'><b>Total:</b><br><b>Net Amt:</b></td><td class='tdthtablebordr' style='width: 10%;'></td><td class='tdthtablebordr' style='width: 10%;'><b><div class='textRight'>"+total.toFixed(2)+"</div><div class='textRight' id='nextAmtTot'></div></b></td></tr>";
                    $('#tbleBodydata').append(footerData);

                    /* ---------- HEAD DATA ---------- */

                  }/* /. IF CONDITION*/

                  if(data1.dataPostCdList == ''){

                  }else{
                    //console.log('dataPostCdList',data1.dataPostCdList);
                    $("#postingList").empty();

                    $.each(data1.dataPostCdList, function(k, getAum){

                      $("#postingList").append($('<option>',{

                        value:getAum.GL_CODE,

                        'data-xyz':getAum.GL_NAME,
                        text:getAum.GL_NAME

                      }));

                    });
                  }

              } /* /. SUCCESS CONDITION*/

          } /* /. SUCCESS */

    }); /* /. AJAX */

  }/* /. MAIN FUNCTION*/

  function CalculateTax(taxid){

    $("#tds_rate_model"+taxid).modal({
        show:false,
        backdrop:'static',
    });

    $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    var taxOnModel = $('#tax_code'+taxid).val();
    console.log('taxOnModel',taxOnModel);
    var basicAmt   = $('#basic').val();

    $('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt);

    var Item_Cde = $('#item_code').val();

    if(taxOnModel == '' || taxOnModel == undefined){

      var tax_code = $('#taxCode').val();

      $.ajax({

            url:"{{ url('Transaction/a-field-calc/tax-rate-calc')}}",

            method : "POST",

            type: "JSON",

            data: {tax_code: tax_code},

            beforeSend: function() {
              console.log('start spinner');
                  $('.modalspinner').removeClass('hideloaderOnModl');
            },

            success:function(data){
              
              var data1 = JSON.parse(data);
               
                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                    if(data1.data==''){

                    }else{

                      var basicheadval = parseFloat($('#basic').val());

                      var counter = 1;

                      var countI ='';
                      var dataI ='';

                      $('#tax_rate_'+taxid).empty();

                      var TableHeadData =  "<tr><th>Tax Indicator</th><th>Rate Indicator</th><th>Rate</th><th>Amount</th></tr>";

                      $('#tax_rate_'+taxid).append(TableHeadData);

                      $.each(data1.data, function(k, getData) {

                        var datacount = data1.data.length;
                        dataI = datacount;
                        $('#data_count'+taxid).val(datacount);

                        if((getData.RATE_INDEX == null && getData.TAX_RATE == null) || (getData.RATE_INDEX == '-' && getData.TAX_RATE == '0.00')){

                         $('#tax_code'+taxid).val(getData.TAX_CODE);

                         var TableData = "<tr><td class='tdthtablebordr'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"> </td>"+
                          "<td class='tdthtablebordr'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></td>"+
                          "<td class='tdthtablebordr'><input type='text' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control numerRightAlign' readonly></td>"+
                          "<td class='tdthtablebordr'><input type='text' class='form-control numerRightAlign' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval.toFixed(2)+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''></td>";

                        }else{

                          if(getData.tax_ind_name == 'GrandTotal'){
                            var classname = 'grandTotalGet';
                          }else{
                            var classname = '';
                          }

                          if(getData.TAX_AMT){
                            var taxAmt =getData.TAX_AMT
                          }else{
                            var taxAmt ='';
                          }

                          if(getData.TAX_GL_CODE == null || getData.TAX_GL_CODE == '' ||getData.TAX_GL_CODE =='undefined'){
                            var taxglCd ='';
                          }else{
                            var taxglCd =getData.TAX_GL_CODE;
                          }


                          if(getData.TAXGL_CODE ==null || getData.TAXGL_CODE =='' || getData.TAXGL_CODE =='undefined'){
                            var taxTrnasGl = '';
                          }else{
                            var taxTrnasGl =getData.TAXGL_CODE;
                          }

                          if(taxglCd){
                            var TAXGLCODE=taxglCd;
                          }else if(taxTrnasGl){
                            var TAXGLCODE=taxTrnasGl;
                          }else{
                            var TAXGLCODE='';
                          }

                          if(getData.TAX_LOGIC == '' || getData.TAX_LOGIC == null){
                            var TAXLOGIC = '';
                          }else{
                            var TAXLOGIC = getData.TAX_LOGIC;
                          }

                          if(getData.STATIC_IND == '' || getData.STATIC_IND == null){
                            var staticIND = '';
                          }else{
                            var staticIND = getData.STATIC_IND;
                          }

                          var TableData = "<tr><td class='tdthtablebordr'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value=\""+getData.TAXIND_NAME+"\" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></td>"+
                           "<td class='tdthtablebordr'><input type='text' class='form-control' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+");'> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a></td>"+
                           "<td class='tdthtablebordr'><input type='text' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control numerRightAlign' oninput='getGrandTotal("+taxid+");' ></td>"+
                           "<td class='tdthtablebordr'><input type='text' class='numerRightAlign form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+taxAmt+"' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticIND+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'>"+
                             //indicator change modal 
                              "<div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($ratval_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+");'>Apply</button></div></div></div></div></td></tr>";

                        }

                        $('#tax_rate_'+taxid).append(TableData);

                        var IndexSelct = getData.RATE_INDEX;
                       
                          objcity = data1.data_rate;
                     
                          $.each(objcity, function (i, objcity) {
                            
                            var rateSel = '';
                            if(IndexSelct == objcity.RATE_VALUE){

                              $('#indicator_'+taxid+'_'+counter).append($('<option>',
                              { 

                                value: objcity.RATE_VALUE,

                                text : objcity.RATE_VALUE+' = '+objcity.RATE_NAME,

                                selected : true

                              }));
                          
                            }else{
                             
                               $('#indicator_'+taxid+'_'+counter).append($('<option>',
                                { 

                                  value: objcity.RATE_VALUE,

                                  text : objcity.RATE_VALUE+' = '+objcity.RATE_NAME,

                                  selected : false

                                }));
                                }

                          }); // .each loop

                          countI = counter;

                          counter++;

                      }); /* -/. each loop */

                      var butn =  $('#footer_tax_btn'+taxid).find(':button').html();

                     if(butn != 'Ok' || butn =='undefined'){

                      var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOktaxbtn"+taxid+"' onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",1);' style='width: 36px;'>Ok</button>";

                       $('#footer_tax_btn'+taxid).append(tblData);

                     }else{
                     
                     }

                      
                    }
                 
                } // success close

          }, //success function close

          complete: function() {
            $('.modalspinner').addClass('hideloaderOnModl');
          },

      }); //ajax close 

    }else{


    }

  } /*function close*/

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
          
          $('#simulation').prop('disabled', false);
          $('#submitdata').prop('disabled', false);
          //$('#submitdatapdf').prop('disabled', false);

          if(countercount == datacount){
            var g_Amnt = $('#FirstBlckAmnt_'+aplyid+'_'+countercount).val();
            console.log('g_Amnt',g_Amnt);
            $('#getNetAmnt').val(g_Amnt);
            $('#nextAmtTot').html(g_Amnt);
          }
      
    }else{
        
         $('#aplytaxOrNot'+aplyid).html('0');
         $('#cancelbtn'+aplyid).html('');
         $('#appliedbtn'+aplyid).html('');
         
         var cnclbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

         $('#cancelbtn'+aplyid).html(cnclbtn);
         $('#data_count'+aplyid).val(0);
         //$('#get_grand_num'+aplyid).val('');
         
    }


}

function billSimulation(){

    $('#simulation_model').modal('show');

    var rate_indName = [];
    var af_rate      = [];
    var amount       = [];
    var taxGlCode    = [];
    var taxIndCode    = [];

    $('input[name^="taxIndCode"]').each(function (){
          taxIndCode.push($(this).val());
    });

    $('input[name^="rate_ind"]').each(function (){
          rate_indName.push($(this).val());
    });

    $('input[name^="af_rate"]').each(function (){
          af_rate.push($(this).val());
    });

    $('input[name^="amount"]').each(function (){
          amount.push($(this).val());
    });

    $('input[name^="taxGlCode"]').each(function (){
          taxGlCode.push($(this).val());
    });

    var taxRowCount = $('#data_count1').val();
    var series_glCd = $('#seriesGlCd').val();
    var acc_code    = $('#acc_code').val();
    var acc_name    = $('#acc_name').val();
    var acc_glCd    = $('#posting_code').val();
    var NetAmnt     = $('#getNetAmnt').val();

    $.ajax({

          url:"{{ url('Transction/ColdStorage/get-simulation-data-for-cs-bil') }}",

          method : "POST",

          type: "JSON",

          data: {taxIndCode:taxIndCode,rate_indName: rate_indName,af_rate:af_rate,amount:amount,taxGlCode:taxGlCode,taxRowCount:taxRowCount,series_glCd:series_glCd,acc_code:acc_code,acc_name:acc_name,NetAmnt:NetAmnt,acc_glCd:acc_glCd},

          success:function(data){

            var data1 = JSON.parse(data);
                  
            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
            }else if(data1.response == 'success'){

              $('#siml_body').empty();

              var headData ="<tr><th>Gl/Acc Code</th> <th>Gl/Acc Name</th> <th>Debit-DR</th> <th>Credit-CR</th> <th>Ref Code</th> <th>Ref Name</th></tr>";

              $('#siml_body').append(headData);

              var drTotal = 0;
              var crTotal = 0;
              $.each(data1.data_tax, function(k, getData) {

                if(getData.IND_ACC_CODE){
                  var accGl = getData.IND_ACC_CODE;
                  var accglName = getData.accName;
                }else if(getData.IND_GL_CODE){
                  var accGl = getData.IND_GL_CODE;
                  var accglName = getData.glName;
                }else{
                  var accGl = '--';
                  var accglName = '--';

                }
                drTotal +=parseFloat(getData.DR_AMT);
                crTotal +=parseFloat(getData.CR_AMT);

                var bodyData = "<tr><td class='tdthtablebordr textLeft'>"+accGl+"</td>"+
                                "<td class='tdthtablebordr textLeft'>"+accglName+"</td>"+
                                "<td class='tdthtablebordr textRight'>"+getData.DR_AMT+"</td>"+
                                "<td class='tdthtablebordr textRight'>"+getData.CR_AMT+"</td>"+
                                "<td class='tdthtablebordr textLeft'>"+acc_code+"</td>"+
                                "<td class='tdthtablebordr textLeft'>"+acc_name+"</td></tr>";
                $('#siml_body').append(bodyData);
              });

              var footerData = "<tr><td colspan='2' class='tdthtablebordr textRight'><b>Total : </b></td>"+
                                "<td class='tdthtablebordr textRight'><b>"+drTotal.toFixed(2)+"</b></td>"+
                                "<td class='tdthtablebordr textRight'><b>"+crTotal.toFixed(2)+"</b></td>"+
                                "<td class='tdthtablebordr'>&nbsp;</td>"+
                                "<td class='tdthtablebordr'>&nbsp;</td></tr>";
              $('#siml_body').append(footerData);

            }/* -- /. success codn*/

          } /* --- /. success function*/

    }); /* -- /. ajax */

}


function submitBillGenerate(pdfFlag){

      var downloadFlg = pdfFlag;
      $('#pdfYesNoStatus').val(downloadFlg);
      
    var data = $("#billGenerate").serialize();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        type: 'POST',

        url: "{{ url('/Transaction/ColdStorage/Save-generate-bill') }}",

        data: data, // here $(this) refers to the ajax object not form
        success: function (data) {
          console.log('data1',data);
          var data1 = JSON.parse(data);

          if(data1.response == 'error') {

            var responseVar = false;
            var url = "{{url('Transaction/ColdStorage/save-generate-bill-msg')}}"
            setTimeout(function(){ window.location = url+'/'+responseVar; });

          }else{

            var responseVar = true;
            if(downloadFlg == 1){
                var fyYear    = data1.data[0].FY_CODE;
                var fyCd      = fyYear.split('-');
                var seriesCd  = data1.data[0].SERIES_CODE;
                var vrNo      = data1.data[0].VRNO;
                var fileN     = 'BILTY_'+fyCd[0]+''+seriesCd+''+vrNo;
                var link      = document.createElement('a');
                link.href     = data1.url;
                link.download = fileN+'.pdf';
                link.dispatchEvent(new MouseEvent('click'));
            }

            var url = "{{url('Transaction/ColdStorage/save-generate-bill-msg')}}";
            setTimeout(function(){ window.location = url+'/'+responseVar; });

          }/* --- condtn ------*/

        }/* ------ success function ----- */

    }); /* --- ajax ---*/

} /* ---- main fuction --- */
</script>



@endsection