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
  .chieldtblecls>tbody>tr>td{
    line-height: 1;
  }
  .columnhide{
  display:none;
}
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
           View Acknowledgment Receipt
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>: LR Acknowledgment Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Lorry Ack Receipt</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Lorry Ack Receipt
          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">LR Acknowledgment Receipt</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Logistic/lr-acknowledgment-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Lorry Ack Receipt</a>

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

                       <!--  <th class="text-center">#</th> -->

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Vr Date.</th>

                        <th class="text-center">Vr No.</th>

                        <th class="text-center">Vehicle No</th>

                        <th class="text-center">LR No</th>

                        <th class="text-center">Custmer Name</th>

                        <th class="text-center">Lorry Receipt Dt</th>

                        <th class="text-center">Delivery Date </th>

                        <th class="text-center">Trip Days </th>

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







 <div class="modal fade" id="lrAcknowledgmentTransDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



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



          <form action="{{ url('/lr-ack-transaction-Delete') }}" method="post">



            @csrf


             
           
            <input type="hidden" name="hidnField" id="fieldTwo" value="">
           


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
    return '<div style="margin-top: 5px;margin-bottom: 4px;"><table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.TRIPHID+'" style="padding-left:40px;width: 95%;margin-left: 1%;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Do No</th>'+
            '<th>Do Date</th>'+
            '<th>Invoice No</th>'+
            '<th>Invoice Date</th>'+
            '<th>Delivery No</th>'+
            '<th>Lr No</th>'+
            '<th>Lr Date</th>'+
            '<th>Item Name/Item Code</th>'+
            '<th>Qty</th>'+
            '<th>Meterial Value</th>'+
        '</tr></tbody>'+
    '</table></div>';
}

   $(document).ready(function(){

     $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

    var getcomName = '<?php echo Session::get('company_name'); ?>';
    var getFY      = '<?php echo Session::get('macc_year'); ?>';
    var getnewdate = new Date();
    var getday = getnewdate.getDate();
    var getMonth = getnewdate.getMonth()+1;
    var getYear = getnewdate.getFullYear();


    var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

    var getdate = getday+''+getMonth+''+getYear;
    

    var t = $("#example").DataTable({

        processing: true,
        serverSide: false,
        info: true,
       // bPaginate: false,
       // scrollY: 500,
       // scrollX: true,
       // scroller: true,
        fixedHeader: true,
        order: [[2, 'asc'],[3, 'asc']],
        columnDefs: [
           { orderable: false, targets:0 }
        ],
        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
        buttons: [
              {
                extend: 'excelHtml5',
                filename: 'LIST_LR_ACKNOWLEDGMENT_'+getdate+'_'+gettime,
                title: getcomName+'\n'+getFY+'\n'+' LIST LR ACKNOWLEDGMENT',
                exportOptions: {
                      columns: [1,2,3,4,5,6,7,8,9]
                }
              }

        ],
       ajax:{

        url : "{{ url('/Transaction/Logistic/View-lr-acknowledgment-trans') }}"

       },
       searching : true,
    

       columns: [
        
         /* { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.TRIPHID+')"><i class="fa fa-plus" id="minus'+full.VRNO+''+full.TRIPHID+'" title="Edit"></i></button>'
          }
         },*/
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
            },
            className:'text-right'
          },

          { 
            render: function (data, type, full, meta){

              var fy_code = full['FY_CODE'].split('-');
                  
              var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
            
              return VRNO;

            },
            className:'text-left'

          },
          
       {  
        data:'VEHICLE_NO',
        name:'VEHICLE_NO',
        className:'text-left'

       },
       { 
        data:'LR_NO',
        name:'LR_NO',
        className:'text-left'

       },
         {  
          data:'ACC_NAME',
          render: function (data, type, full, meta){

            var series = full['ACC_NAME']+' - ('+full['ACC_CODE']+')';

            return series;

          },
          className:'text-left'
        

       },
          {
            data:'LR_DATE',
            className:'text-right',
            render: function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                if(data=='0000-00-00'){
                  return '00-00-0000';
                }else{
                  
                return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                }
            },
            className:'text-right'
          },
          {
            data:'DELIVERY_DATE',
            className:'text-right',
            render: function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                if(data=='0000-00-00'){
                  return '00-00-0000';
                }else{
                  
                return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                }
            },
            className:'text-right'
          },
          { 
          data:'TRIP_ACHIVE_DAY',
          name:'TRIP_ACHIVE_DAY',
          className:'text-right'

          },
          {  
            render: function (data, type, full, meta){

              var enableBtn = 'enable';
              var deletebtn ='<a href="edit-lr-acknowledgment-trans/'+btoa(full['TRIPHID'])+'" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+full['TRIPHID']+');"><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getExppdf(\''+full['ACC_CODE']+'\','+full['TRIPHID']+');"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>';

              return deletebtn;

             },
             className:'text-center'
        
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
                         var tableid = objrow[0].TRIPHID;
                       $.each(objrow, function (row, objrow) {

                        
                               $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td></td><td class="text-right">'+objrow.DO_NO+'</td><td class="text-right">'+objrow.DO_DATE+'</td><td class="text-right">'+objrow.INVC_NO+'</td><td class="text-right">'+objrow.INVC_DATE+'</td><td class="text-right">'+objrow.DELIVERY_NO+'</td></td></td><td class="text-right">'+objrow.LR_NO+'</td></td><td class="text-right">'+objrow.LR_DATE+'</td><td>'+objrow.ITEM_NAME+'-'+objrow.ITEM_CODE+'</td><td class="text-right">'+objrow.QTY+'</td><td class="text-right">'+objrow.MATERIAL_VAL+'</td></tr>');
                              srNo++;

                             });

                      }
                      
                  }
               }

          });
    }
</script>


<script type="text/javascript">

  function getExppdf(AccCode,tripId){



      $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });


      $.ajax({

              url:"{{ url('/Transaction/Logistic/get-lr-acknowledgment-offline-pdf') }}",

               method : "POST",

               type: "JSON",

               data: {AccCode:AccCode,tripId:tripId},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                        var fileN     = 'LRACKPDF_'+1;
                        var link      = document.createElement('a');
                        link.href     = data1.url;
                        link.download = fileN+'.pdf';
                        link.dispatchEvent(new MouseEvent('click'));

                          }
                      
                  }
               }

          });

}

</script>

<script type="text/javascript">
     function dealerDelete(id) {

    //alert(id);return false;

    $("#lrAcknowledgmentTransDelete").modal('show');
    
    var whereField = id;
    //alert(whereField);return false;
    console.log('whereField',whereField);
    
    $("#fieldTwo").val(whereField);
  }
  
</script>


@endsection



