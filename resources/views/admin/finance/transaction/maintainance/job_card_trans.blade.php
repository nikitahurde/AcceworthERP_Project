@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<script src="{{ URL::asset('public/dist/js/controller/JobCardController.js') }}" ></script> 


<script type="text/javascript">

	var requisition = new JobCard();

</script>

 <script type="text/javascript">

     var itemcodeurl = "<?php echo url('get-item-data-jobcard'); ?>";
     
     var quaitemurl = "<?php echo url('/finance/get-quality-parameter-by-item'); ?>";
     
     var accCodeurl = "<?php echo url('get-employe-data-by-department'); ?>";
     
     var seriesurl = "<?php echo url('get-series-data-by-series-code'); ?>";
     
     var Plantcodeurl = "<?php echo url('get-pfct-code-name-by-plant-indend'); ?>";
     
     var Plantdetailsurl = "<?php echo url('get-plant-data-by-plant-code'); ?>";
     
     var submitdataurl = "<?php echo url('/finance/save-store-requisition-transaction'); ?>";
     
     var viewaurl = "<?php echo url('/Transaction/view-job-card-msg'); ?>";


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

                <a href="{{ url('/Transaction/Maintainance/View-Job-Crad-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Job Card.</a>

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

                              <input type="text" class="form-control transdatepicker" name="vr" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off" onchange="requisition.vrDate()">

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
                      <!-- /.col -->

                    </div>
                    <!-- /.row -->

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
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>" readonly autocomplete="off" onchange="requisition.PlantCode(Plantcodeurl)">

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

                      <div class="col-md-4">

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

                          <label>Profit Center Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <input list="profitList"  id="profitctrId" name="pfct" class="form-control  pull-left" value="" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">


                            </div>

                          <small id="profit_center_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      
                    </div> <!-- row -->

                    <div class="row">

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Profit Center Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="pfctname" value="" id="pfctName" placeholder="Enter Profit Center Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>


                       <div class="col-md-3">

                        <div class="form-group">

                          <label>Equipment Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="EquipList"  id="equip_code" name="equip_code" class="form-control  pull-left" value="" placeholder="Select Equipment"> 

                              <datalist id="EquipList">

                              
                                @foreach ($eqp_list as $key)

                               <option value='<?php echo $key->EQP_CODE?>'  data-xyz="<?php echo $key->EQP_NAME; ?>" ><?php echo $key->EQP_NAME; echo "[".$key->EQP_CODE."]"; ?></option>

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

                          <label> Equipment Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="equip_name" value="" id="equip_name" placeholder="Enter Equipment Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>


                       <div class="col-md-3">

                        <div class="form-group">

                          <label>Job Type : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="jobTypeList"  id="job_type" name="job_type" class="form-control  pull-left" value="" placeholder="Select Job Type"> 

                              <datalist id="jobTypeList">

                              
                              
                               <option value='Breakdown'  data-xyz="Breakdown">Breakdown</option>

                               
                              </datalist>

                            </div>

                            <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                            <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                            <small id="acccode_code_errr" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>

                     
                    </div>

                      
                    <div class="row">

                       <div class="col-md-3">

                        <div class="form-group">

                          <label>Department Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="" placeholder="Select Department"
                              onchange="requisition.GetAccCode(accCodeurl)"> 

                              <datalist id="AccountList">

                              
                                @foreach ($dept_list as $key)

                               <option value='<?php echo $key->DEPT_CODE?>'  data-xyz="<?php echo $key->DEPT_NAME; ?>" ><?php echo $key->DEPT_NAME; echo "[".$key->DEPT_CODE."]"; ?></option>

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

                          <label> Department Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="acctname" value="" id="accountName" placeholder="Enter Department Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> SR Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="emplList" class="form-control" name="emp_code" value="" id="emp_code" placeholder="Enter Employee Code" autocomplete="off" onchange="EmpCode()">

                              <datalist id="emplList">

                                <option selected="selected" value="">-- Select --</option>

                              </datalist>

                            </div>

                            <small id="empName" class="showcodename"></small>

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
                              		
                                <option value="<?= $key->COST_CODE ?>" data-xyz="<?= $key->COST_NAME ?>"><?= $key->COST_CODE ?> <?= $key->COST_NAME ?></option>

                                <?php	} ?>

                              </datalist>

                            </div>

                            <small id="empName" class="showcodename"></small>

                        </div>
                        
                      </div>


                    </div> <!-- row -->

                    <div class="row">


                       <div class="col-md-3">

                        <div class="form-group">

                          <label>Asset Code: 
                            <span class="required-field"></span>
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="assetList" id="asset_code" name="asset_code" class="form-control  pull-left Number" value="{{ old('due_days')}}" placeholder="Enter Asset Code" autocomplete="off" style="text-align: end;" readonly>

                               <datalist id="assetList">
                                <?php foreach ($asset_list as $key) { ?>
                                  
                                <option value="<?= $key->ASSET_CODE ?>" data-xyz="<?= $key->ASSET_NAME ?>"><?= $key->ASSET_CODE ?> <?= $key->ASSET_NAME ?></option>

                                <?php } ?>

                              </datalist>

                            </div>

                        </div>
                           
                      </div>
                          <!-- /.col -->
                        <div class="col-md-3">

                        <div class="form-group">

                          <label>Target Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            
                              <input type="text" class="form-control datepicker" name="target_date" id="target_date" value="{{ old('due_date')}}" placeholder="Select Target" autocomplete="off" readonly>

                            </div>
                        </div>
                            
                      </div>


                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Complition Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            
                              <input type="text" class="form-control datepicker" name="complete_date" id="complete_date" value="{{ old('due_date')}}" placeholder="Select Complete Date" autocomplete="off" readonly>

                            </div>
                        </div>
                            
                      </div>

                        
                      <div class="col-md-3">
                        <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 26px;float: right;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                      </div>
                </div>

                  </div> <!-- /.tab first -->
                  <div class="tab-pane fade" id="tab2info">
                      <div class="row">

                          <div class="col-md-4">
                              <div class="form-group">

                                <label>Party Ref No :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="party_ref" id="party_rf_no" placeholder="Enter Party Ref No" maxlength="30" autocomplete="off">

                                </div>

                                <small id="emailHelp" class="form-text text-muted">

                                </small>

                              </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">

                              <label>Party Ref Date:</label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                                       $ToDate= date("d-m-Y", strtotime($toDate));  

                                ?>

                                <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy_1">

                                <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy_1">

                                <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="{{ old('vr_date')}}" placeholder="Select Party Ref Date" autocomplete="off" onchange="requisition.PartyRefDate()">

                              </div>

                              <small id="showmsgfordate_1" style="color: red;"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                      {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                            </div>
                            <!-- /.form-group -->
                          </div>
                          
                      </div>

                      <div class="row">
                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->RFHEAD1) && $rfhead->RFHEAD1 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->RFHEAD1 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_1" placeholder="Enter Rfhead1" maxlength="30" id="rfhead1" oninput="rfheadget(1)" autocomplete="off">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div>
                        <?php }else{} } ?>

                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->RFHEAD2) && $rfhead->RFHEAD2 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->RFHEAD2 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_2" placeholder="Enter Rfhead2" maxlength="30" id="rfhead2" oninput="rfheadget(2)">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div>
                        <?php }else{} } ?>

                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->RFHEAD3) && $rfhead->RFHEAD3 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->RFHEAD3 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_3" id="rfhead3" placeholder="Enter Rfhead3" maxlength="30" oninput="rfheadget(3)">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div>
                        <?php }else{} } ?>
                          
                      </div>

                      <div class="row">
                          
                        <?php foreach ($series_list as $rfhead) {

                          if(isset($rfhead->RFHEAD4) && $rfhead->RFHEAD4 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->RFHEAD4 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_4" placeholder="Enter Rfhead4" maxlength="30" id="rfhead4" oninput="rfheadget(4)" autocomplete="off">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div>
                        <?php }else{} } ?>

                        <?php foreach ($series_list as $rfhead) {

                          if(isset($rfhead->RFHEAD5) && $rfhead->RFHEAD5 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->RFHEAD5 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_5" placeholder="Enter Rfhead5" maxlength="30" id="rfhead5" oninput="rfheadget(5)" autocomplete="off">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div>
                        <?php }else{} } ?>

                          <div class="col-md-4">
                              <a class="btn btn-info"  href="#tab1info" data-toggle="tab" style="margin-top: 26px;" id="previousbtn" >Previous&nbsp;&nbsp;<i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                          </div>
                      </div>

                      
                  

                </div>
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
                  <input type ="hidden" name="departCode" id="getAccCode">

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
                  <input type="hidden" name="cost_name" id="cost_name">
                  <input type="hidden" name="assetcode" id="assetCode">
                  <input type="hidden" name="assetname" id="assetName">
                  <input type="hidden" name="targetdate" id="targetDate">
                  <input type="hidden" name="completedate" id="completeDate">
                  <input type="hidden" name="EquipCode" id="getEquipCode">
                  <input type="hidden" name="EquipName" id="getEquipName">
                  <input type="hidden" name="EmpName" id="getEmpName">
                  <input type="hidden" name="EmpCode" id="getEmpCode">
                  <input type="hidden" name="jobtype" id="jobtype">


                  <input type="hidden" name="comp_name" value="<?php echo Session::get('company_name'); ?>">
                  <input type="hidden" name="fiscal_year" value="<?php echo Session::get('macc_year'); ?>">
               
                  <tr>

                    <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 10px;"> Sr.No.</th>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty</th>

                    <th>A-Qty</th>


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
                        <input list="ItemList1" class="inputboxclr SetInCenter" style="width: 120px;margin-bottom: 5px;" id='ItemCodeId1' name="item_code[]"  onchange="ItemCodeGet(1,itemcodeurl,quaitemurl);"  oninput="this.value = this.value.toUpperCase()" readonly />

                          <datalist id="ItemList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($help_item_list as $key)

                              <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                              @endforeach

                          </datalist>
                      </div>
                       <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1" onclick="requisition.showItemDetail(1,itemcodeurl)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>
                       <div><!-- <p id="stockavlble1" class="badge" style="background-color:#25b6bd;"></p> -->
                       </div>
                       <input type="hidden" name="stockavlblevalue" id="stockavlblevalue1">
                       <input type="hidden" name="scrab_code[]" id="scrab_code1">
                    </td>

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id1' name="item_name[]" readonly />

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small><br>

                      <textarea id="remark_data1" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description" readonly></textarea>

                      <div><p id="batchno1" class="badge" style="background-color:#25b6bd;"></p>
                       </div>
                       <input type="hidden" name="batch_no[]" id="batch_no1">

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate"  id='qty1' name="qty[]" oninput='Getqunatity(1)'style="width: 80px" readonly />
                      <input type="hidden" id="qtyget1" class="totlqty">
                      <input type="text" name="unit_M[]" id="UnitM1" class="inputboxclr SetInCenter AddM" readonly>

                      <input type="hidden" id="Cfactor1">
                      <input type="hidden" id="item_type1" name="item_type[]">


                      </div>
                       <div><small id="errmsgqty1"></small></div>

                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty1' name="Aqty[]"  style="width: 80px" readonly />

                      <input type="text" name="add_unit_M[]" id="AddUnitM1" class="inputboxclr SetInCenter AddM" readonly>

                      </div>

                    </td>

                     

                    

                    

                  </tr>

                </table>

              </div><!-- /div -->

            
              <div class="row" style="display: flex;">

                  <div class="col-md-6"></div>

                    <div class="col-md-4 toalvaldesn">



                    <div class="totlsetinres">Total :</div>

                  </div>

                  <div class="col-md-1">
                     <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="basicTotal" readonly="" style="margin-top: 3px;">

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

        <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

        <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

        <p class="text-center">

          <input type="hidden" id="donwloadStatus" name="donwloadStatus">

          <button class="btn btn-success" type="button" id="submitdata" onclick="submitAllData(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

          <button class="btn btn-success" type="button" id="submitNDwn" onclick="submitAllData(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>

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
                    <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancel</button>
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

