@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<script type="text/javascript">

var itemcodeurl = "<?php echo url('get-item-um-aum'); ?>";
var qtyparametrurl = "<?php echo url('/finance/getqua-parameter-by-item'); ?>";
var pfctcodeurl = "<?php echo url('get-pfct-code-name-by-plant-indend'); ?>";
var qtyitemurl = "<?php echo url('/finance/getqua-parameter-by-item'); ?>";
var acccodeurl = "<?php echo url('get-acc-data-by-acc-code'); ?>";
var bomitemurl = "<?php echo url('get-item-from-bom-by-bomno'); ?>";
var planturl = "<?php echo url('get-pfct-code-name-by-plant-indend'); ?>";



</script>

<style type="text/css">

    .tooltip{
      color: #66CCFF !important;
    }

    .notshowcnlbtn{
    display: none;
  }

    .itmbyQc{
    display: none;
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

  .secondSection{

    display: none;
  }

  .rightcontent{

  text-align:right;


}
.hiddenicon{
  display: none;
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
  width:6%; 
  text-align: center;
}
.texIndbox2{
  width: 45%; 
  text-align: center;
}
 .texIndbox1{
  width: 5%; 
  text-align: center;
}
.rateIndbox{
  width: 11% !important;
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

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Daily Production
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
          <a href="{{ url('/finance/transaction/purchase-order-transaction') }}"> Production</a>
        </li>
      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Daily Production</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Transaction/Production/view-daily-production') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Daily Production</a>

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
                <li id="secondTab">
                  <a href="#tab2info" data-toggle="tab" >Other Details</a>
                </li>
            </ul>
          </div>
          <div class="panel-body">
              <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab1info">

                    <div class="row">

                      <!-- /.col -->
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Date: <span class="required-field"></span></label>

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

                                if($get_Month >=3 && $get_year == $fyYear[1]){
                                    $vrDate = $ToDate;
                                }else{
                                    $vrDate = $CurrentDate;
                                }

                              ?>

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control transdatepicker" name="vr" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

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

                       <div class="col-md-3">

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

                      <div class="col-md-4">

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

                      </div>


                        <!-- /.col -->
                     <div class="row">

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

                       <div class="col-md-3">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                
                               </span>
                              <?php $plcount = count($plant_list); ?>
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>" readonly autocomplete="off">

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
                      <div class="col-md-3">
                       <div class="form-group">

                          <label>Acc Code : </label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 4px 12px;">

                                <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>

                                <div class="" id="appndaccbtn"> 
                                </div>

                                 <?php $accCount = count($getacc); ?>
                                 <input type="hidden" id="getaccCount" value="{{$accCount}}">
                                 <?php if($accCount == 1) { ?>

                                  <button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="getplantdata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;" id="appndplantbtn1"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>

                                 <?php } else{ ?>
                                  <i class="fa fa-newspaper-o" aria-hidden="true" id="showicon"></i>
                                 <?php } ?>

                              </span>
                              
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="<?php if($accCount == 1){echo $getacc[0]->ACC_CODE;}else{} ?>" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off" readonly> 

                              <datalist id="AccountList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($getacc as $key)

                                <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                            <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                            <small id="acccode_code_errr" style="color: red;"></small>
                            <small id="accNotFound"></small>

                        </div>
                      </div>
                    </div>

                    <div class="row">

                       <div class="col-md-3">

                        <div class="form-group">

                          <label> Account Name : </label>

                            <div class="input-group tooltips">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="acctname" value="<?php if($accCount == 1){echo $getacc[0]->ACC_NAME;}else{} ?>" id="accountName" placeholder="Enter Profit Account Name" readonly autocomplete="off">

                              <span class="tooltiptext tooltiphide" id="accountNameTooltip"></span>
                              <?php if($accCount==1){ ?>
                                  <span class="tooltiptext" id="accountNameTooltip">
                                    <?=  $getacc[0]->ACC_NAME; ?>
                                  </span>
                              <?php } else { ?>

                                <span class="tooltiptext" id="accountNameTooltip" style="display: none;"></span>

                              <?php } ?>


                            </div>

                        </div>
                        
                      </div>
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>BOM No : <span id="requiredstar"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="bomList" class="form-control" name="bom_no" value="" id="bom_no" placeholder="Enter Bom No" autocomplete="off" onchange="getFgByBomNo(1)">

                              <datalist id="bomList">

                                <?php foreach($bom_list as $key) {

                                  $date    = $key->FY_CODE;
                                  $getdata = explode('-', $date);

                                 ?>

                                <option value="<?= $getdata[0]; ?> <?= $key->SERIES_CODE ?> <?= $key->VRNO ?>"></option>

                              <?php } ?>

                              </datalist>

                            </div>

                            <small id="empName" class="showcodename"></small>

                        </div>
                        
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Finishing Good Code: 

                            <span class="required-field"></span>

                          </label>

                          <div class="input-group">

                            <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true" id="serisicon"></i>

                                <div class="" id="appndbtn">
                                    
                                </div>
                            </span>
                             
                            <input list="fgList1"  id="fg_code" name="fg_code" class="form-control  pull-left" placeholder="Select Finishing Good Code" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getItmByFgCode();FgCodeGet()">


                            <datalist id="fgList1">

                              @foreach($fg_list as $key)

                                <option value='<?php echo $key->ITEM_CODE?>'   data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                              @endforeach

                            </datalist>

                             

                          </div>

                          <small id="fg_code_errr" style="color: red;"></small>

                        </div>
                        <!-- /.form-group -->
                      </div>
                      
                     

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Finishing Good Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>


                              <input type="text" class="form-control" name="fg_name" value="" id="fg_name" placeholder="Enter Finishing Good Name" value="" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>
                     

                    </div>

                    <div class="row">
                      
                       

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>UM : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>


                               <input type="text" class="form-control" name="fgunit_M[]" id="fgUnitM" readonly placeholder="Enter UM" style="width: 50px;">

                            </div>

                        </div>
                        
                      </div>

                       <div class="col-md-3">

                        <div class="form-group">

                          <label> Qty Production :  <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>


                              <input type="text" class="form-control Number" name="qty_prod" value="" id="qty_prod" placeholder="Enter Quantity Production" value="" autocomplete="off"  oninput="multiplyqty()">
                             
                            </div>

                        </div>
                        
                  </div>


                  <div class="col-md-3">

                        <div class="form-group">

                          <label> Cost Center Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="costList" class="form-control" name="cost_center_code" value="" id="cost_center_code" placeholder="Enter Cost Center Code" autocomplete="off">

                              <datalist id="costList">
                                <?php foreach ($cost_list as $key) { ?>
                                  
                                <option value="<?= $key->COST_CODE ?>"><?= $key->COST_CODE ?> <?= $key->COST_NAME ?></option>

                                 <input type="hidden"  id="costname" value="<?= $key->COST_NAME ?>">

                                <?php } ?>

                              </datalist>

                            </div>

                            <small id="empName" class="showcodename"></small>

                        </div>
                        
                      </div>
                       
                    </div>
                   
                      <!-- /.col -->

                    <!-- /.row -->


                  </div> <!-- /.tab first -->
                 
              </div>
          </div>
        </div>
      </div>
    </div>
            

          

            

          </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->

  <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <form id="salesordertrans">
              @csrf
              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <input type="hidden" id="getItmexistCount">
                  <input type ="hidden" name="comp_name" id="getCompName">
                  <input type ="hidden" name="fy_year" id="getFyYear">
                  <input type ="hidden" name="trans_date" id="getTransDate">
                  <input type ="hidden" name="vr_no" id="getVrNo">
                  <input type ="hidden" name="trans_code" id="getTransCode">
                  <input type ="hidden" name="accCode" id="getAccCode">
                  <input type ="hidden" name="accName" id="getAccName">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="plant_name" id="getPlantName">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
                  <input type ="hidden" name="series_name" id="getSeriesName">
                  <input type ="hidden" name="fgcode" id="getFgCode">
                  <input type ="hidden" name="fgname" id="getFgName">
                  <input type ="hidden" name="tax_code" id="getTaxCode">
                  <input type="hidden" name="due_days" id="gateduedays">
                  <input type="hidden" name="getdue_date" id="gateduedate">
                  <input type ="hidden" name="post_code" id="getPostCode"> 
                  <input type ="hidden" name="gl_code" id="getGlCode">                 
                  <input type="hidden" name="fgpost_code" id="fgpost_code">
                  <input type="hidden" name="std_rate" id="std_rate">
                  <input type="hidden" name="emplyeeName" id="emplyeeName">
                  <input type="hidden" value="{{ $series_list[0]->POST_CODE }}" id="post_code" name="configPostCode">
                 <input type="hidden" value="{{ $series_list[0]->GL_CODE }}" id="gl_code" name="configGlCode">
                  <input type="hidden" name="totalstd" id="totalstd">

                  <input type="hidden" name="cost_code" id="cost_code">
                  <input type="hidden"   name="cost_name" id="cost_name"> 


                  <tr>

                    <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 10px;"> Sr.No.</th>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty Recd</th>

                    <th>A-Qty Recd</th>

                    <th>Qty Issued</th>

                    <th>A-Qty Issued</th>

                    <th>Action</th>

                  </tr>

                  <tr class="useful" id="firstRowtr">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">1.</span>
                    </td> 

                    <td class="tdthtablebordr">
                      <div class="input-group">

                        <input type="text" class="inputboxclr itmbyQc" style="width: 90px;margin-bottom: 4px;margin-top: 13px;" id='Item_CodeId1' name="itemPo[]" onclick="ShowItemCode(1);ItemCodeGet(1);"  oninput="this.value = this.value.toUpperCase()" readonly/>

                        <input list="ItemList1" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId1' name="item_code[]"  onchange="ItemCodeGet(1);quaParaGet(1)"  oninput="this.value = this.value.toUpperCase()" />

                          <datalist id="ItemList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($help_item_list as $key)

                              <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                              @endforeach

                          </datalist>
                      </div>
                      <input type="hidden" name="item_post_code[]" id="item_post_code1" value="" style="z-index: 0;">
                      <input type="hidden" name="item_stdRate[]" id="item_stdRate1" value="" style="z-index: 0;">
                      <input type="hidden" name="item_MVARate[]" id="item_MVARate1" value="" style="z-index: 0;">
                       <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1" onclick="showItemDetail(1)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                       <input type="hidden" id="idsun1">

                        <input type="hidden" id="selectItem1">
                        <div class="divhsn" id="showHsnCd1"></div>
                        <input type="hidden" id="hsn_code1" name="hsn_code[]">
                        <input type="hidden" id="taxByItem1" name="tax_byitem[]">
                        <input type="hidden" id="taxratebytax1" value="">
                        <input type="hidden" id="po_transcode1" name="po_trans[]">
                        <input type="hidden" id="po_seriescode1" name="po_series[]">
                        <input type="hidden" id="po_vrno1" name="po_vrno[]">
                        <input type="hidden" id="po_slno1" name="po_slno[]">
                        <input type="hidden" id="po_headid1" name="po_head[]">
                        <input type="hidden" id="po_bodyid1" name="po_body[]">
                        <input type="hidden" id="itmC_code1" name="itemcodeC[]">
                        <input type="hidden" id="itemglCode1" name="itemglCode[]">

                    </td>

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id1' name="item_name[]" readonly />

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>

                      <textarea id="remark_data1" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description" readonly></textarea>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate txtMult"  id='qty1' name="qty[]" oninput='Getqunatity(1)'style="width: 80px" readonly />
                      <input type="hidden" id="qtyget1" class="totlqty">
                      <input type="text" name="unit_M[]" id="UnitM1" class="inputboxclr SetInCenter AddM" readonly>

                      <input type="hidden" id="Cfactor1">
                      <input type="hidden" class='revStdRTot' value="" id="itmbystdRate1" name="itmbystdRate[]">
                      
                      </div>
                      <small id="GetqunatityERR1"></small>
                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty1' name="Aqty[]"  style="width: 80px" readonly />

                      <input type="text" name="add_unit_M[]" id="AddUnitM1" class="inputboxclr SetInCenter AddM" readonly>

                      </div>

                    </td>


                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate"  id='issueqty1' name="issueqty[]" oninput='Getqunatityissue(1)'style="width: 80px" readonly />
                      <input type="hidden" id="qtyget1" class="totlqty">
                      <input type="text" name="issueunit_M[]" id="issueUnitM1" class="inputboxclr SetInCenter AddM" readonly>

                      <input type="hidden" id="Cfactor1">
                       <input type="hidden" id="balQtyByItem1">
                      <input type="hidden" class="issuMvAgTot" id="itmmovgAvgR1" name="itmmovgAvgR[]">

                      </div>

                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='issueA_qty1' name="issueAqty[]"  style="width: 80px" readonly />

                      <input type="text" name="issueadd_unit_M[]" id="issueAddUnitM1" class="inputboxclr SetInCenter AddM" readonly>

                      </div>

                    </td>
                    

                    <td>
                       
                         <div style="margin-top: 12%;">
                         <small id="taxnotfound1" class="label label-danger"></small>
                         </div>
                         <input type="hidden" id='quaP_count1' value="0" name="quaP_count[]" class="quaPcountrow">
                       <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax1" data-toggle="modal" data-target="#quality_parametr1" onclick="qty_parameter(1)" disabled="" style="padding-bottom: 0px;
    padding-top: 0px;">Quality Parametr </button>

     <div id="appliedbtn1"></div>
    <div id="cancelbtn1"></div>
    <div id="qpApplyOrNot1" class="aplynotStatus">0</div>


    <small id="qPnotfountbtn1" class="label label-danger"></small>
                       
                     </td>

                  </tr>

                </table>

              </div><!-- /div -->

            
              <div class="row" style="display: flex;">

                  <div class="col-md-6"></div>

                    <div class="col-md-4 toalvaldesn">



                    <div class="totlsetinres">Total :</div>

                  </div>
                  <input type="hidden" id="revStdRTotal" name="revStdRTotal">
                  <input type="hidden" id="issuMvgATotal" name="issuMvgATotal">
                  <div class="col-md-1">
                     <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="basicTotal" readonly="" style="margin-top: 3px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>   

      <br>

        <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

        <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

        <p class="text-center">

          <button type="button" class="btn btn-primary btn-xs" id="simulationbtn" data-toggle="modal" data-target="#simulation_model" onclick="simulationcalc(1);" disabled="">Simulation</button>

          <button class="btn btn-success" type="button" id="submitdata" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

        </p>

       
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
           
            <center><small style="text-align: center;" id="footer_ok_btn1"></small>
            <small style="text-align: center;" id="footer_quality_btn1"></small>
            </center>
          
          </div>

        </div>

      </div>
    </div>

    <div id="quaPdomModel_2">
         
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
                    <div class="box10 texIndbox2">Item Name</div>
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
                    <div class="box10 texIndbox">Series Code</div>
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
<div class="modal fade in" id="simulation_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="false">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">

                <div class="col-md-3"></div>

                <div class="col-md-7">

                  <h5 class="modal-title modltitletext" id="exampleModalLabel1">Simulation</h5>

                </div>

                <div class="col-md-2"></div>

              </div>

            </div>

            <div class="modal-body table-responsive">

              <div class="boxer" id="siml_body">
                
              </div>
              
            </div>

            <div class="modal-footer">

              <span id="siml_footer1" style="width: 10px;"><button type="button" class="btn btn-primary " style="width: 10%;" data-dismiss="modal">Ok</button></span>
             </center>

            </div>

          </div>

        </div>

      </div>

      <!-- show modal when click on view btn after  select plantcode -->

        <div class="modal fade" id="plant_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Account Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox1">Account Name</div>
                   
                    <div class="box10 rateIndbox">Acc Type</div>
                    <div class="box10 rateIndbox">Address</div>
                    <div class="box10 rateBox">Address</div>

                    <div class="box10 amountBox">Address</div>
                    <div class="box10 amountBox">City</div>
                    <div class="box10 amountBox">State</div>
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

        <div id="taxNotAppied" class="modal fade" tabindex="-1">
          <div class="modal-dialog modal-sm" style="margin-top: 13%;">
              <div class="modal-content" style="border-radius: 5px;">
                  <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                  </div>
                  <div class="modal-body">
                    <p>The <b>Quality Paramter</b> Has Not Been Applied. In Some Of The Above Entries. </p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
                      <button type="button" class="btn btn-primary" id="savedataAfterAlert" data-dismiss="modal">Save</button>
                  </div>
              </div>
          </div>
        </div>



        <div id="allItemShow1" class="modal fade" tabindex="-1">

        <div class="modal-dialog modal-lg" style="margin-top: 13%;">

            <div class="modal-content" style="border-radius: 5px;">

                <div class="modal-header">

                  <div class="row">

                      <div class="col-md-12" style="text-align: center;">

                        <h5 class="modal-title modltitletext" id="exampleModalLabel">Item Details</h5>

                      </div>

                  </div>

                </div>

                <div class="modal-body table-responsive">
                    <div class="boxer" id="itemListShow_1">

                    </div>

                </div>

                <div class="modal-footer" style="text-align: center;" id="footer_item_1">

                </div>

            </div>

        </div>

      </div>
      <!-- when tax not applied then show model -->

<!------------ modal for simulation ------------------>
  
  

<!------------ modal for simulation ------------------>


    </form>

  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script>
<script src="{{ URL::asset('public/dist/js/viewjs/daily_production.js') }}" ></script>
  
<script type="text/javascript">

  
  $(document).ready(function() {

     $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

    });

    //$('.moneyformate').mask("#,##0.00", {reverse: true});

   

    

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

  $(document).ready(function(){

    $( window ).on( "load", function() {

      getvrnoBySeries();

     var vrseqno = $('#vrseqnum').val();

     var vrlastnum = $('#vr_last_num').val();

     var plant_code = $('#Plant_code').val();
     var plantname = $('#plantname').val();
     var post_code    = $('#post_code').val();
     var gl_code    = $('#gl_code').val();
    
     if(plant_code){

      $("#getPlantCode").val(plant_code);
     }

     if(plantname){

      $("#getPlantName").val(plantname);
     }

      if(post_code){
        $('#getPostCode').val(post_code);
      }

      if(gl_code){
        $('#getGlCode').val(gl_code);
      }
     

      if(vrseqno == ''){

        $('#setdisable').prop('disabled',true);

      }else if(vrseqno==vrlastnum){

        $('#setdisable').prop('disabled',true);

      }else{

        $('#setdisable').prop('disabled',false);

      }

    });

  });

</script>


<script type="text/javascript">
  
$('#cost_center_code').on('change',function(){


  var costCode = $(this).val();

   var costName = $("#costname").val();

 // alert(costName);

  $("#cost_code").val(costCode);
  $("#cost_name").val(costName);

});

</script>

<script type="text/javascript">

  $(".delete").on('click', function() {


      var rowCount = $('#tbledata tr').length;
      
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

          $("#basicTotal").val(quantity.toFixed(3));

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
    var adrow=1;

  $(".addmore").on('click',function(){

     /*var itmexist= $('#getItmexistCount').val();
      if(itmexist){
        var getIc = itmexist -1;
        var i = getIc+ii;

        alert(i);
      }else{
         var i = ii;
      }*/
      
      //alert(i);
/*
      var tabletr = $("#trtablecount").val();
      if(tabletr){
        var i = tabletr+1;
      }*/
      
      count=$('table tr').length;

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> </td>";

      data +="<td class='tdthtablebordr'><div class='input-group'><input type='text' class='inputboxclr itmbyQc' style='width: 90px;margin-bottom: 4px;margin-top: 13px;' id='Item_CodeId"+i+"' name='itemPo[]' onclick='ShowItemCode("+i+");'  oninput='this.value = this.value.toUpperCase()' readonly/><input list='ItemList"+i+"' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' name='item_code[]' onchange='ItemCodeGet("+i+");quaParaGet("+i+");' oninput='this.value = this.value.toUpperCase()'/><datalist id='ItemList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($help_item_list as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option>@endforeach</datalist></div><input type='hidden' name='item_post_code[]' id='item_post_code"+i+"' value='' style='z-index: 0;'><input type='hidden' name='item_stdRate[]' id='item_stdRate"+i+"' value='' style='z-index: 0;'><input type='hidden' name='item_MVARate[]' id='item_MVARate"+i+"' value='' style='z-index: 0;'><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button></td><td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly /><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></small><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description'></textarea></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount getqtytotal inputboxclr SetInCenter quantityC moneyformate txtMult'  id='qty"+i+"' name='qty[]' oninput='Getqunatity("+i+")' style='width: 80px' /><input type='hidden' id='qtyget"+i+"' class='totlqty'><input type='text' name='unit_M[]' readonly id='UnitM"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' id='Cfactor"+i+"'><input type='hidden' id='balQtyByItem"+i+"'><input type='hidden' class='revStdRTot' value='' id='itmbystdRate"+i+"' name='itmbystdRate[]'></div><small id='GetqunatityERR"+i+"'></small></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM'></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate'  id='issueqty"+i+"' name='issueqty[]' oninput='Getqunatityissue("+i+")'style='width: 80px' readonly /><input type='hidden' id='qtyget"+i+"' class='totlqty'><input type='text' name='issueunit_M[]' id='issueUnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly></div><input type='hidden' class='issuMvAgTot' id='itmmovgAvgR"+i+"' name='itmmovgAvgR[]'></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='issueA_qty"+i+"' name='issueAqty[]'  style='width: 80px' readonly /><input type='text' name='issueadd_unit_M[]' id='issueAddUnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly></div></td><td><div style='margin-top: 12%;'><small id='taxnotfound"+i+"' class='label label-danger'></small></div><input type='hidden' id='quaP_count"+i+"' value='0' name='quaP_count[]' class='quaPcountrow'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='CalcTax"+i+"' data-toggle='modal' data-target='#quality_parametr"+i+"' onclick='qty_parameter("+i+")' style='padding-bottom: 0px;padding-top: 0px;' disabled>Quality Parametr </button><div id='appliedbtn"+i+"'></div><div id='cancelbtn"+i+"'></div><div class='aplynotStatus' id='qpApplyOrNot"+i+"'>0</div><small id='qPnotfountbtn"+i+"' class='label label-danger'></small><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox2'>Item Name</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading'><small id='itemCodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='taxcodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemDetailshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemtypeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemgroupshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemclassshow"+i+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemcategoryshow"+i+"'> </small> </div></div> </div></div> <div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div> </div></div></div> <div id='allItemShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-lg' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12' style='text-align: center;'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Details</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='itemListShow_"+i+"'></div></div><div class='modal-footer' style='text-align: center;' id='footer_item_"+i+"'></div></div></div></div></td>";

      $('table').append(data);

      var qpdomModel = "<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' style='padding-bottom: 0px;padding-top: 0px;' id='exampleModalLabel' >Qaulity Parameter</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+i+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footer_ok_btn"+i+"'></small>&nbsp;<small style='text-align: center;' id='footer_quality_btn"+i+"'></small></center></div></div></div></div>";
      $('#quaPdomModel_2').append(qpdomModel);


       var getbomno =  $('#bom_no').val();

       if(getbomno){

        $('#Item_CodeId'+i).removeClass('itmbyQc');
        $('#ItemCodeId'+i).css('display','none');
      }else{
        $('#Item_CodeId'+i).addClass('itmbyQc');
        $('#ItemCodeId'+i).css('display','block');
      }


      i++;

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

 /*function close*/

  

 

  function Getqunatity_old(qtyId){

     var checkqty =$('#qty'+qtyId).val();
     if(checkqty){

         var quantity =$('#qty'+qtyId).val();
         var cfactor = $('#Cfactor'+qtyId).val();
         var total = quantity * cfactor;

          $('#A_qty'+qtyId).val(total.toFixed(2));
   
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

     }
  }

    function Getqunatity(qtyId){

      var quantity = $('#qty'+qtyId).val();

     // alert(parseInt(quantity));
      var cfactor  = $('#Cfactor'+qtyId).val();
      var basicAmt = $('#basicTotal').val();
      var bal_qty = $('#balQtyByItem'+qtyId).val();
      var total    = quantity * cfactor;

      var balqty = parseFloat(bal_qty);

      if(quantity){

        if(balqty){
            if(quantity > balqty){



              $('#GetqunatityERR'+qtyId).html('QTY SHOULD NOT GRETER THAN BAL QTY').css('color','red');
              $('#qty'+qtyId).val(bal_qty);

              var balaqty =  parseFloat(balqty)  * parseFloat(cfactor);

              $('#A_qty'+qtyId).val(balaqty.toFixed(3));
              setTimeout(function() {
                            $('#GetqunatityERR'+qtyId).html('');
                        }, 1000);

            }else{
              $('#A_qty'+qtyId).val(total.toFixed(3));
              $('#GetqunatityERR'+qtyId).html('');
            }
        }else{
           $('#A_qty'+qtyId).val(total.toFixed(3));
        }
        
        
        console.log('basicAmt',basicAmt);
        
        $('#issueqty'+qtyId).prop('readonly',true);
        $('#issueqty'+qtyId).val('');
        $('#issueA_qty'+qtyId).prop('readonly',true);
        $('#issueA_qty'+qtyId).val('');
        $('#rate'+qtyId).prop('readonly',false);
        $("#submitdata").prop('disabled', false);
        $("#simulationbtn").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);
        
            
      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value);

                
            }

          $("#basicTotal").val(gr_amt.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

      });

       if(basicAmt == 0.00 || basicAmt == 0){

       }

     }else{
        $('#issueqty'+qtyId).prop('readonly',false);
        $('#issueqty'+qtyId).val('');
        $('#issueA_qty'+qtyId).prop('readonly',false);
        $('#issueA_qty'+qtyId).val('');
        $('#A_qty'+qtyId).val('');
        $("#submitdata").prop('disabled', true);
        $("#simulationbtn").prop('disabled', true);
        $("#deletehidn").prop('disabled', true);
        $("#addmorhidn").prop('disabled', true);

         $('#basicTotal').val('');
     }

     var istdRate = $('#item_stdRate'+qtyId).val();

     var mavRate  = $('#item_MVARate'+qtyId).val();

     if(mavRate){
        var calIstdR = mavRate * quantity;
        $('#itmbystdRate'+qtyId).val(calIstdR);

        revStdT =0;
        $(".revStdRTot").each(function () {
       
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                revStdT += parseFloat(this.value);

                
            }

          $("#revStdRTotal").val(revStdT.toFixed(2));

      });
     }

     
  }

   function Getqunatityissue(qtyId){

      var quantity = $('#issueqty'+qtyId).val();
      var cfactor  = $('#Cfactor'+qtyId).val();
      var basicAmt = $('#basicTotal').val();
      var total    = quantity * cfactor;

      if(quantity){

      $('#issueA_qty'+qtyId).val(total.toFixed(3));
        
        console.log('basicAmt',basicAmt);

        $('#qty'+qtyId).prop('readonly',true);
        $('#qty'+qtyId).val('');
        $('#A_qty'+qtyId).prop('readonly',true);
        $('#A_qty'+qtyId).val('');
        
        
        $('#rate'+qtyId).prop('readonly',false);
        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#simulationbtn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);
            
      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value);

                
            }

          $("#basicTotal").val(gr_amt.toFixed(3).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

      });

       if(basicAmt == 0.00 || basicAmt == 0){

       }

     }else{

        $('#qty'+qtyId).prop('readonly',false);
        $('#qty'+qtyId).val('');
        $('#A_qty'+qtyId).prop('readonly',false);
        $('#A_qty'+qtyId).val('');
        $('#issueA_qty'+qtyId).val('');
        $('#basicTotal').val('');
        
        
        $('#rate'+qtyId).prop('readonly',true);
        $("#submitdata").prop('disabled', true);
        $("#deletehidn").prop('disabled', true);
        $("#simulationbtn").prop('disabled', true);
        $("#addmorhidn").prop('disabled', true);
     }

     var mavRate  = $('#item_MVARate'+qtyId).val();

     if(mavRate){
      var calmvgAvgR = mavRate * quantity;
      $('#itmmovgAvgR'+qtyId).val(calmvgAvgR);

      mvgt =0;
       $(".issuMvAgTot").each(function () {
       
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                mvgt += parseFloat(this.value);

                
            }

          $("#issuMvgATotal").val(mvgt.toFixed(2));

      });

     }



     
  }

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
  function getvalue(getvalue,staticvalue){


      if(staticvalue==1){

          
          $('#cancelbtn'+getvalue).empty();
          $('#appliedbtn'+getvalue).empty();

          var appliedbtn ='<small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small>';


          $('#appliedbtn'+getvalue).append(appliedbtn);
          $('#qpApplyOrNot'+getvalue).html('1');
         
          

         // $('#submitdata').prop('disabled', false);
         // $('#cancelbtn'+getvalue).html('');

         var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });


      
      }else{
           
          $('#appliedbtn'+getvalue).empty();
          $('#cancelbtn'+getvalue).empty();

         var cnclbtn ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

         $('#cancelbtn'+getvalue).append(cnclbtn);
         $('#quaP_count'+getvalue).val(0);
         $('#qpApplyOrNot'+getvalue).html('0');

        
          //$('#appliedbtn'+getvalue).html('');
          //$('#submitdata').prop('disabled', true);

          var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });

         
      }

  }

  

