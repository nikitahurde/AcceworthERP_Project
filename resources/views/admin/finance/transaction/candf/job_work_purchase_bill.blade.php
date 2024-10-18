@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')
<style type="text/css">

    .tdsratebtnHide{
      display: none;
    }
    .PageTitle{
      margin-right: 1px !important;
    }
    .required-field::before {
      content: "*";
      color: red;
    }
    .textRight{
      text-align: right;
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
    .tdthtablebordr{
      border: 1px solid #00BB64;
    }
    .modltitletext{
      font-weight: 800;
      color: #5696bb;
      text-align: center;
      font-size: 16px;
    }
    .aplynotStatus{
      display: none;
    }
    .inputtaxInd{
      background-color: white !important;
      border: none;
      text-align: center;
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
    .alignRightClass{
      text-align: right;
    }
    .alignCenterClass{
      text-align: center;
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
    ::placeholder {
      text-align:left;
    }
    .inputBoxT{
      width:100%;
      font-size:12px;
    }
    .applyBTn{
      margin-top: 7px;
    }
    .iconBtnSty{
      border-radius: 100px;
      padding: 4px;
    }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>
       Job Work Purchase Bill
      <small> : Report Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report</a></li>

      <li><a href="{{ url('/dashboard') }}">C and F</a></li>

      <li class="active"><a href="{{ url('/report/purchase/purchase-indent-report') }}">Job Work Purchase Bill</a></li>

    </ol>

  </section><!-- --sectio -->

  <section class="content" style="min-height: 150px;margin-bottom: -26px;">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Job Work Purchase Bill</h2>

      </div><!-- /.box-header -->

      <div class="box-body">

        <?php date_default_timezone_set('Asia/Kolkata'); ?>

        <div class="row">

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1"> From Date : </label>

              <div class="input-group">

                <div class="input-group-addon">

                  <i class="fa fa-calendar"></i>

                </div>
              
                <?php $currentDate = date('d-m-Y'); ?>
                <input type="text" name="from_date" id="from_date" class="form-control fromDatePc rightcontent datepicker" placeholder="Select From Date" value="<?= $currentDate; ?>" autocomplete="off">

              </div>

              <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>

              <small id="show_err_from_date"></small>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1"> To Date : </label>

              <div class="input-group">

                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
              
                <input type="text" name="to_date" id="to_date" class="form-control toDatePc rightcontent datepicker" placeholder="Select To Date" value="" autocomplete="off">

              </div>

              <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>

              <small id="show_err_to_date"></small>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1"> Date : </label>

              <div class="input-group">

                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
              
                <input type="text" name="vr_date" id="vr_date" class="form-control toDatePc rightcontent datepicker" placeholder="Select Date" value="{{$currentDate}}" autocomplete="off">

              </div>

              <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>

              <small id="show_err_to_date"></small>

            </div>

          </div><!-- /.col -->

         <!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">U/L Contractor Code : <span class="required-field"></span></label>

              <div class="input-group">

                <div class="input-group-addon">
                  <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                </div>
                <input list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Account Code" autocomplete="off">

                <datalist id="accountList">

                  <option selected="selected" value="">-- Select --</option>

                  <?php foreach ($acc_list_data as $key) { ?>

                     <option value="<?= $key['ACC_CODE'] ?>" data-xyz="<?= $key['ACC_NAME'] ?>"><?= $key['ACC_CODE'] ?> <?= $key['ACC_NAME'] ?></option>
                      
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

              <label for="exampleInputEmail1">U/L Contractor Name : <span class="required-field"></span></label>

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

              <label for="exampleInputEmail1">Post Code : <span class="required-field"></span></label>

                <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input list="postCodeList" id="post_code" name="post_code" class="form-control  pull-left" value="" placeholder="Select Post Code" autocomplete="off">

                    <datalist id="postCodeList">
                      
                    </datalist>

                    <input type="hidden" id="post_name" name="post_name" class="form-control  pull-left" value="" placeholder="Select Post Name" autocomplete="off">

                </div>

                <small id="post_name_text" style="color: #3c8dbc;font-weight: bold;"></small>
            </div>

          </div><!-- /.col  -->
              
        </div><!-- /.row -->

        <div class="row">
    
          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Trans Code : <span class="required-field"></span></label>

              <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                  </div>

                  <input type="text" id="trans_code" name="trans_code" class="form-control  pull-left" value="<?= $tran_list->TRAN_CODE ?>" placeholder="Select Trans Code" readonly autocomplete="off">

              </div>

            </div>

          </div><!-- /.col -->


          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Purchase Order No : <span class="required-field"></span></label>

              <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                  </div>

                  <input list="saleNo_List" id="sale_order_no" name="sale_order_no" class="form-control  pull-left" value="" placeholder="Select Trans Code"  autocomplete="off">

                  <datalist id="saleNo_List">
                    
                  </datalist>

              </div>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Series Code : <span class="required-field"></span></label>

              <div class="input-group">

              
                  
                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                  </div>

                   <input list="seriesList" id="series_code" name="series_code" class="form-control  pull-left" value="" placeholder="Select Series Code" autocomplete="off">
                   <datalist id='seriesList'>

                      <?php foreach ($series_list as $key) { ?>

                           <option value="<?= $key->SERIES_CODE ?>" data-xyz='<?= $key->SERIES_NAME ?>'><?= $key->SERIES_CODE ?> - <?= $key->SERIES_NAME ?></option>

                      <?php } ?>
                      

                   </datalist>

                   <input type="hidden" id="seriesGlCd" name="seriesGlCd" class="form-control  pull-left" value=""  readonly>

                   <input type="hidden" id="seriesGlName" name="seriesGlName" class="form-control  pull-left" value=""  readonly>

             

              </div>

              <input type="hidden" id="pfct_code" name="pfct_code" class="form-control  pull-left" value=""  readonly>

              <input type="hidden" id="pfct_name" name="pfct_name" class="form-control  pull-left" value=""  readonly>

              <input type="hidden" id="vrdate" name="vrdate" class="form-control  pull-left" value=""  readonly>

            </div>

          </div><!-- /.col -->

          <div class="col-md-2">

            <div class="form-group">

              <label for="exampleInputEmail1">Series Name : <span class="required-field"></span></label>

              <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                  </div>

                  
                   <input type="text" id="series_name" name="series_name" class="form-control  pull-left" value="" placeholder="Select Series Name" readonly>

               

              </div>

            </div>

          </div><!-- /.col -->

          <div class="col-md-3">

            <div style="margin-top: 5%;">

              <button type="button" class="btn btn-primary btn-sm" name="searchdata" id="btnsearch" style="padding:0px 2px;"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

              <button type="button" class="btn btn-default btn-sm" name="searchdata" id="ResetId" style="padding:0px 2px;" ><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

            </div>

          </div><!-- /.col -->

        </div><!-- /.row -->

      </div><!-- /.box-body -->

    </div><!-- /.custom box -->

<!----- START : TAX CALC MODAL -------->

     

<!----- END : TAX CALC MODAL -------->

<!-- ------ SIMULATION MODAL ------------  -->
  
  <div class="modal fade in" id="simulation_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">

    <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

      <div class="modal-content" style="border-radius: 5px;">

        <div class="modal-header">

          <div class="row">

            <div class="col-md-12">

              <h5 class="modal-title settaxcodemodel" style="text-align: center;" id="exampleModalLabel">Simulation A/c Ledger</h5>

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

</section>

<section class="content">

  <div class="box box-primary Custom-Box">

    <div class="box-header with-border" style="text-align: center;"></div>

    <form id="saleBillForm">

    <div class="box-body" style="margin-top: -2%;">


      <table id="TransportBillTable" class="table table-bordered table-striped table-hover">

          <thead class="theadC">

            <tr>
              <th class="text-center">Sr.No</th>
              <th class="text-center">U/L Contractor Code </th>
              <th class="text-center">U/L Contractor Name  </th>
              <th class="text-center">JW ITEM CODE</th>
              <th class="text-center">JW ITEM NAME</th>
              <th class="text-center">Qty</th>
              <th class="text-center">Rate</th>
              <th class="text-center">Amount</th>
                 
            </tr>

          </thead>

          <tbody id="defualtSearch">

          </tbody>
   
          <tfoot align="right">
            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
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
              <input list="taxList"  id="taxCode" name="taxCode" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Tax Code"> 

              <datalist id="taxList">

                <option selected="selected" value="">-- Select --</option>
                @foreach ($taxList as $key)
                <option value='<?php echo $key->TAX_CODE?>'   data-xyz ="<?php echo $key->TAX_NAME; ?>" ><?php echo $key->TAX_NAME ; echo " [".$key->TAX_CODE."]" ; ?></option>
                @endforeach

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
            <button type="button" class="btn btn-primary btn-xs" id="CalcTax1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTax(1);getGrandTotal(1);" disabled>Calc Tax </button>
            <input type="hidden" value="0" name="taxDataCount" id="data_count1">
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

          <input type="hidden" name="basicValue" id="basic">
          <input type="hidden"  name="NetAmnt"  id="getNetAmnt">
          <input type="hidden"  name="acctCode"  id="acctCode">
          <input type="hidden"  name="acctName"  id="acctName">
          <input type="hidden"  name="PostCode"  id="PostCode">
          <input type="hidden"  name="PostName"  id="PostName">
          <input type="hidden"  name="vrDate"  id="vrDate">
          <input type="hidden"  name="seriesName"  id="seriesName">
          <input type="hidden"  name="seriesCode"  id="seriesCode">
          <input type="hidden"  name="transCode"  id="transCode">
          <input type="hidden"  name="series_gl"  id="series_gl">

          <div class="col-md-12" style="text-align: center;">

            <button class="btn btn-primary" type="button" id="simulation" onclick="billSimulation()"  style="font-size: 12px;line-height: 1;padding: 4px;" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Simulation</button>

            <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">

             <!-- <button type="submit" name="submit" value="submit" id="submitinparty" class='btn btn-success btn-sm' onclick="submitBillGenerate(0)" disabled="" style="font-size: 12px;line-height: 1;padding: 4px;">Save</button>  -->

             <button type="button" name="submit" value="submit" id="submitinparty" class='btn btn-success btn-sm' onclick="submitBillGenerateData()"  style="font-size: 12px;line-height: 1;padding: 4px;">Save</button> 

            <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();" style="font-size: 12px;line-height: 1;padding: 4px;"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

         <!--    <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitBillGenerate(1)" disabled style="font-size: 12px;line-height: 1;padding: 4px;"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button> -->
          </div>

      </div>

    </div><!-- /.box-body -->
  </form>
        
  </div><!-- /.custom box -->

</section><!-- /.section -->

</div>

<!------- MODAL FOR CALCULATE TDS ------------>

      <div class="modal fade" id="tdsrate_cal_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document" style="margin-top: 13%;">
          <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
              <h5 class="modal-title modltitletext" id="exampleModalLabel">Calculate TDS</h5>
            </div>
            <div class="modal-body">
              <div class="row tdsInputBox">
                  <div class="col-md-6">
                    <label class="textSizeTdsModl">Tds Section</label>
                    
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="inputBoxT" id="tds_name1" name="tds_section[]" value="" style="margin-bottom:3px;" readonly>
                  </div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-6">
                    <label class="textSizeTdsModl">Tds Rate</label>
                    
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="inputBoxT" id="tdsRate1" name="tdsRates[]" readonly style="text-align: right;margin-bottom:3px;">
                  </div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-6">
                    <label class="textSizeTdsModl" style="line-height: 0.7;">Tds Base Amount</label>
                    
                  </div>
                  <div class="col-md-6">
                    <input type="hidden" id="tds_base_Amt1" name="baseTDSAmt[]" value="">
                    <input type="text" class="inputBoxT" id="Net_amount1" readonly style="text-align: right;margin-bottom:3px;">
                  </div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-6">
                    <label class="textSizeTdsModl" style="line-height: 0.7;">Tds Amount calculate</label>
                    
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="inputBoxT" id="tds_Amt_cal1" readonly style="text-align: right;margin-bottom:3px;">
                  </div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-6">
                    <label class="textSizeTdsModl">Net Amount</label>
                    
                  </div>
                  <div class="col-md-6">
                    <input type="text" class="inputBoxT" id="deduct_tds_Amt1" readonly name="base_amt_tds[]" style="text-align: right;margin-bottom:3px;">
                  </div>
              </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-primary" data-dismiss="modal" id="ApplyTds1" onclick="Applytds(1)">Apply TDS</button>
              <button type="button" class="btn btn-warning" data-dismiss="modal" onclick="cancleBtntds(0)">Cancle</button>
            </div>
          </div>
        </div>
      </div>

<!------- MODAL FOR CALCULATE TDS ------------>
 
@include('admin.include.footer')

<script type="text/javascript">

  /* ---------- VEHICLE TYPE CHANGE ----------- */

  function vehicleTypeFun(){

    var vehicle_Type = $("input[type='radio'][name='vehicle_type']:checked").val();
    $('#vehicleTypeset').val(vehicle_Type);

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url:"{{ url('/finance/get-post-code-by-account-code') }}",

        method : "POST",

        type: "JSON",

        data: {vehicle_Type:vehicle_Type},

        success:function(data){
         
          var data1 = JSON.parse(data);
                
          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
          }else if(data1.response == 'success'){

            if(data1.data_vehicle_list==''){
                
            }else{
              $("#vehicleList").empty();
              $.each(data1.data_vehicle_list, function(k, getData){

                $("#vehicleList").append($('<option>',{

                  value:getData.VEHICLE_NO,

                  'data-xyz':getData.VEHICLE_NO,
                  text:getData.VEHICLE_NO+' - '+getData.ACC_NAME+' - '+getData.TO_PLACE

                }));
                
              });

            }

          }/* -- /. success codn*/

        } /* --- /. success function*/

    });


  }

  /* ---------- VEHICLE TYPE CHANGE ----------- */

  /* ---------------- when click on cal tds button ------------- */

  function CalculateTdsRate(TdsId){   
   
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var tdsCode    = $('#tdsOfAccCode').val();
    var acCode     = $('#acct_code').val();

    $.ajax({

        url:"{{ url('/tds-rate-calculate') }}",

        method : "POST",

        type: "JSON",

        data: {tdsCode: tdsCode,acCode:acCode},

        success:function(data){

          var data1 = JSON.parse(data);
                               
          if (data1.response == 'error') {

              $('#tdsrate_cal_model').modal('toggle'); 

              $('#tds_rate'+TdsId).prop('disabled',true);

              $('#appliedbtn'+TdsId).html('<small class="label label-danger">TDS Not Found...!</small></div>');                      

          }else if(data1.response == 'success'){

              $('#tds_name'+TdsId).val(data1.tds_name[0].TDS_CODE+' - '+data1.tds_name[0].TDS_NAME);
              $('#GettdsglCode').val(data1.tds_name[0].GL_CODE);
              $('#tdsRate'+TdsId).val(data1.data[0].TDS_RATE);

              var amount =  parseFloat($('#basic').val());
              
              $('#tds_base_Amt'+TdsId).val(amount);
              $('#Net_amount'+TdsId).val(amount);
              
              var tdsRateval = parseFloat($('#tdsRate'+TdsId).val());
              var tdsbaseamtval = parseFloat($('#tds_base_Amt'+TdsId).val());

              var calculatPercnt = tdsbaseamtval / 100 * tdsRateval;

              $('#tds_Amt_cal'+TdsId).val(calculatPercnt.toFixed(2));
              var deductBAmtWTdsAmt = tdsbaseamtval - parseFloat(calculatPercnt);
              $('#deduct_tds_Amt'+TdsId).val(deductBAmtWTdsAmt.toFixed(2));
              
          }
        }

    });  
  }

  function Applytds(aply){
    $('#isTdsAply').val(aply);

    var cutTdsAmt = $('#tds_Amt_cal1').val();
    var netAmtAfterTdsCute = $('#deduct_tds_Amt1').val();

    var tdsAplyVal = $('#isTdsAply').val();

    if(tdsAplyVal == 1){
      $('#tdsdeductAmt').val(cutTdsAmt);
      $('#netAmtFortds').val(netAmtAfterTdsCute);
      $('#tdsappliedbtn1').html('<small class="label label-success iconBtnSty"><i class="fa fa-check"></i></small>');
      $('#tdscanclebtn1').html('');
    }

  }

  function cancleBtntds(cancle){
    $('#isTdsAply').val(cancle);
    $('#tdsdeductAmt').val(cancle);
    $('#netAmtFortds').val(cancle);
    $('#tdscanclebtn1').html('<small class="label label-danger iconBtnSty"><i class="fa fa-times"></i></small>');
    $('#tdsappliedbtn1').html('');
  }

/* ---------------- when click on cal tds button ------------- */
  
  $("#acct_code").on('change', function () {  

    var val = $(this).val();
    var acc_code = $("#acct_code").val();
    var vr_date = $("#vr_date").val();

    var vehicle_Type = $("input[type='radio'][name='vehicle_type']:checked").val();

    var xyz = $('#accountList option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){

      $("#acct_code").val('');
      $("#acct_name").val('');
      $("#post_code").val('');
      $("#post_name").val('');
      $("#post_name_text").html('');
      $("#pfct_code").val('');
      $("#pfct_name").val('');
      $("#vrdate").val('');
       $('#tds_rate').addClass('tdsratebtnHide');

    }else{


      $('#tds_rate').removeClass('tdsratebtnHide');

      $("#acct_name").val(msg);
      $("#acctCode").val(acc_code);
      $("#acctName").val(msg);
      $("#vrDate").val(vr_date);

        $.ajax({

          url:"{{ url('/finance/get-post-code-by-account-code-jbitem-purbill') }}",

          method : "POST",

          type: "JSON",

          data: {acc_code:acc_code},

          success:function(data){
           
            var data1 = JSON.parse(data);
                  
            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
            }else if(data1.response == 'success'){

              if(data1.data_sale==''){


              }else{

                $.each(data1.data_sale, function(k, getData){

                      var  fyYear = getData.FYCODE;
                      var  splitData = fyYear.split('-');
                      var fy_code = splitData[0];

                      $("#saleNo_List").append($('<option>',{

                        value:fy_code+' '+getData.SERIESCODE+' '+getData.VRNO,

                        'data-xyz':getData.VRNO,
                        text:fy_code+' '+getData.SERIESCODE+' '+getData.VRNO

                      }));
                      
                    })

              }

              if(data1.data==''){

              }else{
                var post_code = data1.data.GL_CODE;
                var post_name = data1.data.GL_NAME;

                $("#PostCode").val(post_code);
                $("#PostName").val(post_name);
                console.log('post_code',post_code);

              //  $('#tdsOfAccCode').val(data1.data.TDS_CODE);

                if(post_code==null || post_code==''){

                    $.each(data1.multiple_data, function(k, getData){

                      $("#postCodeList").append($('<option>',{

                        value:getData.GL_CODE,

                        'data-xyz':getData.GL_NAME,
                        text:getData.GL_CODE

                      }));
                      
                    })

                   $("#post_code").prop('readonly',false);

                }else{

                  $("#post_code").val(post_code);
                  $("#post_name").val(post_name);
                  $("#post_name_text").html(post_name);
                  $("#post_code").prop('readonly',true);

                }
              }
              
              if(data1.data_tds == ''){
               $('#tds_rate').addClass('tdsratebtnHide');
              }else{
                $('#tds_rate').removeClass('tdsratebtnHide');
              }

            }/* -- /. success codn*/

          } /* --- /. success function*/

        });

    } 

  });


  function getAccVehicle(){

      var val = $("#vehicle_no").val();

      var xyz = $('#vehicleList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      console.log('msg',msg);
      if(msg=='No Match'){
        $("#vehicle_no").val('');
        $("#acct_code").val('');
        $("#acct_name").val('');
        $("#pfct_code").val('');
        $("#pfct_name").val('');
        $("#vrdate").val('');
        $("#post_code").val('');
        $("#post_name").val('');
        $("#post_name_text").html('');
        $('#tds_rate').addClass('tdsratebtnHide');

      }else{
        $('#tds_rate').removeClass('tdsratebtnHide');

          var vehicle_no = $("#vehicle_no").val();
          var vehicle_Type = $("input[type='radio'][name='vehicle_type']:checked").val();

          $.ajax({

            url:"{{ url('/finance/get-post-code-by-vehicle') }}",

            method : "POST",

            type: "JSON",

            data: {vehicle_no:vehicle_no,vehicle_Type:vehicle_Type},

            success:function(data){
            
              var data1 = JSON.parse(data);
                    
              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>"); 
   
                $("#acct_code").val('');
                $("#acct_name").val('');
                $("#pfct_code").val('');
                $("#pfct_name").val('');
                $("#vrdate").val('');
                $("#post_code").val('');
                $("#post_name").val('');
                $("#post_name_text").html('');

              }else if(data1.response == 'success'){

                if(data1.data_acc_list == ''){

                }else{

                  if(vehicle_Type == 'SELF'){

                    $("#accountList").empty();
                    $.each(data1.data_acc_list, function(k, getData){

                      $("#accountList").append($('<option>',{

                        value:getData.ACC_CODE,
                        'data-xyz':getData.ACC_NAME,
                        text:getData.ACC_NAME

                      }));
                            
                    });

                  }else if(vehicle_Type == 'MARKET'){

                    $("#accountList").empty();

                    $.each(data1.data_acc_list, function(k, getData){

                      $("#accountList").append($('<option>',{

                        value:getData.TRANSPORT_CODE,
                        'data-xyz':getData.TRANSPORT_NAME,
                        text:getData.TRANSPORT_NAME+' - '+getData.VEHICLE_NO+' - '+getData.TO_PLACE

                      }));
                            
                    });

                  }
                  
                }

              }/* -- /. success codn*/

            } /* --- /. success function*/

        });/* /.ajax*/
      }

      

  }

  $('#taxCode').on('change',function(){

      var taxCd =  $('#taxCode').val();
      var xyz = $('#taxList option').filter(function() {

        return this.value == taxCd;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#taxCode').val('');
        $('#tax_name').val('');
        $('#CalcTax1').prop('disabled',true);
      }else{
        $('#tax_name').val(msg);
        $('#CalcTax1').prop('disabled',false);
      }

    });

    $('#post_code').on('change',function(){

      var taxCd =  $('#post_code').val();

      var xyz = $('#postCodeList option').filter(function() {

        return this.value == taxCd;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){

        $('#post_code').val('');
        $('#post_name').val('');

      }else{

        $('#post_name').val(msg);
        $('#post_name_text').html(msg);
        
      }

    });


     $('#series_code').on('change',function(){

      var seriesCode =  $('#series_code').val();
      var transcode =  $('#trans_code').val();

      var xyz = $('#seriesList option').filter(function() {

        return this.value == seriesCode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){

        $('#series_code').val('');
        $('#series_name').val('');
        $('#seriesName').val('');
        $('#seriesCode').val('');

      }else{

        $('#series_name').val(msg);
        $('#seriesName').val(msg);
        $('#seriesCode').val(seriesCode);
        $('#transCode').val(transcode);

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

                  console.log('seriesCode',data1.glList);

                    if(data1.glList){

                      $('#series_gl').val(data1.glList[0].GL_CODE);
                     
                    }else{
                      $('#series_gl').val(getlastno);
                      
                    }

                }

            } /* /. success */
         } /* /. success function */
    });
        
 }

});

