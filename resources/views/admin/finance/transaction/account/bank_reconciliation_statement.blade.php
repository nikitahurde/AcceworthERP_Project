@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

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
  .boxHide{
    display: none;
  }
  .printPageTitle{
    display: none;
  }
  @page { size: auto;  margin: 0mm; }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Bank Reconciliation Statement 
      <small> : Statement Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transation </a></li>
      <li class="active"><a href="{{ url('/transaction/account/bank-reconciliation-statement') }}">Bank Reconciliation Statement  </a></li>

    </ol>

  </section>


<form id="inwardImportTran">
    @csrf

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle formTitle" style="font-weight: 800;color: #5696bb;">Bank Reconciliation Statement </h2>

      </div><!-- /.box-header -->

      <div class="box-body">

          <div class="row">

            <div class="col-md-1"></div>
             <?php date_default_timezone_set('Asia/Kolkata'); ?>
            <div class="col-md-2">

               <div class="form-group">

                <?php 
                    $FromDate= date("d-m-Y", strtotime($fromDate));  
                    $ToDate= date("d-m-Y", strtotime($toDate)); 
                    $Today_date = date("d-m-Y");
                ?>

                  <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $FromDate }}">
                  <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $ToDate }}">
                  <input autocomplete="off" type="hidden" name="" id="todayDate" value="{{ $Today_date }}">

                  <label for="exampleInputEmail1"> From Date: </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                   
                    <input autocomplete="off" type="text" name="from_date" id="fromDate" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="<?php echo $FromDate; ?>" readonly>

                  </div>

                  <small id="show_err_from_date">

                  </small>

               </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1"> To Date: </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                  </div>

                  <input type="text" name="to_datecash" id="to_datecash" class="form-control datepicker1" placeholder="Select To Date" value="<?php echo $Today_date; ?>">

                </div>

                <small id="show_err_to_date">

                </small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

                <div class="form-group">

                  <label>Series : 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                    </div>

                    <?php $getcount = count($getseries); ?>

                    <input list="seriesList"  id="series_code" name="series" class="form-control  pull-left serieswidth" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                    <datalist id="seriesList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($getseries as $key)

                      <option value='<?php echo $key->SERIES_CODE; ?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>"><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div>
                  <small id="serscode_err" style="color: red;" class="form-text text-muted">
                  </small>
                 
                          
                </div><!-- /.form-group -->
              </div> <!-- /. col-->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Series Name: 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                    </div>

                    <input type="text" id="seriesText" name="seriesname" class="form-control  pull-left" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_NAME;}else{} ?>" placeholder="Select Series Name" readonly  data-toggle="tooltip" data-placement="top">

                  </div>
                       
                </div><!-- /.form-group -->
              </div><!-- /.col -->

            <div id="errorItem"></div>

            <div class="col-md-2" style="margin-top: 10px;">

              <button class="btn btn-primary" type="button" id="proceedBtn">
                &nbsp;&nbsp;<i class="fa fa-forward" aria-hidden="true"></i>&nbsp;&nbsp; Proceed &nbsp;&nbsp;
              </button>

               <button type="button" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>
              
            </div><!-- /.col -->

            <div class="col-md-2"></div>

            <small id="errorItem"></small>

          </div><!-- /.row -->

      </div><!-- /.box-body -->

    </div><!-- /. custom box -->

<style>
  .pageTitleClass{
    margin-top: 1%;
    line-height: 0.8;
    font-size: 17px;
    font-weight: 600;
  }
