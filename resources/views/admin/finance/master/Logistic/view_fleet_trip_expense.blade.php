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
 .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
}
.required-field::before {

    content: "*";

    color: red;

  }
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
         Master Fleet Trip Expense
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Fleet Trip Expense</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Fleet Trip Expense</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Fleet Trip Expense</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/form-fleet-trip-expense') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Fleet Trip Expense</a>

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

                       
                        <th class="text-center">KM</th>

                        <th class="text-center">Expense Head Code</th>

                        <th class="text-center">Expense Head</th>

                        <th class="text-center">Expense Index</th>

                        <th class="text-center">Rate</th>

                        <th class="text-center">Gl Code</th>

                        <th class="text-center">Status</th>

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



      You Want To Delete This Purchase Indent Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>



          <form action="{{ url('/finance/delete-purchase-body-indent') }}" method="post">



            @csrf



            <input type="hidden" name="bodyID" id="bodyID" value="">



            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">



          </form>



      </div>



    </div>



  </div>



</div>



@include('admin.include.footer')



<script type="text/javascript">
   $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });
</script>





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
                            columns: [0,1,2,3,4,5,6]
                      },
                      title: 'MASTER FLEED TRIP EXPENSE'+$("#headerexcelDt").val(),
                      filename: 'MASTER_FLEED_TRIP_EXPENSE_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/view-fleet-trip-expense') }}"

       },
       searching : true,
    

       columns: [
       
         { data:"KM", className:"text-right"},
         { data:"FLEETIND_CODE"},
         { data:"FLEETIND"},
         // { render: function (data, type, full, meta){

         //    var fleetInd = full['FLEETIND'];
         //    var fleetInd_code = full['FLEETIND_CODE'];

         //    var fleetIndCode = fleetInd + ' [ '+ fleetInd_code + ' ]';
         //    return  fleetIndCode;

         //  }
         // },
         { data:"FLEETINDEX" },
         { data:"RATE", className:"text-right" },
         { data:"GL_CODE" },
         { render: function (data, type, full, meta){


                  if(full['BLOCK_TRIPEXP']=='NO'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['BLOCK_TRIPEXP']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },
                    className:"text-center"
          },
         {  
            render: function (data, type, full, meta){
                   
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-fleet-trip-expense/'+btoa(full['KM'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return dealerDelete('+full['KM']+');" disabled><i class="fa fa-trash" title="Delete"></i></button>'; 

                      return deletebtn;
              },
                    className:"text-center"
        
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


  function getVrno(vrno){

    $("#jobcard_no").val(vrno);

  }

   function showchildtable(wheel_code,tblid){
            var wheel_code,tblid;

      //  alert(id);return false;
           

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });
             
             $("#minus"+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('view-truck-wheel-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {wheel_code:wheel_code},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].FLEET_TYPE;
                       $.each(objrow, function (row, objrow) {

                        
                         $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td class="text-center"><p>'+objrow.FLEETIND+' </p></td><td class="text-center">'+objrow.FLEETINDEX+'</td><td class="text-right">'+objrow.RATE+'</td><td class="text-right">'+objrow.GL_CODE+'</td></tr>');
                              srNo++;

                          });

                      }
                      
                  }
               }

          });
    }
</script>

<script type="text/javascript">
  
  function downloadPDF(uniqNo,headId,vrno,tCode){


      var uniqNo,headId,vrno,tCode;
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

        url:"{{ url('pdf-donwload-when-view-jobcard-pages') }}",

        method : "POST",

        type: "JSON",

        data: {uniqNo: uniqNo,headId:headId,vrno:vrno,tCode:tCode},

        success:function(data){
          console.log('data',data);
          var data1 = JSON.parse(data);
          console.log('data1',data1);
          console.log('data1',data1);
          var fyYear = data1.data[0].FY_CODE;
          var fyCd = fyYear.split('-');
          var seriesCd = data1.data[0].SERIES_CODE;
          var vrNo = data1.data[0].VRNO;
          var fileN = 'JOBCARD_'+fyCd[0]+''+seriesCd+''+vrNo;
          var link = document.createElement('a');
          link.href = data1.url;
          link.download = fileN+'.pdf';
          link.dispatchEvent(new MouseEvent('click'));
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
  
  function validation(){

     var closing_dt = $("#closing_dt").val();

     if(closing_dt==''){

          $("#closing_err").html('This field is required');
          return false;
     }else{

        $("#closing_err").html('');
         
     }

  }

</script>

@endsection



