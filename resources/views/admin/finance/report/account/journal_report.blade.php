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

  .rightcontent{
    text-align:right;
  }

  ::placeholder {
    text-align:left;
  }

  .showSeletedName {
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }

  .alignRightClass{
    text-align: right !important;
  }

  .alignLeftClass{
    text-align: left !important;
  }

  .SapBillBackColor{
    background-color: #dfccf5;
  }

  .DisPatchBackColor{
    background-color: #c2f3e3;
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
    font-size: 14px!important;
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

  .buttonClass{
    font-size: 12px;
    padding: 3px;
    margin: 2px;
  }
  .vrDateDataTbl{
    width: 8%;
    text-align: left;
  }
  .vrNoDateDataTbl{
    width: 10%;
    text-align: left;
  }
  .glNameDataTbl{
    width: 30%;
    text-align: left;
  }
  .accNameDataTbl{
    width: 30%;
    text-align: left;
  }
  .remarkDataTbl{
    width: 24%;
    text-align: left;
  }
  .drAmtDataTbl{
    width: 11%;
    text-align: right;
  }
  .crAmtDataTbl{
    width: 11%;
    text-align: right;
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
  .hideCol{
    display:none;
  }
  .content {
      min-height: 250px;
      padding: 9px;
      margin-right: auto;
      margin-left: auto;
      padding-left: 15px;
      padding-right: 15px;
  }

  [data-tip] {
    position:relative;
  }
  [data-tip]:before {
    content:'';
    /* hides the tooltip when not hovered */
    display:none;
    content:'';
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-bottom: 5px solid #1a1a1a; 
    position:absolute;
    top:12px;
    left:35px;
    z-index:8;
    font-size:0;
    line-height:0;
    width:0;
    height:0;
  }
  [data-tip]:after {
    display:none;
    content:attr(data-tip);
    position:absolute;
    top:17px;
    left:0px;
    padding:3px 3px;
    background:#1a1a1a;
    color:#fff;
    z-index:9;
    font-size: 0.75em;
    height:25px;
    line-height:18px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    white-space:nowrap;
    word-wrap:normal;
  }
  [data-tip]:hover:before,
  [data-tip]:hover:after {
    display:block;
  }
  #SapVsDispatch {
    width: 100% !important;
  }

  @media only screen and (max-width: 600px) {
    .buttonClass{
      margin-left: 0%;
    }
    .dataTables_filter{
      margin-left: 35%;
    }
  }

</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>
        Journal Report
      <!-- < ?php echo ucwords($form_name) ?>  -->

      <small><b><!-- < ?php echo $form_number; ?> --></b></small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report/MIS</a></li>

      <li class="active"><a href="{{ url('/rept-sap-despatch') }}">List Journal Report</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Journal Report</h2>

      </div><!-- /.box-header -->

      <div class="box-body" style="margin-top: -2%;">

        <form id="myForm">

          @csrf

          <?php date_default_timezone_set('Asia/Kolkata'); ?>

          <div class="row" style="margin-top: 13px;">

            <div class="col-md-2">

              <div class="form-group">
                <?php

                   $From_date = date("d-m-Y", strtotime($fromDate));
                   $To_date = date("d-m-Y", strtotime($toDate));

                ?>
                
                <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $From_date }}">
                <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $To_date }}">
                  <label for="exampleInputEmail1">From Date : </label>

                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="<?php echo $From_date; ?>">

                  </div>
                  <small id="show_err_from_date" style="color: red;"></small>
              
              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">To Date: </label>

                  <div class="input-group">
                   <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Enter To  Date" value="<?php echo date('d-m-Y'); ?>" >

                  </div>

                  <small id="show_err_to_date" style="color:red;"></small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                  <label for="exampleInputEmail1">Series Code : </label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                      <input autocomplete="off" list="seriesList"  id="series_code" name="series_code" class="form-control  pull-left" value="{{ old('series_code')}}" placeholder="Select series Code">

                      <datalist id="seriesList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($series_list as $key)

                        <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                  </div>

                  <small>  

                    <div class="pull-left showSeletedName" id="seriesText"></div>

                  </small>

                 <small id="series_code_err" style="color: red;">

                 </small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Account Code : </label>

                <div class="input-group">

                  <span class="input-group-addon">
                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                  </span>
                  <input autocomplete="off" list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Account Code">

                    <datalist id="accountList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($acc_list as $key)

                      

                      <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                </div>

                <small>  

                  <div class="pull-left showSeletedName" id="accountText"></div>

                </small>

                <small id="acct_code_err" style="color: red;">

                </small>

              </div>

            </div>

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Vr No : </label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                    <input autocomplete="off" Type="text"  id="vr_no" name="vr_no" class="form-control  pull-left rightcontent" value="{{ old('vr_no')}}" placeholder="Enter Vr No" >

                </div>

              </div>

            </div>

            <div class="col-md-2">
              <label>&nbsp;</label>
              <div style="display: flex;">
                <button type="button" class="btn btn-primary buttonClass" name="searchdata" id="searchdata"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>
           
                <button type="button" class="btn btn-default buttonClass" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>
              </div>
            </div>
                 

          </div>
                
        </form>

        <table id="SapVsDispatch" class="table table-bordered table-striped table-hover">

          <thead class="theadC">

            <tr>

              <th class="text-center">Date</th>
              <th class="text-center">Vr No</th>
              <th class="text-center">Gl Name</th>
              <th class="text-center">Gl Code</th>
              <th class="text-center">Acc Name</th>
              <th class="text-center">Acc Code</th>
              <th class="text-center">Debit-DR</th>
              <th class="text-center">Credit-CR</th>
            </tr>

          </thead>
          <tfoot align="right">
            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
          </tfoot>

        </table>

      </div><!-- /.box-body -->

    </div>

  </section>

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
                    <div style="font-weight: 700;">Narration :&nbsp; <small id="narrationText" style="font-weight: 600;"></small></div>
                    
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

 <script>

    $(function () {

      $(".select2").select2();

      $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

      $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});

      $("[data-mask]").inputmask();

    });

 </script>

 <script type="text/javascript">

    $(document).ready(function(){

      $("#acct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');

          }

      });

      $("#series_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#seriesList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){

          $(this).val('');
          
        }

      });

      load_data();
      function load_data(from_date='',to_date='',series_code='',acct_code='',vr_no=''){

        $('#SapVsDispatch').DataTable({

          footerCallback: function ( row, data, start, end, display ) {
              var api = this.api(), data;
     
              // converting to interger to find total
              var intVal = function ( i ) {
                  return typeof i === 'string' ?
                      i.replace(/[\$,]/g, '')*1 :
                      typeof i === 'number' ?
                          i : 0;
              };
     
              var monTotal = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
          
              var tueTotal = api
                .column(6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
              }, 0 );

              var crTotal = api
                .column(7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
              }, 0 );

                console.log('tueTotal',tueTotal);
                console.log('crTotal',crTotal);
            
              $( api.column( 4 ).footer() ).html('Total :-');
              $( api.column( 5).footer() ).html(monTotal+'.00');
              $( api.column( 6 ).footer() ).html(tueTotal+'.00');
              $( api.column( 7 ).footer() ).html(crTotal+'.00');
                    
          },
          'fnCreatedRow': function (nRow, aData, iDataIndex) {
                
              $(nRow).attr('onclick', "showBodyDetail(\""+aData['COMP_CODE']+"\",\""+aData['FY_CODE']+"\",\""+aData['TRAN_CODE']+"\",\""+aData['SERIES_CODE']+"\","+aData['VRNO']+","+aData['JVID']+")"); // or whatever you choose to set as the id
          },
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: false,
          scrollY: 300,
          scrollX: true,
          scroller: true,
          fixedHeader: true,
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'JOURNAL_TRANSACTION'+$("#headerexcelDt").val(),
                        exportOptions: {
                              columns: [0,1,2,4,6,7]
                        }
                      }

                    ],
         
          ajax:{
            url:'{{ url("/journal-trans-report") }}',
            data: {from_date:from_date,to_date:to_date,series_code:series_code,acct_code:acct_code,vr_no:vr_no}
          },
          columns: [

                    {
                        data:'VRDATE',
                        render: function (data) {
                            var date = new Date(data);
                            var month = date.getMonth() + 1;
                            if(data=='0000-00-00'){
                              return '00-00-0000';
                            }else{
                              
                            return date.getDate() + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" +  date.getFullYear();
                            }
                        },
                        className:'vrDateDataTbl'
                    },
                    { 
                      data:'VRNO',
                      render: function (data, type, full, meta){
                             
                        var fy_code = full['FY_CODE'].split('-');

                        var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                              
                        return VRNO;
                                   
                      },
                      className:'vrNoDateDataTbl' 
                    },
                    {
                        data :'GL_NAME',
                        render: function (data, type, full, meta){

                          if(full['GL_CODE'] == null){
                            var glCode = '--';
                          }else{
                            var glCode = full['GL_CODE'];
                          }
                          
                          if(full['GL_NAME'] == null){
                            var gName = '--';
                            return '-- ( -- )';
                          }else{
                            var glName = full['GL_NAME'];
                            //var gName = 'display' && glName.length > 25 ? glName.substr(0, 25) + '…' : glName;
                            return glName+' ( '+glCode+')';
                          }    
                        },
                        className:'glNameDataTbl' 
                    },
                    {
                        data:'GL_CODE',
                        name:'GL_CODE',
                        className:'hideCol' 
                    },
                    { 
                        data :'ACC_NAME',
                        render: function (data, type, full, meta){
                          
                          if((full['ACC_CODE'] == null) || (full['ACC_CODE'] == '')){
                            var accCode =full['REF_CODE'];
                            var accName =full['REF_NAME'];
                          }else{
                            var accCode =full['ACC_CODE'];
                            var accName =full['ACC_NAME'];
                          }

                          return accName+' ( '+accCode+')';

                        },
                        className:'accNameDataTbl'
                    },
                    {
                        data:'ACC_CODE',
                        name:'ACC_CODE',
                        className:'hideCol' 
                    },
                    {
                        data:'DRAMT',
                        name:'DRAMT',
                        className:'drAmtDataTbl' 
                    },
                    {
                        data:'CRAMT',
                        name:'CRAMT',
                        className:'crAmtDataTbl' 
                    },
                  ]


          });

      }

      $('#searchdata').click(function(){   

        var from_date   =  $('#from_date').val();
        var to_date     =  $('#to_date').val();
        var series_code =  $('#series_code').val();
        var acct_code   =  $('#acct_code').val();
        var vr_no       =  $('#vr_no').val();
        
        if (from_date != '' || to_date!='' || series_code!='' || acct_code!='' || vr_no!=''){

          if(from_date != ''){

            if(to_date==''){
               $('#show_err_to_date').html('Please select to date');
              return false;
            }
          }

          $('#SapVsDispatch').DataTable().destroy();
          load_data(from_date,to_date,series_code,acct_code,vr_no);

        }else{

         $('#SapVsDispatch').DataTable().destroy();
          load_data();
        }


      });

      $('#ResetId').click(function(){

        $('#from_date,#to_date,#series_code,#acct_code,#vr_no').val('');
        $('#SapVsDispatch').DataTable().destroy();
        load_data();

      });

    });
    
    function showBodyDetail(compCd,fyCd,tranCd,seriesCd,vrNo,jvTblId){

      $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

      $.ajax({

          url:"{{ url('show-details-on-click-of-row-in-account-section-page') }}",

          method : "POST",

          type: "JSON",

          data: {compCd:compCd,fyCd:fyCd,tranCd:tranCd,seriesCd:seriesCd,vrNo:vrNo,jvTblId:jvTblId},

          success:function(data){

            var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
              }else if(data1.response == 'success'){

                  //console.log('data1.data_detail',data1.data_detail);

                  if(data1.data_detail==''){
                   
                  }else{

                    if((data1.data_detail[0].NARRATION == '') || (data1.data_detail[0].NARRATION == null)){
                      var narration = '';
                    }else{
                      var narration =data1.data_detail[0].NARRATION; 
                    }

                    $('#perticularText').html(data1.data_detail[0].PARTICULAR);
                    $('#narrationText').html(narration);
                    
                  } /* /. CHECK DATA*/

              }/* /. RESPONSE CHECK*/

          }/* /. SUCCESS FUNCTION*/

      });/* /. AJAX FUCNTION*/

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
  
  });

  $(document).ready(function() {
  
    var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

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


@endsection