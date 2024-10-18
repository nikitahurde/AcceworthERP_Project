@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js" ></script>
@include('admin.include.crmnavbar')



@include('admin.include.crmsidebar')

<style>
  

.box.box-primary {
    border-top-color: #4EBE8A!important;
}
  .text-right{
    text-align: right;
  }
  .notification {
    background-color: #3c8dbc;
    color: white;
    text-decoration: none;
    padding: 2px 4px;
    position: relative;
    display: inline-block;
    border-radius:3px;
  }
  .notification .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    padding: 2px 6px;
    border-radius: 50%;
    background-color: red;
    color: white;
  }
  .viewaccnot{
    font-size: 12px;
  }
 
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
  .boxer .box10 {
    display: table-cell;
    vertical-align: top;
    border: 1px solid #ddd;
    padding: 5px;
  }
  
   .texIndbox1{
    width: 5%; 
    text-align: center;
  }
  .rateIndbox{
    width: 15%;
    text-align: center;
  }
  .itmdetlheading{
    vertical-align: middle !important;
    text-align: left;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  th, td {
  padding: 5px;
}
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Sales Enquiry Transaction

           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b>Sales Enquiry Transaction Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Transaction </a></li>

            <li class="active"><a href="{{ url('/Transaction/Purchase/View-Purchase-Enquiry-Trans') }}">View Sales Enquiry</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Sales Enquiry Trans</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/CRM/CRM-Enquery-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Sales Enquiry Trans</a>

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

                        <th class="text-center">Vr. No</th>

                        <th class="text-center">Vr. Date</th>

                        <th class="text-center">Series Name</th>

                        <th class="text-center">Tran Name</th>

                        <th class="text-center">Quatation Status</th>

                        <th class="text-center">Enquiery Log</th>

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


<div class="modal fade" id="AddTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">
                <input type="hidden" id="itmOnQp1">
                <div class="col-md-12">
                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Enquiery Log</h5>
                </div>

              </div>

            </div>
            <form id="tasktrans">
            <div class="modal-body table-responsive">
              
              <div class="row">  
                <div class="col-md-6">
                  <div class="form-group">
                    <label> Vr Date: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                      <!-- < ?php $CurrentDate =date("d-m-Y"); ?> -->
                      <input type="text"  id="vr_date" name="vr_date" class="form-control  pull-left" value="" placeholder="Enter Vr Date" readonly>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="makeText"></div>
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label> Customer: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                      <input type="text"  id="from_user_Code" name="from_user_Code" class="form-control  pull-left" value="{{ Session::get('userid') }}" placeholder="Enter From User Code" readonly>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('from_user_Code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="makeText"></div>
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

              </div>

              <div class="row">
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label> Contact Person: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                    
                      <select id="to_user_Code" name="to_user_Code" class="form-control">
                        <option value="">--SELECT USER--</option>
                      </select>


                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('to_user_Code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="toUserName"></div>
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label> Enquiry No: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                      <input type="text"  id="enq_no" name="enq_no" class="form-control  pull-left" value="{{ old('enq_no') }}" maxlength="30" readonly="">

                      
                    </div> 
                    <input type="hidden" value="" name="taskName" id="taskName">
                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('enq_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="taskText"></div>
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                
              </div>

            <div class="row">
              
              <div class="col-md-12">
                <div class="form-group">
                  <label> Description: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                    <textarea type="text"  id="description" name="description" class="form-control  pull-left" value="{{ old('description') }}" placeholder="Enter Description"></textarea>

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('description', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>
                  <small>
                    <div class="pull-left showSeletedName" id="makeText"></div>
                  </small>

                </div>
                <!-- /.form-group -->
              </div>
            </div>

            <div class="row">
              <div class="col-md-12" >
                  <table class="table-bordered"  id="example1" style="width: 571px;">
                   
                    <tr>
                      <th>VR DATE</th>
                      <th>CUSTOMER</th>
                      <th>CONTACT PERSON</th>
                      <th>ENQ NO</th>
                      <th>DESCRIPTION</th>
                    </tr>
                  <tbody id="enq_data">
                    
                  </tbody>
                </table>
               </div>
            </div>

          </div>
        </form>

            <div class="modal-footer" style="text-align: center;">
             
              <button type="button" class="btn btn-primary" onclick="saveEnquiryLog();">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Save
                 </button>
            
            </div>
            
          </div>

        </div>

      </div>




 





@include('admin.include.footer')

<!-- <script type="text/javascript">
  
  $(document).ready(function () {
    $('#example1').DataTable();
});

</script> -->


<script type="text/javascript">

   function format ( d ) {
  //  console.log('d',d.id);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover" id="childData_'+d.SENQHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Item Name</th>'+
            '<th>View Party</th>'+
            '<th>Vr No</th>'+
            '<th>Qty</th>'+
            '<th>A-Qty</th>'+
            '<th>Action</th>'+
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

        url : "{{ url('/Transaction/Crm/View-Crm-Enquery-Trans') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.SENQHID+')"><i class="fa fa-plus" id="minus'+full.VRNO+''+full.SENQHID+'" title="Edit"></i></button>'
          }
         },
        
         { render: function (data, type, full, meta){

                   
                  

                      var VRNO = full['SERIES_CODE']+' '+full['VRNO'];
                    

                      return VRNO;


                         

          } },
         { data: "VRDATE",
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
         {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['SERIES_NAME']+'</p>'+'<p style="line-height:2px;">('+full['SERIES_CODE']+')</p>';
                    

                      return series;
   

                     }
        
       },
      
         { data: "TRAN_CODE"},

         {render: function (data, type, full, meta) {
                var bill = full['QTNCOMP_STATUS'];

                if(bill==0){
                  return '<a class="btn btn-danger btn-xs"><i class="fa fa-close" aria-hidden="true"></i> Not Genrated</a>';
                }else if(bill==1){
                  
                return  '<a  class="btn btn-success btn-xs"><i class="fa fa-check" aria-hidden="true"></i> Quatation Genrated</a>';;
                }
            }
          },

           { data:"",className:'details-control',
            render: function(data, type, full, meta) {

              var date = new Date(full.VRDATE);
              var month = date.getMonth() + 1;

              var getdate = date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();


              var VR_NO = full.SERIES_CODE+' '+full.VRNO;
           

             /* var VR_NO = full.SERIES_CODE+'-'+full.VRNO;

              console.log('vrddate',full['SERIES_CODE']);*/

            return '<button  class= "btn btn-primary btn-xs" id="showchildtable" onclick="showlog(\''+VR_NO+'\',\''+getdate+'\')">ENQUIERY LOG</button>'
          }
         },
         
         {  
            render: function (data, type, full, meta){
                   
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-dealer/'+btoa(full['id'])+'/'+btoa(enableBtn)+'" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+full['id']+');" disabled><i class="fa fa-trash" title="Delete" ></i></button>';
                    

                      return deletebtn;


                         

                     }
        

       },

         
         
        
      ],

       


     });

  

    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
       // console.log(tr);
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

   function showchildtable(vrno,tblid){
            var vrno,tblid;

            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $("#minus"+vrno+''+tblid).toggleClass('fa-plus fa-minus rotate');

            $.ajax({

              url:"{{ url('view-sales-enquiry-chield-row-data') }}",

              method : "POST",

              type: "JSON",

              data: {vrno: vrno,tblid:tblid},

              success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      var accCount =[];
                      
                        $.each(data1.count, function (i, objcount) {
                              accCount.push(data1.count);
                        });

                      if(data1.data==''){
                       
                      }else{

                        var objrow = data1.data;
                        var srNo=1;
                        var tableid = objrow[0].SENQHID;
                        $.each(objrow, function (i, objrow) {

                       
                              var deletebtn ='<a href="edit-purchase-enquiry/'+btoa(objrow.SENQHID)+'/'+btoa(objrow.SENQHID)+'/'+btoa(objrow.VRNO)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return pindentDelete('+objrow.SENQHID+');"><i class="fa fa-trash" title="Delete"></i></button>';

                          

                          $('#childData_'+tableid).append('<tr><td class="text-right">'+srNo+'</td><td>'+objrow.ITEM_NAME+' <p>( '+objrow.ITEM_CODE+')</p></td><td class="text-right"><button type="button" class="btn btn-info notification" id="veiwPdetail_'+tblid+'_'+srNo+'" data-toggle="modal" data-target="#viewPartyDetail_'+tblid+'_'+srNo+'" onclick="showAllParty('+objrow.VRNO+','+objrow.SENQHID+','+objrow.SENQBID+','+tblid+','+srNo+')"><small class="viewaccnot"><center>View</center></small><span class="badge" id="accCount'+objrow.SENQHID+'_'+srNo+'">'+accCount.length+'</span></button></td><td class="text-right">'+objrow.VRNO+'</td><td class="text-right">'+objrow.QTYRECD+'</td><td class="text-right">'+objrow.AQTYRECD+' <div class="modal fade" id="viewPartyDetail_'+tblid+'_'+srNo+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-md" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel">Account Detail</h5></div></div></div><div class="modal-body table-responsive"><div class="boxer" id="allAccData'+tblid+'_'+srNo+'"></div><div class="modal-footer" style="text-align: center;"><button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button></div></div></div></div> </td><td class="text-right">'+deletebtn+'</td> </tr>');
                              srNo++;
                        });

                      }
                      
                  }
               }

          });
    }


