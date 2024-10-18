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

    .textheight{

      height: 17px;
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

/*.inputwidth{
 width:100%;
}*/

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

    padding: 5px;

    padding-bottom: 0px !important;

    line-height: 1;

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

  width: 46px;

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
    padding: 2px 4px !important;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
.btn-sm-class{
    padding: 2px 4px !important;
    font-size: 12px !important;
    line-height: 1.5 !important;
    border-radius: 3px !important;
}
#AccTable{
  overflow-y: scroll !important;
}
.removeSpaceOnModl{
    padding: 2px 15px 2px 15px;
    text-align: center;
}
.modal-header--sticky {
  position: sticky;
  top: 0;
  background-color: inherit; /* [1] */
  z-index: 1055; /* [2] */
}

/* Footer fixed to the bottom of the modal */
.modal-footer--sticky {
  position: sticky;
  bottom: 0;
  background-color: inherit; /* [1] */
  z-index: 1055; /* [2] */
}
.readField{
  background-color:#eee;
}
</style>


<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Approve Trip Plan

      <small>Add Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

      <li class="active"><a href="{{ url('/form-mast-fleet') }}">Logistics</a></li>

      <li class="active"><a href="{{ url('/form-mast-fleet') }}">Approve Vehicle Trip Plan</a></li>

    </ol>

  </section>

  <form id="approveTripMarket">
    @csrf
    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Approve Trip Plan</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-fleet') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Trip Plan</a>

              </div>

              <div class="box-tools pull-right">

                <a href="{{ url('/view-vehicle-planing-mast') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Trip Plan</a>

              </div>

            </div><!-- /.box-header -->

            <div class="box-body">

              <div class="modalspinner hideloaderOnModl"></div>

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Trip No: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <input list="deliveryList" class="form-control" name="trip_no" id="trip_no" value="" placeholder="Enter Trip No" onchange="getTripPlanForAproveEdit()" autocomplete="off" style="border-color: rgb(255, 0, 0);">

                      <datalist id="deliveryList">
                        
                        <option selected="selected" value="">-- Select --</option>

                        <?php foreach($vehicleTripNo as $key) { 

                            $vrNo       = $key->VRNO;
                            $tripHid    = $key->TRIPHID;
                            $SericeCode = $key->SERIES_CODE;
                            $FyYr       = $key->FY_CODE;
                            $getYr      = explode("-",$FyYr);
                            $BgYr       = $getYr[0];
                            $newVrNo    = $BgYr.' '.$SericeCode.' '.$vrNo;
                            $tranDate = date('d-m-Y',strtotime($key->VRDATE));

                        ?>

                          <option value="<?= $newVrNo; ?>~<?= $tripHid;?>" data-xyz="<?= $newVrNo; ?>~<?= $tripHid;?>"><?= $newVrNo ?> - <?= $key->VEHICLE_NO ?> - <?= $tranDate?> - <?= $key->TRANSPORT_CODE ?> ( <?= $key->TRANSPORT_NAME ?> ) - <?= $key->TO_PLACE ?></option>

                        <?php } ?>

                      </datalist>
                      <input type="hidden" id="trip_HeadId" name="upTrip_headId">
                    </div>

                    <small id="emailHelp" class="form-text text-muted"></small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                     Vehicle No: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <input list="vehicleNoList" class="form-control" name="vehicle_no" id="vehicle_noH" value="" placeholder="Enter Vehicle No" onclick="getTripPlanForAproveEdit()" autocomplete="off" >

                      <datalist id="vehicleNoList">
                        
                        @foreach ($vehicleTripNo as $key)

                          <option value='<?php echo $key->VEHICLE_NO?>' data-xyz ="<?php echo $key->VEHICLE_NO; ?>~<?php echo $key->TRIPHID; ?>" ><?php echo $key->VEHICLE_NO; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted"></small>

                  </div><!-- /.form-group -->

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
                      <input list="seriesList1"  id="series_code" name="series_code" class="form-control  pull-left" value="" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">


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

                        <input type="text" class="form-control" name="series_name" value="" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

                      </div>

                  </div>
                  
                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Vr No: </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                    

                      <input type="text" class="form-control" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                   </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->

              </div>
                <!-- /.row -->

              <div class="row">
            
                <div class="col-md-2" style="width: 192px;">
                  <div class="form-group">
                     <label>
                      &nbsp;
                    
                    </label>
                    <div class="input-group">

                      <input type="radio" class="optionsRadios1" name="do_type" value="With DO" checked="">&nbsp;&nbsp;<span style="font-weight: 700 !important;font-size: 12px !important;">With DO.</span> &nbsp;&nbsp;

                      <input type="radio" class="optionsRadios1" name="do_type" id="doublepoint" value="Without DO" >&nbsp;&nbsp<span style="font-weight: 700 !important;font-size: 12px !important;">Without DO.</span>

                    </div>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-2 withDo">

                  <div class="form-group">

                    <label>Customer Code : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="" placeholder="Select Customer" readonly="" 
                       onchange="getDoDetailsByCust()" autocomplete="off"> 

                        <datalist id="AccountList">

                        </datalist>

                      </div>

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

              </div> <!-- row -->

            </div><!-- /.box-body -->
          
          </div>

        </div>

      </div>

    </section>

    <section class="content" style="margin-top: -10%;">

      <div class="row">

        <div class="col-sm-12">

          <ul class="nav nav-tabs">
            <li class="active"  style="float: none !important;">
              <a href="#tab1info" id="basicInfo" data-toggle="tab" style='line-height:0.5'><b>Item/DO Details</b></a>
            </li>
          </ul>

          <div class="box box-primary Custom-Box">

            <div class="box-body">

              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbleBodyData">
                  
                </table>
                
              </div>
              
            </div>

          </div>
          
        </div>

      </div>
      
    </section>

    <section class="content" style="margin-top: -10%;">

      <div class="row">

        <div class="col-sm-12">

          <ul class="nav nav-tabs">
            <li class="active"  style="float: none !important;">
              <a href="#tab1info" id="basicInfo" data-toggle="tab" style="line-height:0.5;"><b>Freight Details</b></a>
            </li>
          </ul>

          <div class="box box-warning Custom-Box">
         
            <div class="box-body">

              <div class="row">
            
                <div class="col-md-2">

                  <div class="form-group">

                    <label>Plant Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon" style="padding: 1px 7px;">
                           <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                         </span>
                        <?php $plcount = count($plant_list); ?>
                        <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>"  autocomplete="off" onchange="PlantCode()">

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

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Plant Name : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" name="plant_name" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME;}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

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
                        <input type="text"  id="profitctrId" name="pfct_code" class="form-control  pull-left" placeholder="Select Profit Center Code"  readonly >


                      </div>

                    <small id="profit_center_err" style="color: red;"> </small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Profit Center Name : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" name="pfct_name" id="pfctName" placeholder="Enter Profit Center Name" readonly>

                      </div>

                  </div>
                  
                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>From Place: <span class="required-field"></span></label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input list="fromplaceList" class="form-control" name="from_place" id="from_place"  value="" placeholder="Enter From Place" autocomplete="off"/>

                        <datalist id="fromplaceList">

                          <?php foreach ($area_list as $key) { ?>

                            <option value="<?= $key->CITY_NAME ?>" data-xyz="<?= $key->CITY_CODE ?>"><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option>

                          <?php } ?>
                          
                        </datalist>

                    </div>
                    <input type="hidden" name="" id="routeCode">
                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('from_place', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div><!-- /.form-group -->

                </div>
                          
              </div>

              <div class="row">
                
                <div class="col-md-2">

                  <div class="form-group">

                    <label>To Place: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <input list="headtoplaceList" class="form-control" name="head_toplace" id="head_toplace"  value="" placeholder="Enter To Place" autocomplete="off" readonly/>

                      <datalist id="headtoplaceList">

                        <?php foreach ($area_list as $key) { ?>

                          <option value="<?= $key->CITY_NAME ?>" data-xyz="<?= $key->CITY_CODE ?>"><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option>

                        <?php } ?>
                        
                        
                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('head_toplace', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>
                  <!-- /.form-group -->

                </div>

                <div class="col-md-1">

                  <div class="form-group">

                    <label>Trip Days: <span class="required-field"></span></label>

                    <div class="input-group">

                      <input type="text" class="form-control" name="trip_day" id="trip_day"  value="" placeholder="Enter Trip Days" autocomplete="off">

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('trip_day', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Off Days: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-car"></i></span>

                      <input list="offdaysList" class="form-control" name="off_days" id="off_days"  value="" placeholder="Enter Off Days" autocomplete="off">

                      <datalist id="offdaysList">
                        <option value="NA">NA</option>
                        <option value="SUNDAY">SUNDAY</option>
                        <option value="MONDAY">MONDAY</option>
                        <option value="TUESDAY">TUESDAY</option>
                        <option value="WEDNESDAY">WEDNESDAY</option>
                        <option value="THURSDAY">THURSDAY</option>
                        <option value="FRIDAY">FRIDAY</option>
                        <option value="SATURDAY">SATURDAY</option>
                      </datalist>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('transporter', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Vehicle No : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                      <input list="vehicleList" class="form-control" name="vehicle_no" id="vehicle_no" value="" placeholder="Enter Vehicle No" maxlength="13" oninput="getvehicleOwner();"  autocomplete="off" >

                        <datalist id="vehicleList">
                          
                          <?php foreach ($vehicle_list as $key) { ?>
                            
                          <option value="<?= $key->TRUCK_NO ?>" data-xyz="<?= $key->TRUCK_NO ?>"><?= $key->TRUCK_NO ?> - <?= $key->OWNER ?></option>

                          <?php   } ?>

                        </datalist>
                       
                    </div>
                    <small id="vehicleErr1msg" style="color:red;"></small>
                    <small id="vehicleRemarkmsg" style="color:red;"></small>
                    <div class="custom-select">
                        <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                      
                        </div>  
                    </div>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Vehicle Owner: <span class="required-field" id="compn_req"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                      <input list="ownerList" class="form-control" name="vehicle_owner"  placeholder="Enter Vehicle Owner" id="vehicle_owner" autocomplete="off" />

                      <datalist id="ownerList">

                      </datalist>
                       
                    </div><br>

                    <small id="vownererr" style="color: red;"></small>

                  </div>
                  <!-- /.form-group -->

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Vehicle Type: <span class="required-field" id="compn_req"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                      <input list="vehicleTypeList" class="form-control" name="vehicle_type"  placeholder="Enter Vehicle Owner" id="vehicle_type" autocomplete="off"  oninput="getfsoRate();"/>

                     <datalist id="vehicleTypeList">

                         <?php foreach($freightType_list as $key) { ?>

                          <option value="<?= $key->FREIGHTTYPE_NAME ?>" data-xyz="<?= $key->FREIGHTTYPE_CODE ?>"><?= $key->FREIGHTTYPE_CODE ?> - <?= $key->FREIGHTTYPE_NAME ?></option>

                         <?php } ?>
                                        
                      </datalist>

                    </div><br>

                    <input type="hidden" id="vehicleType_name" name="vehicleType_name" value="" />
                    <input type="hidden" id="whee_type_code" name="whee_type_code" value="" />

                    <small id="vownererr" style="color: red;"></small>

                  </div> <!-- /.form-group -->

                </div>

              </div>

              <div class="row">

                 <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Wheel Type: 

                                    <span class="required-field" id="compn_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="wheelTypeList" class="form-control" name="whee_type_name"  placeholder="Enter Vehicle Owner" id="whee_type_name" autocomplete="off"/>



                                      <datalist id="wheelTypeList">

                                        <?php foreach($wheel_list as $key) { ?>

                                        <option value="<?= $key->WHEEL_NAME ?>" data-xyz="<?= $key->WHEEL_CODE ?>"><?= $key->WHEEL_CODE ?> - <?= $key->WHEEL_NAME ?></option>

                                        <?php } ?>
                                        
                                      </datalist>
                                     
                                     
                                  </div><br>

                                 
                                   <small id="vownererr" style="color: red;"></small>

                                </div>

                                

                                <!-- /.form-group -->

                              </div>

                              <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Min Guarantee: 

                                    <span class="required-field" id="compn_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="minList" class="form-control" name="min_gurrentee"  placeholder="Enter Min Guarantee" id="min_gurrentee" autocomplete="off"/>

                                      <datalist id="minList">
                                        <?php foreach($freightType_list as $key) { ?>

                                        <option value="<?= $key->FREIGHTTYPE_NAME ?>" data-xyz="<?= $key->FREIGHTTYPE_CODE ?>"><?= $key->FREIGHTTYPE_CODE ?> - <?= $key->FREIGHTTYPE_NAME ?></option>

                                        <?php } ?>
                                        
                                      </datalist>
                                     
                                    
                                  </div><br>

                                 
                                   <small id="vownererr" style="color: red;"></small>

                                </div>

                                

                                <!-- /.form-group -->

                              </div>

                  
                <div class="col-md-2">

                  <div class="form-group">

                    <label>Vendor/Agent Code: <span class="required-field hideclass"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-car"></i></span>

                      <input list="transportList" class="form-control" name="transporter_code"  value="" id="transporter_code" placeholder="Enter Transporter" autocomplete="off" onchange="getRate()" readonly="">

                      <datalist id="transportList">

                        <?php foreach ($transport_list as $key) { ?>
                          
                          <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> [<?= $key->ACC_NAME ?>]</option>

                        <?php } ?>

                         <option value="">--SELECT--</option>
                        
                      </datalist>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('transporter_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Transporter Name: <span class="required-field hideclass"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-car"></i></span>

                      <input type="text" class="form-control" name="transporter_name" id="transporter_name"  value="" placeholder="Enter Transporter" autocomplete="off" readonly>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('transporter', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Purchase Freight Order : </label>

                    <div class="input-group">

                      <span class="input-group-addon">
                        <i class="fa fa-caret-right"></i>
                      </span>

                      <input list="fpoList" name="fright_order" class="form-control" value="" id="fright_order" placeholder="Enter Fright Order" autocomplete="off" onchange="getRateOfPurchaseFreight();" readonly>

                      <datalist id="fpoList">
                        <?php foreach ($fpo_list as $key) {
                            $vrNo = $key->VRNO;
                            $SericeCode = $key->SERIES_CODE;
                            $FyYr = $key->FY_CODE;
                            $getYr = explode("-",$FyYr);
                            $BgYr = $getYr[0];
                            $newVrNo = $BgYr.' '.$SericeCode.' '.$vrNo;
                         ?>
                        
                          <option value="<?= $newVrNo ?>" data-xyz="<?= $newVrNo ?>"><?= $newVrNo ?></option>

                        <?php  } ?>
                      </datalist>

                      <input type="hidden" name="vehicleId" value="">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('fright_order', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-2">

                  <div class="form-group">
                    <label> Freight Qty :  <span class="required-field hideclass"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon">
                        <i class="fa fa-caret-right"></i>
                      </span>

                      <input type="text" name="freight_qty"  id="freight_qty" class="form-control" placeholder="Enter Freight Qty" autocomplete="off" oninput="chnageadvRate()" readonly="">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('freight_qty', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div><!-- /.form-group -->

                </div>
                  
                

              </div>

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Rate : <span class="required-field hideclass"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon">

                        <i class="fa fa-caret-right"></i>

                      </span>

                      <input type="text" name="rate"  id="rate" class="form-control" placeholder="Enter Rate" autocomplete="off" oninput="chnageadvRate()" readonly="">

                      <input type="hidden" name="prevRate" id="prevRate">
                      <input type="hidden" name="mfprate" id="mfprate">
                      <input type="hidden" name="rate_basis" id="rate_basis">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div><!-- /.form-group -->

                </div>
              
                <div class="col-md-2">

                  <div class="form-group">

                    <label>Amount :  <span class="required-field hideclass"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon">
                        <i class="fa fa-caret-right"></i>
                      </span>

                      <input type="text" name="amount"  id="amount" class="form-control" placeholder="Enter Amount" autocomplete="off" oninput="chnageadvRate()" readonly="">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Payment Mode : <span class="required-field hideclass"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon">
                        <i class="fa fa-caret-right"></i>
                      </span>

                      <input list="paymentList" name="payment_mode"  id="payment_mode" class="form-control" placeholder="Enter Payment Mode" autocomplete="off" readonly="">

                      <datalist id="paymentList">
                          <option value="UPI PAYMENT" data-xyz="UPI PAYMENT">UPI PAYMENT</option>
                          <option value="RTGS" data-xyz="RTGS">RTGS</option>
                          <option value="NEFT" data-xyz="NEFT">NEFT</option>
                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Adv. Type : <span class="required-field hideclass"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                      <input list="typeList" class="form-control" name="adv_type" id="adv_type"  value="" placeholder="Select Adv Type" autocomplete="off" onchange="advanceType();" readonly=""/>

                      <datalist id="typeList">

                        <option value="Lumsum">Lumsum</option>
                        <option value="Percent">Percent</option>
                        <option value="Qty">Qty</option>
                        
                      </datalist>
                      
                    </div>
                    <input type="hidden" id="advtype" name="advtype" value="">

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Adv. Rate:<span class="required-field hideclass" id="compc_req"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                      <input type="text" class="form-control" name="adv_rate" id="adv_rate"  value="" oninput="chnageadvRate();" placeholder="Enter Adv Rate"  autocomplete="off" readonly=""/>

                      <input type="hidden" name="advcal_rate" id="advcal_rate">
                      <input type="hidden" name="advrate" id="advrate" value="">

                    </div>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Adv. Amount : <span class="required-field hideclass"></span></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-building"></i></span>
                      <input type="text" class="form-control" name="adv_amount"  placeholder="Enter Adv Amount" id="adv_amount"  autocomplete="off" readonly="" />
                      <input type="hidden" id="advAmount" value="" name="advAmount">

                    </div><br>

                    <small id="adverr" style="color: red;"></small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Trip Expense : <span class="required-field hideclass"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon">
                        <i class="fa fa-caret-right"></i>
                      </span>

                      <input list="expenseList" name="trip_expense"  id="trip_expense" class="form-control" placeholder="Enter Trip Expense" value="YES" autocomplete="off">

                      <datalist id="expenseList">
                        <option value="YES" data-xyz="YES">YES</option>
                        <option value="NO" data-xyz="NO">NO</option>
                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div><!-- /.form-group -->

                </div>


                 <div class="col-md-2">

                          <div class="form-group">

                                      <label>

                                        Vehicle Model : 


                                      </label>

                                            <div class="input-group">

                                                <span class="input-group-addon">

                                                  <i class="fa fa-caret-right"></i>

                                                </span>

                                              <input type="text" name="vehicle_model"  id="vehicle_model" class="form-control" placeholder="Enter Trip Model" autocomplete="off">


                                            </div>

                                      

                              </div>

                    <!-- /.form-group -->

                          </div>

              </div>

              <div class='row'>

                <input type="hidden" name="route_code" id="route_code">
                <input type="hidden" name="route_name" id="route_name">
                
              </div>
              <div id="requiredMsg" style="text-align: center;"></div></br>
              <center><small id="showerrorMsg" style="text-align: center;color:red;"></small></center></br>
              <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
              <p class="text-center">
                <button class="btn btn-success btn-sm" type="button" id="submitdata" onclick="updatetripApproveData(0)" disabled=""><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

                <!-- <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitData(1)" disabled=""><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>-->
              </p>

          </div>

         
        </div>
      </div>
    </div>
  </section>

</form>
</div>




<!-- Modal -->



<div id="advrateModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                 <center> <b> Rate Amount And Advance Amount Are Same .Are You Sure ? </b></center>

                 </div>
                <div class="modal-footer">
                  <center>
                  <button type="button" class="btn btn-secondary" id="submitbtnno">No</button>
                  <button type="button" class="btn btn-primary" id="submitbtnyes">Yes</button>
                  </center>
                </div>
            </div>
        </div>
    </div>



<div id="vehiclemsgModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                 

                 <small id="vehiclemsg"></small>

                 </div>
                <div class="modal-footer">
                  <center>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
                  </center>
                </div>
            </div>
        </div>
    </div>

<div id="vehicleCpctmsgModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                 

                 <small id="vehicleCpctmsg"></small>

                 </div>
                <div class="modal-footer">
                  <center>
                  
                  <button type="button" class="btn btn-primary" data-dismiss="modal">ok</button>
                  </center>
                </div>
            </div>
        </div>
    </div>

    <div id="vehicleErrmsgModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 80%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                 

                <div style="text-align:center;"> <small id="vehicleErrmsg"></small></div>

                 </div>
                <div class="modal-footer">
                  <center>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                  
                  </center>
                </div>
            </div>
        </div>
    </div>

    <div id="doNotmsgModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                 <center> <b> DO Data Not Avilable For This Customer ? </b></center>

                 </div>
                <div class="modal-footer">
                  <center>
                <!--   <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> -->
                  <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                  </center>
                </div>
            </div>
        </div>
    </div>

@include('admin.include.footer')

<script type="text/javascript">

  function getTripPlanForAproveEdit(){

    var tripNo =  $('#trip_no').val();
    console.log('tripNo',tripNo);
  
    var xyz = $('#deliveryList option').filter(function() {

      return this.value == tripNo;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
    console.log('msg',msg);
    if(msg=='No Match'){
        $('#trip_no,#trip_HeadId,#Plant_code,#plantname,#profitctrId,#pfctName,#from_place,#head_toplace,#trip_day,#off_days,#vehicle_no,#vehicle_owner,#vehicle_type,#transporter_code,#transporter_name,#fright_order,#fright_order,#freight_qty,#rate,#amount,#payment_mode,#adv_type,#adv_rate,#adv_amount,#trip_expense,#vehicle_noH,#series_code,#seriesName,#vrseqnum,#account_code,#accountName').val('');
        $('#tbleBodyData').empty();
        $("input[name=do_type][value='With DO']").prop("checked",true);
        $("input[name=do_type]").prop("disabled",false);
        $('#submitdata').prop('disabled',true);
    }else{
        var tripNoSlit = msg.split('~');
        var tripHeadId = tripNoSlit[1]; 
        $('#trip_HeadId').val(tripHeadId);
        $('#submitdata').prop('disabled',false);
    }

    var tblHeadID = $('#trip_HeadId').val();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        url:"{{ url('get-trip-details-from-trip') }}",
        method : "POST",
        type: "JSON",
        data: {tblHeadID: tblHeadID},
        beforeSend: function() {
          console.log('start spinner');
              $('.modalspinner').removeClass('hideloaderOnModl');
        },
        success:function(data){

          var data1 = JSON.parse(data);
          console.log('data1',data1);
          if (data1.response == 'error') {
            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
          }else if(data1.response == 'success'){

            if(data1.data_body == ''){
                
            }else{
              $('#submitdata').prop('disabled',false);
              if(data1.data_body[0].OWNER == 'MARKET'){
                $('#transporter_code,#transporter_name,#fright_order,#freight_qty,#rate,#amount,#payment_mode,#adv_type,#adv_rate,#adv_amount').prop('readonly',false);
              }else if(data1.data_body[0].OWNER == 'SELF'){
                $('#transporter_code,#transporter_name,#fright_order,#freight_qty,#rate,#amount,#payment_mode,#adv_type,#adv_rate,#adv_amount').prop('readonly',true);
              }

              $('#vehicle_noH').val(data1.data_body[0].HVEHICLE_NO);
              $('#vehicle_no').val(data1.data_body[0].HVEHICLE_NO);
              $('#vrseqnum').val(data1.data_body[0].HVRNO);
              $('#series_code').val(data1.data_body[0].HSERIES_CODE);
              $('#seriesName').val(data1.data_body[0].HSERIES_NAME);
              $('#account_code').val(data1.data_body[0].HACCODE);
              $('#accountName').val(data1.data_body[0].HACCNAME);
              $('#Plant_code').val(data1.data_body[0].PLANT_CODE);
              $('#plantname').val(data1.data_body[0].PLANT_NAME);
              $('#profitctrId').val(data1.data_body[0].HPFCTCODE);
              $('#pfctName').val(data1.data_body[0].HPFCTNAME);
              $('#from_place').val(data1.data_body[0].HFROMPLACE);
              $('#head_toplace').val(data1.data_body[0].HTOPLACE);
              $('#routeCode').val(data1.data_body[0].ROUTE_CODE);
              $('#trip_day').val(data1.data_body[0].TRIP_DAY);
              $('#off_days').val(data1.data_body[0].OFF_DAY);
              $('#vehicle_owner').val(data1.data_body[0].OWNER);
              $('#vehicle_type').val(data1.data_body[0].VEHICLETYPE);
              $('#vehicleType_name').val(data1.data_body[0].VEHICLE_TYPE_NAME);
              $('#whee_type_code').val(data1.data_body[0].WHEELTYPE_CODE);
              $('#whee_type_name').val(data1.data_body[0].WHEELTYPE_NAME);
              $('#min_gurrentee').val(data1.data_body[0].MIN_GUARANTEE);
              $('#transporter_code').val(data1.data_body[0].TRANSPORT_CODE);
              $('#transporter_name').val(data1.data_body[0].TRANSPORT_NAME);
              $('#fright_order').val(data1.data_body[0].FPO_NO);
              $('#rate').val(data1.data_body[0].FPO_RATE);
              $('#prevRate').val(data1.data_body[0].FPO_RATE);
              $('#amount').val(data1.data_body[0].AMOUNT);
              $('#payment_mode').val(data1.data_body[0].PAYMENT_MODE);
              $('#adv_type').val(data1.data_body[0].ADV_TYPE);
              $('#adv_rate').val(data1.data_body[0].ADV_RATE);
              $('#adv_amount').val(data1.data_body[0].ADV_AMT);
              $('#trip_expense').val(data1.data_body[0].TRIP_EXPENSE);
              $('#vehicle_model').val(data1.data_body[0].MODEL);

              $('#tbleBodyData').empty();

              var doNumber = data1.data_body[0].DO_NO;

              if((doNumber == '') || (doNumber == null)){

                var headData = "<tr><th style='width: 10px;'> Sr.No.</th><th>CUSTOMER CODE </th><th>CUSTOMER NAME</th><th class='withoutDo'>CONSIGNEE</th><th class='withoutDo'>ADDRESS</th><th class='withoutDo'>TO PLACE</th><th class='withoutDo'>LR NO</th><th class='withoutDo'>LR DATE</th><th>ITEM CODE </th><th>ITEM NAME</th><th>QTY</th><th>AQTY</th></tr>";

                $('#tbleBodyData').append(headData);

                $("input[name=do_type][value='Without DO']").prop("checked",true);
                $("input[name=do_type]").prop("disabled",true);

              }else{

                var headData = "<tr><th style='width: 10px;'> Sr.No.</th><th>CUSTOMER CODE </th><th>CUSTOMER NAME</th><th style='width: 10%;' class='doorderNo'>DORDER NO.</th><th>ITEM CODE </th><th>ITEM NAME</th><th class='withDo'>CP NAME/CP CODE</th><th class='withDo'>SP NAME/SP CODE</th><th class='withDo'>ITEM SLNO</th><th class='withDo'>LR NO</th><th class='withDo'>LR DATE</th><th class='withDo'>TO PLACE</th><th>QTY</th><th>AQTY</th></tr>";

                $('#tbleBodyData').append(headData);

                $("input[name=do_type][value='With DO']").prop("checked",true);
                $("input[name=do_type]").prop("disabled",true);
              }

              var slNo=1;
              var totalqty=0;
              var totalAqty=0;

              $.each(data1.data_body, function(k, getData){

                var doNumChk = getData.DO_NO;
                   totalqty  += parseFloat(getData.QTY);
                   totalAqty  += parseFloat(getData.AQTY);

                if((doNumChk == '') || (doNumChk == null)){

                  var bodyData = "<tr class='useful' id='first_Row'><td class='tdthtablebordr'><span id='snum' style='width: 10px;'>"+slNo+".</span></td>"+
                  "<td class='tdthtablebordr withDo' style='width: 10%;'><input type='text' class='inputboxclr getAccNAme inputwidth readField' value='"+getData.ACC_CODE+"' name='custCode[]' id='custCode"+slNo+"'   placeholder='Customer Code' onchange='getRowDoDetailsByCust("+slNo+")'  autocomplete='off' readonly></td>"+
                  "<td class='tdthtablebordr withDo' style='width: 10%;'><input type='text' class='inputboxclr getAccNAme inputwidth readField'  value='"+getData.ACC_NAME+"' name='custName[]' id='custName"+slNo+"' readonly placeholder='Customer Name'  autocomplete='off' readonly></td>"+
                  "<td class='tdthtablebordr withoutDo' style='width: 10%;'><input type='text' class='inputboxclr inputwidth readField' value='"+getData.CP_CODE+"' id='consignee_wdo"+slNo+"' name='consignee_wdo[]' placeholder='Consinee Code'  onchange='consigneeName("+slNo+")'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/><div style='margin-top:2px;'><input type='text' class='inputboxclr inputwidth readField' name='consineeName_wdo[]' value='"+getData.CP_NAME+"' id='consineeName_wdo"+slNo+"' autocomplete='off' readonly placeholder='Consinee Name' readonly></div></td>"+
                  "<td class='tdthtablebordr withoutDo' style='width: 20%;'><div class='input-group'><input type='text' class='inputboxclr readField' style='width: 139px;' id='consigneeadd"+slNo+"' value=''  name='consigneeadd[]' onchange='getcityName("+slNo+")'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                  "<td class='tdthtablebordr tooltips withoutDo' style='width: 20%;'><input list='toplaceList_wdo"+slNo+"' class='inputboxclr inputwidth readField'  id='to_place_wdo"+slNo+"' name='to_place_wdo[]' value='"+getData.TO_PLACE+"' autocomplete='off' oninput='this.value = this.value.toUpperCase()' onchange='toPlaceWDo("+slNo+");'  placeholder='Select To Place' readonly/></td>"+
                  "<td class='tdthtablebordr tooltips withoutDo' style='width: 20%;'><input type='text' class='inputboxclr inputwidth readField'  id='lrnowdo"+slNo+"' name='lrnowdo[]' value='"+getData.LR_NO+"' autocomplete='off' oninput='this.value = this.value.toUpperCase()' placeholder='Enter LR No' readonly/></td>"+
                  "<td class='tdthtablebordr tooltips withoutDo' style='width: 20%;'><input type='text' class='inputboxclr inputwidth readField'  id='lrdatewdo"+slNo+"' name='lrdatewdo[]' value='"+getData.LR_DATE+"' autocomplete='off' oninput='this.value = this.value.toUpperCase()' placeholder='Enter LR DATE' readonly/></td>"+
                  "<td class='tdthtablebordr tooltips' style='width: 15%;'><input type='text' class='inputboxclr inputwidth readField'  id='ItemCodeId"+slNo+"' name='item_code[]'  oninput='this.value = this.value.toUpperCase()' readonly value='"+getData.ITEM_CODE+"' onchange='getItemQty("+slNo+")' autocomplete='off' placeholder='Select Item Code' /></td>"+
                  "<td class='tdthtablebordr tooltips' style='width: 20%;'><input type='text' class='inputboxclr inputwidth getAccNAme readField' id='Item_Name_id"+slNo+"' name='item_name[]' value='"+getData.ITEM_NAME+"' readonly placeholder='Enter Item Name' readonly /></br><textarea type='text' class='inputboxclr inputwidth getAccNAme readField' style='height: 20px;' id='remark"+slNo+"' readonly name='remark[]' placeholder='Enter Description' row='0' autocomplete='off'></textarea></td>"+
                  "<td class='tdthtablebordr' style='width: 5%;'><div style='display: inline-flex;border: none;'><input type='text' value='"+getData.QTY+"' readonly class='dr_amount inputboxclr inputwidth getqtytotal quantityC moneyformate qtyclc rightcontent readField'  id='qty"+slNo+"' name='qty[]' oninput='Getqunatity("+slNo+")' value='' style='width: 65px;'  placeholder='Enter Qty' autocomplete='off'  /><input type='text' name='unit_M[]' readonly value='"+getData.UM+"' style='width: 40px;' id='UnitM1' class='inputboxclr AddM readField' autocomplete='off'></div></td>"+
                  "<td class='tdthtablebordr' style='width: 5%;'><div style='display: inline-flex;border: none;'><input type='text' class='dr_amount inputboxclr  inputwidth getqtytotal quantityC moneyformate qtyclc rightcontent readField' readonly value='"+getData.AQTY+"' id='Aqty"+slNo+"' name='Aqty[]' oninput='Getqunatity("+slNo+")' style='width: 65px;' value=''  placeholder='Enter Qty' autocomplete='off'  /><input type='text' name='unit_AUM[]' style='width: 40px;' value='"+getData.AUM+"' id='UnitAUM"+slNo+"' readonly class='inputboxclr  AddM readField' autocomplete='off'></div></td></tr>";

                    $('#tbleBodyData').append(bodyData);

                }else{

                  var bodyData = "<tr class='useful' id='first_Row'><td class='tdthtablebordr'><span id='snum' style='width: 10px;'>"+slNo+".</span></td>"+
                  "<td class='tdthtablebordr withDo' style='width: 10%;'><input type='text' class='inputboxclr getAccNAme inputwidth readField' value='"+getData.ACC_CODE+"' name='custCode[]' id='custCode"+slNo+"'   placeholder='Customer Code' onchange='getRowDoDetailsByCust("+slNo+")'  autocomplete='off' readonly></td>"+
                  "<td class='tdthtablebordr withDo' style='width: 10%;'><input type='text' class='inputboxclr getAccNAme inputwidth readField'  value='"+getData.ACC_NAME+"' name='custName[]' id='custName"+slNo+"' readonly placeholder='Customer Name'  autocomplete='off'></td>"+
                  "<td class='tdthtablebordr doorderNo' style='width: 10%;'><input type='text' class='inputboxclr getAccNAme inputwidth readField' value='"+getData.DO_NO+"' name='do_no[]' id='do_no1' placeholder='Select Do No' readonly onchange='getDoDetials(1)' oninput='donumber(1)' autocomplete='off'></td>"+
                  "<td class='tdthtablebordr tooltips' style='width: 15%;'><input type='text' class='inputboxclr inputwidth readField'  id='ItemCodeId"+slNo+"' name='item_code[]'   oninput='this.value = this.value.toUpperCase()' readonly value='"+getData.ITEM_CODE+"' onchange='getItemQty("+slNo+")' autocomplete='off' placeholder='Select Item Code' /></td>"+
                  "<td class='tdthtablebordr tooltips' style='width: 20%;'><input type='text' class='inputboxclr inputwidth getAccNAme readField' id='Item_Name_id"+slNo+"' name='item_name[]' value='"+getData.ITEM_NAME+"' readonly placeholder='Enter Item Name' readonly /></br><textarea type='text' class='inputboxclr inputwidth getAccNAme readField' style='height: 20px;' id='remark"+slNo+"' readonly name='remark[]' placeholder='Enter Description' row='0' autocomplete='off'></textarea></td>"+
                  "<td class='tdthtablebordr withDo' style='width: 15%;'><input type='text' class='inputboxclr inputwidth readField' readonly id='consignee"+slNo+"' name='consignee[]' placeholder='Consinee Code' value='"+getData.CP_CODE+"' onchange='consigneeName("+slNo+")'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><div style='margin-top:2px;'><input type='text' value='"+getData.CP_NAME+"' class='inputboxclr inputwidth readField' readonly name='consineeName[]' id='consineeName"+slNo+"' autocomplete='off' readonly placeholder='Consinee Name'></div></td>"+
                  "<td class='tdthtablebordr withDo' style='width: 15%;'><input type='text' class='inputboxclr inputwidth readField' readonly value='"+getData.SP_CODE+"' id='sp_code"+slNo+"' name='sp_code[]' placeholder='Sp Code'  onchange='getspName("+slNo+")'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><div style='margin-top:2px;'><input type='text' class='inputboxclr inputwidth readField' name='spName[]' id='spName"+slNo+"' readonly value='"+getData.SP_NAME+"' autocomplete='off' readonly ></div></td>"+
                  "<td class='tdthtablebordr withDo' style='width: 15%;'><input type='text' class='inputboxclr inputwidth rightcontent readField' readonly value='"+getData.SLNO+"' id='item_slno"+slNo+"' style='width: 70px;' name='item_slno[]' placeholder='Item Slno' oninput='this.value = this.value.toUpperCase()' autocomplete='off' /></td>"+
                  "<td class='tdthtablebordr withDo' style='width: 15%;'><input type='text' class='inputboxclr inputwidth rightcontent readField' readonly value='"+getData.LR_NO+"' id='lrNo"+slNo+"' style='width: 70px;' name='lrno[]' placeholder='LR No' oninput='this.value = this.value.toUpperCase()' autocomplete='off' /></td>"+
                  "<td class='tdthtablebordr withDo' style='width: 15%;'><input type='text' class='inputboxclr inputwidth rightcontent readField' readonly value='"+getData.LR_DATE+"' id='lrDate"+slNo+"' style='width: 70px;' name='lrDate[]' placeholder='LR Date' oninput='this.value = this.value.toUpperCase()' autocomplete='off' /></td>"+
                  "<td class='tdthtablebordr tooltips withDo' style='width: 15%;'><input type='text' class='inputboxclr inputwidth readField' value='"+getData.TO_PLACE+"' id='to_place"+slNo+"' name='to_place[]' readonly onchange='toPlaceW("+slNo+");' autocomplete='off' oninput='this.value = this.value.toUpperCase()'  placeholder='Select To Place'  /></td>"+
                  "<td class='tdthtablebordr' style='width: 5%;'><div style='display: inline-flex;border: none;'><input type='text' value='"+getData.QTY+"' readonly class='dr_amount inputboxclr inputwidth getqtytotal quantityC moneyformate qtyclc rightcontent readField'  id='qty"+slNo+"' name='qty[]' oninput='Getqunatity("+slNo+")' value='' style='width: 65px;'  placeholder='Enter Qty' autocomplete='off'  /><input type='text' name='unit_M[]' readonly value='"+getData.UM+"' style='width: 40px;' id='UnitM1' class='inputboxclr AddM readField' autocomplete='off'></div></td>"+
                  "<td class='tdthtablebordr' style='width: 5%;'><div style='display: inline-flex;border: none;'><input type='text' class='dr_amount inputboxclr  inputwidth getqtytotal quantityC moneyformate qtyclc rightcontent readField' readonly value='"+getData.AQTY+"' id='Aqty"+slNo+"' name='Aqty[]' oninput='Getqunatity("+slNo+")' style='width: 65px;' value=''  placeholder='Enter Qty' autocomplete='off'  /><input type='text' name='unit_AUM[]' style='width: 40px;' value='"+getData.AUM+"' id='UnitAUM"+slNo+"' readonly class='inputboxclr  AddM readField' autocomplete='off'></div></td></tr>";

                    $('#tbleBodyData').append(bodyData);

                }


                /*if(data1.data_body[0].OWNER == 'DUMP'){
                  $('#vehicle_no').prop('readonly',false);
                }*/
                
              slNo++;});

                      var footerData = '<tr><td colspan="12"><span style="float:right;font-weight:bold">Total : </span></td><td><input class="debitcreditbox inputboxclr" type="text" name="TotlDebit" id="basicTotal" value="'+totalqty.toFixed(3)+'" readonly="" style="width: 100%;"></td><td><input class="debitcreditbox inputboxclr" type="text" name="TotlDebit" id="basicTotal" value="'+totalAqty.toFixed(3)+'" readonly="" style="width: 100%;"></td></tr>';

                      $('#tbleBodyData').append(footerData);

                     
                       var freightqty = data1.data_body[0].FREIGHT_QTY;

                      if(freightqty){

                         $('#freight_qty').val(freightqty);

                      }else{

                        $('#freight_qty').val(totalqty.toFixed(3));
                      }

            } /* /.codn*/

              

          } /* /.success codn*/

           

        }, /* /. success fun*/
        complete: function() {
           console.log('end spinner');
             $('.modalspinner').addClass('hideloaderOnModl');
        },

    });


  }

  $(document).ready(function(){

    $("#vehicle_no").bind('change', function () {

      var vehicleNo =  $(this).val();
  
      var xyz = $('#vehicleNoList option').filter(function() {

        return this.value == vehicleNo;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         // $(this).val('');
      }else{
          var splitData = msg.split('~');
          var headID    = splitData[1];
          getTripDetialsFromTrip(headID);
      }

    });

  });

  function getTripDetialsFromTrip(tblHeadID){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        url:"{{ url('get-trip-details-from-trip') }}",
        method : "POST",
        type: "JSON",
        data: {tblHeadID: tblHeadID},

        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {
            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
          }else if(data1.response == 'success'){

            if(data1.data == ''){
                
            }else{
              console.log(data1.data);
            }

          }

        }

    });

  }

  $( window ).on( "load", function() {
        
        var vr_date = $('#vr_date').val();

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var Plant_code =  $('#Plant_code').val();

      //  alert(Plant_code);
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

  function funGrossWeight(){

   var tareWeight = $('#tare_weight').val();
   var grossWeight = $('#gross_weight').val();
   if(tareWeight == ''){

    $('#grossWeiErr').html('*Please Enter Tare weight').css('color','red');
    $('#gross_weight').val('');
     return false;
   }else{
    $('#grossWeiErr').html('');
   }

   if(parseInt(tareWeight) != '' || parseInt(grossWeight) == '' ){
    $('#load_capacity').val('0');
   }
  
  if(parseInt(grossWeight) <= parseInt(tareWeight)){

     $('#grossWeiErr').html('*Please Enter Gross weight greater than Tare weight').css('color','red');
     $('#load_capacity').val('0');
     return false;

   }else{
     
     $loadCapacity = parseInt(grossWeight) - parseInt(tareWeight);

     $('#grossWeiErr').html('');
     $('#load_capacity').val($loadCapacity);
     
   }

  }

  function fununderload_cap(){

    var load_cap = $('#load_capacity').val();
    var underLoad_cap = $('#underload_capacity').val();

    if(parseInt(underLoad_cap) >= parseInt(load_cap)){

      $('#underload_capErr').html('*Please Enter Underload Capacity is less than Load Capacity').css('color','red');
      return false;
    }else{
      $('#underload_capErr').html('');

    }

  }

  function funemptyAvg(){
    console.log('avg');

    var loadAvg = $('#load_average').val();
    var underloadAvg = $('#underload_average').val();
    var emptyAvg = $('#empty_average').val();

    if(parseInt(emptyAvg) < parseInt(loadAvg) || parseInt(emptyAvg) < parseInt(underloadAvg)){
      console.log('true');
       $('#emptyAvgErr').html('Plase Enter Empty Average is Greater than load Average and Usnderload Average').css('color','red');
       return false;
    }else{
       $('#emptyAvgErr').html('');
    }

  }

  function ownerselect(val){

    if(val=='MARKET'){

      $("#compcodereq").hide();
      $("#compnamereq").hide();
      $("#cost_req").hide();

    }else{
      $("#compcodereq").show();
      $("#compnamereq").show();
      $("#cost_req").show();
      $("#ownerNameR").show();
    }



  }

function toPlaceWDo(num){

    var toPlace_do = $("#to_place_wdo"+num).val();

      if(toPlace_do){

        $("#head_toplace").val(toPlace_do);
      }else{

         $("#head_toplace").val('');
      }



}

function toPlaceW(num){

    var toPlace = $("#to_place"+num).val();

      if(toPlace){

        $("#head_toplace").val(toPlace);
      }else{

         $("#head_toplace").val('');
      }



}

$("#vehicle_owner").bind('change', function () {

  var VehicleOwner =  $(this).val();

  var Vehicle_No =  $("#vehicle_no").val();

 

  if(VehicleOwner){

    if(VehicleOwner=='DUMP' || VehicleOwner=='SELF'){

    $("#transporter_code,#transporter_name,#fright_order,#rate,#amount,#payment_mode,#adv_type,#adv_rate").prop('readonly',true);

    $("#submitdata").prop("disabled",false);

    }else{

      //$("#transporter_code").prop('readonly',false);

      $("#submitdata").prop("disabled",true);
    }

  }else{
    $("#submitdata").prop('disabled',true);
  }

  



});

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
      $('#series_code').css('border-color','#d2d6de');
        
    $('#series_code').css('border-color','#ff0000').focus();

      $("#account_code").prop('readonly',true);
      $("#custCode1").prop('readonly',true);
  }else{
    $('#seriesName').val(msg);
     document.getElementById("series_code_errr").innerHTML = '';
     var sers_code = $('#series_code').val();
     $('#getSeriesCode').val(sers_code);
     $('#getSeriesName').val(msg);
     $('#series_code').css('border-color','#d2d6de');

     $("#account_code").prop('readonly',false);
     $("#custCode1").prop('readonly',false);
       
  }

   //objvalidtn.checkBlankFieldValidation();

});

  function addFunAdvRate(){
    

     var adv_type = $('#adv_type').val();
     var adv_rate = $('#adv_rate').val();
     var adv_amount = $('#adv_amount').val();

     if(adv_type){

      $('#advtype').val(adv_type);

     }
     if(adv_rate){
      $('#advrate').val(adv_rate);

     }
     if(adv_amount){
       $('#advAmount').val(adv_amount);

     }else{

     }
    $("#ratevalueModal").modal('hide');
  }

  $(document).ready(function(){
   $('#truck_no').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var truck_no = $('#truck_no').val();

        if(truck_no == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-truck-no') }}",

             method : "POST",

             type: "JSON",

             data: {truck_no: truck_no},

             success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                       var objcity = data1.data;
                       $('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<small class="custom-option">'+
                            objcity.truck_no+'</small><br>');
                         });
                        
                  }
             }

          });
       }

    });

    $("body").click(function() {
        $("#showSearchCodeList").hide("fast");
    });


    $("#submitbtnno").on('click', function() {

      $('#advrateModal').modal('toggle');
      $('#submitdata').prop('disabled',true);

    });

     $("#submitbtnyes").on('click', function() {

      $('#advrateModal').modal('toggle');
      $('#submitdata').prop('disabled',false);

    });
    

  });


