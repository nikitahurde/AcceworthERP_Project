@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ URL::asset('public/dist/css/viewCss/commonCss.css') }}">
@include('admin.include.navbar')

@include('admin.include.sidebar')


<style type="text/css">

  .hiddenicon{
    display: none;
  }
  ::placeholder {
    text-align:left;
  }
  .tooltiphide{
    display: none;
  }
  .texIndbox1{
    text-align: center;
  }
  table{
    border-collapse: collapse;
  }
  .showdetail{
    display: none;
  }
  .aplynotStatus{
    display: none;
  }
  .notshowcnlbtn{
    display: none;
  }
  .itmbyQc{
    display: none;
  }
  .texIndbox {
    width: 1%;
    text-align: center;
  }
  .showind_Ch{
    display: none;
  }
  .numerrightAlign{
    text-align: right;
  }
  .totlsetinres{
    text-align: right;
    font-weight: 800;
    margin-top: 3%;
    margin-right: 10px;
  }
  @media screen and (max-width: 600px) {

    .credittotldesn{
      width: 89px;
      margin-bottom: 5px;
      margin-left: -34%;
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
  <section class="content-header">
    <h1>Direct Sales Trans<small>Add Details</small></h1>

    <ul class="breadcrumb">

      <li>
        <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
      </li>

      <li>
        <a href="{{ url('/dashboard') }}">Transaction</a>
      </li>

      <li class="active">
        <a href="{{ url('/Transaction/Sales/Direct-Sales-Trans') }}"> Direct Sales Transaction</a>
      </li>
    
    </ul>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Direct Sales Transaction</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/Transaction/Sales/View-Sales-Order-Trans')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

            </div>

          </div><!-- /.box-header -->

          <div class="box-body">

            <div class="overlay-spinner hideloader"></div>

            <div class="row">

              <div class="col-md-12">

                <div class="panel with-nav-tabs panel-info">

                  <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active" id="firstTab">
                          <a href="#tab1info" id="basicInfo" data-toggle="tab">Basic Info</a>
                        </li>
                        <li id="secondTab">
                          <a href="#tab2info" data-toggle="tab" >Other Details</a>
                        </li>
                    </ul>
                  </div><!-- /.panel heading -->

                  <div class="panel-body">

                    <div class="tab-content">
                      <!-- /. tab 1 -->
                      <div class="tab-pane fade in active" id="tab1info">

                        <div class="row">

                          <div class="col-md-2">

                            <div class="form-group">

                              <label>Date: <span class="required-field"></span></label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

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

                              <small id="showmsgfordate" style="color: red;"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                            </div>
                            <!-- /.form-group -->
                          </div><!-- ./col -->

                          <div class="col-md-2">

                            <div class="form-group">

                              <label> T Code : </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                <input type="text" class="form-control" name="tran" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                                <input type="hidden" id="transtaxCode" >

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>
                            <!-- /.form-group -->
                          </div><!-- /.col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Series Code: 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                <?php $seriesCount = count($series_list); ?>
                                <input list="series_List1"  id="series_code_sale" name="series" class="form-control  pull-left" value="<?php if($seriesCount == 1){echo $series_list[0]->SERIES_CODE; echo "[ ".$series_list[0]->SERIES_NAME." ]";}else{echo old('series_code');} ?>" placeholder="Select Series" onchange="getvrnoBySeries()" autocomplete="off">

                                <datalist id="series_List1">

                                  <option selected="selected" value="">-- Select --</option>

                                  @foreach ($series_list as $key)

                                    <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                                  @endforeach

                                </datalist>

                              </div>
                              
                              <small id="series_code_errr" style="color: red;"></small>

                            </div>
                            <!-- /.form-group -->
                          </div><!-- /.col -->

                          <div class="col-md-2">

                            <div class="form-group">

                              <label> Vr No: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                <input type="text" class="form-control rightcontent" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>
                            <!-- /.form-group -->
                          </div><!-- /.col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Plant Code: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                <?php $plcount = count($plant_list); ?>

                                <input list="PlantcodeList" class="form-control" id="Plant_code_sale" name="plantcode" placeholder="Select Plant" maxlength="55" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;  echo "[ ".$plant_list[0]->PLANT_NAME." ]";}?>" autocomplete="off" readonly>

                                <datalist id="PlantcodeList">

                                   <option value="">--SELECT--</option>

                                   @foreach ($plant_list as $key)

                                  <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

                                  @endforeach

                                </datalist>

                              </div>

                              <input type="hidden" id="getStateByPlant" name="stateByPlant">

                              <small>  

                                  <div class="pull-left showSeletedName" id="plantText"></div>

                              </small>

                              <small id="plant_err" style="color: red;"> </small>

                            </div>
                              <!-- /.form-group -->
                          </div><!-- /.col -->

                        </div><!-- /.row -->

                        <div class="row">

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Profit Center Code: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input list="profitList"  id="profitctrId" name="pfct" class="form-control  pull-left" value="{{ old('pfct')}}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly>

                                  <datalist id="profitList">

                                    <option selected="selected" value="">-- Select --</option>

                                  </datalist>

                                </div>

                              <small id="profit_center_err" style="color: red;"> </small>

                            </div>
                            <!-- /.form-group -->
                          </div><!-- /.col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Customer Code : <span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon" style="padding: 4px 12px;">

                                    <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>

                                    <div class="" id="appndplantbtn"> 
                                    </div>

                                     <?php $accCount = count($acc_list); ?>
                                     <input type="hidden" id="getaccCount" value="{{$accCount}}">
                                     <?php if($accCount == 1) { ?>

                                      <button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getplantdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;" id="appndplantbtn1"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>

                                     <?php } else{ ?>
                                      <i class="fa fa-newspaper-o" aria-hidden="true" id="showicon"></i>
                                     <?php } ?>

                                  </span>
                                  
                                  <input list="AccountList"  id="account_code_sale" name="AccCode" class="form-control  pull-left" value="<?php if($accCount == 1){echo $acc_list[0]->ACC_CODE;}else{} ?>" placeholder="Select Customer" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly> 

                                  <datalist id="AccountList">

                                    <option selected="selected" value="">-- Select --</option>

                                    @foreach ($acc_list as $key)

                                    <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                                    @endforeach

                                  </datalist>

                                </div>

                                <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                                <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                                <small id="acccode_code_errr" style="color: red;"></small>
                                <small id="accNotFound"></small>

                            </div>
                                <!-- /.form-group -->
                          </div><!-- /.col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Consignee/Delivery To: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon" style="padding: 4px 12px;">

                                    <i class="fa fa-newspaper-o " aria-hidden="true"></i>

                                  </span>
                                  
                                  <input list="shipTAdd"  id="shipTAddrs" class="form-control  pull-left" value="" placeholder="Select Consignee/Delivery To" onchange="gettaxByStatCdSale();" autocomplete="off"> 

                                  <datalist id="shipTAdd">

                                    <option selected="selected" value="">-- Select --</option>

                                  </datalist>

                                </div>
                                <small id="err_shiptAdrMsg" style="color: red;" class="form-text text-muted"></small>
                                <input type="hidden" id="addId" value="">
                                <input type="hidden" value="" id="stateOfAcc">

                            </div>
                                <!-- /.form-group -->
                          </div> <!-- /.col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Sale Rep. code: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>
                                  <?php $salerCd = count($sale_rep_list); ?>

                                  <input list="saleRepList" class="form-control" id="sale_rep_code" name="sale_rep_code" placeholder="Select Sale Rep. code" maxlength="55" value="<?php if($salerCd == 1){echo $sale_rep_list[0]->ACC_CODE; echo "[ ".$sale_rep_list[0]->ACC_NAME." ]";}?>"  autocomplete="off">

                                  <datalist id="saleRepList">

                                     <option value="">--SELECT--</option>

                                     @foreach ($sale_rep_list as $key)

                                    <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo " [".$key->ACC_CODE."]"; ?></option>

                                    @endforeach

                                  </datalist>

                                </div>
                                <small>  

                                    <div class="pull-left showSeletedName" id="saleRText"></div>

                                </small>

                                <small id="saleR_err" style="color: red;"> </small>

                            </div>
                            <!-- /.form-group -->
                          </div> <!-- /.col -->
                          
                        </div><!-- /.row -->

                        <div class="row">
                            
                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Cost Center Code: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>
                                  <?php $costCd = count($cost_list); ?>

                                  <input list="CostcodeList" class="form-control" id="costCent_code_sale" name="costCent_code" placeholder="Select Cost Center Code" maxlength="55" value="<?php if($costCd == 1){echo $cost_list[0]->COST_CODE; echo "[ ".$cost_list[0]->COST_NAME." ]";}?>"  autocomplete="off">

                                  <datalist id="CostcodeList">

                                     <option value="">--SELECT--</option>

                                     @foreach ($cost_list as $key)

                                    <option value='<?php echo $key->COST_CODE?>'   data-xyz ="<?php echo $key->COST_NAME; ?>" ><?php echo $key->COST_NAME; echo " [".$key->COST_CODE."]"; ?></option>

                                    @endforeach

                                  </datalist>

                                </div>
                                <small>  

                                    <div class="pull-left showSeletedName" id="CostcentrText"></div>

                                </small>

                                <small id="Costcentr_err" style="color: red;"> </small>

                            </div>
                            <!-- /.form-group -->
                          </div> <!-- /.col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Sale Order No: 
                              </label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input  list="saleConList" id="saleConNo" name="" class="form-control  pull-left" value="" placeholder="Select Sale Order No" onchange="getITmBySaleContra()" autocomplete="off">

                                    <datalist id="saleConList">
                                      
                                    </datalist>
                                  
                                </div>
                                <small style="color: red;" id="saleConNotF"></small>
                            </div>
                                <!-- /.form-group -->
                          </div><!-- /.col -->

                          <div class="col-md-2">

                            <div class="form-group">

                              <label>Tax Code:
                              </label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>
                                  <?php $taxcount = count($taxcode_list); ?>
                                  <input list="TaxcodeList"  id="tax_code_get" name="taxcode" class="form-control  pull-left" value="<?php if($taxcount == 1){echo $taxcode_list[0]->TAX_CODE;}else{echo old('taxcode');} ?>" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off" onchange="getitmByTax()">

                                  <datalist id="TaxcodeList">

                                    <option selected="selected" value="">-- Select --</option>

                                    @foreach ($taxcode_list as $key)

                                      <option value='<?php echo $key->TAX_CODE?>'   data-xyz ="<?php echo $key->TAX_NAME; ?>" ><?php echo $key->TAX_NAME ; echo " [".$key->TAX_CODE."]" ; ?></option>

                                    @endforeach

                                  </datalist>

                                </div>

                                <small id="Taxcode_errr" style="color: red;"></small>

                            </div><!-- /.form-group -->

                          </div><!-- /.col -->

                          <div class="col-md-2">

                            <div class="form-group">

                              <label>Due Days: 
                                <span class="required-field"></span>
                              </label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input type="text" id="due_days" name="due_days" class="form-control  pull-left Number" value="{{ old('due_days')}}" placeholder="Enter Due Days" autocomplete="off" style="text-align: end;" readonly>

                                </div>
                                <small id="dueDays_err" style="color: red;"></small>

                            </div><!-- /.form-group -->

                          </div><!-- /.col -->

                          <div class="col-md-2">

                            <div class="form-group">

                              <label>Due Date: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                
                                  <input type="text" class="form-control rightcontent" name="due_date" id="due_date" value="{{ old('due_date')}}" placeholder="Select Due" autocomplete="off" readonly>

                                </div>
                            </div><!-- /.form-group -->

                          </div><!-- /.col -->

                        </div><!-- /.row -->

                        <div class="row">

                          <div class="col-md-3">
                            <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 2px;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                          </div>
                          
                        </div><!-- /.row -->

                      </div>  <!-- /. tab 1 -->

                      <!-- /. tab 2 -->
                      <div class="tab-pane fade" id="tab2info">

                        <div class="row">
                            
                          <div class="col-md-4">
                            <div class="form-group">

                              <label>Party Ref No :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="party_ref" id="party_rf_no" placeholder="Enter Party Ref No" maxlength="30" autocomplete="off">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div><!-- /.col -->

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Party Ref Date:</label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                                       $ToDate= date("d-m-Y", strtotime($toDate));  

                                ?>

                                <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy_1">

                                <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy_1">

                                <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="{{ old('vr_date')}}" placeholder="Select Party Ref Date" autocomplete="off">

                              </div>

                              <small id="showmsgfordate_1" style="color: red;"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                      {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                            </div>
                            <!-- /.form-group -->
                          </div><!-- /.col -->

                        </div><!-- /.row -->

                        <div class="row">

                          <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->RFHEAD1) && $rfhead->RFHEAD1 !=''){

                          ?>
                            <div class="col-md-4">
                              <div class="form-group">

                                <label><?php echo $rfhead->RFHEAD1 ?> :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="Rfhead_1" placeholder="Enter Rfhead1" maxlength="30" id="rfhead1" oninput="rfheadget(1)" autocomplete="off">

                                </div>

                                <small id="emailHelp" class="form-text text-muted">

                                </small>

                              </div>
                            </div>
                          <?php }else{} } ?>

                          <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->RFHEAD2) && $rfhead->RFHEAD2 !=''){

                          ?>
                            <div class="col-md-4">
                              <div class="form-group">

                                <label><?php echo $rfhead->RFHEAD2 ?> :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="Rfhead_2" placeholder="Enter Rfhead2" maxlength="30" id="rfhead2" oninput="rfheadget(2)">

                                </div>

                                <small id="emailHelp" class="form-text text-muted">

                                </small>

                              </div>
                            </div>
                          <?php }else{} } ?>

                          <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->RFHEAD3) && $rfhead->RFHEAD3 !=''){

                          ?>
                            <div class="col-md-4">
                              <div class="form-group">

                                <label><?php echo $rfhead->RFHEAD3 ?> :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="Rfhead_3" id="rfhead3" placeholder="Enter Rfhead3" maxlength="30" oninput="rfheadget(3)">

                                </div>

                                <small id="emailHelp" class="form-text text-muted">

                                </small>

                              </div>
                            </div>
                          <?php }else{} } ?>

                        </div><!-- /.row -->

                        <div class="row">
                          
                          <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->RFHEAD4) && $rfhead->RFHEAD4 !=''){

                          ?>
                            <div class="col-md-4">
                              <div class="form-group">

                                <label><?php echo $rfhead->RFHEAD4 ?> :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="Rfhead_4" placeholder="Enter Rfhead4" maxlength="30" id="rfhead4" oninput="rfheadget(4)" autocomplete="off">

                                </div>

                                <small id="emailHelp" class="form-text text-muted">

                                </small>

                              </div>
                            </div>
                          <?php }else{} } ?>

                          <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->RFHEAD5) && $rfhead->RFHEAD5 !=''){

                          ?>
                            <div class="col-md-4">
                              <div class="form-group">

                                <label><?php echo $rfhead->RFHEAD5 ?> :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="Rfhead_5" placeholder="Enter Rfhead5" maxlength="30" id="rfhead5" oninput="rfheadget(5)" autocomplete="off">

                                </div>

                                <small id="emailHelp" class="form-text text-muted">

                                </small>

                              </div>
                            </div>
                          <?php }else{} } ?>

                          <div class="col-md-4">
                              <a class="btn btn-info"  href="#tab1info" data-toggle="tab" style="margin-top: 26px;" id="previousbtn" >Previous&nbsp;&nbsp;<i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                          </div>
                        </div><!-- /.row -->

                      </div><!-- /. tab 2 -->

                    </div><!--  /. tab-content -->
                  </div><!-- /.panel-body -->
                </div><!-- /.panel-info -->
              </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
          </div><!-- /.box-body -->

        </div><!-- /.Custom-Box -->
      </div><!-- /.col-sm-12 -->
    </div><!-- /.row -->
  </section><!-- /.section -->

  <section class="content" style="margin-top: -10%;">

    <div class="row">
      
      <div class="col-sm-12">
        
        <div class="box box-primary Custom-Box">
          
          <div class="box-body">
            <form id="salesQuoTrans">
              @csrf
              <div class="table-responsive">
                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                  <input type="hidden" id="itmCountchk">
                  <input type ="hidden" name="comp_name" id="getCompName">
                  <input type ="hidden" name="fy_year" id="getFyYear">
                  <input type ="hidden" name="trans_date" id="getTransDate">
                  <input type ="hidden" name="vr_no" id="getVrNo">
                  <input type ="hidden" name="trans_code" id="getTransCode">
                  <input type ="hidden" name="accountCode" id="getAccCode"  value="<?php if($accCount == 1){echo $acc_list[0]->ACC_CODE;} ?>">
                  <input type ="hidden" name="account_name" id="getAcc_Name">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="pfct_name" id="getPfctName">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="plant_name" id="getPlantName" value="<?php if($plcount == 1){ echo $plant_list[0]->PLANT_NAME;}?>">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
                  <input type ="hidden" name="series_name" id="getSeriesName" value="<?php if($seriesCount == 1){ echo $series_list[0]->SERIES_NAME;} ?>">
                  <input type ="hidden" name="tax_code" id="getTaxCode">
                  <input type ="hidden" name="dueDate" id="get_due_date">
                  
                  <input type ="hidden" name="party_ref_no" id="getpartyrfNo">
                  <input type ="hidden" name="party_ref_date" id="getpartyrfDate">
                  <input type ="hidden" name="consine_code" id="getcosine">
                  <input type ="hidden" name="rfhead1" id="getrfhead1">
                  <input type ="hidden" name="rfhead2" id="getrfhead2">
                  <input type ="hidden" name="rfhead3" id="getrfhead3">
                  <input type ="hidden" name="rfhead4" id="getrfhead4">
                  <input type ="hidden" name="rfhead5" id="getrfhead5">
                  <input type ="hidden" name="gate_dueDays" id="gateduedays">
                  <input type ="hidden" name="bill_type" value="DS">
                  <input type ="hidden" name="consneAdd" id="gateconsAdd">
                  <input type ="hidden" name="Sale_Reps" id="gateSaleRep">
                  <input type ="hidden" name="cp_codeGet" value="" id="getcpCode">
                  <input type ="hidden" name="Cost_Center" id="gateCostCenter">
                  <input type ="hidden" name="series_gl" id="seriesGl">
                  <input type ="hidden" name="acc_glCode" id="accGlCode">
                  <input type ="hidden" name="acc_glName" id="accGlName">

                  <tr >

                    <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 10px;"> Sr.No.</th>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty</th>

                    <th>A-Qty</th>

                    <th>Rate</th>

                    <th>Basic</th>

                    <th>Tax</th>

                  </tr>
                  <tr class="useful" id="firstRowtr">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="cBocID1" onclick="checkcheckbox(1);" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">1.</span>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group">
                        <input type="text" class="inputboxclr itmbyQc" id='Item_CodeId1' name="itemsale[]" onclick="ShowItemCode(1);" oninput="this.value = this.value.toUpperCase()" readonly />

                        <input list="ItemList1" class="inputboxclr" id='ItemCodeId1' name="item_code[]"  onchange="ItemCodeGet(1); taxIntaxrate(1);"  oninput="this.value = this.value.toUpperCase()" readonly />

                        <datalist id="ItemList1">
                            @foreach ($item_list as $key)

                            <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                            @endforeach
                        </datalist>
                      </div>
                      <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1" onclick="showItemDetail(1)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>
                      <input type="hidden" id="idsun1">
                      <input type="hidden" id="selectItem1">
                      <div class="divhsn" id="showHsnCd1"></div>
                      <input type="hidden" id="hsn_code1" name="hsn_code[]">
                      <input type="hidden" id="taxByItem1" name="tax_byitem[]">
                      <input type="hidden" id="taxratebytax1" value="">
                      <input type="hidden" id="sc_transcode1" name="sc_trans[]">
                      <input type="hidden" id="sc_seriescode1" name="sc_series[]">
                      <input type="hidden" id="sc_vrno1" name="sc_vrno[]">
                      <input type="hidden" id="sc_slno1" name="sc_slno[]">
                      <input type="hidden" id="sc_headid1" name="sc_head[]">
                      <input type="hidden" id="sc_bodyid1" name="sc_body[]">
                      <input type="hidden" id="itmC_code1" name="itemcodeC[]">

                      <small id='itemnotFound1' style="color: red;"></small>
                    </td>

                    <td class="tdthtablebordr tooltips">

                      <div style="display: flex;">
                        <input type="text" class="inputboxclr getAccNAme" id='Item_Name_id1' name="item_name[]" readonly>

                        <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>

                        <textarea id="remark_data1" rows="1" class="" name="remark[]" placeholder="Enter Description" readonly></textarea>
                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr"  id='qty1' name="qty[]" oninput="CalAQty(1)" readonly />

                      <input type="text" name="unit_M[]" id="UnitM1" class="inputboxclr AddM" readonly>

                      <input type="hidden" id="Cfactor1">
                      <input type="hidden" id="balQtyByItem1">
                    
                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr"  id='A_qty1' name="Aqty[]" readonly />

                      <input type="text" name="add_unit_M[]" id="AddUnitM1" class="inputboxclr AddM" readonly>
                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <input type='text' class="debitcreditbox inputboxclr cr_amount" oninput="calculateBasicAmt(1)" id='rate1' name="rate[]" readonly/>
                      <input type="hidden" id="qnrate1">

                    </td>

                    <td class="tdthtablebordr">

                       <input type="text" name="basic_amt[]" id="basic1" class="form-control basicamt debitcreditbox" readonly>
                       
                    </td>

                    <td>
                        <input type="hidden" id="data_count1" class="dataCountCl" value="0" name="data_Count[]">

                        <input type="hidden" class="setGrandAmnt" id="get_grand_num1" name="crAmtPerItem[]">
                         <div>
                         <small id="taxnotfound1" class="label label-danger"></small>
                         </div>
                       <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1); getGrandTotal(1);" disabled="">Calc Tax </button>

                       <div id="aplytaxOrNot1" class="aplynotStatus"></div>
                       <div id="appliedbtn1"></div>
                        <div id="cancelbtn1"></div>

                    </td>

                  </tr>
                </table>
              </div><!-- /.table -reponsive -->

              <div class="row">

                <div class="col-md-12" style="display: flex;">
                  <div style="width:57%;">
                    
                    <input type="hidden" id="checkitm">
                    <input type="hidden" id="itmaftercheck">
                  
                    <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                    <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

                  </div>
                  <div style="width:32%;">
                    <div class="totlsetinres">Basic Total :</div>
                  </div>
                  <div style="width:4%;">
                    <input type="hidden" id="allgetMCount" name="getdatacount">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalBasciAmt" id="basicTotal" readonly="" style="margin-top: 3px;">
                  </div>
                </div>
                
              </div>

              <div class="row">

                <div class="col-md-12" style="display: flex;">
                  <div style="width:57%;"></div>
                  <div style="width:32%;">
                    <div class="totlsetinres">Other Total :</div>
                  </div>
                  <div style="width:4%;">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalOtherAmt" id="otherTotalAmt" readonly="" style="margin-top: 3px;">
                  </div>
                </div>
                
              </div>

              <div class="row">

                <div class="col-md-12" style="display: flex;">
                  <div style="width:57%;"></div>
                  <div style="width:32%;">
                    <div class="totlsetinres">Grand Total :</div>
                  </div>
                  <div style="width:4%;">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalGrandAmt" id="allgrandAmt" readonly="" style="margin-top: 3px;">
                  </div>
                  
                </div>
                
              </div>

              <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
             

              <p class="text-center">


                <button class="btn btn-success" type="button" id="submitdata" onclick="submitAllData(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

                <button class="btn btn-success" type="button" onclick="submitAllData(1)" id="submitNDown" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save &amp; Download</button>
                <input type="hidden" id="donwloadStatus" name="donwloadStatus" value="">

              </p>

              <!-- start tax calculation modal -->
  
                <div class="modal fade" id="tds_rate_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                  <div class="modal-dialog" role="document" style="margin-top: 5%;">

                    <div class="modal-content" style="border-radius: 5px;overflow-y: scroll;height: 512px;">

                      <div class="modal-header">

                        <div class="row">
                
                          <div class="col-md-6">
                            <div class="form-group">
                                <lable class="settaxcodemodel col-md-4" style="padding: 0px;">Tax Code - </lable>
                                         
                                <input type="text" class="settaxcodemodel col-md-7" id="tax_code1" style="border: none; padding: 0px;" readonly>
                            </div>
                          </div>
                
                          <div class="col-md-6">
                            <h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation</h5>
                          </div>

                        </div>

                      </div>

                      <div class="modal-body table-responsive">

                        <div class="modalspinner hideloaderOnModl"></div>

                          <div class="boxer" id="tax_rate_1">
                          
                            <!-- End of 'box-row' -->
                            <!-- Start of 'box-row' -->
                            <!-- End of 'box-row' -->     

                          </div>

                      </div>

                      <div class="modal-footer">

                        <center> <small  id="footer_ok_btn1"></small>
                        <small  id="footer_tax_btn1" style="width: 10px;"></small>
                       </center>

                      </div>

                    </div>

                  </div>

                </div>
                <!-- model -->

                <div id="domModel_2">
                   
                </div>

              <!-- end tax calculation modal -->

              <!-- when hsn code same then show model -->

                <div id="HsnSameShow1" class="modal fade" tabindex="-1">
                  <div class="modal-dialog modal-sm" style="margin-top: 13%;">
                      <div class="modal-content" style="border-radius: 5px;">
                          <div class="modal-header">
                              <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
                              
                          </div>
                          <div class="modal-body">
                            <p>Header Tax Code <small id="headtaxCode1"></small> Is Different Than Item Wise Tax Code <small id="itmtaxCode1"></small></p>
                             
                          </div>
                          <div class="modal-footer">
                             <button type="button" class="btn btn-primary" data-dismiss="modal" >Ok</button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancleblnkItm(1);" >Cancel</button>
                             
                          </div>
                      </div>
                  </div>
                </div>
              <!-- when hsn code same then show model -->

              <!-- payment turms model -->
                <div class="modal fade" id="payment_turms_M" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                  <div class="modal-dialog modal-sm" role="document" style="margin-top: 13%;">
                    <div class="modal-content" style="border-radius: 5px;">
                      <div class="modal-header">
                        <center><h5 class="modal-title modltitletext" id="exampleModalLabel">Payment Terms</h5></center>
                      </div>
                      <div class="modal-body">
                        <div class="row tdsInputBox">
                            <div class="col-md-4">
                              <label class="textSizeTdsModl">Payment Terms</label>
                              
                            </div>
                            <div class="col-md-4">
                              <select name="" id="paymentTerms">
                                <option value="">--Select--</option>
                                <option value="APO">Against Purchase Order</option>
                                <option value="Adhoc">Adhoc</option>
                              </select>

                              <input type="hidden" id="slectpaytrem" value="" name="payment_terms">
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                        <div class="row tdsInputBox">
                            <div class="col-md-4">
                              <label class="textSizeTdsModl">Cr Amount</label>
                              
                            </div>
                            <div class="col-md-4">
                              <input type="text" id="cr_amt_PT" readonly style="text-align: right;">

                              <input type="hidden" id="slectcramt_PT" value="" name="cr_amt">
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                        <div class="row tdsInputBox">
                            <div class="col-md-4">
                              <label class="textSizeTdsModl">Adv Rate I</label>
                              
                            </div>
                            <div class="col-md-4">
                              <select name="" id="advRateInd">
                                <option value="">--Select--</option>
                                <option value="P">P</option>
                                <option value="L">L</option>
                              </select>

                              <input type="hidden" name="adv_rate_i" id="selectadvRateInd" value="">
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                        <div class="row tdsInputBox">
                            <div class="col-md-4">
                              <label class="textSizeTdsModl">Adv Rate</label>
                              
                            </div>
                            <div class="col-md-4">
                              <input type="text" id="advance_rate" style="text-align: right;">
                            </div>

                            <input type="hidden" id="selectadvance_rate" name="adv_rate" value="">
                            <div class="col-md-2"></div>
                        </div>

                        <div class="row tdsInputBox">
                            <div class="col-md-4">
                              <label class="textSizeTdsModl">Adv Amount</label>
                              
                            </div>
                            <div class="col-md-4">
                              <input type="text" id="advance_Amt" style="text-align: right;" readonly>

                              <input type="hidden" id="selectadvance_Amt" value="" name="adv_amt">
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                        
                        
                      </div>
                     
                          <span id="errmsg" style="font-size: 12px;margin-left: 31px;"></span>
                       
                      <div class="modal-footer" style="text-align: center;">
                        <button type="button" class="btn btn-primary" style="width: 27%;" data-dismiss="modal" id="payment_trem_apply" onclick="getvalue(1)">Ok</button>
                        <button type="button" class="btn btn-warning" style="width: 20%;" data-dismiss="modal" onclick="getvalue(0)">Cancle</button>
                      </div>
                    </div>
                  </div>
                </div>
              <!-- payment turms model -->

              <!-- show modal when click on view btn after item select item -->

                <div class="modal fade" id="view_detail1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

                    <div class="modal-content" style="border-radius: 5px;">

                      <div class="modal-header">

                        <div class="row">
                              
                          <div class="col-md-12">
                            <h5 class="modal-title modltitletext" id="exampleModalLabel">Item Detail</h5>
                          </div>


                        </div>

                      </div>

                      <div class="modal-body table-responsive">
                        <div class="boxer" id="">

                          <div class="box-row">
                            <div class="box10 texIndbox1">Item name</div>
                            <div class="box10 rateIndbox">HSN Code</div>
                            <div class="box10 rateIndbox">Tax Code</div>
                            <div class="box10 rateBox">Item Detail</div>
                            <div class="box10 amountBox">Item Type</div>
                            <div class="box10 amountBox">Item Group</div>
                            <div class="box10 amountBox">Item Class</div>
                            <div class="box10 amountBox">Item Category</div>
                          </div>
                          
                          <div class="box-row">
                            <div class="box10 itmdetlheading1">
                              <small id="itemCodeshow1"> </small>
                            </div>
                            
                            <div class="box10 itmdetlheading">
                              <small id="hsncodeshow1"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="taxcodeshow1"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="itemDetailshow1"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="itemtypeshow1"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="itemgroupshow1"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="itemclassshow1"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="itemcategoryshow1"> </small>
                            </div>
                          </div>
                          
                        </div>
                      </div>


                      <div class="modal-footer" style="text-align: center;">
                       
                        <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button>

                      </div>

                    </div>

                  </div>

                </div>

              <!-- show modal when click on view btn after item select item -->

                <div class="modal fade" id="plant_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

                    <div class="modal-content" style="border-radius: 5px;">

                      <div class="modal-header">

                        <div class="row">
                              
                          <div class="col-md-12">
                            <h5 class="modal-title modltitletext" id="exampleModalLabel">Account Detail</h5>
                          </div>


                        </div>

                      </div>

                      <div class="modal-body table-responsive">
                        <div class="boxer" id="">

                          <div class="box-row">
                            <div class="box10 texIndbox1">Acc Name</div>
                            <div class="box10 rateIndbox">Acc Type Code</div>
                            <div class="box10 rateIndbox">Address1</div>
                            <div class="box10 rateBox">Address2</div>

                            <div class="box10 amountBox">Address3</div>
                            <div class="box10 amountBox">city</div>
                            <div class="box10 amountBox">state</div>
                            <div class="box10 amountBox">Email</div>
                            <div class="box10 amountBox">Phone No</div>

                          </div>
                          
                          <div class="box-row">
                            <div class="box10 itmdetlheading">
                              <small id="plantCodeshow"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="plantpfctcodeshow"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="plantaddshow"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="plantcityshow"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="plantpinshow"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="plantdistshow"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="plantstateshow"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="plantemailshow"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="plantphoneshow"> </small>
                            </div>
                          </div>
                          
                        </div>
                      </div>


                      <div class="modal-footer" style="text-align: center;">
                       
                        <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button>

                      </div>

                    </div>

                  </div>

                </div>

                <!-- when click on quality Parameter -->

                <div class="modal fade" id="quality_parametr1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                  <div class="modal-dialog" role="document" style="margin-top: 5%;">

                    <div class="modal-content" style="border-radius: 5px;">

                      <div class="modal-header">

                        <div class="row">

                          <div class="col-md-12">
                            <h5 class="modal-title modltitletext" id="exampleModalLabel">Qaulity Parameter</h5>
                          </div>

                        </div>

                      </div>

                      <div class="modal-body table-responsive">

                          <div class="boxer" id="qua_par_1">
                          
                            
                          </div>

                      </div>

                      <div class="modal-footer">
                       
                        <center><small style="text-align: center;" id="footerqp_ok_btn1"></small>
                        <small style="text-align: center;" id="footerqp_quality_btn1"></small>
                        </center>
                      
                      </div>

                    </div>

                  </div>
                </div>

                <div id="quaPdomModel_2">
                 
                </div>
              <!-- when click on quality Parameter -->

              <!-- when tax not applied then show model -->

                <div id="taxNotAppied" class="modal fade" tabindex="-1">
                  <div class="modal-dialog modal-sm" style="margin-top: 13%;">
                      <div class="modal-content" style="border-radius: 5px;">
                          <div class="modal-header" style="text-align: center;">
                              <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                              
                          </div>
                          <div class="modal-body">
                            <p id="taxnotApMsg"></p>
                            <p id="grAmtIsGreatMsg"></p>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
                          </div>
                      </div>
                  </div>
                </div>
                <!-- when tax not applied then show model -->
                <!-- show modal when itemselect but tax not --> 

                <div id="taxSelectModel1" class="modal fade" tabindex="-1">

                    <div class="modal-dialog modal-sm" style="margin-top: 13%;">

                        <div class="modal-content" style="border-radius: 5px;">

                            <div class="modal-header">

                              <div class="row">

                                  <div class="col-md-12">

                                    <h5 class="modal-title modltitletext" id=""  style="font-weight: 800;">Select Tax Code</h5>

                                   

                                  </div>

                              </div>

                            </div>



                            <div class="modal-body table-responsive">

                                <div id="showtaxcodeMul1" style="line-height: 23px;">
                                  
                                </div>

                            </div>



                            <div class="modal-footer" style="text-align: center;" id="taxCodeSelect1">

                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="taxIntaxrate(1);" style="width: 83px;">Ok</button>   

                            </div>



                        </div>

                    </div>

                </div>
                <!-- show modal when itemselect but tax not --> 

                <!-- show modal when click on item code -->

                <div id="allItemShow1" class="modal fade" tabindex="-1">

                  <div class="modal-dialog modal-lg" style="margin-top: 13%;">

                      <div class="modal-content" style="border-radius: 5px;">

                          <div class="modal-header">

                            <div class="row">

                                <div class="col-md-12" style="text-align: center;">

                                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Item Details</h5>

                                </div>

                            </div>

                          </div>

                          <div class="modal-body table-responsive">
                              <div class="boxer" id="itemListShow_1">

                              </div>

                          </div>

                          <div class="modal-footer" style="text-align: center;" id="footer_item_1">

                          </div>

                      </div>

                  </div>

                </div>

                <!-- show modal when click on item code -->
                <!-- show modal when rate is greater-->

                <div id="greaterRateShModel1" class="modal fade" tabindex="-1">

                  <div class="modal-dialog modal-sm" style="margin-top: 13%;">

                      <div class="modal-content" style="border-radius: 5px;">

                          <div class="modal-header">

                            <div class="row">

                                <div class="col-md-12">

                                  <h5 class="modal-title modltitletext" id=""  style="color: red;font-weight: 800;">Alert</h5>

                                 

                                </div>

                            </div>

                          </div>



                          <div class="modal-body table-responsive">

                              <p>Rate Should Not Be Greater</p>

                          </div>



                          <div class="modal-footer" style="text-align: center;" id="greatRateFooter1">

                              <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>   

                          </div>



                      </div>

                  </div>

                </div>

                <!-- show modal when rate is greater-->

                <!-- show modal when quantity is greater than balence qunatity -->

                <div id="grateQtyShModel1" class="modal fade" tabindex="-1">

                  <div class="modal-dialog modal-sm" style="margin-top: 13%;">

                      <div class="modal-content" style="border-radius: 5px;">

                          <div class="modal-header">

                            <div class="row">

                                <div class="col-md-12">

                                  <h5 class="modal-title modltitletext" id=""  style="color: red;font-weight: 800;">Alert</h5>

                                 

                                </div>

                            </div>

                          </div>



                          <div class="modal-body table-responsive">

                              <p>Quantity is grater than balence qunatity</p>

                          </div>



                          <div class="modal-footer" style="text-align: center;" id="greatQtyFooter">

                              <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="cancleGreatQty(1);">ok</button>

                              <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button> -->   

                          </div>



                      </div>

                  </div>

                </div>

                <!-- show modal when quantity is greater than balence qunatity -->


            </form>
          </div>

        </div>

      </div>

    </div>
    
  </section>
