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

  .tolrancehide{
    display: none !important;
  }
  #empInfo{
    text-align: left;
    padding: 5px;
    font-size: 15px;
    font-weight: bold;
  }

  #empInfo1{
    text-align: center;
    padding: 5px;
    font-size: 15px;
    font-weight: bold;
    background-color:  hsl(0deg 100% 50% / 23%);
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

  /*table {
     border-collapse: collapse;
  }

  .table-responsive {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;

  }*/

 /* .table {
      width: 100%;
      margin-bottom: 1rem;
      color: #212529;

  }

  .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #dee2e6;

  }*/

 /* .table thead th {
      padding: 10px !important;
    padding-bottom: 0px !important;
    line-height: 1.8;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;

  }*/
 /* .table tbody tr td {
    padding: 15px !important;
    padding-bottom: 0px !important;
    line-height: 1.8;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
}*/

  .container{
      max-width: 1200px
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

      padding: 10px;
      padding-bottom: 0px !important;
      line-height: 1.8;
      vertical-align: top;
      border-top: 1px solid #ddd;
      text-align: center;

  }

  .rightcontent{
    text-align:right;
  }

  ::placeholder {
    text-align:left;
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

  .tdsInputBox{
    margin-bottom: 2%;
  }

  .modltitletext{
    font-weight: 800;
    color: #5696bb;
    font-size: 16px;
    text-align: center;
  }

  .textSizeTdsModl{
    font-size: 13px;
  }

  .companyName{
    font-weight: bold ;
    vertical-align: top;
    border: 1px solid #ddd;
    padding: 30px;
    text-align: center;
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

  .settaxcodemodel{
    font-size: 16px;
    font-weight: 800;
    color: #5d9abd;

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

  .boxSalary {
   z-index: 0;
   width: 390%;border:
    1px solid #ddd;
    padding-left: 5px;
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
    text-align: center;
    width: 20%;
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
  .aplynotStatus{
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
  .AddMList{
  width: 40px;
  }
  .taxcodeset{
  margin-right: 11px !important;
}



.tblBorder tr{
  border: 1px solid #a5a2a2;
}

.tblBorder td{
  border: 1px solid #a5a2a2;
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

<!-- section open -->
  <section class="content-header">

   

      <h1>

       Emp Pay Transaction

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

          <a href="{{ url('/finance/form-transaction-mast') }}">  Emp Pay Transaction</a>

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

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Emp Pay Transaction</h2>

            <div class="box-tools pull-right">

                <a href="{{url('/Transaction/EmployeePay/view-pay-trans')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Emp Pay Trans</a>

            </div>

          </div><!-- /.box-header -->

          <div id="empPayTranSuccessMsg">
                
          </div>

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
                    </ul>

                  </div>

                  <div class="panel-body">

                    <div class="tab-content">

                      <div class="tab-pane fade in active" id="tab1info">
                      
                       <form>

                         @csrf
                        <div class="row">

                          <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>Date: <span class="required-field"></span></label>

                              <div class="input-group">
                                <?php $CurrentDate =date("d-m-Y"); ?>
                                <?php 

                                $CurrentDate =date("d-m-Y");
                                   
                                $FromDate    = date("d-m-Y", strtotime($fyData->FY_FROM_DATE));  
                                   
                                $ToDate      = date("d-m-Y", strtotime($fyData->FY_TO_DATE));  
                                   
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

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="text" class="form-control  fydatepicker rightcontent" name="vr_date" id="vr_date"value="{{$vrDate}}" onchange="todayDate()">

                               
                              </div>

                              <small id="vr_dateErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                          </div>
                           
                          <div class="col-md-4">

                            <div class="form-group">
                              
                              <label>Company Code: <span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                                <input type="text" class="form-control" name="comp_code" id="comp_code"value="{{$CompanyCode}}" disabled>
                                
                               </div>
                              <small id="vr_dateErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>Fy Year: <span class="required-field"></span></label>

                              <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                                <input type="text" class="form-control   rightcontent" name="fy_year" id="fy_year"value="{{$fyData->FY_CODE}}" disabled>

                               
                              </div>
                              <small id="vr_dateErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label> T Code : </label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                  
                                  <input type="text" class="form-control" name="tranCode" value="{{$transData->TRAN_CODE}}" id="tranCode" placeholder="T Code" readonly >

                                </div>

                            </div>
                                <!-- /.form-group -->
                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label>Series Code: 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                <?php $series_code= count($seriesData);  ?>
                                <input list ="series_list" id="seriesCode" name="seriesCode" class="form-control  pull-left" value="<?php if($series_code == 1){echo $seriesData[0]->SERIES_CODE;}else{echo old('seriesCode');}?>" placeholder="Series Code" oninput="funSeriescode()" onchange="getvrnoBySeries()" readonly>

                                <datalist id="series_list">

                                  @foreach($seriesData as $rows)
                     
                                    <option value="{{ $rows->SERIES_CODE}}" data-xyz ="{{ $rows->SERIES_NAME }}">{{ $rows->SERIES_CODE}} = {{ $rows->SERIES_NAME}}</option>

                                  @endforeach

                                </datalist>
                              </div>

                           </div>
                             
                          </div>

                       </div>
                        
                        <div class="row"> 

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Series Name: 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                 
                                 @foreach($seriesData as $rows)

                                <input type="text"  id="seriesName" name="seriesName" class="form-control  pull-left" value="{{ $rows->SERIES_NAME }}" placeholder="Series Name" readonly >

                                @endforeach
                                 
                              </div>

                            </div>
                                <!-- /.form-group -->
                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label> Vr No: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                <input type="text" class="form-control rightcontent" name="vrno" value="" placeholder="Enter Vr No" id="vrno" readonly="">

                              </div>

                            </div>
                                <!-- /.form-group -->
                          </div>
                          
                          <div class="col-md-2">
                            <div class="form-group">

                              <label>Plant Code : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-calendar" aria-hidden="true"></i>

                                </div>
                                
                                 <input list="plantList" id="plant_list" name="plant_code" class="form-control  pull-left  FormTextFirstUpper" value="" placeholder="Enter Plant Code" autocomplete="off" oninput="funplantinput()">

                                 <datalist id='plantList'>
                                <?php foreach($plantData as $key) { ?>

                                <option value='<?= $key->PLANT_CODE ?>' data-xyz='<?= $key->PLANT_NAME?>'>{{ $key->PLANT_CODE}} = {{ $key->PLANT_NAME}}</option>

                                <?php } ?>
                              </datalist>


                              </div>

                              <small id="plantcodeErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>
                          </div>
                           

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Plant Name: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input  class="form-control" id="plantName" name="plant_name" placeholder="Plant Name" value="{{old('plant_name')}}" readonly>

                              </div>

                            </div>
                                <!-- /.form-group -->
                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label>Profit Center Code: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input list="profitList"  id="profitcen_code" name="profitcen_code" class="form-control  pull-left" value="{{old('profitcen_code')}}" placeholder="PFCT CODE" readonly>
                        
                              </div>

                            </div>
                            
                          </div>
                         
                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Profit Center Name: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input  id="profitcenter_name" name="profitcenter_name" class="form-control  pull-left" value="{{old('profitcenter_name')}}" placeholder="Profit Center Name" readonly>

                              </div>

                            </div>
                                <!-- /.form-roup -->
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">

                              <label>Month Year : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-calendar" aria-hidden="true"></i>

                                </div>
                                
                                <input type="text" id="month_yr" name="month_yr" class="form-control  pull-left transdatepicker" value="{{old('month_yr')}}" placeholder="Month Year"  autocomplete="off" onchange="funmonYr()">


                              </div>

                              <small id="month_yrErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('month_yr', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>
                          </div>
                        </div>
                         
                        <div class="modal fade" id="cal_basic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">

                                  <div class="modal-dialog" role="document" style="margin-top: 5%;width: 40%;">

                                    <div class="modal-content" style="border-radius: 5px;">

                                      <div class="modal-header">

                                        <div class="row">
                                          <div class="col-md-12 text-center">
                                            <h5 class="modal-title modltitletext" id="exampleModalLabel">Pay / Charges / etc Calculation</h5>
                                          </div>

                                          <div class="col-md-1"></div>

                                        </div><br>

                                        <div class="row">

                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <lable class=" col-md-6" style="font-weight: 700;padding: 0px;margin-top: 1%;">Grade Code &nbsp;&nbsp; - </lable>
                                                         
                                                <input type="text" class="col-md-6" id="grade_code" style="border: none; font-weight: 700;padding-left:8px;" readonly>

                                                <input type="hidden" name="empCode" id="empCode" value="">
                                            </div>
                                          </div>
                                          
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <lable class=" col-md-6" style="font-weight: 700;margin-top: 2%;">Month Year - </lable>
                                                         
                                                <input type="text" class="col-md-6" name="monYear" id="monYear" value="" style="border: none; font-weight: 700;padding: 0px;" readonly>

                                            </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                                <lable class=" col-md-3" style="font-weight: 700;padding: 0px;">Emp Name &nbsp;&nbsp;&nbsp; - </lable>
                                                         
                                                <input type="text" class="col-md-8" id="emp_name" style="border: none; font-weight: 700;padding: 0px;" readonly>

                                            </div>
                                          </div>
                                        </div>

                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group">
                                                <lable class=" col-md-6" style="font-weight: 700;padding: 0px;">Net Salary &nbsp;&nbsp;&nbsp;&nbsp; - </lable>
                                                         
                                                <input type="text" class="col-md-6" id="net_sal" style="border: none; font-weight: 700;padding: 0px;padding-left:8px;" readonly>

                                            </div>
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
                                          width: 25%; 
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

                                      <div class="modal-body table-responsive" style="height: 60vh;overflow-y: auto;">
                                          <div class="modalspinner hideloaderOnModl"></div>
                                          <div class="boxer" id="basic_rate">
                                              

                                          </div>
                                          <div class="boxer" id="basic_rate_body"></div>

                                      </div>

                                      <div class="modal-footer">

                                        <!-- <div class="row col-md-12" id="balanceRow1"></div> -->

                                        <center>
                                        <span  id="footer_modal_pay" style="width: 56px;"></span>
                                      <!--  <button class="btn btn-primary">cal</button> -->
                                      </center>
                                      
                                      </div>

                                    </div>

                                  </div>

                                </div>

                         <div class="row text-center">

                            <button type="button" class="btn btn-success" style="margin-top: 12px;" id="submitdata" onclick="funemplist();funcheckTable()"><i class="fa fa-save" aria-hidden="true" ></i> Proceed</button>
                             
                         </div>
                         <div id="getMsg" style="text-align:center;margin-top: 3%;"></div> 
                        </form>
                      </div>

                      
                   
                </div><!-- ./panel with-nav-tabs panel-info -->

              </div><!-- ./col -->

            </div><!-- ./row -->

            <div id="modalPayment"></div>
           
          

          <form action="" enctype="multipart/form-data" id="empPayForm">
          <div class="row">

             <div class="col-md-12">

             <input type="hidden" id="tbl_comp_code" value="">
             <input type="hidden" id="tbl_fy_year" value="">
             <input type="hidden" id="tbl_vr_date" value="">
             <input type="hidden" id="tbl_tranCode" value="">
             <input type="hidden" id="tbl_seriesCode" value="">
             <input type="hidden" id="tbl_seriesName" value="">
             <input type="hidden" id="tbl_vrno" value="">
             <input type="hidden" id="tbl_plant_list" value="">
             <input type="hidden" id="tbl_plantName" value="">
             <input type="hidden" id="tbl_profitcen_code" value="">
             <input type="hidden" id="tbl_profitcenter_name" value="">
             <input type="hidden" id="tbl_monthYR" value="">

             <div class="box box-primary Custom-Box " style="padding:20px">
             

             <table id="empPay" class="table table-bordered table-striped table-hover dataTable no-footer"  role="grid">

                    <thead style="padding: 10px !important;">

                      <tr>

                        <th class="text-center">Sr.No</th>

                        <th class="text-center">Emp Name</th>

                        <th class="text-center">Department</th>

                        <th class="text-center">Earning</th>

                        <th class="text-center">Deduction</th>

                        <th class="text-center">Total Salary</th>
                        
                        <th class="text-center">Salary Slip</th>
                       
                        
                      </tr>

                    </thead>

                    <tbody>

                    </tbody>

                  </table>
                
              </div>

          </div></div>

          

          <div class="row text-center">
            <input type="hidden" id="totalRow" name="totalRow" value="0">
             <input type="hidden" id="alltotalRow" name="alltotalRow" value="0">
            <button type="button" id="emplist" onclick="funSalaryData()" class="btn btn-success">Save & Download Excel</button>
          </div>
          </form>
          </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

   

  </section><!-- /.section -->


  

</div>



@include('admin.include.footer')


<script type="text/javascript">

  $( window ).on( "load", function() {

    getvrnoBySeries();

    $('.fydatepicker').datepicker({

      format: 'dd-mm-yyyy',

      todayHighlight: 'true',

      autoclose: 'true',

    });
  })

 $(document).ready(function(){

  $('.transdatepicker').datepicker({
      
       format: 'MM yyyy',
       viewMode: "months", 
       minViewMode: "months",
       autoclose:true
    
  });

  $("#plant_list").bind('change', function () {  

          var val = $(this).val();
          
          var xyz = $('#plantList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
          
          if(msg == 'No Match'){

              $(this).val('');

               $('#plantName').val('');

               $('#profitcen_code').val('');

               $('#profitcenter_name').val('');

          }else{

            $('#plantName').val(msg);

            var plant_code = val ;
           
            $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
            });

            $.ajax({

            type: 'POST',

            url: "{{ url('/Transaction/EmployeePay/transaction-pfct-code') }}",

            data: {plant_code:plant_code}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var obj = JSON.parse(data);

              if (obj.response == 'success') {

               $('#profitcen_code').val(obj.data.pfct_code);

               $('#profitcenter_name').val(obj.data.pfct_name);

              }
              else{

              }

            },

        });

      }
    });
});

function getvrnoBySeries(){

    var seriesCode = $('#seriesCode').val();
    var transcode  = $('#tranCode').val();

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('/get-vr-sequence-by-series') }}",

          method : "POST",

          type: "JSON",

          data: {seriesCode: seriesCode,transcode:transcode},

          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.vrno_series == '' || data1.vrno_series ==null){
                $('#vrno').val('');
              }else{
                if(data1.vrno_series){
                  var getlastno = data1.vrno_series.LAST_NO;
                }else{
                  var getlastno = '';
                }
                if(data1.vrnodata == ''){
                  $('#vrno').val(getlastno);
                }else{
                  var lastNo = parseInt(getlastno) + parseInt(1);
                  $('#vrno').val(lastNo);
                }
              }

            }

          }

    });

  }
  
