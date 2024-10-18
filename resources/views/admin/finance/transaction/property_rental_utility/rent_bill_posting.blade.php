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

    text-align: center !important;

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
        Rent Bill Posting
        <small> : Add Details</small>
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
          <a href="{{ url('/transaction/property-rental-utility/rent-bill-posting') }}">  Rent Bill Posting </a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Rent Bill Posting </h2>

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

                  <label for="exampleInputEmail1">Vr Date: </label>

                  <div class="input-group">
                        <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                      <?php 

                        $CurrentDate =date("d-m-Y");
                           
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

                      <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                      <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                      <input type="text" class="form-control transdatepicker rightcontent" name="vr" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

                  </div>

                  <small id="show_err_vrDt" style="color:red;"></small>

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

              <div class="col-md-2">

                <div class="form-group">

                  <label>PFCT Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="pfctList"  id="pfctCodeId" onchange="getNameofPfctCode()" name="pfctCode"  class="form-control  pull-left" placeholder="Select Plant"  value="{{ old('pfctCode')}}" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="pfctList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($pfctlist as $key)

                        <option value='<?php echo $key->PFCT_CODE?>'   data-xyz ="<?php echo $key->PFCT_NAME; ?>" ><?php echo $key->PFCT_NAME ; echo " [".$key->PFCT_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                    <input type="hidden" name="pfctState" id="pfctStateId" value="" />

                    <small id="pfctcode_err" style="color: red;" class="form-text text-muted"> </small>

                    <small id="showpfctErr" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>PFCT Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text"  id="pfctNameId" name="pfctName"  class="form-control  pull-left" placeholder="Select Plant"  value="{{ old('pfctName')}}" oninput="this.value = this.value.toUpperCase()" readonly  autocomplete="off">

                  
                    </div>
                 
                    <small id="showplantErr" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

            </div> <!-- /.row -->

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label>Acc Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="AccountList"  id="account_code" onchange="getOtherDataFromAccCode(this.value)" name="AccCode" class="form-control  pull-left" value="{{ old('AccCode')}}" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="AccountList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($schbill_acc_list as $key)

                        <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                        @endforeach

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

                  <label>Account Address : <span class="required-field"></span></label>

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

              <div class="col-md-2">

                <div class="form-group">

                  <label>Sale Order No : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                      <input list="orderNoList" onchange="getItemCodeOnOrderNo(this.value)"  id="orderNo" name="orderNo" class="form-control  pull-left" value="{{ old('orderNo')}}" placeholder="Select Order No" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="orderNoList">

                        <option selected="selected" value="">-- Select --</option>

                      </datalist>

                    </div>
                 
                    <small id="shwoErrOrderNo" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

            </div> <!-- /.row -->

            <div class="row">
              
              <div class="col-md-3">

                <div class="form-group">

                  <label>Item Code/Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                      <input type="text"  id="itemCdNmId" name="itemCdNm" class="form-control  pull-left" value="{{ old('itemCdNm')}}" autocomplete="off" readonly>

                    </div>
                 
                    <small id="shwoErrItemCdNm" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

            </div>
            
          
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
          
            
        </div><!-- /.box-body -->


        <div class="box-body">

          <form id="rentBillPostingForm">
            @csrf

          <table id="saleBillManage" style="width:100%" class="table table-bordered table-striped table-hover billgenerate">

            <thead class="theadC">

              <tr>

                <th class="text-center" width="5%" style="text-align: left;">#</th>
                <th class="text-center" width="15%">Schedule Date</th>
                <th class="text-center" width="15%">Schedule Amount</th>
                <th class="text-center" width="55%">Particular</th>
               
              </tr>

            </thead>

            <tbody id="defualtSearch">

            </tbody>

          </table>


    <!-- ~~~~~~~~~ Start : head fields data ~~~~~~~~~~~~ -->

     <input type="hidden" name="hidVrDate" value="" id="hidVrDateId" />
     <input type="hidden" name="hidTcode" value="" id="hidTcodeId" />
     <input type="hidden" name="hidSeriesCode" value="" id="hidSeriesCodeId" />
     <input type="hidden" name="hidPfctCode" value="" id="hidPfctCodeId" />
     <input type="hidden" name="hidPfctName" value="" id="hidPfctNmId" />
     <input type="hidden" name="hidAccCode" value="" id="hidAccCodeId" />
     <input type="hidden" name="hidAccNm" value="" id="hidAccNmId" />
     <input type="hidden" name="hidTaxCode" value="" id="hidTaxCdId" />
     <input type="hidden" name="hidOrderNo" value="" id="hidOrderNoId" />
     <input type="hidden" name="hidItemCdNm" value="" id="hidItemCdNmId" />
     <input type="hidden" name="hidCheckBoxCount" id="checkBoxCount" value=""/>
     <input type="hidden" name="hidSeriesGlCd" id="hidSeriesGlCdId" value=""/>
     <input type="hidden" name="hidSeriesGlNm" id="hidSeriesGlNmId" value=""/>
     <input type="hidden" name="hidAccGl" id="accGlCd" value=""/>
     <input type="hidden" name="hidAccGlNm" id="accGlNm" value=""/>
     <input type="hidden" name="hidAllTaxRowCnt" id="allgetTaxRowCount" value=""/>

    <!-- ~~~~~~~~~ End : head fields data ~~~~~~~~~~~~ -->



  <!-- ~~~~~~ START : BASIC / OTHER / GRAND TOTAL SECTION ~~~~~~~~~ -->

             <div class="row" style="display: flex;">

                  <div class="col-md-9"></div>

                  <div class="col-md-1 toalvaldesn" style="text-align: right;">

                    <div class="totlsetinres basicOtherGrandStyle">Basic Total :</div>

                  </div>

                  <div class="col-md-2">
                    <input type="hidden" id="allgetMCount" name="getdatacount">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalBasciAmt" value="" style="text-align:right;" id="basicTotal" readonly="" style="margin-top: 3px;">
                  </div>

              </div>

              <div class="row" style="display: flex;">

                  <div class="col-md-9"></div>

                    <div class="col-md-1 toalvaldesn" style="text-align: right;">

                    <div class="totlsetinres basicOtherGrandStyle">Other Total :</div>

                  </div>

                  <div class="col-md-2">

                    <input class="credittotldesn inputboxclr" type="text" name="TotalOtherAmt" value="" id="otherTotalAmt" readonly="" style="margin-top: 3px;text-align:right;">

                  </div>

              </div>

              <div class="row" style="display: flex;">

                  <div class="col-md-9"></div>

                    <div class="col-md-1 toalvaldesn" style="text-align: right;">

                    <div class="totlsetinres basicOtherGrandStyle">Grand Total :</div>

                  </div>

                  <div class="col-md-2">

                    <input class="credittotldesn inputboxclr" type="text" name="TotalGrandAmt" value="" id="allgrandAmt" readonly="" style="margin-top: 3px;text-align:right;">

                  </div>

              </div>

  <!-- ~~~~~~ END : BASIC / OTHER / GRAND TOTAL SECTION ~~~~~~~~~ -->


          <div style="text-align: center;">

            <button class="btn btn-success" type="button" onClick="simulationFinalSaleBill()" id="simulation"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Simulation</button>

           <button class="btn btn-success" type="button" onClick="window.location.reload();" id="submitNDown1" disabled><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reload</button>

            <button type="button" name="submit" value="submit" id="submitdata" onclick="submitAllData(0)" class='btn btn-primary' disabled style="width: 16%;">&nbsp;Save&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button> 


          </div>
           </form>

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

