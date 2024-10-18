@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.crmnavbar')



@include('admin.include.crmsidebar')

<style>
  .box.box-primary {
    border-top-color: #4EBE8A!important;
  }
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .pdfbtndn{
    padding: 2px;
    padding-left: 7px;
    padding-right: 7px;
  }
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
            CRM Quotation
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b> CRM Quotation Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/Transaction/Sales/View-Sales-Quotation-Trans') }}">Master  CRM Quotation</a></li>

            <li class="active"><a href="{{ url('/Transaction/Sales/View-Sales-Quotation-Trans') }}">View  CRM Quotation</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View CRM Quotation</h3>

                 <!--  <div class="box-tools pull-right">

          <a href="{{ url('Transaction/Sales/Sales-Quotation-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add CRM Quotation</a>

          </div> -->

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

                        <th class="text-center">Vr Date.</th>

                        <th class="text-center">Dept Name</th>

                        <th class="text-center">Series Name</th>

                        <th class="text-center">Plant Name</th>

                       <!--  <th class="text-center">Action</th> -->

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







 <div class="modal fade" id="saleQuo_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete This Sale Quotation Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



          <form action="{{ url('/Transaction/Sales/Delete-Sale-Quotation-Trans') }}" method="post">



            @csrf



            <input type="hidden" name="headID" id="headID" value="">
            <input type="hidden" name="bodyID" id="bodyID" value="">



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
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.id+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Item Name</th>'+
            '<th>Qty</th>'+
            '<th>A-Qty</th>'+
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

        url : "{{ url('/Transaction/Crm/View-Crm-Quotation-Trans') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.SQTNHID+')"><i class="fa fa-plus" id="minus'+full.VRNO+''+full.SQTNHID+'" title="Edit"></i></button>'
          }
         },
         { data: "VRNO",className:"text-right" },
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
        render:function(data, type, full, meta){

          return '<button class="btn btn-success pdfbtndn" type="button" id="pdfDown" onclick="downloadPDF('+full['DT_RowIndex']+','+full['SQTNHID']+','+full['VRNO']+',\''+full['TRAN_CODE']+'\');"><i class="fa fa-download" aria-hidden="true"></i></button>';
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

              url:"{{ url('transaction/sales/view-sale-quotation-chield-row-data') }}",

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

                         console.log('objrow',objrow);
                         var srNo=1;
                         var tableid = objrow[0].sale_quotation_head_id;
                       $.each(objrow, function (i, objrow) {

                        if(objrow.approve_remark==null || objrow.approve_remark==''){

                          var approval_btn1 ='<small class="label label-danger"><i class="fa fa-times"></i> No Remark</small>';
                        }else{

                          var approval_btn1 =objrow.approve_remark;
                        }

                        if(objrow.FLAG=='1'){

                          var approval_btn ='<small class="label label-success"><i class="fa fa-check"></i> Approve</small>';
                        }else if(objrow.FLAG=='0'){

                          var approval_btn ='<small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small>';
                        }else{

                          var approval_btn ='<small class="label label-danger"><i class="fa fa-ban"></i> Rejected</small>';
                        }

                          $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td>'+objrow.ITEM_NAME+' <p> ('+objrow.ITEM_CODE+')</p></td><td class="text-right">'+objrow.QTYISSUED+'</td><td class="text-right">'+objrow.AQTYISSUED+'</td></tr>');
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
          console.log('data',data);
          var data1 = JSON.parse(data);
          console.log('data1',data1);
          var fyYear = data1.data[0].FY_CODE;
          var fyCd = fyYear.split('-');
          var seriesCd = data1.data[0].SERIES_CODE;
          var vrNo = data1.data[0].VRNO;
          var fileN = 'SQTN_'+fyCd[0]+''+seriesCd+''+vrNo;
          var link = document.createElement('a');
          link.href = data1.url;
          link.download = fileN+'.pdf';
          link.dispatchEvent(new MouseEvent('click'));
        }

      });
    }
</script>

<script type="text/javascript">
  function saleQuoDelete(headid,bodyid) {

    //alert(id);return false;

    $("#saleQuo_Delete").modal('show');

    $("#headID").val(headid);
    $("#bodyID").val(bodyid);
  }
  
</script>


@endsection



