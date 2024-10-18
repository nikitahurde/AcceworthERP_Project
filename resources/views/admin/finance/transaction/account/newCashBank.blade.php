@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
    .required-field::before {
        content: "*";
        color: red;
    }
    .inputboxclr {
        border: 1px solid #d7d3d3;
        width:100%;
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
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 2px;
        padding-bottom: 0px !important;
        vertical-align: top;
    }
    .fieldLable{
        font-size: 12px;
        font-weight: 700;
        color:#095e90;
        float: right;
    }
    .displyinline{
        display: flex;
    }
    .instTypeMode{
        width: 46%;
        margin-bottom: 5px;
        margin-right: 1px;
    }
    .tdsratebtnHide{
        display: none;
    }
    label{
        line-height:1;
    }
    .datehide{
        display: none;
    }
    .toalvaldesn{
        text-align: right;
        font-weight: 800;
        margin-top: 3px;
    }
    .debitotldesn{
        margin-right: 5px;
        width: 126px;
        text-align: end;
    }
    .credittotldesn{
        text-align: end;
        width: 126px;
    }
    .btnstyle{
        padding:3px;
        font-size: 14px;
    }
    .debitcreditbox{
        text-align: end;
    }
    .modltitletext{
        text-align: center;
        font-weight: 700;
        color: #5696bb;
    }
    .texIndbox1{
        font-size:12px;
        line-height:1;
    }
    .content-header h1 {
      margin-top: 2%;
    }
    .content-header .breadcrumb {
      margin-top: 2%;
    }
    .box-header {
      color: #444;
      display: block;
      padding: 3px;
      position: relative;
    }
    .content {
      min-height: 250px;
      padding: 9px;
      margin-right: auto;
      margin-left: auto;
      padding-left: 15px;
      padding-right: 15px;
    }
    .box-header>.box-tools {
        position: absolute !important;
        right: 10px !important;
        top: 2px !important;
    }
    .lableName{
        margin:0px;
        margin-top: 5px;
        margin-bottom: 9px;
    }
    .tdsBtnStyle{
        margin-top: 5px;
        display:flex;
    }
    .iconBtnSty{
        border-radius: 100px;
        padding: 4px;
    }
    .tdsBtnSty{
        font-weight: 600;
        padding: 1px;
        font-size: 10px;
    }
    .crdrInput{
        text-align:right;
        width:15%;
    }
    .glCodeCl{
        width:7%;
    }
    .nameIndbox{
        width:15%;
    }
    .texIndbox{
        width:3%;
    }
    .checkCls{
        margin:0px !important;
    }
    .modlrowSace{
        padding: 2px 5px 2px 5px !important; 
    }
    .amntRight{
        text-align:right !important;
    }
    .textLeft{
        text-align:left !important;
    }
    .payAdcBtn{
        display:none;
    }
    .numriRight{
        text-align: right;
    }
    .submitBtnLog{
        display:none;
    }
</style>

<div class="content-wrapper">
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
    </section>