</style>
    <div class="box box-warning Custom-Box">

      <div class="box-body boxHide" id="bodyBoxId">

        <div id="printableArea">

          <div class="printPageTitle" id="printPageTitleId" style='margin-left: 35% !important;margin-top: 1%;line-height: 0.8;font-size: 17px;font-weight: 600; word-wrap: normal;'>
            
            <p style='margin-left: 8%'><?php echo $MCOMPNAME; ?> </p>
            <p style='margin-right: 5%'>BANK RECONCILIATION STATEMENT AS ON <span id="asOnDtTitle"></span> </p>
            <p style='margin-left: 3%' id="seriesCdTitle">BANK RECONCILIATION STATEMENT AS ON 06-06-2023 </p>


          </div>

        <table class="table table-bordered table-striped table-hover" style='width: 50%;margin-left: 25%;'>
          <thead class="theadC">

            <tr>
           
              <th class="text-center" width="5%">Particulars</th>
              <th class="text-center" width="5%">As On <br> <span id="asOnDate">  </span></th>
              
             </tr>

          </thead>

          <tbody id="defualtSearch">

            <tr>
              <td class="text-left" height="40" style='font-size: 14px;width: 50%;'> <span> Bank Balance As per Bank Book </span></td>
              <td class="text-right" height="40" style='font-size: 14px;width: 30%;'><span id="passBkBnkBal"> </span></td>
            </tr>

            <tr onclick="showDetailsInfo('CIBNP');">
               <td class="text-left" height="40" style='font-size: 14px;width: 50%;'> <span > (+) Cheque Issued but Not Yet Presented </span></td>
               <td class="text-right" height="40" style='font-size: 14px;width: 30%;'><span id="chIssNtPresented">  </span> </td>
            </tr>

            <tr onclick="showDetailsInfo('OCIBNP')">
              <td class="text-left" height="40" style='font-size: 14px;width: 50%;'> <span> (+) Opening Cheque issued but not yet Presented </span></td>
              <td class="text-right" height="40" style='font-size: 14px;width: 30%;'><span id="opChqIssNtPresented">  </span></td>
              
            </tr>

            <tr onclick="showDetailsInfo('CDBNYP')">
              <td class="text-left" height="40" style='font-size: 14px;width: 50%;'> <span > (-) Cheque Deposited but not yet Cleared </span> </td>
              <td class="text-right" height="40" style='font-size: 14px;width: 30%;'> <span id="chDepNtCleared">  </span></span>
              </td>
            </tr>

            <tr onclick="showDetailsInfo('OCDBNP')">
              <td class="text-left" height="40" style='font-size: 14px;width: 50%;'> <span> (-) Opening Cheque Deposited but not yet cleared </span></td>
              <td class="text-right" height="40" style='font-size: 14px;width: 30%;'><span id="opChqDepNtCleared">  </span>
              </td>
            </tr>

            <tr>
              <td class="text-left" height="40" style='font-size: 14px;width: 50%;'> <span > Balance as per Bank Statement </span> </td>
              <td class="text-right" height="40" style='font-size: 14px;width: 30%;'> <span id="balBkStatement">  </span> </td>
            </tr>

          </tbody>
         
        </table>

        </div>


        <div style='text-align: center;margin-bottom: 5px;'>
          <small style="color: red;font-size: 14px;">Click On Row To View Details </small>
        </div>

        <div style='text-align: center;'>

         <button type="button" class="btn btn-primary"  id="printBtn" onclick="printDiv('printableArea')">&nbsp;&nbsp;<i class="fa fa-print" aria-hidden="true"></i> &nbsp;&nbsp;Print&nbsp;&nbsp;</button>
          
        </div>

      </div><!-- /.box-body -->

    </div><!-- /. custom box -->

    <div class="box box-warning Custom-Box">

      <div class="box-body">

        <div style="text-align: center;font-weight: 700;color: #3c8dbc;font-size: 17px;" id="particularText"></div>

        <div class="">
            <table id="createDetailsTbl" class="table tdthtablebordr">

              <style>
                .textCenter{
                  text-align: center !important;
                }
              </style>

              <thead>
                <tr>
                  <th class="textCenter">Vr Date</th>
                  <th class="textCenter">Vr No</th>
                  <th class="textCenter">GL/Account Code</th>
                  <th class="textCenter">GL/Account Name</th>
                  <th class="textCenter">Instrument Type</th>
                  <th class="textCenter">Instrument No</th>
                  <th class="textCenter">Instrument Date</th>
                  <th class="textCenter">Particular</th>
                  <th class="textCenter">Dr Amount</th>
                  <th class="textCenter">Cr Amount</th>
                </tr>
              </thead>
               
              <tbody>
                
              </tbody>
              <tfoot>
                <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
              </tfoot>

            </table><!-- /.table -->

        </div><!-- /.table-responsive -->

      </div>
      
    </div>

  </section><!-- /.section -->

</form>

</div><!-- /.content-wrapper -->


@include('admin.include.footer')


