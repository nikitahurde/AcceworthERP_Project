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
  width: 19%;
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
.AddMList{
  width: 40px;
}
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
        Edit Purchase Enquiry
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
          <a href="{{ url('/finance/transaction/purchase-order-transaction') }}">Edit Purchase  Enquiry</a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Edit Purchase Enquiry</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/finance/view-purchase-indent') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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


                              <input type="hidden" name="" value="" id="FromDateFy">

                              <input type="hidden" name="" value="" id="ToDateFy">

                              <input type="text" class="form-control transdatepicker" name="vr" id="vr_date" value="{{ $getPurchasenquiry[0]->vr_date }}" placeholder="Select Date" autocomplete="off" disabled>

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

                              <input type="text" class="form-control" name="tran" value="{{$getPurchasenquiry[0]->tran_code }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

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
                              
                            <input list="seriesList1"   id="series_code" name="series" class="form-control  pull-left" value="{{$getPurchasenquiry[0]->series_code}}" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" disabled>

                            <datalist id="seriesList1">

                              <option selected="selected" value="">-- Select --</option>

                               @foreach ($series_list as $key)

                                <option value='<?php echo $key->series_code?>'   data-xyz ="<?php echo $key->series_name; ?>" ><?php echo $key->series_name ; echo " [".$key->series_code."]" ; ?></option>
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


                              <input type="text" class="form-control" name="tran" value="" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

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

                            <input type="text" class="form-control" name="vro" value="{{$getPurchasenquiry[0]->vr_no}}" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

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
                                 <i class="fa fa-newspaper-o" aria-hidden="true" id="planticon"></i>

                                <div class="" id="appndplantbtn">
                                    
                                </div>
                               </span>
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" value="{{$getPurchasenquiry[0]->plant_code}}" disabled autocomplete="off">

                              <datalist id="PlantcodeList">

                                <option selected="selected" value="">-- Select --</option>


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
                              <input list="profitList"  id="profitctrId" name="pfct" class="form-control  pull-left" value="{{$getPurchasenquiry[0]->pfct_code}}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">


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

                          <label>Tax Code: 
                          </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <input type="text"  id="tax_code" name="taxcode" class="form-control  pull-left" value="" placeholder="Select Tax" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">


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

                              <input type="text" id="due_days" name="due_days" class="form-control  pull-left Number" value="{{ old('due_days')}}" placeholder="Enter Due Days" autocomplete="off" style="text-align: end;" disabled>

                            </div>

                        </div>
                            <!-- /.form-group -->
                      </div>  
                          <!-- /.col -->

                      <div class="col-md-4">

                        <div class="form-group">

                          <label>Due Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            
                              <input type="text" class="form-control" name="due_date" id="due_date" value="{{ $getPurchasenquiry[0]->due_date}}" placeholder="Select Due" autocomplete="off" readonly>

                            </div>
                        </div>
                            <!-- /.form-group -->
                      </div>
                          <!-- /.col -->

                    </div> <!-- row -->

                    <div class="row">

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

                                    <input type="text" class="form-control" name="party_ref" id="party_rf_no" placeholder="Enter Party Ref No" maxlength="30" value="{{ $getPurchasenquiry[0]->partyref_no}}" autocomplete="off" readonly>

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

                                

                                <input type="hidden" name="" value="" id="FromDateFy_1">

                                <input type="hidden" name="" value="" id="ToDateFy_1">

                                <input type="text" class="form-control partyrefdatepicker" name="party_ref_d" id="party_ref_date" value="{{ $getPurchasenquiry[0]->partyref_date}}" placeholder="Select Party Ref Date" autocomplete="off" disabled>

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

                            if(isset($rfhead->rfhead1) && $rfhead->rfhead1 !=''){

                         ?>
                          <div class="col-md-4">
                            <div class="form-group">

                              <label><?php echo $rfhead->rfhead1 ?> :</label>

                              <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                  <input type="text" class="form-control" name="Rfhead_1" placeholder="Enter Rfhead1" maxlength="30" value="{{ $getPurchasenquiry[0]->rfhead1}}" id="rfhead1" oninput="rfheadget(1)" autocomplete="off" readonly>

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

                                  <input type="text" class="form-control" name="Rfhead_2" placeholder="Enter Rfhead2" maxlength="30" id="rfhead2" oninput="rfheadget(2)" value="{{ $getPurchasenquiry[0]->rfhead2}}" readonly>

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

                                  <input type="text" class="form-control" name="Rfhead_3" id="rfhead3" placeholder="Enter Rfhead3" maxlength="30" oninput="rfheadget(3)" value="{{ $getPurchasenquiry[0]->rfhead3}}"  readonly>

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

                                  <input type="text" class="form-control" name="Rfhead_4" placeholder="Enter Rfhead4" maxlength="30" id="rfhead4" oninput="rfheadget(4)" value="{{ $getPurchasenquiry[0]->rfhead4}}" autocomplete="off" readonly>

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

                                  <input type="text" class="form-control" name="Rfhead_5" placeholder="Enter Rfhead5" maxlength="30" id="rfhead5" oninput="rfheadget(5)" value="{{ $getPurchasenquiry[0]->rfhead5}}" autocomplete="off"  readonly>

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
                  <input type ="hidden" name="departCode" id="getAccCode">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
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

                  <input type="hidden" name="emplyeeName" id="emplyeeName">


                  <tr>

                    <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 10px;"> Sr.No.</th>

                    <th>Indent No</th>

                    <th>Indent Date</th>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty</th>

                    <th>A-Qty</th>

                    <th>Action</th>

                  </tr>

                  <?php $srNo=1;$total=0; $dataCount= count($getPurchasenquiry); foreach ($getPurchasenquiry as $indData) {
                     $total += $indData->qty_recvd;

                   ?>

                  <tr class="useful">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">{{$srNo}}</span>
                    </td>

                    <td class="tdthtablebordr">

                      <input List="indentnoList1" class="debitcreditbox inputboxclr cr_amount SetInCenter" onchange="getIndentNo(1)" value="{{$indData->indentNo}}" id='indentno1' name="indent_no[]"  style="width: 97px" readonly />

                        <datalist id="indentnoList1">
                        </datalist>


                    </td>

                    <td class="tdthtablebordr">

                       <input type="text" name="indent_date[]" id="indent_date1" class="form-control" value="{{$indData->indent_date}}" style="width: 91px;margin-top: 19%;height: 22px;" readonly>

                    </td>

                    <td class="tdthtablebordr">

                      <div class="input-group">
                        <input type="hidden" value="{{$dataCount}}" id="getitmCount">
                        <input type="hidden" value="{{ $indData->item_code}}" name="hideitmC" id="hideItmCode{{$srNo}}">
                        <input list="ItemList{{$srNo}}" class="inputboxclr SetInCenter" style="width: 90px;margin-bottom: 5px;" id='ItemCodeId{{$srNo}}' name="item_code[]"  onchange="ItemCodeGet(<?php echo $srNo?>);quaParaGet(<?php echo $srNo?>)"  oninput="this.value = this.value.toUpperCase()" value="{{ $indData->item_code}}" />

                          <datalist id="ItemList{{$srNo}}">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($help_item_list as $key)

                              <option value='<?php echo $key->item_code?>' data-xyz ="<?php echo $key->item_name; ?>" ><?php echo $key->item_name ; echo " [".$key->item_code."]" ; ?></option>

                              @endforeach

                          </datalist>
                      </div>
                      <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail<?php echo $srNo?>" data-toggle="modal" data-target="#view_detail<?php echo $srNo?>" onclick="showItemDetail(<?php echo $srNo?>)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                    </td>

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 190px;margin-bottom: 5px;" id='Item_Name_id{{$srNo}}' name="item_name[]"  value="{{ $indData->item_name}}" readonly />

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip{{$srNo}}"></small>

                      <input type="hidden" name="body_id[]" value="{{ $indData->bodyid }}" id="body_id{{$srNo}}">
                      <input type="hidden" name="head_id[]" value="{{ $indData->enquiry_head_id }}" id="head_id{{$srNo}}">

                      <textarea id="remark_data{{$srNo}}" rows="1" style="width: 190px;margin-bottom: 2%;" class="" name="remark[]" placeholder="Enter Description">{{ $indData->particular}}</textarea>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate"  id='qty{{$srNo}}' name="qty[]" oninput='Getqunatity(<?php echo $srNo?>)'style="width: 80px" value="{{ $indData->qty_recvd}}" />
                      <input type="hidden" id="qtyget{{$srNo}}" class="totlqty">
                      <input type="text" name="unit_M[]" id="UnitM{{$srNo}}" class="inputboxclr SetInCenter AddM" value="{{ $indData->um}}" readonly>

                      <input type="hidden" id="Cfactor{{$srNo}}">

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='A_qty{{$srNo}}' name="Aqty[]"  style="width: 80px" value="{{ $indData->aq_recvd}}" />

                      <input list="aumList{{$srNo}}" name="add_unit_M[]" id="AddUnitM{{$srNo}}" class="inputboxclr SetInCenter AddMList" onchange="changeAum(<?php echo $srNo?>)" value="{{ $indData->aum}}" >

                      <datalist id="aumList{{$srNo}}">
                      </datalist>

                      </div>

                    </td>

                    <td>
                       <input type="hidden" value="" id="qpCountByitm{{$srNo}}" name="alreadyApQp[]">
                      <div style="margin-top: 12%;">
                        <small id="taxnotfound{{$srNo}}" class="label label-danger"></small>
                      </div>
                      <input type="hidden" id='quaP_count{{$srNo}}' value="0" name="quaP_count[]" class="quaPcountrow">
                      <button type="button" class="btn btn-primary btn-xs tdsratebtn" id="CalcTax{{$srNo}}" data-toggle="modal" data-target="#quality_parametr{{$srNo}}" onclick="qty_parameter(<?php echo $srNo;?>)"  style="padding-bottom: 0px;padding-top: 0px;">Quality Parametr </button>

                      <div id="appliedbtn{{$srNo}}"></div>
                      <div id="cancelbtn{{$srNo}}"></div>
                      <div id="qpApplyOrNot{{$srNo}}" class="aplynotStatus">0</div>


                      <small id="qPnotfountbtn1" class="label label-danger"></small>
                       
                    </td>
                  </tr>




                    <!-- show modal when click on view btn after item select item -->

        <div class="modal fade" id="view_detail{{$srNo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <small id="itemCodeshow{{$srNo}}"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="hsncodeshow{{$srNo}}"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="taxcodeshow{{$srNo}}"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemDetailshow{{$srNo}}"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemtypeshow{{$srNo}}"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemgroupshow{{$srNo}}"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemclassshow{{$srNo}}"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemcategoryshow{{$srNo}}"> </small>
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


      <div class="modal fade" id="quality_parametr{{$srNo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">
                <input type="hidden" id="itmOnQp{{$srNo}}">
                <div class="col-md-12">
                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Qaulity Parameter</h5>
                </div>

              </div>

            </div>

            

            <div class="modal-body table-responsive">

                <div class="boxer" id="qua_par_{{$srNo}}">
                
                  
                </div>

            </div>

          <div class="modal-footer">
           
            <center><small style="text-align: center;" id="footer_ok_btn{{$srNo}}"></small>
            <small style="text-align: center;" id="footer_quality_btn{{$srNo}}"></small>
            </center>
          
          </div>

        </div>

      </div>
    </div>

                  <?php $srNo++;} ?>


                </table>

              </div><!-- /div -->
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
            
              <div class="row" style="display: flex;">

                  <div class="col-md-6"></div>

                    <div class="col-md-4 toalvaldesn">

                    <div class="totlsetinres">Total :</div>

                  </div>
                  <?php  $totalqty = number_format($total,3) ?>
                  <div class="col-md-1">
                     <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="basicTotal" readonly="" value="{{$totalqty}}" style="margin-top: 3px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>   

      <br>

        <!-- <p class="text-center">

          <button class="btn btn-success" type="button" id="submitdata"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

          <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

        </p> -->

       
      <!-- when hsn code same then show model -->

      

    <div id="quaPdomModel_2">
         
    </div>
    <!-- model -->
      <!-- when hsn code same then show model -->

    
    

  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

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
                
                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                        <span id="snumtwo1">1.</span>
                      </div>
                    </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv1" style="padding-top: 10px;">

                        <input list="accList1" type='textbox' id='acc_code1' onchange="accCodeGet(1);" style="width: 103px;" name="enqacc_code[]">
                       
                        <datalist id="accList1">
                          <option value="">-- Select --</option>
                            @foreach($getacc as $key)
                              <option value="<?php echo $key->acc_code?>"   data-xyz="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name; echo "[".$key->acc_code."]"; ?>
                                
                              </option>
                            @endforeach
                        </datalist>
                      </div>
                      <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewAccDetail1" data-toggle="modal" data-target="#view_AccD1" onclick="showAccountDetail(1)"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>

                    </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv1" style="padding-bottom: 10px;" class="tooltips">
                        <input type='textbox' id='acc_name1' value="" name="enqacc_name[]" readonly>

                        <small class="tooltiptext tooltiphide" id="accountNameTooltip1"></small>
                      </div>
                    </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                        <input type='textbox' id='city1' value="" name="city_name[]">
                      </div>
                    </div>
                  </div>

                  <div class="divTableCell">
                    <div class='TextBoxesGroup'>
                      <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                        <input type='textbox' id='phone1' value="" name="contact_no[]" style="width: 100px;" maxlength="10">
                      </div>
                    </div>
                  </div>
                     
              </div>

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

</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/jsController.js') }}" ></script>
<script src="{{ URL::asset('public/dist/js/viewjs/editCommonJsFun.js') }}" ></script>
  
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

        var pfctCode   = $('#profitctrId').val();
        var trancode   = $('#transcode').val();
        var seriecode  = $('#series_code').val();
        var vrseqnum   = $('#vrseqnum').val();
        var vr_date    = $('#vr_date').val();
        var deptcode   = $('#account_code').val();
        var Plant_code = $('#Plant_code').val();

        $('#getPfctCode').val(pfctCode);
        $('#getTransCode').val(trancode);
        $('#getSeriesCode').val(seriecode);
        $('#getVrNo').val(vrseqnum);
        $('#getTransDate').val(vr_date);
        $('#getAccCode').val(deptcode);
        $('#getPlantCode').val(Plant_code);

        $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

        });

        var totalItm = $('#getitmCount').val();

        for(var q=1; q<=totalItm; q++){
        
          var ItemCode =  $('#ItemCodeId'+q).val();

  
          $.ajax({

            url:"{{ url('get-item-um-aum') }}",

            method : "POST",

            type: "JSON",

            data: {ItemCode:ItemCode,q:q},

              success:function(data){

                var data1 = JSON.parse(data);

                var uniq_p = data1.qcount;

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                    if(data1.data==''){
                    
                    }else{

                      $('#Cfactor'+uniq_p).val(data1.data[0].aum_factor);

                      $('#viewItemDetail'+uniq_p).removeClass('showdetail');
                     
                    } 

                    if(data1.aumList==''){

                    }else{
                        
                      $("#aumList"+uniq_p).empty();

                      $.each(data1.aumList, function(k, getAum){

                        $("#aumList"+uniq_p).append($('<option>',{

                          value:getAum.aum,
                          'data-xyz':getAum.um_name,
                          text:getAum.um_name

                        }));

                      });

                    }

                } /*if close*/

              }  /*success function close*/

          });  /*ajax close*/

        }

        setTimeout(function() {

          for(var q=1; q<=totalItm; q++){

            var pHeadId =  $('#head_id'+q).val();
            var pBodyId =  $('#body_id'+q).val();

            $.ajax({

            url:"{{ url('get-qp-for-purchase-indent-edit') }}",

            method : "POST",

            type: "JSON",

            data: {pHeadId:pHeadId,pBodyId:pBodyId,q:q},

              success:function(data){

                var data1 = JSON.parse(data);

                var uniq_qp = data1.sr_q;

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                    if(data1.dataQp==''){
                      $('#qpCountByitm'+uniq_qp).val('');
                    }else{
                      $('#qpCountByitm'+uniq_qp).val(data1.dataQp.length);

                    } 

                } /*if close*/

              }  /*success function close*/

          });  /*ajax close*/


          }
        }, 1000);
 
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

  function ItemCodeGet(ItemId){
   
      var ItemCode =  $('#ItemCodeId'+ItemId).val();
      var hideitm  =  $('#hideItmCode'+ItemId).val();

      var xyz = $('#ItemList'+ItemId+' option').filter(function() {

          return this.value == ItemCode;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

        $('#ItemCodeId'+ItemId).val('');

        document.getElementById("Item_Name_id"+ItemId).value = '';

        $('#qty'+ItemId).val('');
        $('#A_qty'+ItemId).val('');
        $('#Cfactor'+ItemId).val('');
        $('#UnitM'+ItemId).val('');
        $('#itmOnQp'+ItemId).val('');
        $('#AddUnitM'+ItemId).val('');
        $('#quaP_count'+ItemId).val(0);
        $('#viewItemDetail'+ItemId).addClass('showdetail');
        $('#itemNameTooltip'+ItemId).addClass('tooltiphide'); 
        $("#CalcTax"+ItemId).prop('disabled',true);

        $('#appliedbtn'+ItemId).empty();

        var cancelbtn ='<small class="label label-danger"><i class="fa fa-times-circle"></i>&nbsp;Not Applied</small>';

        $('#cancelbtn'+ItemId).append(cancelbtn);

        var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });

      }else{

         document.getElementById("Item_Name_id"+ItemId).value = msg;

         
        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide'); 

         $('#itemNameTooltip'+ItemId).html(msg); 

         $('#qty'+ItemId).prop('readonly',false);  
         $('#remark_data'+ItemId).prop('readonly',false); 

        
      }

      if(hideitm != ItemCode){
        $('#hideItmCode'+ItemId).val('');
      }else{}

      $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });
      if(ItemCode){

        $.ajax({

          url:"{{ url('get-item-um-aum') }}",

          method : "POST",

          type: "JSON",

          data: {ItemCode: ItemCode},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                  //console.log(data1.data);
                 
                    if(data1.data==''){

                      var umcode = '';

                      var aumcode = '';

                      var cfactor = '';

                      $('#UnitM'+ItemId).val(umcode);

                      $('#AddUnitM'+ItemId).val(aumcode);

                      $('#Cfactor'+ItemId).val(cfactor);

                    }else{

                      $('#UnitM'+ItemId).val(data1.data[0].um_code);

                      $('#AddUnitM'+ItemId).val(data1.data[0].aum);

                      $('#Cfactor'+ItemId).val(data1.data[0].aum_factor);

                      var cfactor = data1.data[0].aum_factor;
                      var qtyI  = $('#qty'+ItemId).val();
                      var AqtyCal = parseFloat(qtyI) * parseFloat(cfactor);
                      $('#A_qty'+ItemId).val(AqtyCal.toFixed(3));

                      $('#viewItemDetail'+ItemId).removeClass('showdetail');
                    
                    }
                    
                    if(data1.aumList==''){

                    }else{
                        
                      $("#aumList"+ItemId).empty();
                      $.each(data1.aumList, function(k, getAum){

                        

                        $("#aumList"+ItemId).append($('<option>',{

                          value:getAum.aum,
                          'data-xyz':getAum.um_name,
                          text:getAum.um_name

                        }));

                      });

                    }

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

        });  /*ajax close*/

      }else{}

  }/*function close*/

  function quaParaGet(qpItm){

    var ItemCode =  $('#ItemCodeId'+qpItm).val();

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    if(ItemCode){
          setTimeout(function() {

            $.ajax({

              type: 'POST',

              url: "{{ url('/finance/get-quality-parameter-by-item') }}",

              data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

              success: function (data) {

                var data1 = JSON.parse(data);

               //console.log('data',data1.data);

                if(data1.data==''){
                      $("#CalcTax"+qpItm).hide();
                    
                      
                      $("#qPnotfountbtn"+qpItm).html('Not Found');

                }else{
                    $("#CalcTax"+qpItm).prop('disabled',false);
                    $("#CalcTax"+qpItm).show();
                    $("#qPnotfountbtn"+qpItm).html('');
                }
             //  console.log(data1.data);
              }

            });

          }, 500);
    }else{}

  }

  function Getqunatity(qtyId){

      var quantity = $('#qty'+qtyId).val();
      var cfactor  = $('#Cfactor'+qtyId).val();
      var basicAmt = $('#basicTotal').val();
      var total    = quantity * cfactor;

      $('#A_qty'+qtyId).val(total.toFixed(3));
        
        console.log('basicAmt',basicAmt);
        
        $('#rate'+qtyId).prop('readonly',false);
        $("#submitdata").prop('disabled', false);
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

     
  }

  



