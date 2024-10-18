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
  .rightcontent{

  text-align:right;


}
::placeholder {
  
  text-align:left;
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

  margin-top: 18% !important;

  font-weight: 600 !important;

  font-size: 10px !important;

}
.viewbtnitem{
    padding-bottom: 0px;
    padding-top: 0px;
    font-size: 12px;
    margin-bottom: 1px;
    margin-top: 2px;
}
.showdetail{
  display: none;
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
        Purchase Enquiry Transaction
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
          <a href="{{ url('/Transaction/Purchase/Purchase-Enquiry-Trans') }}"> Purchase Enquiry</a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Enquiry Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('Transaction/Purchase/View-Purchase-Enquiry-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

                                if($get_Month > 3 && $get_year == $fyYear[1]){
                                    $vrDate = $ToDate;
                                }else{
                                    $vrDate = $CurrentDate;
                                }

                              ?>

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control transdatepicker rightcontent" name="vr" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

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

                              <input type="text" class="form-control" name="tran" value="<?php if(isset($trans_head)){echo $trans_head;}?>" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

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

                            <div class="input-group-addon">

                              <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                            </div>
                            <?php $scount = count($series_list); ?>
                            <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="<?php if($scount == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" onchange="getvrnoBySeries();" maxlength="6" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

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


                              <input type="text" class="form-control" name="tran" value="<?php if($scount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" readonly autocomplete="off">

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

                            <input type="hidden" name="" value="<?php if(isset($to_num)){echo $to_num;}?>" id="vr_last_num">

                            <input type="text" class="form-control rightcontent" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

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

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <?php $plcount = count($plant_list); ?>
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="6" autocomplete="off" onchange="getpfctData();indentData();" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE; }?>">

                              <datalist id="PlantcodeList">

                                 <option value="">--SELECT--</option>

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

                              <input type="text" class="form-control" name="plantname" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME; }?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

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
                              
                              <input  id="profitctrId" name="pfct" class="form-control  pull-left" value="" maxlength="6" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">


                            </div>

                          <small id="profit_center_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                    </div> <!-- row -->

                    <div class="row">


                      <div class="col-md-4">

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

                          <label>Tax Code: 
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <?php $taxcount = count($tax_code_list); ?>
                              <input list="TaxcodeList"  id="tax_code" name="taxcode" class="form-control  pull-left" maxlength="6" value="<?php if($taxcount == 1){echo $tax_code_list[0]->TAX_CODE;}else{echo old('taxcode');} ?>" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

                              <datalist id="TaxcodeList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($tax_code_list as $key)

                                  <option value='<?php echo $key->TAX_CODE?>'   data-xyz ="<?php echo $key->TAX_NAME; ?>" ><?php echo $key->TAX_NAME ; echo " [".$key->TAX_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small id="Taxcode_errr" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Due Days: 
                            <span class="required-field"></span>
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="due_days" name="due_days" class="form-control  pull-left Number" value="{{ old('due_days')}}" placeholder="Enter Due Days"  autocomplete="off" style="text-align: end;" readonly>

                            </div>

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Due Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            
                              <input type="text" class="form-control rightcontent" name="due_date" id="due_date"  placeholder="Select Due Date" autocomplete="off" readonly>

                            </div>
                        </div>
                            <!-- /.form-group -->
                      </div>


                    </div> <!-- row -->

                    <div class="row">
                          <!-- /.col -->
                      <div class="col-md-3">
                        <a class="btn btn-info"  href="#tab2info" data-toggle="tab" style="margin-top: 26px;" id="nextbtn" >Next&nbsp;&nbsp;<i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
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

                                <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="{{ $vrDate }}" placeholder="Select Party Ref Date" autocomplete="off">

                              </div>

                              <small id="showmsgfordate_1" style="color: red;"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                      {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                            </div>
                            <!-- /.form-group -->
                          </div>
                          
                          <div class="col-md-4">

                            <div class="form-group">

                              <label>Consine Code : <span class="required-field"></span></label>

                                <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>

                                  <input list="consineList"  id="consine_code" name="consine" class="form-control pull-left" value="{{ old('consine')}}" placeholder="Select consine" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                                  <datalist id="consineList">

                                    <option selected="selected" value="">-- Select --</option>

                                    @foreach ($acc_list as $key)

                                    <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                                    @endforeach

                                  </datalist>

                                </div>

                                <small id="cosnicode_err" style="color: red;" class="form-text text-muted"> </small>

                                <small> <div class="pull-left showSeletedName" id="consineText"></div> </small>

                                <!-- <small id="consine_code_errr" style="color: red;"></small> -->

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

                                  <input type="text" class="form-control" autocomplete="off" name="Rfhead_2" placeholder="Enter Rfhead2" maxlength="30" id="rfhead2" oninput="rfheadget(2)">

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

                                  <input type="text" class="form-control" name="Rfhead_3" id="rfhead3" placeholder="Enter Rfhead3" maxlength="30" oninput="rfheadget(3)" autocomplete="off">

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


  <form id="salesordertrans">
        @csrf

  <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <input type ="hidden" name="comp_name" id="getCompName">
                  <input type ="hidden" name="fy_year" id="getFyYear">
                  <input type ="hidden" name="trans_date" id="getTransDate">
                  <input type ="hidden" name="vr_no" id="getVrNo">
                  <input type ="hidden" name="trans_code" id="getTransCode">
                  <input type ="hidden" name="accountCode" id="getAccCode">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="pfct_name" id="getPfctName">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="plant_name" id="getPlantName" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME; }?>">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
                  <input type ="hidden" name="series_name" value="<?php if($scount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="getSeriesName">
                  <input type ="hidden" name="tax_code" id="getTaxCode">
                  <input type ="hidden" name="getdue_date" id="getdue_date">
                  
                  <input type ="hidden" name="party_ref_no" id="getpartyrfNo">
                  <input type ="hidden" name="party_ref_date" id="getpartyrfDate">
                  <input type ="hidden" name="consine_code" id="getcosine">
                  <input type ="hidden" name="rfhead1" id="getrfhead1">
                  <input type ="hidden" name="rfhead2" id="getrfhead2">
                  <input type ="hidden" name="rfhead3" id="getrfhead3">
                  <input type ="hidden" name="rfhead4" id="getrfhead4">
                  <input type ="hidden" name="rfhead5" id="getrfhead5">



                  <tr>

                    <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 10px;"> Sr.No.</th>

                    <th>Indent No</th>

                    <th>Indent Date</th>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty</th>

                    <th>A-Qty</th>

                    <th>Action</th>

                  </tr>

                  <tr class="useful">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstcechk1" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum1' style="width: 10px;">1.</span>
                    </td> 

                     <td class="tdthtablebordr">

                      <input List="indentnoList1" class="debitcreditbox inputboxclr cr_amount SetInCenter" onchange="getIndentNo(1)" id='indentno1' name="indent_no[]" autocomplete="off"  style="width: 97px" readonly />

                      	<datalist id="indentnoList1">
                      	</datalist>


                    </td>

                    <td class="tdthtablebordr">

                       <input type="text" name="indent_date[]" id="indent_date1" class="form-control" autocomplete="off" style="width: 91px;margin-top: 19%;height: 22px;" readonly>

                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group">
                        <input list="ItemList1" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId1' name="item_code[]" onchange="getItemName(1)" value="" autocomplete="off" oninput="this.value = this.value.toUpperCase()" readonly /> 

                           <datalist id="ItemList1">


                          </datalist>
                      </div>
                      <input type="hidden" name="indentHeadId[]" id="indend_headId1">
                      <input type="hidden" name="indentBodyId[]" id="indend_bodyId1">

                      <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1" onclick="showItemDetail(1)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>
                      <div class="divhsn" id="showHsnCd1"></div>
                      <input type="hidden" id="hsn_code1" name="hsn_code[]">
                      <input type="hidden" id="taxByItem1" name="tax_byitem[]">
                      <input type="hidden" id="taxratebytax1" value="">
                    </td>

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id1' name="item_name[]" value="" readonly autocomplete="off" />

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>

                      <textarea id="remark_data1" rows="1" style="width: 190px;margin-bottom: 2%;" autocomplete="off" class="" name="remark[]" placeholder="Enter Description"></textarea>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount getqtytotal inputboxclr SetInCenter"  id='qty1' name="qty[]" onclick="showbtn(1)" oninput="CalAQty(1)" style="width: 80px" autocomplete="off" readonly />

                      <input type="text" name="unit_M[]" id="UnitM1" autocomplete="off" class="inputboxclr SetInCenter AddM" readonly="">

                      <input type="hidden" id="Cfactor1">

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty1' name="Aqty[]" autocomplete="off" style="width: 80px" readonly />

                      <input type="text" name="add_unit_M[]" id="AddUnitM1" class="inputboxclr SetInCenter AddM" autocomplete="off" readonly>

                      <input type="hidden" name="indtcode[]" id="indtcode1" class="inputboxclr SetInCenter AddM">
                      <input type="hidden" name="indseriescode[]" id="indseriescode1" class="inputboxclr SetInCenter AddM">
                      <input type="hidden" name="inslno[]" id="inslno1" class="inputboxclr SetInCenter AddM">
                      <input type="hidden" name="indvrno[]" id="indvrno1" class="inputboxclr SetInCenter AddM">





                      </div>

                    </td>

                    <td>

                      <input type="hidden" id='quaP_count1' value="0" name="quaP_count[]" class="quaPcountrow">
                      
                      <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="qltParamter1" data-toggle="modal" data-target="#quality_parametr1" onclick="qty_parameter(1)" style="padding-bottom: 0px;padding-top: 0px;" disabled>Quality Parametr </button>

                			<div id="appliedbtn1"></div>
                    	<div id="cancelbtn1"></div>
                      <div id="qpApplyOrNot1" class="aplynotStatus">0</div>
                      <small id="qPnotfountbtn1" class="label label-danger"></small>

                    </td> 

                  

                  </tr>

                </table>

              </div>


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
.texIndbox2{
  width: 45%; 
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
.itmdetlheading1{
  vertical-align: middle !important;
  text-align: center;
  width: 40%;
}
.rateBox{
  width: 20%;
  text-align: center;
  vertical-align: middle !important;
}
.amountBox{
  width: 20%;
  text-align: center;
  vertical-align: middle !important;
}
.inputtaxInd{
  background-color: white !important;
  border: none;
  text-align: center;
  height: 25px;
}
.showind_Ch{
  display: none;
}
</style>    

      <br>

        <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

        <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

        


     
  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

<style type="text/css">
  /* DivTable.com */
.divTable{
  display: table;
  width: 100%;
}
.divTableRow {
  display: table-row;
}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
}
.divTableCell, .divTableHead {
  border: 1px solid #999999;
  display: table-cell;
  padding: 3px 8px;
  text-align: center;
    font-weight: bold;
  

}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
  font-weight: bold;
}
.divTableFoot {
  background-color: #EEE;
  display: table-footer-group;
  font-weight: bold;
}
.divTableBody {
  display: table-row-group;
}
</style>
<!-- start enquiry vendor--->

