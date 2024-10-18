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
      width: 7%;
      text-align: right;
      padding-top: 4px;
      padding-bottom: 0px;
      line-height: 1;
    }
    .colmnFourCDT{
      width: 7%;
      text-align:left;
    }
    .colmnFiveCDT{
      width: 7%;
      text-align:left;
    }

/* ---- custom table css ----- */

.messageAlert{
  display: none;
}
</style>
  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
            Provisional Sale Bill 
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>: Details Of Sale Bill</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active"><a href="javascript:void(0)">Transaction</a></li>

            <li class="active"><a href="{{ url('/logistic/view-sale-bill-provisional') }}">Logistic</a></li>
            <li class="active"><a href="{{ url('/logistic/view-sale-bill-provisional') }}">View Provisional Sale Bill</a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Provisional Sale Bill</h3>

                  <div class="box-tools pull-right">

                    <a href="{{ url('/logistic/sale-bill-provisional') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Provisional Sale Bill</a>

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

                  <div style="margin-top: 2%;">
                    <table id="example" class="table table-bordered table-striped table-hover" >

                      <thead>

                        <tr>

                          <th class="text-center">Vr No</th>
                          
                          <th class="text-center">Vr Date</th>

                          <th class="text-center">Plant Code/Name</th>

                          <th class="text-center">Plant Category</th>

                          <th class="text-center">Item Code/Name</th>

                          <th class="text-center">Tran. Type</th>

                          <th class="text-center">Acc. Code/Name</th>

                          <th class="text-center">Tax Code</th>

                          <th class="text-center">Action</th>
                         
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
                        <div class="col-sm-4"></div>
                        <div class="col-sm-2"><span style="font-weight: 600;float: right;">Bill Total :- </span>&nbsp;</div>
                        <div class="col-sm-2" id="footerTblBasicBal" style="padding-left: 11%;font-weight: 600;"></div>
                        
                      </div>
                      
                    </div><!-- /.box-body -->
                    
                  </div><!-- /.Custom-Box -->
                  
                </div><!-- /.col -->
                
              </div><!-- /.row -->
              
            </section><!-- /.section -->

          <!-- ---- START : SECTION FOR SHOW DETAILS ---- -->

      </div>

<!-- ~~~~~~~~~~ START : Delete Data Modal ~~~~~~~~~~~~~~~ -->

 <div class="modal fade" id="provBillDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content" style="width: 140%;">

      <div class="modal-header">

        <h3 class="modal-title" id="exampleModalLabel" style="color:red;">Are You Sure...!</h3>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style=''>
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">

        <p style="font-size: 15px;font-weight: 600;padding-top: 2%;" id="messageAlertId">*Some E-Proc Status Already Done For This Bill...!</p>
        <p style="font-size: 15px;font-weight: 600;padding-top: 3%;">*You Want To Delete This Provisional Sale Bill...!</p>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-sm btn-warning" data-dismiss="modal" style="margin-right: 29%;padding: 0px 22px 0px;">Cancle</button>

          <form action="{{ url('/logistic/provisional-bill/delete-sale-bill-provisional') }}" method="post">

            @csrf

            <input type="hidden" name="headID" id="headID" value="">

            <div style="margin-top: 7px;margin-right: 17px;">
              <input type="submit" value="Delete" class="btn btn-sm btn-danger" style='padding: 0px 22px 0px;'>
            </div>

          </form>

      </div>

    </div>

  </div>

</div>

<!-- ~~~~~~~~~~~ If All Status Done For Particular Bill ~~~~~~~ -->


  <div class="modal fade" id="provBillDeleteModal101" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content" style="width: 112%;">

      <div class="modal-header">

        <h3 class="modal-title" id="exampleModalLabel" style="color:red;">Alert...!</h3>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">

        <div style="font-size: 15px;font-weight: 600;margin-top: 10px;margin-bottom: 28px;">
          *Already Approved On E-Proc, Can't Deleted...!
        </div>

      </div>

    </div>

  </div>

</div>


<!-- ~~~~~~~~~~~ ./ If All Status Done For Particular Bill ~~~~~~~ -->




