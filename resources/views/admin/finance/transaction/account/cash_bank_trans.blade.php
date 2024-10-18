@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .numriRight{
    text-align: right !important;
  }
  .bthead{
    text-align: center;
    font-weight: 600;
  }
  .headstyle{
    font-weight: 700;
    font-size: 15px;
  }
  .datastyle{
    font-size: 15px;
  }
  ::placeholder {
    text-align:left;
  }
  .glcodeCls{
    font-size: 14px;
    float: left;
    margin-left: 3px;
  }
  .accCodeCls{
    font-size: 14px;
    line-height: 15px;
    float: left;
    margin-left: 3px;
    margin-top: 13px;
  }
  #drsim_total{
    border: none;
    text-align: right;
    width: 100%;
    margin-right: -17px;
  }
  #crsim_total{
    border: none;
    text-align: right;
    width: 100%;
    margin-right: -17px;
  }
  #netAmt_sim{
    border: none;
    text-align: right;
    width: 100%;
    margin-right: -17px;
    font-weight: 700;
  }
 .required-field::before {
    content: "*";
    color: red;
  }
  .Custom-Box {
    /*border: 1px solid #e0dcdc;
    border-radius: 10px;*/ 
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }
  .datehide{
    display: none;
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
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
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
    margin-top: 3px;
}
.debitotldesn{
    margin-right: 5px;
    width: 131px;
    text-align: end;
}
.credittotldesn{
    text-align: end;
    width: 131px;
}
.debitcreditbox{
  width: 100%;
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
    font-size: 14px;
    line-height: 15px;
    float: left;
    margin-left: 3px;
    margin-top: 13px;
}
.instTypeMode{
   width: 46%;
    margin-bottom: 5px;
    margin-right: 1px;
}
.textdesciptn{
  width: 92%;
  margin-bottom: 5px;
  border: 1px solid #d7d3d3;
}
.tdsratebtn{
  margin-top: 6% !important;
  font-weight: 600 !important;
  font-size: 10px !important;
}
.tdsratebtnHide{
  display: none;
}
.tdsInputBox{
  margin-bottom: 2%;
}
.modltitletext{
  text-align: center;
    font-weight: 700;
    color: #5696bb;
}
.textSizeTdsModl{
  font-size: 13px;
}
.bankshowwhenrecpt{
  display: none !important;
}
.bankNameGet{
  display: none !important;
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
    width: 12% !important; 
    text-align: center;
  }
  .rateIndbox{
    width: 15%;
    text-align: center;
  }
  .nameIndbox{
    width: 15%;
    text-align: left;
  }
  .crdrInput{
    width: 15%;
    text-align: right !important;
  }
  .itmdetlheading{
    vertical-align: middle !important;
    text-align: center;
  }
  .rateBox{
    width: 20%;
    text-align: center;
  }
  .displyinline{
    display: flex;
  }
  .viewBilTrak{
    margin-top: 4px;
    padding: 2px;
    font-size: 12px;
  }

@media screen and (max-width: 600px) {

  .debitotldesn{
    margin-bottom: 5px;
  }

  .credittotldesn{
    margin-bottom: 5px;
  }
  .totlsetinres{
    width: 130%;
  }
  .textdesciptn{
    margin-bottom: 2%;
  }
  .dateWidth{
    width: 100% !important;
  }
  
  .vrmargin{
    margin-left: 0% !important;
  }
  .tcodemargin{
    margin-left: 0% !important;
  }
  .seriesmargin{
    margin-left: 0% !important;
  }
  .serieswidth{
    width: 100% !important;
  }
  .glwidth{
    width: 100% !important;
  }

  .vrmargin{
    margin-left: 0% !important;
  }
  .pfctmargin{
    margin-left: 0% !important;
  }
  .instrumentlbl{
     font-size: 12px;
    margin-left: -83px;
    margin-top: 12px;
}
.vrtypemargin{
  margin-left: 0%;
}
}

.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 34px;
    user-select: none;
    -webkit-user-select: none;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 26px;
    position: absolute;
    top: 5px;
    right: 1px;
    width: 20px;
}
.modal-header .close {
    margin-top: -36px !important;
}
.bilNotFstle{  
  color: #fff;
  background-color: #dd4b39;
  border-radius: 4px;
  width: 73%;
  margin-left: 13%;
  margin-top: 1%;
  font-size: 11px;
  font-weight: 700;
}
.glCodeCl{
  width: 7%;
  text-align: left;
}
 ol.collection {
    margin: 0px;
    padding: 0px;
}

li {
    list-style: none;
}

.setCrDrRight{
      text-align: end;
}
.hideshow_li{
  display: none !important;
}

/* 2 Column Card Layout */
@media screen and (max-width: 736px) {
    .collection-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 20px;
    }

    .item {
        border: 1px solid gray;
        border-radius: 2px;
        padding: 10px;
    }

    /* Don't display the first item, since it is used to display the header for tabular layouts*/
    .collection-container>li:first-child {
        display: none;
    }

    .attribute::before {
        content: attr(data-name);
    }

    /* Attribute name for first column, and attribute value for second column. */
    .attribute {
        display: grid;
        grid-template-columns: minmax(9em, 30%) 1fr;
    }
}

/* 1 Column Card Layout */
@media screen and (max-width:580px) {
    .collection-container {
        display: grid;
        grid-template-columns: 1fr;
    }
}

