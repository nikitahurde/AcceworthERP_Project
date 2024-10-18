@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ URL::asset('public/dist/css/viewCss/commonCss.css') }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  table {
     border-collapse: collapse;
  }

  ::placeholder {
    text-align:left;
  }

  .secondSection{
    display: none;
  }
  .tolrancehide{
    display: none !important;
  }
  .showind_Ch{
    display: none;
  }
  .itmbyQc{
    display: none;
  }
  .notshowcnlbtn{
    display: none;
  }
  .aplynotStatus{
    display: none;
  }
  .hidebatchnoinput{
    display: none;
  }
  .texIndbox {
    width: 3%;
    text-align: center;
  }
  .itemIndbox {
    width: 20%;
    text-align: center;
  }
  .showdetail{
    display: none;
  }
  .modalScrlBar{
    border-radius: 5px;
    overflow-y: scroll;
    height: 512px;
  }
  .codeIndBox{
    width:20%;
  }
  .nameIndBox{
    width:40%;
  }
  .amountIndBox{
    width:20%;
    text-align: right;
  }
  .totlLable {
    text-align: center;
    margin-top: 7px;
    font-weight: 700;
  }

  @media screen and (max-width: 600px) {

    .PageTitle{
      float: left;
    }

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

  }


</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <!-- section open -->
  <section class="content-header">

    <h1>

      Direct Purchase Bill Transaction

      <small>Add Details</small>

    </h1>

    <ul class="breadcrumb">

      <li>

        <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>

      </li>

      <li>

        <a href="{{ url('/dashboard') }}">Transaction</a>

      </li>

      <li class="active">

        <a href="{{ url('/Transaction/Purchase/Direct-Purchase-Bill-Trans') }}"> Direct Purchase Bill </a>

      </li>

    </ul>

  </section>
  <!-- section close -->

