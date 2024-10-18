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

table {
   border-collapse: collapse;
}

input:focus{border:1px solid yellow;} 

.showdetail{
  display: none;
}
.showind_Ch{
  display: none;
}
.modalScrlBar{
  border-radius: 5px;
  overflow-y: scroll;
  height: 512px;
}
.numberRightAlign{
  text-align: right;
}
@media screen and (max-width: 600px) {

  .PageTitle{
    float: left;
  }

  .hideinmobile{
    display: none;
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
    <section class="content-header">
      <h1>
        Purchase Quotation Trans
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
          <a href="{{ url('/Transaction/Purchase/Purchase-Quotation-Trans') }}"> Purchase Quotation</a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Purchase Quotation Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Transaction/Purchase/View-Purchase-Quatation-Trans')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

                              <input type="text" class="form-control transdatepicker rightcontent" name="vr" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off" >

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
                            <?php $seriesCount = count($series_list); ?>
                            <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" maxlength="6" value="<?php if($seriesCount == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries()">

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


                              <input type="text" class="form-control" name="tran" value="<?php if($seriesCount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" readonly autocomplete="off">

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
                              <?php $plcount = count($plant_list); ?>

                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="6" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>" autocomplete="off" readonly>

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

                              <input type="text" class="form-control" name="plantname" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME;}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off" >

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

                              <input list="profitList"  id="profitctrId" name="pfct" class="form-control  pull-left" value="{{ old('pfct')}}" maxlength="6" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly>

                              <datalist id="profitList">

                                <option selected="selected" value="">-- Select --</option>

                              </datalist>

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

                              <span class="input-group-addon" style="padding: 4px 12px;">

                                <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>

                                <div class="" id="appndplantbtn"> 
                                </div>

                                 <?php $accCount = count($acc_list); ?>
                                 <input type="hidden" id="getaccCount" value="{{$accCount}}">
                                 <?php if($accCount == 1) { ?>

                                  <button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getaccdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;" id="appndplantbtn1"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>

                                 <?php } else{ ?>
                                  <i class="fa fa-newspaper-o" aria-hidden="true" id="showicon"></i>
                                 <?php } ?>

                              </span>
                              
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="<?php if($accCount == 1){echo $acc_list[0]->ACC_CODE;}else{} ?>" maxlength="6" placeholder="Select Vendor " oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly> 

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
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Vendor Name : </label>

                            <div class="input-group tooltips">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="acctname" value="<?php if($accCount == 1){echo $acc_list[0]->ACC_NAME;}else{} ?>" id="accountName" placeholder="Enter Vendor Name" readonly autocomplete="off">

                              <span class="tooltiptext tooltiphide" id="accountNameTooltip"></span>
                              <?php if($accCount==1){ ?>
                                  <span class="tooltiptext" id="accountNameTooltip">
                                    <?=  $acc_list[0]->ACC_NAME; ?>
                                  </span>
                              <?php } else { ?>

                                <span class="tooltiptext" id="accountNameTooltip" style="display: none;"></span>

                              <?php } ?>


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

                              <input list="Costcode_List" class="form-control" id="costCent_code" name="costCent_code" placeholder="Select Cost Center Code" maxlength="55" value="<?php if($costCd == 1){echo $cost_list[0]->COST_CODE; echo "[ ".$cost_list[0]->COST_NAME." ]";}?>" readonly autocomplete="off">

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

                          <label>Enquiry No :</label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 4px 12px;">

                                <i class="fa fa-newspaper-o " aria-hidden="true"></i>

                              </span>
                              
                              <input list="enquirynoList"  id="enquiryNum" name="enqry" class="form-control  pull-left" value="" placeholder="Select Enquiry No" oninput="this.value = this.value.toUpperCase()"  onchange="getItemByEnquiryNum()" autocomplete="off"> 

                              <datalist id="enquirynoList">

                                <option selected="selected" value="">-- Select --</option>

                              </datalist>

                            </div>
                            <input type="hidden" id="itmCountchk">
                            <small id="enquiryNotFound"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>


                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Tax Code: 
                           
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <?php $taxcount = count($tax_code_list); ?>
                              <input list="TaxcodeList"  id="tax_code" name="taxcode" class="form-control  pull-left" value="<?php if($taxcount == 1){echo $tax_code_list[0]->TAX_CODE;}else{echo old('taxcode');} ?>" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off" onchange="getitmByTax()" maxlength="6">

                              <datalist id="TaxcodeList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($tax_code_list as $key)

                                  <option value='<?php echo $key->TAX_CODE?>'   data-xyz ="<?php echo $key->TAX_NAME; ?>" ><?php echo $key->TAX_NAME ; echo " [".$key->TAX_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small id="Taxcode_errr" style="color: red;"></small>

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

                              <input type="text" id="due_days" name="due_days" class="form-control  pull-left Number" value="{{ old('due_days')}}" placeholder="Enter Due Days" autocomplete="off" style="text-align: end;" readonly>

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

                                <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="{{ $vrDate }}"  placeholder="Select Party Ref Date" autocomplete="off">

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

                                  <input type="text" class="form-control" name="Rfhead_2" placeholder="Enter Rfhead2" maxlength="30" id="rfhead2" oninput="rfheadget(2)" autocomplete="off">

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

                                  <input type="text" class="form-control" name="Rfhead_3" id="rfhead3" placeholder="Enter Rfhead3" maxlength="30" autocomplete="off" oninput="rfheadget(3)">

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
                  <input type ="hidden" name="account_name" value="<?php if($accCount == 1){echo $acc_list[0]->ACC_NAME;}else{} ?>" id="getAcc_Name">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="pfct_name" id="getPfctName">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="plant_name" id="getPlantName" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME;}?>">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
                  <input type ="hidden" name="series_name" value="<?php if($seriesCount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="getSeriesName">
                  <input type ="hidden" name="tax_code" id="getTaxCode">
                  
                  <input type ="hidden" name="party_ref_no" id="getpartyrfNo">
                  <input type ="hidden" name="party_ref_date" id="getpartyrfDate">
                  <input type ="hidden" name="consine_code" id="getcosine">
                  <input type ="hidden" name="rfhead1" id="getrfhead1">
                  <input type ="hidden" name="rfhead2" id="getrfhead2">
                  <input type ="hidden" name="rfhead3" id="getrfhead3">
                  <input type ="hidden" name="rfhead4" id="getrfhead4">
                  <input type ="hidden" name="rfhead5" id="getrfhead5">
                  <input type="hidden" name="getEnquiryNo" id="getEnquiryNo">
                  <input type="hidden" name="getDue_Date" id="gateduedate">
                  <input type="hidden" name="getDue_days" id="gateduedays">
                  <input type ="hidden" name="consneAdd" id="gateconsAdd">
                  <input type ="hidden" name="cp_codeGet" value="" id="getcpCode">
                  <input type ="hidden" name="Cost_Center" id="gateCostCenter">
                  <input type ="hidden" name="CostName" value="<?php if($costCd == 1){echo $cost_list[0]->COST_NAME;}else{} ?>" id="gateCostCenterName">


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
                      <input type='checkbox' class='case'  />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">1.</span>
                    </td> 

                    <td class="tdthtablebordr">


                      <div class="input-group">
                        <input list="ItemList1" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId1' name="item_code[]"  onchange="ItemCodeGet(1); taxIntaxrate(1);" autocomplete="off"  oninput="this.value = this.value.toUpperCase()" readonly />

                          <datalist id="ItemList1">
                            <option selected="selected" value="">-- Select --</option>

                              @foreach ($item_list as $key)

                              <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                              @endforeach
                          </datalist>
                      </div>
                       <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1" onclick="showItemDetail(1)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                      <div class="divhsn" id="showHsnCd1"></div>
                      <input type="hidden" id="hsn_code1" name="hsn_code[]">
                      <input type="hidden" id="taxByItem1" name="tax_byitem[]">
                      <input type="hidden" id="taxratebytax1" value="">
                      <small id="itmNotFound1"></small>

                      <input type="hidden" id="enquiry_date1" name="enquiry_date[]">
                      <input type="hidden" id="enquiry_tran_code1" name="enquiry_tran_code[]">
                      <input type="hidden" id="enquiry_series_code1" name="enquiry_series_code[]">
                      <input type="hidden" id="enquiry_vr_no1" name="enquiry_vr_no[]">
                      <input type="hidden" id="enquiry_sl_no1" name="enquiry_sl_no[]">
                      <input type="hidden" id="enquiry_bodyid1" name="enquiry_bodyid[]">
                      <input type="hidden" id="enquiry_headid1" name="enquiry_headid[]">
                    </td>

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id1' name="item_name[]" autocomplete="off" readonly>

                       <div class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></div>



                      <textarea id="remark_data1" rows="1" style="width: 190px;margin-bottom: 2%;" class="" autocomplete="off" name="remark[]" placeholder="Enter Description" readonly></textarea>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='qty1' name="qty[]" oninput="CalAQty(1)" autocomplete="off" style="width: 80px" readonly />

                      <input type="text" name="unit_M[]" id="UnitM1" autocomplete="off" class="inputboxclr SetInCenter AddM" readonly>

                      <input type="hidden" id="Cfactor1">

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty1' name="Aqty[]"  style="width: 80px" autocomplete="off" readonly />

                      <input list="aumList1" name="add_unit_M[]" autocomplete="off" id="AddUnitM1" class="inputboxclr SetInCenter AddMList" onchange="changeAum(1)">

                      <datalist id="aumList1">
                          <option value="">--select--</option>
                      </datalist>

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <input type='text' class="debitcreditbox inputboxclr cr_amount SetInCenter" oninput="calculateBasicAmt(1)" id='rate1' name="rate[]" autocomplete="off" style="width: 80px" readonly/>

                    </td>

                    <td class="tdthtablebordr">

                       <input type="text" name="basic_amt[]" id="basic1" class="form-control basicamt debitcreditbox" style="width: 110px;margin-top: 14%;height: 22px;" autocomplete="off" readonly>

                    </td>

                    <td>
                        <input type="hidden" id="data_count1" class="dataCountCl" value="0" name="data_Count[]">

                        <input type="hidden" class="setGrandAmnt" id="get_grand_num1" name="crAmtPerItem[]">
                         <div style="margin-top: 23%;">
                         <small id="taxnotfound1" class="label label-danger"></small>
                         </div>
                       <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1); getGrandTotal(1);" disabled="">Calc Tax </button>

                       <div id="aplytaxOrNot1" class="aplynotStatus"></div>
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

                  <div class="col-md-6">
                      

                  </div>

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

                  <div class="col-md-6">

                  </div>

                    <div class="col-md-4 toalvaldesn">

                    <div class="totlsetinres">Grand Total :</div>

                  </div>

                  <div class="col-md-1">

                    <input class="credittotldesn inputboxclr" type="text" name="TotalGrandAmt" id="allgrandAmt" readonly="" style="margin-top: 3px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>

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

        

        <p class="text-center">

          <input type="hidden" id="donwloadStatus" name="donwloadStatus">

          <button class="btn btn-success" type="button" id="submitdata" onclick="sumitAllData(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

          <button class="btn btn-success" type="button" id="submitNDwn" onclick="sumitAllData(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>

        </p>

       <!-- model -->

      <div class="modal fade" id="tds_rate_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content modalScrlBar">

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

            <style>
             
              
              
              
              
              
              
              
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
              <small  id="footer_tax_btn1" style="width: 10px;"></small>
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
                  <p id="whenRowBlnk"></p>
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


                <div style="text-align: center;"><small id="taxSelErr1" style="color: red;"></small></div>

                <div class="modal-body table-responsive">

                    <div id="showtaxcodeMul1" style="line-height: 23px;">
                      
                    </div>

                </div>

                

                <div class="modal-footer" style="text-align: center;" id="taxCodeSelect1">

                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="taxIntaxrate(1);" id="taxslOkBtn1" style="width: 83px;">Ok</button>   

                </div>



            </div>

        </div>

      </div>

     <!-- show modal when itemselect but tax not --> 


    </form>

  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script>