/* Tabular Layout */
@media screen and (min-width: 737px) {
    /* The maximum column width, that can wrap */
    .item-container {
        display: grid;
        grid-template-columns: 1fr 2fr 5fr 5fr 2fr 2fr 2fr 3fr;
    }
    .item-containerPay {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr 1fr 2fr 2fr;
    }
    .attribute-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(var(--column-width-min), 1fr));
    }

    /* Definition of wrapping column width for attribute groups. */
    .part-information {
        --column-width-min: 3em;
    }

    .part-id {
        --column-width-min: 3em;
    }

    .vendor-information {
        --column-width-min: 8em;
    }

    .quantity {
        --column-width-min: 5em;
    }

    .cost {
        --column-width-min: 5em;
    }

    .duty {
        --column-width-min: 5em;
    }

    .freight {
        --column-width-min: 5em;
    }

    .collection {
        border-top: 1px solid gray;
    }

    /* In order to maximize row lines, only display one line for a cell */
    .attribute {
        border-right: 1px solid gray;
        border-bottom: 1px solid gray;
        padding: 2px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .collection-container>.item-container:first-child {
        background-color: blanchedalmond;
    }
    .collection-container>.item-containerPay:first-child {
        background-color: blanchedalmond;
    }

    .item-container:hover {
        background-color: rgb(200, 227, 252);
    }

    /* Center header labels */
    .collection-container>.item-container:first-child .attribute {
        display: flex;
        align-items: center;
        justify-content: center;
        text-overflow: initial;
        overflow: auto;
        white-space: normal;
    }
    .collection-container>.item-containerPay:first-child .attribute {
        display: flex;
        align-items: center;
        justify-content: center;
        text-overflow: initial;
        overflow: auto;
        white-space: normal;
    }
    
}
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
       Cash Bank Transaction
      <small>Add Details</small>
    </h1>

    <ul class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

      <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}"> Cash Bank</a></li>

      <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}">Add Cash Bank</a></li>

    </ul>

  </section> <!-- /. section-->

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Cash Bank Transaction</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/finance/view-cash-bank') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label>Date: <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <?php 

                        $CurrentDate = date("d-m-Y");
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
                      <input type="hidden" id="fy_year" value="{{$yearGet}}">
                      <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
                      <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
                      <input type="text" class="form-control  transdatepicker rightcontent" name="vr" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date"  autocomplete="off">

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>

                    <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div><!-- /.form-group -->
                
              </div><!-- /. col-->

              <div class="col-md-2">
              
                <div class="form-group">

                  <label> T Code : </label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="tran" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div><!-- /.form-group -->
              </div> <!-- /. col-->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Series : 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                    </div>

                    <?php $getcount = count($getseries); ?>

                    <input list="seriesList"  id="series_code" name="series" class="form-control  pull-left serieswidth" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series"  oninput="this.value = this.value.toUpperCase()" onchange="getvrnoBySeries();" autocomplete="off">

                    <datalist id="seriesList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($getseries as $key)

                      <option value='<?php echo $key->SERIES_CODE; ?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>"><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div>
                  <small id="serscode_err" style="color: red;" class="form-text text-muted">
                  </small>
                 
                          
                </div><!-- /.form-group -->
              </div> <!-- /. col-->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Series Name: 
                    <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                    </div>

                    <input type="text" id="seriesText" name="seriesname" class="form-control  pull-left" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_NAME;}else{} ?>" placeholder="Select Series Name"  data-toggle="tooltip" data-placement="top">

                  </div>
                       
                </div><!-- /.form-group -->
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">
                
                  <label> Vr No: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                    
                    <input type="text" class="form-control rightcontent" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off" >

                  </div>

                </div> <!-- /.form-group -->
              </div> <!-- /.col -->
              
            </div><!-- /. row-->

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                    <label>GL Code : <span class="required-field"></span>
                    </label>

                  <div class="input-group">
                      <span class="input-group-addon" style="padding: 0px 10px;">
                        <i class="fa fa-sort-numeric-asc" id="firsticon"></i>
                        <div class="" id="appndplantbtn"></div>
                      </span>
                      
                      <input type="text" class="form-control" name="gl" id="gl_code" value="{{ old('gl_code') }}" placeholder="Enter GL Code" disabled="" autocomplete="off">

                  </div>

                </div><!-- /.form-group -->
              </div><!-- /. col-->

              <div class="col-md-3">

                <div class="form-group">

                  <label> GL Name : <span class="required-field"></span>
                  </label>

                  <div class="input-group tooltips">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="gl" value="{{ old('gl_name') }}" id="gl_name" placeholder="Enter GL Name" readonly autocomplete="off">

                      <span class="tooltiptext tooltiphide" id="glNameTooltip"></span>
                  </div>


                </div><!-- /.form-group -->
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Vr Type :  <span class="required-field"></span>
                  </label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                       <select name="vr" id="vr_type" class="form-control" disabled autocomplete="off" style="padding: 3px 12px;">
                          <option value="">--Select--</option>
                         <option value="Payment">Payment</option>
                         <option value="Receipt">Receipt</option>
                       </select>

                  </div>

                  <small id="vr_type_err" style="color: red;"></small>
                </div><!-- /.form-group -->
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">
                
                  <label>Pfct Code: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                      <?php $pfcount = count($pfct_list); ?>
                      <input list="profitList"  id="profitId" name="pfct" class="form-control  pull-left" placeholder="Select Profit Center Code" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_CODE; }else{} ?>" readonly autocomplete="off">

                      <datalist id="profitList">

                        @foreach ($pfct_list as $key)

                        <option value='<?php echo $key->PFCT_CODE?>'   data-xyz ="<?php echo $key->PFCT_NAME; ?>" ><?php echo $key->PFCT_NAME ; echo " [".$key->PFCT_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                  </div>
                  <small>  
                      <div class="pull-left showSeletedName" id="profitText"></div>
                  </small>
                  <small id="profit_center_err" style="color: red;"> </small>

                </div><!-- /.form-group -->
              </div><!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Pfct Name: <span class="required-field"></span>
                      </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                    <div class="pull-left showSeletedName" id="profit_names"></div>
                    <input type="text" class="form-control" id="profit_name" name="profit" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_NAME; }else{} ?>" placeholder="Enter Profit Center Name" readonly>

                  </div>

                  <small id="comp_code_err" style="color: red;"></small>
                  

                </div><!-- /.form-group -->
              </div><!-- /.col -->
              
            </div><!-- /. row-->

            <div class="row">

              <div class="col-md-3">

                <div class="form-group">

                  <label>Sale Rep. code:</label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                      <?php $salerCd = count($sale_rep_list); ?>

                      <input list="saleRepList" class="form-control" id="sale_rep_code" name="sale_rep_code" placeholder="Select Sale Rep. code" maxlength="55" value="<?php if($salerCd == 1){echo $sale_rep_list[0]->ACC_CODE; echo "[ ".$sale_rep_list[0]->ACC_NAME." ]";}?>"  autocomplete="off">

                      <datalist id="saleRepList">

                         <option value="">--SELECT--</option>

                         @foreach ($sale_rep_list as $key)

                        <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo " [".$key->ACC_CODE."]"; ?></option>

                        @endforeach

                      </datalist>

                    </div>
                    <small>  

                        <div class="pull-left showSeletedName" id="saleRText"></div>

                    </small>

                    <small id="saleR_err" style="color: red;"> </small>

                </div><!-- /.form-group -->
              </div><!--  /.col --> 
              
            </div><!-- /. row-->
            
          </div><!-- /. box-body-->
          
        </div><!-- /. custom box-->
        
      </div><!-- /. col-->
      
    </div> <!-- /. row-->
  </section> <!-- /. section-->

  <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <form id="cahsbanktrans">
              @csrf
              <div class="table-responsive">
                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                  <tr>
                    <th><input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row" /></th>
                    <th>Sr.No.</th>
                    <th>Gl / Account Code</th>
                    <th>Name / Particular</th>
                    <th>Debit-DR</th>
                    <th>Credit-CR</th>
                  </tr>
                  <tr class="useful">
                    <td class="tdthtablebordr"><input type='checkbox' class='case'/ title="Delete Single Row"><span id='snum'>1.</span></td>
                    <td class="tdthtablebordr" style="width: 10%;">
                      <small class="glcodeCls">Gl Code</small><br>
                      <small class="accCodeCls">Cost Code</small><br>
                      <small class="accCodeCls">Account Code</small><br>
                      <label for="" class="instrumentlbl">I Type</label><br>
                      <button type="button" class="btn btn-primary btn-xs tdsratebtn tdsratebtnHide" id="tds_rate1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTdsRate(1)" disabled>Calc TDS</button>
                      <div id="appliedbtn1"></div>
                      <div id="canclebtn1"></div>
                      <input type="hidden" id="tdsByAccCode1" value="" name="tdsCodeByAc[]">
                      <input  type="hidden" name="tds_rate[]" id="TdsRateByAccCode1" class="getRateForAcc">
                      <input type="hidden" name="tds_code[]" id="TdsSection1">
                      <input type="hidden" name="" id="accNtdsrate1">
                      <input type="hidden" id="ledgrAmt1"  name="ledgrAmt[]">
                    </td> 

                    <td class="tdthtablebordr"  style="width: 15%;">

                      <div class="input-group">

                        <input list="glCodeNameList1" class="inputboxclr glcodeGets tabnext" style="width: 100%;margin-bottom: 5px;" id="glCodeName1"  name="glCodeName[]" onchange="glcodeNameData(1);" placeholder="Select Gl Code"  readonly autocomplete="off">

                        <datalist id="glCodeNameList1">

                          @foreach ($gl_list as $key)

                          <option value='<?php echo $key->GL_CODE?>' data-xyz ="<?php echo $key->GL_NAME; ?>" ><?php echo $key->GL_NAME; echo " [".$key->GL_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>
                        <input type="hidden" id="acctTag1" value="">
                        <input type="hidden" id="costcTag1" value="">
                      </div>

                      <div class="input-group">

                        <input list="costCenterList1" class="inputboxclr tabnext" style="width: 100%;margin-bottom: 5px;" id="costCenter1"  name="costCenterCd[]" onchange="costCenterCdData(1);" placeholder="Select Cost Center Code"  readonly autocomplete="off">

                        <datalist id="costCenterList1">

                          @foreach ($cost_list as $key)

                          <option value='<?php echo $key->COST_CODE?>' data-xyz ="<?php echo $key->COST_NAME; ?>" ><?php echo $key->COST_NAME; echo " [".$key->COST_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>
                        
                      </div>

                      <div class="displyinline">
                        <div class="input-group">
                          <input list="AccList1" class="inputboxclr getacccode tabnext" style="width: 100%;margin-bottom: 5px;" id='acc_code1'  name="acc_code[]" onchange="GetAccountCode(1)" readonly oninput="this.value = this.value.toUpperCase()" />

                          <datalist id="AccList1">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($acc_list as $key)

                            <option value='<?php echo $key->ACC_CODE; ?>' data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo " [".$key->ACC_CODE."]" ; ?></option>

                            @endforeach

                          </datalist>
                        </div>
                        <div class="" id="appndaccbtn"><button type="button" data-toggle="modal" id="accbtn1" data-target="#accCd_detail1" onclick="getAccDetail(1)" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;" disabled=""> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button></div>
                      </div>

                      <input type="hidden" id="acc_class1" name="accClass[]">
                      <input type="hidden" id="acc_type1" name="accType[]">
                      <input type="hidden" name="gltdscode[]" id="GettdsCode1" >
                      <input type="hidden" name="gltdsname[]" id="GettdsName1">

                      <div style="display: flex;">
                        <input list="InstTypeList1" id="inst_type1" class="instTypeMode getinstrument tabnext"  name="instrument_type[]" placeholder="Select I Type" onchange="changedate(1)">

                          <datalist id="InstTypeList1">
                            <option selected="selected" value="">-- Select --</option>
                            
                            <option value='CH' data-xyz ="Cheque">Cheque[CH]</option>
                            <option value='DD' data-xyz ="Demand Draft">Demand Draft[DD]</option>
                            <option value='TR' data-xyz ="Transfer receipt">Transfer receipt[TR]</option>
                            <option value='TT' data-xyz ="Tele Transfer">Tele Transfer[TT]</option>  
                            <option value='MT' data-xyz ="Money Transfer">Money Transfer[MT]</option>
                            <option value='RT' data-xyz ="RTGS">RTGS[RT]</option>     
                            <option value='BA' data-xyz ="Bank Advise">Bank Advise[BA]</option>     
                            <option value='EC' data-xyz ="Electronic Clearence">Electronic Clearence[EC]</option>     
                            <option value='NEFT' data-xyz ="National Electronic Funds Transfer">National Electronic Funds Transfer[NEFT]</option>     
                            <option value='IMPS' data-xyz ="Immediate Payment Service">Immediate Payment Service[IMPS]</option>     
                            <option value='UPI' data-xyz ="Unified Payments Interface">Unified Payments Interface[UPI]</option>     
                            <option value='NA' data-xyz ="Not Applicable">Not Applicable[NA]</option>     

                          </datalist><br>
                        <input  list='chequeNoList1' class="inputboxclr onchenkno tabnext" style="width:72px;margin-bottom: 4px;" id='cheque_no'  name="instrument_no[]" oninput='getdicbypay(1);' placeholder="Number" />
                        <datalist id="chequeNoList1">
                        </datalist>

                        <input type="hidden" value="" id="updateChqNo1">
                      </div>
                      <div class="input-group datehide" id="showdate1">
                       
                        <input type="text" name="chquedate[]" id="chquedate1" value="" class="form_date" placeholder="select date" style="width: 100%;">
                        <i class="fa fa-calendar form-control-feedback" style="line-height: 26px;"></i>
                      </div>

                      <div class="input-group">

                        <input list="bankList1"  id="bankid1" name="bank_code[]" class="inputboxclr bankshowwhenrecpt" value="{{ old('bank_code')}}" style="width: 100%;margin-bottom: 5px;" placeholder="Enter Bank" onchange="banklistget(1)" oninput="this.value = this.value.toUpperCase()">

                        <datalist id="bankList1">

                          <option selected="selected" value="">-- Select --</option>

                          @foreach ($bank_list as $key)

                          <option value='<?php echo $key->BANK_CODE; ?>'   data-xyz ="<?php echo $key->BANK_NAME; ?>" ><?php echo $key->BANK_NAME; echo " [".$key->BANK_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>

                      </div>

                      <small id="bank_name_err" style="color: red;"></small>
                      <small>  

                          <div class="pull-left showSeletedName" id="bankText1"></div>

                      </small>
                      
                    </td>

                    <td class="tdthtablebordr"  style="width: 35%;"> 
                      <div class="row">
                        <input type="text" class="inputboxclr getglCNAme" style="width: 92%;margin-bottom: 5px;" placeholder="Enter Gl Name" id='genrl_name1' name="genrl_name[]" readonly />
                      </div>

                      <div class="row">
                        <input type="text" class="inputboxclr getglCNAme" style="width: 92%;margin-bottom: 5px;" placeholder="Enter Cost Center Name" id='costCenter_name1' name="costCenter_name[]" readonly />
                      </div>

                      <div class="tooltips">
                        <input type="text" class="inputboxclr getAccNAme" style="width: 100%;margin-bottom: 5px;" id='acc_name1' placeholder="Enter Account Name" name="acc_name[]" readonly />

                        <span class="tooltiptextitem tooltiphide" id="itemNameTooltip1" style="bottom: 73%;"></span>
                      </div>

                      <div class="row">
                        <input type="text" class="textdesciptn discription"  name="particular[]" id="discription1" readonly>
                      </div>

                      <div class="row">

                        <div class="input-group" style="display:flex;">

                          <input list="remarkList1" class="tabnext textdesciptn" id='ref1' name="ref_text[]" placeholder="Enter Remark" oninput="this.value = this.value.toUpperCase()" style="margin-left: 4%;"/>

                          <datalist id="remarkList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($remark_list as $key)

                              <option value='To - <?php echo $key->REMARK?>' data-xyz ="To - <?php echo $key->REMARK; ?>" >To - <?php echo $key->REMARK ; ?></option>

                              @endforeach

                          </datalist>

                        </div>

                       </div>

                      <div class="row">
                        <input type="text" id="ShowBankName1" style="width: 250px;margin-bottom: 2%;" class="bankNameGet" readonly>
                      </div>

                      <input type="hidden" name="blankVal[]" value="">
                    </td>

                    <td class="tdthtablebordr"  style="width: 20%;">
                      <input type='text' class="debitcreditbox dr_amount inputboxclr tabnext"  id='dr_amount1' name="dr_amount[]"  onkeypress='NumberCredit()' readonly oninput='GetDebitAmount(1)'/><br>
                      <div id="billTkDr1" style="display: inline-flex;"></div>
                      <div id="bilNotFounddr1" class="bilNotFstle"></div>
                      <input type="hidden" id="totalnetGetamt1">
                      <input type="hidden" id="resultofdebit1" name="DebitdsAmt[]">
                      <input type="hidden" id="Applytdsonamt1" name="TdsDebitAmount[]">
                      <input type="hidden" id="WhenTdsCutDebit1" name="base_amt_Debit[]">
                      <input type="hidden" id="totalAlocSessAmt1" name="totAlocSessAmt[]">
                      <input type="hidden" id="isBillTrckChk1" value="0">
                    </td>

                    <td class="tdthtablebordr"  style="width: 20%;">
                      <input type='text' class="debitcreditbox inputboxclr cr_amount tabnext" id='cr_amount1' name="cr_amount[]"  readonly onkeypress='NumberCredit()' oninput='GetCreditAmount(1)'/><br>
                      <div id="billTkCr1" style="display: inline-flex;"></div>
                      <div id="bilNotFoundcr1" class="bilNotFstle"></div>
                      <input type="hidden" id="resultofcredit1" name="CredittdsAmt[]">
                      <input type="hidden" id="Applytdsonamtforcr1" name="TdsCreditAmount[]">
                      <input type="hidden" id="WhenTdsCutCredit1" name="base_amt_Credit[]">
                      <input type="hidden" id="base_amount1" name="base_amount[]">
                    </td>

                  </tr>
                </table><!-- /. table-->
              </div><!-- /. table-responsive-->

              <div class="row">

                <div class="col-md-5">
                  <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>
                  <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
                </div>

                <div id="showgreatermsg" style="text-align: end;color: red;"></div>
                <input type="hidden" name="series_code" id="hidnseried"> 
                <input type="hidden" name="series_name" id="hidnseriesName"> 
                <input type="hidden" name="gl_code" id="hidnglcode"> 
                <input type="hidden" name="gl_name" id="hidnglnme">
                <input type="hidden" name="bank_codenum" id="hidnbanknme">
                <input type="hidden" name="vrno" id="hidnvrseq">
                <input type="hidden" name="tran_code" id="hidntranscd">
                <input type="hidden" name="vr_type" id="hidnvrtyp">
                <input type="hidden" name="company_code" id="hidncopmnm">
                <input type="hidden" name="fy_code" id="hidnfyyear">
                <input type="hidden" name="vr_date" id="hidnvrdte">
                <input type="hidden" name="pfct_code" id="hidnpfitid">
                <input type="hidden" name="pfct_name" id="hidngpfitnme">

                <div class="col-md-5" style="float: right;">
                  <div style="display:flex;float: right;">
                    <div class="toalvaldesn">Total :</div>
                    <input class="debitotldesn inputboxclr" type="text" name="TotlDebit" id="totldramt" readonly>
                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit"  id="totlcramt" readonly>
                  </div>
                  
                </div>
                  
              </div><!-- /. row-->

              <div class="row" style="text-align:center;"> 
                
                <input type="hidden" name="rowCount" id="rowCount" value="">
                <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
                <button type="button" class="btn btn-primary btn-xs" id="simulation_btn" data-toggle="modal" data-target="#simulation_model" onclick="simulationcal(1);" disabled>Simulation</button>
                <button class="btn btn-success" type="button" id="submitdata" onclick="submitCBData(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>
                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>
                <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitCBData(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button>
                <a class="btn btn-success btnprn" type="button" id="saveAndPrint" onclick="submitCBData(2)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Print</a>
              </div><!-- /. row-->

<!------- MODAL FOR GL DETAIL ------------>
              <div class="modal fade" id="gl_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

                  <div class="modal-content" style="border-radius: 5px;">

                    <div class="modal-header">
                      <div class="row">
                        <div class="col-md-12">
                          <h5 class="modal-title modltitletext" id="exampleModalLabel">Gl Detail</h5>
                        </div>
                      </div>
                    </div>

                    <div class="modal-body table-responsive">
                      <div class="boxer" id="">

                        <div class="box-row">
                          <div class="box10 texIndbox1">GLSCH Code</div>
                          <div class="box10 rateIndbox">GL Code</div>
                          <div class="box10 rateIndbox">GL Name</div>
                          <div class="box10 rateBox">GL Type</div>
                        </div>
                        
                        <div class="box-row">
                          <div class="box10 itmdetlheading">
                            <span id="glschcshow"> </span>
                          </div>
                          
                          <div class="box10 itmdetlheading">
                            <span id="glcdshow"> </span>
                          </div>
                          <div class="box10 itmdetlheading">
                            <span id="glnshow"> </span>
                          </div>
                          <div class="box10 itmdetlheading">
                            <span id="gltypeshow"> </span>
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
<!------- MODAL FOR GL DETAIL ------------>

<!------- MODAL FOR SIMULATION ------------>

              <div class="modal fade in" id="simulation_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">

                <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">

                  <div class="modal-content" style="border-radius: 5px;">

                    <div class="modal-header">
                      <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                          <h5 class="modal-title modltitletext" id="exampleModalLabel">Simulation Of Cash / Bank</h5>
                        </div>
                        <div class="col-md-2"></div>
                      </div>
                    </div>

                    <div class="modal-body table-responsive">
                      <div class="boxer" id="siml_body" style="font-size: 12px;color: #000;">
                      </div>
                    </div>

                    <div class="modal-footer">
                        <span id="siml_footer1" style="width: 10px;"><button type="button" class="btn btn-primary " style="width: 10%;" data-dismiss="modal">Ok</button></span>
                    </div>

                  </div>

                </div>

              </div>

<!------- MODAL FOR SIMULATION ------------>

<!------- MODAL FOR CALCULATE TDS ------------>

              <div class="modal fade" id="tds_rate_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-sm" role="document" style="margin-top: 13%;">
                  <div class="modal-content" style="border-radius: 5px;">
                    <div class="modal-header">
                      <h5 class="modal-title modltitletext" id="exampleModalLabel">Calculate TDS</h5>
                    </div>
                    <div class="modal-body">
                      <div class="row tdsInputBox">
                          <div class="col-md-4">
                            <label class="textSizeTdsModl">Tds Section</label>
                            
                          </div>
                          <div class="col-md-4">
                            <input type="text" id="tds_name1" name="tds_section[]" value="" readonly>
                          </div>
                          <div class="col-md-2"></div>
                      </div>
                      <div class="row tdsInputBox">
                          <div class="col-md-4">
                            <label class="textSizeTdsModl">Tds Rate</label>
                            
                          </div>
                          <div class="col-md-4">
                            <input type="text" id="tdsRate1" readonly style="text-align: right;">
                          </div>
                          <div class="col-md-2"></div>
                      </div>
                      <div class="row tdsInputBox">
                          <div class="col-md-4">
                            <label class="textSizeTdsModl">Tds Base Amount</label>
                            
                          </div>
                          <div class="col-md-4">
                            
                            <input type="text" id="Net_amount1" readonly style="text-align: right;">
                          </div>
                          <div class="col-md-2"></div>
                      </div>
                      <div class="row tdsInputBox">
                          <div class="col-md-4">
                            <label class="textSizeTdsModl">Tds Amount calculate</label>
                            
                          </div>
                          <div class="col-md-4">
                            <input type="text" id="tds_Amt_cal1" readonly style="text-align: right;">
                          </div>
                          <div class="col-md-2"></div>
                      </div>
                      <div class="row tdsInputBox">
                          <div class="col-md-4">
                            <label class="textSizeTdsModl">Net Amount</label>
                            
                          </div>
                          <div class="col-md-4">
                            <input type="hidden" id="tds_base_Amt1" name="baseTDSAmt[]" value="" oninput="changetdsamt(1)">
                            <input type="text" id="deduct_tds_Amt1" readonly name="base_amt_tds[]" style="text-align: right;">
                          </div>
                          <div class="col-md-2"></div>
                      </div>
                    </div>
                    <div class="modal-footer" style="text-align: center;">
                      <button type="button" class="btn btn-primary" style="width: 27%;" data-dismiss="modal" id="ApplyTds1" onclick="Applytds(1)">Apply TDS</button>
                      <button type="button" class="btn btn-warning" style="width: 20%;" data-dismiss="modal" onclick="cancleBtntds(1)">Cancle</button>
                    </div>
                  </div>
                </div>
              </div>

<!------- MODAL FOR CALCULATE TDS ------------>

<!------- MODAL FOR CALCULATE TDS ------------>
              
              <div class="modal fade" id="ViewBT_Detail1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">

                  <div class="modal-content" style="border-radius: 5px;">

                    <div class="modal-header">

                      <div class="row">
                        <div class="col-md-12">
                          <h4 class="modal-title modltitletext" id="exampleModalLabel">Bill Tracking</h4>
                        </div>
                      </div>

                    </div>
                    <div style="margin-top: 17px;text-align: center;">
                      <small class="headstyle"> Party Name : </small> <small class="datastyle" id="partyNameBT1" style="margin-right: 5%;"></small>
                      <small class="headstyle">Vr. No.:</small> <small class="datastyle" id="vrnoBT1" style="margin-right: 5%;"></small>
                      <small class="headstyle">Date:</small> <small class="datastyle" id="dateBT1"></small>
                    </div>
                    <div class="modal-body table-responsive">
                      <div id="noBillTrkFMsg1"></div>
                      <div class="boxer" id="biltrkBody1">

                      </div>
                    </div>

                    <div class="modal-footer" style="text-align: center;">
                     
                      <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;" id="bilTrackSaveBtn1" onclick="saveBillTrack(1);">Save</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;" onclick="cancleBillTrack(1)">Cancle</button>

                    </div>

                  </div>

                </div>

              </div>

<!------- MODAL FOR CALCULATE TDS ------------>

<!------- MODAL FOR PAYMENT ADVICE ------------>
              
              <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showallPayment1">
                <div class="modal-dialog modal-md" role="document">
                  <div class="modal-content" style="border-radius: 5px;">
                    <div class="modal-header">
                      <h5 class="modal-title modltitletext" id="exampleModalLabel" style="font-size: 17px;">Payment Advice</h5>
                    </div>
                    <div class="modal-body" id="payAdviceTable1">
                       <section>
                          <ol class="collection collection-container simulationOl">
                            <!-- The first list item is the header of the table -->
                            

                          <!-- The rest of the items in the list are the actual data -->
                          </ol>
                        </section>
                    </div>
                    <div class="modal-footer">

                      <button type="button" class="btn btn-primary" data-dismiss="modal" id="payAdvicsave" onclick="getadvicePay(1)">Ok</button>
                    </div>
                  </div>
                </div>
              </div>

<!------- MODAL FOR PAYMENT ADVICE ------------>

<!------- MODAL FOR PAYMENT ADVICE ------------>

              <div class="modal fade" id="accCd_detail1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                          <div class="box10 texIndbox1">Acc Name/Acc Code</div>
                          <div class="box10 rateIndbox">Acc Type Code </div>
                          <div class="box10 rateIndbox">Address1</div>
                          <div class="box10 rateBox">city</div>
                          <div class="box10 rateBox">state</div>
                          <div class="box10 rateBox">Email</div>
                          <div class="box10 rateBox">Phone No</div>
                        </div>
                        
                        <div class="box-row">
                          <div class="box10 itmdetlheading">
                            <span id="accNameCodeshow1"> </span>
                          </div>
                          <div class="box10 itmdetlheading">
                            <span id="AcctypCde1"> </span>
                          </div>
                          <div class="box10 itmdetlheading">
                            <span id="Addres1show1"> </span>
                          </div>
                          <div class="box10 itmdetlheading">
                            <span id="cityacshow1"> </span>
                          </div>
                          <div class="box10 itmdetlheading">
                            <span id="stateacshow1"> </span>
                          </div>
                          <div class="box10 itmdetlheading">
                            <span id="emailacshow1"> </span>
                          </div>
                          <div class="box10 itmdetlheading">
                            <span id="phonenoacshow1"> </span>
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

<!------- MODAL FOR PAYMENT ADVICE ------------>

            </form><!-- /. form-->

          </div><!-- /. box-body-->

        </div><!-- /. Custom-Box-->

      </div><!-- /. col-->

    </div><!-- /. row-->

  </section><!-- /. section-->
</div> <!-- /. content-wrapper-->
      

@include('admin.include.footer')


<script src="{{ URL::asset('public/dist/js/viewjs/cash_bank_trans.js') }}" ></script>
<script src="{{ URL::asset('public/dist/js/viewjs/jquery.printPage.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.btnprn').printPage();
  });
