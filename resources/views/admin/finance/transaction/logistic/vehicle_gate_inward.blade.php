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

  .showinmobile{
    display: none;
  }

  .secondSection{

    display: none;
  }

  .rightcontent{

  text-align:right;


}
.hidebtn{
display: none;
}

.tooltiphide{
display: none;
}

::placeholder {
  
  text-align:left;
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

    border-top: 1px solid #83e25c;
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

    width: 260%;

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

.btn-group-sm>.btn, .btn-sm {
          padding: 2px 4px;
          font-size: 12px;
          line-height: 1.5;
          border-radius: 3px;
      }

</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ $title }}
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
          <a href="{{ url('/finance/transaction/store/store-requistion') }}"> {{ $title }}</a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> {{ $title }}</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Transaction/Logistic/View-Vehicle-Gate-Inward') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Vehicle Gate Inward</a>

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
         <!--  <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active" id="firstTab">
                  <a href="#tab1info" id="basicInfo" data-toggle="tab">Basic Info</a>
                </li>
             
            </ul>
          </div> -->

        <form id="salesordertrans">
              @csrf

          <div class="panel-body">

            <div class="modalspinner hideloaderOnModl"></div>

              <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab1info">

                    <div class="row">

                      <!-- /.col -->
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Inward Slip Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                              <?php 

                              date_default_timezone_set('Asia/Kolkata');

                                $CurrentDate = date("d-m-Y H:i:s");
                                   
                              //  print_r($CurrentDate);

                              ?>
                            

                              <input type="text" class="form-control ArrDate" name="vr_date" id="vr_date" value="{{ $CurrentDate }}" placeholder="Select Date" autocomplete="off">

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

                              <input type="text" class="form-control" name="trans_code" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                              <input type="hidden" id="transtaxCode" >

                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('trans_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                        </div>
                            <!-- /.form-group -->
                      </div>
                        <!-- /.col -->
                      <div class="col-md-2">

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
                            <input list="seriesList1"  id="series_code" name="series_code" class="form-control  pull-left" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries()">

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

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Series Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>


                              <input type="text" class="form-control" name="series_name" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>
                      <!-- /.col -->

                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Vr No: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="hidden" name="" value="{{$to_num}}" id="vr_last_num">

                            <input type="text" class="form-control" name="vr_no" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vr_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                         </div>
                        <!-- /.form-group -->
                      </div>

                    </div>
                    <!-- /.row -->

                     <div class="row">

                      
                       <div class="col-md-2">
                              <div class="form-group">

                                <label>Vehicle Plan No : <span class="required-field"></span></label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                   <!--  <input list="vehiclePlanList" class="form-control" name="vehicle_plan_no" id="vehicle_plan_no" placeholder="Enter Vehicle Plan No" maxlength="15" autocomplete="off" onchange="getplanDetails()"> -->
                                    <input list="vehiclePlanList" class="form-control" name="vehicle_plan_no" id="vehicle_plan_no" placeholder="Enter Vehicle Plan No" autocomplete="off" onchange="getTruckDetails()" readonly="">

                                    <datalist id="vehiclePlanList">
                                      
                                      <?php foreach($planing_list as $key) { 

                                        $vrNo = $key->VRNO;
                              
                                        $SericeCode = $key->SERIES_CODE;
                                        
                                        $FyYr = $key->FY_CODE;

                                        $getYr = explode("-",$FyYr);

                                        $BgYr = $getYr[0];

                                        $newVrNo = $BgYr.' '.$SericeCode.' '.$vrNo;


                                        ?>

                                        <option value="<?= $newVrNo ?>~<?= $key->TRIPHID ?>" ><?= $key->VRDATE ?> - <?= $newVrNo ?> - <?= $key->VEHICLE_NO ?> - <?= $key->ACC_NAME ?>- <?= $key->TO_PLACE ?></option>
                                        

                                      <?php  } ?>

                                    </datalist>

                                </div>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('vehicle_plan_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>

                                <small id="vehicleplanno_err" style="color: red;"></small>


                              </div>
                          </div>
                        

                         <div class="col-md-2">
                              <div class="form-group">

                                <label>Vehicle No : <span class="required-field"></span></label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input list="vehicleList" class="form-control" name="vehicle_no" id="vehicle_no" placeholder="Enter Vehicle No"  autocomplete="off" onchange="getTruckDetails()" readonly="">

                                    <datalist id="vehicleList">
                                      
                                      <?php foreach($planing_list as $key) { ?>

                                        <option value="<?= $key->VEHICLE_NO ?>~<?= $key->TRIPHID ?>" ><?= $key->VRDATE ?> - <?= $key->VEHICLE_NO ?>~<?= $key->ACC_NAME ?>~<?= $key->TO_PLACE ?></option>
                                        

                                      <?php  } ?>

                                    </datalist>

                                </div>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>

                                <small id="vehicleno_err" style="color: red;"></small>


                              </div>
                          </div>

                     
                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Transporter Code : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                
                                <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>

                                <div class="" id="appndplantbtn" style="margin-bottom: -3px;"> 
                                </div>

                              </div>

                              <input list="accList" class="form-control" name="acc_code" value="" id="acc_code" placeholder="Enter Account Code" autocomplete="off" readonly="">

                              <datalist id="accList">

                                <?php foreach($acc_list as $key) { ?>

                                <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> <?= $key->ACC_NAME ?></option>

                              <?php } ?>

                              </datalist>

                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="accode_err" style="color: red;"></small>

                             <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                        </div>
                        
                      </div>

                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Transporter Name : </label>

                            <div class="input-group tooltips">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="acc_name" value="" id="acc_name" placeholder="Enter Account Name" autocomplete="off" readonly="">

                              <span class="tooltiptext tooltiphide" id="accountNameTooltip"></span>

                            </div>

                           

                        </div>
                        
                      </div>
                      
                        <div class="col-md-2">
                              <div class="form-group">

                                <label>From Place:<span class="required-field"></span></label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="from_place" id="from_place" placeholder="Enter From Place" autocomplete="off" readonly="">

                                  
                                </div>

                              </div>

                               <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('from_place', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                                 <small id="vehiclestatus_err" style="color: red;"></small>
                          </div>



                         <div class="col-md-2">
                              <div class="form-group">

                                <label>To Place:<span class="required-field"></span></label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="to_place" id="to_place" placeholder="Enter To Place" autocomplete="off" readonly="">

                                  
                                </div>

                              </div>

                               <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('to_place', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                                 <small id="vehiclestatus_err" style="color: red;"></small>
                          </div>
                      


                    </div> <!-- row -->


                    <div class="row">
            
                     

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                               <!--  <div class="" id="appndplantbtn">
                                    
                                </div> -->
                               </span>
                              <?php $plcount = count($plant_list); ?>
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>" readonly autocomplete="off" onchange="PlantCode()">

                              <datalist id="PlantcodeList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($plant_list as $key)

                                <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

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

                              <input type="text" class="form-control" name="plant_name" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME;}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>


                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Profit Center Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <input list="profitList"  id="profitctrId" name="pfct_code" class="form-control  pull-left" value="" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">


                            </div>

                          <small id="profit_center_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Profit Center Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="pfct_name" value="" id="pfct_name" placeholder="Enter Profit Center Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                      
                      
                    </div> <!-- row -->

                   

                     


                  <div class="row">

                    


                     <div class="col-md-2">

                        <div class="form-group">

                          <label>Confirm Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                              <?php 

                           

                                $CurrentDate = date("d-m-Y");
                                   
                              //  print_r($CurrentDate);

                              ?>
                            

                              <input type="text" class="form-control datepicker" name="confirm_date" id="confirm_date" value="{{ $CurrentDate }}" placeholder="Select Date" autocomplete="off">

                            </div>

                            <small id="showmsgfordate" style="color: red;"></small>

                            <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('confirm_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>
                        </div>
                            <!-- /.form-group -->
                      </div>

                         <div class="col-md-2">
                            <div class="form-group">

                              <label>Driver Name: <span class="required-field"></span> </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                            

                                <input type="text" class="form-control" name="driver_name" id="driver_name" value="" placeholder="Enter Driver Name" autocomplete="off" readonly="">

                              </div>

                             <small id="drivername_err" style="color: red;"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('driver_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>
                        <div class="col-md-2">
                            <div class="form-group">

                              <label>Driver Contact No: <span class="required-field"></span></label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              
                                <input type="text" class="form-control Number" name="driver_contact_no" id="driver_contact_no" value="" placeholder="Enter Contact Number" autocomplete="off" maxlength="10" readonly="">

                              </div>

                             <small id="driverno_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('driver_contact_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">

                              <label>Driver License No: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                              
                                <input type="text" class="form-control" name="driver_license_no" id="driver_license_no" value="" placeholder="Enter License No" autocomplete="off">

                              </div>

                             <small id="driverlic_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('driver_license_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>

                           <div class="col-md-2">
                            <div class="form-group">

                              <label>Date Of Birth: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                              
                                <input type="text" class="form-control partyrefdatepicker" name="date_birth" id="date_birth" value="" placeholder="Select Date Of Birth" autocomplete="off">

                              </div>

                             <small id="driverlic_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('driver_license_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>

                          
                          <div class="col-md-2">
                            <div class="form-group">

                              <label>Driver License Exp Dt: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                              
                                <input type="text" class="form-control transdatepicker" name="driver_license_ex_dt" id="driver_license_ex_dt" value="" placeholder="Enter License Dt" autocomplete="off">

                              </div>

                             <small id="driverlicdt_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('driver_license_ex_dt', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>
                    
                  </div>

                  <div class="row">

                     <div class="col-md-3">
                            <div class="form-group">

                              <label>Remark: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              
                                <input type="text" class="form-control" name="remark" id="remark" value="" placeholder="Enter remark" autocomplete="off">

                              </div>

                             <small id="remark_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('remark', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>

                     <div class="col-md-3">
                            <div class="form-group">

                              <label>Driver Address: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                              
                                <textarea type="text" class="form-control" name="driver_address" id="driver_address" value="" placeholder="Enter Driver Address" autocomplete="off" rows="1"></textarea>

                              </div>

                             <small id="driveradd_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('driver_address', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>
                          
                           <input type="hidden" class="form-control" name="triphid" id="triphid" value="" autocomplete="off">
                           
                    
                  </div>


                        <div class="row">
                          <div class="col-md-4"></div>
                        <div class="col-md-4" style="text-align: center;margin-top: 20px;">
                           <button type="button" class="btn btn-success btn-sm" onclick="return submitAllData()" disabled="" id="submidata">Submit</button>

                           <button type="button" class="btn btn-warning btn-sm" >Cancel</button>
                       </div>
                        <div class="col-md-4">
                        </div>
                      </div>
                      </div>
                  </div> <!-- /.tab first -->


                  
              </div>
          </div>

        </form>

        </div>
      </div>
    </div>
            

          

            

          </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->


</div>

<div id="vehiclemsgModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;width:16%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                <small id="vehicleageMsg"></small>

                 </div>
                <div class="modal-footer">
                  <center>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                  
                  </center>
                </div>
            </div>
        </div>
    </div>

  <div id="vehicleNotFoundModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;width:16%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                <small id="vehicleageNotFoundMsg"></small>

                 </div>
                <div class="modal-footer">
                  <center>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
                  
                  </center>
                </div>
            </div>
        </div>
    </div>

@include('admin.include.footer')




 <script type="text/javascript">
   
  function EmpCode(){

  var empcode =  $("#emp_code").val();

   if(empcode==''){
  
     $('#emp_code').css('border-color','#d2d6de');
     $('#acc_code').css('border-color','#d2d6de');
     $('#emp_code').css('border-color','#ff0000').focus();
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#emp_code').css('border-color','#d2d6de');
      $('#acc_code').css('border-color','#ff0000').focus();
     // $('#asset_code').css('border-color','#ff0000').focus();
     }

  var xyz = $('#emplList option').filter(function() {

    //console.log(this.value);

    return this.value == empcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
     $('#empName').html('');
     document.getElementById("empcode_err").innerHTML = 'The employee code field is required.';
     $('#emplyeeName').val('');
     //$("#ItemCodeId1").prop('readonly',true);
  }else{
    $('#empName').html(msg);
    $('#emplyeeName').val(empcode);
    document.getElementById("empcode_err").innerHTML = '';
/*    $('#due_days').prop('readonly',false);
*/    //$('#ItemCodeId1').prop('readonly',false);

  }
 //objvalidtn.checkBlankFieldValidation();

}

$("#vehicle_plan_no").on('change', function () {

  var vehicle_plan_no =  $(this).val();

  if(vehicle_plan_no==''){
  
     $('#vehicle_plan_no').css('border-color','#d2d6de');
     $('#driver_name').css('border-color','#d2d6de');
   
    
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#vehicle_plan_no').css('border-color','#d2d6de');
      $('#driver_name').css('border-color','#ff0000').focus();
     
     // $('#asset_code').css('border-color','#ff0000').focus();
     }



});

$("#vehicle_no").on('change', function () {

  var vehicle_no =  $(this).val();

  if(vehicle_no==''){
  
     $('#vehicle_no').css('border-color','#d2d6de');
    
     $('#driver_contact_no').css('border-color','#d2d6de');
     $('#vehicle_no').css('border-color','#ff0000').focus();
     $('#vehicle_plan_no').css('border-color','#ff0000');
    
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#vehicle_no').css('border-color','#d2d6de');
      $('#driver_contact_no').css('border-color','#ff0000').focus();
       $('#vehicle_plan_no').css('border-color','#d2d6de');
     
     // $('#asset_code').css('border-color','#ff0000').focus();
     }



});



$("#driver_name").on('input', function () {

  var driver_name =  $(this).val();

  if(driver_name==''){
  
     $('#driver_name').css('border-color','#d2d6de');
     $('#driver_contact_no').css('border-color','#d2d6de');
     $('#driver_name').css('border-color','#ff0000').focus();
   
    
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#driver_name').css('border-color','#d2d6de');
      $('#driver_contact_no').css('border-color','#ff0000');
      
      
     
     // $('#asset_code').css('border-color','#ff0000').focus();
     }



});

$("#driver_contact_no").on('input', function () {

  var driver_contact_no =  $(this).val();

  if(driver_contact_no==''){
  
     $('#driver_contact_no').css('border-color','#d2d6de');
     
     $('#driver_contact_no').css('border-color','#ff0000').focus();

       $('#submidata').prop('disabled',true);

     }else{
      $('#driver_contact_no').css('border-color','#d2d6de');
       $('#submidata').prop('disabled',false);
      
     }



});

$("#acc_code").on('change', function () {
  var Acccode =  $(this).val();

  if(Acccode==''){
  
     $('#acc_code').css('border-color','#d2d6de');
     $('#order_no').css('border-color','#d2d6de');
     $('#acc_code').css('border-color','#ff0000').focus();
    
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#acc_code').css('border-color','#d2d6de');
      $('#order_no').css('border-color','#ff0000').focus();
     
     // $('#asset_code').css('border-color','#ff0000').focus();
     }


  var xyz = $('#accList option').filter(function() {

    return this.value == Acccode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
      $("#acc_name").val(''); 
     document.getElementById("accode_err").innerHTML = 'The Account code field is required.';
     
      
  }else{
      
      $("#acc_name").val(msg);  
     document.getElementById("accode_err").innerHTML = '';
     
    
  }

  // objvalidtn.checkBlankFieldValidation();

});






 </script>

 <script type="text/javascript">
   function StatusChange(status){

    if(status=='Plan'){
      $("#estimate_time").prop('readonly',false);
    }else{
      $("#estimate_time").prop('readonly',true);
    }
}

/*$('.timepicker').datetimepicker({
  useCurrent: false,
  format: "hh:mm A"
})*/


 </script>

 <script type="text/javascript">
 $('.ArrDate').datetimepicker({

    format:'DD-MM-YYYY hh:mm:ss'
  });
</script>

<script type="text/javascript">

  
  $(document).ready(function() {

     $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

    });

     $("#date_birth").change(function(event){

        var date_birth =  $("#date_birth").val();
        var driving_ls_no =  $("#driver_license_no").val();

         var cuurnt_date = new Date().toLocaleDateString('fr-CA');

         var getDate  = cuurnt_date.split("-");

        var year =  getDate[0];
        var month =  getDate[1];
        var date =  getDate[2];

        var currentDate = year+"/"+month+"/"+date;

    

          $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

            $.ajax({

            url:"{{ url('get-driving-license-details') }}",

            method : "POST",

            type: "JSON",

            data: {date_birth: date_birth,driving_ls_no:driving_ls_no},

             /*beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },*/

            success:function(data){

              var data1 = JSON.parse(data);

              console.log(data1);
                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  console.log(data1.data);
                  //console.log('data1.data[0]',data1.data[0]);
                  if(data1.data == ''){
                      
                    }else{
                        

                        var dr_ls_dt = data1.data.response.dlNtValdToDt;

                        var getlsDate  = dr_ls_dt.split("/");

                        var lsyear =  getlsDate[2];
                        var lsmonth =  getlsDate[1];
                        var lsdate =  getlsDate[0];

                        var drlsDate = lsyear+"/"+lsmonth+"/"+lsdate;


                        if(drlsDate < currentDate){

                            $("#vehiclemsgModal").modal('show');

                            $("#vehicleageMsg").html('<b> Driving License Is Expired </b>');

                             $("#submidata").prop('disabled',true);        
                             
                          }else{
                            $("#submidata").prop('disabled',false);

                              $("#driver_license_ex_dt").val(drlsDate);
                          }

                   


                    }

                }

            },

           /* complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },*/

          });


        /*var cuurnt_date = new Date().toLocaleDateString('fr-CA');

        var getDate  = cuurnt_date.split("-");

        var year =  getDate[0];
        var month =  getDate[1];
        var date =  getDate[2];

        var currentDate = date+"-"+month+"-"+year;

        if(ls_expire_date < currentDate){

          $("#vehiclemsgModal").modal('show');

          $("#vehicleageMsg").html('<b> Driving License Is Expired </b>');

           $("#submidata").prop('disabled',true);        
           
        }else{
          $("#submidata").prop('disabled',false);
        }*/

      

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
       // console.log(Plant_code);
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
                	console.log(data1.data);
                  //console.log('data1.data[0]',data1.data[0]);
                  if(data1.data == ''){
                       var profitctr = '';
                       var pfctget = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfct_name').val(pfctName);
                       $('#getPfctCode').val(pfctget);
                       $('#getPfctName').val(pfctName);
                    }else{
                      $('#profitctrId').val(data1.data[0].PFCT_CODE);
                      $('#pfct_name').val(data1.data[0].PFCT_NAME);
                      $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                      $('#getPfctName').val(data1.data[0].PFCT_NAME);

                    }

                }

            }

          });

    });

    /*$('#due_days').on('input',function(){
      
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

        
       

       
    });*/

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
  
  function submitAllData(){


     var series_code       =  $("#series_code").val();
     var vehicle_plan_no   =  $("#vehicle_plan_no").val();
     var acc_code          =  $("#acc_code").val();
     var vehicle_no        =  $("#vehicle_no").val();
     var vehicle_status    =  $("#vehicle_status").val();
     var driver_name       =  $("#driver_name").val();
     var driver_contact_no =  $("#driver_contact_no").val();


     if(series_code==''){
      $("#series_code_errr").html('The series code field is required');
      return false;
     }else{
       $("#series_code_errr").html('');
     }

      if(vehicle_plan_no==''){
      $("#vehicleplanno_err").html('The vehicle plan code field is required');
      return false;
     }else{
       $("#vehicleplanno_err").html('');
     }

    
     if(vehicle_no==''){
     $("#vehicleno_err").html('The vehicle no field is required');
      return false;
     }else{
      $("#vehicleno_err").html('');
     }

     if(vehicle_status==''){
      $("#vehiclestatus_err").html('The vehicle status field is required');
      return false;
     }else{
      $("#vehiclestatus_err").html('');
     }

    if(driver_name==''){
      $("#drivername_err").html('The driver name field is required');
      return false;
     }else{
      $("#drivername_err").html('');
     } 


     if(driver_contact_no==''){
      $("#driverno_err").html('The driver contact no field is required');
      return false;
     }else if(driver_contact_no < 10){
      $("#driverno_err").html('');
      $("#driverno_err").html('The driver contact no field is 10 Digit required');
     }else{
      $("#driverno_err").html('');
     }


       $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

         var data = $("#salesordertrans").serialize();
        var submitdataurl = "<?php echo url('/Transaction/Logistic/Save-Vehicle-Gate-Inward'); ?>";


        $.ajax({

              type: 'POST',

              url: submitdataurl,

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                console.log(data);

                    var data1 = JSON.parse(data);

                   if (data1.response == 'success') {


                      var url = "{{ url('/Transaction/View-vehicle-Gate-Inward-msg') }}"
                      setTimeout(function(){ window.location = url+'/savedata';});

                    }


           
              },

          });

      
  }

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


      

       var series_code =  $("#series_code").val();

         if(series_code==''){
        
           $('#series_code').css('border-color','#d2d6de');
           
           $('#series_code').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else{
            $('#series_code').css('border-color','#d2d6de');
            $('#vehicle_plan_no').prop('readonly',false);
            $('#vehicle_no').prop('readonly',false);
            
           // $('#asset_code').css('border-color','#ff0000').focus();
           }

    });


  });

