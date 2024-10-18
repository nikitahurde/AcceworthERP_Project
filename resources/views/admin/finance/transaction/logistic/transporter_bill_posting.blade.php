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
      Transporter Purchase Bill Posting
      <small> : Report Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report</a></li>

      <li><a href="{{ url('/dashboard') }}">Logistic</a></li>

      <li class="active"><a href="{{ url('/report/purchase/purchase-indent-report') }}">Transporter Purchase Bill Posting.</a></li>

    </ol>

  </section><!-- --sectio -->

  <section class="content" style="min-height: 150px;margin-bottom: -26px;">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Transporter Purchase Bill Posting</h2>

        <div class="box-tools pull-right">

          <a href="{{ url('/logistic/transaction/view-transporter-bill-posting') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Freight Purchase Bill</a>

        </div>

      </div><!-- /.box-header -->

      <div class="box-body">

        <?php date_default_timezone_set('Asia/Kolkata'); ?>

        <div class="row">

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1"> Vr. Date : </label>

              <div class="input-group">

                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
              
                <input type="text" name="vr_date" id="vr_date" class="form-control toDatePc rightcontent datepicker" placeholder="Select Date" value="<?php echo date('d-m-Y'); ?>" autocomplete="off">

              </div>

              <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>

              <small id="showVrDtErr"></small>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1"> From Date : </label>

              <div class="input-group">

                <div class="input-group-addon">

                  <i class="fa fa-calendar"></i>

                </div>
              
                <?php

                   $From_date = date("d-m-Y", strtotime($fromDate));
                   $To_date = date("d-m-Y", strtotime($toDate));

                  ?>

                <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $From_date }}">
                <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $To_date }}">
                <input type="text" name="from_date" id="from_date" class="form-control fromDatePc rightcontent datepicker" placeholder="Select From Date" value="<?php echo $From_date; ?>" autocomplete="off">

              </div>

              <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>

              <small id="showFrmDtErr"></small>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1"> To Date : </label>

              <div class="input-group">

                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
              
                <input type="text" name="to_date" id="to_date" class="form-control toDatePc rightcontent datepicker" placeholder="Select To Date" value="<?php echo date('d-m-Y'); ?>" autocomplete="off">

              </div>

              <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>

              <small id="showToDtErr"></small>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Trans Code : <span class="required-field"></span></label>

              <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                  </div>

                  <input type="text" id="trans_code" name="trans_code" class="form-control  pull-left" value="<?= $tran_list->TRAN_CODE ?>" placeholder="Select Trans Code" readonly autocomplete="off">

              </div>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Series Code : <span class="required-field"></span></label>

              <div class="input-group">

                <?php if($series_list){  ?>
                  
                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                  </div>

                   <input type="text" id="series_code" name="series_code" class="form-control  pull-left" value="<?= $series_list->SERIES_CODE ?>" placeholder="Select Series Code" readonly>

                   <input type="hidden" id="seriesGlCd" name="seriesGlCd" class="form-control  pull-left" value="<?= $series_list->POST_CODE ?>"  readonly>

                   <input type="hidden" id="seriesGlName" name="seriesGlName" class="form-control  pull-left" value="<?= $series_list->POST_NAME ?>"  readonly>

                <?php } ?>

              </div>

              <input type="hidden" id="pfct_code" name="pfct_code" class="form-control  pull-left" value=""  readonly>

              <input type="hidden" id="pfct_name" name="pfct_name" class="form-control  pull-left" value=""  readonly>

              <input type="hidden" id="vrdate" name="vrdate" class="form-control  pull-left" value=""  readonly>
              <small id="shwoErrSeriesCd"></small>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Series Name : <span class="required-field"></span></label>

              <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                  </div>

                   <?php if($series_list){  ?>
                   <input type="text" id="series_name" name="series_name" class="form-control  pull-left" value="<?= $series_list->SERIES_NAME ?>" placeholder="Select Series Name" readonly>

                 <?php } ?>

              </div>

            </div>

          </div><!-- /.col -->
          
        </div><!-- /.row -->

        <div class="row">

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

                    <small id="shwoErrItemCode"></small>

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

          <div class="col-md-2">

            <div class="form-group">

              <label> Vehicle Type : <span class="required-field"></span> </label>

              <div class="input-group">

                <input type="radio" class="optionsRadios1" name="vehicle_type" onchange="vehicleTypeFun()" value="SELF" disabled="">&nbsp;SELF &nbsp;&nbsp;

                <input type="radio" class="optionsRadios1" name="vehicle_type" value="MARKET" onchange="vehicleTypeFun()" checked>&nbsp;&nbsp;MARKET

              </div>
              <input type="hidden" name="vehicleTypeset" id="vehicleTypeset" value="MARKET">
              <small id="emailHelp" class="form-text text-muted">

                  {!! $errors->first('vehicle_type', '<p class="help-block" style="color:red;">:message</p>') !!}

              </small>

            </div>

          </div>

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

              <div class="input-group">

                <input list="vehicleList" name="vehicle_no" id="vehicle_no" class="form-control" onchange="getAccVehicle();" placeholder="Vehicle No" autocomplete="off">

                <datalist id="vehicleList">

                  <?php foreach ($vehicle_list as $key) { ?>

                     <option value="<?= $key->VEHICLE_NO ?>" data-xyz="<?= $key->VEHICLE_NO ?>"><?= $key->VEHICLE_NO ?> - <?= $key->ACC_NAME ?> - <?= $key->TO_PLACE ?></option>
                      
                  <?php } ?>
                 
                </datalist>

              </div>
              <small id="shwoErrVehicleNo"></small>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>

              <div class="input-group">

                <div class="input-group-addon">
                  <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                </div>
                <input list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Account Code" autocomplete="off">

                <datalist id="accountList">

                  <option selected="selected" value="">-- Select --</option>

                  <?php foreach ($acc_list_data as $key) { ?>

                     <option value="<?= $key['TRANSPORT_CODE'] ?>" data-xyz="<?= $key['TRANSPORT_NAME'] ?>"><?= $key['TRANSPORT_NAME'] ?> - <?= $key['VEHICLE_NO'] ?> - <?= $key['TO_PLACE'] ?></option>
                      
                  <?php } ?>


                </datalist>

              </div>
              <input type="hidden" id="tdsOfAccCode" name="tdsOfAccCode">
              <small>  
                <div class="pull-left showSeletedName" id="accountText"></div>
              </small>
              <small id="shwoErrAccCd"></small>

            </div>

          </div><!-- /.col -->

        
        </div><!-- /.row -->

        <div class="row">

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Account Name : <span class="required-field"></span></label>

              <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                  </div>

                   <input type="text" id="acct_name" name="acct_name" class="form-control  pull-left" value="{{ old('acct_name')}}" placeholder="Select Account Name" autocomplete="off" readonly="">

              </div>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Post Code : <span class="required-field"></span></label>

                <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input list="postCodeList" id="post_code" name="post_code" class="form-control  pull-left" value="" placeholder="Select Post Code" autocomplete="off">

                    <datalist id="postCodeList">
                      
                    </datalist>

                   <!--  <input type="hidden" id="post_name" name="post_name" class="form-control  pull-left" value="" placeholder="Select Post Name" autocomplete="off"> -->

                </div>

                <small id="shwoErrPostCd"></small>
            </div>

          </div><!-- /.col  -->

           <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Post Name : <span class="required-field"></span></label>

                <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input type="text" id="post_name" name="post_name" class="form-control  pull-left" value="" placeholder="Select Post Code" autocomplete="off">


                </div>

              
            </div>
          </div>

          <div class="col-md-2">

            <div class="form-group">

              <label>Tax Code : <span class="required-field"></span></label>

              <div class="input-group">

                <div class="input-group-addon">
                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                </div>
                <input type="hidden" name="pertText" id="pertText">
                <input list="taxList"  id="taxCode" name="taxCode" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Tax Code"> 

                <datalist id="taxList">

                  <option selected="selected" value="">-- Select --</option>
                  @foreach ($taxList as $key)
                  <option value='<?php echo $key->TAX_CODE?>'   data-xyz ="<?php echo $key->TAX_NAME; ?>" ><?php echo $key->TAX_NAME ; echo " [".$key->TAX_CODE."]" ; ?></option>
                  @endforeach

                </datalist>
                    
              </div>
              <small id="shwoErrTaxCode"></small>

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

          <div class="col-md-2"></div>

        </div>

        <div class="row">

          <div class="col-md-5"></div>
          <div class="col-md-2">

            <div style="margin-top: 5%;">

              <button type="button" class="btn btn-primary btn-sm" name="searchdata" id="btnsearch" style="padding:0px 2px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

              <button type="button" class="btn btn-warning btn-sm" name="searchdata" onClick="window.location.reload();" id="ResetIds" style="padding:0px 2px;" >&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

            </div>

          </div>

          <div class="col-md-5"><div style="margin-top: 3%;font-weight: 600;"><span id="shwoErrSeriesGl"></span></div></div>
          
        </div>

      </div><!-- /.box-body -->

    </div><!-- /.custom box -->

