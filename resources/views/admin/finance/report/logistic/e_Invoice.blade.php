@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
  

  .text-right{
    text-align: right;
  }

  .datebill{
     width: 90px;
     text-align: right;
  }
  .texIndbox{
    text-align: left !important;
  }
  .texIndboxright{
    text-align: right !important;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
}
/*.table>tbody>tr:hover {
  background-color: #697068 !important;
}*/
.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #697068 !important;
}

.table tbody  tr  td #expired {
  color:white !important;
}
@keyframes blinker {
  50% {
    opacity: 0;
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
  .colDate{
    width:5%;
    text-align: right;
  }

  .colStatus{
    width: 2%;
    text-align:center;
  }
  .colLeft{
    width: 8%;
    
  }
  .colName{
    width: 15%;
  }
  .tranlName{
    width: 120px;
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

  /* /.----- excel btn css ------ */


</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

      <section class="content-header">

        <h1>
          e-Invoice Report
          <small><b>View Details</b></small> 
        </h1>

        <ol class="breadcrumb">

          <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
          <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i>e-Invoice Report</a></li>
        </ol>

      </section>

        <!-- Main content -->

      <section class="content">

        <div class="row">

          <div class="col-xs-12">
           
            <div class="box box-primary Custom-Box">

              <div class="box-header with-border" style="text-align: center;">

                <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View e-Invoice Report</h3>

                <div class="box-tools pull-right">
                 <!--  <a href="{{url('/logistic/fleet-certificate-transaction-form')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Vehicle Doc</a> -->
                </div>

              </div><!-- /.box-header -->

              <form action="">

                <div class="box-body">

                  <div class="row">

                    <div class="col-md-2">

                      <div class="form-group">

                          <label for="exampleInputEmail1">e-Invoice Status : <span class="required-field"></span> </label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <select name="eInvoiceStatus" id="eInvoice_Status" style="width: 100%;border-color: #d4d4d4;" onchange="eInvoiceStatusFun('EINVOICE');">
                              <option value="">--Select--</option>
                              <!-- <option value="volvo">General Revenue</option>
                              <option value="audi">Sale Credit Note</option> -->
                              <option value="saleInvoice">Sale Invoice</option>
                              <option value="purchaseReturn">Purchase Return</option>
                              <option value="saleDebitNote">Sale Debit Note</option>
                            </select>

                          </div>
                         
                      </div>

                    </div> <!-- /.col -->

                    <div class="col-md-2">

                      <div class="form-group">

                          <label for="exampleInputEmail1">T Code : <span class="required-field"></span> </label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text" name="t_Code" id="t_Code" class="form-control" placeholder="Select T Code" value="" autocomplete="off" readonly>

                          </div>
                         
                      </div>

                    </div> <!-- /.col -->

                    <div class="col-md-2">

                       <div class="form-group">

                          <label for="exampleInputEmail1"> Account Code :<span class="required-field"></span> </label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-calendar"></i>

                            </div>

                            <input list="accList" name="account_code" id="account_code" class="form-control" placeholder="Select Account Code" value="" autocomplete="off" onchange="eInvoiceStatusFun('ACCLIST');">

                            <datalist id="accList">
                              
                            </datalist>

                          </div>

                        </div>

                    </div>

                    <div class="col-md-2">

                        <div class="form-group">

                          <label for="exampleInputEmail1">Vr No :</label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                              </div>

                               <input list="vrnoList" id="vrNo" name="vrNo" class="form-control  pull-left" value="" placeholder="Select vr No" autocomplete="off">

                              <datalist id="vrnoList">

                                <option selected="selected" value="">-- Select --</option>

                              </datalist>

                          </div>
                          <input type="hidden" id="sbillHeadID" value="">
                      </div>

                    </div> <!-- /.col -->

                  </div> <!-- /.row -->

                  <div class="row">
                  
                    <div class="" style="margin-top: 1%;text-align: center;">

                       <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                        <button type="button" class="btn btn-warning" name="resetBtn" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

                    </div>

                  </div>

                </div><!-- /.box-body -->

              </form>
            
            </div><!-- /.custom box -->

          </div><!-- /.col-xs-12 -->

        </div><!-- /.row -->

      </section><!-- /.content -->

      <section class="content" style="margin-top: -5%;">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;"></div>

          <div class="box-body">

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                    <label for="exampleInputEmail1">e-Inv Ack-No :</label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                       <input type="text" id="eInvAckNo" name="eInvAckNo" class="form-control  pull-left" value="" placeholder="Enter e-Inv Ack-No" autocomplete="off">

                    </div>

                </div>

              </div> <!-- /.col -->

              <div class="col-md-4"></div>

              <div class="col-md-2">

                <div class="form-group">

                    <label for="exampleInputEmail1">e-Inv Ack-Dt :</label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                       <input type="text" id="eInvAckDt" name="eInvAckDt" class="form-control  pull-left" value="" placeholder="Enter e-Inv Ack-Dt" autocomplete="off">

                    </div>

                </div>

              </div> <!-- /.col -->
              
            </div><!-- /.row -->

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                    <label for="exampleInputEmail1">e-Waybill No :</label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                       <input type="text" id="ewayBillNo" name="ewayBillNo" class="form-control  pull-left" value="" placeholder="Enter e-Waybill No" autocomplete="off">

                    </div>

                </div>

              </div> <!-- /.col -->

              <div class="col-md-4"></div>

              <div class="col-md-2">

                <div class="form-group">

                    <label for="exampleInputEmail1">e-Waybill Dt :</label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                       <input type="text" id="eInvBillDt" name="eInvBillDt" class="form-control  pull-left" value="" placeholder="Enter e-Waybill Dt" autocomplete="off">

                    </div>

                </div>

              </div> <!-- /.col -->
              
            </div><!-- /.row -->

            <table id="eInvoicetbl" class="table table-bordered table-striped table-hover">

              <thead>

                <tr>
                    <th class="text-center" >Plan Status</th>
                    <th class="text-center" >Gate in Status</th>
                    <th class="text-center" >LR Status</th>
                    <th class="text-center" >SLR Status</th>
                    <th class="text-center">Gate Out Status</th>
                  
                </tr>

              </thead>

              <tbody>

              </tbody>
            </table>
            
          </div><!-- /.box-body -->

        </div><!-- /.Custom-Box -->
        
      </section><!-- /.section -->

</div>

@include('admin.include.footer')

<script type="text/javascript">

  $(document).ready(function(){

    $('#vrNo').on('change',function(){

      var vrNo = $('#vrNo').val();

      var xyz = $('#vrnoList option').filter(function() {
        return this.value == vrNo;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#vrNo').val('');
        $('#sbillHeadID').val('');
      }else{
        //$('#vrNo').val('');
        var dataSplit = msg.split('~');
        var sbillHeadID = dataSplit[1];
        $('#sbillHeadID').val(sbillHeadID);
      }

    });
  });

  function eInvoiceStatusFun(fieldType){

      var eInvoiceStatus = $('#eInvoice_Status').val();
      var account_code   = $('#account_code').val();
        
      if(fieldType == 'EINVOICE'){

        if(eInvoiceStatus == 'saleInvoice'){
          $('#t_Code').val('S5');
        }else if(eInvoiceStatus == 'purchaseReturn'){
          $('#t_Code').val('P6');
        }else if(eInvoiceStatus == 'saleDebitNote'){
          $('#t_Code').val('S6');
        }

      }
      

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/get-acc-list-for-e-invoice') }}",

          data: {eInvoiceStatus:eInvoiceStatus,account_code:account_code,fieldType:fieldType}, 

          success: function (data) {

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

            }else{

              if(fieldType == 'EINVOICE'){

                $("#accList").empty();

                $.each(data1.data_accList, function(k, getData){

                  $("#accList").append($('<option>',{

                    value:getData.ACC_CODE,

                    'data-xyz':getData.ACC_NAME,
                    text:getData.ACC_CODE+' [ '+getData.ACC_NAME+' ]'

                  }));

                });

              }else if(fieldType == 'ACCLIST'){

                $("#vrnoList").empty();

                $.each(data1.data_vrnoList, function(k, getData){

                  var vrno = getData.STARTYR+' '+getData.SERIES_CODE+' '+getData.VRNO;

                  $("#vrnoList").append($('<option>',{

                    value:vrno,
                    'data-xyz':vrno+'~'+getData.SBILLHID,
                    text:vrno

                  }));

                });

              }

            }
           
          },

      });

  }

$(document).ready(function(){

    $('#btnsearch').click(function(){
        
        var eInvoice_Status =  $('#eInvoice_Status').val();
        var account_code    =  $('#account_code').val();
        var vrNo            =  $('#vrNo').val();
        var t_Code          =  $('#t_Code').val();
        var sbillHeadID     =  $('#sbillHeadID').val();

        $('#eInvoicetbl').DataTable().destroy();

        load_data(eInvoice_Status,account_code,vrNo,t_Code,sbillHeadID);

    });

  function load_data(eInvoice_Status='',account_code='',vrNo='',t_Code=''){

    $('#eInvoicetbl').DataTable({

      processing: true,
      serverSide: false,
      info: true,
      bPaginate: false,
      scrollY: 300,
      scrollX: true,
      scroller: true,
      fixedHeader: true,
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
      buttons: [
                  {
                    extend: 'excelHtml5',
                    filename: 'JOURNAL_TRANSACTION'+$("#headerexcelDt").val(),
                    exportOptions: {
                          columns: [0,1,2,4,6,7]
                    }
                  }

                ],
      ajax:{
            url:'{{ url("/e-invoice-data-show-report") }}',
            data: {eInvoice_Status:eInvoice_Status,account_code:account_code,vrNo:vrNo,t_Code:t_Code}
          },
      columns: [

        {
            data:'VRDATE',
            render: function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                if(data=='0000-00-00'){
                  return '00-00-0000';
                }else{
                  
                return date.getDate() + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" +  date.getFullYear();
                }
            },
            className:'vrDateDataTbl'
        },

      ]

    });

  }
});

$('.number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
   if (this.value.length==1) {
    return false;}
});



</script>
@endsection



