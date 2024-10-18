@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .PageTitle{
    margin-right: 1px !important;
  }

  .required-field::before {
    content: "*";
    color: red;
  }

  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .showinmobile{
    display: none;
  }

  .secondSection{

    display: none;
  }
  @media screen and (max-width: 600px) {

  .showinmobile{

    display: block;

  }

  .PageTitle{

    float: left;

  }

  .hideinmobile{
    display: none;
  }

}


.stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {

    display: table;

    width: 100%;

    position: relative;

}


.stepwizard-step button[disabled] {

    opacity: 1 !important;

    filter: alpha(opacity=100) !important;

}

.stepwizard-row:before {

    top: 14px;

    bottom: 0;

    position: absolute;

    content: " ";

    width: 100%;

    height: 1px;

    background-color: #ccc;

    z-order: 0;
}

.stepwizard-step {

    display: table-cell;

    text-align: center;

    position: relative;
}

.btn-circle {

  width: 30px;

  height: 30px;

  text-align: center;

  padding: 6px 0;

  font-size: 12px;

  line-height: 1.428571429;

  border-radius: 15px;
}

.setwidthsel{

  width: 100px;

}

.amntFild{

  display: none;

}

.nonAccFild{

 display: none;

}

.showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
}

.settblebrodr{
  border: 1px solid #cac6c6;
}

.tdlboxshadow{

  box-shadow: 0px 1px 4px -1px rgba(161,155,161,1);

}


.btn {

    display: inline-block;

    font-weight: 400;

    text-align: center;

    vertical-align: middle;

    cursor: pointer;

    -webkit-user-select: none;

    -moz-user-select: none;

    -ms-user-select: none;

    user-select: none;

    padding: .375rem .75rem;

    font-size: 14px;

    line-height: 1.5;

    border-radius: .25rem;

    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.btn-success {

    color: #fff;

    background-color: #28a745;

    border-color: #28a745;

}

.btn-info {

    color: #fff;

    background-color: #04a9ff;

    border-color: #04a9ff;

}


.text-center{

  text-align: center;

}


.title{

    margin-top: 50px;

    margin-bottom: 20px;

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

.container{

    max-width: 1200px;

    margin: 0px auto;

    padding: 0px 15px;

}

.inputboxclr{

  border: 1px solid #d7d3d3;
}

.tdthtablebordr{
  border: 1px solid #00BB64;
}

input:focus{border:1px solid yellow;} 

.space{margin-bottom: 2px;}

.but{

    width:105px;

    background:#00BB64;

    border:1px solid #00BB64;

    height:40px;

    border-radius:3px;

    color:white;

    margin-top:10px;

    margin:0px 0px 0px 11px;

    font-size: 14px;

}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 6px;

    padding-bottom: 0px !important;

    line-height: 1.42857143;

    vertical-align: top;

    border-top: 1px solid #ddd;

    text-align: center;
}

.ref::before {

  color: navy;

  content: "Ch :";
}

.toalvaldesn{

    text-align: right;

    font-weight: 800;

    margin-top: 1%;
}

.debitotldesn{

    width: 277%;

    margin-left: 45%;

    text-align: end;

}

.credittotldesn{

    width: 277%;

    margin-left: -11%;

    text-align: end;
}

.debitcreditbox{

  width: 91px;

  text-align: end;
}

.savebtnstyle{

    color: #fff;

    background-color: #204d74;

    border-color: #122b40;
}

.cnaclbtnstyle{

    color: #fff;

    background-color: #d9534f;

    border-color: #d43f3a;
}

.instrumentlbl{

    font-size: 12px;

    margin-left: -5px;
}

.instTypeMode{

    width: 56%;

    margin-bottom: 5px;
}

.textdesciptn{

  width: 250px;

  margin-bottom: 5px;
}

.tdsratebtn{

  margin-top: 24% !important;

  font-weight: 600 !important;

  font-size: 10px !important;

}

.tdsInputBox{

  margin-bottom: 2%;

}

.modltitletext{
  font-weight: 800;
  color: #5696bb;
  margin-left: 3%;
  font-size: 16px;
  margin-top: 6px;
}

.textSizeTdsModl{

  font-size: 13px;

}

.btn_new{
    display: inline-block;
    font-weight: 600;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding: 0.375rem 0.75rem;
    font-size: 14px;
    line-height: 1.5;
    border-radius: 1.25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.bankshowwhenrecpt{

  display: none !important;
}

.setboxWidthIndex{

  width: 25px;

  border: 1px solid #b8b6b6;

}

.SetInCenter{

  margin-top: 18%;

}

.AddM{

  width: 24px;

}

@media screen and (max-width: 600px) {

  .debitotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: 13%;

  }

  .credittotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: -34%;
  }

  .totlsetinres{

    width: 130%;

  }

  .textdesciptn{

    margin-bottom: -1%;

  }

  .debitcreditbox{

    margin-top: 0%;

  }

  .rowClass{

    overflow-x: scroll;

  }

}