function load_data(monthYR=''){
   
  var newDate = new Date(monthYR);
  
  var prev = new Date(newDate.getFullYear(), newDate.getMonth()-1);

  var getMon = prev.getMonth();

  var getYr = prev.getFullYear();

  var preMon = parseInt(getMon+1);
 

  var months = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];

  var getPrevMon = months[preMon-1];
    
  var previousMon = getPrevMon+' '+getYr;
  
  $(document).ready(function(){

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    var dtLength = $('#empPay').DataTable({
          
      processing: true,
      serverSide: true,
      scrollX: true,
     
      ajax:{
        url:'{{ url("/Transaction/EmployeePay/employee-list") }}',
        data: {monthYR:monthYR,previousMon:previousMon},
        method:"POST",
      },

      columns: [

        { 
          className:"text-center",
            render: function (data, type, full, row){
              var sr = full['DT_RowIndex'];
              
              var countRow = '<input type="hidden" id="countRow" value="'+sr+'">';
              return sr+''+countRow;
            }
        },
             
            { 
              render: function (data, type, full, meta){

               var empName = full['EMP_NAME'];
               var empInfoDOB = full['DOB'];
               var rowCount = full['DT_RowIndex'];
               var empmonCtc = full['CTC'];
               var empAdvAmt = full['Advance_amt'];
               var empAdvType = full['payment_type'];
               var empEmi_Amt = full['EMI_AMT'];
               var CR_AMT = full['CR_AMT'];
               var emp_acc_code = full['emp_acc_code'];
               var empAdvOrLoan = full['MONTH_YR'];

               var debit_amt;
               var dr_amt_type;
               var emi_amt;
               var alloction_amt;
               var advLoanMonth;
               var empAccCode;

               if(empAdvAmt == null && empAdvType == null && emi_amt == null && CR_AMT == null && empAdvOrLoan == null && emp_acc_code == null){

                 debit_amt = 0;
                 dr_amt_type = '';
                 emi_amt = 0;
                 alloction_amt = 0;
                 advLoanMonth = '';
                 empAccCode = '';

               }else{

                 debit_amt = empAdvAmt;
                 dr_amt_type = empAdvType;
                 emi_amt = empEmi_Amt;
                 alloction_amt = CR_AMT;
                 advLoanMonth = empAdvOrLoan;
                 empAccCode = emp_acc_code;
               }

               var empDetails = '<div><p id="empInfoName_'+rowCount+'" name="empInfoName[]">'+empName+'</p><input type="hidden" id="empInfoDOB" value="'+empInfoDOB+'"><input type="hidden" id="empmonCtc" value="'+empmonCtc+'"><input type="hidden" id="empAdvOrLoanM_'+rowCount+'" name="empAdvOrLoanM[]" value="'+advLoanMonth+'"><input type="hidden" id="empAcc_code_'+rowCount+'" name="empAccCode[]" value="'+empAccCode+'"><input type="hidden" id="empAdvType_'+rowCount+'" name="empAdvType[]" value="'+dr_amt_type+'"><input type="hidden" id="empAdvAmt_'+rowCount+'" value="'+debit_amt+'" name="empAdvAmt[]"><input type="hidden" id="empEmiAmt_'+rowCount+'" name="empEmiAmt[]" value="'+emi_amt+'"><input type="hidden" id="chkCrAmt_'+rowCount+'" name="chkCrAmt" value="'+alloction_amt+'"></div><input type="hidden" id="crAmt_'+rowCount+'" name="crAmt[]" value=""></div>';

               return empDetails;

              }
            },

            { 
               data:"DEPT_CODE",
               className:"text-center"
            },

            {
              render: function (data, type, full, row){

                var payid = full['pay_id'];
                var rowCount = full['DT_RowIndex'];
                var emp_ctc = full['CTC'];
                var monthDay = full['MONTH_DAYS'];
                var empname = full['EMP_NAME'];
                var department = full['DEPT_CODE'];
                var emp_code = full['EMP_CODE'];

                var oneday_sal = emp_ctc/monthDay;
                var absent_sal = oneday_sal*full['ABSENT_DAYS'];
                var total_sal  = emp_ctc - absent_sal;


                var ctc = total_sal.toFixed(2);

                var createDiv = '<div id="earning_div_'+rowCount+'"><p id="earnVal'+rowCount+'"></p><input type="hidden" id="totalEarnAmt_'+rowCount+'" name="totalEarnAmt[]" value="0"><input type="hidden" id="tlEarn_'+rowCount+'" name="tlEarn[]" value="0"><input type="hidden" id="empname_'+rowCount+'" name="empname[]" value="'+empname+'"><input type="hidden" id="department_'+rowCount+'" name="department[]" value="'+department+'"><input type="hidden" id="empcode_'+rowCount+'" name="empcode[]" value="'+emp_code+'"></div><div id="allIndicator_'+rowCount+'"></div><div id="calValue'+rowCount+'"></div><input type="hidden" id="totalCount_'+rowCount+'" name="totalCount[]" value="">';

               $.ajax({

                type: 'POST',

                url: "{{ url('/Transaction/EmpPayTrans/emp_pay_wage') }}",

                data: {payid:payid},

                success: function (data) {

                  var obj = JSON.parse(data);


                  if (obj.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                  }
                  else if(obj.response == 'success'){

                    if(obj.data ==''){

                    }
                    else{

                      $('#totalEarnAmt_'+rowCount).val('0');
                          // $('#totalDeducAmt_'+rowCount).val('0');

                      var totalEval = 0;

                      var totalDval = 0;

                      var countLen =  obj.data.length;

                      $.each(obj.data.payTax, function(k, getData){

                          ptaxCalculation(getData);

                      })
                          
                      var srnos = 0;

                      var ctcData = obj.data.ctcdata;
                          
                      $.each(obj.data.ctcdata, function(k, getData){

                      var emppayId = getData.EMP_PAYID;
                            
                        if(payid == emppayId){

                          var EDVal = getData.WAGE_INDTYPE;

                          var EDFY =  getData.MONTH_OR_YR;
                            
                          if(EDVal == 'EARNING' && EDFY == 'Monthly'){
                            
                            var wageInd_code  = getData.WAGE_IND;

                            var indicator  = getData.WAGEIND_NAME;

                            var rate       = getData.RATE_IND;

                            var rate_code  = getData.RATE;

                            var logic      = getData.LOGIC;

                            var amt        = getData.AMOUNT;

                            var indC = getData.WAGE_INDTYPE.length;

                            salaryCalculation(wageInd_code,indicator, rate, rate_code, logic, ctc,srnos,rowCount,EDVal,amt,indC);
                          }

                          else if(EDVal == 'DEDUCTION'){

                            var wageInd_code  = getData.WAGE_IND;

                            var indicator  = getData.WAGE_IND;

                            var rate       = getData.RATE_IND;

                            var rate_code  = getData.RATE;

                            var logic      = getData.LOGIC;

                            var amt        = getData.AMOUNT;

                            salaryCalculation(wageInd_code,indicator, rate, rate_code, logic, ctc,srnos,rowCount,EDVal,amt);

                          }

                        }

                        srnos++; 

                      });

                    }

                  }

                }

              });

              return createDiv;

             }  
            },

            { 
              render: function (data, type, full, row){

                var rowCount = full['DT_RowIndex'];
                var payment_type = full['payment_type'];
                var Advance_amt = full['Advance_amt'];
                var EMI_AMT = full['EMI_AMT'];
                var deductAmt = 0;
                var cr_amount = full['CR_AMT'];
                var dr_amount = full['Advance_amt'];
                
                if(dr_amount == cr_amount){
                  
                 
                }

                else{

                  var loanMonth = full['MONTH_YR'];
                 
                  if(payment_type == 'Loan'){
                    
                    if(monthYR == loanMonth){
                      deductAmt = 0;
                    }
                    else{

                      var balAmt = parseFloat(dr_amount) - parseFloat(cr_amount);

                      if(balAmt < EMI_AMT){

                        deductAmt = balAmt;

                      }else{

                        deductAmt = EMI_AMT;
                      }
                       
                    }
                  }

                  if(payment_type == 'Advance'){

                    var balAmt = parseFloat(dr_amount)- parseFloat(cr_amount);

                    if(monthYR == loanMonth){
                     deductAmt = Advance_amt;
                    }else if(balAmt > 0){
                     deductAmt = balAmt;
                    }
                    else{
                      deductAmt = 0;
                    }
                    
                  }
                }
               

                var deductionDiv = '<div id="deduction_div_'+rowCount+'"><p id="deductionVal'+rowCount+'" ></p><input type="hidden" id="totalDeducAmt_'+rowCount+'" name="totalDeducAmt[]" value="'+deductAmt+'"></div>';

                return deductionDiv;

               }
            },
            
            {
                
              render: function (data, type, full, meta){

               var rowCount = full['DT_RowIndex'];

               var monthDay = full['MONTH_DAYS'];
               var absent_d = full['ABSENT_DAYS'];
               var holi_day = full['HOLIDAY'];
               var month_leave = full['LEAVE'];
               var work_day = parseFloat(monthDay) - parseFloat(absent_d);

               var total_sal = '<div id="totalSal_div_'+rowCount+'"><p id="totalSalVal_'+rowCount+'" name="totalSalVal[]"></p><input type="hidden" name="monDay[]" id="monDay_'+rowCount+'" value="'+monthDay+'"><input type="hidden" name="abDay[]" id="abDay_'+rowCount+'" value="'+absent_d+'"><input type="hidden" name="holiDay[]" id="holiDay_'+rowCount+'" value="'+holi_day+'"><input type="hidden" name="monthLeave[]" id="month_leave_'+rowCount+'" value="'+month_leave+'"><input type="hidden" name="workingDay[]" id="work_day_'+rowCount+'" value="'+work_day+'"><input type="hidden" name="tlSalAmt" id="tlSalAmt_'+rowCount+'" value=""></div>';

                 return total_sal;

                }
            },
           
            {  
            render: function (data, type, full, meta){
                    
              var rowCount = full['DT_RowIndex'];

              var flag ='emppayTrans';

              var monthDay = full['MONTH_DAYS'];

              var absent_sal = full['ABSENT_DAYS'];

              var enableBtn = 'enable';

              var srNo = 0;

              var deletebtn ='<input type="hidden" name="idictrCount[]" id="indicatorRow_'+rowCount+'" value=""><input type="hidden" name="rowIndicator_[]" id="rowIndicator_'+rowCount+'" value=""><button class="btn btn-primary btn-sm" type="button" id="calbasic" data-toggle="modal" data-target="#cal_basic" onclick="CalculateBasic(\''+full['GRADE_CODE']+'\',\''+full['EMP_CODE']+'\','+rowCount+');getTotal('+rowCount+')"><i class="fa fa-money"></i></button><div id="status_'+rowCount+'"><input type="hidden" id="statusVal_'+rowCount+'" value="0"><span class="label label-danger">Not Generated</span></div><input type="hidden" id="getWageCount" value=""><div id="pdfIncomeBox_'+rowCount+'"></div><div id="pdfDeducBox_'+rowCount+'"></div><div id="pdfAttenBox_'+rowCount+'"></div><div id="pdfFormSixteenBox_'+rowCount+'"><input type="hidden" name="tempCount" value="" id="tempCount"></div><input type="hidden" name="tlgrossSalary[]" value="" id="grossSalary_'+rowCount+'"><input type="hidden" name="tldeducAmount[]" value="" id="deducAmount_'+rowCount+'"><input type="hidden" name="tltaxableIn[]" value="0" id="tltaxableIn_'+rowCount+'"><input type="hidden" name="tltaxAmount[]" value="100" id="tltaxAmount_'+rowCount+'"><input type="hidden" name="tltaxpaidAmt[]" value="0" id="tltaxpaidAmt_'+rowCount+'"><input type="hidden" name="tltaxDueRefund[]" value="0" id="tltaxDueRefund_'+rowCount+'"><input type="hidden" name="tlMonth[]" value="0" id="tlMonths_'+rowCount+'">';

                      
                var fy_toDate ;

                var fy_fromDate;

                var ptaxAmt = 0;
                
                var date_join = full['DOB'];

                var empctc = full['CTC'];

                var fy_toDate = full['fy_to_date'];

                var fy_fromDate = full['fy_from_date'];
                
                if(date_join >= fy_fromDate && date_join <= fy_toDate){
                
                var diffdate = monthDiff(new Date(date_join), new Date(fy_toDate));

                var gross_sal = empctc * diffdate ;
                        
                         $('#grossSalary_'+rowCount).val(gross_sal);
                }

                else{

                  var diffdate = monthDiff(new Date(fy_fromDate), new Date(fy_toDate));

                  var gross_sal = empctc * diffdate ;
                  
                  $('#grossSalary_'+rowCount).val(gross_sal);

                }

                  var totalDeducAmt = 0;

                  var provAmt = 0;

                  var actualAmt = full['actual_amt'];
                  
                  var provAmt = full['provisional_amt'];
                      
                  if(actualAmt != null){

                  totalDeducAmt = parseInt(totalDeducAmt) + parseInt(actualAmt);

                  }else if(provAmt != null){
                       
                    totalDeducAmt = parseInt(totalDeducAmt) + parseInt(provAmt);

                  }else{}
                    
                  if(totalDeducAmt == ''){
                        
                        $('#deducAmount_'+rowCount).val('0.00');

                  }else{
                         $('#deducAmount_'+rowCount).val(totalDeducAmt);
                         
                  }

                  var gross_sal_amt =  $('#grossSalary_'+rowCount).val();

                  var deduction_amt =  $('#deducAmount_'+rowCount).val();

                  var taxableInAmt = parseFloat(gross_sal_amt) - parseFloat(deduction_amt);

                  $('#tltaxableIn_'+rowCount).val(taxableInAmt);

                  var taxableIn = taxableInAmt;
                  
                  var taxTotOne;
                  var taxTotTwo;
                  var totalTax;

                  var fivePer    = 250000/100*5;
                  var tenPer     = 250000/100*10;
                  var fifteenPer = 250000/100*15;
                  var twentyPer  = 250000/100*20;
                  var twentyFivePer = 250000/100*25;

                  if(taxableIn<250000){

                    taxTotOne= 0;

                    $('#tltaxAmount_'+rowCount).val(taxTotOne);
                    
                  }else if(taxableIn >= 250001 && taxableIn <= 500000){
                   
                    taxTotTwo = taxableIn - 250000 ;

                    var taxIn = taxTotTwo/100*5;

                    var totalTax = taxIn;

                    $('#tltaxAmount_'+rowCount).val(totalTax);

                  }else if(taxableIn >= 500001 && taxableIn <= 750000){
                  
                  
                  var taxTotThree = taxableIn - 500000;

                  var taxInTwo = taxTotThree/100*10;

                  var totalTaxTwo = fivePer + taxInTwo;

                  $('#tltaxAmount_'+rowCount).val(totalTaxTwo);
                  

                  }else if(taxableIn >= 750001 && taxableIn <= 1000000){
                    
                    var taxTotFour = taxableIn - 750000;

                    var taxInThree = taxTotFour/100*15;

                    var totalTaxThree = fivePer+tenPer+taxInThree;

                    $('#tltaxAmount_'+rowCount).val(totalTaxThree);
                    
                  
                  }else if(taxableIn >= 1000001 && taxableIn <= 1250000){
                  var taxTotFive  = taxableIn - 1000000;

                  var taxInFour   = taxTotFive/100*20;
                  
                  var totalTaxFour = fivePer+tenPer+fifteenPer+taxInFour;
                  $('#tltaxAmount_'+rowCount).val(totalTaxFour);
                  
                
                  }else if(taxableIn >= 1250001 && taxableIn <= 1500000){

                    var taxTotSix  = taxableIn - 1250000;

                    var taxInFive  = taxTotSix/100*25;

                    var totalTaxFive = fivePer+tenPer+fifteenPer+twentyPer+taxInFive;

                    $('#tltaxAmount_'+rowCount).val(totalTaxFive);
                    
                
                  }else{

                    var taxTotSeven = taxableIn - 1500000;

                    var taxInSix    = taxTotSeven/100*30;

                    var totalTaxSix = fivePer+tenPer+fifteenPer+twentyPer+twentyFivePer+taxInSix;

                    $('#tltaxAmount_'+rowCount).val(totalTaxSix);
                  
                  }

                  var mon_yr = $('#month_yr').val();

                  var currentDt = new Date(mon_yr);
                   
                  var lastDay = new Date(currentDt.getFullYear(), currentDt.getMonth()+1, 1);

                  var monthDt = lastDay.toISOString().slice(0, 10);

                  var spliteval = date_join.split('-');
                   
                  var year  = spliteval[0];

                  var month = spliteval[1];

                  var daymonth = getDaysInMonth(month,year);

                  var oneDay = 24 * 60 * 60 * 1000;

                  var firstDate = new Date(date_join);
                   
                  var lastDtJoin = new Date(firstDate.getFullYear(), firstDate.getMonth()+1);
                   
                  var secondDate = new Date(lastDtJoin);
                   
                  var diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));

                  if((date_join >= fy_fromDate && date_join <= fy_toDate) && (monthDt >= fy_fromDate && monthDt <= fy_toDate)){
                      
                    var taxPaidMon = monthDiff(new Date(date_join), new Date(monthDt));

                    var totalMon = monthDiff(new Date(date_join), new Date(fy_toDate));
                       
                    $('#tlMonths_'+rowCount).val(totalMon);
                       
                    var countMon = monthDiff(new Date(lastDtJoin), new Date(monthDt));
                    
                    if(countMon > 0){
                        countMon = parseFloat(countMon) - 1 ;
                    }
                       
                    var tAmt = $('#tltaxAmount_'+rowCount).val();
                   
                    var oneMonthTax = parseFloat(tAmt) / parseFloat(totalMon);
                  
                    var oneDayPaidTax = oneMonthTax.toFixed(2) / daymonth;
                   
                    var paidTax = oneDayPaidTax.toFixed(2) * diffDays;
                   
                    var taxPaidAmt = parseFloat(oneMonthTax) * parseFloat(countMon) + parseFloat(paidTax);

                    $('#tltaxpaidAmt_'+rowCount).val(taxPaidAmt.toFixed(2));
                    
                    
                  }

                  else{

                    if(monthDt >= fy_fromDate && monthDt <= fy_toDate){
                      
                      var taxPaidMon = monthDiff(new Date(fy_fromDate), new Date(monthDt)); 
                      
                      var tlTaxPaidMon = parseFloat(taxPaidMon) - 1;
                      
                      var totalMon = monthDiff(new Date(fy_fromDate), new Date(fy_toDate));

                      $('#tlMonths_'+rowCount).val(totalMon);
                      
                      var tAmt = $('#tltaxAmount_'+rowCount).val();
                      
                      var oneMonthTax = parseFloat(tAmt) / parseFloat(totalMon);
                      
                      var taxPaidAmt = parseFloat(oneMonthTax) * parseFloat(tlTaxPaidMon);
                      
                      $('#tltaxpaidAmt_'+rowCount).val(taxPaidAmt.toFixed(2));

                    }
                   
                  }

                  var tlTax = $('#tltaxAmount_'+rowCount).val();
                   
                  var tlPaidTax = $('#tltaxpaidAmt_'+rowCount).val();
                   
                  var tlnetTax = parseFloat(tlTax) - parseFloat(tlPaidTax);
                   
                  $('#tltaxDueRefund_'+rowCount).val(tlnetTax.toFixed(2));
                
              return deletebtn;
          }
        }
      ]
    });
    });          
     
    }

 

   function funSalaryData(){

    var all_emp_name=[];
    var totalEarn_Amt=[];
    var all_department = [];
    var all_totalDeducAmt = [];
    var all_totalSalVal = [];
    var all_empcode = [];
    var all_totalCount = [];
    var all_grossSal = [];
    var all_duduction = [];
    var all_taxableIn = [];
    var all_taxAmt = [];
    var all_taxpaid = [];
    var all_taxDueRefund = [];
    var all_totalWorkDays = [];
    var all_holiday = [];
    var all_leaves = [];
    var all_absent = [];
    var all_numWorkDay = [];
    var all_wage_code = [];
    var all_head_wage_ind = [];
    var all_amount = [];
    var all_wagetype = [];
    var all_IndValue = [];
    var all_rate = [];
    var all_logic = [];
    var all_idictrCount = [];
    var all_formCount = [];
    var all_empAdvAmt = [];
    var all_empAdvType = [];
    var all_empEmiAmt = [];
    var all_crAmt = [];
    var all_empAccCode = [];
    var all_empAdvOrLoanM= [];
   
    var lastRowIndex = $('#empPay tr').length -1;
   
    var getV = $('#indC').val(); 
    
    for(var j=1;j<=lastRowIndex;j++){

      for(var k=1;k<=getV;k++){
        
        var indCode = $('#ind_Code_'+k+'_'+j).val();
        var indName = $('#ind_Name_'+k+'_'+j).val();
        var indType = $('#ind_type_'+k+'_'+j).val();
        var indRate = $('#ind_rate_'+k+'_'+j).val();
        var indLogic = $('#ind_logic_'+k+'_'+j).val();
        var indAmt = $('#cal_Ind_'+k+'_'+j).val();
        
        all_wage_code.push(indCode);
        all_head_wage_ind.push(indName);
        all_wagetype.push(indType);
        all_rate.push(indRate);
        all_logic.push(indLogic);
        all_amount.push(indAmt);

      }
      
      var indCountRow = $('#tlRow_'+j).val();

      all_idictrCount.push(indCountRow);

      var formCount = $('#formCount'+j).val();

      all_formCount.push(formCount);

      var rwCount = $('#alltotalRow').val();
      
      var countRow = $('#tlRow_'+j).val();
     
      var fRow = parseInt(rwCount)+parseInt(countRow);

      $('#alltotalRow').val(fRow);

      $('#totalRow').val(fRow);
      
      
    }
    
    
    var comp_code = $('#tbl_comp_code').val();
    
    var fy_year = $('#tbl_fy_year').val();
    
    var vr_date = $('#tbl_vr_date').val();
    
    var tranCode = $('#tbl_tranCode').val();
    
    var seriesCode = $('#tbl_seriesCode').val();
    
    var seriesName = $('#tbl_seriesName').val();
    
    var vrno = $('#tbl_vrno').val();
    
    var plant_list = $('#tbl_plant_list').val();

    var plantName = $('#tbl_plantName').val();
    
    var profitcen_code = $('#tbl_profitcen_code').val();
    
    var profitcenter_name = $('#tbl_profitcenter_name').val();
    
    var monthYR = $('#tbl_monthYR').val();
   
    var totalRowc = $('#totalRow').val();
    
    $('input[name^="indAmt"]').each(function (){
                  
          all_amount.push($(this).val());

    });
   
    
    $('input[name^="indType"]').each(function (){
                  
          all_wagetype.push($(this).val());

    });
   

    $('input[name^="tlEarn"]').each(function (){
                  
          totalEarn_Amt.push($(this).val());

    });
    
    $('input[name^="empname"]').each(function (){
                  
          all_emp_name.push($(this).val());

    });
   
   
    $('input[name^="department"]').each(function (){
                  
          all_department.push($(this).val());

    });
    
    $('input[name^="totalDeducAmt"]').each(function (){
                  
          all_totalDeducAmt.push($(this).val());

    });
    
    $('p[name^="totalSalVal"]').each(function (){
                  
          all_totalSalVal.push($(this).text());

    }); 
     
    $('input[name^="empcode"]').each(function (){
                  
          all_empcode.push($(this).val());

    });
     
    $('input[name^="totalCount"]').each(function (){
                  
          all_totalCount.push($(this).val());

    });

    $('input[name^="tlgrossSalary"]').each(function (){
                  
          all_grossSal.push($(this).val());

    });

     
    $('input[name^="tldeducAmount"]').each(function (){
                  
          all_duduction.push($(this).val());

    });
    
    $('input[name^="tltaxableIn"]').each(function (){
                  
          all_taxableIn.push($(this).val());

    });

    $('input[name^="tltaxAmount"]').each(function (){
                  
          all_taxAmt.push($(this).val());

    });

    $('input[name^="tltaxpaidAmt"]').each(function (){
                  
          all_taxpaid.push($(this).val());

    });

    $('input[name^="tltaxDueRefund"]').each(function (){
                  
          all_taxDueRefund.push($(this).val());

    });
    
    $('input[name^="monDay"]').each(function (){
                  
          all_totalWorkDays.push($(this).val());

    });

    $('input[name^="holiDay"]').each(function (){
                  
          all_holiday.push($(this).val());

    });

    $('input[name^="monthLeave"]').each(function (){
                  
          all_leaves.push($(this).val());

    });

    $('input[name^="abDay"]').each(function (){
                  
          all_absent.push($(this).val());

    });

    $('input[name^="workingDay"]').each(function (){
                  
          all_numWorkDay.push($(this).val());

    }); 

    $('input[name^="empAdvAmt"]').each(function (){
                  
          all_empAdvAmt.push($(this).val());
    });

    $('input[name^="empAdvType"]').each(function (){
                  
          all_empAdvType.push($(this).val());

    }); 

    $('input[name^="empEmiAmt"]').each(function (){
                  
          all_empEmiAmt.push($(this).val());

    });

    $('input[name^="crAmt"]').each(function (){
                  
          all_crAmt.push($(this).val());

    }); 

    $('input[name^="empAccCode"]').each(function (){
                  
          all_empAccCode.push($(this).val());

    }); 

    $('input[name^="empAdvOrLoanM"]').each(function (){
                  
          all_empAdvOrLoanM.push($(this).val());

    });

        
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });

     $.ajax({

        url:"{{ url('/Transaction/EmployeePay/emp-pay-salary-trans') }}",
        method : "POST",
        type: "JSON",

        data: {all_emp_name:all_emp_name,all_empAccCode:all_empAccCode,all_empAdvOrLoanM:all_empAdvOrLoanM,all_empAdvAmt:all_empAdvAmt,all_empAdvType:all_empAdvType,all_empEmiAmt:all_empEmiAmt,all_crAmt:all_crAmt,totalEarn_Amt:totalEarn_Amt,all_department:all_department,all_totalDeducAmt:all_totalDeducAmt,all_totalSalVal:all_totalSalVal,all_empcode:all_empcode,all_totalCount:all_totalCount,all_grossSal:all_grossSal,all_duduction:all_duduction,all_taxableIn:all_taxableIn,all_taxAmt:all_taxAmt,all_taxpaid:all_taxpaid,all_taxDueRefund:all_taxDueRefund,all_totalWorkDays:all_totalWorkDays,all_holiday:all_holiday,all_leaves:all_leaves,all_absent:all_absent,all_numWorkDay:all_numWorkDay,all_wage_code:all_wage_code,all_head_wage_ind:all_head_wage_ind,all_wagetype:all_wagetype,all_amount:all_amount,comp_code:comp_code,fy_year:fy_year,vr_date:vr_date,tranCode:tranCode,seriesCode:seriesCode,seriesName:seriesName,vrno:vrno,plant_list:plant_list,plantName:plantName,profitcen_code:profitcen_code,profitcenter_name:profitcenter_name,monthYR:monthYR,all_idictrCount:all_idictrCount,totalRowc:totalRowc,all_rate:all_rate,all_logic:all_logic,all_formCount:all_formCount},


              success:function(data){
               
                var data1 = JSON.parse(data);
                 
                if(data1.response == 'success'){

                  var MONTH_YR = data1.head_data.MONTH_YR;
                  var COMP_CODE = data1.head_data.COMP_CODE;
                  var FY_YEAR = data1.head_data.FY_YEAR;
                  var PLANT_CODE = data1.head_data.PLANT_CODE;
                  $('#emplist').prop('disabled',true);
                 
                  window.location.href = "{{ url('/TransactionEmployee-Salary-excel')}}/"+MONTH_YR+"/"+COMP_CODE+"/"+FY_YEAR+"/"+PLANT_CODE+"";

                  // setTimeout(function () {
                  
                  // var pageName = btoa('EmpPayTrans');
                  
                  // window.location.href = "{{ url('/Transaction/TravelRequisition/success-message')}}/"+pageName+"";

                  //   }, 1000);

                 }else{
                   
                   console.log('error');

                 }

              }

            });
  }

  $( window ).on( "load", function() {

    $('#plant_list').css('border-color','#ff0000').focus();

    $('#month_yr').prop('disabled',true);

    $('#submitdata').prop('disabled',true);

    $('#emplist').prop('disabled',true);

  })

  function funplantinput() {

    var plant_list = $("#plant_list").val();

    var attMonthYear = $("#month_yr").val();

    if(plant_list == ''){

      $('#plant_list').css('border-color','#ff0000').focus();

    }
    else{
     
     $('#plant_list').attr('readonly',true);

     $('#plant_list').css('border-color', '#d2d6de');

     $('#month_yr').prop('disabled',false);

     if(attMonthYear == ''){

      $('#month_yr').css('border-color','#ff0000').focus();

     }else{

      $('#month_yr').css('border-color', '#d2d6de');
      
     }
    }
  }

  function funmonYr(){
   
   var attMonthYear = $("#month_yr").val();

   if(attMonthYear == ''){

    $('#month_yr').css('border-color','#ff0000').focus();

   }else{

    $('#month_yr').css('border-color', '#d2d6de');

    $('#month_yr').attr('disabled','disabled');

    $('#month_yr').removeClass("transdatepicker");

    $('#submitdata').prop('disabled',false);
   }
  }

  function funemplist(){

    var monthYR = $('#month_yr').val();
    
    $("#submitdata").prop('disabled',true);
    
    var company_code = $('#comp_code').val();

    $('#tbl_comp_code').val(company_code);

    var fy_year = $('#fy_year').val();

    var vr_date = $('#vr_date').val();

    var tranCode = $('#tranCode').val();

    var seriesCode = $('#seriesCode').val();

    var seriesName = $('#seriesName').val();

    var vrno = $('#vrno').val();

    var plant_list = $('#plant_list').val();

    var plantName = $('#plantName').val();

    var profitcen_code = $('#profitcen_code').val();

    var profitcenter_name = $('#profitcenter_name').val();

    $('#tbl_fy_year').val(fy_year);
    $('#tbl_vr_date').val(vr_date);
    $('#tbl_tranCode').val(tranCode);
    $('#tbl_seriesCode').val(seriesCode);
    $('#tbl_seriesName').val(seriesName);
    $('#tbl_vrno').val(vrno);
    $('#tbl_plant_list').val(plant_list);
    $('#tbl_plantName').val(plantName);
    $('#tbl_profitcen_code').val(profitcen_code);
    $('#tbl_profitcenter_name').val(profitcenter_name);
    $('#tbl_monthYR').val(monthYR);
    
    $('#empPay').DataTable().destroy();

    load_data(monthYR);
  
  }

  function funcheckTable(){

    setTimeout(function() {

    var table = $('#empPay').DataTable();

    if ( ! table.data().any() ) {

        $("#emplist").prop('disabled',true);

        $("#getMsg").html('<b style="color:#f12b2b;font-size: 17px;">Record Found...! For Selected Month Year</b>');

    }else{

      $("#emplist").prop('disabled',false);

    }
   }, 500);
  }
    

  function funPdf(rowcount){

    event.preventDefault();

    var name =  $('#empName_'+rowcount).val();
    var accNo =  $('#accNo_'+rowcount).val();
    var empcode =  $('#empcode_'+rowcount).val();
    var panNo =  $('#pan_'+rowcount).val();
    var pfNum =  $('#pfNum_'+rowcount).val();
    var empDesig =  $('#empDesig_'+rowcount).val();
    var saNum =  $('#saNum_'+rowcount).val();
    var empDOJ =  $('#empDOJ_'+rowcount).val();
    var bankName =  $('#bankName_'+rowcount).val();
    var payPeriod =  $('#payPeriod_'+rowcount).val();
    var grade =  $('#grade_'+rowcount).val();
    var ifsc =  $('#ifsc_'+rowcount).val();
    var totalWorkDays =  $('#totalWorkDays_'+rowcount).val();
    var holiday =  $('#holiday_'+rowcount).val();
    var leaves =  $('#leaves_'+rowcount).val();
    var absent =  $('#absent_'+rowcount).val();
    var numWorkDay =  $('#numWorkDay_'+rowcount).val();
    var nameComp=  $('#exampleModalLabel_').text();
    var grossSal=  $('#grossSal_'+rowcount).val();
    var deduction=  $('#deduction'+rowcount).val();
    var taxableIn=  $('#taxableIn_'+rowcount).val();
    var taxAmt=  $('#taxAmt_'+rowcount).val();
    var taxpaid=  $('#taxpaid_'+rowcount).val();
    var taxDueRefund=  $('#taxDueRefund_'+rowcount).val();
    var totalNp=  $('#totalNp_'+rowcount).text();
    var ctcAmt =  $('#amt_1_'+rowcount).val();
    var tlEarnAmt =  $('#tlEarnAmt_'+rowcount).val();
    var tlDeducAmt =  $('#tlDeducAmt_'+rowcount).val();
    var wageLen =  $('#indiCount'+rowcount).val();
    var ptax =  $('#ptax_'+rowcount).val();
    var itax =  $('#iTax_'+rowcount).val();
    var advOrLoanAmt =  $('#advAmt_'+rowcount).val();
    var wageInEarning = [];
    var wageInDeduction = [];
    var wageInEarningAmt = [];
    var wageInDeducAmt = [];

    for(var i=1; i<=wageLen; i++){

      var wageIndi = $('#wageIndicator_'+i).val();
      
      var wagetype = $('#wageIndType_'+i).val();
      
      var amt = $('#wageIndAmt_'+i).val();
      
      if(wagetype == 'EARNING'){

       wageInEarning.push(wageIndi);
       wageInEarningAmt.push(amt);

      }else if(wagetype == 'DEDUCTION'){

        wageInDeduction.push(wageIndi);
        wageInDeducAmt.push(amt);

      }else{

      }

    }

    var wageEarLen = wageInEarning.length;
    
    $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
    });

    $.ajax({

      url:"{{ url('/Transaction/EmployeePay/document')}}",

      method : "POST",

      data: {name:name,accNo:accNo,empcode:empcode,pfNum:pfNum,empDesig:empDesig,saNum:saNum,empDOJ:empDOJ,bankName:bankName,panNo:panNo,ifsc:ifsc,totalWorkDays:totalWorkDays,holiday:holiday,leaves:leaves,absent:absent,numWorkDay:numWorkDay,nameComp:nameComp,grossSal:grossSal,deduction:deduction,taxableIn:taxableIn,taxAmt:taxAmt,taxpaid:taxpaid,taxDueRefund:taxDueRefund,ctcAmt:ctcAmt,wageLen:wageLen,wageInEarning:wageInEarning,wageInEarningAmt:wageInEarningAmt,wageEarLen:wageEarLen,wageInDeduction:wageInDeduction,wageInDeducAmt:wageInDeducAmt,totalNp:totalNp,tlEarnAmt:tlEarnAmt,tlDeducAmt:tlDeducAmt,ptax:ptax,itax:itax,advOrLoanAmt:advOrLoanAmt,payPeriod:payPeriod,grade:grade},

      success: function(response){

      if(response.response == 'success' && response.data !=''){
        
        var link = document.createElement('a');

        link.href = response.url;

        var todaysDate = new Date();
                 
        var month = todaysDate.getMonth() + 1;
        var splitName = name.split(' ');
        var firstName = splitName[0];
        var empcodee   = empcode;

        var fulldate = todaysDate.toLocaleDateString('en-GB', {
          day: '2-digit', month: '2-digit', year: 'numeric'
        }).replace(/ /g, );

        var getDt = fulldate.split('/');
        var dt = getDt[0];
        var month = getDt[1];
        var yr = getDt[2];
        var fulldate = yr+''+month+''+dt;
        var randomNo = Math.round(Math.random() * 10000);
        link.download = firstName+'_'+empcodee+'_'+fulldate+'_'+randomNo+'.pdf';
        link.dispatchEvent(new MouseEvent('click'));

      }else{
          
          alert('no data');
      }

               

      }, 

            
    });

  }
    
  var ptax_amount = 0;

  function ptaxCalculation(getData){

    var mon_yrAtt = $('#month_yr').val();

    var yrAmt = mon_yrAtt.split(' ');
       
    var yr_monAmt = yrAmt[0];
   
    if(yr_monAmt == 'April'){
        ptax_amount = getData.M04;
       }else if(yr_monAmt == 'May'){
         ptax_amount = getData.M05;
       }else if(yr_monAmt == 'June'){
         ptax_amount = getData.M06;
       }else if(yr_monAmt == 'July'){
         ptax_amount = getData.M07;
       }else if(yr_monAmt == 'August'){
         ptax_amount = getData.M08;
       }else if(yr_monAmt == 'September'){
         ptax_amount = getData.M09;
       }else if(yr_monAmt == 'October'){
         ptax_amount= getData.M10;
       }else if(yr_monAmt == 'November'){
         ptax_amount.M11;
       }else if(yr_monAmt == 'December'){
         ptax_amount= getData.M12;
       }else if(yr_monAmt == 'January'){
         ptax_amount= getData.M01;
       }else if(yr_monAmt == 'February'){
         ptax_amount= getData.M02;
       }else if(yr_monAmt == 'March'){
         ptax_amount= getData.M03;
       }else{

       }
    
  }

  function salaryCalculation(wageInd_code,indicator,rate_code,rate,logic,ctc,srnos,rowCount,EDVal,amt,indC){

    var totalAmt = $('#totalEarnAmt_'+rowCount).val();

    var totalDedAmt = $('#totalDeducAmt_'+rowCount).val();

    var tlMonDay = $('#monDay_'+rowCount).val();

    var tlAbDay = $('#abDay_'+rowCount).val();

    var totalPDay = parseFloat(tlMonDay) - parseFloat(tlAbDay);

    var amount = parseFloat(amt);
   
    var calcVal =parseFloat(amt)/parseFloat(tlMonDay)*parseFloat(totalPDay);
    
    var values = calcVal.toFixed(2);
   
    var basicCal = '<input type="hidden" id="ind_Code_'+srnos+'_'+rowCount+'" name="ICode[]" value="'+wageInd_code+'"><input type="hidden" id="ind_Name_'+srnos+'_'+rowCount+'" name="IName[]" value="'+indicator+'"><input type="hidden" id="ind_type_'+srnos+'_'+rowCount+'" name="IType[]" value="'+EDVal+'"><input type="hidden" id="ind_rate_'+srnos+'_'+rowCount+'" name="IRate[]" value="'+rate+'"><input type="hidden" id="ind_logic_'+srnos+'_'+rowCount+'" name="ILogic[]" value="'+logic+'"><input type="hidden" id="cal_Ind_'+srnos+'_'+rowCount+'" name="IValue[]" value="'+values+'">';

    $('#calValue'+rowCount).append(basicCal);
    
    $('#calValue'+rowCount).append('<input type="hidden" id="indC" name="indC" value="'+indC+'">');
    
    $('#calValue'+rowCount).append('<input type="hidden" id="tlRow_'+rowCount+'" name="indRowC[]" value="'+indC+'"><input type="hidden" id="formCount'+rowCount+'" name="formCount[]" value="1">');

    if(EDVal =="EARNING" && indicator != "Veriable Pay"){
      
       var eaAmt    = parseFloat(totalAmt) + parseFloat(amt);
       
       totalAmt     = parseFloat(eaAmt);

       $('#totalEarnAmt_'+rowCount).val(totalAmt);

       var salAmt   = parseFloat(totalAmt);

       var perDAmt  = salAmt/tlMonDay;

       var abDayAmt = perDAmt*tlAbDay;

       var nPayAmt  = parseFloat(salAmt) - parseFloat(abDayAmt);

       $('#earnVal'+rowCount).text(nPayAmt.toFixed(2));

       $('#tlEarn_'+rowCount).val(nPayAmt.toFixed(2));
    
    }

    if(EDVal =="DEDUCTION"){

     var deducAmt  = parseFloat(totalDedAmt) + parseFloat(amt) + parseFloat(ptax_amount);

     totalDedAmt = parseFloat(deducAmt);

     $('#totalDeducAmt_'+rowCount).val(totalDedAmt);
     
     $('#deductionVal'+rowCount).text(totalDedAmt);
      
    }else{
      
      $('#deductionVal'+rowCount).text(totalDedAmt);  

    }

    if(totalAmt !='' && totalDedAmt!= ''){

      var earningAmt = $('#earnVal'+rowCount).text();

      var salAmt = parseFloat(earningAmt) - parseFloat(totalDedAmt);
      
      $('#totalSalVal_'+rowCount).text(salAmt.toFixed(2));

      $('#tlSalAmt_'+rowCount).val(salAmt.toFixed(2));
    }

  }

  function funApply(rowId){

  var rowCount = $('#inParticular_'+rowId+' td').length;
 
  var statusValue = $('#statusVal_'+rowId).val();
  var tlDeducAmt = $('#tlDeducAmt_'+rowId).val();
  $('#deductionVal'+rowId).text(tlDeducAmt);
  $('#totalDeducAmt_'+rowId).val(tlDeducAmt);

  var totalNp = $('#totalNp_'+rowId).text();
  console.log('totalNp',totalNp);
  // var totalNpfix = totalNp.toFixed(2);

  $('#totalSalVal_'+rowId).text(totalNp);



  var statusUpdate;

    if(statusValue == 0){

     $('#statusVal_'+rowId).val('1');

     var indiCount =  $('#indicatorRow_'+rowId).val();

     var tlRow =  $('#totalRow').val();

     var finalRow = parseFloat(indiCount) + parseFloat(tlRow);

     $('#totalRow').val(finalRow);
      
    } 

    statusUpdate = $('#statusVal_'+rowId).val();

    if(statusUpdate==1){

       $('#status_'+rowId).html('');

       $('#status_'+rowId).html('<input type="hidden" id="statusVal_'+rowId+'" value="1" style="z-index: 0;"><span class="label label-success">PDF Generated</span>');
    }

    var countInd = $('#rowIndicator_'+rowId).val();
    
    $('#pdfIncomeBox_'+rowId).html('');

    $('#pdfAttenBox_'+rowId).html('');

    $('#pdfFormSixteenBox_'+rowId).html('');

    for(var i=1;i<=countInd;i++){

      var indName = $('#wageIndicator_'+i).val();

      var indAmt = $('#wageIndAmt_'+i).val();

      var indType = $('#wageIndType_'+i).val();

      var indData = "<input type='hidden' name='indName[]' value='"+indName+"'>";

      var indAmt = "<input type='hidden' name='indAmt[]' value='"+indAmt+"'>";

      var indType = "<input type='hidden' name='indType[]' value='"+indType+"'>";

      $('#pdfIncomeBox_'+rowId).append(indData);

      $('#pdfIncomeBox_'+rowId).append(indAmt);

      $('#pdfIncomeBox_'+rowId).append(indType);

    }

    var ptaxData = $('#pTaxInd_'+rowId).val();

    var ptaxAmt = $('#ptax_'+rowId).val();

    var ptaxType = $('#ptaxType_'+rowId).val();
    
    var ptax = "<input type='hidden' name='indName[]' value='"+ptaxData+"'>";

    var ptax_type = "<input type='hidden' name='indType[]' value='"+ptaxType+"'>";

    var ptaxAmount = "<input type='hidden' name='indAmt[]' value='"+ptaxAmt+"'>";

    $('#pdfIncomeBox_'+rowId).append(ptax);

    $('#pdfIncomeBox_'+rowId).append(ptaxAmount);

    $('#pdfIncomeBox_'+rowId).append(ptax_type);

    var itaxData = $('#iTaxInd_'+rowId).val();

    var itaxAmt = $('#iTax_'+rowId).val();

    var itaxType = $('#itaxType_'+rowId).val();

    var itax = "<input type='hidden' name='indName[]' value='"+itaxData+"'>";

    var itaxAmount = "<input type='hidden' name='indAmt[]' value='"+itaxAmt+"'>";

    var itax_Type = "<input type='hidden' name='indType[]' value='"+itaxType+"'>";

    $('#pdfIncomeBox_'+rowId).append(itax);

    $('#pdfIncomeBox_'+rowId).append(itaxAmount);

    $('#pdfIncomeBox_'+rowId).append(itax_Type);



    var tlWorkDay = $('#totalWorkDays_'+rowId).val();

    var holiday = $('#holiday_'+rowId).val();

    var leaveDay = $('#leaves_'+rowId).val();

    var absentDay = $('#absent_'+rowId).val();

    var totalPresent =$('#numWorkDay_'+rowId).val();

    var attendance = "<input type='hidden' name='tlmmDay[]' value='"+tlWorkDay+"'><input type='hidden' name='tlholiday[]' value='"+holiday+"'><input type='hidden' name='tlleaves[]' value='"+leaveDay+"'><input type='hidden' name='tlabsentDay[]' value='"+absentDay+"'><input type='hidden' name='tlPresentDay[]' value='"+totalPresent+"'>";

    $('#pdfAttenBox_'+rowId).append(attendance);
    
    var gross_sal = $('#grossSal_'+rowId).val();

    var deduction = $('#deduction'+rowId).val();

    var taxableIn = $('#taxableIn_'+rowId).val();

    var taxAmt = $('#taxAmt_'+rowId).val();

    var taxpaid = $('#taxpaid_'+rowId).val();

    var taxDueRefund = $('#taxDueRefund_'+rowId).val();

    var formSixteen = "<input type='hidden' name='gross_sal[]' value='"+gross_sal+"'><input type='hidden' name='deductionAmt[]' value='"+deduction+"'><input type='hidden' name='taxableInAmt[]' value='"+taxableIn+"'><input type='hidden' name='tltaxAmt[]' value='"+taxAmt+"'><input type='hidden' name='taxpaidAmt[]' value='"+taxpaid+"'><input type='hidden' name='taxDueRefundAmt[]' value='"+taxDueRefund+"'>";

    $('#pdfFormSixteenBox_'+rowId).append(formSixteen);
    
}