</script>

<script>

  $(".delete").on('click', function() {

    $('.case:checkbox:checked').parents("tr").remove();
    $('.check_all').prop("checked", false); 

    var sum = 0;
    //dr amount
    $(".dr_amount").each(function () {

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

  function select_all() {
    $('input[class=case]:checkbox').each(function(){ 
        if($('input[class=check_all]:checkbox:checked').length == 0){ 
            $(this).prop("checked", false); 
        } else {
            $(this).prop("checked", true); 
        } 
    });
  }

  function check(){
      obj = $('table tr').find('span');
      $.each( obj, function( key, value ) {
          id=value.id;
          $('#'+id).html(key+1);
      });
  }

  var i=2;
  $(".addmore").on('click',function(){

    var vrType =  $('#vr_type').val();

    if(vrType == 'Payment'){
      var getpaymode = 'To -';
    }else if(vrType == 'Receipt'){
     var getpaymode='By -';
    }

    count=$('table tr').length;
    var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/><span id='snum"+i+"'>"+count+".</span></td><td class='tdthtablebordr'><small class='glcodeCls'>Gl Code</small><br><small class='accCodeCls'>Cost Code</small><br><small class='accCodeCls'>Account Code</small><br><label for='' class='instrumentlbl'>I Type</label><br><button type='button' class='btn btn-primary btn-xs tdsratebtn tdsratebtnHide' id='tds_rate"+i+"' data-toggle='modal' data-target='#tds_rate_model"+i+"' onclick='CalculateTdsRate("+i+")' disabled>Calc TDS</button><div id='appliedbtn"+i+"'></div><div id='canclebtn"+i+"'></div><input type='hidden' id='tdsByAccCode"+i+"' value='' name='tdsCodeByAc[]'> <input  type='hidden' name='tds_rate[]' id='TdsRateByAccCode"+i+"' class='getRateForAcc'><input type='hidden' name='tds_code[]' id='TdsSection"+i+"'><input type='hidden' name='' id='accNtdsrate"+i+"'><input type='hidden' id='ledgrAmt"+i+"' name='ledgrAmt[]'></td>";
    data +="<td class='tdthtablebordr'><div class='input-group'><input list='glCodeNameList"+i+"' class='inputboxclr glcodeGets tabnext' style='width: 100%;;margin-bottom: 5px;' id='glCodeName"+i+"'  name='glCodeName[]' onchange='glcodeNameData("+i+");'><datalist id='glCodeNameList"+i+"'>@foreach ($gl_list as $key)<option value='<?php echo $key->GL_CODE; ?>' data-xyz ='<?php echo $key->GL_NAME; ?>' ><?php echo $key->GL_NAME; echo ' ['.$key->GL_CODE.']' ; ?></option> @endforeach </datalist><input type='hidden' id='acctTag"+i+"' value=''><input type='hidden' id='costcTag"+i+"' value=''></div><div class='input-group'><input list='costCenterList"+i+"' class='inputboxclr tabnext' style='width: 100%;margin-bottom: 5px;' id='costCenter"+i+"'  name='costCenterCd[]' onchange='costCenterCdData("+i+");' placeholder='Select Cost Center Code'  readonly autocomplete='off'><datalist id='costCenterList"+i+"'>@foreach ($cost_list as $key)<option value='<?php echo $key->COST_CODE?>' data-xyz ='<?php echo $key->COST_NAME; ?>' ><?php echo $key->COST_NAME; echo ' ['.$key->COST_CODE.']' ; ?></option>@endforeach</datalist></div><div class='displyinline'><div class='input-group'><input list='AccList"+i+"' class='inputboxclr getacccode ' tabindex='"+i+"' style='width: 100%;margin-bottom: 5px;' id='acc_code"+i+"' name='acc_code[]'  onchange='GetAccountCode("+i+")' readonly oninput='this.value = this.value.toUpperCase()'/><datalist id='AccList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($acc_list as $key)<option value='<?php echo $key->ACC_CODE; ?>' data-xyz ='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME ; echo ' ['.$key->ACC_CODE.']' ; ?></option>@endforeach</datalist></div><div class='' id='appndplantbtn'><button type='button' data-toggle='modal' data-target='#accCd_detail"+i+"' onclick='getAccDetail("+i+")' id='accbtn"+i+"' disabled class='btn btn-xs btn-info gly-radius' data-original-title='' title='' style='padding: 0px 5px 0px 5px;'> <i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i></button></div></div><input type='hidden' id='acc_class"+i+"' name='accClass[]'><input type='hidden' id='acc_type"+i+"' name='accType[]'><input type='hidden' name='gltdscode[]' id='GettdsCode"+i+"'><input type='hidden' name='gltdsname[]' id='GettdsName"+i+"'><div style='display:flex;'><input list='InstTypeList"+i+"'  id='inst_type"+i+"' class='instTypeMode getinstrument' tabindex='"+i+"' name='instrument_type[]' onchange='changedate("+i+")' placeholder='Select Transporter' onchange='ITypeChng("+i+")'><datalist id='InstTypeList"+i+"'><option selected='selected' value=''>-- Select --</option><option value='CH' data-xyz ='Cheque'>Cheque[CH]</option><option value='DD' data-xyz ='Demand Draft'>Demand Draft[DD]</option><option value='TR' data-xyz ='Transfer receipt'>Transfer receipt[TR]</option><option value='TT' data-xyz ='Tele Transfer'>Tele Transfer[TT]</option><option value='MT' data-xyz ='Money Transfer'>Money Transfer[MT]</option><option value='RT' data-xyz ='RTGS'>RTGS[RT]</option><option value='BA' data-xyz ='Bank Advise'>Bank Advise[BA]</option><option value='EC' data-xyz ='Electronic Clearence'>Electronic Clearence[EC]</option><option value='NEFT' data-xyz ='National Electronic Funds Transfer'>National Electronic Funds Transfer[NEFT]</option><option value='IMPS' data-xyz ='Immediate Payment Service'>Immediate Payment Service[IMPS]</option><option value='UPI' data-xyz ='Unified Payments Interface'>Unified Payments Interface[UPI]</option><option value='NA' data-xyz ='Not Applicable'>Not Applicable[NA]</option></datalist><input type='text' class='inputboxclr' tabindex='"+i+"' style='width: 72px;margin-bottom: 4px;' id='cheque_no"+i+"' name='instrument_no[]' placeholder='Number' oninput='GetChkNo("+i+");'/></div><div class='input-group datehide' id='showdate"+i+"'><input type='text' name='chquedate[]' id='chquedate"+i+"' class='form_date' placeholder='select date' style='width: 100%;'><i class='fa fa-calendar form-control-feedback' style='line-height: 26px;'></i></div><div class='input-group'><input list='bankList"+i+"'  id='bankid"+i+"' name='bank_code[]' class='inputboxclr bankshowwhenrecpt' style='width: 100%;margin-bottom: 5px;display: inline-block;' placeholder='Enter Bank' onchange='banklistget("+i+")' oninput='this.value = this.value.toUpperCase()'><datalist id='bankList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($bank_list as $key)<option value='<?php echo $key->BANK_CODE; ?>'   data-xyz ='<?php echo $key->BANK_NAME; ?>' ><?php echo $key->BANK_NAME ; echo ' ['.$key->BANK_CODE.']' ; ?></option>@endforeach</datalist></div><small id='bank_name_err"+i+"' style='color: red;'></small><small><div class='pull-left showSeletedName' id='bankText"+i+"'></div></small></td> <td class='tdthtablebordr'><div class='row'><input type='text' class='inputboxclr getglCNAme' style='width: 92%;margin-bottom: 5px;' id='genrl_name"+i+"' placeholder='Enter Gl Name' name='genrl_name[]' readonly /></div><div class='row'><input type='text' class='inputboxclr getglCNAme' style='width: 92%;margin-bottom: 5px;' placeholder='Enter Cost Center Name' id='costCenter_name"+i+"' name='costCenter_name[]' readonly /></div><div class='row'><input type='text' class='inputboxclr getAccNAme' style='width:92%;margin-bottom: 5px;' id='acc_name"+i+"' name='acc_name[]' placeholder='Enter Account Name' readonly/></div><div class='row'><input type='text' class='textdesciptn discription' name='particular[]' id='discription"+i+"'  value="+getpaymode+" readonly></div><div class='row'><div class='input-group' style='display:flex;'><input list='remarkList"+i+"' class='tabnext textdesciptn' id='ref"+i+"' name='ref_text[]' placeholder='Enter Remark' oninput='this.value = this.value.toUpperCase()' style='margin-left: 4%;'/><datalist id='remarkList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($remark_list as $key)<option value='To - <?php echo $key->REMARK?>' data-xyz ='To - <?php echo $key->REMARK; ?>' >To - <?php echo $key->REMARK ; ?></option>@endforeach</datalist></div></div><div class='row'><input type='text' id='ShowBankName"+i+"' style='width: 250px;margin-bottom: 2%;' class='bankNameGet' readonly></div><input type='hidden' name='blankVal[]' value=''></td><td class='tdthtablebordr'><input type='text' class='debitcreditbox dr_amount inputboxclr' tabindex='"+i+"'  id='dr_amount"+i+"' name='dr_amount[]' onkeypress='NumberCredit()' oninput='GetDebitAmount("+i+")' readonly/><div id='billTkDr"+i+"' style='display: inline-flex;'></div><input type='hidden' id='totalnetGetamt"+i+"'><input type='hidden' id='resultofdebit"+i+"' name='DebitdsAmt[]'><input type='hidden' id='Applytdsonamt"+i+"' name='TdsDebitAmount[]'><input type='hidden' id='WhenTdsCutDebit"+i+"' name='base_amt_Debit[]'><input type='hidden' id='isBillTrckChk"+i+"' value='0'><input type='hidden' id='totalAlocSessAmt"+i+"' name='totAlocSessAmt[]'></td><td class='tdthtablebordr'><input type='text' class='debitcreditbox cr_amount inputboxclr' tabindex='"+i+"'  id='cr_amount"+i+"' name='cr_amount[]' onkeypress='NumberCredit()' oninput='GetCreditAmount("+i+")' readonly/><div id='billTkCr"+i+"' style='display: inline-flex;'></div><input type='hidden' id='resultofcredit"+i+"' name='CredittdsAmt[]'><input type='hidden' id='Applytdsonamtforcr"+i+"' name='TdsCreditAmount[]'><input type='hidden' id='WhenTdsCutCredit"+i+"' name='base_amt_Credit[]'><input type='hidden' id='base_amount"+i+"' name='base_amount[]'><div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' data-keyboard='false' data-backdrop='static'><div class='modal-dialog modal-sm' role='document' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Calculate TDS</h5></div><div class='modal-body'><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Section</label></div><div class='col-md-4'><input type='text' id='tds_name"+i+"' name='tds_section[]' value='' readonly></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Rate</label></div><div class='col-md-4'><input type='text' id='tdsRate"+i+"' readonly style='text-align: right;'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Base Amount</label> </div><div class='col-md-4'><input type='text' id='Net_amount"+i+"' readonly style='text-align: right;'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Amount calculate </label></div><div class='col-md-4'><input type='text' id='tds_Amt_cal"+i+"' readonly style='text-align: right;'></div> <div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Net Amount</label></div><div class='col-md-4'><input type='hidden' id='tds_base_Amt"+i+"' value='' name='baseTDSAmt[]' oninput='changetdsamt("+i+")'><input type='text' id='deduct_tds_Amt"+i+"' readonly name='base_amt_tds[]' style='text-align: right;'></div><div class='col-md-2'></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' style='width: 27%;'data-dismiss='modal' id='ApplyTds"+i+"' onclick='Applytds("+i+")'>Apply TDS</button><button type='button' class='btn btn-warning' style='width: 20%;' data-dismiss='modal' onclick='cancleBtntds("+i+")'>Cancle</button></div></div></div></div><div class='modal fade' id='accCd_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Account Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Acc Name/Acc Code</div><div class='box10 rateIndbox'>Acc Type Code </div><div class='box10 rateIndbox'>Address1</div><div class='box10 rateBox'>Address2</div><div class='box10 rateBox'>Address3</div><div class='box10 rateBox'>city</div><div class='box10 rateBox'>state</div><div class='box10 rateBox'>Email</div><div class='box10 rateBox'>Phone No</div></div><div class='box-row'><div class='box10 itmdetlheading'><span id='accNameCodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='AcctypCde"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='Addres1show"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='Addres3show"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='cityacshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='stateacshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='emailacshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='phonenoacshow"+i+"'> </span></div></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div><div class='modal fade' id='ViewBT_Detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-lg' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h4 class='modal-title modltitletext' id='exampleModalLabel'>Bill Tracking</h4></div></div></div><div style='margin-left: 17px;text-align: initial;'><small class='headstyle'> Party Name : </small> <small class='datastyle' id='partyNameBT"+i+"'></small><br><small class='headstyle'>Vr. No.:</small> <small class='datastyle' id='vrnoBT"+i+"'></small><br><small class='headstyle'>Date:</small> <small class='datastyle' id='dateBT"+i+"'></small><br></div><div class='modal-body table-responsive'><div id='noBillTrkFMsg"+i+"'></div><div class='boxer' id='biltrkBody"+i+"'></div></div><div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;' id='bilTrackSaveBtn"+i+"' onclick='saveBillTrack("+i+");'>Save</button><button type='button' class='btn btn-danger' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Cancle</button></div></div></div></div><div class='modal fade bd-example-modal-lg' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true' id='showallPayment"+i+"'><div class='modal-dialog modal-md' role='document'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title modltitletext' id='exampleModalLabel' style='font-size: 17px;'>Payment Advice</h5></div><div class='modal-body' id='payAdviceTable"+i+"'><section><ol class='collection collection-container simulationOl'><!-- The first list item is the header of the table --><!-- The rest of the items in the list are the actual data --></ol></section></div><div class='modal-footer'><button type='button' class='btn btn-primary' data-dismiss='modal' id='payAdvicsave' onclick='getadvicePay("+i+")'>Ok</button></div></div></div></div></td></tr>";
    $('table').append(data);


    $('#glCodeName'+i).prop('readonly',false);
    $('#acc_code'+i).prop('readonly',false);
    $('#costCenter'+i).prop('readonly',false);
    $('#glCodeName'+i).css('border-color','#ff0000');

    i++;

  });
</script> 

<script>
  
  $(document).ready(function() {

    var na = 1;
    $('.tabnext').each(function() {         
        $(this).attr('tabindex', na++);
    });

    $('body').on('focus',".form_date", function(){
      $(this).datepicker({
              format: 'dd-mm-yyyy',
              orientation: 'bottom',
              todayHighlight: 'true',
              autoclose: 'true'

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

function changedate(datevalue){

    var insttype = $("#inst_type"+datevalue).val();

    
    if(insttype=='CH'){

      $("#showdate"+datevalue).removeClass('datehide');

    }else{
      $("#showdate"+datevalue).addClass('datehide')
    }

  }

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
                      $('#hidnvrseq').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);
                      $('#hidnvrseq').val(lastNo);
                    }
                  }

                  if(data1.data == ''){

                  }else{
                    $('#gl_code').val(data1.data[0].GL_CODE);
                    $('#gl_name').val(data1.data[0].GL_NAME);
                    $('#hidnglcode').val(data1.data[0].GL_CODE);
                    $('#hidnglnme').val(data1.data[0].GL_NAME);
                    $('#glNameTooltip').removeClass('tooltiphide');
                    $('#glNameTooltip').html(data1.data[0].GL_NAME);
                    var glcodeh = $('#gl_code').val();
                    if(glcodeh){
                        $('#firsticon').css('display','none');
                        $('#appndplantbtn').html('<button type="button" data-toggle="modal" data-target="#gl_detail" onclick="getgldata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
                    }else{
                    }
                  }

                  /* ---------- get cheque no deatils ------- */

                  console.log('data1.chqNoList',data1.chqNoList);
                  $("#chequeNoList1").empty();

                  if(data1.chqNoList == ''){

                  }else{


                    $.each(data1.chqNoList, function(k, getData){

                        var upId = getData.CHEQUENO+'~'+getData.CHQBHID+'~'+getData.CHQBBID+'~'+getData.SLNO;
                        $("#chequeNoList1").append($('<option>',{

                          value:getData.CHEQUENO,

                          'data-xyz':upId


                        }));

                    });

                  }
                    /* ---------- get cheque no deatils ------- */

              }

          }

    });

  }

function getgldata(){

   $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

    });

    var series_code =  $('#series_code').val();

    $.ajax({

              url:"{{ url('gl_code_by_series_code') }}",

              method : "POST",

              type: "JSON",

              data: {series_code: series_code},

              success:function(data){

                  var data1 = JSON.parse(data);
                    
                  if (data1.response == 'error') {

                          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                            
                  }else if(data1.response == 'success'){

                      if(data1.data==''){

                      }else{
                        console.log('data1.data',data1.gl_data.GLSCH_CODE);
                        $('#glschcshow').html(data1.gl_data.GLSCH_CODE);
                        $('#glcdshow').html(data1.gl_data.GL_CODE);
                        $('#glnshow').html(data1.gl_data.GL_NAME);
                        $('#gltypeshow').html(data1.gl_data.GLSCH_TYPE);


                      }

                  }
              }
    });

}

function GetAccountCode(Accid){

      var account_code =  $('#acc_code'+Accid).val();

      var xyz = $('#AccList'+Accid+' option').filter(function() {

      return this.value == account_code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      console.log('msg',msg);

      if(msg=='No Match'){

         $('#acc_code'+Accid).val('');
         $('#dr_amount'+Accid).val('');
         $("#ref"+Accid).prop('readonly',true);
         
      }else{
        $("#accbtn"+Accid).prop('disabled',false);
        $("#ref"+Accid).prop('readonly',false);
      }

      chekvalOnGl(Accid);

        

      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var accountcode =  $('#acc_code'+Accid).val();

      $.ajax({

          url:"{{ url('acc-code-for-cash-bank') }}",
          method : "POST",
          type: "JSON",
          data: {accountcode: accountcode},

          success:function(data){

            var data1 = JSON.parse(data);
               
            if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

            }else if(data1.response == 'success'){

                if(data1.data==''){
                  var accNAme = '';
                  var accclas = '';
                  var accType = '';
                  var nottds = '';
                  $('#acc_name'+Accid).val(accNAme);
                  $('#acc_class'+Accid).val(accclas);
                  $('#acc_type'+Accid).val(accType);
                  $('#tdsByAccCode'+Accid).val(nottds);
                   $('#viewItemDetail'+Accid).addClass('showdetail');
                  $('#itemNameTooltip'+Accid).addClass('tooltiphide'); 
                }else{
                   $('#itemNameTooltip'+Accid).removeClass('tooltiphide'); 

                  $('#itemNameTooltip'+Accid).html(data1.data[0].ACC_CODE); 
                  $('#tdsByAccCode'+Accid).val(data1.data[0].TDS_CODE);
                  $('#acc_name'+Accid).val(data1.data[0].ACC_NAME);
                  $('#acc_class'+Accid).val(data1.data[0].ACLASS_CODE);
                  $('#acc_type'+Accid).val(data1.data[0].ATYPE_CODE);
                }

                if(data1.data_tds == ''){
                  var acctdsrte = '';
                  var NotgetTdsRate = '';
                  var tdssection ='';
                  $('#accNtdsrate'+Accid).val(acctdsrte);
                  $('#TdsRateByAccCode'+Accid).val(NotgetTdsRate);
                   $('#TdsSection'+Accid).val(tdssection);
                }else{
                  $('#accNtdsrate'+Accid).val(data1.data_tds[0].ACC_CODE);
                  $('#TdsRateByAccCode'+Accid).val(data1.data_tds[0].TDS_RATE);
                  $('#TdsSection'+Accid).val(data1.data_tds[0].TDS_CODE);
                }
                
                var tdsByAccCodeExist = $('#tdsByAccCode'+Accid).val();

                if(tdsByAccCodeExist){
                      $('#tds_rate'+Accid).removeClass('tdsratebtnHide');
                }else{
                    $('#tds_rate'+Accid).addClass('tdsratebtnHide');
                }
                  
                var sectionCode =  $('#TdsSection'+Accid).val();
                if(sectionCode == ''){
                    $('#GettdsCode'+Accid).val('');
                    $('#GettdsName'+Accid).val('');
                }else{}

                showpaymentAdvice(Accid);

            }
          }

      });
}

function showpaymentAdvice(payId){

    $("#showallPayment"+payId).modal({
        show:false,
        backdrop:'static',
      });

    var acc_code = $('#acc_code'+payId).val();
    var vr_no = $("#vrseqnum").val();
    var trans_code = $("#transcode").val();

    if(acc_code){

      $.ajax({

            url:"{{ url('get_advice_by_payment_advice') }}",
            method : "POST",
            type: "JSON",
            data: {acc_code: acc_code},

            success:function(data){

                var obj = JSON.parse(data);
               
                if(obj.response=='success'){

                  $("#payAdviceTable"+payId).empty();

                  var paymntHead = "<li class='item item-containerPay' style='border-top: 1px solid;background-color: antiquewhite;'><div class='attribute' data-name='#' style='border-left: 1px solid gray;'>Sr.No.</div><div class='attribute-container part-information'><div class='attribute-container part-id'><div class='attribute' data-name='Part Number'>Vr Date</div></div></div><div class='attribute-container cost'><div class='attribute'>Vr No</div></div><div class='attribute-container cost'><div class='attribute'>T Code</div></div><div class='attribute-container freight'><div class='attribute'>Advice Amt</div></div><div class='attribute-container freight'><div class='attribute'>Net Pay</div></div></li>";

                  $("#payAdviceTable"+payId).append(paymntHead);

                  var sr_no =1;
                  $.each(obj.data,function(key,value){

                    var splitDate =value.VRDATE.split('-');
                    var getvrDate = splitDate[2]+'-'+splitDate[1]+'-'+splitDate[0];

                    if(value.TRAN_CODE){
                      var classname = '';
                    }else{
                      var classname = 'hideshow_li';
                    }

                    var paymnt = "<li class='item item-containerPay "+classname+"' id='hideShow_"+payId+"_"+sr_no+"'><div class='attribute' data-name='#' style='border-left: 1px solid gray;'>"+sr_no+"<input type='checkbox' name='allcheck[]' class='checkRowSub' id='checkboxid_"+payId+"_"+sr_no+"' value="+value.PAYID+" onclick='setOnOff("+payId+","+sr_no+")' style='margin-left: 5px;'></div><div class='attribute-container part-information'><div class='attribute-container part-id'><div class='attribute rightcontent' data-name='Part Number'>"+getvrDate+"<input type='hidden' value="+value.ACC_CODE+" name='pay_acc_code' id='pay_acc_code'></div></div></div><div class='attribute-container cost'><div class='attribute rightcontent'>"+value.VRNO+"<input type='hidden' value="+value.VRNO+"name='pay_vr_no' id='pay_vr_no'></div></div><div class='attribute-container cost'><div class='attribute'>"+value.TRAN_CODE+"</div></div><div class='attribute-container freight'><div class='attribute rightcontent'>"+value.ADVICE_AMT+"<input type='hidden' value="+value.ADVICE_AMT+" name='pay_advice_amt' id='pay_advice_amt_"+payId+"_"+sr_no+"'></div></div><div class='attribute-container freight'><div class='attribute rightcontent'>"+value.NET_AMT+"<input type='hidden' value="+value.PAY_FLAG+" name='pay_flag' id='pay_flag'><input type='hidden' value="+value.NET_AMT+" id='netPayAmt_"+payId+"_"+sr_no+"'><input type='hidden' value='off' name='onoffcheck' id='onOff_"+payId+"_"+sr_no+"' ><input type='hidden' value="+value.PMT_TRAN_CODE+"  id='pmtTCode_"+payId+"_"+sr_no+"' ><input type='hidden' value="+value.PMT_SERIES+"  id='pmtSeries_"+payId+"_"+sr_no+"' ><input type='hidden' value="+value.PMT_VRNO+"  id='pmtvrno_"+payId+"_"+sr_no+"' ></div></div></li>";
                  
                      sr_no++;
                      //  alert(paymnt);
                    $("#payAdviceTable"+payId).append(paymnt);
                    $('#showallPayment'+payId).modal('show');
                     
                  });
                }
            }

      });
        
    }
}

function CalculateTdsRate(TdsId){   
   
      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var tdsCode = $('#tdsByAccCode'+TdsId).val();
      var acCode = $('#acc_code'+TdsId).val();

      
      $.ajax({

            url:"{{ url('tds-rate-calculate') }}",

            method : "POST",

            type: "JSON",

            data: {tdsCode: tdsCode,acCode:acCode},

            success:function(data){

              var data1 = JSON.parse(data);
                                   
              if (data1.response == 'error') {

                  $('#tds_rate_model'+TdsId).modal('toggle'); 

                  $('#tds_rate'+TdsId).prop('disabled',true);

                  $('#appliedbtn'+TdsId).html('<small class="label label-danger">TDS Not Found...!</small></div>');                      

              }else if(data1.response == 'success'){

                  $('#tds_name'+TdsId).val(data1.tds_name[0].TDS_CODE+' - '+data1.tds_name[0].TDS_NAME);
                  $('#tdsRate'+TdsId).val(data1.data[0].TDS_RATE);
                  $('#TdsRateByAccCode'+TdsId).val(data1.data[0].TDS_RATE);
                  var dr_amt = parseFloat($('#dr_amount'+TdsId).val());
                  var cr_amount = parseFloat($('#cr_amount'+TdsId).val());

                  if(dr_amt){
                    $('#tds_base_Amt'+TdsId).val(dr_amt);
                    $('#Net_amount'+TdsId).val(dr_amt);
                  }else{
                    $('#tds_base_Amt'+TdsId).val(cr_amount);
                    $('#Net_amount'+TdsId).val(cr_amount);
                  }

                  var tdsRateval = parseFloat($('#tdsRate'+TdsId).val());
                  var tdsbaseamtval = parseFloat($('#tds_base_Amt'+TdsId).val());

                  var calculatPercnt = tdsbaseamtval / 100 * tdsRateval;

                  var deductBAmtWTdsAmt = tdsbaseamtval - parseFloat(calculatPercnt);
                  $('#deduct_tds_Amt'+TdsId).val(deductBAmtWTdsAmt.toFixed(2));
                  $('#tds_Amt_cal'+TdsId).val(calculatPercnt.toFixed(2));
                  
              }
            }

      });  
}

function getAccDetail(accd){

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    var accCode =  $('#acc_code'+accd).val();

    $.ajax({

          url:"{{ url('/get-acc-data-by-acc-code-cash-bank') }}",

          method : "POST",

          type: "JSON",

          data: {accCode: accCode},

          success:function(data){

            var data1 = JSON.parse(data);
              
            if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                      
            }else if(data1.response == 'success'){

                if(data1.data==''){

                }else{
                  $('#accNameCodeshow'+accd).html(data1.data[0].ACC_CODE);
                  $('#AcctypCde'+accd).html(data1.data[0].ATYPE_CODE);
                  $('#Addres1show'+accd).html(data1.data[0].ADD1);
                  $('#Addres3show'+accd).html(data1.data[0].ADD3);
                  $('#cityacshow'+accd).html(data1.data[0].CITY_CODE);
                  $('#stateacshow'+accd).html(data1.data[0].STATE_CODE);
                  $('#emailacshow'+accd).html(data1.data[0].EMAIL_ID);
                  $('#phonenoacshow'+accd).html(data1.data[0].CONTACT_NO);
                }

            }
          }
    });

}

function Applytds(aplytdsval){

    var NetAmount = $('#Net_amount'+aplytdsval).val();
    var TdsRate = $('#tdsRate'+aplytdsval).val();
    var DebitAmt = $('#dr_amount'+aplytdsval).val();
    var CreditAmt = $('#cr_amount'+aplytdsval).val();
    var deduct_tds_Amt = $('#deduct_tds_Amt'+aplytdsval).val();
    //console.log(deduct_tds_Amt.toFixed(2));
    var calculateResult =  parseFloat(NetAmount) / 100 * parseFloat(TdsRate);

    if(DebitAmt){
      if(calculateResult){
        $('#resultofdebit'+aplytdsval).val(calculateResult.toFixed(2));
        $('#Applytdsonamt'+aplytdsval).val(deduct_tds_Amt);
      }else{
        $('#resultofdebit'+aplytdsval).val(0);
         $('#Applytdsonamt'+aplytdsval).val(0);
      }

      var getdrCAmt = DebitAmt;
    }else{
      if(calculateResult){
        $('#resultofcredit'+aplytdsval).val(calculateResult.toFixed(2));
        $('#Applytdsonamtforcr'+aplytdsval).val(deduct_tds_Amt);
      }else{
        $('#resultofcredit'+aplytdsval).val(0);
         $('#Applytdsonamtforcr'+aplytdsval).val(0);
      }

      var getdrCAmt =CreditAmt;
    }

    $('#appliedbtn'+aplytdsval).html('<small class="label label-success"><i class="fa fa-check"></i>&nbsp; Applied</small></div>');
    $('#canclebtn'+aplytdsval).html('');

    var BaseAmountT = $('#deduct_tds_Amt'+aplytdsval).val();
    if(BaseAmountT){
     $('#base_amount'+aplytdsval).val(BaseAmountT);
    }else{
      $('#base_amount'+aplytdsval).val('');
    }

    var cutamtfrmamt = getdrCAmt -  BaseAmountT;
 
    $('#ledgrAmt'+aplytdsval).val(cutamtfrmamt.toFixed(2));
  
    $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });

    var tdssectionC = $('#tdsByAccCode'+aplytdsval).val();

    $.ajax({

          url:"{{ url('get-tds-name-n-code') }}",
          method : "POST",
          type: "JSON",
          data: {tdssectionC: tdssectionC},
          success:function(data){

            var data1 = JSON.parse(data);
       
            if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
            }else if(data1.response == 'success'){

                if(data1.data==''){
                  var tdsNAme = '';
                  var tdsCode = '';
                  $('#GettdsName'+aplytdsval).val(tdsNAme);
                  $('#GettdsCode'+aplytdsval).val(tdsCode);
                }else{
                  $('#GettdsName'+aplytdsval).val(data1.data.GL_NAME);
                  $('#GettdsCode'+aplytdsval).val(data1.data.GL_CODE);
                }  
            }
          }

    });
 
}