</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Order Transaction
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
          <a href="{{ url('/finance/form-transaction-mast') }}"> Sales Order Transaction</a>
        </li>

        <li class="active">
          <a href="{{ url('/finance/form-transaction-mast') }}">Add Sales Order Transaction</a>
        </li>

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Sales Order Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/finance/view-sales-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

<style type="text/css">


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
            
    <div class="row">
      <div class="col-md-12">
        <div class="panel with-nav-tabs panel-info">
          <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active" id="firstTab">
                  <a href="#tab1info" id="basicInfo" data-toggle="tab">Basic Info</a>
                </li>
                <li id="secondTab">
                  <a href="#tab2info" data-toggle="tab">Other Details</a>
                </li>
            </ul>
          </div>
          <div class="panel-body">
              <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab1info">

                    <div class="row">

                      <div class="col-md-5">

                        <div class="form-group">

                          <label>Company: <span class="required-field"></span></label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="text" class="form-control" id="company_code" name="comp" placeholder="Enter Company Name" value="{{strtoupper(Session::get('company_name'))}}" readonly>

                          </div>

                          <small id="comp_code_err" style="color: red;"></small>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                        </div>
                          <!-- /.form-group -->

                      </div>
                      <!-- /.col -->
                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Fiscal Year : <span class="required-field"></span></label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                            <input type="text" class="form-control" id="fy_year" name="fiscal" placeholder="Enter fy Year" value="{{strtoupper(Session::get('macc_year'))}}" readonly> 

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('fy_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->
                      <div class="col-md-4">

                        <div class="form-group">

                          <label>Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                              <?php  $FromDate= date("d-m-Y", strtotime($fromDate));  

                                     $ToDate= date("d-m-Y", strtotime($toDate));  

                              ?>

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control transdatepicker" name="vr" id="vr_date" value="{{ old('vr_date')}}" placeholder="Select Date">

                            </div>

                            <small id="showmsgfordate" style="color: red;"></small>

                            <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>
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

                            <input type="text" class="form-control" name="vro" value="<?php if($vrNumber==''){echo $last_num;}else{echo $vrNumber+1;} ?>" placeholder="Enter Vr No" id="vrseqnum" readonly>

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                         </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-2">

                        <div class="form-group">

                          <label> T Code : </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              <input type="text" class="form-control" name="tran" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly>

                              <input type="hidden" id="transtaxCode" >

                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                        </div>
                            <!-- /.form-group -->
                      </div>
                        <!-- /.col -->

                      <div class="col-md-4">

                        <div class="form-group">

                          <label>Acc Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="{{ old('AccCode')}}" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()">

                              <datalist id="AccountList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($getacc as $key)

                                <option value='<?php echo $key->acc_code?>'   data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                            <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                            <small id="acccode_code_errr" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label>Profit Center Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="profitList"  id="profitctrId" name="pfct" class="form-control  pull-left" value="{{ old('pfct')}}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()">

                              <datalist id="profitList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($pfct_list as $key)

                                <option value='<?php echo $key->pfct_code?>'   data-xyz ="<?php echo $key->pfct_name; ?>" ><?php echo $key->pfct_name ; echo " [".$key->pfct_code."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                          <small>  
                              <div class="pull-left showSeletedName" id="profitText"></div>
                          </small>

                          <small id="profit_center_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>
                    </div> <!-- row -->

                    <div class="row">

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11">

                              <datalist id="PlantcodeList">

                                 <option value="">--SELECT--</option>

                              </datalist>

                            </div>

                            <small>  

                                <div class="pull-left showSeletedName" id="plantText"></div>

                            </small>

                            <small id="plant_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Series Code: 

                            <span class="required-field"></span>

                          </label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                            </div>

                            <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="{{ old('series_code')}}" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()">

                            <datalist id="seriesList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($series_list as $key)

                                <option value='<?php echo $key->series_code?>'   data-xyz ="<?php echo $key->series_name; ?>" ><?php echo $key->series_name ; echo " [".$key->series_code."]" ; ?></option>

                              @endforeach

                            </datalist>

                          </div>

                          <small id="serscode_err" style="color: red;" class="form-text text-muted">

                          </small>

                          <small>  

                                <div class="pull-left showSeletedName" id="seriesText"></div>

                          </small>

                          <small id="series_code_errr" style="color: red;"></small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Tax Code: 
                            <span class="required-field"></span>
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="TaxcodeList"  id="tax_code" name="taxcode" class="form-control  pull-left" value="{{ old('taxcode')}}" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()">

                              <datalist id="TaxcodeList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($tax_code_list as $key)

                                  <option value='<?php echo $key->tax_code?>'   data-xyz ="<?php echo $key->tax_code; ?>" ><?php echo $key->tax_code ; echo " [".$key->tax_code."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small id="serscode_err" style="color: red;" class="form-text text-muted">
                            </small>

                            <small>  
                                <div class="pull-left showSeletedName" id="TaxcodeText"></div>
                            </small>

                            <small id="Taxcode_errr" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">
                        <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 26px;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                      </div>

                    </div> <!-- row -->

                  </div> <!-- /.tab first -->
                  <div class="tab-pane fade" id="tab2info">
                      <div class="row">
                          <div class="col-md-6">
                            Info 2
                          </div>
                          <div class="col-md-4">
                            
                          </div>
                          <div class="col-md-2">
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

                  <input type="text" name="comp_name" id="getCompName">
                  <input type="text" name="fy_year" id="getFyYear">
                  <input type="text" name="trans_date" id="getTransDate">
                  <input type="text" name="vr_no" id="getVrNo">
                  <input type="text" name="trans_code" id="getTransCode">
                  <input type="text" name="accountCode" id="getAccCode">
                  <input type="text" name="pfct_code" id="getPfctCode">
                  <input type="text" name="plant_code" id="getPlantCode">
                  <input type="text" name="series_code" id="getSeriesCode">
                  <input type="text" name="tax_code" id="getTaxCode">

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
                        <input list="ItemList1" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId1' name="item_code[]"  onchange="ItemCodeGet(1)"  oninput="this.value = this.value.toUpperCase()"/>

                          <datalist id="ItemList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($help_item_list as $key)

                              <option value='<?php echo $key->item_code?>' data-xyz ="<?php echo $key->item_name; ?>" ><?php echo $key->item_name ; echo " [".$key->item_code."]" ; ?></option>

                              @endforeach

                          </datalist>
                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id1' name="item_name[]" readonly />

                      <textarea id="" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description"></textarea>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='qty1' name="qty[]" onclick="showbtn(1)" onkeyup="CalAQty(1)" style="width: 80px" />

                      <input type="text" name="unit_M[]" id="UnitM1" class="inputboxclr SetInCenter AddM">

                      <input type="hidden" id="Cfactor1">

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty1' name="Aqty[]"  style="width: 80px" readonly />

                      <input type="text" name="add_unit_M[]" id="AddUnitM1" class="inputboxclr SetInCenter AddM">

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <input type='text' class="debitcreditbox inputboxclr cr_amount SetInCenter" oninput="calculateBasicAmt(1)" id='rate1' name="rate[]"  style="width: 80px"/>

                    </td>

                    <td class="tdthtablebordr">

                       <input type="text" name="basic_amt[]" id="basic1" class="form-control basicamt " style="width: 110px;margin-top: 14%;height: 22px;" >

                    </td>

                    <td>
                        <input type="hidden" id="data_count1" value="" name="data_Count[]">

                       <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1); getGrandTotal(1); grandCalculation(1); this.onclick=null;" disabled="">Calc Tax </button>

                     </td>

                  </tr>

                </table>

              </div><!-- /div -->

              <div class="row" style="display: flex;">

                  <div class="col-md-6"></div>

                  <div class="col-md-4 toalvaldesn">

                    <div class="totlsetinres">Total :</div>

                  </div>

                  <div class="col-md-1">

                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="allTotalAmt" readonly="" style="margin-top: 3px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>

        
