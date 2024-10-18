@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

    .tooltip{
      color: #66CCFF !important;
    }

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

  .secondSection{

    display: none;
  }

  .rightcontent{

  text-align:right;


}
.hiddenicon{
  display: none;
}
.hidebtn{
display: none;
}

::placeholder {
  
  text-align:left;
}
  @media screen and (max-width: 600px) {

  .PageTitle{

    float: left;

  }

}

.showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
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

.credittotldesn{

    width: 277%;
    margin-left: -11%;
    text-align: end;
}

.debitcreditbox{

  width: 91px;
  text-align: end;
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
.modltitletext{
  font-weight: 800;
  color: #5696bb;
  text-align: center;
  font-size: 16px;
}
.SetInCenter{

  margin-top: 18%;

}
.AddM{

  width: 24px;

}
.showdetail{
  display: none;

}
.showcodename{
  color: #5696bb;
    font-size: 13px;
    font-weight: 600;
}
.aplynotStatus{
  display: none;
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
.boxer .hidebordritm {
  display: table-cell;
  vertical-align: top;
  border: none;
  padding: 5px;
}
.center {
  text-align:center;
}
.right {
  float:right;
}
.texIndbox{
  width:6%; 
  text-align: center;
}
.texIndbox2{
  width: 45%; 
  text-align: center;
}
 .texIndbox1{
  width: 5%; 
  text-align: center;
}
.rateIndbox{
  width: 19%;
  text-align: center;
}
.itmdetlheading{
  vertical-align: middle !important;
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

  .rowClass{
    overflow-x: scroll;
  }

}

</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Daily Production
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
          <a href="{{ url('/finance/transaction/purchase-order-transaction') }}"> Production</a>
        </li>
      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Daily Production</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('finance/transaction/production/view-production') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Daily Production</a>

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

                              <?php  $FromDate= date("d-m-Y", strtotime($fromDate));  

                                     $ToDate= date("d-m-Y", strtotime($toDate));  

                                      $CurrentDate =date("d-m-Y");
                              ?>

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control transdatepicker" name="vr" id="vr_date" value="{{ $CurrentDate }}" placeholder="Select Date" autocomplete="off">

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

                       <div class="col-md-3">

                        <div class="form-group">

                          <label>Series Code: 

                            <span class="required-field"></span>

                          </label>

                          <div class="input-group">

                            <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true" id="serisicon"></i>

                                <div class="" id="appndbtn">
                                    
                                </div>
                            </span>
                              <?php $sriescount =  count($series_list); ?>
                            <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="<?php if($sriescount == 1){echo $series_list[0]->series_code;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

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


                              <input type="text" class="form-control" name="tran" value="<?php if($sriescount == 1){echo $series_list[0]->series_name;}else{} ?>" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                      </div>


                        <!-- /.col -->
                     <div class="row">

                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Vr No: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="hidden" name="" value="{{$to_num}}" id="vr_last_num">

                            <input type="text" class="form-control" name="vro" value="<?php if($vrNumber==''){echo $last_num;}else{echo $vrNumber+1;} ?>" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

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

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true" id="planticon"></i>

                                <div class="" id="appndplantbtn">
                                    
                                </div>
                               </span>
                              <?php $plcount = count($plant_list); ?>
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->plant_code;}?>" readonly autocomplete="off">

                              <datalist id="PlantcodeList">

                                <option selected="selected" value="">-- Select --</option>

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

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Plant Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="plantname" value="<?php if($plcount == 1){echo $plant_list[0]->plant_name;}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>
                      <div class="col-md-3">
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
                              
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="<?php if($accCount == 1){echo $getacc[0]->acc_code;}else{} ?>" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly> 

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
                            <small id="accNotFound"></small>

                        </div>
                      </div>
                    </div>

                    <div class="row">

                       <div class="col-md-3">

                        <div class="form-group">

                          <label> Account Name : </label>

                            <div class="input-group tooltips">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="acctname" value="<?php if($accCount == 1){echo $getacc[0]->acc_name;}else{} ?>" id="accountName" placeholder="Enter Profit Account Name" readonly autocomplete="off">

                              <span class="tooltiptext tooltiphide" id="accountNameTooltip"></span>
                              <?php if($accCount==1){ ?>
                                  <span class="tooltiptext" id="accountNameTooltip">
                                    <?=  $getacc[0]->acc_name; ?>
                                  </span>
                              <?php } else { ?>

                                <span class="tooltiptext" id="accountNameTooltip" style="display: none;"></span>

                              <?php } ?>


                            </div>

                        </div>
                        
                      </div>
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Finishing Good Code: 

                            <span class="required-field"></span>

                          </label>

                          <div class="input-group">

                            <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true" id="serisicon"></i>

                                <div class="" id="appndbtn">
                                    
                                </div>
                            </span>
                             
                            <input list="fgList1"  id="fg_code" name="fg_code" class="form-control  pull-left" value="" placeholder="Select Finishing Good Code" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getItmByFgCode()">

                            <datalist id="fgList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach($fg_list as $key)

                                <option value='<?php echo $key->item_code?>'   data-xyz ="<?php echo $key->item_name; ?>" ><?php echo $key->item_name ; echo " [".$key->item_code."]" ; ?></option>

                              @endforeach

                            </datalist>

                          </div>

                          <small id="fg_code_errr" style="color: red;"></small>

                        </div>
                        <!-- /.form-group -->
                      </div>
                      
                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Finishing Good Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>


                              <input type="text" class="form-control" name="fg_name" value="" id="fg_name" placeholder="Enter Finishing Good Name" value="" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>
                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Qty Production : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>


                              <input type="text" class="form-control Number" name="qty_prod" value="" id="qty_prod" placeholder="Enter Quantity Production" value="" autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                    </div>
                   
                      <!-- /.col -->

                    <!-- /.row -->


                  </div> <!-- /.tab first -->
                 
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
                  <input type ="hidden" name="departCode" id="getAccCode">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="plant_name" id="getPlantName">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
                  <input type ="hidden" name="series_name" id="getSeriesName">
                  <input type ="hidden" name="fgcode" id="getFgCode">
                  <input type ="hidden" name="fgname" id="getFgName">
                  <input type ="hidden" name="tax_code" id="getTaxCode">
                  <input type="hidden" name="due_days" id="gateduedays">
                  <input type="hidden" name="getdue_date" id="gateduedate">
                  
                 
                  <input type="hidden" name="emplyeeName" id="emplyeeName">


                  <tr>

                    <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 10px;"> Sr.No.</th>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty Recd</th>

                    <th>A-Qty Recd</th>

                    <th>Qty Issued</th>

                    <th>A-Qty Issued</th>

                    <th>Action</th>

                  </tr>

                  <tr class="useful" id="firstRowtr">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">1.</span>
                    </td> 

                    <td class="tdthtablebordr">
                      <div class="input-group">
                        <input list="ItemList1" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId1' name="item_code[]"  onchange="ItemCodeGet(1);quaParaGet(1)"  oninput="this.value = this.value.toUpperCase()" />

                          <datalist id="ItemList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($help_item_list as $key)

                              <option value='<?php echo $key->item_code?>' data-xyz ="<?php echo $key->item_name; ?>" ><?php echo $key->item_name ; echo " [".$key->item_code."]" ; ?></option>

                              @endforeach

                          </datalist>
                      </div>
                       <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1" onclick="showItemDetail(1)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                    </td>

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id1' name="item_name[]" readonly />

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>

                      <textarea id="remark_data1" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description" readonly></textarea>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate"  id='qty1' name="qty[]" oninput='Getqunatity(1)'style="width: 80px" readonly />
                      <input type="hidden" id="qtyget1" class="totlqty">
                      <input type="text" name="unit_M[]" id="UnitM1" class="inputboxclr SetInCenter AddM" readonly>

                      <input type="hidden" id="Cfactor1">

                      </div>

                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty1' name="Aqty[]"  style="width: 80px" readonly />

                      <input type="text" name="add_unit_M[]" id="AddUnitM1" class="inputboxclr SetInCenter AddM" readonly>

                      </div>

                    </td>


                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate"  id='issueqty1' name="issueqty[]" oninput='Getqunatityissue(1)'style="width: 80px" readonly />
                      <input type="hidden" id="qtyget1" class="totlqty">
                      <input type="text" name="issueunit_M[]" id="issueUnitM1" class="inputboxclr SetInCenter AddM" readonly>

                      <input type="hidden" id="Cfactor1">

                      </div>

                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='issueA_qty1' name="issueAqty[]"  style="width: 80px" readonly />

                      <input type="text" name="issueadd_unit_M[]" id="issueAddUnitM1" class="inputboxclr SetInCenter AddM" readonly>

                      </div>

                    </td>
                    

                    <td>
                       
                         <div style="margin-top: 12%;">
                         <small id="taxnotfound1" class="label label-danger"></small>
                         </div>
                         <input type="hidden" id='quaP_count1' value="0" name="quaP_count[]" class="quaPcountrow">
                       <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax1" data-toggle="modal" data-target="#quality_parametr1" onclick="qty_parameter(1)" disabled="" style="padding-bottom: 0px;
    padding-top: 0px;">Quality Parametr </button>

     <div id="appliedbtn1"></div>
    <div id="cancelbtn1"></div>
    <div id="qpApplyOrNot1" class="aplynotStatus">0</div>


    <small id="qPnotfountbtn1" class="label label-danger"></small>
                       
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
                     <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="basicTotal" readonly="" style="margin-top: 3px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>   

      <br>

        <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

        <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

        <p class="text-center">

          <button class="btn btn-success" type="button" id="submitdata" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

        </p>

       
      <!-- when hsn code same then show model -->

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
           
            <center><small style="text-align: center;" id="footer_ok_btn1"></small>
            <small style="text-align: center;" id="footer_quality_btn1"></small>
            </center>
          
          </div>

        </div>

      </div>
    </div>

    <div id="quaPdomModel_2">
         
    </div>
    <!-- model -->
      <!-- when hsn code same then show model -->

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
                      <small id="itemCodeshow1"> </small>
                    </div>
                   <!--  <div class="box10 itmdetlheading">
                      <small id="itemNameshow1"> </small>
                    </div> -->
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


      <!-- show modal when click on view btn after  select series -->

        <div class="modal fade" id="series_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Series Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox">Series Code</div>
                    <div class="box10 rateIndbox">Series Name</div>
                    <div class="box10 rateIndbox">Tran Code</div>
                    <div class="box10 rateIndbox">Gl Code</div>
                    <div class="box10 rateBox">Post Code</div>

                    <div class="box10 amountBox">Rfhead1</div>
                    <div class="box10 amountBox">Rfhead2</div>
                    <div class="box10 amountBox">Rfhead3</div>
                    <div class="box10 amountBox">Rfhead4</div>
                  </div>
                  
                  <div class="box-row">
                    <div class="box10 itmdetlheading">
                      <span id="seriesCodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="seriesNameshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="trancodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="glcodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="postcodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead1show"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead2show"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead3show"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead4show"> </span>
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

      <!-- show modal when click on view btn after item select series -->


      <!-- show modal when click on view btn after  select plantcode -->

        <div class="modal fade" id="plant_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Plant Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox1">Plant Name/Plant Code</div>
                   
                    <div class="box10 rateIndbox">Pfct Code</div>
                    <div class="box10 rateIndbox">Address</div>
                    <div class="box10 rateBox">City</div>

                    <div class="box10 amountBox">Pin Code</div>
                    <div class="box10 amountBox">District</div>
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

      <!-- show modal when click on view btn after item select plantcode -->

       <!-- when tax not applied then show model -->

        <div id="taxNotAppied" class="modal fade" tabindex="-1">
          <div class="modal-dialog modal-sm" style="margin-top: 13%;">
              <div class="modal-content" style="border-radius: 5px;">
                  <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                  </div>
                  <div class="modal-body">
                    <p>The <b>Quality Paramter</b> Has Not Been Applied. In Some Of The Above Entries. </p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
                      <button type="button" class="btn btn-primary" id="savedataAfterAlert" data-dismiss="modal">Save</button>
                  </div>
              </div>
          </div>
        </div>
      <!-- when tax not applied then show model -->


    </form>

  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script>
<script src="{{ URL::asset('public/dist/js/viewjs/production.js') }}" ></script>
  
<script type="text/javascript">

  
  $(document).ready(function() {

     $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

    });

    //$('.moneyformate').mask("#,##0.00", {reverse: true});

    $( window ).on( "load", function() {
        var vr_date = $('#vr_date').val();

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
                    }else{
                      $('#profitctrId').val(data1.data[0].pfct_code);
                      $('#pfctName').val(data1.data[0].pfct_name);
                      $('#getPfctCode').val(data1.data[0].pfct_code);

                    }

                }

            }

          });

    });

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


      var rowCount = $('#tbledata tr').length;
      
      console.log('rowCount',rowCount);
      if(rowCount == 2){
         $('#submitdata').prop('disabled',true);
      }
      $('.case:checkbox:checked').parents("tr").remove();

      $('.check_all').prop("checked", false); 

      quantity =0;
       $(".quantityC").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                quantity += parseFloat(this.value);
            }

          $("#basicTotal").val(quantity.toFixed(3));

        });

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

  $(".addmore").on('click',function(){

    var vrType =  $('#vr_type').val();

      if(vrType == 'Payment'){

        var getpaymode = 'To -';

      }else if(vrType == 'Receipt'){

       var getpaymode='By -';

      }

      count=$('table tr').length;

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> </td>";

      data +="<td class='tdthtablebordr'><div class='input-group'><input list='ItemList"+i+"' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' name='item_code[]' onchange='ItemCodeGet("+i+");quaParaGet("+i+");' oninput='this.value = this.value.toUpperCase()'/><datalist id='ItemList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($help_item_list as $key)<option value='<?php echo $key->item_code?>' data-xyz ='<?php echo $key->item_name; ?>' ><?php echo $key->item_name ; echo ' ['.$key->item_code.']' ; ?></option>@endforeach</datalist></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button></td><td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly /><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></small><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description'></textarea></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount getqtytotal inputboxclr SetInCenter quantityC moneyformate'  id='qty"+i+"' name='qty[]' oninput='Getqunatity("+i+")' style='width: 80px' /><input type='hidden' id='qtyget"+i+"' class='totlqty'><input type='text' name='unit_M[]' readonly id='UnitM"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' id='Cfactor"+i+"'></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM'></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate'  id='issueqty"+i+"' name='issueqty[]' oninput='Getqunatityissue("+i+")'style='width: 80px' readonly /><input type='hidden' id='qtyget"+i+"' class='totlqty'><input type='text' name='issueunit_M[]' id='issueUnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='issueA_qty"+i+"' name='issueAqty[]'  style='width: 80px' readonly /><input type='text' name='issueadd_unit_M[]' id='issueAddUnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly></div></td><td><div style='margin-top: 12%;'><small id='taxnotfound"+i+"' class='label label-danger'></small></div><input type='hidden' id='quaP_count"+i+"' value='0' name='quaP_count[]' class='quaPcountrow'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='CalcTax"+i+"' data-toggle='modal' data-target='#quality_parametr"+i+"' onclick='qty_parameter("+i+")' style='padding-bottom: 0px;padding-top: 0px;' disabled>Quality Parametr </button><div id='appliedbtn"+i+"'></div><div id='cancelbtn"+i+"'></div><div class='aplynotStatus' id='qpApplyOrNot"+i+"'>0</div><small id='qPnotfountbtn"+i+"' class='label label-danger'></small><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox2'>Item Name</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading'><small id='itemCodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='taxcodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemDetailshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemtypeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemgroupshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemclassshow"+i+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemcategoryshow"+i+"'> </small> </div></div> </div></div> <div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div> </div></div></div> </td>";

      $('table').append(data);

      var qpdomModel = "<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' style='padding-bottom: 0px;padding-top: 0px;' id='exampleModalLabel' >Qaulity Parameter</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+i+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footer_ok_btn"+i+"'></small>&nbsp;<small style='text-align: center;' id='footer_quality_btn"+i+"'></small></center></div></div></div></div>";
      $('#quaPdomModel_2').append(qpdomModel);


      i++;

  });  /*--function close--*/

  /*<td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM'></div></td>*/

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
     // console.log('obj',obj);
    if(obj.length==0){
      $('#basicTotal').val(0.00);
      $('#submitdata').prop('disabled',true);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;

          $('#'+id).html(key+1);

      });
    }
  }


