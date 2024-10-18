@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')
<style type="text/css">

    .tooltip{f
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

            Delivery Order Pending/Complete Report
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">Logistics</a></li>

            <li class="active"><a href="{{ url('/report/logistic/do-pending/order-report') }}">Delivery Order Pending/Complete Report</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Delivery Order Pending/Complete Report </h2>


            </div><!-- /.box-header -->

            <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

              <div class="row">

                <div class="col-md-3">

                   <div class="form-group">

                     <?php $FromDate= date("d-m-Y", strtotime($fyYear_info->FY_FROM_DATE));  
                        $ToDate= date("d-m-Y", strtotime($fyYear_info->FY_TO_DATE));   ?>
                      
                      <label for="exampleInputEmail1"> From Date : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="hidden" name="" value="{{$FromDate}}" id="FromDateFy">

                        <input type="hidden" name="" value="{{$ToDate}}" id="ToDateFy">
                       
                        <input type="text" name="from_date" id="from_date" class="form-control fromDatePc rightcontent" placeholder="Select Transaction Date" value="{{$FromDate}}" autocomplete="off">

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

                      <label for="exampleInputEmail1"> To Date : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                       <!--  <input type="hidden" name="" value="{{$FromDate}}" id="FromDateFy_1">

                        <input type="hidden" name="" value="{{$ToDate}}" id="ToDateFy_1"> -->

                        <input type="text" name="to_date" id="to_date" class="form-control toDatePc rightcontent" placeholder="Select Transaction Date" value="{{$ToDate}}" autocomplete="off">

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

                      <label for="exampleInputEmail1">Vr. No. :</label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                        </div>

                        <input list="vrnoList" id="vr_num" name="vr_num" class="form-control  pull-left" value="" placeholder="Select Vr Number" autocomplete="off">

                        <datalist id="vrnoList">

                          <?php foreach ($dorder_vrno as $value): 
                            $exp = explode('-',$value->FY_CODE);
                            $fYr = $exp[0];
                            $fyCode = substr($fYr, 2);
                            ?>
                            <option value="<?php echo $value->SERIES_CODE.' '.$fyCode.' '.$value->VRNO; ?>"data-xyz ="<?php echo $value->SERIES_CODE.' '.$fyCode.' '.$value->VRNO; ?>"><?php echo $value->SERIES_CODE.' '.$fyCode.' '.$value->VRNO; ?></option>
                          <?php endforeach ?>

                            
                        </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                      </small>

                      <small id="show_err_trans">

                      </small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                  
                </div><!-- /.col -->

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">DO No : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="dorder_list" id="do_no" name="do_no" class="form-control  pull-left" value="" placeholder="Select DO No." autocomplete="off">


                          <datalist id="dorder_list">

                            <?php foreach ($dorder_list as $value): ?>

                               <option value="{{$value->DORDER_NO}}" data-xyz ="{{ $value->DORDER_NO }}">{{ $value->DORDER_NO}}</option>
                              
                            <?php endforeach ?>

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_do_no"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row">
                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Customer Code :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="custList" id="cust_no" name="cust_no" class="form-control  pull-left" value="" placeholder="Select Customer Code" autocomplete="off">


                          <datalist id="custList">

                            <?php foreach ($dorder_list_acc as $value): ?>

                              <option value="{{$value->ACC_CODE}}"data-xyz ="{{ $value->ACC_NAME }}">{{ $value->ACC_CODE}} = {{$value->ACC_NAME}}</option>
                              
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

                              <option value="{{$value->CITY_CODE}}"data-xyz ="{{ $value->CITY_CODE }}">{{ $value->CITY_NAME}} = {{$value->CITY_CODE}}</option>
                              
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

                              <option value="{{$value->CITY_CODE}}"data-xyz ="{{ $value->CITY_CODE }}">{{ $value->CITY_NAME}} = {{$value->CITY_CODE}}</option>
                              
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

                        <label for="exampleInputEmail1">Report Type : <span class="required-field"></span> </label>

                        <div class="input-group">

                        
                            <input type="radio" id="pendingId" name="reporttype"  value="pending" checked=""> &nbsp; <b>Pending</b> &nbsp;&nbsp;
                            <input type="radio" id="CompleteId" name="reporttype" value="complete">  &nbsp; <b>Complete</b>&nbsp;&nbsp;
                            <input type="radio" id="allId" name="reporttype" value="allitem">  &nbsp; <b>All</b>


                        </div>

                        <small>  

                          <div class="pull-left showSeletedName" id="pfctText"></div>

                       </small>

                       <small id="show_err_dept_code">

                        </small>
                       
                    </div>

                  </div> 
              </div>

              <div class="row text-center">

                         

                  <!-- <div class="col-md-8"> -->

                    <div style="margin-top:1%;margin-bottom:2%;">

                     <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" style="padding: 1px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                      <button type="button" class="btn btn-default" onClick="window.location.reload();" name="searchdata" id="ResetId" style="padding: 1px;">&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

                      <button type="button" class="btn btn-success" style="padding: 1px;" data-toggle="modal" data-target="#QueryModal" id="queryBtn">&nbsp;&nbsp;<i class="fa fa-hourglass" aria-hidden="true"></i> &nbsp;&nbsp;Query&nbsp;&nbsp;</button>

                      <button class="btn btn-primary" id="PindReprtExl"  style="padding: 1px;" onclick="excelReportBtn('excel')" disabled="" >&nbsp;&nbsp;<i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp;&nbsp;Excel&nbsp;&nbsp;</button>

                    </div>

                  <!-- </div> -->

                

              </div>


            </div><!-- /.box-body -->



              <div class="box-body" style="margin-top: -2%;">

                <table id="DoReportTbl" class="table table-bordered table-striped table-hover">
                  <thead class="theadC">

                    

                    <tr>
                      <th class="text-center">D.O. Date</th>
                      <th class="text-center">D.O. No.</th>
                      <th class="text-center">Customer Name/Code</th>
                      <th class="text-center">Consignee Name/Code</th>
                      <th class="text-center">From Place</th>
                      <th class="text-center">To Place</th>
                      <th class="text-center">Material Number</th>
                      <th class="text-center">Item Name/Code</th>
                      <th class="text-center">Detailed Material Name</th>
                      <th class="text-center">Rake No</th>
                      <th class="text-center">Wagon No</th>
                      <th class="text-center">Order Qty</th>
                      <th class="text-center">Dispatch Qty</th>
                      <th class="text-center">Cancle Qty</th>
                      <th class="text-center">Balance Qty</th>
                      <th class="text-center">Status</th>
                    </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>
                 
                </table>

              </div><!-- /.box-body -->

          </div>

  </section>

</div>



  {{--****** Start : Query Model ******--}}


  <div class="modal fade" id="QueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style='border-radius: 5px;
    -webkit-box-shadow: 0px 1px 8px 0px rgb(0 0 0 / 75%);
    -moz-box-shadow: 0px 1px 8px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 1px 8px 0px rgb(0 0 0 / 75%'>
        <div class="modal-header" style='text-align:center'>
          <div class="modal-title" id="queryModalLabel" style="font-size: 135%;font-weight: 800;">Query</div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times-circle-o" aria-hidden="true"></i>
          </button>
        </div>
        <div class="modal-body">
          <section>
            <div class="row">
              
              <div class="col-sm-12">
                <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Query Fields</th>
                  <th scope="col" class="text-center">Operator</th>
                  <th scope="col" class="text-center">Values</th>
                </tr>
              </thead>
              <tbody>
                 <tr>
                  <th>1</th>
                  <td class='QueryTableTd'>Series No. :</td>
                  <td style="text-align: center;">
                      <select id="seriesCodeOperator" name="seriesCodeOperator" style="width: 70%;font-size: initial;" onchange="seriesQueryOperator(this.value)">
                        <option value=''>--Select--</option>
                        <option value='='>=</option>
                        <option value='=='>==</option>
                        <option value='!='>!=</option>
                        <option value='>'>></option>
                        <option value='<'><</option>
                        <option value='>='>>=</option>
                        <option value='<='><=</option>
                        <option value='LIKE'>LIKE</option>
                       
                      </select>
                    <small id="showErrorRecNoOpt"></small>
                  </td>

                  <td style="text-align: center;">

                      <input list="seriesList" id="seriesCodeValue" name="seriesCodeValue" class="pull-left" placeholder="Select Series" autocomplete="off" readonly style="margin-left: 15%;" onchange="seriesQueryValue(this.value)">
                        <datalist id="seriesList">
                          <option selected="selected" value="">-- Select --</option>
                           @foreach ($master_series as $key)

                          <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME; echo " [".$key->SERIES_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>
                    <small id="showErrorLastUpVal"></small>
                  </td>
                </tr>
                <tr>
                  <th>2</th>
                  <td class='QueryTableTd'>Plant :</td>

                  <td style="text-align: center;">
                      <select id="plantCodeOperator" name="plantCodeOperator" style="width: 70%;font-size: initial;" onchange="plantQueryOperator(this.value)">
                        <option value=''>--Select--</option>
                        <option value='='>=</option>
                        <option value='=='>==</option>
                        <option value='!='>!=</option>
                        
                      </select>
                    <small id="showErrorRecNoOpt"></small>
                  </td>
                  <td style="text-align: center;">
                    <input list="plantList" id="plantCodeValue" name="plantCodeValue" class="pull-left" placeholder="Select Plant" autocomplete="off" readonly style="margin-left: 15%;" onchange="plantQueryValue(this.value)">
                        <datalist id="plantList">
                          <option selected="selected" value="">-- Select --</option>
                          @foreach ($master_plant as $key)

                          <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME; echo " [".$key->PLANT_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>
                    <small id="showErrorRecNoVal"></small>
                  </td>
                </tr>
                <tr>
                  <th>3</th>
                  <td class='QueryTableTd'>Pfct :</td>
                  <td style="text-align: center;">
                      <select id="profitCenterOperator" name="profitCenterOperator" style="width: 70%;font-size: initial;" onchange="pfctQueryOperator(this.value)">
                        <option value=''>--Select--</option>
                        <option value='='>=</option>
                        <option value='=='>==</option>
                        <option value='!='>!=</option>
                        
                      </select>
                    <small id="showErrorRecNoOpt"></small>
                  </td>
                  <td style="text-align: center;">
                    <input list="pfctList" id="profitCenterValue" name="profitCenterValue" class="pull-left" placeholder="Select Profit Center" autocomplete="off" readonly style="margin-left: 15%;" onchange="pfctQueryValue(this.value)">
                        <datalist id="pfctList">
                          <option selected="selected" value="">-- Select --</option>
                          @foreach ($master_pfct as $key)

                          <option value='<?php echo $key->PFCT_CODE?>'   data-xyz ="<?php echo $key->PFCT_NAME; ?>" ><?php echo $key->PFCT_NAME; echo " [".$key->PFCT_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>
                    <small id="showErrorVrNoVal"></small>
                  </td>
                </tr>
                <tr>
                  <th>4</th>
                  <td class='QueryTableTd'>Qty :</td>
                  <td style="text-align: center;">
                      <select id="QtyOperator" name="QtyOperator" style="width: 70%;font-size: initial;" onchange="qtyQueryOperator(this.value)">
                        <option value=''>--Select--</option>
                        <option value='='>=</option>
                        <option value='=='>==</option>
                        <option value='!='>!=</option>
                        <option value='>'>></option>
                        <option value='<'><</option>
                        <option value='>='>>=</option>
                        <option value='<='><=</option>
                        <option value='BETWEEN'>BETWEEN</option>
                        
                      </select>
                    <small id="showErrorRecNoOpt"></small>
                  </td>
                  <td style="text-align: center;">
                    <input type="text" name="QtyValue" id="QtyValue" class="ValuesTd" value="" placeholder="Enter Qty" readonly oninput="qtyQueryValue(this.value);">
                    <small id="showErrorAmtVal"></small>
                  </td>
                </tr>

                <tr>
                  <th>5</th>
                  <td class='QueryTableTd'>ODC :</td>

                  <td style="text-align: center;">
                      <select id="odcOperator" name="odcOperator" style="width: 70%;font-size: initial;" onchange="odcQueryOperator(this.value)">
                        <option value=''>--Select--</option>
                        <option value='='>=</option>
                      </select>
                    <small id="showErrorodc"></small>
                  </td>
                  <td style="text-align: center;">
                    <input list="odcList" id="odcValue" name="odcValue" class="pull-left" placeholder="Select ODC" autocomplete="off" value="" readonly style="margin-left: 15%;" onchange="odcQueryValue(this.value)">
                        <datalist id="odcList">
                          <option selected="selected" value="">-- Select --</option>
                          <option value="One Side">One Side</option>
                          <option value="Two Side">Two Side</option>

                        </datalist>
                    <small id="showErrorRecNoVal"></small>
                  </td>
                </tr>

              </tbody>
            </table>
              </div>
              
            </div>
          </section>  
        </div>
        <div class="modal-footer" style='text-align:center;'>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close &nbsp;&nbsp;<i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
          <button type="button" id="ProceedBtnId" class="btn btn-primary">Proceed &nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>


  {{--****** End : Query Model ******--}}



  <input type="hidden" name="plantCodeOperators" id="plantCodeOperators">
  <input type="hidden" name="plantCodeValues" id="plantCodeValues">
  <input type="hidden" name="seriesCodeOperators" id="seriesCodeOperators">
  <input type="hidden" name="seriesCodeValues" id="seriesCodeValues">
  <input type="hidden" name="profitCenterOperators" id="profitCenterOperators">
  <input type="hidden" name="profitCenterValues" id="profitCenterValues">
  <input type="hidden" name="QtyOperators" id="QtyOperators">
  <input type="hidden" name="QtyValues" id="QtyValues">
  <input type="hidden" name="odcOperators" id="odcOperators">
  <input type="hidden" name="odcValues" id="odcValues">

 <!--  <input type="hidden" name="costCetOperators" id="costCetOperators">
  <input type="hidden" name="costCetCodes" id="costCetCodes">
   -->

  {{--**** Start : Quality Parameter Model ****--}}

    <div id="quaPdomModel_2">
         
    </div>


    {{--**** End : Quality Parameter Model ****--}}



@include('admin.include.footer')



 <script type="text/javascript">

    $(document).ready(function(){

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

        $("#acct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

        });

        $("#do_no").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#dorder_list option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){


              $('#do_no').val('');
             
          }
        });

        $("#to_place").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#toPlace_list option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){


              $('#to_place').val('');
             
          }else{
            document.getElementById("toPlaceText").innerHTML = msg; 
          }
        });

        $("#from_place").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#fromPlace_list option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){


              $('#from_place').val('');
             
          }else{
            document.getElementById("fromPlaceText").innerHTML = msg; 
          }
        });

        $("#vr_num").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#vrnoList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){


              $('#vr_num').val('');
             
          }
        });

        $("#cust_no").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#custList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){


              $('#cust_no').val('');
             
          }
        });



        $('#acct_code').change(function(){

         

          var acountCode = $('#acct_code').val();

          $('#showaccCode').val(acountCode);

        });

    });


  function plantQueryOperator(getVal){

    var plantCodeValue =  $('#plantCodeValue').val();

    if(plantCodeValue == '' && getVal !=''){
      $("#plantCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(plantCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#plantCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#plantCodeValue").val('');
    }

  }

  function plantQueryValue(plantCodeValue){

    var getVal =  $('#plantCodeOperator').val();

    if(getVal == '' && plantCodeValue !=''){
      $("#plantCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(plantCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#plantCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#plantCodeValue").val('');
    }

  }

 function odcQueryOperator(getVal){

 	console.log('operator',getVal);

 	var odcValue =  $('#odcValue').val();

 	console.log('odcValue',odcValue);

    if(odcValue == '' && getVal !=''){
      $("#odcValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(odcValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#odcValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#odcValue").val('');
    }

 }

 function odcQueryValue(odc_Value){

    var getVal =  $('#odcOperator').val();
    console.log('odcValue',odc_Value);
    console.log('operator',getVal);
    if(getVal == '' && odc_Value !=''){
      $("#odcValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(odc_Value != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#odcValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#odcValue").val('');
    }

  }
  function seriesQueryOperator(getVal){

    var seriesCodeValue =  $('#seriesCodeValue').val();
    
    if(seriesCodeValue == '' && getVal !=''){
      $("#seriesCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(seriesCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#seriesCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#seriesCodeValue").val('');
    }

  }

  function seriesQueryValue(seriesCodeValue){

    var getVal =  $('#seriesCodeOperator').val();
    
    if(getVal == '' && seriesCodeValue !=''){
      $("#seriesCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(seriesCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#seriesCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#seriesCodeValue").val('');
    }

  }


  function accQueryOperator(getVal){

    var accCodeValue =  $('#accCode').val();
    

    if(accCodeValue == '' && getVal !=''){
      $("#accCode").attr("readonly", false);
      $("#ProceedBtnId").attr("", true);
    }else if(accCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#accCode").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#accCode").val('');
    }

  }

  function accQueryValue(accCodeValue){

    var getVal =  $('#accCodeOperator').val();

    if(getVal == '' && accCodeValue !=''){
      $("#accCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(accCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#accCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#accCodeValue").val('');
    }

  }


  function qtyQueryOperator(getVal){

    var qtyValue =  $('#QtyValue').val();

    if(qtyValue == '' && getVal !=''){
      $("#QtyValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(qtyValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#QtyValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#QtyValue").val('');
    }

  }

  function qtyQueryValue(employeeValue){

    var getVal =  $('#QtyOperator').val();

    if(getVal == '' && employeeValue !=''){
      $("#QtyValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(employeeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#QtyValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#QtyValue").val('');
    }

  }


  function pfctQueryOperator(getVal){

    var profitCenterValue =  $('#profitCenterValue').val();

    if(profitCenterValue == '' && getVal !=''){
      $("#profitCenterValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(profitCenterValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#profitCenterValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#profitCenterValue").val('');
    }

  }

  function pfctQueryValue(profitCenterValue){

    var getVal =  $('#profitCenterOperator').val();

    if(getVal == '' && profitCenterValue !=''){
      $("#profitCenterValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(profitCenterValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#profitCenterValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#profitCenterValue").val('');
    }

  }


  function doNoQueryOperator(getVal){

    var doNumber =  $('#doNumber').val();

    if(doNumber == '' && getVal !=''){
      $("#doNumber").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(doNumber != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#doNumber").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#doNumber").val('');
    }

  }


  function doNoQueryValue(do_no){

    var getVal =  $('#doNoOperator').val();

    if(getVal == '' && do_no !=''){
      $("#doNumber").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(do_no != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#doNumber").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#doNumber").val('');
    }

  }


  function excelReportBtn(type){

    var from_dates = $("#from_date").val();
    var from_date  = from_dates.trim();
    var to_date    = $("#to_date").val();
    var vrns       = $("#vr_num").val();
    var do_num     = $("#do_no").val();
    var cust_num    = $("#cust_no").val();
    var fromPlace = $("#from_place").val();
    var toPlace   = $("#to_place").val();

    if(do_num == ''){
        do_no = 0;
    }else{
        do_no = do_num;
    }

    if(vrns == ''){
      vrn = 0;
    }else{
      vrn = vrns;
    }

    if(cust_num == ''){
      cust_no = 0;
    }else{
      cust_no = cust_num;
    }
    if(fromPlace == ''){
      from_place = 0;
    }else{
      from_place = fromPlace;
    }
    if(toPlace == ''){
      to_place = 0;
    }else{
      to_place = toPlace;
    }

    var seriesCodeOperators   =  $('#seriesCodeOperators').val();

    if (seriesCodeOperators == '') {
      seriesCodeOperator = 0;
    }else{
      seriesCodeOperator = seriesCodeOperators;
    }

    var seriesCodeValues      =  $('#seriesCodeValues').val();
    if (seriesCodeValues == '') {
      seriesCodeValue = 0;
    }else{
      seriesCodeValue = seriesCodeValues;
    }

    var plantCodeOperators    =  $('#plantCodeOperators').val();
    if (plantCodeOperators == '') {
      plantCodeOperator = 0;
    }else{
      plantCodeOperator = plantCodeOperators;
    }

    var plantCodeValues       =  $('#plantCodeValues').val();
    if (plantCodeValues == '') {
      plantCodeValue = 0;
    }else{
      plantCodeValue = plantCodeValues;
    }

    var profitCenterOperators =  $('#profitCenterOperators').val();
    if (profitCenterOperators == '') {
      profitCenterOperator = 0;
    }else{
      profitCenterOperator = profitCenterOperators;
    }

    var profitCenterValues    =  $('#profitCenterValues').val();
    if (profitCenterValues == '') {
      profitCenterValue = 0;
    }else{
      profitCenterValue = profitCenterValues;
    }

    var QtyOperators          =  $('#QtyOperators').val();
    if (QtyOperators == '') {
      QtyOperator = 0;
    }else{
      QtyOperator = QtyOperators;
    }

    var QtyValues   =  $('#QtyValues').val();
    if (QtyValues == '') {
      QtyValue = 0;
    }else{
      QtyValue = QtyValues;
    }
   
    var OdcOperators          =  $('#odcOperators').val();
    if (OdcOperators == '') {
      OdcOperator = 0;
    }else{
      OdcOperator = OdcOperators;
    }

    var OdcValues   =  $('#odcValues').val();
    if (OdcValues == '') {
      OdcValue = 0;
    }else{
      OdcValue = OdcValues;
    }
    
    console.log('odcValues',OdcValue);
    var pendingId  =  $('#pendingId').is(":checked");

    var CompleteId =  $('#CompleteId').is(":checked");

    var allId      =  $('#allId').is(":checked");


    var ReportTypes;

    if(pendingId){
      ReportTypes = $('#pendingId').val();
    }else if(CompleteId){
      ReportTypes = $('#CompleteId').val();
    }else if(allId){
      ReportTypes = $('#allId').val();
    }else{
      ReportTypes = 'Not Found';
    }

    var pageName = 'DeliveryOrderPendingReport';


    window.location.href = "{{ url('/report/logistic/delivery-order-pending-report-excel/') }}"+'/'+from_date+'/'+to_date+'/'+vrn+'/'+do_no+'/'+cust_no+ '/'+from_place+ '/'+to_place+ '/'+seriesCodeOperator+'/'+seriesCodeValue+'/'+plantCodeOperator+'/'+plantCodeValue+'/'+profitCenterOperator+'/'+profitCenterValue+'/'+QtyOperator+'/'+QtyValue+'/'+OdcOperator+'/'+OdcValue+'/'+ReportTypes+'/'+type;

  }


</script>




<script type="text/javascript">

load_data_query();

function load_data_query(seriesCodeOperator= '', seriesCodeValue='',plantCodeOperator='',plantCodeValue='',profitCenterOperator='',profitCenterValue='',QtyOperator='',
QtyValue='',odcOperator='',odcValue='',from_date='',to_date='',do_no='',vr_num='',ReportTypes='',cust_no='',from_place='',to_place=''){
   

      $('#DoReportTbl').DataTable({

          processing: true,
          serverSide: true,
          scrollX: true,
          pageLength:'25',
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
          
           buttons: [
                    
                    ],
         
          ajax:{
            url:'{{ url("/get-data-from-query-delivery-order") }}',
            data: {seriesCodeOperator:seriesCodeOperator,seriesCodeValue:seriesCodeValue,plantCodeOperator:plantCodeOperator,plantCodeValue:plantCodeValue,profitCenterOperator:profitCenterOperator,profitCenterValue:profitCenterValue,QtyOperator:QtyOperator,QtyValue:QtyValue,odcOperator:odcOperator,odcValue:odcValue,from_date:from_date,to_date:to_date,do_no:do_no,vr_num:vr_num,ReportTypes:ReportTypes,cust_no:cust_no,from_place:from_place,to_place:to_place}
          },
          columns: [

            {
            data:'DORDER_DATE',
              className:'text-right',
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00' || data==null || data=='null' || data==''){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
              }
            },
            {
                data:'DORDER_NO',
                name:'DORDER_NO',
                className: "text-right"
            },
            {
              data:'ACC_NAME',
              render: function (data, type, full, meta){
                  
                var acc_code = full['ACC_CODE'];
                var acc_name = full['ACC_NAME'];

                var acccode_name =  acc_name +' [ ' + acc_code + ' ] ';
                $("#PindReprtExl").prop('disabled',false);
                $("#queryBtn").prop('disabled',true);
                return acccode_name;

              },
              className:"text-left"
               
            },
            {
              data:'CP_NAME',
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
              data:'ALIAS_ITEM_CODE',
              name:'ALIAS_ITEM_CODE',
            },
            {
              data:'ITEM_NAME',
              render: function (data, type, full, meta){
                  
                var i_code = full['ITEM_CODE'];
                var i_name = full['ITEM_NAME'];

                var item_name =  i_name +' [ ' + i_code + ' ] ';
                $("#PindReprtExl").prop('disabled',false);
                return item_name;

              },
              className:"text-left"
               
            },
            {
              data:'ALIAS_ITEM_NAME',
              name:'ALIAS_ITEM_NAME',
            },
            {
              data:'RAKE_NO',
              name:'RAKE_NO',
            },
            {
              data:'DO_WAGON_NO',
              name:'DO_WAGON_NO',
            },
            {
                data:'QTY',
                name:'QTY',
                className: "text-right"
               
            },
            {
                data:'DISPATCH_PLAN_QTY',
                name:'DISPATCH_PLAN_QTY',
                className: "text-right"
               
            },
            {
                data:'CANCEL_QTY',
                name:'CANCEL_QTY',
                className: "text-right"
               
            },
            {
             
              render: function (data, type, full, meta){
                  
                var Qty = full['QTY'];
                var dQty = full['DISPATCH_PLAN_QTY'];
                var cQty = full['CANCEL_QTY'];

                var balQty = Qty - cQty - dQty;

                $("#PindReprtExl").prop('disabled',false);
                return balQty.toFixed(3);

              },
              className:"text-right"
               
            },
            {
              data:null,
              render: function (data, type, full, meta){

                if(full['DO_STATUS']==0){

                  var itemName = '<small class="label label-danger"><i class="fa fa-clock-o"></i> Pending</small>';

                }else if(full['DO_STATUS']==1){

                  var itemName = '<small class="label label-success"><i class="fa fa-check"></i> Completed</small>';

                }else{

                  var itemName = '<a class="btn btn-danger btn-xs"><i class="fa fa-close" aria-hidden="true"></i> Pending </a>';

                }

                return itemName;

              },
              className:"text-center"
            }

          
            
          ]


      });


  }
  

  $(document).ready(function() {

    $('#lastUpdateValueId').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });


    $('#ProceedBtnId').click(function(){

      var seriesCodeOperator   =  $('#seriesCodeOperator').val();
      var seriesCodeValue      =  $('#seriesCodeValue').val();

      var plantCodeOperator    =  $('#plantCodeOperator').val();
      var plantCodeValue       =  $('#plantCodeValue').val();

      var profitCenterOperator =  $('#profitCenterOperator').val();
      var profitCenterValue    =  $('#profitCenterValue').val();

      var QtyOperator          =  $('#QtyOperator').val();
      var QtyValue             =  $('#QtyValue').val();

      var odcOperator          =  $('#odcOperator').val();
      var odcValue             =  $('#odcValue').val();

      

      var from_date = '';
      var to_date   =  '';
      var vr_num    =  '';
      var do_no     = '';
      var cust_no     = '';
      var from_place     = '';
      var to_place     = '';

    $('#seriesCodeOperators').val(seriesCodeOperator);
    $('#seriesCodeValues').val(seriesCodeValue);
    $('#plantCodeOperators').val(plantCodeOperator);
    $('#plantCodeValues').val(plantCodeValue);
    $('#profitCenterOperators').val(profitCenterOperator);
    $('#profitCenterValues').val(profitCenterValue);
    $('#QtyOperators').val(QtyOperator);
    $('#QtyValues').val(QtyValue);
    $('#odcOperators').val(odcOperator);
    $('#odcValues').val(odcValue);

    var pendingId  =  $('#pendingId').is(":checked");
    var CompleteId =  $('#CompleteId').is(":checked");
    var allId      =  $('#allId').is(":checked");

    var ReportTypes;

    if(pendingId){
      ReportTypes = $('#pendingId').val();
    }else if(CompleteId){
      ReportTypes = $('#CompleteId').val();
    }else if(allId){
      ReportTypes = $('#allId').val();
    }else{
      ReportTypes = 'Not Found';
    }

    if(seriesCodeOperator!='' || seriesCodeValue!='' || plantCodeOperator!='' || plantCodeValue!='' || profitCenterOperator!='' || profitCenterValue!=''  || QtyOperator!='' || QtyValue!='' || odcOperator!='' || odcValue!='' || from_date!='' || to_date!='' || do_no!= '' || vr_num =='' || ReportTypes!='' || cust_no!='' || from_place!=''|| to_place!='') {
            
      $('#DoReportTbl').DataTable().destroy();

          load_data_query(seriesCodeOperator,seriesCodeValue,plantCodeOperator,plantCodeValue,profitCenterOperator,profitCenterValue,QtyOperator,QtyValue,odcOperator,odcValue,from_date,to_date,do_no,vr_num,ReportTypes,cust_no,from_place,to_place);

          $('#QueryModal').modal('hide');
          $('#seriesCodeOperator').val('');
          $('#seriesCodeValue').val('');
          $('#plantCodeOperator').val('');
          $('#plantCodeValue').val('');
          $('#profitCenterOperator').val('');
          $('#profitCenterValue').val('');
          $('#QtyOperator').val('');
          $('#QtyValue').val('');
          $('#odcOperator').val('');
    	  $('#odcValue').val('');


      }else{

          $('#DoReportTbl').DataTable().destroy();

          load_data_query();

          $('#QueryModal').modal('hide');
          $('#seriesCodeOperator').val('');
          $('#seriesCodeValue').val('');
          $('#plantCodeOperator').val('');
          $('#plantCodeValue').val('');
          $('#profitCenterOperator').val('');
          $('#profitCenterValue').val('');
          $('#QtyOperator').val('');
          $('#QtyValue').val('');
          $('#odcOperator').val('');
    	  $('#odcValue').val('');
         
      }


    });


    $('#btnsearch').click(function(){

	  var from_date  =  $('#from_date').val();
		
	  var to_date    =  $('#to_date').val();
		
	  var vr_num     =  $('#vr_num').val();
		
	  var do_no      =  $('#do_no').val();
	  var cust_no    =  $('#cust_no').val();
	  var from_place =  $('#from_place').val();
	  var to_place   =  $('#to_place').val();

    $('#from_date').prop('readonly',true);
    $('#to_date').prop('readonly',true);
    $('#vr_num').prop('readonly',true);
    $('#do_no').prop('readonly',true);
    $('#cust_no').prop('readonly',true);
    $('#from_place').prop('readonly',true);
    $('#to_place').prop('readonly',true);

      var pendingId  =  $('#pendingId').is(":checked");
      var CompleteId =  $('#CompleteId').is(":checked");
      var allId      =  $('#allId').is(":checked");

      var ReportTypes;

      var seriesCodeOperator   =  '';
      var seriesCodeValue      =  '';
      var plantCodeOperator    =  '';
      var plantCodeValue       =  '';
      var profitCenterOperator =  '';
      var profitCenterValue    =  '';
      var QtyOperator   = '';
      var QtyValue ='';
      var odcOperator ='';
      var odcValue ='';

      if(pendingId){
        ReportTypes = $('#pendingId').val();
      }else if(CompleteId){
        ReportTypes = $('#CompleteId').val();
      }else if(allId){
        ReportTypes = $('#allId').val();
      }else{
        ReportTypes = 'Not Found';
      } 

      if (seriesCodeOperator=='' || seriesCodeValue=='' || plantCodeOperator=='' || plantCodeValue=='' || profitCenterOperator=='' || profitCenterValue==''  || QtyOperator=='' || QtyValue=='' || odcOperator=='' || odcValue=='' || from_date!='' || to_date!='' || do_no !='' || vr_num!='' || ReportTypes!='' || cust_no!='' || from_place!='' || to_place!='' ) {

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

       /* if(do_no == ''){
          $('#show_err_do_no').html('Please select Delivery Order No.').css('color','red');
          return false;
        }else{
        	 $('#show_err_do_no').html('');
        }*/

        $('#DoReportTbl').DataTable().destroy();

        load_data_query(seriesCodeOperator,seriesCodeValue,plantCodeOperator,plantCodeValue,profitCenterOperator,profitCenterValue,QtyOperator,QtyValue,odcOperator,odcValue,from_date,to_date,do_no,vr_num,ReportTypes,cust_no,from_place,to_place);

      }else{

        $('#DoReportTbl').DataTable().destroy();

        load_data_query();

      }

     


    });


    $('#ResetId').click(function(){
  
      $('#do_no').val('');
      $('#vr_num').val('');
      $('#cust_no').html('');

      
      $("#queryBtn").prop('disabled',false);
      $("#btnsearch").prop('disabled',false);

    
      $('#DoReportTbl').DataTable().destroy();
      load_data_query();

    });
  

});

