@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style type="text/css">
  .bg-yellow, .callout.callout-warning, .alert-warning, .label-warning, .modal-warning .modal-body {
    background-color: #ce830c !important;
}

.datebill{
     width: 50px;
     text-align: right;
  }
</style>
  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
            Credit Note Transaction
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Credit Note Transaction Details</b></small>

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

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Credit Note Trans</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Purchase/Credit-Note-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Credit Note Trans</a>

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

                        <th class="text-center">Vr No</th>
                        
                        <th class="text-center">Vr Date</th>

                        <th class="text-center">Acc Name</th>

                        <th class="text-center">Series Name</th>

                        <th class="text-center">Plant Name</th>

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


 <div class="modal fade" id="orderDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete This Credit Note Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



          <form action="{{ url('/finance/delete-purchase-body-order') }}" method="post">



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

    function format(d) {
      //  console.log('d',d.id);
        // `d` is the original data object for the row
        return '<table border="0" class="table table-bordered table-striped table-hover" id="childData_'+d.CRNOTEHID+'" style="padding-left:50px;">'+
            '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
                '<th>Sr. No.</th>'+
                '<th>Item Name</th>'+
                '<th>Qty</th>'+
                '<th>A-Qty</th>'+
                '<th>Rate</th>'+
                '<th>Basic</th>'+
                '<th style="width:10%;">Action</th>'+
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

        url : "{{ url('/Transaction/Purchase/View-Credit-Note-Trans') }}"

       },
       searching : true,
    

       columns: [
        
         { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.CRNOTEHID+')"><i class="fa fa-plus" id="minus'+full.VRNO+''+full.CRNOTEHID+'" title="Edit"></i></button>'
            }
         },
    
         { data: "VRNO" },
         {
                    data:'VRDATE',
                    className:'datebill',
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
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['ACC_CODE']+'</p>'+'<p style="line-height:2px;">('+full['ACC_NAME']+')</p>';
                    

                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['SERIES_CODE']+'</p>'+'<p style="line-height:2px;">('+full['SERIES_NAME']+')</p>';
                    

                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['PLANT_CODE']+'</p>'+'<p style="line-height:2px;">('+full['PLANT_NAME']+')</p>';
                    

                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-dealer/'+btoa(full['CRNOTEHID'])+'/'+btoa(enableBtn)+'" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+full['CRNOTEHID']+');" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                      console.log(full['flag']);

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
    } );



});


function showchildtable(vrno,tblid){
            var vrno,tblid;

           // alert(vrno);

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

             $("#minus"+vrno+''+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('view-credit-note-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {vrno:vrno,tblid:tblid},

               success:function(data){

                  var data1 = JSON.parse(data);

                 

              
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].CRNOTEHID;

                      
                       $.each(objrow, function (i, objrow) {

                         

                      if(objrow.FLAG=='1'|| objrow.FLAG=='0'){
                      
                      var enableBtn = 'enable';
                      var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                    }else{

                        var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-purchase-order/'+btoa(objrow.CRNOTEHID)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return porderDelete('+objrow.CRNOTEBID+');"><i class="fa fa-trash" title="Delete"></i></button>';
                    }
 
                             // console.log(objrow.item_code);

                               $('#childData_'+tableid).append('<tr><td class="text-right">'+srNo+'</td><td>'+objrow.ITEM_NAME+' <p>( '+objrow.ITEM_CODE+')</p></td><td class="text-right">'+objrow.QTYRECD+'</td><td class="text-right">'+objrow.AQTYRECD+'</td><td class="text-right">'+objrow.RATE+'</td><td class="text-right">'+objrow.BASICAMT+'</td><td class="text-right">'+deletebtn+'</td></tr>');
                              srNo++;
                             });

                      }
                      
                  }
               }

          });
    }
</script>

<script type="text/javascript">
  function porderDelete(id) {

    $("#orderDelete").modal('show');

    $("#bodyID").val(id);
  }
  
</script>


@endsection



