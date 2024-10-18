@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')



<style type="text/css">

  .amountfl{

    text-align: right;

  }

  .textfl{

    text-align: left;

  }

  .tabs {
     display: flex;
     flex-wrap: wrap;
     /*max-width: 700px;*/
     background: #efefef;
     box-shadow: 0 48px 80px -32px rgba(0, 0, 0, 0.25);
}

.input {
     position: absolute;
     opacity: 0;
}

.label {
     width: 100%;
    padding: 9px 30px;
    background: #e5e5e5;
    cursor: pointer;
    font-weight: bold;
    font-size: 14px;
    color: #7f7f7f;
    transition: background 0.1s, color 0.1s;
}

.label:hover {
     background: #d8d8d8;
}

.label:active {
     background: #ccc;

}

.input:focus + .label {
     z-index: 1;
}

.input:checked + .label {
     background: #52a0ce;
     color: #000;
}

.panel {
     display: none;
     padding: 20px 30px 30px;
     background: #fff;
     width: 100%;
}

@media (min-width: 600px) {
     .label {
          width: auto;
     }

     .panel {
          order: 99;
     }
}

.input:checked + .label + .panel {
     display: block;

}

</style>







  <div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">


          <h1>


            View Leave Application



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="#">Travel Requisition</a></li>



            <li class="Active"><a href="#">View Travel Requisition</a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Leave Application</h3>



                  <div class="box-tools pull-right">



          <a href="{{url('/Transaction/LeaveApplication/add-leaveApplication')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Leave Application</a>



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



                  <table id="example" class="table table-bordered table-striped table-hover" >

                    <thead>

                      <tr>

                        <th class="text-center">VR DATE</th>

                        <th class="text-center">Emp Name</th>
                        
                        <th class="text-center">Designation</th>
                        
                        <th class="text-center">Leave Type</th>
                        
                        <th class="text-center">From to Date</th>
                        
                        <th class="text-center">No of Days</th>
                        
                        <th class="text-center">Approved</th>

                        <th class="text-center">Any Comments</th>
                        
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






<div class="modal fade" id="leaveAppliDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">







  <div class="modal-dialog modal-sm" role="document">







    <div class="modal-content">







      <div class="modal-header">











        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>











        <button type="button" class="close" data-dismiss="modal" aria-label="Close">







          <span aria-hidden="true">&times;</span>







        </button>







      </div>







      <div class="modal-body">







      You Want To Delete This Data...!







      </div>







      <div class="modal-footer">







          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>







          <form action="{{ url('/Transaction/LeaveApplication/delete-leave-application') }}" method="post">







            @csrf







            <input type="hidden" name="leaveAppId" id="leaveAppId" value="">



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

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/Transaction/LeaveApplication/ViewLeaveApplication') }}"

       },
       searching : true,
    

       columns: [
         
         { data: "DATE",className:"text-right"},
         
         { render: function (data, type, full, meta){
             
             var empCode  = full['EMP_CODE'];
             var empName  = full['EMP_NAME'];
            

             var empCodeName = empName+' [ '+empCode+ ' ]';

             return  empCodeName;


            }},
        { render: function (data, type, full, meta){
             
             var desigCode  = full['DESIG_CODE'];
             var desigName  = full['DESIG_NAME'];
            

             var desigCodeName = desigName+' ['+desigCode+' ]';

             return  desigCodeName;


            }},
         { data: "LEAVE_TYPE" },
         { data: "FROMTODATE",className:"text-right" },
         { data: "NOOFDAYS",className:"text-right" },
        
         { render: function (data, type, full, meta){
            
            return '<label class="label label-danger" style="font-size:10px;padding: 4px 10px;"><i class="fa fa-times" aria-hidden="true"></i> Not Approved</label>';
          }
         },
         { render: function (data, type, full, meta){
            
            return 'Any Comment';
          }
         },

         {
          render: function (data, type, full, meta){
            
             var flag ='leave';

             var enableBtn = 'enable';
                     
             var deletebtn ='<input type="hidden" id="deleteinput_'+full['ID']+'" value="'+full['ID']+'"><a href="edit-leave-application/'+btoa(full['ID'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getId('+full['ID']+');"><i class="fa fa-trash" title="Delete"></i></button>';

            return deletebtn;
          }
        },
       ],
     });
});

function getId(tblId)
  {
    
    var getval = $('#deleteinput_'+tblId).val();
    

    $("#leaveAppliDelete").modal('show');


    $("#leaveAppId").val(getval);

  }

</script>









@endsection







