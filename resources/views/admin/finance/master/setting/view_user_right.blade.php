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



 <div class="modal fade" id="usrProfRDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

          <form action="{{ url('/master/setting/delete-user-profie-right') }}" method="post">

            @csrf

            <input type="hidden" name="profCode" id="profCode" value="">
            <input type="hidden" name="profName" id="profName" value="">
            <input type="hidden" name="profID" id="profID" value="">
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
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.PROFILE_CODE+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th class="removeextraSInC">Sr. No.</th>'+
            '<th class="removeextraSInC">Item Name</th>'+
            '<th class="removeextraSInC">View Party</th>'+
            '<th class="removeextraSInC">Vr No</th>'+
            '<th class="removeextraSInC">Qty</th>'+
            '<th class="removeextraSInC">A-Qty</th>'+
            '</tr></tbody>'+
    '</table>';
  }

   $(document).ready(function(){

     $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

    

    $("#example").DataTable({

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,

       ajax:{

        url : "{{ url('/master/setting/view-user-profile-right') }}"

       },
       searching : true,

       columns: [
        
          { 
            render: function(data, type, full, meta) {
               var myNm = 'smit';
                return myNm;
            }
          },
        
          { 

            render: function (data, type, full, meta){
              
              var myNm = 'smit';
              return myNm;

            }
          },

          { 
            className:'text-right',
            render: function (data) {
                 
              var myNm = 'smit';
              return myNm;

            }
          },

          {  
            render: function (data, type, full, meta){
              var myNm = 'smit';
             return myNm;

            }
        
          },

          {  
            render: function (data, type, full, meta){
             var myNm = 'smit';
             return myNm;

            
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

   function showchildtable(proID,proCode){
    
            var proID,proCode;

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $("#minus"+proID+''+proCode).toggleClass('fa-plus fa-minus rotate');

            $.ajax({

              url:"{{ url('/master/setting/view-child-user-profile-right') }}",

              method : "POST",

              type: "JSON",

              data: {proID: proID,proCode:proCode},

              success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      var accCount =[];
                      
                        $.each(data1.count, function (i, objcount) {
                              accCount.push(data1.count);
                        });

                      if(data1.data==''){
                       
                      }else{

                        var objrow = data1.data;
                        var srNo=1;
                        var tableid = objrow[0].PROFILE_CODE;
                        $.each(objrow, function (i, objrow) {

                          $('#childData_'+tableid).append('<tr><td class="text-right removeextraSInC">'+srNo+'</td><td class="removeextraSInC">'+objrow.PROFILE_NAME+' <p>( '+objrow.PROFILE_CODE+')</p></td><td class="text-right removeextraSInC"><button type="button" class="btn btn-info notification" id="veiwPdetail_'+objrow.ID+'_'+srNo+'" data-toggle="modal" data-target="#viewPartyDetail_'+objrow.ID+'_'+srNo+'" onclick="showAllParty('+objrow.PROFILE_NAME+','+objrow.ID+','+objrow.PROFILE_CODE+','+srNo+')"><small class="viewaccnot"><center>View</center></small><span class="badge" id="accCount'+objrow.PROFILE_CODE+'_'+srNo+'">'+accCount.length+'</span></button></td><td class="text-right removeextraSInC">'+objrow.PROFILE_CODE+'</td><td class="text-right removeextraSInC">'+objrow.PROFILE_CODE+'</td><td class="text-right removeextraSInC">'+objrow.PROFILE_NAME+' <div class="modal fade" id="viewPartyDetail_'+objrow.ID+'_'+srNo+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-md" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel">Account Detail</h5></div></div></div><div class="modal-body table-responsive"><div class="boxer" id="allAccData'+objrow.ID+'_'+srNo+'"></div><div class="modal-footer" style="text-align: center;"><button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button></div></div></div></div> </td> </tr>');
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

  function usrProfDelete(pCode,pID) {

    $("#usrProfRDelete").modal('show');

    $("#profCode").val(pCode);
    $("#profID").val(pID);

  }
  
</script>


@endsection



