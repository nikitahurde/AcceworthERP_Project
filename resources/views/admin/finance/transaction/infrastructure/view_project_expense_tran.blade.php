@extends('admin.main')
@section('AdminMainContent')
@include('admin.include.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('admin.include.navbar')
@include('admin.include.sidebar')
<style>
  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      View Project Expense
      <small>View Details</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ URL('/dashboard')}}">Transaction</a></li>
      <li class="Active"><a href="{{ URL('Transaction/Infrastructure/Add-project-expense-tranasction')}}">Add  Project Expense </a></li>
      <li class="Active"><a href="{{ URL('Transaction/Infrastructure/Add-project-expense-tranasction')}}">View  Project Expense </a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary Custom-Box">
          <div class="box-header with-border" style="text-align: center;">
            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View  Project Expense</h3>
            <div class="box-tools pull-right">
              <a href="{{ url('Transaction/Infrastructure/Add-project-expense-tranasction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add   Project Expense</a>
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
            <h4>
              <i class="icon fa fa-ban"></i>
              Error...!
            </h4>
            {!! session('alert-error') !!}
          </div>
          @endif
          <div class="box-body">
            <table id="example" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th class="text-center">Project Code</th>
                  <th class="text-center">Project Name</th>
                  <th class="text-center">Gl Code</th>
                  <th class="text-center">GL Name</th>
                  <th class="text-center">Pmt Voucher No</th>
                  <th class="text-center">Wbs Code</th>
                  <th class="text-center">Wbs Name</th>
                  <th class="text-center">Budget Amount</th>
                  <th class="text-center">Exp Dramt</th>
                  <th class="text-center">Dr Amt</th>
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
<div class="modal fade" id="itemtypeDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <i class="fa fa-caret-right"></i> &nbsp;You Want To Delete This Data...!
        <div class="row" style="margin-top: 5%;" id="delText"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>
        <form action="#" method="post">
          @csrf
          <input type="hidden" name="Poject_code" id="typecode" value="">
          <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="">
          <input type="hidden" name="tblName" id="tblName" value="MASTER_PROJECT">
          <input type="hidden" name="colName" id="colName" value="PROJECT_CODE">
          <input type="hidden" name="colNameTwo" id="colNameTwo" value="PROJECT_NAME">
          <input type="hidden" name="colNameThree" id="colNameThree" value="">
          <input type="hidden" name="colNameFour" id="colNameFour" value="">
          <input type="hidden" name="colNameFive" id="colNameFive" value="">
          <input type="hidden" name="colNameSix" id="colNameSix" value="">
          <input type="button" value="Delete" id="del_data" style="margin-top: -12%;" class="btn btn-sm btn-danger" disabled="" onclick="funDelData()">
        </form>
      </form>
    </div>
  </div>
</div>
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
      footerCallback: function ( row, data, start, end, display ) {
        var api = this.api(), data;
        var rowcount = data.length;
        var getRow = rowcount-1;
        if(rowcount > 0){
          $('.buttons-excel').attr('disabled',false);
        }else{
          $('.buttons-excel').attr('disabled',true);
        }
      },
      processing: true,
      serverSide:false,
      scrollX:true,
      paging: true,
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
      buttons:  [
      {
        extend: 'excelHtml5',
        exportOptions: {
          columns: [0,1,2,3,4,5,6,7,8,9]
        },
        title: 'PROJECT EXPENSE'+$("#headerexcelDt").val(),
        filename: 'PROJECT_EXPENSE_'+$("#headerexcelDt").val(),
      }
      ],
      ajax:{
         url : "{{ url('Transaction/Infrastructure/view-project-expense-tranasction') }}"
      },
      searching : true,
      columns: [
        { data: "PROJECT_CODE" },
        { data: "PROJECT_NAME" },
        { data: "GL_CODE" },
        { data: "GL_NAME" },
        { data: "PMT_VOUCHER_NO" },
        { data: "WBS_CODE" },
        { data: "WBS_NAME" },
        { data: "BUDGET_AMT" },
        { data: "EXP_DRAMT" },
        { data: "DR_AMT" },
        {  
          render: function (data, type, full, meta){
            var enableBtn = 'enable';
            /*var deletebtn ='<input type="hidden" id="deleteinput_'+full['PROJECT_CODE']+'" value="'+full['PROJECT_CODE']+'"><a href="#"  id="getId"class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a>|<button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return dleteitemType(\''+full['PROJECT_CODE']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';*/

            var deletebtn ='<input type="hidden" id=""><a href="#"  id="getId"class="btn btn-warning btn-xs actionBTN" disabled title="edit"><i class="fa fa-pencil" title="Edit"></i></a>|<button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';
            return deletebtn;
          },className:"text-center"
        },
        ],
    });
  });
</script>
<script type="text/javascript">
  
   
</script>
@endsection







