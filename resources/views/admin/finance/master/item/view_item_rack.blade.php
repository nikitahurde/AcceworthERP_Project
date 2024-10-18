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



            Master Item Rack 



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/finance/view-mast-rack')}}">Master Item Rack </a></li>



            <li class="Active"><a href="{{ URL('/finance/view-mast-rack')}}">View Item Rack </a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



             







              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View Item Rack</h3>



                  <div class="box-tools pull-right">



          <a href="{{ url('/Master/Item/Item-Rack-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Item Rack</a>



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



                        <th class="text-center">Item Code</th>



                        <th class="text-center">Item Name</th>



                        <th class="text-center">Rack Code</th>



                        <th class="text-center">Rack Name</th>



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









<div class="modal fade" id="itemrackDelete">







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







          <form action="{{ url('/finance/delete-item_rack') }}" method="post">







            @csrf







            <input type="hidden" name="itemrackId" id="itemrackId" value="">







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
                            columns: [0,1,2,3,4]
                      },
                      title: 'MASTER ITEM RACK'+$("#headerexcelDt").val(),
                      filename: 'MASTER_ITEM_RACK_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/Item/View-Item-Rack-Mast') }}"

       },
       searching : true,
    

       columns: [
        
       
         { data: "ITEM_CODE" },
         { data: "ITEM_NAME" },
         { data: "RACK_CODE" },
         { data: "RACK_NAME" },
         { render: function (data, type, full, meta){


                  if(full['ITEM_RACK_BLOCK']=='NO'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['ITEM_RACK_BLOCK']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },
         {  
            render: function (data, type, full, meta){

                    

                     
                      var enableBtn = 'enable';
                      var deletebtn ='<input type="hidden" id="deleteinput_'+full['ITEM_CODE']+'_'+full['RACK_CODE']+'" value="'+full['ITEM_CODE']+'_'+full['RACK_CODE']+'"><a href="edit-item-rack/'+btoa(full['ITEM_CODE'])+'/'+btoa(full['RACK_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['ITEM_CODE']+'\',\''+full['RACK_CODE']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     },className:"text-center"
        

       },
        
         
        
      ],

       


     });



});
</script>

<script type="text/javascript">

  function getID(itemcd,rackcode)
  {
    var getval = $('#deleteinput_'+itemcd+'_'+rackcode).val();
    console.log('getval',getval);
    $("#itemrackDelete").modal('show');

    $("#itemrackId").val(getval);

  }

</script>

@endsection