</script>


<script type="text/javascript">

$(document).ready(function(){

    $("#submitdata").click(function(event) {

     


          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/finance/save-daily-production-transaction') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

             //   console.log(data);
               var url = "{{url('/finance/view-daily-production-msg')}}"
              setTimeout(function(){ window.location = url+'/savedata'; });
              },

          });
      
                
    });





});

</script>

<script type="text/javascript">
  
  $(document).ready(function(){

   $("#savedataAfterAlert").click(function(event) {


    

          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/finance/save-daily-production-transaction') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                /*console.log(data);*/
               var url = "{{url('/Transaction/Production/view-daily-production')}}"
              setTimeout(function(){ window.location = url });
              },

          });
      
                
    });
    
    });
</script>

<script type="text/javascript">
  function getcode(sers_code){

  $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

  var sers_code = $('#series_code').val();
  //console.log(sers_code);

 // alert(sers_code);

  $.ajax({

            url:"{{ url('get-series-data-by-series-code') }}",

            method : "POST",

            type: "JSON",

            data: {sers_code: sers_code},

            success:function(data){


              var data1 = JSON.parse(data);
              


                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  
                  $("#seriesCodeshow").html(data1.data[0].SERIES_CODE);
                  $("#seriesNameshow").html(data1.data[0].SERIES_NAME);
                  $("#trancodeshow").html(data1.data[0].TRAN_CODE);
                  if(data1.data[0].GL_CODE){

                  $("#glcodeshow").html(data1.data[0].GL_CODE);
                  }else{
                  $("#glcodeshow").html('--');
                   }

                   if(data1.data[0].POST_CODE){
                  $("#postcodeshow").html(data1.data[0].POST_CODE);
                    }else{
                   $("#postcodeshow").html('--');
                    }
                    if(data1.data[0].RFHEAD1){

                  $("#rfhead1show").html(data1.data[0].RFHEAD1);
                    }else{

                      $("#rfhead1show").html('--');
                    }
               
                  if(data1.data[0].RFHEAD2){
                  $("#rfhead2show").html(data1.data[0].RFHEAD2);
                  }else{
                    $("#rfhead2show").html('--');
                    }

                  if(data1.data[0].RFHEAD3){
                  $("#rfhead3show").html(data1.data[0].RFHEAD3);
                }else{
                  $("#rfhead3show").html('--');
                }
                if(data1.data[0].RFHEAD4){
                  $("#rfhead4show").html(data1.data[0].RFHEAD4);
                }else{
                  $("#rfhead4show").html('--');
                }
                

                }

            }

          });
}
</script>
<script type="text/javascript">
 
