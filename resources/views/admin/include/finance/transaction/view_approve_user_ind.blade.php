@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
            Purchase Order Transaction
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Purchase Order Transaction Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Master Account</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Mast Acc</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Purchase Order Trans</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/finance/transaction/purchase-order-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Purchase Order Trans</a>

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

                  <table id="example1" class="table table-bordered table-striped table-hover">

                    <thead>

                      <tr>

                         <th class="text-center">Sr.NO</th>


                        <th class="text-center">Tran Code</th>

                        <th class="text-center">Series code</th>

                        <th class="text-center">Vr.No</th>

                        <th class="text-center">Account Code</th>
                        
                        

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




<div class="modal fade" id="purchaseDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">



        <h3 class="modal-title" id="exampleModalLabel" style="font-size: 17px;">You Want To Approved This  Data...!</h3>



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>

 <form action="{{ url('change-status-purchase-order') }}" method="post">



            @csrf

      <div class="modal-body">



            <input type="hidden" name="UserID" id="UserID" value="">
              <div class="row">
              <div class="col-md-12">



                    <div class="form-group">



                      <label>



                        Remark : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <input type="text" class="form-control" name="approve_remark">
                         



                      </div>





                    </div>



                    <!-- /.form-group -->



                  </div>
                </div>

           



         


      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancle</button>


             <input type="submit" value="Ok" class="btn btn-sm btn-primary">




      </div>

       </form>



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

    

    var t = $("#example1").DataTable({

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/finance/transaction/purchase-order-approval') }}"

       },
       searching : true,
    

       columns: [
        
       
         { data:"DT_RowIndex",className:"text-center"},
         { data: "tran_code" },
         { data: "series_code"},
         { data: "vr_no" },
         { data: "acc_code" },
        
         {  data :"action" },

         
         
        
      ],

       


     });



});
</script>

<script type="text/javascript">
  function changeStatus(userid) {

    //alert(userid);return false;

    $("#purchaseDelete").modal('show');

    $("#UserID").val(userid);
  }
  
</script>


@endsection



