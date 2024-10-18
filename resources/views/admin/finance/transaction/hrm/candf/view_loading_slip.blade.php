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

  /* /.----- excel btn css ------ */
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>Loading Slip<small>View Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Master</a></li>

      <li class="active"><a href="{{ url('/transaction/candf/view-loading-slip') }}">Loading Slip</a></li>

      <li class="active"><a href="{{ url('/transaction/candf/view-loading-slip') }}">View Loading Slip</a></li>

    </ol>

  </section>
<!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Loading Slip</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/candf/create-loading-slip') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Loading Slip</a>

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

                  <th class="text-center">Date</th>
                  <th class="text-center">DO NO.</th>
                  <th class="text-center">DO Date</th>
                  <th class="text-center">ITEM_NAME</th>
                  <th class="text-center">QTY</th>
                  <th class="text-center">UM</th>
                  <th class="text-center">VEHICLE_NO</th>
                  <th class="text-center">LOADING SLIP STATUS</th>
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

   <div class="modal fade" id="loadingSlipDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

          <form action="{{ url('/transaction/CandF/delete-loading-slip-without-plan') }}" method="post">

            @csrf

            <input type="hidden" name="deletdata" value="" id="deletloadingSlip">

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
        //scrollY:500,
        scrollX:true,
        paging: true,
         dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
        buttons: [
                  {
                    extend: 'excelHtml5',
                    title: 'loading_slip_list_'+curr_date+'_'+curr_time,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6]
                    }
                  }
                ],
        ajax:{

            url : "{{ url('/transaction/candf/view-loading-slip') }}"

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
              className:'text-right'
          },
          { data: "ORDER_NO",className:'text-right'},
          {
              data:'ORDER_DATE',
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
              },
              className:'text-right'
          },
          { data: "ITEM_NAME",className:'text-left' },
          { data: "QTY",className:'text-right'},
          { data: "UM",className:'text-left'},
          { data: "VEHICLE_NO",className:'text-left'},
          { className:'text-left',
            render: function (data, type, full, meta){
              if(full['LOADING_STATUS'] == 0){
                return '<span class="label label-danger"><i class="fa fa-times" aria-hidden="true"></i> Pending</span>';
              }else if(full['LOADING_STATUS'] == 1){
                return '<span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Complete</span>';
              }else if(full['LOADING_STATUS'] == 2){
                return '<span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Complete</span>';
              }
            }
          },
          {  
            render: function (data, type, full, meta){

                if(full['LR_STATUS'] == 1){

                  var actionbtn ='<a class="btn btn-warning btn-xs actionBTN" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID();" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                  return actionbtn;

                }else if(full['LR_STATUS'] == 0){

                  var actionbtnls ='<a href="Edit-loading-slip/'+btoa(full['COMP_CODE'])+'/'+btoa(full['FY_CODE'])+'/'+btoa(full['TRAN_CODE'])+'/'+btoa(full['SERIES_CODE'])+'/'+btoa(full['VRNO'])+'/'+btoa(full['LOADING_STATUS'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\',\''+full['VRNO']+'\','+full['CFGATEID']+',\''+full['VEHICLE_NO']+'\',\''+full['LOADING_STATUS']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';

                  return actionbtnls;
                  
                }else{

                  var actionbtn ='<a class="btn btn-warning btn-xs actionBTN" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID();" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                  return actionbtn;

                }

                  

                  

            },
            className:'text-center'

          },
              
        ],

      });

    });
</script>

<script type="text/javascript">

  function getID(cmpCd,fyCd,tranCd,sereisCd,vrNo,gateInid,vehicleNo,loadingStatus){
    var fieldCol = cmpCd+'~'+fyCd+'~'+tranCd+'~'+sereisCd+'~'+vrNo+'~'+gateInid+'~'+vehicleNo+'~'+loadingStatus;
    $("#loadingSlipDelete").modal('show');
    $('#deletloadingSlip').val(fieldCol);

  }

</script>

@endsection