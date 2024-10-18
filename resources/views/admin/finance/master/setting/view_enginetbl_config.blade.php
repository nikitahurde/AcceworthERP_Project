@extends('admin.main')


@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}"> 

@include('admin.include.navbar')



@include('admin.include.sidebar')


  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Engine Tbl Config Demo

            <small>View Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/configration/view-engine-table-config') }}">Configration</a></li>

            <li class="active"><a href="{{ url('/configration/view-engine-table-config') }}">View Mast Acc Type</a></li>

          </ol>

        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">

              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">List Of Engine Table Config</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/configration/engine-table-config') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Engine Tbl Config</a>

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

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">T-Code </th>

                        <th class="text-center">T-Code Name</th>

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



<div class="modal fade" id="exampleModalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

      * You Want To Delete This Data...! <br>

      </div>

      <div class="modal-footer">

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

          <form action="{{ url('/configration/delete-engine-table-config') }}" method="post">

            @csrf

            <input type="hidden" name="tranCode" id="tranCode" value="">

            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">

          </form>

      </div>

    </div>

  </div>

</div>

@include('admin.include.footer')



<script type="text/javascript">

  function format(d) {
      
      console.log('id',d);
      return '<table border="0" class="table table-bordered table-striped table-hover" id="childData_'+d.TRAN_CODE+'" style="padding-left:50px;">'+
          '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
              '<th>Sr. No.</th>'+
              '<th>TABLE NAME</th>'+
              '<th>COLUMN NAME</th>'+
              '<th>ALIAS</th>'+
              '<th>WHERE CLAUSE</th>'+
              '<th>COLUMN TYPE</th>'+
              '<th>COLUMN LENGTH</th>'+
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

        url : "{{ url('/configration/view-engine-table-config') }}"

       },
       searching : true,
    

       columns: [
        
       
         { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable(\''+full.TRAN_CODE+'\',\''+full.TRAN_CODENAME+'\','+full.ID+')"><i class="fa fa-plus" id="minus'+full.ID+'" title="Edit"></i></button>'
            }
         },
         { data:"TRAN_CODE" },
         { data:"TRAN_CODENAME" },
         { render: function (data, type, full, meta){


                  if(full['FLAG']=='1'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['FLAG']=='0'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },
          {
            render: function (data, type, full, meta){

              var editBtn ='<a href="Edit-Engine-Table-Config/'+btoa(full['TRAN_CODE'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getID(\''+full['TRAN_CODE']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                     
              return editBtn;
                         

            }

          }
       
        
      ],

       


     });


    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        //console.log(tr);
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


    function showchildtable(tCode,tCodeName,srnoRow){
            
        var tCode,tCodeName,srnoRow;

          $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

          });

         $("#minus"+srnoRow).toggleClass('fa-plus fa-minus rotate');

         $.ajax({

          url:"{{ url('view-enginetbl-config-chield-row-data') }}",

           method : "POST",

           type: "JSON",

           data: {tCode:tCode,tCodeName:tCodeName},

           success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){

                  if(data1.data==''){
                   
                  }else{

                     var objrow = data1.data;
                     var srNo=1;
                     var tableid = objrow.ID;

                  
                   $.each(objrow, function (i, objrow) {

                      console.log('data ',objrow.TABLE_NAME);

                      if(objrow.WHERE_CLAUSE == '' || objrow.WHERE_CLAUSE === null){
                        var whereCl = 'Not Found..!';
                      }else{
                        var whereCl = objrow.WHERE_CLAUSE;
                      }
                    
                      $('#childData_'+objrow.TRAN_CODE).append('<tr><td class="text-right">'+srNo+'</td><td>'+objrow.TABLE_NAME+'</td><td>'+objrow.COLUMN_NAME+'</td><td>'+objrow.ALIAS+'</td><td>'+whereCl+'</td><td>'+objrow.COLUMN_TYPE+'</td><td class="text-right">'+objrow.COLUMN_LEN+'</td></tr>');
                        srNo++;
                    });

                  }
                  
              }
           }

      });
    }
</script>

<script type="text/javascript">

  function getID(typeId){


    $("#exampleModalDelete").modal('show');

    $("#tranCode").val(typeId);

  }

</script>

@endsection



