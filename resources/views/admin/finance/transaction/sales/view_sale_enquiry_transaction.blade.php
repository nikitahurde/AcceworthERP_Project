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
  .removeextraSInC{
    padding: 2px !important;
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

          <a href="{{ url('/Transaction/Sales/Sales-Enquery-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Sales Enquiry Trans</a>

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

                        <th class="text-center">Acc Name</th>

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







 





@include('admin.include.footer')

<script type="text/javascript">

   function format ( d ) {
  //  console.log('d',d.id);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.SENQHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th class="removeextraSInC">Sr. No.</th>'+
            '<th class="removeextraSInC">Item Name</th>'+
            '<th class="removeextraSInC">Item Description</th>'+
            '<th class="removeextraSInC">Qty</th>'+
            '<th class="removeextraSInC">A-Qty</th>'+
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

        url : "{{ url('/Transaction/Sales/View-Sales-Enquery-Trans') }}"

       },
       searching : true,
    

        columns: [
        
          { data:"",className:'details-control',
              render: function(data, type, full, meta) {
                return '<button id="showchildtable" onclick="showchildtable('+full.VRNO+','+full.SENQHID+')"><i class="fa fa-plus" id="minus'+full.VRNO+''+full.SENQHID+'" title="Edit"></i></button>'
              }
          },
          { 
            render: function (data, type, full, meta){
     
              var fy_code = full['FY_CODE'].split('-');
                      
              var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                    
              return VRNO;

            } 
          },
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
          {  
            render: function (data, type, full, meta){

              var acc = '<p>'+full['ACC_NAME']+'</p>'+'<p style="line-height:2px;">('+full['ACC_CODE']+')</p>';
                    
              return acc;
            }
          },

          {
            render: function (data, type, full, meta) {

              var scntrH = full['SQTNSTATUSHD'];

              if(scntrH == null){
                  return '<a class="btn btn-danger btn-xs"><i class="fa fa-close" aria-hidden="true"></i> Not Generated</a>';
              }else{

                var splitH = scntrH.split(',');
                var found = splitH.find(function (element) {
                  return element>0;
                }); 
                 
                return  '<a  class="btn btn-success btn-xs"><i class="fa fa-check" aria-hidden="true"></i> Quatation Generated</a>';
              }

            }
          },
          {  
            render: function (data, type, full, meta){

              var scntrHId = full['SQTNSTATUSHD'];

              if(scntrHId == null){

                  var deletebtn1 ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete" ></i></button>';
                    
                  return deletebtn1;
                    
                  return deletebtn;
              }else{

                var deletebtn1 ='<a class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" disabled><i class="fa fa-trash" title="Delete" ></i></button>';
                    
                  return deletebtn1;
              }
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

                          if((objrow.PARTICULAR == '' )|| (objrow.PARTICULAR == null)){
                            var particular  ='-----';
                          }else{
                            var particular  =objrow.PARTICULAR;
                          }

                          $('#childData_'+tableid).append('<tr><td class="text-right removeextraSInC">'+srNo+'</td><td class="removeextraSInC">'+objrow.ITEM_NAME+' <p style="margin: 0px;">( '+objrow.ITEM_CODE+')</p></td><td class="removeextraSInC">'+particular+'</td><td class="text-right removeextraSInC">'+objrow.QTYRECD+'</td><td class="text-right removeextraSInC">'+objrow.AQTYRECD+'</td> </tr>');
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
  function dealerDelete(id) {

    $("#dealerDelete").modal('show');

    $("#DealerID").val(id);
  }
  
</script>


@endsection



