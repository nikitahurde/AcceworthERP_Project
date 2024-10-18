@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #c2d9ff;
  }
  .box-header>.box-tools {
    position: absolute !important;
    right: 10px !important;
    top: 2px !important;
  }
  .hsdiv{
    display: none;
  }
  .noDataF{
    color: #f65371;
  }
  .required-field::before {
    content: "*";
    color: red;
  }
  .showAccName{
    border: none;
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
  }
  .crBal{
    display:none;
  }
  .particuwidth{
    width:500px;
  }
  .defualtSearchNew{
    display: none;
  }
  .rightcontent{
    text-align:right;
  }
  ::placeholder {
    text-align:left;
  }
  .showSeletedName {
    font-size: 12px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .aligncenterClass{
    text-align: center;
  }
  .showhideGl{
    display: none;
  }
  .hideAccc{
    display: none;
  }
  .showhideaccC{
    display: none;
  }
  .showthforaccgl{
    display: none;
  }
  [data-tip] {
    position:relative;
  }
  [data-tip]:before {
    content:'';
    /* hides the tooltip when not hovered */
    display:none;
    content:'';
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-bottom: 5px solid #1a1a1a; 
    position:absolute;
    top:12px;
    left:35px;
    z-index:8;
    font-size:0;
    line-height:0;
    width:0;
    height:0;
  }
  [data-tip]:after {
    display:none;
    content:attr(data-tip);
    position:absolute;
    top:17px;
    left:0px;
    padding:3px 3px;
    background:#1a1a1a;
    color:#fff;
    z-index:9;
    font-size: 0.75em;
    height:25px;
    line-height:18px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    white-space:nowrap;
    word-wrap:normal;
  }
  [data-tip]:hover:before,
  [data-tip]:hover:after {
    display:block;
  }
  @media only screen and (max-width: 600px) {
  
    .dataTables_filter{
      margin-left: 35%;
    }

    .divScroll{
      overflow-x: scroll;
    }

  }

  .dt-buttons{
    margin-bottom: -30px!important;
    padding-bottom: 35px !important;
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
    padding-bottom: 15px;
    
  }
  .showhideaccC{
    display: none;
  }
  .showhideGl{
    display: none;
  }

  .box-header {
      color: #444;
      display: block;
      padding: 3px;
      position: relative;
  }
  table.dataTable {
      clear: both;
      margin-top: 0px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }
  .hideCol{
    display:none;
  }
  .content {
      min-height: 250px;
      padding: 9px;
      margin-right: auto;
      margin-left: auto;
      padding-left: 15px;
      padding-right: 15px;
  }
  .btnStyle{
    font-size: 12px;
    padding: 3px;
    margin: 2px;
  }

  .widthClassdt{
    width: 7%;
  }
  .widthvrno{
    width: 7%;
  }
  .particuwidth{
    width: 37%;
  }
  .drCrAmtWith{
    width: 10%;
    text-align: right;
  }
  .refWidth{
    width: 14%;
  }
  .balTypeWidth{
    width: 5%;
  }
  .text-center{
    text-align: center !important;
  }
  .balBlock{
    width: 10%;
    text-align:right;
  }
  .refBlock{
    width: 30%;
  }
  .actButtonStyle{
    width: 8%;
    padding: 1px;
    font-size: 12px;
  }
  .subTbleCls{
    display:none;
  }
  .lableDesign{
    font-weight: 800;
    color: #5696bb;
  }

</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      A/c Ledger Report

      <small> Account Ledger Report Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report</a></li>

      <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">List Account Ledger Report </a></li>

    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Account Ledger Report </h2>

      </div><!-- /.box-header -->

      <div class="box-body">

        <form id="myForm">

          @csrf

          <?php date_default_timezone_set('Asia/Kolkata'); ?>
          
          <div class="row">

            <div class="col-md-2">

              <div class="form-group">

                <?php 

                  $CurrentDate   = date("d-m-Y");
                  $FromDate      = date("d-m-Y", strtotime($fromDate));  
                  $ToDate        = date("d-m-Y", strtotime($toDate));  
                  $formCurrentDt = date("Y-m-d", strtotime($CurrentDate));

                  if($formCurrentDt > $toDate){
                    $vrDate =$ToDate;
                  }else{
                    $vrDate =$CurrentDate;
                  }
                ?>

                <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $FromDate }}">
                <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $vrDate }}">
                <label for="exampleInputEmail1">From Date : </label>

                <div class="input-group">
                  <div class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                  </div>
                   <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="<?php echo $FromDate; ?>">

                </div>
                <small id="show_err_from_date" style="color: red;"></small>
                  
              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                  <label for="exampleInputEmail1">To Date: </label>

                  <div class="input-group">
                        <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                        <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Enter To  Date" value="<?php echo $ToDate; ?>">

                  </div>

                  <small id="show_err_to_date" style="color:red;"></small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                  <label for="exampleInputEmail1">Gl Code : </label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                       <input list="gl_codeList" id="glC_code" name="glC_code" class="form-control  pull-left" value="{{ old('glC_code')}}" placeholder="Select Gl Code" autocomplete="off">

                      <datalist id="gl_codeList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($glCode_list as $key)
                      
                        <option value='<?php echo $key->GL_CODE?>'   data-xyz ="<?php echo $key->GL_NAME; ?>" ><?php echo $key->GL_CODE ; echo " [".$key->GL_NAME."]" ; ?></option>

                        @endforeach

                      </datalist>

                  </div>

                  <small>  

                    <div class="pull-left showSeletedName" id="gl_codeText"></div>

                 </small>

                 <small id="show_err_acct_code">
                 </small>

              </div>

            </div><!-- /.col -->

            <!-- /.col -->
            <div class="col-md-2">

              <div class="form-group">

                  <label for="exampleInputEmail1">Account Code : </label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                       <input autocomplete="off" list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Account Code" >

                      <datalist id="accountList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($acc_list as $key)

                          <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                  </div>

                  <small>  

                    <div class="pull-left showSeletedName" id="accountText"></div>

                  </small>

                  <small id="show_err_acct_code">
                  
                  </small>

              </div>

            </div>

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Company Code : </label>

                <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                     <input autocomplete="off" type="text" id="comp_code" name="comp_code" class="form-control  pull-left" value="{{ $company_name}}" placeholder="Select Company Code" >

                </div>

              </div>

            </div>
                
          </div>

          <div class="row">

            <div class="col-md-2">

              <div class="form-group">

                  <label for="exampleInputEmail1">Gl Sch Code : </label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                       <input autocomplete="off" list="glschList" id="glsch_code" name="glsch_code" class="form-control  pull-left" value="{{ old('glsch_code')}}" placeholder="Select Gl Sch" >

                      <datalist id="glschList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($glsch_list as $key)

                          <option value='<?php echo $key->GLSCH_CODE?>'   data-xyz ="<?php echo $key->GLSCH_NAME; ?>" ><?php echo $key->GLSCH_NAME ; echo " [".$key->GLSCH_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                  </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                  <label for="exampleInputEmail1">Cost Code : </label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                       <input autocomplete="off" list="costList" id="cost_code" name="cost_code" class="form-control  pull-left" value="{{ old('cost_code')}}" placeholder="Select Cost" >

                      <datalist id="costList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($cost_list as $key)

                          <option value='<?php echo $key->COST_CODE?>'   data-xyz ="<?php echo $key->COST_NAME; ?>" ><?php echo $key->COST_NAME ; echo " [".$key->COST_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                  </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">
              <div class="" style="margin-top: 11px;">

                  <button type="button" class="btn btn-primary btn-sm" name="searchdata" id="btnsearch" value="btnsearch" onclick="return validation();"><i class="fa fa-search" aria-hidden="true" ></i> &nbsp;&nbsp;Search</button>
                
               <!--  <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 1px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button> -->

              </div>
            </div>
            
          </div>

            <?php 

              date_default_timezone_set('Asia/Kolkata');

              $getCurrDtTim = date('Y-m-d H:i:s');
             
              $getExp = explode(" ",$getCurrDtTim);

              $secExp = explode("-",$getExp[0]);

              $expTime = explode(":",$getExp[1]);

              $getnewDt = $secExp[0].''.$secExp[1].''.$secExp[2].'_'.$expTime[0].''.$expTime[1].''.$expTime[2];

            ?>

            <input type="hidden" id="excelDt" value="{{$getnewDt}}">

          <div class="row">
                  
            <div class="col-md-12">

              <div class="" style="text-align:center;">

                <!-- <button type="button" class="btn btn-success btn-sm actButtonStyle"  id="btntransaction" onclick="return validation();"><i class="fa fa-month" aria-hidden="true"></i> TRANSACTION </button> -->

                <!--  ---NEW BUTTON ---- -->

                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="accGlSchBTN" onclick="subButtonFun('ACCGLSCH')" disabled><i class="fa fa-month" aria-hidden="true"></i> AC/GL SCH </button>
                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="costCenterBTN" onclick="subButtonFun('COSTCENTER')" disabled><i class="fa fa-month" aria-hidden="true"></i> COST CENTER </button>
                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="profitCenterBTN" onclick="subButtonFun('PROFITCENTER')" disabled><i class="fa fa-month" aria-hidden="true"></i> PROFIT CENTER</button>
                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="companyBTN" onclick="subButtonFun('COMPANY')" disabled><i class="fa fa-month" aria-hidden="true"></i> COMPANY</button>
                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="monthlyBTN" onclick="subButtonFun('MONTHLY')" disabled><i class="fa fa-month" aria-hidden="true"></i> MONTHLY</button>
                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="dailtyBTN" onclick="subButtonFun('DAILY')" disabled><i class="fa fa-month" aria-hidden="true"></i> DAILY</button>
                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="tnatureBTN" onclick="subButtonFun('TNATURE')" disabled><i class="fa fa-month" aria-hidden="true"></i> T-NATURE</button>
                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="seriesBTN" onclick="subButtonFun('SERIES')" disabled><i class="fa fa-month" aria-hidden="true"></i> SERIES</button>
                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="revAccBTN" onclick="subButtonFun('REVACC')" disabled><i class="fa fa-month" aria-hidden="true"></i> REV ACC</button>
                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="viewVrBTN" onclick="subButtonFun('VIEWVR')" disabled><i class="fa fa-month" aria-hidden="true"></i> VIEW VR</button>
                
                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="pendingBillsBTN" onclick="subButtonModlFun('PENDINGBILLS')" disabled><i class="fa fa-month" aria-hidden="true"></i> PENDING BILLS</button>
                <button type="button" class="btn btn-success btn-sm actButtonStyle" id="allocDetailBTN" onclick="subButtonModlFun('ALLOCDETAIL')" disabled><i class="fa fa-month" aria-hidden="true"></i> ALLOC DETAIL</button>

                <!--  ---NEW BUTTON ---- -->

                <input type="hidden" id="selRowData">

              </div>

              <!-- <div>
                <button type="button" id="btnpdf"  class="btn btn-danger btn-sm special btnStyle"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF </button>
                <button type="button" id="summarybtnpdf" class="btn btn-danger btn-sm btnStyle" style="display: none;"><i class="fa fa-file-pdf-o" aria-hidden="true" ></i> PDF 
                </button>  
                <button type="button" id="transbtnpdf" class="btn btn-danger btn-sm btnStyle" style="display: none;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF 
                </button>

              </div> -->

            </div>
            
          </div>

          <div style="text-align: center;"><small id="show_err_code" style="color: red;"></small></div>

        </form>

      </div><!-- /.box-body -->

      <div class="box-body divScroll" style="margin-top: -1%;" id="mainDatatable">
         
        <table id="InwardDispatch" class="table table-bordered table-striped table-hover">

          <thead class="theadC">

            <input type="hidden" id="totalDebitAmt" value="">
            <input type="hidden" id="totalCreditAmt" value="">
            <tr>

              <th class="text-center">Sr. No</th>
              <th class="text-center">Account Name/Code</th>
              <th class="text-center">GL Name/Code</th>
              <th class="text-center" style="width: 65px;">Comp</th>
              <th class="text-center" style="width: 65px;">Pfct</th>
              <th class="text-center" style="width: 65px;">Vr Date</th>
              <th class="" style="width: 65%;">Vr No. </th>
              <th class="text-center" style="width: 500px;">Particular </th>
              <th class="text-center" style="text-align: center;width: 100px;">Debit<input type="hidden" value="" id='opDrAmtInput'></th>
              <th class="text-center"style="text-align: center;width: 100px;">Credit<input type="hidden" value="" id="opCrAmtInput"></th>
              <th class="text-center" style="text-align: center;width: 100px;">Balance<input type="hidden" value="" id="opBalAmtHid"><input type="hidden" value="" id="rBalAmtHid"></th>
              <th class="text-center">Bal Type <div id="opBalType"></div></th>
              <th class="text-center">Ref Code</th>
    
            </tr>

          </thead>

          <tbody id="defualtSearch">

          </tbody>

          <tfoot align="right">
            <tr>
              <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
            </tr>
          </tfoot>
  
        </table>

      </div><!-- /.box-body -->

      <div class="box-body divScroll subTbleCls" style="margin-top: -1%;" id="subDatatable">

        <table id="sub_ledgerData" class="table table-bordered table-striped table-hover">

          <thead class="theadC">

            <tr>

              <th class="text-center">Code</th>
              <th class="text-center">Name</th>
              <th class="text-center">Opening</th>
              <th class="text-center">Dr/Cr</th>
              <th class="text-center">Trans Debit</th>
              <th class="text-center">Trans Credit</th>
              <th class="text-center">Closing</th>
              <th class="text-center">Dr/Cr</th>
    
            </tr>

          </thead>

          <tbody id="defualtSearch">

          </tbody>

          <!-- <tfoot>
              <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
          </tfoot> -->

        </table>
        
      </div>
  
      <div class="box-body hsdiv" style="margin-top: 0%;" id="detailsbox">

        <div class="row" style="border: 1px solid #d2d6de;margin: 5px;padding-top:30px;padding-bottom:30px;box-shadow: 0px 0px 8px -3px rgb(0 0 0 / 75%);border-radius: 5px;line-height: 1;">
          <div class="col-md-10">
            <p id="partyBlNo"></p>
          </div>
          <div class="col-md-2">
            <p id="tNature"></p>
          </div>
          <div class="col-md-12">
             <p id="narration"></p>
          </div>
          <div class="col-md-4">
             <p id="accCode"></p>
          </div>
          <div class="col-md-4">
             <p id="glCode"></p>
          </div>
          <div class="col-md-4">
            <p id="rate"></p>
          </div>
          <div class="col-md-4">
            <p id="dr_amt"></p>
          </div>

        </div>

      </div>
           

    </div>

  </section>

