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
/*.table>tbody>tr:hover {
  background-color: #697068 !important;
}*/
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #697068 !important;
}

.table tbody  tr  td #expired {
  color:white !important;
}
@keyframes blinker {
  50% {
    opacity: 0;
  }
}

/* ----- excel btn css ------ */


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
  .colDate{
    width:5%;
    text-align: right;
  }

  .colStatus{
    width: 2%;
    text-align:center;
  }
  .colLeft{
    width: 8%;
    
  }
  .colName{
    width: 15%;
  }
  .tranlName{
    width: 120px;
  }
  table.dataTable {
      clear: both;
      margin-top: 10px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }
 
  @media screen and (max-width: 600px) {

  .PageTitle{

    float: left;

  }

}

  /* /.----- excel btn css ------ */


</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

           Trip Status at a Glance
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b>View Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>Trip Status at a Glance</a></li>
          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Trip Status at a Glance</h3>

                  <div class="box-tools pull-right">

                   <!--  <a href="{{url('/logistic/fleet-certificate-transaction-form')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Vehicle Doc</a> -->

                  </div>

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

            <div class="alert alert-danger alert-dismissible" style="width: 100%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-ban"></i>

                  Error...!

                </h4>

                {!! session('alert-error') !!}

            </div>

            @endif

          <form action="">

            <div class="box-body">

              <div class="row">
              
                <div class="col-md-2"></div>
                <div class="col-md-2">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Report Type : <span class="required-field"></span> </label>

                      <div class="input-group">

                      
                          <input type="radio" id="pendingId" name="reporttype" value="pending"> &nbsp; <b>Pending</b> &nbsp;&nbsp;
                          <input type="radio" id="CompleteId" name="reporttype" value="complete">  &nbsp; <b>Complete</b>&nbsp;&nbsp;
                          <input type="radio" id="allId" name="reporttype" value="allitem" checked="">  &nbsp; <b>All</b>


                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="pfctText"></div>

                     </small>

                     <small id="show_err_dept_code">

                      </small>
                     
                  </div>

                </div> <!-- /.col -->

                <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Search Type :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input list="searchTypeList" id="searchType" name="searchType" class="form-control  pull-left" value="" placeholder="Select Search Type" autocomplete="off">

                          <datalist id="searchTypeList">

                            <option selected="selected" value="">-- Select --</option>
                            <option value="Trip_Plan_Status" data-xyz="Trip_Plan_Status">Trip Plan Status</option>
                            <option value="Gate_In_Status" data-xyz="Gate_In_Status">Gate In Status</option>
                            <option value="LR_Status" data-xyz="LR_Status">LR Status</option>
                            <option value="SLR_Status" data-xyz="SLR Status">SLR_Status</option>
                            <option value="Gate_Out_Status" data-xyz="Gate_Out_Status">Gate Out Status</option>
                            <option value="EPOD_Status" data-xyz="EPOD_Status">EPOD Status</option>
                            <option value="LR_Ackonwledgment" data-xyz="LR_Ackonwledgment">LR Ackonwledgment</option>
                            <option value="Trip_Expenses_Status" data-xyz="Trip_Expenses_Status">Trip Expenses Status</option>
                            <option value="Trip_PMT_Status" data-xyz="Trip_PMT_Status">Trip PMT. Status</option>
                            <option value="Temp_Bill_Status" data-xyz="Temp_Bill_Status">Temp. Bill Status</option>
                            <option value="Bill_Status" data-xyz="Bill_Status">Bill Status</option>
                            
                          </datalist>

                      </div>

                          <small>  
                            <div class="pull-left showSearchTypName" id="plantText"></div>
                          </small>

                  </div>

                </div> <!-- /.col -->

                <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Company :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input list="compList" id="compCode" name="compCode" class="form-control  pull-left" value="" placeholder="Select Company" autocomplete="off">

                          <datalist id="compList">

                            <option selected="selected" value="">-- Select --</option>

                            <?php foreach ($masterCompData as $key){ ?>

                              <option value="<?php echo $key->COMP_CODE; ?>" data-xyz="<?php echo $key->COMP_CODE; ?>"><?php echo $key->COMP_NAME; ?> [<?php echo $key->COMP_CODE; ?>]</option>

                            <?php } ?>
                          
                            
                          </datalist>

                      </div>

                          <small>  
                            <div class="pull-left showSeletedName" id="plantText"></div>
                          </small>

                  </div>

                </div> <!-- /.col -->

                <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Account/Party :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input list="AccCodeList" id="accCode" name="accCode" class="form-control  pull-left" value="" placeholder="Select Account/Party" autocomplete="off">

                          <datalist id="AccCodeList">

                            <option selected="selected" value="">-- Select --</option>
                            <?php foreach ($masterAccData as $row){ ?>

                              <option value="<?php echo $row->ACC_CODE; ?>" data-xyz="<?php echo $row->ACC_CODE; ?>"><?php echo $row->ACC_NAME; ?> [<?php echo $row->ACC_CODE; ?>]</option>

                            <?php } ?>
                            
                          </datalist>

                      </div>

                        <small>  
                          <div class="pull-left showSeletedName" id="plantText"></div>
                        </small>

                  </div>

                </div> <!-- /.col -->

                <!-- <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Consignee :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input list="consignee List" id="consigneeCode" name="consigneeCode" class="form-control  pull-left" value="" placeholder="Select Consignee" autocomplete="off">

                          <datalist id="consignee List">

                            <option selected="selected" value="">-- Select --</option>
                            <?php foreach ($masterConsigneeData as $row){ ?>

                              <option value="<?php echo $row->ACC_CODE; ?>" data-xyz="<?php echo $row->ACC_CODE; ?>"><?php echo $row->ACC_NAME; ?> [<?php echo $row->ACC_CODE; ?>]</option>

                            <?php } ?>
                            
                          </datalist>

                      </div>

                        <small>  
                          <div class="pull-left showSeletedName" id="plantText"></div>
                        </small>

                  </div>

                </div> --> <!-- /.col -->

                <div class="col-md-3"></div>

              </div> <!-- /.row -->

              <div class="row">
              
                <div class="" style="margin-top: 1%;text-align: center;">

                   <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                    <button type="button" class="btn btn-warning" name="resetBtn" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

                </div>

              </div>

               <!-- <div class="overlay-spinner hideloader"></div>  -->  
              <table id="example" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>
                      <th class="text-center" >Plan Status</th>
                      <th class="text-center" >Gate in Status</th>
                      <th class="text-center" >LR Status</th>
                      <th class="text-center" >SLR Status</th>
                      <th class="text-center">Gate Out Status</th>
                      <th class="text-center" >EPOD Status</th>
                      <th class="text-center">Report Date</th>
                      <th class="text-center" >LR Ack Status</th>
                      <th class="text-center" >Ack Date</th>
                      <th class="text-center" >Trip Expense Status</th>
                      <th class="text-center" >Trip PMT Status</th>
                      <th class="text-center" >Temp. Bill Status</th>
                      <th class="text-center" >Bill Status</th>
                      <th class="text-center" >Company Code <br> ( TRIP/LR )</th>
                      <th class="text-center" >Ref Company Code/C & F</th>
                      <th class="text-center" >Trip No.</th>
                      <th class="text-center" >Trip Ref. No</th>
                      <th class="text-center" >Vr Date</th>
                      <th class="text-center">Vehicle No</th>
                      <th class="text-center">Vehicle Type</th>
                      <th class="text-center">LR No</th>
                      <th class="text-center">LR Date</th>
                      <th class="text-center">Remark</th>
                      <th class="text-center">Freight Qty</th>
                      <th class="text-center">UM</th>
                      <th class="text-center">From Place</th>
                      <th class="text-center">To Place</th>
                      <th class="text-center">Trip Day</th>
                      <th class="text-center">Account Code</th>
                      <th class="text-center">Account Name</th>
                      <th class="text-center">CP Code</th>
                      <th class="text-center">CP Name</th>
                      <th class="text-center">INVC No</th>
                      <th class="text-center">INVC Date</th>
                      <th class="text-center">E-Way Bill NO</th>
                      <th class="text-center">E-Way Bill Valid Date</th>
                      <th class="text-center">Delivery No</th>
                      <th class="text-center">Wagon No</th>
                      <th class="text-center">Trip Freight Amt</th>
                      <th class="text-center">Transport Code</th>
                      <th class="text-center" width="15%">Transport Name</th>
                     
                    
                    
                  </tr>

                </thead>

                <tbody>





                </tbody>
              </table>
            </div><!-- /.box-body -->
        </form>
              

