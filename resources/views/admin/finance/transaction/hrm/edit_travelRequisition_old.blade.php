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

        Travel Requisition Form

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

          <a href="#"> Travel Requisition Form</a>

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

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Travel Requisition Form</h2>

            <div class="box-tools pull-right">

                <a href="{{url('/Transaction/TravelRequisition/view-travelRequision')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Travel Requisition</a>

            </div>

          </div><!-- /.box-header -->

          <div id="travelReqSuccessMsg">
                
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

        <form action="#" method="POST" enctype="multipart/form-data" id="travelReqForm">

        @csrf

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
                      
                       

                        
                       <div class="row">
                        
                          <div class="col-md-2">

                            <div class="form-group">

                              <label>Date : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <!-- <?php $CurrentDate =date("d-m-Y"); ?> -->
                                
                                 <input type="text" class="form-control rightcontent" name="travelReqSh_date" id="travelReqSh_date"value="{{$travelReqData->DATE}}" readonly>

                                 <input type="hidden" value="{{$travelReqData->ID}}" name="headId">

                              </div>

                              <small id="travelReqSh_dateErr"></small>
                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('travelReqSh_date', '<p class="help-block" style="color:red;">:message</p>') !!}

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
                              
                                <input list="empList" id="empname" name="empname" class="form-control  pull-left Employee FormTextFirstUpper" value="{{$travelReqData->EMP_NAME}}" placeholder="Enter Employee" autocomplete="off" readonly>

                                <input type="hidden" name="emp_code" value="{{$travelReqData->EMP_CODE}}">

                              
                              </div>

                           <small id="empnameErr"></small>

                           

                          </div>
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
                                
                                <input list="desgList" id="emp_designation" name="desig_code" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{$travelReqData->DESIG_CODE}}" placeholder="Enter Designation" autocomplete="off" readonly>

                                <input type="hidden" name="desig_name" value="{{$travelReqData->DESIG_NAME}}">


                              </div>

                              <small id="emp_designationErr">
                                
                              </small>

                              
                             </div>
                            
                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Age : </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                
                                <input id="age" name="age" class="form-control  pull-left" value="{{$travelReqData->AGE}}" placeholder="Age" autocomplete="off">
                              </div>
 
                             </div>
                            
                          </div>
                        </div>
                        <div class="row">

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Gender : 

                                <span class="required-field"></span>

                              </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                
                               
                                <input class="form-control" list="genderlist" id="gender" placeholder="Type to search..." name="gender" autocomplete="off" value="{{$travelReqData->GENDER}}">

                                <datalist id="genderlist">
                                  <option value="Male">
                                  <option value="Female">
                                </datalist >
                              </div>

                              <small id="genderErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('gender', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                             </div>
                            
                          </div>
                            
                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Function : </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                
                                <input id="functionData" name="functionData" class="form-control  pull-left" value="{{$travelReqData->FUNCTION}}" placeholder="Function" autocomplete="off">
                              </div>
                              
                             </div>
                            
                          </div>

                          <div class="col-md-6">

                            <div class="form-group">

                              <label>Purpose of Travel : </label>

                              <span class="required-field"></span>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                
                                <textarea rows="1" id="pur_travel" name="pur_travel" class="form-control  pull-left" value="{{$travelReqData->PURPOSE_OF_TRAVEL}}" placeholder="Purpose of Travel" autocomplete="off">{{$travelReqData->PURPOSE_OF_TRAVEL}}</textarea>
                              </div>

                              <small id="pur_travelErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('pur_travel', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>


                              
                             </div>
                            
                          </div>
                          </div>

                         <!--  <div class="row col-sm-12">
                            <button class="btn btn-primary" >Next <i class="fa fa-arrow-down"></i></button>
                          </div> -->
                      
                          
                       
                      </div>
                      
                    </div>
                      
                  </div>
                   
                </div><!-- ./panel with-nav-tabs panel-info -->
          
              </div><!-- ./col -->

            </div><!-- ./row -->


           <div id="travelShe">

           <h4 style="font-weight: 700;font-size: 16px;">Travel Shedule</h4>

           <div class="row">
            <div class="col-sm-12">


            <div class="box box-primary Custom-Box">

              <div class="box-body">
                
                <div class="table-responsive">

                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblTravel">

                      <tr>

                        <th><input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row"></th>

                        <th>Sr.No.</th>

                        <th>Date <small style="color:red;font-size:14px;">*</small> </th>

                        <th>Time <small style="color:red;font-size:14px;">*</small></th>

                        <th>Place (From) <small style="color:red;font-size:14px;">*</small></th>

                        <th>Place (To) <small style="color:red;font-size:14px;">*</small></th>

                        <th>Mode Of Transport <small style="color:red;font-size:14px;">*</small></th>
                        
                        <th>Remarks</th>

                      </tr>
                      <?php $srNo=1; ?>
                      @foreach($travelShReqData as $row)

                      <tr class="useful">
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/>
                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <span id='snum'>{{$srNo}}</span>

                          <input type='hidden' name='TravelDetlSlno[]' id='TravelDetlSlno_id' value='{{$srNo}}'>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type='text' name='travelReqDate[]' id='travelReqDate1' value='{{$row->TRAVEL_SHEDULE_DATE}}' class='' style="width:120px;margin-bottom: 5px;" readonly="">

                          <input type="hidden" value="{{$row->ID}}" name="travelShId[]">

                          <small id="travelReqDateErr1"></small>

                        </td>

                       <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                         <input id="tPicker1" type="text" name="tPicker[]" class="tPicker" style="width:120px;margin-bottom: 5px;" value="{{$row->TIME}}">

                         <small id="tPickerErr1"></small>
                            
                       </td>

                       <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type="text" name='placeFrom[]' id='placeFrom1' class="" style="width:120px;margin-bottom: 5px;" value="{{$row->PLACE_FROM}}">

                          <small id="placeFromErr1"></small>

                       </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type="text" name='placeTo[]' id='placeTo1' class="" style="width:120px;margin-bottom: 5px;" value="{{$row->PLACE_TO}}">

                          <small id="placeToErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type="text" name='mode[]' id='mode1' class="" style="width:125px;margin-bottom: 5px;" value="{{$row->MODE_OF_TRANSPORT}}">

                          <small id="modeErr1"></small>
                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <textarea rows="1" type="text" name='travelRemarks[]' id='travelRemarks1' class="" style="width:120px;margin-bottom: 5px;" value="{{$row->REMARKS}}">{{$row->REMARKS}}</textarea>

                          <small id="travelRemarksErr1"></small>
                        </td>

                      </tr>
                      <?php $srNo++; ?>
                      @endforeach

                    </table>

              </div>