function getadvicePay(checkid){
      
    var paymentid =[];

    $(".checkRowSub").each(function (){
              
        if($(this).is(":checked")){

          paymentid.push($(this).val());
        }
    });
    var gettotalnetamt=0;

    for(var i=0;i<paymentid.length;i++){

      var seriesN = i +1;
          
      var netAmt = $('#pay_advice_amt_'+checkid+'_'+seriesN).val();

      // var gettotalnetamt = gettotalnetamt + parseFloat(netAmt);
      var gettotaldramt = gettotalnetamt + parseFloat(netAmt);
        
      var gettotalnetamt =  parseFloat(netAmt);
          
      $('#totalnetGetamt'+checkid).val(gettotaldramt.toFixed(2));

      var showindr = $('#totalnetGetamt'+checkid).val();

      if(showindr){
        $('#billTkDr'+checkid).html('<button type="button" class="btn btn-primary btn-xs viewBilTrak" id="ViewBillTrack'+checkid+'" data-toggle="modal" data-target="#ViewBT_Detail'+checkid+'" onclick="detailBillTrack('+checkid+')">Bill Track </button><div id="AplyIconBT'+checkid+'" style="padding-top: 5px;">');
     
        $('#dr_amount'+checkid).val(showindr).prop('readonly',true);
        $('#cr_amount'+checkid).prop('readonly',true);
        $('#totldramt').val(gettotaldramt.toFixed(2)).prop('readonly',true);
        $('#submitdata').prop('disabled',false);
        $('#submitdatapdf').prop('disabled',false);
        $('#simulation_btn').prop('disabled',false);
        $('#addmorhidn').prop('disabled',false);
        $('#deletehidn').prop('disabled',false);
      }else{
        $('#submitdata').prop('disabled',true);
        $('#submitdatapdf').prop('disabled',true);
        $('#simulation_btn').prop('disabled',true);
        $('#addmorhidn').prop('disabled',true);
        $('#deletehidn').prop('disabled',true);
      }
    }
}

