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
  .text-center{
    text-align: color:!important;
  }

  .text-right{
    text-align: right:!important;
  }

  .text-left{
    text-align: left:!important;
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


  .title{

      margin-top: 50px;

      margin-bottom: 20px;

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
</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Bill ( Provisional )
        <small>Add Details</small>
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
          <a href="{{ url('/logistic/sale-bill-provisional') }}">  Sales Bill ( Provisional ) </a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Sales Bill ( Provisional )</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/logistic/view-sale-bill-provisional') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Provisional Sale Bill</a>

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
 
            <div class="row">
              
            <div class="col-md-2">

              <div class="form-group">

                  <label for="exampleInputEmail1">Vr Date: </label>

                  <div class="input-group">
                        <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                        <input autocomplete="off" type="text" name="vrDate" id="vrDateId" class="form-control transdatepicker" placeholder="Select Vr Date" value="<?php echo date('d-m-Y'); ?>">

                  </div>

                  <small id="show_err_vrDt" style="color:red;"></small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

                <div class="form-group">

                  <?php

                   $From_date = date("d-m-Y", strtotime($fromDate));
                   $To_date = date("d-m-Y", strtotime($toDate));

                  ?>
                      
                  <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $From_date }}">
                  <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $To_date }}">
                  <label for="exampleInputEmail1">From Date : </label>

                  <div class="input-group">
                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                     <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="Enter From  Date" value="<?php echo $From_date; ?>">

                  </div>
                  <small id="show_err_from_date" style="color: red;"></small>
                    
                </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                  <label for="exampleInputEmail1">To Date: </label>

                  <div class="input-group">
                        <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                        <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control datepicker1" placeholder="Enter To  Date" value="<?php echo date('d-m-Y'); ?>">

                  </div>

                  <small id="show_err_to_date" style="color:red;"></small>

              </div>

            </div><!-- /.col -->

              <div class="col-md-2">

                  <div class="form-group">

                    <label> T Code : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="tran" value="<?php echo $trans_head; ?>" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                        <input type="hidden" id="transtaxCode" >
                      </div>

                  </div><!-- /.form-group -->
              </div> <!--  /. col-md-2 -->

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

            </div> <!-- /.row -->

            <div class="row">

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

                        <input type="text" class="form-control" name="plantCatg" value="{{ old('plantCatg')}}" id="plantCatgId" placeholder="Enter Plant Category" readonly autocomplete="off">

                      </div>

                      <small id="showplantCatErr" style="color: red;"></small>

                  </div><!-- /.form-group -->
              </div> <!--  /. col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>ITEM/SERVICE CODE : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="itemCodeList"  id="itemCodeId" name="itemCode" class="form-control  pull-left" value="{{ old('itemCode')}}" placeholder="Select Item/Service Code" oninput="this.value = this.value.toUpperCase()" onchange="itemServicesCode(this.value)"  autocomplete="off">

                      <datalist id="itemCodeList">

                        <option selected="selected" value="">-- Select --</option>

                        <?php foreach($itemList AS $key){ ?>

                          <option value='<?php echo $key->ITEM_CODE?>'  data-xyz="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME; echo "[".$key->ITEM_CODE."]"; ?></option>

                        <?php } ?>


                      </datalist>

                    </div>

                    <small id="shwoErrItemCode" style="color:red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>ITEM/SERVICE NAME : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text"  id="itemNameId" name="itemName" class="form-control  pull-left" value="{{ old('itemName')}}" placeholder="Select Item/Service Name" readonly  autocomplete="off">

                    </div>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

            </div> <!-- /.row -->


            <div class="row">

              <div class="col-md-3">

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

              <div class="col-md-3">

                <div class="form-group">

                  <label>Acc Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="AccountList"  id="account_code" onchange="getOtherDataFromAccCode(this.value)" name="AccCode" class="form-control  pull-left" value="{{ old('AccCode')}}" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="AccountList">

                        <option selected="selected" value="">-- Select --</option>

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

                  <label>Acc Address : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="accAddrList" onchange="checkTaxCode(this.value)"  id="accAddrID"  name="accAddr" class="form-control  pull-left" value="{{ old('accAddr')}}" placeholder="Select Account Address" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="accAddrList">

                        <option selected="selected" value="">-- Select --</option>

                      </datalist>

                    </div>

                    <small id="shwoErrAccAddr" style="color: red;"></small>

                    <input type="hidden" id="cityCodeName" name="cityCodeName" value='' />
                    <input type="hidden" id="stateCode" name="stateCode" value='' />

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

          </div><!-- ./ row -->


            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label>Tax Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="taxCodeList"  id="taxCodeID"  name="taxCode" class="form-control  pull-left" value="{{ old('taxCode')}}" placeholder="Select Tax-Code" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="taxCodeList">

                        <option selected="selected" value="">-- Select --</option>

                      </datalist>

                    </div>

                    <small id="shwoErrTaxCode" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Delivery No : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="deliveryNoList"  id="deliveryNoId" name="deliveryNo" class="form-control  pull-left" value="{{ old('deliveryNo')}}" placeholder="Select Delivery No"  autocomplete="off">

                      <datalist id="deliveryNoList">

                        <option selected="selected" value="">-- Select --</option>


                      </datalist>

                    </div>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-3 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Wagon No : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="wagonNoList"  id="wagonNoId" name="wagonNo" class="form-control  pull-left" value="{{ old('wagonNo')}}" placeholder="Select Wagon No"  autocomplete="off">

                      <datalist id="wagonNoList">

                        <option selected="selected" value="">-- Select --</option>


                      </datalist>

                    </div>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->
                
              <div class="col-md-3">

                <div class="form-group">

                  <label>LR No : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="lrNoList"  id="lrNoId" name="lrNo" class="form-control  pull-left" value="{{ old('lrNo')}}" placeholder="Select LR No"  autocomplete="off">

                      <datalist id="lrNoList">

                        <option selected="selected" value="">-- Select --</option>

                      </datalist>

                    </div>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-3 -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Vehicle No : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="vehicleNoList"  id="vehicleNoId" name="vehicleNo" class="form-control  pull-left" value="{{ old('vehicleNo')}}" placeholder="Select Vehicle No"  autocomplete="off">

                      <datalist id="vehicleNoList">

                        <option selected="selected" value="">-- Select --</option>

                      </datalist>

                    </div>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-3 -->

            </div><!-- ./ row -->

            <input type="hidden" id="checkBoxCount" value=""/>
          
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
<style>
  .noteClass{
    display: none;
  }
