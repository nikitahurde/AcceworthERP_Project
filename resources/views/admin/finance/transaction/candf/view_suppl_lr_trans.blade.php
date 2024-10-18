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
  .chieldtblecls>tbody>tr>td {
    line-height: 1;
  }
  .columnhide{
  display:none;
}

.dt-buttons{
    margin-bottom: -30px!important;
  }
  .dt-button{
   
    
    display: inline-block!important;
    font-weight: 600 !important;
    text-align: center!important;
    white-space: nowrap!important;
    vertical-align: middle!important;
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    user-select: none!important;
    border: 1px solid transparent!important;
    padding: .375rem .75rem!important;
    font-size: 15px!important;
    line-height: 1.5!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
  }

.dt-button:before {
  content: '\f02f';
  font-family: FontAwesome;
  padding-right: 5px;
  
}

.buttons-excel{

    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
}
.buttons-excel:before {
  content: '\f1c9';
  font-family: FontAwesome;
  padding-right: 5px;
  
}

.dt-buttons{
    margin-bottom: -30px!important;
  }
  .dt-button{
   
    
    display: inline-block!important;
    font-weight: 600 !important;
    text-align: center!important;
    white-space: nowrap!important;
    vertical-align: middle!important;
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    user-select: none!important;
    border: 1px solid transparent!important;
    padding: .375rem .75rem!important;
    font-size: 15px!important;
    line-height: 1.5!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
  }

  /* ---- custom table css ----- */

    .divTable{
      display: table;
      width: 100%;
    }
    .divTableRow {
      display: table-row;
    }
    .divTableCell {
      border: 1px solid #d4d4d4;
      display: table-cell;
      padding: 6px 8px;
      text-align: center;
      font-weight: bold;
      background-color: #f5deba;
    }
    .divTableBodyRow {
      border: 1px solid #d4d4d4;
      display: table-cell;
      padding: 3px 8px;
      text-align: center;
      font-size: 12px;
    }
    .divTableFoot {
      background-color: #EEE;
      display: table-footer-group;
      font-weight: bold;
    }
    .divTableBody {
      display: table-row-group;
    }
    .colmnOneCDT{
      width: 5%;
    }
    .colmnTwoCDT{
      width: 9%;
      text-align:left;
    }
    .colmnThreeCDT{
      width: 27%;
      text-align:left;
    }
    .colmnFourCDT{
      width: 13%;
      text-align:left;
    }
    .colmnFiveCDT{
      width: 10%;
      text-align:left;
    }

/* ---- custom table css ----- */
</style>

  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>
       Supplimentry Trip LR 
       <!--  < ?php echo ucwords($form_name) ?>  -->

      <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

      <small><b> Supplimentry Trip LR Details</b></small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}"> Master </a></li>

        <li class="active"><a href="{{ url('/view-mast-dealer') }}"> Supplimentry Trip LR</a></li>

        <li class="active"><a href="{{ url('/view-mast-dealer') }}">View  Supplimentry Trip LR</a></li>

      </ol>

    </section>

    <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-xs-12">
         
          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Supplimentry Trip LR</h3>

              <div class="box-tools pull-right">

                <a href="{{ url('/vehicle-planing-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add  Supplimentry Trip LR</a>

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

                    <th class="text-center">Vr Date.</th>

                    <th class="text-center">Vr No.</th>

                    <th class="text-center">From place/to place</th>

                    <th class="text-center">Customer Name</th>

                    <th class="text-center">Vehicle No</th>

                    <th class="text-center">Vehicle Owner</th>

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


     <section class="content" style="margin-top: -4%;">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <div class="divTable">

              <div class="divTableBody" id="chieldBodyDetails">
                
              </div><!-- /.divTableBody -->
              
            </div><!-- /.div table -->
            
          </div><!-- /.box-body -->
          
        </div><!-- /.Custom-Box -->
        
      </div><!-- /.col -->
      
    </div><!-- /.row -->
    
  </section>

  </div>

<!--  DELETE MODAL -->

  <div class="modal fade" id="trip_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          You Want To Delete This Delivery Order...!

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

          <form action="{{ url('/logistic/delete-trip-data-details') }}" method="post">

            @csrf

            <input type="hidden" name="fieldOne" id="fieldOne" value="">
            <input type="hidden" name="fieldTwo" id="fieldTwo" value="">
            <input type="hidden" name="fieldThree" id="fieldThree" value="">

            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">

          </form>

        </div>

      </div>

    </div>

  </div>

<!--  DELETE MODAL -->

@include('admin.include.footer')

