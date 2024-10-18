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
  width: 3%;
}
.colmnParti{
  width: 20%;
  text-align:left;
}
.totalText{
    font-size: 14px;
    font-weight: 600;
    text-align: right;
}
.colmnTwoCDT{
  width: 10%;
  text-align:right;
}
.colmnThreeCDT{
  width: 7%;
  text-align:right;
}
.colmnFourCDT{
  width: 7%;
  text-align:right;
}
.colmnFiveCDT{
  width: 25%;
  text-align:left;
}

/* ---- custom table css ----- */


</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>Rental Billing Schedule <small> : View List</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

      <li class="active"><a href="{{ url('/transaction/property-rental-utility/view-billing-schedule') }}">Property Rental Utility</a></li>

      <li class="active"><a href="{{ url('/transaction/property-rental-utility/view-billing-schedule') }}">View Billing Schedule</a></li>

    </ol>

  </section>
<!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Billing Schedule</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/property-rental-utility/add-billing-schedule') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Billing Schedule</a>

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

                  <th class="text-center">Account Code/Name</th>
                  <th class="text-center">Sale Order No.</th>
                  <th class="text-center">Beginning Date</th>
                  <th class="text-center">Tenure In Month</th>
                  <th class="text-center">Increament Indicator</th>
                  <th class="text-center">Increament Rate</th>
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
                  
                  $(nRow).attr('onclick', "showBodyDetail("+aData['BILLSCHID']+",\""+aData['ACC_CODE']+"\",\""+aData['SALE_ORDNO']+"\")"); // or whatever you choose to set as the id
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

            url : "{{ url('/transaction/property-rental-utility/view-billing-schedule') }}"

        },
        searching : true,
  
        columns: [
          
          { 

            render: function (data, type, full, meta) {

                var ACCCODE = full['ACC_CODE'];
                var ACCNAME = full['ACC_NAME'];

                return ACCNAME+' ( '+ACCCODE+' )';
            
            },
          },
          { data: "SALE_ORDNO" },
          {
              data:'BEGINNING_DATE',
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
          { data: "TENURE_INMONTH" },
          { data: "INC_INDICATOR" },
          { data: "INC_RATE" },
          {  
            render: function (data, type, full, meta){

                  var enableBtn = 'enable';
                  var deletebtn ='<a href="" class="btn btn-warning btn-xs actionBTN" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID();" disabled><i class="fa fa-trash" title="Delete"></i></button>';

                  return deletebtn;

            }

          },
              
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

  function showBodyDetail(hid,accCd,orderNo,){

      var fieldName = hid+'~'+accCd+'~'+orderNo;

      var pageIndentity='BILLING-SCHEDULE';

      $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

      $.ajax({

          url:"{{ url('/transaction/property-rental-utility/view-billing-schedule-body') }}",

          method : "POST",

          type: "JSON",

          data: {fieldName:fieldName,pageIndentity:pageIndentity},

          success:function(data){

            var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
              }else if(data1.response == 'success'){

                  $('#chieldBodyDetails').empty();

                  var headData = "<div class='divTableRow'><div class='divTableCell'>Sr.No</div><div class='divTableCell'>Account Code/Name</div><div class='divTableCell'>Schedule Date</div><div class='divTableCell'>Schedule Amount</div><div class='divTableCell'>Particular</div>";

                    $('#chieldBodyDetails').append(headData);

                  if(data1.dataDetails==''){
                   
                  }else{

                    var slno=1,schAmt=0;
                    $.each(data1.dataDetails, function(k, getData){

                      schAmt += parseFloat(getData.SCHEDULE_AMT);

                      var bodyData ="<div class='divTableRow'><div class='divTableBodyRow colmnOneCDT'>"+slno+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT' style='text-align:left;'>"+getData.ACC_NAME+" ( "+getData.ACC_CODE+" )</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+getData.SCHEDULE_DATE+"</div>"+
                        "<div class='divTableBodyRow colmnFourCDT'>"+getData.SCHEDULE_AMT+"</div>"+
                        "<div class='divTableBodyRow colmnParti'>"+getData.PARTICULAR+"</div>"+
                        "</div>";

                      $('#chieldBodyDetails').append(bodyData);


                      slno++;

                    });

                     var footerData = "<div class='divTableRow'><div class='divTableBodyRow'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow totalText'> Total : </div><div class='divTableCell' style='text-align:right;'>"+schAmt.toFixed(2)+"</div><div class='divTableBodyRow'></div>";

                    $('#chieldBodyDetails').append(footerData);

                  } /* /. CHECK DATA*/

              }/* /. RESPONSE CHECK*/

          }/* /. SUCCESS FUNCTION*/

      });/* /. AJAX FUCNTION*/

  }

</script>

@endsection