</div>

  <div class="modal fade" id="view_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">

    <div class="modal-dialog modal-md" role="document" style="margin-top: 13%;">

      <div class="modal-content" style="border-radius: 5px;">

        <div class="modal-header">
          <center><h5 class="modal-title modltitletext" id="exampleModalLabel" style="font-weight: bold;">Particular</h5></center>
        </div>

        <div class="modal-body">
          <div class="row tdsInputBox">
            <div class="col-md-2">
              <label class="textSizeTdsModl">Bill No</label>    :
              
            </div>
            <div class="col-md-10" style='line-height:1'>
             <span id="bill_no"></span>
            </div>
          </div>

          <div class="row tdsInputBox">
            <div class="col-md-2">
              <label class="textSizeTdsModl">Bill Date</label> :
              
            </div>
            <div class="col-md-10" style='line-height:1'>
             <span id="bill_date"></span>
            </div>
          </div>

          <div class="row tdsInputBox">
            <div class="col-md-2">
              <label class="textSizeTdsModl">Bill Amt</label> :
              
            </div>
            <div class="col-md-10" style='line-height:1'>
              <span id="bill_amt"></span>
            </div>
          </div>
          
        </div>
       
        <span id="errmsg" style="font-size: 12px;margin-left: 31px;"></span>
         
        <div class="modal-footer" style="text-align: center;">
          <button type="button" class="btn btn-primary btn-xs"  style="width:50px;" data-dismiss="modal" id="payment_trem_apply">Ok</button>
        </div>

      </div>

    </div>

  </div>