</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script>
<script src="{{ URL::asset('public/dist/js/viewjs/commonJsFun.js') }}" ></script>


<script type="text/javascript">

/* -------- GENERATE VRNO ----------- */

  function getvrnoBySeries(){

    var series      = $('#series_code_sale').val();
    var seriesSplit = series.split('[');
    var seriesCode  = seriesSplit[0];
    var transcode   = $('#transcode').val();

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

                  if(data1.data == ''){
                    $('#seriesGl').val('');
                  }else{
                    $('#seriesGl').val(data1.data[0].POST_CODE);
                  }

                  if(data1.vrno_series == '' || data1.vrno_series ==null){
                    $('#vrseqnum').val('');
                    $('#getVrNo').val('');
                  }else{
                    if(data1.vrno_series){
                      var getlastno = data1.vrno_series.LAST_NO;
                    }else{
                      var getlastno = '';
                    }

                    if(data1.vrnodata == ''){
                      $('#vrseqnum').val(getlastno);
                      $('#getVrNo').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);
                      $('#getVrNo').val(lastNo);
                    }
                  }

              }

          }

    });

  }

/* -------- GENERATE VRNO ----------- */

/* ---- IF TAX CODE SELECT IN HEAD THEN GET ITEM AGAINST TAX CODE ----*/

  function getitmByTax(){
    var taxCode = $('#tax_code_get').val();
    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $.ajax({

        url:"{{ url('get-item-data-by-tax-state') }}",

        method : "POST",

        type: "JSON",

        data: {taxCode: taxCode},

        success:function(data){

          var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

               if(data1.data ==''){

               }else{

                  $("#ItemList1").empty();

                  $.each(data1.data, function(k, getData){

                      $("#ItemList1").append($('<option>',{

                        value:getData.ITEM_CODE,

                        'data-xyz':getData.ITEM_NAME,
                        text:getData.ITEM_NAME

                      }));

                  });

               } /* /. DATA CODN*/

            } /* /. SUCCESS CODN*/

        }/* /. SUCCESS FUNCTION*/

    }); /* /. AJAX*/

  } /* /. FUNCTION*/

