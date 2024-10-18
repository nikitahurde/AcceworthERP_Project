@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }

  .alignLeftClass{
    text-align: left;
  }

  .alignRightClass{
    text-align: right;
  }

  .alignCenterClass{
    text-align: center;
  }

  @media screen and (max-width: 600px) {

    .viewpagein{
      width: auto;
    }

  }

  /* ----- excel btn css ------ */


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
    font-size: 12px!important;
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
  .vrDateDataTbl{
    width: 7%;
    text-align: left;
  }
  .vrVrNoDataTbl{
    width: 9%;
    text-align: left;
  }
  .refDataTbl{
    width: 19%;
    text-align: left;
  }
  .drAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .crAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .balAmtDataTbl{
    width: 15%;
    text-align: left;
  }
  .balTypeDataTbl{
    width: 5%;
    text-align: left;
  }
  .pfctDataTbl{
    width: 15%;
    text-align: left;
  }
  .btn-sm {
    padding: 4px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
  }

  table.dataTable {
      clear: both;
      margin-top: 10px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }
 
  @media screen and (max-width: 600px) {

  .PageTitle{

    float: left;

  }

}

.showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
}

/* /.----- excel btn css ------ */

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
  width: 10%;
  text-align:right;
}
.colmnThreeCDT{
  width: 35%;
  text-align:left;
}
.colmnFourCDT{
  width: 10%;
  text-align:right;
}
.colmnFiveCDT{
  width: 25%;
  text-align:left;
}
.hiddenField{
  display: none;
}

/* ---- custom table css ----- */


</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>Inward Transaction<small>View Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Master</a></li>

      <li class="active"><a href="{{ url('/transaction/c-and-f/view-inward-trans') }}">Inward Transaction</a></li>

      <li class="active"><a href="{{ url('/transaction/c-and-f/view-inward-trans') }}">View Inward Transaction</a></li>

    </ol>

  </section>
<!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Inward</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/c-and-f/form-inward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Inward</a>

            </div>

          </div><!-- /.box-header -->

          @if(Session::has('alert-success'))

            <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-check"></i>Success...!

                </h4>

              {!! session('alert-success') !!}

            </div>

          @endif

          @if(Session::has('alert-error'))

            <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-ban"></i>Error...!</h4>

              {!! session('alert-error') !!}

            </div>

          @endif

          <div class="box-body">

            <table id="example" class="table table-bordered table-striped table-hover">

              <thead>

                <tr>

                  <th class="text-center">Date</th>
                  <th class="text-center">VrNo</th>
                  <th class="text-center">Vehicle No</th>
                  <th class="text-center">Rake No</th>
                  <th class="text-center">CP Name</th>
                  <th class="text-center">SP Name</th>
                  <th class="text-center">Batch No</th>
                  <th class="text-center">Wagon No</th>
                  <th class="text-center">Item Name</th>
                  <th class="text-center">Quantity</th>
                  <th class="text-center">Um</th>
                  <th class="text-center">Quantity Recd</th>
                  <th class="text-center">Location Name</th>
                  <th class="text-center">From Place</th>
                  <th class="text-center">To Place</th>
                  <th class="text-center">Invoice No</th>
                  <th class="text-center">Action</th>
                  <th class="text-center hiddenField">CP Code</th>
                  <th class="text-center hiddenField">SP Code</th>

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