<form id="grntrans">

  @csrf

  <!-- section open -->
  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Direct Purchase Bill Transaction</h2>

            <div class="box-tools pull-right">

                <a href="{{ url('/Transaction/Purchase/view-Good-Reciept-Note-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

                    </div>

                    <div class="panel-body">

                      <div class="tab-content">

                        <div class="tab-pane fade in active" id="tab1info">

                          <div class="row">
                              <!-- /.col -->
                            <div class="col-md-2">

                              <div class="form-group">
                                <input type="hidden" value="<?php echo session()->get('macc_year');?>" id="currentyear">
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

                                  <input type="text" class="form-control transdatepicker rightcontent" name="trans_date" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

                                </div>

                                <small id="showmsgfordate" style="color: red;"></small>

                              </div><!-- /.form-group -->

                            </div><!--  /. column close -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label> T Code : </label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="trans_code" value="<?php if(isset($trans_head)){echo $trans_head;}?>" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                                    <input type="hidden" id="transtaxCode" >

                                  </div>

                              </div><!-- /.form-group -->

                            </div> <!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Series Code: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>
                                  <?php $secount = count($series_list); ?>
                                  <input list="seriesList1"  id="series_code" name="series_code" class="form-control  pull-left" value="<?php if($secount == 1){echo $series_list[0]->SERIES_CODE;} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off" onchange="getvrnoBySeries()">

                                    <datalist id="seriesList1">

                                      <option selected="selected" value="">-- Select --</option>

                                        @foreach ($series_list as $key)

                                          <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                                        @endforeach

                                    </datalist>

                                </div>
                                <input type="hidden" id="seriesGl" name="seriesGl">
                                <small id="serscode_err" style="color: red;" class="form-text text-muted"></small>

                                <small id="series_code_errr" style="color: red;"></small>

                              </div><!-- /.form-group -->

                            </div><!-- /.col -->

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Series Name: 

                                  <span class="required-field"></span>

                                </label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input   id="seriesText" name="series_name" class="form-control  pull-left" value="<?php if($secount == 1){echo $series_list[0]->SERIES_NAME;} ?>" placeholder="Select Series" readonly autocomplete="off">

                                </div>

                              </div><!-- /.form-group -->

                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label> Vr No: </label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                  <input type="hidden" name="" value="<?php if(isset($to_num)){echo $to_num;}?>" id="vr_last_num">

                                  <input type="text" class="form-control rightcontent" name="vr_no" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                                </div>

                              </div> <!-- /.form-group -->

                            </div><!-- /.col -->

                          </div><!-- /.row -->

                          <div class="row">

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Plant Code: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>
                                  <?php $plCount = count($getplant); ?>
                                  <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" value="<?php if($plCount==1){echo $getplant[0]->PLANT_CODE;} ?>" placeholder="Select Plant" maxlength="11" autocomplete="off">

                                    <datalist id="PlantcodeList">

                                      <option value="">--SELECT--</option>

                                       @foreach ($getplant as $key)

                                          <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

                                        @endforeach

                                    </datalist>

                                </div>

                                <small id="plant_err" style="color: red;"> </small>
                                <input type="hidden" id="getStateByPlant" name="stateByPlant">

                              </div><!-- /.form-group -->

                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Plant Name: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input  class="form-control" id="plantText" name="plant_name" value="<?php if($plCount==1){echo $getplant[0]->PLANT_NAME;} ?>" placeholder="Select Plant" maxlength="11" readonly autocomplete="off">

                                </div>

                              </div><!-- /.form-group -->

                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Profit Center Code: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input list="profitList"  id="profitctrId" name="pfct_code" class="form-control  pull-left" value="{{ old('pfct')}}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">
                          
                                </div>

                                <small id="profit_center_err" style="color: red;"> </small>

                              </div><!-- /.form-group -->

                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Profit Center Name: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input  id="profitText" name="pfct_name" class="form-control  pull-left" value="" placeholder="Select Profit Center Name"  readonly autocomplete="off">

                                </div>

                              </div><!-- /.form-roup -->

                            </div> <!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Vendor Code : <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>
                                  <?php $getacccount = count($getacc); ?>
                                  <input list="AccountList"  id="account_code" name="accountCode" class="form-control  pull-left" value="<?php if($getacccount==1){echo $getacc[0]->ACC_CODE;} ?>" placeholder="Select Vendor" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getpurOrderNum()">

                                  <datalist id="AccountList">

                                    <option selected="selected" value="">-- Select --</option>

                                      @foreach ($getacc as $key)

                                      <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                                      @endforeach

                                  </datalist>

                                </div>
                                <input type="hidden" id="accGl" name="accountGl">
                                <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                                <small id="acccode_code_errr" style="color: red;"></small>

                              </div> <!-- /.form-group -->

                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Vendor Name : <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input  id="AccountText" name="account_name" class="form-control  pull-left" value="<?php if($getacccount==1){echo $getacc[0]->ACC_NAME;} ?>" placeholder="Select Vendor" readonly autocomplete="off">

                                </div>
                               
                              </div><!-- /.form-group -->

                            </div><!-- /.col -->

                          </div> <!-- row -->

                          <div class="row">

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Consignor/Delevory From: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon" style="padding: 4px 12px;">

                                    <i class="fa fa-newspaper-o " aria-hidden="true"></i>

                                  </span>
                                  
                                  <input list="shipTAdd"  id="shipTAddr" class="form-control  pull-left" value="" name="consignor_name" placeholder="Select Consignor/Delevory From" autocomplete="off"> 

                                  <datalist id="shipTAdd">

                                    <option selected="selected" value="">-- Select --</option>

                                  </datalist>

                                </div>
                                <input type="hidden" id="addId" value="">
                                <input type="hidden" value="" id="stateOfAcc">

                              </div><!-- /.form-group -->

                            </div>

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Cost Center Code: <span class="required-field"></span></label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>
                                    <?php $costCd = count($cost_list); ?>

                                    <input list="Costcode_List" class="form-control" id="costCent_code" name="Cost_Center" placeholder="Select Cost Center Code" maxlength="55" value="<?php if($costCd == 1){echo $cost_list[0]->COST_CODE; echo "[ ".$cost_list[0]->COST_NAME." ]";}?>"  autocomplete="off">

                                    <datalist id="Costcode_List">

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

                              </div><!-- /.form-group -->

                            </div> <!-- /.col -->

                            <div class="col-md-3">

                              <div class="form-group">

                                <label> Cost Center Name : </label>

                                  <div class="input-group tooltips">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>

                                    <input type="text" class="form-control" name="CostName" value="<?php if($costCd == 1){echo $cost_list[0]->COST_NAME;}else{} ?>" id="costcenName" placeholder="Enter Cost Center Name" readonly autocomplete="off">

                                  </div>

                              </div>
                              
                            </div>

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Purchase Order No : </label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input  list="poVrnoList" id="purOrdervrno" name="purOrderNo" class="form-control  pull-left" value="" placeholder="Select Account" onchange="getITmDataByPo()" readonly autocomplete="off">

                                  <datalist id="poVrnoList">
                                    
                                  </datalist>

                                </div>
                                <small id="povrnoNotFound"></small>
                                <input type="hidden" id="itmCountchk">
                              </div>
                                  <!-- /.form-group -->
                            </div><!-- /.col -->

                          </div><!-- /.row -->

                          <div class="row">

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Tax Code: 


                                </label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>
                                  <?php $taxCount = count($tax_code_list); ?>
                                  <input list="TaxcodeList"  id="tax_code" name="tax_code" class="form-control  pull-left" value="<?php if($taxCount == 1){echo $tax_code_list[0]->tax_code;}else{echo old('taxcode');} ?>" placeholder="Select Tax" onchange="getitmByTax();" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

                                  <datalist id="TaxcodeList">

                                    <option selected="selected" value="">-- Select --</option>

                                    @foreach ($tax_code_list as $key)

                                    <option value='<?php echo $key->TAX_CODE?>'   data-xyz ="<?php echo $key->TAX_NAME; ?>" ><?php echo $key->TAX_NAME ; echo " [".$key->TAX_CODE."]" ; ?></option>

                                    @endforeach

                                  </datalist>

                                </div>

                                <small id="serscode_err" style="color: red;" class="form-text text-muted"> </small>
                                <small id="Taxcode_name" style="color:#649fc0;font-weight: 700;"></small>
                                <small id="Taxcode_errr" style="color: red;"></small>

                              </div><!-- /.form-group -->

                            </div><!-- /.col -->

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Party Bill No: 
                                  <span class="required-field"></span>
                                </label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>

                                    <input type="text" id="partyBillNo" name="partyBillNo" class="form-control  pull-left Number" value="" placeholder="Enter Party Bill No" autocomplete="off" style="text-align: end;">

                                  </div>

                              </div><!-- /.form-group -->

                            </div> <!-- /.col -->

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Party Bill Date: <span class="required-field"></span></label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  
                                    <input type="text" class="form-control partyBillDate rightcontent" name="partyBillDate" id="partyBillDate" value="" placeholder="Select Party Bill Date" autocomplete="off">

                                  </div>
                              </div>
                                  <!-- /.form-group -->
                            </div>

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Party Bill Amount: <span class="required-field"></span></label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  
                                    <input type="text" class="form-control rightcontent" name="partyBillAmount" id="partyBillAmount" value="" placeholder="Select Party Bill Amount" autocomplete="off">

                                  </div>
                              </div>
                                  <!-- /.form-group -->
                            </div>

                          </div> <!-- row -->

                          <div class="row">
                              <div class="col-md-3">

                              <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 1px;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>

                            </div>
                          </div>

                        </div>
                       <!-- /.tab first -->

                        <div class="tab-pane fade" id="tab2info">

                          <div class="row">

                            <div class="col-md-3">
                                
                              <div class="form-group">

                                <label>Party Ref No :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="party_ref_no" id="party_rf_no" placeholder="Enter Party Ref No" maxlength="30" autocomplete="off">

                                </div>

                                <small id="emailHelp" class="form-text text-muted">
                                </small>

                              </div>

                            </div><!-- ./col -->

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Party Ref Date:</label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                                         $ToDate= date("d-m-Y", strtotime($toDate));  
                                      ?>

                                    <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy_1">

                                    <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy_1">

                                    <input type="text" class="form-control partyrefdatepicker" name="party_ref_date" id="party_ref_date" value="{{ $vrDate }}"  placeholder="Select Party Ref Date" autocomplete="off">

                                  </div>

                                  <small id="showmsgfordate_1" style="color: red;"></small>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                              </div>
                              <!-- /.form-group -->
                            </div><!-- ./col -->

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Vendor Qc Name : </label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>

                                    <input type="text"  id="vendor_qc_name" name="" class="form-control pull-left" value="" placeholder="Enter Vendor Qc Name" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                                  </div>

                              </div>
                                  <!-- /.form-group -->
                            </div><!-- ./col -->

                          </div><!-- ./row -->

                          <div class="row">

                            <?php foreach ($series_list as $rfhead) {

                                if(isset($rfhead->RFHEAD1) && $rfhead->RFHEAD1 !=''){

                             ?>

                            <div class="col-md-4">

                              <div class="form-group">

                                <label><?php echo $rfhead->RFHEAD1 ?> :</label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                      <input type="text" class="form-control" name="rfhead1" placeholder="Enter Rfhead1" maxlength="30" id="rfhead1" oninput="rfheadget(1)" autocomplete="off">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted"></small>

                              </div>

                            </div>
                            <!-- ./col -->

                            <?php }else{} } ?>

                            <?php foreach ($series_list as $rfhead) {

                                if(isset($rfhead->RFHEAD2) && $rfhead->RFHEAD2 !=''){ 
                            ?>

                            <div class="col-md-4">

                              <div class="form-group">

                                <label><?php echo $rfhead->RFHEAD2 ?> :</label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="rfhead2" placeholder="Enter Rfhead2" maxlength="30" id="rfhead2" oninput="rfheadget(2)" autocomplete="off">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted"></small>

                              </div>

                            </div><!-- ./col -->

                            <?php }else{} } ?>

                            <?php foreach ($series_list as $rfhead) {

                                if(isset($rfhead->RFHEAD3) && $rfhead->RFHEAD3 !=''){

                            ?>

                            <div class="col-md-4">

                              <div class="form-group">

                                <label><?php echo $rfhead->RFHEAD3 ?> :</label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="rfhead3" id="rfhead3" placeholder="Enter Rfhead3" maxlength="30" oninput="rfheadget(3)" autocomplete="off">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted"></small>

                              </div>

                            </div>
                            <!-- ./col -->
                            <?php }else{} } ?>

                          </div><!-- ./row --> 

                          <div class="row">
                              
                            <?php foreach ($series_list as $rfhead) {

                                if(isset($rfhead->RFHEAD4) && $rfhead->RFHEAD4 !=''){

                            ?>
                            <div class="col-md-4">

                              <div class="form-group">

                                <label><?php echo $rfhead->RFHEAD4 ?> :</label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="rfhead4" placeholder="Enter Rfhead4" maxlength="30" id="rfhead4" oninput="rfheadget(4)" autocomplete="off">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted"></small>

                              </div>

                            </div>
                            <!-- ./col -->
                            <?php }else{} } ?>

                            <?php foreach ($series_list as $rfhead) {

                                if(isset($rfhead->RFHEAD5) && $rfhead->RFHEAD5 !=''){

                            ?>

                            <div class="col-md-4">

                              <div class="form-group">

                                <label><?php echo $rfhead->RFHEAD5 ?> :</label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="rfhead5" placeholder="Enter Rfhead5" maxlength="30" id="rfhead5" oninput="rfheadget(5)" autocomplete="off">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted"> </small>

                              </div>

                            </div><!-- ./col -->

                            <?php }else{} } ?>

                            <div class="col-md-4">

                                <a class="btn btn-info"  href="#tab1info" data-toggle="tab" style="margin-top: 26px;" id="previousbtn" >Previous&nbsp;&nbsp;<i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>

                            </div>

                          </div><!-- ./row -->

                        </div><!--  ./2 tab -->

                      </div><!--  ./ tab content -->

                    </div><!-- panel body -->

                  </div><!-- ./panel with-nav-tabs panel-info -->

                </div><!-- ./col -->

              </div><!-- ./row -->

          </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->

  <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                 

                  <tr>

                    <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>
                    <th style="width: 10px;"> Sr.No.</th>
                    <th>Item Code</th>
                    <th>Item Name</th>
                    <th>Qty</th>
                    <th>A-Qty</th>
                    <th>Rate</th>
                    <th>Basic</th>
                    <th>Tax</th>
                    <th>Quality Paramter</th>

                  </tr>

                  <tr class="useful">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case'  id="cBocID1" onclick="checkcheckbox(1);" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">1.</span>
                    </td> 

                    <td class="tdthtablebordr">

                      <div class="input-group">
                        <input type="text" class="inputboxclr itmbyQc" style="width: 90px;margin-bottom: 4px;margin-top: 13px;" id='Item_CodeId1' name="itemPo[]" onclick="ShowItemCode(1);"  oninput="this.value = this.value.toUpperCase()" readonly />
                        <input list="ItemList1" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId1' name="item_code[]"  onchange="ItemCodeGet(1);taxIntaxrate(1);" oninput="this.value = this.value.toUpperCase()" />

                        <datalist id="ItemList1">

                            <option selected="selected" value="">-- Select --</option>

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
                      <input type="hidden" id="po_transcode1" name="po_trans[]">
                      <input type="hidden" id="po_seriescode1" name="po_series[]">
                      <input type="hidden" id="po_vrno1" name="po_vrno[]">
                      <input type="hidden" id="po_slno1" name="po_slno[]">
                      <input type="hidden" id="po_headid1" name="po_head[]">
                      <input type="hidden" id="po_bodyid1" name="po_body[]">
                      <input type="hidden" id="itmC_code1" name="itemcodeC[]">
                      <input type="hidden" id="itemglCode1" name="itemglCode[]">

                      <small id='itemnotFound1' style="color: red;"></small>

                    </td>

                    <td class="tdthtablebordr">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id1' name="item_name[]" readonly />

                      <textarea id="remark_data1" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description" readonly></textarea>

                      <div class="hidebatchnoinput" id="hsbatchno1">
                        <div class="setbatchnoandref">
                            <small class="batchNoC">Batch No : </small>
                            <textarea id="batchNumget1" rows="1" class="showbatchnum" name="batchNo[]" placeholder="Enter Batch No" readonly></textarea>
                        </div>
                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                        <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='qty1' name="qty[]" oninput="CalAQty(1)" style="width: 80px"  />

                        <input type="text" name="unit_M[]" id="UnitM1" class="inputboxclr SetInCenter AddM" readonly>

                        <input type="hidden" id="Cfactor1">
                        <input type="hidden" id="balQtyByItem1">

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                        <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty1' name="Aqty[]"  style="width: 80px" readonly />

                        <input list="aumList1" name="add_unit_M[]" id="AddUnitM1" class="inputboxclr SetInCenter AddMList" onchange="changeAum(1)">

                        <datalist id="aumList1">
                          <option value="">--select--</option>
                        </datalist>

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <input type='text' class="debitcreditbox inputboxclr cr_amount SetInCenter" oninput="calculateBasicAmt(1)" id='rate1' name="rate[]"  style="width: 80px" readonly/>
                      <input type="hidden" id="qnrate1">
                    </td>

                    <td class="tdthtablebordr">

                       <input type="text" name="basic_amt[]" id="basic1" class="form-control basicamt" style="width: 110px;margin-top: 14%;height: 22px;" readonly>

                    </td>

                    <td>

                      <input type="hidden" id="data_count1" class="dataCountCl"   value="" name="data_Count[]">

                      <input type="hidden" class="setGrandAmnt" id="get_grand_num1" name="dr_grandAmt[]">

                      <div style="margin-top: 23%;">

                        <small id="taxnotfound1" class="label label-danger"></small>

                      </div>

                      <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1); getGrandTotal(1);" disabled="">Calc Tax </button>

                        <div id="appliedbtn1"></div>
                        <div id="cancelbtn1"></div>
                        <div id="aplytaxOrNot1" class="aplynotStatus">0</div>

                    </td> 

                    <td>
                        
                      <div style="margin-top: 12%;">
                        <small id="qpnotfound1" class="label label-danger"></small>
                      </div>
                      <input type="hidden" id='quaP_count1' value="0" name="quaP_count[]" class="quaPcountrow">
                      <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="qua_paramter1" data-toggle="modal" data-target="#quality_parametr1" onclick="qty_parameter(1)" disabled="" style="padding-bottom: 0px;padding-top: 0px;">Quality Parametr </button>

                      <div id="cancelQpbtn1"></div>
                      <div id="appliedQpbtn1"></div>
                        
                      <div id="qpApplyOrNot1" class="aplynotStatus">0</div>

                      <small id="qPnotfountbtn1" class="label label-danger"></small>

                    </td>

                  </tr>

                </table>

              </div><!-- ./div table -->

              <div class="row">

                <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                <input type="hidden" id="checkitm">
                <input type="hidden" id="itmaftercheck">
                <input type="hidden" id="taxCodesellist">
                <input type="hidden" id="allgetMCount" name="getdatacount">

                <div class="col-sm-12" style="display: flex;">

                  <div style="width:50%;">

                    <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                    <button type="button" class='btn btn-info addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
                    
                  </div>
                  <div style="width:21%;"></div>
                  <div style="width:10%;"><div class="totlLable">Basic Total :</div></div>
                  <div style="width:10%;">
                    
                    <input class="inputboxclr" type="text" name="TotalBasciAmt" id="basicTotal" readonly="" style="margin-top: 3px;">  

                  </div>
                </div><!-- /.col-sm12 -->

                <div class="row" >

                  <div class="col-sm-12" style="display: flex;">
                    <div style="width:50%;"></div>
                    <div style="width:20%;"></div>
                    <div style="width:10%;"><div class="totlLable">Other Total :</div></div>
                    <div style="width:10%;">
                      
                      <input class="inputboxclr" type="text" name="TotalOtherAmt" id="otherTotalAmt" readonly="" style="margin-top: 3px;"> 

                    </div>
                  </div>  
                </div><!-- /.row -->

                <div class="row" >
                  <div class="col-sm-12" style="display: flex;">
                    <div style="width:50%;"></div>
                    <div style="width:20%;"></div>
                    <div style="width:10%;"><div class="totlLable">Grand Total :</div></div>
                    <div style="width:10%;">
                      <input class="inputboxclr" type="text" name="TotalGrandAmt" id="allgrandAmt" readonly="" style="margin-top: 3px;">  
                    </div>
                  </div>    
                </div><!-- /.row -->

              </div><!-- /.row -->

              <p class="text-center">

                <button type="button" class="btn btn-primary btn-xs" id="simulationbtn" data-toggle="modal" data-target="#simulation_model" onclick="simulationcal(1);" >Simulation A/c Ledg.</button>

                <button class="btn btn-success" type="button" onclick="submitAllData(0)" id="submitdata" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

                <button class="btn btn-success" type="button" onclick="submitAllData(1)" id="submitNDown" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>

                <input type="hidden" id="donwloadStatus" name="donwloadStatus" value="">

              </p>


      <!-- START : SHOW MODAL WHEN CLICK ON TAX BUTTON -->

      <div class="modal fade" id="tds_rate_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content modalScrlBar" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">

                <div class="col-md-5">

                  <div class="form-group">

                    <lable class="settaxcodemodel col-md-4" style="padding: 0px;">Tax Code - </lable>

                    <input type="text" class="settaxcodemodel col-md-7" id="tax_code1" style="border: none; padding: 0px;" readonly>

                  </div>

                </div>

                <div class="col-md-6">

                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation</h5>

                </div>

                <div class="col-md-1"></div>

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
              <input type="hidden" value="" name="crAmtItm[]" id="cr_amtbytax_1">
              <center>
                <span  id="footer_tax_btn1" style="width: 10px;"></span>
               </center>

            </div>

          </div>

        </div>

      </div>

      <!-- END : SHOW MODAL WHEN CLICK ON TAX BUTTON -->

      <div id="domModel_2">

      </div>

      <!-- START : WHEN HSN CODE DIFFERENT THAN ITEM TAX CODE -->

      <div id="HsnSameShow1" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
                    
                </div>
                <div class="modal-body">
                  <p>Header Tax Code  <small id="headtaxCode1"></small> Is Different Than Item Wise Tax Code <small id="itmtaxCode1"></small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancleblnkItm(1);">Cancel</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- END : WHEN HSN CODE DIFFERENT THAN ITEM TAX CODE -->

    <!-- START : SHOW MODAL WHEN QUANTITY IS GREATER THAN BALENCE QUNATITY -->

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

                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="cancleGreatQty(1);">Ok</button>

                </div>

            </div>

        </div>

      </div>

      <!-- END : SHOW MODAL WHEN QUANTITY IS GREATER THAN BALENCE QUNATITY -->

      <!-- START : SHOW MODAL WHEN RATE IS GREATER-->

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

      <!-- END : SHOW MODAL WHEN RATE IS GREATER-->

      <!-- START : SHOW MODAL WHEN CLICK ON ITEM CODE -->

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

      <!-- END : SHOW MODAL WHEN CLICK ON ITEM CODE -->

      <!-- START : ERROR MASG SHOW -->

      <div id="taxNotAppied" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
                    
                </div>
                <div class="modal-body">
                  <p id="taxnotApMsg"></p>
                  <p id="grAmtIsGreatMsg"></p>
                  <p id="whenRowBlnk"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
                </div>
            </div>
        </div>
      </div>
      <!-- END : ERROR MASG SHOW -->

      <!-- START : WHEN CLICK ON QUALITY PARAMETER -->

      <div class="modal fade" id="quality_parametr1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">
                <input type="hidden" id="itmOnQp1">
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
      <!-- END : WHEN CLICK ON QUALITY PARAMETER -->

      <!-- START : SHOW MODAL FOR MULTIPLE TAX LIST --> 

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

            <div style="text-align: center;">
              <small id="taxSelErr1" style="color: red;"></small>
            </div>

            <div class="modal-body table-responsive">

              <div id="showtaxcodeMul1" style="line-height: 23px;">
                
              </div>

            </div>

            <div class="modal-footer" style="text-align: center;" id="taxCodeSelect1">

                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="taxIntaxrate(1);" style="width: 83px;" id="taxslOkBtn1">Ok</button>   

            </div>

          </div>

        </div>

      </div>

     <!-- START : SHOW MODAL FOR MULTIPLE TAX LIST --> 

     <!-- START : SHOW MODAL AFTER SELECT ITEM CODE FOR SHOWING DETAILS -->

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

                    <div class="box10 texIndbox1">Item Name</div>
                   
                    <div class="box10 rateIndbox">HSN Code</div>
                    <div class="box10 rateIndbox">Tax Code</div>
                    <div class="box10 rateBox">Item Detail</div>
                    <div class="box10 amountBox">Item Type</div>
                    <div class="box10 amountBox">Item Group</div>
                    <div class="box10 amountBox">Item Class</div>
                    <div class="box10 amountBox">Item Category</div>

                  </div>
                  
                  <div class="box-row">
                    <div class="box10 itmdetlheading">
                      <span id="itemCodeshow1"> </span>
                    </div>
                  
                    <div class="box10 itmdetlheading">
                      <span id="hsncodeshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="taxcodeshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="itemDetailshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="itemtypeshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="itemgroupshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="itemclassshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="itemcategoryshow1"> </span>
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

      <!-- END : SHOW MODAL AFTER SELECT ITEM CODE FOR SHOWING DETAILS -->

     <!-- START : SHOW MODAL WHEN CLICK ON SIMULATION  -->

      <div class="modal fade in" id="simulation_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">

                <div class="col-md-2"></div>

                <div class="col-md-8">

                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Simulation A/c Ledger</h5>

                </div>

                <div class="col-md-2"></div>

              </div>

            </div>

            <div class="modal-body table-responsive">

              <div class="boxer" id="siml_body" style="width: 100%;">
                
              </div>
              
            </div>

            <div class="modal-footer">

              <span id="siml_footer1" style="width: 10px;"><button type="button" class="btn btn-primary " style="width: 10%;" data-dismiss="modal">Ok</button></span>
             </center>

            </div>

          </div>

        </div>

      </div>

     <!-- END : SHOW MODAL WHEN CLICK ON SIMULATION  -->

    <!--  WHEN  SHOW MODEL GL/POST CODE NOT APPLIED -->

    <div id="gl_postNotAppied" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                <div class="modal-body">
                  <p id="notApMsgforSeries"></p>
                  <p id="notApMsgforitem"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!--  WHEN  SHOW MODEL GL/POST CODE NOT APPLIED -->


          </div><!-- /.BOX-BODY -->

        </div><!-- /.CUSTOME BOX -->

      </div><!-- /.col-sm-12 -->

    </div><!-- /.ROW -->

  </section><!-- /.CONTENT -->

