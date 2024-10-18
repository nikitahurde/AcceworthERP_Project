@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .columnhide{
  display:none;
}
.required-field::before {

    content: "*";

    color: red;

  }
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
           Trip Exepens
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Fleet Transaction Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Trip Exepens</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Trip Exepens</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Trip Exepens</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/logistic/fleet-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Trip Exepens</a>

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

                        <th class="text-center">#</th>
                         <th class="text-center">SR.NO</th>
                        <th width="2%">Transaction Date</th>
                        <th>TRIP NO</th>
                        <th>VEHICLE NO</th>
                        <th>ROUTE CODE</th>
                        <th>ROUTE NAME</th>
                        <th>DIESEL RATE</th>
                        <th>MODEL</th>
                        <th>LOAD AVG</th>
                        <th>UL CPCT</th>
                        <th>UL AVG</th>
                        <th>EMPTY AVG</th>
                       
                        <th width="10%">Action</th>


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







 <div class="modal fade" id="indentDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete This Purchase Indent Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>



          <form action="{{ url('/finance/delete-purchase-body-indent') }}" method="post">



            @csrf



            <input type="hidden" name="bodyID" id="bodyID" value="">



            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">



          </form>



      </div>



    </div>



  </div>



</div>


<div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

    <form method="post" action="<?php echo url('/Transaction/Maintenance/Update-Jobcard-Closing-Dt'); ?>">

      @csrf

    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="text-align: center;font-weight: bold;color: #3C8DBC">JOB CARD COMPLITION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="row">
          <div class="col-md-6">
             
             <div class="form-group">

                          <label>JOB CARD NO: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                               </span>
                             <input type="text" class="form-control" name="jobcard_no" id="jobcard_no" readonly="">

                            </div>
                          
                            <small id="plant_err" style="color: red;"> </small>

                        </div>
          </div>
         <div class="col-md-6">
             
             <div class="form-group">

                          <label>CLOSING DATE: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-calendar" aria-hidden="true"></i>

                               </span>
                             <input type="text" class="form-control datepicker" name="closing_dt" id="closing_dt" placeholder="Select Date">

                            </div>
                                
                               <small id="closing_err" style="color:red;"></small>
                               <small id="emailHelp" class="form-text text-muted">

                                 {!! $errors->first('closing_dt', '<p class="help-block" style="color:red;">:message</p>') !!}

                               </small>

                        </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <center>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" onclick="return validation()">Save</button>
        </center>
      </div>
    </div>
  </form>
  </div>
</div>




@include('admin.include.footer')



<script type="text/javascript">
   $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });
</script>





<script type="text/javascript">

   function format ( d ) {
  //  console.log('d',d.id);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.FLEETTRANID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Indicator</th>'+
            '<th>Gl Code</th>'+
            '<th>Amount</th>'+
        '</tr></tbody>'+
    '</table>';
}

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

        url : "{{ url('/logistic/view-fleet-transaction') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.TRIPHID+')"><i class="fa fa-plus" id="minus'+full.TRIPHID+'" title="Toggle"></i></button>'
          }
         },
        { data:"DT_RowIndex",className:"text-center"},
       
         {
                    data:'VRDATE',
                    className:'text-right',
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
         { data: "TRIP_NO" },
         { data: "VEHICLE_NO" },
         { data: "ROUTE_CODE" },
         { data: "ROUTE_NAME" },
         { data: "DIESEL_RATE",className:"text-right" },
         { data: "MODEL" },
         { data: "LOAD_AVG",className:"text-right" },
         { data: "UL_CPCT",className:"text-right" },
         { data: "UL_AVG",className:"text-right"},
         { data: "EMPTY_AVG",className:"text-right" },
       {  
            render: function (data, type, full, meta){
                   
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-jobcard/'+btoa(full['TRIPHID'])+'/'+btoa(enableBtn)+'" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+full['TRIPHID']+');" disabled><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getExppdf(\''+full['ACC_CODE']+'\','+full['TRIPHID']+',\''+full['ADV_TYPE']+'\',\''+full['ADV_RATE']+'\',\''+full['ADV_AMT']+'\',\''+full['OWNER']+'\',\''+full['REF_TRIP_NO']+'\',\''+full['REF_QTY']+'\',\''+full['REF_HID']+'\');"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>'; 

                      return deletebtn;
              }
        
       },
       

      ],

       


     });



    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        console.log(tr);
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
    });



});


  function getVrno(vrno){

    $("#jobcard_no").val(vrno);

  }

   function showchildtable(tblid){
            var tblid;

           

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });
             
             $("#minus"+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('view-fleet-trans-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {tblid:tblid},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var objrow = data1.data;
                         var srNo=1;
                         var tableid = objrow[0].FLEETTRANID;
                       $.each(objrow, function (row, objrow) {

                        
                         $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td class="text-center"><p>'+objrow.IND_NAME+' </p></td><td class="text-center">'+objrow.GL_CODE+'</td><td class="text-right">'+objrow.AMOUNT+'</td></tr>');
                              srNo++;

                          });

                      }
                      
                  }
               }

          });
    }
</script>


<script type="text/javascript">

  function getExppdf(AccCode,tripId,payment_type,adv_rate,adv_amt,owner,reftripNo,ref_qty,ref_hid){


   // alert(ref_hid);

      $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });


      $.ajax({

              url:"{{ url('/Transaction/Logistic/get-trip-expense-offline-pdf') }}",

               method : "POST",

               type: "JSON",

               data: {AccCode:AccCode,tripId:tripId,payment_type:payment_type,adv_rate:adv_rate,adv_amt:adv_amt,owner:owner,reftripNo:reftripNo,ref_qty:ref_qty,ref_hid:ref_hid},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                         var fileN     = 'TRIPEXPENSE_'+1;
                        var link      = document.createElement('a');
                        link.href     = data1.url;
                        link.download = fileN+'.pdf';
                        link.dispatchEvent(new MouseEvent('click'));

                          }
                      
                  }
               }

          });

}

</script>

<script type="text/javascript">
  
  function downloadPDF(uniqNo,headId,vrno,tCode){


      var uniqNo,headId,vrno,tCode;
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

        url:"{{ url('pdf-donwload-when-view-jobcard-pages') }}",

        method : "POST",

        type: "JSON",

        data: {uniqNo: uniqNo,headId:headId,vrno:vrno,tCode:tCode},

        success:function(data){
          console.log('data',data);
          var data1 = JSON.parse(data);
          console.log('data1',data1);
          console.log('data1',data1);
          var fyYear = data1.data[0].FY_CODE;
          var fyCd = fyYear.split('-');
          var seriesCd = data1.data[0].SERIES_CODE;
          var vrNo = data1.data[0].VRNO;
          var fileN = 'JOBCARD_'+fyCd[0]+''+seriesCd+''+vrNo;
          var link = document.createElement('a');
          link.href = data1.url;
          link.download = fileN+'.pdf';
          link.dispatchEvent(new MouseEvent('click'));
        }

      });
    }
</script>

<script type="text/javascript">
  function pindentDelete(id) {

    //alert(id);return false;

    $("#indentDelete").modal('show');

    $("#bodyID").val(id);
  }
  
</script>

<script type="text/javascript">
  
  function validation(){

     var closing_dt = $("#closing_dt").val();

     if(closing_dt==''){

          $("#closing_err").html('This field is required');
          return false;
     }else{

        $("#closing_err").html('');
         
     }

  }

</script>

@endsection