<!----- START : TAX CALC MODAL -------->

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

<!----- END : TAX CALC MODAL -------->

<!-- ------ SIMULATION MODAL ------------  -->
  
  <div class="modal fade in" id="simulation_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">

    <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">

      <div class="modal-content" style="border-radius: 5px;">

        <div class="modal-header">

          <div class="row">

            <div class="col-md-12">

              <h5 class="modal-title settaxcodemodel" style="text-align: center;" id="exampleModalLabel">Simulation A/c Ledger</h5>

            </div>

          </div>

          <div class="modal-body table-responsive">

            <table class="table tdthtablebordr" border="1" cellspacing="0"  id="siml_body">
              
            </table>
            
            <center><button type="button" class="btn btn-primary " style="width: 10%;" data-dismiss="modal">Ok</button>
           </center>

          </div>

        </div>

      </div>

    </div>

  </div>

<!-- ------ SIMULATION MODAL ------------  -->

</section>

<section class="content">

  <div class="box box-primary Custom-Box">

    <form id="purchaseFreightBillForm">

      <div class="box-header with-border" style="text-align: center;"></div>

      <div class="box-body" style="margin-top: -2%;">

        <div class="modalspinner hideloaderOnModl"></div>
        
        <table id="TransportBillTable" class="table table-bordered table-striped table-hover">

          <thead class="theadC">

            <tr>
              <th class="text-center">Sr.No</th>
              <th class="text-center">Vehicle No</th>
              <th class="text-center">Transporter </th>
              <th class="text-center">Lr No</th>
              <th class="text-center">To Place</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Freight Rate</th>
              <th class="text-center">Freight Amount</th>
              <th class="text-center">Add/Less Chareges</th>
              <th class="text-center">Basic Amount</th>
              <th class="text-center">Adv Amount</th>
              <th class="text-center">Net Amount</th>      
            </tr>

          </thead>

          <tbody id="defualtSearch">

          </tbody>
   
          <tfoot align="right">
            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
          </tfoot>

        </table>

        <div class="row">

          <!-- <div class="col-md-1">
           
            <div style="display: inline-flex;margin-top: 10px;">
            
              <label>&nbsp;</label>
              <button type="button" class="btn btn-primary btn-xs" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1);getGrandTotal(1);" disabled>Calc Tax </button>
              <input type="hidden" value="0" name="taxDataCount" id="data_count1">
              <div id="aplytaxOrNot1" class="aplynotStatus"></div>
              <div id="cancelbtn1"></div>
              <div id="appliedbtn1" style="margin-top: 6px;"></div>
            </div>
            
          </div>   -->                

          <div class="col-md-1">
            
            <div style="display: inline-flex;margin-top: 10px;">
              <label>&nbsp;</label>
              <button type="button" class="btn btn-primary btn-xs tdsratebtnHide" id="tds_rate" data-toggle="modal" data-target="#tdsrate_cal_model" onclick="CalculateTdsRate(1)" disabled>Calc TDS</button>
              <div id="tdsappliedbtn1" class="applyBTn"></div>
              <div id="tdscanclebtn1" class="applyBTn"></div>
              <input type="hidden" name="GettdsCode" id="GettdsglCode">
              <input type="hidden" value='0' id=isTdsAply>
              <input type="hidden" id=tdsdeductAmt>
              <input type="hidden" id=netAmtFortds>
            </div>
          </div>

          <div class="col-md-6"></div>
          <div class="col-md-3">
            <div><small style="font-size: 14px;font-weight: 800;">TDS Amt&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</small><small style="font-weight: 700;" id="nexttdsTot"></small></div>
            <div><small style="font-size: 14px;font-weight: 800;">Net Amt After TDS&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</small><small style="font-weight: 700;" id="nextAmtTot"></small></div>
            <div><small style="font-size: 14px;font-weight: 800;">&nbsp;</small></div>
          </div>

          <div class="col-md-2" style="margin-top: -20px;margin-left: -20px;">

              <div>
                <small style="font-size: 14px;font-weight: 800;">Basic Total&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</small>
                <small id="basicTotalAmt" style="font-weight: 700;"></small>
              </div>
              <div><small style="font-size: 14px;font-weight: 800;">Other Total&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</small><small style="font-weight: 700;" id="otherTotalF"></small></div>
              <div><small style="font-size: 14px;font-weight: 800;">Grand Total&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;</small><small style="font-weight: 700;" id="grand_TotalF"></small><input type="hidden" name="getGrandTot" value="" id="getGrandTotId"></div>

          </div>
              
        </div>


  <!------- MODAL FOR CALCULATE TDS ------------>

      <div class="modal fade" id="tdsrate_cal_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document" style="margin-top: 13%;">
          <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
              <h5 class="modal-title modltitletext" id="exampleModalLabel">Calculate TDS</h5>
            </div>
            <div class="modal-body">
              <div class="row tdsInputBox">
                  <div class="col-md-6">
                    <label class="textSizeTdsModl">Tds Section</label>
                    
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="inputBoxT" id="tds_name1" name="tds_section[]" value="" style="margin-bottom:3px;" readonly>
                  </div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-6">
                    <label class="textSizeTdsModl">Tds Rate</label>
                    
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="inputBoxT" id="tdsRate1" name="tdsRates" readonly style="text-align: right;margin-bottom:3px;">
                  </div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-6">
                    <label class="textSizeTdsModl" style="line-height: 0.7;">Tds Base Amount</label>
                    
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="tds_base_Amt1" name="baseTDSAmt[]" value="">
                    <input type="text" class="inputBoxT" id="Net_amount1" readonly style="text-align: right;margin-bottom:3px;">
                  </div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-6">
                    <label class="textSizeTdsModl" style="line-height: 0.7;">Tds Amount calculate</label>
                    
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="inputBoxT" id="tds_Amt_cal1" readonly style="text-align: right;margin-bottom:3px;">
                  </div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-6">
                    <label class="textSizeTdsModl">Net Amount</label>
                    
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="inputBoxT" id="deduct_tds_Amt1" readonly name="base_amt_tds[]" style="text-align: right;margin-bottom:3px;">
                  </div>
              </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-primary" data-dismiss="modal" id="ApplyTds1" onclick="Applytds(1)">Apply TDS</button>
              <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="cancleBtntds(0)">Cancle</button>
            </div>
          </div>
        </div>
      </div>

  <!------- MODAL FOR CALCULATE TDS ------------>


  <!-- ~~~~~~~~~~~~ Hidden Fields ~~~~~~~~~~~~~~~~~ -->
    
    <input type="hidden" id="trans_codeID" name="trans_code" value="" />
    <input type="hidden" id="series_codeID" name="series_code" value="" />
    <input type="hidden" id="series_nameID" name="series_name" value="" />
    <input type="hidden" id="seriesGlCdID" name="seriesGlCd" value="" />
    <input type="hidden" id="seriesGlNameID" name="seriesGlName" value="" />
    <input type="hidden" id="post_codeID" name="post_code" value="" />
    <input type="hidden" id="taxCodeID" name="taxCode" value="" />
    <!-- <input type="hidden" id="GettdsglCodeID" name="GettdsglCode" value="" /> -->
    <input type="hidden" id="pfct_codeID" name="pfct_code" value="" />
    <input type="hidden" id="pfct_nameID" name="pfct_name" value="" />
    <input type="hidden" id="vr_dateID" name="vr_date" value="" />
    <!-- <input type="hidden" id="pdfYesNoStatusID" name="pdfYesNoStatus" value="" /> -->
    <input type="hidden" id="isTdsAplyID" name="isTdsAply" value="" />
    <!-- <input type="hidden" id="tdsdeductAmtID" name="tdsdeductAmt" value="" /> -->
    <!-- <input type="hidden" id="tdsRate1ID" name="tdsRate1" value="" /> -->

    <input type="hidden" id="acct_nameID" name="acct_name" value="" />
    <input type="hidden" id="from_dateID" name="from_date" value="" />
    <input type="hidden" id="to_dateID" name="to_date" value="" />
    <input type="hidden" id="itemCodeID" name="itemCode" value="" />
    <input type="hidden" id="vehicle_typeID" name="vehicle_type" value="" />
    <input type="hidden" id="vehicle_noID" name="vehicle_no" value="" />
    <input type="hidden" id="acct_codeID" name="acct_code" value="" />
    <input type="hidden" id="itemNameID" name="itemName" value="" />
   
  <!-- ~~~~~~~~~~~~ ./ Hidden Fields ~~~~~~~~~~~~~~~~~ -->
        

        <div class="row">

            <input type="hidden" name="basicValue" id="basic">
            <input type="hidden"  name="NetAmnt"  id="getNetAmnt">
            <input type="hidden"  name="gstNetAmnt"  id="getgstNetAmnt">

            <div class="col-md-12" style="text-align: center;">

              <button class="btn btn-primary" type="button" id="simulation" onclick="billSimulation()"  style="font-size: 12px;line-height: 1;padding: 4px;" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Simulation</button>

              <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">

               <button type="submit" name="submit" value="submit" id="submitinparty" class='btn btn-success btn-sm' onclick="submitBillGenerate(0)" disabled="" style="font-size: 12px;line-height: 1;padding: 4px;">Save</button> 

              <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();" style="font-size: 12px;line-height: 1;padding: 4px;"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

              <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitBillGenerate(1)" disabled style="font-size: 12px;line-height: 1;padding: 4px;"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button>
            </div>

        </div>

      </div><!-- /.box-body -->
  </form>
        
  </div><!-- /.custom box -->