<form id="cahsbanktrans">
    @csrf
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary Custom-Box">

                    <div class="box-header with-border" style="text-align: center;">

                        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Cash Bank Transaction</h2>
                        <div class="box-tools pull-right">
                          <a href="{{ url('/finance/view-cash-bank') }}" class="btn btn-primary" style="margin-right: 10px;padding: 1px 5px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>
                        </div>

                    </div><!-- /.box-header -->
            
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

                                        if($get_Month >3 && $get_year == $fyYear[1]){
                                            $vrDate = $ToDate;
                                        }else{
                                            $vrDate = $CurrentDate;
                                        }

                                      ?>
                                    <input type="hidden" id="fy_year" value="{{$yearGet}}">
                                    <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
                                    <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
                                    <input type="text" class="form-control  transdatepicker rightcontent" name="vrDate" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date"  autocomplete="off">

                                    </div>

                                    <small id="showmsgfordate" style="color: red;"></small>

                                </div><!-- /.form-group -->
                        
                            </div><!-- /. col-->

                            <div class="col-md-2">
                  
                                <div class="form-group">

                                <label> T Code : <span class="required-field"></span></label>

                                    <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                      <input type="text" class="form-control" name="tran_code" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                                    </div>

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

                                        <input list="seriesList"  id="series_code" name="seriescode" class="form-control  pull-left serieswidth" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();">

                                        <datalist id="seriesList">

                                            <option selected="selected" value="">-- Select --</option>

                                            @foreach ($getseries as $key)

                                            <option value='<?php echo $key->SERIES_CODE; ?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>"><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                                            @endforeach

                                        </datalist>

                                        <!-- --- IF CHEQUBOOK EXIST ------ -->

                                        <input type="hidden" name="checkChequeBookOpen" id="IsChequeBookOpen">

                                        <!-- --- IF CHEQUBOOK EXIST ------ -->

                                    </div>
                                    <small id="serscode_err" style="color: red;" class="form-text text-muted"></small>
                                    
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
                                    
                                        <input type="text" class="form-control rightcontent" name="vr_no" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off" >

                                    </div>

                                </div> <!-- /.form-group -->
                            </div> <!-- /.col -->
                            
                        </div> <!-- /. row -->

                        <div class="row">

                            <div class="col-md-2">

                                <div class="form-group">

                                    <label>GL Code : <span class="required-field"></span></label>

                                    <div class="input-group">
                                        <span class="input-group-addon" style="padding: 1px 12px;">
                                            <i class="fa fa-sort-numeric-asc" id="firsticon"></i>
                                            <div class="" id="appndplantbtn"></div>
                                        </span>
                                      
                                        <input type="text" class="form-control" name="glCode" id="gl_code" value="{{ old('gl_code') }}" placeholder="Enter GL Code" readonly autocomplete="off">

                                    </div>

                                </div><!-- /.form-group -->

                            </div><!-- /. col-->

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label> GL Name : <span class="required-field"></span></label>

                                    <div class="input-group tooltips">

                                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                        <input type="text" class="form-control" name="glName" value="{{ old('gl_name') }}" id="gl_name" placeholder="Enter GL Name" readonly autocomplete="off">

                                        <span class="tooltiptext tooltiphide" id="glNameTooltip"></span>
                                    </div>

                                </div><!-- /.form-group -->

                            </div><!-- /.col -->

                            <div class="col-md-2">

                                <div class="form-group">

                                    <label> Vr Type :  <span class="required-field"></span></label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                                       
                                        <select name="vrType" id="vr_type" class="form-control" disabled autocomplete="off" style="padding: 0px;">
                                            <option value="">--Select--</option>
                                            <option value="Payment">Payment</option>
                                            <option value="Receipt">Receipt</option>
                                        </select>

                                    </div>

                                    <small id="vr_type_err" style="color: red;"></small>
                                    <input type="hidden" id="vrTypeData" name="vrTypeData">
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
                                        <input list="profitList"  id="profitId" name="pfctCode" class="form-control  pull-left" placeholder="Select Profit Center Code" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_CODE; }else{} ?>" readonly autocomplete="off">

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

                                    <label>Pfct Name: <span class="required-field"></span></label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                        <div class="pull-left showSeletedName" id="profit_names"></div>
                                        <input type="text" class="form-control" id="profit_name" name="profitName" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_NAME; }else{} ?>" placeholder="Enter Profit Center Name" readonly>

                                    </div>

                                    <small id="comp_code_err" style="color: red;"></small>
                              
                                </div><!-- /.form-group -->
                            </div><!-- /.col -->

                        </div> <!-- /. row -->

                        <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label>Sale Rep. code:</label>

                                    <div class="input-group">

                                        <div class="input-group-addon">

                                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                        </div>
                                        <?php $salerCd = count($sale_rep_list); ?>

                                        <input list="saleRepList" class="form-control" id="sale_rep_code" name="sale_rep_code" placeholder="Select Sale Rep. code" maxlength="55" value="<?php if($salerCd == 1){echo $sale_rep_list[0]->ACC_CODE;}?>"  autocomplete="off">

                                        <datalist id="saleRepList">

                                            <option value="">--SELECT--</option>

                                            @foreach ($sale_rep_list as $key)

                                            <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo " [".$key->ACC_CODE."]"; ?></option>

                                            @endforeach

                                        </datalist>

                                    </div>
                                    <small>  

                                    <div class="pull-left showSeletedName" id="saleRText"><?php if($salerCd == 1){echo $sale_rep_list[0]->ACC_NAME;}?></div>

                                    </small>

                                    <small id="saleR_err" style="color: red;"> </small>

                                </div><!-- /.form-group -->
                            </div><!--  /.col -->
                            
                        </div> <!-- /. row -->

                    </div> <!-- /. box body -->

                </div> <!-- /. custom box -->
            </div> <!-- /. col 12 -->
        </div> <!-- /. row -->
    </section> <!-- /. section -->

    <section class="content" style="margin-top: -10%;">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary Custom-Box">
                    <div class="box-body">
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

                                <tr>
                                    <td class="tdthtablebordr" style="width:5%;">
                                        <input type='checkbox' class='case'/ title="Delete Single Row">
                                        <span id='snum'>1.</span>
                                        <input type="hidden" name="totlRwCount[]" class="rowCountCls" value="1" id="totlCountRw1">
                                    </td>

                                    <td class="tdthtablebordr" style="width:9%;">
                                        <div class="row lableName">
                                            <small class="fieldLable">Gl Code</small>
                                        </div>
                                        <div class="row lableName" style="margin-top: 12px;">
                                            <small class="fieldLable">Account Code</small>
                                        </div>
                                        <div class="row lableName" style="margin-top: 12px;">
                                            <small class="fieldLable">Cost Code</small>
                                        </div>
                                        <div class="row lableName" style="margin-top: 12px;">
                                            <label for="" class="fieldLable">I Type</label>
                                        </div>
                                    </td>

                                    <td class="tdthtablebordr" style="width:12%;">

                                        <div class="row" style="margin:0px;margin-bottom: 2px;">
                                        <div class="input-group">
                                            <input list="glCodeNameList1" class="inputboxclr tabnext" id="glCodeName1"  name="glCodeName[]" onchange="glcodeNameData(1);" placeholder="Select Gl Code"  readonly autocomplete="off">
                                            <datalist id="glCodeNameList1">

                                              @foreach ($gl_list as $key)

                                                <option value='<?php echo $key->GL_CODE?>' data-xyz ="<?php echo $key->GL_NAME; ?>" ><?php echo $key->GL_NAME; echo " [".$key->GL_CODE."]" ; ?></option>

                                              @endforeach

                                            </datalist>
                                            <input type="hidden" id="acctTag1" value="">
                                            <input type="hidden" id="costcTag1" value="">
                                        </div>
                                        </div>

                                        <div class="row" style="margin: 0px;margin-bottom: 2px;">
                                        <div class="displyinline">
                                            <div class="input-group">
                                              <input list="AccList1" class="inputboxclr getacccode tabnext" style="" id='acc_code1'  name="acc_code[]" onchange="GetAccountCode(1)" readonly placeholder="Select Acc Code" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>

                                              <datalist id="AccList1">

                                                <option selected="selected" value="">-- Select --</option>

                                                @foreach ($acc_list as $key)

                                                <option value='<?php echo $key->ACC_CODE; ?>' data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo " [".$key->ACC_CODE."]" ; ?></option>

                                                @endforeach

                                              </datalist>
                                              <!-- account tds code -->
                                              <input type="hidden" id="tdsByAccCode1" value="" name="tdsCodeByAc[]">
                                              <input type="hidden" id="acctdsRate1" value="" name="accTds_Rate[]">
                                              <!-- account tds code -->

                                              <!-- gl code n name of tds code -->
                                              <input type="hidden" name="gltdscode[]" id="GettdsCode1" >
                                              <input type="hidden" name="gltdsname[]" id="GettdsName1">
                                              <!-- gl code n name of tds code -->
                                            </div>
                                            <div class="" id="appndaccbtn"><button type="button" data-toggle="modal" id="accbtn1" data-target="#accCd_detail1" onclick="getAccDetail(1)" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;" disabled=""> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button></div>
                                        </div>  
                                        </div>

                                        <div class="row" style="margin:0px;margin-bottom: 2px;">
                                        <div class="input-group">

                                            <input list="costCenterList1" class="inputboxclr tabnext" id="costCenter1"  name="costCenterCd[]" onchange="costCenterCdData(1);" placeholder="Select Cost Center Code"  readonly autocomplete="off">

                                            <datalist id="costCenterList1">

                                              @foreach ($cost_list as $key)

                                              <option value='<?php echo $key->COST_CODE?>' data-xyz ="<?php echo $key->COST_NAME; ?>" ><?php echo $key->COST_NAME; echo " [".$key->COST_CODE."]" ; ?></option>

                                              @endforeach

                                            </datalist>
                                            
                                        </div>
                                        </div>

                                        <div class="row" style="margin: 0px;margin-bottom: 2px;">
                                        <div style="display: flex;">
                                            <input list="InstTypeList1" id="inst_type1" class="instTypeMode tabnext"  name="instrument_type[]" placeholder="Select I Type" onchange="changedate(1)" autocomplete="off">

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
                                            <!-- --- INST TYPE NAME -->
                                            <input type="hidden" id="intTypeName1" name="intTypeName[]">
                                            <!-- --- INST TYPE NAME -->
                                            <input list='chequeNoList1' class="inputboxclr onchenkno tabnext" style="width:65px;margin-bottom: 4px;" id='cheque_no1'  name="instrument_no[]" oninput='getdicbypay(1);' readonly placeholder="Number" autocomplete="off"/>

                                            <datalist id="chequeNoList1">
                                            </datalist>
                                            <!-- ---- CHEQUE ID ---- -->
                                            <input type="hidden" id="chkTblId1" name="chequeTblData[]">
                                            <!-- ---- CHEQUE ID ---- -->
                                        </div>  
                                        </div>

                                        <div class="row" style="margin:0px;margin-bottom:2px;">
                                            <div class="input-group datehide" id="showdate1">
                       
                                                <input type="text" name="chquedate[]" id="chquedate1" value="" class="form_date" placeholder="select date" style="width: 100%;" autocomplete="off">
                                                <i class="fa fa-calendar form-control-feedback" style="line-height: 26px;"></i>
                                            </div>
                                        </div>
                                        <!-- payment advice btn -->
                                        <div class="row" style="margin:0px;margin-bottom:2px;    margin-top: -7px;">
                                            <button type='button' class='btn btn-primary payAdcBtn' id='payemntAdvice1' data-toggle='modal' data-target='#paymentAdviceMd1' onclick='paymentAdviceFun(1)'><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;Payment Advice</button>
                                            <input type="hidden" value="0" name="paymentAdvDone" id="payAdviceDone1">
                                        </div>
                                        <!-- payment advice btn -->
                                    </td>

                                    <td class="tdthtablebordr" style="width:50%;">
                                        <div class="row" style="margin:0px;margin-bottom: 2px;">
                                            <input type="text" class="inputboxclr" placeholder="Enter Gl Name" id='genrl_name1' name="genrl_name[]" readonly />
                                        </div>

                                        <div class="row" style="margin:0px;margin-bottom: 2px;">
                                            <input type="text" class="inputboxclr" id='acc_name1' placeholder="Enter Account Name" name="acc_name[]" readonly />
                                        </div>

                                        <div class="row" style="margin:0px;margin-bottom: 2px;">
                                            <input type="text" class="inputboxclr" placeholder="Enter Cost Center Name" id='costCenter_name1' name="costCenter_name[]" readonly />
                                        </div>

                                        <div class="row" style="margin:0px;margin-bottom: 2px;">
                                            <input type="text" class="inputboxclr discription"  name="particular[]" id="discription1" autocomplete='off'>
                                        </div>

                                        <div class="row" style="margin:0px;margin-bottom: 2px;">

                                        <div class="input-group" style="width: 100%;">

                                            <input list="remarkList1" class="tabnext inputboxclr" id='ref1' name="ref_text[]" placeholder="Enter Remark" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>

                                            <datalist id="remarkList1">

                                              <option selected="selected" value="">-- Select --</option>

                                              @foreach ($remark_list as $key)

                                              <option value='To - <?php echo $key->REMARK?>' data-xyz ="To - <?php echo $key->REMARK; ?>" >To - <?php echo $key->REMARK ; ?></option>

                                              @endforeach

                                            </datalist>

                                        </div>
                                            <!-- payment advice remark -->

                                            <input type="hidden" name="refTextPA" id="refTextPA1">
                                            <!-- payment advice remark -->
                                        </div>

                                    </td>

                                    <td class="tdthtablebordr" style="width:12%;">
                                        <input type='text' class="inputboxclr debitcreditbox dr_amount tabnext"  id='dr_amount1' name="dr_amount[]"  onkeypress='NumberCredit()' readonly oninput='GetDebitAmount(1)' autocomplete="off"/>
                                        <input type="hidden" id="resultofdebit1" name="DebitdsAmt[]">
                                        <input type="hidden" id="Applytdsonamt1" name="TdsDebitAmount[]">

                                        <!-- TDS BUTTON CODE  -->

                                        <div class="tdsBtnStyle" id="drTdsBtn1"></div>

                                        <!-- TDS BUTTON CODE  -->

                                        <!-- BILL TRACK BUTTON CODE -->

                                        <div id="billTkDr1" style="display: inline-flex;"></div>

                                        <input type="hidden" id="isBillTrckChk1" value="0">

                                        <input type="hidden" id="totalAlocSessAmt1" name="totAlocSessAmt[]">

                                        <!-- BILL TRACK BUTTON CODE -->
                                    </td>

                                    <td class="tdthtablebordr" style="width:12%;">
                                        <input type='text' class="inputboxclr debitcreditbox cr_amount tabnext" id='cr_amount1' name="cr_amount[]"  readonly onkeypress='NumberCredit()' oninput='GetCreditAmount(1)' autocomplete="off"/>
                                        <input type="hidden" id="resultofcredit1" name="CredittdsAmt[]">
                                        <input type="hidden" id="Applytdsonamtforcr1" name="TdsCreditAmount[]">

                                        <!-- TDS BUTTON CODE  -->

                                        <div class="tdsBtnStyle" id="crTdsBtn1"></div>

                                        <!-- TDS BUTTON CODE  -->

                                    </td>

                                </tr>
                            </table> <!--  table -->
                        </div><!-- /.table-responsive -->

                        <div class="row">
                            <div class="col-md-5">
                              <button type="button" class='btn btn-danger delete btnstyle' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>
                              <button type="button" class='btn btn-info addmore btnstyle' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
                            </div>
                            <div class="col-md-5" style="float: right;">
                              <div style="display:flex;float: right;">
                                <div class="toalvaldesn">Total :</div>
                                <input class="debitotldesn inputboxclr" type="text" name="TotlDebit" id="totldramt" readonly>
                                <input class="credittotldesn inputboxclr" type="text" name="TotalCredit"  id="totlcramt" readonly>
                              </div>
                              
                            </div>
                        </div>

                        <div class="row" style="text-align:center;"> 
                
                            <input type="hidden" name="rowCount" id="rowCount" value="">
                            <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
                            <button type="button" class="btn btn-primary btn-xs btnstyle" id="simulation_btn" data-toggle="modal" data-target="#simulation_model" onclick="simulationcal(1);" disabled>Simulation</button>
                            <button class="btn btn-success btnstyle" type="button" id="submitdata" onclick="submitCBData(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>
                            <button class="btn btn-warning btnstyle" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>
                            <!--  ---- SHOW BUTTON WHEN SELECT PAYMENT TYPE -->
                            <button class="btn btn-success btnstyle submitBtnLog" type="button" id="submitdatapdf" data-toggle="modal" data-target="#pdfDownloadModl" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button>
                            <!--  ---- SHOW BUTTON WHEN SELECT PAYMENT TYPE -->

                            <!--  ---- SHOW BUTTON WHEN SELECT RECEIPT TYPE -->
                            <button class="btn btn-success btnstyle submitBtnLog" type="button" id="submitReceiptpdf" onclick="submitCBData(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button>
                            <!--  ---- SHOW BUTTON WHEN SELECT RECEIPT TYPE -->

                        </div><!-- /. row-->

                    </div><!-- /.box-body -->
                </div><!-- /.custom box -->
            </div><!-- /.col -->
        </div><!-- /. row -->
    </section><!-- /. section -->

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

