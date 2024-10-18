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
  .viewpagein{
    width: 70%;
  }

  @media screen and (max-width: 600px) {

    .viewpagein{
      width: auto;
    }
    .dataTables_filter{
      margin-left: 35%;
    }
    .titleName{
      margin-right: 35% !important;
    }
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
</style>


<div class="content-wrapper">

<!-- Content Header (Page header) -->

<section class="content-header">

<h1>

Sap Bill
 
<small>View Details</small>

</h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/view-sap-bill') }}">SAP Bill</a></li>

            <li class="active"><a href="{{ url('/view-sap-bill') }}">View SAP Bill</a></li>

          </ol>

</section>



<!-- Main content -->

<section class="content">

<div class="row">

<div class="col-xs-12">





<div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle titleName" style="font-weight: 800;color: #5696bb;">View Sap Bill</h3>

<div class="box-tools pull-right">

<a href="{{ url('/form-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Sap Bill</a>

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

<table id="sapbill" class="table table-bordered table-striped table-hover">

  <thead>

    <tr>

      <th class="text-center">Sr.NO</th>

      <th class="text-center">Transaction Date</th>

      <th class="text-center">Transaction No </th>

      <th class="text-center">Invoice No</th>

      <th class="text-center">Customer</th>

      <th class="text-center">Invoice Date</th>

      <th class="text-center">Invoice Qty</th>

      <th class="text-center">Action</th>

    </tr>

  </thead>

</table>

</div><!-- /.box-body -->

</div><!-- /.box -->

</div><!-- /.col -->

</div><!-- /.row -->

</section><!-- /.content -->

</div>



  <div class="modal fade" id="sapbillDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

      <form action="{{ url('/delete-sap-bill') }}" method="post">

      @csrf

            <input type="hidden" name="id" value="" id="getuserid">

            <input type="submit" value="Delete" class="btn btn-sm btn-danger" style="margin-top: -22%;">

          </form>

         </div>

      </div>

    </div>

  </div>


  <div class="modal fade" id="sapbillview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog viewpagein" role="document">

    <div class="modal-content" style="border-radius: 5px;">

      <div class="modal-header">

        <h4 class="modal-title" id="exampleModalLabel" style="font-weight: 800;color: #5696bb;text-align: center;">View Sap Bill</h4>

      </div>

      <div class="modal-body">


               <div class="row">
                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Depot : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-car" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="dept_code" name="dept_code" placeholder="Enter Depot" value="" readonly>

                      </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Invoice Date : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                          </div>

                           <input type="text" class="form-control" id="invoc_date" name="dept_code" placeholder="Enter Invoice Date" value="" readonly>

                      </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Invoice No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="inoc_num" name="dept_code" placeholder="Enter Invoice No" value="" readonly>

                      </div>

                  </div>

                </div><!-- /.col -->


              </div><!-- /.row -->

               <div class="row">
                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Customer : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="customer" name="dept_code" placeholder="Enter Customer" value="" readonly>

                      </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Area / Destination : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="area_dest" name="dept_code" placeholder="Enter Area / Destination" value="" readonly>

                      </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction Date : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="trans_date" name="dept_code" placeholder="Enter Transaction Date" value="" readonly>

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

                           <input type="text" class="form-control" id="trans_num" name="dept_code" placeholder="Enter Transaction No" value="" readonly>

                      </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transporter : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="transport" name="dept_code" placeholder="Enter Transporter " value="" readonly>

                      </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-bus" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="vehicl_num" name="dept_code" placeholder="Enter Vehicle No" value="" readonly>

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

                            <i class="fa fa-book" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="item_name" name="dept_code" placeholder="Enter Item" value="" readonly>

                      </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Inv qty um : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="inv_qty_um" name="dept_code" placeholder="Enter Inv qty um  " value="" readonly>

                      </div>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Inv qty aum : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calendar"></i>

                          </div>

                           <input type="text" class="form-control" id="inv_qty_aum" name="dept_code" placeholder="Enter Inv qty aum" value="" readonly>

                      </div>

                  </div>

                </div><!-- /.col -->


              </div><!-- /.row -->


              <div class="row">
                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Sales Officer : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-book" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" id="sale_offic" name="dept_code" placeholder="Enter Sales Officer" value="" readonly>

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




@include('admin.include.footer')



<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(){


          $('#sapbill').DataTable({

              
              processing: true,
              serverSide: true,
              scrollX: true,
              dom : 'Bfrtip',
              buttons: [
                        'excelHtml5'
                        ],
              columnDefs: [

                            { "width": "10%", "targets": 0, "className": "alignCenterClass"},

                            { "width": "10%", "targets": 1, "className": "alignRightClass"},

                            { "width": "10%", "targets": 2, "className": "alignRightClass"},

                            { "width": "10%", "targets": 3, "className": "alignRightClass"},

                            { "width": "10%", "targets": 4, "className": "alignLeftClass" },

                            { "width": "10%", "targets": 5, "className": "alignRightClass" },

                            { "width": "10%", "targets": 6, "className": "alignRightClass" },

                            { "width": "10%", "targets": 7, "className": "alignCenterClass" }

                          ],
              ajax:{
                url:'{{ url("/view-sap-bill") }}'
              },
              columns: [

                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex'
                },

                {
                    data:'vr_date',
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
                    data:'vr_no',
                    name:'vr_no'
                },
                {
                    data:'invoice_no',
                    name:'invoice_no'
                },
                
                {
                    data:'acc_name',
                    name:'acc_name'
                },
                {
                    data:'invoice_date',
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
                    data:'qty_issued',
                    name:'qty_issued'
                },
                {
                    data:'action',
                    name:'action',orderable: false, searchable: false
                },
                

              ],




          });


       }

  });

</script>

<script type="text/javascript">
  function deletesapbil(id){
      console.log(id);
     
     $('#getuserid').val(id);

  }
</script>


<script type="text/javascript">
  function ViewSapBil(id){
    // var formid = $('#getuserfrmid').val(id);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


      $.ajax({

          url:"{{ url('fetch-sapbill-for-view') }}",

           method : "POST",

           type: "JSON",

           data: {id: id},

           success:function(data){
                //console.log(data);
            
                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                     $('#dept_code').val(data1.data[0].depot_code);
                     $('#invoc_date').val(data1.data[0].invoice_date);
                     $('#inoc_num').val(data1.data[0].invoice_no);
                     $('#customer').val(data1.data[0].acct_code);
                     $('#area_dest').val(data1.data[0].area_code);
                     $('#trans_date').val(data1.data[0].vr_date);
                     $('#trans_num').val(data1.data[0].vr_no);
                     $('#transport').val(data1.data[0].trpt_code);
                     $('#vehicl_num').val(data1.data[0].truck_no);
                     $('#item_name').val(data1.data[0].item_code);
                     $('#inv_qty_um').val(data1.data[0].qty_issued);
                     $('#inv_qty_aum').val(data1.data[0].aqty_issued);
                     $('#sale_offic').val(data1.data[0].so_code);
                   
                }
           }

        });
  }
</script>



@endsection