</section><!-- /.section -->

</div>


 
@include('admin.include.footer')

<script type="text/javascript">

  /* ---------- VEHICLE TYPE CHANGE ----------- */

  function vehicleTypeFun(){

    var vehicle_Type = $("input[type='radio'][name='vehicle_type']:checked").val();
    $('#vehicleTypeset').val(vehicle_Type);

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url:"{{ url('/finance/get-post-code-by-account-code') }}",

        method : "POST",

        type: "JSON",

        data: {vehicle_Type:vehicle_Type},

        success:function(data){
         
          var data1 = JSON.parse(data);
                
          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
          }else if(data1.response == 'success'){

            if(data1.data_vehicle_list==''){
                
            }else{
              $("#vehicleList").empty();
              $.each(data1.data_vehicle_list, function(k, getData){

                $("#vehicleList").append($('<option>',{

                  value:getData.VEHICLE_NO,

                  'data-xyz':getData.VEHICLE_NO,
                  text:getData.VEHICLE_NO+' - '+getData.ACC_NAME+' - '+getData.TO_PLACE

                }));
                
              });

            }

          }/* -- /. success codn*/

        } /* --- /. success function*/

    });


  }

  /* ---------- VEHICLE TYPE CHANGE ----------- */

  /* ---------------- when click on cal tds button ------------- */

  function CalculateTdsRate(TdsId){   
   
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var tdsCode    = $('#tdsOfAccCode').val();
    var acCode     = $('#acct_code').val();

    $.ajax({

        url:"{{ url('/tds-rate-calculate') }}",

        method : "POST",

        type: "JSON",

        data: {tdsCode: tdsCode,acCode:acCode},

        success:function(data){

          var data1 = JSON.parse(data);
                               
          if (data1.response == 'error') {

              $('#tdsrate_cal_model').modal('toggle'); 

              $('#tds_rate'+TdsId).prop('disabled',true);

              $('#appliedbtn'+TdsId).html('<small class="label label-danger">TDS Not Found...!</small></div>');                      

          }else if(data1.response == 'success'){

              $('#tds_name'+TdsId).val(data1.tds_name[0].TDS_CODE+' - '+data1.tds_name[0].TDS_NAME);
              $('#GettdsglCode').val(data1.tds_name[0].GL_CODE);
              $('#tdsRate'+TdsId).val(data1.data[0].TDS_RATE);

              var amount =  parseFloat($('#basic').val());
              console.log('amount',amount);
              $('#tds_base_Amt'+TdsId).val(amount);
              $('#Net_amount'+TdsId).val(amount);
              
              var tdsRateval = parseFloat($('#tdsRate'+TdsId).val());
              var tdsbaseamtval = parseFloat($('#tds_base_Amt'+TdsId).val());

              var calculatPercnt = tdsbaseamtval / 100 * tdsRateval;

              $('#tds_Amt_cal'+TdsId).val(calculatPercnt.toFixed(2));
              var deductBAmtWTdsAmt = tdsbaseamtval - parseFloat(calculatPercnt);
              $('#deduct_tds_Amt'+TdsId).val(deductBAmtWTdsAmt.toFixed(2));
              
          }
        }

    });  
  }

  function Applytds(aply){
    $('#isTdsAply').val(aply);

    var cutTdsAmt = $('#tds_Amt_cal1').val();
    var basicAmtAfterTdsCut = $('#deduct_tds_Amt1').val();
    var getAdvAmt        = $('#getAdvAmt').val();
    var nextAmtTot        = $('#Net_amount1').val();

    /*var netAmtAfterTds   = parseFloat(nextAmtTot) - parseFloat(getAdvAmt);*/

    var netAmtAfterTdsTax   = parseFloat(nextAmtTot) - parseFloat(cutTdsAmt);

    var netAmtAfterTds   = parseFloat(netAmtAfterTdsTax) - parseFloat(getAdvAmt);

 //   alert(netAmtAfterTdsTax);

    var tdsAplyVal = $('#isTdsAply').val();

    if(tdsAplyVal == 1){
      $('#tdsdeductAmt').val(cutTdsAmt);
      $('#totalAmtForTDS').val(basicAmtAfterTdsCut);
      $('#nextAmtTot').text(netAmtAfterTdsTax.toFixed(2));
      $("#getNetAmnt").val(netAmtAfterTdsTax);
      $('#totNetAmtAfterTds').text(netAmtAfterTds.toFixed(2));
      $('#nexttdsTot').text(cutTdsAmt);
      $('#nexttdsTot1').text(cutTdsAmt);
      $('#tdsappliedbtn1').html('<small class="label label-success iconBtnSty"><i class="fa fa-check"></i></small>');
      $('#tdscanclebtn1').html('');
    }

  }

  function cancleBtntds(cancle){
    $('#isTdsAply').val(cancle);
    $('#tdsdeductAmt').val(cancle);
    $('#totalAmtForTDS').val(cancle);
    $('#nextAmtTot').val(cancle);
    $('#tdscanclebtn1').html('<small class="label label-danger iconBtnSty"><i class="fa fa-times"></i></small>');
    $('#tdsappliedbtn1').html('');

    $('#getNetAmnt,#totNetAmtAfterTds,#nexttdsTot1').val('0');
    $('#nexttdsTot,#nextAmtTot,#totNetAmtAfterTds,#nexttdsTot1').html('');

  }

