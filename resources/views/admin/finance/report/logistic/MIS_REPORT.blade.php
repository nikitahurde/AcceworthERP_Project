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

  

  .secondSection{

    display: none;
  }
  .hidetable{
    display: none;
  }
  .rightcontent{

  text-align:right;


}
.hidebtn{
display: none;
}

::placeholder {
  
  text-align:left;
}

.dt-buttons{
    margin-bottom: -30px!important;
  }
  .dt-button{
    display: inline-block!important;
    font-weight: 600 !important;
    text-align: center!important;
    white-space: nowrap!important;
    vertical-align: middle!important;
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    user-select: none!important;
    border: 1px solid transparent!important;
    padding: .375rem .75rem!important;
    font-size: 12px!important;
    line-height: 1.5!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
  }
  .dt-button:before {
    content: '\f02f';
    font-family: FontAwesome;
    padding-right: 5px;
  }
  .buttons-excel{
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
  }
  .buttons-excel:before {
    content: '\f1c9';
    font-family: FontAwesome;
    padding-right: 5px;
  }
  .vrDateDataTbl{
    width: 7%;
    text-align: left;
  }
  .vrVrNoDataTbl{
    width: 9%;
    text-align: left;
  }
  .refDataTbl{
    width: 19%;
    text-align: left;
  }
  .drAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .crAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .balAmtDataTbl{
    width: 15%;
    text-align: left;
  }
  .balTypeDataTbl{
    width: 5%;
    text-align: left;
  }
  .pfctDataTbl{
    width: 15%;
    text-align: left;
  }
  .btn-sm {
    padding: 4px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
  }

  .content-header h1 {
      margin-top: 2%;
  }
  .content-header .breadcrumb {
      margin-top: 2%;
  }
  .box-header {
      color: #444;
      display: block;
      padding: 3px;
      position: relative;
  }
  table.dataTable {
      clear: both;
      margin-top: 0px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }
  .content {
      min-height: 250px;
      padding: 9px;
      margin-right: auto;
      margin-left: auto;
      padding-left: 15px;
      padding-right: 15px;
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

 .required-field::before {

    content: "*";

    color: red;

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
  margin-top: 24% !important;
  font-weight: 800 !important;
  font-size: 11px !important;

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
  width: 25%; 
  text-align: center;
}
 .texIndbox1{
  width: 5%; 
  text-align: center;
}
.rateIndbox{
  width: 15%;
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


<style type="text/css">



  .Custom-Box {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .OperatorTd{
    width: 35px !important;
  }
  .ValuesTd{
    width: 50% !important;
  }

  .QueryTableTd{
    font-size: 14px !important;
    font-weight: 600 !important;
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

  .crBal{
    display:none;
  }

  .showAccName{

    border: none;

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

  }

  .defualtSearchNew{

    display: none;

  }

  .alignRightClass{
    text-align: right;
  }

  .alignCenterClass{
    text-align: center;
  }

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

 }
 .rightcontent{

  text-align:right;
}
.hiddencolumn{

    display:none;            
  }

.modal-header .close {
    margin-top: -25px !important;
    margin-right: 2% !important;
}

::placeholder {
  
  text-align:left;
}

 @media only screen and (max-width: 600px) {
  
  .dataTables_filter{
    margin-left: 35%;
  }
}

.dt-buttons{
    margin-bottom: -30px!important;
  }
  .dt-button{
   
    
    display: inline-block!important;
    font-weight: 600 !important;
    text-align: center!important;
    white-space: nowrap!important;
    vertical-align: middle!important;
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    user-select: none!important;
    border: 1px solid transparent!important;
    padding: .375rem .75rem!important;
    font-size: 15px!important;
    line-height: 1.5!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
  }

.dt-button:before {
  content: '\f02f';
  font-family: FontAwesome;
  padding-right: 5px;
  
}

.buttons-excel{

    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
}
.buttons-excel:before {
  content: '\f1c9';
  font-family: FontAwesome;
  padding-right: 5px;
  
}

</style>


<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

         LORRY RECEIPT - MIS REPORT

            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">C and F</a></li>
            
            <li class="active"><a href="{{ url('/report/logistic/trip-planning/monthly-trip-planning-report') }}">LORRY RECEIPT - MIS REPORT</a></li>

          </ol>

        </section>

<section class="content">

    <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> LORRY RECEIPT - MIS REPORT</h2>


        </div><!-- /.box-header -->

        <div class="box-body">

            <?php date_default_timezone_set('Asia/Kolkata'); ?>

          <div class="row">
             

            <div class="col-md-2">

                <div class="form-group">

                  <?php

                   $From_date = date("d-m-Y", strtotime($fromDate));
                   $To_date = date("d-m-Y", strtotime($toDate));

                  ?>
                      
                  <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $From_date }}">
                  <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $To_date }}">
                  <label for="exampleInputEmail1">From Date : </label>

                  <div class="input-group">
                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                     <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="Enter From  Date" value="<?php echo $From_date; ?>">

                  </div>
                  <small id="show_err_from_date" style="color: red;"></small>
                    
                </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                  <label for="exampleInputEmail1">To Date: </label>

                  <div class="input-group">
                        <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                        <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control datepicker1" placeholder="Enter To  Date" value="<?php echo date('d-m-Y'); ?>">

                  </div>

                  <small id="show_err_to_date" style="color:red;"></small>

              </div>

            </div><!-- /.col -->
                <div class="col-md-2">

                  <div class="form-group">

                    <label> Comp Code : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input list="compList" class="form-control" name="comp_code" value="" id="comp_code" placeholder="Enter Comp Code"  autocomplete="off">

                        <datalist id="compList">
                          <?php foreach($complist as $key)  { ?>

                          <option value="<?= $key->COMP_CODE ?>" data-xyz="<?= $key->COMP_NAME ?>"><?= $key->COMP_CODE ?> - <?= $key->COMP_NAME ?></option>
                           <?php } ?>
                        </datalist>

                        <input type="hidden" name="compName" id="compName" value="">

                      </div>

                      <small id="showplantCatErr" style="color: red;"></small>

                  </div><!-- /.form-group -->
              </div> <!--  /. col-md-2 -->

               <div class="col-md-3">

                <div class="form-group">

                  <label>Plant Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="plantList"  id="plantCodeId" onchange="getNameofPlantCode()" name="plantCode"  class="form-control  pull-left" placeholder="Select Plant"  value="{{ old('plantCode')}}" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="plantList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($plantlist as $key)

                        <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                      <input type="hidden" name="plant_name" id="seriesName">

                      <input type="hidden" name="plant_state" id="plantState">

                    </div>
                    <small id="plantcode_err" style="color: red;" class="form-text text-muted"> </small>

                    <small id="showplantErr" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>To Place : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="toPlaceList"  id="to_place" name="to_place" class="form-control  pull-left" value="{{ old('tranType')}}" placeholder="Select To Place"  autocomplete="off">

                      <datalist id="toPlaceList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($toplacelist as $key)

                        <option value='<?php echo $key->CITY_NAME?>'   data-xyz ="<?php echo $key->CITY_NAME; ?>" ><?php echo $key->CITY_NAME; ?></option>

                        @endforeach

                      </datalist>

                    </div>
                    <small id="shwoErrTranCode" style="color: red;"></small>
                </div><!-- /.form-group -->

              </div>
              
            </div> <!-- /.row -->

            <div class="row">

               <!-- /. col-md-2 -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Acc Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="AccountList"  id="account_code" onchange="getOtherDataFromAccCode(this.value)" name="AccCode" class="form-control  pull-left" value="{{ old('AccCode')}}" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="AccountList">

                        <?php foreach($Acclist as $key) { ?>

                        <option selected="selected" value="">-- Select --</option>
                        <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> - <?= $key->ACC_NAME ?></option>

                        <?php } ?>

                      </datalist>

                    </div>

                    <input type="hidden" id="accStateCode" name="accStateCode">
                 
                    <small id="shwoErrAccCode" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Acc Name: <span class="required-field"></span></label>

                    <div class="">

                      <input type="text"  id="AccountText" name="AccountText" class="form-control  pull-left" value="{{ old('AccountText')}}" placeholder="Select Account Name" readonly autocomplete="off">
                     
                    </div>

                </div><!-- /.form-group -->

              </div><!-- /.col-md-3 -->

              
              <div class="col-md-2">

                <div class="form-group">

                  <label>Transporter Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="transporterList"  id="transpoter_code"  name="transpoter_code" class="form-control  pull-left" value="" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="transporterList">

                        <option selected="selected" value="">-- Select --</option>

                        <?php foreach($Transporterlist as $key) { ?>

                        <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> - <?= $key->ACC_NAME ?></option>

                      
                        <?php  } ?>

                      </datalist>

                    </div>

                    <input type="hidden" id="accStateCode" name="accStateCode">
                 
                    <small id="shwoErrAccCode" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Transporter Name: <span class="required-field"></span></label>

                    <div class="">

                      <input type="text"  id="Transporter_name" name="Transporter_name" class="form-control  pull-left" value="" placeholder="Select Account Name" readonly autocomplete="off">
                     
                    </div>

                </div><!-- /.form-group -->

              </div>


               

          </div><!-- ./ row -->

          <div class="row">

             <div class="col-md-2">

                <div class="form-group">

                  <label>Consinee : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="cpList"  id="cp_code" name="cp_code" class="form-control  pull-left" value="" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="cpList">
                       

                         <?php foreach($cplist as $key) { ?>

                        <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> - <?= $key->ACC_NAME ?></option>

                      
                        <?php  } ?>

                      

                      </datalist>

                    </div>

                    <input type="hidden" id="accStateCode" name="accStateCode">
                 
                    <small id="shwoErrAccCode" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->
            <div class="col-md-2">

                <div class="form-group">

                  <label>Vehicle No : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="vehicleNoList"  id="vehicleNoId" name="vehicleNo" class="form-control  pull-left" value="{{ old('vehicleNo')}}" placeholder="Select Vehicle No"  autocomplete="off">

                      <datalist id="vehicleNoList">

                        <?php foreach($tripHeadVehiclelist as $key) { ?>

                          <option value="<?= $key->VEHICLE_NO ?>" data-xyz="<?= $key->VEHICLE_NO ?>"><?= $key->VEHICLE_NO ?> - <?= $key->OWNER ?></option>

                        <?php  } ?>

                      </datalist>


                     <!--  <input type="text"  id="freightzero" name="freightzero" class="form-control  pull-left" value="0.00" placeholder="Select Vehicle No"  autocomplete="off"> -->

                    </div>

                </div><!-- /.form-group -->

              </div>

              <div class="col-md-3">

                <div class="form-group">

                  <label>Select MIS : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="misList"  id="select_mis" name="select_mis" class="form-control  pull-left" value="" placeholder="Select MIS"  autocomplete="off">

                      <datalist id="misList">

                        <option  value="Daily LR Report" data-xyz="Daily LR Report">Daily LR Report</option>
                        <option  value="Daily LR Acknowledgment Report" data-xyz="Daily LR Acknowledgment Report">Daily LR Acknowledgment Report</option>
                        <option  value="Market Vehicle Advance Details" data-xyz="Market Vehicle Advance Details">Market Vehicle Advance Details</option>
                        <option  value="LR Pending For Acknowledgment" data-xyz="LR Pending For Acknowledgment">LR Pending For Acknowledgment</option>
                        <option  value="Zero Freight Rate for Sale Bill" data-xyz="Zero Freight Rate for Sale Bill">Zero Freight Rate for Sale Bill</option>
                        <option  value="Zero Freight Rate for Purchase Bill" data-xyz="Zero Freight Rate for Purchase Bill">Zero Freight Rate for Purchase Bill</option>
                        <option  value="LR Pending For Sale Bill" data-xyz="LR Pending For Sale Bill">LR Pending For Sale Bill</option>
                        <option  value="LR Pending For Purchase Bill" data-xyz="LR Pending For Purchase Bill">LR Pending For Purchase Bill</option>
                        <option  value="Pending Temporary Bill(EX-SIDING)" data-xyz="Pending Temporary Bill(EX-SIDING)">Pending Temporary Bill(EX-SIDING)</option>
                        <option  value="Pending Final Bill Against Provisional" data-xyz="Pending Final Bill Against Provisional">Pending Final Bill Against Provisional</option>
                        <option  value="LR Details For Warai Charges" data-xyz="LR Details For Warai Charges">LR Details For Warai Charges</option>
                        <option  value="LR Acknowledgment Shortage" data-xyz="LR Acknowledgment Shortage">LR Acknowledgment Shortage</option>
                       
                        
                        

                      </datalist>


                     <!--  <input type="text"  id="freightzero" name="freightzero" class="form-control  pull-left" value="0.00" placeholder="Select Vehicle No"  autocomplete="off"> -->
                    </div>
                    
                    <small id="show_err_mis" style="color: red;"></small>

                </div><!-- /.form-group -->
              </div>

                <div class="col-md-4" style="margin-top: 1%;">

                    <div id="SelectMISText" style="font-weight:bold;font-size:16px;color:#3c8dbc;"></div>
              
                  </div>
              <!-- /. col-md-3 -->

            </div><!-- ./ row -->

            <div class="row">

              <div class="col-md-4" style="margin-top: 1%;"></div>

              <div class="col-md-4 text-center" style="margin-top: 1%;">

                  
                <button type="button" class="btn btn-primary" id="btnsearch">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                 <button type="button" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

              </div>

              <div class="col-md-4"></div>

            </div>

          </div><!-- /.box-body -->

         
           
    </div>

