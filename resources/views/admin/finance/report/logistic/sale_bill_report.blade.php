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
</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Provisional Sale Bill - eProc Status
        <small>: Bill Details</small>
      </h1>

      <ul class="breadcrumb">

        <li>
          <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>

        <li>
          <a href="{{ url('/dashboard') }}">Transaction</a>
        </li>

        <li>
          <a href="{{ url('/dashboard') }}">Logistics</a>
        </li>

        <li class="active">
          <a href="{{ url('/logistic/sale-bill-final') }}">  Provisional Sale Bill - eProc Status </a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Provisional Sale Bill - eProc Status</h2>

              <div class="box-tools pull-right">

               <!--  <a href="{{ url('/logistic/sale-bill-final-view') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Sale Bill Final</a> -->

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

          <form id="myForm">
            @csrf

             <?php  $current_date = date("d-m-Y"); ?> 
 
            <div class="row">
              
            <div class="col-md-2">

               <div class="form-group">

                <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                    $ToDate= date("d-m-Y", strtotime($toDate));   ?>

                  <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                  <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                  <label for="exampleInputEmail1"> From Date: </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                   
                    <input type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Select Transaction Date" value="{{$FromDate}} " autocomplete="off">

                  </div>

                  <small id="show_err_from_date">

                  </small>

               </div>

            </div>

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1"> To Date: </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                  </div>

                  <input type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Select Transaction Date" value="{{$current_date}}" autocomplete="off">

                </div>

                <small id="show_err_to_date">

                </small>

              </div>

            </div>

              <div class="col-md-3">

                <div class="form-group">

                  <label>Series Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="seriesList"  id="series_code" name="seriesCode" onchange="getvrnoBySeries()" class="form-control  pull-left" placeholder="Select Series" value="{{ old('seriesCode')}}" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="seriesList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($series_list as $key)

                        <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                      <input type="hidden" name="series_name" id="seriesName">

                    </div>

                      <input type="hidden" id="seriesGlC" name="seriesGlC">
                    <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                    <small id="showSeriesErr" style="color: red;"></small>
                </div><!-- /.form-group -->
              </div> <!-- /. col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Plant Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="plantList"  id="plantCodeId" onchange="getNameofPlantCode()" name="plantCode"  class="form-control  pull-left" placeholder="Select Plant"  value="{{ old('plantCode')}}" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="plantList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($plantlist as $key)

                        <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                      <input type="hidden" name="plant_name" id="seriesName">

                      <input type="hidden" name="plant_state" id="plantState">

                    </div>
                    <small id="plantcode_err" style="color: red;" class="form-text text-muted"> </small>

                    <small id="showplantErr" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

              <div class="col-md-2">

                  <div class="form-group">

                    <label> Plant Category : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="plantCatg" value="{{ old('plantCatg')}}" id="plantCatgId" placeholder="Plant Category" readonly autocomplete="off">

                      </div>

                      <small id="showplantCatErr" style="color: red;"></small>

                  </div><!-- /.form-group -->
              </div> <!--  /. col-md-2 -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Tran Type : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="tranTypeList"  id="tranTypeId" name="tranType" class="form-control  pull-left" value="{{ old('tranType')}}" placeholder="Select Transaction Type"  autocomplete="off" onchange="getAccCodeFromTranCode(this.value)">

                      <datalist id="tranTypeList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($accCatglist as $key)

                        <option value='<?php echo $key->ACATG_CODE?>'   data-xyz ="<?php echo $key->ACATG_NAME; ?>" ><?php echo $key->ACATG_NAME ; echo " [".$key->ACATG_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>
                    <small id="shwoErrTranCode" style="color: red;"></small>
                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Account Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="AccountList"  id="account_code" onchange="getOtherDataFromAccCode(this.value)" name="AccCode" class="form-control  pull-left" value="{{ old('AccCode')}}" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="AccountList">

                         @foreach ($acc_list as $key)

                        <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                    <input type="hidden" id="accStateCode" name="accStateCode">
                 
                    <small id="shwoErrAccCode" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div>

              <div class="col-md-3">

                <div class="form-group">

                  <label>Account Name: <span class="required-field"></span></label>

                    <div class="">

                      <input type="text"  id="AccountText" name="AccountText" class="form-control  pull-left" value="{{ old('AccountText')}}" placeholder="Select Account Name" readonly autocomplete="off">
                     
                    </div>

                </div><!-- /.form-group -->

              </div><!-- /.col-md-3 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Current Status: <span class="required-field"></span></label>

                    <div class="">

                      <input list="curStaList"  id="curr_status" name="curr_status" class="form-control  pull-left" value="" placeholder="Select Current Status"  autocomplete="off">

                      <datalist id="curStaList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($status_list as $key)

                        <option value='<?php echo $key->CURRENT_STATUS?>'   data-xyz ="<?php echo $key->CURRENT_STATUS; ?>" ><?php echo $key->CURRENT_STATUS;  ?></option>

                        @endforeach

                      </datalist>
                     
                    </div>

                </div><!-- /.form-group -->

              </div>

            </div> <!-- /.row -->



          <!--   <input type="hidden" id="checkBoxCount" value=""/>

            <input type="hidden" id="mCurrentStatus" value="Freight Calculation Done"/> -->
          
            <div class="row">
              
              <div class="" style="margin-top: 1%;text-align: center;">

                 <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                  <button type="button" class="btn btn-warning" name="resetBtn" onClick="window.location.reload();"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

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
          </form>
            
        </div><!-- /.box-body -->


        <div class="box-body">

          <table id="saleBillReport" class="table table-bordered table-striped table-hover">

            <thead class="theadC">

              <tr>

                <th class="text-center" width="4%">Vr No.</th>
                <th class="text-center" width="4%">Transaction No</th>
                <th class="text-center" width="8%">Current Status</th>
                <th class="text-center" width="5%">Invoice No</th>
                <th class="text-center" width="4%">Delivery No</th>
                <th class="text-center" width="3%">Item Slno</th>
                <th class="text-center" width="3%">Cam Code</th>
                <th class="text-center" width="7%">Cam Name</th>
                <th class="text-center" width="12%">Sold to Party</th>
                <th class="text-center" width="5%">Account Code </th>
                <th class="text-center" width="10%">Account Name</th>
                <th class="text-center" width="5%">Qty</th>
                <th class="text-center" width="6%">Rate</th>
                <th class="text-center" width="5%">Basic Amount</th>
                <th class="text-center" width="5%">IGST</th>
                <th class="text-center" width="5%">SGST</th>
                <th class="text-center" width="5%">CGST</th>
                <th class="text-center" width="5%">Cal Frght Value</th>
                <th class="text-center" width="5%">Cal Bonus Amt.</th>
                <th class="text-center" width="5%">TARP Value</th>
                <th class="text-center" width="5%">Upload Penalty Amt.</th>
                <th class="text-center" width="5%">Cal Penalty Amt.</th>
                <th class="text-center" width="5%">Upload Bill Amt.</th>
                <th class="text-center" width="5%">Cal Bill Amt.</th>
                <th class="text-center" width="5%">Short Value </th>
                <th class="text-center" width="5%">Late Del Value</th>
                <th class="text-center" width="5%">Payable Bill Amt.</th>
                <th class="text-center" width="5%">Diff. Amount</th>
               
              </tr>

            </thead>

            <tbody id="defualtSearch">

            </tbody>

          </table>

         

        </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->

