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
        Final Sales Bill
        <small>: Add Details Of Final Sale Bill</small>
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

        <li>
          <a href="{{ url('/dashboard') }}">Final Sales Bill</a>
        </li>

        <li class="active">
          <a href="{{ url('/logistic/sale-bill-final') }}"> Add Final Sales Bill</a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Final Sales Bill</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/logistic/view-sale-bill-final') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Final Sale Bill </a>

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

                  <label for="exampleInputEmail1">Vr Date: </label>

                  <div class="input-group">
                        <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                        <input autocomplete="off" type="text" name="vrDate" id="vrDateId" class="form-control transdatepicker rightcontent" placeholder="Select Vr Date" value="<?php echo date('d-m-Y'); ?>">

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

            </div> <!-- /.row -->

            <div class="row">

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

               <div class="col-md-2">

                <div class="form-group">

                  <label>Acc Name: <span class="required-field"></span></label>

                    <div class="">

                      <input type="text"  id="AccountText" name="AccountText" class="form-control  pull-left" value="{{ old('AccountText')}}" placeholder="Select Account Name" readonly autocomplete="off">
                     
                    </div>

                </div><!-- /.form-group -->

              </div><!-- /.col-md-3 -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Acc Address: <span class="required-field"></span></label>

                    <div class="">

                      <input list="accAddrList"  id="accAddress" name="accAddress" class="form-control  pull-left" value="{{ old('accAddress')}}" placeholder="Select Account Address" onchange="checkTaxCode(this.value)" autocomplete="off">

                      <datalist id="accAddrList">
                        
                      </datalist>
                     
                    </div>

                </div><!-- /.form-group -->

              </div><!-- /.col-md-3 -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Tax Code : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>
                    <input type="hidden" name="pertText" id="pertText">
                    <input list="taxList"  id="taxCode" name="taxCode" disabled class="form-control  pull-left" value="" autocomplete="off" placeholder="Select Tax Code"> 

                    <datalist id="taxList">

                      <option selected="selected" value="">-- Select --</option>
                      @foreach ($taxList as $key)
                      <option value='<?php echo $key->TAX_CODE?>'   data-xyz ="<?php echo $key->TAX_NAME; ?>" ><?php echo $key->TAX_NAME ; echo " [".$key->TAX_CODE."]" ; ?></option>
                      @endforeach

                    </datalist>
                        
                  </div>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Tax Name: <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                    </div>

                    <input type="text"  id="tax_name" name="tax_name" class="form-control  pull-left" value="" placeholder="Enter Tax Name" autocomplete="off" readonly=""> 

                  </div>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

            </div> <!-- /.row -->


            <input type="hidden" id="mCurrentStatus" value="Freight Calculation Done"/>
          
            <div class="row">
              
              <div class="" style="margin-top: 1%;text-align: center;">

                 <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                  <button type="button" class="btn btn-warning" name="resetBtn" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reload&nbsp;&nbsp;</button>

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

          <div class="modalspinner hideloaderOnModl"></div>

          <form id="finalSaleBillForm">
            @csrf

          <table id="saleBillManage" class="table table-bordered table-striped table-hover billgenerate">

            <thead class="theadC">

              <tr>

                <th class="text-center" width="3%" style="text-align: left;"><input class='check_all'  type='checkbox' id="all_checkbox" /></th>
                <th class="text-center" width="5%">PROV VRNO</th>
                <th class="text-center" width="5%">PROV DATE</th>
                <th class="text-center" width="5%">TRANSACTION NO</th>
                <th class="text-center" width="5%">INVOICE NO</th>
                <th class="text-center" width="5%">DELIVERY NO</th>
                <th class="text-center" width="7%">LR NO</th>
                <th class="text-center" width="6%">DO NO</th>
                <th class="text-center" width="7%">VEHICLE NO</th>
                <th class="text-center" width="5%">LR-QTY</th>
                <th class="text-center" width="5%">ACK-QTY</th>
                <th class="text-center" width="5%">BILL QTY</th>
                <th class="text-center" width="5%">FRT-RATE </th>
                <th class="text-center" width="5%">BASIC AMT</th>
                <!-- <th class="text-center" width="5%">ACTION</th> -->

              </tr>

            </thead>

            <tbody id="defualtSearch">

            </tbody>
            <tfoot align="right">
            
            </tfoot>

          </table>


    <!-- ~~~~~~~~~ Start : head fields data ~~~~~~~~~~~~ -->

     <input type="hidden" name="hidVrDate" value="" id="hidVrDateId" />
     <input type="hidden" name="hidTcode" value="" id="hidTcodeId" />
     <input type="hidden" name="hidSeriesCode" value="" id="hidSeriesCodeId" />
     <input type="hidden" name="hidPlantCode" value="" id="hidPlantCodeId" />
     <input type="hidden" name="hidPlantCatg" value="" id="hidPlantCatgId" />
     <input type="hidden" name="hidTranType" value="" id="hidTranTypeId" />
     <input type="hidden" name="taxCode" value="" id="taxCodeId" />
     <input type="hidden" name="hidAccCode" value="" id="hidAccCodeId" />
     <input type="hidden" name="hidAccNm" value="" id="hidAccNmId" />
     <input type="hidden" name="hidCheckBoxCount" id="checkBoxCount" value=""/>
     <input type="hidden" name="hidSeriesGlCd" id="hidSeriesGlCdId" value=""/>
     <input type="hidden" name="hidSeriesGlNm" id="hidSeriesGlNmId" value=""/>
     <input type="hidden" name="hidAccGl" id="accGlCd" value=""/>
     <input type="hidden" name="hidAccGlNm" id="accGlNm" value=""/>
     <input type="hidden" name="hidAllTaxRowCnt" id="allgetTaxRowCount" value=""/>
     <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
     <input type="hidden" name="acc_address" id="acc_address" value="">
     <input type="hidden" name="acc_city" id="acc_city" value="">
     <input type="hidden" name="acc_pan" id="acc_pan" value="">
     <input type="hidden" name="acc_gstin" id="acc_gstin" value="">
     <input type="hidden" name="acc_billFormat" id="acc_billFormat" value="">

    <!-- ~~~~~~~~~ End : head fields data ~~~~~~~~~~~~ -->


  <!-- ************ TAX MODAL *************** -->

    <div class="modal fade" id="tds_rate_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;overflow-y: scroll;">

            <div class="modal-header">

              <div class="row">
                
                <div class="col-md-6">

                  <div class="form-group">
                      <lable class="settaxcodemodel col-md-4" style="padding: 0px;">Tax Code - </lable>
                               
                      <input type="text" class="settaxcodemodel col-md-8" id="tax_code1" style="border: none; padding: 0px;margin-top: -6px;" readonly>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <h5 class="modal-title settaxcodemodel" id="exampleModalLabel">Tax / Charges / etc Calculation</h5>
                </div>

              </div>

            </div>

            <div class="modal-body table-responsive">

              <div class="modalspinner hideloaderOnModl"></div>

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tax_rate_1">

                </table><!-- /.table -->

            </div>

            <div class="modal-footer">

              <center> <small  id="footer_ok_btn1"></small>
              <small  id="footer_tax_btn1" style="width: 10px;"></small>
             </center>

            
            </div>

          </div>

        </div>

      </div>

  <!-- ************ ./ TAX MODAL *************** -->


  <!-- ============ TAX CALCULATE BUTTON =========== -->

      <div style="margin-top: 1%;">

        <div class="col-md-1">
         
          <div style="display: inline-flex;margin-top: 12px;">
          
            <label>&nbsp;</label>
            <!-- <button type="button" class="btn btn-primary btn-xs" style="padding:2px;font-size: 12px;" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1);getGrandTotal(1);" disabled> &nbsp;&nbsp;<i class="fa fa-calculator" aria-hidden="true"></i> &nbsp;&nbsp;Calc Tax&nbsp;&nbsp; </button> -->
            <!-- <input type="hidden" value="0" name="taxDataCount" id="data_count1"> -->
            <input type="hidden" value="0" name="gstTaxData" id="gstTaxData">
            <div id="aplytaxOrNot1" class="aplynotStatus"></div>
            <div id="cancelbtn1"></div>
            <div id="appliedbtn1" style="margin-top: 6px;"></div>
          </div>
          
        </div>     
      </div>

  <!-- ============ TAX CALCULATE BUTTON =========== -->


  <!-- ~~~~~~ START : BASIC / OTHER / GRAND TOTAL SECTION ~~~~~~~~~ -->

             <div class="row" style="display: flex;margin-right: 4.7%;">

                  <div class="col-md-8">
                    
                    <!-- ............ Bill Format Section ............. -->
        
                      <div style='margin-left: 53%;display: inline-flex;'>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" oninput="getBillData(this.value)" name="jcopBillFormat" value="JCOP_BILL" id="jcop_bill_format" style="width: 16px;height: 16px;">&nbsp;
                          <span class="form-check-label spanClass" for="flexRadioDefault1">
                            JCOP BILL FORMAT
                          </span>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="form-check">
                          <input class="form-check-input" type="radio" oninput="getBillData(this.value)" name="tataBillFormat" value="TATA_BILL" id="tata_bill_format"  style="width: 16px;height: 16px;">&nbsp;
                          <span class="form-check-label spanClass" for="flexRadioDefault2">
                           TATA BILL FORMAT
                          </span>
                        </div>

                      </div>

                    <!-- ............ ./ Bill Format Section ............. -->


                  </div>

                  <div class="col-md-2 toalvaldesn" style="text-align: right;">

                    <div class="totlsetinres basicOtherGrandStyle">Basic Total :</div>

                  </div>

                  <div class="col-md-2">
                    <input type="hidden" id="allgetMCount" name="getdatacount">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalBasciAmt" value="" style="text-align:right;" id="basicTotal" readonly="" style="margin-top: 3px;">
                  </div>

              </div>

              <div class="row" style="display: flex;margin-right: 4.7%;">

                  <div class="col-md-8"></div>

                    <div class="col-md-2 toalvaldesn" style="text-align: right;">

                    <div class="totlsetinres basicOtherGrandStyle">Other Total :</div>

                  </div>

                  <div class="col-md-2">

                    <input class="credittotldesn inputboxclr" type="text" name="TotalOtherAmt" value="" id="otherTotalAmt" readonly="" style="margin-top: 3px;text-align:right;">

                  </div>

              </div>

              <div class="row" style="margin-right: 2.7%;">

                  <div class="col-md-8"></div>

                    <div class="col-md-2 toalvaldesn" style="text-align: right;">

                    <div class="totlsetinres basicOtherGrandStyle">Grand Total :</div>

                  </div>

                  <div class="col-md-2">

                    <input class="credittotldesn inputboxclr" type="hidden" name="totRoundOff" value="" id="totRoundOff" readonly="">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalGrandAmt" value="" id="allgrandAmt" readonly="" style="margin-top: 3px;text-align:right;">

                  </div>

              </div>

              <div id="billFormatMsg" style="text-align: center;margin-bottom: 1%;font-size: 14px;font-weight: 700;"></div>

              <input type="hidden" name="grandTotWord" id="grandTotWord" value='' />

  <!-- ~~~~~~ END : BASIC / OTHER / GRAND TOTAL SECTION ~~~~~~~~~ -->