<!------- MODAL FOR ACCOUNT DETAIL ------------>
    
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
                  <div class="box10 texIndbox1">Acc Type Code </div>
                  <div class="box10 texIndbox1">Address1</div>
                  <div class="box10 texIndbox1">city</div>
                  <div class="box10 texIndbox1">state</div>
                  <div class="box10 texIndbox1">Email</div>
                  <div class="box10 texIndbox1">Phone No</div>
                </div>
                
                <div class="box-row">
                  <div class="box10 itmdetlheading">
                    <span id="accNameCodeshow1" class="texIndbox1"> </span>
                  </div>
                  <div class="box10 itmdetlheading">
                    <span id="AcctypCde1" class="texIndbox1"> </span>
                  </div>
                  <div class="box10 itmdetlheading">
                    <span id="Addres1show1" class="texIndbox1"> </span>
                  </div>
                  <div class="box10 itmdetlheading">
                    <span id="cityacshow1" class="texIndbox1"> </span>
                  </div>
                  <div class="box10 itmdetlheading">
                    <span id="stateacshow1" class="texIndbox1"> </span>
                  </div>
                  <div class="box10 itmdetlheading">
                    <span id="emailacshow1" class="texIndbox1"> </span>
                  </div>
                  <div class="box10 itmdetlheading">
                    <span id="phonenoacshow1" class="texIndbox1"> </span>
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