<!-- ------- SHOW MODAL FOR SIMULATION ------ -->
  
    <div class="modal fade in" id="simulationModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">

      <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">

        <div class="modal-content" style="border-radius: 5px;">

          <div class="modal-header">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <h5 class="modal-title modltitletext" id="exampleModalLabel">Simulation Of Sales Bill ( Final )</h5>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>

          <div class="modal-body table-responsive">
            <div class="boxer" id="sim_body_data" style="font-size: 12px;color: #000;width:100%;">
            </div>
          </div>

          <div class="modal-footer">
              <span id="siml_footer1" style="width: 10px;"><button type="button" class="btn btn-primary " style="width: 10%;" data-dismiss="modal">Ok</button></span>
          </div>

        </div>

      </div>

    </div>

<!-- ------- SHOW MODAL FOR SIMULATION ------ -->


@include('admin.include.footer')

<!-- <script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script> -->
<script src="{{ URL::asset('public/dist/js/viewjs/commonJsFun.js') }}" ></script>

<script type="text/javascript">

  function simulationFinalSaleBill(){

     $('#simulationModel').modal('show');

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
      });

      var account_code     = $("#account_code").val();
      var account_name     = $("#AccountText").val();
      var allTaxRwCnt      = $("#allgetTaxRowCount").val();
      var accGlCd          = $("#accGlCd").val();
      var seriesGlCd       = $("#hidSeriesGlCdId").val();
      var grandTotalAmt    = $("#allgrandAmt").val();
      var tax_indictorCode = [];
      var tax_rate_ind     = [];
      var tax_GlCode       = [];
      var tax_amount       = [];

      $('input[name^="taxIndCode"]').each(function (){
                    
            tax_indictorCode.push($(this).val());

      });

      $('input[name^="rate_ind"]').each(function (){
                    
            tax_rate_ind.push($(this).val());

      });

      $('input[name^="taxGlCode"]').each(function (){
                    
            tax_GlCode.push($(this).val());

      });

      $('input[name^="amount"]').each(function (){
                    
            tax_amount.push($(this).val());

      });

      //console.log('tax_GlCode',tax_GlCode);
      //return false;

      $.ajax({

            url:"{{ url('get-simulation-data-for-final-sale-bill-logistic') }}",
            method : "POST",
            type: "JSON",
            data: {allTaxRwCnt:allTaxRwCnt,accGlCd:accGlCd,seriesGlCd:seriesGlCd,tax_indictorCode:tax_indictorCode,tax_rate_ind:tax_rate_ind,tax_GlCode:tax_GlCode,tax_amount:tax_amount,grandTotalAmt:grandTotalAmt},
            success:function(data){

              var data1 = JSON.parse(data);
                  
              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                if(data1.data_sim==''){

                }else{
                  var srno = 1;
                  $('#sim_body_data').empty();

                  var headData = "<div class='box-row' style='background-color: blanchedalmond;'><div class='box10 texIndbox'>Sr.No.</div><div class='box10 glCodeCl'>Gl/ Acc Code</div><div class='box10 rateIndbox'>Debit-DR</div><div class='box10 rateIndbox'>Credit-CR</div><div class='box10 glCodeCl'>Ref Code/Name</div></div>";

                  $('#sim_body_data').append(headData);
                  
                  $.each(data1.data_sim, function(k, getData) {

                    if(getData.IND_ACC_CODE){
                      var accGl = getData.IND_ACC_CODE;
                      var accglName = getData.accName;
                    }else if(getData.IND_GL_CODE){
                      var accGl = getData.IND_GL_CODE;
                      var accglName = getData.glName;
                    }else{
                      var accGl = '--';
                      var accglName = '--';

                    }
                   
                    var bodyData = "<div class='box-row'><div class='box10 texIndbox'>"+srno+"</div><div class='box10 glCodeCl'>"+accGl+" ( "+accglName+" )</div><div class='box10 amtRightAlign'>"+getData.DR_AMT+"</div><div class='box10 amtRightAlign'>"+getData.CR_AMT+"</div><div class='box10'>"+account_code+"( "+account_name+" )</div></div>";
                    $('#sim_body_data').append(bodyData);

                  srno++;});   /* ./ each*/

                }

              }/* /. success codn*/

            }/* /. success function*/

      }); //ajax close

  }

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

                  console.log('acc gl',data1.acc_detail_list[0].GL_CODE);

                  if(data1.acc_detail_list[0].GL_CODE == '' || data1.acc_detail_list[0].GL_CODE == 'NULL' || data1.acc_detail_list[0].GL_CODE=='null' || data1.acc_detail_list[0].GL_CODE==null){
                    $('#showallDataM').modal('show');
                    $('#messageShowBody').html('<span style="font-size:14px;font-weight:600;">Account GL Code Not Found...!</span>');
                    $('#accGlCd').val('');
                    $('#accGlNm').val('');
                    $('#account_code').val('');
                  }else{
                    $('#messageShowBody').html('');
                    $('#accGlCd').val(data1.acc_detail_list[0].GL_CODE);
                    $('#accGlNm').val(data1.acc_detail_list[0].GL_NAME);
                  }

              }

          }

    });


  }

/* -----END: DELIVERY_NO/WAGON_NO/LR_NO/VEHICLE_NO FROM ACC AND PLANT -----*/