</style>

        <div class="box-body">

          <div class="modalspinner hideloaderOnModl"></div>

          <div class="noteClass" id="noteId" style="text-align: center;color: red;font-size:15px;font-weight: 600;">
            <b>Note : </b><span>Data showing in red color having freight sale rate (FSO) as zero.</span>
            <input type="hidden" id="headNoteInp" value="">
          </div>

          <div style="margin-top: 2% !important;">
            <table id="saleBillManage" class="table table-bordered table-striped table-hover">

              <thead class="theadC">

                <tr>
                  <th class="text-center" width="2%">#</th>
                  <th class="text-center" width="2%">SlNo</th>
                  <th class="text-center" width="4%">Delivery No</th>
                  <th class="text-center" width="5%">LR No.</th>
                  <th class="text-center" width="4%">LR Date</th>
                  <th class="text-center" width="5%">DO NO.</th>
                  <th class="text-center" width="5%">Wagon No</th>
                  <th class="text-center" width="4%">Invoice No</th>
                  <th class="text-center" width="4%">Vehicle No</th>
                  <th class="text-center" width="5%">To Place</th>
                  <th class="text-center" width="4%">LR-Qty</th>
                  <th class="text-center" width="4%">Ack-Qty </th>
                  <th class="text-center" width="4%">FRT-Rate </th>
                  <th class="text-center" width="4%">Freight Amt. </th>
                </tr>

              </thead>

              <tbody id="defualtSearch">

              </tbody>

            </table>

          </div>

          <div class="row" style="margin-top: 1.5%">

            <div class="col-md-4"> </div>

            <div class="col-md-4" style="text-align: center;"> 
              

              <button type="button" name="submit" value="submit" id="submitinsalebill" onclick="submitAllData(0)" class='btn btn-primary' disabled style="width: 30%;">&nbsp;Save&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button> 

              <button class="btn btn-warning" type="button" onClick="window.location.reload();" id="submitNDown1" style="width: 30%;" disabled><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reload</button>

              <input type="hidden" id="donwloadStatus" name="donwloadStatus" value="">
            </div>  

            <div class="col-md-4">
              <div style="text-align: end;margin-top: 15px;font-size: 17px;font-weight: 700;margin-right: 7%;" id="freightTotAmt"> </div>
            </div>
            
          </div>

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


<!--  START : TAX-CODE MESSAGE ON SEARCH BUTTON CLICK -->

    <div id="showMessageOfTaxCode" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-md" style="margin-top: 6%;">
            <div class="modal-content" style="border-radius: 5px;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                <div class="modal-body" id="taxCodeMsgBody">
                 
                </div>
                <div class="modal-footer" style="text-align:center;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel &nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-primary" id="proceedBtnModal" data-dismiss="modal" >Proceed &nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>

<!--  END : TAX-CODE MESSAGE ON SEARCH BUTTON CLICK -->


<!-- Show Bill No Modal  -->

<style>
  .modal-body {
      position: relative !important;
      padding: 25px !important;
  }
