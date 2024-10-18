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
  .rightcontent{

  text-align:right;


}
.dateWidth{
    width: 154% !important;
  }
  .vrmargin{
    margin-left: 1% !important;
  }
  .tcodemargin{
    margin-left: -3% !important;
  }
  .seriesmargin{
    margin-left: -3% !important;
  }
  .serieswidth{
    width: 146% !important;
  }
  .glwidth{
    width: 156% !important;
  }
  .vrmargin{
    margin-left: 1% !important;
  }
  .pfctmargin{
    margin-left: -3% !important;
  }
  .vrtypemargin{
  margin-left: -3%;
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
.datehide{
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
  margin-top: 42%;
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
  .displyinline{
    display: flex;
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
    margin-bottom: 2%;
  }
  .debitcreditbox{
    margin-top: 42%;
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


            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label>Date: <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <?php 

                        $FromDate= date("d-m-Y", strtotime($fromDate));  
                        $ToDate= date("d-m-Y", strtotime($toDate));  

                        $CurrentDate =date("d-m-Y");

                      ?>
                      <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
                      <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
                      <input type="text" class="form-control  transdatepicker rightcontent dateWidth" name="vr" id="vr_date" value="{{ $CurrentDate }}" placeholder="Select Date"  autocomplete="off">

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>
                    <!-- /.form-group -->
            </div>

             <div class="col-md-2 vrmargin">

              <div class="form-group">
                
                <label> Vr No: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                    <input type="hidden" name="" value="{{$to_num}}" id="vr_last_num">
                    
                    <input type="text" class="form-control rightcontent" name="vro" value="<?php if($last_num){echo $last_num+1;}else{} ?>" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off" >

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2 tcodemargin">
              
              <div class="form-group">

                  <label> T Code : </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="tran" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

              </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-2 seriesmargin">

              <div class="form-group">

                  <label>Series : 
                    <span class="required-field"></span>
                  </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <?php $getcount = count($getseries); ?>

                      <input list="seriesList"  id="series_code" name="series" class="form-control  pull-left serieswidth" value="<?php if($getcount == 1){echo $getseries[0]->series_code;}else{echo old('series_code');} ?>" placeholder="Select Series"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                      <datalist id="seriesList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($getseries as $key)

                        <option value='<?php echo $key->series_code?>'   data-xyz ="<?php echo $key->series_name; ?>"><?php echo $key->series_name ; echo " [".$key->series_code."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>
                    <small id="serscode_err" style="color: red;" class="form-text text-muted">
                    </small>
                   
                    <small id="series_code_errr" style="color: red;"></small>
                          

              </div>



                    <!-- /.form-group -->
            </div>

            <div class="col-md-4">

              <div class="form-group">

                  <label>Series Name: 
                    <span class="required-field"></span>
                  </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" id="seriesText" name="series_name" class="form-control  pull-left" value="<?php if($getcount == 1){echo $getseries[0]->series_name;}else{} ?>" placeholder="Select Series Name"  data-toggle="tooltip" data-placement="top">

                    </div>
                       

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
                    <span class="input-group-addon" style="padding: 4px 12px;">
                      <i class="fa fa-sort-numeric-asc" id="firsticon"></i>
                      <div class="" id="appndplantbtn"></div>
                    </span>
                    
                    <input type="text" class="form-control glwidth" name="gl" id="gl_code" value="{{ old('gl_code') }}" placeholder="Enter GL Code" disabled="" autocomplete="off">

                </div>

                <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                </small>

              </div>
               <!-- /.form-group -->
            </div>

            <div class="col-md-4" style="margin-left: 1%;">

              <div class="form-group">

                <label> GL Name : <span class="required-field"></span>
                </label>

                <div class="input-group tooltips">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <input type="text" class="form-control" name="gl" value="{{ old('gl_name') }}" id="gl_name" placeholder="Enter GL Name" readonly autocomplete="off">

                    <span class="tooltiptext tooltiphide" id="glNameTooltip"></span>
                </div>

                <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gl_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                </small>

              </div>
                    <!-- /.form-group -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 vrtypemargin">

                <div class="form-group">

                    <label> Vr Type :  <span class="required-field"></span>
                    </label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                         <!--  <input type="text" class="form-control" name="transaction_head" value="{{ old('transaction_head') }}" placeholder="Enter Transaction Head"> -->
                         <select name="vr" id="vr_type" class="form-control" disabled autocomplete="off">
                            <option value="">--Select--</option>
                           <option value="Payment">Payment</option>
                           <option value="Receipt">Receipt</option>
                         </select>

                    </div>

                    <small id="vr_type_err" style="color: red;"></small>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3 pfctmargin">

              <div class="form-group">
                
                <label>Pfct Code: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                      <?php $pfcount = count($pfct_list); ?>
                      <input list="profitList"  id="profitId" name="pfct" class="form-control  pull-left" value="<?php if($pfcount == 1){echo $pfct_list[0]->pfct_code;}else{echo old('pfct_code');} ?>" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" disabled autocomplete="off">

                      <datalist id="profitList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($pfct_list as $key)

                        <option value='<?php echo $key->pfct_code?>'   data-xyz ="<?php echo $key->pfct_name; ?>" ><?php echo $key->pfct_name ; echo " [".$key->pfct_code."]" ; ?></option>

                        @endforeach

                      </datalist>

                  </div>
                  <small>  

                      <div class="pull-left showSeletedName" id="profitText"></div>

                  </small>
                  <small id="profit_center_err" style="color: red;"> </small>

              </div>
                <!-- /.form-group -->
            </div>
           
                <!-- /.col -->

                 <div class="col-md-4">

                <div class="form-group">

                    <label>Pfct Name: <span class="required-field"></span>
                      </label>

                    <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                          <div class="pull-left showSeletedName" id="profit_names"></div>
                          <input type="text" class="form-control" id="profit_name" name="profit" value="<?php if($pfcount == 1){echo $pfct_list[0]->pfct_name; }else{} ?>" placeholder="Enter Profit Center Name" readonly autocomplete="off">

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
                    <td class="tdthtablebordr"  style="width: 13%;padding: 8px 0px 0px 0px;">
                      <small class="glcodeCls">Gl Code</small><br>
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
                    <td class="tdthtablebordr">
                      <div class="input-group">
                      <input list="glCodeNameList1" class="inputboxclr glcodeGets tabnext" style="width: 107px;margin-bottom: 5px;" id='glCodeName1'  name="glCodeName[]" onchange="glcodeNameData(1);" oninput="this.value = this.value.toUpperCase()" readonly />

                        <datalist id="glCodeNameList1">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($glcodename_list as $key)

                            <option value='<?php echo $key->gl_code?>' data-xyz ="<?php echo $key->gl_name; ?>" ><?php echo $key->gl_name ; echo " [".$key->gl_code."]" ; ?></option>

                            @endforeach

                          </datalist>
                      </div>
                      <div class="displyinline">
                      <div class="input-group">
                      <input list="AccList1" class="inputboxclr getacccode tabnext" style="width: 89px;margin-bottom: 5px;" id='acc_code1'  name="acc_code[]" onkeyup='GetAccountCode(1)' onchange="AccListData(1);showpaymentAdvice(1)" oninput="this.value = this.value.toUpperCase()" />

                        <datalist id="AccList1">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($help_account_list as $key)

                            <option value='<?php echo $key->acc_code?>' data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>

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
                      <input list="InstTypeList1" id="inst_type1" class="instTypeMode getinstrument tabnext"  name="instrument_type[]" placeholder="Select I 
                      Type" onchange="changedate(1)">

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
                            <option value='NA' data-xyz ="Not Applicable">Not Applicable[NA]</option>     

                          </datalist><br>
                      <input type='text' class="inputboxclr onchenkno tabnext" style="width: 63px;margin-bottom: 4px;" id='cheque_no'  name="instrument_no[]" oninput='getdicbypay();' placeholder="Number" />
                      </div>
                      <div class="input-group datehide" id="showdate1">
                       
                        <input type="text" name="chquedate[]" id="chquedate1" value="" class="form_date" placeholder="select date" style="width: 110px;">
                        <i class="fa fa-calendar form-control-feedback" style="line-height: 26px;"></i>
                      </div>

                      <div class="input-group">

                        <input list="bankList1"  id="bankid1" name="bank_code[]" class="inputboxclr bankshowwhenrecpt" value="{{ old('bank_code')}}" style="width: 107px;margin-bottom: 5px;" placeholder="Enter Bank" onchange="banklistget(1)" oninput="this.value = this.value.toUpperCase()">

                        <datalist id="bankList1">

                          <option selected="selected" value="">-- Select --</option>

                          @foreach ($bank_list as $key)

                          <option value='<?php echo $key->bank_code?>'   data-xyz ="<?php echo $key->bank_name; ?>" ><?php echo $key->bank_name ; echo " [".$key->bank_code."]" ; ?></option>

                          @endforeach

                        </datalist>

                      </div>
                      <small id="bank_name_err" style="color: red;"></small>
                      <small>  

                          <div class="pull-left showSeletedName" id="bankText1"></div>

                      </small>
                    </td>
                    <td class="tdthtablebordr">
                      <div class="row">
                      <input type="text" class="inputboxclr getglCNAme" style="width: 250px;margin-bottom: 5px;" id='genrl_name1' name="genrl_name[]" readonly />
                      </div>
                      <div class="tooltips">
                      <input type="text" class="inputboxclr getAccNAme" style="width: 250px;margin-bottom: 5px;" id='acc_name1' name="acc_name[]" readonly />

                      <span class="tooltiptextitem tooltiphide" id="itemNameTooltip1" style="bottom: 73%;"></span>
                      </div>
                      <div class="row">
                      <input type="text" class="textdesciptn discription forperticulr"  name="particular[]" id="discription" readonly>
                       </div>
                       <div class="row">
                      <textarea  rows="1" type="text" style="width: 250px;" name="ref_text[]" id="ref1"  class="tabnext"></textarea>
                       </div>
                       <div class="row">
                      <input type="text" id="ShowBankName1" style="width: 250px;margin-bottom: 2%;" class="bankNameGet" readonly>
                    </div>
                    </td>
                    <td class="tdthtablebordr"><input type='text' class="debitcreditbox dr_amount inputboxclr tabnext"  id='dr_amount1' name="dr_amount[]"  onkeypress='NumberCredit()' oninput='GetDebitAmount(1)'/>
                      <input type="hidden" id="totalnetGetamt1">
                    <input type="hidden" id="resultofdebit1" name="DebitdsAmt[]">
                    <input type="hidden" id="Applytdsonamt1" name="TdsDebitAmount[]">
                    <input type="hidden" id="WhenTdsCutDebit1" name="base_amt_Debit[]">
                    </td>
                    <td class="tdthtablebordr"><input type='text' class="debitcreditbox inputboxclr cr_amount tabnext" id='cr_amount1' name="cr_amount[]"  onkeypress='NumberCredit()' oninput='GetCreditAmount(1)'/>
                    <input type="hidden" id="resultofcredit1" name="CredittdsAmt[]">
                    <input type="hidden" id="Applytdsonamtforcr1" name="TdsCreditAmount[]">
                    <input type="hidden" id="WhenTdsCutCredit1" name="base_amt_Credit[]">
                    <input type="hidden" id="base_amount1" name="base_amount[]">
                     </td>
                  </tr>
                </table>
              </div>
              <div>
              <div class="row" style="display: flex;">
                  <div class="col-md-4"></div>
                  <div class="col-md-4 toalvaldesn"><div class="totlsetinres">Total :</div></div>
                  <div class="col-md-1"><input class="debitotldesn inputboxclr" type="text" name="TotlDebit" id="totldramt" readonly></div>
                  <div class="col-md-1"></div>
                  <div class="col-md-1"><input class="credittotldesn inputboxclr" type="text" name="TotalCredit"  id="totlcramt" readonly></div>
                  <div class="col-md-1"></div>
              </div>
              <div id="showgreatermsg" style="text-align: end;color: red;"></div>
              <input type="hidden" name="series_code" id="hidnseried"> 
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
              </div>
              <div class="row" style="margin-left: 0px;">
              <button type="button" class='btn btn-info delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>
              <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
            </div>
              <!-- <p class="text-center"> <input type='submit' name='submit' value='submit' id="submitdata" class='btn but' disabled /></p>--> 
              <div class="row">
              <p class="text-center">
                <button class="btn btn-primary " type="button" id="simulationbtn" disabled><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp;&nbsp; Simulation</button> 

                <button class="btn btn-success" type="button" id="submitdata" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>
                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>
              </p>
            </div>



              <!-- model -->
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
<!-- model -->


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
            <div class="attribute"><input type="text" id="drsim_total"></div>
          </div>

          <div class="attribute-container freight">
            <div class="attribute"><input type="text" id="crsim_total"></div>
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


 <!-- payment advice model -->
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
<!-- payment advice model -->

<!-- show modal when click on view btn after  select glcode -->

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

      <!-- show modal when click on view btn after item select plantcode -->


      <!-- show modal when click on view account btn after  select acccode -->

        <div class="modal fade" id="accCd_detail1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <div class="box10 texIndbox1">Acc Name/Acc Code</div>
                   
                    <div class="box10 rateIndbox">Acc Type Code </div>
                    <div class="box10 rateIndbox">Address1</div>
                    <div class="box10 rateBox">Address2</div>
                    <div class="box10 rateBox">Address3</div>
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
                      <span id="Addres2show1"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="Addres3show1"> </span>
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

      <!--  show modal when click on view account btn after  select acccode-->




@include('admin.include.footer')


<script src="{{ URL::asset('public/dist/js/viewjs/cash_bank_trans.js') }}" ></script>


<script type="text/javascript">
  function changedate(datevalue){

    var insttype = $("#inst_type"+datevalue).val();

    
    if(insttype=='CH'){

      $("#showdate"+datevalue).removeClass('datehide');

    }else{
      $("#showdate"+datevalue).addClass('datehide')
    }

  }
</script>

<script type="text/javascript">

  function showpaymentAdvice(payId){
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
                     //console.log(data);

                      var obj = JSON.parse(data);

                      if(obj.response=='success'){

                         $("#payAdviceTable"+payId).empty();

                        var paymntHead = "<li class='item item-containerPay' style='border-top: 1px solid;background-color: antiquewhite;'><div class='attribute' data-name='#' style='border-left: 1px solid gray;'>Sr.No.</div><div class='attribute-container part-information'><div class='attribute-container part-id'><div class='attribute' data-name='Part Number'>Vr Date</div></div></div><div class='attribute-container cost'><div class='attribute'>Vr No</div></div><div class='attribute-container cost'><div class='attribute'>T Code</div></div><div class='attribute-container freight'><div class='attribute'>Advice Amt</div></div><div class='attribute-container freight'><div class='attribute'>Net Pay</div></div></li>";

                        $("#payAdviceTable"+payId).append(paymntHead);

                        var sr_no =1;
                       $.each(obj.data,function(key,value){
                           
                         var splitDate =value.vr_date.split('-');
                         var getvrDate = splitDate[2]+'-'+splitDate[1]+'-'+splitDate[0];

                           if(value.pmt_trans_code){
                            var classname = 'hideshow_li';
                          }else{
                            var classname = '';
                          }

                          var paymnt = "<li class='item item-containerPay "+classname+"' id='hideShow_"+payId+"_"+sr_no+"'><div class='attribute' data-name='#' style='border-left: 1px solid gray;'>"+sr_no+"<input type='checkbox' name='allcheck[]' class='checkRowSub' id='checkboxid_"+payId+"_"+sr_no+"' value="+sr_no+" onclick='setOnOff("+payId+","+sr_no+")' style='margin-left: 5px;'></div><div class='attribute-container part-information'><div class='attribute-container part-id'><div class='attribute rightcontent' data-name='Part Number'>"+getvrDate+"<input type='hidden' value="+value.acc_code+" name='pay_acc_code' id='pay_acc_code'></div></div></div><div class='attribute-container cost'><div class='attribute rightcontent'>"+value.vr_no+"<input type='hidden' value="+value.vr_no+"name='pay_vr_no' id='pay_vr_no'></div></div><div class='attribute-container cost'><div class='attribute'>"+value.trans_code+"</div></div><div class='attribute-container freight'><div class='attribute rightcontent'>"+value.advice_amt+"<input type='hidden' value="+value.advice_amt+" name='pay_advice_amt' id='pay_advice_amt_"+payId+"_"+sr_no+"'></div></div><div class='attribute-container freight'><div class='attribute rightcontent'>"+value.net_amt+"<input type='hidden' value="+value.pay_flag+" name='pay_flag' id='pay_flag'><input type='hidden' value="+value.net_amt+" id='netPayAmt_"+payId+"_"+sr_no+"'><input type='hidden' value='off' name='onoffcheck' id='onOff_"+payId+"_"+sr_no+"' ><input type='hidden' value="+value.pmt_trans_code+"  id='pmtTCode_"+payId+"_"+sr_no+"' ><input type='hidden' value="+value.pmt_series+"  id='pmtSeries_"+payId+"_"+sr_no+"' ><input type='hidden' value="+value.pmt_vrno+"  id='pmtvrno_"+payId+"_"+sr_no+"' ></div></div></li>";
                        
                             
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

  function getadvicePay(checkid){
  		//console.log('ok');

  		var paymentid =[];

  		$(".checkRowSub").each(function (){
                
                if($(this).is(":checked")){

                  paymentid.push($(this).val());
                }
        });
  		var gettotalnetamt=0;

       for(var i=0;i<paymentid.length;i++){
       		
       		var netAmt = $('#pay_advice_amt_'+checkid+'_'+paymentid[i]).val();
       		var gettotalnetamt = gettotalnetamt + parseFloat(netAmt);
       		
          $('#totalnetGetamt'+checkid).val(gettotalnetamt.toFixed(2));

          var showindr = $('#totalnetGetamt'+checkid).val();

          if(showindr){

            $('#dr_amount'+checkid).val(showindr);
            $('#submitdata').prop('disabled',false);
            $('#simulationbtn').prop('disabled',false);
            $('#addmorhidn').prop('disabled',false);
            $('#deletehidn').prop('disabled',false);
          }else{
            $('#submitdata').prop('disabled',true);
            $('#simulationbtn').prop('disabled',true);
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
</script>

<script type="text/javascript">



$(document).ready(function() {


  $('body').on('focus',".form_date", function(){
    $(this).datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            todayHighlight: 'true',
            autoclose: 'true'

      });
  });


$("#series_code").change(function(){

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });


        var series_code =  $(this).val();
            
            if(series_code != ''){

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
                            var glcodeb = '';
                            var glnameb = '';
                            $('#hidnglcode').val(glcodeb);
                            $('#hidnglnme').val(glnameb);
                            $('#glNameTooltip').addClass('tooltiphide');
                          }else{
                            $("#gl_code").val(data1.gl_data.gl_code);

                            $("#gl_name").val(data1.gl_data.gl_name);
                            $('#glNameTooltip').removeClass('tooltiphide');

                            $('#glNameTooltip').html(data1.gl_data.gl_name);
                            var glcodeh = $('#gl_code').val();
                            var glnameh = $('#gl_name').val();

                            if(glcodeh){
                              $('#firsticon').css('display','none');
                              $('#appndplantbtn').html('<button type="button" data-toggle="modal" data-target="#gl_detail" onclick="getgldata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
                            }else{
                            }

                            $('#hidnglcode').val(glcodeh);
                            $('#hidnglnme').val(glnameh);
                          }  



                      }
                   }

              });

            }else{
              $("#gl_code").val('');
              $("#gl_name").val('');
              $("#vr_type").val('');
              $("#vr_date").val('');
              $("#profitId").val('');
              $("#profitText").html('');
              $("#profit_name").val('');
              $( "#vr_date" ).prop( "disabled", true );
              $( "#profitId" ).prop( "disabled", true );
              $( "#profit_name" ).prop( "disabled", true );
          }

      });
});


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
                        console.log('data1.data',data1.gl_data.glsch_code);
                        $('#glschcshow').html(data1.gl_data.glsch_code);
                        $('#glcdshow').html(data1.gl_data.gl_code);
                        $('#glnshow').html(data1.gl_data.gl_name);
                        $('#gltypeshow').html(data1.gl_data.glsch_type);


                      }

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

              url:"{{ url('get-acc-data-by-acc-code') }}",

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
                        $('#accNameCodeshow'+accd).html(data1.data[0].acc_code);
                        $('#AcctypCde'+accd).html(data1.data[0].acctype_code);
                        $('#Addres1show'+accd).html(data1.data[0].address1);
                        $('#Addres2show'+accd).html(data1.data[0].address2);
                        $('#Addres3show'+accd).html(data1.data[0].address3);
                        $('#cityacshow'+accd).html(data1.data[0].city);
                        $('#stateacshow'+accd).html(data1.data[0].state);
                        $('#emailacshow'+accd).html(data1.data[0].email);
                        $('#phonenoacshow'+accd).html(data1.data[0].phone1);


                      }

                  }
              }
    });

}
</script>
<script type="text/javascript">

