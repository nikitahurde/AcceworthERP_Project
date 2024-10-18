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
  .widthClassdt{
    width: 7%;
  }
  .widthvrno{
    width: 7%;
  }
  .particuwidth{
    width: 37%;
  }
  .drCrAmtWith{
    width: 10%;
    text-align: right;
  }
  .refWidth{
    width: 14%;
  }
  .balTypeWidth{
    width: 5%;
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
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

     Interest Ledger Report
      <small> C/B Transaction Report Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report</a></li>

      <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">List Interest Ledger Report</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Interest Ledger Report</h2>

      </div><!-- /.box-header -->

      <div class="box-body">

        <form id="myForm">

          @csrf

          <?php date_default_timezone_set('Asia/Kolkata'); ?>

          <div class="row">

    

            <div class="col-md-2">

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
                <label for="exampleInputEmail1">From Date : <span class="required-field"></span></label>

                <div class="input-group">
                  <div class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                  </div>
                   <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="<?php echo $From_date; ?>">

                </div>
                <small id="show_err_from_date" style="color: red;"></small>
                  
              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                  <label for="exampleInputEmail1">To Date: <span class="required-field"></span></label>

                  <div class="input-group">
                        <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                        <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Enter To  Date" value="<?= date('d-m-Y'); ?>">

                  </div>

                  <small id="show_err_to_date" style="color:red;"></small>

              </div>

            </div><!-- /.col -->


            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Account Code" autocomplete="off">

                    <datalist id="accountList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($acc_list as $key)

                      <option value='<?php echo $key->ACC_CODE ?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo" [".$key->ACC_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="accountText"></div>
                  </small>

                  <small id="show_err_acct_code">

                  </small>

              </div>

            </div><!-- /.col -->

             <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Account Name : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input text="text" id="acct_name" name="acct_name" class="form-control  pull-left" value="{{ old('acct_name')}}" placeholder="Select Account Name" autocomplete="off">

                  </div>

              </div>

            </div>

            <div class="col-md-2">
                   
              <div class="form-group">

                <label for="exampleInputEmail1">Year days : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input list="input"  id="year_days" name="year_days" class="form-control  pull-left" value="365" placeholder="Select Year days" autocomplete="off">

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="seriesText"></div>
                  </small>
                       
              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">GP Days : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input type="text" id="gp_days" name="gp_days" class="form-control  pull-left" value="{{ old('gp_days')}}" placeholder="Enter GP Days" autocomplete="off">

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="gl_name"></div>
                  </small>

                  <small id="show_err_trans">

                  </small>
                  <span id='searcherr' style="color: red;"></span>
              </div>

            </div><!-- /.col -->

           

            

          </div><!-- /.row -->

          <div class="row">

             <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Intrest Rate: <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input type="text" id="intrest_rate" name="intrest_rate" class="form-control  pull-left rightcontent" value="{{ old('trans_code')}}" placeholder="Intrest Rate" autocomplete="off">

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="transText"></div>
                  </small>

                  <small id="show_err_trans">

                  </small>
                  <span id='searcherr' style="color: red;"></span>
              </div>

            </div><!-- /.col -->


            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">GP Days Op Bal: <span class="required-field"></span></label>
                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input type="text" id="op_bal_gp_days" name="op_bal_gp_days" class="form-control  pull-left rightcontent" value="{{ old('op_bal_gp_days')}}" placeholder="GP Days Op Bal" autocomplete="off">

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="transText"></div>
                  </small>

                  <small id="show_err_trans">

                  </small>
                  <span id='searcherr' style="color: red;"></span>
              </div>

            </div>

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Is Vr Date 1 day for DR: <span class="required-field"></span></label>
                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input list="vrdateDrList" id="vr_date_dr" name="vr_date_dr" class="form-control  pull-left rightcontent" value="NO" placeholder="Is Vr Date 1 day for DR" autocomplete="off">

                     <datalist id="vrdateDrList">
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </datalist>

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="transText"></div>
                  </small>

                  <small id="show_err_trans">

                  </small>
                  <span id='searcherr' style="color: red;"></span>
              </div>

            </div>

             <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Is Vr Date 1 day for CR: <span class="required-field"></span></label>
                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input list="vrdateCrList" id="vr_date_cr" name="vr_date_cr" class="form-control  pull-left rightcontent" value="NO"  placeholder="Is Vr Date 1 day for CR" autocomplete="off">

                    <datalist id="vrdateCrList">
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </datalist>

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="transText"></div>
                  </small>

                  <small id="show_err_trans">

                  </small>
                  <span id='searcherr' style="color: red;"></span>
              </div>

            </div>

             <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Negative Interest: <span class="required-field"></span></label>
                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input list="ngIntrestList" id="neg_interest" name="neg_interest" class="form-control  pull-left rightcontent" value="NO" placeholder="Enter Negative Intrest" autocomplete="off">

                    <datalist id="ngIntrestList">
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </datalist>

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="transText"></div>
                  </small>

                  <small id="show_err_trans">

                  </small>
                  <span id='searcherr' style="color: red;"></span>
              </div>

            </div>

             <div class="col-md-3">

              <div class="form-group">

                <label for="exampleInputEmail1">To Which Amt Grace Period Applied Dr/Cr: </label>
                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input type="text" id="amt_grace_prd" name="amt_grace_prd" class="form-control  pull-left rightcontent" value="{{ old('amt_grace_prd')}}" placeholder="Enter Grace Period Amt" autocomplete="off">

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="transText"></div>
                  </small>

                  <small id="show_err_trans">

                  </small>
                  <span id='searcherr' style="color: red;"></span>
              </div>

            </div>
            
          </div>

          <div class="row" style="text-align:center;">

            <!-- <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Vr Type : </label>

                <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-bars" aria-hidden="true"></i>

                    </div>

                      <select name="vr_type" id="vr_type" class="form-control">
                        <option value="">--Select--</option>
                        <option value="Payment">Payment</option>
                        <option value="Receipt">Receipt</option>
                      </select>

                </div>

              </div>

            </div> --><!-- /.col -->

            <div style="text-align: center;"><small id="show_err_code" style="color: red;"></small></div>

            <div class="col-md-12" style="">
              
              <button type="button" class="btn btn-primary btn-xs" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 5px;font-size: 12px;" onclick="return validation();"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

              <button type="button" class="btn btn-default btn-xs" name="searchdata" id="ResetId" style="padding: 5px;font-size: 12px;"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

            </div>

            

          </div>
      
        </form>

      </div><!-- /.box-body -->

      <div class="box-body" style="margin-top: -2%;">

        <button type="button" id="btnpdf" class="btn btn-danger btn-sm" style="margin-left: 60px !important;margin-bottom: -29px !important;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Pdf </button>

        <table id="InwardDispatch" class="table table-bordered table-striped table-hover table-responsive">

          <thead class="theadC">

            <tr>
              <th class="text-center">Vr Date</th>
              <th class="text-center">Vr No </th>
              <th class="text-center"><lable>Particular</lable></th>
              <th class="text-center"style="text-align: center;"><lable>Debit</lable> </th>
              <th class="text-center" style="text-align: center;"><lable>Credit</lable> </th>
              <th class="text-center"><lable>Intrest Amt Dr </lable></th>
              <th class="text-center"><lable>Intrest Amt Cr </lable></th>
              <th class="text-center"><lable>Days</lable></th>
            </tr>

          </thead>

          <tbody id="defualtSearch">

          </tbody>

          <tfoot align="right">
            <tr>
              <th></th><th></th><th></th><th></th><th></th><th class="bTotal"></th><th class="bCrTotal"></th><th></th>
            </tr>
          </tfoot>
  
        </table>

      </div><!-- /.box-body -->

    </div><!-- /. Custom-Box-->

  </section><!-- /. section-->

</div>

@include('admin.include.footer')

 <script type="text/javascript">

    $(document).ready(function(){

        $("#acct_code").bind('change', function () {  

          var acc_code = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == acc_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
          if(msg == 'No Match'){
            $('#acct_name').val('');
            $(this).val('');
            
          }else{
            $('#acct_name').val(msg);

               $.ajaxSetup({

                   headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                  }
             });


            $.ajax({

              url:"{{ url('get-intrest-rate-by-acc-code') }}",

              method : "GET",

              type: "JSON",

              data: {acc_code: acc_code},

              success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  if(data1.data == ''){

                  }else{
                    $('#intrest_rate').val(data1.data[0].INTREST_RATE);
                    $('#gp_days').val(data1.data[0].GP_DAYS);
                    $('#op_bal_gp_days').val(data1.data[0].GP_DAYS);
                  
                  }

                }
              }

          });

          }

        });

        $("#series_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#seriesList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
          if(msg == 'No Match'){
            $('#seriesText').html('');
            $(this).val('');
          }else{
            $('#seriesText').html(msg);
          }

          var seriesCode = $('#series_code').val();
          var transcode = 'A0';

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

                  if(data1.data == ''){

                  }else{
                    $('#gl_code').val(data1.data[0].GL_CODE);
                    $('#gl_name').html(data1.data[0].GL_NAME);
                  }

                }
              }

          });

        });

    });

