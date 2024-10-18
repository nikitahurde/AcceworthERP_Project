@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')
<style type="text/css">

    .tdsratebtnHide{
      display: none;
    }
    .PageTitle{
      margin-right: 1px !important;
    }
    .required-field::before {
      content: "*";
      color: red;
    }
    .textRight{
      text-align: right;
    }
    .rightcontent{
      text-align:right;
    }
    ::placeholder {
      text-align:left;
    }
    .text-center{
      text-align: center;
    }
    .tdthtablebordr{
      border: 1px solid #00BB64;
    }
    .modltitletext{
      font-weight: 800;
      color: #5696bb;
      text-align: center;
      font-size: 16px;
    }
    .aplynotStatus{
      display: none;
    }
    .inputtaxInd{
      background-color: white !important;
      border: none;
      text-align: center;
    }
    .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
    }
    .box-header>.box-tools {
      position: absolute !important;
      right: 10px !important;
      top: 2px !important;
    }
    .required-field::before {
      content: "*";
      color: red;

    }
    .alignRightClass{
      text-align: right;
    }
    .alignCenterClass{
      text-align: center;
    }
    .showSeletedName {
      font-size: 12px;
      margin-top: 2%;
      text-align: center;
      font-weight: 600;
      color: #4f90b5;
    }
    .modal-header .close {
      margin-top: -25px !important;
      margin-right: 2% !important;
    }
    ::placeholder {
      text-align:left;
    }
    .inputBoxT{
      width:100%;
      font-size:12px;
    }
    .applyBTn{
      margin-top: 7px;
    }
    .iconBtnSty{
      border-radius: 100px;
      padding: 4px;
    }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>
      Pending for Payment Advice - Market
      <small> : Report Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report</a></li>

      <li><a href="{{ url('/dashboard') }}">Logistic</a></li>

      <li class="active"><a href="{{ url('/transaction/logistics/trip-exp-payment-advice') }}">Pending for Payment Advice - Market</a></li>

    </ol>

  </section><!-- --sectio -->

  <section class="content" style="min-height: 150px;margin-bottom: -26px;">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Pending for Payment Advice - Market</h2>

      </div><!-- /.box-header -->

      <div class="box-body">

        <?php date_default_timezone_set('Asia/Kolkata'); ?>

        <?php 

          $CurrentDate =date("d-m-Y");
             
          $FromDate    = date("d-m-Y", strtotime($fromDate));  
             
          $ToDate      = date("d-m-Y", strtotime($toDate));  
             
          $formCurrentDt = date("Y-m-d", strtotime($CurrentDate));

          if($formCurrentDt > $toDate){
            $vrDate =$ToDate;
          }else{
            $vrDate =$CurrentDate;
          }

        ?>

        <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

            <input type="hidden" name="" value="<?php echo $vrDate; ?>" id="ToDateFy">

        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1"> From Date : </label>

              <div class="input-group">

                <div class="input-group-addon">

                  <i class="fa fa-calendar"></i>

                </div>
              
                <input type="text" name="from_date" id="from_date" class="form-control fromDatePc rightcontent fromdatepicker" placeholder="Select From Date" value="<?= $vrDate; ?>" autocomplete="off">

              </div>

              <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>

              <small id="show_err_from_date"></small>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1"> To Date : </label>

              <div class="input-group">

                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
              
                <input type="text" name="to_date" id="to_date" class="form-control toDatePc rightcontent" placeholder="Select To Date" value="{{$vrDate}}" autocomplete="off">

              </div>

              <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>

              <small id="show_err_to_date"></small>

            </div>

          </div><!-- /.col -->

         

         <!-- /.col -->

        

         
              
        </div><!-- /.row -->

        <div class="row">

          <!-- /.col -->
         <div class="col-md-5"></div>
          <div class="col-md-3">

            <div style="margin-top: 5%;">

              <button type="button" class="btn btn-primary btn-sm" name="searchdata" id="btnsearch" style="padding:0px 2px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Search&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;

              <button type="button" class="btn btn-warning btn-sm" name="searchdata" id="ResetId" style="padding:0px 2px;" >&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i>&nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

            </div>

          </div><!-- /.col -->
          <div class="col-md-3"></div>

        </div><!-- /.row -->

      </div><!-- /.box-body -->

    </div><!-- /.custom box -->