</section>
  
    <section class="content">

    <div class="box box-primary Custom-Box">
      <div class="box-body">

                <table id="GrnInwordRtTbl" class="table table-responsive  table-bordered table-striped table-hover">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">LR NO</th>
                      <th class="text-center">LR DATE</th>
                      <th class="text-center provbill">INVOICE NO</th>
                      <th class="text-center provbill">INVOICE DATE</th>
                      <th class="text-center provbill">DELIVERY NO</th>
                      <th class="text-center provbill">TRANSPORTER NAME</th>
                      <th class="text-center provbill">BILL TYPE</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center provbill">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                      <th class="text-center">FREIGHT RATE</th>
                      <th class="text-center">FREIGHT AMOUNT</th>
                      <th class="text-center shortgqty">SHORTAGE QTY</th>
                      <th class="text-center recdqty">RECEIVED QTY</th>
                      <th class="text-center waraicharges">WARAI CHARGES</th>
                      <th class="text-center provbill">PAYBLE BILL AMT</th>
                      <th class="text-center provbill">SGST</th>
                      <th class="text-center provbill">CGST</th>
                     
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>

                <table id="dailyLrReport" class="table table-responsive  table-bordered table-striped table-hover hidetable">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">LR NO</th>
                      <th class="text-center">LR DATE</th>
                      <th class="text-center">INVOICE NO</th>
                      <th class="text-center">INVOICE DATE</th>
                      <th class="text-center">DELIVERY NO</th>
                      <th class="text-center">TRANSPORTER NAME</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                      
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>



                 <table id="dailyLrAckReport" class="table table-responsive  table-bordered table-striped table-hover hidetable">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">LR NO</th>
                      <th class="text-center">LR DATE</th>
                      <th class="text-center">LR ACK DATE</th>
                      <th class="text-center">INVOICE NO</th>
                      <th class="text-center">INVOICE DATE</th>
                      <th class="text-center">DELIVERY NO</th>
                      <th class="text-center">BILL TYPE</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                      <th class="text-center">RECEIVED QTY</th>
                      <th class="text-center">SHORTAGE QTY</th>
                      
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>



                 <table id="LrAckPendingReport" class="table table-responsive  table-bordered table-striped table-hover hidetable">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">LR NO</th>
                      <th class="text-center">LR DATE</th>
                      <th class="text-center">INVOICE NO</th>
                      <th class="text-center">INVOICE DATE</th>
                      <th class="text-center">DELIVERY NO</th>
                      <th class="text-center">TRANSPORTER NAME</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                    
                      
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>


                <table id="marketAdvanceReport" class="table table-responsive  table-bordered table-striped table-hover hidetable">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">TRANSPORTER NAME</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                      <th class="text-center">ADVANCE PERCENT</th>
                      <th class="text-center">ADVANCE AMOUNT</th>
                      
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>



                <table id="zeroFreightSaleReport" class="table table-responsive  table-bordered table-striped table-hover hidetable">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">LR NO</th>
                      <th class="text-center">LR DATE</th>
                      <th class="text-center">TRANSPORTER NAME</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                      <th class="text-center">FREIGHT SALE RATE</th>
                      
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>


                 <table id="zeroFreightPurchaseReport" class="table table-responsive  table-bordered table-striped table-hover hidetable">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">LR NO</th>
                      <th class="text-center">LR DATE</th>
                      <th class="text-center">TRANSPORTER NAME</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                      <th class="text-center">FREIGHT PURCHASE RATE</th>
                      
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>


                 <table id="lrPendingSaleBillReport" class="table table-responsive  table-bordered table-striped table-hover hidetable">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">LR NO</th>
                      <th class="text-center">LR DATE</th>
                      <th class="text-center">LR ACK DATE</th>
                      <th class="text-center">TRANSPORTER NAME</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">OWN VEHICLE</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                      <th class="text-center">FREIGHT SALE RATE</th>
                      <th class="text-center">AMOUNT</th>
                   
                      <th class="text-center">RECEIVED QTY</th>
                      <th class="text-center">SHORTAGE QTY</th>
                      
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>

                 <table id="lrPendingPurchaseBillReport" class="table table-responsive  table-bordered table-striped table-hover hidetable">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">LR NO</th>
                      <th class="text-center">LR DATE</th>
                      <th class="text-center">LR ACK DATE</th>
                      <th class="text-center">TRANSPORTER NAME</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">OWN VEHICLE</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                      <th class="text-center">FREIGHT PURCHASE RATE</th>
                      <th class="text-center">AMOUNT</th>
                      <th class="text-center">RECEIVED QTY</th>
                      <th class="text-center">SHORTAGE QTY</th>
                      
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>

                 <table id="PendingTempBillReport" class="table table-responsive  table-bordered table-striped table-hover hidetable">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">LR NO</th>
                      <th class="text-center">LR DATE</th>
                      <th class="text-center">LR ACK DATE</th>
                      <th class="text-center">TRANSPORTER NAME</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                      <th class="text-center">FREIGHT RATE</th>
                      <th class="text-center">AMOUNT</th>
                      <th class="text-center">RECEIVED QTY</th>
                      <th class="text-center">SHORTAGE QTY</th>
                      
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>



                <table id="LRwaraiChargesReport" class="table table-responsive  table-bordered table-striped table-hover hidetable">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">TRANSPORTER NAME</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                      <th class="text-center">RECEIVED QTY</th>
                      <th class="text-center">SHORTAGE QTY</th>
                      <th class="text-center">WARAI CHARGES</th>
                      
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>


                <table id="LrACKShortageReport" class="table table-responsive  table-bordered table-striped table-hover hidetable">
                  <thead class="theadC">
                    <tr>
                   
                      <th class="text-center">COMP CODE</th>
                      <th class="text-center">TRANSPORTER NAME</th>
                      <th class="text-center">FROM PLACE</th>
                      <th class="text-center">TO PLACE</th>
                      <th class="text-center">ITEM NAME</th>
                      <th class="text-center">TRUCK NO</th>
                      <th class="text-center">CUSTOMER</th>
                      <th class="text-center">CONSINEE</th>
                      <th class="text-center">LR QTY</th>
                      <th class="text-center">RECEIVED QTY</th>
                      <th class="text-center">SHORTAGE QTY</th>
                      
                     <!--  <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th> -->
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                 <!--  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot> -->
                 
                </table>
            </div><!-- /.box-body -->
          </div>
        </section>

