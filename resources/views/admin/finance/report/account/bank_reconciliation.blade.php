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

  .showAccName{
    border: none;
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
  }
  .crBal{
    display:none;
  }
  .defualtSearchNew{
    display: none;
  }
  .rightcontent{
    text-align:right;
  }
  ::placeholder {
    text-align:left;
  }
  .showSeletedName {
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .showhideGl{
    display: none;
  }
  .hideAccc{
    display: none;
  }
  .showhideaccC{
    display: none;
  }
  .showthforaccgl{
    display: none;
  }
  @media only screen and (max-width: 600px) {
    
    .dataTables_filter{
      margin-left: 35%;
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
  .showhideaccC{
    display: none;
  }
  .showhideGl{
    display: none;
  }
  .btnstyle{
    font-size: 13px;
  }
  .srNoDataTnl{
    width: 5%;
  }
  .glNameDataTbl{
    width: 20%;
    text-align: left;
  }
  .drAmtDataTbl{
    width: 11%;
    text-align: right;
  }
  .crAmtDataTbl{
    width: 11%;
    text-align: right;
  }
</style>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>

        View Print PassBook

        <small>: Report Details</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}">Report</a></li>

        <li><a href="{{ url('/dashboard') }}">Account</a></li>

        <li class="active"><a href="{{ url('/report/account/bank-reconciliation-report') }}">View Print PassBook </a></li>

      </ol>

    </section>

    <section class="content">

      <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> View Print PassBook</h2>

          <!-- <div class="box-tools pull-right">

            <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

          </div> -->

        </div><!-- /.box-header -->

        <div class="box-body">

          <form id="myForm">

            @csrf

            <?php date_default_timezone_set('Asia/Kolkata'); ?>

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">
                    <?php 

                        date_default_timezone_set('Asia/Kolkata');

                        $CurrentDate = date("d-m-Y");
                        $FromDate    = date("d-m-Y", strtotime($fromDate));  
                        $ToDate      = date("d-m-Y", strtotime($toDate));  
                        $spliDate    = explode('-', $CurrentDate);
                        $yearGet     = Session::get('macc_year');
                        $fyYear      = explode('-', $yearGet);
                        $get_Month   = $spliDate[1];
                        $get_year    = $spliDate[2];

                        if($get_Month > 3 && $get_year == $fyYear[1]){
                            $vrDate = $ToDate;
                        }else{
                            $vrDate = $CurrentDate;
                        }

                      ?>
                    
                  <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $FromDate }}">
                  <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $ToDate }}">
                  <input autocomplete="off" type="hidden" name="" id="todayDate" value="{{ $CurrentDate }}">

                  <label for="exampleInputEmail1">From Date : </label>

                  <div class="input-group">
                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                     <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="{{ $FromDate }}">

                  </div>
                  <small id="show_err_from_date" style="color: red;"></small>
                     
                </div>

              </div><!-- /.col -->

              <?php 

                date_default_timezone_set('Asia/Kolkata');

                $getCurrDtTim = date('Y-m-d H:i:s');
               
                $getExp = explode(" ",$getCurrDtTim);

                $secExp = explode("-",$getExp[0]);

                $expTime = explode(":",$getExp[1]);

                $getnewDt = $secExp[0].''.$secExp[1].''.$secExp[2].'_'.$expTime[0].''.$expTime[1].''.$expTime[2];

              ?>

              <input type="hidden" id="excelDt" value="{{$getnewDt}}">

              <div class="col-md-2">

                <div class="form-group">

                    <label for="exampleInputEmail1">To Date: </label>

                    <div class="input-group">
                          <div class="input-group-addon">

                        <i class="fa fa-calendar"></i>

                      </div>
                          <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control transdatepicker rightcontent" placeholder="Enter To  Date" value="{{$vrDate}}">
                    </div>

                    <small id="show_err_to_date" style="color:red;"></small>

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

                    <input list="seriesList"  id="series_code" name="series" class="form-control  pull-left serieswidth"
                    onchange="getGlCdOnSeries(this.value)" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                    <datalist id="seriesList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($getseries as $key)

                      <option value='<?php echo $key->SERIES_CODE; ?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>"><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div>
                  <small id="serscode_err" style="color: red;" class="form-text text-muted"></small>

                  <input type="hidden" name='seriesGlCd' id="seriesGlCdId" value="" />
                          
                </div><!-- /.form-group -->
              </div> <!-- /. col-->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Series Name : 
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

              <div class="col-md-2"  style="margin-top: 9px;">

                 <button type="button" class="btn btn-primary" id="ProceedBtnId" style="padding: 1px 1px 1px 1px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                <button type="button" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();" style="padding: 1px 1px 1px 1px;">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>
                
              </div>
                
            </div>

           <div class="col-md-1"></div>

          </form>

        </div><!-- /.box-body -->

      </div>

    </section>

    <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-info Custom-Box">

          <div class="box-body">

            <div class="modalspinner hideloaderOnModl"></div>

            <div class="">

              <form action="{{ url('/transaction/account/save-bank-reconciliation') }}" method="POST">
                 @csrf
                <table id="createDoTbl" class="table tdthtablebordr">

                  <style>
                    .textCenter{
                      text-align: center !important;
                    }
                  </style>

                  <thead>
                    <tr>
                      <th class="textCenter">Bank Date</th>
                      <!-- <th class="textCenter">Vr Date</th> -->
                      <th class="textCenter">Vr No</th>
                      <th class="textCenter">GL/Account Code</th>
                      <th class="textCenter">GL/Account Name</th>
                      <th class="textCenter">Instrument Type</th>
                      <th class="textCenter">Instrument No</th>
                      <th class="textCenter">Instrument Date</th>
                      <th class="textCenter">Particular</th>
                      <th class="textCenter">Dr/Withdrawal Amount</th>
                      <th class="textCenter">Cr/Deposit Amount</th>
                      <th class="textCenter">Balance<input type="hidden" value="0" id="rBalAmtHid"></th>
                    </tr>
                  </thead>
                   
                  <tbody>
                    
                  </tbody>

                  <tfoot>
                    <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
                  </tfoot>

                </table><!-- /.table -->

            </div><!-- /.table-responsive -->


          </div><!-- /. box-body-->

        </div><!-- /. Custom-Box-->

      </div><!-- /. col-->

    </div><!-- /. row-->

  </section><!-- /. section-->

