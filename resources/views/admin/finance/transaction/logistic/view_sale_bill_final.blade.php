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
      padding: 6px 18px 7px 6px;
      line-height: 1;
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
      width: 5%;
      text-align:right;
      padding-top: 9px;
      padding-bottom: 7px;
    }
    .colmnThreeCDT{
      width: 5%;
      text-align:right;
      padding-top: 9px;
      line-height: 1;
      padding-bottom: 7px;
    }
    .colmnFourCDT{
      width: 6%;
      text-align:left;
    }
    .colmnFiveCDT{
      width: 4%;
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
            Final Sale Bill 
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

          <small><b>: List Of Final Sale Bill </b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active"><a href="javascript:void(0)">Transaction</a></li>

            <li class="active"><a href="{{ url('/logistic/view-sale-bill-final') }}">Logistic</a></li>
            <li class="active"><a href="{{ url('/logistic/view-sale-bill-final') }}">Final Sale Bill </a></li>
            <li class="active"><a href="{{ url('/logistic/view-sale-bill-final') }}">View Final Sale Bill </a></li>

          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Final Sale Bill</h3>

                  <div class="box-tools pull-right">

                    <a href="{{ url('/logistic/sale-bill-final') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Final Sale Bill</a>

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

                  <div class="noteClass"><b>Note : </b> <span> Clicking on the line, you will see the details of the sale bill below the table. </span></div>

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
                        <div class="col-sm-4" style="text-align: center;"><span style="font-weight: 600;float: right;">Bill Total :- </span>&nbsp;</div>
                        <div class="col-sm-4" id="footerTblBasicBal" style="font-weight: 600;display: inline-flex;"></div>
                        
                      </div>
                      
                    </div><!-- /.box-body -->
                    
                  </div><!-- /.Custom-Box -->
                  
                </div><!-- /.col -->
                
              </div><!-- /.row -->
              
            </section><!-- /.section -->

          <!-- ---- START : SECTION FOR SHOW DETAILS ---- -->

      </div>

<!-- ~~~~~~~~~~ START : Delete Data Modal ~~~~~~~~~~~~~~~ -->

 
<div class="modal fade" id="finalSbillDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">
      <div class="modal-header">

        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">


          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body"> 
        <i class="fa fa-caret-right"></i> &nbsp;You Want To Delete This Data...!
        <div class="row" style="margin-top: 5%;" id="delText"></div>
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

        <form action="#" method="post"> 
          @csrf

           <input type="hidden" name="provHId" id="provHId" value="">
           <input type="hidden" name="sbillHId" id="sbillHId" value="">
           
           <input type="button" value="Delete" id="del_data" style="margin-top: -12%;" class="btn btn-sm btn-danger" disabled="" onclick="funDelData()">
        </form>

      </div>

    </div>

  </div>

</div>

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
         { orderable: false, targets:0 },
         { orderable: false, targets:2 },
         { orderable: false, targets:3 },
         { orderable: false, targets:4 },
         { orderable: false, targets:5 },
         { orderable: false, targets:6 },
         { orderable: false, targets:7 },
         { orderable: false, targets:8 }
      ],
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
       buttons: [
                
                ],
       'fnCreatedRow': function (nRow, aData, iDataIndex) {
                
          $(nRow).attr('onclick', "showBodyDetail("+aData['SVRNO']+",\""+aData['PSBILLHID']+"\",\""+aData['SBILLHID']+"\",\""+aData['VRNO']+"\")"); // or whatever you choose to set as the id
      },
       ajax:{

        url : "{{ url('/logistic/view-sale-bill-final') }}"

       },
       searching : true,
       columns: [
        

          { 
            data:'SVRNO',
            render: function (data, type, full, meta){

            var VRNO     = full['SVRNO'];
            var SERIESCD = full['SERIESCD'];
            var fyCode   = full['SFYCODE'].split('-');
            var FIRSTFYCODE   = fyCode[0];
           
            var NEWVRNO = FIRSTFYCODE+'/'+SERIESCD+'/'+VRNO;

            return NEWVRNO;

            } 
          },
          {
            data:'SVRDATE',
            className:'text-right',
            render: function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                var newDt = date.getDate();
                if(data=='0000-00-00'){
                  return '00-00-0000';
                }else{
                  
                return (newDt.toString().length > 1 ? newDt : "0" + newDt) + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
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
            
              var deletebtn ='&nbsp;&nbsp;<button class="btn btn-danger btn-xs" data-toggle="modal"  onclick="return finalBillDelete('+full['PSBILLHID']+','+full['SBILLHID']+','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>&nbsp;&nbsp; | &nbsp;&nbsp;<button class="btn btn-warning btn-xs" data-toggle="modal"  onclick="return finalBillOffLinePdf('+full['PSBILLHID']+','+full['SBILLHID']+','+full['DT_RowIndex']+','+full['SVRNO']+',\''+full['T_CODE']+'\','+full['SVRDATE']+');"><i class="fa fa-file-pdf-o" title="Download PDF"></i></button>&nbsp;&nbsp;';
              return deletebtn;
            

          }

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

  function showBodyDetail(vrno,tblid,sbillhid,pvrno){

      var fieldName = vrno+'~'+tblid;
     
      var pageIndentity='TRIP_PLANNING_FINAL';

      $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

      $.ajax({

          url:"{{ url('/logistics/view-sale-bill-final-chield-row-data') }}",

          method : "POST",

          type: "JSON",

          data: {svrno:vrno,tblid:tblid,sbillhid:sbillhid,vrno:pvrno},

          success:function(data){

            var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>"); 

              }else if(data1.response == 'success'){

                  $('#chieldBodyDetails').empty();

                  var headData = "<div class='divTableRow'><div class='divTableCell'>Transaction No</div><div class='divTableCell'>Delivery No</div><div class='divTableCell'>LR No</div><div class='divTableCell'>Invoice No</div><div class='divTableCell'>Wagon No</div><div class='divTableCell'>Vehicle No</div><div class='divTableCell'>LR-Qty</div><div class='divTableCell'>ACK-Qty</div><div class='divTableCell'>Net Qty</div><div class='divTableCell'>Gross Qty</div><div class='divTableCell'>FRT Rate</div><div class='divTableCell'>FRT Amt</div><div class='divTableCell'>SGST</div><div class='divTableCell'>CGST</div><div class='divTableCell'>IGST</div><div class='divTableCell'>Grand Total</div></div>";

                  $('#chieldBodyDetails').append(headData);

                 var objrow = data1.data;


                 var srNo=1;
                 var tableid = objrow[0].SBILLHID;

                 console.log('child data',objrow);

                 var totalBillAmt = 0;
                 var sgstAmt      = 0;
                 var cgstAmt      = 0;
                 var igstAmt      = 0;
                 var grandAmt     = 0;

                $.each(objrow, function (i, objrow) {

                  var valueChk = Math.sign(objrow.ROUNDOFF);
                  console.log('loop child data',valueChk);

                  if (valueChk == -1) {
                    
                    var finalTot = parseFloat(objrow.TGRANDTOT) + (- parseFloat(objrow.ROUNDOFF));

                  }else{

                    var finalTot = parseFloat(objrow.TGRANDTOT) - parseFloat(objrow.ROUNDOFF);

                  }

                  var mFinalTot = finalTot.toFixed(2);

                  var bodyData ="<div class='divTableRow'>"+
                        "<div class='divTableBodyRow colmnTwoCDT' style='text-align:left;'>"+objrow.TRANSACTION_NO+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+objrow.DELIVERY_NO+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+objrow.LR_NO+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.INVC_NO+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.WAGON_NO+"</div>"+
                        "<div class='divTableBodyRow colmnFourCDT'>"+objrow.VEHICLE_NO+"</div>"+
                        "<div class='divTableBodyRow colmnFiveCDT' style='text-align:right;'>"+objrow.QTYISSUED+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.ACK_QTY+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.NET_WEIGHT+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.GROSS_WEIGHT+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.RATE+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.BASICAMT+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.TSGST+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.TCGST+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+objrow.TIGST+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+mFinalTot+"</div>"+"</div>";

                        sgstAmt += parseFloat(objrow.TSGST);
                        cgstAmt += parseFloat(objrow.TCGST);
                        igstAmt += parseFloat(objrow.TIGST);
                        grandAmt += parseFloat(mFinalTot);
                        totalBillAmt += parseFloat(objrow.BASICAMT);

                    $('#chieldBodyDetails').append(bodyData);


                    srNo++;
                });

                var grandTotl = grandAmt.toFixed(2);

                $('#footerTblBasicBal').empty();

                var footerData = "<div style='margin-left: 60px;'>"+totalBillAmt.toFixed(2)+"</div><div style='margin-left: 39px;'>"+sgstAmt.toFixed(2)+"</div><div style='margin-left: 37px;'>"+cgstAmt.toFixed(2)+"</div><div style='margin-left: 61px;'>"+igstAmt.toFixed(2)+"</div><div style='margin-left: 23px;'><input type='hidden' id='getGrandTotl' value='"+igstAmt.toFixed(2)+"'>"+grandTotl+"</div>";

                $('#footerTblBasicBal').append(footerData);

                //console.log('tot amt',totalBillAmt);

              }/* /. RESPONSE CHECK*/

          }/* /. SUCCESS FUNCTION*/

      });/* /. AJAX FUCNTION*/

  }


  function finalBillOffLinePdf(PSBILLHID,SBILLHID,DT_RowIndex,SVRNO,T_CODE,SVRDATE){

    console.log('PSBILLHID',PSBILLHID);


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

        url:"{{ url('/transaction/logistics/sale-bill/sale-bill-final-offline-pdf') }}",

        method : "POST",

        type: "JSON",

        data: {PSBILLHID:PSBILLHID,SBILLHID:SBILLHID,DTRowIndex:DT_RowIndex,SVRNO:SVRNO,T_CODE:T_CODE,SVRDATE:SVRDATE},

        success:function(data){

          var data1 = JSON.parse(data);
         
            if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>"); 

            }else if(data1.response == 'success'){

                var responseVar = true;

                var gelFileNm = $('#downloadFileName').val();

                var billNo = data1.bill_no;
                  
                var fileN        = 'SALEBILL_'+billNo+'_'+getdate;
                var linkPdf      = document.createElement('a');
                linkPdf.href     = data1.url;
                linkPdf.download = fileN+'.pdf';
                linkPdf.dispatchEvent(new MouseEvent('click'));
            

            }/* /. RESPONSE CHECK*/


        }/* /. SUCCESS FUNCTION*/

    });/* /. AJAX FUCNTION*/


  }


  /* ~~~~~~~~~~~ START:  Amount TO Word Converter Function ~~~~~~~~~~~~ */

  function amountInWords (num) {

    //console.log('amt => ',num);
    
      var fAMT=num,WAMT=0,FWORDS='';

    //FWORDS Four Crores Fifty Lakhs Twenty Five Thousand Five Hundred One 

    if(fAMT==0){
      FWORDS='Nil ';
    }else{

        WAMT = parseInt(fAMT/10000000);
        FWORDS=FWORDS+(WAMT>0 ? AWFWORD(WAMT)+(FWORDS==' One '?'Crore ':'Crores '):'');

        fAMT = fAMT - WAMT * 10000000;
        WAMT = parseInt(fAMT/100000);
        FWORDS=FWORDS+(WAMT>0 ? AWFWORD(WAMT)+(FWORDS==' One '?'Lakh ':"Lakhs "):'');

        fAMT = fAMT - WAMT * 100000;
        WAMT = parseInt(fAMT/1000);
        FWORDS=FWORDS+(WAMT>0 ? AWFWORD(WAMT)+"Thousand ":'');

        fAMT = fAMT - WAMT * 1000;
        WAMT = parseInt(fAMT/100);
        FWORDS=FWORDS+(WAMT>0 ? AWFWORD(WAMT)+"Hundred ":'');

        fAMT = fAMT - WAMT*100;
        WAMT = parseInt(fAMT);
        FWORDS=FWORDS+(WAMT>0 ? AWFWORD(WAMT):'');

        fAMT = fAMT - WAMT*1;
        fAMT = fAMT.toFixed(3);;
        WAMT = parseInt((fAMT-parseInt(fAMT))*100);
        FWORDS=FWORDS+(WAMT>0 ? "And Paise "+AWFWORD(WAMT):'');

    }

    FWORDS = FWORDS + "Only.";
  
    return FWORDS;
  }


  function AWFWORD(WAMT){


    var WAMT,FDIGIT=0,SDIGIT=0,RWORDS='';

    FDIGIT = parseInt(WAMT/10);

    SDIGIT = WAMT - FDIGIT * 10;

    console.log('FDIGIT',FDIGIT);

      if(FDIGIT > 1){

        if(FDIGIT == 2){
          RWORDS = "Twenty ";
        }else if(FDIGIT == 3){
          RWORDS ="Thirty ";
        }else if(FDIGIT == 4){
          RWORDS ="Forty ";
        }else if(FDIGIT == 5){
          RWORDS ="Fifty ";
        }else if(FDIGIT == 6){
          RWORDS ="Sixty ";
        }else if(FDIGIT == 7){
          RWORDS ="Seventy ";
        }else if(FDIGIT == 8){
          RWORDS ="Eighty ";
        }else if(FDIGIT == 9){
          RWORDS ="Ninety ";
        }

      }

      if((FDIGIT > 1 && SDIGIT > 0) || (FDIGIT == 0 && (SDIGIT > 0 && SDIGIT <= 9))){

        if(SDIGIT ==1){
          RWORDS = RWORDS + "One ";
        }else if(SDIGIT ==2){

          RWORDS = RWORDS + "Two ";

        }else if(SDIGIT ==3){

          RWORDS = RWORDS + "Three ";

        }else if(SDIGIT ==4){

          RWORDS = RWORDS + "Four ";

        }else if(SDIGIT ==5){

          RWORDS = RWORDS + "Five ";

        }else if(SDIGIT ==6){

          RWORDS = RWORDS + "Six ";

        }else if(SDIGIT ==7){

          RWORDS = RWORDS + "Seven ";

        }else if(SDIGIT ==8){

          RWORDS = RWORDS + "Eight ";

        }else if(SDIGIT ==9){

          RWORDS = RWORDS + "Nine ";

        }

      }

      if(FDIGIT == 1 && SDIGIT ==0){
        RWORDS = RWORDS + "Ten ";
      }

      if(FDIGIT == 1 && ((SDIGIT > 0 && SDIGIT < 9) || (SDIGIT == 9))){

        if(SDIGIT == 1){
          RWORDS = RWORDS + "Eleven ";
        }else if(SDIGIT == 2){
          RWORDS = RWORDS + "Twelve ";
        }else if(SDIGIT == 3){
          RWORDS = RWORDS + "Thirteen ";
        }else if(SDIGIT == 4){
          RWORDS = RWORDS + "Fourteen ";
        }else if(SDIGIT == 5){
          RWORDS = RWORDS + "Fifteen ";
        }else if(SDIGIT == 6){
          RWORDS = RWORDS + "Sixteen ";
        }else if(SDIGIT == 7){
          RWORDS = RWORDS + "Seventeen ";
        }else if(SDIGIT == 8){
          RWORDS = RWORDS + "Eighteen ";
        }else if(SDIGIT == 9){
          RWORDS = RWORDS + "Nineteen ";
        }

      }

    return RWORDS;

  }


