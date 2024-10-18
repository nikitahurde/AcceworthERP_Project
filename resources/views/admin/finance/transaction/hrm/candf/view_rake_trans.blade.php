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


    .tooltip{
      color: #66CCFF !important;
    }

  .PageTitle{
    margin-right: 1px !important;
  }

  .required-field::before {
    content: "*";
    color: red;
  }

  

  .secondSection{

    display: none;
  }

  .rightcontent{

  text-align:right;


}
.hidebtn{
display: none;
}

::placeholder {
  
  text-align:left;
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

.showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
}



</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>Rake Tran<small>View Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Master</a></li>

      <li class="active"><a href="{{ url('/transaction/candf/view-loading-slip') }}">Rake Tran</a></li>

      <li class="active"><a href="{{ url('/transaction/candf/view-loading-slip') }}">View Rake Tran</a></li>

    </ol>

  </section>
<!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Rake Tran</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/Transaction/Logistic/Rack-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Rake Tran</a>

            </div>

          </div><!-- /.box-header -->

          @if(Session::has('alert-success'))

            <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-check"></i>Success...!

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

                  <th class="text-center">CP Name/CP Code</th>
                  <th class="text-center">SP Name/SP Code</th>
                  <th class="text-center">Rake No</th>
                  <th class="text-center">Rake Date</th>
                  <th class="text-center">Place Date</th>
                  <th class="text-center">To Place</th>
                  <th class="text-center">DO No.</th>
                  <th class="text-center">Batch No.</th>
                  <th class="text-center">Wagon No.</th>
                  <th class="text-center">Delivery No.</th>
                  <th class="text-center">Invoice Date</th>
                  <th class="text-center">Item Name</th>
                  <th class="text-center">Qty.</th>
                  <th class="text-center">UM</th>
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

<!--  ---- DELETE MODAL --- -->

  <div class="modal fade" id="vehicleEntryDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          You Want To Delete This ...!

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

          <form action="{{ url('/transaction/CandF/delete-gate-inward-transaction-cf') }}" method="post">

            @csrf

            <input type="hidden" name="deletGateInward" value="" id="deletvehicle">

            <input type="submit" value="Delete" class="btn btn-sm btn-danger" style="margin-top: -20%;">

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

      var date1 = new Date();
      var month = date1.getMonth() + 1;
      var tdate = date1.getDate();
      var mn = month.toString().length > 1 ? month : "0" + month;
      var yr = date1.getFullYear();
      var hr =  date1.getHours(); 
      var min = date1.getMinutes();
      var sec = date1.getSeconds(); 

      var curr_date = tdate+''+mn+''+yr;
      var curr_time = hr+':'+min+':'+sec;
   

      var t = $("#example").DataTable({

        processing: true,
        serverSide:false,
        scrollX:true,
        paging: true,
        pageLength: 100,
        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
        buttons: [
                  {
                    extend: 'excelHtml5',
                    title: 'rake_list_'+curr_date+'_'+curr_time,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
                    }
                  }
                ],
        ajax:{

            url : "{{ url('/Transaction/Logistic/View-Rack-Trans') }}"

        },
        searching : true,
  
        columns: [
          
          { data: "CP_CODE",
            render: function (data, type, full, meta) {
                 
                  var cp_code = full['CP_NAME']+' - ['+full['CP_CODE']+']';

                  return cp_code;
              },

          },
          { data: "SP_CODE",
            render: function (data, type, full, meta) {
                 
                  var cp_code = full['SP_NAME']+' - ['+full['SP_CODE']+']';

                  return cp_code;
              },

          },
          {
              data:'RAKE_NO',
              name:'RAKE_NO',
              className:'alignRightClass',
              
              
          },
           {
              data:'RAKE_DATE',
              className:'alignRightClass',
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
              },
          },
           {
              data:'PLACE_DATE',
              className:'alignRightClass',
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
              },
          },
          {
              data:'TO_PLACE',
              name:'TO_PLACE',
              className:'text-left',
          },
          { 
            data: "ORDER_NO",
            className:'alignRightClass', 
          },
          { 
            data:'BATCH_NO',
            name:'BATCH_NO',
            className:'text-left', 
          },
          { 
            data:'WAGON_NO',
            name:'WAGON_NO',
            className:'text-left', 
          },
          { 
            data:'DELIVERY_NO',
            name:'DELIVERY_NO',
            className:'text-right', 
          },
          {
              data:'INVOICE_DATE',
              className:'alignRightClass',
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
              },
          },
            { data: "ITEM_NAME",
            render: function (data, type, full, meta) {
                 
                  var cp_code = full['ITEM_NAME']+' - ['+full['ITEM_CODE']+']';

                  return cp_code;
              },

          },
          { data: "QTY",
            className:'alignRightClass',
          },
          { data: "UM" },
          
          {  
            render: function (data, type, full, meta){

                  var enableBtn = 'enable';
                  var deletebtn ='<a href="" class="btn btn-warning btn-xs actionBTN" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID();" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                  return deletebtn;

            }

          },
              
        ],

      });

    });
</script>

<script type="text/javascript">

  function getID(cmpCd,fyCd,tranCd,sereisCd,vrNo){
    var fieldCol = cmpCd+'~'+fyCd+'~'+tranCd+'~'+sereisCd+'~'+vrNo;
    $("#vehicleEntryDelete").modal('show');
    $('#deletvehicle').val(fieldCol);

  }

</script>

@endsection