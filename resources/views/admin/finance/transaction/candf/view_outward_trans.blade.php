@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')


<style type="text/css">
  
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

<h1>

Outward Transaction

<small>View Details</small>

</h1>

<ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/view-outward-trans') }}">Outward Trans</a></li>

            <li class="active"><a href="{{ url('/view-outward-trans') }}">View Outward Trans</a></li>

          </ol>

</section>



<!-- Main content -->

<section class="content">

<div class="row">

<div class="col-xs-12">





<div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Outward</h3>

<div class="box-tools pull-right">

<a href="{{ url('/transaction/CandF/add-outward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Outward Trans</a>

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

<table id="OutwardTrans" class="table table-bordered table-striped table-hover">

  <thead>

    <tr>

      <th class="text-center">Sr.NO</th>

      <th class="text-center">Vehicle No</th>

      <th class="text-center">Vr Date </th>

      <th class="text-center">VRNO</th>

      <th class="text-center">LR NO</th>

      <th class="text-center">LR DATE</th>
      <th class="text-center">BATCH NO</th>
      <th class="text-center">WAGON NO</th>
      <th class="text-center">INVOICE NO</th>

      <th class="text-center">ACC NAME</th>

      <th class="text-center">CP NAME</th>

      <th class="text-center">SP NAME</th>

      <th class="text-center">TRANSPORTER NAME</th>

      <th class="text-center">FROM PLACE</th>

      <th class="text-center">TO PLACE</th>

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


<!-- delete record -->

  
  <div class="modal fade" id="OutwardTranssDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

       <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

      <form action="{{ url('/delete-outward-trans') }}" method="post">

      @csrf

            <input type="hidden" name="id" value="" id='getuserid'>

            <input type="submit" value="delete" class="btn btn-sm btn-danger" style="margin-top: -22%;">

          </form>

         </div>

      </div>

    </div>

  </div>

<!-- delete record -->


<!-- view model -->

<div class="modal fade" id="outwardtransView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog viewpagein" role="document">

    <div class="modal-content" style="border-radius: 5px;">

      <div class="modal-header">

        <h4 class="modal-title" id="exampleModalLabel" style="font-weight: 800;color: #5696bb;text-align: center;">View Outward Transaction</h4>

      </div>

      <div class="modal-body">

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Company Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="company_code" name="comp_code" placeholder="Enter Company Name" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">fiscal Year : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="fisacal_year" name="comp_code" placeholder="Enter fiscal Year" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction Date : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="transaction_date" name="comp_code" placeholder="Enter Transaction Date" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Depot Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="depot_code" name="comp_code" placeholder="Enter Depot Code" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="account_Code" name="comp_code" placeholder="Enter Account Code" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Area Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="areaCode" name="comp_code" placeholder="Enter Area Code" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->


              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="trans_number" name="comp_code" placeholder="Enter Transaction No" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Despatch Type : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="desptch_type" name="comp_code" placeholder="Enter Despatch Type" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Invoice No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="invoiceNum" name="comp_code" placeholder="Enter Invoice No" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->


              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Item : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-ship" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="item_name" name="comp_code" placeholder="Enter Item" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Despatch Quantity : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                           <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="desptch_qty" name="comp_code" placeholder="Enter Despatch Quantity" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Despatch AQuantity : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="desptach_aqty" name="comp_code" placeholder="Enter Despatch AQuantity" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-car" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="vehicl_num" name="comp_code" placeholder="Enter Vehicle No" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transport : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-truck" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="transport" name="comp_code" placeholder="Enter Transport" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Challan No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                           <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="chalan_num" name="comp_code" placeholder="Enter Challan No" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->


              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Driver Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-car" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="driver_name" name="driver_name" placeholder="Enter Driver Name" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Driver Contact Number : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-truck" aria-hidden="true"></i>

                          </div>
                         
                          <input type="text" class="form-control" id="driver_number" name="driver_number" placeholder="Enter Driver Contact Number" value="" readonly>

                        </div>

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->

          </div>
          <div class="modal-footer" style="text-align: center;">

            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancle</button>

          </div>
        </div>
      </div>
    </div>


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

          <form action="{{ url('/transaction/CandF/delete-outward-lr-trans') }}" method="post">

            @csrf

            <input type="hidden" name="deletdata" value="" id="deletloadingSlip">

            <input type="submit" value="Delete" class="btn btn-sm btn-danger" style="margin-top: -20%;">

          </form>

        </div>

      </div>

    </div>

  </div>


<!-- view model -->


@include('admin.include.footer')