</div>

<input type="hidden" id="excelName" value="" />



  {{--**** Start : Quality Parameter Model ****--}}

    <div id="quaPdomModel_2">
         
    </div>


    {{--**** End : Quality Parameter Model ****--}}



@include('admin.include.footer')


<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript">
  
  $("#select_mis").on('change', function () {  

    var select_mis = $('#select_mis').val();

   // alert(select_mis);

    var xyz = $('#misList option').filter(function() {

    return this.value == select_mis;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
          $('#SelectMISText').html('');
        }else{
          $('#SelectMISText').html(msg);
        }

  });


  $("#comp_code").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
          
            $("#compName").val('');

          }else{

            $("#compName").val(msg);
    

          }

        });

</script>

 <script type="text/javascript">



  $(document).ready(function(){

      var d = new Date();
        var strDate = d.getDate() + "0" + (d.getMonth()+1) + "" + d.getFullYear();

        var time = d.getHours() + "" + d.getMinutes() + "" + d.getSeconds();

        $('#excelName').val(strDate+'_'+time);

        $( window ).on( "load", function() {

          $('#stock_summary_modal').modal('show');

          var fromdateintrans = $('#FromDateFy').val();
          var todateintrans = $('#ToDateFy').val();

          $('#from_date').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });

          $('#to_date').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });



        });

  });


  
/* START : Load Data Table */
var blankData = 'Blank';
//load_data_query(blankData=='');