<section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">


  <div class="divTable">
    <div class="divTableBody">
      <div class="divTableRow trrowget">
        
        <div class="divTableCell"></div>
        <div class="divTableCell">Sr.No</div>
        <div class="divTableCell">Acc Code</div>
        <div class="divTableCell">Acc Name</div>
        <div class="divTableCell">City</div>
        <div class="divTableCell">Contact No</div>
        
      </div>
    <div class="divTableRow rowcount TextBoxesGroup_1 trrowget">

          <div class="divTableCell">
            <div class='TextBoxesGroup'>
            <div id="TextBoxDiv1" style="padding-bottom: 10px;">
              
            <input type="checkbox" class="casecheck" id="tablesecnd1">
            </div>
          </div>
        </div>
      
            <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1" style="padding-bottom: 10px;">
              <span id="snumtwo1">1.</span>
              </div>
            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1" style="padding-top: 10px;">

              <input list="accList1" type='textbox' id='acc_code1' onchange="accCodeGet(1);" style="width: 103px;" name="enqacc_code[]">
             
              <datalist id="accList1">
                <option value="">-- Select --</option>
                  @foreach($acc_list as $key)
                    <option value="<?php echo $key->ACC_CODE?>"   data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?>
                      
                    </option>
                  @endforeach
                </datalist>
              </div>
              <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewAccDetail1" data-toggle="modal" data-target="#view_AccD1" onclick="showAccountDetail(1)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>


            </div></div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1" style="padding-bottom: 10px;" class="tooltips">
              <input type='textbox' id='acc_name1' value="" name="enqacc_name[]" readonly>

              <small class="tooltiptext tooltiphide" id="accountNameTooltip1"></small>
              </div>
            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1" style="padding-bottom: 10px;">
              <input type='textbox' id='city1' value="" name="city_name[]">
              </div>
            </div></div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1" style="padding-bottom: 10px;">
              <input type='textbox' id='phone1' value="" name="contact_no[]" style="width: 100px;" maxlength="10">
              </div>
            </div></div>

            
           
    </div>

  
    
    </div>

 </div>
  <div class="col-md-12"></div><br>
  <div class="row">
      <div class="col-md-12">

    <!-- <input type='button' value='Delete' id='removeButton' class="btn btn-danger btn-sm removeBtntbl"> -->
    <!-- <input type='button' value='Add More' id='addButton' class="btn btn-primary btn-sm"> -->

    <button type="button" class='btn btn-danger btn-sm removeBtntbl' id="removeButton"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

    <button type="button" class='btn btn-primary btn-sm' id="addButton" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;" ></i>&nbsp; Add More</button>
    
    </div>

  </div>
  		<p class="text-center">
          <input type="hidden" id="donwloadStatus" name="donwloadStatus">
          <button class="btn btn-success" type="button" id="submitdata" onclick="submitAllDt(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

          <button class="btn btn-success" type="button" id="submitNDwn" onclick="submitAllDt(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true" ></i>&nbsp;&nbsp; Save & Download</button>

        </p>

       <!--  quality parameter modal -->

       <div class="modal fade" id="quality_parametr1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">
                <input type='hidden' id='itmOnQp1'>
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

       <!--  quality parameter modal -->