<!----- START : TAX CALC MODAL -------->

     

<!----- END : TAX CALC MODAL -------->

<!-- ------ SIMULATION MODAL ------------  -->
  
  

<!-- ------ SIMULATION MODAL ------------  -->

</section>

<section class="content">

  <div class="box box-primary Custom-Box">

    <div class="box-header with-border" style="text-align: center;"></div>

    <div class="box-body">

      <table id="TransportBillTable" class="table table-bordered table-striped table-hover">

        <thead class="theadC">

          <tr>
            <th class="text-center" width="3%">Sr.No</th>
            <th class="text-center" width="5%">Date</th>
            <th class="text-center" width="6%">Vehicle No </th>
            <th class="text-center" width="3%">Vehicle Type </th>
            <th class="text-center" width="5%">Vr No </th>
            <th class="text-center" width="13%">Transporter</th>
            <th class="text-center" width="5%">From Place</th>
            <th class="text-center" width="5%">To Place</th>
            <th class="text-center" width="13%">Consignee</th>
            <th class="text-center" width="5%">Freight Qty</th>
            <th class="text-center" width="5%">Freight Rate</th>
            <th class="text-center" width="5%">Freight Amount</th>
            <th class="text-center" width="5%">Adavance Percent/rate</th>
            <th class="text-center" width="5%">Advance Amount</th>
        
            
          </tr>

        </thead>

        <tbody id="defualtSearch">

        </tbody>
 
        <tfoot align="right">
          <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
        </tfoot>

      </table>

    </div><!-- /.box-body -->
        
  </div><!-- /.custom box -->

</section><!-- /.section -->

</div>

<!------- MODAL FOR CALCULATE TDS ------------>

   
<!------- MODAL FOR CALCULATE TDS ------------>
 
@include('admin.include.footer')




