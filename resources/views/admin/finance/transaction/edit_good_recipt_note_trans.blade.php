@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<link rel="stylesheet" href="{{ URL::asset('public/dist/css/viewCss/commonCss.css') }}">

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .tolrancehide{
    display: none !important;
  }

  .showSeletedName{
      font-size: 15px;
      margin-top: 2%;
      text-align: center;
      font-weight: 600;
      color: #4f90b5;
  }

  .title{
      margin-top: 50px;
      margin-bottom: 20px;
  }

  table {
     border-collapse: collapse;
  }

  .inputboxclr{
    border: 1px solid #d7d3d3;
  }

  .tdthtablebordr{
    border: 1px solid #00BB64;
  }

  ::placeholder {
    text-align:left;
  }

  .SetInCenter{
    margin-top: 18%;
  }

  .texIndbox{
    text-align: center;
    width: 5%;
  }

  .rateIndbox{
    text-align: center;
    width: 15%;
  }

  .vrnoinbox{
    width: 10%;
    text-align: center;
  }

  .rateBox{
    width: 20%;
    text-align: center;
  }

  .itemIndbox{
    width: 30%;
    text-align: center;
  }

  .amountBox{
    width: 20%;
    text-align: center;
  }

  .inputtaxInd{
    background-color: white !important;
    border: none;
    text-align: center;
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
  
  .batchNoC{
    font-weight: 700;
    width: 57px;
    margin-top: 1%;
    margin-right: 2%;
    color: #3c8dbc;
  }
  .showbatchnum{
    width: 135px;
    margin-bottom: 2%;
    height: 26px;
  }
  .setbatchnoandref{
    display: flex;

  }
  .hidebatchnoinput{
    display: none;
  }
  
  .taxcodeset{
  margin-right: 11px !important;
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

<!-- section open -->
  <section class="content-header">

   

      <h1>

        Good Reciept Note Transaction

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

          <a href="{{ url('/finance/form-transaction-mast') }}"> Good Reciept Note Transaction</a>

        </li>

      </ul>

  </section>

<!-- section close -->

<!-- section open -->

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Good Reciept Note Transaction</h2>

            <div class="box-tools pull-right">

                <a href="{{ url('/finance/transaction/view-good-reciept-note-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Grn</a>

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
                              <input type="hidden" value="<?php echo session()->get('macc_year');?>" id="currentyear">
                              <label>Date: <span class="required-field"></span></label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <?php  $FromDate= date("d-m-Y", strtotime($fromDate));  

                                  $ToDate= date("d-m-Y", strtotime($toDate));  

                                  $CurrentDate =date("d-m-Y");
                                ?>

                                <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                                <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                                <input type="text" class="form-control transdatepicker rightcontent" name="vr" id="vr_date" value="{{ $getPurchasegrn[0]->vr_date }}" placeholder="Select Date" autocomplete="off" readonly>

                              </div>

                              <small id="showmsgfordate" style="color: red;"></small>

                            </div>
                                    <!-- /.form-group -->
                          </div>
                          <!--  /. column close -->

                          <div class="col-md-2">

                            <div class="form-group">

                              <label> T Code : </label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="tran" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                                  <input type="hidden" id="transtaxCode" >

                                </div>

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
                                <?php $secount = count($series_list); ?>
                                <input type="text"  id="series_code" name="series" class="form-control  pull-left" value="{{ $getPurchasegrn[0]->series_code }}" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off" onchange="getvrnoBySeries()">

                                  <datalist id="seriesList1">

                                  </datalist>

                              </div>

                              <small id="serscode_err" style="color: red;" class="form-text text-muted"></small>

                              <small id="series_code_errr" style="color: red;"></small>

                            </div>
                              <!-- /.form-group -->
                          </div>
                          <!-- /.col -->

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Series Name: 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input   id="seriesText" name="seriesText" class="form-control  pull-left" value="<?php if($secount == 1){echo $series_list[0]->series_name;} ?>" placeholder="Select Series" readonly autocomplete="off">

                              </div>

                            </div>
                                <!-- /.form-group -->
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

                                <input type="hidden" name="" value="{{$to_num}}" id="vr_last_num">

                                <input type="text" class="form-control rightcontent" name="vro" value="{{$getPurchasegrn[0]->vr_no}}" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                              </div>

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

                                <input type="text" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" value="{{$getPurchasegrn[0]->plant_code}}" autocomplete="off" readonly>

                              </div>

                              <small id="plant_err" style="color: red;"> </small>
                              <input type="hidden" id="getStateByPlant" name="stateByPlant">
                            </div>
                                <!-- /.form-group -->
                          </div>
                            <!-- /.col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Plant Name: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input  class="form-control" id="plantText" name="plantText" placeholder="Select Plant" maxlength="11" readonly autocomplete="off">

                              </div>

                            </div>
                                <!-- /.form-group -->
                          </div>
                           <!-- /.col -->

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Profit Center Code: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input type="text"  id="profitctrId" name="pfct" class="form-control  pull-left" value="{{$getPurchasegrn[0]->pfct_code}}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">
                        
                              </div>

                              <small id="profit_center_err" style="color: red;"> </small>

                            </div>
                              <!-- /.form-group -->
                          </div>
                          <!-- /.col -->
                        </div> 
                        <!-- row -->

                        <div class="row">

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Profit Center Name: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input  id="profitText" name="profitText" class="form-control  pull-left" value="" placeholder="Select Profit Center Name"  readonly autocomplete="off">

                              </div>

                            </div>
                                <!-- /.form-roup -->
                          </div>
                          <!-- /.col -->

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Acc Code : <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                <?php $getacccount = count($getacc); ?>
                                <input type="text"  id="account_code" name="AccCode" class="form-control  pull-left" value="{{$getPurchasegrn[0]->acc_code}}" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getpurOrderNum()" readonly>

                              </div>

                              <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                              <small id="acccode_code_errr" style="color: red;"></small>

                              <input type="hidden" value="" id="stateOfAcc">

                            </div>
                                <!-- /.form-group -->
                          </div>
                          <!-- /.col -->
                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Acc Name : <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input  id="AccountText" name="AccountText" class="form-control  pull-left" value="<?php if($getacccount==1){echo $getacc[0]->acc_name;} ?>" placeholder="Select Account" readonly autocomplete="off">

                              </div>

                            </div>
                                <!-- /.form-group -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- row --> 
                        <div class="row">

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Purchase Order No : </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input type="text"  id="purOrdervrno" name="" class="form-control  pull-left" value="{{$getPurchasegrn[0]->pur_order_no}}" placeholder="Select Account" onchange="getITmDataByPo()" readonly autocomplete="off">


                              </div>
                              <small id="povrnoNotFound"></small>
                              <input type="hidden" id="itmCountchk">
                            </div>
                                <!-- /.form-group -->
                          </div>
                          <!-- /.col -->
                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Tax Code: 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                <?php $taxCount = count($tax_code_list); ?>
                                <input type="text"   id="tax_code" name="taxcode" class="form-control  pull-left" value="{{$getPurchasegrn[0]->tax_code}}" placeholder="Select Tax" onchange="getitmByTax();" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">


                              </div>

                              <small id="serscode_err" style="color: red;" class="form-text text-muted"> </small>
                              <small id="Taxcode_name" style="color:#649fc0;font-weight: 700;"></small>
                              <small id="Taxcode_errr" style="color: red;"></small>

                            </div>
                              <!-- /.form-group -->
                          </div>
                            <!-- /.col -->

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

                            </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.col -->
                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Due Date: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                
                                  <input type="text" class="form-control" name="due_date" id="due_date" value="{{$getPurchasegrn[0]->due_date}}" placeholder="Select Due" autocomplete="off" readonly>

                                </div>
                            </div>
                            <!-- /.form-group -->
                          </div>
                          <!-- /.col -->
                        </div>
                         <!-- /.row -->

                        <div class="row">

                          <div class="col-md-3">

                            <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 26px;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>

                          </div>

                        </div> <!-- row -->

                      </div>
                       <!-- /.tab first -->

                      <div class="tab-pane fade" id="tab2info">

                        <div class="row">

                          <div class="col-md-3">
                              
                            <div class="form-group">

                              <label>Party Ref No :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="party_ref" id="party_rf_no" value="{{$getPurchasegrn[0]->partyref_no}}" placeholder="Enter Party Ref No" maxlength="30" autocomplete="off">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">
                              </small>

                            </div>

                          </div>
                          <!-- ./col -->

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

                                  <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="{{$getPurchasegrn[0]->partyref_date}}" placeholder="Select Party Ref Date" autocomplete="off">

                                </div>

                                <small id="showmsgfordate_1" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>
                            </div>
                            <!-- /.form-group -->
                          </div>
                            <!-- ./col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Consine Code : <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input list="consineList"  id="consine_code" name="consine" class="form-control pull-left" value="{{$getPurchasegrn[0]->consine_code}}" placeholder="Select consine" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                                  <datalist id="consineList">

                                    <option selected="selected" value="">-- Select --</option>
                                    @foreach ($getacc as $key)

                                    <option value='<?php echo $key->acc_code?>'   data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>

                                    @endforeach

                                  </datalist>

                                </div>

                                <small id="cosnicode_err" style="color: red;" class="form-text text-muted"> </small>

                                <small> <div class="pull-left showSeletedName" id="consineText"></div> </small>

                            </div>
                                <!-- /.form-group -->
                          </div>
                          <!-- ./col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Vendor Qc Name : </label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input type="text"  id="vendor_qc_name" name="" class="form-control pull-left" value="{{$getPurchasegrn[0]->vendorQcName}}" placeholder="Enter Vendor Qc Name" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                                </div>

                            </div>
                                <!-- /.form-group -->
                          </div>
                          <!-- ./col -->
                        </div>
                          <!-- ./row -->

                        <div class="row">

                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead1) && $rfhead->rfhead1 !=''){

                         ?>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead1 ?> :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="Rfhead_1" placeholder="Enter Rfhead1" maxlength="30" value="{{$getPurchasegrn[0]->rfhead1}}" id="rfhead1" oninput="rfheadget(1)" autocomplete="off">

                                </div>

                                <small id="emailHelp" class="form-text text-muted"></small>

                            </div>

                          </div>
                          <!-- ./col -->

                        <?php }else{} } ?>

                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead2) && $rfhead->rfhead2 !=''){ 
                        ?>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead2 ?> :</label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_2" placeholder="Enter Rfhead2" maxlength="30" value="{{$getPurchasegrn[0]->rfhead2}}" id="rfhead2" oninput="rfheadget(2)" autocomplete="off">

                                </div>

                                <small id="emailHelp" class="form-text text-muted"></small>

                            </div>

                          </div>
                          <!-- ./col -->

                        <?php }else{} } ?>

                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead3) && $rfhead->rfhead3 !=''){

                        ?>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead3 ?> :</label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_3" id="rfhead3" placeholder="Enter Rfhead3" value="{{$getPurchasegrn[0]->rfhead3}}" maxlength="30" oninput="rfheadget(3)" autocomplete="off">

                                </div>

                                <small id="emailHelp" class="form-text text-muted"></small>

                            </div>

                          </div>
                          <!-- ./col -->
                        <?php }else{} } ?>

                        </div>
                         <!-- ./row --> 

                        <div class="row">
                              
                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead4) && $rfhead->rfhead4 !=''){

                        ?>
                          <div class="col-md-4">

                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead4 ?> :</label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_4" placeholder="Enter Rfhead4" value="{{$getPurchasegrn[0]->rfhead4}}" maxlength="30" id="rfhead4" oninput="rfheadget(4)" autocomplete="off">

                                </div>

                                <small id="emailHelp" class="form-text text-muted"></small>

                            </div>

                          </div>
                            <!-- ./col -->
                        <?php }else{} } ?>

                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead5) && $rfhead->rfhead5 !=''){

                        ?>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead5 ?> :</label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_5" placeholder="Enter Rfhead5" value="{{$getPurchasegrn[0]->rfhead5}}" maxlength="30" id="rfhead5" oninput="rfheadget(5)" autocomplete="off">

                                </div>

                                <small id="emailHelp" class="form-text text-muted"> </small>

                            </div>

                          </div>
                            <!-- ./col -->
                        <?php }else{} } ?>

                          <div class="col-md-4">

                              <a class="btn btn-info"  href="#tab1info" data-toggle="tab" style="margin-top: 26px;" id="previousbtn" >Previous&nbsp;&nbsp;<i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>

                          </div>

                        </div>
                          <!-- ./row -->
                      </div>
                        <!--  ./2 tab -->
                    </div>
                      <!--  ./ tab content -->
                  </div>
                    <!-- panel body -->
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

            <form id="grntrans">

              @csrf

              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <input type ="hidden" name="comp_name" id="getCompName">

                  <input type ="hidden" name="fy_year" id="getFyYear">

                  <input type ="hidden" name="trans_date" id="getTransDate">

                  <input type ="hidden" name="vr_no" id="getVrNo">

                  <input type ="hidden" name="trans_code" id="getTransCode">

                  <input type ="hidden" name="tax_code" id="getTaxCode">

                  <input type="hidden" name="accountName" id="acc_name_byacc">
                  <input type="hidden" name="AccTypes" id="acc_type">
                  <input type="hidden" name="AccClasss" id="acc_class">


                  <input type ="hidden" name="consine_code" id="getcosine">

                  <input type ="hidden" name="vendorQcName" id="getvendorqcname">


                  <input type ="hidden" name="purOrderNo" id="pur_order_no">
                  <input type ="hidden" name="Gl_Code" id="getGlCode">

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

                  <?php $srn=1;$basicTotal=0;$grandTotal=0; $otherTotal =0;$gettot = count($getPurchasegrn); foreach ($getPurchasegrn as $row) {

                    $basicTotal += $row->basic_amt;
                    $grandTotal += $row->dr_amount;

                    $otherTotal = $grandTotal - $basicTotal;

                   ?>

                    <?php if($srn == 1){ ?>

                      <input type="hidden" value="<?php echo $gettot;?>" id="countget">
                      <input type="hidden" id="grnheadid" value="<?php echo $row->grn_head_id;?>" name="grn_headid">

                    <?php } ?>

                    <tr class="useful">

                      <td class="tdthtablebordr">
                        <input type='checkbox' class='case'  id="cBocID<?php echo $srn;?>" onclick="checkcheckbox(<?php echo $srn;?>);" />
                      </td>

                      <td class="tdthtablebordr">
                        <span id='snum' style="width: 10px;"><?php echo $srn;?>.</span>
                      </td> 

                      <td class="tdthtablebordr">
                        <input type="hidden" id="grnBodyid" value="<?php echo $row->bodyid;?>" name="grn_bodyid[]">
                        <div class="input-group">

                          <input type="text" class="inputboxclr itmbyQc" style="width: 90px;margin-bottom: 4px;margin-top: 13px;" id='Item_CodeId<?php echo $srn;?>' name="itemPo[]"  onclick="ShowItemCode(<?php echo $srn;?>);" onchange="ItemCodeGet(<?php echo $srn;?>); checktaxCode(<?php echo $srn;?>);taxIntaxrate(<?php echo $srn;?>);"  oninput="this.value = this.value.toUpperCase()" readonly />

                          <input list="ItemList<?php echo $srn;?>" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId<?php echo $srn;?>' name="item_code[]" value="<?php echo $row->item_code; ?>" onchange="ItemCodeGet(<?php echo $srn;?>);taxIntaxrate(<?php echo $srn;?>);" oninput="this.value = this.value.toUpperCase()" />

                          <datalist id="ItemList<?php echo $srn;?>">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($help_item_list as $key)

                              <option value='<?php echo $key->item_code?>' data-xyz ="<?php echo $key->item_name; ?>" ><?php echo $key->item_name ; echo " [".$key->item_code."]" ; ?></option>

                              @endforeach
                          </datalist>
                        </div>
                        <input type="hidden" id="idsun<?php echo $srn;?>">
                        <input type="hidden" id="selectItem<?php echo $srn;?>">
                        <div class="divhsn" id="showHsnCd<?php echo $srn;?>">HSN No : <?php echo $row->hsn_code; ?></div>
                        <input type="hidden" id="hsn_code<?php echo $srn;?>" name="hsn_code[]" value="<?php echo $row->hsn_code; ?>">
                        <input type="hidden" id="taxByItem<?php echo $srn;?>" value="<?php echo $row->tax_code; ?>" name="tax_byitem[]">
                        <input type="hidden" id="taxratebytax<?php echo $srn;?>" value="<?php echo $row->tax_code; ?>">
                        <input type="hidden" id="po_transcode<?php echo $srn;?>" name="po_trans[]">
                        <input type="hidden" id="po_seriescode<?php echo $srn;?>" name="po_series[]">
                        <input type="hidden" id="po_vrno<?php echo $srn;?>" name="po_vrno[]">
                        <input type="hidden" id="po_slno<?php echo $srn;?>" name="po_slno[]">
                        <input type="hidden" id="po_headid<?php echo $srn;?>" name="po_head[]">
                        <input type="hidden" id="po_bodyid<?php echo $srn;?>" name="po_body[]">
                        <input type="hidden" id="itmC_code<?php echo $srn;?>" name="itemcodeC[]" value="<?php echo $row->item_code; ?>">
                        <small id='itemnotFound1' style="color: red;"></small>
                      </td>

                      <td class="tdthtablebordr">

                        <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id<?php echo $srn;?>' value="<?php echo $row->item_name ?>" name="item_name[]" readonly />
                        <textarea id="remark_data<?php echo $srn;?>" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description" readonly><?php echo $row->remark; ?></textarea>
                        <input type="hidden" id="batch_No<?php echo $srn;?>" value="<?php echo $row->batchNo; ?>">
                        <div class="hidebatchnoinput" id="hsbatchno<?php echo $srn;?>">
                          <div class="setbatchnoandref">

                              <small class="batchNoC">Batch No : </small>
                              <textarea id="batchNumget<?php echo $srn;?>" rows="1" class="showbatchnum" name="batchNo[]" placeholder="Enter Batch No" readonly><?php echo $row->batchNo; ?></textarea>
                          </div>
                        </div>

                      </td>

                      <td class="tdthtablebordr">

                        <div style="display: inline-flex;border: none;margin-top: -3%;">

                          <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='qty<?php echo $srn;?>' value="<?php echo $row->quantity; ?>" name="qty[]" oninput="CalAQty(<?php echo $srn;?>)" style="width: 80px"  />

                          <input type="text" name="unit_M[]" id="UnitM<?php echo $srn;?>" value="<?php echo $row->um_code; ?>" class="inputboxclr SetInCenter AddM" readonly>

                          <input type="hidden" id="Cfactor<?php echo $srn;?>">
                          <input type="hidden" id="balQtyByItem<?php echo $srn;?>">

                        </div>

                        <div style="display: inline-flex;border: none;margin-top: 3%;">

                          <button type="button" class="btn btn-primary btn-xs tolrancehide" id="tolranceshow<?php echo $srn;?>" data-toggle="modal" data-target="#view_tolrance<?php echo $srn;?>" onclick="tolranceDetail(<?php echo $srn;?>)" style="padding: 0px 3px 0px 3px;margin-bottom: 3px;font-size: 11px;">Tolerance</button>
                          
                        </div>

                        <div id="appliedtolrnbtn<?php echo $srn;?>"></div>
                        <div id="cancelbtolrntn<?php echo $srn;?>"></div>
                        <input type="hidden" name="tolerence_index[]" id="settolrnceIndex<?php echo $srn;?>">
                        <input type="hidden" name="tolerence_rate[]" id="setTolrnceRate<?php echo $srn;?>">

                      </td>

                      <td class="tdthtablebordr">

                        <div style="display: inline-flex;border: none;margin-top: -3%;">

                          <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty<?php echo $srn;?>'  value="<?php echo $row->Aquantity; ?>" name="Aqty[]"  style="width: 80px" readonly />

                          <input list="aumList<?php echo $srn;?>" name="add_unit_M[]" id="AddUnitM<?php echo $srn;?>" value="<?php echo $row->aum_code; ?>" class="inputboxclr SetInCenter AddMList" onchange="changeAum(<?php echo $srn;?>)">

                          <datalist id="aumList<?php echo $srn;?>">
                            <option value="">--select--</option>
                          </datalist>

                        </div>

                      </td>

                      <td class="tdthtablebordr">

                        <input type='text' class="debitcreditbox inputboxclr cr_amount SetInCenter" value="<?php echo $row->rate; ?>" oninput="calculateBasicAmt(<?php echo $srn;?>)" id='rate<?php echo $srn;?>' name="rate[]"  style="width: 80px" readonly/>
                        <input type="hidden" id="qnrate<?php echo $srn;?>">
                      </td>

                      <td class="tdthtablebordr">

                        <input type="text" name="basic_amt[]" id="basic<?php echo $srn;?>" value="<?php echo $row->basic_amt; ?>" class="form-control basicamt" style="width: 110px;margin-top: 14%;height: 22px;" readonly>

                      </td>

                      <td>

                        <input type="hidden" id="data_count<?php echo $srn;?>" class="dataCountCl"   value="" name="data_Count[]">
                        <input type="hidden" class="setGrandAmnt" id="get_grand_num<?php echo $srn;?>" name="dr_grandAmt[]">

                        <div style="margin-top: 23%;">

                          <small id="taxnotfound1" class="label label-danger"></small>

                         </div>

                        <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax<?php echo $srn;?>" data-toggle="modal" data-target="#tds_rate_model<?php echo $srn;?>" onclick="CalculateTax(<?php echo $srn;?>); getGrandTotal(<?php echo $srn;?>); " disabled="">Calc Tax </button>

                        <div id="appliedbtn<?php echo $srn;?>"></div>
                        <div id="cancelbtn<?php echo $srn;?>"></div>
                        <div id="aplytaxOrNot<?php echo $srn;?>" class="aplynotStatus">0</div>

                      </td> 

                      <td>
                        
                        <div style="margin-top: 12%;">
                          <small id="qpnotfound<?php echo $srn;?>" class="label label-danger"></small>
                        </div>
                        <input type="hidden" id='quaP_count<?php echo $srn;?>' value="0" name="quaP_count[]" class="quaPcountrow">
                        <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="qua_paramter<?php echo $srn;?>" data-toggle="modal" data-target="#quality_parametr<?php echo $srn;?>" onclick="qty_parameter(<?php echo $srn;?>)" disabled="" style="padding-bottom: 0px;padding-top: 0px;">Quality Parametr </button>

                        <div id="cancelQpbtn<?php echo $srn;?>"></div>
                        <div id="appliedQpbtn<?php echo $srn;?>"></div>
                        
                        <div id="qpApplyOrNot<?php echo $srn;?>" class="aplynotStatus">0</div>

                        <small id="qPnotfountbtn<?php echo $srn;?>" class="label label-danger"></small>

                        <!-- tax modal -->

                        <div class="modal fade" id="tds_rate_model<?php echo $srn;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-5"><div class="form-group"><lable class="settaxcodemodel col-md-4" style="padding: 0px;">Tax Code - </lable><input type="text" class="settaxcodemodel col-md-7" id="tax_code<?php echo $srn;?>" style="border: none; padding: 0px;" readonly></div></div><div class="col-md-6"><h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation</h5></div><div class="col-md-1"></div></div> </div><div class="modal-body table-responsive"><div class="modalspinner hideloaderOnModl"></div><div class="boxer" id="tax_rate_<?php echo $srn;?>"> </div></div><div class="modal-footer"><center><span  id="footer_tax_btn<?php echo $srn;?>" style="width: 10px;"></span></center></div></div></div></div>

                        <!-- tax modal -->

                        <!-- quality para modal -->

                          <div class="modal fade" id="quality_parametr<?php echo $srn;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><input type="hidden" id="itmOnQp<?php echo $srn;?>"><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel">Qaulity Parameter</h5></div></div></div><div class="modal-body table-responsive"><div class="boxer" id="qua_par_<?php echo $srn;?>"></div></div><div class="modal-footer"><center><small style="text-align: center;" id="footerqp_ok_btn<?php echo $srn;?>"></small><small style="text-align: center;" id="footerqp_quality_btn<?php echo $srn;?>"></small></center></div></div></div></div>

                        <!-- quality para modal -->

                        <!-- tax show by itm modal -->

                        <div id="taxSelectModel<?php echo $srn;?>" class="modal fade" tabindex="-1"><div class="modal-dialog modal-sm" style="margin-top: 13%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"><h5 class="modal-title modltitletext" id=""  style="font-weight: 800;">Select Tax Code</h5></div></div></div><div class="modal-body table-responsive"><div id="showtaxcodeMul<?php echo $srn;?>" style="line-height: 23px;text-align: initial;"></div></div> <div class="modal-footer" style="text-align: center;" id="taxCodeSelect<?php echo $srn;?>"><button type="button" class="btn btn-primary" data-dismiss="modal" onclick="taxIntaxrate(<?php echo $srn;?>);" style="width: 83px;">Ok</button></div> </div></div></div>

                        <!-- tax show by itm modal -->

                      </td>

                    </tr>



                  <?php $srn++;} ?>

                
                </table>

              </div><!-- ./div table -->

               <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">

              <div class="row" style="display: flex;">

                <div class="col-md-6"></div>

                <div class="col-md-4 toalvaldesn">

                  <div class="totlsetinres">Basic Total :</div>

                </div>

                <div class="col-md-1">

                  <input type="hidden" id="allgetMCount" name="getdatacount">

                  <input class="credittotldesn inputboxclr" type="text" name="TotalBasciAmt" value="<?php echo number_format($basicTotal,2);?>" id="basicTotal" readonly="" style="margin-top: 3px;">

                </div>

                <div class="col-md-1"></div>

              </div> <!-- ./ row -->

              <div class="row" style="display: flex;">

                <div class="col-md-6"></div>

                <div class="col-md-4 toalvaldesn">

                  <div class="totlsetinres">Other Total :</div>

                </div>

                <div class="col-md-1">

                  <input class="credittotldesn inputboxclr" type="text" name="TotalOtherAmt" id="otherTotalAmt" value="<?php echo  number_format($otherTotal,2);?>" readonly="" style="margin-top: 3px;">

                </div>

                <div class="col-md-1"></div>

              </div> <!-- ./row -->

              <div class="row" style="display: flex;">

                <div class="col-md-6"></div>

                <div class="col-md-4 toalvaldesn">

                  <div class="totlsetinres">Grand Total :</div>

                </div>

                <div class="col-md-1">

                  <input class="credittotldesn inputboxclr" type="text" name="TotalGrandAmt" value="<?php echo number_format($grandTotal,2);?>" id="allgrandAmt" readonly="" style="margin-top: 3px;">

                </div>

                <div class="col-md-1"></div>

              </div> <!-- ./row -->
              <input type="hidden" id="checkitm">
              <input type="hidden" id="itmaftercheck">

              <br>

              <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

              <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

              <p class="text-center">

                <button class="btn btn-success" type="button" id="submitdata" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

              </p>

       
            </form>

          </div><!-- /.box-body -->

        </div>

      </div>

    </div>

  </section>

