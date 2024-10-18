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

      padding: 6px;
      padding-bottom: 0px !important;
      line-height: 1.42857143;
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
    width: 5%;
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

        Edit Leave Transaction

        <small>Edit Details</small>

      </h1>

      <ul class="breadcrumb">

        <li>

          <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>

        </li>

        <li>

          <a href="{{ url('/dashboard') }}">Transaction</a>

        </li>

        <li class="active">

          <a href="{{ url('/finance/form-transaction-mast') }}"> Edit Leave Transaction</a>

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

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Edit Leave Transaction</h2>

            <div class="box-tools pull-right">

                <a href="{{url('Transaction/Leave/view-leave-trans')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Leave trans</a>

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

                      

                    </ul>

                  </div>

                  <div class="panel-body">

                    <div class="tab-content">

                      <div class="tab-pane fade in active" id="tab1info">
                      
                       <form action="{{ url('/Transaction/Leave/leave-trans-update') }}" method="POST" enctype="multipart/form-data">

                         @csrf
                        <div class="row">
                              <!-- /.col -->
                          <div class="col-md-3">

                            <div class="form-group">

                              <input type="hidden" name="leaveTransId" value="{{$leaveTrasData->ID}}" >
                              
                              <label>Date: <span class="required-field"></span></label>

                              <div class="input-group">
                                <?php $CurrentDate =date('d-m-Y', strtotime($leaveTrasData->DATE)); ?>

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control  fydatepicker rightcontent" name="leave_trans_date" id="todayleave_trans_date"value="{{$CurrentDate}}" onchange="todayDate()">

                                <input type="hidden" id="fy_fromdate" value="{{$fy_from_date}}">

                                <input type="hidden" id="fy_todate" value="{{$fy_to_date}}">
              							  </div>
                              <small id="todayleave_trans_dateErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('leave_trans_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
              							</div>

                                    <!-- /.form-group -->
                          </div>
                          <!--  /. column close -->

                          <div class="col-md-2">

                            <div class="form-group">

                              <label> T Code : </label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                  
                                 
                                  <input type="text" class="form-control" name="tranCode" value="{{$leaveTrasData->TRAN_CODE}}" id="transcode" placeholder="Enter Transaction Head" readonly >

                                 

                                 </div>

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
                                <?php $series_code= count($seriesData);  ?>
                                <input list ="series_list" id="series_code" name="seriesCode" class="form-control  pull-left" value="{{$leaveTrasData->SERIES_CODE}}" placeholder="Select Series" oninput="funSeriescode()" readonly>

                                <datalist id="series_list">

                                  @foreach($seriesData as $rows)
                     
                                    <option value="{{ $rows->SERIES_CODE }}" data-xyz ="{{ $rows->SERIES_NAME }}">{{ $rows->SERIES_CODE }} = {{ $rows->SERIES_NAME }}</option>
                                                 

                                  @endforeach

                                </datalist>
                              </div>

                           </div>
                              <!-- /.form-group -->
                          </div>
                          <!-- /.col -->

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Series Name: 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                 
                                <input type="text"  id="seriesName" name="seriesName" class="form-control  pull-left" value="{{$leaveTrasData->SERIES_NAME}}" placeholder="Select Series" readonly >
                                 
                              </div>

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

                                <input type="text" class="form-control rightcontent" name="vrno" value="{{$leaveTrasData->VRNO}}" placeholder="Enter Vr No" id="" readonly="">

                              </div>

                            </div>
                                <!-- /.form-group -->
                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Employee Code : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                
                                <input list="emp_list" id="emp_code" name="emp_code" class="form-control  pull-left" value="{{$leaveTrasData->EMP_CODE}}" placeholder="Select Tax" autocomplete="off" oninput="funEmpname()" readonly>

                                 <datalist id="emp_list">
                                    @foreach($empData as $rows)
                                    <option value="{{ $rows->EMP_CODE }}" data-xyz ="{{ $rows->EMP_CODE }}">{{ $rows->EMP_NAME }} = {{ $rows->EMP_CODE }}</option>
                                    
                                    @endforeach
                                     

                                  </datalist>

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('empname', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                             </div>
                            
                          </div>

                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Employee Name : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                
                                <input list="emp_list" id="emp_name" name="emp_name" class="form-control  pull-left" value="{{$leaveTrasData->EMP_NAME}}" placeholder="Select Tax" autocomplete="off" oninput="funEmpname()" readonly>

                                 

                              </div>

                              
                             </div>
                            
                          </div>
                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Plant Code: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input list="plant_list" class="form-control" id="plant_code" name="PlantCode" placeholder=" Plant" maxlength="11" value="{{$leaveTrasData->PLANT_CODE}}" autocomplete="off" oninput="funPlantcode()" readonly>
                                   
                                  
                                  <datalist id="plant_list">
                                    @foreach($plantData as $rows)
                                    <option value="{{ $rows->PLANT_CODE }}" data-xyz ="{{ $rows->PLANT_NAME }}">{{ $rows->PLANT_CODE }} = {{ $rows->PLANT_NAME }}</option>
                                    <input type="hidden" value="{{$rows->PFCT_CODE}}" id="pfctcode">
                                    @endforeach
                                     

                                  </datalist>

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('PlantCode', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>
                                <!-- /.form-group -->
                          </div>
                            <!-- /.col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Plant Name: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input  class="form-control" id="plantName" name="plantName" placeholder="Select Plant" value="{{$leaveTrasData->PLANT_NAME}}" readonly>

                              </div>

                            </div>
                                <!-- /.form-group -->
                          </div>
                           <!-- /.col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Profit Center Code: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input list="profitList"  id="profitcen_code" name="profitcen_code" class="form-control  pull-left" value="{{$leaveTrasData->PFCT_CODE}}" placeholder="Select Profit Center Code" readonly>
                        
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

                                <input  id="profitcenter_name" name="profitcenter_name" class="form-control  pull-left" value="{{$leaveTrasData->PLANT_NAME}}" placeholder="Select Profit Center Name" readonly>

                              </div>

                            </div>
                                <!-- /.form-roup -->
                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Designation : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                
                                <input id="desig_code" name="designation" class="form-control  pull-left" value="{{$leaveTrasData->DESIG_CODE}}" placeholder="Select Designation"  readonly>
                               

                                <input type="hidden" id="desig_name" name="desig_name" value="{{$leaveTrasData->DESIG_NAME}}">

                              </div>
                             </div>
                            
                          </div>

                          <div class="col-md-3">
                           <div class="form-group">

                              <label>Type Of Leave : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                
                                <input list="leave_list" id="type_of_leave" name="type_of_leave" class="form-control  pull-left" value="{{$leaveTrasData->LEAVE_CODE}}" placeholder="Select Leave" autocomplete="off" oninput="funLeavelist()">

                                <datalist id="leave_list">
                                    @foreach($leaveData as $rows)
                                    <option value="{{ $rows->LEAVE_CODE }}" data-xyz ="{{ $rows->LEAVE_NAME }}">{{ $rows->LEAVE_CODE }} = {{ $rows->LEAVE_NAME }}</option>
                                    
                                    @endforeach

                                </datalist>

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('type_of_leave', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                             </div> 
                           </div>

                           <div class="col-md-3">
                            <div class="form-group">

                              <label>From Date : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-calendar" aria-hidden="true"></i>

                                </div>
                                <?php $fromDate =date('d-m-Y', strtotime($leaveTrasData->FROM_DATE)); ?>
                                <input type="text" id="from_date" name="from_date" class="form-control  pull-left transdatepicker" value="{{$fromDate}}" placeholder="Select From Date" onchange="fromdate()" autocomplete="off">


                              </div>

                              <small id="fromdateErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">

                              <label>To Date : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-calendar" aria-hidden="true"></i>

                                </div>
                                <?php $toDate =date('d-m-Y', strtotime($leaveTrasData->TO_DATE)); ?>
                                <input type="text" id="to_date" name="to_date" class="form-control  pull-left transdatepicker" value="{{$toDate}}" onchange="todate()" placeholder="Select To Date" autocomplete="off">


                                </div>
                                <small id="todateErr"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>
                              </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">

                              <label>No of Days : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-calendar" aria-hidden="true"></i>

                                </div>
                                
                                <input type="text" id="no_of_days" name="no_of_days" class="form-control  pull-left" value="{{$leaveTrasData->NO_OF_DAYS}}" placeholder="No Of Days" readonly>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-3">
                          <div class="form-group">

                              <label>Reason of leave : 
                                
                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                
                                <textarea type="text" id="reason_leave"  rows="1" name="reason_leave" class="form-control  pull-left" value="{{$leaveTrasData->REASON_LEAVE}}" placeholder="Reason Leave" >{{$leaveTrasData->REASON_LEAVE}}</textarea autocomplete="off">
                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('reason_leave', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                            </div>  
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">

                                  <label>Contact Details : <span class="required-field"></span>
                                  </label>

                                  <div class="input-group">

                                    <div class="input-group-addon">

                                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                    </div>
                                    
                                    <input type="text" id="contact_details" name="contact_details" class="form-control  pull-left" value="{{$leaveTrasData->CONTACT}}" placeholder="Contact Details" autocomplete="off" >
                                   </div>

                                   <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('contact_details', '<p class="help-block" style="color:red;">:message</p>') !!}

                                    </small>


                            </div>  
                            </div>

                            <div class="col-md-3">
                              <div class="form-group">

                                <label>Approved  : 

                                  <span class="required-field"></span>

                                </label>

                                <div class="input-group">

                                  <input type="text"  id="approved" name="approved" class="form-control pull-left" value="{{$leaveTrasData->APPROVE}}">
                                  

                                </div>
                              
                              
                                <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('signature', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>

                            </div>
                            </div>

                          
                         
                        </div> 
                        

                        <div class="row">

                         

                          

                          

                            

                            
                           

                        </div>

                        

            					  <div class="row text-center">

                            <button type="submit" class="btn btn-info" style="margin-top: 12px;width: 130px;" id="nextbtn" >Update &nbsp;&nbsp;<i class="fa fa-save" aria-hidden="true"></i></button>

                        </div> <!-- row -->
                        </form>
                      </div>
                      
                    </div>
                      
                  </div>
                   
                </div><!-- ./panel with-nav-tabs panel-info -->

              </div><!-- ./col -->

            </div><!-- ./row -->

          </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->


  

</div>



@include('admin.include.footer')


<script type="text/javascript">

  $( window ).on( "load", function() {

    var fromdate = $('#fy_fromdate').val();

    var fdate = new Date(fromdate);

    var todate = $('#fy_todate').val();

    var tdate =  new Date(todate);

   

    $('.fydatepicker').datepicker({

      format: 'dd-mm-yyyy',

      todayHighlight: 'true',

      startDate : fdate,

      endDate : tdate,

      autoclose: 'true',



    });

    var series_list = $("#series_code").val();
    var plant_list = $("#plant_code").val();
   
    if(series_list == ''){
     $('#series_code').css('border-color','#ff0000').focus();
    }
    else if(plant_list == ''){
       $('#series_code').css('').focus();
     $('#plant_code').css('border-color','#ff0000').focus();
    }

  })

  function funSeriescode(){
    var series_list = $("#series_code").val();
    var plant_list = $("#plant_code").val();
    if(series_list == ''){
      $('#series_code').css('border-color','#ff0000').focus();
    }
    else{
     $('#series_code').css('border-color', '#d2d6de');
      if(plant_list == ''){
       $('#plant_code').css('border-color','#ff0000').focus();
      }

    }

  }

  function funPlantcode(){
    var plant_list = $("#plant_code").val();
    var emp_list = $("#emp_code").val();

     if(plant_list == ''){
      $('#plant_code').css('border-color','#ff0000').focus();
    }
    else{
     $('#plant_code').css('border-color', '#d2d6de');
     if(emp_list == ''){
      $('#emp_code').css('border-color','#ff0000').focus();
     }
    }

  }

  function funEmpname(){
  	 var emp_list = $("#emp_code").val();
  	 var leave_list = $("#type_of_leave").val();

     if(emp_list == ''){
      $('#emp_code').css('border-color','#ff0000').focus();
    }
    else{
     $('#emp_code').css('border-color', '#d2d6de');
     if(leave_list == ''){
      $('#type_of_leave').css('border-color','#ff0000').focus();
     }
    }

  }

  function funLeavelist(){
    var leave_list = $("#type_of_leave").val();
    var from_date = $("#from_date").val();

     if(leave_list == ''){
      $('#type_of_leave').css('border-color','#ff0000').focus();
    }
    else{
     $('#type_of_leave').css('border-color', '#d2d6de');
     if(from_date == ''){
      $('#from_date').css('border-color','#ff0000').focus();
     }
    }

  }

  

   function todayDate(){
   var todayleave_trans_date = $("#todayleave_trans_date").datepicker('getDate');

   var currentDate = new Date();
  
   console.log('todayleave_trans_date',todayleave_trans_date);
   console.log('currentDate',currentDate);

   if(todayleave_trans_date > currentDate){
     $('#todayleave_trans_dateErr').html('Transaction Leave Date Can Not Be Greater Than Today').css('color','red');
   }
   else{
     $('#todayleave_trans_dateErr').html('');
   }
  }

  function fromdate(){
   var fromDate = $("#from_date").datepicker('getDate');
   var toDate   = $("#to_date").val();

   
    if(fromDate == ''){
      $('#from_date').css('border-color','#ff0000').focus();
    }
    else{
     $('#from_date').css('border-color', '#d2d6de');

     if(toDate == ''){
      $('#to_date').css('border-color','#ff0000').focus();
     }
     
    }

   

  }

  function todate(){
   var fromDate 		= $("#from_date").datepicker('getDate');
   var toDate   		= $("#to_date").datepicker('getDate');
   var reason_leave     = $("#reason_leave").val();
   
   // var fromDate  = new Date(startdate);
   // var toDate    = new Date(enddate);

   console.log('fromDate',fromDate);
   console.log('toDate',toDate);

   if(toDate == ''){
      $('#to_date').css('border-color','#ff0000').focus();
    }
    else{
     $('#to_date').css('border-color', '#d2d6de');

    }

   if(toDate < fromDate){
     $('#todateErr').html('Select Greater Date from From Date').css('color','red');
     $('#no_of_days').val('');
   }else if(fromDate > toDate){
     $('#fromdateErr').html('Select Smaller Date from To Date').css('color','red');
     $('#no_of_days').val('');
   }
   else{

     $('#fromdateErr').html('');
     $('#todateErr').html('');

    var diffTime = Math.abs(toDate - fromDate);

   var diffDays = Math.floor((toDate.getTime() - fromDate.getTime()) / 86400000)+1;  

   $('#no_of_days').val(diffDays);

   console.log(diffDays,"days");
   }

   
   
  }

  

  
  
  
$(document).ready(function(){

    $('.transdatepicker').datepicker({
      format: "dd-mm-yyyy",
      autoclose:true,
      

   });

});

</script>













@endsection