</script>

<script type="text/javascript">
  
  $("#route_code").bind('change', function () {
  var val =  $(this).val();
  var xyz = $('#routeList option').filter(function() {

    return this.value == val;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';


  if(msg=='No Match'){
     $(this).val('');
    
      $('#route_name').val('');
  }else{
   
     $('#route_name').val(msg);
     $('#getRouteCode').val(val);
     $('#getRouteName').val(msg);
  }

});
</script>


<script type="text/javascript">
  
   function getRouteLocation() {
    
    var route_code = $("#route_code").val();

    if(route_code){

      $("#dono1").prop('readonly',false);

    }else{

      $("#dono1").prop('readonly',true);

    }

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });


      $.ajax({

            url:"{{ url('get-route-for-plan-by-route-code') }}",

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

                    $("#route_name").val(data1.data.ROUTE_NAME);
                    $("#from_place").val(data1.data.FROM_PLACE);
                    $("#to_place").val(data1.data.TO_PLACE);
                    $("#trip_day").val(data1.data.TRIP_DAYS);
                    $("#off_days").val(data1.data.HOLIDAYS);
                  


                }

            }

          });



  }
</script>

<script type="text/javascript">
  $("#Plant_code").bind('change', function () {
  var Plantcode =  $(this).val();
  var xyz = $('#PlantcodeList option').filter(function() {

    return this.value == Plantcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

   $('#appndplantbtn').empty();
    $('#planticon').show();

  if(msg=='No Match'){
     $(this).val('');
     $('#plantname').val(''); 
      document.getElementById("plant_err").innerHTML = 'The Plant code field is required.';
     
      $('#getPlantCode').val('');
      $('#profitctrId').val('');
      $('#pfctName').val('');
  }else{
     document.getElementById("plant_err").innerHTML = '';
     $('#plantname').val(msg);
     var plntCode = $('#Plant_code').val();

     $('#account_code').prop('readonly',false);
     //alert(msg);
     $('#getPlantCode').val(plntCode);
     $('#getPlantName').val(msg);
     $('#planticon').hide();

     $('#appndplantbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="requisition.getplantdata(Plantdetailsurl)" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
    
  }
  
   //objvalidtn.checkBlankFieldValidation();

});
</script>

<script type="text/javascript">
  function getfsoRate(){

      var vehicle_no = $("#vehicle_no").val();
      var vr_date    = $("#vr_date").val();
      var account_code    = $("#account_code").val();
      var plant_code    = $("#Plant_code").val();
      var vehicle_type    = $("#vehicle_type").val();
      var vehicleType_name    = $("#vehicleType_name").val();
      var toplace    = $("#head_toplace").val();

      var vehicle_owner    = $("#vehicle_owner").val();

      console.log('vehicle_type',vehicle_type);

      console.log('vehicleType_name',vehicleType_name);

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });


      $.ajax({

          url:"{{ url('get-fso_rate-by-trip') }}",

          method : "POST",

          type: "JSON",

          data: {vehicle_no: vehicle_no,vehicle_type:vehicle_type,vr_date:vr_date,account_code:account_code,plant_code:plant_code,toplace:toplace,vehicle_owner:vehicle_owner},

          success:function(data){

            console.log(data);

            var data1 = JSON.parse(data);

       
              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                   console.log(data1.data);


                  if(data1.data=='' || data1.data==null){

                      $("#sale_rate").val('0.00');
                      $("#fsohid").val('0.00');
                      $("#fsobid").val('0.00');
                      $("#refNo").val('');
                   }else{
                     // alert(data1.data[0].RATE);
                      $("#sale_rate").val(data1.data[0].RATE);
                      $("#fsohid").val(data1.data[0].FSOHID);
                      $("#fsobid").val(data1.data[0].FSOBID);
                      $("#refNo").val(data1.data[0].REF_NO);
                   }

                   console.log('length',data1.vehicle_data.length);

                   var dataCount = data1.vehicle_data.length;

                   if(data1.vehicle_data=='' || data1.vehicle_data==null){

                    $("#whee_type_code").val('');
                    $("#whee_type_name").val('');
                    $("#min_gurrentee").val('');

                  }else{

                    if(dataCount > 1){

                        console.log('vehicle_data',data1.vehicle_data);

                     $("#wheelTypeList").empty();

                      $.each(data1.vehicle_data, function(k, getData){


                        $("#wheelTypeList").append($('<option>',{

                          value:getData.WHEEL_NAME,

                          'data-xyz':getData.WHEEL_NAME,
                          text:getData.WHEEL_NAME


                        }));

                      })

                    }else{

                      $("#whee_type_code").val(data1.vehicle_data[0].WHEEL_TYPE);
                      $("#whee_type_name").val(data1.vehicle_data[0].WHEEL_TYPE_NAME);
                      $("#min_gurrentee").val(data1.vehicle_data[0].MIN_GUARANTEE);

                      }

                    

                  }

              }

          }

    });



  }
