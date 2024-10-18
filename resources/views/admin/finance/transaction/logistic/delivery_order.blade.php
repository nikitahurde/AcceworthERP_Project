@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')




<style type="text/css">

  .modal-header {
  position: sticky;
  top: 0;
  background-color: inherit; /* [1] */
  z-index: 1055; /* [2] */
}

/* Footer fixed to the bottom of the modal */
.modal-footer {
  position: sticky;
  bottom: 0;
  background-color: inherit; /* [1] */
  z-index: 1055; /* [2] */
}
  .indicateClass{
    border: 1px solid;
    width: 15px;
    padding: 1px;
    background-color: #eaeff1;
    border-color: #f1c88c;
    margin-right: 3px;
    margin-bottom: 3px;
    line-height: 0px;
}
.circleindicate{
  border: 1px solid;
    width: 3px;
    border-radius: 50px;
    padding: 4px;
    background-color: #e78e0e;
    color: #e78e0e;

}

.indicateAppClass{
    border: 1px solid;
    width: 15px;
    padding: 1px;
    background-color: #eaeff1;
    border-color: #67bfa7;
    margin-right: 3px;
    margin-bottom: 3px;
    line-height: 0px;
}
.circleAppindicate{
  border: 1px solid;
    width: 3px;
    border-radius: 50px;
    padding: 4px;
    background-color: #3c8dbc;
    color: #00a65a;
}
.indicateRejClass{
    border: 1px solid;
    width: 15px;
    padding: 1px;
    background-color: #eaeff1;
    border-color: #5cb85c;
    margin-right: 3px;
    margin-bottom: 3px;
    line-height: 0px;

}
.circleRejindicate{
  border: 1px solid;
    width: 3px;
    border-radius: 50px;
    padding: 4px;
    background-color: #5cb85c;
    color: #dd4b39;
}
  .hidebegore{

    display: none;

  }

  [data-tip] {
  position:relative;

}
[data-tip]:before {
  content:'';
  /* hides the tooltip when not hovered */
  display:none;
  content:'';
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid #1a1a1a; 
  position:absolute;
  top:20px;
  left:35px;
  z-index:8;
  font-size:0;
  line-height:0;
  width:0;
  height:0;
}
[data-tip]:after {
  display:none;
  content:attr(data-tip);
  position:absolute;
  top:25px;
  left:0px;
  padding:3px 3px;
  background:#1a1a1a;
  color:#fff;
  z-index:9;
  font-size: 0.75em;
  height:25px;
  line-height:18px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  white-space:nowrap;
  word-wrap:normal;
}
[data-tip]:hover:before,
[data-tip]:hover:after {
  display:block;
}

  table.dataTable {
      clear: both;
      margin-top: 0px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }
  .textLeft{
    text-align:left !important;
   padding-left: 5px !important;
  }
  .iconshowhide{
    display:none;
  }
  .hideThired{

    display: none;

  }

  .hideFouth{

    display: none;

  }

  .stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}
/*.columnWidth{
  width:40%;
}*/
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

.beforhidetble{
  display: none;
}

.modal-body{
    
    overflow-y: auto;
}

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

::placeholder {
  
  text-align:left;
}

.menutext{
    font-size: 12px;
    font-weight: 800;
    color: #4e9ecc;
    margin-left: 0PX;
    margin-top: 0%;
    margin-bottom: 0%;
  }

  .btn-group-sm>.btn, .btn-sm {
    padding: 4px 3px !important;
    font-size: 12px !important;
    line-height: 1 !important;
    border-radius: 3px !important;
}