<script type="text/javascript">

  function load_data_query(statementType,fromDate,toDate,seriesCode){

    $('#createDetailsTbl').DataTable({

      footerCallback: function ( row, data, start, end, display ) {
          var api = this.api(), data;

           var intVal = function ( i ) {
              return typeof i === 'string' ?
                  i.replace(/[\$,]/g, '')*1 :
                  typeof i === 'number' ?
                      i : 0;
          };

          var tueTotal = api
            .column( 8 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
          }, 0 );

          var threeTotal = api
            .column( 9 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
          }, 0 );


             
              $( api.column( 7 ).footer() ).html('Total :- ');
              $( api.column( 8 ).footer() ).html(parseFloat(tueTotal).toFixed(2));
              $( api.column( 9 ).footer() ).html(parseFloat(threeTotal).toFixed(2));
        }, 

      processing: true,
      serverSide: false,
      info: true,
      bPaginate: false,
      scrollY: 250,
      scrollX: true,
      scroller: true,
      fixedHeader: true,
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
      buttons:  [
                  {
                    extend: 'excelHtml5',
                    title: 'BANK RECONCILIATION '+$("#excelDt").val(),
                    filename: 'BANK_RECONCILIATION_'+$("#excelDt").val(),
                  }
                ],
      ajax:{
        url:'{{ url("/get-details-against-type-in-bank-reconciliation-statement") }}',
        method:'POST',
        data: {statementType:statementType,fromDate:fromDate,toDate:toDate,seriesCode:seriesCode}
      },
      columns: [
            {
              data:'VRDATE',
              className: "text-right",
              render: function (data,full) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    var newVrDt = '00-00-0000';
                  }else{
                    
                    var newVrDt = date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }

                  var rowNo = full['DT_RowIndex'];

                  return newVrDt+'<input type="hidden" name="vrDt[]" id="vrDtId_'+rowNo+'" value="'+newVrDt+'">';
              }
               
            },
            {
              data:'VRNO',
              render: function (data, type, full, meta){

                var fyDt    = full['FY_CODE'];
                var exp     = fyDt.split("-");
                var scrCode = full['SERIES_CODE'];
                var vrno    = full['VRNO'];

                var newVrNo = scrCode+"/"+exp[0]+"/"+vrno;

                return newVrNo+'<input type="hidden" name="vrNo[]" id="vrNoId" value="'+newVrNo+'"><input type="hidden" name="cbtranid[]" id="cbtranId" value="'+full['CBTRANID']+'"><input type="hidden" name="pfct[]" id="pfctId" value="'+full['PFCT_CODE']+'"><input type="hidden" name="tcode[]" id="tcodeId" value="'+full['TRAN_CODE']+'"><input type="hidden" name="seriesCd[]" id="seriesCdId" value="'+full['SERIES_CODE']+'"><input type="hidden" name="vrno[]" id="vrnoId" value="'+full['VRNO']+'"><input type="hidden" name="vrdate[]" id="vrdateId" value="'+full['VRDATE']+'"><input type="hidden" name="slno[]" id="slnoId" value="'+full['SLNO']+'">';


              },
               className: "text-left"
               
            },
            {
              data:'ACC_CODE',
              render: function (data, type, full, meta){

                if (full['ACC_CODE']!=null || full['ACC_CODE']!='') {

                  var accGlCd = full['ACC_CODE']; 

                }else{
                  var accGlCd = full['GL_CODE'];

                }
       

                return accGlCd+'<input type="hidden" class="center formInput" value="'+accGlCd+'" name="accCd[]"/>';


              },
               className: "text-left"
               
            },
            {
              data:'ACC_NAME',
              render: function (data, type, full, meta){

                 if (full['ACC_NAME']!=null || full['ACC_NAME']!='') {

                  var accGlNm = full['ACC_NAME']; 

                }else{

                  var accGlNm = full['GL_NAME'];

                }
       

                return accGlNm+'<input type="hidden" class="center formInput" value="'+accGlNm+'" name="accNm[]"/>';


              },
              className: "text-left"
               
            },
            {
              data:'INST_TYPE',
              render: function (data, type, full, meta){

                if(full['INST_TYPE']!=null){

                  var instType = full['INST_TYPE']; 
                }else{
                  var instType = '-----';
                }
                

                return instType+'<input type="hidden" class="center formInput" value="'+instType+'" name="instType[]"/>';


              },
              className: "text-left"
               
            },
            {
              data:'INST_NO',
              render: function (data, type, full, meta){
                
                if(full['INST_NO']!=null){

                  var instNo = full['INST_NO']; 

                }else{
                  var instNo = '-----';
                }

                return instNo+'<input type="hidden" class="center formInput" value="'+instNo+'" name="instNo[]"/>';


              },
              className: "text-left"
               
            },
            {
              data:'INST_DATE',
              render: function (data, type, full, meta){
                
                if(full['INST_DATE']!=null){

                  var instDt = full['INST_DATE'];
                  
                }else{
                  var instDt = '-----';
                }

                return instDt+'<input type="hidden" class="center formInput" value="'+instDt+'" name="instDt[]"/>';


              },
              className: "text-left"
               
            },
            {
              
              data:'PARTICULAR',
              render: function (data, type, full, meta){
       
                var cbParticular = full['PARTICULAR']; 

                return cbParticular+'<input type="hidden" class="center formInput" value="'+cbParticular+'" name="cbParticular[]"/>';


              },
              className: "text-left"
               
            },
            {
                data:'DRAMT',
                render: function (data, type, full, meta){
               
                var drAmt = full['DRAMT'];
               
                return drAmt+'<input type="hidden" class="center formInput" value="'+drAmt+'" name="cbDrAmt[]"/>';


              },
               className: "text-right"
               
            },
            {  
              data:'CRAMT',
                render: function (data, type, full, meta){
               
                var  crAmt = full['CRAMT'];
               
                return crAmt+'<input type="hidden" class="center formInput" value="'+crAmt+'" name="cbCrAmt[]"/>';


              },
               className: "text-right"
        
            },
            
            
          ]

    });

  }


  function showDetailsInfo(statementType){

    $('#createDetailsTbl').DataTable().destroy();
        //load_data();
    var fromDate   = $('#fromDate').val();
    var toDate     = $('#to_datecash').val();
    var seriesCode = $('#series_code').val();

    if(statementType == 'CIBNP'){
      $('#particularText').html('Cheque Issued but Not Yet Presented');
    }else if(statementType == 'OCIBNP'){
      $('#particularText').html('Opening Cheque issued but not yet Presented');
    }else if(statementType == 'CDBNYP'){
      $('#particularText').html('Cheque Deposited but not yet Cleared');
    }else if(statementType == 'OCDBNP'){
      $('#particularText').html('Opening Cheque Deposited but not yet cleared');
    }

    

    load_data_query(statementType,fromDate,toDate,seriesCode);

  }

