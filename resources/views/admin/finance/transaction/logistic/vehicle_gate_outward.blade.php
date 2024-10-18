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

                <a href="{{ url('/Transaction/Logistic/View-Vehicle-Gate-Outward') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Vehicle Gate Outward</a>

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

                          <label>Vehicle Out Date/Time: <span class="required-field"></span></label>

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

                                <label>Vehicle No : <span class="required-field"></span></label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input list="vehicleList" class="form-control" name="vehicle_no" id="vehicle_no" placeholder="Enter Vehicle No" maxlength="15" autocomplete="off" onchange="getTruckDetailsOutward()">

                                    <datalist id="vehicleList">
                                      
                                      <?php foreach($planing_list as $key) { ?>

                                        <option value="<?= $key->VEHICLE_NO ?>~<?= $key->TRIPHID ?>" ><?= $key->VRDATE ?> -<?= $key->TRIP_NO ?> - <?= $key->VEHICLE_NO ?> - <?= $key->ACC_NAME ?> - <?= $key->TO_PLACE ?> <?= $key->VRNO ?></option>
                                        

                                      <?php  } ?>

                                    </datalist>

                                    <input type="hidden" name="tripNo" id="tripNo" value="">
                                    <input type="hidden" name="seriesCode" id="seriesCode" value="">
                                    <input type="hidden" name="vrNo" id="vrNo" value="">
                                    <input type="hidden" name="tripHid" id="tripHid" value="">




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

                                <label>Destination:<span class="required-field"></span></label>

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
                      

                    </div>
                    <!-- /.row -->

                    <!-- row -->


                     


                  <div class="row">

                    
                    <div class="col-md-2">

                        <div class="form-group">

                          <label>Consinee Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                               <!--  <div class="" id="appndplantbtn">
                                    
                                </div> -->
                               </span>
                              <input type="text" class="form-control" id="consinee_code" name="consinee_code" placeholder="Select Consinee" maxlength="11" value="" autocomplete="off">

                             

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

                          <label> Consinee Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="consinee_name" value="" id="consinee_name" placeholder="Enter Consinee Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                         <div class="col-md-2">
                            <div class="form-group">

                              <label>Driver Name: <span class="required-field"></span> </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                            

                                <input type="text" class="form-control" name="driver_name" id="driver_name" value="" placeholder="Enter Driver Name" autocomplete="off">

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

                              
                                <input type="text" class="form-control Number" name="driver_contact_no" id="driver_contact_no" value="" placeholder="Enter Contact Number" autocomplete="off" maxlength="10">

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


                        <div class="col-md-3">
                            <div class="form-group" style="margin-top: 9px;">

                              <label>Verified All Documents: </label>&nbsp;&nbsp;&nbsp;&nbsp;

                              
                                <input type="checkbox"  name="verify_doc" id="verify_doc" value="checkd" onclick="verify_check()" autocomplete="off" disabled=""></input>


                             <small id="driveradd_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('driver_address', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>
                          
                          
                    
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



$("#vehicle_no").on('change', function () {

  var vehicle_no =  $(this).val();

  if(vehicle_no==''){
  
     $('#vehicle_no').css('border-color','#d2d6de');
    
    // $('#driver_name').css('border-color','#d2d6de');
     $('#vehicle_no').css('border-color','#ff0000').focus();
     $("#acc_code").val('');
     $("#acc_name").val('');
     $("#vehicle_no").val('');
     $("#to_place").val('');
     $("#consinee_code").val('');
     $("#consinee_name").val('');
     $("#driver_name").val('');
     $("#driver_contact_no").val('');
     $("#driver_license_no").val('');
     $("#date_birth").val('');
     $("#driver_license_ex_dt").val('');
     $("#driver_address").val('');
     $("#seriesCode").val('');
     $("#tripNo").val('');
     $("#verify_doc").prop('disabled',true);
     
     }else{
      $('#vehicle_no').css('border-color','#d2d6de');
      $("#verify_doc").prop('disabled',false);
    
     }



});





