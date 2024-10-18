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
.hidetr{
  display: none;
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
       Wo Production
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

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Wo Production</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Transaction/Production/view-wo-production') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Wo Production</a>

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
                <!-- <li id="secondTab">
                  <a href="#tab2info" data-toggle="tab" >Other Details</a>
                </li> -->
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

                              <input type="text" class="form-control transdatepicker" name="vr" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

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
                            <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();">

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


                              <input type="text" class="form-control" name="tran" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

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

                            <input type="text" class="form-control" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

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
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                
                               </span>
                              <?php $plcount = count($plant_list); ?>
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>" readonly autocomplete="off">

                              <datalist id="PlantcodeList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($plant_list as $key)

                                <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME; echo " [".$key->PLANT_CODE."]" ; ?></option>

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

                              <input type="text" class="form-control" name="plantname" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME;}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                      <div class="col-md-3">
                       <div class="form-group">

                          <label>Acc Code : </label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 4px 12px;">

                                <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>

                                <div class="" id="appndaccbtn"> 
                                </div>

                                 <?php $accCount = count($getacc); ?>
                                 <input type="hidden" id="getaccCount" value="{{$accCount}}">
                                 <?php if($accCount == 1) { ?>

                                  <button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getplantdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;" id="appndplantbtn1"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>

                                 <?php } else{ ?>
                                  <i class="fa fa-newspaper-o" aria-hidden="true" id="showicon"></i>
                                 <?php } ?>

                              </span>
                                <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="<?php if($accCount == 1){echo $getacc[0]->ACC_CODE;}else{} ?>" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off"  readonly> 
                            <!--   <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="< ?php if($accCount == 1){echo $getacc[0]->ACC_CODE;}else{} ?>" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" onchange="getItmByFgCode()" readonly>  -->

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

                              <input type="text" class="form-control" name="acctname" value="<?php if($accCount == 1){echo $getacc[0]->ACC_NAME;}else{} ?>" id="accountName" placeholder="Enter Profit Account Name" readonly autocomplete="off">

                              <span class="tooltiptext tooltiphide" id="accountNameTooltip"></span>
                              <?php if($accCount==1){ ?>
                                  <span class="tooltiptext" id="accountNameTooltip">
                                    <?=  $getacc[0]->ACC_NAME; ?>
                                  </span>
                              <?php } else { ?>

                                <span class="tooltiptext" id="accountNameTooltip" style="display: none;"></span>

                              <?php } ?>


                            </div>

                        </div>
                        
                      </div>



                       <div class="col-md-3">

                        <div class="form-group">

                          <label> Cost Center Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="costList" class="form-control" name="cost_center_code" id="cost_center_code" placeholder="Enter Cost Center Code">

                              <datalist id="costList">
                                <?php foreach ($cost_list as $key) { ?>
                                  
                                <option value="<?= $key->COST_CODE ?>" data-xyz="<?= $key->COST_NAME ?>"><?= $key->COST_CODE ?> <?= $key->COST_NAME ?></option>

                                <input type="hidden"  id="costname" value="<?= $key->COST_NAME ?>">
                                
                                <?php } ?>

                              </datalist>

                            </div>
                            <small id="cost_center_err" style="color: red;"></small>
                            <small id="empName" class="showcodename"></small>

                        </div>
                        
                      </div>


                       <div class="row">

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Cost Center Name : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="cost_center_name" value="" id="cost_center_name" placeholder="Enter Cost Center Name" autocomplete="off" disabled="">

                            

                            </div>

                           

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

                  <input type="hidden" id="getItmexistCount">
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
                <input type="hidden" name="bom_type" value="WOBOM">

                <input type="hidden" name="cost_code" id="cost_code">
                <input type="hidden" name="cost_name" id="cost_name">


                  <tr>

                    <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 10px;"> Sr.No.</th>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty Recd</th>

                    <th>A-Qty Recd</th>

                    <th>Qty Issued</th>

                    <th>A-Qty Issued</th>

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
                       
                        <div id="fgCodelable" style="margin-bottom: -9%;"></div>
                        <input list="ItemList1" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId1' name="item_code[]"  onchange="ItemCodeGet(1);quaParaGet(1)"  oninput="this.value = this.value.toUpperCase()" />

                          <datalist id="ItemList1">


                              @foreach ($help_item_list as $key)

                              <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME; echo " [".$key->ITEM_CODE."]"; ?></option>

                              @endforeach

                          </datalist>
                      </div>
                       <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1" onclick="showItemDetail(1)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                    </td>

                    <td class="tdthtablebordr tooltips">



                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id1' name="item_name[]" readonly /></br>

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>

                      <textarea id="remark_data1" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description" readonly></textarea>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate txtMult"  id='qty1' name="qty[]" oninput='Getqunatity(1)'style="width: 80px" readonly />
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
                    

                   

                  </tr>


                 <!--  <tr class="useful" id="firstRowtr">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">2.</span>
                    </td> 

                    <td class="tdthtablebordr">
                      <div class="input-group">
                       
                        <div id="fgCodelable" style="margin-bottom: -9%;"></div>
                        <input list="ItemList2" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId2' name="item_code[]"  onchange="ItemCodeGet(2);quaParaGet(2)"  oninput="this.value = this.value.toUpperCase()" />

                          <datalist id="ItemList2">

                             
                              @foreach ($help_item_list as $key)

                              <option value='<  ?php echo $key->ITEM_CODE?>' data-xyz ="< ?php echo $key->ITEM_NAME; ?>" >< ?php echo $key->ITEM_NAME; echo " [".$key->ITEM_CODE."]"; ?></option>

                              @endforeach

                          </datalist>
                      </div>
                       <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail2" data-toggle="modal" data-target="#view_detail2" onclick="showItemDetail(2)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                    </td>

                    <td class="tdthtablebordr tooltips">



                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id2' name="item_name[]" readonly />

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip2"></small>

                      <textarea id="remark_data2" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description" readonly></textarea>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate txtMult"  id='qty2' name="qty[]" oninput='Getqunatity(2)'style="width: 80px" readonly />
                      <input type="hidden" id="qtyget2" class="totlqty">
                      <input type="text" name="unit_M[]" id="UnitM2" class="inputboxclr SetInCenter AddM" readonly>

                      <input type="hidden" id="Cfactor2">

                      </div>

                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty2' name="Aqty[]"  style="width: 80px" readonly />

                      <input type="text" name="add_unit_M[]" id="AddUnitM2" class="inputboxclr SetInCenter AddM" readonly>

                      </div>

                    </td>


                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate"  id='issueqty2' name="issueqty[]" oninput='Getqunatityissue(2)'style="width: 80px" readonly />
                      <input type="hidden" id="qtyget2" class="totlqty">
                      <input type="text" name="issueunit_M[]" id="issueUnitM2" class="inputboxclr SetInCenter AddM" readonly>

                      <input type="hidden" id="Cfactor2">

                      </div>

                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='issueA_qty2' name="issueAqty[]"  style="width: 80px" readonly />

                      <input type="text" name="issueadd_unit_M[]" id="issueAddUnitM2" class="inputboxclr SetInCenter AddM" readonly>

                      </div>

                    </td>
                    

                   

                  </tr>
 -->


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

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

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


    <div class="modal fade" id="quality_parametr2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

                <div class="boxer" id="qua_par_2">
                
                  
                </div>

            </div>

          <div class="modal-footer">
           
            <center><small style="text-align: center;" id="footer_ok_btn2"></small>
            <small style="text-align: center;" id="footer_quality_btn2"></small>
            </center>
          
          </div>

        </div>

      </div>
    </diV>

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
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Account Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox1">Account Name</div>
                   
                    <div class="box10 rateIndbox">Acc Type</div>
                    <div class="box10 rateIndbox">Address</div>
                    <div class="box10 rateBox">Address</div>

                    <div class="box10 amountBox">Address</div>
                    <div class="box10 amountBox">City</div>
                    <div class="box10 amountBox">State</div>
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
<script src="{{ URL::asset('public/dist/js/viewjs/wo_production.js') }}" ></script>
  
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
                      $('#profitctrId').val(data1.data[0].PFCT_CODE);
                      $('#pfctName').val(data1.data[0].PFCT_NAME);
                      $('#getPfctCode').val(data1.data[0].PFCT_CODE);

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

      getvrnoBySeries();

     var vrseqno = $('#vrseqnum').val();

     var vrlastnum = $('#vr_last_num').val();

     var plant_code = $('#Plant_code').val();
     var plantname = $('#plantname').val();

     if(plant_code){

      $("#getPlantCode").val(plant_code);
     }

     if(plantname){

      $("#getPlantName").val(plantname);
     }

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
  
