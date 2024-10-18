@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')

<style type="text/css">
  .bg-yellow, .callout.callout-warning, .alert-warning, .label-warning, .modal-warning .modal-body {
    background-color: #ce830c !important;
}
.columnhide{
  display:none;
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
    width: 23%;
  }
  
   .texIndbox1{
    width: 5%; 
    text-align: center;
  }
  .texIndbox{
    text-align: left;
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
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .pdfbtndn{
    padding: 2px;
    padding-left: 7px;
    padding-right: 7px;
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
      width: 7%;
      text-align:right;
      padding-top: 9px;
      padding-bottom: 7px;
    }
    .colmnThreeCDT{
      width: 27%;
      text-align:right;
      padding-top: 9px;
      padding-bottom: 7px;
    }
    .colmnThree{
      width: 31%;
      text-align:center;
      padding-top: 9px;
      padding-bottom: 7px;
      line-height: 1.2;
    }
    .colmnFourCDT{
      width: 6%;
      text-align:left;
    }
    .colmnFiveCDT{
      width: 5%;
      text-align:left;
    }
    .colmnSixCDT{
      width: 6%;
      text-align:left;
    }
    .colmnSevenCDT{
      width: 6%;
      text-align:left;
    }
    .colmnEaightCDT{
      width: 6%;
      text-align:left;
    }
    .colmnNineCDT{
      width: 6%;
      text-align:left;
    }
    .colmnTenCDT{
      width: 6%;
      text-align:left;
    }
    .colmnEleCDT{
      width: 7%;
      text-align:left;
    }
    .colmnTwelCDT{
      width: 48%;
      text-align:left;
    }

/* ---- custom table css ----- */

.messageAlert{
  display: none;
}
.noteClass{
  font-size: 15px;
  color: red;
  margin-bottom: -3%;
  margin-top: 1%;
}
</style>
  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
            Transporter Sale Bill 
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>: Details Of Sale Bill</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active"><a href="javascript:void(0)">Transaction</a></li>

            <li class="active"><a href="{{ url('/transaction/Logistic/view-transporter-sale-bill') }}">Logistic</a></li>
            <li class="active"><a href="{{ url('/transaction/Logistic/view-transporter-sale-bill') }}">View Transporter Sale Bill</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Transporter Sale Bill</h3>

                  <div class="box-tools pull-right">

                    <a href="{{ url('/transaction/Logistic/transporter-sale-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Transporter Sale Bill</a>

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

                  <div class="noteClass"><b>Note : </b> <span> Clicking on the line, you will see the details of the transporter bill below the table. </span></div>

                  <div style="margin-top: 2%;">
                    <table id="example" class="table table-bordered table-striped table-hover" >

                      <thead>

                        <tr>

                          <th class="text-center">BILL NO.</th>

                          <th class="text-center">BILL DATE</th>

                          <th class="text-center">ACC. CODE</th>
                          
                          <th class="text-center">ACC. NAME</th>

                          <th class="text-center">VEHICLE NO.</th>
                          
                          <th class="text-center">WAGON NO.</th>

                          <th class="text-center">INVOICE NO.</th>

                          <th class="text-center">LR NO.</th>

                          <th class="text-center">LR DATE</th>

                          <th class="text-center">ACTION</th>
                         
                        </tr>

                      </thead>

                      <tbody>

                    

                      </tbody>

                    </table>

                  </div>

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

                      <div class="row" style="margin-top: 1%;">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2" style='text-align: right;'><span style="font-weight: 600;">Bill Total :- </span>&nbsp;</div>
                        <div class="col-sm-5" id="footerTblBasicBal" style="padding-left: 5.2%;font-weight: 600;display: inline-flex;"></div>
                        
                      </div>
                      
                    </div><!-- /.box-body -->
                    
                  </div><!-- /.Custom-Box -->
                  
                </div><!-- /.col -->
                
              </div><!-- /.row -->
              
            </section><!-- /.section -->

          <!-- ---- START : SECTION FOR SHOW DETAILS ---- -->

      </div>

<!-- ------ delete data modal ------ -->

  <div class="modal fade" id="SaleBillDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

          <form action="{{ url('/Transaction/logistic/Delete-transporter-sale-bill') }}" method="post">

            @csrf

            <input type="hidden" name="tsaleBilldeleteid" value="" id='updateid'>

            <input type="submit" value="delete" class="btn btn-sm btn-danger" style="margin-top: -15%;">

          </form>

        </div>

      </div>

    </div>

  </div>

<!-- ------ delete data modal ------ -->


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
      serverSide: false,
      info: true,
      bPaginate: false,
      scrollY: 350,
      scrollX: true,
      scroller: true,
      fixedHeader: true,
      language: {
          processing: "<img src='<?php echo url('public/dist/img/Spinner.gif') ?>'>"
      },
      order: [[0, 'desc'],[1, 'desc']],
      columnDefs: [
         { orderable: false, targets:2 },
         { orderable: false, targets:3 },
         { orderable: false, targets:4 },
         { orderable: false, targets:5 },
         { orderable: false, targets:6 },
         { orderable: false, targets:7 },
         { orderable: false, targets:8 },
         { orderable: false, targets:9 }
      ],
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
       buttons: [
                
                ],
       'fnCreatedRow': function (nRow, aData, iDataIndex) {
                
          $(nRow).attr('onclick', "showBodyDetail("+aData['SVRNO']+",\""+aData['SBILLHID']+"\")"); // or whatever you choose to set as the id
      },
       ajax:{

        url : "{{ url('/transaction/Logistic/view-transporter-sale-bill') }}"

       },
       searching : true,
       columns: [
          {
            data:'VRNO',
            'render': function (data, type, full, meta){

                var VRNO = full['SVRNO'];
                var SERIESCODE = full['SSERIES_CODE'];
                var fyCode = full['SFYCODE'];
                var fySplite = fyCode.split('-');
                var NEWVRNO = fySplite[0]+'/'+SERIESCODE+'/'+VRNO;

                return NEWVRNO+'<input type="hidden" name="vrNo[]" id="vrNoId'+full['DT_RowIndex']+'" value="'+NEWVRNO+'">';

            },
            className:'text-left'
          },
          {
              data:'SVRDATE',
              className:'dtvrDate',
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  var mdate = date.getDate();
                  if(data=='0000-00-00'){
                    var newVrDt = '00-00-0000';
                  }else{
                    
                    var newVrDt = (mdate.toString().length > 1 ? mdate : "0" + mdate) + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }

                  return newVrDt+'<input type="hidden" name="vrDt[]" id="vrDtId" value="'+newVrDt+'">';
              },
              className:'text-right'
          },
          {
              data:'ACC_CODE',
              name:'ACC_CODE',
              className: "text-left"
          },
          {
              data:'ACC_NAME',
              name:'ACC_NAME',
              className: "text-left"
          },
          {
            data:'VEHICLENO',
            name:'VEHICLENO',
            className: "text-left"

          },
          {
            data:'WAGON_NO',
            name:'WAGON_NO',
            className: "text-right"
          },
          {
            data:'INVC_NO',
            name:'INVC_NO',
            className: "text-right"
          },
          {
              data:'LR_NO',
              name:'LR_NO',
              className: "text-left"
          },
          {
              data:'LR_DATE',
              name:'LR_DATE',
              className: "text-right"
          },
          {  
          render: function (data, type, full, meta){
            
              var deletebtn ='<button class="btn btn-danger btn-xs" data-toggle="modal"  onclick="return provBillDelete('+full['TRIPHID']+','+full['SBILLHID']+');"><i class="fa fa-trash" title="Delete"></i></button>&nbsp;&nbsp; | &nbsp;&nbsp;<button class="btn btn-warning btn-xs" data-toggle="modal"  onclick="return transporterBillOffLinePdf('+full['TRIPHID']+','+full['SBILLHID']+','+full['DT_RowIndex']+','+full['SVRNO']+',\''+full['T_CODE']+'\',\''+full['SVRDATE']+'\');"><i class="fa fa-file-pdf-o" title="Download PDF"></i></button>&nbsp;&nbsp;';
              return deletebtn;
            

          },
          className: "text-center"

       },
 
        
      ],

       


     });



    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        //console.log(tr);
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

  function showBodyDetail(vrno,tblid){

      var fieldName = vrno+'~'+tblid;

      var pageIndentity='TRIP_PLANNING';

      $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

      $.ajax({

          url:"{{ url('/logistics/view-sale-bill-transporter-chield-row-data') }}",

          method : "POST",

          type: "JSON",

          data: {vrno:vrno,tblid:tblid},

          success:function(data){

            var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>"); 

              }else if(data1.response == 'success'){

                  $('#chieldBodyDetails').empty();

                  var headData = "<div class='divTableRow'><div class='divTableCell'>VRNO</div><div class='divTableCell'>VR-DATE</div><div class='divTableCell'>PARTICULAR</div><div class='divTableCell'>TAX CODE</div><div class='divTableCell'>QTY</div><div class='divTableCell'>RATE</div><div class='divTableCell'>BASICAMT</div><div class='divTableCell'>SGST</div><div class='divTableCell'>CGST</div><div class='divTableCell'>IGST</div><div class='divTableCell'>ROUND OFF</div><div class='divTableCell' style='line-height: 0.8;'>GRAND TOTAL</div></div>";

                  $('#chieldBodyDetails').append(headData);

                 var objrow = data1.data;
                 var srNo=1;
                 var tableid = objrow[0].PSBILLHID;

                 //console.log('child data',objrow);

                 var totalBillAmt = 0;
                 var sgstTot = 0;
                 var cgstTot = 0;
                 var igstTot = 0;
                 var grandTot = 0;

                $.each(objrow, function (i, objrow) {

                  //console.log('loop child data',objrow.LR_NO);

                  var fyCD = objrow.FY_CODE.split('-');

                  var newDt = objrow.VRDATE.split('-');

                  var newYr = newDt[0];
                  var newMn = newDt[1];
                  var newDt = newDt[2];

                  var mVrDate = newDt+'-'+newMn+'-'+newYr;

                  var getSgst = Math.round(objrow.SGST);
                  var mGetSgst = getSgst.toFixed(2);

                  var getCgst = Math.round(objrow.CGST);
                  var mGetCgst = getCgst.toFixed(2);

                  var getIgst = Math.round(objrow.IGST);
                  var mGetIgst = getIgst.toFixed(2);

                  var bodyData ="<div class='divTableRow'>"+
                        "<div class='divTableBodyRow colmnTwoCDT' style='text-align:left;'>"+fyCD[0]+'/'+objrow.SERIES_CODE+'/'+objrow.VR_NO+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+mVrDate+"</div>"+
                        "<div class='divTableBodyRow colmnThree'>"+objrow.PARTICULAR+"</div>"+
                        "<div class='divTableBodyRow colmnFourCDT'>"+objrow.TAX_CODE+"</div>"+
                        "<div class='divTableBodyRow colmnFiveCDT' style='text-align:right;'>"+objrow.QTYISSUED+"</div>"+
                        "<div class='divTableBodyRow colmnSixCDT' style='text-align:right;'>"+objrow.RATE+"</div>"+
                        "<div class='divTableBodyRow colmnSevenCDT' style='text-align:right;'>"+objrow.BASICAMT+"</div>"+"<div class='divTableBodyRow colmnEaightCDT' style='text-align:right;'>"+mGetSgst+"</div>"+"<div class='divTableBodyRow colmnNineCDT' style='text-align:right;'>"+mGetCgst+"</div>"+"<div class='divTableBodyRow colmnTenCDT' style='text-align:right;'>"+mGetIgst+"</div>"+"<div class='divTableBodyRow colmnEleCDT' style='text-align:right;'>"+objrow.ROUND_OFF+"</div>"+"<div class='divTableBodyRow colmnTwelCDT' style='text-align:right;'>"+objrow.GRAND_TOTAL+"</div>"+"</div>"+"</div>";

                        totalBillAmt += parseFloat(objrow.BASICAMT);
                        sgstTot += parseFloat(mGetSgst);
                        cgstTot += parseFloat(mGetCgst);
                        igstTot += parseFloat(mGetIgst);
                        grandTot += parseFloat(objrow.GRAND_TOTAL);

                    $('#chieldBodyDetails').append(bodyData);


                    srNo++;
                });

                $('#footerTblBasicBal').empty();

                var footerData = "<div>"+totalBillAmt.toFixed(2)+"</div><div style='margin-left: 7%;'>"+sgstTot.toFixed(2)+"</div><div style='margin-left: 8%;'>"+cgstTot.toFixed(2)+"</div><div style='margin-left: 11.3%;'>"+igstTot.toFixed(2)+"</div><div style='margin-left: 29%;'>"+grandTot.toFixed(2)+"</div>";

                $('#footerTblBasicBal').append(footerData);

                //console.log('tot amt',totalBillAmt);

              }/* /. RESPONSE CHECK*/

          }/* /. SUCCESS FUNCTION*/

      });/* /. AJAX FUCNTION*/

  }


  function transporterBillOffLinePdf(TRIPHID,SBILLHID,DT_RowIndex,SVRNO,T_CODE,SVRDATE){

    console.log('TRIPHID',TRIPHID);


    var getcomName = '<?php echo Session::get('company_name'); ?>';
    var getFY      = '<?php echo Session::get('macc_year'); ?>';
    var getnewdate = new Date();
    var getday = getnewdate.getDate();
    var getMonth = getnewdate.getMonth()+1;
    var getYear = getnewdate.getFullYear();

    var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

    var getdate = getday+''+getMonth+''+getYear;

    $.ajaxSetup({

      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }

    });

    $.ajax({

        url:"{{ url('/transaction/logistics/transporter-sale-bill/transporter-sale-bill-offline-pdf') }}",

        method : "POST",

        type: "JSON",

        data: {TRIPHID:TRIPHID,SBILLHID:SBILLHID,DTRowIndex:DT_RowIndex,SVRNO:SVRNO,T_CODE:T_CODE,SVRDATE:SVRDATE},

        success:function(data){

          var data1 = JSON.parse(data);
         
            if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>"); 

            }else if(data1.response == 'success'){

                var ulrLenght = data1.url.length;
                var ulrLenght1 = data1.url1.length;

                for (var i = 0; i < 2; i++) {

                  if (i==1) {

                    console.log('ulrLenght',data1.url);

                    var fileN     = 'TRANSPORTER_SALE_BILL_'+getdate;
                  
                    var link      = document.createElement('a');
                    link.href = data1.url;
                    link.download = fileN+'.pdf';

                    link.dispatchEvent(new MouseEvent('click'));


                  }else{

                    console.log('ulrLenght1',data1.url1);

                    var fileN1     = 'TRANSPORTER_SALE_BILL_DUPLICATE_COPY'+getdate;
                  
                    var link      = document.createElement('a');
                    link.href = data1.url1;
                    link.download = fileN1+'.pdf';

                    link.dispatchEvent(new MouseEvent('click'));

                  }
                  
                }
            

            }/* /. RESPONSE CHECK*/


        }/* /. SUCCESS FUNCTION*/

    });/* /. AJAX FUCNTION*/


  }

  function provBillDelete(tHeadid,SbillHeadId) {

    $('#SaleBillDelete').modal('show');
    //var idComb = compCd+'_'+fyCd+'_'+tranCd+'_'+seriesCd+'_'+vrNo;
    var headIDUpdated =tHeadid+'~'+SbillHeadId;
    $('#updateid').val(headIDUpdated);


    

  }

  function downloadPDF(uniqNo,headId,vrno,tCode){
      var uniqNo,headId,vrno,tCode;
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

        url:"{{ url('pdf-donwload-when-view-purchase-pages') }}",

        method : "POST",

        type: "JSON",

        data: {uniqNo: uniqNo,headId:headId,vrno:vrno,tCode:tCode},

        success:function(data){

          var data1 = JSON.parse(data);
          console.log('data1',data1);
          var fyYear = data1.data[0].FY_CODE;
          var fyCd = fyYear.split('-');
          var seriesCd = data1.data[0].SERIES_CODE;
          var vrNo = data1.data[0].VRNO;
          var fileN = 'PORDER_'+fyCd[0]+''+seriesCd+''+vrNo;
          var link = document.createElement('a');
          link.href = data1.url;
          link.download = fileN+'.pdf';
          link.dispatchEvent(new MouseEvent('click'));
        }

      });
    }