</form><!-- /.FOR CLOSE -->

</div><!-- /.content-wrapper -->

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script>
<script src="{{ URL::asset('public/dist/js/viewjs/commonJsFun.js') }}" ></script>


<script type="text/javascript">
  
  $(document).ready(function(){

    var fromdateintrans = $('#FromDateFy').val();

    $('.partyBillDate').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromdateintrans,

      endDate : 'today',

      autoclose: 'true'

    });

    $( window ).on( "load", function() {

      getvrnoBySeries();

      $.ajaxSetup({
            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      var Plant_code =  $('#Plant_code').val();

      $('#getPlantCode').val(Plant_code);

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
                   var pfctName = '';
                   $('#profitctrId').val(profitctr);
                   $('#pfctName').val(pfctName);
                   $('#profitText').val(pfctName);
                   $('#getPfctName').val(pfctName);
                   $('#getPfctCode').val(profitctr);
                }else{
                  $('#profitctrId').val(data1.data[0].PFCT_CODE);
                  $('#pfctName').val(data1.data[0].PFCT_NAME);
                  $('#profitText').val(data1.data[0].PFCT_NAME);
                  $('#getPfctName').val(data1.data[0].PFCT_NAME);
                  $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                  $('#getStateByPlant').val(data1.data[0].STATE_CODE);
                }

            }

        }

      });

    }); /* /. WINDOE LOAD FUNCTION*/
  });