<style type="text/css">

  .rTable { display: table; }

.rTableRow { display: table-row; }

.rTableHeading { display: table-header-group; }

.rTableBody { display: table-row-group; }

.rTableFoot { display: table-footer-group; }

.rTableCell, .rTableHead { display: table-cell; }

  .rTable {
   display: table;
   /*width: 100%;*/
}

.rTableRow {

   display: table-row;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

}

.rTableCell, .rTableHead {

   display: table-cell;

   padding: 3px 10px;

   border: 1px solid #ebe7e7;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

   font-weight: bold;

}

.rTableFoot {

   display: table-footer-group;

   font-weight: bold;

   background-color: #ddd;

}

.rTableBody {

   display: table-row-group;

}

.setInline{

  display: flex;

  margin-bottom: 4px;

}

.rowClass{

  margin: 0px;

  margin-top: 3%;

}

.rowClass1{

  margin: 0px;

  margin-top: 0%;

}

.rowClassonModel{

   margin: 0px;

  margin-top: 1%;

}

.LableTextField{

  text-align: center;

  font-weight: 600;

}

.distClass{

  display: none;



}

.sgstBlock{

  display: none;

}

.cgstBlock{

  display: none;

}

.afforblck{

  display: none;

}

.affiveblck{

  display: none;

}