<!------- MODAL FOR ACCOUNT DETAIL ------------>

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
                    <input type="text" id="tds_name1" name="tds_section[]" value="" style="margin-bottom:3px;" readonly>
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Tds Rate</label>
                    
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="tdsRate1" name="tdsRates[]" readonly style="text-align: right;margin-bottom:3px;">
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Tds Base Amount</label>
                    
                  </div>
                  <div class="col-md-4">
                    <input type="hidden" id="tds_base_Amt1" name="baseTDSAmt[]" value="">
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
                    <input type="text" id="deduct_tds_Amt1" readonly name="base_amt_tds[]" style="text-align: right;">
                  </div>
                  <div class="col-md-2"></div>
              </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-primary" style="width: 30%;padding: 3px;" data-dismiss="modal" id="ApplyTds1" onclick="Applytds(1)">Apply TDS</button>
              <button type="button" class="btn btn-warning" style="width: 24%;padding: 3px;" data-dismiss="modal" onclick="cancleBtntds(1)">Cancle</button>
            </div>
          </div>
        </div>
      </div>

<!------- MODAL FOR CALCULATE TDS ------------>

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
              <div class="boxer" id="siml_body" style="font-size: 12px;color: #000;width:100%;">
              </div>
            </div>

            <div class="modal-footer">
                <span id="siml_footer1" style="width: 10px;"><button type="button" class="btn btn-primary " style="width: 10%;" data-dismiss="modal">Ok</button></span>
            </div>

          </div>

        </div>

      </div>

<!------- MODAL FOR SIMULATION ------------>

<!------- MODAL FOR WHEN FIELD IS REQ BUT ITS BLANK ------------>
    
    <div id="blankFieldModal" class="modal fade" tabindex="-1">
      <div class="modal-dialog modal-sm" style="margin-top: 13%;">
          <div class="modal-content" style="border-radius: 5px;">
              <div class="modal-header"  style="text-align: center;">
                  <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
                  
              </div>
              <div class="modal-body">
                <p id="whenRowBlnk" style="line-height:15px;"></p>
              </div>
              <div class="modal-footer" style="text-align: center;">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" >OK</button>
              </div>
          </div>
      </div>
    </div>

<!------- MODAL FOR WHEN FIELD IS REQ BUT ITS BLANK ------------>

<!------- MODAL FOR PAYMENT ADVICE ------------>
    
    <div class="modal fade in" id="paymentAdviceMd1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
        
        <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <input type="hidden" value="" id="modlAccCode1">
                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Payment Advice</h5>
                </div>
                <div class="col-md-2"></div>
              </div>
            </div>

            <div class="modal-body table-responsive">
              <div class="boxer" id="payAdvice_body1" style="font-size: 12px;color: #000;width:100%;">
              </div>
            </div>

            <div class="modal-footer" style="text-align: center;">
                <small id="payAdvice_footer1" style="width: 10px;">
                    <button type="button" class="btn btn-primary " style="width: 10%;" onclick="getpayAviceAmt(1);" id="payAdviceOkBtn1" data-dismiss="modal" disabled>Ok</button>
                    <button type="button" class="btn btn-warning" style="width: 10%;" data-dismiss="modal" onclick="canlcePayAdvice(1)">Cancle</button>
                </small>
                <div style="text-align:center;color:red;" id="OneCheckboxSel1"></div>
            </div>

          </div>

        </div>

      </div>

<!------- MODAL FOR PAYMENT ADVICE ------------>

<!--  ------ MODAL FOR BILL TRACKING --------- -->
    
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
                <div class="modal-body table-responsive" style="height: 450px;overflow: scroll;">
                  <div id="noBillTrkFMsg1"></div>
                  <div class="boxer" id="biltrkBody1">

                  </div>
                </div>

                <div class="modal-footer" style="text-align: center;">
                 
                  <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;" id="bilTrackSaveBtn1" onclick="saveBillTrack(1);">Save</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;margin-top: 0% !important;" onclick="cancleBillTrack(1)">Cancle</button>

                </div>

            </div>

        </div>

    </div>

<!--  ------ MODAL FOR BILL TRACKING --------- -->

<!--  ------ PDF DOWNLOAD FORMATE --------- -->
    
    <div class="modal fade" id="pdfDownloadModl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="true">
        <div class="modal-dialog modal-sm" role="document" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;">
                <div class="modal-header">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Print Format</h5>
                </div>
                <div class="modal-body">
                    <div class="row tdsInputBox">
                        <div class="col-md-12">
                            <input type="radio" id="paymentVoucher" name="CASHPDFDL" value="PAYMENT_VOUCHER" checked>
                            <label>&nbsp;Payment Voucher&nbsp;</label>
                            <input type="radio" id="paymentRemidies" name="CASHPDFDL" value="PAYMENT_REMITTANCE">
                            <label>&nbsp;Payment Remittance &nbsp;</label><br>
                        </div>
                    </div>
                </div>
                <div class="modal-footer" style="text-align: center;">
                    <button type="button" class="btn btn-primary" style="width: 30%;padding: 3px;" data-dismiss="modal" id="PDFMODL" onclick="submitCBData(1)"><i class="fa fa-download" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>

<!--  ------ PDF DOWNLOAD FORMATE --------- -->

</form>
    
</div> <!-- /. content wrapper -->

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/CashBankNewJs.js') }}" ></script>



<!--  -------- add more functionality -------- -->


