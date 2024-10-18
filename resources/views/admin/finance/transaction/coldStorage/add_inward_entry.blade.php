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
  .numberRight{
    text-align:right;
  }
  input[type="text"]::placeholder {
    text-align: left;
  }
@media screen and (max-width: 600px) {
  
  .PageTitle{
    float: left;
  }

}

</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1> Inward Entry

      <small>Add Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Master</a></li>

      <li class="Active"><a href="{{ URL('/transaction/ColdStorage/add-inward-entry-transaction')}}"> Inward Entry</a></li>

      <li class="Active"><a href="{{ URL('/transaction/ColdStorage/add-inward-entry-transaction')}}">Add Inward Entry</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Inward Entry</h2>

                <div class="box-tools pull-right">

                  <a href="{{ url('/transaction/ColdStorage/View-inward-entry-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Inward Entry</a>

                </div>

            </div><!-- /.box-header -->

            <div class="box-body">

              <form action="{{ url('transaction/ColdStorage/save-inward-entry-transaction') }}" method="POST" >

              @csrf

                <div class="row">
                    
                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Vehicle No:<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input list="vehicleNoList" class="form-control" name="vehicleNo" id="vehicleNo" value="{{ old('vehicleNo') }}" placeholder="Enter Vehicle No" maxlength="40" onchange="vehicleDetails()" autocomplete="off">

                        <datalist id="vehicleNoList">
                          
                          <?php foreach ($vehicleNolist as $key) { ?>

                            <option value="<?= $key->VEHICLE_NUMBER; ?>" data-xyz="<?= $key->VEHICLE_NUMBER; ?>"><?= $key->VEHICLE_NUMBER; ?></option>
                         <?php } ?>

                        </datalist>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('vehicleNo', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div> <!-- /.form-group -->

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Date : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="text" class="form-control transdatepicker" name="entrydate" id="inwardDate" value="{{ old('entrydate') }}" placeholder="Enter Date" autocomplete="off" readonly>

                      </div> 
                      <small id="showmsgfordate" style="color:red;"></small>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('entrydate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div>

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

                  <div class="col-md-2">

                    <div class="form-group">

                      <label> Series Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                          <?php $seriescount = count($seriesList); ?>
                          <input list="seriesList" class="form-control" name="series_code" value="<?php if($seriescount == 1){echo $seriesList[0]->SERIES_CODE;}?>" id="series_code" placeholder="Enter Series Code" autocomplete="off" onchange="getvrnoBySeries();">

                          <datalist id="seriesList">
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

                          <input type="text" class="form-control" name="series_name" value="<?php if($seriescount == 1){echo $seriesList[0]->SERIES_NAME;}?>" id="series_name" placeholder="Enter Series Name" readonly autocomplete="off">

                        </div>

                    </div><!-- /.form-group -->
                    
                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label> Vr No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control numberRight" name="vrseqnum" value="" id="vrseqnum" placeholder="Enter Vr No" readonly autocomplete="off">

                        </div>

                    </div><!-- /.form-group -->
                    
                  </div><!-- /.col -->

                </div><!-- /.row -->

                <div class="row">

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Customer Code:<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input list="customerList" class="form-control" name="customerCd" id="customerCd" value="{{ old('customerCd') }}" placeholder="Enter Customer" maxlength="40" autocomplete="off">

                        <datalist id="customerList">
                          
                          <?php foreach ($customerlist as $key) { ?>

                            <option value="<?= $key->ACC_CODE; ?>" data-xyz="<?= $key->ACC_NAME; ?>"><?= $key->ACC_CODE; ?> - <?= $key->ACC_NAME; ?></option>
                         <?php } ?>

                        </datalist>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('customerCd', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div> <!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Customer Name:<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="customerName" id="customerName" value="{{ old('customerName') }}" placeholder="Enter Customer Name" maxlength="40" autocomplete="off" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('customerName', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div> <!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Item Code :<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input list="itemList" class="form-control" name="item_code" id="item_code" value="{{ old('item_code') }}" onchange="itemackingData();" placeholder="Enter Item Code" maxlength="40" autocomplete="off">
                        
                        <datalist id="itemList">
                          
                          <?php foreach ($itemList as $key) { ?>

                            <option value="<?= $key->ITEM_CODE; ?>" data-xyz="<?= $key->ITEM_NAME; ?>"><?= $key->ITEM_CODE; ?> - <?= $key->ITEM_NAME; ?></option>
                         <?php } ?>

                        </datalist>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div> <!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Item Name :<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input list="customerList" class="form-control" name="item_name" id="item_name" value="{{ old('item_name') }}" placeholder="Enter Item Name" maxlength="40" autocomplete="off" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('item_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div> <!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label style="width:50%;">UM:<span class="required-field"></span></label>
                      <label style="tab-size: 2">&nbsp;&nbsp;AUM:<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <div style="display:flex;">
                          <input type="" class="form-control" name="um_OfItem" id="um_OfItem" value="" placeholder="Enter UM" maxlength="40" autocomplete="off" readonly>

                          <input type="" class="form-control" name="aum_OfItem" id="aum_OfItem" value="" placeholder="Enter AUM" maxlength="40" autocomplete="off" readonly>
                        </div>  

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('um_OfItem', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div> <!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>C Factor:<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control numberRight" name="cfactor" id="cfactor" value="" placeholder="Enter C Factor" maxlength="40" autocomplete="off" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cfactor', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div> <!-- /.form-group -->

                  </div><!-- /.col -->
                  
                </div><!-- /.row -->

                <div class="row">

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Packing Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input list="packingList" class="form-control" name="packing_code" id="packing_code" value="{{ old('packing_code') }}" placeholder="Enter Packing Code" maxlength="40" autocomplete="off">

                        <datalist id="packingList">
                            <option value=''> -- select --</option>
                        </datalist>
                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('packing_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Packing Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="packing_name" id="packing_name" value="{{ old('packing_name') }}" placeholder="Enter Packing Name" maxlength="40" autocomplete="off" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('packing_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Qty :<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control numberRight" name="qty" id="qty" value="{{ old('qty') }}" placeholder="Enter Qty" maxlength="10" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('qty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Weight : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control numberRight" name="weight" id="weight" value="{{ old('weight') }}" placeholder="Enter Weight" maxlength="40" autocomplete="off" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('weight', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Prod Cond : <span class="required-field"></span></label>

                      <div class="input-group">

                        <input type="radio" class="optionsRadios1" name="prod_cond" value="GOOD" checked>&nbsp;GOOD &nbsp;
                        <input type="radio" class="optionsRadios1" name="prod_cond" value="BAD">&nbsp;BAD &nbsp;

                        <input type="radio" class="optionsRadios1" name="prod_cond" value="AVG">&nbsp;AVG

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('prod_cond', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label> Vehicle Type : <span class="required-field"></span> </label>

                      <div class="input-group">
                        <input type="hidden" name="vehicleType" value="" id="vehicleType">
                        <input type="radio" class="optionsRadios1" name="vehicle_type" value="EMPTY" checked >&nbsp;&nbsp;EMPTY &nbsp;&nbsp;

                        <input type="radio" class="optionsRadios1" name="vehicle_type" value="LOAD" >&nbsp;&nbsp;LOAD

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('vehicle_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>
                  
                </div><!-- /.row -->

                <div class="row">

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Plant Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="plant_code" id="plant_code" value="{{ old('plant_code') }}" placeholder="Enter Plant Code" maxlength="10" autocomplete="off" readonly> 

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Plant Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="plant_name" id="plant_name" value="{{ old('plant_code') }}" placeholder="Enter Plant Name" maxlength="10" autocomplete="off" readonly> 

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Pfct Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="pfct_code" id="pfct_code" value="{{ old('pfct_code') }}" placeholder="Enter Pfct Code" maxlength="10" autocomplete="off" readonly> 

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('pfct_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Pfct Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="pfct_name" id="pfct_name" value="{{ old('pfct_name') }}" placeholder="Enter Pfct Name" maxlength="10" autocomplete="off" readonly> 

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('pfct_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->
                  
                </div><!-- /.row -->

                <div class="row">

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Driver Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="driver_name" id="driver_name" value="{{ old('driver_name') }}" placeholder="Enter Driver Name" maxlength="10" autocomplete="off" readonly> 

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('driver_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Driver Id Card: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="driver_idCard" id="driver_idCard" value="{{ old('driver_idCard') }}" placeholder="Enter Driver Id Card" maxlength="10" autocomplete="off" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('driver_idCard', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Driver Mobile No: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="driver_mobile" id="driver_mobile" value="{{ old('driver_mobile') }}" placeholder="Enter Driver Mobile No" maxlength="10" autocomplete="off" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('driver_mobile', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->
                  
                </div><!-- /.row -->

                <div style="text-align: center;">

                  <button type="Submit" class="btn btn-primary">

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save

                  </button>

                </div>

              </form><!-- /.form -->

            </div><!-- /.box-body -->

          </div><!-- /.Custom-Box -->

      </div><!-- /.col-sm-12 -->

    </div><!-- /.row -->

  </section><!-- /.section -->

</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/coldStorageCommonjs.js') }}" ></script>

<script type="text/javascript">

  $(document).ready(function(){
    getvrnoBySeries();
  });

  function itemackingData(){

    var tblName = 'ItemPack';
    var fieldName = $('#item_code').val();

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

          url:"{{ url('get-item-packing-against-item') }}",

          method : "POST",

          type: "JSON",

          data: {fieldName: fieldName,tblName:tblName},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                if(data1.ItemPackingList==''){

                }else{

                  var cfactor = data1.ItemPackingList[0].C_FACTOR;
                  var umOfItem = data1.ItemPackingList[0].UM;
                  var aumOfItem = data1.ItemPackingList[0].AUM;

                  $('#um_OfItem').val(umOfItem);
                  $('#aum_OfItem').val(aumOfItem);
                  $('#cfactor').val(cfactor);

                  $("#packingList").empty();

                  $.each(data1.ItemPackingList, function(k, getData){

                    $("#packingList").append($('<option>',{

                      value:getData.PACKING_ID,

                      'data-xyz':getData.PACKING_NAME,
                      text:getData.PACKING_NAME

                    }));

                  })

                }

              }

          }

    });
  }

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

            } /* /. success */
         } /* /. success function */
    }); /* /. ajax function */
  } /* /. main function */

  function vehicleDetails(){

    var vehicle_No = $("#vehicleNo").val();

    var xyz = $('#vehicleNoList option').filter(function() {

        return this.value == vehicle_No;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
      $("#plant_code").val('');
      $("#plant_name").val('');
      $("#pfct_code").val('');
      $("#pfct_name").val('');
      $("#vehicleNo").val('');
      $("#driver_name").val('');
      $("#driver_idCard").val('');
      $("#driver_mobile").val('');
    }else{
    }

     $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });


     $.ajax({

                url:"{{ url('get-vehicle-entry-details') }}",

                 method : "POST",

                 type: "JSON",

                 data: {vehicle_No: vehicle_No},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                          
                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Data Not Found...!</p>");

                      }else if(data1.response == 'success'){
                          
                         $("#driver_name").val(data1.data[0].DRIVER_NAME);
                         $("#driver_idCard").val(data1.data[0].DRIVER_ID);
                         $("#driver_mobile").val(data1.data[0].MOBILE_NUMBER);
                         $("#plant_code").val(data1.data[0].PLANT_CODE);
                         $("#plant_name").val(data1.data[0].PLANT_NAME);
                         $("#pfct_code").val(data1.data[0].PFCT_CODE);
                         $("#pfct_name").val(data1.data[0].PFCT_NAME);
                         $('#vehicleType').val(data1.data[0].VEHICLE_TYPE);
                         var dateGet = data1.data[0].DATETIME;
                         var slitData = dateGet.split('-');
                         var inwardDate = slitData[2]+'-'+slitData[1]+'-'+slitData[0];
                         $('#inwardDate').val(inwardDate);
                         $("input[name=vehicle_type][value='"+data1.data[0].VEHICLE_TYPE+"']").prop("checked",true);
                         $("input[name=vehicle_type]").prop("disabled",true);
                         
                      }
                 }

              });

  }

</script>

<script type="text/javascript">

  $(document).ready(function(){
    
    $('#qty').on('input',function(){
      var cFactor = parseFloat($('#cfactor').val());
      var quantity = parseFloat($('#qty').val());

      if(quantity){
        var weight = quantity * cFactor;

        var calWeight = (Math.round(weight * 100) / 100).toFixed(2);
        $('#weight').val(calWeight);
      }else{
        $('#weight').val('');
      }

    });

  });
</script>

<script type="text/javascript">
$(document).ready(function(){
    $('.Number').keypress(function (event) {
      var keycode = event.which;
      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
          event.preventDefault();
      }
  });
});
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