</div>

@include('admin.include.footer')


<script src="{{ URL::asset('public/dist/js/viewjs/cash_bank_trans.js') }}" ></script>

<script src="{{ URL::asset('public/dist/js/viewjs/jquery.printPage.js') }}"></script>

<script type="text/javascript">


  $(document).ready(function(){
    $('.btnprn').printPage();
  });

/* ------------ START : Load Data Table ------------------ */

 

load_data_query();

function load_data_query(series_code= '',from_date='',to_date='',seriesGlCd=''){

      var fromdateintrans = $('#FromDateFy').val();
      var todateintrans   = $('#ToDateFy').val();
      var default_date    = $('#default_date').val();

      var currDt = $('#currDt').val();
     
      $('#createDoTbl').DataTable({

          footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // converting to interger to find total
            var intVal = function ( i ) {
              return typeof i === 'string' ?
                  i.replace(/[\$,]/g, '')*1 :
                  typeof i === 'number' ?
                      i : 0;
            };
        
            var drAmtTotal = api
              .column( 8 )
              .data()
              .reduce( function (a, b) {
                  return intVal(a) + intVal(b);
              }, 0 );
    
            var crAmtTotal = api
              .column( 9 )
              .data()
              .reduce( function (a, b) {
                  return intVal(a) + intVal(b);
            }, 0 );

            var totBal = parseFloat(crAmtTotal) - parseFloat(drAmtTotal);

              $( api.column( 7 ).footer() ).html('Total :-').css('text-align','right');
              $( api.column( 8).footer() ).html(parseFloat(drAmtTotal).toFixed(2));
              $( api.column( 9).footer() ).html(parseFloat(crAmtTotal).toFixed(2));
              $( api.column( 10).footer() ).html(parseFloat(totBal).toFixed(2));
              //$( api.column( 10).footer() ).html(balTotal.toFixed(2));
              //$( api.column( 11).footer() ).html('<span class="label label-danger">'+balType+'</span>');
              
            },
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: false,
          scrollY: 500,
         // scrollX: true,
          scroller: true,
          fixedHeader: true,
          order: [[0, 'asc'],[1, 'asc']],
          columnDefs: [
             { orderable: false, targets:2 },
             { orderable: false, targets:3 },
             { orderable: false, targets:4 },
             { orderable: false, targets:5 },
             { orderable: false, targets:6 },
             { orderable: false, targets:7 },
             { orderable: false, targets:8 },
             { orderable: false, targets:9 },
             { orderable: false, targets:10 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
          buttons:  [
                      {
                        extend: 'excelHtml5',
                        title: 'BANK RECONCILIATION '+$("#excelDt").val(),
                        filename: 'BANK_RECONCILIATION_'+$("#excelDt").val(),
                      }
                    ],
          info: true,
          ajax:{
            url:'{{ url("/report/account/get-data-onBank-recon-report") }}',
            data: {series_code:series_code,from_date:from_date,to_date:to_date,seriesGlCd:seriesGlCd}
          },
          columns: [

            {   
              data:'BankDate',
              render: function (data, type, full, meta) {
                var doDate = full['BankDate'];
                
                /*var date= mDate;
                var d=new Date(date.split("/").reverse().join("-"));
                var dd=d.getDate();
                var mm=d.getMonth();
                var yy=d.getFullYear();
                var doDate=dd+"/"+mm+"/"+yy;
              */
                return doDate;
              },
              className:'text-right',
              
          },
            /*{
              data:'VRDATE',
              className: "text-right",
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    var newVrDt = '00-00-0000';
                  }else{
                    
                    var newVrDt = date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }

                  return newVrDt+'<input type="hidden" name="vrDt[]" id="vrDtId" value="'+newVrDt+'">';
              }
               
            },*/
            {
              data:'vrno',
              render: function (data, type, full, meta){
                var vrno    = full['vrno'];
                if(vrno=='0'){
                  var newVrNo = vrno;
                }else{
                  var fyDt    = full['FY_CODE'];
                  var exp     = fyDt.split("-");
                  var scrCode = full['SERIES_CODE'];
                  var newVrNo = scrCode+"/"+exp[0]+"/"+vrno;
                }
                
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

                 if (full['ACC_CODE']!=null || full['ACC_CODE']!='') {

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
              
              data:'particular',
              render: function (data, type, full, meta){
       
                var cbParticular = full['particular']; 

                return cbParticular+'<input type="hidden" class="center formInput" value="'+cbParticular+'" name="cbParticular[]"/>';


              },
              className: "text-left"
               
            },
            {
                data:'drAmt',
                render: function (data, type, full, meta){
               
                var drAmt = full['drAmt'];
               
                return drAmt+'<input type="hidden" class="center formInput" value="'+drAmt+'" name="cbDrAmt[]"/>';


              },
               className: "text-right"
               
            },
            {  
              data:'CrAmt',
                render: function (data, type, full, meta){
               
                var  crAmt = full['CrAmt'];
               
                return crAmt+'<input type="hidden" class="center formInput" value="'+crAmt+'" name="cbCrAmt[]"/>';


              },
               className: "text-right"
        
            },

            {  
               
                render: function (data, type, full, meta){

                  var srNo = full['DT_RowIndex'];

                  if(srNo == 1){
                    var opBal_Amt = 0;

                    var opBalAmt = parseFloat(opBal_Amt) + parseFloat(full['CrAmt']) - parseFloat(full['drAmt']);

                    $('#rBalAmtHid').val(opBalAmt);
                  }else{

                      var opBalAmt1 = $("#rBalAmtHid").val();

                      var opBalAmt = parseFloat(opBalAmt1) + parseFloat(full['CrAmt']) - parseFloat(full['drAmt']);

                      $('#rBalAmtHid').val(opBalAmt);


                  }

                  var retOpBal = opBalAmt.toFixed(2);
                  
                  return  retOpBal;

              },
               className: "text-right"
        
            },
            
            
            
          ]


      });

    

  }


 /* ---------- END : Load Data Table ---------------- */



/* ~~~~~~ START : Date Picker for Bank Date ~~~~~~~~*/


    $(document).ready(function() {

      var currDt = $('#currDt').val();

      
      $('#default_date').datepicker({

        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        startDate : currDt,
        autoclose: 'true'
      });

      console.log("page ready...!");

    });

/* ~~~~~~ END : Date Picker for Bank Date ~~~~~~~~*/


  
  /* ..........START : Search Button Click ......... */

  $(document).ready(function(){


    $('#ProceedBtnId').click(function(){
        
         var series_code =  $('#series_code').val();
         var from_date   =  $('#from_date').val();
         var to_date     =  $('#to_date').val();
         var seriesGlCd  =  $('#seriesGlCdId').val();
       

        if(series_code!=''){

          $('#serscode_err').html('');
          
              $('#createDoTbl').DataTable().destroy();

    /* --------- START : ON Search Btn Click Load Data Table -------*/

              load_data_query(series_code,from_date,to_date,seriesGlCd);

         
              $('#series_code,#from_date,#to_date').prop('disabled',true);

    /* --------- END : ON Search Btn Click Load Data Table -------*/

                     

        }else{

          $('#serscode_err').html('*The Series Code field is required.');
          
        }
        
    });


});

/* ..........END : Search Button Click ......... */

  function getGlCdOnSeries(getSeries){

    $.ajaxSetup({

      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $.ajax({

      url:"{{ url('/report/account/bank-reco-series-gl-code') }}",

      method : "POST",

      type: "JSON",

      data: {getSeries: getSeries},

      success:function(data){

        var data1 = JSON.parse(data);
          
        if (data1.response == 'error') {

                $('#serscode_err').html("<p style='color:red'>*Series Code GL Code Not Found...!</p>");
                  
        }else if(data1.response == 'success'){

            if(data1.data==''){

            }else{

              console.log('gl',data1.gl_list[0].POST_CODE);
              $('#seriesGlCdId').val(data1.gl_list[0].POST_CODE);

            }

        }
      }
    });

    

  }
  


</script>

@endsection