</style>

<!-- Modal -->
<div class="modal fade" id="chkBillNoModal" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="chkBillNoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="text-align: center;">
        <div class="modal-title" id="chkBillNoModalLabel" style="font-size: 16px;font-weight: 600;">Check Bill No : </div>
      </div>
      <div class="modal-body">
        <div id="showBillNo"></div>
      </div>
      <div class="modal-footer" style="text-align: center;">
        <button type="button" class="btn btn-primary" style="padding: 1px 40px;" onClick="checkBillOkBtn()">&nbsp;&nbsp;OK&nbsp;&nbsp;</button>
      </div>
    </div>
  </div>
</div>


<!-- ./ Show Bill No Modal  -->

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

    var itemcd = $('#itemCodeId').val();
    
     var xyz = $('#itemCodeList option').filter(function() {

    return this.value == itemcd;

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
      $('#series_code').prop('readonly',false);
      $('#series_code').css('border-color','#ff0000').focus();
    }else{

        $('#series_code').css('border-color','#d4d4d4');
        $('#plantCodeId').css('border-color','#ff0000').focus();
        $('#series_code').prop('readonly',true);

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



/* -------- START: DATA-TABLE ----------- */


  $(document).ready(function(){


         var creditAmount = 0;
         var grandAmt = 0;
         

        $('#saleBillManage').DataTable();

        $("#saleBillManage").on('change', function() {

          var creditAmount = 0;
          var grandAmt = 0;
          var freightTotAmt = 0;

            
          var checkedCount      = $("#saleBillManage input:checked").length;
          var checkedDeliveryNo = $("#saleBillManage input:checked").attr('data-id');

          var table = $('#saleBillManage').DataTable();
          var table_length = table.data().length;

          var checkitm = [];

          $('.pb_checkitm').each(function(){

            var checkitm = [];

              if($(this).is(":checked")){

               var itmchk = $(this).attr('data-id');
               
               checkitm.push(itmchk);
               
              }
          });

          


          if(checkedCount > 0){

            $('#checkBoxCount').val(checkedCount);

            $("#submitinsalebill").prop('disabled',false);
            $("#submitNDown").prop('disabled',false);

          }else{

            $('#checkBoxCount').val('');

            $("#submitinsalebill").prop('disabled',true);
            $("#submitNDown").prop('disabled',true);

          }

          for(var e=0;e<checkedCount;e++){
             freightTotAmt += parseFloat($("#saleBillManage input:checked")[e].parentNode.parentNode.children[14].innerHTML);
            
          }
          $('#freightTotAmt').html('Bill Amount : '+freightTotAmt.toFixed(2));
        
        });



    }); 


  function load_data(vrDateId='',series_code='',plant_code='',tranType='',accountCode='',AccountText='',from_date='',to_date='',deliveryNo='',wagonNo='',lrNo='',vehicleNo='',plantCatg=''){

      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();


      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;

      $('#saleBillManage').DataTable({

          processing: true,
          serverSide: false,
          info: true,
          bPaginate: false,
          scrollY: 400,
          scrollX: false,
          scroller: true,
          fixedHeader: true,
          language: {
              processing: "<img src='<?php echo url('public/dist/img/Spinner.gif') ?>'>"
          },
          order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'SALE_BILL_LOGISTICS_'+getdate+'_'+gettime,
                        title: getcomName+'\n'+getFY+'\n'+' SALE BILL LOGISTICS',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
                        }
                      }

                    ],
          ajax:{
            url:'{{ url("/logistics/get-data-from-lr-onsalebill") }}',
            data: {vrDateId:vrDateId,series_code:series_code,plant_code:plant_code,tranType:tranType,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,deliveryNo:deliveryNo,wagonNo:wagonNo,lrNo:lrNo,vehicleNo:vehicleNo,plantCatg:plantCatg},
            method:"POST",
          },
          columns: [

            {
                data:'DT_RowIndex',
                'render': function (data, type, full, meta){

                  if (full['FSORATE']==0 || full['FSORATE']=='' || full['FSORATE']=='NULL' || full['FSORATE']==null) {

                    var disabledChkBx = 'disabled';

                  }else{

                    var disabledChkBx = '';
                  }

                  return '<input type="checkbox" '+disabledChkBx+' name="flit_id_'+full['SRNO']+'" class="pb_checkitm checkstyling valgetcls'+full['DELIVERY_NO']+'" data-id="'+full['DELIVERY_NO']+'" data-type="0" id="getRowCount'+full['DT_RowIndex']+'" value="'+full['DT_RowIndex']+'~'+full['HTRPHID']+'~'+full['TRIPBID']+'~'+full['PFCTCODE']+'~'+full['PFCTNAME']+'~'+full['VEHICLENO']+'~'+full['EBILL_NO']+'~'+full['EWAYB_VALIDDT']+'~'+full['ITEM_CODE']+'~'+full['ITEM_NAME']+'~'+full['REMARK']+'~'+full['TRANSPORTCODE']+'~'+full['TRANSPORTNAME']+'~'+full['LR_NO']+'~'+full['LR_DATE']+'~'+full['SRNO']+'~'+full['DELIVERY_NO']+'~'+full['DO_NO']+'~'+full['WAGON_NO']+'~'+full['WAGON_DATE']+'~'+full['QTY']+'~'+full['RECD_QTY']+'~'+full['NET_WEIGHT']+'~'+full['GROSS_WEIGHT']+'~'+full['FSORATE']+'~'+full['FSONO']+'~'+full['UM']+'~'+full['AUM']+'~'+full['FSORATE']+'~'+full['CP_CODE']+'~'+full['CP_NAME']+'~'+full['SP_CODE']+'~'+full['SP_NAME']+'~'+full['AQTY']+'~'+full['INVC_NO']+'~'+full['INVC_DATE']+'~'+full['ALIAS_ITEM_CODE']+'~'+full['ALIAS_ITEM_NAME']+'~'+full['FSOHID']+'~'+full['FSOBID']+'~'+full['SLNO']+'~'+full['FSOREFNO']+'~'+full['VEHICLETYPE']+'~'+full['DELIVERYDATE']+'~'+full['ACKDATE']+'~'+full['TOPLACE']+'~'+full['FROMPLACE']+'~'+full['TRIPDAY']+'~'+full['SHORTAGE_QTY']+'" onclick="checkBoxFun('+full['DT_RowIndex']+')"><input type="hidden" id="isChkChecked'+full['DT_RowIndex']+'" value="NO">';

                },
                className:'text-center'
            },
            { 
              data:'SRNO',
              'render': function (data, type, full, meta){

                  var srno = full['SRNO'];
                  
                  return srno+'<input type="hidden" id="getSlNo'+full['DT_RowIndex']+'" name="slno[]" value="'+full['SRNO']+'">';
                },
                className:'text-right'
            },
            {
              data:'DELIVERY_NO',
              'render': function (data, type, full, meta){

                  var DELIVERYNO = full['DELIVERY_NO'];
                  
                  return DELIVERYNO+'<input type="hidden" name="deliveryNo[]" id="getDeliveryNo'+full['DT_RowIndex']+'" value="'+full['DELIVERY_NO']+'">';
                },
                className:'text-right'
            },
            {
              data:'LR_NO',
              'render': function (data, type, full, meta){

                  var LRNO = full['LR_NO'];
                  
                  return LRNO+'<input type="hidden" name="lrNo[]" id="getLrNo'+full['DT_RowIndex']+'" value="'+full['LR_NO']+'">';
                },
              className:'text-left'
            },
            {
              data:'LR_DATE',
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
              data:'DO_NO',
              'render': function (data, type, full, meta){

                  var DONO = full['DO_NO'];
                  
                  return DONO+'<input type="hidden" name="doNo[]" id="getDoNo'+full['DT_RowIndex']+'" value="'+full['DO_NO']+'">';
                },
              className:'text-right'
            },
            {
              data:'WAGON_NO',
              'render': function (data, type, full, meta){

                  var WAGONNO = full['WAGON_NO'];
                  
                  return WAGONNO+'<input type="hidden" name="wagonNo[]" id="getWagonNo'+full['DT_RowIndex']+'" value="'+full['WAGON_NO']+'">';
              },
              className:'text-left'
            },
            {
              data:'INVC_NO',
              'render': function (data, type, full, meta){

                  var INVCNO = full['INVC_NO'];
                  
                  return INVCNO+'<input type="hidden" name="invNo[]" id="invNo'+full['DT_RowIndex']+'" value="'+full['INVC_NO']+'">';
              },
              className:'text-right'
            },
            {
              data:'VEHICLENO',
              'render': function (data, type, full, meta){

                  var VEHICLENO = full['VEHICLENO'];
                  
                  return VEHICLENO+'<input type="hidden" name="vehicleNo[]" id="getVehicleNo'+full['DT_RowIndex']+'" value="'+full['VEHICLENO']+'">';
              },
              className:'text-left'
            },
            {
              data:'TOPLACE',
              'render': function (data, type, full, meta){

                  var TOPLACE = full['TOPLACE'];
                  
                  return TOPLACE+'<input type="hidden" name="toPlace[]" id="toPlace'+full['DT_RowIndex']+'" value="'+full['TOPLACE']+'">';
              },
              className:'text-left'
            },
            {
              data:'NET_WEIGHT',
              'render': function (data, type, full, meta){

                  var GETQTY = full['NET_WEIGHT'];
                  
                  return GETQTY+'<input type="hidden" name="qty[]" id="getQty'+full['DT_RowIndex']+'" value="'+full['NET_WEIGHT']+'">';
              },
              className:'text-right'
            },
            {
              data:'RECD_QTY',
              'render': function (data, type, full, meta){

                  var RECDQTY = full['RECD_QTY'];
                  
                  return RECDQTY+'<input type="hidden" name="recQty[]" id="getRecdQty'+full['DT_RowIndex']+'" value="'+full['RECD_QTY']+'">';
              },
              className:'text-right'
            },
            {
              render: function (data, type, full, meta) {
                  var FSORATE = full['FSORATE'];

                  var FSORATE = full['FSORATE'];
                  var QTY = full['NET_WEIGHT'];
                  var finalQty = FSORATE*QTY;
                  var newQty = finalQty.toFixed(2); 
                
                  return FSORATE+'<input type="hidden" name="fsoRate[]" id="getFsoRate'+full['DT_RowIndex']+'" value="'+full['FSORATE']+'"><input type="hidden" name="fsoQty[]" id="getFsoQty'+full['DT_RowIndex']+'" value="'+newQty+'">'; 
              },
              className:'text-right'
            },
            {
              render: function (data, type, full, meta) {

                  var FSORATE = full['FSORATE'];
                  var QTY = full['NET_WEIGHT'];
                  var finalQty = FSORATE*QTY;
                  var newQty = finalQty.toFixed(2); 

                  return newQty;
              },
              className:'text-right'
            }
  

          ],

          "fnRowCallback": function(nRow, aData,data, type, full, meta) {

              
              if (aData['FSORATE']==0 || aData['FSORATE']=='' || aData['FSORATE']=='NULL' || aData['FSORATE']==null) {

                $('td', nRow).css('color', '#f75656');

                var mfso = 'true';

                $('#headNoteInp').val(mfso);

              }else{
                
                /* ~~~~ Do Nothing ~~~~ */
              }

              var fsoRateArr = $('#headNoteInp').val();

              if (fsoRateArr == 'true') {

                $('#noteId').removeClass('noteClass');

              }else{

                $('#noteId').addClass('noteClass');

              }

          }

      });

    }

    function checkBoxFun(sl_No){

      var chkval = $("#isChkChecked"+sl_No).val();
     
      if(chkval == 'NO') {
        
        var ordrNo = $('#getDeliveryNo'+sl_No).val();

        var table = $('#saleBillManage').DataTable();
        var table_length = table.data().length;

        for(var r=0;r<table_length;r++){

          var slno = parseInt(r) + parseInt(1);

          var newDelNo = $("#getRowCount"+slno).attr('data-id');
          
          if(ordrNo == newDelNo){
            $('#getRowCount'+slno).prop("checked", true);
            $("#isChkChecked"+slno).val('YES');
            $("#getRowCount"+slno).attr('data-type',sl_No);
          }

        }

      }else{

        var ordrNo = $('#getDeliveryNo'+sl_No).val();

        var table = $('#saleBillManage').DataTable();
        var table_length = table.data().length;

        for(var r=0;r<table_length;r++){

          var slno = parseInt(r) + parseInt(1);

          var newDelNo = $("#getRowCount"+slno).attr('data-id');
          
          if(ordrNo == newDelNo){
            $('#getRowCount'+slno).prop("checked", false);
            $("#isChkChecked"+slno).val('NO');
            $("#getRowCount"+slno).attr('data-type','0');
          }

        }
      }
      
    }