</script>

<script type="text/javascript">

  $(document).ready(function(){

    load_data();


        function load_data(acct_code='',year_days='',gp_days='',intrest_rate='',op_bal_gp_days='',vr_date_dr='',vr_date_cr='',neg_interest='',amt_grace_prd='',from_date='',to_date=''){

          

          $('#InwardDispatch').DataTable({



            footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                var rowcount = data.length;
                var getRow = rowcount-1;
                var opebal = api.column(2).data();

                var baltype = api.column(3).data();
               if(opebal[getRow]){
                 var opntotl = opebal[getRow];
               }else{
                 var opntotl = 0;
               }

               if(baltype[getRow]){
                 var bal_type = baltype[getRow];
               }else{
                 var bal_type = '--';
               }

                var tueTotal = api
                  .column(3)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                  var twoTotal = api
                  .column(4)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                var intrDrTotal = api
                  .column(5)
                  .data()
                  .reduce( function (a, b) {


                      return intVal(a) + intVal(b);
                }, 0 );

                    console.log('intrDrTotal',intrDrTotal);

                    $( api.column( 2).footer() ).html('Total :-').css('text-align','right');
                    $( api.column( 3 ).footer() ).html(tueTotal.toFixed(2));
                    $( api.column( 4 ).footer() ).html(twoTotal.toFixed(2));
                    //$( api.column( 5 ).footer() ).html(intrestvaluetotl);
                   
                    //$( api.column( 6 ).footer() ).html('<span class="label label-danger">'+bal_type+'</span>');
                    
                  },
              processing: true,
              serverSide: true,
             // scrollX: true,
              pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
              
              buttons: [
                        {
                            "extend": 'excel',
                            "text": 'Excel',  
                            "titleAttr": 'Excel',
                            "action": newexportaction
                        },
                    ],
             
              ajax:{
                url:'{{ url("/report-intrest-ledger") }}',
                data: {acct_code:acct_code,year_days:year_days,gp_days:gp_days,intrest_rate:intrest_rate,op_bal_gp_days:op_bal_gp_days,vr_date_dr:vr_date_dr,vr_date_cr:vr_date_cr,neg_interest:neg_interest,amt_grace_prd:amt_grace_prd,from_date:from_date,to_date:to_date}
              },
              columns: [

                {

                    data:'VRDATE',
                    className:'vrDateDataTbl',
                    render: function (data) {
                        var date = new Date(data);
                        var month = date.getMonth() + 1;
                        if(data=='0000-00-00'){
                          return '00-00-0000';
                        }else{
                          
                        return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                        }
                    }
                },

                {  
                  render: function (data, type, full, meta){
                    var fyCd = full['FY_CODE'];
                    var vrNo = full['VRNO'];
                    if(vrNo){
                      var fysiclYR = fyCd;
                      var fsYear = fysiclYR.split('-');
                      var VRNO = full['SERIES_CODE']+'/'+fsYear[0]+'/'+full['VRNO'];
                      var fy_cd = VRNO;
                    }else{
                      var fy_cd='--';
                    }
                    return fy_cd;
                  },
                  className:'widthvrno'
                },

                 {
                    data:'PARTICULAR',
                    render:function(data, type, full, meta){
                      console.log('full',full);
                        if(full['PARTICULAR'] ==null || full['PARTICULAR'] == 'To - NA :' || full['PARTICULAR'] == 'By -' || full['PARTICULAR'] == 'To -'){
                          var prticulr = '----';
                       
                        }else{
                          var prticulr =full['PARTICULAR'];
                        
                        }                  
                        return  prticulr;
                    },
                    className:'particuwidth'
                },
               
                {
                    data:'DRAMT',
                    name:'DRAMT',
                   // render: $.fn.dataTable.render.number(',', '.', 2, ''),
                    className:'drCrAmtWith'
                   
                },
                {
                    data:'CRAMT',
                    name:'CRAMT',
                   // render: $.fn.dataTable.render.number(',', '.', 2, ''),
                    className:'drCrAmtWith'
                },
                { data:'VRDATE',
                className:'drCrAmtWith',

                   render:function(data, type, full, meta){

                      console.log('intrest_rate',intrest_rate);

                      var date = new Date(data);
                        var month = date.getMonth() + 1;

                        if(data=='0000-00-00'){
                          return '00-00-0000';
                        }else{

                        var d = new Date();

                        var month2 = d.getMonth()+1;
                       // var day2 = d.getDate();

                       /*var firstDate  = d.getFullYear() + '/' + (month2<10 ? '0' : '') + month2 + '/' + (day2<10 ? '0' : '') + day2;*/
                        var firstDate  =    (month2.toString().length > 1 ? month2 : "0" + month2) + "-" + d.getDate() + "-" +  d.getFullYear()

                   
                      

                        var secondDate = (month.toString().length > 1 ? month : "0" + month)  + "-" + date.getDate() + "-" +  date.getFullYear();

                      

                            var startDay = new Date(firstDate);  
                            var endDay = new Date(secondDate);  

                        var millisBetween = startDay.getTime() - endDay.getTime(); 

                     

                         var days = millisBetween / (1000 * 3600 * 24);  
                      }

                        
                        if(full['DRAMT']){

                          var drAmt = full['DRAMT'];

                          var rateofIntrest = (drAmt*intrest_rate/100)/365;


                          var finaleIntrest = rateofIntrest * days;

                          var intrest_amt = finaleIntrest.toFixed(2);

                          //intrest_total = parseFloat(intrest_total) + parseFloat(intrest_amt);
                       
                        }else{
                          var intrest_amt ='';
                        
                        }

                          var sd = '<input type="hidden" class="calamt" value='+intrest_amt+'>';
                           var btotal =0;

                          $(".calamt").each(function () {
                             
                            if (!isNaN(this.value) && this.value.length != 0) {
                              btotal += parseFloat(this.value);
                            }

                              console.log('btotal',btotal);

                             $(".bTotal").html(btotal.toFixed(2));

                          });
          
                        return  intrest_amt+sd;
                    },

                },
                { data:'VRDATE',
                  className:'drCrAmtWith',
                   render:function(data, type, full, meta){
                      
                      var date = new Date(data);
                        var month = date.getMonth() + 1;

                        if(data=='0000-00-00'){
                          return '00-00-0000';
                        }else{

                        var d = new Date();

                        var month2 = d.getMonth()+1;
                       // var day2 = d.getDate();

                       /*var firstDate  = d.getFullYear() + '/' + (month2<10 ? '0' : '') + month2 + '/' + (day2<10 ? '0' : '') + day2;*/
                        var firstDate  =    (month2.toString().length > 1 ? month2 : "0" + month2) + "-" + d.getDate() + "-" +  d.getFullYear()

                       

                        var secondDate = (month.toString().length > 1 ? month : "0" + month)  + "-" + date.getDate() + "-" +  date.getFullYear();

                     

                            var startDay = new Date(firstDate);  
                            var endDay = new Date(secondDate);  

                        var millisBetween = startDay.getTime() - endDay.getTime(); 

                       

                         var days = millisBetween / (1000 * 3600 * 24);  
                      }


                        if(full['CRAMT']){

                          var crAmt = full['CRAMT'];

                          var rateofIntrest = (crAmt*intrest_rate/100)/365;


                          var finaleIntrest = rateofIntrest * days;
                          
                          var intrest_amt = finaleIntrest.toFixed(2);
                       
                        }else{
                          var intrest_amt ='0.00';
                        
                        }   

                         var sd = '<input type="hidden" class="calcramt" value='+intrest_amt+'>';
                           var btotal =0;

                          $(".calcramt").each(function () {
                             
                            if (!isNaN(this.value) && this.value.length != 0) {
                              btotal += parseFloat(this.value);
                            }


                             $(".bCrTotal").html(btotal.toFixed(2));

                          });
          
                        return  intrest_amt+sd;

                    },
                },
                {   data:'VRDATE',
                    className:'widthvrno',
                    render: function (data, type, full, meta) {
                       
                        var date = new Date(data);
                        var month = date.getMonth() + 1;

                        if(data=='0000-00-00'){
                          return '00-00-0000';
                        }else{

                        var d = new Date();

                        var month2 = d.getMonth()+1;
                       // var day2 = d.getDate();

                       /*var firstDate  = d.getFullYear() + '/' + (month2<10 ? '0' : '') + month2 + '/' + (day2<10 ? '0' : '') + day2;*/
                        var firstDate  =    (month2.toString().length > 1 ? month2 : "0" + month2) + "-" + d.getDate() + "-" +  d.getFullYear()

                      
                        var secondDate = (month.toString().length > 1 ? month : "0" + month)  + "-" + date.getDate() + "-" +  date.getFullYear();

                         console.log('secondDate',secondDate);

                            var startDay = new Date(firstDate);  
                            var endDay = new Date(secondDate);  

                        var millisBetween = startDay.getTime() - endDay.getTime(); 


                         var days = millisBetween / (1000 * 3600 * 24);  

                        

                      }
                      return Math.round(Math.abs(days)); 
                      //return days;
                    },
                },
               
                     
                
              ]

               


          });

          
       }

       $('#btnsearch').click(function(){

      
          var acct_code       =  $('#acct_code').val();
          var year_days       =  $('#year_days').val();
          var gp_days         =  $('#gp_days').val();
          var intrest_rate    =  $('#intrest_rate').val();
          var op_bal_gp_days  =  $('#op_bal_gp_days').val();
          var vr_date_dr      =  $('#vr_date_dr').val();
          var vr_date_cr      =  $('#vr_date_cr').val();
          var neg_interest    =  $('#neg_interest').val();
          var amt_grace_prd   =  $('#amt_grace_prd').val();
          var from_date       =  $('#from_date').val();
          var to_date         =  $('#to_date').val();

          if (acct_code!='' || year_days!='' || gp_days!='' || intrest_rate!='' || op_bal_gp_days!='' || vr_date_dr!='' || vr_date_cr!='' || neg_interest!='' || amt_grace_prd!='' || from_date!='' || to_date!=''){

           
            $('#InwardDispatch').DataTable().destroy();
            load_data(acct_code,year_days,gp_days,intrest_rate,op_bal_gp_days,vr_date_dr,vr_date_cr,neg_interest,amt_grace_prd,from_date,to_date);

          }else{
            $('#InwardDispatch').DataTable().destroy();
            load_data();
          }


        });

        $('#ResetId').click(function(){

          $('#acct_code').val('');
          $('#series_code').val('');
          $('#gl_code').val('');
          $('#vr_num').val('');
          $('#vr_type').val('');

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

<script type="text/javascript">
  
  function getAccDetailsLeger(){

     var acct_code = $("#acct_code").val();

      $.ajaxSetup({
          headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });

        $.ajax({

            url:"{{ url('/get-acc-data-for-intrest-ledger') }}",
            method : "POST",
            type: "GET",
            data: {acct_code:acct_code},

            success: function(response){

              if(response.response == 'success' && response.data !=''){

                var link = document.createElement('a');
                link.href = response.url;
                link.download = 'cashbank report.pdf';
                link.dispatchEvent(new MouseEvent('click'));

              }else{
                alert('no data');
              }

            }, 

        });
  }

</script>

<script type="text/javascript">
  
    $('#btnpdf').click(function(){

      var from_date =  $('#from_date').val();
      var to_date   =  $('#to_date').val();
      var bank_code =  $('#bank_code').val();
      var acct_code =  $('#acct_code').val();
      var gl_code   =  $('#gl_code').val();
      var vr_num    =  $('#vr_num').val();
      var vr_type   =  $('#vr_type').val();
      var btnsearch =  $('#btnsearch').val();

      if(bank_code!='' || acct_code!='' || gl_code!='' || from_date!='' || to_date!='' || vr_num!='' || vr_type!='') {

        $('#show_err_from_date').html('');
        $('#show_err_to_date').html('');
        $('#show_err_dept_code').html('');
        $('#show_err_acct_code').html('');
        $('#show_err_trans').html('');

        if(from_date!=''){
          if(to_date==''){
            $('#show_err_to_date').html('Please select to date').css('color','red');
          //  setTimeout(function(){$('#show_err_to_date').html('');},4000);
            return false;
          }
        }

        if(to_date!=''){
          if(from_date==''){
            $('#show_err_from_date').html('Please select from date').css('color','red');
          //  setTimeout(function(){$('#show_err_from_date').html('');},4000);
            return false;
          }
        }

        $.ajaxSetup({
          headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });

        $.ajax({

            url:"{{ url('/report/cash-bank-report/pdf') }}",
            method : "POST",
            type: "GET",
            data: {acct_code:acct_code,gl_code:gl_code,vr_num:vr_num,from_date:from_date,to_date:to_date},

            success: function(response){

              if(response.response == 'success' && response.data !=''){

                var link = document.createElement('a');
                link.href = response.url;
                link.download = 'cashbank report.pdf';
                link.dispatchEvent(new MouseEvent('click'));

              }else{
                alert('no data');
              }

            }, 

        });

      }else{
          $('#InwardDispatch').DataTable().destroy();
          load_data_query();
            
      }


    });

    function validation(){

      var acct_code =  $('#acct_code').val();  
      var glC_code  =  $('#gl_code').val();
      console.log('glC_code',glC_code);
      if(acct_code=='' && glC_code==''){
        $('#show_err_code').html('Please select to Acc Code Or Gl Code');
        return false;
      }else{
        $('#show_err_code').html('');
      }
    }
</script>


@endsection