<style>
  .spanClass{

    max-width: 100% !important;
    font-weight: 800 !important;
    font-size: 14px !important;

  }
</style>

        


          <div style="text-align: center;">
            
            <!-- <button class="btn btn-success" type="button" onClick="simulationFinalSaleBill()" disabled id="simulation"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp; Simulation</button> -->

           <button class="btn btn-warning" type="button" onClick="window.location.reload();" id="submitNDown1" disabled>&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reload&nbsp;&nbsp;</button>

           <!--  <button type="button" name="submit" value="submit" id="submitdata" onclick="submitAllData(0)" class='btn btn-primary' disabled style="width: 16%;">&nbsp;Save&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>  -->

            <button class="btn btn-success" type="button" id="submitdatapdf" disabled onclick="submitAllData(1)">&nbsp;&nbsp;<i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download&nbsp;&nbsp;</button>


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
// jcopBill
// tataBill
  function getBillData(getVal){

    var billVal = getVal;

    if (billVal=='TATA_BILL') {

      $('#tata_bill_format').prop('checked',true);
      $('#jcop_bill_format').prop('checked',false);
      //$('#jcop_bill_format').prop('disabled',true);
      $('#acc_billFormat').val('');
      $('#acc_billFormat').val(billVal);

    }else if(billVal='JCOP_BILL'){

      $('#jcop_bill_format').prop('checked',true);
      $('#tata_bill_format').prop('checked',false);
     // $('#tata_bill_format').prop('disabled',true);
      $('#acc_billFormat').val('');
      $('#acc_billFormat').val(billVal);

    }else{


    }


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
                $('#acc_pan').val(data1.acc_detail_list[0].PAN_NO);
                $('#acc_billFormat').val(data1.acc_detail_list[0].BILL_FORMAT);

                if (data1.acc_detail_list[0].BILL_FORMAT=='TATA_BILL') {

                  $('#tata_bill_format').prop('checked',true);
                  $('#jcop_bill_format').prop('checked',false);
                  $('#jcop_bill_format').prop('disabled',true);

                }else if(data1.acc_detail_list[0].BILL_FORMAT=='JCOP_BILL'){

                  $('#jcop_bill_format').prop('checked',true);
                  $('#tata_bill_format').prop('checked',false);
                  $('#tata_bill_format').prop('disabled',true);

                }else{


                }

                


                if(accAddrLen>0) {

                    /*accAddrID*/
                   $("#accAddrList").empty();

                   //console.log('data1.acc_addr_list',data1.acc_addr_list);

                   $.each(data1.acc_addr_list, function(k, row){


                        var accAddress = (row.ADD1 != "" || row.ADD1 != "NULL" || row.ADD1 != null) ? row.ADD1+',' : "";
                        var accCity    = (row.CITY_NAME != "" || row.CITY_NAME != "NULL" || row.CITY_NAME != null) ? row.CITY_NAME+',' : "";
                        var getAccCity    = (row.CITY_NAME != "" || row.CITY_NAME != "NULL" || row.CITY_NAME != null) ? row.CITY_NAME : "";
                        var accState   = (row.STATE_NAME != "" || row.STATE_NAME != "NULL" || row.STATE_NAME != null) ? row.STATE_NAME+',' : "";
                        var getAccState   = (row.STATE_NAME != "" || row.STATE_NAME != "NULL" || row.STATE_NAME != null) ? row.STATE_NAME : "";
                        var accScode   = (row.STATE_CODE != "" || row.STATE_CODE != "NULL" || row.STATE_CODE != null) ? row.STATE_CODE : "not-found";
                        var accPin     = (row.PIN_CODE != "" || row.PIN_CODE != "NULL" || row.PIN_CODE != null) ? row.PIN_CODE : "";

                        var accGst     = (row.GST_NUM != "" || row.GST_NUM != "NULL" || row.GST_NUM != null) ? row.GST_NUM : "";
                        
                        //console.log('add',accAddress);

                      $("#accAddrList").append($('<option>',{


                        value: accAddress+accCity+accState+accPin,
                        'data-xyz': accAddress+accCity+accState+accPin,
                        'data-type': getAccCity+' ( '+getAccState+' )',
                        'data-gst': accGst,
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






/*  -----START: GET-TAX CODE FROM ADDRESS CITY--------- */

  $('#accAddress').on('change',function(){

    var accAdd = $('#accAddress').val();
    var xyz = $('#accAddrList option').filter(function() {
      return this.value == accAdd;

    }).data('xyz');

    var getCityAcc = $("#accAddrList option").attr("data-type");
    var getGstAcc = $("#accAddrList option").attr("data-gst");

    console.log('city',getCityAcc);

    var msg = xyz ?  xyz : 'No Match';
    if(msg == 'No Match'){
      $('#acc_address').val('');
      $('#acc_gstin').val('');
      $('#acc_city').val('');
    }else{
      $('#acc_city').val(getCityAcc);
      $('#acc_gstin').val(getGstAcc);
      $('#acc_address').val(msg);
    }

  }); 

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
    var itemCode     = '';
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

                  if(data1.acc_tax_name == ''){

                  }else{
                    console.log('data1.acc_tax_name',data1.acc_tax_name);
                    $("#tax_name").val(data1.acc_tax_name);
                  }

                  if (data1.acc_tax != 'null') {

                      $("#taxList").empty();

                      $("#taxCode").val(data1.acc_tax);

                      console.log('data1.acc_tax',data1.acc_tax);
                      console.log('data1.acc_name',data1.get_tax_name);

                      if (data1.get_tax_list != 'null') {

                            $.each(data1.get_tax_list, function(k, key){

                              //console.log('tax',key);

                              $("#taxList").append($('<option>',{

                                value: key,
                                'data-xyz': key,
                                text: key

                              }));

                            });

                      }else{

                        $("#taxCode").prop('readonly',true);
                       
                      }

                  }else{

                    console.log('acc t1',data1.acc_tax);
                   

                    if (data1.get_tax_list != 'null') {

                      var taxListLength = data1.get_tax_list.length;

                       console.log('item tax len',taxListLength);

                      if(taxListLength>1) {

                        $("#taxCode").prop('readonly',false);
                          
                         $("#taxList").empty();

                         $.each(data1.get_tax_list, function(k, key){

                            $("#taxList").append($('<option>',{

                              value: key.TAX_CODE,
                              'data-xyz': key.TAX_CODE+' - '+key.TAX_NAME,
                              text: key.TAX_CODE+' - '+key.TAX_NAME

                            }));

                          });

                      }else if(taxListLength==0){

                        $("#taxList").empty();
                        $("#taxCode").prop('readonly',true);
                        $("#shwoErrTaxCode").html('*The Tax Code field is required.');

                      }else{

                          //console.log('tax-code-list',data1.get_tax_list[0].TAX_CODE);

                          $("#taxCode").val(data1.get_tax_list[0]);
                          $("#taxCode").prop('readonly',true);

                      }

                    }else{

                      $("#taxList").empty();
                      $("#taxCode").prop('readonly',true);
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

    $('#taxCode').on('change',function(){

      var taxCd =  $('#taxCode').val();
      var xyz = $('#taxList option').filter(function() {

        return this.value == taxCd;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#taxCode').val('');
        $('#tax_name').val('');
        $('#gstTaxData').val('0');
        $('#CalcTax1').prop('disabled',true);
      }else{
        $('#tax_name').val(msg);
        $('#CalcTax1').prop('disabled',false);
      }

    });


    $('#series_code').css('border-color','#ff0000').focus();

        var creditAmount = 0;
        var grandAmt = 0;
        var totlFreightAmt = 0;
       // $('#TransportBillTable').DataTable();

        $("#saleBillManage").on('change', function() {

            var creditAmount = 0;
            var grandAmt = 0;
            var totlFreightAmt = 0;
            var checkedCount = $("#saleBillManage input:checked").length;

            console.log('count',checkedCount);

            if(checkedCount == 0){
              $("#simulation").prop('disabled',true);
              $("#submitdata").prop('disabled',true);
              $("#submitdatapdf").prop('disabled',true);
              $("#CalcTax1").prop('disabled',true);
              $("#taxCode").prop('disabled',true);

            }else{
              $("#simulation").prop('disabled',false);
              $("#submitdata").prop('disabled',false);
              $("#submitdatapdf").prop('disabled',false);
              $("#CalcTax1").prop('disabled',false);
              $("#taxCode").prop('disabled',false);
            }
           
            for (var i = 0; i < checkedCount; i++) {
              var ii= i+1;
             
               var freightAmt = $("#saleBillManage input:checked")[i].parentNode.parentNode.children[13].innerHTML;

              if (freightAmt != "") {
                totlFreightAmt += parseFloat(freightAmt);
              } else {
                totlFreightAmt = 0;

              }

            }

            $("#basicTotal").val(totlFreightAmt.toFixed(2));

            var grandAmtTotl = $('#allgrandAmt').val();
            var basicAmtTotl = $('#basicTotal').val();
            var otherAmtTot = parseFloat(grandAmtTotl) - parseFloat(basicAmtTotl);
            $('#otherTotalAmt').val(otherAmtTot.toFixed(2));

          
        });

   
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

          var rows = $('#saleBillManage').DataTable().rows({ 'search': 'applied' }).nodes();

          console.log('tbl length => ',$('.pb_checkitm:checked', rows).length);
          console.log('checkedCount',checkedCount);

          if(checkedCount > 0){

            $('#checkBoxCount').val(checkedCount);

            $("#submitdata").prop('disabled',false);
            $("#simulation").prop('disabled',false);
            $("#submitNDown").prop('disabled',false);
            $("#all_checkbox").prop('disabled',true);

          }else{

            $('#checkBoxCount').val('');
            $("#all_checkbox").prop('disabled',false);
            $("#submitdata").prop('disabled',true);
            $("#simulation").prop('disabled',true);
            $("#submitNDown").prop('disabled',true);

          }
        
        });

    }); 


  function load_data(vrDateId='',series_code='',plant_code='',tranType='',accountCode='',mCurrentStatus=''){

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
          scrollY: 250,
          scrollX: true,
          scroller: true,
          fixedHeader: true,
          //order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'><'col-sm-3'i><'col-sm-6'>>",
          buttons: [
                    {
                      extend: 'excelHtml5',
                      filename: 'SALE_BILL_LOGISTICS_'+getdate+'_'+gettime,
                      title: getcomName+'\n'+getFY+'\n'+' SALE BILL LOGISTICS',
                      exportOptions: {
                            columns: [1,2,3,4,5,6,7,8,9,10]
                      }
                    }

                  ],
          ajax:{
            url:'{{ url("/logistics/get-data-from-sbill-prov") }}',
            data: {vrDateId:vrDateId,series_code:series_code,plant_code:plant_code,tranType:tranType,accountCode:accountCode,mCurrentStatus:mCurrentStatus},
            method:"POST",
          },
          columns: [
            {
                data:'DT_RowIndex',
                'render': function (data, type, full, meta){ 

                  //console.log('fullDT_RowIndex',full['DT_RowIndex']);

                  return '<input type="checkbox" name="checkBoxId[]" class="pb_checkitm valgetcls" data-id="'+full['TRANSACTION_NO']+'" data-type="0" id="getRowCount'+full['DT_RowIndex']+'" value="'+full['PSBILLHID']+'~'+full['PSBILLBID']+'~'+full['TRANSACTION_NO']+'~'+full['DELIVERY_NO']+'~'+full['LR_NO']+'~'+full['DORDER_NO']+'~'+full['VRNO']+'~'+full['VRDATE']+'~'+full['VEHICLE_NO']+'~'+full['QTYISSUED']+'~'+full['ACK_QTY']+'~'+full['QTYISSUED']+'~'+full['RATE']+'~'+full['BASICAMT']+'~'+full['PFCT_CODE']+'~'+full['PFCT_NAME']+'~'+full['VRNO']+'~'+full['UM']+'~'+full['AUM']+'~'+full['AQTYISSUED']+'~'+full['ITEM_CODE']+'~'+full['ITEM_NAME']+'~'+full['INVC_NO']+'~'+full['INVC_DATE']+'~'+full['EBILL_NO']+'~'+full['EWAYB_VALIDDT']+'~'+full['ITEM_SLNO']+'~'+full['TRANSACTION_NO']+'~'+full['DT_RowIndex']+'" onclick="checkBoxFun('+full['DT_RowIndex']+')">'+'<input type="hidden" class="hidnChkChebox" name="isChekYesNo[]" id="isChkChecked'+full['DT_RowIndex']+'" value="NO"><div id="cancelbtn'+full['DT_RowIndex']+'"></div><input type="hidden" id="data_count'+full['DT_RowIndex']+'" class="dataCountCl" value="" name="data_Count[]"><input type="hidden" id="grandTot'+full['DT_RowIndex']+'" class="grandTotalRw" value="" name="grand_Total[]"><input type="hidden" name="getBasicAmt[]" class="basicAmtCl" id="basicAmtTot'+full['DT_RowIndex']+'" value=""><div class="taxAplyAppend" id="inputAppendTaxField'+full['DT_RowIndex']+'"></div><input type="hidden" id="rowIdTbls'+full['DT_RowIndex']+'" name="rowIdTbl[]" value="'+full['DT_RowIndex']+'">';

                },
                className:'text-center'
            },
            {
              data:'VRNO',
              'render': function (data, type, full, meta){

                  var VRNO = full['VRNO'];
                  var SERIESCODE = full['SERIES_CODE'];
                  var fyCode = full['FY_CODE'];
                  var fySplite = fyCode.split('-');
                  var NEWVRNO = SERIESCODE+'/'+fySplite[0]+'/'+VRNO;

                  return NEWVRNO+'<input type="hidden" name="vrNo[]" id="vrNoId'+full['DT_RowIndex']+'" value="'+NEWVRNO+'">';

              },
              className:'text-left'
            },
            {
                    data:'VRDATE',
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
                data:'TRANSACTION_NO',
                'render': function (data, type, full, meta){

                  var TRANSCODE = full['TRANSACTION_NO'];
                  return TRANSCODE+'<input type="hidden" name="transCode[]" id="transCodeId'+full['DT_RowIndex']+'" value="'+full['TRANSACTION_NO']+'">';

                },
                className:'text-right'
            },
            {
                data:'INVC_NO',
                name:'INVC_NO',
                className:'text-right'
            },
            {
                data:'DELIVERY_NO',
                'render': function (data, type, full, meta){

                  var DELIVERYNO = full['DELIVERY_NO'];
                  var TAXCODE = full['TAX_CODE'];
                  return DELIVERYNO+'<input type="hidden" name="deliveryNo[]" id="deliveryNoId'+full['DT_RowIndex']+'" value="'+full['DELIVERY_NO']+'"><input type="hidden" name="getTaxCd[]" id="getTaxCd'+full['DT_RowIndex']+'" value="'+full['TAX_CODE']+'">';

                },
                className:'text-right'
            },
            {
                data:'LR_NO',
                'render': function (data, type, full, meta){

                  var LRNO = full['LR_NO'];
                  return LRNO+'<input type="hidden" name="lrNo[]" id="lrNoId'+full['DT_RowIndex']+'" value="'+full['LR_NO']+'">';

                },
                className:'text-left'
            },
            {
              data:'DORDER_NO',
              'render': function (data, type, full, meta){

                  var DORDERNO = full['DORDER_NO'];
                  
                  return DORDERNO+'<input type="hidden" name="dOrderNo[]" id="dOrderNoId'+full['DT_RowIndex']+'" value="'+full['DORDER_NO']+'">';

                },
                className:'text-right'
            },
            
            {
              data:'VEHICLE_NO',
              'render': function (data, type, full, meta){

                  var VEHICLENO = full['VEHICLE_NO'];
                  
                  return VEHICLENO+'<input type="hidden" name="vehicleNo[]" id="vehicleNoId'+full['DT_RowIndex']+'" value="'+full['VEHICLE_NO']+'">';

                },
                className:'text-left'
            },
            {
              data:'QTYISSUED',
              'render': function (data, type, full, meta){

                  var QTYISSUED = full['QTYISSUED'];
                  
                  return QTYISSUED+'<input type="hidden" name="qtyIssued[]" id="qtyIssuedId'+full['DT_RowIndex']+'" value="'+full['QTYISSUED']+'">';

                },
                className:'text-right'
            },
            {
              data:'ACK_QTY',
              'render': function (data, type, full, meta){

                  var ACKQTY = full['ACK_QTY'];
                  
                  return ACKQTY+'<input type="hidden" name="ackQty[]" id="ackQtyId'+full['DT_RowIndex']+'" value="'+full['ACK_QTY']+'">';

                },
                className:'text-right'
            },
            {
              data:'QTYISSUED',
              'render': function (data, type, full, meta){

                  var QTYISSUEDNEW = full['QTYISSUED'];
                  
                  return QTYISSUEDNEW+'<input type="hidden" name="qtyIssuedNw[]" id="qtyIssuedNwId'+full['DT_RowIndex']+'" value="'+full['QTYISSUED']+'">';

                },
                className:'text-right'
            },
            {
              data:'RATE',
              'render': function (data, type, full, meta){

                  var GETRATE = full['RATE'];
                  
                  return GETRATE+'<input type="hidden" name="getRate[]" id="getRateId'+full['DT_RowIndex']+'" value="'+full['RATE']+'">';

                },
                className:'text-right'
            },
            {
              data:'BASICAMT',
              'render': function (data, type, full, meta){

                  var GETBASICAMT = full['BASICAMT'];
                  
                  return GETBASICAMT+'<input type="hidden" name="getBasicAmt[]" id="getBasicAmtId'+full['DT_RowIndex']+'" value="'+full['BASICAMT']+'">';

                },
                className:'text-right'
            }
           
            
          ]


      });

    }


/* ---------------- END : DATA-TABLE ----------  */


    function checkBoxFun(sl_No){

      var chkval = $("#isChkChecked"+sl_No).val();

      console.log('chVal',chkval);
     
      if(chkval == 'NO') {

        console.log('in if');
        
        var tranNo = $('#transCodeId'+sl_No).val();

        //var getTaxCd = $('#getTaxCd1').val();

        //$('#taxCode').val(getTaxCd);


        //console.log('tranNo',tranNo);

        var table = $('#saleBillManage').DataTable();
        var table_length = table.data().length;

        //console.log('table_length',table_length);

        for(var r=0;r<table_length;r++){

          var slno = parseInt(r) + parseInt(1);

          var newDelNo = $("#getRowCount"+slno).attr('data-id');
          
          //console.log('rowCount',newDelNo);
          
          if(tranNo == newDelNo){
            $('#getRowCount'+slno).prop("checked", true);
            $("#isChkChecked"+slno).val('YES');
            $("#getRowCount"+slno).attr('data-type',sl_No);
            $("#getRowCount"+slno).attr('data-type',sl_No);

            //var getAtrVal = $('#inputAppendTaxField'+slno).attr('data-id');
            //console.log('getAtrVal',getAtrVal);

            $('#inputAppendTaxField'+slno).empty();
            CalTaxFirstStep(slno);
            //var checkTaXAply = $('#inputAppendTaxField'+slno).html();
            //CalTaxFirstStep(slno);
          }

        }

      }else{

        console.log('in else');

        var tranNo = $('#transCodeId'+sl_No).val();

        console.log('tranNo',tranNo);

        var table = $('#saleBillManage').DataTable();
        var table_length = table.data().length;

        for(var r=0;r<table_length;r++){

          var slno = parseInt(r) + parseInt(1);

          var newDelNo = $("#getRowCount"+slno).attr('data-id');
          
          if(tranNo == newDelNo){
            $('#getRowCount'+slno).prop("checked", false);
            $("#isChkChecked"+slno).val('NO');
            $("#tax_code"+slno).val('');
            $("#getRowCount"+slno).attr('data-type','0');

            var grandAmt      = $('#grandTot'+slno).val();
            var totalgrandAmt = $('#allgrandAmt').val();

            var newGrandAmt = parseFloat(totalgrandAmt) - parseFloat(grandAmt);

            $('#allgrandAmt').val(newGrandAmt.toFixed(2));

            $('#inputAppendTaxField'+slno).empty();
           // CalTaxFirstStep(slno);

          }

        }

      }

      
    } /* /.main function*/

    function CalTaxFirstStep(sl_No){

      var ischk_chked = $('#isChkChecked'+sl_No).val();
      if(ischk_chked == 'YES'){

        var tax_code    = $('#taxCode').val();
        var basicAmt    = $('#getBasicAmtId'+sl_No).val();
        var dispatchQTY = $('#qtyIssuedNwId'+sl_No).val();
        var rate        = $('#getRateId'+sl_No).val();

        $.ajax({

              url:"{{ url('Transaction/a-field-calc/tax-rate-calc')}}",

              method : "POST",

              type: "JSON",

              data: {tax_code: tax_code},
              beforeSend: function() {
                console.log('start spinner');
                $('.modalspinner').removeClass('hideloaderOnModl');
              },
              success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  if(data1.data==''){

                  }else{

                    var basicheadval =basicAmt;

                    var basicVal   = [];
                    var logicVal   = [];
                    var staticVal  = [];
                    var rateIndVal = [];
                    var rateVal    = [];
                    var tacGlCode  = [];

                    $('#data_count'+sl_No).val(data1.data.length);

                    var taxRwCount = $('#data_count'+sl_No).val();

                    for(var i=0;i<data1.data.length;i++){

                      var slnoSeries = parseInt(i) + parseInt(1);
                      if(taxRwCount == slnoSeries){
                        var taxClass ='grandAmountCls';
                      }else{
                        var taxClass ='';
                      }
                      
                      var rowSlno =parseInt(1) +parseInt(i);
                      var inputApnd = "<input type='hidden' class='"+taxClass+"' name='rowtaxAmount_"+sl_No+"[]' id='FirstBlckAmntR_"+sl_No+"_"+rowSlno+"'>";

                      $('#inputAppendTaxField'+sl_No).append(inputApnd);
                      //$('#inputAppendTaxField'+sl_No).attr('data-id','1');

                    }

                    $.each(data1.data, function(k, getData) {

                        var datacount = data1.data.length;
                        dataI = datacount;

                        if((getData.RATE_INDEX == null && getData.TAX_RATE == null) || (getData.RATE_INDEX == '-' && getData.TAX_RATE == '0.00')){

                          basicVal.push(basicAmt);
                          logicVal.push('0');
                          staticVal.push('0');
                          rateIndVal.push('---');
                          rateVal.push('---');

                          $('#FirstBlckAmntR_'+sl_No+"_1").val(basicAmt);

                        }else{

                          if(getData.STATIC_IND == '' || getData.STATIC_IND == null){
                            var staticIND = '';
                          }else{
                            var staticIND = getData.STATIC_IND;
                          }

                          if(getData.TAX_LOGIC == '' || getData.TAX_LOGIC == null){
                            var TAXLOGIC = '';
                          }else{
                            var TAXLOGIC = getData.TAX_LOGIC;
                          }

                          if(getData.TAX_GL_CODE == null || getData.TAX_GL_CODE == '' ||getData.TAX_GL_CODE =='undefined'){
                            var taxglCd ='';
                          }else{
                            var taxglCd =getData.TAX_GL_CODE;
                          }

                          if(taxglCd){
                            var TAXGLCODE=taxglCd;
                          }else{
                            var TAXGLCODE='';
                          }

                          rateIndVal.push(getData.RATE_INDEX);
                          logicVal.push(TAXLOGIC);
                          staticVal.push(staticIND);
                          rateVal.push(getData.TAX_RATE);
                          tacGlCode.push(TAXGLCODE);

                          for(w=1;w<12;w++){

                            var rate      = rateVal[w];
                            var indicator = rateIndVal[w];
                            var logic     = logicVal[w];
                            var static    = staticVal[w];
                            var glCode    = tacGlCode[w];

                            var fSlno = parseInt(w) + parseInt(1);

                            if(logic == null){

                            }else{
                              if(logic.length >0 || logic.length ==0){

                               indicatorCalculationDirect(indicator,rate,logic,fSlno,sl_No,glCode);

                              }
                            }

                            if(indicator == 'R'){

                                var amntF_R =  parseFloat(dispatchQTY) * parseFloat(rate);

                                $('#FirstBlckAmntR_'+sl_No+"_"+w).val(amntF_R);
                            }else{}

                          } /* /.for loop*/
                          
                        }

                      });/* /.each loop */

                  }/*/.data codn*/

                }/*/.success data*/

              },/*/.success fun*/
              complete: function() {
                console.log('end spinner');
                $('.modalspinner').addClass('hideloaderOnModl');
              },

        }); /* /. ajax fun*/

      }else{
        $('#inputAppendTaxField'+sl_No).empty();
      }

    }


/* ------------- START : CALCULATION TAX --------- */

  function CalculateTax(taxid){

    $("#tds_rate_model"+taxid).modal({
        show:false,
        backdrop:'static',
    });

    $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    var taxOnModel = $('#tax_Code'+taxid).val();
    var basicAmt   = $('#basicTotal').val();
    console.log('basic amt => ',basicAmt);
    $("#gstTaxData").val('1');

    $('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt);

    var Item_Cde = $('#item_code').val();

    if(taxOnModel == '' || taxOnModel == undefined){

      var tax_code = $('#taxCode').val();

      $.ajax({

            url:"{{ url('Transaction/a-field-calc/tax-rate-calc')}}",

            method : "POST",

            type: "JSON",

            data: {tax_code: tax_code},

            beforeSend: function() {
              console.log('start spinner');
                  $('.modalspinner').removeClass('hideloaderOnModl');
            },

            success:function(data){
              
              var data1 = JSON.parse(data);
               
                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                    if(data1.data==''){

                    }else{

                      var basicheadval = parseFloat($('#basicTotal').val());

                      var counter = 1;

                      var countI ='';
                      var dataI ='';

                      $('#tax_rate_'+taxid).empty();

                      var TableHeadData =  "<tr><th>Tax Indicator</th><th>Rate Indicator</th><th>Rate</th><th>Amount</th></tr>";

                      $('#tax_rate_'+taxid).append(TableHeadData);

                      $.each(data1.data, function(k, getData) {

                        var datacount = data1.data.length;
                        dataI = datacount;
                        $('#data_count'+taxid).val(datacount);

                        if((getData.RATE_INDEX == null && getData.TAX_RATE == null) || (getData.RATE_INDEX == '-' && getData.TAX_RATE == '0.00')){

                         $('#tax_code'+taxid).val(getData.TAX_CODE);

                         if (getData.TAXIND_NAME=='DISCOUNT' || getData.TAXIND_NAME=='OTHER') {

                          var disabledAttr = 'readonly';

                         }else{

                          var disabledAttr = '';

                         }

                         var TableData = "<tr><td class='tdthtablebordr'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"> </td>"+
                          "<td class='tdthtablebordr'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></td>"+
                          "<td class='tdthtablebordr'><input type='text' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control numerRightAlign' readonly></td>"+
                          "<td class='tdthtablebordr'><input type='text' class='form-control numerRightAlign' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval.toFixed(2)+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''></td>";

                        }else{

                          if(getData.tax_ind_name == 'GrandTotal'){
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

                          if (getData.TAXIND_NAME=='DISCOUNT' || getData.TAXIND_NAME=='OTHER') {

                            console.log('tax-name',getData.TAXIND_NAME);

                          var disabledAttr = 'disabled';

                         }else{

                          var disabledAttr = '';

                         }

                          var TableData = "<tr><td class='tdthtablebordr'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value=\""+getData.TAXIND_NAME+"\" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></td>"+
                           "<td class='tdthtablebordr'><input type='text' class='form-control' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+");'></td>"+
                           "<td class='tdthtablebordr'><input type='text' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control numerRightAlign' oninput='getGrandTotal("+taxid+");' ></td>"+
                           "<td class='tdthtablebordr'><input type='text' class='numerRightAlign form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' "+disabledAttr+" value='"+taxAmt+"' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticIND+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'>"+
                             //indicator change modal 
                              "<div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($ratval_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+");'>Apply</button></div></div></div></div></td></tr>";

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

                      }); /* -/. each loop */

                      var butn =  $('#footer_tax_btn'+taxid).find(':button').html();

                     if(butn != 'Ok' || butn =='undefined'){

                      var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOktaxbtn"+taxid+"' onclick='OkGetGransVal("+taxid+","+dataI+","+countI+","+basicAmt+",1);' style='width: 36px;'>Ok</button>";

                       $('#footer_tax_btn'+taxid).append(tblData);

                     }else{
                     
                     }

                      
                    }
                 
                } // success close

          }, //success function close

          complete: function() {
            $('.modalspinner').addClass('hideloaderOnModl');
          },

      }); //ajax close 

    }else{


    }

  } /*function close*/


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
                $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',false);
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
          }else{}

          
        
      }

    }, 500);

    $('.modalspinner').removeClass('hideloaderOnModl');

  } /*function close*/


