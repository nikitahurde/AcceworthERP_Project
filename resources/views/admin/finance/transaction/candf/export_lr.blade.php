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
  .box-header>.box-tools {
    position: absolute !important;
    right: 10px !important;
    top: 2px !important;
  }
  .required-field::before {
    content: "*";
    color: red;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Export Lorry Recipt (LR)
      <small> : Export Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transation </a></li>
      <li class="active"><a href="{{ url('/transaction/outward-tran/export-lr-c-and-f') }}">Export LR </a></li>

    </ol>

  </section>


<form id="inwardImportTran">
    @csrf

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle formTitle" style="font-weight: 800;color: #5696bb;"> Export Lorry Recipt</h2>

      </div><!-- /.box-header -->

      <div class="box-body">

          <div class="row">

            <div class="col-md-3"></div>
             <?php date_default_timezone_set('Asia/Kolkata'); ?>
            <div class="col-md-2">

               <div class="form-group">

                <?php 
                    $FromDate= date("d-m-Y", strtotime($fromDate));  
                    $ToDate= date("d-m-Y", strtotime($toDate)); 
                    $Today_date = date("d-m-Y");
                ?>

                  <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $FromDate }}">
                  <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $ToDate }}">
                  <input autocomplete="off" type="hidden" name="" id="todayDate" value="{{ $Today_date }}">

                  <label for="exampleInputEmail1"> From Date: </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                   
                    <input autocomplete="off" type="text" name="from_date" id="fromDate" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="<?php echo $FromDate; ?>">

                  </div>

                  <small id="show_err_from_date">

                  </small>

               </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1"> To Date: </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                  </div>

                  <input type="text" name="to_datecash" id="to_datecash" class="form-control datepicker1" placeholder="Select To Date" value="<?php echo $ToDate; ?>">

                </div>

                <small id="show_err_to_date">

                </small>

              </div>

            </div><!-- /.col -->

            <div id="errorItem"></div>

            <div class="col-md-2" style="margin-top: 10px;">

              <button class="btn btn-primary" type="button" id="submitdata">
                &nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp; Export LR &nbsp;&nbsp;
              </button>
              
            </div><!-- /.col -->

            <div class="col-md-3"></div>

          </div><!-- /.row -->

      </div><!-- /.box-body -->

    </div><!-- /. custom box -->


    <div class="box box-warning Custom-Box">

      <div class="box-body">

          <table id="lrExportTbl" class="table table-bordered table-striped table-hover">
              <thead class="theadC">

                <tr>
               
                  <th class="text-center" width="5%">BILLING DOC</th>
                  <th class="text-center" width="5%">BILLING DATE</th>
                  <th class="text-center" width="5%">TYPE</th>
                  <th class="text-center" width="5%">SHIPTO PARTYCD</th>
                  <th class="text-center" width="5%">SHIP-PARTY-DSC</th>
                  <th class="text-center" width="5%">ADDRESS</th>
                  <th class="text-center" width="5%">SALES UNIT</th>
                  <th class="text-center" width="5%">QTY</th>
                  <th class="text-center" width="5%">MATL VAL</th>
                  <th class="text-center" width="5%">DO/STO NO</th>
                  <th class="text-center" width="5%">DO/STO DATE</th>
                  <th class="text-center" width="5%">DELIVERY</th>
                  <th class="text-center" width="5%">DESP PLANT</th>
                  <th class="text-center" width="5%">DESTN CD</th>
                  <th class="text-center" width="5%">DESTN CD DESC</th>
                  <th class="text-center" width="5%">REGIO</th>
                  <th class="text-center" width="5%">TRANSPORTER NAM</th>
                  <th class="text-center" width="5%">VEHICLE NO</th>
                  <th class="text-center" width="5%">MATERIAL GROUP</th>
                  <th class="text-center" width="5%">MATERIAL NO</th>
                  <th class="text-center" width="5%">MATERIAL DESCRI</th>
                  <th class="text-center" width="5%">BATCH</th>
                  <th class="text-center" width="5%">NET.WT.</th>
                  <th class="text-center" width="5%">GROSS.WT.</th>
                  <th class="text-center" width="5%">TARE WT.</th>
                  <th class="text-center" width="5%">NO OF COILS</th>
                  <th class="text-center" width="5%">SALES DOC TYPE</th>
                  <th class="text-center" width="5%">E1FORM INDICATO</th>
                  <th class="text-center" width="5%">LR RECEIPT NO</th>
                  <th class="text-center" width="5%">LR RECIEPT DT</th>
                  <th class="text-center" width="5%">Plant Name</th>
                  <th class="text-center" width="5%">eWayBill Number</th>
                  <th class="text-center" width="5%">EWB Valid Date</th>
                  <th class="text-center" width="5%">VENDOR</th>
                 
                 <!--  <th class="text-center" width="4%">Location Code</th>
                  <th class="text-center" width="4%">Location Name</th> -->
                  
                 </tr>

              </thead>

              <tbody id="defualtSearch">

              </tbody>
             
          </table>

      </div><!-- /.box-body -->

    </div><!-- /. custom box -->


  </section><!-- /.section -->

</form>

</div><!-- /.content-wrapper -->


@include('admin.include.footer')


<script type="text/javascript">