<!--               <button type="button" class='btn btn-danger delete' id="deletehidn"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

              <button type="button" class='btn btn-info addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button> -->
             </div>
            </div>
        </div>
      </div>
      </div>

      <h4 style="font-weight: 700;font-size: 16px;">Accommodation Shedule</h4>

           <div class="row">
            <div class="col-sm-12">


            <div class="box box-primary Custom-Box">

              <div class="box-body">
                
                <div class="table-responsive">

                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblAccommo">

                      <tr>

                        <th><input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row"></th>

                        <th>Sr.No.</th>

                        <th>Place <small style="color:red;font-size:14px;">*</small></th>

                        <th>Hotel <span class="required-field"></span></th>

                        <th>Date & Time (From) <small style="color:red;font-size:14px;">*</small></th>

                        <th>Date & Time (To) <small style="color:red;font-size:14px;">*</small> </th>

                        <th>Remarks</th>

                      </tr>
                      <?php $srNo=1; ?>
                      @foreach($traReqAccoData as $row)
                       
                      <tr class="useful">
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <input type='checkbox' class='case' title="Delete Single Row"/>
                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <small id='snum'>{{$srNo}}</small>

                          <input type='hidden' name='AccoDetlSlno[]' id='AccoDetlSlno_id' value='1'>



                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type='text' name='place_id[]' id='place_id1' value='{{$row->PLACE}}'style="width:120px;margin-bottom: 5px;">

                          <input type="hidden" value="{{$row->ID}}" name="travelAccoId[]">

                          <small id="place_idErr1"></small>

                        </td>

                       <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                         <input id="hotel_id1" name="hotel_id[]" type="text" style="width:120px;margin-bottom: 5px;" value="{{$row->HOTEL}}">

                         <small id="hotel_idErr1"></small>
                            
                       </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <!-- <input type="text" name='dtFrom[]' id='dtFrom1' class="" style="width:120px;margin-bottom: 5px;"> -->

                          <input id="FromDate1" name="FromDate[]" style="width:130px;" type="" value="{{$row->DATE_TIME_FROM}}" class="FromDate" readonly="">


                          <small id="dtFromErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <input type="text" name='dtTo[]' id='dtTo1' class="FromDate" style="width:130px;margin-bottom: 5px;" value="{{$row->DATE_TIME_TO}}" readonly="">

                          <small id="dtToErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <textarea rows="1" type="text" name='tblAccoremark[]' id='tblAccoremark1' class="" style="width:120px;margin-bottom: 5px;" value="{{$row->PLACE}}">{{$row->REMARKS}}</textarea>

                          <small id="tblAccoremarkErr1"></small>
                     

                        </td>

                      </tr>
                      <?php $srNo++; ?>

                      @endforeach

                    </table>

              </div>

             </div>
             </div>
            </div>
        </div>
      </div>
      </div><!-- /.box-body -->
        

          <div class="text-center">
           
          <button type="button" class="btn btn-success" id="checkValidation"><i class="fa fa-save"></i> Update</button>

         </div>
          
         </form>

         

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->


  