$('#cost_center_code').on('change',function(){


  var costCode = $(this).val();

  

});

</script>

 <script type="text/javascript">
  
$('#cost_center_code').on('change',function(){


  var costCode = $(this).val();


   if(costCode==''){
  
     $('#cost_center_code').css('border-color','#d2d6de');
     $('#bom_no').css('border-color','#d2d6de');
     $('#cost_center_code').css('border-color','#ff0000').focus();
     $("#cost_center_err").html('The Cost center code field is required.');
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#cost_center_code').css('border-color','#d2d6de');
      $('#bom_no').css('border-color','#ff0000').focus();
      $("#cost_center_err").html('')
     // $('#asset_code').css('border-color','#ff0000').focus();
     }

   var costName = $("#costname").val();

 // alert(costName);



  $("#cost_center_code").val(costCode);

  var xyz = $('#costList option').filter(function() {

    return this.value == costCode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
     $('#costName').val('');
     $("#cost_center_name").val('');
      $("#cost_code").val('');
    $("#cost_name").val('');
    $('#costName').val('');
    $("#cost_center_code").val('');
     //document.getElementById("cost_err").innerHTML = 'The Cost code field is required.';
     
  }else{
    
    $("#cost_code").val(costCode);
    $("#cost_name").val(msg);
    $('#costName').val(msg);
    $("#cost_center_code").val(costCode);
    $("#cost_center_name").val(msg);
     //document.getElementById("cost_err").innerHTML = '';
   
    
  }



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

 

    var ii=2;
    var adrow=1;

  $(".addmore").on('click',function(){

     var itmexist= $('#getItmexistCount').val();
    
      if(itmexist){
        var getIc = itmexist - 1;
        var i = getIc+ii;

       // $('#getItmexistCount').val(i);
       //count=$('table tr').length;
      }else{
         var i = ii;
         //$('#getItmexistCount').val(ii);

      /*   $("#firstRowtr").addClass('hidetr');
         counttr=$('table tr').length;*/

        //count = counttr - 1;

      }
      
      //alert(i);
/*
      var tabletr = $("#trtablecount").val();
      if(tabletr){
        var i = tabletr+1;
      }*/
      
      

      count=$('table tr').length;
      //alert(count);
      console.log('count',count);
      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> </td>";

      data +="<td class='tdthtablebordr'><div class='input-group'><input list='ItemList"+i+"' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' name='item_code[]' onchange='ItemCodeGet("+i+");quaParaGet("+i+");' oninput='this.value = this.value.toUpperCase()'/><datalist id='ItemList"+i+"'>@foreach ($help_item_list as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option>@endforeach</datalist></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button></td><td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly /></br><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></small><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description'></textarea></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount getqtytotal inputboxclr SetInCenter quantityC moneyformate txtMult'  id='qty"+i+"' name='qty[]' oninput='Getqunatity("+i+")' style='width: 80px' /><input type='hidden' id='qtyget"+i+"' class='totlqty'><input type='text' name='unit_M[]' readonly id='UnitM"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' id='Cfactor"+i+"'></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM'></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate'  id='issueqty"+i+"' name='issueqty[]' oninput='Getqunatityissue("+i+")'style='width: 80px' readonly /><input type='hidden' id='qtyget"+i+"' class='totlqty'><input type='text' name='issueunit_M[]' id='issueUnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='issueA_qty"+i+"' name='issueAqty[]'  style='width: 80px' readonly /><input type='text' name='issueadd_unit_M[]' id='issueAddUnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly></div></td>";

      $('table').append(data);

      var qpdomModel = "<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' style='padding-bottom: 0px;padding-top: 0px;' id='exampleModalLabel' >Qaulity Parameter</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+i+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footer_ok_btn"+i+"'></small>&nbsp;<small style='text-align: center;' id='footer_quality_btn"+i+"'></small></center></div></div></div></div>";
      $('#quaPdomModel_2').append(qpdomModel);


      ii++;

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
          $('#viewItemDetail'+ItemId).removeClass('showdetail');

        $('#vr_date,#series_code,#Plant_code,#account_code,#due_days,#party_rf_no,#party_ref_date,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5,#emp_code,#cost_center_code').prop('readonly',true); 

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
                       $('#viewItemDetail'+ItemId).addClass('showdetail');

                    }else{

                      $('#UnitM'+ItemId).val(data1.data[0].UM_CODE);

                      $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                      $('#issueUnitM'+ItemId).val(data1.data[0].UM_CODE);

                      $('#issueAddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                      $('#Cfactor'+ItemId).val(data1.data[0].AUM_FACTOR);

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
                  $("#itemCodeshow"+viewid).html(data1.data_hsn.ITEM_NAME+'<p>('+data1.data_hsn.ITEM_CODE+')</p>');
                  $("#hsncodeshow"+viewid).html(data1.data_hsn.HSN_CODE);
                  $("#taxcodeshow"+viewid).html(data1.data_hsn.TAX_CODE);
                  $("#itemDetailshow"+viewid).html(data1.data_hsn.ITEM_DETAIL);
                  $("#itemtypeshow"+viewid).html(data1.data_hsn.ITEMTYPE_CODE);
                  $("#itemgroupshow"+viewid).html(data1.data_hsn.ITEMGROUP_CODE);
                  $("#itemclassshow"+viewid).html(data1.data_hsn.ITEMCLASS_CODE);
                  $("#itemcategoryshow"+viewid).html(data1.data_hsn.ICATG_CODE);
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

         gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value);

                
            }

          $("#basicTotal").val(gr_amt.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

      });

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

                          //console.log('butn',butn);

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
       
     


          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/finance/save-wo-production-transaction') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                /*console.log(data);*/
                 var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                   var responseVar = false;
                   var url = "{{url('/finance/view-wo-production-msg')}}";

                }else{

                   var responseVar = true;
                  var url = "{{url('/finance/view-wo-production-msg')}}";

                }

               
              setTimeout(function(){ window.location = url+'/'+responseVar });
              },

          });
      
                
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
                  
                  $("#seriesCodeshow").html(data1.data[0].SERIES_CODE);
                  $("#seriesNameshow").html(data1.data[0].SERIES_NAME);
                  $("#trancodeshow").html(data1.data[0].TRAN_CODE);
                  if(data1.data[0].GL_CODE){

                  $("#glcodeshow").html(data1.data[0].GL_CODE);
                  }else{
                  $("#glcodeshow").html('--');
                   }

                   if(data1.data[0].GL_CODE){
                  $("#postcodeshow").html(data1.data[0].GL_CODE);
                    }else{
                   $("#postcodeshow").html('--');
                    }
                    if(data1.data[0].RFHEAD1){

                  $("#rfhead1show").html(data1.data[0].RFHEAD1);
                    }else{

                      $("#rfhead1show").html('--');
                    }
                    
                  if(data1.data[0].RFHEAD2){
                  $("#rfhead2show").html(data1.data[0].RFHEAD2);
                  }else{
                    $("#rfhead2show").html('--');
                    }

                  if(data1.data[0].RFHEAD3){
                  $("#rfhead3show").html(data1.data[0].RFHEAD3);
                }else{
                  $("#rfhead3show").html('--');
                }
                if(data1.data[0].RFHEAD4){
                  $("#rfhead4show").html(data1.data[0].RFHEAD4);
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
                  
                  $("#plantCodeshow").html(data1.data[0].ACC_NAME+'<p>('+data1.data[0].ACC_CODE+'</p>');
                  $("#plantpfctcodeshow").html(data1.data[0].ATYPE_CODE);
                  if(data1.data[0].ADD1){

                  $("#plantaddshow").html(data1.data[0].ADD1);
                  }else{
                  $("#plantaddshow").html('Null');
                   }

                   if(data1.data[0].ADD2){
                  $("#plantcityshow").html(data1.data[0].ADD2);
                    }else{
                   $("#plantcityshow").html('Null');
                    }
                    if(data1.data[0].ADD3){

                  $("#plantpinshow").html(data1.data[0].ADD3);
                    }else{

                      $("#plantpinshow").html('Null');
                    }
                   // console.log(data1.data[0].city);
                  if(data1.data[0].CITY_CODE){
                  $("#plantdistshow").html(data1.data[0].CITY_CODE);
                  }else{
                    $("#plantdistshow").html('Null');
                    }

                  if(data1.data[0].STATE_CODE){
                  $("#plantstateshow").html(data1.data[0].STATE_CODE);
                }else{
                  $("#plantstateshow").html('Null');
                }
                if(data1.data[0].EMAIL_ID){
                  $("#plantemailshow").html(data1.data[0].EMAIL_ID);
                }else{
                  $("#plantemailshow").html('Null');
                }

                if(data1.data[0].CONTACT_NO){
                  $("#plantphoneshow").html(data1.data[0].CONTACT_NO);
                }else{
                  $("#plantphoneshow").html('Null');
                }
                

                }

            }

          });
}
</script>