<!-- show modal when click on view btn after item select item -->

        <div class="modal fade" id="view_detail1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel" style="text-align: center;">Item Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox2">Item Name</div>
                    <div class="box10 rateIndbox">HSN Code</div>
                    <div class="box10 rateBox">Item Detail</div>
                    <div class="box10 amountBox">Item Type</div>
                    <div class="box10 amountBox">Item Group</div>
                    <div class="box10 amountBox">Item Class</div>
                    <div class="box10 amountBox">Item Category</div>
                  </div>
                  
                  <div class="box-row">
                    <div class="box10 itmdetlheading">
                      <span id="itemCodeshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="hsncodeshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="itemDetailshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="itemtypeshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="itemgroupshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="itemclassshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="itemcategoryshow1"> </span>
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

<!-- show modal when click on view btn after account select -->

        <div class="modal fade" id="view_AccD1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel" style="text-align: center;">Account Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox1">Acc Code</div>
                   
                    <div class="box10 rateIndbox">Acc Type Code</div>
                    <div class="box10 rateIndbox">Acc Category Code</div>
                    <div class="box10 rateBox">Acc Class Code</div>
                    <div class="box10 amountBox">GST Type</div>
                    <div class="box10 amountBox">GST No</div>
                  </div>
                  
                  <div class="box-row">
                    <div class="box10 itmdetlheading1">
                      <span id="accCodeshow1"> </span>
                    </div>
                    
                    <div class="box10 itmdetlheading">
                      <span id="acctypecodeshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="acccatshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="accclassshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="gsttypsshow1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="gstnoshow1"> </span>
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
<!-- show modal when click on view btn after account select -->

 <!-- when quality parameter not applied then show model -->

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
      <!-- when quality parameter not applied then show model -->


          </div>



        </div>
      </div>
    </div>  
</section>

</form>
<!-- end enquiry vendor--->
</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/purchaseEnqT.js') }}" ></script>