/* ----- START : ITEM SELECT ON CAL-TAX -------------- */

   function selectitem(rowid,itmebyid){

    $("#yrOpQtyShModel"+rowid).modal({
        show:false,
        backdrop:'static',
      });

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var checkitmIsAval = $('#Item_CodeId'+rowid).val();

    if(checkitmIsAval == ''){

      var ind_value      = $("input[type='radio'][name='itemname']:checked").val();
      
      var res            = ind_value.split("_");
      
      var res1           = res[0];
      
      var res2           = res[1];
      
      var itemcode       = $('#itemcode_'+res1+'_'+res2).val();
      
      var item_Code      =  itemcode.split('(');
      
      var getitemCd      = item_Code[0];
      
      var cur_val        = $('#checkitm').val();
      
      var balencQtyByitm = $('#balence_qty_'+res1+'_'+res2).val();
      
      var sequnNo        = $('#vrno_'+res1+'_'+res2).val();
      
      var sc_rate        = $('#sc_rate_'+res1+'_'+res2).val();
      
      var scseries       = $('#scseries_'+res1+'_'+res2).val();
      var sctransc       = $('#sctran_'+res1+'_'+res2).val();
      var scslno         = $('#scslno_'+res1+'_'+res2).val();
      var scvrno         = $('#scvrno_'+res1+'_'+res2).val();
      var scbody         = $('#scbodyid_'+res1+'_'+res2).val();
      var schead         = $('#scheadid_'+res1+'_'+res2).val();
      var scitmdiscriptn = $('#scitmdisciptn_'+res1+'_'+res2).val();
      var tax_CodeI      = $('#taxCodeI_'+res1+'_'+res2).val();

      $('#tolranceshow'+rowid).removeClass('tolrancehide');
      var cnclbtn ='<input type="hidden" value="'+0+'" id="tolcvalue"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';
      $('#cancelbtolrntn'+rowid).html(cnclbtn);

      var cnclbtntax ='<input type="hidden" value="0" id="qltyvalue'+rowid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

    $('#cancelbtn'+rowid).html(cnclbtntax);

    var cnclbtnqp ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

    $('#cancelQpbtn'+rowid).html(cnclbtnqp);

      $('#Item_CodeId'+rowid).val(getitemCd);
      $('#itmC_code'+rowid).val(getitemCd);
      
      $('#selectItem'+rowid).val(getitemCd);

      if(scitmdiscriptn == '' || scitmdiscriptn == 'null' || scitmdiscriptn == null){
        $('#remark_data'+rowid).val('');
      }else{
        $('#remark_data'+rowid).val(scitmdiscriptn);
      }
      
      $('#idsun'+rowid).val(res1+'_'+res2);

      $('#rate'+rowid).val(sc_rate);
      $('#qnrate'+rowid).val(sc_rate);
      $('#qty'+rowid).val(balencQtyByitm);
      $('#balQtyByItem'+rowid).val(balencQtyByitm);
      $('#sc_transcode'+rowid).val(sctransc);
      $('#sc_seriescode'+rowid).val(scseries);
      $('#sc_vrno'+rowid).val(scvrno);
      $('#sc_slno'+rowid).val(scslno);
      $('#sc_headid'+rowid).val(schead);
      $('#sc_bodyid'+rowid).val(scbody);
      $('#taxByItem'+rowid).val(tax_CodeI);
      $('#viewItemDetail'+rowid).removeClass('showdetail');

      
      $('#qty'+rowid).prop('readonly',false);
      $('#rate'+rowid).prop('readonly',false);
      $('#CalcTax'+rowid).prop('readonly',false);

      $('#vr_date,#series_code_sale,#Plant_code_sale,#account_code_sale,#shipTAddrs,#sale_rep_code,#costCent_code_sale,#saleConNo,#party_rf_no,#party_ref_date,#trpt_code,#vehical_no,#lrNo,#eWayBilN').prop('readonly',true);

      $('#vr_date').datepicker("destroy");
      $('#party_ref_date').datepicker("destroy");

      var plantcode =  $('#Plant_code_sale').val();
      var splitp = plantcode.split('[');
      var plant_code = splitp[0];

      $.ajax({

        url:"{{ url('get-stock-opening-qty-by-item') }}",

        method : "POST",

        type: "JSON",

        data: {plant_code:plant_code,getitemCd:getitemCd},

        success:function(data){

          var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){
                console.log('data1.data_stockqty',data1.data_stockqty.YROPQTY);
                if(data1.data_stockqty == ''){

                }else{
                  var yrOpStockQty = parseFloat(data1.data_stockqty.YROPQTY) + parseFloat(data1.data_stockqty.YRQTRECD) - parseFloat(data1.data_stockqty.YRQTYISSUED);

                  $('#stockOpQty'+rowid).html('Stock : '+yrOpStockQty);
                  $('#stock_Qty'+rowid).val(yrOpStockQty);
                  

                  if(balencQtyByitm > yrOpStockQty){
                    $('#yrOpQtyShModel'+rowid).modal('show');
                    //$('#qty'+rowid).val('');
                    //$('#A_qty'+rowid).val('');
                  }else{}
                }


            }
        }

      });

      if(cur_val){
        
        var cur_val_new = $('#checkitm').val();

        if(cur_val_new){

          var exploitm =  cur_val_new.split(',');

          var itmpositn = exploitm.length;

            for(var t= 0;t<itmpositn;t++){
              var newitm = $('#Item_CodeId'+rowid).val();

              if(exploitm[t] == newitm){

                $('#Item_CodeId'+rowid).val('');
                $('#qty'+rowid).val('');
                $('#rate'+rowid).val('');
                $('#itmC_code'+rowid).val('');
                $('#selectItem'+rowid).val('');
                $('#remark_data'+rowid).val('');
                $('#idsun'+rowid).val('');
                $('#tolranceshow'+rowid).addClass('tolrancehide');
                $('#cancelbtolrntn'+rowid).css('display','none');
              }else{
                $('#checkitm').val(cur_val + "," + getitemCd);
                $('#vr_date,#series_code_sale,#Plant_code_sale,#account_code_sale,#shipTAddrs,#sale_rep_code,#costCent_code_sale,#saleConNo,#party_rf_no,#party_ref_date,#trpt_code,#vehical_no,#lrNo,#eWayBilN').prop('readonly',true);

                $('#vr_date').datepicker("destroy");
                $('#party_ref_date').datepicker("destroy");

              }
            }
        }

      }else{
        $('#checkitm').val(getitemCd);
      }

    } /* ./ if*/

  } /* ./ function */



/* ----- END : ITEM SELECT ON CAL-TAX -------------- */




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

    var seriesCode  = $('#series_code').val();
    var pfctCode    = $('#pfctCodeId').val();
    var accCode     = $('#account_code').val();
   
    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('/transaction/property-rental-utility/get-taxcode-onrent-bill-posting') }}",

          method : "POST",

          type: "JSON",

          data: {pfctCode:pfctCode,seriesCode:seriesCode,scode:scode,sname:sname,accCode:accCode},

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