<script type="text/javascript">
  

  function getFgByBomNo(itemno){

      var bom_num =  $('#bom_no').val();
      //var scrab_code =  $('#scrab_code').val();

     // var accnum =  $('#account_code').val();
    

      var bom_no = bom_num.split(' ');
      var bomno = bom_no[2];

      $("#rqnumbyissue").val(bomno);
    // alert(orderno);
      
      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:"{{ url('/get-item-from-bom-by-bomno') }}",

          method : "POST",

          type: "JSON",

          data: {bomno: bomno},

           success:function(data){

              console.log(data);
              var data1 = JSON.parse(data);


              if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){
                 
                  if(data1.data==''){

                  }else{

                    $("#fgList1").empty();

                    $.each(data1.data, function(k, getData){



                      $("#fgList1").append($('<option>',{

                        value:getData.FG_CODE,

                        'data-xyz':getData.FG_NAME,
                        text:getData.FG_NAME


                      }));

                    });
                     
                  }

       
                }/*if close*/

           }  /*success function close*/

      });  /*ajax close*/
    

  }
</script>

<script type="text/javascript">
  function multiplyqty22(qty){

   var prd_qty = $("#qty_prod").val();
   var recv_qty = $("#qty").val();



  }
</script>

<script type="text/javascript">
   function multiplyqty() {

     var prd_qty = $("#qty_prod").val();
               var mult = 0;
               $(".txtMult").each(function (i) {

                var srno=i + 1;

                   var $val1 = $('#qty'+srno).val();
                   //var $val2 = $('#val2').val();
                   var $total = ($val1 * prd_qty);

                   console.log($total);
                 //  $('#multTotal').text($total);

                   srno++;
               });
           }
