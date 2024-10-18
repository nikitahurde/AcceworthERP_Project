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


            Employee Payment Advice



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('Transaction/PaymentAdvice/view-emp-payment-advice-transaction')}}">Emp Payment Advice</a></li>



            <li class="Active"><a href="{{ URL('Transaction/PaymentAdvice/view-emp-payment-advice-transaction')}}">View Emp Payment Advice </a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Emp Payment Advice </h3>



                  <div class="box-tools pull-right">



          <a href="{{ url('/Transaction/PaymentAdvice/add-emp-payment-advice-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Emp Payment Advice</a>



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
                        
                        <th class="text-center">Sr.No</th>

                        <th class="text-center">Advance/Loan Date</th>

                        <th class="text-center">Series Name</th>

                        <th class="text-center">Plant Name</th>
                        
                        <th class="text-center">Acc Name</th>

                        <th class="text-center">Payment Type</th>
                        
                        <th class="text-center">DR. AMT</th>
                        
                        <th class="text-center">CR. AMT</th>
                        
                        <th class="text-center">EMI Amount</th>
                        
                        <th class="text-center">Tenure</th>
                        
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






<div class="modal fade" id="empPaymentAdviceDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">







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







          <form action="{{ url('/Transaction/PaymentAdvice/delete-emp-payment-advice') }}" method="post">







            @csrf







            <input type="hidden" name="paymentAdviceId" id="paymentAdviceId" value="">



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

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/Transaction/PaymentAdvice/view-emp-payment-advice-transaction') }}"

       },
       searching : true,
    

       columns: [
        
       
         // { data:"DT_RowIndex",className:"text-center"},
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.ID+','+full.VRNO+','+full.DT_RowIndex+')"><i class="fa fa-plus" id="minus'+full.DT_RowIndex+'" title="Edit"></i></button>'
            }
         },
         { data: "MONTH_YR" },
        
         { render: function (data, type, full, meta){
             
             var seriesCode  = full['SERIES_CODE'];
             var seriesName  = full['SERIES_NAME'];
            

             var seriesCodeName = seriesName+' ['+seriesCode+' ]';

             return  seriesCodeName;


            }
          },
         
         { render: function (data, type, full, meta){
             
             var plantCode  = full['PLANT_CODE'];
             var plantName  = full['PLANT_NAME'];
            

             var plantCodeName = plantName+' ['+plantCode+' ]';

             return  plantCodeName;


            }},
         { render: function (data, type, full, meta){
             
             var accCode  = full['ACC_CODE'];
             var accName  = full['ACC_NAME'];
            

             var accCodeName = accName+' [ '+accCode+' ] ';

             return  accCodeName;


            }},
         
         { data: "PAYMENT_TYPE"},
         { data: "DR_AMT",className:"text-right" },
         { data: "CR_AMT",className:"text-right" },
         { data: "EMI_AMOUNT",className:"text-right" },
         { data: "TENURE",className:"text-right" },
         
         {  
            render: function (data, type, full, meta){

                      if(full['FLAG']=='0'){
                         var deletebtn ='<input type="hidden" id="deleteinput_'+full['ID']+'" value="'+full['ID']+'"><a href="edit-emp-payment-advice/'+btoa(full['ACC_CODE'])+'" class="btn btn-warning btn-xs" title="edit" btn><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getId('+full['ID']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                      }else if(full['FLAG'] == '1' || full['FLAG'] == '2'){
                        
                         var deletebtn ='<a href="#" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                      }else {}

                      // var enableBtn = 'enable';
                      // var deletebtn ='<input type="hidden" id="deleteinput_'+full['ID']+'" value="'+full['ID']+'"><a href="edit-emp-payment-advice/'+btoa(full['ACC_CODE'])+'" class="btn btn-warning btn-xs" title="edit" btn><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getId('+full['ID']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     },className:"text-center",
        

         },
        
         
        
      ],

       


     });
    
     $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        //console.log(tr);
        var row = t.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );


});
</script>



<script type="text/javascript">

  function format(d) {

      return '<table border="0" class="table table-bordered table-striped table-hover" id="childData_'+d.ID+'" style="padding-left:50px;">'+
            '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
                '<th style="width:40px;">SRNO</th>'+
                '<th style="width:170px;">APPROVE IND</th>'+
                '<th style="width:170px;">APPROVE USER</th>'+
                '<th style="width:80px;">LEVEL NO</th>'+
                '<th>REMARK</th>'+
                '<th style="width:120px;">APPROVE STATUS</th>'+
            '</tr></tbody>'+
        '</table>';
    }

  function getId(tblId)
  {
    var getval = $('#deleteinput_'+tblId).val();

    $("#empPaymentAdviceDelete").modal('show');

    $("#paymentAdviceId").val(getval);

  }
 

  function showchildtable(tblid,vrno,srnoRow){

    var tblid,vrno,srnoRow;
    $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

    });

    $("#minus"+srnoRow).toggleClass('fa-plus fa-minus rotate');

    $.ajax({

              url:"{{ url('view-emp-payment-advice-status') }}",

              method : "POST",

              type: "JSON",

              data: {vrno:vrno,tblid:tblid},

              success:function(data){

                var data1 = JSON.parse(data);

                if(data1.response == 'success'){

                   if(data1.data==''){
                       
                      }else{

                         var rows = data1.data;
                         var srNo=1;
                         var tablId = rows[0].ADVICEHEADID;
                         
                         $.each(rows, function (i, rows) {

                          if(rows.APPROVE_STATUS=='1'){

                            var approval_btn ='<small class="label label-success" ><i class="fa fa-check"></i> Approve</small>';
                          }else if(rows.APPROVE_STATUS=='2'){
                             var approval_btn ='<small class="label label-danger"><i class="fa fa-close"></i> Rejected</small>';
                          }else{
                             var approval_btn ='<small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small>';
                          }

                           $('#childData_'+tablId).append('<tr><td class="text-right">'+srNo+'</td><td>'+rows.APPROVE_IND+'</td><td>'+rows.APPROVE_USER+'</td><td>'+rows.LEVEL_NO+'</td><td>'+rows.APPROVE_REMARK+'</td><td class="text-center">'+approval_btn+'</td></tr>');

                           srNo++;

                         });
                      }
                }
              }
    });
 }

</script>





@endsection