<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(){

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

          $('#OutwardTrans').DataTable({

              
              processing: true,
              serverSide: false,
              scrollX: true,
              paging: true,
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
              buttons: [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14]
                      },
                      title: 'OUTWARD_TRANSACTION'+$("#headerexcelDt").val(),
                      filename: 'OUTWARD_TRANSACTION'+$("#headerexcelDt").val(),
                    }
                  ],
              columnDefs: [

                            { "width": "5%", "targets": 0, "className": "alignCenterClass"},

                            { "width": "5%", "targets": 1, "className": "alignLeftClass"},

                            { "width": "5%", "targets": 2, "className": "alignRightClass"},

                            { "width": "5%", "targets": 3, "className": "alignRightClass"},

                            { "width": "5%", "targets": 4, "className": "alignRightClass" },

                            { "width": "5%", "targets": 5, "className": "alignRightClass" },

                            { "width": "15%", "targets": 6, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 7, "className": "alignCenterClass" },
                            { "width": "10%", "targets": 8, "className": "alignCenterClass" },
                            { "width": "10%", "targets": 9, "className": "alignCenterClass" },
                            { "width": "10%", "targets": 10, "className": "alignCenterClass" },
                            { "width": "10%", "targets": 11, "className": "alignCenterClass" },
                            { "width": "5%", "targets": 12, "className": "alignCenterClass" },
                            

                          ],
              ajax:{
                url:'{{ url("/transaction/CandF/view-outward-trans") }}'
              },
              columns: [

                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex'
                },

                {
                    data:'VEHICLE_NO',
                    name:'VEHICLE_NO'
                },
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
                  }
                },
                {
                    data:'VRNO',
                    name:'VRNO'
                },
                
                {
                    data:'LR_NO',
                    name:'LR_NO'
                },
                {
                    data:'LR_DATE',
                    name:'LR_DATE'
                },
                {
                    data:'BATCH_NO',
                    name:'BATCH_NO'
                },
                {
                    data:'WAGON_NO',
                    name:'WAGON_NO'
                },{
                    data:'INVOICE_NO',
                    name:'INVOICE_NO'
                },
                {
                     render: function (data, type, full, meta) {

                      var accName = full['ACC_NAME']+' - '+full['ACC_CODE'];
                      
                      return accName;
                      
                    }
                  
                },
                {
                    render: function (data, type, full, meta) {

                      var accName = full['CP_NAME']+' - '+full['CP_CODE'];
                      
                      return accName;
                      
                    }
                },
                {
                    render: function (data, type, full, meta) {

                      var accName = full['SP_NAME']+' - '+full['SP_CODE'];
                      
                      return accName;
                      
                    }
                },
                {
                   render: function (data, type, full, meta) {

                      var accName = full['TRPT_NAME']+' - '+full['TRPT_CODE'];
                      
                      return accName;
                      
                    }
                },
                 {
                   render: function (data, type, full, meta) {

                      var fromPlace = full['FROM_PLACE'];
                      
                      return fromPlace;
                      
                    }
                },
                 {
                   render: function (data, type, full, meta) {

                      var toPlace = full['TO_PLACE'];
                      
                      return toPlace;
                      
                    }
                },
                {  
            render: function (data, type, full, meta){

                      console.log(full['VEHICLE_OUT_DATETIME']);

                      var deletebtn ='<a href="Edit-outward-lorry/'+btoa(full['TRAN_CODE'])+'/'+btoa(full['VRNO'])+'/'+btoa(full['SERIES_CODE'])+'/'+btoa(full['COMP_CODE'])+'/'+btoa(full['FY_CODE'])+'/'+btoa(full['TRPT_TYPE'])+'" class="btn btn-warning btn-xs" title="edit" style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\',\''+full['VRNO']+'\','+full['CFGATEID']+',\''+full['VEHICLE_NO']+'\',\''+full['TRIPHID']+'\',\''+full['TRPT_TYPE']+'\');"><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getLRpdf(\''+full['PLANT_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['TRPT_TYPE']+'\',\''+full['VEHICLE_NO']+'\','+full['VRNO']+',\''+full['TRPT_CODE']+'\',\''+full['TRPT_NAME']+'\','+full['TRIP_DAYS']+',\''+full['TRIP_DATE']+'\',\''+full['VEHICLE_TYPE']+'\',\''+full['VEHICLE_MODEL']+'\',\''+full['CFOUTWARDID']+'\',\''+full['CFOUTWARDID']+'\');"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>';

                    if(full['VEHICLE_OUT_DATETIME']==null){
                      var deletebtn ='<a href="Edit-outward-lorry/'+btoa(full['TRAN_CODE'])+'/'+btoa(full['VRNO'])+'/'+btoa(full['SERIES_CODE'])+'/'+btoa(full['COMP_CODE'])+'/'+btoa(full['FY_CODE'])+'/'+btoa(full['TRPT_TYPE'])+'" class="btn btn-warning btn-xs" title="edit" style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\',\''+full['VRNO']+'\','+full['CFGATEID']+',\''+full['VEHICLE_NO']+'\',\''+full['TRIPHID']+'\',\''+full['TRPT_TYPE']+'\');"><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getLRpdf(\''+full['PLANT_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['TRPT_TYPE']+'\',\''+full['VEHICLE_NO']+'\','+full['VRNO']+',\''+full['TRPT_CODE']+'\',\''+full['TRPT_NAME']+'\','+full['TRIP_DAYS']+',\''+full['TRIP_DATE']+'\',\''+full['VEHICLE_TYPE']+'\',\''+full['VEHICLE_MODEL']+'\',\''+full['CFOUTWARDID']+'\',\''+full['CFOUTWARDID']+'\');"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>';

                    }else{
                       var deletebtn ='<a href="Edit-outward-lorry/'+btoa(full['TRAN_CODE'])+'/'+btoa(full['VRNO'])+'/'+btoa(full['SERIES_CODE'])+'/'+btoa(full['COMP_CODE'])+'/'+btoa(full['FY_CODE'])+'/'+btoa(full['TRPT_TYPE'])+'" class="btn btn-warning btn-xs" title="edit" style="font-size: 10px; padding: 2px 2px;" ><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\',\''+full['VRNO']+'\','+full['CFGATEID']+',\''+full['VEHICLE_NO']+'\',\''+full['TRIPHID']+'\',\''+full['TRPT_TYPE']+'\');" disabled><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getLRpdf(\''+full['PLANT_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['TRPT_TYPE']+'\',\''+full['VEHICLE_NO']+'\','+full['VRNO']+',\''+full['TRPT_CODE']+'\',\''+full['TRPT_NAME']+'\','+full['TRIP_DAYS']+',\''+full['TRIP_DATE']+'\',\''+full['VEHICLE_TYPE']+'\',\''+full['VEHICLE_MODEL']+'\',\''+full['CFOUTWARDID']+'\',\''+full['CFOUTWARDID']+'\');"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>';
                    }

                     
                    

                      return deletebtn;


                         

                     }
        

       },
                

              ],




          });


       }


  });