<script type="text/javascript">

  load_data_query()
  function load_data_query(from_date='',to_date=''){

      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();


      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;

      $('#TransportBillTable').DataTable({


          footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                var rowcount = data.length;
                var getRow = rowcount-1;
                
                
                var freightQtyTot = api
                  .column(9)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                  }, 0 );
          
                var freightRate = api
                  .column(10)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                var fregintAmt = api
                  .column(11)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                var advRate = api
                  .column(12)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                var advAmt = api
                  .column(13)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                  
                $( api.column(8).footer()).html('Total :-').css('text-align','right');
                $( api.column(9).footer()).html(parseFloat(freightQtyTot).toFixed(2));
                $( api.column(10).footer()).html(parseFloat(freightRate).toFixed(2));
                $( api.column(11).footer()).html(parseFloat(fregintAmt).toFixed(2));
                $( api.column(12).footer()).html(parseFloat(advRate).toFixed(2));
                $( api.column(13).footer()).html(parseFloat(advAmt).toFixed(2));
                    
                    
          }, 

          processing: true,
          serverSide: false,
          info: true,
          bPaginate: false,
          scrollY: 400,
          scrollX: true,
          scroller: true,
          fixedHeader: true,
          order: [[0, 'asc'],[1, 'asc'],[2, 'asc']],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'PAYMENT_ADVICE_MARKET_REPORT_'+getdate+'_'+gettime,
                        title: getcomName+'\n'+getFY+'\n'+' PAYMENT ADVICE REPORT - MARKET',
                        footer:true,
                        exportOptions: {
                              columns: [1,2,3,4,5,6,7,8,9,10,11,12,13]
                        }
                      }

                    ],
          ajax:{
            url:'{{ url("/logistic/trip-planing-payment-advice") }}',
            data: {from_date:from_date,to_date:to_date}
          },

          columns: [

            { 
              data:"DT_RowIndex",
              name:"DT_RowIndex",
              className: "text-center",
            },
            {
              data:'VRDATE',
              render: function (data, type, full, meta) {

                if (full['VRDATE']=='NULL' || full['VRDATE']==null || full['VRDATE']=='') {

                  var newVrDate = '00-00-0000';

                }else{

                  var extDate = full['VRDATE'];
                
                  var extArr  = extDate.split('-');
                  
                  var year    =  extArr[0];
                  var month   =  extArr[1];
                  var mdate   =  extArr[2];

                  var newVrDate = mdate+'-'+month+'-'+year;

                }

                

                return newVrDate;

              },className:'text-right'
            },
            {
              data:'VehicleNo',
              name:'VehicleNo',
              className: "text-left",
               render: function (data, type, full, meta){
                
                var vehicle_no = full['VehicleNo'];

               
               return vehicle_no;

              }
            },
            {
                data:'VEHICLE_TYPE',
                name:'VEHICLE_TYPE',
                className: "text-left",

            },
            {
                data:'VRNO',
                render: function (data, type, full, meta){

                  if (full['FY_CODE']=='NULL' || full['FY_CODE']==null) {

                    var newVrNo = '---- -- --';

                  }else{

                    var fyCode = full['FY_CODE'];
                    var VRNO = full['VRNO'];
                    var SERIESCODE = full['SERIES_CODE'];
                    var startYear = fyCode.split('-');

                    var newVrNo = startYear[0]+' '+SERIESCODE+' '+VRNO;

                  }
                
                  

                  return newVrNo;

                },
                className: "text-left"

            },
            {
                data:'TRANSPORT_NAME',
                name:'TRANSPORT_NAME',
                className: "text-left",
            },
            {
                data:'FROM_PLACE',
                name:'FROM_PLACE',
                className: "text-left",
            },
            {
                data:'TO_PLACE',
                name:'TO_PLACE',
                className: "text-left",
            },
            {   data:'CP_CODE',
                className: "text-left",
               render: function (data, type, full, meta){
                   var cp_code =  full['CP_CODE']+' - '+full['CP_NAME'];

                   return cp_code;
                },
            },
            {
                data:'FREIGHT_QTY',
                name:'FREIGHT_QTY',  
                className:'text-right'
            },
            {
                data:'FPO_RATE',
                name:'FPO_RATE',  
                className:'text-right'
            },
            {
                data:'AMOUNT',
                render: function (data, type, full, meta){

                  var FREIGHTQTY = full['FREIGHT_QTY'];
                  var FPORATE    = full['FPO_RATE'];

                  var totAmt = parseFloat(FPORATE) * parseFloat(FREIGHTQTY);

                  return totAmt.toFixed(2);
                },
                className:'text-right'
            },
            
            {
                data:'ADV_RATE',
                name:'ADV_RATE',
                className:'text-right'
            },
            {
                data:'ADV_AMT',
                name:'ADV_AMT',
                className:'text-right'
            },

            
            
          ]


      });


   }
  

  $(document).ready(function() {

    var fromdateintrans = $('#FromDateFy').val();
    var todateintrans = $('#ToDateFy').val();

     $('.fromdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromdateintrans,
      endDate : todateintrans,      
      autoclose: 'true'

    });


     $("#from_date").click(function() {

      $("#to_date").val('');
      $('#to_date').datepicker('destroy');

    });


    $("#to_date").click(function() {

        var fromDate = $('#from_date').val();
        console.log('fromDate',fromDate);
        var splitFrom    = fromDate.split("-");

        var frDate = splitFrom[0];
        var frMonth = splitFrom[1];
        var frYear = splitFrom[2];

        var netDate =frYear+'-'+frMonth+'-'+frDate;

        var dt = new Date(netDate);
        var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(dt);
        var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(dt);

        var middleDateStart =da+'-'+mo+'-'+frYear;

        $('#to_date').datepicker({
          format: 'dd-mm-yyyy',
          orientation: 'bottom',
          todayHighlight: 'true',
          startDate: middleDateStart,
          endDate: todateintrans,
          autoclose: 'true'
        });
         $('#to_date').datepicker('show');

        
    });
   

    $('#btnsearch').click(function(){

          var from_date  =  $('#from_date').val();

          var to_date    =  $('#to_date').val();

        
     
          if (from_date!='' || to_date!='') {

            
            if(from_date!=''){
              if(to_date==''){
                $('#show_err_to_date').html('Please select to date').css('color','red');
                return false;
              }
            }

            if(to_date!=''){
              if(from_date==''){
                $('#show_err_from_date').html('Please select from date').css('color','red');
                return false;
              }
            }



            $('#TransportBillTable').DataTable().destroy();

            

            load_data_query(from_date,to_date);

          }else{
            $('#TransportBillTable').DataTable().destroy();
            load_data_query();
            
          }


        });


    $('#ResetId').click(function(){
  
      $('#item_code').val('');
      $('#vr_num').val('');
      $('#accountText').html('');

    
      $('#TransportBillTable').DataTable().destroy();
      load_data_query();

    });
  

});