</script>

<script type="text/javascript">
  
    $(document).ready(function(){

         var creditAmount = 0;
         var grandAmt = 0;
         var totlFreightAmt = 0;
       // $('#TransportBillTable').DataTable();

        $("#TransportBillTable").on('change', function() {
          var creditAmount = 0;
          var grandAmt = 0;
          var totlFreightAmt = 0;
            var checkedCount = $("#TransportBillTable input:checked").length;
            console.log('count',checkedCount);
            if(checkedCount == 0){
              $("#simulation").prop('disabled',true);
              $("#submitinparty").prop('disabled',true);
              $("#submitdatapdf").prop('disabled',true);
              $("#tds_rate").prop('disabled',true);
            }else{
              $("#simulation").prop('disabled',false);
              $("#submitinparty").prop('disabled',false);
              $("#submitdatapdf").prop('disabled',false);
              $("#tds_rate").prop('disabled',false);
            }
           
            for (var i = 0; i < checkedCount; i++) {
              var ii= i+1;
              var amount = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[9].innerHTML;

              var vehicle_no = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[1].innerHTML;

               var freightAmt = $("#TransportBillTable input:checked")[i].parentNode.parentNode.children[7].innerHTML;
      
              if (amount != "") {
                creditAmount += parseFloat(amount);
              } else {
                creditAmount = 0;

              }

              if (freightAmt != "") {
                totlFreightAmt += parseFloat(freightAmt);
              } else {
                totlFreightAmt = 0;

              }

            }

            $("#totlFreightAmt").val(totlFreightAmt.toFixed(2));
            $("#basicTotalAmt").text(creditAmount.toFixed(2));
            $("#nextAmtTot").text(creditAmount.toFixed(2));
            $("#basic").val(creditAmount.toFixed(2));
            $("#getNetAmnt").val(creditAmount.toFixed(2));
          //  $("#netAmt").text(grandAmt.toFixed(2));
            //$("#netAmount").val(grandAmt.toFixed(2));
        });

    }); 