<script type="text/javascript">

	
	function getItemName(itemid){
		//console.log(itemid);

      var itemcode =  $('#ItemCodeId'+itemid).val();
      var indenno =  $('#indentno'+itemid).val();

      var indvrno = indenno.split(' ');
      var indentno = indvrno[2];

      var xyz = $('#ItemList'+itemid+' option').filter(function() {

        return this.value == itemcode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';


       $('#itemNameTooltip'+itemid).removeClass('tooltiphide');
       $('#itemNameTooltip'+itemid).html(msg);

      if(msg == 'No Match'){
        $('#ItemCodeId'+itemid).val('');
        $('#Item_Name_id'+itemid).val('');
        $('#indend_headId'+itemid).val('');
        $('#indend_bodyId'+itemid).val('');
        $('#qty'+itemid).val('');
        $("#UnitM"+itemid).val('');
        $("#itmOnQp"+itemid).val('');
        $("#A_qty"+itemid).val('');
        $("#AddUnitM"+itemid).val('');
        $("#indtcode"+itemid).val('');
        $("#indseriescode"+itemid).val('');
        $("#inslno"+itemid).val('');
        $("#indvrno"+itemid).val('');
        $('#submitdata').prop('disabled',true);
        $('#submitNDwn').prop('disabled',true);
        $('#viewItemDetail'+itemid).addClass('showdetail');
        $('#qltParamter'+itemid).prop('disabled',true);
        $('#itemNameTooltip'+itemid).addClass('tooltiphide');
        $("#quaP_count"+itemid).val(0);
        $("#qpApplyOrNot"+itemid).html('0');
        $('#appliedbtn'+itemid).empty();
        $('#cancelbtn'+itemid).empty();
        var cnclbtn ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelbtn'+itemid).append(cnclbtn);
      }else{

        $("#quaP_count"+itemid).val(0);
        $("#itmOnQp"+itemid).val('');
        $("#qpApplyOrNot"+itemid).html('0');
        $('#appliedbtn'+itemid).empty();
        $('#cancelbtn'+itemid).empty();
        var cnclbtn ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelbtn'+itemid).append(cnclbtn);

         var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });

        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        $.ajax({

          url:"{{ url('get-item-name-by-enquiry') }}",

          method : "POST",

          type: "JSON",

          data: {itemcode: itemcode,indentno:indentno},

           success:function(data){

                var data1 = JSON.parse(data);

                //console.log(data1);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                  var objTable = $('.divTableRow .TextBoxesGroup').find('span');
                  var checkAccAvail = $('#acc_code1').val();
                  if(objTable.length == 1 && checkAccAvail){
                    $('#submitdata').prop('disabled',false);
                    $('#submitNDwn').prop('disabled',false);
                  }else{
                    $('#submitdata').prop('disabled',true);
                    $('#submitNDwn').prop('disabled',true);
                  }

                    if(data1.data==''){
                      $("#indtcode"+itemid).val('');
                      $("#indseriescode"+itemid).val('');
                      $("#inslno"+itemid).val('');
                    }else{

                      $('#qltParamter'+itemid).prop('disabled',false);
                      $('#viewItemDetail'+itemid).removeClass('showdetail');

                      $("#Item_Name_id"+itemid).val(data1.data.ITEM_NAME);
                      $("#remark_data"+itemid).val(data1.data.REMARK);
                      $("#qty"+itemid).val(data1.data.QTYRECVD);
                      $("#UnitM"+itemid).val(data1.data.UM);

                      $("#A_qty"+itemid).val(data1.data.AQTYRECD);
                      $("#AddUnitM"+itemid).val(data1.data.AUM);

                      $("#indtcode"+itemid).val(data1.data.TRAN_CODE);

                      $("#indseriescode"+itemid).val(data1.data.SERIES_CODE);

                      $("#inslno"+itemid).val(data1.data.SLNO);
                      $("#indvrno"+itemid).val(data1.data.VRNO);
                      $("#indend_headId"+itemid).val(data1.data.PINDHID);
                      $("#indend_bodyId"+itemid).val(data1.data.PINDBID);


                      
                      $("#addmorhidn").prop('disabled', false);
                      $("#deletehidn").prop('disabled', false);

                      gr_amt =0;

                       $(".getqtytotal").each(function () {
                            //add only if the value is number
                            if (!isNaN(this.value) && this.value.length != 0) {
                                gr_amt += parseFloat(this.value);
                            }

                          $("#basicTotal").val(gr_amt.toFixed(2));


                        });

                    }

                    if(data1.datafactor==''){

                    }else{
                      $('#Cfactor'+itemid).val(data1.datafactor.aum_factor);
                    } 

                    if(data1.qp_data==''){
                        $("#qltParamter"+itemid).hide();
                        $("#qPnotfountbtn"+itemid).html('Not Found');
                        $('#cancelbtn'+itemid).html('');
                    }else{
                        $("#qltParamter"+itemid).show();
                        $("#qPnotfountbtn"+itemid).html('');
                    }
                  
                    


                var allGrandAmount = parseFloat($('#basicTotal').val());

                } /*if close*/

           }  /*success function close*/

        });  /*ajax close*/

      }

  }/*function close*/
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
         $('#itmOnQp'+getvalue).val('');
        
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
	
	function getIndentNo(indentno){

      var indNo =  $('#indentno'+indentno).val();

      var indvrno = indNo.split(' ');
      var IndentNo = indvrno[2];

      var xyz = $('#indentnoList'+indentno+' option').filter(function() {

        return this.value == indNo;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#indentno'+indentno).val('');
        $('#indent_date'+indentno).val('');
        $('#Item_Name_id'+indentno).val('');
        $('#remark_data'+indentno).val('');
        $('#qty'+indentno).val('');
        $('#A_qty'+indentno).val('');
        $('#UnitM'+indentno).val('');
        $('#AddUnitM'+indentno).val('');
        $('#ItemCodeId'+indentno).val('');
        $("#ItemList"+indentno).empty();

        var bsic_amt = 0;

        $(".getqtytotal").each(function () {
          //add only if the value is number
          if (!isNaN(this.value) && this.value.length != 0) {
              bsic_amt += parseFloat(this.value);
          }
         // console.log(bsic_amt);
          $("#basicTotal").val(bsic_amt.toFixed(2));

        });

      }else{

        $('#indent_date'+indentno).val('');
        $('#Item_Name_id'+indentno).val('');
        $('#remark_data'+indentno).val('');
        $('#qty'+indentno).val('');
        $('#A_qty'+indentno).val('');
        $('#UnitM'+indentno).val('');
        $('#AddUnitM'+indentno).val('');
        $('#ItemCodeId'+indentno).val('');
        $("#ItemList"+indentno).empty();

        var bsic_amt = 0;

        $(".getqtytotal").each(function () {
          //add only if the value is number
          if (!isNaN(this.value) && this.value.length != 0) {
              bsic_amt += parseFloat(this.value);
          }
         // console.log(bsic_amt);
          $("#basicTotal").val(bsic_amt.toFixed(2));

        });
        
        $('#series_code,#Plant_code,#tax_code,#due_days,#vr_date,#party_rf_no,#consine_code,#rfhead1,#rfhead2,#rfhead3,#rfhead4,#rfhead5').prop('readonly',true);
        $('#party_ref_date').prop('disabled',true);

        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        $.ajax({

            url:"{{ url('get-indent-no-by-enquiry') }}",

            method : "POST",

            type: "JSON",

            data: {IndentNo: IndentNo},

             success:function(data){

                  var data1 = JSON.parse(data);

                  //console.log(data1);

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                    $("#ItemList"+indentno).empty();

                    $('#ItemCodeId1').prop('readonly',false);
                    
                    $.each(data1.data, function(k, getData){

                        var indendDate = getData.VRDATE;
                        var slipD =  indendDate.split('-');

                        var vrDate = slipD[2]+'-'+slipD[1]+'-'+slipD[0];
                      
                      $("#indent_date"+indentno).val(vrDate);


                      $("#ItemList"+indentno).append($('<option>',{

                        value:getData.ITEM_CODE,

                        'data-xyz':getData.ITEM_NAME,
                        text:getData.ITEM_NAME


                      }));

                    }); 
                        

                  } /*if close*/

             }  /*success function close*/

        });  /*ajax close*/
      }

   
      

  }/*function close*/

  function showItemDetail(viewid){

    var ItemCode =  $('#ItemCodeId'+viewid).val();

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

    $.ajax({

            type: 'POST',

            url: "{{ url('get-item-um-aum') }}",

            data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

             // console.log(data1);

              if(data1.data==''){
                   
              }else{  
                    //console.log();
                  $("#itemCodeshow"+viewid).html(data1.data_hsn.ITEM_NAME+'<p>('+data1.data_hsn.ITEM_CODE+')</p>');
                  $("#hsncodeshow"+viewid).html(data1.data_hsn.HSN_CODE);
                  $("#taxcodeshow"+viewid).html(data1.data_hsn.TAX_CODE);
                  $("#itemDetailshow"+viewid).html(data1.data_hsn.ITEM_DETAIL);
                  $("#itemtypeshow"+viewid).html(data1.data_hsn.TAX_TYPE);
                  $("#itemgroupshow"+viewid).html(data1.data_hsn.ITEMGROUP_CODE);
                  $("#itemclassshow"+viewid).html(data1.data_hsn.ITEMCLASS_CODE);
                  $("#itemcategoryshow"+viewid).html(data1.data_hsn.ICATG_CODE);
              }
           //  console.log(data1.data);
            }

        });

  }

  function qty_parameter(qty){

   var ItemCode = $("#ItemCodeId"+qty).val();
   var indHeadId = $("#indend_headId"+qty).val();
   var indBodyId = $("#indend_bodyId"+qty).val();
   var ItemCodeOnQp = $("#itmOnQp"+qty).val();

   if(ItemCodeOnQp == ''){
    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/get-qty-parameter-frm-indend-by-itm') }}",

            data: {ItemCode:ItemCode,indHeadId:indHeadId,indBodyId:indBodyId}, // here $(this) refers to the ajax object not form

            success: function (data) {


              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      if(data1.data==''){

                        }else{

                          $('#qua_par_'+qty).empty();
                           //$('#footer_qaulity_btn'+qty).empty();
                           // $('#footer_ok_btn'+qty).empty();


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);

                        var sr_no=1;
                          $.each(data1.data, function(k, getData) {



                            if(data1.item_code){
                              var item_code = data1.item_code;
                            }else if(getData.item_code){
                               var item_code = getData.ITEM_CODE;
                            }

                            if(getData.IQUA_CODE){
                              var IQUACHAR = getData.IQUA_CODE;
                            }else if(getData.IQUA_CHAR){
                               var IQUACHAR = getData.IQUA_CHAR;
                            }

                            if(getData.CHAR_FROMVALUE){
                              var FROM_VALUE = getData.CHAR_FROMVALUE;
                            }else if(getData.VALUE_FROM){
                               var FROM_VALUE = getData.VALUE_FROM;
                            }

                            if(getData.CHAR_TOVALUE){
                              var TO_VALUE = getData.CHAR_TOVALUE;
                            }else if(getData.VALUE_TO){
                               var TO_VALUE = getData.VALUE_TO;
                            }

                            $('#itmOnQp'+qty).val(item_code);

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.ICATG_CODE+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+IQUACHAR+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+FROM_VALUE+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+TO_VALUE+" ></div></div> ";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });


                          var butn =  $('#footer_quality_btn'+qty).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+qty+"' onclick='getvalue("+qty+",1)' style='width: 36px;'>Ok</button>";

                           $('#footer_quality_btn'+qty).append(tblData);

                             var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'   onclick='getvalue("+qty+",0)'>Cancel</button>";
                             
                           $('#footer_ok_btn'+qty).append(cancelfooter);

                         }else{
                          
                         }

                        }

                    }
           
            
            },

        });
  }else{}



  }