<script>

    $(document).ready(function(){
        getvrnoBySeries();
        $('#submitdatapdf').removeClass('submitBtnLog');
    });
    /* --------- delete row ------------ */

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

        if(obj.length == 0){
            $('#simulation_btn').prop('disabled',true);
            $('#submitdata').prop('disabled',true);
            $('#submitdatapdf').prop('disabled',true);
            $('##submitReceiptpdf').prop('disabled',true);
            $("#totldramt").val(0);
            $("#totlcramt").val(0);
        }else{
            $.each( obj, function( key, value ) {
                id=value.id;
                $('#'+id).html(key+1);
            });
        }
        
    }

    /* --------- delete row ------------ */

    var i=2;
    $(".addmore").on('click',function(){

        var vrType =  $('#vr_type').val();

        if(vrType == 'Payment'){
          var getpaymode = '\'To -\'';
        }else if(vrType == 'Receipt'){
         var getpaymode='\'By -\'';
        }

        count=$('table tr').length;

        var data="<tr><td class='tdthtablebordr' style='width:5%;'><input type='checkbox' class='case'/ title='Delete Single Row'><span id='snum"+i+"'>"+count+"</span><input type='hidden' name='totlRwCount[]' class='rowCountCls' value='"+i+"' id='totlCountRw"+i+"'></td>"+
            "<td class='tdthtablebordr' style='width:9%;'><div class='row lableName'><small class='fieldLable'>Gl Code</small></div><div class='row lableName' style='margin-top: 12px;'><small class='fieldLable'>Account Code</small></div><div class='row lableName' style='margin-top: 12px;'><small class='fieldLable'>Cost Code</small></div><div class='row lableName' style='margin-top: 12px;'><label for='' class='fieldLable'>I Type</label></div></td>"+
            "<td class='tdthtablebordr' style='width:12%;'><div class='row' style='margin:0px;margin-bottom: 2px;'><div class='input-group'><input list='glCodeNameList"+i+"' class='inputboxclr tabnext' id='glCodeName"+i+"'  name='glCodeName[]' onchange='glcodeNameData("+i+");' placeholder='Select Gl Code'  readonly autocomplete='off'><datalist id='glCodeNameList"+i+"'>@foreach ($gl_list as $key)<option value='<?php echo $key->GL_CODE?>' data-xyz ='<?php echo $key->GL_NAME; ?>' ><?php echo $key->GL_NAME; echo ' ['.$key->GL_CODE.']' ; ?></option>@endforeach</datalist><input type='hidden' id='acctTag"+i+"' value=''><input type='hidden' id='costcTag"+i+"' value=''></div></div><div class='row' style='margin: 0px;margin-bottom: 2px;'><div class='displyinline'><div class='input-group'><input list='AccList"+i+"' placeholder='Select Acc Code' class='inputboxclr getacccode tabnext' style='' id='acc_code"+i+"'  name='acc_code[]' onchange='GetAccountCode("+i+")' readonly oninput='this.value = this.value.toUpperCase()' autocomplete='off'/><datalist id='AccList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($acc_list as $key)<option value='<?php echo $key->ACC_CODE; ?>' data-xyz ='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo ' ['.$key->ACC_CODE.']' ; ?></option>@endforeach</datalist><input type='hidden' id='tdsByAccCode"+i+"' value='' name='tdsCodeByAc[]'><input type='hidden' id='acctdsRate"+i+"' value=' name='accTds_Rate[]'><input type='hidden' name='gltdscode[]' id='GettdsCode"+i+"' ><input type='hidden' name='gltdsname[]' id='GettdsName"+i+"'></div><div class='' id='appndaccbtn'><button type='button' data-toggle='modal' id='accbtn"+i+"' data-target='#accCd_detail"+i+"' onclick='getAccDetail("+i+")' class='btn btn-xs btn-info gly-radius' data-original-title=' title=' style='padding: 0px 5px 0px 5px;' disabled=''> <i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i></button></div></div></div><div class='row' style='margin:0px;margin-bottom: 2px;'><div class='input-group'><input list='costCenterList"+i+"' class='inputboxclr tabnext' id='costCenter"+i+"'  name='costCenterCd[]' onchange='costCenterCdData("+i+");' placeholder='Select Cost Center Code'  readonly autocomplete='off'><datalist id='costCenterList"+i+"'>@foreach ($cost_list as $key)<option value='<?php echo $key->COST_CODE?>' data-xyz ='<?php echo $key->COST_NAME; ?>' ><?php echo $key->COST_NAME; echo ' ['.$key->COST_CODE.']' ; ?></option>@endforeach</datalist></div></div><div class='row' style='margin: 0px;margin-bottom: 2px;'><div style='display: flex;'><input list='InstTypeList"+i+"' id='inst_type"+i+"' class='instTypeMode tabnext'  name='instrument_type[]' placeholder='Select I Type' onchange='changedate("+i+")' autocomplete='off'><datalist id='InstTypeList"+i+"'><option selected='selected' value=''>-- Select --</option><option value='CH' data-xyz ='Cheque'>Cheque[CH]</option><option value='DD' data-xyz ='Demand Draft'>Demand Draft[DD]</option><option value='TR' data-xyz ='Transfer receipt'>Transfer receipt[TR]</option><option value='TT' data-xyz ='Tele Transfer'>Tele Transfer[TT]</option><option value='MT' data-xyz ='Money Transfer'>Money Transfer[MT]</option><option value='RT' data-xyz ='RTGS'>RTGS[RT]</option><option value='BA' data-xyz ='Bank Advise'>Bank Advise[BA]</option><option value='EC' data-xyz ='Electronic Clearence'>Electronic Clearence[EC]</option><option value='NEFT' data-xyz ='National Electronic Funds Transfer'>National Electronic Funds Transfer[NEFT]</option><option value='IMPS' data-xyz ='Immediate Payment Service'>Immediate Payment Service[IMPS]</option><option value='UPI' data-xyz ='Unified Payments Interface'>Unified Payments Interface[UPI]</option><option value='NA' data-xyz ='Not Applicable'>Not Applicable[NA]</option></datalist><br><input type='hidden' id='intTypeName"+i+"' name='intTypeName[]'><input list='chequeNoList"+i+"' class='inputboxclr onchenkno tabnext' style='width:65px;margin-bottom: 4px;' id='cheque_no"+i+"'  name='instrument_no[]' oninput='getdicbypay("+i+");' placeholder='Number' autocomplete='off' readonly/><datalist id='chequeNoList"+i+"'></datalist><input type='hidden' id='chkTblId"+i+"' name='chequeTblData[]'></div></div><div class='row' style='margin:0px;margin-bottom:2px;'><div class='input-group datehide' id='showdate"+i+"'><input type='text' name='chquedate[]' id='chquedate"+i+"' value='' class='form_date' placeholder='select date' style='width: 100%;'><i class='fa fa-calendar form-control-feedback' style='line-height: 26px;'></i></div></div></td>"+
            "<td class='tdthtablebordr' style='width:50%;'><div class='row' style='margin:0px;margin-bottom: 2px;'><input type='text' class='inputboxclr' placeholder='Enter Gl Name' id='genrl_name"+i+"' name='genrl_name[]' readonly /></div><div class='row' style='margin:0px;margin-bottom: 2px;'><input type='text' class='inputboxclr' placeholder='Enter Cost Center Name' id='costCenter_name"+i+"' name='costCenter_name[]' readonly /></div><div class='row' style='margin:0px;margin-bottom: 2px;'><input type='text' class='inputboxclr' id='acc_name"+i+"' placeholder='Enter Account Name' name='acc_name[]' readonly /></div><div class='row' style='margin:0px;margin-bottom: 2px;'><input type='text' class='inputboxclr discription'  name='particular[]' id='discription"+i+"' value="+getpaymode+" autocomplete='off'></div><div class='row' style='margin:0px;margin-bottom: 2px;'><div class='input-group' style='width: 100%;'><input list='remarkList"+i+"' class='tabnext inputboxclr' id='ref"+i+"' name='ref_text[]' placeholder='Enter Remark' oninput='this.value = this.value.toUpperCase()' autocomplete='off'/><datalist id='remarkList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($remark_list as $key)<option value='To - <?php echo $key->REMARK?>' data-xyz ='To - <?php echo $key->REMARK; ?>' >To - <?php echo $key->REMARK ; ?></option>@endforeach</datalist></div></div></td>"+
            "<td class='tdthtablebordr' style='width:12%;'><input type='text' class='inputboxclr debitcreditbox dr_amount tabnext'  id='dr_amount"+i+"' name='dr_amount[]'  onkeypress='NumberCredit()' readonly oninput='GetDebitAmount("+i+")' autocomplete='off'/><input type='hidden' id='resultofdebit"+i+"' name='DebitdsAmt[]'><input type='hidden' id='Applytdsonamt"+i+"' name='TdsDebitAmount[]'><div class='tdsBtnStyle' id='drTdsBtn"+i+"'></div></td>"+
            "<td class='tdthtablebordr' style='width:12%;'><input type='text' class='inputboxclr debitcreditbox cr_amount tabnext' id='cr_amount"+i+"' name='cr_amount[]'  readonly onkeypress='NumberCredit()' oninput='GetCreditAmount("+i+")' autocomplete='off'/><input type='hidden' id='resultofcredit"+i+"' name='CredittdsAmt[]'><input type='hidden' id='Applytdsonamtforcr"+i+"' name='TdsCreditAmount[]'><div class='tdsBtnStyle' id='crTdsBtn"+i+"'></div>"+
            /* ------- tds calculate modal ------ */
            "<div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' data-keyboard='false' data-backdrop='static'><div class='modal-dialog modal-sm' role='document' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Calculate TDS</h5></div><div class='modal-body'><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Section</label></div><div class='col-md-4'><input type='text' id='tds_name"+i+"' name='tds_section[]' value='' readonly></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Rate</label></div><div class='col-md-4'><input type='text' id='tdsRate"+i+"' name='tdsRates[]' readonly style='text-align: right;'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Base Amount</label></div><div class='col-md-4'><input type='hidden' id='tds_base_Amt"+i+"' name='baseTDSAmt[]' value=''><input type='text' id='Net_amount"+i+"' readonly style='text-align: right;'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Amount calculate</label></div><div class='col-md-4'><input type='text' id='tds_Amt_cal"+i+"' readonly style='text-align: right;'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Net Amount</label></div><div class='col-md-4'><input type='text' id='deduct_tds_Amt"+i+"' readonly name='base_amt_tds[]' style='text-align: right;'></div><div class='col-md-2'></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' style='width: 30%;padding: 3px;' data-dismiss='modal' id='ApplyTds"+i+"' onclick='Applytds("+i+")'>Apply TDS</button><button type='button' class='btn btn-warning' style='width: 24%;padding: 3px;' data-dismiss='modal' onclick='cancleBtntds("+i+")'>Cancle</button></div></div></div></div></td></tr>";

            $('table').append(data);

            /*if(vrType == 'Payment'){
              $('#dr_amount'+i).prop('readonly',false);
              $('#cr_amount'+i).prop('readonly',true);
            }else if(vrType == 'Receipt'){
             $('#dr_amount'+i).prop('readonly',true);
             $('#cr_amount'+i).prop('readonly',false);
            }*/

            $('#glCodeName'+i).prop('readonly',false);
            $('#acc_code'+i).prop('readonly',false);
            $('#costCenter'+i).prop('readonly',false);
            $('#glCodeName'+i).css('border-color','#ff0000');

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
                        $('#IsChequeBookOpen').val('NO');

                    }else if(data1.response == 'success'){

                        /* ---------- get cheque no deatils ------- */

                        var slnoNo = parseInt(i) - parseInt(1);
                          $("#chequeNoList"+slnoNo).empty();

                          if(data1.chqNoList == ''){
                            //$('#IsChequeBookOpen').val('NO');
                          }else{
                            //$('#IsChequeBookOpen').val('');
                            //$('#IsChequeBookOpen').val('YES');
                            $.each(data1.chqNoList, function(k, getData){

                                var upId = getData.CHEQUENO+'~'+getData.CHQBHID+'~'+getData.CHQBBID+'~'+getData.SLNO;
                                $("#chequeNoList"+slnoNo).append($('<option>',{

                                  value:getData.CHEQUENO,

                                  'data-xyz':upId


                                }));

                            });

                          }
                        /* ---------- get cheque no deatils ------- */

                    } /* /. success */
                } /* /. success function */
            }); /* /. ajax function */

    i++;}); /* /. add more*/