.afsixblck{

  display: none;

}

.afsevenblck{

  display: none;

}

.afheadeightblck{

  display: none;

}

.afheadnineblck{

  display: none;

}

.afheadtenblck{

  display: none;

}

.afheadelvnblck{

  display: none;

}

.afheadtwelblck{

  display: none;

}

.getheading{

  border: none;

  width: 61px;

}

</style>    

      <br>

        <button type="button" class='btn btn-info delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

        <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

        <p class="text-center">

          <button class="btn btn-success" type="button" id="submitdata"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

        </p>

       <!-- model -->

      <div class="modal fade" id="tds_rate_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">

                <div class="col-md-4">

                   <div class="form-group" style="margin-bottom: 0px;">

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input list="TaxcodeList1"  id="tax_code1" name="taxcodeM" class="form-control  pull-left" value="{{ old('taxcode')}}" placeholder="Select Tax Code" oninput="this.value = this.value.toUpperCase()" >

                        <datalist id="TaxcodeList1">

                          <option selected="selected" value="">-- Select --</option>

                          @foreach ($tax_code_list as $key)

                          <option value='<?php echo $key->tax_code?>'   data-xyz ="<?php echo $key->tax_code; ?>" ><?php echo $key->tax_code ; echo " [".$key->tax_code."]" ; ?></option>

                          @endforeach

                        </datalist>

                      </div>

                      <small id="serscode_err" style="color: red;" class="form-text text-muted">

                      </small>

                      <small>  

                          <div class="pull-left showSeletedName" id="TaxcodeText"></div>

                      </small>

                      <small id="Taxcode_errr" style="color: red;"></small>

                   </div>
                    <!-- /.form-group -->
                </div>

                <div class="col-md-1" style="margin-left: -23px;padding-top: 2px;">
                  <button type="button" onclick="CalculateTaxOnModel(1);getGrandTotal(1); grandCalculation(1) " class="btn_new btn-primary btn-xs " data-loading-text="Sending info.."><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>

                <div class="col-md-6">
                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation</h5>
                </div>

                <div class="col-md-1"></div>

              </div>

            </div>

            <style>
              .boxer {
                display: table;
                border-collapse: collapse;
              }
              .boxer .box-row {
                display: table-row;
              }
              .boxer .box-row:first-child {
                font-weight:bold;
              }
              .boxer .box10 {
                display: table-cell;
                vertical-align: top;
                border: 1px solid #ddd;
                padding: 5px;
              }
              .boxer .ebay {
                padding:5px 1.5em;
              }
              .boxer .google {
                padding:5px 1.5em;
              }
              .boxer .amazon {
                padding:5px 1.5em;
              }
              .center {
                text-align:center;
              }
              .right {
                float:right;
              }
              .texIndbox{
                width: 25%; 
                text-align: center;
              }
              .rateIndbox{
                width: 15%;
                text-align: center;
              }
              .rateBox{
                width: 20%;
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
            </style>

            <div class="modal-body table-responsive">

                <div class="boxer" id="tax_rate_1">
                
                  <!-- End of 'box-row' -->
                  <!-- Start of 'box-row' -->
                  <!-- End of 'box-row' -->

                </div>

            </div>

            <div class="modal-footer" style="text-align: center;">

             <button type="button" class="btn btn-primary" style="width: 27%;" data-dismiss="modal" id="Applyrate1" onclick="Applyrate(1);">Apply</button>

             <button type="button" class="btn btn-warning" style="width: 20%;" data-dismiss="modal">Cancle</button>

            </div>

          </div>

        </div>

      </div>
      <!-- model -->
    </form>

  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/sales_trans.js') }}" ></script>
  
<script type="text/javascript">

  $(document).ready(function() {

    jQuery.extend(jQuery.expr[':'], {

      focusable: function (el, index, selector) {

          return $(el).is('a, button, :input, [tabindex]');

      }

    });

    $(document).on('keypress', 'input,select', function (e) {

        if (e.which == 13) {

            e.preventDefault();
            // Get all focusable elements on the page
            var $canfocus = $(':focusable');

            var index = $canfocus.index(document.activeElement) + 1;

            if (index >= $canfocus.length) index = 0;

            $canfocus.eq(index).focus();
        }

    });

  });

</script>

<script type="text/javascript">
/*on click model*/
  function CalculateTax(taxid){

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

      var tax_code = $('#tax_code').val();

      $.ajax({

              url:"{{ url('get-a-field-by-trans-code') }}",

              method : "POST",

              type: "JSON",

              data: {tax_code: tax_code},

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

                          $('#tax_rate_'+taxid).empty();

                         var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div><div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div></div>";

                         $('#tax_rate_'+taxid).append(TableHeadData);

                          $.each(data1.data, function(k, getData) {

                            var datacount = data1.data.length;
                                //console.log('count',datacount);
                                $('#data_count'+taxid).val(datacount);

                            if (getData.rate_index == null && getData.tax_rate == null || getData.rate_index == null || getData.tax_rate == null) {

                             $('#tax_code'+taxid).val(getData.tax_code);
                             
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly>  </div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logic_"+counter+"' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='static_"+counter+"' id='static_id_"+taxid+"_"+counter+"' value='0'></div></div>";

                            }else{

                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly></div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='"+getData.rate_index+"'></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.tax_rate+"' class='form-control' oninput='when_chng_index("+taxid+")' ></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value=''><input type='hidden' name='logic_"+counter+"' id='logic_id_"+taxid+"_"+counter+"' value='"+getData.tax_logic+"'><input type='hidden' name='static_"+counter+"' id='static_id_"+taxid+"_"+counter+"' value='"+getData.static+"'></div></div>";

                            }

                            $('#tax_rate_'+taxid).append(TableData);
                          
                            counter++;

                          });  
                          
                        }
                     
                    } // success close

              } //success function close

      }); //ajax close 

    }else{

    console.log('show');

    }

  } /*function close*/


  function getGrandTotal(getid){

    setTimeout(function() {

      totalAmount = 0;

      qunatity = $("#qty"+getid).val();

      for(l=2;l<=12;l++){

        rate = $("#rate_"+getid+"_"+l).val();   

        indicator = $("#indicator_"+getid+"_"+l).val();

        logic = $("#logic_id_"+getid+"_"+l).val();
        static = $("#static_id_"+getid+"_"+l).val();
   
        if(logic === undefined){
           
        }else{ 

          if(logic.length >0){

            indicatorCalculation(indicator,rate,logic,l,getid);

          }
        }


        if(indicator == 'L' || indicator == 'M' || indicator == 'R'){

          $('#FirstBlckAmnt_'+getid+"_"+l).prop('readonly',false);

          $('#rate_'+getid+"_"+l).prop('readonly',false);

          $('#indicator_'+getid+"_"+l).prop('readonly',false);

          if(indicator == 'M'){

          $('#FirstBlckAmnt_'+getid+"_"+l).val('-');

          }else{}

          if(indicator == 'R'){

            $('#rate_'+getid+"_"+l).prop('readonly',true);

           var amntF_R =  parseFloat(qunatity) * parseFloat(rate);

           $('#FirstBlckAmnt_'+getid+"_"+l).val(amntF_R);

          }else{}

        }else{

           $('#FirstBlckAmnt_'+getid+"_"+l).prop('readonly',true);

           $('#indicator_'+getid+"_"+l).prop('readonly',true);
           $('#rate_'+getid+"_"+l).prop('readonly',true);

        }

      }

    }, 1000);
      //$("#total_cramount").val(parseFloat(totalAmount));
    //$("#temp_cramount").val(Math.round(parseFloat(totalAmount))); 
  } /*function close*/

  function indicatorCalculation(indicator,rate,logic,l,incNum){

    var totalLogicVal = 0;

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

    $("#FirstBlckAmnt_"+incNum+"_"+l).val(0);

    if(indicator=="N"){

        amtMinus= -((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(amtMinus.toFixed(2));

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

    if(indicator=="A"){

        roundoff = ((parseFloat(totalLogicVal) * 100)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(Math.round(roundoff.toFixed(2)));

    }

    if(indicator=="O"){

        deductionRoundOff = -((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(Math.round(deductionRoundOff.toFixed(2)));

    }

  } /*function close*/

  function grandCalculation(unicId){

    setTimeout(function() {

       var totalAmount = 0;

       var indicatorNAmt=0;

       var indicatorOAmt= 0;

       var indicatorMAmt=0;

       var indicatorPAmt=0;

       var indicatorLAmt= 0;

       var indicatorQAmt= 0;

       var indicatorRAmt= 0;

       var indicatorZAmt= 0;

       var indicatorAAmt= 0;

        for(r=2;r<=12;r++){

          indicator1 = $("#indicator_"+unicId+"_"+r).val();

          if(indicator1=="N"){

            indicatorN = parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val());

            indicatorNAmt= parseFloat(indicatorNAmt) + indicatorN;

          }

          if(indicator1=="O"){      

            indicatorO = Math.round(parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val()));

            indicatorOAmt= parseFloat(indicatorOAmt) +  indicatorO;

          }

          if(indicator1=="M"){      

            indicatorM = parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val());

            indicatorMAmt= parseFloat(indicatorMAmt) +  indicatorM;

          }

          if(indicator1=="P"){      

            indicatorP = parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val());

            indicatorPAmt= parseFloat(indicatorPAmt) + indicatorP;

          }

          if(indicator1=="L"){      

            indicatorL = parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val());

            indicatorLAmt= parseFloat(indicatorLAmt) + indicatorL;

          }

          if(indicator1=="Q"){      

            indicatorQ = Math.round(parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val()));

            indicatorQAmt= parseFloat(indicatorQAmt) + indicatorQ;

          }

          if(indicator1=="Z"){      

            indicatorZ = Math.round(parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val()));

            indicatorZAmt= parseFloat(indicatorZAmt) + indicatorZ;

          }

          if(indicator1=="A"){      

            indicatorA = Math.round(parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val()));

            indicatorAAmt= parseFloat(indicatorAAmt) + indicatorA;

          }

          if(indicator1=="R"){      

            indicatorR = parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val());

            indicatorRAmt= parseFloat(indicatorRAmt) + indicatorR;

          }

          if(isNaN(indicatorNAmt)){

            var index_N_amt = 0;

          }else{

            var index_N_amt = indicatorNAmt;

          }

          if(isNaN(indicatorOAmt)){

            var index_O_amt = 0;

          }else{

            var index_O_amt = indicatorOAmt;

          }

          if(isNaN(indicatorPAmt)){

            var index_P_amt = 0;

          }else{

            var index_P_amt = indicatorPAmt;

          }

          if(isNaN(indicatorLAmt)){

            var index_L_amt = 0;

          }else{

            var index_L_amt = indicatorLAmt;

          }

          if(isNaN(indicatorQAmt)){

            var index_Q_amt = 0;

          }else{

            var index_Q_amt = indicatorQAmt;

          }

          if(isNaN(indicatorZAmt)){

            var index_Z_amt = 0;

          }else{

            var index_Z_amt = indicatorZAmt;

          }

          if(isNaN(indicatorAAmt)){

            var index_A_amt = 0;

          }else{

            var index_A_amt = indicatorAAmt;

          }

          if(isNaN(indicatorRAmt)){

            var index_R_amt = 0;

          }else{

            var index_R_amt = indicatorRAmt;

          } 

          if(isNaN(indicatorMAmt)){

            var index_M_amt = 0;

          }else{

            var index_M_amt = indicatorMAmt;

          }

          var totalAmount = parseFloat(index_N_amt) + parseFloat(index_O_amt) + parseFloat(index_P_amt) + parseFloat(index_L_amt) + parseFloat(index_Q_amt) + parseFloat(index_Z_amt) + parseFloat(index_A_amt) + parseFloat(index_R_amt) - parseFloat(index_M_amt);

         /* if(indicator1=="A"){

            roundOff= Math.round(parseFloat(totalAmount)) - parseFloat(totalAmount);       

            $("#FirstBlckAmnt_"+r).val(roundOff);

          }*/

        } /*--for loop close--*/

        $("#totalval"+unicId).val(parseFloat(totalAmount).toFixed(2));

        var totalAmt  =  parseFloat($("#totalval"+unicId).val());

        var BasicAmt  =  parseFloat($("#FirstBlckAmnt_"+unicId+"_1").val());

        var netPay = totalAmt + BasicAmt;

         $('#NetPay'+unicId).val(netPay.toFixed(2));

    }, 1000);

  } /*--function close--*/


  function AmountCalWhenenter(getids){

    var sum = 0;

      $(".txtamount").each(function () {
        //add only if the value is number
        if (!isNaN(this.value) && this.value.length != 0) {

            sum += parseFloat(this.value);

        }

      $("#totalval"+getids).val(sum.toFixed(2));

    });
  } /*--function close--*/

  /*on click model*/

  /*When tax code change on model*/

  function CalculateTaxOnModel(taxid){

    var basicAmt = $('#basic'+taxid).val();

    $('#getbasicAmt'+taxid).val(basicAmt);

    var transcode = $('#transcode').val();

    var tax_code = $('#tax_code'+taxid).val();

    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

    });

    $.ajax({

          url:"{{ url('get-a-field-by-trans-code') }}",

          method : "POST",

          type: "JSON",

          data: {tax_code: tax_code,transcode:transcode},

          success:function(data){
              //console.log(data);
            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

            }else if(data1.response == 'success'){

              $("#CalcTax1").prop('disabled',false);

                if(data1.data==''){

                }else{

                  var basicheadval = parseFloat($('#basic'+taxid).val());

                  var counter = 1;
                    
                  $('#tax_rate_'+taxid).empty();

                  var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div><div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div></div>";

                  $('#tax_rate_'+taxid).append(TableHeadData);

                  $.each(data1.data, function(k, getData) {

                    var datacount = data1.data.length;
                                //console.log('count',datacount);
                    $('#data_count'+taxid).val(datacount);

                      if (getData.rate_index == null && getData.tax_rate == null || getData.rate_index == null || getData.tax_rate == null) {

                       $('#tax_code1').val(getData.tax_code);

                         var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly></div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' class='form-control' name='af_rate[]' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logic_"+counter+"' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='static_"+counter+"' id='static_id_"+taxid+"_"+counter+"' value='0'></div></div>";

                      }else{

                         var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly></div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='"+getData.rate_index+"'></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='"+getData.tax_rate+"' name='af_rate[]' class='form-control' oninput='when_chng_index("+taxid+")'></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value=''><input type='hidden' name='logic_"+counter+"' id='logic_id_"+taxid+"_"+counter+"' value='"+getData.tax_logic+"'><input type='hidden' name='static_"+counter+"' id='static_id_"+taxid+"_"+counter+"' value='"+getData.static+"'></div></div>";

                      }
                      
                      $('#tax_rate_'+taxid).append(TableData);
                    
                      counter++;

                  });  
                  
                }

            } // success close

          } //success function close

    }); //ajax close 

  } //main function close