</script>
  
 <script type="text/javascript">

$(document).ready(function(){

    var counter = 2;
        
    $("#addButton").click(function () {
                
    if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
    }   
        
    var newTextBoxDiv = $(document.createElement('div'))
         .attr("class", 'rowcount' + counter);

         //onsole.log(counter);
         var count1 = counter-1;

    getcount=$('.divTableBody .trrowget').length;

    var newrow = '<div class="divTableRow rowcount TextBoxesGroup_'+counter+' trrowget"><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'" style="padding-bottom: 10px;"><input type="checkbox" class="casecheck" id="tablesecnd'+counter+'"></div> </div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;"><span id="snumtwo'+counter+'">'+getcount+'.</span></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-top: 10px;"><input list="accList'+counter+'" type="textbox" id="acc_code'+counter+'" name="enqacc_code[]" onchange="accCodeGet('+counter+');" style="width: 103px;"><datalist id="accList'+counter+'"><option value="">-- Select --</option>@foreach($acc_list as $key)<option value="<?php echo $key->ACC_CODE;?>" data-xyz ="<?php echo $key->ACC_NAME ?>"><?php echo $key->ACC_NAME;  ?></option>@endforeach</datalist></div><button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewAccDetail'+counter+'" data-toggle="modal" data-target="#view_AccD'+counter+'" onclick="showAccountDetail('+counter+')"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;" class="tooltips"><input type="textbox" name="enqacc_name[]" readonly id="acc_name'+counter+'" value=""><small class="tooltiptext tooltiphide" id="accountNameTooltip'+counter+'"></small></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;"><input type="textbox" name="city_name[]" id="city'+counter+'" value=""></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;"><input type="textbox" id="phone'+counter+'" name="contact_no[]" value="" style="width: 100px;"  maxlength="10"></div></div></div><div class="modal fade" id="view_AccD'+counter+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-md" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel" style="text-align: center;">Account Detail</h5></div></div></div><div class="modal-body table-responsive"><div class="boxer" id=""> <div class="box-row"> <div class="box10 texIndbox1">Acc Code</div> <div class="box10 rateIndbox">Acc Name</div> <div class="box10 rateIndbox">Acc Type Code</div> <div class="box10 rateIndbox">Acc Category Code</div><div class="box10 rateBox">Acc Class Code</div> <div class="box10 amountBox">GST Type</div><div class="box10 amountBox">GST No</div></div><div class="box-row"><div class="box10 itmdetlheading1"><small id="accCodeshow'+counter+'"> </small> </div> <div class="box10 itmdetlheading"> <small id="acctypecodeshow'+counter+'"> </small> </div> <div class="box10 itmdetlheading"> <small id="acccatshow'+counter+'"> </small> </div><div class="box10 itmdetlheading"> <small id="accclassshow'+counter+'"> </small></div> <div class="box10 itmdetlheading"> <small id="gsttypsshow'+counter+'"> </small> </div><div class="box10 itmdetlheading"> <small id="gstnoshow'+counter+'"> </small> </div> </div></div> </div> <div class="modal-footer" style="text-align: center;"><button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button></div></div></div></div></div>';

    //newTextBoxDiv.after().html(newrow);
            
    $(".divTableBody").append(newrow);

                
    counter++;
     });



     /*$("#removeButton").click(function () {
    var count2 = counter - 1;
       console.log(count2);

    if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
    counter--;
            
        $(".TextBoxesGroup_"+count2).remove();
            
     });*/
     $(".removeBtntbl").on('click', function() {
        $('.casecheck:checkbox:checked').parents(".trrowget").remove();
        //console.log('yes');

        checksectbl();
     });

     function checksectbl(){

    obj = $('.divTableRow .TextBoxesGroup').find('span'); 

    objfirst = $('table tr').find('span'); 


    if(obj.length==0){
      
      $('#submitdata').prop('disabled',true);
      $('#submitNDwn').prop('disabled',true);
    }else if(objfirst.length == 0){
      $('#submitdata').prop('disabled',true);
      $('#submitNDwn').prop('disabled',true);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;
          $('#'+id).html(key+1);

      });
    } 
      
  }

        
     $("#getButtonValue").click(function () {
        
    var msg = '';
    for(i=1; i<counter; i++){
      msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
    }
        alert(msg);
     });
  });