$(document).ready(function() {
  
  var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker1').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date,
      autoclose: 'true'

    });

});



function showCalTax(srNo,headid,bodyId){

      var headid,bodyId;
      var tblName    = 'PORDER_TAX';
      var tblName1   = 'PORDER_HEAD';
      var headIdName = 'PORDERHID';
      var bodyIdName = 'PORDERBID';


        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

        });

        $.ajax({

              url:"{{ url('/get-calTax-for-purchase-reports') }}",

               method : "POST",

               type: "JSON",

              data: {headid:headid,bodyId:bodyId,tblName:tblName,headIdName:headIdName,bodyIdName:bodyIdName,tblName1:tblName1},

               success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{
                        var obj_row = data1.data;
                        var obj_row1 = data1.tax_code;

                        console.log('taxC => ',obj_row1[0].TAX_CODE);

                        $('#showTaxCode'+srNo).html('');

                        $('#showTaxCode'+srNo).html(obj_row1[0].TAX_CODE);

                        var srac=1;
                        /*var countAcc= data1.data.length;
                        $('#accCount'+headid+'_'+srNo).html(countAcc);*/
                        $('#getCalTaxData'+srNo).empty();
                        var headData = '<div class="box-row" id="appendbody'+srNo+'"><div class="box10 texIndbox1">Sr.No.</div><div class="box10 rateIndbox">Tax Indicator</div><div class="box10 rateIndbox">Rate Indicator</div><div class="box10 rateIndbox">Rate</div><div class="box10 rateIndbox">Amount</div></div></div>';
                      $('#getCalTaxData'+srNo).append(headData);



                        $.each(obj_row, function (i, obj_row) {

                            var bodyData = '<div class="box-row"><div class="box10 itmdetlheading"><span id="srnum">'+srac+'</span></div><div class="box10 itmdetlheading" style="text-align: left;"><span id="accCode">'+obj_row.TAXIND_NAME+'</span> </div><div class="box10 itmdetlheading"><span id="accName"> '+obj_row.RATE_INDEX+'</span></div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.TAX_RATE+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.TAX_AMT+'</span> </div></div>';

                            srac++;
                            $('#getCalTaxData'+srNo).append(bodyData);
                        });
                      }
                      
                  }
               }

          });
    }


    function showQuaParDetails(srNo,headid,bodyId){

        var headid,bodyId;
        var pageName = 'purchaseOrder';
        var ItemCode = '';

            $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

        $.ajax({

              url:"{{ url('/finance/get-quality-parameter-by-item') }}",

               method : "POST",

               type: "JSON",

               data: {headid:headid,bodyId:bodyId,pageName:pageName,ItemCode:ItemCode},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       

                      }else{
                        var obj_rows = data1.data;
                        var srac=1;
                        
                        //$('#showItemName').html();
                        /*var countAcc= data1.data.length;
                        $('#accCount'+headid+'_'+srNo).html(countAcc);*/
                        $('#getQuaParData'+srNo).empty();
                        $('#showItemCode'+srNo).empty();
                        var headData = '<div class="box-row" id="appendbody'+srNo+'"><div class="box10 texIndbox1">Sr.No.</div><div class="box10 rateIndbox">Item Category</div><div class="box10 rateIndbox">Quality Char</div><div class="box10 rateIndbox">Description</div><div class="box10 rateIndbox">From Value</div><div class="box10 rateIndbox">To Value</div></div></div>';
                      $('#getQuaParData'+srNo).append(headData);

                       
                        
                        $.each(obj_rows, function (i, obj_row) {

                            if(srac == 1){

                              
                              console.log('itemC => ',obj_row.ITEM_CODE);
                              $('#showItemCode'+srNo).append(obj_row.ITEM_CODE);

                            }


                            var bodyData = '<div class="box-row"><div class="box10 itmdetlheading"><span id="srnum">'+srac+'</span></div><div class="box10 itmdetlheading" style="text-align: left;"><span id="accCode">'+obj_row.ICATG_CODE+'</span> </div><div class="box10 itmdetlheading"><span id="accName"> '+obj_row.IQUA_CHAR+'</span></div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.IQUA_DESC+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.CHAR_FROMVALUE+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.CHAR_TOVALUE+'</span> </div></div>';

                            srac++;
                            $('#getQuaParData'+srNo).append(bodyData);
                        });
                      }
                      
                  }
               }

          });


    }




