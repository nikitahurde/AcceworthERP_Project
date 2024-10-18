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
  .showinmobile{
    display: none;
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

</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1> Gate Outward Trnansaction

      <small>Add Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Transaction</a></li>

      <li class="Active"><a href="{{ URL('/transaction/ColdStorage/add-gate-outward-transaction')}}">Gate Outward Transaction</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-md-3"> </div>

      <div class="col-sm-6">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Gate Outward</h2>
            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/ColdStorage/View-gate-outward-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Gate Outward</a>

            </div>
          
          </div><!-- /.box-header -->

          <div class="box-body">

            <form action="{{ url('transaction/ColdStorage/Save-gate-Outward-transaction') }}" method="POST" >

              @csrf

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                     <?php 

                        $CurrentDate =date("d-m-Y");
                        $FromDate    = date("m-d-Y", strtotime($fromDate));  
                        $ToDate      = date("m-d-Y", strtotime($toDate));  
                        $spliDate    = explode('-', $CurrentDate);
                        $yearGet     = Session::get('macc_year');
                        $fyYear      = explode('-', $yearGet);
                        $get_Month   = $spliDate[1];
                        $get_year    = $spliDate[2];

                        if($get_Month >=3 && $get_year == $fyYear[1]){
                            $vrDate = $ToDate;
                        }else{
                            $vrDate = $CurrentDate;
                        }
                        
                      ?>

                      <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                      <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                    <label> Vehicle Out Date/Time: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                        <input type="text" class="form-control timePicker" name="outTime" id="outTime" value="{{ old('outTime') }}" placeholder="Enter Vehicle Out Date/Time" maxlength="10" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('outTime', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div><!-- /.form-group -->

                </div><!-- /col -->

                <div class="col-md-4">

                  <div class="form-group">

                    <label>

                     Vehicle Number : 

                      <span class="required-field"></span>

                    </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        <input type="hidden" name="biltyHId" value="" id="biltyHId">
                        <input list="vehicleNoList" class="form-control" name="vehicle_number" value="{{ old('vehicle_number') }}" placeholder="Enter Vehicle Number" maxlength="15" id="vehicleNo" onchange="getinwardStorageData();" autocomplete="off">

                        <datalist id="vehicleNoList">

                          <option selected="selected" value="">-- Select --</option>

                          @foreach ($vehicleNoList as $key)

                          <option value='<?php echo $key->VEHICLE_NO;?>'   data-xyz ="<?php echo $key->VEHICLE_NO; ?>" ><?php echo $key->VEHICLE_NO; ?></option>

                          @endforeach

                        </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('vehicle_number', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- ./col -->

                <div class="col-md-4">

                  <div class="form-group">

                    <label>

                     Trans Code : 

                      <span class="required-field"></span>

                    </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control" name="trans_code" value="{{$tranlist->TRAN_CODE }}" placeholder="Enter Trans Code" maxlength="15" id="trans_code" readonly >

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('trans_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

              </div><!-- ./row -->

              <div class="row">

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Series Code : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input list="seriesList" class="form-control" name="series_code" value="" id="series_code" placeholder="Enter Series Code" autocomplete="off" readonly>


                      </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-6">

                  <div class="form-group">

                    <label> Series Name : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="series_name" value="" id="series_name" placeholder="Enter Series Name" readonly autocomplete="off">

                      </div>

                  </div><!-- /.form-group -->
                  
                </div><!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Vr No : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="vrseqnum" value="" id="vrseqnum" placeholder="Enter Vr No" readonly autocomplete="off">

                      </div>

                  </div><!-- /.form-group -->
                  
                </div><!-- /.col -->
                
              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Plant Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon" style="padding: 1px 7px;">
                           <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                        </span>
                        <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="" autocomplete="off" readonly>

                      </div>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label> Plant Name : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" name="plant_name" value="" id="plant_name" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                      </div>

                  </div>
                  
                </div><!-- col -->

              </div> <!-- row -->

              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Profit Center Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input type="text"  id="pfct_code" name="pfct_code" class="form-control  pull-left" value="" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

                      </div>

                    <small id="profit_center_err" style="color: red;"> </small>

                  </div> <!-- /.form-group -->

                </div><!-- col -->

                <div class="col-md-6">

                  <div class="form-group">

                    <label> Profit Center Name : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" name="pfct_name" value="" id="pfct_name" placeholder="Enter Profit Center Name" readonly autocomplete="off">

                      </div>

                  </div>
                  
                </div><!-- col -->
                
              </div><!-- row -->

              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                    <label> Driver Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>

                      <input type="text" class="form-control" name="driver_name" id="driver_name" value="{{ old('driver_name') }}" placeholder="Enter Driver Name" maxlength="40" readonly>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('driver_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label>Driver ID : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="text" class="form-control" name="driver_id" value="{{ old('driver_id') }}" placeholder="Enter Driver ID"  id="driver_id" readonly>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('driver_id', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div><!-- /.form-group -->

                </div>

              </div>

              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                    <label> Mobile Number : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                        <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}" placeholder="Enter Mobile Number" maxlength="10" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('mobile_number', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                    <label> Vehicle Type : <span class="required-field"></span> </label>

                    <div class="input-group">
                      <input type="hidden" name="vehicleType" id="vehicleType" value="">
                      <input type="radio" class="optionsRadios1" name="vehicle_type" value="EMPTY" checked >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EMPTY &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                      <input type="radio" class="optionsRadios1" name="vehicle_type" value="LOAD" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LOAD

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('vehicle_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div><!-- col -->

              </div><!-- row -->

              <div class="row">

                <div style="text-align: center;">

                  <button type="Submit" class="btn btn-primary">

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save

                  </button>

                </div>
              
              </div>


              <!-- <div class="row">
                    <div class="col-md-6">
                        <div id="my_camera"></div>
                        <br/>
                        <input type=button value="Take Snapshot" onClick="take_snapshot()">
                        <input type="hidden" name="image" class="image-tag">
                    </div>
                    <div class="col-md-6">
                        <div id="results">Your captured image will appear here...</div>
                    </div>
                  </div>-->

              

            </form>

          </div><!-- /.box-body -->

        </div>

      </div>

      <div class="col-md-3"> </div>

    </div>

  </section>

</div>


@include('admin.include.footer')

  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->
   
  <!-- <script language="JavaScript">
          Webcam.set({
              width: 490,
              height: 350,
              image_format: 'jpeg',
              jpeg_quality: 90
          });
          
          Webcam.attach( '#my_camera' );
          
          function take_snapshot() {
              Webcam.snap( function(data_uri) {
                  $(".image-tag").val(data_uri);
                  document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
              } );
          }
  </script> -->

<script type="text/javascript">
  $(document).ready(function(){

    var fromDate = $('#FromDateFy').val();
    var toDate   = $('#ToDateFy').val();
    
    $('.timePicker').datetimepicker({

       format:'DD-MM-YYYY HH:mm:ss',
       minDate: fromDate,
       maxDate: toDate,
    });

    $(".timePicker").on("dp.change", function(e) {
      $(this).data('DateTimePicker').hide();
    });

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

    $('#vehicleNo').on('change',function(){

      var vehicle_No =  $('#vehicleNo').val();

      var xyz = $('#vehicleNoList option').filter(function() {

          return this.value == vehicle_No;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#vehicleNo,#Plant_code,#plant_name,#pfct_code,#pfct_name,#driver_name,#driver_id,#mobile_number,#vehicleType').val('');
      }else{
      }
    });

    $('.Number').keypress(function (event) {
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
    });

  });
  
  function getinwardStorageData(){

    var vehicle_No    = $("#vehicleNo").val();

      $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({

            url:"{{ url('get-inward-data-by-acc-code') }}",

            method : "POST",

            type: "JSON",

            data: {vehicle_No : vehicle_No},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                    if(data1.dataBiltyDone == ''){
                      
                      $('#Plant_code').val('');
                      $('#plant_name').val('');
                      $('#pfct_code').val('');
                      $('#pfct_name').val('');

                    }else{

                      $('#biltyHId').val(data1.dataBiltyDone[0].BILTYHID);
                      $('#series_code').val(data1.dataBiltyDone[0].SERIES_CODE);
                      $('#series_name').val(data1.dataBiltyDone[0].SERIES_NAME);
                      $('#vrseqnum').val(data1.dataBiltyDone[0].VRNO);
                      $('#Plant_code').val(data1.dataBiltyDone[0].PLANT_CODE);
                      $('#plant_name').val(data1.dataBiltyDone[0].PLANT_NAME);
                      $('#pfct_code').val(data1.dataBiltyDone[0].PFCT_CODE);
                      $('#pfct_name').val(data1.dataBiltyDone[0].PFCT_NAME);
                      $('#driver_name').val(data1.dataBiltyDone[0].DRIVER_NAME);
                      $('#driver_id').val(data1.dataBiltyDone[0].DRIVER_ID);
                      $('#mobile_number').val(data1.dataBiltyDone[0].MOBILE_NUMBER);
                      $('#vehicleType').val(data1.dataBiltyDone[0].VEHICLE_TYPE);
                     
                      $("input[name=vehicle_type][value='"+data1.dataBiltyDone[0].VEHICLE_TYPE+"']").prop("checked",true);
                      $("input[name=vehicle_type]").prop("disabled",true);
                      
                    }

                } /* -- success condtn*/

            } /* ---- success function*/

          });

  }

</script>



<script type="text/javascript">
  $(document).ready(function() {

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

  });
</script>

@endsection