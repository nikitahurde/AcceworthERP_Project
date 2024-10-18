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

       Master P-TAX

        <small>Add Details</small>

      </h1>

      <ul class="breadcrumb">

        <li>

          <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>

        </li>

        <li>

          <a href="{{ url('/dashboard') }}">Master</a>

        </li>

        <li class="active">

          <a href="#"> Master P-TAX</a>

        </li>
        <li class="active">

          <a href="#"> Add P-TAX</a>

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

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Add P-TAX </h2>

            <div class="box-tools pull-right">

                <a href="#" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View P-TAX</a>

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

                  <div class="panel-body">

                    <div class="tab-content">

                      <div class="tab-pane fade in active" id="tab1info">
                      
                       <form action="{{ url('/Master/Employee/p-tax-save') }}" method="POST" enctype="multipart/form-data">

                         @csrf
                        <div class="row">
                           
                          <div class="col-md-4">

                            <div class="form-group">
                              
                              <label>Company Code: <span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                                <input type="text" class="form-control" name="comp_name" id="comp_name"value="{{$compName}}" readonly>
                                <input type="hidden" class="form-control" name="comp_code" id="comp_code"value="{{$comp_code}}" readonly>

                              </div>
                              <small id="comp_nameErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('comp_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>FY Code: <span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                                <input type="text" class="form-control" name="fy_code" id="fy_code"value="{{$fisYear}}" readonly>

                              </div>

                              <small id="fy_codeErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('fy_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                          </div>

                          <div class="col-md-3 TaxCodeMargin">

                          <div class="form-group">

                          <label>PFCT Code : <span class="required-field"></span></label>

                           <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input list="pfct_list"  id="pfct_code" name="pfct_code" class="form-control  pull-left"  placeholder="Select PFCT Code" autocomplete="off">

                            <datalist id="pfct_list">

                              @foreach($pfct_list as $rows)

                                <option value="{{ $rows->PFCT_CODE }}" data-xyz ="{{ $rows->PFCT_NAME }}">{{ $rows->PFCT_CODE }} = {{ $rows->PFCT_NAME }}</option>
                                             

                              @endforeach

                            </datalist>
                            
                            <input type="hidden" name="pfct_name" id="pfct_name" value=""> 

                          </div>
                          <small> 

                              <div class="pull-left showSeletedName" id="taxText"></div>

                             </small>

                          <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('pfct_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                        </div>



                          <!-- /.form-group -->

                      </div>

                        </div>

                        <div class="row">
                          
                          <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>APRIL <span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="april" id="april" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="aprilErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('april', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>MAY <span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="may" id="may" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="mayErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('may', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>JUNE <span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="jun" id="jun" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="junErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('jun', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                          </div>

                          <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>JULY <span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="jul" id="jul" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="julErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('jul', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                          </div>

                        <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>AUGUST <span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="aug" id="aug" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="augErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('aug', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>SEPTEMBER <span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="sep" id="sep" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="sepErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('sep', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>OCTOBER <span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="oct" id="oct" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="octErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('oct', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>NOVEMBER<span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="nov" id="nov" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="novErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('nov', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>DECEMBER <span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="dec" id="dec" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="decErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('dec', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>JANUARY<span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="jan" id="jan" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="janErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('jan', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>FEBRUARY<span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="feb" id="feb" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="febErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('feb', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>MARCH<span class="required-field"></span>
                              </label>

                              <div class="input-group">

                                
                                <input type="text" class="form-control" name="mar" id="mar" value="" autocomplete="off" oninput="funtotal()">

                              </div>

                              <small id="marErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('mar', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                        </div>

                        <div class="col-md-2">

                            <div class="form-group">
                              
                              <label>TOTAL </label>

                              <div class="input-group">

                                <input type="text" class="form-control" name="total" id="total" value="0" readonly>

                              </div>

                              <small id="totalErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('total', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>

                        </div>

                       </div>

                        <div class="row">
                          <center>
                            <button class="btn btn-success" type="submit">Save</button>
                          </center>
                        </div>

                        

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

function funtotal(){
  var apr = $('#april').val();
  var may = $('#may').val();
  var jun = $('#jun').val();
  var jul = $('#jul').val();
  var aug = $('#aug').val();
  var sep = $('#sep').val();
  var oct = $('#oct').val();
  var nov = $('#nov').val();
  var dec = $('#dec').val();
  var jan = $('#jan').val();
  var feb = $('#feb').val();
  var mar = $('#mar').val();
  


  var total = 0;
  if(apr != ''){
    total = parseFloat(total) + parseFloat(apr);
    
  }

  if(may != ''){
    total = parseFloat(total) + parseFloat(may);
  }

  if(jun != ''){
    total = parseFloat(total) + parseFloat(jun);
  }

  if(jul != ''){
    total = parseFloat(total) + parseFloat(jul);
  }

  if(aug != ''){
    total = parseFloat(total) + parseFloat(aug);
  }

  if(sep != ''){
    total = parseFloat(total) + parseFloat(sep);
  }

  if(oct != ''){
    total = parseFloat(total) + parseFloat(oct);
  }

  if(nov != ''){
    total = parseFloat(total) + parseFloat(nov);
  }

  if(dec != ''){
    total = parseFloat(total) + parseFloat(dec);
  }

  if(jan != ''){
    total = parseFloat(total) + parseFloat(jan);
  }

  if(feb != ''){
    total = parseFloat(total) + parseFloat(feb);
  }

  if(mar != ''){
    total = parseFloat(total) + parseFloat(mar);
  }

  $('#total').val(total);
}

$("#pfct_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#pfct_list option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';
        
        if(msg == 'No Match'){

          $('#pfct_code').val('');
          $('#pfct_name').val('');

        }else{

          $('#pfct_name').val(msg);

        }


    });
</script>

@endsection