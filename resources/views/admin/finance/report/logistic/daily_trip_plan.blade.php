@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<!-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

        <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script> -->


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

  .rightcontent{

  text-align:right;


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

            Daily Trip Report
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">Logistic</a></li>
            
            <li><a href="{{ url('/dashboard') }}">Trip Planning</a></li>

            <li class="active"><a href="{{ url('/report/logistic/trip-planning/monthly-trip-planning-report') }}"> Daily Trip Report</a></li>

          </ol>

        </section>

<section class="content">

    <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">  Daily Trip Report</h2>


        </div><!-- /.box-header -->

        <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

            <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                      <?php 
                        date_default_timezone_set('Asia/Kolkata');
                        $current_date = date("Y-m-d");
                        $FromDate= date("d-m-Y", strtotime($fyYear_info->FY_FROM_DATE));  
                        $ToDate= date("d-m-Y", strtotime($fyYear_info->FY_TO_DATE));   ?>
                      <label for="exampleInputEmail1"> From Date :<span class="required-field"></span> </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="hidden" name="" value="{{$FromDate}}" id="FromDateFy">

                        <input type="hidden" name="" value="{{$ToDate}}" id="ToDateFy">
                       
                        <input type="text" name="from_date" id="from_date" class="form-control fromDatePc rightcontent" placeholder="Select Transaction Date" value="{{$current_date}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_from_date">

                        

                      </small>

                    </div>

                </div>


                <div class="col-md-3">

                   <div class="form-group">

                      <label for="exampleInputEmail1"> To Date :<span class="required-field"></span> </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="text" name="to_date" id="to_date" class="form-control toDatePc rightcontent" placeholder="Select Transaction Date" value="{{$current_date}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_to_date">

                      </small>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Account Code :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="accList" id="acc_no" name="acc_no" class="form-control  pull-left" value="" placeholder="Select Acc Code" autocomplete="off">


                          <datalist id="accList">

                            <?php foreach ($acc_list as $value): ?>

                              <option value="<?php echo $value->ACC_CODE.'-'.$value->ACC_NAME; ?>"data-xyz ="{{ $value->ACC_NAME }}">{{ $value->ACC_CODE}} = {{$value->ACC_NAME}}</option>
                              
                            <?php endforeach ?>
                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Consinee :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="custList" id="cust_no" name="cust_no" class="form-control  pull-left" value="" placeholder="Select Consignee" autocomplete="off">


                          <datalist id="custList">

                           <?php foreach ($trip_list as $value): ?>

                              <option value="<?php echo $value->CP_CODE.'-'.$value->CP_NAME; ?>"data-xyz ="{{ $value->CP_NAME }}">{{ $value->CP_CODE}} = {{$value->CP_NAME}}</option>
                              
                            <?php endforeach ?>
                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

                

            </div><!-- /. 1st row -->

            <div class="row">

              <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Transpoter/Agent :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="transpoterList" id="transpAgentId" name="transpAgent" class="form-control  pull-left" value="" placeholder="Select Transpoter/Agent" autocomplete="off">


                          <datalist id="transpoterList">

                            <?php foreach ($trip_list_trans as $value): ?>

                              <option value="<?php echo $value->TRANSPORT_CODE.'-'.$value->TRANSPORT_NAME; ?>" data-xyz = "{{ $value->TRANSPORT_NAME }}"><?php echo $value->TRANSPORT_CODE.'-'.$value->TRANSPORT_NAME ?></option>
                              
                            <?php endforeach ?>
                          </datalist>

                        </div>

                        <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                      </small>

                      <small id="show_err_trans"></small>
                      <span id='searcherr' style="color: red;"></span>

                    </div>
                </div>

              <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">From Place :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="fromPlace_list" id="from_place" name="from_place" class="form-control  pull-left" value="" placeholder="Select From Place" autocomplete="off">


                          <datalist id="fromPlace_list">
                            <?php foreach ($city_list as $value): ?>

                              <option value="<?php echo $value->CITY_CODE.'-'.$value->CITY_NAME; ?> "data-xyz ="{{ $value->CITY_CODE }}">{{ $value->CITY_NAME}} = {{$value->CITY_CODE}}</option>
                              
                            <?php endforeach ?>
                           
                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="fromPlaceText"></div>

                     </small>

                     <small id="show_err_from_place"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">To Place :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="toPlace_list" id="to_place" name="to_place" class="form-control  pull-left" value="" placeholder="Select To Place" autocomplete="off">


                          <datalist id="toPlace_list">
                           <?php foreach ($city_list as $value): ?>

                              <option value="<?php echo $value->CITY_CODE.'-'.$value->CITY_NAME; ?>"data-xyz ="{{ $value->CITY_CODE }}">{{ $value->CITY_NAME}} = {{$value->CITY_CODE}}</option>
                              
                            <?php endforeach ?>
                            
                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="toPlaceText"></div>

                     </small>

                     <small id="show_err_to_place"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

                <div class="col-md-3">
                 
                    <div class="form-group">

                        <label for="exampleInputEmail1">Vehicle Owner : <span class="required-field"></span> </label>

                        <div class="input-group">

                        
                            <input type="radio" id="ownVehicle" name="vehicleType"  value="self" checked=""> &nbsp; <b>Self </b> &nbsp;&nbsp;
                            <input type="radio" id="marketVehicle" name="vehicleType" value="market">  &nbsp; <b>Market</b>&nbsp;&nbsp;
                            <input type="radio" id="dumpVehicle" name="vehicleType" value="dump">  &nbsp; <b>Dump</b>&nbsp;&nbsp;
                            <input type="radio" id="bothVehicle" name="vehicleType" value="all">  &nbsp; <b>All</b>&nbsp;&nbsp;


                        </div>

                        <small>  

                          <div class="pull-left showSeletedName" id="pfctText"></div>

                       </small>

                       <small id="show_err_dept_code">

                        </small>
                       
                    </div>

                  </div> 

            </div><!-- /. 2nd row -->


              <div class="row">

              
                <div class="col-md-4"></div>

                <div class="col-md-4 text-center" style="margin-top: 1%;">

                  
                  <button type="button" class="btn btn-primary" id="ProceedBtnId">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                  <button type="button" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

                 <!--  <button type="button" class="btn btn-warning" name="searchdata" onclick="excelReportBtn('month')" disabled="" id="excelBtn">&nbsp;&nbsp;<i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp;&nbsp;Excel&nbsp;&nbsp;</button> -->


                  </div>

                  <div class="col-md-4"></div>

              </div>


            

        </div><!-- /.box-body -->

          <div class="box-body" style="margin-top: 1%;" >

                <table id="tripPlanReportTbl" class="table table-bordered table-striped table-hover" style="display:'';width: 100% !important;">
                  <thead class="theadC">

                    <tr>
                      <th class="text-center" width="5%">Trip Date</th>
                      <th class="text-center" width="5%">Trip No.</th>
                      <th class="text-center" width="15%">Account Name/Code</th>
                      <th class="text-center" width="4%">D.O. No.</th>
                      <th class="text-center" width="5%">D.O. Date</th>
                      <th class="text-center" width="15%">Consinee Name</th>
                      <th class="text-center" width="8%">From Place</th>
                      <th class="text-center" width="8%">To Place</th>
                      <th class="text-center" width="9%">Item Name</th>
                      <th class="text-center" width="5%">Qty</th>
                      <th class="text-center" width="5%">Vehicle No.</th>
                      <th class="text-center" width="5%">Vehicle Owner</th>
                      <th class="text-center" width="7%">Transpoter Name</th>
                      <th class="text-center" width="5%">Freight Rate</th>
                     
                      
                    </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>
                 
                </table>

                <table id="marketReportTbl" class="table table-bordered table-striped table-hover" style="display:none;width: 100% !important;">
                  <thead class="theadC">

                    <tr>
                      <th class="text-center" width="5%">Trip Date</th>
                      <th class="text-center" width="5%">Trip No.</th>
                      <th class="text-center" width="12%">Account Name</th>
                      <th class="text-center" width="5%">D.O. No.</th>
                      <th class="text-center" width="5%">D.O. Date</th>
                      <th class="text-center" width="12%">Consinee Name</th>
                      <th class="text-center" width="5%">From Place</th>
                      <th class="text-center" width="5%">To Place</th>
                      <th class="text-center" width="10%">Item Name</th>
                      <th class="text-center" width="5%">Vehicle No.</th>
                      <th class="text-center" width="5%">Vehicle Owner</th>
                      <th class="text-center" width="5%">Qty</th>
                      <th class="text-center" width="5%">FRT AMT</th>
                      <th class="text-center" width="5%">Amount</th>
                      <th class="text-center" width="5%">Adv Rate</th>
                      <th class="text-center" width="5%">Adv Amt Trip Name</th>
                     
                      
                    </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>
                 
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



 <script type="text/javascript">

  $(document).ready(function(){

      var d = new Date();
        var strDate = d.getDate() + "0" + (d.getMonth()+1) + "" + d.getFullYear();

        var time = d.getHours() + "" + d.getMinutes() + "" + d.getSeconds();

        $('#excelName').val(strDate+'_'+time);

        $( window ).on( "load", function() {

          var fromdateintrans = $('#FromDateFy').val();
          var todateintrans = $('#ToDateFy').val();

          $('.fromDatePc').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });

          $('.toDatePc').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });

        });

  });


  // function excelReportBtn(type){

    // var velType = $('input[name=vehicleType]:checked').val();

    // var from_date    =  $('#from_date').val();

    // var to_date      =  $('#to_date').val();
    
    // var ConsineeCode =  $('#cust_no').val();
    
    // var trspAgent    =  $('#transpAgentId').val();
    
    // var fromPlace    =  $('#from_place').val();

    // var toPlace      =  $('#to_place').val();

    // if(velType == ''){
    //   vehicleType = 0;
    // }else{
    //   vehicleType = velType;
    // }

    // if(ConsineeCode == ''){
    //   Consinee = 0;
    // }else{
    //   Consinee = ConsineeCode;
    // }

    // if(fromPlace == ''){
    //   from_place = 0;
    // }else{
    //   from_place = fromPlace;
    // }

    // if(toPlace == ''){
    //   to_place = 0;
    // }else{
    //   to_place = toPlace;
    // }

    // if(trspAgent == ''){
    //   transpAgent = 0;
    // }else{
    //   transpAgent = trspAgent;
    // }

    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });

    // window.location.href = "{{ url('/report/logistic/trip-planning/monthly-trip-planning-report-excel/') }}"+'/'+from_date+'/'+to_date+'/'+vehicleType+'/'+Consinee+'/'+from_place+'/'+to_place+'/'+transpAgent;

    /*window.location.href = "{{ url('/report/purchase/purchase-monthly-order/purchase-monthly-order-excel/') }}"+'/'+vehicleType+'/'+from_date+'/'+to_date+'/'+Consinee+'/'+transpAgent+'/'+plant+'/'+from_place+'/'+to_place;*/
       
  // }