function load_data_query(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

   

      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();

       if(comp_code){

          var CompCode = comp_code+' '+comp_name;
        }else{

          var CompCode = 'ALL Entities';

      }


      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
   
  $('#GrnInwordRtTbl').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
          //scrollY: true,
         // scrollY: 500,
          scrollX: true,
          //scroller: true,
          fixedHeader: true,
         order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'PENDING_FINAL_BILL_AGAINST_PROVISIONAL'+getdate+'_'+gettime,
                        title: CompCode+' - '+' PENDING FINAL BILL AGAINST PROVISIONAL',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22]
                        }
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
        { data :'LR_NO'},
        { data :'LR_DATE'},
        { data :'INVC_NO',
        render:function (data, type, full) {


              var INVC_NO = full['INVC_NO'];

              /*if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }
*/
             
               return  INVC_NO;
            
        

         },className:'provbill',


      },
      { data :'INVC_DATE',
        render:function (data, type, full) {


              var INVC_DATE = full['INVC_DATE'];

             /* if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }*/

             
               return  INVC_DATE;
            
        

         },className:'provbill',


      },
      { data :'DELIVERY_NO',
        render:function (data, type, full) {


              var DELIVERY_NO = full['DELIVERY_NO'];

              /*if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }*/

             
               return  DELIVERY_NO;
            
        

         },className:'provbill',


      },
       { data :'TRANSPORT_NAME',
        render:function (data, type, full) {


              var TRANSPORT_NAME = full['TRANSPORT_NAME']+' - '+full['TRANSPORT_CODE'];

               return  TRANSPORT_NAME;
            
        

         },


      },
      { data :'BILL_TYPE',
        render:function (data, type, full) {


              var BILL_TYPE = full['BILL_TYPE'];

               return  BILL_TYPE;
            
        

         },className:'provbill',


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'QTY',className:'text-right'},
        { data :'FSO_RATE',

          render:function (data, type, full) {
          
          if(select_mis=='Zero Freight Rate for Sale Bill'){

                 var FSO_RATE = full['FSO_RATE'];
         
                  if(FSO_RATE==null){

                      return fso_rate = '0.000';     
                    }else{
                      return fso_rate = FSO_RATE;
                    }

              }else{

                var FPO_RATE = full['FPO_RATE'];
         
                  if(FPO_RATE==null){

                      return fpo_rate = '0.000';     
                    }else{
                      return fpo_rate = FPO_RATE;
                    }

              }

         },className:'text-right'

        },
        { 
         render:function (data, type, full) {

        if(select_mis=='Zero Freight Rate for Sale Bill'){
            
              var FSO_RATE = full['FSO_RATE'];
                if(FSO_RATE==null){

                  return fso_rate = '0.000';     
                }else{
                  return fso_rate = FSO_RATE;
                }
              var QTY = full['QTY'];

              var fso_amt = parseFloat(fso_rate) * parseFloat(QTY);

              return fso_amt;
         }else{

                var FPO_RATE = full['FPO_RATE'];
                if(FPO_RATE==null){

                  return fpo_rate = '0.000';     
                }else{
                  return fpo_rate = FPO_RATE;
                }
              var QTY = full['QTY'];

              var fpo_amt = parseFloat(fpo_rate) * parseFloat(QTY);

              return fpo_amt;

        }
        

         },className:'text-right'
       },

       { data:'SHORTAGE_QTY',

        render:function (data, type, full) {

              var SHORTAGE_QTY = full['SHORTAGE_QTY'];

             /* if(select_mis=='LR Pending For Purchase Bill'){

                   $(".shortgqty").show();

                }else{

                  $(".shortgqty").hide();

                }*/

                if(SHORTAGE_QTY==null || SHORTAGE_QTY=='0.000'){

                    var shrtage_qty = '0.000';

                  }else{
                    var shrtage_qty = SHORTAGE_QTY;
                    }
         
                   return  shrtage_qty; 
              
            
        

         },className:'shortgqty',


        },

       { data :'RECD_QTY',

        render:function (data, type, full) {

              var RECD_QTY = full['RECD_QTY'];

             /* if(select_mis=='LR Pending For Purchase Bill'){

                   $(".recdqty").show();

                }else{

                  $(".recdqty").hide();

                }*/

              if(RECD_QTY==null || RECD_QTY=='0.000'){

                var recd_qty = '0.000';

               }else{
                var recd_qty = RECD_QTY;
              }
         
               return  recd_qty;
            
        

         },className:'shortgqty',


      },
      { data :'amount',

        render:function (data, type, full) {

           if(select_mis=='LR Details For Warai Charges' || select_mis=='LR Acknowledgment Shortage' || select_mis=='Pending Final Bill Against Provisional'){

                   $(".waraicharges").show();

                }else{

                  $(".waraicharges").hide();

                }

              var amount = full['amount'];

              if(amount==null || amount=='0.000'){

                var amt = '0.000';

               }else{
                var amt = amount;
              }
         
               return  amt;
            
        

         },className:'waraicharges',


      },
      { data :'PAYBLE_BILL_AMT',
        render:function (data, type, full) {


              var PAYBLE_BILL_AMT = full['PAYBLE_BILL_AMT'];

             /* if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }*/

             
               return  PAYBLE_BILL_AMT;
            
        

         },className:'provbill',


      },
      { data :'SGST_UGST',
        render:function (data, type, full) {


              var SGST_UGST = full['SGST_UGST'];

             /* if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }*/

             
               return  SGST_UGST;
            
        

         },className:'provbill',


      },
      { data :'CGST',
        render:function (data, type, full) {


              var CGST = full['CGST'];

              /*if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }*/

             
               return  CGST;
            
        

         },className:'provbill',


      },

        
        
      ]


  });


}


/* END : Load Data Table */


function load_data_lorry(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

      console.log('select mis',select_mis);

       

      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();

      if(comp_code){

          var CompCode = comp_code+' '+comp_name;
        }else{

          var CompCode = 'ALL Entities';

      }

      console.log('comp_code',comp_code);

      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
   
  $('#dailyLrReport').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
         // scrollY: true,
          scrollX: true,
          //scroller: true,
          fixedHeader: true,
         order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'DAILY_LR_REPORT'+getdate+'_'+gettime,
                        title: CompCode+' - '+' DAILY LR REPORT',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                        className:'text-left',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
                        }
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
        { data :'LR_NO'},
        { data :'LR_DATE'},
        { data :'INVC_NO',
        render:function (data, type, full) {


              var INVC_NO = full['INVC_NO'];

              /*if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }
*/
             
               return  INVC_NO;
            
        

         },className:'provbill',


      },
      { data :'INVC_DATE',
        render:function (data, type, full) {


              var INVC_DATE = full['INVC_DATE'];

             /* if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }*/

             
               return  INVC_DATE;
            
        

         },className:'provbill',


      },
      { data :'DELIVERY_NO',
        render:function (data, type, full) {


              var DELIVERY_NO = full['DELIVERY_NO'];

              /*if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }*/

             
               return  DELIVERY_NO;
            
        

         },className:'provbill',


      },
      { data :'TRANSPORT_NAME',
        render:function (data, type, full) {


              var TRANSPORT_NAME = full['TRANSPORT_NAME']+' - '+full['TRANSPORT_CODE'];

               return  TRANSPORT_NAME;
            
        

         },


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'QTY',className:'text-right'},
        

        
        
      ]


  });


}


/*lr ack report*/


function load_data_lorry_ack(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

      console.log('select mis',select_mis);

       

      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();

      if(comp_code){

          var CompCode = comp_code+' '+comp_name;
        }else{

          var CompCode = 'ALL Entities';

      }


      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
   
  $('#dailyLrAckReport').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
         // scrollY: true,
          scrollX: true,
          //scroller: true,
         // fixedHeader: true,
          order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'DAILY_LR_ACKNOWLEDGMENT'+getdate+'_'+gettime,
                        title: CompCode+' - '+' DAILY LR ACKNOWLEDGMENT',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
                        }
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
        { data :'LR_NO'},
        { data :'LR_DATE'},
        { data :'ACK_DATE'},
        { data :'INVC_NO',
        render:function (data, type, full) {


              var INVC_NO = full['INVC_NO'];

              /*if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }
*/
             
               return  INVC_NO;
            
        

         },className:'provbill',


      },
      { data :'INVC_DATE',
        render:function (data, type, full) {


              var INVC_DATE = full['INVC_DATE'];

             /* if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }*/

             
               return  INVC_DATE;
            
        

         },className:'provbill',


      },
      { data :'DELIVERY_NO',
        render:function (data, type, full) {


              var DELIVERY_NO = full['DELIVERY_NO'];

              /*if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }*/

             
               return  DELIVERY_NO;
            
        

         },className:'provbill',


      },
      { data :'BILL_TYPE',
        render:function (data, type, full) {


              var BILL_TYPE = full['BILL_TYPE'];

               return  BILL_TYPE;
            
        

         },className:'provbill',


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'QTY',className:'text-right'},
        { data :'RECD_QTY',className:'text-right'},
        { data :'SHORTAGE_QTY',className:'text-right'},
        

        
        
      ]


  });


}
/*lr ack report*/


/*lr ack report*/


