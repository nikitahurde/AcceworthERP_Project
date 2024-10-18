@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')



 <script type="text/javascript">

    var itemcodeurl = "<?php echo url('get-item-data-requsiton'); ?>";

     var quaitemurl = "<?php echo url('/finance/get-quality-parameter-by-item'); ?>";

     var accCodeurl = "<?php echo url('get-employe-data-by-department'); ?>";

     var seriesurl = "<?php echo url('get-series-data-by-series-code'); ?>";

     var Plantcodeurl = "<?php echo url('get-pfct-code-name-by-plant-indend'); ?>";

     var Plantdetailsurl = "<?php echo url('get-plant-data-by-plant-code'); ?>";

     var submitdataurl = "<?php echo url('/finance/save-store-requisition-transaction'); ?>";

     var viewaurl = "<?php echo url('/finance/view-store-req-msg'); ?>";


  </script>
  



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

.btn-group-sm>.btn, .btn-sm {
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

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> {{ $title }}</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('Transaction/Logistic/View-Freight-Purchase-Order') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Freight Purchase.</a>

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
          <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active" id="firstTab">
                  <a href="#tab1info" id="basicInfo" data-toggle="tab">Basic Info</a>
                </li>
                <!-- <li id="secondTab">
                  <a href="#tab2info" data-toggle="tab" >Other Details</a>
                </li> -->
            </ul>
          </div>
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
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>" readonly autocomplete="off" onchange="PlantCode()">

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
                              <input type="text"  id="profitctrId" name="pfct" class="form-control  pull-left" placeholder="Select Profit Center Code"  readonly autocomplete='off'>


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

                              <input type="text" class="form-control" name="pfctname" id="pfctName" placeholder="Enter Profit Center Name" readonly autocomplete='off'>

                            </div>

                        </div>
                        
                      </div>
                      
                    </div> <!-- row -->

                    <div class="row">

                     

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Vendor Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="" placeholder="Select Account" autocomplete='off'
                            > 

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

                          <label> Vendor Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="account_name" value="" id="account_name" placeholder="Enter Department Name" readonly autocomplete="off" autocomplete='off'>

                            </div>
                            
                        </div>
                        
                      </div>

                     
                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Vehicle Type : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="vehciletypeList" class="form-control" name="vehicle_type" value="" id="vehicle_type" placeholder="Enter Vehicle Type" autocomplete="off" >

                                  <datalist id="vehciletypeList">

                                      @foreach ($vehicletype_list as $key)

                                      <option value='<?php echo $key->WHEEL_CODE?>' data-xyz ="<?php echo $key->WHEEL_NAME; ?>" ><?php echo $key->WHEEL_NAME ; echo " [".$key->WHEEL_CODE."]" ; ?></option>

                                      @endforeach

                                  </datalist><br>

                        

                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="vehicletype_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div>
                    
                     <div class="col-md-2">

                        <div class="form-group">

                          <label> Ref No : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="ref_no" maxlength="8" value="" id="ref_no" placeholder="Enter Refrence No" autocomplete="off">

                        

                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="refno_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div>
                      
                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Ref Date : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type=text class="form-control fromdatepicker" name="ref_date" value="" id="ref_date" placeholder="Enter Refrence Date" autocomplete="off">

                          

                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="refdate_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div>
                      
                    <div class="col-md-2">

                        <div class="form-group">

                          <label> Valid From Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>


                              <input type="text" class="form-control fromdatepicker" name="valid_from_dt" value="" id="valid_from_dt" placeholder="Enter Valid from dt" autocomplete="off">

                              

                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="valid_from_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div>

                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Valid To Date : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control todatepicker" name="valid_to_dt" value="" id="valid_to_dt" placeholder="Enter Valid To Date" autocomplete="off">

                              
                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="valid_to_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div>



                      

                    </div> <!-- row -->
                    
                

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



                  <input type ="hidden" name="comp_name" id="getCompName">
                  <input type ="hidden" name="fy_year" id="getFyYear">
                  <input type ="hidden" name="trans_date" id="getTransDate">
                  <input type ="hidden" name="vr_no" id="getVrNo">
                  <input type ="hidden" name="trans_code" id="getTransCode">
                  <input type ="hidden" name="AccCode" id="getAccCode">
                  <input type ="hidden" name="AccName" id="getAccName">
                   <input type ="hidden" name="RouteCode" id="getRouteCode">
                  <input type ="hidden" name="RouteName" id="getRouteName">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="pfct_name" id="getPfctName">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="plant_name" id="getPlantName">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
                  <input type ="hidden" name="series_name" id="getSeriesName">
                  <input type ="hidden" name="tax_code" id="getTaxCode">
                  <input type="hidden" name="due_days" id="gateduedays">
                  <input type="hidden" name="getrefNo" id="getrefNo">
                  <input type="hidden" name="getrefDate" id="getrefDate">
                  <input type="hidden" name="getvalidfrmDate" id="getvalidfrmDate">
                  <input type="hidden" name="getvalidtoDate" id="getvalidtoDate">
                  <input type="hidden" name="getVehicleType" id="getVehicleType">
               
                  <input type="hidden" name="cost_code" id="cost_code">
                  <input type="hidden" name="comp_name" value="<?php echo Session::get('company_name'); ?>">
                  <input type="hidden" name="fiscal_year" value="<?php echo Session::get('macc_year'); ?>">
               
                  <tr>

                    <th style="width: 5%;"><input class='check_all'  type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 5%;"> Sr.No.</th>

                    <th>Route Code</th>
                    <th>Route Name</th>
                    <th>From Place</th>
                    <th>To Place</th>
                    <th>Rate Basis </th>
                    <th>Rate</th>
                   

                  </tr>

                  <tr class="useful">

                    <td class="tdthtablebordr" style="width: 25px;">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 25px;">1.</span>
                    </td> 

                    <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input list="routeList1" class="inputboxclr" style="width: 120px;" id='route_code1' name="route_code[]"   oninput="this.value = this.value.toUpperCase()"  onchange="getRouteLocation(1)" autocomplete='off' />

                      <datalist id="routeList1">
                                <?php foreach($route_list as $key) { ?>

                                  <option value="<?= $key->ROUTE_CODE ?>" data-xyz="<?= $key->ROUTE_NAME ?>"><?= $key->ROUTE_NAME ?> - <?= $key->ROUTE_CODE ?> </option>

                                <?php  } ?>
                     </datalist>

                      
                     </div>
                    </td> 

                    <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input type="text" class="inputboxclr" style="width: 220px;" id='route_name1' name="route_name[]"   oninput="this.value = this.value.toUpperCase()" autocomplete='off'/>


                      
                     </div>
                    </td>

                     <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input list="fromplaceList1" class="inputboxclr" style="width: 120px;" id='from_place1' name="from_place[]"   oninput="this.value = this.value.toUpperCase()"  onchange="getRouteDetails(1)" autocomplete='off'/>

                       <datalist id="fromplaceList1">

                       
                         
                       </datalist>
                     </div>
                    </td>

                    <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input list="toplaceList1" class="inputboxclr" style="width: 120px;" id='to_place1' name="to_place[]"   oninput="this.value = this.value.toUpperCase()"  autocomplete='off'/>

                        <datalist id="toplaceList1">

                        
                         
                       </datalist>
                     </div>
                    </td>
                    

                    <td class="tdthtablebordr tooltips" style="width: 25px;">

                      <input list="ratebasisList1" class="inputboxclr getAccNAme" style="width: 108px;" id='rate_basis1' name="rate_basis[]" autocomplete='off' />

                      <datalist id="ratebasisList1">

                        <option value="LR QTY" data-xyz='LR QTY'>LR QTY</option>
                        <option value="RECIEPT QTY" data-xyz='RECIEPT QTY'>RECIEPT QTY</option>
                        <option value="GUARANTED QTY" data-xyz='GUARANTED QTY'>GUARANTED QTY</option>

                      </datalist>

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small><br>


                    </td>
                     <td class="tdthtablebordr tooltips" style="width: 25px;">

                      <input type="text" class='debitcreditbox dr_amount getqtytotal inputboxclr quantityC moneyformate' style="width: 140px;margin-bottom: 5px" id='rate1' name="rate[]" oninput='Getqunatity(1)' autocomplete='off'/>

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small><br>


                    </td>


                  </tr>

                </table>

              </div><!-- /div -->

            
             <!--  <div class="row" style="display: flex;">

                  <div class="col-md-6"></div>

                    <div class="col-md-4 toalvaldesn">



                    <div class="totlsetinres">Total :</div>

                  </div>

                  <div class="col-md-1">
                     <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="basicTotal" readonly="" style="margin-top: 3px;width: 107px;">

                  </div>

                  <div class="col-md-1"></div>

              </div> -->


              <div class="row">
    
              <div class="col-md-4">

                  <button type="button" class="btn btn-danger btn-sm delete" id="deletehidn" disabled=""><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>
                  <button type="button" class="btn btn-info btn-sm addmore" id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>



              </div>

              <div class="col-md-4">
                 <p style="text-align:center;"><small id="doqtyerr"></small></p>
              </div>

              <div class="col-md-4">

                  <div style="display: flex;float: right;">
                      <div class="toalvaldesn" style="margin-top: 5%;">Total :</div>
                      <input class="debitcreditbox inputboxclr" type="text" name="TotlDebit" id="basicTotal"  readonly="" style="width: 98px;">
                  </div>
                  <!-- id="totldramt" -->
              </div>

          </div>

          <div class="row">
             <p class="text-center">

                    <button class="btn btn-success btn-sm" type="button" id="submitdata" onclick="submitData()" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                    <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

                  </p>
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

     <!--  <br>

        <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

        <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

        <p class="text-center">

          <button class="btn btn-success" type="button" id="submitdata" onclick="submitData()" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

        </p> -->

       

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

     


    </form>

  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

</div>

@include('admin.include.footer')

 

<script src="{{ URL::asset('public/dist/js/viewjs/freightpurchase_order.js') }}" ></script>
  
 
<script type="text/javascript">

  
  $(document).ready(function() {

     $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

    });

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
                  $("#from_place"+srno).val(data1.data[0].FROM_PLACE);
                  $("#to_place"+srno).val(data1.data[0].TO_PLACE);
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

                    

                    $("#vehciletypeList"+srno).append($('<option>',{

                      value:getData.VEHICLE_TYPE,

                      'data-xyz':getData.VEHICLE_TYPE,
                      text:getData.VEHICLE_TYPE


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



       var account_code =  $("#account_code").val();

        if(account_code==''){
        
           $('#account_code').css('border-color','#d2d6de');
                   //$('#asset_code').css('border-color','#d2d6de');
           }else{
            $('#account_code').css('border-color','#d2d6de');
           
           // $('#asset_code').css('border-color','#ff0000').focus();
           }

    });

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

    var vrType =  $('#vr_type').val();

      if(vrType == 'Payment'){

        var getpaymode = 'To -';

      }else if(vrType == 'Receipt'){

       var getpaymode='By -';

      }

      count=$('table tr').length;

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> </td>";

      data +="<td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='routeList"+i+"' class='inputboxclr' style='width: 120px;' id='route_code"+i+"' name='route_code[]'   oninput='this.value = this.value.toUpperCase()'  onchange='getRouteLocation("+i+")' autocomplete='off'/><datalist id='routeList"+i+"'><?php foreach($route_list as $key) { ?><option value='<?= $key->ROUTE_CODE ?>' data-xyz='<?= $key->ROUTE_NAME ?>'><?= $key->ROUTE_NAME ?> - <?= $key->ROUTE_CODE ?></option><?php  } ?></datalist></div></td><td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input type='text' class='inputboxclr' style='width: 220px;' id='route_name"+i+"' name='route_name[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off'/></div></td><td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='fromplaceList"+i+"' class='inputboxclr' style='width: 120px;' id='from_place"+i+"' name='from_place[]'   oninput='this.value = this.value.toUpperCase()' onchange='getRouteDetails("+i+")' /><datalist id='fromplaceList"+i+"'></datalist></div></td><td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='toplaceList"+i+"' class='inputboxclr' style='width: 120px;' id='to_place"+i+"' name='to_place[]'   oninput='this.value = this.value.toUpperCase()'  /><datalist id='toplaceList"+i+"'></datalist></div></td><td class='tdthtablebordr tooltips' style='width: 25px;'><input list='ratebasisList"+i+"' class='inputboxclr getAccNAme' style='width: 108px;' id='rate_basis"+i+"' name='rate_basis[]' autocomplete='off' /><datalist id='ratebasisList"+i+"'><option value='LR QTY' data-xyz='LR QTY'>LR QTY</option><option value='RECIEPT QTY' data-xyz='RECIEPT QTY'>RECIEPT QTY</option></datalist><small class='tooltiptextitem tooltiphide' id='itemNameTooltip1'></small><br></td><td class='tdthtablebordr tooltips'><input type='text' class='debitcreditbox dr_amount getqtytotal inputboxclr quantityC moneyformate' style='width: 140px;margin-bottom: 5px;' id='rate"+i+"' name='rate[]' oninput='Getqunatity("+i+")' /><small class='tooltiptextitem tooltiphide' id='itemNameTooltip1'></small><br></td><input type='hidden' id='Cfactor"+i+"'></div><div><small id='errmsgqty"+i+"'></small></div><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item Name/Item Code</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading'><span id='itemCodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='hsncodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='taxcodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemDetailshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemtypeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemgroupshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemclassshow"+i+"'> </span> </div><div class='box10 itmdetlheading'><span id='itemcategoryshow"+i+"'> </span> </div></div> </div></div> <div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div> </div></div></div></td>";

      $('table').append(data);


       var route_code = $("#route_code").val();

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

                  $("#fromplaceList"+count).empty();
                   $("#toplaceList"+count).empty();
                  

                  $.each(data1.data, function(k, getData){

                    

                    $("#fromplaceList"+count).append($('<option>',{

                      value:getData.FROM_PLACE,

                      'data-xyz':getData.FROM_PLACE,
                      text:getData.FROM_PLACE


                    }));

                   

                    $("#toplaceList"+count).append($('<option>',{

                      value:getData.TO_PLACE,

                      'data-xyz':getData.TO_PLACE,
                      text:getData.TO_PLACE


                    }));

                    

                  

                  })

                }

            }

          });


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

 $("#freight_order_no").on('change', function () {

  var freight =  $(this).val();

  var xyz = $('#freightList option').filter(function() {

    return this.value == freight;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
    
     document.getElementById("costcode_err").innerHTML = 'The Cost code field is required.';
      $('#importbtn').prop('disabled',true);
      $('#dono1').prop('readonly',true);
       $("#cost_code").val('');
  }else{

   
     document.getElementById("costcode_err").innerHTML = '';
    
     $('#importbtn').prop('disabled',false);
     $('#dono1').prop('readonly',false);
    
  }

  // objvalidtn.checkBlankFieldValidation();

});
  

</script>


<script type="text/javascript">
  

  $('#account_code').on('change',function(){
      var deptCode = $(this).val();

      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });

      $.ajax({

            url:"{{ url('get-employe-data-by-department') }}",

            method : "POST",

            type: "JSON",

            data: {deptCode: deptCode},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);
                  $.each(data1.data, function(k, getData){

                    $("#emplList").empty();

                    $("#emplList").append($('<option>',{

                      value:getData.EMP_CODE,

                      'data-xyz':getData.EMP_NAME,
                      text:getData.EMP_NAME


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
        
    }else{
      $('#Plant_code').css('border-color','#ff0000').focus();
    }

    


});
</script>


<script type="text/javascript">
  
  $(document).ready(function () {

  var currentdate = new Date();

$('.fromdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true',

      endDate: "currentdate",

      maxDate: currentdate

    

    });


$('.todatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true',
     
      startDate: "currentdate",

      minDate: currentdate

    });

});

</script>


<script type="text/javascript">

 function submitData(){


      var trcount=$('table tr').length;



          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/finance/save-freight-purchase-order'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                 var data1 = JSON.parse(data);

                 console.log(data);

                 if(data1.response=='error'){
                  var responseVar =false;

                    var url = "{{ url('/Transaction/view-freight-purchase-order-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar =true;
                  var url = "{{ url('/Transaction/view-freight-purchase-order-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }

               

              },

          });
      
  }
       