.btn-sm-class{
    padding: 2px 4px !important;
    font-size: 12px !important;
    line-height: 1.5 !important;
    border-radius: 3px !important;
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
  padding: 2px !important;
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

    padding: 0px;

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

            <div class="box-header with-border" style="text-align: left;">

              <div class="row">
                <div class="col-md-4">

                  <form action="{{ url('/get-data-delivery-order-excel') }}" method="POST" enctype="multipart/form-data">
                  @csrf    
                  <div class="col-md-8">
                    <label> Excel File Template For Upload : </label>
                     <div class="form-group">

                          

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="doExcelListEx" class="form-control" name="do_excel_cd"  id="do_excel_cd" placeholder="Enter DO Excel Code" autocomplete="off" >

                              <datalist id="doExcelListEx">
                                
                                <?php foreach($do_excel_list as $key) { ?>

                                  <option value="<?= $key->EXLCONFIG_CODE ?>" data-xyz="<?= $key->EXLCONFIG_NAME ?>"><?= $key->EXLCONFIG_CODE ?> - <?= $key->EXLCONFIG_NAME ?></option>
                                
                                <?php } ?>

                              </datalist>

                            </div>
                        </div>
                      
                  </div>
                  <div class="col-md-4">
                    <button type="Submit" class="btn btn-success btn-sm"  id="downloadExcel" style="display:none;margin-top: 15%;margin-left:0%;width: 100%;"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp; Excel &nbsp;</button>
                  </div>
                  </form>
                </div>

                <div class="col-md-4" style="text-align:center;">
                   <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> {{ $title }}</h2>
                </div>
                <div class="col-md-4 box-tools text-right">
                  
                   <a href="{{ url('Transaction/Logistic/View-Delivery-Order') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Delivery Order</a>
                </div>
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
          <div class="modalspinner hideloaderOnModl"></div>
          
          <div class="panel-body">
              <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab1info">

                    <div class="row">

                      <!-- /.col -->
                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                             <?php 

                                $CurrentDate =date("d-m-Y");
                                   
                                $FromDate    = date("d-m-Y", strtotime($fromDate));  
                                   
                                $ToDate      = date("d-m-Y", strtotime($toDate));  
                                   
                                $formCurrentDt = date("Y-m-d", strtotime($CurrentDate));

                                if($formCurrentDt > $toDate){
                                  $vrDate =$ToDate;
                                }else{
                                  $vrDate =$CurrentDate;
                                }

                            ?>

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $vrDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control transdatepicker" name="vr" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off" onchange="vrDate()">

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

                              <input type="text" class="form-control" name="tran" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                              <input type="hidden" id="transtaxCode" >

                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

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
                            <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();">

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


                              <input type="text" class="form-control" name="tran" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

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

                            <input type="text" class="form-control" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                         </div>
                        <!-- /.form-group -->
                      </div>

                    </div>
                    <!-- /.row -->

                    <div class="row">
            
                      

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                               </span>
                              <?php $plcount = count($plant_list); ?>
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>"  autocomplete="off" onchange="PlantCode()" readonly>

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

                              <input type="text" class="form-control" name="plantname" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME;}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

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
                              <input type="text"  id="profitctrId" name="pfct" class="form-control  pull-left" placeholder="Select Profit Center Code"  readonly >


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

                              <input type="text" class="form-control" name="pfctname" id="pfctName" placeholder="Enter Profit Center Name" readonly>

                            </div>

                        </div>
                        
                      </div>

                    
                      
                    </div> <!-- row -->

                    <div class="row">

                        <div class="col-md-2">

                        <div class="form-group">

                          <label>Customer Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="" placeholder="Select Customer" readonly="" autocomplete="off"> 

                              <datalist id="AccountList">

                              
                                @foreach ($getacc as $key)

                               <option value='<?php echo $key->ACC_CODE?>'  data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                            <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                            <small id="acccode_code_errr" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Customer Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="acctname" value="" id="accountName" placeholder="Enter Department Name" readonly autocomplete="off">

                            </div>
                            
                        </div>
                        
                      </div>

                     
                       <div class="col-md-2">

                        <div class="form-group">

                          <label> DO Excel Code : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="doExcelList" class="form-control" name="do_excel_code"  id="do_excel_code" placeholder="Enter DO Excel Code" autocomplete="off" readonly>

                              <datalist id="doExcelList">
                                
                                <?php foreach($do_excel_list as $key) { ?>

                                  <option value="<?= $key->EXLCONFIG_CODE ?>" data-xyz="<?= $key->EXLCONFIG_NAME ?>"><?= $key->EXLCONFIG_CODE ?> - <?= $key->EXLCONFIG_NAME ?></option>
                                
                                <?php } ?>

                              </datalist>

                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="freight_order_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div> 

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> DO Excel Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="do_excel_name"  id="do_excel_name" placeholder="Enter DO Excel Name" autocomplete="off" readonly>


                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="freight_order_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div> 
                      
                    
                   


                    </div> <!-- row -->

                  <div class="row">
                    <div class="col-md-2">

                        <div class="form-group">

                          <label> REF COMP CODE : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="compList" class="form-control" name="ref_comp_code"  id="ref_comp_code" placeholder="Enter REF COMP CODE" autocomplete="off">

                                  <datalist id='compList'>
                                    <?php foreach ($comp_list as $key) { ?>
                                      <option value="<?=  $key->COMP_CODE ?>" data-xyz='<?=  $key->COMP_NAME ?>'><?=  $key->COMP_CODE ?> - <?=  $key->COMP_NAME ?></option>
                                     <?php } ?>
                                  </datalist>

                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="freight_order_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div> 

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> REF COMP NAME : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="ref_comp_name"  id="ref_comp_name" placeholder="Enter REF COMP NAME" autocomplete="off">


                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="freight_order_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div>

                      <div class="row" style="display: none;" id="rakeFeild">

                   <div class="col-md-2">

                        <div class="form-group">

                          <label>Rake No: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                               </span>
                            
                              <input type="text" class="form-control" id="rake_no" name="rake_no" placeholder="Select Plant"  value=""  autocomplete="off">

                         

                            </div>

                            <small>  

                                <div class="pull-left showSeletedName" id="rake_no"></div>

                            </small>

                            <small id="rake_no_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Rake Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                             <?php 

                                $CurrentDate =date("d-m-Y");
                                   
                                $FromDate    = date("d-m-Y", strtotime($fromDate));  
                                   
                                $ToDate      = date("d-m-Y", strtotime($toDate));  
                                   
                                $spliDate    = explode('-', $CurrentDate);
                                   
                                $yearGet     = Session::get('macc_year');
                                   
                                $fyYear      = explode('-', $yearGet);
                                   
                                $get_Month   = $spliDate[1];
                                $get_year    = $spliDate[2];

                                if($get_Month > 3 && $get_year == $fyYear[1]){
                                    $vrDate = $ToDate;
                                }else{
                                    $vrDate = $CurrentDate;
                                }

                              ?>

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control datepicker" name="rake_date" id="rake_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

                            </div>

                            <small id="showmsgfordate" style="color: red;"></small>

                            <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('rake_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>
                        </div>
                            <!-- /.form-group -->
                      </div>
                          <!-- /.col -->
                    

                    <div class="col-md-2">

                        <div class="form-group">

                          <label>Placement Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                              
                              <input type="text" class="form-control" name="placement_date" id="placement_date" value="" placeholder="Select Placement Date" autocomplete="off">

                            </div>

                            <small id="showmsgfordate" style="color: red;"></small>

                            <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('placement_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>
                        </div>
                            <!-- /.form-group -->
                      </div>
                  
                </div> 
                  </div>

                
               <div class='row'>



               <div class="col-md-12">

                  <form name="data-form" id="data-form" enctype="multipart/form-data">
                        @csrf
                    <div class="row">

                      <div class="col-md-3">
                        <div class="form-group">

                          <label for="exampleInputEmail1">Select File : </label>

                          <input type="file" name="import_file" class="form-control-file" id="customFile">

                          <small id="excelerr" style="color: red;"></small>

                        </div>
                      </div>

                        <div class="col-md-2" style="margin-top: 7px;">
                          <button type="submit" class="btn btn-primary btn-sm-class" id="importbtn" disabled="">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;IMPORT DO&nbsp;&nbsp;</button>
                        </div>

                        <div>
                          <input type="hidden" name="tempvrno" id="tempvrno">
                          <input type="hidden" name="temptransporter" id="temptransporter">
                          <input type="hidden" name="tempdoexcelcode" id="tempdoexcelcode">
                        </div>
                      
                    </div>

                  
                    </form>

                  </div>
                      
              </div>
                  
                   
                   </div>

                  </div> <!-- /.tab first -->
                  <div>
              </div>
          </div>
        </div>
      </div>
    </div>
            
         
          <div class="row" id="indicate_msg" style="display:none;">

            <div class="col-md-12">

              <button class="btn btn-warning btn-sm" style="padding: 2px 6px !important;
                font-size: 9px !important;"><i class="fa fa-user-circle" aria-hidden="true" style="font-size: 13px;padding-top: 2px;" title="ACC CODE"></i></button><span style="margin-left: 5px;margin-bottom: 2px;font-size: small;font-weight: bold;white-space: nowrap;color: #444;"> IF ACCOUNT NOT EXIST</span>&nbsp;&nbsp;
                          

                            <button class="btn btn-primary btn-sm" style="padding: 2px 6px !important;
                font-size: 9px !important;"><i class="fa fa-list-alt" aria-hidden="true" style="font-size: 13px;padding-top: 2px;" title="ACC CODE"></i></button><span style="margin-left: 5px;margin-bottom: 2px;font-size: small;font-weight: bold;white-space: nowrap;color: #444;"> IF ITEM NOT EXIST</span> &nbsp;&nbsp;

                            <button class="btn btn-info btn-sm" style="padding: 2px 6px !important;
                font-size: 9px !important;"><i class="fa fa-sort-amount-asc" style="font-size: 13px;padding-top: 2px;" aria-hidden="true" title="ACC CODE"></i></button><span style="margin-left: 5px;margin-bottom: 2px;font-size: small;font-weight: bold;white-space: nowrap;color: #444;"> IF QTY UPDATE</span>
            </div>

          </div>

              <!-- <div class="row">
                  <div class="col-md-4">
                    <div class="indicateClass">
                     
                      <div class="circleindicate"><div style="margin-left: 20px;margin-bottom: 2px;font-size: small;font-weight: bold;white-space: nowrap;color: #444;">IF ACCOUNT NOT EXIST</div> </div>
                       
                    </div>
                    <div class="indicateAppClass">
                      <div class="circleAppindicate"><div style="margin-left: 20px;margin-bottom: 2px;font-size: small;font-weight: bold;white-space: nowrap;color: #444;">IF ITEM NOT EXIST</div></div>
                      
                    </div>
                    <div class="indicateRejClass">
                      <div class="circleRejindicate"><div style="margin-left: 20px;margin-bottom: 2px;font-size: small;font-weight: bold;white-space: nowrap;color: #444;">IF QTY UPDATE</div></div>
                      
                    </div>
                  </div>
                 
                 
              </div> -->
            

          </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->


<section class="content" style="margin-top: -10%;display: none;" id="doexccedingId">

  <div class="row">

   <div class="col-sm-12">

    <div class="box box-primary Custom-Box">

            <div class="box-body">

                <form id="bodyformexId">
                  
                  <div id="dfg1" class="table-responsive">
                    
                    <table id="doexceedingexample"  class="table display nowrap table-bordered table-striped table-hover">

                       <input type="hidden" name="" id="ececelExcCount" value='<?php echo count($exceedingcolumnlist); ?>'>

                         <input type="hidden" name="tempdataCount1" id="tempdataCount1" value=''>

                      <thead>

                        <tr>

                           <th class="text-center">Sr.NO</th>

                             <th class="text-center">Item/Acc Name</th>
                           <th class="text-center">Do status</th>
                           <th class="text-center" style="display: none;">NOT FOUND</th>


                           <?php $num=1; foreach($exceedingcolumnlist as $key) { ?>

                              

                             <th class="text-center"><?= $key->EXCEL_COL ?><input type='hidden'  value="<?= $key->TEMPEXCEL_COL ?>" id="excelcol_exceeding<?= $num  ?>" dataex-id='<?php echo $key->TBL_COL; ?>'><input type="hidden" value="<?php echo $key->TBL_COL; ?>" name="temptable_col_exceeding"></th>
                              
                             

                           <?php $num++; } ?>

                           
                        </tr> 
    

                      </thead>

                      <tbody>

                    

                      </tbody>

                      

                    </table>

                </div>

                    <p class="text-center">

                      <button class="btn btn-success btn-sm-class" type="button" id="submitexcelEXdata" onclick="submitexData()" disabled=""><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Save&nbsp;&nbsp;</button>

                        <input type="hidden" name="importExcel1" id="importExcel1">

                      <button class="btn btn-warning btn-sm-class" type="button" id="CancleExcelEXBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Cancle&nbsp;&nbsp;</button>

                    </p>

            </form>

       </div>
      </div>
    </div>
  </div>
</section>


 <section class="content" style="margin-top: -10%;display: none;" id="datatableId">

  <div class="row">

   <div class="col-sm-12">

    <div class="box box-primary Custom-Box">


            <div class="box-body">

            

                <form id="bodyformId">
                  
                  <div id="dfg">

                    <table id="example" class="table table-bordered table-striped table-hover table-responsive">

                       <input type="hidden" name="" id="ececelCount" value='<?php echo count($columnlist); ?>'>

                        <input type="hidden" name="tempdataCount" id="tempdataCount" value=''>

                      <thead>

                        <tr>

                           <th class="text-center">Sr.NO</th>

                          <th class="text-center">Item/Acc Name</th>
                          <th class="text-center">Do status</th>
                          <th class="text-center" style="display: none;">NOT FOUND</th>

                           <?php $srno=1; foreach($columnlist as $key) { ?>

                              
                             <th class="text-center"><?= $key->EXCEL_COL ?><input type='hidden'  value="<?= $key->TEMPEXCEL_COL ?>" id="excelcol<?= $srno  ?>" data-id='<?php echo $key->TBL_COL; ?>'><input type="hidden" value="<?php echo $key->TBL_COL; ?>" name="temptable_col"></th>
                              
                             
                           <?php $srno++; } ?>

                         

                        </tr> 
    

                      </thead>

                      <tbody>

                    

                      </tbody>

                      

                    </table>

                </div>

                    <p class="text-center">

                      <button class="btn btn-success btn-sm-class" type="button" id="submitexceldata" onclick="submitData()"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Save&nbsp;&nbsp;</button>

                        <input type="hidden" name="importExcel" id="importExcel">

                      <button class="btn btn-warning btn-sm-class" type="button" id="CancleExcelBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Cancle&nbsp;&nbsp;</button>

                    </p>

            </form> 

       </div>
     </div>
   </div>

          


  <!-- ADD ACC MASTER -->

  <div class="modal fade" id="newAccModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">

        
        <h5 class="modal-title menutext" id="exampleModalLabel" style="text-align:center;">SELECT ACOUNT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- add master acc -->

    <div class="box-body">

        <form  id="accformid">
         @csrf
        <div id="AccPageShow">
          
           

        </div>

            <input type="hidden" name="temptableidacc" id="temptableidacc">
            <input type="hidden" name="tblcolacc" id="tblcolacc">
            <input type="hidden" name="tblcol" id="tblcol">
            <input type="hidden" name="tblcoldo" id="tblcoldo">
            <input type="hidden" name="temptableidDo" id="temptableidDo">

      </form>
    
    </div>

         <!-- add master acc -->
      </div>

       
      </div>
      
    </div>
  </div>


  <!-- ADD ACC MASTER -->


<!-- ACC CODE MODAL -->








 

  <!-- ACC CODE MODAL -->

  <!-- ITEM CODE MODAL -->
 

  
 <!-- <input type="hidden" name="temptableid" id="temptableid">
  <input type="hidden" name="tblcol" id="tblcol"> -->


  

  <!-- ITEM CODE MODAL -->

 <!--  ADD NEW ITEM MODAL -->

 <div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title menutext" id="exampleModalLabel" style="text-align:center">ADD NEW ITEM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
       <!--  item form -->

       <div class="box-body">

        <form id="itemformid">

               @csrf
            <div id="ItemPageShow"></div>


            <input type="hidden" name="temptableid" id="temptableid">
            <input type="hidden" name="tblcol" id="tblcol">
            <input type="hidden" name="tblcol2" id="tblcol2">

          </form>

      </div><!-- /.box-body -->
       <!--  item form -->
        
      </div>

         <div class="modal-footer" style="text-align:center;">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary btn-sm" onclick="submitItemData()"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save </button>
            </div>
        
      </div>
      
    </div>
  </div>
 <!--  ADD NEW ITEM MODAL -->
</div>


        </section>

  <section class="content" style="margin-top: -10%;" id="bodyId">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <form id="salesordertrans">
              @csrf
              <div class="table-responsive">
                <div id="tableid" >
                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                  <input type ="hidden" name="comp_name" id="getCompName">
                  <input type ="hidden" name="fy_year" id="getFyYear">
                  <input type ="hidden" name="trans_date" id="getTransDate">
                  <input type ="hidden" name="vr_no" id="getVrNo">
                  <input type ="hidden" name="trans_code" id="getTransCode">
                  <input type ="hidden" name="accCode" id="getAccCode">
                  <input type ="hidden" name="accName" id="getAccName">
                  <input type ="hidden" name="refcompCode" id="getRefCompCode">
                  <input type ="hidden" name="refcompName" id="getRefCompName">
                  <input type ="hidden" name="RouteCode" id="getRouteCode">
                  <input type ="hidden" name="RouteName" id="getRouteName">
                  <input type ="hidden" name="FreightNo" id="getFreightNo">
                  <input type ="hidden" name="departName" id="getDeptName">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="pfct_name" id="getPfctName">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="plant_name" id="getPlantName">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
                  <input type ="hidden" name="series_name" id="getSeriesName">
                  <input type ="hidden" name="tax_code" id="getTaxCode">
                  <input type="hidden" name="due_days" id="gateduedays">
                  <input type="hidden" name="getdue_date" id="gateduedate"> 
                  <input type ="hidden" name="party_ref_no" id="getpartyrfNo">
                  <input type ="hidden" name="party_ref_date" id="getpartyrfDate">
                  <input type ="hidden" name="consine_code" id="getcosine">
                  <input type ="hidden" name="rfhead1" id="getrfhead1">
                  <input type ="hidden" name="rfhead2" id="getrfhead2">
                  <input type ="hidden" name="rfhead3" id="getrfhead3">
                  <input type ="hidden" name="rfhead4" id="getrfhead4">
                  <input type ="hidden" name="rfhead5" id="getrfhead5">
                  <input type ="hidden" name="rfhead5" id="getrfhead5">
                  <input type="hidden" name="cost_code" id="cost_code">
                  <input type="hidden" name="fromplace" id="fromplace">
                  <input type="hidden" name="rakeNo" id="rakeNo">
                  <input type="hidden" name="rakeDate" id="rakeDate">
                  <input type="hidden" name="placeDate" id="placeDate">
                  <input type="hidden" name="importfilename" id="filename">
                  <input type="hidden" name="comp_name" value="<?php echo Session::get('company_name'); ?>">
                  <input type="hidden" name="fiscal_year" value="<?php echo Session::get('macc_year'); ?>">
                  <tr>

                    <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 10px;"> Sr.No.</th>

                  <!--   <th>ROUTE CODE.</th>
                    <th>ROUTE NAME</th> -->
                    <th>DO NO</th>
                    <th>DO DATE</th>
                    <th>ITEM CODE </th>
                    <th>ITEM NAME</th>
                    <th>CONSIGNEE</th>
                    <th>ADDRESS</th>
                    <th>ALLOCATED QTY </th>
                    <th>BATCH NO </th>
                    <th>FROM PLACE</th>
                    <th>TO PLACE</th>
                    
                    



                  </tr>

                  <tr class="useful">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">1.</span>
                    </td> 

                  <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input type="text" class="inputboxclr" style="width: 100px;" id='dono1' name="dono[]"   oninput="this.value = this.value.toUpperCase()" autocomplete='off' readonly/>
                     </div>
                    </td>
                     <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input type="text" class="inputboxclr  datepicker rightcontent" style="width: 100px;padding: 1px;" id='do_date1' name="do_date[]"   oninput="this.value = this.value.toUpperCase()" autocomplete='off' />
                     </div>

                      <div id='odcbtn1'></div>
                    </td>

                     <td class="tdthtablebordr" style="width: 30px;">
                      <div style="display: inline-flex;border: none;">
                        <input list="ItemList1" class="inputboxclr" style="width: 100px;" id='ItemCodeId1' name="itemCode[]"   oninput="this.value = this.value.toUpperCase()" onchange="itemCodeGet(1)" autocomplete='off' />

                          <datalist id="ItemList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($help_item_list as $key)

                              <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEMNAME ?>" ><?php echo $key->ITEMNAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                              @endforeach

                          </datalist>

                          <input type="text" name="itemlwh[]" id="itemlwh1" style="width: 100px;" class="inputboxclr rightcontent" autocomplete="off" readonly="">

                      </br>

                        
                          
                      </div>
                      <div style='margin-top:2px;'>
                       <label>L</label> &nbsp;<input type="text" class="inputboxclr rightcontent" name="length[]" style="width: 50px;" id="length1" oninput="funCalODC(1)" placeholder="LENGTH" autocomplete='off'>
                        <label>W</label> &nbsp;<input type="text" class="inputboxclr rightcontent" name="width[]" style="width: 50px;" id="width1" oninput="funCalODC(1)" placeholder="WIDTH" autocomplete='off'> 
                       <label>H</label> &nbsp;<input type="text" class="inputboxclr rightcontent" name="height[]" style="width: 50px;" id="height1" oninput="funCalODC(1)" placeholder="HEIGHT" autocomplete='off'>

                       <input type="hidden" name="" id="length_dub1">
                       <input type="hidden" name="" id="width_dub1">
                       <input type="hidden" name="" id="height_dub1">
                      </div>
                       <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>
                      <!--  <div><p id="stockavlble1" class="badge" style="background-color:#25b6bd;"></p>
                       </div> -->
                      
                    </td>

                    <td class="tdthtablebordr tooltips">

                       <input type="text" class="inputboxclr getAccNAme" style="width: 190px;" id='Item_Name_id1' name="itemName[]" autocomplete='off' readonly /><br>

                       <textarea type="text" class="inputboxclr getAccNAme" style="width: 190px;height: 21px;" id='remark1' name="remark[]" autocomplete='off'></textarea>
                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small><br>


                    </td>

                    <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input list="ConsineeList1" class="inputboxclr" style="width: width: 139px;" id='consignee1' name="consignee[]"  onchange="consigneeName(1)"  oninput="this.value = this.value.toUpperCase()" autocomplete='off' />

                       <datalist id="ConsineeList1">

                              
                                @foreach ($getconsinee as $key)

                               <option value='<?php echo $key->ACC_CODE?>'  data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?></option>

                                @endforeach

                              </datalist>


                     </div>
                      <div style='margin-top:2px;'>
                        <input type="text" class="inputboxclr" name="consineeName[]" id="consineeName1" autocomplete='off' readonly>
                     </div>
                    </td>
                      <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input list="ConsineeAddList1" class="inputboxclr" style="width: width: 139px;" id='consigneeadd1' name="consigneeadd[]" onchange="getcityName(1)"  oninput="this.value = this.value.toUpperCase()" autocomplete='off' />

                       <datalist id="ConsineeAddList1">
                        </datalist>


                     </div>
                      
                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">

                      <!-- <input type='text' class="debitcreditbox dr_amount inputboxclr  getqtytotal quantityC moneyformate"  id='qty1' name="qty[]" oninput='Getqunatity(1)'style="width: 70px;" readonly autocomplete='off' /> -->

                       <input type='text' class="debitcreditbox dr_amount inputboxclr  getqtytotal quantityC moneyformate" id='qty1' name="qty[]" oninput='Getqunatity(1)' style="width: 70px;" readonly autocomplete='off' />
                      <input type="hidden" id="qtyget1" class="totlqty">
                      <input type="text" name="unit_M[]" id="UnitM1" class="inputboxclr AddM" autocomplete='off'>

                      <input type="hidden" id="Cfactor1" />


                      </div>

                     
                      <!-- <input type="text" class="form-control" name="odc[]" id="odc1" readonly> -->
                      

                     
                       <div><small id="errmsgqty1"></small></div>

                    </td>

                      <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 80px;" id='batch_no1' name="batch_no[]" autocomplete='off'/>

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small><br>


                    </td>
                    <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input list="fromplaceList1" class="inputboxclr" style="width: 100px;" id='from_place1' name="from_place[]"  autocomplete='off'  oninput="this.value = this.value.toUpperCase()" onchange="getRouteDetails(1)" />

                            <datalist id="fromplaceList1">

                                 <?php foreach($area_list as $key) { ?>

                                  <option value="<?= $key->CITY_NAME ?>" data-xyz="<?= $key->CITY_CODE ?>"><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option>

                                <?php  } ?>

                              </datalist>
                     </div>
                    </td>


                    <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">

                       <input list="toplaceList1" class="inputboxclr" style="width: 100px;" id='to_place1' name="to_place[]"  autocomplete='off' oninput="this.value = this.value.toUpperCase()"  />

                       <datalist id="toplaceList1">
                         <?php foreach($area_list as $key) { ?>

                                  <option value="<?= $key->CITY_NAME ?>" data-xyz="<?= $key->CITY_CODE ?>"><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option>

                                <?php  } ?>

                      </datalist>
                     </div>
                    </td>
                    
                    

                    
                     
                    

                    

                  </tr>

                </table>

              </div>

              </div><!-- /div -->

            
              <div class="row" style="display: flex;">

                  <div class="col-md-6"></div>

                    <div class="col-md-4 toalvaldesn">



                    <div class="totlsetinres">Total :</div>

                  </div>

                  <div class="col-md-1">
                     <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="basicTotal" readonly="" style="margin-top: 3px;width: 107px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>


        
<style type="text/css">

  .rTable { display: table; }

.rTableRow { display: table-row; }

.rTableHeading { display: table-header-group; }

.rTableBody { display: table-row-group; }

.rTableFoot { display: table-footer-group; }

.rTableCell, .rTableHead { display: table-cell; }

  .rTable {
   display: table;
   /*width: 100%;*/
}

.rTableRow {

   display: table-row;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

}

.rTableCell, .rTableHead {

   display: table-cell;

   padding: 3px 10px;

   border: 1px solid #ebe7e7;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

   font-weight: bold;

}

.rTableFoot {

   display: table-footer-group;

   font-weight: bold;

   background-color: #ddd;

}

.rTableBody {

   display: table-row-group;

}

.setInline{

  display: flex;

  margin-bottom: 4px;

}

.rowClass{

  margin: 0px;

  margin-top: 3%;

}

.rowClass1{

  margin: 0px;

  margin-top: 0%;

}

.rowClassonModel{

   margin: 0px;

  margin-top: 1%;

}

.LableTextField{

  text-align: center;

  font-weight: 600;

}

.distClass{

  display: none;



}

.sgstBlock{

  display: none;

}

.cgstBlock{

  display: none;

}

.afforblck{

  display: none;

}

.affiveblck{

  display: none;

}

.afsixblck{

  display: none;

}

.afsevenblck{

  display: none;

}

.afheadeightblck{

  display: none;

}

.afheadnineblck{

  display: none;

}

.afheadtenblck{

  display: none;

}

.afheadelvnblck{

  display: none;

}

.afheadtwelblck{

  display: none;

}

.getheading{

  border: none;

  width: 61px;

}
.settaxcodemodel{
  font-size: 16px;
    font-weight: 800;
    color: #5d9abd;
}

</style>    

      <br>

        <button type="button" class='btn btn-danger btn-sm-class delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp;&nbsp;Delete&nbsp;&nbsp;</button>

        <button type="button" class='btn btn-info btn-sm-class addmore' id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp;&nbsp;Add More&nbsp;&nbsp;</button>

        <p class="text-center">

          <button class="btn btn-success btn-sm-class" type="button" id="submitdata" onclick="submitData()" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Save&nbsp;&nbsp;</button>

          <button class="btn btn-warning btn-sm-class" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Cancel&nbsp;&nbsp;</button>

          <div id="dubliucatedO"></div>

        </p>

       

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
              .boxer .hidebordritm {
                display: table-cell;
                vertical-align: top;
                border: none;
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
              .showind_Ch{
                display: none;
              }
            </style>
      <!-- when hsn code same then show model -->

      <div class="modal fade" id="quality_parametr1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">

                <div class="col-md-12">
                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Qaulity Parameter</h5>
                </div>

              </div>

            </div>

            

            <div class="modal-body table-responsive">

                <div class="boxer" id="qua_par_1">
                
                  
                </div>

            </div>

          <div class="modal-footer">
           
            <center><small style="text-align: center;" id="footer_qaulity_btn1"></small>
            <small style="text-align: center;" id="footer_ok_btn1"></small>
            </center>

          
          </div>

          </div>

        </div>

      </div>
      <!-- model -->
      <!-- when hsn code same then show model -->

      <!-- show modal when click on view btn after item select item -->

        <div class="modal fade" id="view_detail1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Item Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox1">Item Name/Item Code</div>
                    <div class="box10 rateIndbox">HSN Code</div>
                    <div class="box10 rateIndbox">Tax Code</div>
                    <div class="box10 rateBox">Item Detail</div>
                    <div class="box10 amountBox">Item Type</div>
                    <div class="box10 amountBox">Item Group</div>
                    <div class="box10 amountBox">Item Class</div>
                    <div class="box10 amountBox">Item Category</div>
                  </div>
                  
                  <div class="box-row">
                    <div class="box10 itmdetlheading">
                      <small id="itemCodeshow1"> </small>
                    </div>
                   <!--  <div class="box10 itmdetlheading">
                      <small id="itemNameshow1"> </small>
                    </div> -->
                    <div class="box10 itmdetlheading">
                      <small id="hsncodeshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="taxcodeshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemDetailshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemtypeshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemgroupshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemclassshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemcategoryshow1"> </small>
                    </div>
                  </div>
                  
                </div>
              </div>


              <div class="modal-footer" style="text-align: center;">
               
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button>

              </div>

            </div>

          </div>

        </div>

      <!-- show modal when click on view btn after item select item -->

      <!-- show modal when click on view btn after  select series -->

        <div class="modal fade" id="series_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Series Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox1">Series Code</div>
                    <div class="box10 rateIndbox">Series Name</div>
                    <div class="box10 rateIndbox">Tran Code</div>
                    <div class="box10 rateIndbox">Gl Code</div>
                    <div class="box10 rateBox">Post Code</div>

                    <div class="box10 amountBox">Rfhead1</div>
                    <div class="box10 amountBox">Rfhead2</div>
                    <div class="box10 amountBox">Rfhead3</div>
                    <div class="box10 amountBox">Rfhead4</div>
                  </div>
                  
                  <div class="box-row">
                    <div class="box10 itmdetlheading">
                      <span id="seriesCodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="seriesNameshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="trancodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="glcodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="postcodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead1show"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead2show"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead3show"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead4show"> </span>
                    </div>
                  </div>
                  
                </div>
              </div>


              <div class="modal-footer" style="text-align: center;">
               
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button>

              </div>

            </div>

          </div>

        </div>


       

      <!-- show modal when click on view btn after item select series -->


      <!-- show modal when click on view btn after  select plantcode -->

        <div class="modal fade" id="plant_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Plant Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox1">Plant Name/Plant Code</div>
                   
                    <div class="box10 rateIndbox">Pfct Code</div>
                    <div class="box10 rateIndbox">Address</div>
                    <div class="box10 rateBox">City</div>

                    <div class="box10 amountBox">Pin Code</div>
                    <div class="box10 amountBox">District</div>
                    <div class="box10 amountBox">state</div>
                    <div class="box10 amountBox">Email</div>
                    <div class="box10 amountBox">Phone No</div>

                  </div>
                  
                  <div class="box-row">
                    <div class="box10 itmdetlheading">
                      <span id="plantCodeshow"> </span>
                    </div>
                    
                    <div class="box10 itmdetlheading">
                      <span id="plantpfctcodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantaddshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantcityshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantpinshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantdistshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantstateshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantemailshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantphoneshow"> </span>
                    </div>
                  </div>
                  
                </div>
              </div>


              <div class="modal-footer" style="text-align: center;">
               
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button>

              </div>

            </div>

          </div>

        </div>

      <!-- show modal when click on view btn after item select plantcode -->

       <!-- when tax not applied then show model -->

        
      <!-- when tax not applied then show model -->

       <div id="stockNotAvlble" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                <div class="modal-body">
                   <b><p id="taxnotApMsg"></p></b>
                 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" >Cancel</button>
                </div>
            </div>
        </div>
    </div>

  

    </form>

  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

</div>


   <div id="dublicateModal" class="modal fade" tabindex="-1">
          <div class="modal-dialog modal-sm" style="margin-top: 13%;">
              <div class="modal-content" style="border-radius: 5px;">
                  <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                  </div>
                  <div class="modal-body">
                    <p style="text-align:center;">Do Number Already Exist !</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-sm-class" data-dismiss="modal" >&nbsp;&nbsp;Cancel</button>
                      <button type="button" class="btn btn-primary btn-sm-class" id="savedataAfterAlert" data-dismiss="modal">Ok</button>
                  </div>
              </div>
          </div>
        </div>

        <div id="allcQTY" class="modal fade" tabindex="-1">
          <div class="modal-dialog modal-sm" style="margin-top: 13%;">
              <div class="modal-content" style="border-radius: 5px;">
                  <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;">ALLOCATED QTY </h5>
                    
                  </div>
                  <div class="modal-body">
                    
                    <div class="row">
                      <div class="col-md-12">


                          <div class="col-md-12">

                            <div class="form-group">

                              <label> Old Qty : </label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                 
                                  <input type="text" class="form-control" name="old_qty" value="" id="old_qty" readonly placeholder="Old Qty" autocomplete="off">
                                 

                                </div>
                              
                            </div>

                            <div class="form-group">

                              <label> Allocated Qty : </label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input type="text" class="form-control" name="allc_qty" value="" id="allc_qty" readonly placeholder="Enter Allocated Qty" autocomplete="off">
                                  <input type="hidden" class="form-control" name="donoqty" value="" id="donoqty" placeholder="Enter Allocated Qty" autocomplete="off">
                                  <input type="hidden" class="form-control" name="itemslno" value="" id="itemslno" placeholder="Enter Allocated Qty" autocomplete="off">

                                </div>
                                <small id="allcqtyerr"></small>
                                
                            </div>
                            
                          </div>
                        
                      </div>
                      
                    </div>
                  </div>
                  <div class="modal-footer" style="text-align:center;">
                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" >Cancel</button>
                      <button type="button" class="btn btn-primary btn-sm" onclick="GetAllctQTY()">Ok</button>
                       <button type="button" class="btn btn-info btn-sm" id="proceedbtn" onclick="updatedAllctQTY(1)" disabled>Proceed</button>
                  </div>
              </div>
          </div>
        </div>


    <div class="modal fade" id="excidingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="AccModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">
    <div class="modal-content">
      <div class="modal-header">

        <div class="row">

         
              <div class="col-md-4">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newAccModal" style="font-size:12px;line-height:1;margin-top: -8px;" onclick="hideAccModal()">
                 Add New Account
              </button>
              </div>
              <div class="col-md-4">
                
                <h5 class="modal-title menutext" id="exampleModalLabel" style="text-align: center;">SELECT ACOUNT</h5>
              </div>
              <div class="col-md-4">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                     </button>
              </div>
            
        </div>
      
      </div>

       


      <div class="modal-body">

      
        
        <div class='row'>

          <div class="col-md-12">

                   <input type="hidden" name="accAliseName" id="accAliseName" value="">
                   <input type="hidden" name="accAliseCode" id="accAliseCode" value="">
                   <input type="hidden" name="accType" id="accType" value="">
                   <table id="AccTable" class="table table-bordered table-striped table-hover" style="width:100%">

                     <div class="modalspinner hideloaderOnModl"></div>
                      <thead>

                        <tr>

                           <th class="text-center">#</th>
                           <th class="text-center">ACC CODE</th>                              
                           <th class="text-center">ACC NAME</th>
                           <th class="text-center">ALIAS CODE</th>
                           <th class="text-center">ALIAS NAME</th>
                           <th class="text-center">CITY NAME</th>
                          
                        </tr> 
    

                      </thead>

                      <tbody>


                  </tbody>

                </table>

               
          </div>
          
        
        </div>
        </div>

        <div class="modal-footer" style="text-align:center;">
          <div style='color: red;margin-bottom: 1%;'>Note : Please Check City Name Properly.</div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="getAccValue();">Save</button>
      </div>
      </div>
      
    </div>
  </div>


   <div class="modal fade" id="ItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">
    <div class="modal-content">

      <div class="modal-header">

        <div class="row">
          <div class="col-md-4">
             <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"  style="font-size:12px;line-height:1;text-align: center;margin-top: -8px;" onclick="hideItemModal()">
                 Add New Item
          </button> 
          </div>
          <div class="col-md-4">
             <h5 class="modal-title menutext" id="exampleModalLabel" style="text-align: center;">SELECT ITEM</h5>
          </div>
          <div class="col-md-4">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          
        </div>
       
        
      </div>

      <div class="modal-body">
        
          

            <div class="row">

                <div class="col-md-12">

                  <input type="hidden" name="itemAliseName" id="itemAliseName" value="">
                  <input type="hidden" name="itemAliseCode" id="itemAliseCode" value="">

                   <table id="ItemTable" class="table table-bordered table-striped table-hover table-responsive" style="width:100%">

                      <div class="modalspinner hideloaderOnModl"></div>
                      <thead style="width:100%">

                        <tr>

                           <th class="text-center">#</th>

                           <th class="text-center">ITEM CODE/</th>
                              
                           <th class="text-center">ITEM NAME</th>
                          
                        </tr> 
    

                      </thead>

                      <tbody style="width:100%">


                      </tbody>

                </table>

                </div>

          </div>
        </div>

        <div class="modal-footer" style="text-align:center;">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="getItemValue();">Save</button>
      </div>
      </div>
      
    </div>
  </div>



@include('admin.include.footer')

 

<script src="{{ URL::asset('public/dist/js/viewjs/delivery_order.js') }}" ></script>


<script type="text/javascript">

  $(document).ready(function(){
    

    $("#rake_date").click(function() {

      $("#placement_date").val('');
      $('#placement_date').datepicker('destroy');

    })

    

    $("#placement_date").click(function() {

        var fromDate = $('#rake_date').val();
        var splitFrom    = fromDate.split("-");

        var mergeFrDate = splitFrom[1]+'-'+splitFrom[0]+'-'+splitFrom[2];
        var getmergeFr = new Date(mergeFrDate);

        getmergeFr.setDate(getmergeFr.getDate() + 1); 

        var getdate = getmergeFr.getDate();
        var getMonth=getmergeFr.getMonth()+1;
        var getYear = getmergeFr.getFullYear();
        var netDate =getYear+'-'+getMonth+'-'+getdate;

        var dt = new Date(netDate);
        var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(dt);
        var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(dt);

        var middleDateStart =da+'-'+mo+'-'+getYear;

        $('#placement_date').datepicker({
          format: 'dd-mm-yyyy',
          orientation: 'bottom',
          todayHighlight: 'true',
          startDate: middleDateStart,
          endDate: 'today',
          autoclose: 'true'
        });
         $('#placement_date').datepicker('show');

         
         
        
    });


  });


  
</script>

<script type="text/javascript">
  function vrDate(){

    var vrDate = $("#vr_date").val();

    if(vrDate){
      $("#getTransDate").val(vrDate);
    }else{
       $("#getTransDate").val('');
    }
  
  }
</script>
 
<script type="text/javascript">




  
  $(document).ready(function() {


     $('#upload-btn').click(function(e){
        e.preventDefault();
        $('#customFile').click();

        var fileValue = $("#customFile").val();

         $("#importbtn").prop('disabled', false);

        
          //console.log(fileValue);
      }
    );


     $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

    });

    // $('#downloadExcel').click(function(e){
   
    //   e.preventDefault();

    //   console.log('hello');

    //   var exconfig_code = $('#do_excel_cd').val();
    //   console.log('tblname',exconfig_code);

    //   $.ajaxSetup({

    //         headers: {

    //           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    //         }

    //   });

    //   $.ajax({

    //         url:"{{ url('/delivery-order-excel') }}",

    //         method : "POST",

    //         type: "JSON",

    //         data: {exconfig_code:exconfig_code },

    //         success:function(data){

    //           console.log('succ');

    //         }
    //   });

    // })
       
    //$('.moneyformate').mask("#,##0.00", {reverse: true});

    $( window ).on( "load", function() {



        getvrnoBySeries();
        
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
                 // alert(data1.data[0].PFCT_NAME);
                  if(data1.data == ''){
                       var profitctr = '';
                       var pfctget = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctCode').val(pfctget);
                       $('#getPfctName').val(pfctName);
                    }else{
                      $('#profitctrId').val(data1.data[0].PFCT_CODE);
                      $('#pfctName').val(data1.data[0].PFCT_NAME);
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

  function showExcelBtn(){

    var do_excel = $('#do_excel_cd').val();

    if(do_excel){
      $('#downloadExcel').css('display','');
    }else{
      $('#downloadExcel').css('display','none');
    }
  }
  
  function getcityName(srno){

   var consinee_add = $("#consigneeadd"+srno).val();
   var consinee     = $("#consignee"+srno).val();

   if(consinee_add){

   }else{

    $("#to_place"+srno).val('');
   
   }


    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });



    $.ajax({

            url:"{{ url('get-city-name-by-adress') }}",

            method : "POST",

            type: "JSON",

            data: {consinee:consinee,consinee_add:consinee_add},

            success:function(data){

              //console.log(data);

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  if(data1.data==''){

                  }else{

                    $("#to_place"+srno).val(data1.data.CITY_NAME);

                  }

                    

                }

            }

          });



  }

</script>

<script type="text/javascript">
  
   function getRouteLocation(srno) {
    
    var route_code = $("#route_code"+srno).val();

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });


      $.ajax({

            url:"{{ url('get-route-location-by-route-code') }}",

            method : "POST",

            type: "JSON",

            data: {route_code: route_code},

            success:function(data){

              //console.log(data);

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);


                  $("#route_name"+srno).val(data1.data[0].ROUTE_NAME);
                  $("#fromplaceList"+srno).empty();
                   $("#toplaceList"+srno).empty();
                    $("#vehciletypeList"+srno).empty();

                  $.each(data1.data, function(k, getData){

                    

                    $("#fromplaceList"+srno).append($('<option>',{

                      value:getData.FROM_PLACE,

                      'data-xyz':getData.FROM_PLACE,
                      text:getData.FROM_PLACE


                    }));

                   

                    $("#toplaceList"+srno).append($('<option>',{

                      value:getData.TO_PLACE,

                      'data-xyz':getData.TO_PLACE,
                      text:getData.TO_PLACE


                    }));

                    

                  

                  })

                }

            }

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

       var account_code =  $("#account_code").val();

        if(series_code==''){
        
           $('#series_code').css('border-color','#d2d6de');
        
           $('#series_code').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else if(account_code==''){
        
           $('#account_code').css('border-color','#d2d6de');
        
           $('#account_code').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else{
             $('#series_code').css('border-color','#d2d6de');
             $('#account_code').css('border-color','#d2d6de');
           
           // $('#asset_code').css('border-color','#ff0000').focus();
           }


       

        

    });

  });

