@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ URL::asset('public/dist/css/viewCss/commonCss.css') }}">
@include('admin.include.navbar')

@include('admin.include.sidebar')

<script src="{{ URL::asset('public/dist/js/controller/saleQuotationTransController.js') }}" ></script> 


<script type="text/javascript">

  var saleQuo = new SaleQuotationTran();

</script>

<script>
  
  var gateSaleQuoNo = "<?php echo url('get-data-by-rever-quo'); ?>";
  var gateItmData = "<?php echo url('get-item-from-salequo-by-quo-num'); ?>";
  
</script>

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
  .secondSection{
    display: none;
  }
  table {
     border-collapse: collapse;
  }
  .showdetail{
    display: none;
  }
  .aplynotStatus{
    display: none;
  }
  .modalScrlBar{
    border-radius: 5px;
    overflow-y: scroll;
    height: 512px;
  }
  .showind_Ch{
    display: none;
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
        Sales Quotation Trans
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
          <a href="{{ url('/Transaction/Sales/Sales-Quotation-Trans') }}"> Sales Quotation Transaction</a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Sales Quotation Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Transaction/Sales/View-Sales-Quotation-Trans')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

                                if($get_Month >=3 && $get_year == $fyYear[1]){
                                    $vrDate = $ToDate;
                                }else{
                                    $vrDate = $CurrentDate;
                                }

                              ?>

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control transdatepicker rightcontent" name="vr" id="vr_date" value="{{ $getSaleQuo[0]->VRDATE }}" placeholder="Select Date" autocomplete="off" readonly>

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

                              <input type="text" class="form-control" name="tran" value="{{ $getSaleQuo[0]->TRAN_CODE }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

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
                            <input list="series_List1"  id="series_code_sale" name="series" class="form-control  pull-left" value="{{ $getSaleQuo[0]->SERIES_CODE }}" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly>

                            <datalist id="series_List1">

                            </datalist>

                          </div>

                          <small id="series_code_errr" style="color: red;"></small>

                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->

                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Vr No: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="hidden" name="" value="" id="vr_last_num">

                            <input type="text" class="form-control rightcontent" name="vro" value="{{ $getSaleQuo[0]->VRNO }}" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                         </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <input list="PlantcodeList" class="form-control" id="Plant_code_sale" name="plantcode" placeholder="Select Plant" maxlength="55" value="{{ $getSaleQuo[0]->PLANT_CODE }}"  autocomplete="off" readonly>

                            </div>

                            <input type="hidden" id="getStateByPlant" value="{{$pfct_data[0]->STATE}}" name="stateByPlant">

                            <small>  

                                <div class="pull-left showSeletedName" id="plantText"></div>

                            </small>

                            <small id="plant_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                    </div>
                    <!-- /.row -->

                    <div class="row">
            
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Profit Center Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="profitList"  id="profitctrId" name="pfct" class="form-control  pull-left" value="{{ $getSaleQuo[0]->PFCT_CODE }}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly>

                              <datalist id="profitList">

                                <option selected="selected" value="">-- Select --</option>

                              </datalist>

                            </div>

                          <small id="profit_center_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Vendor Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 4px 12px;">

                                <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>

                                <div class="" id="appndplantbtn"> 
                                </div>
                                 
                                  <button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getaccdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;" id="appndplantbtn1" readonly> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>

                               
                              </span>
                              
                              <input list="AccountList"  id="account_code_sale" name="AccCode" class="form-control  pull-left" value="{{ $getSaleQuo[0]->ACC_CODE }}" placeholder="Select Vendor" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly> 

                              <datalist id="AccountList">

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

                          <label>Consignee/Delivery To: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 4px 12px;">

                                <i class="fa fa-newspaper-o " aria-hidden="true"></i>

                              </span>
                              
                              <input list="shipTAdd"  id="shipTAddr" class="form-control  pull-left" value="{{ $getSaleQuo[0]->CPCODE }}" placeholder="Select Consignee/Delivery To" oninput="this.value = this.value.toUpperCase()" onchange="gettaxByStatCdSale();" autocomplete="off" readonly> 

                              <datalist id="shipTAdd">

                                <option selected="selected" value="">-- Select --</option>

                              </datalist>

                            </div>
                            <input type="hidden" value="{{$stateOfAcc}}" id="stateOfAcc">

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Sale Rep. code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="saleRepList" class="form-control" id="sale_rep_code" name="sale_rep_code" placeholder="Select Sale Rep. code" maxlength="55" value="{{ $getSaleQuo[0]->SR_CODE }}" readonly autocomplete="off">

                            </div>
                            <small>  

                                <div class="pull-left showSeletedName" id="saleRText"></div>

                            </small>

                            <small id="saleR_err" style="color: red;"> </small>

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
                              <input list="CostcodeList" class="form-control" id="costCent_code_sale" name="costCent_code" placeholder="Select Cost Center Code" maxlength="55" value="{{ $getSaleQuo[0]->COST_CENTER }}" readonly autocomplete="off">

                              <datalist id="CostcodeList">


                              </datalist>

                            </div>
                            <small>  

                                <div class="pull-left showSeletedName" id="CostcentrText"></div>

                            </small>

                            <small id="Costcentr_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Reverse Quotation: 
                          
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="revQuoList" id="revQuoNum" name="" class="form-control  pull-left Number" value="No" placeholder="Enter Reverse Quotation" autocomplete="off" style="text-align: end;" readonly onchange="saleQuo.reverseQuoIfYes(gateSaleQuoNo)">
                              <datalist id="revQuoList">
                                  <option value=""></option>
                                  <option value="No">No</option>
                                  <option value="Yes">Yes</option>
                              </datalist>

                            </div>

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Quotation No.: 
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="QuoNoList" id="squotnNum" name="" class="form-control  pull-left Number" value="" placeholder="Enter Quotation No." autocomplete="off" style="text-align: end;" onchange="saleQuo.getItmBySaleQuoNo(gateItmData)" readonly>

                              <datalist id="QuoNoList">
                                
                              </datalist>
                              
                            </div>
                            <small style="color: red;" id="quoNumNotF"></small>
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
                              <input list="TaxcodeList"  id="tax_code_get" name="taxcode" class="form-control  pull-left" value="{{ $getSaleQuo[0]->TAX_CODE }}" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off" onchange="getitmByTax()">

                          
                            </div>

                            <small id="Taxcode_errr" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>
                      
                    </div>

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

                              <input type="text" id="due_days" name="due_days" class="form-control  pull-left Number" value="{{ $getSaleQuo[0]->DUEDAYS }}" placeholder="Enter Due Days" autocomplete="off" style="text-align: end;" readonly>

                            </div>

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Due Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            
                              <input type="text" class="form-control rightcontent" name="due_date" id="due_date" value="{{ $getSaleQuo[0]->DUEDATE }}" placeholder="Select Due" autocomplete="off" readonly>

                            </div>
                        </div>
                            <!-- /.form-group -->
                      </div>
                          <!-- /.col -->

                      <div class="col-md-3">
                        <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 26px;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                      </div>

                    </div> <!-- /.row -->

                  </div> <!-- /.tab first -->
                  <div class="tab-pane fade" id="tab2info">
                      <div class="row">

                          <div class="col-md-4">
                              <div class="form-group">

                                <label>Party Ref No :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="party_ref" id="party_rf_no" value="{{ $getSaleQuo[0]->PREFNO }}" placeholder="Enter Party Ref No" maxlength="30" autocomplete="off" readonly> 

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

                                <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="{{ $getSaleQuo[0]->PREFDATE }}" placeholder="Select Party Ref Date" autocomplete="off" readonly>

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

                                  <input type="text" class="form-control" name="Rfhead_1" placeholder="Enter Rfhead1" maxlength="30" value="{{ $getSaleQuo[0]->RFHEAD1 }}" id="rfhead1" oninput="rfheadget(1)" autocomplete="off" readonly>

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

                                  <input type="text" class="form-control" name="Rfhead_2" placeholder="Enter Rfhead2" value="{{ $getSaleQuo[0]->RFHEAD2 }}" maxlength="30" id="rfhead2" oninput="rfheadget(2)" readonly>

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

                                  <input type="text" class="form-control" name="Rfhead_3" id="rfhead3" placeholder="Enter Rfhead3" value="{{ $getSaleQuo[0]->RFHEAD3 }}" maxlength="30" oninput="rfheadget(3)" readonly>

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

                                  <input type="text" class="form-control" name="Rfhead_4" placeholder="Enter Rfhead4" maxlength="30" id="rfhead4" oninput="rfheadget(4)" value="{{ $getSaleQuo[0]->RFHEAD4 }}" autocomplete="off" readonly>

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

                                  <input type="text" class="form-control" name="Rfhead_5" placeholder="Enter Rfhead5" maxlength="30" id="rfhead5" oninput="rfheadget(5)" value="{{ $getSaleQuo[0]->RFHEAD5 }}" autocomplete="off" readonly>

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

            <form id="salesQuoTrans">
              @csrf
              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <input type="hidden" id="getItmexistCount">
                  <input type ="hidden" name="comp_name" id="getCompName">
                  <input type ="hidden" name="fy_year" id="getFyYear">
                  <input type ="hidden" name="trans_date" id="getTransDate">
                  <input type ="hidden" name="vr_no" id="getVrNo">
                  <input type ="hidden" name="trans_code" id="getTransCode">
                  <input type ="hidden" name="accountCode" id="getAccCode">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
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
                  <input type ="hidden" name="consneAdd" id="gateconsAdd">
                  <input type ="hidden" name="Sale_Reps" id="gateSaleRep">
                  <input type ="hidden" name="Cost_Center" id="gateCostCenter">



                  <tr >

                   
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

                  <?php $srno=1;$getCount = count($getSaleQuo);$basicTot=0;$grandTot=0;
                  
                    foreach ($getSaleQuo as $rows) { 
                    $basicTot += $rows->BASICAMT;
                    $grandTot += $rows->DRAMT;
                    $otherAmount = $grandTot - $basicTot;

                    ?>  

                    <?php if($srno==1){ ?>
                      <input type='hidden' value="{{$getCount}}" id="rowCount" />
                    <?php } ?>

                    <tr class="useful" id="firstRowtr">
                      
                      <td class="tdthtablebordr">
                        <span id='snum' style="width: 10px;"><?php echo $srno;?>.</span>
                      </td>

                      <td class="tdthtablebordr">
                        <div class="input-group">
                          <input list="ItemList<?php echo $srno;?>" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId<?php echo $srno;?>' name="item_code[]" value="{{$rows->ITEM_CODE}}" onchange="ItemCodeGet(<?php echo $srno;?>); taxIntaxrate(<?php echo $srno;?>);"  oninput="this.value = this.value.toUpperCase()" />

                            <datalist id="ItemList<?php echo $srno;?>">
                              @foreach ($item_list as $key)

                              <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                              @endforeach
                            </datalist>
                        </div>
                        <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail<?php echo $srno;?>" data-toggle="modal" data-target="#view_detail<?php echo $srno;?>" onclick="showItemDetail(<?php echo $srno;?>)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>
                        <div class="divhsn" id="showHsnCd<?php echo $srno;?>">HSN : {{$rows->HSN_CODE}}</div>
                        <input type="hidden" id="hsn_code<?php echo $srno;?>" value="{{$rows->HSN_CODE}}" name="hsn_code[]">
                        <input type="hidden" id="taxByItem<?php echo $srno;?>" value="{{$rows->TAX_CODE}}" name="tax_byitem[]">
                        <input type="hidden" id="taxratebytax<?php echo $srno;?>" value="{{$rows->TAX_CODE}}">
                        <small id="itmNotFound<?php echo $srno;?>"></small>
                        <input type="hidden" id="saleQuoHeadId<?php echo $srno;?>" name="existsqHead[]" value="{{$rows->SQTNHID}}">
                        <input type="hidden" id="saleQuoBodyId<?php echo $srno;?>" name="existsqBody[]" value="{{$rows->SQTNBID}}">
                        <input type="hidden" id="existSQHeadId<?php echo $srno;?>" name="saleQuoHead[]" value="{{$rows->SQTNHID}}">
                        <input type="hidden" id="existSQBodyId<?php echo $srno;?>" name="saleQuoBody[]" value="{{$rows->SQTNBID}}">
                      </td>

                      <td class="tdthtablebordr tooltips">
                        <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" value="{{$rows->ITEM_NAME}}" id='Item_Name_id<?php echo $srno;?>' name="item_name[]">
                        <small class="tooltiptextitem tooltiphide" id="itemNameTooltip<?php echo $srno;?>"></small>
                        <textarea id="remark_data<?php echo $srno;?>" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description" readonly>{{$rows->PARTICULAR}}</textarea>
                      </td>

                      <td class="tdthtablebordr">

                        <div style="display: inline-flex;border: none;margin-top: -3%;">

                          <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='qty<?php echo $srno;?>' value="{{$rows->QTYISSUED}}" name="qty[]" oninput="CalAQty(<?php echo $srno;?>)" style="width: 80px" />

                          <input type="text" name="unit_M[]" id="UnitM<?php echo $srno;?>" class="inputboxclr SetInCenter AddM" readonly value="{{$rows->UM}}">

                          <input type="hidden" id="Cfactor<?php echo $srno;?>" >
                          <input type='hidden' id='existQty<?php echo $srno;?>' name="existQty[]">
                    
                        </div>

                      </td>

                      <td class="tdthtablebordr">

                        <div style="display: inline-flex;border: none;margin-top: -3%;">

                          <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty<?php echo $srno;?>' name="Aqty[]" value="{{$rows->AQTYISSUED}}" style="width: 80px" />

                          <input type="text" name="add_unit_M[]" value="{{$rows->AUM}}" id="AddUnitM<?php echo $srno;?>" class="inputboxclr SetInCenter AddM" readonly>
                          <input type='hidden' id='existaddQty<?php echo $srno;?>' name='existaddQty[]' value="">
                        </div>

                      </td>

                      <td class="tdthtablebordr">

                        <input type='text' class="debitcreditbox inputboxclr cr_amount SetInCenter" oninput="calculateBasicAmt(<?php echo $srno;?>)" id='rate<?php echo $srno;?>' name="rate[]"  style="width: 80px" value="{{$rows->RATE}}"/>
                        <input type='hidden' value="" name='existrate[]' id='existrate<?php echo $srno;?>'>
                      </td>

                      <td class="tdthtablebordr">

                        <input type="text" name="basic_amt[]" id="basic<?php echo $srno;?>" class="form-control basicamt debitcreditbox" value="{{$rows->BASICAMT}}" style="width: 110px;margin-top: 14%;height: 22px;">
                        <input type='hidden' value="" name='existbasic[]' id='existbasic<?php echo $srno;?>'>
                      </td>

                      <td>
                        <input type="hidden" id="data_count<?php echo $srno;?>" class="dataCountCl" value="0" name="data_Count[]">

                        <input type="hidden" class="setGrandAmnt" id="get_grand_num<?php echo $srno;?>" name="crAmtPerItem[]">
                         <div style="margin-top: 23%;">
                         <small id="taxnotfound<?php echo $srno;?>" class="label label-danger"></small>
                         </div>
                        <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax<?php echo $srno;?>" data-toggle="modal" data-target="#tds_rate_model<?php echo $srno;?>" onclick="CalculateTax(<?php echo $srno;?>); getGrandTotal(<?php echo $srno;?>);">Calc Tax </button>

                        <div id="aplytaxOrNot<?php echo $srno;?>" class="aplynotStatus"></div>
                        <div id="appliedbtn<?php echo $srno;?>"></div>
                        <div id="cancelbtn<?php echo $srno;?>"></div>

                      </td>

                      <td>
                        
                        <div style="margin-top: 12%;">
                          <small id="qpnotfound<?php echo $srno;?>" class="label label-danger"></small>
                        </div>
                        <input type="hidden" id='quaP_count<?php echo $srno;?>' value="0" name="quaP_count[]" class="quaPcountrow">
                        <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="qua_paramter<?php echo $srno;?>" data-toggle="modal" data-target="#quality_parametr<?php echo $srno;?>" onclick="qty_parameter(<?php echo $srno;?>)" style="padding-bottom: 0px;padding-top: 0px;">Quality Parametr </button>

                        <div id="cancelQpbtn<?php echo $srno;?>"></div>
                        <div id="appliedQpbtn<?php echo $srno;?>"></div>
                        
                        <div id="qpApplyOrNot<?php echo $srno;?>" class="aplynotStatus">0</div>


                        <small id="qPnotfountbtn<?php echo $srno;?>" class="label label-danger"></small>

                      </td>

                    </tr>


                    <!--  tax calculation model -->

                    <div class="modal fade" id="tds_rate_model<?php echo $srno;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                      <div class="modal-dialog" role="document" style="margin-top: 5%;">

                        <div class="modal-content modalScrlBar">

                          <div class="modal-header">

                            <div class="row">

                              <div class="col-md-6">
                                <div class="form-group">
                                    <lable class="settaxcodemodel col-md-4" style="padding: 0px;">Tax Code - </lable>
                                             
                                    <input type="text" class="settaxcodemodel col-md-7" id="tax_code<?php echo $srno;?>" style="border: none; padding: 0px;" readonly>
                                </div>
                              </div>
                  
                              <div class="col-md-6">
                                <h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation</h5>
                              </div>

                            </div>

                          </div>

                          <div class="modal-body table-responsive">
                            <div class="modalspinner hideloaderOnModl"></div>
                            <div class="boxer" id="tax_rate_<?php echo $srno;?>">
                            
                            </div>
                          </div>

                          <div class="modal-footer">

                            <center> <small  id="footer_ok_btn<?php echo $srno;?>"></small>
                            <small  id="footer_tax_btn<?php echo $srno;?>" style="width: 10px;"></small>
                           </center>

                          </div>

                        </div>

                      </div>

                    </div>

                    <!--  tax calculation model -->

                    <!-- when hsn code same then show model -->

                    <div id="HsnSameShow<?php echo $srno;?>" class="modal fade" tabindex="-1">
                      <div class="modal-dialog modal-sm" style="margin-top: 13%;">
                          <div class="modal-content" style="border-radius: 5px;">
                              <div class="modal-header">
                                  <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
                                  
                              </div>
                              <div class="modal-body">
                                <p>Header Tax Code <small id="headtaxCode<?php echo $srno;?>"></small> Is Different Than Item Wise Tax Code <small id="itmtaxCode<?php echo $srno;?>"></small></p>
                                 
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-primary" data-dismiss="modal" >Ok</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="cancleblnkItm(<?php echo $srno;?>);" >Cancel</button>
                                 
                              </div>
                          </div>
                      </div>
                  </div>
                <!-- when hsn code same then show model -->

                <!-- show modal when click on view btn after item select item -->

                <div class="modal fade" id="view_detail<?php echo $srno;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                              <small id="itemCodeshow<?php echo $srno;?>"> </small>
                            </div>
                            
                            <div class="box10 itmdetlheading">
                              <small id="hsncodeshow<?php echo $srno;?>"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="taxcodeshow<?php echo $srno;?>"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="itemDetailshow<?php echo $srno;?>"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="itemtypeshow<?php echo $srno;?>"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="itemgroupshow<?php echo $srno;?>"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="itemclassshow<?php echo $srno;?>"> </small>
                            </div>
                            <div class="box10 itmdetlheading">
                              <small id="itemcategoryshow<?php echo $srno;?>"> </small>
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

              <!-- when click on quality Parameter -->

              <div class="modal fade" id="quality_parametr<?php echo $srno;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

                        <div class="boxer" id="qua_par_<?php echo $srno;?>">
                        
                        </div>

                    </div>

                    <div class="modal-footer">
                     
                      <center><small style="text-align: center;" id="footerqp_ok_btn<?php echo $srno;?>"></small>
                      <small style="text-align: center;" id="footerqp_quality_btn<?php echo $srno;?>"></small>
                      </center>
                    
                    </div>

                  </div>

                </div>
              </div>

      <!-- when click on quality Parameter -->

                  <?php $srno++;} ?>

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
                    <input class="credittotldesn inputboxclr" type="text" name="basic_Total" id="basicTotal" value="{{number_format($basicTot,2)}}" readonly="" style="margin-top: 3px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>

               <div class="row" style="display: flex;">

                  <div class="col-md-6">
              
                  </div>

                    <div class="col-md-4 toalvaldesn">

                    <div class="totlsetinres">Other Total :</div>

                  </div>

                  <div class="col-md-1">

                    <input class="credittotldesn inputboxclr" type="text" name="other_total" id="otherTotalAmt" value="{{number_format($otherAmount,2)}}" readonly="" style="margin-top: 3px;">

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

                    <input class="credittotldesn inputboxclr" type="text" name="grand_total" id="allgrandAmt" value="{{number_format($grandTot,2)}}" readonly="" style="margin-top: 3px;">

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

         

      <br>

        

        <p class="text-center">

          <button class="btn btn-success" type="button" id="submitdata" onclick="submitAllData(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

           <button class="btn btn-success" type="button" onclick="submitAllData(1)" id="submitNDown"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save &amp; Download</button>

           <input type="hidden" id="donwloadStatus" name="donwloadStatus" value="">

        </p>

       <!-- model -->

      
      <!-- model -->

      <div id="domModel_2">
         
      </div>

      


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
<script src="{{ URL::asset('public/dist/js/viewjs/editCommonJsFun.js') }}" ></script>


<script type="text/javascript">
/*on click model*/

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
      var taxCode      =  $('#tax_code_get').val();
      var acc_Code     =  $('#account_code_sale').val();
      var seperateC    = acc_Code.split('[');
      var accCode      = seperateC[0]
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

             $('#saleQuoHeadId'+ItemId).val('');
             $('#saleQuoBodyId'+ItemId).val('');
             $('#ItemCodeId'+ItemId).val('');
             $("#Item_Name_id"+ItemId).val('');
             $('#remark_data'+ItemId).val('');
             $('#remark_data'+ItemId).prop('readonly',true);
             $('#qty'+ItemId).val('');
             $('#A_qty'+ItemId).val('');
             $('#UnitM'+ItemId).val('');
             $('#AddUnitM'+ItemId).val('');
             $('#rate'+ItemId).val('');
             $('#basic'+ItemId).val('');
             $('#viewItemDetail'+ItemId).addClass('showdetail');
             $('#showHsnCd'+ItemId).html('');
             $('#hsn_code'+ItemId).val('');
             $('#taxByItem'+ItemId).val('');
             $('#taxratebytax'+ItemId).val('');
             $('#Cfactor'+ItemId).val('');
             $('#qty'+ItemId).prop('readonly',true);
             $('#rate'+ItemId).prop('readonly',true);
             $('#data_count'+ItemId).val('0');
             $('#get_grand_num'+ItemId).val('');
             $('#aplytaxOrNot'+ItemId).html('0');
             $("#itemNameTooltip"+ItemId).addClass('tooltiphide');
             $('#tax_code'+ItemId).val('');
             $('#CalcTax'+ItemId).prop('disabled',true);
             $('#cancelbtn'+ItemId).html('');
             $('#appliedbtn'+ItemId).html('');
             $('#quaP_count'+ItemId).val('0');
             $('#footer_tax_btn'+ItemId).html('');
             $('#appliedQpbtn'+ItemId).empty();
             $('#cancelQpbtn'+ItemId).empty();

             rowWiseCalculation();
      }else{
          $('#saleQuoHeadId'+ItemId).val('');
          $('#saleQuoBodyId'+ItemId).val('');
          $('#remark_data'+ItemId).val('');
          $('#remark_data'+ItemId).prop('readonly',true);
          $('#qty'+ItemId).val('');
          $('#A_qty'+ItemId).val('');
          $('#UnitM'+ItemId).val('');
          $('#AddUnitM'+ItemId).val('');
          $('#rate'+ItemId).val('');
          $('#basic'+ItemId).val('');
          $('#viewItemDetail'+ItemId).addClass('showdetail');
          $('#hsn_code'+ItemId).val('');
          $('#taxByItem'+ItemId).val('');
          $('#taxratebytax'+ItemId).val('');
          $('#Cfactor'+ItemId).val('');
          $('#qty'+ItemId).prop('readonly',true);
          $('#rate'+ItemId).prop('readonly',true);
          $('#data_count'+ItemId).val('0');
          $('#get_grand_num'+ItemId).val('');
          $('#aplytaxOrNot'+ItemId).html('0');
          $("#itemNameTooltip"+ItemId).addClass('tooltiphide');
          $('#tax_code'+ItemId).val('');
          $('#CalcTax'+ItemId).hide();
          $('#cancelbtn'+ItemId).html('');
          $('#appliedbtn'+ItemId).html('');
          $('#footer_tax_btn'+ItemId).html('');
          $('#quaP_count'+ItemId).val('');
          
          $('#showHsnCd'+ItemId).html('');
          
          
          var cnclbtn ='<input type="hidden" value="0" id="qltyvalue'+ItemId+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

         $('#cancelbtn'+ItemId).html(cnclbtn);
         $('#data_count'+ItemId).val(0);

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

                          if(data1.data_hsn==''){
                            var hsnCode= '';
                            var shHCode= '';
                            $('#hsn_code'+ItemId).val(hsnCode);
                            $('#showHsnCd'+ItemId).html(shHCode);
                          }else{
                            $('#hsn_code'+ItemId).val(data1.data_hsn.HSN_CODE);
                            $('#showHsnCd'+ItemId).html('HSN No : '+data1.data_hsn.HSN_CODE);
                          }

                          if(data1.data_quaPar == ''){
                            $('#qua_paramter'+ItemId).prop('disabled',true);
                          }else{
                            $('#qua_paramter'+ItemId).prop('disabled',false);
                          }


                          if(taxCode){

                            if(data1.data_tax == ''){
                                
                                $('#taxByItem'+ItemId).val('');
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

                              var taxData = '<input type="radio" class="taxcodeset" id="html" name="taxcodeit" value="'+gettax.TAX_CODE+'" onclick="taxSelectn('+ItemId+');"> <label for="html">'+gettax.TAX_CODE+' ('+gettax.TAX_NAME+' )</label><br>';
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
     
        var trans_code    = $('#transcode').val();
        var tax_code      = $('#taxByItem'+taxid).val();
        var saleQtnHeadId = $('#saleQuoHeadId'+taxid).val();
        var saleQtnBodyId = $('#saleQuoBodyId'+taxid).val();
        var ItemCode      = $('#ItemCodeId'+taxid).val();

    if(taxOnModel == ''){

      var tax_code = $('#taxByItem'+taxid).val();
        console.log('tax_code',tax_code);
      $.ajax({

                url:"{{ url('get-a-field-calc-by-tax-in-sales')}}",

                method : "POST",

                type: "JSON",

                data: {trans_code:trans_code,tax_code: tax_code,saleQtnHeadId:saleQtnHeadId,saleQtnBodyId:saleQtnBodyId,ItemCode:ItemCode},

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

                            if(getData.taxhid){
                              var gettaxhid = getData.taxhid;
                            }else{
                              var gettaxhid = '';
                            }

                            var datacount = data1.data.length;
                            dataI = datacount;
                                //console.log('count',datacount);
                                $('#data_count'+taxid).val(datacount);

                            if((getData.RATE_INDEX == null && getData.TAX_RATE == null) || (getData.RATE_INDEX == '-' && getData.TAX_RATE == '0.00')){

                             $('#tax_code'+taxid).val(getData.TAX_CODE);
                             
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly>  <input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' value="+gettaxhid+" id='taxhid_"+taxid+"_"+counter+"' name=taxhid[]><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''></div></div>";



                            }else{

                                if(getData.tax_ind_name == 'GrandTotal'){
                                  var classname = 'grandTotalGet';
                                }else{
                                  var classname = '';
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

                                //console.log('rate',javascript_array);
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></div><div class='box10 rateIndbox'> <input type='text' class='form-control' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+");'> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a> </div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control' oninput='getGrandTotal("+taxid+");' ></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticIND+"'><input type='hidden' value='"+gettaxhid+"' id='taxhid_"+taxid+"_"+counter+"' name=taxhid[]><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'></div></div> <div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($ratval_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+");'>Apply</button></div></div></div></div>";

                              

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

                          var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOktaxbtn"+taxid+"' onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",1);' style='width: 36px;'>Ok</button>";

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

$(document).ready(function(){

    $("#submitdata1").click(function(event) {


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

          var data = $("#salesQuoTrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/Transaction/Sales/Save-Sale-Quotation-Trans') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

              //  console.log(data);
               var url = "{{url('Transaction/Sales/Sales-Quotation-Save-Msg')}}"
             setTimeout(function(){ window.location = url+'/savedata'; });
              },

          });

      }
             
    });

});

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

          var data = $("#salesQuoTrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/Transaction/Sales/Update-Sale-Quotation-Trans') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {


                if(downloadFlg == 1){
                var link = document.createElement('a');
                link.href = data.url;
                link.download = 'Sale Chalan.pdf';
                link.dispatchEvent(new MouseEvent('click'));
              }

               // console.log(data);
               var url = "{{url('Transaction/Sales/Sales-Quotation-Save-Msg')}}"
             setTimeout(function(){ window.location = url+'/savedata'; });
              },

          });

      }

   }

</script>

<script type="text/javascript">

  function qty_parameter(qty){

   var ItemCode = $("#ItemCodeId"+qty).val();
   var saleQuoHeadId = $("#saleQuoHeadId"+qty).val();
   var saleQuoBodyId = $("#saleQuoBodyId"+qty).val();

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
    });

    $.ajax({

        type: 'POST',

        url: "{{ url('/get-quo-paramter-for-item-sales') }}",

        data: {ItemCode:ItemCode,saleQuoHeadId:saleQuoHeadId,saleQuoBodyId:saleQuoBodyId}, // here $(this) refers to the ajax object not form
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

                        var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkQtbtn"+qty+"' onclick='getQuaPvalue("+qty+",1)' style='width: 36px;'>Ok</button>";

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

</script>




@endsection