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

            Master Diesel Rate 

            <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/view-manufature')}}">Master Diesel Rate </a></li>

            <li class="Active"><a href="{{ URL('/view-manufature')}}">View Diesel Rate </a></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

             



              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Diesel Rate</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/diesel-rate-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Diesel Rate</a>

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

                        <th class="text-center">Date</th>

                        <th class="text-center">Diesel Rate</th>

                        <th class="text-center">Petrol Rate</th>

                        <th class="text-center">Gas Rate</th>

                        <th class="text-center">Electricity Rate</th>

                        <th class="text-center">Status</th>

                        <th class="text-center">Action</th>

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






<div class="modal fade" id="mfgDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete This Manufacturing Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>



          <form action="{{ url('delete-manufature') }}" method="post">



            @csrf



            <input type="hidden" name="mfgId" id="mfgId" value="">



            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">



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
       //scrollY:500,
       scrollX:true,
       paging: true,
       dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
        buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [0,1,2,3,4,5]
                      },
                      title: 'MASTER DIESEL RATE'+$("#headerexcelDt").val(),
                      filename: 'MASTER_DIESEL_RATE_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/view-diesel-rate-mast') }}"

       },
       searching : true,
    

       columns: [
        
         { data:"DATE",className:"text-right"},
         { data:"DIESEL_RATE",className:"text-right"},
         { render: function (data, type, full, meta){


                  if(full['PETROL_RATE']){
                      return full['PETROL_RATE'];
                    }else{

                      return '--';
                    }
                         

                     },className:"text-right"
          },
         { render: function (data, type, full, meta){


                if(full['GAS_RATE']){
                      return full['GAS_RATE'];
                    }else{

                      return '--';
                    }
                     },className:"text-right"
          },
         { render: function (data, type, full, meta){


                  if(full['ELECT_RATE']){
                      return full['ELECT_RATE'];
                    }else{

                      return '--';
                    }
                         

                     },className:"text-right"
          },
         { render: function (data, type, full, meta){


                  if(full['DIESEL_RATE_BLOCK']=='NO'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['DIESEL_RATE_BLOCK']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },
         
         {  
            render: function (data, type, full, meta){

                    
                   
                      var deletebtn ='<a href="edit-diesel-rate-mast/'+btoa(full['ID'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                    
                      return deletebtn;
                         

                },className:"text-center"
        

       },
         
         
        
      ],

       


     });



});
</script>





<script type="text/javascript">

  function getId(id)

  {

    $("#mfgDelete").modal('show');

    $("#mfgId").val(id);

  }

</script>



@endsection