</script>

<!--  -------- add more functionality -------- -->

<script>

/* ---------- get vrno against series code ------------- */
    
    function getvrnoBySeries(){
        console.log('hi');
        var seriesCode = $('#series_code').val();
        var transcode = $('#transcode').val();

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
        });

        $.ajax({

            url:"{{ url('get-last-no-vr-sequence-by-series-new') }}",
            method : "POST",
            type: "JSON",
            data: {seriesCode: seriesCode,transcode:transcode},
            success:function(data){
                var data1 = JSON.parse(data);
                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                    $('#IsChequeBookOpen').val('NO');

                }else if(data1.response == 'success'){

                    if(data1.vrno_series == ''){

                    }else{
                        if(data1.vrno_series){
                            var getlastno = data1.vrno_series.LAST_NO;
                            var lastNo = parseInt(getlastno) +  parseInt(1);
                            $('#vrseqnum').val(lastNo);
                            $('#hidnvrseq').val(lastNo);
                        }else{
                            var getlastno = '';
                        }
                    }

                    if(data1.data ==''){

                    }else{
                        $("#gl_code").val(data1.data[0].GL_CODE);
                        $("#gl_name").val(data1.data[0].GL_NAME);

                        var glcodeh = $('#gl_code').val();
                        if(glcodeh){
                            $('#firsticon').css('display','none');
                            $('#appndplantbtn').html('<button type="button" data-toggle="modal" data-target="#gl_detail" onclick="getgldata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;font-size: 9px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
                        }
                    }

                    /* ---------- get cheque no deatils ------- */

                      console.log('data1.chqNoList',data1.chqNoList);
                      $("#chequeNoList1").empty();

                      if(data1.chqNoList == ''){
                        $('#IsChequeBookOpen').val('NO');
                      }else{
                        $('#IsChequeBookOpen').val('');
                        $('#IsChequeBookOpen').val('YES');
                        $.each(data1.chqNoList, function(k, getData){

                            var upId = getData.CHEQUENO+'~'+getData.CHQBHID+'~'+getData.CHQBBID+'~'+getData.SLNO;
                            $("#chequeNoList1").append($('<option>',{

                              value:getData.CHEQUENO,

                              'data-xyz':upId


                            }));

                        });

                      }
                    /* ---------- get cheque no deatils ------- */

            } /* /. success */
         } /* /. success function */
    }); /* /. ajax function */
    } /* /. main function */

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
                        
                     $('#glschcshow').html(data1.gl_data.GLSCH_CODE);
                     $('#glcdshow').html(data1.gl_data.GL_CODE);
                     $('#glnshow').html(data1.gl_data.GL_NAME);
                     $('#gltypeshow').html(data1.gl_data.GLSCH_TYPE);


                  }

               }
            }
        });

    }

