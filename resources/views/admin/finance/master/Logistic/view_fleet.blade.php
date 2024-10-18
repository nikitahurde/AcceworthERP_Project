@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Fleet 

            <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/view-mast-fleet') }}">Master Fleet</a></li>

            <li class="active"><a href="{{ url('/view-mast-fleet') }}">View  Fleet</a></li>

          </ol>

        </section>

        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Fleet</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/form-mast-fleet') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Fleet</a>

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

                  <!-- ************ Loader ********* -->

                    <div class="modalspinner hideloaderOnModl"></div>

                  <!-- ************ /. Loader ********* -->

                   <div style="text-align: center;">
                      <button class="btn btn-primary" id="syncAllVheId"  data-toggle="modal" data-target="#synckAllVeh" disabled> 
                        &nbsp;<i class="fa fa-random" aria-hidden="true"></i>&nbsp;&nbsp;Sync. All Vehicle&nbsp;&nbsp;
                      </button>
                    </div>
                 

                  <table id="example" class="table table-bordered table-striped table-hover">


                    <thead>

                      <tr>

                        <th class="">Company Code/Name</th>
                        <th class="">VEHICLE NO</th>
                        <th class="">REGD DATE</th>
                        <th class="">MAKE</th>
                        <th class="">MODEL</th>
                        <th class="">WHEELS TYPE</th>
                        <th class="">FREIGHT TYPE CODE</th>
                        <th class="">FREIGHT TYPE NAME</th>
                        <th class="">GROSS WEIGHT</th>
                        <th class="">TARE WEIGHT</th>
                        <th class="">RC WEIGHT</th>
                        <th class="">Load Capacity</th>
                        <th class="">OVERLOAD CPCT</th>
                        <th class="">OVERLOAD AVG</th>
                        <th class="">LOAD CPCT</th>
                        <th class="">LOAD AVG</th>
                        <th class="">UNDERLOAD CPCT</th>
                        <th class="">UNDERLOAD AVG</th>
                        <th class="">EMPTY AVG</th>
                        <th class="">COST CENTER</th>
                        <th class="">CHASIS NO</th>
                        <th class="">MFG YR</th>
                        <th class="">COLOR</th>
                        <th class="">ENGINE NO</th>
                        <th class="">BODY LENGTH</th>
                        
                        <th class="">Status</th>

                        <th class="">Action</th>

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


<!------------- Sync All Vehicle ------>


<div class="modal fade" id="synckAllVeh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align:center;">
        <h4 class="modal-title" id="exampleModalLabel"><span style="color:red;font-weight:600;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;&nbsp;Alert</span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <br>
        <br>
        <span style="font-size: 14px;font-weight: 600;">
          <i class="fa fa-caret-right" aria-hidden="true"></i>&nbsp; 
          Are You Sure ?  You Wnat To Sync. All Vehicle...
        </span>
        <br>
        <br>
      </div>
      <div class="modal-footer" style="text-align:center;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Close&nbsp;&nbsp;</button>
        <button type="button" id="synckAllVehicle" class="btn btn-primary" data-dismiss="modal">&nbsp;&nbsp;<i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;Confirm&nbsp;&nbsp;</button>
      </div>
    </div>
  </div>
</div>


<!---------- /. Sync All Vehicle ------>



<div class="modal fade" id="fleetDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete This Fleet Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



          <form action="{{ url('delete-fleet') }}" method="post">



            @csrf



            <input type="hidden" name="FleetID" id="FleetID" value="">



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
                            columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21]
                      },
                      title: 'MASTER FLEET'+$("#headerexcelDt").val(),
                      filename: 'MASTER_FLEET_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/view-mast-fleet') }}"

       },
       searching : true,
    

       columns: [
        
       
          { 
            render: function (data, type, full, meta){

              var compCode = full['COMP_CODE'];
              var compName = full['COMP_NAME'];

              return compCode+' - '+compName;


            },
            className:"text-center"
          },
          { 
            data:"TRUCK_NO",
            className:"text-left"
          },
          { 
            render: function (data, type, full, meta){ 

              var date = full['REGD_DATE'];


              if(date == '' || date == null){

                return '---';

              }else{
                
                var date = new Date(date);
                var month = date.getMonth() + 1;

                return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
              }
              // var date = new Date(date);
              // var month = date.getMonth() + 1;

              // if(data=='0000-00-00'){
              //   return '00-00-0000';
              // }else{
                 
              // }

            },
            className:"text-right" 
          },
         { data:"MAKE",className:"text-left" },
         { data:"MODEL",className:"text-left" },
         { data:"WHEEL_TYPE",className:"text-left" },
         { data:"FREIGHTTYPE_CODE",className:"text-left" },
         { data:"FREIGHTTYPE_NAME",className:"text-left" },
         { data:"GROSS_WEIGHT",className:"text-right" },
         { data:"TARE_WEIGHT",className:"text-right" },
         { data:"RC_WEIGHT",className:"text-right" },
         { data:"LOAD_CPCT",className:"text-right" },
         { data:"OL_CPCT",className:"text-right" },
         { data:"OL_AVG",className:"text-right" },
         { data:"LOAD_CPCT",className:"text-right" },
         { data:"LOAD_AVG",className:"text-right" },
         { data:"UL_CPCT",className:"text-right" },
         { data:"UL_AVG",className:"text-right" },
         { data:"EMPTY_AVG",className:"text-right" },
         { data:"COST_CODE",className:"text-left" },
         { data:"CHASIS_NO",className:"text-right" },
         { data:"MFG_YR",className:"text-right" },
         { data:"COLOUR",className:"text-right" },
         { data:"ENGINE_NO",className:"text-right" },
         { data:"BODY_LENGTH",className:"text-right" },
         { 
            render: function (data, type, full, meta){


              if(full['FLAG']==0){
                  return '<span class="label label-success">Active</span>';
                }else if(full['FLAG']==1){

                  return '<span class="label label-danger">Inactive</span>';
                }else{

                  return '<span class="label label-danger">Not Found</span>';
                }
                     

                 },
                 className:"text-center"
          },
         
         {  
            render: function (data, type, full, meta){

              $('#syncAllVheId').prop('disabled',false);

              return '<a href="edit-fleet/'+btoa(full['MASTERFLEETID'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                   
            },className:"text-center"
        

       },
         
         
        
      ],

       


     });


    
    /*------- Sync All Vehicle -------*/

    $('#synckAllVehicle').click(function(){

      var syncVel = 'allVehicle';

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            url:"{{ url('/master-fleet-sync-all-vehicle') }}",

            method : "POST",

            type: "JSON",

            data: {syncVel:syncVel},
            beforeSend: function() {
              $('.modalspinner').removeClass('hideloaderOnModl');
            },
            success:function(data){

              var data1 = JSON.parse(data);
              
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'> Not Found...!</p>");

              }else if(data1.response == 'success'){

                console.log(data1.data);

              }


            },
            complete: function() {
              $('.modalspinner').addClass('hideloaderOnModl');

              
            },

            

        });


    });

    /*------- /. Sync All Vehicle -------*/

});
</script>



<script type="text/javascript">

  function getId(id)
  {

    $("#fleetDelete").modal('show');

    $("#FleetID").val(id);

  }

</script>



@endsection