/* ----- START: GET PFCT NAME FROM PLANT CODE -----*/

  function getNameofPfctCode(){

    var pfctCode   = $('#pfctCodeId').val();

    var xyz = $('#pfctList option').filter(function() {

    return this.value == pfctCode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';


    if(msg == 'No Match'){
      $('#pfctCodeId').val('');
      $('#showpfctErr').html(msg);
      $('#pfctCodeId').css('border-color','#ff0000').focus();
    }else{
      $('#pfctCodeId').css('border-color','#d4d4d4');
      $('#account_code').css('border-color','#ff0000').focus();
      $('#pfctNameId').val(msg);
      $('#showpfctErr').html('');
      
    }

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('/transaction/property-rental-utility/get-pfct-state') }}",

          method : "POST",

          type: "JSON",

          data: {pfctCode: pfctCode},

          success:function(data){

            var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {
                $('#pfctCodeId').val('');
                $('#pfctStateId').val('');
                $('#showpfctErr').html("<p style='color:red'>PFCT State Not Found...!</p>");

              }else if(data1.response == 'success'){
              
                if (data1.pfct_list[0].STATE_CODE=='' || data1.pfct_list[0].STATE_CODE=='NULL' || data1.pfct_list[0].STATE_CODE==null) {

                  $('#pfctStateId').val('not-found');
                  $('#showpfctErr').html("<p style='color:red'>PFCT State Not Found...!</p>");

                }else{

                  $('#pfctStateId').val(data1.pfct_list[0].STATE_CODE);

                }

              }

          }

    });

  }

/* ----- END : GET PFCT NAME FROM PLANT CODE -----*/


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
      $('#series_code').css('border-color','#ff0000').focus();
    }else{

      $('#series_code').css('border-color','#d4d4d4');
      $('#pfctCodeId').css('border-color','#ff0000').focus();

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

                  if (data1.data[0].GL_CODE=='null' || data1.data[0].GL_CODE==null) {

                    $('#showallDataM').modal('show');
                    $('#messageShowBody').html('<span style="font-size:14px;font-weight:600;">Series GL Code Not Found...!</span>');

                    $('#series_code').prop('readonly',false);
                    $('#series_code').val('');
                    $('#hidSeriesGlCdId').val('0');
                    $('#hidSeriesGlNmId').val('0');


                  }else{
                    
                    $('#hidSeriesGlCdId').val(data1.data[0].GL_CODE);
                    $('#hidSeriesGlNmId').val(data1.data[0].GL_NAME);

                  }
                    

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
    $('.billgenerate').DataTable({
            "scrollX": true
    });
  });

  $(document).ready(function(){


         var creditAmount = 0;
         var grandAmt = 0;
        $('#saleBillManage').DataTable();

        $("#saleBillManage").on('change', function() {

          var creditAmount = 0;
          var grandAmt = 0;
            
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

            $("#submitdata").prop('disabled',false);
            $("#simulation").prop('disabled',false);
            $("#submitNDown").prop('disabled',false);

          }else{

            $('#checkBoxCount').val('');

            $("#submitdata").prop('disabled',true);
            $("#simulation").prop('disabled',true);
            $("#submitNDown").prop('disabled',true);

          }
        
        });

    }); 



  function load_data(vrDateId='',transcode='',series_code='',pfctCodeId='',accountCode='',taxCode='',orderNo='',itemCdNm=''){

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
          serverSide: true,
          scrollX: true,
          order: [[1, 'asc'],[2, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          iDisplayLength: 150,
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'RENT_BILL_'+getdate+'_'+gettime,
                        title: getcomName+'\n'+getFY+'\n'+' RENT BILL',
                        exportOptions: {
                              columns: [1,2,3,4,5,6,7,8,9,10]
                        }
                      }

                    ],
          ajax:{
            url:'{{ url("/transaction/property-rental-utility/get-data-onRent-bill-posting") }}',
            data: {vrDateId:vrDateId,transcode:transcode,series_code:series_code,pfctCodeId:pfctCodeId,accountCode:accountCode,taxCode:taxCode,orderNo:orderNo,itemCdNm:itemCdNm},
            method:"POST",
          },
          columns: [
            {
                data:'DT_RowIndex',
                'render': function (data, type, full, meta){ 

                  return '<input type="checkbox" onclick="CalculateTax('+full['DT_RowIndex']+','+full['SCHEDULE_AMT']+'); getGrandTotal('+full['DT_RowIndex']+');" name="checkBoxId[]" class="pb_checkitm checkstyling valgetcls" data-id="" data-type="0" id="getRowCount'+full['DT_RowIndex']+'" value="'+full['BILLSCHID']+'~'+full['ACC_CODE']+'~'+full['SALE_ORDNO']+'~'+full['BEGINNING_DATE']+'~'+full['TENURE_INMONTH']+'~'+full['INC_INDICATOR']+'~'+full['INC_RATE']+'~'+full['SCHEDULE_DATE']+'~'+full['SCHEDULE_AMT']+'~'+full['PARTICULAR']+'">'+'<div class="modal fade" id="tds_rate_model'+full['DT_RowIndex']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document" style="margin-top: 5%;"><div class="modal-content modalScrlBar" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-5"><div class="form-group"><lable class="settaxcodemodel col-md-4" style="padding: 0px;">Tax Code - </lable><input type="text" class="settaxcodemodel col-md-7" name="getTaxCode[]" id="tax_code'+full['DT_RowIndex']+'" style="border: none; padding: 0px;" readonly></div></div><div class="col-md-6"><h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation</h5></div><div class="col-md-1"></div></div></div><div class="modal-body table-responsive"><div class="modalspinner hideloaderOnModl"></div><div class="boxer" id="tax_rate_'+full['DT_RowIndex']+'"></div></div><div class="modal-footer"><input type="hidden" value="" name="crAmtItm[]" id="cr_amtbytax_'+full['DT_RowIndex']+'"><center><span  id="footer_tax_btn'+full['DT_RowIndex']+'" style="width: 10px;"></span></center></div></div></div></div><input type="hidden" id="isChkChecked'+full['DT_RowIndex']+'" value="NO"><div id="appliedbtn'+full['DT_RowIndex']+'"></div><div id="cancelbtn'+full['DT_RowIndex']+'"></div><input type="hidden" id="data_count'+full['DT_RowIndex']+'" class="dataCountCl" value="" name="data_Count[]"><input type="hidden" id="grandTot'+full['DT_RowIndex']+'" class="grandTotalRw" value="" name="grand_Total[]"><input type="hidden" name="getBasicAmt[]" class="basicAmtCl" id="basicAmtTot'+full['DT_RowIndex']+'" value="">';

                },
                className:'text-center'
            },
            {
              data:'SCHEDULE_DATE',
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
              },
              className:'text-left'
            },
            {
                data:'SCHEDULE_AMT',
                'render': function (data, type, full, meta){

                  var DELIVERYNO = full['SCHEDULE_AMT'];
                  return DELIVERYNO+'<input type="hidden" name="deliveryNo[]" id="deliveryNoId'+full['DT_RowIndex']+'" value="'+full['SCHEDULE_AMT']+'">';

                },
                className:'text-left'
            },
            {
                data:'PARTICULAR',
                'render': function (data, type, full, meta){

                  var LRNO = full['PARTICULAR'];
                  return LRNO+'<input type="hidden" name="lrNo[]" id="lrNoId'+full['DT_RowIndex']+'" value="'+full['PARTICULAR']+'">';

                },
                className:'text-right'
            }
            
            
          ]


      });

    }