/* -------- END: DATA-TABLE ----------- */



/* -------- START : SEARCH BTN CLICK ----------- */

  $(document).ready(function(){

    $('#proceedBtnModal').click(function(){

      var vrDateId    =  $('#vrDateId').val();
      var series_code =  $('#series_code').val();
      var plant_code  =  $('#plantCodeId').val();
      var tranType    =  $('#tranTypeId').val();
      var accountCode =  $('#account_code').val();
      var AccountText =  $('#AccountText').val();
      var from_date   =  $('#from_date').val();
      var to_date     =  $('#to_date').val();
      var deliveryNo  =  $('#deliveryNoId').val();
      var wagonNo     =  $('#wagonNoId').val();
      var lrNo        =  $('#lrNoId').val();
      var vehicleNo   =  $('#vehicleNoId').val();
      var itemCode    =  $('#itemCodeId').val();
      var cityCodeName=  $('#cityCodeName').val();
      var accAddr     =  $('#accAddrID').val();
      var taxCode     =  $('#taxCodeID').val();


      load_data(vrDateId,series_code,plant_code,tranType,accountCode,AccountText,from_date,to_date,deliveryNo,wagonNo,lrNo,vehicleNo);

      $('#vrDateId,#series_code,#plantCodeId,#tranTypeId,#account_code,#AccountText,#itemCodeId,#from_date,#to_date,#deliveryNoId,#wagonNoId,#lrNoId,#vehicleNoId,#accAddrID,#taxCodeID').prop('disabled',true);


    });

    $('#btnsearch').click(function(){
        
        var vrDateId    =  $('#vrDateId').val();
        var series_code =  $('#series_code').val();
        var plant_code  =  $('#plantCodeId').val();
        var tranType    =  $('#tranTypeId').val();
        var accountCode =  $('#account_code').val();
        var AccountText =  $('#AccountText').val();
        var from_date   =  $('#from_date').val();
        var to_date     =  $('#to_date').val();
        var deliveryNo  =  $('#deliveryNoId').val();
        var wagonNo     =  $('#wagonNoId').val();
        var lrNo        =  $('#lrNoId').val();
        var vehicleNo   =  $('#vehicleNoId').val();
        var itemCode    =  $('#itemCodeId').val();
        var cityCodeName=  $('#cityCodeName').val();
        var accAddr     =  $('#accAddrID').val();
        var taxCode     =  $('#taxCodeID').val();
        var plantCatg   =  $('#plantCatgId').val();

        if(series_code!=''){
          $('#showSeriesErr').html('');
          if(plant_code!=''){
            $('#plantcode_err').html('');
            if(itemCode !=''){
               $('#shwoErrItemCode').html('');
                if(tranType!=''){
                  $('#shwoErrTranCode').html('');
                  if(accountCode !=''){
                     $('#shwoErrAccCode').html('');
                    if(accAddr !=''){
                       $('#shwoErrAccAddr').html('');
                      if(taxCode !=''){
                        $('#shwoErrTaxCode').html('');
                        $('#saleBillManage').DataTable().destroy();

                  /* --------- START : ON Search Btn Click Check Tax Code -------*/


                        $.ajaxSetup({

                          headers: {

                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                          }

                        });

                        $.ajax({

                            url:"{{ url('/logistics/check-stateOn-search-btn') }}",

                            method : "POST",

                            type: "JSON",

                            data: {accState:cityCodeName,plant_code:plant_code,taxCode:taxCode},
                            beforeSend: function() {
                              console.log('start spinner');
                                  $('.modalspinner').removeClass('hideloaderOnModl');
                            },

                            success:function(data){

                              var data1 = JSON.parse(data);

                              if (data1.response == 'error') {

                                console.log('error',data1.get_arr);
                                console.log('error',data1.search_arr);

                                if (data1.get_arr=='NOT-FOUND') {

                                 $('#showMessageOfTaxCode').modal('show');

                                  $('#taxCodeMsgBody').html('<span style="font-size:14px;font-weight:600;line-height: 1.5;"> <i class="fa fa-caret-right" aria-hidden="true"></i> Please Check Tax Code...! Plant State and Account State is Same and Your are Applied <span style="color:red;">'+taxCode+'</span> Tax Code. </span>');

                                }else if(data1.get_arr=='DATA-NOT-FOUND'){

                                  $('#showMessageOfTaxCode').modal('show');

                                  $('#taxCodeMsgBody').html('<span style="font-size:14px;font-weight:600;"> <i class="fa fa-caret-right" aria-hidden="true"></i> Please Check Yor Data...! </span>');

                                }else{

                                  $('#showMessageOfTaxCode').modal('show');

                                  $('#taxCodeMsgBody').html('<span style="font-size:14px;font-weight:600;"> <i class="fa fa-caret-right" aria-hidden="true"></i> AJAX is not working...! Please Check Your Code...! </span>');

                                }

                              }else if(data1.response == 'success'){

                                console.log('succe',data1.get_arr);

                                if (data1.get_arr != 'FOUND') {

                                  $('#showMessageOfTaxCode').modal('show');

                                  $('#taxCodeMsgBody').html('<span style="font-size:14px;font-weight:600;"> <i class="fa fa-caret-right" aria-hidden="true"></i> Please Check Your Code...! </span>');

                                }else{


                                  load_data(vrDateId,series_code,plant_code,tranType,accountCode,AccountText,from_date,to_date,deliveryNo,wagonNo,lrNo,vehicleNo,plantCatg);

                                  $('#vrDateId,#series_code,#plantCodeId,#tranTypeId,#account_code,#AccountText,#itemCodeId,#from_date,#to_date,#deliveryNoId,#wagonNoId,#lrNoId,#vehicleNoId,#accAddrID,#taxCodeID').prop('disabled',true);

                                }

                              
                              }else{
                               
                              }

                            },
                            complete: function() {
                               console.log('end spinner');
                                 $('.modalspinner').addClass('hideloaderOnModl');
                            },
                        });


                  /* --------- END : ON Search Btn Click Check Tax Code -------*/

                       

                      }else{
                        $('#shwoErrTaxCode').html('*The Account Address field is required.');
                      }

                    }else{
                      $('#shwoErrAccAddr').html('*The Account Address field is required.');
                    }

                  }else{
                    $('#shwoErrAccCode').html('*The Account Code field is required.');
                  }

                }else{
                    $('#shwoErrTranCode').html('*The T-Code field is required.');
                }

            }else{
              $('#shwoErrItemCode').html('*The Item Code field is required.');
            }

          }else{
            $('#plantcode_err').html('*The Plant Code field is required.');
          }

        }else{
          $('#showSeriesErr').html('*The Series Code field is required.');
          
        }
        
    });

  });

  /* -------- END : SEARCH BTN CLICK ----------- */




  /* -------- START : SAVE BTN CLICK ----------- */
    
  function submitAllData(valD){

    var downloadFlg = valD;
    $('#donwloadStatus').val(downloadFlg);

    //alert(downloadFlg);return false;
    
      var checkboxcount = $('input[type="checkbox"]:checked').length;
      
      if(checkboxcount > 0){

        $('#checkBoxSelectMsg').html('');

          var checkitm          = [];
          var checkattr         = [];

          $('.pb_checkitm').each(function(){

              if($(this).is(":checked")){
                
               var itmchk  = $(this).val();
               var attrchk = $(this).attr('data-type');
               checkitm.push(itmchk);
               checkattr.push(attrchk);
               
              }
          });

          var VRDATE     = $('#vrDateId').val();
          var TCODE      = $('#transcode').val();
          var SERIESCODE = $('#series_code').val();
          var PLANTCODE  = $('#plantCodeId').val();
          var PLANTCATG  = $('#plantCatgId').val();
          var TRANTYPE   = $('#tranTypeId').val();
          var ACCCODE    = $('#account_code').val();
          var ACCNAME    = $('#AccountText').val();
          var FROMDATE   = $('#from_date').val();
          var TODATE     = $('#to_date').val();
          var DELIVERYNO = $('#deliveryNoId').val();
          var WAGONNO    = $('#wagonNoId').val();
          var LRNO       = $('#lrNoId').val();
          var VEHICLENO  = $('#vehicleNoId').val();
          var ITEMCODE   = $('#itemCodeId').val();
          var ITEMNAME   = $('#itemNameId').val();
          var TAXCODE    = $('#taxCodeID').val();
          var CITYCODENAME = $('#cityCodeName').val();
          var rowCount   = $('#checkBoxCount').val();
         

          //console.log('count ',rowCount);
          //console.log('checkitm => ',checkitm);
          //console.log('attr => ',checkattr);

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

          });

          $.ajax({

              url:"{{ url('/logistics/save-sale-bill-logistics') }}",

              method : "POST",

              type: "JSON",

              data: {checkitm:checkitm,VRDATE:VRDATE,TCODE:TCODE,SERIESCODE:SERIESCODE,PLANTCODE:PLANTCODE,PLANTCATG:PLANTCATG,TRANTYPE:TRANTYPE,ACCCODE:ACCCODE,ACCNAME:ACCNAME,FROMDATE:FROMDATE,TODATE:TODATE,DELIVERYNO:DELIVERYNO,WAGONNO:WAGONNO,LRNO:LRNO,VEHICLENO:VEHICLENO,ITEMCODE:ITEMCODE,ITEMNAME:ITEMNAME,TAXCODE:TAXCODE,CITYCODENAME:CITYCODENAME,rowCount:rowCount,checkattr:checkattr},

              success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  var responseVar = false;
                  console.log('res if',responseVar);
                  var url = "{{url('/logistics/temp-sale-bill-logistics-save')}}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{
                  
                  var responseVar = true;
                  var link = document.createElement('a');
                  var filePath = data1.file_path;
                  var fileName = data1.file_name;
                  var tempBillNo = data1.temp_bill_no;
                  var fileNameLen = data1.file_name.length;

                  console.log('bill no ',tempBillNo);

                  var countFileName = fileNameLen - 1;
                  var chekYesNo = '';
                  $.each(fileName, function(k, getFileName){

                    var fileNewPath = filePath+'/'+getFileName

                    var url1 = "{{url('/')}}"+'/'+fileNewPath;
                    link.href = url1;
                    link.download = getFileName;
                    link.dispatchEvent(new MouseEvent('click'));

                    /*var object = new ActiveXObject("Scripting.FileSystemObject");
                     var file = object.GetFile(url1);
                     file.Move("F:\\ERP-FILE\\");*/

                  });

                  if (tempBillNo=='') {

                    $('#chkBillNoModal').modal('hide');
                    console.log('bill not found');

                  }else{
                   
                    $('#showBillNo').html('<b>Provisional Bill No :- </b><span> '+tempBillNo+' <span>');
                    $('#chkBillNoModal').modal('show');

                  }

                  $('.overlay-spinner').removeClass('hideloader');

                    /*setTimeout(function () {
                      
                      $('.overlay-spinner').addClass('hideloader');
                      var url = "{{url('/logistics/temp-sale-bill-logistics-save')}}"
                     setTimeout(function(){ window.location = url+'/'+responseVar+'/'+responseVar; });

                    }, 2000);*/


                }

              }
          });


        }else{

          $('#checkBoxSelectMsg').html('Must Be Select At Least One checkbox.');

        }
  }


