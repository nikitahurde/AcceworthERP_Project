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
  .showdetail{
    display: none;
  }
  .itmbyQc{
    display: none;
  }
  .aplynotStatus{
    display: none;
  }
  .notshowcnlbtn{
    display: none;
  }
  table {
    border-collapse: collapse;
  }
  .texIndbox {
    width: 1%;
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

/* --- css for custom table*/
  
    /* DivTable.com */
.divTable{
  display: table;
  width: 100%;
}
.divTableRow {
  display: table-row;
}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
}
.divTableCellHead{
  border: 1px solid #999999;
  display: table-cell;
  padding: 3px 8px;
  text-align: center;
  font-weight: bold;
}
.divTableCell{
  border: 1px solid #999999;
  display: table-cell;
  padding: 3px 8px;
  text-align: center;
}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
  font-weight: bold;
}
.divTableFoot {
  background-color: #EEE;
  display: table-footer-group;
  font-weight: bold;
}
.divTableBody {
  display: table-row-group;
}

/* --- css for custom table*/

</style>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit Job Work Order
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
        <a href="{{ url('/Transaction/Purchase/Job-Work-Order') }}"> Job Work Order</a>
      </li>

    </ul>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Job Work Order</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/Transaction/Purchase/View-Job-Work-Order-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

                                <label>Date: <span class="required-field"></span></label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>


                                    <input type="text" class="form-control transdatepicker rightcontent" name="vr" id="vr_date" value="<?php echo date('d-m-Y', strtotime($getJobWorkOrderSaveData[0]->VRDATE));?>" readonly placeholder="Select Date" autocomplete="off">

                                  </div>

                              </div>
                                  <!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label> T Code : <span class="required-field"></span></label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="tran" value="{{$getJobWorkOrderSaveData[0]->TRAN_CODE}}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                                    <input type="hidden" id="transtaxCode" >

                                  </div>

                                  <small id="tcodeErr" class="form-text text-muted">
                                  </small>

                              </div>
                                  <!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Series Code: 

                                  <span class="required-field"></span>

                                </label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input list="seriesList1"  id="series_code" name="" class="form-control  pull-left" maxlength="6"  value="{{$getJobWorkOrderSaveData[0]->SERIES_CODE}}" readonly placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" >

                                </div>

                                <small id="series_code_errr" style="color: red;"></small>

                              </div>
                              <!-- /.form-group -->
                            </div> <!-- /.col -->

                            <div class="col-md-4">

                              <div class="form-group">

                                <label> Series Name : </label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>


                                    <input type="text" class="form-control" name="tran" value="{{$getJobWorkOrderSaveData[0]->SERIES_NAME}}" id="seriesName" placeholder="Enter Series Name" readonly autocomplete="off">

                                  </div>

                              </div>
                              
                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label> Vr No: </label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                  <input type="hidden" name="" value="" id="vr_last_num">

                                  <input type="text" class="form-control rightcontent" name="vro" value="{{$getJobWorkOrderSaveData[0]->VRNO}}" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                                </div>

                                <small id="vrnoBlnkErr"></small>

                               </div>
                              <!-- /.form-group -->
                            </div>

                          </div><!-- /.row -->

                          <div class="row">
            
                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Plant Code: <span class="required-field"></span></label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>
                                    
                                    <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="6" value="{{$getJobWorkOrderSaveData[0]->PLANT_CODE}}" readonly autocomplete="off">

                                  </div>

                                  <small>  

                                      <div class="pull-left showSeletedName" id="plantText"></div>

                                  </small>

                                  <small id="plant_err" style="color: red;"> </small>
                                  <input type="hidden" id="getStateByPlant" value="{{$getJobWorkOrderSaveData[0]->PLANT_STATE_CODE}}" name="stateByPlant">
                              </div>
                              <!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label> Plant Name : </label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>

                                    <input type="text" class="form-control" name="plantname" value="{{$getJobWorkOrderSaveData[0]->PLANT_NAME}}" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                                  </div>

                              </div>
                              
                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Profit Center Code: <span class="required-field"></span></label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>

                                    <input type="text"  id="profitctrId" name="pfct" class="form-control  pull-left" value="{{$getJobWorkOrderSaveData[0]->PFCT_CODE}}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()"  maxlength="6" readonly autocomplete="off">


                                  </div>

                                <small id="profit_center_err" style="color: red;"> </small>

                              </div>
                              <!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label> Profit Center Name : </label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>

                                    <input type="text" class="form-control" name="pfctname" value="{{$getJobWorkOrderSaveData[0]->PFCT_NAME}}" id="pfctName" placeholder="Enter Profit Center Name" readonly autocomplete="off">

                                  </div>

                              </div>
                            
                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                              <label>Vendor Code : <span class="required-field"></span></label>

                                <div class="input-group">

                                 <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>
                                 
                                  <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="{{$getJobWorkOrderSaveData[0]->ACC_CODE}}" placeholder="Select Vendor" oninput="this.value = this.value.toUpperCase()" onchange="getContraQuo()"  maxlength="6" readonly autocomplete="off"> 

                                </div>

                                <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                                <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                                <small id="acccode_code_errr" style="color: red;"></small>

                              </div>
                                <!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label> Vendor Name : </label>

                                  <div class="input-group tooltips">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>

                                    <input type="text" class="form-control" name="acctname" value="{{$getJobWorkOrderSaveData[0]->ACC_NAME}}" id="accountName" placeholder="Enter Vendor Name" readonly autocomplete="off" >
                                    <span class="tooltiptext tooltiphide" id="accountNameTooltip"></span>

                                  </div>

                              </div>
                            
                            </div><!-- /.col -->

                          </div><!--  /.row -->

                          <div class="row">

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Consignor/Delevory From: <span class="required-field"></span></label>

                                  <div class="input-group">

                                    <span class="input-group-addon" style="padding: 4px 12px;">

                                      <i class="fa fa-newspaper-o " aria-hidden="true"></i>

                                    </span>
                                    
                                    <input list="shipTAdd"  id="shipTAddr" class="form-control  pull-left" value="{{$getJobWorkOrderSaveData[0]->ADD1}}" placeholder="Select Consignor/Delevory From" readonly autocomplete="off"> 

                                  </div>
                                  <small id="err_shiptAdrMsg" style="color: red;" class="form-text text-muted"></small>
                                  <input type="hidden" id="addId" value="{{$getJobWorkOrderSaveData[0]->CPCODE}}">
                                  <input type="hidden" value="{{$getJobWorkOrderSaveData[0]->STATE_CODE}}" id="stateOfAcc">

                              </div>
                                  <!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Cost Center Code: <span class="required-field"></span></label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>

                                    <input list="Costcode_List" class="form-control" id="costCent_code" name="costCent_code" placeholder="Select Cost Center Code" maxlength="55" readonly value="{{$getJobWorkOrderSaveData[0]->COST_CENTER}}"  autocomplete="off">

                                  </div>
                                  <small>  

                                      <div class="pull-left showSeletedName" id="CostcentrText"></div>

                                  </small>

                                  <small id="Costcentr_err" style="color: red;"> </small>

                              </div>
                              <!-- /.form-group -->
                            </div> <!-- /.col -->

                            <div class="col-md-2">

                              <div class="form-group">

                                <label> Cost Center Name : </label>

                                  <div class="input-group tooltips">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>

                                    <input type="text" class="form-control" name="costcname" value="{{$getJobWorkOrderSaveData[0]->COST_CENTER_NAME}}" id="costcenName" placeholder="Enter Cost Center Name" readonly autocomplete="off">

                                  </div>

                              </div>
                              
                            </div>
                      
                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Tax Code: 
                                  <span class="required-field"></span>
                                </label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>
                                    <input list="TaxcodeList"  id="tax_code" name="taxcode" class="form-control  pull-left" value="{{$getJobWorkOrderSaveData[0]->TAX_CODE}}" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off" onchange="getitmByTax();">


                                  </div>

                                  <small id="Taxcode_errr" style="color: red;"></small>
                                  <small id="Taxcodenamesh" style="color:#649fc0;font-weight: 700;"></small>

                              </div>
                                  <!-- /.form-group -->
                            </div>

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Due Days: 
                                  <span class="required-field"></span>
                                </label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>

                                    <input type="text" id="due_days" name="due_days" class="form-control  pull-left Number" value="{{$getJobWorkOrderSaveData[0]->DUEDAYS}}" readonly placeholder="Enter Due Days" autocomplete="off" style="text-align: end;">

                                  </div>
                                    <small id="dueDays_err" style="color: red;"></small>
                              </div>
                                  <!-- /.form-group -->
                            </div>

                          </div><!-- /.row -->

                          <div class="row">

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Due Date: <span class="required-field"></span></label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                  
                                    <input type="text" class="form-control rightcontent" name="due_date" id="due_date" value="{{$getJobWorkOrderSaveData[0]->DUEDATE}}"  placeholder="Select Due" autocomplete="off" readonly>

                                  </div>
                              </div>
                                  <!-- /.form-group -->
                            </div><!-- /.col -->

                            <div class="col-md-3">
                              <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 5px;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                            </div>

                          </div> <!-- row -->

                        </div> <!-- /.tab first -->

                        <div class="tab-pane fade" id="tab2info">

                          <div class="row">

                            <div class="col-md-4">

                              <div class="form-group">

                                <label>Party Ref No :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" value="{{$getJobWorkOrderSaveData[0]->PREFNO}}" name="party_ref" id="party_rf_no" placeholder="Enter Party Ref No" maxlength="30" autocomplete="off">

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

                                  <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="<?php echo date('d-m-Y', strtotime($getJobWorkOrderSaveData[0]->PREFDATE));?>"  placeholder="Select Party Ref Date" autocomplete="off">

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

                          </div><!-- /.row -->

                        </div><!-- /.tab 2 -->

                      </div><!-- /.tab-content -->

                    </div><!-- /. panel-body -->

                  </div><!-- /.panel-info -->

                </div><!-- /col -->

              </div><!-- row -->
                        
          </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->

