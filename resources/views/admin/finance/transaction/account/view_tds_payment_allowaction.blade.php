@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #c2d9ff;
  }
  .box-header>.box-tools {
    position: absolute !important;
    right: 10px !important;
    top: 2px !important;
  }
  .required-field::before {
    content: "*";
    color: red;
  }
  .crBal{
    display:none;
  }
  .showAccName{
    border: none;
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
  }
  .defualtSearchNew{
    display: none;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .showSeletedName {
    font-size: 12px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  .rightcontent{
    text-align:right;
  }
  ::placeholder {
    text-align:left;
  }

  @media only screen and (max-width: 600px) {
    .dataTables_filter{
      margin-left: 35%;
    }
  }
  .dt-buttons{
    margin-bottom: -30px!important;
  }
  .dt-button{
    display: inline-block!important;
    font-weight: 600 !important;
    text-align: center!important;
    white-space: nowrap!important;
    vertical-align: middle!important;
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    user-select: none!important;
    border: 1px solid transparent!important;
    padding: .375rem .75rem!important;
    font-size: 12px!important;
    line-height: 1.5!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
  }
  .dt-button:before {
    content: '\f02f';
    font-family: FontAwesome;
    padding-right: 5px;
  }
  .buttons-excel{
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
  }
  .buttons-excel:before {
    content: '\f1c9';
    font-family: FontAwesome;
    padding-right: 5px;
  }
  .vrDateDataTbl{
    width: 7%;
    text-align: left;
  }
  .vrVrNoDataTbl{
    width: 9%;
    text-align: left;
  }
  .refDataTbl{
    width: 19%;
    text-align: left;
  }
  .drAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .crAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .balAmtDataTbl{
    width: 15%;
    text-align: left;
  }
  .balTypeDataTbl{
    width: 5%;
    text-align: left;
  }
  .pfctDataTbl{
    width: 15%;
    text-align: left;
  }
  .btn-sm {
    padding: 4px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
  }

  .content-header h1 {
    margin-top: 2%;
  }
  .content-header .breadcrumb {
    margin-top: 2%;
  }
  .box-header {
    color: #444;
    display: block;
    padding: 3px;
    position: relative;
  }
  table.dataTable {
    clear: both;
    margin-top: 0px !important;
    margin-bottom: 6px !important;
    max-width: none !important;
  }
  .content {
    min-height: 250px;
    padding: 9px;
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
  }
  .firstBlock{

    border: 1px solid lightgrey;
    padding-bottom: 8px;
    padding-top: 12px;
    box-shadow: 0px 0px 4px 0px rgb(0 0 0 / 38%);
    margin-left:15px;

  }

  .SecondBlock{
    border: 1px solid lightgrey;
    padding: 20px;
    padding-bottom: 8px;
    padding-top: 12px;
    box-shadow: 0px 0px 4px 0px rgb(0 0 0 / 38%);
    margin-left:15px;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Tds Payment Allocation
      <small> C/B Transaction Report Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report</a></li>

      <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">Tds Payment Allocation</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Tds Payment Allocation</h2>

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

        <form id="myForm">

          @csrf

          <?php date_default_timezone_set('Asia/Kolkata'); ?>

          <div class="row">

            <div class="col-md-6 firstBlock ">

              <div class="col-md-6">

                <div class="form-group">

                  <?php 

                  $CurrentDate =date("d-m-Y");

                  $From_date    = date("d-m-Y", strtotime($fromDate));  

                  $To_date      = date("d-m-Y", strtotime($toDate));  

                  $spliDate    = explode('-', $CurrentDate);

                  $yearGet     = Session::get('macc_year');

                  $fyYear      = explode('-', $yearGet);

                  $get_Month   = $spliDate[1];
                  $get_year    = $spliDate[2];

                  if($get_Month >3 && $get_year == $fyYear[1]){
                    $vrDate = $CurrentDate;
                  }else{
                    $vrDate = $To_date;
                  }

                  ?>

                  <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $From_date }}">
                  <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $To_date }}">
                  <label for="exampleInputEmail1">From Date : </label>

                  <div class="input-group">
                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                    <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="<?php echo $From_date; ?>">

                  </div>
                  <small id="show_err_from_date" style="color: red;"></small>

                </div>

              </div><!-- /.col -->


              <div class="col-md-6">

                <div class="form-group">

                  <label for="exampleInputEmail1">To Date: </label>

                  <div class="input-group">
                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                    <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Enter To  Date" value="<?= date('d-m-Y'); ?>">

                  </div>

                  <small id="show_err_to_date" style="color:red;"></small>

                </div>

              </div><!-- /.col -->


              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tds Code:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                    </div>
                    <input list="tdsList" id="tds_code" name="tds_code" class="form-control pull-left" value="{{ old('tds_code')}}" placeholder="Select Account Code" autocomplete="off">
                    <datalist id="tdsList">
                      <option selected="selected" value="">-- Select --</option>
                      @foreach ($tds_list as $key)

                      <option value="{{ $key->TDS_CODE }}" data-xyz="{{ $key->TDS_CODE }}">{{ $key->TDS_CODE }} [{{ $key->TDS_CODE }}]</option>
                      @endforeach
                    </datalist>
                  </div>
                  <small>
                    <div class="pull-left showSeletedName" id="accountText"></div>
                  </small>
                  <small id="show_err_acct_code"></small>
                </div>
              </div><!-- /.col -->

              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tds Gl:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                    </div>
                    <input list="tdsglList" id="tds_gl" name="tds_gl" class="form-control pull-left" value="" placeholder="Select Account Code" autocomplete="off">
                    <datalist id="tdsglList">
                      <option selected="selected" value="">-- Select --</option>
                    </datalist>
                  </div>
                  <small>
                    <div class="pull-left showSeletedName" id="accountText"></div>
                  </small>
                  <small id="show_err_acct_code"></small>
                </div>
              </div><!-- /.col -->


              <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputEmail1">Pmt Voucher No:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                    </div>
                    <input list="pmtVocherList" id="pmtVoucherNo" name="pmtVoucherNo" class="form-control pull-left" value="{{ old('pmtVoucherNo')}}" placeholder="Select Pmt Voucher No" autocomplete="off">
                    <datalist id="pmtVocherList">

                    </datalist>
                  </div>
                  <small>
                    <div class="pull-left showSeletedName" id="accountText"></div>
                  </small>
                  <small id="show_err_acct_code"></small>
                </div>
              </div><!-- /.col -->

            </div>