</script>

<script type="text/javascript">

  $(".delete").on('click', function() {


      var rowCount = $('#tableid table tr').length;
      
      console.log('rowCount',rowCount);
      if(rowCount == 2){
         $('#submitdata').prop('disabled',true);
      }
      $('.case:checkbox:checked').parents("tr").remove();

      $('.check_all').prop("checked", false); 

      quantity =0;
       $(".quantityC").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                quantity += parseFloat(this.value);
            }

          $("#basicTotal").val(quantity.toFixed(2));

        });

       var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });


      check();

  }); /*--function close--*/


  var i=2;

  $(".addmore").on('click',function(){

   
     var  count=$('#tableid table tr').length;

     //alert(count);

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> </td>";

      data +="<td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input type='text' class='inputboxclr' style='width: 100px;' id='dono"+i+"' name='dono[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' /></div></td><td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input type='text' class='inputboxclr  transdatepicker' style='width: 100px;' id='do_date"+i+"' name='do_date[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><div id='odcbtn"+i+"'></div></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input list='ItemList"+i+"' class='inputboxclr' style='width: 100px;' id='ItemCodeId"+i+"' name='itemCode[]' onchange='itemCodeGet("+i+");' oninput='this.value = this.value.toUpperCase()' autocomplete='off'/><datalist id='ItemList"+i+"'><option selected='selected' value=''>-- Select --</option><?php foreach($help_item_list as $key) { ?><option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEMNAME ?>' ><?php echo $key->ITEMNAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option><?php } ?></datalist><input type='text' name='itemlwh[]' id='itemlwh"+i+"' style='width: 101px;' class='inputboxclr rightcontent' autocomplete='off' readonly=''></div><div style='margin-top:2px;'><label>L</label> &nbsp; <input type='text' class='inputboxclr rightcontent' name='length[]' style='width: 50px;' id='length"+i+"' oninput='funCalODC("+i+")' placeholder='LENGTH'> &nbsp;<label>W</label>&nbsp; <input type='text' class='inputboxclr rightcontent' name='width[]' style='width: 50px;' id='width"+i+"' placeholder='WIDTH' oninput='funCalODC("+i+")'> &nbsp;<label>H</label> &nbsp;<input type='text' class='inputboxclr rightcontent' name='height[]' style='width: 50px;' id='height"+i+"' placeholder='HEIGHT' oninput='funCalODC("+i+")'><input type='hidden' name='' id='length_dub"+i+"'><input type='hidden' name='' id='width_dub"+i+"'><input type='hidden' name='' id='height_dub"+i+"'></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><div></div><input type='hidden' name='scrab_code[]' id='scrab_code"+i+"'></td> <td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;' id='Item_Name_id"+i+"' name='itemName[]' readonly /><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"' autocomplete='off'></small><div><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description' autocomplete='off'></textarea></div><div><p id='batchno"+i+"' class='badge' style='background-color:#25b6bd;'></p></div></td><td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='ConsineeList"+i+"' class='inputboxclr' style='width: 139px;' id='consignee"+i+"' onchange='consigneeName("+i+")'' name='consignee[]'   oninput='this.value = this.value.toUpperCase()'  autocomplete='off'/><datalist id='ConsineeList"+i+"'>@foreach ($getacc as $key)<option value='<?php echo $key->ACC_CODE?>'  data-xyz='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo '['.$key->ACC_CODE.']'; ?></option>@endforeach</datalist></div><input type='text' name='consineeName[]' id='consineeName"+i+"'></td> <td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='ConsineeAddList"+i+"' class='inputboxclr' style='width:139px;' id='consigneeadd"+i+"' name='consigneeadd[]' onchange='getcityName("+i+")'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><datalist id='ConsineeAddList"+i+"'></datalist></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input type='text' class='debitcreditbox dr_amount inputboxclr  getqtytotal quantityC moneyformate'  id='qty"+i+"' name='qty[]' oninput='Getqunatity("+i+")'style='width: 70px;' readonly autocomplete='off'/><input type='hidden' id='qtyget"+i+"' class='totlqty'><input type='text' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr  AddM'><input type='hidden' id='Cfactor"+i+"'></div><div><small id='errmsgqty"+i+"'></small></div><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item Name/Item Code</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading'><span id='itemCodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='hsncodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='taxcodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemDetailshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemtypeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemgroupshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemclassshow"+i+"'> </span> </div><div class='box10 itmdetlheading'><span id='itemcategoryshow"+i+"'> </span> </div></div> </div></div> <div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div> </div></div></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='inputboxclr getAccNAme' style='width: 80px;' id='batch_no"+i+"' name='batch_no[]' autocomplete='off' /></td><td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='fromplaceList"+i+"' class='inputboxclr' style='width: 100px;' id='from_place"+i+"' name='from_place[]'  autocomplete='off'  oninput='this.value = this.value.toUpperCase()' onchange='getRouteDetails("+i+")' /><datalist id='fromplaceList"+i+"'><?php foreach($area_list as $key) { ?><option value='<?= $key->CITY_NAME ?>' data-xyz='<?= $key->CITY_CODE ?>'><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option><?php  } ?></datalist></div></td><td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='toplaceList"+i+"' class='inputboxclr' style='width: 100px;' id='to_place"+i+"' name='to_place[]'  autocomplete='off' oninput='this.value = this.value.toUpperCase()'  /><datalist id='toplaceList"+i+"'><?php foreach($area_list as $key) { ?><option value='<?= $key->CITY_NAME ?>' data-xyz='<?= $key->CITY_NAME ?>'><?= $key->CITY_CODE ?> [<?= $key->CITY_CODE ?>]</option><?php  } ?></datalist></div></td>";

      $('#tableid table').append(data);


      var route_code = $("#route_code").val();


    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });

      var Plant_code = $('#Plant_code').val();

      $.ajax({

        url:"{{ url('Get-Pfct-Code-Name-By-Plant') }}",

        method : "POST",

        type: "JSON",

        data: {Plant_code: Plant_code},

        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){
            //console.log('data1.data[0]',data1.data[0]);
            if(data1.data == ''){
                
                $('#from_place'+count).val('');

              }else{
               
                $('#from_place'+count).val(data1.data[0].CITY_NAME);

              }

          }

        }

      });



   

      i++;

      $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });

  });  /*--function close--*/

  /*<td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM'></div></td>*/
 

  function select_all() {

    $('input[class=case]:checkbox').each(function(){ 

      if($('input[class=check_all]:checkbox:checked').length == 0){ 

        $(this).prop("checked", false); 

      }else{

        $(this).prop("checked", true); 

      } 

    });
  }

  function check(){

    obj = $('table tr').find('span');
     // console.log('obj',obj);
    if(obj.length==0){
      $('#basicTotal').val(0.00);
      $('#submitdata').prop('disabled',true);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;

          $('#'+id).html(key+1);

      });
    }
  }