/* --------------- START : SUBMIT DATA ------------ */

$(document).ready(function() {

  $('#proceedBtn').click(function(){

    console.log('export btn click...!');

    var fromDate   = $('#fromDate').val();
    var toDate     = $('#to_datecash').val();
    var seriesCode = $('#series_code').val();
    var seriesName = $('#seriesText').val();

    console.log('fromDate',fromDate);
    console.log('toDate',toDate);

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    if(toDate != ''){

      $('#fromDate').attr('disabled',true);
      $('#to_datecash').attr('disabled',true);
      $('#series_code').attr('disabled',true);
    
      $('#show_err_to_date').html('');
      $('#errorItem').html('');

      $.ajax({

        url:"{{ url('/transaction/account/bank-reconciliation-statement-data') }}",

        method : "POST",

        type: "JSON",

        data: {fromDate:fromDate,toDate:toDate,seriesCode:seriesCode},

        success:function(data){

          var data1 = JSON.parse(data);
            
          if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.data +"</p>");

              $('#bodyBoxId').addClass('boxHide');

              $('#passBkBnkBal').html('');
              $('#chIssNtPresented').html('');
              $('#opChqIssNtPresented').html('');
              $('#chDepNtCleared').html('');
              $('#opChqDepNtCleared').html('');
              $('#balBkStatement').html('');
              $('#asOnDate').html('');
              $('#seriesCdTitle').html('');
              $('#asOnDtTitle').html('');
                    
          }else if(data1.response == 'success'){

              $('#bodyBoxId').removeClass('boxHide');

              $('#errorItem').html('');

              $('#asOnDate').html(toDate);
              $('#asOnDtTitle').html(toDate);
              $('#seriesCdTitle').html(seriesName);


              if (data1.bankBalPassBook[1].YROPBAL==null || data1.bankBalPassBook[1].YROPBAL == 'NULL') {
                var yrOpBal = 0;
                yrOpBal = yrOpBal.toFixed(2);
              }else{

                var yrOpBal = parseFloat(data1.bankBalPassBook[1].YROPBAL);
              }

              if (data1.cqIssNtPres[0].cqIsNotPres==null || data1.cqIssNtPres[0].cqIsNotPres == 'NULL') {
                var cqIsNotPres = 0.00;
                cqIsNotPres = cqIsNotPres.toFixed(2);
              }else{

                var cqIsNotPres = data1.cqIssNtPres[0].cqIsNotPres;
              }

              if (data1.OpCqIssNtPres[0].opCqIsNotPres==null || data1.OpCqIssNtPres[0].opCqIsNotPres == 'NULL') {
                var opCqIsNotPres = 0;
                opCqIsNotPres = opCqIsNotPres.toFixed(2);
              }else{

                var opCqIsNotPres = data1.OpCqIssNtPres[0].opCqIsNotPres;
              }

              if (data1.cqDepNtClrd[0].cqDepNotClrd==null || data1.cqDepNtClrd[0].cqDepNotClrd == 'NULL') {
                var cqDepNotClrd = 0;
                cqDepNotClrd = cqDepNotClrd.toFixed(2);
              }else{

                var cqDepNotClrd = data1.cqDepNtClrd[0].cqDepNotClrd;
              }

              if (data1.opCqDepNtClrd[0].opCqDepNotClr==null || data1.opCqDepNtClrd[0].opCqDepNotClr == 'NULL') {
                var opCqDepNtClrd = 0.00;
                opCqDepNtClrd = opCqDepNtClrd.toFixed(2);
              }else{

                var opCqDepNtClrd = data1.opCqDepNtClrd[0].opCqDepNotClr;
              }

              $('#passBkBnkBal').html(yrOpBal);
              $('#chIssNtPresented').html(cqIsNotPres);
              $('#opChqIssNtPresented').html(opCqIsNotPres);
              $('#chDepNtCleared').html(cqDepNotClrd);
              $('#opChqDepNtCleared').html(opCqDepNtClrd);

              console.log('YROPBAL',yrOpBal);
              console.log('cqIsNotPres',cqIsNotPres);
              console.log('opCqIsNotPres',opCqIsNotPres);
              console.log('cqDepNotClrd',cqDepNotClrd);
              console.log('opCqDepNotClr',opCqDepNtClrd);

              var balanceBank = parseFloat(yrOpBal) + parseFloat(cqIsNotPres) + parseFloat(opCqIsNotPres) - parseFloat(cqDepNotClrd) - parseFloat(opCqDepNtClrd);

              var MBALANCEBANK = balanceBank.toFixed(2);

              $('#balBkStatement').html(MBALANCEBANK);
              
          }
        }
      });

     
    }else{

      $('#show_err_to_date').html('Please select to date').css('color','red');

    }

  });