</script>




<script type="text/javascript">
  
  function getvehicleOwner(){

  var vehicle_no = $("#vehicle_no").val();
  var vr_date    = $("#vr_date").val();
  var account_code    = $("#account_code").val();
  var plant_code    = $("#Plant_code").val();
  var from_place = $("#from_place").val();
  var to_place   = $("#head_toplace").val();
  var basicTotal = $("#basicTotal").val();


 

 // var getLength = $("#vehicle_no").attr('maxlength','4');
  var maxlength = vehicle_no.length;




if(maxlength >= '8'){


 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-vehicle-owner-by-vehicle') }}",

          method : "POST",

          type: "JSON",

          data: {vehicle_no: vehicle_no,from_place:from_place,to_place:to_place,vr_date:vr_date,account_code:account_code,plant_code:plant_code},

           beforeSend: function() {
              // console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                $('.modalspinner').addClass('hideloaderOnModl');

                 var owner = new Array();
                    owner[0] = 'MARKET';
                    
                    var options = '';


                    for (var i = 0; i < owner.length; i++) {
                      options += '<option value="' + owner[i] + '" />';
                    }

                    document.getElementById('ownerList').innerHTML = options;
               
              }else if(data1.response == 'success'){

                  /* if(data1.fso_rate=='' || data1.fso_rate==null){

                      $("#sale_rate").val('0.00');
                      $("#fsohid").val('');
                      $("#fsobid").val('');
                   }else{

                      $("#sale_rate").val(data1.fso_rate[0].RATE);
                       $("#fsohid").val(data1.fso_rate[0].FSOHID);
                      $("#fsobid").val(data1.fso_rate[0].FSOBID);
                   }*/

                   if(data1.transporter_data=='' || data1.transporter_data==null){

                       $("#transporter_code").val('');
                      $("#transporter_name").val('');
                   }else{

                      $("#transporter_code").val(data1.transporter_data[0].ACC_CODE);
                      $("#transporter_name").val(data1.transporter_data[0].ACC_NAME);
                   }

                  if(data1.data=='' || data1.data==null){

                    $('.modalspinner').addClass('hideloaderOnModl');
                   
                    var owner = new Array();
                    owner[0] = 'MARKET';
                  
                    var options = '';

                    for (var i = 0; i < owner.length; i++) {
                      options += '<option value="' + owner[i] + '" />';
                    }

                    document.getElementById('ownerList').innerHTML = options;

                    $("#submitdata").prop('disabled',true);

                  }else{

                    

                  var vehicle_owner = data1.data.OWNER;
                  var vehicle_type = data1.data.WHEEL_TYPE;

                  
                  $("#vehicle_owner").val(vehicle_owner);
                  //$("#vehicle_type").val(vehicle_type);
                

                     
                  if(vehicle_owner=='SELF'){

                    var owner = new Array();
                    owner[0] = 'SELF';
                    owner[1] = 'DUMP';

                    var options = '';


                    for (var i = 0; i < owner.length; i++) {
                      options += '<option value="' + owner[i] + '" />';
                    }

                    document.getElementById('ownerList').innerHTML = options;

                     $("#transporter_code,#transporter_name,#fright_order,#rate,#amount,#payment_mode,#adv_type,#adv_rate,#adv_amount,#freight_qty").prop('readonly',true);

                     $("#freight_qty").prop('readonly',false);
                     $("#freight_qty").val(basicTotal);
                     $("#submitdata").prop('disabled',false);
                     $("#submitdatapdf").prop('disabled',false);
                    

                  }else{
                  
                      $("#submitdata").prop('disabled',true);
                      $("#submitdatapdf").prop('disabled',true);

                  }
                  
                  var registraion_date = data1.data.REGD_DATE;
                  
                }


              if(data1.route_data=='' || data1.route_data==null){

                    $('.modalspinner').addClass('hideloaderOnModl');
                    $("#route_code").val('');
                    $("#route_name").val('');

                  }else{

                  var route_code = data1.route_data.ROUTE_CODE;

                  var route_name = data1.route_data.ROUTE_NAME;

                  $("#route_code").val(route_code);
                  $("#route_name").val(route_name);
              }


              /*if(data1.vehicle_trip=='' || data1.vehicle_trip==null){

                }else{

                  var lr_status = data1.vehicle_trip.LR_ACK_STATUS;

                 // alert(lr_status);

                    if(lr_status==0){

                    
                       $("#vehicleRemarkmsg").html('Trip ePOD,Temprory Evocked For One Month');
                     
                    }else{
                      $("#vehicleRemarkmsg").html('');
                     
                    }

                }*/
                   
              if(data1.vehicle_info.response == null){
              
                     $("#vehicleErr1msg").html('<b>Vehicle Not Found</b>');
                      //$("#submitdata").prop('disabled',false);
                    
              }else{

                    $("#vehicleErr1msg").html('');
              
                     var regd_date = data1.vehicle_info.response.regnDate;
                 
                     var cuurnt_date = new Date().toLocaleDateString('fr-CA');


                      var explode1 =   cuurnt_date.split("-");

                      var year1 = explode1[0];


                       var explode2 =   regd_date.split("/");

                      var year2 = explode2[2];

                       var diff_date = year1 - year2;
                            

                       if(diff_date > 10){

                          $("#vehiclemsgModal").modal('show');

                          $("#vehiclemsg").html('<b>Vehicle Is More Than 10 Years Old.Are Sure To Proceed ?</b>');
                       }


                      
                      var gross_weight = data1.vehicle_info.response.gvw;

                      var underload_weight = data1.vehicle_info.response.unldWt;


                      var capct = parseFloat(gross_weight) - parseFloat(underload_weight);

                      var total = parseFloat(capct / 1000);

                      var calculatPercnt = parseFloat(total * 5/100);

                      var fianlValue = calculatPercnt + total;



                     if(fianlValue < basicTotal){

                      $("#vehicleCpctmsgModal").modal('show');

                      $("#vehicleCpctmsg").html('<b>Total Qty Is Greater than Vehicle Capacity </b>');

                      //$("#submitdata").prop('disabled',false);

                    }else{
                     // $("#submitdata").prop('disabled',true);
                     $("#vehicleCpctmsg").html('');
                    }


              }

            }

          },

           complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },

    });

}

}
</script>