</script>

<script type="text/javascript">

  function ItemCodeGet(ItemId){
   
      var ItemCode =  $('#ItemCodeId'+ItemId).val();

      //alert(ItemCode);return false;
      
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
            $('#viewItemDetail'+ItemId).addClass('showdetail');
            $('#itemNameTooltip'+ItemId).addClass('tooltiphide'); 

            $("#CalcTax"+ItemId).prop('disabled',true);

      }else{

         document.getElementById("Item_Name_id"+ItemId).value = msg;

         
        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide'); 

         $('#itemNameTooltip'+ItemId).html(msg); 

         $('#qty'+ItemId).prop('readonly',false);  
         $('#issueqty'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false); 

        $('#vr_date,#series_code,#Plant_code,#account_code,#due_days,#party_rf_no,#party_ref_date,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5,#emp_code').prop('readonly',true); 

      }

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });
      if(ItemCode){

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

                      $('#issueUnitM'+ItemId).val(umcode);

                      $('#issueAddUnitM'+ItemId).val(aumcode);

                      $('#Cfactor'+ItemId).val(cfactor);


                    }else{

                      $('#UnitM'+ItemId).val(data1.data[0].um_code);

                      $('#AddUnitM'+ItemId).val(data1.data[0].aum);

                      $('#issueUnitM'+ItemId).val(data1.data[0].um_code);

                      $('#issueAddUnitM'+ItemId).val(data1.data[0].aum);

                      $('#Cfactor'+ItemId).val(data1.data[0].aum_factor);

                      $('#viewItemDetail'+ItemId).removeClass('showdetail');
                      


                    }

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

        });  /*ajax close*/

      }else{}

  }/*function close*/

  function quaParaGet(qpItm){

    var ItemCode =  $('#ItemCodeId'+qpItm).val();

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    if(ItemCode){
          setTimeout(function() {

            $.ajax({

              type: 'POST',

              url: "{{ url('/finance/get-quality-parameter-by-item') }}",

              data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

              success: function (data) {

                var data1 = JSON.parse(data);

               console.log('data',data1.data);

                if(data1.data==''){
                      $("#CalcTax"+qpItm).hide();
                    
                      
                      $("#qPnotfountbtn"+qpItm).html('Not Found');

                }else{
                    $("#CalcTax"+qpItm).prop('disabled',false);
                    $("#CalcTax"+qpItm).show();
                    $("#qPnotfountbtn"+qpItm).html('');
                }
             //  console.log(data1.data);
              }

            });

          }, 500);
    }else{}

  }

  function showItemDetail(viewid){

    var ItemCode =  $('#ItemCodeId'+viewid).val();

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

              console.log(data1.data_hsn);

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

  function Getqunatity_old(qtyId){

     var checkqty =$('#qty'+qtyId).val();
     if(checkqty){

         var quantity =$('#qty'+qtyId).val();
         var cfactor = $('#Cfactor'+qtyId).val();
         var total = quantity * cfactor;

          $('#A_qty'+qtyId).val(total.toFixed(2));
   
         if(quantity){
        $('#rate'+qtyId).prop('readonly',false);
        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);
      }else{
         $('#rate'+qtyId).prop('readonly',true);
         $('#A_qty'+qtyId).val(0.00);
          $("#submitdata").prop('disabled', true);
          $("#deletehidn").prop('disabled', true);
          $("#addmorhidn").prop('disabled', true);
      }

      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value.replaceAll(',', ''));

                
            }

          $("#basicTotal").val(gr_amt.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());

     }
  }

    function Getqunatity(qtyId){

      var quantity = $('#qty'+qtyId).val();
      var cfactor  = $('#Cfactor'+qtyId).val();
      var basicAmt = $('#basicTotal').val();
      var total    = quantity * cfactor;
      if(quantity){

        $('#A_qty'+qtyId).val(total.toFixed(3));
        
        console.log('basicAmt',basicAmt);
        
        $('#issueqty'+qtyId).prop('readonly',true);
        $('#issueqty'+qtyId).val('');
        $('#issueA_qty'+qtyId).prop('readonly',true);
        $('#issueA_qty'+qtyId).val('');
        $('#rate'+qtyId).prop('readonly',false);
        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);
        
            
      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value);

                
            }

          $("#basicTotal").val(gr_amt.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

      });

       if(basicAmt == 0.00 || basicAmt == 0){

       }

     }else{
        $('#issueqty'+qtyId).prop('readonly',false);
        $('#issueqty'+qtyId).val('');
        $('#issueA_qty'+qtyId).prop('readonly',false);
        $('#issueA_qty'+qtyId).val('');
        $('#A_qty'+qtyId).val('');
        $("#submitdata").prop('disabled', true);
        $("#deletehidn").prop('disabled', true);
        $("#addmorhidn").prop('disabled', true);

         $('#basicTotal').val('');
     }

     
  }

   function Getqunatityissue(qtyId){

      var quantity = $('#issueqty'+qtyId).val();
      var cfactor  = $('#Cfactor'+qtyId).val();
      var basicAmt = $('#basicTotal').val();
      var total    = quantity * cfactor;

      if(quantity){

      $('#issueA_qty'+qtyId).val(total.toFixed(3));
        
        console.log('basicAmt',basicAmt);

        $('#qty'+qtyId).prop('readonly',true);
        $('#qty'+qtyId).val('');
        $('#A_qty'+qtyId).prop('readonly',true);
        $('#A_qty'+qtyId).val('');
        
        
        $('#rate'+qtyId).prop('readonly',false);
        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);
            
      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value);

                
            }

          $("#basicTotal").val(gr_amt.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

      });

       if(basicAmt == 0.00 || basicAmt == 0){

       }

     }else{

        $('#qty'+qtyId).prop('readonly',false);
        $('#qty'+qtyId).val('');
        $('#A_qty'+qtyId).prop('readonly',false);
        $('#A_qty'+qtyId).val('');
        $('#issueA_qty'+qtyId).val('');
        $('#basicTotal').val('');
        
        
        $('#rate'+qtyId).prop('readonly',true);
        $("#submitdata").prop('disabled', true);
        $("#deletehidn").prop('disabled', true);
        $("#addmorhidn").prop('disabled', true);
     }

     
  }

 function inrFormat(val) {
  var x = val;
  x = x.toString();
  var afterPoint = '';
  if (x.indexOf('.') > 0)
    afterPoint = x.substring(x.indexOf('.'), x.length);
  x = Math.floor(x);
  x = x.toString();
  var lastThree = x.substring(x.length - 3);
  var otherNumbers = x.substring(0, x.length - 3);
  console.log(otherNumbers);
  if (otherNumbers != '')
    lastThree = ',' + lastThree;
  var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
  return res;
}
  