</script>


<script type="text/javascript">

$(".delete").on('click', function() {

    $('.case:checkbox:checked').parents("tr").remove();

    $('.check_all').prop("checked", false); 

    var sum = 0;
//dr amount
      $(".dr_amount").each(function () {

        //add only if the value is number

        if (!isNaN(this.value) && this.value.length != 0) {

            sum += parseFloat(this.value);

        }

      $("#totldramt").val(sum.toFixed(2));

    });

//cr amount

  var sumcr = 0;

    $(".cr_amount").each(function () {

        //add only if the value is number

        if (!isNaN(this.value) && this.value.length != 0) {

            sumcr += parseFloat(this.value);

        }

      $("#totlcramt").val(sumcr.toFixed(2));

    });

    check();

});

var i=2;

$(".addmoreacc").on('click',function(){

      var getpaymode = 'To -';

    count=$('#acctableid table tr').length;

    var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case' name='countcheckbox[]' id='countcheckbox"+count+"'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='slno[]' id='slno"+i+"' value='"+count+"'></td>";

    data +="<td class=tdthtablebordr><div class=input-group><textarea  name='address[]' id='address"+i+"' cols=20 rows=2 placeholder='Address' style='width: 170px;margin-bottom: 5px;'></textarea><div class='row'><div class='col-md-6'><input type='text' class=inputboxclr  getAccNAme form-group  style='width:120px;margin-bottom: 5px'; id='contact_person"+i+"' name=contact_person[] placeholder='contact person' /><input type='text' class=textdesciptn discription forperticulr form-group Number   name='pincode[]' maxlength='8' id='pincode"+i+"' placeholder='Pincode' style='margin-bottom: 5px;width: 120px;'></div><div class=col-md-6><input type='text' class='textdesciptn discription forperticulr form-group'  name='city[]' id=discription placeholder='City' id='city"+i+"' style='margin-bottom: 5px;width: 120px;'><input type='text' class=textdesciptn discription forperticulr  name='district[]'  id='district"+i+"' placeholder='District' style='margin-bottom: 5px;width: 120px;'></div></div><div class='row'><div class=col-md-6><input list='stateList' class='textdesciptn discription forperticulr' onchange='stateName("+i+")'  name='state[]' id='state"+i+"' placeholder='State' style='margin-bottom: 5px;width: 120px;'><datalist id='stateList'><option value='></option><?php foreach ($state_lists as $key) { ?><option value='<?php echo $key->STATE_CODE ?>' data-xyz='{{ $key->STATE_NAME }}'><?php echo $key->STATE_CODE?> = <?php echo $key->STATE_NAME?></option><?php  } ?></datalist><input type='hidden' name='state_name[]' id='state_name"+i+"' ><input type='text' class='textdesciptn discription forperticulr Number' name='phone[]' id='phone"+i+"' maxlength='10' placeholder='Phone No' style='margin-bottom: 5px;width: 120px;'></div><div class=col-md-6><input type='text' class='textdesciptn discription forperticulr'  name='email[]' id='email"+i+"' placeholder='Email' style='margin-bottom: 5px;width: 120px;'><input type='text' class=textdesciptn discription forperticulr  name='fax[]' id='fax"+i+"' placeholder='Fax' style='margin-bottom: 5px;width: 120px;'></div></div></div></td><td class='tdthtablebordr'><div class='row'><div class='col-md-4'><select type='text' class='inputboxclr getAccNAme' style='width: 120px;margin-bottom: 5px;height:25px;' id='gst_type"+i+"' name='gst_type[]' onclick='GstType("+i+")' ><option value=''>--GST TYPE--</option><option value='Register'>Register</option><option value='UnRegister'>UnRegister</option><option value='Not-Applicable'>Not-Applicable</option></select></div><div class='col-md-4'><input type='text' class='textdesciptn discription forperticulr'  name='gst_num[]' id='gst_num"+i+"' style='width: 120px;margin-bottom: 5px;' placeholder='GST No' oninput='gstNum("+i+")'></div><div class=col-md-4><input type='text' class='inputboxclr getAccNAme' style='width: 110px;margin-bottom: 5px;' id='ecc_no"+i+"' name='ecc_no[]' style='width: 120px;margin-bottom: 5px;' placeholder='ECC NO'></div></div><div class='row'><div class='col-md-12'><textarea type=text class='textdesciptn discription forperticulr'  name='range_address[]' id='range_address"+i+"' style='width: 356px;margin-bottom: 5px;' placeholder='Range Address'></textarea></div></div><div class=row><div class='col-md-6'><input type='text' class='textdesciptn discription forperticulr'  name='range_no[]' id='range_no"+i+"' style='width: 120px;margin-bottom: 5px;' placeholder='Range No'></div><div class='col-md-6'><input type='text' class='inputboxclr getAccNAme' style='width: 120px;margin-bottom: 5px;' id='range_name"+i+"' name='range_name[]' placeholder='Range Name' /></div></div><div class=row><div class='col-md-6'><input type='text' class='textdesciptn discription forperticulr'  name='division[]' id='division"+i+"' style='width: 120px;margin-bottom: 5px;' placeholder='Division'></div><div class='col-md-6'><input type='text' class='inputboxclr getAccNAme' style='width: 120px;margin-bottom: 5px;' id='collector"+i+"' name='collector[]' style='width: 120px;margin-bottom: 5px;' placeholder='Collector' /></div></div></td></tr></tr>";

    $('#acctableid table').append(data);

    i++;



});








</script>

<script type="text/javascript">
  

  function funCalODC(srno){

    var lengthVal = parseFloat($('#length'+srno).val());
    
    var widthtVal = parseFloat($('#width'+srno).val());
    
    var heightVal = parseFloat($('#height'+srno).val());


    var lengthVal_dub = parseFloat($('#length_dub'+srno).val());
    
    var widthtVal_dub = parseFloat($('#width_dub'+srno).val());
    
    var heightVal_dub = parseFloat($('#height_dub'+srno).val());


    console.log(lengthVal_dub);


     $("#odcbtn"+srno).empty();
    
    if(lengthVal > lengthVal_dub && widthtVal > widthtVal_dub && heightVal > heightVal_dub){

      var odcwbtn ="<button type='button' id='odcsucessbtn' class='btn btn-success btn-sm' style='padding: 0px 0px !important;font-size: 11px !important;line-height: 1 !important;'><i class='fa fa-check'></i> &nbsp; TWO SIDE ODC</button><input type='hidden' class='form-control' name='odc[]' id='odc"+srno+"' value='TWO SIDE ODC' readonly>";

      $("#odcbtn"+srno).append(odcwbtn);

     // $('#odc'+srno).val('YES');

    }else if(lengthVal <= lengthVal_dub && widthtVal <= widthtVal_dub && heightVal <= heightVal_dub){

      var odcbtn = "<button type='button' id='odccancelbtn' class='btn btn-danger btn-sm' style='padding: 0px 0px !important;font-size: 11px !important;line-height: 1 !important;'><i class='fa fa-close'></i> &nbsp;NO ODC</button><input type='hidden' class='form-control' name='odc[]' id='odc"+srno+"' value='NO' readonly>";

       $("#odcbtn"+srno).append(odcbtn);

      // $('#odc'+srno).val('NO');

    }else if(widthtVal > widthtVal_dub && heightVal > heightVal_dub || lengthVal > lengthVal_dub && widthtVal > widthtVal_dub || lengthVal > lengthVal_dub && heightVal > heightVal_dub){

       var odcwbtn ="<button type='button' id='odcsucessbtn' class='btn btn-success btn-sm' style='padding: 0px 0px !important;font-size: 11px !important;line-height: 1 !important;'><i class='fa fa-check'></i> &nbsp;TWO SIDE ODC</button><input type='hidden' class='form-control' name='odc[]' id='odc"+srno+"' value='TWO SIDE ODC' readonly>";

         $("#odcbtn"+srno).append(odcwbtn);

    }else if(lengthVal > lengthVal_dub || widthtVal > widthtVal_dub || heightVal > heightVal_dub){

      var odcwbtn ="<button type='button' id='odcsucessbtn' class='btn btn-success btn-sm' style='padding: 0px 0px !important;font-size: 11px !important;line-height: 1 !important;'><i class='fa fa-check'></i> &nbsp;ONE SIDE ODC</button><input type='hidden' class='form-control' name='odc[]' id='odc"+srno+"' value='ONE SIDE ODC' readonly>";

      $("#odcbtn"+srno).append(odcwbtn);
   //   $('#odc'+srno).val('YES');

    }else if(lengthVal == '' && widthtVal == '' && heightVal == ''){

      /* var odcbtn = '<button type="button" id="odccancelbtn" class="btn btn-danger btn-sm" style="line-height: 1;font-size: 10px;margin-top:1px;margin-left: 20px;"><i class="fa fa-close"></i> &nbsp;ODC</button>';*/

        $("#odcbtn"+srno).empty();
        $("#odcbtn"+srno).html('');
       // $('#odc'+srno).val('');
    }else{
      $("#odcbtn"+srno).empty();
    }

  }