</script>

<script type="text/javascript">

  function billSimulation(){

      var acctCode     = $('#acctCode').val();
      var acctName     = $('#acctName').val();
      var NetAmnt      = $('#getNetAmnt').val();
      var series_gl    = $('#series_gl').val();
      var acc_glCode   = $('#PostCode').val();
      var acc_glName   = $('#PostName').val();


        var  taxIndCode =[];
        var  head_tax_ind =[];
        var  rate_ind =[];
        var  amount =[];
        var  taxGlCode =[];

       $('input[name^="taxIndCode"]').each(function (){

          taxIndCode.push($(this).val());

        });

       $('input[name^="head_tax_ind"]').each(function (){

          head_tax_ind.push($(this).val());

        });

       $('input[name^="rate_ind"]').each(function (){

          rate_ind.push($(this).val());

        });

       $('input[name^="amount"]').each(function (){

          amount.push($(this).val());

        });

        $('input[name^="taxGlCode"]').each(function (){

          taxGlCode.push($(this).val());

        });

       console.log('taxIndCode',taxIndCode);
       console.log('head_tax_ind',head_tax_ind);
       console.log('rate_ind',rate_ind);
       console.log('amount',amount);
       console.log('taxGlCode',taxGlCode);

         $('#simulation_model').modal('show');
      // return false;

       $.ajax({

          url:"{{ url('get-simulation-data-for-job-work-purchase-bill') }}",

          method : "POST",

          type: "JSON",

          data: {acctCode:acctCode,acctName:acctName,series_gl:series_gl,acc_glCode:acc_glCode,acc_glName:acc_glName,taxIndCode:taxIndCode,head_tax_ind:head_tax_ind,rate_ind:rate_ind,amount:amount,taxGlCode:taxGlCode,NetAmnt:NetAmnt},

          success:function(data){

            var data1 = JSON.parse(data);

           if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
            }else if(data1.response == 'success'){

              $('#siml_body').empty();


              var headData ="<tr><th>Gl/Acc Code</th> <th>Gl/Acc Name</th> <th>Debit-DR</th> <th>Credit-CR</th></tr>";

              $('#siml_body').append(headData);

              var drTotal = 0;
              var crTotal = 0;
              $.each(data1.data_tax, function(k, getData) {

                if(getData.IND_ACC_CODE){
                  var accGl = getData.IND_ACC_CODE;
                  var accglName = getData.ACC_NAME;
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
                                "<td class='tdthtablebordr textRight'>"+getData.CR_AMT+"</td>";
                               
                $('#siml_body').append(bodyData);
              });

              var footerData = "<tr><td colspan='2' class='tdthtablebordr textRight'><b>Total : </b></td>"+
                                "<td class='tdthtablebordr textRight'><b>"+drTotal.toFixed(2)+"</b></td>"+
                                "<td class='tdthtablebordr textRight'><b>"+crTotal.toFixed(2)+"</b></td>";
                      
              $('#siml_body').append(footerData);

            }
          }

      });

  }