<div class="col-md-5 SecondBlock">
  <div class="col-md-3"></div>

  <div class="col-md-6">
    <div class="form-group">
      <label for="exampleInputEmail1">Pmt Amt:</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
        </div>
        <input type="text" id="pmtAmt01" name="pmtAmt" class="form-control pull-left" value="{{ old('pmtAmt')}}" placeholder="Select Pmt Amt" autocomplete="off" readonly>
      </div>
      <small>
        <div class="pull-left showSeletedName" id="accountText"></div>
      </small>
      <small id="show_err_acct_code"></small>
    </div>
             
             <!-- HIDDEN FEILDS -->

       
        <input type="hidden" id="pmtTranId" name="pmtTranIdGetName">
        <input type="hidden" id="pmtTranCode" name="pmtTranCodeName">
        <input type="hidden" id="pmtSeriesCode" name="pmtSeriesCode">
        <input type="hidden" id="pmtVrNo" name="pmtVrNo">
        <input type="hidden" id="pmtSlNo" name="pmtSlNo">
        <input type="hidden" id="pmtVrDate" name="pmtVrDate">
        <input type="hidden" id="pmtParticular" name="pmtParticular">
      
      
     



    <div class="form-group">
      <label for="exampleInputEmail1">Allowcation Amt:</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
        </div>
        <input type="text" list="" id="allowcationAmt" name="allowcationAmt" class="form-control pull-left" value="{{ old('allowcationAmt')}}" placeholder="Select Allowcation Amt" autocomplete="off" readonly>
        <!-- <datalist id="">
          <option selected="selected" value="">-- Select --</option>
          @foreach ($pmtListKey as $key)
            <option value="{{ $key->VRTYPE }}" data-xyz="{{ $key->VRTYPE }}">{{ $key->VRTYPE }} [{{ $key->VRTYPE }}]</option>
          @endforeach
        </datalist> -->
      </div>
      <small>
        <div class="pull-left showSeletedName" id="accountText"></div>
      </small>
      <small id="show_err_acct_code"></small>
    </div>

    <div class="form-group">
      <label for="exampleInputEmail1">Balance Amt:</label>
      <div class="input-group">
        <div class="input-group-addon">
          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
        </div>
        <input type="text"  id="BalanceAmt" name="BalanceAmt" class="form-control pull-left" value="{{ old('BalanceAmt')}}" placeholder="Select Balance Amt" autocomplete="off" readonly>
      </div>
      <small>
        <div class="pull-left showSeletedName" id="accountText"></div>
      </small>
      <small id="show_err_acct_code"></small>
    </div>
  </div>

  <div class="col-md-3"></div>