</script>




<script type="text/javascript">
  function qty_parameter(qty){

   var ItemCode     = $("#ItemCodeId"+qty).val();
   var ItemCodeOnQp = $("#itmOnQp"+qty).val();
   var headIdP       = $("#head_id"+qty).val();
   var bodyIdP      = $("#body_id"+qty).val();
   var hideItem      = $("#hideItmCode"+qty).val();

   if(ItemCodeOnQp == ''){
    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/finance/get-quality-parameter-by-item') }}",

            data: {ItemCode:ItemCode,headIdP:headIdP,bodyIdP:bodyIdP,hideItem:hideItem}, // here $(this) refers to the ajax object not form

            success: function (data) {


              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      if(data1.data==''){

                        }else{

                          $('#qua_par_'+qty).empty();
                          // $('#footer_qaulity_btn'+qty).empty();
                          //  $('#footer_ok_btn'+qty).empty();


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);

                        var sr_no=1;
                          $.each(data1.data, function(k, getData) {

                            $('#itmOnQp'+qty).val(data1.item_code);

                            var quaP_count = data1.data.length;

                            console.log('quaP_count',quaP_count);
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.item_category+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+data1.item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+getData.iqua_char+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_decs_"+qty+"_"+sr_no+"' name='iqua_desc[]' class='form-control inputtaxInd' value="+getData.iqua_desc+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+getData.char_fromvalue+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+getData.char_tovalue+" ></div></div> ";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });

                          var butn =  $('#footer_quality_btn'+qty).find(':button').html();

                          console.log('butn',butn);

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

              url: "{{ url('/finance/update-purchase-indent-transaction') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                console.log(data);
              // var url = "{{url('/finance/view-purchase-indent-msg')}}"
              //setTimeout(function(){ window.location = url+'/savedata'; });
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

              url: "{{ url('/finance/update-purchase-indent-transaction') }}",

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

@endsection