/* -------- END : SAVE BTN CLICK ----------- */


/* ................. CHECK BILL NO OK BTN ............. */
  
  function checkBillOkBtn(){

    var responseVar = true;

    setTimeout(function () {
                      
      $('.overlay-spinner').addClass('hideloader');
      var url = "{{url('/logistics/temp-sale-bill-logistics-save')}}"
     setTimeout(function(){ window.location = url+'/'+responseVar; });

    }, 500);


  }




/* ................. ./ CHECK BILL NO OK BTN ............. */


/* -------- START : GET-ACC NAME ON ACC CHANGE ----------- */

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

/* -------- END : GET-ACC NAME ON ACC CHANGE ----------- */



/* -------- START : GET-CITY FROM ACC ADDRESS ----------- */

  $("#accAddrID").bind('change', function () {  

    var accAddrID = $('#accAddrID').val();
    var xyz = $('#accAddrList option').filter(function() {

    return this.value;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    var exp = msg.split('~');
    
    $("#cityCodeName").val(msg);

       
  });


/* -------- END : GET-CITY FROM ACC ADDRESS ----------- */




/* -------- START : GET-ITEM NAME ON ITEM CHANGE ----------- */

  $("#itemCodeId").bind('change', function () {  

    var item_code = $('#itemCodeId').val();

    console.log('codei',item_code);

    var xyz = $('#itemCodeList option').filter(function() {

    return this.value == item_code;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    console.log('item',msg);

        if(msg == 'No Match'){
          $('#itemNameId').val('');
        }else{
          $('#itemNameId').val(msg);
        }

  });

/* -------- END : GET-ITEM NAME ON ITEM CHANGE ----------- */



/* ------ START : CHECK BOX CLICK ------*/


    $("#all_checkbox").click(function(){
        if(this.checked){
            $('.pb_checkitm').each(function(){
                this.checked = true;
            });
            $('#submitinsalebill').prop('disabled',false);
            $('#submitNDown').prop('disabled',false);
            $('#simulationbtn').prop('disabled',false);
            $('#CalcTaxinDif1').prop('disabled',false);
            $('#settextfot').removeClass('texttotal');
        }else{
             $('.pb_checkitm').each(function(){
                this.checked = false;
              });
             $('#submitinsalebill').prop('disabled',true);
             $('#submitNDown').prop('disabled',true);
             $('#simulationbtn').prop('disabled',true);
             $('#CalcTaxinDif1').prop('disabled',true);
             $('#settextfot').addClass('texttotal');
        }

        var checkedCount = $("#saleBillManage input:checked").length;

        var creditAmount = 0;
        var grandAmt = 0;

        if(checkedCount > 0){

          $("#simulationbtn").prop('disabled',false);
          $("#submitinsalebill").prop('disabled',false);
          $("#submitNDown").prop('disabled',false);
          $("#CalcTaxinDif1").prop('disabled',false);
          $('#settextfot').removeClass('texttotal');
        }else{
          $("#simulationbtn").prop('disabled',true);
          $("#submitinsalebill").prop('disabled',true);
          $("#submitNDown").prop('disabled',true);
          $("#CalcTaxinDif1").prop('disabled',true);
          $('#settextfot').addClass('texttotal');
        }
        for (var i = 0; i < checkedCount; i++) {
          var ii= i+1;
          var amount = $("#saleBillManage input:checked")[i].parentNode.parentNode.children[10].innerHTML;

          var gr_amount = $("#saleBillManage input:checked")[i].parentNode.parentNode.children[12].innerHTML;


          if (amount != "") {
            creditAmount += parseFloat(amount);
          } else {
            creditAmount = 0;
          }

          if (gr_amount !="") {
            grandAmt += parseFloat(gr_amount);
          } else {
            grandAmt = 0;
          }

          $("#netAmt").text(grandAmt.toFixed(2));
          $("#netAmount").val(grandAmt.toFixed(2));
          $("#basicTotalAmt").text(creditAmount.toFixed(2));
        }


    });




/* ------ START : CHECK BOX CLICK ------*/
  
</script>

@endsection