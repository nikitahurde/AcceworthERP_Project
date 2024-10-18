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

/* ~~~~~~ Start : Data Table Buttons ~~~~~~ */

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
    font-size: 12px!important;
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

/* ~~~~~~ End : Data Table Buttons ~~~~~~ */


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
.text-right{
  text-align:right !important;
}
.text-left{
  text-align:left !important;
}
.text-center{
  text-align:center !important;
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
       Bank Reconciliation
      <small> : Add Details</small>
    </h1>

    <ul class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

      <li class="active"><a href="{{ url('/transaction/account/add-bank-reconciliation') }}"> Account </a></li>

      <li class="active"><a href="{{ url('/transaction/account/add-bank-reconciliation') }}">Bank Reconciliation</a></li>

    </ul>

  </section> <!-- /. section-->

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Bank Reconciliation</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/account/view-bank-reconciliation') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Bank Reconciliation</a>

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

              <!-- <div class="col-md-1"></div> -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>From Date : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <?php 

                        date_default_timezone_set('Asia/Kolkata');

                        $CurrentDate = date("d-m-Y");
                        $getCurrDtTim = date('Y-m-d H:i:s');
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

                        $getExp = explode(" ",$getCurrDtTim);

                        $secExp = explode("-",$getExp[0]);

                        $expTime = explode(":",$getExp[1]);

                        $getnewDt = $secExp[0].''.$secExp[1].''.$secExp[2].'_'.$expTime[0].''.$expTime[1].''.$expTime[2];

                      ?>
                      <input type="hidden" id="fy_year" value="{{$yearGet}}">
                      <input type="hidden" id="excelDt" value="{{$getnewDt}}">
                      <input type="hidden" id="currDt" value="{{$CurrentDate}}">
                      <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
                      <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
                      <input type="text" class="form-control  transdatepicker rightcontent" name="fromDate" id="from_date" value="{{ $FromDate }}" placeholder="Select Date"  autocomplete="off">

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>

                    <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('fromDate', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div><!-- /.form-group -->
                
              </div><!-- /. col-->

              <div class="col-md-2">

                <div class="form-group">

                  <label>To Date : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     
                      <input type="text" class="form-control  transdatepicker rightcontent" name="toDate" id="to_date" value="{{ $ToDate }}" placeholder="Select To Date"  autocomplete="off">

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>

                    <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('toDate', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div><!-- /.form-group -->
                
              </div><!-- /. col-->

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

                    <input list="seriesList"  id="series_code" name="series" class="form-control  pull-left serieswidth" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

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

                    <input type="text" id="seriesText" name="seriesname" class="form-control  pull-left" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_NAME;}else{} ?>" placeholder="Select Series Name" readonly  data-toggle="tooltip" data-placement="top">

                  </div>
                       
                </div><!-- /.form-group -->
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Default Date : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     
                      <input type="text" class="form-control  transdatepicker rightcontent" name="defaultDate" id="default_date" value="{{ $CurrentDate }}" placeholder="Select Default Date"  autocomplete="off">

                    </div>

                    <small id="showmsgforDefdate" style="color: red;"></small>

                    <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('defaultDate', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div><!-- /.form-group -->
                
              </div><!-- /. col-->
              
            </div><!-- /. row-->

            <div class="row">
 
              <div class="col-md-5"></div>
              
              <div class="col-md-3" style="margin-top: 1%;">
              
                <button type="button" class="btn btn-primary" id="ProceedBtnId" style="padding: 1px 1px 1px 1px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                <button type="button" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();" style="padding: 1px 1px 1px 1px;">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>


              </div>

              <div class="col-md-4"></div>

            </div>
            
          </div><!-- /. box-body-->
          
        </div><!-- /. custom box-->
        
      </div><!-- /. col-->
      
    </div> <!-- /. row-->
  </section> <!-- /. section-->

  <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-info Custom-Box">

          <div class="box-body">

            <div class="modalspinner hideloaderOnModl"></div>

            <div class="">

              <form action="{{ url('/transaction/account/save-bank-reconciliation') }}" method="POST">
                 @csrf
                <table id="createDoTbl" class="table tdthtablebordr">

                  <style>
                    .textCenter{
                      text-align: center !important;
                    }
                  </style>

                  <thead>
                    <tr>
                      <th class="textCenter">Vr Date</th>
                      <th class="textCenter">Vr No</th>
                      <th class="textCenter">GL/Account Code</th>
                      <th class="textCenter">GL/Account Name</th>
                      <th class="textCenter">Instrument Type</th>
                      <th class="textCenter">Instrument No</th>
                      <th class="textCenter">Instrument Date</th>
                      <th class="textCenter">Particular</th>
                      <th class="textCenter">Dr Amount</th>
                      <th class="textCenter">Cr Amount</th>
                      <th class="textCenter">Bank Date</th>
                    </tr>
                  </thead>
                   
                  <tbody>
                    
                  </tbody>
                  

                </table><!-- /.table -->

            </div><!-- /.table-responsive -->





            <div class="row" style="margin-top: 10px;">

              <div class="col-md-12" style="text-align: center;">
                <button class="btn btn-success" type="submit" id="submitdata" onclick="submitInwardTrans(0)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>
              </div>

            </div><!-- /.row -->


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

/* ------------ START : Load Data Table ------------------ */

 

load_data_query();

function load_data_query(series_code= '',series_name='',from_date='',to_date=''){

      var fromdateintrans = $('#FromDateFy').val();
      var todateintrans   = $('#ToDateFy').val();
      var default_date    = $('#default_date').val();

      var currDt = $('#currDt').val();
     
      $('#createDoTbl').DataTable({

          processing: true,
          serverSide: true,
          bPaginate: false,
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
          buttons:  [
                      {
                        extend: 'excelHtml5',
                        title: 'BANK RECONCILIATION '+$("#excelDt").val(),
                        filename: 'BANK_RECONCILIATION_'+$("#excelDt").val(),
                      }
                    ],
          info: true,
          scrollY: 600,
          scrollX: true,
          scroller: true,
          ajax:{
            url:'{{ url("/transaction/account/get-data-on-bank-reconciliation") }}',
            data: {series_code:series_code,from_date:from_date,to_date:to_date,series_name:series_name}
          },
          columns: [
            {
              data:'VRDATE',
              className: "text-right",
              render: function (data,full) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    var newVrDt = '00-00-0000';
                  }else{
                    
                    var newVrDt = date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }

                  var rowNo = full['DT_RowIndex'];

                  return newVrDt+'<input type="hidden" name="vrDt[]" id="vrDtId_'+rowNo+'" value="'+newVrDt+'">';
              }
               
            },
            {
              data:'VRNO',
              render: function (data, type, full, meta){

                var fyDt    = full['FY_CODE'];
                var exp     = fyDt.split("-");
                var scrCode = full['SERIES_CODE'];
                var vrno    = full['VRNO'];

                var newVrNo = scrCode+"/"+exp[0]+"/"+vrno;

                return newVrNo+'<input type="hidden" name="vrNo[]" id="vrNoId" value="'+newVrNo+'"><input type="hidden" name="cbtranid[]" id="cbtranId" value="'+full['CBTRANID']+'"><input type="hidden" name="pfct[]" id="pfctId" value="'+full['PFCT_CODE']+'"><input type="hidden" name="tcode[]" id="tcodeId" value="'+full['TRAN_CODE']+'"><input type="hidden" name="seriesCd[]" id="seriesCdId" value="'+full['SERIES_CODE']+'"><input type="hidden" name="vrno[]" id="vrnoId" value="'+full['VRNO']+'"><input type="hidden" name="vrdate[]" id="vrdateId" value="'+full['VRDATE']+'"><input type="hidden" name="slno[]" id="slnoId" value="'+full['SLNO']+'">';


              },
               className: "text-left"
               
            },
            {
              data:'ACC_CODE',
              render: function (data, type, full, meta){

                if (full['GL_CODE']!=null || full['GL_CODE']!='') {


                  var accGlCd = full['GL_CODE'];
                }else{

                  var accGlCd = full['ACC_CODE']; 
                }
       

                return accGlCd+'<input type="hidden" class="center formInput" value="'+accGlCd+'" name="accCd[]"/>';


              },
               className: "text-left"
               
            },
            {
              data:'ACC_NAME',
              render: function (data, type, full, meta){

                 if (full['GL_CODE']!=null || full['GL_CODE']!='') {

                  var accGlNm = full['GL_NAME'];

                }else{

                  var accGlNm = full['ACC_NAME']; 

                }
       

                return accGlNm+'<input type="hidden" class="center formInput" value="'+accGlNm+'" name="accNm[]"/>';


              },
              className: "text-left"
               
            },
            {
              data:'INST_TYPE',
              render: function (data, type, full, meta){

                if(full['INST_TYPE']!=null){

                  var instType = full['INST_TYPE']; 
                }else{
                  var instType = '-----';
                }
                

                return instType+'<input type="hidden" class="center formInput" value="'+instType+'" name="instType[]"/>';


              },
              className: "text-left"
               
            },
            {
              data:'INST_NO',
              render: function (data, type, full, meta){
                
                if(full['INST_NO']!=null){

                  var instNo = full['INST_NO']; 

                }else{
                  var instNo = '-----';
                }

                return instNo+'<input type="hidden" class="center formInput" value="'+instNo+'" name="instNo[]"/>';


              },
              className: "text-left"
               
            },
            {
              data:'INST_DATE',
              render: function (data, type, full, meta){
                
                if(full['INST_DATE']!=null){

                  var instDt = full['INST_DATE'];
                  
                }else{
                  var instDt = '-----';
                }

                return instDt+'<input type="hidden" class="center formInput" value="'+instDt+'" name="instDt[]"/>';


              },
              className: "text-left"
               
            },
            {
              
              data:'PARTICULAR',
              render: function (data, type, full, meta){
       
                var cbParticular = full['PARTICULAR']; 

                return cbParticular+'<input type="hidden" class="center formInput" value="'+cbParticular+'" name="cbParticular[]"/>';


              },
              className: "text-left"
               
            },
            {
                data:'DRAMT',
                render: function (data, type, full, meta){
               
                var drAmt = full['DRAMT'];
               
                return drAmt+'<input type="hidden" class="center formInput" value="'+drAmt+'" name="cbDrAmt[]"/>';


              },
               className: "text-right"
               
            },
            {  
              data:'CRAMT',
                render: function (data, type, full, meta){
               
                var  crAmt = full['CRAMT'];
               
                return crAmt+'<input type="hidden" class="center formInput" value="'+crAmt+'" name="cbCrAmt[]"/>';


              },
               className: "text-right"
        
            },
            {  
              data:'VRDATE',
              render: function (data, type, full, meta){
                  
                var srNo = full['DT_RowIndex'];

                var self  = "<input type='text' id='bankDate"+srNo+"' class='formInput bankDt' autocomplete='off' name='bankDate[]' value='"+default_date+"'>";

                var date = new Date(data);
                var month = date.getMonth() + 1;
                if(data=='0000-00-00'){
                  var newVrDt = '00-00-0000';
                }else{
                  
                  var newVrDt = date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                }

                $('#bankDate'+srNo).datepicker({

                    format: 'dd-mm-yyyy',
                    orientation: 'bottom',
                    todayHighlight: 'true',
                    startDate : newVrDt,
                    endDate : currDt,
                    autoclose: 'true'

                });

                return self;

               },
               className: "text-center"
        
            },
            
            
          ]


      });

    

  }


 /* ---------- END : Load Data Table ---------------- */



/* ~~~~~~ START : Date Picker for Bank Date ~~~~~~~~*/


    $(document).ready(function() {

      var currDt = $('#currDt').val();

      
      $('#default_date').datepicker({

        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        startDate : currDt,
        autoclose: 'true'
      });

      console.log("page ready...!");

    });

/* ~~~~~~ END : Date Picker for Bank Date ~~~~~~~~*/


  
  /* ..........START : Search Button Click ......... */

  $(document).ready(function(){


    $('#ProceedBtnId').click(function(){
        
         var series_code =  $('#series_code').val();
         var series_name =  $('#seriesText').val();
         var from_date   =  $('#from_date').val();
         var to_date     =  $('#to_date').val();
       

        if(series_code!=''){

          $('#serscode_err').html('');
          
              $('#createDoTbl').DataTable().destroy();

    /* --------- START : ON Search Btn Click Load Data Table -------*/

              load_data_query(series_code,series_name,from_date,to_date);

             
              /*$('#hidSeriesCodeId').val('');
              $('#hidfromDate').val('');
              $('#hidAccCodeId').val('');
              $('#hidAccNmId').val('');
              

              $('#hidSeriesCodeId').val(series_code);
              $('#hidAccCodeId').val(accountCode);
              $('#hidAccNmId').val(accountName);*/
             

              $('#series_code,#seriesText,#from_date,#to_date').prop('disabled',true);

    /* --------- END : ON Search Btn Click Load Data Table -------*/

                     

        }else{

          $('#serscode_err').html('*The Series Code field is required.');
          
        }
        
    });


});

/* ..........END : Search Button Click ......... */


  


</script>


@endsection