</script>

<script type="text/javascript">

 function getItmByFgCode(){

        var fgGood = $("#fg_code").val();
        var Plant_code = $("#Plant_code").val();

       

         $('#vr_date,#series_code,#Plant_code,#account_code,#bom_no').prop('disabled',true);

        $.ajaxSetup({

                headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

        });

        $.ajax({

                type: 'POST',

                url: "{{ url('/get-item-from-bom-by-fg-code') }}",

                data: {fgGood:fgGood,Plant_code:Plant_code}, 

                beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
                  },

                success: function (data) {

                
                  console.log(data);
                  var data1 = JSON.parse(data);

                      if(data1.data==''){
                       $("#fg_code").prop('readonly',true);
                      
                      
                      }else{

                         
                          $("#fg_code").prop('readonly',true);

                          
                        $('#getItmexistCount').val(data1.data.length);

                        var recvvalue = 0;
                        var issuevalue = 0;

                        //console.log(data1.PostCode[0].POST_CODE);
                        var fgpost_code = data1.PostCode[0].POST_CODE;
                        var stdrate = data1.stdrate.STDRATE;
                        $("#fgpost_code").val(fgpost_code);
                        $("#std_rate").val(stdrate);

                        /* /. for loop */
                      } /* /. else */
                }, /* /. success */

                complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
                  },
        }); /* /. ajax */

    }