</script>





<script type="text/javascript">

  /*function close*/
  /*requisition.ItemCodeGet();

  requisition.checkBlankFieldValidation();*/


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
  



</script>





<script type="text/javascript">
  

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
                  //console.log('data1.data[0]',data1.data[0]);
                  $.each(data1.data, function(k, getData){

                    $("#emplList").empty();

                    $("#emplList").append($('<option>',{

                      value:getData.EMP_CODE,

                      'data-xyz':getData.EMP_NAME,
                      text:getData.EMP_NAME


                    }));

                  })

                }

            }

          });


  });

</script>

<script type="text/javascript">
  

   function getTruckDetails(){

      var vehicleNo = $("#vehicle_no").val();
      var vehicle_planno = $("#vehicle_plan_no").val();
      var gate_inward='true';

    // alert(vehicle_planno);return false;

      if(vehicleNo){

          var split_vehicle= vehicleNo.split('~');
          var truckNo = split_vehicle[0];
          var tripHid = split_vehicle[1];

      }else{

        var truckNo ='';
      }

      if(vehicle_planno){

          var split_vehicle= vehicle_planno.split('~');
          var vehicle_plan_no = split_vehicle[0];
          var tripHid = split_vehicle[1];

      }else{

        var vehicle_plan_no ='';
      }

      //alert(tripHid);
     
   
      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });

      if(truckNo){

      }else{

            $("#vehicle_type").val('');        
             $("#acc_code").val('');
             $("#acc_name").val('');
             $("#Plant_code").val('');
             $("#plantname").val('');
             $("#profitctrId").val('');
             $("#pfct_name").val('');
             $("#vehicle_no").val('');
             $("#from_place").val('');
             $("#to_place").val('');
             $("#vehicle_plan_no").val('');
      }

      $.ajax({

            url:"{{ url('get-vehicle-type') }}",

            method : "POST",

            type: "JSON",

            data: {truckNo:truckNo,vehicle_plan_no:vehicle_plan_no,gate_inward:gate_inward,tripHid:tripHid},

             /*beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },*/

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);
                    // $("#vehicle_type").val(data1.vehicle_type.WHEEL_TYPE); 

                      if(data1.driver_details=='' || data1.driver_details==null){

                        $("#driver_name").val('');
                        $("#driver_contact_no").val('');
                        $("#driver_license_no").val('');


                      }else{

                       
                        $("#driver_name").val(data1.driver_details[0].DRIVER_NAME);
                        $("#driver_contact_no").val(data1.driver_details[0].MOBILE_NUMBER);
                        $("#driver_license_no").val(data1.driver_details[0].DRIVER_ID);


                       var mobile_no =  data1.driver_details[0].MOBILE_NUMBER;

                       if(mobile_no=='' || mobile_no==null){

                         $("#submidata").prop('disabled',true);
                        
                       }else{

                          $("#submidata").prop('disabled',false);
                         

                       }

                      }


                    if(data1.data=='' || data1.data==null){

                      $("#driver_name").prop('readonly',true);
                     $("#driver_contact_no").prop('readonly',true);
                    }else{

                     $("#driver_name").prop('readonly',false);
                     $("#driver_contact_no").prop('readonly',false);
                     $("#acc_code").val(data1.data.TRANSPORT_CODE);
                     $("#acc_name").val(data1.data.TRANSPORT_NAME);
                     $("#Plant_code").val(data1.data.PLANT_CODE);
                     $("#plantname").val(data1.data.PLANT_NAME);
                     $("#profitctrId").val(data1.data.PFCT_CODE);
                     $("#pfct_name").val(data1.data.PFCT_NAME);
                     $("#vehicle_no").val(data1.data.VEHICLE_NO);
                     $("#from_place").val(data1.data.FROM_PLACE);
                     $("#to_place").val(data1.data.TO_PLACE);
                     $("#triphid").val(data1.data.TRIPHID);

                     var fy_code = data1.data.FY_CODE;

                     var explode = fy_code.split("-");

                     var fy_year = explode[0];

                     var series_code = data1.data.SERIES_CODE;
                     var vrno = data1.data.VRNO;


                     var plaNo =  fy_year+' '+series_code+' '+vrno;

                      $("#vehicle_plan_no").val(plaNo);

                    }

                         
                         

                         var cuurnt_date = new Date().toLocaleDateString('fr-CA');

                         if(data1.vehicle_info.response == '' || data1.vehicle_info.response == null){

                          $("#vehicleNotFoundModal").modal('show');
                          $("#vehicleageNotFoundMsg").html('<b style="text-align:center;"> Vehicle Not Found </b>');

                       

                        }else{

                        

                         var regd_date = data1.vehicle_info.response.regnDate;

                          var explode1 =   cuurnt_date.split("-");

                          var year1 = explode1[0];

                          var explode2 =   regd_date.split("/");

                          var year2 = explode2[2];

                          var diff_date = year1 - year2;


                          var getdate = cuurnt_date.split("-");
 
                          var year = getdate[0];
                          var month = getdate[1];
                          var date =  getdate[2];

                          var currentDate =  year+"/"+month+"/"+date;

                          
                        
                       
                         /* start  fit date expired */

                          var fit_date = data1.vehicle_info.response.fitUpto;

                          if(fit_date){

                             var getfitdate = fit_date.split("/");
                           var fit_date  = getfitdate[0];
                           var fit_month = getfitdate[1];
                           var fit_year  = getfitdate[2];

                           var fitDate =  fit_year+"/"+fit_month+"/"+fit_date;


                          }else{

                          
                          }

                         

                           /* end fit date expired */

                         
                          /* start tax date expired */

                          var tax_date = data1.vehicle_info.response.taxUpto;
                          var relaxtion_days=parseInt(20);

                          var explodeDate =  tax_date.split('-');
                          var expDate= explodeDate[0];
                          var expMonth= explodeDate[1];
                          var expYear= explodeDate[2];
                          var mergeDate = expMonth+'-'+expDate+'-'+expYear;
                          var getduedate = new Date(mergeDate);

                          getduedate.setDate(getduedate.getDate() + relaxtion_days); 
                          var getdate = getduedate.getDate();
                          var getMonth=getduedate.getMonth()+1;
                          var getYear = getduedate.getFullYear();
                          var duedate1 =getYear+'-'+getMonth+'-'+getdate;

                          var d = new Date(duedate1);
                          var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
                          var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

                          var relaxtion_date = getYear+'/'+mo+'/'+da;
                          
                          //alert(relaxtion_date);return false;

                          if(tax_date){

                            var gettaxdate = tax_date.split("-");
 
                           var tax_date  = gettaxdate[0];
                           var tax_month = gettaxdate[1];
                           var tax_year  = gettaxdate[2];

                           var taxDate =  tax_year+"/"+tax_month+"/"+tax_date;

                          }else{

                           

                          }
                          
                           

                          /* end tax date expired */


                        /* start insurance date expired */

                          var insurance_date = data1.vehicle_info.response.insuranceUpto;

                          if(insurance_date){

                             var getinsudate = insurance_date.split("/");
                           var insu_date  = getinsudate[0];
                           var insu_month = getinsudate[1];
                           var insu_year  = getinsudate[2];

                           var insuranceDate =  insu_year+"/"+insu_month+"/"+insu_date;
                          }else{


                          }

                           

                         /* end insurance date expired */


                            /* start permit  date expired */

                          var permit_date = data1.vehicle_info.response.permitValidUpto;

                          if(permit_date){

                            var getpermitdate = permit_date.split("/");

                           var permit_date  = getpermitdate[0];
                           var permit_month = getpermitdate[1];
                           var permit_year  = getpermitdate[2];

                           var permitDate =  permit_year+"/"+permit_month+"/"+permit_date;

                          }

                            

                           /* end  permit  date expired */

                           /* start puc  date expired */
                          var puc_date = data1.vehicle_info.response.puccUpto;

                          if(puc_date){

                             var getpucdate = puc_date.split("/");

                           var puc_date  = getpucdate[0];
                           var puc_month = getpucdate[1];
                           var puc_year  = getpucdate[2];

                           var pucDate =  puc_year+"/"+puc_month+"/"+puc_date;

                          }else{

                          }

                         
                           /* start puc  date expired */

                       if(diff_date > 10){

                          $("#vehiclemsgModal").modal('show');
                          $("#vehicleageMsg").html('<b> Vehicle Is More Than 10 Years Old</b>');

                           /*$("#vehicle_type").val('');        
                           $("#acc_code").val('');
                           $("#acc_name").val('');
                           $("#Plant_code").val('');
                           $("#plantname").val('');
                           $("#profitctrId").val('');
                           $("#pfct_name").val('');
                           $("#vehicle_no").val('');
                           $("#from_place").val('');
                           $("#to_place").val('');
                           $("#vehicle_plan_no").val('');
                            $("#driver_name").val('');
                            $("#driver_contact_no").val('');
                            $("#driver_license_no").val('');*/


                       }


                    if(fitDate < currentDate){

                       $("#vehiclemsgModal").modal('show');

                       $("#vehicleageMsg").html('<b> Vehicle Fitness Certificate Is Expired </b>');

                        /*$("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#driver_name").val('');
                         $("#driver_contact_no").val('');*/

                          $("#driver_name").prop('readonly',true);
                         $("#driver_contact_no").prop('readonly',true);

                      }else if(relaxtion_date < currentDate){

                        $("#vehiclemsgModal").modal('show');
                        $("#vehicleageMsg").html('<b> Vehicle Tax Certificate Is Expired</b>');

                         /*$("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#driver_name").val('');
                         $("#driver_contact_no").val('');*/

                      }else if(insuranceDate  < currentDate){

                        $("#vehiclemsgModal").modal('show');

                        $("#vehicleageMsg").html('<b> Vehicle Insurance Certificate Is Expired </b>');

                         /*$("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#driver_name").val('');
                         $("#driver_contact_no").val('');*/

                      }else if(pucDate < currentDate){

                        $("#vehiclemsgModal").modal('show');

                        $("#vehicleageMsg").html('<b> Vehicle Puc Certificate Is Expired </b>');

                         /*$("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#driver_name").val('');
                         $("#driver_contact_no").val('');*/

                      }else if(permitDate < currentDate){

                        $("#vehiclemsgModal").modal('show');

                        $("#vehicleageMsg").html('<b> Vehicle Permit Certificate Is Expired </b>');

                        /* $("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                        $("#driver_name").val('');
                         $("#driver_contact_no").val('');*/
                      }
                   
                   
                     
                }
              }

            },

            /*complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },*/

          });


  }