/* START : Load Data Table */

load_data_query();

function load_data_query(vehicleType= '',acc_no='', from_date='',to_date='',Consinee='',transpAgent='',from_place='',to_place=''){

   var date1 = new Date();
   var month = date1.getMonth() + 1;
   var tdate = date1.getDate();
   var mn    = month.toString().length > 1 ? month : "0" + month;
   var yr    = date1.getFullYear();
   var hr    =  date1.getHours(); 
   var min   = date1.getMinutes();
   var sec   = date1.getSeconds(); 
   
   var curr_date = tdate+''+mn+''+yr;
   var curr_time = hr+':'+min+':'+sec;
   
   if(vehicleType == 'market'){

      $('#marketReportTbl').css('display','');
      // $('#tripPlanReportTbl').css('display','none');
       $('#tripPlanReportTbl').parents('div.dataTables_wrapper').first().hide();

       $('#marketReportTbl').DataTable({

         footerCallback: function ( row, data, start, end, display ) {
          var api = this.api(), data;

           var rowcount = data.length;
           var getRow = rowcount-1;
          
            if(rowcount > 0){
               $('.buttons-excel').attr('disabled',false);
            }else{
               $('.buttons-excel').attr('disabled',true);
            }

         },

          processing: true,
          serverSide: true,
          scrollX: true,
          pageLength:'25',
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
          buttons:  [
                     {
                      extend: 'excelHtml5',
                      title: 'daily_market_report_'+curr_date+'_'+curr_time,
                      footer: true
                    }
                     
                    ],
          ajax:{
            url:'{{ url("/get-data-daily-trip-planning-report") }}',
            data: {vehicleType:vehicleType,acc_no:acc_no,from_date:from_date,to_date:to_date,Consinee:Consinee,transpAgent:transpAgent,from_place:from_place,to_place:to_place}
          },
          columns: [

            {
                render: function (data, type, full, meta){
                  
                var vrdate = full['VRDT'];
              
                var getDt = vrdate.split('-');

                var yy = getDt[0];
                var mm = getDt[1];
                var dd = getDt[2];

                var vrDt =  dd +'-' + mm + '-'+yy;

                return vrDt;

              },
              className:"text-right"
                
            },
            {
                render: function (data, type, full, meta){
                  
                  var seriesCd = full['SERIES_CODE'];
                  var fyCode = full['FY_CODE'];
                  var vrNo = full['VRNO'];

                  var tripNo = vrNo;

                  return tripNo;

                },
                className: "text-left"
               
            },
            {
                render: function (data, type, full, meta){
                  
                var acc_code = full['ACCCODE'];
                var acc_name = full['ACCNAME'];

                var acccode_name =  acc_name +' [ ' + acc_code +' ]';

                return acccode_name;

              },
              className:"text-left"
               
            },
            {
                data:'DO_NO',
                name:'DO_NO',
                className: "text-right"
               
            },
            {
                render: function (data, type, full, meta){
                  
                var dodate = full['DO_DATE'];
              
                if (dodate != null) {

                  var getDo = dodate.split('-');

                }else{

                  var getDo = '';
                }
              

                var yy = getDo[0];
                var mm = getDo[1];
                var dd = getDo[2];

                var doDt =  dd +'-' + mm + '-'+yy;

                return doDt;

              },
              className:"text-right"
                
            },
            {
              render: function (data, type, full, meta){
                  
               
                var cp_name = full['CP_NAME'];

                // var cp_full_name =  cp_name +' [ ' + cp_code + ' ] ';
                // $("#PindReprtExl").prop('disabled',false);
                return cp_name;

              },
              className:"text-left"
               
            },
            {
                data:'FROM_PLACE',
                name:'FROM_PLACE',
                className: "text-left"
               
            },
            {
                data:'TO_PLACE',
                name:'TO_PLACE',
                className: "text-left"
               
            },
            {
              render: function (data, type, full, meta){
                  
                // var item_code = full['ITEM_CODE'];
                var item_name = full['ITEM_NAME'];

                // var itemode_name =  item_name +' [ ' + item_code + ' ] ';
               
                return item_name;

              },
              className:"text-left"
               
            },

            {
                data:'VEHICLENO',
                name:'VEHICLENO',
                className: "text-left"
               
            },

             {
                data:'OWNER',
                name:'OWNER',
                className: "text-left"
               
            },
            
            {
                render: function (data, type, full, meta){
                  
                  var qty = full['QTY'];
                  // var um = full['UM'];

                  // var qty_um =  qty +' ' + um;
                 
                  return qty;

              },
                className: "text-right"
               
            },

             {
                render: function (data, type, full, meta){
                  
                  var frt_rate = full['TRIP_FREIGHT_AMT'];
                 
                 
                  return frt_rate;

              },
                className: "text-frt_rate"
               
            },

             {
                render: function (data, type, full, meta){
                  
                  var amt = full['AMOUNT'];
                 
                 
                  return amt;

              },
                className: "text-right"
               
            },

            {data:'ADV_RATE',className:'text-right'},
            {data:'ADV_AMT',className:'text-right'},
           
            
          ]


      });

   }else{

     // $('#marketReportTbl').css('display','none');
      $('#marketReportTbl').parents('div.dataTables_wrapper').first().hide();
     $('#tripPlanReportTbl').css('display','');

     $('#tripPlanReportTbl').DataTable({

          footerCallback: function ( row, data, start, end, display ) {
          var api = this.api(), data;

           var rowcount = data.length;
           var getRow = rowcount-1;
          
            if(rowcount > 0){
               $('.buttons-excel').attr('disabled',false);
            }else{
               $('.buttons-excel').attr('disabled',true);
            }

         },

          processing: true,
          serverSide: true,
          scrollX: true,
          pageLength:'25',
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
          buttons:  [
                     {
                      extend: 'excelHtml5',
                      title: 'daily_report_'+curr_date+'_'+curr_time,
                      footer: true
                    }
                    ],
          ajax:{
            url:'{{ url("/get-data-daily-trip-planning-report") }}',
            data: {vehicleType:vehicleType,acc_no:acc_no,from_date:from_date,to_date:to_date,Consinee:Consinee,transpAgent:transpAgent,from_place:from_place,to_place:to_place}
          },
          columns: [

            {
                render: function (data, type, full, meta){
                  
                var vrdate = full['VRDT'];
              
                var getDt = vrdate.split('-');

                var yy = getDt[0];
                var mm = getDt[1];
                var dd = getDt[2];

                var vrDt =  dd +'-' + mm + '-'+yy;

                return vrDt;

              },
              className:"text-right"
                
            },
            {
                data:'TRIP_NO',
                name:'TRIP_NO',
                className: "text-left"
               
            },
            {
                render: function (data, type, full, meta){
                  
                var acc_code = full['ACCCODE'];
                var acc_name = full['ACCNAME'];

                var acccode_name =  acc_name +' [ ' + acc_code +' ]';

                return acccode_name;

              },
              className:"text-left"
               
            },
            {
                data:'DO_NO',
                name:'DO_NO',
                className: "text-right"
               
            },
            {
                render: function (data, type, full, meta){
                  
                var dodate = full['DO_DATE'];
              
                var getDo = dodate.split('-');

                var yy = getDo[0];
                var mm = getDo[1];
                var dd = getDo[2];

                var doDt =  dd +'-' + mm + '-'+yy;

                return doDt;

              },
              className:"text-right"
                
            },
            {
              render: function (data, type, full, meta){
                  
                var cp_code = full['CP_CODE'];
                var cp_name = full['CP_NAME'];

                var cp_full_name =  cp_name +' [ ' + cp_code + ' ] ';
                $("#PindReprtExl").prop('disabled',false);
                return cp_full_name;

              },
              className:"text-left"
               
            },
            {
                data:'FROMPLACE',
                name:'FROMPLACE',
                className: "text-left"
               
            },
            {
                data:'TO_PLACE',
                name:'TO_PLACE',
                className: "text-left"
               
            },
            {
              render: function (data, type, full, meta){
                  
                var item_code = full['ITEM_CODE'];
                var item_name = full['ITEM_NAME'];

                var itemode_name =  item_name +' [ ' + item_code + ' ] ';
               
                return itemode_name;

              },
              className:"text-left"
               
            },
            
            {
                render: function (data, type, full, meta){
                  
                  var qty = full['QTY'];
                 
                 
                  return qty;

              },
                className: "text-right"
               
            },
            {
                data:'VEHICLENO',
                name:'VEHICLENO',
                className: "text-left"
               
            },
            {
              data:null,
              render: function (data, type, full, meta){

                if(full['OWNER']=='SELF'){

                  var vehicleOwner = '<small class="label label-success"><i class="fa fa-check"></i> SELF </small>';

                }else if(full['OWNER']=='MARKET'){

                  var vehicleOwner = '<small class="label label-warning"><i class="fa fa-check"></i> MARKET </small>';

                }else if(full['OWNER']=='DUMP'){

                  var vehicleOwner = '<small class="label label-info"><i class="fa fa-check"></i> DUMP </small>';

                }else{

                   var vehicleOwner = '<small class="label label-success"><i class="fa fa-check"></i> '+full['OWNER']+' </small>';

                }

                return vehicleOwner;

              },
              className:"text-left"
            },
            {
              render: function (data, type, full, meta){
                  
                var trpt_code = full['TRANSPORT_CODE'];
                var trpt_name = full['TRANSPORT_NAME'];

               

                var trptcode_name =  trpt_name +' [ ' + trpt_code + ' ] ';
                
                return trptcode_name;

              },
              className:"text-right"
               
            },
            {
                data:'AMOUNT',
                name:'AMOUNT',
                className: "text-right"
               
            }
            
            
          ]


      });

   }

}


