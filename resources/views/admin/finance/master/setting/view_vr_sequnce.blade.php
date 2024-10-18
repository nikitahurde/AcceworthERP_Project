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
  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }
</style>







  <div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master Vr Sequence 



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/finance/view-vr-sequnce')}}">Master Vr Sequence  </a></li>



            <li class="Active"><a href="{{ URL('/finance/view-vr-sequnce')}}">View Vr Sequence  </a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



             







              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View Vr Sequence </h3>



                  <div class="box-tools pull-right">



          <a href="{{ url('/Master/Setting/Vr-Sequence') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Vr Sequence </a>



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



                        <th class="text-center">Transaction Code</th>



                        <th class="text-center">Transaction Head</th>



                        <th class="text-center">Series Code</th>



                        <th class="text-center">Series Name</th>


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








<div class="modal fade" id="vrSeqDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">







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







          <form action="{{ url('/delete-cr-sequence') }}" method="post">







            @csrf







            <input type="hidden" name="vrseqId" id="vrseqId" value="">







            <input type="submit" value="Delete" style="margin-top: -15%;" class="btn btn-sm btn-danger">







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
                            columns: [0,1,2,3,4]
                      },
                      title: ' MASTER VR SEQUENCE'+$("#headerexcelDt").val(),
                      filename: 'MASTER_VR_SEQUENCE'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/Setting/View-Vr-Sequence') }}"

       },
       searching : true,
    

       columns: [
        
       
        { data: "TRAN_CODE" },
        { data: "TRAN_HEAD" },
         { data: "SERIES_CODE" },
         { data: "SERIES_NAME" },
         { render: function (data, type, full, meta){


                  if(full['VRSEQ_BLOCK']=='NO'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['VRSEQ_BLOCK']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },
         {  
            render: function (data, type, full, meta){

                   
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="Edit-Vr-Sequence/'+btoa(full['COMP_CODE'])+'/'+btoa(full['FY_CODE'])+'/'+btoa(full['TRAN_CODE'])+'/'+btoa(full['SERIES_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     },className:"text-center"
        

       },
        
         
        
      ],

       


     });



});
</script>

<script type="text/javascript">

  function getID(cmopCd,fyCd,tranCd,seriesCd)

  {
    

    $("#vrSeqDelete").modal('show');

    $("#vrseqId").val(cmopCd+'_'+fyCd+'_'+tranCd+'_'+seriesCd);

  }

</script>





@endsection