/* ------------------ pfct code --------------- */

  $("#series_code").on('input', function () {  

      var val = $("#series_code").val();

      var xyz = $('#seriesList option').filter(function(el) {

        var getVal = el+'-'+this.value;

        return this.value == val;

    }).data('xyz');
 
      var msg = xyz ? xyz : 'No Match';

      if(msg=='No Match'){  
        $(this).val('');
        $('#seriesText').val('');
      }else{
        $('#seriesText').val(msg);
      }
   
});

/* ------------------ pfct code --------------- */

});


  /*~~~~~~~~ Print Page ~~~~~~~~~~*/
  
    function printDiv(divName) {

      /*$('#printPageTitleId').removeClass('printPageTitle');*/
       var printContents = document.getElementById(divName).innerHTML;
       var originalContents = document.body.innerHTML;

       document.body.innerHTML = printContents;

       window.print();

       document.body.innerHTML = originalContents;
    }

  /*~~~~~~~~ Print Page ~~~~~~~~~~*/
 

$(document).ready(function() {
  
    var fromDate  = $('#from_date_default').val()
    var toDate    = $('#to_date_default').val()
    var todayDate = $('#todayDate').val()

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromDate,

      endDate : fromDate,

      autoclose: 'true'

    });

    $('.datepicker1').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromDate,

      endDate : todayDate,

      autoclose: 'true'

    });

});

/* --------------- END : SUBMIT DATA ------------ */

</script>

@endsection