/*--~~~~~~~~~~~~~~~~ START: LOAD DATA TABLE ~~~~~~~~~~~~~~~~~~~~~~~--*/


load_data_query();


function load_data_query(fromDate= '',toDate= ''){
   
  $('#lrExportTbl').DataTable({
  

      processing: true,
      serverSide: true,
      info: true,
      bPaginate: false,
      scrollY: 400,
      scrollX: true,
      scroller: true,
      fixedHeader: true,
      order: [[0, 'asc'],[1, 'asc'],[2, 'DESC']],
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
      buttons:  [
                  {
                    extend: 'excelHtml5',
                    
                    title: ' LORRY RECEIPT EXPORT'+$("#headerexcelDt").val(),
                    filename: 'LORRY_RECEIPT_EXPORT'+$("#headerexcelDt").val(),
                  }
                ],  
      ajax:{

        url:'{{ url("/transaction/outward-tran/export-lr-data") }}',
        data: {fromDate:fromDate,toDate:toDate},

      },
      columns: [
        { data :'INVC_NO',className:'text-right'},
        { data :'INVC_DATE',
         render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00.00.0000';
                  }else{
                    
                  return date.getDate() + "." + (month.toString().length > 1 ? month : "0" + month) + "." +  date.getFullYear();
                  }
            },
            className:'text-right'
        },
        { data :'VEHICLE_TYPE',className:'text-left'},
        { data :'SP_CODE',className:'text-left'},
        { data :'SP_NAME',className:'text-left'},
        { data :'FROM_PLACE',className:'text-left'},
        { data :'UM',className:'text-left'},
        { data :'QTY',className:'text-right'},
        { data :'MATERIAL_VAL',className:'text-right'},
        { data :'DO_NO',className:'text-right'},
        { data :'DO_DATE',
         render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00.00.0000';
                  }else{
                    
                  return date.getDate() + "." + (month.toString().length > 1 ? month : "0" + month) + "." +  date.getFullYear();
                  }
            },
            className:'text-right'
        },
        { data :'DELIVERY_NO',className:'text-right'},
        { data :'PLANT_CODE',className:'text-right'},
        { data :'TO_PLACE',className:'text-left'},
        { data :'TOPLACE',className:'text-left'},
        { data :'REGIO',className:'text-left'},
        { data :'TRANSPORT_NAME',className:'text-left'},
        { data :'VEHICLE_NO',className:'text-left'},
        { data :'MATERIAL_GROUP',className:'text-left'},
        { data :'ITEM_CODE',className:'text-left'},
        { data :'REMARK',
          render : function (data, type, full, meta){
            var remk =  full['REMARK']!= 'null'  ?  full['REMARK'] : '----';
            return remk;
          },
        },
        { data :'BATCH_NO',className:'text-left'},
        { data :'NET_WEIGHT',className:'text-right'},
        { data :'GROSS_WEIGHT',className:'text-right'},
        { data :'TARE_WEIGHT',className:'text-right'},
        { data :'AQTY',className:'text-left'},
        { data :'SALES_DOC_TYPE',className:'text-left'},
        { data :'E1FORM_INDICATO',className:'text-left'},
        { data :'LR_NO',className:'text-left'},
        { data :'LR_DATE',
         render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00.00.0000';
                  }else{
                    
                  return date.getDate() + "." + (month.toString().length > 1 ? month : "0" + month) + "." +  date.getFullYear();
                  }
            },
            className:'text-right'
        },
        { data :'PLANT_NAME',className:'text-left'},
        { data :'EBILL_NO',className:'text-left'},
        { data :'EWAYB_VALIDDT',
         render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00.00.0000';
                  }else{
                    
                  return date.getDate() + "." + (month.toString().length > 1 ? month : "0" + month) + "." +  date.getFullYear();
                  }
            },
            className:'text-right'
        },
        { data :'ACC_CODE',className:'text-left'}
        
      ]


  });


}


/*--~~~~~~~~~~~~~~~~ END: LOAD DATA TABLE ~~~~~~~~~~~~~~~~~~~~~~~--*/


/* --------------- START : SUBMIT DATA ------------ */

$(document).ready(function() {

  $('#submitdata').click(function(){

    console.log('export btn click...!');

    var fromDate = $('#fromDate').val();
    var toDate   = $('#to_datecash').val();

    console.log('fromDate',fromDate);
    console.log('toDate',toDate);

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    if(toDate != ''){

     //console.log('grn');

      $('#fromDate').attr('disabled',true);
      $('#to_datecash').attr('disabled',true);
    
      $('#lrExportTbl').DataTable().destroy();
      $('#show_err_to_date').html('');
      $('#errorItem').html('');
      load_data_query(fromDate,toDate);

    }else{

      $('#show_err_to_date').html('Please select to date').css('color','red');

      load_data_query();
      console.log('not grn');

    }

  });

});

$(document).ready(function() {
  
    var fromDate  = $('#from_date_default').val()
    var toDate    = $('#to_date_default').val()
    var todayDate = $('#todayDate').val()

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromDate,

      endDate : todayDate,

      autoclose: 'true'

    });

    $('.datepicker1').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromDate,

      endDate : todayDate,

      autoclose: 'true'

    });

});

/* --------------- END : SUBMIT DATA ------------ */

</script>

@endsection