$(document).ready(function(){



    $("#Plant_code").change(function(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var Plant_code =  $(this).val();
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
  function qty_parameter(qty){

   var ItemCode = $("#ItemCodeId"+qty).val();


    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/finance/get-quality-parameter-by-item') }}",

            data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

            success: function (data) {


              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      if(data1.data==''){

                        }else{

                          $('#qua_par_'+qty).empty();
                          // $('#footer_qaulity_btn'+qty).empty();
                          //  $('#footer_ok_btn'+qty).empty();


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);

                        var sr_no=1;
                          $.each(data1.data, function(k, getData) {

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.item_category+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+data1.item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+getData.iqua_char+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_decs_"+qty+"_"+sr_no+"' name='iqua_desc[]' class='form-control inputtaxInd' value="+getData.iqua_desc+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+getData.char_fromvalue+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+getData.char_tovalue+" ></div></div> ";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });

                          var butn =  $('#footer_quality_btn'+qty).find(':button').html();

                          console.log('butn',butn);

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+qty+"' onclick='getvalue("+qty+",1)' style='width: 36px;'>Ok</button>";

                           $('#footer_quality_btn'+qty).append(tblData);

                             var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'   onclick='getvalue("+qty+",0)'>Cancel</button>";
                             
                           $('#footer_ok_btn'+qty).append(cancelfooter);

                         }else{
                          
                         }


                        }

                    }
           
            
            },

        });



  }
</script>

<script type="text/javascript">
  function getvalue(getvalue,staticvalue){


      if(staticvalue==1){

          
          $('#cancelbtn'+getvalue).empty();
          $('#appliedbtn'+getvalue).empty();

          var appliedbtn ='<small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';


          $('#appliedbtn'+getvalue).append(appliedbtn);
          $('#qpApplyOrNot'+getvalue).html('1');
         
          

         // $('#submitdata').prop('disabled', false);
         // $('#cancelbtn'+getvalue).html('');

         var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });


      
      }else{
           
          $('#appliedbtn'+getvalue).empty();
          $('#cancelbtn'+getvalue).empty();

         var cnclbtn ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

         $('#cancelbtn'+getvalue).append(cnclbtn);
         $('#quaP_count'+getvalue).val(0);
         $('#qpApplyOrNot'+getvalue).html('0');

        
          //$('#appliedbtn'+getvalue).html('');
          //$('#submitdata').prop('disabled', true);

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

  $('#account_code').on('change',function(){
      var deptCode = $(this).val();

      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });

      $.ajax({

            url:"{{ url('get-employe-data-by-department') }}",

            method : "POST",

            type: "JSON",

            data: {deptCode: deptCode},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  
                  if(data1.data == ''){
                    $('#empNotFound').html('Emplyee Code Not Found').css('color','red');
                    $("#emplList").empty();
                    $("#emp_code").val('');
                    $('#empName').html('');
                    $("#emp_code").prop('readonly',true);
                  }else{
                     $("#emp_code").prop('readonly',false);
                     $('#empNotFound').html('');

                    $.each(data1.data, function(k, getData){

                      $("#emplList").empty();

                      $("#emplList").append($('<option>',{

                        value:getData.emp_code,

                        'data-xyz':getData.emp_name,
                        text:getData.emp_name

                      }));

                    });

                  }
                  

                }

            }

          });


  });

