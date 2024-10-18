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

    <h1> Gate Inward Trnansaction

      <small>Add Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Transaction</a></li>

      <li class="Active"><a href="{{ URL('/transaction/CandF/add-gate-inward-transaction-cf')}}">Gate Inward Transaction</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-md-2"> </div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Gate Inward</h2>
            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/CandF/View-gate-inward-transaction-cf') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Gate Inward</a>

            </div>
          
          </div><!-- /.box-header -->

          <div class="box-body">

            <form action="{{ url('transaction/CandF/Save-gate-inward-transaction-cf') }}" method="POST" >

              @csrf

              <div class="row">

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Date: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <?php 

                        $CurrentDate =date("d-m-Y");
                           
                        $FromDate    = date("d-m-Y", strtotime($fromDate));  
                           
                        $ToDate      = date("d-m-Y", strtotime($toDate));  
                           
                        $formCurrentDt = date("Y-m-d", strtotime($CurrentDate));

                        if($formCurrentDt > $toDate){
                          $vrDate =$ToDate;
                        }else{
                          $vrDate =$CurrentDate;
                        }

                    ?>

                      <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                      <input type="hidden" name="" value="<?php echo $vrDate; ?>" id="ToDateFy">

                      <input type="text" class="form-control transdatepicker" name="datetime" id="dateTime" value="{{ $vrDate }}" placeholder="Enter Date" autocomplete="off">

                    </div> 
                    <small id="showmsgfordate" style="color:red;"></small>
                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('datetime', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>
                  <!-- /.form-group -->

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Vehicle Type : <span class="required-field"></span> </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <select name="vehicle_type" id="vehicle_type" style="border-color: lightgray;width: 101%;" onchange="getVehicleList();">
                        <option value="">-- Select --</option>
                        <option value="GRN" <?php echo old('vehicle_type') == 'GRN' ? 'selected' : ""?>>Load-GRN Inward</option>
                        <option value="TRIP" <?php echo old('vehicle_type') == 'TRIP' ? 'selected' : ""?>>Empty-Dispatch Outward</option>
                      </select>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('vehicle_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>

                     Vehicle Number : 

                      <span class="required-field"></span>

                    </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input list="vehicleNoList" class="form-control" name="vehicle_number" value="{{ old('vehicle_number') }}" placeholder="Enter Vehicle Number" maxlength="15" id="vehicle_number" autocomplete="off" oninput="getTripNoOrVehicle('VEHICLE')">

                        <datalist id="vehicleNoList">
                          
                        </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('vehicle_number', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Trip No : <span class="required-field"></span> </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input list="tripNoList" class="form-control" name="trip_no" value="{{ old('trip_no') }}" placeholder="Enter Trip No" maxlength="15" id="trip_no" onchange="getTripNoOrVehicle('TRIP')" autocomplete="off">

                      <datalist id="tripNoList">
                 
                        </datalist>

                      </div>
                      <input type="hidden" id="trip_headID" name="trip_headID">
                    <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('trip_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>
              
              </div>

              <div class="row">

                <div class="col-md-2">

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

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Series Code : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                        <?php $seriesCnt = count($seriesList); 
                        if($seriesCnt == 1){
                          $seriesCode = $seriesList[0]->SERIES_CODE;
                          $seriesName = $seriesList[0]->SERIES_NAME;
                        }else{
                          $seriesCode ='';
                          $seriesName ='';
                        }
                        ?>
                        <input list="seriesList" class="form-control" name="series_code" value="{{$seriesCode}}" id="series_code" placeholder="Enter Series Code" autocomplete="off" onchange="getvrnoBySeries();">

                        <datalist id="seriesList">
                            <?php foreach ($seriesList as $key) { ?>

                            <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>
                              
                            <?php   } ?>
                        </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                    <label> Series Name : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="series_name" value="{{$seriesName}}" id="series_name" placeholder="Enter Series Name" readonly autocomplete="off">

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
                
              </div>

              <div class="row">

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Plant Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon" style="padding: 1px 7px;">
                           <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                        </span>
                        <?php $plcount = count($plantList); ?>
                        <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plantList[0]->PLANT_CODE;}else{echo old('plant_code');}?>" onchange="getpfctByPlant()" autocomplete="off">

                        <datalist id="PlantcodeList">

                          <option selected="selected" value="">-- Select --</option>

                          @foreach ($plantList as $key)

                          <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Plant Name : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" name="plant_name" value="<?php if($plcount == 1){echo $plantList[0]->PLANT_NAME;}else{echo old('plant_name');}?>" id="plant_name" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('plant_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                  
                </div><!-- col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Profit Center Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
                        <input type="text"  id="profitctrId" name="pfct_code" class="form-control  pull-left" value="{{ old('pfct_code') }}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('pfct_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    <small id="profit_center_err" style="color: red;"> </small>

                  </div> <!-- /.form-group -->

                </div><!-- col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Profit Center Name : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" name="pfct_name" value="{{ old('pfct_name') }}" id="pfct_name" placeholder="Enter Profit Center Name" readonly autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('pfct_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                  
                </div><!-- col -->

              </div> <!-- row -->

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                    <label> Driver Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-file-text-o"></i></span>

                      <input type="text" class="form-control" name="driver_name" id="driver_name" value="{{ old('driver_name') }}" placeholder="Enter Driver Name" autocomplete="off" maxlength="40">

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('driver_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-4">

                  <div class="form-group">

                    <label>Driver ID : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="text" class="form-control" name="driver_id" value="{{ old('driver_id') }}" placeholder="Enter Driver ID"  id="driver_id" autocomplete="off">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('driver_id', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-4">

                  <div class="form-group">

                    <label> Mobile Number : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                        <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}" placeholder="Enter Mobile Number" autocomplete="off" maxlength="10">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('mobile_number', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div><!-- /.form-group -->

                </div>

              </div>

              <div class="row">

                <div style="text-align: center;">

                  <button type="Submit" id="submitBtn" class="btn btn-primary">

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

      <div class="col-md-2"> </div>

    </div>

  </section>

</div>


@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/coldStorageCommonjs.js') }}" ></script>

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

    getpfctByPlant();
    getVehicleList();
    /*$("#trip_no").on('change', function () {  

      var val = $("#trip_no").val();

      var xyz = $('#tripNoList option').filter(function(el) {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ? xyz : 'No Match';

      if(msg=='No Match'){  
        $('#trip_no').val('');

      }else{
      }
              
    });*/

    /*$("#vehicle_number").on('change', function () {  

      var val = $("#vehicle_number").val();

      var xyz = $('#vehicleNoList option').filter(function(el) {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ? xyz : 'No Match';

      if(msg=='No Match'){  
        $('#vehicle_number').val('');

      }else{
      }
              
    });

    */

    $(window).on("load",function(){

      getvrnoBySeries();

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

    $('.Number').keypress(function (event) {
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
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

  });

  function getvrnoBySeries(){

      var series_Code = $('#series_code').val();

      var xyz = $('#seriesList option').filter(function() {
        return this.value == series_Code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#series_code').val('');
        $('#vrseqnum').val('');
        $('#series_name').val('');
      }else{
        $('#vrseqnum').val('');
        $('#series_name').val(msg);
      }

      var seriesCode = $('#series_code').val();
      var transcode  = $('#trans_code').val();

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
      });

      $.ajax({

        url:"{{ url('get-last-no-vr-sequence-by-series-new') }}",
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
                        var lastNo = parseInt(getlastno) +  parseInt(1);
                        $('#vrseqnum').val(lastNo);
                    }else{
                        var getlastno = '';
                    }
                }

            } /* /. success */
         } /* /. success function */
    }); /* /. ajax function */
  } /* /. main function */

  function getTripNoOrVehicle(fieldType){

    var vehicleType = $('#vehicle_type').val();

    if(vehicleType == 'TRIP'){

      if(fieldType == 'VEHICLE'){

        var vehicleNum   = $('#vehicle_number').val();
        var xyz = $('#vehicleNoList option').filter(function() {
          return this.value == vehicleNum;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          //$('#vehicle_number').val('');
        }else{
        }

      }

    }

    if(fieldType == 'TRIP'){

      var tripNo   = $('#trip_no').val();
      var xyz = $('#tripNoList option').filter(function() {
        return this.value == tripNo;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#trip_no,#trip_headID,#vehicle_number,#Plant_code,#plant_name,#profitctrId,#pfct_name,#driver_name,#driver_id,#mobile_number').val('');
      }else{
        $('#trip_headID,#vehicle_number,#Plant_code,#plant_name,#profitctrId,#pfct_name,#driver_name,#driver_id,#mobile_number').val('');
      }

    }

    /*if(vehicle_type == 'TRIP'){
      var vehicleNum   = $('#vehicle_number').val();
      var xyz = $('#vehicleNoList option').filter(function() {
        return this.value == vehicleNum;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        //$('#vehicle_number').val('');
      }else{
      }

    }*/

    var vehicle_no   = $('#vehicle_number').val();
    var trip_no      = $('#trip_no').val();
    var vehicle_type = $('#vehicle_type').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url:"{{ url('get-trip-no-vehicle-no-in-gate-entry-cf') }}",
          method : "POST",
          type: "JSON",
          data: {vehicle_no: vehicle_no,trip_no:trip_no,vehicle_type:vehicle_type},
          success:function(data){
            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
              $('#tripNoList').empty();
              $('#trip_headID,#Plant_code,#plant_name,#profitctrId,#pfct_name,#trip_no').val('');
              $('#submitBtn').prop('disabled',false);

            }else if(data1.response == 'success'){

              if(data1.data == ''){
                $('#submitBtn').prop('disabled',false);
              }else{

                if(vehicle_no && fieldType == 'VEHICLE'){
                  $("#tripNoList").empty();
                  
                  $.each(data1.data, function(k, getData) {

                    $("#tripNoList").append($('<option>',{

                      value:getData.TRIP_NO,

                      'data-xyz':getData.TRIP_NO,
                      text:getData.TRIP_NO+'-'+getData.CP_NAME+'-'+getData.TO_PLACE+'-'+getData.VEHICLE_NO

                    }));

                  });

                  $('#submitBtn').prop('disabled',true);

                }

                if(vehicle_no =='' && fieldType == 'TRIP'){

                  if(data1.data.length == 1){
                    $('#vehicle_number').val(data1.data[0].VEHICLE_NO);
                  }

                  $("#vehicleNoList").empty();
                  $.each(data1.data, function(k, getData) {

                    $("#vehicleNoList").append($('<option>',{

                      value:getData.VEHICLE_NO,

                      'data-xyz':getData.VEHICLE_NO,
                      text:getData.VEHICLE_NO+'-'+getData.CP_NAME+'-'+getData.TO_PLACE

                    }));

                  });

                }

                $('#Plant_code').val(data1.data[0].PLANT_CODE);
                $('#plant_name').val(data1.data[0].PLANT_NAME);
                $('#profitctrId').val(data1.data[0].PFCT_CODE);
                $('#pfct_name').val(data1.data[0].PFCT_NAME);
                $('#trip_headID').val(data1.data[0].TRIPHID);
                
              }

              if(data1.data_driver == ''){

              }else{
                $('#driver_name').val(data1.data_driver[0].DRIVER_NAME);
                $('#driver_id').val(data1.data_driver[0].DRIVER_ID);
                $('#mobile_number').val(data1.data_driver[0].MOBILE_NUMBER);
              }

              var tripNoSel = $('#trip_no').val();

              if(tripNoSel){
                $('#submitBtn').prop('disabled',false);
              }else{
                $('#submitBtn').prop('disabled',true);
              }

            } /* /. success */
         } /* /. success function */
    }); /* /. ajax function */

    if(vehicle_no =='' && trip_no==''){
      getVehicleList();
    }

    /*var vehicleNo = $('#vehicle_number').val();
    var trip_no   = $('#trip_no').val();
    var vehicleTye = $("#vehicle_type").val();*/

    /*if(vehicleTye== 'GRN'){
      //$('#trip_no').prop('readonly',true);
      //$('#submitBtn').prop('disabled',false);
    }else if(vehicleTye == 'TRIP'){

      if(vehicleNo && trip_no){
        $('#submitBtn').prop('disabled',false);
      }else{
        $('#submitBtn').prop('disabled',true);
      }
      
    }*/



  }

  function getVehicleList(){

    var vehicle_type = $('#vehicle_type').val();

    if(vehicle_type== 'GRN'){
      $('#trip_no').prop('readonly',true);
      $('#vehicle_number,#trip_no,#trip_headID').val('');
      $('#tripNoList').empty();
      $('#vehicleNoList').empty();
    }else if(vehicle_type == 'TRIP'){
      $('#trip_no').prop('readonly',false);
      $('#vehicle_number,#trip_no,#trip_headID').val('');
      $('#tripNoList').empty();
      $('#vehicleNoList').empty();
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url:"{{ url('get-trip-no-vehicle-no-in-gate-entry-cf') }}",
          method : "POST",
          type: "JSON",
          data: {vehicle_type:vehicle_type},
          success:function(data){
            var data1 = JSON.parse(data);

            console.log('vehicle',data1.data_vehicleNo);
            if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.data_vehicleNo == ''){

              }else{
                
                $("#tripNoList").empty();
                  $.each(data1.data_vehicleNo, function(k, getData) {

                    $("#tripNoList").append($('<option>',{

                      value:getData.TRIP_NO,
                      'data-xyz':getData.TRIP_NO,
                      text:getData.TRIP_NO+'-'+getData.CP_NAME+'-'+getData.TO_PLACE+'-'+getData.VEHICLE_NO

                    }));

                  });

                  $("#vehicleNoList").empty();
                  $.each(data1.data_vehicleNo, function(k, getData) {

                    $("#vehicleNoList").append($('<option>',{

                      value:getData.VEHICLE_NO,
                      'data-xyz':getData.VEHICLE_NO,
                      text:getData.VEHICLE_NO

                    }));

                  });
                
              }

            } 
         } 
    }); 

    /*var vehicleNo = $('#vehicle_number').val();
    var trip_no   = $('#trip_no').val();
    var vehicleTye = $("#vehicle_type").val();*/

    /*if(vehicleTye== 'GRN'){
      //$('#trip_no').prop('readonly',true);
      //$('#submitBtn').prop('disabled',false);
    }else if(vehicleTye == 'TRIP'){

      if(vehicleNo && trip_no){
        $('#submitBtn').prop('disabled',false);
      }else{
        $('#submitBtn').prop('disabled',true);
      }
      
    }*/

  }

</script>

@endsection