function setOnOff(rowid,payval){

    var check = document.getElementById('checkboxid_'+rowid+'_'+payval);
    if(check.checked){

       // $('#checkboxid_'+rowid+'_'+payval).attr('checked',true);
        $('#onOff_'+rowid+'_'+payval).val('on');
    }else{
     // $('#checkboxid_'+rowid+'_'+payval).attr('checked',false);
         $('#onOff_'+rowid+'_'+payval).val('off');
    }
    
}

function cancleBtntds(canclbtn){
  $('#appliedbtn'+canclbtn).html('');
  $('#canclebtn'+canclbtn).html('<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>');
}

function detailBillTrack(rowNo){

    $("#ViewBT_Detail"+rowNo).modal({
        show:false,
        backdrop:'static',
      });
   
    var accCode     = $('#acc_code'+rowNo).val();
    var drAmt       = $('#dr_amount'+rowNo).val();
    var crAmt       = $('#cr_amount'+rowNo).val();
    var isAplyCheck = $('#isBillTrckChk'+rowNo).val();

    if(drAmt){
      var amt = drAmt;
    }else if(crAmt){
      var amt = crAmt;
    }

    var partycode   = $('#acc_code'+rowNo).val();
    var partyName   = $('#acc_name'+rowNo).val();
    var vrseqnum    = $('#vrseqnum').val();
    var seriesCode  = $('#series_code').val();
    var sessionYear = $('#fy_year').val();
    var splitYr     = sessionYear.split('-');
    var startYear   = splitYr[0];
    var vr_date     = $('#vr_date').val();
    var vr_type     = $('#vr_type').val();
    var transCd     = $('#transcode').val();
    var discrptn    = $('#discription'+rowNo).val();
    var reference   = $('#ref'+rowNo).val();
    var perticular  = discrptn+','+reference;
    $('#partyNameBT'+rowNo).html(partycode+' - '+partyName);
    $('#vrnoBT'+rowNo).html(startYear+' '+seriesCode+' '+vrseqnum);
    $('#dateBT'+rowNo).html(vr_date);

    $.ajaxSetup({

        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    if(isAplyCheck == 0){
      $('#isBillTrckChk'+rowNo).val(1);
      $.ajax({

          url:"{{ url('account/cash-bank/bil-track-detail') }}",
          method : "POST",
          type: "JSON",
          data: {accCode: accCode,vr_type:vr_type},

          success:function(data){

              var data1 = JSON.parse(data);
                
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                  $('#noBillTrkFMsg'+rowNo).html('No Data Found').css({'text-align':'center','font-size':'17px','color':'red','font-weight':'700'});
                  $('#bilTrackSaveBtn'+rowNo).prop('disabled',true);
                  $('#ViewBT_Detail'+rowNo).modal('hide');
                  $('#bilNotFounddr'+rowNo).html('No Data Found');
                        //bilNotFoundcr1
              }else if(data1.response == 'success'){

                  if(data1.data_biltrack==''){
                    
                  }else{
                        
                      var headData = '<div class="box-row"><div class="box10 texIndbox1">CrAmt</div><div class="box10 rateIndbox">Allocated so far</div><div class="box10 rateIndbox">Balence to be Allocated</div><div class="box10 rateBox">Allocated in this session</div><div class="box10 amountBox">Balence</div><div class="box10 amountBox"></div></div><div class="box-row"><div class="box10 texIndbox1 numriRight"><small id="crdrAmt1"></small></div><div class="box10 rateIndbox"></div><div class="box10 rateIndbox numriRight"><small id="balenceCrDr'+rowNo+'"></small></div><div class="box10 rateBox numriRight"><small id="sessionBal'+rowNo+'">0</small><input type="hidden" id="alocSesionAmt'+rowNo+'"></div><div class="box10 amountBox numriRight"><small id="totalBal'+rowNo+'"></small></div><div class="box10 amountBox"></div></div>';
                      $('#biltrkBody'+rowNo).append(headData);
                      $('#crdrAmt'+rowNo).html(amt);
                      $('#balenceCrDr'+rowNo).html(amt);
                      $('#totalBal'+rowNo).html(amt);

                      if(vr_type == 'Payment'){
                        var lableName = 'Cr Amr';
                      }else if(vr_type == 'Receipt'){
                        var lableName = 'Dr Amt';
                      }
                        
                      var headAmt = '<div class="box-row"><div class="box10 bthead">Bill/VrNo</div><div class="box10 bthead">Date</div><div class="box10 bthead">'+lableName+'</div><div class="box10 bthead">Prev. Alloc.</div><div class="box10 bthead">Alloc Amt</div><div class="box10 bthead">Bal. Amt</div></div>';
                      $('#biltrkBody'+rowNo).append(headAmt);
                      var srno=1;
                      $.each(data1.data_biltrack, function(k, getdata){

                          if(vr_type == 'Payment'){
                            var crAmount = getdata.CRAMT;
                            var cralloc = getdata.CRALLOC;
                            var newDrAmt = crAmount - cralloc;
                          }else if(vr_type == 'Receipt'){
                            var drAmount = getdata.DRAMT;
                            var dralloc = getdata.DRALLOC;
                            var newDrAmt = drAmount - dralloc;
                          }
                          var fyYear     = getdata.FY_CODE;
                          var fy_split   = fyYear.split('-');
                          var start_year = fyYear[0];
                          var seriesCd = getdata.SERIES_CODE;
                          var vrNo = getdata.VRNO;
                          var genVrno = start_year+' '+seriesCd+' '+vrNo;
                           var DataAmt = '<div class="box-row"><div class="box10 texIndbox1">'+genVrno+'<input type="hidden" name="accTranId[]" id="accTID1" value="'+getdata.ACCTRANID+'"><input type="hidden" name="accTranVrno[]" id="accTranVrno'+srno+'" value="'+getdata.VRNO+'"><input type="hidden" name="cbVrno[]" id="cbVrno'+srno+'" value="'+vrseqnum+'"><input type="hidden" name="cbVrdate[]" id="cbVrdate'+srno+'" value="'+vr_date+'"><input type="hidden" name="cbAccCd[]" id="cbAccCd'+srno+'" value="'+accCode+'"><input type="hidden" name="cbTCd[]" id="cbTCd'+srno+'" value="'+transCd+'"><input type="hidden" name="cbPerticular[]" id="cbPerticular'+srno+'" value="'+perticular+'"></div><div class="box10 rateIndbox">'+getdata.VRDATE+'<input type="hidden" name="accTranVrDate" value='+getdata.VRDATE+'></div><div class="box10 rateIndbox numriRight">'+newDrAmt+'<input type="hidden" id="baleAlocat'+rowNo+'_'+srno+'" value="'+newDrAmt+'"></div><div class="box10 rateBox"></div><div class="box10 amountBox"><input type="text" name="alocateAmt[]" class="allocatAmt rightcontent numriRight" id="alocateAmt'+rowNo+'_'+srno+'" value="0" oninput="totlAlocat('+rowNo+','+srno+');"></div><div class="box10 amountBox"><input type="text" class="rightcontent numriRight" id="balAmt'+rowNo+'_'+srno+'" value="'+newDrAmt+'" readonly></div></div>';
                             $('#biltrkBody'+rowNo).append(DataAmt);
                        srno++;
                      });
                  }  
              }
          }

      });

    }else{}

  }

  function totlAlocat(rowId,unirw){

    var alocate_AmtG =parseFloat($('#alocateAmt'+rowId+'_'+unirw).val());
    var baleAlocatG  =parseFloat($('#baleAlocat'+rowId+'_'+unirw).val());
    var total_bal    = $('#totalBal'+rowId).html();
    var balence_Amt = parseFloat($('#balenceCrDr'+rowId).html());  

    var sum = 0;
    $(".allocatAmt").each(function () {

      if (!isNaN(this.value) && this.value.length != 0) {
          sum += parseFloat(this.value);
      }
      $('#sessionBal'+rowId).html(sum);
      $('#alocSesionAmt'+rowId).val(sum);
    });

    var newsesAmt = sum - alocate_AmtG;

    var newBal = balence_Amt - newsesAmt;

    if(total_bal > baleAlocatG){
        if(alocate_AmtG > baleAlocatG){
          $('#alocateAmt'+rowId+'_'+unirw).val(baleAlocatG);
        }
    }else if(baleAlocatG > total_bal){
        if(alocate_AmtG > newBal){
          $('#alocateAmt'+rowId+'_'+unirw).val(newBal);
        }
    }

    var sum1 = 0;
    $(".allocatAmt").each(function () {

      if (!isNaN(this.value) && this.value.length != 0) {
          sum1 += parseFloat(this.value);
      }
      $('#sessionBal'+rowId).html(sum1);
      $('#alocSesionAmt'+rowId).val(sum1);
    });
      
    var balenceAmt = parseFloat($('#balenceCrDr'+rowId).html());
    var sessionBal = parseFloat($('#sessionBal'+rowId).html());
    var balence = balenceAmt - sessionBal; 
    $('#totalBal'+rowId).html(balence);

    var balAmt =$('#balAmt'+rowId+'_'+unirw).val();
    var alocateAmt =$('#alocateAmt'+rowId+'_'+unirw).val();
    var baleAlocat =$('#baleAlocat'+rowId+'_'+unirw).val();
    var newBalAmt = parseFloat(baleAlocat) - parseFloat(alocateAmt);
    $('#balAmt'+rowId+'_'+unirw).val(newBalAmt);

    var checkIsLess = $('#totalBal'+rowId).html();

    if(checkIsLess >0){
      $('#bilTrackSaveBtn'+rowId).prop('disabled',false);
    }else if(checkIsLess == 0){
      $('#bilTrackSaveBtn'+rowId).prop('disabled',false);
    }else{
      $('#bilTrackSaveBtn'+rowId).prop('disabled',true);
    }

}

function saveBillTrack(rwId){

    var getsessAmt = $('#alocSesionAmt'+rwId).val();
    $('#totalAlocSessAmt'+rwId).val(getsessAmt);
    $('#ViewBillTrack'+rwId).prop('disabled',true);
    $('#AplyIconBT'+rwId).html('<i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 21px;margin-left: 3px;"></i>');
}

function cancleBillTrack(srNum){
   $('#isBillTrckChk'+srNum).val(0)
   $('#biltrkBody'+srNum).empty();
}

function payAdviceSave(trans_code='',series_code='',vrno='',paymentid='',payflag='',payaccCode='',payadviceAmt='',onoff=''){

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    $.ajax({

        url:"{{ url('get-payment-advice-on-cash-bank') }}",
        method : "POST",
        type: "JSON",
        data: {paymentid:paymentid,trans_code:trans_code,series_code:series_code,payflag:payflag,payaccCode:payaccCode,vrno:vrno,payadviceAmt:payadviceAmt,onoff:onoff},

         success:function(data){
            var obj = JSON.parse(data);
         }
    });
}

function submitCBData(valp){

    var downloadFlg = valp;

    var trcount=$('table tr').length;
    var rowCount = parseInt(trcount) - parseInt(1);
    $('#rowCount').val(rowCount);

    $('#pdfYesNoStatus').val(downloadFlg);
   
    var trans_code     = $("#hidntranscd").val();
    var series_code    = $("#hidnseried").val();
    var vrno           = $("#vrseqnum").val();
    var vrDate         = $("#vr_date").val();
    // var series_code = $("#hidnseried").val();
    var paymentid      = [];
    var payflag        = [];
    var payaccCode     = [];
    var payadviceAmt   = [];
    var payvrNo        = [];
    var onoff          = [];
    var partyC         = [];
    var drAmt          = [];

    $(".checkRowSub").each(function (){
              
        if($(this).is(":checked")){

          paymentid.push($(this).val());
        }

    });

    $('input[name^="pay_flag"]').each(function (){
              
        payflag.push($(this).val());

    });

    $('input[name^="acc_code"]').each(function (){
              
        partyC.push($(this).val());

    });

    $('input[name^="dr_amount"]').each(function (){
              
        drAmt.push($(this).val());

    });

    $('input[name^="pay_acc_code"]').each(function (){
              
        payaccCode.push($(this).val());

    });

    $('input[name^="pay_advice_amt"]').each(function (){
            
        payadviceAmt.push($(this).val());

    });

    $('input[name^="pay_vr_no"]').each(function (){
            
        payvrNo.push($(this).val());

    });

    $('input[name^="onoffcheck"]').each(function (){
            
        onoff.push($(this).val());

    });

    var data = $("#cahsbanktrans").serialize();

    $.ajaxSetup({
      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }
    });
         
    if(paymentid.length > 0 || payflag.length > 0 || payaccCode.length > 0 || payadviceAmt.length > 0 || onoff.length > 0){

      payAdviceSave(trans_code,series_code,vrno,paymentid,payflag,payaccCode,payadviceAmt,onoff);
    }
    
    $.ajax({

        type: 'POST',
        url: "{{ url('/save-cash-bank-transaction') }}",
        dataType: "json",
        data: data, 

        success: function (data) {

          var data1 = JSON.parse(JSON.stringify(data));

          if (data1.response == 'error') {
            var responseVar = false;
            var url = "{{url('/finance/view-purchase-order-msg')}}"
            setTimeout(function(){ window.location = url+'/'+responseVar; });
          }else{
            var responseVar = true;
            if(downloadFlg == 1){
              var fyYear   = data1.data[0].FY_CODE;
              var fyCd     = fyYear.split('-');
              var seriesCd = data1.data[0].SERIES_CODE;
              var vrNo     = data1.data[0].VRNO;
              var fileN    = 'CB_'+fyCd[0]+''+seriesCd+''+vrNo;
              var link = document.createElement('a');
              link.href = data1.url;
              link.download = fileN+'.pdf';
              link.dispatchEvent(new MouseEvent('click'));

              var url = "{{url('/view-cash-bank-success-msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });
            }

            if(downloadFlg ==2){

              var chequeNo     = data1.data[0].INST_NO;
              var glCode       = data1.data[0].GL_CODE;
              var glName       = data1.data[0].GL_NAME;
              var accCode      = data1.data[0].ACC_CODE;
              var accName      = data1.data[0].ACC_NAME;
              var chqDate      = '12-12-2022';

              var drAmt = data1.data[0].DRAMT;
              var crAmt = data1.data[0].CRAMT;

              if(drAmt){
                var amount = drAmt;
              }else{
                var amount = crAmt;
              }
              var cheLeafNo    = 'LEF01';
              var updatedChqNo =$('#updateChqNo1').val();
              var amtWord    = 'four thousand six hundred and fifty six only';
              var fullAccName  = accName.replaceAll(' ', '_');
              var amtInword    = amtWord.replaceAll(' ', '_');
              var gl_name      = glName.replaceAll(' ', '_');

              var url1 = "{{url('/configration/Setting/printing-cheque')}}"
              var linkURl = url1+'/'+updatedChqNo+'/'+chequeNo+'/'+glCode+'/'+gl_name+'/'+accCode+'/'+fullAccName+'/'+chqDate+'/'+cheLeafNo+'/'+amount+'/'+amtInword;
                $('#saveAndPrint').attr('href',linkURl);

            }

            var url = "{{url('/view-cash-bank-success-msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

            /*if(downloadFlg ==2){
              
            }*/
              /*if(valp == 2){
                var url1 = "{{url('/configration/Setting/printing-cheque')}}"
                var linkURl = url1+'/'+updatedChqNo+'/'+chequeNo+'/'+glCode+'/'+gl_name+'/'+accCode+'/'+fullAccName+'/'+chqDate+'/'+cheLeafNo+'/'+amount+'/'+amtInword;
                $('#saveAndPrint').attr('href',linkURl);
              
              }else{
                var url = "{{url('/view-cash-bank-success-msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }*/
            
          }
      
        },
    });

}

</script>


@endsection