</script>

<script type="text/javascript">
  function accCodeGet(accId){

      var AccCode =  $('#acc_code'+accId).val();

      var xyz = $('#accList'+accId+' option').filter(function() {

        return this.value == AccCode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      $('#accountNameTooltip'+accId).removeClass('tooltiphide');
      $('#accountNameTooltip'+accId).html(msg);

      if(msg == 'No Match'){

        $('#phone'+accId).val('');
        $('#acc_code'+accId).val('');
        $('#acc_name'+accId).val('');
        $('#city'+accId).val('');
        $('#accountNameTooltip'+accId).addClass('tooltiphide');

        $('#viewAccDetail'+accId).addClass('showdetail');
         $('#addButton').prop('disabled',true);

      }else{

        $('#addButton').prop('disabled',false);

        $('#viewAccDetail'+accId).removeClass('showdetail');
                      

        $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      $.ajax({

          url:"{{ url('get-data-by-acc_code') }}",

          method : "POST",

          type: "JSON",

          data: {AccCode: AccCode},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                // console.log('data1.data',data1.data);

                    if(data1.data[0].CITY_CODE){
                      $("#city"+accId).prop('readonly',true);
                    }else{
                      $("#city"+accId).prop('readonly',false);
                    }
                    
                    $("#acc_name"+accId).val(data1.data[0].ACC_NAME);
                    $("#city"+accId).val(data1.data[0].CITY_CODE);
                    $("#phone"+accId).val(data1.data[0].CONTACT_NO);

                    $("#submitdata").prop('disabled',false);
                    $("#submitNDwn").prop('disabled',false);
                    

                    }
                   

                } /*if close*/

            /*success function close*/

      });  /*ajax close*/

      }

  }

  function showAccountDetail(acid){

    var AccCode =  $('#acc_code'+acid).val();

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

    $.ajax({

            type: 'POST',

            url: "{{ url('get-data-by-acc_code') }}",

            data: {AccCode:AccCode}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var data1 = JSON.parse(data);

             // console.log(data1);

              if(data1.data==''){
                   
              }else{  
                    //console.log();
                  $("#accCodeshow"+acid).html(data1.data[0].ACC_NAME+'<p>('+data1.data[0].ACC_CODE+')</p>');
                  $("#acctypecodeshow"+acid).html(data1.data[0].ATYPE_CODE);
                  $("#acccatshow"+acid).html(data1.data[0].ACATG_CODE);
                  $("#accclassshow"+acid).html(data1.data[0].ACLASS_CODE);
                  $("#gsttypsshow"+acid).html(data1.data[0].GST_TYPE);
                  $("#gstnoshow"+acid).html(data1.data[0].GST_NUM);
              }
           //  console.log(data1.data);
            }

        });

  }
</script>