</script>


<script type="text/javascript">
  function billSimulation1(){

    $('#simulation_model').modal('show');

    var rate_indName       = [];
    var af_rate            = [];
    var amount             = [];
    var taxGlCode          = [];
    var taxIndCode         = [];
    var freight_Amt        = [];
    var lessAdv_Charge     = [];
    var tripHead_id        = [];
    var chkIslessAdvCharge = [];
    var chkboxChecked      = [];

    $('.flitClass').each(function(){
        if($(this).is(":checked"))
        {
         var flitClass1 = $(this).val();


         chkboxChecked.push(flitClass1);
         
         }
    });

    $('input[name^="freightAmt"]').each(function (){
          freight_Amt.push($(this).val());

    });
    $('input[name^="chkIslessAdvCharge"]').each(function (){
          chkIslessAdvCharge.push($(this).val());
    });

    $('input[name^="lessAdvCharge"]').each(function (){
          lessAdv_Charge.push($(this).val());
    });

    $('input[name^="taxIndCode"]').each(function (){
          taxIndCode.push($(this).val());
    });

    $('input[name^="rate_ind"]').each(function (){
          rate_indName.push($(this).val());
    });

    $('input[name^="af_rate"]').each(function (){
          af_rate.push($(this).val());
    });

    $('input[name^="amount"]').each(function (){
          amount.push($(this).val());
    });

    $('input[name^="taxGlCode"]').each(function (){
          taxGlCode.push($(this).val());
    });

    $('input[name^="tripHeadid"]').each(function (){
          tripHead_id.push($(this).val());
    });

   // var checkZero = lessAdv_Charge.includes('0');
   // lessAdv_Charge.indexOf('0');
    
    var basicAmt       = $('#basic').val();
    

    var found = chkIslessAdvCharge.find(function (element) {
      return element == 1;
    });

    
    var vehicleType    = $('#vehicleTypeset').val();
    var taxRowCount    = $('#data_count1').val();
    var series_glCd    = $('#seriesGlCd').val();
    var post_code      = $('#post_code').val();
    var acct_code      = $('#acct_code').val();
    var acct_name      = $('#acct_name').val();
    var NetAmnt        = $('#getNetAmnt').val();
    var tdsApplChk     = $('#isTdsAply').val();
    var tds_deductAmt  = $('#tdsdeductAmt').val();
    var tds_gl_code    = $('#GettdsglCode').val();
    var tds_netAmt     = $('#netAmtFortds').val();
    var totlFreightAmt = $('#totlFreightAmt').val();
    var taxApplyChk    = $('#aplytaxOrNot1').html();

    if(tdsApplChk == 1){
      var partyAmt_tdsCut = tds_deductAmt;
      var partyAmt_tdsnet = tds_netAmt;
    }else{
      var partyAmt_tdsCut = totlFreightAmt;
      var partyAmt_tdsnet = 0;
    }

    if(found == 1){
      var basic_amnt = totlFreightAmt;
    }else if(found == undefined){
      var basic_amnt = basicAmt;
    }

    $.ajax({

          url:"{{ url('Transction/TransporterBill/get-simulation-data-for-trans-bil') }}",

          method : "POST",

          type: "JSON",

          data: {taxIndCode:taxIndCode,rate_indName: rate_indName,af_rate:af_rate,amount:amount,taxGlCode:taxGlCode,taxRowCount:taxRowCount,series_glCd:series_glCd,post_code:post_code,NetAmnt:NetAmnt,chkboxChecked:chkboxChecked,basic_amnt:basic_amnt,tdsApplChk:tdsApplChk,tds_deductAmt:tds_deductAmt,tds_gl_code:tds_gl_code,taxApplyChk:taxApplyChk,vehicleType:vehicleType},

          success:function(data){

            var data1 = JSON.parse(data);
                  
            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
            }else if(data1.response == 'success'){

              $('#siml_body').empty();


              var headData ="<tr><th>Gl/Acc Code</th> <th>Gl/Acc Name</th> <th>Debit-DR</th> <th>Credit-CR</th> <th>Ref Code</th> <th>Ref Name</th></tr>";

              $('#siml_body').append(headData);

              var drTotal = 0;
              var crTotal = 0;
              $.each(data1.data_tax, function(k, getData) {

                if(getData.IND_ACC_CODE){
                  var accGl = getData.IND_ACC_CODE;
                  var accglName = getData.accName;
                }else if(getData.IND_GL_CODE){
                  var accGl = getData.IND_GL_CODE;
                  var accglName = getData.glName;
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
                                "<td class='tdthtablebordr'>"+acct_code+"</td>"+
                                "<td class='tdthtablebordr'>"+acct_name+"</td></tr>";
                $('#siml_body').append(bodyData);
              });

              var footerData = "<tr><td colspan='2' class='tdthtablebordr textRight'><b>Total : </b></td>"+
                                "<td class='tdthtablebordr textRight'><b>"+drTotal.toFixed(2)+"</b></td>"+
                                "<td class='tdthtablebordr textRight'><b>"+crTotal.toFixed(2)+"</b></td>"+
                                "<td class='tdthtablebordr'><b>&nbsp;</b></td>"+
                                "<td class='tdthtablebordr'><b>&nbsp;</b></td></tr>";
              $('#siml_body').append(footerData);

            }/* -- /. success codn*/

          } /* --- /. success function*/

    }); /* -- /. ajax */

}
</script>



