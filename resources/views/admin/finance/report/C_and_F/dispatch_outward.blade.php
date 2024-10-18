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

          Dispatch - Outward
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">C and F</a></li>
            
            <li class="active"><a href="{{ url('/report/logistic/trip-planning/monthly-trip-planning-report') }}">Dispatch - Outward</a></li>

          </ol>

        </section>

<section class="content">

    <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Dispatch - Outward</h2>


        </div><!-- /.box-header -->

        <div class="box-body">

            <?php date_default_timezone_set('Asia/Kolkata'); ?>

            <div class="row">
               
              <div class="col-md-2">

               <div class="form-group">

                <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                    $ToDate= date("d-m-Y", strtotime($toDate));   ?>

                  <label for="exampleInputEmail1"> From Date: </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                   
                    <input type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Select Transaction Date" value="{{$FromDate}} " autocomplete="off" >

                  </div>

                  <small id="show_err_from_date">

                  </small>

               </div>

            </div>

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1"> To Date: </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                  </div>

                  <input type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Select Transaction Date" value="{{$ToDate}}" autocomplete="off">

                </div>

                <small id="show_err_to_date">

                </small>

              </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Rake No : </label>

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
            </div>

            <div class="row">

              <div class="col-md-4" style="margin-top: 1%;"></div>

              <div class="col-md-4 text-center" style="margin-top: 1%;">

                  
                <button type="button" class="btn btn-primary" id="ProceedBtnId">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                 <button type="button" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

              </div>

              <div class="col-md-4"></div>

            </div>

          </div><!-- /.box-body -->

        	<div class="box-body" style="margin-top: 1%;">

                <table id="GrnInwordRtTbl" class="table table-bordered table-striped table-hover">
                  <thead class="theadC">

                    <tr>
                      <th class="text-center" width="3%" >Rake No</th>
                      <th class="text-center" width="5%" >Vr Date</th>
                      <th class="text-center" width="5%" >LR No</th>
                      <th class="text-center" width="5%" >LR Date</th>
                      <th class="text-center" width="5%" >Account Code</th>
                      <th class="text-center" width="10%" >Account Name</th>
                      <th class="text-center" width="6%" >Consignee Code</th>
                      <th class="text-center" width="12%" >Consignee Name</th>
                      <th class="text-center" width="6%" >Sold To Party Code</th>
                      <th class="text-center" width="12%" >Sold To Party Name</th>
                      <th class="text-center" width="5%" >Vehicle No</th>
                      <th class="text-center" width="5%" >Transporter Code</th>
                      <th class="text-center" width="10%" >Transporter Name</th>
                      <th class="text-center" width="5%" >To Place</th>
                      <th class="text-center" width="5%" >DO No.</th>
                      <th class="text-center" width="5%" >Delivery No.</th>
                      <th class="text-center" width="8%">Wagon No.</th>
                      <th class="text-center" width="8%">Batch No.</th>
                      <th class="text-center" width="8%">Invoice No.</th>
                      <th class="text-center" width="6%">Item Code</th>
                      <th class="text-center" width="12%">Item Name</th>
                      <th class="text-center" width="10%">Remark</th>
                      <th class="text-center" width="4%">Qty Issued</th>
                      <th class="text-center" width="3%">UM</th>
                      <th class="text-center" width="4%">A-Qty-Issued</th>
                      <th class="text-center" width="3%">AUM</th>
                      <th class="text-center" width="4%">Location Code</th>
                      <th class="text-center" width="4%">Location Name</th>
                      
                     </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
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

          $('#from_date').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });

          $('#to_date').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });



        });

	});


  
/* START : Load Data Table */
var blankData = 'Blank';
load_data_query(blankData=='');


