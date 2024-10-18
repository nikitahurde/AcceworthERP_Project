@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }

  .alignLeftClass{
    text-align: left;
  }

  .alignRightClass{
    text-align: right;
  }

  .alignCenterClass{
    text-align: center;
  }

  @media screen and (max-width: 600px) {

    .viewpagein{
      width: auto;
    }

  }

</style>

<div class="content-wrapper">

<!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>Loan & Hundi<small>View Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>
      <li class="active"><a href="{{ url('/transaction/ColdStorage/View-inward-entry-transaction') }}"> Loan & Hundi</a></li>
      <li class="active"><a href="{{ url('/transaction/ColdStorage/View-inward-entry-transaction') }}">View Loan & Hundi</a></li>
    </ol>

  </section>

<!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Loan & Hundi</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/Transaction/LoanAndHundi/Add-loan-hundi-Tran') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Loan & Hundi</a>

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

                  <th class="text-center">Date</th>
                  <th class="text-center">Acc Name</th>
                  <th class="text-center">Loan Amt</th>
                  <th class="text-center">Tenure</th>
                  <th class="text-center">Maturity Date</th>
                  <th class="text-center">Int Rate </th>
                  <th class="text-center">Int Amt </th>

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

        url : "{{ url('/Transaction/LoanAndHundi/view-loan-hundi-Tran') }}"

      },
      searching : true,

      columns: [
        
        {
            data:'VRDATE',
            render: function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                if(data=='0000-00-00'){
                  return '00-00-0000';
                }else{
                  
                return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                }
            },
            className:'dtvrDate'
        },
        { 
            render: function (data, type, full, meta) {
                return full['ACC_CODE']+'[ '+full['ACC_NAME']+' ]';  
            },
        }, 
        { data: "LOAN_AMT" },  
        { data: "TENURE" },  
        {
            data:'MATURITY_DATE',
            render: function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                if(data=='0000-00-00'){
                  return '00-00-0000';
                }else{
                  
                return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                }
            },
            className:'dtvrDate'
        },
        { data: "INT_RATE" },  
        { data: "INT_AMT" },  
                
      ],

    });

  });
</script>


<script type="text/javascript">

  function getID(id){

      //console.log(id);
     $("#inwardslipDelete").modal('show');

     $('#inwardslipId').val(id);


  }

</script>







@endsection