@include('admin.include.footer')

 

<script src="{{ URL::asset('public/dist/js/viewjs/jobcard.js') }}" ></script>
  
 
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
  

  function EmpCode(){

  var empcode =  $("#emp_code").val();

  if(empcode==''){
  
     $('#emp_code').css('border-color','#d2d6de');
     $('#cost_center_code').css('border-color','#d2d6de');
     $('#emp_code').css('border-color','#ff0000').focus();
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#emp_code').css('border-color','#d2d6de');
      $('#cost_center_code').css('border-color','#ff0000').focus();
     // $('#asset_code').css('border-color','#ff0000').focus();
     }
     
  var xyz = $('#emplList option').filter(function() {

    //console.log(this.value);


    return this.value == empcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
     $('#empName').html('');
     $('#emplyeeName').val('');
     $("#ItemCodeId1").prop('readonly',true);
  }else{
    $('#empName').html(msg);
    $('#emplyeeName').val(empcode);
    $('#getEmpCode').val(empcode);
    $('#getEmpName').val(msg);
/*    $('#due_days').prop('readonly',false);
*/    $('#ItemCodeId1').prop('readonly',false);

  }
 //objvalidtn.checkBlankFieldValidation();

}

</script>

<script type="text/javascript">
  

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

    });

  });

