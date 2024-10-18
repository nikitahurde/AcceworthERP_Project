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
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
           View Vehicle Inward
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Gate Vehicle Inward Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Vehicle Inward</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Vehicle Inward</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Vehicle Gate Inward</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Logistic/Vehicle-Gate-Inward') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Vehicle Gate Inward</a>

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


                        <th class="text-center">Acc Name</th>

                        <th class="text-center">Series Name</th>

                        <th class="text-center">Plant Name</th>

                        <th class="text-center">Vehicle No</th>

                        <th class="text-center">Driver Mobile</th>

                        <th class="text-center">Delivery No</th>

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

      <!--  DELETE MODAL -->

  <div class="modal fade" id="getInwardDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          You Want To Delete This Get Inward...!

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

          <form action="{{ url('/Transaction/Logistic/Delete-Vehicle-Gate-Inward') }}" method="post">

            @csrf

            <input type="text" name="fieldOne" id="fieldOne" value="">
            <input type="hidden" name="fieldTwo" id="fieldTwo" value="">
            <input type="hidden" name="fieldThree" id="fieldThree" value="">

            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">

          </form>

        </div>

      </div>

    </div>

  </div>

<!--  DELETE MODAL -->



@include('admin.include.footer')

<script type="text/javascript">

  

   $(document).ready(function(){

     $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

    

    var t = $("#example").DataTable({

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/Transaction/Logistic/View-Vehicle-Gate-Inward') }}"

       },
       searching : true,
    

       columns: [
        
          
         { data:"DT_RowIndex",className:"text-center"},

         {
                    data:'VRDATE',
                    className:'text-right',
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
         { render: function (data, type, full, meta){

                   
                   var fy_code = full['FY_CODE'].split('-');
                      

                      var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                    

                      return VRNO;


                         

          }

          },
         
         {  
            render: function (data, type, full, meta){

                      var acc_code = full['TRANSPORTER_CODE'];
               
                      var  acc_name = full['TRANSPORTER_NAME']+'-'+full['TRANSPORTER_CODE'];

                        if(acc_code==null){

                          var transportr_name = '---';

                        }else{

                          var transportr_name = acc_name;
                        }
                    

                      return transportr_name;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                     var series = full['SERIES_NAME']+'-'+full['SERIES_CODE'];
                    
                    

                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var series = full['PLANT_NAME']+'-'+full['PLANT_CODE'];
                    

                      return series;


                         

                     }
        

       },
         {  
             data:"VEHICLE_NO",
             className:"text-center"
         },
        
          {  
             data:"DRIVER_NAME",
             className:"text-center"
         },
         {  
             data:"DRIVER_MOBILE",
             className:"text-center"
         },
         {  
            render: function (data, type, full, meta){

                   
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-vehicle-gate-inward/'+btoa(full['TRIPHID'])+'" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+full['TRIPHID']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                    

                      return deletebtn;

                     }
       },

         
         
        
      ],

       


     });


    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        console.log(tr);
        var row = t.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });



});

   function showchildtable(vrno,tblid){
            var vrno,tblid;

           

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

             $("#minus"+vrno+''+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('view-gate-entry-purchase-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {vrno: vrno,tblid:tblid},

               success:function(data){

                  var data1 = JSON.parse(data);

                  //console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].GRNGATEHID;
                       $.each(objrow, function (row, objrow) {


                        console.log('qtyrcd',objrow.QTYRECD);


                      if(objrow.FLAG=='1' || objrow.FLAG=='0'){
                      
                      var enableBtn = 'enable';
                      var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                    }else{

                        var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-purchase-indent/'+btoa(objrow.GRNGATEHID)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return pindentDelete('+objrow.GRNGATEHID+');"><i class="fa fa-trash" title="Delete"></i></button>';
                    }
                               $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td><p>'+objrow.ITEM_NAME+' </p><p style="line-height: 2px;">( '+objrow.ITEM_CODE+')</p></td><td class="text-right">'+objrow.QTYRECD+'</td><td class="text-right">'+objrow.AQTYRECD+'</td></tr>');
                              srNo++;
                             });

                      }
                      
                  }
               }

          });
    }
</script>

<script type="text/javascript">
  function pindentDelete(id) {

    //alert(id);return false;

    $("#indentDelete").modal('show');

    $("#bodyID").val(id);
  }
  
</script>

<script type="text/javascript">
  function dealerDelete(id) {

    $("#getInwardDelete").modal('show');
    $('#fieldOne').val(id);
    console.log('id',id);


   
  }
  
</script>



@endsection