</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showallDataM">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content" style="border-radius: 5px;">
      <div class="modal-header" style="text-align:center;">
        <h5 class="modal-title modltitletext" id="exampleModalLabel" style="font-size: 18px;font-weight:600;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> <span style="color:red">Alert!<span></h5>
      </div>
      <div class="modal-body" id="messageShowBody">

      </div>
      <div class="modal-footer" style="text-align:center">
        <button type="button" style='width: 100px;' class="btn btn-primary" data-dismiss="modal" id=""> Ok &nbsp;&nbsp;&nbsp;<i class="fa fa-sign-out" aria-hidden="true"></i></button>
      </div>
    </div>
  </div>
</div>




@include('admin.include.footer')



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

  /* -------- START: GET-ACC CODE FROM TRAN CODE ---------*/

  function getAccCodeFromTranCode(tranCode){

      //console.log('tranCode',tranCode);

    var plantCat = $('#plantCatgId').val();

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
    });

    $.ajax({

          url:"{{ url('/logistics/get-accCode-from-tranCode') }}",

          method : "POST",

          type: "JSON",

          data: {tranCode: tranCode,plantCat:plantCat},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log('data1.response',data1.response);

              if (data1.response == 'error') {

                $('#shwoErrTranCode').html("<p style='color:red'>Account Code Not Found For This Transaction Code.</p>");

              }else if(data1.response == 'success'){

                  $('#account_code').val('');
                  $('#AccountText').val('');
                  $('#AccountList').empty();


                  if (data1.get_data.length==1) {

                      console.log('length',data1.get_data[0].ACC_NAME);

                      $("#AccountList").append($('<option>',{

                        value: data1.get_data[0].ACC_CODE,
                        'data-xyz': data1.get_data[0].ACC_NAME,
                        text: data1.get_data[0].ACC_CODE+' - '+data1.get_data[0].ACC_NAME


                      }));

                  }else{


                    $.each(data1.get_data, function(k, getData){

                      $("#AccountList").append($('<option>',{

                        value: getData.ACC_CODE ,
                        'data-xyz': getData.ACC_NAME,
                        text: getData.ACC_CODE+' - '+getData.ACC_NAME


                      }));

                    });


                  }


                   

              }

          }

    });


  }

  /* -------- END: GET-ACC CODE FROM TRAN CODE ---------*/