function OkGetGransVal(aplyid,datacount,countercount,basicAmt,staticvalue){

    if(staticvalue==1){

      //$('#aplytaxOrNot'+aplyid).html('1');
      $('#cancelbtn'+aplyid).html('');
      $('#appliedbtn'+aplyid).html('');

      var appliedbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-success iconBtnSty" style="margin-left:45%;"><i class="fa fa-check"></i></small>';

      $('#appliedbtn'+aplyid).html(appliedbtn);
          
      $('#simulation').prop('disabled', false);
      $('#submitdata').prop('disabled', false);
      $('#submitdatapdf').prop('disabled', false);
          
      if(countercount == datacount){
        var g_Amnt = $('#FirstBlckAmnt_'+aplyid+'_'+countercount).val();

        var otherTot = parseFloat(g_Amnt) - parseFloat(basicAmt);

        var mOtherTot = otherTot.toFixed(2);
        
        $('#otherTotalAmt').val(mOtherTot);
        $('#allgrandAmt').val(g_Amnt.toFixed(2));
      }
      
    }else{
        
      $('#aplytaxOrNot'+aplyid).html('0');
      $('#cancelbtn'+aplyid).html('');
      $('#appliedbtn'+aplyid).html('');

      var cnclbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-danger"><i class="fa fa-times"></i></small>';

      $('#cancelbtn'+aplyid).html(cnclbtn);
      $('#data_count'+aplyid).val(0);
      //$('#get_grand_num'+aplyid).val('');
         
    }

}


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
        
        var vrDateId       =  $('#vrDateId').val();
        var transcode      =  $('#transcode').val();
        var series_code    =  $('#series_code').val();
        var plant_code     =  $('#plantCodeId').val();
        var plantCatg      =  $('#plantCatgId').val();
        var tranType       =  $('#tranTypeId').val();
        var accountCode    =  $('#account_code').val();
        var AccountText    =  $('#AccountText').val();
        var mCurrentStatus =  $('#mCurrentStatus').val();
        var taxCode        =  $('#taxCode').val();

        if(series_code!=''){
          $('#showSeriesErr').html('');
          if(plant_code!=''){
            $('#plantcode_err').html('');
                if(tranType!=''){
                  $('#shwoErrTranCode').html('');
                  if(accountCode !=''){
                     $('#shwoErrAccCode').html('');
                     $('#saleBillManage').DataTable().destroy();

                  /* --------- START : ON Search Btn Click Load Data Table -------*/

                          load_data(vrDateId,series_code,plant_code,tranType,accountCode,mCurrentStatus);

                          $('#hidVrDateId').val('');
                          $('#hidTcodeId').val('');
                          $('#hidSeriesCodeId').val('');
                          $('#hidPlantCodeId').val('');
                          $('#hidPlantCatgId').val('');
                          $('#hidTranTypeId').val('');
                          $('#taxCodeId').val('');
                          $('#hidAccCodeId').val('');
                          $('#hidAccNmId').val('');

                          $('#hidVrDateId').val(vrDateId);
                          $('#hidTcodeId').val(transcode);
                          $('#hidSeriesCodeId').val(series_code);
                          $('#hidPlantCodeId').val(plant_code);
                          $('#hidPlantCatgId').val(plantCatg);
                          $('#hidTranTypeId').val(tranType);
                          $('#taxCodeId').val(taxCode);
                          $('#hidAccCodeId').val(accountCode);
                          $('#hidAccNmId').val(AccountText);

                          $('#vrDateId,#series_code,#plantCodeId,#tranTypeId,#account_code,#AccountText').prop('disabled',true);

                  /* --------- END : ON Search Btn Click Load Data Table -------*/


                  }else{
                    $('#shwoErrAccCode').html('*The Account Code field is required.');
                  }

                }else{
                    $('#shwoErrTranCode').html('*The T-Code field is required.');
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

      
    var datatot1 =0;
    var getRoundOff = $('#totRoundOff').val();
    for (var i = 0; i < totalCount; i++) {

      var rateIndicator = $('#indicator_'+srNo+'_'+i).val();
      var roundOffAmt = $('#FirstBlckAmnt_'+srNo+'_'+i).val();

      console.log('rateIndicators',rateIndicator);

      if(rateIndicator == 'A'){
        
        datatot1 = parseFloat(roundOffAmt);

        if (getRoundOff=='') {

          $('#totRoundOff').val(datatot1);

        }else{

          console.log('1st',getRoundOff);
          console.log('2st',roundOffAmt);

          var dataTot01 = parseFloat(getRoundOff) + parseFloat(roundOffAmt);
          var newTot = dataTot01.toFixed(2);

          $('#totRoundOff').val(newTot);

        }
        
      }
      
    }

    var grandTotalAmt = $("#allgrandAmt").val();
    var roundOffTotAmt = $("#totRoundOff").val();

    var getNewTot = parseFloat(grandTotalAmt) + parseFloat(roundOffTotAmt);

    var mGrandTot = getNewTot.toFixed(2);

    $("#allgrandAmt").val(mGrandTot.toFixed(2));

    var grandTotalAmt1 = $("#allgrandAmt").val();
    var basicTotalAmt = $("#basicTotal").val();
   
    var otherTotalAmt = parseFloat(grandTotalAmt1) - parseFloat(basicTotalAmt);
   
    var newOtherTot = otherTotalAmt.toFixed(2);
   
    $('#otherTotalAmt').val(newOtherTot);

  }

/* ~~~~~~~ END : CAL TAX OK BTN CLICK ~~~~~~~~~~~~ */


  /* -------- START : SAVE BTN CLICK ----------- */
    
  function submitAllData(valD){

    var downloadFlg = valD;

    var getcomName = '<?php echo Session::get('company_name'); ?>';
    var getFY      = '<?php echo Session::get('macc_year'); ?>';
    var getnewdate = new Date();
    var getday = getnewdate.getDate();
    var getMonth = getnewdate.getMonth()+1;
    var getYear = getnewdate.getFullYear();

    var jcopBillFormat = $('#jcop_bill_format').is(":checked");

    var tataBillFormat = $('#tata_bill_format').is(":checked");

    var billFormat;

    if(tataBillFormat){
      billFormat = $('#tata_bill_format').val();
    }else if(jcopBillFormat){
      billFormat = $('#jcop_bill_format').val();
    }else{
      billFormat = 'Not Found';
    }



    if (billFormat=='TATA_BILL' || billFormat=='JCOP_BILL') {

      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;

      $('#pdfYesNoStatus').val(downloadFlg);
     
      var getSerGlCd = $('#hidSeriesGlCdId').val();
      var getSerGlNm = $('#hidSeriesGlNmId').val();
      var grandTot   = $('#allgrandAmt').val();
     
      document.getElementById('grandTotWord').value = amountInWords(grandTot);


      //alert(downloadFlg);return false;
      
        var checkboxcount = $('input[type="checkbox"]:checked').length;

        $('#checkBoxCount').val('');

        $('#checkBoxCount').val(checkboxcount);

        console.log('checkboxcount ',checkboxcount);

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


              var formData = $("#finalSaleBillForm").serializeArray();

              console.log('serialize',formData);

              $('.overlay-spinner').removeClass('hideloader');

              $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }
              });

              $.ajax({

                  type: 'POST',

                  url: "{{ url('/transaction/logistics/save-final-sale-bill') }}",

                  data: formData, 

                  success: function (data) {

                    var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                    var responseVar = false;
                    var url = "{{url('/logistics/final-sale-bill-logistics-save')}}"
                   setTimeout(function(){ window.location = url+'/'+responseVar; });

                  }else{

                    var responseVar = true;

                    var gelFileNm = $('#downloadFileName').val();

                    var billNo = data1.bill_no;

                    if(downloadFlg == 1){
                      
                      var fileN        = 'SALEBILL_'+billNo+'_'+getdate;
                      var linkPdf      = document.createElement('a');
                      linkPdf.href     = data1.url;
                      linkPdf.download = fileN+'.pdf';
                      linkPdf.dispatchEvent(new MouseEvent('click'));
                    }

                    var link = document.createElement('a');
                    var filePath = data1.file_path;
                    var fileName = data1.file_name;
                    var fileNameLen = data1.file_name.length;

                    //console.log('len ',fileNameLen);

                    var countFileName = fileNameLen - 1;
                    var chekYesNo = '';
                   
                    var fileNewPath = filePath+'/'+fileName

                    var url1 = "{{url('/')}}"+'/'+fileNewPath;
                    link.href = url1;
                    link.download = fileName;
                    link.dispatchEvent(new MouseEvent('click'));

                   
                    $('.overlay-spinner').removeClass('hideloader');

                      setTimeout(function () {
                        
                        $('.overlay-spinner').addClass('hideloader');
                        var url = "{{url('/logistics/final-sale-bill-logistics-save')}}"
                        setTimeout(function(){ window.location = url+'/'+responseVar; });

                      }, 2000);


                  }

                    $('.overlay-spinner').addClass('hideloader');

                    console.log('response ',data1);
                   
                  },

              });

             


            }else{

              $('#checkBoxSelectMsg').html('*Must Be Select At Least One checkbox.');

            }

        }else{

           $('#showallDataM').modal('show');
           $('#messageShowBody').html('<span style="font-size:14px;font-weight:600;">Series GL Code Not Found...!</span>');
            
        }
    }else{

      $('#billFormatMsg').html('<span style="color:red;">*Bill format field is required.<span>');

    }
  }