<script type="text/javascript">
  $(document).ready(function(){
     $('body').on('click', '#closeModel', function () {
          $('.popover').fadeOut();
    })
  });
</script>

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>


<script type="text/javascript">
  
  
function advanceType(){



     var adv_type = $("#adv_type").val();
     var qty = $("#freight_qty").val();
     var rate = $("#rate").val();

     if(adv_type){

     
      $('#adv_type').css('border-color','#d2d6de');

      if(adv_type=='Lumsum'){

            $("#adv_amount").prop('readonly', false);
            $("#adv_rate").prop('readonly', true);
            $("#compc_req").hide();

          }else{
            $("#adv_amount").prop('readonly', true);
            $("#adv_rate").prop('readonly', false);
            $("#compc_req").show();
          } 

     }else{

         $("#adv_amount").val('');
         $("#adv_rate").val('');
         $('#adv_type').css('border-color','#ff0000').focus();
     }

     

  }
 function chnageadvRate(){

             var adv_rate      = $("#adv_rate").val();
             var adv_type = $("#adv_type").val();
             var qty      = $("#freight_qty").val();
             var amount   = $("#amount").val();

            if(adv_rate){

              $("#submitdata").prop('disabled', false);
              $("#submitdatapdf").prop('disabled', false);

            if(adv_type=='Percent'){

               var calrate     =   $("#advcal_rate").val();

               var advance_amt =parseFloat(amount) * parseFloat(adv_rate) /100;

               if(parseFloat(advance_amt) > parseFloat(amount)){

                $("#adv_amount").val('');
                $("#adverr").html('adv amount should be less than amount');
                $("#submitdata").prop('disabled', true);

               }else{ 

                console.log(advance_amt);
                
                var advanceAmt = Math.round(advance_amt / 1000) * 1000;
                //var amount =roundoffCal.toFixed(2);

                 $("#adv_amount").val(advanceAmt.toFixed(2));
                 $("#adverr").html('');
                 $("#submitdata").prop('disabled', false);
               }

              

            }else if(adv_type=='Qty'){

              var calamt = parseFloat(qty) * parseFloat(adv_rate);

               if(parseFloat(calamt) > parseFloat(amount)){

                $("#adv_amount").val('');
                
                $("#adverr").html('adv amount should be less than amount');
                $("#submitdata").prop('disabled', true);
               }else{

                 $("#adverr").html('');
                 $("#adv_amount").val(calamt.toFixed(2));
                 $("#submitdata").prop('disabled', false);
               }

              //$("#adv_amount").val(calamt);

            }
          }else{

            $("#adv_amount").val('');
            $("#submitdata").prop('disabled', true);
          }

  }
  
