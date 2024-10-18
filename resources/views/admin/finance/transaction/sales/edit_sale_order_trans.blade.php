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
  .rightcontent{

  text-align:right;


}.hiddenicon{
  display: none;
}
::placeholder {
  
  text-align:left;
}
.tooltiphide{
  display: none;
}

.itmdetlheading{
  vertical-align: middle !important;
  text-align: center;
}
.itmdetlheading1{
  vertical-align: middle !important;
  text-align: center;
  width: 40%;
}
.texIndbox1{
  text-align: center;
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

  margin-top: 3% !important;

  font-weight: 600 !important;

  font-size: 10px !important;

}
.viewbtnitem{
    padding-bottom: 0px;
    padding-top: 0px;
    font-size: 12px;
    margin-bottom: 4px;
}
.showdetail{
  display: none;

}

.tdsInputBox{

  margin-bottom: 2%;

}

.modltitletext{
  font-weight: 800;
  color: #5696bb;
  text-align: center;
  font-size: 16px;
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
.divhsn{
      color: #3c8dbc;
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 8%;
}
.aplynotStatus{
  display: none;
}
.notshowcnlbtn{
  display: none;
}
.itmbyQc{
    display: none;
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
        Sales Order Trans
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
          <a href="{{ url('/transaction/sales/sales-order-transaction') }}"> Sales Order Transaction</a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Sales Contract Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/finance/view-purchase-quatation')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

                              <?php  $FromDate= date("d-m-Y", strtotime($fromDate));  

                                     $ToDate= date("d-m-Y", strtotime($toDate)); 

                                     $CurrentDate =date("d-m-Y"); 

                              ?>

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control transdatepicker rightcontent" name="vr" id="vr_date" value="{{ $getSaleOrder[0]->vr_date }}" placeholder="Select Date" autocomplete="off">

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

                              <input type="text" class="form-control" name="tran" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                              <input type="hidden" id="transtaxCode" >

                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                        </div>
                            <!-- /.form-group -->
                      </div>
                        <!-- /.col -->
                      <div class="col-md-5">

                        <div class="form-group">

                          <label>Series Code: 

                            <span class="required-field"></span>

                          </label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                            </div>
                            <input list="series_List1"  id="series_code_sale" name="series" class="form-control  pull-left" value="{{ $getSaleOrder[0]->series_code }}" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

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

                            <input type="hidden" name="" value="{{$to_num}}" id="vr_last_num">

                            <input type="text" class="form-control rightcontent" name="vro" value="{{ $getSaleOrder[0]->vr_no }}" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                         </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->

                    </div>
                    <!-- /.row -->

                    <div class="row">
            
                      


                      <div class="col-md-4">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              
                              <input list="PlantcodeList" class="form-control" id="Plant_code_sale" name="plantcode" placeholder="Select Plant" maxlength="55" value="{{ $getSaleOrder[0]->plant_code }}" onchange="getpftcbyPlant();" autocomplete="off" readonly>

                              <datalist id="PlantcodeList">


                              </datalist>

                            </div>

                            <input type="hidden" id="getStateByPlant" name="stateByPlant">

                            <small>  

                                <div class="pull-left showSeletedName" id="plantText"></div>

                            </small>

                            <small id="plant_err" style="color: red;"> </small>

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

                              <input list="profitList"  id="profitctrId" name="pfct" class="form-control  pull-left" value="{{ $getSaleOrder[0]->pfct_code }}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly>

                              <datalist id="profitList">

                                <option selected="selected" value="">-- Select --</option>

                              </datalist>

                            </div>

                          <small id="profit_center_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label>Acc Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 4px 12px;">

                                <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>

                                <div class="" id="appndplantbtn"> 
                                </div>

                                 <?php $accCount = count($getacc); ?>
                                 <input type="hidden" id="getaccCount" value="{{$accCount}}">
                                 <?php if($accCount == 1) { ?>

                                  <button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getplantdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;" id="appndplantbtn1"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>

                                 <?php } else{ ?>
                                  <i class="fa fa-newspaper-o" aria-hidden="true" id="showicon"></i>
                                 <?php } ?>

                              </span>
                              
                              <input list="AccountList"  id="account_code_sale" name="AccCode" class="form-control  pull-left" value="{{ $getSaleOrder[0]->acc_code }}" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly> 

                              <datalist id="AccountList">


                              </datalist>

                            </div>

                            <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                            <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                            <small id="acccode_code_errr" style="color: red;"></small>
                            <small id="accNotFound"></small>

                            <input type="hidden" value="" id="stateOfAcc">

                        </div>
                            <!-- /.form-group -->
                      </div>
                      
                    </div> <!-- row -->

                    <div class="row">


                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Sale Contract No.: 
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input  list="saleConList" id="saleConNo" name="" class="form-control  pull-left" value="" placeholder="Select Sale Contract No" onchange="getITmBySaleContra()" autocomplete="off">

                                <datalist id="saleConList">
                                  
                                </datalist>
                              
                            </div>
                            <small style="color: red;" id="saleConNotF"></small>
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
                              <input list="TaxcodeList"  id="tax_code_get" name="taxcode" class="form-control  pull-left" value="{{ $getSaleOrder[0]->tax_code }}" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off" onchange="getitmByTax()">

                              <datalist id="TaxcodeList">


                              </datalist>

                            </div>

                            <small id="Taxcode_errr" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>

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

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Due Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            
                              <input type="text" class="form-control rightcontent" name="due_date" id="due_date" value="{{ $getSaleOrder[0]->due_date }}" placeholder="Select Due" autocomplete="off" readonly>

                            </div>
                        </div>
                            <!-- /.form-group -->
                      </div>
                          <!-- /.col -->
                      
                    </div>

                    <div class="row">
                        
                      

                      <div class="col-md-3">
                        <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 0px;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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

                                    <input type="text" class="form-control" name="party_ref" value="{{ $getSaleOrder[0]->partyref_no }}" id="party_rf_no" placeholder="Enter Party Ref No" maxlength="30" autocomplete="off">

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

                                <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="{{$getSaleOrder[0]->partyref_date }}" placeholder="Select Party Ref Date" autocomplete="off">

                              </div>

                              <small id="showmsgfordate_1" style="color: red;"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                      {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                            </div>
                            <!-- /.form-group -->
                          </div>
                          
                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Consine Code : <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input list="consineList"  id="consine_code" name="consine" class="form-control pull-left" value="{{$getSaleOrder[0]->consine_code }}" placeholder="Select consine" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                                  <datalist id="consineList">


                                  </datalist>

                                </div>

                                <small id="cosnicode_err" style="color: red;" class="form-text text-muted"> </small>

                                <small> <div class="pull-left showSeletedName" id="consineText"></div> </small>

                                <!-- <small id="consine_code_errr" style="color: red;"></small> -->

                            </div>
                            <!-- /.form-group -->
                          </div>
                          
                      </div>

                      <div class="row">
                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead1) && $rfhead->rfhead1 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead1 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_1" placeholder="Enter Rfhead1" maxlength="30" value="{{$getSaleOrder[0]->rfhead1 }}" id="rfhead1" oninput="rfheadget(1)" autocomplete="off">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div>
                        <?php }else{} } ?>

                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead2) && $rfhead->rfhead2 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead2 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_2" placeholder="Enter Rfhead2" maxlength="30" id="rfhead2" oninput="rfheadget(2)" value="{{$getSaleOrder[0]->rfhead2 }}">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div>
                        <?php }else{} } ?>

                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead3) && $rfhead->rfhead3 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead3 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_3" id="rfhead3" placeholder="Enter Rfhead3" maxlength="30" oninput="rfheadget(3)" value="{{$getSaleOrder[0]->rfhead3}}">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div>
                        <?php }else{} } ?>
                          
                      </div>

                      <div class="row">
                          
                        <?php foreach ($series_list as $rfhead) {

                          if(isset($rfhead->rfhead4) && $rfhead->rfhead4 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead4 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_4" placeholder="Enter Rfhead4" maxlength="30" id="rfhead4" oninput="rfheadget(4)" value="{{$getSaleOrder[0]->rfhead4}}" autocomplete="off">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div>
                        <?php }else{} } ?>

                        <?php foreach ($series_list as $rfhead) {

                          if(isset($rfhead->rfhead5) && $rfhead->rfhead5 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead5 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_5" placeholder="Enter Rfhead5" maxlength="30" id="rfhead5" oninput="rfheadget(5)" value="{{$getSaleOrder[0]->rfhead5}}"  autocomplete="off">

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



                  <tr >

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

                  <?php $sr=1;$rowcount = count($getSaleOrder);$basicTot = 0;$grandTot = 0;$otherTot =0; foreach ($getSaleOrder as $rows) {
                      $basicTot += $rows->basic_amt;
                      $grandTot += $rows->dr_amount;
                      $otherTot = $grandTot - $basicTot;
                   ?>

                  <?php if($sr == 1){ ?>
                    <input type="hidden" id="rowcont" value="{{$rowcount}}">
                  <?php }?>

                    <tr class="useful" id="firstRowtr">

                      <td class="tdthtablebordr">
                        <input type='checkbox' class='case' id="cBocID<?php echo $sr;?>" onclick="checkcheckbox(<?php echo $sr;?>);" />
                      </td>

                      <td class="tdthtablebordr">
                        <span id='snum' style="width: 10px;"><?php echo $sr;?>.</span>
                      </td>

                      <td class="tdthtablebordr">

                        <div class="input-group">

                          <input type="text" class="inputboxclr itmbyQc" style="width: 90px;margin-bottom: 4px;margin-top: 13px;" id='Item_CodeId<?php echo $sr;?>' name="itemsale[]" value="{{$rows->item_code}}" onclick="ShowItemCode(<?php echo $sr;?>);" onchange="ItemCodeGet(<?php echo $sr;?>); checktaxCode(<?php echo $sr;?>);taxIntaxrate(<?php echo $sr;?>);"  oninput="this.value = this.value.toUpperCase()" readonly />

                          <input list="ItemList<?php echo $sr;?>" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId<?php echo $sr;?>' name="item_code[]" value="{{$rows->item_code}}"  onchange="ItemCodeGet(<?php echo $sr;?>); taxIntaxrate(<?php echo $sr;?>);"  oninput="this.value = this.value.toUpperCase()" readonly />

                            <datalist id="ItemList<?php echo $sr;?>">
                              @foreach ($help_item_list as $key)

                              <option value='<?php echo $key->item_code?>' data-xyz ="<?php echo $key->item_name; ?>" ><?php echo $key->item_name ; echo " [".$key->item_code."]" ; ?></option>

                              @endforeach
                            </datalist>

                        </div>
                        <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail<?php echo $sr;?>" data-toggle="modal" data-target="#view_detail<?php echo $sr;?>" onclick="showItemDetail(<?php echo $sr;?>)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                        <input type="hidden" id="idsun<?php echo $sr;?>">
                        <input type="hidden" id="selectItem<?php echo $sr;?>">
                        <div class="divhsn" id="showHsnCd<?php echo $sr;?>"></div>
                        <input type="hidden" id="hsn_code<?php echo $sr;?>" name="hsn_code[]" value="{{$rows->hsn_code}}">
                        <input type="hidden" id="taxByItem<?php echo $sr;?>" name="tax_byitem[]" value="{{$rows->tax_code}}">
                        <input type="hidden" id="taxratebytax<?php echo $sr;?>" value="" value="{{$rows->tax_code}}">
                        <input type="hidden" id="sc_transcode<?php echo $sr;?>" name="sc_trans[]" >
                        <input type="hidden" id="sc_seriescode<?php echo $sr;?>" name="sc_series[]">
                        <input type="hidden" id="sc_vrno<?php echo $sr;?>" name="sc_vrno[]" value="">
                        <input type="hidden" id="sc_slno<?php echo $sr;?>" name="sc_slno[]" value="">
                        <input type="hidden" id="sc_headid<?php echo $sr;?>" name="sc_head[]" value="">
                        <input type="hidden" id="sc_bodyid<?php echo $sr;?>" name="sc_body[]" value="">
                        <input type="hidden" id="itmC_code<?php echo $sr;?>" name="itemcodeC[]" value="{{$rows->item_code}}">

                        <small id='itemnotFound<?php echo $sr;?>' style="color: red;"></small>
                     
                      </td>

                      <td class="tdthtablebordr tooltips">

                        <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id<?php echo $sr;?>' value="{{$rows->item_name}}" name="item_name[]" readonly>

                        <small class="tooltiptextitem tooltiphide" id="itemNameTooltip<?php echo $sr;?>"></small>

                        <textarea id="remark_data<?php echo $sr;?>" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description" readonly>{{$rows->remark}}</textarea>

                      </td>

                      <td class="tdthtablebordr">

                        <div style="display: inline-flex;border: none;margin-top: -3%;">

                          <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='qty<?php echo $sr;?>' name="qty[]" oninput="CalAQty(<?php echo $sr;?>)" value="{{$rows->quantity}}" style="width: 80px" readonly />

                          <input type="text" name="unit_M[]" id="UnitM<?php echo $sr;?>" value="{{$rows->um_code}}" class="inputboxclr SetInCenter AddM" readonly>

                          <input type="hidden" id="Cfactor<?php echo $sr;?>">
                          <input type="hidden" id="balQtyByItem<?php echo $sr;?>">
                         
                        </div>

                      </td>

                      <td class="tdthtablebordr">

                        <div style="display: inline-flex;border: none;margin-top: -3%;">

                          <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty<?php echo $sr;?>' name="Aqty[]"  style="width: 80px" readonly value="{{$rows->Aquantity}}" />

                          <input type="text" name="add_unit_M[]" id="AddUnitM<?php echo $sr;?>" value="{{$rows->aum_code}}" class="inputboxclr SetInCenter AddM" readonly>
                        </div>

                      </td>

                      <td class="tdthtablebordr">

                        <input type='text' class="debitcreditbox inputboxclr cr_amount SetInCenter" oninput="calculateBasicAmt(<?php echo $sr;?>)" id='rate<?php echo $sr;?>' value="{{$rows->rate}}" name="rate[]"  style="width: 80px" readonly/>
                        <input type="hidden" id="qnrate<?php echo $sr;?>">

                      </td>

                      <td class="tdthtablebordr">

                        <input type="text" name="basic_amt[]" id="basic<?php echo $sr;?>" value="{{$rows->basic_amt}}" class="form-control basicamt debitcreditbox" style="width: 110px;margin-top: 14%;height: 22px;" readonly>
                       
                      </td>

                      <td>
                        <input type="hidden" id="data_count<?php echo $sr;?>" class="dataCountCl" value="0" name="data_Count[]">

                        <input type="hidden" class="setGrandAmnt" id="get_grand_num<?php echo $sr;?>" name="crAmtPerItem[]">
                         <div style="margin-top: 23%;">
                         <small id="taxnotfound<?php echo $sr;?>" class="label label-danger"></small>
                         </div>
                        <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax<?php echo $sr;?>" data-toggle="modal" data-target="#tds_rate_model<?php echo $sr;?>" onclick="CalculateTax(<?php echo $sr;?>); getGrandTotal(<?php echo $sr;?>); grandCalculation(<?php echo $sr;?>);" disabled="">Calc Tax </button>

                       <div id="aplytaxOrNot<?php echo $sr;?>" class="aplynotStatus"></div>
                       <div id="appliedbtn<?php echo $sr;?>"></div>
                        <div id="cancelbtn<?php echo $sr;?>"></div>

                      </td>

                      <td>
                        
                        <div style="margin-top: 12%;">
                          <small id="qpnotfound<?php echo $sr;?>" class="label label-danger"></small>
                        </div>
                        <input type="hidden" id='quaP_count<?php echo $sr;?>' value="0" name="quaP_count[]" class="quaPcountrow">
                        <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="qua_paramter<?php echo $sr;?>" data-toggle="modal" data-target="#quality_parametr<?php echo $sr;?>" onclick="qty_parameter(<?php echo $sr;?>)" disabled="" style="padding-bottom: 0px;padding-top: 0px;">Quality Parametr </button>

                        <div id="cancelQpbtn<?php echo $sr;?>"></div>
                        <div id="appliedQpbtn<?php echo $sr;?>"></div>
                        
                        <div id="qpApplyOrNot<?php echo $sr;?>" class="aplynotStatus">0</div>

                        <small id="qPnotfountbtn<?php echo $sr;?>" class="label label-danger"></small>

                        <!-- itam detail modal -->

                          <div class="modal fade" id="view_detail<?php echo $sr;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-md" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel">Item Detail</h5></div> </div> </div> <div class="modal-body table-responsive"><div class="boxer" id=""> <div class="box-row"><div class="box10 texIndbox1">Item name</div><div class="box10 rateIndbox">HSN Code</div><div class="box10 rateIndbox">Tax Code</div><div class="box10 rateBox">Item Detail</div><div class="box10 amountBox">Item Type</div>  <div class="box10 amountBox">Item Group</div><div class="box10 amountBox">Item Class</div> <div class="box10 amountBox">Item Category</div></div><div class="box-row"><div class="box10 itmdetlheading1"> <small id="itemCodeshow<?php echo $sr;?>"> </small> </div><div class="box10 itmdetlheading"><small id="hsncodeshow<?php echo $sr;?>"> </small> </div> <div class="box10 itmdetlheading"><small id="taxcodeshow<?php echo $sr;?>"> </small></div><div class="box10 itmdetlheading"><small id="itemDetailshow<?php echo $sr;?>"> </small></div><div class="box10 itmdetlheading"><small id="itemtypeshow<?php echo $sr;?>"> </small></div><div class="box10 itmdetlheading"><small id="itemgroupshow<?php echo $sr;?>"> </small></div><div class="box10 itmdetlheading"><small id="itemclassshow<?php echo $sr;?>"> </small></div><div class="box10 itmdetlheading"><small id="itemcategoryshow<?php echo $sr;?>"> </small></div></div> </div> </div><div class="modal-footer" style="text-align: center;"><button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button></div></div></div></div>

                        <!-- itam detail modal -->

                        <!-- quality parameter -->

                          <div class="modal fade" id="quality_parametr<?php echo $sr;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel">Qaulity Parameter</h5></div></div></div><div class="modal-body table-responsive"><div class="boxer" id="qua_par_<?php echo $sr;?>"></div></div><div class="modal-footer"><center><small style="text-align: center;" id="footerqp_ok_btn<?php echo $sr;?>"></small><small style="text-align: center;" id="footerqp_quality_btn<?php echo $sr;?>"></small></center></div></div></div></div>

                        <!-- quality parameter -->

                      </td>



                    </tr>

                    
                  <?php $sr++;} ?>

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
                    <input class="credittotldesn inputboxclr" type="text" name="TotalBasciAmt" value="{{number_format($basicTot,2)}}" id="basicTotal" readonly="" style="margin-top: 3px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>

               <div class="row" style="display: flex;">

                  <div class="col-md-6">

                      <input type="hidden" id="checkitm">
                      <input type="hidden" id="itmaftercheck">
                    
                      <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                      <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
                  </div>

                    <div class="col-md-4 toalvaldesn">

                    <div class="totlsetinres">Other Total :</div>

                  </div>

                  <div class="col-md-1">

                    <input class="credittotldesn inputboxclr" type="text" name="TotalOtherAmt" value="{{number_format($otherTot,2)}}" id="otherTotalAmt" readonly="" style="margin-top: 3px;">

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

                    <input class="credittotldesn inputboxclr" type="text" name="TotalGrandAmt" value="{{number_format($grandTot,2)}}" id="allgrandAmt" readonly="" style="margin-top: 3px;">

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
.settaxcodemodel{
  font-size: 16px;
    font-weight: 800;
    color: #5d9abd;
}

</style>    

      <br>

        

        <p class="text-center">

          <button class="btn btn-success" type="button" id="submitdata" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

        </p>

       <!-- model -->

      <div class="modal fade" id="tds_rate_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;overflow-y: scroll;height: 512px;">

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
                width: 4%; 
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

              <center> <small  id="footer_ok_btn1"></small>
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



                <div class="modal-body table-responsive">

                    <div id="showtaxcodeMul1" style="line-height: 23px;">
                      
                    </div>

                </div>



                <div class="modal-footer" style="text-align: center;" id="taxCodeSelect1">

                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="taxIntaxrate(1);" style="width: 83px;">Ok</button>   

                </div>



            </div>

        </div>

      </div>

     <!-- show modal when itemselect but tax not --> 

     <!-- show modal when click on item code -->

      <div id="allItemShow1" class="modal fade" tabindex="-1">

        <div class="modal-dialog modal-md" style="margin-top: 13%;">

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

      <!-- show modal when click on item code -->

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


    </form>

  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script>
<!-- <script src="{{ URL::asset('public/dist/js/viewjs/sale_quotation.js') }}" ></script> -->
<script src="{{ URL::asset('public/dist/js/viewjs/commonJsFun.js') }}" ></script>

<script type="text/javascript">

  $(document).ready(function() {

    $(window).on('load',function(){
      var count = $('#rowcont').val();

      for(var w=0;w<count;w++){
        var id =w+1;
        $('#CalcTax'+id).prop('disabled',false);
        $('#qua_paramter'+id).prop('disabled',false);
      }
    })

    $('#due_days').on('input',function(){
      
        dueDays = parseInt($('#due_days').val());

        if(isNaN(dueDays)){
          
          $("#due_date").val('');
          $("#get_due_date").val('');
          
          $('#due_days').css('border-color','#ff0000').focus();

        }else{

          var vr_date = $('#vr_date').val();
    
          var explodeDate =  vr_date.split('-');
          var expDate= explodeDate[0];
          var expMonth= explodeDate[1];
          var expYear= explodeDate[2];
          var mergeDate = expMonth+'-'+expDate+'-'+expYear;
          var getduedate = new Date(mergeDate);

          getduedate.setDate(getduedate.getDate() + dueDays); 

          var getdate = getduedate.getDate();
          var getMonth=getduedate.getMonth()+1;
          var getYear = getduedate.getFullYear();
          var duedate1 =getYear+'-'+getMonth+'-'+getdate;


          var d = new Date(duedate1);
          var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
          var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

          var duedate =da+'-'+mo+'-'+getYear;

          $("#due_date").val(duedate);
          $("#get_due_date").val(duedate);
        
          $('#due_days').css('border-color','#d2d6de');
          $("#ItemCodeId1").prop('readonly',false);

        }

       if (/\D/g.test(this.value))
        {
          // Filter non-digits from input value.
          this.value = this.value.replace(/\D/g, '');
        }

       
    });

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
  $(document).ready(function(){

      $("#account_code_sale").change(function(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var acccode =  $('#account_code_sale').val();
        var seperateC = acccode.split('[');
        var  account_code = seperateC[0]
        var transDate =  $('#vr_date').val();
        var stateCode =  $('#getStateByPlant').val();

          $.ajax({

            url:"{{ url('get-sale-contract-vrno-by-acc') }}",

            method : "POST",

            type: "JSON",

            data: {account_code: account_code,transDate:transDate,stateCode:stateCode},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                    if(data1.dataTax == ''){

                    }else{
                      $("#TaxcodeList").empty();
                      $.each(data1.dataTax, function(k, getTAX){

                       
                        $("#TaxcodeList").append($('<option>',{

                          value:getTAX.tax_code,

                          'data-xyz':getTAX.tax_name,
                          text:getTAX.tax_name+' ['+getTAX.tax_code+']'

                        }));

                      }); 
                    }

                    if(data1.statebyAcc == ''){

                    }else{
                      $('#stateOfAcc').val(data1.statebyAcc);
                    }

                    if(data1.sale_quotation_data == ''){

                      $('#saleConNotF').html('Sale Contract No. Not Found').css('color','red');
                      $('#saleConNo').prop('readonly',true);

                    }else{
                       $('#saleConNotF').html('');
                       $('#saleConNo').prop('readonly',false);
                       $("#saleConList").empty();

                      $.each(data1.sale_quotation_data, function(k, saleQuo){

                        var startyear = saleQuo.fiscal_year;
                        var getyear = startyear.split('-');

                        $("#saleConList").append($('<option>',{

                          value:getyear[0]+' '+saleQuo.series_code+' '+saleQuo.vr_no,

                          'data-xyz':getyear[0]+' '+saleQuo.series_code+' '+saleQuo.vr_no,
                          text:getyear[0]+' '+saleQuo.series_code+' '+saleQuo.vr_no

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
    
    function getITmBySaleContra(){

      var acccode =  $('#account_code_sale').val();
      var splitAcc =  acccode.split('[');
      var account_code = splitAcc[0];
      var saleConNo    =  $('#saleConNo').val();
      var getsalecn     = saleConNo.split(' ');
      var sale_ContNo   = getsalecn[2];

      if(sale_ContNo){
          $('#Item_CodeId1').removeClass('itmbyQc');
          $('#ItemCodeId1').css('display','none');
      }else{

      }

      $.ajaxSetup({

              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

      });

      $.ajax({

            url:"{{ url('get-itmdata-for-sale-contract') }}",

            method : "POST",

            type: "JSON",

            data: {account_code: account_code,sale_ContNo:sale_ContNo},

            success:function(data){

              var data1 = JSON.parse(data);
                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                
                  if(data1.data == ''){
                     $('#tax_code_get').val('');
                     $('#due_days').val('');
                     $('#due_date').val('');
                  }else{

                    var startDate = data1.data[0].vr_date;
                    var endDate = data1.data[0].due_date;

                    var diffInMs   = new Date(endDate) - new Date(startDate);
                    var diffInDays = diffInMs / (1000 * 60 * 60 * 24);

                    $('#due_days').val(diffInDays).prop('readonly',true);
                    $('#due_date').val(endDate);
                    $('#gateduedate').val(endDate);
                    $('#tax_code_get').val(data1.data[0].tax_code).prop('readonly',true);
                  }

                }

            }

      });

    }

    function ShowItemCode(itemId){

      var acccode =  $('#account_code_sale').val();
      var splitAcc =  acccode.split('[');
      var account_code = splitAcc[0];
      var saleConNo    =  $('#saleConNo').val();
      var getsalecn     = saleConNo.split(' ');
      var sale_ContNo   = getsalecn[2];

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $.ajax({

          url:"{{ url('get-itmdata-for-sale-contract') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code,sale_ContNo:sale_ContNo},

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

                      var tableHead= "<div class='box-row'><div class='box10 texIndbox'>#</div><div class='box10 vrnoinbox'>Vr. No</div><div class='box10 itemIndbox'>Item </div><div class='box10 rateIndbox'>Qty quotation </div><div class='box10 rateIndbox'>Qty contract </div><div class='box10 rateIndbox'>Bal. Qty </div></div>";



                      $('#itemListShow_'+itemId).append(tableHead);

                      var incemntval = 1;

                      var inval = '';

                      var itmCounts = data1.data.length;

                      $('#itmCountchk').val(itmCounts);
                      if(itmCounts == 1){
                        $('#addmorhidn').prop('disabled',true);
                      }else{
                        
                      }


                      $.each(data1.data, function(k, getData) {

                        var startyear = getData.fiscal_year;
                        var getyear = startyear.split("-");

                        if(getData.qty_issued == null){
                          var qtyissued = 0.000;
                        }else{
                          var qtyissued =getData.qty_issued;
                        }


                      var tableBody = "<div class='box-row' id='hidebalNull_"+itemId+"_"+incemntval+"'><div class='box10 texIndbox'><input type='radio' id='sr_"+itemId+"_"+incemntval+"' name='itemname' value='"+itemId+"_"+incemntval+"'></div><div class='box10 texIndbox' style='width: 19%;'><input type='text' id='vrno_"+itemId+"_"+incemntval+"' name='head_tax_ind11[]' class='form-control inputtaxInd' value="+getyear[0]+'&nbsp;'+getData.series_code+'&nbsp;'+getData.vrno+" readonly></div><div class='box10 rateIndbox'><input type='hidden' value="+getData.fiscal_year+" id='scfiscalyr_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.series_code+" id='scseries_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.tran_code+" id='sctran_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.vr_no+" id='scvrno_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.slno+" id='scslno_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.bodyid+" id='scbodyid_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.sale_contract_id+" id='scheadid_"+itemId+"_"+incemntval+"'><input type='hidden' value='"+getData.remark+"' id='scitmdisciptn_"+itemId+"_"+incemntval+"'><input type='text' id='itemcode_"+itemId+"_"+incemntval+"' name='itemco' class='form-control'  value='"+getData.item_code+"("+getData.item_name+")"+"' readonly><input type='hidden' value="+getData.tax_code+" id='taxCodeI_"+itemId+"_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='qtyOreder_"+itemId+"_"+incemntval+"' name='qtyOrder' class='form-control rightcontent' value="+getData.quantity+" readonly><input type='hidden' value="+getData.rate+" id='sc_rate_"+itemId+"_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='qtySupply_"+itemId+"_"+incemntval+"' name='qtySupply[]' class='form-control rightcontent' value="+qtyissued+" readonly></div><div class='box10 rateIndbox'><input type='text' id='balence_qty_"+itemId+"_"+incemntval+"' name='balQty[]' class='form-control rightcontent' value="+getData.quantity+" readonly><input type='hidden' class='form-control' id='remainBalQty_"+itemId+"_"+incemntval+"' value='' readonly></div></div>";

                      $('#itemListShow_'+itemId).append(tableBody);

                      getItemForCheckQty(itemId,incemntval);

                      inval = incemntval;

                      incemntval++;

                      }); // each loop close


                      var butn =  $('#footer_item_'+itemId).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                          var tablefooter = "<button type='button' class='btn btn-primary ' style='width: 27%;' data-dismiss='modal' id='ApplyOkbtn"+itemId+"' onclick='selectitem("+itemId+","+inval+");umAumByitm("+itemId+","+inval+");taxIntaxrate("+itemId+")'>Ok</button><button type='button' class='btn btn-danger notshowcnlbtn' data-dismiss='modal' style='width: 16%;' id='addbtnwhenselect"+itemId+"'>Cancel</button>";

                            $('#footer_item_'+itemId).append(tablefooter);

                         }else{

                         }

                          var selectedItem = $('#selectItem'+itemId).val();

                          var uniqByitm = $('#idsun'+itemId).val();

                          if(selectedItem){

                            $('#sr_'+uniqByitm).prop('checked',true);

                            $('#ApplyOkbtn'+itemId).prop('disabled',true);

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
      
      var sc_rate        = $('#sc_rate_'+res1+'_'+res2).val();
      
      var scseries       = $('#scseries_'+res1+'_'+res2).val();
      var sctransc       = $('#sctran_'+res1+'_'+res2).val();
      var scslno         = $('#scslno_'+res1+'_'+res2).val();
      var scvrno         = $('#scvrno_'+res1+'_'+res2).val();
      var scbody         = $('#scbodyid_'+res1+'_'+res2).val();
      var schead         = $('#scheadid_'+res1+'_'+res2).val();
      var scitmdiscriptn = $('#scitmdisciptn_'+res1+'_'+res2).val();
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
      $('#remark_data'+rowid).val(scitmdiscriptn);
      
      $('#idsun'+rowid).val(res1+'_'+res2);

      $('#rate'+rowid).val(sc_rate);
      $('#qnrate'+rowid).val(sc_rate);
      $('#qty'+rowid).val(balencQtyByitm);
      $('#balQtyByItem'+rowid).val(balencQtyByitm);
      $('#sc_transcode'+rowid).val(sctransc);
      $('#sc_seriescode'+rowid).val(scseries);
      $('#sc_vrno'+rowid).val(scvrno);
      $('#sc_slno'+rowid).val(scslno);
      $('#sc_headid'+rowid).val(schead);
      $('#sc_bodyid'+rowid).val(scbody);
      $('#taxByItem'+rowid).val(tax_CodeI);

      
      $('#qty'+rowid).prop('readonly',false);
      $('#rate'+rowid).prop('readonly',false);
      $('#CalcTax'+rowid).prop('readonly',false);

      $('#vr_date,#series_code,#Plant_code,#profitctrId,#account_code,#contractNo,#purOrdervrno,#quotationNo,#tax_code,#due_days,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

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
                $('#vr_date,#series_code,#Plant_code,#account_code,#contractNo,#quotationNo,#tax_code,#due_days,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

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

    //var remainBalQty = $('#remainBalQty_'+rowI+'_'+calI).val();

      var balenceQty =  orderQty - suplyQty;

      $('#balence_qty_'+rowI+'_'+calI).val(balenceQty.toFixed(3));

      if(orderQty == suplyQty){
        $('#hidebalNull_'+rowI+'_'+calI).hide();
      }else{
        $('#hidebalNull_'+rowI+'_'+calI).show();
      }

  }

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

                      $('#UnitM'+umaumvl).val(data1.data[0].um_code);
                      $('#AddUnitM'+umaumvl).val(data1.data[0].aum);
                      $('#Cfactor'+umaumvl).val(data1.data[0].aum_factor);

                      var aQtycal = qtyBal * data1.data[0].aum_factor;
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

                      $('#Item_Name_id'+umaumvl).val(data1.data_hsn.item_name);

                      $('#hsn_code'+umaumvl).val(data1.data_hsn.hsn_code);

                      $('#showHsnCd'+umaumvl).html('HSN No : '+data1.data_hsn.hsn_code);
                      
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

                          value:getAum.aum,

                          'data-xyz':getAum.um_name,
                          text:getAum.um_name

                        }));

                      });

                    }


                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }/*function close*/

</script>

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
      var basicAmt = $('#basic'+taxid).val();

      $('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt);
     
        var slContrHeadId = $('#sc_headid'+taxid).val();
        var slContrBodyId = $('#sc_bodyid'+taxid).val();
        var ItemCd = $('#ItemCodeId'+taxid).val();
        var Item_Cde = $('#itmC_code'+taxid).val();

        if(ItemCd){
          var ItemCode = ItemCd;
        }else if(Item_Cde){
          var ItemCode = Item_Cde;
        }


    if(taxOnModel == ''){

      var tax_code = $('#taxByItem'+taxid).val();

      $.ajax({

                url:"{{ url('get-a-field-calculation-by-tax-in-sale-order')}}",

                method : "POST",

                type: "JSON",

                data: {tax_code: tax_code,slContrHeadId:slContrHeadId,slContrBodyId:slContrBodyId,ItemCode:ItemCode},

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
                            }else{}

                            var datacount = data1.data.length;
                            dataI = datacount;
                                //console.log('count',datacount);
                                $('#data_count'+taxid).val(datacount);

                            if ((getData.rate_index == null && getData.tax_rate == null) || getData.rate_index == null || getData.tax_rate == null || (getData.rate_index == '-' && getData.tax_rate == '---') || getData.rate_index == '-' || getData.tax_rate == '---') {

                             $('#tax_code'+taxid).val(getData.tax_code);
                             
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly> <input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.tax_ind_code+"> </div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''></div></div>";



                            }else{

                                if(getData.tax_ind_name == 'GrandTotal'){
                                  var classname = 'grandTotalGet';
                                }else{
                                  var classname = '';
                                }

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
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.tax_ind_code+"></div><div class='box10 rateIndbox'> <input type='text' class='form-control' name='rate_ind[]' value='"+getData.rate_index+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+"); grandCalculation("+taxid+");'> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a> </div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.tax_rate+"' class='form-control' oninput='getGrandTotal("+taxid+"); grandCalculation("+taxid+");' ></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+taxAmt+"' oninput='getGrandTotal("+taxid+"); grandCalculation("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+getData.tax_logic+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+getData.static+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+taxglc+"'></div></div> <div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->rt_value ?>'>&nbsp;&nbsp;<?php echo $key->rt_value ?> - <?php echo $key->rate_name ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+"); grandCalculation("+counter+");'>Apply</button></div></div></div></div>";

                              

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

      rowWiseCalculation();

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
  var adrow=1;

  $(".addmore").on('click',function(){
      
      count=$('table tr').length;

      var notck = i - 1;

      var ifnotaply = $('#aplytaxOrNot'+notck).html();

      if(ifnotaply == 0){
         $("#taxNotAppied").modal('show');
         $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');
      }else{

        var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case' onclick='checkcheckbox("+i+");' id='cBocID"+i+"'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span></td>";

        data +="<td class='tdthtablebordr'><div class='input-group'><input type='text' class='inputboxclr itmbyQc' style='width: 90px;margin-bottom: 4px;margin-top: 13px;' id='Item_CodeId"+i+"' name='itemsale[]' onclick='ShowItemCode("+i+");' onchange='ItemCodeGet("+i+"); checktaxCode("+i+");taxIntaxrate("+i+");'  oninput='this.value = this.value.toUpperCase()' readonly /><input list='ItemList"+i+"' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' name='item_code[]'  onchange='ItemCodeGet("+i+"); taxIntaxrate("+i+");'  oninput='this.value = this.value.toUpperCase()' readonly /><datalist id='ItemList"+i+"'>@foreach ($help_item_list as $key)<option value='<?php echo $key->item_code?>' data-xyz ='<?php echo $key->item_name; ?>' ><?php echo $key->item_name ; echo ' ['.$key->item_code.']' ; ?></option> @endforeach</datalist></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><input type='hidden' id='idsun"+i+"'><input type='hidden' id='selectItem"+i+"'> <div class='divhsn' id='showHsnCd"+i+"'></div><input type='hidden' id='hsn_code"+i+"' name='hsn_code[]'> <input type='hidden' id='taxByItem"+i+"' name='tax_byitem[]'><input type='hidden' id='taxratebytax"+i+"' value=''><input type='hidden' id='sc_transcode"+i+"' name='sc_trans[]'> <input type='hidden' id='sc_seriescode"+i+"' name='sc_series[]'><input type='hidden' id='sc_vrno"+i+"' name='sc_vrno[]'><input type='hidden' id='sc_slno"+i+"' name='sc_slno[]'><input type='hidden' id='sc_headid"+i+"' name='sc_head[]'> <input type='hidden' id='sc_bodyid"+i+"' name='sc_body[]'><input type='hidden' id='itmC_code"+i+"' name='itemcodeC[]'><small id='itemnotFound"+i+"' style='color: red;'></small></td><td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></small><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description' readonly></textarea></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='qty"+i+"' name='qty[]' oninput='CalAQty("+i+")' style='width: 80px' readonly /><input type='text' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly><input type='hidden' id='Cfactor"+i+"'><input type='hidden' id='balQtyByItem"+i+"'></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly></div></td><td class='tdthtablebordr'><input type='text' class='debitcreditbox inputboxclr cr_amount SetInCenter' oninput='calculateBasicAmt("+i+")' id='rate"+i+"' name='rate[]'  style='width: 80px' readonly/><input type='hidden' id='qnrate"+i+"'></td><td class='tdthtablebordr'><input type='text' name='basic_amt[]' id='basic"+i+"' class='form-control basicamt debitcreditbox' style='width: 110px;margin-top: 14%;height: 22px;' readonly></td><td><input type='hidden' id='data_count"+i+"' class='dataCountCl' value='0' name='data_Count[]'><input type='hidden' class='setGrandAmnt' id='get_grand_num"+i+"' name='crAmtPerItem[]'><div style='margin-top: 23%;'><small id='taxnotfound"+i+"' class='label label-danger'></small></div><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='CalcTax"+i+"' data-toggle='modal' data-target='#tds_rate_model"+i+"' onclick='CalculateTax("+i+"); getGrandTotal("+i+"); grandCalculation("+i+");' disabled=''>Calc Tax </button><div id='aplytaxOrNot"+i+"' class='aplynotStatus'></div><div id='appliedbtn"+i+"'></div><div id='cancelbtn"+i+"'></div></td><td><div style='margin-top: 12%;'><small id='qpnotfound"+i+"' class='label label-danger'></small></div><input type='hidden' id='quaP_count"+i+"' value='0' name='quaP_count[]' class='quaPcountrow'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='qua_paramter"+i+"' data-toggle='modal' data-target='#quality_parametr"+i+"' onclick='qty_parameter("+i+")' disabled='' style='padding-bottom: 0px;padding-top: 0px;'>Quality Parametr </button><div id='cancelQpbtn"+i+"'></div><div id='appliedQpbtn"+i+"'></div><div id='qpApplyOrNot"+i+"' class='aplynotStatus'>0</div><small id='qPnotfountbtn"+i+"' class='label label-danger'></small><div id='allItemShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-md' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12' style='text-align: center;'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Details</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='itemListShow_"+i+"'></div></div><div class='modal-footer' style='text-align: center;' id='footer_item_"+i+"'></div></div></div></div><div id='taxSelectModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='font-weight: 800;'>Select Tax Code</h5></div></div></div><div class='modal-body table-responsive' style='text-align: initial;'><div id='showtaxcodeMul"+i+"' style='line-height: 23px;'></div></div><div class='modal-footer' style='text-align: center;' id='taxCodeSelect"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='taxIntaxrate("+i+");' style='width: 83px;'>Ok</button></div></div></div></div><div id='grateQtyShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5></div></div></div><div class='modal-body table-responsive'><p>Quantity is grater than balence qunatity</p></div><div class='modal-footer' style='text-align: center;' id='greatQtyFooter'><button type='button' class='btn btn-primary' data-dismiss='modal' onclick='cancleGreatQty("+i+");'>ok</button></div></div></div></div><div id='greaterRateShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5></div></div></div><div class='modal-body table-responsive'><p>Rate Should Not Be Greater</p></div><div class='modal-footer' style='text-align: center;' id='greatRateFooter"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item name</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading1'><small id='itemCodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='taxcodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemDetailshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemtypeshow"+i+"'> </small></div> <div class='box10 itmdetlheading'><small id='itemgroupshow"+i+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemclassshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemcategoryshow"+i+"'> </small></div></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div></td>";

        $('table').append(data);

        var domModel = "<div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-5'><div class='form-group'> <lable class='settaxcodemodel col-md-4' style='padding: 0px;'>Tax Code - </lable> <input type='text' class='settaxcodemodel col-md-7' id='tax_code"+i+"' style='border: none; padding: 0px;' readonly> </div> </div><div class='col-md-6'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tax / Charges / etc Calculation</h5></div><div class='col-md-1'></div></div> </div> <div class='modal-body table-responsive'><div class='modalspinner hideloaderOnModl'></div><div class='boxer' id='tax_rate_"+i+"'><div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div> <div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div> </div> </div></div> <div class='modal-footer'><center><small  id='footer_ok_btn"+i+"'></small>&nbsp;&nbsp;<small style='width: 86px;'  id='footer_tax_btn"+i+"'></small></center>  </div></div></div> </div> <div id='HsnSameShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title' style='color: red;font-weight: 800;'>Alert !!</h5></div><div class='modal-body'><p>Header Tax Code <small id='headtaxCode"+i+"'></small> Is Different Than Item Wise Tax Code <small id='itmtaxCode"+i+"'></small></p></div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal' onclick='cancleblnkItm("+i+");'>Cancel</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div>";

        $('#domModel_2').append(domModel);

        var qpModlDom = "<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Qaulity Parameter</h5> </div> </div> </div><div class='modal-body table-responsive'> <div class='boxer' id='qua_par_"+i+"'></div> </div><div class='modal-footer'><center><small style='text-align: center;' id='footerqp_ok_btn"+i+"'></small>&nbsp;<small style='text-align: center;' id='footerqp_quality_btn"+i+"'></small></center> </div></div></div></div>";

        $('#quaPdomModel_2').append(qpModlDom);

        var saleContractNoIS = $('#saleConNo').val();
        if(saleContractNoIS ==''){
          $('#Item_CodeId'+i).addClass('itmbyQc');
          $('#ItemCodeId'+i).css('display','block');
          $('#ItemCodeId'+i).prop('readonly',false);
        }else{
          $('#Item_CodeId'+i).removeClass('itmbyQc');
          $('#ItemCodeId'+i).css('display','none');

        }

        var taxCode = $('#tax_code_get').val();

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            url:"{{ url('get-item-by-tax-state') }}",

            method : "POST",

            type: "JSON",

            data: {taxCode: taxCode},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                   if(data1.data ==''){

                   }else{
                      $("#ItemList"+adrow).empty();

                      $.each(data1.data, function(k, getData){

                          $("#ItemList"+adrow).append($('<option>',{

                            value:getData.item_code,

                            'data-xyz':getData.item_name,
                            text:getData.item_name

                          }));

                      });

                   }

                }

            }

        });

        i++;
        adrow++;
      } /*else*/
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

    if(obj.length == 0){
      $('#basicTotal').val(0);
      $('#otherTotalAmt').val(0);
      $('#allgrandAmt').val(0);
      $("#allquaPcount").val(0);
      $("#allgetMCount").val(0);
      $('#submitdata').prop('disabled',true);
      $('#CalPayTerms').prop('disabled',true);
    }else{

      $.each( obj, function( key, value ) {

          id= value.id;

          $('#'+id).html(key+1);

      });

    }
      
  }


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

  function getitmByTax(){
    var taxCode = $('#tax_code_get').val();
    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $.ajax({

            url:"{{ url('get-item-by-tax-state') }}",

            method : "POST",

            type: "JSON",

            data: {taxCode: taxCode},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                   if(data1.data ==''){

                   }else{

                      $("#ItemList1").empty();

                      $.each(data1.data, function(k, getData){

                          $("#ItemList1").append($('<option>',{

                            value:getData.item_code,

                            'data-xyz':getData.item_name,
                            text:getData.item_name

                          }));

                      });

                   }

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
      var taxCode =  $('#tax_code_get').val();
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


      var xyz = $('#ItemList'+ItemId+' option').filter(function() {

          return this.value == ItemCode;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      

      if(msg=='No Match'){

             $('#ItemCodeId'+ItemId).val('');

             document.getElementById("Item_Name_id"+ItemId).value = '';

             $('#qty'+ItemId).val('');

             $('#A_qty'+ItemId).val('');
             $('#UnitM'+ItemId).val('');
             $('#AddUnitM'+ItemId).val('');
             $('#remark_data'+ItemId).val('');
             $('#hsn_code'+ItemId).val('');
             $('#showHsnCd'+ItemId).html('');
             $('#taxByItem'+ItemId).val('');
             $('#taxratebytax'+ItemId).val('');
             $('#rate'+ItemId).val('');
             $('#basic'+ItemId).val('');
             $('#get_grand_num'+ItemId).val('');
             $('#data_count'+ItemId).val('');
             $('#CalcTax'+ItemId).hide();
             $('#qty'+ItemId).prop('readonly',true);
             $('#rate'+ItemId).prop('readonly',true);
             $('#remark_data'+ItemId).prop('readonly',true);
             $('#viewItemDetail'+ItemId).addClass('showdetail');
             $("#itemNameTooltip"+ItemId).addClass('tooltiphide');

             rowWiseCalculation();
      }else{

        $('#viewItemDetail'+ItemId).removeClass('showdetail');

         document.getElementById("Item_Name_id"+ItemId).value = msg;

         $("#itemNameTooltip"+ItemId).removeClass('tooltiphide');

        $("#itemNameTooltip"+ItemId).html(msg);
        $('#itmC_code'+ItemId).val(ItemCode);

         $('#qty'+ItemId).prop('readonly',false);  
         $('#rate'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false);  

         $('#vr_date,#series_code_sale,#profitctrId,#Plant_code_sale,#account_code_sale,#tax_code_get,#due_days,#saleConNo').prop('readonly',true);

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

                            $('#UnitM'+ItemId).val(data1.data[0].um_code);

                            $('#AddUnitM'+ItemId).val(data1.data[0].aum);

                            $('#Cfactor'+ItemId).val(data1.data[0].aum_factor);

                          }

                          
                          if(data1.data_hsn==''){
                            var hsnCode= '';
                            var shHCode= '';
                            $('#hsn_code'+ItemId).val(hsnCode);
                            $('#showHsnCd'+ItemId).html(shHCode);
                          }else{
                            $('#hsn_code'+ItemId).val(data1.data_hsn.hsn_code);
                            $('#showHsnCd'+ItemId).html('HSN No : '+data1.data_hsn.hsn_code);
                          }
                          //console.log(data1.data_enq);
                         
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
                              console.log('taxByhsn',taxByhsn);
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

                              var taxData = '<input type="radio" class="taxcodeset" id="html" name="taxcodeit" value="'+gettax.tax_code+'"> <label for="html">'+gettax.tax_code+'</label><br>';
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


  function checktaxCode(hsnid){

    setTimeout(function() {

       var hsncode =  $('#hsn_code'+hsnid).val();
       var taxcode =  $('#tax_code').val();

        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        if(hsncode && taxcode){

            $.ajax({

              url:"{{ url('check-hsn-for-taxcode') }}",

              method : "POST",

              type: "JSON",

              data: {hsncode: hsncode,taxcode:taxcode},

              success:function(data){

                    var data1 = JSON.parse(data);

                    if (data1.response == 'error') {

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                        if(data1.data_tax == ''){
                          $("#HsnSameShow"+hsnid).modal('show');
                        }else{

                          var taxCode = $('#getTaxCode').val();
                         // console.log('taxCode',taxCode);
                          var taxByhsn = data1.data_tax[0].tax_code;
                          $('#taxByItem'+hsnid).val(taxByhsn);
                          $('#headtaxCode'+hsnid).html('<b>( '+taxCode+' )</b>');
                          $('#itmtaxCode'+hsnid).html('<b>( '+taxByhsn+' )</b>');
                          
                        }


                    } /*if close*/



              }  /*success function close*/

            });  /*ajax close*/

        }else if(hsncode && taxcode==''){

            $.ajax({

              url:"{{ url('check-hsn-for-taxcode') }}",

              method : "POST",

              type: "JSON",

              data: {hsncode: hsncode},

              success:function(data){

                    var data1 = JSON.parse(data);

                    if (data1.response == 'error') {

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){
                    //  console.log(data1.data_tax[0]);
                        if(data1.data_tax == ''){
                         // $("#HsnSameShow"+hsnid).modal('show');
                        }else{

                          $('#taxSelectModel'+hsnid).modal('show');
                         $('#showtaxcodeMul'+hsnid).empty();
                          $.each(data1.data_tax, function(k, gettax){

                            var taxData = '<input type="radio" class="taxcodeset" id="html" name="taxcodeit" value="'+gettax.tax_code+'"><label for="html">'+gettax.tax_code+'</label><br>';
                            $('#showtaxcodeMul'+hsnid).append(taxData);
                              
                          });

                        }

                        //console.log(data1.data_tax[0]);

                    } /*if close*/

              }  /*success function close*/

            });  /*ajax close*/

        }

     

    }, 200);

  } /*function close*/

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



</script>



<script type="text/javascript">

</script>

<script type="text/javascript">
  
  $(document).ready(function(){
    $('#CalPayTerms').on('click',function(){
       var allgrandAmt =  parseFloat($('#allgrandAmt').val());
       $('#cr_amt_PT').val(allgrandAmt.toFixed(2));

       var advance_rate = $('#advance_rate').val();
       if(advance_rate){
          var cr_amt_PT = $('#cr_amt_PT').val();

          var calAdvAmt = parseFloat(cr_amt_PT) * parseFloat(advance_rate) /100;
          $('#advance_Amt').val(calAdvAmt);
       }
    });

    $('#advRateInd').on('change',function(){
        var advRateInd = $(this).val();

        if(advRateInd == 'L'){
          $('#advance_rate').prop('readonly',true);
          $('#advance_Amt').prop('readonly',false);
            var advance_rate = $('#advance_rate').val();
          if(advance_rate){
            $('#advance_rate').val('');
            $('#advance_Amt').val('');
          }else{}
        }else{
          $('#advance_rate').prop('readonly',false);
          $('#advance_Amt').prop('readonly',true);
        }
    });

    $('#advance_rate').on('input',function(){
      var advance_rate = $(this).val();

      if(advance_rate){
          var cr_amt_PT = $('#cr_amt_PT').val();

          var calAdvAmt = parseFloat(cr_amt_PT) * parseFloat(advance_rate) /100;
          $('#advance_Amt').val(calAdvAmt);
      }else{
        $('#advance_Amt').val('');
      }

    })

    $('#advance_Amt').on('input',function(){
      var Adv_amt = $(this).val();
      var crAmt = $('#cr_amt_PT').val();

      if(parseFloat(Adv_amt) > parseFloat(crAmt)){

          $("#errmsg").html('advice ammount should be less than cr ammount').css('color','red');
          $('#advance_Amt').val('');
      

      }else{
        $("#errmsg").html('');
      }

     

    })

    $('#payment_trem_apply').on('click',function(){

      var paymentTerms = $('#paymentTerms').val();
      
      var cr_amt_PT = $('#cr_amt_PT').val();
      var advRateInd = $('#advRateInd').val();
      var advance_rate = $('#advance_rate').val();
      var advance_Amt = $('#advance_Amt').val();
        $('#slectpaytrem').val(paymentTerms);
        $('#slectcramt_PT').val(cr_amt_PT);
        $('#selectadvRateInd').val(advRateInd);
        $('#selectadvance_rate').val(advance_rate);
        $('#selectadvance_Amt').val(advance_Amt);

    });

    $('#paymentTerms').on('change',function(){

        var payterm = $(this).val();
        if( payterm == 'Adhoc'){
            var crAmt = $('#cr_amt_PT').val();
            $('#advRateInd').val('L');
            $('#advRateInd').attr("style", "pointer-events: none;");
            $('#advance_rate').val('');
            $('#advance_rate').prop('readonly',true);
            $('#advance_Amt').prop('readonly',false);
            $('#advance_Amt').val(crAmt);
        }else{
            $('#advRateInd').attr("style", "pointer-events: auto;");
            $('#advRateInd').val('');
            $('#advance_rate').prop('readonly',false);
            $('#advance_Amt').prop('readonly',true);
            $('#advance_Amt').val('');
        }
    });
  });
</script>

<script type="text/javascript">

$(document).ready(function(){

    $("#submitdata").click(function(event) {


      var trcount=$('table tr').length;

      var grandAmt = $('#allgrandAmt').val();

      var valuetax= [];
      for(var y=0;y<trcount;y++){
        var trid = y+1;
       var ifnotaply = $('#aplytaxOrNot'+trid).html();

        valuetax.push(ifnotaply);
       
      }

      var found = valuetax.find(function (element) {
        return element == 0;
      });

       /* if(found == 0 && grandAmt < 0){
            $("#taxNotAppied").modal('show');
            $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');
            $('#grAmtIsGreatMsg').html('The <b>Grand Amount</b> Should Not Be Negative');
        }else if(found == 0){
              $("#taxNotAppied").modal('show');
              $('#grAmtIsGreatMsg').html('');
              $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');
              
        }else if(grandAmt < 0){
            $("#taxNotAppied").modal('show');
               $('#taxnotApMsg').html('');
            $('#grAmtIsGreatMsg').html('The <b>Grand Amount</b> Should Not Be Negative');
            
        }else{
*/
          var data = $("#salesQuoTrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/finance/save-sale-order-trans') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                //console.log(data);
               var url = "{{url('transaction/sale/sale-order-save-msg')}}"
              setTimeout(function(){ window.location = url+'/savedata'; });
              },

          });

      //}
             
    });

});

</script>

<script type="text/javascript">
function getvalue(staticvalue){

if(staticvalue==1){

            $('#paymentcancelbtn').html(''); 
            $('#paymentokbtn').html('');

          var appliedbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue"><small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';

          $('#paymentokbtn').html(appliedbtn);
         
           

          $('#submitdata').prop('disabled', false);
         // $('#cancelbtn'+getvalue).html('');

      
      }else{
         
          $('#paymentokbtn').html('');
          $('#paymentcancelbtn').html('');
          $('#slectpaytrem').val('');
          $('#selectadvRateInd').val('');
          $('#selectadvance_rate').val('');
          $('#selectadvance_Amt').val('');

         var cnclbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';


         $('#paymentcancelbtn').html(cnclbtn);

             
          //$('#appliedbtn'+getvalue).html('');
         // $('#submitdata').prop('disabled', true);
         
      }

}
</script>

<script type="text/javascript">

  function qty_parameter(qty){

   var ItmCdbyq = $("#ItemCodeId"+qty).val();
   var ItmCd = $("#Item_CodeId"+qty).val();
   var sc_headid = $("#sc_headid"+qty).val();
   var sc_bodyid = $("#sc_bodyid"+qty).val();

    if(ItmCdbyq){
    	var ItemCode = ItmCdbyq;
    }else if(ItmCd){
   		var ItemCode = ItmCd;
    }

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
    });

    $.ajax({

        type: 'POST',

        url: "{{ url('/get-quo-parameter-for-sale-order') }}",

        data: {ItemCode:ItemCode,sc_headid:sc_headid,sc_bodyid:sc_bodyid}, // here $(this) refers to the ajax object not form
        success: function (data) {

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                  if(data1.data==''){

                    }else{

                      $('#qua_par_'+qty).empty();

                       var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

                      $('#qua_par_'+qty).append(TableHeadData);

                      var sr_no=1;
                      $.each(data1.data, function(k, getData) {

                        if(data1.item_code){
                          var item_code = data1.item_code;
                        }else if(getData.item_code){
                           var item_code = getData.item_code;
                        }

                        var quaP_count = data1.data.length;
                        $('#quaP_count'+qty).val(quaP_count);

                        var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.item_category+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+getData.iqua_char+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_decs_"+qty+"_"+sr_no+"' name='iqua_desc[]' class='form-control inputtaxInd' value="+getData.iqua_desc+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+getData.char_fromvalue+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+getData.char_tovalue+" ></div></div> ";

                        $('#qua_par_'+qty).append(TableBody);
                        
                        sr_no++ 
                      });


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

  }

</script>



@endsection