</div><!-- /.row -->

</section><!-- /.content -->

</div>

@include('admin.include.footer')

<script type="text/javascript">

$(document).ready(function(){

    var reportTy = $('#allId').val();

    if (reportTy=='allitem') {

      $('#searchType').prop('disabled',true);

    }else{
      $('#searchType').prop('disabled',false);
    }

    $('#allId').click(function(){

      var reportTy = $(this).val();

      if (reportTy=='allitem') {

        $('#searchType').prop('disabled',true);

      }else{
        $('#searchType').prop('disabled',false);
      }

    });

    $('#CompleteId').click(function(){

      var reportTy = $(this).val();

      if (reportTy=='complete') {

        $('#searchType').prop('disabled',false);

      }else{
        $('#searchType').prop('disabled',true);
      }

    });

    $('#pendingId').click(function(){

      var reportTy = $(this).val();

      if (reportTy=='pending') {

        $('#searchType').prop('disabled',false);

      }else{
        $('#searchType').prop('disabled',true);
      }

    });

});

load_data_query()

function load_data_query(searchType='',compCode='',accCode='',ReportTypes=''){
  
  $("#example").DataTable({

    processing: true,
    serverSide: false,
    info: true,
    bPaginate: false,
    scrollY: 480,
    scrollX: true,
    scroller: true,
    fixedHeader: true,
    language: {
        processing: "<img src='<?php echo url('public/dist/img/Spinner.gif') ?>'>"
    },
    order: [[2, 'asc'],[3, 'asc']],
    columnDefs: [
       { orderable: false, targets:0 }
    ],
    dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
     buttons: [
      {
        extend: 'excelHtml5',
        exportOptions: {
            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39]
        },
        title: 'TRIP_STATUS_AT_A_GLANCE'+$("#headerexcelDt").val(),
        filename: 'TRIP_STATUS_AT_A_GLANCE'+$("#headerexcelDt").val(),
        footer: true
      }
      ],
               
      ajax:{
        url:'{{ url("transaction/Logistics/Trip-compleation-status") }}',
        data: {searchType:searchType,compCode:compCode,accCode:accCode,ReportTypes:ReportTypes}
     
      },
      searching : true,
      columns: [

       { data:'PLAN_STATUS',
          render: function (data, type, full, meta){

           var plant_status = full['PLAN_STATUS'];

           if(plant_status == 1){

            return '<span class="label label-success">Complete</span>';

           }else if(plant_status == 0 || plant_status == null){

             return '<span class="label label-danger">Pending</span>';

           }else {
              return '<span class="label label-danger">Not Found</span>';
           }


           },className:'colStatus',
        
        },
        
       {  data:'GATE_IN_STATUS',
          render: function (data, type, full, meta){

           var gate_in_status = full['GATE_IN_STATUS'];

           if(gate_in_status == 1){

            return '<span class="label label-success">Complete</span>';

           }else if(gate_in_status == 0 || gate_in_status == null){

             return '<span class="label label-danger">Pending</span>';

           }else {
              return '<span class="label label-danger">Not Found</span>';
           }


           },className:'colStatus',
        
        },

        

        { data:'LR_STATUS',
          render: function (data, type, full, meta){

           var lr_status = full['LR_STATUS'];

           if(lr_status == 1){

            return '<span class="label label-success">Complete</span>';

           }else if(lr_status == 0 || lr_status == null){

             return '<span class="label label-danger">Pending</span>';

           }else {
              return '<span class="label label-danger">Not Found</span>';
           }


           },className:'colStatus',
        
        },

       
        { data:'SLR_STATUS',
          render: function (data, type, full, meta){

           var slr_status = full['SLR_STATUS'];

           if(slr_status == 1){

            return '<span class="label label-success">Complete</span>';

           }else if(slr_status == 0 || slr_status == null){

             return '<span class="label label-danger">N/A</span>';

           }else {
              return '<span class="label label-danger">Not Found</span>';
           }


           },className:'colStatus',
        
        },

        { data:'GATE_OUT_STATUS', 
          render: function (data, type, full, meta){

             var gate_out_status = full['GATE_OUT_STATUS'];

             if(gate_out_status == 1){

              return '<span class="label label-success">Complete</span>';

             }else if(gate_out_status == 0 || gate_out_status == null){

               return '<span class="label label-danger">Pending</span>';

             }else {
                return '<span class="label label-danger">Not Found</span>';
             }

          },className:'colStatus',
    
        },

       { data:'EPOD_STATUS',
          render: function (data, type, full, meta){

             var epod_status = full['EPOD_STATUS'];

             if(epod_status == 1){

              return '<span class="label label-success">Complete</span>';

             }else if(epod_status == 0 || epod_status == null){

               return '<span class="label label-danger">Pending</span>';

             }else {
                return '<span class="label label-danger">Not Found</span>';
             }

          },className:'colStatus',
        
        },

        {
            data:'REPORT_DATE',
            className:'text-left',
            render: function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                if(data=='0000-00-00' || data == '' || data == null){
                  return '-----';
                }else{
                  
                return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                }
            },
            className:'colDate',
        },

        { data:'LR_ACK_STATUS', 
          render: function (data, type, full, meta){

             var lrAck_status = full['LR_ACK_STATUS'];

             if(lrAck_status == 1){

              return '<span class="label label-success">Complete</span>';

             }else if(lrAck_status == 0 || lrAck_status == null){

               return '<span class="label label-danger">Pending</span>';

             }else {
                return '<span class="label label-danger">Not Found</span>';
             }

          },className:'colStatus',
        
        },

        {
          data:'ACK_DATE',
          className:'text-left',
          render: function (data) {
              var date = new Date(data);
              var month = date.getMonth() + 1;
              if(data=='0000-00-00' || data == '' || data == null){
                return '-----';
              }else{
                
              return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
              }
          },
          className:'colDate',
      },
      

      {   data:'TRIP_EXP_STATUS',
          render: function (data, type, full, meta){

             var lrExp_status = full['TRIP_EXP_STATUS'];
             var owner_type   = full['OWNER'];


                console.log('owner_type',owner_type);


             if(lrExp_status == 1 && owner_type=='SELF'){

              return '<span class="label label-success">Complete</span>';

             }else if((lrExp_status == 0 || lrExp_status == null) && (owner_type=='SELF')){

               return '<span class="label label-danger">Pending</span>';

             }else if((lrExp_status == 0 || lrExp_status == null) && (owner_type=='MARKET')){

               return '<span class="label label-danger">NA</span>';

             }else {
                return '<span class="label label-danger">Not Found</span>';
             }

          },className:'colStatus',
        
        },

        { data:'TRIP_PMT_STATUS',
          render: function (data, type, full, meta){

             var lrPMT_status = full['TRIP_PMT_STATUS'];

             if(lrPMT_status == 1){

              return '<span class="label label-success">Complete</span>';

             }else if(lrPMT_status == 0 || lrPMT_status == null){

               return '<span class="label label-danger">Pending</span>';

             }else {
                return '<span class="label label-danger">Not Found</span>';
             }

          },className:'colStatus',
        
        },

        { data:'PROVBILL_STATUS',
          render: function (data, type, full, meta){

             var PROVBILLSTATUS = full['PROVBILL_STATUS'];

             if(PROVBILLSTATUS == 1){

              return '<span class="label label-success">Complete</span>';

             }else if(PROVBILLSTATUS == 0 || PROVBILLSTATUS == null){

               return '<span class="label label-danger">Pending</span>';

             }else {
                return '<span class="label label-danger">Not Found</span>';
             }

          },className:'colStatus',
        
        },

        { data:'BILL_STATUS',
          render: function (data, type, full, meta){

             var bill_status = full['BILL_STATUS'];

             if(bill_status == 1){

              return '<span class="label label-success">Complete</span>';

             }else if(bill_status == 0 || bill_status == null){

               return '<span class="label label-danger">Pending</span>';

             }else {
                return '<span class="label label-danger">Not Found</span>';
             }

          },className:'colStatus',
        
        },
        {data:'COMP_CODE',className:'colLeft'},
        {data:'RCOMP_CODE',
          render: function (data, type, full, meta){

           if(data == '' || data == null){
                                           return '-----';
           }else{
                  return data;
           }
          },
          className:'colLeft'
        },
        {data:'TRIP_NO',className:'colLeft'},
        {data:'REF_TRIP_NO',
          render: function (data, type, full, meta){

           if(data == '' || data == null){
              return '-----';
           }else{
              var getData =  full['REF_TRIP_NO'];

              var getRefTripNo = getData.split('~');

              return getRefTripNo[0];


           }
          },
          className:'colLeft'
        },

        {
          data:'VRDATE',
          className:'text-left',
          render: function (data) {
              var date = new Date(data);
              var month = date.getMonth() + 1;
              if(data=='0000-00-00' || data == '' || data == null){
                return '-----';
              }else{
                
              return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
              }
          },
          className:'colDate',
      },
      {data:'VEHICLE_NO',className:'colLeft'},
      {data:'OWNER',className:'colLeft'},
      {data:'LR_NO',className:'colLeft'}, 
      {
          data:'LR_DATE',
          className:'text-left',
          render: function (data) {
              var date = new Date(data);
              var month = date.getMonth() + 1;
              if(data=='0000-00-00' || data == '' || data == null){
                return '-----';
              }else{
                
              return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
              }
          },
          className:'colDate',
      },
      {data:'REMARK',className:'colLeft'}, 
      {data:'FREIGHT_QTY',className:'colDate'}, 
      {data:'UM',className:'colDate'}, 
      {data:'FROM_PLACE',className:'colLeft'}, 
      {data:'TO_PLACE',className:'colLeft'}, 
      {data:'TRIP_DAY',className:'colDate'}, 
      {data:'ACC_CODE',className:'colLeft'}, 
      {data:'ACC_NAME',className:'tranlName'}, 
      {data:'CP_CODE',className:'colLeft'}, 
      {data:'CP_NAME',className:'tranlName'}, 
      {data:'INVC_NO',className:'colDate'}, 
      {
          data:'INVC_DATE',
          className:'text-left',
          render: function (data) {
              var date = new Date(data);
              var month = date.getMonth() + 1;
              if(data=='0000-00-00' || data == '' || data == null){
                return '-----';
              }else{
                
              return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
              }
          },
          className:'colDate',
      },
      {data:'EBILL_NO',className:'colDate',}, 
      {
          data:'EWAYB_VALIDDT',
          className:'text-left',
          render: function (data) {
              var date = new Date(data);
              var month = date.getMonth() + 1;
              if(data=='0000-00-00' || data == '' || data == null){
                return '-----';
              }else{
                
              return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
              }
          },
          className:'colDate',
      },
      {data:'DELIVERY_NO',className:'colDate'}, 
      {data:'WAGON_NO',className:'colDate'}, 
      {data:'TRIP_FREIGHT_AMT',className:'colDate'}, 
      {data:'TRANSPORT_CODE',className:'colLeft'}, 
      {data:'TRANSPORT_NAME',className:'tranlName'}, 
        
         
         
      ]
  });

}


$(document).ready(function(){

    $('#btnsearch').click(function(){
        
        var searchType    =  $('#searchType').val();
        var compCode      =  $('#compCode').val();
        var accCode       =  $('#accCode').val();

        var pendingId  =  $('#pendingId').is(":checked");

        var CompleteId =  $('#CompleteId').is(":checked");

        var allId      =  $('#allId').is(":checked");
        
        var ReportTypes;

        if(pendingId){
          ReportTypes = $('#pendingId').val();
        }else if(CompleteId){
          ReportTypes = $('#CompleteId').val();
        }else if(allId){
          ReportTypes = $('#allId').val();
        }else{
          ReportTypes = 'Not Found';
        }

        console.log('searchType',searchType);
        console.log('compCode',compCode);
        console.log('accCode',accCode);
        //console.log('consigneeCode',consigneeCode);
        console.log('ReportTypes',ReportTypes);

        $('#example').DataTable().destroy();

        load_data_query(searchType,compCode,accCode,ReportTypes);

    });

});


$('.number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
   if (this.value.length==1) {
    return false;}
});



</script>
@endsection