</script>

<script type="text/javascript">
   $("#ref_comp_code").bind('change', function () { 
          
          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg =='No Match'){
            $('#ref_comp_code').val('');
            $('#ref_comp_name').val('');
             
          }else{
            $('#ref_comp_name').val(msg);
            $('#getRefCompCode').val(val);
            $('#getRefCompName').val(msg);
          }

  });

   function GstType(num){
  
  var gst_type = $("#gst_type"+num).val();

  if(gst_type=='Register'){

    $("#thirdStep").prop('disabled',true);
     $('#gst_num'+num).css('border-color','red');
  }else{

    $("#thirdStep").prop('disabled',false);

   $('#gst_num'+num).val('');
    $('#gst_num'+num).css('border-color','black');
  }
}

$("#do_excel_code").on('change', function () { 

      var excel_code = $(this).val();

      if(excel_code=='DOEXCD'){

        $("#rakeFeild").css('display','block');

      }else{
        $("#rakeFeild").css('display','none');
      }

      

       var xyz = $('#doExcelList option').filter(function() {

          return this.value == excel_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg =='No Match'){
            $('#do_excel_name').val('');
            $('#ref_comp_code').val('');
            $('#ref_comp_name').val('');
             $("#bodyId").css('display','block');
             
          }else{
            $('#do_excel_name').val(msg);
            $("#bodyId").css('display','none');
          }

    /*  if(excel_code){

        $("#bodyId").css('display','none');
      }else{

         $("#bodyId").css('display','block');
      }
*/
  

});

$("#do_excel_cd").on('change', function () { 

      var excel_code = $(this).val();

       var xyz = $('#doExcelListEx option').filter(function() {

          return this.value == excel_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg =='No Match'){
             $('#downloadExcel').css('display','none');
             $('#do_excel_cd').val('');
            
             
          }else{

             $('#downloadExcel').css('display','');
             // $('#do_excel_cd').val(msg);
          }
});


$("#placement_date").on('change', function () { 


      var rakeNo = $('#rake_no').val();
      var rakeDate= $('#rake_date').val();
      var placeDate= $(this).val();
      

      $('#rakeNo').val(rakeNo);
      $('#rakeDate').val(rakeDate);
      $('#placeDate').val(placeDate);

      
});

</script>

<script type="text/javascript">
  
   function submitexData(){


      
    var data = $("#salesordertrans,#bodyformexId").serialize();


          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/finance/save-delivery-order-exceeding'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                 console.log(data);

                 var data1 = JSON.parse(data);

                
              if(data1.response=='error'){
                  var responseVar =false;

                    var url = "{{ url('/Transaction/view-delivery-order-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar =true;
                  var url = "{{ url('/Transaction/view-delivery-order-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }

           
              },

          });
      
  }
</script>

<script type="text/javascript">

 function submitData(){


     var trcount   = $('table tr').length;
    
    var data = $("#salesordertrans,#bodyformId").serialize();


          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/finance/save-delivery-order'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                 var data1 = JSON.parse(data);
                 console.log(data1);

                
               if(data1.response=='error'){
                  var responseVar =false;

                    var url = "{{ url('/Transaction/view-delivery-order-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar =true;
                  var url = "{{ url('/Transaction/view-delivery-order-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }

           
              },

          });
      
  }


   function submitItemData(){

      var item_code      = $('#ItemCodeSearch').val();
      var ItemName       = $('#ItemName').val();
      var hsn_code       = $('#hsn_code').val();
      var valuation_code = $('#valuation_code').val();
      var item_detail    = $('#item_detail').val();
      var itemtype       = $('#itemtype').val();
      var item_class     = $('#item_class').val();
      var item_cate      = $('#item_cate').val();
      var selectUm       = $('#selectUm').val();
      var selectUam      = $('#selectUam').val();
      var aum_factor     = $('#aum_factor').val();
      var qtydecimal     = $('#qtydecimal').val();
      var tolranceindex  = $('#tolranceindex').val();
      var tolrance_rate  = $('#tolrance_rate').val();
      var scrap_code     = $('#scrap_code').val();
      var batch_check    = $('#batch_check').val();
      var length         = $('#length').val();
      var width          = $('#width').val();
      var height         = $('#height').val();


      var tempdataCount = $("#tempdataCount").val();


      if(item_code==''){
       $("#errorItem").html('This Item Code Field Is Required').css('color','red');

        return false;

      }else{
        $("#errorItem").html('');
      }
      if(ItemName==''){
        $("#itemNameErr").html('This Item Name Field Is Required').css('color','red');
        return false;
      }else{
        $("#itemNameErr").html('');
      }
      if(hsn_code==''){
        $("#hsn_code_err").html('This Hsn Code Field Is Required').css('color','red');
        return false;
      }else{
        $("#hsn_code_err").html('');
      }
      if(valuation_code==''){
        $("#valuation_code_err").html('This Valuation Code Field Is Required').css('color','red');
        return false;
      }else{
        $("#valuation_code_err").html('');
      }if(item_detail==''){
        $("#item_detail_err").html('This Item Details Field Is Required').css('color','red');
        return false;
      }else{
        $("#item_detail_err").html('');
      }
      if(itemtype==''){
        $("#item_type_err").html('This Item Type Field Is Required').css('color','red');
        return false;
      }else{
        $("#item_type_err").html('');
      }
      if(item_class==''){
       $("#item_class_err").html('This Item Class Field Is Required').css('color','red');
       return false;
      }else{
        $("#item_class_err").html('');
       
      }
      if(item_cate==''){
         $("#item_catg_err").html('This Item Category Field Is Required').css('color','red');
         return false;
      }else{
        $("#item_catg_err").html('');
        
      }
      if(selectUm==''){
         $("#um_err").html('This Um Field Is Required').css('color','red');
         return false;
      }else{
        $("#um_err").html('');
      }
      if(selectUam==''){
         $("#aum_err").html('This Aum Field Is Required').css('color','red');
         return false;
      }else{
        $("#aum_err").html('');
      }
      if(aum_factor==''){
         $("#aumfactor_err").html('This Aum Factor Field Is Required').css('color','red');
         return false;
      }else{
        $("#aumfactor_err").html('');
      }
      if(qtydecimal==''){
         $("#qty_dec_err").html('This Qty Decimal Field Is Required').css('color','red');
         return false;
      }else{
        $("#qty_dec_err").html('');
      }
    


          var data = $("#itemformid").serialize();


          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/Master/Item/form-item-master-finance-save'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                 var data1 = JSON.parse(data);
                 console.log(data);

                 if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                    }else if(data1.response == 'success'){



                       var dataCount =  tempdataCount - 1;

                        if(dataCount > 0){

                          $("#submitexceldata").prop('disabled',true);

                        }else{

                          $("#submitexceldata").prop('disabled',false);

                        }

                       
                       $('#newItemModal').modal('hide');
                       $('#example').DataTable().ajax.reload();
                       $("#itemformid").trigger("reset");

                    }

              },

          });
      
  }
    

    function submitAccData(){

      var tempdataCount = $("#tempdataCount").val();

          var data = $("#accformid").serialize();


          console.log(data);


          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/Master/Customer-Vendor/Account-Save'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                 var data1 = JSON.parse(data);
                 console.log(data);

                 if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                    }else if(data1.response == 'success'){



                       var dataCount =  tempdataCount - 1;

                        if(dataCount > 0){

                          $("#submitexceldata").prop('disabled',true);

                        }else{

                          $("#submitexceldata").prop('disabled',false);

                        }
                       
                       $('#newAccModal').modal('hide');
                       $('#example').DataTable().ajax.reload();
                       $("#accformid").trigger("reset");

                    }

              },

          });
      
  } 
</script>