</div>

<small id='errMssg' style="color:red;font-size:12px;position: relative; left: 656px;
    top: 5px;"></small>

</div>


<div class="col center">



  <div class="form-group">

    <button type="button" class="btn btn-primary" name="searchdata" disabled id="btnsearch" value="btnsearch" style="padding: 2px;font-size: 12px; position: relative; top: 10px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>&nbsp;&nbsp;

    <button type="button" class="btn btn-warning" name="searchdata" id="ResetId" style="padding: 2px;font-size: 12px; position: relative;top: 10px; ">&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i>&nbsp;&nbsp;Reset&nbsp;&nbsp;</button>





  </div>

</div>




</div><!-- /.box-body -->


</div><!-- /. Custom-Box-->





<section class="content">

  <div class="box box-primary Custom-Box">



    <div class="box-body" style="margin-top: -2%;">


      <div class="form-group">

        <button type="button" id="btnpdf" class="btn btn-danger btn-sm" style="position: relative;top: 38px; right: 285px;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Pdf </button>


      </div>





      <table id="ViewTDS" class="table table-bordered table-striped table-hover">



        <thead class="theadC">

          <tr>

            <th class="text-center" width="5%" style="text-align: left;"><input class='check_all checkstyling'  type='checkbox' id="all_checkbox"/></th>
            <th class="text-center">VR NO</th>
            <th class="text-center">VR DATE</th>
            <th class="text-center">GL CODE</th>
            <th class="text-center">GL NAME</th>
            <th class="text-center">ACC CODE</th>
            <th class="text-center">ACC NAME</th>
            <th class="text-center">PARTICULAR</th>
            <th class="text-center">TDS AMT</th>
            <th class="text-center">TDS CODE</th>
            <th class="text-center">TDS RATE</th>


          </tr>

        </thead>


        <tbody id="defualtSearch">

        </tbody>


      </table>

       <div class="col center">


      <div class="form-group">

        <button type="button" class="btn btn-success" name="savedata" onclick="submitAllData(0)" disabled id="savedata" value="savedata" style="padding: 2px;font-size: 12px; position: relative; top: 10px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Proceed&nbsp;&nbsp;</button>&nbsp;&nbsp;


      </div>

    </div>



    </div><!-- /.box-body -->

   
  </div><!-- /. Custom-Box-->

</section><!-- /. section-->


</form>



</section><!-- /. section-->

</div>

@include('admin.include.footer')

<script type="text/javascript">

  $(document).ready(function() {


    $('#tds_code').on('change', function() {

      var selectCodeTds = $(this).val(); 
      console.log('selectCodeTds',selectCodeTds);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url: "{{ url('get-data-tdsCode') }}",
        method: "GET",
        type: "JSON",
        data: { selectCodeTds: selectCodeTds},

        success: function(data) {

          var data1 = JSON.parse(data);



          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>" + data.message + "</p>");

          } else if (data1.response == 'success'){

            if(data1.dataItemList == ''){

            }else{

              $("#tdsglList").empty();

              $.each(data1.dataItemList, function(k, getBatchNo){

                $("#tdsglList").append($('<option>',{

                  value:getBatchNo.GL_CODE,

                  'data-xyz':getBatchNo.GL_NAME

                }));

              });

            }
          }

        }

      });

    });

  })


</script>