</script>


<script type="text/javascript">

$(document).ready(function(){

    $("#submitdata").click(function(event) {

      var trcount=$('table tr').length;

      var valuetax= [];
      for(var y=0;y<trcount;y++){
        var trid = y+1;
       var ifnotaply = $('#qpApplyOrNot'+trid).html();

        valuetax.push(ifnotaply);
       
      }

      var found = valuetax.find(function (element) {
        return element == 0;
        });

     // console.log('found',found);
     // return false;
       
      if(found == 0){
          $("#taxNotAppied").modal('show');
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

              url: "{{ url('/finance/save-production-transaction') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                /*console.log(data);*/
               var url = "{{url('/finance/transaction/production/view-production')}}"
              setTimeout(function(){ window.location = url });
              },

          });
      }
                
    });


    $("#savedataAfterAlert").click(function(event) {

          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/finance/save-purchase-indent-transaction') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                /*console.log(data);*/
               var url = "{{url('/finance/view-purchase-indent-msg')}}"
              setTimeout(function(){ window.location = url+'/savedata'; });
              },

          });

    });

});

</script>

<script type="text/javascript">
  function getcode(sers_code){

  $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

  var sers_code = $('#series_code').val();
  //console.log(sers_code);

 // alert(sers_code);

  $.ajax({

            url:"{{ url('get-series-data-by-series-code') }}",

            method : "POST",

            type: "JSON",

            data: {sers_code: sers_code},

            success:function(data){


              var data1 = JSON.parse(data);
              console.log(data1.data[0]);


                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  
                  $("#seriesCodeshow").html(data1.data[0].series_code);
                  $("#seriesNameshow").html(data1.data[0].series_name);
                  $("#trancodeshow").html(data1.data[0].tran_code);
                  if(data1.data[0].gl_code){

                  $("#glcodeshow").html(data1.data[0].gl_code);
                  }else{
                  $("#glcodeshow").html('--');
                   }

                   if(data1.data[0].post_code){
                  $("#postcodeshow").html(data1.data[0].post_code);
                    }else{
                   $("#postcodeshow").html('--');
                    }
                    if(data1.data[0].rfhead1){

                  $("#rfhead1show").html(data1.data[0].rfhead1);
                    }else{

                      $("#rfhead1show").html('--');
                    }
                    console.log(data1.data[0].rfhead2);
                  if(data1.data[0].rfhead2){
                  $("#rfhead2show").html(data1.data[0].rfhead2);
                  }else{
                    $("#rfhead2show").html('--');
                    }

                  if(data1.data[0].rfhead3){
                  $("#rfhead3show").html(data1.data[0].rfhead3);
                }else{
                  $("#rfhead3show").html('--');
                }
                if(data1.data[0].rfhead4){
                  $("#rfhead4show").html(data1.data[0].rfhead4);
                }else{
                  $("#rfhead4show").html('--');
                }
                

                }

            }

          });
}
</script>
<script type="text/javascript">
  function getplantdata(){

  $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

  var plntCode = $('#Plant_code').val();
  //console.log(sers_code);

 // alert(sers_code);

  $.ajax({

            url:"{{ url('get-plant-data-by-plant-code') }}",

            method : "POST",

            type: "JSON",

            data: {plntCode: plntCode},

            success:function(data){


              var data1 = JSON.parse(data);
              console.log(data1.data[0]);


                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  
                  $("#plantCodeshow").html(data1.data[0].plant_name+'/'+data1.data[0].plant_code);
                  $("#plantpfctcodeshow").html(data1.data[0].pfct_code);
                  if(data1.data[0].address1){

                  $("#plantaddshow").html(data1.data[0].address1);
                  }else{
                  $("#plantaddshow").html('--');
                   }

                   if(data1.data[0].city){
                  $("#plantcityshow").html(data1.data[0].city);
                    }else{
                   $("#plantcityshow").html('--');
                    }
                    if(data1.data[0].pin){

                  $("#plantpinshow").html(data1.data[0].pin);
                    }else{

                      $("#plantpinshow").html('--');
                    }
                    console.log(data1.data[0].district);
                  if(data1.data[0].district){
                  $("#plantdistshow").html(data1.data[0].district);
                  }else{
                    $("#plantdistshow").html('--');
                    }

                  if(data1.data[0].state){
                  $("#plantstateshow").html(data1.data[0].state);
                }else{
                  $("#plantstateshow").html('--');
                }
                if(data1.data[0].email){
                  $("#plantemailshow").html(data1.data[0].email);
                }else{
                  $("#plantemailshow").html('--');
                }

                if(data1.data[0].phone1){
                  $("#plantphoneshow").html(data1.data[0].phone1);
                }else{
                  $("#plantphoneshow").html('--');
                }
                

                }

            }

          });
}
</script>