/* ---------------- END : DATA-TABLE ----------  */


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
            $("#tax_code"+slno).val('');
            $("#getRowCount"+slno).attr('data-type','0');
          }

        }
      }
      
    }


/* ------------- START : CALCULATION TAX --------- */

function CalculateTax(taxid,basic_Amt){


     /* if(e.target.checked){ 
        $('#myModal').modal();
      }*/

    var taxCode = $('#taxCodeID').val();

    $("#tds_rate_model"+taxid).modal({
            show:false,
            backdrop:'static',
        });

      var chkval = $("#isChkChecked"+taxid).val();

      console.log('checkbox value',chkval);

    if(chkval == 'NO') {

          $("#isChkChecked"+taxid).val('YES');

          var checkBxCheck = 1;

          $('#tds_rate_model'+taxid).modal('show');
           
     
      /* ~~~~~~~~~~~~~~~~~  START : Tax-Modal Open and Add Values ~~~~~~~~~~~~~~~~~~~~~ */

        $.ajaxSetup({
            headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
        });

        var basicAmt = parseFloat(basic_Amt);

        $('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt);
        $('#FirstBlckAmnt1_'+taxid+'_1').val(basicAmt);
        
        var taxOnModel = $('#tax_code'+taxid).val();

        if(taxOnModel == ''){

            var tax_code = taxCode;

            $.ajax({

                url:"{{ url('get-a-field-calc-for-purchase-bill') }}",

                method : "POST",

                type: "JSON",

                data: {tax_code:tax_code},

                success:function(data){
                  //console.log(data);
                  var data1 = JSON.parse(data);
                   //console.log('Get Data => ',data1);
                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      if(data1.data==''){

                          }else{

                          var basicheadval = parseFloat(basic_Amt);

                            var counter = 1;

                            var countI ='';

                            var dataI ='';

                            $('#tax_rate_'+taxid).empty();

                            var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div><div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div></div>";

                            $('#tax_rate_'+taxid).append(TableHeadData);

                            $.each(data1.data, function(k, getData) {

                              var datacount = data1.data.length;

                              dataI = datacount;

                              $('#data_count'+taxid).val(datacount);

                             if((getData.RATE_INDEX == null && getData.TAX_RATE == null) || (getData.RATE_INDEX == '-' && getData.TAX_RATE == '0.00')){

                                $('#tax_code'+taxid).val(getData.TAX_CODE);

                                 var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly> <input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"> </div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control amtRightAlign' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''><input type='hidden' style='width: 72%;margin-left: 15%;' class='form-control amtRightAlign' name='"+tax_code+"_"+taxid+"[]' id='FirstBlckAmnt1_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly></div></div>";

                                 

                              }else{

                                  if(getData.TAXIND_NAME == 'GrandTotal'){

                                    var classname = 'grandTotalGet';

                                  }else{

                                    var classname = '';

                                  }
                                  

                                  if(getData.TAX_AMT){
                                    var taxAmt =getData.TAX_AMT
                                  }else{
                                    var taxAmt ='';
                                  }

                                  if(getData.TAX_GL_CODE == null || getData.TAX_GL_CODE == '' ||getData.TAX_GL_CODE =='undefined'){
                                    var taxglCd ='';
                                  }else{
                                    var taxglCd =getData.TAX_GL_CODE;
                                  }


                                  if(getData.TAXGL_CODE ==null || getData.TAXGL_CODE =='' || getData.TAXGL_CODE =='undefined'){
                                    var taxTrnasGl = '';
                                  }else{
                                    var taxTrnasGl =getData.TAXGL_CODE;
                                  }

                                  if(taxglCd){
                                    var TAXGLCODE=taxglCd;
                                  }else if(taxTrnasGl){
                                    var TAXGLCODE=taxTrnasGl;
                                  }else{
                                    var TAXGLCODE='';
                                  }
                                  
                                  if(getData.TAX_LOGIC == '' || getData.TAX_LOGIC == null){
                                    var TAXLOGIC = '';
                                  }else{
                                    var TAXLOGIC = getData.TAX_LOGIC;
                                  }

                                  if(getData.STATIC_IND == '' || getData.STATIC_IND == null){
                                    var staticIND = '';
                                  }else{
                                    var staticIND = getData.STATIC_IND;
                                  }

                                  /*<a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a>*/

                                 
                                  
                                 var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></div><div class='box10 rateIndbox'> <input type='text' class='form-control' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+");'></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control amtRightAlign' oninput='getGrandTotal("+taxid+");' ></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='amtRightAlign form-control "+classname+"' name='amount[]'  id='FirstBlckAmnt_"+taxid+"_"+counter+"' readonly  value='"+taxAmt+"' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticIND+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'><input type='hidden' style='width: 72%;margin-left: 15%;' class='form-control amtRightAlign' name='"+tax_code+"_"+taxid+"[]' id='FirstBlckAmnt1_"+taxid+"_"+counter+"' value='"+taxAmt+"' readonly></div></div> <div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+");'>Apply</button></div></div></div></div>";

                                 
                               

                              }


                              $('#tax_rate_'+taxid).append(TableData);

                              var IndexSelct = getData.RATE_INDEX;

                               objcity = data1.data_rate;

                                  $.each(objcity, function (i, objcity) {

                                    var rateSel = '';

                                    if(IndexSelct == objcity.RATE_VALUE){

                                      $('#indicator_'+taxid+'_'+counter).append($('<option>',

                                      { 

                                        value: objcity.RATE_VALUE,

                                        text : objcity.RATE_VALUE+' = '+objcity.RATE_NAME,

                                        selected : true

                                      }));

                                    }else{
                                    
                                       $('#indicator_'+taxid+'_'+counter).append($('<option>',

                                        { 

                                          value: objcity.RATE_VALUE,

                                          text : objcity.RATE_VALUE+' = '+objcity.RATE_NAME,

                                          selected : false

                                        }));

                                    }

                                }); // .each loop

                               countI = counter;

                              counter++;

                            });  

                           // console.log('dataI',dataI);
                          //  console.log('countI',countI);
                        
                           var butn =  $('#footer_tax_btn'+taxid).find(':button').html();

                           if(butn != 'Ok' || butn =='undefined'){

                            var tblData = "<button type='button' class='btn btn-primary ' style='width: 10%;' data-dismiss='modal' id='ApplyOktaxbtn"+taxid+"' onClick='getGrantTotalOnOkBtn("+taxid+","+countI+")'>Ok</button>";

                              $('#footer_tax_btn'+taxid).append(tblData);

                              $('#appliedbtn'+taxid).html('');

                               var appliedbtn ='<input type="hidden" value="'+checkBxCheck+'" id="qltyvalue'+taxid+'">';

                              $('#appliedbtn'+taxid).html(appliedbtn);


                           }else{

                           }

                          }

                    } /* /. success codn*/
                } /* /. success fun*/

            }); /* /. ajax*/


        } /* if codn*/

    /* ~~~~~~~~~~~~~~~~~  END : Tax-Modal Open and Add Values ~~~~~~~~~~~~~~~~~~~~~ */


    }else{

        $('#tax_code'+taxid).val('');
        $('#data_count'+taxid).val('');
        $('#grandTot'+taxid).val('');
        $('#basicAmtTot'+taxid).val('');
        $('#appliedbtn'+taxid).html('');
        $('#tax_rate_'+taxid).html('');
        $("#isChkChecked"+taxid).val('NO');
        $('#tds_rate_model'+taxid).modal('hide');

        var dataCl =0;
        $(".dataCountCl").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allgetTaxRowCount").val(dataCl);

        });

        var datatot =0;
        $(".grandTotalRw").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                datatot += parseFloat(this.value);
            }

          $("#allgrandAmt").val(datatot.toFixed(2));

        });

        var datatot =0;
        $(".basicAmtCl").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                datatot += parseFloat(this.value);
            }

          $("#basicTotal").val(datatot.toFixed(2));

        });

        var grandTotalAmt = parseFloat($("#allgrandAmt").val());
        var basicTotalAmt = parseFloat($("#basicTotal").val());

        var otherTotalAmt = grandTotalAmt - basicTotalAmt;
        $('#otherTotalAmt').val(otherTotalAmt.toFixed(2));
      

    }

  }

  function getGrandTotal(getid){

    setTimeout(function() {

      $('.modalspinner').addClass('hideloaderOnModl');

      totalAmount = 0;

      qunatity = $("#qty"+getid).val();
      var funtn;
      for(l=2;l<=12;l++){

          var rate = $("#rate_"+getid+"_"+l).val();   

          var indicator = $("#indicator_"+getid+"_"+l).val();

          //console.log('indicator',indicator);

          var logic = $("#logic_id_"+getid+"_"+l).val();
          var static = $("#static_id_"+getid+"_"+l).val();
          var glCode = $("#tax_gl_code_"+getid+"_"+l).val();

          if(logic == null){

          }else{ 

            if(logic.length >0 || logic.length ==0){

             indicatorCalculation(indicator,rate,logic,l,getid,glCode);

            }
          }

          if((static == 0)){

              $("#changeInd_"+getid+"_"+l).removeClass('showind_Ch');
              $("#indicator_"+getid+"_"+l).prop('readonly',true);

              if(indicator == 'N' || indicator == 'P' || indicator == 'O' || indicator == 'Q'){
                $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',true);
                $("#rate_"+getid+"_"+l).prop('readonly',false);
              }else if(indicator == 'L' || indicator == 'M'){
                $("#rate_"+getid+"_"+l).prop('readonly',true);
                $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',true);
              }

             
              
              
              

              /* if(indicator == 'L' || indicator == 'M'){

                     $("#indicator_"+getid+"_"+l).prop('readonly',true);
                     $("#rate_"+getid+"_"+l).prop('readonly',true);
                     $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',false);
                     $("#changeInd_"+getid+"_"+l).addClass('showind_Ch');
                     
                }*/
          }else{

               $("#indicator_"+getid+"_"+l).prop('readonly',true);
               $("#rate_"+getid+"_"+l).prop('readonly',true);
               $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',true);
               $("#changeInd_"+getid+"_"+l).addClass('showind_Ch');
          }

          if(indicator == 'R'){
              var amntF_R =  parseFloat(qunatity) * parseFloat(rate);

              $('#FirstBlckAmnt_'+getid+"_"+l).val(amntF_R);
              $('#FirstBlckAmnt1_'+getid+"_"+l).val(amntF_R);
          }else{}

          
        
      }


    }, 500);

    $('.modalspinner').removeClass('hideloaderOnModl');

  } /*function close*/


  function indicatorCalculation(indicator,rate,logic,l,incNum,glCode){

   
  var totalLogicVal = 0;

    if(logic.length >0){

      logicVal= "";

      for(j=1; j<=logic.length; j++)

      {

        k = logic.substring(j-1,j);

        var BlocValue = $("#FirstBlckAmnt_"+incNum+"_"+k).val();

        if(BlocValue!="")

          totalLogicVal = parseFloat(totalLogicVal) + parseFloat(BlocValue);

      }

    }

    if(indicator == 'A'){
      roundofrate= ((parseFloat(totalLogicVal) * rate)/100);
      roundof= Math.round(roundofrate) - parseFloat(totalLogicVal);
         $("#FirstBlckAmnt_"+incNum+"_"+l).val(roundof.toFixed(2));
         $("#FirstBlckAmnt1_"+incNum+"_"+l).val(roundof.toFixed(2));
 
    }

    if(indicator=="N"){

        amtMinus= -((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(amtMinus.toFixed(2));
        $("#FirstBlckAmnt1_"+incNum+"_"+l).val(amtMinus.toFixed(2));

    }

    var inde_M_amt = parseFloat($("#FirstBlckAmnt_"+incNum+"_"+l).val());
    
    if(isNaN(inde_M_amt)){
      indm = '';
      $("#FirstBlckAmnt_"+incNum+"_"+l).val(indm);
      $("#FirstBlckAmnt1_"+incNum+"_"+l).val(indm);
    }else{

      if(indicator=="M"){
        var lumMinus; 

        lumMinus= parseFloat($("#FirstBlckAmnt_"+incNum+"_"+l).val()); 

        if(lumMinus > 0){
          var indicatorMAmt1=  -(lumMinus);
        }else if(lumMinus < 0){
          var indicatorMAmt1=  (lumMinus);
        }
        // indicatorMAmt=  -(parseFloat(indicatorMAmt) +  amtMinus);
          indicatorMAmt = indicatorMAmt1;
         $("#FirstBlckAmnt_"+incNum+"_"+l).val(indicatorMAmt);
         $("#FirstBlckAmnt1_"+incNum+"_"+l).val(indicatorMAmt);

      }
    }


    if(indicator=="P"){

        addition = ((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(addition.toFixed(2));
        $("#FirstBlckAmnt1_"+incNum+"_"+l).val(addition.toFixed(2));

    }

    if(indicator=="Q"){

       additionRoundOff = ((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(Math.round(additionRoundOff.toFixed(2)));
        $("#FirstBlckAmnt1_"+incNum+"_"+l).val(Math.round(additionRoundOff.toFixed(2)));

    }

    if(indicator=="Z"){

        subtotalview = ((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(subtotalview.toFixed(2));
        $("#FirstBlckAmnt1_"+incNum+"_"+l).val(subtotalview.toFixed(2));

    }

    
    if(indicator=="O"){

        deductionRoundOff = -((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(Math.round(deductionRoundOff.toFixed(2)));
        $("#FirstBlckAmnt1_"+incNum+"_"+l).val(Math.round(deductionRoundOff.toFixed(2)));

    }

    var crAmt =0;
    if(l == 2){
      var basicAmt =$('#basic'+incNum).val();
      if(indicator == 'Z'){}else{

        if(glCode ==''){
          var amnt = $("#FirstBlckAmnt_"+incNum+"_"+l).val();
          if(amnt == ''){
            var calAmt = 0;
          }else{
            var calAmt = amnt;
          }
          crAmt = parseFloat(basicAmt)+parseFloat(calAmt);
          $("#cr_amtbytax_"+incNum).val(crAmt.toFixed(2));
        }
      }
    }else{
      if(indicator == 'Z'){}else{
        if(glCode ==''){
          var amntF = $("#FirstBlckAmnt_"+incNum+"_"+l).val();
          var crGet = $("#cr_amtbytax_"+incNum).val();
          if(amntF == ''){
            var cal_amt =0;
          }else{
            var cal_amt =amntF;
          }
         crAmtcal =  parseFloat(crGet)+parseFloat(cal_amt);
         $("#cr_amtbytax_"+incNum).val(crAmtcal.toFixed(2));
        }
      }
    }

} /*function close*/

  function ind_forChange(rowid,countid){

    $('#indicatorShow_'+rowid+'_'+countid).modal('show');
    var already_ind = $('#indicator_'+rowid+'_'+countid).val();

    for(var w=1;w<=9;w++){

      var setInd = $('#cInd_'+rowid+'_'+countid+'_'+w).val();

        if(already_ind == 'N' || already_ind == 'O' || already_ind == 'P' || already_ind=='Q' || already_ind=='R'){
                if(setInd == 'L' || setInd == 'M' || setInd == 'Z' || setInd == 'A'){
                  $('#cInd_'+rowid+'_'+countid+'_'+w).prop('disabled',true);
                }
                
        }else if(already_ind == 'L' || already_ind == 'M'){
            if(setInd == 'N' || setInd == 'O' || setInd == 'P' || setInd=='Q' || setInd=='R' || already_ind == 'N' || setInd == 'Z' || setInd == 'A'){
              $('#cInd_'+rowid+'_'+countid+'_'+w).prop('disabled',true);
            }
        }

        if(setInd == already_ind){
          $('#cInd_'+rowid+'_'+countid+'_'+w).prop('checked',true);
        }

    }

}

function setIndOnOk(indid,indnmeid){

  var ind_value= $("input[type='radio'][name='chang_indval']:checked").val();
   //console.log('ind_value',ind_value);

  if(ind_value =='M' || ind_value == 'L'){
      $('#rate_'+indid+'_'+indnmeid).val(100).prop('readonly',true);
      $('#logic_id_'+indid+'_'+indnmeid).val('');
      $('#FirstBlckAmnt_'+indid+'_'+indnmeid).val('');
      $('#FirstBlckAmnt1_'+indid+'_'+indnmeid).val('');
   
  }else{
       $('#rate_'+indid+'_'+indnmeid).prop('readonly',false);
  } 

  $('#indicator_'+indid+'_'+indnmeid).val(ind_value);

  $('#indicatorShow_'+indid+'_'+indnmeid).modal('hide');

} 

/* ------------- END : CALCULATION TAX --------- */


/* -------- START : SEARCH BTN CLICK ----------- */

  $(document).ready(function(){

    $('#btnsearch').click(function(){
        
         var vrDateId       =  $('#vr_date').val();
         var transcode      =  $('#transcode').val();
         var series_code    =  $('#series_code').val();
         var pfctCodeId     =  $('#pfctCodeId').val();
         var pfctNameId     =  $('#pfctNameId').val();
         var accountCode    =  $('#account_code').val();
         var accountName    =  $('#AccountText').val();
         var accAddr        =  $('#accAddrID').val();
         var taxCode        =  $('#taxCodeID').val();
         var orderNo        =  $('#orderNo').val();
         var itemCdNm       =  $('#itemCdNmId').val();

        if(series_code!=''){
          $('#showSeriesErr').html('');
          if(pfctCodeId!=''){
            $('#pfctcode_err').html('');
              if(accountCode !=''){
                 $('#shwoErrAccCode').html('');
                if(accAddr !=''){
                 $('#shwoErrAccAddr').html('');
                 if(taxCode !=''){
                  $('#shwoErrTaxCode').html('');
                  if(orderNo !=''){
                    $('#shwoErrOrderNo').html('');
                    if(itemCdNm !=''){
                      $('#shwoErrItemCdNm').html('');
                      $('#saleBillManage').DataTable().destroy();

                /* --------- START : ON Search Btn Click Load Data Table -------*/

                          load_data(vrDateId,transcode,series_code,pfctCodeId,accountCode,taxCode,orderNo,itemCdNm);

                          $('#hidVrDateId').val('');
                          $('#hidTcodeId').val('');
                          $('#hidSeriesCodeId').val('');
                          $('#hidPfctCodeId').val('');
                          $('#hidAccCodeId').val('');
                          $('#hidAccNmId').val('');
                          $('#hidTaxCdId').val('');
                          $('#hidOrderNoId').val('');
                          $('#hidPfctNmId').val('');

                          $('#hidVrDateId').val(vrDateId);
                          $('#hidTcodeId').val(transcode);
                          $('#hidSeriesCodeId').val(series_code);
                          $('#hidPfctCodeId').val(pfctCodeId);
                          $('#hidAccCodeId').val(accountCode);
                          $('#hidAccNmId').val(accountName);
                          $('#hidTaxCdId').val(taxCode);
                          $('#hidOrderNoId').val(orderNo);
                          $('#hidItemCdNmId').val(itemCdNm);
                          $('#hidPfctNmId').val(pfctNameId);

                          $('#vrDateId,#series_code,#pfctCodeId,#tranTypeId,#account_code,#AccountText').prop('disabled',true);

                /* --------- END : ON Search Btn Click Load Data Table -------*/

                        }else{
                          $('#shwoErrItemCdNm').html('*The Item Code/Name field is required.');
                        }

                      }else{
                        $('#shwoErrOrderNo').html('*The Order No. field is required.');
                      }

                  }else{
                    $('#shwoErrTaxCode').html('*The Tax Code field is required.');
                  }

                }else{
                  $('#shwoErrAccAddr').html('*The Account Address field is required.');
                }

              }else{
                $('#shwoErrAccCode').html('*The Account Code field is required.');
              }

          }else{
            $('#pfctcode_err').html('*The PFCT Code field is required.');
          }

        }else{

          $('#showSeriesErr').html('*The Series Code field is required.');
          
        }
        
    });

  });

  /* -------- END : SEARCH BTN CLICK ----------- */



/* ~~~~~~~ START : CAL TAX OK BTN CLICK ~~~~~~~~~~~~ */

  function getGrantTotalOnOkBtn(srNo,totalCount){

    console.log('totalCount',totalCount);

    var getTblBottmBasic = $('#basicTotal').val();
    var getBasicTot = $('#getBasicAmtId'+srNo).val();
    var getGrandTot = $('#FirstBlckAmnt_'+srNo+'_'+totalCount).val();
    var basicTotal = $('#FirstBlckAmnt_'+srNo+'_1').val();
    $('#grandTot'+srNo).val(getGrandTot);
    $('#basicAmtTot'+srNo).val(basicTotal);

    /*if (getTblBottmBasic==''){

        $('#basicTotal').val(getBasicTot);

    }else{

        var getNewBasic = parseFloat(getTblBottmBasic) +  parseFloat(getBasicTot);
        $('#basicTotal').val('');
        $('#basicTotal').val(getNewBasic);


    }*/

    var dataCl =0;
    $(".dataCountCl").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            dataCl += parseFloat(this.value);
        }

      $("#allgetTaxRowCount").val(dataCl);

    });

    var databasic =0;
    $(".basicAmtCl").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            databasic += parseFloat(this.value);
        }

      $("#basicTotal").val(databasic.toFixed(2));

    });

    var datatot =0;
    $(".grandTotalRw").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            datatot += parseFloat(this.value);
        }

      $("#allgrandAmt").val(datatot.toFixed(2));

    });

    var grandTotalAmt = parseFloat($("#allgrandAmt").val());
    var basicTotalAmt = parseFloat($("#basicTotal").val());

    var otherTotalAmt = grandTotalAmt - basicTotalAmt;
    $('#otherTotalAmt').val(otherTotalAmt);
  }

/* ~~~~~~~ END : CAL TAX OK BTN CLICK ~~~~~~~~~~~~ */


  /* -------- START : SAVE BTN CLICK ----------- */
    
  function submitAllData(valD){

    var downloadFlg = valD;
   
    var getSerGlCd = $('#hidSeriesGlCdId').val();
    var getSerGlNm = $('#hidSeriesGlNmId').val();

    //alert(downloadFlg);return false;
    
      var checkboxcount = $('input[type="checkbox"]:checked').length;

      var checkitm          = [];
      
      $('.pb_checkitm').each(function(){

          if($(this).is(":checked")){
            
           var itmchk  = $(this).val();
           checkitm.push(itmchk);
           
          }
      });

        
      if (getSerGlCd!='0'){

           if(checkitm.length > 0){

          $('#checkBoxSelectMsg').html('');


            var formData = $("#rentBillPostingForm").serializeArray();

            console.log('serialize',formData);

            $('.overlay-spinner').removeClass('hideloader');

            $.ajaxSetup({

                  headers: {

                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                  }
            });

            $.ajax({

                type: 'POST',

                url: "{{ url('/transaction/property-rental-utility/rent-bill-posting-save') }}",

                data: formData, // here $(this) refers to the ajax object not form

                success: function (data) {

                  var data1 = JSON.parse(data);

                  console.log('data err',data1);

                if (data1.response == 'error') {

                  var responseVar = false;
                  var url = "{{url('/transaction/property-rental-utility/rent-bill-posting-save-msg')}}"
                 setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar = true;
                 
                  $('.overlay-spinner').removeClass('hideloader');

                    setTimeout(function () {
                      
                      $('.overlay-spinner').addClass('hideloader');
                      var url = "{{url('/transaction/property-rental-utility/rent-bill-posting-save-msg')}}"
                      setTimeout(function(){ window.location = url+'/'+responseVar; });

                    }, 2000);


                }

                  $('.overlay-spinner').addClass('hideloader');

                  console.log('response ',data1);
                 
                },

            });

           


          }else{

            $('#checkBoxSelectMsg').html('Must Be Select At Least One checkbox.');

          }

      }else{

         $('#showallDataM').modal('show');
         $('#messageShowBody').html('<span style="font-size:14px;font-weight:600;">Series GL Code Not Found...!</span>');
          
      }
  }


/* -------- END : SAVE BTN CLICK ----------- */




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
              $("#accAddrList").empty();

              $.each(data1.acc_addr_data, function(k, row){


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


function getItemCodeOnOrderNo(orderNo){

  var accCode = $('#account_code').val();

   $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/transaction/property-rental-utility/get-itemcd-from-orderNo') }}",

          data: {accCode:accCode,orderNo:orderNo}, // here $(this) refers to the ajax object not form

          success: function (data) {

            var data1 = JSON.parse(data);

            console.log('data err',data1);

            if (data1.response == 'error') {

               $('#shwoErrItemCdNm').html('*The Item Code/Name Not Found...!');

               $('#itemCdNmId').val('');

            }else{

              $('#shwoErrItemCdNm').html('');

              $("#itemCdNmId").val('');
             
              $('#itemCdNmId').val(data1.sale_order_data[0].ITEM_CODE+' ( '+data1.sale_order_data[0].ITEM_NAME+' )');

            }
           
          },

      });

}



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
            $('#submitdata').prop('disabled',false);
            $('#simulation').prop('disabled',false);
            $('#submitNDown').prop('disabled',false);
            $('#simulationbtn').prop('disabled',false);
            $('#CalcTaxinDif1').prop('disabled',false);
            $('#settextfot').removeClass('texttotal');
        }else{
             $('.pb_checkitm').each(function(){
                this.checked = false;
              });
             $('#submitdata').prop('disabled',true);
             $('#simulation').prop('disabled',true);
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
          $("#submitdata").prop('disabled',false);
          $("#simulation").prop('disabled',false);
          $("#submitNDown").prop('disabled',false);
          $("#CalcTaxinDif1").prop('disabled',false);
          $('#settextfot').removeClass('texttotal');
        }else{
          $("#simulationbtn").prop('disabled',true);
          $("#submitdata").prop('disabled',true);
          $("#simulation").prop('disabled',true);
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