/* ---- IF TAX CODE SELECT IN HEAD THEN GET ITEM AGAINST TAX CODE ----*/

  $(document).ready(function(){

      $("#account_code_sale").change(function(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var acccode       =  $('#account_code_sale').val();
        var trans_code    =  $('#transcode').val();
        var seperateC     = acccode.split('[');
        var  account_code = seperateC[0]
        var transDate     =  $('#vr_date').val();
        var stateCode     =  $('#getStateByPlant').val();
       // $("#appndplantbtn").addClass('hiddenicon');
        
        $.ajax({

          url:"{{ url('check-state-n-get-trans-by-sale-vrno') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code,transDate:transDate,stateCode:stateCode,trans_code:trans_code},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.sale_order_data == ''){

                    $('#saleConNotF').html('Sale Contract No. Not Found').css('color','red');
                    $('#saleConNo').prop('readonly',true);

                  }else{
                     $('#saleConNotF').html('');
                     $('#saleConNo').prop('readonly',false);
                     $("#saleConList").empty();

                    $.each(data1.sale_order_data, function(k, saleOrder){

                      var startyear = saleOrder.FY_CODE;
                      var getyear = startyear.split('-');

                      $("#saleConList").append($('<option>',{

                        value:getyear[0]+' '+saleOrder.SERIES_CODE+' '+saleOrder.VRNO,

                        'data-xyz':getyear[0]+' '+saleOrder.SERIES_CODE+' '+saleOrder.VRNO,
                        text:getyear[0]+' '+saleOrder.SERIES_CODE+' '+saleOrder.VRNO

                      }));

                    }); 
                      
                  }

                  if(data1.acc_GlData == ''){
                    $('#accGlCode').val('');
                    $('#accGlName').val('');
                  }else{
                    $('#accGlCode').val(data1.acc_GlData.GL_CODE);
                    $('#accGlName').val(data1.acc_GlData.GL_NAME);
                  }

                  if(data1.dataAccAddr == ''){

                  }else{
                    $("#shipTAdd").empty();
                    $.each(data1.dataAccAddr, function(k, getTAX){

                      var cpCode =  '['+getTAX.ACC_CODE+'-'+getTAX.ACC_NAME+'] '+getTAX.ADD1;
                     
                      $("#shipTAdd").append($('<option>',{

                        value:cpCode,
                        'data-xyz':getTAX.CPCODE

                      }));

                    }); 
                  }

              }/* /. SUCCESS CODN*/
          }/* /. SUCCESS FUN */

        }); /* /. AJAX*/

      }); /* /. FUNCTION*/

  });
