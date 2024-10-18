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

</style>







  <div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">


          <h1>


            Emp Interview Transaction



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/Transaction/JobOpening/view-job-opening-trans')}}">Emp Interview Trans</a></li>



            <li class="Active"><a href="{{ URL('/Transaction/JobOpening/view-job-opening-trans')}}">View Emp Interview</a></li>



          </ol>



        </section>

        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Emp Interview </h3>



                  <div class="box-tools pull-right">



                    <a href="{{ url('/Transaction/EmpInterview/add-emp-interview-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Emp Interview</a>



                  </div>



                </div><!-- /.box-header -->



                 @if(Session::has('alert-success'))

                <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                   <h4> <i class="icon fa fa-check"></i>Success...!</h4>

                   {!! session('alert-success') !!}



                </div>



            @endif

            @if(Session::has('alert-error'))

            <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>



                <h4><i class="icon fa fa-ban"></i> Error...!

                </h4>



                {!! session('alert-error') !!}



              </div>

              @endif

                <div class="box-body">

                  <table id="example" class="table table-bordered table-striped table-hover">

                    <thead>

                      <tr>

                        <th class="text-center">Sr.No</th>
                        
                        <th class="text-center">Interview Date</th>

                        <th class="text-center">Name</th>
                        
                        <th class="text-center">Interview By</th>

                        <th class="text-center">Application Status</th>

                        <th class="text-center">Hr Remark</th>

                        <th class="text-center">Management Remark</th>

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

<div class="modal fade" id="interviewDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

          <form action="{{ url('/Transaction/EmpInterview/delete-emp-interview') }}" method="post">
            @csrf

            <input type="hidden" name="interviewId" id="interviewId" value="">

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
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/Transaction/EmpInterview/view-emp-interview-trans') }}"

       },
       searching : true,
    

       columns: [
        
         { data:"DT_RowIndex",className:"text-center"},
         { data: "INTERVIEW_DATE",className:"text-right" },
         { data: "NAME" },
         { data: "INTERVIEW_BY" },
         { data: "APPLICATION_STATUS" },
         { data: "HR_REMARK" },
         { data: "MANAGEMENT_REMARK"},
         { render: function (data, type, full, meta){
            
              if(full['EMPINTERVIEW_BLOCK']=='NO'){

                return '<span class="label label-success">Active</span>';

              }else if(full['EMPINTERVIEW_BLOCK']=='YES'){

                return '<span class="label label-danger">Inactive</span>';

              }else{

                return '<span class="label label-danger">Not Found</span>';
              }
            },className:"text-center"
          },
         {  
            render: function (data, type, full, meta){

              var enableBtn = 'enable';
              var deletebtn ='<input type="hidden" id="deleteinput_'+full['ID']+'" value="'+full['ID']+'"><a href="edit-emp-interview/'+btoa(full['ID'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getId('+full['ID']+');"><i class="fa fa-trash" title="Delete"></i></button>';

              return deletebtn;

            },className:"text-center",

          },

       ],

     });

  });

</script>

<script type="text/javascript">

function getId(tblId){

    var getval = $('#deleteinput_'+tblId).val();
    
    $("#interviewDel").modal('show');

    $("#interviewId").val(getval);

}

</script>

@endsection