/* ------- START : PURCHASE ORDER NO -----------  */

  function getpurOrderNum(){

      var acc_code=$('#account_code').val();
      var transDate=$('#vr_date').val();
      var stateCode =  $('#getStateByPlant').val();

      $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({

            url:"{{ url('get-purchase-order-vrno-by-account') }}",
            method : "POST",
            type: "JSON",
            data: {acc_code: acc_code,transDate:transDate,stateCode:stateCode},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  $("#poVrnoList").empty();
                  if(data1.data == ''){
                      $('#povrnoNotFound').html('Purchase Order No. Not Found').css('color','red');

                      $('#purOrdervrno').val('');
                      $('#pur_order_no').val('');
                      $('#due_days').val('');
                      $('#due_date').val('');
                      $('#party_rf_no').val('').prop('readonly',false);
                      $('#getpartyrfNo').val('');
                      $('#party_ref_date').val('').prop('disabled',false);
                      $('#getpartyrfDate').val('');
                      $('#gateduedate').val('');

                  }else{

                      $('#povrnoNotFound').html('');

                      $.each(data1.data, function(k, getData){

                        var startyear = getData.VRDATE;
                        var getyear = startyear.split("-");

                        $("#poVrnoList").append($('<option>',{

                          value:getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,

                          'data-xyz':getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
                          text:getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO


                        }));

                    }); 
                        
                     
                  }

                  if(data1.data_accGl == ''){

                  }else{
                    $('#accGl').val(data1.data_accGl[0].GL_CODE);
                  }

                  if(data1.data_acc_add == ''){

                  }else{
                    $("#shipTAdd").empty();
                    $.each(data1.data_acc_add, function(k, getTAX){

                      var cpCode =  '['+getTAX.ACC_CODE+'-'+getTAX.ACC_NAME+'] '+getTAX.ADD1;

                      $("#shipTAdd").append($('<option>',{

                        value:cpCode,

                        'data-xyz':getTAX.CPCODE

                      }));

                    }); 
                  }


                }

            }

      });

  }

  function getITmDataByPo(){
    var account_code =  $('#account_code').val();
    var povr_num     =  $('#purOrdervrno').val();
    var getpovr      = povr_num.split(' ');
    var povrno       = getpovr[2];
    var series_code  =  getpovr[1];
    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

    });

    $.ajax({

            url:"{{ url('get-itmdata-by-purchase-order-vrno') }}",

            method : "POST",

            type: "JSON",

            data: {account_code: account_code,povrno:povrno,series_code:series_code},

            success:function(data){

              var data1 = JSON.parse(data);
                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  console.log('gg',data1.data);
                  if(data1.data == ''){
                     $('#tax_code').val('');
                     $('#due_days').val('');
                      $('#due_date').val('');
                  }else{

                    $('#Item_CodeId1').removeClass('itmbyQc');
                    $('#ItemCodeId1').css('display','none');

                    var startDate = data1.data[0].VRDATE;
                    var endDate = data1.data[0].DUEDATE;

                    var diffInMs   = new Date(endDate) - new Date(startDate);
                    var diffInDays = diffInMs / (1000 * 60 * 60 * 24);

                    $('#due_days').val(diffInDays).prop('readonly',true).css('border-color','#d2d6de');
                    $('#due_date').val(endDate);
                    $('#gateduedate').val(endDate);
                    $('#party_rf_no').val(data1.data[0].PREFNO).prop('readonly',true);
                    $('#getpartyrfNo').val(data1.data[0].PREFNO);
                    $('#party_ref_date').val(data1.data[0].PREFDATE).prop('disabled',true);
                    $('#getpartyrfDate').val(data1.data[0].PREFDATE);
                    $('#tax_code').val(data1.data[0].TAX_CODE).prop('readonly',true);
                  
                     
                  }

                }

            }

          });

   }

  function ShowItemCode(itemId){

    var account_code = $('#account_code').val();
    var povr_num = $('#purOrdervrno').val();
    var getpovr = povr_num.split(' ');
    var povrno = getpovr[2];
    var series_code =  getpovr[1];

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $.ajax({

          url:"{{ url('get-itmdata-by-purchase-order-vrno') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code,povrno:povrno,series_code:series_code},

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



                      var tableHead= "<div class='box-row'><div class='box10 texIndbox'>#</div><div class='box10 vrnoinbox'>Vr. No</div><div class='box10 itemIndbox'>Item </div><div class='box10 rateIndbox'>Qty Order </div><div class='box10 rateIndbox'>Qty GRN </div><div class='box10 rateIndbox'>Qty Cancle </div><div class='box10 rateIndbox'>Bal. Qty </div></div>";



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

                        var startyear = getData.VRDATE;
                        var getyear = startyear.split("-");
                        
                        if(getData.QTYISSUED == null){
                          var QTYISSUE = 0.00;
                        }else{
                          var QTYISSUE = getData.QTYISSUED;
                        }
                      var tableBody = "<div class='box-row' id='hidebalNull_"+itemId+"_"+incemntval+"'><div class='box10 texIndbox'><input type='radio' id='sr_"+itemId+"_"+incemntval+"' name='itemname' value='"+itemId+"_"+incemntval+"'></div><div class='box10 texIndbox' style='width: 19%;'><input type='text' id='vrno_"+itemId+"_"+incemntval+"' name='head_tax_ind11[]' class='form-control inputtaxInd' value="+getyear[0]+'&nbsp;'+getData.SERIES_CODE+'&nbsp;'+getData.VRNO+" readonly></div><div class='box10 rateIndbox tooltips'><input type='hidden' value="+getData.FY_CODE+" id='sqfiscalyr_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.SERIES_CODE+" id='poseries_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.SERIES_CODE+" id='potran_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.SERIES_CODE+" id='povrno_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.SLNO+" id='poslno_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.PORDERBID+" id='pobodyid_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.PORDERHID+" id='poheadid_"+itemId+"_"+incemntval+"'><input type='hidden' value='"+getData.PARTICULAR+"' id='poitmdisciptn_"+itemId+"_"+incemntval+"'><input type='text' id='itemcode_"+itemId+"_"+incemntval+"' name='itemco' class='form-control'  value='"+getData.ITEM_CODE+"("+getData.ITEM_NAME+")"+"' readonly><div class='tooltiptextitem tooltiphide' id='itemNameTooltip_"+itemId+"_"+incemntval+"'></div><input type='hidden' value="+getData.TAX_CODE+" id='taxCodeI_"+itemId+"_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='qtyOreder_"+itemId+"_"+incemntval+"' name='qtyOrder' class='form-control rightcontent' value="+getData.QTYRECD+" readonly><input type='hidden' value="+getData.RATE+" id='ordr_rate_"+itemId+"_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='qtySupply_"+itemId+"_"+incemntval+"' name='qtySupply[]' class='form-control rightcontent' value="+QTYISSUE+" readonly></div><div class='box10 rateIndbox'><input type='text' id='qtyCancle_"+itemId+"_"+incemntval+"' name='qtyCancle[]' class='form-control rightcontent' value="+getData.QTYCANCEL+" readonly></div><div class='box10 rateIndbox'><input type='text' id='balence_qty_"+itemId+"_"+incemntval+"' name='balQty[]' class='form-control rightcontent' value="+getData.QTYRECD+" readonly><input type='hidden' class='form-control' id='remainBalQty_"+itemId+"_"+incemntval+"' value='' readonly></div></div>";

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
      
      var qc_rate        = $('#ordr_rate_'+res1+'_'+res2).val();
      
      var poseries       = $('#poseries_'+res1+'_'+res2).val();
      var potransc       = $('#potran_'+res1+'_'+res2).val();
      var poslno         = $('#poslno_'+res1+'_'+res2).val();
      var povrno         = $('#povrno_'+res1+'_'+res2).val();
      var pobody         = $('#pobodyid_'+res1+'_'+res2).val();
      var  pohead        = $('#poheadid_'+res1+'_'+res2).val();
      var poitmdiscriptn = $('#poitmdisciptn_'+res1+'_'+res2).val();
     // console.log('poitmdiscriptn',poitmdiscriptn);
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

      if(poitmdiscriptn == null || poitmdiscriptn == 'null' || poitmdiscriptn ==''){
        var remarkPo = '';
      }else{
        var remarkPo = poitmdiscriptn;
      }
      $('#remark_data'+rowid).val(remarkPo);
      
      $('#idsun'+rowid).val(res1+'_'+res2);

      $('#rate'+rowid).val(qc_rate);
      $('#qnrate'+rowid).val(qc_rate);
      $('#qty'+rowid).val(balencQtyByitm);
      $('#balQtyByItem'+rowid).val(balencQtyByitm);
      $('#po_transcode'+rowid).val(potransc);
      $('#po_seriescode'+rowid).val(poseries);
      $('#po_vrno'+rowid).val(povrno);
      $('#po_slno'+rowid).val(poslno);
      $('#po_headid'+rowid).val(pohead);
      $('#po_bodyid'+rowid).val(pobody);
      $('#taxByItem'+rowid).val(tax_CodeI);
      $('#viewItemDetail'+rowid).removeClass('showdetail');
      
      $('#qty'+rowid).prop('readonly',false);
      $('#rate'+rowid).prop('readonly',false);
      $('#CalcTax'+rowid).prop('readonly',false);

      $('#vr_date,#series_code,#Plant_code,#profitctrId,#account_code,#contractNo,#purOrdervrno,#quotationNo,#tax_code,#due_days,#party_rf_no,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

      $('#party_ref_date').prop('disabled',true);

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
                $('#idsun'+rowid).val('');
                $('#tolranceshow'+rowid).addClass('tolrancehide');
                $('#cancelbtolrntn'+rowid).css('display','none');
              }else{
                $('#checkitm').val(cur_val + "," + getitemCd);
                $('#vr_date,#series_code,#Plant_code,#account_code,#contractNo,#quotationNo,#tax_code,#due_days,#party_rf_no,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

                $('#party_ref_date').prop('disabled',true);

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
    var cancleQty = $('#qtyCancle_'+rowI+'_'+calI).val();

    //var remainBalQty = $('#remainBalQty_'+rowI+'_'+calI).val();

      var balenceQty =  orderQty - suplyQty - cancleQty;

      $('#balence_qty_'+rowI+'_'+calI).val(balenceQty.toFixed(3));

      if(orderQty == suplyQty){
        $('#hidebalNull_'+rowI+'_'+calI).hide();
      }else{
        $('#hidebalNull_'+rowI+'_'+calI).show();
      }

  }

/* ------- END : PURCHASE ORDER NO -----------  */

/* ----- START : GET VRNO AGAINST SERIES ----- */
  
  function getvrnoBySeries(){

    var seriesCode = $('#series_code').val();
    var transcode = $('#transcode').val();

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

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

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

                  if(data1.data == ''){
                    $('#seriesGl').val('');
                    $('#getseriesGl').val('');
                  }else{
                    if(data1.data[0].POST_CODE == null || data1.data[0].POST_CODE == ''){
                      $("#gl_postNotAppied").modal('show');
                      $('#notApMsgforSeries').html('The <b>Post Code</b> Has Not Been Applied For Series');
                    }else{
                      $('#seriesGl').val(data1.data[0].POST_CODE);
                      $('#getseriesGl').val(data1.data[0].POST_CODE);
                    }

                    
                  }

              }

          }

    });

  }

