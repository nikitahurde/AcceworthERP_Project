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


            View Travel Requisition



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="#">Travel Requisition</a></li>



            <li class="Active"><a href="#">View Travel Requisition</a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Travel Requisition </h3>



                  <div class="box-tools pull-right">



          <a href="{{url('/Transaction/TravelRequisition/add-travelRequisition')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Travel Requisition</a>



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

                  <table id="example" class="table table-bordered table-striped table-hover" >

                    <thead>

                      <tr>

                        <th class="text-center">#</th>
                        
                        <th class="text-center">Sr.No</th>

                        <th class="text-center">Date</th>

                        <th class="text-center">Emp Name</th>
                        
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






<div class="modal fade" id="travelReqDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">







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







          <form action="{{ url('/Transaction/TravelRequisition/delete-travel-requisition') }}" method="post">







            @csrf







            <input type="hidden" name="travelReqId" id="travelReqId" value="">



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

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/Transaction/TravelRequisition/view-travelRequision') }}"

       },
       searching : true,
    

       columns: [
        
         { data:"",className:'details-control',
            render: function(data, type, full, meta) {
             return '<button id="showchildtable" onclick="plusBtnClick('+full['DT_RowIndex']+')"><i class="fa fa-plus" title="Edit"></i></button><input type="hidden" value='+full['ID']+' class="empHead_'+full['DT_RowIndex']+'">';
         }
         },
         { data:"DT_RowIndex",className:"text-center"},
         { data: "DATE",className:"text-right"},
           { render: function (data, type, full, meta){
             
             var empCode  = full['EMP_CODE'];
             var empName  = full['EMP_NAME'];
            

             var empCodeName = empName+' ['+empCode+' ]';

             return  empCodeName;


            }},

         {
          render: function (data, type, full, meta){
            
             var flag ='leave';

             var enableBtn = 'enable';
                     
             var deletebtn ='<input type="hidden" id="deleteinput_'+full['ID']+'" value="'+full['ID']+'"><a href="edit-travel-requisition/'+btoa(full['ID'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getId('+full['ID']+');"><i class="fa fa-trash" title="Delete"></i></button>';

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
    } );



});

function format ( d ) {
 
    return '<div class="tabs"><input name="tabs" type="radio" id="tab-1" checked="checked" class="input"/><label for="tab-1" class="label">Travel Requisition Details</label><div class="panel"><input type="hidden" value='+d.ID+' id="emp_Id"><table border="0" class="table table-bordered table-striped table-hover chieldtblecls"   style="padding-left:50px;" id="empRequiSh_'+d.ID+'">'+
        
    '</table></div>'+
     '<input name="tabs" type="radio" id="tab-2" class="input" onclick="secondchild()" /><label for="tab-2" class="label">Travel Accommodation Details</label><div class="panel"><input type="hidden" value='+d.ID+' id="empAccoId"><table border="0" class="table table-bordered table-striped table-hover chieldtblecls col-md-12" id="tblAcco_'+d.ID+'" style="padding-left:50px;"></table></div>'+
       '</div>';
}


function plusBtnClick(getId){

   var travelHeadId = $('.empHead_'+getId).val();
   $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

   });

   $.ajax({

              url:"{{ url('/Transaction/TravelRequisition/View-Travel-Requision-Shedule-Data') }}",

               method : "POST",

               type: "JSON",

               data: {travelHeadId: travelHeadId},

               success:function(data){

                  var data1 = JSON.parse(data);
                  
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){  

                      if(data1.data==''){

                       
                      }else{


                        var srNo=1;
                       

                        var tableid = data1.data[0].TRAVELREQHID;

                        var objrow = data1.data;
                        
                        var flag='shedule-requisition';

                        $('#empRequiSh_'+tableid ).append('<thead style="border: 2px solid #c1c1c1;"><tr>'+
                        '<th>Sr No.</th>'+
                        '<th>TRAVEL SHEDULE DATE</th>'+
                        '<th>TIME</th>'+
                        '<th>PLACE FROM</th>'+
                        '<th>PLACE TO</th>'+
                        '<th>MODE OF TRANSPORT</th>'+
                        '<th>REMARKS</th>'+
                        '</tr></thead>');

                        $.each(data1.data, function (i, objrow) {

                        $('#empRequiSh_'+tableid ).append('<tr style="border: 2px solid #c1c1c1;"><td class="text-right">'+srNo+'</td><td>'+objrow.TRAVEL_SHEDULE_DATE+'</td><td>'+objrow.TIME+'</td><td class="text-right">'+objrow.PLACE_FROM+'</td><td class="">'+objrow.PLACE_TO+'</td><td class="">'+objrow.MODE_OF_TRANSPORT+'</td><td class="">'+objrow.REMARKS+'</td></tr>');

                          srNo++;
                      });
                      }
                      
                  }
              }
          });

 
 }

 function secondchild(){

   var travelHeadId = $('#empAccoId').val();
  
   $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

   });

   $.ajax({

          url:"{{ url('/Transaction/TravelRequisition/View-Travel-Accommodation-Data') }}",

           method : "POST",

           type: "JSON",

           data: {travelHeadId: travelHeadId},

           success:function(data){

              var data1 = JSON.parse(data);
              
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){  

                if(data1.data==''){

                   
                }else{


                    var srNo=1;

                    var tableid = data1.data[0].TRAVELREQHID;

                    var objrow = data1.data;
                    
                    var flag='shedule-requisition';

                    $('#tblAcco_'+tableid ).append('<thead style="border: 2px solid #c1c1c1;"><tr>'+
                    '<th>Sr No.</th>'+
                    '<th>PLACE</th>'+
                    '<th>HOTEL</th>'+
                    '<th>DATE_TIME_FROM</th>'+
                    '<th>DATE_TIME_TO</th>'+
                    '<th>REMARKS</th>'+
                    '</tr></thead>');

                    $.each(data1.data, function (i, objrow){

                     $('#tblAcco_'+tableid ).append('<tr style="border: 2px solid #c1c1c1;"><td class="text-right">'+srNo+'</td><td>'+objrow.PLACE+'</td><td>'+objrow.HOTEL+'</td><td class="text-right">'+objrow.DATE_TIME_FROM+'</td><td class="">'+objrow.DATE_TIME_TO+'</td><td class="">'+objrow.REMARKS+'</td></tr>');

                      srNo++;
                  });
                }
                  
              }
          }
    });

 
 }

</script>



<script type="text/javascript">

  function getId(tblId)
  {
     
    var getval = $('#deleteinput_'+tblId).val();
    console.log('Value',getval);

    $("#travelReqDelete").modal('show');


    $("#travelReqId").val(getval);

  }

</script>





@endsection







