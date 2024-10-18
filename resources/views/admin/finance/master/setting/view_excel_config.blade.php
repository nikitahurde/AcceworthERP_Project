@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
   .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
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

            Master Excel Configuration 

            <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/view-manufature')}}">Master Excel Configuration  </a></li>

            <li class="Active"><a href="{{ URL('/Master/Setting/View-Excel-Configuration')}}">View Excel Configuration  </a></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

             



              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Excel Configuration </h3>

                  <div class="box-tools pull-right">

                    <a href="{{ url('/Master/Setting/Excel-Configuration') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Excel Configuration</a>

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

                        <th class="text-center"></th>
                        
                        <!-- <th class="text-center">Sr.No</th>
 -->
                        <th class="text-center">Transaction Code</th>

                        <th class="text-center">Transaction Name</th>

                        <th class="text-center">Excel Config Code</th>

                        <th class="text-center">Excel Config Name</th>

                        <th class="text-center">Table Column</th>

                        <th class="text-center">Excel Column</th>

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






<div class="modal fade" id="mfgDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete This Manufacturing Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>



          <form action="{{ url('delete-manufature') }}" method="post">



            @csrf



            <input type="hidden" name="mfgId" id="mfgId" value="">



            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">



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
                            columns: [1,2,3,4,5,6]
                      },
                      title: ' MASTER EXCEL CONFIG'+$("#headerexcelDt").val(),
                      filename: 'MASTER_EXCEL_CONFIG_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/Setting/View-Excel-Configuration') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" class="actionBTN" onclick="showchildtable(\''+full.TRAN_CODE+'\');"><i class="fa fa-plus" id="minus'+full.TRAN_CODE+'" title="Toggle"></i></button>'
          }
         },
       
         // { data:"DT_RowIndex",className:"text-center"},
         { data:"TRAN_CODE",className:""},
         { 
            render: function (data, type, full, meta){
             
             // var TRANCODE  = full['TRAN_CODE'];
             var TRANNAME  = full['TRAN_NAME'];

             // var TRANCODENAME = TRANNAME;

             return  TRANNAME;


            }
          },
         { data:"EXLCONFIG_CODE" },
         { data:"EXLCONFIG_NAME" },
         { data:"TBL_COL" },
         { data:"EXCEL_COL" },
         {  
            render: function (data, type, full, meta){

              var deletebtn ='<a href="Edit-Excel-Configuration/'+btoa(full['TRAN_CODE'])+'/'+btoa(full['EXLCONFIG_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit" ><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                     
              return deletebtn;
                         

          },className:'text-center'
        

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
  
  return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.TRAN_CODE+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            // '<th>Sr. No.</th>'+
            '<th>Tran NAME/CODE</th>'+
            '<th>TBL COLUMN'+
            '<th>EXCEL COLUMN</th>'+
            '</tr></tbody>'+
    '</table>';
}

 function showchildtable(tran_code){
          
          var tran_code;

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });
             
             $("#minus"+tran_code).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('/view-excel-config-child-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {tran_code:tran_code},

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
                         var tableid = objrow[0].TRAN_CODE ;
                       $.each(objrow, function (row, objrow) {

                        
                         $('#childData_'+tableid).append('<tr><td class="text-left"><p>'+objrow.TRAN_NAME+' [ '+objrow.TRAN_CODE+' ]</p></td><td class="text-left">'+objrow.TBL_COL+'</td><td class="text-left">'+objrow.EXCEL_COL+'</td></tr>');

                           srNo++;

                          });



                      }
                      
                  }
               }

          });
    }

  function getId(id)

  {

    $("#mfgDelete").modal('show');

    $("#mfgId").val(id);

  }

</script>



@endsection