</script>

<script type="text/javascript">

  $(".delete").on('click', function() {


      var rowCount = $('#tbledata tr').length;
      
      console.log('rowCount',rowCount);
      if(rowCount == 2){
         $('#submitdata').prop('disabled',true);
         $('#submitNDwn').prop('disabled',true);
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

      data +="<td class='tdthtablebordr'><div class='input-group'><input list='ItemList"+i+"' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' name='item_code[]' onchange='ItemCodeGet("+i+",itemcodeurl,quaitemurl);' oninput='this.value = this.value.toUpperCase()'/><datalist id='ItemList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($help_item_list as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option>@endforeach</datalist></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='requisition.showItemDetail("+i+",itemcodeurl)'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><div></div><input type='hidden' name='stockavlblevalue' id='stockavlblevalue"+i+"'><input type='hidden' name='scrab_code[]' id='scrab_code"+i+"'></td> <td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' readonly /><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></small><div><textarea id='remark_data"+i+"' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description'></textarea></div><div><p id='batchno"+i+"' class='badge' style='background-color:#25b6bd;'></p></div><input type='hidden' name='batch_no[]' id='batch_no"+i+"'></td> <td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount getqtytotal inputboxclr SetInCenter quantityC moneyformate'  id='qty"+i+"' name='qty[]' oninput='Getqunatity("+i+")' style='width: 80px' /><input type='hidden' id='qtyget"+i+"' class='totlqty'><input type='text' name='unit_M[]' readonly id='UnitM"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' id='Cfactor"+i+"'><input type='hidden' id='item_type"+i+"' name='item_type[]'></div><div><small id='errmsgqty"+i+"'></small></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM'></div><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item Name/Item Code</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading'><span id='itemCodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='hsncodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='taxcodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemDetailshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemtypeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemgroupshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemclassshow"+i+"'> </span> </div><div class='box10 itmdetlheading'><span id='itemcategoryshow"+i+"'> </span> </div></div> </div></div> <div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div> </div></div></div></td>";

      $('table').append(data);


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
      $('#submitNDwn').prop('disabled',true);
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
	
$('#cost_center_code').on('change',function(){


	var costCode = $(this).val();
  var assetCode = $("#asset_code").val();


  var xyz = $('#costList option').filter(function() {

    return this.value == costCode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){

    $("#cost_code").val('');
     $('#cost_name').val('');
     
  }else{
    
     $("#cost_code").val(costCode);
     $('#cost_name').val(msg);
    
  }

  if(costCode==''){
  
     $('#cost_center_code').css('border-color','#d2d6de');
     $('#cost_center_code').css('border-color','#ff0000').focus();
     //$('#asset_code').css('border-color','#d2d6de');
  }else{
      $('#cost_center_code').css('border-color','#d2d6de');
     // $('#asset_code').css('border-color','#ff0000').focus();
  }

  if(assetCode==''){

    $('#asset_code').css('border-color','#d2d6de');
    $('#asset_code').css('border-color','#ff0000').focus();
  }else{
    $('#asset_code').css('border-color','#d2d6de');
  }

  $("#asset_code").prop('readonly', false);

});


$('#asset_code').on('change',function(){


  var assetCode = $(this).val();

  var targetDt = $("#target_date").val();



  if(assetCode){

    $('#asset_code').css('border-color','#d2d6de');
  }else{
    $('#asset_code').css('border-color','#d2d6de');
    $('#asset_code').css('border-color','#ff0000').focus();
  }

  if(targetDt==''){
    $('#target_date').css('border-color','#d2d6de');
    $('#target_date').css('border-color','#ff0000').focus();
  }else{
    $('#target_date').css('border-color','#d2d6de');
  }

  $("#target_date").prop('readonly', false);


  var xyz = $('#assetList option').filter(function() {

    return this.value == assetCode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
    
     $("#assetCode").val('');
     $('#assetName').val('');
  }else{
    
     $("#assetCode").val(assetCode);
     $('#assetName').val(msg);
    
  }

});

$('#asset_code').on('change',function(){


  var assetCode = $(this).val();

  var targetDt = $("#target_date").val();



  if(assetCode){

    $('#asset_code').css('border-color','#d2d6de');
  }else{
    $('#asset_code').css('border-color','#d2d6de');
    $('#asset_code').css('border-color','#ff0000').focus();
  }

  if(targetDt==''){
    $('#target_date').css('border-color','#d2d6de');
    $('#target_date').css('border-color','#ff0000').focus();
  }else{
    $('#target_date').css('border-color','#d2d6de');
  }

  $("#target_date").prop('readonly', false);


  var xyz = $('#assetList option').filter(function() {

    return this.value == assetCode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
    
     $("#assetCode").val('');
     $('#assetName').val('');
  }else{
    
     $("#assetCode").val(assetCode);
     $('#assetName').val(msg);
    
  }

});

$('#target_date').on('change',function(){


  var targetDate = $(this).val();

  var completDate = $("#complete_date").val();




  $("#targetDate").val(targetDate);


  if(targetDate){
    $('#target_date').css('border-color','#d2d6de');
  }else{
    $('#target_date').css('border-color','#d2d6de');
    $('#target_date').css('border-color','#ff0000').focus();
  }


  if(completDate==''){
    $('#complete_date').css('border-color','#d2d6de');
    $('#complete_date').css('border-color','#ff0000').focus();
  }else{
    $('#complete_date').css('border-color','#d2d6de');
  }

  $("#complete_date").prop('readonly', false);

});


$('#job_type').on('change',function(){


  var job_type = $(this).val();


  if(job_type){
    $('#job_type').css('border-color','#d2d6de');
  }else{
    $('#job_type').css('border-color','#d2d6de');
    $('#job_type').css('border-color','#ff0000').focus();
  }


var xyz = $('#jobTypeList option').filter(function() {

    return this.value == job_type;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){

    $("#jobtype").val('');
    
     
  }else{
    
     $("#jobtype").val(job_type);
    
    
  }


 ;

});

$('#complete_date').on('change',function(){


  var completeDate = $(this).val();

  $("#completeDate").val(completeDate);


  if(completeDate){
    $('#complete_date').css('border-color','#d2d6de');
  }else{
    $('#complete_date').css('border-color','#d2d6de');
    $('#complete_date').css('border-color','#ff0000').focus();
  }

  $("#ItemCodeId1").prop('readonly', false);

});

</script>


<script type="text/javascript">
  
 function ItemCodeGet(ItemId,itemcodeurl,quaitemurl){
   
      var ItemCode =  $('#ItemCodeId'+ItemId).val();

     // console.log('url',quaitemurl);
   // alert(itemcodeurl);return false;

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
            $('#viewItemDetail'+ItemId).addClass('showdetail');
            $('#itemNameTooltip'+ItemId).addClass('tooltiphide');
            $('#stockavlble'+ItemId).html('');
            $('#stockavlblevalue'+ItemId).val('');
            $('#batchno'+ItemId).html(''); 

      }else{

         document.getElementById("Item_Name_id"+ItemId).value = msg;

         
        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide'); 

         $('#itemNameTooltip'+ItemId).html(msg); 

         $('#qty'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false); 

        $('#vr_date,#series_code,#Plant_code,#account_code,#due_days,#emp_code,#cost_center_code,#asset_code,#target_date,#complete_date,#equip_code,#job_type').prop('readonly',true); 

      }

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });
      if(ItemCode){
      $.ajax({

          url:itemcodeurl,

          method : "POST",

          type: "JSON",

          data: {ItemCode: ItemCode},

           success:function(data){

                var data1 = JSON.parse(data);
              
              //  console.log('ITEM TYPE',data1.data_hsn[0].ITEMTYPE_CODE);

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
                    
                          $('#viewItemDetail'+ItemId).removeClass('showdetail');

                          $('#UnitM'+ItemId).val(data1.data[0].UM_CODE);

                          $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                          $('#Cfactor'+ItemId).val(data1.data[0].AUM_FACTOR);

                          $('#scrab_code'+ItemId).val(data1.data_hsn[0].SCRAP_CODE);
                          
                          $('#item_type'+ItemId).val(data1.data_hsn[0].ITEMTYPE_CODE);


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

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/


      setTimeout(function() {

          $.ajax({

            type: 'POST',

            url: quaitemurl,

            data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

             // console.log(data1);

              if(data1.data==''){
                    $("#CalcTax"+ItemId).hide();
                  
                    
                    $("#qPnotfountbtn"+ItemId).html('Not Found');

              }else{
                  $("#CalcTax"+ItemId).prop('disabled',false);
                  $("#CalcTax"+ItemId).show();
                  $("#qPnotfountbtn"+ItemId).html('');
              }
           //  console.log(data1.data);
            }

        });


      }, 500);

    }else{}

  }

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

              url: "{{ url('/finance/save-purchase-indent-transaction') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                /*console.log(data);*/
               var url = "{{url('/finance/view-purchase-indent-msg')}}"
              setTimeout(function(){ window.location = url+'/savedata'; });
              },

          });

    });

});