function showlog(vrNo,vrDate){

  $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

        });

  $("#enq_no").val(vrNo);
  $("#vr_date").val(vrDate);
   $("#AddTask").modal();

   $.ajax({

              url:"{{ url('get-user-list-for-enquiry') }}",

               method : "POST",

               type: "JSON",

               data: {vrNo: vrNo},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1.data);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      $("#to_user_Code").empty();

                      $.each(data1.data, function(index, val) {

                       $("#to_user_Code").append('<option value="'+val.USER_CODE+'">'+val.USER_CODE+'</option>');
                      

                      });
                      
                      $("#enq_data").empty();

                      $.each(data1.enq_data, function(index, value) {

                        var tabale_data = '<tr><td>'+value.VRDATE+'</td><td>'+value.FROM_USERCODE+'</td><td>'+value.TO_USERCODE+'</td><td>'+value.ENQNO+'</td><td>'+value.REMARK+'</td></tr>';

                          $("#enq_data").append(tabale_data);
                      

                      });
                      
                     
                  }
               }

          });

  



}



 function saveEnquiryLog(){
    var data = $("#tasktrans").serialize();

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

            type: 'POST',

            url: "{{ url('/enquiery-log-to-user') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

             // console.log('data',data);
              //  console.log('data',data);
               window.location.href = "{{ url('crmdashboard') }}";
              },

    });
  }



    function showAllParty(vrNo,headid,bodyid,rownm,srNo){

      var vrNo,headid,bodyid,rownm;

     
        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

        });

        $.ajax({

              url:"{{ url('get-vendor-for-enquiry') }}",

               method : "POST",

               type: "JSON",

               data: {vrNo: vrNo,headid:headid,bodyid:bodyid},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{
                        var obj_row = data1.data;
                        var srac=1;
                        /*var countAcc= data1.data.length;
                        $('#accCount'+headid+'_'+srNo).html(countAcc);*/
                        $('#allAccData'+rownm+'_'+srNo).empty();
                        var headData = '<div class="box-row" id="appendbody'+rownm+'_'+srNo+'"><div class="box10 texIndbox1">Sr.No.</div><div class="box10 rateIndbox">Acc Code</div><div class="box10 rateIndbox">Acc Name</div></div></div>';
                      $('#allAccData'+rownm+'_'+srNo).append(headData);
                        $.each(obj_row, function (i, obj_row) {

                            var bodyData = '<div class="box-row"><div class="box10 itmdetlheading"><span id="srnum">'+srac+'</span></div><div class="box10 itmdetlheading"><span id="accCode">'+obj_row.ACC_CODE+'</span> </div><div class="box10 itmdetlheading"><span id="accName"> '+obj_row.ACC_NAME+'</span></div></div>';

                            srac++;
                            $('#allAccData'+rownm+'_'+srNo).append(bodyData);
                        });
                      }
                      
                  }
               }

          });
    }
</script>

<script type="text/javascript">
  function dealerDelete(id) {

    $("#dealerDelete").modal('show');

    $("#DealerID").val(id);
  }
  
</script>



@endsection