<script type="text/javascript">

  $(document).ready(function() {

    $('#due_days').on('input',function(){
      
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
          }else{

          $("#due_date").val(duedate);
          $("#getdue_date").val(duedate);
          $('#due_days').css('border-color','#d2d6de');
           $('#indentno1').prop('readonly',false);
          }

         if (/\D/g.test(this.value))
          {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
          }

        }else{
          $('#due_date').val('');
          $("#getdue_date").val('');
          $('#indentno1').prop('readonly',true);
        }

        

       
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

  $(document).ready(function(){

    $( window ).on( "load", function() {

      getvrnoBySeries();

     var vrseqno = $('#vrseqnum').val();

     var vrlastnum = $('#vr_last_num').val();

      if(vrseqno == ''){

        $('#setdisable').prop('disabled',true);

      }else if(vrseqno==vrlastnum){

        $('#setdisable').prop('disabled',true);

      }else{

        $('#setdisable').prop('disabled',false);

      }


      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var Plant_code =  $('#Plant_code').val();
       // console.log(Plant_code);
      
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

                  if(data1.data == ''){
                       var profitget = '';
                       var profitctr = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctName').val(pfctName);
                       $('#getPfctCode').val(profitget);
                    }else{
                      $('#profitctrId').val(data1.data[0].PFCT_CODE);
                      $('#pfctName').val(data1.data[0].PFCT_NAME);
                      $('#getPfctName').val(data1.data[0].PFCT_NAME);
                      $('#getPfctCode').val(data1.data[0].PFCT_CODE);

                    }
                }

            }

          });


          setTimeout(function() {
          $.ajax({

            url:"{{ url('get-pfct-code-name') }}",

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){


                  $("#indentnoList1").empty();
                    console.log('data1.indend',data1.indend);
                  $.each(data1.indend, function(k, getData){

                    var yearf = getData.FY_CODE;

                    var startyear = yearf.split('-');

                    

                    $("#indentnoList1").append($('<option>',{

                      value:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,

                      'data-xyz':startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
                      text:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO


                    }));

                  }); 

                }

            }

          });
          }, 500);

    });

  });

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

  $(".delete").on('click', function() {

      $('.case:checkbox:checked').parents("tr").remove();

      $('.check_all').prop("checked", false); 

      var bsic_amt = 0;

       $(".getqtytotal").each(function () {
          //add only if the value is number
          if (!isNaN(this.value) && this.value.length != 0) {
              bsic_amt += parseFloat(this.value);
          }
         // console.log(bsic_amt);
        $("#basicTotal").val(bsic_amt.toFixed(2));

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

  function check(){

    obj = $('table tr').find('span'); 

    objtwo = $('.divTableRow .TextBoxesGroup').find('span'); 

    
    if(obj.length==0){
      $('#basicTotal').val(0.00);
      $("#allquaPcount").val(0);
      $('#submitdata').prop('disabled',true);
      $('#submitNDwn').prop('disabled',true);
    }else if(objtwo.length == 0){
      $('#submitdata').prop('disabled',true);
      $('#submitNDwn').prop('disabled',true);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;
          $('#'+id).html(key+1);

      });
    } 
      
  }


  var i=2;
  var adrow = 1;
  $(".addmore").on('click',function(){


      count=$('table tr').length;
      //console.log(count);

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> <input  type='hidden' name='tds_rate[]' id='TdsRateByAccCode"+i+"' class='getRateForAcc'><input type='hidden' name='tds_code[]' id='TdsSection"+i+"'><input type='hidden' name='' id='accNtdsrate"+i+"'></td>";

      data +="<td class='tdthtablebordr'><input List='indentnoList"+i+"' class='debitcreditbox inputboxclr cr_amount SetInCenter' onchange='getIndentNo("+i+")' id='indentno"+i+"' autocomplete='off' name='indent_no[]'  style='width: 96px'/><datalist id='indentnoList"+i+"'></datalist></td><td class='tdthtablebordr'><input type='text' name='indent_date[]' autocomplete='off' id='indent_date"+i+"' class='form-control' style='width: 91px;margin-top: 19%;height: 22px;' readonly></td><td class='tdthtablebordr'><div class='input-group'><input list='ItemList"+i+"' class='inputboxclr SetInCenter' style='width: 90px;margin-bottom: 5px;' id='ItemCodeId"+i+"' autocomplete='off' name='item_code[]' onchange='getItemName("+i+")' value=''  oninput='this.value = this.value.toUpperCase()' /><datalist id='ItemList"+i+"'></datalist></div><input type='hidden' id='indend_headId"+i+"' name='indentHeadId[]'><input type='hidden' name='indentBodyId[]' id='indend_bodyId"+i+"'><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><input type='hidden' id='hsn_code"+i+"' name='hsn_code[]' value=''><div class='divhsn' id='showHsnCd"+i+"'></div><input type='hidden' id='taxByItem"+i+"' name='tax_byitem[]'><input type='hidden' id='taxratebytax"+i+"' value=''></td><td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' style='width: 190px;margin-bottom: 5px;' id='Item_Name_id"+i+"' name='item_name[]' autocomplete='off' readonly /><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></small><textarea id='remark_data"+i+"' autocomplete='off' rows='1' style='width: 190px;margin-bottom: 2%;' class='' name='remark[]' placeholder='Enter Description'></textarea></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox getqtytotal dr_amount inputboxclr SetInCenter' autocomplete='off' id='qty"+i+"' name='qty[]' onclick='showbtn("+i+")' oninput='CalAQty("+i+")' style='width: 80px' readonly/><input type='text' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr SetInCenter AddM' autocomplete='off' readonly><input type='hidden' id='Cfactor"+i+"'></div></td> <td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' autocomplete='off' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM' readonly><input type='hidden' name='indtcode[]' id='indtcode"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' name='indseriescode[]' id='indseriescode"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' name='inslno[]' id='inslno"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' name='indvrno[]' id='indvrno"+i+"' class='inputboxclr SetInCenter AddM'></div><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item Code</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading1'><small id='itemCodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='hsncodeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemDetailshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemtypeshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemgroupshow"+i+"'> </small></div><div class='box10 itmdetlheading'><small id='itemclassshow"+i+"'> </small> </div><div class='box10 itmdetlheading'><small id='itemcategoryshow"+i+"'> </small></div></div></div></div> <div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div> </div></div></div></td><td><input type='hidden' id='quaP_count"+i+"' value='0' name='quaP_count[]' class='quaPcountrow'><button type='button' class='btn btn-primary btn-xs tdsratebtn' id='qltParamter"+i+"' data-toggle='modal' data-target='#quality_parametr"+i+"' onclick='qty_parameter("+i+")' style='padding-bottom: 0px;padding-top: 0px;' disabled>Quality Parametr </button><div id='appliedbtn"+i+"'></div><div id='cancelbtn"+i+"'></div><div id='qpApplyOrNot"+i+"' class='aplynotStatus'>0</div><small id='qPnotfountbtn"+i+"' class='label label-danger'></small></td>";

      $('table').append(data);

      var qpdomModel ="<div class='modal fade' id='quality_parametr"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><input type='hidden' id='itmOnQp"+i+"'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Qaulity Parameter</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+i+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footer_ok_btn"+i+"'></small>&nbsp;<small style='text-align: center;' id='footer_quality_btn"+i+"'></small></center></div></div></div></div>";

      $('#quaPdomModel_2').append(qpdomModel);

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        var Plant_code =  $('#Plant_code').val();
      //  console.log(Plant_code);

          $.ajax({

            url:"{{ url('get-pfct-code-name') }}",

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){
              console.log(i);
              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  $("#indentnoList"+adrow).empty();
                  $.each(data1.indend, function(k, getData){

                    var yearf = getData.FY_CODE;

                    var startyear = yearf.split('-');

                    $("#indentnoList"+adrow).append($('<option>',{

                      value:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,

                      'data-xyz':startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
                      text:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO


                    }));

                  }); 

                  

                }

            }

          });

      i++;
      adrow++;

  });  /*--function close--*/

  function select_all() {

    $('input[class=case]:checkbox').each(function(){ 

      if($('input[class=check_all]:checkbox:checked').length == 0){ 

        $(this).prop("checked", false); 

      }else{

        $(this).prop("checked", true); 

      } 

    });
  }