/* -----START: DELIVERY_NO/WAGON_NO/LR_NO/VEHICLE_NO FROM ACC AND PLANT -----*/

  function getOtherDataFromAccCode(accCode){

    var plantCode  = $('#plantCodeId').val();
    var seriesCode = $('#series_code').val();
    var itemCode   = $('#itemCodeId').val();
    $("#accAddrID").val('');
    $("#accAddrList").empty();

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('/transition/get-otherDetails-from-acc-code') }}",

          method : "POST",

          type: "JSON",

          data: {accCode: accCode,plantCode:plantCode,seriesCode:seriesCode,itemCode:itemCode},

          success:function(data){

            var data1 = JSON.parse(data);

            $('#plantCatgId1').val('');

              if (data1.response == 'error') {
                $('#plantCatgId1').val('');
                $('#shwoErrAccAddr').html("<p style='color:red'>Account Address Not Found...!</p>");

              }else if(data1.response == 'success'){

                var accAddrLen = data1.acc_addr_list.length;

                //console.log('address',data1.acc_addr_list);

                if(accAddrLen>0) {

                    /*accAddrID*/
                   $("#accAddrList").empty();

                   $.each(data1.acc_addr_list, function(k, row){


                        var accAddress = (row.ADD1 != "" || row.ADD1 != "NULL" || row.ADD1 != null) ? row.ADD1+',' : "";
                        var accCity    = (row.CITY_NAME != "" || row.CITY_NAME != "NULL" || row.CITY_NAME != null) ? row.CITY_NAME+',' : "";
                        var accState   = (row.STATE_NAME != "" || row.STATE_NAME != "NULL" || row.STATE_NAME != null) ? row.STATE_NAME+',' : "";
                        var accScode   = (row.STATE_CODE != "" || row.STATE_CODE != "NULL" || row.STATE_CODE != null) ? row.STATE_CODE : "not-found";
                        var accPin     = (row.PIN_CODE != "" || row.PIN_CODE != "NULL" || row.PIN_CODE != null) ? row.PIN_CODE : "";
                        
                        //console.log('add',accAddress);

                      $("#accAddrList").append($('<option>',{


                        value: accAddress+accCity+accState+accPin,
                        'data-xyz': accScode+'~'+accState,
                        text: accAddress+accCity+accState+accPin,

                      }));

                    });


                }else{

                    $("#accAddrList").empty();
                    $("#shwoErrAccAddr").html('*The Account Address field is required.');

                }

                  $("#deliveryNoList").empty();
                  $("#wagonNoList").empty();
                  $("#lrNoList").empty();
                  $("#vehicleNoList").empty();

                  $.each(data1.get_data, function(k, getData){

                    $("#deliveryNoList").append($('<option>',{

                      value: getData.DELIVERY_NO ,
                      'data-xyz': getData.DELIVERY_NO,
                      text: getData.DELIVERY_NO


                    }));

                    $("#wagonNoList").append($('<option>',{

                      value: getData.WAGON_NO ,
                      'data-xyz': getData.WAGON_NO,
                      text: getData.WAGON_NO


                    }));

                    $("#lrNoList").append($('<option>',{

                      value: getData.LR_NO ,
                      'data-xyz': getData.LR_NO,
                      text: getData.LR_NO


                    }));

                    $("#vehicleNoList").append($('<option>',{

                      value: getData.VEHICLENO ,
                      'data-xyz': getData.VEHICLENO,
                      text: getData.VEHICLENO


                    }));

                  });

              }

          }

    });


  }

