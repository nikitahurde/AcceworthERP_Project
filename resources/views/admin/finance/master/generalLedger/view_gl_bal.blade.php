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
</style>








  <div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master General Ledger Balance



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/finance/view-gl-bal-mast')}}">Master General Ledger Balance </a></li>



            <li class="Active"><a href="{{ URL('/finance/view-gl-bal-mast')}}">View General Ledger Balance </a></li>



          </ol>



        </section>


        <!-- Main content -->



        <section class="content">

          <div class="row">

            <div class="col-xs-12">

              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View General Ledger Balance</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Master/General-Ledger/Gl-Bal-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add General Ledger Balance</a>

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

                        <!-- <th class="text-center">Sr.No</th> -->

                        <th class="text-center">PFCT Code</th>
                        <th class="text-center">PFCT Name</th>

                        <th class="text-center">GL Code</th>
                        <th class="text-center">GL Name</th>

                        <th class="text-center">DR Opening Balance</th>

                        <th class="text-center">CR Opening Balance</th>

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


<div class="modal fade" id="glBalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

          <form action="{{ url('/finance/delete-gl-bal') }}" method="post">


            @csrf

            <input type="hidden" name="glbalId" id="glbalId" value="">

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
                            columns: [0,1,2,3,4,5,6]
                      },
                      title: ' MASTER GENERAL LEDGER BALANCE '+$("#headerexcelDt").val(),
                      filename: 'MASTER_GENERAL_LEDGER_BALANCE_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/General-Ledger/View-Gl-Bal-Mast') }}"

       },
       searching : true,
    

       columns: [
        
       
         // { data:"DT_RowIndex",className:"text-center"},
         { data:"PFCT_CODE",className:"text-left"},
         { data:"PFCT_NAME",className:"text-left"},
         { data:"GL_CODE",className:"text-left"},
         { data:"GL_NAME",className:"text-left"},
         // { 
         //  data: "PFCT_CODE",
         //  render: function (data, type, full, meta){

         //    var pfctNameCode = full['PFCT_NAME']+' - [ '+full['PFCT_CODE']+' ]';
           

         //    return pfctNameCode;
             

         //  },
         //  className:"text-left" 
         // },
         // { 
         //  data: "GL_CODE",

         //    render: function (data, type, full, meta){

         //      var GlNameCode = full['GL_NAME']+' - [ '+full['GL_CODE']+' ]';
             

         //      return GlNameCode;
               

         //    },
         //    className:"text-left"

         // },

         { 
          data: "YROPDR",
          className:"text-right"

         },
         { 
          data: "YROPCR",
          className:"text-right"

         },
        
         { 
                  render: function (data, type, full, meta){


                    if(full['GLBAL_BLOCK']=='NO'){
                        return '<span class="label label-success">Active</span>';
                      }else if(full['GLBAL_BLOCK']=='YES'){

                        return '<span class="label label-danger">Inactive</span>';
                      }else{

                        return '<span class="label label-danger">Not Found</span>';
                      }
                         

                  },
                  className:"text-center"
          },
         {  
            render: function (data, type, full, meta){

                   
                     
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="Edit-Gl-Bal-Mast/'+btoa(full['GL_CODE'])+'/'+btoa(enableBtn)+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID('+full['GL_CODE']+','+full['COMP_CODE ']+','+full['FY_CODE']+','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     }
        

       },
        
         
        
      ],

       


     });



});
</script>

<script type="text/javascript">

  function getID(glCode,comp_code,fy_code,rowId)
  {
    

    $("#glBalDelete").modal('show');

    $("#glbalId").val(id);

  }

</script>


@endsection