<!-- section for first table -->
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
                  <th>Item Code </th>
                  <th>Item Name</th>
                  <th>Qty Recd</th>
                  <th>A-Qty Recd</th>
                  <th>Rate</th>
                  <th>Basic</th>
                  <th>Tax</th>
                  <th>Quality Paramter</th>

                </tr>

                <?php $slno =1; foreach($getJobWorkOrderSaveData as $row){ ?>


                  <tr class="useful">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="cBocID{{$slno}}" onclick="checkcheckbox(<?php echo $slno;?>);" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">{{$slno}}.</span>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group">

                        <input list="ItemList{{$slno}}" class="inputboxclr" style="width: 90px;margin-bottom: 4px;margin-top: 13px;" id='ItemCodeId{{$slno}}' name="item_codech[]" value="{{$row->ITEM_CODE}}"  onchange="ItemCodeGet({{$slno}});taxIntaxrate({{$slno}});"  oninput="this.value = this.value.toUpperCase()"/>

                          <datalist id="ItemList{{$slno}}">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($help_item_list as $key)

                              <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                              @endforeach
                          </datalist>
                      </div>
                      <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail{{$slno}}" onclick="showItemDetail({{$slno}})"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                      <div class="divhsn" id="showHsnCd{{$slno}}">HSN No : {{$row->HSN_CODE}}</div>
                      <input type="hidden" id="hsn_code{{$slno}}" name="hsn_code[]" value="{{$row->HSN_CODE}}">
                      <input type="hidden" id="taxByItem{{$slno}}" name="tax_byitem[]" value="{{$row->TAX_CODE}}">
                      <input type="hidden" id="taxratebytax{{$slno}}" value="{{$row->TAX_CODE}}">

                    </td>

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id{{$slno}}' name="item_name[]" value="{{$row->ITEM_NAME}}" readonly />
                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip{{$slno}}"></small>

                      <textarea id="remark_data{{$slno}}" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description">{{$row->PARTICULAR}}</textarea>

                    </td>

                    <td class="tdthtablebordr">
                      
                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='qty{{$slno}}' name="qty[]" oninput="CalAQty({{$slno}})" value="{{$row->QTYRECD}}" style="width: 80px" />

                      <input type="text" name="unit_M[]" value="{{$row->UM}}" id="UnitM{{$slno}}" class="inputboxclr SetInCenter AddM" readonly>

                      <input type="hidden" id="Cfactor{{$slno}}">
                      </div>

                      <div style="display: inline-flex;border: none;margin-top: 3%;">
                            <button type="button" class="btn btn-primary btn-xs tolrancehide" id="tolranceshow{{$slno}}" data-toggle="modal" data-target="#view_tolrance{{$slno}}" onclick="tolranceDetail({{$slno}})" style="padding: 0px 3px 0px 3px;margin-bottom: 3px;font-size: 11px;">Tolerance</button>
                        
                      </div>

                      <div id="appliedtolrnbtn{{$slno}}" style="margin-top: -2%;"></div>
                      <div id="cancelbtolrntn{{$slno}}" style="margin-top: -2%;"></div>
                      <input type="hidden" name="tolerence_index[]" id="settolrnceIndex{{$slno}}">
                      <input type="hidden" name="tolerence_rate[]" id="setTolrnceRate{{$slno}}">
                      
                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty{{$slno}}' name="Aqty[]"  style="width: 80px" value="{{$row->AQTYRECD}}" readonly />

                      <input list="aumList{{$slno}}" name="add_unit_M[]" id="AddUnitM1" value="{{$row->AUM}}" class="inputboxclr SetInCenter AddMList" onchange="changeAum({{$slno}})">

                      <datalist id="aumList{{$slno}}">
                          <option value="">--select--</option>
                      </datalist>

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <input type='text' class="debitcreditbox inputboxclr cr_amount SetInCenter" oninput="calculateBasicAmt({{$slno}})" id='rate{{$slno}}' name="rate[]" value="{{$row->CRAMT}}" style="width: 80px"/>

                    </td>

                    <td class="tdthtablebordr">

                      <input type="text" name="basic_amt[]" id="basic{{$slno}}" value="{{$row->BASICAMT}}" class="form-control basicamt debitcreditbox money" style="width: 110px;margin-top: 14%;height: 22px;">

                    </td>

                    <td>

                      <input type="hidden" id="data_count{{$slno}}" class="dataCountCl" value="" name="data_Count[]">

                      <input type="hidden" class="setGrandAmnt" id="get_grand_num{{$slno}}" name="amtByItem[]">
                      <div style="margin-top: 23%;">
                        <small id="taxnotfound{{$slno}}" class="label label-danger"></small>
                      </div>

                      <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax{{$slno}}" data-toggle="modal" data-target="#tds_rate_model{{$slno}}" onclick="CalculateTax({{$slno}}); getGrandTotal({{$slno}});" disabled="">Calc Tax </button>

                      <small id="appliedbtn{{$slno}}"></small>
                      <small id="cancelbtn{{$slno}}"></small>
                      <div id="aplytaxOrNot{{$slno}}" class="aplynotStatus">0</div>

                    </td>

                    <td>
                        
                      <div style="margin-top: 12%;">
                        <small id="qpnotfound{{$slno}}" class="label label-danger"></small>
                      </div>
                      <input type="hidden" id='quaP_count{{$slno}}' value="0" name="quaP_count[]" class="quaPcountrow">
                      <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="qua_paramter{{$slno}}" data-toggle="modal" data-target="#quality_parametr{{$slno}}" onclick="qty_parameter({{$slno}})" disabled="" style="padding-bottom: 0px;padding-top: 0px;">Quality Parametr </button>

                      <div id="cancelQpbtn{{$slno}}"></div>
                      <div id="appliedQpbtn{{$slno}}"></div>
                      
                      <div id="qpApplyOrNot{{$slno}}" class="aplynotStatus">0</div>
                      <small id="qPnotfountbtn{{$slno}}" class="label label-danger"></small>

                    </td>

                  </tr>

                <?php $slno++;} ?>

                </table>

              </div><!-- /div -->

              <div class="row">

                <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                <input type="hidden" id="allgetMCount" name="getdatacount">
                <input type="hidden" id="checkitm">
                <input type="hidden" id="itmaftercheck">

                <div class="col-sm-12" style="display: flex;">

                  <div style="width:50%;">

                    <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                    <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

                  </div>

                  <div style="width:21%;"></div>
                  <div style="width:10%;"><div class="totlLable">Basic Total :</div></div>
                  <div style="width:10%;">
                    
                    <input class="inputboxclr" type="text" name="TotalBasciAmt" id="basicTotal" readonly="" style="margin-top: 3px;">  

                  </div>

                </div><!-- /.col -->
                
              </div><!-- /.row -->

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
        
          </div><!-- /.box-body -->

        </div><!-- /.custom-box -->

      </div><!-- /.col -->

    </div><!-- /.row -->

