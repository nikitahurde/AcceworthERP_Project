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
  .fieldName{
    border:none;
    padding:0px;
    color: #3c8dbc;
    font-weight: 700;
  }
  .btnAllStyle{
      padding: 4px;
  }
  .readField{
    background-color: #eeeeee;
  }
  .numberRight{
    text-align:right;
  }

</style>

<div class="content-wrapper">

  <section class="content-header">
    <h1>{{ $title }}<small>Add Details</small></h1>

    <ul class="breadcrumb">

      <li>
        <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
      </li>

      <li>
        <a href="{{ url('/dashboard') }}">Transaction</a>
      </li>

      <li class="active">
        <a href="{{ url('/Transaction/ColdStorage/Bilty-Mast') }}"> {{ $title }}</a>
      </li>

    </ul>

  </section>

  <form id="outwardTrans">
    @csrf
    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> {{ $title }}</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Transaction/ColdStorage/View-Bilty-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Outward.</a>

              </div>

            </div><!-- /.box-header -->

            <div class="box-body">

              <div class="overlay-spinner hideloader"></div>
              <div class="modalspinner hideloaderOnModl"></div>

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

                        <input type="text" class="form-control transdatepicker" name="outdate" id="outwardDate" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

                      </div>
                      <small id="showmsgfordate" style="color:red;"></small>
                    </div><!-- /.form-group -->

                  </div><!-- col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Vehicle No: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input list="vehicleNoList" class="form-control" name="vehicle_no" id="vehicle_no" value="" placeholder="Enter Vehicle No" autocomplete="off">

                        <datalist id="vehicleNoList">
                          
                          <?php foreach ($vehicleNoList as $key) { ?>

                            <option value="<?= $key->VEHICLE_NUMBER; ?>" data-xyz="<?= $key->VEHICLE_NUMBER; ?>"><?= $key->VEHICLE_NUMBER; ?></option>
                          <?php } ?>

                        </datalist>

                      </div>

                      <input type="hidden" name="driver_name" id="driver_name">
                      <input type="hidden" name="driver_idCard" id="driver_idCard">
                      <input type="hidden" name="driver_mobile" id="driver_mobile">
                      <input type="hidden" name="plant_code" id="plant_code">
                      <input type="hidden" name="plant_name" id="plant_name">
                      <input type="hidden" name="pfct_code" id="pfct_code">
                      <input type="hidden" name="pfct_name" id="pfct_name">
                      
                    </div><!-- /.form-group -->

                  </div><!-- col -->

                  <div class="col-md-2">
                    
                    <div class="form-group">

                      <label>Builty No: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input list="biltyNoList" class="form-control" name="bilty_no" id="bilty_no" value="" placeholder="Select Builty No" onchange="getBiltyData();" autocomplete="off">

                        <datalist id="biltyNoList">

                          <?php foreach ($biltyList as $key) { 
                              $fyYear    = $key->FY_CODE;
                              $splitFy   = explode('-',$fyYear);
                              $startYear = $splitFy[0];
                              $vrNo      = $key->VRNO;
                              $biltyNo   = $startYear.' '.$key->SERIES_CODE.' '.$vrNo;
                            ?>

                            <option value="<?= $biltyNo; ?>" data-xyz="<?= $biltyNo; ?>"><?= $biltyNo; echo ' '.$key->ACC_NAME; ?></option>

                            <?php } ?>

                          </datalist>

                      </div>

                    </div><!-- /.form-group -->

                  </div><!-- col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label> T Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="transcode" value="{{$tranlist->TRAN_CODE}}" id="transcode" placeholder="Enter T Code" autocomplete="off" readonly>

                        </div>

                    </div>

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label> Series Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input list="series_List" class="form-control" name="series_code" value="" id="series_code" placeholder="Enter Series Code" autocomplete="off" onchange="getvrnoBySeries();">

                          <datalist id="series_List">

                            <?php foreach ($seriesList as $key) { ?>

                              <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>
                              
                            <?php   } ?>
                            
                          </datalist>

                        </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label> Series Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="series_name" value="" id="series_name" placeholder="Enter Series Name" readonly autocomplete="off">

                        </div>

                    </div><!-- /.form-group -->
                    
                  </div><!-- /.col -->

                </div><!-- /.row -->

                <div class="row">

                  <div class="col-md-2">

                    <div class="form-group">

                      <label> Vr No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="vrseqnum" value="" id="vrseqnum" placeholder="Enter Vr No" readonly autocomplete="off">

                        </div>

                    </div><!-- /.form-group -->
                    
                  </div><!-- /.col -->

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
                  
                </div><!-- /.row -->

                <div class="row">

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

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>Storage Charge Type: <span class="required-field"></span></label>

                       <div class="input-group">

                        <input type="radio" class="optionsRadios1 stChargeType" name="charge_type" value="PER_UNIT_PER_MONTH" checked="">&nbsp;&nbsp;&nbsp;Per Unit Per Month &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="optionsRadios1 stChargeType" name="charge_type" value="SEASONAL" >&nbsp;&nbsp;&nbsp;&nbsp;Seasonal &nbsp;&nbsp;&nbsp;&nbsp;

                        <input type="radio" class="optionsRadios1 stChargeType" name="charge_type" value="FIXED">&nbsp;&nbsp;&nbsp;&nbsp;Fixed

                      </div>
                      <input type="hidden" value="" name="st_ChargeType" id="st_ChargeType">
                    </div>
                
                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label> Quantity : </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control numberRight" name="qty" value="" id="qty" placeholder="Enter Quantity" value="" readonly autocomplete="off">

                        </div>

                    </div>
                    
                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Rate Per Month : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input type="text"  id="ratePerMonth" name="ratePerMonth" class="form-control  pull-left numberRight" value="" autocomplete="off" readonly placeholder="Enter Rate Per Month"> 

                      
                      </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Market Rate : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input type="text"  id="market_rate" name="market_rate" class="form-control  pull-left numberRight" value="" autocomplete="off" readonly placeholder="Enter Market Per"> 
                      </div>
                       <input type="hidden"  id="tilValidDate" name="biltyDate" class="form-control  pull-left" value="" autocomplete="off" readonly placeholder="Enter Bilty Date">
                       <input type="hidden"  id="billRate" name="billRate" class="form-control  pull-left" value="" autocomplete="off" readonly placeholder="Enter Bill Rate">
                    </div><!-- /.form-group -->

                  </div><!-- /.col -->
                  
                </div><!-- /.row -->

                              
              </div><!-- /.box-body -->

          </div><!-- /.custom -->

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

                <div class="col-md-12" style="text-align: center;">
                  <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
                  <button class="btn btn-success" type="button" id="submitdata" onclick="submitOutwardTrans(0)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                  <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

                  <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitOutwardTrans(1)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button>
                </div>

              </div><!-- /.row -->

            </div><!-- /. box-body -->

          </div><!-- /. Custom-Box -->

        </div><!-- /.col-sm-12 -->

      </div><!-- /.row -->

    </section><!-- /.section -->

  </form>
