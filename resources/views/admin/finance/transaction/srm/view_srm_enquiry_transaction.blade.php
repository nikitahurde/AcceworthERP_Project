@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.crmnavbar')



@include('admin.include.crmsidebar')

<style>
  

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
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Enquiry Transaction

           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b>Enquiry Transaction Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}"> Transaction </a></li>

            <li class="active"><a href="{{ url('/Transaction/Purchase/View-Purchase-Enquiry-Trans') }}">View Purchase Enquiry</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Enquiry Trans</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Purchase/Purchase-Enquiry-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Enquiry Trans</a>

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

                        <th class="text-center">Plant Name</th>

                        <th class="text-center">Pfct Name</th>

                        <th class="text-center">Tran Name</th>

                        <th class="text-center">Quatation Status</th>

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



 <div class="modal fade" id="enquryDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

          <form action="{{ url('/Transaction/Purchase/Delete-Purchase-Enquery-Trans') }}" method="post">

            @csrf

            <input type="hidden" name="headID" id="headID" value="">
            <input type="hidden" name="bodyID" id="bodyID" value="">
            <input type="hidden" name="rowCount" id="totalRow" value="">

            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">

          </form>

      </div>

    </div>

  </div>

</div>




@include('admin.include.footer')

<script type="text/javascript">

   function format ( d ) {
  //  console.log('d',d.id);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover" id="childData_'+d.PENQHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Item Name</th>'+
            '<th>View Party</th>'+
            '<th>Vr No</th>'+
            '<th>Qty</th>'+
            '<th>A-Qty</th>'+
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

        url : "{{ url('/Transaction/Srm/View-Srm-Enquery-Trans') }}"

       },
       searching : true,
    

       columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.PENQHID+')"><i class="fa fa-plus" id="minus'+full.VRNO+''+full.PENQHID+'" title="Edit"></i></button>'
          }
         },
        
         { render: function (data, type, full, meta){

                   
                     //var fy_code = full['FY_CODE'].split('-');
                      

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
         {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['PLANT_NAME']+'</p>'+'<p style="line-height:2px;">('+full['PLANT_CODE']+')</p>';
                    

                      return series;


                         

                     }
        

       },
         {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['PFCT_NAME']+'</p>'+'<p style="line-height:2px;">('+full['PFCT_CODE']+')</p>';
                    

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
          {  
            render: function (data, type, full, meta){
              var pQuoH = full['PQuoSTATUSHD'];

              if(pQuoH == null){
                 var deletebtn ='<a href="Edit-Purchase-Indent-Trans/'+btoa(full['enqHid'])+'/'+btoa(full['VRNO'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return pEnqryDelete('+full['enqHid']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                  return deletebtn;
                }else{
                  var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                  return deletebtn;
                }
             /* var splitH = pQuoH.split(',');
              var found = splitH.find(function (element) {
                return element>0;
              }); 
              if(found == undefined){
                  var deletebtn ='<a href="Edit-Purchase-Indent-Trans/'+btoa(full['enqHid'])+'/'+btoa(full['VRNO'])+'" class="btn btn-warning btn-xs" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return pIndentDelete('+full['enqHid']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                  return deletebtn;
              }else{
                var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" disabled><i class="fa fa-trash" title="Delete"></i></button>';
                return deletebtn;
              }*/


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

              url:"{{ url('view-enquiry-chield-row-data') }}",

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
                        var tableid = objrow[0].PENQHID;
                        $.each(objrow, function (i, objrow) {

                          $('#childData_'+tableid).append('<tr><td class="text-right">'+srNo+'</td><td>'+objrow.ITEM_NAME+' <p>( '+objrow.ITEM_CODE+')</p></td><td class="text-right"><button type="button" class="btn btn-info notification" id="veiwPdetail_'+tblid+'_'+srNo+'" data-toggle="modal" data-target="#viewPartyDetail_'+tblid+'_'+srNo+'" onclick="showAllParty('+objrow.VRNO+','+objrow.PENQHID+','+objrow.PENQBID+','+tblid+','+srNo+')"><small class="viewaccnot"><center>View</center></small><span class="badge" id="accCount'+objrow.PENQHID+'_'+srNo+'">'+accCount.length+'</span></button></td><td class="text-right">'+objrow.VRNO+'</td><td class="text-right">'+objrow.QTYRECD+'</td><td class="text-right">'+objrow.AQTYRECD+' <div class="modal fade" id="viewPartyDetail_'+tblid+'_'+srNo+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-md" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel">Account Detail</h5></div></div></div><div class="modal-body table-responsive"><div class="boxer" id="allAccData'+tblid+'_'+srNo+'"></div><div class="modal-footer" style="text-align: center;"><button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button></div></div></div></div> </td> </tr>');
                              srNo++;
                        });

                      }
                      
                  }
               }

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
  function pEnqryDelete(id) {

    $("#enquryDelete").modal('show');

    $("#headID").val(id);
  }
  
</script>


@endsection



