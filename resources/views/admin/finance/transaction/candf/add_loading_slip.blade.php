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
      Create Loading Slip
      <small>Add Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>
      <li class="active"><a href="{{ url('/transaction/candf/view-loading-slip') }}">Create Loading Slip</a></li>
      <li class="active"><a href="{{ url('/transaction/candf/view-loading-slip') }}">Add Loading Slip</a></li>

    </ol>

  </section><!-- /.section -->

<form id="loadingSlipTran">
  @csrf

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Create Loading Slip</h2>

              <div class="box-tools pull-right showinmobile">
                <a href="{{ url('/transaction/candf/view-loading-slip') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Create Loading Slip</a>
              </div>

              <div class="box-tools pull-right">
                <a href="{{ url('/transaction/candf/view-loading-slip') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Create Loading Plan</a>
              </div>

            </div><!-- /.box-header -->

          <div class="box-body">

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input list="vehicleList" id="vehicle_no" name="vehicle_no" class="form-control  pull-left" value="{{ old('vehicle_no')}}" placeholder="Enter Vehicle No" onchange="getDeatilOfLoadingPlan();" autocomplete="off">

                    <datalist id="vehicleList">
                      
                      <?php foreach ($vehicleNo_list as $key) { ?>
                        
                      <option value="<?= $key->VEHICLE_NO ?>" data-xyz="<?= $key->VEHICLE_NO ?>"><?= $key->VEHICLE_NO ?></option>

                      <?php   } ?>

                    </datalist>

                  </div>

                  <input type="hidden" id="plant_code" name="plant_code">
                  <input type="hidden" id="plant_name" name="plant_name">
                  <input type="hidden" id="pfct_code" name="pfct_code">
                  <input type="hidden" id="pfct_name" name="pfct_name">
                  <input type="hidden" id="driver_name" name="driver_name">
                  <input type="hidden" id="driver_id" name="driver_id">
                  <input type="hidden" id="driver_mobielNo" name="driver_mobielNo">
                  <input type="hidden" id="trpt_type" name="trpt_type">
                  <input type="hidden" id="trpt_no" name="trpt_no">
                  <input type="hidden" id="cfoutTRPTCode" name="cfTrptCode">
                  <input type="hidden" id="cfoutTRPTName" name="cfTrptName">
                  <input type="hidden" id="generateLrNo" value="1">

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Date : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>

                    <input type="text" name="transaction_date" id="transaction_date" class="form-control transdatepicker" placeholder="Enter Date" value="" readonly>

                  </div>

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

                      <input type="text" class="form-control" name="trans_code" value="{{$tranlist->TRAN_CODE }}" placeholder="Enter Trans Code" maxlength="15" id="trans_code" readonly >

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('trans_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div>

              </div><!-- col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Series Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input list="seriesList" class="form-control" name="series_code" value="" id="series_code" placeholder="Enter Series Code" autocomplete="off" onchange="getvrnoBySeries();" readonly>

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

              <div class="col-md-2">

                <div class="form-group">

                  <label> Vr No : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="vrseqnum" value="" id="vrseqnum" placeholder="Enter Vr No" readonly autocomplete="off">

                    </div>

                </div><!-- /.form-group -->
                
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

            <div class="modalspinner hideloaderOnModl"></div>

            <div class="table-responsive">

              <input type="hidden" id="totalExistRow">

              <table class="table tdthtablebordr" border="1" cellspacing="0" id="bodytbledata">


              </table>

            </div><!-- /.table respnsive -->

            <div class="row">

              <div class="col-md-12" style="display: flex;">
                <div style="width:71%">
                  
                  <button type="button" class='btn btn-danger delete' id="deletehidn" ><i class="fa fa-minus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Delete</button>

                  <button type="button" class='btn btn-info addmore' id="addmorhidn" ><i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Add More</button>
                  <small id="showDubDataMsg" style="color: red;"></small>
                  <input type="hidden" name="dublicateName1[]" id="dublicateName" value="">
                  <input type="hidden" name="deletedubName1[]" id="deletedubName" value="">

                </div>
                <div style="width:8%">
                  <input class="debitcreditbox inputboxclr numerRight" style="background-color: #eeeeee;" type="text" name="totalaQty" id="total_AQty" readonly>
                </div>
                <div style="width:7%">&nbsp;</div>
                <div style="width:8%">
                  <input class="debitcreditbox inputboxclr numerRight" style="background-color: #eeeeee;" type="text" name="totalQty" id="total_Qty" readonly>
                </div>
               
              </div>

            </div>

            <div class="row" style="text-align:center;margin-bottom: 5px;font-weight: 700;">
              <small id="fieldReqMsg" style="color:red;"></small>
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

  function getDeatilOfLoadingPlan(){

    var vehicleNo= $('#vehicle_no').val();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        url:"{{ url('get-details-in-loading-slip-against-vehicle') }}",
        method : "POST",
        type: "JSON",
        data: {vehicleNo: vehicleNo},
        beforeSend: function() {
          console.log('start spinner');
          $('.modalspinner').removeClass('hideloaderOnModl');
        },
        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

            if(data1.dataDetails == ''){

            }else{

              $('#submitdata,#submitdatapdf').prop('disabled',false);

              $('#plant_code').val(data1.dataDetails[0].PLANT_CODE);
              $('#plant_name').val(data1.dataDetails[0].PLANT_NAME);
              $('#pfct_code').val(data1.dataDetails[0].PFCT_CODE);
              $('#pfct_name').val(data1.dataDetails[0].PFCT_NAME);
              $('#driver_name').val(data1.dataDetails[0].DRIVER_NAME);
              $('#driver_id').val(data1.dataDetails[0].DRIVER_ID);
              $('#driver_mobielNo').val(data1.dataDetails[0].MOBILE_NUMBER);
              $('#trpt_type').val(data1.dataDetails[0].TRPT_TYPE);
              $('#trpt_no').val(data1.dataDetails[0].TRIP_NO);
              $('#cfoutTRPTCode').val(data1.dataDetails[0].TRPT_CODE);
              $('#cfoutTRPTName').val(data1.dataDetails[0].TRPT_NAME);

              var vrDate = data1.dataDetails[0].VRDATE;
              var splitDate = vrDate.split('-');
              var transDate = splitDate[2]+'-'+splitDate[1]+'-'+splitDate[0];
              $('#transaction_date').val(transDate);
              $('#series_code').val(data1.dataDetails[0].SERIES_CODE);
              $('#series_name').val(data1.dataDetails[0].SERIES_NAME);
              $('#vrseqnum').val(data1.dataDetails[0].VRNO);

              $('#bodytbledata').empty();

              var headData = "<tr><th><input class='check_all'  type='checkbox' onclick='select_all()'/></th><th style='width: 10px;'> Sr.No.</th><th>CP CODE</th><th>CP NAME</th><th>ITEM CODE</th><th>ITEM NAME</th><th>BATCH NO</th><th>SALE ORDER NO</th><th>WAGON NO</th><th>LOCATION CODE</th><th>LOCATION NAME</th><th>AQUANTITY</th><th>AUM</th><th>QUANTITY</th><th>UM</th></tr>";

              $('#bodytbledata').append(headData);

              /* ------- body data --------- */

                $('#totalExistRow').val(data1.dataDetails.length);
                var slNo = 1;
                $.each(data1.dataDetails, function(k, getData){

                  if(slNo == 1){
                    var spanCode = "<span id='snum'>"+slNo+".</span>";
                  }else{
                    var spanCode = "<span id='snum"+slNo+"'>"+slNo+".</span>";
                  }

                  var bodyData = "<tr><td class='tdthtablebordr'><input type='checkbox' class='case' id='firstrow"+slNo+"' onclick='checkcheckbox("+slNo+");'/><input type='hidden' id='tempItemSave"+slNo+"' value=''></td>"+
                  "<td>"+spanCode+"<input type='hidden' class='rowCountCls' name='rowCount[]' id='rowCount"+slNo+"' value='"+slNo+"'></td>"+
                  "<td class='tdthtablebordr'><input type='text' value='"+getData.CP_CODE+"' name='cp_code[]' readonly class='inputboxclr readonlyField' id='cp_code"+slNo+"' autocomplete='off'/><input type='hidden' class='cpCddata' value='"+getData.CP_CODE+"~"+getData.RAKE_NO+"' id='lrGenInfo"+slNo+"'><input type='hidden' value='1' name='uniqLrNo[]' id='uniqLrNo"+slNo+"'></td>"+
                  "<td class='tdthtablebordr'><input type='text' value='"+getData.CP_NAME+"' name='cp_name[]' readonly class='inputboxclr readonlyField' id='cp_name"+slNo+"' autocomplete='off'/></td>"+
                  "<td class='tdthtablebordr'><input type='text' value='"+getData.ITEM_CODE+"' name='item_code[]' readonly class='inputboxclr readonlyField' id='item_code"+slNo+"' autocomplete='off'/></td>"+
                  "<td class='tdthtablebordr'><input type='text' value='"+getData.ITEM_NAME+"' name='item_name[]' readonly class='inputboxclr readonlyField' id='item_name"+slNo+"' autocomplete='off'/></td>"+
                  "<td class='tdthtablebordr'><input list='batchList"+slNo+"' value='' name='batch_no[]' onchange='getInwardDetails("+slNo+",\""+'BATCH'+"\")' class='inputboxclr' id='batch_no"+slNo+"' autocomplete='off'/><datalist id='batchList"+slNo+"'></datalist><input type='hidden' id='batchSlno"+slNo+"' name='batchSlno[]'><input type='hidden' id='tblHeadId"+slNo+"' name='tblHeadId[]'></td>"+
                  "<td class='tdthtablebordr'><input list='orderNoList"+slNo+"'' value='' name='sale_order_no[]' onchange='getInwardDetails("+slNo+",\""+'ORDERNO'+"\")' class='inputboxclr' id='sale_order_no"+slNo+"' autocomplete='off'/><datalist id='orderNoList"+slNo+"'></datalist></td>"+
                  "<td class='tdthtablebordr'><input type='text' value='' name='wagon_no[]'  class='inputboxclr readonlyField' readonly id='wagon_no"+slNo+"' autocomplete='off'/></td>"+
                  "<td class='tdthtablebordr'><input type='text' value='' name='locatn_code[]'  class='inputboxclr readonlyField' readonly id='locatn_code"+slNo+"' autocomplete='off'/></td>"+
                  "<td class='tdthtablebordr'><input type='text' value='' name='locatn_name[]'  class='inputboxclr readonlyField' readonly id='locatn_name"+slNo+"' autocomplete='off'/></td>"+
                  "<td class='tdthtablebordr'><input type='text' value='' name='aquantity[]' oninput='totalvalCalculation("+slNo+",\""+'A'+"\")'  class='inputboxclr numerRight aqtyval' id='aquantity"+slNo+"' autocomplete='off'/></td>"+
                  "<td class='tdthtablebordr'><input type='text' value='' name='aum[]'  class='inputboxclr readonlyField' readonly id='aum"+slNo+"' autocomplete='off'/></td>"+
                  "<td class='tdthtablebordr'><input type='text' value='' name='quantity[]' oninput='totalvalCalculation("+slNo+",\""+'Q'+"\")' class='inputboxclr numerRight qtyVal' id='quantity"+slNo+"' autocomplete='off'/><input type='hidden' name='cFactor' id='cFactor"+slNo+"'></td>"+
                  "<td class='tdthtablebordr'><input type='text' value='' name='um[]'  class='inputboxclr readonlyField' readonly id='um"+slNo+"' autocomplete='off'/><input type='hidden' name='doTRPTCode[]' id='doTRPTCode"+slNo+"'><input type='hidden' name='doTRPTName[]' id='doTRPTName"+slNo+"'></td></tr>";

                  $('#bodytbledata').append(bodyData);

                  validationLrno(slNo);

                slNo++;});

                var sr=1;
                $.each(data1.dataBatchList, function(k, getData){

                  $.each(getData, function(k, getBatch){

                    $("#batchList"+sr).append($('<option>',{

                      value:getBatch.BATCH_NO+'~'+getBatch.SLNO+'~'+getBatch.CFINWARDID,
                      'data-xyz':getBatch.BATCH_NO+'~'+getBatch.SLNO+'~'+getBatch.CFINWARDID,
                      text:getBatch.BATCH_NO+'-'+getBatch.ITEM_NAME+'-'+getBatch.LOADBALQTY+'-'+getBatch.UM+'-'+getBatch.WAGON_NO+'-'+getBatch.INVOICE_NO

                    }));

                  });
                sr++;});

                

              /* ------- body data --------- */
            }

          }/* /. success condition*/

        },/*/. success function*/
        complete: function() {
          console.log('end spinner');
          $('.modalspinner').addClass('hideloaderOnModl');
        },

    }); /* /. ajax*/
  } /* /. main function*/

   /* --------- START ADD MORE FUNCTIONALITY --------- */

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

  var i=1;
  $(".addmore").on('click',function(){

    count=$('table tr').length;

    var existRow = $('#totalExistRow').val();
    if(existRow){
      var ii= parseInt(existRow) + parseInt(i);
    }else{
      var ii= i;
    }

    var data = "<tr><td class='tdthtablebordr'><input type='checkbox' class='case' id='firstrow"+count+"' onclick='checkcheckbox("+ii+");'/><input type='hidden' id='tempItemSave"+ii+"' value=''></td>"+
      "<td><span id='snum"+ii+"'>"+count+".</span><input type='hidden' class='rowCountCls' name='rowCount[]' id='rowCount"+ii+"' value='"+ii+"'></td>"+
      "<td class='tdthtablebordr'><input list='cpList"+ii+"' value='' name='cp_code[]' class='inputboxclr' id='cp_code"+ii+"' onchange='getInwardDetails("+ii+",\""+'CP'+"\")' autocomplete='off'/><datalist id='cpList"+ii+"'></datalist><input type='hidden' value='1' name='uniqLrNo[]' id='uniqLrNo"+ii+"'><input type='hidden' class='cpCddata' value='' id='lrGenInfo"+ii+"'></td>"+
      "<td class='tdthtablebordr'><input type='text' value='' name='cp_name[]' readonly class='inputboxclr readonlyField' id='cp_name"+ii+"' autocomplete='off'/></td>"+
      "<td class='tdthtablebordr'><input list='itemList"+ii+"' value='' name='item_code[]' class='inputboxclr' id='item_code"+ii+"' onchange='getInwardDetails("+ii+",\""+'ITEM'+"\")' autocomplete='off'/><datalist id='itemList"+ii+"'></datalist></td>"+
      "<td class='tdthtablebordr'><input type='text' value='' name='item_name[]' readonly class='inputboxclr readonlyField' id='item_name"+ii+"' autocomplete='off'/></td>"+
      "<td class='tdthtablebordr'><input list='batchList"+ii+"' value='' name='batch_no[]' onchange='getInwardDetails("+ii+",\""+'BATCH'+"\")' class='inputboxclr' id='batch_no"+ii+"' autocomplete='off'/><datalist id='batchList"+ii+"'></datalist><input type='hidden' id='batchSlno"+ii+"' name='batchSlno[]'><input type='hidden' id='tblHeadId"+ii+"' name='tblHeadId[]'></td>"+
      "<td class='tdthtablebordr'><input list='orderNoList"+ii+"'' value='' name='sale_order_no[]' onchange='getInwardDetails("+ii+",\""+'ORDERNO'+"\")' class='inputboxclr' id='sale_order_no"+ii+"' autocomplete='off'/><datalist id='orderNoList"+ii+"'></datalist></td>"+
      "<td class='tdthtablebordr'><input type='text' value='' name='wagon_no[]'  class='inputboxclr readonlyField' readonly id='wagon_no"+ii+"' autocomplete='off'/></td>"+
      "<td class='tdthtablebordr'><input type='text' value='' name='locatn_code[]'  class='inputboxclr readonlyField' readonly id='locatn_code"+ii+"' autocomplete='off'/></td>"+
      "<td class='tdthtablebordr'><input type='text' value='' name='locatn_name[]'  class='inputboxclr readonlyField' readonly id='locatn_name"+ii+"' autocomplete='off'/></td>"+
      "<td class='tdthtablebordr'><input type='text' value='' name='aquantity[]' oninput='totalvalCalculation("+ii+",\""+'A'+"\")' class='inputboxclr numerRight aqtyval' id='aquantity"+ii+"' autocomplete='off'/></td>"+
      "<td class='tdthtablebordr'><input type='text' value='' name='aum[]'  class='inputboxclr readonlyField' readonly id='aum"+ii+"' autocomplete='off'/></td>"+
      "<td class='tdthtablebordr'><input type='text' value='' name='quantity[]'   class='inputboxclr numerRight qtyVal' id='quantity"+ii+"' autocomplete='off' oninput='totalvalCalculation("+ii+",\""+'Q'+"\")'/><input type='hidden' name='cFactor' id='cFactor"+ii+"'></td>"+
      "<td class='tdthtablebordr'><input type='text' value='' name='um[]'  class='inputboxclr readonlyField' readonly id='um"+ii+"' autocomplete='off'/><input type='hidden' name='doTRPTCode[]' id='doTRPTCode"+ii+"'><input type='hidden' name='doTRPTName[]' id='doTRPTName"+count+"'></td></tr>";

      $('table').append(data);

      /*  ---- AJAX --------- */

        var vehicleNo= $('#vehicle_no').val();

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({

            url:"{{ url('get-details-in-loading-slip-against-vehicle') }}",
            method : "POST",
            type: "JSON",
            data: {vehicleNo: vehicleNo},
            beforeSend: function() {
              console.log('start spinner');
              $('.modalspinner').removeClass('hideloaderOnModl');
            },
            success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                if(data1.dataDetails == ''){

                }else{  

                  $("#cpList"+ii).empty();

                  $.each(data1.dataDetails, function(k, getBatch){

                    $("#cpList"+ii).append($('<option>',{

                      value:getBatch.CP_CODE,
                      'data-xyz':getBatch.CP_NAME,
                      text:getBatch.CP_NAME

                    }));

                  });

                }
              } /* /. SUCCESS CODN*/

            }, /* SUCCESS FUNCTION*/
            complete: function() {
              console.log('end spinner');
              $('.modalspinner').addClass('hideloaderOnModl');
            },
        });

      /*  ---- AJAX --------- */

    i++;});

