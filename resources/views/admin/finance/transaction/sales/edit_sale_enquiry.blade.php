@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">
  .secondSection{
  	   display: none;
  }
  .showSeletedName{
      font-size: 15px;
      margin-top: 2%;
      text-align: center;
      font-weight: 600;
      color: #4f90b5;
  } 
  .panel.with-nav-tabs .panel-heading{
       padding: 5px 5px 0 5px;
   }
   .panel.with-nav-tabs .nav-tabs{
     border-bottom: none;
   }
   .panel.with-nav-tabs .nav-justified{
     margin-bottom: -1px;
   }
   .with-nav-tabs.panel-info .nav-tabs > li > a,
   .with-nav-tabs.panel-info .nav-tabs > li > a:hover,
   .with-nav-tabs.panel-info .nav-tabs > li > a:focus {
     color: #31708f;
   }
   .with-nav-tabs.panel-info .nav-tabs > .open > a,
   .with-nav-tabs.panel-info .nav-tabs > .open > a:hover,
   .with-nav-tabs.panel-info .nav-tabs > .open > a:focus,
   .with-nav-tabs.panel-info .nav-tabs > li > a:hover,
   .with-nav-tabs.panel-info .nav-tabs > li > a:focus {
     color: #31708f;
     background-color: #bce8f1;
     border-color: transparent;
   }
   .with-nav-tabs.panel-info .nav-tabs > li.active > a,
   .with-nav-tabs.panel-info .nav-tabs > li.active > a:hover,
   .with-nav-tabs.panel-info .nav-tabs > li.active > a:focus {
     color: #31708f;
     background-color: #fff;
     border-color: #bce8f1;
     border-bottom-color: transparent;
   }
   .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu {
       background-color: #d9edf7;
       border-color: #bce8f1;
   }
   .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a {
       color: #31708f;   
   }
   .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
   .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
       background-color: #bce8f1;
   }
   .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a,
   .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
   .with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
       color: #fff;
       background-color: #31708f;
   }
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
        Sales Enquiry Transaction
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
            <a href="{{ url('/Transaction/Sales/Sales-Enquery-Trans') }}"> Sales Enquiry</a>
         </li>

      </ul>

   </section>
   <!-- Content Header (Page header) -->

   <section class="content">
      <div class="row">
         <div class="col-sm-12">
            <div class="box box-primary Custom-Box">

               <div class="box-header with-border" style="text-align: center;">

                  <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Sales Enquiry Transaction</h2>

                  <div class="box-tools pull-right">

                   <a href="{{ url('Transaction/Sales/View-Sales-Enquery-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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
                              </ul> <!-- /.nav tab -->
                           </div> <!-- /.panel heading -->

                           <div class="panel-body">
                              <div class="tab-content">
                                 <div class="tab-pane fade in active" id="tab1info">
                                    <div class="row">
                                       
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

                                                     if($get_Month >=3 && $get_year == $fyYear[1]){
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
                                          </div> <!-- /.form-group -->
                                       </div> <!-- /.col -->

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

                                          </div><!-- /.form-group -->
                                       </div> <!-- /.col -->

                                       <div class="col-md-3">

                                          <div class="form-group">

                                             <label>Series Code: 

                                                <span class="required-field"></span>

                                             </label>

                                             <div class="input-group">

                                                <div class="input-group-addon">

                                                   <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                                </div>
                                                <?php $scount = count($series_list); ?>
                                                <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="<?php if($scount == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" onchange="getvrnoBySeries();" maxlength="6" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

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


                                                <input type="text" class="form-control" name="tran" value="<?php if($scount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" readonly autocomplete="off">

                                              </div>

                                          </div>
                                          
                                       </div>
                                       <!-- /.col -->

                                    </div> <!-- /.row -->

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
                                       </div> <!-- /.col -->

                                       <div class="col-md-3">

                                          <div class="form-group">

                                             <label>Plant Code: <span class="required-field"></span></label>

                                             <div class="input-group">

                                                <div class="input-group-addon">

                                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                                </div>
                                                <?php $plcount = count($plant_list); ?>
                                                <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="6" autocomplete="off" onchange="getpfctData();" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE; }?>" readonly>

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

                                          </div> <!-- /.form-group -->
                                       </div> <!-- /.col -->

                                       <div class="col-md-4">

                                          <div class="form-group">

                                             <label> Plant Name : </label>

                                             <div class="input-group">

                                                <div class="input-group-addon">

                                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                                </div>

                                                <input type="text" class="form-control" name="plantname" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME; }?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                                             </div>

                                          </div> 
                                          
                                       </div> <!-- /.col -->

                                       <div class="col-md-3">

                                          <div class="form-group">

                                             <label>Profit Center Code: <span class="required-field"></span></label>

                                             <div class="input-group">

                                                <div class="input-group-addon">

                                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                                </div>
                                                
                                                <input  id="profitctrId" name="pfct" class="form-control  pull-left" value="" maxlength="6" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

                                             </div>

                                             <small id="profit_center_err" style="color: red;"> </small>

                                          </div>
                                          <!-- /.form-group -->
                                       </div> <!-- /.col -->

                                    </div> <!-- /.row -->

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
                                          
                                       </div> <!-- /.col -->

                                       <div class="col-md-3">

                                          <div class="form-group">

                                             <label>Tax Code: </label>

                                             <div class="input-group">

                                                <div class="input-group-addon">

                                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                                </div>
                                                <?php $taxcount = count($tax_code_list); ?>
                                                <input list="TaxcodeList"  id="tax_code" name="taxcode" class="form-control  pull-left" maxlength="6" value="<?php if($taxcount == 1){echo $tax_code_list[0]->TAX_CODE;}else{echo old('taxcode');} ?>" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

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
                                       </div><!-- /.col -->

                                       <div class="col-md-3">

                                          <div class="form-group">

                                            <label>Customer Code: <span class="required-field"></span></label>

                                             <div class="input-group">

                                                <div class="input-group-addon">

                                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                                </div>
                                                <?php $accCount = count($acc_list); ?>
                                                <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="<?php if($accCount == 1){echo $getacc[0]->ACC_CODE;}else{} ?>" placeholder="Select Customer" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly> 

                                                <datalist id="AccountList">

                                                  <option selected="selected" value="">-- Select --</option>

                                                  @foreach ($acc_list as $key)

                                                  <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                                                  @endforeach

                                                </datalist>

                                             </div>

                                             <small>  
                                                  <div class="pull-left showSeletedName" id="plantText"></div>
                                             </small>

                                             <small id="acc_Code_err" style="color: red;"> </small>

                                          </div>
                                          <!-- /.form-group -->
                                       </div> <!-- /.col -->

                                       <div class="col-md-3">

                                          <div class="form-group">

                                             <label> Customer Name : </label>

                                             <div class="input-group tooltips">

                                               <div class="input-group-addon">

                                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                               </div>


                                               <input type="text" class="form-control" name="acctname" value="<?php if($accCount == 1){echo $acc_list[0]->ACC_NAME;}else{} ?>" id="accountName" placeholder="Enter Customer Name" readonly autocomplete="off" >
                                               <span class="tooltiptext tooltiphide" id="accountNameTooltip"></span>

                                             </div>

                                          </div>
                                       
                                       </div> <!-- /.col -->
                                       
                                    </div> <!-- /.row -->

                                    <div class="row">
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
                                             <small id="due_days_errr" style="color: red;"></small>

                                          </div>
                                              <!-- /.form-group -->
                                       </div>
                                             <!-- /.col -->
                                       <div class="col-md-3">

                                          <div class="form-group">

                                            <label>Due Date: <span class="required-field"></span></label>

                                              <div class="input-group">

                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                              
                                                <input type="text" class="form-control rightcontent" name="due_date" id="due_date"  placeholder="Select Due" autocomplete="off" readonly>

                                              </div>
                                          </div>
                                              <!-- /.form-group -->
                                       </div>  <!-- /.col -->

                                       <div class="col-md-3">
                                          <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 26px;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                                        </div>

                                    </div> <!-- /.row -->

                                 </div> <!-- /.tab 1 info -->

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
                                       </div> <!-- /.col -->

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
                                       </div> <!-- /.col -->
                                       
                                    </div> <!-- /.row -->

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
                                       </div> <!-- /.col -->
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
                                       </div> <!-- /.col -->
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
                                    </div> <!-- /.row -->

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

                                    </div> <!-- /.row -->
                                 </div> <!-- /.tab 2 info -->
                              </div> <!-- /.tab content -->
                           </div> <!-- /.panel body -->

                        </div> <!-- /.panel info -->
                     </div> <!-- /.col -->
                  </div> <!-- /.row -->
               </div> <!-- /.box-body -->

            </div><!-- /.custom-box -->
         </div><!-- /.col -->
      </div><!-- /.row -->
   </section><!-- /.content head section -->

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
                           <th>Action</th>

                        </tr>
                     </table><!-- /.table -->
                  </div><!-- /.table-responsive -->
               </div><!-- /.box body -->
            </div><!-- /.custom box -->
         </div><!-- /.col -->
      </div> <!-- /.row -->
   </section> <!-- /.content body section -->


</div><!-- /.content-wrapper -->

@endsection