/* ---------------- when click on cal tds button ------------- */
  
  $("#acct_code").on('change', function () {  

    var val = $(this).val();
    var acc_code = $("#acct_code").val();
    var vehicle_Type = $("input[type='radio'][name='vehicle_type']:checked").val();

    var xyz = $('#accountList option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){

      $("#acct_code").val('');
      $("#acct_name").val('');
      $("#post_code").val('');
      $("#post_name").val('');
      $("#post_name_text").html('');
      $("#pfct_code").val('');
      $("#pfct_name").val('');
      $("#vrdate").val('');
       $('#tds_rate').addClass('tdsratebtnHide');

    }else{
      $('#tds_rate').removeClass('tdsratebtnHide');

      $("#acct_name").val(msg);

        $.ajax({

          url:"{{ url('/finance/get-post-code-by-account-code') }}",

          method : "POST",

          type: "JSON",

          data: {acc_code:acc_code,vehicle_Type:vehicle_Type},

          success:function(data){
           
            var data1 = JSON.parse(data);
                  
            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
            }else if(data1.response == 'success'){

              if(data1.trip_data==''){
                  $("#pfct_code").val('');
                  $("#pfct_name").val('');
                  $("#vrdate").val('');
              }else{
                  $("#pfct_code").val(data1.trip_data.PFCT_CODE);
                  $("#pfct_name").val(data1.trip_data.PFCT_NAME);
                  $("#vrdate").val(data1.trip_data.VRDATE);
              }

              if(data1.data==''){

              }else{
                var post_code = data1.data.GL_CODE;
                var post_name = data1.data.GL_NAME;
                console.log('post_code',data1.data.GL_NAME);

                $('#tdsOfAccCode').val(data1.data.TDS_CODE);

                if(post_code==null || post_code==''){

                    $.each(data1.multiple_data, function(k, getData){

                      $("#postCodeList").append($('<option>',{

                        value:getData.GL_CODE,

                        'data-xyz':getData.GL_NAME,
                        text:getData.GL_CODE

                      }));
                      
                    })

                   $("#post_code").prop('readonly',false);

                }else{

                  $("#post_code").val(post_code);
                  $("#post_name").val(post_name);
                  $("#post_code").prop('readonly',true);

                }
              }
                console.log('data_tds',data1.data_tds);

              if(data1.data_tds == ''){
               $('#tds_rate').addClass('tdsratebtnHide');
              }else{
                $('#tds_rate').removeClass('tdsratebtnHide');
              }

            }/* -- /. success codn*/

          } /* --- /. success function*/

        });

    } 

  });


  function getAccVehicle(){

      var val = $("#vehicle_no").val();

      var xyz = $('#vehicleList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      console.log('msg',msg);
      if(msg=='No Match'){
        $("#vehicle_no").val('');
        $("#acct_code").val('');
        $("#acct_name").val('');
        $("#pfct_code").val('');
        $("#pfct_name").val('');
        $("#vrdate").val('');
        $("#post_code").val('');
        $("#post_name").val('');
        $("#post_name_text").html('');
        $('#tds_rate').addClass('tdsratebtnHide');
        $('#vehicle_no').prop('readonly',false);
        $('#vehicle_no').css('border-color','#ff0000').focus();

      }else{

          $('#vehicle_no').css('border-color','#d4d4d4');
          $('#taxCode').css('border-color','#ff0000').focus();
          $('#vehicle_no').prop('readonly',true);
          $('#shwoErrVehicleNo').html('');


          $('#tds_rate').removeClass('tdsratebtnHide');

          var vehicle_no = $("#vehicle_no").val();
          var vehicle_Type = $("input[type='radio'][name='vehicle_type']:checked").val();

          $.ajax({

            url:"{{ url('/finance/get-post-code-by-vehicle') }}",

            method : "POST",

            type: "JSON",

            data: {vehicle_no:vehicle_no,vehicle_Type:vehicle_Type},

            success:function(data){
            
              var data1 = JSON.parse(data);
                    
              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>"); 
   
                $("#acct_code").val('');
                $("#acct_name").val('');
                $("#pfct_code").val('');
                $("#pfct_name").val('');
                $("#vrdate").val('');
                $("#post_code").val('');
                $("#post_name").val('');
                $("#post_name_text").html('');

              }else if(data1.response == 'success'){

                if(data1.data_acc_list == ''){

                }else{

                  if(vehicle_Type == 'SELF'){

                    $("#accountList").empty();
                    $.each(data1.data_acc_list, function(k, getData){

                      $("#accountList").append($('<option>',{

                        value:getData.ACC_CODE,
                        'data-xyz':getData.ACC_NAME,
                        text:getData.ACC_NAME

                      }));
                            
                    });

                  }else if(vehicle_Type == 'MARKET'){

                    console.log('transporter',data1.data_acc_list.TRANSPORT_CODE);

                    $("#acct_code").val(data1.data_acc_list.TRANSPORT_CODE);
                    $("#acct_name").val(data1.data_acc_list.TRANSPORT_NAME);

                    //$("#accountList").empty();

                   /* $.each(data1.data_acc_list, function(k, getData){

                      $("#accountList").append($('<option>',{

                        value:getData.TRANSPORT_CODE,
                        'data-xyz':getData.TRANSPORT_NAME,
                        text:getData.TRANSPORT_NAME+' - '+getData.VEHICLE_NO+' - '+getData.TO_PLACE

                      }));
                            
                    });*/

                  }
                  
                }

                 if(data1.trip_data==''){
                  $("#pfct_code").val('');
                  $("#pfct_name").val('');
                  $("#vrdate").val('');
              }else{
                  $("#pfct_code").val(data1.trip_data.PFCT_CODE);
                  $("#pfct_name").val(data1.trip_data.PFCT_NAME);
                  $("#vrdate").val(data1.trip_data.VRDATE);
              }

              if(data1.data==''){

              }else{
                var post_code = data1.data.GL_CODE;
                var post_name = data1.data.GL_NAME;
                console.log('post_code',data1.data.GL_NAME);

                $('#tdsOfAccCode').val(data1.data.TDS_CODE);

                if(post_code==null || post_code==''){

                    $.each(data1.multiple_data, function(k, getData){

                      $("#postCodeList").append($('<option>',{

                        value:getData.GL_CODE,

                        'data-xyz':getData.GL_NAME,
                        text:getData.GL_CODE

                      }));
                      
                    })

                   $("#post_code").prop('readonly',false);

                }else{

                  $("#post_code").val(post_code);
                  $("#post_name").val(post_name);
                  $("#post_code").prop('readonly',true);

                }
              }
                console.log('data_tds',data1.data_tds);

              if(data1.data_tds == ''){
               $('#tds_rate').addClass('tdsratebtnHide');
              }else{
                $('#tds_rate').removeClass('tdsratebtnHide');
              }

              }/* -- /. success codn*/

            } /* --- /. success function*/

        });/* /.ajax*/
      }

      

  }

  $('#taxCode').on('change',function(){

      var taxCd =  $('#taxCode').val();
      var xyz = $('#taxList option').filter(function() {

        return this.value == taxCd;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#taxCode').val('');
        $('#tax_name').val('');
        $('#CalcTax1').prop('disabled',true);
        $('#taxCode').prop('readonly',false);
        $('#taxCode').css('border-color','#ff0000').focus();
      }else{
        $('#tax_name').val(msg);
        $('#CalcTax1').prop('disabled',false);
        $('#taxCode').css('border-color','#d4d4d4');
        $('#btnsearch').css('border-color','#ff0000').focus();
        $('#taxCode').prop('readonly',true);
        $('#shwoErrTaxCode').html('');
      }

    });

    $('#post_code').on('change',function(){

      var taxCd =  $('#post_code').val();

      var xyz = $('#postCodeList option').filter(function() {

        return this.value == taxCd;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){

        $('#post_code').val('');
        $('#post_name').val('');

      }else{

        $('#post_name').val(msg);
        $('#post_name_text').html(msg);
        
      }

    });

</script>

<script type="text/javascript">
  
    $(document).ready(function(){

      $('#itemCodeId').css('border-color','#ff0000').focus();

         var creditAmount = 0;
         var grandAmt = 0;
         var totlFreightAmt = 0;
       // $('#TransportBillTable').DataTable();

        $("#TransportBillTable").on('change', function() {
          var creditAmount = 0;
          var grandAmt = 0;
          var totlFreightAmt = 0;
          var totlbasicAmt = 0;
          var totladvanceAmt = 0;
          var totalAmt = 0;
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

              var vehicle_no = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[1].innerHTML;

               var freightAmt = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[7].innerHTML;
               var addlessAmt = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[8].innerHTML;

               var basicAmt = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[9].innerHTML;
               var advanceAmt = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[10].innerHTML;
              var amount = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[11].innerHTML;
      
              if (basicAmt != "") {
                creditAmount += parseFloat(basicAmt);
              } else {
                creditAmount = 0;

              }

              if (freightAmt != "") {
                totlFreightAmt += parseFloat(freightAmt);
              } else {
                totlFreightAmt = 0;

              }

              if (basicAmt != "") {
                totlbasicAmt += parseFloat(basicAmt);
              } else {
                totlbasicAmt = 0;

              }

              if (advanceAmt != "") {
                totladvanceAmt += parseFloat(advanceAmt);
              } else {
                totladvanceAmt = 0;

              }

              if (amount != "") {
                totalAmt += parseFloat(amount);
              } else {
                totalAmt = 0;

              }

            }

          // var totalAmtForTDS = parseFloat(totlFreightAmt) + parseFloat(totlbasicAmt);

            $("#totalAmtForTDS").val(totlbasicAmt.toFixed(2));
            $("#totlFreightAmt").val(totlFreightAmt.toFixed(2));
            $("#basicTotalAmt").text(creditAmount.toFixed(2));
            //$("#nextAmtTot").text(creditAmount.toFixed(2));
            $("#basic").val(creditAmount.toFixed(2));
            $("#getNetAmnt").val(totalAmt.toFixed(2));
            $("#getAdvanceAmt").text(totladvanceAmt.toFixed(2));
            $("#getAdvAmt").val(totladvanceAmt.toFixed(2));
            $("#totlNetAmt").text(totalAmt.toFixed(2));
            $("#totalNetAmt").val(totalAmt.toFixed(2));

          //  $("#netAmt").text(grandAmt.toFixed(2));
            //$("#netAmount").val(grandAmt.toFixed(2));

            var grandAmtTotl = $('#grand_TotalF').html();
            var basicAmtTotl = $('#basicTotalAmt').html();

            var othrTotl = parseFloat(grandAmtTotl) - parseFloat(basicAmtTotl);
           
            $('#otherTotalF').html(othrTotl.toFixed(2));

        });

    }); 
</script>

<script type="text/javascript">
  function billSimulation(){

    $('#simulation_model').modal('show');

    var rate_indName       = [];
    var af_rate            = [];
    var amount             = [];
    var taxGlCode          = [];
    var taxIndCode         = [];
    var freight_Amt        = [];
    var lessAdv_Charge     = [];
    var tripHead_id        = [];
    var chkIslessAdvCharge = [];
    var chkboxChecked      = [];

    $('.flitClass').each(function(){
        if($(this).is(":checked"))
        {
         var flitClass1 = $(this).val();


         chkboxChecked.push(flitClass1);
         
         }
    });

    $('input[name^="freightAmt"]').each(function (){
          freight_Amt.push($(this).val());

    });
    $('input[name^="chkIslessAdvCharge"]').each(function (){
          chkIslessAdvCharge.push($(this).val());
    });

    $('input[name^="lessAdvCharge"]').each(function (){
          lessAdv_Charge.push($(this).val());
    });

    $('input[name^="taxIndCode"]').each(function (){
          taxIndCode.push($(this).val());
    });

    $('input[name^="rate_ind"]').each(function (){
          rate_indName.push($(this).val());
    });

    $('input[name^="af_rate"]').each(function (){
          af_rate.push($(this).val());
    });

    $('input[name^="amount"]').each(function (){
          amount.push($(this).val());
    });

    $('input[name^="taxGlCode"]').each(function (){
          taxGlCode.push($(this).val());
    });

    $('input[name^="tripHeadid"]').each(function (){
          tripHead_id.push($(this).val());
    });

   // var checkZero = lessAdv_Charge.includes('0');
   // lessAdv_Charge.indexOf('0');
    
    var basicAmt       = $('#basic').val();
    

    var found = chkIslessAdvCharge.find(function (element) {
      return element == 1;
    });

    
    var vehicleType    = $('#vehicleTypeset').val();
    var taxRowCount    = $('#data_count1').val();
    var series_glCd    = $('#seriesGlCd').val();
    var post_code      = $('#post_code').val();
    var acct_code      = $('#acct_code').val();
    var acct_name      = $('#acct_name').val();
    var NetAmnt        = $('#getNetAmnt').val();
    var tdsApplChk     = $('#isTdsAply').val();
    var tds_deductAmt  = $('#tdsdeductAmt').val();
    var tds_gl_code    = $('#GettdsglCode').val();
    var tds_netAmt     = $('#netAmtFortds').val();
    var totlFreightAmt = $('#totlFreightAmt').val();
    var taxApplyChk    = $('#aplytaxOrNot1').html();
   

    if(tdsApplChk == 1){
      var partyAmt_tdsCut = tds_deductAmt;
      var partyAmt_tdsnet = tds_netAmt;
    }else{
      var partyAmt_tdsCut = totlFreightAmt;
      var partyAmt_tdsnet = 0;
    }

    if(found == 1){
      var basic_amnt = totlFreightAmt;
    }else if(found == undefined){
      var basic_amnt = basicAmt;
    }

    $.ajax({

          url:"{{ url('Transction/TransporterBill/get-simulation-data-for-trans-bil') }}",

          method : "POST",

          type: "JSON",

          data: {taxIndCode:taxIndCode,rate_indName: rate_indName,af_rate:af_rate,amount:amount,taxGlCode:taxGlCode,taxRowCount:taxRowCount,series_glCd:series_glCd,post_code:post_code,NetAmnt:NetAmnt,chkboxChecked:chkboxChecked,basic_amnt:basic_amnt,tdsApplChk:tdsApplChk,tds_deductAmt:tds_deductAmt,tds_gl_code:tds_gl_code,taxApplyChk:taxApplyChk,vehicleType:vehicleType},

          success:function(data){

            var data1 = JSON.parse(data);
                  
            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
            }else if(data1.response == 'success'){

              $('#siml_body').empty();


              var headData ="<tr><th>Gl/Acc Code</th> <th>Gl/Acc Name</th> <th>Debit-DR</th> <th>Credit-CR</th> <th>Ref Code</th> <th>Ref Name</th></tr>";

              $('#siml_body').append(headData);

              var drTotal = 0;
              var crTotal = 0;
              $.each(data1.data_tax, function(k, getData) {

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
                drTotal +=parseFloat(getData.DR_AMT);
                crTotal +=parseFloat(getData.CR_AMT);

                var bodyData = "<tr><td class='tdthtablebordr textLeft'>"+accGl+"</td>"+
                                "<td class='tdthtablebordr textLeft'>"+accglName+"</td>"+
                                "<td class='tdthtablebordr textRight'>"+getData.DR_AMT+"</td>"+
                                "<td class='tdthtablebordr textRight'>"+getData.CR_AMT+"</td>"+
                                "<td class='tdthtablebordr'>"+acct_code+"</td>"+
                                "<td class='tdthtablebordr'>"+acct_name+"</td></tr>";
                $('#siml_body').append(bodyData);
              });

              var footerData = "<tr><td colspan='2' class='tdthtablebordr textRight'><b>Total : </b></td>"+
                                "<td class='tdthtablebordr textRight'><b>"+drTotal.toFixed(2)+"</b></td>"+
                                "<td class='tdthtablebordr textRight'><b>"+crTotal.toFixed(2)+"</b></td>"+
                                "<td class='tdthtablebordr'><b>&nbsp;</b></td>"+
                                "<td class='tdthtablebordr'><b>&nbsp;</b></td></tr>";
              $('#siml_body').append(footerData);

            }/* -- /. success codn*/

          } /* --- /. success function*/

    }); /* -- /. ajax */

}

  function itemServicesCode(itemVal){

    var itemcd = $('#itemCodeId').val();
    
     var xyz = $('#itemCodeList option').filter(function() {

    return this.value == itemcd;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
   
      $('#itemCodeId').prop('readonly',false);
      $('#itemCodeId').css('border-color','#ff0000').focus();
      $('#itemNameId').val('');

    }else{
      $('#itemCodeId').css('border-color','#d4d4d4');
      $('#itemCodeId').prop('readonly',true);
      $('#vehicle_no').css('border-color','#ff0000').focus();
      $('#itemNameId').val(msg);
      $('#shwoErrItemCode').html('');
    }


  }

</script>



<script type="text/javascript">

load_data_query()
  function load_data_query(acct_code='',from_date='',to_date='',vehicle_no='',vehicle_Type=''){

   
      $('#TransportBillTable').DataTable({

          processing: true,
          serverSide: false,
          info: true,
          bPaginate: false,
          scrollY: 300,
          scroller: true,
          fixedHeader: true,
          language: {
            processing: "<img src='<?php echo url('public/dist/img/Spinner.gif') ?>'>"
          },
       
          ajax:{
            url:'{{ url("/logistic/transport-bill-posting") }}',
            data: {acct_code:acct_code,from_date:from_date,to_date:to_date,vehicle_no:vehicle_no,vehicle_Type:vehicle_Type}
          },

          columns: [

            { 
              data:"DT_RowIndex",
              name:"DT_RowIndex",
              className:"text-center",
              'render': function (data, type, full, meta){
                         return '<input type="checkbox" name="flit_id[]" onclick="clickCheck('+full['DT_RowIndex']+')" id="checkboxRow'+full['DT_RowIndex']+'" class="flitClass" value="'+full['TRIPBID']+'~'+full['VehicleNo']+'~'+full['LR_NO']+'~'+full['TO_PLACE']+'"><input type="hidden" name="tripHeadid"  value="'+full['tripHeadId']+'"><div class="taxAplyAppend" id="inputAppendTaxField'+full['DT_RowIndex']+'"></div><input type="hidden" id="data_count'+full['DT_RowIndex']+'" class="dataCountCl" value="" name="data_Count[]"><input type="hidden" id="grandTot'+full['DT_RowIndex']+'" class="grandTotalRw" value="" name="grand_Total[]"><input type="hidden" class="hidnChkChebox" id="isChkChecked'+full['DT_RowIndex']+'" name="isChkChecked[]" value="NO"><input type="hidden"  id="lrNo'+full['DT_RowIndex']+'" name="lrNo[]" value="'+full['LR_NO']+'"><input type="hidden"  id="vehicleNo'+full['DT_RowIndex']+'" name="vehicleNo[]" value="'+full['VehicleNo']+'">';
                     }
            },
            {
                data:'VehicleNo',
                name:'VehicleNo',
                className: "alignCenterClass",

                 render: function (data, type, full, meta){
                  
                  var vehicle_no = full['VehicleNo'];

                 
                 return vehicle_no;

                }
            },
            {
                data:'TRANSPORT_NAME',
                name:'TRANSPORT_NAME'
            },
            {
                data:'LR_NO',
                name:'LR_NO'
            },
            {
                data:'TO_PLACE',
                name:'TO_PLACE'
            },
            {
                className: "alignRightClass",
                render: function (data, type, full, meta){
                  var QTYR  = full['RECDQTY'];
                  var UM    = full['UM'];
                  var AUM   = full['AUM'];
                  var FPORATE   = full['FPO_RATE'];
                  var VRDATE   = full['VRDATE'];
                  return QTYR+' '+'-'+' <small class="label label-info"> '+UM+'</small><input type="hidden" name="recQty[]" value="'+QTYR+'" id="recQtyId"><input type="hidden" name="recQtyUm[]" value="'+UM+'" id="recQtyUmId"><input type="hidden" name="recQtyAum[]" value="'+AUM+'" id="recQtyAumId"><input type="hidden" name="fRate[]" value="'+FPORATE+'" id="fRateId"><input type="hidden" name="vrdate[]" value="'+VRDATE+'" id="vrdate">';
                }
            },
            {
                data:'FPO_RATE',
                name:'FPO_RATE',  
                className:'rightcontent'
            },
            {
                //FREIGHT AMOUNT QTY x FREIGHT RATE
                data:'AMOUNT',
                name:'AMOUNT',
                render: function (data, type, full, meta){
                  return full['AMOUNT']+'<input type="hidden" name="freightAmt[]" value='+full['AMOUNT']+'><input type="hidden" name="basicAmount[]" id="basicAmount'+full['DT_RowIndex']+'" value='+full['BASIC_AMT']+'><input type="hidden" id="disapatch_qty'+full['DT_RowIndex']+'" name="disapatch_qty[]" value='+full['RECDQTY']+'><input type="hidden" id="frrate'+full['DT_RowIndex']+'" name="frrate[]" value='+full['FPO_RATE']+'><input type="hidden" id="invNo" name="invNo[]" value='+full['INVC_NO']+'><input type="hidden" id="ewayBillNo" name="ewayBillNo[]" value='+full['EWAY_BILLNO']+'><input type="hidden" id="ewayBillDt" name="ewayBillDt[]" value='+full['EWAY_BILLDT']+'><input type="hidden" id="itemSlno" name="itemSlno[]" value='+full['ITEM_SLNO']+'><input type="hidden" id="ackQTY" name="ackQTY[]" value='+full['ACK_QTY']+'><input type="hidden" id="deliveryNo" name="deliveryNo[]" value='+full['DELIVERY_NO']+'><input type="hidden" id="aQtyRecd" name="aQtyRecd[]" value='+full['AQTY']+'>';
                },
                className:'rightcontent'


            },
            {
                data:'ADD_LESS_CHRG',
                name:'ADD_LESS_CHRG',
                className:'rightcontent'
            },
            {
                data:'BASIC_AMT',
                name:'BASIC_AMT',
                className:'rightcontent'
            },
             {
                data:'ADV_AMT',
                name:'ADV_AMT',
                className:'rightcontent'
            },
             {
                data:'NET_AMOUNT',
                name:'NET_AMOUNT',
                className:'rightcontent'
            },
            
           /* {
                data:'',
                render: function (data, type, full, meta){
                  var AMT     = full['AMOUNT'];
                  var NETAMOUNT = full['NET_AMOUNT'];
                  var totAmt = parseFloat(AMT) - parseFloat(NETAMOUNT);
                  return totAmt.toFixed(2);
                },
                className:'rightcontent'
            },*/
            
            
          ]


      });


   }
  

  $(document).ready(function() {

    $('#lastUpdateValueId').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });


     $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

     // endDate: 'today',
      
      autoclose: 'true'

    });


   

    $('#btnsearch').click(function(){

      var from_date    =  $('#from_date').val();
      var to_date      =  $('#to_date').val();
      var vr_date      =  $('#vr_date').val();
      var acct_code    =  $('#acct_code').val();
      var vehicle_no   =  $('#vehicle_no').val();
      var post_code    = $("#post_code").val();
      var taxCode      = $("#taxCode").val();
      var vehicle_Type = $("#vehicle_type").val();
      var series_code  = $("#series_code").val();
      var seriesGlCd   = $("#seriesGlCd").val();
      var itemCode     = $("#itemCodeId").val();
      var trans_code   = $("#trans_code").val();
      var vehicleType  = $("#vehicleTypeset").val();
      var series_name  = $("#series_name").val();
      var seriesGlName = $("#seriesGlName").val();
      var pfctcode     = $("#pfct_code").val();
      var pfctName     = $("#pfct_name").val();
      var GettdsglCode = $("#GettdsglCode").val();
      var pdfYesNoStatus = $("#pdfYesNoStatus").val();
      var isTdsAply    = $("#isTdsAply").val();
      var tdsdeductAmt = $("#tdsdeductAmt").val();
      var tdsRate1     = $("#tdsRate1").val();
      var tdsRate1     = $("#acct_name").val();
      var itemName     = $("#itemNameId").val();

      $("#vr_dateID").val(vr_date);
      $("#from_dateID").val(from_date);
      $("#to_dateID").val(to_date);
      $("#trans_codeID").val(trans_code);
      $("#series_codeID").val(series_code);
      $("#seriesGlCdID").val(seriesGlCd);
      $("#itemCodeID").val(itemCode);
      $("#vehicle_typeID").val(vehicleType);
      $("#vehicle_noID").val(vehicle_no);
      $("#acct_codeID").val(acct_code);
      $("#post_codeID").val(post_code);
      $("#taxCodeID").val(taxCode);

      $("#series_nameID").val(series_name);
      $("#seriesGlNameID").val(seriesGlName);
      $("#GettdsglCodeID").val(GettdsglCode);
      $("#pfct_codeID").val(pfctcode);
      $("#pfct_nameID").val(pfctName);
      $("#pdfYesNoStatusID").val(pdfYesNoStatus);
      $("#isTdsAplyID").val(isTdsAply);
      $("#tdsdeductAmtID").val(tdsdeductAmt);
      $("#tdsRate1ID").val(tdsRate1);
      $("#acct_nameID").val(acct_name);
      $("#itemNameID").val(itemName);


        if(vr_date!=''){
          $('#showVrDtErr').html(''); 
          if(from_date!=''){
            $('#showFrmDtErr').html('');
            if(to_date !=''){
                $('#showToDtErr').html('');
                if(series_code!=''){
                  $('#shwoErrSeriesCd').html('');
                  if(seriesGlCd !=''){
                    $('#shwoErrSeriesGl').html('');
                    if(itemCode !=''){
                      $('#shwoErrItemCode').html('');
                      if(vehicle_no !=''){
                        $('#shwoErrVehicleNo').html('');
                        if(acct_code !=''){
                          $('#shwoErrAccCd').html('');
                          if(post_code !=''){
                            $('#shwoErrPostCd').html('');
                            if(taxCode !=''){
                              $('#shwoErrTaxCode').html('');

                              $('#TransportBillTable').DataTable().destroy();

                              load_data_query(acct_code,from_date,to_date,vehicle_no,vehicle_Type);

                              $('#vr_date').prop('readonly',true);
                              $('#from_date').prop('readonly',true);
                              $('#to_date').prop('readonly',true);
                              $('#acct_code').prop('readonly',true);
                              $('#post_name').prop('readonly',true);

                            }else{

                              $('#shwoErrTaxCode').html('<p style="color:red;">*Tax Code field is required.</p>');


                            }

                          }else{

                            $('#shwoErrPostCd').html('<p style="color:red;">*Post Code field is required.</p>');

                          }

                        }else{

                          $('#shwoErrAccCd').html('<p style="color:red;">*Account Code field is required.</p>');

                        }

                      }else{

                        $('#shwoErrVehicleNo').html('<p style="color:red;">*Vehicle No. field is required.</p>');

                      }

                    }else{

                      $('#shwoErrItemCode').html('<p style="color:red;">*Item code field is required.</p>');

                    }

                  }else{

                    $('#shwoErrSeriesGl').html('<p style="color:red;">*Series GL not found, Please Check.</p>');

                  }

                }else{

                  $('#shwoErrSeriesCd').html('<p style="color:red;">*Series Code field is required.</p>');

                }

              }else{

                $('#showVrDtErr').html('<p style="color:red;">*To Date field is required.</p>');

              }

            }else{

              $('#showVrDtErr').html('<p style="color:red;">*From Date field is required.</p>');

            }

          }else{

            $('#showVrDtErr').html('<p style="color:red;">*Vr. Date field is required.</p>');

          }
     
          if (acct_code!='' || from_date!='' || to_date!='' || vehicle_no!='' || vehicle_Type!='') {

            $('#vr_date').prop('readonly',true);
            $('#from_date').prop('readonly',true);
            $('#to_date').prop('readonly',true);
            $('#acct_code').prop('readonly',true);
            $('#post_name').prop('readonly',true);
          
            

          }else{
            $('#TransportBillTable').DataTable().destroy();
            load_data_query();
            $('#vr_date').prop('readonly',false);
            $('#from_date').prop('readonly',false);
            $('#to_date').prop('readonly',false);
            $('#acct_code').prop('readonly',false);
            $('#post_name').prop('readonly',false);
            
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

$(document).ready(function() {
   
  var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker1').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date,
      autoclose: 'true'

    });

});

</script>


<script type="text/javascript">
  
  function clickCheck(slno){

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


    var checkBoxChk = $('#checkboxRow'+slno).is(":checked");;

    if(checkBoxChk){
      //alert('checkbox checked');

      $("#isChkChecked"+slno).val('YES');

      $('#tdsdeductAmt,#totalAmtForTDS,#getNetAmnt,#totNetAmtAfterTds,#nexttdsTot1').val('0');
      $('#nexttdsTot,#nextAmtTot').html('');

      $('#tdscanclebtn1').html('<small class="label label-danger iconBtnSty"><i class="fa fa-times"></i></small>');
      $('#tdsappliedbtn1').html('');
      $('#isTdsAply').val('0');

      var tax_code    = $('#taxCode').val();
      var basicAmt    = $('#basicAmount'+slno).val();
      var dispatchQTY = $('#disapatch_qty'+slno).val();
      var rate        = $('#frrate'+slno).val();

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

                    $('#data_count'+slno).val(data1.data.length);

                    var taxRwCount = $('#data_count'+slno).val();

                    for(var i=0;i<data1.data.length;i++){
                        
                        var slnoSeries = parseInt(i) + parseInt(1);
                        if(taxRwCount == slnoSeries){
                          var taxClass ='grandAmountCls';
                        }else{
                          var taxClass ='';
                        }

                        var rowSlno =parseInt(1) +parseInt(i);
                        var inputApnd = "<input type='hidden' class='"+taxClass+"' name='rowtaxAmount_"+slno+"[]' id='FirstBlckAmntR_"+slno+"_"+rowSlno+"'>";

                        $('#inputAppendTaxField'+slno).append(inputApnd);

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

                        $('#FirstBlckAmntR_'+slno+"_1").val(basicAmt);

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

                             indicatorCalculationDirect(indicator,rate,logic,fSlno,slno,glCode);

                            }
                          }

                          if(indicator == 'R'){

                              var amntF_R =  parseFloat(dispatchQTY) * parseFloat(rate);

                              $('#FirstBlckAmntR_'+slno+"_"+w).val(amntF_R);
                          }else{}

                        } /* /.for loop*/
                        
                      }

                    });/* /.each loop */  

                  }/* /. data*/

                }/*/.success codn*/

            }, /* /. success fun*/
            complete: function() {
              console.log('end spinner');
              $('.modalspinner').addClass('hideloaderOnModl');
            },

      });

    }else{
      //alert('checkbox not checked');

      $("#isChkChecked"+slno).val('NO');

      $('#tdsdeductAmt,#totalAmtForTDS,#getNetAmnt,#totNetAmtAfterTds,#nexttdsTot1').val('0');
      $('#nexttdsTot,#nextAmtTot').html('');

      $('#tdscanclebtn1').html('<small class="label label-danger iconBtnSty"><i class="fa fa-times"></i></small>');
      $('#tdsappliedbtn1').html('');
      $('#isTdsAply').val('0');

      var grandAmt      = $('#grandTot'+slno).val();
      var totalgrandAmt = $('#grand_TotalF').html();

      var newGrandAmt = parseFloat(totalgrandAmt) - parseFloat(grandAmt);

      $('#grand_TotalF').html(newGrandAmt.toFixed(2));
      $('#getGrandTotId').val(newGrandAmt.toFixed(2));

      $('#inputAppendTaxField'+slno).empty();

      /*var basicTotalAmt = parseFloat($('#basicTotalAmt').html());
      var grandTotalAmt = parseFloat($('#grand_TotalF').html());
      var otherAmtTotl  = grandTotalAmt - basicTotalAmt;
      $('#otherTotalF').html(otherAmtTotl);*/

    }


  } /* checkbox click function close */

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

      //console.log('getGrandAmt',getGrandAmt);

      /*var getgrandTotl = parseFloat($('#grand_TotalF').html());
      if(getgrandTotl == ''){
        var grandTotl =0;
      }else{
        var grandTotl =getgrandTotl;
      }*/

     // var finalGrandTot= parseFloat(grandTotl) + parseFloat(getGrandAmt);

      //$("#grand_TotalF").html(finalGrandTot.toFixed(2));

      var dataCl =0;
      $(".grandAmountCls").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            dataCl += parseFloat(this.value);
        }
        //console.log('dataCl',dataCl);
        $("#grand_TotalF").html(dataCl.toFixed(2));
        $("#getGrandTotId").val(dataCl.toFixed(2));

        var totlGrandAmt = $("#grand_TotalF").html();
        var basicTotalAmt = $("#basicTotalAmt").html();

        var otherAmnt = parseFloat(totlGrandAmt) - parseFloat(basicTotalAmt);
       
        $("#otherTotalF").html(otherAmnt.toFixed(2));

      });
      //console.log();

      //var checkedCount = $("#TransportBillTable input:checked").length;
      //console.log('checkedCount',checkedCount);

  } /*function close*/
  