/* --------- END ADD MORE FUNCTIONALITY --------- */


  function getInwardDetails(rowNo,fieldType){

      if(fieldType == 'CP'){

        var cp_Code = $('#cp_code'+rowNo).val();

        var xyz = $('#cpList'+rowNo+' option').filter(function() {
          return this.value == cp_Code;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $('#cp_code'+rowNo).val('');
          $('#cp_name'+rowNo).val('');
        }else{
          $('#cp_name'+rowNo).val(msg);
        }

        //validationLrno(rowNo);
        
        $('#itemList'+rowNo+',#orderNoList'+rowNo+',#batchList'+rowNo+'').empty();

        $('#item_code'+rowNo+',#item_name'+rowNo+',#batch_no'+rowNo+',#tblHeadId'+rowNo+',#sale_order_no'+rowNo+',#wagon_no'+rowNo+',#locatn_code'+rowNo+',#locatn_name'+rowNo+',#aquantity'+rowNo+',#aum'+rowNo+',#quantity'+rowNo+',#um'+rowNo+',#cFactor'+rowNo+'').val('');
      }

      if(fieldType == 'ITEM'){

        var item_Code = $('#item_code'+rowNo).val();

        var xyz = $('#itemList'+rowNo+' option').filter(function() {
          return this.value == item_Code;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $('#item_code'+rowNo).val('');
          $('#item_name'+rowNo).val('');
        }else{
          $('#item_name'+rowNo).val(msg);
        }

        $('#batchList'+rowNo+',#orderNoList'+rowNo+'').empty();
        
        $('#batch_no'+rowNo+',#tblHeadId'+rowNo+',#sale_order_no'+rowNo+',#wagon_no'+rowNo+',#locatn_code'+rowNo+',#locatn_name'+rowNo+',#aquantity'+rowNo+',#aum'+rowNo+',#quantity'+rowNo+',#um'+rowNo+',#cFactor'+rowNo+'').val('');
      }

      if(fieldType == 'BATCH'){

        var Batch_no = $('#batch_no'+rowNo).val();

        var xyz = $('#batchList'+rowNo+' option').filter(function() {
          return this.value == Batch_no;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $('#batch_no'+rowNo).val('');
          $('#tblHeadId'+rowNo).val('');
        }else{
        }

        $('#orderNoList'+rowNo).empty();
        $('#sale_order_no'+rowNo+',#wagon_no'+rowNo+',#locatn_code'+rowNo+',#locatn_name'+rowNo+',#aquantity'+rowNo+',#aum'+rowNo+',#quantity'+rowNo+',#um'+rowNo+',#cFactor'+rowNo+'').val('');
      }

      if(fieldType == 'ORDERNO'){

        var order_no = $('#sale_order_no'+rowNo).val();

        var xyz = $('#orderNoList'+rowNo+' option').filter(function() {
          return this.value == order_no;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $('#sale_order_no'+rowNo).val('');
        }else{
        }

        $('#wagon_no'+rowNo+',#locatn_code'+rowNo+',#locatn_name'+rowNo+',#aquantity'+rowNo+',#aum'+rowNo+',#quantity'+rowNo+',#um'+rowNo+',#cFactor'+rowNo+'').val('');
      }

      var temItem = $('#tempItemSave'+rowNo).val();
      var getSelData = $('#dublicateName').val(); 
      var slptData = getSelData.split(',');
      var indexDt = slptData.indexOf(temItem);
      if (indexDt > -1) { // only splice array when item is found
        slptData.splice(indexDt, 1); // 2nd parameter means remove one item only
      }
      $('#dublicateName').val('');
      $('#dublicateName').val(slptData);

      var vehicle_no  = $('#vehicle_no').val();
      var itemCode    = $('#item_code'+rowNo).val();
      var orderNo     = $('#sale_order_no'+rowNo).val();
      var cpCode      = $('#cp_code'+rowNo).val();
      var gtbatchNo   = $('#batch_no'+rowNo).val();
      var slitBatchNo = gtbatchNo.split('~');
      var batchNo     = slitBatchNo[0];
      var batchslnoNo = slitBatchNo[1];
      var tblHeadId = slitBatchNo[2];
      $('#tblHeadId'+rowNo).val(tblHeadId);

      $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
      });

      $.ajax({

        url:"{{ url('get-inward-details-against-item-in-loading-slip') }}",

        method : "POST",

        type: "JSON",

        data: {vehicle_no:vehicle_no,cpCode:cpCode,batchNo: batchNo,batchslnoNo:batchslnoNo,itemCode:itemCode,orderNo:orderNo,fieldType:fieldType,tblHeadId:tblHeadId},
        beforeSend: function() {
          console.log('start spinner');
          $('.modalspinner').removeClass('hideloaderOnModl');
        },  
        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

              $('#fieldReqMsg').html("");

              if(data1.dataDetails == ''){

              }else{

                if(cpCode && fieldType=='ITEM'){

                  $("#batchList"+rowNo).empty();

                  $.each(data1.dataDetails, function(k, getBatch){

                    var LOADBALQTY = parseFloat(getBatch.QTYRECD) - parseFloat(getBatch.LOADSLIP_QTY);

                    $("#batchList"+rowNo).append($('<option>',{

                      value:getBatch.BATCH_NO+'~'+getBatch.SLNO+'~'+getBatch.CFINWARDID,
                      'data-xyz':getBatch.BATCH_NO+'~'+getBatch.SLNO+'~'+getBatch.CFINWARDID,
                      text:getBatch.BATCH_NO+'-'+getBatch.ITEM_NAME+'-'+LOADBALQTY+'-'+getBatch.WAGON_NO+'-'+getBatch.INVOICE_NO

                    }));

                  });

                }

                if(batchNo && fieldType=='BATCH'){

                  $("#orderNoList"+rowNo).empty();

                  $.each(data1.dataDetails, function(k, getBatchNo){

                    $("#orderNoList"+rowNo).append($('<option>',{

                      value:getBatchNo.ORDER_NO,

                      'data-xyz':getBatchNo.ORDER_NO,
                      text:getBatchNo.ORDER_NO+'-'+getBatchNo.CP_NAME+'-'+getBatchNo.TO_PLACE

                    }));

                  });

                }

                if(batchNo && orderNo && fieldType=='ORDERNO'){

                  var inwardQTY = parseFloat(data1.dataDetails[0].QTYRECD);

                  var loadQty = parseFloat(data1.dataDetails[0].QTYISSUED);

                  var loadBalQty = inwardQTY - loadQty;

                  var loadBalAqty = parseFloat(loadBalQty) / parseFloat(data1.dataDetails[0].CFACTOR);

                  $('#wagon_no'+rowNo).val(data1.dataDetails[0].WAGON_NO);
                  $('#locatn_code'+rowNo).val(data1.dataDetails[0].LOCATION_CODE);
                  $('#locatn_name'+rowNo).val(data1.dataDetails[0].LOCATION_NAME);
                  $('#aquantity'+rowNo).val(loadBalAqty.toFixed(3));
                  $('#aum'+rowNo).val(data1.dataDetails[0].AUM);
                  $('#quantity'+rowNo).val(loadBalQty.toFixed(3));
                  $('#um'+rowNo).val(data1.dataDetails[0].UM);
                  $('#cFactor'+rowNo).val(data1.dataDetails[0].CFACTOR);
                  //$('#doTRPTCode'+rowNo).val(data1.dataDetails[0].DO_TRPT_CODE);
                  //$('#doTRPTName'+rowNo).val(data1.dataDetails[0].DO_TRPTNAME);
                  $('#lrGenInfo'+rowNo).val(data1.dataDetails[0].CP_CODE+'~'+data1.dataDetails[0].RAKE_NO);
                  validationLrno(rowNo);
                  checkDubicateBodyEntry(rowNo,orderNo,batchNo,batchslnoNo,itemCode,tblHeadId);

                }

              } /* /. CODN */

             // console.log('data1.dataItemList',data1.dataItemList);
              if(data1.dataItemList == ''){

              }else{

                $("#itemList"+rowNo).empty();

                  $.each(data1.dataItemList, function(k, getItem){

                    $("#itemList"+rowNo).append($('<option>',{

                      value:getItem.ITEM_CODE,

                      'data-xyz':getItem.ITEM_NAME,
                      text:getItem.ITEM_NAME

                    }));

                  });

              }

          }/* /. SUCCESS CODN*/


          totalvalCalculation(rowNo,'Q');

        }, /* /. SUCCESS FUNCTION*/
        complete: function() {
          console.log('end spinner');
          $('.modalspinner').addClass('hideloaderOnModl');
        },      
      }); /* /. AJAX FUNCTION*/

  } /* /. FUNCTION*/