/* ~~~~~~~~~~~ END : Amount TO Word Converter Function ~~~~~~~~~~~~ */

  function finalBillDelete(psBillHid,sBillHid,rowId) {

    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $("#finalSbillDelete").modal('show');

    $("#provHId").val(psBillHid);
    $("#sbillHId").val(sBillHid);
 

  }

  function funDelData(){

      var provHId  = $("#provHId").val();
      var sbillHId = $("#sbillHId").val();
      var delRemark = $("#del_remark").val();

      console.log('provHId',provHId);
      console.log('sbillHId',sbillHId);
      console.log('delRemark',delRemark);
    
     
      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

        url:"{{ url('/transaction/logistic/delete-sale-bill-final') }}",
        
        method : "POST",
        
        type: "JSON",
        
        data: {provHId:provHId,sbillHId:sbillHId,delRemark:delRemark},
        
        success:function(data){

         var data1 = JSON.parse(data);
         
         if(data1.response =='success'){

            var responseVar = 'true';
                    
            var url = "{{url('/logistic/view-sale-bill-final-msg')}}"
            setTimeout(function(){ window.location = url+'/'+responseVar; });

           
         }else if(data1.response =='error'){

            var responseVar = 'false';

            var url = "{{url('/logistic/view-sale-bill-final-msg')}}"
            setTimeout(function(){ window.location = url+'/'+responseVar; });


         }else{

         }

        }
      
    });

  }

  function deleteRemark(){
    
    var remark = $('#del_remark').val();

    if(remark.length > 10){
       $('#del_data').attr('disabled',false);
    }else{
      $('#del_data').attr('disabled',true);
    }

    // console.log('remark',remark);
  }

  function porderDelete(id) {

    $("#orderDelete").modal('show');

    $("#headID").val(id);
  }
  

    
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



