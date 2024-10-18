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

</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      	<h1>
	        Purchase Order Transaction
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
	          <a href="{{ url('/Transaction/Purchase/Purchase-Order-Trans') }}"> Purchase Order</a>
	        </li>

      	</ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

	        <div class="box box-primary Custom-Box">

	          <div class="box-header with-border" style="text-align: center;">

	            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Purchase Order Transaction</h2>

							<div class="box-tools pull-right">

								<a href="{{ url('/Transaction/Purchase/View-Purchase-Order-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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
		                        </div><!-- /.form-group -->

		                    	</div><!-- /col -->	

		                    	<div class="col-md-2">

		                        <div class="form-group">

		                          <label> T Code : <span class="required-field"></span></label>

		                            <div class="input-group">

		                              <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

		                              <input list="transCList" class="form-control" name="tran" value="<?php if(isset($trans_head)){echo $trans_head;}?>"  id="transcode" placeholder="Enter Transaction Head" autocomplete="off" style="padding-right: 0px;" maxlength="2" readonly>

		                              <input type="hidden" id="transtaxCode" >

		                            </div>

		                            <small id="tcodeErr" class="form-text text-muted">
		                            </small>

		                        </div><!-- /.form-group -->

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
		                            <input list="seriesList1"  id="series_code" name="" class="form-control  pull-left" maxlength="6"  value="" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries()">

		                            <datalist id="seriesList1">

		                              <option selected="selected" value="">-- Select --</option>

		                              @foreach ($series_list as $key)

		                                <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

		                              @endforeach

		                            </datalist>

		                          </div>

		                          <small id="series_code_errr" style="color: red;"></small>

		                        </div><!-- /.form-group -->

		                    	</div><!-- /.col -->

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
		                        
	                      	</div><!-- /.col -->

				        				</div><!-- /.row -->

				        				<div class="row">

				        					<div class="col-md-2">

		                        <div class="form-group">

		                          <label> Vr No: </label>

		                          <div class="input-group">

		                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

		                            <input type="hidden" name="" value="" id="vr_last_num">

		                            <input type="text" class="form-control rightcontent" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

		                          </div>

		                          <small id="vrnoBlnkErr"></small>

	                         	</div><!-- /.form-group -->

	                      	</div><!-- /.col -->

	                      	<div class="col-md-3">

		                        <div class="form-group">

		                          <label>Plant Code: <span class="required-field"></span></label>

		                            <div class="input-group">

		                              <div class="input-group-addon">

		                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

		                              </div>
		                              <?php $plcount = count($getplant); ?>
		                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="6" value="<?php if($plcount == 1){echo $getplant[0]->PLANT_CODE;}else{}?>"  autocomplete="off">

		                              <datalist id="PlantcodeList">

		                                 <option value="">--SELECT--</option>

		                                 @foreach ($getplant as $key)

		                                <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

		                                @endforeach

		                              </datalist>

		                            </div>

		                            <small>  

		                                <div class="pull-left showSeletedName" id="plantText"></div>

		                            </small>

		                            <small id="plant_err" style="color: red;"> </small>
		                            <input type="hidden" id="getStateByPlant" name="stateByPlant">

		                        </div><!-- /.form-group -->

		                      </div><!-- /.col -->

		                      <div class="col-md-4">

		                        <div class="form-group">

		                          <label> Plant Name : </label>

		                            <div class="input-group">

		                              <div class="input-group-addon">

		                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

		                              </div>

		                              <input type="text" class="form-control" name="plantname" value="<?php if($plcount == 1){echo $getplant[0]->PLANT_NAME;}else{}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

		                            </div>

		                        </div>
		                        
		                      </div><!-- /.col -->

		                      <div class="col-md-3">

		                        <div class="form-group">

		                          <label>Profit Center Code: <span class="required-field"></span></label>

		                            <div class="input-group">

		                              <div class="input-group-addon">

		                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

		                              </div>

		                              <input type="text"  id="profitctrId" name="pfct" class="form-control  pull-left" value="{{ old('pfct')}}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()"  maxlength="6" readonly autocomplete="off">


		                            </div>

		                          <small id="profit_center_err" style="color: red;"> </small>

		                        </div><!-- /.form-group -->

		                      </div><!-- /.col -->
				        					
				        				</div><!-- /.row -->

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
	                        
	                        </div><!-- /.col -->

	                        <div class="col-md-3">

	                          <div class="form-group">

	                          	<label>Vendor Code : <span class="required-field"></span></label>

	                            <div class="input-group">

	                             <span class="input-group-addon" style="padding: 4px 12px;">

	                                <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>

	                                <div class="" id="appndplantbtn"> 
	                                </div>

	                                  <?php $accCount = count($getacc); ?>

	                                 <?php if($accCount == 1) { ?>

	                                  <button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getaccdata()" class="btn btn-xs btn-info gly-radius"  data-original-title="" title="" style="padding: 0px 5px 0px 5px;" id="appndplantbtn1"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>

	                                 <?php } else{ ?>
	                                  <i class="fa fa-newspaper-o" aria-hidden="true" id="showicon"></i>
	                                 <?php } ?>

	                              </span>
	                             
	                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="<?php if($accCount == 1){echo $getacc[0]->ACC_CODE;}else{echo old('AccCode');} ?>" placeholder="Select Vendor" oninput="this.value = this.value.toUpperCase()" onchange="getContraQuo()"  maxlength="6"  autocomplete="off"> 

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

	                          </div><!-- /.form-group -->

	                        </div><!-- /.col -->

	                        <div class="col-md-3">

	                          <div class="form-group">

	                            <label> Vendor Name : </label>

	                              <div class="input-group tooltips">

	                                <div class="input-group-addon">

	                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

	                                </div>


	                                <input type="text" class="form-control" name="acctname" value="<?php if($accCount == 1){echo $getacc[0]->ACC_NAME;}else{} ?>" id="accountName" placeholder="Enter Vendor Name" readonly autocomplete="off" >
	                                <span class="tooltiptext tooltiphide" id="accountNameTooltip"></span>

	                              </div>

	                          </div>
	                        
	                        </div><!-- /.col -->

	                        <div class="col-md-3">

		                        <div class="form-group">

		                          <label>Consignor/Delevory From: <span class="required-field"></span></label>

		                            <div class="input-group">

		                              <span class="input-group-addon" style="padding: 4px 12px;">

		                                <i class="fa fa-newspaper-o " aria-hidden="true"></i>

		                              </span>
		                              
		                              <input list="shipTAdd"  id="shipTAddr" class="form-control  pull-left" value="" placeholder="Select Consignor/Delevory From" autocomplete="off"> 

		                              <datalist id="shipTAdd">

		                                <option selected="selected" value="">-- Select --</option>

		                              </datalist>

		                            </div>
		                            <small id="err_shiptAdrMsg" style="color: red;" class="form-text text-muted"></small>
		                            <input type="hidden" id="addId" value="">
		                            <input type="hidden" value="" id="stateOfAcc">

		                        </div><!-- /.form-group -->

		                      </div><!-- /.col -->
				        					
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

		                              <input list="Costcode_List" class="form-control" id="costCent_code" name="costCent_code" placeholder="Select Cost Center Code" maxlength="55" value="<?php if($costCd == 1){echo $cost_list[0]->COST_CODE; echo "[ ".$cost_list[0]->COST_NAME." ]";}?>"  autocomplete="off">

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

		                              <input type="text" class="form-control" name="costcname" value="<?php if($costCd == 1){echo $cost_list[0]->COST_NAME;}else{} ?>" id="costcenName" placeholder="Enter Cost Center Name" readonly autocomplete="off">

		                            </div>

		                        </div>
		                        
		                      </div><!-- /.col -->

		                      <div class="col-md-3">

	                          <div class="form-group">

	                          	<label>Contract No. : </label>

	                            <div class="input-group">

	                              <div class="input-group-addon">

	                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

	                              </div>
	                              
	                              <input list="contractNoList"  id="contractNo" name="contractNo" class="form-control  pull-left" value="" placeholder="Select Contract No" oninput="this.value = this.value.toUpperCase()" onchange="getItmByQtnNContra()" autocomplete="off"> 

	                              <datalist id="contractNoList">

	                              </datalist>

	                            </div>
	                            <small id="contraNotFound"></small>
	                            <input type="hidden" id="itmCountchk">

	                          </div><!-- /.form-group -->

	                        </div><!-- /.col -->

	                        <div class="col-md-3">

	                          <div class="form-group">

	                            <label>Quotation No. : </label>

	                            <div class="input-group">

	                              <div class="input-group-addon">

	                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

	                              </div>
	                              
	                              <input list="quotationNoList"  id="quotationNo" name="quotationNo" class="form-control  pull-left" value="" placeholder="Select Quotation No" oninput="this.value = this.value.toUpperCase()" onchange="getItmByQtnNContra()" autocomplete="off"> 

	                              <datalist id="quotationNoList">

	                              </datalist>

	                            </div>
	                            <small id="qcNotFound"></small>

	                          </div><!-- /.form-group -->

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
	                                <?php $taxcount = count($tax_code_list); ?>
	                                <input list="TaxcodeList"  id="tax_code" name="taxcode" class="form-control  pull-left" value="<?php if($taxcount == 1){echo $tax_code_list[0]->TAX_CODE;}else{echo old('taxcode');} ?>" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off" onchange="getitmByTax();">

	                                <datalist id="TaxcodeList">

	                                  <option selected="selected" value="">-- Select --</option>

	                                  @foreach ($tax_code_list as $key)

	                                    <option value='<?php echo $key->TAX_CODE?>'   data-xyz ="<?php echo $key->TAX_NAME; ?>" ><?php echo $key->TAX_NAME ; echo " [".$key->TAX_CODE."]" ; ?></option>

	                                  @endforeach

	                                </datalist>

	                              </div>

	                              <small id="Taxcode_errr" style="color: red;"></small>
	                              <small id="Taxcodenamesh" style="color:#649fc0;font-weight: 700;"></small>

	                          </div><!-- /.form-group -->

                     		 	</div><!-- /.col -->

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

		                        </div><!-- /.form-group -->

		                      </div><!-- /.col -->

		                      <div class="col-md-3">

		                        <div class="form-group">

		                          <label>Due Date: <span class="required-field"></span></label>

		                            <div class="input-group">

		                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
		                            
		                              <input type="text" class="form-control rightcontent" name="due_date" id="due_date" value="{{ old('due_date')}}" placeholder="Select Due" autocomplete="off" readonly>

		                            </div>
		                        </div><!-- /.form-group -->

		                      </div><!-- /col -->

		                      <div class="col-md-3">
		                        <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 26px;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
		                      </div>
				        					
				        				</div><!-- /.row -->

				        			</div><!-- /.tabinfo one -->

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

                                <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="{{ $vrDate }}"  placeholder="Select Party Ref Date" autocomplete="off">

                              </div>

                              <small id="showmsgfordate_1" style="color: red;"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                      {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                            </div><!-- /.form-group -->

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

				        			</div><!-- tab 2 -->
				        			
				        		</div><!-- /.tab content -->	
				        	</div><!-- /. panel body -->
				        	</div><!-- /.panel info -->
				        </div><!-- /.col -->
					    </div><!-- /.row -->

           	</div><!-- /.box-body -->

          </div><!-- /.custom box -->

        </div><!-- /. col-sm-12 -->

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
                    <th>Item Code </th>
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
                      <input type='checkbox' class='case' id="cBocID1" onclick="checkcheckbox(1);" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">1.</span>
                    </td>

                    <td class="tdthtablebordr">

                      <div class="input-group">

                        <input type="text" class="inputboxclr itmbyQc" style="width: 90px;margin-bottom: 4px;margin-top: 13px;" id='Item_CodeId1' name="itemQcContra[]" onclick="ShowItemCode(1);"  oninput="this.value = this.value.toUpperCase()" readonly />

                        <input list="ItemList1" class="inputboxclr" style="width: 90px;margin-bottom: 4px;margin-top: 13px;" id='ItemCodeId1' name="item_codech[]"  onchange="ItemCodeGet(1);taxIntaxrate(1);"  oninput="this.value = this.value.toUpperCase()" readonly/>

                          <datalist id="ItemList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($help_item_list as $key)

                              <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                              @endforeach
                          </datalist>
                      </div>
                      <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1" onclick="showItemDetail(1)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                      <input type="hidden" id="selectItem1">

                      <input type="hidden" id="idsun1">

                      <div class="divhsn" id="showHsnCd1"></div>
                      <input type="hidden" id="hsn_code1" name="hsn_code[]">
                      <input type="hidden" id="taxByItem1" name="tax_byitem[]">
                      <input type="hidden" id="taxratebytax1" value="">

                      <input type="hidden" id="itmGetCode1" name="item_code[]">

                      <input type="hidden" id="slContraHead1" value="" name="contheadId[]">

                      <input type="hidden" id="slContraBody1" value="" name="contbodyid[]">

                      <input type="hidden" id="slQuoHead1" value="" name="quoHeadId[]">
                      <input type="hidden" id="slQuoBody1" value="" name="quoBodyId[]">

                      <input type="hidden" id="slQuoCompHead1" value="" name="QCHeadId[]">
                      <input type="hidden" id="slQuoCompBody1" value="" name="QCBodyId[]">

                      <input type="hidden" id="getlevel1" name="levelI[]">
                    </td> 

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id1' name="item_name[]" readonly />
                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>

                      <textarea id="remark_data1" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description" readonly></textarea>

                    </td>

                    <td class="tdthtablebordr">
                      
                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='qty1' name="qty[]" oninput="CalAQty(1)" style="width: 80px" readonly />

                      <input type="text" name="unit_M[]" id="UnitM1" class="inputboxclr SetInCenter AddM" readonly>

                      <input type="hidden" id="Cfactor1">
                       <input type="hidden" id="balQtyByItem1">

                      </div>

                      <div style="display: inline-flex;border: none;margin-top: 3%;">
                            <button type="button" class="btn btn-primary btn-xs tolrancehide" id="tolranceshow1" data-toggle="modal" data-target="#view_tolrance1" onclick="tolranceDetail(1)" style="padding: 0px 3px 0px 3px;margin-bottom: 3px;font-size: 11px;">Tolerance</button>
                        
                      </div>

                      <div id="appliedtolrnbtn1" style="margin-top: -2%;"></div>
                      <div id="cancelbtolrntn1" style="margin-top: -2%;"></div>
                      <input type="hidden" name="tolerence_index[]" id="settolrnceIndex1">
                      <input type="hidden" name="tolerence_rate[]" id="setTolrnceRate1">
                     
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

                       <input type="text" name="basic_amt[]" id="basic1" class="form-control basicamt debitcreditbox money" style="width: 110px;margin-top: 14%;height: 22px;" readonly>

                    </td>

                    <td>
                        <input type="hidden" id="data_count1" class="dataCountCl" value="" name="data_Count[]">

                        <input type="hidden" class="setGrandAmnt" id="get_grand_num1" name="amtByItem[]">
                         <div style="margin-top: 23%;">
                         <small id="taxnotfound1" class="label label-danger"></small>
                         </div>
                       <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1); getGrandTotal(1);" disabled="">Calc Tax </button>

                       <small id="appliedbtn1"></small>
                       <small id="cancelbtn1"></small>
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

                  </tr><!-- tr -->
	          			
	          		</table><!-- /. table -->
	          		
	          	</div><!-- /.table-responsive -->

	          </div><!-- /.box-body -->

	        </div><!-- /.custom-box -->

	      </div><!-- /.col-sm -->

	    </div><!-- /.row -->

	  </section><!-- /.section -->

</div><!-- /.div -->




@include('admin.include.footer')

@endsection