</script>


<script type="text/javascript">
   $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

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
	function Getqunatity(qtyId){

     var checkqty =$('#qty'+qtyId).val();
     var stockqty =$('#stockavlblevalue'+qtyId).val();
     console.log('qty',checkqty);

     /* if(parseFloat(checkqty) > parseFloat(stockqty)){
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
        
      }*/
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
        $('#qty'+qtyId).val(formatted);
      }

     
     $('#A_qty'+qtyId).val(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

      if(quantity){
        $('#rate'+qtyId).prop('readonly',false);
        $("#submitdata").prop('disabled', false);
        $("#submitNDwn").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);

        

      }else{
         $('#rate'+qtyId).prop('readonly',true);
         $('#A_qty'+qtyId).val(0.00);
          $("#submitdata").prop('disabled', true);
          $("#submitNDwn").prop('disabled', true);
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

     }else{
      $('#A_qty'+qtyId).val(0.00);

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
</script>

<script type="text/javascript">
  
  function getvrnoBySeries(){

    var seriesCode = $('#series_code').val();
    var transcode = $('#transcode').val();

    //alert(transcode);

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
  function submitData11(){

    
     $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

     var data = $("#salesordertrans").serialize();

    var submitdataurl = "<?php echo url('/finance/save-store-requisition-transaction'); ?>";

   //alert(submitdataurl);return false;

      $.ajax({

              type: 'POST',

              url: submitdataurl,

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                
               var url = viewaurl;

             
             
               setTimeout(function(){ window.location = url+'/savedata'; });

           
              },

          });

  }
</script>
<script type="text/javascript">

function submitAllData(downVal){

      var downloadFlg = downVal;
      $('#donwloadStatus').val(downloadFlg);

      var trcount=$('table tr').length;

      var valuetax= [];
      for(var y=0;y<trcount;y++){
        var trid = y+1;
       var ifnotaply = $('#qpApplyOrNot'+trid).html();

        valuetax.push(ifnotaply);
       
      }

      var found = valuetax.find(function (element) {
        return element == 0;
        });

     // console.log('found',found);
     // return false;
       
      if(found == 0){
          $("#taxNotAppied").modal('show');
      }else{


          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });
 
        


          var submitdataurl = "<?php echo url('/Transaction/Maintenance/Equipment-Job-Crad-Trans-Save'); ?>";

          //alert(submitdataurl);return false;

          $.ajax({

              type: 'POST',

              url: submitdataurl,

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

             //   console.log(data);

                    var data1 = JSON.parse(data);

                if (data1.response == 'error') {
                  var responseVar = false;
                  var url = "{{ url('/Transaction/view-job-card-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });
                }else{
                   var responseVar = true;
                  if(downloadFlg == 1){
                   var fyYear = data1.data[0].FY_CODE;
                    var fyCd = fyYear.split('-');
                    var seriesCd = data1.data[0].SERIES_CODE;
                    var vrNo = data1.data[0].VRNO;
                    var fileN = 'JOB_'+fyCd[0]+''+seriesCd+''+vrNo;
                    var link = document.createElement('a');
                    link.href = data1.url;
                    link.download = fileN+'.pdf';
                    link.dispatchEvent(new MouseEvent('click'));
                  }

                 var url = "{{ url('/Transaction/view-job-card-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }
                
               var url = viewaurl;

             
             
               setTimeout(function(){ window.location = url+'/savedata'; });

           
              },

          });
      }
  }
</script>
@endsection