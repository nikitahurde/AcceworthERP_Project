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
    ::placeholder {
      text-align:left;
    }
    .text-center{
      text-align: center;
    }
    .aplynotStatus{
      display: none;
    }
    .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
    }
    .box-header>.box-tools {
      position: absolute !important;
      right: 10px !important;
      top: 2px !important;
    }
    .required-field::before {
      content: "*";
      color: red;

    }
    .showSeletedName {
      font-size: 12px;
      margin-top: 2%;
      text-align: center;
      font-weight: 600;
      color: #4f90b5;
    }
    .modal-header .close {
      margin-top: -25px !important;
      margin-right: 2% !important;
    }
    .textLeft{
      text-align:left;
    }
    .textRight{
      text-align:right;
    }
    .numerRightAlign{
      text-align:right;
    }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>
      C and F Bill
      <small> : Report Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

      <li><a href="{{ url('/dashboard') }}">Logistic</a></li>

      <li class="active"><a href="{{ url('/report/purchase/purchase-indent-report') }}">C and F Bill</a></li>

    </ol>

  </section><!-- --sectio -->

<form id="saleBillForm">

  <section class="content" style="min-height: 150px;margin-bottom: -26px;">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> C and F Bill</h2>

        <div class="box-tools pull-right">

          <a href="{{ url('/transaction/CandF/view-c-and-f-bill-tran') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

        </div>

      </div><!-- /.box-header -->

      <div class="box-body">

        <?php date_default_timezone_set('Asia/Kolkata'); ?>

          <div class="row">

            <div class="col-md-2">

              <div class="form-group">

                  <label for="exampleInputEmail1">Vr. Date: </label>

                  <div class="input-group">
                        <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                        <input autocomplete="off" type="text" name="vr_date" id="vr_date" class="form-control datepicker rightcontent" placeholder="Select Vr Date" value="<?php echo date('d-m-Y'); ?>">

                  </div>

                  <small id="show_err_to_date" style="color:red;"></small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label>

                 Trans Code : 

                  <span class="required-field"></span>

                </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                    <input type="text" class="form-control" name="trans_code" value="{{$tranlist->TRAN_CODE }}" placeholder="Enter Trans Code" maxlength="15" id="trans_code" readonly >

                  </div>

              </div>

            </div>

            <div class="col-md-2">

              <div class="form-group">

                <label> Series Code : <span class="required-field"></span></label>

                  <div class="input-group">

                    <?php $seriesCnt = count($seriesList); 
                      if($seriesCnt == 1){
                        $seriesCode = $seriesList[0]->SERIES_CODE;
                        $seriesName = $seriesList[0]->SERIES_NAME;
                      }else{
                        $seriesCode ='';
                        $seriesName ='';
                      }
                    ?>

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <input list="seriesList" class="form-control" name="series_code" value="{{$seriesCode}}" id="series_code" placeholder="Enter Series Code" autocomplete="off" onchange="getvrnoBySeries();">

                    <datalist id="seriesList">
                        <?php foreach ($seriesList as $key) { ?>

                        <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>
                          
                        <?php   } ?>
                    </datalist>

                  </div>
                  <input type="hidden" name="seriesgl_code" id="seriesgl_code">
                  <input type="hidden" name="seriesgl_name" id="seriesgl_name">
              </div><!-- /.form-group -->

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label> Series Name : <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <input list="seriesList" class="form-control" name="series_name" value="" id="series_name" placeholder="Enter Series Name" readonly autocomplete="off" >

                  </div>

              </div><!-- /.form-group -->

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label> Vr No : <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <input type="text" class="form-control" name="vrseqnum" value="" id="vrseqnum" placeholder="Enter Vr No" readonly autocomplete="off">

                  </div>

              </div><!-- /.form-group -->
              
            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Post Code : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>

                      <input type="text" id="post_code" name="post_code" class="form-control  pull-left" value="" placeholder="Select Post Code" readonly autocomplete="off">

                  </div>

                  <small id="post_name_text" style="color: #3c8dbc;font-weight: bold;"></small>
              </div>

            </div><!-- /.col  -->

          </div><!-- /.row -->

          <div class="row">

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                  </div>
                  <input list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Account Code" autocomplete="off">

                  <datalist id="accountList">

                    <option selected="selected" value="">-- Select --</option>

                    <?php foreach ($accList as $key) { ?>

                       <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> <?= $key->ACC_NAME ?></option>
                        
                    <?php } ?>


                  </datalist>

                </div>
                <input type="hidden" id="tdsOfAccCode" name="tdsOfAccCode">
                <small>  
                  <div class="pull-left showSeletedName" id="accountText"></div>
                </small>
                <small id="show_err_acct_code"></small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Account Name : <span class="required-field"></span></label>

                <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                     <input type="text" id="acct_name" name="acct_name" class="form-control  pull-left" value="{{ old('acct_name')}}" placeholder="Select Account Name" autocomplete="off" readonly="">

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Account Address : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                  </div>
                  <input list="accaddressList" id="acct_address" name="acct_address" class="form-control  pull-left" value="{{ old('acct_address')}}" placeholder="Select Account Address" autocomplete="off">

                  <datalist id="accaddressList">

                    <option selected="selected" value="">-- Select --</option>

                  </datalist>

                </div>
                <input type="hidden" name="addrcpCode" id="addrcpCode">
              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Rake No : </label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                  </div>
                  <input list="rakeNoList" id="rake_No" name="rake_No" class="form-control  pull-left" value="{{ old('rake_No')}}" placeholder="Select Rake No" autocomplete="off">

                  <datalist id="rakeNoList">

                    <option selected="selected" value="">-- Select --</option>

                  </datalist>

                </div>
                <input type="hidden" id="tdsOfAccCode" name="tdsOfAccCode">
                <small>  
                  <div class="pull-left showSeletedName" id="accountText"></div>
                </small>
                <small id="show_err_acct_code"></small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">From Date : </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                  </div>

                  <input type="text" name="from_date" id="from_date" class="form-control fromdatepicker" autocomplete="off" placeholder="Enter From Date" value="">

                </div>
                <small id="showmsgfordate"></small>

              </div><!-- /.form group -->

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">To Date : </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                  </div>

                  <input type="text" name="to_date" id="to_date" class="form-control todatepicker" placeholder="Enter To Date" autocomplete="off" value="">

                </div>
                <small id="showmsgfordate"></small>

              </div><!-- /.form group -->

            </div><!-- /.col -->

          </div><!-- /.row -->

          <div class="row">

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Sale Order No : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                  </div>

                  <input list="saleNo_List" id="sale_order_no" name="sale_order_no" class="form-control  pull-left" value="" placeholder="Select Trans Code"  autocomplete="off">

                  <datalist id="saleNo_List">
                    
                  </datalist>

                </div>
                <input type="hidden" id="saleorderHid" name="saleorderHid">
              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label>ITEM/SERVICE CODE : <span class="required-field"></span></label>
               
                <input list="itemCodeList"  id="itemCodeId" name="item_Code" class="form-control  pull-left" value="{{ old('itemCode')}}" placeholder="Select Item/Service Code" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                <datalist id="itemCodeList">

                  <option selected="selected" value="">-- Select --</option>

                </datalist>

              </div><!-- /.form-group -->

              <small id="shwoErrItemCode" style="color:red;"></small>

            </div> <!-- /. col-md-3 -->
            
            <div class="col-md-2">

              <div class="form-group">

                <label>ITEM/SERVICE NAME : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                    </div>

                    <input type="text"  id="itemNameId" name="item_Name" class="form-control  pull-left" value="{{ old('itemName')}}" placeholder="Select Item/Service Name" readonly  autocomplete="off">

                  </div>

              </div><!-- /.form-group -->

              <small id="itemNameMsg"></small>

            </div> <!-- /. col-md-3 -->

          </div><!-- /.row -->
          
          <div class="row">

            <div class="col-md-12">

              <div style="text-align:center;margin-bottom: 5px;color:red;" id="reqFieldMsg">
                
              </div>

              <div style="text-align:center;">

                <button type="button" class="btn btn-primary btn-sm" name="searchdata" id="btnsearch" style="padding:0px 2px;"> &nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search &nbsp;&nbsp;</button>

                <button type="button" class="btn btn-warning btn-sm" name="searchdata" onClick="window.location.reload();" style="padding:0px 2px;" >&nbsp;&nbsp; <i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset &nbsp;&nbsp;</button>

              </div>

            </div><!-- /.col -->

            <div class="col-md-5"></div>

          </div><!-- /.row -->

      </div><!-- /.box-body -->

    </div><!-- /.custom box -->

  </section>