$(document).ready(function(){


  $("#adv_amount").on('input', function () { 

     var adv_amount = $(this).val();
     var adv_type = $("#adv_type").val();
     var amount = $("#amount").val();

     if(adv_amount){

      $("#submitdata").prop('disabled', false);
       if(adv_type=='Lumsum'){

               if(parseFloat(adv_amount) > parseFloat(amount)){

                $("#adv_amount").val('');
                
                $("#adverr").html('adv amount should be less than amount');
                $("#submitdata").prop('disabled', true);

               }else if(parseFloat(adv_amount) == parseFloat(amount)){

                    $("#advrateModal").modal();

                    $("#submitdata").prop('disabled', true);

               }else{

                $("#adverr").html('');
                $("#submitdata").prop('disabled', false);
               }


            }
     }else{
      $("#submitdata").prop('disabled', true);
     }

  });

});

</script>

<script type="text/javascript">

  $(document).ready(function() {

  $("#rate").on('input', function () { 

    var rate = $(this).val();

    if(rate){

       var qty = $("#freight_qty").val();

      var amt = parseFloat(rate) * parseFloat(qty);

      $("#amount").val(amt.toFixed(2));

      $("#amount").prop('readonly',false);

      $("#payment_mode").prop('readonly',false);

    }else{

      $("#amount").prop('readonly',true);
      $("#payment_mode").prop('readonly',true);
    }


    chnageadvRate();
   

    });


  $("#payment_mode").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#paymentList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');

             $('#payment_mode').css('border-color','#d2d6de');
             $('#payment_mode').css('border-color','#ff0000').focus();
             $('#adv_type').css('border-color','#d2d6de');
              $("#adv_type").prop('readonly', true);
          }else{
            $('#payment_mode').css('border-color','#d2d6de');
            $('#adv_type').css('border-color','#ff0000').focus();
            $("#adv_type").prop('readonly', false);
          }

        });


  $("#amount").on('input', function () { 

    var amount = $(this).val();

    if(amount){

       var qty = $("#freight_qty").val();

      var rate = parseFloat(amount) / parseFloat(qty);
 
      $("#rate").val(rate.toFixed(2));

      $("#payment_mode").prop('readonly',false);

    }else{

      $("#payment_mode").prop('readonly',false);

    }


      chnageadvRate();
   

    });



  $("#freight_qty").on('input', function () { 

    var qty = $(this).val();
    var vehicle_owner = $("#vehicle_owner").val();

    if(vehicle_owner=='SELF'){

        if(qty){

           $("#submitdata").prop('disabled',false);
        }else{
          $("#submitdata").prop('disabled',true);
        }

    }else{

    if(qty){

      $("#rate").prop('readonly',false);

      var rate = $("#rate").val();

     var amount      =  parseFloat(qty) * parseFloat(rate);

      $("#amount").val(amount.toFixed(2));


    }else{
       $("#rate").prop('readonly',true);


    }

    chnageadvRate();


    }

   

    
    

    });



    });




   