$(document).ready(function() {
  var n = 1; 
  var i=1;
$('.tabnext').each(function() { 
 // $('#acc_name'+i).prop('tabIndex', -1);           
 // $('#discription'+i).prop('tabIndex', -1);           
    $(this).attr('tabindex', n++);
});

});
</script>


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

});
</script>

<script type="text/javascript">
  
  $(document).ready(function() {

    

  });
</script>


<script type="text/javascript">
  $(document).ready(function(){

    $( window ).on( "load", function() {

     var vrseqno = $('#vrseqnum').val();
     var vrlastnum = $('#vr_last_num').val();

     $("#acc_code1").prop('readonly',true);
     $("#inst_type").prop('readonly',true);
     $("#cheque_no").prop('readonly',true);
     $("#ref").prop('readonly',true);
     $("#dr_amount1").prop('readonly',true);
     $("#cr_amount1").prop('readonly',true);
    // console.log(vrseqno,'',vrlastnum);

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
    $('.case:checkbox:checked').parents("tr").remove();
    $('.check_all').prop("checked", false); 


    var sum = 0;
//dr amount
      $(".dr_amount").each(function () {

        //add only if the value is number
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
var i=2;
$(".addmore").on('click',function(){

  var vrType =  $('#vr_type').val();

    if(vrType == 'Payment'){
      var getpaymode = 'To -';
    }else if(vrType == 'Receipt'){
     var getpaymode='By -';
    }

    count=$('table tr').length;
    var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/><span id='snum"+i+"'>"+count+".</span></td><td class='tdthtablebordr' style='width: 58%;padding: 8px 0px 0px 0px;'><small class='glcodeCls'>Gl Code</small><br><small class='accCodeCls'>Account Code</small><br><label for='' class='instrumentlbl'>I Type</label><br><button type='button' class='btn btn-primary btn-xs tdsratebtn tdsratebtnHide' id='tds_rate"+i+"' data-toggle='modal' data-target='#tds_rate_model"+i+"' onclick='CalculateTdsRate("+i+")' disabled>Calc TDS</button><div id='appliedbtn"+i+"'></div><div id='canclebtn"+i+"'></div><input type='hidden' id='tdsByAccCode"+i+"' value='' name='tdsCodeByAc[]'> <input  type='hidden' name='tds_rate[]' id='TdsRateByAccCode"+i+"' class='getRateForAcc'><input type='hidden' name='tds_code[]' id='TdsSection"+i+"'><input type='hidden' name='' id='accNtdsrate"+i+"'><input type='hidden' id='ledgrAmt"+i+"' name='ledgrAmt[]'></td>";
    data +="<td class='tdthtablebordr'><div class='input-group'><input list='glCodeNameList"+i+"' class='inputboxclr glcodeGets tabnext' style='width: 107px;margin-bottom: 5px;' id='glCodeName"+i+"'  name='glCodeName[]' onchange='glcodeNameData("+i+");' oninput='this.value = this.value.toUpperCase()' /><datalist id='glCodeNameList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($glcodename_list as $key)<option value='<?php echo $key->gl_code?>' data-xyz ='<?php echo $key->gl_name; ?>' ><?php echo $key->gl_name ; echo ' ['.$key->gl_code.']' ; ?></option> @endforeach </datalist></div><div class='displyinline'><div class='input-group'><input list='AccList"+i+"' class='inputboxclr getacccode ' tabindex='"+i+"' style='width: 89px;margin-bottom: 5px;' id='acc_code"+i+"' name='acc_code[]' onkeyup='GetAccountCode("+i+")'  onchange='AccListData("+i+")' oninput='this.value = this.value.toUpperCase()'/><datalist id='AccList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($help_account_list as $key)<option value='<?php echo $key->acc_code?>' data-xyz ='<?php echo $key->acc_name; ?>' ><?php echo $key->acc_name ; echo ' ['.$key->acc_code.']' ; ?></option>@endforeach</datalist></div><div class='' id='appndplantbtn'><button type='button' data-toggle='modal' data-target='#accCd_detail"+i+"' onclick='getAccDetail("+i+")' id='accbtn"+i+"' disabled class='btn btn-xs btn-info gly-radius' data-original-title='' title='' style='padding: 0px 5px 0px 5px;'> <i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i></button></div></div><input type='hidden' id='acc_class"+i+"' name='accClass[]'><input type='hidden' id='acc_type"+i+"' name='accType[]'><input type='hidden' name='gltdscode[]' id='GettdsCode"+i+"'><input type='hidden' name='gltdsname[]' id='GettdsName"+i+"'><input list='InstTypeList"+i+"'  id='inst_type"+i+"' class='instTypeMode getinstrument' tabindex='"+i+"' name='instrument_type[]' style='width:43px;' onchange='changedate("+i+")' placeholder='Select Transporter' onchange='ITypeChng("+i+")'><datalist id='InstTypeList"+i+"'><option selected='selected' value=''>-- Select --</option><option value='CH' data-xyz ='Cheque'>Cheque[CH]</option><option value='DD' data-xyz ='Demand Draft'>Demand Draft[DD]</option><option value='TR' data-xyz ='Transfer receipt'>Transfer receipt[TR]</option><option value='TT' data-xyz ='Tele Transfer'>Tele Transfer[TT]</option><option value='MT' data-xyz ='Money Transfer'>Money Transfer[MT]</option><option value='RT' data-xyz ='RTGS'>RTGS[RT]</option><option value='BA' data-xyz ='Bank Advise'>Bank Advise[BA]</option><option value='EC' data-xyz ='Electronic Clearence'>Electronic Clearence[EC]</option><option value='NA' data-xyz ='Not Applicable'>Not Applicable[NA]</option></datalist><input type='text' class='inputboxclr' tabindex='"+i+"' style='width: 66px;margin-bottom: 4px;' id='cheque_no"+i+"' name='instrument_no[]' placeholder='Number' oninput='GetChkNo("+i+");'/><div class='input-group datehide' id='showdate"+i+"'><input type='text' name='chquedate[]' id='chquedate"+i+"' class='form_date' placeholder='select date' style='width: 110px;'><i class='fa fa-calendar form-control-feedback' style='line-height: 26px;'></i></div><div class='input-group'><input list='bankList"+i+"'  id='bankid"+i+"' name='bank_code[]' class='inputboxclr bankshowwhenrecpt' style='width: 107px;margin-bottom: 5px;display: inline-block;' placeholder='Enter Bank' onchange='banklistget("+i+")' oninput='this.value = this.value.toUpperCase()'><datalist id='bankList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($bank_list as $key)<option value='<?php echo $key->bank_code?>'   data-xyz ='<?php echo $key->bank_name; ?>' ><?php echo $key->bank_name ; echo ' ['.$key->bank_code.']' ; ?></option>@endforeach</datalist></div><small id='bank_name_err"+i+"' style='color: red;'></small><small><div class='pull-left showSeletedName' id='bankText"+i+"'></div></small></td> <td class='tdthtablebordr'><div class='row'><input type='text' class='inputboxclr getglCNAme' style='width: 250px;margin-bottom: 5px;' id='genrl_name"+i+"' name='genrl_name[]' readonly /></div><div class='row'><input type='text' class='inputboxclr getAccNAme' style='width: 250px;margin-bottom: 5px;' id='acc_name"+i+"' name='acc_name[]'/></div><div class='row'><input type='text' class='textdesciptn discription forperticulr' name='particular[]' id='discription"+i+"'  value="+getpaymode+" readonly></div><div class='row'><textarea  rows='1' style='width: 250px;' name='ref_text[]' tabindex='"+i+"' id='ref"+i+"'> </textarea></div><div class='row'><input type='text' id='ShowBankName"+i+"' style='width: 250px;margin-bottom: 2%;' class='bankNameGet' readonly></div></td><td class='tdthtablebordr'><input type='text' class='debitcreditbox dr_amount inputboxclr' tabindex='"+i+"'  id='dr_amount"+i+"' name='dr_amount[]' onkeypress='NumberCredit()' oninput='GetDebitAmount("+i+")'/><input type='hidden' id='resultofdebit"+i+"' name='DebitdsAmt[]'><input type='hidden' id='Applytdsonamt"+i+"' name='TdsDebitAmount[]'><input type='hidden' id='WhenTdsCutDebit"+i+"' name='base_amt_Debit[]'></td><td class='tdthtablebordr'><input type='text' class='debitcreditbox cr_amount inputboxclr' tabindex='"+i+"'  id='cr_amount"+i+"' name='cr_amount[]' onkeypress='NumberCredit()' oninput='GetCreditAmount("+i+")'/><input type='hidden' id='resultofcredit"+i+"' name='CredittdsAmt[]'><input type='hidden' id='Applytdsonamtforcr"+i+"' name='TdsCreditAmount[]'><input type='hidden' id='WhenTdsCutCredit"+i+"' name='base_amt_Credit[]'><input type='hidden' id='base_amount"+i+"' name='base_amount[]'><div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' data-keyboard='false' data-backdrop='static'><div class='modal-dialog modal-sm' role='document' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Calculate TDS</h5></div><div class='modal-body'><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Section</label></div><div class='col-md-4'><input type='text' id='tds_name"+i+"' name='tds_section[]' value='' readonly></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Rate</label></div><div class='col-md-4'><input type='text' id='tdsRate"+i+"' readonly style='text-align: right;'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Base Amount</label> </div><div class='col-md-4'><input type='text' id='Net_amount"+i+"' readonly style='text-align: right;'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Amount calculate </label></div><div class='col-md-4'><input type='text' id='tds_Amt_cal"+i+"' readonly style='text-align: right;'></div> <div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Net Amount</label></div><div class='col-md-4'><input type='hidden' id='tds_base_Amt"+i+"' value='' name='baseTDSAmt[]' oninput='changetdsamt("+i+")'><input type='text' id='deduct_tds_Amt"+i+"' readonly name='base_amt_tds[]' style='text-align: right;'></div><div class='col-md-2'></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' style='width: 27%;'data-dismiss='modal' id='ApplyTds"+i+"' onclick='Applytds("+i+")'>Apply TDS</button><button type='button' class='btn btn-warning' style='width: 20%;' data-dismiss='modal' onclick='cancleBtntds("+i+")'>Cancle</button></div></div></div></div><div class='modal fade' id='accCd_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Gl Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Acc Name/Acc Code</div><div class='box10 rateIndbox'>Acc Type Code </div><div class='box10 rateIndbox'>Address1</div><div class='box10 rateBox'>Address2</div><div class='box10 rateBox'>Address3</div><div class='box10 rateBox'>city</div><div class='box10 rateBox'>state</div><div class='box10 rateBox'>Email</div><div class='box10 rateBox'>Phone No</div></div><div class='box-row'><div class='box10 itmdetlheading'><span id='accNameCodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='AcctypCde"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='Addres1show"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='Addres2show"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='Addres3show"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='cityacshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='stateacshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='emailacshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='phonenoacshow"+i+"'> </span></div></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div></div></div></div></td></tr>";
    $('table').append(data);
    i++;

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

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){
                     // console.log('data1.data[0]',data1.data[0]);
                        $('#tds_name'+TdsId).val(data1.tds_name[0].tds_code+' - '+data1.tds_name[0].tds_name);
                        $('#tdsRate'+TdsId).val(data1.data[0].tds_rate);
                        $('#TdsRateByAccCode'+TdsId).val(data1.data[0].tds_rate);
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
  

   //console.log(cutamtfrmamt);

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

                     // console.log(data1.data);

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
  function cancleBtntds(canclbtn){
    $('#appliedbtn'+canclbtn).html('');
      $('#canclebtn'+canclbtn).html('<small class="label label-danger"><i class="fa fa-times"></i>&nbsp;Not Applied</small>');
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

      //console.log('hi');

   
       // console.log(accountcode);

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

                          $('#itemNameTooltip'+Accid).html(data1.data[0].acc_name); 
                          $('#tdsByAccCode'+Accid).val(data1.data[0].tds_code);
                          $('#acc_name'+Accid).val(data1.data[0].acc_name);
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



        

  }







   
     
 
</script>



<script type="text/javascript">


function payAdviceSave(trans_code='',series_code='',vrno='',paymentid='',payflag='',payaccCode='',payadviceAmt='',onoff=''){
  console.log('onoff',onoff);
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
                  console.log(data);
                 
                  var obj = JSON.parse(data);
                  //console.log(obj);
               }

               });
}


$(document).ready(function(){

   $("#submitdata").click(function(event) {

    var serscode = $("#series_code").val();
    var bankName = $("#bankid").val();
    var vrDate   = $("#vr_date").val();
    var profitcentr   = $("#profitId").val();
  //  console.log(vrType);
    $("#serscode_err").html('');
    $('#bank_name_err').html('');
    if(serscode==''){

     $("#serscode_err").html('The series code field is required.').css('color','red')
      $("#series_code").focus();
     return false;
    }else if(bankName == ''){
      $("#bank_name_err").html('The bank name field id required');
      $("#bankid").focus();
       return false;
    }else if($("#vr_type option:selected").val()==''){
      $('#vr_type_err').html('The vr type field is required');
      $("#vr_type").focus();
      return false;
    }else if(vrDate==''){
      $('#showmsgfordate').html('The vr date field is required');
      $("#vr_date").focus();
      return false;
    }else if(profitcentr == ''){
      $('#profit_center_err').html('The profit center is required');
      $("#profitId").focus();
      return false;
    }

      var trans_code  = $("#hidntranscd").val();
      var series_code = $("#hidnseried").val();
      var vrno        = $("#vrseqnum").val();
     // var series_code = $("#hidnseried").val();
      var paymentid    = [];
      var payflag      = [];
      var payaccCode   = [];
      var payadviceAmt = [];
      var payvrNo      = [];
      var onoff   = [];
      $(".checkRowSub").each(function (){
                
                if($(this).is(":checked")){

                  paymentid.push($(this).val());
                }


            });

      $('input[name^="pay_flag"]').each(function (){
                
                payflag.push($(this).val());

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
   //  console.log('onoff ',onoff);
              
              payAdviceSave(trans_code,series_code,vrno,paymentid,payflag,payaccCode,payadviceAmt,onoff);

              $.ajax({

                  type: 'POST',

                  url: "{{ url('/save-cash-bank-transaction') }}",

                  data: data, // here $(this) refers to the ajax object not form

                  success: function (data) {
                    console.log(data);

                    var url = "{{url('/view-cash-bank-success-msg')}}"

                    setTimeout(function(){ window.location = url+'/savedata'; });
                  },

              });
               /* Act on the event */

              // $("#series_code").prop('disabled',true);

   });

});

</script>

<!-- <script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});
</script> -->

@endsection