<script type="text/javascript">


  $(document).ready(function() {

    $('#tds_gl').on('change', function() {

      var getGlPayment = $(this).val(); 

      console.log('getGlPayment',getGlPayment);

      var from_date = $('#from_date').val();
      var to_date   = $('#to_date').val();
//var tds_code  = $('#tds_code').val(); 
// var gl_code   = $('#tds_gl').val();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

        url: "{{ url('/Transaction/Account/Indirect-direct/tds-payment/get-data-TdsGlCode') }}",
        method: "POST",
        type: "JSON",
        data: {from_date:from_date,to_date:to_date,getGlPayment:getGlPayment},
        success: function(data) {

          var data1 = JSON.parse(data);

          console.log('data1 => ',data1);


          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>" + data.message + "</p>");

          } else if (data1.response == 'success'){


            if(data1.dataItemList == ''){


            }else{

              $("#pmtVocherList").empty();
              $.each(data1.dataItemList, function(k, getData){

                var fY_CODE = getData.FY_CODE; 

                var explodedFY_CODE = fY_CODE.split('-');

// console.log(explodedFY_CODE);


                var newVourNo = explodedFY_CODE[0]+'/'+getData.SERIES_CODE+'/'+getData.VRNO;

                $("#pmtVocherList").append($('<option>',{

                  value:newVourNo,
                  'data-xyz':newVourNo,
                  text:newVourNo

                }));

              });

            }
          }



        }


      })



    })



  });




</script>


<script type="text/javascript">

  $('#pmtVoucherNo').on('change', function() {

    var getPaymentVocherNo = $(this).val(); 

    console.log('getPaymentVocherNo',getPaymentVocherNo);

    var from_date = $('#from_date').val();
    var to_date   = $('#to_date').val();
    var gl_code   = $('#tds_gl').val();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    $.ajax({

      url: "{{ url('/Transaction/Account/Indirect-direct/tds-payment/get-data-pmtVocherNo') }}",
      method: "POST",
      type: "JSON",
      data: {from_date:from_date,to_date:to_date,getPaymentVocherNo:getPaymentVocherNo,gl_code:gl_code},
      success: function(data) {

        var data1 = JSON.parse(data);

        console.log('data1 => ',data1);


        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>" + data.message + "</p>");

        } else if (data1.response == 'success'){

            //console.log('dr',data1.dataItemList[0].DR_AMT);
            //console.log('cr',data1.dataItemList[0].CR_AMT);

          if(data1.cb_data_list == ''){


          }else{

            if(data1.cb_data_list[0].DRAMT  == '0.00' || data1.cb_data_list[0].DRAMT  == 'NULL' || data1.cb_data_list[0].DRAMT  == null){
              $('#pmtAmt01').val('');
            }else{
              $('#pmtAmt01').val(data1.cb_data_list[0].DRAMT);
            }


            if(data1.cb_data_list[0].CBTRANID  == '0.00' || data1.cb_data_list[0].CBTRANID  == 'NULL' || data1.cb_data_list[0].CBTRANID  == null){
              $('#pmtTranId').val('');
            }else{
              $('#pmtTranId').val(data1.cb_data_list[0].CBTRANID);
            }

              if(data1.cb_data_list[0].TRAN_CODE  == '0.00' || data1.cb_data_list[0].TRAN_CODE  == 'NULL' || data1.cb_data_list[0].TRAN_CODE  == null){
              $('#pmtTranCode').val('');
            }else{
              $('#pmtTranCode').val(data1.cb_data_list[0].TRAN_CODE);
            }

             if(data1.cb_data_list[0].SERIES_CODE  == '0.00' || data1.cb_data_list[0].SERIES_CODE  == 'NULL' || data1.cb_data_list[0].SERIES_CODE  == null){
              $('#pmtSeriesCode').val('');
            }else{
              $('#pmtSeriesCode').val(data1.cb_data_list[0].SERIES_CODE);
            }

             if(data1.cb_data_list[0].VRNO  == '0.00' || data1.cb_data_list[0].VRNO  == 'NULL' || data1.cb_data_list[0].VRNO  == null){
              $('#pmtVrNo').val('');
            }else{
              $('#pmtVrNo').val(data1.cb_data_list[0].VRNO);
            }

            if(data1.cb_data_list[0].SLNO  == '0.00' || data1.cb_data_list[0].SLNO  == 'NULL' || data1.cb_data_list[0].SLNO  == null){
              $('#pmtSlNo').val('');
            }else{
              $('#pmtSlNo').val(data1.cb_data_list[0].SLNO);
            }

             if(data1.cb_data_list[0].VRDATE  == '0.00' || data1.cb_data_list[0].VRDATE  == 'NULL' || data1.cb_data_list[0].VRDATE  == null){
              $('#pmtVrDate').val('');
            }else{
              $('#pmtVrDate').val(data1.cb_data_list[0].VRDATE);

            }    

            if(data1.cb_data_list[0].PARTICULAR  == '0.00' || data1.cb_data_list[0].PARTICULAR  == 'NULL' || data1.cb_data_list[0].PARTICULAR  == null){
              $('#pmtParticular').val('');
            }else{
              $('#pmtParticular').val(data1.cb_data_list[0].PARTICULAR);
            }



          }
        }

      }

    })


    if($(this).val() != '') {
      $('#btnsearch').prop('disabled', false);
    } else {
      $('#btnsearch').prop('disabled', true);
    }



  })