</script>

<script type="text/javascript">
  
    $(document).ready(function(){

         var creditAmount = 0;
         var grandAmt = 0;
         var totlFreightAmt = 0;
       // $('#TransportBillTable').DataTable();

        $("#TransportBillTable").on('change', function() {
          var creditAmount = 0;
          var grandAmt = 0;
          var totlFreightAmt = 0;
            var checkedCount = $("#TransportBillTable input:checked").length;
            console.log('count',checkedCount);
            if(checkedCount == 0){
              $("#simulation").prop('disabled',true);
              $("#submitinparty").prop('disabled',true);
              $("#submitdatapdf").prop('disabled',true);
              $("#tds_rate").prop('disabled',true);
            }else{
              $("#simulation").prop('disabled',false);
              $("#submitinparty").prop('disabled',false);
              $("#submitdatapdf").prop('disabled',false);
              $("#tds_rate").prop('disabled',false);
            }
           
            for (var i = 0; i < checkedCount; i++) {
              var ii= i+1;
              var amount = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[11].innerHTML;

              var vehicle_no = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[1].innerHTML;

               var freightAmt = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[7].innerHTML;
      
              if (amount != "") {
                creditAmount += parseFloat(amount);
              } else {
                creditAmount = 0;

              }

              if (freightAmt != "") {
                totlFreightAmt += parseFloat(freightAmt);
              } else {
                totlFreightAmt = 0;

              }

            }

            $("#totlFreightAmt").val(totlFreightAmt.toFixed(2));
            $("#basicTotalAmt").text(creditAmount.toFixed(2));
            $("#nextAmtTot").text(creditAmount.toFixed(2));
            $("#basic").val(creditAmount.toFixed(2));
            $("#getNetAmnt").val(creditAmount.toFixed(2));
          //  $("#netAmt").text(grandAmt.toFixed(2));
            //$("#netAmount").val(grandAmt.toFixed(2));
        });

    }); 
</script>


<script type="text/javascript">
  
  function clickCheck(){

    $('#pertText').val('');

    $('.flitClass').each(function(){

      if($(this).is(":checked")){

          var getpertText = $('#pertText').val();

          var getString = $(this).val();

         // getString.replaceAll("~", "-");
                 
          $('#pertText').val(getpertText+','+getString);
            
              var chekcValue = $(this).val();

              $("#chekcValue").val(chekcValue);

             $("#submitinparty").prop('disabled',false);
             $("#submitdatapdf").prop('disabled',false);
            
      }else{
    
      }
    });

  }
  
</script>


  <script type="text/javascript">
    
    function submitBillGenerate(valp){  

      var downloadFlg = valp;

      $('#pdfYesNoStatus').val(downloadFlg);

      var flitClass=[];
      var newAarry =[];

      $('.flitClass').each(function(){
          if($(this).is(":checked"))
          {
           var flitClass1 = $(this).val();


           flitClass.push(flitClass1);
           
           }
      });


    

        $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        $.ajax({

          url:"{{ url('/logistic/save-trip-plan-apprve-payment-advice') }}",

           method : "POST",

           type: "JSON",

           data: {flitClass: flitClass},

           
           success:function(data){

           console.log(data);

              var data1 = JSON.parse(data);

              
              if(data1.response == 'error') {
               var responseVar = false;

              var url = "{{url('finance/view-payment-msg')}}";
              setTimeout(function(){ window.location = url+'/'+responseVar; });
              }else{
               
               var responseVar = true;

              var url = "{{url('finance/view-payment-msg')}}";
              setTimeout(function(){ window.location = url+'/'+responseVar; });
              }

            
           }

        });


    }

  </script>

<script type="text/javascript">
  $(document).ready(function() {

  jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
        return $(el).is('a, button, :input, [tabindex]');
    }
});

$(document).on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(document.activeElement) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
});

});
</script>




@endsection