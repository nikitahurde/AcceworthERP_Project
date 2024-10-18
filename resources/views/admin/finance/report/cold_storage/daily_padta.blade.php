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

           Daily Padta(Profitabilty)
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">Cold Storage</a></li>
            
            <li class="active"><a href="#">Stock Summary</a></li>

          </ol>

        </section>

<section class="content">

    <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Daily Padta(Profitability)</h2>


        </div><!-- /.box-header -->

        <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

            <div class="row">

                <div class="col-md-2">

                    <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                    $ToDate= date("d-m-Y", strtotime($toDate));   ?>

                    <div class="form-group">

                      <label for="exampleInputEmail1">From Date  <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="from_dt" name="from_dt" class="form-control fromDatePc pull-left" value="{{$FromDate}}" placeholder="Select From Date" autocomplete="off" >
                      

                      </div>
                      <small id="show_err_fr_date"></small>
                  </div>
                  

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">To Date :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input type="text" id="to_date" name="to_date" class="form-control toDatePc  pull-left" value="{{$ToDate}}" placeholder="Select To Date" autocomplete="off">

                      </div>
                       <small id="show_err_to_date"></small>
                    </div>
                  
                </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Customer Code :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="cust_list" id="cust_no" name="cust_no" class="form-control  pull-left" value="" placeholder="Select Customer Code" autocomplete="off">
                          
                          <datalist id="cust_list">

                            @foreach($acc_list as $rows)
                               <option value="{{$rows->ACC_CODE}} - {{$rows->ACC_NAME}}" data-xyz ="{{ $rows->ACC_NAME }}">{{$rows->ACC_CODE}} - {{$rows->ACC_NAME}}</option>
                            @endforeach
                            
                          </datalist> 
 
                      </div>
 
                  </div>
                
                </div>

                <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Vehicle No :</label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>

                      <input list="vehicle_list" id="vehicle_no" name="vehicle_no" class="form-control  pull-left" value="" placeholder="Select Vehicle No" autocomplete="off">
                      <datalist id="vehicle_list">
                         @foreach($vehicle_list as $rows)

                         <!-- <?php echo $rows->VEHICLE_NO; ?> -->
                               <option value="{{$rows->VEHICLE_NO}}"data-xyz ="{{ $rows->VEHICLE_NO }}">{{ $rows->VEHICLE_NO }}</option>
                            @endforeach
                      </datalist>
                  </div>
                </div>
              </div>
              <div class="col-md-3">

                <div class="form-group" >

                  <label for="exampleInputEmail1"style="padding: 0.5%;">Owner :</label>

                  <div class="form-group">

                      <input type="radio" id="owner_op" value="Self" name="optradio">&nbsp;<b>Self &nbsp;</b>  
                 
                      <input type="radio" id="owner_op" value="Market" name="optradio">&nbsp;<b>Market &nbsp; </b> 
                
                      <input type="radio" id="owner_op" value="Both" name="optradio" checked>&nbsp;<b>Both  &nbsp;</b> 
              
                  </div>

                </div>
                    
              </div>
 

            </div><!-- /. 1st row -->

            <div class="row">
             
              

            </div>


              <div class="row">

              
                <div class="col-md-4" style="margin-top: 1%;"><small id="errmsg" style="font-weight:600;font-size: 14px;" ></small></div>

                <div class="col-md-4 text-center" style="margin-top: 1%;">

                  
                  <button type="button" class="btn btn-primary" id="ProceedBtnId">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                  <button type="button" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>
                </div>

                  <div class="col-md-4"></div>

              </div>


        </div><!-- /.box-body -->

        	<div class="box-body" style="margin-top: 1%;">

                <table id="profitAbRtTbl" class="table table-bordered table-striped table-hover">
                  <thead class="theadC">

                    <tr>
                       <tr>
                      <th class="text-center" width="5%" id="thRakeNo">Vr Date</th>
                      <th class="text-center" width="5%" id="thRakeNo">Vrno</th>
                      <th class="text-center" width="8%" id="">Vehicle No</th>
                      <th class="text-center" width="5%">Owner</th>
                      <th class="text-center" width="5%">Acc Code</th>
                      <th class="text-center" width="10%">Acc Name</th>
                      <th class="text-center" width="9%">From Place</th>
                      <th class="text-center" width="9%">To Place</th>
                      <th class="text-center" width="6%">Freight Qty</th>
                      <th class="text-center" width="6%">FSO Rate</th>
                      <th class="text-center" width="6%">Dr Amt</th>
                      <th class="text-center" width="6%">FPO Rate</th>
                      <th class="text-center" width="6%">Cr Amt</th>
                      <th class="text-center" width="6%">Expense Amt</th>
                      <th class="text-center" width="8%">Profit</th>
                      
                     
                      
                    </tr>
                      
                     
                      
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

          // $('#stock_summary_modal').modal('show');

          var fromdateintrans = $('#from_dt').val();
          console.log('fromdateintrans',fromdateintrans);
          var todateintrans = $('#to_date').val();

          $('.fromDatePc').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            startDate :fromdateintrans,

            endDate : todateintrans,

            todayHighlight: 'true',

            autoclose: 'true'

          });

          $('.toDatePc').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            startDate :fromdateintrans,

            endDate : todateintrans,

            todayHighlight: 'true',

            autoclose: 'true'

          });

        });

	});

 
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
var owner = '';
load_data_query(blankData='',owner= '');