/* ---------- check duplicate entry --------- */

    function checkDubicateBodyEntry(slNo,dOrderNo,batch_no,batchslnoNo,itemCode,inTblHeadId){

      var totalExistRowB = $('#totalExistRow').val();
     // console.log('totalExistRowB',totalExistRowB);

      if(dOrderNo && batch_no && itemCode && inTblHeadId){

        var checkDublicates = batch_no+'~'+batchslnoNo+'~'+inTblHeadId+'~'+itemCode+'~'+dOrderNo;
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
              $('.modalspinner').addClass('hideloaderOnModl');
              if(slNo > totalExistRowB){

                $('#cp_code'+slNo+',#cp_name'+slNo+',#item_code'+slNo+',#item_name'+slNo+',#batch_no'+slNo+',#tblHeadId'+slNo+',#sale_order_no'+slNo+',#wagon_no'+slNo+',#locatn_code'+slNo+',#locatn_name'+slNo+',#aquantity'+slNo+',#aum'+slNo+',#quantity'+slNo+',#um'+slNo+',#batchSlno'+slNo+'').val('');
              
              $('#orderNoList'+slNo).empty();
              $('#batchList'+slNo).empty();
              $('#itemList'+slNo).empty();

              }else{

                $('#batch_no'+slNo+',#tblHeadId'+slNo+',#sale_order_no'+slNo+',#wagon_no'+slNo+',#locatn_code'+slNo+',#locatn_name'+slNo+',#aquantity'+slNo+',#aum'+slNo+',#quantity'+slNo+',#um'+slNo+',#batchSlno'+slNo+'').val('');
              
                $('#orderNoList'+slNo).empty();

              }

              totalvalCalculation(slNo,'Q');
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
              $('.modalspinner').addClass('hideloaderOnModl');
              if(slNo > totalExistRowB){

                $('#cp_code'+slNo+',#cp_name'+slNo+',#item_code'+slNo+',#item_name'+slNo+',#batch_no'+slNo+',#tblHeadId'+slNo+',#sale_order_no'+slNo+',#wagon_no'+slNo+',#locatn_code'+slNo+',#locatn_name'+slNo+',#aquantity'+slNo+',#aum'+slNo+',#quantity'+slNo+',#um'+slNo+',#batchSlno'+slNo+'').val('');
              
              $('#orderNoList'+slNo).empty();
              $('#batchList'+slNo).empty();
              $('#itemList'+slNo).empty();

              }else{

                $('#batch_no'+slNo+',#tblHeadId'+slNo+',#sale_order_no'+slNo+',#wagon_no'+slNo+',#locatn_code'+slNo+',#locatn_name'+slNo+',#aquantity'+slNo+',#aum'+slNo+',#quantity'+slNo+',#um'+slNo+',#batchSlno'+slNo+'').val('');
              
                $('#orderNoList'+slNo).empty();

              }
             // totalvalCalculation();
            }else if(checkDub1 == false){
              $('#showDubDataMsg').html('');
              var getPrevVal1 = $("#dublicateName").val();
              $("#dublicateName").val(getPrevVal1+','+checkDublicates);    
              $("#tempItemSave"+slNo).val(checkDublicates);
              validationLrno(slNo);                          
            }

          }
        }

      }else{
          
      }
    }

    function checkcheckbox(slNo){

      var gtbatchNo   = $('#batch_no'+slNo).val();
      var splitBatch  = gtbatchNo.split('~');
      var batchNo     = splitBatch[0];
      var batchslnoNo = splitBatch[1];
      var tblHeadId   = splitBatch[2];
      var itemCd      = $('#item_code'+slNo).val();
      var orderNo     = $('#sale_order_no'+slNo).val();

       var dublicateName = batchNo+'~'+batchslnoNo+'~'+tblHeadId+'~'+itemCd+'~'+orderNo;


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

    function validationLrno(slNo){

      if(slNo > 1){

        var cpCdAry = [];
    
        $(".cpCddata").each(function () {

          cpCdAry.push(this.value);
          
        });

        var rowWiseCPCode = $('#lrGenInfo'+slNo).val();
        
        cpCdAry.splice(-1);
        //console.log(cpCdAry,'cpCdAry');
        var isInArray = cpCdAry.includes(rowWiseCPCode);
        
        var postionOfVal = cpCdAry.indexOf(rowWiseCPCode);

        if(postionOfVal == '-1'){
         // console.log('not Same');
          var getexistVal = $('#generateLrNo').val();
          var lrNoGenerate = parseInt(getexistVal) + parseInt(1);
        //  console.log('getexistVal',getexistVal);
         // console.log('lrNoGenerate',lrNoGenerate);
          $('#generateLrNo').val(lrNoGenerate);
          $('#uniqLrNo'+slNo).val(lrNoGenerate);
        }else{
          var existLr =  parseInt(postionOfVal) + parseInt(1);

          var getExistlrNo = $('#uniqLrNo'+existLr).val();
          $('#uniqLrNo'+slNo).val(getExistlrNo);
        }

      }

    }

/* ------- CHECK DUBLICATE ENTRY -------- */

  function totalvalCalculation(num,qfeild){


      var mqty = $("#quantity"+num).val();
      var maqty = $("#aquantity"+num).val();
      var mcFactor = $("#cFactor"+num).val();

      if(qfeild=='Q'){

           maqty = parseFloat(mqty) / parseFloat(mcFactor);
            $("#aquantity"+num).val(maqty.toFixed(3));
      }else{

          mqty = parseFloat(maqty) * parseFloat(mcFactor);
          $("#quantity"+num).val(mqty.toFixed(3));
      }

     
      var totqty = 0;

      $(".qtyVal").each(function () {
        
          if (!isNaN(this.value) && this.value.length != 0) {
              totqty += parseFloat(this.value);
          }

        $("#total_Qty").val(totqty.toFixed(3));

      });

      var totAqty = 0;

      $(".aqtyval").each(function () {
        
          if (!isNaN(this.value) && this.value.length != 0) {
              totAqty += parseFloat(this.value);
          }

        $("#total_AQty").val(totAqty.toFixed(3));

      });

  }

/* --------------- START : SUBMIT DATA ------------ */

  function submitLoadingSlipTrans(pdfFlag){
    var downloadFlg = pdfFlag;

    $('#pdfYesNoStatus').val(downloadFlg);

    var trcount=$('table tr').length;
    var valueOrderNo=[];
    var valueBatchNo=[];
    var valueItemCode=[];
    var rowIDget=[];
    var valueQuantity=[];

    $(".rowCountCls").each(function () {
        
         rowIDget.push(this.value);

    });
  
    for(var y=0;y<rowIDget.length;y++){

      var colIdSlno = rowIDget[y];
      
      var orderNo = $('#sale_order_no'+colIdSlno).val();
      var batchNo = $('#batch_no'+colIdSlno).val();
      var itemCode = $('#item_code'+colIdSlno).val();
      var quantity = $('#quantity'+colIdSlno).val();

      valueOrderNo.push(orderNo);
      valueBatchNo.push(batchNo);
      valueItemCode.push(itemCode);
      valueQuantity.push(quantity);
    }

    var found_order = valueOrderNo.find(function (order_No) {
      return order_No == '';
    });

    var found_batch = valueBatchNo.find(function (batch_No) {
      return batch_No == '';
    });

    var found_item = valueItemCode.find(function (item_cd) {
      return item_cd == '';
    });

    var found_qty = valueQuantity.find(function (qty) {
      return qty == '';
    });


    if(found_order == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_batch == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_item == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_qty == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else{

      var data = $("#loadingSlipTran").serialize();

      var transDate      = $('#transaction_date').val();
      var series_code    = $('#series_code').val();
      var vehicle_no     = $('#vehicle_no').val();

      if(transDate && series_code && vehicle_no){

        $('#fieldReqMsg').html('');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/transaction/CandF/loading-slip-submit') }}",

            data: data, // here $(this) refers to the ajax object not form
            success: function (data) {
              var data1 = JSON.parse(data);
              if(data1.response == 'error') {

                var responseVar = false;
                var url = "{{url('candf/loading-slip/save-msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });

              }else{

                var responseVar = true;

                if(downloadFlg == 1){
                  var fyYear    = data1.data[0].FY_CODE;
                  var fyCd      = fyYear.split('-');
                  var seriesCd  = data1.data[0].SERIES_CODE;
                  var vrNo      = data1.data[0].VRNO;
                  var fileN     = 'LS_'+fyCd[0]+''+seriesCd+''+vrNo;
                  var link      = document.createElement('a');
                  link.href     = data1.url;
                  link.download = fileN+'.pdf';
                  link.dispatchEvent(new MouseEvent('click'));
                }

                var url = "{{url('candf/loading-slip/save-msg')}}";
                setTimeout(function(){ window.location = url+'/'+responseVar; });
                
              }/* /. condition*/

            },/* /. success function*/

        }); /* /. ajax*/

      }else{
        
        $('#fieldReqMsg').html("All Fields Is Required....!");
      }

    }/* /. */

  }/* /. main function */

/* --------------- END : SUBMIT DATA ------------ */

</script>
@endsection