</script>

  
  <script type="text/javascript">
  

   function getplanDetails(){


      //var vehicle_no = $("#vehicle_no").val();

      var planNo     = $("#vehicle_plan_no").val();

      var plan_no    = planNo.split(" ");
      
      var palnno     = plan_no[2];

    

      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });


      if(planNo){


      $.ajax({

            url:"{{ url('/get-vehicle-plan-details') }}",

            method : "POST",

            type: "JSON",

            data: {planNo: planNo},

            /*beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },*/

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");


                }else if(data1.response == 'success'){


                  if(data1.data==''){
                     $("#acc_code").val('');
                     $("#acc_name").val('');
                     $("#Plant_code").val('');
                     $("#plantname").val('');
                     $("#profitctrId").val('');
                     $("#pfct_name").val('');
                     $("#vehicle_no").val('');
                     $("#from_place").val('');
                     $("#to_place").val('');
                    

                  }else{

                    var driver_name = data1.driver_data.DRIVER_NAME;
                    var driver_no = data1.driver_data.DRIVER_CONTACT_NO;

                     $("#acc_code").val(data1.data.TRANSPORT_CODE);
                     $("#acc_name").val(data1.data.TRANSPORT_NAME);
                     $("#Plant_code").val(data1.data.PLANT_CODE);
                     $("#plantname").val(data1.data.PLANT_NAME);
                     $("#profitctrId").val(data1.data.PFCT_CODE);
                     $("#pfct_name").val(data1.data.PFCT_NAME);
                     $("#vehicle_no").val(data1.data.VEHICLE_NO);
                     $("#from_place").val(data1.data.FROM_PLACE);
                     $("#to_place").val(data1.data.TO_PLACE);

                     if(driver_name){

                      $("#driver_name").val(data1.driver_data.DRIVER_NAME);
                      $('#driver_name').css('border-color','#d2d6de');

                     }

                     if(driver_no){

                      $("#driver_contact_no").val(driver_no);
                      $('#driver_contact_no').css('border-color','#d2d6de');

                      $("#submidata").prop('disabled',false);

                     }



                         var cuurnt_date = new Date().toLocaleDateString('fr-CA');

                        if(data1.vehicle_info.response == null){

                          $("#vehicleNotFoundModal").modal('show');
                          $("#vehicleageNotFoundMsg").html('<b style="text-align:center;"> Vehicle Not Found </b>');

                        

                        }

                        
                          console.log(data1.vehicle_info.response);

                          var regd_date = data1.vehicle_info.response.regnDate;

                          var explode1 =   cuurnt_date.split("-");

                          var year1 = explode1[0];

                          var explode2 =   regd_date.split("/");

                          var year2 = explode2[2];

                          var diff_date = year1 - year2;


                          var getdate = cuurnt_date.split("-");
 
                          var year = getdate[0];
                          var month = getdate[1];
                          var date =  getdate[2];

                          var currentDate =  year+"/"+month+"/"+date;

                          
                        
                       
                         /* start  fit date expired */

                          var fit_date = data1.vehicle_info.response.fitUpto;

                          if(fit_date){

                          var getfitdate = fit_date.split("/");
                           var fit_date  = getfitdate[0];
                           var fit_month = getfitdate[1];
                           var fit_year  = getfitdate[2];
                           var fitDate =  fit_year+"/"+fit_month+"/"+fit_date;

                          }else{

                          }

                          

                           /* end fit date expired */

                         
                          /* start tax date expired */

                          var tax_date = data1.vehicle_info.response.taxUpto;

                          if(tax_date){

                           var gettaxdate = tax_date.split("-");

                           var tax_date  = gettaxdate[0];
                           var tax_month = gettaxdate[1];
                           var tax_year  = gettaxdate[2];
                           var taxDate =  tax_year+"/"+tax_month+"/"+tax_date;

                          }else{

                          }

                           

                          /* end tax date expired */


                        /* start insurance date expired */

                          var insurance_date = data1.vehicle_info.response.insuranceUpto;


                          if(insurance_date){

                               var getinsudate = insurance_date.split("/");
                               var insu_date  = getinsudate[0];
                               var insu_month = getinsudate[1];
                               var insu_year  = getinsudate[2];
                               var insuranceDate =  insu_year+"/"+insu_month+"/"+insu_date;

                          }else{


                          }

                         

                         /* end insurance date expired */


                            /* start permit  date expired */

                          var permit_date = data1.vehicle_info.response.permitValidUpto;

                          if(permit_date){

                            var getpermitdate = permit_date.split("/");

                           var permit_date  = getpermitdate[0];
                           var permit_month = getpermitdate[1];
                           var permit_year  = getpermitdate[2];

                           var permitDate =  permit_year+"/"+permit_month+"/"+permit_date;
                          }else{

                          }

                            

                           /* end  permit  date expired */

                           /* start puc  date expired */

                        
                          var puccUpto = data1.vehicle_info.response.puccUpto;

                          if(puccUpto){

                            var puc_date = data1.vehicle_info.response.puccUpto;

                           var getpucdate = puc_date.split("/");

                           var puc_date  = getpucdate[0];
                           var puc_month = getpucdate[1];
                           var puc_year  = getpucdate[2];

                           var pucDate =  puc_year+"/"+puc_month+"/"+puc_date;

                          }else{


                          }

                          
                           /* start puc  date expired */

                           if(diff_date > 10){

                              $("#vehiclemsgModal").modal('show');
                              $("#vehicleageMsg").html('<b> Vehicle Is More Than 10 Years Old</b>');

                               $("#vehicle_type").val('');        
                               $("#acc_code").val('');
                               $("#acc_name").val('');
                               $("#Plant_code").val('');
                               $("#plantname").val('');
                               $("#profitctrId").val('');
                               $("#pfct_name").val('');
                               $("#vehicle_no").val('');
                               $("#from_place").val('');
                               $("#to_place").val('');
                               $("#vehicle_plan_no").val('');
                                $("#vehicle_plan_no").val('');


                           }


                    if(fitDate < currentDate){

                       $("#vehiclemsgModal").modal('show');

                       $("#vehicleageMsg").html('<b> Vehicle Fitness Certificate Is Expired </b>');

                        $("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#vehicle_plan_no").val('');

                      }else if(taxDate < currentDate){

                        $("#vehiclemsgModal").modal('show');
                        $("#vehicleageMsg").html('<b> Vehicle Tax Certificate Is Expired</b>');

                         $("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#vehicle_plan_no").val('');

                      }else if(insuranceDate  < currentDate){

                        $("#vehiclemsgModal").modal('show');

                        $("#vehicleageMsg").html('<b> Vehicle Insurance Certificate Is Expired </b>');

                         $("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#vehicle_plan_no").val('');

                      }else if(pucDate < currentDate){

                        $("#vehiclemsgModal").modal('show');

                        $("#vehicleageMsg").html('<b> Vehicle Puc Certificate Is Expired </b>');

                         $("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#vehicle_plan_no").val('');

                      }else if(permitDate < currentDate){

                        $("#vehiclemsgModal").modal('show');

                        $("#vehicleageMsg").html('<b> Vehicle Permit Certificate Is Expired </b>');

                         $("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#vehicle_plan_no").val('');
                      }
                   
                  }
                }

            },
            /*complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },*/

          });

    }else{

        $("#acc_code").val('');
        $("#acc_name").val('');
        $("#Plant_code").val('');
        $("#plantname").val('');
        $("#profitctrId").val('');
        $("#pfct_name").val('');
        $("#vehicle_no").val('');
        $("#from_place").val('');
        $("#to_place").val('');
        $("#confirm_date").val('');
    }


  }