<!--  ---- DELETE MODAL --- -->

  <div class="modal fade" id="vehicleEntryDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          You Want To Delete This ...!

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

          <form action="{{ url('/transaction/CandF/delete-gate-inward-transaction-cf') }}" method="post">

            @csrf

            <input type="hidden" name="deletGateInward" value="" id="deletvehicle">

            <input type="submit" value="Delete" class="btn btn-sm btn-danger" style="margin-top: -20%;">

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

      var date1 = new Date();
      var month = date1.getMonth() + 1;
      var tdate = date1.getDate();
      var mn = month.toString().length > 1 ? month : "0" + month;
      var yr = date1.getFullYear();
      var hr =  date1.getHours(); 
      var min = date1.getMinutes();
      var sec = date1.getSeconds(); 

      var curr_date = tdate+''+mn+''+yr;
      var curr_time = hr+':'+min+':'+sec;

      var t = $("#example").DataTable({

        processing: true,
        serverSide:false,
        //scrollY:500,
        scrollX:true,
        'fnCreatedRow': function (nRow, aData, iDataIndex) {
                  
                  $(nRow).attr('onclick', "showBodyDetail("+aData['VRNO']+",\""+aData['SERIES_CODE']+"\",\""+aData['WAGON_NO']+"\",\""+aData['VEHICLE_NO']+"\")"); // or whatever you choose to set as the id
        },
        paging: true,
        pageLength: 25,
        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
        buttons: [
                  {
                    extend: 'excelHtml5',
                    title: 'inward_tran_list_'+curr_date+'_'+curr_time,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7]
                    }
                  }
                ],
        ajax:{

            url : "{{ url('/transaction/c-and-f/view-inward-trans') }}"

        },
        searching : true,
  
        columns: [
          
          {
              data:'INWARD_DATE',
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
              },
          },
          { 

            render: function (data, type, full, meta) {

                var vr_date = full['FY_CODE'];
                var datevr = vr_date.split('-');
                var getdate =datevr[1];
                var series_code = full['SERIES_CODE'];
                var vr_no = full['VRNO'];
               
                if(getdate!='' && series_code!=''){

                  if(series_code==null){
                    seriescode='';
                  }else{
                    seriescode=series_code;
                  }
                return  seriescode + ' ' + vr_no;
                }else{
                  return vr_no;
                }
                
            },
          },
          { data: "VEHICLE_NO" },
          { data: "RAKE_NO" },
          {   
              data :'CP_NAME',
              render: function (data, type, full, meta){

                if(full['CP_CODE'] == null){
                  var cpCode = '--';
                }else{
                  var cpCode = full['CP_CODE'];
                }
                
                if(full['CP_NAME'] == null){
                  var cpName = '--';
                  return '-- ( -- )';
                }else{
                  var cpName = full['CP_NAME'];
                  var cp_Name = 'display' && cpName.length > 15 ? cpName.substr(0, 15) + '…' : cpName;
                  return '<span data-tip="'+cpName+'">'+ cp_Name+' ( '+cpCode+' )</span> ';
                }    
            },
          },
          {   
              data :'SP_NAME',
              render: function (data, type, full, meta){

                if(full['SP_CODE'] == null){
                  var spCode = '--';
                }else{
                  var spCode = full['SP_CODE'];
                }
                
                if(full['SP_NAME'] == null){
                  var spName = '--';
                  return '-- ( -- )';
                }else{
                  var spName = full['SP_NAME'];
                  var sp_Name = 'display' && spName.length > 15 ? spName.substr(0, 15) + '…' : spName;
                  return '<span data-tip="'+spName+'">'+ sp_Name+' ( '+spCode+' )</span> ';
                }    
            },
          },
          { data: "BATCH_NO" },
          { data: "WAGON_NO" },
          { data: "ITEM_NAME" },
          { data: "QTY" },
          { data: "UM"},
          { data: "QTYRECD" },
          { data: "LOCATION_NAME" },
          { data: "FROM_PLACE" },
          { data: "TO_PLACE" },
          { data: "INVOICE_NO" },
          {  
            render: function (data, type, full, meta){

                  var enableBtn = 'enable';
                  var deletebtn ='<a href="" class="btn btn-warning btn-xs actionBTN" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID();" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                  return deletebtn;

            }

          },
          {data: 'CP_CODE',className:'hiddenField'},
          {data: 'SP_CODE',className:'hiddenField'},
              
        ],

      });

    });
</script>

<script type="text/javascript">

  function getID(cmpCd,fyCd,tranCd,sereisCd,vrNo){
    var fieldCol = cmpCd+'~'+fyCd+'~'+tranCd+'~'+sereisCd+'~'+vrNo;
    $("#vehicleEntryDelete").modal('show');
    $('#deletvehicle').val(fieldCol);

  }

  function showBodyDetail(vrno,sereisCd,wagonNo,vehicleNo){

      var fieldName = vrno+'~'+sereisCd+'~'+wagonNo+'~'+vehicleNo;

      var pageIndentity='INWARD';

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

                  var headData = "<div class='divTableRow'><div class='divTableCell'>Sr.No</div><div class='divTableCell'>Batch No</div><div class='divTableCell'>Item Code</div><div class='divTableCell'>Rake/STO Qty</div><div class='divTableCell'>UM</div><div class='divTableCell'>Qty Recd</div><div class='divTableCell'>Location Code</div></div>";

                    $('#chieldBodyDetails').append(headData);

                  if(data1.dataDetails==''){
                   
                  }else{

                    var slno=1,rakeQty=0,qtyRecd=0;
                    $.each(data1.dataDetails, function(k, getData){

                      rakeQty += parseFloat(getData.QTY);
                      qtyRecd += parseFloat(getData.QTYRECD);

                      var bodyData ="<div class='divTableRow'><div class='divTableBodyRow colmnOneCDT'>"+slno+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT' style='text-align:left;'>"+getData.BATCH_NO+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+getData.ITEM_NAME+"</div>"+
                        "<div class='divTableBodyRow colmnFourCDT'>"+getData.QTY+"</div>"+
                        "<div class='divTableBodyRow colmnOneCDT'>"+getData.UM+"</div>"+
                        "<div class='divTableBodyRow colmnFourCDT'>"+getData.QTYRECD+"</div>"+
                        "<div class='divTableBodyRow colmnFiveCDT'>"+getData.LOCATION_NAME+"</div></div>";

                      $('#chieldBodyDetails').append(bodyData);


                    slno++;});

                    var footerData = "<div class='divTableRow'><div class='divTableBodyRow'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow'></div><div class='divTableCell' style='text-align:right;'>"+rakeQty.toFixed(2)+"</div><div class='divTableBodyRow'></div><div class='divTableCell' style='text-align:right;'>"+qtyRecd.toFixed(2)+"</div><div class='divTableBodyRow'></div></div>";

                    $('#chieldBodyDetails').append(footerData);
                    
                  } /* /. CHECK DATA*/

              }/* /. RESPONSE CHECK*/

          }/* /. SUCCESS FUNCTION*/

      });/* /. AJAX FUCNTION*/

  }

</script>

@endsection