/*When tax code change on model*/

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

          endDate : todateintrans,

          autoclose: 'true'

        });

    });

  });

</script>

<script type="text/javascript">

  $(document).ready(function(){

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

    });

  });

</script>

<script type="text/javascript">

  $(".delete").on('click', function() {

      $('.case:checkbox:checked').parents("tr").remove();

      $('.check_all').prop("checked", false); 

      var f_amt = 0;

       $(".secnd_txt_amnt").each(function () {
          //add only if the value is number
          if (!isNaN(this.value) && this.value.length != 0) {
              f_amt += parseFloat(this.value);
          }

        $("#AfAmt1").val(f_amt.toFixed(2));

      });

      check();

  }); /*--function close--*/


  var i=2;

  $(".addmore").on('click',function(){

    var vrType =  $('#vr_type').val();

      if(vrType == 'Payment'){

        var getpaymode = 'To -';

      }else if(vrType == 'Receipt'){

       var getpaymode='By -';

      }

      count=$('table tr').length;

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> <input  type='hidden' name='tds_rate[]' id='TdsRateByAccCode"+i+"' class='getRateForAcc'><input type='hidden' name='tds_code[]' id='TdsSection"+i+"'><input type='hidden' name='' id='accNtdsrate"+i+"'></td>";

      data +="<td class='tdthtablebordr'><div class='input-group'><input list='ItemList"+i+"' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' name='item_code[]' onchange='ItemCodeGet("+i+")' oninput='this.value = this.value.toUpperCase()'/><datalist id='ItemList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($help_item_list as $key)<option value='<?php echo $key->item_code?>' data-xyz ='<?php echo $key->item_name; ?>' ><?php echo $key->item_name ; echo ' ['.$key->item_code.']' ; ?></option>@endforeach</datalist></div></td> <td class='tdthtablebordr'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly /><textarea id='' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description'></textarea></td> <td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='qty"+i+"' name='qty[]' onclick='showbtn("+i+")' onkeyup='CalAQty("+i+")' style='width: 80px' /><input type='text' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' id='Cfactor"+i+"'></div></td> <td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM'></div></td> <td class='tdthtablebordr'><input type='text' class='debitcreditbox inputboxclr cr_amount SetInCenter'  oninput='calculateBasicAmt("+i+")' id='rate"+i+"' name='rate[]'  style='width: 80px'/></td> <td class='tdthtablebordr'><input type='text' name='basic_amt[]' id='basic"+i+"' class='form-control basicamt ' style='width: 110px;margin-top: 14%;height: 22px;' ></td> <td> <input type='hidden' id='data_count"+i+"' value='' name='data_Count[]'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='CalcTax"+i+"' data-toggle='modal' data-target='#tds_rate_model"+i+"' onclick='CalculateTax("+i+"); getGrandTotal("+i+"); grandCalculation("+i+")'>Calc Tax</button> <div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-4'><div class='form-group' style='margin-bottom: 0px;'><div class='input-group'><div class='input-group-addon'><i class='fa fa-newspaper-o' aria-hidden='true'></i></div><input list='TaxcodeList"+i+"'  id='tax_code"+i+"' name='taxcodeM' class='form-control  pull-left' value='{{ old("taxcode")}}' placeholder='Select Tax Code' oninput='this.value = this.value.toUpperCase()' ><datalist id='TaxcodeList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($tax_code_list as $key)<option value='<?php echo $key->tax_code?>'   data-xyz ='<?php echo $key->tax_code; ?>' ><?php echo $key->tax_code ; echo ' ['.$key->tax_code.']' ; ?></option>@endforeach</datalist></div><small id='serscode_err' style='color: red;' class='form-text text-muted'></small><small><div class='pull-left showSeletedName' id='TaxcodeText'></div></small><small id='Taxcode_errr' style='color: red;'></small></div></div><div class='col-md-1' style='margin-left: -23px;padding-top: 2px;'><button type='button' onclick='CalculateTaxOnModel("+i+");getGrandTotal("+i+"); grandCalculation("+i+") ' class='btn_new btn-primary btn-xs ' data-loading-text='Sending info..'><i class='fa fa-search' aria-hidden='true'></i></button></div><div class='col-md-6'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tax / Charges / etc Calculation</h5> </div> <div class='col-md-1'></div></div></div> <div class='modal-body table-responsive'><div class='boxer' id='tax_rate_"+i+"'><div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div> <div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div> </div> </div></div> <div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' style='width: 27%;' data-dismiss='modal' id='Applyrate1' onclick='Applyrate("+i+");'>Apply</button> <button type='button' class='btn btn-warning' style='width: 20%;' data-dismiss='modal'>Cancle</button></div></div></div> </div> </td>";

      $('table').append(data);

      i++;

  });  /*--function close--*/

  function select_all() {

    $('input[class=case]:checkbox').each(function(){ 

      if($('input[class=check_all]:checkbox:checked').length == 0){ 

        $(this).prop("checked", false); 

      }else{

        $(this).prop("checked", true); 

      } 

    });
  }

  function check(){

    obj = $('table tr').find('span');

      $.each( obj, function( key, value ) {

          id= value.id;

          $('#'+id).html(key+1);

      });
  }

