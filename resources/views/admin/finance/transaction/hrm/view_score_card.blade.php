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


            Score Card Transaction



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/Transaction/JobOpening/view-job-opening-trans')}}">Score Card Trans</a></li>



            <li class="Active"><a href="{{ URL('/Transaction/JobOpening/view-job-opening-trans')}}">View Score Card</a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Score Card </h3>



                  <div class="box-tools pull-right">



          <a href="{{ url('/Transaction/ScoreCard/add-score-card-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Score Card</a>



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

                        <th class="text-center" style="width:20px;">Sr No </th>
                        <th class="text-center" style="width:140px;">Emp Name </th>
                        <th class="text-center" style="width:200px;">Function</th>
                        <th class="text-center" style="width:200px;">MILESTONE </th>
                        <th class="text-center" style="width:200px;">Task </th>
                        <th class="text-center" style="width:5px;">Weightage </th>
                        <th class="text-center" style="width:5px;">Action </th>

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

<div class="modal fade" id="scoreCardDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

          <form action="{{ url('/Transaction/ScoreCard/delete-score-card') }}" method="post">
            @csrf

            <input type="hidden" name="scoreId" id="scoreId" value="">
            <input type="hidden" name="slnoId" id="slnoId" value="">

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

        url : "{{ url('/Transaction/ScoreCard/view-score-card-trans') }}"

       },
       searching : true,
    

       columns: [
        
         { data:"DT_RowIndex",className:"text-center"},
         { render: function (data, type, full, meta){
             
             var empCode  = full['EMP_CODE'];
             var empName  = full['EMP_NAME'];
            

             var empCodeName = empName+' ['+empCode+' ]';

             return  empCodeName;


         }},
         { data: "FUNCTION" },
         { data: "MILESTONE" },
         { data: "TASK" },
         { data: "WEIGHTAGE",className:"text-right" },
         { render: function (data, type, full, meta){
              
              var enableBtn = 'enable';
              var selfScore = full['SELF_SCORE'];
              if(selfScore == 0){
                 var deletebtn ='<input type="hidden" id="deleteinput_'+full['SCORECARDID']+'" value="'+full['SCORECARDID']+'"><input type="hidden" id="slno_'+full['SCORECARDID']+'" value="'+full['SLNO']+'"><a href="edit-score-card/'+btoa(full['SCORECARDID'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return funScoreCard(\''+full['SCORECARDID']+'\');" ><i class="fa fa-trash" title="Delete"></i></button>';
              }else if(selfScore > 0){
                 var deletebtn ='<button class="btn btn-warning btn-xs" disabled><i class="fa fa-edit" title="Edit"></i></button> | <button class="btn btn-danger btn-xs" disabled><i class="fa fa-trash" title="Delete"></i></button>';
              }else{}
             
             return deletebtn;

           }
        },
         
       ],

       


     });



});

function funScoreCard(scoreCardId){
   
    var getval = $('#deleteinput_'+scoreCardId).val();
    var getslno = $('#slno_'+scoreCardId).val();
    
    $("#scoreCardDel").modal('show');
    $("#slnoId").val(getslno);
    $("#scoreId").val(getval);

}

</script>



@endsection







