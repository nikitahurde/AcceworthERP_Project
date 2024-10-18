@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
    padding:4px;
  }
  .chieldtblecls tbody tr td{
    padding:4px;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
    padding:4px;
  }
  .columnhide{
  display:none;
}

.dtvrdate{
  width:12%;
  text-align:right;
}
.dtvrno{
  width:10%;
}
.dtaccname{
  width:18%;
}


</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
           Freight Sale Quatation
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Freight Sale Quatation Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Freight Sale Quatation</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Freight Sale Quatation</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Freight Sale Quatation</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Logistic/Freight-Sale-Quatation') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Freight Sale Quatation</a>

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

                        <th class="text-center">Vr Date.</th>

                        <th class="text-center">Vr No.</th>

                        <th class="text-center">Acc Name/Acc Code</th>

                        <th class="text-center">Ref No</th>

                        <th class="text-center">Ref Date</th>

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



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



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

   function format ( d ) {
  //  console.log('d',d.id);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.FSQHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>From Place</th>'+
            '<th>To Place</th>'+
            '<th>Vehicle Type</th>'+
            '<th>Valid From Date</th>'+
           '<th>Valid TO Date</th>'+
            '<th>Rate Basis</th>'+
            '<th>Rate</th>'+
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

        url : "{{ url('Transaction/Logistic/view-freight-sale-Quatation') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.FSQHID+')" style="font-size:10px;padding:0px 2px;"><i class="fa fa-plus" id="minus'+full.VRNO+''+full.FSQHID+'" title="Edit"></i></button>'
          }
         },
          {

                    data:'VRDATE',
                    className:'dtvrdate',
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
            className:'dtvrno',
            render: function (data, type, full, meta){

                   
                   var fy_code = full['FY_CODE'].split('-');
                      

                      var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                    

                      return VRNO;


                         

          }

          },
        
         {  className:'dtaccname',
            render: function (data, type, full, meta){

                   
                      var acc = full['ACC_NAME']+' - ('+full['ACC_CODE']+')';
                    

                      return acc;


                         

                     }
        

       },
         {  className:'dtvrno',
            render: function (data, type, full, meta){

                   
                      var ref_no = full['REF_NO']; 
                  
                      return ref_no;


                         

                     }
        

       },
        {  
           
                  
                    data:'REF_DATE',
                    className:'dtvrdate',
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

                   
                    //  var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-freight-sale-Quatation/'+btoa(full['FSQHID'])+'" class="btn btn-warning btn-xs" title="edit" style="font-size:10px;padding:0px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+full['FSQHID']+');"style="font-size:10px;padding:0px 2px;"><i class="fa fa-trash" title="Delete"></i></button> |  <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getfsqLspdf('+full['FSQHID']+',\''+full['ACC_CODE']+'\');"style="font-size:10px;padding:0px 2px;"><i class="fa fa-file-pdf-o" title="PRINT"></i></button> ';
                    

                      return deletebtn;


                         

                     },className:'text-center',
        

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

              url:"{{ url('/Transaction/Logistic/view-freight-sale-Quatation-chield-row-data') }}",

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
                        // console.log('objrow',objrow);
                         var srNo=1;
                         var tableid = objrow[0].FSQHID;
                         console.log('tableid',tableid);
                       $.each(objrow, function (row, objrow) {

                        
                               $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td class="text-center">'+objrow.FROM_PLACE+'</td><td class="text-center">'+objrow.TO_PLACE+'</td><td class="text-center">'+objrow.VEHICLE_TYPE+'</td><td class="text-center">'+objrow.VALID_FROM_DATE+'</td><td class="text-center">'+objrow.VALID_TO_DATE+'</td><td class="text-center">'+objrow.RATE_BASIS+'</td><td class="text-center">'+objrow.RATE+'</td></tr>');
                              srNo++;

                             });

                      }
                      
                  }
               }

          });
    }
</script>

<script type="text/javascript">

   function getfsqLspdf(fsqid,acc_code){

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

      });

      $.ajax({

          url:"{{ url('/Transaction/Logistic/get-freight-loading-quatation-offline-pdf') }}",

          method : "POST",

          type: "JSON",

          data: {fsqid:fsqid,acc_code:acc_code},

          success:function(data){

              var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.data==''){
                   
                  }else{

                   
                     var fileN     = 'FSQSLIP_'+1;
                    var link      = document.createElement('a');
                    link.href     = data1.url;
                    link.download = fileN+'.pdf';
                    link.dispatchEvent(new MouseEvent('click'));

                  }
                  
              }
          }

      });

  }












  function pindentDelete(id) {

    //alert(id);return false;

    $("#indentDelete").modal('show');

    $("#bodyID").val(id);
  }
  
</script>


@endsection