<script type="text/javascript">

 function getItmByFgCode(){

        var fgGood = $("#fg_code").val();

        alert(fgGood);

        $.ajaxSetup({

                headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

        });

        $.ajax({

                type: 'POST',

                url: "{{ url('/get-item-from-bom-by-fg-code') }}",

                data: {fgGood:fgGood}, 

                beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
                  },

                success: function (data) {

                  console.log(data);

                  var data1 = JSON.parse(data);

                      if(data1.data==''){
                       
                      }else{  

                          $('#addmorhidn,#CalcTax,#quality_parametr').prop('disabled',false);
                          
                        $('#getItmexistCount').val(data1.data.length);
                        var basicAmt = 0;
                        for(var x=0;x<data1.data.length;x++){

                            var trrow=x+1;

                            $('#qty'+trrow).prop('readonly',false);
                            $('#CalcTax'+trrow).prop('disabled',false);
                            $('#qua_paramter'+trrow).prop('disabled',false);
                            $('#viewItemDetail'+trrow).removeClass('showdetail');
                            $('#itemNameTooltip'+trrow).removeClass('tooltiphide');

                             basicAmt += parseFloat(data1.data[x].basic_amt);

                            $('#basicTotal').val(basicAmt.toFixed(2));

                            if(data1.data[x].remark){

                                var remark = data1.data[x].remark;
                              }else{
                                var remark ='';
                              }

                            if(data1.data[x].qty_recvd){

                              var qty_recvd = data1.data[x].qty_recvd;
                            }else{

                              var qty_recvd ='';
                            }

                            if(data1.data[x].aq_recvd){

                              var aq_recvd =data1.data[x].aq_recvd;
                            }else{
                              var aq_recvd ='';
                            }

                            if(data1.data[x].qty_issue){

                              var qty_issue = data1.data[x].qty_issue;
                            }else{

                              var qty_issue ='';
                            }

                            if(data1.data[x].aq_issue){

                              var aq_issue = data1.data[x].aq_issue;
                            }else{

                              var aq_issue = '';
                            }

                            if(x == 0){


                                $('#itemNameTooltip'+trrow).html(data1.data[x].item_name);
                                $('#ItemCodeId'+trrow).val(data1.data[x].item_code);
                                $('#Item_Name_id'+trrow).val(data1.data[x].item_name);
                                $('#remark_data'+trrow).val(data1.data[x].remark);
                                $('#qty'+trrow).val(qty_recvd);
                                $('#existQty'+trrow).val(data1.data[x].qty_recvd);
                                $('#UnitM'+trrow).val(data1.data[x].um);
                                $('#Cfactor'+trrow).val(data1.data[x].aum_factor);
                                $('#A_qty'+trrow).val(aq_recvd);
                                $('#existaddQty'+trrow).val(data1.data[x].aq_recvd);
                                $('#AddUnitM'+trrow).val(data1.data[x].aum);
                                $('#issueqty'+trrow).val(qty_issue);
                                $('#issueexistQty'+trrow).val(data1.data[x].qty_issue);
                                $('#issueUnitM'+trrow).val(data1.data[x].um_issue);
                                $('#issueA_qty'+trrow).val(aq_issue);
                                $('#issueAddUnitM'+trrow).val(data1.data[x].aum_issue);
                                $('#basic'+trrow).val(data1.data[x].basic_amt);
                                /*$('#hsn_code'+trrow).val(data1.data[x].hsn_code);
                                $('#showHsnCd'+trrow).html('HSN No : '+data1.data[x].hsn_code);
                                $('#taxByItem'+trrow).val(data1.data[x].tax_code);*/

                            }else if(x >0){

                              

                                var rowData = "<tr>";
                                 rowData +="<td class='tdthtablebordr'><input type='checkbox' class='case'  /></td>";
                                 rowData +="<td class='tdthtablebordr'><span id='snum' style='width: 10px;'>"+trrow+".</span></td>";
                                 rowData +="<td class='tdthtablebordr'><div class='input-group'><input type='text' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+trrow+"' value="+data1.data[x].item_code+" name='item_code[]' oninput='this.value = this.value.toUpperCase()' readonly /></div><button type='button' class='btn btn-primary btn-xs viewbtnitem' id='viewItemDetail"+trrow+"' data-toggle='modal' data-target='#view_detail"+trrow+"' onclick='showItemDetail("+trrow+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><input type='hidden' id='saleQuoHeadId"+trrow+"' value="+data1.data[x].production_head_id+" name='saleQuoHead[]'><input type='hidden' id='saleQuoBodyId"+trrow+"' value="+data1.data[x].id+" name='saleQuoBody[]'><input type='hidden' id='hsn_code"+trrow+"' value="+data1.data[x].hsn_code+" name='hsn_code[]'><input type='hidden' id='taxByItem"+trrow+"' value="+data1.data[x].tax_code+" name='tax_byitem[]'><div class='modal fade' id='view_detail"+trrow+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div> <div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item name</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div> <div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div> <div class='box-row'><div class='box10 itmdetlheading1'><small id='itemCodeshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'> <small id='taxcodeshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='itemDetailshow"+trrow+"'> </small> </div><div class='box10 itmdetlheading'> <small id='itemtypeshow"+trrow+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemgroupshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='itemclassshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='itemcategoryshow"+trrow+"'> </small></div></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div></td>";
                                 rowData +="<td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+trrow+"' name='item_name[]' value='"+data1.data[x].item_name+"' readonly><small class='tooltiptextitem' id='itemNameTooltip"+trrow+"'>"+data1.data[x].item_name+"</small><textarea id='remark_data"+trrow+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description' readonly>"+remark+"</textarea></td>";
                                 rowData +="<td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='qty"+trrow+"' name='qty[]'style='width: 80px' oninput='Getqunatity("+trrow+")' value="+qty_recvd+"><input type='text' name='unit_M[]' id='UnitM"+trrow+"' class='inputboxclr SetInCenter AddM' readonly value="+data1.data[x].um+"><input type='hidden' id='Cfactor"+trrow+"' value="+data1.data[x].aum_factor+"><input type='hidden' id='existQty"+trrow+"' name='existQty[]' value="+data1.data[x].qty_recvd+"></div></td>";
                                 rowData +="<td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+trrow+"' name='Aqty[]'  style='width: 80px' value='"+aq_recvd+"' readonly  /><input type='text' name='add_unit_M[]' id='AddUnitM"+trrow+"' value="+data1.data[x].aum+" class='inputboxclr SetInCenter AddM' readonly><input type='hidden' id='existaddQty"+trrow+"' name='existaddQty[]' value="+data1.data[x].Aquantity+"></div></td>";
                                 rowData +="<td class='tdthtablebordr'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='issueA_qty"+trrow+"' name='issueAqty[]'  style='width: 80px' value='"+qty_issue+"' readonly /><input type='text' name='issueadd_unit_M[]' id='issueAddUnitM"+trrow+"' class='inputboxclr SetInCenter AddM'  value="+data1.data[x].um_issue+"  readonly></td>";
                                 rowData +="<td class='tdthtablebordr'> <input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='issueA_qty"+trrow+"' name='issueAqty[]' value='"+aq_issue+"' style='width: 80px' readonly /><input type='text' name='issueadd_unit_M[]' value="+data1.data[x].aum_issue+" id='issueAddUnitM"+trrow+"' class='inputboxclr SetInCenter AddM' readonly></td>";
                                
                                 rowData +="<td><div style='margin-top: 12%;'><small id='qpnotfound"+trrow+"' class='label label-danger'></small></div><input type='hidden' id='quaP_count"+trrow+"' value='0' name='quaP_count[]' class='quaPcountrow' style='z-index: 0;'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='qua_paramter"+trrow+"' data-toggle='modal' data-target='#quality_parametr"+trrow+"' onclick='qty_parameter("+trrow+")' style='padding-bottom: 0px;padding-top: 0px;'>Quality Parametr </button><div id='cancelQpbtn"+trrow+"'></div><div id='appliedQpbtn"+trrow+"'></div> <div id='qpApplyOrNot"+trrow+"' class='aplynotStatus'>0</div><small id='qPnotfountbtn"+trrow+"' class='label label-danger'></small><div class='modal fade' id='quality_parametr"+trrow+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Qaulity Parameter</h5> </div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+trrow+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footerqp_ok_btn"+trrow+"'></small> <small style='text-align: center;' id='footerqp_quality_btn"+trrow+"'></small></center> </div></div> </div></div></td>";
                                 rowData +="</tr>";

                                $('#tbledata #firstRowtr').after(rowData);
                            
                            }
                        } /* /. for loop */
                      } /* /. else */
                }, /* /. success */

                complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
                  },
        }); /* /. ajax */

    }
</script>

<!-- <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script> -->

@endsection