function load_data_lr_ack_pending(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

      console.log('select mis',select_mis);

       

      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();

       if(comp_code){

          var CompCode = comp_code+' - '+comp_name;
        }else{

          var CompCode = 'ALL Entities';

      }



      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
   
  $('#LrAckPendingReport').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
         // scrollY: true,
          scrollX: true,
          //scroller: true,
         fixedHeader: true,
          order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'LR_ACK_PENDING'+getdate+'_'+gettime,
                        title: CompCode+' - '+' LR ACKNOWLEDGMENT PENDING',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
                        }
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
        { data :'LR_NO'},
        { data :'LR_DATE'},
        { data :'INVC_NO',
        render:function (data, type, full) {


              var INVC_NO = full['INVC_NO'];

              /*if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }
*/
             
               return  INVC_NO;
            
        

         },className:'provbill',


      },
      { data :'INVC_DATE',
        render:function (data, type, full) {


              var INVC_DATE = full['INVC_DATE'];

             /* if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }*/

             
               return  INVC_DATE;
            
        

         },className:'provbill',


      },
      { data :'DELIVERY_NO',
        render:function (data, type, full) {


              var DELIVERY_NO = full['DELIVERY_NO'];

              /*if(select_mis=='Pending Final Bill Against Provisional'){

                   $(".provbill").show();

                }else{

                  $(".provbill").hide();

                }*/

             
               return  DELIVERY_NO;
            
        

         },className:'provbill',


      },
      { data :'TRANSPORT_NAME',
        render:function (data, type, full) {


              var TRANSPORT_NAME = full['TRANSPORT_NAME']+' - '+full['TRANSPORT_CODE'];

               return  TRANSPORT_NAME;
            
        

         },className:'provbill',


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'QTY',className:'text-right'},
       
        
        
      ]


  });


}
/*lr ack report*/


/*vehicle payment advance report*/


function load_data_market_advance(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

      console.log('select mis',select_mis);

       

      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();

       if(comp_code){

          var CompCode = comp_code+' '+comp_name;
        }else{

          var CompCode = 'ALL Entities';

      }


      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
   
  $('#marketAdvanceReport').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
         // scrollY: true,
          scrollX: true,
          //scroller: true,
          fixedHeader: true,
          order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'MARKET_VEHICLE_ADVANCE_REPORT_'+getdate+'_'+gettime,
                        title: CompCode+' - '+' MARKET VEHICLE ADVANCE REPORT',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10]
                        }
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
      { data :'TRANSPORT_NAME',
        render:function (data, type, full) {


              var TRANSPORT_NAME = full['TRANSPORT_NAME']+' - '+full['TRANSPORT_CODE'];

               return  TRANSPORT_NAME;
            
        

         },className:'provbill',


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'QTY',className:'text-right'},
        { data :'ADV_RATE',className:'text-right'},
        { data :'ADV_AMT',className:'text-right'},
        

        
        
      ]


  });


}

  /*vehicle payment advance report*/

/*zero freight rate sale report*/


function load_data_zero_freight_sale(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

      console.log('select mis',select_mis);

       

      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();

      if(comp_code){

          var CompCode = comp_code+' '+comp_name;
        }else{

          var CompCode = 'ALL Entities';

      }


      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
   
  $('#zeroFreightSaleReport').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
         // scrollY: true,
          scrollX: true,
          //scroller: true,
         fixedHeader: true,
         order: [[2, 'asc'],[3, 'asc']],
         columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'ZERO_FREIGHT_RATE_SALE_REPORT_'+getdate+'_'+gettime,
                        title: CompCode+' - '+' ZERO FREIGHT RATE SALE REPORT',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                        }
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
      { data :'LR_NO'},
      { data :'LR_DATE'},
      { data :'TRANSPORT_NAME',
        render:function (data, type, full) {


              var TRANSPORT_NAME = full['TRANSPORT_NAME']+' - '+full['TRANSPORT_CODE'];

               return  TRANSPORT_NAME;
            
        

         },className:'provbill',


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'QTY',className:'text-right'},
        { data :'FSO_RATE',className:'text-right',

        render:function (data, type, full) {


              var fso_rate = full['FSO_RATE'];

              if(fso_rate){

                  var fsoRate = fso_rate;

              }else{

                   var fsoRate ='0.00';
                }

               return  fsoRate;
            
        

         },className:'text-right',


        },
    
        
        
      ]


  });


}

 /*zero freight rate sale report*/

/*zero freight rate sale report*/


function load_data_zero_freight_purchase(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

     
      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();

      if(comp_code){

          var CompCode = comp_code+' '+comp_name;
        }else{

          var CompCode = 'ALL Entities';

      }

      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
   
  $('#zeroFreightPurchaseReport').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
         // scrollY: true,
          scrollX: true,
          //scroller: true,
          fixedHeader: true,
          order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'ZERO_FREIGHT_RATE_PURCHASE_'+getdate+'_'+gettime,
                        title: CompCode+' - '+' ZERO FREIGHT RATE PURCHASE',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                        }
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
      { data :'LR_NO'},
      { data :'LR_DATE'},
      { data :'TRANSPORT_NAME',
        render:function (data, type, full) {


              var TRANSPORT_NAME = full['TRANSPORT_NAME']+' - '+full['TRANSPORT_CODE'];

               return  TRANSPORT_NAME;
            
        

         },className:'provbill',


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'QTY',className:'text-right'},
        { data :'FPO_RATE',className:'text-right',

        render:function (data, type, full) {


              var fpo_rate = full['FPO_RATE'];

              if(fpo_rate){

                  var fpoRate = fpo_rate;

              }else{

                   var fpoRate ='0.00';
                }

               return  fpoRate;
            
        

         },className:'text-right',


        },
    
        
        
      ]


  });


}

 /*zero freight rate sale report*/


/*pending sale bill rate sale report*/


function load_data_lr_pending_sale_bill(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

     
      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();

      if(comp_code){

          var CompCode = comp_code+' '+comp_name;

        }else{

          var CompCode = 'ALL Entities';

      }


      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
   
  $('#lrPendingSaleBillReport').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
         // scrollY: true,
          scrollX: true,
          //scroller: true,
         fixedHeader: true,
          order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'LR_PENDING_SALE_BILL'+getdate+'_'+gettime,
                        title: CompCode+' - '+' LR PENDING SALE BILL',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
                        }
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
      { data :'LR_NO'},
      { data :'LR_DATE'},
      { data :'ACK_DATE'},
      { data :'TRANSPORT_NAME',
        render:function (data, type, full) {


              var TRANSPORT_NAME = full['TRANSPORT_NAME']+' - '+full['TRANSPORT_CODE'];

               return  TRANSPORT_NAME;
            
        

         },className:'provbill',


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'OWNER',
           render:function (data, type, full) {
          
          var OWNER = full['OWNER'];

          if(OWNER=='SELF'){

            vehicle_owner = 'Y';
          }else{

            vehicle_owner = 'N';
          }
         
            
            return  vehicle_owner;

         },className:'text-center',

        },

        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'QTY',className:'text-right',
        },
        { data :'FSO_RATE',className:'text-right',

        render:function (data, type, full) {


              var fso_rate = full['FSO_RATE'];

              
             return  fso_rate;
            

         },className:'text-right',


        },
        { 
           render:function (data, type, full) {


              var fso_rate = full['FSO_RATE'];
              var qty = full['NET_WEIGHT'];

              var amount = parseFloat(fso_rate) * parseFloat(qty);

             return  amount.toFixed(2);
            

         },className:'text-right',


        },
        { data :'RECD_QTY',className:'text-right'},
        { data :'SHORTAGE_QTY',className:'text-right'},
        
      ]


  });


}

 /*pending sale bill rate sale report*/


/*pending sale bill rate sale report*/


