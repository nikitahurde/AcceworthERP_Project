@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



@include('admin.include.navbar')



@include('admin.include.sidebar')





  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Comapny 

            <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="#">Master Comapny</a></li>

            <li class="active">View Details</li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

             



              <div class="box">

                <div class="box-header">

                  <h3 class="box-title">View Comapny</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/form-mast-company') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Company</a>

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

                        <th>Sr.NO</th>

                        <th>Company Code</th>

                        <th>Company Name</th>

                        <th>Contact No 1</th>

                        <th>Contact No 2</th>

                        <th>Fax No </th>

                        <th>Email Id</th>

                        <th>Address</th>

                        <th>Country</th>

                        <th>State</th>

                        <th>District</th>

                        <th>City Code</th>

                        

                        <th>Action</th>

                      </tr>

                    </thead>

                    <tbody>

                    	

                       

                      

                    </tbody>

                    <!-- <tfoot>

                      <tr>

                        <th>Rendering engine</th>

                        <th>Browser</th>

                        <th>Platform(s)</th>

                        <th>Engine version</th>

                        <th>CSS grade</th>

                      </tr>

                    </tfoot> -->

                  </table>

                </div><!-- /.box-body -->

              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div>



<?php $sr_no=1; ?>

@foreach($company_list as $key)



<div class="modal fade" id="comapnyDelete_{{ $sr_no }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete This Company Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



          <form action="{{ url('delete-company') }}" method="post">



            @csrf



            <input type="hidden" name="CompanyID" id="CompanyID" value="{{ $key->id }}">



            <input type="submit" value="Delete" style="margin-top: -22%;" class="btn btn-sm btn-danger">



          </form>



      </div>



    </div>



  </div>



</div>

 <?php $sr_no++; ?>

@endforeach



@include('admin.include.footer')



<script type="text/javascript">

    $(function() {

     $("#example").DataTable({

       "scrollX": true,

        "columnDefs": [

        { "width": "8%", "targets": 0 },

        { "width": "10%", "targets": 1 },

        { "width": "8%", "targets": 2 },

        { "width": "8%", "targets": 3 },

        { "width": "10%", "targets": 4 },

        { "width": "10%", "targets": 5 },

        { "width": "10%", "targets": 6 },

        { "width": "10%", "targets": 7 },

        { "width": "10%", "targets": 8 },

        { "width": "10%", "targets": 9 },

        { "width": "10%", "targets": 10 },

        { "width": "10%", "targets": 11 },

        { "width": "10%", "targets": 12 },

      ]



     });



});

</script>



<script type="text/javascript">

  function getId(id)

  {

    alert('hi');return false;

    $("#exampleModalDelete").modal('show');

    $("#DepotID").val(id);

  }

</script



@endsection