</script>


<script type="text/javascript">
   $("#series_code").bind('change', function () {
  var Seriescode =  $(this).val();
  //console.log(Seriescode);
  var xyz = $('#seriesList1 option').filter(function() {

    return this.value == Seriescode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

    $('#appndbtn').empty();
    $('#serisicon').show();
  
  if(msg=='No Match'){
     $(this).val('');
     $('#seriesName').val('');
      document.getElementById("series_code_errr").innerHTML = 'The Series code field is required.';
    
     $('#getSeriesCode').val('');
     $('#serisicon').show();
     $('#series_code').css('border-color','#d2d6de');   
     $('#series_code').css('border-color','#ff0000').focus();
     $('#vehicle_plan_no').css('border-color','#d2d6de');
     $('#vehicle_plan_no').prop('readonly',true);
     $('#vehicle_no').prop('readonly',true);

  }else{
    $('#seriesName').val(msg);
     document.getElementById("series_code_errr").innerHTML = '';
     var sers_code = $('#series_code').val();
     $('#getSeriesCode').val(sers_code);
     $('#getSeriesName').val(msg);
     $('#serisicon').hide();
     $('#series_code').css('border-color','#d2d6de');
     $('#vehicle_plan_no').css('border-color','#ff0000').focus();
     $('#vehicle_plan_no').prop('readonly',false);
     $('#vehicle_no').prop('readonly',false);
        
  


  }

   //objvalidtn.checkBlankFieldValidation();

});
</script>




<script type="text/javascript">
	$( window ).on( "load", function() {

    getvrnoBySeries();

    var fromdateintrans = $('#FromDateFy').val();

    var todateintrans = $('#ToDateFy').val();

    var fromdateintrans_1 = $('#FromDateFy_1').val();
    var todateintrans_1 = $('#ToDateFy_1').val();

    $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });

    $('.partyrefdatepicker').datepicker({

      format: 'yyyy-mm-dd',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });

    var vr_date = $('#vr_date').val();
    var series_code = $('#series_code').val();
    var profitctrId = $('#profitctrId').val();
    var account_code = $('#account_code').val();
    var Plant_code = $('#Plant_code').val();
    var transcode = $('#transcode').val();
    var vrseqnum = $('#vrseqnum').val();
    var headid = $('#headid').val();

 //   alert(headid);

    if(headid){
      
      $('#head_id').val(headid);
    }

    if(transcode && vrseqnum){
        $('#getVrNo').val(vrseqnum);
        $('#getTransCode').val(transcode);
    }

    if(vr_date){
      $('#getTransDate').val(vr_date);
    }

    if(series_code){
        $('#getSeriesCode').val(series_code);
    }

    if(profitctrId){
        $('#getPfctCode').val(profitctrId);
    }

    if(account_code){
        $('#getAccCode').val(account_code);
    }

    if(Plant_code){
        $('#getPlantCode').val(Plant_code);
    }

    


});
</script>

