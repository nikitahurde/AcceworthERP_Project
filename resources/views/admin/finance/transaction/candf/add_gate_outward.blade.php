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
  .tablehide{
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

    <h1> Gate Outward Transaction

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

      <div class="col-md-1"> </div>

      <div class="col-sm-10">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Gate Outward</h2>
            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/CandF/view-gate-outward-transaction-cf') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Gate Outward</a>

            </div>
          
          </div><!-- /.box-header -->

          <div class="box-body">

            <form action="{{ url('transaction/CandF/Save-gate-outward-transaction-cf') }}" method="POST" >

              @csrf

              <div class="row">

                <div class="col-md-3">

                  <div class="form-group">

                     <?php 
                        date_default_timezone_set('Asia/Kolkata');
                        $todayDt     =date("m-d-Y H:i:s");
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
                      <input type="hidden" name="" value="<?php echo $todayDt; ?>" id="todayDateId">

                    <label> Vehicle Out Date/Time: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                        <input type="text" class="form-control timePicker" name="outTime" id="outTime" value="{{ $vrDate }}" placeholder="Enter Vehicle Out Date/Time" maxlength="10" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('outTime', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div><!-- /.form-group -->

                </div><!-- /col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Vehicle Type : <span class="required-field"></span> </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <select name="vehicle_type" id="vehicle_type" style="border-color: lightgray;width: 101%;" onchange="getvehicleData();">
                        <option value="">-- Select --</option>
                        <option value="GRN">Empty-Outward</option>
                        <option value="TRIP">Load-Dispatch Outward</option>
                      </select>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('vehicle_block', '<p class="help-block" style="color:red;">:message</p>') !!}

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
                        <input type="hidden" name="biltyHId" value="" id="biltyHId">
                        <input list="vehicleNoList" class="form-control" name="vehicle_number" value="{{ old('vehicle_number') }}" placeholder="Enter Vehicle Number" maxlength="15" id="vehicleNo" onchange="getvehicleData();" autocomplete="off">

                        <datalist id="vehicleNoList">

                          <option selected="selected" value="">-- Select --</option>
                        </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('vehicle_number', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- ./col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Trip No : <span class="required-field"></span> </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input list="tripNoList" class="form-control" name="trip_no" value="{{ old('trip_no') }}" placeholder="Enter Trip No" maxlength="15" id="trip_no" autocomplete="off" readonly>

                      <datalist id="tripNoList">
                            <?php foreach ($tripNoList as $key) { ?>

                            <option value='<?php echo $key->TRIP_NO?>'   data-xyz ="<?php echo $key->TRIP_NO; ?>" ><?php echo $key->TRIP_NO; ?></option>
                              
                            <?php   } ?>
                        </datalist>

                      </div>

                    <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('trip_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

              </div><!-- ./row -->

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

                </div><!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Series Code : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input list="seriesList" class="form-control" name="series_code" value="" id="series_code" placeholder="Enter Series Code" autocomplete="off" readonly>


                      </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-4">

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

                <div class="col-md-3">

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

                <div class="col-md-3">

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

                <div class="col-md-3">

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

                <div class="col-md-3">

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

              </div> <!-- row -->

              <div class="row">

                <div class="col-md-4">

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

                <div class="col-md-4">

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

                <div class="col-md-4">

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

                   <input type="hidden" name="tripHid" id="tripHid" value="">
                   <input type="hidden" name="cfgateId" id="cfgateId" value="">

                </div>

              </div>

              <div class="row">

                <div class="col-md-12">
                    <div>

                        <table class="table tablehide" width="100%">
                            <tr>
                                <thead>
                                    <th>ACC CODE / ACC NAME</th>
                                    <th>LR NO /LR DATE</th>
                                    <th>INVC NO / INVC DT</th>
                                    <th>E-WAYBILL NO </th>
                                    <th>ITEM CODE /ITEM NAME</th>
                                    <th>QTY ISSUED</th>
                                    <th>AQTY ISSUED</th>
                                </thead>
                            </tr>
                        <tbody id='bodyTable'>
                            
                        </tbody>
                        </table>
                        

                    </div>
                </div>
                  
              </div>

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

      <div class="col-md-1"> </div>

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
    var todayDt   = $('#todayDateId').val();
    $('.timePicker').datetimepicker({

       format:'DD-MM-YYYY HH:mm:ss',
       minDate: fromDate,
       maxDate: todayDt,
    });

    $(".timePicker").on("dp.change", function(e) {
      $(this).data('DateTimePicker').hide();
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
  
  function getvehicleData(){

    var vehicleNo   = $("#vehicleNo").val();
    var splitgateid = vehicleNo.split('~');
    var vehicle_No  = splitgateid[0];
    var tblgateid   = splitgateid[1];

    $("#cfgateId").val(tblgateid);

    var vehicle_type = $("#vehicle_type").val();

      $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({

            url:"{{ url('get-details-for-vehicle-gate-outward') }}",

            method : "POST",

            type: "JSON",

            data: {vehicle_type:vehicle_type,vehicle_No:vehicle_No,tblgateid:tblgateid},

            success:function(data){

              var data1 = JSON.parse(data);
              //console.log('data1',data1);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                  $("#vehicleNoList").empty();
                  $('#vehicleNo').val('');
                }else if(data1.response == 'success'){

                  //if(vehicle_type && vehicle_No==''){

                      if(data1.dataVehicleList == ''){

                      }else{
                        $("#vehicleNoList").empty();
                        $('#vehicleNo').val('');
                        $.each(data1.dataVehicleList, function(k, getData){

                          $("#vehicleNoList").append($('<option>',{

                            value:getData.VEHICLE_NUMBER+'~'+getData.CFGATEID,

                            'data-xyz':getData.VEHICLE_NUMBER+'~'+getData.CFGATEID,
                            'text':getData.VEHICLE_NUMBER

                          }));

                        });
                      }



                  //}
                  
                  if(data1.dataVehicleDetails == ''){
                    
                    $('#Plant_code').val('');
                    $('#plant_name').val('');
                    $('#pfct_code').val('');
                    $('#pfct_name').val('');
                    $('#trip_no').val('');
                    $('#tripHid').val('');

                  }else{


                    $('#series_code').val(data1.dataVehicleDetails.SERIES_CODE);
                    $('#series_name').val(data1.dataVehicleDetails.SERIES_NAME);
                    $('#vrseqnum').val(data1.dataVehicleDetails.VRNO);
                    $('#Plant_code').val(data1.dataVehicleDetails.PLANT_CODE);
                    $('#plant_name').val(data1.dataVehicleDetails.PLANT_NAME);
                    $('#pfct_code').val(data1.dataVehicleDetails.PFCT_CODE);
                    $('#pfct_name').val(data1.dataVehicleDetails.PFCT_NAME);
                    $('#driver_name').val(data1.dataVehicleDetails.DRIVER_NAME);
                    $('#driver_id').val(data1.dataVehicleDetails.DRIVER_ID);
                    $('#mobile_number').val(data1.dataVehicleDetails.MOBILE_NUMBER);
                    $('#trip_no').val(data1.dataVehicleDetails.TRIP_NO);
                    $('#tripHid').val(data1.dataVehicleDetails.TRIPHID);
                    
                  }


                  if(data1.lr_details == ''){

                    }else{

                        var srno =1;
                        var totaldiselcal=0;

                      $(".tablehide").css('display','block');


                     var totalqty = 0;   
                     var totalAqty = 0;   
                     $.each(data1.lr_details, function(k, getData) {

                             totalqty += parseFloat(getData.QTYISSUED);

                             totalAqty += parseFloat(getData.AQTISSUED);

                             var aqtyissued = Math.round(getData.AQTISSUED);

                            var tableData = "<tr><td>"+getData.ACC_CODE+" - "+getData.ACC_NAME+"</td><td>"+getData.LR_NO+" ["+getData.LR_DATE+"]</td><td>"+getData.INVOICE_NO+" ["+getData.INVOICE_DATE+"]</td><td>"+getData.EWAY_BILL_NO+"</td><td>"+getData.ITEM_CODE+" - "+getData.ITEM_NAME+"</td><td style='text-align:right;'>"+getData.QTYISSUED+"</td><td style='text-align:right;'>"+aqtyissued+"</td></tr>";

                                $('#bodyTable').append(tableData);

                                srno++;


                        });


                        var total = "<td colspan='5' style='text-align:right;font-weight:bold;'>Total : </td><td style='text-align:right'><input type='text'  value='"+totalqty+"' style='width:72px;text-align:right;border:1px solid #d5d3d3;'/></td><td style='text-align:right;'><input type='text' value='"+totalAqty+"' style='width:76px;text-align:right;border:1px solid #d5d3d3;'/></td>";

                         $('#bodyTable').append(total);




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