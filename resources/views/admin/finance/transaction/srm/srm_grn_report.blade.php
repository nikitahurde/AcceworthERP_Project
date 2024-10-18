@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.crmnavbar')



@include('admin.include.crmsidebar')
<style type="text/css">

  .datebill{
     width: 80px !important;
     text-align: right;
  }

    .tooltip{f
      color: #66CCFF !important;
    }

  .PageTitle{
    margin-right: 1px !important;
  }

  .required-field::before {
    content: "*";
    color: red;
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
  margin-top: 24% !important;
  font-weight: 800 !important;
  font-size: 11px !important;

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
.amountBox{
  width: 20%;
  text-align: center;
}
.inputtaxInd{
  background-color: white !important;
  border: none;
  text-align: center;
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


<style type="text/css">



  .Custom-Box {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .OperatorTd{
    width: 35px !important;
  }
  .ValuesTd{
    width: 50% !important;
  }

  .QueryTableTd{
    font-size: 14px !important;
    font-weight: 600 !important;
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

  .crBal{
    display:none;
  }

  .showAccName{

    border: none;

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

  }

  .defualtSearchNew{

    display: none;

  }

  .alignRightClass{
    text-align: right;
  }

  .alignCenterClass{
    text-align: center;
  }


 .rightcontent{

  text-align:right;


}

.modal-header .close {
    margin-top: -25px !important;
    margin-right: 2% !important;
}

::placeholder {
  
  text-align:left;
}

 @media only screen and (max-width: 600px) {
  
  .dataTables_filter{
    margin-left: 35%;
  }
}

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
    font-size: 15px!important;
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

</style>


<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            GRN Report
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">Purchase</a></li>

            <li class="active"><a href="{{ url('/report/purchase/purchase-order-report') }}">GRN Rep.</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> GRN Report</h2>


            </div><!-- /.box-header -->

            <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

              <div class="row">

                <div class="col-md-3">

                   <div class="form-group">

                    <?php $FromDate= date("d-m-Y", strtotime($yearstart));  
                        $ToDate= date("d-m-Y", strtotime($yearend));   ?>

                      <label for="exampleInputEmail1"> From Date : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                        <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
                       
                        <input type="text" name="from_date" id="from_date" class="form-control fromDatePc rightcontent" placeholder="Select Transaction Date" value="{{$FromDate}} " autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_from_date">

                        

                      </small>

                  </div>

                 </div>



                 <div class="col-md-3">

                   <div class="form-group">

                      <label for="exampleInputEmail1"> To Date : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy_1">

                        <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy_1">

                        <input type="text" name="to_date" id="to_date" class="form-control toDatePc rightcontent" placeholder="Select Transaction Date" value="{{$ToDate}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_to_date">

                      </small>

                  </div>

                 </div>

                 

                 <!-- /.col -->

                <div class="col-md-3">

                     <div class="form-group">

                      <label for="exampleInputEmail1">Item Code :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="itemList" id="item_code" name="item_code" class="form-control  pull-left rightcontent" value="{{ old('trans_code')}}" placeholder="Select Item" autocomplete="off">


                          <datalist id="itemList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($item_list as $key)

                            <option value='<?php echo $key->ITEM_CODE?>'   data-xyz ="<?php echo $key->ITEM_CODE; ?>" ><?php echo $key->ITEM_CODE; ?></option>


                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div><!-- /.col -->

              </div><!-- /.row -->



              <div class="row">

                <div class="col-md-4"></div>

                <div class="col-md-8">

                    <div style="margin-top:2%;margin-bottom:5%;">

                <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

              <!--   <button type="button" class="btn btn-success" data-toggle="modal" data-target="#QueryModal"><i class="fa fa-hourglass" aria-hidden="true"></i> &nbsp;&nbsp;Query</button>
 -->
                <button class="btn btn-primary" id="PindReprtExl"  onclick="excelReportBtn('tax_excel')" disabled="" ><i class="fa fa-file-excel-o" aria-hidden="true"></i> <b>Excel</b></button>

               <!--  <button class="btn btn-primary" id="PindReprtExl"  onclick="excelReportBtn('monthly_excel')"><i class="fa fa-file-excel-o" aria-hidden="true"></i> <b>Monthly Summary</b></button> -->

               </div>

                </div>
                

              </div>


            </div><!-- /.box-body -->



            <div class="box-body" style="margin-top: -2%;">


              <table id="PurchaseIndentReportTable" class="table table-bordered table-striped table-hover">
                <thead class="theadC">

                  

                  <tr>
                    <th class="text-center">Sr.No</th>
                    <th class="text-center" style="width:80px !important">Vr Date</th>
                    <th class="text-center">Vr no. </th>
                    <th class="text-center">Trans. code</th>
                    <th class="text-center">Party</th>
                    <th class="text-center">Plant Code</th>
                    <th class="text-center">Series</th>
                    <th class="text-center">Profit Cent.</th>
                    <th class="text-center">Item Name</th>
                    <th class="text-center">Qty</th>
                    <th class="text-center">A-Qty</th>
                    <th class="text-center">Action</th>
                  </tr>

                </thead>

                <tbody id="defualtSearch">

                  

                </tbody>
               

              </table>

            </div><!-- /.box-body -->

          </div>

  </section>

</div>






@include('admin.include.footer')



 <script type="text/javascript">

    $(document).ready(function(){

        $( window ).on( "load", function() {

          var fromdateintrans = $('#FromDateFy').val();
          var todateintrans = $('#ToDateFy').val();

          var fromdateintrans_1 = $('#FromDateFy_1').val();
          var todateintrans_1 = $('#ToDateFy_1').val();

          $('.fromDatePc').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });

          $('.toDatePc').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans_1,

            endDate : todateintrans_1,

            autoclose: 'true'

          });

        });

        $("#acct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

        });



        $('#acct_code').change(function(){

         

          var acountCode = $('#acct_code').val();

          $('#showaccCode').val(acountCode);

        });

    });

  function plantQueryOperator(getVal){

    var plantCodeValue =  $('#plantCodeValue').val();

    if(plantCodeValue == '' && getVal !=''){
      $("#plantCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(plantCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#plantCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#plantCodeValue").val('');
    }

  }

  function plantQueryValue(plantCodeValue){

    var getVal =  $('#plantCodeOperator').val();

    if(getVal == '' && plantCodeValue !=''){
      $("#plantCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(plantCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#plantCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#plantCodeValue").val('');
    }

  }


  function seriesQueryOperator(getVal){

    var seriesCodeValue =  $('#seriesCodeValue').val();

    if(seriesCodeValue == '' && getVal !=''){
      $("#seriesCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(seriesCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#seriesCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#seriesCodeValue").val('');
    }

  }

  function seriesQueryValue(seriesCodeValue){

    var getVal =  $('#seriesCodeOperator').val();

    if(getVal == '' && seriesCodeValue !=''){
      $("#seriesCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(seriesCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#seriesCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#seriesCodeValue").val('');
    }

  }


  function accQueryOperator(getVal){

    var accCodeValue =  $('#accCode').val();
    

    if(accCodeValue == '' && getVal !=''){
      $("#accCode").attr("readonly", false);
      $("#ProceedBtnId").attr("", true);
    }else if(accCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#accCode").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#accCode").val('');
    }

  }

  function accQueryValue(accCodeValue){

    var getVal =  $('#accCodeOperator').val();

    if(getVal == '' && accCodeValue !=''){
      $("#accCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(accCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#accCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#accCodeValue").val('');
    }

  }


  function qtyQueryOperator(getVal){

    var qtyValue =  $('#QtyValue').val();

    if(qtyValue == '' && getVal !=''){
      $("#QtyValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(qtyValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#QtyValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#QtyValue").val('');
    }

  }

  function qtyQueryValue(employeeValue){

    var getVal =  $('#QtyOperator').val();

    if(getVal == '' && employeeValue !=''){
      $("#QtyValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(employeeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#QtyValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#QtyValue").val('');
    }

  }


  function pfctQueryOperator(getVal){

    var profitCenterValue =  $('#profitCenterValue').val();

    if(profitCenterValue == '' && getVal !=''){
      $("#profitCenterValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(profitCenterValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#profitCenterValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#profitCenterValue").val('');
    }

  }

  function pfctQueryValue(profitCenterValue){

    var getVal =  $('#profitCenterOperator').val();

    if(getVal == '' && profitCenterValue !=''){
      $("#profitCenterValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(profitCenterValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#profitCenterValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#profitCenterValue").val('');
    }

  }


  function costCetQueryOperator(getVal){

    var costCetCode =  $('#costCetCode').val();

    if(costCetCode == '' && getVal !=''){
      $("#costCetCode").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(costCetCode != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#costCetCode").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#costCetCode").val('');
    }

  }


  function costCetQueryValue(costCetCode){

    var getVal =  $('#costCetOperator').val();

    if(getVal == '' && costCetCode !=''){
      $("#costCetCode").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(costCetCode != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#costCetCode").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#costCetCode").val('');
    }

  }

  function excelReportBtn(getExcelName){

    var from_dates = $("#from_date").val();
    var from_date  = from_dates.trim();
    var to_date    = $("#to_date").val();

    if(getExcelName == 'tax_excel'){

      var vrns       = $("#vr_num").val();
      var item_codes = $("#item_code").val();

      if(item_codes == ''){
        item_code = 0;
      }else{
        item_code = item_codes;
      }

      if(vrns == ''){
        vrn = 0;
      }else{
        vrn = vrns;
      }


      var seriesCodeOperators   =  $('#seriesCodeOperators').val();
      if (seriesCodeOperators == '') {
        seriesCodeOperator = 0;
      }else{
        seriesCodeOperator = seriesCodeOperators;
      }

      var seriesCodeValues      =  $('#seriesCodeValues').val();
      if (seriesCodeValues == '') {
        seriesCodeValue = 0;
      }else{
        seriesCodeValue = seriesCodeValues;
      }

      var plantCodeOperators    =  $('#plantCodeOperators').val();
      if (plantCodeOperators == '') {
        plantCodeOperator = 0;
      }else{
        plantCodeOperator = plantCodeOperators;
      }

      var plantCodeValues       =  $('#plantCodeValues').val();
      if (plantCodeValues == '') {
        plantCodeValue = 0;
      }else{
        plantCodeValue = plantCodeValues;
      }

      var profitCenterOperators =  $('#profitCenterOperators').val();
      if (profitCenterOperators == '') {
        profitCenterOperator = 0;
      }else{
        profitCenterOperator = profitCenterOperators;
      }

      var profitCenterValues    =  $('#profitCenterValues').val();
      if (profitCenterValues == '') {
        profitCenterValue = 0;
      }else{
        profitCenterValue = profitCenterValues;
      }
     
      var accCodeOperators      =  $('#accCodeOperators').val();
      if (accCodeOperators == '') {
        accCodeOperator = 0;
      }else{
        accCodeOperator = accCodeOperators;
      }

      var accCodes              =  $('#accCodes').val();
      if (accCodes == '') {
        accCode = 0;
      }else{
        accCode = accCodes;
      }

      var costCetOperators      =  $('#costCetOperators').val();
      if (costCetOperators == '') {
        costCetOperator = 0;
      }else{
        costCetOperator = costCetOperators;
      }

      var costCetCodes          =  $('#costCetCodes').val();
      if (costCetCodes == '') {
        costCetCode = 0;
      }else{
        costCetCode = costCetCodes;
      }

      var QtyOperators          =  $('#QtyOperators').val();
      if (QtyOperators == '') {
        QtyOperator = 0;
      }else{
        QtyOperator = QtyOperators;
      }

      var QtyValues   =  $('#QtyValues').val();
      if (QtyValues == '') {
        QtyValue = 0;
      }else{
        QtyValue = QtyValues;
      }

      var pendingId  =  $('#pendingId').is(":checked");

      var CompleteId =  $('#CompleteId').is(":checked");

      var allId      =  $('#allId').is(":checked");


      var ReportTypes;

      if(pendingId){
        ReportTypes = $('#pendingId').val();
      }else if(CompleteId){
        ReportTypes = $('#CompleteId').val();
      }else if(allId){
        ReportTypes = $('#allId').val();
      }else{
        ReportTypes = 'Not Found';
      }

      var pageName = 'purchaseIndent';


      window.location.href = "{{ url('/report/purchase/purchase-grn/purchase-grn-report-excel/') }}"+'/'+from_date+'/'+to_date+'/'+vrn+'/'+item_code+'/'+seriesCodeOperator+'/'+seriesCodeValue+'/'+plantCodeOperator+'/'+plantCodeValue+'/'+profitCenterOperator+'/'+profitCenterValue+'/'+accCodeOperator+'/'+accCode+'/'+costCetOperator+'/'+costCetCode+'/'+QtyOperator+'/'+QtyValue+'/'+ReportTypes;

    }else if(getExcelName == 'monthly_excel'){


      console.log('monthly');

    }else{

      console.log('else');

    }
       

  }


</script>




<script type="text/javascript">

load_data_query()
  function load_data_query(seriesCodeOperator='',seriesCodeValue='',plantCodeOperator='',plantCodeValue='',profitCenterOperator='',profitCenterValue='',accCodeOperator='',accCode='',costCetOperator='',costCetCode='',QtyOperator='',QtyValue='',from_date='',to_date='',item_code='',vr_num='',ReportTypes=''){
    

      $('#PurchaseIndentReportTable').DataTable({

          processing: true,
          serverSide: true,
          scrollX: true,
          pageLength:'25',
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
          
          buttons:  [],
         
          ajax:{
            url:'{{ url("/get-data-from-query-srm-grn") }}',
            data: {seriesCodeOperator:seriesCodeOperator,seriesCodeValue:seriesCodeValue,plantCodeOperator:plantCodeOperator,plantCodeValue:plantCodeValue,profitCenterOperator:profitCenterOperator,profitCenterValue:profitCenterValue,accCodeOperator:accCodeOperator,accCode:accCode,costCetOperator:costCetOperator,costCetCode:costCetCode,QtyOperator:QtyOperator,QtyValue:QtyValue,from_date:from_date,to_date:to_date,item_code:item_code,vr_num:vr_num,ReportTypes:ReportTypes}
          },
          columns: [

            { 
              data:"DT_RowIndex",
              className:"text-center"
            },
            {
                data:'VRDATE',
                name:'VRDATE',
                className:'datebill'
            },
            {
                data:'VRNO',
                name:'VRNO',
                className:'text-right'
            },
            {
                data:'TRAN_CODE',
                name:'TRAN_CODE',
                className: "alignCenterClass"
            },
            {
              className: "alignCenterClass",
              render: function (data, type, full, meta){
                  
                var ACCNAME = '<p>'+full['ACC_NAME']+'</p>'+'<p style="line-height:2px;">('+full['ACC_CODE']+')<input type="hidden" id="AccCodeId'+full['DT_RowIndex']+'" value="'+full['ACC_CODE']+'"></p>';
                return ACCNAME;

              }
            },
            {
                data:'PLANT_CODE',
                name:'PLANT_CODE'
            },
            {
                data:'SERIES_CODE',
                name:'SERIES_CODE'
                
            },
            {
                data:'PFCT_CODE',
                name:'PFCT_CODE',
                className: "alignRightClass"
               
            },
            {
              render: function (data, type, full, meta){
                  
                var itemName = '<p>'+full['ITEM_NAME']+'</p>'+'<p style="line-height:2px;">('+full['ITEM_CODE']+')<input type="hidden" id="ItemCodeId'+full['DT_RowIndex']+'" value="'+full['ITEM_CODE']+'"></p>';
                return itemName;

              }
            },
            {
                className: "alignRightClass",
                render: function (data, type, full, meta){

                var finalQty = full['QTYRECED'];
                  
                var itemName = '<div>'+finalQty+' <small class="label label-success">'+full['UM_CODE']+'</small></div>';
                return itemName;

              }
            },
            {
               
                className: "aligncenterClass",
                render: function (data, type, full, meta){
                  
                var itemName = '<div>'+full['AQTYRECD']+' <small class="label label-success">'+full['AUM_CODE']+'</small></div>';
                return itemName;

              }
            },
            {
              data:null,
              render: function (data, type, full, meta){

                console.log('getBtb ',data['GRNHID']);
                var GetBtn = '<button type="button" class="btn btn-primary btn-xs notification" id="veiwPdetail_'+full['DT_RowIndex']+'" data-toggle="modal" data-target="#viewPartyDetail_'+full['DT_RowIndex']+'" onclick="showCalTax('+full['DT_RowIndex']+','+data['GRNHID']+','+data['GRNBID']+')" style="padding-bottom: 0px;padding-top: 0px;margin-top: 5%;">Calc. Tax</button><button type="button" class="btn btn-primary btn-xs notification" id="veiwQuaParDetails_'+full['DT_RowIndex']+'" data-toggle="modal" data-target="#viewQualityParDetail_'+full['DT_RowIndex']+'" onclick="showQuaParDetails('+full['DT_RowIndex']+','+data['GRNHID']+','+data['GRNBID']+')" style="padding-bottom: 0px;padding-top: 0px;margin-top: 3%;">Quality Para.</button><div class="modal fade" id="viewPartyDetail_'+full['DT_RowIndex']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-md" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation <br> Tax Code - <span id="showTaxCode'+full['DT_RowIndex']+'"></span></h5></div></div></div><div class="modal-body table-responsive"><div class="boxer" id="getCalTaxData'+full['DT_RowIndex']+'"></div><div class="modal-footer" style="text-align: center;"><button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button></div></div></div></div></div><div class="modal fade" id="viewQualityParDetail_'+full['DT_RowIndex']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-md" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel"> Qaulity Parameter <br> <span id="showItemCode'+full['DT_RowIndex']+'"></span></h5></div></div></div><div class="modal-body table-responsive"><div class="boxer" id="getQuaParData'+full['DT_RowIndex']+'"></div><div class="modal-footer" style="text-align: center;"><button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button></div></div></div></div>';
                $("#PindReprtExl").prop('disabled',false);
                return GetBtn;
              }
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


    $('#ProceedBtnId').click(function(){

     var seriesCodeOperator   =  $('#seriesCodeOperator').val();
      var seriesCodeValue      =  $('#seriesCodeValue').val();

      var plantCodeOperator    =  $('#plantCodeOperator').val();
      var plantCodeValue       =  $('#plantCodeValue').val();

      var profitCenterOperator =  $('#profitCenterOperator').val();
      var profitCenterValue    =  $('#profitCenterValue').val();
       
      var accCodeOperator      =  $('#accCodeOperator').val();
      var accCode              =  $('#accCode').val();

      var costCetOperator      =  $('#costCetOperator').val();
      var costCetCode          =  $('#costCetCode').val();

      var QtyOperator          =  $('#QtyOperator').val();
      var QtyValue             =  $('#QtyValue').val();

    $('#seriesCodeOperators').val(seriesCodeOperator);
    $('#seriesCodeValues').val(seriesCodeValue);
    $('#plantCodeOperators').val(plantCodeOperator);
    $('#plantCodeValues').val(plantCodeValue);
    $('#profitCenterOperators').val(profitCenterOperator);
    $('#profitCenterValues').val(profitCenterValue);
    $('#accCodeOperators').val(accCodeOperator);
    $('#accCodes').val(accCode);
    $('#costCetOperators').val(costCetOperator);
    $('#costCetCodes').val(costCetCode);
    $('#QtyOperators').val(QtyOperator);
    $('#QtyValues').val(QtyValue);

    var pendingId  =  $('#pendingId').is(":checked");
    var CompleteId =  $('#CompleteId').is(":checked");
    var allId      =  $('#allId').is(":checked");

    var ReportTypes;

    if(pendingId){
      ReportTypes = $('#pendingId').val();
    }else if(CompleteId){
      ReportTypes = $('#CompleteId').val();
    }else if(allId){
      ReportTypes = $('#allId').val();
    }else{
      ReportTypes = 'Not Found';
    }


    var from_date = '';
    var to_date = '';
    var bank_code = '';
    var acct_code = '';
    var vr_num = '';
    var item_code = '';

    if (seriesCodeOperator!='' || seriesCodeValue!='' || plantCodeOperator!='' || plantCodeValue!='' || profitCenterOperator!='' || profitCenterValue!='' || accCodeOperator!='' || accCode!='' || costCetOperator!='' || costCetCode!='' || QtyOperator!='' || QtyValue!='' || from_date!='' || to_date!='' || item_code == '' || vr_num =='' || ReportTypes!='') {
            

          $('#PurchaseIndentReportTable').DataTable().destroy();

          load_data_query(seriesCodeOperator,seriesCodeValue,plantCodeOperator,plantCodeValue,profitCenterOperator,profitCenterValue,accCodeOperator,accCode,costCetOperator,costCetCode,QtyOperator,QtyValue,from_date,to_date,item_code,vr_num,ReportTypes);

          $('#QueryModal').modal('hide');
          $('#seriesCodeOperator').val('');
          $('#seriesCodeValue').val('');
          $('#plantCodeOperator').val('');
          $('#plantCodeValue').val('');
          $('#profitCenterOperator').val('');
          $('#profitCenterValue').val('');
          $('#accCodeOperator').val('');
          $('#accCode').val('');
          $('#costCetOperator').val('');
          $('#costCetCode').val('');
          $('#QtyOperator').val('');
          $('#QtyValue').val('');


      }else{

          $('#PurchaseIndentReportTable').DataTable().destroy();

          load_data_query();

          $('#QueryModal').modal('hide');
          $('#seriesCodeOperator').val('');
          $('#seriesCodeValue').val('');
          $('#plantCodeOperator').val('');
          $('#plantCodeValue').val('');
          $('#profitCenterOperator').val('');
          $('#profitCenterValue').val('');
          $('#accCodeOperator').val('');
          $('#accCode').val('');
          $('#costCetOperator').val('');
          $('#costCetCode').val('');
          $('#QtyOperator').val('');
          $('#QtyValue').val('');
         
      }


    });


    $('#btnsearch').click(function(){

          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var bank_code =  $('#bank_code').val();

          var item_code =  $('#item_code').val();
         
          var vr_num =  $('#vr_num').val();

          var plantCodeOperator    =  '';
          var plantCodeValue       =  '';
          var seriesCodeOperator   =  '';
          var seriesCodeValue      =  '';
          var profitCenterOperator =  '';
          var profitCenterValue    =  '';
          var QtyOperator          =  '';
          var QtyValue             =  '';
          var accCodeOperator      =  '';
          var accCode              =  '';
          var costCetOperator      =  '';
          var costCetCode          =  '';


     var pendingId  =  $('#pendingId').is(":checked");
     var CompleteId =  $('#CompleteId').is(":checked");
     var allId      =  $('#allId').is(":checked");
        

        var ReportTypes;

        if(pendingId){
          ReportTypes = $('#pendingId').val();
        }else if(CompleteId){
          ReportTypes = $('#CompleteId').val();
        }else if(allId){
          ReportTypes = $('#allId').val();
        }else{
          ReportTypes = 'Not Found';
        }
          
   //  alert(ReportTypes);

          if (bank_code!=''  || from_date!='' || to_date!='' || vr_num!='' || plantCodeOperator=='' || plantCodeValue=='' || seriesCodeOperator=='' || seriesCodeValue=='' || profitCenterOperator=='' || profitCenterValue=='' || QtyOperator=='' || QtyValue=='' || AccCodeId=='' || accCodeOperator=='' || accCode=='' || item_code=='' || ReportTypes=='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date!=''){
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
            }

            // if(acct_code==''){
            //     $('#show_err_acct_code').html('Please select account code').css('color','red');
            //     return false;
            //   }

            $('#PurchaseIndentReportTable').DataTable().destroy();

            load_data_query(seriesCodeOperator,seriesCodeValue,plantCodeOperator,plantCodeValue,profitCenterOperator,profitCenterValue,accCodeOperator,accCode,costCetOperator,costCetCode,QtyOperator,QtyValue,from_date,to_date,item_code,vr_num,ReportTypes);

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            
          }


        });


    $('#ResetId').click(function(){
  
      
      $('#acct_code').val('');
      $('#vr_num').val('');
      $('#accountText').html('');

    
      $('#PurchaseIndentReportTable').DataTable().destroy();
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



function showCalTax(srNo,headid,bodyId){

      var headid,bodyId;
      var tblName = 'GRN_TAX';
      var tblName1 = 'GRN_HEAD';
      var headIdName = 'GRNHID';
      var bodyIdName = 'GRNBID';


        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

        });

        $.ajax({

              url:"{{ url('/get-calTax-for-purchase-reports') }}",

               method : "POST",

               type: "JSON",

                data: {headid:headid,bodyId:bodyId,tblName:tblName,headIdName:headIdName,bodyIdName:bodyIdName,tblName1:tblName1},

               success:function(data){

                  var data1 = JSON.parse(data);

                 // console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{
                        var obj_row = data1.data;
                        var obj_row1 = data1.tax_code;

                       // console.log('taxC => ',obj_row1[0].TAX_CODE);

                        $('#showTaxCode'+srNo).html('');

                        $('#showTaxCode'+srNo).html(obj_row1[0].TAX_CODE);

                        var srac=1;
                        /*var countAcc= data1.data.length;
                        $('#accCount'+headid+'_'+srNo).html(countAcc);*/
                        $('#getCalTaxData'+srNo).empty();
                        var headData = '<div class="box-row" id="appendbody'+srNo+'"><div class="box10 texIndbox1">Sr.No.</div><div class="box10 rateIndbox">Tax Indicator</div><div class="box10 rateIndbox">Rate Indicator</div><div class="box10 rateIndbox">Rate</div><div class="box10 rateIndbox">Amount</div></div></div>';
                      $('#getCalTaxData'+srNo).append(headData);



                        $.each(obj_row, function (i, obj_row) {

                            var bodyData = '<div class="box-row"><div class="box10 itmdetlheading"><span id="srnum">'+srac+'</span></div><div class="box10 itmdetlheading" style="text-align: left;"><span id="accCode">'+obj_row.TAXIND_NAME+'</span> </div><div class="box10 itmdetlheading"><span id="accName"> '+obj_row.RATE_INDEX+'</span></div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.TAX_RATE+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.TAX_AMT+'</span> </div></div>';

                            srac++;
                            $('#getCalTaxData'+srNo).append(bodyData);
                        });
                      }
                      
                  }
               }

          });
    }


    function showQuaParDetails(srNo,headid,bodyId){

        var headid,bodyId;
        var pageName = 'purchaseGRN';
        var ItemCode = '';

            $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

        $.ajax({

              url:"{{ url('/finance/get-quality-parameter-by-item') }}",

               method : "POST",

               type: "JSON",

               data: {headid:headid,bodyId:bodyId,pageName:pageName,ItemCode:ItemCode},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       

                      }else{
                        var obj_rows = data1.data;
                        var srac=1;
                        
                       
                        $('#getQuaParData'+srNo).empty();
                        $('#showItemCode'+srNo).empty();
                        var headData = '<div class="box-row" id="appendbody'+srNo+'"><div class="box10 texIndbox1">Sr.No.</div><div class="box10 rateIndbox">Item Category</div><div class="box10 rateIndbox">Quality Char</div><div class="box10 rateIndbox">Description</div><div class="box10 rateIndbox">From Value</div><div class="box10 rateIndbox">To Value</div></div></div>';
                      $('#getQuaParData'+srNo).append(headData);

                       
                        
                        $.each(obj_rows, function (i, obj_row) {

                            if(srac == 1){

                              
                              console.log('itemC => ',obj_row.ITEM_CODE);
                              $('#showItemCode'+srNo).append(obj_row.ITEM_CODE);

                            }


                            var bodyData = '<div class="box-row"><div class="box10 itmdetlheading"><span id="srnum">'+srac+'</span></div><div class="box10 itmdetlheading" style="text-align: left;"><span id="accCode">'+obj_row.ICATG_CODE+'</span> </div><div class="box10 itmdetlheading"><span id="accName"> '+obj_row.IQUA_CHAR+'</span></div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.IQUA_DESC+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.CHAR_FROMVALUE+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.CHAR_TOVALUE+'</span> </div></div>';

                            srac++;
                            $('#getQuaParData'+srNo).append(bodyData);
                        });
                      }
                      
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
  
  $('#btnpdf').click(function(){

          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var bank_code =  $('#bank_code').val();

          var acct_code =  $('#acct_code').val();
         
          var vr_num =  $('#vr_num').val();

          var store_action ='req';

          var recNoId         =  '';
          var recNoValueId    =  '';
          var lastUpId        =  '';
          var lastUpValueId   =  '';
          var VrNoId          =  '';
          var VrNoValueId     =  '';
          var SeriesNoId      =  '';
          var SeriesNoValueId =  '';
          var AccCodeId       =  '';
          var AccCodeValueId  =  '';
          var AmountId        =  '';
          var AmountValueId   =  '';
          var OtherDetailsId  =  '';
          var OtherDetValueId =  '';

        
          

          if (bank_code!='' || acct_code!='' || from_date!='' || to_date!='' || vr_num!='' || recNoId=='' || recNoValueId=='' || lastUpId=='' || lastUpValueId=='' || VrNoId=='' || VrNoValueId=='' || SeriesNoId=='' || SeriesNoValueId=='' || AccCodeId=='' || AccCodeValueId=='' || AmountId=='' || AmountValueId=='' || OtherDetailsId=='' || OtherDetValueId=='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date!=''){
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
            }

            if(acct_code==''){
                $('#show_err_acct_code').html('Please select account code').css('color','red');
                return false;
              }

            
                            $.ajaxSetup({
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                              });

                             $.ajax({

                                url:"{{ url('/report/purchase-grn/pdf') }}",

                                method : "POST",

                                type: "GET",

                                data: {recNoId:recNoId,recNoValueId:recNoValueId,lastUpId:lastUpId,lastUpValueId:lastUpValueId,VrNoId:VrNoId,VrNoValueId:VrNoValueId,SeriesNoId:SeriesNoId,SeriesNoValueId:SeriesNoValueId,AccCodeId:AccCodeId,AccCodeValueId:AccCodeValueId,AmountId:AmountId,AmountValueId:AmountValueId,OtherDetailsId:OtherDetailsId,OtherDetValueId:OtherDetValueId,bank_code:bank_code,acct_code:acct_code,vr_num:vr_num,from_date:from_date,to_date:to_date,store_action:store_action},

                                

                                success: function(response){

                                 console.log('response',response);

                                  if(response.response == 'success' && response.data !=''){

                                      var link = document.createElement('a');
                                      link.href = response.url;
                                      link.download = 'file.pdf';
                                      link.dispatchEvent(new MouseEvent('click'));

                                  }else{
                                    alert('no data');
                                  }

                                   

                                }, 

                                
                          });

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            
          }


        });
</script>
@endsection