<script type="text/javascript">
  
   $(document).ready( function () {

       $("form#data-form").on("submit",function (e) {
           e.preventDefault();

           var formData = new FormData(this);
           //Ajax functionality here

             var files = $('#customFile')[0].files;
             var excel = $('#customFile').val();

             
          
             if(excel==''){
              
              $('#excelerr').html('This field is required');

              return false;
             }else{
              $('#excelerr').html('');
              $('#filename').val(excel);
            }

             var tempvrno = $('#tempvrno').val();
             var temptransporter = $('#temptransporter').val();
             var do_excel_code = $('#tempdoexcelcode').val();

         // console.log(files);

           if(files.length > 0){


             var fd = new FormData();


             fd.append('file',files[0]);
             fd.append('tempvrno',tempvrno);
             fd.append('temptransporter',temptransporter);
             fd.append('do_excel_code',do_excel_code);

             //alert(fd);return false;

                  $.ajaxSetup({

                      headers: {

                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                      }
                });

                $("#vr_date,#series_code,#Plant_code,#account_code,#freight_order_no,#customFile,#importbtn").prop('readonly', true);

                  $("#importExcel").val('IMPORTEXCEL');

                 $("#importExcel1").val('IMPORTEXCEL');


               $.ajax({

                url: "<?php echo url('/finance/doimport'); ?>",
                type : "POST",
                data : fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                  beforeSend: function() {
                  console.log('start spinner');
                      $('.modalspinner').removeClass('hideloaderOnModl');
                },
                success:function (data) {


                 var rakeNo =  $("#rake_no").val();
                 var rakeDate =  $("#rake_date").val();
                 var placeDate =  $("#placement_date").val();

                  $('#rakeNo').val(rakeNo);
                  $('#rakeDate').val(rakeDate);
                  $('#placeDate').val(placeDate);


                  var new_data_count = data.new_data_count;

                  var itemacc_count = data.itemacc_count;

                  var allocqty_count = data.allocqty_count;


                 console.log('newdata',new_data_count);
                 console.log('itemdata',itemacc_count);
                 console.log('qtydata',allocqty_count);

                  $("#indicate_msg").css('display','block');


                  if(itemacc_count > 0 || allocqty_count > 0){

                    $("#submitexceldata").prop('disabled',true);
                    $("#submitexcelEXdata").prop('disabled',true);

                  }else if(new_data_count > 0 && allocqty_count == 0){

                    $("#submitexceldata").prop('disabled',false);
                    $("#submitexcelEXdata").prop('disabled',false);
                    
                  }else if(new_data_count > 0){

                    $("#submitexceldata").prop('disabled',false);
                    $("#submitexcelEXdata").prop('disabled',false);


                  }else{

                    $("#submitexceldata").prop('disabled',true);
                    $("#submitexcelEXdata").prop('disabled',true);
                  }

                  /*if(datadocount == 0){

                    $("#submitexceldata").prop('disabled',true);

                  }else{
                       $("#submitexceldata").prop('disabled',false);
                  }
*/
                  
                    
                   
                   if(do_excel_code=='DOYARD'){

                    $("#tempdataCount").val(new_data_count);
                 

                    $("#datatableId").css("display","block");
                    $("#bodyId").css("display","none");

                    var t = $("#example").DataTable({

                         processing: true,
                         serverSide:true,
                         //scrollY:500,
                         //scrollX:true,
                         paging: true,
                         pageLength:100,
                         searching : true,
                         //stateSave: true,

                          ajax:{

                            url : "{{ url('/Transaction/Logistic/View-Delivery-Order-Details') }}",
                            
                           },
    

                     columns: [
                        
                        { data:"DT_RowIndex",className:"text-center"},

                         {  
                          render: function (data, type, full, meta){

                                  if(full['ACC_STATUS']=='YES' && full['ITEM_STATUS']=='YES' && full['DO_EXIST_STATUS']=='NO'){

                                        var accType = 'YARD';
                                        var accCode = "";
                                       var accDbtn ='<button type="button" class="btn btn-primary btn-sm" title="edit" style="font-size: 10px; padding: 2px 2px;" onclick="return showItem('+full['ID']+',\''+full['COL3']+'\',\''+full['COL4']+'\',\''+accType+'\');" data-tip="ACC CODE"><i class="fa fa-list-alt" aria-hidden="true" title="ITEM CODE"></i></button> | <button type="button" class="btn btn-warning btn-sm" style="font-size: 10px; padding: 2px 2px;" data-toggle="modal" onclick="return showAcc('+full['ID']+',\''+accCode+'\',\''+full['COL7']+'\',\''+accType+'\');" data-tip="ACC CODE"><i class="fa fa-user-circle" aria-hidden="true" ></i></button></button>';

                                         return accDbtn;

                                         var cnt =  $("#example tr").length;

                                         console.log('count',cnt);

                                    }else if(full['ACC_STATUS']=='YES'  && full['ITEM_STATUS']=='NO' && full['DO_EXIST_STATUS']=='NO'){

                                      var accType = 'YARD';
                                      var accCode = "";
                                      var accDbtn ='<button type="button" class="btn btn-warning btn-sm" style="font-size: 10px; padding: 2px 2px;" data-toggle="modal" onclick="return showAcc('+full['ID']+',\''+accCode+'\',\''+full['COL7']+'\',\''+accType+'\');" data-tip="ACC CODE"><i class="fa fa-user-circle" aria-hidden="true" title="ACC CODE"></i></button>';

                                         return accDbtn;

                                         var cnt =  $("#example tr").length;

                                         console.log('count',cnt);

                                    }else if(full['ITEM_STATUS']=='YES' && full['ACC_STATUS']=='NO' && full['DO_EXIST_STATUS']=='NO'){

                                      var accType = 'YARD';

                                      var accDbtn ='<button type="button" class="btn btn-primary btn-sm" title="edit" style="font-size: 10px; padding: 2px 2px;" onclick="return showItem('+full['ID']+',\''+full['COL3']+'\',\''+full['COL4']+'\',\''+accType+'\');" data-tip="ITEM CODE"><i class="fa fa-list-alt" aria-hidden="true" title="ITEM CODE"></i></button>';

                                         return accDbtn;

                                         var cnt =  $("#example tr").length;

                                         console.log('count',cnt);

                                    }else{

                                      return '<button type="button" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></button>';
                                    }

                              },
        
                         },

                         {  
                          render: function (data, type, full, meta){

                                  if(full['DO_EXIST_STATUS']=='NO' && full['DO_UPDATE_STATUS']=='0'){

                                       return '<button type="button" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></button>';

                                    }else if(full['DO_EXIST_STATUS']=='EXIST' && full['DO_UPDATE_STATUS']=='1'){

                                      return '<button type="button" class="btn btn-danger btn-sm">DO EXIST</button>';

                                      
                                    }else if(full['DO_EXIST_STATUS']=='YES' && full['DO_UPDATE_STATUS']=='1'){

                                      var accType = 'YARD';

                                      var accDbtn ='<button type="button" class="btn btn-primary btn-sm" style="font-size: 10px; padding: 2px 2px;" data-toggle="modal" onclick="return showAllcQty('+full['ID']+','+full['COL5']+','+full['COL1']+','+full['COL2']+',\''+accType+'\');">&nbsp;&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Allc Qty&nbsp;&nbsp;</button>';

                                         return accDbtn;
                                        
                                    }else{
                                       return '<button type="button" class="btn btn-danger btn-sm">DO EXIST</button>';
                                    }

                              },
        
                         },
                         { data:"NOT_FOUND_STATUS",className:"hidebegore",

                          render: function (data, type, full, meta){

                                  var not_found = '<input type="hidden" value="'+full['NOT_FOUND_STATUS']+'" name="NOT_FOUND_STATUS[]"/>';

                                  return  not_found;
                           }
                        }, 
                        { 
                          data:"COL1",className:"text-center",
                           render: function (data, type, full, meta){

                                  var col1 = full['COL1']+'<input type="hidden" value="'+full['COL1']+'" name="column1[]"/>';

                                  return  col1;
                           }
                        },
                        { data:"COL2",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col2 = full['COL2']+'<input type="hidden" value="'+full['COL2']+'" name="column2[]"/>';

                                  return  col2;
                           }

                         },
                        { data:"COL3",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col3 = full['COL3']+'<input type="hidden" value="'+full['COL3']+'" name="column3[]"/>';

                                  return  col3;
                           }
                        },
                        { data:"COL4",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col4 = full['COL4']+'<input type="hidden" value="'+full['COL4']+'" name="column4[]"/>';

                                  return  col4;
                           }

                        },
                        { data:"COL5",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col5 = full['COL5']+'<input type="hidden" value="'+full['COL5']+'" name="column5[]"/>';

                                  return  col5;
                           }
                        },
                        { data:"COL6",className:"text-center",

                           render: function (data, type, full, meta){

                                  var col6 = full['COL6']+'<input type="hidden" value="'+full['COL6']+'" name="column6[]"/>';

                                  return  col6;
                           }
                        },
                        { data:"COL7",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col7 = full['COL7']+'<input type="hidden" value="'+full['COL7']+'" name="column7[]"/>';

                                  return  col7;
                           }
                        },
                        { data:"COL8",className:"text-center",

                           render: function (data, type, full, meta){

                                  var col8 = full['COL8']+'<input type="hidden" value="'+full['COL8']+'" name="column8[]"/>';

                                  return  col8;
                           }
                        },
                        { data:"COL9",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col9 = full['COL9']+'<input type="hidden" value="'+full['COL9']+'" name="column9[]"/>';

                                  return  col9;
                           }
                        },
                          
                       
                      
                    ],

                   "fnRowCallback": function(nRow, aData,data, type, full, meta) {

                      
                        if((aData['ITEM_STATUS']=='YES' && aData['DO_EXIST_STATUS']=='NO') || (aData['ACC_STATUS']=='YES' && aData['DO_EXIST_STATUS']=='NO')) {
                          $('td', nRow).css('color', '#f75656');
                          
                          $(nRow).attr('class','misMatch');



                        
                        }



                      },



                       });

                  }else{

                    $("#tempdataCount1").val(new_data_count);
                    $("#doexccedingId").css("display","block");
                    $("#bodyId").css("display","none");

                       var t = $("#doexceedingexample").DataTable({

                        // processing: true,
                         serverSide:true,
                         //scrollY:500,
                         //scrollX:true,
                         paging: true,
                         pageLength:100,
                         searching : true,
                         stateSave: true,
                    
                          ajax:{

                            url : "{{ url('/Transaction/Logistic/View-Delivery-Order-Details') }}",
                            
                           },
    

                     columns: [
                        
                        { data:"DT_RowIndex",className:"text-center"},

                         {  
                          render: function (data, type, full, meta){

                                  if(full['ACC_STATUS']=='YES' && full['ITEM_STATUS']=='YES' && full['DO_EXIST_STATUS']=='NO'){

                                       var accType = 'EXCD';

                                       var accDbtn ='<button type="button" class="btn btn-primary btn-sm" title="edit" style="font-size: 10px; padding: 2px 2px;" onclick="return showItem('+full['ID']+',\''+full['COL9']+'\',\''+full['COL11']+'\',\''+accType+'\');" data-tip="ACC CODE"><i class="fa fa-list-alt" aria-hidden="true" title="ITEM CODE"></i></button> | <button type="button" class="btn btn-warning btn-sm" style="font-size: 10px; padding: 2px 2px;" data-toggle="modal" onclick="return showAcc('+full['ID']+','+full['COL1']+',\''+full['COL2']+'\',\''+accType+'\');" data-tip="ACC CODE"><i class="fa fa-user-circle" aria-hidden="true" ></i></button></button>';

                                         return accDbtn;

                                         var cnt =  $("#example tr").length;

                                         console.log('count',cnt);

                                    }else if(full['ACC_STATUS']=='YES'  && full['ITEM_STATUS']=='NO' && full['DO_EXIST_STATUS']=='NO'){

                                      
                                      var accType = 'EXCD';
                                
                                      var accDbtn ='<button type="button" class="btn btn-warning btn-sm" style="font-size: 10px; padding: 2px 2px;" data-toggle="modal" onclick="return showAcc('+full['ID']+','+full['COL1']+',\''+full['COL2']+'\',\''+accType+'\');" data-tip="ACC CODE"><i class="fa fa-user-circle" aria-hidden="true" title="ACC CODE"></i></button>';

                                         return accDbtn;
                                        



                                    }else if(full['ITEM_STATUS']=='YES' && full['ACC_STATUS']=='NO' && full['DO_EXIST_STATUS']=='NO'){

                                      var accType = 'EXCD';

                                      var accDbtn ='<button type="button" class="btn btn-primary btn-sm" title="edit" style="font-size: 10px; padding: 2px 2px;" onclick="return showItem('+full['ID']+',\''+full['COL9']+'\',\''+full['COL11']+'\',\''+accType+'\');" data-tip="ITEM CODE"><i class="fa fa-list-alt" aria-hidden="true" title="ITEM CODE"></i></button>';

                                         return accDbtn;

                                         var cnt =  $("#example tr").length;

                                         console.log('count',cnt);

                                    }else{

                                      return '<button type="button" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></button>';
                                    }

                              },
        
                         },
                        
                        /* {  
                          render: function (data, type, full, meta){

                                  if(full['DO_EXIST_STATUS']=='YES' && full['DO_UPDATE_STATUS']=='0' ){

                                       var accDbtn ='<button type="button" class="btn btn-primary btn-sm" style="font-size: 10px; padding: 2px 2px;" data-toggle="modal" onclick="return showAllcQty('+full['ID']+','+full['COL5']+','+full['COL1']+');">&nbsp;&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Allc Qty&nbsp;&nbsp;</button>';

                                         return accDbtn;

                                         var cnt =  $("#example tr").length;

                                         console.log('count',cnt);

                                    }else{

                                      return '<button type="button" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></button>';
                                    }

                              },

        
                         },*/

                          {  
                          render: function (data, type, full, meta){

                                  if(full['DO_EXIST_STATUS']=='NO' && full['DO_UPDATE_STATUS']=='0'){

                                       return '<button type="button" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></button>';

                                    }else if(full['DO_EXIST_STATUS']=='EXIST' && full['DO_UPDATE_STATUS']=='1'){

                                      return '<button type="button" class="btn btn-danger btn-sm">DO EXIST</button>';

                                      
                                    }else if(full['DO_EXIST_STATUS']=='YES' && full['DO_UPDATE_STATUS']=='1'){

                                      var accType ='EXCD';

                                      var accDbtn ='<button type="button" class="btn btn-primary btn-sm" style="font-size: 10px; padding: 2px 2px;" data-toggle="modal" onclick="return showAllcQty('+full['ID']+','+full['COL14']+','+full['COL4']+','+full['COL17']+',\''+accType+'\');">&nbsp;&nbsp;<i class="fa fa-pencil" aria-hidden="true"></i>&nbsp;&nbsp;Allc Qty&nbsp;&nbsp;</button>';

                                         return accDbtn;
                                        
                                    }else{
                                      return '<button type="button" class="btn btn-danger btn-sm">DO EXIST</button>';
                                    }

                              },
        
                         },
                         { data:"NOT_FOUND_STATUS",className:"hidebegore",

                          render: function (data, type, full, meta){

                                  var not_found = '<input type="hidden" value="'+full['NOT_FOUND_STATUS']+'" name="NOT_FOUND_STATUS[]"/>';

                                  return  not_found;
                           }
                        }, 
                        { 
                          data:"COL1",className:"text-center",
                           render: function (data, type, full, meta){

                                  var col1 = full['COL1']+'<input type="hidden" value="'+full['COL1']+'" name="column1[]"/>';

                                  return  col1;
                           }
                        },
                        { data:"COL2",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col2 = full['COL2']+'<input type="hidden" value="'+full['COL2']+'" name="column2[]"/>';

                                  return  col2;
                           }

                         },
                        { data:"COL3",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col3 = full['COL3']+'<input type="hidden" value="'+full['COL3']+'" name="column3[]"/>';

                                  return  col3;
                           }
                        },
                        { data:"COL4",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col4 = full['COL4']+'<input type="hidden" value="'+full['COL4']+'" name="column4[]"/>';

                                  return  col4;
                           }

                        },
                        { data:"COL5",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col5 = full['COL5']+'<input type="hidden" value="'+full['COL5']+'" name="column5[]"/>';

                                  return  col5;
                           }
                        },
                        { data:"COL6",className:"text-center",

                           render: function (data, type, full, meta){

                                  var col6 = full['COL6']+'<input type="hidden" value="'+full['COL6']+'" name="column6[]"/>';

                                  return  col6;
                           }
                        },
                        { data:"COL7",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col7 = full['COL7']+'<input type="hidden" value="'+full['COL7']+'" name="column7[]"/>';

                                  return  col7;
                           }
                        },
                        { data:"COL8",className:"text-center",

                           render: function (data, type, full, meta){

                                  var col8 = full['COL8']+'<input type="hidden" value="'+full['COL8']+'" name="column8[]"/>';

                                  return  col8;
                           }
                        },
                        { data:"COL9",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col9 = full['COL9']+'<input type="hidden" value="'+full['COL9']+'" name="column9[]"/>';

                                  return  col9;
                           }
                        },
                        { data:"COL10",className:"text-center",

                          render: function (data, type, full, meta){

                                  var COL10 = full['COL10']+'<input type="hidden" value="'+full['COL10']+'" name="column10[]"/>';

                                  return  COL10;
                           }
                        },
                        { data:"COL11",className:"text-center",

                          render: function (data, type, full, meta){

                                  var COL11 = full['COL11']+'<input type="hidden" value="'+full['COL11']+'" name="column11[]"/>';

                                  return  COL11;
                           }
                        },
                        { data:"COL12",className:"text-center",

                          render: function (data, type, full, meta){

                                  var COL12 = full['COL12']+'<input type="hidden" value="'+full['COL12']+'" name="column12[]"/>';

                                  return  COL12;
                           }
                        },
                        { data:"COL13",className:"text-center",

                          render: function (data, type, full, meta){

                                  var COL13 = full['COL13']+'<input type="hidden" value="'+full['COL13']+'" name="column13[]"/>';

                                  return  COL13;
                           }
                        },
                        { data:"COL14",className:"text-center",

                          render: function (data, type, full, meta){

                                  var COL14 = full['COL14']+'<input type="hidden" value="'+full['COL14']+'" name="column14[]"/>';

                                  return  COL14;
                           }
                        },
                         { data:"COL15",className:"text-center",

                          render: function (data, type, full, meta){

                                  var COL15 = full['COL15']+'<input type="hidden" value="'+full['COL15']+'" name="column15[]"/>';

                                  return  COL15;
                           }
                        },
                         { data:"COL16",className:"text-center",

                          render: function (data, type, full, meta){

                                  var COL16 = full['COL16']+'<input type="hidden" value="'+full['COL16']+'" name="column16[]"/>';

                                  return  COL16;
                           }
                        },
                         { data:"COL17",className:"text-center",

                          render: function (data, type, full, meta){

                                  var COL17 = full['COL17']+'<input type="hidden" value="'+full['COL17']+'" name="column17[]"/>';

                                  return  COL17;
                           }
                        },

                        { data:"COL18",className:"text-center",

                          render: function (data, type, full, meta){

                                  var COL18 = full['COL18']+'<input type="hidden" value="'+full['COL18']+'" name="column18[]"/>';

                                  return  COL18;
                           }
                        },
                       
                      
                    ],

                     "fnRowCallback": function(nRow, aData,data, type, full, meta) {

                      
                        if((aData['ITEM_STATUS']=='YES' && aData['DO_EXIST_STATUS']=='NO') || (aData['ACC_STATUS']=='YES' && aData['DO_EXIST_STATUS']=='NO')) {
                          $('td', nRow).css('color', '#f75656');
                          
                          $(nRow).attr('class','misMatch');


                        }



                      },


                       });

                  }

                  },

                   complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },

                    
            }); // ajax end

         }
    }); // form submit end
});



</script>




<script type="text/javascript">
  
  function showAccExcd1(id,acc_Name){

     var excelcount =  $("#ececelExcCount").val();

    console.log('excel1',excelcount);

    var tblcol =[]; 

    for(var i = 1; i <= excelcount; i++) {

       var table_col = $("#excelcol_exceeding"+i).attr('dataex-id');

       console.log(table_col);

      if(table_col == 'CP_CODE'){

        var excelcol =  $("#excelcol_exceeding"+i).val();

        tblcol.push(excelcol);

      }

     
    }



console.log(tblcol);
console.log(acc_Name);
console.log(id);
    //alert(tblcol);return false;

    $("#tblcol").val(tblcol[0]);
    $("#temptableid").val(id);
    $("#tblcolacc").val(tblcol[0]);
    $("#temptableidacc").val(id);
    $("#accAliseName").val(acc_Name);
    $("#excdModal").modal('show');

    /*$('#AccTable').DataTable().destroy();


     var t = $("#AccTable").DataTable({

            oLanguage: {
              sProcessing: $('.modalspinner').removeClass('hideloaderOnModl')
          },
       processing: true,

       serverSide:false,

       //scrollY:500,

       scrollX:true,


       ajax:{


        url : "{{ url('/Master/Customer-Vendor/View-Account-Consinee') }}"


       },

       searching : true,

    

       columns: [

         
         { 
              data:"DT_RowIndex",
              name:"DT_RowIndex",
              className:"text-center",
              'render': function (data, type, full, meta){
                         return '<input type="radio" name="accCodeValue" class="accCodeValue'+full['DT_RowIndex']+'" value="'+full['ACC_CODE']+'-'+full['ACC_NAME']+'">';

                     
                     }
        },

         { data: "ACC_CODE",className:"textLeft",
          },

         { data: "ACC_NAME",className:"textLeft",

        },
        { data: "ALIAS_CODE",className:"textLeft",
        },
         { data: "ALIAS_NAME",className:"textLeft",
        },

         { data: "CITY_NAME",className:"textLeft",

        },


      ],

      

     });*/

  }


</script>


