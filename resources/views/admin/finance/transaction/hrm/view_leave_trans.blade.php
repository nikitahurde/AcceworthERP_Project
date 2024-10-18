@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style>

  .boxer {
    display: table;
    border-collapse: collapse;
  }
  .boxer .box-row {
    display: table-row;
  }
  .boxer .box-row:first-child {
    font-weight:bold;
  }
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


  .tabs {
     display: flex;
     flex-wrap: wrap;
     /*max-width: 700px;*/
     background: #efefef;
     box-shadow: 0 48px 80px -32px rgba(0, 0, 0, 0.25);
}

.input {
     position: absolute;
     opacity: 0;
}

.label {
     width: 100%;
    padding: 9px 30px;
    background: #e5e5e5;
    cursor: pointer;
    font-weight: bold;
    font-size: 14px;
    color: #7f7f7f;
    transition: background 0.1s, color 0.1s;
}
.activelbl {
    display: inline;
    padding: 0.2em 0.6em 0.3em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25em;
}
.label:hover {
     background: #d8d8d8;
}

.label:active {
     background: #ccc;

}

.input:focus + .label {
     z-index: 1;
}

.input:checked + .label {
     background: #52a0ce;
     color: #000;
}

.panel {
     display: none;
     padding: 20px 30px 30px;
     background: #fff;
     width: 100%;
}

@media (min-width: 600px) {
     .label {
          width: auto;
     }

     .panel {
          order: 99;
     }
}

