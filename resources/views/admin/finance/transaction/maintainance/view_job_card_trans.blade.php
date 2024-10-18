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
           Job Card
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>Job Card Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Master </a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">Job Card</a></li>

            <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Job Card</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Job Card</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Maintainance/Job-Crad-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Job Card</a>

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

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Vr No.</th>

                        <th class="text-center">Vr Date.</th>

                        <th class="text-center">Dept Code</th>

                        <th class="text-center">Series Name</th>

                        <th class="text-center">Plant Name</th>

                        <th class="text-center">Status</th>

                        <th class="text-center">PDF</th>

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
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.JCHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Item Name/Item Code</th>'+
            '<th>Qty</th>'+
            '<th>A-Qty</th>'+
            '<th class="hidecolumn">Approve Remark</th>'+
            '<th class="hidecolumn">Approve Status</th>'+
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

        url : "{{ url('/Transaction/Maintainance/View-Job-Crad-Trans') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.JCHID+')"><i class="fa fa-plus" id="minus'+full.VRNO+''+full.JCHID+'" title="Toggle"></i></button>'
          }
         },
        { data:"DT_RowIndex",className:"text-center"},
        { render: function (data, type, full, meta){

                   
                      var fy_code = full['FY_CODE'].split('-');
                      

                      var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                    

                      return VRNO;


                         

          }

          },
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
         {  
            render: function (data, type, full, meta){

                   
                    
                       var series = '<p>'+full['DEPT_NAME']+'</p>'+'<p style="line-height:2px;">('+full['DEPT_CODE']+')</p>';

                      return series;


                     }
        

         },
         {  
            render: function (data, type, full, meta){

                   
                       var series = '<p>'+full['SERIES_NAME']+'</p>'+'<p style="line-height:2px;">('+full['SERIES_CODE']+')</p>';
                  
                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var plant = '<p>'+full['PLANT_NAME']+'</p>'+'<p style="line-height:2px;">('+full['PLANT_CODE']+')</p>';
                    

                      return plant;
        }
        
       },
       {  
            render: function (data, type, full, meta){

                        if(full['STATUS']=='0'){

                          var fy_code = full['FY_CODE'].split('-');
                      

                           var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];

                            var btnstatus = '<span class="label label-success label-xs">OPEN</span> <button type="button" id="login" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" data-toggle="modal" data-target="#statusModal" onclick="getVrno(\''+VRNO+'\')"> <i class="fa fa-info" aria-hidden="true"></i></button>';
                         /*  var status = '<button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#statusModal" onclick="getVrno(\''+VRNO+'\')">OPEN</button>';
*/
                           
                        }else{

                          var btnstatus = '<span class="label label-danger label-xs">CLOSE</span>';
                        }
                   
                     
                    

                      return btnstatus;
        }
        
       },
       {  
            render: function (data, type, full, meta){
                   
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="edit-jobcard/'+btoa(full['JCHID'])+'/'+btoa(enableBtn)+'" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+full['JCHID']+');" disabled><i class="fa fa-trash" title="Delete"></i></button>'; 

                      return deletebtn;
              }
        
       },
       {
       	className:'text-center',
        render:function(data, type, full, meta){

          return '<button class="btn btn-success btn-xs pdfbtncl" type="button" id="pdfDown" onclick="downloadPDF('+full['DT_RowIndex']+','+full['JCHID']+','+full['VRNO']+',\''+full['TRAN_CODE']+'\');" title="pdf"><i class="fa fa-download" aria-hidden="true"></i></button>';
        }
       }

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

   function showchildtable(vrno,tblid){
            var vrno,tblid;

           

             $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });
             
             $("#minus"+vrno+''+tblid).toggleClass('fa-plus fa-minus rotate');

             $.ajax({

              url:"{{ url('view-job-card-chield-row-data') }}",

               method : "POST",

               type: "JSON",

               data: {vrno: vrno,tblid:tblid},

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
                         var tableid = objrow[0].JCHID;
                       $.each(objrow, function (row, objrow) {

                        if(objrow.FLAG=='3'){

                             $(".hidecolumn").addClass('columnhide');
                          
                          }else{

                        if(objrow.APPROVE_REMARK==null || objrow.APPROVE_REMARK==''){

                            var approval_btn1 ='<td class="text-right"><small class="label label-danger"><i class="fa fa-times"></i> No Remark</small></td>';
                          }else{

                            var approval_btn1 ='<td class="text-right"><small class="label label-danger"><i class="fa fa-times"></i> '+objrow.APPROVE_REMARK;+'</small></td>';
                           }
                        }

                        if(objrow.FLAG=='1'){

                        var approval_btn ='<td class="text-right"><small class="label label-success"><i class="fa fa-check"></i> Approve</small></td>';
                      }else if(objrow.FLAG=='0'){

                        var approval_btn ='<td class="text-right"><small class="label label-warning"><i class="fa fa-clock-o"></i> Pending</small></td>';
                      }else if(objrow.FLAG=='3'){

                            $(".hidecolumn").addClass('columnhide');
                          var approval_btn ='';
                      }else{

                        var approval_btn ='<td class="text-right"><small class="label label-warning"><i class="fa fa-clock-o"></i> Rejected</small></td>';
                      }

                      if(objrow.FLAG=='0'){
                      
                      
                       var enableBtn = 'enable';
                       var deletebtn ='<a href="edit-store-requisition/'+btoa(objrow.JCHID)+'/'+btoa(objrow.JCBID )+'/'+btoa(objrow.VRNO)+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return pindentDelete('+objrow.JCBID+');"><i class="fa fa-trash" title="Delete"></i></button>';

                    }else{
                        var enableBtn = 'enable';
                        var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                       
                    }
                               $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td><p>'+objrow.ITEM_NAME+' </p><p style="line-height: 2px;">( '+objrow.ITEM_CODE+')</p></td><td class="text-right">'+objrow.QTYRECD+'</td><td class="text-right">'+objrow.AQTYRECD+'</td></tr>');
                              srNo++;
                             });

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