</script>
<script type="text/javascript">

  

  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      endDate: 'today',
      
      autoclose: 'true'

    });

   

});


  $(document).ready(function(){


      $("#transporter_code").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#transportList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $("#transporter_code").val('');
             $("#transporter_name").val('');
             $('#transporter_code').css('border-color','#d2d6de');
             $('#transporter_code').css('border-color','#ff0000').focus();
             //$('#payment_mode').css('border-color','#d2d6de');
             $("#fright_order").val('');
             $("#rate").val('');
             $("#freight_qty").val('');
             $("#amount").val('');
             $("#fright_order").prop('readonly', true);
              $("#rate").val('');
              $("#amount").val('');
              $("#fright_order").val('');
              $("#mfprate").val('');
              $("#rate_basis").val('');
              $("#freight_qty").prop('readonly', true);
              $("#rate").prop('readonly', true);
              $("#payment_mode").prop('readonly', true);
          }else{

             $("#transporter_name").val(msg);
             $('#transporter_code').css('border-color','#d2d6de');
           //  $('#payment_mode').css('border-color','#ff0000').focus();
             $("#freight_qty").prop('readonly', false);
             $("#rate").prop('readonly', false);
             $("#payment_mode").prop('readonly', false);
            
    
          } 

        });



       /* $("#do_no").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#deliveryList1 option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

         if(msg=='No Match'){

             $(this).val('');
         }

        });*/

        $("#vehicle_no").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#vehicleList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

            $("#vehicle_owner").val('');
            $("#vehicle_type").val('');
            $("#transporter_code").val('');
            $("#transporter_name").val('');
            $("#fright_order").val('');
            $("#freight_qty").val('');
            $("#rate").val('');
            $("#amount").val('');
            $("#payment_mode").val('');
            $("#adv_type").val('');
            $("#adv_rate").val('');
            $("#adv_amount").val('');
            $("#sale_rate").val('');
            $("#fsohid").val('');
            $("#fsobid").val('');
            //$("#submitdata").prop('disabled',true);
             
          }else{
           //$("#submitdata").prop('disabled',false);
         
          }


        
           

        });


        $("#vehicle_type").on('change', function () {  

          var val = $(this).val();

          var VehicleOwner =  $("#vehicle_owner").val();


 

          var xyz = $('#vehicleTypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

            $("#vehicle_type").val('');
            $("#transporter_code").prop('readonly',true);
            $("#sale_rate").val('');
            $("#fsohid").val('');
            $("#fsobid").val('');
            $("#vehicleType_name").val('');
            $("#whee_type_name").val('');
            $("#min_gurrentee").val('');
            $("#whee_type_code").val('');
             
          }else{

            $("#vehicleType_name").val(msg);

           if(VehicleOwner){

                if(VehicleOwner=='DUMP' || VehicleOwner=='SELF'){

                $("#transporter_code,#transporter_name,#fright_order,#rate,#amount,#payment_mode,#adv_type,#adv_rate,#whee_type_name,#min_gurrentee").prop('readonly',true);

                $("#submitdata").prop("disabled",false);

                }else{

                  $("#submitdata").prop("disabled",true);
                  $("#transporter_code").prop('readonly',false);
                  $("#whee_type_name").prop('readonly',false);

                }

              }
          }


        
           

        });



         $("#whee_type_name").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#wheelTypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

           var explodeData = val.split(' ');

           var min_gurrentee = explodeData[1]+' '+explodeData[2];

          if(msg=='No Match'){

            $("#min_gurrentee").val('');
            $("#transporter_code").prop('readonly',true);
            $("#whee_type_code").val('');
             
          }else{

            $("#min_gurrentee").val(min_gurrentee);
            $("#whee_type_code").val(msg);

          }


        });




      });