<script type="text/javascript">
   $(document).ready(function() {
  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    orientation: 'bottom',
    todayHighlight: 'true',
    endDate:'today',
    autoclose: 'true'
  });
});

</script>

<script type="text/javascript">
	function Getqunatity(qtyId){

     var checkqty =$('#qty'+qtyId).val();
     var stockqty =$('#stockavlblevalue'+qtyId).val();
     console.log('qty',checkqty);

      if(parseFloat(checkqty) > parseFloat(stockqty)){
         console.log('error');

         $("#errmsgqty"+qtyId).html('req qty less than stock qty.').css('color','red');
         $('#qty'+qtyId).val('');
         $('#A_qty'+qtyId).val('');
          $("#submitdata").prop('disabled', true);
          $("#deletehidn").prop('disabled', true);

         
      }else{
        $("#errmsgqty"+qtyId).html('');
        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        
      }
     var gr_amt;
     if(checkqty){

         var quantity =$('#qty'+qtyId).val().replaceAll(',', '');
         var cfactor = $('#Cfactor'+qtyId).val();

         console.log('cftor',cfactor);
         var total = quantity * cfactor;
   
      if (quantity.length < 1){
        ('#qty'+qtyId).val('0.00');
        ('#A_qty'+qtyId).val('0.00');
      }else {
        var val = parseFloat(quantity);
        var formatted = inrFormat(quantity);

       /* if (formatted.indexOf('.') > 0) {
          var split = formatted.split('.');
          formatted = split[0] + '.' + split[1].substring(0, 2);
        }*/
        $('#qty'+qtyId).val(formatted);
      }

     
     $('#A_qty'+qtyId).val(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

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

     }else{
      $('#A_qty'+qtyId).val(0.00);

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