function load_data_lr_pending_purchase_bill(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

     
      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();

      if(comp_code){

          var CompCode = comp_code+' '+comp_name;

        }else{

          var CompCode = 'ALL Entities';

      }

      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;

      var period = 'PERIOD FROM' +from_date+' TO '+to_date+'';
   
  $('#lrPendingPurchaseBillReport').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
         // scrollY: true,
          scrollX: true,
          //scroller: true,
          fixedHeader: true,
          order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'LR_PENDING_PURCHASE_BILL_'+getdate+'_'+gettime,
                        title: CompCode+' - '+' LR PENDING PURCHASE BILL',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
                        }
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
      { data :'LR_NO'},
      { data :'LR_DATE'},
      { data :'ACK_DATE'},
      { data :'TRANSPORT_NAME',
        render:function (data, type, full) {


              var TRANSPORT_NAME = full['TRANSPORT_NAME']+' - '+full['TRANSPORT_CODE'];

               return  TRANSPORT_NAME;
            
        

         },className:'provbill',


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'OWNER',
           render:function (data, type, full) {
          
          var OWNER = full['OWNER'];

          if(OWNER=='SELF'){

            vehicle_owner = 'Y';
          }else{

            vehicle_owner = 'N';
          }
         
            
            return  vehicle_owner;

         },className:'text-center',

        },
        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'QTY',className:'text-right'},
        { data :'FPO_RATE',className:'text-right',

        render:function (data, type, full) {


              var fpo_rate = full['FPO_RATE'];

              
             return  fpo_rate;
            

         },className:'text-right',


        },
        { 
           render:function (data, type, full) {


              var fpo_rate = full['FPO_RATE'];
              var qty = full['NET_WEIGHT'];

              var amount = parseFloat(fpo_rate) * parseFloat(qty);

             return  amount.toFixed(2);
            

         },className:'text-right',


        },
        { data :'RECD_QTY',className:'text-right'},
        { data :'SHORTAGE_QTY',className:'text-right'},
        
      ]


  });


}

 /*pending purchase bill rate sale report*/

function load_data_pending_temp_bill(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

     
      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();


      if(comp_code){

          var CompCode = comp_code+' '+comp_name;

        }else{

          var CompCode = 'ALL Entities';

      }

      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
   
  $('#PendingTempBillReport').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
         // scrollY: true,
          scrollX: true,
          //scroller: true,
          fixedHeader: true,
          order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15]
                        },
                        filename: 'PENDING_TEMP_DELIVERY_'+getdate+'_'+gettime,
                        title: CompCode+' - '+' PENDING TEMP BILL',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
      { data :'LR_NO'},
      { data :'LR_DATE'},
      { data :'ACK_DATE'},
      { data :'TRANSPORT_NAME',
        render:function (data, type, full) {


              var TRANSPORT_NAME = full['TRANSPORT_NAME']+' - '+full['TRANSPORT_CODE'];

               return  TRANSPORT_NAME;
            
        

         },className:'provbill',


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'NET_WEIGHT',className:'text-right'},
        { data :'FSO_RATE',className:'text-right',

        render:function (data, type, full) {


              var fso_rate = full['FSO_RATE'];

              
             return  fso_rate;
            

         },className:'text-right',


        },
        { 
         render:function (data, type, full) {


              var fso_rate = full['FSO_RATE'];
              var qty = full['NET_WEIGHT'];

              var amt = parseFloat(fso_rate) * parseFloat(qty);

             return  amt.toFixed(2);
            

         },className:'text-right',


        },
        { data :'RECD_QTY',className:'text-right'},
        { data :'SHORTAGE_QTY',className:'text-right'},
        
      ]


  });


}



/*lr warai charges report*/

function load_data_lr_warai_charges(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

     
      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();

      if(comp_code){

          var CompCode = comp_code+' '+comp_name;

        }else{

          var CompCode = 'ALL Entities';

      }

      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
   
  $('#LRwaraiChargesReport').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
         // scrollY: true,
          scrollX: true,
          //scroller: true,
          fixedHeader: true,
          order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10,11]
                        },
                        filename: 'LR_WARAI_CHARGES_'+getdate+'_'+gettime,
                        title: CompCode+' - '+' LR WARAI CHARGES',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
      { data :'TRANSPORT_NAME',
        render:function (data, type, full) {


              var TRANSPORT_NAME = full['TRANSPORT_NAME']+' - '+full['TRANSPORT_CODE'];

               return  TRANSPORT_NAME;
            
        

         },className:'provbill',


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'QTY',className:'text-right'},
        { data :'RECD_QTY',className:'text-right'},
        { data :'SHORTAGE_QTY',className:'text-right'},
        { data :'amount',className:'text-right'},
        
      ]


  });


}



/*lr warai charges report*/

function load_data_lr_shortage_report(vrDateId='',comp_code='',plant_code='',to_place='',accountCode='',AccountText='',from_date='',to_date='',transpoter_code='',cp_code='',vehicleNo='',select_mis='',comp_name=''){

     
      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();

      if(comp_code){

          var CompCode = comp_code+' '+comp_name;

        }else{

          var CompCode = 'ALL Entities';

      }


      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
   
  $('#LrACKShortageReport').DataTable({
  
          processing: true,
          serverSide: false,
          info: true,
          bPaginate: true,
         // scrollY: true,
          scrollX: true,
          //scroller: true,
          fixedHeader: true,
          order: [[2, 'asc'],[3, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9,10]
                        },
                        filename: 'LR_ACKNOLEDGMENT_SHORTAGE_'+getdate+'_'+gettime,
                        title: CompCode+' - '+' LR ACKNOLEDGMENT SHORTAGE_',
                        messageTop: 'PERIOD FROM ' +from_date+' TO '+to_date+'',
                      }

                    ],
      ajax:{
        url:'{{ url("/report/get-data-from-lrack-bill-pending") }}',
              data: {vrDateId:vrDateId,comp_code:comp_code,plant_code:plant_code,to_place:to_place,accountCode:accountCode,AccountText:AccountText,from_date:from_date,to_date:to_date,transpoter_code:transpoter_code,cp_code:cp_code,vehicleNo:vehicleNo,select_mis:select_mis},

      },
      columns: [

     
        { data :'COMP_CODE',
         render:function (data, type, full) {
          
          var COMP_NAME = full['COMP_CODE'];
         
            
            return  COMP_NAME;

         },

        },
      { data :'TRANSPORT_NAME',
        render:function (data, type, full) {


              var TRANSPORT_NAME = full['TRANSPORT_NAME']+''+full['TRANSPORT_CODE'];

               return  TRANSPORT_NAME;
            
        

         },className:'provbill',


      },
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'ITEM_NAME',
        render:function (data, type, full) {


              var ITEM_NAME = full['ITEM_NAME'];

               return  ITEM_NAME;
            
        

         },className:'provbill',


      },
        { data :'VEHICLE_NO'},
        { data :'ACC_NAME',

           render:function (data, type, full) {
          
          var ACC_NAME = full['ACC_NAME']+' - '+full['ACC_CODE'];
         
            
            return  ACC_NAME;

         },className:'text-right'
        },
        { data :'CP_NAME',

            render:function (data, type, full) {
          
          var CP_NAME = full['CP_NAME']+' - '+full['CP_CODE'];
         
            
            return  CP_NAME;

         },className:'text-right'
        },
        { data :'QTY',className:'text-right'},
        { data :'RECD_QTY',className:'text-right'},
        { data :'SHORTAGE_QTY',className:'text-right'},
        
      ]


  });


}