</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script>
<script src="{{ URL::asset('public/dist/js/viewjs/goodRecieptNote.js') }}" ></script>

<script type="text/javascript">

  function plantCode(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var Plant_code =  $('#Plant_code').val();
        //console.log(Plant_code);
          $.ajax({

            url:"{{ url('get-pfct-code-name-by-plant-indend') }}",

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
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctCode').val(pfctget);
                       $('#getStateByPlant').val(statec);
                    }else{
                      $('#profitctrId').val(data1.data[0].pfct_code);
                      $('#profitText').val(data1.data[0].pfct_name);
                      $('#getPfctCode').val(data1.data[0].pfct_code);
                      $('#getStateByPlant').val(data1.data[0].state);
                    }

                }

            }

          });

  }

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

                  if(data1.statebyAcc == ''){

                  }else{
                    $('#stateOfAcc').val(data1.statebyAcc);
                  }


                }

            }

          });

   }

    $( window ).on( "load", function() {

      var poNum = $('#purOrdervrno').val();



        var totl = $('#countget').val();
        for(var i=0;i<totl;i++){

          var q = i+1;

          if(poNum){
            $('#Item_CodeId'+i).removeClass('itmbyQc');
            $('#ItemCodeId'+i).css('display','none');
          }else{
            $('#Item_CodeId'+i).addClass('itmbyQc');
            $('#ItemCodeId'+i).css('display','block');
          }

          var batch_No= $('#batch_No'+q).val();
          var ItemCode= $('#itmC_code'+q).val();

          if(ItemCode){
            $('#CalcTax'+q).prop('disabled',false);
            $('#qua_paramter'+q).prop('disabled',false);
          }

          if(batch_No){
            $('#hsbatchno'+q).removeClass('hidebatchnoinput');
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

            data: {ItemCode:ItemCode,q:q},

              success:function(data){

                var data1 = JSON.parse(data);

                var uniq_p = data1.qcount;

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                    if(data1.data==''){
                    
                    }else{

                      $('#Cfactor'+uniq_p).val(data1.data[0].aum_factor);

                      $('#viewItemDetail'+uniq_p).removeClass('showdetail');
                     
                    } 

                    if(data1.aumList==''){

                    }else{
                        
                      $("#aumList"+uniq_p).empty();

                      $.each(data1.aumList, function(k, getAum){

                        $("#aumList"+uniq_p).append($('<option>',{

                          value:getAum.aum,
                          'data-xyz':getAum.um_name,
                          text:getAum.um_name

                        }));

                      });

                    }

                } /*if close*/

              }  /*success function close*/

          });  /*ajax close*/

          plantCode();
          getpurOrderNum();



        }
    });
  

  

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

    
    if(taxOnModel == ''){

      var tax_code = $('#taxByItem'+taxid).val();
      var poHeadId  = $('#po_headid'+taxid).val();
      var PoBodyId  = $('#po_bodyid'+taxid).val();
      var itemCodebypo = $('#Item_CodeId'+taxid).val();
      var itemCodeId = $('#ItemCodeId'+taxid).val();

      if(itemCodebypo){
        var itemCode = itemCodebypo;
      }else if(itemCodeId){
        var itemCode =itemCodeId;
      }


      $.ajax({

              url:"{{ url('get-a-field-calc-for-grn') }}",

              method : "POST",

              type: "JSON",

              data: {tax_code: tax_code,poHeadId:poHeadId,PoBodyId:PoBodyId,itemCode:itemCode},

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

                            var datacount = data1.data.length;

                            dataI = datacount;

                            $('#data_count'+taxid).val(datacount);

                            if ((getData.rate_index == null && getData.tax_rate == null) || getData.rate_index == null || getData.tax_rate == null || (getData.rate_index == '-' && getData.tax_rate == '---')  || getData.rate_index == '-' || getData.tax_rate == '---') {

                              $('#tax_code'+taxid).val(getData.tax_code);

                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly> <input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.tax_ind_code+"> </div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''></div></div>";

                            }else{

                                if(getData.tax_ind_name == 'GrandTotal'){

                                  var classname = 'grandTotalGet';

                                }else{

                                  var classname = '';

                                }
                                console.log('getData.tax_gl_code',getData.tax_gl_code);
                                if(getData.tax_gl_code==null){
                                  var taxglc ='';
                                }else{
                                  var taxglc = getData.tax_gl_code;
                                }

                                if(getData.tax_amt){
                                  var taxAmt =getData.tax_amt
                                }else{
                                  var taxAmt ='';
                                }
                                //console.log('rate',javascript_array);
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.tax_ind_code+"></div><div class='box10 rateIndbox'> <input type='text' class='form-control' name='rate_ind[]' value='"+getData.rate_index+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+"); '> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a> </div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.tax_rate+"' class='form-control' oninput='getGrandTotal("+taxid+");' ></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+taxAmt+"' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+getData.tax_logic+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+getData.static+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+taxglc+"'></div></div> <div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->rt_value ?>'>&nbsp;&nbsp;<?php echo $key->rt_value ?> - <?php echo $key->rate_name ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+"); '>Apply</button></div></div></div></div>";

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

                         if(butn != 'Ok' || butn =='undefined'){

                          var tblData = "<button type='button' class='btn btn-primary ' style='width: 10%;' data-dismiss='modal' id='ApplyOkbtn"+taxid+"' onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",1);'>Ok</button>";

                            $('#footer_tax_btn'+taxid).append(tblData);

                            /*var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'  onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",0);'>Cancel</button>";
                             
                           $('#footer_ok_btn'+taxid).append(cancelfooter);*/

                         }else{

                         }

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


  function getGrandTotal(getid){

    setTimeout(function() {

      $('.modalspinner').addClass('hideloaderOnModl');

      totalAmount = 0;

      qunatity = $("#qty"+getid).val();

      for(l=2;l<=12;l++){

        rate = $("#rate_"+getid+"_"+l).val();   

        indicator = $("#indicator_"+getid+"_"+l).val();

        logic = $("#logic_id_"+getid+"_"+l).val();

        static = $("#static_id_"+getid+"_"+l).val();

        if(logic == null){

        }else{ 

          if(logic.length >0){

            indicatorCalculation(indicator,rate,logic,l,getid);

          }

        }

        if(static == 0){

            $("#indicator_"+getid+"_"+l).prop('readonly',true);

            $("#rate_"+getid+"_"+l).prop('readonly',false);

            $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',false);

            $("#changeInd_"+getid+"_"+l).removeClass('showind_Ch');

            

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

      //$("#total_cramount").val(parseFloat(totalAmount));

    //$("#temp_cramount").val(Math.round(parseFloat(totalAmount))); 

  } /*function close*/

  function indicatorCalculation(indicator,rate,logic,l,incNum){

    var totalLogicVal = 0;
    var indicatorMAmt;

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


      console.log('totalLogicVal',totalLogicVal);
    //$("#FirstBlckAmnt_"+incNum+"_"+l).val(0);

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
         console.log('indicatorMAmt1',indicatorMAmt1);
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

  } /*function close*/

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

    var ItemCodeOnQp = $("#itmOnQp"+qty).val();

    if(ItemCodeOnQp == ''){
      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/get-qty-parameter-frm-purchase-order-by-itm') }}",

            data: {itemCode:itemCode,poHeadId:poHeadId,poBodyId:poBodyId}, // here $(this) refers to the ajax object not form

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


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div><div class='box10 amountBox'>VendorQcValue</div><div class='box10 amountBox'>ActualQcValue</div><div class='box10 amountBox'>ThirdPartyQcValue</div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);

                        var sr_no=1;
                          $.each(data1.data, function(k, getData) {

                            if(data1.item_code){
                              var item_code = data1.item_code;
                            }else if(getData.item_code){
                               var item_code = getData.item_code;
                            }

                            $('#itmOnQp'+qty).val(item_code);

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.item_category+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+getData.iqua_char+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_decs_"+qty+"_"+sr_no+"' name='iqua_desc[]' class='form-control inputtaxInd' value="+getData.iqua_desc+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+getData.char_fromvalue+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+getData.char_tovalue+" ></div><div class='box10 amountBox'><input type='text' id='venQcVal_"+qty+"_"+sr_no+"' name='venQcVal[]' class='form-control rightcontent' value='' ></div><div class='box10 amountBox'><input type='text' id='actualQcVal_"+qty+"_"+sr_no+"' name='actualQcVal[]' class='form-control rightcontent' value='' ></div><div class='box10 amountBox'><input type='text' id='thirdPartyQcVal_"+qty+"_"+sr_no+"' name='thirdPartyQcVal[]' class='form-control rightcontent' value='' ></div></div>";

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

  }  /* ./ quality Paramter*/


  function changeAum(aumid){

    var itmfrmpo =  $('#Item_CodeId'+aumid).val();
    var Itemfrmitm =  $('#ItemCodeId'+aumid).val();
    if(itmfrmpo){
      var ItemCode = itmfrmpo;
    }else if(Itemfrmitm){
      var ItemCode = Itemfrmitm;
    }
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
                //console.log('factor',data1.data[0].aum_factor);
                 $('#Cfactor'+aumid).val(data1.data[0].aum_factor);
                
                 var calAqty = parseFloat(qty) * parseFloat(data1.data[0].aum_factor);

                 //console.log('calAqty',calAqty);

                 $('#A_qty'+aumid).val(calAqty.toFixed(3));
            }
         
          }

    });
  }


  function ItemCodeGet(ItemId){

    $("#HsnSameShow"+ItemId).modal({
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
      console.log(ItemCode);

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

        $('#viewItemDetail'+ItemId).removeClass('showdetail');

         document.getElementById("Item_Name_id"+ItemId).value = msg;

        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide');  
         $('#itemNameTooltip'+ItemId).html(msg);

         $('#tolranceshow'+ItemId).removeClass('tolrancehide');

         $('#tolranceshow'+ItemId).prop('disabled',true);

         $('#qty'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false);  

         $('#party_ref_date').prop('disabled',true);

         var cnclbtn ='<input type="hidden" value="'+0+'" id="tolcvalue"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';


         $('#cancelbtolrntn'+ItemId).html(cnclbtn);

         $('#itmC_code'+ItemId).val(ItemCode);

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

                      $('#UnitM'+ItemId).val(data1.data[0].um_code);

                      $('#AddUnitM'+ItemId).val(data1.data[0].aum);

                      $('#Cfactor'+ItemId).val(data1.data[0].aum_factor);

                    }

                    //console.log('data1.data_hsn',data1.data_hsn);
                    if(data1.data_hsn==''){
                      var hsnCode= '';
                      var shHCode= '';
                      $('#hsn_code'+ItemId).val(hsnCode);
                      $('#showHsnCd'+ItemId).html(shHCode);
                    }else{
                      $('#hsn_code'+ItemId).val(data1.data_hsn.hsn_code);
                      $('#showHsnCd'+ItemId).html('HSN No : '+data1.data_hsn.hsn_code);

                      $('#TolranceIndex'+ItemId).html('TOL. INDEX : '+data1.data_hsn.tolerance_basis);

                      var batchCheck = data1.data_hsn.batch_check;

                      if(batchCheck == 'YES'){
                         var barctRefNo = data1.data_hsn.batch_refrence;
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

                      $('#TolranceRate'+ItemId).html('TOL. RATE : '+data1.data_hsn.tolerance_qty);

                      $('#tolerence_rate'+ItemId).html('<input type="text" name="tolerenc[]"  style="width: 60px;height:22px;" value="'+data1.data_hsn.tolerance_qty+'">');
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

                          value:getAum.aum,

                          'data-xyz':getAum.um_name,
                          text:getAum.um_name

                        }));

                      });

                    }

                    if(taxCode){

                      if(data1.data_tax == ''){
                          
                          $('#taxByItem'+ItemId).val('');
                      }else{

                        var taxByhsn = data1.data_tax[0].tax_code;

                        if(taxCode != data1.data_tax[0].tax_code){
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

                        var taxData = '<input type="radio" class="taxcodeset" id="html" name="taxcodeit" value="'+gettax.tax_code+'"><label for="html">'+gettax.tax_code+'</label><br>';
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
                      $('#taxratebytax'+trateid).val(data1.data[0].tax_code);
                      
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


  function calculateBasicAmt(rateid){
    $('#aplytaxOrNot'+rateid).html('0');
    var qunatity = parseFloat($('#qty'+rateid).val());

      var rate = parseFloat($('#rate'+rateid).val());
      var qnrate = parseFloat($('#qnrate'+rateid).val());

      var chckitms = $('#itmCountchk').val();

      if(rate > qnrate){
        $('#greaterRateShModel'+rateid).modal('show');
        $('#rate'+rateid).val(qnrate);
        var basicAmts = qunatity * qnrate;
        $('#basic'+rateid).val(basicAmts.toFixed(2));

        $('#data_count'+rateid).val(0);
        $('#get_grand_num'+rateid).val('');
        $('#aplytaxOrNot'+rateid).html('0');

        $('#appliedbtn'+rateid).html('');
         
           var cnclbtn ='<input type="hidden" value="0" id="qltyvalue'+rateid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelbtn'+rateid).html(cnclbtn);
      }else{

        if(rate){

          if(chckitms == 1){
            $('#addmorhidn').prop('disabled',true);
          }else{
            $('#addmorhidn').prop('disabled',false);
          }
        
          var result = qunatity * rate;

          /* x=result.toString();
            var lastThree = x.substring(x.length-3);
            var otherNumbers = x.substring(0,x.length-3);
            if(otherNumbers != '')
                lastThree = ',' + lastThree;
            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree;*/


         // console.log('res',res);
          $('#basic'+rateid).val(result.toFixed(2));

          $('#CalcTax'+rateid).prop('disabled',false);
          $('#submitdata').prop('disabled',false);
          $('#addmorhidn').prop('disabled',false);
          $('#deletehidn').prop('disabled',false);

          var rowcount = $('#data_count'+rateid).val();

          if(rowcount !=0){
            $('#data_count'+rateid).val(0);
            $('#get_grand_num'+rateid).val('');

            $('#appliedbtn'+rateid).html('');
           
             var cnclbtn ='<input type="hidden" value="0" id="qltyvalue'+rateid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

            $('#cancelbtn'+rateid).html(cnclbtn);

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

        }else{

          $('#basic'+rateid).val('');

          $('#CalcTax'+rateid).prop('disabled',true);
          $('#submitdata').prop('disabled',true);

        }

      }

      

      var total =0;

      //var basicAmnt = $('#basic'+rateid).val();
      //console.log(basicAmnt);
      $(".basicamt").each(function () {
          console.log(this.value);
        //add only if   the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            total += parseFloat(this.value);

        }

      $("#basicTotal").val(total.toFixed(2));

      });

      var grTotal =0;

      $(".setGrandAmnt").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {
            grTotal += parseFloat(this.value);
        }

        $("#allgrandAmt").val(grTotal.toFixed(2));

      }); 

  }

  function OkGetGransVal(aplyid,datacount,countercount,staticvalue){

      if(staticvalue==1){

          $('#aplytaxOrNot'+aplyid).html('1');
        
          $('#cancelbtn'+aplyid).html('');
          $('#appliedbtn'+aplyid).html('');

          var appliedbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';

          $('#appliedbtn'+aplyid).html(appliedbtn);

          $('#data_count'+aplyid).val(datacount);

         if(countercount == datacount){
            var g_Amnt = $('#FirstBlckAmnt_'+aplyid+'_'+countercount).val();
            $('#get_grand_num'+aplyid).val(g_Amnt);
          }
          
        //  $('#submitdata').prop('disabled', false);
         // $('#cancelbtn'+getvalue).html('');

      
      }else{
         $('#aplytaxOrNot'+aplyid).html('0');
         $('#cancelbtn'+aplyid).html('');
         $('#appliedbtn'+aplyid).html('');
         
         var cnclbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelbtn'+aplyid).html(cnclbtn);
        $('#data_count'+aplyid).val(0);
        $('#get_grand_num'+aplyid).val('');
        
          //$('#appliedbtn'+getvalue).html('');
       // $('#submitdata').prop('disabled', true);
         
      }

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

      var grandTotal = parseFloat($('#allgrandAmt').val());

      var basicTotal = parseFloat($('#basicTotal').val());

       if(grandTotal == '0.00'){
          var othrAmt = 0;
          $('#otherTotalAmt').val(othrAmt.toFixed(2));
          $('#CalPayTerms').prop('disabled',true);
        }else{
          var otherTotal = grandTotal - basicTotal;
          $('#otherTotalAmt').val(otherTotal.toFixed(2));

        }

  }

</script>

@endsection