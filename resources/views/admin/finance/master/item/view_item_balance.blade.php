@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')


<style type="text/css">

  .Custom-Box {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .box-header>.box-tools {

    position: absolute !important;

    right: 10px !important;

    top: 2px !important;


  }


  .required-field::before {

    content: "*";

    color: red;

  }

  .showAccName{

    border: none;

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

  }

  .defualtSearchNew{

    display: none;

  }

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

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

  .showmsg{

    display: none;

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

          Master Item Balance 

            <small> View Item Balance</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Finance</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li><a href="{{ url('/finance/valuation-transaction-list') }}">Item Balance</a></li>

            <li><a href="{{ url('/finance/valuation-transaction-list') }}">View Item Balance</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">


            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Item Balance</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Master/Item/Item-Bal-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Item Balance</a>

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

<table id="example" class="table table-bordered table-striped table-hover submitbill">

  <thead class="theadC">

    <tr>

      <!-- <th class="text-center">Sr. No.</th> -->

      <th class="text-center">Item Name</th>
      <th class="text-center">Plant Name</th>
      <th class="text-center">Batch No</th>
      <th class="text-center">Yropqty</th>
      <th class="text-center">Yropval</th>
      <th class="text-center">StdRate</th>
      <th class="text-center">Status</th>
      <th class="text-center">Action</th>

   </tr>

  </thead>

  <tbody>

  </tbody>

</table>


</div><!-- /.box-body -->

 </div>

  </section>

</div>

<div class="modal fade" id="ItemBalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

          <form action="{{ url('/Master/Item/delete-item-balance') }}" method="post">

            @csrf

            <input type="hidden" name="ItemBalId" id="ItemBalId" value="">

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
                            columns: [0,1,2,3,4,5,6]
                      },
                      title: 'MASTER ITEM BALANCE'+$("#headerexcelDt").val(),
                      filename: 'MASTER_ITEM_BALANCE_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/Item/View-Item-Bal-Mast') }}"

       },
       searching : true,
    

       columns: [
        
       
         // { data:"DT_RowIndex",className:"text-center"},
         { render: function (data, type, full, meta){


            var comp_code =  full['ITEM_NAME'] +' ('+full['ITEM_CODE']+')';

            return comp_code;
          }

                  
          },
        
         { render: function (data, type, full, meta){


            var comp_code =  full['PLANT_NAME'] +' ('+full['PLANT_CODE']+')';

            return comp_code;
          }

                  
          },

         {data:'BATCH_NO',className:'text-right'},
         {data:'YROPQTY' ,className:'text-right'},
         {data:'YROPVAL' ,className:'text-right'},
         {data:'STDRATE' ,className:'text-right'},
        
         
         { render: function (data, type, full, meta){


                  if(full['ITEMBAL_BLOCK']=='NO'){
                      return '<span class="label label-success">Active</span>';
                    }else if(full['ITEMBAL_BLOCK']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';
                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },

         {  
            render: function (data, type, full, meta){

                      var enableBtn = 'enable';
                      var deletebtn ='<a href="Edit-Item-Bal-Mast/'+btoa(full['COMP_CODE'])+'/'+btoa(full['FY_CODE'])+'/'+btoa(full['PLANT_CODE'])+'/'+btoa(full['ITEM_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['ITEM_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['PLANT_CODE']+'\',\''+full['COMP_CODE']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                    
                      return deletebtn;

                     },className:"text-center"
        
       },
     
      ],

     });


});
</script>

<script type="text/javascript">

  $(document).ready(function() {

    $('.datepicker').datepicker({


      format: 'yyyy-mm-dd',


      orientation: 'bottom',


      todayHighlight: 'true',


      //startDate :from_date,

      endDate : 'today'


    });


});

</script>

<script type="text/javascript">

  function getID(id,fycd,plcd,compcd)
  {
    

    $("#ItemBalDelete").modal('show');

    $("#ItemBalId").val(id+'/'+fycd+'/'+plcd+'/'+compcd);

  }

</script>



@endsection