/* ---------- get vrno against series code ------------- */

/* ---------- PAYMENT ADVICE FUNCTION -------------- */

    function paymentAdviceFun(slNo){

        $("#paymentAdviceMd"+slNo).modal({
            show:false,
            backdrop:'static',
        });

        var acc_code = $('#acc_code'+slNo).val();
        var modlAccCd = $('#modlAccCode'+slNo).val();

        if(modlAccCd == ''){
            $('#modlAccCode'+slNo).val(acc_code);
            $('#payAdvice_body'+slNo).empty();
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var headData = "<div class='box-row' style='background-color: blanchedalmond;'><div class='box10 texIndbox1'>#</div><div class='box10 texIndbox1'>Vr Date</div><div class='box10 texIndbox1'>Vr No</div><div class='box10 texIndbox1'>T Code</div><div class='box10 texIndbox1'>Advice Amt</div><div class='box10 texIndbox1'>Particular<input type='hidden' id=totlChkAmtPA"+slNo+"></div></div>";
            $('#payAdvice_body'+slNo).append(headData);

            $.ajax({

                url:"{{ url('get_advice_by_payment_advice') }}",
                method : "POST",
                type: "JSON",
                data: {acc_code: acc_code},

                success:function(data){

                    var data1 = JSON.parse(data);

                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                                
                    }else if(data1.response == 'success'){

                        if(data1.data == ''){
                            $('#payAdviceOkBtn'+slNo).prop('disabled',true);
                        }else{
                            $('#payAdviceOkBtn'+slNo).prop('disabled',false);
                            var payRwId =1;
                            $.each(data1.data,function(key,value){

                                var splitDate =value.VRDATE.split('-');
                                var getvrDate = splitDate[2]+'-'+splitDate[1]+'-'+splitDate[0];

                                var fyCd   = value.FY_CODE;
                                var spliFy = fyCd.split('-');

                                var genVrno = spliFy[0]+' '+value.SERIES_CODE+' '+value.VRNO;

                                var bodyData = "<div class='box-row'><div class='box10 texIndbox1 modlrowSace' style='width:5%;'><input type='checkbox' name='payAdviceRChk[]' class='checkRowPA checkCls' id='checkboxPA_"+slNo+"_"+payRwId+"' value="+value.PAYID+'~'+value.COMP_CODE+'~'+value.FY_CODE+'~'+value.SERIES_CODE+'~'+value.VRNO+'~'+value.SLNO+" onclick='setOnOff("+slNo+","+payRwId+")'><input type='hidden' value="+value.ADVICE_AMT+" name='pay_advice_amt' id='pay_advice_amt_"+slNo+"_"+payRwId+"'></div>"+
                                    "<div class='box10 texIndbox1 modlrowSace' style='width:10%;'>"+getvrDate+"</div>"+
                                    "<div class='box10 texIndbox1 modlrowSace' style='width:10%;'>"+genVrno+"</div>"+
                                    "<div class='box10 texIndbox1 modlrowSace' style='width:15%;'>"+value.TRAN_CODE+"</div>"+
                                    "<div class='box10 texIndbox1 modlrowSace amntRight' style='width:10%;'>"+value.ADVICE_AMT+"</div>"+
                                    "<div class='box10 texIndbox1 modlrowSace textLeft' style='width:55%;'>"+value.REMARK+"</div><input type='hidden' value='off' name='onoffcheck' class='onOffChkA' id='onOff_"+slNo+"_"+payRwId+"' ></div>";
                                $('#payAdvice_body'+slNo).append(bodyData);
                            payRwId++;});/* /.each loop*/

                        }/* /.  data codn*/

                    } /* /. success codn*/
                }/* /.  success function*/

            }); /* /. ajax*/
        }
    }

    function setOnOff(slno,paRowSlno){

        var check = document.getElementById('checkboxPA_'+slno+'_'+paRowSlno);
        if(check.checked){
            $('#onOff_'+slno+'_'+paRowSlno).val('on');
        }else{
            $('#onOff_'+slno+'_'+paRowSlno).val('off');
        }

        var checkedCount = $("#payAdvice_body"+slno+" input:checked").length;
        if(checkedCount > 0){
            $('#payAdviceOkBtn'+slno).prop('disabled',false);
        }else{
            $('#payAdviceOkBtn'+slno).prop('disabled',true);
        }

    }

    function canlcePayAdvice(slno){

        var inputs = document.querySelectorAll('.checkRowPA');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].checked = false;
            $('.onOffChkA').val('off');
        }

    }

    function getpayAviceAmt(srNo){

        var checkedCount = $("#payAdvice_body"+srNo+" input:checked").length;

        if(checkedCount > 0){
            $('#OneCheckboxSel1').html('');
        }else{
            
            $('#OneCheckboxSel1').html('Please Select At Least One Checkbox....!');
        }

        $('#payAdviceDone'+srNo).val('1');

        var paymentid = [];

        $(".checkRowPA").each(function (){
              
            if($(this).is(":checked")){

              paymentid.push($(this).val());
            }
        });

        var adv_amount =0;
        var refText=[];
        for(var r=0;r<paymentid.length;r++){
            
            var advamount = $("#payAdvice_body"+srNo+" input:checked")[r].parentNode.parentNode.children[4].innerHTML;

             adv_amount += parseFloat(advamount);

            var getrefText = $("#payAdvice_body"+srNo+" input:checked")[r].parentNode.parentNode.children[5].innerHTML;
            refText.push(getrefText);
            
            
        }

        //console.log('for adv_amount',adv_amount);
        $('#totlChkAmtPA'+srNo).val(adv_amount);
        $('#refTextPA'+srNo).val(refText);
        $('#discription'+srNo).val(refText);
        $('#dr_amount'+srNo).val(adv_amount).prop('readonly',true);
        $('#acc_code'+srNo).prop('readonly',true);
        $('#tds_rate'+srNo).prop('disabled',false);

        var sum = 0;
        //dr amount
        $(".dr_amount").each(function () {

            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }

          $("#totldramt").val(sum.toFixed(2));

        });

        var isAdvDone = $('#payAdviceDone'+srNo).val();

        /*if(isAdvDone == 1){

            $('#billTkDr'+srNo).html('<button type="button" class="btn btn-primary btn-xs viewBilTrak" id="ViewBillTrack'+srNo+'" data-toggle="modal" data-target="#ViewBT_Detail'+srNo+'" onclick="detailBillTrack('+srNo+')">Bill Track </button><div id="AplyIconBT'+srNo+'" style="padding-top: 5px;">');

        }*/

    }