</script>


  <script type="text/javascript">
    
    function submitBillGenerate(valp){  

      var downloadFlg = valp;

      $('#pdfYesNoStatus').val(downloadFlg);

        $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        var data = $("#purchaseFreightBillForm").serialize();

        $.ajax({

            url:"{{ url('save-party-bil') }}",

            method : "POST",

            type: "JSON",

            data: data,

            success:function(data){

              console.log(data);

              var data1 = JSON.parse(data);

              if(data1.response == 'error') {
                var responseVar = false;
                var url = "{{url('finance/journal_tran_msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }else{
                var responseVar = true;
                
                if(downloadFlg == 1){
                  var fyYear = data1.data[0].FY_CODE;
                  var fyCd = fyYear.split('-');
                  var seriesCd = data1.data[0].SERIES_CODE;
                  var vrNo = data1.data[0].VRNO;
                  var fileN = 'JV_'+fyCd[0]+''+seriesCd+''+vrNo;
                  var link = document.createElement('a');
                  link.href = data1.url;
                  link.download = fileN+'.pdf';
                  link.dispatchEvent(new MouseEvent('click'));
                }

                var url = "{{url('finance/journal_tran_msg')}}";
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


<script type="text/javascript">
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
    var basicAmt   = $('#basic').val();

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

                      var basicheadval = parseFloat($('#basic').val());

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


                           if(getData.TAXIND_CODE=='SG1' || getData.TAXIND_CODE=='CG1' || getData.TAXIND_CODE=='IGST'){

                              
   

                           }

                            // console.log('TAX_AM T' ,taxAmt);
                          

                          var TableData = "<tr><td class='tdthtablebordr'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value=\""+getData.TAXIND_NAME+"\" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></td>"+
                           "<td class='tdthtablebordr'><input type='text' class='form-control' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+");'> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a></td>"+
                           "<td class='tdthtablebordr'><input type='text' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control numerRightAlign' oninput='getGrandTotal("+taxid+");' ></td>"+
                           "<td class='tdthtablebordr'><input type='text' class='numerRightAlign form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+taxAmt+"' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticIND+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'>"+
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

                      var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOktaxbtn"+taxid+"' onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",1);' style='width: 36px;'>Ok</button>";

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
   
      }

      if(indicator=="N"){

          amtMinus= -((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmnt_"+incNum+"_"+l).val(amtMinus.toFixed(2));

      }

      var inde_M_amt = parseFloat($("#FirstBlckAmnt_"+incNum+"_"+l).val());
    
      if(isNaN(inde_M_amt)){
        indm = '';
        $("#FirstBlckAmnt_"+incNum+"_"+l).val(indm);
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

        }
      }

      if(indicator=="P"){

          addition = ((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmnt_"+incNum+"_"+l).val(addition.toFixed(2));

      }

      if(indicator=="Q"){

         additionRoundOff = ((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmnt_"+incNum+"_"+l).val(Math.round(additionRoundOff.toFixed(2)));

      }

      if(indicator=="Z"){

          subtotalview = ((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmnt_"+incNum+"_"+l).val(subtotalview.toFixed(2));

      }
    
      if(indicator=="O"){

          deductionRoundOff = -((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmnt_"+incNum+"_"+l).val(Math.round(deductionRoundOff.toFixed(2)));

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
   
  if(ind_value =='M' || ind_value == 'L'){
    $('#rate_'+indid+'_'+indnmeid).val(100).prop('readonly',true);
    $('#logic_id_'+indid+'_'+indnmeid).val('');
    $('#FirstBlckAmnt_'+indid+'_'+indnmeid).val('');
   
  }else{
    $('#rate_'+indid+'_'+indnmeid).prop('readonly',false);
  } 

  $('#indicator_'+indid+'_'+indnmeid).val(ind_value);
  $('#indicatorShow_'+indid+'_'+indnmeid).modal('hide');

}

function OkGetGransVal(aplyid,datacount,countercount,staticvalue){

    if(staticvalue==1){

      $('#aplytaxOrNot'+aplyid).html('1');
      $('#cancelbtn'+aplyid).html('');
      $('#appliedbtn'+aplyid).html('');

      var appliedbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-success iconBtnSty"><i class="fa fa-check"></i></small>';

      $('#appliedbtn'+aplyid).html(appliedbtn);
          
      $('#simulation').prop('disabled', false);
      $('#submitdata').prop('disabled', false);
        
       var  gstAmt=0;

      if(countercount == datacount){
        
        var g_Amnt = $('#FirstBlckAmnt_'+aplyid+'_'+countercount).val();

        var g_Amnt = $('#FirstBlckAmnt_'+aplyid+'_'+countercount).val();
        console.log('g_Amnt',g_Amnt);
        $('#getNetAmnt').val(g_Amnt);
        $('#nextAmtTot').html(g_Amnt);
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


</script>

@endsection