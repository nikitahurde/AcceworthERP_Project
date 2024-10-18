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
    width: 7%;
    text-align: right;
  }
  .crAmtDataTbl{
    width: 7%;
    text-align: right;
  }
  .balAmtDataTbl{
    width: 7%;
    text-align: right;
  }
  .balTypeDataTbl{
    width: 5%;
    text-align: center;
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
      min-height: 200px;
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

      Cash/Bank Day Book
      <small> Cash/Bank Day Book</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report</a></li>

      <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">List Cash Bank Trans Report</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Cash/Bank Day Book</h2>

      </div><!-- /.box-header -->

      <div class="box-body">

        <form id="myForm">

          @csrf

          <?php date_default_timezone_set('Asia/Kolkata'); ?>

          <div class="row">

            <div class="col-md-2">

              <div class="form-group">

                <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                    $ToDate= date("d-m-Y", strtotime($toDate));   ?>

                  <label for="exampleInputEmail1"> From Date: </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                   
                    <input type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Select Transaction Date" value="{{$FromDate}} " autocomplete="off">

                  </div>

                  <small id="show_err_from_date">

                  </small>

              </div>

            </div>

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1"> To Date: </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                  </div>

                  <input type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Select Transaction Date" value="{{$ToDate}}" autocomplete="off">

                </div>

                <small id="show_err_to_date">

                </small>

              </div>

            </div>

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Account Code : </label>

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

                <label for="exampleInputEmail1">Series Code : </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input list="seriesList"  id="series_code" name="series_code" class="form-control  pull-left" value="{{ old('series_code')}}" placeholder="Select series code" autocomplete="off">

                    <datalist id="seriesList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($bank_list as $key)
                      
                      <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="seriesText"></div>
                  </small>
                       
              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Gl Code : </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input type="text" id="gl_code" name="gl_code" class="form-control  pull-left" value="{{ old('gl_code')}}" placeholder="Enter Gl Code" autocomplete="off" readonly>

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="gl_name"></div>
                  </small>

                  <small id="show_err_trans">

                  </small>
                  <span id='searcherr' style="color: red;"></span>
              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Vr No : </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input type="text" id="vr_num" name="vr_num" class="form-control  pull-left rightcontent" value="{{ old('trans_code')}}" placeholder="Enter vr no" autocomplete="off">

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="transText"></div>
                  </small>

                  <small id="show_err_trans">

                  </small>
                  <span id='searcherr' style="color: red;"></span>
              </div>

            </div><!-- /.col -->

          </div><!-- /.row -->

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
              
              <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 5px;font-size: 12px;" onclick="return validation();"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

              <button type="button" class="btn btn-default" name="searchdata" id="ResetId" style="padding: 5px;font-size: 12px;"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

            </div>

            

          </div>
      
        </form>

      </div><!-- /.box-body -->

      <div class="box-body" style="margin-top: -2%;">

        <button type="button" id="btnpdf" class="btn btn-danger btn-sm" style="margin-left: 60px !important;margin-bottom: -29px !important;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Pdf </button>

        <table id="InwardDispatch" class="table table-bordered table-striped table-hover">

          <thead class="theadC">

            <tr>
              <th class="text-center">Vr Date</th>
              <th class="text-center"><lable>vr. No.</lable></th>
              <th class="text-center" >Gl/Acc Name </th>
              <th class="text-center" >Particular </th>
              <th class="text-center" style="text-align: center;"><lable>Debit/Withdrawal</lable></th>
              <th class="text-center"style="text-align: center;"><lable>Credit/Payment</lable> </th>
              <th class="text-center" style="text-align: center;"><lable>Cl Balance</lable><input type="hidden" id="opBalAmtHid" value="0"><input type="hidden" value="" id="rBalAmtHid"> </th>
              <th class="text-center"><lable>Bal Type </lable></th>
            </tr>

          </thead>

          <tbody id="defualtSearch">

          </tbody>

          <tfoot align="right">
            <tr>
              <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
            </tr>
          </tfoot>
  
        </table>

      </div><!-- /.box-body -->

    </div><!-- /. Custom-Box-->

  </section><!-- /. section-->

  <!-- ---- START : SECTION FOR SHOW DETAILS ---- -->

  <section class="content" style="margin-top: -2%;">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body" style="padding: 2%;">

            <div class="divTable">

              <div class="divTableBody" id="chieldBodyDetails">

                <div class="row">

                  <div class="col-md-12">

                    <div style="font-weight: 700;">Particular :&nbsp; <small id="perticularText" style="font-weight: 600;"></small></div>
                    
                  </div>
                  
                </div>
                
              </div><!-- /.divTableBody -->
              
            </div><!-- /.div table -->
            
          </div><!-- /.box-body -->
          
        </div><!-- /.Custom-Box -->
        
      </div><!-- /.col -->
      
    </div><!-- /.row -->
    
  </section><!-- /.section -->

<!-- ---- START : SECTION FOR SHOW DETAILS ---- -->

</div>

@include('admin.include.footer')

 <script type="text/javascript">

    $(document).ready(function(){

        $("#acct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
          if(msg == 'No Match'){
            $('#accountText').html('');
            $(this).val('');
            
          }else{
            $('#accountText').html(msg);
          }

        });

        $("#series_code").bind('change', function () {  

          var val = $(this).val();

          var tCode = 'A0';

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

          $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
          });

          $.ajax({

              url:"{{ url('get-vr-sequence-by-series') }}",

              method : "POST",

              type: "JSON",

              data: {seriesCode:seriesCode,transcode:tCode},

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
        function load_data(from_date= '',to_date='',acct_code='',series_code='',gl_code='',vrNum='',vr_type=''){

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

                var openingbal = api.column(4).data();

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
                
                var drTotal = api
                  .column( 4 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                var crTotal = api
                  .column( 5 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                var balTotal = parseFloat(crTotal) - parseFloat(drTotal);
                
                    $( api.column( 3).footer() ).html('Total :-').css('text-align','right');
                    //$( api.column( 2 ).footer() ).html(drTotal);
                    $( api.column( 4 ).footer() ).html(drTotal.toFixed(2));
                    $( api.column( 5 ).footer() ).html(crTotal.toFixed(2));
                    $( api.column( 6 ).footer() ).html(balTotal.toFixed(2));
                    //$( api.column( 4 ).footer() ).html(twoTotal);
                    //$( api.column( 5 ).footer() ).html('<span class="label label-danger">'+bal_type+'</span>');
                    
                  },
              'fnCreatedRow': function (nRow, aData, iDataIndex) {
                
                  $(nRow).attr('onclick', "showBodyDetail(\""+aData['particular']+"\")"); // or whatever you choose to set as the id
              },
              processing: true,
              serverSide: false,
              info: true,
              bPaginate: false,
              scrollY: 400,
              scrollX: true,
              scroller: true,
              fixedHeader: true,
              
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
              
              buttons: [
                        'excelHtml5'
                        ],
             
              ajax:{
                url:'{{ url("/report-cash-bank") }}',
                data: {from_date:from_date,to_date:to_date,acct_code:acct_code,series_code:series_code,gl_code:gl_code,vrNum:vrNum,vr_type:vr_type}
              },
              columns: [

                {

                    data:'vrdate',
                    name:'vrdate',
                    className:'vrDateDataTbl',
                    
                },
                {  
                  render: function (data, type, full, meta){
                    var fyCd = full['fy_code'];
                    if(fyCd){
                      var fysiclYR = fyCd;
                      var fsYear = fysiclYR.split('-');
                      var VRNO = fsYear[0]+' '+full['series_code']+' '+full['vrno'];
                      var fy_cd = VRNO;
                    }else{
                      var fy_cd='--';
                    }
                    return fy_cd;
                  },
                  className:'vrVrNoDataTbl'
                },
                {
                  data:'gl_code',
                  render: function (data, type, full, meta){

                    var glCode = (full['gl_code'] != null) ? full['gl_code'] : '---';
                    var glName = (full['gl_name'] != null) ? full['gl_name'] : '---';

                    var gl_Name = 'display' && glName.length > 15 ? glName.substr(0, 15) + '…' : glName;
                    return glName+' ( '+glCode+' )</span> ';

                  }
                },
                {
                  data:'particular',
                  name:'particular'
                },
                {
                    data:'drAmt',
                    name:'drAmt',
                   // render: $.fn.dataTable.render.number(',', '.', 2, ''),
                    className:'drAmtDataTbl'
                   
                },
                {
                    data:'CrAmt',
                    name:'CrAmt',
                   // render: $.fn.dataTable.render.number(',', '.', 2, ''),
                    className:'crAmtDataTbl'
                },
                {
                    render: function (data, type, full, meta){

                      //var opBal_Amt = $('#opBalAmtHid').val();
                      var srNo = full['DT_RowIndex'];

                      if (srNo==1) {

                        var opBal_Amt = $('#opBalAmtHid').val();
                        var opBalAmt = parseFloat(opBal_Amt) + parseFloat(full['CrAmt']) - parseFloat(full['drAmt']);
                        $('#rBalAmtHid').val(opBalAmt);
                         
                      }else{

                          var opBalAmt1 = $("#rBalAmtHid").val();
                          var opBalAmt = parseFloat(opBalAmt1) + parseFloat(full['CrAmt']) - parseFloat(full['drAmt']);

                          $('#rBalAmtHid').val(opBalAmt);
                         
                      }

                      return  opBalAmt.toFixed(2);;

                    },
                    className:'balAmtDataTbl'
                },
                {
                    className: "aligncenterClass",
                    render: function (data) {

                      var opBalAmt1 = $("#rBalAmtHid").val();

                      if(opBalAmt1>=0){
                          var balType = 'Dr';
                          return '<span class="label label-success">Dr</span>';
                        }else{
                          var balType = 'Cr';
                          return '<span class="label label-success">Cr</span>';
                        }

                        //return balType;
                        /*var drAmt = data;
                        if(drAmt=='Cr'){
                          return '<span class="label label-success">Cr</span>';
                        }else if(drAmt=='Dr'){
                          return '<span class="label label-info ">Dr</span>';
                        }else{
                          return '<span class="label label-success">--</span>';
                        }*/
                    },
                    className:'balTypeDataTbl'
                },
                
              ]


          });


       }

       $('#btnsearch').click(function(){

          var from_date   =  $('#from_date').val();
          var to_date     =  $('#to_date').val();
          var series_code =  $('#series_code').val();
          var gl_code     =  $('#gl_code').val();
          var acct_code   =  $('#acct_code').val();
          var vrNum       =  $('#vr_num').val();
          var vr_type     =  $('#vr_type').val();

          if (from_date!='' || to_date!='' || acct_code!='' || series_code!='' || gl_code!='' || vrNum!=''){

            if(from_date!=''){
                  if(to_date==''){
                    $('#show_err_to_date').html('Please select to date').css('color','red');
                    return false;
                  }
            }

            if(to_date!=''){
              if(from_date==''){
                $('#show_err_from_date').html('Please select from date').css('color','red');
                return false;
              }
            }

            $('#InwardDispatch').DataTable().destroy();
            load_data(from_date,to_date,acct_code,series_code,gl_code,vrNum,vr_type);

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

  function showBodyDetail(reftext){
    if((reftext == '') ||(reftext == null)){
      $('#perticularText').html('');
    }else{
      $('#perticularText').html(reftext);
    }
    
    console.log('reftext',reftext);
  }

</script>


<script type="text/javascript">

  $(document).ready(function() {
    var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date,
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