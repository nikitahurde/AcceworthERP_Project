@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')


<style type="text/css">
  
  .alignLeftClass{
    text-align: left;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
}

  @media screen and (max-width: 600px) {

    .viewpagein{
      width: auto;
    }
  }

</style>


<div class="content-wrapper">

<!-- Content Header (Page header) -->

<section class="content-header">

<h1>

General Ledger Key

<small>View Details</small>

</h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/Master/General-Ledger/View-Gl-Key-Mast') }}">Master General Ledger Key</a></li>

            <li class="active"><a href="{{ url('/Master/General-Ledger/View-Gl-Key-Mast') }}">View General Ledger Key</a></li>

          </ol>

</section>



<!-- Main content -->

<section class="content">

<div class="row">

<div class="col-xs-12">





<div class="box box-primary Custom-Box">

<div class="box-header with-border" style="text-align: center;">

<h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View General Ledger Key</h3>

<div class="box-tools pull-right">

<a href="{{ url('/Master/General-Ledger/Gl-Key-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus" id="getPAgeTitleNAme"></i>&nbsp;&nbsp;Add General Ledger Key</a>

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

                    <th class="text-center">Gl Key Code</th>
                    <!-- <th class="text-center">Gl Key Name</th> -->

                    <th class="text-center">Gl Code </th>
                    <th class="text-center">Gl Name </th>

                    <th class="text-center">Acc Type Code </th>
                    <th class="text-center">Acc Type Name </th>

                    <th class="text-center">Amt Type </th>

                    <th class="text-center">Status </th>

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



  <div class="modal fade" id="glkeyDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          You Want To Delete This ...!

        </div>

        <div class="modal-footer">

       <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

      <form action="{{ url('/delete-gl-key') }}" method="post">

      @csrf

            <input type="hidden" name="glkeyId" value="" id="glkeyId">

            <input type="submit" value="Delete" class="btn btn-sm btn-danger" style="margin-top: -20%;">

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
                      title: 'MASTER GENERAL LEDGER KEY '+$("#headerexcelDt").val(),
                      filename: 'MASTER_GENERAL_LEDGER_KEY_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/General-Ledger/View-Gl-Key-Mast') }}"

       },
       searching : true,
    

       columns: [
        
       
         // { data:"DT_RowIndex",className:"text-center"},
         { data: "GLKEY_CODE" },
         { data: "GL_CODE" },
         { data: "GL_NAME" },
         { data: "ATYPE_CODE" },
         { data: "ATYPE_NAME" },
         // { 
         //   render: function (data, type, full, meta){

         //    var glcode = full['GL_CODE'];
         //    var glname = full['GL_NAME'];

         //    var gl_name = glname ? glname : '---'; 
         //    var glcodename = gl_name+ ' [ '+glcode+ ' ]';

         //    return glcodename;

         //   },
         // },
         // { 

         //   render: function (data, type, full, meta){

         //    var acctypecode = full['ATYPE_CODE'];
         //    var acctypename = full['ATYPE_NAME'];

         //    var atypename = acctypename ? acctypename : '---';

         //    var acctypecname = atypename+ ' [ '+acctypecode+ ' ]';

         //    return acctypecname;

         //   },
         // },
         
         { render: function (data, type, full, meta){


                  if(full['AMT_TYPE']==0){
                      return '<span class="label label-success">Yes</span>';
                    }else if(full['AMT_TYPE']==1){

                      return '<span class="label label-danger">No</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },
        
         {  render: function (data, type, full, meta){


                  if(full['GLKEY_BLOCK']=='NO'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['GLKEY_BLOCK']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

            },className:"text-center"
          },
         {  
            render: function (data, type, full, meta){
                    
              var enableBtn = 'enable';
              var deletebtn ='<input type="hidden" id="deleteinput_'+full['GLKEY_CODE']+'_'+full['GL_CODE']+'" value="'+full['GLKEY_CODE']+'/'+full['GL_CODE']+'"><a href="Edit-Gl-Key-Mast/'+btoa(full['GLKEY_CODE'])+'/'+btoa(full['GL_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return GlKeyDlt(\''+full['GLKEY_CODE']+'\',\''+full['GL_CODE']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
             

              return deletebtn;

             },className:"text-center"
        

       },
        
         
        
      ],

       


     });



});
</script>



<script type="text/javascript">
  function GlKeyDlt(glkeycode,glcode){

    var getval = $('#deleteinput_'+glkeycode+'_'+glcode).val();
      console.log('getval',getval);
    $('#glkeyDelete').modal('show');
    
     $('#glkeyId').val(getval);

  }
</script>



@endsection