</script>

<script type="text/javascript">

    $(document).ready(function(){

      $("#saleConNo").bind('change', function () {
    
          var SaleOrNO =  $("#saleConNo").val();
          var xyz = $('#saleConList option').filter(function() {

            return this.value == SaleOrNO;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
            $("#saleConNo").val('');
            $('#tax_code_get').val('');
            $('#due_date').val('');
            $('#due_days').val('');
            $('#tax_code_get').prop('readonly',false);
            $('#due_days').prop('readonly',false);
          }else{
            $('#tax_code_get').val('');
            $('#due_date').val('');
            $('#due_days').val('');
          }
      });

    });
    
    function getITmBySaleContra(){

      var trans_code   =  $('#transcode').val();
      var acccode      =  $('#account_code_sale').val();
      var splitAcc     =  acccode.split('[');
      var account_code = splitAcc[0];
      var saleConNo    =  $('#saleConNo').val();
      var getsalecn    = saleConNo.split(' ');
      var sale_ContNo  = getsalecn[2];
      var sale_challan  = '';


      //if(saleConNo){

          var ordrNo = $('#saleConList option').filter(function() {

            return this.value == saleConNo;

          }).data('xyz');

         var ordrNomsg = ordrNo ?  ordrNo : 'No Match';

         console.log('ordrNomsg',ordrNomsg);

         if(ordrNomsg == 'No Match'){
             $('#Item_CodeId1').addClass('itmbyQc');
             $('#ItemCodeId1').css('display','block');
             $('#due_days').prop('readonly',false);
             $('#tax_code_get').prop('readonly',false);
             $('#tax_code_get').val('');
             $('#due_days').val('');
             $('#due_date').val('');
         }else{
              $('#Item_CodeId1').removeClass('itmbyQc');
              $('#ItemCodeId1').css('display','none');
             // $('#due_days').prop('readonly',true);
             // $('#tax_code_get').prop('readonly',true);
         }

      //}
     

     

      /*if(saleConNo){
          $('#Item_CodeId1').removeClass('itmbyQc');
          $('#ItemCodeId1').css('display','none');
          $('#due_days').prop('readonly',true);
          $('#tax_code_get').prop('readonly',true);
      }else if(postGoodsNo){
          $('#Item_CodeId1').removeClass('itmbyQc');
          $('#ItemCodeId1').css('display','none');
          $('#due_days').prop('readonly',true);
          $('#tax_code_get').prop('readonly',true);
      }else{
         $('#Item_CodeId1').addClass('itmbyQc');
         $('#ItemCodeId1').css('display','block');
         $('#due_days').prop('readonly',false);
         $('#tax_code_get').prop('readonly',false);

      }*/



      $.ajaxSetup({

              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

      });

      $.ajax({

            url:"{{ url('get-item-data-by-sales-vno') }}",

            method : "POST",

            type: "JSON",

            data: {account_code: account_code,sale_ContNo:sale_ContNo,sale_challan:sale_challan,trans_code:trans_code},

            success:function(data){

              var data1 = JSON.parse(data);
                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                    console.log('data1.data',data1.data);
                    if(data1.data == ''){

                    }else{

                      var startDate = data1.data[0].VRDATE;
                      var endDate = data1.data[0].DUEDATE;

                      var dateform = endDate.split('-');

                      var properEndDate = dateform[2]+'-'+dateform[1]+'-'+dateform[0];

                      var diffInMs   = new Date(endDate) - new Date(startDate);
                      var diffInDays = diffInMs / (1000 * 60 * 60 * 24);

                      $('#due_days').val(data1.data[0].DUEDAYS);
                      $('#gateduedays').val(data1.data[0].DUEDAYS);
                      $('#due_date').val(properEndDate);
                      $('#get_due_date').val(properEndDate);
                      $('#tax_code_get').val(data1.data[0].TAX_CODE);
                      $('#getTaxCode').val(data1.data[0].TAX_CODE);
                      $('#due_days').css('border-color','#d2d6de');
                      $('#dueDays_err').html('');
                    }
                  

                }

            }

      });

    }

    function ShowItemCode(itemId){

      var trans_code     =  $('#transcode').val();
      var acccode        =  $('#account_code_sale').val();
      var splitAcc       =  acccode.split('[');
      var account_code   = splitAcc[0];
      var saleConNo      =  $('#saleConNo').val();
      var getsalecn      = saleConNo.split(' ');
      var sale_ContNo    = getsalecn[2];
      
      
      var sale_challanNo ='';
      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $.ajax({

          url:"{{ url('get-mulitple-item-by-prev-sales') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code,sale_ContNo:sale_ContNo,sale_challanNo:sale_challanNo,trans_code:trans_code},

          success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){
                  //console.log(data1.data[0].item_name);
                    if(data1.data == ''){

                       $('#allItemShow'+itemId).modal('hide');

                       $('#itemnotFound'+itemId).html('Item Not Found');
                       $('#ItemCodeId'+itemId).prop('readonly',true);
                       $('#ItemCodeId'+itemId).val('');

                    }else{

                      $('#allItemShow'+itemId).modal('show');

                      $('#itemListShow_'+itemId).empty();

                       $('#itemnotFound'+itemId).html('');
                       $('#ItemCodeId'+itemId).prop('readonly',false);

                       if(saleConNo){
                        var tableHead= "<div class='box-row'><div class='box10 texIndbox'>#</div><div class='box10 vrnoinbox'>Vr. No</div><div class='box10 itemIndbox'>Item </div><div class='box10 rateIndbox'>Qty Order </div><div class='box10 rateIndbox'>Qty Bill </div><div class='box10 rateIndbox'>Bal. Qty </div></div>";
                      }else{
                        var tableHead= "<div class='box-row'><div class='box10 texIndbox'>#</div><div class='box10 vrnoinbox'>Vr. No</div><div class='box10 itemIndbox'>Item </div><div class='box10 rateIndbox'>Qty Challan </div><div class='box10 rateIndbox'>Qty Bill </div><div class='box10 rateIndbox'>Bal. Qty </div></div>";
                      }

                      

                      $('#itemListShow_'+itemId).append(tableHead);

                      var incemntval = 1;

                      var inval = '';

                      var itmCounts = data1.data.length;

                      $('#itmCountchk').val(itmCounts);
                      if(itmCounts == 1){
                        $('#addmorhidn').prop('disabled',true);
                      }else{
                        $('#addmorhidn').prop('disabled',false);
                      }

                      $.each(data1.data, function(k, getData) {

                        var startyear = getData.FY_CODE;
                        var getyear = startyear.split("-");

                        if(getData.QTYISSUED == null){
                          var qtyissued = 0.000;
                        }else{
                          var qtyissued =getData.QTYISSUED;
                        }
                        
                        if(saleConNo){
                          var tblheadId = getData.SORDERHID;
                          var tblbodyId = getData.SORDERBID;
                        }else{
                          var tblheadId = getData.SCHALLANHID;
                          var tblbodyId = getData.SCHALLANBID;
                        }



                      var tableBody = "<div class='box-row' id='hidebalNull_"+itemId+"_"+incemntval+"'><div class='box10 texIndbox'><input type='radio' id='sr_"+itemId+"_"+incemntval+"' name='itemname' value='"+itemId+"_"+incemntval+"'></div><div class='box10 texIndbox' style='width: 19%;'><input type='text' id='vrno_"+itemId+"_"+incemntval+"' name='head_tax_ind11[]' class='form-control inputtaxInd' value="+getyear[0]+'&nbsp;'+getData.SERIES_CODE+'&nbsp;'+getData.VRNO+" readonly></div><div class='box10 rateIndbox tooltips'><input type='hidden' value="+getData.FY_CODE+" id='scfiscalyr_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.SERIES_CODE+" id='scseries_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.TRAN_CODE+" id='sctran_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.VRNO+" id='scvrno_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.SLNO+" id='scslno_"+itemId+"_"+incemntval+"'><input type='hidden' value="+tblbodyId+" id='scbodyid_"+itemId+"_"+incemntval+"'><input type='hidden' value="+tblheadId+" id='scheadid_"+itemId+"_"+incemntval+"'><input type='hidden' value='"+getData.PARTICULAR+"' id='scitmdisciptn_"+itemId+"_"+incemntval+"'><input type='text' id='itemcode_"+itemId+"_"+incemntval+"' name='itemco' class='form-control'  value='"+getData.ITEM_CODE+"("+getData.ITEM_NAME+")"+"' readonly><small class='tooltiptextitem tooltiphide' id='itemNameTooltip_"+itemId+"_"+incemntval+"'></small><input type='hidden' value="+getData.TAX_CODE+" id='taxCodeI_"+itemId+"_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='qtyOreder_"+itemId+"_"+incemntval+"' name='qtyOrder' class='form-control rightcontent' value="+getData.ORDERQTY+" readonly><input type='hidden' value="+getData.RATE+" id='sc_rate_"+itemId+"_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='qtySupply_"+itemId+"_"+incemntval+"' name='qtySupply[]' class='form-control rightcontent' value="+qtyissued+" readonly></div><div class='box10 rateIndbox'><input type='text' id='balence_qty_"+itemId+"_"+incemntval+"' name='balQty[]' class='form-control rightcontent' value="+getData.QTYISSUED+" readonly style='width: 111px;'><input type='hidden' class='form-control' id='remainBalQty_"+itemId+"_"+incemntval+"' value='' readonly></div></div>";

                      $('#itemListShow_'+itemId).append(tableBody);

                      $('#itemNameTooltip_'+itemId+'_'+incemntval).removeClass('tooltiphide');

                     $('#itemNameTooltip_'+itemId+'_'+incemntval).html(getData.ITEM_NAME);

                      getItemForCheckQty(itemId,incemntval);

                      inval = incemntval;

                      incemntval++;

                      }); // each loop close


                      var butn =  $('#footer_item_'+itemId).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                          var tablefooter = "<button type='button' class='btn btn-primary ' style='width: 27%;' data-dismiss='modal' id='ApplyOkitmbtn"+itemId+"' onclick='selectitem("+itemId+","+inval+");umAumByitm("+itemId+","+inval+");taxIntaxrate("+itemId+")'>Ok</button><button type='button' class='btn btn-danger notshowcnlbtn' data-dismiss='modal' style='width: 16%;' id='addbtnwhenselect"+itemId+"'>Cancel</button>";

                            $('#footer_item_'+itemId).append(tablefooter);

                         }else{

                         }

                          var selectedItem = $('#selectItem'+itemId).val();

                          var uniqByitm = $('#idsun'+itemId).val();

                          if(selectedItem){

                            $('#sr_'+uniqByitm).prop('checked',true);

                            $('#ApplyOkitmbtn'+itemId).prop('disabled',true);

                            $('#addbtnwhenselect'+itemId).removeClass('notshowcnlbtn');

                            $('input[name="itemname"]').each(function() {
                               //if not selected
                              if ($(this).is( ":not(:checked)")) {
                                // add disable
                                $(this).attr('disabled', 'disabled');
                              }
                            });

                          }


                    } /* else close*/

                } /* success if close*/


           }  /*success function close*/



      });  /*ajax close*/

  } /* ./ function*/

  function selectitem(rowid,itmebyid){

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

    $('#cancelQpbtn'+rowid).append(cnclbtnqp);

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

      
      $('#qty'+rowid).prop('readonly',false);
      $('#rate'+rowid).prop('readonly',false);
      $('#CalcTax'+rowid).prop('readonly',false);

      $('#vr_date,#series_code_sale,#Plant_code_sale,#account_code_sale,#shipTAddrs,#sale_rep_code,#costCent_code_sale,#party_ref_date,#tax_code_get,#contractNo,#purOrdervrno,#quotationNo,#tax_code,#due_days,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

      $('#vr_date').datepicker("destroy");
      $('#party_ref_date').datepicker("destroy");

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
                $('#vr_date,#series_code_sale,#Plant_code_sale,#account_code_sale,#shipTAddrs,#sale_rep_code,#costCent_code_sale,#party_ref_date,#tax_code_get,#contractNo,#purOrdervrno,#quotationNo,#tax_code,#due_days,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

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

   function getItemForCheckQty(rowI,calI){

    var itemGet = $('#itemcode_'+rowI+'_'+calI).val();

    var balenqty = $('#balence_qty_'+rowI+'_'+calI).val();

    var orderQty = $('#qtyOreder_'+rowI+'_'+calI).val();
    var suplyQty = $('#qtySupply_'+rowI+'_'+calI).val();

    //var remainBalQty = $('#remainBalQty_'+rowI+'_'+calI).val();

      var balenceQty =  orderQty - suplyQty;

      $('#balence_qty_'+rowI+'_'+calI).val(balenceQty.toFixed(3));

      if(orderQty == suplyQty){
        $('#hidebalNull_'+rowI+'_'+calI).hide();
      }else{
        $('#hidebalNull_'+rowI+'_'+calI).show();
      }

  }

  function umAumByitm(umaumvl,cfval){

      var itmcode =  $('#Item_CodeId'+umaumvl).val();
      var item_Code =  itmcode.split('(');
      var qtyBal =  $('#balQtyByItem'+umaumvl).val();

      var ItemCode = item_Code[0];

      var taxCode =  $('#getTaxCode').val();

      var qtyqc = $('#balence_qty_'+umaumvl+'_'+cfval).val();

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:"{{ url('get-item-um-aum') }}",

          method : "POST",

          type: "JSON",

          data: {ItemCode: ItemCode,taxCode:taxCode},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");    


                }else if(data1.response == 'success'){

                    if(data1.data==''){

                      var umcode = '';
                      var aumcode = '';
                      var cfactor = '';

                      $('#UnitM'+umaumvl).val(umcode);
                      $('#AddUnitM'+umaumvl).val(aumcode);
                      $('#Cfactor'+umaumvl).val(cfactor);

                    }else{

                      $('#UnitM'+umaumvl).val(data1.data[0].UM_CODE);
                      $('#AddUnitM'+umaumvl).val(data1.data[0].AUM_CODE);
                      $('#Cfactor'+umaumvl).val(data1.data[0].AUM_FACTOR);

                      var aQtycal = qtyBal * data1.data[0].AUM_FACTOR;
                      $('#A_qty'+umaumvl).val(aQtycal);

                      calculateBasicAmt(umaumvl);

                    }



                    if(data1.data_hsn==''){

                      var hsnCode= '';
                      var shHCode= '';
                      var itemName= '';

                      $('#hsn_code'+umaumvl).val(hsnCode);

                      $('#showHsnCd'+umaumvl).html(shHCode);
                      $('#Item_Name_id'+umaumvl).val(itemName);

                    }else{

                      $('#Item_Name_id'+umaumvl).val(data1.data_hsn.ITEM_NAME);

                      $('#hsn_code'+umaumvl).val(data1.data_hsn.HSN_CODE);

                      $('#showHsnCd'+umaumvl).html('HSN No : '+data1.data_hsn.HSN_CODE);
                      
                    }

                    if(data1.qua_pamter == ''){
                      $('#qua_paramter'+umaumvl).prop('disabled',true);
                    }else{
                      $('#qua_paramter'+umaumvl).prop('disabled',false);
                    }

                    if(data1.aumList==''){

                    }else{

                      $("#aumList"+umaumvl).empty();

                      $.each(data1.aumList, function(k, getAum){

                        $("#aumList"+umaumvl).append($('<option>',{

                          value:getAum.UM_CODE,

                          'data-xyz':getAum.UM_NAME,
                          text:getAum.UM_NAME

                        }));

                      });

                    }


                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }/*function close*/

</script>

<script type="text/javascript">
/*on click model*/
  

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

      var taxOnModel = $('#tax_code'+taxid).val();
      var basicAmt = $('#basic'+taxid).val();

      $('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt);

        var trans_code = $('#taxByItem'+taxid).val();
        var slordrHeadId = $('#sc_headid'+taxid).val();
        var slordrBodyId = $('#sc_bodyid'+taxid).val();
        var ItemCd = $('#ItemCodeId'+taxid).val();
        var Item_Cde = $('#itmC_code'+taxid).val();

        if(ItemCd){
          var ItemCode = ItemCd;
        }else if(Item_Cde){
          var ItemCode = Item_Cde;
        }


    if(taxOnModel == ''){

      var tax_code = $('#taxByItem'+taxid).val();

      $.ajax({

                url:"{{ url('get-a-field-calc-by-tax-in-sales')}}",

                method : "POST",

                type: "JSON",

                data: {trans_code:trans_code,tax_code:tax_code,slordrHeadId:slordrHeadId,slordrBodyId:slordrBodyId,ItemCode:ItemCode},

              beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },

              success:function(data){
                  //console.log(data);
                  var data1 = JSON.parse(data);
                   console.log('data1.data',data1.data);
                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      $("#CalcTax1").prop('disabled',false);
                        
                        if(data1.data==''){

                        }else{

                        var basicheadval = parseFloat($('#basic'+taxid).val());

                          var counter = 1;

                          var countI ='';
                          var dataI ='';

                          $('#tax_rate_'+taxid).empty();

                         var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div><div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div></div>";

                         $('#tax_rate_'+taxid).append(TableHeadData);

                          $.each(data1.data, function(k, getData) {

                            var datacount = data1.data.length;
                            dataI = datacount;
                                //console.log('count',datacount);
                                $('#data_count'+taxid).val(datacount);

                            if((getData.RATE_INDEX == null && getData.TAX_RATE == null) || (getData.RATE_INDEX == '-' && getData.TAX_RATE == '0.00')){

                             $('#tax_code'+taxid).val(getData.TAX_CODE);
                             
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly> <input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"> </div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control numerrightAlign' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control numerrightAlign' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''></div></div>";



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

                                //console.log('rate',javascript_array);
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></div><div class='box10 rateIndbox'> <input type='text' class='form-control' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+");'> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a> </div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control numerrightAlign' oninput='getGrandTotal("+taxid+");' ></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='numerrightAlign form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+taxAmt+"' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticIND+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'></div></div> <div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($ratval_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+");'>Apply</button></div></div></div></div>";

                              

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

                          console.log('if dataI',butn);
                         if(butn != 'Ok' || butn =='undefined'){

                          var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+taxid+"' onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",1);' style='width: 36px;'>Ok</button>";

                           $('#footer_tax_btn'+taxid).append(tblData);

                           /*  var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'  onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",0);'>Cancel</button>";
                             
                           $('#footer_ok_btn'+taxid).append(cancelfooter);*/

                         }else{
                         
                         }

                        //  console.log('butn',butn);
                         

                         
                        }
                     
                    } // success close

              }, //success function close

              complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },

      }); //ajax close 

    }else{

   // console.log('show');

    }

  } /*function close*/

  /*on click model*/


</script>


<script type="text/javascript">

  

  $(document).ready(function(){

    getvrnoBySeries();

    $( window ).on( "load", function() {

     var vrseqno = $('#vrseqnum').val();

     var vrlastnum = $('#vr_last_num').val();

      if(vrseqno == ''){

        $('#setdisable').prop('disabled',true);

      }else if(vrseqno==vrlastnum){

        $('#setdisable').prop('disabled',true);

      }else{

        $('#setdisable').prop('disabled',false);

      }


      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      var plant_code =  $('#Plant_code_sale').val();

      var plantscplit = plant_code.split('[');
      var Plant_code =plantscplit[0];

      $.ajax({

            url:"{{ url('Get-Pfct-Code-Name-By-Plant') }}",

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                 
                  if(data1.data == ''){
                       var profitctr = '';
                       var pfctget = '';
                       var pfctName = '';
                       var statec = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctName').val(pfctName);
                       $('#getPfctCode').val(pfctget);
                       $('#getStateByPlant').val(statec);
                    }else{
                      $('#profitctrId').val(data1.data[0].PFCT_CODE+'[ '+data1.data[0].PFCT_NAME+' ]');
                      $('#getPfctName').val(data1.data[0].PFCT_NAME);
                      $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                       $('#getStateByPlant').val(data1.data[0].STATE_CODE);

                    }

                }

            }

      });

    });

  });

</script>

<script type="text/javascript">

  function checkcheckbox(checkid){
    var itemCode = $('#Item_CodeId'+checkid).val();
    var checkedBox = $('#cBocID'+checkid).val();

    if ($('#cBocID'+checkid).is(':checked')) {

            var alreadyselItm = $('#checkitm').val();
    
            var itmaftercheck = $('#itmaftercheck').val();
           
            var explodITm = alreadyselItm.split(',');

            if(itmaftercheck){

                for(var w=0;w<=explodITm.length;w++){

                    if(explodITm[w] == itemCode){
                       $('#itmaftercheck').val(itmaftercheck+','+explodITm[w]);
                    }

                }

            }else{
                $('#itmaftercheck').val(itemCode);
            }
    }else{
            console.log('itemCode',itemCode);
          var itmafterUncheck = $('#itmaftercheck').val();
           
          var explodIUnChckTm = itmafterUncheck.split(',');


          const index = explodIUnChckTm.indexOf(itemCode);
          if (index > -1) {
            explodIUnChckTm.splice(index, 1);
          }

         $('#itmaftercheck').val(explodIUnChckTm);
    }

    
  }

  $(".delete").on('click', function() {

      $('.case:checkbox:checked').parents("tr").remove();

      $('.check_all').prop("checked", false); 

      rowWiseCalculation();

      var whenitmselect = $('#checkitm').val();
        var splt_arrayOne = whenitmselect.split(',');
        var whenitmcheck = $('#itmaftercheck').val();
        var splt_arrayTwo = whenitmcheck.split(',');

        splt_arrayOne = splt_arrayOne.filter(function(val) {
            return splt_arrayTwo.indexOf(val) == -1;
        });
         
        splt_arrayTwo = splt_arrayTwo.filter(val => !splt_arrayTwo.includes(val));
        $('#checkitm').val(splt_arrayOne);

        splt_arrayTwo = splt_arrayTwo.filter(function(val) {
            return splt_arrayOne.indexOf(val) == -1;
        });
         
        splt_arrayOne = splt_arrayOne.filter(val => !splt_arrayOne.includes(val));
        $('#itmaftercheck').val(splt_arrayOne);

      check();

  }); /*--function close--*/

  
  var i=2;
  var adrow=1;

  $(".addmore").on('click',function(){
      
      count=$('table tr').length;

      var notck = i - 1;

      var ifnotaply = $('#aplytaxOrNot'+notck).html();

      if(ifnotaply == 0){
         $("#taxNotAppied").modal('show');
         $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');
      }else{

        var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case' onclick='checkcheckbox("+i+");' id='cBocID"+i+"'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span></td>";

        data +="<td class='tdthtablebordr'><div class='input-group'><input type='text' class='inputboxclr itmbyQc' style='width: 90px;margin-bottom: 4px;margin-top: 13px;' id='Item_CodeId"+i+"' name='itemsale[]' onclick='ShowItemCode("+i+");' oninput='this.value = this.value.toUpperCase()' readonly /><input list='ItemList"+i+"' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' name='item_code[]'  onchange='ItemCodeGet("+i+"); taxIntaxrate("+i+");'  oninput='this.value = this.value.toUpperCase()' readonly /><datalist id='ItemList"+i+"'>@foreach ($item_list as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option> @endforeach</datalist></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><input type='hidden' id='idsun"+i+"'><input type='hidden' id='selectItem"+i+"'> <div class='divhsn' id='showHsnCd"+i+"'></div><input type='hidden' id='hsn_code"+i+"' name='hsn_code[]'> <input type='hidden' id='taxByItem"+i+"' name='tax_byitem[]'><input type='hidden' id='taxratebytax"+i+"' value=''><input type='hidden' id='sc_transcode"+i+"' name='sc_trans[]'> <input type='hidden' id='sc_seriescode"+i+"' name='sc_series[]'><input type='hidden' id='sc_vrno"+i+"' name='sc_vrno[]'><input type='hidden' id='sc_slno"+i+"' name='sc_slno[]'><input type='hidden' id='sc_headid"+i+"' name='sc_head[]'> <input type='hidden' id='sc_bodyid"+i+"' name='sc_body[]'><input type='hidden' id='itmC_code"+i+"' name='itemcodeC[]'><small id='itemnotFound"+i+"' style='color: red;'></small></td><td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></small><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description' readonly></textarea></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='qty"+i+"' name='qty[]' oninput='CalAQty("+i+")' style='width: 80px' readonly /><input type='text' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly><input type='hidden' id='Cfactor"+i+"'><input type='hidden' id='balQtyByItem"+i+"'></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly></div></td><td class='tdthtablebordr'><input type='text' class='debitcreditbox inputboxclr cr_amount SetInCenter' oninput='calculateBasicAmt("+i+")' id='rate"+i+"' name='rate[]'  style='width: 80px' readonly/><input type='hidden' id='qnrate"+i+"'></td><td class='tdthtablebordr'><input type='text' name='basic_amt[]' id='basic"+i+"' class='form-control basicamt debitcreditbox' style='width: 110px;margin-top: 14%;height: 22px;' readonly></td><td><input type='hidden' id='data_count"+i+"' class='dataCountCl' value='0' name='data_Count[]'><input type='hidden' class='setGrandAmnt' id='get_grand_num"+i+"' name='crAmtPerItem[]'><div style='margin-top: 23%;'><small id='taxnotfound"+i+"' class='label label-danger'></small></div><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='CalcTax"+i+"' data-toggle='modal' data-target='#tds_rate_model"+i+"' onclick='CalculateTax("+i+"); getGrandTotal("+i+");' disabled=''>Calc Tax </button><div id='aplytaxOrNot"+i+"' class='aplynotStatus'></div><div id='appliedbtn"+i+"'></div><div id='cancelbtn"+i+"'></div><div id='allItemShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-lg' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12' style='text-align: center;'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Details</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='itemListShow_"+i+"'></div></div><div class='modal-footer' style='text-align: center;' id='footer_item_"+i+"'></div></div></div></div><div id='taxSelectModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='font-weight: 800;'>Select Tax Code</h5></div></div></div><div class='modal-body table-responsive' style='text-align: initial;'><div id='showtaxcodeMul"+i+"' style='line-height: 23px;'></div></div><div class='modal-footer' style='text-align: center;' id='taxCodeSelect"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='taxIntaxrate("+i+");' style='width: 83px;'>Ok</button></div></div></div></div><div id='grateQtyShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5></div></div></div><div class='modal-body table-responsive'><p>Quantity is grater than balence qunatity</p></div><div class='modal-footer' style='text-align: center;' id='greatQtyFooter'><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='cancleGreatQty("+i+");'>ok</button></div></div></div></div><div id='greaterRateShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5></div></div></div><div class='modal-body table-responsive'><p>Rate Should Not Be Greater</p></div><div class='modal-footer' style='text-align: center;' id='greatRateFooter"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item name</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading1'><small id='itemCodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='taxcodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemDetailshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemtypeshow"+i+"'> </small></div> <div class='box10 itmdetlheading'><small id='itemgroupshow"+i+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemclassshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemcategoryshow"+i+"'> </small></div></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div></td>";

        $('table').append(data);

        var domModel = "<div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-5'><div class='form-group'> <lable class='settaxcodemodel col-md-4' style='padding: 0px;'>Tax Code - </lable> <input type='text' class='settaxcodemodel col-md-7' id='tax_code"+i+"' style='border: none; padding: 0px;' readonly> </div> </div><div class='col-md-6'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tax / Charges / etc Calculation</h5></div><div class='col-md-1'></div></div> </div> <div class='modal-body table-responsive'><div class='modalspinner hideloaderOnModl'></div><div class='boxer' id='tax_rate_"+i+"'><div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div> <div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div> </div> </div></div> <div class='modal-footer'><center><small  id='footer_ok_btn"+i+"'></small>&nbsp;&nbsp;<small style='width: 86px;'  id='footer_tax_btn"+i+"'></small></center>  </div></div></div> </div> <div id='HsnSameShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title' style='color: red;font-weight: 800;'>Alert !!</h5></div><div class='modal-body'><p>Header Tax Code <small id='headtaxCode"+i+"'></small> Is Different Than Item Wise Tax Code <small id='itmtaxCode"+i+"'></small></p></div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal' onclick='cancleblnkItm("+i+");'>Cancel</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div>";

        $('#domModel_2').append(domModel);

        var qpModlDom = "<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Qaulity Parameter</h5> </div> </div> </div><div class='modal-body table-responsive'> <div class='boxer' id='qua_par_"+i+"'></div> </div><div class='modal-footer'><center><small style='text-align: center;' id='footerqp_ok_btn"+i+"'></small>&nbsp;<small style='text-align: center;' id='footerqp_quality_btn"+i+"'></small></center> </div></div></div></div>";

        $('#quaPdomModel_2').append(qpModlDom);

        var saleContractNoIS = $('#saleConNo').val();
        if(saleContractNoIS ==''){
          $('#Item_CodeId'+i).addClass('itmbyQc');
          $('#ItemCodeId'+i).css('display','block');
          $('#ItemCodeId'+i).prop('readonly',false);
        }else{
          $('#Item_CodeId'+i).removeClass('itmbyQc');
          $('#ItemCodeId'+i).css('display','none');

        }

        var taxCode = $('#tax_code_get').val();

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            url:"{{ url('get-item-data-by-tax-state') }}",

            method : "POST",

            type: "JSON",

            data: {taxCode: taxCode},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                   if(data1.data ==''){

                   }else{
                      $("#ItemList"+adrow).empty();

                      $.each(data1.data, function(k, getData){

                          $("#ItemList"+adrow).append($('<option>',{

                            value:getData.ITEM_CODE,

                            'data-xyz':getData.ITEM_NAME,
                            text:getData.ITEM_NAME

                          }));

                      });

                   }

                }

            }

        });

        i++;
        adrow++;
      } /*else*/
  });  /*--function close--*/

  function rowWiseCalculation(){

      var bsic_amt = 0;

       $(".basicamt").each(function () {
          //add only if the value is number
          if (!isNaN(this.value) && this.value.length != 0) {
              bsic_amt += parseFloat(this.value);
          }

        $("#basicTotal").val(bsic_amt.toFixed(2));

      });

      var gr_amt =0;
       $(".setGrandAmnt").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                gr_amt += parseFloat(this.value);
            }

          $("#allgrandAmt").val(gr_amt.toFixed(2));

        });

      var taxCalC =0;
         $(".dataCountCl").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                taxCalC += parseFloat(this.value);
            }

          $("#allgetMCount").val(taxCalC.toFixed(2));

        });

      var basicAmnount = parseFloat($('#basicTotal').val());
      var allGrandAmount = parseFloat($('#allgrandAmt').val());
        
      var otherAmount = allGrandAmount - basicAmnount;
      $('#otherTotalAmt').val(otherAmount);

      var dataCl =0;
      $(".quaPcountrow").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            dataCl += parseFloat(this.value);
        }

      $("#allquaPcount").val(dataCl);

      });

  }

