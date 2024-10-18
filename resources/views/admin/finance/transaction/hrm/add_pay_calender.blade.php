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

  .required-field::before {
    content: "*";
    color: red;
  }

  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }

  .showinmobile{
    display: none;
  }

  .secondSection{
    display: none;
  }

  .tolrancehide{
    display: none !important;
  }

  .datepicker-inline {
    width: 20% ;
    padding : 10px;
  }

  .table-condensed thead tr{
      background-color: blue !important;
      color: white;
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
      max-width: 1200px
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

  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

      padding: 6px;
      padding-bottom: 0px !important;
      line-height: 1.42857143;
      vertical-align: top;
      border-top: 1px solid #ddd;
      text-align: center;

  }

  .rightcontent{
    text-align:right;
  }

  ::placeholder {
    text-align:left;
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
      margin-left: -5px;
  }

  .instTypeMode{
      width: 56%;
      margin-bottom: 5px;

  }

  .textdesciptn{
    width: 250px;
    margin-bottom: 5px;

  }

  .tdsratebtn{
    margin-top: 3% !important;
    font-weight: 600 !important;
    font-size: 10px !important;
  }

  .tdsInputBox{
    margin-bottom: 2%;
  }

  .modltitletext{
    font-weight: 800;
    color: #5696bb;
    font-size: 16px;
    text-align: center;
  }

  .textSizeTdsModl{
    font-size: 13px;
  }

  .btn_new{
      display: inline-block;
      font-weight: 600;
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      padding: 0.375rem 0.75rem;
      font-size: 14px;
      line-height: 1.5;
      border-radius: 1.25rem;
      transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;

  }

  .bankshowwhenrecpt{
    display: none !important;
  }

  .setboxWidthIndex{
    width: 25px;
    border: 1px solid #b8b6b6;
  }

  .SetInCenter{
    margin-top: 18%;
  }

  .AddM{
    width: 24px;
  }

  .divhsn{
    color: #3c8dbc;
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 8%;
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

  .settaxcodemodel{
    font-size: 16px;
    font-weight: 800;
    color: #5d9abd;

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

  .boxer .ebay {
    padding:5px 1.5em;
  }

  .boxer .google {
    padding:5px 1.5em;
  }

  .boxer .amazon {
    padding:5px 1.5em;
  }

  .center {
    text-align:center;
  }

  .right {
    float:right;
  }

  .texIndbox{
    text-align: center;
    width: 5%;
  }

  .rateIndbox{
    text-align: center;
    width: 15%;
  }

  .vrnoinbox{
    width: 10%;
    text-align: center;
  }

  .rateBox{
    width: 20%;
    text-align: center;
  }

  .itemIndbox{
    width: 30%;
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

  .showind_Ch{
    display: none;
  }
  .itmbyQc{
    display: none;
  }
  .notshowcnlbtn{
    display: none;
  }
  .aplynotStatus{
    display: none;
  }
  .batchNoC{
    font-weight: 700;
    width: 57px;
    margin-top: 1%;
    margin-right: 2%;
    color: #3c8dbc;
  }
  .showbatchnum{
    width: 135px;
    margin-bottom: 2%;
    height: 26px;
  }
  .setbatchnoandref{
    display: flex;

  }
  .hidebatchnoinput{
    display: none;
  }

  #calendar table{
  	width: 500% !important;
  }
  .AddMList{
  width: 40px;
  }
  .taxcodeset{
  margin-right: 11px !important;
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

    .rowClass{
      overflow-x: scroll;
    }

  }
  

</style>



<div class="content-wrapper">

  <section class="content-header">

   

      <h1>

        Pay Calendar

        <small>Add Details</small>

      </h1>

      <ul class="breadcrumb">

        <li>

          <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>

        </li>

        <li>

          <a href="{{ url('/dashboard') }}">Master</a>

        </li>

        <li class="active">

          <a href="{{ url('/finance/form-transaction-mast') }}">Pay Calendar</a>

        </li>
        <li class="active">

          <a href="{{ url('/finance/form-transaction-mast') }}">Add Pay Calendar</a>

        </li>

      </ul>

  </section>

<!-- section close -->

<!-- section open -->

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Pay Calendar</h2>

            <div class="box-tools pull-right">

                <a href="{{url('/Master/Setting/view-pay-calender')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Pay Calendar</a>

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

          <div class="overlay-spinner hideloader"></div>

            <div class="row">

              <div class="col-md-12">

                <div class="panel with-nav-tabs panel-info">

                  <div class="panel-heading">

                    <ul class="nav nav-tabs">

                      <li class="active" id="firstTab">

                        <a href="#tab1info" id="basicInfo" data-toggle="tab">Basic Info</a>

                      </li>

                      

                    </ul>

                  </div>

                  <div class="panel-body">

                    <div class="tab-content">

                      <div class="tab-pane fade in active" id="tab1info">
                      
                       <form action="{{ url('/Master/Setting/add-pay-calendar-save') }}" method="POST" enctype="multipart/form-data">

                         @csrf
                        <div class="row">
                              <!-- /.col -->
                          <div class="col-md-3">

                            <div class="form-group">
                              
                              <label>Month Year: <span class="required-field"></span></label>

                              <div class="input-group">
                                
								                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="text" class="form-control  fydatepicker rightcontent" name="month_yr" id="month_yr"value="" onchange="funmonthyr()" autocomplete="off" placeholder="Month Year" >

                               
                              </div>
                              <small id="month_yrErr"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('month_yr', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>
                            </div>

                                    <!-- /.form-group -->
                          </div>

                          <div class="col-md-3">



    		                    <div class="form-group">

    								          <label>Company Code: <span class="required-field"></span></label>

              								<div class="input-group">
              									<span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

              									<input type="text" class="form-control" name="comp_code" id="comp_code" value="{{$compName}}" readonly>
                              </div>
                              
                             <small id="comp_codeErr"></small>

                         		 <small id="emailHelp" class="form-text text-muted">

                         		 	{!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

              							 </small>

    							         </div>

						          </div>

						          <div class="col-md-3">

                            <div class="form-group">

                              <label>Plant Code: </label>

                             <div class="input-group">

		                        	<span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

		                          <input list="plant_list"  id="plant_code" name="plant_code" class="form-control  pull-left" value="{{ old('plant_code')}}" placeholder="Plant Code" autocomplete="off"/>

  		                        <datalist id="plant_list">
  		                        
  		                           <option value="">--SELECT--</option>

  		                           @foreach($plantData as $rows)

  		                           	<option value="{{ $rows->PLANT_CODE }}" data-xyz ="{{ $rows->PLANT_NAME }}">{{ $rows->PLANT_CODE }} = {{ $rows->PLANT_NAME }}</option>

  		                           @endforeach

  		                        </datalist>

		                         </div>

                             <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                              </small>

                            </div>
                                <!-- /.form-group -->
                         </div>
                            <!-- /.col -->

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Plant Name: </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input  class="form-control" id="plantName" name="plant_name" placeholder="Plant Name" value="{{old('plant_name')}}" readonly>

                              </div>

                            </div>
                                <!-- /.form-group -->
                          </div>

                       </div>
                        
                       <div class="row">
                            
                           <div class="col-md-2">

                            <div class="form-group">

                              <label>Profit Center Code: </label>

                              <div class="input-group">

		                        	<span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

		                          <input list="pfct_list"  id="pfct_code" name="Profit_center_code" class="form-control  pull-left" value="{{ old('Profit_center_code')}}" placeholder="PFCT Code" maxlength="11" autocomplete="off"/>

		                        <datalist id="pfct_list">
		                        
		                           <option value="">--SELECT--</option>

		                           @foreach($profit_list as $rows)

		                           	<option value="{{ $rows->PFCT_CODE }}" data-xyz ="{{ $rows->PFCT_NAME }}">{{ $rows->PFCT_CODE }} = {{ $rows->PFCT_NAME }}</option>

		                           @endforeach

		                        </datalist>

		                      </div>

                            </div>
                            
                          </div>

                          <div class="col-md-3">

                            <div class="form-group">

                              <label>Profit Center Name: </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input  id="profitcenter_name" name="profitcenter_name" class="form-control  pull-left" value="{{old('profitcenter_name')}}" placeholder="Profit Center Name" readonly>

                              </div>

                            </div>
                                <!-- /.form-roup -->
                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label>Month Days: </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                                </div>

                                <input  class="form-control" id="month_days" name="month_days" placeholder="Month Days" value="{{old('month_days')}}" readonly>

                              </div>

                            </div>
                                
                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label>Holidays : </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                                </div>

                                <input  class="form-control" id="holidays" name="holidays" placeholder="Holidays" value="{{old('holidays')}}" readonly>

                                <input type="hidden" id="holidayDate" value="" name="holidayDate">

                              </div>

                            </div>
                                
                          </div>

                          <div class="col-md-2">

                            <div class="form-group">

                              <label>Work Days : </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                                </div>

                                <input  class="form-control" id="work_days" name="work_days" placeholder="Work Days" value="{{old('work_days')}}" readonly>

                              </div>

                            </div>
                                
                          </div>

					  </div>

					  <div class="row">
					  	
             <div class="box box-solid bg-green-gradient">
		                <div class="box-header">
		                  <i class="fa fa-calendar"></i>
		                  <h3 class="box-title">Calendar</h3>
		                </div>

		                <div class="box-body no-padding">
		                 <div id="calendar" style="width: 106%"></div>
		                </div>
		                
		          </div>

					  </div>

					  <div class="row text-center">

                <button type="submit" class="btn btn-success" style="margin-top: 12px;" id="submitdata" disabled="true"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                 <button type="button" class="btn btn-warning" style="margin-top: 12px;" id="nextbtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>

	         </div> <!-- row -->
	       </form>

                      </div>
                      
                    </div>
                      
                  </div>
                   
                </div><!-- ./panel with-nav-tabs panel-info -->

              </div><!-- ./col -->

            </div><!-- ./row -->

          </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->


  

</div>



@include('admin.include.footer')


<script type="text/javascript">

  $( window ).on( "load", function() {

    $('.fydatepicker').datepicker({

       format: 'MM yyyy',
       viewMode: "months", 
       minViewMode: "months",
       dateFormat : "yyyy-mm-dd",
       autoclose:true

	});
 })

  function funmonthyr(){

        	var mon_yr = $('#month_yr').val();
        	
          var spliteval = mon_yr.split(/\b(\s)/);

          var year  = spliteval[2];
          var month = spliteval[0];

    
        	function getDaysInMonth(month,year) {

        	 return new Date(year, month, 0).getDate();

        	};

        	function getMonthFromString(month,year){

        		return new Date(Date.parse(month +" 1", year)).getMonth()+1

        	}

          var monthInNo = getMonthFromString(month,year);

          var daymonth = getDaysInMonth(monthInNo,year);

   
      
          $('#month_days').val(daymonth);

          var default_date = new Date(year, monthInNo-1);

          $("#calendar").datepicker("setDate", default_date);
  }

   

  $(document).ready(function(){

 

   $('#calendar').datepicker({
        
       multidate:true,

    });

   
    $('#calendar').on('changeDate', function(e){  
    // e.dates is an array
        var monthYr = $('#month_yr').val();

        var comp_code = $('#comp_code').val();
        if(monthYr == '' ){

           $('#month_yrErr').html("Select Month Year").css('color','red');

        }
        else{

           $('#month_yrErr').html("");
           $('#comp_codeErr').html("");
           $('#holidays').val(e.dates.length);
           $('#holidayDate').val(e.dates);

        var monthday  = $('#month_days').val();
        var holiday =  $('#holidays').val();

        var workdays = monthday - holiday;

        $('#work_days').val(workdays);

        if(holiday == '' || holiday == '0'){

          $('#submitdata').prop('disabled', true);

        }else{
          
           $('#submitdata').prop('disabled', false);
        }

        }

       
	});

  $("#plant_code").bind('change', function () {  

          var val = $(this).val();
          //console.log('val',val);
          var xyz = $('#plant_list option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
           // console.log('msg',msg);
          if(msg == 'No Match'){
              $(this).val('');
               $('#plantName').val('');
          }else{
            $('#plantName').val(msg);
          }


      });


      $("#pfct_code").bind('change', function () {  

          var val = $(this).val();
          // console.log('val',val);
          var xyz = $('#pfct_list option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
           // console.log('msg',msg);
          if(msg == 'No Match'){
              $(this).val('');
               $('#profitcenter_name').val('');
          }else{
            $('#profitcenter_name').val(msg);
          }


      });      
});

</script>
@endsection