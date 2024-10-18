@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
  
  .text-right{
    text-align: right;
  }

  .datebill{
     width: 90px;
     text-align: right;
  }
  .texIndbox{
    text-align: left !important;
  }
  .texIndboxright{
    text-align: right !important;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .showSeletedName{

    font-size: 15px;
    margin-top: 1%;
    margin-bottom: 3%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
    text-transform: capitalize;
    text-align: center;

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
    font-size: 15px!important;
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
  .amtClass{
    text-align:right;
  }
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

           TDS Report
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b> : TDS Report</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('/reports/stock/stock-age-wise-analysiss') }}"><i class="fa fa-dashboard"></i> TDS Report</a></li>
          </ol>


        </section>

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
        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">TDS Report</h3>

                  <div class="box-tools pull-right"></div>

                </div><!-- /.box-header -->

                <div class="box-body">

                  <div class="row">
                      
                      <div class="col-sm-2">
                    
                        <div class="form-group">

                          <label>TDS Code  : 
                            <span class="required-field"></span>
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="tdsList"  id="tds_code" name="tds_code" class="form-control  pull-left" value="" placeholder="Select TDS Code"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                              <datalist id="tdsList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($tds_list as $key)

                                <option value='<?php echo $key->TDS_CODE; ?>'   data-xyz ="<?php echo $key->TDS_NAME; ?>"><?php echo $key->TDS_NAME ; echo " [".$key->TDS_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>
                             
                        </div>

                      </div>

                      <div class="col-sm-2">
                    
                        <div class="form-group">

                          <label>Acc Code  : 
                            <span class="required-field"></span>
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="accList"  id="acc_code" name="acc_code" class="form-control  pull-left" value="" placeholder="Select Acc Code"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                              <datalist id="accList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($acc_list as $key)

                                <option value='<?php echo $key->ACC_CODE; ?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>"><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>
                             
                        </div>
                        
                      </div>

                      <div class="col-sm-2">
                    
                        <div class="form-group">

                          <label>Gl Code  : 
                            <span class="required-field"></span>
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="glList"  id="gl_code" name="gl_code" class="form-control  pull-left" value="" placeholder="Select Gl Code"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                              <datalist id="glList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($gl_list as $key)

                                <option value='<?php echo $key->GL_CODE; ?>'   data-xyz ="<?php echo $key->GL_NAME; ?>"><?php echo $key->GL_NAME ; echo " [".$key->GL_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>
                             
                        </div>
                        
                      </div>

                      <div class="col-sm-2">
                    
                        <div class="form-group">

                          <label>From Date  : 
                            <span class="required-field"></span>
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text"  id="from_date" name="from_date" class="form-control pull-left fromdatepicker" value="<?= $FromDate; ?>" placeholder="Select From Date"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                            </div>
                             
                        </div>
                        
                      </div>

                      <div class="col-sm-2">
                    
                        <div class="form-group">

                          <label>To Date  : 
                            <span class="required-field"></span>
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text"  id="to_date" name="to_date" class="form-control  pull-left" value="{{$vrDate}}" placeholder="Select To Date"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                            </div>
                             
                        </div>
                        
                      </div>

                      <div class="col-md-2">
                 
                        <div class="form-group">

                          <label for="exampleInputEmail1">Report Type : <span class="required-field"></span> </label>

                          <div class="input-group">
                          
                              <input type="radio" id="pendingId" name="reporttype" value="pending" checked=""> &nbsp; <b>Pending</b> &nbsp;&nbsp;
                              <input type="radio" id="CompleteId" name="reporttype" value="complete">  &nbsp; <b>Complete</b>&nbsp;&nbsp;
                              <input type="radio" id="allId" name="reporttype" value="allitem">  &nbsp; <b>All</b>
                          </div>
                           
                        </div>

                      </div>

                  </div>

                  <div class="row" style="text-align:center;">
                    
                    <div>

                     <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" style="padding: 2px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                      <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();" style="padding: 2px;">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reset &nbsp;&nbsp;</button>

                    </div>

                  </div>

                  <table id="tdsReport" class="table table-bordered table-striped table-hover">

                    <thead>

                      <tr>

                        <th class="text-center">Vr No</th>

                        <th class="text-center">Vr Date</th>

                        <th class="text-center">GL Code</th>

                        <th class="text-center">GL Name</th>

                        <th class="text-center">ACC Code</th>

                        <th class="text-center" id="rangeOne">ACC Name</th>

                        <th class="text-center" id="rangeTwo">Particular</th>

                        <th class="text-center" id="rangeFour">TDS Code</th>
                        <th class="text-center" id="rangeFive">TDS Base Amt</th>
                        <th class="text-center" id="rangeFive">TDS Rate</th>
                        <th class="text-center" id="rangeThree">TDS Amt</th>
                        <th class="text-center" id="rangeThree">PMT Date</th>
                        <th class="text-center" id="rangeThree">PMT Amt</th>
                        <th class="text-center" id="rangeThree">PMT Particular</th>
                        <th class="text-center" id="rangeThree">PMT Vrno</th>



                      </tr>

                    </thead>

                    <tbody id="defualtSearch">

                    </tbody>

                    <tfoot>
                      <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
                    </tfoot>

                  </table>

                  
                </div><!-- /.box-body -->
                  
              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->


      </div>



