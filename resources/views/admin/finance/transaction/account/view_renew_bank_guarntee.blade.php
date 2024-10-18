@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .columnhide{
  display:none;
}

<style>
.zoom {
  padding: 50px;
  background-color: green;
  transition: transform .2s; /* Animation */
  width: 200px;
  height: 200px;
  margin: 0 auto;
}

.zoom:hover {
  transform: scale(3); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>

</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
           Renew Bank Gurantee
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Bank Gurantee Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Renew Bank Gurantee</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View RenewBank Gurantee</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Renew Bank Gurantee</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Account/Renew-Bank-Guarantee-Tran') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Renew Bank Gurantee</a>

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
                      
                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Vr Date.</th>

                        <th class="text-center">Vr No.</th>

                        <th class="text-center">Bg Number.</th>

                        <th class="text-center">Old Bg Number.</th>

                        <th class="text-center">Pfct Name</th>

                        <th class="text-center">Acc Name</th>

                        <th class="text-center">Series Name</th>

                        <th class="text-center">Plant Name</th>
                        <th class="text-center">Image</th>

                        <th class="text-center">Action</th>

                      </tr>

                      

                    </thead>

                   
                      <?php $srno=1; foreach ($data as $key) {  
                      

                        $imgData = $key->DOCUMENT; 

                        $fyCode = explode('-', $key->FY_CODE);

                        $fyYear = $fyCode[1];

                        $vrNo = $fyYear.' '.$key->SERIES_CODE.' '.$key->VRNO;

                        ?>
                        <tr>
                        <td>{{ $srno }}</td>
                        <td>{{$key->VRDATE}}</td>
                        <td>{{ $vrNo }}</td>
                        <td style="text-align: right;">{{ $key->BG_NO }}</td>
                        <td style="text-align: right;">{{ $key->OLD_BG_NO }}</td>
                        <td>{{$key->PFCT_CODE}} - {{$key->PFCT_NAME}}</td>
                        <td>{{$key->ACC_CODE}} - {{$key->ACC_NAME}}</td>
                        <td>{{$key->SERIES_CODE}} - {{$key->SERIES_NAME}}</td>
                        <td>{{$key->PLANT_CODE}} - {{$key->PLANT_NAME}}</td>
                        <td class="text-center zoom"> <?php if($imgData){ echo '<img src="data:image/jpeg;base64,'.base64_encode($key->DOCUMENT). '" style="height:70px;width:60px"/>';}  ?></td>
                        <td  class="text-center"><a href="Edit-User-Mast/<?php echo base64_encode($key->BGTRANID); ?>" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>
                        </td>

                      </tr>

                     <?php  $srno++; } ?>

                  

                  </table>

                </div><!-- /.box-body -->

              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div>







 <div class="modal fade" id="indentDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete This Delivery Order...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



          <form action="{{ url('/finance/delete-purchase-body-indent') }}" method="post">



            @csrf



            <input type="hidden" name="bodyID" id="bodyID" value="">



            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">



          </form>



      </div>



    </div>



  </div>



</div>


<div class="modal fade" id="deliveryOrderDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



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



          <form action="#" method="POST">

            @csrf

             <!-- Table Head Id/Body Id -->
            <input type="hidden" name="dorderHid" id="headId" value="">
            <input type="hidden" name="dorderBid" id="bodyId" value="">

            <!-- Table Name -->
            <input type="hidden" name="firstTable" id="firstTable" value="DORDER_BODY">
            <input type="hidden" name="secondTable" id="secondTable" value="TRIP_BODY">
            <input type="hidden" name="thirdTable" id="thirdTable" value="CFOUTWARD_TRAN">
            <input type="hidden" name="forthTable" id="forthTable" value="DORDER_HEAD">

            <!-- Table Fields Name -->
            <input type="hidden" name="colNameOne" id="colNameOne" value="DORDERHID">
            <input type="hidden" name="colNameTwo" id="colNameTwo" value="DORDERBID">
            <input type="hidden" name="colNameThree" id="colNameThree" value="DORDER_NO">
            <input type="hidden" name="colNameFour" id="colNameFour" value="DORDER_DATE">
            <input type="hidden" name="colNameFour" id="colNameFive" value="DO_NO">
            <input type="hidden" name="colNameSix" id="colNameSix" value="ORDER_NO">

            <input type="button" value="Delete" id="del_data" style="margin-top: -12%;" class="btn btn-sm btn-danger" disabled="" onclick="funDelData()">



          </form>



      </div>



    </div>



  </div>



</div>




@include('admin.include.footer')

<script type="text/javascript">
  var t = $("#example").DataTable({

  });
</script>

<script type="text/javascript">
  function pindentDelete(id) {

    //alert(id);return false;

    $("#indentDelete").modal('show');

    $("#bodyID").val(id);
  }
  
</script>


@endsection



