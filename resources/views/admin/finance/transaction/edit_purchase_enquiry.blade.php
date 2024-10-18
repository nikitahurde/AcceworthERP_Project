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
      Enquiry Transaction
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
        <a href="{{ url('/finance/transaction/purchase-order-transaction') }}"> Enquiry Transaction</a>
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

              <a href="{{ url('finance/transaction/view-enquiry-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

                           
                                <input type="text" class="form-control transdatepicker rightcontent" name="vr" id="vr_date" value="<?php echo $getPurchasenquiry[0]->vr_date; ?>" placeholder="Select Date" autocomplete="off">

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

                                <input type="text" class="form-control" name="tran"  id="transcode" placeholder="Enter Transaction Head" value="<?php echo $getPurchasenquiry[0]->tran_code;?>" readonly autocomplete="off">

                                <input type="hidden" id="transtaxCode" >

                              </div>

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
                                <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="<?php echo $getPurchasenquiry[0]->series_code; ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries()">

                                <datalist id="seriesList1">

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


                                  <input type="text" class="form-control" name="tran" value="" id="seriesName" placeholder="Enter Series Name" readonly autocomplete="off">

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

                                <input type="hidden" name="" value="" id="vr_last_num">

                                <input type="text" class="form-control rightcontent" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                              </div>

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
                                <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" autocomplete="off" onchange="getpfctData();indentData();" value="<?php echo $getPurchasenquiry[0]->plant_code ?>" readonly>

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

                                <input type="text" class="form-control" name="plantname" value="" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

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
                                
                                <input  id="profitctrId" name="pfct" class="form-control  pull-left" value="<?php echo $getPurchasenquiry[0]->pfct_code ?>" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">


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

                              <label>Tax Code:</label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>
                                
                                <input list="TaxcodeList"  id="tax_code" name="taxcode" class="form-control  pull-left" value="" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

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

                                <input type="text" id="due_days" name="due_days" class="form-control  pull-left Number" value="{{ old('due_days')}}" placeholder="Enter Due Days" autocomplete="off" style="text-align: end;" readonly>

                              </div>

                            </div>
                            <!-- /.form-group -->
                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Due Date: <span class="required-field"></span></label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              
                                <input type="text" class="form-control rightcontent" name="due_date" id="due_date" value="<?php echo $getPurchasenquiry[0]->due_date; ?>" placeholder="Select Due" autocomplete="off" readonly>

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

                                    <input type="text" class="form-control" name="party_ref" id="party_rf_no" placeholder="Enter Party Ref No" maxlength="30" value="<?php echo $getPurchasenquiry[0]->partyref_no; ?>" autocomplete="off">

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


                                <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="<?php echo $getPurchasenquiry[0]->partyref_date; ?>" placeholder="Select Party Ref Date" autocomplete="off">

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

                                  <input list="consineList"  id="consine_code" name="consine" class="form-control pull-left" value="<?php echo $getPurchasenquiry[0]->consine_code; ?>" placeholder="Select consine" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                                  <datalist id="consineList">

                                    <option selected="selected" value="">-- Select --</option>

                                    @foreach ($getacc as $key)

                                    <option value='<?php echo $key->acc_code?>'   data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>

                                    @endforeach

                                  </datalist>

                                </div>

                                <small id="cosnicode_err" style="color: red;" class="form-text text-muted"> </small>

                                <small> <div class="pull-left showSeletedName" id="consineText"></div> </small>

                            </div>
                            <!-- /.form-group -->
                          </div>
                          
                        </div>

                        <div class="row">
                          <?php foreach ($series_list as $rfhead) {

                              if(isset($rfhead->rfhead1) && $rfhead->rfhead1 !=''){

                           ?>
                          <div class="col-md-4">

                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead1 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_1" placeholder="Enter Rfhead1" maxlength="30" id="rfhead1" oninput="rfheadget(1)" value="<?php echo $getPurchasenquiry[0]->rfhead1; ?>" autocomplete="off">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>

                          </div>
                        <?php }else{} } ?>

                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead2) && $rfhead->rfhead2 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead2 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_2" placeholder="Enter Rfhead2" maxlength="30" value="<?php echo $getPurchasenquiry[0]->rfhead2; ?>" id="rfhead2" oninput="rfheadget(2)">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div>
                        <?php }else{} } ?>

                        <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead3) && $rfhead->rfhead3 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead3 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_3" id="rfhead3" placeholder="Enter Rfhead3" value="<?php echo $getPurchasenquiry[0]->rfhead3; ?>" maxlength="30" oninput="rfheadget(3)">

                              </div>

                              <small id="emailHelp" class="form-text text-muted">

                              </small>

                            </div>
                          </div>
                        <?php }else{} } ?>
                          
                        </div>

                        <div class="row">
                          
                          <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead4) && $rfhead->rfhead4 !=''){

                          ?>
                            <div class="col-md-4">
                              <div class="form-group">

                                <label><?php echo $rfhead->rfhead4 ?> :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="Rfhead_4" placeholder="Enter Rfhead4" value="<?php echo $getPurchasenquiry[0]->rfhead4; ?>" maxlength="30" id="rfhead4" oninput="rfheadget(4)" autocomplete="off">

                                </div>

                                <small id="emailHelp" class="form-text text-muted">

                                </small>

                              </div>
                            </div>
                          <?php }else{} } ?>

                          <?php foreach ($series_list as $rfhead) {

                            if(isset($rfhead->rfhead5) && $rfhead->rfhead5 !=''){

                           ?>
                            <div class="col-md-4">
                              <div class="form-group">

                                <label><?php echo $rfhead->rfhead5 ?> :</label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input type="text" class="form-control" name="Rfhead_5" placeholder="Enter Rfhead5" maxlength="30" value="<?php echo $getPurchasenquiry[0]->rfhead5; ?>" id="rfhead5" oninput="rfheadget(5)" autocomplete="off">

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
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
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

                  <?php $srn =1;$qtyTotal=0; $countg = count($getPurchasenquiry);foreach ($getPurchasenquiry as $row) {

                    $qtyTotal +=  $row->qty_recvd;

                    ?>
                    <?php if($srn == 1){ ?>
                      <input type='hidden'  id="totalRow" value="{{$countg}}" />
                    <?php } ?>
                    <tr class="useful">

                      <td class="tdthtablebordr">
                        <input type='checkbox' class='case' id="firstcechk<?php echo $srn;?>" />
                      </td>

                      <td class="tdthtablebordr">
                        <span id='snum<?php echo $srn;?>' style="width: 10px;"><?php echo $srn;?>.</span>
                      </td> 

                      <td class="tdthtablebordr">

                        <input List="indentnoList<?php echo $srn;?>" class="debitcreditbox inputboxclr cr_amount SetInCenter" onchange="getIndentNo(<?php echo $srn;?>)" id='indentno<?php echo $srn;?>' value="<?php echo $row->indentNo; ?>" name="indent_no[]"  style="width: 97px" readonly />

                        <datalist id="indentnoList<?php echo $srn;?>">
                        </datalist>

                      </td>

                      <td class="tdthtablebordr">

                        <input type="text" name="indent_date[]" id="indent_date<?php echo $srn;?>" value="<?php echo $row->indent_date;?>" class="form-control" style="width: 91px;margin-top: 19%;height: 22px;" readonly>

                      </td>

                      <td class="tdthtablebordr">
                        <div class="input-group">
                          <input list="ItemList<?php echo $srn;?>" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId<?php echo $srn;?>' name="item_code[]" onchange="getItemName(<?php echo $srn;?>)" value="<?php echo $row->item_code; ?>"  oninput="this.value = this.value.toUpperCase()" readonly /> 

                             <datalist id="ItemList<?php echo $srn;?>">


                            </datalist>
                        </div>
                        <input type="hidden" id="indend_headId<?php echo $srn;?>">
                        <input type="hidden" id="indend_bodyId<?php echo $srn;?>">

                        <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail<?php echo $srn;?>" data-toggle="modal" data-target="#view_detail<?php echo $srn;?>" onclick="showItemDetail(<?php echo $srn;?>)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>
                        <div class="divhsn" id="showHsnCd<?php echo $srn;?>"></div>
                        <input type="hidden" id="hsn_code<?php echo $srn;?>" name="hsn_code[]">
                        <input type="hidden" id="taxByItem<?php echo $srn;?>" name="tax_byitem[]">
                        <input type="hidden" id="taxratebytax<?php echo $srn;?>" value="">
                      </td>

                      <td class="tdthtablebordr tooltips">

                        <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id<?php echo $srn;?>' name="item_name[]" value="<?php echo $row->item_name; ?>" readonly />

                        <small class="tooltiptextitem tooltiphide" id="itemNameTooltip<?php echo $srn;?>"></small>

                        <textarea id="remark_data<?php echo $srn;?>" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description"><?php echo $row->particular; ?></textarea>

                      </td>

                      <td class="tdthtablebordr">

                        <div style="display: inline-flex;border: none;margin-top: -3%;">

                        <input type='text' class="debitcreditbox dr_amount getqtytotal inputboxclr SetInCenter"  id='qty<?php echo $srn;?>' name="qty[]" onclick="showbtn(<?php echo $srn;?>)" value="<?php echo $row->qty_recvd; ?>"  oninput="CalAQty(<?php echo $srn;?>)" style="width: 80px" readonly />

                        <input type="text" name="unit_M[]" id="UnitM<?php echo $srn;?>" value="<?php echo $row->um; ?>" class="inputboxclr SetInCenter AddM" readonly="">

                        <input type="hidden" id="Cfactor<?php echo $srn;?>">

                        </div>

                      </td>

                      <td class="tdthtablebordr">

                        <div style="display: inline-flex;border: none;margin-top: -3%;">

                          <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty<?php echo $srn;?>' value="<?php echo $row->aq_recvd; ?>" name="Aqty[]"  style="width: 80px" readonly />

                          <input type="text" name="add_unit_M[]" id="AddUnitM<?php echo $srn;?>" value="<?php echo $row->aum; ?>" class="inputboxclr SetInCenter AddM" readonly>

                          <input type="hidden" name="indtcode[]" id="indtcode<?php echo $srn;?>" class="inputboxclr SetInCenter AddM">
                          <input type="hidden" name="indseriescode[]" id="indseriescode<?php echo $srn;?>" class="inputboxclr SetInCenter AddM">
                          <input type="hidden" name="inslno[]" id="inslno<?php echo $srn;?>" class="inputboxclr SetInCenter AddM">
                          <input type="hidden" name="indvrno[]" id="indvrno<?php echo $srn;?>" class="inputboxclr SetInCenter AddM">

                        </div>

                      </td>

                      <td>

                        <input type="hidden" id='quaP_count<?php echo $srn;?>' value="0" name="quaP_count[]" class="quaPcountrow">
                        
                        <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="qltParamter<?php echo $srn;?>" data-toggle="modal" data-target="#quality_parametr<?php echo $srn;?>" onclick="qty_parameter(<?php echo $srn;?>)" style="padding-bottom: 0px;padding-top: 0px;" >Quality Parametr </button>

                        <div id="appliedbtn<?php echo $srn;?>"></div>
                        <div id="cancelbtn<?php echo $srn;?>"></div>
                        <div id="qpApplyOrNot<?php echo $srn;?>" class="aplynotStatus">0</div>

                        <!-- quality para modal -->

                        <div class="modal fade" id="quality_parametr<?php echo $srn;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><input type='hidden' id='itmOnQp<?php echo $srn;?>'><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel">Qaulity Parameter</h5></div> </div> </div> <div class="modal-body table-responsive"> <div class="boxer" id="qua_par_<?php echo $srn;?>"></div></div><div class="modal-footer"><center><small style="text-align: center;" id="footer_ok_btn<?php echo $srn;?>"></small><small style="text-align: center;" id="footer_quality_btn<?php echo $srn;?>"></small></center></div></div></div></div>

                        <!-- quality para modal -->

                        <!-- itm details -->

                        <div class="modal fade" id="view_detail<?php echo $srn;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-md" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"> <div class="row"> <div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel" style="text-align: center;">Item Detail</h5></div></div></div><div class="modal-body table-responsive"><div class="boxer" id=""><div class="box-row"> <div class="box10 texIndbox2">Item Name</div><div class="box10 rateIndbox">HSN Code</div> <div class="box10 rateIndbox">Tax Code</div><div class="box10 rateBox">Item Detail</div><div class="box10 amountBox">Item Type</div> <div class="box10 amountBox">Item Group</div> <div class="box10 amountBox">Item Class</div> <div class="box10 amountBox">Item Category</div> </div> <div class="box-row"> <div class="box10 itmdetlheading"> <span id="itemCodeshow<?php echo $srn;?>"> </span></div><div class="box10 itmdetlheading"><span id="hsncodeshow<?php echo $srn;?>"> </span> </div><div class="box10 itmdetlheading"><span id="taxcodeshow<?php echo $srn;?>"> </span></div><div class="box10 itmdetlheading"><span id="itemDetailshow<?php echo $srn;?>"> </span></div> <div class="box10 itmdetlheading"> <span id="itemtypeshow<?php echo $srn;?>"> </span></div><div class="box10 itmdetlheading"><span id="itemgroupshow<?php echo $srn;?>"> </span> </div> <div class="box10 itmdetlheading"><span id="itemclassshow<?php echo $srn;?>"> </span></div><div class="box10 itmdetlheading"> <span id="itemcategoryshow<?php echo $srn;?>"> </span> </div> </div></div></div> <div class="modal-footer" style="text-align: center;"><button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button></div></div> </div></div>

                        <!-- itm details -->

                      </td>

                    </tr>

                  <?php $srn++;} ?>

                </table>

              </div>


              <div class="row" style="display: flex;">

                  <div class="col-md-6"></div>

                    <div class="col-md-4 toalvaldesn">

                    <div class="totlsetinres">Total :</div>

                  </div>

                  <div class="col-md-1">
                    <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="basicTotal" value="{{number_format($qtyTotal,3)}}" readonly="" style="margin-top: 3px;">

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

              <?php $srd=1; $accrow = count($getPurenqvendor); foreach ($getPurenqvendor as $rov) {?>

                <?php if($srd == 1){ ?>
                    <input type="hidden" id="acctotalrow" value="{{$accrow}}">
                <?php } ?>

                <div class="divTableRow rowcount TextBoxesGroup_1 trrowget">
                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv<?php echo $srd;?>" style="padding-bottom: 10px;">
                        
                       <input type="checkbox" class="casecheck" id="tablesecnd<?php echo $srd;?>">
                      </div>
                    </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv<?php echo $srd;?>" style="padding-bottom: 10px;">
                      <span id="snumtwo<?php echo $srd;?>"><?php echo $srd;?>.</span>
                      </div>
                    </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv<?php echo $srd;?>" style="padding-top: 10px;">

                        <input list="accList<?php echo $srd;?>" type='textbox' id='acc_code<?php echo $srd;?>' onchange="accCodeGet(<?php echo $srd;?>);" style="width: 103px;" name="enqacc_code[]" value="<?php echo $rov->account_code;?>">
                       
                        <datalist id="accList<?php echo $srd;?>">
                          <option value="">-- Select --</option>
                          @foreach($getacc as $key)
                            <option value="<?php echo $key->acc_code?>"   data-xyz="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name; echo "[".$key->acc_code."]"; ?>
                              
                            </option>
                          @endforeach
                        </datalist>
                      </div>
                      <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewAccDetail<?php echo $srd;?>" data-toggle="modal" data-target="#view_AccD<?php echo $srd;?>" onclick="showAccountDetail(<?php echo $srd;?>)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                    </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv<?php echo $srd;?>" style="padding-bottom: 10px;" class="tooltips">
                        <input type='textbox' id='acc_name<?php echo $srd;?>' value="<?php echo $rov->account_name;?>" name="enqacc_name[]" readonly>

                        <small class="tooltiptext tooltiphide" id="accountNameTooltip<?php echo $srd;?>"></small>
                      </div>
                    </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv<?php echo $srd;?>" style="padding-bottom: 10px;">
                        <input type='textbox' id='city<?php echo $srd;?>' value="<?php echo $rov->city; ?>" name="city_name[]">
                      </div>
                    </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv<?php echo $srd;?>" style="padding-bottom: 10px;">
                        <input type='textbox' id='phone<?php echo $srd;?>' value="<?php echo $rov->contact_no; ?>" name="contact_no[]" style="width: 100px;" maxlength="10">
                      </div>
                    </div>
                  </div>

                </div>

              <?php $srd++;} ?>

            </div>

          </div>

          <div class="col-md-12"></div><br>
          
  		    <p class="text-center">

            <button class="btn btn-success" type="button" id="submitdata" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

            <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

          </p>

        </div>

      </div>

    </div>

  </div> 

</section>

</form>
<!-- end enquiry vendor--->
</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/enquery_trans.js') }}" ></script>

<script type="text/javascript">

  $(document).ready(function(){
      $(window).on('load',function(){
          var rowCount = $('#totalRow').val();

          for(var q=0;q<rowCount;q++){
            var ids = q+1;
            var itmc = $('#ItemCodeId'+ids).val();
            if(itmc){
              $('#viewItemDetail'+ids).removeClass('showdetail');
            }

          }

          var accrowc = $('#acctotalrow').val();

          for(var w=0;w<accrowc;w++){
            var idno = w+1;
            var acccd = $('#acc_code'+idno).val();
            if(acccd){
              $('#viewAccDetail'+idno).removeClass('showdetail');
            }

          }

      });
  });
	
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
        $("#A_qty"+itemid).val('');
        $("#AddUnitM"+itemid).val('');
        $("#indtcode"+itemid).val('');
        $("#indseriescode"+itemid).val('');
        $("#inslno"+itemid).val('');
        $("#indvrno"+itemid).val('');
        $('#submitdata').prop('disabled',true);
        $('#viewItemDetail'+itemid).addClass('showdetail');
        $('#itemNameTooltip'+itemid).addClass('tooltiphide');
        $("#quaP_count"+itemid).val(0);
        $("#qpApplyOrNot"+itemid).html('0');
        $('#appliedbtn'+itemid).empty();
        $('#cancelbtn'+itemid).empty();
        var cnclbtn ='<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>';

        $('#cancelbtn'+itemid).append(cnclbtn);
      }else{

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
                  }else{
                    $('#submitdata').prop('disabled',true);
                  }

                    if(data1.data==''){
                      $("#indtcode"+itemid).val('');
                      $("#indseriescode"+itemid).val('');
                      $("#inslno"+itemid).val('');
                    }else{

                      $('#qltParamter'+itemid).prop('disabled',false);
                      $('#viewItemDetail'+itemid).removeClass('showdetail');

                      $("#Item_Name_id"+itemid).val(data1.data.item_name);
                      $("#remark_data"+itemid).val(data1.data.remark);
                      $("#qty"+itemid).val(data1.data.qty_recvd);
                      $("#UnitM"+itemid).val(data1.data.um);

                      $("#A_qty"+itemid).val(data1.data.aq_recvd);
                      $("#AddUnitM"+itemid).val(data1.data.aum);

                      $("#indtcode"+itemid).val(data1.data.tran_code);

                      $("#indseriescode"+itemid).val(data1.data.series_code);

                      $("#inslno"+itemid).val(data1.data.slno);
                      $("#indvrno"+itemid).val(data1.data.vrno);
                      $("#indend_headId"+itemid).val(data1.data.purchase_indent_head_id);
                      $("#indend_bodyId"+itemid).val(data1.data.id);


                      
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
        $("#ItemList"+indentno).empty();
      }else{

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

                        var indendDate = getData.vr_date;
                        var slipD =  indendDate.split('-');

                        var vrDate = slipD[2]+'-'+slipD[1]+'-'+slipD[0];
                      
                      $("#indent_date"+indentno).val(vrDate);


                      $("#ItemList"+indentno).append($('<option>',{

                        value:getData.item_code,

                        'data-xyz':getData.item_name,
                        text:getData.item_name


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
                  $("#itemCodeshow"+viewid).html(data1.data_hsn.item_name+'<p>('+data1.data_hsn.item_code+')</p>');
                  $("#hsncodeshow"+viewid).html(data1.data_hsn.hsn_code);
                  $("#taxcodeshow"+viewid).html(data1.data_hsn.tax_code);
                  $("#itemDetailshow"+viewid).html(data1.data_hsn.item_detail);
                  $("#itemtypeshow"+viewid).html(data1.data_hsn.item_type);
                  $("#itemgroupshow"+viewid).html(data1.data_hsn.item_group);
                  $("#itemclassshow"+viewid).html(data1.data_hsn.item_class);
                  $("#itemcategoryshow"+viewid).html(data1.data_hsn.item_category);
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


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);

                        var sr_no=1;
                          $.each(data1.data, function(k, getData) {



                            if(data1.item_code){
                              var item_code = data1.item_code;
                            }else if(getData.item_code){
                               var item_code = getData.item_code;
                            }

                            $('#itmOnQp'+qty).val(item_code);

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.item_category+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+getData.iqua_char+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_decs_"+qty+"_"+sr_no+"' name='iqua_desc[]' class='form-control inputtaxInd' value="+getData.iqua_desc+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+getData.char_fromvalue+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+getData.char_tovalue+" ></div></div> ";

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
  function accCodeGet(accId){

      var AccCode =  $('#acc_code'+accId).val();

      var xyz = $('#accList'+accId+' option').filter(function() {

        return this.value == AccCode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      $('#accountNameTooltip'+accId).removeClass('tooltiphide');
      $('#accountNameTooltip'+accId).html(msg);

      if(msg == 'No Match'){

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

                    if(data1.data.city){
                      $("#city"+accId).prop('readonly',true);
                    }else{
                      $("#city"+accId).prop('readonly',false);
                    }
                    
                    $("#acc_name"+accId).val(data1.data.acc_name);
                    $("#city"+accId).val(data1.data.city);
                    $("#phone"+accId).val(data1.data.phone1);

                    $("#submitdata").prop('disabled',false);
                    

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
                  $("#accCodeshow"+acid).html(data1.data.acc_name+'<p>('+data1.data.acc_code+')</p>');
                  $("#acctypecodeshow"+acid).html(data1.data.acctype_code);
                  $("#acccatshow"+acid).html(data1.data.acccategory_code);
                  $("#accclassshow"+acid).html(data1.data.accclass_code);
                  $("#gsttypsshow"+acid).html(data1.data.gst_type);
                  $("#gstnoshow"+acid).html(data1.data.gst_num);
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
                       var profitget = '';
                       var profitctr = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctCode').val(profitget);
                    }else{
                      $('#profitctrId').val(data1.data[0].pfct_code);
                      $('#pfctName').val(data1.data[0].pfct_name);
                      $('#getPfctCode').val(data1.data[0].pfct_code);

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

                    var yearf = getData.fiscal_year;

                    var startyear = yearf.split('-');

                    

                    $("#indentnoList1").append($('<option>',{

                      value:startyear[0]+' '+getData.series_code+' '+getData.vr_no,

                      'data-xyz':startyear[0]+' '+getData.series_code+' '+getData.vr_no,
                      text:startyear[0]+' '+getData.series_code+' '+getData.vr_no


                    }));

                  }); 

                }

            }

          });
          }, 500);

          


            var seriesCode = $('#series_code').val();
          var transcode = $('#transcode').val();
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

                      if(data1.vrnodata == ''){
                        $('#vrseqnum').val(data1.vrno_series.last_no);
                        $('#getVrNo').val(data1.vrno_series.last_no);
                      }else{
                        var lastNo = parseInt(data1.vrno_series.last_no)+ parseInt(1);
                        $('#vrseqnum').val(lastNo);
                        $('#getVrNo').val(lastNo);
                      }
                    }

                }

            }

          });



    });

  });

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
    }else if(objtwo.length == 0){
      $('#submitdata').prop('disabled',true);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;
          $('#'+id).html(key+1);

      });
    } 
      
  }


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
                       var profitget = '';
                       var profitctr = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctCode').val(profitget);
                    }else{
                      $('#profitctrId').val(data1.data[0].pfct_code);
                      $('#pfctName').val(data1.data[0].pfct_name);
                      $('#getPfctCode').val(data1.data[0].pfct_code);

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

                    var yearf = getData.fiscal_year;

                    var startyear = yearf.split('-');

                    $("#indentnoList1").append($('<option>',{

                      value:startyear[0]+' '+getData.series_code+' '+getData.vr_no,

                      'data-xyz':startyear[0]+' '+getData.series_code+' '+getData.vr_no,
                      text:startyear[0]+' '+getData.series_code+' '+getData.vr_no


                    }));

                  }); 

                }

            }

      });

    }, 500);
  }


</script>


<script type="text/javascript">

$(document).ready(function(){

    $("#submitdata").click(function(event) {

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

          $.ajax({

              type: 'POST',

              url: "{{ url('/finance/save-enquiry-transaction') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                console.log(data);

               var url = "{{url('finance/view-enquiry-msg')}}"
               setTimeout(function(){ window.location = url+'/savedata'; });
              },

          });

      }
              
    });


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

              url: "{{ url('/finance/save-enquiry-transaction') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                console.log(data);

               var url = "{{url('finance/view-enquiry-msg')}}"
               setTimeout(function(){ window.location = url+'/savedata'; });
              },

          });

    });

});

</script>


@endsection