$("#driver_contact_no").on('input', function () {

  var driver_contact_no =  $(this).val();

  if(driver_contact_no==''){
  
     $('#driver_contact_no').css('border-color','#d2d6de');
     
     $('#driver_contact_no').css('border-color','#ff0000').focus();

      // $('#submidata').prop('disabled',true);

     }else{
      $('#driver_contact_no').css('border-color','#d2d6de');
      // $('#submidata').prop('disabled',false);
      
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


        var vehicle_no =  $("#vehicle_no").val();

        if(vehicle_no==''){
        
           $('#vehicle_no').css('border-color','#d2d6de');
          
          // $('#driver_name').css('border-color','#d2d6de');
           $('#vehicle_no').css('border-color','#ff0000').focus();

         }else{

             $('#vehicle_no').css('border-color','#d2d6de');
         }



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


     
     var vehicle_no        =  $("#vehicle_no").val();
     var driver_name       =  $("#driver_name").val();
     var driver_contact_no =  $("#driver_contact_no").val();


    
     if(vehicle_no==''){
     $("#vehicleno_err").html('The vehicle no field is required');
      return false;
     }else{
      $("#vehicleno_err").html('');
     }


     if(driver_contact_no==''){
      $("#driverno_err").html('The driver contact no field is required');
      return false;
     }else{
      $("#driverno_err").html('');
     }


       $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

         var data = $("#salesordertrans").serialize();
        var submitdataurl = "<?php echo url('/Transaction/Logistic/Save-Vehicle-Gate-Outward'); ?>";


        $.ajax({

              type: 'POST',

              url: submitdataurl,

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                console.log(data);

                    var data1 = JSON.parse(data);

                   if (data1.response == 'success') {


                      var url = "{{ url('/Transaction/Logistic/View-Vehicle-Gate-Outward') }}"
                      setTimeout(function(){ window.location = url});

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
  
  function verify_check(){

   var check_value =   $("#verify_doc").val();

    if($("#verify_doc").is(':checked')){

     $("#submidata").prop('disabled',false);

   }else{

     $("#submidata").prop('disabled',true);

   }  

  }

</script>
<script type="text/javascript">
  $(document).ready(function(){

  $("#verify_doc input:checkbox").on('change',function()
 {

   alert($(this).val());


   if(!$(this).is(':checked')){

      alert('uncheckd ' + $(this).val());
   }
 }); 

}); 

</script>


<script type="text/javascript">
  
    function getTruckDetailsOutward(){

      var truckNo = $("#vehicle_no").val();

     
      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });

      $.ajax({

            url:"{{ url('get-vehicle-info-for-outward') }}",

            method : "POST",

            type: "JSON",

            data: {truckNo: truckNo},

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

                      if(data1.data=='' || data1.data==null){

                         
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#vehicle_no").val('');
                         $("#to_place").val('');
                         $("#consinee_code").val('');
                         $("#consinee_name").val('');
                         $("#driver_name").val('');
                         $("#driver_contact_no").val('');
                         $("#driver_license_no").val('');
                         $("#date_birth").val('');
                         $("#driver_license_ex_dt").val('');
                         $("#driver_address").val('');
                         $("#seriesCode").val('');
                         $("#tripNo").val('');
                         $("#tripHid").val('');
                       

                      }else{

                        
                         $("#acc_code").val(data1.data[0].TRANSPORT_CODE);
                         $("#acc_name").val(data1.data[0].TRANSPORT_NAME);
                         $("#vehicle_no").val(data1.data[0].VEHICLE_NO);
                         $("#to_place").val(data1.data[0].TO_PLACE);
                         $("#consinee_code").val(data1.data[0].ACC_CODE);
                         $("#consinee_name").val(data1.data[0].ACC_NAME);
                         $("#driver_name").val(data1.data[0].DRIVER_NAME);
                         $("#driver_contact_no").val(data1.data[0].DRIVER_MOBILE);
                         $("#driver_license_no").val(data1.data[0].LICENCE_NO);
                         //$("#date_birth").val(data1.data[0].DOB);
                         //$("#driver_license_ex_dt").val(data1.data[0].DRIVER_LS_EX_DT);
                         $("#driver_address").val(data1.data[0].DRIVER_ADD);
                         $("#seriesCode").val(data1.data[0].SERIES_CODE);
                         $("#vrNo").val(data1.data[0].VRNO);
                         $("#tripNo").val(data1.data[0].TRIP_NO);
                         $("#tripHid").val(data1.data[0].TRIPHID);


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

  }else{
    $('#seriesName').val(msg);
     document.getElementById("series_code_errr").innerHTML = '';
     var sers_code = $('#series_code').val();
     $('#getSeriesCode').val(sers_code);
     $('#getSeriesName').val(msg);
     $('#serisicon').hide();
     $('#series_code').css('border-color','#d2d6de');
     $('#vehicle_plan_no').css('border-color','#ff0000').focus();
        
  


  }

   //objvalidtn.checkBlankFieldValidation();

});
</script>




<script type="text/javascript">
	$( window ).on( "load", function() {

    
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




@endsection