<!-- ~~~~~~~~~~ END : Delete Data Modal ~~~~~~~~~~~~~~~ -->

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
      scrollY: 400,
      scrollX: true,
      scroller: true,
      fixedHeader: true,
      order: [[0, 'desc'],[1, 'desc']],
      columnDefs: [
         { orderable: false, targets:2 },
         { orderable: false, targets:3 },
         { orderable: false, targets:4 },
         { orderable: false, targets:5 },
         { orderable: false, targets:6 },
         { orderable: false, targets:7 }
      ],
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
       buttons: [
                
                ],
       'fnCreatedRow': function (nRow, aData, iDataIndex) {
                
          $(nRow).attr('onclick', "showBodyDetail("+aData['VRNO']+",\""+aData['PSBILLHID']+"\")"); // or whatever you choose to set as the id
      },
       ajax:{

        url : "{{ url('/logistic/view-sale-bill-provisional') }}"

       },
       searching : true,
       columns: [
        
          { 
            render: function (data, type, full, meta){

            var VRNO     = full['VRNO'];
            var SERIESCD = full['SERIES_CODE'];
            var fyCode   = full['FY_CODE'].split('-');
            var FIRSTFYCODE   = fyCode[0];
           
            var NEWVRNO = FIRSTFYCODE+' '+SERIESCD+' '+VRNO;

            return NEWVRNO;

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
            data:'PLANT_NAME',
            render: function (data, type, full, meta){
                   
              var plantCodeNm = '<p>'+full['PLANT_NAME']+'</p>'+'<p style="line-height:2px;">('+full['PLANT_CODE']+')</p>';
            
              return plantCodeNm;
 
             }
        

        },
        {  
             data:'TRAN_TYPE',
            render: function (data, type, full, meta){
                   
              var TRANTYPE = '<p>'+full['TRAN_TYPE']+'</p>';
            
              return TRANTYPE;

            }
        

        },
        {  
            data:'ITEM_NAME',
            render: function (data, type, full, meta){

              var ITEMNAME = '<p>'+full['ITEM_NAME']+'</p>'+'<p style="line-height:2px;">('+full['ITEM_CODE']+')</p>';
                    
              return ITEMNAME;

            }

        },
        {  
             data:'TRAN_TYPE',
            render: function (data, type, full, meta){
                   
              var TRANTYPE = '<p>'+full['TRAN_TYPE']+'</p>';
            
              return TRANTYPE;

            }
        

        },
        {  
            data:'ACC_NAME',
            render: function (data, type, full, meta){

              var ACCNAME = '<p>'+full['ACC_NAME']+'</p>'+'<p style="line-height:2px;">('+full['ACC_CODE']+')</p>';
                    
              return ACCNAME;

            }

        },
        {  
             data:'TAX_CODE',
            render: function (data, type, full, meta){
                   
              var TAXCODE = '<p>'+full['TAX_CODE']+'</p>';
            
              return TAXCODE;

            }
        

        },

        {  
          render: function (data, type, full, meta){
            
              var deletebtn ='<button class="btn btn-danger btn-xs" data-toggle="modal"  onclick="return provBillDelete('+full['PSBILLHID']+');"><i class="fa fa-trash" title="Delete"></i></button>';
              return deletebtn;
            

          },
           className:'text-center'

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

          url:"{{ url('/logistics/view-sale-bill-provisional-chield-row-data') }}",

          method : "POST",

          type: "JSON",

          data: {vrno:vrno,tblid:tblid},

          success:function(data){

            var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>"); 

              }else if(data1.response == 'success'){

                  $('#chieldBodyDetails').empty();

                  var headData = "<div class='divTableRow'><div class='divTableCell'>Delivery No</div><div class='divTableCell'>LR No</div><div class='divTableCell'>LR Date</div><div class='divTableCell'>Invoice No</div><div class='divTableCell'>DO No</div><div class='divTableCell'>Wagon No</div><div class='divTableCell'>Vehicle No</div><div class='divTableCell'>LR-Qty</div><div class='divTableCell'>ACK-Qty</div><div class='divTableCell'>Net Qty</div><div class='divTableCell'>Gross Qty</div><div class='divTableCell'>FRT Rate</div><div class='divTableCell'>FRT Amt</div></div>";

                  $('#chieldBodyDetails').append(headData);

                 var objrow = data1.data;
                 var srNo=1;
                 var tableid = objrow[0].PSBILLHID;

                 //console.log('child data',objrow);

                 var totalBillAmt = 0;

                $.each(objrow, function (i, objrow) {

                  //console.log('loop child data',objrow.LR_NO);

                  var bodyData ="<div class='divTableRow'>"+
                        "<div class='divTableBodyRow colmnTwoCDT' style='text-align:left;'>"+objrow.DELIVERY_NO+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+objrow.LR_NO+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+objrow.LR_DATE+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+objrow.INVC_NO+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.DORDER_NO+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.WAGON_NO+"</div>"+
                        "<div class='divTableBodyRow colmnFourCDT'>"+objrow.VEHICLE_NO+"</div>"+
                        "<div class='divTableBodyRow colmnFiveCDT' style='text-align:right;'>"+objrow.QTYISSUED+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.ACK_QTY+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.NET_WEIGHT+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.GROSS_WEIGHT+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.RATE+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.BASICAMT+"</div>"+"</div>";

                        totalBillAmt += parseFloat(objrow.BASICAMT);

                    $('#chieldBodyDetails').append(bodyData);


                    srNo++;
                });

                $('#footerTblBasicBal').empty();

                var footerData = "<div>"+totalBillAmt.toFixed(2)+"</div>";

                $('#footerTblBasicBal').append(footerData);

                //console.log('tot amt',totalBillAmt);

              }/* /. RESPONSE CHECK*/

          }/* /. SUCCESS FUNCTION*/

      });/* /. AJAX FUCNTION*/

  }

    function provBillDelete(id) {

      var headId = id;

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

        url:"{{ url('/logistic/provisional-bill/check-eproc-status-sale-bill-provisional') }}",

        method : "POST",

        type: "JSON",

        data: {headId: headId},

        success:function(data){

          var data1 = JSON.parse(data);
           
          if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>"); 

          }else if(data1.response == 'success'){

            var objrow = data1.data;

            var getStatus = [];
            var getStatus2 = [];

            $.each(objrow, function (i, rows) {

              if (rows.CURRENT_STATUS=='Freight Calculation Done') {
                  
                  getStatus.push(rows.CURRENT_STATUS);

              }else{


              }


            });


            var statusCount = getStatus.length;
            var statusCount2 = objrow.length;

            console.log('status =>',statusCount);

            if (statusCount==0) {

              $("#provBillDeleteModal").modal('show');
              $('#messageAlertId').addClass('messageAlert');
              $("#headID").val(id);

            }else if (statusCount == statusCount2) {

              $("#provBillDeleteModal101").modal('show');
              
            }else{

              $("#provBillDeleteModal").modal('show');
              $('#messageAlertId').removeClass('messageAlert');
              $("#headID").val(id);

            }

              

          }
         
        }

      });


      

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



