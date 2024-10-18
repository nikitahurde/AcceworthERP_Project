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

  .tolrancehide{
    display: none !important;
  }

  .secondSection{
    display: none;
  }
 
  table {
    border-collapse: collapse;
  }

  .showdetail{
    display: none;
  }
  .showhideItm{
    display: none;
  }
  .showhideItm_itm{
    display: none;
  }
  .aplynotStatus{
    display: none;
  }
  .notshowcnlbtn{
    display: none;
  }
  .texIndbox {
    width: 3%;
    text-align: center;
  }
  .rateIndbox {
    width: 14%;
    text-align: center;
  }
  .modalScrlBar{
    border-radius: 5px;
    overflow-y: scroll;
    height: 512px;
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
        Contract Transaction
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
          <a href="{{ url('/Transaction/Purchase/Purchase-Contract-Trans') }}">Purchase Contract</a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Contract Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Transaction/Purchase/View-Contract-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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
                      <div class="col-md-3">

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
                      </div>
                          <!-- /.col -->
                      <div class="col-md-2">

                        <div class="form-group">

                          <label> T Code : </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              <input type="text" class="form-control" name="tran" value="<?php if(isset($trans_head)){echo $trans_head;}?>" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                              <input type="hidden" id="transtaxCode" >

                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                        </div>
                            <!-- /.form-group -->
                      </div>
                        <!-- /.col -->
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Series Code: 

                            <span class="required-field"></span>

                          </label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                            </div>
                            <?php $series = count($series_list); ?>
                            <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="<?php if($series == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" maxlength="6" onchange="getvrnoBySeries()">

                            <datalist id="seriesList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($series_list as $key)

                                <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                              @endforeach

                            </datalist>

                          </div>

                          <small id="series_code_errr" style="color: red;"></small>

                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->

                      <div class="col-md-4">

                        <div class="form-group">

                          <label> Series Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>


                              <input type="text" class="form-control" name="tran" value="<?php if($series == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>
                      <!-- /.col -->

                    </div>
                    <!-- /.row -->

                    <div class="row">
            
                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Vr No: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="hidden" name="" value="<?php if(isset($to_num)){echo $to_num;}?>" id="vr_last_num">

                            <input type="text" class="form-control rightcontent" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                         </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <?php $plntCount = count($plant_list); ?>
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" value="<?php if($plntCount ==1){echo $plant_list[0]->PLANT_CODE;}?>" readonly autocomplete="off">

                              <datalist id="PlantcodeList">

                                 <option value="">--SELECT--</option>
                                 @foreach ($plant_list as $key)

                                <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small>  

                                <div class="pull-left showSeletedName" id="plantText"></div>

                            </small>

                            <small id="plant_err" style="color: red;"> </small>
                            <input type="hidden" id="getStateByPlant" name="stateByPlant">
                        </div>
                        
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label> Plant Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="plantname" value="<?php if($plntCount ==1){echo $plant_list[0]->PLANT_NAME;}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Profit Center Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="profitList"  id="profitctrId" name="pfct" class="form-control  pull-left" value="{{ old('pfct')}}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly>

                            </div>

                          <small id="profit_center_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                    </div> <!-- row -->

                    <div class="row">

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Profit Center Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="pfctname" value="" id="pfctName" placeholder="Enter Profit Center Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Vendor Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 4px 12px;" >

                                  <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>
                                
                                <div class="" id="appndplantbtn"> 
                                </div>

                                 <?php $acc = count($getacc); ?>
                                 <?php if($acc == 1) { ?>

                                  <button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getaccdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>

                                 <?php } else{ ?>

                                    <i class="fa fa-newspaper-o" aria-hidden="true" id="showicon"></i>

                                 <?php } ?>

                              </span>
                              
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="<?php if($acc == 1){echo $getacc[0]->ACC_CODE;}else{echo old('AccCode');} ?>" onchange="getBYAccCode()" placeholder="Select Vendor" oninput="this.value = this.value.toUpperCase()" readonly  autocomplete="off"> 

                              <datalist id="AccountList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($getacc as $key)

                                <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                            <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                            <small id="acccode_code_errr" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group ">

                          <label> Vendor Name : </label>

                            <div class="input-group tooltips">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="acctname" value="<?php if($acc == 1){echo $getacc[0]->ACC_NAME;}else{} ?>" id="accountName" placeholder="Enter Vendor Name" readonly autocomplete="off">

                               <span class="tooltiptext tooltiphide" id="accountNameTooltip"></span>

                            </div>

                        </div>
                        
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Consignor/Delevory From: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 4px 12px;">

                                <i class="fa fa-newspaper-o " aria-hidden="true"></i>

                              </span>
                              
                              <input list="shipTAdd"  id="shipTAddr" class="form-control  pull-left" value="" placeholder="Select Consignor/Delevory From" readonly autocomplete="off"> 

                              <datalist id="shipTAdd">

                                <option selected="selected" value="">-- Select --</option>

                              </datalist>

                            </div>
                            <small id="err_shiptAdrMsg" style="color: red;" class="form-text text-muted"></small>
                            <input type="hidden" id="addId" value="">
                            <input type="hidden" value="" id="stateOfAcc">

                        </div>
                            <!-- /.form-group -->
                      </div>

                  
                    </div> <!-- row -->

                    <div class="row">

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Cost Center Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <?php $costCd = count($cost_list); ?>

                              <input list="Costcode_List" class="form-control" id="costCent_code" name="costCent_code" placeholder="Select Cost Center Code" maxlength="55" value="<?php if($costCd == 1){echo $cost_list[0]->COST_CODE; echo "[ ".$cost_list[0]->COST_NAME." ]";}?>" readonly  autocomplete="off">

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

                        </div>
                        <!-- /.form-group -->
                      </div> <!-- /.col -->

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Cost Center Name : </label>

                            <div class="input-group tooltips">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="costcname" value="<?php if($costCd == 1){echo $cost_list[0]->COST_NAME;}else{} ?>" id="costcenName" placeholder="Enter Cost Center Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Quotation No : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="qtnCompList" class="form-control" name="" value="" id="Quotn_compare_no" placeholder="Enter Quotation No" autocomplete="off">

                              <datalist id="qtnCompList">

                               

                              </datalist>

                            </div>
                            <small id="qcNotFound" style="color: red;"></small>
                            <input type="hidden" id="itmCountchk">
                        </div>
                        
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Tax Code: 
                            
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              
                              <input list="TaxcodeList"  id="tax_code" name="taxcode" class="form-control  pull-left" value="" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off" onchange="getitmByTax();">

                              <datalist id="TaxcodeList">

                              

                              </datalist>

                            </div>

                            <small id="Taxcode_errr" style="color: red;"></small>
                             <small id="Taxcode_name" style="color:#649fc0;font-weight: 700;"></small>


                        </div>
                            <!-- /.form-group -->
                      </div>
                      
                    </div>

                    <div class="row">

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Due Days: 
                            <span class="required-field"></span>
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="due_days" name="due_days" class="form-control  pull-left Number" value="{{ old('due_days')}}" placeholder="Enter Due Days" autocomplete="off" style="text-align: end;">

                            </div>
                            <small id="dueDays_err" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>


                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Due Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            
                              <input type="text" class="form-control rightcontent" name="due_date" id="due_date" value="{{ old('due_date')}}" placeholder="Select Due" autocomplete="off" readonly>

                            </div>
                        </div>
                            <!-- /.form-group -->
                      </div>
                          <!-- /.col -->
                      <div class="col-md-3">
                        <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 26px;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                      </div>
                    </div>

                  </div> <!-- /.tab first -->
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
                          </div>

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

                                <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="{{ $vrDate }}" placeholder="Select Party Ref Date" autocomplete="off">

                              </div>

                              <small id="showmsgfordate_1" style="color: red;"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                      {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                            </div>
                            <!-- /.form-group -->
                          </div>
                                                    
                      </div>

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
                          
                      </div>

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
                      </div>

                      
                  

                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
            

          

            

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

            <form id="salesordertrans">
              @csrf
              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <input type ="hidden" name="comp_name" id="getCompName">
                  <input type ="hidden" name="fy_year" id="getFyYear">
                  <input type ="hidden" name="trans_date" id="getTransDate">
                  <input type ="hidden" name="vr_no" id="getVrNo">
                  <input type ="hidden" name="trans_code" id="getTransCode">
                  <input type ="hidden" name="accountCode" id="getAccCode">
                  <input type ="hidden" name="account_name" value="<?php if($acc == 1){echo $getacc[0]->ACC_NAME;}else{} ?>" id="getAcc_Name">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="pfct_name" id="getPfctName">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="plant_name" id="getPlantName" value="<?php if($plntCount ==1){echo $plant_list[0]->PLANT_NAME;}?>">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
                  <input type ="hidden" name="series_name" value="<?php if($series == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="getSeriesName">
                  <input type ="hidden" name="tax_code" id="getTaxCode">
                  <input type="hidden" name="getdue_date" id="gateduedate">
                  <input type="hidden" name="getDue_days" id="gateduedays">
                  <input type ="hidden" name="party_ref_no" id="getpartyrfNo">
                  <input type ="hidden" name="party_ref_date" id="getpartyrfDate">
                  <input type ="hidden" name="consine_code" id="getcosine">
                  <input type ="hidden" name="rfhead1" id="getrfhead1">
                  <input type ="hidden" name="rfhead2" id="getrfhead2">
                  <input type ="hidden" name="rfhead3" id="getrfhead3">
                  <input type ="hidden" name="rfhead4" id="getrfhead4">
                  <input type ="hidden" name="rfhead5" id="getrfhead5">
                  <input type ="hidden" name="quotation_no" id="getQuotatnNo">
                  <input type ="hidden" name="consneAdd" id="gateconsAdd">
                  <input type ="hidden" name="cp_codeGet" value="" id="getcpCode">
                  <input type ="hidden" name="Cost_Center" id="gateCostCenter">
                  <input type ="hidden" name="CostName" value="<?php if($costCd == 1){echo $cost_list[0]->COST_NAME;}else{} ?>" id="gateCostCenterName">

                  <input type="hidden" id="quoComp_no" name="quoComp_no">

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

                    <th>Quality Parameter</th>

                  </tr>

                  <tr class="useful">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="cBocID1" onclick="checkcheckbox(1);" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">1.</span>
                    </td> 

                    <td class="tdthtablebordr">
                      <div class="input-group">
                        <input type="text" class="inputboxclr SetInCenter showhideItm" style="width: 90px;margin-bottom: 5px;" id='Item_CodeId1' name="item_codeQc[]" onclick="ShowItemCode(1);"  oninput="this.value = this.value.toUpperCase()" readonly />

                        <input list="Item_List1" class="inputboxclr SetInCenter prefitmSelect" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId1' name="item_codeAll[]" onchange="ItemCodeGet(1);taxIntaxrate(1);"  oninput="this.value = this.value.toUpperCase()">


                        <datalist id="Item_List1">
                          <option selected="selected" value="">-- Select --</option>

                            @foreach ($help_item_list as $key)

                            <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                            @endforeach
                        </datalist>

                        <input type="hidden" id="selectItem1">

                        <input type="hidden" id="idsun1">

                        <input type="hidden" id="pQtnHeadId1" name="pur_QtnHeadId[]">
                        <input type="hidden" id="pQtnBodyId1" name="pur_qtnbodyid[]">
                        <input type="hidden" id="pQtnNo1" name="qtnNos[]">
                        <input type="hidden" id="qcNo1" name="qtn_compNo[]">
                        <input type="hidden" id="itmGetCode1" name="item_code[]">
                        <input type="hidden" id="getlevel1" name="levelI[]">

                      </div>
                      <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1" onclick="showItemDetail(1)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                      

                      <div class="divhsn" id="showHsnCd1"></div>
                      <input type="hidden" id="hsn_code1" name="hsn_code[]">
                      <input type="hidden" id="taxByItem1" name="tax_byitem[]">
                      <input type="hidden" id="taxratebytax1" value="">
                      <input type="hidden" id="pur_qtn_head_id1" >
                      <input type="hidden" id="purqtn_body_id1" >
                      <input type="hidden" id="purqtn_head_id1" >
                      <input type="hidden" id="purb_id_fpurtax1" >
                    </td>

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id1' name="item_name[]" readonly />

                      <div class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></div>

                      <textarea id="remark_data1" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description" readonly></textarea>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='qty1' name="qty[]"  oninput="CalAQty(1)" style="width: 80px;" readonly />

                      <input type="text" name="unit_M[]" id="UnitM1" class="inputboxclr AddM SetInCenter" readonly >



                      <input type="hidden" id="Cfactor1">
                      <input type="hidden" id="balQtyByItem1">

                      </div>

                      
                      <div style="display: inline-flex;border:  none;margin-top: 6%;">
                            <button type="button" class="btn btn-primary btn-xs tolrancehide" id="tolranceshow1" data-toggle="modal" data-target="#view_tolrance1" onclick="tolranceDetail(1)" style="padding: 0px 3px 0px 3px;margin-bottom: 3px;font-size: 11px;">Tolerance</button>
                        
                      </div>

                      <div id="appliedtolrnbtn1"></div>
                      <div id="cancelbtolrntn1"></div>

                      <input type="hidden" name="tolerence_index[]" id="settolrnceIndex1">
                      <input type="hidden" name="tolerence_rate[]" id="setTolrnceRate1">
                      <input type="hidden" name="tolerence_value[]" id="setTolrnceValue1">
                      

                    
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
                        <input type="hidden" id="data_count1" class="dataCountCl" value="0" name="data_Count[]">

                        <input type="hidden" class="setGrandAmnt" id="get_grand_num1" name="crAmtPerItm[]">
                         <div style="margin-top: 23%;">
                         <small id="taxnotfound1" class="label label-danger"></small>
                         </div>
                       <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1); getGrandTotal(1);" disabled="">Calc Tax </button>
                       <div id="aplytaxOrNot1" class="aplynotStatus">0</div>
                       <div id="appliedbtn1"></div>
                        <div id="cancelbtn1"></div>

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

              </div><!-- /div -->

             <!--  <div class="row">
                <div class="col-md-6">
                     <div class="form-group mb-4">
                        <label for="staticEmail2">Basic Total</label>
                        <input type="text"  class="form-control-plaintext" id="" >
                      </div>
                </div>
              </div> -->

              <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">

              <div class="row" style="display: flex;">

                  <div class="col-md-6"></div>

                    <div class="col-md-4 toalvaldesn">

                    <div class="totlsetinres">Basic Total :</div>

                  </div>

                  <div class="col-md-1">
                    <input type="hidden" id="allgetMCount" name="getdatacount">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalBasciAmt" id="basicTotal" readonly="" style="margin-top: 3px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>

               <div class="row" style="display: flex;">

                  <div class="col-md-6">
                       <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                         <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
                  </div>

                    <div class="col-md-4 toalvaldesn">

                    <div class="totlsetinres">Other Total :</div>

                  </div>

                  <div class="col-md-1">

                    <input class="credittotldesn inputboxclr" type="text" name="TotalOtherAmt" id="otherTotalAmt" readonly="" style="margin-top: 3px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>

               <div class="row" style="display: flex;">

                  <div class="col-md-6"></div>

                    <div class="col-md-4 toalvaldesn">

                    <div class="totlsetinres">Grand Total :</div>

                  </div>

                  <div class="col-md-1">

                    <input class="credittotldesn inputboxclr" type="text" name="TotalGrandAmt" id="allgrandAmt" readonly="" style="margin-top: 3px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>
              <input type="hidden" id="checkitm">
              <input type="hidden" id="itmaftercheck">
              <div class="row">
                <div class="col-md-6"> 
                  <div class="col-md-3">
                      <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalPayTerms" data-toggle="modal" data-target="#payment_turms_M" disabled>Payment Turms </button>
                  </div>
                  <div class="col-md-3">
                      <div style="padding-top: 1px;">
                        <div id="paymentokbtn"></div>
                        <div id="paymentcancelbtn"></div>
                      </div>
                  </div>
                </div>
              </div>

  

      <br>

       

        <p class="text-center">

          <input type="hidden" id="donwloadStatus" name="donwloadStatus" value="">

          <button class="btn btn-success" type="button" id="submitdata" onclick="submitAllData(0);" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

          <button class="btn btn-success" type="button" id="submitDown" onclick="submitAllData(1);" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>

        </p>

       <!-- model -->

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

            <style>
              .showind_Ch{
                display: none;
              }
            </style>

            <div class="modal-body table-responsive">
                <div class="modalspinner hideloaderOnModl"></div>
                <div class="boxer" id="tax_rate_1">
                
                  <!-- End of 'box-row' -->
                  <!-- Start of 'box-row' -->
                  <!-- End of 'box-row' -->     

                </div>

            </div>

            <div class="modal-footer">

              <center>
              <span  id="footer_tax_btn1" style="width: 56px;"></span>
            </center>
            
            </div>

          </div>

        </div>

      </div>
      <!-- model -->

      <div id="domModel_2">
         
      </div>

      <!-- when hsn code same then show model -->

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
           
                <span id="errmsg" style="font-size: 12px;
    margin-left: 31px;"></span>
             
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
                    <div class="box10 texIndbox2">Item Name</div>
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

      <!-- show modal when click on view btn after item select item -->


      <!-- show modal for tolarence -->

      <div class="modal fade" id="view_tolrance1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Tolrance</h5>
                  </div>


                </div>

              </div>

                <div class="modal-body">
               <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Tolrance Index :</label>
                    
                  </div>
                  <div class="col-md-4">

                    <input list="TolrnceIndex1"  id="tolrance_index1" value="">

                    <datalist id="TolrnceIndex1">
                      <option value="P" data-xyz="Percentage">P - [Percentage]</option>
                      <option value="L" data-xyz="Lumsum">L - [Lumsum]</option>
                    </datalist>
                   
                  </div>
                 <div class="col-md-2"></div>
              </div>

              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Tolrance Rate :</label>
                    
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="tolrance_rate1" oninput="ratepercent(1)"  value="">
                  </div>

                  <div class="col-md-2"></div>
                  
                 
              </div>

              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Tolrance Value :</label>
                    
                  </div>
                   <div class="col-md-4">
                    <input type="text" id="tolrance_rate_percent1"  value="" readonly="">
                  </div>
                  
                  <div class="col-md-2"></div>
                  
                 
              </div>

             

              
            
              
              
            </div>
              <!-- body -->

              <!-- body -->


              <div class="modal-footer" style="text-align: center;">
               
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;" onclick="getTolerance(1)">Ok</button>
                <button type="button" class="btn btn-warning" style="width: 20%;" data-dismiss="modal" >Cancle</button>
              </div>

            </div>

          </div>

        </div>
      <!-- end modal for tolarence -->


      <!-- show model when click on item code -->

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

      <!-- show model when click on item code -->

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
                    <div class="box10 texIndbox2">Account Name</div>
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
                      <span id="plantCodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantpfctcodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantaddshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantcityshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantpinshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantdistshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantstateshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantemailshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantphoneshow"> </span>
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


        <!-- when tax not applied then show model -->

      <div id="taxNotAppied" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;">
                <div class="modal-header"  style="text-align: center;">
                    <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
                    
                </div>
                <div class="modal-body">
                  <p id="taxnotApMsg"></p>
                  <p id="grAmtIsGreatMsg"></p>
                  <p id="whenRowBlnk"></p>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" >OK</button>
                </div>
            </div>
        </div>
    </div>
      <!-- when tax not applied then show model -->

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

                    <p>Quantity is grater than balence qunatity .</p>

                </div>



                <div class="modal-footer" style="text-align: center;" id="greatQtyFooter">

                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="cancleGreatQty(1);">Ok</button>

                    <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>  -->  

                </div>



            </div>

        </div>

      </div>

      <!-- show modal when quantity is greater than balence qunatity -->

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

                <div style="text-align: center;"><small id="taxSelErr1" style="color: red;"></small></div>

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

     <!-- show modal when itemselect but tax not --> 

      <!-- when click on quality Parameter -->

      <div class="modal fade" id="quality_parametr1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

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
      <!-- when click on quality Parameter -->

    </form>

  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script>
<script src="{{ URL::asset('public/dist/js/viewjs/commonJsFun.js') }}" ></script>
  
<script type="text/javascript">



  $(document).ready(function() {

      $('#Quotn_compare_no').on('change',function(){

          $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

          });

          var Quotn_compare_no =  $('#Quotn_compare_no').val();
          var account_code =  $('#account_code').val();

          var xyz = $('#qtnCompList option').filter(function() {

          return this.value == Quotn_compare_no;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
           // console.log('No Match');
            $('#Quotn_compare_no').val('');
            $('#getQuotatnNo').val('');
            $('#quoComp_no').val('');
            $('#itmCountchk').val('');
          }else{
            $('#quoComp_no').val(Quotn_compare_no);
            $('#getQuotatnNo').val(Quotn_compare_no);
          }


         // console.log(Quotn_compare_no);

          $.ajax({

                url:"{{ url('get-acc-by-qc-no-for-contract') }}",

                method : "POST",

                type: "JSON",

                data: {Quotn_compare_no:Quotn_compare_no,account_code:account_code},

                success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                  }else if(data1.response == 'success'){

                      if(data1.data == ''){
                        $('#Item_CodeId1').addClass('showhideItm');
                        $('#ItemCodeId1').css('display','block');
                         $('#levelget').val('');
                      }else{
                        $('#Item_CodeId1').removeClass('showhideItm');
                        $('#ItemCodeId1').css('display','none');
                        $('#levelget').val(data1.data[0].LEVEL);
                      }
                  }

                }
          });
      });


  });


  function getitmByTax(){
    var taxCode = $('#tax_code').val();
    var Quotn_compare_no = $('#Quotn_compare_no').val();
    var account_code = $('#account_code').val();
    var qtnCompNo = $('#Quotn_compare_no').val();
    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $.ajax({

            url:"{{ url('get-item-data-by-tax-code') }}",

            method : "POST",

            type: "JSON",

            data: {taxCode: taxCode,Quotn_compare_no:Quotn_compare_no,account_code:account_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                   if(data1.data ==''){

                   }else{

                    if(qtnCompNo){
                        $('#Quotn_compare_no').prop('disabled',false);
                    }else{
                        $('#Quotn_compare_no').prop('disabled',true);
                    }

                      $("#Item_List1").empty();
                     // console.log('data1.data',data1.data);
                      $.each(data1.data, function(k, getData){

                          $("#Item_List1").append($('<option>',{

                            value:getData.ITEM_CODE,

                            'data-xyz':getData.ITEM_NAME,
                            text:getData.ITEM_NAME


                          }));

                        });

                   }

                }

            }

          });

  }