/* -----END: DELIVERY_NO/WAGON_NO/LR_NO/VEHICLE_NO FROM ACC AND PLANT -----*/


/*  -----START: GET-TAX CODE FROM ADDRESS CITY--------- */


  function checkTaxCode(accAddr){

    $('#accStateCode').val('');

    var xyz = $('#accAddrList option').filter(function() {

    return this.value;

    }).data('xyz');

    var cityCdNm = xyz ?  xyz : 'No Match';


    var exp = cityCdNm.split('~');

    var scode = exp[0];
    var sname = exp[1];


    $('#accStateCode').val(scode);


    var seriesCode   = $('#series_code').val();
    var plantCode    = $('#plantCodeId').val();
    var itemCode     = $('#itemCodeId').val();
    var accCode      = $('#account_code').val();

   
    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('/logistics/get-taxcode-onlogistic-sale-bill') }}",

          method : "POST",

          type: "JSON",

          data: {plantCode:plantCode,seriesCode:seriesCode,itemCode:itemCode,scode:scode,sname:sname,accCode:accCode},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                  $('#showallDataM').modal('show');

                  $('#messageShowBody').html('<span style="font-size:14px;font-weight:600;"> <i class="fa fa-caret-right" aria-hidden="true"></i> '+data1.validation_msg+'</span>');
               
              }else if(data1.response == 'success'){

                console.log('acc t',data1.acc_tax);


                  if (data1.acc_tax != 'null') {

                      $("#taxCodeList").empty();

                      $("#taxCodeID").val(data1.acc_tax);

                      if (data1.get_tax_list != 'null') {

                            $.each(data1.get_tax_list, function(k, key){

                              //console.log('tax',key);

                              $("#taxCodeList").append($('<option>',{

                                value: key,
                                'data-xyz': key,
                                text: key

                              }));

                            });

                      }else{

                        $("#taxCodeID").prop('readonly',true);
                       
                      }

                  }else{

                    console.log('acc t1',data1.acc_tax);
                   

                    if (data1.get_tax_list != 'null') {

                      var taxListLength = data1.get_tax_list.length;

                       console.log('item tax len',taxListLength);

                      if(taxListLength>1) {

                        $("#taxCodeID").prop('readonly',false);
                          
                         $("#taxCodeList").empty();

                         $.each(data1.get_tax_list, function(k, key){

                            $("#taxCodeList").append($('<option>',{

                              value: key.TAX_CODE,
                              'data-xyz': key.TAX_CODE+' - '+key.TAX_NAME,
                              text: key.TAX_CODE+' - '+key.TAX_NAME

                            }));

                          });

                      }else if(taxListLength==0){

                        $("#taxCodeList").empty();
                        $("#taxCodeID").prop('readonly',true);
                        $("#shwoErrTaxCode").html('*The Tax Code field is required.');

                      }else{

                          //console.log('tax-code-list',data1.get_tax_list[0].TAX_CODE);

                          $("#taxCodeID").val(data1.get_tax_list[0]);
                          $("#taxCodeID").prop('readonly',true);

                      }

                    }else{

                      $("#taxCodeList").empty();
                      $("#taxCodeID").prop('readonly',true);
                      $("#shwoErrTaxCode").html('*The Tax Code field is required.');

                    }

                  } /* acc-code condition if close */


              }/* ./ Success-Response check - if close */


          }/* /. AJAX Success function close  */

    });


  }


