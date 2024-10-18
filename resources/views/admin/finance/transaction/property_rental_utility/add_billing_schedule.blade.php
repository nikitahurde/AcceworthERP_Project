@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .PageTitle{
    margin-right: 1px !important;
  }

  .required-field::before {
    content: "*";
    color: red;
  }

  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  @media screen and (max-width: 600px) {

    .PageTitle{

      float: left;

    }

  }

  .rightcontent{

    text-align:right;


  }

  ::placeholder {
    
    text-align:left;
  }
  .amtRightAlign{
    text-align:right;
  }
  .btn {

    display: inline-block;

    font-weight: 400;

    text-align: center;

    vertical-align: middle;

    cursor: pointer;

    -webkit-user-select: none;

    -moz-user-select: none;

    -ms-user-select: none;

    user-select: none;

    padding: .375rem .75rem;

    font-size: 14px;

    line-height: 1.5;

    border-radius: .25rem;

    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
  }

  .btn-success {

      color: #fff;

      background-color: #28a745;

      border-color: #28a745;

  }


  .text-center{

    text-align: center;

  }


  .title{

      margin-top: 50px;

      margin-bottom: 20px;

  }


  table {

     border-collapse: collapse;

  }

  .table-responsive {

      display: block;

      width: 100%;

      overflow-x: auto;

      -webkit-overflow-scrolling: touch;

  }

  .table {

      width: 100%;

      margin-bottom: 1rem;

      color: #212529;
  }

  .table thead th {

      vertical-align: bottom;

      border-bottom: 2px solid #dee2e6;

  }

  .table td, .table th {

      padding: .75rem;

      vertical-align: top;

  }

  input:focus{border:1px solid yellow;} 

  .space{margin-bottom: 2px;}


  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 6px;

    padding-bottom: 0px !important;

    line-height: 1.42857143;

    vertical-align: top;

    border-top: 1px solid #ddd;

    text-align: center;
  }

  .tdsratebtn{

    margin-top: 3% !important;

    font-weight: 600 !important;

    font-size: 10px !important;

  }

  .modltitletext{
    font-weight: 800;
    color: #5696bb;
    font-size: 16px;
  }
  .box-header>.box-tools {

    position: absolute !important;

    right: 10px !important;

    top: 2px !important;

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
  }

  .boxer .boxNF {
    display: table-cell;
    vertical-align: top;
    border-bottom: 1px solid #80808054;
    padding: 5px;
    color: #dd4b39;
    font-size: 16px;
    font-weight: 600;
  }

  .center {
    text-align:center;
  }
  .settaxcodemodel{
    font-size: 16px;
    font-weight: 800;
    color: #5d9abd;

  }
  .srnonum{
    width: 49px !important;
  }
  .inputtaxInd{
    width: 94px !important;
  }
  .qualitychrc{
    width: 66px !important;
  }
  .rightcontent{
    width: 89px !important;
  }
  .hideColm{
  display: none;
  }
  .checkstyling{
    height: 26px;
    width: 17px;
  }
  .table_sim{
  display:table;         
  width:auto;                
  border:1px solid  #666666;         
 
}
.table-row_sim{
  display:table-row;
  width:auto;
  clear:both;
}
.table-row_sim_head{
  display:table-row;
  width:auto;
  clear:both;
  text-align: center;
  font-weight: 600;
}
.table-col_sim{
  float:left;
  display:table-column;         
  width:131px;         
  border:1px solid  #ccc;
  padding: 2px;
}
.table-col_sim_glacc{
  float:left;
  display:table-column;         
  width: 259px;      
  border:1px solid  #ccc;
  padding: 2px;
}
.table-col_sim_srno{
  float:left;
  display:table-column;         
  width:43px;         
  border:1px solid  #ccc;
  padding: 2px;
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

.basicOtherGrandStyle{

    font-weight: 700;
    margin-top: 11px;
}

.btnSize{
  padding: 1px 7px 1px 5px;
}

@media screen and (max-width: 600px) {

    .credittotldesn{
      width: 89px;
      margin-bottom: 5px;
      margin-left: -34%;
    }
    .totlsetinres{
      width: 130%;
    }
    .debitcreditbox{
      margin-top: 0%;
    }
    .PageTitle{
      float: left;
    }

  }

</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Billing Schedule 
        <small>: Add Details</small>
      </h1>

      <ul class="breadcrumb">

        <li>
          <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>

        <li>
          <a href="{{ url('/dashboard') }}">Transaction</a>
        </li>

        <li>
          <a href="{{ url('/dashboard') }}">Property Rental Utility</a>
        </li>

        <li class="active">
          <a href="{{ url('/transaction/property-rental-utility/add-billing-schedule') }}">   Billing Schedule </a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Billing Schedule </h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/transaction/property-rental-utility/view-billing-schedule') }}" class="btn btn-primary btnSize" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Billing Schedule</a>

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

          <div class="overlay-spinner hideloader"></div>

          
 
            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label>Acc Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-address-card-o" aria-hidden="true"></i>

                      </div>

                      <input list="AccountList"  id="account_code"  name="AccCode" class="form-control  pull-left" value="{{ old('AccCode')}}" placeholder="Select Account Name" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="AccountList">

                        <option selected="selected" value="">-- Select --</option>

                        <?php foreach ($Order_Acc_list as $key){ ?>

                          <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                        <?php } ?>

                      </datalist>

                    </div>

                    <input type="hidden" id="accStateCode" name="accStateCode">
                 
                    <small id="shwoErrAccCode" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

               <div class="col-md-3">

                  <div class="form-group">

                    <label>Acc Name: <span class="required-field"></span></label>

                      <div class="">

                        <input type="text"  id="AccountText" name="AccountText" class="form-control  pull-left" value="{{ old('AccountText')}}" placeholder="Select Account Name" readonly autocomplete="off">
                       
                      </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col-md-3 -->
              
              <div class="col-md-3">

                <div class="form-group">

                  <label>Sale Order No : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                      <input list="orderNoList"  id="orderNo" name="orderNo" class="form-control  pull-left" value="{{ old('orderNo')}}" placeholder="Select Order No" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="orderNoList">

                        <option selected="selected" value="">-- Select --</option>

                      </datalist>

                    </div>
                 
                    <small id="shwoErrOrderNo" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-3 -->

              <div class="col-md-2">

                <div class="form-group">

                    <label for="exampleInputEmail1">Beginning Date: </label>

                    <div class="input-group">
                          <div class="input-group-addon">

                        <i class="fa fa-calendar"></i>

                      </div>
                          <input autocomplete="off" type="text" name="begDate" id="begDate" class="form-control transdatepicker rightcontent" placeholder="Select Beginning Date" value="<?php echo date('d-m-Y'); ?>">

                    </div>

                    <small id="showErrBegDate" style="color:red;"></small>

                </div>

              </div><!-- /.col-md-2 -->


              <div class="col-md-2">

                <div class="form-group">

                    <label for="exampleInputEmail1">Tenure In Month: </label>

                    <div class="input-group">
                          <div class="input-group-addon">

                        <i class="fa fa-calendar-check-o"></i>

                      </div>
                          <input type="text" name="tenureInMh" id="tenureInMh" class="form-control rightcontent" placeholder="Enter Tenure In Month" value="{{ old('tenureInMh')}}" autocomplete="off">

                    </div>

                    <small id="showErrTenureInMh" style="color:red;"></small>

                </div>

              </div><!-- /.col-md-2 -->


            </div> <!-- /.row -->



            <div class="row">

              <div class="col-md-3">

                <div class="form-group">

                  <label>Increment Indicator : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-caret-up" aria-hidden="true"></i>

                      </div>

                      <input list="IncIndList"  id="IncInd" name="IncInd" class="form-control  pull-left" value="{{ old('IncInd')}}" placeholder="Select Increment Indicatory"  autocomplete="off">

                      <datalist id="IncIndList">

                        <option selected="selected" value="" data-xyz ="" >-- Select --</option>
                        <option selected="selected" value="Yearly" data-xyz ="Yearly Rental" >Yearly [ Yearly Rental ]</option>
                        <option selected="selected" value="Half Yearly" data-xyz ="Half Yearly Rental" >Half Yearly [ Half Yearly Rental ]</option>
                        <option selected="selected" value="Quarterly" data-xyz ="Quarterly Rental" >Quarterly [ Quarterly Rental ]</option>
                        <option selected="selected" value="Monthly" data-xyz ="Monthly Rental" >Monthly [ Monthly Rental ]</option>

                       

                      </datalist>

                    </div>
                    <small id="shwoErrIncInd" style="color: red;"></small>
                </div><!-- /.form-group -->

              </div> <!-- /. col-md-3 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Increment Rate ( In Percentage ) : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                      <input type="text" id="IncRate" name="IncRate" class="form-control  pull-left" value="{{ old('IncRate')}}" placeholder="Enter Increment Rate" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                    </div>
                 
                    <small id="shwoErrIncRate" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-3 -->

            </div> <!-- /.row -->

            <div class="row">
              
              <div class="" style="margin-top: 1%;text-align: center;">

                 <button type="button" class="btn btn-primary btnSize" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                  <button type="button" class="btn btn-warning btnSize" name="resetBtn" onClick="window.location.reload();"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

              </div>

            </div>

            <div class="row">

              <div class="col-md-4"></div>
              <div class="col-md-4">

              </div> <!--  ./col -->
              <div class="col-md-4"></div>
              
            </div> <!-- /. row -->

            <div class="row">
                <p id="checkBoxSelectMsg" style="text-align: center;color:red;padding-top: 10px;"></p>
            </div>
          
            
        </div><!-- /.box-body -->


        <div class="box-body">

          <form id="rental_billing_schedule_tbl">
          @csrf
          <div class="table-responsive">

            <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

              <tr>

                <th width="5%"> Sr.No.</th>

                <th  width="15%">Schedule Date</th>

                <th  width="15%">Schedule Amount</th>

                <th  width="50%">Particular</th>

              </tr>

            </table> <!-- ./ Table Close -->

          </div><!-- /div -->



            <!-- ~~~~~~~~~ Start : head fields data ~~~~~~~~~~~~ -->

              <input type="hidden" name="hidAccCode" value="" id="hidAccCodeId" />
              <input type="hidden" name="hidAccNm" value="" id="hidAccNmId" />
              <input type="hidden" name="hidSaleOrdNo" value="" id="hidSaleOrdNoId" />
              <input type="hidden" name="hidBegDt" value="" id="hidBegDtId" />
              <input type="hidden" name="hidTenure" value="" id="hidTenureId" />
              <input type="hidden" name="hidIncInd" value="" id="hidIncIndId" />
              <input type="hidden" name="hidIncRate" value="" id="hidIncRateId" />
            

            <!-- ~~~~~~~~~ End : head fields data ~~~~~~~~~~~~ -->

              
        <style type="text/css">

        .distClass{

          display: none;

        }

        </style>    

              <p class="text-center">

             
                <button class="btn btn-success btnSize" type="button" id="submitdata" onclick="submitAllData(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning btnSize" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

              </p>


            </form>

          </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->

 

</div>




@include('admin.include.footer')

<!-- <script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script> -->
<script src="{{ URL::asset('public/dist/js/viewjs/commonJsFun.js') }}" ></script>

<script type="text/javascript">


  $(document).ready(function() {

    /* ---- FROM DATE / TO DATE START ---- */

    var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date,
      autoclose: 'true'
    });


    $('.datepicker1').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date,
      autoclose: 'true'

    });

    /* ---- FROM DATE / TO DATE END ---- */


  });