</script>

<script type="text/javascript">

  function getID(cmpCd,fyCd,tranCd,sereisCd,vrNo,gateInid,vehicleNo,tripHid,trptType){
    var fieldCol = cmpCd+'~'+fyCd+'~'+tranCd+'~'+sereisCd+'~'+vrNo+'~'+gateInid+'~'+vehicleNo+'~'+tripHid+'~'+trptType;
    $("#loadingSlipDelete").modal('show');
    $('#deletloadingSlip').val(fieldCol);

  }

</script>

<script type="text/javascript">
  function getLRpdf(PlantCode,trans_code,tripType,vehicleNo,vrno,trptCode,trptName,tripDays,tripDate,vehicleType,outwardid,triphid){

      $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

       var supp_lr ='LR';
       
      $.ajax({

              url:"{{ url('/Transaction/Logistic/get-outward-lorry-offline-pdf') }}",

               method : "POST",

               type: "JSON",

               data: {PlantCode: PlantCode,trans_code:trans_code,tripType:tripType,vehicleNo:vehicleNo,vrno:vrno,trptCode:trptCode,trptName:trptName,tripDays:tripDays,tripDate:tripDate,vehicleType:vehicleType,outwardid:outwardid,supp_lr:supp_lr,triphid:triphid},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         /*var fileN     = 'LRTRAN_'+1;
                        var link      = document.createElement('a');
                        link.href     = data1.url;
                        link.download = fileN+'.pdf';
                        link.dispatchEvent(new MouseEvent('click'));*/

                        var ulrLenght = data1.url.length;
                     
                        for(var q=0;q<ulrLenght;q++){

                          var fileN     = 'LORRY_RECIEPT_'+$("#headerexcelDt").val();
                          
                          var link      = document.createElement('a');
                          link.href = data1.url[q];
                          link.download = fileN+'.pdf';

                          link.dispatchEvent(new MouseEvent('click'));

                        }

                      }
                      
                  }
               }

          });

}
</script>

<script type="text/javascript">
  function deleteoutwrd(id){
      $('#getuserid').val(id);
  }
</script>

<script type="text/javascript">
  function outwardView(id){
    // var formid = $('#getuserfrmid').val(id);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $.ajax({

          url:"{{ url('fetch-otwardrecord-for-view') }}",

           method : "POST",

           type: "JSON",

           data: {id: id},

           success:function(data){
               // console.log(data);
            
                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                    //console.log(data1.data[0]);
                  $('#company_code').val(data1.data[0].comp_code);
                  $('#fisacal_year').val(data1.data[0].fy_year);
                  $('#transaction_date').val(data1.data[0].tr_date);
                  $('#depot_code').val(data1.data[0].depot_code);
                  $('#account_Code').val(data1.data[0].acc_code);
                  $('#areaCode').val(data1.data[0].area_code);
                  $('#trans_number').val(data1.data[0].tr_no);
                  $('#desptch_type').val(data1.data[0].desp_type);
                  $('#invoiceNum').val(data1.data[0].inv_no);
                  $('#item_name').val(data1.data[0].item_code);
                  $('#desptch_qty').val(data1.data[0].desp_qty);
                  $('#desptach_aqty').val(data1.data[0].desp_aqty);
                  $('#vehicl_num').val(data1.data[0].truck_no);
                  $('#transport').val(data1.data[0].trans_code);
                  $('#chalan_num').val(data1.data[0].chalan_no);
                  $('#driver_name').val(data1.data[0].driver_name);
                  $('#driver_number').val(data1.data[0].driver_number);

                

                }
           }

        });
  }
</script>


@endsection