<!-- Modal HTML -->

    <div id="pendingBillModl" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="text-align: center;padding: 1px;">
                    <h5 class="modal-title" style="font-weight: 800;color: #5696bb;">Pending Bills</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                  <div class="table-responsive" style="height: 300px;">

                    <small id="tbleLable1" class="lableDesign"></small>
                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="bodytbleDrsubdata">

                    </table><!-- /.TABLE -->

                    <small id="tbleLable2" class="lableDesign"></small>
                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="bodytbleCrsubdata">

                    </table><!-- /.TABLE -->
                    
                  </div><!-- /.TABLE-RESPONSIVE -->
                    
                </div>
                <div class="modal-footer" style="text-align:center;padding: 4px;">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal HTML -->


@include('admin.include.footer')


<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>

<script type="text/javascript">
  
 $(document).ready(function(){

  $('#btntransaction').click(function(){

    var from_date  =  $('#from_date').val();
    var to_date    =  $('#to_date').val();
    var acct_code  =  $('#acct_code').val();
    var acct_class =  $('#acct_class').val();
    var acct_type  =  $('#acct_type').val();
    var glsch_code =  $('#glsch_code').val();
    var pfct_code  =  $('#pfct_code').val();
    var comp_code  =  $('#comp_code').val();
    var glC_code   =  $('#glC_code').val();
    var vrno       =  $('#vr_num').val();
    var vrnum = vrno.split(' ');
    var vr_num = vrnum[2];
    var btnsummary =  $('#btnsummary').val();

    //var trans_code =  $('#trans_code').val();
    //alert(from_date);return false;

    if (acct_code!='' || glC_code!='' || vrno!='') {

      $('#show_err_from_date').html('');
      $('#show_err_to_date').html('');
      $('#show_err_dept_code').html('');
      $('#show_err_acct_code').html('');
      $('#show_err_trans').html('');

      if(from_date != ''){

        if(to_date==''){
           $('#show_err_to_date').html('Please select to date');
          return false;
        }

      }

      $('#InwardDispatch').DataTable().destroy();
      $('#InwardDispatch').hide();
      $('#table_id').DataTable().destroy();
      $('#table_id').hide();
      $('#trans_id').DataTable().destroy();
      $('#trans_id').show();
      $('#detailsbox').css('display','none');

      transaction_data(acct_code,acct_class,acct_type,pfct_code,glC_code,comp_code,from_date,to_date,vr_num);

      $("#transbtnpdf").css('display','block');
      $("#btnpdf").css('display','none');
      $("#summarybtnpdf").css('display','none');

      var totalDebitAmt= $('#totalDebitAmt').val();
      var totalCreditAmt =  $('#totalCreditAmt').val();

      $('#totl_dr_val').html(totalDebitAmt);
      $('#totl_cr_val').html(totalCreditAmt);

      if(totalDebitAmt > totalCreditAmt){
        var balenceAmt = totalDebitAmt - totalCreditAmt;
        $('#totl_balence').html(balenceAmt);
        $('#bal_type').html('Dr');
      }else if(totalCreditAmt > totalDebitAmt){
        var balenceAmt = totalCreditAmt - totalDebitAmt;
        $('#totl_balence').html(balenceAmt);
        $('#totl_balence').html('Cr');
      }else{}

    }else{

      $('#trans_id').DataTable().destroy();

      $('#InwardDispatch').DataTable().destroy();
      $('#InwardDispatch').hide();
      $('#table_id').DataTable().destroy();
      $('#table_id').hide();
      $('#trans_id').show();
      transaction_data();
     /*$('#show_err_from_date').html('Please select from date').css('color','red');
    
     $('#show_err_to_date').html('Please select to date').css('color','red');
     $('#show_err_dept_code').html('Please select depot').css('color','red');
     $('#show_err_acct_code').html('Please select account code').css('color','red');
     $('#show_err_trans').html('Please select transporter').css('color','red');*/

    }

  });

});

