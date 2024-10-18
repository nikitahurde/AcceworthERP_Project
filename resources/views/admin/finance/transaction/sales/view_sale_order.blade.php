@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
  .text-right{
    text-align: right;
  }
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .removeextraSInC{
    padding: 2px !important;
  }
  .pdfbtndn {
    padding: 2px;
    padding-left: 7px;
    padding-right: 7px;
  }
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Sales Order Transaction

           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b>Sales Order Transaction Details</b></small> 

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

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Sales Order Trans</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Sales/Sales-Order-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Sales Order Trans</a>

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

                        <th class="text-center">Vr No.</th>

                        <th class="text-center">Vr Date</th>

                        <th class="text-center">Acc Name</th>

                        <th class="text-center">Series Name</th>
                        
                        <th class="text-center">Plant Name</th>

                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>

                        <th class="text-center">PDF</th>

                        

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



 <div class="modal fade" id="saleOrdrDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



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



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



          <form action="{{ url('/Transaction/Sales/Delete-Sale-Order-Trans') }}" method="post">



            @csrf



            <input type="hidden" name="headID" id="headID" value="">



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
      return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.SORDERHID+'" style="padding-left:50px;">'+
          '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
              '<th class="removeextraSInC">Sr. No.</th>'+
              '<th class="removeextraSInC">Item Code</th>'+
              '<th class="removeextraSInC">Rate</th>'+
              '<th class="removeextraSInC">Qty</th>'+
              '<th class="removeextraSInC">A-Qty</th>'+
              '<th class="removeextraSInC">Basic</th>'+
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
       //"pageLength": 50,
       //"dom": "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",

       ajax:{

        url : "{{ url('/Transaction/Sales/View-Sales-Order-Trans') }}"

       },
       searching : true,
       
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.salehid+')"><i class="fa fa-plus" title="Edit"></i></button>'
          }
         },
         {  
            render: function (data, type, full, meta){
                   
              var fy_code = full['FY_CODE'].split('-');

              var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                    
              return VRNO;
                         
            }  
          },
         { data: "VRDATE" ,
            className:"text-right",
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

                   
                      var series = '<p>'+full['ACC_NAME']+'</p>'+'<p style="line-height:2px;">('+full['ACC_CODE']+')</p>';
                    

                      return series;


                         

                     }
        

       },
          {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['SERIES_NAME']+'</p>'+'<p style="line-height:2px;">('+full['SERIES_CODE']+')</p>';
                    

                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['PLANT_NAME']+'</p>'+'<p style="line-height:2px;">('+full['PLANT_CODE']+')</p>';
                    

                      return series;


                         

                     }
        

       },
        
         {  
            render: function (data, type, full, meta){
              var scntrH = full['SCHLANSTATUSBD'];
              console.log('scntrH',scntrH);
              var splitH = scntrH.split(',');
              var found = splitH.find(function (element) {
                return element>0;
                //return element > 0;
              }); 

              var nextTQty = full['nextTranQty'];
              var spliQty = nextTQty.split(',');
              var foundQty = spliQty.find(function (element) {
                console.log('element',foundQty);
                return element>0.00;
                //return element > 0;
              });

              if((found == undefined) && (foundQty == undefined)){
                  return '<a class="btn btn-danger btn-xs"><i class="fa fa-close" aria-hidden="true"></i> Not Genrated</a>';
              }else{
                return  '<a  class="btn btn-success btn-xs"><i class="fa fa-check" aria-hidden="true"></i> PGI Genrated</a>';
              }


          }
        

       },
        {  
            render: function (data, type, full, meta){
              var scntrH = full['SCHLANSTATUSBD'];
              console.log('scntrH',scntrH);
              var splitH = scntrH.split(',');
              var found = splitH.find(function (element) {
                return element>0;
                //return element > 0;
              }); 

              var nextTQty = full['nextTranQty'];
              var spliQty = nextTQty.split(',');
              var foundQty = spliQty.find(function (element) {
                console.log('element',foundQty);
                return element>0.00;
                //return element > 0;
              });

              if((found == undefined) && (foundQty == undefined)){
                  /*var deletebtn ='<a href="Edit-Sales-Quotation-Trans/'+btoa(full['salehid'])+'/'+btoa(full['SORDER_BODY'])+'/'+btoa(full['VRNO'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return saleQuoDelete('+full['salehid']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                  return deletebtn;*/
                var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                return deletebtn;
              }else{
                var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                return deletebtn;
              }


          }
        

       },
       {
        render:function(data, type, full, meta){

          return '<button class="btn btn-success pdfbtndn" type="button" id="pdfDown" onclick="downloadPDF('+full['DT_RowIndex']+','+full['SORDERHID']+','+full['VRNO']+',\''+full['TRAN_CODE']+'\');"><i class="fa fa-download" aria-hidden="true"></i></button>';
        }
       }
         
         
        
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

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

             $.ajax({

              url:"{{ url('transaction/sales/view-sale-order-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {vrno: vrno,tblid:tblid},

               success:function(data){

                  var data1 = JSON.parse(data);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].SORDERHID;
                         
                       $.each(objrow, function (i, objrow) {
                               $('#childData_'+tableid).append('<tr><td class="text-right removeextraSInC">'+srNo+'</td><td class="removeextraSInC">'+objrow.ITEM_NAME+' <p style="margin: 0px;">( '+objrow.ITEM_CODE+')</p></td><td class="text-right removeextraSInC">'+objrow.RATE+'</td><td class="text-right removeextraSInC">'+objrow.ORDERQTY+'</td><td class="text-right removeextraSInC">'+objrow.ORDERAQTY+'</td><td class="text-right removeextraSInC">'+objrow.BASICAMT+'</td></tr>');
                              srNo++;
                             });

                      }
                      
                  }
               }

          });
    }

    function downloadPDF(uniqNo,headId,vrno,tCode){
      var uniqNo,headId,vrno,tCode;
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

        url:"{{ url('pdf-donwload-when-view-sales-pages') }}",

        method : "POST",

        type: "JSON",

        data: {uniqNo: uniqNo,headId:headId,vrno:vrno,tCode:tCode},

        success:function(data){

          var data1 = JSON.parse(data);
          console.log('data1',data1);
          var fyYear = data1.data[0].FY_CODE;
          var fyCd = fyYear.split('-');
          var seriesCd = data1.data[0].SERIES_CODE;
          var vrNo = data1.data[0].VRNO;
          var fileN = 'SORDER_'+fyCd[0]+''+seriesCd+''+vrNo;
          var link = document.createElement('a');
          link.href = data1.url;
          link.download = fileN+'.pdf';
          link.dispatchEvent(new MouseEvent('click'));
        }

      });
    }
</script>

<script type="text/javascript">
  function saleOrderDelete(id) {

    $("#saleOrdrDelete").modal('show');

    $("#headID").val(id);
  }
  
</script>


@endsection