</script>

<!-- <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script> -->

<script type="text/javascript">

 function getItmByFgCode(){

        var account_code = $("#account_code").val();

         $('#vr_date,#series_code,#Plant_code,#account_code,#bom_no').prop('disabled',true);

        $.ajaxSetup({

                headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

        });

        $.ajax({

                type: 'POST',

                url: "{{ url('/get-item-from-dp-by-acc-code') }}",

                data: {account_code:account_code}, 

                beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
                  },

                success: function (data) {

                 // console.log(data);

                  var data1 = JSON.parse(data);

                  //console.log('datalength',data1.fgdata.length);

                   //   $("#firstRowtr").removeClass('hidetr');
                
                      if(data1.data==''){
                       $("#fg_code").prop('readonly',true);
                      
                      
                      }else{  
                          $("#fg_code").prop('readonly',true);
                          $("#submitdata").prop('disabled',false);

                          $('#addmorhidn,#CalcTax,#quality_parametr').prop('disabled',false);

                          
                          var fgcount =1;
                          var datacount =data1.data.length;

                          var exitcount = parseInt(datacount) + parseInt(fgcount)
                        
                        $('#getItmexistCount').val(exitcount);


                        var recvvalue = 0;
                        var issuevalue = 0;
                        var srnum=1;

                        

                         

                          console.log('count',data1.data.length);

                                $('#itemNameTooltip'+srnum).html(data1.fgdata.ITEM_NAME);
                                $('#ItemCodeId'+srnum).val(data1.fgdata.ITEM_CODE);
                                $('#Item_Name_id'+srnum).val(data1.fgdata.ITEM_NAME);
                                $('#qty'+srnum).val(data1.fgdata.QTYRECD);
                                $('#existQty'+srnum).val(data1.fgdata.QTYRECD);
                                $('#UnitM'+srnum).val(data1.data[0].UM);
                              
                        
                        
                        for(var x=0;x<data1.data.length;x++){

                        

                            var trrow=x+1;

                            $('#qty'+trrow).prop('readonly',false);
                            $('#CalcTax'+trrow).prop('disabled',false);
                            $('#qua_paramter'+trrow).prop('disabled',false);
                            $('#viewItemDetail'+trrow).removeClass('showdetail');
                            $('#itemNameTooltip'+trrow).removeClass('tooltiphide');

                            recvvalue += data1.data[x].QTYRECD;
                            issuevalue += data1.data[x].QTYISSUE;

                            var basicAmt =parseFloat(recvvalue) + parseFloat(issuevalue);

                             //alert(basicAmt);

                            $('#basicTotal').val(basicAmt.toFixed(3));

                            if(data1.data[x].REMARK){

                                var remark = data1.data[x].REMARK;
                              }else{
                                var remark ='';
                              }

                            if(data1.data[x].QTYRECD){

                              var qty_recvd = data1.data[x].QTYRECD;
                            }else{

                              var qty_recvd ='';
                            }

                            if(data1.data[x].AQTYRECD){

                              var aq_recvd =data1.data[x].AQTYRECD;
                            }else{
                              var aq_recvd ='';
                            }

                            if(data1.data[x].QTYISSUE){

                              var qty_issue = data1.data[x].QTYISSUE;
                            }else{

                              var qty_issue ='';
                            }

                            if(data1.data[x].AQTYISSUED){

                              var aq_issue = data1.data[x].AQTYISSUED;
                            }else{

                              var aq_issue = '';
                            }

                            if(x == 0){


                                $('#itemNameTooltip'+trrow).html(data1.data[x].ITEM_NAME);
                                $('#ItemCodeId'+trrow).val(data1.data[x].ITEM_CODE);
                                $('#Item_Name_id'+trrow).val(data1.data[x].ITEM_NAME);
                                $('#remark_data'+trrow).val(data1.data[x].REMARK);
                                $('#qty'+trrow).val(qty_recvd);
                                $('#existQty'+trrow).val(data1.data[x].QTYRECD);
                                $('#UnitM'+trrow).val(data1.data[x].UM);
                                $('#Cfactor'+trrow).val(data1.data[x].AUM_FACTOR);
                                $('#A_qty'+trrow).val(aq_recvd);
                                $('#existaddQty'+trrow).val(data1.data[x].AQTYRECD);
                                $('#AddUnitM'+trrow).val(data1.data[x].AUM);
                                $('#issueqty'+trrow).val(qty_issue);
                                $('#issueexistQty'+trrow).val(data1.data[x].QTYISSUE);
                                $('#issueUnitM'+trrow).val(data1.data[x].UM);
                                $('#issueA_qty'+trrow).val(aq_issue);
                                $('#issueAddUnitM'+trrow).val(data1.data[x].AUM);
                                $('#basic'+trrow).val(basicAmt);
                                /*$('#hsn_code'+trrow).val(data1.data[x].hsn_code);
                                $('#showHsnCd'+trrow).html('HSN No : '+data1.data[x].hsn_code);
                                $('#taxByItem'+trrow).val(data1.data[x].tax_code);*/

                            }else if(x >0){


                                var rowData = "<tr>";
                                 rowData +="<td class='tdthtablebordr'><input type='checkbox' class='case'  /></td>";
                                 rowData +="<td class='tdthtablebordr'><span id='snum' style='width: 10px;'>"+trrow+".</span></td>";
                                 rowData +="<td class='tdthtablebordr'><div class='input-group'><input type='text' class='inputboxclr SetInCenter' onchange='ItemCodeGet("+trrow+");quaParaGet("+trrow+")' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+trrow+"' value="+data1.data[x].ITEM_CODE+" name='item_code[]' oninput='this.value = this.value.toUpperCase()' readonly /></div><button type='button' class='btn btn-primary btn-xs viewbtnitem' id='viewItemDetail"+trrow+"' data-toggle='modal' data-target='#view_detail"+trrow+"' onclick='showItemDetail("+trrow+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><input type='hidden' id='saleQuoHeadId"+trrow+"' value="+data1.data[x].PRODHID+" name='saleQuoHead[]'><input type='hidden' id='saleQuoBodyId"+trrow+"' value="+data1.data[x].PRODBID+" name='saleQuoBody[]'><input type='hidden' id='hsn_code"+trrow+"' value="+data1.data[x].HSN_CODE+" name='hsn_code[]'><input type='hidden' id='taxByItem"+trrow+"' value="+data1.data[x].TAX_CODE+" name='tax_byitem[]'><div class='modal fade' id='view_detail"+trrow+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div> <div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item name</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div> <div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div> <div class='box-row'><div class='box10 itmdetlheading1'><small id='itemCodeshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'> <small id='taxcodeshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='itemDetailshow"+trrow+"'> </small> </div><div class='box10 itmdetlheading'> <small id='itemtypeshow"+trrow+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemgroupshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='itemclassshow"+trrow+"'> </small></div><div class='box10 itmdetlheading'><small id='itemcategoryshow"+trrow+"'> </small></div></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div></td>";
                                 rowData +="<td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+trrow+"' name='item_name[]' value='"+data1.data[x].ITEM_NAME+"' readonly><small class='tooltiptextitem' id='itemNameTooltip"+trrow+"'>"+data1.data[x].ITEM_NAME+"</small><textarea id='remark_data"+trrow+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description' readonly>"+remark+"</textarea></td>";
                                 rowData +="<td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate'  id='qty"+trrow+"' name='qty[]'style='width: 80px' oninput='Getqunatity("+trrow+")' value="+qty_recvd+"><input type='text' name='unit_M[]' id='UnitM"+trrow+"' class='inputboxclr SetInCenter AddM' readonly value="+data1.data[x].UM+"><input type='hidden' id='Cfactor"+trrow+"' value="+data1.data[x].AUM_FACTOR+"><input type='hidden' id='existQty"+trrow+"' name='existQty[]' value="+data1.data[x].QTYRECD+"></div></td>";
                                 rowData +="<td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+trrow+"' name='Aqty[]'  style='width: 80px' value='"+aq_recvd+"' readonly  /><input type='text' name='add_unit_M[]' id='AddUnitM"+trrow+"' value="+data1.data[x].AUM+" class='inputboxclr SetInCenter AddM' readonly><input type='hidden' id='existaddQty"+trrow+"' name='existaddQty[]' value="+data1.data[x].AQTYRECD+"></div></td>";
                                 rowData +="<td class='tdthtablebordr'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate'  id='issueqty"+trrow+"' name='issueqty[]' oninput='Getqunatityissue("+trrow+")''  style='width: 80px' value="+qty_issue+"><input type='text' name='issueunit_M[]' id='issueUnitM"+trrow+"' class='inputboxclr SetInCenter AddM'  value="+data1.data[x].UM+"  readonly></td>";
                                 rowData +="<td class='tdthtablebordr'> <input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='issueA_qty"+trrow+"' name='issueAqty[]' value='"+aq_issue+"' style='width: 80px' readonly /><input type='text' name='issueadd_unit_M[]' value="+data1.data[x].AUM+" id='issueAddUnitM"+trrow+"' class='inputboxclr SetInCenter AddM' readonly></td>";
                                
                                 rowData +="</tr>";
                                 $("#submitdata").prop('disabled',false);
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

<script type="text/javascript">
  
  function getvrnoBySeries(){

    var seriesCode = $('#series_code').val();
    var transcode = $('#transcode').val();

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
                      $('#getVrNo').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);
                      $('#getVrNo').val(lastNo);
                    }
                  }

              }

          }

    });

}
</script>

@endsection