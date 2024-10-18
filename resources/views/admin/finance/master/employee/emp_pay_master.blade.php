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

       Master Employee Pay 

        <small>Add Details</small>

      </h1>

      <ul class="breadcrumb">

        <li>

          <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>

        </li>

        <li>

          <a href="{{ url('/dashboard') }}">Master</a>

        </li>

        <li>

          <a href="{{ url('/dashboard') }}">Employee Pay Master</a>

        </li>

        <li class="active">

          <a href="{{ url('/finance/form-transaction-mast') }}">Add Employee Pay </a>

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

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Employee Pay Master</h2>

            <div class="box-tools pull-right">

                <a href="{{url('/Master/Employee/View-Emp-Pay-Mast')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Employee Pay Master</a>

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
                      
                       <form action="{{ url('/Master/Employee/emp-pay-save') }}" method="POST" enctype="multipart/form-data">

                         @csrf
                        <div class="row">
                              <!-- /.col -->
                          <div class="col-md-3">

                            <div class="form-group">
                              
                              <label>Date: <span class="required-field"></span></label>

                              <div class="input-group">
                                <?php $CurrentDate =date("d-m-Y"); ?>

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control  fydatepicker rightcontent" name="vr_date" id="vr_date"value="{{$CurrentDate}}" onchange="todayDate()">

                               
                              </div>
                              <small id="vr_dateErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
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

                                  <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                                </div>
                                
                                <input list="emp_list" id="emp_code" name="emp_code" class="form-control  pull-left" value="{{old('empname')}}" placeholder="Employee Code" autocomplete="off" >

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

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Employee Name : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>
                                
                                <input  id="emp_name" name="emp_name" class="form-control  pull-left" value="{{old('emp_name')}}" placeholder="Employee Name" autocomplete="off" readonly>

                                

                              </div>
                            </div>
                            
                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Employee Grade : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>
                                
                                <input  id="emp_grade" name="emp_grade" class="form-control  pull-left" value="{{old('emp_grade')}}" placeholder="Employee Grade" autocomplete="off" readonly>

                                <input type="hidden" id="grade_name" name="grade_name" value="">

                                

                              </div>
                            </div>
                            
                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Plant Code: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input list="plant_list" class="form-control" id="plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="{{old('PlantCode')}}" autocomplete="off" oninput="funPlantcode()" readonly>
                                
                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('PlantCode', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>
                                <!-- /.form-group -->
                          </div>
                          
                          

                         
                          <!-- /.col -->
                       <!--  </div> -->
                           <!-- /.row -->

                        <!-- <div class="row"> -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Plant Name: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input  class="form-control" id="plantName" name="plant_name" placeholder="Plant Name" value="{{old('plant_name')}}" readonly>

                              </div>

                            </div>
                                <!-- /.form-group -->
                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Profit Center Code: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input list="profitList"  id="profitcen_code" name="profitcen_code" class="form-control  pull-left" value="{{old('profitcen_code')}}" placeholder="Profit Center Code" readonly>
                        
                              </div>

                            </div>
                            
                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Profit Center Name: <span class="required-field"></span></label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input  id="profitcenter_name" name="profitcenter_name" class="form-control  pull-left" value="{{old('profitcenter_name')}}" placeholder="Profit Center Name" readonly>

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

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>
                                
                                <input id="desig_code" name="designation" class="form-control  pull-left" value="{{old('designation')}}" placeholder="Designation"  readonly>

                                <input type="hidden" id="desig_name" name="desig_name" value="">

                              </div>
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
                                
                                <input type="text" id="from_date" name="from_date" class="form-control  pull-left transdatepicker" value="{{old('from_date')}}" placeholder="From Date" onchange="fromdate()" autocomplete="off" disabled>


                              </div>

                              <small id="fromdateErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>
                          </div>


                         
                           <!-- /.col -->

                          <div class="col-md-3">
                            <div class="form-group">

                              <label>To Date : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-calendar" aria-hidden="true"></i>

                                </div>
                                
                                <input type="text" id="to_date" name="to_date" class="form-control  pull-left todatepicker" value="{{old('to_date')}}" onchange="todate()" placeholder="To Date" autocomplete="off" disabled>


                                </div>
                                <small id="todateErr"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">

                                <label>CTC : 

                                  <span class="required-field"></span>

                                </label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                                  </div>

                                   <input type="text" id="basic" name="basic" class="form-control  pull-left" value="{{old('basic')}}" placeholder="basic" autocomplete="off" oninput="funbasiccal()" disabled>
                                   </div>

                                  <!-- <input type="text" id="signature" name="signature" class=" pull-left" value="" class="form-control  pull-left"> -->
                                </div>
                                <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('signature', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>

                            </div>

                          </div>

                          
                         <div class="row">

                         <div class="col-md-1">

                             <input type="hidden" id="data_count1" class="dataCountCl" value="0" name="data_Count[]">

                              <input type="hidden" class="setGrandAmnt" id="get_grand_num1" name="crAmtPerItm[]">

                               <button class="btn btn-primary btn-sm" type="button"  disabled="true" id="calbasic" data-toggle="modal" data-target="#cal_basic" onclick="CalculateBasic(1);getTotal();">calc</button>

                               <div id="aplytaxOrNot1" class="aplynotStatus">0</div>
                           <div id="appliedbEmpPay1"></div>
                           <div id="cancelbtn1"></div>
                          
                         </div>

                            

                          <div class="modal fade" id="cal_basic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">

                                  <div class="modal-dialog" role="document" style="margin-top: 5%;">

                                    <div class="modal-content" style="border-radius: 5px;">

                                      <div class="modal-header">

                                        <div class="row">

                                          
                                          <div class="col-md-5">
                                            <div class="form-group">
                                                <lable class="settaxcodemodel col-md-6" style="padding: 0px;">Grade Code - </lable>
                                                         
                                                <input type="text" class="settaxcodemodel col-md-6" id="grade_code" style="border: none; padding: 0px;" readonly>
                                            </div>
                                          </div>
                                          
                                          <div class="col-md-6">
                                            <h5 class="modal-title modltitletext" id="exampleModalLabel">Pay / Charges / etc Calculation</h5>
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
                                          width: 15%; 
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

                                      <div class="modal-body table-responsive" style="height: 70vh;overflow-y: auto;">
                                          <div class="modalspinner hideloaderOnModl"></div>
                                          <div class="boxer" id="basic_rate">
                                              

                                          </div>
                                          <div class="boxer" id="basic_rate_body"></div>

                                      </div>

                                      <div class="modal-footer">

                                        <div class="row col-md-12" id="balanceRow1"></div>

                                        <center>
                                        <span  id="footer_modal_pay1" style="width: 56px;"></span>
                                      <!--  <button class="btn btn-primary">cal</button> -->
                                      </center>
                                      
                                      </div>

                                    </div>

                                  </div>

                                </div>
                          </div>

                        </div>

                        <div class="row text-center">

                            <button type="submit" class="btn btn-success" style="margin-top: 12px;" id="submitdata" disabled><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                             <button type="button" class="btn btn-warning" style="margin-top: 12px;" id="nextbtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>

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

    

    $('#emp_code').css('border-color','#ff0000').focus();

   

    $('.fydatepicker').datepicker({

      format: 'dd-mm-yyyy',

      todayHighlight: 'true',

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

  

  function funbasiccal(){
    var basic = $("#basic").val();
    // console.log('basic',basic);
   
    if(basic == ''){
      $('#calbasic').prop('disabled',true);
  }
    else{
     $('#calbasic').prop('disabled',false);
     $('#basic').css('border-color', '#d2d6de');
     
    }

  }

  function changeIndicatore(ratecode){
   
     $('#indicatorShow_'+ratecode).modal('show');

     var already_ind = $('#rate_code_'+ratecode).val();

      for(var w=1;w<=9;w++){

        var setInd = $('#cInd_'+ratecode+'_'+w).val();
      
        if(already_ind == 'N' || already_ind == 'O' || already_ind == 'P' || already_ind=='Q' || already_ind=='R' || already_ind == 'N'){
                if(setInd == 'L' || setInd == 'M' || setInd == 'Z'){
                  $('#cInd_'+ratecode+'_'+w).prop('disabled',true);
                }
                
        }else{}

        if(already_ind == 'L' || already_ind == 'M'){
            if(setInd == 'N' || setInd == 'O' || setInd == 'P' || setInd=='Q' || setInd=='R' || setInd == 'N' || setInd == 'Z' || setInd == 'A'){
              $('#cInd_'+ratecode+'_'+w).prop('disabled',true);
            }
        }

        if(setInd == already_ind){

              $('#cInd_'+ratecode+'_'+w).prop('checked',true);

         }

      }
    
  }

  function setIndOnOk(indid){

   var ind_value= $("input[type='radio'][name='chang_indval']:checked").val();
   
    $('#rate_code_'+indid).val(ind_value);

    $('#indicatorShow_'+indid).modal('hide');



  }

  

  function getTotal(){



    setTimeout(function() {

      $('.modalspinner').addClass('hideloaderOnModl');

      totalAmount = 0;
      $("#balance").val('0');


      for(l=2;l<=20;l++){

        indicator = $("#wage_ind_"+l).val();       
 
        rate_code = $("#rate_code_"+l).val();   
        rate = $("#rate_"+l).val();   

        logic = $("#logic_"+l).val();
       
        static = $('#static_'+l).val();
 
        if(logic == null){

        }else{ 
         
          if(logic.length >0){

           
            indicatorCalculation(indicator,rate_code,rate,logic,l);
            getspcAllownce(indicator,rate_code,rate,logic,l);
            

          }
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

 function CalculateBasic(payid){

    

     var emp_grade = $("#emp_grade").val();
     var emp_code = $("#emp_code").val();
     
     var basic_amt = parseFloat($("#basic").val());

    

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

                         var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Wage Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div><div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div></div><div class='box-row'><div class='box10 texIndbox'><input type='text' id='wage_ind_1' name='head_wage_ind[]' class='form-control inputtaxInd' style='z-index: 0;' value='CTC' readonly><input type='hidden' id='wageInd_type_1' name='wageInd_type[]' class='form-control inputtaxInd' style='z-index: 0;' value='NONE'><input type='hidden' id='wageInd_name_1' name='wageInd_name[]' class='form-control inputtaxInd' style='z-index: 0;' value='CTC'><input type='hidden' id='wageInd_monOrYr_1' name='wageInd_monOrYr[]' class='form-control inputtaxInd' style='z-index: 0;' value='None'></div><div class='box10 rateBox'><input type='text' id='rate_code_1' name='rate_code[]' class='form-control' value='-----' readonly></div><div class='box10 rateBox'><input  type='text' id='rate_1' name='rate[]' class='form-control' value='-----' readonly><input  type='hidden' id='logic_1' name='logic[]' class='form-control' value='-----' readonly></div><div class='box10 amountBox'><input type='text' class='form-control text-right' id='amt_1' value="+basic_amt.toFixed(2)+" name='amount[]' readonly></div></div>";

                          $('#basic_rate').append(TableHeadData);
                         var counter = 2;
                         var dd=2;

                          var countI ='';
                          var dataI ='';

                         $.each(obj.data.wagetype_data, function(k, getData) {

                            var datacount = obj.data.length;
                            dataI = datacount;
                            
                            $('#grade_code').val(getData.GRADE_CODE);
                           

                            if(getData.RATE_CODE == 'M' || getData.RATE_CODE == 'L'){

                              
                              var TableData = "<div class='box-row' id='basicrows'><div class='box10 texIndbox'><input type='text' id='wage_ind_"+counter+"' name='head_wage_ind[]' class='form-control inputtaxInd' style='z-index: 0;' value="+getData.WAGEIND_CODE+" readonly><input type='hidden' id='wageInd_type_"+counter+"' name='wageInd_type[]' class='form-control inputtaxInd' style='z-index: 0;' value="+getData.WAGEIND_TYPE+"><input type='hidden' id='wageInd_name_"+counter+"' name='wageInd_name[]' class='form-control inputtaxInd' style='z-index: 0;' value=\'"+getData.WAGEIND_NAME+"\'><input type='hidden' id='wageInd_monOrYr_"+counter+"' name='wageInd_monOrYr[]' class='form-control inputtaxInd' style='z-index: 0;' value=\'"+getData.MONTH_OR_YEAR+"\'></div><div class='box10 rateIndbox'><input type='text' id='rate_code_"+counter+"' name='rate_code[]' class='form-control inputwageInd' value="+getData.RATE_CODE+" readonly><input type='hidden' id='static_"+counter+"' name='static[]' class='form-control inputwageInd' value="+getData.STATIC+" readonly><label class='label label-success showind_Ch' type='button' id='btnchange"+counter+"'  onclick='changeIndicatore("+counter+")'>Change</label></div><div class='box10 rateBox '><input type='text' id='rate_"+counter+"' name='rate[]' class='form-control text-right inputwageInd' value="+getData.RATE+" readonly oninput='getTotal();'><input type='hidden' id='logic_"+counter+"' name='logic[]' class='form-control inputwageInd' value="+getData.LOGIC+" readonly></div><div class='box10 amountBox'><input type='text' id='amt_"+counter+"'  name='amount[]'class='form-control text-right' oninput='getTotal();' autocomplete='off'></div></div><div id='indicatorShow_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+counter+")'>Apply</button></div></div></div></div>";

                            }else{

                            

                               var TableData = "<div class='box-row' id='basicrows'><div class='box10 texIndbox'><input type='text' id='wage_ind_"+counter+"' name='head_wage_ind[]' class='form-control inputtaxInd' style='z-index: 0;' value=\""+getData.WAGEIND_CODE+"\" readonly><input type='hidden' id='wageInd_type_"+counter+"' name='wageInd_type[]' class='form-control inputtaxInd' style='z-index: 0;' value="+getData.WAGEIND_TYPE+"><input type='hidden' id='wageInd_name_"+counter+"' name='wageInd_name[]' class='form-control inputtaxInd' style='z-index: 0;' value=\'"+getData.WAGEIND_NAME+"\'><input type='hidden' id='wageInd_monOrYr_"+counter+"' name='wageInd_monOrYr[]' class='form-control inputtaxInd' style='z-index: 0;' value=\'"+getData.MONTH_OR_YEAR+"\'></div><div class='box10 rateIndbox'><input type='text' id='rate_code_"+counter+"' name='rate_code[]' class='form-control inputwageInd' value="+getData.RATE_CODE+" readonly><input type='hidden' id='static_"+counter+"' name='static[]' class='form-control inputwageInd' value="+getData.STATIC+" readonly><label class='label label-success showind_Ch' type='button' id='btnchange"+counter+"'  onclick='changeIndicatore("+counter+")'>Change</label></div><div class='box10 rateBox '><input type='text' id='rate_"+counter+"' name='rate[]' class='form-control text-right inputwageInd' value="+getData.RATE+" readonly oninput='getTotal();'><input type='hidden' id='logic_"+counter+"' name='logic[]' class='form-control inputwageInd' value="+getData.LOGIC+" readonly></div><div class='box10 amountBox'><input type='text' id='amt_"+counter+"'  name='amount[]'class='form-control text-right'  readonly></div></div><div id='indicatorShow_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><div class='row'></div><button type='button' class='btn btn-primary' onclick='setIndOnOk("+counter+")'>Apply</button></div></div></div></div>";
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

                           var tblfootData = "<input type='hidden' id='balance' name='balance' value='0'><button type='button' class='btn btn-primary ' style='width: 10%;' data-dismiss='modal' id='ApplyOkbtn' onclick='OkGetTransVal("+payid+","+dataI+","+countI+",1);'>Ok</button></div>";
                               
                              $('#balanceRow'+payid).html(tblfootDataL);
                              $('#footer_modal_pay'+payid).html(tblfootData);

                            

                           }else{
                            
                           }

              }


            }
        })

     
   }

function getspcAllownce(indicator,rate_code,rate,logic,l){
    
  var basic_val = $("#amt_1").val();
   
    for(l=2;l<=20;l++){

     var indicator = $("#wage_ind_"+l).val(); 
     
     if(indicator == 'ST'){

      var subtoalval = $("#amt_"+l).val();
     
     }

     if(indicator == 'Special All'){

      var specialAll = basic_val - subtoalval;

      $("#amt_"+l).val(specialAll.toFixed(2));
     }
        
    }
}

function indicatorCalculation(indicator,rate_code,rate,logic,l,basic_val){
   
  var totalLogicVal = 0;

  var logicTemp = logic;

  var sliceval = logic.split(",");
   
  for(j=0; j<sliceval.length; j++){
        
    k = sliceval[j];
    
    var BlocValue = $("#amt_"+k).val();
    
    if(BlocValue!="")

      totalLogicVal = parseFloat(totalLogicVal) + parseFloat(BlocValue);
  }

  if(rate_code == 'A'){

    roundofrate= ((parseFloat(totalLogicVal) * rate)/100);
    
    roundof= Math.round(roundofrate) - parseFloat(totalLogicVal);
    
    $("#amt_"+l).val(roundof.toFixed(2));
 
  }
  
  if(rate_code=="N"){

    amtMinus= -((parseFloat(totalLogicVal) * rate)/100);    

    $("#amt_"+l).val(amtMinus.toFixed(2));

  }

  var inde_M_amt = parseFloat($("#amt_"+l).val());
 
  if(isNaN(inde_M_amt)){

    indm = '';

    $("#amt_"+l).val(indm);

  }else{

    if(rate_code=="M"){

      var lumMinus; 

      lumMinus= parseFloat($("#amt_"+l).val()); 

      if(lumMinus > 0){

        var indicatorMAmt1=  -(lumMinus);

      }else if(lumMinus < 0){

            var indicatorMAmt1=  (lumMinus);

      }
         
      indicatorMAmt = indicatorMAmt1;

      $("#amt_"+l).val(indicatorMAmt);

    }
  }

  if(rate_code=="P"){

    addition = ((parseFloat(totalLogicVal) * rate)/100);    

    $("#amt_"+l).val(addition.toFixed(2));

  }

  if(rate_code=="Q"){

    additionRoundOff = ((parseFloat(totalLogicVal) * rate)/100);    

    $("#amt_"+l).val(Math.round(additionRoundOff.toFixed(2)));
         

  }

  if(rate_code=="Z"){
          
    subtotalview = ((parseFloat(totalLogicVal) * rate)/100);

    $("#amt_"+l).val(subtotalview.toFixed(2));
    
    if(indicator == 'Special All'){
     
      var specAll = basic_val -subtotalview;
      
      $("#amt_"+l).val(subtotalview.toFixed(2));
    }

  }

      
  if(rate_code=="O"){

    deductionRoundOff = -((parseFloat(totalLogicVal) * rate)/100);    

    $("#amt_"+l).val(Math.round(deductionRoundOff.toFixed(2)));

  }

  var wageType =  $("#wageInd_type_"+l).val();
  
  var wageIndc =  $("#wage_ind_"+l).val();
   
  var totlGet =0;
  
  var totalBalAmt;

  if(l > 1){

    if(wageIndc!='NP'){

      var earningAmt=  $("#amt_"+l).val();
      
      var totalearn=  $("#balance").val();
      
      var ctcAmount=  $("#amt_1").val();
      
      if(earningAmt == ''){

          var ctcAmnt= 0;

      }else{

          var ctcAmnt= earningAmt;
      }

      totlGet = parseFloat(totalearn) + parseFloat(ctcAmnt);
     
      $("#balance").val(totlGet);

      tlBalAmt = $("#balance").val();

      totalBalAmt = parseFloat(ctcAmount) - parseFloat(tlBalAmt);
      $("#balVal").text(totalBalAmt);

    }
  
  }

}

function OkGetTransVal(aplyid,datacount,countercount,staticvalue){

  if(staticvalue==1){

    $('#aplytaxOrNot'+aplyid).html('1');

    $('#cancelbtn'+aplyid).html('');

    $('#appliedbEmpPay'+aplyid).html('');

    var appliedbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';

          
    $('#appliedbEmpPay'+aplyid).html(appliedbtn);

    $('#submitdata').prop('disabled', false);
   
    $('#data_count'+aplyid).val(datacount);

    if(countercount == datacount){
    
      var g_Amnt = $('#amt_'+aplyid).val();
      
      $('#get_grand_num'+aplyid).val(g_Amnt);
    }

    $('#vr_date').prop('readonly', true);

    $('#from_date').prop('readonly', true);

    $('#to_date').prop('readonly', true);

    $('#basic').prop('readonly', true);

    $('#emp_code').prop('readonly', true);
  
  }

}


function funPlantcode(){

  var plant_list = $("#plant_code").val();

  var emp_list = $("#emp_code").val();

  if(plant_list == ''){
      $('#plant_code').css('border-color','#ff0000').focus();
  }else{

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

  }else{

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

  }else{

   $('#type_of_leave').css('border-color', '#d2d6de');
   
   if(from_date == ''){
    $('#from_date').css('border-color','#ff0000').focus();
   }

  }
}

function todayDate(){
   
  var vr_date = $("#vr_date").datepicker('getDate');

  var currentDate = new Date();
  
  if(vr_date > currentDate){

     $('#vr_dateErr').html('Transaction Leave Date Can Not Be Greater Than Today').css('color','red');

  }else{

     $('#vr_dateErr').html('');
  }
}

function fromdate(){

  var fromDate = $("#from_date").datepicker('getDate');
  var toDate   = $("#to_date").val();

  if(fromDate == ''){

    $('#from_date').css('border-color','#ff0000').focus();
    
    $('#to_date').val('');
    
    $('#to_date').prop('disabled', true);
  
  }else{

    $('#from_date').css('border-color', '#d2d6de');
    
    $('#to_date').prop('disabled', false);

    if(toDate == ''){
      $('#to_date').css('border-color','#ff0000').focus();
    }
     
  }
}

function todate(){

  var fromDate     = $("#from_date").datepicker('getDate');
  
  var toDate       = $("#to_date").datepicker('getDate');
  
  var reason_leave     = $("#reason_leave").val();
   
  if(toDate == ''){

      $('#to_date').css('border-color','#ff0000').focus();
  
  }else{

   $('#to_date').css('border-color', '#d2d6de');
   
   $('#basic').css('border-color','#ff0000').focus();
   
   $('#basic').prop('disabled', false);

  }

  if(toDate < fromDate){
    
    $('#todateErr').html('Select Greater Date from From Date').css('color','red');
    
    $('#no_of_days').val('');
  
  }else if(fromDate > toDate){
    
    $('#fromdateErr').html('Select Smaller Date from To Date').css('color','red');
    
    $('#no_of_days').val('');
  
  }else{

    $('#fromdateErr').html('');
    
    $('#todateErr').html('');

    var diffTime = Math.abs(toDate - fromDate);

    var diffDays = Math.floor((toDate.getTime() - fromDate.getTime()) / 86400000)+1;  

   $('#no_of_days').val(diffDays);

   
  }
}

$(document).ready(function(){

$('.transdatepicker').datepicker({
      format: "dd-mm-yyyy",
      autoclose:true,
      

});

$('.todatepicker').datepicker({
      
      format: "dd-mm-9999",
      
      autoclose:true,

});

$("#series_code").bind('change', function () {  

  var val = $(this).val();
  
  var xyz = $('#series_list option').filter(function() {

  return this.value == val;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';
  
  if(msg == 'No Match'){
    
    $(this).val('');
    
    $('#seriesName').val('');

  }else{

  $('#seriesName').val(msg);

  }

});
      
$("#emp_code").bind('change', function () {  

  var val = $(this).val();
  
  var xyz = $('#emp_list option').filter(function() {

  return this.value == val;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';
  
  if(msg == 'No Match'){
    
    $(this).val('');

    $('#desig_code').val('');
    
    $('#desig_name').val('');

    $('#plant_code').val('');

    $('#profitcen_code').val('');

    $('#emp_name').val('');

    $('#emp_grade').val('');
    
    $('#grade_name').val('');

    $('#plantName').val('');

    $('#profitcenter_name').val('');

    $('#from_date').prop('disabled', true);

    $('#from_date').val('');

    $('#emp_code').css('border-color','#ff0000').focus();

    $('#from_date').css('border-color', '#d2d6de');
      
  }else{

    $('#emp_code').css('border-color', '#d2d6de');

    $('#from_date').prop('disabled', false);

    $('#from_date').css('border-color','#ff0000').focus();
   
    var emp_code = msg;
           
    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }
    });
    
    $.ajax({

      type: 'POST',

      url: "{{ url('/Master/Employee/transaction-emp-designation') }}",

      data: {emp_code:emp_code}, // here $(this) refers to the ajax object not form

      success: function (data) {

      var obj = JSON.parse(data);

      if (obj.response == 'success') {

        $('#desig_code').val(obj.data.DESIG_CODE);

        $('#desig_name').val(obj.data.DESIG_NAME);

        $('#plant_code').val(obj.data.PLANT_CODE);

        $('#profitcen_code').val(obj.data.PFCT_CODE);

        $('#emp_name').val(obj.data.EMP_NAME);

        $('#emp_grade').val(obj.data.GRADE_CODE);
        
        $('#grade_name').val(obj.data.GRADE_NAME);

        $('#plantName').val(obj.data1.plant_name);

        $('#profitcenter_name').val(obj.data1.pfct_name);

        $('#contact_details').val(obj.data.CONTACT_NO);
        
      }else{
                
      }
    },

  });

  }

  });

});

</script>













@endsection