</div>



@include('admin.include.footer')

<script type="text/javascript">

   var currentDate = new Date();

  $('.FromDate').datetimepicker({

    format:'YYYY-MM-DD hh:mm A'
  });

  $('.travelReqDate').datepicker({
      multidate: true,
      format : 'yyyy-mm-dd',
      todayHighlight: true,
      
      startDate :currentDate,
      maxDate: currentDate
  });

  $(".tPicker").datetimepicker({
   format:'LT',
  });

$(document).ready(function(){
  $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
    if (keycode == 46 || this.value.length==10) {
    return false;
  }
});

});


$(document).ready(function(){

    $('#checkValidation').on('click',function(){

      var data = $('#travelReqForm').serialize();
      

       var empname =  $('#empname').val();
       var age     =  $('#age').val();
       var funData =  $('#functionData').val();

       
       if(empname){

          $('#empnameErr').html('');

        }else{
          
          $('#empnameErr').html('Employee Name Field Is Required').css('color','red');
        } 

        var emp_designation =  $('#emp_designation').val();
       
        if(emp_designation){

          $('#emp_designationErr').html('');

        }else{
          
          $('#emp_designationErr').html('Employee Designation Field Is Required').css('color','red');
        }

        var gender =  $('#gender').val();
       
        if(gender){

          $('#genderErr').html('');
        }else{
          
          $('#genderErr').html('Gender Field Is Required').css('color','red');
        }

        var pur_travel =  $('#pur_travel').val();
       
        if(pur_travel){

          $('#pur_travelErr').html('');

        }else{
          
          $('#pur_travelErr').html('Purpose Travel Field Is Required').css('color','red');

        }



       var count     = $('#tblTravel tr').length;
       
       var trCount   = count-1;

       var  tblcount = $('#tblAccommo tr').length;
       
       var tbltrCount = tblcount-1;

       for(var q=0;q<trCount;q++){

        var w = q +1;
        var travelReqDate  =  $('#travelReqDate'+w).val();
        var tPicker        =  $('#tPicker'+w).val();
        var placeFrom      =  $('#placeFrom'+w).val();
        var placeTo        =  $('#placeTo'+w).val();
        var mode           =  $('#mode'+w).val();
       
        if(travelReqDate){

          $('#travelReqDateErr'+w).html('');

        }else{
          
          $('#travelReqDateErr'+w).html('Date Field Is Required').css('color','red');
        }

        if(tPicker){
          
          $('#tPickerErr'+w).html('');

        }else{
          
          $('#tPickerErr'+w).html('Time Field Is Required').css('color','red');

        }

        if(placeFrom){

         $('#placeFromErr'+w).html('');

        }else{
          
          $('#placeFromErr'+w).html('Place From Field Is Required').css('color','red');

        }

        if(placeTo){

          $('#placeToErr'+w).html('');

        }else{
          
          $('#placeToErr'+w).html('Place To Field Is Required').css('color','red');

        }

        if(mode){

         $('#modeErr'+w).html('');

        }else{
          
          $('#modeErr'+w).html('Mode Field Is Required').css('color','red');

        } 

       }


      for(var l=0;l<tbltrCount;l++){

        var m = l +1;
        var place_id       =  $('#place_id'+m).val();
        var hotel_id       =  $('#hotel_id'+m).val();
        var dtFrom         =  $('#FromDate'+m).val();
        var dtTo           =  $('#dtTo'+m).val();

        if(place_id){

         $('#place_idErr'+m).html('');

        }else{
          
          $('#place_idErr'+m).html('Place Field Is Required').css('color','red');
        }

        if(hotel_id){

          $('#hotel_idErr'+m).html('');

        }else{
          
          $('#hotel_idErr'+m).html('Hotel Field Is Required').css('color','red');

        }

        if(dtFrom){

          $('#dtFromErr'+m).html('');

        }else{
          
          $('#dtFromErr'+m).html('Date & Time From Field Is Required').css('color','red');

        }

        if(dtTo){

          $('#dtToErr'+m).html('');

        }else{
          
          $('#dtToErr'+m).html('Date & Time To Field Is Required').css('color','red');
          
        }

      }
       
      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });
  
     $.ajax({

        type: 'POST',

        url: "{{ url('/Transaction/TravelRequisition/UpdateTravelReq') }}",

        
        data: data,

        success: function (data) {

           var getName = btoa('TravelRequisition');

           window.location.href="/biztechERP_DEV/Transaction/TravelRequisition/success-message/"+getName;
        }

    });

         
       
    });


    

});


</script>













@endsection