</script>

<script type="text/javascript">

  function getpfctData(){

    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

    });

    var Plant_code =  $('#Plant_code').val();

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

                  if(data1.data == ''){
                       var profitget = '';
                       var profitctr = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctName').val(pfctName);
                       $('#getPfctCode').val(profitget);
                    }else{
                      $('#profitctrId').val(data1.data[0].PFCT_CODE);
                      $('#pfctName').val(data1.data[0].PFCT_NAME);
                      $('#getPfctName').val(data1.data[0].PFCT_NAME);
                      $('#getPfctCode').val(data1.data[0].PFCT_CODE);

                    }

                }

            }

          });

  }

  function indentData(){
    setTimeout(function() {

      var Plant_code =  $('#Plant_code').val();
      $.ajax({

            url:"{{ url('get-pfct-code-name') }}",

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  $("#indentnoList1").empty();
                  $.each(data1.indend, function(k, getData){

                    var yearf = getData.FY_CODE;

                    var startyear = yearf.split('-');

                    $("#indentnoList1").append($('<option>',{

                      value:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,

                      'data-xyz':startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
                      text:startyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO


                    }));

                  }); 

                }

            }

      });

    }, 500);
  }


</script>


<script type="text/javascript">

    function submitAllDt(downVal){

      var downloadFlg = downVal;
      $('#donwloadStatus').val(downloadFlg);

      var trcount=$('table tr').length;

      var valuetax= [];
      var valueQp= [];
      for(var y=0;y<trcount;y++){
        var trid = y+1;
       var ifnotaply = $('#qpApplyOrNot'+trid).html();
       var qpNotF = $('#qPnotfountbtn'+trid).html();

        valuetax.push(ifnotaply);
        valueQp.push(qpNotF);
       
      }

      var found = valuetax.find(function (element) {
        return element == 0;
      });

      var foundQp = valueQp.find(function (element) {
        return element == 'Not Found';
      });

      if((found == 0) && (foundQp!='Not Found')){
          $("#taxNotAppied").modal('show');
      }else{

          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/Transaction/Purchase/Save-Purchase-Enquiry-Trans') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  var responseVar = false;
                  var url = "{{url('/finance/view-enquiry-msg')}}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{
                  var responseVar = true;

                  if(downloadFlg == 1){
                    var ulrLenght = data1.url.length;
                    for(var q=0;q<ulrLenght;q++){
                      var link = document.createElement('a');
                      link.href = data1.url[q];

                      var fyYear   = data1.data[0].FY_CODE;
                      var fyCd     = fyYear.split('-');
                      var seriesCd = data1.data[0].SERIES_CODE;
                      var vrNo     = data1.data[0].VRNO;
                      var fileN    = 'PC_'+q+''+fyCd[0]+''+seriesCd+''+vrNo;
                      link.download = fileN+'.pdf';
                      link.dispatchEvent(new MouseEvent('click'));
                    }
                  }

                  var url = "{{url('finance/view-enquiry-msg')}}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }

              },

          });

      }
              
    }

$(document).ready(function(){
    $("#savedataAfterAlert").click(function(event) {

        var downloadFlg = $('#donwloadStatus').val();

        var data = $("#salesordertrans").serialize();

        $('.overlay-spinner').removeClass('hideloader');

        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/Transaction/Purchase/Save-Purchase-Enquiry-Trans') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    var responseVar = false;
                    var url = "{{url('/finance/view-enquiry-msg')}}"
                    setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{
                    var responseVar = true;

                    if(downloadFlg == 1){
                      var ulrLenght = data1.url.length;
                      for(var q=0;q<ulrLenght;q++){
                        var link = document.createElement('a');
                        link.href = data1.url[q];

                        var fyYear   = data1.data[0].FY_CODE;
                        var fyCd     = fyYear.split('-');
                        var seriesCd = data1.data[0].SERIES_CODE;
                        var vrNo     = data1.data[0].VRNO;
                        var fileN    = 'PC_'+q+''+fyCd[0]+''+seriesCd+''+vrNo;
                        link.download = fileN+'.pdf';
                        link.dispatchEvent(new MouseEvent('click'));
                      }
                    }

                    var url = "{{url('finance/view-enquiry-msg')}}"
                    setTimeout(function(){ window.location = url+'/'+responseVar; });

                }
            },

        });

    });
});



</script>



@endsection