</script>

<script type="text/javascript">
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

<script type="text/javascript">
  
  $('#btnpdf').click(function(){

          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var bank_code =  $('#bank_code').val();

          var acct_code =  $('#acct_code').val();
         
          var vr_num =  $('#vr_num').val();

          var store_action ='req';

          var recNoId         =  '';
          var recNoValueId    =  '';
          var lastUpId        =  '';
          var lastUpValueId   =  '';
          var VrNoId          =  '';
          var VrNoValueId     =  '';
          var SeriesNoId      =  '';
          var SeriesNoValueId =  '';
          var AccCodeId       =  '';
          var AccCodeValueId  =  '';
          var AmountId        =  '';
          var AmountValueId   =  '';
          var OtherDetailsId  =  '';
          var OtherDetValueId =  '';

        
          

          if (bank_code!='' || acct_code!='' || from_date!='' || to_date!='' || vr_num!='' || recNoId=='' || recNoValueId=='' || lastUpId=='' || lastUpValueId=='' || VrNoId=='' || VrNoValueId=='' || SeriesNoId=='' || SeriesNoValueId=='' || AccCodeId=='' || AccCodeValueId=='' || AmountId=='' || AmountValueId=='' || OtherDetailsId=='' || OtherDetValueId=='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date!=''){
              if(to_date==''){
                $('#show_err_to_date').html('Please select to date').css('color','red');
                return false;
              }
            }

            if(to_date!=''){
              if(from_date==''){
                $('#show_err_from_date').html('Please select from date').css('color','red');
                return false;
              }
            }

            
                            $.ajaxSetup({
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                              });

                             $.ajax({

                                url:"{{ url('/report/purchase-order/pdf') }}",

                                method : "POST",

                                type: "GET",

                                data: {recNoId:recNoId,recNoValueId:recNoValueId,lastUpId:lastUpId,lastUpValueId:lastUpValueId,VrNoId:VrNoId,VrNoValueId:VrNoValueId,SeriesNoId:SeriesNoId,SeriesNoValueId:SeriesNoValueId,AccCodeId:AccCodeId,AccCodeValueId:AccCodeValueId,AmountId:AmountId,AmountValueId:AmountValueId,OtherDetailsId:OtherDetailsId,OtherDetValueId:OtherDetValueId,bank_code:bank_code,acct_code:acct_code,vr_num:vr_num,from_date:from_date,to_date:to_date,store_action:store_action},

                                

                                success: function(response){

                                 console.log('response',response);

                                  if(response.response == 'success' && response.data !=''){

                                      var link = document.createElement('a');
                                      link.href = response.url;
                                      link.download = 'file.pdf';
                                      link.dispatchEvent(new MouseEvent('click'));

                                  }else{
                                    alert('no data');
                                  }

                                   

                                }, 

                                
                          });

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            
          }


        });
</script>

@endsection