</script>

<script type="text/javascript">

  $(document).ready(function(){

      $( window ).on( "load", function() {
          $('#totl_dr_val').html(0);
          $('#totl_cr_val').html(0);
      });

      $("#acct_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#accountList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
           $(this).val('');
          document.getElementById("accountText").innerHTML = '';
          $("#glC_code").prop('disabled', false);
        }else{
          document.getElementById("accountText").innerHTML = msg;

          $("#glC_code").prop('disabled', true);
        } 

      });

      $("#acct_class").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#accClassList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
           $(this).val('');
          document.getElementById("accClassText").innerHTML = '';
        }else{
          document.getElementById("accClassText").innerHTML = msg;
        } 

      });

      $("#acct_type").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#acctypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("acctypeText").innerHTML = '';
          }else{
            document.getElementById("acctypeText").innerHTML = msg;
          } 

      });

      $("#glsch_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#glschList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("glschText").innerHTML = '';
          }else{
            document.getElementById("glschText").innerHTML = msg;
          } 

      });

      $("#pfct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#pfct_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("pfct_codeText").innerHTML = '';
          }else{
            document.getElementById("pfct_codeText").innerHTML = msg;
          } 

      });

      $("#comp_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#comp_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("comp_codeText").innerHTML = '';
          }else{
            document.getElementById("comp_codeText").innerHTML = msg;
          } 

      });

      $("#glC_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#gl_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("gl_codeText").innerHTML = '';
            $('#acct_code').prop('readonly',false);
          }else{
            document.getElementById("gl_codeText").innerHTML = msg;
           // $("#acct_code").prop('disabled', true);
            $('#acct_code').prop('readonly',true);
          } 

      });


  });

</script>