<section class="content">

  <div class="box box-primary Custom-Box">

    <div class="box-header with-border" style="text-align: center;"></div>

      <div class="box-body" style="margin-top: 0%;">

        <table id="billTable" class="table table-bordered table-striped table-hover">

          <thead class="theadC">
            <tr>
              <th class="text-center">Description</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Rate</th>
              <th class="text-center">Amount</th>
            </tr>
          </thead>

          <tbody id="defualtSearch">

          </tbody>
   
          <tfoot align="right">
            <tr><th></th><th></th><th></th><th></th></tr>
          </tfoot>

        </table>

        <div class="modal fade" id="tds_rate_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;overflow-y: scroll;">

              <div class="modal-header">

                <div class="row">
                  
                  <div class="col-md-6">

                    <div class="form-group">
                        <lable class="settaxcodemodel col-md-4" style="padding: 0px;">Tax Code - </lable>
                                 
                        <input type="text" class="settaxcodemodel col-md-8" id="tax_code1" style="border: none; padding: 0px;margin-top: -6px;" readonly>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <h5 class="modal-title settaxcodemodel" id="exampleModalLabel">Tax / Charges / etc Calculation</h5>
                  </div>

                </div>

              </div>

              <div class="modal-body table-responsive">

                <div class="modalspinner hideloaderOnModl"></div>

                  <table class="table tdthtablebordr" border="1" cellspacing="0" id="tax_rate_1">
                  </table><!-- /.table -->

              </div>

              <div class="modal-footer">

                <center> <small  id="footer_ok_btn1"></small>
                  <small  id="footer_tax_btn1" style="width: 10px;"></small>
                </center>
              
              </div>

            </div>

          </div>

        </div>

        <div class="row">

          <div class="col-md-2">

            <div class="form-group">

              <label>Tax Code : <span class="required-field"></span></label>

              <div class="input-group">

                <div class="input-group-addon">
                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                </div>
                <input type="hidden" name="pertText" id="pertText">
                <input list="taxList"  id="taxCode" name="taxCode" class="form-control  pull-left" value="" onclick="CalculateTax(1);getGrandTotal(1);" autocomplete="off" placeholder="Enter Tax Code"> 

                <datalist id="taxList">

                  <option selected="selected" value="">-- Select --</option>

                  <?php foreach($taxlist AS $key){ ?>

                    <option value='<?php echo $key->TAX_CODE?>'  data-xyz="<?php echo $key->TAX_NAME; ?>" ><?php echo $key->TAX_NAME; echo "[".$key->TAX_CODE."]"; ?></option>

                  <?php } ?>

                </datalist>
                    
              </div>

            </div><!-- /.form-group -->

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label>Tax Name: <span class="required-field"></span></label>

              <div class="input-group">

                <div class="input-group-addon">

                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                </div>

                <input type="text"  id="tax_name" name="tax_name" class="form-control  pull-left" value="" placeholder="Enter Tax Name" autocomplete="off" readonly=""> 

              </div>

            </div><!-- /.form-group -->

          </div><!-- /.col -->

          <div class="col-md-1">
           
            <div style="display: inline-flex;margin-top: 10px;">
            
              <label>&nbsp;</label>
              <button type="button" class="btn btn-primary btn-xs" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1);getGrandTotal(1);">Calc Tax </button>
              <input type="hidden" value="0" name="taxDataCount" id="data_count1">
              <input type="hidden" value="0" name="gstTaxData" id="gstTaxData">
              <div id="aplytaxOrNot1" class="aplynotStatus"></div>
              <div id="cancelbtn1"></div>
              <div id="appliedbtn1" style="margin-top: 6px;"></div>
            </div>
            
          </div>                  

         <!--  <div class="col-md-1">
            
            <div style="display: inline-flex;margin-top: 10px;">
              <label>&nbsp;</label>
              <button type="button" class="btn btn-primary btn-xs tdsratebtnHide" id="tds_rate" data-toggle="modal" data-target="#tdsrate_cal_model" onclick="CalculateTdsRate(1)" disabled>Calc TDS</button>
              <div id="tdsappliedbtn1" class="applyBTn"></div>
              <div id="tdscanclebtn1" class="applyBTn"></div>
              <input type="hidden" name="GettdsCode" id="GettdsglCode">
              <input type="hidden" value='0' id=isTdsAply>
              <input type="hidden" id=tdsdeductAmt>
              <input type="hidden" id=netAmtFortds>
            </div>
          </div> -->
              
        </div>

        <div class="row">

            <!--  ------- HIDDEN FIELDS --------  -->

            <input type="hidden" name="pfctCode" id="pfctCode" value="">
            <input type="hidden" name="pfctName" id="pfctName" value="">
            <input type="hidden" name="plantCode" id="plantCode" value="">
            <input type="hidden" name="plantName" id=plantName value="">
            <input type="hidden" name="itemCode" id=itemCode value="">
            <input type="hidden" name="itemName" id=itemName value="">
            <input type="hidden" name="remarkName" id=remarkName value="">
            <input type="hidden" name="netWeight" id=netWeight value="">
            <input type="hidden" name="soRate" id=soRate value="">
            <input type="hidden" name="rakeDate" id=rakeDate value="">
            <input type="hidden" name="placeDate" id=placeDate value="">
            <input type="hidden" name="rakeNo" id=rakeNo value="">
            <input type="hidden" name="amountBasic" id=basic value="">
            <input type="hidden" name="dr_amt" id=dr_amt value="">
            <input type="hidden" name="getNetAmnt" id=getNetAmnt value="">
            <input type="hidden" name="itemHSNCd" id=itemHSNCd value="">
            <input type="hidden" name="itemHSNNm" id=itemHSNNm value="">

            <!--  ------- HIDDEN FIELDS --------  -->

            <div class="col-sm-12">
              <div id="taxNotApply" style="color:red;text-align: center;margin-bottom: 10px;"></div>
            </div>

            <div class="col-md-12" style="text-align: center;">

              <button class="btn btn-primary" type="button" id="simulation" onclick="billSimulation()"  style="font-size: 12px;line-height: 1;padding: 4px;" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Simulation</button>

              <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">

               <!-- <button type="submit" name="submit" value="submit" id="submitinparty" class='btn btn-success btn-sm' onclick="submitBillGenerate(0)" disabled="" style="font-size: 12px;line-height: 1;padding: 4px;">Save</button>  -->

               <button type="button" name="submit" value="submit" id="submitinparty" class='btn btn-success btn-sm' onclick="submitBillGenerateData(0)"  style="font-size: 12px;line-height: 1;padding: 4px;" disabled>Save</button> 

              <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();" style="font-size: 12px;line-height: 1;padding: 4px;"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

              <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitBillGenerateData(1)" style="font-size: 12px;line-height: 1;padding: 4px;" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button> 
            </div>

        </div>

      </div><!-- /.box-body -->
  
  </div><!-- /.custom box -->

