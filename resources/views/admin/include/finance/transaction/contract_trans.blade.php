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


}
.hiddenicon{
  display: none;
}

::placeholder {
  
  text-align:left;
}

.tolrancehide{
  display: none !important;
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


  .texIndbox2{
  width: 45%; 
  text-align: center;
}
.itmdetlheading{
  width: 45%; 
  text-align: center;
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
          <a href="{{ url('/finance/transaction/purchase-order-transaction') }}"> Contract Transaction</a>
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

                <a href="{{ url('/finance/transaction/view-contract-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

                              <input type="text" class="form-control transdatepicker rightcontent" name="vr" id="vr_date" value="{{ $CurrentDate }}" placeholder="Select Date" autocomplete="off">

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
                            <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="<?php if($series == 1){echo $series_list[0]->series_code;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                            <datalist id="seriesList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($series_list as $key)

                                <option value='<?php echo $key->series_code?>'   data-xyz ="<?php echo $key->series_name; ?>" ><?php echo $key->series_name ; echo " [".$key->series_code."]" ; ?></option>

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


                              <input type="text" class="form-control" name="tran" value="<?php if($series == 1){echo $series_list[0]->series_name;}else{} ?>" id="seriesName" placeholder="Enter Series Name" readonly autocomplete="off">

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

                            <input type="hidden" name="" value="{{$to_num}}" id="vr_last_num">

                            <input type="text" class="form-control rightcontent" name="vro" value="<?php if($vrNumber==''){echo $last_num;}else{echo $vrNumber+1;} ?>" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

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
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" value="<?php if($plntCount ==1){echo $plant_list[0]->plant_code;}?>" autocomplete="off">

                              <datalist id="PlantcodeList">

                                 <option value="">--SELECT--</option>
                                 @foreach ($plant_list as $key)

                                <option value='<?php echo $key->plant_code?>'   data-xyz ="<?php echo $key->plant_name; ?>" ><?php echo $key->plant_name ; echo " [".$key->plant_code."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small>  

                                <div class="pull-left showSeletedName" id="plantText"></div>

                            </small>

                            <small id="plant_err" style="color: red;"> </small>

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

                              <input type="text" class="form-control" name="plantname" value="<?php if($plntCount ==1){echo $plant_list[0]->plant_name;}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

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

                          <label>Acc Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 4px 12px;" >

                                  <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>
                                
                                <div class="" id="appndplantbtn"> 
                                </div>

                                 <?php $acc = count($getacc); ?>
                                 <?php if($acc == 1) { ?>

                                  <button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getplantdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>

                                 <?php } else{ ?>

                                    <i class="fa fa-newspaper-o" aria-hidden="true" id="showicon"></i>

                                 <?php } ?>

                              </span>
                              
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="<?php if($acc == 1){echo $getacc[0]->acc_code;}else{echo old('AccCode');} ?>" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off"> 

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

                      <div class="col-md-3">

                        <div class="form-group ">

                          <label> Account Name : </label>

                            <div class="input-group tooltips">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="acctname" value="<?php if($acc == 1){echo $getacc[0]->acc_name;}else{} ?>" id="accountName" placeholder="Enter Profit Account Name" readonly autocomplete="off">

                               <span class="tooltiptext tooltiphide" id="accountNameTooltip"></span>

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


                      

                    </div> <!-- row -->

                    <div class="row">

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Tax Code: 
                            <span class="required-field"></span>
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <?php $taxcode = count($tax_code_list); ?>
                              <input list="TaxcodeList"  id="tax_code" name="taxcode" class="form-control  pull-left" value="<?php if($taxcode == 1){echo $tax_code_list[0]->tax_code;}else{echo old('taxcode');} ?>" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

                              <datalist id="TaxcodeList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($tax_code_list as $key)

                                  <option value='<?php echo $key->tax_code?>'   data-xyz ="<?php echo $key->tax_code; ?>" ><?php echo $key->tax_code ; echo " [".$key->tax_code."]" ; ?></option>

                                @endforeach

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

                              <input type="text" id="due_days" name="due_days" class="form-control  pull-left Number" value="{{ old('due_days')}}" placeholder="Enter Due Days" autocomplete="off" style="text-align: end;">

                            </div>

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

                                <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="{{ old('vr_date')}}" placeholder="Select Party Ref Date" autocomplete="off">

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

                                  <input list="consineList"  id="consine_code" name="consine" class="form-control pull-left" value="{{ old('consine')}}" placeholder="Select consine" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                                  <datalist id="consineList">

                                    <option selected="selected" value="">-- Select --</option>

                                    @foreach ($getacc as $key)

                                    <option value='<?php echo $key->acc_code?>'   data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>

                                    @endforeach

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

                                  <input type="text" class="form-control" name="Rfhead_1" placeholder="Enter Rfhead1" maxlength="30" id="rfhead1" oninput="rfheadget(1)" autocomplete="off">

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

                                  <input type="text" class="form-control" name="Rfhead_2" placeholder="Enter Rfhead2" maxlength="30" id="rfhead2" oninput="rfheadget(2)">

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

                          if(isset($rfhead->rfhead4) && $rfhead->rfhead4 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead4 ?> :</label>

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

                          if(isset($rfhead->rfhead5) && $rfhead->rfhead5 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead5 ?> :</label>

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
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
                  <input type ="hidden" name="tax_code" id="getTaxCode">
                  <input type="hidden" name="getdue_date" id="gateduedate">
                  
                  <input type ="hidden" name="party_ref_no" id="getpartyrfNo">
                  <input type ="hidden" name="party_ref_date" id="getpartyrfDate">
                  <input type ="hidden" name="consine_code" id="getcosine">
                  <input type ="hidden" name="rfhead1" id="getrfhead1">
                  <input type ="hidden" name="rfhead2" id="getrfhead2">
                  <input type ="hidden" name="rfhead3" id="getrfhead3">
                  <input type ="hidden" name="rfhead4" id="getrfhead4">
                  <input type ="hidden" name="rfhead5" id="getrfhead5">
                  <input type ="hidden" name="quotation_no" id="getQuotatnNo">

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
                        <input type="text" class="inputboxclr SetInCenter showhideItm" style="width: 90px;margin-bottom: 5px;" id='Item_CodeId1' name="item_codeQc[]" onclick="ShowItemCode(1);"  onchange="ItemCodeGet(1); checktaxCode(1);taxIntaxrate(1);getQtyFrQuoComp(1);"  oninput="this.value = this.value.toUpperCase()" readonly />

                        <input list="Item_List1" class="inputboxclr SetInCenter prefitmSelect" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId1' name="item_codeAll[]" onchange="ItemCodeGet(1); checktaxCode(1);taxIntaxrate(1);getQtyFrQuoComp(1);"  oninput="this.value = this.value.toUpperCase()">


                        <datalist id="Item_List1">
                          <option selected="selected" value="">-- Select --</option>

                            @foreach ($help_item_list as $key)

                            <option value='<?php echo $key->item_code?>' data-xyz ="<?php echo $key->item_name; ?>" ><?php echo $key->item_name ; echo " [".$key->item_code."]" ; ?></option>

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

                      <input type="text" name="add_unit_M[]" id="AddUnitM1" class="inputboxclr SetInCenter AddM" readonly>

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
                       <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1); getGrandTotal(1); grandCalculation(1);" disabled="">Calc Tax </button>
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

          <div class="modal-content" style="border-radius: 5px;">

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
                width: 3%; 
                text-align: center;
              }
              .texIndbox_itm{
                width: 20%;
              }
              .texIndbox_vr{
                width: 12%;
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

              </div>

            </div>

          </div>

        </div>
      <!-- end modal for tolarence -->


      <!-- show model when click on item code -->

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

      <!-- when click on quality Parameter -->

      <div class="modal fade" id="quality_parametr1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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
<script src="{{ URL::asset('public/dist/js/viewjs/contract_trans.js') }}" ></script>
  
<script type="text/javascript">

  $(document).ready(function() {

     $('#due_days').on('input',function(){
      
        dueDays = parseInt($('#due_days').val());

        if(dueDays){
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

            if(isNaN(dueDays)){
              
              $("#due_date").val('');
               $('#due_days').css('border-color','#ff0000').focus();
               $('#gateduedate').val('');
            }else{

            $("#due_date").val(duedate);
            $('#gateduedate').val(duedate);
            $("#ItemCodeId1").prop('readonly',false);
            $('#due_days').css('border-color','#d2d6de');

            }

           if (/\D/g.test(this.value))
            {
              // Filter non-digits from input value.
              this.value = this.value.replace(/\D/g, '');
            }
        }else{
          $('#due_date').val('');
          $('#gateduedate').val('');
          $('#ItemCodeId1').prop('readonly',true);
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

     $("#Plant_code").change(function(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var Plant_code =  $(this).val();
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
                    }else{
                      $('#profitctrId').val(data1.data[0].pfct_code);
                      $('#pfctName').val(data1.data[0].pfct_name);
                      $('#getPfctCode').val(data1.data[0].pfct_code);

                    }

                }

            }

          });

      });



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
                        $('#ItemCodeId1').removeClass('showhideItm_itm');
                         $('#levelget').val('');
                      }else{
                        $('#Item_CodeId1').removeClass('showhideItm');
                        $('#ItemCodeId1').addClass('showhideItm_itm');
                        $('#levelget').val(data1.data[0].level);
                      }
                  }

                }
          });
      });

      $('#account_code').on('change',function(){

          $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

          });

          var acc_code =  $('#account_code').val();

           //$('#Item_CodeId1').addClass('showhideItm');
           //$('#ItemCodeId1').removeClass('showhideItm_itm');

          //if(Quotn_compare_no == ''){

           // $('#Item_CodeId1').addClass('showhideItm');
           // $('#ItemCodeId1').removeClass('showhideItm_itm');

         // }else{

            //$('#Item_CodeId1').removeClass('showhideItm');
           // $('#ItemCodeId1').addClass('showhideItm_itm');

           // $("#Item_List1").empty();

              $.ajax({

                url:"{{ url('get-QcNum-by-account') }}",

                method : "POST",

                type: "JSON",

                data: {acc_code: acc_code},

                success:function(data){

                  var data1 = JSON.parse(data);

                  //console.log('data1',data1);
                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                       $("#qtnCompList").empty();
                        $('#Quotn_compare_no').val('');
                        $('#getQuotatnNo').val('');
                        $('#itmCountchk').val('');
                        $('#qcNotFound').html('Quotation No Not Found');
                    }else if(data1.response == 'success'){

                      console.log('data1.data',data1.data);

                      if(data1.data == ''){
                        $("#qtnCompList").empty();
                        $('#Quotn_compare_no').val('');
                        $('#getQuotatnNo').val('');
                        $('#itmCountchk').val('');
                      }else{
                        $('#qcNotFound').html('');
                        $("#qtnCompList").empty();
                        $('#Quotn_compare_no').val('');
                        $('#getQuotatnNo').val('');
                        $('#itmCountchk').val('');
                       
                        $.each(data1.data, function(k, getData){

                          $("#qtnCompList").append($('<option>',{

                            value:getData.qc_no,

                            'data-xyz':getData.qc_no,
                            text:getData.qc_no

                          }));

                        });
                        
                      }

                       
                      

                    }

                }

              });

         // }


          
         

      });

  });

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
                  $('#ItemCodeId'+itemval).removeClass('showhideItm_itm');

                }else{

                  $('#Item_CodeId'+itemval).removeClass('showhideItm');
                  $('#ItemCodeId'+itemval).addClass('showhideItm_itm');

                  $('#allItemShow'+itemval).modal('show');

                  $('#itemListShow_'+itemval).empty();

                  var tableHead= "<div class='box-row'><div class='box10 texIndbox'>#</div><div class='box10 rateIndbox' style='width: 6%;'>Vr. No</div><div class='box10 rateIndbox'>Item Name</div><div class='box10 rateIndbox'>Quo. Qty </div><div class='box10 rateIndbox'>Contract Qty </div><div class='box10 rateIndbox'>Quo. Bal. Qty </div><div class='box10 rateIndbox'>Level</div></div>";

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
                      
                    }                  
                  $.each(data1.data, function(k, getData) {

                    if(getData.qty_issued == null){
                      var qtyissued = 0.000;
                    }else{
                      var qtyissued =getData.qty_issued;
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
                    var tableBody = "<div class='box-row' id='hidebalNull_"+itemval+"_"+incemntval+"'><div class='box10 texIndbox'><input type='radio' id='sr_"+itemval+"_"+incemntval+"' name='itemname' value='"+itemval+"_"+incemntval+"' class='radiobtn"+itemval+"'><input type='hidden' value="+getData.vrno+" name='refvrno' id='povrno_"+itemval+"_"+incemntval+"'><input type='hidden' value="+getData.pur_qtn_head_id+" name='' id='pqheadid_"+itemval+"_"+incemntval+"'><input type='hidden' value="+getData.pur_qtn_body_id+" name='' id='pqbodyid_"+itemval+"_"+incemntval+"'><input type='hidden' value="+getData.qtn_no+" name='' id='pqnoid_"+itemval+"_"+incemntval+"'></div><div class='box10 texIndbox_vr'><input type='text' id='vrno_"+itemval+"_"+incemntval+"' name='head_tax_ind11[]' class='form-control inputtaxInd ' value="+getData.qc_no+" readonly></div><div class='box10 texIndbox_itm tooltips'><input type='text' id='itemcode_"+itemval+"_"+incemntval+"' name='poitemname[]' class='form-control inputtaxInd' value='"+getData.item+"("+getData.item_name+" )"+"' readonly><div class='tooltiptextitem tooltiphide' id='itemNameTooltip_"+itemval+"_"+incemntval+"'></div><input type='hidden' id='itemname_"+itemval+"_"+incemntval+"' name='poitemcode[]' class='form-control inputtaxInd' value='"+getData.item_name+"' readonly><input type='hidden' id='discriptin_"+itemval+"_"+incemntval+"' name='' class='form-control inputtaxInd' value='"+getData.perticular+"' readonly></div><div class='box10 rateIndbox'><input type='text' id='qtyOreder_"+itemval+"_"+incemntval+"' name='qtyOrder' class='form-control rightcontent' value="+getData.qty+" readonly><input type='hidden' value="+getData.rate+" id='rateqNo_"+itemval+"_"+incemntval+"'><input type='hidden' value="+getData.Aqty+" id='aqtyNo_"+itemval+"_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='qtySupply_"+itemval+"_"+incemntval+"' name='qtySupply[]' class='form-control rightcontent' value="+qtyissued+" readonly></div><div class='box10 rateIndbox'><input type='text' id='balence_qty_"+itemval+"_"+incemntval+"' name='balQty[]' class='form-control rightcontent' value="+getData.qty+" readonly><input type='hidden' class='form-control' id='remainBalQty_"+itemval+"_"+incemntval+"' value='' readonly></div><div class='box10 rateIndbox'><input type='text' id='qlevel_"+itemval+"_"+incemntval+"' name='' class='form-control rightcontent' value="+getData.level+" readonly></div></div>";

                    //console.log('tableBody',tableBody);

                    $('#itemListShow_'+itemval).append(tableBody);

                     $('#itemNameTooltip_'+itemval+'_'+incemntval).removeClass('tooltiphide');

                     $('#itemNameTooltip_'+itemval+'_'+incemntval).html(getData.item_name);

                    getItemForCheckQty(itemval,incemntval);

                    inval = incemntval;

                    incemntval++;

                  }); //each loop close

                  var butn =  $('#footer_item_'+itemval).find(':button').html();

                  if(butn != 'Ok' || butn =='undefined'){

                      var tablefooter = "<button type='button' class='btn btn-primary ' style='width: 16%;' data-dismiss='modal' id='ApplyOkbtn"+itemval+"' onclick='selectitem("+itemval+","+inval+");umAumByitm("+itemval+","+inval+");checktaxCode("+itemval+");taxIntaxrate("+itemval+")'>Ok</button><button type='button' class='btn btn-danger notshowcnlbtn' data-dismiss='modal' style='width: 16%;' id='addbtnwhenselect"+itemval+"'>Cancel</button>";

                        $('#footer_item_'+itemval).append(tablefooter);

                  }else{

                  }

                  var selectedItem = $('#selectItem'+itemval).val();

                  console.log('selectedItem',selectedItem);

                  var uniqByitm = $('#idsun'+itemval).val();

                   if(selectedItem){

                    $('#sr_'+uniqByitm).prop('checked',true);

                    $('#ApplyOkbtn'+itemval).prop('disabled',true);

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

      var balenceQty =  orderQty - suplyQty;

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

        console.log('addlQty',addlQty);
        
        var qtyOreder      = $('#qtyOreder_'+res1+'_'+res2).val();
        
        var qtySupply      = $('#qtySupply_'+res1+'_'+res2).val();
        
        var pqheadid       = $('#pqheadid_'+res1+'_'+res2).val();
        var pqbodyid       = $('#pqbodyid_'+res1+'_'+res2).val();
        var pqnoid         = $('#pqnoid_'+res1+'_'+res2).val();
        var qcvrno         = $('#vrno_'+res1+'_'+res2).val();
        var deiscriptn     = $('#discriptin_'+res1+'_'+res2).val();
        var qclevel        = $('#qlevel_'+res1+'_'+res2).val();

        console.log('deiscriptn',deiscriptn);

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
       // $('#A_qty'+rowid).val(addlQty);
        
        $('#qty'+rowid).prop('readonly',false);
        $('#rate'+rowid).prop('readonly',false);
        $('#CalcTax'+rowid).prop('readonly',false);
        $('#remark_data'+rowid).prop('readonly',false);
        
        $('#pQtnHeadId'+rowid).val(pqheadid);
        $('#pQtnBodyId'+rowid).val(pqbodyid);
        $('#pQtnNo'+rowid).val(pqnoid);
        $('#qcNo'+rowid).val(qcvrno);
        $('#remark_data'+rowid).val(deiscriptn);
        $('#getlevel'+rowid).val(qclevel);
        $('#vr_date,#Plant_code,#series_code,#account_code,#Quotn_compare_no,#due_days,#tax_code,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

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
                     $('#vr_date,#Plant_code,#series_code,#account_code,#Quotn_compare_no,#due_days,#tax_code,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

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

      console.log('umaumvl',umaumvl);
      console.log('cfval',cfval);

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

                      $('#UnitM'+umaumvl).val(data1.data[0].um_code);

                      $('#AddUnitM'+umaumvl).val(data1.data[0].aum);

                      $('#Cfactor'+umaumvl).val(data1.data[0].aum_factor);

                      var aQtycal = getqty * data1.data[0].aum_factor;
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

                      $('#Item_Name_id'+umaumvl).val(data1.data_hsn.item_name);

                      $('#viewItemDetail'+umaumvl).removeClass('showdetail');

                     $('#itemNameTooltip'+umaumvl).removeClass('tooltiphide');

                     $('#itemNameTooltip'+umaumvl).html(data1.data_hsn.item_name); 


                      $('#hsn_code'+umaumvl).val(data1.data_hsn.hsn_code);

                      $('#showHsnCd'+umaumvl).html('HSN No : '+data1.data_hsn.hsn_code);
                    }

                    if(data1.qua_pamter == ''){
                      $('#qua_paramter'+umaumvl).prop('disabled',true);
                    }else{
                      $('#qua_paramter'+umaumvl).prop('disabled',false);
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

      console.log('ItemCode',ItemCode);
      $.ajax({

              url:"{{ url('get-a-field-by-trans-code') }}",

              method : "POST",

              type: "JSON",

              data: {tax_code: tax_code,purQtnHeadId:purQtnHeadId,PurQtnBodyId:PurQtnBodyId,ItemCode:ItemCode},

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

                          console.log('data1.data',data1.data);

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

                            if ((getData.rate_index == null && getData.tax_rate == null) || getData.rate_index == null || getData.tax_rate == null || (getData.rate_index == '-' && getData.tax_rate == '---') || getData.rate_index == '-' || getData.tax_rate == '---') {

                             $('#tax_code'+taxid).val(getData.tax_code);
                             
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly>  </div><div class='box10 rateIndbox'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'></div></div>";



                            }else{

                                if(getData.tax_ind_name == 'GrandTotal'){
                                  var classname = 'grandTotalGet';
                                }else{
                                  var classname = '';
                                }



                                //console.log('rate',javascript_array);
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly></div><div class='box10 rateIndbox'> <input type='text' class='form-control' name='rate_ind[]' value='"+getData.rate_index+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+"); grandCalculation("+taxid+");'> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a> </div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.tax_rate+"' class='form-control' oninput='getGrandTotal("+taxid+"); grandCalculation("+taxid+");' ></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='' oninput='getGrandTotal("+taxid+"); grandCalculation("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+getData.tax_logic+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+getData.static+"'></div></div> <div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->rt_value ?>'>&nbsp;&nbsp;<?php echo $key->rt_value ?> - <?php echo $key->rate_name ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+"); grandCalculation("+counter+");'>Apply</button></div></div></div></div>";

                              

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

            $('#FirstBlckAmnt_'+getid+"_"+l).val(amntF_R.toFixed(2));
        }else{}

        



 

      }

    }, 500);

    $('.modalspinner').removeClass('hideloaderOnModl');
      //$("#total_cramount").val(parseFloat(totalAmount));
    //$("#temp_cramount").val(Math.round(parseFloat(totalAmount))); 
  } /*function close*/

  function indicatorCalculation(indicator,rate,logic,l,incNum){

    var totalLogicVal = 0;

   // console.log('totalLogicVal',totalLogicVal);

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



    //$("#FirstBlckAmnt_"+incNum+"_"+l).val(0);

    if(indicator == 'A'){
      roundofrate= ((parseFloat(totalLogicVal) * rate)/100);
      roundof= Math.round(roundofrate) - parseFloat(totalLogicVal);
         $("#FirstBlckAmnt_"+incNum+"_"+l).val(roundof.toFixed(2));
 
    }

    if(indicator=="N"){

        amtMinus= -((parseFloat(totalLogicVal) * rate)/100);    

        $("#FirstBlckAmnt_"+incNum+"_"+l).val(amtMinus.toFixed(2));

        console.log('amtMinus',totalLogicVal);
        console.log('amtMinus',rate);
        console.log('amtMinus',amtMinus);

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

         /* if(indicator1=="M"){      

            indicatorM = parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val());

            indicatorMAmt= parseFloat(indicatorMAmt) +  indicatorM;

          }*/

          if(indicator1=="M"){      
            indicatorM = parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val());
            indicatorMAmt=  parseFloat(Math.round(indicatorMAmt*Math.pow(10,2))/Math.pow(10,2)) +  indicatorM;
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

         /* if(indicator1=="A"){      



            indicatorA = Math.round(parseFloat($("#FirstBlckAmnt_"+unicId+"_"+r).val()));

            indicatorAAmt= parseFloat(indicatorAAmt) + indicatorA;

          }*/

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

          

        } /*--for loop close--*/

        $("#totalval"+unicId).val(parseFloat(totalAmount).toFixed(2));

        var totalAmt  =  parseFloat($("#totalval"+unicId).val());

        var BasicAmt  =  parseFloat($("#FirstBlckAmnt_"+unicId+"_1").val());

        var netPay = totalAmt + BasicAmt;

         $('#NetPay'+unicId).val(netPay.toFixed(2));

    }, 1000);

  } /*--function close--*/


  function ind_forChange(rowid,countid){

      $('#indicatorShow_'+rowid+'_'+countid).modal('show');
      var already_ind = $('#indicator_'+rowid+'_'+countid).val();

      for(var w=1;w<=9;w++){

      var setInd = $('#cInd_'+rowid+'_'+countid+'_'+w).val();

         if(setInd == already_ind){
              $('#cInd_'+rowid+'_'+countid+'_'+w).prop('checked',true);
         }

      }

  }

  function setIndOnOk(indid,indnmeid){

   var ind_value= $("input[type='radio'][name='chang_indval']:checked").val();
   //console.log('ind_value',ind_value);
  $('#indicator_'+indid+'_'+indnmeid).val(ind_value);

    $('#indicatorShow_'+indid+'_'+indnmeid).modal('hide');



  } 



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

                        if(getData.tax_ind_name == 'GrandTotal'){
                                  var classname = 'grandTotalGet';
                                }else{
                                  var classname = '';
                                }

                         var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly></div><div class='box10 rateIndbox'> <select  class='form-control' name='rate_ind[]' id='indicator_"+taxid+"_"+counter+"' onchange='CalculateTax("+taxid+"); getGrandTotal("+taxid+"); grandCalculation("+taxid+");'> <option value=''>--select--</option></select></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='rate_"+taxid+"_"+counter+"' value='"+getData.tax_rate+"' name='af_rate[]' class='form-control' oninput='CalculateTax("+taxid+"); getGrandTotal("+taxid+"); grandCalculation("+taxid+");'></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='' oninput='CalculateTax("+taxid+"); getGrandTotal("+taxid+"); grandCalculation("+taxid+");'><input type='hidden' name='logic_"+counter+"' id='logic_id_"+taxid+"_"+counter+"' value='"+getData.tax_logic+"'><input type='hidden' name='static_"+counter+"' id='static_id_"+taxid+"_"+counter+"' value='"+getData.static+"'></div></div>";

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


      
      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });


      var Plant_code =  $('#Plant_code').val();

      $('#getPlantCode').val(Plant_code);

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
                }else{
                  $('#profitctrId').val(data1.data[0].pfct_code);
                  $('#pfctName').val(data1.data[0].pfct_name);
                  $('#getPfctCode').val(data1.data[0].pfct_code);

                }

            }

        }

      });

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

      data +="<td class='tdthtablebordr'><div class='input-group'><input type='text' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='Item_CodeId"+i+"' name='item_codeQc[]' onclick='ShowItemCode("+i+");'  onchange='ItemCodeGet("+i+"); checktaxCode("+i+");taxIntaxrate("+i+");getQtyFrQuoComp("+i+");'  oninput='this.value = this.value.toUpperCase()' readonly /><input list='Item_List"+i+"' class='inputboxclr SetInCenter prefitmSelect' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' name='item_codeAll[]' onchange='ItemCodeGet("+i+"); checktaxCode("+i+");taxIntaxrate("+i+");getQtyFrQuoComp("+i+");'  oninput='this.value = this.value.toUpperCase()'> <datalist id='Item_List"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($help_item_list as $key)<option value='<?php echo $key->item_code?>' data-xyz ='<?php echo $key->item_name; ?>' ><?php echo $key->item_name ; echo ' ['.$key->item_code.']' ; ?></option> @endforeach</datalist><input type='hidden' id='selectItem"+i+"'><input type='hidden' id='idsun"+i+"'> <input type='hidden' id='pQtnHeadId"+i+"' name='pur_QtnHeadId[]'> <input type='hidden' id='pQtnBodyId"+i+"' name='pur_qtnbodyid[]'> <input type='hidden' id='pQtnNo"+i+"' name='qtnNos[]'><input type='hidden' id='qcNo"+i+"' name='qtn_compNo[]'> <input type='hidden' id='itmGetCode"+i+"' name='item_code[]'><input type='hidden' id='getlevel"+i+"' name='levelI[]'></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button> <div class='divhsn' id='showHsnCd"+i+"'></div> <input type='hidden' id='hsn_code"+i+"' name='hsn_code[]'> <input type='hidden' id='taxByItem"+i+"' name='tax_byitem[]'><input type='hidden' id='taxratebytax"+i+"' value=''><input type='hidden' id='pur_qtn_head_id"+i+"' > <input type='hidden' id='purqtn_body_id"+i+"' > <input type='hidden' id='purqtn_head_id"+i+"' ><input type='hidden' id='purb_id_fpurtax"+i+"' > </td> <td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly /><div class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></div><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description'></textarea></td> <td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='qty"+i+"' name='qty[]' oninput='CalAQty("+i+")' style='width: 80px' /><input type='text' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' id='Cfactor"+i+"'><input type='hidden' id='balQtyByItem"+i+"'></div><div style='display: inline-flex;border: none;margin-top: 6%;'><button type='button' class='btn btn-primary btn-xs tolrancehide' id='tolranceshow"+i+"' data-toggle='modal' data-target='#view_tolrance"+i+"' onclick='tolranceDetail("+i+")' style='padding: 0px 3px 0px 3px;margin-bottom: 3px;font-size: 11px;'>Tolerance</button><input type='hidden' name='tolerence_index[]' id='settolrnceIndex"+i+"'><input type='hidden' name='tolerence_rate[]' id='setTolrnceRate"+i+"'><input type='hidden' name='tolerence_value[]' id='setTolrnceValue"+i+"'></div><div id='appliedtolrnbtn"+i+"'></div><div id='cancelbtolrntn"+i+"'></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM'></div></td> <td class='tdthtablebordr'><input type='text' class='debitcreditbox inputboxclr cr_amount SetInCenter'  oninput='calculateBasicAmt("+i+")' id='rate"+i+"' name='rate[]'  style='width: 80px'/><input type='hidden' id='qnrate"+i+"'></td> <td class='tdthtablebordr'><input type='text' name='basic_amt[]' readonly id='basic"+i+"' class='form-control basicamt' style='width: 110px;margin-top: 14%;height: 22px;' ></td> <td> <input type='hidden' id='data_count"+i+"' value='0' class='dataCountCl' name='data_Count[]'><input type='hidden' class='setGrandAmnt' name='crAmtPerItm[]' id='get_grand_num"+i+"'><div style='margin-top: 23%;'><small id='taxnotfound"+i+"' class='label label-danger'></small></div><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='CalcTax"+i+"' data-toggle='modal' data-target='#tds_rate_model"+i+"' onclick='CalculateTax("+i+"); getGrandTotal("+i+"); grandCalculation("+i+")'>Calc Tax</button><div id='appliedbtn"+i+"'></div><div id='cancelbtn"+i+"'></div><div id='aplytaxOrNot"+i+"' class='aplynotStatus'>0</div> <div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div> </div></div><div class='modal-body table-responsive'><div class='boxer' id=''> <div class='box-row'><div class='box10 texIndbox1'>Item Code</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading'><small id='itemCodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='taxcodeshow"+i+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemDetailshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemtypeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemgroupshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemclassshow"+i+"'> </small> </div> <div class='box10 itmdetlheading'><small id='itemcategoryshow"+i+"'> </small></div> </div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div><div id='allItemShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-md' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'> <div class='modal-header'> <div class='row'> <div class='col-md-12' style='text-align: center;'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Details</h5>  </div></div> </div> <div class='modal-body table-responsive'><div class='boxer' id='itemListShow_"+i+"'> </div></div> <div class='modal-footer' style='text-align: center;' id='footer_item_"+i+"'> </div></div> </div></div> <div class='modal fade' id='view_tolrance"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-sm' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tolrance</h5></div></div></div><div class='modal-body'><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Index :</label></div><div class='col-md-4'><input list='TolrnceIndex"+i+"'  id='tolrance_index"+i+"' value=''><datalist id='TolrnceIndex"+i+"'><option value=''>--Select--</option><option value='P' data-xyz='Percentage'>P - [Percentage]</option><option value='L' data-xyz='Lumsum'>L - [Lumsum]</option></datalist></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Rate :</label></div><div class='col-md-4'><input type='text' id='tolrance_rate"+i+"'  value='' oninput='ratepercent("+i+")'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tolrance Value:</label></div><div class='col-md-4'><input type='text' id='tolrance_rate_percent"+i+"'  value=' readonly=' name='tolrance_value[]'></div><div class='col-md-2'></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;' onclick='getTolerance("+i+")'>Ok</button></div></div></div></div><div id='grateQtyShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'> <div class='modal-header'> <div class='row'> <div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5> </div> </div></div> <div class='modal-body table-responsive'> <p>Quantity is grater than balence qunatity</p> </div>  <div class='modal-footer' style='text-align: center;' id='greatQtyFooter'> <button type='button' class='btn btn-secondary' data-dismiss='modal' onclick='cancleGreatQty("+i+");'>Ok</button>  </div> </div></div> </div></td><td><div style='margin-top: 12%;'><small id='qpnotfound"+i+"' class='label label-danger'></small></div><input type='hidden' id='quaP_count"+i+"' value='0' name='quaP_count[]' class='quaPcountrow'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='qua_paramter"+i+"' data-toggle='modal' data-target='#quality_parametr"+i+"' onclick='qty_parameter("+i+")' disabled='' style='padding-bottom: 0px;padding-top: 0px;'>Quality Parametr </button><div id='cancelQpbtn"+i+"'></div><div id='appliedQpbtn"+i+"'></div><div id='qpApplyOrNot"+i+"' class='aplynotStatus'>0</div><small id='qPnotfountbtn"+i+"' class='label label-danger'></small><div id='greaterRateShModel"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id=''  style='color: red;font-weight: 800;'>Alert</h5></div></div></div><div class='modal-body table-responsive'><p>Rate Should Not Be Greater</p></div><div class='modal-footer' style='text-align: center;' id='greatRateFooter"+i+"'><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div></td>";

      $('table').append(data);

      var domModel = "<div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-5'><div class='form-group'> <lable class='settaxcodemodel col-md-4' style='padding: 0px;'>Tax Code - </lable> <input type='text' class='settaxcodemodel col-md-7' id='tax_code"+i+"' style='border: none; padding: 0px;' readonly> </div> </div><div class='col-md-6'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Tax / Charges / etc Calculation</h5></div><div class='col-md-1'></div></div> </div> <div class='modal-body table-responsive'><div class='modalspinner hideloaderOnModl'></div><div class='boxer' id='tax_rate_"+i+"'><div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div> <div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div> </div> </div></div> <div class='modal-footer'><center> <small  id='footer_tax_btn"+i+"' style='width: 10px;'></small></center> </div></div></div> </div> <div id='HsnSameShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title' style='color: red;font-weight: 800;'>Alert !!</h5></div><div class='modal-body'><p>Header Tax Code  <small id='headtaxCode"+i+"'></small> Is Different Than Item Wise Tax Code <small id='itmtaxCode"+i+"'></small></p></div><div class='modal-footer'><button type='button' class='btn btn-secondary' data-dismiss='modal' onclick='cancleblnkItm("+i+");'>Cancel</button><button type='button' class='btn btn-primary' data-dismiss='modal'>Ok</button></div></div></div></div>";

       $('#domModel_2').append(domModel);

       var qpModlDom = "<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Qaulity Parameter</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+i+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footerqp_ok_btn"+i+"'></small>&nbsp<small style='text-align: center;' id='footerqp_quality_btn"+i+"'></small></center></div></div></div></div>";

       $('#quaPdomModel_2').append(qpModlDom);

       $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

          });

          var account_code =  $('#account_code').val();
          var Quotn_compare_no =  $('#Quotn_compare_no').val();

          //console.log('Quotn_compare_no',Quotn_compare_no);

          if(Quotn_compare_no == ''){

            //console.log('if ',i);

            $('#Item_CodeId'+i).prop('hidden',true);
            $('#ItemCodeId'+i).prop('hidden',false);

          }else{

            $('#Item_CodeId'+i).prop('hidden',false);
            $('#ItemCodeId'+i).prop('hidden',true);

            $("#Item_List"+i).empty();

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

                      
                        
                        $.each(data1.data, function(k, getData){

                          $("#Item_List"+i).append($('<option>',{

                            value:getData.item_code,

                            'data-xyz':getData.item_name,
                            text:getData.item_name

                          }));

                        });
                      

                    }

                }

              });

          }


      i++;row_i++;

    } /* /. else */

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
      $('#submitdata').prop('disabled',true);
      $('#CalPayTerms').prop('disabled',true);
      $('#basicTotal').val(0.00);
      $('#otherTotalAmt').val(0.00);
      $('#allgrandAmt').val(0.00);
      $("#allquaPcount").val(0);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;

          $('#'+id).html(key+1);

      });
    }

    
  }

  function showItemDetail(viewid){

    var IcFrmItm =  $('#ItemCodeId'+viewid).val();
    var IcFrmQc =  $('#Item_CodeId'+viewid).val();

    if(IcFrmItm){
        var ItemCode = IcFrmItm;
    }else if(IcFrmQc){
        var ItemCode = IcFrmQc;
    }

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

    $.ajax({

            type: 'POST',

            url: "{{ url('get-item-um-aum') }}",

            data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

             // console.log(data1);

              if(data1.data==''){
                   
              }else{  
                    //console.log();
                  $("#itemCodeshow"+viewid).html(data1.data_hsn.item_name+'<p>('+data1.data_hsn.item_code+')</p>');
                  $("#hsncodeshow"+viewid).html(data1.data_hsn.hsn_code);
                  $("#taxcodeshow"+viewid).html(data1.data_hsn.tax_code);
                  $("#itemDetailshow"+viewid).html(data1.data_hsn.item_detail);
                  $("#itemtypeshow"+viewid).html(data1.data_hsn.item_type);
                  $("#itemgroupshow"+viewid).html(data1.data_hsn.item_group);
                  $("#itemclassshow"+viewid).html(data1.data_hsn.item_class);
                  $("#itemcategoryshow"+viewid).html(data1.data_hsn.item_category);
              }
           //  console.log(data1.data);
            }

        });

  }

