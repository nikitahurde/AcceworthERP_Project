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


            Master Self Declaration 



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/finance/view-cost-category')}}">Master Self Declaration </a></li>



            <li class="Active"><a href="{{ URL('/finance/view-cost-category')}}">View Self Declaration  </a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Self Declaration </h3>



                  <div class="box-tools pull-right">



          <a href="{{ url('/Master/Employee/self-declaration') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Self Declaration </a>



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

                        <th class="text-center">Employee Code</th>
                        <th class="text-center">Employee Name</th>

                        <th class="text-center">Wage Indicator Code</th>
                        <th class="text-center">Wage Indicator Name</th>
                      
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






<div class="modal fade" id="wagetypeDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">







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







          <form action="{{ url('/Master/Employee/delete-emp-wage-type') }}" method="post">







            @csrf







            <input type="hidden" name="wagetype" id="wagetype" value="">



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
                            columns: [0,1,2,3]
                      },
                      title: 'MASTER EMPLOYEE SELF DECLARATION'+$("#headerexcelDt").val(),
                      filename: 'MASTER_EMPLOYEE_SELF_DECLARATION_'+$("#headerexcelDt").val(),
                    }
                  ],
       ajax:{

        url : "{{ url('/Master/Employee/view-self-declaration') }}"

       },
       searching : true,
    

       columns: [
        
       
         // { data:"DT_RowIndex",className:"text-center"},
         { data:"EMP_CODE",className:"text-left"},
         { data:"EMP_NAME",className:"text-left"},
         { data:"WAGE_INDICATOR",className:"text-left"},
         { data:"WAGEINDICATOR_NAME",className:"text-left"},
        
         // { render: function (data, type, full, meta){
             
         //     var empCode  = full['EMP_CODE'];
         //     var empName  = full['EMP_NAME'];
            

         //     var empCodeName = empName+' ['+empCode+' ]';

         //     return  empCodeName;


         //    }
         //  },
         
          // { render: function (data, type, full, meta){
             
          //    var wageIndCode  = full['WAGE_INDICATOR'];
          //    var wageIndName  = full['WAGEINDICATOR_NAME'];
            

          //    var wageIndCodeName = wageIndName+' ['+wageIndCode+' ]';

          //    return  wageIndCodeName;


          //   }
          // },
        
        
      ],

       


     });



});
</script>



<script type="text/javascript">

  function getId(tblId)
  {
     // console.log('Id',tblId);
    var getval = $('#deleteinput_'+tblId).val();
    console.log('Value',getval);

    $("#wagetypeDelete").modal('show');


    $("#wagetype").val(getval);

  }

</script>





@endsection