<script type="text/javascript">

  $(document).ready(function(){

    load_data();
    $('#table_id').hide();
    $('#trans_id').hide();

    function load_data(acct_code='',acct_class='',acct_type='',pfct_code='',glC_code='',comp_text='',from_date='',to_date='',vr_num='',glsch_code=''){

      var table =  $('#InwardDispatch').DataTable({

      footerCallback: function ( row, data, start, end, display ) {

        var api = this.api(), data;
     
        // converting to interger to find total
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };
     
        var rowcount = data.length;
        var getRow = rowcount-1;
        var opebal = api.column(8).data();
        var baltype = api.column(9).data();

        if(opebal[getRow]){
          var opntotl = opebal[getRow];
        }else{
          var opntotl = 0;
        }

        if(baltype[getRow]){
          var bal_type = baltype[getRow];
        }else{
          var bal_type = '--';
        }

        var drAmt = api
          .column( 8 )
          .data()
          .reduce( function (a, b) {
              return intVal(a) + intVal(b);
          }, 0 );
          
        var crAmt = api
          .column( 9 )
          .data()
          .reduce( function (a, b) {
              return intVal(a) + intVal(b);
        }, 0 );

        var balTotal = parseFloat(drAmt) - parseFloat(crAmt);

        if (balTotal >= 0) {

          var balType = 'Dr';

        }else{

          var balType = 'Cr';

        }

        var totBal = parseFloat(drAmt) - parseFloat(crAmt);

          $( api.column( 7 ).footer() ).html('Total :-').css('text-align','right');
          $( api.column( 8).footer() ).html(parseFloat(drAmt).toFixed(2));
          $( api.column( 9).footer() ).html(parseFloat(crAmt).toFixed(2));
          $( api.column( 10).footer() ).html(balTotal.toFixed(2));
          $( api.column( 11).footer() ).html('<span class="label label-danger">'+balType+'</span>');
                    
        },

        'fnCreatedRow': function (nRow, aData, iDataIndex) {
                
          $(nRow).attr('onclick', "showDetail("+aData['VRNO']+",\"" + aData['TRAN_CODE'] + "\",\""+aData['acc_code']+"\",\""+aData['gl_code']+"\",\""+aData['particular']+"\","+aData['headid']+")"); // or whatever you choose to set as the id
        },
              
        processing: true,
        serverSide: false,
        info: true,
        bPaginate: false,
        scrollY: 300,
       // scrollX: true,
        scroller: true,
        fixedHeader: true,
        order: [[0, 'asc'],[1, 'asc']],
        columnDefs: [
           { orderable: false, targets:0 }
        ],

        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
              
        buttons: [
                  {
                      extend: 'excelHtml5',
                      title: 'ACCOUNT LEDGER '+$("#excelDt").val(),
                      filename: 'ACCOUNT_LEDGER_'+$("#excelDt").val(),
                      "action": newexportaction
                  },
              ],
              
        ajax:{
          url:'{{ url("/report-acc-ledger") }}',
          data: {acct_code:acct_code,acct_class:acct_class,acct_type:acct_type,pfct_code:pfct_code,glC_code:glC_code,comp_text:comp_text,from_date:from_date,to_date:to_date,vr_num:vr_num,glsch_code:glsch_code}
        },

        columns: [

            {
                data:'DT_RowIndex',
                name:'DT_RowIndex',
                className:"crBal"
            },

            {
              render: function (data, type, full, meta) {

                  var acc_code = full['acc_code'];
                  var acc_name = full['acc_name'];

                  var accCdNm = acc_name+' ['+acc_code+'] ';
                
                  return accCdNm;
              },
              className: "crBal"
            },
            {
              render: function (data, type, full, meta) {

                  var acc_code = full['gl_code'];
                  var acc_name = full['gl_name'];

                  var accCdNm = acc_name+' ['+acc_code+'] ';
                
                  return accCdNm;
              },
              className: "crBal"
            },
            {
                data:'comp_code',
                name:'comp_code'
            },
            {
                data:'pfct_code',
                name:'pfct_code'
            },
            {
                data:'VRDATE',
                className: "widthClassdt",
                render: function (data) {
                    var date = new Date(data);
  
                    var month = date.getMonth() + 1;
                    if(data=='0000-00-00'){
                      return '00-00-0000';
                    }else{
                      
                    return date.getDate() + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" +  date.getFullYear();
                    }
                }
            },
            {
                render: function (data, type, full, meta) {


                    var fyCode = full['fy_code'];
                    var splitFy = fyCode.split('-');
                    var startFyYr =splitFy[0];
                    var series_code = full['series_code'];
                    var vr_no = full['VRNO'];
                   
                    if(startFyYr!='' && series_code!=''){

                      if(series_code==null){
                        seriescode='';
                      }else{
                        seriescode=series_code;
                      }
                    return  startFyYr+' '+seriescode + ' ' + vr_no;
                    }else{
                      return vr_no;
                    }
                    
                },
                className: "alignRightClass",
                className:"widthvrno"
            },
           
            { data:'particular',
                render:function(data, type, full, meta){

                 console.log('fulldata',full.particular);

                 var partcular = full.particular;

                  if(partcular =='' || partcular ==null || partcular == 'To - NA :' || partcular == 'By -' || partcular=='To -'){
                    var prticulrdata = ' ';
                    var getdash = ' ';
                     return  prticulrdata;

                  }else{
                    var getdata = partcular.split(',');
                    var prticulrdata =partcular;
                    var getdash = '-';
                    

                     return  prticulrdata + '&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary btn-xs viewbtnitem" data-toggle="modal" data-target="#view_detail" onclick="showparticular(\''+partcular+'\')"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>';
                    
                  }
                 
                 
                },
                className :"particuwidth",
            },
            {
                data:'DrAmt',
                name:'DrAmt',
                className: "drCrAmtWith",
               
            },
            {
                data:'CrAmt',
                name:'CrAmt',
                className: "drCrAmtWith",
            },
            {
                data:'DT_RowIndex',
                render: function (data, type, full, meta){

                  var srNo = full['DT_RowIndex'];

                  if (srNo==1) {

                     var opBalAmt = $('#opBalAmtHid').val();

                     console.log('first dr amt',full['rDrAmt']);
                     console.log('first cr amt',full['rCrAmt']);

                     var opBalAmt = parseFloat(opBalAmt) + parseFloat(full['rDrAmt']) - parseFloat(full['rCrAmt']);

                     $('#rBalAmtHid').val(opBalAmt);


                  }else{

                    var pSrNo = srNo - 1;

                     var opBalAmt1 = $("#rBalAmtHid").val();

                      console.log('prv op bal',opBalAmt1);
                      console.log('prv slno',pSrNo);

                    var opBalAmt = parseFloat(opBalAmt1) + parseFloat(full['rDrAmt']) - parseFloat(full['rCrAmt']);

                    $('#rBalAmtHid').val(opBalAmt);

                  }

                  var retOpBal = opBalAmt.toFixed(2);
                 
                  return  retOpBal+"<input type='hidden' value='"+parseFloat(retOpBal)+"' id='hiddenBalance_"+srNo+"'>";

                },
                className: "drCrAmtWith",
                  
            },
            {
                data:'',
                className: "balTypeWidth",
                render: function (data, type, full, meta){

                     var opBalAmt1 = $("#rBalAmtHid").val();
                     
                     if(opBalAmt1>=0){
                        var balType = 'Dr';

                      }else{
                        var balType = 'Cr';
                      }

                      console.log('bal type',balType);

                      return  balType;
                },
                className: "text-center",
               
            },
            { render: function (data, type, full, meta){

            
                if(full['REF_CODE']){

                  if (full['REF_NAME']) {

                    var refName = full['REF_NAME'];
                    var ref_Name = 'display' && refName.length > 30 ? refName.substr(0, 30) + '…' : refName;
                    return '<span data-tip="'+refName+'">'+ ref_Name+' ( '+full['REF_CODE']+' )</span> ';

                  }

                // return full['REF_CODE']+'-'+full['REF_NAME'];

                }else{

                  return '<span class="label label-danger">Not Found</span>';
                }
                     

            },className:"refWidth"
           },
               
          ]

          });

        getOpningBal();
      }


      function getOpningBal(){

        var accCode = $('#acct_code').val();
        var glCode = $('#glC_code').val();

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

            url: "{{ url('Report/account/show-opening-balence') }}",
            method : "POST",
            type: "JSON",
            data: {accCode: accCode,glCode:glCode},
            success:function(data){
                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
                }else if(data1.response == 'success'){
               
                  if(data1.data_opgBal==''){
                 
                  }else{
                      $('#headingDr').html('Op Dr.');
                      $('#headingCr').html('Op Cr.');
                      $('#headingbal').html('Op Bal.');
                      $('#opDrAmt').html(data1.data_opgBal[0].dramt);
                      $('#opDrAmtInput').val(data1.data_opgBal[0].dramt);
                      $('#opCrAmt').html(data1.data_opgBal[0].CrAmt);
                      $('#opCrAmtInput').val(data1.data_opgBal[0].CrAmt);
                      var topBalAmt = parseFloat(data1.data_opgBal[0].dramt) - parseFloat(data1.data_opgBal[0].CrAmt);
                      console.log('topBalAmt',topBalAmt);
                      if (topBalAmt>=0) {
                        var balTypeTop = 'Dr';
                      }else{
                        var balTypeTop = 'Cr';
                      }
                      $('#opBalAmt').html(topBalAmt);
                      $('#opBalType').html(balTypeTop);
                      $('#opBalAmtHid').val(topBalAmt);
                  }
                }
            }
        });
        
      }

       $('#btnsearch').click(function(){

          var from_date  =  $('#from_date').val();
          var to_date    =  $('#to_date').val();
          var acct_code  =  $('#acct_code').val();
          var acct_class =  $('#acct_class').val();
          var acct_type  =  $('#acct_type').val();
          var glsch_code =  $('#glsch_code').val();
          var pfct_code  =  $('#pfct_code').val();
          var comp_text  =  $('#comp_code').val();
          var glC_code   =  $('#glC_code').val();
          var vrno       =  '';
          var vr_num     =  '';
          var btnsearch  =  $('#btnsearch').val();
          var cost_code  =  $('#cost_code').val();
          var splitComp = comp_text.split('-');
          var compCode  = splitComp[0];

          if(glsch_code !=''){

            $('#subDatatable').removeClass('subTbleCls');
            $('#mainDatatable').hide();
            load_subdata(from_date,to_date,acct_code,glC_code,compCode,glsch_code,cost_code,'');
          }else if (acct_code!=''  || glC_code!='' || vrno!='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date != ''){

              if(to_date==''){
                 $('#show_err_to_date').html('Please select to date');
                return false;
              }
            }

            //$('#InwardDispatch').show();
            $('#InwardDispatch').DataTable().destroy();
            $('#InwardDispatch').show();
            $('#table_id').DataTable().destroy();
            $('#table_id').hide();
            $('#trans_id').DataTable().destroy();
            $('#trans_id').hide();
           
            load_data(acct_code,acct_class,acct_type,pfct_code,glC_code,comp_text,from_date,to_date,vr_num,glsch_code);
            //$('.actButtonStyle').prop('disabled',false);
            $('#from_date,#to_date,#glC_code,#acct_code,#comp_code,#glsch_code,#cost_code').prop('readonly',true);
            if(glC_code){
              /*$('#accGlSchBTN,#costCenterBTN,#profitCenterBTN,#companyBTN,#monthlyBTN,#dailtyBTN,#tnatureBTN,#seriesBTN,#revAccBTN,#viewVrBTN,#pendingBillsBTN,#allocDetailBTN').prop('disabled',false);*/
              $('#accGlSchBTN,#costCenterBTN,#profitCenterBTN,#companyBTN,#monthlyBTN,#dailtyBTN,#tnatureBTN,#seriesBTN,#revAccBTN,#viewVrBTN,#pendingBillsBTN').prop('disabled',false);
            }else if(acct_code){
              $('#accGlSchBTN').prop('disabled',true);
              /*$('#costCenterBTN,#profitCenterBTN,#companyBTN,#monthlyBTN,#dailtyBTN,#tnatureBTN,#seriesBTN,#revAccBTN,#viewVrBTN,#pendingBillsBTN,#allocDetailBTN').prop('disabled',false);*/
              $('#costCenterBTN,#profitCenterBTN,#companyBTN,#monthlyBTN,#dailtyBTN,#tnatureBTN,#seriesBTN,#revAccBTN,#viewVrBTN,#pendingBillsBTN').prop('disabled',false);
            }

            $('.special').attr('id', 'btnpdf');

            $("#transbtnpdf").css('display','none');
            $("#btnpdf").css('display','block');
            $("#summarybtnpdf").css('display','none');

            var totalDebitAmt= $('#totalDebitAmt').val();
            var totalCreditAmt =  $('#totalCreditAmt').val();

            $('#totl_dr_val').html(totalDebitAmt);
            $('#totl_cr_val').html(totalCreditAmt);

           if(totalDebitAmt > totalCreditAmt){
            var balenceAmt = totalDebitAmt - totalCreditAmt;
            console.log('balenceAmt',balenceAmt);
            $('#totl_balence').html(balenceAmt);
            $('#bal_type').html('Dr');
           }else if(totalCreditAmt > totalDebitAmt){
            var balenceAmt = totalCreditAmt - totalDebitAmt;
            console.log('balenceAmt',balenceAmt);
            $('#totl_balence').html(balenceAmt);
            $('#totl_balence').html('Cr');
           }else{}

          }else{
            $('#InwardDispatch').DataTable().destroy();
            load_data();
             /*$('#show_err_from_date').html('Please select from date').css('color','red');
            
             $('#show_err_to_date').html('Please select to date').css('color','red');
             $('#show_err_dept_code').html('Please select depot').css('color','red');
             $('#show_err_acct_code').html('Please select account code').css('color','red');
             $('#show_err_trans').html('Please select transporter').css('color','red');*/
          }


        });


      
       $('#ResetId').click(function(){

        $('#vr_num').val('');
              
        $('#acct_code').val('');

        $("#transbtnpdf").css('display','none');
        $("#btnpdf").css('display','block');
        $("#summarybtnpdf").css('display','none');



          $('#trans_id').DataTable().destroy();    
          $('#table_id').DataTable().destroy();
          $('#trans_id').hide();
          $('#table_id').hide();
          $('#InwardDispatch').show();
          $('#InwardDispatch').DataTable().destroy();
          load_data();

        });

  });