</script>


<script type="text/javascript">

  function submitAllData(valD){

        var checkboxcount = $('input[type="checkbox"]:checked').length;

       
        
        if(checkboxcount > 0){

          var checkitm          = [];
          var checkattr         = [];
   

          $('.pb_checkitm').each(function(){

              if($(this).is(":checked")){
                
               var itmchk  = $(this).val();
               var attrchk = $(this).attr('data-type');
               checkitm.push(itmchk);
               checkattr.push(attrchk);
              }
          });

          var dataCount = checkitm.length;

            var pmtTranIdGetName   = $('#pmtTranId').val(); 
            var pmtTranCodeGetName = $('#pmtTranCode').val(); 
            var pmtSeriesCode      = $('#pmtSeriesCode').val(); 
            var pmtVrNo            = $('#pmtVrNo').val(); 
            var pmtSlNo            = $('#pmtSlNo').val(); 
            var pmtVrDate          = $('#pmtVrDate').val(); 
            var pmtParticular      = $('#pmtParticular').val(); 
       
           // var pmtSeriesCodeGetName = $('#pmtSeriesCode').val(); 
          
          // console.log('pmtTranCodeGetName',pmtTranCodeGetName);
          // console.log('pmtSeriesCode',pmtSeriesCode);
          // console.log('pmtVrNo',pmtVrNo);
          // console.log('pmtSlNo',pmtSlNo);
          // console.log('pmtVrDate',pmtVrDate);
          // console.log('pmtParticular',pmtParticular);
         
          console.log('checkBox Value', checkitm);

              var data = $("#myForm").serialize();

              console.log('data',data);


          $.ajax({

            url: "{{ url('/Transaction/Account/Indirect-direct/tds-payment/get-data-proceedGetDataUpdate') }}",

             method: "POST",
             
             type: "JSON",

            data: { checkitm: checkitm, pmtTranIdGetName:pmtTranIdGetName,pmtTranCodeGetName:pmtTranCodeGetName,pmtSeriesCode:pmtSeriesCode,pmtVrNo:pmtVrNo,pmtSlNo:pmtSlNo,pmtVrDate:pmtVrDate,pmtParticular:pmtParticular,dataCount:dataCount},

             success: function (data) {
              
              var data1 = JSON.parse(data);
              if(data1.response == 'error') {
                var responseVar = false;
                var url = "{{url('/transaction/account/InDirect-Direct-Tax/Tds-payment-allowcation')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }else{
                var responseVar = true;  
                
                var url = "{{url('/transaction/account/InDirect-Direct-Tax/Tds-payment-allowcation')}}";
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }

          },

          });


        }

    }



</script>