function load_data_query(blankData= '',owner= '',from_dt= '',to_dt= '',vehicle_no= '',custno= ''){
  console.log('ownerfn',owner);

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

  $('#profitAbRtTbl').DataTable({

  	

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
        var rowcount = data.length;
        
        if(rowcount > 0){
           $('.buttons-excel').attr('disabled',false);
        }else{
           $('.buttons-excel').attr('disabled',true);
        }

            
      },
      
      processing: true,
      serverSide: true,
      scrollX: true,
      pageLength:'25',
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
      buttons: [
                {
                  extend: 'excelHtml5',
                  title: 'daily_padta_'+curr_date+'_'+curr_time,
                  footer: true
                }
                ],
      ajax:{
        url:'{{ url("/get-data-daily-padta-report") }}',

        data: {blankData:blankData,owner:owner,from_dt:from_dt,to_dt:to_dt,vehicle_no:vehicle_no,custno:custno},

      },
      columns: [



        { data :'VRDATE',className:'text-right'},
        { data :'VRNO'},
        { data :'VEHICLE_NO'},
        { data :'OWNER'},
        { data :'ACC_CODE'},
        { data :'ACC_NAME'},
        { data :'FROM_PLACE'},
        { data :'TO_PLACE'},
        { data :'FREIGHT_QTY',className:'text-right'},
        { data :'FSO_RATE',className:'text-right'},
        { data :'DRAMT',className:'text-right'},
        { data :'FPO_RATE',className:'text-right'},
        { data :'CRAMT',className:'text-right'},
        { data :'EXPAMT',className:'text-right'},
        { data :'PROFIT',className:'text-right'},
        
      ]


  });


}


/* END : Load Data Table */

  


  $(document).ready(function() {


/* ..........START : Search Button Click ......... */

$('#ProceedBtnId').click(function(){
  
  var owner      =  $("input[type='radio'][name='optradio']:checked").val();
  var from_date  = $('#from_dt').val();
  var to_date    = $('#to_date').val();
  var vehicle_no = $('#vehicle_no').val();
  var cust_no    = $('#cust_no').val();

  console.log('owner',owner);

  var splitecust = cust_no.split('-');

  var custno = splitecust[0];

  blankData = '';

  if(owner != '' || from_date !='' || to_date !='' || vehicle_no !='' || custno !=''){

    $('#profitAbRtTbl').DataTable().destroy();
    load_data_query(blankData,owner,from_date,to_date,vehicle_no,custno);

    if(from_date == ''){
       $('#show_err_fr_date').html('Select From Date').css('color','red');
       return false;

    }else if(to_date == ''){

       $('#show_err_to_date').html('Select To Date').css('color','red');
       return false;
    }else{
       $('#show_err_fr_date').html('');
       $('#show_err_to_date').html('');
    }
    
   $('#from_dt').prop('disabled',true);
   $('#to_date').prop('disabled',true);
   $('#vehicle_no').prop('disabled',true);
   $('#cust_no').prop('disabled',true);
   $('#ProceedBtnId').prop('disabled',true);


  }else{

    

     // $('#profitAbRtTbl').DataTable().destroy();
     // load_data_query(blankData,owner,from_date,to_date,vehicle_no,custno);

     // $('#from_dt').prop('disabled',true);
     // $('#to_date').prop('disabled',true);
     // $('#vehicle_no').prop('disabled',true);
     // $('#cust_no').prop('disabled',true);
     // $('#ProceedBtnId').prop('disabled',true);
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