</section><!-- /.section -->

<!-------- model tax rate ------>

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
              <span  id="footer_tax_btn1" style="width: 10px;"></span>
             </center>

            
            </div>

          </div>

        </div>

      </div>
      <!-- model -->

      <div id="domModel_2">
         
      </div>
<!-------- model tax rate ------>

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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancleblnkItm(1);">Cancel</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
<!-- when hsn code same then show model -->

 <!------- payment turms model ------->
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
<!------- payment turms model --------->

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
<!-- show modal when click on view btn after item select item -->

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
                    <button type="button" class="btn btn-primary" data-dismiss="modal" >Ok</button>
                    
                </div>
            </div>
        </div>
      </div>

<!-- when tax not applied then show model -->

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

                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="taxIntaxrate(1);" id="taxslOkBtn1" style="width: 83px;">Ok</button>   

                </div>



            </div>

        </div>

      </div>

<!-- show modal when itemselect but tax not -->

 <!-- tolrance model  -->
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

                    <input list="TolrnceIndex1" name="tolrance_index[]" id="tolrance_index1" value="">

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
                    <input type="text" id="tolrance_rate1" name="tolrance_rate[]" value="" oninput="ratepercent(1)">

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
        <!-- tolrance model  -->


<!-- section for first table -->

<section class="content" style="margin-top: -10%;">

  <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <div class="divTable">

              <div class="divTableBody">

                <div class="divTableRow trrowget">
                  
                  <div class="divTableCellHead"></div>
                  <div class="divTableCellHead">Sr.No</div>
                  <div class="divTableCellHead">Item Code</div>
                  <div class="divTableCellHead">Item Name</div>
                  <div class="divTableCellHead">Qty Issued</div>
                  <div class="divTableCellHead">A-Qty Issued</div>
                  
                </div>

                <div class="divTableRow rowcount TextBoxesGroup_1 trrowget">

                  <div class="divTableCell">
                      <div class='TextBoxesGroup'>
                        <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                          <input type="checkbox" class="casecheck" id="tablesecnd1">
                        </div>
                      </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                        <span id="snumtwo1">1.</span>
                      </div>
                    </div>
                  </div>

                  <div class="divTableCell">

                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv1" style="padding-top: 10px;">

                        <div class="input-group">

                            <input list="Item_ISSUEList1" class="inputboxclr" style="width: 90px;margin-bottom: 4px;margin-top: 13px;" id='ItemCodeIsu1' name="item_codeIsu[]"  onchange="ItemCodeGetIsue(1);"  oninput="this.value = this.value.toUpperCase()"/>

                            <datalist id="Item_ISSUEList1">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($help_item_list as $key)

                                <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                                @endforeach
                            </datalist>
                        </div>
                 
                      </div>
                    </div>

                  </div>

                  <div class="divTableCell">

                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv1" style="padding-bottom: 10px;" class="tooltips">
                        <input type='textbox' id='item_name_isu1' value="" name="item_name_isu[]" readonly>
                        <small class="tooltiptext tooltiphide" id="accountNameTooltip1"></small>
                      </div>
                    </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                        <div style="display: inline-flex;border: none;margin-top: -3%;">

                          <input type='text' class="debitcreditbox inputboxclr SetInCenter"  id='qty_isu1' name="qty_isu[]" oninput="CalAQtyIsu(1)" style="width: 80px" />

                          <input type="text" name="unit_IsueM[]" id="unit_IsueM1" class="inputboxclr SetInCenter AddM" readonly>

                          <input type="hidden" id="Cfactor_isu1">

                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                        <div style="display: inline-flex;border: none;margin-top: -3%;">

                          <input type='text' class="debitcreditbox inputboxclr SetInCenter"  id='A_qtyIsu1' name="A_qtyIsu[]"  style="width: 80px" readonly />

                          <input list="aumListIsu1" name="add_unit_MIsu[]" id="AddUnitMIsu1" class="inputboxclr SetInCenter AddMList" onchange="changeAum(1)">

                          <datalist id="aumListIsu1">
                              <option value="">--select--</option>
                          </datalist>

                        </div>
                      </div>
                    </div>
                  </div>

                </div> <!--  /. divTableRow -->

              </div> <!-- /. divTableBody -->

            </div> <!--  /.divTable -->

            <div class="col-md-12"></div><br>

            <div class="row">
              <div class="col-md-12">

                <!-- <input type='button' value='Delete' id='removeButton' class="btn btn-danger btn-sm removeBtntbl"> -->
                <!-- <input type='button' value='Add More' id='addButton' class="btn btn-primary btn-sm"> -->

                <button type="button" class='btn btn-danger btn-sm removeBtntbl' id="removeButton"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                <button type="button" class='btn btn-primary btn-sm' id="addButton"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;" ></i>&nbsp; Add More</button>
    
              </div>

            </div>
            <br>
            <p class="text-center">

              <input type="hidden" id="donwloadStatus" name="donwloadStatus" value="">

              <button class="btn btn-success" type="button" id="submitdata" onclick="submitAllData(0);" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

              <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

              <button class="btn btn-success" type="button" id="submitDwn" onclick="submitAllData(1);"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>

            </p>
          </div> <!-- /.box-body -->
        </div> <!-- /.Custom-Box -->

      </div> <!--  /.col-sm-12 -->

  </div>  <!-- /.row -->