</script>

<script type="text/javascript">

  function ItemCodeGet(ItemId){

      var ItemCode =  $('#ItemCodeId'+ItemId).val();

      var xyz = $('#ItemList'+ItemId+' option').filter(function() {

          return this.value == ItemCode;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

             $('#ItemCodeId'+ItemId).val('');

             document.getElementById("Item_Name_id"+ItemId).value = '';

             $('#qty'+ItemId).val('');

             $('#A_qty'+ItemId).val('');

      }else{

         document.getElementById("Item_Name_id"+ItemId).value = msg;  

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
                  //console.log(data1.data);
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

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }/*function close*/

$(document).ready(function(){

    $("#profitctrId").change(function(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var Profit_Center_code =  $(this).val();

          $.ajax({

            url:"{{ url('get-plant-code-name') }}",

            method : "POST",

            type: "JSON",

            data: {Profit_Center_code: Profit_Center_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  objcity = data1.data;

                    $('#PlantcodeList').empty();

                      $.each(objcity, function (i, objcity) {

                        $('#PlantcodeList').append($('<option>', { 

                          value: objcity.plant_code,

                          'data-xyz': objcity.plant_name,

                          text : objcity.plant_name 

                        }));

                      });

                }

            }

          });

      });

});

</script>


<script type="text/javascript">

  function when_chng_index(incId){
        var qunatity = $('#qty'+incId).val();
        for(s=2;s<=12;s++){
          var indecatoe = $('#indicator_'+incId+'_'+s).val();
          console.log('ind',indecatoe);
          if(indecatoe == 'R'){
          var rate = $('#rate_'+incId+'_'+s).val();
          var result = parseFloat(qunatity) * parseFloat(rate);
          $('#FirstBlckAmnt_'+incId+'_'+s).val(result);
            console.log('when chng i',result);
          }else{}
        }
  }

  function Applyrate(aplyid){

        var amnttotl = 0;

         $(".amnt_total").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {

                amnttotl += parseFloat(this.value);

            }

          $("#allTotalAmt").val(amnttotl.toFixed(2));

        });

  }

  function calculateBasicAmt(rateid){

      var qunatity = parseFloat($('#qty'+rateid).val());

      var rate = parseFloat($('#rate'+rateid).val());

      if(rate){

        var result = qunatity * rate;

        $('#basic'+rateid).val(result);

        $('#CalcTax'+rateid).prop('disabled',false);

      }else{

        $('#basic'+rateid).val('');

        $('#CalcTax'+rateid).prop('disabled',true);

      }

  }

</script>


<script type="text/javascript">

$(document).ready(function(){

    $("#submitdata").click(function(event) {

      var data = $("#salesordertrans").serialize();

        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/finance/save-sales-order-transaction') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

              console.log(data);

            // window.location.href = "{{ url('/finance/view-cash-bank') }}";
            },

        });
              
    });

});

</script>


@endsection