</script>

<script type="text/javascript">
  
  function getRate(){

  var basicTotal = $("#basicTotal").val();

  var trans_code = $("#transporter_code").val();

  var to_place = $("#head_toplace").val();

  var FreightQtyTotal = $("#basicTotal").val();

  //var getorder =  fright_order.split(" ");

  //var series_code = getorder[1];
  //var vrno = getorder[2];
//alert(to_place);

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-freight-pur-order-details') }}",

          method : "POST",

          type: "JSON",

          data: {trans_code: trans_code,to_place:to_place},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                $("#freight_qty").val(FreightQtyTotal);
                 //$("#payment_mode").prop("readonly",true);



              }else if(data1.response == 'success'){


                    if(data1.data=='' || data1.data==null){


                       $("#freight_qty").val(FreightQtyTotal);

                    }else{

                        var fy_year     =  data1.data[0].FY_CODE;
                        var series_code =  data1.data[0].SERIES_CODE;
                        var vr_no       =  data1.data[0].VRNO;
                        
                        var fy_code     =  fy_year.split("-");
                        
                        var fycode      = fy_code[1];
                        
                        var pordervrno  = fycode+' '+series_code+' '+vr_no;
                      
                        var rate       = data1.data[0].RATE;
                        var rate_basis = data1.data[0].RATE_BASIS;
                        var amount     =  parseFloat(basicTotal) * parseFloat(rate);
                        
                        $("#rate").val(rate);
                        $("#amount").val(amount);
                        $("#fright_order").val(pordervrno);
                        $("#mfprate").val(rate);
                        $("#rate_basis").val(rate_basis);
                        $("#freight_qty").val(basicTotal);

                    }
                   
                  /*$("#accountName").val(data1.data[0].ACC_NAME);
                  $("#from_place").val(data1.data[0].FROM_PLACE);
                  $("#to_place").val(data1.data[0].TO_PLACE);*/
                  

              }

          }

    });

}