</script>

<script type="text/javascript">

  

  function ItemCodeGet(ItemId){

    $("#HsnSameShow"+ItemId).modal({
        show:false,
        backdrop:'static'
      });

      var ItemCode =  $('#ItemCodeId'+ItemId).val();
      var taxCode =  $('#tax_code_get').val();
      var accCode =  $('#account_code').val();

      var stateOfPlant = $('#getStateByPlant').val();
      var stateOfAcc   = $('#stateOfAcc').val();

      if(stateOfPlant == stateOfAcc){
        var taxType = 'SCGST'
      }else if(stateOfPlant != stateOfAcc){
         var taxType = 'IGST'
      }else{
          var taxType ='';
      }


      var xyz = $('#ItemList'+ItemId+' option').filter(function() {

          return this.value == ItemCode;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      

      if(msg=='No Match'){

             $('#ItemCodeId'+ItemId).val('');

             document.getElementById("Item_Name_id"+ItemId).value = '';

             $('#qty'+ItemId).val('');

             $('#A_qty'+ItemId).val('');
             $('#UnitM'+ItemId).val('');
             $('#AddUnitM'+ItemId).val('');
             $('#remark_data'+ItemId).val('');
             $('#hsn_code'+ItemId).val('');
             $('#showHsnCd'+ItemId).html('');
             $('#taxByItem'+ItemId).val('');
             $('#taxratebytax'+ItemId).val('');
             $('#rate'+ItemId).val('');
             $('#basic'+ItemId).val('');
             $('#get_grand_num'+ItemId).val('');
             $('#footer_tax_btn'+ItemId).html('');
             $('#data_count'+ItemId).val('');
             $('#CalcTax'+ItemId).hide();
             $('#qty'+ItemId).prop('readonly',true);
             $('#rate'+ItemId).prop('readonly',true);
             $('#remark_data'+ItemId).prop('readonly',true);
             $('#viewItemDetail'+ItemId).addClass('showdetail');
             $("#itemNameTooltip"+ItemId).addClass('tooltiphide');

             rowWiseCalculation();
      }else{

        $('#qty'+ItemId).val('');
          $('#A_qty'+ItemId).val('');
          $('#UnitM'+ItemId).val('');
          $('#AddUnitM'+ItemId).val('');
          $('#remark_data'+ItemId).val('');
          $('#hsn_code'+ItemId).val('');
          $('#showHsnCd'+ItemId).html('');
          $('#taxByItem'+ItemId).val('');
          $('#taxratebytax'+ItemId).val('');
          $('#rate'+ItemId).val('');
          $('#basic'+ItemId).val('');
          $('#get_grand_num'+ItemId).val('');
          $('#data_count'+ItemId).val('');
          $('#CalcTax'+ItemId).hide();
          $('#qty'+ItemId).prop('readonly',true);
          $('#rate'+ItemId).prop('readonly',true);
          $('#remark_data'+ItemId).prop('readonly',true);
          $('#viewItemDetail'+ItemId).addClass('showdetail');
          $("#itemNameTooltip"+ItemId).addClass('tooltiphide');
          $('#aplytaxOrNot'+ItemId).html('0');
          $('#footer_tax_btn'+ItemId).html('');
          $('#cancelbtn'+ItemId).html('');
          $('#appliedbtn'+ItemId).html('');
          $('#tax_code'+ItemId).val('');
          $('#quaP_count'+ItemId).val('');
          var cnclbtn ='<input type="hidden" value="0" id="qltyvalue'+ItemId+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

         $('#cancelbtn'+ItemId).html(cnclbtn);
         $('#data_count'+ItemId).val(0);
         $('#get_grand_num'+ItemId).val('');

         rowWiseCalculation();

         $('#appliedQpbtn'+ItemId).empty();
         $('#cancelQpbtn'+ItemId).empty();

          var cnclbtn ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelQpbtn'+ItemId).append(cnclbtn);
        $('#quaP_count'+ItemId).val(0);

        $('#viewItemDetail'+ItemId).removeClass('showdetail');

         document.getElementById("Item_Name_id"+ItemId).value = msg;

         $("#itemNameTooltip"+ItemId).removeClass('tooltiphide');

        $("#itemNameTooltip"+ItemId).html(msg);
        $('#itmC_code'+ItemId).val(ItemCode);

         $('#qty'+ItemId).prop('readonly',false);  
         $('#rate'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false);  

         $('#vr_date,#series_code_sale,#Plant_code_sale,#account_code_sale,#shipTAddrs,#sale_rep_code,#costCent_code_sale,#party_ref_date,#tax_code_get,#contractNo,#purOrdervrno,#quotationNo,#tax_code,#due_days,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

      $('#vr_date').datepicker("destroy");
      $('#party_ref_date').datepicker("destroy");

      }

      var itemCountchk = $('#itmCountchk').val();
      var orderNo = $('#saleConNo').val();

      if(orderNo){
         if(itmCountchk == 1){
          $('#addmorhidn').prop('disabled',true);
         }else{
          $('#addmorhidn').prop('disabled',false);
         }
      }else{
          $('#addmorhidn').prop('disabled',false);
      }

      if(ItemCode){

            $.ajaxSetup({

              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

            $.ajax({

                url:"{{ url('get-item-by-mul-tax-code') }}",

                method : "POST",

                type: "JSON",

                data: {ItemCode: ItemCode,taxCode:taxCode,accCode:accCode,taxType:taxType},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {

                          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                      }else if(data1.response == 'success'){

                        console.log('data1.data',data1.data);
                       
                          if(data1.data==''){

                            var umcode = '';

                            var aumcode = '';

                            var cfactor = '';

                            $('#UnitM'+ItemId).val(umcode);

                            $('#AddUnitM'+ItemId).val(aumcode);

                            $('#Cfactor'+ItemId).val(cfactor);

                          }else{

                            $('#UnitM'+ItemId).val(data1.data[0].UM_CODE);

                            $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                            $('#Cfactor'+ItemId).val(data1.data[0].AUM_FACTOR);

                          }

                          
                          if(data1.data_hsn==''){
                            var hsnCode= '';
                            var shHCode= '';
                            $('#hsn_code'+ItemId).val(hsnCode);
                            $('#showHsnCd'+ItemId).html(shHCode);
                          }else{
                            $('#hsn_code'+ItemId).val(data1.data_hsn.HSN_CODE);
                            $('#showHsnCd'+ItemId).html('HSN No : '+data1.data_hsn.HSN_CODE);
                          }
                          //console.log(data1.data_enq);
                         
                          if(data1.data_quaPar == ''){
                            $('#qua_paramter'+ItemId).prop('disabled',true);
                          }else{
                            $('#qua_paramter'+ItemId).prop('disabled',false);
                          }

                          if(data1.aumList==''){

                          }else{

                            $("#aumList"+ItemId).empty();
                            $.each(data1.aumList, function(k, getAum){

                              $("#aumList"+ItemId).append($('<option>',{

                                value:getAum.UM_CODE,

                                'data-xyz':getAum.UM_NAME,
                                text:getAum.UM_NAME

                              }));

                            });

                          }

                          if(taxCode){

                            if(data1.data_tax == ''){
                                
                                $('#taxByItem'+ItemId).val('');
                            }else{

                              var taxByhsn = data1.data_tax[0].TAX_CODE;
                              console.log('taxByhsn',taxByhsn);
                              if(taxCode != data1.data_tax[0].TAX_CODE){
                                $("#HsnSameShow"+ItemId).modal('show');

                                $('#headtaxCode'+ItemId).html('<b>( '+taxCode+' )</b>');
                                $('#itmtaxCode'+ItemId).html('<b>( '+taxByhsn+' )</b>');
                              }
                              
                              $('#taxByItem'+ItemId).val(taxByhsn);
                            }

                          }else{

                            if(data1.data_tax==''){

                            }else{

                            $('#taxSelectModel'+ItemId).modal('show');
                            $('#showtaxcodeMul'+ItemId).empty();
                            $.each(data1.data_tax, function(k, gettax){

                              var taxData = '<input type="radio" class="taxcodeset" id="html" name="taxcodeit" value="'+gettax.TAX_CODE+'"> <label for="html">'+gettax.TAX_CODE+' ('+gettax.TAX_NAME+' )</label><br>';
                              $('#showtaxcodeMul'+ItemId).append(taxData);
                                
                            });
                            }

                          }

                          //console.log(data1.data_tax[0]);

                      } /*if close*/

                 }  /*success function close*/

            });  /*ajax close*/

      } /* . /if*/

  }/*function close*/


  function taxIntaxrate(trateid){
    setTimeout(function() {

      var taxCodebyitm =  $('#taxByItem'+trateid).val();

      var taxCSelect= $("input[type='radio'][name='taxcodeit']:checked").val();

      if(taxCSelect){
        var taxCode = taxCSelect;
        $('#taxByItem'+trateid).val(taxCode);
      }else if(taxCodebyitm){
        var taxCode = taxCodebyitm;
      }else{}

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

          url:"{{ url('check-tax-in-tax-rate') }}",

          method : "POST",

          type: "JSON",

          data: {taxCode: taxCode},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){
                
                    if(data1.data == ''){
                       var taxrate1 = '';
                       $('#taxratebytax'+trateid).val(taxrate1);
                    }else{
                      $('#taxratebytax'+trateid).val(data1.data[0].TAX_CODE);
                      
                    }

                     var taxrate = $('#taxratebytax'+trateid).val();

                    if(taxrate == ''){
                        $('#CalcTax'+trateid).hide();
                        $('#taxnotfound'+trateid).html('Not Found');
                      }else{
                        $('#CalcTax'+trateid).show();
                        $('#taxnotfound'+trateid).html('');
                      }

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

       
     
     }, 500);
  }

  function cancleblnkItm(canclid){
      $('#ItemCodeId'+canclid).val('');
      $('#Item_Name_id'+canclid).val('');
      $('#UnitM'+canclid).val('');
      $('#Cfactor'+canclid).val('');
      $('#AddUnitM'+canclid).val('');
      $('#hsn_code'+canclid).val('');
      $('#showHsnCd'+canclid).html('');
      $('#taxByItem'+canclid).val('');
      $('#qty'+canclid).val('');
      $('#A_qty'+canclid).val('');
  }



</script>



<script type="text/javascript">

  function submitAllData(valD){
    var downloadFlg = valD;
    $('#donwloadStatus').val(downloadFlg);

    var trcount=$('table tr').length;
    var grandAmt = $('#allgrandAmt').val();

    var valuetax= [];
      for(var y=0;y<trcount;y++){
        var trid = y+1;
       var ifnotaply = $('#aplytaxOrNot'+trid).html();

        valuetax.push(ifnotaply);
       
      }

      var found = valuetax.find(function (element) {
        return element == 0;
      });

       if(found == 0 && grandAmt < 0){
            $("#taxNotAppied").modal('show');
            $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');
            $('#grAmtIsGreatMsg').html('The <b>Grand Amount</b> Should Not Be Negative');
        }else if(found == 0){
              $("#taxNotAppied").modal('show');
              $('#grAmtIsGreatMsg').html('');
              $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');
              
        }else if(grandAmt < 0){
            $("#taxNotAppied").modal('show');
               $('#taxnotApMsg').html('');
            $('#grAmtIsGreatMsg').html('The <b>Grand Amount</b> Should Not Be Negative');
            
        }else{

          var data = $("#salesQuoTrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/Transaction/Sales/Save-Direct-Sales-Trans') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {
                  var responseVar = false;
                  var url = "{{url('Transaction/Sales/Sales-Bill-Save-Msg')}}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });
                }else{
                  var responseVar = true;
                  if(downloadFlg == 1){
                    var fyYear   = data1.data[0].FY_CODE;
                    var fyCd     = fyYear.split('-');
                    var seriesCd = data1.data[0].SERIES_CODE;
                    var vrNo     = data1.data[0].VRNO;
                    var fileN    = 'SDBILL_'+fyCd[0]+''+seriesCd+''+vrNo;
                    var link = document.createElement('a');
                    link.href = data1.url;
                    link.download = fileN+'.pdf';
                    link.dispatchEvent(new MouseEvent('click'));
                  }
                  var url = "{{url('Transaction/Sales/Sales-Bill-Save-Msg')}}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });
                }
              },

          });

      }

  }


</script>


<script type="text/javascript">

  function qty_parameter(qty){

   var ItmCdbyq = $("#ItemCodeId"+qty).val();
   var ItmCd = $("#Item_CodeId"+qty).val();
   var sc_headid = $("#sc_headid"+qty).val();
   var sc_bodyid = $("#sc_bodyid"+qty).val();

    if(ItmCdbyq){
      var ItemCode = ItmCdbyq;
    }else if(ItmCd){
      var ItemCode = ItmCd;
    }

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
    });

    $.ajax({

        type: 'POST',

        url: "{{ url('/get-quo-paramter-for-item-sales') }}",

        data: {ItemCode:ItemCode,sc_headid:sc_headid,sc_bodyid:sc_bodyid}, // here $(this) refers to the ajax object not form
        success: function (data) {

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                  if(data1.data==''){

                    }else{

                      $('#qua_par_'+qty).empty();

                       var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

                      $('#qua_par_'+qty).append(TableHeadData);

                      var sr_no=1;
                      $.each(data1.data, function(k, getData) {

                        if(data1.item_code){
                          var item_code = data1.item_code;
                        }else if(getData.ITEM_CODE){
                           var item_code = getData.ITEM_CODE;
                        }

                        if(getData.IQUA_CODE){
                          var IQUACHAR = getData.IQUA_CODE;
                        }else if(getData.IQUA_CHAR){
                           var IQUACHAR = getData.IQUA_CHAR;
                        }

                        if(getData.CHAR_FROMVALUE){
                          var FROM_VALUE = getData.CHAR_FROMVALUE;
                        }else if(getData.VALUE_FROM){
                           var FROM_VALUE = getData.VALUE_FROM;
                        }

                        if(getData.CHAR_TOVALUE){
                          var TO_VALUE = getData.CHAR_TOVALUE;
                        }else if(getData.VALUE_TO){
                           var TO_VALUE = getData.VALUE_TO;
                        }

                        var quaP_count = data1.data.length;
                        $('#quaP_count'+qty).val(quaP_count);

                        var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.ICATG_CODE+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+IQUACHAR+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+FROM_VALUE+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+TO_VALUE+" ></div></div> ";

                        $('#qua_par_'+qty).append(TableBody);
                        
                        sr_no++ 
                      });


                      var butn =  $('#footerqp_quality_btn'+qty).find(':button').html();

                      if(butn != 'Ok' || butn =='undefined'){

                        var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+qty+"' onclick='getQuaPvalue("+qty+",1)' style='width: 36px;'>Ok</button>";

                        $('#footerqp_quality_btn'+qty).append(tblData);

                        var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'   onclick='getQuaPvalue("+qty+",0)'>Cancel</button>";
                         
                        $('#footerqp_ok_btn'+qty).append(cancelfooter);

                      }else{
                      
                      }

                    }

                }
       
        
        },

    });

  }