</script>

<script type="text/javascript">
  
  function showparticular(partcular){

    var partculrdata = partcular.split(',');

    $("#bill_no").html(partculrdata[0]);
    $("#bill_date").html(partculrdata[1]);
    $("#bill_amt").html(partculrdata[2]);

  }
</script>


<script type="text/javascript">

$(document).ready(function() {

    var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date,
      autoclose: 'true'
    });
  
});

$(document).ready(function() {
  
  var from_date = $('#from_date_default').val();
  var to_date = $('#to_date_default').val();

  $('.datepicker1').datepicker({

    format: 'dd-mm-yyyy',
    orientation: 'bottom',
    todayHighlight: 'true',
    startDate :from_date,
    endDate : to_date,
    autoclose: 'true'

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
  
  function showDetail(vrNo,transC,acC='',glC='',particular,headId){

    var vrNo,transC,acC,glC,particular,headId;
    var acctCdH = $('#acct_code').val();
    var gl_CdH = $('#glC_code').val();

    var billdata = particular.split(',');

    if(acC=='undefined'){
      acC ='';
    }else{
      acC;
    }  

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        url:"{{ url('get-detail-from-trans-in-acc-ledger') }}",
        method : "POST",
        type: "JSON",
        data: {vrNo:vrNo,transC:transC,acC:acC,glC:glC,headId:headId,acctCdH:acctCdH,gl_CdH:gl_CdH},
        success:function(data){

            var data1 = JSON.parse(data);
              
            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.data==''){
                   
              }else{

                $('#detailsbox').css('display','block');
                $('#detailsbox').removeClass('hsdiv');
                var partyRefN='<b class="noDataF">Not Found</b>';
                var partyRDate ='<b class="noDataF">Not Found</b>';

                if(data1.data[0].PARTICULAR){
                  var Bill_No = data1.data[0].PARTICULAR;
                }else{
                  var Bill_No = '<b class="noDataF">Not Found</b>';
                }

                if(data1.data[0].NARRATION){
                  var narration = data1.data[0].NARRATION;
                }else{
                  var narration = '<b class="noDataF">Not Found</b>';
                }

                if(billdata[1]){
                  var dateBill = billdata[1];
                }else{
                  var dateBill = '<b class="noDataF">Not Found</b>';
                }

                if(data1.data[0].ACC_CODE){
                  var accCode = data1.data[0].ACCCODE+' - '+data1.data[0].ACCNAME;
                }else{
                  var accCode = '<b class="noDataF">Not Found</b>';
                }

                if(data1.data[0].GL_CODE){
                  var glCode = data1.data[0].GLCODE+' - '+data1.data[0].GLNAME;
                }else{
                  var glCode = '<b class="noDataF">Not Found</b>';
                }

                $('#tNature').html('<b>T Nature </b> : '+data1.data[0].TRAN_CODE+' - '+data1.data[0]. TRAN_HEAD);
                $('#partyBlNo').html('<b>Particular </b> : '+Bill_No);
                $('#narration').html('<b>Narration </b> : '+narration);
                $('#accCode').html('<b>Acc Code </b> : '+accCode);
                $('#glCode').html('<b>Gl Code </b> : '+glCode);
                  
              }
                      
            }
        }

    });

  }