</section> <!--  /.section -->

 </form>

</div>

@include('admin.include.footer')
<!-- <script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script>
<script src="{{ URL::asset('public/dist/js/viewjs/commonJsFun.js') }}" ></script>

<script src="
https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script> -->
  

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

      var tax_code   = $('#taxByItem'+taxid).val();
      var purQtnHeadId  = $('#slQuoHead'+taxid).val();
      var PurQtnBodyId  = $('#slQuoBody'+taxid).val();
      var headConId  = $('#slContraHead'+taxid).val();
      var bodyConId  = $('#slContraBody'+taxid).val();
      var ItemCodebyQC = $('#Item_CodeId'+taxid).val();
      var ItemCodeId = $('#ItemCodeId'+taxid).val();

      if(ItemCodebyQC){
        var ItemCode = ItemCodebyQC;
      }else if(ItemCodeId){
        var ItemCode =ItemCodeId;
      }

      $.ajax({

              url:"{{ url('get-a-field-calc-by-itm-tax-code') }}",

              method : "POST",

              type: "JSON",

              data: {tax_code:tax_code,purQtnHeadId:purQtnHeadId,PurQtnBodyId:PurQtnBodyId,headConId:headConId,bodyConId:bodyConId,ItemCode:ItemCode},

              beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },

              success:function(data){

                //console.log('data',data);
                  //console.log(data);
                  var data1 = JSON.parse(data);
                   //console.log('Get Data => ',data1);
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

                            if ((getData.RATE_INDEX == null && getData.TAX_RATE == null) || (getData.RATE_INDEX == '-' && getData.TAX_RATE == '0.00')) {

                             $('#tax_code'+taxid).val(getData.TAX_CODE);
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly> <input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"> </div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''></div></div>";



                            }else{

                                if(getData.TAXIND_NAME == 'GrandTotal'){
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

                                //console.log('rate',javascript_array);
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></div><div class='box10 rateIndbox'> <input type='text' class='form-control' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+");'> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a> </div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control' oninput='getGrandTotal("+taxid+");' ></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+taxAmt+"' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticIND+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'></div></div> <div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+");'>Apply</button></div></div></div></div>";

                              

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

                          

                          


                         var butn =  $('#footer_tax_btn'+taxid).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = "<button type='button' class='btn btn-primary' data-dismiss='modal' id='ApplyOktaxbtn"+taxid+"' onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",1);' style='width: 36px;'>Ok</button>";

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
  var qurow =1;

  $(".addmore").on('click',function(){

      count=$('table tr').length;

      var notck = i - 1;

      var ifnotaply = $('#aplytaxOrNot'+notck).html();

      if(ifnotaply == 0){
         $("#taxNotAppied").modal('show');
         $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');
      }else{

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case' id='cBocID"+i+"' onclick='checkcheckbox("+i+");'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> <input  type='hidden' name='tds_rate[]' id='TdsRateByAccCode"+i+"' class='getRateForAcc'><input type='hidden' name='tds_code[]' id='TdsSection"+i+"'><input type='hidden' name='' id='accNtdsrate"+i+"'></td>";

      data +="<td class='tdthtablebordr'><div class='input-group'><input list='ItemList"+i+"' class='inputboxclr' style='width: 90px;margin-bottom: 4px;margin-top: 13px;' id='ItemCodeId"+i+"' name='item_codech[]'  onchange='ItemCodeGet("+i+");taxIntaxrate("+i+");'  oninput='this.value = this.value.toUpperCase()' /><datalist id='ItemList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($help_item_list as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option>@endforeach</datalist></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><input type='hidden' id='selectItem"+i+"'><input type='hidden' id='idsun"+i+"'><div class='divhsn' id='showHsnCd"+i+"'></div><input type='hidden' id='hsn_code"+i+"' name='hsn_code[]'><input type='hidden' id='taxByItem"+i+"' name='tax_byitem[]'><input type='hidden' id='taxratebytax"+i+"' value=''><input type='hidden' id='itmGetCode"+i+"' name='item_code[]'><input type='hidden' id='slContraHead"+i+"' value='' name='contheadId[]'><input type='hidden' id='slContraBody"+i+"' value='' name='contbodyid[]'><input type='hidden' id='slQuoHead"+i+"' value='' name='quoHeadId[]'><input type='hidden' id='slQuoBody"+i+"' value='' name='quoBodyId[]'><input type='hidden' id='slQuoCompHead"+i+"' value='' name='QCHeadId[]'><input type='hidden' id='slQuoCompBody"+i+"' value='' name='QCBodyId[]'><input type='hidden' id='getlevel"+i+"' name='levelI[]'></td><td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly /><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></small><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description'></textarea></td> <td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='qty"+i+"' name='qty[]'  oninput='CalAQty("+i+")' style='width: 80px' /><input type='text' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' id='Cfactor"+i+"'><input type='hidden' id='balQtyByItem"+i+"'></div><div style='display: inline-flex;border: none;margin-top: 3%;'><button type='button' class='btn btn-primary btn-xs tolrancehide' id='tolranceshow"+i+"' data-toggle='modal' data-target='#view_tolrance"+i+"' onclick='tolranceDetail("+i+")' style='padding: 0px 3px 0px 3px;margin-bottom: 3px;font-size: 11px;'>Tolerance</button></div><div id='appliedtolrnbtn"+i+"'></div><div id='cancelbtolrntn"+i+"'></div> <input type='hidden' name='tolerence_index[]' id='settolrnceIndex"+i+"'><input type='hidden' name='tolerence_rate[]' id='setTolrnceRate"+i+"'></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input list='aumList"+i+"' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddMList' onchange='changeAum("+i+")'><datalist id='aumList"+i+"'><option value=''>--select--</option></datalist></div></td> <td class='tdthtablebordr'><input type='text' class='debitcreditbox inputboxclr cr_amount SetInCenter'  oninput='calculateBasicAmt("+i+")' id='rate"+i+"' name='rate[]'  style='width: 80px'/><input type='hidden' id='qnrate"+i+"'></td> <td class='tdthtablebordr'><input type='text' name='basic_amt[]' readonly id='basic"+i+"' class='form-control basicamt debitcreditbox' style='width: 110px;margin-top: 14%;height: 22px;' ></td> <td> <input type='hidden' id='data_count"+i+"' value='' class='dataCountCl' name='data_Count[]'><input type='hidden' class='setGrandAmnt'  name='amtByItem[]' id='get_grand_num"+i+"'><div style='margin-top: 23%;'><small id='taxnotfound"+i+"' class='label label-danger'></small></div><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='CalcTax"+i+"' data-toggle='modal' data-target='#tds_rate_model"+i+"' onclick='CalculateTax("+i+"); getGrandTotal("+i+");'>Calc Tax</button><div id='appliedbtn"+i+"'></div><div id='cancelbtn"+i+"'></div><div id='aplytaxOrNot"+i+"' class='aplynotStatus'>0</div> <div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div> </div></div><div class='modal-body table-responsive'><div class='boxer' id=''> <div class='box-row'><div class='box10 texIndbox1'>Item Name/Item Code</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading'><small id='itemNameshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='taxcodeshow"+i+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemDetailshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemtypeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemgroupshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemclassshow"+i+"'> </small> </div> <div class='box10 itmdetlheading'><small id='itemcategoryshow"+i+"'> </small></div> </div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div><div id='allItemShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-lg' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <div class='row'> <div class='col-md-12' style='text-align: center;'> <h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Details</h5></div> </div></div><div class='modal-body table-responsive'> <div class='boxer' id='itemListShow_"+i+"'> </div> </div>  <div class='modal-footer' style='text-align: center;' id='footer_item_"+i+"'> </div> </div></div></div> <div class='modal fade' id='view_tolrance"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-sm' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tolrance</h5></div></div></div><div class='modal-body'><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Index :</label></div><div class='col-md-4'><input list='TolrnceIndex"+i+"' name='tolrance_index[]' id='tolrance_index"+i+"' value=''><datalist id='TolrnceIndex"+i+"'><option value=''>--Select--</option><option value='P' data-xyz='Percentage'>P - [Percentage]</option><option value='L' data-xyz='Lumsum'>L - [Lumsum]</option></datalist></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Rate :</label></div><div class='col-md-4'><input type='text' id='tolrance_rate"+i+"' name='tolrance_rate[]' value='' oninput='ratepercent("+i+")'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Value:</label></div><div class='col-md-4'><input type='text' id='tolrance_rate_percent"+i+"'  value='' readonly=''></div><div class='col-md-2'></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;' onclick='getTolerance("+i+")'>Ok</button><button type='button' class='btn btn-warning' style='width: 20%;' data-dismiss='modal'>Cancle</button></div></div></div></div></td><td><div style='margin-top: 12%;'>  <small id='qpnotfound"+i+"' class='label label-danger'></small> </div> <input type='hidden' id='quaP_count"+i+"' value='0' name='quaP_count[]' class='quaPcountrow'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='qua_paramter"+i+"' data-toggle='modal' data-target='#quality_parametr"+i+"' onclick='qty_parameter("+i+")' disabled='' style='padding-bottom: 0px;padding-top: 0px;'>Quality Parametr </button> <div id='cancelQpbtn"+i+"'></div><div id='appliedQpbtn"+i+"'></div><div id='qpApplyOrNot"+i+"' class='aplynotStatus'>0</div> <small id='qPnotfountbtn"+i+"' class='label label-danger'></small><div id='grateQtyShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5></div></div></div><div class='modal-body table-responsive'><p>Quantity is grater than balence qunatity</p> </div><div class='modal-footer' style='text-align: center;' id='greatQtyFooter'><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='cancleGreatQty("+i+");'>ok</button></div></div></div></div> <div id='greaterRateShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5></div></div></div><div class='modal-body table-responsive'><p>Rate Should Not Be Greater</p></div><div class='modal-footer' style='text-align: center;' id='greatRateFooter"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div><div id='taxSelectModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='font-weight: 800;'>Select Tax Code</h5></div></div></div><div style='text-align: center;'><small id='taxSelErr"+i+"' style='color: red;'></small></div><div class='modal-body table-responsive'><div id='showtaxcodeMul"+i+"' style='line-height: 23px;text-align: initial;'></div></div><div class='modal-footer' style='text-align: center;' id='taxCodeSelect"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='taxIntaxrate("+i+");' style='width: 83px;' id='taxslOkBtn"+i+"'>Ok</button></div></div></div></div></td>";

      $('table').append(data);

      var domModel = "<div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content modalScrlBar' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-5'><div class='form-group'> <lable class='settaxcodemodel col-md-4' style='padding: 0px;'>Tax Code - </lable> <input type='text' class='settaxcodemodel col-md-7' id='tax_code"+i+"' style='border: none; padding: 0px;' readonly> </div> </div><div class='col-md-6'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tax / Charges / etc Calculation</h5></div><div class='col-md-1'></div></div> </div> <div class='modal-body table-responsive'><div class='modalspinner hideloaderOnModl'></div><div class='boxer' id='tax_rate_"+i+"'><div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div> <div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div> </div> </div></div> <div class='modal-footer'><center><small style='width: 86px;'  id='footer_tax_btn"+i+"'></small></center>  </div></div></div> </div> <div id='HsnSameShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title' style='color: red;font-weight: 800;'>Alert !!</h5></div><div class='modal-body'><p>Header Tax Code <small id='headtaxCode"+i+"'></small> Is Different Than Item Wise Tax Code <small id='itmtaxCode"+i+"'></small></p></div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal' onclick='cancleblnkItm("+i+");'>Cancel</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div>";

       $('#domModel_2').append(domModel);

       var quaPModal = "<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><input type='hidden' id='itmOnQp"+i+"'><div class='col-md-12'> <h5 class='modal-title modltitletext' id='exampleModalLabel'>Qaulity Parameter</h5> </div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+i+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footerqp_ok_btn"+i+"'></small><small style='text-align: center;' id='footerqp_quality_btn"+i+"'></small> </center></div></div></div></div>";

       $('#quaPdomModel_2').append(quaPModal);


       $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      var account_code =  $('#account_code').val();
      var tax_code     = $('#tax_code').val();
      var stateCode    =  $('#getStateByPlant').val();
      var taxCode      = $('#tax_code').val();

      $.ajax({

            url:"{{ url('get-item-data-by-tax-code') }}",

            method : "POST",

            type: "JSON",

            data: {taxCode: taxCode,account_code:account_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                   if(data1.data ==''){

                   }else{

                    $("#ItemList"+qurow).empty();
                     // console.log('data1.data',data1.data);
                    $.each(data1.data, function(k, getData){

                        $("#ItemList"+qurow).append($('<option>',{

                          value:getData.ITEM_CODE,

                          'data-xyz':getData.ITEM_NAME,
                          text:getData.ITEM_NAME

                        }));

                    });

                   }
                }
            }

      });
      qurow++;
      i++;
    } /* /.else */
  });  /*--function close--*/

</script>

<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;
        
    $("#addButton").click(function () {
                console.log('hh');
    if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
    }   
        
    var newTextBoxDiv = $(document.createElement('div'))
         .attr("class", 'rowcount' + counter);  

         //onsole.log(counter);
         var count1 = counter-1;

    getcount=$('.divTableBody .trrowget').length;

    var newrow = '<div class="divTableRow rowcount TextBoxesGroup_'+counter+' trrowget"><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'" style="padding-bottom: 10px;"><input type="checkbox" class="casecheck" id="tablesecnd'+counter+'"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'" style="padding-bottom: 10px;"><span id="snumtwo'+counter+'">'+getcount+'</span></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'" style="padding-top: 10px;"><div class="input-group"><input list="Item_ISSUEList'+counter+'" class="inputboxclr" style="width: 90px;margin-bottom: 4px;margin-top: 13px;" id="ItemCodeIsu'+counter+'" name="item_codeIsu[]"  onchange="ItemCodeGetIsue('+counter+');"  oninput="this.value = this.value.toUpperCase()"/><datalist id="Item_ISSUEList'+counter+'"> <option selected="selected" value="">-- Select --</option> @foreach ($help_item_list as $key)<option value="<?php echo $key->ITEM_CODE?>" data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option> @endforeach</datalist></div></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'" style="padding-bottom: 10px;" class="tooltips"><input type="textbox" id="item_name_isu'+counter+'" value="" name="item_name_isu[]" readonly><small class="tooltiptext tooltiphide" id="accountNameTooltip'+counter+'"></small> </div> </div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'" style="padding-bottom: 10px;"><div style="display: inline-flex;border: none;margin-top: -3%;"><input type="text" class="debitcreditbox inputboxclr SetInCenter"  id="qty_isu'+counter+'" name="qty_isu[]" oninput="CalAQtyIsu('+counter+')" style="width: 80px" /><input type="text" name="unit_IsueM[]" id="unit_IsueM'+counter+'" class="inputboxclr SetInCenter AddM" readonly><input type="hidden" id="Cfactor_isu'+counter+'"></div></div></div></div> <div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'" style="padding-bottom: 10px;"><div style="display: inline-flex;border: none;margin-top: -3%;"><input type="text" class="debitcreditbox inputboxclr SetInCenter"  id="A_qtyIsu'+counter+'" name="A_qtyIsu[]"  style="width: 80px" readonly /><input list="aumListIsu'+counter+'" name="add_unit_MIsu[]" id="AddUnitMIsu'+counter+'" class="inputboxclr SetInCenter AddMList" onchange="changeAum('+counter+')"><datalist id="aumListIsu'+counter+'"> <option value="">--select--</option></datalist></div> </div></div></div></div>';

    //newTextBoxDiv.after().html(newrow);
            
    $(".divTableBody").append(newrow);

                
    counter++;
     });



     /*$("#removeButton").click(function () {
    var count2 = counter - 1;
       console.log(count2);

    if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
    counter--;
            
        $(".TextBoxesGroup_"+count2).remove();
            
     });*/
     $(".removeBtntbl").on('click', function() {
        $('.casecheck:checkbox:checked').parents(".trrowget").remove();
        //console.log('yes');

        checksectbl();
     });

     function checksectbl(){

    obj = $('.divTableRow .TextBoxesGroup').find('span'); 

    objfirst = $('table tr').find('span'); 


    if(obj.length==0){
      
      $('#submitdata').prop('disabled',true);
    }else if(objfirst.length == 0){
      $('#submitdata').prop('disabled',true);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;
          $('#'+id).html(key+1);

      });
    } 
      
  }

  });
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
      //console.log(taxCode);

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
             $('#qty'+ItemId).prop('readonly',true);
             $('#data_count'+ItemId).val('');
             $('#get_grand_num'+ItemId).val('');
             $('#remark_data'+ItemId).val('');
             $('#appliedbtn'+ItemId).html('');
             $('#remark_data'+ItemId).prop('readonly',true);
             $('#addmorhidn').prop('disabled',false);
              $('#viewItemDetail'+ItemId).addClass('showdetail');


      }else{

          $('#addmorhidn').prop('disabled',false);

          blankFieldWhenItmChange(ItemId);

        $('#viewItemDetail'+ItemId).removeClass('showdetail');

         document.getElementById("Item_Name_id"+ItemId).value = msg;

        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide');  
         $('#itemNameTooltip'+ItemId).html(msg);

         $('#tolranceshow'+ItemId).removeClass('tolrancehide');

         $('#tolranceshow'+ItemId).prop('disabled',true);

         $('#qty'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false);  

         $('#vr_date,#series_code,#Plant_code,#account_code,#contractNo,#quotationNo,#tax_code,#due_days,#party_rf_no,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

         $('#party_ref_date').prop('disabled',true);

         var cnclbtn ='<input type="hidden" value="'+0+'" id="tolcvalue"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

         $('#cancelbtolrntn'+ItemId).html(cnclbtn);

         var cnclbtntax ='<input type="hidden" value="0" id="qltyvalue'+ItemId+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelbtn'+ItemId).html(cnclbtntax);

        var cnclbtnqp ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelQpbtn'+ItemId).append(cnclbtnqp);

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

                    if(data1.data_hsn==''){
                      var hsnCode= '';
                      var shHCode= '';
                      $('#hsn_code'+ItemId).val(hsnCode);
                      $('#showHsnCd'+ItemId).html(shHCode);
                    }else{
                      $('#hsn_code'+ItemId).val(data1.data_hsn.HSN_CODE);
                      $('#showHsnCd'+ItemId).html('HSN No : '+data1.data_hsn.HSN_CODE);

                      $('#TolranceIndex'+ItemId).html('TOL. INDEX : '+data1.data_hsn.TOLERANCE_BASIS);

                      /* $('#tolerence_index'+ItemId).val(data1.data_hsn[0].tolerance_basis);*/

                      /* $('#tolerence_index'+ItemId).html(' <input type="text"  name="tolerence_index[]"  style="width: 30px" value="'+data1.data_hsn[0].tolerance_basis+'">');*/

                       $('#tolerence_index'+ItemId).html('<select name="tolerence_index[]"  style="width: 40px"><option value="P">P</option><option value="L">L</option></select>');

                      $('#TolranceRate'+ItemId).html('TOL. RATE : '+data1.data_hsn.TOLERANCE_QTY);

                      $('#tolerence_rate'+ItemId).html('<input type="text" name="tolerence_rate[]"  style="width: 60px;height:22px;" value="'+data1.data_hsn.TOLERANCE_QTY+'">');
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


                   

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }/*function close*/


  function taxIntaxrate(trateid){
    setTimeout(function() {

      var itmCodeQuoNo =  $('#Item_CodeId'+trateid).val();
      var itmCodeGet =  $('#ItemCodeId'+trateid).val();
      var taxCodebyitm =  $('#taxByItem'+trateid).val();
      var taxCSelect= $("input[type='radio'][name='taxcodeit']:checked").val();

      if(taxCSelect){
        var taxCode = taxCSelect;
        $('#taxByItem'+trateid).val(taxCode);
      }else if(taxCodebyitm){
        var taxCode = taxCodebyitm;
      }else{}

      if(itmCodeQuoNo){
        var itmCode = itmCodeQuoNo;
      }else if(itmCodeGet){
        var itmCode = itmCodeGet;
      }else{}


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

       
     
     }, 800);
  }

  function blankFieldWhenItmChange(ItemId){
       $('#qty'+ItemId).val('');
       $('#A_qty'+ItemId).val('');
       $('#UnitM'+ItemId).val('');
       $('#AddUnitM'+ItemId).val('');
       $('#rate'+ItemId).val('');
       $('#basic'+ItemId).val('');
       $('#hsn_code'+ItemId).val('');
       $('#tax_code'+ItemId).val('');
       $('#showHsnCd'+ItemId).html('');
       $('input[name="taxcodeit"]').prop('checked', false);
       $('#taxByItem'+ItemId).val('');
       $('#taxratebytax'+ItemId).val('');
       $('#aplytaxOrNot'+ItemId).html('0');
       $('#CalcTax'+ItemId).hide();
       $('#qty'+ItemId).prop('readonly',true);
       $('#data_count'+ItemId).val('');
       $('#get_grand_num'+ItemId).val('');
       $('#remark_data'+ItemId).val('');
       $('#appliedbtn'+ItemId).html('');
       $('#footer_tax_btn'+ItemId).html('');
       $('#remark_data'+ItemId).prop('readonly',true);
       $('#viewItemDetail'+ItemId).addClass('showdetail');

        var amnttotl =0;
           $(".setGrandAmnt").each(function () {
              //add only if the value is number
              if (!isNaN(this.value) && this.value.length != 0) {
                  amnttotl += parseFloat(this.value);
              }

            $("#allgrandAmt").val(amnttotl.toFixed(2));

          }); 

          var dataCl =0;
           $(".dataCountCl").each(function () {
              //add only if the value is number
              if (!isNaN(this.value) && this.value.length != 0) {
                  dataCl += parseFloat(this.value);
              }

            $("#allgetMCount").val(dataCl.toFixed(2));

          });

          var btotal =0;

            $(".basicamt").each(function () {
               
              if (!isNaN(this.value) && this.value.length != 0) {
                  btotal += parseFloat(this.value);
              }

              console.log('btotal ',btotal);

            $("#basicTotal").val(btotal.toFixed(2));

          });


          var basicTotal = parseFloat($('#basicTotal').val());
          var grandTotal = parseFloat($('#allgrandAmt').val());

          if(grandTotal == '0.00'){
            var othrAmt = 0;
            $('#otherTotalAmt').val(othrAmt.toFixed(2));
          }else{
            var otherTotal = grandTotal - basicTotal;
            $('#otherTotalAmt').val(otherTotal.toFixed(2));
          }
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

   function ItemCodeGetIsue(ItemId){

      var ItemCode =  $('#ItemCodeIsu'+ItemId).val();
      
      var xyz = $('#Item_ISSUEList'+ItemId+' option').filter(function() {

          return this.value == ItemCode;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

      }else{

        $('#item_name_isu'+ItemId).val(msg);
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

          data: {ItemCode: ItemCode},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){
                 
                    if(data1.data==''){

                      var umcode = '';

                      var aumcode = '';

                      var cfactor = '';

                      $('#unit_IsueM'+ItemId).val(umcode);

                      $('#AddUnitMIsu'+ItemId).val(aumcode);

                      $('#Cfactor_isu'+ItemId).val(cfactor);

                    }else{

                      $('#unit_IsueM'+ItemId).val(data1.data[0].UM_CODE);

                      $('#AddUnitMIsu'+ItemId).val(data1.data[0].AUM_CODE);

                      $('#Cfactor_isu'+ItemId).val(data1.data[0].AUM_FACTOR);

                    }

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }/*function close*/

  function CalAQtyIsu(quantityId){

    var quantity = parseFloat($('#qty_isu'+quantityId).val());
    var cfactor = $('#Cfactor_isu'+quantityId).val();
    var total = quantity * cfactor;
    $('#A_qtyIsu'+quantityId).val(total.toFixed(3));

  }

</script>



<script type="text/javascript">

  function submitAllData(valD){

      var downloadFlg = valD;
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

              url: "{{ url('/Transaction/Purchase/Save-Job-Work-Order') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {
                  var responseVar = false;
                  var url = "{{url('/Transaction/jobWorkOrder-save-msg')}}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });
                }else{
                  var responseVar = true;
                  if(downloadFlg == 1){
                    var fyYear = data1.data[0].FY_CODE;
                    var fyCd = fyYear.split('-');
                    var seriesCd = data1.data[0].SERIES_CODE;
                    var vrNo = data1.data[0].VRNO;
                    var fileN = 'PO_'+fyCd[0]+''+seriesCd+''+vrNo;
                    var link = document.createElement('a');
                    link.href = data1.url;
                    link.download = fileN+'.pdf';
                    link.dispatchEvent(new MouseEvent('click'));
                  }

                  var url = "{{url('/Transaction/jobWorkOrder-save-msg')}}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });
                }

              },

          });

      }

  }

</script>



<script type="text/javascript">


  function qty_parameter(qty){

   var itemCodebypo = $('#Item_CodeId'+qty).val();
    var itemCodeId = $('#ItemCodeId'+qty).val();

      if(itemCodebypo){
        var itemCode = itemCodebypo;
      }else if(itemCodeId){
        var itemCode =itemCodeId;
      }
   var conHeadId = $("#slContraHead"+qty).val();
   var conBodyId = $("#slContraBody"+qty).val();
   var ItemCodeOnQp = $("#itmOnQp"+qty).val();

    if(ItemCodeOnQp == ''){

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/get-qty-parameter-frm-quo-contra-by-itm') }}",

            data: {itemCode:itemCode,conHeadId:conHeadId,conBodyId:conBodyId}, // here $(this) refers to the ajax object not form

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

  } /* ./ quality Paramter*/


</script>

@endsection