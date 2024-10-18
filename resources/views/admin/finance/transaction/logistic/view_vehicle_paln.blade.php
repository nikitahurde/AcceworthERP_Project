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
       Trip Vehicle Plan
       <!--  < ?php echo ucwords($form_name) ?>  -->

      <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

      <small><b>Trip Vehicle Plan Details</b></small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}"> Master </a></li>

        <li class="active"><a href="{{ url('/view-mast-dealer') }}">Trip Vehicle Plan</a></li>

        <li class="active"><a href="{{ url('/view-mast-dealer') }}">View Trip Vehicle Plan</a></li>

      </ol>

    </section>

    <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-xs-12">
         
          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Trip Vehicle Plan</h3>

              <div class="box-tools pull-right">

                <a href="{{ url('/vehicle-planing-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Trip Vehicle Plan</a>

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


                    <th class="text-center">Sr.NO</th>

                    <th class="text-center">Vr Date.</th>

                    <th class="text-center">Vr No.</th>

                    <th class="text-center">From place/to place</th>

                    <th class="text-center">Custmer Name</th>

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

    <!-- ---- START : SECTION FOR SHOW DETAILS ---- -->

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
    
  </section><!-- /.section -->

<!-- ---- START : SECTION FOR SHOW DETAILS ---- -->

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
            <input type="hidden" name="fieldFour" id="fieldFour" value="">

            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">

          </form>

        </div>

      </div>

    </div>

  </div>

<!--  DELETE MODAL -->

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
      'fnCreatedRow': function (nRow, aData, iDataIndex) {
                
          $(nRow).attr('onclick', "showBodyDetail("+aData['VRNO']+",\""+aData['TRIPHID']+"\")"); // or whatever you choose to set as the id
      },
      paging: true,
      ajax:{

        url : "{{ url('/view-vehicle-planing-mast') }}"

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
              console.log('v',full['TRIP_PMT_STATUS']);
                if(full['LR_STATUS'] == 0 && full['TRIP_PMT_STATUS'] == 0 && full['TRIP_EXP_STATUS'] == 0){
                  var enableBtn = 'enable';

                      var deletebtn ='<a href="Edit-trip-planing/'+btoa(full['TRIPHID'])+'" class="btn btn-warning btn-xs" title="edit" style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return tripDelete('+full['TRIPHID']+','+full['LR_STATUS']+','+full['DO_NO']+',\''+full['DO_DATE']+'\',\''+full['ITEM_CODE']+'\',\''+full['CP_CODE']+'\','+full['SLNO']+',\''+full['QTY']+'\',\''+full['TRIP_WO_ITEM']+'\');"  style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getTripLspdf(\''+full['PLANT_CODE']+'\','+full['TRIPHID']+',\''+full['VRNO']+'\');"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>';
                    
                      return deletebtn; 
                  /*if(full['LR_STATUS'] == 1 && full['TRIP_PMT_STATUS'] == 1 && full['TRIP_EXP_STATUS'] == 1){*/
                    
                }else if(full['LR_STATUS'] == 1 && full['TRIP_PMT_STATUS'] == 1 && full['TRIP_EXP_STATUS'] == 1){

                  var btnData = '<a class="btn btn-warning btn-xs" title="edit" disabled style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal"  style="font-size: 10px; padding: 2px 2px;" disabled><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getTripLspdf(\''+full['PLANT_CODE']+'\','+full['TRIPHID']+',\''+full['VRNO']+'\');"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>';

                  return btnData;

                }else{

                  var btnData = '<a class="btn btn-warning btn-xs" title="edit" disabled style="font-size: 10px; padding: 2px 2px;"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal"  style="font-size: 10px; padding: 2px 2px;" disabled><i class="fa fa-trash" title="Delete"></i></button> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return getTripLspdf(\''+full['PLANT_CODE']+'\','+full['TRIPHID']+',\''+full['VRNO']+'\');"><i class="fa fa-file-pdf-o" title="PRINT"></i></button>';

                  return btnData;

                }
                     
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

  function showBodyDetail(vrno,headId){

      var fieldName = vrno+'~'+headId;

      var pageIndentity='TRIP_PLANNING';

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

                  var headData = "<div class='divTableRow'><div class='divTableCell'>Sr.No</div><div class='divTableCell'>Do Number</div><div class='divTableCell'>Do Date</div><div class='divTableCell'>Item Name/Item Code</div><div class='divTableCell'>Remark</div><div class='divTableCell'>To Place</div><div class='divTableCell'>Qty</div></div>";

                    $('#chieldBodyDetails').append(headData);

                  if(data1.dataDetails==''){
                   
                  }else{

                    var slno=1,totlQty=0;
                    $.each(data1.dataDetails, function(k, getData){
                      totlQty +=parseFloat(getData.QTY);

                      var doDate     = getData.DO_DATE;
                      var splitDt    = doDate.split('-');
                      var formDoDate = splitDt[2]+'-'+splitDt[1]+'-'+splitDt[0];
                      var bodyData ="<div class='divTableRow'><div class='divTableBodyRow colmnOneCDT'>"+slno+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT' style='text-align:left;'>"+getData.DO_NO+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+formDoDate+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+getData.ITEM_NAME+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+getData.REMARK+"</div>"+
                        "<div class='divTableBodyRow colmnFourCDT'>"+getData.TO_PLACE+"</div>"+
                        "<div class='divTableBodyRow colmnFiveCDT' style='text-align:right;'>"+getData.QTY+"</div></div>";

                      $('#chieldBodyDetails').append(bodyData);

                    slno++;});

                    var footerData = "<div class='divTableRow'><div class='divTableBodyRow'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow' style='text-align:right;'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow' ></div><div class='divTableCell' style='text-align:right;'>"+totlQty.toFixed(3)+"</div></div>";

                    $('#chieldBodyDetails').append(footerData);
                    
                  } /* /. CHECK DATA*/

              }/* /. RESPONSE CHECK*/

          }/* /. SUCCESS FUNCTION*/

      });/* /. AJAX FUCNTION*/

  }
</script>

<script type="text/javascript">
  function tripDelete(headid,lr_status,doNo,doDate,itemCd,cpCd,slNo,qtyTrip,plan_status) {

    $("#trip_Delete").modal('show');
    var whereField = doNo+'~'+doDate+'~'+itemCd+'~'+cpCd+'~'+slNo+'~'+qtyTrip;
    $("#fieldOne").val(headid);
    $("#fieldTwo").val(lr_status);
    $("#fieldThree").val(whereField);
    $("#fieldFour").val(plan_status);
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