</script>

<script type="text/javascript">
  
  function validation(){

    var acct_code =  $('#acct_code').val();  
    var glC_code  =  $('#glC_code').val();
    var vrno      =  $('#vr_num').val();

    if(acct_code=='' && glC_code=='' && vrno==''){
      $('#show_err_code').html('Please select to Acc Code Or Gl Code');
      return false;
    }else{
      $('#show_err_code').html('');
    }
  }

  function load_subdata(from_date='',to_date='',accCode='',glCode='',compCode='',glschCode='',costCode='',fieldType=''){

    var table =  $('#sub_ledgerData').DataTable({

      footerCallback: function ( row, data, start, end, display ) {

        var api = this.api(), data;

        // converting to interger to find total
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };

        /*var debitTotal = api
            .column( 4 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

        var creditTotal = api
            .column( 5 )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

        var closingTotal = api
            .column( 2 )
            .data()
            .reduce( function (a, b) {
              console.log('a',a+' '+b);
                return intVal(a) + intVal(b);
            }, 0 );*/

        //var opebal   = api.column(2).data();

        /*var opebal = api
              .column( 2)
              .data()
              .reduce( function (a, b) {
                  return intVal(a) + intVal(b);
                  
            }, 0 );*/

       // $( api.column(1).footer() ).html('Total :-').css('text-align','right');
       // $( api.column(4).footer() ).html(parseFloat(debitTotal).toFixed(2));
       // $( api.column(5).footer() ).html(parseFloat(creditTotal).toFixed(2));
        //$( api.column(2).footer() ).html(parseFloat(closingTotal).toFixed(2));
            
      },
      processing: true,
      serverSide: false,
      info: true,
      bPaginate: false,
      scrollY: 300,
     // scrollX: true,
     /* scroller: true,
      fixedHeader: true,
      order: [[0, 'asc'],[1, 'asc']],
      columnDefs: [
         { orderable: false, targets:0 }
      ],*/

      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
      buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'ACCOUNT LEDGER '+$("#excelDt").val(),
                    filename: 'ACCOUNT_LEDGER_'+$("#excelDt").val(),
                    "action": newexportaction
                },
            ],
      ajax:{
        method:'POST',
        url:'{{ url("/report/account/acc-ledger-sub-button-data") }}',
        data: {from_date:from_date,to_date:to_date,accCode:accCode,glCode:glCode,compCode:compCode,glschCode:glschCode,costCode:costCode,fieldType:fieldType}

      },
      columns: [
          { 
            data:'gl_code',
            name:'gl_code' 
          },
          { 
            data:'gl_name',
            name:'gl_name' 
          },
          { 
            render: function (data, type, full, meta) {
              
              var opDrAmt = full['opDrAmt'];
              var opCrAmt = full['opCrAmt'];

              if(opDrAmt > 0){
                var opnAmt = opDrAmt;
              }else if(opCrAmt > 0){
                var opnAmt = opCrAmt;
              }else{
                var opnAmt = '0';
              }
              return opnAmt;
            },
            className:'alignRightClass'
          },
          { 
            render: function (data, type, full, meta) {
              var opDrAmt = full['opDrAmt'];
              var opCrAmt = full['opCrAmt'];

              if(opDrAmt > 0){
                var drCr = 'Dr';
              }else if(opCrAmt > 0){
                var drCr = 'Cr';
              }else{
                var drCr = 'Dr';
              }
              return drCr;
            } 
          },
          { 
            data:'DrAmt',
            name:'DrAmt' ,
            className:'alignRightClass'
          },
          { 
            data:'CrAmt',
            name:'CrAmt',
            className:'alignRightClass'
          },
          { 
            render: function (data, type, full, meta) {

              var opDrAmt = parseFloat(full['opDrAmt']);
              var opCrAmt = parseFloat(full['opCrAmt']);
              var drAmt   = parseFloat(full['DrAmt']);
              var CrAmt   = parseFloat(full['CrAmt']);

              if(opDrAmt >=0){
                var closingAmt = opDrAmt + drAmt - CrAmt;
              }else if(opCrAmt >=0){
                var closingAmt = -(opCrAmt) + drAmt - CrAmt;
              }else{
                var closingAmt ='0.00';
              }
              
              return closingAmt;
            },
            className:'alignRightClass'
          },
          { 
            render: function (data, type, full, meta) {

              var opDrAmt = parseFloat(full['opDrAmt']);
              var opCrAmt = parseFloat(full['opCrAmt']);
              var drAmt   = parseFloat(full['DrAmt']);
              var CrAmt   = parseFloat(full['CrAmt']);

              if(opDrAmt >=0){
                var closingAmt = opDrAmt + drAmt - CrAmt;
              }else if(opCrAmt >=0){
                var closingAmt = -(opCrAmt) + drAmt - CrAmt;
              }else{
                var closingAmt ='0.00';
              }
              
              if(closingAmt >= 0){
                var closingDrCr = 'Dr';
              }else{
                var closingDrCr = 'Cr';
              }
              return closingDrCr;
            }
          },
      ]

    });/*/.datatble*/

  }

  function subButtonFun(fieldType){
    $('#sub_ledgerData').DataTable().destroy();
    $('#subDatatable').removeClass('subTbleCls');
    $('#mainDatatable').hide();
    $('#btnsearch').prop('disabled',true);

    var from_date = $('#from_date').val();
    var to_date   = $('#to_date').val();
    var glCode    = $('#glC_code').val();
    var accCode   = $('#acct_code').val();
    var compData  = $('#comp_code').val();
    var splitComp = compData.split('-');
    var compCode  = splitComp[0];
    var glschCode = $('#glsch_code').val();
    var costCode  = $('#cost_code').val();

    load_subdata(from_date,to_date,accCode,glCode,compCode,glschCode,costCode,fieldType);

  }

  function subButtonModlFun(fieldType){

    /*if(fieldType == 'PENDINGBILLS'){
      $("#pendingBillModl").modal('show');
    }else{*/
      //load_subdata(from_date,to_date,accCode,glCode,compCode,glschCode,costCode,fieldType);
    //}

    $("#pendingBillModl").modal('show');

    var accCode = $('#acct_code').val();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        url:"{{ url('report/account/pending-bill-alloc-sub-data') }}",
        method : "POST",
        type: "JSON",
        data: {fieldType: fieldType,accCode:accCode},
        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
            $('#bodytbleDrsubdata').empty();
            $('#bodytbleCrsubdata').empty();

          }else if(data1.response == 'success'){

            $('#bodytbleDrsubdata').empty();
            $('#bodytbleCrsubdata').empty();
             $('#tbleLable1').html('Pending Debit Balance');
            var headData = "<tr><th style='width: 10px;'>Bill VrNo</th><th>Bill Date</th><th>Bill Amt</th><th>Aloc Amt</th><th>Balance</th></tr>";
            $('#bodytbleDrsubdata').append(headData);

            var headDatacr = "<tr><th style='width: 10px;'>Bill VrNo</th><th>Bill Date</th><th>Bill Amt</th><th>Aloc Amt</th><th>Balance</th></tr>";
            $('#bodytbleCrsubdata').append(headDatacr);


            $.each(data1.datadr, function(k, getData){
              var vrDate = getData.VRDATE;
              var splitData = vrDate.split('-');
              var formVrDate = splitData[2]+'-'+splitData[1]+'-'+splitData[0];

              var fyCode    = getData.FY_CODE;
              var splitFy   = fyCode.split('-');
              var startYrFy = splitFy[0];

              var formVrNo = startYrFy+'/'+getData.SERIES_CODE+'/'+getData.VRNO;

              var balenceAmt = parseFloat(getData.DRAMT) - parseFloat(getData.DRALLOC);

              var bodyData = "<tr><td style='width: 10px;'>"+formVrNo+"</td><td>"+formVrDate+"</td><td class='alignRightClass'>"+getData.DRAMT+"</td><td class='alignRightClass'>"+getData.DRALLOC+"</td><td class='alignRightClass'>"+balenceAmt.toFixed(2)+"</td></tr>";

              $('#bodytbleDrsubdata').append(bodyData);

            });

            $('#tbleLable2').html('Pending Credit Balance');

            $.each(data1.datacr, function(k, getData){
              var vrDate = getData.VRDATE;
              var splitData = vrDate.split('-');
              var formVrDate = splitData[2]+'-'+splitData[1]+'-'+splitData[0];

              var fyCode    = getData.FY_CODE;
              var splitFy   = fyCode.split('-');
              var startYrFy = splitFy[0];

              var formVrNo = startYrFy+'/'+getData.SERIES_CODE+'/'+getData.VRNO;

              var balenceAmt = parseFloat(getData.CRAMT) - parseFloat(getData.CRALLOC);

              var bodyData = "<tr><td style='width: 10px;'>"+formVrNo+"</td><td>"+formVrDate+"</td><td class='alignRightClass'>"+getData.CRAMT+"</td><td class='alignRightClass'>"+getData.CRALLOC+"</td><td class='alignRightClass'>"+balenceAmt.toFixed(2)+"</td></tr>";

              $('#bodytbleCrsubdata').append(bodyData);

            });

          }/*/.success codn*/

        } /* /.success fun*/

    }); /* /.ajax*/

  }/*/.fun*/

</script>


@endsection