/* ----- END : GET VRNO AGAINST SERIES ----- */

/* ----- START : ITEM AGAINST TAX SERIES ----- */

  function getitmByTax(){

    var taxCode       = $('#tax_code').val();
    var pOrdeVrno     = $('#purOrdervrno').val();
    var getpOnum      = pOrdeVrno.split(' ');
    var poVrno        = getpOnum[2];
    var seiresbytrans = getpOnum[1];
    var account_code  = $('#account_code').val();

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $.ajax({

            url:"{{ url('get-item-data-by-tax-code') }}",

            method : "POST",

            type: "JSON",

            data: {taxCode: taxCode,poVrno:poVrno,account_code:account_code,seiresbytrans:seiresbytrans},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                   if(data1.data ==''){

                   }else{

                      if(pOrdeVrno){
                        $('#purOrdervrno').prop('disabled',false);
                      }else{
                        $('#purOrdervrno').prop('disabled',true);
                      }

                      $("#ItemList1").empty();
                     // console.log('data1.data',data1.data);
                      $.each(data1.data, function(k, getData){

                          $("#ItemList1").append($('<option>',{

                            value:getData.ITEM_CODE,

                            'data-xyz':getData.ITEM_NAME,
                            text:getData.ITEM_NAME


                          }));

                        });

                   }

                }

            }

    }); /* / .AJAX*/

  } /* /.  FUNCTION CLOSE*/

/* ----- END : ITEM AGAINST TAX SERIES ----- */

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

                      var batchCheck = data1.data_hsn.BATCH_CHECKE;
                       var vrDate = $('#vr_date').val();
                      if(batchCheck == 'YES'){
                         var barctRefNo = data1.data_hsn.BATCH_REFRENCE;

                         if(barctRefNo == 'GRN NO'){

                            $('#hsbatchno'+umaumvl).removeClass('hidebatchnoinput');
                            var curntYear = $('#currentyear').val();
                            var startyear = curntYear.split('-');
                            var vrnoseq = $('#vrseqnum').val();
                            var seriesCode = $('#series_code').val();
                            $('#batchNumget'+umaumvl).html(startyear[0]+'/'+seriesCode+'/'+vrnoseq);
                            $('#batchNumget'+umaumvl).prop('readonly',true);

                         }else if(barctRefNo == 'MANUAL'){

                          $('#hsbatchno'+umaumvl).removeClass('hidebatchnoinput');
                          $('#batchNumget'+umaumvl).prop('readonly',false);
                          
                         }else if(barctRefNo == 'PURCHASE ORDER'){

                            $('#hsbatchno'+umaumvl).removeClass('hidebatchnoinput');
                            var po_year = $('#pofiscalyr_'+umaumvl+'_'+cfval).val();
                            var getFirstPoyr = po_year.split('-');
                            var po_seiresgt = $('#poseries_'+umaumvl+'_'+cfval).val();
                            var po_vrnogt = $('#povrno_'+umaumvl+'_'+cfval).val();

                            $('#batchNumget'+umaumvl).html(getFirstPoyr[0]+'/'+po_seiresgt+'/'+po_vrnogt);
                         }else if(barctRefNo == 'GRN DATE'){
                           $('#hsbatchno'+umaumvl).removeClass('hidebatchnoinput');
                           $('#batchNumget'+umaumvl).prop('readonly',true);
                           $('#batchNumget'+umaumvl).html(vrDate);
                         }
                      }

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

                    if(data1.itypeGl == ''){
                      $('#itemglCode'+umaumvl).val();
                    }else{
                      $('#itemglCode'+umaumvl).val(data1.itypeGl[0].POST_CODE);
                    }


                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }/*function close*/