/*  function simulationcal(){

    var taxRowCount =[];
    var taxAmount   =[];
    var taxGl       =[];
    var taxRateInd  =[];
    var taxIndCode  =[];

    $('input[name^="data_Count"]').each(function (){
          taxRowCount.push($(this).val());
    });

    $('input[name^="amount"]').each(function (){
          taxAmount.push($(this).val());
    });

    $('input[name^="taxGlCode"]').each(function (){
          taxGl.push($(this).val());
    });

    $('input[name^="rate_ind"]').each(function (){
          taxRateInd.push($(this).val());
    });

    $('input[name^="taxIndCode"]').each(function (){
          taxIndCode.push($(this).val());
    });

    var seriesGl    = $('#seriesGl').val();
    var acc_Code    = $('#account_code_sale').val();
    var splitAccCd  = acc_Code.split('[');
    var accountCode = splitAccCd[0];

    $.ajax({

      

      method : "POST",

      type: "JSON",

      data: {taxRowCount: taxRowCount,taxAmount:taxAmount,taxGl:taxGl,taxRateInd:taxRateInd,taxIndCode:taxIndCode,seriesGl:seriesGl,accountCode:accountCode},

      success:function(data){

        var data1 = JSON.parse(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){

        }

      }


    });


  }*/

</script>



@endsection