/* -------- END : SAVE BTN CLICK ----------- */


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
            $('#submitdata').prop('disabled',false);
            $('#simulation').prop('disabled',false);
            $('#submitNDown').prop('disabled',false);
            $('#simulationbtn').prop('disabled',false);
            $('#CalcTaxinDif1').prop('disabled',false);
            $('#settextfot').removeClass('texttotal');

            $('.hidnChkChebox').val('YES');
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

             $('.hidnChkChebox').val('NO');

             $('.taxAplyAppend').empty();
             $('#basicTotal').val('');
             $('#otherTotalAmt').val('');
             $('#allgrandAmt').val('');
        }

        var checkedCount = $("#saleBillManage input:checked").length;

        var creditAmount = 0;
        var grandAmt = 0;
        var basicTotalAmt = 0;

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
          var basicAmt = $("#getBasicAmtId"+ii).val();
          

          if (amount != "") {
            creditAmount += parseFloat(amount);
          } else {
            creditAmount = 0;
          }

          if (basicAmt != "") {
            basicTotalAmt += parseFloat(basicAmt);
          } else {
            basicTotalAmt = 0;
          }

          if (gr_amount !="") {
            grandAmt += parseFloat(gr_amount);
          } else {
            grandAmt = 0;
          }

          $("#netAmt").text(grandAmt.toFixed(2));
          $("#netAmount").val(grandAmt.toFixed(2));
          $("#basicTotal").val(basicTotalAmt.toFixed(2));
          $("#basicTotalAmt").text(creditAmount.toFixed(2));
        }

        var tax_code = $('#taxCode').val();

        $.ajax({

              url:"{{ url('Transaction/a-field-calc/tax-rate-calc')}}",

              method : "POST",

              type: "JSON",

              data: {tax_code: tax_code},

              beforeSend: function() {
                console.log('start spinner');
                $('.modalspinner').removeClass('hideloaderOnModl');
              },

              success:function(data){

                var data1 = JSON.parse(data);
                 
                  if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                  }else if(data1.response == 'success'){

                    if(data1.data==''){

                    }else{

                      for(var q=0;q<checkedCount;q++){

                        var sl_No    = parseInt(q) + parseInt(1);
                        var basicAmt = $('#getBasicAmtId'+sl_No).val();
                        var rate     = $('#getRateId'+sl_No).val();

                        var basicVal   = [];
                        var logicVal   = [];
                        var staticVal  = [];
                        var rateIndVal = [];
                        var rateVal    = [];
                        var tacGlCode  = [];

                        $('#data_count'+sl_No).val(data1.data.length);
                        var taxRwCount = $('#data_count'+sl_No).val();
                        for(var i=0;i<data1.data.length;i++){

                          var slnoSeries = parseInt(i) + parseInt(1);
                          if(taxRwCount == slnoSeries){
                            var taxClass ='grandAmountCls';
                          }else{
                            var taxClass ='';
                          }
                            
                          var rowSlno =parseInt(1) +parseInt(i);
                          var inputApnd = "<input type='hidden' class='"+taxClass+"' name='rowtaxAmount_"+sl_No+"[]' id='FirstBlckAmntR_"+sl_No+"_"+rowSlno+"'>";

                          $('#inputAppendTaxField'+sl_No).append(inputApnd);

                        }

                        $.each(data1.data, function(k, getData) {

                          var datacount = data1.data.length;
                          dataI = datacount;

                          if((getData.RATE_INDEX == null && getData.TAX_RATE == null) || (getData.RATE_INDEX == '-' && getData.TAX_RATE == '0.00')){

                            basicVal.push(basicAmt);
                            logicVal.push('0');
                            staticVal.push('0');
                            rateIndVal.push('---');
                            rateVal.push('---');

                            $('#FirstBlckAmntR_'+sl_No+"_1").val(basicAmt);

                          }else{

                            if(getData.STATIC_IND == '' || getData.STATIC_IND == null){
                              var staticIND = '';
                            }else{
                              var staticIND = getData.STATIC_IND;
                            }

                            if(getData.TAX_LOGIC == '' || getData.TAX_LOGIC == null){
                              var TAXLOGIC = '';
                            }else{
                              var TAXLOGIC = getData.TAX_LOGIC;
                            }

                            if(getData.TAX_GL_CODE == null || getData.TAX_GL_CODE == '' ||getData.TAX_GL_CODE =='undefined'){
                              var taxglCd ='';
                            }else{
                              var taxglCd =getData.TAX_GL_CODE;
                            }

                            if(taxglCd){
                              var TAXGLCODE=taxglCd;
                            }else{
                              var TAXGLCODE='';
                            }

                            rateIndVal.push(getData.RATE_INDEX);
                            logicVal.push(TAXLOGIC);
                            staticVal.push(staticIND);
                            rateVal.push(getData.TAX_RATE);
                            tacGlCode.push(TAXGLCODE);

                            for(w=1;w<12;w++){

                              var rate      = rateVal[w];
                              var indicator = rateIndVal[w];
                              var logic     = logicVal[w];
                              var static    = staticVal[w];
                              var glCode    = tacGlCode[w];

                              var fSlno = parseInt(w) + parseInt(1);

                              if(logic == null){

                              }else{
                                if(logic.length >0 || logic.length ==0){

                                 indicatorCalculationDirect(indicator,rate,logic,fSlno,sl_No,glCode);

                                }
                              }

                              if(indicator == 'R'){

                                  var amntF_R =  parseFloat(dispatchQTY) * parseFloat(rate);

                                  $('#FirstBlckAmntR_'+sl_No+"_"+w).val(amntF_R);
                              }else{}

                            } /* /.for loop*/
                            
                          }

                        }); /*/. data tax*/

                      } /* /.for loop*/

                    }/* /. DATA */

                  }/* /. SUCCESS CODN*/

              }, /* SUCCESS FUN*/

              complete: function() {
                console.log('end spinner');
                $('.modalspinner').addClass('hideloaderOnModl');
              },

        }); /* /.AJAX*/


    });

    


