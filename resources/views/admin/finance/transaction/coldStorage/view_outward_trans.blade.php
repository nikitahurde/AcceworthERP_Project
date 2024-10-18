@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
    padding: 5px !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
    padding: 5px !important;
  }
  .columnhide{
    display:none;
  }
  .required-field::before {
    content: "*";
    color: red;
  }
  .numberRight{
    text-align:right;
  }
</style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>Outward<small><b>Outward Details</b></small></h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}"> Transaction </a></li>

        <li class="active"><a href="{{ url('/view-mast-dealer') }}">Outward</a></li>

        <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Outward</a></li>

      </ol>

    </section>

    <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-xs-12">
             
          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Outward</h3>

              <div class="box-tools pull-right">

                <a href="{{ url('Transaction/ColdStorage/Outward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Outward</a>

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

              <table id="example" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th class="text-center">#</th>
                    <th class="text-center">Bilty No.</th>
                    <th class="text-center">Bilty Date.</th>
                    <th class="text-center">Customer Name</th>
                    <th class="text-center">Item Name</th>
                    <th class="text-center">Packing Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Rate Per Month</th>
                    <th class="text-center">Market Rate</th>
                    <th class="text-center">Action</th>

                  </tr>

                </thead>

                <tbody>

                </tbody>

              </table>

            </div><!-- /.box-body -->

          </div><!-- /.box -->

        </div><!-- /.col -->

      </div><!-- /.row -->

    </section><!-- /.content -->

  </div>

@include('admin.include.footer')

<script type="text/javascript">

  function format ( d ) {
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.OUTWARDHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Cold Storage</th>'+
            '<th>Chamber</th>'+
            '<th>Floor</th>'+
            '<th>Block</th>'+
            '<th>Bilty Qty</th>'+
            '<th>Dispatched Qty</th>'+
            '<th>Balence Qty</th>'+
        '</tr></tbody>'+
    '</table>';
  }

  $(document).ready(function(){

    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    var t = $("#example").DataTable({

      processing: true,
      serverSide:false,
      //scrollY:500,
      scrollX:true,
      paging: true,
      ajax:{

        url : "{{ url('/Transaction/ColdStorage/View-Outward-trans') }}"

      },
      searching : true,
  
      columns: [
        
          { 
            data:"",className:'details-control',
            render: function(data, type, full, meta) {
              return '<button id="showchildtable" onclick="showchildtable('+full.OUTWARDHID+')"><i class="fa fa-plus" id="minus'+full.OUTWARDHID+'" title="Toggle"></i></button>'
            }
          },
          { 
            render: function (data, type, full, meta){
                   
                    var BILTY_NO = full['BILTY_NO'];
                    
                    return BILTY_NO;

            }

          },
          {
            data:'VRDATE',
            className:'text-right',
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
                
              var CUST_NAME = full['ACC_CODE']+' ['+full['ACC_NAME']+']';

              return CUST_NAME;

            }
          },
          {  
            render: function (data, type, full, meta){
                
              var ITEM_NAME = full['ITEM_CODE']+' ['+full['ITEM_NAME']+']';

              return ITEM_NAME;

            }
          },
          {  
            render: function (data, type, full, meta){

              var PACKING = full['PACKING_CODE']+' ['+full['PACKING_NAME']+']';
                    
              return PACKING;
            }
          },
          {
            data:'QTY',
            className:'numberRight'
          },
          {
            data:'RATE_PER_MONTH',
            className:'numberRight'
          },
          {
            data:'MARKET_RATE',
            className:'numberRight'
          },
          {  
            render: function (data, type, full, meta){
                   
                var enableBtn = 'enable';
                var deletebtn ='<a href="edit-jobcard/'+btoa(full['OUTWARDBID'])+'/'+btoa(enableBtn)+'" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+full['OUTWARDBID']+');" disabled><i class="fa fa-trash" title="Delete"></i></button>'; 

                return deletebtn;
            }
          },
      ],

    });

    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        console.log(tr);
        var row = t.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

  });

  function showchildtable(tblid){

      var tblid;

      $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });
             
      $("#minus"+tblid).toggleClass('fa-plus fa-minus rotate');

      $.ajax({

        url:"{{ url('view-outward-chield-row-data') }}",

        method : "POST",

        type: "JSON",

        data: {tblid:tblid},

        success:function(data){

          var data1 = JSON.parse(data);
       
          if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
          }else if(data1.response == 'success'){

              if(data1.body_data==''){
               
              }else{

                  var objrow = data1.body_data;
                  var srNo=1;
                  var tableid = objrow[0].OUTWARDHID;

                  $.each(objrow, function (row, objrow) {

                      var balenceQty = parseFloat(objrow.BILTY_QTY) -parseFloat(objrow.QTY_ISSUED);
              
                       $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td>'+objrow.CS_CODE+'[ '+objrow.CS_NAME+' ]</td><td>'+objrow.CHAMBER_CODE+'[ '+objrow.CHAMBER_NAME+' ]</td><td>'+objrow.FLOOR_CODE+'[ '+objrow.FLOOR_NAME+' ]</td><td>'+objrow.BLOCK_CODE+'[ '+objrow.BLOCK_NAME+' ]</td><td class="text-right">'+objrow.BILTY_QTY+'</td><td class="text-right">'+objrow.QTY_ISSUED+'</td><td class="text-right">'+balenceQty.toFixed(3)+'</td></tr>');
                      srNo++;

                  });

              }
              
          }
        }

      });
  }
</script>

@endsection