/* ---------- PAYMENT ADVICE FUNCTION -------------- */

/* --------- BILL TRACK MODAL ----------- */

    function detailBillTrack(rowNo){
        //console.log('rowNo',rowNo);return false;
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
                                    var crAmount      = getdata.CRAMT;
                                    var crdrAmt      = getdata.CRAMT;
                                    var prevAlocAmt = getdata.CRALLOC;
                                    var cralloc       = getdata.CRALLOC;
                                    var newDrAmt      = crAmount - cralloc;
                                }else if(vr_type == 'Receipt'){
                                    var drAmount      = getdata.DRAMT;
                                    var crdrAmt      = getdata.DRAMT;
                                    var prevAlocAmt = getdata.DRALLOC;
                                    var dralloc       = getdata.DRALLOC;
                                    var newDrAmt      = drAmount - dralloc;
                                }
                                var fyYear     = getdata.FY_CODE;
                                var fy_split   = fyYear.split('-');
                                var start_year = fyYear[0];
                                var seriesCd = getdata.SERIES_CODE;
                                var vrNo = getdata.VRNO;
                                var genVrno = start_year+' '+seriesCd+' '+vrNo;
                                var DataAmt = '<div class="box-row"><div class="box10 texIndbox1">'+genVrno+'<input type="hidden" name="accTranId[]" id="accTID1" value="'+getdata.ACCTRANID+'"><input type="hidden" name="accTranVrno[]" id="accTranVrno'+srno+'" value="'+getdata.VRNO+'"><input type="hidden" name="cbVrno[]" id="cbVrno'+srno+'" value="'+vrseqnum+'"><input type="hidden" name="cbVrdate[]" id="cbVrdate'+srno+'" value="'+vr_date+'"><input type="hidden" name="cbAccCd[]" id="cbAccCd'+srno+'" value="'+accCode+'"><input type="hidden" name="cbTCd[]" id="cbTCd'+srno+'" value="'+transCd+'"><input type="hidden" name="cbPerticular[]" id="cbPerticular'+srno+'" value="'+perticular+'"></div><div class="box10 rateIndbox">'+getdata.VRDATE+'<input type="hidden" name="accTranVrDate" value='+getdata.VRDATE+'></div><div class="box10 rateIndbox numriRight">'+crdrAmt+'<input type="hidden" id="baleAlocat'+rowNo+'_'+srno+'" value="'+crdrAmt+'"></div><div class="box10 rateBox" style="text-align:right;">'+prevAlocAmt+'</div><div class="box10 amountBox"><input type="text" name="alocateAmt[]" class="allocatAmt rightcontent numriRight" id="alocateAmt'+rowNo+'_'+srno+'" value="0" oninput="totlAlocat('+rowNo+','+srno+');"></div><div class="box10 amountBox"><input type="text" class="rightcontent numriRight" id="balAmt'+rowNo+'_'+srno+'" value="'+newDrAmt+'" readonly></div></div>';
                                 $('#biltrkBody'+rowNo).append(DataAmt);
                                srno++;
                            });
                        } /* /. DATA IS AVAILABLE CHK*/ 
                    }/* /.  SUCCESS CODN*/
                }/* /. SUCCESS FUNCTION*/

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
        $('#addmorhidn,#deletehidn').prop('disabled',true);
        $('#glCodeName'+rwId+',#acc_code'+rwId+',#acc_code'+rwId+',#dr_amount'+rwId+',#cr_amount'+rwId+'').prop('readonly',true);
    }

    function cancleBillTrack(srNum){
       $('#isBillTrckChk'+srNum).val(0)
       $('#biltrkBody'+srNum).empty();
    }


/* --------- BILL TRACK MODAL ----------- */

    $(document).ready(function() {

        /*$("#PurchaseBillManage").on('change', function() {

        });
*/
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


    function submitCBData(valp){

        var downloadFlg = valp;
        $('#pdfYesNoStatus').val(downloadFlg);
        var data = $("#cahsbanktrans").serialize();

        var rowIDget =[];

        $(".rowCountCls").each(function () {
            
            rowIDget.push(this.value);

        });

        var glcdAry=[];
        var amntAry = [];
        var amtlessThanZero = [];
        for(var y=0;y<=rowIDget.length;y++){
            var colIdSlno = rowIDget[y];
            var glCd = $('#glCodeName'+colIdSlno).val();
            glcdAry.push(glCd);

            var vrType = $('#vr_type').val();
            if(vrType == 'Payment'){
                var drcrAmt = $('#dr_amount'+colIdSlno).val();
            }else if(vrType == 'Receipt'){
                var drcrAmt = $('#cr_amount'+colIdSlno).val();
            }else{
                var drcrAmt='';
            }

            if(drcrAmt==''){
              amntAry.push('YES');
            }else{
               
            }

            if(drcrAmt <= 0){
                amtlessThanZero.push('YES');
            }

        }

        var glBlank = glcdAry.find(function (element) {
            return element == '';
        });

        var amtBlank = amntAry.find(function (element) {
            return element == 'YES';
        });

        if(glBlank == ''){
 
            $("#blankFieldModal").modal('show');
            $('#whenRowBlnk').html('<b>Enter Details In above row otherwise delete the row.</b>');

        }else if(amtBlank == 'YES'){
 
            $("#blankFieldModal").modal('show');
            $('#whenRowBlnk').html('<b>Enter Details In above row otherwise delete the row.</b>');
        }else if(amtlessThanZero == 'YES'){

            $("#blankFieldModal").modal('show');
            $('#whenRowBlnk').html('<b>Zero amount can not be post.</b>');
        }else{

            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
            });

            $.ajax({

                type: 'POST',
                url: "{{ url('/new-save-cash-bank-transaction') }}",
                dataType: "json",
                data: data, 

                success: function (data) {

                  var data1 = JSON.parse(JSON.stringify(data));

                  if (data1.response == 'error') {
                    var responseVar = false;
                    var url = "{{url('/view-cash-bank-success-msg')}}"
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
                    }
                    var url = "{{url('/view-cash-bank-success-msg')}}"
                    setTimeout(function(){ window.location = url+'/'+responseVar; });
                  }
              
                },
            });

        } /* /. else*/
        

}

</script>




@endsection