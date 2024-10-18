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
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
          Lorry Receipt
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Lorry Receipt Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Lorry Receipt</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Lorry Receipt
          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Lorry Receipt</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Logistic/lorry-receipt-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Lorry Receipt</a>

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

                        <th class="text-center">#</th>

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Vr Date.</th>

                        <th class="text-center">Vr No.</th>

                        <th class="text-center">Lr No.</th>

                        <th class="text-center">Vehicle No</th>

                        <th class="text-center">Custmer Name</th>

                        <th class="text-center">From Place / To Place</th>

                        <th class="text-center">Trip Days</th>


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



      You Want To Delete This Delivery Order...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



          <form action="{{ url('/Transaction/Logistic/delete-outward-lr-trans') }}" method="post">



            @csrf



            <input type="text" name="headID" id="headID" value="">



            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">



          </form>



      </div>



    </div>



  </div>



</div>




@include('admin.include.footer')

<script type="text/javascript">

   function format ( d ) {
  //  console.log('d',d.id);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.LRHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Do No</th>'+
            '<th>Do Date</th>'+
            '<th>Lr No</th>'+
            '<th>Lr Date</th>'+
            '<th>Invoice No</th>'+
            '<th>Invoice Date</th>'+
            '<th>Delivery No</th>'+
            '<th>CP Name</th>'+
            '<th>Item Name/Item Code</th>'+
            '<th>Qty</th>'+
            '<th>AQty</th>'+
            '<th>Material Value</th>'+
        '</tr></tbody>'+
    '</table>';
}

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

        url : "{{ url('/Transaction/Logistic/View-lorry-receipt-trans') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.TRIPHID+')"><i class="fa fa-plus" id="minus'+full.VRNO+''+full.TRIPHID+'" title="Edit"></i></button>'
          }
         },
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
           { render: function (data, type, full, meta){

                   
                    var LR_NO = full['LR_NO'];
                    

                      return LR_NO;


                         

          }

          },
          
       {  
            render: function (data, type, full, meta){

                   
                      var VEHICLE_NO = full['VEHICLE_NO'];
                    

                      return VEHICLE_NO;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var series = full['ACC_NAME']+' - ('+full['ACC_CODE']+')';
                    

                      return series;


                         

                     }
        

       },
         
         {  
            render: function (data, type, full, meta){

                   
                      var FROM_PLACE = full['FROM_PLACE']+' - '+full['TO_PLACE'];
                    

                      return FROM_PLACE;
        }
        
       },

       {  
           className:'text-right',
            render: function (data, type, full, meta){

                   
                      var TRIP_DAY = full['TRIP_DAY']; 
                  
                      return TRIP_DAY;


                         

                     }
        

       },
         {  className:'columnwidth',
            render: function (data, type, full, meta){

                    if (full['GATE_OUT_STATUS']=='0' || full['GATE_OUT_STATUS']==0) {

                      var btnStatus = '';

                    }else{

                      var btnStatus = '';

                    }

                      var deletebtn ='<a href="edit-lorry-receipt-trans/'+btoa(full['TRIPHID'])+'" class="btn btn-warning btn-xs" title="edit" '+btnStatus+' style="font-size:10px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" '+btnStatus+' data-toggle="modal" style="font-size:10px;" onclick="return LorryDelete('+full['TRIPHID']+');"><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getLRpdf(\''+full['PLANT_CODE']+'\',\''+full['TRAN_CODE']+'\','+full['TRIPHID']+','+full['TRIP_DAY']+',\''+full['VRDATE']+'\',\''+full['VEHICLE_TYPE']+'\',\''+full['VEHICLE_TYPE_NAME']+'\',\''+full['MODEL']+'\');" style="font-size:10px;"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>';
                    

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

function getLRpdf(PlantCode,trans_code,tripId,trip_days,vrdate,vehicle_type,vehicle_type_name,vehicle_model){

   var supp_lr ='LR';

      $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });


      $.ajax({

              url:"{{ url('/Transaction/Logistic/get-lorry-offline-pdf') }}",

               method : "POST",

               type: "JSON",

               data: {PlantCode: PlantCode,trans_code:trans_code,tripId:tripId,trip_days:trip_days,vrdate:vrdate,vehicle_type:vehicle_type,vehicle_model:vehicle_model,supp_lr:supp_lr,vehicle_type_name:vehicle_type_name},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                          var ulrLenght = data1.url.length;

                     
                        for(var q=0;q<ulrLenght;q++){

                          var fileN     = 'LRTRAN_'+q;
                          
                          var link      = document.createElement('a');
                          link.href = data1.url[q];
                          link.download = 'LRTRAN_.pdf';

                          link.dispatchEvent(new MouseEvent('click'));

                        }




                    }
                      
                  }
               }

          });

}


   function showchildtable(vrno,tblid){
            var vrno,tblid;

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });
             
             $("#minus"+vrno+''+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('/Transaction/Logistic/view-lorry-receipt-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {vrno: vrno,tblid:tblid},

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
                         var tableid = objrow[0].LRHID;
                       $.each(objrow, function (row, objrow) {

                        
                               $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td></td><td class="text-right">'+objrow.DO_NO+'</td></td><td class="text-right" style="width:7%">'+objrow.DO_DATE+'</td></td><td class="text-right">'+objrow.LR_NO+'</td><td class="text-right" style="width:7%">'+objrow.LR_DATE+'</td><td class="text-right">'+objrow.INVC_NO+'</td><td class="text-right" style="width:7%">'+objrow.INVC_DATE+'</td><td class="text-right">'+objrow.DELIVERY_NO+'</td><td>'+objrow.CP_NAME+'-'+objrow.CP_CODE+'</td><td><p>'+objrow.ITEM_NAME+' </p><p style="line-height: 2px;">( '+objrow.ITEM_CODE+')</p></td><td class="text-right">'+objrow.QTY+'</td><td class="text-right">'+objrow.AQTY+'</td><td class="text-right">'+objrow.MATERIAL_VAL+'</td></tr>');
                              srNo++;

                            

                             });

                      }
                      
                  }
               }

          });
    }
</script>

<script type="text/javascript">
  function LorryDelete(id) {

    //alert(id);return false;
    $("#indentDelete").modal('show');
    $("#headID").val(id);
  }
  
</script>


@endsection



