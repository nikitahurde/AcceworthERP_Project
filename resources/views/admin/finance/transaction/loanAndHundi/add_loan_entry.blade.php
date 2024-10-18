@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

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
  .showSeletedName{
    font-size: 12px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  table {
      border-collapse: collapse;
  }
  .table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }
  .table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
  }
  .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #dee2e6;
  }
  .table td, .table th {
    padding: .75rem;
    vertical-align: top;
  }
  .inputboxclr{
    border: 1px solid #d7d3d3;
    width: 100%;
    margin-bottom: 2px;
  }
  .tdthtablebordr{
    border: 1px solid #00BB64;
  }
  .space{margin-bottom: 2px;}
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 3px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #00a65a;
    text-align: center;
  }
  .totlLable{
    width: 6%;
    text-align: center;
    margin-top: 7px;
    font-weight: 700;
  }
  .numberRight{
    text-align:right;
  }
  .showhideCls{
    display:none;
  }
  .amountIndBox{
    width:20%;
    text-align: right;
  }
  .modltitletext{
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .irrCalTbl th{
    padding:1px;
    border: 1px solid lightgrey;
  }
  .irrCalTbl td{
    padding: 0px;
    text-align: initial;
  }
  .cashFlowTbl td{
    padding: 1px;
    text-align: initial;
    border: 1px solid lightgray;
  }
  .cashFlowTbl th{
    padding: 1px;
    text-align: initial;
    border: 1px solid lightgray;
  }
  .showIRRCal{
    display:none;
  }
  .irrCalInut{
    border: none;
    padding: 0;
    text-align:end;
    width: 100%;
  }
  .firstColIrr{
    width:60%;
  }
  .secColIrr{
    width:20%;
  }
  .thirdColIrr{
    width:20%;
  }

</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Loan & Hundi
      <small>Loan & Hundi Transaction Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transation </a></li>
      <li class="active"><a href="{{ url('/form-inward-trans') }}">Loan & Hundi </a></li>
      <li class="active"><a href="{{ url('/form-inward-trans') }}">Add Loan & Hundi</a></li>

    </ol>

  </section>

<form id="loanEntry"> 
  @csrf

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle formTitle" style="font-weight: 800;color: #5696bb;">Add Loan & Hundi</h2>

        <div class="box-tools pull-right">

          <a href="{{ url('transaction/c-and-f/view-inward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View Loan & Hundi</a>

        </div>

      </div><!-- /.box-header -->

        <div class="box-body">

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Date : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>

                    <?php 

                        $CurrentDate =date("d-m-Y");
                           
                        $FromDate    = date("d-m-Y", strtotime($fromDate));  
                           
                        $ToDate      = date("d-m-Y", strtotime($toDate));  
                           
                        $spliDate    = explode('-', $CurrentDate);
                           
                        $yearGet     = Session::get('macc_year');
                           
                        $fyYear      = explode('-', $yearGet);
                           
                        $get_Month   = $spliDate[1];
                        $get_year    = $spliDate[2];

                        if($get_Month >3 && $get_year == $fyYear[1]){
                            $vrDate = $ToDate;
                        }else{
                            $vrDate = $CurrentDate;
                        }

                    ?>

                    <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
                    <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
                    <input type="text" name="transaction_date" id="transaction_date" class="form-control transdatepicker" placeholder="Enter Date" value="{{$vrDate}}">

                  </div>
                  <small id="showmsgfordate"></small>

                </div><!-- /.form group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>

                   Tran Code : 

                    <span class="required-field"></span>

                  </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="text" class="form-control" name="tran_code" value="{{$tranCode}}" placeholder="Enter Tran Code" maxlength="15" readonly id="tran_code">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>

                   Series Code : 

                    <span class="required-field"></span>

                  </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input list="seriesList" class="form-control" name="series_code" value="" placeholder="Enter Series Code" maxlength="15" id="series_code" autocomplete="off" onchange="getvrnoBySeries();">

                      <datalist id="seriesList">
                          <?php foreach ($seriesList as $key) { ?>

                          <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>
                            
                          <?php   } ?>
                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">
              
                  <label> Vr No: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                  
                    <input type="text" class="form-control rightcontent" name="vr_no" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off" >

                  </div>

                </div> <!-- /.form-group -->

              </div> <!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>

                   Interest Income Gl Code: 

                    <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                    <input list="glList" class="form-control" name="int_inc_code" value="" placeholder="Enter Gl Code" maxlength="15" readonly id="int_inc_code">

                    <datalist id="glList">
                        <?php foreach ($glList as $key) { ?>

                        <option value='<?php echo $key->GL_CODE?>'   data-xyz ="<?php echo $key->GL_NAME; ?>" ><?php echo $key->GL_NAME ; echo " [".$key->GL_CODE."]" ; ?></option>
                          
                        <?php   } ?>
                    </datalist>

                  </div>

                </div>

              </div><!-- /.col -->
              
              <div class="col-md-2">

                <div class="form-group">

                  <label>

                   Unsecured Loan Gl Code: 

                    <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                    <input list="glList" class="form-control" name="unsecured_loan_code" value="" placeholder="Enter Unsecured Loan Code" readonly maxlength="15" id="unsecured_loan_code">

                    <datalist id="glList">
                        <?php foreach ($glList as $key) { ?>

                        <option value='<?php echo $key->GL_CODE?>'   data-xyz ="<?php echo $key->GL_NAME; ?>" ><?php echo $key->GL_NAME ; echo " [".$key->GL_CODE."]" ; ?></option>
                          
                        <?php   } ?>
                    </datalist>

                  </div>

                </div>

              </div><!-- /.col -->

            </div><!-- /.row -->

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label>

                   Acc Code : 

                    <span class="required-field"></span>

                  </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input list="accList" class="form-control" name="acc_code" value="" placeholder="Enter Acc Code" maxlength="15" id="acc_code">

                      <datalist id="accList">
                          <?php foreach ($accList as $key) { ?>

                          <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>
                            
                          <?php   } ?>
                      </datalist>

                    </div>  
                    <input type="hidden" name="acc_Gl" id="acc_Gl">
                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>

                   Acc Name : 

                    <span class="required-field"></span>

                  </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="text" class="form-control" name="acc_name" value="" placeholder="Enter Acc Name" maxlength="15" id="acc_name" readonly>

                    </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Loan Amt : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="loan_amt" value="" id="loan_amt" placeholder="Enter Loan Amt" autocomplete="off">

                    </div>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Tenure (Month) : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="tenure" value="" id="tenure" placeholder="Enter Tenure" oninput="addMonths()" autocomplete="off">

                    </div>

                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Maturity Date : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="maturity_date" value="" id="maturity_date" placeholder="Enter Maturity Date" readonly autocomplete="off">

                    </div>

                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Interest Rate (Yr) : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input list="vehicleList" id="interest_rate" name="interest_rate" class="form-control  pull-left" value="" placeholder="Enter Interest Rate" autocomplete="off">

                  </div>

                </div>

              </div><!-- /.col --> 

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">NPV Rate : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="NPV_rate" name="NPV_rate" class="form-control  pull-left" value="" placeholder="Enter NPV Rate" autocomplete="off">

                  </div>

                </div>

              </div><!-- /.col --> 

              <div class="col-md-2">

                <div class="form-group">

                  <label>Interest Ind: <span class="required-field"></span></label>

                   <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <select name="interest_Ind" id="" style="width: 100%;border-color: #d4d4d4;">
                      <option value="">--select--</option>
                      <option value="YEARLY">Yearly</option>
                      <option value="HALF_YEARLY">Half Yearly</option>
                      <option value="QUARTERLY">Quarterly</option>
                      <option value="MONTHLY">Monthly</option>
                    </select>

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Interest Amt (Monthly): <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="interestAmt" name="interestAmt" class="form-control  pull-left" value="" placeholder="Enter Interest Amt" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

                  </div>

                  <small>  
                    <div class="pull-left showSeletedName" id="transText"></div>
                  </small>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Adv Interest Month : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="adv_int_month" name="adv_int_month" class="form-control  pull-left" value="{{ old('adv_int_month')}}" placeholder="Enter Adv Interest Month" autocomplete="off" oninput="this.value = this.value.toUpperCase()">

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Adv Interest Amt : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="adv_int_amt" name="adv_int_amt" class="form-control  pull-left" value="{{ old('adv_int_amt')}}" placeholder="Enter Adv Interest Amt" autocomplete="off" oninput="this.value = this.value.toUpperCase()" readonly>

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Service Charges : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="service_charges" name="service_charges" class="form-control  pull-left" value="{{ old('service_charges')}}" placeholder="Enter Service Charges" autocomplete="off" oninput="this.value = this.value.toUpperCase()">

                  </div>

                </div>

              </div><!-- /.col -->
              
            </div><!-- /.row -->

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">SR Code : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input list="srList" id="sr_code" name="sr_code" class="form-control  pull-left" value="{{ old('sr_code')}}" placeholder="Enter SR Code" oninput="this.value = this.value.toUpperCase()">

                    <datalist id="srList">
                      <?php foreach ($SRList as $key) { ?>

                        <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>
                          
                      <?php   } ?>
                    </datalist>

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">SR Name : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="sr_name" name="sr_name" class="form-control  pull-left" value="{{ old('sr_name')}}" placeholder="Enter SR Name" oninput="this.value = this.value.toUpperCase()" readonly>

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">CP Code : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input list="cpList" id="cpCode" name="cp_code" class="form-control  pull-left" value="{{ old('cp_code')}}" placeholder="Enter CP Code" oninput="this.value = this.value.toUpperCase()">

                    <datalist id="cpList">
                      <?php foreach ($CPList as $key) { ?>

                        <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>
                          
                      <?php   } ?>
                    </datalist>

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">CP Name : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="cp_name" name="cp_name" class="form-control  pull-left" value="{{ old('cp_name')}}" placeholder="Enter CP Name" autocomplete="off" oninput="this.value = this.value.toUpperCase()" readonly>

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Brokerage Rate : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="brokeragerate" name="brokerage_rate" class="form-control  pull-left" value="{{ old('cp_rate')}}" placeholder="Enter Brokerage Rate" oninput="this.value = this.value.toUpperCase()">

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Brokerage Amt : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="brokerage_amt" name="brokerage_amt" class="form-control  pull-left" value="{{ old('cp_amt')}}" placeholder="Enter Brokerage Amt" oninput="this.value = this.value.toUpperCase()" readonly>

                  </div>

                </div>

              </div><!-- /.col -->
              
            </div><!-- /.row -->

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Rebate Rate : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="rebaterate" name="rebaterate" class="form-control  pull-left" value="{{ old('rebaterate')}}" placeholder="Enter Rebate Rate" oninput="this.value = this.value.toUpperCase()">

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Rebate Amt : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="rebateamt" name="rebateamt" class="form-control pull-left" value="{{ old('rebateamt')}}" placeholder="Enter Rebate Amt" oninput="this.value = this.value.toUpperCase()" readonly>

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2" >

                <div class="form-group">

                  <label for="exampleInputEmail1">&nbsp;</label>

                  <div class="input-group">

                    <input type="checkbox" id="brokerageJV" class="optionsRadios1 transType" name="brokerageJV" value="BROKERAGE_JV" >&nbsp;Brokerage JV &nbsp;
                  </div>
                  <input type="hidden" name="chkBrokerageJV" id="chkBrokerageJV" value="">
                  <input type="hidden" name="isBrokeargeChk" id="isBrokeargeChk" value="">
                </div>

              </div><!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">

                  <label for="exampleInputEmail1">&nbsp;</label>

                  <div class="input-group">

                    <input type="radio" class="optionsRadios1 transType" name="adv_int_jv" value="ADV_INT_JV" checked="">&nbsp;Adv Interest JV &nbsp;
                    <input type="radio" class="optionsRadios1 transType" name="adv_int_jv" value="INT_PMT_SCH" >&nbsp;&nbsp;Interest pmt Sch &nbsp;&nbsp;

                  </div>

                </div>

              </div><!-- /.col -->

            </div><!-- /.row -->

            <div style="text-align: center;">
            
              <button type="button" disabled class="btn btn-primary btn-xs btnstyle" onclick="proceedInfo();" id="proceedBtn">Proceed</button>

            </div>

        </div><!-- /.box-body -->

    </div><!-- /. custom box -->

  </section><!-- /.section -->

  <section class="content showIRRCal" id="iRRCalSection" style="margin-top: -4%;margin-bottom: 15px;">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <div class="row">

              <div class="col-md-3"></div>
              <div class="col-md-6">
                
                <h5 class="modal-title modltitletext" id="" style="font-weight: 800;">IRR Calculation</h5>

                <div class="table-responsive">

                  <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                    <tr>
                      <td style="width:70%">
                        <table class="irrCalTbl" style="width:100%;">
                          <tr>
                            <th colspan="2">Net IRR</th>
                            <th>30.3099</th>
                          </tr>
                          <tr>  
                            <th colspan="2">Yield</th>
                            <th>34.8881</th>
                          </tr>
                          <tr>  
                            <th>NPV</th>
                            <th><div id="npv_irr"></div></th>
                            <th>34.8881</th>
                          </tr>
                          <tr>  
                            <th colspan="3">&nbsp;</th>
                          </tr>
                          <tr>
                            <th>Description</th>
                            <th>Rate</th>
                            <th>Amount</th>
                          </tr>
                          <tr>
                            <td><b>Basic Details</b></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="firstColIrr">Financed Amount</td>
                            <td class="secColIrr">&nbsp;</td>
                            <td class="thirdColIrr"><input type="text" id="fiancanAmt" class="irrCalInut" name="" value="" readonly></td>
                          </tr>
                          <tr>
                            <td class="firstColIrr">Rate Of Interest</td>
                            <td class="secColIrr"><input type="text" id="rateOfInt" class="irrCalInut" name="" value="" readonly></td>
                            <td class="thirdColIrr">&nbsp;</td>
                          </tr>
                          <tr>
                            <td class="firstColIrr">Tenure (Period - Months)</td>
                            <td class="secColIrr"><input type="text" id="tenureMonth" class="irrCalInut" name="" value="" readonly></td>
                            <td class="thirdColIrr"><input type="text" id="tenureAmt" class="irrCalInut" readonly></td>
                          </tr>
                          <tr>
                            <td class="firstColIrr">EMI Amount</td>
                            <td class="secColIrr">&nbsp;</td>
                            <td class="thirdColIrr"><input type="text" id="emiAmt" class="irrCalInut" name="EMIAmount" readonly></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3"><b>Addition (If Any)</b></td>
                          </tr>
                          <tr>
                            <td class="firstColIrr">Service Charges %</td>
                            <td class="secColIrr"><input type="text" id="serviceCharge" class="irrCalInut" name="" value="" readonly></td>
                            <td class="thirdColIrr"><input type="text" id="service_Amt" class="irrCalInut" name="serviceAmount" value="" readonly></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="3"><b>Deduction (If Any)</b></td>
                          </tr>
                          <tr>
                            <td class="firstColIrr">Advance EMI</td>
                            <td class="secColIrr"><input type="text" id="adv_EMI_Rate" class="irrCalInut" name="" value="" readonly></td>
                            <td class="thirdColIrr"><input type="text" id="adv_EMI_Amt" class="irrCalInut" name="" value="" readonly></td>
                          </tr>
                          <tr>
                            <td class="firstColIrr">Brokerage %</td>
                            <td class="secColIrr"><input type="text" id="broker_Rate" class="irrCalInut" name="" value="" readonly></td>
                            <td class="thirdColIrr"><input type="text" id="broker_amt" class="irrCalInut" name="" value="" readonly></td>
                          </tr>
                          <tr>
                            <td class="firstColIrr">Rebate %</td>
                            <td class="secColIrr"><input type="text" id="rebate_Rate" class="irrCalInut" name="" value="" readonly></td>
                            <td class="thirdColIrr"><input type="text" id="rebate_amt" class="irrCalInut" name="" value="" readonly></td>
                          </tr>
                          
                        </table>
                      </td>
                      <td style="width:30%">
                        <table class="cashFlowTbl" id="cashFlowData" style="width:100%;">
                         
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
                        <table class="cashFlowTbl" id="cashFlowFooter" style="width: 100%;">
                          
                        </table>
                      </td>
                    </tr>
                  </table>
                  
                </div><!-- /.table-resonsive -->

              </div>
              <div class="col-md-3"></div>
              
            </div><!-- /.row -->

            <div style="text-align: center;">

              <input type="hidden" name="donwloadStatus" id="pdfYesNoStatus" value="">

              <button type="button" class="btn btn-primary btn-xs btnstyle" id="simulation_btn" data-toggle="modal" data-target="#simulation_model" onclick="simulationcal(1);">Simulation</button>

              <button type="button" class="btn btn-success" onclick="submitLoanHundiTrans(0);"> <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save </button>

              <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

              <button type="button" class="btn btn-success" onclick="submitLoanHundiTrans(1);"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>

            </div>
            
          </div><!-- /.box-body -->
          
        </div><!-- /.Custom-Box -->
        
      </div><!-- /.col -->
      
    </div><!-- /.row -->
    
  </section><!-- /.section -->

</form>

</div><!-- /.content-wrapper -->


<!------- MODAL FOR SIMULATION ------------>

    <div class="modal fade in" id="simulation_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">

      <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">

        <div class="modal-content" style="border-radius: 5px;">

          <div class="modal-header">
            <div class="row">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <h5 class="modal-title modltitletext" id="exampleModalLabel">Simulation Of Loan & Hundi</h5>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>

          <div class="modal-body table-responsive">
            <div class="boxer" id="siml_body" style="font-size: 12px;color: #000;width:100%;">
            </div>
          </div>

          <div class="modal-footer">
              <span id="siml_footer1" style="width: 10px;"><button type="button" class="btn btn-primary " style="width: 10%;" data-dismiss="modal">Ok</button></span>
          </div>

        </div>

      </div>

    </div>

<!------- MODAL FOR SIMULATION ------------>

@include('admin.include.footer')


<script type="text/javascript">
  $(document).ready(function(){
      $('.Number').keypress(function (event) {
        var keycode = event.which;
        if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
            event.preventDefault();
        }
    });

    $('#loan_amt,#NPV_rate,#adv_int_month,#adv_int_amt,#rebaterate').on('input',function(){

      var rebateRate = parseFloat($('#rebaterate').val());
      var loanAmt    = parseFloat($('#loan_amt').val());
      var rateOfInt  = parseFloat($('#interest_rate').val());
      var tenureMonth  = parseFloat($('#tenure').val());

      if(rebateRate){
        var rebateAmount = loanAmt * rebateRate /100;
        $('#rebateamt').val(rebateAmount);
      }else{
        $('#rebaterate').val(0);
        $('#rebateamt').val(0);
      }

      var advRate = $('#adv_int_month').val();
      if(advRate){
        var tenureMn = tenureMonth / parseFloat(12);
        var tenureAmt = (loanAmt * rateOfInt /100) * tenureMn;
        
        var emi_Amount=(loanAmt + parseFloat(tenureAmt)) / tenureMonth;
        var emiAmount = Math.round(emi_Amount);
        
        var advIntAmt = emiAmount * advRate;
        $('#adv_int_amt').val(advIntAmt);
      }

      validationCheck();
    });
  });

  function validationCheck(){

    var seriesCd    = $("#series_code").val();
    var accCd       = $("#acc_code").val();
    var loanAmt     = $("#loan_amt").val();
    var tenureMonth = $("#tenure").val();
    var intRate     = $("#interest_rate").val();
    var npvRate     = $("#NPV_rate").val();
    var interestAmt = $("#interestAmt").val();
    var advIntMonth = $("#adv_int_month").val();
    var advIntAmt   = $("#adv_int_amt").val();
    var cpCode      = $("#cpCode").val();

    if(seriesCd){
      $("#series_code").css('border-color','#d4d4d4');
      if(accCd){
        $("#acc_code").css('border-color','#d4d4d4');
        if(loanAmt){
          $("#loan_amt").css('border-color','#d4d4d4');
          if(tenureMonth){
            $("#tenure").css('border-color','#d4d4d4');   
            if(intRate){
              $("#interest_rate").css('border-color','#d4d4d4');
              if(npvRate){
                $("#NPV_rate").css('border-color','#d4d4d4');
                if(interestAmt){
                  $("#interestAmt").css('border-color','#d4d4d4');
                  if(advIntMonth){
                    $("#adv_int_month").css('border-color','#d4d4d4');
                    if(advIntAmt){
                      $("#adv_int_amt").css('border-color','#d4d4d4');
                      if(cpCode){
                        $("#cpCode").css('border-color','#d4d4d4');
                      }else{
                        $("#cpCode").css('border-color','#ff0000');
                      }
                    }else{
                      $("#adv_int_amt").css('border-color','#ff0000');
                    }
                  }else{
                    $("#adv_int_month").css('border-color','#ff0000');
                  }
                }else{
                  $("#interestAmt").css('border-color','#ff0000');
                }
              }else{
                $("#NPV_rate").css('border-color','#ff0000');
              }
            }else{
              $("#interest_rate").css('border-color','#ff0000');
            }
          }else{
            $("#tenure").css('border-color','#ff0000');
          }
        }else{
          $("#loan_amt").css('border-color','#ff0000');
        }
      }else{
        $("#acc_code").css('border-color','#ff0000');
      }
    }else{
      $("#series_code").css('border-color','#ff0000');
    }

    if(seriesCd && accCd && loanAmt && tenureMonth && intRate && npvRate && interestAmt && advIntMonth && advIntAmt && cpCode){

      $('#proceedBtn').prop('disabled',false);
            
    }else{
      $('#proceedBtn').prop('disabled',true);
    }

  }

  function IRRCalc_test(CArray) {

    min = 0.0;
    max = 1.0;
    c=0;
    do {
      guest = (min + max) / 2;
      NPV = 0;
      for (var j=0; j<CArray.length; j++) {
            NPV += CArray[j]/Math.pow((1+guest),j);
      }
      if (NPV > 0) {
        min = guest;
        c++; 
      }
      else {
        max = guest;
        c++;
      }

      if(c>=15){ return guest*100; }
    } while(Math.abs(NPV) > 0.000001);
    return guest*100;
  }

  function proceedInfo(){

    $('#iRRCalSection').removeClass('showIRRCal');

      var loanAmt       = parseFloat($('#loan_amt').val());
      var intRate       = parseFloat($('#interest_rate').val());
      var tenure        = parseFloat($('#tenure').val());
      var serviceCharge = parseFloat($('#service_charges').val());
      var adv_Int_rate  = parseFloat($('#adv_int_month').val());
      var adv_Int_Amt   = parseFloat($('#adv_int_amt').val());
      var brokerageRate = parseFloat($('#brokeragerate').val());
      var brokerageAmt  = parseFloat($('#brokerage_amt').val());
      var npvRate       = parseFloat($('#NPV_rate').val());
      var rebateRate    = parseFloat($('#rebaterate').val());
      var rebateamt     = parseFloat($('#rebateamt').val());

      /* -- SET VALUE ---*/
      $('#fiancanAmt').val(loanAmt);
      $('#rateOfInt').val(intRate);
      $('#tenureMonth').val(tenure);
      $('#npv_irr').html(npvRate);
      $('#rebate_Rate').val(rebateRate);
      $('#rebate_amt').val(rebateamt);
      $('#broker_Rate').val(brokerageRate);
      $('#broker_amt').val(brokerageAmt);
      $('#adv_EMI_Rate').val(adv_Int_rate);
      $('#adv_EMI_Amt').val(adv_Int_Amt);

      var tenureMn = tenure / parseFloat(12);

      var tenureAmt = (loanAmt * intRate /100) * tenureMn;
      $('#tenureAmt').val(tenureAmt);

      var emi_Amount=(loanAmt + parseFloat(tenureAmt)) / tenure;
      var emiAmount = Math.round(emi_Amount);
      $('#emiAmt').val(emiAmount);

      var serviceAmt=0;
      if(serviceCharge){
        $('#serviceCharge').val(serviceCharge);

        var serviceAmt = loanAmt * serviceCharge/100;
        $('#service_Amt').val(serviceAmt);
      }else{
        $('#serviceCharge').val(0);
        $('#service_Amt').val(0);
      }
    

      /* ---- CASH FLOW DATA TABLE ------ */

      var cashFlowAmt = -(loanAmt - adv_Int_Amt - (serviceAmt - brokerageAmt)); 
      var headRow = "<tr><th>Tenure No</th><th>Amount</th></tr><tr><th>Cash Flow</th><th><div id='cashFlowAmt'>"+cashFlowAmt+"</div></th></tr>";
      $('#cashFlowData').append(headRow);

      var getrebateAmt = $('#rebate_amt').val();

      var totCashFlow=0,cashFlow=[];
      for (var i = 1; i <= tenure; i++) {
        if(tenure - adv_Int_rate > i - 1){

          var bodyData ="<tr><td>"+i+"</td><td style='text-align:end;'>"+emiAmount+"</td></tr>";
          totCashFlow = parseFloat(totCashFlow)+parseFloat(emiAmount);

          cashFlow.push(totCashFlow);
          $('#cashFlowData').append(bodyData);
        }else if(tenure == i){
          var bodyData2 = "<tr><td>"+i+"</td><td style='text-align:end;'>"+(-getrebateAmt)+"</td></tr>";
          totCashFlow = parseFloat(totCashFlow)+parseFloat((-getrebateAmt));
          cashFlow.push(totCashFlow);
          $('#cashFlowData').append(bodyData2);
        }else{
          var bodyData3 ="<tr><td>"+i+"</td><td style='text-align:end;'>0</td></tr>";
          totCashFlow = parseFloat(totCashFlow)+0;
          cashFlow.push(totCashFlow);
          $('#cashFlowData').append(bodyData3);
        }
      }

      var footerData ="<tr><th>Total</th><th style='text-align:end;'>"+totCashFlow+"</th></tr>";
      $('#cashFlowFooter').append(footerData);

      /* ---- CASH FLOW DATA TABLE ------ */

     
      irr_arr=[9167, 9167, 9167, 9167,9167,9167,9167,9167,9167,0,0,-2000,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
      irr_res_arr_expected=[0,0,61.8,83.93,92.76,96.6]
      for(i=1;i<=irr_arr.length;i++){
      console.log("irr_arr - ",irr_arr.slice(0,i));
      console.log("IRRCalc - ",IRRCalc_test(irr_arr.slice(0,i)))
      //console.log("irr_expected - ", irr_res_arr_expected[i-1])
      //if(IRRCalc(irr_arr.slice(0,i))===parseFloat(irr_res_arr_expected[i-1]).toFixed(2)){console.log(i,"- TRUE")} else {console.log(i,"- FALSE")}
      }

  }

</script>

<script type="text/javascript">
  
  $(document).ready(function() {

    $( window ).on( "load", function() {

      var fromdateintrans = $('#FromDateFy').val();
      var todateintrans = $('#ToDateFy').val();

      $('.transdatepicker').datepicker({

        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        startDate :fromdateintrans,
        endDate : 'today',
        autoclose: 'true'
      });

    });

    $("#acc_code").bind('change', function () {  

      var accCode = $(this).val();
      var xyz = $('#accList option').filter(function() {
        return this.value == accCode;
      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
     
      if(msg=='No Match'){
        $(this).val('');
        $('#acc_name').val('');
      }else{
        $('#acc_name').val(msg);

        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        $.ajax({

          url:"{{ url('get-grn-no-by-acc-in-purchase-bill') }}",

          method : "POST",

          type: "JSON",

          data: {accCode: accCode},

          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.glFetch == null || data1.glFetch ==''){
                $('#acc_Gl').val('');
              }else{
                if(data1.glFetch.GL_CODE == ''){
                  var glCode ='';
                  var glName ='';
                }else{
                  var glCode =data1.glFetch.GL_CODE;
                  var glName =data1.glFetch.GL_NAME;
                }
                $('#acc_Gl').val(glCode);
                
              }

            } /*if close*/

          }  /*success function close*/

        });  /*ajax close*/
      }  /* /. no match codn*/

      validationCheck();

    });

    $("#sr_code").bind('change', function () {  

      var srCode = $(this).val();
      var xyz = $('#srList option').filter(function() {
        return this.value == srCode;
      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
     
      if(msg=='No Match'){
        $(this).val('');
        $('#sr_name').val('');
      }else{
        $('#sr_name').val(msg);

      }  /* /. no match codn*/

    });

    $("#cpCode").bind('change', function () {  

      var cpCode = $(this).val();
      var xyz = $('#cpList option').filter(function() {
        return this.value == cpCode;
      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
     
      if(msg=='No Match'){
        $(this).val('');
        $('#cp_name').val('');
      }else{
        $('#cp_name').val(msg);

      }  /* /. no match codn*/

    });

    $('#brokeragerate').on('input',function(){
      var loanAmt = $('#loan_amt').val();
      var rate = $(this).val();
      if (rate){
        $('#brokerageJV').prop('checked',true).prop('disabled',true);
        var checkedValue = $('#brokerageJV:checked').val();
        $('#chkBrokerageJV').val(checkedValue);
        $('#isBrokeargeChk').val('YES');

        var brokerAmt = loanAmt * rate /100;
        $('#brokerage_amt').val(brokerAmt);

      
      }else{
        $('#brokerageJV').prop('checked',false).prop('disabled',false);
        $('#chkBrokerageJV').val('');
        $('#isBrokeargeChk').val('NO');
      }
    });

    $('#interest_rate').on('input',function(){

      var loanAmt = parseFloat($('#loan_amt').val());
      var intRate = parseFloat($('#interest_rate').val());

      if(intRate){
        var calIntAmt = (loanAmt * intRate / 100) / 12;
        $('#interestAmt').val(calIntAmt.toFixed(2));

      }else{
        $('#interestAmt').val('0');
      }

      validationCheck();

    });

    /*$('#tenure').on('input',function(){

        var vrDate = $('#transaction_date').val();
        var splitDt = vrDate.split('-');
        var newVrDt = splitDt[1]+'-'+splitDt[0]+'-'+splitDt[2];
        var dateForm = new Date(newVrDt); 
        var Monthget = parseInt($('#tenure').val());

        if(Monthget){

          dateForm.setMonth(dateForm.getMonth() + Monthget);
          console.log('dateForm',dateForm);
          var getdate = dateForm.getDate();
          var getMonth= dateForm.getMonth()+1;
          var getYear = dateForm.getFullYear();

          var matureDt =getYear+'-'+getMonth+'-'+getdate;

          var d = new Date(matureDt);
          var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
          var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

          var formMatureDt =da+'-'+mo+'-'+getYear;
          $('#maturity_date').val(formMatureDt);

        }else{
          $('#maturity_date').val('');
        }
        
    });*/

  });

  function isLeapYear(year) { 
    return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0)); 
  }

  function getDaysInMonth(year, month) {
      return [31, (isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
  }

  function addMonths() {

      var Monthget = parseInt($('#tenure').val());
      if(Monthget){

        var vrDate   = $('#transaction_date').val();
        var splitDt  = vrDate.split('-');
        var newVrDt  = splitDt[1]+'-'+splitDt[0]+'-'+splitDt[2];

        var dateForm = new Date(newVrDt);
        var n = dateForm.getDate();
        dateForm.setDate(1);
        dateForm.setMonth(dateForm.getMonth() + Monthget);
        dateForm.setDate(Math.min(n, getDaysInMonth(dateForm.getFullYear(),dateForm.getMonth())));
        
        var Lyear = dateForm.getFullYear();

        var d = new Date(dateForm);
        var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
        var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

        var formMatureDt =da+'-'+mo+'-'+Lyear;
        $('#maturity_date').val(formMatureDt);

      }else{
        $('#maturity_date').val('');
      }
      
     validationCheck();
  }

  /* ---------- get vrno against series code ------------- */
  
  function getvrnoBySeries(){

    var seriesCd = $('#series_code').val();
    var xyz = $('#seriesList option').filter(function() {
      return this.value == seriesCd;
    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
   
    if(msg=='No Match'){
      $('#series_code').val('');
      $('#vrseqnum').val('');
    }else{

      $('#series_code').val(seriesCd+'('+msg+')');

      var series_Code = $('#series_code').val();
      var splitSeries = series_Code.split('(');
      var seriesCode  = splitSeries[0];
      var transcode   = $('#tran_code').val();

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

                  }else{
                    if(data1.vrno_series){
                        var getlastno = data1.vrno_series.LAST_NO;
                    }else{
                        var getlastno = '';
                    }

                    if(data1.vrnodata == ''){
                        $('#vrseqnum').val(getlastno);
                    }else{
                        var lastNo = parseInt(getlastno) + parseInt(1);
                        $('#vrseqnum').val(lastNo);
                    }
                  }

                  if(data1.glList ==''){

                  }else{
                    $("#int_inc_code").val(data1.glList[0].GL_CODE+'( '+data1.glList[0].GL_NAME+' )');
                    $("#unsecured_loan_code").val(data1.glList[0].POST_CODE+'( '+data1.glList[0].POST_NAME+' )');

                  }

            } /* /. success */
         } /* /. success function */
    }); /* /. ajax function */

    }/* CHECK MATCH VALUE*/

    validationCheck();
  } /* /. main function */

  function simulationcal(){

    var accCode        = $('#acc_code').val();
    var int_glcode     = $('#int_inc_code').val();
    var splitIntGl     = int_glcode.split('(');
    var int_inc_glcode = splitIntGl[0];
    var loanGl         = $('#unsecured_loan_code').val();
    var splitloanGl    = loanGl.split('(');
    var loanGlCode     = splitloanGl[0];
    var loanAmt        = $('#loan_amt').val();
    var intAmt         = $('#interestAmt').val();
    var accGl          = $('#acc_Gl').val();
    var createJvORBank = $('input[name="adv_int_jv"]:checked').val();

    $.ajaxSetup({

      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $.ajax({

          url:"{{ url('get-simulation-for-add-loan-n-hundi') }}",

          method : "POST",

          type: "JSON",

          data: {int_inc_glcode:int_inc_glcode,loanGlCode:loanGlCode,accGl:accGl,loanAmt:loanAmt,intAmt:intAmt,createJvORBank:createJvORBank},

          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
              $('#siml_body').empty();

            }else if(data1.response == 'success'){

              if(data1.data_sim==''){

                $('#siml_body').empty();

              }else{

                $('#siml_body').empty();
                var headData = "<div class='box-row' style='background-color: #efd4a7;'><div class='box10 codeIndBox'>Gl</div><div class='box10 nameIndBox'>Gl Name</div> <div class='box10 amountIndBox'>Debit-DR</div><div class='box10 amountIndBox'>Credit-CR</div></div>";
                $('#siml_body').append(headData);

                var drTotal=0;
                var crTotal=0;

                $.each(data1.data_sim, function(k, getData) {

                  drTotal += parseFloat(getData.DR_AMT);
                  crTotal += parseFloat(getData.CR_AMT);

                  var bodyData = "<div class='box-row tooltips'><div class='box10 codeIndBox'>"+getData.IND_GL_CODE+"</div> <div class='box10 nameIndBox'>"+getData.glName+"</div> <div class='box10 amountIndBox'>"+getData.DR_AMT+"</div> <div class='box10 amountIndBox'>"+getData.CR_AMT+"</div></div>";

                  $('#siml_body').append(bodyData);

                }); /* EACH LOOP*/

                var footerData = "<div class='box-row'><div class='box10 codeIndBox'></div> <div class='box10 nameIndBox'><b>Total</b></div> <div class='box10 amountIndBox'><b>"+drTotal.toFixed(2)+"</b></div> <div class='box10 amountIndBox'><b>"+crTotal.toFixed(2)+"</b></div></div>";

                $('#siml_body').append(footerData);

              }/* /. data get*/

            }/* /. SUCCESS CODN*/

          }/*/.SUCCESS FUNCTION*/
    }); /* /. AJAX FUNCTION*/

  }

  function submitLoanHundiTrans(pdfFlag){

      var downloadFlg = pdfFlag;

      $('#pdfYesNoStatus').val(downloadFlg);
      
      var data = $("#loanEntry").serialize();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/Transaction/LoanAndHundi/save-loan-hundi-Tran') }}",

          data: data, // here $(this) refers to the ajax object not form
          success: function (data) {
              
              var data1 = JSON.parse(data);
              console.log('data1',data1.data);
              if(data1.response == 'error') {

                var responseVar = false;
                var url = "{{url('LoanAndHundi/save-loan-hundi-Tran-msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });

              }else{

                var responseVar = true;
                if(downloadFlg == 1){
                    var fyYear    = data1.data[0].FY_CODE;
                    var fyCd      = fyYear.split('-');
                    var seriesCd  = data1.data[0].SERIES_CODE;
                    var vrNo      = data1.data[0].VRNO;
                    var fileN     = 'IRR_CAL_'+fyCd[0]+''+seriesCd+''+vrNo;
                    var link      = document.createElement('a');
                    link.href     = data1.url;
                    link.download = fileN+'.pdf';
                    link.dispatchEvent(new MouseEvent('click'));
                }

                var url = "{{url('LoanAndHundi/save-loan-hundi-Tran-msg')}}";
                setTimeout(function(){ window.location = url+'/'+responseVar; });

              }

          },

      });

  }

</script>


@endsection