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
  .vrDateDataTbl{
    width: 7%;
    text-align: left;
  }
  .vrVrNoDataTbl{
    width: 9%;
    text-align: left;
  }
  .refDataTbl{
    width: 19%;
    text-align: left;
  }
  .drAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .crAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .balAmtDataTbl{
    width: 15%;
    text-align: left;
  }
  .balTypeDataTbl{
    width: 5%;
    text-align: left;
  }
  .pfctDataTbl{
    width: 15%;
    text-align: left;
  }
  .btn-sm {
    padding: 4px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
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
  table.dataTable {
      clear: both;
      margin-top: 0px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }
  .content {
      min-height: 250px;
      padding: 9px;
      margin-right: auto;
      margin-left: auto;
      padding-left: 15px;
      padding-right: 15px;
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

 .required-field::before {

    content: "*";

    color: red;

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

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

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

           Stock Summary
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">C and F</a></li>
            
            <li class="active"><a href="{{ url('/report/logistic/trip-planning/monthly-trip-planning-report') }}">Stock Summary</a></li>

          </ol>

        </section>

<section class="content">

    <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Stock Summary</h2>


        </div><!-- /.box-header -->

        <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

            <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Stock Summary  <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="stock_list" id="stock_summary" name="stock_summary" class="form-control  pull-left" value="" placeholder="Select Stock Summary" autocomplete="off" >


                          <datalist id="stock_list">
                           
                          <!--  <option value="SS1">Rake Consignee Item Wise</option>
                           <option value="SS2">Consignee Item Wise</option>
                           <option value="SS3">Rake and Wagon Item Wise</option> -->
                           <option value="SS1" data-xyz ="SS1">Rake Consignee Item Wise</option>
                           <option value="SS2" data-xyz ="SS2">Consignee Item Wise</option>
                           <option value="SS3" data-xyz ="SS3">Rake Wagon Consignee Item Wise</option>
                           
                          </datalist>

                      </div>

                      <small id="stocksumm_err"></small>

                      <small>  

                        <div class="pull-left showSeletedName" id="fromPlaceText"></div>

                     </small>

                     <small id="show_err_from_place"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Rake No :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input list="rakelist" id="rack_no" name="rack_no" class="form-control  pull-left" value="" placeholder="Select Rake No." autocomplete="off">


                          <datalist id="rakelist">

                            <?php foreach ($rake_list as $value): ?>

                              <option value="<?php echo $value->RAKE_NO;?>"data-xyz ="{{ $value->RAKE_NO }}">{{$value->RAKE_NO}}</option>
                              
                            <?php endforeach ?>
                          </datalist>

                      </div>

                      <small id="show_err_rakeno"></small>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Wagon No :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input list="wagonlist" id="wagon_no" name="wagon_no" class="form-control  pull-left" value="" placeholder="Select Wagon No." autocomplete="off">


                          <datalist id="wagonlist">

                            <?php foreach ($wagon_list as $value): ?>

                              <option value="<?php echo $value->WAGON_NO;?>"data-xyz ="{{ $value->WAGON_NO }}">{{$value->WAGON_NO}}</option>
                              
                            <?php endforeach ?>
                          </datalist>

                      </div>

                      <small id="show_err_rakeno"></small>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>


                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Consinee :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="custList" id="cust_no" name="cust_no" class="form-control  pull-left" value="" placeholder="Select Consignee" autocomplete="off">


                          <datalist id="custList">

                            <?php foreach ($trip_list as $value): ?>

                              <option value="<?php echo $value->CP_CODE.'-'.$value->CP_NAME; ?>"data-xyz ="{{ $value->CP_NAME }}">{{ $value->CP_CODE}} = {{$value->CP_NAME}}</option>
                              
                            <?php endforeach ?>
                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

                

                

            </div><!-- /. 1st row -->

            <div class="row">
              <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Item :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="itemlist" id="item_code" name="item_code" class="form-control  pull-left" value="" placeholder="Select Item" autocomplete="off">


                          <datalist id="itemlist">

                            <?php foreach ($item_list as $value): ?>

                              <option value="<?php echo $value->ITEM_CODE.'-'.$value->ITEM_NAME; ?>"data-xyz ="{{ $value->ITEM_NAME }}">{{ $value->ITEM_CODE}} = {{$value->ITEM_NAME}}</option>
                              
                            <?php endforeach ?>
                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

                <div class="col-md-4" style="margin-top: 1%;"><small id="errmsg" style="font-weight:600;font-size: 12px;" ></small></div>
            </div>


              <div class="row">

              
                <div class="col-md-4" style="margin-top: 1%;"><small id="errmsg" style="font-weight:600;font-size: 14px;" ></small></div>

                <div class="col-md-4 text-center" style="margin-top: 1%;">

                  
                  <button type="button" class="btn btn-primary" id="ProceedBtnId">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                  <button type="button" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

                 <!--  <button type="button" class="btn btn-warning" name="searchdata" onclick="excelReportBtn('month')" disabled="" id="excelBtn">&nbsp;&nbsp;<i class="fa fa-file-excel-o" aria-hidden="true"></i> &nbsp;&nbsp;Excel&nbsp;&nbsp;</button> -->


                  </div>

                  <div class="col-md-4"></div>

              </div>

              <!-- Button trigger modal -->
            <!--   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#stock_summary_modal" style="backdrop: 'static'">
                Launch demo modal
              </button> -->

              <!-- Modal -->
             <!--  <div class="modal fade" id="stock_summary_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div> -->


            

        </div><!-- /.box-body -->

        	<div class="box-body" style="margin-top: 1%;">

                <table id="stockSummaryRtTbl" class="table table-bordered table-striped table-hover">
                  <thead class="theadC">

                    <tr>
                      <th class="text-center" width="3%" id="thRakeNo">Rake No</th>
                      <th class="text-center" width="3%" id="">Wagon No</th>
                      <th class="text-center" style="width:16%;" id="consignee">Consignee</th>
                      <th class="text-center" width="12%">Batch No.</th>
                      <th class="text-center" width="12%">Item</th>
                      <th class="text-center" width="4%">Qty Received</th>
                      <th class="text-center" width="4%">A-Qty-Received</th>
                      <th class="text-center" width="4%">Qty Issue</th>
                      <th class="text-center" width="4%">A-Qty-Issue</th>
                      <th class="text-center" width="4%">Balance Qty</th>
                      <th class="text-center" width="3%">UM</th>
                      <th class="text-center" width="4%">Balance AQty</th>
                      <th class="text-center" width="3%">AUM</th>
                      
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
           
    </div>

</section>

</div>

<input type="hidden" id="excelName" value="" />



  {{--**** Start : Quality Parameter Model ****--}}

    <div id="quaPdomModel_2">
         
    </div>


    {{--**** End : Quality Parameter Model ****--}}



@include('admin.include.footer')



 <script type="text/javascript">



	$(document).ready(function(){

	    var d = new Date();
        var strDate = d.getDate() + "0" + (d.getMonth()+1) + "" + d.getFullYear();

        var time = d.getHours() + "" + d.getMinutes() + "" + d.getSeconds();

        $('#excelName').val(strDate+'_'+time);

        $( window ).on( "load", function() {

          $('#stock_summary_modal').modal('show');

          var fromdateintrans = $('#FromDateFy').val();
          var todateintrans = $('#ToDateFy').val();

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

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });

        });

	});


  $("#stock_summary").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#stock_list option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){

          $('#errmsg').html('Select Stock Summary').css('color','red');  
          
          $('#rack_no').attr('disabled',true);
          $('#cust_no').attr('disabled',true);
          $('#wagon_no').attr('disabled',true);
          $('#item_code').attr('disabled',true);

        }else{

           if(val == 'SS1'){

            $('#cust_no').attr('disabled',false);
            $('#rack_no').attr('disabled',false);
            $('#wagon_no').attr('disabled',true);
            $('#item_code').attr('disabled',false);

           }else if(val == 'SS2'){

            $('#rack_no').attr('disabled',true);
            $('#cust_no').attr('disabled',false);
            $('#wagon_no').attr('disabled',true);
            $('#item_code').attr('disabled',false);

           }else if(val == 'SS3'){

            $('#rack_no').attr('disabled',false);
            $('#cust_no').attr('disabled',false);
            $('#wagon_no').attr('disabled',false);
            $('#item_code').attr('disabled',false);
           }


        }


    });

 // function funstocksumm(){

 //   var stocksummary = $('#stock_summary').val();

 //   $('#stocksumm_err').html('');

 //    if(stocksummary == 'SS1'){

 //    	$('#cust_no').attr('disabled',true);
 //      $('#rack_no').attr('disabled',false);

 //     }else if(stocksummary == 'SS2'){

 //     	$('#rack_no').attr('disabled',true);
 //      $('#cust_no').attr('disabled',false);

 //     }else if(stocksummary == 'SS3'){

 //      $('#rack_no').attr('disabled',false);
 //      $('#cust_no').attr('disabled',false);
 //      $('#wagon_no').attr('disabled',false);
 //      $('#item_code').attr('disabled',false);
 //     }
 // }
  function excelReportBtn(type){

    var velType = $('input[name=vehicleType]:checked').val();

    var from_date    =  $('#from_date').val();

    var to_date      =  $('#to_date').val();
    
    var ConsineeCode =  $('#cust_no').val();
    
    var trspAgent    =  $('#transpAgentId').val();
    
    var fromPlace    =  $('#from_place').val();

    var toPlace      =  $('#to_place').val();

    if(velType == ''){
      vehicleType = 0;
    }else{
      vehicleType = velType;
    }

    if(ConsineeCode == ''){
      Consinee = 0;
    }else{
      Consinee = ConsineeCode;
    }

    if(fromPlace == ''){
      from_place = 0;
    }else{
      from_place = fromPlace;
    }

    if(toPlace == ''){
      to_place = 0;
    }else{
      to_place = toPlace;
    }

    if(trspAgent == ''){
      transpAgent = 0;
    }else{
      transpAgent = trspAgent;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.location.href = "{{ url('/report/logistic/trip-planning/monthly-trip-planning-report-excel/') }}"+'/'+from_date+'/'+to_date+'/'+vehicleType+'/'+Consinee+'/'+from_place+'/'+to_place+'/'+transpAgent;

    /*window.location.href = "{{ url('/report/purchase/purchase-monthly-order/purchase-monthly-order-excel/') }}"+'/'+vehicleType+'/'+from_date+'/'+to_date+'/'+Consinee+'/'+transpAgent+'/'+plant+'/'+from_place+'/'+to_place;*/
       
  }


/* START : Load Data Table */
var blankData = 'Blank';
load_data_query(blankData=='');


function load_data_query(rack_no= '', stocksummary='',cust_no= '',item_code= '',wagon_no= ''){

	var date1 = new Date();
	var month = date1.getMonth() + 1;
	var tdate = date1.getDate();
	var mn = month.toString().length > 1 ? month : "0" + month;
	var yr = date1.getFullYear();
	var hr =  date1.getHours(); 
	var min = date1.getMinutes();
	var sec = date1.getSeconds(); 

	var curr_date = tdate+''+mn+''+yr;
	var curr_time = hr+':'+min+':'+sec;

  $('#stockSummaryRtTbl').DataTable({

  	

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
        var receivQty = api
                  .column( 5 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

        var a_receivQty = api
                  .column( 6 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

        var qtyissue = api
                  .column(7)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

        var a_qtyissue = api
                  .column(8)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);



        var rowcount = data.length;
        
        if(rowcount > 0){
           $('.buttons-excel').attr('disabled',false);
        }else{
           $('.buttons-excel').attr('disabled',true);
        }

        if(stocksummary == 'SS1'){

  	     	// $('td:nth-child(3),th:nth-child(3)').hide();
  	     	// $( api.column(2).visible( false ));
	    
	      }else if(stocksummary == 'SS2'){

  	     	$('td:nth-child(1),th:nth-child(1)').hide();
         //  $('td:nth-child(2),th:nth-child(2)').hide();
  	     	$( api.column(0).visible( false ));

	      }else{

        }

        var closeQty = receivQty - qtyissue;
        $( api.column(4).footer() ).html('Total :-').css('text-align','right');
        $( api.column(5).footer() ).html(receivQty);
        $( api.column(6).footer() ).html(a_receivQty);
        $( api.column(7).footer() ).html(qtyissue);
        $( api.column(8).footer() ).html(a_qtyissue);
        $( api.column(9).footer() ).html(closeQty.toFixed(2));
        $( api.column(11).footer() ).html(a_receivQty - a_qtyissue);
        
            
      },
    
        
      processing: true,
      serverSide: true,
      scrollX: true,
      pageLength:'25',
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
      buttons: [
                {
                  extend: 'excelHtml5',
                  title: 'stock_summary_'+curr_date+'_'+curr_time,
                  footer: true
                }
                ],
      ajax:{
        url:'{{ url("/get-data-stock-summary-report") }}',

        data: {rack_no:rack_no,stocksummary:stocksummary,cust_no:cust_no,item_code:item_code,wagon_no:wagon_no},

      },
      columns: [



        { data :'RAKE_NO',className:'RAKE_NO'},
        { data :'WAGON_NO',className:'WAGON_NO'},
        {
            render: function (data, type, full, meta){
              
            var cp_code = full['CP_CODE'];
            var cp_name = full['CP_NAME'];
          
            var cp_codename =  cp_name +'[' + cp_code + ' ] ';

            return cp_codename;

          }
         
            
        },
        { data :'BATCH_NO',className:''},
        {
            render: function (data, type, full, meta){
              
            var item_code = full['ITEM_CODE'];
            var item_name = full['ITEM_NAME'];
          
            var item_codename =  item_name +'[' + item_code + ' ] ';

            return item_codename;

          }
           
        },
        
        {data:'SQTYRECD',
	         render:function (data, type, full) {
	         return parseFloat(data).toFixed(2);
	    	 },className:'text-right'},

        {data:'SAQTYRECD',
           render:function (data, type, full) {
	         return parseFloat(data).toFixed(2);
	    	 },className:'text-right'},

        {data:'SQTYISSUED', 
            render:function (data, type, full) {
	         return parseFloat(data).toFixed(2);
	    	},className:'text-right'
	    },

        {data:'SAQTYISSUED',

           render:function (data, type, full) {
	         return parseFloat(data).toFixed(2);
	    	},className:'text-right'
    	},
        {
            render: function (data, type, full, meta){
              
            var qty_recd  = full['SQTYRECD'];
            var qty_issue = full['SQTYISSUED'];
           
            var close_qty =  qty_recd - qty_issue;

            return close_qty.toFixed(2);

          },className:'text-right'
           
        },

       //  {
       //    render: function ( data, type, row ) {
       //   var qty_recd  = row['SQTYRECD'];
       //   var qty_issue  = row['SQTYISSUED'];
       //   var running_total = qty_recd - qty_issue;
       //   return running_total;
       //   }
       // },

        {render: function (data, type, full, meta){
           var um        = full['UM'];
          return um;
        },className:"text-center"
        },

        { render: function (data, type, full, meta){
              
            var aqty_recd  = full['SAQTYRECD'];
            var aqty_issue = full['SAQTYISSUED'];
            
            var aclose_qty =  aqty_recd - aqty_issue;

            return aclose_qty.toFixed(2);

          },className:'text-right'
           
        },

        {render: function (data, type, full, meta){
           var aum        = full['AUM'];
          return aum;
        },className:"text-center"
        },
       
        
        
      ]


  });


}


/* END : Load Data Table */

  


  $(document).ready(function() {


/* ..........START : Search Button Click ......... */

$('#ProceedBtnId').click(function(){
  
  var rack_no      =  $('#rack_no').val();
  var stocksummary =  $('#stock_summary').val();
  var custno       =  $('#cust_no').val();
  var cust_name    =  $('#cust_name').val();
  var itemcode     =  $('#item_code').val();
  var wagon_no     =  $('#wagon_no').val();
  var item_name    =  $('#item_name').val();



  var splitecust = custno.split('-');

  var cust_no = splitecust[0];
  var splitItem = itemcode.split('-');

  var item_code = splitItem[0];

    if (stocksummary!='') {

    	$('#stocksumm_err').html('');
	    $('#ProceedBtnId').attr('disabled',true);
	    $('#cust_no').attr('disabled',true);
	    $('#item_code').attr('disabled',true);
      $('#wagon_no').attr('disabled',true);
	    $('#rack_no').attr('disabled',true);
	    $('#stock_summary').attr('disabled',true);

      if(rack_no!= '' || wagon_no != '' || custno!='' || itemcode!= ''){

        $('#stockSummaryRtTbl').DataTable().destroy();
        $('#errmsg').html('');
        load_data_query(rack_no,stocksummary,cust_no,item_code,wagon_no);

      }else{
        $('#stockSummaryRtTbl').DataTable().destroy();
        load_data_query();
        // if(stocksummary == 'SS1'){

        //    $('#errmsg').html('Select Rake, Consignee or Item No.').css('color','red');

        // }else if(stocksummary == 'SS2'){

        //    $('#errmsg').html('Select Consinee Or Item No.').css('color','red');

        // }else if(stocksummary == 'SS3'){

        //    $('#errmsg').html('Select Rake, Wagon,Consinee Or Item No.').css('color','red');
        // }
       
        // return false;
      }

	    

    }else{
    
	    $('#stocksumm_err').html('Please select Stock Summary').css('color','red');
	      return false;

	    $('#stockSummaryRtTbl').DataTable().destroy();

    load_data_query();

  }

});

/* ..........END : Search Button Click ......... */


    $('#ResetId').click(function(){

	    $('#tripPlanReportTbl').DataTable().destroy();

        $("#from_date").prop('readonly',false);
        $("#to_date").prop('readonly',false);        
      	$("#cust_no").prop('readonly',false);
      	$("#transpAgentId").prop('readonly',false);
      	$("#from_place").prop('disabled',false);
      	$("#to_place").prop('disabled',false);
     

    });
  

});


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

@endsection