/* ----- START : CALCULATE TAX ---------- */

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
    
    if(taxOnModel == ''){

      var formName     = 'GRN';
      var tax_code     = $('#taxByItem'+taxid).val();
      var poHeadId     = $('#po_headid'+taxid).val();
      var PoBodyId     = $('#po_bodyid'+taxid).val();
      var itemCodebypo = $('#Item_CodeId'+taxid).val();
      var itemCodeId   = $('#ItemCodeId'+taxid).val();
      var itemGl_Cd    = $('#itemglCode'+taxid).val();
      var seriesGl     = $('#seriesGl').val();

      if(itemCodebypo){
        var ItemCode = itemCodebypo;
      }else if(itemCodeId){
        var ItemCode =itemCodeId;
      }

      if((seriesGl == '') || (seriesGl == null)){
        var itemSeriesGl = itemGl_Cd;
      }else{
        var itemSeriesGl = seriesGl;
      }

      $.ajax({

            url:"{{ url('get-a-field-calc-by-itm-tax-code') }}",

            method : "POST",

            type: "JSON",

            data: {tax_code: tax_code,poHeadId:poHeadId,PoBodyId:PoBodyId,ItemCode:ItemCode,formName:formName},

            beforeSend: function() {
              $('.modalspinner').removeClass('hideloaderOnModl');
            },

            success:function(data){

              var data1 = JSON.parse(data);

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

                    $('#data_count'+taxid).val(datacount);

                   if((getData.RATE_INDEX == null && getData.TAX_RATE == null) || (getData.RATE_INDEX == '-' && getData.TAX_RATE == '0.00')){

                      $('#tax_code'+taxid).val(getData.TAX_CODE);

                       var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly> <input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"> </div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+itemSeriesGl+"'><input type='hidden' name='itmwiseGlCode[]' id='itmwise_gl_code_"+taxid+"_"+counter+"' value='"+itemSeriesGl+"'></div></div>";

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
                          var ItmGlSet = '';
                        }else if(taxTrnasGl){
                          var TAXGLCODE=taxTrnasGl;
                          var ItmGlSet = '';
                        }else{
                          var TAXGLCODE='';
                          var ItmGlSet = itemSeriesGl;
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
                        
                       var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></div><div class='box10 rateIndbox'> <input type='text' class='form-control' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+");'> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a> </div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control' oninput='getGrandTotal("+taxid+");' ></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+taxAmt+"' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticIND+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'><input type='hidden' name='itmwiseGlCode[]' id='itmwise_gl_code_"+taxid+"_"+counter+"' value='"+ItmGlSet+"'></div></div> <div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+");'>Apply</button></div></div></div></div>";

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
                      
                  var butn =  $('#footer_tax_btn'+taxid).find(':button').html();

                  if(butn != 'Ok' || butn =='undefined'){

                    var tblData = "<button type='button' class='btn btn-primary ' style='width: 10%;' data-dismiss='modal' id='ApplyOktaxbtn"+taxid+"' onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",1);'>Ok</button>";

                      $('#footer_tax_btn'+taxid).append(tblData);

                      /*var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'  onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",0);'>Cancel</button>";
                       
                     $('#footer_ok_btn'+taxid).append(cancelfooter);*/

                  }else{

                  }

                } // COND

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


/* ----- END : CALCULATE TAX ---------- */

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

/* --------- START : ADD MORE FUCNTIONALITY ------------ */

  $(".delete").on('click', function() {

      $('.case:checkbox:checked').parents("tr").remove();

      $('.check_all').prop("checked", false); 

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

         if(allGrandAmount == '0.00'){
            $('#CalPayTerms').prop('disabled',true);
         }else{
            var otherAmount = allGrandAmount - basicAmnount;
            $('#otherTotalAmt').val(otherAmount);
         }

        var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });

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
  var row_i=1;

  $(".addmore").on('click',function(){

      count=$('table tr').length;

      var notck = i - 1;

      var ifnotaply = $('#aplytaxOrNot'+notck).html();
      var itemGlNotFn    = $('#itemglCode'+notck).val();

      if(ifnotaply == 0){

         $("#taxNotAppied").modal('show');
         $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');

      }else if(itemGlNotFn == '' || itemGlNotFn == null){

        $("#gl_postNotAppied").modal('show');
        $('#notApMsgforSeries').html('');
        $('#notApMsgforitem').html('The <b>Post Code </b> Has Not Been Applied. In Some Of The Above Item.');

      }else{

        var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case' id='cBocID"+i+"' onclick='checkcheckbox("+i+");'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> </td>";

        data +="<td class='tdthtablebordr'><div class='input-group'><input type='text' class='inputboxclr itmbyQc' style='width: 90px;margin-bottom: 4px;margin-top: 13px;' id='Item_CodeId"+i+"' name='itemPo[]' onclick='ShowItemCode("+i+");'  oninput='this.value = this.value.toUpperCase()' readonly /><input list='ItemList"+i+"' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' name='item_code[]'  onchange='ItemCodeGet("+i+");taxIntaxrate("+i+");' oninput='this.value = this.value.toUpperCase()' /><datalist id='ItemList"+i+"'><option selected='selected' value=''>-- Select --</option> @foreach ($item_list as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option> @endforeach</datalist></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button> <input type='hidden' id='idsun"+i+"'><input type='hidden' id='selectItem"+i+"'> <div class='divhsn' id='showHsnCd"+i+"'></div><input type='hidden' id='hsn_code"+i+"' name='hsn_code[]'> <input type='hidden' id='taxByItem"+i+"' name='tax_byitem[]'> <input type='hidden' id='taxratebytax"+i+"' value=''> <input type='hidden' id='po_transcode"+i+"' name='po_trans[]'> <input type='hidden' id='po_seriescode"+i+"' name='po_series[]'><input type='hidden' id='po_vrno"+i+"' name='po_vrno[]'><input type='hidden' id='po_slno"+i+"' name='po_slno[]'><input type='hidden' id='po_headid"+i+"' name='po_head[]'><input type='hidden' id='po_bodyid"+i+"' name='po_body[]'> <input type='hidden' id='itmC_code"+i+"' name='itemcodeC[]'><input type='hidden' id='itemglCode"+i+"' name='itemglCode[]'><small id='itemnotFound"+i+"' style='color: red;'></small></td><td class='tdthtablebordr'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly /><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description' readonly></textarea><div class='hidebatchnoinput' id='hsbatchno"+i+"'><div class='setbatchnoandref'><small class='batchNoC'>Batch No:</small><textarea id='batchNumget"+i+"' rows='1' class='showbatchnum' name='batchNo[]' placeholder='Enter Batch No' readonly></textarea></div></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='qty"+i+"' name='qty[]'  oninput='CalAQty("+i+")' style='width: 80px' /><input type='text' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly><input type='hidden' id='Cfactor"+i+"'><input type='hidden' id='balQtyByItem"+i+"'></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input list='aumList"+i+"' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddMList'  onchange='changeAum("+i+")'><datalist id='aumList"+i+"'><option value=''>--select--</option></datalist></div></td><td class='tdthtablebordr'><input type='text' class='debitcreditbox inputboxclr cr_amount SetInCenter' oninput='calculateBasicAmt("+i+")' id='rate"+i+"' name='rate[]'  style='width: 80px' readonly/><input type='hidden' id='qnrate"+i+"'></td><td class='tdthtablebordr'><input type='text' name='basic_amt[]' id='basic"+i+"' class='form-control basicamt' style='width: 110px;margin-top: 14%;height: 22px;' readonly></td><td><input type='hidden' id='data_count"+i+"' class='dataCountCl' value='' name='data_Count[]'><input type='hidden' class='setGrandAmnt' id='get_grand_num"+i+"' name='dr_grandAmt[]'><div style='margin-top: 23%;'><small id='taxnotfound"+i+"' class='label label-danger'></small></div><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='CalcTax"+i+"' data-toggle='modal' data-target='#tds_rate_model"+i+"' onclick='CalculateTax("+i+"); getGrandTotal("+i+");' disabled=''>Calc Tax </button><div id='appliedbtn"+i+"'></div><div id='cancelbtn"+i+"'></div><div id='aplytaxOrNot"+i+"' class='aplynotStatus'>0</div><div id='allItemShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-lg' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12' style='text-align: center;'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Details</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='itemListShow_"+i+"'></div></div><div class='modal-footer' style='text-align: center;' id='footer_item_"+i+"'></div></div></div></div><div class='modal fade' id='view_tolrance"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-sm' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tolrance</h5></div></div></div><div class='modal-body'><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Index :</label></div><div class='col-md-4'><input list='TolrnceIndex"+i+"' name='tolrance_index[]' id='tolrance_index"+i+"' value=''><datalist id='TolrnceIndex"+i+"'><option value=''>--Select--</option><option value='P' data-xyz='Percentage'>P - [Percentage]</option><option value='L' data-xyz='Lumsum'>L - [Lumsum]</option></datalist></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Rate :</label></div><div class='col-md-4'><input type='text' id='tolrance_rate"+i+"' name='tolrance_rate[]' value='' oninput='ratepercent("+i+")'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Value:</label></div><div class='col-md-4'><input type='text' id='tolrance_rate_percent"+i+"'  value=''readonly></div><div class='col-md-2'></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;' onclick='getTolerance("+i+")'>Ok</button></div></div></div></div></td><td><div style='margin-top: 12%;'><small id='qpnotfound"+i+"' class='label label-danger'></small></div><input type='hidden' id='quaP_count"+i+"' value='0' name='quaP_count[]' class='quaPcountrow'> <button type='button' class='btn btn-primary btn-xs tdsratebtn' id='qua_paramter"+i+"' data-toggle='modal' data-target='#quality_parametr"+i+"' onclick='qty_parameter("+i+")' disabled='' style='padding-bottom: 0px;padding-top: 0px;'>Quality Parametr </button> <div id='cancelQpbtn"+i+"'></div> <div id='appliedQpbtn"+i+"'></div><div id='qpApplyOrNot"+i+"' class='aplynotStatus'>0</div> <small id='qPnotfountbtn"+i+"' class='label label-danger'></small> <div id='greaterRateShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'> <div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5></div></div></div><div class='modal-body table-responsive'><p>Rate Should Not Be Greater</p></div><div class='modal-footer' style='text-align: center;' id='greatRateFooter"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div><div id='grateQtyShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5></div></div></div><div class='modal-body table-responsive'><p>Quantity is grater than balence qunatity</p></div><div class='modal-footer' style='text-align: center;' id='greatQtyFooter"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='cancleGreatQty("+i+");'>Ok</button></div></div></div></div><div id='taxSelectModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='font-weight: 800;'>Select Tax Code</h5></div></div></div><div style='text-align: center;'><small id='taxSelErr"+i+"' style='color: red;'></small></div><div class='modal-body table-responsive'><div id='showtaxcodeMul"+i+"' style='line-height: 23px;text-align: initial;'></div></div><div class='modal-footer' style='text-align: center;' id='taxCodeSelect"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='taxIntaxrate("+i+");' style='width: 83px;' id='taxslOkBtn"+i+"'>Ok</button></div></div></div></div><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item Name</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div> <div class='box-row'><div class='box10 itmdetlheading'><span id='itemCodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'> <span id='hsncodeshow"+i+"'> </span> </div><div class='box10 itmdetlheading'><span id='taxcodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemDetailshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemtypeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemgroupshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemclassshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemcategoryshow"+i+"'> </span></div></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div></td></tr>";

        $('table').append(data);

        var domModel = "<div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content modalScrlBar' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-5'><div class='form-group'> <lable class='settaxcodemodel col-md-4' style='padding: 0px;'>Tax Code - </lable> <input type='text' class='settaxcodemodel col-md-7' id='tax_code"+i+"' style='border: none; padding: 0px;' readonly> </div> </div><div class='col-md-6'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tax / Charges / etc Calculation</h5></div><div class='col-md-1'></div></div> </div> <div class='modal-body table-responsive'><div class='modalspinner hideloaderOnModl'></div><div class='boxer' id='tax_rate_"+i+"'><div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div> <div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div> </div> </div></div> <div class='modal-footer'><input type='hidden' name=crAmtItm[] value='' id='cr_amtbytax_"+i+"'><center> <span  id='footer_tax_btn"+i+"' style='width: 10px;'></span></center>  </div></div></div> </div> <div id='HsnSameShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title' style='color: red;font-weight: 800;'>Alert !!</h5></div><div class='modal-body'><p>Header Tax Code  <small id='headtaxCode"+i+"'></small> Is Different Than Item Wise Tax Code <small id='itmtaxCode"+i+"'></small></p></div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal' onclick='cancleblnkItm("+i+");'>Cancel</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div>";

       $('#domModel_2').append(domModel);

       var qpModlDom = "<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-lg' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'> <div class='modal-header'><div class='row'><input type='hidden' id='itmOnQp"+i+"'><div class='col-md-12'> <h5 class='modal-title modltitletext' id='exampleModalLabel'>Qaulity Parameter</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+i+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footerqp_ok_btn"+i+"'></small><small style='text-align: center;' id='footerqp_quality_btn"+i+"'></small></center> </div></div> </div></div>";

       $('#quaPdomModel_2').append(qpModlDom);

       var p_orderno    = $('#purOrdervrno').val();
       var tax_code     = $('#tax_code').val();
       var stateCode    =  $('#getStateByPlant').val();
       var account_code =  $('#account_code').val();

        if(p_orderno){

          $('#Item_CodeId'+i).removeClass('itmbyQc');
          $('#ItemCodeId'+i).css('display','none');

        }else{

          $('#Item_CodeId'+i).addClass('itmbyQc');
          $('#ItemCodeId'+i).css('display','block');

        }

        var taxCode = $('#tax_code').val();
        var pOrdeVrno = $('#purOrdervrno').val();

        var getpOnum = pOrdeVrno.split(' ');

        var poVrno = getpOnum[2];
        var seiresbytrans = getpOnum[1];

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            url:"{{ url('get-item-data-by-tax-code') }}",

            method : "POST",

            type: "JSON",

            data: {taxCode: taxCode,poVrno:poVrno,account_code:account_code,seiresbytrans:seiresbytrans},

            success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                    if(data1.data ==''){

                    }else{

                        if(pOrdeVrno){
                          $('#purOrdervrno').prop('disabled',false);
                        }else{
                          $('#purOrdervrno').prop('disabled',true);
                        }

                        $("#ItemList"+row_i).empty();

                        $.each(data1.data, function(k, getData){

                            $("#ItemList"+row_i).append($('<option>',{

                              value:getData.ITEM_CODE,

                              'data-xyz':getData.ITEM_NAME,
                              text:getData.ITEM_NAME


                            }));

                        });

                    } /* /. CHECK DATA BLANK*/
                }/* /. SUCCESS CODN*/
            }/* /. SUCCESS FUCN*/

        }); /* / .AJAX*/

        i++;
        row_i++;

      } /* ELSE CLOSE*/

  }); /* /. FUNCTION CLOSE*/ 

/* --------- END : ADD MORE FUCNTIONALITY ------------ */