</section><!-- /.section -->

</form>

</div>

<!-- ------ SIMULATION MODAL ------------  -->
  
  <div class="modal fade in" id="simulation_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">

    <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

      <div class="modal-content" style="border-radius: 5px;">

        <div class="modal-header">

          <div class="row">

            <div class="col-md-12">

              <h5 class="modal-title settaxcodemodel" style="text-align: center;" id="exampleModalLabel">Simulation Bill</h5>

            </div>

          </div>

          <div class="modal-body table-responsive">

            <table class="table tdthtablebordr" border="1" cellspacing="0"  id="siml_body">
              
            </table>
            
            <center><button type="button" class="btn btn-primary " style="width: 10%;" data-dismiss="modal">Ok</button>
           </center>

          </div>

        </div>

      </div>

    </div>

  </div>

<!-- ------ SIMULATION MODAL ------------  -->
 
@include('admin.include.footer')

<script type="text/javascript">
  function CalculateTax(taxid){

    $('#data_count'+taxid).val(0);
    $('#footer_tax_btn'+taxid).html('');

    $("#tds_rate_model"+taxid).modal({
        show:false,
        backdrop:'static',
    });

    $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    var taxOnModel = $('#tax_Code'+taxid).val();
    var basicAmt   = $('#basic').val();
    $("#gstTaxData").val('1');

    $('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt);

    var Item_Cde = $('#item_code').val();

    if(taxOnModel == '' || taxOnModel == undefined){

      var tax_code = $('#taxCode').val();

      $.ajax({

            url:"{{ url('Transaction/a-field-calc/tax-rate-calc')}}",

            method : "POST",

            type: "JSON",

            data: {tax_code: tax_code},

            beforeSend: function() {
              console.log('start spinner');
                  $('.modalspinner').removeClass('hideloaderOnModl');
            },

            success:function(data){
              
              var data1 = JSON.parse(data);
               
                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                    if(data1.data==''){

                    }else{

                      var basicheadval = parseFloat($('#basic').val());

                      var counter = 1;

                      var countI ='';
                      var dataI ='';

                      $('#tax_rate_'+taxid).empty();

                      var TableHeadData =  "<tr><th>Tax Indicator</th><th>Rate Indicator</th><th>Rate</th><th>Amount</th></tr>";

                      $('#tax_rate_'+taxid).append(TableHeadData);

                      $.each(data1.data, function(k, getData) {

                        var datacount = data1.data.length;
                        dataI = datacount;
                        $('#data_count'+taxid).val(datacount);

                        if((getData.RATE_INDEX == null && getData.TAX_RATE == null) || (getData.RATE_INDEX == '-' && getData.TAX_RATE == '0.00')){

                         $('#tax_code'+taxid).val(getData.TAX_CODE);

                         var TableData = "<tr><td class='tdthtablebordr'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"> </td>"+
                          "<td class='tdthtablebordr'><input type='text' id='indicator_"+taxid+"_"+counter+"' name='rate_ind[]' class='form-control' value='---' readonly></td>"+
                          "<td class='tdthtablebordr'><input type='text' id='rate_"+taxid+"_"+counter+"' value='---' name='af_rate[]' class='form-control numerRightAlign' readonly></td>"+
                          "<td class='tdthtablebordr'><input type='text' class='form-control numerRightAlign' name='amountTax[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval.toFixed(2)+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''></td>";

                        }else{

                          if(getData.tax_ind_name == 'GrandTotal'){
                            var classname = 'grandTotalGet';
                          }else{
                            var classname = '';
                          }

                          if(getData.TAX_AMT){
                            var taxAmt =getData.TAX_AMT
                          }else{
                            var taxAmt ='';
                          }

                          if(getData.TAX_GL_CODE == null || getData.TAX_GL_CODE == '' ||getData.TAX_GL_CODE =='undefined'){
                            var taxglCd ='';
                          }else{
                            var taxglCd =getData.TAX_GL_CODE;
                          }


                          if(getData.TAXGL_CODE ==null || getData.TAXGL_CODE =='' || getData.TAXGL_CODE =='undefined'){
                            var taxTrnasGl = '';
                          }else{
                            var taxTrnasGl =getData.TAXGL_CODE;
                          }

                          if(taxglCd){
                            var TAXGLCODE=taxglCd;
                          }else if(taxTrnasGl){
                            var TAXGLCODE=taxTrnasGl;
                          }else{
                            var TAXGLCODE='';
                          }

                          if(getData.TAX_LOGIC == '' || getData.TAX_LOGIC == null){
                            var TAXLOGIC = '';
                          }else{
                            var TAXLOGIC = getData.TAX_LOGIC;
                          }

                          if(getData.STATIC_IND == '' || getData.STATIC_IND == null){
                            var staticIND = '';
                          }else{
                            var staticIND = getData.STATIC_IND;
                          }

                          var TableData = "<tr><td class='tdthtablebordr'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value=\""+getData.TAXIND_NAME+"\" readonly><input type='hidden' name='taxIndCode[]' id='tax_ind_code_"+taxid+"_"+counter+"' value="+getData.TAXIND_CODE+"></td>"+
                           "<td class='tdthtablebordr'><input type='text' class='form-control' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' oninput='getGrandTotal("+taxid+");'> <a href='javascript:void(0)' class='label label-success showind_Ch' id='changeInd_"+taxid+"_"+counter+"' onclick='ind_forChange("+taxid+","+counter+")' >Change</a></td>"+
                           "<td class='tdthtablebordr'><input type='text' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control numerRightAlign' oninput='getGrandTotal("+taxid+");' ></td>"+
                           "<td class='tdthtablebordr'><input type='text' class='numerRightAlign form-control "+classname+"' name='amountTax[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+taxAmt+"' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticIND+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'>"+
                             //indicator change modal 
                              "<div id='indicatorShow_"+taxid+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($ratval_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='cInd_"+taxid+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxid+","+counter+"); getGrandTotal("+taxid+");'>Apply</button></div></div></div></div></td></tr>";

                        }

                        $('#tax_rate_'+taxid).append(TableData);

                        var IndexSelct = getData.RATE_INDEX;
                       
                          objcity = data1.data_rate;
                     
                          $.each(objcity, function (i, objcity) {
                            
                            var rateSel = '';
                            if(IndexSelct == objcity.RATE_VALUE){

                              $('#indicator_'+taxid+'_'+counter).append($('<option>',
                              { 

                                value: objcity.RATE_VALUE,

                                text : objcity.RATE_VALUE+' = '+objcity.RATE_NAME,

                                selected : true

                              }));
                          
                            }else{
                             
                               $('#indicator_'+taxid+'_'+counter).append($('<option>',
                                { 

                                  value: objcity.RATE_VALUE,

                                  text : objcity.RATE_VALUE+' = '+objcity.RATE_NAME,

                                  selected : false

                                }));
                                }

                          }); // .each loop

                          countI = counter;

                          counter++;

                      }); /* -/. each loop */

                      var butn =  $('#footer_tax_btn'+taxid).find(':button').html();

                     if(butn != 'Ok' || butn =='undefined'){

                      var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOktaxbtn"+taxid+"' onclick='OkGetGransVal("+taxid+","+dataI+","+countI+",1);' style='width: 36px;'>Ok</button>";

                       $('#footer_tax_btn'+taxid).append(tblData);

                     }else{
                     
                     }

                      
                    }
                 
                } // success close

          }, //success function close

          complete: function() {
            $('.modalspinner').addClass('hideloaderOnModl');
          },

      }); //ajax close 

    }else{

    }

  } /*function close*/


  function getGrandTotal(getid){

    setTimeout(function() {

      $('.modalspinner').addClass('hideloaderOnModl');

      totalAmount = 0;

      qunatity = $("#qty"+getid).val();
      var funtn;
      for(l=2;l<=12;l++){

          var rate = $("#rate_"+getid+"_"+l).val();   

          var indicator = $("#indicator_"+getid+"_"+l).val();

          //console.log('indicator',indicator);

          var logic = $("#logic_id_"+getid+"_"+l).val();
          var static = $("#static_id_"+getid+"_"+l).val();
          var glCode = $("#tax_gl_code_"+getid+"_"+l).val();

          if(logic == null){

          }else{ 

            if(logic.length >0 || logic.length ==0){

             indicatorCalculation(indicator,rate,logic,l,getid,glCode);

            }
          }

          if((static == 0)){

              $("#changeInd_"+getid+"_"+l).removeClass('showind_Ch');
              $("#indicator_"+getid+"_"+l).prop('readonly',true);

              if(indicator == 'N' || indicator == 'P' || indicator == 'O' || indicator == 'Q'){
                $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',true);
                $("#rate_"+getid+"_"+l).prop('readonly',false);
              }else if(indicator == 'L' || indicator == 'M'){
                $("#rate_"+getid+"_"+l).prop('readonly',true);
                $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',false);
              }
             
              /* if(indicator == 'L' || indicator == 'M'){

                     $("#indicator_"+getid+"_"+l).prop('readonly',true);
                     $("#rate_"+getid+"_"+l).prop('readonly',true);
                     $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',false);
                     $("#changeInd_"+getid+"_"+l).addClass('showind_Ch');
                     
                }*/
          }else{

               $("#indicator_"+getid+"_"+l).prop('readonly',true);
               $("#rate_"+getid+"_"+l).prop('readonly',true);
               $("#FirstBlckAmnt_"+getid+"_"+l).prop('readonly',true);
               $("#changeInd_"+getid+"_"+l).addClass('showind_Ch');
          }

          if(indicator == 'R'){
              var amntF_R =  parseFloat(qunatity) * parseFloat(rate);

              $('#FirstBlckAmnt_'+getid+"_"+l).val(amntF_R);
          }else{}

          
        
      }

    }, 500);

    $('.modalspinner').removeClass('hideloaderOnModl');

  } /*function close*/

  function indicatorCalculation(indicator,rate,logic,l,incNum,glCode){

      var totalLogicVal = 0;

      if(logic.length >0){

        logicVal= "";

        for(j=1; j<=logic.length; j++)

        {

          k = logic.substring(j-1,j);

          var BlocValue = $("#FirstBlckAmnt_"+incNum+"_"+k).val();

          if(BlocValue!="")

            totalLogicVal = parseFloat(totalLogicVal) + parseFloat(BlocValue);

        }

      }

      if(indicator == 'A'){
        roundofrate= ((parseFloat(totalLogicVal) * rate)/100);
        roundof= Math.round(roundofrate) - parseFloat(totalLogicVal);
           $("#FirstBlckAmnt_"+incNum+"_"+l).val(roundof.toFixed(2));
   
      }

      if(indicator=="N"){

          amtMinus= -((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmnt_"+incNum+"_"+l).val(amtMinus.toFixed(2));

      }

      var inde_M_amt = parseFloat($("#FirstBlckAmnt_"+incNum+"_"+l).val());
    
      if(isNaN(inde_M_amt)){
        indm = '';
        $("#FirstBlckAmnt_"+incNum+"_"+l).val(indm);
      }else{

        if(indicator=="M"){
          var lumMinus; 

          lumMinus= parseFloat($("#FirstBlckAmnt_"+incNum+"_"+l).val()); 

          if(lumMinus > 0){
            var indicatorMAmt1=  -(lumMinus);
          }else if(lumMinus < 0){
            var indicatorMAmt1=  (lumMinus);
          }
          // indicatorMAmt=  -(parseFloat(indicatorMAmt) +  amtMinus);
            indicatorMAmt = indicatorMAmt1;
           $("#FirstBlckAmnt_"+incNum+"_"+l).val(indicatorMAmt);

        }
      }

      if(indicator=="P"){

          addition = ((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmnt_"+incNum+"_"+l).val(addition.toFixed(2));

      }

      if(indicator=="Q"){

         additionRoundOff = ((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmnt_"+incNum+"_"+l).val(Math.round(additionRoundOff.toFixed(2)));

      }

      if(indicator=="Z"){

          subtotalview = ((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmnt_"+incNum+"_"+l).val(subtotalview.toFixed(2));

      }
    
      if(indicator=="O"){

          deductionRoundOff = -((parseFloat(totalLogicVal) * rate)/100);    

          $("#FirstBlckAmnt_"+incNum+"_"+l).val(Math.round(deductionRoundOff.toFixed(2)));

      }

      var crAmt =0;
      if(l == 2){
        var basicAmt =$('#basic'+incNum).val();
        if(indicator == 'Z'){}else{

          if(glCode ==''){
            var amnt = $("#FirstBlckAmnt_"+incNum+"_"+l).val();
            if(amnt == ''){
              var calAmt = 0;
            }else{
              var calAmt = amnt;
            }
            crAmt = parseFloat(basicAmt)+parseFloat(calAmt);
            $("#cr_amtbytax_"+incNum).val(crAmt.toFixed(2));
          }
        }
      }else{
        if(indicator == 'Z'){}else{
          if(glCode ==''){
            var amntF = $("#FirstBlckAmnt_"+incNum+"_"+l).val();
            var crGet = $("#cr_amtbytax_"+incNum).val();
            if(amntF == ''){
              var cal_amt =0;
            }else{
              var cal_amt =amntF;
            }
           crAmtcal =  parseFloat(crGet)+parseFloat(cal_amt);
           $("#cr_amtbytax_"+incNum).val(crAmtcal.toFixed(2));
          }
        }
      }

  } /*function close*/

  function ind_forChange(rowid,countid){

    $('#indicatorShow_'+rowid+'_'+countid).modal('show');
    var already_ind = $('#indicator_'+rowid+'_'+countid).val();

    for(var w=1;w<=9;w++){

      var setInd = $('#cInd_'+rowid+'_'+countid+'_'+w).val();

        if(already_ind == 'N' || already_ind == 'O' || already_ind == 'P' || already_ind=='Q' || already_ind=='R'){
                if(setInd == 'L' || setInd == 'M' || setInd == 'Z' || setInd == 'A'){
                  $('#cInd_'+rowid+'_'+countid+'_'+w).prop('disabled',true);
                }
                
        }else if(already_ind == 'L' || already_ind == 'M'){
            if(setInd == 'N' || setInd == 'O' || setInd == 'P' || setInd=='Q' || setInd=='R' || already_ind == 'N' || setInd == 'Z' || setInd == 'A'){
              $('#cInd_'+rowid+'_'+countid+'_'+w).prop('disabled',true);
            }
        }

        if(setInd == already_ind){
          $('#cInd_'+rowid+'_'+countid+'_'+w).prop('checked',true);
        }

    }

  }

function setIndOnOk(indid,indnmeid){

  var ind_value= $("input[type='radio'][name='chang_indval']:checked").val();
   
  if(ind_value =='M' || ind_value == 'L'){
    $('#rate_'+indid+'_'+indnmeid).val(100).prop('readonly',true);
    $('#logic_id_'+indid+'_'+indnmeid).val('');
    $('#FirstBlckAmnt_'+indid+'_'+indnmeid).val('');
   
  }else{
    $('#rate_'+indid+'_'+indnmeid).prop('readonly',false);
  } 

  $('#indicator_'+indid+'_'+indnmeid).val(ind_value);
  $('#indicatorShow_'+indid+'_'+indnmeid).modal('hide');

}

function OkGetGransVal(aplyid,datacount,countercount,staticvalue){

    console.log('countercount',countercount);
    console.log('datacount',datacount);
    console.log('aplyid',aplyid);
    if(staticvalue==1){

      $('#aplytaxOrNot'+aplyid).html('1');
      $('#cancelbtn'+aplyid).html('');
      $('#appliedbtn'+aplyid).html('');

      var appliedbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-success iconBtnSty"><i class="fa fa-check"></i></small>';

      $('#appliedbtn'+aplyid).html(appliedbtn);
          
      $('#simulation').prop('disabled', false);
      $('#submitinparty').prop('disabled', false);
      $('#submitdatapdf').prop('disabled', false);
          
      if(countercount == datacount){
        var g_Amnt = $('#FirstBlckAmnt_'+aplyid+'_'+countercount).val();
        console.log('g_Amnt',g_Amnt);
        $('#getNetAmnt').val(g_Amnt);
      
        $('#nextAmtTot').html(g_Amnt);
      }
      
    }else{
        
      $('#aplytaxOrNot'+aplyid).html('0');
      $('#cancelbtn'+aplyid).html('');
      $('#appliedbtn'+aplyid).html('');

      var cnclbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-danger"><i class="fa fa-times"></i></small>';

      $('#cancelbtn'+aplyid).html(cnclbtn);
      $('#data_count'+aplyid).val(0);
      //$('#get_grand_num'+aplyid).val('');
         
    }

}


</script>

<script>

  $(document).ready(function(){

    getvrnoBySeries();

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

     // endDate: 'today',
      
      autoclose: 'true'

    });

    $('.fromdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

     // endDate: 'today',
      
      autoclose: 'true'

    });

    $('.todatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

     // endDate: 'today',
      
      autoclose: 'true'

    });

    $('#from_date,#to_date').on('change',function(){

      var fromDate = $('#from_date').val();
      var toDate = $('#to_date').val();

      if(fromDate || toDate){
        $('#rake_No').prop('readonly',true);
      }else{
        $('#rake_No').prop('readonly',false);
      }
      
    });

    $('#rake_No').on('change',function(){

      var rakeNo =  $('#rake_No').val();  
      
      var xyz = $('#rakeNoList option').filter(function() {

        return this.value == rakeNo;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#rake_No').val('');
        $('#from_date').prop('readonly',false);
        $('#to_date').prop('readonly',false);
      }else{
        $('#from_date').prop('readonly',true);
        $('#to_date').prop('readonly',true);
        $('#from_date').val('');
        $('#to_date').val('');
      }  

    });


    $('#acct_code').on('change',function(){

      var accCode =  $('#acct_code').val();
      var xyz = $('#accountList option').filter(function() {

        return this.value == accCode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#acct_code').val('');
        $('#acct_name').val('');
      }else{
        $('#acct_name').val(msg);
      }

      fetchDataForBill();

    });

    $('#acct_address').on('change',function(){

      var addressCode =  $('#acct_address').val();
      var xyz = $('#accaddressList option').filter(function() {

        return this.value == addressCode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#acct_address').val('');
        $('#addrcpCode').val('');
      }else{
        $('#addrcpCode').val(msg);
      }

    });

    $('#itemCodeId').on('change',function(){

      var itemCd =  $('#itemCodeId').val();
      var xyz = $('#itemCodeList option').filter(function() {

        return this.value == itemCd;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#itemCodeId').val('');
        $('#itemNameId').val('');
      }else{
        $('#itemNameId').val(msg);
      }
    }); 


    $('#sale_order_no').on('change',function(){

      var soNum =  $('#sale_order_no').val();
      var xyz = $('#saleNo_List option').filter(function() {

        return this.value == soNum;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#sale_order_no').val('');
        $('#saleorderHid').val('');
      }else{
        $('#saleorderHid').val(msg);
      }

      fetchDataForBill();
    });

    $('#btnsearch').on('click',function(){

      var seriesCd     = $('#series_code').val(); 
      var rakeNo       = $('#rake_No').val(); 
      var fromDate     = $('#from_date').val(); 
      var toDate       = $('#to_date').val(); 
      var acctCd       = $('#acct_code').val(); 
      var postCd       = $('#post_code').val(); 
      var itemCd       = $('#itemCodeId').val(); 
      var fso_No       = $('#sale_order_no').val(); 
      var saleOrderHid = $('#saleorderHid').val(); 
      var toDate       = $('#to_date').val();
      console.log('fromDate fg',fromDate);
      if(seriesCd){
          if(acctCd){
            if(postCd){
              if(itemCd){
                if(saleOrderHid){
                  if (fromDate) {
                    if(toDate){

                      $('#billTable').DataTable().destroy();
                      load_data_query(rakeNo,fromDate,toDate,acctCd,itemCd,saleOrderHid);
                      $('#vr_date,#series_code,#acct_code,#acct_address,#rake_No,#from_date,#to_date,#itemCodeId,#sale_order_no').prop('readonly',true);
                      $('#reqFieldMsg').html('');
                    }else{
                      $('#reqFieldMsg').html('');
                      $('#reqFieldMsg').html('To Date Is Required .... !');
                    }
                  }else{
                    $('#billTable').DataTable().destroy();
                    load_data_query(rakeNo,fromDate,toDate,acctCd,itemCd,saleOrderHid);
                    $('#vr_date,#series_code,#acct_code,#acct_address,#rake_No,#from_date,#to_date,#itemCodeId,#sale_order_no').prop('readonly',true);
                    $('#reqFieldMsg').html('');
                  }
                }else{
                  $('#reqFieldMsg').html('* All Fields Is Required .... !');
                }
              }else{
                $('#reqFieldMsg').html('* All Fields Is Required .... !');
              }
            }else{
              $('#reqFieldMsg').html('* All Fields Is Required .... !');
            }
          }else{
            $('#reqFieldMsg').html('* All Fields Is Required .... !');
          }
      }else{
        $('#reqFieldMsg').html('* All Fields Is Required .... !');
      }

    });

  });

  //load_data_query();

  function load_data_query(rakeNo='',fromDate='',toDate='',acctCd='',itemCd='',saleOrderHid=''){

    $('#billTable').DataTable({

        processing: true,
        serverSide: true,
        // scrollX: true,
        pageLength:'100',
       
        ajax:{
          url:'{{ url("/transaction/c-and-f/search-bill-data") }}',
          data: {rakeNo:rakeNo,fromDate:fromDate,toDate:toDate,acctCd:acctCd,itemCd:itemCd,saleOrderHid:saleOrderHid}
        },

        columns: [

            { 
              render: function (data, type, full, meta){
                return full['ITEM_NAME']+'<br>'+full['REMARK'];
              }
            },
            { 
              data:'NET_WEIGHT',
              name:'NET_WEIGHT',
              className:'rightcontent'
            },
            { 
              data:'SO_RATE',
              name:'SO_RATE',
              className:'rightcontent'
            },
            { 
              render: function (data, type, full, meta){

                $('#pfctCode').val(full['PFCT_CODE']);
                $('#pfctName').val(full['PFCT_NAME']);
                $('#plantCode').val(full['PLANT_CODE']);
                $('#plantName').val(full['PLANT_NAME']);
                $('#itemCode').val(full['ITEM_CODE']);
                $('#itemName').val(full['ITEM_NAME']);
                $('#remarkName').val(full['REMARK']);
                $('#netWeight').val(full['NET_WEIGHT']);
                $('#soRate').val(full['SO_RATE']);
                $('#rakeDate').val(full['RAKE_DATE']);
                $('#placeDate').val(full['PLACE_DATE']);
                $('#rakeNo').val(full['RAKE_NO']);
                
                var netWeight = parseFloat(full['NET_WEIGHT']);
                var qty = parseFloat(full['QTY']);
                var so_rate = parseFloat(full['SO_RATE']);
                var amount = qty * so_rate;

                $('#basic').val(amount.toFixed(2));

                return amount.toFixed(2);

              },
              className:'rightcontent'
            },

        ],
    });


    setTimeout(function() {
        getTaxAgainstItemfromSo();
    }, 500);

  }/* /. LOAD DATA FUN*/

  function getTaxAgainstItemfromSo(){

    console.log('hii');

    var itemCd       = $('#itemCodeId').val();
    var saleOrderHid = $('#saleorderHid').val();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

          url:'{{ url("get-tax-code-from-sale-order-against-item") }}',

          method : "POST",

          type: "JSON",

          data: {itemCd:itemCd,saleOrderHid:saleOrderHid},

          success:function(data){

            var data1 = JSON.parse(data);
             console.log('data1',data1);
              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                if(data1.tax_Code ==''){

                }else{
                  $('#taxCode').val(data1.tax_Code[0].TAX_CODE);                 
                  $('#tax_name').val(data1.tax_Code[0].TAX_NAME);                 
                  $('#itemHSNCd').val(data1.tax_Code[0].HSN_CODE);                 
                  $('#itemHSNNm').val(data1.tax_Code[0].HSN_NAME);                 
                }

              }

          }

    });
    
  }

  function getvrnoBySeries(){

      var series_Code = $('#series_code').val();

      var xyz = $('#seriesList option').filter(function() {
        return this.value == series_Code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#series_code').val('');
        $('#vrseqnum').val('');
        $('#series_name').val('');
      }else{
        $('#vrseqnum').val('');
        $('#series_name').val(msg);
      }

      var seriesCode = $('#series_code').val();
      var transcode  = $('#trans_code').val();

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

            }else if(data1.response == 'success'){

                if(data1.vrno_series == ''){

                }else{
                    if(data1.vrno_series){
                        var getlastno = data1.vrno_series.LAST_NO;
                        var lastNo = parseInt(getlastno) +  parseInt(1);
                        $('#vrseqnum').val(lastNo);
                    }else{
                        var getlastno = '';
                    }

                    if(data1.data ==''){

                    }else{

                           // alert(data1.data[0].GL_CODE);

                        $("#seriesgl_code").val(data1.data[0].GL_CODE);
                        $("#seriesgl_name").val(data1.data[0].GL_NAME);
                    }
                }

            } /* /. success */
         } /* /. success function */
    }); /* /. ajax function */
  } /* /. main function */

  function fetchDataForBill(){

    var accCode      = $('#acct_code').val();
    var saleorderHid = $('#saleorderHid').val();

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url:"{{ url('/fetch-data-on-c-and-f-bill-tran') }}",

        method : "POST",

        type: "JSON",

        data: {accCode:accCode,saleorderHid:saleorderHid},

        success:function(data){
         
          var data1 = JSON.parse(data);
                
          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
          }else if(data1.response == 'success'){

            if(data1.gl_data == ''){

            }else{
              $('#post_code').val(data1.gl_data[0].GL_CODE+'['+data1.gl_data[0].GL_NAME+' ]');
              //$('#taxCode').val(data1.gl_data[0].TAX_CODE);
              //$('#tax_name').val(data1.gl_data[0].TAXNAME);
            }

            if(data1.fsoNo_list == ''){

            }else{
              
              $("#saleNo_List").empty();
              $.each(data1.fsoNo_list, function(k, getData){

                var  fyYear = getData.FY_CODE;
                var  splitData = fyYear.split('-');
                var fy_code = splitData[0];

                $("#saleNo_List").append($('<option>',{

                  value:fy_code+' '+getData.SERIES_CODE+' '+getData.VRNO,

                  'data-xyz':getData.SORDERHID,
                  value:fy_code+' '+getData.SERIES_CODE+' '+getData.VRNO,

                }));
                
              });

            }


            if(data1.rakeNo_list == ''){

            }else{

              $("#rakeNoList").empty();
              $.each(data1.rakeNo_list, function(k, getData){

                $("#rakeNoList").append($('<option>',{

                  value:getData.RAKE_NO,

                  'data-xyz':getData.RAKE_NO,
                  value:getData.RAKE_NO,

                }));
                
              });
            }

            if(data1.address_list == ''){

            }else{

              $("#accaddressList").empty();
              $.each(data1.address_list, function(k, getData){

                $("#accaddressList").append($('<option>',{

                  value:getData.ADD1,

                  'data-xyz':getData.CPCODE,
                  value:getData.ADD1,

                }));
                
              });
            }

            if(data1.item_list == ''){

            }else{

              $("#itemCodeList").empty();
              $.each(data1.item_list, function(k, getData){

                $("#itemCodeList").append($('<option>',{

                  value:getData.ITEM_CODE,

                  'data-xyz':getData.ITEM_NAME,
                  text:getData.ITEM_NAME,

                }));
                
              });
            }

          }/* -- /. success codn*/

        } /* --- /. success function*/

    }); /* /. AJAX FUNCTION*/

  } /* /.MAIN FUNCTION */

  function billSimulation(){

    $('#simulation_model').modal('show');

    var accGl         = $('#post_code').val();
    var splitaccGl    = accGl.split('[');
    var accGl_code    = splitaccGl[0];
    var accGl_name    = splitaccGl[1];
    var seriesGl_code = $('#seriesgl_code').val();
    var grandAmount   = $('#getNetAmnt').val();
    var accCode       = $('#acct_code').val();
    var accName       = $('#acct_name').val();

    var taxIndCode    = [];
    var rate_indName  = [];
    var af_rate       = [];
    var amount        = [];
    var taxGlCode     = [];

    $('input[name^="taxIndCode"]').each(function (){
          taxIndCode.push($(this).val());
    });

    $('input[name^="rate_ind"]').each(function (){
          rate_indName.push($(this).val());
    });

    $('input[name^="af_rate"]').each(function (){
          af_rate.push($(this).val());
    });

    $('input[name^="amountTax"]').each(function (){
          amount.push($(this).val());
    });

    $('input[name^="taxGlCode"]').each(function (){
          taxGlCode.push($(this).val());
    });

    $.ajax({

      url:"{{ url('transaction/c-and-f/simulation-for-c-and-f-bill') }}",
      method : "POST",
      type: "JSON",
      data: {accGl_code:accGl_code,seriesGl_code:seriesGl_code,taxIndCode:taxIndCode,rate_indName:rate_indName,af_rate:af_rate,amount:amount,taxGlCode:taxGlCode,grandAmount:grandAmount},
      success:function(data){

        var data1 = JSON.parse(data);
                  
        if (data1.response == 'error') {
          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
        }else if(data1.response == 'success'){

          $('#siml_body').empty();

          var headData ="<tr><th>Gl/Acc Code</th> <th>Gl/Acc Name</th> <th>Debit-DR</th> <th>Credit-CR</th> <th>Ref Code</th> <th>Ref Name</th></tr>";

          $('#siml_body').append(headData);

          var drTotal=0;
          var crTotal=0; 
          $.each(data1.data_tax, function(k, getData) {

            if(getData.IND_ACC_CODE){
              var accGl = getData.IND_ACC_CODE;
              var accglName = accGl_name;
            }else if(getData.IND_GL_CODE){
              var accGl = getData.IND_GL_CODE;
              var accglName = getData.GL_NAME;
            }else{
              var accGl = '--';
              var accglName = '--';
            }

            drTotal +=parseFloat(getData.DR_AMT);
            crTotal +=parseFloat(getData.CR_AMT);

            var bodyData = "<tr><td class='tdthtablebordr textLeft'>"+accGl+"</td>"+
                                "<td class='tdthtablebordr textLeft'>"+accglName+"</td>"+
                                "<td class='tdthtablebordr textRight'>"+getData.DR_AMT+"</td>"+
                                "<td class='tdthtablebordr textRight'>"+getData.CR_AMT+"</td>"+
                                "<td class='tdthtablebordr textRight'>"+accCode+"</td>"+
                                "<td class='tdthtablebordr textRight'>"+accName+"</td>";
                              
            $('#siml_body').append(bodyData);

          }); /* /. EACH LOOP*/

          var footerData = "<tr>"+
                        "<td colspan='2' class='tdthtablebordr textRight'><b>Total : </b></td>"+
                        "<td class='tdthtablebordr textRight'><b>"+drTotal.toFixed(2)+"</b></td>"+
                        "<td class='tdthtablebordr textRight'><b>"+crTotal.toFixed(2)+"</b></td><td  class='tdthtablebordr textRight'></td><td class='tdthtablebordr textRight'></td></tr>";
                                
          $('#siml_body').append(footerData);

        }/* /. SUCCESS CODN*/

      }/* /. SUCCESS FUNCTION*/

    }); /* /. AJAX FUNCTION*/

  }/* /. SIMULATION*/

  function submitBillGenerateData(valDwn){

    var isTaxApply = $('#aplytaxOrNot1').html();

    if(isTaxApply == 1){

        $('#taxNotApply').html('');

        var downloadFlg = valDwn;
        $('#pdfYesNoStatus').val(downloadFlg);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var data = $("#saleBillForm").serialize();

        $.ajax({

              type: 'POST',
              url: "{{ url('transaction/c-and-f/save-C-and-F-bill-tran') }}",
              data: data, // here $(this) refers to the ajax object not form
              success: function (data) {
                console.log('data',data);
                var data1 = JSON.parse(data);

                if(data1.response=='error'){

                    var responseVar =false;
                    var url = "{{ url('/transaction/Logistic/c-and-f-bill-msg') }}"
                    setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                    var responseVar =true;

                    if(downloadFlg == 1){
                      var ulrLenght = data1.url.length;
                      var fileN     = 'CANDFBILL_'+downloadFlg;
                      var link      = document.createElement('a');
                      link.href = data1.url;
                      link.download = fileN+'.pdf';
                      link.dispatchEvent(new MouseEvent('click'));
                    }

                    var url = "{{ url('/transaction/Logistic/c-and-f-bill-msg') }}"
                    setTimeout(function(){ window.location = url+'/'+responseVar; });

                }

              }/* /. SUCCESS FUNCTION*/

        });/* /. AJAX FUNCTION*/

    }else{

      $('#taxNotApply').html('The Tax Has Not Been Applied');
    }

  }/* /.MAIN FUNCTION */
  
</script>

@endsection