</script>

<script type="text/javascript">

  function donumber(num){

      var do_number = $("#do_no"+num).val();

      if(do_number){

        $("#ItemCodeId"+num).prop('readonly',false);
      }else{
           $("#ItemCodeId"+num).prop('readonly',true);
      }
  }
  
</script>

<script type="text/javascript">
  function Getqunatity(qtyId){


     var checkqty = $('#qty'+qtyId).val();

     var doqty      =$('#do_qty'+qtyId).val();
     //var totalBasic = parseFloat($('#basicTotalTemp').val());
     var totalBasic = parseFloat($('#basicTotal').val());
     var stockqty   =$('#stockavlblevalue'+qtyId).val();

     var trcount=$('#tbledata tr').length;
      
      var getCalQty=0;
     for(var e=0;e<trcount;e++){

      if(e >= 1){
        var newQty = $('#qty'+e).val();
         getCalQty += parseFloat(newQty);

      }
        
     }

     $("#basicTotal").val(getCalQty.toFixed(3));
    // console.log('getCalQty',getCalQty);
      //var glcdAry = [];

      /*for(var y=1;y<=trcount;y++){
       
        var glCd = $('#gl_code'+y).val();
        glcdAry.push(glCd);

      }*/
     
    /* var quantity =$('#qty'+qtyId).val().replaceAll(',', '');
     var cfactor = $('#Cfactor'+qtyId).val();
     var total = quantity * cfactor;

     console.log('orgqty',checkqty);
   
      if (quantity.length < 1){
        ('#qty'+qtyId).val('0.00');
        
      }else {
        var val = parseFloat(quantity);
        var formatted = inrFormat(quantity);

        $('#qty'+qtyId).val(val);
      }
*/
    
     /* if(checkqty){
     
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);

      }else{
        
          $("#deletehidn").prop('disabled', true);
          $("#addmorhidn").prop('disabled', true);
      }*/

      var gr_amt1 =0;
       $(".qtyclc").each(function () {

        
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 += parseFloat(this.value);
              console.log('total ',this.value);

            }

            /*if(qtyId >1){

              var newAmt = parseFloat(gr_amt1) - parseFloat(checkqty);
             
            }else{
               var newAmt = parseFloat(gr_amt1) - parseFloat(0);
            }

            $("#basicTotal").val(newAmt.toFixed(3));*/

           /* if(parseFloat(checkqty) > parseFloat(doqty)){

              $("#doqtyerr").html('do qty should be greater than trip plan qty').css('color','red');

              $('#qty'+qtyId).val(doqty);

              $("#basicTotal").val();
          
              }else{
               
                $("#doqtyerr").html('');

                $("#basicTotal").val();
              }*/
          

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());


        $("#vehicle_no").prop('readonly',false);
       // $("#submitdata").prop('disabled',false);



  }
</script>

<script type="text/javascript">

  function updatetripApproveData(pdfFlag){

      var downloadFlg = pdfFlag;

      $('#pdfYesNoStatus').val(downloadFlg);

      var trcount=$('table tr').length;
      var data = $("#approveTripMarket").serialize();

      var vehicle_owner =  $("#vehicle_owner").val();
      var vehicle_no    =  $("#vehicle_no").val();
      var vehicle_type  =  $("#vehicle_type").val();
      var off_days      =  $("#off_days").val();
      var trip_day      =  $("#trip_day").val();
      var freight_qty   =  $("#freight_qty").val();

      //alert(vehicle_owner);return false;

     

      if(vehicle_owner=='MARKET'){

        var transporter_code =  $("#transporter_code").val();
        var freight_qty =  $("#freight_qty").val();
        var rate =  $("#rate").val();
        var amount =  $("#amount").val();
        var payment_modem =  $("#payment_mode").val();
        var adv_type =  $("#adv_type").val();
        var adv_amount =  $("#adv_amount").val();

        if(transporter_code=='' || freight_qty=='' || rate=='' || amount=='' || payment_modem=='' || adv_type=='' || adv_amount==''){

          $("#requiredMsg").html('* Fields Are Required').css('color','red');

          return false;
        }

      }else{


             if(vehicle_no=='' || vehicle_owner=='' || vehicle_type=='' || off_days=='' || trip_day=='' || freight_qty==''){

              $("#requiredMsg").html('* Fields Are Required').css('color','red');

              return false;
           }
      }

      $('.overlay-spinner').removeClass('hideloader');

      $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/logistic/update-approve-trip-market') }}",

          data: data, // here $(this) refers to the ajax object not form

          success: function (data) {
            console.log('data',data);
            var data1 = JSON.parse(data);

            if(data1.response=='error'){

              var responseVar = false;

              var url = "{{ url('logistic/trip-planning-update-msg') }}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

            }else{

              var responseVar =true;

              /*if(downloadFlg == 1){
                  var fyYear    = data1.data[0].FY_CODE;
                  var fyCd      = fyYear.split('-');
                  var seriesCd  = data1.data[0].SERIES_CODE;
                  var vrNo      = data1.data[0].VRNO;
                  var fileN     = 'LP_'+fyCd[0]+''+seriesCd+''+vrNo;
                  var link      = document.createElement('a');
                  link.href     = data1.url;
                  link.download = fileN+'.pdf';
                  link.dispatchEvent(new MouseEvent('click'));
              }*/
              var url = "{{ url('/logistic/trip-planning-update-msg') }}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

            }

          },

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
      var to_place = $('#head_toplace').val();

      $.ajax({

        url:"{{ url('Get-Pfct-Code-Name-By-Plant-Vehicle-Plan') }}",

        method : "POST",

        type: "JSON",

        data: {Plant_code: Plant_code,to_place:to_place},

        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

            console.log('data1.data[0]',data1.data_plant);

            if(data1.data_plant==''){
                    $("#from_place").val('');
            }else{

              $("#from_place").val(data1.data_plant);

            }

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
                $('#getStateByPlant').val(data1.data[0].STATE);
               // $('#from_place').val(data1.data[0].CITY_NAME);
                $('#trip_day').val(data1.data_trip.TRIP_DAYS);
                //$('#off_days').val(data1.data_trip.OFF_DAY);

              }

          }

        }

      });
  }
</script>


<script type="text/javascript">

  function consigneeName(num){

   // alert(num);

         //  var val = $("#consignee"+num).val();

           var consinee_code = $("#consignee_wdo"+num).val();


          var xyz = $('#ConsineeList_wdo'+num+' option').filter(function() {

          return this.value == consinee_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg){

            $("#consineeName_wdo"+num).val(msg);
            $("#ItemCodeId"+num).prop('readonly',false);

          }else{

            $("#consineeName_wdo"+num).val('');

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
            $("#consigneeadd_wdo"+num).val('');

          }else if(data1.response == 'success'){
            //console.log('data1.data[0]',data1.data[0]);
            if(data1.data == ''){
                
              
                
                 $("#consigneeadd_wdo"+num).val('');
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

  function getRateOfPurchaseFreight(){

      var freightOrder = $("#fright_order").val();

      var xyz = $('#fpoList option').filter(function() {

      return this.value == freightOrder;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      
      if(msg == 'No Match'){
        $('#rate').val('');
      }else{

          var freightOrderNo = $("#fright_order").val();
          var fromPlace      = $("#from_place").val();
          var toPlace      = $("#head_toplace").val();
          var prevRate      = $("#prevRate").val();

          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });        

          $.ajax({

            url:"{{ url('get-rate-against-purchase-freight-order-number') }}",

            method : "POST",

            type: "JSON",

            data: {freightOrderNo: freightOrderNo,fromPlace:fromPlace,toPlace:toPlace},

            success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                $('#fright_order').val('');
                $('#rate').val(prevRate);
                $('#showerrorMsg').html('Freight rate not found for this '+fromPlace+' - '+toPlace+' route');

              }else if(data1.response == 'success'){

                if(data1.data_rate == ''){

                }else{
                  $('#showerrorMsg').html('');
                  $('#rate').val(data1.data_rate[0].RATE);
                }

              }/*/. RESPONSE */

            }/* /. SUCCESS FUN*/

          }); /* /. AJAX FUN*/

      }/* /. NO MATCH CODN*/

  }/* /.MAIN FUNCTION*/
</script>
@endsection