$(document).ready(function() {




/* ..........START : Search Button Click ......... */

$('#ProceedBtnId').click(function(){
  
  var lr_no      =  $('#lr_no').val();

  // console.log('lr_no',lr_no);

  var custno     =  $('#cust_no').val();
   //console.log('custno',custno);
  var cust_name  =  $('#cust_name').val();
  var itemcode   =  $('#item_code').val();
  var wagon_no   =  $('#wagon_no').val();
  var item_name  =  $('#item_name').val();
  var from_date  =  $('#from_date').val();
  var to_date    =  $('#to_date').val();
  
  var splitecust = custno.split('-');

  var cust_no    = splitecust[0];
  var splitItem  = itemcode.split('-');

  var item_code  = splitItem[0];

  if(to_date != ''){

     //console.log('grn');

      $('#ProceedBtnId').attr('disabled',true);
      $('#cust_no').attr('disabled',true);
      $('#item_code').attr('disabled',true);
      $('#wagon_no').attr('disabled',true);
      $('#rack_no').attr('disabled',true);
      $('#to_date').attr('disabled',true);
      $('#from_date').attr('disabled',true);
      
      $('#GrnInwordRtTbl').DataTable().destroy();
      $('#show_err_to_date').html('');
      load_data_query(lr_no,cust_no,item_code,wagon_no,from_date,to_date);

  }else{

    $('#show_err_to_date').html('Please select to date').css('color','red');

    // load_data_query();
    console.log('not grn');

  }

  

 

});


 $('#btnsearch').click(function(){
        
        var vrDateId    =  $('#vrDateId').val();
        var comp_code   =  $('#comp_code').val();
        var comp_name   =  $('#compName').val();
        var plant_code  =  $('#plantCodeId').val();
        var to_place    =  $('#to_place').val();
        var accountCode =  $('#account_code').val();
        var AccountText =  $('#AccountText').val();
        var from_date   =  $('#from_date').val();
        var to_date     =  $('#to_date').val();
        var transpoter_code  =  $('#transpoter_code').val();
        var cp_code     =  $('#cp_code').val();
        var vehicleNo   =  $('#vehicleNoId').val();
        var select_mis    =  $('#select_mis').val();
       
        
     //   alert(plant_code);


        if(from_date!='' || to_date!='') {

          if(from_date !=''){
            if(to_date==''){
              $('#show_err_to_date').html('Please select to date').css('color','red');
            return false;
            }else{
              $('#show_err_to_date').html('');
            }
          }
          
          if(to_date !=''){
            if(from_date ==''){
             $('#show_err_from_date').html('Please select from date').css('color','red');
            return false;
            }else{
              $('#show_err_from_date').html('');
            }
          }

          if(select_mis==''){

             $('#show_err_mis').html('Please select MIS').css('color','red');
               return false;
          }

          //alert(comp_code);

          if(select_mis=='Daily LR Report'){

            $("#dailyLrReport").removeClass('hidetable');

            $('#dailyLrReport').show();
            $("#GrnInwordRtTbl").hide();
            $('#dailyLrAckReport').hide();
            $("#marketAdvanceReport").hide();
            $('#LrAckPendingReport').hide();
            $("#zeroFreightSaleReport").hide();
            $("#zeroFreightPurchaseReport").hide();
            $("#lrPendingSaleBillReport").hide();
            $("#lrPendingPurchaseBillReport").hide();
            $("#PendingTempBillReport").hide();
            $("#LRwaraiChargesReport").hide();
            $("#LrACKShortageReport").hide();

            $('#dailyLrReport').DataTable().destroy();
            $('#GrnInwordRtTbl').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
            $("#PendingTempBillReport").DataTable().destroy();
            $("#LRwaraiChargesReport").DataTable().destroy();
            $("#LrACKShortageReport").DataTable().destroy();

              load_data_lorry(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);

          }else if(select_mis=='Daily LR Acknowledgment Report'){

            $("#dailyLrAckReport").removeClass('hidetable');
            $('#dailyLrAckReport').show();
            $('#dailyLrReport').hide();
            $("#GrnInwordRtTbl").hide();
            $("#marketAdvanceReport").hide();
            $('#LrAckPendingReport').hide();
            $("#zeroFreightSaleReport").hide();
            $("#zeroFreightPurchaseReport").hide();
            $("#lrPendingSaleBillReport").hide();
             $("#lrPendingPurchaseBillReport").hide();
             $("#PendingTempBillReport").hide();
             $("#LRwaraiChargesReport").hide();
             $("#LrACKShortageReport").hide();

            $('#dailyLrReport').DataTable().destroy();
            $('#GrnInwordRtTbl').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
             $("#PendingTempBillReport").DataTable().destroy();
             $("#LRwaraiChargesReport").DataTable().destroy();
             $("#LrACKShortageReport").DataTable().destroy();

              load_data_lorry_ack(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);

          }else if(select_mis=='LR Pending For Acknowledgment'){

            $("#LrAckPendingReport").removeClass('hidetable');
            $('#LrAckPendingReport').show();
            $('#dailyLrAckReport').hide();
            $('#dailyLrReport').hide();
            $("#GrnInwordRtTbl").hide();
            $("#marketAdvanceReport").hide();
            $("#zeroFreightSaleReport").hide();
            $("#zeroFreightPurchaseReport").hide();
            $("#lrPendingSaleBillReport").hide();
             $("#lrPendingPurchaseBillReport").hide();
             $("#PendingTempBillReport").hide();
             $("#LRwaraiChargesReport").hide();
             $("#LrACKShortageReport").hide();

            $('#dailyLrReport').DataTable().destroy();
            $('#GrnInwordRtTbl').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
             $("#PendingTempBillReport").DataTable().destroy();
             $("#LRwaraiChargesReport").DataTable().destroy();
             $("#LrACKShortageReport").DataTable().destroy();

              load_data_lr_ack_pending(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);

          }else if(select_mis=='Market Vehicle Advance Details'){

            $("#marketAdvanceReport").removeClass('hidetable');
            $('#dailyLrAckReport').hide();
            $('#dailyLrReport').hide();
            $("#GrnInwordRtTbl").hide();
             $('#LrAckPendingReport').hide();
             $("#zeroFreightSaleReport").hide();
             $("#zeroFreightPurchaseReport").hide();
             $("#lrPendingSaleBillReport").hide();
              $("#lrPendingPurchaseBillReport").hide();
              $("#PendingTempBillReport").hide();
            $("#LRwaraiChargesReport").hide();
            $("#LrACKShortageReport").hide();
            $("#marketAdvanceReport").show();

            $('#dailyLrReport').DataTable().destroy();
            $('#GrnInwordRtTbl').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
            $("#PendingTempBillReport").DataTable().destroy();
            $("#LRwaraiChargesReport").DataTable().destroy();
            $("#LrACKShortageReport").DataTable().destroy();

              load_data_market_advance(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);

          }else if(select_mis=='Zero Freight Rate for Sale Bill'){

            $("#zeroFreightSaleReport").removeClass('hidetable');
            $('#dailyLrAckReport').hide();
            $('#dailyLrReport').hide();
            $("#GrnInwordRtTbl").hide();
            $('#LrAckPendingReport').hide();
            $('#marketAdvanceReport').hide();
            $("#zeroFreightPurchaseReport").hide();
            $("#lrPendingSaleBillReport").hide();
             $("#lrPendingPurchaseBillReport").hide();
             $("#PendingTempBillReport").hide();
             $("#LrACKShortageReport").hide();
            $("#LRwaraiChargesReport").hide();
            $("#zeroFreightSaleReport").show();

            $('#dailyLrReport').DataTable().destroy();
            $('#GrnInwordRtTbl').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
            $("#PendingTempBillReport").DataTable().destroy();
            $("#LRwaraiChargesReport").DataTable().destroy();
            $("#LrACKShortageReport").DataTable().destroy();

              load_data_zero_freight_sale(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);

          }else if(select_mis=='Zero Freight Rate for Purchase Bill'){

            $("#zeroFreightPurchaseReport").removeClass('hidetable');
            $('#dailyLrAckReport').hide();
            $('#dailyLrReport').hide();
            $("#GrnInwordRtTbl").hide();
            $('#LrAckPendingReport').hide();
            $('#marketAdvanceReport').hide();
            $("#zeroFreightSaleReport").hide();
            $("#lrPendingSaleBillReport").hide();
             $("#lrPendingPurchaseBillReport").hide();
             $("#PendingTempBillReport").hide();
             $("#LRwaraiChargesReport").hide();
             $("#LrACKShortageReport").hide();
            $("#zeroFreightPurchaseReport").show();

            $('#dailyLrReport').DataTable().destroy();
            $('#GrnInwordRtTbl').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
            $("#PendingTempBillReport").DataTable().destroy();
            $("#LRwaraiChargesReport").DataTable().destroy();
            $("#LrACKShortageReport").DataTable().destroy();

              load_data_zero_freight_purchase(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);

          }else if(select_mis=='LR Pending For Sale Bill'){

            $("#lrPendingSaleBillReport").removeClass('hidetable');
            $('#dailyLrAckReport').hide();
            $('#dailyLrReport').hide();
            $("#GrnInwordRtTbl").hide();
            $('#LrAckPendingReport').hide();
            $('#marketAdvanceReport').hide();
            $("#zeroFreightSaleReport").hide();
            $("#zeroFreightPurchaseReport").hide();
             $("#lrPendingPurchaseBillReport").hide();
             $("#PendingTempBillReport").hide();
             $("#LRwaraiChargesReport").hide();
             $("#LrACKShortageReport").hide();
            $("#lrPendingSaleBillReport").show();

            $('#dailyLrReport').DataTable().destroy();
            $('#GrnInwordRtTbl').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
            $("#PendingTempBillReport").DataTable().destroy();
            $("#LRwaraiChargesReport").DataTable().destroy();
            $("#LrACKShortageReport").DataTable().destroy();

              load_data_lr_pending_sale_bill(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);

          }else if(select_mis=='LR Pending For Purchase Bill'){

            $("#lrPendingPurchaseBillReport").removeClass('hidetable');
            $('#dailyLrAckReport').hide();
            $('#dailyLrReport').hide();
            $("#GrnInwordRtTbl").hide();
            $('#LrAckPendingReport').hide();
            $('#marketAdvanceReport').hide();
            $("#zeroFreightSaleReport").hide();
            $("#zeroFreightPurchaseReport").hide();
            $("#lrPendingSaleBillReport").hide();
            $("#PendingTempBillReport").hide();
            $("#LRwaraiChargesReport").hide();
            $("#LrACKShortageReport").hide();
            $("#lrPendingPurchaseBillReport").show();

            $('#dailyLrReport').DataTable().destroy();
            $('#GrnInwordRtTbl').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
            $("#lrPendingPurchaseBillReport").DataTable().destroy();
            $("#PendingTempBillReport").DataTable().destroy();
            $("#LRwaraiChargesReport").DataTable().destroy();
            $("#LrACKShortageReport").DataTable().destroy();

              load_data_lr_pending_purchase_bill(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);

          }else if(select_mis=='Pending Temporary Bill(EX-SIDING)'){

            $("#PendingTempBillReport").removeClass('hidetable');
            $('#dailyLrAckReport').hide();
            $('#dailyLrReport').hide();
            $("#GrnInwordRtTbl").hide();
            $('#LrAckPendingReport').hide();
            $('#marketAdvanceReport').hide();
            $("#zeroFreightSaleReport").hide();
            $("#zeroFreightPurchaseReport").hide();
            $("#lrPendingSaleBillReport").hide();
            $("#lrPendingPurchaseBillReport").hide();
            $("#LRwaraiChargesReport").hide();
            $("#LrACKShortageReport").hide();
            $("#PendingTempBillReport").show();

            $('#dailyLrReport').DataTable().destroy();
            $('#GrnInwordRtTbl').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
            $("#lrPendingPurchaseBillReport").DataTable().destroy();
            $("#PendingTempBillReport").DataTable().destroy();
            $("#LRwaraiChargesReport").DataTable().destroy();
            $("#LrACKShortageReport").DataTable().destroy();

              load_data_pending_temp_bill(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);

          }else if(select_mis=='LR Details For Warai Charges'){

            $("#PendingTempBillReport").removeClass('hidetable');
            $('#dailyLrAckReport').hide();
            $('#dailyLrReport').hide();
            $("#GrnInwordRtTbl").hide();
            $('#LrAckPendingReport').hide();
            $('#marketAdvanceReport').hide();
            $("#zeroFreightSaleReport").hide();
            $("#zeroFreightPurchaseReport").hide();
            $("#lrPendingSaleBillReport").hide();
            $("#lrPendingPurchaseBillReport").hide();
            $("#PendingTempBillReport").hide();
            $("#LrACKShortageReport").hide();
            $("#LRwaraiChargesReport").show();

            $('#dailyLrReport').DataTable().destroy();
            $('#GrnInwordRtTbl').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
            $("#lrPendingPurchaseBillReport").DataTable().destroy();
            $("#PendingTempBillReport").DataTable().destroy();
            $("#LRwaraiChargesReport").DataTable().destroy();
            $("#LrACKShortageReport").DataTable().destroy();

              load_data_lr_warai_charges(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);

          }else if(select_mis=='LR Acknowledgment Shortage'){

            $("#PendingTempBillReport").removeClass('hidetable');
            $('#dailyLrAckReport').hide();
            $('#dailyLrReport').hide();
            $("#GrnInwordRtTbl").hide();
            $('#LrAckPendingReport').hide();
            $('#marketAdvanceReport').hide();
            $("#zeroFreightSaleReport").hide();
            $("#zeroFreightPurchaseReport").hide();
            $("#lrPendingSaleBillReport").hide();
            $("#lrPendingPurchaseBillReport").hide();
            $("#PendingTempBillReport").hide();
            $("#LRwaraiChargesReport").hide();
            $("#LrACKShortageReport").show();

            $('#dailyLrReport').DataTable().destroy();
            $('#GrnInwordRtTbl').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
            $("#lrPendingPurchaseBillReport").DataTable().destroy();
            $("#PendingTempBillReport").DataTable().destroy();
            $("#LRwaraiChargesReport").DataTable().destroy();
            $("#LrACKShortageReport").DataTable().destroy();

              load_data_lr_shortage_report(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);

          }else{

                  
                  

             $('#dailyLrAckReport').hide();
             $('#dailyLrReport').hide();
             $("#marketAdvanceReport").hide();
             $('#LrAckPendingReport').hide();
             $("#zeroFreightSaleReport").hide();
             $("#zeroFreightPurchaseReport").hide();
             $("#lrPendingSaleBillReport").hide();
             $("#lrPendingPurchaseBillReport").hide();
             $("#PendingTempBillReport").hide();
             $("#LRwaraiChargesReport").hide();
             $("#LrACKShortageReport").hide();
             $("#GrnInwordRtTbl").show();

             $('#GrnInwordRtTbl').DataTable().destroy();
             $('#dailyLrReport').DataTable().destroy();
            $('#dailyLrAckReport').DataTable().destroy();
            $('#marketAdvanceReport').DataTable().destroy();
            $("#zeroFreightSaleReport").DataTable().destroy();
            $("#zeroFreightPurchaseReport").DataTable().destroy();
            $("#lrPendingSaleBillReport").DataTable().destroy();
            $("#PendingTempBillReport").DataTable().destroy();
            $("#LRwaraiChargesReport").DataTable().destroy();
            $("#LrACKShortageReport").DataTable().destroy();

              load_data_query(vrDateId,comp_code,plant_code,to_place,accountCode,AccountText,from_date,to_date,transpoter_code,cp_code,vehicleNo,select_mis,comp_name);
          }

           

        }else{

          $('#GrnInwordRtTbl').DataTable().destroy();

           load_data_query();

        }


        
    });

/* ..........END : Search Button Click ......... */


   
  

});


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

@endsection