.input:checked + .label + .panel {
     display: block;

}
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
            View Leave Transaction
          

          <small><b>Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Master Leave Transaction</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Leave Transaction</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Leave Transaction</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('Transaction/Leave/leave-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Leave Trans</a>

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
                        
                        <th class="text-center">Sr.No</th>

                        <th class="text-center">Vr Date</th>
                        
                        <th class="text-center">Emp Name/Code</th>

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







 <div class="modal fade" id="transLeaveDel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-sm" role="document">



    <div class="modal-content">



      <div class="modal-header">





        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>





        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>



      <div class="modal-body">



      You Want To Delete Data...!



      </div>



      <div class="modal-footer">



          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>



          <form action="{{ url('/Transaction/Leave/delete-leave-transaction') }}" method="post">



            @csrf



            <input type="hidden" name="transleaveId" id="transleaveId" value="">



            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">



          </form>



      </div>



    </div>



  </div>



</div>





@include('admin.include.footer')

<script type="text/javascript">

   function format ( d ) {
 

    return '<div class="tabs"><input name="tabs" type="radio" id="tab-1" checked="checked" class="input"/><label for="tab-1" class="label">Leave Transaction Details</label><div class="panel"><input type="hidden" value='+d.ID+' id="leavetrans"><table border="0" class="table table-bordered table-striped table-hover chieldtblecls"   style="padding-left:50px;" id="leavetransData_'+d.ID+'">'+
        
    '</table></div>'+
     
       
     '</div>';
}
</script>

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

        url : "{{ url('/Transaction/Leave/view-leave-trans') }}"

       },
       searching : true,
    

       columns: [

         { data:"",className:'details-control',
            render: function(data, type, full, meta) {
             return '<button id="showchildtable" onclick="plusBtnClick('+full['DT_RowIndex']+')"><i class="fa fa-plus" title="Edit"></i></button><input type="hidden" value='+full['ID']+' class="trans_'+full['DT_RowIndex']+'">';
          }
         },
        
        
         { data:"DT_RowIndex",className:"text-center"},
         { data: "DATE",className:"text-right" },
         { render: function (data, type, full, meta){
             
             var empCode  = full['EMP_CODE'];
             var empName  = full['EMP_NAME'];
            

             var empCodeName = empName+' ['+empCode+' ]';

             return  empCodeName;


            }},
         
          { render: function (data, type, full, meta){


                  if(full['TRANLEAVE_BLOCK']=='NO'){
                      return '<span class="activelbl label label-success">Active</span>';

                    }else if(full['TRANLEAVE_BLOCK']=='YES'){

                      return '<span class="label label-danger">Inactive</span>';

                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                     },className:"text-center"
          },
         
         {  
            render: function (data, type, full, meta){
                      
              var flag ='employee';
              var enableBtn = 'enable';
              var deletebtn ='<input type="hidden" id="deleteinput_'+full['ID']+'" value="'+full['ID']+'"><a href="edit-leave-trans/'+btoa(full['ID'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getId('+full['ID']+');" ><i class="fa fa-trash" title="Delete"></i></button>';
            

              return deletebtn;


                         

                     }
        

       },

         
         
        
      ],

       


     });


    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        
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

function getId(tblId)
  {
    var getval = $('#deleteinput_'+tblId).val();

    $("#transLeaveDel").modal('show');


    $("#transleaveId").val(getval);

  }

function plusBtnClick(getId){
  
   var id = $('.trans_'+getId).val();
   

    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $.ajax({

              url:"{{ url('/Transaction/Leave/view-leave-chield-trans-data') }}",

               method : "POST",

               type: "JSON",

               data: {id: id},

               success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){

                       
                      }
                      else{

                        var srNo=1;
                        var tableid = data1.data.ID;
                        var fromdate = data1.data.FROM_DATE;
                        var to_date = data1.data.TO_DATE;

                        var date = new Date(fromdate);
                        var month = date.getMonth() + 1;
                        var from_dt = date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();

                        var todate = new Date(to_date);
                        var monthdt = todate.getMonth() + 1;
                        var to_dt = todate.getDate() + "-" + (monthdt.toString().length > 1 ? monthdt : "0" + monthdt) + "-" +  todate.getFullYear();
                       

                        var flag='transData';

                        var deletebtn1 ='<a href="edit-transData/'+flag+'/'+tableid+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return empDelete('+tableid+');" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                        
                        // $('#leavetransData_'+tableid).empty();

                         $('#leavetransData_'+tableid ).append('<thead style="border: 2px solid #c1c1c1;"><tr>'+
                          '<th>Sr No.</th>'+
                          '<th>Vr Date</th>'+
                          '<th>Series Name/Code </th>'+
                          '<th>Plant Code</th>'+
                          '<th>PFCT Name/Code</th>'+
                          '<th>Emp Name/Code</th>'+
                          '<th>Designation Name/Code</th>'+
                          '<th>Leave Name/Code</th>'+
                          '<th>From Date</th>'+
                          '<th>To Date</th>'+
                          '<th>No of Days</th>'+
                          '<th>Reason Of Leave</th>'+
                          '<th>Contact Details</th>'+
                          '</tr></thead><tr><td>'+srNo+'</td>'+
                          '<td>'+data1.data.DATE+'</td>'+
                          '<td>'+data1.data.SERIES_NAME+' ['+data1.data.SERIES_CODE+']</td>'+
                          '<td>'+data1.data.PLANT_CODE+'</td>'+
                          '<td>'+data1.data.PFCT_NAME+' ['+data1.data.PFCT_CODE+']</td>'+
                          '<td>'+data1.data.EMP_NAME+' ['+data1.data.EMP_CODE+']</td>'+
                          '<td>'+data1.data.DESIG_NAME+' ['+data1.data.DESIG_CODE+']</td>'+
                          '<td>'+data1.data.LEAVE_NAME+' ['+data1.data.LEAVE_CODE+']</td>'+
                          '<td>'+from_dt+'</td>'+
                          '<td>'+to_dt+'</td>'+
                          '<td>'+data1.data.NO_OF_DAYS+'</td>'+
                          '<td>'+data1.data.REASON_LEAVE+'</td>'+
                          '<td>'+data1.data.CONTACT+'</td>'+
                          '</tr>'
                          )
                      }
                    }
                 
                  


                
          }
                      
        });
    
   }

 
 

 



  
</script>




@endsection