/* --------- START : ITEM CODE ------------ */

  function ItemCodeGet(ItemId){

      $("#HsnSameShow"+ItemId).modal({
        show:false,
        backdrop:'static'
      });

      $("#taxSelectModel"+ItemId).modal({
        show:false,
        backdrop:'static'
      });

      var ItemCode =  $('#ItemCodeId'+ItemId).val();
      var taxCode =  $('#getTaxCode').val();

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

        $('#tolranceshow'+ItemId).addClass('tolrancehide');
        $('#qty'+ItemId).val('');
        $('#A_qty'+ItemId).val('');
        $('#UnitM'+ItemId).val('');
        $('#AddUnitM'+ItemId).val('');
        $('#rate'+ItemId).val('');
        $('#basic'+ItemId).val('');
        $('#hsn_code'+ItemId).val('');
        $('#showHsnCd'+ItemId).html('');
        $('input[name="taxcodeit"]').prop('checked', false);
        $('#taxByItem'+ItemId).val('');
        $('#taxratebytax'+ItemId).val('');
        $('#aplytaxOrNot'+ItemId).html('0');
        $('#CalcTax'+ItemId).hide();
        $('#data_count'+ItemId).val('');
        $('#get_grand_num'+ItemId).val('');
        $('#remark_data'+ItemId).val('');
        $('#qty'+ItemId).prop('readonly',true);
        $('#appliedbtn'+ItemId).html('');
        $('#remark_data'+ItemId).prop('readonly',true);
        $('#viewItemDetail'+ItemId).addClass('showdetail');
        $('#itmC_code'+ItemId).val('');
        $('#hsbatchno'+ItemId).addClass('hidebatchnoinput');
        $('#batchNumget'+ItemId).html('');

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


      }else{

        blankFieldWhenItmChange(ItemId);

        $('#viewItemDetail'+ItemId).removeClass('showdetail');

        document.getElementById("Item_Name_id"+ItemId).value = msg;

        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide');  
        $('#itemNameTooltip'+ItemId).html(msg);

        $('#tolranceshow'+ItemId).removeClass('tolrancehide');

        $('#tolranceshow'+ItemId).prop('disabled',true);

        $('#qty'+ItemId).prop('readonly',false);  
        $('#remark_data'+ItemId).prop('readonly',false);  

        $('#vr_date,#series_code,#Plant_code,#profitctrId,#account_code,#contractNo,#quotationNo,#purOrdervrno,#tax_code,#due_days,#party_rf_no,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5,#vendor_qc_name').prop('readonly',true);

        $('#party_ref_date').prop('disabled',true);

        var cnclbtn ='<input type="hidden" value="'+0+'" id="tolcvalue"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelbtolrntn'+ItemId).html(cnclbtn);

        $('#itmC_code'+ItemId).val(ItemCode);

        var cnclbtntax ='<input type="hidden" value="0" id="qltyvalue'+ItemId+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelbtn'+ItemId).html(cnclbtntax);

        var cnclbtnqp ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelQpbtn'+ItemId).html(cnclbtnqp);

      }

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:"{{ url('get-item-um-aum') }}",

          method : "POST",

          type: "JSON",

          data: {ItemCode: ItemCode,taxCode:taxCode,taxType:taxType},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){
                 
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

                    //console.log('data1.data_hsn',data1.data_hsn);
                    if(data1.data_hsn==''){
                      var hsnCode= '';
                      var shHCode= '';
                      $('#hsn_code'+ItemId).val(hsnCode);
                      $('#showHsnCd'+ItemId).html(shHCode);
                    }else{
                      $('#hsn_code'+ItemId).val(data1.data_hsn.HSN_CODE);
                      $('#showHsnCd'+ItemId).html('HSN No : '+data1.data_hsn.HSN_CODE);

                      $('#TolranceIndex'+ItemId).html('TOL. INDEX : '+data1.data_hsn.TOLERANCE_BASIS);

                      var batchCheck = data1.data_hsn.BATCH_CHECKE;

                      if(batchCheck == 'YES'){
                         var barctRefNo = data1.data_hsn.BATCH_REFRENCE;
                         var vrDate = $('#vr_date').val();

                         if(barctRefNo == 'GRN NO'){
                            $('#hsbatchno'+ItemId).removeClass('hidebatchnoinput');
                            var curntYear = $('#currentyear').val();
                            var startyear = curntYear.split('-');
                            var vrnoseq = $('#vrseqnum').val();
                            var seriesCode = $('#series_code').val();
                            $('#batchNumget'+ItemId).html(startyear[0]+'/'+seriesCode+'/'+vrnoseq);
                            $('#batchNumget'+ItemId).prop('readonly',true);
                         }else if(barctRefNo == 'MANUAL'){
                          $('#hsbatchno'+ItemId).removeClass('hidebatchnoinput');
                          $('#batchNumget'+ItemId).prop('readonly',false);
                         }else if(barctRefNo == 'GRN DATE'){
                           $('#hsbatchno'+ItemId).removeClass('hidebatchnoinput');
                           $('#batchNumget'+ItemId).prop('readonly',true);
                           $('#batchNumget'+ItemId).html(vrDate);
                         }
                      }

                      /* $('#tolerence_index'+ItemId).val(data1.data_hsn[0].tolerance_basis);*/

                      /* $('#tolerence_index'+ItemId).html(' <input type="text"  name="tolerence_index[]"  style="width: 30px" value="'+data1.data_hsn[0].tolerance_basis+'">');*/

                       $('#tolerence_index'+ItemId).html('<select name="toler_index[]"  style="width: 40px"><option value="P">P</option><option value="L">L</option></select>');

                      $('#TolranceRate'+ItemId).html('TOL. RATE : '+data1.data_hsn.TOLERANCE_QTY);

                      $('#tolerence_rate'+ItemId).html('<input type="text" name="tolerenc[]"  style="width: 60px;height:22px;" value="'+data1.data_hsn.TOLERANCE_QTY+'">');
                    }

                    if(data1.qua_pamter == ''){
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
                          $("#HsnSameShow"+ItemId).modal('show');
                          $('#headtaxCode'+ItemId).html('<b>( '+taxCode+' )</b>');
                          $('#itmtaxCode'+ItemId).html('');
                      }else{

                        var taxByhsn = data1.data_tax[0].TAX_CODE;

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
                      $('#taxslOkBtn'+ItemId).prop('disabled',true);
                      $('#taxSelErr'+ItemId).html('Please Select Tax Code');
                      $.each(data1.data_tax, function(k, gettax){

                        var taxData = '<input type="radio" class="taxcodeset" id="html" name="taxcodeit" value="'+gettax.TAX_CODE+'" onclick="taxSelectn('+ItemId+');"><label for="html">'+gettax.TAX_CODE+' ( '+gettax.TAX_NAME+' )</label><br>';
                        $('#showtaxcodeMul'+ItemId).append(taxData);
                          
                      });
                      }

                    }

                    if(data1.itypeGl == ''){
                      $('#itemglCode'+ItemId).val();
                    }else{
                      $('#itemglCode'+ItemId).val(data1.itypeGl[0].POST_CODE);
                    }

                   

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }/*function close*/

/* --------- START : ITEM CODE ------------ */

  function taxIntaxrate(trateid){

    setTimeout(function() {

      var taxCodebyitm =  $('#taxByItem'+trateid).val();
      var taxCSelect= $("input[type='radio'][name='taxcodeit']:checked").val();
      var itmCodeQuoNo =  $('#Item_CodeId'+trateid).val();
      var itmCodeGet =  $('#ItemCodeId'+trateid).val();

      if(itmCodeQuoNo){
        var itmCode = itmCodeQuoNo;
      }else if(itmCodeGet){
        var itmCode = itmCodeGet;
      }else{}

      if(taxCSelect){
        var taxCode = taxCSelect;
        $('#taxByItem'+trateid).val(taxCode);
        var itmWiseTaxList = $('#taxCodesellist').val();
        if(itmWiseTaxList == ''){
          $('#taxCodesellist').val(taxCode);
        }else{
          var prevTaxList = $('#taxCodesellist').val();
          var newTaxList = prevTaxList+','+taxCode;
          $('#taxCodesellist').val(newTaxList);
        }
      }else if(taxCodebyitm){
        var taxCode = taxCodebyitm;
      }else{}
      //console.log('taxCode',taxCode);
      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      if(itmCode){

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

      }else{
        $('#CalcTax'+trateid).prop('disabled',true);
      }

     }, 1000);

  }

/* -------- FIELD BLANK -------- */

  function blankFieldWhenItmChange(ItemId){

            $('#qty'+ItemId).val('');
             $('#A_qty'+ItemId).val('');
             $('#UnitM'+ItemId).val('');
             $('#AddUnitM'+ItemId).val('');
             $('#rate'+ItemId).val('');
             $('#basic'+ItemId).val('');
             $('#hsn_code'+ItemId).val('');
             $('#showHsnCd'+ItemId).html('');
             $('input[name="taxcodeit"]').prop('checked', false);
             $('#taxByItem'+ItemId).val('');
             $('#taxratebytax'+ItemId).val('');
             $('#aplytaxOrNot'+ItemId).html('0');
             $('#CalcTax'+ItemId).hide();
             $('#data_count'+ItemId).val('');
             $('#get_grand_num'+ItemId).val('');
             $('#tax_code'+ItemId).val('');
             $('#remark_data'+ItemId).val('');
             $('#qty'+ItemId).prop('readonly',true);
             $('#appliedbtn'+ItemId).html('');
             $('#footer_tax_btn'+ItemId).html('');
             $('#remark_data'+ItemId).prop('readonly',true);
             $('#viewItemDetail'+ItemId).addClass('showdetail');
             $('#itmC_code'+ItemId).val('');
             $('#hsbatchno'+ItemId).addClass('hidebatchnoinput');
             $('#batchNumget'+ItemId).html('');

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
  }

/* -------- FIELD BLANK -------- */