/*  ------END: GET-TAX CODE FROM ADDRESS CITY------- */



/* ----- START: GET PLANT NAME AND PLANT CATEGORY FROM PLANT CODE -----*/

  function getNameofPlantCode(){

    var plantCode   = $('#plantCodeId').val();

    var xyz = $('#plantList option').filter(function() {

    return this.value == plantCode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    console.log('nm',msg);

    if(msg == 'No Match'){
      $('#plantCodeId').val('');
      $('#showplantErr').html(msg);
      $('#plantCodeId').prop('readonly',false);
      $('#plantCodeId').css('border-color','#ff0000').focus();
    }else{
      $('#plantCodeId').css('border-color','#d4d4d4');
      $('#itemCodeId').css('border-color','#ff0000').focus();
      $('#plantCodeId').prop('readonly',true);
      $('#plantCodeId').val(plantCode+' [ '+msg+' ]');
      $('#plant_name').val(msg);
      $('#showplantErr').html('');
      
    }

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('/transition/get-plant-categoryfromplant-code') }}",

          method : "POST",

          type: "JSON",

          data: {plantCode: plantCode},

          success:function(data){

            var data1 = JSON.parse(data);

            $('#plantCatgId').val('');
            $('#plantState').val('');

              if (data1.response == 'error') {
                $('#plantCatgId').val('');
                $('#plantState').val('');
                $('#showplantCatErr').html("<p style='color:red'>Plant Category Not Found...!</p>");

              }else if(data1.response == 'success'){

                 $('#plantCatgId').val(data1.get_data[0].PLANT_CATEGORY);

                 if (data1.get_data[0].STATE_CODE!='' || data1.get_data[0].STATE_CODE!='NULL') {

                   $('#plantState').val(data1.get_data[0].STATE_CODE);

                 }else{

                  $('#plantState').val('not-found');

                 }

              }

          }

    });

  }

/* ----- END : GET PLANT NAME AND PLANT CATEGORY FROM PLANT CODE -----*/


  /* ---------- ITEM/SERVICES CODE ON CLICK FOR FOCUS -------- */
  
  function itemServicesCode(itemVal){

     var xyz = $('#itemCodeList option').filter(function() {

    return this.value == series;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
   
      $('#itemCodeId').prop('readonly',false);
      $('#itemCodeId').css('border-color','#ff0000').focus();

    }else{
      $('#itemCodeId').css('border-color','#d4d4d4');
      $('#itemCodeId').prop('readonly',true);
      $('#tranTypeId').css('border-color','#ff0000').focus();
    }

  }


  /* ---------- ./ ITEM/SERVICES CODE ON CLICK FOR FOCUS -------- */



/* ----- START: CREATE VRNO OR GET FROM DB -----*/

  function getvrnoBySeries(){

    var series = $('#series_code').val();
    var seriesSplit = series.split('[');
    var seriesCode = seriesSplit[0];
    var transcode = $('#transcode').val();

    var xyz = $('#seriesList option').filter(function() {

    return this.value == series;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $('#series_code').val('');
      $('#vrseqnum').val('');
      // $('#series_code').prop('readonly',false);
      // $('#series_code').css('border-color','#ff0000').focus();
    }else{

        // $('#series_code').css('border-color','#d4d4d4');
        // $('#plantCodeId').css('border-color','#ff0000').focus();
        // $('#series_code').prop('readonly',true);

      $('#series_code').val(series+' [ '+msg+' ]');
      $('#seriesName').val(msg);

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('get-vr-sequence-by-series') }}",

          method : "POST",

          type: "JSON",

          data: {seriesCode: seriesCode,transcode:transcode},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log('data1.response',data1.response);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.vrno_series == ''){

                  }else{
                    if(data1.vrno_series){
                      var getlastno = data1.vrno_series.LAST_NO;
                    }else{
                      var getlastno = '';
                    }

                    if(data1.vrnodata == ''){
                     // $('#vrseqnum').val(getlastno);
                      $('#vrseqnum').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);
                     // $('#getVrNo').val(lastNo);
                    }
                  }

              }

          }

    });
   
    }

  }