/* ------ START : CHECK BOX CLICK ------*/

    function indicatorCalculationDirect(indicator,rate,logic,l,incNum,glCode){

     // console.log('logic ',logic);

      var totalLogicVal = 0;

      if(logic.length >0){

        logicVal= "";

        for(j=1; j<=logic.length; j++)

        {

          k = logic.substring(j-1,j);

          var BlocValue = $("#FirstBlckAmntR_"+incNum+"_"+k).val();

          if(BlocValue!="")

            totalLogicVal = parseFloat(totalLogicVal) + parseFloat(BlocValue);

        }

      }

      if(indicator == 'A'){
        roundofrate= ((parseFloat(totalLogicVal) * rate)/100);
        roundof= Math.round(roundofrate) - parseFloat(totalLogicVal);
           $("#FirstBlckAmntR_"+incNum+"_"+l).val(roundof.toFixed(2));
   
      }

      if(indicator=="N"){

          amtMinus= -((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmntR_"+incNum+"_"+l).val(amtMinus.toFixed(2));

      }

      var inde_M_amt = parseFloat($("#FirstBlckAmntR_"+incNum+"_"+l).val());
      //console.log('inde_M_amt',inde_M_amt);
      if(isNaN(inde_M_amt)){
        indm = '';
        $("#FirstBlckAmntR_"+incNum+"_"+l).val(indm);
      }else{

        if(indicator=="M"){
          var lumMinus; 

          lumMinus= parseFloat($("#FirstBlckAmntR_"+incNum+"_"+l).val()); 

          if(lumMinus > 0){
            var indicatorMAmt1=  -(lumMinus);
          }else if(lumMinus < 0){
            var indicatorMAmt1=  (lumMinus);
          }
          // indicatorMAmt=  -(parseFloat(indicatorMAmt) +  amtMinus);
            indicatorMAmt = indicatorMAmt1;
           $("#FirstBlckAmntR_"+incNum+"_"+l).val(indicatorMAmt);

        }
      }

      if(indicator=="P"){

          addition = ((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmntR_"+incNum+"_"+l).val(addition.toFixed(2));

      }

      if(indicator=="Q"){

         additionRoundOff = ((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmntR_"+incNum+"_"+l).val(Math.round(additionRoundOff.toFixed(2)));

      }

      if(indicator=="Z"){

        //console.log('totalLogicVal',totalLogicVal);

          subtotalview = ((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmntR_"+incNum+"_"+l).val(subtotalview.toFixed(2));

      }
    
      if(indicator=="O"){

          deductionRoundOff = -((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmntR_"+incNum+"_"+l).val(Math.round(deductionRoundOff.toFixed(2)));

      }

      var crAmt =0;
      if(l == 2){
        var basicAmt =$('#basic'+incNum).val();
        if(indicator == 'Z'){}else{

          //if(glCode ==''){
            var amnt = $("#FirstBlckAmntR_"+incNum+"_"+l).val();
            if(amnt == ''){
              var calAmt = 0;
            }else{
              var calAmt = amnt;
            }
            crAmt = parseFloat(basicAmt)+parseFloat(calAmt);
            $("#cr_amtbytax_"+incNum).val(crAmt.toFixed(2));
          //}
        }
      }else{
        if(indicator == 'Z'){}else{
          //if(glCode ==''){
            var amntF = $("#FirstBlckAmntR_"+incNum+"_"+l).val();
            var crGet = $("#cr_amtbytax_"+incNum).val();
            if(amntF == ''){
              var cal_amt =0;
            }else{
              var cal_amt =amntF;
            }
           crAmtcal =  parseFloat(crGet)+parseFloat(cal_amt);
           $("#cr_amtbytax_"+incNum).val(crAmtcal.toFixed(2));
          }
        //}
      }

      var taxRwCount = $('#data_count'+incNum).val();

      var getGrandAmt = $("#FirstBlckAmntR_"+incNum+"_"+taxRwCount).val();
      $('#grandTot'+incNum).val(getGrandAmt);
    
      var dataCl =0;
     $(".grandAmountCls").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            dataCl += parseFloat(this.value);
        }
        //console.log('dataCl',dataCl);
      $("#allgrandAmt").val(dataCl.toFixed(2));

      var totlGrandAmt = $("#allgrandAmt").val();
      var basicTotalAmt = $("#basicTotal").val();

      var otherAmnt = parseFloat(totlGrandAmt) - parseFloat(basicTotalAmt);
      $("#otherTotalAmt").val(otherAmnt.toFixed(2));

    });
      
  } /*function close*/
  
</script>

@endsection