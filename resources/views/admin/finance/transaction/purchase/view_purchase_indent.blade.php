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

  .panel-group .panel-heading {
  padding: 0;
}

.panel-group .panel-heading a {
  display: block;
  padding: 10px 15px;
  text-decoration: none;
  position: relative;
}

.panel-group .panel-heading a:after {
  content: '-';
  float: right;
}

.panel-group .panel-heading a.collapsed:after {
  content: '+';
}
.columnhide{
  display:none;
}
.pdfbtncl{
  padding: 3px;
    padding-right: 7px;
    padding-left: 7px;
}
.removeextraSInC{
    padding: 2px !important;
  }
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
            Purchase Indent
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Purchase Indent Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            
            <li class="active"><a>Transaction</a></li>

            <li class="active"><a href="{{ url('/Transaction/Purchase/View-Purchase-Indent-Trans') }}">View Purchase Indent</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Purchase Indent</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('Transaction/Purchase/Purchase-Indent-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Purchase Indent</a>

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

                        <th class="text-center">Vr Date.</th>

                        <th class="text-center">Dept Name</th>

                        <th class="text-center">Series Name</th>

                        <th class="text-center">Plant Name</th>

                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>

                        <!-- <th class="text-center">PDF</th> -->

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



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



          <form action="{{ url('/Transaction/Purchase/Delete-Purchase-Indent-Trans') }}" method="post">



            @csrf



            <input type="hidden" name="headID" id="headID" value="">
            <input type="hidden" name="bodyID" id="bodyID" value="">
            <input type="hidden" name="rowCount" id="totalRow" value="">



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
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.PINDHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th class="removeextraSInC">Sr. No.</th>'+
            '<th class="removeextraSInC">Item Name</th>'+
            '<th class="removeextraSInC">Qty</th>'+
            '<th class="removeextraSInC">A-Qty</th>'+
            '<th class="hidecolumn class="removeextraSInC"">Approve Remark</th>'+
            '<th class="hidecolumn class="removeextraSInC"">Approve Status</th>'+
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

        url : "{{ url('/Transaction/Purchase/View-Purchase-Indent-Trans') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.PINDHID+')"><i class="fa fa-plus minus" id="minus'+full.VRNO+''+full.PINDHID+'" title="Edit"></i>'
          }
         },
         { render: function (data, type, full, meta){

                   
                   var fy_code = full['FY_CODE'].split('-');
                      

                      var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                    

                      return VRNO;


                         

          }  },
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

                      var series = '<p>'+full['DEPT_NAME']+'</p>'+'<p style="line-height:2px;">('+full['DEPT_CODE']+')</p>';
                    

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
              var scntrH = full['PenqSTATUSBD'];
              var splitH = scntrH.split(',');
              var found = splitH.find(function (element) {
                return element>0;
                //return element > 0;
              }); 
              if(found == undefined){
                  return '<a class="btn btn-danger btn-xs"><i class="fa fa-close" aria-hidden="true"></i> Not Genrated</a>';
              }else{
                return  '<a  class="btn btn-success btn-xs"><i class="fa fa-check" aria-hidden="true"></i> Enquiry Genrated</a>';
              }


          }
        

       },
       {  
            render: function (data, type, full, meta){
              var scntrH = full['PenqSTATUSBD'];
              var splitH = scntrH.split(',');
              var found = splitH.find(function (element) {
                return element>0;
                //return element > 0;
              }); 
              if(found == undefined){
                  /*var deletebtn ='<a href="Edit-Purchase-Indent-Trans/'+btoa(full['indHid'])+'/'+btoa(full['PINDBID'])+'/'+btoa(full['VRNO'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return pIndentDelete('+full['indHid']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                  return deletebtn;*/
                var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                return deletebtn;
              }else{
                var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                return deletebtn;
              }


          }
        

       },
       /*{
        render:function(data, type, full, meta){

          return '<button class="btn btn-success pdfbtncl" type="button" id="pdfDown" onclick="downloadPDF('+full['DT_RowIndex']+','+full['PINDHID']+','+full['VRNO']+',\''+full['TRAN_CODE']+'\');"><i class="fa fa-download" aria-hidden="true"></i></button>';
        }
       }*/
      
        
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

              url:"{{ url('View-Purchase-Indent-Trans-Chield-Row-Data') }}",

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
                         var tableid = objrow[0].PINDHID;
                         var totalRow = objrow.length;
                        //console.log('totalRow',totalRow);
                       $.each(objrow, function (i, objrow) {

                        if(objrow.APPROVE_REMARK==null || objrow.APPROVE_REMARK==''){

                          var approval_btn1 ='<small class="label label-danger"><i class="fa fa-times"></i> No Remark</small>';
                        }else{

                          var approval_btn1 =objrow.APPROVE_REMARK;
                        }

                        if(objrow.FLAG=='1'){

                          var approval_btn ='<td class="text-right">'+approval_btn1+'</td><td class="text-right"><small class="label label-success"><i class="fa fa-check"></i> Approve</small></td>';
                        }else if(objrow.FLAG=='0'){

                          var approval_btn ='<td class="text-right">'+approval_btn1+'</td><td class="text-right"><small class="label label-success"><i class="fa fa-check"></i> Pending</small></td>';
                        }else if(objrow.FLAG=='3'){

                            $(".hidecolumn").addClass('columnhide');
                          var approval_btn ='';
                        }else{

                          var approval_btn ='<small class="label label-danger"><i class="fa fa-ban"></i> Rejected</small>';
                        }

                     

                      $('#childData_'+tableid).append('<tr><td class="text-center hidecolumn">'+srNo+'</td><td class="hidecolumn">'+objrow.ITEM_NAME+' <p> ('+objrow.ITEM_CODE+')</p></td><td class="text-right hidecolumn">'+objrow.QTYRECVD+'</td><td class="text-right hidecolumn">'+objrow.AQTYRECD+'</td>'+approval_btn+'</tr>');
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

        url:"{{ url('pdf-donwload-when-view-purchase-pages') }}",

        method : "POST",

        type: "JSON",

        data: {uniqNo: uniqNo,headId:headId,vrno:vrno,tCode:tCode},

        success:function(data){

          var data1 = JSON.parse(data);

          console.log('data1',data1);
          var link = document.createElement('a');
          link.href = data.url;
          link.download = 'Purchase Quotation.pdf';
          link.dispatchEvent(new MouseEvent('click'));
        }

      });
    }
</script>

<script type="text/javascript">
  function pIndentDelete(id,totRow,bodyid) {

    //alert(id);return false;
    //console.log('totRow',totRow);
    $("#indentDelete").modal('show');

    $("#headID").val(id);
    $("#totalRow").val(totRow);
    $("#bodyID").val(bodyid);
  }
  
</script>


@endsection



