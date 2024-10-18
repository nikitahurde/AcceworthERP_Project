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
  .glcodeCls {
    font-size: 14px;
    float: left;
    margin-left: 3px;
  }
  .accCodeCls {
    font-size: 14px;
    line-height: 38px;
    float: left;
    margin-left: 3px;
  }
  .debit_sim{
    border: none;
    text-align: right;
    width: 100%;
    margin-right: -17px;
  }
  .credit_sim{
    border: none;
    text-align: right;
    width: 100%;
    margin-right: -17px;
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

.showinmobile{
  display: none;
}
.secondSection{

  display: none;
}
.rightcontent{

  text-align:right;


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
/* table{border-collapse:collapse;border-radius:25px;width:880px;} */
/*table, td, th{border:1px solid #00BB64;}*/
/*tr,input{height:30px;border:1px solid #c8bebe;}*/

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
    float: left;
    margin-left: 3px;
}
.instTypeMode{
    width: 59%;
    margin-bottom: 5px;
    margin-right: 1px;
}
.textdesciptn{
  width: 250px;
    margin-bottom: 5px;
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

        </section>



  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Cash Bank Transaction</h2>

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
<!-- 
          < ?php 
            echo '<pre>';
            print_r($cash_bank_list);
            echo '</pre>';

          ?> -->
            
            <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label>Company: <span class="required-field"></span>
                      </label>

                    <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" id="company_code" name="comp" placeholder="Enter Company Name" value="{{strtoupper(Session::get('company_name'))}}" readonly>

                    </div>

                    <small id="comp_code_err" style="color: red;"></small>
                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>
                  <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-3">

                <div class="form-group">

                  <label> Fiscal Year : <span class="required-field"></span></label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                    <input type="text" class="form-control" id="fy_year" name="fiscal" placeholder="Enter fy Year" value="{{strtoupper(Session::get('macc_year'))}}" readonly> 

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fy_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div>
                    <!-- /.form-group -->
            </div>
                <!-- /.col -->

            <div class="col-md-3">

              <div class="form-group">

                  <label>Series : 
                    <span class="required-field"></span>
                  </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="seriesList"  id="series_code" name="series" class="form-control  pull-left" value="{{$cashbank_list->series_code}}" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" readonly>

                    </div>
                    <small id="serscode_err" style="color: red;" class="form-text text-muted">
                    </small>
                    <small>  

                        <div class="pull-left showSeletedName" id="seriesText"></div>

                    </small>
                       
                    <small id="series_code_errr" style="color: red;"></small>
                          

              </div>
                    <!-- /.form-group -->
            </div>

            

            
          </div>

            <div class="row">

            

            <div class="col-md-2">

              <div class="form-group">

                  <label>GL Code : <span class="required-field"></span>
                  </label>

                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                    <input type="text" class="form-control" name="gl" id="gl_code" value="{{$cashbank_list->gl_code}}" placeholder="Enter GL Code" disabled="">

                </div>

                <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                </small>

              </div>
               <!-- /.form-group -->
            </div>

            <div class="col-md-4">

              <div class="form-group">

                <label> GL Name : <span class="required-field"></span>
                </label>

                <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <input type="text" class="form-control" name="gl" value="{{$cashbank_list->gl_name}}" id="gl_name" placeholder="Enter GL Name" disabled="">
                </div>

                <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gl_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                </small>

              </div>
                    <!-- /.form-group -->
            </div>
            <!-- /.col -->
            <div class="col-md-2">

              <div class="form-group">
                
                <label> Vr No: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                  
                    
                    <input type="text" class="form-control rightcontent" name="vro" value="{{$cashbank_list->vrno}}" placeholder="Enter Vr No" id="vrseqnum" readonly>

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2">
              
              <div class="form-group">

                  <label> T Code : </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="tran" value="{{$cashbank_list->tran_code}}" id="transcode" placeholder="Enter Transaction Head" readonly>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

              </div>
                    <!-- /.form-group -->
            </div>
                <!-- /.col -->
          </div>

          <div class="row">

            <div class="col-md-3">

                <div class="form-group">

                    <label> Vr Type :  <span class="required-field"></span>
                    </label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                         <!--  <input type="text" class="form-control" name="transaction_head" value="{{ old('transaction_head') }}" placeholder="Enter Transaction Head"> -->
                         <select name="vr" id="vr_type" class="form-control" disabled>
                            <option value="">--Select--</option>
                           <option value="Payment" <?php if($cashbank_list->vr_type == 'Payment'){echo 'selected';} ?>>Payment</option>
                           <option value="Receipt" <?php if($cashbank_list->vr_type == 'Receipt'){echo 'selected';} ?>>Receipt</option>
                           <option value="Journal" <?php if($cashbank_list->vr_type == 'Journal'){echo 'selected';} ?>>Journal</option>
                         </select>

                    </div>

                    <small id="vr_type_err" style="color: red;"></small>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3">

                <div class="form-group">

                  <label>Date: <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     <?php $vrDate = date("d-m-Y", strtotime($cashbank_list->vr_date)); ?>
                      <input type="text" class="form-control transdatepicker rightcontent" name="vr" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" disabled>

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Profit Center Code: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="profitList"  id="profitId" name="pfct" class="form-control  pull-left" value="{{$cashbank_list->pfct_code}}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" disabled>

                  </div>
                  <small>  

                      <div class="pull-left showSeletedName" id="profitText"></div>

                  </small>
                  <small id="profit_center_err" style="color: red;"> </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

                <div class="form-group">

                    <label>Profit Center Name: <span class="required-field"></span>
                      </label>

                    <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                          <div class="pull-left showSeletedName" id="profit_names"></div>
                          <input type="text" class="form-control" id="profit_name" name="profit" placeholder="Enter Profit Center Name" value="{{$cashbank_list->pfct_name}}" readonly>

                    </div>

                    <small id="comp_code_err" style="color: red;"></small>
                    <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('pfct_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div>
                  <!-- /.form-group -->
            </div>

            
          </div>

          

          <div class="row">
              
            

            

          </div>


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
         
            <!-- <form id="cahsbanktranssss" method="POST" name='students' action="{{ url('save-cash-bank-transaction') }}"> -->
            <form id="cahsbanktrans">

            
               @csrf
              <div class="table-responsive">

                <input type="hidden" name="compCode_Up" value="{{$cashbank_list->company_code}}">
                  <input type="hidden" name="fycode_up" value="{{$cashbank_list->fy_code}}">
                  <input type="hidden" name="series_up" value="{{$cashbank_list->series_code}}">
                  <input type="hidden" name="gl_up" value="{{$cashbank_list->gl_code}}">
                  <input type="hidden" name="glname_up" value="{{$cashbank_list->gl_name}}">
                  <input type="hidden" name="vrno_up" value="{{$cashbank_list->vrno}}">
                  <input type="hidden" name="transCode_up" value="{{$cashbank_list->tran_code}}">
                  <input type="hidden" name="vrtype_up" value="{{$cashbank_list->vr_type}}">
                  <input type="hidden" name="vrdate_up" value="{{$cashbank_list->vr_date}}">
                  <input type="hidden" name="pfctname_up" value="{{$cashbank_list->pfct_name}}">
                  <input type="hidden" name="pfctcode_Up" value="{{$cashbank_list->pfct_code}}">
                
                <input type="hidden" id="" name="existuniqAccode" value="{{$cashbank_list->update_flag}}">
                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                  <tr>
                    <th></th>
                    <th>Sr.No.</th>
                    <th>Account Code</th>
                    <th>Account Name</th>
                    <th>Debit-DR</th>
                    <th>Credit-CR</th>
                  </tr>
                <?php $sr_num =1; foreach ($cash_list as $keydatas) {  


                  ?>
                  
                  <tr class="useful">
                    <input type="hidden" name="update_flag_up[]" value="{{$keydatas->update_flag}}">
                    <input type="hidden" value="{{$keydatas->tds_amt}}" id="tds_amt_dr_cr<?php echo $sr_num;?>">
                    <td class="tdthtablebordr"> <span id='snum'>{{$sr_num}}</span></td>
                    <td class="tdthtablebordr" style="width: 58%;padding: 8px 0px 0px 0px;">
                     
                      <small class="glcodeCls">Gl Code</small><br>
                      <small class="accCodeCls">Account Code</small><br>
                        <label for="" class="instrumentlbl">I Type</label><br><br>
                       <input  type="hidden" name="tds_rate_up[]" id="TdsRateByAccCode<?php echo $sr_num;?>" class="getRateForAcc" value="{{$keydatas->tds_rate}}">
                       <input type="hidden" name="tds_code_up[]" id="TdsSection<?php echo $sr_num;?>" value="{{$keydatas->tds_code}}">
                      <button type="button" class="btn btn-primary btn-xs tdsratebtn tdsratebtnHide" id="tds_rate<?php echo $sr_num;?>" data-toggle="modal" data-target="#tds_rate_model<?php echo $sr_num;?>" onclick="CalculateTdsRate(<?php echo $sr_num;?>)">Calc TDS</button>
                      <input type="hidden" id="tdsByAccCode<?php echo $sr_num;?>" value="{{$keydatas->tds_code}}" name="tdsCodeByAc[]">
                      <input type="hidden" name="" id="accNtdsrate<?php echo $sr_num;?>" value="{{$keydatas->acc_code}}">
                      <input type="hidden" id="ledgrAmt<?php echo $sr_num;?>"  name="ledgrAmt[]">
                      
                    </td> 
                    <td class="tdthtablebordr">
                      <div class="input-group">
                      <input list="glCodeNameList<?php echo $sr_num;?>" class="inputboxclr glcodeGets tabnext" style="width: 107px;margin-bottom: 5px;" id='glCodeName<?php echo $sr_num;?>'  name="glCodeName[]"  value="{{$keydatas->gl_code}}" onchange="glcodeNameData(<?php echo $sr_num;?>);" oninput="this.value = this.value.toUpperCase()" />

                        <datalist id="glCodeNameList<?php echo $sr_num;?>">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($glcodename_list as $key)

                            <option value='<?php echo $key->gl_code?>' data-xyz ="<?php echo $key->gl_name; ?>" ><?php echo $key->gl_name ; echo " [".$key->gl_code."]" ; ?></option>

                            @endforeach

                          </datalist>
                      </div>
                      <div class="input-group">
                      <input list="AccList<?php echo $sr_num;?>" class="inputboxclr getacccode" style="width: 107px;margin-bottom: 5px;" tabindex="1" id='acc_code<?php echo $sr_num;?>' name="acc_code_up[]" onkeyup='GetAccountCode(<?php echo $sr_num;?>)' onchange="AccListData(<?php echo $sr_num;?>)" value="{{$keydatas->acc_code}}" oninput="this.value = this.value.toUpperCase()"/>

                        <datalist id="AccList<?php echo $sr_num;?>">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($help_account_list as $key)

                            <option value='<?php echo $key->acc_code?>' data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>

                            @endforeach

                          </datalist>
                      </div>
                       <input type="hidden" id="acc_class<?php echo $sr_num;?>" name="accClass[]">
                      <input type="hidden" id="acc_type<?php echo $sr_num;?>" name="accType[]">
                       <input type="hidden" name="gltdscode[]" id="GettdsCode<?php echo $sr_num;?>" value="">
                      <input type="hidden" name="gltdsname[]" id="GettdsName<?php echo $sr_num;?>" value=''>
                      <div style="display: flex;">
                      <input list="InstTypeList<?php echo $sr_num;?>" id="inst_type<?php echo $sr_num;?>" class="instTypeMode getinstrument" name="instrument_type_up[]" tabindex="2" onchange="ITypeChng(<?php echo $sr_num;?>)" value="{{$keydatas->instrument_type}}" placeholder="Select I 
                      Type">

                          <datalist id="InstTypeList<?php echo $sr_num;?>">
                            <option selected="selected" value="">-- Select --</option>
                            
                            <option value='CH' data-xyz ="Cheque">Cheque[CH]</option>
                            <option value='DD' data-xyz ="Demand Draft">Demand Draft[DD]</option>
                            <option value='TR' data-xyz ="Transfer receipt">Transfer receipt[TR]</option>
                            <option value='TT' data-xyz ="Tele Transfer">Tele Transfer[TT]</option>  
                            <option value='MT' data-xyz ="Money Transfer">Money Transfer[MT]</option>
                            <option value='RT' data-xyz ="RTGS">RTGS[RT]</option>     
                            <option value='BA' data-xyz ="Bank Advise">Bank Advise[BA]</option>     
                            <option value='EC' data-xyz ="Electronic Clearence">Electronic Clearence[EC]</option>     
                            <option value='NA' data-xyz ="Not Applicable">Not Applicable[NA]</option>     

                          </datalist><br>
                      <input type='text' class="inputboxclr onchenkno" style="width: 63px;margin-bottom: 4px;" id='cheque_no<?php echo $sr_num;?>' tabindex="3" value="{{$keydatas->instrument_no}}" name="instrument_no_up[]" oninput='GetChkNoWhenEdit(<?php echo $sr_num;?>);'/>
                      </div>

                      <div class="input-group">

                        <input list="bankList<?php echo $sr_num;?>"  id="bankid<?php echo $sr_num;?>" name="bank_code_up" class="inputboxclr bankshowwhenrecpt" value="{{$keydatas->bank_code}}" style="width: 107px;margin-bottom: 5px;" placeholder="Enter Bank" onchange="banklistget(<?php echo $sr_num;?>)" oninput="this.value = this.value.toUpperCase()">

                        <datalist id="bankList<?php echo $sr_num;?>">

                          <option selected="selected" value="">-- Select --</option>

                          @foreach ($bank_list as $key)

                          <option value='<?php echo $key->bank_code?>'   data-xyz ="<?php echo $key->bank_name; ?>" ><?php echo $key->bank_name ; echo " [".$key->bank_code."]" ; ?></option>

                          @endforeach

                        </datalist>

                      </div>
                      <small id="bank_name_err" style="color: red;"></small>
                      <small>  

                          <div class="pull-left showSeletedName" id="bankText<?php echo $sr_num;?>"></div>

                      </small>
                    </td>
                    <td class="tdthtablebordr">
                      <input type="text" class="inputboxclr getglCNAme" style="width: 250px;margin-bottom: 5px;" id='genrl_name<?php echo $sr_num;?>' name="genrl_name[]" value="{{$keydatas->gl_name}}" readonly />
                      <input type="text" class="inputboxclr getAccNAme" style="width: 250px;margin-bottom: 5px;" id='acc_name<?php echo $sr_num;?>' name="acc_name_up[]" value="{{$keydatas->acc_name}}" readonly />
                      <input type="text" class="textdesciptn discription forperticulr"  name="particular_up[]" id="discription<?php echo $sr_num;?>" value="{{$keydatas->particular}}" readonly>
                      <textarea  rows="1" type="text" style="width: 250px;" name="ref_text_up[]" tabindex="4" id="referencetext<?php echo $sr_num;?>" class="dd">{{$keydatas->ref_text}}</textarea>
                      <input type="text" id="ShowBankName<?php echo $sr_num;?>" style="width: 250px;margin-bottom: 2%;" class="bankNameGet" readonly>
                    </td>
                    <?php
                   

                    $dr_amt =  floatval($keydatas->dr_amount);

                      if($dr_amt){
                       $drAmnt =  $keydatas->tds_amt + $dr_amt;
                      }else{
                        $drAmnt ='';
                      }
                
                      ?>
                    
                    <td class="tdthtablebordr"><input type='text' class="debitcreditbox dr_amount inputboxclr"  id='dr_amount<?php echo $sr_num;?>' name="dr_amount_up[]" value="{{$drAmnt}}" onkeypress='NumberCredit()' tabindex="5" oninput='GetDebitAmountEdit(<?php echo $sr_num;?>)'/ >
                    <input type="hidden" id="resultofdebit<?php echo $sr_num;?>" name="DebitdsAmt_up[]" value="">
                    <input type="hidden" id="Applytdsonamt<?php echo $sr_num;?>" value="{{$keydatas->dr_amount}}" name="TdsDebitAmount[]" value="">
                    <input type="hidden" id="WhenTdsCutDebit<?php echo $sr_num;?>" name="base_amt_Debit_up" value="{{$keydatas->base_amt}}">
                    </td>
                    <?php 
                   

                   $cr_amt =  floatval($keydatas->cr_amount);  
                    if($cr_amt){
                       $crAmnt =  $keydatas->tds_amt + $cr_amt;
                      }else{
                        $crAmnt ='';
                      }
                
                    ?>
                    <td class="tdthtablebordr"><input type='text' class="debitcreditbox inputboxclr cr_amount" id='cr_amount<?php echo $sr_num;?>' name="cr_amount_up[]" tabindex="6" value="{{$crAmnt}}" onkeypress='NumberCredit()' oninput='GetCreditAmountEdit(<?php echo $sr_num;?>)' />
                    <input type="hidden" id="resultofcredit<?php echo $sr_num;?>" name="CredittdsAmt_up[]" value="">
                    <input type="hidden" id="Applytdsonamtforcr<?php echo $sr_num;?>" name="TdsCreditAmount[]" value="{{$keydatas->cr_amount}}">
                    <input type="hidden" id="WhenTdsCutCredit<?php echo $sr_num;?>" name="base_amt_Credit" value="">
                     <input type="hidden" id="base_amount<?php echo $sr_num;?>" name="base_amount[]" value="">
                     </td>
                  </tr>


                  <!-- model -->
      <div class="modal fade" id="tds_rate_model<?php echo $sr_num;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
                    <input type="text" id="tds_section<?php echo $sr_num;?>" name="tds_section" value="" readonly>
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Tds Rate</label>
                    
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="tdsRate<?php echo $sr_num;?>" readonly style="text-align: right;">
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Tds Base Amount</label>
                    
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="Net_amount<?php echo $sr_num;?>" readonly style="text-align: right;">
                    
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Tds Amount calculate</label>
                    
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="tds_Amt_cal<?php echo $sr_num;?>" readonly style="text-align: right;">
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Net Amount</label>
                    
                  </div>
                  <div class="col-md-4">
                    <input type="hidden" id="tds_base_Amt<?php echo $sr_num;?>" name="baseTDSAmt" value="" oninput="changetdsamt(<?php echo $sr_num;?>)">
                    <input type="text" id="deduct_tds_Amt<?php echo $sr_num;?>" readonly name="base_amt_tds[]" style="text-align: right;">
                  </div>
                  <div class="col-md-2"></div>
              </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-primary" style="width: 27%;" data-dismiss="modal" id="ApplyTds<?php echo $sr_num;?>" onclick="Applytds(<?php echo $sr_num;?>)">Apply TDS</button>
              <button type="button" class="btn btn-warning" style="width: 20%;" data-dismiss="modal">Cancle</button>
            </div>
          </div>
        </div>
      </div>
<!-- model -->

                <?php $sr_num++;} ?>
                </table>
              </div>
              <div>
              <div class="row" style="display: flex;">
                  
              </div>
              <div id="showgreatermsg" style="text-align: end;color: red;"></div>
              <input type="hidden" name="series_code" id="hidnseried"> 
              <input type="hidden" name="gl_code" id="hidnglcode"  value="{{$keydatas->gl_code}}"> 
              <input type="hidden" name="gl_name" id="hidnglnme" value="{{$keydatas->gl_name}}">
              <input type="hidden" name="bank_code" id="hidnbanknme">
              <input type="hidden" name="vrno" id="hidnvrseq">
              <input type="hidden" name="tran_code" id="hidntranscd">
              <input type="hidden" name="vr_type" id="hidnvrtyp">
              <input type="hidden" name="company_code" id="hidncopmnm">
              <input type="hidden" name="fy_code" id="hidnfyyear">
              <input type="hidden" name="vr_date" id="hidnvrdte">
              <input type="hidden" name="pfct_code" id="hidnpfitid">
              <input type="hidden" name="pfct_name" id="hidngpfitnme">
              </div>
             
              <!-- <p class="text-center"> <input type='submit' name='submit' value='submit' id="submitdata" class='btn but' disabled /></p>--> 
              
              <p class="text-center">
                <button class="btn btn-primary " type="button" id="simulationbtn" ><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp;&nbsp; Simulation</button> 

                <button class="btn btn-success" type="button" id="UpdateData" ><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update</button>

                <a href="{{ url('finance/view-cash-bank')}}" class="btn btn-warning"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</a>
              </p>



              


              </form>

              
          
          </div><!-- /.box-body -->

        </div>

      </div>

    </div>

  </section>



</div>

<!-- simulation Model -->
<style type="text/css">
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
    
}
</style>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showallDataM">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="border-radius: 5px;">
      <div class="modal-header">
        <h5 class="modal-title modltitletext" id="exampleModalLabel" style="font-size: 17px;">Simulation Of Cash / Bank</h5>
      </div>
      <div class="modal-body" id="modelbody">
         <section>
            <ol class="collection collection-container simulationOl">
      <!-- The first list item is the header of the table -->
      <li class="item item-container">

        <div class="attribute" data-name="#" style="border-left: 1px solid gray;">Sr.No.</div>

        <!-- Enclose semantically similar attributes as a div hierarchy -->
        <div class="attribute-container part-information">
          <div class="attribute-container part-id">
            <div class="attribute" data-name="Part Number">Gl Code</div>
          </div>
        </div>


        <div class="attribute-container cost">
          <div class="attribute">Gl Name</div>
        </div>

        <div class="attribute-container cost">
          <div class="attribute">Perticular</div>
        </div>

        <div class="attribute-container duty">
          <div class="attribute">Debit-DR</div>
        </div>

        <div class="attribute-container freight">
          <div class="attribute">Credit-CR</div>
        </div>

        <div class="attribute-container duty">
          <div class="attribute">Account Code</div>
        </div>

        <div class="attribute-container freight">
          <div class="attribute">Account Name</div>
        </div>

      </li>
      <!-- The rest of the items in the list are the actual data -->
  
    </ol>
    <div class="item item-container">
        <div class="attribute" data-name="#" style="border-left: 1px solid gray;"></div>

          <!-- Enclose semantically similar attributes as a div hierarchy -->
          <div class="attribute-container part-information">
            <div class="attribute-container part-id">
              <div class="attribute" data-name="Part Number"></div>
            </div>
          </div>


          <div class="attribute-container cost">
            <div class="attribute"></div>
          </div>

          <div class="attribute-container cost">
            <div class="attribute">Total :</div>
          </div>

          <div class="attribute-container duty">
            <div class="attribute"><input type="text" id="drsim_total" readonly></div>
          </div>

          <div class="attribute-container freight">
            <div class="attribute"><input type="text" id="crsim_total" readonly></div>
          </div>

          <div class="attribute-container duty">
            <div class="attribute"></div>
          </div>

          <div class="attribute-container freight">
            <div class="attribute"></div>
          </div>

      </div>

      <div class="item item-container">
      <div class="attribute" data-name="#" style="border-left: 1px solid gray;"></div>

        <!-- Enclose semantically similar attributes as a div hierarchy -->
        <div class="attribute-container part-information">
          <div class="attribute-container part-id">
            <div class="attribute" data-name="Part Number"></div>
          </div>
        </div>


        <div class="attribute-container cost">
          <div class="attribute"></div>
        </div>

        <div class="attribute-container cost">
          <div class="attribute" style="font-weight: 700;">Net Amount :</div>
        </div>

        <div class="attribute-container duty">
          <div class="attribute"><input type="text" id="netAmt_sim" readonly></div>
        </div>

        <div class="attribute-container freight">
          <div class="attribute"></div>
        </div>

        <div class="attribute-container duty">
          <div class="attribute"></div>
        </div>

        <div class="attribute-container freight">
          <div class="attribute"></div>
        </div>

    </div>
          </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="">Ok</button>
      </div>
    </div>
  </div>
</div>
<!-- simulation Model -->


 




@include('admin.include.footer')


<script src="{{ URL::asset('public/dist/js/viewjs/cash_bank_trans.js') }}" ></script>


<script type="text/javascript">
  $(document).ready(function() {

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

  for(m=1;m<=3;m++){

    $('#cr_amount'+m).on('input',function(){
     var CrAmount = $('#cr_amount'+m).val();

      if(CrAmount){
        $('#resultofdebit'+m).val('');
      }
    });

    $('#dr_amount'+m).on('input',function(){
     var DebitAmt = $('#dr_amount'+m).val();

      if(DebitAmt){
        $('#resultofcredit'+m).val('');
      }
    });

  }





$( window ).on( "load", function() {
   //$('#cr_amount1').prop('readonly',true);
      for(n=1;n<=3;n++){

           // console.log(n);
          
          var DebitValue = $('#dr_amount'+n).val();
     //   console.log('db',DebitValue);
          var CreditValue = $('#cr_amount'+n).val();
          var instType = $('#inst_type'+n).val();
       //   console.log('cr',CreditValue);
          var tds_Amount = $('#tds_amt_dr_cr'+n).val();

          if(DebitValue !=0){
              $('#cr_amount'+n).prop('readonly',true);
              $('#resultofdebit'+n).val(tds_Amount);
             // $('#resultofdebit'+n).val(tds_Amount);
          }else if(CreditValue !=0){
               $('#dr_amount'+n).prop('readonly',true);
               $('#resultofcredit'+n).val(tds_Amount);
          }else{
            $('#dr_amount'+n).prop('readonly',false);
            $('#cr_amount'+n).prop('readonly',false);

          }
         
         /* if(DebitValue == 0){
              $('#resultofcredit'+n).val(tds_Amount);
              $('#dr_amount'+n).val('');
              
          }else{
              $('#resultofdebit'+n).val(tds_Amount);
          }
          if(CreditValue==0){
            $('#cr_amount'+n).val('');
          }else{
          }*/


          if(instType=='NA'){
            $("#cheque_no"+n).addClass('amntFild');
          }else{
            $("#cheque_no"+n).removeClass('amntFild');
          }

          var tdsDebit = $('#resultofdebit'+n).val();
          var tdsCredit = $('#resultofcredit'+n).val();
         if(tdsDebit !=0.00){
            $('#tds_rate'+n).removeClass('tdsratebtnHide');
         }else if(tdsCredit!=0.00){
            $('#tds_rate'+n).removeClass('tdsratebtnHide');
         }else{
             $('#tds_rate'+n).addClass('tdsratebtnHide');
         }

         var paymode = $('#vr_type').val();

          if(paymode == 'Receipt'){
              $('#bankid'+n).removeClass('bankshowwhenrecpt');
              $('#ShowBankName'+n).removeClass('bankNameGet');
          }else{
              $('#bankid'+n).addClass('bankshowwhenrecpt');
              $('#ShowBankName'+n).addClass('bankNameGet');
          }

      }

      var roeCount = $('#snum').html();

      var tdssectionC = $('#tdsByAccCode'+roeCount).val();

      if(tdssectionC){
      
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
                          $('#GettdsName'+roeCount).val(tdsNAme);
                          $('#GettdsCode'+roeCount).val(tdsCode);
                        }else{
                          $('#GettdsName'+roeCount).val(data1.data.gl_name);
                          $('#GettdsCode'+roeCount).val(data1.data.gl_code);
                        }                                              
                    }
               }

          });

    }else{}

    var accountcode =  $('#acc_code'+roeCount).val();

    if(accountcode){

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

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
                          var nottds = '';
                          $('#tdsByAccCode'+roeCount).val(nottds);
                        }else{
                          $('#tdsByAccCode'+roeCount).val(data1.data[0].tds_code);
                        }

                        var tdsByAccCodeExist = $('#tdsByAccCode'+roeCount).val();

                        if(tdsByAccCodeExist){
                              $('#tds_rate'+roeCount).removeClass('tdsratebtnHide');
                        }else{
                            $('#tds_rate'+roeCount).addClass('tdsratebtnHide');
                        }


                    }
               }

          });

    }else{}
    

       
});

});
</script>