</div>

<!--  --------- MSG MODAL -------------  -->

<!-- <div id="msgModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-sm" style="margin-top: 13%;">
      <div class="modal-content" style="border-radius: 5px;">
          <div class="modal-header"  style="text-align: center;">
              <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
              
          </div>
          <div class="modal-body">
            <p id="msgErr" style="line-height:15px;"></p>
          </div>
          <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-primary" data-dismiss="modal" >OK</button>
          </div>
      </div>
  </div>
</div> -->

<!--  --------- MSG MODAL -------------  -->

@include('admin.include.footer')

<script type="text/javascript">
  
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

  $(document).ready(function(){

    $('#vehicle_no').on('change',function(){

      var vehicle_No   = $('#vehicle_no').val();
      var vehicleType = 'EMPTY';

      var xyz = $('#vehicleNoList option').filter(function() {

        return this.value == vehicle_No;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#vehicle_no,#driver_name,#driver_idCard,#driver_mobile,#plant_code,#plant_name,#pfct_code,#pfct_name').val('');
      }else{

        $.ajax({

            url:"{{ url('get-vehicle-entry-details') }}",

            method : "POST",

            type: "JSON",

            data: {vehicle_No: vehicle_No,vehicleType:vehicleType},

            success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {
                          
                    $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Data Not Found...!</p>");

                }else if(data1.response == 'success'){

                    $("#driver_name").val(data1.date_vehicle[0].DRIVER_NAME);
                    $("#driver_idCard").val(data1.date_vehicle[0].DRIVER_ID);
                    $("#driver_mobile").val(data1.date_vehicle[0].MOBILE_NUMBER);
                    $("#plant_code").val(data1.date_vehicle[0].PLANT_CODE);
                    $("#plant_name").val(data1.date_vehicle[0].PLANT_NAME);
                    $("#pfct_code").val(data1.date_vehicle[0].PFCT_CODE);
                    $("#pfct_name").val(data1.date_vehicle[0].PFCT_NAME);
                         
                }
            }

        });
      }

    });

    $('#outwardDate').on('change',function(){
      var transDate     = $('#outwardDate').val();
      var slipD         =  transDate.split('-');
      var Tdate         = slipD[0];
      var Tmonth        = slipD[1];
      var Tyear         = slipD[2];
      var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;
          
      var selectedDate = new Date(getproperDate);
      var todayDate = new Date();

      if(selectedDate > todayDate){
        $('#showmsgfordate').html('Transaction Date Can Not Be Greater Than Today').css('color','red');
        $('#outwardDate').val('');
        return false;

      }else{
        $('#showmsgfordate').html('');
        return true;
      }

    });

  });

  function getBiltyData(){

    var bilty_No = $('#bilty_no').val();

    var xyz = $('#biltyNoList option').filter(function() {

      return this.value == bilty_No;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $('#bilty_no,#acc_code,#acc_name,#item_code,#item_name,#packing_code,#packing_name,#ratePerMonth,#market_rate,#tilValidDate,#qty,#billRate').val('');
      $('#tbleBodydata').empty();
    }else{
      $('#acc_code,#acc_name,#item_code,#item_name,#packing_code,#packing_name,#ratePerMonth,#market_rate,#tilValidDate,#qty,#billRate').val('');
      $('#tbleBodydata').empty();
    }

    var isExistbiltyNo = $('#bilty_no').val();

    if(isExistbiltyNo){
      var biltyNo = $('#bilty_no').val();
      var tranCd  = $('#transcode').val();

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
          beforeSend: function() {
            console.log('start spinner');
            $('.modalspinner').removeClass('hideloaderOnModl');
          },
          success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                if(data1.dataBilty == ''){

                }else{
                  
                  $("input[name=vehicle_type][value='"+data1.dataBilty[0].VEHICLE_TYPE+"']").prop("checked",true);
                  $("input[name=vehicle_type]").prop("disabled",true);
                  $('#acc_code').val(data1.dataBilty[0].ACC_CODE);
                  $('#acc_name').val(data1.dataBilty[0].ACC_NAME);
                  $('#item_code').val(data1.dataBilty[0].ITEM_CODE);
                  $('#item_name').val(data1.dataBilty[0].ITEM_NAME);
                  $('#packing_code').val(data1.dataBilty[0].PACKING_CODE);
                  $('#packing_name').val(data1.dataBilty[0].PACKING_NAME);
                  
                  $('#ratePerMonth').val(data1.dataBilty[0].RATE_PER_MONTH);
                  $('#market_rate').val(data1.dataBilty[0].MARKET_RATE);
                  var receiptillDT    = data1.dataBilty[0].RECIEPT_TILL_DT;
                  var splitDt         = receiptillDT.split('-');
                  var reciptTillValid = splitDt[1]+'-'+splitDt[2]+'-'+splitDt[0];
                  $('#tilValidDate').val(reciptTillValid);

                  $("input[name=prod_cond][value='"+data1.dataBilty[0].COND_GOODS+"']").prop("checked",true);
                  $("input[name=prod_cond]").prop("disabled",true);
                  $('#st_ChargeType').val(data1.dataBilty[0].STORAGE_TYPE);
                  $("input[name=charge_type][value='"+data1.dataBilty[0].STORAGE_TYPE+"']").prop("checked",true);
                  $("input[name=charge_type]").prop("disabled",true);

                  
                  $('#tbleBodydata').empty();
                  /* ----------HEAD DATA ------------ */

                    var headData = "<tr><th>Sr.No.</th><th>Cold Storage</th><th>Chamber</th><th>Floor</th><th>Block</th><th>Bilty Qty</th><th>Dispatched Qty</th><th>Balence Qty</th><th>Qty Issued</th></tr>";

                    $('#tbleBodydata').append(headData);

                  /* ----------HEAD DATA ------------ */

                  /* ---------- BODY DATA ---------- */

                    var totalQty = 0,dispatchTotl = 0,balTotl=0;

                    var slno=1;
                    $.each(data1.dataBilty, function(k, getData){

                      totalQty +=parseFloat(getData.BODYQTY);
                      dispatchTotl += parseFloat(getData.QTY_ISSUED);
                      
                      var balenceQty = parseFloat(getData.BODYQTY) - parseFloat(getData.QTY_ISSUED);

                      balTotl += parseFloat(balenceQty);

                      var bodyData = "<tr><td class='tdthtablebordr'><span id='snum'>"+slno+".</span><input type='hidden' name='totlRwCount[]' value='"+slno+"' id='totlCountRw"+slno+"'><input type='hidden' value='"+getData.BILTYHID+"' name='bilty_HeadId[]' id='biltyHeadId"+slno+"'><input type='hidden' value='"+getData.BILTYBID+"' name='bilty_BodyId[]' id='biltyBodyId"+slno+"'></td>"+
                      "<td class='tdthtablebordr' style='width: 16%;'><div><input list='coldStorageList"+slno+"' class='inputboxclr readField' id='cold_storage"+slno+"' value='"+getData.CS_CODE+"[ "+getData.CS_NAME+" ]' name='cold_Storage[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                      "<td class='tdthtablebordr' style='width: 16%;'><div><input list='chamberList"+slno+"' class='inputboxclr readField' id='chamber_code"+slno+"' value='"+getData.CHAMBER_CODE+"[ "+getData.CHAMBER_NAME+" ]' name='chamber_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                      "<td class='tdthtablebordr' style='width: 16%;'><div><input list='floorList"+slno+"' class='inputboxclr readField' id='floor_code"+slno+"' value='"+getData.FLOOR_CODE+"[ "+getData.FLOOR_NAME+" ]' name='floor_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                      "<td class='tdthtablebordr'style='width: 16%;'><div><input list='blockList"+slno+"' class='inputboxclr readField' id='block_code"+slno+"' value='"+getData.BLOCK_CODE+"[ "+getData.BLOCK_NAME+" ]' name='block_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                      "<td class='tdthtablebordr' style='width: 9%;'><input type='text' class='inputboxclr readField numberRight' id='biltyQty"+slno+"' value="+getData.BODYQTY+" name='biltyQty[]'   oninput='this.value = this.value.toUpperCase()'  autocomplete='off' readonly/></td>"+
                      "<td class='tdthtablebordr' style='width: 9%;'><input type='text' class='inputboxclr readField numberRight' id='dispatchQty"+slno+"' value="+getData.QTY_ISSUED+" name='dispatchQty[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></td>"+
                      "<td class='tdthtablebordr' style='width: 9%;'><input type='text' class='inputboxclr readField numberRight' id='balenceQty"+slno+"' value="+balenceQty.toFixed(3)+" name='balenceQty[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></td>"+
                      "<td class='tdthtablebordr' style='width: 9%;'><input type='text' class='inputboxclr qantity_Issu numberRight' id='qtyIssued"+slno+"' oninput='qtyIssuedAmt("+slno+")' name='qtyIssued[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' /></td></tr>";

                      $('#tbleBodydata').append(bodyData);

                    slno++;});

                    $('#qty').val(totalQty.toFixed(2));

                  /* ---------- BODY DATA ---------- */

                  /* ---------- FOOTER DATA ---------- */

                      var footerData = "<tr><td colspan='5' style='border-color: #fff;border-right: 1px solid #fff !important;text-align: end;'><label>Total : </label></td>"+
                      "<td style='width: 9%;border-color: #fff;border-right: 1px solid #fff !important;'><input type='text' class='inputboxclr readField numberRight' name='biltyQty' value="+totalQty.toFixed(3)+" id='biltyQty' readonly></td>"+
                      "<td style='width: 9%;border-color: #fff;border-right: 1px solid #fff !important;'><input type='text' class='inputboxclr readField numberRight' name='dispatchQty' value="+dispatchTotl.toFixed(3)+" id='dispatchQty' readonly></td>"+
                      "<td style='width: 9%;border-color: #fff;border-right: 1px solid #fff !important;'><input type='text' class='inputboxclr readField numberRight' name='balenceQty' id='balenceQty' value="+balTotl.toFixed(3)+" readonly></td>"+
                      "<td style='width: 9%;border-color: #fff;border-right: 1px solid #fff !important;'><input type='text' class='inputboxclr readField numberRight' name='totlQtyIssue' id='totlQtyIssue' readonly></td></tr>";

                       $('#tbleBodydata').append(footerData);

                  /* ---------- FOOTER DATA ---------- */

                  /* --------- RATE CALULATION ------------ */

                  var biltyQty    = $('#qty').val();
                  var ratePerMonth  = $('#ratePerMonth').val();

                  var outwardDate = $('#outwardDate').val();
                  var splitOutDt  = outwardDate.split('-');
                  var outDt       = splitOutDt[1]+'-'+splitOutDt[0]+'-'+splitOutDt[2];

                  var validDate   = $('#tilValidDate').val();

                  var outDate    = new Date(outDt);
                  var endDay      = new Date(validDate);

                  if(outDate > endDay){
                    
                    var millisBetween  = outDate.getTime() - endDay.getTime();
                    var days           = millisBetween / (1000 * 3600 * 24);
                    var daysCount      = Math.abs(days);

                    /* -- GET TOTAL DAYS IN MONTH -- */

                    var totalMonthDays = new Date(splitOutDt[2], splitOutDt[1], 0).getDate();
                    var perDayRate     = parseFloat(biltyQty) * parseFloat(ratePerMonth) / parseFloat(totalMonthDays);

                    /* -- GET TOTAL DAYS IN MONTH -- */

                    var getPerDayRate = perDayRate.toFixed(2);
                    if(daysCount < 7){
                      var extraRate  = parseFloat(getPerDayRate) * parseFloat(6);
                    }else if((daysCount > 6) && (daysCount < 15)){
                      var extraRate  = parseFloat(getPerDayRate) * parseFloat(14);
                    }else if(daysCount > 14){
                      var extraRate  = parseFloat(getPerDayRate) * parseFloat(totalMonthDays);
                    }else{
                      var extraRate  = 0.00;
                    }
                    $('#billRate').val(extraRate.toFixed(2));
                  }else{
                    $('#billRate').val(0);
                    
                  }
                                 
                  /* --------- RATE CALULATION ------------ */

                }/* /. condition*/

              } /* /. else*/

          },
          complete: function() {
             console.log('end spinner');
               $('.modalspinner').addClass('hideloaderOnModl');
          },
      }); /* /. ajax*/

    }

  }
  function qtyIssuedAmt(slno){

      var qtyIssued = parseFloat($('#qtyIssued'+slno).val());
      var balQty    = parseFloat($('#balenceQty'+slno).val());

      if(qtyIssued > balQty){
        $('#qtyGreaterMsg').html('Qty Issued Should Not Be Greater Balence Qty');
        $('#qtyIssued'+slno).val('');
      }else{
        $('#qtyGreaterMsg').html('');
      }

      var sumcr = 0;

      $(".qantity_Issu").each(function () {

          if (!isNaN(this.value) && this.value.length != 0) {
              sumcr += parseFloat(this.value);
          }

        $("#totlQtyIssue").val(sumcr.toFixed(2));

      });

  }
  function getvrnoBySeries(){

    var seriesCd =  $('#series_code').val();
    var xyz = $('#series_List option').filter(function() {

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

              }

          }

    });

  }

  function submitOutwardTrans(pdfFlag){

      var downloadFlg = pdfFlag;

      $('#pdfYesNoStatus').val(downloadFlg);
      
      var data = $("#outwardTrans").serialize();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/Transaction/ColdStorage/Save-Outward-trans') }}",

          data: data, // here $(this) refers to the ajax object not form
          success: function (data) {
              console.log('data1',data);
              var data1 = JSON.parse(data);

              if(data1.response == 'error') {

                var responseVar = false;
                var url = "{{url('Transaction/ColdStorage/view-Outward-msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });

              }else{

                var responseVar = true;
                if(downloadFlg == 1){

                    var fyYear    = data1.data[0].FY_CODE;
                    var fyCd      = fyYear.split('-');
                    var seriesCd  = data1.data[0].SERIES_CODE;
                    var vrNo      = data1.data[0].VRNO;
                    var fileN     = 'GATEPASS_'+fyCd[0]+''+seriesCd+''+vrNo;
                    var link      = document.createElement('a');
                    link.href     = data1.url;
                    link.download = fileN+'.pdf';
                    link.dispatchEvent(new MouseEvent('click'));

                }

                var url = "{{url('Transaction/ColdStorage/view-Outward-msg')}}";
                setTimeout(function(){ window.location = url+'/'+responseVar; });

              }

          },

      });

  }

</script>



@endsection