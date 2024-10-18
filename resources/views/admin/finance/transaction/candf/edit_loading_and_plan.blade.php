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
  ::placeholder {
    text-align:left;
  }
  @media screen and (max-width: 600px) {

    .showinmobile{
      display: block;
    }
    .PageTitle{
      float: left;
    }

  }
  .showcodename{
    color: #5696bb;
    font-size: 13px;
    font-weight: 600;
  }
  .numerRight{
    text-align:right;
  }
  .readonlyField{
    background-color: #eee;
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
  .hideBtn{
    display:none;
  }

</style>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
      Create Loading Plan
      <small>Add Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>
      <li class="active"><a href="{{ url('/transaction/candf/view-loading-slip') }}">Create Loading Plan</a></li>
      <li class="active"><a href="{{ url('/transaction/candf/view-loading-slip') }}">Add Loading Plan</a></li>

    </ol>

  </section><!-- /.section -->

<form id="loadingSlipTran">
  @csrf

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Create Loading Plan</h2>

              <div class="box-tools pull-right showinmobile">
                <a href="{{ url('/transaction/candf/view-loading-slip') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Create Loading Plan</a>
              </div>


              <div class="box-tools pull-right">
                <a href="{{ url('/transaction/candf/view-loading-slip') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Create Loading Plan</a>
              </div>

            </div><!-- /.box-header -->

            @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i>Success...!</h4>

                 {!! session('alert-success') !!}

              </div>

            @endif

            @if(Session::has('alert-error'))

              <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-ban"></i>Error...!</h4>

                {!! session('alert-error') !!}

              </div>

            @endif

          <div class="box-body">

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Date : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>


                    <input type="text" name="transaction_date" id="transaction_date" class="form-control transdatepicker" placeholder="Enter Date" value="<?php echo date("d-m-Y", strtotime($classData[0]->VRDATE));?>" readonly>

                  </div>
                  <small id="showmsgfordate"></small>

                </div><!-- /.form group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>

                   Trans Code : 

                    <span class="required-field"></span>

                  </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="text" class="form-control" name="trans_code" value="{{$classData[0]->TRAN_CODE}}" placeholder="Enter Trans Code" maxlength="15" id="trans_code" readonly >

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

                      <input list="seriesList" class="form-control" name="series_code" value="{{$classData[0]->SERIES_CODE}}" id="series_code" placeholder="Enter Series Code" autocomplete="off" readonly>

                    </div>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Series Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="series_name" value="{{$classData[0]->SERIES_NAME}}" id="series_name" placeholder="Enter Series Name" readonly autocomplete="off">

                    </div>

                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Vr No : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="vrseqnum" value="{{$classData[0]->VRNO}}" id="vrseqnum" placeholder="Enter Vr No" readonly autocomplete="off">

                    </div>

                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Rake No: <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="rakeNo" name="rakeNo" class="form-control  pull-left" value="{{$classData[0]->RAKE_NO}}" placeholder="Enter Rake No" autocomplete="off" readonly>

                  </div>

                </div>

              </div><!-- /.col -->

            </div><!-- /.row -->

            <div class="row">

              <div class="col-md-5">

                <div class="form-group">

                  <label> Transporter Type: <span class="required-field"></span></label>

                   <div class="input-group">

                    <input type="radio" class="optionsRadios1 transporterType" onclick="transporterTypeFun()" name="trans_type" value="SELF" <?php if($classData[0]->TRPT_TYPE == 'SELF'){ echo 'checked';} ?>>&nbsp;Self &nbsp;
                    <input type="radio" class="optionsRadios1 transporterType" onclick="transporterTypeFun()" name="trans_type" value="MARKET" <?php if($classData[0]->TRPT_TYPE == 'MARKET'){ echo 'checked';} ?>>&nbsp;&nbsp;Other Transporter &nbsp;&nbsp;
                    <input type="radio" class="optionsRadios1 transporterType" onclick="transporterTypeFun()" name="trans_type" value="SISTER_CONCERN" <?php if($classData[0]->TRPT_TYPE == 'SISTER_CONCERN'){ echo 'checked';} ?>>&nbsp;&nbsp;Sister Concern &nbsp;&nbsp;
                    <input type="radio" class="optionsRadios1 transporterType" onclick="transporterTypeFun()" name="trans_type" value="EX_YARD" <?php if($classData[0]->TRPT_TYPE == 'EX_YARD'){ echo 'checked';} ?>>&nbsp;&nbsp;Customer Scope &nbsp;&nbsp;

                  </div>

                </div><!-- /.form group -->
                <input type="hidden" id="getTransportType" value="{{$classData[0]->TRPT_TYPE}}" name="seletedTransType">
              </div><!-- /.col --> 

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input list="vehicleList" id="vehicle_no" name="vehicle_no" class="form-control  pull-left" value="{{$classData[0]->VEHICLE_NO}}" placeholder="Enter Vehicle No" onchange="getvehicleDeatils();" autocomplete="off" readonly>


                  </div>

                  <input type="hidden" name="tblGateId" value="{{$classData[0]->CFGATEID}}" id="tblGateId">
                  <input type="hidden" name="driver_name" value="{{$classData[0]->DRIVER_NAME}}" id="driver_name">
                  <input type="hidden" name="driver_id" value="{{$classData[0]->DRIVER_ID}}" id="driver_id">
                  <input type="hidden" name="driver_mobNo" value="{{$classData[0]->MOBILE_NUMBER}}" id="driver_mobNo">
                  <input type="hidden" name="gateEntryVrno" value="" id="gateEntryVrno">
                  <input type="hidden" name="trip_no" value="{{$classData[0]->TRIP_NO}}" id="trip_no">
                  <input type="hidden" name="plant_code" value="{{$classData[0]->PLANT_CODE}}" id="plant_code">
                  <input type="hidden" name="plant_name" value="{{$classData[0]->PLANT_NAME}}" id="plant_name">
                  <input type="hidden" name="pfct_code" value="{{$classData[0]->PFCT_CODE}}" id="pfct_code">
                  <input type="hidden" name="pfct_name" value="{{$classData[0]->PFCT_NAME}}" id="pfct_name">
                  <input type="hidden" id="generateLrNo" value="1">

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">TRPT Code: <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="trptCode" name="trptCode" class="form-control  pull-left" value="{{$classData[0]->TRPT_CODE}}" placeholder="Enter TRPT Code" autocomplete="off" readonly>

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">TRPT Name: <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="trptName" name="trptName" class="form-control  pull-left" value="{{$classData[0]->TRPT_NAME}}" placeholder="Enter TRPT Name" autocomplete="off" readonly>

                  </div>

                </div>

              </div><!-- /.col -->

            </div><!-- /.row -->

          </div><!-- /.box-body -->
          
        </div><!-- /.custom box -->

      </div><!-- /.col-sm-12 -->

    </div><!-- /.row -->

  </section><!-- /.section -->

  <section class="content" style="margin-top: -10%;" id="datatableId">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-warning Custom-Box">

          <div class="box-body">

            <div class="table-responsive">

              <table class="table tdthtablebordr" border="1" cellspacing="0" id="bodytbledata">

                <tr>
                  <th><input class='check_all'  type='checkbox' onclick='select_all()'/></th>
                  <th style='width: 10px;'> Sr.No.</th>
                  <th>CP CODE</th>
                  <th>CP NAME</th>
                  <th>ITEM CODE</th>
                  <th>ITEM NAME</th>
                  <th>QUANTITY</th>
                </tr>

                <?php $srNo=1; foreach($classData as $row){ ?>

                  <tr>

                    <td class='tdthtablebordr'>
                      <input type='checkbox' class='case' id='firstrow{{$srNo}}' onclick='checkcheckbox({{$srNo}});'/>
                      <input type="hidden" id="tempItemSave{{$srNo}}" value="">
                    </td>

                    <td><span id='snum'>{{$srNo}}.</span>
                      <input type='hidden' class='rowCountCls' name='rowCount[]' id='rowCount{{$srNo}}' value='{{$srNo}}'>
                    </td>

                    <td class='tdthtablebordr' style='width: 12%;'>
                      <input list='cpList{{$srNo}}' value='{{$row->CP_CODE}}' name='cp_code[]'  class='inputboxclr' id='cp_code{{$srNo}}' autocomplete='off' onchange="getDataItem({{$srNo}},'CPFIELD')" readonly/>
                      <datalist id='cpList{{$srNo}}'>
                        <option value=''></option>
                      
                      </datalist>
                      <input type="hidden" name="trpt_code[]" id="trpt_code{{$srNo}}">
                      <input type="hidden" name="trpt_name[]" id="trpt_name{{$srNo}}">
                    </td>

                    <td class='tdthtablebordr' style='width: 30%;'>
                      <input type='text' name='cp_name[]' id='cp_name{{$srNo}}' readonly class='inputboxclr readonlyField'  value='{{$row->CP_NAME}}' />
                    </td>

                    <td class='tdthtablebordr' style='width: 12%;'>

                      <input list='itemList{{$srNo}}' value='{{$row->ITEM_CODE}}' name='item_code[]'  class='inputboxclr' id='item_code{{$srNo}}' autocomplete='off' onchange='itemValidation({{$srNo}})' />
                      <datalist id='itemList{{$srNo}}'>
                        <option value=''></option>
                      </datalist>
                    </td>

                    <td class='tdthtablebordr'  style='width: 30%;'>
                      <input type='text' name='item_name[]' id='item_name{{$srNo}}' readonly class='inputboxclr readonlyField'  value='{{$row->ITEM_NAME}}' />
                    </td>

                    <td class='tdthtablebordr'  style='width: 16%;'>
                      <input type='text' name='qunatity[]' id='qunatity{{$srNo}}' class='inputboxclr qtyRecd numerRight'  value='{{$row->QTY}}' autocomplete='off'/>
                    </td>
                      
                  </tr>

                <?php } ?>

              </table>

            </div><!-- /.table respnsive -->

            <div class="row">

              <div class="col-md-12" style="display: flex;">
                <div style="width:85%">
                  
                  <button type="button" class='btn btn-danger delete' id="deletehidn" ><i class="fa fa-minus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Delete</button>

                  <button type="button" class='btn btn-info addmore' id="addmorhidn" ><i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Add More</button>
                  <small id="showDubDataMsg" style="color: red;"></small>
                  <input type="hidden" name="dublicateName1[]" id="dublicateName" value="">
                  <input type="hidden" name="deletedubName1[]" id="deletedubName" value="">

                </div>
                <div style="width:15%">
                  <input class="debitcreditbox inputboxclr numerRight" style="background-color: #eeeeee;" type="text" name="totalQty" id="total_Qty" readonly>
                </div>
               
              </div>

            </div>

            <div class="row" style="text-align:center;margin-bottom: 5px;font-weight: 700;">
              <small id="fieldReqMsg" style="color:red;"></small>
              <small id="stockNotAvailMsg" style="color:red;"></small>
            </div>

            <div class="row">

              <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
              <div class="col-md-12" style="text-align: center;">
                <button class="btn btn-success" type="button" id="submitdata" onclick="submitLoadingSlipTrans(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

                <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitLoadingSlipTrans(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>
              </div>
              
            </div>

          </div><!-- /. box body -->

        </div><!-- custom box -->

      </div><!-- /.col12 -->

    </div><!-- row -->

  </section><!-- section -->

</form>
  
</div>


@include('admin.include.footer')

<script type="text/javascript">

  $(document).ready(function(){

    $("input[name=trans_type]").prop("disabled",true);
    $('#submitdata,#submitdatapdf').prop('disabled',false);

  });

  /* ---------- DELETE ROW ---------- */ 

    $(".delete").on('click', function() {

        $('.case:checkbox:checked').parents("tr").remove();

        $('.check_all').prop("checked", false); 

        check();

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
        $('#submitdata,#submitdatapdf').prop('disabled',true);
      }else{

        $.each( obj, function( key, value ) {
          id=value.id;
          $('#'+id).html(key+1);
        });

      }

    }

    function itemValidation(slNo){

      var item_code = $('#item_code'+slNo).val();
      var cp_code   = $('#cp_code'+slNo).val();

      var xyz = $('#itemList'+slNo+' option').filter(function() {
        return this.value == item_code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#item_code'+slNo+',#item_name'+slNo+'').val('');
      }else{
        $('#item_name'+slNo).val(msg);
      }
      $('#fieldReqMsg').html("");
      var temItem = $('#tempItemSave'+slNo).val();
      var getSelData = $('#dublicateName').val(); 
      var slptData = getSelData.split(',');
      var indexDt = slptData.indexOf(temItem);
      if (indexDt > -1) { // only splice array when item is found
        slptData.splice(indexDt, 1); // 2nd parameter means remove one item only
      }
      $('#dublicateName').val('');
      $('#dublicateName').val(slptData);

      checkDubicateBodyEntry(slNo,cp_code,item_code);
    }

  /* ---------- DELETE ROW ---------- */ 

  /* ----------- ADD MORE FUNCTIONALITY ----------- */

    var sl=1;
    var i=2;
    $(".addmore").on('click',function(){

      count=$('table tr').length;

      var data = "<tr><td class='tdthtablebordr'><input type='checkbox' class='case' id='firstrow"+i+"' onclick='checkcheckbox("+i+");'/><input type='hidden' id='tempItemSave"+i+"' value=''></td>"+
        "<td><span id='snum"+i+"'>"+count+".</span><input type='hidden' class='rowCountCls' name='rowCount[]' id='rowCount"+i+"' value='"+i+"'></td>"+
        "<td class='tdthtablebordr' style='width: 12%;'><input list='cpList"+i+"' value='' name='cp_code[]'  class='inputboxclr' id='cp_code"+i+"' autocomplete='off' onchange='getDataItem("+i+",\""+'CPFIELD'+"\")'/><datalist id='cpList"+i+"'><option value=''></option></datalist><input type='hidden' name='trpt_code[]' id='trpt_code"+i+"'><input type='hidden' name='trpt_name[]' id='trpt_name"+i+"'></td>"+
        "<td class='tdthtablebordr' style='width: 30%;'><input type='text' name='cp_name[]' id='cp_name"+i+"' readonly class='inputboxclr readonlyField'  value='' /></td>"+
        "<td class='tdthtablebordr' style='width: 12%;'><input list='itemList"+i+"' value='' name='item_code[]'  class='inputboxclr' id='item_code"+i+"' onchange='itemValidation("+i+")' autocomplete='off'/><datalist id='itemList"+i+"'><option value=''></option></datalist></td>"+
        "<td class='tdthtablebordr' style='width: 30%;'><input type='text' name='item_name[]' id='item_name"+i+"' readonly class='inputboxclr readonlyField'  value='' /></td>"+
        "<td class='tdthtablebordr' style='width: 16%;'><input type='text' name='qunatity[]' id='qunatity"+i+"' class='inputboxclr qtyRecd numerRight' autocomplete='off' value='' /></td></tr>";
        
        $('table').append(data);

        var transporter_Type = $("input[type='radio'][name='trans_type']:checked").val();
        var vehicleNUM       = $('#vehicle_no').val();
        var splitVehicle     = vehicleNUM.split('~');
        var vehicleNo        = splitVehicle[0];
        var gateInTblId      = splitVehicle[1];
        if(transporter_Type == 'SELF' || transporter_Type == 'SISTER_CONCERN'){
          $('#qunatity'+i).prop('readonly',true).css('background-color','#eee');
        }else{
          $('#qunatity'+i).prop('readonly',false).css('background-color','#fff');
        }

        $.ajax({

            url:"{{ url('get-data-for-loading-slip-n-plan-from-inward') }}",
            method : "POST",
            type: "JSON",
            data: {transporter_Type: transporter_Type,vehicleNo:vehicleNo,gateInTblId:gateInTblId},
            beforeSend: function() {
              console.log('start spinner');
              $('.modalspinner').removeClass('hideloaderOnModl');
            },
            success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                console.log('sl',sl);

                $("#cpList"+sl).empty();
                $.each(data1.datacpCodeList, function(k, getData){

                  $("#cpList"+sl).append($('<option>',{

                    value:getData.CP_CODE,

                    'data-xyz':getData.CP_NAME,
                    'text':getData.CP_NAME

                  }));

                });

              }/* /. success condition*/

            },/*/. success function*/
            complete: function() {
              console.log('end spinner');
              $('.modalspinner').addClass('hideloaderOnModl');
            },

        }); /* /. ajax*/

    i++;sl++;});

  /* ----------- ADD MORE FUNCTIONALITY ----------- */
  
  $(document).ready(function() {

    $( window ).on( "load", function() {

      var fromdateintrans = $('#FromDateFy').val();
      var todateintrans = $('#ToDateFy').val();

      $('.transdatepicker').datepicker({

        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        startDate :fromdateintrans,
        endDate : 'today',
        autoclose: 'true'
      });

    });

    $('#rakeNo').on('input',function(){

      fieldValidation();

    });

  });/* /. */

  function transporterTypeFun(){

    var transport_Type = $("input[type='radio'][name='trans_type']:checked").val();
      $('#getTransportType').val(transport_Type);

      /*if(transport_Type =='MARKET' || transport_Type=='EX_YARD'){
        $('#rakeNo').prop('readonly',false);
        $('#cp_code1').prop('readonly',true);
      }else if(transport_Type =='SELF' || transport_Type=='SISTER_CONCERN'){
        $('#rakeNo').prop('readonly',true);
        $('#cp_code1').prop('readonly',false);
      }*/

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

        url:"{{ url('get-trip-no-details-against-vehicle') }}",
        method : "POST",
        type: "JSON",
        data: {transport_Type: transport_Type},
        beforeSend: function() {
          console.log('start spinner');
          $('.modalspinner').removeClass('hideloaderOnModl');
        },
        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
            $("#vehicle_no,#tblGateId,#trip_no,#gateEntryVrno,#driver_name,#driver_id,#driver_mobNo,#plant_code,#plant_name,#pfct_code,#pfct_name").val('');
              $("#vehicleList").empty();

          }else if(data1.response == 'success'){

            if(data1.data_vehicle_list == ''){
              $("#vehicleList").empty();
              $("#vehicle_no,#tblGateId,#trip_no,#gateEntryVrno,#driver_name,#driver_id,#driver_mobNo,#plant_code,#plant_name,#pfct_code,#pfct_name").val('');
            }else{
              $("#vehicle_no,#tblGateId,#trip_no,#gateEntryVrno,#driver_name,#driver_id,#driver_mobNo,#plant_code,#plant_name,#pfct_code,#pfct_name").val('');
              $("#vehicleList").empty();

              $.each(data1.data_vehicle_list, function(k, getItem){

                $("#vehicleList").append($('<option>',{

                  value:getItem.VEHICLE_NUMBER+'~'+getItem.CFGATEID,
                  'data-xyz':getItem.VEHICLE_NUMBER+'~'+getItem.CFGATEID,
                  text:getItem.VEHICLE_NUMBER

                }));

              });

            }

          }/* /. success condition*/

        },/*/. success function*/
        complete: function() {
          console.log('end spinner');
          $('.modalspinner').addClass('hideloaderOnModl');
        },

      });

  }


  function getDataItem(slno,fieldType){

      var transporter_Type = $("input[type='radio'][name='trans_type']:checked").val();
      var cp_code          = $('#cp_code'+slno).val();

      var xyz = $('#cpList'+slno+' option').filter(function() {
        return this.value == cp_code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#cp_code'+slno).val('');
        $('#cp_name'+slno).val('');
        $('#qunatity'+slno).val('');
        $('#item_code'+slno).val('');
        $('#item_name'+slno).val('');
        $('#itemList1'+slno).empty();
      }else{
        $('#cp_name'+slno).val(msg);
        $('#item_code'+slno).val('');
        $('#item_name'+slno).val('');
        $('#qunatity'+slno).val('');
        $('#itemList1'+slno).empty();
      }

      $('#fieldReqMsg').html("");
      $('#transaction_date,#series_code,#vehicle_no').prop('readonly',true);
      $("input[name=trans_type]").prop("disabled",true);
      $('#transaction_date').datepicker("destroy");
      $('#submitdata,#submitdatapdf').prop('disabled',false);
      var cpcode = $('#cp_code'+slno).val();
     
      var vehicle_Num    = $("#vehicle_no").val();
      var splitVehicle   = vehicle_Num.split('~');
      var vehicleNo     = splitVehicle[0];
      var gateInTblId = $("#tblGateId").val();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

          url:"{{ url('get-data-for-loading-slip-n-plan-from-inward') }}",
          method : "POST",
          type: "JSON",
          data: {transporter_Type: transporter_Type,cpcode:cpcode,vehicleNo:vehicleNo,gateInTblId:gateInTblId},
          beforeSend: function() {
            console.log('start spinner');
            $('.modalspinner').removeClass('hideloaderOnModl');
          },
          success:function(data){

            var data1 = JSON.parse(data);
            console.log('data1.response',data1.response);

            if (data1.response == 'error') {

              $('#stockNotAvailMsg').html("Stock Not Available For "+cpcode+" - "+msg+" Please Do Inward ....!");
              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

                if(data1.dataItemList == ''){
                  $("#itemList"+slno).empty();
                  $('#stockNotAvailMsg').html("Stock Not Available For "+cpcode+" - "+msg+" Please Do Inward ....!");
                }else{
                  
                  $("#itemList"+slno).empty();
                  $.each(data1.dataItemList, function(k, getData){

                    $("#itemList"+slno).append($('<option>',{

                      value:getData.ITEM_CODE,
                      'data-xyz':getData.ITEM_NAME,
                      'text':getData.ITEM_NAME

                    }));

                  });

                }

                if(transporter_Type == 'SELF' || transporter_Type == 'SISTER_CONCERN'){

                  if(data1.datacpQty == ''){
                    $('#qunatity'+slno).val('');
                  }else{
                    $('#qunatity'+slno).val(data1.datacpQty[0].QTY);
                  }

                }else{
                  $('#qunatity'+slno).val('');
                }

                if(data1.dataTRPT == ''){
                  $('#trpt_code'+slno).val('');
                  $('#trpt_name'+slno).val('');
                }else{
                  $('#trpt_code'+slno).val(data1.dataTRPT[0].TRPT_CODE);
                  $('#trpt_name'+slno).val(data1.dataTRPT[0].TRPT_NAME);
                  
                  if(slno == 1){
                    $('#trptCode').val(data1.dataTRPT[0].TRPT_CODE);
                    $('#trptName').val(data1.dataTRPT[0].TRPT_NAME);
                  }
                }
                
                 totalvalCalculation();

            }/* /. success condition*/

          },/*/. success function*/
          complete: function() {
            console.log('end spinner');
            $('.modalspinner').addClass('hideloaderOnModl');
          },

      });



  }

    /* ---------- check duplicate entry --------- */

    function checkDubicateBodyEntry(slNo,cpCode,itemCode){

      if(cpCode && itemCode){

        var checkDublicates = cpCode+'~'+itemCode;
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
              $('#item_code'+slNo).val('');
              $('#item_name'+slNo).val('');
              $('#qunatity'+slNo).val('');
              $('#cp_name'+slNo).val('');
              $('#cp_code'+slNo).val('');
              $('#itemList'+slNo).empty();

            }else if(checkDub == false){
              $('#showDubDataMsg').html('');
              var getPrevVal = $("#dublicateName").val();
              $("#dublicateName").val(getPrevVal+','+checkDublicates);
              $("#tempItemSave"+slNo).val(checkDublicates);
              validationLrno(slNo);
            }

          }else{

            var blnkAry1 = [];
            var existGet1 = $("#dublicateName").val();
            blnkAry1.push(existGet1);

            var checkDub1 = blnkAry1.includes(checkDublicates);

            if(checkDub1 == true){
              $('#showDubDataMsg').html('Dublicate Details');
              $('#item_code'+slNo).val('');
              $('#item_name'+slNo).val('');
              $('#qunatity'+slNo).val('');
              $('#cp_name'+slNo).val('');
              $('#cp_code'+slNo).val('');
              $('#itemList'+slNo).empty();
            }else if(checkDub1 == false){
              $('#showDubDataMsg').html('');
              var getPrevVal1 = $("#dublicateName").val();
              $("#dublicateName").val(getPrevVal1+','+checkDublicates);    
              $("#tempItemSave"+slNo).val(checkDublicates);
              //validationLrno(slNo);                          
            }

          }
        }

      }else{
          
      }
    }

    function checkcheckbox(slNo){

      var cpcode   = $('#cp_code'+slNo).val();
      var itemCd      = $('#item_code'+slNo).val();

      var dublicateName = cpcode+'~'+itemCd;

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

  /* ------- CHECK DUBLICATE ENTRY -------- */
  

</script>

<script>

  function totalvalCalculation(){

      var totqty = 0;

      $(".qtyRecd").each(function () {
        
          if (!isNaN(this.value) && this.value.length != 0) {
              totqty += parseFloat(this.value);
          }

        $("#total_Qty").val(totqty.toFixed(3));

      });

  }

  function fieldValidation(){

    var seriesCode = $("#series_code").val();
    var rakeNo     = $("#rakeNo").val();
    var vehicleNo  = $("#vehicle_no").val();

    if(seriesCode){
      $("#series_code").css('border-color','#d4d4d4');
      if(rakeNo){
        $("#rakeNo").css('border-color','#d4d4d4'); 
        if(vehicleNo){
          $("#vehicle_no").css('border-color','#d4d4d4'); 
        }else{
          $("#vehicle_no").css('border-color','#ff0000'); 
        }   
      }else{
        $("#rakeNo").css('border-color','#ff0000');
      }
    }else{
      $("#series_code").css('border-color','#ff0000');
    }

    if(seriesCode && rakeNo && vehicleNo){
      $('#cp_code1').prop('readonly',false);
    }else{
      $('#cp_code1').prop('readonly',true);
    }

  }

/* --------------- START : SUBMIT DATA ------------ */

  function submitLoadingSlipTrans(pdfFlag){

      var downloadFlg = pdfFlag;

      $('#pdfYesNoStatus').val(downloadFlg);

      var rowIDget      =[];
      var valuecpcode   =[];
      var valueitemcode =[];

      $(".rowCountCls").each(function () {
        
         rowIDget.push(this.value);

      });

      for(var y=0;y<rowIDget.length;y++){

        var colIdSlno = rowIDget[y];

        var cpcode   = $('#cp_code'+colIdSlno).val();
        var itemcode = $('#item_code'+colIdSlno).val();

        valuecpcode.push(cpcode);
        valueitemcode.push(itemcode);

      }

      var found_cp = valuecpcode.find(function (cp_cd) {
        return cp_cd == '';
      });

      var found_item = valueitemcode.find(function (item_cd) {
        return item_cd == '';
      });

      if(found_cp == ''){
        $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
      }else if(found_item == ''){
        $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
      }else{

        var data = $("#loadingSlipTran").serialize();

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/transaction/CandF/update-loading-and-plan') }}",

            data: data, // here $(this) refers to the ajax object not form
            success: function (data) {
              var data1 = JSON.parse(data);
              if(data1.response == 'error') {

                var responseVar = false;
                var url = "{{url('transaction/candf/loading-plan/save-msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });

              }else{

                var responseVar = true;

                if(downloadFlg == 1){
                  var fyYear    = data1.data[0].FY_CODE;
                  var fyCd      = fyYear.split('-');
                  var seriesCd  = data1.data[0].SERIES_CODE;
                  var vrNo      = data1.data[0].VRNO;
                  var fileN     = 'LP_'+fyCd[0]+''+seriesCd+''+vrNo;
                  var link      = document.createElement('a');
                  link.href     = data1.url;
                  link.download = fileN+'.pdf';
                  link.dispatchEvent(new MouseEvent('click'));
                }

                var url = "{{url('transaction/candf/loading-plan/save-msg')}}";
                setTimeout(function(){ window.location = url+'/'+responseVar; });
                
              }/* /. condition*/

            },/* /. success function*/

        }); /* /. ajax*/

      }

  }/* /. main function */

/* --------------- END : SUBMIT DATA ------------ */

</script>

@endsection