<script type="text/javascript">

   function format ( d ) {
  //  console.log('d',d.id);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.TRIPHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Vr Date</th>'+
            '<th>Vr No.</th>'+
            '<th>From Place - To Place</th>'+
            '<th>Customer Name</th>'+
            '<th>Vehicle No</th>'+
            '<th>Vehicle Owner</th>'+
        '</tr></tbody>'+
    '</table>';
  }

  $(document).ready(function(){

      var date1 = new Date();
      var month = date1.getMonth() + 1;
      var tdate = date1.getDate();
      var mn    = month.toString().length > 1 ? month : "0" + month;
      var yr    = date1.getFullYear();
      var hr    =  date1.getHours(); 
      var min   = date1.getMinutes();
      var sec   = date1.getSeconds(); 

      var curr_date = tdate+''+mn+''+yr;
      var curr_time = hr+':'+min+':'+sec;

    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    var t = $("#example").DataTable({

      footerCallback: function ( row, data, start, end, display ) {
          var api = this.api(), data;

          var rowcount = data.length;

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
       'fnCreatedRow': function (nRow, aData, iDataIndex) {
                
          $(nRow).attr('onclick', "showBodyDetail("+aData['VRNO']+",\""+aData['TRIPHID']+"\")"); // or whatever you choose to set as the id
      },
      paging: true,
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
      buttons: [
                  {
                    extend: 'excelHtml5',
                    title: 'suppl_lr_trans_'+curr_date+'_'+curr_time,
                    footer: true
                  }
      ],
      ajax:{

        url : "{{ url('/transaction/CandF/view-suppl-lr-trans') }}"

      },
      searching : true,
  
      columns: [
        
         
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
          { 
            render: function (data, type, full, meta){

                  var fy_code = full['FY_CODE'].split('-');
                      
                  var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];

                  return VRNO;

            }

          },
          {  
            render: function (data, type, full, meta){

                  var FROM_PLACE = full['FROM_PLACE']+' - '+full['TO_PLACE'];
                    
                  return FROM_PLACE;
            }
          },
          {  
            render: function (data, type, full, meta){

                var series = full['ACC_NAME']+' - ('+full['ACC_CODE']+')';
                    
                return series;

            }
        
          },
          {  
            render: function (data, type, full, meta){

                var vehicle_no = full['VEHICLE_NO']; 
                  
                return vehicle_no;

            }
          },
          {  
            render: function (data, type, full, meta){

              var owner = full['OWNER'];
                    
              return owner;
            }
        
          },
          {  
            render: function (data, type, full, meta){
              // console.log('v',full['TRIP_PMT_STATUS']);
                if(full['LR_STATUS'] == 0 && full['TRIP_PMT_STATUS'] == 0 && full['TRIP_EXP_STATUS'] == 0){
                  var enableBtn = 'enable';
                      var deletebtn ='<a class="btn btn-warning btn-xs" title="edit" style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return tripDelete('+full['TRIPHID']+','+full['LR_STATUS']+','+full['DO_NO']+',\''+full['DO_DATE']+'\',\''+full['ITEM_CODE']+'\',\''+full['CP_CODE']+'\','+full['SLNO']+',\''+full['QTY']+'\');"  style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getLRpdf(\''+full['PLANT_CODE']+'\',\''+full['TRAN_CODE']+'\','+full['TRIPHID']+','+full['TRIP_DAY']+',\''+full['VRDATE']+'\',\''+full['VEHICLE_TYPE']+'\');"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>';
                    
                      return deletebtn;
                    
                }else if(full['LR_STATUS'] == 1 && full['TRIP_PMT_STATUS'] == 1 && full['TRIP_EXP_STATUS'] == 1){

                  var btnData = '<a class="btn btn-warning btn-xs" title="edit" disabled style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal"  style="font-size: 10px; padding: 2px 2px;" disabled><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getLRpdf(\''+full['PLANT_CODE']+'\',\''+full['TRAN_CODE']+'\','+full['TRIPHID']+','+full['TRIP_DAY']+',\''+full['VRDATE']+'\',\''+full['VEHICLE_TYPE']+'\');"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>';

                  return btnData;

                }else{

                  var btnData = '<a class="btn btn-warning btn-xs" title="edit" disabled style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal"  style="font-size: 10px; padding: 2px 2px;" disabled><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getLRpdf(\''+full['PLANT_CODE']+'\',\''+full['TRAN_CODE']+'\','+full['TRIPHID']+','+full['TRIP_DAY']+',\''+full['VRDATE']+'\',\''+full['VEHICLE_TYPE']+'\');"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>';

                  return btnData;

                }
                     
            },className:'text-center'
        
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

function getLRpdf(PlantCode,trans_code,tripId,trip_days,vrdate,vehicle_type){

 // alert(tripId);return false;

    var supp_lr ='SLR';

      $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });


      $.ajax({

              url:"{{ url('/Transaction/Logistic/get-lorry-offline-pdf') }}",

               method : "POST",

               type: "JSON",

               data: {PlantCode: PlantCode,trans_code:trans_code,tripId:tripId,trip_days:trip_days,vrdate:vrdate,vehicle_type:vehicle_type,supp_lr:supp_lr},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{

                          var ulrLenght = data1.url.length;

                     
                        for(var q=0;q<ulrLenght;q++){

                          var fileN     = 'LRTRAN_'+q;
                          
                          var link      = document.createElement('a');
                          link.href = data1.url[q];
                          link.download = 'LRTRAN_.pdf';

                          link.dispatchEvent(new MouseEvent('click'));

                        }




                    }
                      
                  }
               }

          });

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

          url:"{{ url('view-vehicle-plan-chield-row-data') }}",

          method : "POST",

          type: "JSON",

          data: {vrno: vrno,tblid:tblid},

          success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){

                  if(data1.data==''){
                   
                  }else{

                     var objrow = data1.data;
                     var srNo=1;
                     var tableid = objrow[0].TRIPHID;

            
                   $.each(objrow, function (row, objrow) {

                   	    var fy = objrow.FY_CODE;
                   	    var start_fy = fy.split("-");
                   	    var vrno = start_fy[0]+' '+objrow.SERIES_CODE+' '+objrow.VRNO ;

                        var vrdate = objrow.VRDATE;


                   	    var date = new Date(vrdate);
    		                var month = date.getMonth() + 1;
    		                if(vrdate=='0000-00-00'){
    		                   v_dt = '---';
    		                  }else{
    		                    
    		                  var v_dt =  date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
    		                  }

                          var vehicle_no = objrow.VEHICLE_NO != '' ? objrow.VEHICLE_NO : '---';
                   	   
                          $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td class="text-right">'+v_dt+'</td><td class="text-left">'+vrno+'</td><td class="text-left">'+objrow.FROM_PLACE+'-'+objrow.TO_PLACE+'</td><td class="text-left">'+objrow.CP_NAME+'- '+objrow.CP_CODE+'</td><td class="text-left">'+objrow.VEHICLE_NO+'</td><td class="text-left">'+objrow.OWNER+'</td></tr>');
                          srNo++;

                         });

                  }
                    
              }
          }

      });
  }


  function showBodyDetail(vrno,headId){

      var fieldName = vrno+'~'+headId;

      var pageIndentity='SUPPL_TRIP';

      $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

      $.ajax({

          url:"{{ url('show-details-on-click-of-row-in-view-page') }}",

          method : "POST",

          type: "JSON",

          data: {fieldName:fieldName,pageIndentity:pageIndentity},

          success:function(data){

            var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
              }else if(data1.response == 'success'){

                  $('#chieldBodyDetails').empty();

                  var headData = "<div class='divTableRow'><div class='divTableCell'>Sr.No</div><div class='divTableCell'>VR DATE</div><div class='divTableCell'>VR NO</div><div class='divTableCell'>Acc Name/Acc Code</div><div class='divTableCell'>From Place</div><div class='divTableCell'>To Place</div><div class='divTableCell'>CP Name /CP Code</div></div>";

                    $('#chieldBodyDetails').append(headData);

                  if(data1.dataDetails==''){
                   
                  }else{

                    var slno=1,totlQty=0;
                    $.each(data1.dataDetails, function(k, getData){
                      totlQty +=parseFloat(getData.QTY);

                      var doDate     = getData.VRDATE;
                      var splitDt    = doDate.split('-');
                      var formDoDate = splitDt[2]+'-'+splitDt[1]+'-'+splitDt[0];
                      var bodyData ="<div class='divTableRow'><div class='divTableBodyRow colmnOneCDT'>"+slno+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT' style='text-align:left;'>"+formDoDate+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+getData.VRNO+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+getData.ACC_NAME+' - '+getData.ACC_CODE+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+getData.FROM_PLACE+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+getData.TO_PLACE+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT' style='text-align:right;'>"+getData.CP_NAME+' - '+getData.CP_CODE+"</div></div>";

                      $('#chieldBodyDetails').append(bodyData);

                    slno++;});

                    var footerData = "<div class='divTableRow'><div class='divTableBodyRow'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow' style='text-align:right;'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow' ></div><div class='divTableBodyRow' style='text-align:right;'></div></div>";

                    $('#chieldBodyDetails').append(footerData);
                    
                  } /* /. CHECK DATA*/

              }/* /. RESPONSE CHECK*/

          }/* /. SUCCESS FUNCTION*/

      });/* /. AJAX FUCNTION*/

  }
</script>

<script type="text/javascript">
  function tripDelete(headid,lr_status,doNo,doDate,itemCd,cpCd,slNo,qtyTrip) {

    $("#trip_Delete").modal('show');
    var whereField = doNo+'~'+doDate+'~'+itemCd+'~'+cpCd+'~'+slNo+'~'+qtyTrip;
    $("#fieldOne").val(headid);
    $("#fieldTwo").val(lr_status);
    $("#fieldThree").val(whereField);
  }
  
</script>


<script type="text/javascript">

  function getTripLspdf(PlantCode,tripId,vrno){

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

      });

      $.ajax({

          url:"{{ url('/Transaction/Logistic/get-trip-loading-slip-offline-pdf') }}",

          method : "POST",

          type: "JSON",

          data: {PlantCode:PlantCode,tripId:tripId,vrno:vrno},

          success:function(data){

              var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.data==''){
                   
                  }else{

                     var fileN     = 'LOADINGSLIP_'+1;
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

@endsection