function load_data_query(rack_no= '',cust_no= '',item_code= '',wagon_no= '',from_date= '', to_date= ''){

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
   
  $('#GrnInwordRtTbl').DataTable({

        footerCallback: function ( row, data, start, end, display ) {
          var api = this.api(), data;

          var rowcount = data.length;
          var getRow = rowcount-1;
          
          if(rowcount > 0){
             $('.buttons-excel').attr('disabled',false);
          }else{
             $('.buttons-excel').attr('disabled',true);
          }

        // converting to interger to find total
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[\$,]/g, '')*1 :
                typeof i === 'number' ?
                    i : 0;
        };

        var rowcount = data.length;
        var getRow = rowcount-1;
        var issueQty = api
                  .column( 20 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(3);

        var a_issueQty = api
                  .column( 22 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(3);

       
        var rowcount = data.length;
        
        if(rowcount > 0){
           $('.buttons-excel').attr('disabled',false);
        }else{
           $('.buttons-excel').attr('disabled',true);
        }


        $( api.column(19).footer() ).html('Total :-').css('text-align','right');
        $( api.column(20).footer() ).html(issueQty);
        $( api.column(22).footer() ).html(a_issueQty);
       
            
      },
  	
    
        
        processing: true,
        serverSide: false,
        info: true,
        bPaginate: false,
        scrollY: 400,
        scrollX: true,
        scroller: true,
        fixedHeader: true,
        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
        buttons:  [
                    {
                      extend: 'excelHtml5',
                      
                      title: ' DISPATCH OUTWARD'+$("#headerexcelDt").val(),
                      filename: 'DISPATCH_OUTWARD_'+$("#headerexcelDt").val(),
                    }
                  ],
      ajax:{
        url:'{{ url("/get-data-dispatch-outward-report") }}',

        data: {rack_no:rack_no,cust_no:cust_no,item_code:item_code,wagon_no:wagon_no,from_date:from_date,to_date:to_date
      },

      },
      columns: [

        {data :'RAKE_NO',className:'text-right'},

        { data :'VRDATE',
         render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" +  date.getFullYear();
                  }
            },className:'text-right'},

        { data :'LR_NO',className:'text-left'},
        { data :'LR_DATE',
         render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "/" + (month.toString().length > 1 ? month : "0" + month) + "/" +  date.getFullYear();
                  }
            },className:'text-right'},
        { data :'ACC_CODE',className:'text-left'},
        { data :'ACC_NAME',className:'text-left'},
        { data :'CP_CODE',className:'text-left'},
        { data :'CP_NAME',className:'text-left'},
        { data :'SP_CODE',className:'text-left'},
        { data :'SP_NAME',className:'text-left'},
        { data :'VEHICLE_NO',className:'text-left'},
        { data :'TRPT_CODE',className:'text-left'},
        { data :'TRPT_NAME',className:'text-left'},
        { data :'TO_PLACE',className:'text-left'},
        { data :'ORDER_NO',className:'text-left'},
        { data :'DELIVERY_NO',className:'text-left'},
        { data :'WAGON_NO',className:'text-left'},
        { data :'BATCH_NO',className:'text-left'},
        { data :'INVOICE_NO',className:'text-right'},
        { data :'ITEM_CODE',className:'text-left'},
        { data :'ITEM_NAME',className:'text-left'},
        { data :'REMARK',
          render : function (data, type, full, meta){
            var remk =  full['REMARK']!= 'null'  ?  full['REMARK'] : '----';
            return remk;
          }
          ,className:'text-left'
        },        
                
        {data:'NET_WEIGHT',
	         render:function (data, type, full) {
	         return parseFloat(data).toFixed(3);
	    	 },className:'text-right'},

        { data :'UM',className:'text-left'},

        {data:'AQTISSUED',
           render:function (data, type, full) {
	         return parseFloat(data).toFixed(3);
	    	 },className:'text-right'},

        { data :'AUM',className:'text-left'},

        {data:'LOCATION_CODE',className:'text-left'},
        { data:'LOCATION_NAME',className:'text-left'},
        
      ]


  });


}


/* END : Load Data Table */

  


$(document).ready(function() {




/* ..........START : Search Button Click ......... */

$('#ProceedBtnId').click(function(){
  
  var rack_no      =  $('#rack_no').val();
  var custno       =  $('#cust_no').val();
  var cust_name    =  $('#cust_name').val();
  var itemcode     =  $('#item_code').val();
  var wagon_no     =  $('#wagon_no').val();
  var item_name    =  $('#item_name').val();
  var from_date    =  $('#from_date').val();
  var to_date    =  $('#to_date').val();
  
  var splitecust = custno.split('-');

  var cust_no = splitecust[0];
  var splitItem = itemcode.split('-');

  var item_code = splitItem[0];

  if(to_date != ''){

     console.log('grn');

      $('#ProceedBtnId').attr('disabled',true);
      $('#cust_no').attr('disabled',true);
      $('#item_code').attr('disabled',true);
      $('#wagon_no').attr('disabled',true);
      $('#rack_no').attr('disabled',true);
      $('#to_date').attr('disabled',true);
      $('#from_date').attr('disabled',true);
      
      $('#GrnInwordRtTbl').DataTable().destroy();
      $('#show_err_to_date').html('');
      load_data_query(rack_no,cust_no,item_code,wagon_no,from_date,to_date);

  }else{

    $('#show_err_to_date').html('Please select to date').css('color','red');

    // load_data_query();
    console.log('not grn');

  }

  

 

});

/* ..........END : Search Button Click ......... */


   
  

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