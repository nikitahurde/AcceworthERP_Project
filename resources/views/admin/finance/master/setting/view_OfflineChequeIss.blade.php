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
  .text-left{
    text-align: left;
  }
  .text-center{
    text-align: center;
  }
  .notification {
    background-color: #3c8dbc;
    color: white;
    text-decoration: none;
    padding: 2px 4px;
    position: relative;
    display: inline-block;
    border-radius:3px;
  }
  .notification .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    padding: 2px 6px;
    border-radius: 50%;
    background-color: red;
    color: white;
  }
  .viewaccnot{
    font-size: 12px;
  }
 
  .boxer {
    display: table;
    border-collapse: collapse;
  }
  .boxer .box-row {
    display: table-row;
  }
  .boxer .box-row:first-child {
    font-weight:bold;
  }
  .boxer .box10 {
    display: table-cell;
    vertical-align: top;
    border: 1px solid #ddd;
    padding: 5px;
  }
  
   .texIndbox1{
    width: 5%; 
    text-align: center;
  }
  .rateIndbox{
    width: 15%;
    text-align: center;
  }
  .itmdetlheading{
    vertical-align: middle !important;
    text-align: left;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .removeextraSInC{
    padding: 2px !important;
  }
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .chieldtblecls>tbody>tr>td {
    line-height: 1;
  }
  .iconSize{
    font-size: 10px;
  }
  .btn-group-xs>.btn, .btn-xs {
    padding: 1px 3px;
    font-size: 12px;
    line-height: 1;
    border-radius: 3px;
  }
  .modal-header .close {
    margin-top: -44px;
  }
</style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>

        Master Offline Cheque Issue

        <small><b>View Details</b></small> 

      </h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}"> Master </a></li>
        <li><a href="{{ url('/dashboard') }}"> Master Offline Cheque Issue </a></li>

        <li class="active"><a href="{{ url('/configration/Setting/view-chequeBook') }}">View Offline Cheque Issue</a></li>

      </ol>

    </section>

    <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-xs-12">
             
          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Offline Cheque Issue</h3>

              <div class="box-tools pull-right">

                <a href="{{ url('/configration/Setting/add-offline-cheque-issue') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Offline Cheque Issue</a>

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
                    <th class="text-center">Series Code</th>
                    <th class="text-center">Series Name</th>
                    <th class="text-center">Bank Code</th>
                    <th class="text-center">Bank Account</th>
                    <th class="text-center">Cheque No</th>
                    <th class="text-center">Cheque Date</th>
                    <th class="text-center">Account Code</th>
                    <th class="text-center">Account Name</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Remark</th>
                    <!-- <th class="text-center">Action</th> -->
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

<!-- --------------- delete modal ---------------- -->

  <div class="modal fade" id="DeleteChequebook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          You Want To Delete This Data...!

        </div>

        <div class="modal-footer">

            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

            <form action="#" method="post">

              @csrf

              <input type="hidden" name="headID" id="tblHeadID" value="">
              <input type="hidden" name="bodyID" id="tblBodyID" value="">
              <input type="hidden" name="slNum" id="tblSlno" value="">
              <input type="hidden" name="slNum" id="tblchqNo" value="">

              <input type="submit" value="Delete" style="margin-top: -15%;" class="btn btn-sm btn-danger">

            </form>

        </div>

      </div>

    </div>

  </div>

<!-- --------------- delete modal ---------------- -->

@include('admin.include.footer')

<script type="text/javascript">

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

        url : "{{ url('/configration/Setting/view-offline-cheque-issue') }}"

      },
      searching : true,

      columns: [
          
          // { data:"SLNO",
          //   className :'text-right'
          // },

          {
             render: function(data, type, full, meta) {

               // if(full.SERIES_CODE == null){
               //    var seriescode = '---';
               //  }else{
               //    var seriescode = full.SERIES_CODE;
               //  }

               var seriescode =  full.SERIES_CODE != null ? full.SERIES_CODE : '----';
               return seriescode;
            },

          },
          { 
            render: function(data, type, full, meta) {
                // if(full.SERIES_CODE == null){
                //   var seriescode = '--';
                // }else{
                //   var seriescode = full.SERIES_CODE;
                // }

                if(full.SERIES_NAME == null){
                  var seriesname = '--';
                }else{
                  var seriesname = full.SERIES_NAME;
                }
                return seriesname;
            },
          },



          {
            render: function(data, type, full, meta){

            var glcode = full.GL_CODE != null ? full.GL_CODE : '----';

            return glcode;
           },
          },
          { 
            render: function(data, type, full, meta) {
                
                // if(full.GL_CODE == null){
                //   var glcode = '--';
                // }else{
                //   var glcode = full.GL_CODE;
                // }

                if(full.GL_NAME == null){
                  var glname = '--';
                }else{
                  var glname = full.GL_NAME;
                }
                return glname;
            }
          },
          { data:"CHEQUENO",
            className :'text-right'
          },
          { data:"CHEQUEDATE", 
            render: function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                if(data=='0000-00-00'){
                  return '00-00-0000';
                }else{
                  
                return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                }
            },className :'text-right'
          },

          {
            render:function(data,type,full,meta){
              var acc_code = full.ACC_CODE != null ? full.ACC_CODE : '-----';
              return acc_code;
            }
          },
          { 
            render: function(data, type, full, meta) {
                
                // if(full.ACC_CODE == null){
                //   var accode = '--';
                // }else{
                //   var accode = full.ACC_CODE;
                // }

                if(full.ACC_NAME == null){
                  var accname = '--';
                }else{
                  var accname = full.ACC_NAME;
                }
                return accname;
            }
          },
          { data:"AMOUNT",
            className :'text-right'
          },
          { 
            render: function(data, type, full, meta) {
              var remark = full.REMARK != null ? full.REMARK : '-----';
              return remark;
            }
          },
          // {
          //   render: function (data, type, full, meta) {
              
          //     return '<a href="#" class="btn btn-warning btn-xs" disabled ><i class="fa fa-pencil iconSize" title="edit"></i></a> | <button type="button" data-toggle="modal"  class="btn btn-danger btn-xs" onclick="return deleteChqIss('+full['CHQBHID']+','+full['CHQBBID']+','+full['SLNO']+','+full['CHEQUENO']+')"><i class="fa fa-trash iconSize" title="delete"></i></button>';
              
          //   }, className :'text-center'
          // }
                 
      ],
    });

    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
       // console.log(tr);
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


</script>

<script type="text/javascript">

  function deleteChqIss(headID,bodyID,slno,chqNo){

    $("#DeleteChequebook").modal('show');

    $('#tblHeadID').val(headID);
    $('#tblBodyID').val(bodyID);
    $('#tblSlno').val(slno);
    $('#tblchqNo').val(chqNo);


  }

</script>


@endsection