</script>

<script type="text/javascript">
  

  
</script>

<script type="text/javascript">
  function multiplyqty22(qty){

   var prd_qty = $("#qty_prod").val();
   var recv_qty = $("#qty").val();

  }
</script>

<script type="text/javascript">
   function multiplyqty() {


     var prd_qty = $("#qty_prod").val();
     var std_rate = $("#std_rate").val();



    /* if(prd_qty){

      $("#ItemCodeId1").prop('readonly', false);

     }else{
      $("#ItemCodeId1").prop('readonly', true);
     }
*/
      var totalhead = (prd_qty * std_rate);

      $("#totalstd").val(totalhead);

     //console.log('totalw',total2);

               var mult = 0;
               $(".txtMult").each(function (i) {

                var srno=i + 1;



                   var $val1 = $('#qty'+srno).val();
                   //var $val2 = $('#val2').val();
                   var $total = ($val1 * prd_qty);


                 //  $('#multTotal').text($total);

                   srno++;
               });
           }
</script>


<script type="text/javascript">
  function simulationcalc(){
    var seriesGl     = $('#getPostCode').val();
    var seriesGlCode = $('#getGlCode').val();
    var fgpost_code  = $('#fgpost_code').val();
    var totalstd     = $('#totalstd').val();
    var totalstdRate = $('#revStdRTotal').val();
    var totalMvgRate = $('#issuMvgATotal').val();
    var itmePostCode = [];
    var itmestdAmt   = [];
    var itemCode     = [];
    var itemmvgAmt   = [];

    $('input[name^="item_post_code"]').each(function (){
          itmePostCode.push($(this).val());

         // alert(itmePostCode);
    });

    $('input[name^="itmbystdRate"]').each(function (){
          itmestdAmt.push($(this).val());
    });
    $('input[name^="item_code"]').each(function (){
          itemCode.push($(this).val());
    });

    $('input[name^="itmmovgAvgR"]').each(function (){
          itemmvgAmt.push($(this).val());
    });

    $.ajax({

        url:"{{ url('get-simulation-data-for-sdaily-production') }}",

        method : "POST",

        type: "JSON",

        data: {seriesGl: seriesGl,seriesGlCode: seriesGlCode,fgpost_code: fgpost_code,totalstd: totalstd,totalstdRate:totalstdRate,totalMvgRate:totalMvgRate,itmePostCode:itmePostCode,itmestdAmt:itmestdAmt,itemCode:itemCode,itemmvgAmt:itemmvgAmt},

        success:function(data){
          console.log(data);
          var data1 = JSON.parse(data);


          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

            $('#siml_body').empty();
              if(data1.data_sim==''){

              }else{
                  var headData = "<div class='box-row'><div class='box10 texIndbox'>Gl</div><div class='box10 rateIndbox'>Gl Name</div> <div class='box10 rateIndbox'>Debit-DR</div><div class='box10 rateIndbox'>Credit-CR</div></div>";

                  $('#siml_body').append(headData); 

                  var drTotal = 0;
                  var crTotal = 0;

                  $.each(data1.data_sim, function(k, getData) {

                     drTotal += parseFloat(getData.DR_AMT);
                     crTotal += parseFloat(getData.CR_AMT);

                    var bodyData = "<div class='box-row tooltips'><div class='box10 texIndbox'><small class='tooltipcoderef' >"+getData.CODE_NAME+"</small>"+getData.IND_GL_CODE+"</div><div class='box10 rateIndbox'>"+getData.glName+"</div> <div class='box10 rateIndbox'>"+getData.DR_AMT+"</div><div class='box10 rateIndbox'>"+getData.CR_AMT+"</div></div>";

                    $('#siml_body').append(bodyData);

                  });

                  /*var footerData = "<div class='box-row'><div class='box10 texIndbox'></div><div class='box10 rateIndbox'><b>Total : </b></div> <div class='box10 rateIndbox'><b>"+drTotal+"</b></div><div class='box10 rateIndbox'><b>"+crTotal+"</b></div></div>";

                    $('#siml_body').append(footerData);*/


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


<script type="text/javascript">

  function ShowItemCode(itemId){

 //   var account_code = $('#account_code').val();
    var bom_num =  $('#bom_no').val();
    var bom_no = bom_num.split(' ');
    var bomno = bom_no[2];
    var series_code =  bom_no[1];

   // console.log(series_code);
   /*alert(bomno);
   alert(series_code);
*/
    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $.ajax({

          url:"{{ url('get-itmdata-by-bill-of-material') }}",

          method : "POST",

          type: "JSON",

          data: {bomno:bomno,series_code:series_code},

          success:function(data){

            console.log(data);

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){
                  //console.log(data1.data[0].item_name);
                    if(data1.data == ''){

                       $('#allItemShow'+itemId).modal('hide');

                       $('#itemnotFound'+itemId).html('Item Not Found');
                       $('#ItemCodeId'+itemId).prop('readonly',true);
                       $('#ItemCodeId'+itemId).val('');

                    }else{

                      $('#allItemShow'+itemId).modal('show');

                      $('#itemListShow_'+itemId).empty();

                       $('#itemnotFound'+itemId).html('');
                       $('#ItemCodeId'+itemId).prop('readonly',false);



                      var tableHead= "<div class='box-row'><div class='box10 texIndbox'>#</div><div class='box10 vrnoinbox'>Vr. No</div><div class='box10 itemIndbox'>Item </div><div class='box10 rateIndbox'>Qty RECD </div><div class='box10 rateIndbox'>Qty ISSUED </div><div class='box10 rateIndbox' >Qty Cancle </div><div class='box10 rateIndbox' style='width:10%'>Bal. Qty </div></div>";



                      $('#itemListShow_'+itemId).append(tableHead);

                      var incemntval = 1;

                      var inval = '';

                      var itmCounts = data1.data.length;



                      $('#itmCountchk').val(itmCounts);
                      if(itmCounts == 1){
                        $('#addmorhidn').prop('disabled',true);
                      }else{
                        $('#addmorhidn').prop('disabled',false);
                      }


                      $.each(data1.data, function(k, getData) {

                        var startyear = getData.VRDATE;
                        var getyear = startyear.split("-");
                        
                        if(getData.QTYISSUE == null){
                          var QTYISSUE = '0.00';
                        }else{
                          var QTYISSUE = getData.QTYISSUE;
                        }

                        if(getData.AQTYISSUED == null){
                          var AQTYISSUED = '0.00';
                        }else{
                          var AQTYISSUED = getData.AQTYISSUED;
                        }

                        if(getData.QTYRECD == null){
                          var QTYRECD = '0.00';
                        }else{
                          var QTYRECD = getData.QTYRECD;
                        }


                        if(getData.AQTYRECD == null){
                          var AQTYRECD = '0.00';
                        }else{
                          var AQTYRECD = getData.AQTYRECD;
                        }

                        var QTYCANCEL = getData.QTYCANCEL;

                        var QTYBAL = QTYRECD - QTYISSUE - QTYCANCEL;

                        //console.log('QTYISSUED',getData.QTYISSUED);
                        console.log('AQTYRECD',getData.AQTYRECD);
                        

                      var tableBody = "<div class='box-row'  id='hidebalNull_"+itemId+"_"+incemntval+"'><div class='box10 texIndbox' style='width: 19%;'><input type='radio' id='sr_"+itemId+"_"+incemntval+"' name='itemname' value='"+itemId+"_"+incemntval+"'></div><div class='box10 texIndbox' style='width: 19%;'><input type='text' id='vrno_"+itemId+"_"+incemntval+"' name='head_tax_ind11[]' class='form-control inputtaxInd' value="+getyear[0]+'&nbsp;'+getData.SERIES_CODE+'&nbsp;'+getData.VRNO+" readonly></div><div class='box10 rateIndbox tooltips'><input type='hidden' value="+getData.FY_CODE+" id='sqfiscalyr_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.SERIES_CODE+" id='poseries_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.SERIES_CODE+" id='potran_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.SERIES_CODE+" id='povrno_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.SLNO+" id='poslno_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.PORDERBID+" id='pobodyid_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.PORDERHID+" id='poheadid_"+itemId+"_"+incemntval+"'><input type='hidden' value='"+getData.REMARK+"' id='poitmdisciptn_"+itemId+"_"+incemntval+"'><input type='text' id='itemcode_"+itemId+"_"+incemntval+"' name='itemco' class='form-control'  value='"+getData.ITEM_CODE+"("+getData.ITEM_NAME+")"+"' readonly><div class='tooltiptextitem tooltiphide' id='itemNameTooltip_"+itemId+"_"+incemntval+"'></div><input type='hidden' value="+getData.TAX_CODE+" id='taxCodeI_"+itemId+"_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='qtyOreder_"+itemId+"_"+incemntval+"' name='qtyOrder' class='form-control rightcontent' value="+QTYRECD+" readonly><input type='hidden' value="+QTYRECD+" id='ordr_rate_"+itemId+"_"+incemntval+"'><input type='hidden' value="+AQTYRECD+" id='AQTYRECD_"+itemId+"_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='qtySupply_"+itemId+"_"+incemntval+"' name='qtySupply[]' class='form-control rightcontent' value="+QTYISSUE+" readonly><input type='hidden' value="+AQTYISSUED+" id='AQTYISSUED_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.UM+" id='UM_"+itemId+"_"+incemntval+"'><input type='hidden' value="+getData.AUM+" id='AUM_"+itemId+"_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='qtyCancle_"+itemId+"_"+incemntval+"' name='qtyCancle[]' class='form-control rightcontent' value="+getData.QTYCANCEL+" readonly></div><div class='box10 rateIndbox'><input type='text' id='balence_qty_"+itemId+"_"+incemntval+"' name='balQty[]' class='form-control rightcontent' value="+QTYBAL+" readonly><input type='hidden' class='form-control' id='remainBalQty_"+itemId+"_"+incemntval+"' value='"+QTYBAL+"' readonly></div></div>";

                      $('#itemListShow_'+itemId).append(tableBody);

                      $('#itemNameTooltip_'+itemId+'_'+incemntval).removeClass('tooltiphide');

                     $('#itemNameTooltip_'+itemId+'_'+incemntval).html(getData.ITEM_NAME);

                      getItemForCheckQty(itemId,incemntval);

                      inval = incemntval;

                      incemntval++;

                      }); // each loop close


                      var butn =  $('#footer_item_'+itemId).find(':button').html();

                      //alert(butn);

                         if(butn != 'Ok' || butn =='undefined'){

                          var tablefooter = "<button type='button' class='btn btn-primary ' style='width: 27%;' data-dismiss='modal' id='ApplyOkitmbtn"+itemId+"' onclick='selectitem("+itemId+","+inval+");umAumByitm("+itemId+","+inval+");quaParaGet("+itemId+")'>Ok</button><button type='button' class='btn btn-danger notshowcnlbtn' data-dismiss='modal' style='width: 16%;' id='addbtnwhenselect"+itemId+"'>Cancel</button>";

                            $('#footer_item_'+itemId).append(tablefooter);

                         }else{

                         }

                          var selectedItem = $('#selectItem'+itemId).val();

                          var uniqByitm = $('#idsun'+itemId).val();

                          if(selectedItem){

                            $('#sr_'+uniqByitm).prop('checked',true);

                            $('#ApplyOkitmbtn'+itemId).prop('disabled',true);

                            $('#addbtnwhenselect'+itemId).removeClass('notshowcnlbtn');

                            $('input[name="itemname"]').each(function() {
                               //if not selected
                              if ($(this).is( ":not(:checked)")) {
                                // add disable
                                $(this).attr('disabled', 'disabled');
                              }
                            });

                          }


                    } /* else close*/

                } /* success if close*/


           }  /*success function close*/



      });  /*ajax close*/

  } /* ./ function*/


  function selectitem(rowid,itmebyid){

    var checkitmIsAval = $('#Item_CodeId'+rowid).val();


    if(checkitmIsAval == ''){

      var ind_value      = $("input[type='radio'][name='itemname']:checked").val();
      
      var res            = ind_value.split("_");
      
      var res1           = res[0];
      
      var res2           = res[1];
      
      var itemcode       = $('#itemcode_'+res1+'_'+res2).val();
      
      var item_Code      =  itemcode.split('(');
      
      var getitemCd      = item_Code[0];
      
      var cur_val        = $('#checkitm').val();
      
      var balencQtyByitm = $('#balence_qty_'+res1+'_'+res2).val();
      var recdQty = $('#qtyOreder_'+res1+'_'+res2).val();



      var issueQty      = $('#qtySupply_'+res1+'_'+res2).val();

      var AqtyRecd      = $('#AQTYRECD_'+res1+'_'+res2).val();

      var AqtyIssued    = $('#AQTYISSUED_'+res1+'_'+res2).val();

      var UM             = $('#UM_'+res1+'_'+res2).val();

      var AUM            = $('#AUM_'+res1+'_'+res2).val();
      
      var sequnNo        = $('#vrno_'+res1+'_'+res2).val();
      
      var qc_rate        = $('#ordr_rate_'+res1+'_'+res2).val();
      
      var poseries       = $('#poseries_'+res1+'_'+res2).val();
      var potransc       = $('#potran_'+res1+'_'+res2).val();
      var poslno         = $('#poslno_'+res1+'_'+res2).val();
      var povrno         = $('#povrno_'+res1+'_'+res2).val();
      var pobody         = $('#pobodyid_'+res1+'_'+res2).val();
      var  pohead        = $('#poheadid_'+res1+'_'+res2).val();
      var poitmdiscriptn = $('#poitmdisciptn_'+res1+'_'+res2).val();
     // console.log('poitmdiscriptn',poitmdiscriptn);
      var tax_CodeI      = $('#taxCodeI_'+res1+'_'+res2).val();

      var prd_qty = $("#qty_prod").val();
     var std_rate = $("#std_rate").val();

   
      var totalhead = (prd_qty * std_rate);

      $("#totalstd").val(totalhead);

      $('#tolranceshow'+rowid).removeClass('tolrancehide');
      var cnclbtn ='<input type="hidden" value="'+0+'" id="tolcvalue"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';
      $('#cancelbtolrntn'+rowid).html(cnclbtn);

      var cnclbtntax ='<input type="hidden" value="0" id="qltyvalue'+rowid+'"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

    $('#cancelbtn'+rowid).html(cnclbtntax);

    var cnclbtnqp ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

      $('#cancelQpbtn'+rowid).append(cnclbtnqp);

      $('#Item_CodeId'+rowid).val(getitemCd);
      $('#itmC_code'+rowid).val(getitemCd);
      
      $('#selectItem'+rowid).val(getitemCd);
      $('#Item_Name_id'+rowid).val(itemcode);

        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#simulationbtn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);

      if(poitmdiscriptn == null || poitmdiscriptn == 'null' || poitmdiscriptn ==''){
        var remarkPo = '';
      }else{
        var remarkPo = poitmdiscriptn;
      }
      $('#remark_data'+rowid).val(remarkPo);
      
      $('#idsun'+rowid).val(res1+'_'+res2);

      $('#rate'+rowid).val(qc_rate);
      $('#qnrate'+rowid).val(qc_rate);

      if(balencQtyByitm!=0.00){
        $('#qty'+rowid).val(balencQtyByitm);
      }else{
        $('#qty'+rowid).val('');
      }

      if(AqtyRecd!=0.00){
        $('#A_qty'+rowid).val(AqtyRecd);
      }else{
        $('#A_qty'+rowid).val('');
      }

      if(issueQty!=0.00){
        $('#issueqty'+rowid).val(issueQty);
      }else{
        $('#issueqty'+rowid).val('');
      }

      if(AqtyIssued!=0.00){
         $('#issueA_qty'+rowid).val(AqtyIssued);
      }else{
        $('#issueA_qty'+rowid).val('');
      }
      

      $('#req_qty'+rowid).val(balencQtyByitm);


      $('#req_A_qty'+rowid).val(AqtyRecd);

      

      $('#issueUnitM'+rowid).val(UM);

      $('#issueAddUnitM'+rowid).val(AUM);

      $('#UnitM'+rowid).val(UM);
      $('#AddUnitM'+rowid).val(AUM);
      $('#balQtyByItem'+rowid).val(balencQtyByitm);
      $('#po_transcode'+rowid).val(potransc);
      $('#po_seriescode'+rowid).val(poseries);
      $('#po_vrno'+rowid).val(povrno);
      $('#po_slno'+rowid).val(poslno);
      $('#po_headid'+rowid).val(pohead);
      $('#po_bodyid'+rowid).val(pobody);
      $('#taxByItem'+rowid).val(tax_CodeI);
      $('#viewItemDetail'+rowid).removeClass('showdetail');
      
      $('#qty'+rowid).prop('readonly',false);
      $('#rate'+rowid).prop('readonly',false);
      $('#CalcTax'+rowid).prop('readonly',false);

       var bsic_amt = 0;

             $(".getqtytotal").each(function () {
                //add only if the value is number
                if (!isNaN(this.value) && this.value.length != 0) {
                    bsic_amt += parseFloat(this.value);
                }

              $("#basicTotal").val(bsic_amt.toFixed(2));

            });
      
      /*quantity =0;
       $(".quantityC").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                quantity += parseFloat(this.value);
            }

          $("#basicTotal").val(quantity.toFixed(2));

        });*/

      $('#vr_date,#series_code,#Plant_code,#profitctrId,#account_code,#contractNo,#purOrdervrno,#quotationNo,#tax_code,#due_days,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

      $('#party_ref_date').prop('disabled',true);

      if(cur_val){
        
        var cur_val_new = $('#checkitm').val();

        if(cur_val_new){

          var exploitm =  cur_val_new.split(',');

          var itmpositn = exploitm.length;

            for(var t= 0;t<itmpositn;t++){
              var newitm = $('#Item_CodeId'+rowid).val();

              if(exploitm[t] == newitm){

                $('#Item_CodeId'+rowid).val('');
                $('#qty'+rowid).val('');
                $('#rate'+rowid).val('');
                $('#itmC_code'+rowid).val('');
                $('#selectItem'+rowid).val('');
                $('#idsun'+rowid).val('');
                $('#tolranceshow'+rowid).addClass('tolrancehide');
                $('#cancelbtolrntn'+rowid).css('display','none');
              }else{
                $('#checkitm').val(cur_val + "," + getitemCd);
                $('#vr_date,#series_code,#Plant_code,#account_code,#contractNo,#quotationNo,#tax_code,#due_days,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);

                $('#party_ref_date').prop('disabled',true);

              }
            }
        }

      }else{
        $('#checkitm').val(getitemCd);
      }

    } /* ./ if*/

  } /* ./ function */


  function getItemForCheckQty(rowI,calI){

    var itemGet = $('#itemcode_'+rowI+'_'+calI).val();

    var balenqty = $('#balence_qty_'+rowI+'_'+calI).val();

    var orderQty = $('#qtyOreder_'+rowI+'_'+calI).val();
    var suplyQty = $('#qtySupply_'+rowI+'_'+calI).val();
    var cancleQty = $('#qtyCancle_'+rowI+'_'+calI).val();

    //var remainBalQty = $('#remainBalQty_'+rowI+'_'+calI).val();

      var balenceQty =  orderQty - suplyQty - cancleQty;

      $('#balence_qty_'+rowI+'_'+calI).val(balenceQty.toFixed(3));

      if(orderQty == suplyQty){
        $('#hidebalNull_'+rowI+'_'+calI).hide();
      }else{
        $('#hidebalNull_'+rowI+'_'+calI).show();
      }

  }

/*function close*/



</script>



<script type="text/javascript">
  
  function umAumByitm(ItemId,inval){

     var ItemCode =  $('#Item_CodeId'+ItemId).val();
  //   var ItemCode =  $('#Item_CodeId'+ItemId).val();
    

      var getreqno =  $('#bom_no').val();

      var req_no = getreqno.split(' ');

      var reqno = req_no[2];

     

      var ind_value      = $("input[type='radio'][name='itemname']:checked").val();
      
      var res            = ind_value.split("_");
      
      var res1           = res[0];
      
      var res2           = res[1];

     var qtyrecd =  $('#qtyOreder_'+res1+'_'+res2).val();
     var qtyissued =  $('#qtySupply_'+res1+'_'+res2).val();


      console.log('ItemId ',ItemId);
      console.log('inval ',inval);
      console.log('qtyrecd ',qtyrecd);
     console.log('qtyissued ',qtyissued);

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

       $.ajax({

          url:"<?php echo url('get-item-um-aum-bom'); ?>",

          method : "POST",

          type: "JSON",

          data: {ItemCode: ItemCode,reqno:reqno},

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
                      console.log('AUM_FACTOR',data1.data[0].AUM_FACTOR);
                        
                       $('#item_post_code'+ItemId).val(data1.getpostCode[0].POST_CODE);
                      $('#mvrate'+ItemId).val(data1.MAVGRATE);
                      
                     $('#UnitM'+ItemId).val(data1.data[0].UM_CODE);

                      $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                      $('#Cfactor'+ItemId).val(data1.data[0].AUM_FACTOR);

                      $('#scrab_code'+ItemId).val(data1.data_hsn[0].SCRAP_CODE);

                      if(data1.BACTH_NO){
                        $('#batchno'+ItemId).html('Bacth No'+'-'+data1.BACTH_NO);
                        $('#batch_no'+ItemId).val(data1.BACTH_NO);
                    }else{
                       $('#batchno'+ItemId).html('');
                        $('#batch_no'+ItemId).val('');
                    }

                     if(data1.itypeGl == ''){
                      $('#item_post_code'+ItemId).val('');
                    }else{
                      $('#item_post_code'+ItemId).val(data1.itypeGl[0].POST_CODE);
                    }

                    if(data1.stdRate == ''){
                      $('#item_stdRate'+ItemId).val('');
                      $('#item_MVARate'+ItemId).val('');
                    }else{
                      $('#item_stdRate'+ItemId).val(data1.stdRate[0].STDRATE);
                      $('#item_MVARate'+ItemId).val(data1.stdRate[0].MAVGRATE);
                    }


                  var istdRate = $('#item_stdRate'+ItemId).val();

                  var mavRate  = $('#item_MVARate'+ItemId).val();


                console.log('qtyrecd as',qtyrecd);

                    if(qtyrecd!='0.00'){

                      var quantity = qtyrecd;
                    }else if(qtyissued !='0.00'){
                      var  quantity = qtyissued;
                    }


                if(qtyrecd !=0.00){

                 if(mavRate){

                   
                      
                    var calIstdR = mavRate * quantity;

                    $('#itmbystdRate'+ItemId).val(calIstdR);

                    revStdT =0;
                    $(".revStdRTot").each(function () {
                   
                        if (!isNaN(this.value) && this.value.length != 0) {
                            //gr_amt1 = parseFloat(qtyval);
                            revStdT += parseFloat(this.value);

                            
                        }

                      $("#revStdRTotal").val(revStdT.toFixed(2));

                  });
                 }

               }

                if(qtyissued !=0.00){

                  if(mavRate){
                      var calmvgAvgR = mavRate * quantity;
                      $('#itmmovgAvgR'+ItemId).val(calmvgAvgR);

                      mvgt =0;
                       $(".issuMvAgTot").each(function () {
                       
                            if (!isNaN(this.value) && this.value.length != 0) {
                                //gr_amt1 = parseFloat(qtyval);
                                mvgt += parseFloat(this.value);

                                
                            }

                          $("#issuMvgATotal").val(mvgt.toFixed(2));

                      });

                     }
               }


                 
                   
                     


                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

         }
      }); /*ajax close*/


  }
</script>




<!-- <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script> -->

@endsection