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



Master HSN Rate



<small>View Details</small>



</h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/Master/Item-Tax/View-Hsn-Rate-Mast') }}">Master HSN Rate</a></li>



            <li class="active"><a href="{{ url('/Master/Item-Tax/View-Hsn-Rate-Mast') }}">View HSN Rate</a></li>



          </ol>



</section>







       <section class="content">



<div class="row">



<div class="col-xs-12">











<div class="box box-primary Custom-Box">



<div class="box-header with-border" style="text-align: center;">



<h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View HSN Rate</h3>



<div class="box-tools pull-right">



<a href="{{ url('/Master/Item-Tax/Hsn-Rate-Mast') }}" class="btn btn-primary" style="margin-right: 10px;" id="getPAgeTitleNAme"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add HSN Rate</a>



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



                    <thead align="center">



                      <tr>



                          <th class="text-center">HSN Code</th>



                          <th class="text-center">Tax Code </th>

                          <th class="text-center">Tax Rate </th>


                          <th class="text-center">Status </th>



                          <th class="text-center">Action</th>



                      </tr>



                    </thead>



                    <tbody>



                      

                    </tbody>



                    <!-- <tfoot>



                      <tr>



                        <th>Rendering engine</th>



                        <th>Browser</th>



                        <th>Platform(s)</th>



                        <th>Engine version</th>



                        <th>CSS grade</th>



                      </tr>



                    </tfoot> -->



                  </table>



                </div><!-- /.box-body -->



              </div><!-- /.box -->



            </div><!-- /.col -->



          </div><!-- /.row -->



        </section><!-- /.content -->



      </div>





 <div class="modal fade" id="hsnDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



    <div class="modal-dialog modal-sm" role="document">



      <div class="modal-content">



        <div class="modal-header">



          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>



          <button type="button" class="close" data-dismiss="modal" aria-label="Close">



            <span aria-hidden="true">&times;</span>



          </button>



        </div>



        <div class="modal-body">
          <i class="fa fa-caret-right"></i> &nbsp;You Want To Delete This Data...!
          <div class="row" style="margin-top: 5%;" id="delText"></div>
        </div>



        <div class="modal-footer">



       <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>



      <form action="{{ url('/Master/Item-Tax/Delete-Hsn-Rate') }}" method="post">



      @csrf



            <input type="hidden" name="hsnrate_id" value="" id="hsncode">
            <input type="hidden" name="taxcode" value="" id="taxcode">



            <input type="submit" value="Delete" class="btn btn-sm btn-danger" style="margin-top: -22%;">



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
                            columns: [0,1,2,3]
                      },
                      title: 'MASTER HSN RATE'+$("#headerexcelDt").val(),
                      filename: 'MASTER_HSN_RATE_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{



        url : "{{ url('/Master/Item-Tax/View-Hsn-Rate-Mast') }}"



       },

       searching : true,

    



       columns: [

        

       

         // { data:"DT_RowIndex",className:"text-center"},

         { data: "HSN_CODE" },

         { data: "TAX_CODE" },

         { data: "TAX_RATE" },

         { render: function (data, type, full, meta){





                  if(full['HSNRATE_BLOCK']=='NO'){

                      return '<span class="label label-success">Active</span>';

                    }else if(full['HSNRATE_BLOCK']=='YES'){



                      return '<span class="label label-danger">Inactive</span>';

                    }else{



                      return '<span class="label label-danger">Not Found</span>';

                    }

                         



                     },className:"text-center"

          },

         {  

            render: function (data, type, full, meta){



                      var enableBtn = 'enable';

                      var deletebtn ='<a href="Edit-Hsn-Rate-Mast/'+btoa(full['HSN_CODE'])+'/'+btoa(full['TAX_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return deleteHsn(\''+full['HSN_CODE']+'\',\''+full['TAX_CODE']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';

                     



                      return deletebtn;



                     },className:"text-center"

        



       },

        

         

        

      ],



       





     });







});

</script>



<script type="text/javascript">

  function deleteHsn(hsncode,tax_code){

     

     $('#hsnDelete').modal('show');

     $('#hsncode').val(hsncode);
     $('#taxcode').val(tax_code);



  }

</script>





<script type="text/javascript">



  function getId(id)



  {



    $("#exampleModalDelete").modal('show');



    $("#DepotID").val(id);



  }



</script>







@endsection