@include('admin.include.footer')



<script type="text/javascript">


  function load_data(tds_code='',acc_code='',gl_code='',from_date='',to_date='',report_type=''){

   
      $('#tdsReport').DataTable({

          footerCallback: function ( row, data, start, end, display ) {
              var api = this.api(), data;
     
              // converting to interger to find total
              var intVal = function ( i ) {
                  return typeof i === 'string' ?
                      i.replace(/[\$,]/g, '')*1 :
                      typeof i === 'number' ?
                          i : 0;
              };
     
              var tdsBaseAmt = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
          
              var tdsAmt = api
                .column(10 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
              }, 0 );
            
              $( api.column( 7 ).footer() ).html('Total :-');
              $( api.column( 8).footer() ).html(tdsBaseAmt+'.00');
              $( api.column( 10).footer() ).html(tdsAmt+'.00');
              //$( api.column( 6 ).footer() ).html(tueTotal+'.00');
              //$( api.column( 7 ).footer() ).html(crTotal+'.00');
                    
          },
          processing: true,
          serverSide: false,
         // scrollX: true,
          pageLength:'25',
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [1,2,3,4,5,6,7,8,9,10,11],
                            
                        },
                      }
                    ],
          ajax:{
            url:'{{ url("/account/report/tds-report-data") }}',
            method:'POST',
            data: {tds_code:tds_code,acc_code:acc_code,gl_code:gl_code,from_date:from_date,to_date:to_date,report_type:report_type}
          },

          columns: [

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
                data:'GL_CODE',
                name:'GL_CODE', 
            },
            {
                data:'GL_NAME',
                name:'GL_NAME', 
            },
            {
                data:'ACC_CODE',
                name:'ACC_CODE', 
            },
            {
                data:'ACC_NAME',
                name:'ACC_NAME', 
            },
            {
                data:'PARTICULAR',
                name:'PARTICULAR', 
            },
            {
                data:'TDS_CODE',
                name:'TDS_CODE', 
            },
            {
                data:'BASE_AMT',
                name:'BASE_AMT',
                className:'amtClass' 
            },
            {
                data:'TDS_RATE',
                name:'TDS_RATE',
                className:'amtClass' 
            },
            {
                data:'TDS_AMT',
                name:'TDS_AMT',
                className:'amtClass' 
            },
            {
                data:'PMT_VRDATE',
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
                data:'PMT_DRAMT',
                name:'PMT_DRAMT',
                className:'amtClass' 
            },
            {
                data:'PMT_PARTICULAR',
                name:'PMT_PARTICULAR',
                className:'amtClass' 
            },
            { 
              data:'VRNO',
              render: function (data, type, full, meta){
                    
                if(full['PMT_TRANCODE'] == null || full['PMT_TRANCODE']==''){
                  var pmtTranCd = '--';
                }else{
                  var pmtTranCd = full['PMT_TRANCODE'];
                }

                if(full['PMT_SERIES_CODE'] == null || full['PMT_SERIES_CODE']==''){
                  var pmtseriesCd = '--';
                }else{
                  var pmtseriesCd = full['PMT_SERIES_CODE'];
                }

                if(full['PMT_VR_NO'] == null || full['PMT_VR_NO']==''){
                  var pmtvrno = '--';
                }else{
                  var pmtvrno = full['PMT_VR_NO'];
                }

                var VRNO = pmtTranCd+' '+pmtseriesCd+' '+pmtvrno;
                      
                return VRNO;
                           
              },
              className:'vrNoDateDataTbl' 
            },
            

          ]


      });


   }

  $(document).ready(function(){

    var fromdateintrans = $('#FromDateFy').val();
    var todateintrans = $('#ToDateFy').val();

    $('.fromdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromdateintrans,
      endDate : todateintrans,      
      autoclose: 'true'

    });

    $("#from_date").click(function() {

      $("#to_date").val('');
      $('#to_date').datepicker('destroy');

    });

    $("#to_date").click(function() {

      var fromDate = $('#from_date').val();
      console.log('fromDate',fromDate);
      var splitFrom    = fromDate.split("-");

      var frDate = splitFrom[0];
      var frMonth = splitFrom[1];
      var frYear = splitFrom[2];

      var netDate =frYear+'-'+frMonth+'-'+frDate;

      var dt = new Date(netDate);
      var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(dt);
      var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(dt);

      var middleDateStart =da+'-'+mo+'-'+frYear;

      $('#to_date').datepicker({
        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        startDate: middleDateStart,
        endDate: todateintrans,
        autoclose: 'true'
      });
       $('#to_date').datepicker('show');
      
    });

    $('#btnsearch').click(function(){

        var tds_code   =  $('#tds_code').val();
        var acc_code   =  $('#acc_code').val();
        var gl_code    =  $('#gl_code').val();
        var from_date  =  $('#from_date').val();
        var to_date    =  $('#to_date').val();
        var report_type = $("input[type='radio'][name='reporttype']:checked").val();
        
        if (tds_code!='' || acc_code!='' || gl_code!='' || report_type!='') {

          $('#tdsReport').DataTable().destroy();
          load_data(tds_code,acc_code,gl_code,from_date,to_date,report_type);

        }else{

         $('#tdsReport').DataTable().destroy();
          load_data();
        }

    });


  });

</script>

@endsection