</script>

<script type="text/javascript">
  function Getqunatity(qtyId){

    
     var rate =$('#rate'+qtyId).val();

      if(rate){

              $("#deletehidn").prop('disabled', false);
              $("#addmorhidn").prop('disabled', false);
              $("#submitdata").prop('disabled', false);


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

               gr_amt =0;
             $(".getqtytotal").each(function () {
             
                  if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                      //gr_amt1 = parseFloat(qtyval);
                      gr_amt += parseFloat(this.value.replaceAll(',', ''));

                      
                  }

                $("#basicTotal").val(gr_amt.toFixed(2));

              });

       var allGrandAmount = parseFloat($('#basicTotal').val());


              $("#deletehidn").prop('disabled', true);
              $("#addmorhidn").prop('disabled', true);
              $("#submitdata").prop('disabled', false);
            }


  }
</script>


<script type="text/javascript">
  function Getqunatity1(qtyId){

     var checkqty =$('#qty'+qtyId).val();
     var stockqty =$('#stockavlblevalue'+qtyId).val();
     console.log('qty',checkqty);

     var rate =$('#rate'+qtyId).val();

      if(rate){

              $("#deletehidn").prop('disabled', false);
              $("#addmorhidn").prop('disabled', false);
            }else{
              $("#deletehidn").prop('disabled', true);
              $("#addmorhidn").prop('disabled', true);
            }

      if(parseFloat(checkqty) > parseFloat(stockqty)){
         console.log('error');

         $("#errmsgqty"+qtyId).html('req qty less than stock qty.').css('color','red');
         $('#qty'+qtyId).val('');
         $('#A_qty'+qtyId).val('');
          $("#submitdata").prop('disabled', true);
          $("#deletehidn").prop('disabled', true);

         
      }else{
        $("#errmsgqty"+qtyId).html('');
        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        
      }
     var gr_amt;
     if(checkqty){

         var quantity =$('#qty'+qtyId).val().replaceAll(',', '');
         var cfactor = $('#Cfactor'+qtyId).val();

         console.log('cftor',cfactor);
         var total = quantity * cfactor;
   
      if (quantity.length < 1){
        ('#qty'+qtyId).val('0.00');
        ('#A_qty'+qtyId).val('0.00');
      }else {
        var val = parseFloat(quantity);
        var formatted = inrFormat(quantity);

       /* if (formatted.indexOf('.') > 0) {
          var split = formatted.split('.');
          formatted = split[0] + '.' + split[1].substring(0, 2);
        }*/
        $('#qty'+qtyId).val(val);
      }

     
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
  
  function PlantCode(){

    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var Plant_code = $('#Plant_code').val();

      if (Plant_code=='') {
        $('#Plant_code').css('border-color','#ff0000').focus();
      }else{
        $('#Plant_code').css('border-color','#d2d6de');
        $('#account_code').css('border-color','#ff0000').focus();
      }

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
                $('#getStateByPlant').val(data1.data[0].STATE);

              }

          }

        }

      });
  }
</script>
@endsection