</script>

<script type="text/javascript">
  function porderDelete(id) {

    $("#orderDelete").modal('show');

    $("#headID").val(id);
  }
  
</script>

<script type="text/javascript">
    
    function CalculateTax(poHeadId,PoBodyId,taxCode,itemCode,srnoRw,srno){

      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var tax_code     = taxCode;
      var poHeadId = poHeadId;
      var PoBodyId = PoBodyId;
      var ItemCode     =itemCode;

      $.ajax({

          url:"{{ url('get-a-field-calc-by-itm-tax-code') }}",

          method : "POST",

          type: "JSON",

          data: {tax_code: tax_code,poHeadId:poHeadId,PoBodyId:PoBodyId,ItemCode:ItemCode},

          success:function(data){
            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

            }else if(data1.response == 'success'){
                if(data1.data==''){

                }else{

                  $('#alltaxData_'+srnoRw+'_'+srno).empty();
                  var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div><div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div></div>";

                  $('#alltaxData_'+srnoRw+'_'+srno).append(TableHeadData);

                  $.each(data1.data, function(k, getData) {

                    if(getData.TAX_AMT == null || getData.TAX_AMT == ''){
                      var TAXAMT = 0.00;
                    }else{
                      var TAXAMT =getData.TAX_AMT;
                    }

                    var bodyData = "<div class='box-row'><div class='box10 texIndbox'>"+getData.TAXIND_CODE+" ( "+getData.TAXIND_NAME+" )</div><div class='box10 rateIndbox'>"+getData.RATE_INDEX+"</div><div class='box10 rateBox'>"+getData.TAX_RATE+"</div><div class='box10 amountBox'>"+TAXAMT+"</div></div>"

                    $('#alltaxData_'+srnoRw+'_'+srno).append(bodyData);
                  });

                }
            }

          }

      });
      

    }

</script>

@endsection