</script>

<script type="text/javascript">

  function ItemCodeGet(ItemId){

    $("#HsnSameShow"+ItemId).modal({
        show:false,
        backdrop:'static'
      });

      var ItemCode =  $('#ItemCodeId'+ItemId).val();
     // console.log('ItemCode',ItemCode);
      var taxCode =  $('#getTaxCode').val();
      //console.log(taxCode);

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
             $('#taxByItem'+ItemId).val('');
             $('#taxratebytax'+ItemId).val('');
             $('#CalcTax'+ItemId).hide();
             $('#pur_qtn_head_id1').val('');
             $('#purqtn_head_id'+ItemId).val('');
             $('#purqtn_body_id'+ItemId).val('');
             $('#remark_data'+ItemId).val('');
             $('#qty'+ItemId).prop('readonly',true);
             $('#remark_data'+ItemId).prop('readonly',true);
             $('#addmorhidn').prop('disabled',true);
             $('#deletehidn').prop('disabled',true);
             $('#submitdata').prop('disabled',true);
             $('#appliedbtn'+ItemId).html('');
             $('#viewItemDetail'+ItemId).addClass('showdetail');
             $('#itemNameTooltip'+ItemId).addClass('tooltiphide');
             $('#cancelbtolrntn'+ItemId).html('');
             $('#appliedtolrnbtn'+ItemId).html('');
      }else{

         $('#viewItemDetail'+ItemId).removeClass('showdetail');

         $('#tolranceshow'+ItemId).removeClass('tolrancehide');

         $('#tolranceshow'+ItemId).prop('disabled',true);

         document.getElementById("Item_Name_id"+ItemId).value = msg;
         $('#itemNameTooltip'+ItemId).removeClass('tooltiphide');

         $('#itemNameTooltip'+ItemId).html(msg); 

         $('#qty'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false); 

         $('#vr_date,#Plant_code,#series_code,#account_code,#Quotn_compare_no,#due_days,#tax_code,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

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

          data: {ItemCode: ItemCode,taxCode:taxCode},

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

                   //CalculateTax(ItemId);

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }/*function close*/

  function checktaxCode(hsnid){
    setTimeout(function() {
       var hsncode =  $('#hsn_code'+hsnid).val();
       var taxcode =  $('#tax_code').val();

      if(hsncode && taxcode){

        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

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
                //  console.log(data1.data_tax[0]);
                    if(data1.data_tax == ''){
                      $("#HsnSameShow"+hsnid).modal('show');
                    }else{

                      var taxCode = $('#getTaxCode').val();
                     // console.log('taxCode',taxCode);
                      var taxByhsn = data1.data_tax[0].tax_code;
                      $('#taxByItem'+hsnid).val(taxByhsn);
                    
                          $("#headtaxCode"+hsnid).html('<b>( '+taxCode+' )</b>');
                          $("#itmtaxCode"+hsnid).html('<b>( '+taxByhsn+' )</b>');
                        
                    }

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

        });  /*ajax close*/
      }
     
     }, 500);
  } /*function close*/

  function taxIntaxrate(trateid){
    setTimeout(function() {
      var taxCode =  $('#taxByItem'+trateid).val();
      var itmCodeQuoNo =  $('#Item_CodeId'+trateid).val();
      var itmCodeGet =  $('#ItemCodeId'+trateid).val();
      if(itmCodeQuoNo){
        var itmCode = itmCodeQuoNo;
      }else if(itmCodeGet){
        var itmCode = itmCodeGet;
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


  function getQtyFrQuoComp(qcid){
    setTimeout(function() {
      var account_code =  $('#account_code').val();
      var Quotn_compare_no =  $('#Quotn_compare_no').val();
      var ItemCode =  $('#ItemCodeId'+qcid).val();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

          url:"{{ url('get-qtn-data-from-quo-comparision') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code,Quotn_compare_no:Quotn_compare_no,ItemCode:ItemCode},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){
                //  console.log(data1.data);
                    if(data1.data == ''){
                      
                    }else{
                      var cfactor = $('#Cfactor'+qcid).val();
                      var aQty = data1.data[0].qty * cfactor;
                      $('#qty'+qcid).val(data1.data[0].qty);
                      $('#A_qty'+qcid).val(aQty);
                      $('#rate'+qcid).val(data1.data[0].rate);
                      $('#basic'+qcid).val(data1.data[0].basic);
                      $('#remark_data'+qcid).val(data1.data[0].perticular);
                      $('#pur_qtn_head_id1').val(data1.data[0].pur_qtn_head_id);
                      $('#purqtn_head_id'+qcid).val(data1.data[0].pur_qtn_head_id);
                      $('#purqtn_body_id'+qcid).val(data1.data[0].pur_qtn_body_id);
                      $('#purb_id_fpurtax'+qcid).val(data1.data[0].purchase_quotation_body_id);
                      $('#CalcTax'+qcid).prop('disabled',false);
                      $('#addmorhidn').prop('disabled',false);
                      $('#deletehidn').prop('disabled',false);
                      $('#submitdata').prop('disabled',false);
                      $('#CalPayTerms').prop('disabled',false);

                      var cnclbtn ='<input type="hidden" value="0" id="qltyvalue'+qcid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

                      $('#cancelbtn'+qcid).html(cnclbtn);

                      var cnclbtn_pay ='<input type="hidden" value="0" id="qltyvalue"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

                      $('#paymentcancelbtn').html(cnclbtn_pay);

                    //  var fpurtax = $('#purb_id_fpurtax'+qcid).val();
                    //  if(fpurtax){

                    // var cnclbtn ='<input type="hidden" value="0" id="qltyvalue'+qcid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

                    //   $('#cancelbtn'+qcid).html(cnclbtn);
                    //  }else{
                    //   $('#appliedbtn'+qcid).html('');
                    //  }

                      /*var showcount = data1.data.length;
                      $('#data_count'+qcid).val(showcount);*/

                      /*$.each(data1.data, function(k, getgrAmt){

                          if(getgrAmt.tax_ind_name =='GrandTotal'){

                            $('#get_grand_num'+qcid).val(getgrAmt.tax_amt);
                          }
                          
                      });*/

                      $('#paymentTerms').val(data1.data[0].payment_terms);
                      //$('#slectpaytrem').val(data1.data[0].payment_terms);

                      $('#advRateInd').val(data1.data[0].adv_rate_i);
                      //$('#selectadvRateInd').val(data1.data[0].adv_rate_i);

                      $('#advance_rate').val(data1.data[0].adv_rate);
                     // $('#selectadvance_rate').val(data1.data[0].adv_rate);
                      
                      var total =0;

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

                      /*var grandTotalA = parseFloat($('#allgrandAmt').val());
                      var basicTotalA = parseFloat($('#basicTotal').val());


                      var otherTotalA = grandTotalA - basicTotalA;

                      $('#otherTotalAmt').val(otherTotalA.toFixed(2));*/

                     /* var grandAmt = $('#allgrandAmt').val();
                      $('#cr_amt_PT').val(grandAmt);
                      $('#slectcramt_PT').val(grandAmt);
                      var advance_rate = $('#advance_rate').val();
                      
                       if(advance_rate){
                          var calAdvAmt = parseFloat(grandAmt) * parseFloat(advance_rate) /100;
                          $('#advance_Amt').val(calAdvAmt);
                          $('#selectadvance_Amt').val(calAdvAmt);
                       }*/

                    } /*else close*/ 

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/
     
     }, 1200);
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
         // console.log('ind',indecatoe);
          if(indecatoe == 'R'){
          var rate = $('#rate_'+incId+'_'+s).val();
          var result = parseFloat(qunatity) * parseFloat(rate);
          $('#FirstBlckAmnt_'+incId+'_'+s).val(result);
          //  console.log('when chng i',result);
          }else{}
        }
  }

  function OkGetGransVal(aplyid,datacount,countercount,staticvalue){

    if(staticvalue==1){

          $('#aplytaxOrNot'+aplyid).html('1');

         // console.log('allgrandAmt',$('#allgrandAmt').val());
          $('#cancelbtn'+aplyid).html('');
          $('#appliedbtn'+aplyid).html('');

          var appliedbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';

          $('#appliedbtn'+aplyid).html(appliedbtn);
          
          $('#submitdata').prop('disabled', false);
         // $('#cancelbtn'+getvalue).html('');

         $('#data_count'+aplyid).val(datacount);

         if(countercount == datacount){
            var g_Amnt = $('#FirstBlckAmnt_'+aplyid+'_'+countercount).val();
            $('#get_grand_num'+aplyid).val(g_Amnt);
          }

      
      }else{
        $('#aplytaxOrNot'+aplyid).html('0');
         
         $('#cancelbtn'+aplyid).html('');
         $('#appliedbtn'+aplyid).html('');
         
         var cnclbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelbtn'+aplyid).html(cnclbtn);
        $('#data_count'+aplyid).val(0);
        $('#get_grand_num'+aplyid).val('');
         
      }

      /*if(countercount == datacount){
        var g_Amnt = $('#FirstBlckAmnt_'+aplyid+'_'+countercount).val();
        $('#get_grand_num'+aplyid).val(g_Amnt);
      }else{
        $('#get_grand_num'+aplyid).val('');
      }*/
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
         $('#CalPayTerms').prop('disabled',false);
      }

         

  }

  function calculateBasicAmt(rateid){

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
        $('#CalcTax'+rateid).prop('disabled',false);
      }else{

        if(rate){

          if(chckitms == 1){
            $('#addmorhidn').prop('disabled',true);
          }else{
            $('#addmorhidn').prop('disabled',false);
          }

          $('#CalcTax'+rateid).prop('disabled',false);

        var result = qunatity * rate;

        $('#basic'+rateid).val(result.toFixed(2));

        $('#CalcTax'+rateid).prop('disabled',false);
        $('#submitdata').prop('disabled',false);
        $("#addmorhidn").prop("disabled", false );
        $("#deletehidn").prop("disabled", false );

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

            //  console.log('btotal ',btotal);

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

      //console.log('rate',rate);

      

      var total =0;

      //var basicAmnt = $('#basic'+rateid).val();
      //console.log(basicAmnt);
      $(".basicamt").each(function () {
         // console.log(this.value);
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

        var grandTotalA = parseFloat($('#allgrandAmt').val());
        var basicTotalA = parseFloat($('#basicTotal').val());


  }

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

       var purheadId =  $('#pur_qtn_head_id1').val();

       if(purheadId){

          $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
          });

          $.ajax({

            url:"{{ url('get-purchase-head-id-onpayterm') }}",

            method : "POST",

            type: "JSON",

            data: {purheadId: purheadId},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);
                  if(data1.data == ''){
                     
                    }else{
                       $('#advRateInd').val(data1.data[0].adv_rate_i);
                       $('#advance_rate').val(data1.data[0].adv_rate);
                       $('#paymentTerms').val(data1.data[0].payment_terms);

                       var cr_amt_PT = $('#cr_amt_PT').val();
                       var advance_rate = $('#advance_rate').val();

                        var calAdvAmt = parseFloat(cr_amt_PT) * parseFloat(advance_rate) /100;
                        $('#advance_Amt').val(calAdvAmt);
                    }

                }

            }

          });

       }else{

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
     // console.log(paymentTerms);
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
       
        if(found == 0 && grandAmt < 0){
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

          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/finance/save-contract-transaction') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                console.log(data);
                $('.overlay-spinner').addClass('hideloader');
               // alert(data);return false;

               var url = "{{url('finance/purchase-contract-save-msg')}}"
               setTimeout(function(){ window.location = url+'/savedata'; });
              },

          });

        }
              
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
  function getplantdata(){

  $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

  var accCode = $('#account_code').val();
 // alert(accCode);
 // console.log(sers_code);



  $.ajax({

            url:"{{ url('get-acc-data-by-acc-code') }}",

            method : "POST",

            type: "JSON",

            data: {accCode: accCode},

            success:function(data){



              var data1 = JSON.parse(data);
                
               // console.log(data1);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  
                  $("#plantCodeshow").html(data1.data[0].acc_name+'<p>('+data1.data[0].acc_code+'</p>');
                  $("#plantpfctcodeshow").html(data1.data[0].acctype_code);
                  if(data1.data[0].address1){

                  $("#plantaddshow").html(data1.data[0].address1);
                  }else{
                  $("#plantaddshow").html('Null');
                   }

                   if(data1.data[0].address2){
                  $("#plantcityshow").html(data1.data[0].address2);
                    }else{
                   $("#plantcityshow").html('Null');
                    }
                    if(data1.data[0].address3){

                  $("#plantpinshow").html(data1.data[0].address3);
                    }else{

                      $("#plantpinshow").html('Null');
                    }
                   // console.log(data1.data[0].city);
                  if(data1.data[0].city){
                  $("#plantdistshow").html(data1.data[0].city);
                  }else{
                    $("#plantdistshow").html('Null');
                    }

                  if(data1.data[0].state){
                  $("#plantstateshow").html(data1.data[0].state);
                }else{
                  $("#plantstateshow").html('Null');
                }
                if(data1.data[0].email){
                  $("#plantemailshow").html(data1.data[0].email);
                }else{
                  $("#plantemailshow").html('Null');
                }

                if(data1.data[0].phone1){
                  $("#plantphoneshow").html(data1.data[0].phone1);
                }else{
                  $("#plantphoneshow").html('Null');
                }
                

                }

            }

          });
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
  function tolranceDetail(itemcode){

     var Codeitem =  $('#ItemCodeId'+itemcode).val();
     var existTIndex =  $('#settolrnceIndex'+itemcode).val();
     var existTRate = parseFloat($('#setTolrnceRate'+itemcode).val());
     var qty =  $('#qty'+itemcode).val();

     //console.log(qty);

     if(Codeitem){

      var ItemCode = Codeitem;
     // alert('hi');

     }else{

      var ItemCode =  $('#Item_CodeId'+itemcode).val();
      //alert('hello');
     }


     $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });


     $.ajax({

            url:"{{ url('get-tolrnce-data-by-item-code') }}",

            method : "POST",

            type: "JSON",

            data: {ItemCode: ItemCode},

            success:function(data){



              var data1 = JSON.parse(data);
                
               // console.log(qty);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){


                        if(existTIndex){
                            $('#tolrance_index'+itemcode).val(existTIndex);
                        }else{
                            $('#tolrance_index'+itemcode).val(data1.data.tolerance_basis);
                        }

                        if(existTRate){
                            $('#tolrance_rate'+itemcode).val(existTRate.toFixed(2));
                             var rateper = parseFloat(qty) *parseFloat(existTRate)/100;
                            $('#tolrance_rate_percent'+itemcode).val(rateper.toFixed(2));

                        }else{
                            $('#tolrance_rate'+itemcode).val(data1.data.tolerance_qty);
                            var rateper = parseFloat(qty) * parseFloat(data1.data.tolerance_qty)/100;
                            $('#tolrance_rate_percent'+itemcode).val(rateper.toFixed(2));

                            
                        }

                }

            }

          });


  }


  function getTolerance(tolrn){
     var tolIndex =  $('#tolrance_index'+tolrn).val();
     var tolRate  =  $('#tolrance_rate'+tolrn).val();
     var tolValue =  $('#tolrance_rate_percent'+tolrn).val();
     var qty =  $('#qty'+tolrn).val();

      var sum = parseFloat(qty) + parseFloat(tolValue);


  //  alert(sum);
     if(tolIndex){
      $('#settolrnceIndex'+tolrn).val(tolIndex);
      $('#setTolrnceRate'+tolrn).val(tolRate);
      $('#setTolrnceValue'+tolrn).val(sum);
     }

      var appliedbtn ='<input type="hidden" value="'+tolrn+'" id="tolrnvalue'+tolrn+'"><small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';

      $('#appliedtolrnbtn'+tolrn).html(appliedbtn);
      $('#cancelbtolrntn'+tolrn).css('display','none');
  }