$(document).ready(function(){


  $('#series_code').css('border-color','#ff0000').focus();

   
/* ---------- START : VR DATEPICKER -------- */

    var fromdateintrans = $('#FromDateFy').val();
    var todateintrans = $('#ToDateFy').val();

    $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromdateintrans,

      endDate : todateintrans,

      autoclose: 'true'

    });

/* ---------- END : VR DATEPICKER -------- */



/* ---------- START : CHECK VR DATE VALIDATION ------- */

    $('#vrDateId').on('change',function(){

        var trans_date = $('#vrDateId').val();
        var slipD =  trans_date.split('-');
        var Tdate = slipD[0];
        var Tmonth = slipD[1];
        var Tyear = slipD[2];
        var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;   
        var selectedDate = new Date(getproperDate);
        var todayDate = new Date();  

        if(selectedDate > todayDate){

          $('#show_err_vrDt').html('Transaction Date Can Not Be Greater Than Todays Date').css('color','red');
          $('#vrDateId').val('');
          return false;

        }else{
          $('#show_err_vrDt').html('');
          return true;
        }    

    });

});


/* ---------- END : CHECK VR DATE VALIDATION ------- */




/* -------- START : SEARCH BTN CLICK ----------- */

  $(document).ready(function(){

    $('#btnsearch').click(function(){
        
        var accountCode   =  $('#account_code').val();
        var AccountText   =  $('#AccountText').val();
        var orderNo       =  $('#orderNo').val();
        var beginningDate =  $('#begDate').val();
        var tenureInMh    =  $('#tenureInMh').val();
        var IncInd        =  $('#IncInd').val();
        var IncRate       =  $('#IncRate').val();  
       

        if(accountCode!=''){
          $('#shwoErrAccCode').html('');
          if(orderNo!=''){
            $('#shwoErrOrderNo').html('');
                if(beginningDate!=''){
                  $('#showErrBegDate').html('');
                  if(tenureInMh !=''){
                    $('#showErrtenureInMh').html('');
                    if(IncInd !=''){
                      $('#shwoErrIncInd').html('');
                      if(IncRate !=''){
                         $('#shwoErrIncRate').html('');
                         $('#saleBillManage').DataTable().destroy();

                  /* --------- START : ON Search Btn Click Load Data Table -------*/

                          $('#account_code,#AccountText,#orderNo,#begDate,#tenureInMh,#IncInd#IncRate').prop('disabled',true);

                          console.log('tenure ',tenureInMh);

                          $.ajaxSetup({

                                headers: {

                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                                }
                          });

                          $.ajax({

                              type: 'POST',

                              url: "{{ url('/transaction/property-rental-utility/get-sale-order-data') }}",

                              data: {accountCode:accountCode,orderNo:orderNo,beginningDate:beginningDate,tenureInMh:tenureInMh}, 

                              success: function (data) {

                                var data1 = JSON.parse(data);

                                console.log('data err',data1);

                                  if (data1.response == 'error') {

                                   console.log('error');

                                   $('#submitdata').prop('disabled',true);

                                  }else{

                                      console.log('success',data1.sale_order_list);

                        /* ~~~~~~~~~~ Start : In Hidden Fields Add Value ~~~~~~~~~~~~ */
                            
                                      $('#hidAccCodeId').val('');
                                      $('#hidAccNmId').val('');
                                      $('#hidSaleOrdNoId').val('');
                                      $('#hidBegDtId').val('');
                                      $('#hidTenureId').val('');
                                      $('#hidIncIndId').val('');
                                      $('#hidIncRateId').val('');
                                     
                                      $('#hidAccCodeId').val(accountCode);
                                      $('#hidAccNmId').val(AccountText);
                                      $('#hidSaleOrdNoId').val(orderNo);
                                      $('#hidBegDtId').val(beginningDate);
                                      $('#hidTenureId').val(tenureInMh);
                                      $('#hidIncIndId').val(IncInd);
                                      $('#hidIncRateId').val(IncRate);
                                  

                        /* ~~~~~~~~~~ End : In Hidden Fields Add Value ~~~~~~~~~~~~ */


                                      var srNo = 1;
                                      var demo = 'demo';

                                      var INITAMT = parseFloat(data1.sale_order_list[0].BASICAMT);
                                      var ORDERHID = data1.sale_order_list[0].SORDERHID;

                                      if (IncInd == 'Yearly') {

                                        var YEARMONTH = 12;
                                        var INCMONTH  = 12;

                                      }else if(IncInd == 'Half Yearly'){

                                        var YEARMONTH = 6;
                                        var INCMONTH  = 6;

                                      }else if(IncInd == 'Quarterly'){

                                        var YEARMONTH = 3;  
                                        var INCMONTH  = 3;
                                        
                                      }else{

                                        var YEARMONTH = 1;
                                        var INCMONTH  = 1;
                                      }


                                      for (var i = 0; i < tenureInMh; i++) {

                                        if (srNo>YEARMONTH) {

                                          YEARMONTH = parseFloat(YEARMONTH) + parseFloat(INCMONTH);
                                          var MINCAMT = parseFloat(INITAMT)*parseFloat(IncRate)/100;
                                          INITAMT = Math.round(parseFloat(INITAMT) + MINCAMT);

                                        }

                                        var MPARTICULAR = 'Rent for the month of '+data1.next_date_list[i];

                                        var data="<tr><td class='tdthtablebordr'><span id='snum"+i+"'>"+srNo+".</span></td>";

                                          data +="<td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr SetInCenter' style='width: 90px;text-align:right;' value='"+data1.next_date_list[i]+"' id='scheduleDtId"+i+"' name='scheduleDt[]' oninput='this.value = this.value.toUpperCase()' readonly/></td><td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr' style='width: 145px;margin-bottom: 5px;text-align:right;' id='scheduleAmtId"+i+"' name='scheduleAmt[]' readonly value='"+INITAMT+"' /></td><td class='tdthtablebordr'><div style=''><textarea type='textarea' class='SetInCenter' style='width:500px;height: 25px;'  id='particular"+i+"' name='particular[]' col='1'>"+MPARTICULAR+"</textarea><input type='hidden' value='"+ORDERHID+"' id='orderhid' name='orderhid'></td>";

                                            $('table').append(data);


                                        srNo++;
                                      
                                      } /* ./ Tenure Count If Close */

                                          $('#submitdata').prop('disabled',false);
                                  }
                               
                              },

                          });

                        

                  /* --------- END : ON Search Btn Click Load Data Table -------*/

                      }else{
                        $('#shwoErrIncRate').html('*The Increment Rate field is required.');
                      }

                    }else{
                      $('#shwoErrIncInd').html('*The Increment Ind. field is required.');
                    }

                  }else{
                    $('#showErrTenureInMh').html('*The Tenure field is required.');
                  }

                }else{
                    $('#showErrBegDate').html('*The Beginning Date field is required.');
                }


          }else{
            $('#shwoErrOrderNo').html('*The Order No. field is required.');
          }

        }else{

          $('#shwoErrAccCode').html('*The Account Code field is required.');
          
        }
        
    });

  });