<script type="text/javascript">

  $(document).ready(function(){


    $('#btnsearch').click(function(){


      var tds_code            =  $('#tds_code').val();

      var gl_code             =  $('#gl_tds').val();

      var from_date            =  $('#from_date').val();

      var to_date              =  $('#to_date').val();

      var PaymentVocher         =  $('#pmtVoucher').val();

     //console.log('PaymentVocher',PaymentVocher);

      var PaymentAmount         =  $('#pmtAmt01').val();

      console.log('PaymentAmount',PaymentAmount);

      // var BalanceamtAmount         =  $('#BalanceAmt').val();

      // console.log('BalanceamtAmount',BalanceamtAmount);


      if (tds_code!='' || from_date!='' || to_date!='' || gl_code!='' || PaymentVocher!=''){


        $('#ViewTDS').DataTable().destroy();
        load_data(tds_code,from_date,to_date,gl_code,PaymentVocher);

      }else{
        $('#ViewTDS').DataTable().destroy();
        load_data();
      }


    });

// load_data();

    function load_data(tds_code = '', from_date = '', to_date = '', gl_tds='',PaymentVocher='') {
      $('#ViewTDS').DataTable({

        columnDefs: [
        {
          orderable: false,
          targets: 0, 
          checkboxes: {
            selectRow: true
          }
        }
        ],

        processing: true,
        serverSide: true,
        scrollX: true,
        pageLength: '25',
        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" + "<'row'<'col-sm-4'l><'col-sm-8'p>>",
        buttons: [
          'excelHtml5'
          ],
        ajax: {
          url: '{{ url("/get-data-view-tds-payment-allowcation") }}',
          data: {tds_code:tds_code,from_date:from_date,to_date:to_date,gl_tds:gl_tds,PaymentVocher:PaymentVocher}
        },


        columns: [

        {
           data:'DT_RowIndex',
          render: function (data, type, full, meta){

            var tds_amt = '';

            console.log('id',full['TDSTRANID']);

            if (full['TDS_AMT'] =='' || full['TDS_AMT'] =='0.00' || full['TDS_AMT'] =='NULL' || full['TDS_AMT']==null) {

              tds_amt = '<input type="checkbox" disabled name="" class="pb_checkitm checkstyling" />';

            }else{

              tds_amt = '<input type="checkbox"  name="" class="pb_checkitm checkstyling" value="'+full['DT_RowIndex']+'~'+full['TDSTRANID']+'~'+full['VRNO']+'~'+full['VRDATE']+'~'+full['GL_CODE']+'~'+full['GL_NAME']+'~'+full['ACC_CODE']+'~'+full['ACC_NAME']+'~'+full['PARTICULAR']+'~'+full['TDS_CODE']+'~'+full['TDS_AMT']+'~'+full['TDS_RATE']+'" />';

            }

            return tds_amt;


          }
        },
        { data: 'VRNO' },
        { data: 'VRDATE' },
        { data: 'GL_CODE' },
        { data: 'GL_NAME' },
        { data: 'ACC_CODE' },
        { data: 'ACC_NAME' },
        { data: 'PARTICULAR'},
        { data: 'TDS_AMT'},
        { data: 'TDS_CODE' },
        { data: 'TDS_RATE' },

        ],

      });

    }

    $(document).ready(function() {
      var checkedRows = [];

      $('#ViewTDS').on('click', 'input[type="checkbox"]', function() {
      
      
        var rowData = $(this).closest('tr').find('td');
       
        var valueDisplay = parseFloat($(rowData[8]).text()); 

        var index = checkedRows.indexOf(valueDisplay); 

        var sum = 0;


        if ($(this).is(':checked')) {

          checkedRows.push(valueDisplay);

        } else {

          if (index !== -1) {
            checkedRows.splice(index, 1);
          }
        }

         var PaymentAmount      =  $('#pmtAmt01').val();

        if(sum > PaymentAmount){

        }else{
          checkedRows.forEach(function(value) {
            sum += value;
          });
        }

        $('#allowcationAmt').val(sum);
 
        var AllowcationAmount  =  $('#allowcationAmt').val();

        var BalanceAmtAmount = PaymentAmount - AllowcationAmount;

        $('#BalanceAmt').val(BalanceAmtAmount);

        if (BalanceAmtAmount == 0) {
          $('#savedata').prop('disabled',false);
          $('#errMssg').html('');
        } else if (AllowcationAmount > PaymentAmount) {
         
          $('#errMssg').html('*Allowcation amt can not be greater than payment amount.');
          $('#savedata').prop('disabled',true);
        } else if (AllowcationAmount == PaymentAmount) {
          
          $('#errMssg').html('');
          $('#savedata').prop('disabled',false);
        } else {
          $('#errMssg').html('');
          $('#savedata').prop('disabled',true);
         
        }

      });
    });



  });

</script>


<script type="text/javascript">

  $(document).ready(function() {
    var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      endDate : 'today',
      autoclose: 'true'
    });

    $('.datepicker1').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date,
      autoclose: 'true'

    });

  });
</script>



@endsection