</script>

<script type="text/javascript">
  function ratepercent(ratevalue){

    var tolRate =  $('#tolrance_rate'+ratevalue).val();
    var qty =  $('#qty'+ratevalue).val();
    console.log(qty);

    if(tolRate){
      var calculateRatePer = parseFloat(tolRate)*parseFloat(qty)/100;
    }else{
      var calculateRatePer='';
    }

    $('#tolrance_rate_percent'+ratevalue).val(calculateRatePer.toFixed(2));

    //console.log(calculateRatePer);

  }

  function qty_parameter(qty){

    var itemCodebypo = $('#Item_CodeId'+qty).val();
    var itemCodeId = $('#ItemCodeId'+qty).val();

      if(itemCodebypo){
        var itemCode = itemCodebypo;
      }else if(itemCodeId){
        var itemCode =itemCodeId;
      }

    var pquoHeadId = $("#po_headid"+qty).val();
    var pquobodyId = $("#po_bodyid"+qty).val();


      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/get-qty-parameter-frm-purchase-quo-by-itm') }}",

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


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

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
                              
                             
                          sr_no++ });


                          var butn =  $('#footerqp_quality_btn'+qty).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+qty+"' onclick='getQuaPvalue("+qty+",1)' style='width: 36px;'>Ok</button>";

                           $('#footerqp_quality_btn'+qty).append(tblData);

                             var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'   onclick='getQuaPvalue("+qty+",0)' disabled>Cancel</button>";
                             
                           $('#footerqp_ok_btn'+qty).append(cancelfooter);

                         }else{
                          
                         }

                        }

                    }
           
            
            },

        });

  }  /* ./ quality Paramter*/


  function getQuaPvalue(rowid,isApNot){

      if(isApNot==1){

          $('#cancelQpbtn'+rowid).empty();
          $('#appliedQpbtn'+rowid).empty();

          var appliedbtn ='<small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';

          $('#appliedQpbtn'+rowid).append(appliedbtn);
          
         var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });

      }else{
           
          $('#appliedQpbtn'+rowid).empty();
          $('#cancelQpbtn'+rowid).empty();

         var cnclbtn ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

         $('#cancelQpbtn'+rowid).append(cnclbtn);
         $('#quaP_count'+rowid).val(0);
         
        var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });

         
      }

  }

</script>


@endsection