<script type="text/javascript">
  
  function showAcc(id,accCode,acc_Name,accType){

     var excelcount =  $("#ececelCount").val();
     var excelExcount =  $("#ececelExcCount").val();

    var tblcol =[]; 

  if(accType=='YARD'){

    for(var i = 1; i <= excelcount; i++) {

       var table_col = $("#excelcol"+i).attr('data-id');

      if(table_col == 'ACC_NAME'){

        var excelcol =  $("#excelcol"+i).val();

        tblcol.push(excelcol);

      }

     
    }

    $("#tblcol").val(tblcol[0]);
    $("#temptableid").val(id);
    $("#tblcolacc").val(tblcol[0]);
    $("#temptableidacc").val(id);
    $("#accAliseName").val(acc_Name);
    $("#accAliseCode").val(accCode);
    $("#accType").val(accType);
  }else{

      for(var i = 1; i <= excelExcount; i++) {

       var table_col = $("#excelcol_exceeding"+i).attr('dataex-id');

      if(table_col == 'CP_NAME'){

        var excelcol =  $("#excelcol_exceeding"+i).val();

        tblcol.push(excelcol);

      }

     
    }


    $("#tblcol").val(tblcol[0]);
    $("#temptableid").val(id);
    $("#tblcolacc").val(tblcol[0]);
    $("#temptableidacc").val(id);
    $("#accAliseName").val(acc_Name);
    $("#accAliseCode").val(accCode);
    $("#accType").val(accType);

  }

    //alert(tblcol);return false;

    console.log('col',tblcol);
    console.log('id',id);

    console.log('acc_name',acc_Name);


    
    $("#AccModal").modal('show');

   /* $('#AccModal').modal({
       show:true,
       backdrop:'static'
    });*/

    $('#AccTable').DataTable().destroy();


     var t = $("#AccTable").DataTable({

            oLanguage: {
              sProcessing: $('.modalspinner').removeClass('hideloaderOnModl')
          },
       processing: true,

       serverSide:true,

       scrollX:true,


       ajax:{


        url : "{{ url('/Master/Customer-Vendor/View-Account-Consinee') }}"


       },

       searching : true,

    

       columns: [

         
         { 
              data:"DT_RowIndex",
              name:"DT_RowIndex",
              className:"text-center",
              'render': function (data, type, full, meta){
                    if(full['CITY_NAME']==''){
                         return '<input type="radio" name="accCodeValue" class="accCodeValue'+full['DT_RowIndex']+'" disabled>';
                       }else{
                          return '<input type="radio" name="accCodeValue" class="accCodeValue'+full['DT_RowIndex']+'" value="'+full['ACC_CODE']+'~'+full['ACC_NAME']+'~'+full['ACATG_CODE']+'">';
                       }

                     
                     }
        },

         { data: "ACC_CODE",className:"textLeft",
          },

         { data: "ACC_NAME",className:"textLeft",

        },
        { data: "ALIAS_CODE",className:"textLeft",
        },
         { data: "ALIAS_NAME",className:"textLeft",
        },

         { data: "CITY_NAME",className:"textLeft",

        },


      ],

      

     });

  }


</script>

<script type="text/javascript">
  
  function showAllcQty(id,qty,dono,itemslno,accType){

    console.log(itemslno);
     var excelcount =  $("#ececelCount").val();
     var excelExcount =  $("#ececelExcCount").val();
    

    var tblcol =[]; 


if(accType=='YARD'){

    for(var i = 1; i <= excelcount; i++) {

       var table_col = $("#excelcol"+i).attr('data-id');
       console.log(table_col);

      if(table_col == 'DORDER_NO'){

        var excelcol =  $("#excelcol"+i).val();

        tblcol.push(excelcol);

      }

     
    }

    $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });


      $.ajax({

            url:"{{ url('get-old-qty-for-donumber-qty-update') }}",

            method : "POST",

            type: "JSON",

            data: {dono:dono,itemslno:itemslno},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  

                  $("#old_qty").val(data1.data.QTY);
                 

                }

            }

          });

}else{


  for(var i = 1; i <= excelExcount; i++) {

       var table_col = $("#excelcol_exceeding"+i).attr('dataex-id');

      if(table_col == 'DORDER_NO'){

        var excelcol =  $("#excelcol_exceeding"+i).val();

        tblcol.push(excelcol);

      }

     
    }

}

   // console.log(tblcol);

    $("#tblcol").val(tblcol[0]);
    $("#temptableid").val(id);

    $("#tblcoldo").val(tblcol[0]);
    $("#temptableidDo").val(id);
    $("#allc_qty").val(qty);
    $("#donoqty").val(dono);
    $("#itemslno").val(itemslno);
    $("#allcQTY").modal('show');
    $("#accType").val(accType);

  }


</script>
<script type="text/javascript">
  
   function updatedAllctQTY(flag){

     var allc_qty      =   $("#allc_qty").val();
     var do_no         =   $("#donoqty").val();
     var itemslno         =   $("#itemslno").val();
     var tblcoldo      =   $("#tblcoldo").val();
     var temptableidDo =   $("#temptableidDo").val();

     var accType = $("#accType").val();

     //alert(accType);

   console.log(temptableidDo);
   console.log(tblcoldo);

     $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });


      $.ajax({

            url:"{{ url('update-allctedqty-from-do-number') }}",

            method : "POST",

            type: "JSON",

            data: {do_no: do_no,allc_qty:allc_qty,tblcoldo:tblcoldo,temptableidDo:temptableidDo,itemslno:itemslno,flag:flag},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  

                  if(accType=='YARD'){

                    var new_data_count = data1.new_data_count;

                    var itemacc_count = data1.itemacc_count;

                    var allocqty_count = data1.allocqty_count;


                   $('#allcQTY').modal('hide');
                   $('#example').DataTable().ajax.reload();
                   $('#proceedbtn').prop('disabled', true);
                    submitbtnEnable(new_data_count,itemacc_count,allocqty_count,accType);

                  }else{

                    var new_data_count = data1.new_data_count;

                    var itemacc_count = data1.itemacc_count;

                    var allocqty_count = data1.allocqty_count;


                   $('#allcQTY').modal('hide');
                   $('#example').DataTable().ajax.reload();
                   $('#proceedbtn').prop('disabled', true);

                   $('#allcQTY').modal('hide');
                   $('#doexceedingexample').DataTable().ajax.reload();
                   $('#proceedbtn').prop('disabled', true);
                    submitbtnEnable(new_data_count,itemacc_count,allocqty_count,accType);

                  }


                 

                }

            }

          });


   }

</script>

<script type="text/javascript">
  
  function GetAllctQTY(){

    var allc_qty =   $("#allc_qty").val();
    var do_no     =   $("#donoqty").val();

   

     $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });


      $.ajax({

            url:"{{ url('get-allctedqty-from-do-number') }}",

            method : "POST",

            type: "JSON",

            data: {do_no: do_no},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  console.log('data1.data[0]',data1.data_trip_qty);

                    var old_do_qty = data1.data_do_qty.QTY;

                   if(data1.data_trip_qty== null){

                    var plan_qty ='0';
                   }else{

                    var plan_qty = data1.data_trip_qty.QTY;
                   }

                 // console.log(old_do_qty);

                    if(allc_qty >= old_do_qty){

                  
                      $("#proceedbtn").prop('disabled',false);
                      $("#allcqtyerr").html('');

                    }else if(allc_qty < old_do_qty){

                     
                          if(allc_qty >= plan_qty){

                            
                             $("#proceedbtn").prop('disabled',false);
                             $("#allcqtyerr").html('');

                           }else if(allc_qty < plan_qty){

                            
                              updatedAllctQTY(0);
                               $("#allcqtyerr").html('Planning Of this do qty already done').css('color','red');
                              $("#proceedbtn").prop('disabled',true);
                           }

                    }

                  
                }

            }

          });




  }
</script>


<script type="text/javascript">
  
  function showItem(id,itemCode,itemName,accType){

   var excelcount =  $("#ececelCount").val();

   var excelExcount =  $("#ececelExcCount").val();

    var tblcol =[]; 
    var tblcol2 =[]; 


    if(accType=='YARD'){

       for(var i = 1; i <= excelcount; i++) {

       var table_col = $("#excelcol"+i).attr('data-id');

          if(table_col == 'ITEM_CODE'){

            var excelcol =  $("#excelcol"+i).val();

            tblcol.push(excelcol);

          }

          if(table_col == 'REMARK'){

            var excelcol1 =  $("#excelcol"+i).val();

            tblcol2.push(excelcol1);

          }


        $("#tblcol").val(tblcol);
        $("#tblcol2").val(tblcol2);
        $("#temptableid").val(id);
        $("#accType").val(accType);
        $("#itemAliseCode").val(itemCode);
        $("#itemAliseName").val(itemName);

      }

    

    }else{

      for(var i = 1; i <= excelExcount; i++) {

       //var table_col = $("#excelcol"+i).attr('data-id');
       var table_col = $("#excelcol_exceeding"+i).attr('dataex-id');

          if(table_col == 'ITEM_CODE'){

            var excelcol =  $("#excelcol_exceeding"+i).val();

            tblcol.push(excelcol);

          }

          if(table_col == 'REMARK'){

            var excelcol1 =  $("#excelcol_exceeding"+i).val();

            tblcol2.push(excelcol1);

          }

           $("#tblcol").val(tblcol);
          $("#tblcol2").val(tblcol2);
          $("#temptableid").val(id);
          $("#accType").val(accType);
          $("#itemAliseCode").val(itemCode);
          $("#itemAliseName").val(itemName);

      }

       

    }
   
    //alert(table_col[0]);
    
//alert(tblcol2[0]);return false;

    
    $("#ItemModal").modal('show');


     $('#ItemTable').DataTable().destroy();
    

    var t = $("#ItemTable").DataTable({

            oLanguage: {
              sProcessing: $('.modalspinner').removeClass('hideloaderOnModl')
          },
           

       processing: true,

       serverSide:true,

       //scrollY:500,

      // scrollX:true,
       pageLength:100,
      /* paging: false,
       autoWidth: true,*/

       ajax:{

        url : "{{ url('/Master/Item/View-Item-Master-Excel') }}"


       },


       searching : true,

       columnDefs:[
        { "width": "10px", "targets": 0 },
        { "width": "200px", "targets": 1 },
        { "width": "250px", "targets": 2 },
        
      ],

       columns: [

         
         { 
              data:"DT_RowIndex",
              name:"DT_RowIndex",
              className:"text-center",
              'render': function (data, type, full, meta){
                         return '<input type="radio" name="itemCodeValue" class="itemCodeValue'+full['DT_RowIndex']+'" value="'+full['ITEM_CODE']+'-'+full['ITEM_NAME']+'">';

                     
                     }
        },

         { data: "ITEM_CODE",
           className:"textLeft",
         },

         { data: "ITEM_NAME",
            className:"textLeft",

          },


      ],

      

     });


    //('.modalspinner').addClass('hideloaderOnModl');
     
   //$('.modalspinner').addClass('hideloaderOnModl');


   /*var url = "< ?php echo url('/Master/Item/Item-Master'); ?>";

    $("#ssd").load(url);*/

  }


  function hideItemModal(){

    
     $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });



      $.ajax({

              // url:"{{ url('/Master/Item/Item-Master') }}",

                url:"{{ url('/get-item-page-with-data') }}",

                 method : "GET",

                 type: "JSON",

                 data:'',

                 success:function(returndata){
                  
                 $("#ItemPageShow").html(returndata);
               
                  //$("#append_item").empty();

                 $('#ItemModal').modal('toggle');
                 $('#newItemModal').modal('show');
               

                 var obj = JSON.parse(returndata);


                 if(obj.response=='error'){

                   
                 }else{

                  
                  
                 }

                 
               
                   
                 }

              });



  }

  function hideAccModal(){


     $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });



      $.ajax({

              // url:"{{ url('/Master/Item/Item-Master') }}",

                url:"{{ url('/get-acc-page-with-data') }}",

                 method : "GET",

                 type: "JSON",

                 data:'',

                 success:function(returndata){
                  
                 $("#AccPageShow").html(returndata);
               
                  //$("#append_item").empty();

                 $('#AccModal').modal('toggle');
                 $('#newAccModal').modal('show');
               

                 var obj = JSON.parse(returndata);


                 if(obj.response=='error'){

                   
                 }else{

                  
                  
                 }

                 
               
                   
                 }

              });

   


  }


</script>

<script type="text/javascript">

    //document end



 function importData(){



    var data = $("#importorder").serialize();

          
//alert(data);
          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST','Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',

              url: "<?php echo url('/finance/doimport'); ?>",

              data: data, // here $(this) refers to the ajax object not form
              enctype: 'multipart/form-data',

              success: function (data) {

               //  var data1 = JSON.parse(data);

                 console.log(data);

              },

          });
      
  }


       
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
  
  function forderNo(orderNo){

    var OrderNo = $("#freight_order_no").val();
    var route_code = $("#route_code").val();
    var route_name = $("#route_name").val();


    var forderNo = OrderNo.split(" ");

    var FreightOrderNo = forderNo[2];

     $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });

     $.ajax({

            url:"{{ url('get-place-from-freight-orderno') }}",

            method : "POST",

            type: "JSON",

            data: {FreightOrderNo: FreightOrderNo},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);

                  

                  

                   
                   
                    $("#getRouteCode").val(data1.data[0].ROUTE_CODE);
                    $("#getRouteName").val(data1.data[0].ROUTE_NAME);

                 $("#routeList1").empty();

                 $.each(data1.data, function(k, getData){


                    $("#routeList1").append($('<option>',{

                      value:getData.ROUTE_CODE,

                      'data-xyz':getData.ROUTE_CODE,
                      text:getData.ROUTE_CODE


                    }));


                    

                  })

                }

            }

          });

  }



  function getRouteDetails(fromCode) {
    
    var route_code = $("#route_code"+fromCode).val();
    var from_place = $("#from_place"+fromCode).val();

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });


      $.ajax({

            url:"{{ url('get-route-details-by-from-place') }}",

            method : "POST",

            type: "JSON",

            data: {route_code: route_code,from_place:from_place},

            success:function(data){

              //console.log(data);

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);

                    

                    $("#to_place"+fromCode).val(data1.data.TO_PLACE);
                    $("#vehicle_type"+fromCode).val(data1.data.VEHICLE_TYPE);

                  

                }

            }

          });



  }

</script>

<script type="text/javascript">
  

  $('#account_code').on('change',function(){
      var acc_code = $(this).val();



      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });

      $.ajax({

            url:"{{ url('get-freight-orderno-by-customer') }}",

            method : "POST",

            type: "JSON",

            data: {acc_code: acc_code},

            success:function(data){

                console.log('fsodata',data);

              var data1 = JSON.parse(data);
              console.log('fso',data1.data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);

                    

                    $("#freightList").empty();

                  $.each(data1.data, function(k, getData){


                    var fy_year     =  getData.FY_CODE;
                    var series_code =  getData.SERIES_CODE;
                    var vr_no       =  getData.VRNO;
                    
                    var fy_code     =  fy_year.split("-");
                    
                    var fycode      = fy_code[1];
                    
                    var pordervrno  = fycode+' '+series_code+' '+vr_no;



                    $("#freightList").append($('<option>',{

                      value:pordervrno,

                      'data-xyz':pordervrno,
                      text:pordervrno


                    }));

                  })

                }

            }

          });


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

      startDate :fromdateintrans,

      endDate : todateintrans,

      autoclose: 'true'

    });

    $('.partyrefdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromdateintrans_1,

      endDate : todateintrans_1,

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

  var fromdateintrans = $('#FromDateFy').val();
  var todateintrans = $('#ToDateFy').val();
  
   $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :fromdateintrans,
      endDate : todateintrans,

      autoclose: 'true'

    });


   $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      
      endDate : 'today',

      autoclose: 'true'

    });