/* ----- END : CREATE VRNO OR GET FROM DB -----*/


  $(document).ready(function(){


      // $('#series_code').css('border-color','#ff0000').focus();

   
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



/* -------- START: DATA-TABLE ----------- */

  

  $(document).ready(function(){

          var fromdateintrans = $('#FromDateFy').val();
          var todateintrans = $('#ToDateFy').val();

          $('#from_date').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });

          $('#to_date').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });

    $('#btnsearch').click(function(){
        
      var from_date    =  $('#from_date').val();
      var to_date    =  $('#to_date').val();
      var series_code =  $('#series_code').val();
      var plant_code  =  $('#plantCodeId').val();
      var tranType    =  $('#tranTypeId').val();
      var accountCode =  $('#account_code').val();
      var curr_status =  $('#curr_status').val();

      blankData = '';

      if(from_date == ''){
         $('#show_err_from_date').html('Please select From date').css('color','red');
         return false;
      }else{
          $('#show_err_from_date').html('');
      }

      if(to_date == ''){
         $('#show_err_to_date').html('Please select To date').css('color','red');
         return false;
      }else{
          $('#show_err_to_date').html('');
      }

      if(from_date != '' || to_date != '' || series_code !='' || plant_code !='' || tranType !='' || accountCode !=''){

          $('#saleBillReport').DataTable().destroy();
          load_data_query(blankData,from_date,to_date,series_code,plant_code,tranType,accountCode,curr_status);

          $('#vrDateId').prop('disabled',true);
          $('#series_code').prop('disabled',true);
          $('#plantCodeId').prop('disabled',true);
          $('#tranTypeId').prop('disabled',true);
          $('#account_code').prop('disabled',true);
          $('#btnsearch').prop('disabled',true);
          $('#curr_status').prop('disabled',true);
          $('#from_date').prop('disabled',true);
          $('#to_date').prop('disabled',true);

      }else{
          load_data_query(blankData);

      }
        
    });

  });

 
  $("#account_code").bind('change', function () {  

    var account_code = $('#account_code').val();
    var xyz = $('#AccountList option').filter(function() {

    return this.value == account_code;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
          $('#AccountText').val('');
        }else{
          $('#AccountText').val(msg);
        }

  });

  var blankData = 'Blank';
  var owner = '';
  load_data_query(blankData=='Blank');


  function load_data_query(blankData= '',from_date='',to_date='',series_code='',plant_code='',tranType='',accountCode='',curr_status=''){

    var getcomName = '<?php echo Session::get('company_name'); ?>';
    var getFY      = '<?php echo Session::get('macc_year'); ?>';
    var getnewdate = new Date();
    var getday = getnewdate.getDate();
    var getMonth = getnewdate.getMonth()+1;
    var getYear = getnewdate.getFullYear();


    var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

    var getdate = getday+''+getMonth+''+getYear;

     $('#saleBillReport').DataTable({

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
        var rowcount = data.length;
        
        if(rowcount > 0){
           $('.buttons-excel').attr('disabled',false);
        }else{
           $('.buttons-excel').attr('disabled',true);
        }

            
      },

      processing: true,
      serverSide: false,
      info: true,
      bPaginate: false,
      scrollY: 400,
      scrollX: true,
      scroller: true,
      fixedHeader: true,
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
      buttons: [
                  {
                    extend: 'excelHtml5',
                    filename: 'SALE_BILL_EPROC_STATUS_REPORT'+getdate+'_'+gettime,
                    title: getcomName+'\n'+getFY+'\n'+' SALE BILL EPROC STATUS REPORT',
                    exportOptions: {
                          columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27]
                    }
                  }

                ],
      ajax:{
        url:'{{ url("/get-data-logistics-sale-bill-report") }}',

        data: {blankData:blankData,from_date:from_date,to_date:to_date,series_code:series_code,plant_code:plant_code,tranType:tranType,accountCode:accountCode,curr_status:curr_status},

      },
      columns: [
        {  
          data:'VRNO',
          render: function (data, type, full, meta){

              var vrno       = full['VRNO'];
              var seriescode = full['SERIES_CODE'];
              var fycd       = full['FY_CODE'];
              var splitFy = fycd.split('-');

              var newVrNo = splitFy[0]+'/'+seriescode+'/'+vrno;
            
              return newVrNo;

          },
          className:'text-left'
        },
       { data :'TRANSACTION_NO',name:'TRANSACTION_NO',className:'text-right'},
       { data :'CURRENT_STATUS',name:'CURRENT_STATUS',className:'text-left'},
       { data :'INVC_NO',name:'INVC_NO',className:'text-right'},
       { data :'DELIVERY_NO',name:'DELIVERY_NO',className:'text-right'},
       { data :'ITEM_SLNO',name:'ITEM_SLNO',className:'text-right'},
       { data :'SR_CODE',name:'SR_CODE',className:'text-left'},
       { data :'SR_NAME',name:'SR_NAME',className:'text-left'},
       { data :'CP_NAME',name:'CP_NAME',className:'text-left'},
       { data :'ACC_CODE',name:'ACC_CODE',className:'text-left'},
       { data :'ACC_NAME',name:'ACC_NAME',className:'text-left'},
       { data :'NET_WEIGHT',name:'NET_WEIGHT',className:'text-right'},
       { data :'RATE',name:'RATE',className:'text-right'},
       { data :'BASICAMT',name:'BASICAMT',className:'text-right'},
       { data :'IGST',name:'IGST',className:'text-right'},
       { data :'SGST_UGST',name:'SGST_UGST',className:'text-right'},
       { data :'CGST',name:'CGST',className:'text-right'},
       { data :'CAL_FRGHT_VALUE',name:'CAL_FRGHT_VALUE',className:'text-right'},
       { data :'CAL_BONUS_AMT',name:'CAL_BONUS_AMT',className:'text-right'},
       { data :'TARP_VALUE',name:'TARP_VALUE',className:'text-right'},
       { data :'UPLOAD_PENALTY_AMT',name:'UPLOAD_PENALTY_AMT',className:'text-right'},
       { data :'CAL_PENALTY_AMT',name:'CAL_PENALTY_AMT',className:'text-right'},
       { data :'UPLOAD_BILL_AMT',name:'UPLOAD_BILL_AMT',className:'text-right'},
       { data :'CAL_BILL_AMT',name:'CAL_BILL_AMT',className:'text-right'},
       { data :'SHORT_VALUE',name:'SHORT_VALUE',className:'text-right'},
       { data :'LATE_DEL_VALUE',name:'LATE_DEL_VALUE',className:'text-right'},
       { data :'PAYBLE_BILL_AMT',name:'PAYBLE_BILL_AMT',className:'text-right'},
       { 
          data:'CAL_FRGHT_VALUE',
          render: function (data, type, full, meta){

            var basicVal = full['BASICAMT'];
            var calFriVal = full['CAL_FRGHT_VALUE'];
                
            var totalVal = parseFloat(basicVal) - parseFloat(calFriVal);

            var finalTot = totalVal.toFixed(2);

            return finalTot;
              

            },
          className:'text-right'
        }
       

      ]

     })

  }


</script>

@endsection