@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')





<style type="text/css">

  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }

  .alignLeftClass{

    text-align: left;

  }

  .alignRightClass{

    text-align: right;

  }

  .alignCenterClass{

    text-align: center;

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



Seasonal



<small>View Details</small>



</h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/Master/Maintenance/View-Equipment-Type-Mast') }}">Master Seasonal</a></li>



            <li class="active"><a href="{{ url('//Master/Maintenance/View-Equipment-Type-Mast') }}">View Seasonal</a></li>



          </ol>



</section>







<!-- Main content -->



<section class="content">



<div class="row">



<div class="col-xs-12">











<div class="box box-primary Custom-Box">



<div class="box-header with-border" style="text-align: center;">



<h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Seasonal</h3>



<div class="box-tools pull-right">



<a href="{{ url('/Master/ColdStorage/Add-Seasonal-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Seasonal</a>



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

          <th class="text-center">Seasonal Id </th>
          <th class="text-center">Season</th>
          <th class="text-center">Item Name</th>
          <th class="text-center">From Date</th>
          <th class="text-center">Min Qty One</th>

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







  <div class="modal fade" id="seasonalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



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



      <form action="{{ url('/Master/ColdStorage/Delete-Seasonal') }}" method="post">



      @csrf



            <input type="hidden" name="seasonalid" value="" id="seasonalid">



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

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/Master/ColdStorage/View-Seasonal-Mast') }}"

       },
       searching : true,
    

       columns: [
        
       
         { data:"DT_RowIndex",className:"text-center"},
         { data: "SEASONAL_ID" },
         { data: "SEASON" },
         { data: "ITEM_NAME" },
         { data: "FROM_DATE",className:"text-right",
           
                    
                    render: function (data) {
                        var date = new Date(data);
                        var month = date.getMonth() + 1;
                        if(data=='0000-00-00'){
                          return '00-00-0000';
                        }else{
                          
                        return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                        }
                    }
         },
         { data: "MINQTY_ONE",className:"text-right"},
         {  
            render: function (data, type, full, meta){

                    
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="Edit-Seasonal-Mast/'+btoa(full['SEASONAL_ID'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['SEASONAL_ID']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     }
        

       },
        
         
        
      ],

       


     });



});
</script>


<script type="text/javascript">

  function getID(id){

      console.log(id);
     $("#seasonalDelete").modal('show');

     $('#seasonalid').val(id);


  }

</script>







@endsection



