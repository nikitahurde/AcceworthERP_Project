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

  .chieldtblecls>tbody>tr>td {
    line-height: 1.0;
  }
  p {
    margin: 4px 0px 4px;
}
 .boxer {
    display: table;
    border-collapse: collapse;
  }
  .boxer .box-row {
    display: table-row;
  }
  .boxer .box-row:first-child {
    font-weight:bold;
  }
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

            Electronic proof of delivery

            <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/view-mast-fleet') }}">ePOD</a></li>

            <li class="active"><a href="{{ url('/view-mast-fleet') }}">View  ePOD</a></li>

          </ol>

        </section>

        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Electronic proof of delivery </h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/ePOD-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add ePOD</a>

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

                        <th ></th>
                        <th >Sr.No</th>

                        <th class="text-center">Vehical No</th>

                        <th class="text-center">Trip No</th>

                        <th class="text-center">LR No</th>

                        <th class="text-center">Trip Days</th>

                        <th class="text-center">Delivery Date</th>

                        <th class="text-center">Arrival Date</th>

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






<div class="modal fade" id="ePODDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



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



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>



          <form action="{{ url('/ePOD-transaction-Delete') }}" method="post">



            @csrf



            <input type="hidden" name="ePODID" id="ePODID" value="">



            <input type="submit" value="Delete" style="margin-top: -15%;" class="btn btn-sm btn-danger">



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

    

     var t =   $("#example").DataTable({

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/view-ePOD-transaction') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable(\''+full.VEHICLE_NO+'\','+full.TRIPHID +',\''+full.SERIES_CODE+'\','+full.FY_CODE+');"><i class="fa fa-plus" id="minus'+full.TRIPHID+'" title="Toggle"></i></button>'
          }},
         { data:"DT_RowIndex",className:"text-center"},
         { data:"VEHICLE_NO",className:"text-center"},
         { data:"TRIP_NO",className:"text-center"},
         { data:"LR_NO",className:"text-center"},
         { data:"TRIP_DAY",className:"text-center"},

          { render: function (data, type, full, meta){ 

            var delivery_date = full['DELIVERY_DATE'];
            if(delivery_date){
              var deliveryDate = delivery_date.split(" ");
              var date = new Date(deliveryDate[0]);
              var month = date.getMonth() + 1;

              if(data=='0000-00-00'){
              return '00-00-0000';
              }else{
               var deliDate =  date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();

                // var deliTime = deliveryDate[1];

                return deliDate;
              
             }
           }else{
            return '';
           }

         },className:"text-center" },
         
         { render: function (data, type, full, meta){ 

            var va_date = full['ARRIVAL_DATE'];

            if(va_date){
              var dateARr= va_date.split(" ");
              var date = new Date(dateARr[0]);

              var month = date.getMonth() + 1;

              if(data=='0000-00-00'){
              return '00-00-0000';
              }else{

               var veh_ArrDate =  date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
               var arrTime = dateARr[1];
               var arrA= dateARr[2];

               return veh_ArrDate+' '+arrTime+' '+arrA;
              
             }
            }else{
              return '';
            }

         },className:"text-center" },

         {  
            render: function (data, type, full, meta){

              if(full['LR_ACK_STATUS'] == 1){
                return '<a href="#" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';                              
              }else{
                return '<a href="edit-epod-tranaction/'+btoa(full['TRIPHID'])+'/'+btoa(full['EPOD_STATUS'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getId('+full['TRIPHID']+','+full['EPOD_STATUS']+');"><i class="fa fa-trash" title="Delete"></i></button>';
              }

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


</script>



<script type="text/javascript">

  function format ( d ) {
  
  return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.TRIPHID +'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>ITEM NAME/CODE</th>'+
            '<th>REMARK </th></th>'+
            '<th>DO_NO</th>'+
            '<th>LR NO</th>'+
            '<th>DELIVERY NO</th>'+
            '<th>ISSUE QTY</th>'+
            '<th>RECD QTY</th>'+
            '<th>SHORTAGE QTY</th>'+
        '</tr></tbody>'+
    '</table>';
}

 function showchildtable(vehicalNo,tripId,series_code,fycode){
          
          var vehicalNo,tripId,series_code,fycode;


          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });
             
             $("#minus"+tripId).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('/view-epod-tran-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {tripId:tripId},

               success:function(data){

                  var data1 = JSON.parse(data);
                  console.log('data1',data1);

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].TRIPHID  ;
                         var totalRecQty = 0;
                         $.each(objrow, function (row, objrow) {

                          var item_code = objrow.ITEM_CODE;
                          var item_name = objrow.ITEM_NAME;
                          totalRecQty = parseFloat(totalRecQty) + parseFloat(objrow.RECD_QTY);
                          var itemcode_name = item_name+' [ '+ item_code + ' ]';
                        
                          $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td class="text-left"><p>'+itemcode_name+' </p></td><td class="text-left">'+objrow.REMARK+'</td><td class="text-left">'+objrow.DO_NO+'</td><td class="text-left">'+objrow.LR_NO+'</td><td class="text-left">'+objrow.DELORDER_NO+'</td><td class="text-right">'+objrow.QTY+'</td><td class="text-right">'+objrow.RECD_QTY+'</td><td class="text-right">'+objrow.SHORTAGE_QTY+'</td></tr>');

                          srNo++;

                        });
                        
                         $('#childData_'+tableid).append('<tr><td colspan="7" class="text-right"><b>Total</b></td><td class="text-right">'+totalRecQty.toFixed(3)+'</td><td class="text-right"></td></tr>');


                      }
                      
                  }
               }

          });
    }

  function getId(tripHeadId,EpodStatus)
  {
    var dataM = tripHeadId+'~'+EpodStatus;
    $("#ePODDelete").modal('show');

    $("#ePODID").val(dataM);

  }

</script>



@endsection



