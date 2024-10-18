@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
  
  .text-center{
    text-align: center;
  }
  .text-right{
    text-align: right;
  }
  .notification {
    background-color: #3c8dbc;
    color: white;
    text-decoration: none;
    padding: 2px 4px;
    position: relative;
    display: inline-block;
    border-radius:3px;
  }
  .notification .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    padding: 2px 6px;
    border-radius: 50%;
    background-color: red;
    color: white;
  }
  .viewaccnot{
    font-size: 12px;
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
  .boxer .box10 {
    display: table-cell;
    vertical-align: top;
    border: 1px solid #ddd;
    padding: 5px;
  }
  
   .texIndbox1{
    width: 5%; 
    text-align: center;
  }
  .rateIndbox{
    width: 15%;
    text-align: center;
  }
  .itmdetlheading{
    vertical-align: middle !important;
    text-align: left;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .removeextraSInC{
    padding: 2px !important;
  }
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            User Profile Right

           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b>Enquiry Transaction Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> User Profile Right </a></li>

            <li class="active"><a href="{{ url('/master/setting/view-user-profile-right') }}">View User Profile Right</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View User Profile Right</h3>

                  <div class="box-tools pull-right">

                    <a href="{{ url('/master/setting/user-profie-right') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add User Profile Right</a>

                  </div>

                </div><!-- /.box-header -->



            @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 1%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-check"></i>

                  Success...!

                </h4>

                 {!! session('alert-success') !!}

              </div>

            @endif


            @if(Session::has('alert-error'))

              <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 1%;">

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

                        <th class="text-center">User Profile Code</th>

                        <th class="text-center">User Profile Name</th>
                      
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



 <div class="modal fade" id="usrProfDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        You Want To Delete This...!

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

          <form action="{{ url('/master/setting/delete-user-profile-right') }}" method="post">

            @csrf

            <input type="hidden" name="profCode" id="profCode" value="">
            <input type="hidden" name="profID" id="profID" value="">
            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">

          </form>

      </div>

    </div>

  </div>

</div>




@include('admin.include.footer')

<script type="text/javascript">

   function format ( d ) {
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.ID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th class="removeextraSInC">Sr. No.</th>'+
            '<th class="removeextraSInC">Form Name</th>'+
            '<th class="removeextraSInC">Add Form</th>'+
            '<th class="removeextraSInC">Edit Form</th>'+
            '<th class="removeextraSInC">Delete Form</th>'+
            '<th class="removeextraSInC">View Form</th>'+
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
                            columns: [1,2,3]
                      },
                      title: ' MASTER USER PROFILE RIGHT'+$("#headerexcelDt").val(),
                      filename: 'MASTER_USER_PROFILE_RIGHT_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/master/setting/view-user-profile-right') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.ID+',\'' + full.PROFILE_CODE+ '\')"><i class="fa fa-plus" id="minus'+full.ID+''+full.PROFILE_CODE+'" title="Edit"></i></button>'
            }
          },
        
          { render: function (data, type, full, meta){
                   
             return full['PROFILE_CODE'];       

            } 
          },

          {  
            render: function (data, type, full, meta){

                 return full['PROFILE_NAME'];
        
            }
          },

          {  
            render: function (data, type, full, meta){

              var getflag = full['FLAG'];

              if(getflag != 1){
                  return '<a class="btn btn-danger btn-xs">Unactive</a>';
              }else{
                return  '<a  class="btn btn-success btn-xs"> Active</a>';
              }
        
            }
          },

          {  
            render: function (data, type, full, meta){

              var getflag = full['FLAG'];

              if(getflag == 1){

                  var deletebtn ='<a href="/edit-user-profile-right/'+btoa(full['ID'])+'/'+btoa(full['PROFILE_CODE'])+'/'+btoa(full['PROFILE_NAME'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return profUsrDelete('+full['ID']+','+full['PROFILE_CODE']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                  return deletebtn;

              }else{
                var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                return deletebtn;
              }
        
            }
          },
        
      ],

       


     });

    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
       // console.log(tr);
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

   function showchildtable(profID,profCode){

            var profID,profCode;

            console.log('prof',profCode);

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $("#minus"+profCode).toggleClass('fa-plus fa-minus rotate');

            $.ajax({

              url:"{{ url('master/setting/view-child-user-profile-right') }}",

              method : "POST",

              type: "JSON",

              data: {profID: profID,profCode:profCode},

              success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                        var objrow = data1.data;
                        var srNo=1;
                        var tableid = objrow[0].ID;
                        $.each(objrow, function (i, objrow) {

                          if(objrow.ADD_FORM == 'NO'){
                            var NoAccess = '<i class="fa fa-times" aria-hidden="true" style="color: #dd4b39;"></i>';
                          }else{
                            var NoAccess ='<i class="fa fa-check" aria-hidden="true" style="color: #00a65a;"></i>';
                          }


                          if(objrow.EDIT_FORM == 'NO'){
                            var NoAccessE = '<i class="fa fa-times" aria-hidden="true" style="color: #dd4b39;"></i>';
                          }else{
                            var NoAccessE ='<i class="fa fa-check" aria-hidden="true" style="color: #00a65a;"></i>';
                          }

                          if(objrow.DELETE_FORM == 'NO'){
                            var NoAccessD = '<i class="fa fa-times" aria-hidden="true" style="color: #dd4b39;"></i>';
                          }else{
                            var NoAccessD ='<i class="fa fa-check" aria-hidden="true" style="color: #00a65a;"></i>';
                          }

                          if(objrow.VIEW_FORM == 'NO'){
                            var NoAccessV = '<i class="fa fa-times" aria-hidden="true" style="color: #dd4b39;"></i>';
                          }else{
                            var NoAccessV ='<i class="fa fa-check" aria-hidden="true" style="color: #00a65a;"></i>';
                          }
                          $('#childData_'+tableid).append('<tr><td class="text-center removeextraSInC">'+srNo+'</td><td class="removeextraSInC">'+objrow.FORMNAME+'</p></td><td class="removeextraSInC">'+NoAccess+'</td><td class="removeextraSInC">'+NoAccessE+'</td><td class="removeextraSInC">'+NoAccessD+'</td><td class="removeextraSInC">'+NoAccessV+'</td></tr>');
                              srNo++;
                        });

                      }
                      
                  }
               }

          });
    }

    function showAllParty(vrNo,headid,bodyid,rownm,srNo){

      var vrNo,headid,bodyid,rownm;

     
        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

        });

        $.ajax({

              url:"{{ url('get-vendor-for-enquiry') }}",

               method : "POST",

               type: "JSON",

               data: {vrNo: vrNo,headid:headid,bodyid:bodyid},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{
                        var obj_row = data1.data;
                        var srac=1;
                        /*var countAcc= data1.data.length;
                        $('#accCount'+headid+'_'+srNo).html(countAcc);*/
                        $('#allAccData'+rownm+'_'+srNo).empty();
                        var headData = '<div class="box-row" id="appendbody'+rownm+'_'+srNo+'"><div class="box10 texIndbox1">Sr.No.</div><div class="box10 rateIndbox">Acc Code</div><div class="box10 rateIndbox">Acc Name</div></div></div>';
                      $('#allAccData'+rownm+'_'+srNo).append(headData);
                        $.each(obj_row, function (i, obj_row) {

                            var bodyData = '<div class="box-row"><div class="box10 itmdetlheading"><span id="srnum">'+srac+'</span></div><div class="box10 itmdetlheading"><span id="accCode">'+obj_row.ACC_CODE+'</span> </div><div class="box10 itmdetlheading"><span id="accName"> '+obj_row.ACC_NAME+'</span></div></div>';

                            srac++;
                            $('#allAccData'+rownm+'_'+srNo).append(bodyData);
                        });
                      }
                      
                  }
               }

          });
    }
</script>

<script type="text/javascript">
  function profUsrDelete(profID,profCode) {



    $("#usrProfDelete").modal('show');

    $("#profID").val(profID);
    $("#profCode").val(profCode);
  }
  
</script>


@endsection