<script type="text/javascript">

load_data_query()
  function load_data_query(acct_code='',from_date='',to_date='',sale_order_no=''){

   
      $('#TransportBillTable').DataTable({


        footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;

              //  $( api.column(6).footer() ).html('<small class="texttotal" id="settextfot">Total :- </small><br><small class="texttotal" id="settextfot"> Net Amt :-</small>').css('text-align','right');

               // $( api.column(7).footer() ).html('<small id="basicTotalAmt"></small><br><small id="nextAmtTot"></small><input type="hidden" id="totlFreightAmt" name="totlFreightAmt" value="">');

                 var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                console.log(api.column(7));

                var rowcount = data.length;
                
                var getRow = rowcount-1;
                var opebal = api.column(7).data();
                if(opebal[getRow]){
                 var closngQty = opebal[getRow];
                }else{
                 var closngQty = 0;
                }
     
                var tueTotal = api
                  .column( 6 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
      
                var threeTotal = api
                  .column( 7 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );


                   
                    $( api.column( 6 ).footer() ).html(parseFloat(tueTotal).toFixed(2));
                    $("#basic").val(threeTotal.toFixed(2));
                    $("#getNetAmnt").val(threeTotal.toFixed(2));
                 //   $( api.column( 7 ).footer() ).html(parseFloat(threeTotal).toFixed(2));
                    $( api.column( 7 ).footer() ).html('Baisc - '+'<small id="basicTotalAmt">'+threeTotal.toFixed(2)+'</small><br>'+'Total - '+'<small id="nextAmtTot">'+threeTotal.toFixed(2)+'</small><input type="hidden" id="totlFreightAmt" name="totlFreightAmt" value="">');
            
          }, 

          processing: true,
          serverSide: true,
         // scrollX: true,
          pageLength:'100',
         
          ajax:{
            url:'{{ url("/transaction/CandF/job-work-purcahse-bill-search-data") }}',
            data: {acct_code:acct_code,from_date:from_date,to_date:to_date,sale_order_no:sale_order_no}
          },

          columns: [

            { 
              data:"DT_RowIndex",
              name:"DT_RowIndex",
              className:"text-center",
              'render': function (data, type, full, meta){
                         return full['DT_RowIndex']+'<input type="checkbox" name="flit_id[]" onclick="clickCheck()" class="flitClass" value="'+full['PORDERHID']+'" style="display:none;" checked>';
                     }
            },
            {
                data:'ACC_CODE',
                name:'ACC_CODE',
                className: "alignCenterClass",

                 render: function (data, type, full, meta){
                
                  var accCode = full['ACC_CODE']+'<input type="hidden" name="acc_code[]" value='+full['ACC_CODE']+'>';

                 
                 return accCode;

                }
            },
            {
                data:'ACC_NAME',
                name:'ACC_NAME',

                render: function (data, type, full, meta){
                
                  var accName = full['ACC_NAME']+'<input type="hidden" name="acc_name[]" value='+full['ACC_NAME']+'><input type="hidden" name="pfct_code[]" value='+full['PFCT_CODE']+'><input type="hidden" name="pfct_name[]" value='+full['PFCT_NAME']+'><input type="hidden" name="plant_code[]" value='+full['PLANT_CODE']+'><input type="hidden" name="plant_name[]" value='+full['PLANT_NAME']+'><input type="hidden" name="cfoutid[]" value='+full['CFOUTWARDID']+'><input type="hidden" name="crAmt[]" value='+full['CRAMT']+'>';

                 
                 return accName;

                }
            },
            {
                data:'JWITEM_CODE',
                name:'JWITEM_CODE',
                render: function (data, type, full, meta){
                
                  var jwitemCode = full['JWITEM_CODE']+'<input type="hidden" name="jwitem_code[]" value='+full['JWITEM_CODE']+'>';

                 return jwitemCode;

                }
            },
            {
                data:'JWITEM_NAME',
                name:'JWITEM_NAME',
                render: function (data, type, full, meta){
                
                  var jwitemName = full['JWITEM_NAME']+'<input type="hidden" name="jwitem_name[]" value='+full['JWITEM_NAME']+'>';

                 return jwitemName;

                }
            },
            {
                className: "alignRightClass",
                render: function (data, type, full, meta){
                  var QTYR     = full['DISPATCH_QTY']+'<input type="hidden" name="dispatch_qty[]" value='+full['DISPATCH_QTY']+'>';
              
                  return QTYR;
                }
            },
            {
                data:'RATE',
                name:'RATE',  
                className:'rightcontent',
                render: function (data, type, full, meta){
                  var QTYR     = full['RATE']+'<input type="hidden" name="rate[]" value='+full['RATE']+'>';
              
                  return QTYR;
                }
            },
            {
                data:'AMOUNT',
                name:'AMOUNT',
                render: function (data, type, full, meta){
                  return full['AMOUNT']+'<input type="hidden" name="freightAmt[]" value='+full['AMOUNT']+'>';
                },
                className:'rightcontent'
            }
           
          ]


      });


   }
  

  $(document).ready(function() {

    $('#lastUpdateValueId').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });


     $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

     // endDate: 'today',
      
      autoclose: 'true'

    });


   

    $('#btnsearch').click(function(){

          var from_date  =  $('#from_date').val();

          var to_date    =  $('#to_date').val();

          var acct_code  =  $('#acct_code').val();

          var sale_order_no  =  $('#sale_order_no').val();

          var order_no = sale_order_no.split(' ');
          
          var vrNo = order_no[2];
     
          if (acct_code!='' || from_date!='' || to_date!='' || sale_order_no!='') {

            
           /* if(from_date!=''){
              if(to_date==''){
                $('#show_err_to_date').html('Please select to date').css('color','red');
                return false;
              }
            }

            if(to_date!=''){
              if(from_date==''){
                $('#show_err_from_date').html('Please select from date').css('color','red');
                return false;
              }
            }*/

            $('#TransportBillTable').DataTable().destroy();

            load_data_query(acct_code,from_date,to_date,vrNo);

          }else{
            $('#TransportBillTable').DataTable().destroy();
            load_data_query();
            
          }


        });


    $('#ResetId').click(function(){
  
      $('#item_code').val('');
      $('#vr_num').val('');
      $('#accountText').html('');

    
      $('#TransportBillTable').DataTable().destroy();
      load_data_query();

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
  
  function clickCheck(){

    $('#pertText').val('');

    $('.flitClass').each(function(){

      if($(this).is(":checked")){

          var getpertText = $('#pertText').val();

          var getString = $(this).val();

         // getString.replaceAll("~", "-");
                 
          $('#pertText').val(getpertText+','+getString);
            
              var chekcValue = $(this).val();

              $("#chekcValue").val(chekcValue);

             $("#submitinparty").prop('disabled',false);
             $("#submitdatapdf").prop('disabled',false);
            
      }else{
    
      }
    });

  }
  
</script>

<script type="text/javascript">
  function submitBillGenerateData(){

    $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

         var data = $("#saleBillForm").serialize();

        var submitdataurl = "<?php echo url('/transaction/CandF/save-job-work-purchase-bill-data-jwitem'); ?>";


        $.ajax({

              type: 'POST',

              url: submitdataurl,

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                console.log(data);

                    var data1 = JSON.parse(data);

                   if(data1.response == 'error') {
                      var responseVar = false;
                      var url = "{{url('/transaction/CandF/view-job-work-pur-bill-msg')}}"
                      setTimeout(function(){ window.location = url+'/'+responseVar; });

                    }else{

                      var responseVar = true;
                      var url = "{{url('/transaction/CandF/view-job-work-pur-bill-msg')}}"
                       setTimeout(function(){ window.location = url+'/'+responseVar; });
                    }


           
              },

          });


  }

</script>

  <script type="text/javascript">
    
    function submitBillGenerate(valp){  

      var downloadFlg = valp;

      $('#pdfYesNoStatus').val(downloadFlg);

      var flitClass=[];
      var newAarry =[];

      $('.flitClass').each(function(){
          if($(this).is(":checked"))
          {
           var flitClass1 = $(this).val();


           flitClass.push(flitClass1);
           
           }
      });

      var rate_indName       = [];
      var af_rate            = [];
      var amount             = [];
      var taxGlCode          = [];
      var taxIndCode         = [];
      var chkIslessAdvCharge = [];

      $('input[name^="taxIndCode"]').each(function (){
            taxIndCode.push($(this).val());
      });

      $('input[name^="rate_ind"]').each(function (){
            rate_indName.push($(this).val());
      });

      $('input[name^="af_rate"]').each(function (){
            af_rate.push($(this).val());
      });

      $('input[name^="amount"]').each(function (){
            amount.push($(this).val());
      });

      $('input[name^="taxGlCode"]').each(function (){
            taxGlCode.push($(this).val());
      });

      $('input[name^="chkIslessAdvCharge"]').each(function (){
            chkIslessAdvCharge.push($(this).val());
      });

      var taxRowCount = $('#data_count1').val();
      var series_glCd = $('#seriesGlCd').val();
      var post_code   = $('#post_code').val();
      var acct_code   = $('#acct_code').val();
      var acct_name   = $('#acct_name').val();
      var NetAmnt     = $('#getNetAmnt').val();

      var pertText    = $('#pertText').val();

        //alert(flitClass);
       // flitClass = flitClass.toString();

        //console.log('data=> ',flitClass);

        var trans_code     = $('#trans_code').val();
        var series_code    = $('#series_code').val();
        var series_name    = $('#series_name').val();
        var seriesGlCd     = $('#seriesGlCd').val();
        var seriesGlName   = $('#seriesGlName').val();
        var partyPostCd    = $('#post_code').val();
        var partyPostName  = $('#post_name').val();
        var NetAmnt        = $('#getNetAmnt').val();
        var taxCode        = $('#taxCode').val();
        var tdsglCode      = $('#GettdsglCode').val();
        var pfct_code      = $('#pfct_code').val();
        var pfct_name      = $('#pfct_name').val();
        var vrdate         = $('#vr_date').val();
        //var vrdate         = '17-03-2022';

        var pdfYesNoStatus = $('#pdfYesNoStatus').val();

        var basicAmt       = $('#basic').val();
        var totlFreightAmt = $('#totlFreightAmt').val();
        var taxApplyChk    = $('#aplytaxOrNot1').html();
        var tdsApplyChk    = $('#isTdsAply').val();
        var tds_deductAmt  = $('#tdsdeductAmt').val();
        var vehicle_type   = $('#vehicleTypeset').val();

        var found = chkIslessAdvCharge.find(function (element) {
          return element == 1;
        });

        if(found == 1){
          var basic_amnt = totlFreightAmt;
        }else if(found == undefined){
          var basic_amnt = basicAmt;
        }

        $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        $.ajax({

          url:"{{ url('save-party-bil') }}",

           method : "POST",

           type: "JSON",

           data: {flitClass: flitClass,trans_code:trans_code,acct_code:acct_code,acct_name:acct_name,series_code:series_code,series_name:series_name,seriesGlCd:seriesGlCd,seriesGlName:seriesGlName,partyPostCd:partyPostCd,partyPostName:partyPostName,NetAmnt:NetAmnt,taxCode:taxCode,taxIndCode:taxIndCode,rate_indName: rate_indName,af_rate:af_rate,amount:amount,taxGlCode:taxGlCode,taxRowCount:taxRowCount,pdfYesNoStatus:pdfYesNoStatus,pfct_code:pfct_code,pfct_name:pfct_name,vrdate:vrdate,pertText:pertText,taxApplyChk:taxApplyChk,basic_amnt:basic_amnt,tdsApplyChk:tdsApplyChk,tds_deductAmt:tds_deductAmt,tdsglCode:tdsglCode,vehicle_type:vehicle_type},

           
           success:function(data){

           console.log(data);

              var data1 = JSON.parse(data);

              
              if(data1.response == 'error') {
                var responseVar = false;
                var url = "{{url('finance/journal_tran_msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }else{
                var responseVar = true;
                
                if(downloadFlg == 1){
                  var fyYear = data1.data[0].FY_CODE;
                  var fyCd = fyYear.split('-');
                  var seriesCd = data1.data[0].SERIES_CODE;
                  var vrNo = data1.data[0].VRNO;
                  var fileN = 'JV_'+fyCd[0]+''+seriesCd+''+vrNo;
                  var link = document.createElement('a');
                  link.href = data1.url;
                  link.download = fileN+'.pdf';
                  link.dispatchEvent(new MouseEvent('click'));
                }

                var url = "{{url('finance/journal_tran_msg')}}";
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }

            
           }

        });


    }

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
  function CalculateTax(taxid){

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
                          "<td class='tdthtablebordr'><input type='text' class='form-control numerRightAlign' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+basicheadval.toFixed(2)+"' readonly><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='0'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value=''></td>";

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
                           "<td class='tdthtablebordr'><input type='text' class='numerRightAlign form-control "+classname+"' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+taxAmt+"' oninput='getGrandTotal("+taxid+");'><input type='hidden' name='logicget[]' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='staticget[]' id='static_id_"+taxid+"_"+counter+"' value='"+staticIND+"'><input type='hidden' name='taxGlCode[]' id='tax_gl_code_"+taxid+"_"+counter+"' value='"+TAXGLCODE+"'>"+
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

    if(staticvalue==1){

      $('#aplytaxOrNot'+aplyid).html('1');
      $('#cancelbtn'+aplyid).html('');
      $('#appliedbtn'+aplyid).html('');

      var appliedbtn ='<input type="hidden" value="'+staticvalue+'" id="qltyvalue'+aplyid+'"><small class="label label-success iconBtnSty"><i class="fa fa-check"></i></small>';

      $('#appliedbtn'+aplyid).html(appliedbtn);
          
      $('#simulation').prop('disabled', false);
      $('#submitdata').prop('disabled', false);
          
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

@endsection