</script>

<script type="text/javascript">
  function Getqunatity(qtyId){

     var checkqty =$('#qty'+qtyId).val();
     var stockqty =$('#stockavlblevalue'+qtyId).val();
     console.log('qty',checkqty);

     if(checkqty){
        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);
      }else{
        $("#submitdata").prop('disabled', true);
        $("#deletehidn").prop('disabled', true);
        $("#addmorhidn").prop('disabled', true);
      }
     
     var gr_amt;
     if(checkqty){

         var quantity =$('#qty'+qtyId).val().replaceAll(',', '');
         var cfactor = $('#Cfactor'+qtyId).val();

         console.log('cftor',cfactor);
         var total = quantity * cfactor;
   
   /*   if (quantity.length < 1){
        ('#qty'+qtyId).val('0.00');
        ('#A_qty'+qtyId).val('0.00');
      }else {
        var val = parseFloat(quantity);
        var formatted = inrFormat(quantity);

     
        $('#qty'+qtyId).val(val);
      }
*/
     
     

      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value.replaceAll(',', ''));

                
            }

          $("#basicTotal").val(gr_amt.toFixed(2));

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

          $("#basicTotal").val(gr_amt.toFixed(2));

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());
     }
    



  }
</script>

<script type="text/javascript">
  
  function itemCodeGet(ItemId){

   // alert(ItemId);

    var ItemCode =  $('#ItemCodeId'+ItemId).val();

     var xyz = $('#ItemList'+ItemId+' option').filter(function() {

          return this.value == ItemCode;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      

      if(msg=='No Match'){

             $('#ItemCodeId'+ItemId).val('');

             document.getElementById("Item_Name_id"+ItemId).value = '';

             $('#qty'+ItemId).val('');

             $('#A_qty'+ItemId).val('');
             $('#UnitM'+ItemId).val('');
             $('#AddUnitM'+ItemId).val('');
              $('#batchno'+ItemId).html('');
              $('#length'+ItemId).val('');
              $('#width'+ItemId).val('');
              $('#height'+ItemId).val('');
              $('#itemlwh'+ItemId).val('');
            //  $('#odc'+ItemId).val('');
             $('#odcbtn'+ItemId).empty();

             $('#odcbtn'+ItemId).html('');
      }else{

         document.getElementById("Item_Name_id"+ItemId).value = msg;

         
        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide'); 

         $('#itemNameTooltip'+ItemId).html(msg); 

         $('#qty'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false); 

        $('#vr_date,#series_code,#Plant_code,#account_code,#due_days,#emp_code,#cost_center_code').prop('readonly',true); 

      }

     $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

   $.ajax({

          url:"{{ url('get-item-data-requsiton') }}",

          method : "POST",

          type: "JSON",

          data: {ItemCode: ItemCode},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
                  
                }else if(data1.response == 'success'){

                    

                    if(data1.data==''){

                      var umcode = '';

                      var aumcode = '';

                      var cfactor = '';

                      $('#UnitM'+ItemId).val(umcode);

                      $('#AddUnitM'+ItemId).val(aumcode);

                      $('#Cfactor'+ItemId).val(cfactor);

                    }else{
                    
                          $('#UnitM'+ItemId).val(data1.data[0].UM_CODE);

                          $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                          $('#Cfactor'+ItemId).val(data1.data[0].AUM_FACTOR);

                          $('#scrab_code'+ItemId).val(data1.data_hsn[0].SCRAP_CODE);

                          $('#stockavlble'+ItemId).html('Stock : '+data1.totalstock);
                          $('#stockavlblevalue'+ItemId).val(data1.totalstock);

                          if(data1.batchNo==null || data1.batchNo==''){
                          $('#batchno'+ItemId).html('');
                          $('#batch_no'+ItemId).val('');
                          }else{
                            $('#batchno'+ItemId).html('Batch No : '+data1.batchNo);
                            $('#batch_no'+ItemId).val(data1.batchNo);
                          }
                    
                    }

                    if(data1.data_hsn == ''){

                    }else{
                      console.log('dataHsn',data1.data_hsn[0]);
                        
                          var item_length1  =data1.data_hsn[0].LENGTH;
                          var item_width1  = data1.data_hsn[0].WIDTH;
                          var item_height1  =data1.data_hsn[0].HEIGHT;

                          if(item_length1==null || item_width1==null || item_height1==null){

                            var  item_length = 0;
                            var  item_width = 0;
                            var  item_height = 0;
                          }else{
                           var  item_length = item_length1;
                           var  item_width  = item_width1;
                           var  item_height = item_height1;
                          }

                          $("#length"+ItemId).val(item_length);
                          $("#width"+ItemId).val(item_width);
                          $("#height"+ItemId).val(item_height);

                          var  itemlwh = item_length+'/'+item_width+'/'+item_height;

                          $("#itemlwh"+ItemId).val(itemlwh);

                          $("#length_dub"+ItemId).val(item_length);
                          $("#width_dub"+ItemId).val(item_width);
                          $("#height_dub"+ItemId).val(item_height);

                          var odcitem = data1.data_hsn[0].ODC;
                
                          $("#odcbtn"+ItemId).empty();
                          if(odcitem=='null' || odcitem=='' || odcitem==null || odcitem===null){
                           
                             var odcbtn = "<button type='button' id='odccancelbtn' class='btn btn-danger btn-sm' style='padding: 0px 0px !important;font-size: 11px !important;line-height: 1 !important;'><i class='fa fa-close'></i> &nbsp;ODC</button><input type='hidden' class='form-control' name='odc[]' id='odc"+ItemId+"' value='NO' readonly>";

                            $("#odcbtn"+ItemId).html(odcbtn);

                          }else{
                             console.log('else');
                          if(odcitem=='YES'){

                             var odcwbtn ="<button type='button' id='odcsucessbtn' class='btn btn-success btn-sm' style='padding: 0px 0px !important;font-size: 11px !important;line-height: 1 !important;'><i class='fa fa-check'></i> &nbsp;ODC</button><input type='hidden' class='form-control' name='odc[]' id='odc"+ItemId+"' value='YES' readonly>";

                             $("#odcbtn"+ItemId).append(odcwbtn);
                            // $('#odc'+ItemId).val('YES');
                      
                          }else if(odcitem=='NO'){  

                            var odcbtn = "<button type='button' id='odccancelbtn' class='btn btn-danger btn-sm' style='padding: 0px 0px !important;font-size: 11px !important;line-height: 1 !important;'><i class='fa fa-close'></i> &nbsp;ODC</button><input type='hidden' class='form-control' name='odc[]' id='odc"+ItemId+"' value='NO' readonly>";

                            $("#odcbtn"+ItemId).append(odcbtn);
                            ///$('#odc'+ItemId).val('NO');
                          
                          }else{


                            var odcbtn = "<button type='button' id='odccancelbtn' class='btn btn-danger btn-sm' style='padding: 0px 0px !important;font-size: 11px !important;line-height: 1 !important;'><i class='fa fa-close'></i> &nbsp;ODC</button><input type='hidden' class='form-control' name='odc[]' id='odc"+ItemId+"' value='NO' readonly>";

                            $("#odcbtn"+ItemId).append(odcbtn);
                          }


                          }
                    }

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

      });


  }
</script>


<script type="text/javascript">
  
  function excelCodeBySeries(){

       var seriesCode = $('#series_code').val();
        $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
      });



        $.ajax({

          url:"{{ url('get-do-excel-code-by-series') }}",

          method : "POST",

          type: "JSON",

          data: {seriesCode: seriesCode},

          success:function(data){

            console.log(data);

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){



                  if(data1.data==''){

                    //$("#bodyId").css('display','none');
                  }else{


                        $("#doExcelList").empty();

                            $.each(data1.data, function(k, row){
                                
                                $("#doExcelList").append($('<option>',{

                                  value:row['EXLCONFIG_CODE'],

                                  'data-xyz':row['EXLCONFIG_NAME'],
                                  text:row['EXLCONFIG_NAME']

                                }));
                              
                              });

            

                  }



              }

          }

    });



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



                  if(data1.vrno_series == '' || data1.vrno_series==null){

                      $('#vrseqnum').val('');
                      $('#getVrNo').val('');

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

<script type="text/javascript">
  
  function getItemValue(){

    var temptableid = $("#temptableid").val();

    var tempdataCount = $("#tempdataCount").val();

    var itemAliseCode = $("#itemAliseCode").val();
    var itemAliseName = $("#itemAliseName").val();

    var accType = $("#accType").val();

    var tblcol = $("#tblcol").val();
    var tblcol2 = $("#tblcol2").val();

   var getitem =  $("input[name='itemCodeValue']:checked").val();

   var  explode =  getitem.split("-");

   var  itemCode =  explode[0];

   var  itemName =  explode[1];

 
    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });


    $.ajax({

          url:"{{ url('update-item-code-to-delivery-order') }}",

          method : "POST",

          type: "JSON",

          data: {itemCode: itemCode,itemName:itemName,temptableid:temptableid,tblcol:tblcol,tblcol2:tblcol2,itemAliseName:itemAliseName,itemAliseCode:itemAliseCode},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  


                  if(accType=='YARD'){


                  var new_data_count = data1.new_data_count;

                  var itemacc_count = data1.itemacc_count;

                  var allocqty_count = data1.allocqty_count;



                  $("#indicate_msg").css('display','block');

                  $("#tempdataCount").val(itemacc_count);
                  
                  $('#ItemModal').modal('hide');
                  $('#example').DataTable().ajax.reload();

                   submitbtnEnable(new_data_count,itemacc_count,allocqty_count,accType);

                 }else{


                  var new_data_count = data1.new_data_count;

                  var itemacc_count = data1.itemacc_count;

                  var allocqty_count = data1.allocqty_count;

                  $("#tempdataCount1").val(itemacc_count);

                  $('#ItemModal').modal('hide');
                  $('#doexceedingexample').DataTable().ajax.reload();

                    submitbtnEnable(new_data_count,itemacc_count,allocqty_count,accType);

                 }

              }

          }

    });

  }
</script>


<script type="text/javascript">
  
  function submitbtnEnable(new_data_count,itemacc_count,allocqty_count,accType){

    if(accType=='YARD'){

      if(itemacc_count > 0 || allocqty_count > 0){
        
        $("#submitexceldata").prop('disabled',true);

      }else if(new_data_count > 0 && allocqty_count == 0){

       $("#submitexceldata").prop('disabled',false);
                    
       }else if(new_data_count > 0){
        $("#submitexceldata").prop('disabled',false);

      }else{

        $("#submitexceldata").prop('disabled',true);
      }

    }else{

       if(itemacc_count > 0 || allocqty_count > 0){

        $("#submitexcelEXdata").prop('disabled',true);

      }else if(new_data_count > 0 && allocqty_count == 0){

       $("#submitexcelEXdata").prop('disabled',false);
                    
       }else if(new_data_count > 0){

        $("#submitexcelEXdata").prop('disabled',false);

      }else{

        $("#submitexcelEXdata").prop('disabled',true);
      }

    }
    

  }

</script>

<script type="text/javascript">
  
  function getAccValue(){

    var temptableid = $("#temptableid").val();
    var tempdataCount = $("#tempdataCount").val();
    var tempdataCount1 = $("#tempdataCount1").val();
    var accAliseName = $("#accAliseName").val();
    var accAliseCode = $("#accAliseCode").val();
    var accType = $("#accType").val();



   var getacc =  $("input[name='accCodeValue']:checked").val();



   var  explode =  getacc.split("~");

   var  accCode =  explode[0];
   var  accName =  explode[1];
   var  accCatCode =  explode[2];


   var tblcol = $("#tblcol").val();

 
    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });


    $.ajax({

          url:"{{ url('update-acc-code-to-delivery-order') }}",

          method : "POST",

          type: "JSON",

          data: {accCode: accCode,accCatCode:accCatCode,accName:accName,accAliseName:accAliseName,accAliseCode:accAliseCode,temptableid:temptableid,tblcol:tblcol},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  var new_data_count = data1.new_data_count;

                  var itemacc_count = data1.itemacc_count;

                  var allocqty_count = data1.allocqty_count;


                 if(accType=='YARD'){

                   

                   $("#tempdataCount").val(itemacc_count);

                   $('#AccModal').modal('hide');

                  $('#example').DataTable().ajax.reload();
                  submitbtnEnable(new_data_count,itemacc_count,allocqty_count,accType);

                 }else{

                    

                  $("#tempdataCount1").val(itemacc_count);

                  $('#AccModal').modal('hide');
                  $('#doexceedingexample').DataTable().ajax.reload();
                  submitbtnEnable(new_data_count,itemacc_count,allocqty_count,accType);



                 }
                 ///
                 

              }

          }

    });

  }
</script>




<script type="text/javascript">
  function stateName(num){

   // alert(num);

           var val = $("#state"+num).val();

          var xyz = $('#stateList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg){

            $("#state_name"+num).val(msg);
          }else{
            $("#state_name"+num).val('');
          }



  }
</script>

<script type="text/javascript">

  function consigneeName(num){

   // alert(num);

         //  var val = $("#consignee"+num).val();

           var consinee_code = $("#consignee"+num).val();


          var xyz = $('#ConsineeList'+num+' option').filter(function() {

          return this.value == consinee_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg){

            $("#consineeName"+num).val(msg);
          }else{
            $("#consineeName"+num).val('');
          }

            $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

          });


      $.ajax({

        url:"{{ url('get-consinee-address-by-acc') }}",

        method : "POST",

        type: "JSON",

        data: {consinee_code: consinee_code},

        success:function(data){

          var data1 = JSON.parse(data);


          console.log(data1.data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
            $("#consigneeadd"+num).val('');

          }else if(data1.response == 'success'){
            //console.log('data1.data[0]',data1.data[0]);
            if(data1.data == ''){
                
              
                
                 $("#consigneeadd"+num).val('');
              }else{

              //  $('#profitctrId').val(data1.data[0].PFCT_CODE);

                    $("#ConsineeAddList"+num).empty();


                    $.each(data1.data, function(k, getData){

                    $("#ConsineeAddList"+num).append($('<option>',{

                          value:getData.ADD1,

                          'data-xyz':getData.ADD1,
                          text:getData.ADD1


                        }));

                  });

              }

          }

        }

      });

  }
</script>

<script type="text/javascript">
  
  function PlantCode(){

    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var Plant_code = $('#Plant_code').val();

      $.ajax({

        url:"{{ url('Get-Pfct-Code-Name-By-Plant') }}",

        method : "POST",

        type: "JSON",

        data: {Plant_code: Plant_code},

        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){
            //console.log('data1.data[0]',data1.data[0]);
            if(data1.data == ''){
                 var profitctr = '';
                 var pfctget = '';
                 var pfctName = '';
                 var statec = '';
                 $('#profitctrId').val(profitctr);
                 $('#pfctName').val(pfctName);
                 $('#getPfctName').val(pfctName);
                 $('#getPfctCode').val(pfctget);
                 $('#getStateByPlant').val(statec);
              }else{
                $('#profitctrId').val(data1.data[0].PFCT_CODE);
                $('#pfctName').val(data1.data[0].PFCT_NAME);
                $('#getPfctName').val(data1.data[0].PFCT_NAME);
                $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                $('#getStateByPlant').val(data1.data[0].STATE_CODE);
                $('#from_place1').val(data1.data[0].CITYNAME);
                $('#fromplace').val(data1.data[0].CITYNAME);

              }

          }

        }

      });
  }
</script>

<script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>

@endsection