/* END : Load Data Table */

  


  $(document).ready(function() {


/* ..........START : Search Button Click ......... */

    $('#ProceedBtnId').click(function(){

    var vehicleType = $('input[name=vehicleType]:checked').val();
    var from_date   =  $('#from_date').val();

    var acc_no   =  $('#acc_no').val();

    var to_date     =  $('#to_date').val();
    
    var Consinee    =  $('#cust_no').val();
    
    var transpAgent =  $('#transpAgentId').val();
  
    var from_place  =  $('#from_place').val();

    var to_place    =  $('#to_place').val();

        $("#from_date").prop('readonly',true);
        $("#to_date").prop('readonly',true);        
        $("#cust_no").prop('readonly',true);
        $("#acc_no").prop('readonly',true);
        $("#transpAgentId").prop('readonly',true);
        $("#from_place").prop('disabled',true);
        $("#to_place").prop('disabled',true);
        $("#ProceedBtnId").prop('disabled',true);

        if(vehicleType == 'market'){

           $('#marketReportTbl').DataTable().destroy();
           

            load_data_query(vehicleType,acc_no,from_date,to_date,Consinee,transpAgent,from_place,to_place);
          
        }else{


          if (vehicleType=='' || acc_no=='' || from_date=='' || to_date=='' || Consinee=='' || transpAgent=='' || from_place=='' || to_place=='') {

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

            $('#tripPlanReportTbl').DataTable().destroy();

            load_data_query(vehicleType,acc_no,from_date,to_date,Consinee,transpAgent,from_place,to_place);

          }else{

            $('#tripPlanReportTbl').DataTable().destroy();

            load_data_query();

          }

        }

   
        


    });

/* ..........END : Search Button Click ......... */


    $('#ResetId').click(function(){

      $('#tripPlanReportTbl').DataTable().destroy();

        $("#from_date").prop('readonly',false);
        $("#to_date").prop('readonly',false);        
        $("#cust_no").prop('readonly',false);
        $("#transpAgentId").prop('readonly',false);
        $("#from_place").prop('disabled',false);
        $("#to_place").prop('disabled',false);
     

    });
  

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