/* -------- END : SEARCH BTN CLICK ----------- */




/* -------- START : GET-ACC NAME ON ACC CHANGE ----------- */

  $("#account_code").bind('change', function () {  

    var account_code = $('#account_code').val();
    var xyz = $('#AccountList option').filter(function() {

    return this.value == account_code;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
          $('#AccountText').val('');
          $("#orderNoList").empty();
          $("#orderNo").val('');
        }else{
          $('#AccountText').val(msg);

        }

      $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/transaction/property-rental-utility/get-sale-order-for-rent') }}",

          data: {account_code:account_code}, // here $(this) refers to the ajax object not form

          success: function (data) {

            var data1 = JSON.parse(data);

            console.log('data err',data1);

            if (data1.response == 'error') {

               $('#shwoErrOrderNo').html('*The Sale Order No Not Found.');

            }else{

              $('#shwoErrOrderNo').html('');

              $("#orderNoList").empty();

              $.each(data1.data, function(k, getData){

                var fyCd = getData.FY_CODE;

                var mfyCd = fyCd.split('-');

                var orderNo = mfyCd[0]+' '+getData.SERIES_CODE+' '+getData.VRNO;

                $("#orderNoList").append($('<option>',{

                  value: orderNo ,
                  'data-xyz': orderNo,
                  text: orderNo


                }));

              });


            }
           
          },

      });

  });

/* -------- END : GET-ACC NAME ON ACC CHANGE ----------- */


/* -------- START : SAVE BTN CLICK ----------- */
    
  function submitAllData(valD){

    var downloadFlg = valD;
   
    var formData = $("#rental_billing_schedule_tbl").serializeArray();

    console.log('serialize',formData);

    $('.overlay-spinner').removeClass('hideloader');

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

        type: 'POST',

        url: "{{ url('/transaction/property-rental-utility/save-billing-schedule') }}",

        data: formData,

        success: function (data) {

          var data1 = JSON.parse(data);

          console.log('data err',data1);

           if (data1.response == 'error') {

              console.log('error on save...!');
              var responseVar = false;
              var url = "{{url('/transaction/property-rental-utility/msg-billing-schedule')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

            }else{
             
              $('.overlay-spinner').removeClass('hideloader');
              console.log('success on save...!');
              var responseVar = true;
              var url = "{{url('/transaction/property-rental-utility/msg-billing-schedule')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

            }

          $('.overlay-spinner').addClass('hideloader');

          console.log('response ',data1);
         
        },

    });



  }


/* -------- END : SAVE BTN CLICK ----------- */

  
</script>

@endsection