function CalculateBasic(emp_grade,emp_code,rowCount){

  $('#empCode').val(emp_code);

  var emp_grade = emp_grade;

  var emp_code = emp_code;

  var monthYr = $('#month_yr').val();

  var netPaidSal = $('#earnVal'+rowCount).text();

  var basic_amt = parseFloat($("#tlSalAmt_"+rowCount).val());

  $.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }
  });

  $.ajax({

    type: 'POST',

    url: "{{ url('/Master/Employee/emp_gradecode-pay-master') }}",

    data: {emp_grade:emp_grade, emp_code:emp_code}, // here $(this) refers to the ajax object not form

    success: function (data) {

      var obj = JSON.parse(data);

      if (obj.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

      }else if(obj.response == 'success'){
          
        if(obj.data ==''){

        }else{

          $('#basic_rate').empty();

          $('#footer_modal_pay').empty();

          var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox' style='width:20% !important;'>Wage Indicator</div><div class='box10 amountBox'>Amount</div></div>";

          $('#basic_rate').append(TableHeadData);

          var wageData = obj.data.emppayData.length;

          $('#getWageCount').val(wageData);

          var counter = 1;

          var dd=1;

          var countI ='';

          var dataI ='';
          
          $('#emp_name').val(obj.data.empInfo.EMP_NAME);

          $.each(obj.data.emppayData, function(k, getData) {

           var datacount = obj.data.emppayData.length;
           dataI = datacount;

           $('#grade_code').val(getData.GRADE_CODE);

           $('#monYear').val(monthYr);

           $('#net_sal').val(netPaidSal);
            
           if(getData.WAGE_INDTYPE == 'EARNING' && getData.MONTH_OR_YR == 'Monthly' || getData.WAGE_INDTYPE == 'DEDUCTION' && getData.MONTH_OR_YR == 'Monthly'){

           var TableData = "<div class='box-row' id='basicrows'><div class='box10 texIndbox'><input type='text' id='wage_ind_"+counter+"' name='head_wage_ind[]' class='form-control inputtaxInd' style='z-index: 0;' value=\'"+getData.WAGEIND_NAME+"\'><input type='hidden' id='wageInd_type_"+counter+"' name='wageInd_type[]' class='form-control inputtaxInd' style='z-index: 0;' value="+getData.WAGE_INDTYPE+"></div><div class='box10 amountBox'><input type='text' id='amt_"+counter+"'  name='amount[]'class='form-control text-right' oninput='getTotal("+rowCount+");' autocomplete='off' value="+getData.AMOUNT+" readonly></div></div><div id='indicatorShow_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+counter+")'>Apply</button></div></div></div></div>";
          
          }

          countI = counter;
          counter++;
          dd++;
          
          $('#basic_rate').append(TableData);

        })

        }

        var butn =  $('#footer_modal_pay').find(':button').html();

        if(butn != 'Ok' || butn =='undefined'){

          var tblfootDataL = "<div class='col-md-6'></div><div class='col-md-3'><label>Balance </label></div><div class='col-md-3 text-right'><p id='balVal' style='font-weight:bold;'></p></div>"

          var tblfootData = "<input type='hidden' id='tlNetAmt_"+rowCount+"' name='tlNetAmt' value='0'><input type='hidden' id='tlDedAmt_"+rowCount+"' name='tlDedAmt' value='0'><button type='button' class='btn btn-primary ' style='width: 10%;' data-dismiss='modal' id='ApplyOkbtn' onclick='OkGetTransVal("+rowCount+","+dataI+","+countI+",1);'>OK</button></div>";
                               
          $('#balanceRow'+rowCount).html(tblfootDataL);

          $('#footer_modal_pay').append(tblfootData);

          }else{
                            
          }

        }

      }
    })

  }
    
  function getTotal(rowCount){

    setTimeout(function() {

     $('.modalspinner').addClass('hideloaderOnModl');

      totalAmount = 0;

      $("#balance").val('0');

      var monthDays = $('#monDay_'+rowCount).val();

      var absent_days = $('#abDay_'+rowCount).val();

      var totalPDay = parseFloat(monthDays) - parseFloat(absent_days);
      
      var getWCount = $('#getWageCount').val();
      
      for(l=2;l<=getWCount;l++){

        indicator = $("#wage_ind_"+l).val();

        wageType = $("#wageInd_type_"+l).val();
        
        rate_code = $("#rate_code_"+l).val();   
        
        rate = $("#rate_"+l).val();   

        logic = $("#logic_"+l).val();
       
        static = $('#static_'+l).val();
        
        amt = $('#amt_'+l).val();

        if(indicator != '' && indicator != undefined && wageType == 'EARNING'){
        
         amountCalculation(indicator,rate_code,rate,logic,l,monthDays,totalPDay,rowCount,amt);
        
        }

        if(indicator != '' && indicator != undefined && wageType == 'DEDUCTION'){

         deductionCalculation(indicator,rate_code,rate,logic,l,monthDays,totalPDay,rowCount,amt);
        }

        if(static == 0){

         $('#btnchange'+l).removeClass('showind_Ch');

         $('#rate_'+l).prop('readonly', false);
     
        }else{

        }
      }

    }, 500);

    $('.modalspinner').removeClass('hideloaderOnModl');
    
  }
  
  function amountCalculation(indicator,rate_code,rate,logic,l,monthDays,totalPDay,rowCount,amt){
    
   if(indicator == 'Veriable Pay'){

   }else{

    var tlAmount = parseFloat(amt)/parseFloat(monthDays)*parseFloat(totalPDay);

    $("#amt_"+l).val(tlAmount.toFixed(2));

    var netEarn = $("#tlNetAmt_"+rowCount).val();
    
    var earnValue = parseFloat(netEarn) + parseFloat(tlAmount);
   
    $("#tlNetAmt_"+rowCount).val(earnValue.toFixed(2));

   }
    

  }

  function deductionCalculation(indicator,rate_code,rate,logic,l,monthDays,totalPDay,rowCount,amt){
   
   var tlAmount = parseFloat(amt)/parseFloat(monthDays)*parseFloat(totalPDay);
   
   $("#amt_"+l).val(tlAmount.toFixed(2));

   var netDeduct = $("#tlDedAmt_"+rowCount).val();

   var deductVal = parseFloat(netDeduct) + parseFloat(tlAmount);

   $("#tlDedAmt_"+rowCount).val(deductVal.toFixed(2));

  }

  
  function monthDiff(join_date, fy_yr_date){

      return fy_yr_date.getMonth() - join_date.getMonth() + 
      (12 * (fy_yr_date.getFullYear() - join_date.getFullYear())) + 1;

  }

  function getDaysInMonth(month,year) {

           return new Date(year, month, 0).getDate();

  };

  function OkGetTransVal(rowCount,datacount,countercount,staticvalue){

    var monYr = $('#month_yr').val();

    var accCode = $('#empAcc_code_'+rowCount).val();

    var date = new Date(monYr);
    
    var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
    
    var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
    
    var year  = firstDay.getFullYear();
   
    var month = (firstDay.getMonth() + 1).toString().padStart(2, "0");
   
    var daymonth = (firstDay.getDate()).toString().padStart(2, "0");
    
    var startDt = daymonth +'.'+ month +'.'+ year ;

    var endYear  = lastDay.getFullYear();
   
    var endMonth = (lastDay.getMonth() + 1).toString().padStart(2, "0");
   
    var endDayMonth = (lastDay.getDate()).toString().padStart(2, "0");
    
    var endDtMonth = endDayMonth +'.'+ endMonth +'.'+ endYear ;
    
    var payPeriod = startDt +'-'+ endDtMonth;
   
    var drAmount = 0;

    var crAmount = 0; 
    var chRead;

    var empAdvType = $('#empAdvType_'+rowCount).val();
    
    var advOrLoanM = $('#empAdvOrLoanM_'+rowCount).val();
    
    if(empAdvType == 'Loan'){

      if(advOrLoanM == monYr){

       crAmount = 0;

       $('#crAmt_'+rowCount).val(0);
       
      }else{

      loanAmount = $('#empAdvAmt_'+rowCount).val();

      creditAmount = $('#chkCrAmt_'+rowCount).val();
      $('#advAmt_'+rowCount).prop('readonly',false);
      
        if(loanAmount == creditAmount){
      
         crAmount = 0;
        
        }else{

          chkCrAmt = $('#chkCrAmt_'+rowCount).val();

          emiAmount = $('#empEmiAmt_'+rowCount).val();

          loanAmount = $('#empAdvAmt_'+rowCount).val();

          creditAmount = $('#chkCrAmt_'+rowCount).val();

          chBalLoanAmt = parseFloat(loanAmount) - parseFloat(creditAmount);

          if(chBalLoanAmt < emiAmount){
            crAmount = chBalLoanAmt;
            sumCrAmt = parseFloat(chkCrAmt) + parseFloat(chBalLoanAmt);

          }else{
            crAmount = emiAmount;
            sumCrAmt = parseFloat(chkCrAmt) + parseFloat(crAmount);
          }

          
          
          $('#crAmt_'+rowCount).val(sumCrAmt);
      
        }
      }
    }

    else if(empAdvType == 'Advance'){

      loanAmount = $('#empAdvAmt_'+rowCount).val();

      creditAmount = $('#chkCrAmt_'+rowCount).val();

      
      if(advOrLoanM == monYr){
       $('#advAmt_'+rowCount).prop('readonly',false);

       crAmount = $('#empAdvAmt_'+rowCount).val();
       
      }else{
        $('#advAmt_'+rowCount).prop('readonly',false);
        var chBalAmt = parseFloat(loanAmount) - parseFloat(creditAmount);
        crAmount = chBalAmt;
      }
     
    }                          

    var wageInd = [];
    var wageAmt = [];
    var wageType = [];

    $('input[name^="head_wage_ind"]').each(function (){
                  
          wageInd.push($(this).val());

    });

    $('input[name^="amount"]').each(function (){
                  
          wageAmt.push($(this).val());

    });

    $('input[name^="wageInd_type"]').each(function (){
                  
          wageType.push($(this).val());

    });
    
    empGrade = $('#grade_code').val();
    empCode = $('#empCode').val();
    month_yr = $('#month_yr').val();

    var getdud = $('#deductionVal').html();

    var checkEmpExist = $("#ecode_"+rowCount).val();
    
    if((checkEmpExist == '') || (checkEmpExist == undefined)){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

    url:"{{ url('/Transaction/temp-emp-pay-salary-trans') }}",
    method : "POST",
    type: "JSON",
    data:{wageInd:wageInd,wageAmt:wageAmt,empCode:empCode,empGrade:empGrade,month_yr:month_yr,wageType:wageType,accCode},
        
    success:function(data){

    var obj = JSON.parse(data);

      if(obj.data ==''){

      }else{

      $('#empCode_').val(empCode);

      $('#empgrade').val(obj.data.ctcdata.GRADE_CODE);

      $('#empsalMon').val(obj.data.attendance.YR_MONTH);



      var ptaxData = obj.data.p_tax;

      // if(empAdvType == ''){

      //   $('#advAmt_'+rowCount).attr('readonly', 'readonly');
      // }else{
      //   $('#advAmt_'+rowCount).prop('readonly',false);
      // }

      var paymodal = '<div id="payment_receipt'+rowCount+'" class="modal fade" rtabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop=""><div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-content" style="overflow-y: scroll; height: 520px;"><div class="modal-header"><input type="hidden" class="settaxcodemodel col-md-6" id="empCode_" style="border: none; padding: 0px;" readonly><h5 class="modal-title modltitletext text-center" id="exampleModalLabel_" style="font-size: 19px;"></h5><p id="comp_add" class="text-center" style="font-size:17px;font-weight:700;"></p><h6 class="text-center" style="font-weight: 700;font-size: 18px;">SALARY SLIP</h6></div><div class="modal-body table-responsive" style=""><div class="modalspinner hideloaderOnModl"></div><div class="" id="paymentReceipt'+rowCount+'"></div></div><div class="modal-footer text-center" id="paymentReceipt_footer'+rowCount+'"></div></div></div></div></div>';


    
      $('#modalPayment').append(paymodal);
      $('#paymentReceipt'+rowCount).empty();

      $('#paymentReceipt_footer'+rowCount).empty(); 

      var TableHeadData =  "<input type='hidden' id='indiCount"+rowCount+"' value=''><input type='hidden' id='startDt"+rowCount+"' name='startDt[]' value='"+startDt+"'><input type='hidden' id='endDtMonth"+rowCount+"' name='endDtMonth[]' value='"+endDtMonth+"'><table class='tblBorder' style='width:100%;' id='tblSalReceipt_"+rowCount+"'><tr><td id='empInfo'>Employee Name</td><td><input type='text' id='empName_"+rowCount+"' value='' style='border: 0px;' readonly></td><td id='empInfo'>PAN</td><td><input type='text' id='pan_"+rowCount+"' value='' style='border: 0px;' readonly></td></tr><tr><td id='empInfo'>Employee Code</td><td><input type='text' id='ecode_"+rowCount+"' value='' style='border: 0px;' readonly></td><td id='empInfo'>PF Number</td><td><input type='text' id='pfNum_"+rowCount+"' value='' style='border: 0px;' readonly></td></tr><tr><td id='empInfo'>Designation</td><td><input type='text' id='empDesig_"+rowCount+"' value='' style='border: 0px;' readonly></td><td id='empInfo'>Account No </td><td><input type='text' id='accNo_"+rowCount+"' value='' style='border: 0px;' readonly></td></tr><tr><td id='empInfo'>Date Of Joining</td><td><input type='text' id='empDOJ_"+rowCount+"' value='' style='border: 0px;' readonly></td><td id='empInfo'>IFSC</td><td><input type='text' id='ifsc_"+rowCount+"' value='' style='border: 0px;' readonly></td></tr><tr><td id='empInfo'>CTC</td><td><input type='text' id='amt_1_"+rowCount+"' value='"+obj.data.ctcdata.CTC+"' style='border: 0px;' readonly></td><td id='empInfo'>Bank Name</td><td><input type='text' id='bankName_"+rowCount+"' value='' style='border: 0px;' readonly></td></tr><tr><td id='empInfo'>Pay Period</td><td><input type='text' id='payPeriod_"+rowCount+"' value='"+payPeriod+"' style='border: 0px;' readonly ></td><td id='empInfo'>Grade</td><td><input type='text' id='grade_"+rowCount+"' value='' style='border: 0px;' readonly></td></tr><tr></tr><tr  height = 20px><td colspan='4'></td></tr><tr class='text-center'><th colspan='2' id='empInfo1'>Income </th><th colspan='2' id='empInfo1'>Deduction</th></tr><tr style='background-color:#efd5d5fa;'><th id='empInfo' style='width:25%;text-align: center;'>Particulars</th><th id='empInfo' style='width:25%;text-align: center;'>Amount</th><th id='empInfo' style='width:25%;text-align: center;'>Particulars</th><th id='empInfo' style='width:25%;text-align: center;'>Amount</th></tr><tr><td colspan='2' id='inParticular_"+rowCount+"'></td><td colspan='2' id='deducParticular_"+rowCount+"' style='vertical-align:top !important;'></td></tr><tr><td colspan='2'><div class='row'><div class='col-md-5 text-right' style='padding-top:2%;'><lable><strong>Total Earning</strong> </label></div><div class='col-md-1'style='padding-top:2%;'><strong>:  </strong></div><div class='col-md-4'style='padding-top:1%;'><input type='text' id='tlEarnAmt_"+rowCount+"' value='0' class='text-center' style='border:0px solid;outline:none;font-weight: 900;' readonly></div></div></td><td colspan='2'><div class='row'><div class='col-md-5 text-right'style='padding-top:2%;'><lable><strong>Total Deduction</strong> </label></div><div class='col-md-1'style='padding-top:2%;'><strong>:  </strong></div><div class='col-md-4 text-left'style='padding-top:1%;'><input type='text' class='text-center' id='tlDeducAmt_"+rowCount+"' value='0' style='border:0px solid;outline:none;font-weight: 900;' readonly><input type='hidden' id='getPITaxAmt_"+rowCount+"' value='0'></div></div></td></tr><tr height='20px'></tr><tr><td colspan='3' id='empInfo1'>Net Salary </td><td><input type='hidden' id='total_ded_"+rowCount+"' name='total_ded[]' class='form-control text-right inputwageInd' value=''><input type='hidden' id='netSal_"+rowCount+"' value=''><p style='padding-top: 5%;font-weight: 900;text-align: center;' id='totalNp_"+rowCount+"'></p><input type='hidden' id='balance_"+rowCount+"' value=''></p><input type='hidden' id='pfYrAmt_"+rowCount+"'><input type='hidden' id='ptaxAmt_"+rowCount+"'></td></tr><tr height='20px'></tr><tr><td colspan='2' style='padding-left: 18px;padding-top: 1%;padding-bottom: 1%;'><strong>Attendance Details</strong></td><td colspan='2' style='padding-left: 18px;'><strong>Form 16 Summary</strong></td></tr><tr><td colspan='2' style='vertical-align: top;text-align:left'><div class='row' style='padding-top: 4%;'><div class='col-md-5 text-left pl-5'><lable style='padding:20px;'><strong>MM Days</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='totalWorkDays_"+rowCount+"' name='totalWorkDays[]' value='' style='border: 0px solid; outline: none;z-index: 0;' readonly><input type='hidden' id='yr_month_"+rowCount+"' value=''></div></div><div class='row'><div class='col-md-5 text-left pl-5'><lable style='padding:20px;'><strong>Holidays </strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='holiday_"+rowCount+"' name='holiday[]' value='' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-5 text-left pl-5'><lable style='padding:20px;'><strong>Leave(SL/CL) </strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='leaves_"+rowCount+"' name='leaves[]' value='' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-5  text-left pl-5'><lable style='padding:20px;'><strong>Absent</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='absent_"+rowCount+"' name='absent[]' value='' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-5'><lable style='padding:20px;'><strong>Working Days </strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='numWorkDay_"+rowCount+"' name='numWorkDay[]' value='' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div></td><td colspan='2' style='vertical-align: top;text-align:left'><div class='row' style='padding-top: 4%;'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Gross Salary  </strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='grossSal_"+rowCount+"' name='grossSal[]' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Deduction</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='deduction"+rowCount+"' name='deduction[]' value='' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Taxable Income</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='taxableIn_"+rowCount+"' name='taxableIn[]' value='' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Tax Amt.</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='taxAmt_"+rowCount+"' name='taxAmt[]' value='' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'></div><input type='hidden' id='totalMonth_"+rowCount+"' value='' readonly></div><div class='row'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Tax Paid</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left' ><input type='text' id='taxpaid_"+rowCount+"' name='taxpaid[]' value='' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Net Tax / Due Refund</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='taxDueRefund_"+rowCount+"' name='taxDueRefund[]' value='' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div></td></tr><tr height='80px'><td colspan='2' style='font-weight:bold'></td><td colspan='2' style='font-weight:bold'></td></tr><tr style=''><td colspan='2' style='font-weight:bold;padding-left: 18px;padding-top:1%;padding-bottom:1%;'>Employee Signature</td><td colspan='2' style='font-weight:bold;padding-left: 18px;'>Employer Signature</td></tr></table><div class='box-row'><div class='box10 amountBox'><input type='hidden' class='form-control text-right' id='ctc_amt_"+rowCount+"' value="+obj.data.ctcdata.CTC+" name='ctcAmount[]' readonly style='z-index: 0;width: 90%;'><input type='hidden' class='form-control text-right' id='monthDays_"+rowCount+"' value="+obj.data.month_year.MONTH_DAYS+" name='monthDays' readonly><input type='hidden' id='abs_day_"+rowCount+"' name='' class='form-control text-right' style='z-index: 0;' value="+obj.data.attendance.ABSENT_DAYS+" readonly></div></div>";

        $('#paymentReceipt'+rowCount).append(TableHeadData);

        $('#empName_'+rowCount).val(obj.data.ctcdata.EMP_NAME);
       
        $('#empDOJ_'+rowCount).val(obj.data.empdata.DOJ);

        $('#pan_'+rowCount).val(obj.data.empdata.PAN_NO);

        var compName = $('#comp_code').val();

        var splitcompName   = compName.split('-');

        var company_name = splitcompName[1];
        
        $('#exampleModalLabel_').text(company_name);

        $('#comp_add').text(obj.data.compAddr);

        $('#ecode_'+rowCount).val(obj.data.empdata.EMP_CODE);

        $('#total_ded_'+rowCount).val(getdud);

        $('#totalWorkDays_'+rowCount).val(obj.data.month_year.MONTH_DAYS);

        $('#yr_month_'+rowCount).val(obj.data.attendance.YR_MONTH);

        $('#empDesig_'+rowCount).val(obj.data.nameDesig);
        
        $('#grade_'+rowCount).val(obj.data.empdata.GRADE_CODE);

        $('#holiday_'+rowCount).val(obj.data.month_year.HOLIDAYS);

        $('#absent_'+rowCount).val(obj.data.attendance.ABSENT_DAYS);

        var tlMDay = $('#totalWorkDays_'+rowCount).val();

        var abDay = $('#absent_'+rowCount).val();

        var noDays = parseFloat(tlMDay) - parseFloat(abDay);

        $('#numWorkDay_'+rowCount).val(noDays);

        $('#leaves_'+rowCount).val(obj.data.attendance.LEAVE);

        $('#bankName_'+rowCount).val(obj.data.empdata.BANK_NAME);

        $('#accNo_'+rowCount).val(obj.data.empdata.BANK_ACCOUNT_NO);

        $('#ifsc_'+rowCount).val(obj.data.empdata.BANK_IFSC);

        var tlNetAmt = $('#tlNetAmt_'+rowCount).val();
        
        $('#tlEarnAmt_'+rowCount).val(tlNetAmt);

        var date_join = obj.data.empdata.DOJ;

        var empctc = obj.data.ctcdata.CTC;

        var fy_toDate ;

        var fy_fromDate;

        var ptaxAmt = 0;

        var PFAmt= 0 ;

        var srNo = 0;

        $.each(obj.data.fy_data, function(k,getData){
               
        fy_toDate = getData.FY_TO_DATE;

        fy_fromDate = getData.FY_FROM_DATE;
       
         if(date_join >= fy_fromDate && date_join <= fy_toDate){

           var diffdate = monthDiff(new Date(date_join), new Date(fy_toDate));

           var gross_sal = empctc * diffdate ;
          
           $('#grossSal_'+rowCount).val(gross_sal);
         }

         else{
          var diffdate = monthDiff(new Date(fy_fromDate), new Date(fy_toDate));
          
          var gross_sal = empctc * diffdate ;
          
          $('#grossSal_'+rowCount).val(gross_sal);

         }
                   
        })

        var totalDeducAmt = 0;

        $.each(obj.data.empITD, function(k, getData) {

          var actualAmt = getData.ACTUAL_AMT;

          var provAmt = getData.PROVISIONAL_AMT;
                    
          if(actualAmt != null){

            totalDeducAmt = parseInt(totalDeducAmt) + parseInt(actualAmt);

          }else{

            totalDeducAmt = parseInt(totalDeducAmt) + parseInt(provAmt);
          }
          
          if(totalDeducAmt == ''){

            $('#deduction'+rowCount).val('0.00');

          }else{

            $('#deduction'+rowCount).val(totalDeducAmt);
          }
                   
          srNo++;
               
        });

        // $.each(obj.data.p_tax, function(k, getData) {

        //    ptaxAmt = parseFloat(getData.M04) + parseFloat(getData.M05) + parseFloat(getData.M06) +parseFloat(getData.M07) + parseFloat(getData.M08) + parseFloat(getData.M09) +parseFloat(getData.M10) + parseFloat(getData.M11) + parseFloat(getData.M12) + parseFloat(getData.M01) +parseFloat(getData.M02) + parseFloat(getData.M03);



        //    $('#ptaxAmt_'+rowCount). val(ptaxAmt);

        // })

        // var ptax_amt = $('#ptaxAmt_'+rowCount).val();
        var ptax_amt = 0;
        

        if(totalDeducAmt == 0){
          
          if(date_join >= fy_fromDate && date_join <= fy_toDate){

            var diffdate = monthDiff(new Date(date_join), new Date(fy_toDate));

            var tlPf = parseFloat(PFAmt) * diffdate ;

            var tlAmt = parseFloat(tlPf) + parseFloat(ptax_amt);

            $('#deduction'+rowCount).val(tlAmt);
          }

          else{

           var tlPf = parseFloat(PFAmt) * 12 ;

           var tlAmt = parseFloat(tlPf) + parseFloat(ptax_amt);
           
           $('#deduction'+rowCount).val(tlAmt);

          }
                   
        }

        else{

         var tlAmt = parseFloat(totalDeducAmt) + parseFloat(pfAmt) + parseFloat(ptax_amt);

         $('#deduction'+rowCount).text(totalDeducAmt);

        }

        var gross_sal_amt =  $('#grossSal_'+rowCount).val();

        var deduction_amt =  $('#deduction'+rowCount).val();

        var taxableIncome;

        var totalPfAmt;

        if(date_join >= fy_fromDate && date_join <= fy_toDate){

          var diffdate = monthDiff(new Date(date_join), new Date(fy_toDate));
             
          totalPfAmt = parseFloat(PFAmt) * diffdate;

          $('#pfYrAmt_'+rowCount).val(totalPfAmt);
            
          taxableIncome = parseFloat(gross_sal_amt) - parseFloat(deduction_amt);

          $('#taxableIn_'+rowCount).val(taxableIncome);

        }
        else{
            
         totalPfAmt = parseFloat(PFAmt) * 12;

         $('#pfYrAmt_'+rowCount).val(totalPfAmt);
         
         taxableIncome = parseFloat(gross_sal_amt) - parseFloat(deduction_amt);
         
         $('#taxableIn_'+rowCount).val(taxableIncome);
          
        }
                
        var taxableIn = taxableIncome;
        
        var taxTotOne;

        var taxTotTwo;

        var totalTax;

        var fivePer    = 550000/100*5;

        var tenPer     = 550000/100*10;

        var fifteenPer = 550000/100*15;

        var twentyPer  = 550000/100*20;

        var twentyFivePer = 550000/100*25;

        if(taxableIn<550000){

          taxTotOne= 0;

          
          $('#taxAmt_'+rowCount).val(taxTotOne);
                  
        }else if(taxableIn >= 550000 && taxableIn <= 1000000){
                 
          taxTotTwo = taxableIn - 550000 ;

          var taxIn = taxTotTwo/100*5;

          var totalTax = taxIn;

          $('#taxAmt_'+rowCount).val(totalTax);

        }else if(taxableIn >= 1000001 && taxableIn <= 1250000){
        
          var taxTotThree = taxableIn - 1000000;

          var taxInTwo = taxTotThree/100*10;

          var totalTaxTwo = fivePer + taxInTwo;

          $('#taxAmt_'+rowCount).val(totalTaxTwo);
                  
        }else if(taxableIn >= 1250001 && taxableIn <= 1500000){
                  
          var taxTotFour = taxableIn - 1250000;

          var taxInThree = taxTotFour/100*15;

          var totalTaxThree = fivePer+tenPer+taxInThree;

          $('#taxAmt_'+rowCount).val(totalTaxThree);
        
        }else if(taxableIn >= 1500001 && taxableIn <= 1750000){

          var taxTotFive  = taxableIn - 1500000;

          var taxInFour   = taxTotFive/100*20;
          
          var totalTaxFour = fivePer+tenPer+fifteenPer+taxInFour;

          $('#taxAmt_'+rowCount).val(totalTaxFour);
        
        }else if(taxableIn >= 1750001 && taxableIn <= 2000000){

          var taxTotSix  = taxableIn - 1750000;

          var taxInFive  = taxTotSix/100*25;

          var totalTaxFive = fivePer+tenPer+fifteenPer+twentyPer+taxInFive;

          $('#taxAmt_'+rowCount).val(totalTaxFive);
          
        }else{

          var taxTotSeven = taxableIn - 2000000;

          var taxInSix    = taxTotSeven/100*30;

          var totalTaxSix = fivePer+tenPer+fifteenPer+twentyPer+twentyFivePer+taxInSix;

          $('#taxAmt_'+rowCount).val(totalTaxSix);
          
        }

        $.each(obj.data.fy_data, function(k,getData){

               
         var fy_toDate = getData.FY_TO_DATE;
         
         var fy_fromDate = getData.FY_FROM_DATE;
         
         var mon_yr = $('#yr_month_'+rowCount).val();
         
         var currentDt = new Date(mon_yr);
         
         var lastDay = new Date(currentDt.getFullYear(), currentDt.getMonth()+1, 1);

         var monthDt = lastDay.toISOString().slice(0, 10);

         var spliteval = date_join.split('-');
                   
         var year  = spliteval[0];
         var month = spliteval[1];
         var daymonth = getDaysInMonth(month,year);

         var oneDay = 24 * 60 * 60 * 1000;
         var firstDate = new Date(date_join);
         
         var lastDtJoin = new Date(firstDate.getFullYear(), firstDate.getMonth()+1);
         
         var secondDate = new Date(lastDtJoin);
         
         var diffDays = Math.round(Math.abs((firstDate - secondDate) / oneDay));
                   
                  
         if((date_join >= fy_fromDate && date_join <= fy_toDate) && (monthDt >= fy_fromDate && monthDt <= fy_toDate)){
                    
            var taxPaidMon = monthDiff(new Date(date_join), new Date(monthDt));
                      
            var totalMon = monthDiff(new Date(date_join), new Date(fy_toDate));
                       
            $('#totalMonth_'+rowCount).val(totalMon);
                       
            var countMon = monthDiff(new Date(lastDtJoin), new Date(monthDt));

            if(countMon > 0){

             countMon = parseFloat(countMon) - 1 ;

            }
                       
            var tAmt = $('#taxAmt_'+rowCount).val();
             
            var oneMonthTax = parseFloat(tAmt) / parseFloat(totalMon);
            
            var oneDayPaidTax = oneMonthTax.toFixed(2) / daymonth;
             
            var paidTax = oneDayPaidTax.toFixed(2) * diffDays;
             
            var taxPaidAmt = parseFloat(oneMonthTax) * parseFloat(countMon) + parseFloat(paidTax);

            $('#taxpaid_'+rowCount).val(taxPaidAmt.toFixed(2));
                    
          }
          
          else{

            if(monthDt >= fy_fromDate && monthDt <= fy_toDate){

              var taxPaidMon = monthDiff(new Date(fy_fromDate), new Date(monthDt));

              var tlTaxPaidMon = parseFloat(taxPaidMon) - 1;
              
              var totalMon = monthDiff(new Date(fy_fromDate), new Date(fy_toDate));

              $('#totalMonth_'+rowCount).val(totalMon);
              
              var tAmt = $('#taxAmt_'+rowCount).val();
              
              var oneMonthTax = parseFloat(tAmt) / parseFloat(totalMon);
                      
              var taxPaidAmt = parseFloat(oneMonthTax) * parseFloat(tlTaxPaidMon);

              $('#taxpaid_'+rowCount).val(taxPaidAmt.toFixed(2));

            }
                     
            }
                   
          })

          var totalTax = $('#taxAmt_'+rowCount).val();

          var totalPaidTax = $('#taxpaid_'+rowCount).val();
          
          var netTax = parseFloat(totalTax) - parseFloat(totalPaidTax);

          $('#taxDueRefund_'+rowCount).val(netTax.toFixed(2));

          var TableDeduct = "<tr><td style='width:46%;'><div class='col-md-9'><input type='text' style='z-index: 0;width:100%; text-align:center;padding-top:5%; border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;' id='pTaxInd_"+rowCount+"' value='P-TAX' name='head_wageInd[]' readonly><input type='hidden'  name='wagetype[]' id='ptaxType_"+rowCount+"' value='DEDUCTION'></div></td><td style='width:30%;padding:5px;'><input type='text' id='ptax_"+rowCount+"'  name='amount[]' class='form-control text-right'  readonly style='z-index: 0;width:100%;' value='0' autocomplete='off'></td></tr><tr><td style='width:46%;'><div class='col-md-9'><input type='text' id='iTaxInd_"+rowCount+"' style='z-index: 0;width:100%;padding-top:5%; text-align:center; border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;' value='I-TAX' name='head_wageInd[]' readonly><input type='hidden'  name='wagetype[]' id='itaxType_"+rowCount+"' value='DEDUCTION'></div><div class='col-md-2'></div></td><td style='width:30%;padding:5px;'><input type='text' id='iTax_"+rowCount+"'  name='amount[]' class='form-control text-right'  readonly style='z-index: 0;width:100%;' value='0' autocomplete='off'></td></tr><tr><td style='width:46%;'><div class='col-md-9'><input type='text' id='advaOrLoanInd_"+rowCount+"' style='z-index: 0;width:100%; padding-top:5%;text-align:center; border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;' value='Advance/Loan' name='head_wageInd[]' readonly><input type='hidden'  name='wagetype[]' id='itaxType_"+rowCount+"' value='DEDUCTION'></div><div class='col-md-2'></div></td><td style='width:30%;padding:5px;'><input type='text' id='advAmt_"+rowCount+"'  name='amount[]' oninput='chkadvLoan("+rowCount+");' class='form-control text-right'   style='z-index: 0;width:100%;' value='"+crAmount+"' autocomplete='off' readonly></td></tr>";

            $('#deducParticular_'+rowCount).append(TableDeduct);

            if(empAdvType == 'Loan' || empAdvType == 'Advance'){

              $('#advAmt_'+rowCount).prop('readonly',false);
            }

            var tltaxAmt =$('#taxAmt_'+rowCount).val();

            var tlMon = $('#totalMonth_'+rowCount).val();

            var perMon = parseFloat(tltaxAmt) / parseFloat(tlMon);

            $('#iTax_'+rowCount).val(perMon.toFixed(2));

            var pf_amt =$('#pfYrAmt_'+rowCount).val();
                   
            var p_taxamt = 0;
                   
            var selfDeduct = parseFloat(pf_amt)+parseFloat(p_taxamt);
            
            $('#deduction'+rowCount).val(selfDeduct.toFixed(2));

            var tlDeduc = $('#tlDedAmt_'+rowCount).val();
                  
            var tlpTax  = $('#ptax_'+rowCount).val();
                  
            var tliTax  = $('#iTax_'+rowCount).val();
              
            var tlAdvOrLoan  = $('#advAmt_'+rowCount).val();
                  
            var totalDeduc = parseFloat(tlDeduc)+parseFloat(tlpTax)+parseFloat(tliTax)+parseFloat(tlAdvOrLoan);
                       

            $('#tlDeducAmt_'+rowCount).val(totalDeduc.toFixed(2));

            var earnVal = $('#tlEarnAmt_'+rowCount).val();
            
            var deducVal = $('#tlDeducAmt_'+rowCount).val();
           
            var earnDeducVal = parseFloat(earnVal) - parseFloat(deducVal);

            $('#totalNp_'+rowCount).text(earnDeducVal);

            if(obj.data.salaryData ==''){

            }else{

              var srNo = 1;
              
              $.each(obj.data.salaryData, function(k, getData) {

              var datacount = obj.data.salaryData.length;

              $('#rowIndicator_'+rowCount).val(datacount);

              $('#indicatorRow_'+rowCount).val(datacount +parseInt(2));
                     
              $('#indiCount'+rowCount).val(datacount);

              if(getData.WAGETYPE =='EARNING' || getData.WAGETYPE == 'DEDUCTION' && getData.MONTH_OR_YR == 'Monthly'){

                $('#totalCount_'+rowCount).val(srNo);

              }

              if(getData.WAGETYPE == 'EARNING' && getData.WAGEIND != 'Veriable Pay' ){

              var TableData = "<tr><td style='width:46%;'><div class='col-md-9'><input type='text' id='wageIndicator_"+srNo+"' name='head_wageInd[]' class='form-control inputtaxInd' style='z-index: 0;width:105%; border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;' value=\""+getData.WAGEIND+"\" readonly></div></div><div class='box10 amountBox'></td><td style='width:30%;padding:5px;'><input type='text' id='wageIndAmt_"+srNo+"'  name='indAmount[]'class='form-control text-right' style='z-index: 0;width: 100%;' autocomplete='off' value='"+getData.AMOUNT+"' readonly><input type='hidden' id='wageIndType_"+srNo+"'  name='wageIndType[]' value='"+getData.WAGETYPE+"' readonly></td></tr>";

                $('#inParticular_'+rowCount).append(TableData);
                      
              }else{

                if(getData.WAGETYPE == 'DEDUCTION'){
                          
                var TableData = "<tr><td style='width:46%;'><div class='col-md-9'><input type='text' id='wageIndicator_"+srNo+"' name='head_wageInd[]' class='form-control inputtaxInd' style='z-index: 0;width:100%; border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;' value=\""+getData.WAGEIND+"\" readonly></div></div><div class='box10 amountBox'></td><td style='width:30%;padding:5px;'><input type='text' id='wageIndAmt_"+srNo+"'  name='indAmount[]'class='form-control text-right' style='z-index: 0;width: 100%;' autocomplete='off' value='"+getData.AMOUNT+"' readonly></td></tr>";
                        
                }

                $('#deducParticular_'+rowCount).append(TableData);

              }

              srNo++;

              });

              var payRecFooter = "<button type='button' class='btn btn-primary' data-dismiss='modal' style='width:100px' onclick='funApply("+rowCount+")'>OK</button><button class='btn btn-danger' onclick='funPdf("+rowCount+")' style='width: 100px;'><i class='fa fa-file-pdf-o' aria-hidden='true'></i> PDF</button>";

              $('#paymentReceipt_footer'+rowCount).append(payRecFooter);
            
            }

            $('#payment_receipt'+rowCount).modal('show');
          }
        }
    });
   }else{
     $('#payment_receipt'+rowCount).modal('show');
   }

  }

  function showDates(rowCount,date_join){
      

  }
   
  function chkadvLoan(rowCount){

   var tlDeduc = $('#tlDedAmt_'+rowCount).val();
   
   var tlpTax  = $('#ptax_'+rowCount).val();
   
   var tliTax  = $('#iTax_'+rowCount).val();
   
   var tlAdvOrLoan  = $('#advAmt_'+rowCount).val();

   if(tlAdvOrLoan == ''){

    tlAdvOrLoan = 0;
    var totalDeduc = parseFloat(tlDeduc)+parseFloat(tlpTax)+parseFloat(tliTax)+parseFloat(tlAdvOrLoan);
   }else{
    var totalDeduc = parseFloat(tlDeduc)+parseFloat(tlpTax)+parseFloat(tliTax)+parseFloat(tlAdvOrLoan);
  }

  $('#tlDeducAmt_'+rowCount).val(totalDeduc.toFixed(2));

    var earnVal = $('#tlEarnAmt_'+rowCount).val();
            
    var deducVal = $('#tlDeducAmt_'+rowCount).val();
   
    var earnDeducVal = parseFloat(earnVal) - parseFloat(deducVal);

    $('#totalNp_'+rowCount).text(earnDeducVal);
   
  } 
      
      


</script>

@endsection