<script type="text/javascript">

function CalculateTdsRate(TdsId){   
   
      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var tdsCode = $('#tdsByAccCode'+TdsId).val();
      var acCode = $('#acc_code'+TdsId).val();
      // console.log(accountcode);
        $.ajax({

              url:"{{ url('tds-rate-calculate') }}",

               method : "POST",

               type: "JSON",

               data: {tdsCode: tdsCode,acCode:acCode},

               success:function(data){

                    var data1 = JSON.parse(data);
               
                    if (data1.response == 'error') {

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){
                        // console.log(data1.data);
                       // console.log(data1.data[0].tds_code);
                        $('#tds_section'+TdsId).val(data1.tds_name[0].tds_code+' - '+data1.tds_name[0].tds_name);
                        $('#tdsRate'+TdsId).val(data1.data[0].tds_rate);
                        $('#TdsRateByAccCode'+TdsId).val(data1.data[0].tds_rate);
                        var dr_amt = $('#dr_amount'+TdsId).val();
                        var cr_amount = $('#cr_amount'+TdsId).val();

                        if(dr_amt != 0){
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
                          //var TdsAmtCalcult =  tdsbaseamtval - parseFloat(calculatPercnt);
                          //  console.log(TdsAmtCalcult);deduct_tds_Amt1

                          $('#tds_Amt_cal'+TdsId).val(calculatPercnt.toFixed(2));
                        
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

                      //console.log(data1.data);

                        if(data1.data==''){
                          var tdsNAme = '';
                          var tdsCode = '';
                          $('#GettdsName'+aplytdsval).val(tdsNAme);
                          $('#GettdsCode'+aplytdsval).val(tdsCode);
                        }else{
                          $('#GettdsName'+aplytdsval).val(data1.data.gl_name);
                          $('#GettdsCode'+aplytdsval).val(data1.data.gl_code);
                        }                                              
                    }
               }

          });
}
</script>

<script type="text/javascript">
  
  function GetAccountCode(Accid){
    //console.log(Accid);
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
                          var nottds = '';
                          var accclas = '';
                          var accType = '';
                          $('#acc_name'+Accid).val(accNAme);
                          $('#inst_type'+Accid).val('');
                          $('#cheque_no'+Accid).val('');
                          $('#discription'+Accid).val('');
                          $('#dr_amount'+Accid).val('');
                          $('#cr_amount'+Accid).val('');
                          $('#totldramt'+Accid).val('');
                          $('#resultofdebit'+Accid).val('');
                          $('#resultofcredit'+Accid).val('');
                          $('#referencetext'+Accid).val('');
                          $('#dr_amount'+Accid).prop('readonly',false);
                          $('#cr_amount'+Accid).prop('readonly',false);
                          $('#tds_rate'+Accid).addClass('tdsratebtnHide');
                          $('#tdsByAccCode'+Accid).val(nottds);
                          $('#acc_class'+Accid).val(accclas);
                          $('#acc_type'+Accid).val(accType);
                        }else{
                          $('#acc_name'+Accid).val(data1.data[0].acc_name);
                          $('#tdsByAccCode'+Accid).val(data1.data[0].tds_code);
                          $('#acc_class'+Accid).val(data1.data[0].accclass_code);
                          $('#acc_type'+Accid).val(data1.data[0].acctype_code);
                        }

                        if(data1.data_tds == ''){
                          var acctdsrte = '';
                          var NotgetTdsRate = '';
                          var tdssection ='';
                          $('#accNtdsrate'+Accid).val(acctdsrte);
                          $('#TdsRateByAccCode'+Accid).val(NotgetTdsRate);
                           $('#TdsSection'+Accid).val(tdssection);
                        }else{
                          $('#accNtdsrate'+Accid).val(data1.data_tds[0].acc_code);
                          $('#TdsRateByAccCode'+Accid).val(data1.data_tds[0].tds_rate);
                          $('#TdsSection'+Accid).val(data1.data_tds[0].tds_code);
                        }
                        
                        var drAmtIfExist = $('#dr_amount'+Accid).val();
                        var CreditAmtIfExist = $('#cr_amount'+Accid).val();
                        var TdsRateExist = $('#TdsRateByAccCode'+Accid).val();
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

                    }
               }

          });

         var seriesCode  = $('#series_code').val();
          var bankCode    = $('#bankid').val();
          var pay_mode    = $('#vr_type').val();
          //console.log(pay_mode);
          var vr_date     = $('#vr_date').val();
          var profit_code = $('#profitId').val();

          if(seriesCode){
            $('#series_code').prop('readonly',true);
          }
          if(bankCode){
            $('#bankid').prop('readonly',true);
          }
          if(pay_mode=='Payment' || pay_mode=='Receipt'){
            $('#vr_type').prop('disabled',true);
          }
          if(vr_date){
            $('#vr_date').prop('readonly',true);
          }
          if(profit_code){
            $('#profitId').prop('readonly',true);
          }

  }

</script>


<script type="text/javascript">

$(document).ready(function(){

   $("#UpdateData").click(function(event) {

        var data = $("#cahsbanktrans").serialize();
        //  console.log(data);
          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "{{ url('/finance/form-mast-cash-bank-update') }}",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                var url = "{{url('/view-cash-bank-updated-success-msg')}}"

                setTimeout(function(){ window.location = url+'/savedata'; });
              },

          });
           /* Act on the event */


   });

});

</script>
<script type="text/javascript">
  $("#inst_type").change(function(event) {
    var inst_type= $(this).val();
    if(inst_type=='NA'){

      $("#cheque_no").addClass('amntFild');
    }else{

      $("#cheque_no").removeClass('amntFild');
    } 
    //console.log(inst_type);
  });



</script>




@endsection