/* --------- QUALITY PARAMETER -------- */

  function qty_parameter(qty){

    var itemCodebypo = $('#Item_CodeId'+qty).val();
    var itemCodeId = $('#ItemCodeId'+qty).val();

      if(itemCodebypo){
        var itemCode = itemCodebypo;
      }else if(itemCodeId){
        var itemCode =itemCodeId;
      }

    var poHeadId = $("#po_headid"+qty).val();
    var poBodyId = $("#po_bodyid"+qty).val();
    var formName = 'GRN';

    var ItemCodeOnQp = $("#itmOnQp"+qty).val();

    if(ItemCodeOnQp == ''){
      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/get-quality-parameter-for-item-purchase') }}",

            data: {itemCode:itemCode,poHeadId:poHeadId,poBodyId:poBodyId,formName:formName}, // here $(this) refers to the ajax object not form

            success: function (data) {


              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      if(data1.data==''){

                        }else{

                          $('#qua_par_'+qty).empty();
                           //$('#footer_qaulity_btn'+qty).empty();
                           // $('#footer_ok_btn'+qty).empty();


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div><div class='box10 amountBox'>VendorQcValue</div><div class='box10 amountBox'>ActualQcValue</div><div class='box10 amountBox'>ThirdPartyQcValue</div></div>";

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

                            $('#itmOnQp'+qty).val(item_code);

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.ICATG_CODE+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+IQUACHAR+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+FROM_VALUE+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+TO_VALUE+" ></div><div class='box10 amountBox'><input type='text' id='venQcVal_"+qty+"_"+sr_no+"' name='venQcVal[]' class='form-control rightcontent' value='' ></div><div class='box10 amountBox'><input type='text' id='actualQcVal_"+qty+"_"+sr_no+"' name='actualQcVal[]' class='form-control rightcontent' value='' ></div><div class='box10 amountBox'><input type='text' id='thirdPartyQcVal_"+qty+"_"+sr_no+"' name='thirdPartyQcVal[]' class='form-control rightcontent' value='' ></div></div>";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });


                          var butn =  $('#footerqp_quality_btn'+qty).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkqpbtn"+qty+"' onclick='getQuaPvalue("+qty+",1)' style='width: 36px;'>Ok</button>";

                           $('#footerqp_quality_btn'+qty).append(tblData);

                             var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'   onclick='getQuaPvalue("+qty+",0)'>Cancel</button>";
                             
                           $('#footerqp_ok_btn'+qty).append(cancelfooter);

                         }else{
                          
                         }

                        }

                    }
           
            
            },

        });
    }else{}

  }  /* ./ quality Paramter*/

/* --------- QUALITY PARAMETER -------- */

  /* -------- simulation ------------- */
  
  function simulationcal(){

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      var itmeCode       =[];
      var taxIndCode     =[];
      var rateIndex      =[];
      var taxAmount      =[];
      var taxGl          =[];
      var taxRowC_byItem =[];
      var glByItem       =[];
      var grAmtByItm     =[];
      var itmWiseGl      =[];
      $('input[name^="itemcodeC"]').each(function (){
            itmeCode.push($(this).val());
      });

      $('input[name^="taxIndCode"]').each(function (){
            taxIndCode.push($(this).val());
      });

      $('input[name^="rate_ind"]').each(function (){
            rateIndex.push($(this).val());
      });

      $('input[name^="amount"]').each(function (){
            taxAmount.push($(this).val());
      });

      $('input[name^="taxGlCode"]').each(function (){
            taxGl.push($(this).val());
      });

      $('input[name^="data_Count"]').each(function (){
            taxRowC_byItem.push($(this).val());
      });

      $('input[name^="itemglCode"]').each(function (){
            glByItem.push($(this).val());
      });

      $('input[name^="dr_grandAmt"]').each(function (){
            grAmtByItm.push($(this).val());
      });

      $('input[name^="itmwiseGlCode"]').each(function (){
            itmWiseGl.push($(this).val());
      });

      var seriesGl = $('#seriesGl').val();
      var totalTaxRC = $('#allgetMCount').val();
      var netAmount = $('#allgrandAmt').val();
      var acc_glcd = $('#accGl').val();

      $.ajax({

              url:"{{ url('simulation-for-direct-purchase-bill') }}",

              method : "POST",

              type: "JSON",

              data: {itmeCode: itmeCode,taxIndCode:taxIndCode,rateIndex:rateIndex,taxAmount:taxAmount,taxGl:taxGl,taxRowC_byItem:taxRowC_byItem,seriesGl:seriesGl,totalTaxRC:totalTaxRC,glByItem:glByItem,grAmtByItm:grAmtByItm,itmWiseGl:itmWiseGl,netAmount:netAmount,acc_glcd:acc_glcd},

              success:function(data){

                  var data1 = JSON.parse(data);
                  
                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                    }else if(data1.response == 'success'){
                      
                        if(data1.data_sim==''){

                        }else{

                          $('#siml_body').empty();
                          var headData = "<div class='box-row '><div class='box10 codeIndBox'>Gl</div><div class='box10 nameIndBox'>Gl Name</div> <div class='box10 amountIndBox'>Debit-DR</div><div class='box10 amountIndBox'>Credit-CR</div></div>";
                          $('#siml_body').append(headData);

                          var drTotal = 0;
                          var crTotal = 0;

                          $.each(data1.data_sim, function(k, getData) {

                            drTotal += parseFloat(getData.DR_AMT);
                            crTotal += parseFloat(getData.CR_AMT);

                            var bodyData = "<div class='box-row tooltips'><div class='box10 codeIndBox'><small class='tooltipcoderef' >"+getData.CODE_NAME+"</small>"+getData.IND_GL_CODE+"</div> <div class='box10 nameIndBox'>"+getData.glName+"</div> <div class='box10 amountIndBox'>"+getData.DR_AMT+"</div> <div class='box10 amountIndBox'>"+getData.CR_AMT+"</div></div>";

                            $('#siml_body').append(bodyData);

                          });

                          var footerData = "<div class='box-row'><div class='box10 codeIndBox'></div> <div class='box10 nameIndBox'><b>Total</b></div> <div class='box10 amountIndBox'><b>"+drTotal.toFixed(2)+"</b></div> <div class='box10 amountIndBox'><b>"+crTotal.toFixed(2)+"</b></div></div>";

                          $('#siml_body').append(footerData);

                          
                        }
                      
                    } // success close

              } //success function close

      }); //ajax close 



  }

/* -------- simulation ------------- */
</script>

<script>
  
  /* ------- SUBMIT DATA -------- */

    function submitAllData(valD){

      var downloadFlg = valD;
      $('#donwloadStatus').val(downloadFlg);
      var grandAmt = $('#allgrandAmt').val();
      var seriesGl = $('#seriesGl').val();
      var accountGl = $('#accGl').val();

      var trcount=$('table tr').length;

      var valuetax= [];
      var valuegl= [];
      var valueitm= [];

      for(var y=0;y<trcount;y++){
          var trid = y+1;
         var ifnotaply = $('#aplytaxOrNot'+trid).html();
         var ifglnotaply = $('#itemglCode'+trid).val();

          valuetax.push(ifnotaply);
          valuegl.push(ifglnotaply);

          var itmCde = $('#ItemCodeId'+trid).val();
          var itmCdpop = $('#Item_CodeId'+trid).val();
          if(itmCdpop){
            var itemCodeS =itmCdpop;
          }else{
            var itemCodeS =itmCde;
          }
          valueitm.push(itemCodeS);
         
      }

      var found = valuetax.find(function (element) {
        return element == 0;
      });

      //console.log('valuegl ',valuegl);return false;
      var found_glP = valuegl.find(function (element) {
        return element=='';
      });

      var foundItm = valueitm.find(function (element) {
        return element == '';
      });

       if(foundItm == ''){
            $("#taxNotAppied").modal('show');
            $('#taxnotApMsg').html('');
            $('#grAmtIsGreatMsg').html('');
            $('#whenRowBlnk').html('Please Select <b>Item</b> In Above Row Otherwise Delete The Row.');
          }else if(found == 0 && grandAmt < 0){
              $("#taxNotAppied").modal('show');
              $('#whenRowBlnk').html('');
              $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');
              $('#grAmtIsGreatMsg').html('The <b>Grand Amount</b> Should Not Be Negative');
          }else if(found == 0){
                $("#taxNotAppied").modal('show');
                $('#grAmtIsGreatMsg').html('');
                $('#whenRowBlnk').html('');
                $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');
                
          }else if(grandAmt < 0){
              $("#taxNotAppied").modal('show');
                 $('#taxnotApMsg').html('');
                 $('#whenRowBlnk').html('');
              $('#grAmtIsGreatMsg').html('The <b>Grand Amount</b> Should Not Be Negative');
              
          }else if(seriesGl == '' || seriesGl == null){
              $("#gl_postNotAppied").modal('show');
              $('#notApMsgforitem').html('');
              $('#whenRowBlnk').html('');
              $('#notApMsgforSeries').html('The <b>Post Code</b> Has Not Been Applied For Series');
              
          }else if(accountGl == '' || accountGl == null){

              $("#gl_postNotAppied").modal('show');
              $('#notApMsgforitem').html('');
              $('#whenRowBlnk').html('');
              $('#notApMsgforSeries').html('The <b>Gl Code</b> Has Not Been Applied For Account');
          }else{

            var data = $("#grntrans").serialize();
          
            $('.overlay-spinner').removeClass('hideloader');

            $.ajaxSetup({

                  headers: {

                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                  }

            });

            $.ajax({

                type: 'POST',

                url: "{{ url('/Transaction/Purchase/Save-Direct-Purchase-Bill') }}",

                data: data, // here $(this) refers to the ajax object not form

                success: function (data) {
                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {
                    var responseVar = false;
                    var url = "{{url('Transaction/Purchase/View-Purchase-bill-Msg')}}"
                    setTimeout(function(){ window.location = url+'/'+responseVar; });
                  }else{
                    var responseVar = true;
                    if(downloadFlg == 1){
                      var fyYear = data1.data[0].FY_CODE;
                      var fyCd = fyYear.split('-');
                      var seriesCd = data1.data[0].SERIES_CODE;
                      var vrNo = data1.data[0].VRNO;
                      var fileN = 'PBILL_'+fyCd[0]+''+seriesCd+''+vrNo;
                      var link = document.createElement('a');
                      link.href = data1.url;
                      link.download = fileN+'.pdf';
                      link.dispatchEvent(new MouseEvent('click'));
                    }

                    var url = "{{url('Transaction/Purchase/View-Purchase-bill-Msg')}}"
                    setTimeout(function(){ window.location = url+'/'+responseVar; });
                  }

                },

            });

        }

    }

  /* ------- SUBMIT DATA -------- */

</script>

@endsection