</script>

<script type="text/javascript">
/*on click model*/

  function ShowItemCode(itemval){

    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

    });

      var account_code     =  $('#account_code').val();
      var Quotn_compare_no =  $('#Quotn_compare_no').val();

      

      $.ajax({

        url:"{{ url('get-item-by-acc-code-for-contract') }}",

        method : "POST",

        type: "JSON",

        data: {account_code: account_code,Quotn_compare_no:Quotn_compare_no},

        success:function(data){

          var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){
              //console.log('data1.data[0]',data1.data[0]);
              if(data1.data == ''){
                  
              }else{

                if(Quotn_compare_no == ''){

                  /*var datalist = '<datalist id="ItemList'+itemval'"></datalist>';*/
                  /*$.each(data1.data, function(k, getData){

                    $("#ItemList"+itemval).append($('<option>',{

                      value:getData.item_code,

                      'data-xyz':getData.item_name,
                      text:getData.item_name

                    }));

                  });*/
                  $('#Item_CodeId'+itemval).addClass('showhideItm');
                  $('#ItemCodeId1').css('display','block');

                }else{

                  $('#Item_CodeId'+itemval).removeClass('showhideItm');
                  $('#ItemCodeId1').css('display','none');

                  $('#allItemShow'+itemval).modal('show');

                  $('#itemListShow_'+itemval).empty();

                  var tableHead= "<div class='box-row'><div class='box10 texIndbox'>#</div><div class='box10 rateIndbox' style='width: 6%;'>Vr. No</div><div class='box10 rateIndbox'>Item Name</div><div class='box10 rateIndbox'>Quo. Qty </div><div class='box10 rateIndbox'>Contract Qty </div><div class='box10 rateIndbox'>Cancel Qty </div><div class='box10 rateIndbox'>Quo. Bal. Qty </div><div class='box10 rateIndbox'>Level</div></div>";

                  $('#itemListShow_'+itemval).append(tableHead);

                  var incemntval = 1;

                  var inval = '';

                   //var Alreadyitm = $('#Item_CodeId'+itemval).val();
                    //var checkitm = $('#checkitm').val();

                  var itmCounts = data1.data.length;
                    $('#itmCountchk').val(itmCounts);
                    if(itmCounts == 1){
                      $('#addmorhidn').prop('disabled',true);
                    }else{
                      $('#addmorhidn').prop('disabled',false);
                    }        

                   // console.log('data1.data',data1.data);          
                  $.each(data1.data, function(k, getData) {

                    if(getData.QTYISSUED == null){
                      var qtyissued = 0.000;
                    }else{
                      var qtyissued =getData.QTYISSUED;
                    }
                   // var alreadyCheck= $("input[type='radio'][name='itemname']:checked").val();

                   // console.log('alreadyCheck',alreadyCheck);
                
                   /* if(Alreadyitm != '' && Alreadyitm == checkitm){

                      $('.radiobtn'+itemval).prop('disabled',true);
                       $('.radiobtn'+itemval).attr('checked', true);
     
                      console.log('true');
                    }else{
                      $('.radiobtn'+itemval).prop('disabled',false);
                      console.log('false');
                    }
                  */
                    var tableBody = "<div class='box-row' id='hidebalNull_"+itemval+"_"+incemntval+"'><div class='box10 texIndbox'><input type='radio' id='sr_"+itemval+"_"+incemntval+"' name='itemname' value='"+itemval+"_"+incemntval+"' class='radiobtn"+itemval+"'><input type='hidden' value="+getData.PQTNHID+" name='' id='pqheadid_"+itemval+"_"+incemntval+"'><input type='hidden' value="+getData.PQTNBID+" name='' id='pqbodyid_"+itemval+"_"+incemntval+"'><input type='hidden' value="+getData.PQTN_VRNO+" name='' id='pqnoid_"+itemval+"_"+incemntval+"'></div><div class='box10 texIndbox_vr'><input type='text' id='vrno_"+itemval+"_"+incemntval+"' name='head_tax_ind11[]' class='form-control inputtaxInd ' value="+getData.PQCSHID+" readonly></div><div class='box10 texIndbox_itm tooltips'><input type='text' id='itemcode_"+itemval+"_"+incemntval+"' name='poitemname[]' class='form-control inputtaxInd' value='"+getData.ITEM_CODE+"("+getData.ITEM_NAME+" )"+"' readonly><div class='tooltiptextitem tooltiphide' id='itemNameTooltip_"+itemval+"_"+incemntval+"'></div><input type='hidden' id='itemname_"+itemval+"_"+incemntval+"' name='poitemcode[]' class='form-control inputtaxInd' value='"+getData.ITEM_NAME+"' readonly><input type='hidden' id='discriptin_"+itemval+"_"+incemntval+"' name='' class='form-control inputtaxInd' value='"+getData.PARTICULAR+"' readonly><input type='hidden' id='taxCodeI_"+itemval+"_"+incemntval+"' name='' class='form-control inputtaxInd' value='"+getData.TAX_CODE+"' readonly><input type='hidden' id='hsnCodeI_"+itemval+"_"+incemntval+"' name='' class='form-control inputtaxInd' value='"+getData.HSN_CODE+"' readonly></div><div class='box10 rateIndbox'><input type='text' id='qtyOreder_"+itemval+"_"+incemntval+"' name='qtyOrder' class='form-control rightcontent' value="+getData.QTYRECD+" readonly><input type='hidden' value="+getData.RATE+" id='rateqNo_"+itemval+"_"+incemntval+"'><input type='hidden' value="+getData.AQTYRECD+" id='aqtyNo_"+itemval+"_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='qtySupply_"+itemval+"_"+incemntval+"' name='qtySupply[]' class='form-control rightcontent' value="+qtyissued+" readonly></div><div class='box10 rateIndbox'><input type='text' id='qtyCancle_"+itemval+"_"+incemntval+"' name='qtyCancle[]' class='form-control rightcontent' value="+getData.QTYCANCEL+" readonly></div><div class='box10 rateIndbox'><input type='text' id='balence_qty_"+itemval+"_"+incemntval+"' name='balQty[]' class='form-control rightcontent' value="+getData.QTYRECD+" readonly><input type='hidden' class='form-control' id='remainBalQty_"+itemval+"_"+incemntval+"' value='' readonly></div><div class='box10 rateIndbox'><input type='text' id='qlevel_"+itemval+"_"+incemntval+"' name='' class='form-control rightcontent' value="+getData.LEVEL+" style='width:50px;' readonly ></div></div>";

                    //console.log('tableBody',tableBody);

                    $('#itemListShow_'+itemval).append(tableBody);

                     $('#itemNameTooltip_'+itemval+'_'+incemntval).removeClass('tooltiphide');

                     $('#itemNameTooltip_'+itemval+'_'+incemntval).html(getData.ITEM_NAME);

                    getItemForCheckQty(itemval,incemntval);

                    inval = incemntval;

                    incemntval++;

                  }); //each loop close

                  var butn =  $('#footer_item_'+itemval).find(':button').html();

                  if(butn != 'Ok' || butn =='undefined'){

                      var tablefooter = "<button type='button' class='btn btn-primary ' style='width: 16%;' data-dismiss='modal' id='ApplyOkitmbtn"+itemval+"' onclick='selectitem("+itemval+","+inval+");umAumByitm("+itemval+","+inval+");taxIntaxrate("+itemval+")'>Ok</button><button type='button' class='btn btn-danger notshowcnlbtn' data-dismiss='modal' style='width: 16%;' id='addbtnwhenselect"+itemval+"'>Cancel</button>";

                        $('#footer_item_'+itemval).append(tablefooter);

                  }else{

                  }

                  var selectedItem = $('#selectItem'+itemval).val();

                  console.log('selectedItem',selectedItem);

                  var uniqByitm = $('#idsun'+itemval).val();

                   if(selectedItem){

                    $('#sr_'+uniqByitm).prop('checked',true);

                    $('#ApplyOkitmbtn'+itemval).prop('disabled',true);

                    $('#addbtnwhenselect'+itemval).removeClass('notshowcnlbtn');

                    $('input[name="itemname"]').each(function() {
                       //if not selected
                      if ($(this).is( ":not(:checked)")) {
                        // add disable
                        $(this).attr('disabled', 'disabled');
                      }
                    });

                   }

                } //else close
                  
                

              }

            }

        }

      });

    /*var tableHead= "<div class='box-row'><div class='box10 texIndbox'>#</div><div class='box10 vrnoinbox' style='width: 6%;'>Vr. No</div><div class='box10 vrnoinbox'>Series</div><div class='box10 vrnoinbox'>Ref. No</div><div class='box10 vrnoinbox' style='width: 12%;'>Tran Date</div><div class='box10 itemIndbox'>Item Name</div><div class='box10 itemIndbox'>Item Code</div><div class='box10 rateIndbox'>Qty Order </div><div class='box10 rateIndbox'>Qty Supply </div><div class='box10 rateIndbox'>Bal. Qty </div></div>";


     $('#itemListShow_'+itemval).append(tableHead);

     $('#allItemShow'+itemval).modal('show');*/
  }


  function getItemForCheckQty(rowI,calI){

    var itemGet = $('#itemcode_'+rowI+'_'+calI).val();

    var balenqty = $('#balence_qty_'+rowI+'_'+calI).val();

    var orderQty = $('#qtyOreder_'+rowI+'_'+calI).val();
    var suplyQty = $('#qtySupply_'+rowI+'_'+calI).val();
    var cancleQty = $('#qtyCancle_'+rowI+'_'+calI).val();

      var balenceQty =  orderQty - suplyQty - cancleQty;

      $('#balence_qty_'+rowI+'_'+calI).val(balenceQty.toFixed(3));

      if(orderQty == suplyQty){
        $('#hidebalNull_'+rowI+'_'+calI).hide();
      }else{
        $('#hidebalNull_'+rowI+'_'+calI).show();
      }

  }

  function selectitem(rowid,itmebyid){

    var chckitms = $('#itmCountchk').val();
    console.log('chckitms',chckitms);
    if(chckitms == 1){
      $('#addmorhidn').prop('disabled',true);
      console.log('true');
    }else{
      $('#addmorhidn').prop('disabled',false);
      console.log('false');
    }

   // console.log('itmebyid',itmebyid);

   // var ele = document.getElementsByName('itemname');

   var checkitmIsAval = $('#Item_CodeId'+rowid).val();

    var ind_value= $("input[type='radio'][name='itemname']:checked").val();
    //console.log('ind_value',ind_value);

    if(ind_value){

        var res            = ind_value.split("_");
        var res1           = res[0];
        var res2           = res[1];
        var itemcode       = $('#itemcode_'+res1+'_'+res2).val();
        var item_Code      =  itemcode.split('(');
        var getitemCd      = item_Code[0];
        var cur_val        = $('#checkitm').val();
        var balencQtyByitm = $('#balence_qty_'+res1+'_'+res2).val();
        var sequnNo        = $('#vrno_'+res1+'_'+res2).val();
        var qc_rate        = $('#rateqNo_'+res1+'_'+res2).val();
        var addlQty        = $('#aqtyNo_'+res1+'_'+res2).val();
        var qtyOreder      = $('#qtyOreder_'+res1+'_'+res2).val();
        var qtySupply      = $('#qtySupply_'+res1+'_'+res2).val();
        var pqheadid       = $('#pqheadid_'+res1+'_'+res2).val();
        var pqbodyid       = $('#pqbodyid_'+res1+'_'+res2).val();
        var pqnoid         = $('#pqnoid_'+res1+'_'+res2).val();
        var qcvrno         = $('#vrno_'+res1+'_'+res2).val();
        var deiscriptn     = $('#discriptin_'+res1+'_'+res2).val();
        var qclevel        = $('#qlevel_'+res1+'_'+res2).val();
        var taxCode        = $('#taxCodeI_'+res1+'_'+res2).val();
        var hsnCode        = $('#hsnCodeI_'+res1+'_'+res2).val();

        if(deiscriptn =='' || deiscriptn=='null'){
          var discrD = '';
        }else{
          var discrD = deiscriptn;
        }

         $('#tolranceshow'+rowid).removeClass('tolrancehide');

         var cnclbtn ='<input type="hidden" value="'+0+'" id="tolcvalue"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

         $('#cancelbtolrntn'+rowid).html(cnclbtn);

            var cnclbtntax ='<input type="hidden" value="0" id="qltyvalue'+rowid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

             $('#cancelbtn'+rowid).html(cnclbtntax);

             var cnclbtnqp ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

             $('#cancelQpbtn'+rowid).html(cnclbtnqp);

             

        $('#Item_CodeId'+rowid).val(getitemCd);
        $('#itmGetCode'+rowid).val(getitemCd);
        
        $('#selectItem'+rowid).val(getitemCd);
        
        $('#itembyQtyOrder'+rowid).val(qtyOreder);
        
        $('#itembyQtysuply'+rowid).val(qtySupply);
        
        $('#idsun'+rowid).val(res1+'_'+res2);
        
        $('#getordervrno'+rowid).val(sequnNo);
        
        $('#balQtyByItem'+rowid).val(balencQtyByitm);
        $('#rate'+rowid).val(qc_rate);
        $('#qnrate'+rowid).val(qc_rate);
        $('#qty'+rowid).val(balencQtyByitm);
        $('#taxByItem'+rowid).val(taxCode);
       // $('#A_qty'+rowid).val(addlQty);
        
        $('#qty'+rowid).prop('readonly',false);
        $('#rate'+rowid).prop('readonly',false);
        $('#CalcTax'+rowid).prop('readonly',false);
        $('#remark_data'+rowid).prop('readonly',false);
        
        $('#pQtnHeadId'+rowid).val(pqheadid);
        $('#pQtnBodyId'+rowid).val(pqbodyid);
        $('#pQtnNo'+rowid).val(pqnoid);
        $('#qcNo'+rowid).val(qcvrno);
        $('#remark_data'+rowid).val(discrD);
        $('#getlevel'+rowid).val(qclevel);
        $('#vr_date,#Plant_code,#series_code,#account_code,#Quotn_compare_no,#due_days,#tax_code,#party_rf_no,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

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
                    $('#A_qty'+rowid).val('');
                    $('#rate'+rowid).val('');
                    $('#qnrate'+rowid).val('');
                    $('#pQtnHeadId'+rowid).val('');
                    $('#pQtnBodyId'+rowid).val('');
                    $('#pQtnNo'+rowid).val('');
                    $('#qcNo'+rowid).val('');
                    $('#itmGetCode'+rowid).val('');
                    $('#selectItem'+rowid).val('');
                    $('#idsun'+rowid).val('');
                    $('#remark_data'+rowid).val('');
                    $('#getlevel'+rowid).val('');
                    $('#tolranceshow'+rowid).addClass('tolrancehide');
                    $('#cancelbtolrntn'+rowid).css('display','none');
                    $('#cancelbtn'+rowid).html('');
                    $('#cancelQpbtn'+rowid).html('');
              }else{
                    $('#checkitm').val(cur_val + "," + getitemCd);
                     $('#vr_date,#Plant_code,#series_code,#account_code,#Quotn_compare_no,#due_days,#tax_code,#party_rf_no,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

                     $('#party_ref_date').prop('disabled',true);

              }
            }
          }

        }else{
          $('#checkitm').val(getitemCd);
        }



    }else{}

  }

    function umAumByitm(umaumvl,cfval){

      var itmcode =  $('#Item_CodeId'+umaumvl).val();
      var getqty =  $('#balQtyByItem'+umaumvl).val();
      var item_Code =  itmcode.split('(');

      var ItemCode = item_Code[0];

      var taxCode =  $('#getTaxCode').val();

      var qtyqc = $('#qtyOreder_'+umaumvl+'_'+cfval).val();
     
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

                      var aQtycal = getqty * data1.data[0].AUM_FACTOR;
                      $('#A_qty'+umaumvl).val(aQtycal.toFixed(3));

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

                      $('#viewItemDetail'+umaumvl).removeClass('showdetail');

                     $('#itemNameTooltip'+umaumvl).removeClass('tooltiphide');

                     $('#itemNameTooltip'+umaumvl).html(data1.data_hsn.ITEM_NAME); 


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



                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }/*function close*/



  function CalculateTax(taxid){

    //console.log('second fun',taxid);

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
     // console.log('taxOnModel',taxOnModel);
      var basicAmt = $('#basic'+taxid).val();

      $('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt);
     // console.log($('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt));



    if(taxOnModel == ''){

      var tax_code = $('#taxByItem'+taxid).val();
      var purQtnHeadId = $('#pQtnHeadId'+taxid).val();
      var PurQtnBodyId = $('#pQtnBodyId'+taxid).val();
      var ItemCodeByqc = $('#Item_CodeId'+taxid).val();
      var ItemCodeId = $('#ItemCodeId'+taxid).val();
      if(ItemCodeByqc){
        var ItemCode = ItemCodeByqc;
        
      }else if(ItemCodeId){
         var ItemCode = ItemCodeId;
        
      }

      $.ajax({

              url:"{{ url('get-a-field-calc-by-itm-tax-code') }}",

              method : "POST",

              type: "JSON",

              data: {tax_code: tax_code,purQtnHeadId:purQtnHeadId,PurQtnBodyId:PurQtnBodyId,ItemCode:ItemCode},

              beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },

              success:function(data){
                  var data1 = JSON.parse(data);
                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");    
                      ;    
                                     

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

                             $('#tax_code'+taxid).val(tax_code);
                             
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly> <input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"> </div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''></div></div>";



                            }else{

                                if(getData.tax_ind_name == 'GrandTotal'){
                                  var classname = 'grandTotalGet';
                                }else{
                                  var classname = '';
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

                                

                                if(getData.TAX_AMT){
                                  var taxAmt =getData.TAX_AMT
                                }else{
                                  var taxAmt ='';
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

                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></div><div class='box10 rateIndbox'> <input type='text' class='form-control' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+");'> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a> </div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control' oninput='getGrandTotal("+taxid+");' ></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+taxAmt+"' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticIND+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'></div></div> <div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+");'>Apply</button></div></div></div></div>";

                              

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

                         var tblData = "<button type='button' class='btn btn-primary ' style='width: 10%;' data-dismiss='modal' id='ApplyOktaxbtn"+taxid+"' onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",1);'>Ok</button>";
                             
                            $('#footer_tax_btn'+taxid).append(tblData);

                            /*var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'  onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",0);'>Cancel</button>";
                             
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



</script>

<script>

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

                  if(data1.vrno_series == ''){
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

</script>



<script type="text/javascript">

  $(document).ready(function(){

    $( window ).on( "load", function() {

      getvrnoBySeries();



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
              //console.log('data1.data[0]',data1.data[0]);
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
                  $('#profitctrId').val(data1.data[0].PFCT_CODE);
                  $('#pfctName').val(data1.data[0].PFCT_NAME);
                  $('#getPfctName').val(data1.data[0].PFCT_NAME);
                  $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                  $('#getStateByPlant').val(data1.data[0].STATE_CODE);

                }

            }

        }

      });

      setTimeout(function(){
        getBYAccCode();
      },500);

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
        $('#CalPayTerms').prop('disabled',false);

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

      console.log('ifnotaply',notck);

      if(ifnotaply == 0){
         $("#taxNotAppied").modal('show');
         $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');
      }else{

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'  id='cBocID"+i+"' onclick='checkcheckbox("+i+");'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> <input  type='hidden' name='tds_rate[]' id='TdsRateByAccCode"+i+"' class='getRateForAcc'><input type='hidden' name='tds_code[]' id='TdsSection"+i+"'><input type='hidden' name='' id='accNtdsrate"+i+"'></td>";

      data +="<td class='tdthtablebordr'><div class='input-group'><input type='text' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='Item_CodeId"+i+"' name='item_codeQc[]' onclick='ShowItemCode("+i+");' oninput='this.value = this.value.toUpperCase()' readonly /><input list='Item_List"+i+"' class='inputboxclr SetInCenter prefitmSelect' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' name='item_codeAll[]' onchange='ItemCodeGet("+i+");taxIntaxrate("+i+");'  oninput='this.value = this.value.toUpperCase()'> <datalist id='Item_List"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($help_item_list as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option> @endforeach</datalist><input type='hidden' id='selectItem"+i+"'><input type='hidden' id='idsun"+i+"'> <input type='hidden' id='pQtnHeadId"+i+"' name='pur_QtnHeadId[]'> <input type='hidden' id='pQtnBodyId"+i+"' name='pur_qtnbodyid[]'> <input type='hidden' id='pQtnNo"+i+"' name='qtnNos[]'><input type='hidden' id='qcNo"+i+"' name='qtn_compNo[]'> <input type='hidden' id='itmGetCode"+i+"' name='item_code[]'><input type='hidden' id='getlevel"+i+"' name='levelI[]'></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button> <div class='divhsn' id='showHsnCd"+i+"'></div> <input type='hidden' id='hsn_code"+i+"' name='hsn_code[]'> <input type='hidden' id='taxByItem"+i+"' name='tax_byitem[]'><input type='hidden' id='taxratebytax"+i+"' value=''><input type='hidden' id='pur_qtn_head_id"+i+"' > <input type='hidden' id='purqtn_body_id"+i+"' > <input type='hidden' id='purqtn_head_id"+i+"' ><input type='hidden' id='purb_id_fpurtax"+i+"' > </td> <td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly /><div class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></div><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description'></textarea></td> <td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='qty"+i+"' name='qty[]' oninput='CalAQty("+i+")' style='width: 80px' /><input type='text' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' id='Cfactor"+i+"'><input type='hidden' id='balQtyByItem"+i+"'></div><div style='display: inline-flex;border: none;margin-top: 6%;'><button type='button' class='btn btn-primary btn-xs tolrancehide' id='tolranceshow"+i+"' data-toggle='modal' data-target='#view_tolrance"+i+"' onclick='tolranceDetail("+i+")' style='padding: 0px 3px 0px 3px;margin-bottom: 3px;font-size: 11px;'>Tolerance</button><input type='hidden' name='tolerence_index[]' id='settolrnceIndex"+i+"'><input type='hidden' name='tolerence_rate[]' id='setTolrnceRate"+i+"'><input type='hidden' name='tolerence_value[]' id='setTolrnceValue"+i+"'></div><div id='appliedtolrnbtn"+i+"'></div><div id='cancelbtolrntn"+i+"'></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input list='aumList"+i+"' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddMList' onchange='changeAum("+i+")'><datalist id='aumList"+i+"'><option value=''>--select--</option></datalist></div></td> <td class='tdthtablebordr'><input type='text' class='debitcreditbox inputboxclr cr_amount SetInCenter'  oninput='calculateBasicAmt("+i+")' id='rate"+i+"' name='rate[]'  style='width: 80px'/><input type='hidden' id='qnrate"+i+"'></td> <td class='tdthtablebordr'><input type='text' name='basic_amt[]' readonly id='basic"+i+"' class='form-control basicamt' style='width: 110px;margin-top: 14%;height: 22px;' ></td> <td> <input type='hidden' id='data_count"+i+"' value='0' class='dataCountCl' name='data_Count[]'><input type='hidden' class='setGrandAmnt' name='crAmtPerItm[]' id='get_grand_num"+i+"'><div style='margin-top: 23%;'><small id='taxnotfound"+i+"' class='label label-danger'></small></div><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='CalcTax"+i+"' data-toggle='modal' data-target='#tds_rate_model"+i+"' onclick='CalculateTax("+i+"); getGrandTotal("+i+");'>Calc Tax</button><div id='appliedbtn"+i+"'></div><div id='cancelbtn"+i+"'></div><div id='aplytaxOrNot"+i+"' class='aplynotStatus'>0</div> <div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div> </div></div><div class='modal-body table-responsive'><div class='boxer' id=''> <div class='box-row'><div class='box10 texIndbox1'>Item Code</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading'><small id='itemCodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='taxcodeshow"+i+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemDetailshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemtypeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemgroupshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemclassshow"+i+"'> </small> </div> <div class='box10 itmdetlheading'><small id='itemcategoryshow"+i+"'> </small></div> </div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div><div id='allItemShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-lg' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'> <div class='modal-header'> <div class='row'> <div class='col-md-12' style='text-align: center;'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Details</h5>  </div></div> </div> <div class='modal-body table-responsive'><div class='boxer' id='itemListShow_"+i+"'> </div></div> <div class='modal-footer' style='text-align: center;' id='footer_item_"+i+"'> </div></div> </div></div> <div class='modal fade' id='view_tolrance"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-sm' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tolrance</h5></div></div></div><div class='modal-body'><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Index :</label></div><div class='col-md-4'><input list='TolrnceIndex"+i+"'  id='tolrance_index"+i+"' value=''><datalist id='TolrnceIndex"+i+"'><option value=''>--Select--</option><option value='P' data-xyz='Percentage'>P - [Percentage]</option><option value='L' data-xyz='Lumsum'>L - [Lumsum]</option></datalist></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Rate :</label></div><div class='col-md-4'><input type='text' id='tolrance_rate"+i+"'  value='' oninput='ratepercent("+i+")'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Value:</label></div><div class='col-md-4'><input type='text' id='tolrance_rate_percent"+i+"'  value='' readonly=' name='tolrance_value[]'></div><div class='col-md-2'></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;' onclick='getTolerance("+i+")'>Ok</button><button type='button' class='btn btn-warning' style='width: 20%;' data-dismiss='modal'>Cancle</button></div></div></div></div><div id='grateQtyShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'> <div class='modal-header'> <div class='row'> <div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5> </div> </div></div> <div class='modal-body table-responsive'> <p>Quantity is grater than balence qunatity</p> </div>  <div class='modal-footer' style='text-align: center;' id='greatQtyFooter'> <button type='button' class='btn btn-secondary' data-dismiss='modal' onclick='cancleGreatQty("+i+");'>Ok</button>  </div> </div></div> </div></td><td><div style='margin-top: 12%;'><small id='qpnotfound"+i+"' class='label label-danger'></small></div><input type='hidden' id='quaP_count"+i+"' value='0' name='quaP_count[]' class='quaPcountrow'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='qua_paramter"+i+"' data-toggle='modal' data-target='#quality_parametr"+i+"' onclick='qty_parameter("+i+")' disabled='' style='padding-bottom: 0px;padding-top: 0px;'>Quality Parametr </button><div id='cancelQpbtn"+i+"'></div><div id='appliedQpbtn"+i+"'></div><div id='qpApplyOrNot"+i+"' class='aplynotStatus'>0</div><small id='qPnotfountbtn"+i+"' class='label label-danger'></small><div id='greaterRateShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5></div></div></div><div class='modal-body table-responsive'><p>Rate Should Not Be Greater</p></div><div class='modal-footer' style='text-align: center;' id='greatRateFooter"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div><div id='taxSelectModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='font-weight: 800;'>Select Tax Code</h5></div></div></div><div style='text-align: center;'><small id='taxSelErr"+i+"' style='color: red;'></small></div><div class='modal-body table-responsive'><div id='showtaxcodeMul"+i+"' style='line-height: 23px;text-align: initial;'></div></div><div class='modal-footer' style='text-align: center;' id='taxCodeSelect"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='taxIntaxrate("+i+");' style='width: 83px;'  id='taxslOkBtn1"+i+"'>Ok</button></div></div></div></div></td>";

      $('table').append(data);

      var domModel = "<div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content modalScrlBar' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-5'><div class='form-group'> <lable class='settaxcodemodel col-md-4' style='padding: 0px;'>Tax Code - </lable> <input type='text' class='settaxcodemodel col-md-7' id='tax_code"+i+"' style='border: none; padding: 0px;' readonly> </div> </div><div class='col-md-6'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tax / Charges / etc Calculation</h5></div><div class='col-md-1'></div></div> </div> <div class='modal-body table-responsive'><div class='modalspinner hideloaderOnModl'></div><div class='boxer' id='tax_rate_"+i+"'><div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div> <div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div> </div> </div></div> <div class='modal-footer'><center> <small  id='footer_tax_btn"+i+"' style='width: 10px;'></small></center> </div></div></div> </div> <div id='HsnSameShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title' style='color: red;font-weight: 800;'>Alert !!</h5></div><div class='modal-body'><p>Header Tax Code  <small id='headtaxCode"+i+"'></small> Is Different Than Item Wise Tax Code <small id='itmtaxCode"+i+"'></small></p></div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal' onclick='cancleblnkItm("+i+");'>Cancel</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div>";

       $('#domModel_2').append(domModel);

       var qpModlDom = "<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><input type='hidden' id='itmOnQp"+i+"'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Qaulity Parameter</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+i+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footerqp_ok_btn"+i+"'></small>&nbsp<small style='text-align: center;' id='footerqp_quality_btn"+i+"'></small></center></div></div></div></div>";

       $('#quaPdomModel_2').append(qpModlDom);


        var Quotn_compare_no =  $('#Quotn_compare_no').val();
       
        if(Quotn_compare_no != ''){

          $('#Item_CodeId'+i).prop('hidden',false);
          $('#ItemCodeId'+i).prop('hidden',true);

        }else{

          $('#Item_CodeId'+i).prop('hidden',true);
          $('#ItemCodeId'+i).prop('hidden',false);

        }

        var taxCode = $('#tax_code').val();
        var Quotn_compare_no = $('#Quotn_compare_no').val();
        var account_code = $('#account_code').val();
        var qtnCompNo = $('#Quotn_compare_no').val();
        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

                url:"{{ url('get-item-data-by-tax-code') }}",

                method : "POST",

                type: "JSON",

                data: {taxCode: taxCode,Quotn_compare_no:Quotn_compare_no,account_code:account_code},

                success:function(data){

                  var data1 = JSON.parse(data);

                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                    }else if(data1.response == 'success'){

                       if(data1.data ==''){

                       }else{

                        if(qtnCompNo){
                            $('#Quotn_compare_no').prop('disabled',false);
                        }else{
                            $('#Quotn_compare_no').prop('disabled',true);
                        }
                          $("#Item_List"+row_i).empty();
                         // console.log('data1.data',data1.data);
                        $.each(data1.data, function(k, getData){

                            $("#Item_List"+row_i).append($('<option>',{

                              value:getData.ITEM_CODE,

                              'data-xyz':getData.ITEM_NAME,
                              text:getData.ITEM_NAME


                            }));

                          });

                       }

                    }

                }

              });


      i++;row_i++;

    } /* /. else */

  });  /*--function close--*/


</script>

<script type="text/javascript">

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
     // console.log('ItemCode',ItemCode);
      var taxCode =  $('#tax_code').val();
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

      var xyz = $('#Item_List'+ItemId+' option').filter(function() {

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
             $('#pur_qtn_head_id1').val('');
             $('#purqtn_head_id'+ItemId).val('');
             $('#purqtn_body_id'+ItemId).val('');
             $('#data_count'+ItemId).val('');
             $('#get_grand_num'+ItemId).val('');
             $('#remark_data'+ItemId).val('');
             $('#qty'+ItemId).prop('readonly',true);
             $('#remark_data'+ItemId).prop('readonly',true);
             $('#addmorhidn').prop('disabled',false);
             $('#deletehidn').prop('disabled',true);
             $('#submitdata').prop('disabled',true);
             $('#submitDown').prop('disabled',true);
             $('#appliedbtn'+ItemId).html('');
             $('#viewItemDetail'+ItemId).addClass('showdetail');
             $('#itemNameTooltip'+ItemId).addClass('tooltiphide');
             $('#cancelbtolrntn'+ItemId).html('');
             $('#appliedtolrnbtn'+ItemId).html('');

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

          setFieldBlankWhenChange(ItemId);

         $('#viewItemDetail'+ItemId).removeClass('showdetail');

         $('#tolranceshow'+ItemId).removeClass('tolrancehide');

         $('#tolranceshow'+ItemId).prop('disabled',true);

         document.getElementById("Item_Name_id"+ItemId).value = msg;
         $('#itemNameTooltip'+ItemId).removeClass('tooltiphide');

         $('#itemNameTooltip'+ItemId).html(msg); 

         $('#qty'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false); 

         $('#vr_date,#Plant_code,#series_code,#account_code,#Quotn_compare_no,#due_days,#tax_code,#party_rf_no,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5,#shipTAddr,#costCent_code').prop('readonly',true);

         $('#party_ref_date').prop('disabled',true);

         var cnclbtn ='<input type="hidden" value="'+0+'" id="tolcvalue"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';


         $('#cancelbtolrntn'+ItemId).html(cnclbtn);


      }

      /* var selected = $('#ItemCodeId'+ItemId).val();
           
            var thisID = $('#ItemCodeId'+ItemId).attr("id");
            
            $(".prefitmSelect option").each(function() {
                 $(this).prop("disabled", false);
            });
            $(".prefitmSelect").each(function() {
              console.log('hi',$('#ItemCodeId'+ItemId).attr("id"));
              console.log('hi 1',thisID);
                if ($('#ItemCodeId'+ItemId).attr("id") != thisID) {

                  
                    $("option[value='" + selected + "']", $('#ItemCodeId'+ItemId)).attr("disabled", true);
                }
            });*/

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:"{{ url('get-item-um-aum') }}",

          method : "POST",

          type: "JSON",

          data: {ItemCode: ItemCode,taxCode:taxCode,accCode:accCode,taxType:taxType},

           success:function(data){

                var data1 = JSON.parse(data);

               // console.log(data1);

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

                    if(data1.data_hsn==''){
                      var hsnCode= '';
                      var shHCode= '';
                      $('#hsn_code'+ItemId).val(hsnCode);
                      $('#showHsnCd'+ItemId).html(shHCode);
                    }else{
                      $('#hsn_code'+ItemId).val(data1.data_hsn.HSN_CODE);
                      $('#showHsnCd'+ItemId).html('HSN No : '+data1.data_hsn.HSN_CODE);

                     

                      /*$('#TolranceIndex'+ItemId).html('TOL. INDEX : '+data1.data_hsn[0].tolerance_basis);
                      $('#tolerence_index'+ItemId).val(data1.data_hsn[0].tolerance_basis);


                      $('#TolranceRate'+ItemId).html('TOL. RATE : '+data1.data_hsn[0].tolerance_qty);

                      $('#tolerence_rate'+ItemId).val(data1.data_hsn[0].tolerance_qty);*/
                    
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

                    //console.log('data1.data_tax',data1.data_tax);

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

                   //CalculateTax(ItemId);

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }/*function close*/

  function taxIntaxrate(trateid){
    setTimeout(function() {
      var taxCodebyitm =  $('#taxByItem'+trateid).val();
      var itmCodeQuoNo =  $('#Item_CodeId'+trateid).val();
      var itmCodeGet =  $('#ItemCodeId'+trateid).val();

      var taxCSelect= $("input[type='radio'][name='taxcodeit']:checked").val();
      //console.log('taxCSelect',taxCSelect);
      if(itmCodeQuoNo){
        var itmCode = itmCodeQuoNo;
      }else if(itmCodeGet){
        var itmCode = itmCodeGet;
      }else{}

      if(taxCSelect){
        var taxCode = taxCSelect;
        $('#taxByItem'+trateid).val(taxCode);
      }else if(taxCodebyitm){
        var taxCode = taxCodebyitm;
      }else{}

      if(itmCode){

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
                        $('#taxByItem'+trateid).val();
                        
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
      
      
     
     }, 500);
  }

  function setFieldBlankWhenChange(ItemId){
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
             $('#pur_qtn_head_id1').val('');
             $('#purqtn_head_id'+ItemId).val('');
             $('#purqtn_body_id'+ItemId).val('');
             $('#tax_code'+ItemId).val('');
             $('#data_count'+ItemId).val('');
             $('#get_grand_num'+ItemId).val('');
             $('#remark_data'+ItemId).val('');
             $('#qty'+ItemId).prop('readonly',true);
             $('#remark_data'+ItemId).prop('readonly',true);
             $('#addmorhidn').prop('disabled',false);
             $('#deletehidn').prop('disabled',true);
             $('#submitdata').prop('disabled',true);
             $('#submitDown').prop('disabled',true);
             $('#appliedbtn'+ItemId).html('');
             $('#footer_tax_btn'+ItemId).html('');
             $('#viewItemDetail'+ItemId).addClass('showdetail');
             $('#itemNameTooltip'+ItemId).addClass('tooltiphide');
             $('#cancelbtolrntn'+ItemId).html('');
             $('#appliedtolrnbtn'+ItemId).html('');

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
      $('#taxratebytax'+canclid).val('');
      $('#pur_qtn_head_id'+canclid).val('');
      $('#pur_qtn_body_id'+canclid).val('');
      $('#rate'+canclid).val('');
      $('#basic'+canclid).val('');
  }

</script>

<script type="text/javascript">

  function submitAllData(valDwn){
     
      var downloadFlg = valDwn;
      $('#donwloadStatus').val(downloadFlg);
      var trcount=$('table tr').length;
      var grandAmt = $('#allgrandAmt').val();

      var valuetax= [];
      var valueitm= [];

      for(var y=0;y<trcount;y++){
        var trid = y+1;
        var ifnotaply = $('#aplytaxOrNot'+trid).html();
        valuetax.push(ifnotaply);

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
          
      }else{

        var data = $("#salesordertrans").serialize();

        $('.overlay-spinner').removeClass('hideloader');

        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/Transaction/Purchase/save-contract-transaction') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {
                var responseVar = false;
                var url = "{{url('/Transaction/Purchase/purchase-contract-save-msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }else{
                var responseVar = true;
                if(downloadFlg == 1){
                  var fyYear = data1.data[0].FY_CODE;
                  var fyCd = fyYear.split('-');
                  var seriesCd = data1.data[0].SERIES_CODE;
                  var vrNo = data1.data[0].VRNO;
                  var fileN = 'PC_'+fyCd[0]+''+seriesCd+''+vrNo;
                  var link = document.createElement('a');
                  link.href = data1.url;
                  link.download = fileN+'.pdf';
                  link.dispatchEvent(new MouseEvent('click'));
                }

                var url = "{{url('Transaction/Purchase/purchase-contract-save-msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });

              }
             
            },

        });

      }

  }

</script>


<script type="text/javascript">
  $(document).ready(function(){
      $(".prefitmSelect").change(function() {
            // Get the selected value
            var selected = $("option:selected", $(this)).val();
            // Get the ID of this element
            console.log('selected',selected);
            var thisID = $(this).attr("id");
            // Reset so all values are showing:
            $(".prefitmSelect option").each(function() {
                $(this).show();
            });
            $(".prefitmSelect").each(function() {
                if ($(this).attr("id") != thisID) {
                    $("option[value='" + selected + "']", $(this)).attr("disabled", true);
                }
            });

        });
  });
</script>


<script type="text/javascript">
  

  function qty_parameter(qty){

    var itemCodebypo = $('#Item_CodeId'+qty).val();
    var itemCodeId = $('#ItemCodeId'+qty).val();
    var ItemCodeOnQp = $("#itmOnQp"+qty).val();

      if(itemCodebypo){
        var itemCode = itemCodebypo;
      }else if(itemCodeId){
        var itemCode =itemCodeId;
      }

    var pquoHeadId = $("#pQtnHeadId"+qty).val();
    var pquobodyId = $("#pQtnBodyId"+qty).val();

    if(ItemCodeOnQp == ''){
      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/get-quality-parameter-for-item-purchase') }}",

            data: {itemCode:itemCode,pquoHeadId:pquoHeadId,pquobodyId:pquobodyId}, // here $(this) refers to the ajax object not form

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


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

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
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.ICATG_CODE+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+IQUACHAR+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+FROM_VALUE+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+TO_VALUE+" ></div></div> ";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });


                          var butn =  $('#footerqp_quality_btn'+qty).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkqpbtn"+qty+"' onclick='getQuaPvalue("+qty+",1)' style='width: 36px;'>Ok</button>";

                           $('#footerqp_quality_btn'+qty).append(tblData);

                             var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'   onclick='getQuaPvalue("+qty+",0)' disabled>Cancel</button>";
                             
                           $('#footerqp_ok_btn'+qty).append(cancelfooter);

                         }else{
                          
                         }

                        }

                    }
           
            
            },

        });
    }else{}

  }  /* ./ quality Paramter*/


</script>

@endsection