<script src="{{ URL::asset('public/dist/js/viewjs/purchase_quotation.js') }}" ></script>
<script src="{{ URL::asset('public/dist/js/viewjs/commonJsFun.js') }}" ></script>
  
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
     // console.log('taxOnModel',taxOnModel);
      var basicAmt = $('#basic'+taxid).val();

      $('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt);
     // console.log($('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt));



    if(taxOnModel == ''){

      var tax_code = $('#taxByItem'+taxid).val();

      $.ajax({

              url:"{{ url('get-a-field-calc-by-itm-tax-code') }}",

              method : "POST",

              type: "JSON",

              data: {tax_code: tax_code},

              beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },

              success:function(data){
                  //console.log(data);
                  var data1 = JSON.parse(data);
                   //console.log('Get Data => ',data1);
                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      $("#CalcTax1").prop('disabled',false);

                      console.log('data1.data',data1.data);
                        
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

                            if ((getData.RATE_INDEX == null && getData.TAX_RATE == null) || getData.RATE_INDEX == null || getData.TAX_RATE == null) {

                             $('#tax_code'+taxid).val(getData.TAX_CODE);
                             
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly> <input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"> </div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control numberRightAlign' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control numberRightAlign' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''></div></div>";



                            }else{

                                if(getData.TAXIND_NAME == 'GrandTotal'){
                                  var classname = 'grandTotalGet';
                                }else{
                                  var classname = '';
                                }

                                if(getData.TAX_GL_CODE == '' || getData.TAX_GL_CODE == null){
                                  var TAXGLCODE = '';
                                }else{
                                  var TAXGLCODE = getData.TAX_GL_CODE;
                                }

                                if(getData.TAX_LOGIC == '' || getData.TAX_LOGIC == null){
                                  var TAXLOGIC = '';
                                }else{
                                  var TAXLOGIC = getData.TAX_LOGIC;
                                }

                                if(getData.STATIC_IND == '' || getData.STATIC_IND == null){
                                  var staticInd = '';
                                }else{
                                  var staticInd = getData.STATIC_IND;
                                }


                                //console.log('rate',javascript_array);
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></div><div class='box10 rateIndbox'> <input type='text' class='form-control' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+");'> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a> </div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control numberRightAlign' oninput='getGrandTotal("+taxid+");' ></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='numberRightAlign form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticInd+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'></div></div> <div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+");'>Apply</button></div></div></div></div>";

                              

                            }


                            $('#tax_rate_'+taxid).append(TableData);



                            var IndexSelct = getData.rate_index;
                           
                             objcity = data1.data_rate;
                         
                                $.each(objcity, function (i, objcity) {
                                  
                                  var rateSel = '';
                                  if(IndexSelct == objcity.rt_value){

                                    $('#indicator_'+taxid+'_'+counter).append($('<option>',
                                    { 

                                      value: objcity.rt_value,

                                      text : objcity.rt_value+' = '+objcity.rate_name,

                                      selected : true

                                    }));
                                
                                  }else{
                                   
                                     $('#indicator_'+taxid+'_'+counter).append($('<option>',
                                      { 

                                        value: objcity.rt_value,

                                        text : objcity.rt_value+' = '+objcity.rate_name,

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

                            /* var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'  onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",0);'>Cancel</button>";
                             
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

  function getitmByTax(){
    var taxCode = $('#tax_code').val();
    var enquiryNo = $('#enquiryNum').val();
    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $.ajax({

            url:"{{ url('get-item-data-by-tax-code') }}",

            method : "POST",

            type: "JSON",

            data: {taxCode: taxCode,enquiryNo:enquiryNo},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                   if(data1.data ==''){

                   }else{

                      $("#ItemList1").empty()
                    
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

      var Plant_code = $('#Plant_code').val();

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
      setTimeout(function() {
        var account_code  =  $('#account_code').val();
        var transcode     =  $('#transcode').val();
        var transDate     =  $('#vr_date').val();

        var account_count =  $('#getaccCount').val();
        var stateCode     =  $('#getStateByPlant').val();
        console.log('stateCode',stateCode);
        $.ajax({

          url:"{{ url('get-data-by-acc-code-in-trans') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code,transcode:transcode,transDate:transDate,stateCode:stateCode},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  $("#enquirynoList").empty();

                    if(account_count == 0){
                      $('#accNotFound').html('Account Code Not Found').css('color','red');
                    }else{
                      $('#accNotFound').html('');

                      if(data1.data == ''){
                        $('#enquiryNotFound').html('Enquiry Not Found').css('color','red');
                        $('#enquiryNum').prop('readonly',true);
                      }else{
                        $('#enquiryNotFound').html('');
                        $('#enquiryNum').prop('readonly',false);
                        $.each(data1.data, function(k, getData){

                          var yearf = getData.FY_CODE;

                          var startyear = yearf.split('-');

                          $("#enquirynoList").append($('<option>',{

                            value:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,

                            'data-xyz':startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
                            text:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO

                          }));

                        });

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

                    }

              }

          }

        });

      }, 500);

      

      });

  });

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

</script>

<script type="text/javascript">

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

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> <input  type='hidden' name='tds_rate[]' id='TdsRateByAccCode"+i+"' class='getRateForAcc'><input type='hidden' name='tds_code[]' id='TdsSection"+i+"'><input type='hidden' name='' id='accNtdsrate"+i+"'></td>";

      data +="<td class='tdthtablebordr'><div class='input-group'><input list='ItemList"+i+"' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' autocomplete='off' name='item_code[]' onchange='ItemCodeGet("+i+");taxIntaxrate("+i+");' oninput='this.value = this.value.toUpperCase()'/><datalist id='ItemList"+i+"'></datalist></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><input type='hidden' id='hsn_code"+i+"' name='hsn_code[]' value=''><div class='divhsn' id='showHsnCd"+i+"'></div><input type='hidden' id='taxByItem"+i+"' name='tax_byitem[]'><input type='hidden' id='taxratebytax"+i+"' value=''><small id='itmNotFound"+i+"'></small><input type='hidden' id='enquiry_date"+i+"' name='enquiry_date[]'><input type='hidden' id='enquiry_tran_code"+i+"' name='enquiry_tran_code[]'><input type='hidden' id='enquiry_series_code"+i+"' name='enquiry_series_code[]'> <input type='hidden' id='enquiry_vr_no"+i+"' name='enquiry_vr_no[]'><input type='hidden' id='enquiry_sl_no"+i+"' name='enquiry_sl_no[]'><input type='hidden' id='enquiry_bodyid"+i+"' name='enquiry_bodyid[]'> <input type='hidden' id='enquiry_headid"+i+"' name='enquiry_headid[]'></td> <td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' autocomplete='off' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly /><div class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></div><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' autocomplete='off' name='remark[]' placeholder='Enter Description'></textarea></td> <td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='qty"+i+"' name='qty[]' oninput='CalAQty("+i+")' style='width: 80px' /><input type='text' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr SetInCenter AddM' autocomplete='off'><input type='hidden' id='Cfactor"+i+"'></div></td> <td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]' autocomplete='off'  style='width: 80px' readonly /><input list='aumList"+i+"' autocomplete='off' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddMList' onchange='changeAum("+i+")'><datalist id='aumList"+i+"'><option value=''>--select--</option></datalist></div></td> <td class='tdthtablebordr'><input type='text' class='debitcreditbox inputboxclr cr_amount SetInCenter' autocomplete='off' oninput='calculateBasicAmt("+i+")' id='rate"+i+"' name='rate[]'  style='width: 80px'/></td> <td class='tdthtablebordr'><input type='text' name='basic_amt[]' readonly id='basic"+i+"' class='form-control basicamt debitcreditbox' autocomplete='off' style='width: 110px;margin-top: 14%;height: 22px;' ></td> <td> <input type='hidden' id='data_count"+i+"' value='0' class='dataCountCl' name='data_Count[]'><input type='hidden' class='setGrandAmnt' name='crAmtPerItem[]' id='get_grand_num"+i+"'><div style='margin-top: 23%;'><small id='taxnotfound"+i+"' class='label label-danger'></small></div><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='CalcTax"+i+"' data-toggle='modal' data-target='#tds_rate_model"+i+"' onclick='CalculateTax("+i+"); getGrandTotal("+i+");'>Calc Tax</button><div id='appliedbtn"+i+"'></div><div id='cancelbtn"+i+"'></div><div id='aplytaxOrNot"+i+"' class='aplynotStatus'></div> <div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div> </div></div><div class='modal-body table-responsive'><div class='boxer' id=''> <div class='box-row'><div class='box10 texIndbox1'>Item Name</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading1'><small id='itemCodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='taxcodeshow"+i+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemDetailshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemtypeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemgroupshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemclassshow"+i+"'> </small> </div> <div class='box10 itmdetlheading'><small id='itemcategoryshow"+i+"'> </small></div> </div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div></td> <td><div style='margin-top: 12%;'><small id='qpnotfound"+i+"' class='label label-danger'></small></div><input type='hidden' id='quaP_count"+i+"' value='0' name='quaP_count[]' class='quaPcountrow'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='qua_paramter"+i+"' data-toggle='modal' data-target='#quality_parametr"+i+"' onclick='qty_parameter("+i+")' disabled='' style='padding-bottom: 0px;padding-top: 0px;'>Quality Parametr </button> <div id='cancelQpbtn"+i+"'></div><div id='appliedQpbtn"+i+"'></div> <div id='qpApplyOrNot"+i+"' class='aplynotStatus'>0</div> <small id='qPnotfountbtn"+i+"' class='label label-danger'></small><div id='taxSelectModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='font-weight: 800;'>Select Tax Code</h5></div></div></div><div style='text-align: center;'><small id='taxSelErr"+i+"' style='color: red;'></small></div><div class='modal-body table-responsive'><div id='showtaxcodeMul"+i+"' style='line-height: 23px;text-align:initial;'></div></div><div class='modal-footer' style='text-align: center;' id='taxCodeSelect"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='taxIntaxrate("+i+");' style='width: 83px;' id='taxslOkBtn"+i+"'>Ok</button></div></div></div></div> </td>";

      $('table').append(data);

      var domModel = "<div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content modalScrlBar' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-6'><div class='form-group'> <lable class='settaxcodemodel col-md-4' style='padding: 0px;'>Tax Code - </lable> <input type='text' class='settaxcodemodel col-md-7' id='tax_code"+i+"' style='border: none; padding: 0px;' readonly> </div> </div><div class='col-md-6'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tax / Charges / etc Calculation</h5></div></div> </div> <div class='modal-body table-responsive'> <div class='modalspinner hideloaderOnModl'></div><div class='boxer' id='tax_rate_"+i+"'><div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div> <div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div> </div> </div></div> <div class='modal-footer'><center><small style='width: 86px;'  id='footer_tax_btn"+i+"'></small></center>  </div></div></div> </div> <div id='HsnSameShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title' style='color: red;font-weight: 800;'>Alert !!</h5></div><div class='modal-body'><p>Header Tax Code <small id='headtaxCode"+i+"'></small> Is Different Than Item Wise Tax Code <small id='itmtaxCode"+i+"'></small></p></div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal' onclick='cancleblnkItm("+i+");'>Cancel</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div>";

       $('#domModel_2').append(domModel);

       var qpModlDom = "<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><input type='hidden' id='itmOnQp"+i+"'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Qaulity Parameter</h5> </div> </div> </div><div class='modal-body table-responsive'> <div class='boxer' id='qua_par_"+i+"'></div> </div><div class='modal-footer'><center><small style='text-align: center;' id='footerqp_ok_btn"+i+"'></small>&nbsp;<small style='text-align: center;' id='footerqp_quality_btn"+i+"'></small></center> </div></div></div></div>";

       $('#quaPdomModel_2').append(qpModlDom);

       var accnum =  $('#account_code').val();
       var tax_code = $('#tax_code').val();
       var stateCode =  $('#getStateByPlant').val();
       var enqno =  $('#enquiryNum').val();
       var getenqvrno = enqno.split(' ');
       var enquiryno = getenqvrno[2];
       var seriesEnq = getenqvrno[1];

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:"{{ url('get-item-by-condition-in-add-more') }}",

          method : "POST",

          type: "JSON",

          data: {enquiryno: enquiryno,accnum:accnum,tax_code:tax_code,stateCode:stateCode,seriesEnq:seriesEnq},

           success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){
                 
                  if(data1.data==''){

                  }else{

                    console.log('adrow',adrow);

                    $("#ItemList"+adrow).empty();

                    $.each(data1.data, function(k, getData){

                      $("#ItemList"+adrow).append($('<option>',{

                        value:getData.ITEM_CODE,

                        'data-xyz':getData.ITEM_NAME,
                        text:getData.ITEM_NAME


                      }));

                    });
                     
                  }

       
                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

      i++;
      adrow++;
    } /* /.else */

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

       var ItemCode     =  $('#ItemCodeId'+ItemId).val();
       var enq_num      =  $('#enquiryNum').val();
       var getenqvrno   = enq_num.split(' ');
       var enqno        = getenqvrno[2];
       var seriesEnq        = getenqvrno[1];
       var taxCodeget   =  $('#getTaxCode').val();
       var accCode      =  $('#account_code').val();
       var taxCode      =  $('#tax_code').val();
       
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

             blankOnITemChange(ItemId);

      }else{

        blankOnITemChange(ItemId);

        $('#shipTAddr,#vr_date,#series_code,#Plant_code,#profitctrId,#account_code,#enquiryNum,#tax_code,#due_days,#party_rf_no,#costCent_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);
        $('#party_ref_date').prop('disabled',true);

        $('#viewItemDetail'+ItemId).removeClass('showdetail');

         document.getElementById("Item_Name_id"+ItemId).value = msg;

         $("#itemNameTooltip"+ItemId).removeClass('tooltiphide');

        $("#itemNameTooltip"+ItemId).html(msg);
        

         $('#addmorhidn').prop('disabled',false);  
         $('#qty'+ItemId).prop('readonly',false);  
         $('#rate'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false);  

      }

      if(ItemCode){

            $.ajaxSetup({

              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

            $.ajax({

                url:"{{ url('get-item-by-enquiry-um-aum') }}",

                method : "POST",

                type: "JSON",

                data: {ItemCode: ItemCode,taxCode:taxCode,enqno:enqno,accCode:accCode,taxType:taxType,seriesEnq:seriesEnq},

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
                          if(data1.data_enq==''){
                            var enqDate ='';
                            var enqtran ='';
                            var enqseries ='';
                            var enqvr_no ='';
                            var enqsl_no ='';
                            var qty ='';
                            var Aqty ='';
                            var remark = '';


                            $("#enquiry_date"+ItemId).val(enqDate);
                            $("#enquiry_tran_code"+ItemId).val(enqtran);
                            $("#enquiry_series_code"+ItemId).val(enqseries);
                            $("#enquiry_vr_no"+ItemId).val(enqvr_no);
                            $("#enquiry_sl_no"+ItemId).val(enqsl_no);

                            $('#qty'+ItemId).val(qty);
                            $('#A_qty'+ItemId).val(Aqty);
                            $('#remark_data'+ItemId).val(remark);
                          }else{
                            $('#qty'+ItemId).val(data1.data_enq[0].QTYRECD);
                            $('#A_qty'+ItemId).val(data1.data_enq[0].AQTYRECD);
                            $('#remark_data'+ItemId).val(data1.data_enq[0].PARTICULAR);

                            $("#enquiry_date"+ItemId).val(data1.data_enq[0].VRDATE);
                            $("#enquiry_tran_code"+ItemId).val(data1.data_enq[0].TRAN_CODE);
                            $("#enquiry_series_code"+ItemId).val(data1.data_enq[0].SERIES_CODE);
                            $("#enquiry_vr_no"+ItemId).val(data1.data_enq[0].VRNO);
                            $("#enquiry_sl_no"+ItemId).val(data1.data_enq[0].SLNO);

                            $("#enquiry_bodyid"+ItemId).val(data1.data_enq[0].PENQBID);
                            $("#enquiry_headid"+ItemId).val(data1.data_enq[0].PENQHID);
                          }

                          
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

                          console.log('data_tax',data1.data_tax);

                          if(taxCode){

                            if(data1.data_tax == ''){
                                
                                $('#taxByItem'+ItemId).val('');
                                $("#HsnSameShow"+ItemId).modal('show');

                                $('#headtaxCode'+ItemId).html('<b>( '+taxCode+' )</b>');
                                $('#itmtaxCode'+ItemId).html('');
                            }else{

                              var taxByhsn = data1.data_tax[0].TAX_CODE;
                              //console.log('taxByhsn',taxByhsn);
                              $('#taxByItem'+ItemId).val(taxByhsn);
                              if(taxCode != data1.data_tax[0].TAX_CODE){
                                $("#HsnSameShow"+ItemId).modal('show');

                                $('#headtaxCode'+ItemId).html('<b>( '+taxCode+' )</b>');
                                $('#itmtaxCode'+ItemId).html('<b>( '+taxByhsn+' )</b>');
                              }
                              
                              
                            }

                          }else{

                            if(data1.data_tax==''){

                            }else{

                            $('#taxSelectModel'+ItemId).modal('show');
                            $('#showtaxcodeMul'+ItemId).empty();
                            $('#taxslOkBtn'+ItemId).prop('disabled',true);
                            $('#taxSelErr'+ItemId).html('Please Select Tax Code');
                            $.each(data1.data_tax, function(k, gettax){

                              var taxData = '<input type="radio" class="taxcodeset" id="html" name="taxcodeit" value="'+gettax.TAX_CODE+'" onclick="taxSelectn('+ItemId+');"><label for="html">'+gettax.TAX_CODE+' ('+gettax.TAX_NAME+' )</label><br>';
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



    function blankOnITemChange(rowId){

      $('#qty'+rowId).val('');

             $('#A_qty'+rowId).val('');
             $('#UnitM'+rowId).val('');
             $('#AddUnitM'+rowId).val('');
             $('#remark_data'+rowId).val('');
             $('#hsn_code'+rowId).val('');
             $('#showHsnCd'+rowId).html('');
             $('#itmOnQp'+rowId).val('');
             $('input[name="taxcodeit"]').prop('checked', false);
             $('#taxByItem'+rowId).val('');
             $('#taxratebytax'+rowId).val('');
             $('#aplytaxOrNot'+rowId).html('0');
             $('#enquiry_date'+rowId).val('');
             $('#enquiry_tran_code'+rowId).val('');
             $('#enquiry_series_code'+rowId).val('');
             $('#enquiry_vr_no'+rowId).val('');
             $('#enquiry_sl_no'+rowId).val('');
             $('#enquiry_bodyid'+rowId).val('');
             $('#data_count'+rowId).val('');
             $('#get_grand_num'+rowId).val('');
             $('#rate'+rowId).val('');
             $('#basic'+rowId).val('');
             $('#quaP_count'+rowId).val('');
             $('#tax_code'+rowId).val('');
             $('#appliedbtn'+rowId).html('');
             $('#cancelbtn'+rowId).html('');
             $('#cancelQpbtn'+rowId).html('');
             $('#footer_tax_btn'+rowId).html('');
             $('#CalcTax'+rowId).hide();
             $('#qty'+rowId).prop('readonly',true);
             $('#rate'+rowId).prop('readonly',true);
             $('#remark_data'+rowId).prop('readonly',true);
             $('#viewItemDetail'+rowId).addClass('showdetail');
             $("#itemNameTooltip"+rowId).addClass('tooltiphide');
             $('#appliedQpbtn'+rowId).empty();
             var cnclbtn ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

             $('#cancelQpbtn'+rowId).append(cnclbtn);

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

               var dataqp =0;
                 $(".quaPcountrow").each(function () {
                    //add only if the value is number
                    if (!isNaN(this.value) && this.value.length != 0) {
                        dataqp += parseFloat(this.value);
                    }

                  $("#allquaPcount").val(dataqp);

                });

           var basicAmnount = parseFloat($('#basicTotal').val());
           var allGrandAmount = parseFloat($('#allgrandAmt').val());
            
            var otherAmount = allGrandAmount - basicAmnount;
            $('#otherTotalAmt').val(otherAmount);

    }

    function getItemByEnquiryNum(){

      var enquiryNum =  $('#enquiryNum').val();
      var xyz = $('#enquirynoList option').filter(function() {

          return this.value == enquiryNum;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $('#enquiryNum').val('');
         $('#getEnquiryNo').val('');
         $('#itmCountchk').val('');
      }else{
        $('#getEnquiryNo').val(enquiryNum);
      }


      var enqno =  $('#enquiryNum').val();
      var accnum =  $('#account_code').val();

      var getenqvrno = enqno.split(' ');
      var enquiryno = getenqvrno[2];
      var seriesEnq = getenqvrno[1];
      console.log('enqno',enqno);
      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:"{{ url('get-item-by-enquiry-num') }}",

          method : "POST",

          type: "JSON",

          data: {enquiryno: enquiryno,accnum:accnum,seriesEnq:seriesEnq},

           success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){
                 
                  if(data1.data==''){

                  }else{

                    $("#ItemList1").empty();

                    var itmCount = data1.data.length;
                    $('#itmCountchk').val(itmCount);
                    if(itmCount == 1){
                      $('#addmorhidn').prop('disabled',true);
                    }else{
                      $('#addmorhidn').prop('disabled',false);
                    }

                    $.each(data1.data, function(k, getData){

                      $("#ItemList1").append($('<option>',{

                        value:getData.ITEM_CODE,

                        'data-xyz':getData.ITEM_NAME,
                        text:getData.ITEM_NAME


                      }));

                    });
                     
                  }

       
                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }/*function close*/

  function changeAum(aumid){
      var ItemCode =  $('#ItemCodeId'+aumid).val();
      var unitM    =  $('#UnitM'+aumid).val();
      var adunitM  =  $('#AddUnitM'+aumid).val();
      var qty = $('#qty'+aumid).val();


      var xyz = $('#aumList'+aumid+' option').filter(function() {

          return this.value == adunitM;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#AddUnitM'+aumid).val('');
        $('#A_qty'+aumid).val('');
      }else{

      }


      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

            type: 'POST',

            url: "{{ url('get-cfactor-when-change-aum') }}",

            data: {ItemCode:ItemCode,unitM:unitM,adunitM:adunitM}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

              if(data1.data==''){
                   
              }else{  

                   $('#Cfactor'+aumid).val(data1.data[0].AUM_FACTOR);
                  
                   var calAqty = parseFloat(qty) * parseFloat(data1.data[0].AUM_FACTOR);

                   $('#A_qty'+aumid).val(calAqty.toFixed(3));
              }
           
            }

        });
  }

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

$(document).ready(function(){

    $("#account_code").change(function(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var account_code =  $(this).val();

        var transcode =  $('#transcode').val();
        var transDate =  $('#vr_date').val();
          $.ajax({

            url:"{{ url('get-data-by-acc-code-in-trans') }}",

            method : "POST",

            type: "JSON",

            data: {account_code: account_code,transDate:transDate,transcode:transcode},

            success:function(data){

              var data1 = JSON.parse(data);

              $("#appndplantbtn").empty();

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  //console.log(data1.data);
                    $("#enquirynoList").empty();
                    
                         $('#appndplantbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getaccdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');

                    if(data1.data == ''){ 
                      $('#enquiryNotFound').html('Enquiry Not Found').css('color','red');
                      $('#enquiryNum').val('');
                      $('#itmCountchk').val('');
                      $('#getEnquiryNo').val('');
                      $('#enquiryNum').prop('readonly',true);
                    }else{
                      $('#enquiryNotFound').html('');
                      $('#enquiryNum').prop('readonly',false);
                      $.each(data1.data, function(k, getData){

                        var yearf = getData.FY_CODE;

                        var startyear = yearf.split('-');

                        $("#enquirynoList").append($('<option>',{
                          
                          value:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,

                          'data-xyz':startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
                          text:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO


                        }));

                      }); 

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

                    

                }



            }

          });

      });
});

</script>




<script type="text/javascript">


  function sumitAllData(downVal){

      var downloadFlg = downVal;
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
        valueitm.push(itmCde);
       
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
            $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');
            $('#grAmtIsGreatMsg').html('The <b>Grand Amount</b> Should Not Be Negative');
            $('#whenRowBlnk').html('');
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

              url: "{{ url('/Transaction/Purchase/Save-Perchase-Quotation-Trans') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {
                  var responseVar = false;
                  var url = "{{url('/Transaction/Purchase/View-Purchase-Quatation-Trans-Save-Msg')}}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });
                }else{
                  var responseVar = true;

                  if(downloadFlg == 1){
                    var data1 = JSON.parse(data);

                    var fyYear = data1.data[0].FY_CODE;
                    var fyCd = fyYear.split('-');
                    var seriesCd = data1.data[0].SERIES_CODE;
                    var vrNo = data1.data[0].VRNO;
                    var fileN = 'PQT_'+fyCd[0]+''+seriesCd+''+vrNo;
                    var link = document.createElement('a');
                    link.href = data1.url;
                    link.download = fileN+'.pdf';
                    link.dispatchEvent(new MouseEvent('click'));
                  }

                  var url = "{{url('Transaction/Purchase/View-Purchase-Quatation-Trans-Save-Msg')}}";
                  setTimeout(function(){ window.location = url+'/'+responseVar; });
                }

              },

          });

      }

  }

</script>
<script type="text/javascript">

  function qty_parameter(qty){

   var itemCode = $("#ItemCodeId"+qty).val();
   var enqHeadId = $("#enquiry_headid"+qty).val();
   var enqBodyId = $("#enquiry_bodyid"+qty).val();
   var ItemCodeOnQp = $("#itmOnQp"+qty).val();
   //console.log('ItemCode',ItemCode);
   if(ItemCodeOnQp == ''){

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/get-quality-parameter-for-item-purchase') }}",

            data: {itemCode:itemCode,enqHeadId:enqHeadId,enqBodyId:enqBodyId}, // here $(this) refers to the ajax object not form

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

                            $('#itmOnQp'+qty).val(item_code);

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.ICATG_CODE+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+IQUACHAR+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+FROM_VALUE+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+TO_VALUE+" ></div></div> ";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });


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

    }else{}

  }


</script>


@endsection