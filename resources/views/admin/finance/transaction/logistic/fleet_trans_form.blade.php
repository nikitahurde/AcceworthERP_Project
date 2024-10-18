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
	/*border: 1px solid #e0dcdc;
	border-radius: 10px;
*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .content {
	min-height: 80px !important;
	padding: 0px !important;
	margin-right: auto !important;
	margin-left: auto !important;
	padding-left: 15px !important;
	padding-right: 15px !important;
}
.showSeletedName {
	font-size: 15px;
	margin-top: 2%;
	text-align: center;
	font-weight: 600;
	color: #4f90b5;
}

.vehiclenumup{
  text-transform: uppercase;
}
.tdthtablebordr{
	padding:3px !important;
}
#marketTable{
	display:none;
}
</style>

<style type="text/css">

  .rTable { display: table; }

.rTableRow { display: table-row; }

.rTableHeading { display: table-header-group; }

.rTableBody { display: table-row-group; }

.rTableFoot { display: table-footer-group; }

.rTableCell, .rTableHead { display: table-cell; }

  .rTable {
   display: table;
   /*width: 100%;*/
}

.rTableRow {

   display: table-row;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

}

.rTableCell, .rTableHead {

   display: table-cell;

   padding: 3px 10px;

   border: 1px solid #ebe7e7;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

   font-weight: bold;

}

.rTableFoot {

   display: table-footer-group;

   font-weight: bold;

   background-color: #ddd;

}

.rTableBody {

   display: table-row-group;

}

.setInline{

  display: flex;

  margin-bottom: 4px;

}

.rowClass{

  margin: 0px;

  margin-top: 3%;

}

.rowClass1{

  margin: 0px;

  margin-top: 0%;

}

.rowClassonModel{

   margin: 0px;

  margin-top: 1%;

}

.LableTextField{

  text-align: center;

  font-weight: 600;

}

.distClass{

  display: none;



}

.sgstBlock{

  display: none;

}

.cgstBlock{

  display: none;

}

.afforblck{

  display: none;

}

.affiveblck{

  display: none;

}

.afsixblck{

  display: none;

}

.afsevenblck{

  display: none;

}

.afheadeightblck{

  display: none;

}

.afheadnineblck{

  display: none;

}

.afheadtenblck{

  display: none;

}

.afheadelvnblck{

  display: none;

}

.afheadtwelblck{

  display: none;

}

.getheading{

  border: none;

  width: 61px;

}
.settaxcodemodel{
  font-size: 16px;
	font-weight: 800;
	color: #5d9abd;
}

thead th {
    height: 23px !important;
    background-color: #b8daff;
    text-align: center;
}

</style> 
<style>

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
    padding: 5px !important;
  }
  .boxer .hidebordritm {
    display: table-cell;
    vertical-align: top;
    border: none;
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
    width: 25%; 
    text-align: center;
  }
  .texIndbox1{
    width: 5%; 
    text-align: center;
    font-size: 12px;
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
    width: 12% !important;
    text-align: center;
  }
  .amountBox{
    width: 12% !important;
    text-align: center;
  }
  .inputtaxInd{
    background-color: white !important;
    border: none;
    text-align: center;
  }
  .showind_Ch{
    display: z;isplay: none;
  }
  .btn-group-sm>.btn, .btn-sm {
    padding: 2px 4px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
  }
  .amountrightAlign{
    text-align:right !important;
  }
  .textLeftaLign{
    text-align:left !important;
  }
</style>
<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		  <h1>
			Trip Expense
			<small>Add Details</small>
		  </h1>
		  <ol class="breadcrumb">
			<li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="{{ url('dashboard') }}">Trip Expense</a></li>
			<li><a href="{{ url('logistic/fleet-transaction') }}">Trip Expense</a></li>
			<li><a href="{{ url('logistic/fleet-transaction') }}">Add Trip Expense</a></li>
		  </ol>
		</section>
 

	 <form id="salesordertrans">
      @csrf
  <section class="content">
	<div class="row">
	 <!--  <div class="col-sm-2"></div> -->
	  <div class="col-sm-12" style="padding-top: 2%;">
		<div class="box box-info Custom-Box">

			<div class="box-header with-border" style="text-align: center;">
			  <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Trip Expense (Trip Creation) </h2>

			   <div class="box-tools pull-right">
				<a href="{{ url('/logistic/view-fleet-transaction') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Trip Expense</a>
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
		  

		  <div class="modalspinner hideloaderOnModl"></div>
			  
			   <div class="row">
				
				  <div class="col-md-2">
					<div class="form-group">
					  <label>
						Transaction Date : 
						<span class="required-field"></span>
					  </label>
						<div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						  <input type="text" class="form-control datepicker" name="date" placeholder="Enter Transaction Date" id="tr_date" value="{{ date('d-m-Y') }}">
						  <?php 
						  $diesel_rate_date = $diesel_rate->DATE;
						  $dt = date("d-m-Y", strtotime($diesel_rate_date)); ?>
						  <input type="hidden" name="diesel_rate_date" id="diesel_rate_date" value="<?= $dt ?>">
						</div>
						  <small id="emailHelp" class="form-text text-muted">
							{!! $errors->first('date', '<p class="help-block" style="color:red;">:message</p>') !!}
						  </small>

					</div>
					<!-- /.form-group -->
				  </div>

					
				  <div class="col-md-2">
					<div class="form-group">
					  <label>
						Trip No 
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
						  <input list="tripList" class="form-control" name="trip_no" value="{{ old('trip_no')}}" id="trip_no" placeholder="Enter Trip Number" style="text-transform:uppercase" onchange="getplanDetails()" autocomplete="off">

						  <datalist id="tripList">
							<?php foreach($trip_list as $key) {

										$vrNo = $key->VRNO;
										
										$SericeCode = $key->SERIES_CODE;
										
										$FyYr = $key->FY_CODE;
										
										$getYr = explode("-",$FyYr);
										
										$BgYr = $getYr[0];
										
										$newVrNo = $BgYr.' '.$SericeCode.' '.$vrNo; 


							  ?>
							  
							  <option value="<?= $newVrNo; ?>~<?= $key->TRIPHID; ?>" data-xyz="<?= $key->TRIPHID; ?>"><?= $key->VRDATE; ?> - <?= $newVrNo; ?> - <?= $key->VEHICLE_NO ?> - <?= $key->ACC_NAME ?>- <?= $key->TO_PLACE ?></option>
							<?php  } ?>
							
						  </datalist>


					  </div>
					    <input type="hidden" name="tripid" id="tripid">
						  <small id="emailHelp" class="form-text text-muted">
							{!! $errors->first('trip_no', '<p class="help-block" style="color:red;">:message</p>') !!}
						  </small>
						  <small id="tripErr" style="color: red;"></small>
					</div>
					<!-- /.form-group -->
				  </div>


				  <div class="col-md-2">
					<div class="form-group">
					  <label>
						Vehicle No: 
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-truck" aria-hidden="true"></i>
						  </span>
					   <input list="truckList" name="vehicle_no" id="vehicle_no" class="form-control vehiclenumup" placeholder="Enter Vehicle No" onchange="getplanDetails()" value="{{ old('vehicle_no') }}" autocomplete="off">

                                 <input type="hidden" name="tripHid" id="tripHid" value="">

					   <datalist id="truckList">

						  <?php foreach($trip_list as $key) { ?>

							 <option value="<?= $key->VEHICLE_NO ?>~<?= $key->TRIPHID; ?>" data-xyz="<?= $key->TRIPHID; ?>"><?= $key->VEHICLE_NO ?> - <?= $key->ACC_NAME ?>- <?= $key->TO_PLACE ?></option>

						   <?php  } ?>
						 
					   </datalist>

					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  <small id="vehicleErr" style="color: red;"></small>
					</div>
				  </div>


						<!-- /.col -->
					  <div class="col-md-2">

						<div class="form-group">

						  <label>Series Code: 

							<span class="required-field"></span>

						  </label>

						  <div class="input-group">

							<span class="input-group-addon" style="padding: 1px 7px;">
								 <i class="fa fa-newspaper-o" aria-hidden="true" id="serisicon"></i>

								<div class="" id="appndbtn">
									
								</div>
							</span>
							 
							<input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

							<datalist id="seriesList1">

							 

							</datalist>

						  </div>

						  <small id="series_code_errr" style="color: red;"></small>

						</div>
						<!-- /.form-group -->
					  </div>
					  <!-- /.col -->

					  <div class="col-md-3">

						<div class="form-group">

						  <label> Series Name : </label>

							<div class="input-group">

							  <div class="input-group-addon">

								<i class="fa fa-newspaper-o" aria-hidden="true"></i>

							  </div>


							  <input type="text" class="form-control" name="series_name" value="" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

							</div>

						</div>
						
					  </div>

					  

				 
				<!-- /.col -->


				  
				<!-- /.col -->

				  
				
			  </div>
			  <!-- /.row -->

			  <div class="row">

			  	<div class="col-md-2">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                               </span>
                            
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="" readonly autocomplete="off" onchange="PlantCode()">

                              <datalist id="PlantcodeList">

                                

                              </datalist>

                            </div>

                            <small>  

                                <div class="pull-left showSeletedName" id="plantText"></div>

                            </small>

                            <small id="plant_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Plant Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="plant_name" value="" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                       <div class="col-md-2">

                        <div class="form-group">

                          <label>Profit Center Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <input type="text"  id="profitctrId" name="pfct_code" class="form-control  pull-left" placeholder="Select Profit Center Code"  readonly >


                            </div>

                          <small id="profit_center_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                       <div class="col-md-3">

                        <div class="form-group">

                          <label> Profit Center Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="pfct_name" id="pfctName" placeholder="Enter Profit Center Name" readonly>

                            </div>

                        </div>
                        
                    </div>
                     <div class="col-md-2">

                        <div class="form-group">

                          <label> Customer Code : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="customer_code" id="customer_code" placeholder="Enter Customer Code" readonly>

                            </div>

                        </div>
                        
                    </div>

				  


			  </div>

			  <div class="row">

			  	<div class="col-md-3">

                        <div class="form-group">

                          <label> Customer Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter Customer Name" readonly>

                            </div>

                        </div>
                        
                    </div>

			  	<div class="col-md-2">
					<div class="form-group">
					  <label>
					   TRIP Type: 
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-user" aria-hidden="true"></i>
						  </span>
					   <input  list="triptypeList" name="trip_type" class="form-control" placeholder="Enter TRIP Type"  id="trip_type">

					   <datalist id="triptypeList">
					   		<option value="UP">UP</option>
					   		<option value="DOWN">DOWN</option>
					   </datalist>

					  </div>

					  <small id="tripTypeErr" style="color: red;"></small>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('wheel_type', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
				  </div>

			  	<div class="col-md-2">

					<div class="form-group">

					  <label>

					   From Place: 

						<span class="required-field"></span>

					  </label>

					  <div class="input-group">

						  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

						  <input list="fromplaceList" class="form-control" name="from_place" id="from_place"  value="" placeholder="Enter From Place" autocomplete="off" readonly/>

						  <datalist id="fromplaceList">

							<?php foreach ($area_list as $key) { ?>

							  <option value="<?= $key->AREA_CODE ?>" data-xyz="<?= $key->AREA_NAME ?>"><?= $key->AREA_CODE ?> [<?= $key->AREA_NAME ?>]</option>

							<?php } ?>
							
							
						  </datalist>

					  </div>

					  <small id="emailHelp" class="form-text text-muted">

						{!! $errors->first('from_place', '<p class="help-block" style="color:red;">:message</p>') !!}

					  </small>

					</div>

					<!-- /.form-group -->

				  </div>

				  <div class="col-md-2">

					<div class="form-group">

					  <label>

						To Place: 

						<span class="required-field"></span>

					  </label>

					  <div class="input-group">

						  <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>


						  <input list="toplaceList"  id="to_place" name="to_place" class="form-control pull-left" value="" placeholder="Enter To Place" autocomplete="off" readonly>

						   <datalist id="toplaceList">

							<?php foreach ($area_list as $key) { ?>

							  <option value="<?= $key->AREA_CODE ?>" data-xyz="<?= $key->AREA_NAME ?>"><?= $key->AREA_CODE ?> [<?= $key->AREA_NAME ?>]</option>

							<?php } ?>
							
							
						  </datalist>
					  </div> 

					  <small id="emailHelp" class="form-text text-muted">

						{!! $errors->first('to_place', '<p class="help-block" style="color:red;">:message</p>') !!}

					  </small>
					   <small>
						  <!-- <div class="pull-left showSeletedName" id="makeText"></div> -->
					  </small>

					</div>

				 
				</div>

				<div class="col-md-2">
					<div class="form-group">
					  <label>
					   Vehicle Inward No:  
						
					  </label>
					<div class="input-group">
						 <div class="input-group-addon">
							<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
						 </div>
					  <input list="vehicleInward" name="vehicle_inward_no" id="vehicle_inward_no" class="form-control" placeholder="Enter Inward No" value="{{ old('vehicle_inward_no')}}" onchange="getTruckDetails()" readonly="">

					  <datalist id="vehicleInward">
						<?php foreach($vehicle_list as $key) { 

							  $vrNo = $key->VRNO;
							  
							  $SericeCode = $key->SERIES_CODE;
							  
							  $FyYr = $key->FY_CODE;

							  $getYr = explode("-",$FyYr);

							  $BgYr = $getYr[0];

							  $newVrNo = $BgYr.' '.$SericeCode.' '.$vrNo;

						  ?>

						  <option value="<?= $newVrNo ?>"><?= $newVrNo ?></option>

					   <?php  } ?>
						 
					  </datalist>
					 </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('vehicle_inward_no', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  <small id="vehicleinwardErr" style="color: red;"></small>
					 
					 
					</div>
				  </div>

				   

				  

				 
				
				
			  </div>
				 
				<div class="row">

					<div class="col-md-2">

					 <div class="form-group">
					  <label>
					   Model : 
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
						  </span>
					   <input type="text" id='model' name="model" readonly="" class="form-control"  >
					  </div>
					  
					  
					 </div>
					  
					
				
				 </div>

					 <div class="col-md-2">
					 

					<div class="form-group">
					  <label>
						Load Capacity : 
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
						  </span>
					   <input type="text" id='loadcpct' name="loadcpct" class="form-control" readonly="" style="text-align:right;">
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					 </div>
				 </div>

				 

				   <div class="col-md-2">

					<div class="form-group">
					  <label>
					   Load Avg :  
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
						  </span>
					   <input type="text" id='loadAvg' name="loadAvg" readonly="" class="form-control"  style="text-align:right;">
					  </div>
					  
					 </div>

				  </div>

					 <div class="col-md-2">
				   <div class="form-group">
					  <label>
						U/L Capacity : 
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
						  </span>
					   <input type="text" id='ulcpct' name="ulcpct" class="form-control" readonly="" style="text-align:right;">
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('ulcpct', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					 </div>
				 </div>

				 

				   <div class="col-md-2">

					<div class="form-group">
					  <label>
					   U/L Avg :  
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
						  </span>
					   <input type="text" id='ulAvg' name="ulAvg" readonly="" class="form-control" style="text-align:right;" >
					  </div>
					  
					 </div>

				  </div>


				   <div class="col-md-2">
					 
					<div class="form-group">
					  <label>
					   Empty Avg :  
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
						  </span>
					   <input type="text" id='emptyAvg' name="emptyAvg" readonly="" class="form-control"  >
					  </div>
					  
					 </div>

				  
				  </div>
			   
				 
				   
				
			  </div>

			  <div class="row">

			  	  <div class="col-md-2">
					<div class="form-group">
					  <label>
						Driver Name: 
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-user" aria-hidden="true"></i>
						  </span>
					   <input name="driver_name" id="driver_name" class="form-control" placeholder="Enter Driver Name" value="{{ old('driver_name') }}" readonly>
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('driver_name', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
				  </div>
				 

				  <div class="col-md-2">
					<div class="form-group">
					  <label>
						Diesel Rate 
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
						  <input type="text" class="form-control" name="diesel_rate" id="diesel_rate" value="{{ old('diesel_rate')}}" placeholder="Enter Diesel Rate" readonly=""> 
					  </div>
						  <small id="emailHelp" class="form-text text-muted">
							{!! $errors->first('diesel_rate', '<p class="help-block" style="color:red;">:message</p>') !!}
						  </small>
					</div>
					<!-- /.form-group -->
				  </div>

			  	<div class="col-md-2">
					<div class="form-group">
					  <label>
						Route Code 
						<span class="required-field"></span>
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
						  <input list="routeList" class="form-control" name="route_code" id="route_code"  placeholder="Enter Route Code" readonly onchange="getRouteDetails()"> 

						  <datalist id="routeList">

							<?php foreach ($route_list as $key) { ?>

								<option value="<?= $key->ROUTE_CODE ?>" data-xyz="<?= $key->ROUTE_NAME ?>"><?= $key->ROUTE_CODE ?> - <?= $key->ROUTE_NAME ?></option>

							<?php }  ?>
							
						  </datalist>
					  </div>
						  <small id="emailHelp" class="form-text text-muted">
							{!! $errors->first('route_code', '<p class="help-block" style="color:red;">:message</p>') !!}
						  </small>
					</div>
					<!-- /.form-group -->
				  </div>

			  <div class="col-md-3">
						<div class="form-group">
						  <label>
							Route Name 
							<span class="required-field"></span>
						  </label>
						  <div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
							  <input list="routeList" class="form-control" name="route_name" id="route_name" value="{{ old('route_name')}}" readonly placeholder="Enter Route Name" onchange="getRouteDetails()"> 

							  <datalist id="routeList">

								
							  </datalist>
						  </div>
							  <small id="emailHelp" class="form-text text-muted">
								{!! $errors->first('route_name', '<p class="help-block" style="color:red;">:message</p>') !!}
							  </small>
						</div>
					<!-- /.form-group -->
				  </div>


				  <div class="col-md-2">
						<div class="form-group">
						  <label>
							Owner 
							<span class="required-field"></span>
						  </label>
						  <div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
							  <input type="text" class="form-control" name="owner_type" id="owner_type"  placeholder="Enter Owner Name" readonly=""> 

							  
						  </div>
							  <small id="emailHelp" class="form-text text-muted">
								{!! $errors->first('owner_type', '<p class="help-block" style="color:red;">:message</p>') !!}
							  </small>
						</div>
					<!-- /.form-group -->
				  </div>

				   <div class="col-md-2">
						<div class="form-group">
						  <label>
							 Transporter Code
						<!-- 	<span class="required-field"></span> -->
						  </label>
						  <div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
							  <input type="text" class="form-control" name="transporter_code" id="transporter_code"  placeholder="Enter Transporter Code" readonly=""> 

							  
						  </div>
							  <small id="emailHelp" class="form-text text-muted">
								{!! $errors->first('transporter_code', '<p class="help-block" style="color:red;">:message</p>') !!}
							  </small>
						</div>
					<!-- /.form-group -->
				  </div>

				   <div class="col-md-2">
						<div class="form-group">
						  <label>
							Transporter Name 
							<!-- <span class="required-field"></span> -->
						  </label>
						  <div class="input-group">
							  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
							  <input type="text" class="form-control" name="transporter_name" id="transporter_name"  placeholder="Enter Transporter Name" readonly=""> 

							  
						  </div>
							  <small id="emailHelp" class="form-text text-muted">
								{!! $errors->first('transporter_name', '<p class="help-block" style="color:red;">:message</p>') !!}
							  </small>
						</div>
					<!-- /.form-group -->
				  </div>

                          <div class="col-md-2">
                                    <div class="form-group">
                                      <label>
                                          Freight Qty 
                                          <!-- <span class="required-field"></span> -->
                                      </label>
                                      <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="text" class="form-control" name="freight_qty" id="freight_qty"  placeholder="Enter Transporter Name"> 

                                            
                                      </div>
                                            <small id="emailHelp" class="form-text text-muted">
                                                {!! $errors->first('freight_qty', '<p class="help-block" style="color:red;">:message</p>') !!}
                                            </small>
                                    </div>
                              <!-- /.form-group -->
                          </div>

				  

				      <div class="col-md-2">
                                    <div class="form-group">
                                      <label>
                                         Ref Trip No
                                          <!-- <span class="required-field"></span> -->
                                      </label>
                                      <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input list="refTripList" class="form-control" name="ref_trip_no" id="ref_trip_no"  placeholder="Enter Ref Trip No" onchange="getRefTripData()" autocomplete="off"> 

                                            <datalist id="refTripList">
                                            	
                                            </datalist>
                                            
                                      </div>
                                            
                                    </div>
                              <!-- /.form-group -->
                          </div>


				          <div class="col-md-2">
                                    <div class="form-group">
                                      <label>
                                         Ref Qty
                                          <!-- <span class="required-field"></span> -->
                                      </label>
                                      <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="text" class="form-control" name="ref_qty" id="ref_qty"  placeholder="Enter Ref Qty"> 

                                            
                                      </div>
                                            
                                    </div>
                              <!-- /.form-group -->
                          </div>

                           <div class="col-md-2">
                                    <div class="form-group">
                                      <label>
                                         Ref Comp Name
                                          <!-- <span class="required-field"></span> -->
                                      </label>
                                      <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                                            <input type="text" class="form-control" name="ref_comp_name" id="ref_comp_name"  placeholder="Enter Ref Comp Name"> 

                                            <input type="hidden" class="form-control" name="ref_comp_code" id="ref_comp_code"  placeholder="Enter Ref Comp Code"> 	
                                      </div>
                                            
                                    </div>
                              <!-- /.form-group -->
                          </div>
			  	
			  </div>

			  <div class="row">

			  	 <div class="col-md-3">
					<div class="form-group">
					   <label>
						  &nbsp;
						
					  </label>
					   <div class="input-group">

						  <input type="radio" class="optionsRadios1" name="point_delivery" value="single point" checked="">&nbsp;&nbsp;<span style="font-weight: 700 !important;font-size: 12px !important;">Single Point Del.</span> &nbsp;&nbsp;

						  <input type="radio" class="optionsRadios1" name="point_delivery" id="doublepoint" value="double point" >&nbsp;&nbsp<span style="font-weight: 700 !important;font-size: 12px !important;">Double Point Del.<span>



					  </div>

						  <small id="emailHelp" class="form-text text-muted">
							{!! $errors->first('trip_no', '<p class="help-block" style="color:red;">:message</p>') !!}
						  </small>
						  <small id="invcErr" style="color: red;"></small>
					</div>
					<!-- /.form-group -->
				  </div>
			  	
			  </div>

		   
			  <!-- /.row -->

		  </div><!-- /.box-body -->


		  
		   
		  </div>


	  </div>
	   
	</div>
	 
	</section>

	<section class="content">
	<div class="row">
	 <!--  <div class="col-sm-2"></div> -->
	  <div class="col-sm-12">
		 <div class="box box-warning Custom-Box">
		 
		  
			   <div class="box-body">
				<div class="row">
				<div class="col-md-12">
				  <p style="font-weight: bold;font-size: 12px;">ITEM/DO DETAILS</p>
				</div>
				  <div class="col-md-12">
					
				  
					 <div class="table-responsive">

						<div class="boxer"  id="itemTable">
						
							 <div class='box-row'><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DO DATE</div><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>ITEM NAME</div><div class='box10 texIndbox1'>QTY</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>LR DATE</div></div>
							

					   </div>
					 
					  
					   <div id="totalqty" style="margin-top:10px;text-align: center;margin-left: 28%;"></div>
					 </div>

				   
				  </div>

				</div>
			   </div>
			
			   

	   </div>
	   
	   </div>
   </div>
	</section>


	<style type="text/css">
  /* DivTable.com */
.divTable{
  display: table;
  width: 100%;
}
.divTableRow {
  display: table-row;
}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
}
.divTableCell, .divTableHead {
  border: 1px solid #999999;
  display: table-cell;
  padding: 4px 8px;
  text-align: center;
  /*font-weight: bold;*/
  font-size:12px;
  

}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
  font-weight: bold;
}
.divTableFoot {
  background-color: #EEE;
  display: table-footer-group;
  font-weight: bold;
}
.divTableBody {
  display: table-row-group;
}
</style>
<!-- start enquiry vendor--->

<section class="content" style="margin-top: -10%;" id="routeDetails">

    <div class="row">



      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

          <div class="row">
          	<div class="col-md-12">
				  <p style="font-weight: bold;font-size: 12px">ROUTE DETAILS</p>
				</div>
          </div>		


 

  <div class="divTable">
    <div class="divTableBody box-row">
      <div class="divTableRow trrowget">
        
        <div class="divTableCell"></div>
        <div class="divTableCell" style="font-weight:bold;">Sr.No</div>
        <div class="divTableCell" style="font-weight:bold;">LOAD TYPE</div>
        <div class="divTableCell" style="font-weight:bold;">SOURCE</div>
        <div class="divTableCell" style="font-weight:bold;">DESTINATION</div>
        <div class="divTableCell" style="font-weight:bold;">KMS</div>
        <div class="divTableCell" style="font-weight:bold;">TOLL</div>
        <div class="divTableCell" style="font-weight:bold;">ENHANCE WEIGHT RATE</div>
        <div class="divTableCell" style="font-weight:bold;">EXTRA KMS</div>
        <div class="divTableCell" style="font-weight:bold;">LESS KMS</div>
        <div class="divTableCell" style="font-weight:bold;">EXTRA TOLL</div>
        
      </div>

   

     <div class="divTableRow rowcount TextBoxesGroup_1 trrowget">

          <div class="divTableCell">
            <div class='TextBoxesGroup'>
            <div id="TextBoxDiv1">
              
            <input type="checkbox" class="casecheck" id="tablesecnd1"  onclick="checkcheckbox(1);">
            </div>
          </div>
        </div>
      
            <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <span id="snumtwo1">1.</span>
              <input type="hidden" name="rowCountRoute[]" id="" class="rowCountRoute" value="1">
              </div>
            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">

              <input list="vehicleList1" id='vehicle_type1'   style="width: 103px;text-transform: uppercase;" name="vehicle_type[]"  onchange="getToPlace(1)" autocomplete='off'>
             
              <datalist id="vehicleList1">

              	<option value="fullload" data-xyz="fullload">FULLLOAD</option>
                <option value="empty" data-xyz="empty">EMPTY</option>
              </datalist>
              </div>
              

            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1" class="tooltips">
              <input list="fromList1" id='source_code1' value="" name="source_code[]"  style="width: 100px;" >

              <datalist id="fromList1">

              	<?php foreach($from_place_list as $key) { ?>

              		<option value="<?= $key->FROM_PLACE ?>" data-xyz="<?= $key->FROM_PLACE ?>"><?= $key->FROM_PLACE ?></option>


              	<?php } ?>
              	
              </datalist>

              <small class="tooltiptext tooltiphide" id="accountNameTooltip1"></small>
              </div>
            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input list="toplaceList1" id='destination_code1' value="" name="destination_code[]" style="width: 100px;" onchange="getRoute(1)"  autocomplete="off">

              <!-- onchange="getRouteInfo(1)" -->

              <datalist id="toplaceList1">
              	
              	
              </datalist>

              </div>
            </div></div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='text' class="getkmtotal" id='km1' value="" name="km[]" style="width: 80px;text-align: right;" maxlength="10" readonly="">

              <input type='hidden' class="getdiesel" id='diesel1' value="" name="diesel[]" style="width: 80px;" maxlength="10" readonly="">

             <!--  <input type='hidden' class="allToll" id='allToll1' value=""  style="width: 100px;" maxlength="10" readonly="">

              <input type='hidden' class="allExtraToll" id='allExtraToll1' value="" style="width: 100px;" maxlength="10" readonly="">
 -->
            
              
              </div>
            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='textbox' class="allToll" id='toll1'  value="" name="toll[]" style="width: 80px;text-align: right;" maxlength="10" readonly="">
              </div>
            </div>
          </div>

          <div class="divTableCell">
          	<div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='textbox' class="getweight_rate" id='weight_rate1'  value="" name="weight_rate[]" style="width: 100px;text-align: right;" maxlength="10" readonly="">
              </div>
            </div>
          </div>

          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='textbox' id='extra_km1' value="" name="extra_km[]" style="width: 80px;text-align: right;" maxlength="10" readonly="">
              </div>
            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='textbox' id='less_km1' value="" name="less_km[]" style="width: 80px;text-align: right;" maxlength="10" readonly="">
              </div>
            </div>
          </div>
            <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='textbox'  class="allExtraToll" id='extra_toll1' value="" name="extra_toll[]" style="width: 80px;text-align: right;" maxlength="10" oninput="extraToll(1)">

              <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="hidden" name="totalkm" id="totalkm">
                    <input type="hidden" name="totaldiselcal" id="totaldiselcal">
					         <input type="hidden" name="fullLoadkm" id="fullLoadkm">
					         <input type="hidden" name="totaltoll" id="totaltoll">
					         <input type="hidden" name="totalextratoll" id="totalextratoll">
              </div>
            </div>
          </div>



         
    
    </div> 

    

 </div>
<div class="divTablebtn"></div>
 </div>
  <div class="col-md-12"></div><br>
  <div class="row">
      <div class="col-md-12">

    <!-- <input type='button' value='Delete' id='removeButton' class="btn btn-danger btn-sm removeBtntbl"> -->
    <!-- <input type='button' value='Add More' id='addButton' class="btn btn-primary btn-sm"> -->

    <button type="button" class='btn btn-danger btn-sm removeBtntbl' id="removeButton" disabled=""><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

    <button type="button" class='btn btn-primary btn-sm' id="addButton" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;" ></i>&nbsp; Add More</button>

    <small id="showDubDataMsg" style="color: red;"></small>
    
    <input type="hidden" name="dublicateName1[]" id="dublicateName" value="">

    <input type="hidden" name="deletedubName1[]" id="deletedubName" value="">

    </div>

  </div>
  	
       <!--  quality parameter modal -->

      

       <!--  quality parameter modal -->

<!-- show modal when click on view btn after item select item -->

       

    </div>


        </div>
      </div>
    </div>  
</section>

  <section class="content" style="margin-top: -10%;">

	<div class="row">

	  <div class="col-sm-12">

		<div class="box box-primary Custom-Box">



		  <div class="box-body">

		  

			<div class="col-sm-6" id="expenseTable">

					

			  <div class="">

				<table class="table tdthtablebordr " border="1" cellspacing="0" id="tbledata">



				  <input type ="hidden" name="comp_name" id="getCompName">
				  <input type ="hidden" name="fy_year" id="getFyYear">
				  <input type ="hidden" name="trans_date" id="getTransDate">
				  <input type ="hidden" name="vr_no" id="getVrNo">
				 <!--  <input type ="hidden" name="trans_code" id="getTransCode"> -->
				 <!--  <input type ="hidden" name="departCode" id="getAccCode">

				  <input type ="hidden" name="departName" id="getDeptName">
				  <input type ="hidden" name="pfct_code" id="getPfctCode">
				  <input type ="hidden" name="pfct_name" id="getPfctName">
				  <input type ="hidden" name="plant_code" id="getPlantCode">
				  <input type ="hidden" name="plant_name" id="getPlantName">
				  <input type ="hidden" name="series_code" id="getSeriesCode">
				  <input type ="hidden" name="series_name" id="getSeriesName">
				  <input type ="hidden" name="tax_code" id="getTaxCode">
				  <input type="hidden" name="due_days" id="gateduedays">
				  <input type="hidden" name="getdue_date" id="gateduedate">
				  
				  <input type ="hidden" name="party_ref_no" id="getpartyrfNo">
				  <input type ="hidden" name="party_ref_date" id="getpartyrfDate">
				  <input type ="hidden" name="consine_code" id="getcosine">
				  <input type ="hidden" name="rfhead1" id="getrfhead1">
				  <input type ="hidden" name="rfhead2" id="getrfhead2">
				  <input type ="hidden" name="rfhead3" id="getrfhead3">
				  <input type ="hidden" name="rfhead4" id="getrfhead4">
				  <input type ="hidden" name="rfhead5" id="getrfhead5">
				  <input type ="hidden" name="rfhead5" id="getrfhead5">

				  <input type="hidden" name="cost_code" id="cost_code"> -->


				  <input type="hidden" name="comp_name" value="<?php echo Session::get('company_name'); ?>">
				  <input type="hidden" name="fiscal_year" value="<?php echo Session::get('macc_year'); ?>">
			   
					   <thead>
						   <th colspan="5" class="text-center"><button type="button" onclick="getExpenseData()" id="expenseid" class="btn btn-warning btn-sm" style="float:left;" disabled> <i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 11px;"></i> &nbsp; &nbsp;GET EXPENSE</button> EXPENSE DETAILS </th>
						  	
						</thead>


						<thead>
						 <!--  <th>&nbsp;</th> -->
						  <th>SR.NO</th>
						  <th>INDICATOR</th>
						  <th>GL CODE</th>
						  <th>AMT</th>
						 
						</thead>

				 


				  <tr class="useful expenseBody">



					<td class="tdthtablebordr" style='text-align: center !important;'>
					  <input type='checkbox' class='case' id="firstrow1" onclick='checkcheckboxaddmore(1)'  disabled="" />
					  <span id='snum'></span>
					</td>

					<!-- <td class="tdthtablebordr">
					  <span id='snum' style="width: 10px;">1.</span>
					</td> --> 
					 
					<td class="tdthtablebordr" style="text-align: center;width: 25px;">
					  <div class="input-group">
						<input list="IndList1" class="inputboxclr SetInCenter" style="width: 105px;line-height: 0.1;margin-left: 4px;" id='indicator1' name="indicator[]" onchange="getIndDetails(1)" readonly/>

						  <datalist id="IndList1">

							  
						  </datalist>
					  </div>
					  
					</td>

				  

					<td class="tdthtablebordr tooltips" style="text-align: center;">
					 

					  <input list="glList1" class="inputboxclr getAccNAme" style="width: 100px;line-height: 0.1;" id='gl_code1' name="gl_code[]" readonly="" autocomplete="off" />
					  <datalist id="glList1">
					  	
					  </datalist>

					  <input type="hidden" class="inputboxclr getAccNAme" style="width: 100px;line-height: 0.1;" id='gl_name1' name="gl_name[]" readonly="" />


					  	
					  <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>
					  
					</td>

					<td class="tdthtablebordr" style="text-align: center;">

					  <div style="display: inline-flex;border: none;">

					  <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate basicamt" oninput="getAmount(1)"  id='Amt1' name="Amt[]" readonly="" style="width: 100px;text-align: right;line-height: 0.1;"/>
			  
					  </div>
					   <div><small id="errmsgqty1"></small></div>

					</td>

					

				  </tr>

			   

				</table>
			   
				<div class="row">
						<div class="col-md-12 tdthtablebordr" style="margin-bottom: 8px;
    margin-top: -17px;">
							<div class="col-md-2" style="display: inline-flex;border: none;font-size: 12px;font-weight: bold;margin-top: 12px;">EMPLOYEE</div>
							<div class="col-md-3" style="display: inline-flex;border: none;">
							<input list='empindList' class='form-control inputboxclr SetInCenter' style='width: 105px;line-height: 0.1;margin-left: -19px;border:1px solid #7e7373;' id='indemp_code' name='indemp_code' onchange="getEmployee()" />
							<datalist id='empindList'>
								<option value="">-SELECT-</option>
								<option value="ON ACCOUNT">ON ACCOUNT</option>
							</datalist>
							</div>
							<div class="col-md-3" style="display: inline-flex;border: none;">
								<input list='empList' class='form-control inputboxclr SetInCenter' style='width: 101px;line-height: 0.1;margin-left: -9px;border:1px solid #7e7373;' id='emp_code' name='emp_code' onchange="getGlCode()" /><datalist id='empList'>
									<?php foreach ($emp_list as $key) { ?>
										 <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> - <?= $key->ACC_NAME ?></option>
									 <?php } ?>
								</datalist>

								<input type='hidden' class='form-control inputboxclr SetInCenter' style='width: 50px'  id='empgl_code' name='empgl_code' />
								<input type='hidden' class='form-control inputboxclr SetInCenter' style='width: 50px'  id='empgl_name' name='empgl_name' />

								<div id='empcompOther'></div>

								<input type='hidden' value='' id='othercompAmt' name='othercompAmt[]'/>

								  

							</div>
							<div class="col-md-3" style="display: inline-flex;border: none;">
								<input type='text' class="form-control debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate basicamt" style='width: 102px;line-height: 0.1;px;margin-left: 18px;border:1px solid #7e7373;text-align: right' id='emp_amt' name='emp_amt' oninput="getAmount(1)" autocomplete="off" />


							</div>
							<div class="col-md-1"></div>
						</div>

				</div>
				<div id="empNameText" style="color: #3c8dbc;margin-left: 193px;font-weight: bold;"></div>
			  </div><!-- /div -->
			   <div class="row">

				  <div class="col-md-12">
				   <div style="margin-left: 72%;">  <label> Total  : </label> <span id='bTotal' class="bTotal"></span></div>
				   <!-- <div style="margin-left: 72%;">  <label> Other Total  : </label> <span id='otherCompTotal' class="otherCompTotal"></span></div> -->


				   <input type="hidden" name="refCompTotal" id="refCompTotal" value="">

				   <input type="hidden" name="dubindicator" id="dubindicator">
				   <input type="hidden" name="dubindicatoraddmore" id="dubindicatoraddmore">
				   <input type="hidden" name="indidubName1[]" id="indidubName" value="">
				   </div>

				 
				</div>

			  <button type="button" class='btn btn-danger btn-sm delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

			  <button type="button" class='btn btn-info btn-sm addmore' id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

			  <span id='dubindMsg'></span>
			  <span id='dubindaddMsg'></span>
			  <span id="glCodeErr"></span>

			</div>

		 

		  	            
		

		<div class="col-sm-6" id="marketTable">
			  
			  <div class="">


						  <div style="height:23px;font-weight: bold;padding-top: 12px;font-size:12px;text-align: center;background-color: #b8daff;">
								 ADVANCE
						  </div>
						  <div id="dublicateerr" style="color: red;text-align: center;"></div>
						<div class="boxer" id="bodyTable1">

								 
							 <div class='box-row' style="background-color: #b8daff;">
								<div class='box10 texIndbox1'>PAYMENT TYPE</div>
								<div class='box10 texIndbox1'>ADAVANCE PERCENT</div>
								<div class='box10 texIndbox1'>ADAVANCE AMOUNT</div>
							 </div>

							 <input type="hidden" name="bankCodeDup" id="bankCodeDup">
							 
							
							<div class='box-row'>
							  
							  <div class='box10 texIndbox1'>
									<input type="text" class="inputboxclr SetInCenter" style="width: 105px;line-height: 0.1;" id='payment_type' name="payment_type" readonly autocomplete='off'/>
							 </div>
							  <div class='box10 texIndbox1'> 
								<input type="text" class="inputboxclr SetInCenter" style="width: 105px;line-height: 0.1;text-align:right;" id='adv_rate' name="adv_rate" readonly autocomplete='off'/>
							  </div>
							  <div class='box10 texIndbox1'> 
								<input type="text" class="inputboxclr SetInCenter getqtytotal" style="width: 105px;line-height: 0.1;text-align:right;" id='adv_amount' name="adv_amount" readonly autocomplete='off' />
							  </div>
							</div>

					   </div>
					 
					  

				

			  </div><!-- /div -->

				<div class="row">

						<div class="col-md-12">
				   		<div style="margin-left: 72%;margin-top: 15px;">  <label> Total  : </label> <span class='bTotal' ></span></div>
				   
				  		 </div>

				  		
				 
				</div>


			</div>


			<div class="col-sm-6">
			  
			  <div class="">


						  <div style="height:23px;font-weight: bold;padding-top: 12px;font-size:12px;text-align: center;background-color: #b8daff;">
								 PAYMENT MODE
						  </div>
						  <div id="dublicateerr" style="color: red;text-align: center;"></div>
						<div class="boxer" id="bodyTable1">

								 
							 <div class='box-row' style="background-color: #b8daff;">
								<div class='box10 texIndbox1'>CODE</div>
								<div class='box10 texIndbox1'>NAME</div>
								<div class='box10 texIndbox1'>DIESEL</div>
								<div class='box10 texIndbox1'>CASH</div>
								<div class='box10 texIndbox1'>AMT</div>
							 </div>

							 <input type="hidden" name="bankCodeDup" id="bankCodeDup">
							 
							<?php $sr=1; for ($i=0; $i < 6 ; $i++) {  ?>
							<div class='box-row'>
							  <div class='box10 texIndbox1'>
							   <input list="bankList<?= $sr ?>" class="debitcreditbox dr_amount inputboxclr SetInCenter"  id="bank_code<?= $sr ?>" name="bank_code[]"  style="width: 80px" onchange="bankName(<?= $sr ?>);"  autocomplete='off'/>

								  <datalist id="bankList<?= $sr ?>">
									
									<?php foreach ($bank_list as $key) { ?>
									  
									  <option value="<?= $key->BANK_CODE; ?>" data-xyz="<?= $key->BANK_NAME; ?>"><?= $key->BANK_CODE; ?> - <?= $key->BANK_NAME; ?></option>

									<?php } ?>

								  </datalist>
							 </div>
							  <div class='box10 texIndbox1'>
								<input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='bank_name<?= $sr ?>' name="bank_name[]"  style="width: 90px" autocomplete='off'/>
							 </div>
							 <div class='box10 texIndbox1'>
								<input type='text' class="debitcreditbox dr_amount inputboxclr banktotal"  id='diesel_amt<?= $sr ?>' name="diesel_amt[]"  oninput="banktotal(<?= $sr ?>)" style="width: 90px;text-align:right;" autocomplete='off'/>
							 </div>
							 <div class='box10 texIndbox1'>
								<input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter banktotal_diesel"  id='cash_amt<?= $sr ?>' name="cash_amt[]" oninput="banktotal(<?= $sr ?>)"  style="width: 90px;text-align:right;" autocomplete='off'/>
							 </div>
							  <div class='box10 texIndbox1'> 
								<input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter bankAmt" readonly  id='bankAmt<?= $sr ?>' name="bankAmt[]"  autocomplete='off' style="width: 80px;text-align:right;" autocomplete="off"/>
							  </div>
							</div>

						  <?php $sr++; } ?>
					   </div>
					 
					  

				

			  </div><!-- /div -->

			  <div class="row">
						<div class="col-md-12 tdthtablebordr" style="margin-bottom: 8px;
    margin-top: 0px;">
							<div class="col-md-2" style="display: inline-flex;border: none;font-size: 12px;font-weight: bold;margin-top: 12px;">EMPLOYEE</div>
							<div class="col-md-3" style="display: inline-flex;border: none;">
							<input list='emppmtList' class='form-control inputboxclr SetInCenter' style='width: 92px;line-height: 0.1;margin-left: 11px;border:1px solid #7e7373;' id='pmtind_code' name='pmtind_code' autocomplete="off" />
							<datalist id='emppmtList'>
								<option value="">-SELECT-</option>
								<option value="ON ACCOUNT">ON ACCOUNT</option>
							</datalist>
							</div>
							<div class="col-md-3" style="display: inline-flex;border: none;">
								<input list='pmtempList' class='form-control inputboxclr SetInCenter' style='width: 90px;line-height: 0.1;margin-left: -16px;border:1px solid #7e7373;' id='pmtemp_code' name='pmtemp_code' onchange="getPmtGlCode()" autocomplete="off"/>
								<datalist id='pmtempList'>
									<?php foreach ($emp_list as $key) { ?>
										 <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> - <?= $key->ACC_NAME ?></option>
									 <?php } ?>
								</datalist>
								<input type='hidden' class='form-control inputboxclr SetInCenter' style='width: 50px'  id='pmtempNameText1' name='pmtbank_name' value="" />
								<input type='hidden' class='form-control inputboxclr SetInCenter' style='width: 50px'  id='pmtempgl_code' name='pmtempgl_code' value="" />
								<input type='hidden' class='form-control inputboxclr SetInCenter' style='width: 50px'  id='pmtempgl_name' name='pmtempgl_name' value="" />
								<!-- <input type='hidden' class='form-control inputboxclr SetInCenter' style='width: 50px'   name='diesel_amt[]' value="" />
								<input type='hidden' class='form-control inputboxclr SetInCenter' style='width: 50px'   name='cash_amt[]' value="" /> -->

							</div>
							<div class="col-md-3" style="display: inline-flex;border: none;">
								<input type='text' class="form-control debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate bankAmt" style='width: 92px;line-height: 0.1;px;margin-left: -45px;border:1px solid #7e7373;text-align: right' id='pmtemp_amt' name='pmtemp_amt' oninput="getAmountpmt()" autocomplete="off" />


							</div>
							<div class="col-md-1"></div>
						</div>

				</div>

				<div id="pmtempNameText" style="color: #3c8dbc;margin-left: 193px;font-weight: bold;"></div>

				<div class="row">
					<span id="pmtglCodeErr"></span>
					<div class="col-md-12">
					 <div style="margin-left: 66%;margin-top: 15px;">  <label> Total  : </label> <span id='bankTotal'></span>
					 </div>

					
				   </div>

				   <div class="col-md-12">
					 	  <div style="margin-left: 66%;margin-top: 15px;">  <label> Balance  : </label> <span id='balnceTotal'></span>
						 </div>
				  </div>
				 
				</div>


			</div>

			  <div id="errMsg" style="text-align: right;color: red;margin-right: 167px;"></div>
			 

			   
			


		
   

	  <br>
		  

	   

	 
  </div><!-- /.box-body -->

  <div class="row" style="line-height:7">

		 <p class="text-center">

			  <button class="btn btn-success btn-sm" type="button" id="submitdata" disabled="" onclick="submitAllData(0)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

			  <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

			 <!--  <button class="btn btn-success btn-sm" type="button" id="submitdata" disabled="" onclick="submitData()"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button> -->

			  <button class="btn btn-success btn-sm" type="button" onclick="submitAllData(1)" id="submitNDown" disabled=""><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save &amp; Download</button>

           <input type="hidden" id="donwloadStatus" name="donwloadStatus" value="">

			 </p>
		
	  </div>

</div>

</div>

</div>

</section>




	<!-- <section class="content">
	<div class="row">
	 
	  <div class="col-sm-9">
		<div class="box box-success Custom-Box" style="width: 104% !important;">
		
		  <div class="box-body">
			 <div class="row">
				 
				  <div class="col-md-4">
					 <div class="form-group">
					  <label>
						Driver Exp : 
						
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
						  </span>
					   <input type="number" name="drv_exp" class="form-control" id="a2" placeholder="Enter Driver Exp" value="{{ old('drv_exp') }}" onfocusout='calculate()'>
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('drv_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
					
				  </div>

				  <div class="col-md-4">
					 <div class="form-group">
					  <label>
						Fooding Exp: 
						
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
						  </span>
					   <input type="number" name="fooding" class="form-control" placeholder="Enter Fooding Exp" value="{{ old('fooding') }}" onfocusout='calculate()' id="a4">
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('fooding', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
					
				  </div>

				  <div class="col-md-4">
					 <div class="form-group">
					  <label>
						Admin Exp : 
						
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
						  </span>
					   <input type="number" name="p_exp" class="form-control" placeholder="Enter Admin Exp" value="{{ old('p_exp') }}" id="a3" onfocusout='calculate()'>
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('p_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
					
				  </div>
				</div>

				<div class="row">
				  <div class="col-md-4">
					 <div class="form-group">
					  <label>
						U-Loading Exp : 
						
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
						  </span>
					   <input type="number" name="lu_exp" class="form-control" placeholder="Enter LU Exp" value="{{ old('lu_exp') }}" onfocusout='calculate()' id="a5">
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('lu_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
					
				  </div>


				  <div class="col-md-4">
					 <div class="form-group">
					  <label>
						Toll Exp: 
						
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
						  </span>
					   <input type="number" name="toll" class="form-control" placeholder="Enter Toll Exp" value="{{ old('toll') }}" id="a6" onfocusout='calculate()'>
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('toll', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
					
				  </div>

				
				  <div class="col-md-4">
					 <div class="form-group">
					  <label>
						Diesel Exp: 
						
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
						  </span>
					   <input type="number" name="Disel" class="form-control" id="a1" placeholder="Enter Diesel Exp" value="{{ old('Disel') }}" onfocusout='calculate()'>
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('Disel', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
				   
				  </div>
				</div>  

				<div class="row">
				  <div class="col-md-4">
					 <div class="form-group">
					  <label>
					   Other Exp : 
					   
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
						  </span>
					   <input type="number" name="other_exp" class="form-control" placeholder="Enter Other Exp" value="{{ old('other_exp') }}" id="a7" onfocusout='calculate()'>
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('other_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
				   
				  </div>

				  <div class="col-md-4">
					 <div class="form-group">
					  <label>
					   Total Adv : 
						
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-calculator" aria-hidden="true"></i>
						  </span>
					   <input type="number" name="total_adv" class="form-control" placeholder="Enter Total Adv" value="{{ old('total_adv') }}" id="TOTAL" readonly>
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('total_adv', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
					
				  </div>

				  <div class="col-md-4">
					 <div class="form-group">
					  <label>
					   Meter Reading : 
						
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-tachometer" aria-hidden="true"></i>
						  </span>
					   <input type="text" name="METER_READING" class="form-control" placeholder="Enter Meter Reading" value="{{ old('METER_READING') }}" id="meter_reading">
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('METER_READING', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
					
				  </div>
				
			  </div>
		  </div>
		</div>
	  </div>

	  <div class="col-sm-3">
		<div class="box box-success Custom-Box">
			
		  <div class="box-body">
			<div class="row">

			  <div class="col-md-3" style="width: 100%;">
					 <div class="form-group">
					  <label>
					   Diesel Cr : 
						
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-flask" aria-hidden="true"></i>
						  </span>
					   <input type="text" name="DIESEL_CR" class="form-control" placeholder="Enter Diesel Cr" value="{{ old('DIESEL_CR') }}" id="diesedl_cr">
					  </div>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('DIESEL_CR', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
					
				  </div>
				</div>

				<div class="row">
				  <div class="col-md-3" style="width: 100%;">
					 <div class="form-group">
					  <label>
					   Diesel Slip No : 
					   
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-file" aria-hidden="true"></i>
						  </span>
					   <input type="text" name="deisel_slip_no" class="form-control" placeholder="Enter Diesel Slip No" value="{{ old('deisel_slip_no') }}" id="diesel_slip_no">
					  </div>
					  <small id="enterslipnomsg"></small>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('deisel_slip_no', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
					
				  </div>
				</div>

				<div class="row">
				  <div class="col-md-3" style="width: 100%;">
					 <div class="form-group">
					  <label>
					   Diesel Qty : 
						
					  </label>
					  <div class="input-group">
						  <span class="input-group-addon">
							<i class="fa fa-tachometer" aria-hidden="true"></i>
						  </span>
					   <input type="text" name="diesel_qty" class="form-control" placeholder="Enter Diesel Qty" value="{{ old('diesel_qty') }}" id="diesel_qty">
					  </div>
					  <small id="filerrormsg"></small>
					  <small id="emailHelp" class="form-text text-muted">
						{!! $errors->first('diesel_qty', '<p class="help-block" style="color:red;">:message</p>') !!}
					  </small>
					  
					</div>
				   
				  </div>
				</div>
			  
			</div>
		  </div>
		</div>
	  
	</div>
	 
	</section> -->


	<!-- <div class="box-body">
		<div style="text-align: center;margin-top: -4%;
	margin-bottom: 5%;">
					 <button type="Submit" class="btn btn-primary" id="hidesubmitbtn">
					<i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 
					 </button>
		 </div>
	 </div> -->

 </form>
</div>


<div id="expenseErrModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                 <center> <span id='errexpMsg'></span></center>

                 </div>
                <div class="modal-footer">
                  <center>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" >ok</button>
                
                  </center>
                </div>
            </div>
        </div>
    </div>

@include('admin.include.footer')




<script type="text/javascript">
  
  $(document).ready(function() {
	$('.datepicker').datepicker({
	  format: 'dd-mm-yyyy',
	  orientation: 'bottom',
	  todayHighlight: 'true',
	  endDate:'today',
	  autoclose: 'true'
	});
});


  $( window ).on( "load", function() {

	 getvrnoBySeries();

	var tr_date = $("#diesel_rate_date").val();

	$.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });


	   $.ajax({

		  url:"{{ url('get-diesel-rate-details') }}",

		   method : "POST",

		   type: "JSON",

		   data: {tr_date: tr_date},

		   success:function(data){

			 // console.log(data);

				var data1 = JSON.parse(data);

				if (data1.response == 'error') {

					/*$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");*/

				}else if(data1.response == 'success'){
					// console.log(data1.data[0]);
				   // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);
					  $("#diesel_rate").val(data1.data.DIESEL_RATE)
					  



		   }


		}
	 });


	   
	  var depot_code =  $("#dept_code").val();

	  if(depot_code==''){

		 $('#dept_code').css('border-color','#ff0000').focus();
		

		  }else{
			$('#dept_code').css('border-color','#d2d6de').focus();
			
		  }
  });
</script>
<!-- <script type="text/javascript">
	function getEmployee(){

			var appendData = '<input type="text" name="othercompAmt[]" id="othercompAmt"/>';

			$("#empcompOther").html(appendData);
	} 
</script> -->
<script type="text/javascript">
	
	function getAmount(num){


		var btotal =0;

					$(".basicamt").each(function () {
					   
					  if (!isNaN(this.value) && this.value.length != 0) {
						  btotal += parseFloat(this.value);
					  }

					  

					$("#bTotal").html(btotal.toFixed(2));

				  });

	}

</script>

<script type="text/javascript">
	
	function getAmountpmt(){


		          var banktotpmt =0;

					$(".bankAmt").each(function () {
					   
					  if (!isNaN(this.value) && this.value.length != 0) {
						  banktotpmt += parseFloat(this.value);
					  }

					$("#bankTotal").html(banktotpmt.toFixed(2));

				  });

					var banktot = $("#bankTotal").html();
					var advtot = $(".bTotal").html();

					var balncetot =   parseFloat(advtot) - parseFloat(banktot);

		 		    $("#balnceTotal").html(balncetot.toFixed(2));

					var bTotal = $(".bTotal").html();

					if(bTotal < banktot){

						$("#errMsg").html('Expense total and bank total should be same.');
						$("#submitdata").prop('disabled',true);
						$("#submitNDown").prop('disabled',true);

					}else if(bTotal == banktot){
						$("#submitdata").prop('disabled',false);
						$("#submitNDown").prop('disabled',false);
						$("#errMsg").html('');
					}else{
						$("#errMsg").html('');
						$("#submitdata").prop('disabled',true);
						$("#submitNDown").prop('disabled',true);
					
					}


	}

</script>

<script type="text/javascript">

     function banktotal(sno){
	

					var btotal =0;
					var btotal_diesel =0;
					var btotal_cash =0;
					var diesel_cash_amt=0;




					$(".banktotal").each(function () {
					   
					  if (!isNaN(this.value) && this.value.length != 0) {
						  btotal_diesel += parseFloat(this.value);
					  }

				   });
					  

					$(".banktotal_diesel").each(function () {
					   
					  if (!isNaN(this.value) && this.value.length != 0) {
						  btotal_cash += parseFloat(this.value);
					  }



				   });
					

					var btotal =  parseFloat(btotal_diesel) + parseFloat(btotal_cash);

					$("#bankTotal").html(btotal.toFixed(2));

					var diesel_amt = $("#diesel_amt"+sno).val();
					var cash_amt = $("#cash_amt"+sno).val();

					if(cash_amt==''){

						var newcashamt = 0;
					}else{
						var newcashamt = cash_amt;
					}


					if(diesel_amt==''){

						var newdiesel_amt = 0;
					}else{
						var newdiesel_amt = diesel_amt;
					}
					
						
							
					var diesel_cash_amt = parseFloat(newdiesel_amt) + parseFloat(newcashamt);

					$("#bankAmt"+sno).val(diesel_cash_amt.toFixed(2));


					var banktot = $("#bankTotal").html();
					var advtot = $(".bTotal").html();

					var balncetot =   parseFloat(advtot) - parseFloat(banktot);

		 		    $("#balnceTotal").html(balncetot.toFixed(2));


					var bTotal = $(".bTotal").html();


		if(bTotal < banktot){

			$("#errMsg").html('Expense total and bank total should be same.');
			$("#submitdata").prop('disabled',true);
			$("#submitNDown").prop('disabled',true);

		}else if(bTotal == banktot){
			$("#submitdata").prop('disabled',false);
			$("#submitNDown").prop('disabled',false);
			$("#errMsg").html('');
		}else{
			$("#errMsg").html('');
			$("#submitdata").prop('disabled',true);
			$("#submitNDown").prop('disabled',true);
		
		}


}


function banktotal_cash(sno){
	

					var btotal =0;
					var diesel_amt = $("#diesel_amt"+sno).val();

					$(".banktotal_diesel").each(function () {
					   
					  if (!isNaN(this.value) && this.value.length != 0) {
						  btotal += parseFloat(this.value);
					  }

					  var total_amt = parseFloat(diesel_amt) + parseFloat(btotal);

					  $("#bankTotal").html(total_amt.toFixed(2));

				  });


				var banktot = $("#bankTotal").html();
				var advtot = $(".bTotal").html();

				var balncetot =   parseFloat(advtot) - parseFloat(banktot);

				  $("#balnceTotal").html(balncetot.toFixed(2));



		var bTotal = $(".bTotal").html();

		console.log(banktot);

		if(bTotal < banktot){

			$("#errMsg").html('Expense total and bank total should be same.');
			$("#submitdata").prop('disabled',true);
			$("#submitNDown").prop('disabled',true);

		}else if(bTotal == banktot){
			$("#submitdata").prop('disabled',false);
			$("#submitNDown").prop('disabled',false);
			$("#errMsg").html('');
		}else{
			$("#errMsg").html('');
			$("#submitdata").prop('disabled',true);
			$("#submitNDown").prop('disabled',true);
		
		}


}




</script>


<script type="text/javascript">
  

   function getplanDetails(){

    var tripNo = $("#trip_no").val();
    var vehicleNo = $("#vehicle_no").val();
    var vr_date    = $("#vr_date").val();

   if(tripNo){

        var trip_No = tripNo.split('~');
        var trip_no =trip_No[0];
        var tripHid    =trip_No[1];
        $('#tripHid').val(tripHid);
  }else{
       
        var splitTrip = vehicleNo.split('~');
        var vehicle_no =splitTrip[0];
        var tripHid    =splitTrip[1];

        $('#tripHid').val(tripHid);
     
  }


   //var tripHid = $('#tripHid').val();



	  $.ajaxSetup({

			  headers: {

				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

			  }
	  });

	  $.ajax({

			url:"{{ url('/get-vehicle-plan-details') }}",

			method : "POST",

			type: "JSON",

			data: {trip_no:trip_no,vehicle_no:vehicle_no,tripHid:tripHid},

			/*beforeSend: function() {
                  console.log('start spinner');
                      $('.modalspinner').removeClass('hideloaderOnModl');
                },*/

			success:function(data){

			  var data1 = JSON.parse(data);
			  //console.log(data);

				if (data1.response == 'error') {

				  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

				}else if(data1.response == 'success'){

					var vehicle_type = data1.trip_type;

                  console.log('vehicle_type',data1.trip_type);

                  if(vehicle_type=='VEHICLENO'){

                 var trip_series_code = data1.data.SERIES_CODE;
                  var trip_fy_code = data1.data.FY_CODE;
                  console.log('trip_fy_code',trip_fy_code);

                  var trip_fycode = trip_fy_code.split("-");
                  var trip_vrno = data1.data.VRNO;

                  var trip_no = trip_fycode[0]+' '+trip_series_code+' '+trip_vrno;

                   $("#trip_no").val(trip_no);

                   $("#getTripNum").val(trip_no);
                   $("#getVrDate").val(vr_date);

                  }



					/*if(data1.adhoc_data==''){

				  		$("#bank_code1,#bank_name1,#diesel_amt1,#cash_amt1,#bankAmt1").prop('readonly',false);
				   }else{

				   	var bank_code  = data1.adhoc_data[0].BANK_CODE;
				  	var bank_name  = data1.adhoc_data[0].BANK_NAME;
				  	var cash_amt  = data1.adhoc_data[0].CASH_AMT;
				  	var diesel_amt  = data1.adhoc_data[0].DIESEL_AMT;
				  	var payment  = data1.adhoc_data[0].PAYMENT;

				  	$("#bank_code1").val(bank_code);
				  	$("#bank_name1").val(bank_name);
				  	$("#diesel_amt1").val(diesel_amt);
				  	$("#cash_amt1").val(cash_amt);
				  	$("#bankAmt1").val(payment);
				  	$("#bankTotal").html(payment);

				  	$("#bank_code1,#bank_name1,#diesel_amt1,#cash_amt1,#bankAmt1").prop('readonly',true);
				   }*/

				    if(data1.route_data=='' || data1.route_data==null){

				   	var extra_milage = 0;

				   }else{
				   	
				   	var extra_milage = data1.route_data[0].EXTRA_MILEAGE;
				   }

                           //alert(extra_milage);

				  if(data1.data==''){
					 $("#acc_code").val('');
					 $("#acc_name").val('');
					 $("#vehicle_no").val('');
					 $("#from_place").val('');
					 $("#to_place").val('');
					

				  }else{

				  	if((data1.vehicle_data == '') || (data1.vehicle_data ==null)){
				  		$("#vehicle_type").val(0);
							$("#model").val(0);
						 $("#loadcpct").val(0);
						 $("#loadAvg").val(0);
						 $("#ulcpct").val(0);
						 $("#ulAvg").val(0);
						 $("#emptyAvg").val(0);
				  	}else{
				  		var loadAvg = data1.vehicle_data.LOAD_AVG;
					  	var emptyAvg = data1.vehicle_data.EMPTY_AVG;
					  	var ulAvg = data1.vehicle_data.UL_AVG;


					  	var LoadAvg = parseFloat(loadAvg) + parseFloat(extra_milage);
                                    var UlAvg = parseFloat(ulAvg) + parseFloat(extra_milage);

					  	$("#vehicle_type").val(data1.vehicle_data.WHEEL_TYPE);
					    $("#model").val(data1.vehicle_data.MODEL);
						 $("#loadcpct").val(data1.vehicle_data.LOAD_CPCT);
						 $("#loadAvg").val(LoadAvg.toFixed(2));
						 $("#ulcpct").val(data1.vehicle_data.UL_CPCT);
						 $("#ulAvg").val(UlAvg.toFixed(2));
						 $("#emptyAvg").val(data1.vehicle_data.EMPTY_AVG);
				  	}

				  	

					 $("#transporter_code").val(data1.data.TRANSPORT_CODE);
					 $("#transporter_name").val(data1.data.TRANSPORT_NAME);
					 $("#series_code").val(data1.data.SERIES_CODE);
					 $("#seriesName").val(data1.data.SERIES_NAME);

					 $("#Plant_code").val(data1.data.PLANT_CODE);
					 $("#plantname").val(data1.data.PLANT_NAME);

					 $("#profitctrId").val(data1.data.PFCT_CODE);
					 $("#pfctName").val(data1.data.PFCT_NAME);

					 $("#customer_code").val(data1.data.ACC_CODE);
					 $("#customer_name").val(data1.data.ACC_NAME);

					 $("#vehicle_no").val(data1.data.VEHICLE_NO);
					 $("#from_place").val(data1.data.FROM_PLACE);
					 $("#to_place").val(data1.data.TO_PLACE);
					 $("#truck_no").val(data1.data.VEHICLE_NO);
					 
					 $("#route_code").val(data1.data.ROUTE_CODE);
					 $("#route_name").val(data1.data.ROUTE_NAME);
					 $("#owner_type").val(data1.data.OWNER);
					 $("#tripid").val(data1.data.TRIPHID);
					 $("#driver_name").val(data1.data.DRIVER_NAME);
					// $("#freight_qty").val(data1.data.FREIGHT_QTY);

					 var  owner_type = data1.data.OWNER;

					 if(owner_type=='MARKET'){

					 		$("#expenseTable").hide();
					 		$("#routeDetails").hide();
					 		$("#marketTable").css('display','block');
					 		$("#payment_type").val(data1.data.PAYMENT_MODE);
					 		$("#adv_rate").val(data1.data.ADV_RATE);
					 		$("#adv_amount").val(data1.data.ADV_AMT);


					 		$(".bTotal").html(data1.data.ADV_AMT);



					 }else{

					 	$("#expenseTable").show();
					 	$("#routeDetails").show();
					 	$("#marketTable").css('display','none');
					 	$("#payment_type").val('');
					 	$("#adv_rate").val('');
					 	$("#adv_amount").val('');

					 }


					 



					  $('#itemTable').empty();
					  $('#totalqty').empty();

					 var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DO DATE</div><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>ITEM NAME</div><div class='box10 texIndbox1'>QTY</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>LR DATE</div></div>";

					 $('#itemTable').append(headtbl);

						var srn =1;
						var total = 0;
					 $.each(data1.lr_data, function(k, getData) {

					 	 total += parseFloat(getData.NEWT_WEIGHTB);
					 	 var lrNo = getData.LR_NO;
					 	 if(lrNo){
					 	 	var LR_NO = lrNo;
					 	 }else{
					 	 	var LR_NO = '----';
					 	 }
						
					  var tableData = "<div class='box-row'><div class='box10 texIndbox1 amountrightAlign'>"+getData.DO_NO+"</div><div class='box10 texIndbox1 textLeftaLign'>"+getData.DO_DATE+"</div><div class='box10 texIndbox1 textLeftaLign'>"+getData.ITEM_CODE+"</div><div class='box10 texIndbox1 textLeftaLign'>"+getData.ITEM_NAME+"</div><div class='box10 texIndbox1 amountrightAlign'>"+getData.NEWT_WEIGHTB+"</div><input type='hidden' value='"+getData.NEWT_WEIGHTB+"' id='itemqty"+srn+"'/><div class='box10 texIndbox1 textLeftaLign'>"+LR_NO+"</div><div class='box10 texIndbox1 textLeftaLign'>"+getData.LR_DATE+"</div></div>";

						$('#itemTable').append(tableData);

						srn++;

				  });

          var footerData = "<div class='box-row'><div class='box10 texIndbox1 amountrightAlign'></div><div class='box10 texIndbox1 textLeftaLign'></div><div class='box10 texIndbox1 textLeftaLign'></div><div class='box10 texIndbox1 textLeftaLign'><b>Total : </b></div><div class='box10 texIndbox1 amountrightAlign'><input type='text' value='"+total.toFixed(3)+"' style='border:none;padding: 0px;width: 85px;text-align: right;font-weight:700;line-height: 1.1;' id='itemqtytotal' readonly/></div><input type='hidden' value='' id=''/><div class='box10 texIndbox1 textLeftaLign'></div><div class='box10 texIndbox1 textLeftaLign'></div></div>";

            $('#itemTable').append(footerData);

            $("#freight_qty").val(total.toFixed(3));

					 //var  qty_total = "<div class='totlsetinres box-row'>Total : <input type='text' value='"+total.toFixed(3)+"' style='padding: 0px;width: 85px;text-align: right;line-height: 1.1;' id='itemqtytotal' readonly/></div>";
                    
                  // $('#totalqty').append(qty_total);
                   //$('#freight_qty').val(total.toFixed(3));



					 	$('#bodyTable').empty();

					var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>VEHICLE</div><div class='box10 texIndbox1'>SOURCE</div><div class='box10 texIndbox1'>DESTINATION</div><div class='box10 texIndbox1'>KMS</div><div class='box10 texIndbox1'>TOLL</div><div class='box10 texIndbox1'>EXTRA KMS</div><div class='box10 texIndbox1'>LESS KMS</div><div class='box10 texIndbox1'>EXTRA TOLL</div></div>";

						$('#bodyTable').append(headtbl);

				   // $('#bodyTable').empty();

						var srno =1;
						//var totaldiselcal=0;

						//$("#fromList1").empty();

					 $.each(data1.route_data, function(k, getData) {

						if(getData.VEHICLE_TYPE=='fullload'){

							var caldesile =  parseFloat(getData.KM) / parseFloat(loadAvg);
							
							//$("#fullLoadkm").val(getData.KM);

						}else if(getData.VEHICLE_TYPE=='empty'){

							var caldesile =  parseFloat(getData.KM) / parseFloat(emptyAvg);
							
						}
						else if(getData.VEHICLE_TYPE=='underload'){

							var caldesile =  parseFloat(getData.KM) / parseFloat(ulAvg);

							
						}

						$("#source_code1").prop('readonly',false);


						srno++;

						
					});


					 if(data1.ref_trip_list=='' || data1.ref_trip_list==null){


					 }else{

					 	  $("#refTripList").empty();

					 	$.each(data1.ref_trip_list, function(k, getData) {

					 		$("#refTripList").append($('<option>',{

									  value:getData.TRIP_NO+'~'+getData.TRIPHID,

									  'data-xyz':getData.VEHICLE_NO,
									  text:getData.TRIP_NO+'-'+getData.VEHICLE_NO

						      }));


					 	});

					 }



				
				   
				  }
				}

			},

			 /*complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },*/

		  });


  }

</script>

 <script type="text/javascript">
  

   function getplanDetails_old(){

	  var planNo = $("#trip_no").val();

	  var plan_no = planNo.split(" ");
	  
	  var palnno = plan_no[2];

	  var tripNo = $("#trip_no").val();
      var vehicleNo = $("#vehicle_no").val();
      var vr_date    = $("#vr_date").val();

	 // var vehicle_no = $("#vehicle_no").val();


	  $.ajaxSetup({

			  headers: {

				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

			  }
	  });

	  $.ajax({

			url:"{{ url('/get-vehicle-plan-details') }}",

			method : "POST",

			type: "JSON",

			data: {planNo: planNo},

			/*beforeSend: function() {
                  console.log('start spinner');
                      $('.modalspinner').removeClass('hideloaderOnModl');
                },*/

			success:function(data){

			  var data1 = JSON.parse(data);
			  //console.log(data);

				if (data1.response == 'error') {

				  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

				}else if(data1.response == 'success'){


					if(data1.adhoc_data==''){

				  		$("#bank_code1,#bank_name1,#diesel_amt1,#cash_amt1,#bankAmt1").prop('readonly',false);
				   }else{

				   	var bank_code  = data1.adhoc_data[0].BANK_CODE;
				  	var bank_name  = data1.adhoc_data[0].BANK_NAME;
				  	var cash_amt  = data1.adhoc_data[0].CASH_AMT;
				  	var diesel_amt  = data1.adhoc_data[0].DIESEL_AMT;
				  	var payment  = data1.adhoc_data[0].PAYMENT;

				  	$("#bank_code1").val(bank_code);
				  	$("#bank_name1").val(bank_name);
				  	$("#diesel_amt1").val(diesel_amt);
				  	$("#cash_amt1").val(cash_amt);
				  	$("#bankAmt1").val(payment);
				  	$("#bankTotal").html(payment);

				  	$("#bank_code1,#bank_name1,#diesel_amt1,#cash_amt1,#bankAmt1").prop('readonly',true);
				   }

				    if(data1.route_data=='' || data1.route_data==null){

				   	var extra_milage = 0;

				   }else{
				   	
				   	var extra_milage = data1.route_data[0].EXTRA_MILEAGE;
				   }


				  if(data1.data==''){
					 $("#acc_code").val('');
					 $("#acc_name").val('');
					 $("#vehicle_no").val('');
					 $("#from_place").val('');
					 $("#to_place").val('');
					

				  }else{

				  	if((data1.vehicle_data == '') || (data1.vehicle_data ==null)){
				  		$("#vehicle_type").val(0);
							$("#model").val(0);
						 $("#loadcpct").val(0);
						 $("#loadAvg").val(0);
						 $("#ulcpct").val(0);
						 $("#ulAvg").val(0);
						 $("#emptyAvg").val(0);
				  	}else{
				  		var loadAvg = data1.vehicle_data.LOAD_AVG;
					  	var emptyAvg = data1.vehicle_data.EMPTY_AVG;
					  	var ulAvg = data1.vehicle_data.UL_AVG;


					  	var LoadAvg = parseFloat(loadAvg) + parseFloat(extra_milage);
					  	var UlAvg = parseFloat(ulAvg) + parseFloat(extra_milage);

					  	$("#vehicle_type").val(data1.vehicle_data.WHEEL_TYPE);
							$("#model").val(data1.vehicle_data.MODEL);
						 $("#loadcpct").val(data1.vehicle_data.LOAD_CPCT);
						 $("#loadAvg").val(LoadAvg.toFixed(2));
						 $("#ulcpct").val(data1.vehicle_data.UL_CPCT);
						 $("#ulAvg").val(UlAvg.toFixed(2));
						 $("#emptyAvg").val(data1.vehicle_data.EMPTY_AVG);
				  	}

				  	

					 $("#transporter_code").val(data1.data.TRANSPORT_CODE);
					 $("#transporter_name").val(data1.data.TRANSPORT_NAME);
					 $("#series_code").val(data1.data.SERIES_CODE);
					 $("#seriesName").val(data1.data.SERIES_NAME);

					 $("#Plant_code").val(data1.data.PLANT_CODE);
					 $("#plantname").val(data1.data.PLANT_NAME);

					 $("#profitctrId").val(data1.data.PFCT_CODE);
					 $("#pfctName").val(data1.data.PFCT_NAME);

					 $("#customer_code").val(data1.data.ACC_CODE);
					 $("#customer_name").val(data1.data.ACC_NAME);

					 $("#vehicle_no").val(data1.data.VEHICLE_NO);
					 $("#from_place").val(data1.data.FROM_PLACE);
					 $("#to_place").val(data1.data.TO_PLACE);
					 $("#truck_no").val(data1.data.VEHICLE_NO);
					 
					 $("#route_code").val(data1.data.ROUTE_CODE);
					 $("#route_name").val(data1.data.ROUTE_NAME);
					 $("#owner_type").val(data1.data.OWNER);
					 $("#tripid").val(data1.data.TRIPHID);
					 $("#driver_name").val(data1.data.DRIVER_NAME);

					 var  owner_type = data1.data.OWNER;

					 if(owner_type=='MARKET'){

					 		$("#expenseTable").hide();
					 		$("#routeDetails").hide();
					 		$("#marketTable").css('display','block');
					 		$("#payment_type").val(data1.data.PAYMENT_MODE);
					 		$("#adv_rate").val(data1.data.ADV_RATE);
					 		$("#adv_amount").val(data1.data.ADV_AMT);


					 		$(".bTotal").html(data1.data.ADV_AMT);

					 		}else{

							 	$("#expenseTable").show();
							 	$("#routeDetails").show();
							 	$("#marketTable").css('display','none');
							 	$("#payment_type").val('');
							 	$("#adv_rate").val('');
							 	$("#adv_amount").val('');

					       }


					  $('#itemTable').empty();
					  $('#totalqty').empty();

					 var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DO DATE</div><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>ITEM NAME</div><div class='box10 texIndbox1'>QTY</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>LR DATE</div></div>";

					 $('#itemTable').append(headtbl);

						var srn =1;
						var total = 0;
					 $.each(data1.lr_data, function(k, getData) {

					 	 total += parseFloat(getData.QTY);
						
					  var tableData = "<div class='box-row'><div class='box10 texIndbox1'>"+getData.DO_NO+"</div><div class='box10 texIndbox1'>"+getData.DO_DATE+"</div><div class='box10 texIndbox1'>"+getData.ITEM_CODE+"</div><div class='box10 texIndbox1'>"+getData.ITEM_NAME+"</div><div class='box10 texIndbox1'>"+getData.QTY+"</div><input type='hidden' value='"+getData.QTY+"' id='itemqty"+srn+"'/><div class='box10 texIndbox1'>"+getData.LR_NO+"</div><div class='box10 texIndbox1'>"+getData.LR_DATE+"</div></div>";

						$('#itemTable').append(tableData);

						srn++;

				  });


					 var  qty_total = "<div class='totlsetinres box-row'>Total : <input type='text' value='"+total.toFixed(3)+"' style='padding: 0px;width: 85px;text-align: right;line-height: 1.1;' id='itemqtytotal' readonly/></div>";
                    
                   $('#totalqty').append(qty_total);



					 	$('#bodyTable').empty();

					var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>VEHICLE</div><div class='box10 texIndbox1'>SOURCE</div><div class='box10 texIndbox1'>DESTINATION</div><div class='box10 texIndbox1'>KMS</div><div class='box10 texIndbox1'>TOLL</div><div class='box10 texIndbox1'>EXTRA KMS</div><div class='box10 texIndbox1'>LESS KMS</div><div class='box10 texIndbox1'>EXTRA TOLL</div></div>";

						$('#bodyTable').append(headtbl);

				   // $('#bodyTable').empty();

						var srno =1;
						

					 $.each(data1.route_data, function(k, getData) {

						if(getData.VEHICLE_TYPE=='fullload'){

							var caldesile =  parseFloat(getData.KM) / parseFloat(loadAvg);
							
							//$("#fullLoadkm").val(getData.KM);

						}else if(getData.VEHICLE_TYPE=='empty'){

							var caldesile =  parseFloat(getData.KM) / parseFloat(emptyAvg);
							
						}
						else if(getData.VEHICLE_TYPE=='underload'){

							var caldesile =  parseFloat(getData.KM) / parseFloat(ulAvg);

							
						}

						$("#source_code1").prop('readonly',false);


						srno++;

						
					});
				   
				  }
				}

			},

			 /*complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },*/

		  });


  }

</script>


<script type="text/javascript">
  

   function getplanVehicleDetails(){


	  var vehicle_no = $("#vehicle_no").val();


	  $.ajaxSetup({

			  headers: {

				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

			  }
	  });

	  $.ajax({

			url:"{{ url('/get-vehicle-plan-details-by-vehicle') }}",

			method : "POST",

			type: "JSON",

			data: {vehicle_no:vehicle_no},


			/*beforeSend: function() {
                  console.log('start spinner');
                      $('.modalspinner').removeClass('hideloaderOnModl');
                },
*/
			success:function(data){


			  var data1 = JSON.parse(data);
			  //console.log(data);

				if (data1.response == 'error') {

				  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

				}else if(data1.response == 'success'){


					console.log('adhoc_data',data1.adhoc_data);

				  if(data1.adhoc_data==''){

				  		$("#bank_code1,#bank_name1,#diesel_amt1,#cash_amt1,#bankAmt1").prop('readonly',false);
				   }else{

				   	var bank_code  = data1.adhoc_data[0].BANK_CODE;
				  	var bank_name  = data1.adhoc_data[0].BANK_NAME;
				  	var cash_amt  = data1.adhoc_data[0].CASH_AMT;
				  	var diesel_amt  = data1.adhoc_data[0].DIESEL_AMT;
				  	var payment  = data1.adhoc_data[0].PAYMENT;

				  	$("#bank_code1").val(bank_code);
				  	$("#bank_name1").val(bank_name);
				  	$("#diesel_amt1").val(diesel_amt);
				  	$("#cash_amt1").val(cash_amt);
				  	$("#bankAmt1").val(payment);
				  	$("#bankTotal").html(payment);

				  	$("#bank_code1,#bank_name1,#diesel_amt1,#cash_amt1,#bankAmt1").prop('readonly',true);
				   }

				   if(data1.route_data=='' || data1.route_data==null){

				   	var extra_milage = 0;

				   }else{
				   	
				   	var extra_milage = data1.route_data[0].EXTRA_MILEAGE;
				   }

				  if(data1.data==''){
					 $("#acc_code").val('');
					 $("#acc_name").val('');
					 $("#vehicle_no").val('');
					 $("#from_place").val('');
					 $("#to_place").val('');
					

				  }else{

				  	if((data1.vehicle_data == '') || (data1.vehicle_data ==null)){
				  		 $("#vehicle_type").val(0);
						 $("#model").val(0);
						 $("#loadcpct").val(0);
						 $("#loadAvg").val(0);
						 $("#ulcpct").val(0);
						 $("#ulAvg").val(0);
						 $("#emptyAvg").val(0);
				  	}else{
				  		var loadAvg = data1.vehicle_data.LOAD_AVG;
					  	var emptyAvg = data1.vehicle_data.EMPTY_AVG;
					  	var ulAvg = data1.vehicle_data.UL_AVG;

					  	console.log(loadAvg);
					  	console.log(extra_milage);

					  	var LoadAvg = parseFloat(loadAvg) + parseFloat(extra_milage);
					  	var UlAvg = parseFloat(ulAvg) + parseFloat(extra_milage);

					  	$("#vehicle_type").val(data1.vehicle_data.WHEEL_TYPE);
						$("#model").val(data1.vehicle_data.MODEL);
						$("#loadcpct").val(data1.vehicle_data.LOAD_CPCT);
						$("#loadAvg").val(LoadAvg.toFixed(2));
						$("#ulcpct").val(data1.vehicle_data.UL_CPCT);
						$("#ulAvg").val(UlAvg.toFixed(2));
						$("#emptyAvg").val(data1.vehicle_data.EMPTY_AVG);
				  	}


				  	var trip_explode = data1.data.FY_CODE;
				  	var trip_fy_year = trip_explode.split('-');
				  	var trip_fy_code = trip_fy_year[0];
				  	var trip_series_code = data1.data.SERIES_CODE;
				  	var trip_vrno = data1.data.VRNO;

				  	var tripNo = trip_fy_code+' '+trip_series_code+' '+trip_vrno;

					 $("#trip_no").val(tripNo);
					 $("#transporter_code").val(data1.data.TRANSPORT_CODE);
					 $("#transporter_name").val(data1.data.TRANSPORT_NAME);
					 $("#series_code").val(data1.data.SERIES_CODE);
					 $("#seriesName").val(data1.data.SERIES_NAME);

					 $("#Plant_code").val(data1.data.PLANT_CODE);
					 $("#plantname").val(data1.data.PLANT_NAME);

					 $("#profitctrId").val(data1.data.PFCT_CODE);
					 $("#pfctName").val(data1.data.PFCT_NAME);

					 $("#customer_code").val(data1.data.ACC_CODE);
					 $("#customer_name").val(data1.data.ACC_NAME);

					 $("#vehicle_no").val(data1.data.VEHICLE_NO);
					 $("#from_place").val(data1.data.FROM_PLACE);
					 $("#to_place").val(data1.data.TO_PLACE);
					 $("#truck_no").val(data1.data.VEHICLE_NO);
					 $("#route_code").val(data1.data.ROUTE_CODE);
					 $("#route_name").val(data1.data.ROUTE_NAME);
					 $("#owner_type").val(data1.data.OWNER);
					 $("#tripid").val(data1.data.TRIPHID);
					 $("#driver_name").val(data1.data.DRIVER_NAME);

                     $("#freight_qty").val(data1.data.FREIGHT_QTY);

					 var  owner_type = data1.data.OWNER;

					 if(owner_type=='MARKET'){

					 		$("#expenseTable").hide();
					 		$("#routeDetails").hide();
					 		$("#marketTable").css('display','block');
					 		$("#payment_type").val(data1.data.PAYMENT_MODE);
					 		$("#adv_rate").val(data1.data.ADV_RATE);
					 		$("#adv_amount").val(data1.data.ADV_AMT);


					 		$(".bTotal").html(data1.data.ADV_AMT);

					 }else{

					 	

					 	$("#expenseTable").show();
					 	$("#routeDetails").show();
					 	$("#marketTable").css('display','none');
					 	$("#payment_type").val('');
					 	$("#adv_rate").val('');
					 	$("#adv_amount").val('');

					 }



					  $('#itemTable').empty();

					 var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DO DATE</div><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>ITEM NAME</div><div class='box10 texIndbox1'>QTY</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>LR DATE</div></div>";

					 $('#itemTable').append(headtbl);

						var srn =1;
						var totalqty = 0;
					 $.each(data1.lr_data, function(k, getData) {

					 	 totalqty += parseFloat(getData.QTY);
						
					  var tableData = "<div class='box-row'><div class='box10 texIndbox1'>"+getData.DO_NO+"</div><div class='box10 texIndbox1'>"+getData.DO_DATE+"</div><div class='box10 texIndbox1'>"+getData.ITEM_CODE+"</div><div class='box10 texIndbox1'>"+getData.ITEM_NAME+"</div><div class='box10 texIndbox1'>"+getData.QTY+"</div><input type='hidden' value='"+getData.QTY+"' id='itemqty"+srn+"'/><div class='box10 texIndbox1'>"+getData.LR_NO+"</div><div class='box10 texIndbox1'>"+getData.LR_DATE+"</div></div>";

						$('#itemTable').append(tableData);

						srn++;

				  });


					 var  qty_total = "<div class='totlsetinres box-row'>Total : <input type='text' value='"+totalqty.toFixed(3)+"' style='padding: 0px;width: 85px;text-align: right;line-height: 1.1;' id='itemqtytotal' readonly/></div>";
                    
                                   $('#totalqty').append(qty_total);



					 	$('#bodyTable').empty();

					var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>VEHICLE</div><div class='box10 texIndbox1'>SOURCE</div><div class='box10 texIndbox1'>DESTINATION</div><div class='box10 texIndbox1'>KMS</div><div class='box10 texIndbox1'>TOLL</div><div class='box10 texIndbox1'>EXTRA KMS</div><div class='box10 texIndbox1'>LESS KMS</div><div class='box10 texIndbox1'>EXTRA TOLL</div></div>";

						$('#bodyTable').append(headtbl);


						//var srno =1;
						//var totaldiselcal=0;
						//$("#fromList1").empty();

						//


					 /*$.each(data1.route_data, function(k, getData) {

						if(getData.VEHICLE_TYPE=='fullload'){

							var caldesile =  parseFloat(getData.KM) / parseFloat(loadAvg);

						}else if(getData.VEHICLE_TYPE=='empty'){

							var caldesile =  parseFloat(getData.KM) / parseFloat(emptyAvg);
							
						}
						

						$("#source_code1").prop('readonly',false);

						

						srno++;

						
					});*/


				   
				  }
				}

			},
			/*complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },*/

		  });


  }

</script>


<script type="text/javascript">
	
	function extraToll(num) {
		
		/* var extra_toll =  $("#extra_toll"+num).val();

		 $("#totalextratoll").val(extra_toll);*/
		  allextratoll =0;
                        $(".allExtraToll").each(function () {
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  allextratoll += parseFloat(this.value);

                              }
                            $("#totalextratoll").val(allextratoll);
                          });


	}
</script>

<script type="text/javascript">
  
  function bankName(num){


	  var Bankcode =  $("#bank_code"+num).val();
	   var bankCodeDup =     $("#bankCodeDup").val();

	   //alert(Bankcode);

	   if(bankCodeDup == Bankcode){

	   // alert('dublicate');
		$("#dublicateerr").html('dublicate bank code not allowed');

		$("#bank_code"+num).val('');

		return false;
	   }else{

		var xyz = $("#bankList"+num+" option").filter(function() {

		  return this.value == Bankcode;

	  }).data('xyz');

	   var msg = xyz ?  xyz : 'No Match';

		if(msg=='No Match'){

                  $("#bank_name"+num).val('');
                  $("#bankCodeDup").val('');
		   
		}else{
		
			$("#bank_name"+num).val(msg);
			$("#bankCodeDup").val(Bankcode);
                  $("#deletehidn").prop('disabled',true);
                  $("#addmorhidn").prop('disabled',true);
			$("#dublicateerr").html('');
		}

	   }

	   

  }

</script>

<script type="text/javascript">
  $("#account_code").bind('change', function () {
  var Acccode =  $(this).val();
  var xyz = $('#AccountList option').filter(function() {

	return this.value == Acccode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
	 $(this).val('');
	 $('#accountName').val('');
	 document.getElementById("acccode_err").innerHTML = 'The Account code field is required.';
	  $('#getAccCode').val('');
	  $('#emplList').empty();
	  $('#emp_code').val('');
	  $('#emp_code').prop('readonly',true);
	  $('#empName').html('');
	  $('#emplyeeName').val('');
  }else{
	$('#accountName').val(msg);
	 document.getElementById("acccode_err").innerHTML = '';
	 var AccountCode = $('#account_code').val();
	 var vrseqnum = $('#vrseqnum').val();
	 var transcode = $('#transcode').val();
	 $('#getAccCode').val(AccountCode);
	 $('#getDeptName').val(msg);
	 $('#getVrNo').val(vrseqnum);
	 $('#getTransCode').val(transcode);
	 //$('#emp_code').prop('readonly',false);
	
  }

  // objvalidtn.checkBlankFieldValidation();

});
</script>





<script type="text/javascript">
  
  function getTruckDetails(){


	//alert(truckNo);return false;
	var vehicle_inward = $("#vehicle_inward_no").val();

	  if(vehicle_inward){

		$('#vehicle_inward_no').css('border-color','#d2d6de').focus();
		document.getElementById("vehicleinwardErr").innerHTML = '';

		$('#trans_code').css('border-color','#ff0000');
		$('#trans_code').prop('readonly',false);
		
		}else{
		 
		 $('#vehicle_inward_no').css('border-color','#ff0000').focus();
		 document.getElementById("vehicleinwardErr").innerHTML = 'The vehicle inward field required';
		 $('#trans_code').css('border-color','#d2d6de').focus();
		 $('#trans_code').prop('readonly',true);
		}


	var explode = vehicle_inward.split(' ');
	var fy_code = explode[0];
	var series_code = explode[1];
	var vr_no = explode[2];
	
	   $.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });


	   $.ajax({

		  url:"{{ url('get-truckno-details') }}",

		   method : "POST",

		   type: "JSON",

		   data: {fy_code: fy_code,series_code:series_code,vr_no:vr_no},

		   success:function(data){

			  console.log(data);

				var data1 = JSON.parse(data);

				if (data1.response == 'error') {

					$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

				}else if(data1.response == 'success'){
					 console.log(data1.data.WHEEL_TYPE);
				   // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);
					  $("#truck_no").val(data1.data.VEHICLE_NO);
					  $("#driver_name").val(data1.data.DRIVER_NAME);
					  $("#vehicle_type").val(data1.datafleet.WHEEL_TYPE);
					  $("#model").val(data1.datafleet.MODEL);
					  $("#loadcpct").val(data1.datafleet.LOAD_CPCT);
					  $("#loadAvg").val(data1.datafleet.LOAD_AVG);
					  $("#emptyAvg").val(data1.datafleet.EMPTY_AVG);

					 $.each(data1.dataexp, function(k, getData) {

						 var num = 1;
					 
						$("#IndList"+num).append($('<option>',{

						  value:getData.FLEETIND,

						  'data-xyz':getData.FLEETIND,
						  text:getData.FLEETIND

						}));

						num++;
					
				  });



		   }


		}
	 });



  }
</script>



<script type="text/javascript">
  calculate = function()
  {
	var DEISEL=DRV_Exp=P_Exp=Fooding=Fooding=LU_Exp=Other_Exp=Toll=0;
	
	
	 DEISEL = document.getElementById('a1').value;
	 DRV_Exp = document.getElementById('a2').value; 
	 P_Exp = document.getElementById('a3').value; 
	 Fooding = document.getElementById('a4').value; 
	 LU_Exp = document.getElementById('a5').value; 
	 Toll = document.getElementById('a6').value; 
	 Other_Exp = document.getElementById('a7').value; 
	 
	 if(DEISEL=="")DEISEL=0;
	 if(DRV_Exp=="")DRV_Exp=0;
	 if(P_Exp=="")P_Exp=0;
	 if(Fooding=="")Fooding=0;
	 if(LU_Exp=="")LU_Exp=0;
	 if(Toll=="")Toll=0;
	 if(Other_Exp=="")Other_Exp=0;
   
	  
	 
	document.getElementById('TOTAL').value = parseInt(DEISEL)+parseInt(DRV_Exp)+parseInt(P_Exp)+parseInt(Fooding)+parseInt(LU_Exp)+parseInt(Toll)+parseInt(Other_Exp);

	 }
</script>

<!-- <script type="text/javascript">

	$(".optionsRadios1").on('change',function () { 

	 var radio_btn = $(this).val();

	 var route_code = $("#route_code").val();

	// alert(route_name);

	   $.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });

   if(radio_btn=='double point'){


 		$(".optionsRadios1").prop('disabled',true);

		$.ajax({

		  url:"{{ url('get-vehicle-routes-delivery-charge') }}",

		   method : "POST",

		   type: "JSON",

		   data: {route_code: route_code},

		   success:function(data){


				var data1 = JSON.parse(data);
			
				//alert();

				if (data1.response == 'error') {

				   // $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

				}else if(data1.response == 'success'){
					

					$("#indicator1").val(data1.expens_data[0].FLEETIND);
					$("#gl_code1").val(data1.expens_data[0].GL_CODE);
					$("#Amt1").val(data1.expens_data[0].RATE);


					var btotal =0;

					$(".basicamt").each(function () {
					   
					  if (!isNaN(this.value) && this.value.length != 0) {
						  btotal += parseFloat(this.value);
					  }

					  

					$("#bTotal").html(btotal.toFixed(2));

				  });
			
		 	   }


		}
	 });

   }else{

   	$("#indicator1").val('');
    $("#gl_code1").val('');
    $("#Amt1").val('');
   }
	
});

</script> -->

<script type="text/javascript">

	function getExpenseData(){

		    var totalkm       = $("#totalkm").val();
		    var trip_type     = $("#trip_type").val();
			var totaldiselcal = $("#totaldiselcal").val();
			var diesel_rate   = $("#diesel_rate").val();
			var ulcpct        = $("#ulcpct").val();
			var loadcpct        = $("#loadcpct").val();
			//var itemqty       = $("#itemqtytotal").val();
                  var itemqty       = $("#freight_qty").val();
			var kmcal         = $("#fullLoadkm").val();
			var toll          = $("#totaltoll").val();
			var extratoll     = $("#totalextratoll").val();
			var weight_rate   = $("#weight_rate1").val();
			var ref_qty       = $("#ref_qty").val();
			var bankTotal     = $("#bankTotal").html();
	
			//var card_type = $("input[type='radio'].optionsRadios1:checked").val();

			var radioValue = $("input[name='point_delivery']:checked").val();


			var fullLoadKm =0;
			var emptyLoadKm =0;

			var rowIDget = [];

			$(".rowCountRoute").each(function () {
        
		         rowIDget.push(this.value);

		    });

			for(var q=0;q<rowIDget.length;q++){

				var colIdSlno = rowIDget[q];

				 var vehicleType =	$("#vehicle_type"+colIdSlno).val();
				 var flkm =	$("#km"+colIdSlno).val();

				 if(vehicleType=='fullload'){

				 	fullLoadKm = parseFloat(fullLoadKm) + parseFloat(flkm);

				 }else{

				 	emptyLoadKm = parseFloat(emptyLoadKm) + parseFloat(flkm);
				 }
			}

			//alert(radioValue);

			if(radioValue=='double point'){

				$("#indicator1").val('DELIVERY CHARGES');
				$("#gl_code1").val('XI127');
				$("#Amt1").val('500');
			}else{

				$("#indicator1").val('');
				$("#gl_code1").val('');
				$("#Amt1").val('');
			}

				var ele = document.getElementsByName('point_delivery');
              
            for(i = 0; i < ele.length; i++) {
                if(ele[i].checked){

                	var delivery_value = ele[i].value;
                	
                }else{

                }
                
            }

			//alert(delvery_point);return false;

			$("#indicator1").prop('readonly',false);
			$("#gl_code1").prop('readonly',false);
			$("#Amt1").prop('readonly',false);
			$("#extra_toll1").prop('readonly',true);
			$("#firstrow1").prop('disabled',false);
			$(".casecheck").prop('disabled',true);
			$("#addmorhidn").prop('disabled',false);
			$("#deletehidn").prop('disabled',false);
			$("#addButton").prop('disabled',true);
			$("#removeButton").prop('disabled',true);
			$(".optionsRadios1").prop('readonly',true);


		//	alert(totalkm);


		 $.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });

		 $.ajax({

		  url:"{{ url('get-vehicle-expense-data-by-km') }}",

		   method : "POST",

		   type: "JSON",

		   data: {fullLoadKm:fullLoadKm,emptyLoadKm:emptyLoadKm,totalkm: totalkm,trip_type:trip_type},

		   success:function(data){

		   //	console.log(data);return false;

		   	var data1 = JSON.parse(data);
				

				if (data1.response == 'error') {

				   

				}else if(data1.response == 'success'){




					 var num =1;
					 var sff =[];

					 $.each(data1.expense_data, function(k, getData) {

					 		 sff.push(getData.FLEETIND);

					 	 if(getData.FLEETIND =='DIESEL'){

					     var deiselCal = parseFloat(totaldiselcal) * parseFloat(diesel_rate);

						 //$("#Amt"+num).val(deiselCal.toFixed(2));
					//  alert(deiselCal);

					//console.log();

							//var roundoffCal = Math.round(deiselCal);

							var roundoffCal = Math.floor(deiselCal / 10) * 10;

							var amount =roundoffCal.toFixed(2);

					  }else if(getData.FLEETIND=='DELIVERY CHARGE'){

					  		if(delivery_value=='double point'){

					  			var amount = '500';

					  		}else{

					  			var amount = '0.00';
					  		}

					  }else if(getData.FLEETIND=='OVERLOAD ALLOWANCE'){

					  	var qty  =  parseFloat(itemqty) - parseFloat(loadcpct);

					  	if(isNaN(qty)){

					  		var amount = 0.00;

					  	}else{

					  		 //  var weight_rate =  getData.WEIGHT_RATE;

					  		   console.log('qty',qty);
					  		   console.log('weight_rate',weight_rate);
					  		  
					  		   if(qty > 0){

					  		   	var calqty = parseFloat(qty) * parseFloat(weight_rate) ;

					  		  //var calqty = parseFloat(qty) * parseFloat(weight_rate);

							    var totalqty = parseFloat(calqty) * parseFloat(kmcal);

							   
							    var amount =  Math.round(totalqty.toFixed(2));

					  		   }else{

					  		   	var amount =  0;
					  		   }
					  		  
					  		   
					  	}
					    


					  }else if(getData.FLEETIND=='MUNSIYANA CHARGES'){

					  	    var charges =  getData.RATE;

					  	     if(charges <= 200){

					  	     	var amount = 100;

					  	     }else if(charges > 200){

					  	     	var amount = 500;
					  	     }

					  }else{

						 	var amount = getData.RATE;
						
					  }

					  if(getData.FLEETIND=='TOLL'){

					  	var amount = toll;

					  }

                                if(getData.FLEETIND=='EXTRA TOLL'){

                                    var amount = extratoll;

                                }


					  

					 	$("#vehicle_type"+num).prop('readonly',true);
					
					 	var expense_data = "<div class='divTableRow rowcount TextBoxesGroup_"+num+" trrowget'><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+num+"'><input type='checkbox' class='casecheck' disabled id='tablesecnd"+num+"'></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+num+"'><input type='text'  value='"+getData.FLEETIND+"' id='ind"+num+"'  style='width: 103px;' name='indicator[]'></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+num+"' type='textbox'  class='tooltips'><input type='text' id='glcode"+num+"'   value='"+getData.GL_CODE+"' name='gl_code[]'  style='width: 100px;'><input type='hidden' id='glName"+num+"'   value='"+getData.GL_NAME+"' name='gl_name[]'  style='width: 100px;'><small class='tooltiptext tooltiphide' id='accountNameTooltip"+num+"' type='textbox''></small></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+num+"'><input type='text' id='rateAmt"+num+"' class='basicamt' oninput='getAmount("+num+")' value='"+amount+"' name='Amt[]' readonly style='width: 100px;text-align:right;'><datalist id='toList"+num+"'><option value=''></option></datalist><input type='hidden' value='' id='othercompAmt"+num+"' name='othercompAmt[]'/></div></div></div></div>"

						


						$('.expenseBody').before(expense_data);


						

						num++;


									var btotal =0;
									$(".basicamt").each(function () {
								   
								  if (!isNaN(this.value) && this.value.length != 0) {
									  btotal += parseFloat(this.value);
								  }

								  

								$(".bTotal").html(btotal.toFixed(2));

							  });
					
				  });

					 $("#dubindicator").val(sff);
					 $("#expenseid").prop('disabled',true);

				//	 console.log('fleetind',sff);

					  $.each(data1.lrexp_data, function(k, getLrData) {

							 		$("#IndList1").append($('<option>',{

								  value:getLrData.LRIND_NAME,

								  'data-xyz':getLrData.LRIND_NAME,
								  text:getLrData.LRIND_NAME

								}));

					 });

					 var btotalval =  $(".bTotal").html();

					 if(bankTotal > 0){

					 	var baltotal = parseFloat(btotalval) - parseFloat(bankTotal);

					 	
					     $("#balnceTotal").html(baltotal.toFixed(2));

					 }else{

					 }






		   }
		 }

		 });


	}
	
</script>


<script type="text/javascript">

	function getGlCode(num){

		var accountcode = $("#emp_code").val();

		var xyz = $('#empList option').filter(function() {

          return this.value == accountcode;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';


         if(msg=='No Match'){

             $(this).val('');
             $('#empNameText').html('');
         }else{
             
             $('#empNameText').html(msg);
         }


		$.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });



          $.ajax({

              type: 'POST',

              url: "<?php echo url('/gl-code-for-employee-code'); ?>",

              data: {accountcode:accountcode}, // here $(this) refers to the ajax object not form

              success: function (data) {

                 var data1 = JSON.parse(data);

                  var gl_code =  data1.data[0].GL_CODE;
                  var gl_name =  data1.data[0].GL_NAME;

                  if(gl_code=='' || gl_code==null){

                  		$("#glCodeErr").html('Gl Code Not Found').css('color','red');

                  }else{

                  	   $("#empgl_code").val(gl_code);
                  	   $("#empgl_name").val(gl_name);
                  }

                  

                     
              },

          });

	}


function getPmtGlCode(){

		var accountcode = $("#pmtemp_code").val();

		var xyz = $('#pmtempList option').filter(function() {

          return this.value == accountcode;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';


         if(msg=='No Match'){

             $(this).val('');
             $('#pmtempNameText').html('');
              $('#pmtempNameText1').val('');
         }else{
             
             $('#pmtempNameText').html(msg);
             $('#pmtempNameText1').val(msg);
         }


		$.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });



          $.ajax({

              type: 'POST',

              url: "<?php echo url('/gl-code-for-employee-code'); ?>",

              data: {accountcode:accountcode}, // here $(this) refers to the ajax object not form

              success: function (data) {

                 var data1 = JSON.parse(data);

                  var gl_code =  data1.data[0].GL_CODE;
                  var gl_name =  data1.data[0].GL_NAME;

                  if(gl_code=='' || gl_code==null){

                  		$("#pmtglCodeErr").html('Gl Code Not Found').css('color','red');

                  }else{

                  	   $("#pmtempgl_code").val(gl_code);
                  	   $("#pmtempgl_name").val(gl_name);
                  }

                  

                     
              },

          });

	}
</script>
<script type="text/javascript">
	
	function getRouteInfo(srno){

		var route_code    = $('#route_code').val();
		var loadAvg       = $("#loadAvg").val();
		var emptyAvg      = $("#emptyAvg").val();
		var ulAvg         = $("#ulAvg").val();
		var loadcpct      = $("#loadcpct").val();
		var ulcpct        = $("#ulcpct").val();
		var vehicle_type  = $('#vehicle_type'+srno).val();
		var from_place    = $('#from_place').val();
		var to_place      = $('#to_place').val();
		var vehicle_type  = $("#vehicle_type"+srno).val();
		var trip_type     = $("#trip_type").val();
		var totalqty     = $("#itemqtytotal").val();



		//alert(from_place);
		

		var dublicateName = vehicle_type+'_'+from_place+'_'+to_place;

		 


         if(vehicle_type=='empty'){

           var num = srno - 1;
		   var destination_name   = $("#to_place").val();

		   	$("#source_code"+srno).val(destination_name);

         }else{

         	var destination_name   = '';

         	$('#source_code'+srno).val(from_place);
            $('#destination_code'+srno).val(to_place);

         }


		 $.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });

		 $.ajax({

		  url:"{{ url('get-vehicle-routes-details-by-vehicle-type') }}",

		   method : "POST",

		   type: "JSON",

		   data: {from_place:from_place,to_place:to_place,destination_name:destination_name,trip_type:trip_type},

		   success:function(data){

		   //	console.log(data);return false;

		   	var data1 = JSON.parse(data);
				

				if (data1.response == 'error') {

				   

				}else if(data1.response == 'success'){



						 
						 if(vehicle_type=='fullload'){


							  $("#expenseid").prop("disabled",false);
							  $("#addButton").prop("disabled",false);
							  $("#removeButton").prop("disabled",false);
							  $("#km"+srno).val(data1.data[0].KM);
							
								$("#toll"+srno).val(data1.data[0].TOLL);
								$("#extra_km"+srno).val(data1.data[0].EXTRA_KM);
								$("#less_km"+srno).val(data1.data[0].LESS_KM);
								$("#extra_toll"+srno).val(data1.data[0].EXTRA_TOLL);
								$("#weight_rate"+srno).val(data1.data[0].WEIGHT_RATE);

								var weightRate = data1.data[0].WEIGHT_RATE;

					 	// var vehicle_type = data1.data[0].VEHICLE_TYPE;

											var km =  data1.data[0].KM;

											if(vehicle_type=='fullload'){

												$("#fullLoadkm").val(km);

												if(totalqty > loadcpct){

												   var vehicleAvg =  loadAvg;

												}else if(totalqty > ulcpct && totalqty <= loadcpct){

													var vehicleAvg = loadAvg;

												}else if(totalqty <= ulcpct){

													var vehicleAvg = ulAvg;
													
												}

												var caldesile =  parseFloat(km) / parseFloat(vehicleAvg);

											
											}else if(vehicle_type=='empty'){

												var caldesile =  parseFloat(km) / parseFloat(emptyAvg);
												
											}
											
										     $("#diesel"+srno).val(caldesile);


											        gr_amt =0;
				                         $(".getkmtotal").each(function () {
				                         
				                              if (!isNaN(this.value) && this.value.length != 0) {
				                                  //gr_amt1 = parseFloat(qtyval);
				                                  gr_amt += parseFloat(this.value);

				                              }
				                            $("#totalkm").val(gr_amt.toFixed(3));
				                          });

				                         //var allGrandAmount = parseFloat($('#totalkm').val());

				                     diesel_amt =0;
				                         $(".getdiesel").each(function () {
				                         
				                              if (!isNaN(this.value) && this.value.length != 0) {
				                                  //gr_amt1 = parseFloat(qtyval);
				                                  diesel_amt += parseFloat(this.value);   
				                              }

				                            $("#totaldiselcal").val(diesel_amt.toFixed(3));

				                          });

				                  // var allGrandAmount = parseFloat($('#totaldiselcal').val());

													   alltoll =0;
				                         $(".allToll").each(function () {
				                         
				                              if (!isNaN(this.value) && this.value.length != 0) {
				                                  //gr_amt1 = parseFloat(qtyval);
				                                  alltoll += parseFloat(this.value);

				                              }
				                            $("#totaltoll").val(alltoll.toFixed(3));
				                          });

				                       allextratoll =0;
				                        $(".allExtraToll").each(function () {
				                         
				                              if (!isNaN(this.value) && this.value.length != 0) {
				                                  //gr_amt1 = parseFloat(qtyval);
				                                  allextratoll += parseFloat(this.value);

				                              }
				                            $("#totalextratoll").val(allextratoll.toFixed(3));
				                          });

									}else{

										if(data1.destination_data=='' || data1.destination_data==null){

										$("#toplaceList"+srno).empty();

								
										$("#expenseErrModal").modal();

										$("#errexpMsg").html('<i class="fa fa-caret-right" aria-hidden="true"></i>  <b>Destination not avilable for this source...! </b>');

								}else{


									     $("#toplaceList"+srno).empty();


									     console.log(data1.destination_data);

											 $.each(data1.destination_data, function(k, getData) {

												$("#toplaceList"+srno).append($('<option>',{

												  value:getData.TO_PLACE,

												  'data-xyz':getData.TO_PLACE,
												  text:getData.TO_PLACE

												}));

											
										  });


								}
									}


								 var existVal = $("#dublicateName").val();

												if(existVal == ''){

													$("#dublicateName").val(dublicateName);
												
												}else{

													var blnkAry = [];
													var existGet = $("#dublicateName").val();

													if (existGet.indexOf(',') != -1) {

												    var segments = existGet.split(',');

												    for(var i=0;i<segments.length;i++){
															blnkAry.push(segments[i]);
														}

														var checkDub = blnkAry.includes(dublicateName);

														if(checkDub == true){
															$('#showDubDataMsg').html('Dublicate Route Details');
															
															 $('#vehicle_type'+srno).val('');
													          $('#source_code'+srno).val('');
													          $('#destination_code'+srno).val('');
													          $('#km'+srno).val('');
													          $('#toll'+srno).val('');
													          $('#extra_km'+srno).val('');
													          $('#less_km'+srno).val('');
													          $('#extra_toll'+srno).val('');
										         
										          
														}else if(checkDub == false){
															$('#showDubDataMsg').html('');
															var getPrevVal = $("#dublicateName").val();
															$("#dublicateName").val(getPrevVal+','+dublicateName);
															
															
														}

													}else{

															var blnkAry1 = [];
															var existGet1 = $("#dublicateName").val();
															blnkAry1.push(existGet1);

															var checkDub1 = blnkAry1.includes(dublicateName);

															if(checkDub1 == true){
																$('#showDubDataMsg').html('Dublicate Route Details');
																$('#vehicle_type'+srno).val('');
														          $('#source_code'+srno).val('');
														          $('#destination_code'+srno).val('');
														          $('#km'+srno).val('');
														          $('#toll'+srno).val('');
														          $('#extra_km'+srno).val('');
														          $('#less_km'+srno).val('');
														          $('#extra_toll'+srno).val('');
											          
															}else if(checkDub1 == false){
																$('#showDubDataMsg').html('');
																var getPrevVal1 = $("#dublicateName").val();
																$("#dublicateName").val(getPrevVal1+','+dublicateName);
																

															
															}


													}

										}



		   }
		 }

		 });
  	
	}

</script>

<script type="text/javascript">

	function getRoute(srno){

		var route_code    = $('#route_code').val();
		var loadAvg       = $("#loadAvg").val();
		var emptyAvg      = $("#emptyAvg").val();
		var ulAvg         = $("#ulAvg").val();
		var loadcpct      = $("#loadcpct").val();
		var ulcpct        = $("#ulcpct").val();
		var vehicle_type  = $('#vehicle_type'+srno).val();
		var from_place    = $('#source_code'+srno).val();
		var to_place      = $('#destination_code'+srno).val();
		var trip_type     = $("#trip_type").val();
		//var totalqty     = $("#itemqtytotal").val();
            var totalqty       = $("#freight_qty").val();



		var dublicateName = vehicle_type+'_'+from_place+'_'+to_place;



		 $.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });

		 $.ajax({

		  url:"{{ url('get-vehicle-routes-details-by-vehicle-type') }}",

		   method : "POST",

		   type: "JSON",

		   data: {from_place: from_place,to_place:to_place,trip_type:trip_type},

		   success:function(data){

		   //	console.log(data);return false;

		   	var data1 = JSON.parse(data);
				

				if (data1.response == 'error') {

				   

				}else if(data1.response == 'success'){




						  $("#expenseid").prop("disabled",false);
						  $("#addButton").prop("disabled",false);
						  $("#removeButton").prop("disabled",false);
						  $("#km"+srno).val(data1.data[0].KM);
							
							$("#toll"+srno).val(data1.data[0].TOLL);
							$("#extra_km"+srno).val(data1.data[0].EXTRA_KM);
							$("#less_km"+srno).val(data1.data[0].LESS_KM);
							$("#extra_toll"+srno).val(data1.data[0].EXTRA_TOLL);
							$("#weight_rate"+srno).val(data1.data[0].WEIGHT_RATE);

					 	// var vehicle_type = data1.data[0].VEHICLE_TYPE;

					 	 var weightRate = data1.data[0].WEIGHT_RATE;

							var km =  data1.data[0].KM;

							if(vehicle_type=='fullload'){

								$("#fullLoadkm").val(km);

								if(totalqty > loadcpct){

							    var vehicleAvg =  loadAvg;

								}else if(totalqty > ulcpct && totalqty <= loadcpct){

									var vehicleAvg = loadAvg;

								}else if(totalqty <= ulcpct){

									var vehicleAvg = ulAvg;
									
								}



								var caldesile =  parseFloat(km) / parseFloat(vehicleAvg);

							  //var caldesile =  parseFloat(km) / parseFloat(loadAvg);
							
							$("#fullLoadkm").val(km);

							}else if(vehicle_type=='empty'){

								var caldesile =  parseFloat(km) / parseFloat(emptyAvg);
								
							}
							

						     $("#diesel"+srno).val(caldesile);


							        gr_amt =0;
                         $(".getkmtotal").each(function () {
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  gr_amt += parseFloat(this.value);

                              }
                            $("#totalkm").val(gr_amt.toFixed(3));
                          });

                         //var allGrandAmount = parseFloat($('#totalkm').val());

                     diesel_amt =0;
                         $(".getdiesel").each(function () {
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  diesel_amt += parseFloat(this.value);   
                              }

                            $("#totaldiselcal").val(diesel_amt.toFixed(3));

                          });

                  // var allGrandAmount = parseFloat($('#totaldiselcal').val());

									   alltoll =0;
                         $(".allToll").each(function () {
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  alltoll += parseFloat(this.value);

                              }
                            $("#totaltoll").val(alltoll.toFixed(3));
                          });

                       allextratoll =0;
                        $(".allExtraToll").each(function () {
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  allextratoll += parseFloat(this.value);

                              }
                            $("#totalextratoll").val(allextratoll.toFixed(3));
                          });


                       var existVal = $("#dublicateName").val();

												if(existVal == ''){

													$("#dublicateName").val(dublicateName);
												
												}else{

													var blnkAry = [];
													var existGet = $("#dublicateName").val();

													if (existGet.indexOf(',') != -1) {

												    var segments = existGet.split(',');

												    for(var i=0;i<segments.length;i++){
															blnkAry.push(segments[i]);
														}

														var checkDub = blnkAry.includes(dublicateName);

														if(checkDub == true){
															$('#showDubDataMsg').html('Dublicate Route Details');
															
															$('#vehicle_type'+srno).val('');
										          $('#source_code'+srno).val('');
										          $('#destination_code'+srno).val('');
										          $('#km'+srno).val('');
										          $('#toll'+srno).val('');
										          $('#extra_km'+srno).val('');
										          $('#less_km'+srno).val('');
										          $('#extra_toll'+srno).val('');
										         
										          
														}else if(checkDub == false){
															$('#showDubDataMsg').html('');
															var getPrevVal = $("#dublicateName").val();
															$("#dublicateName").val(getPrevVal+','+dublicateName);
															
															
														}

													}else{

															var blnkAry1 = [];
															var existGet1 = $("#dublicateName").val();
															blnkAry1.push(existGet1);

															var checkDub1 = blnkAry1.includes(dublicateName);

															if(checkDub1 == true){
																$('#showDubDataMsg').html('Dublicate Route Details');
																$('#vehicle_type'+srno).val('');
											          $('#source_code'+srno).val('');
											          $('#destination_code'+srno).val('');
											          $('#km'+srno).val('');
											          $('#toll'+srno).val('');
											          $('#extra_km'+srno).val('');
											          $('#less_km'+srno).val('');
											          $('#extra_toll'+srno).val('');
											          
															}else if(checkDub1 == false){
																$('#showDubDataMsg').html('');
																var getPrevVal1 = $("#dublicateName").val();
																$("#dublicateName").val(getPrevVal1+','+dublicateName);
																

															
															}


													}

										}



		   }
		 }

		 });
  	
		
 


	}
	
</script>


<script type="text/javascript">
	function loadType(srno){

		var vehicle_type = $("#vehicle_type"+srno).val();
		var source_code  = $("#source_code"+srno).val();
		var destination  = $("#destination_code"+srno).val();

		var dublicateName = vehicle_type+'_'+source_code+'_'+destination;



		var existVal = $("#dublicateName").val();

		if(existVal == ''){

			$("#dublicateName").val(dublicateName);


		
		}else{

			var blnkAry = [];
			var existGet = $("#dublicateName").val();

			if (existGet.indexOf(',') != -1) {

		    var segments = existGet.split(',');

		    for(var i=0;i<segments.length;i++){
					blnkAry.push(segments[i]);
				}

				var checkDub = blnkAry.includes(dublicateName);

				if(checkDub == true){
					$('#showDubDataMsg').html('Dublicate Route Details');
					
					$('#vehicle_type'+srno).val('');
          $('#source_code'+srno).val('');
          $('#destination_code'+srno).val('');
          $('#km'+srno).val('');
          $('#toll'+srno).val('');
          $('#extra_km'+srno).val('');
          $('#less_km'+srno).val('');
          $('#extra_toll'+srno).val('');
          $("#addButton").prop('disabled',true);
				}else if(checkDub == false){
					$('#showDubDataMsg').html('');
					var getPrevVal = $("#dublicateName").val();
					$("#dublicateName").val(getPrevVal+','+dublicateName);
					$("#addButton").prop('disabled',false);
					
				}

			}else{

					var blnkAry1 = [];
					var existGet1 = $("#dublicateName").val();
					blnkAry1.push(existGet1);

					var checkDub1 = blnkAry1.includes(dublicateName);

					if(checkDub1 == true){
						$('#showDubDataMsg').html('Dublicate Route Details');
						$('#vehicle_type'+srno).val('');
          $('#source_code'+srno).val('');
          $('#destination_code'+srno).val('');
          $('#km'+srno).val('');
          $('#toll'+srno).val('');
          $('#extra_km'+srno).val('');
          $('#less_km'+srno).val('');
          $('#extra_toll'+srno).val('');
          $("#addButton").prop('disabled',true);
					}else if(checkDub1 == false){
						$('#showDubDataMsg').html('');
						var getPrevVal1 = $("#dublicateName").val();
						$("#dublicateName").val(getPrevVal1+','+dublicateName);
						$("#addButton").prop('disabled',false);

					
					}


			}
			
			

			//console.log('checkDub',checkDub);
		//	console.log('blnkAry',blnkAry);
			/*if(existGet == dublicateName){
				console.log('')
			}*/
		}
		/*var arrayLoad = [];

		
		var nameOfArray =   $("#dublicateName").val();
  		
   	if(nameOfArray!=''){

   		var nameOfArray1 =	$("#dublicateName").val();

   		console.log('nameOfArray1',nameOfArray1);

   		if(nameOfArray1==dublicateName){

   			console.log('error');
   		}else{
   			 console.log('sucess');
   			
   			arrayLoad.push(dublicateName);

   			$("#dublicateName").val(arrayLoad);

   			console.log('newArry',arrayLoad);
   		}

   	}else{

   		arrayLoad.push(dublicateName);

   		$("#dublicateName").val(arrayLoad);

   	}*/
      
   
     /*if(getdublicateName != ''){

     		var findarray = arrayLoad.includes(dublicateName);

     		if(findarray == false){

     			arrayLoad.push(getdublicateName);

     		}else{
     		console.log('arrayfind',findarray);

     		}

     }else{

     	$("#dublicateName").val(JSON.stringify(dublicateName));


     	 arrayLoad.push(getdublicateName);

     	 console.log('push');


     }*/

    
		
		    /* if(dublicateName ==''){

						      $("#dublicateName").val(vehicle_type);

						    }else{

						      if(vehicle_type == dublicateName){


						       
						        $('#vehicle_type'+srno).val('');
									  $('#source_code'+srno).val('');
									  $('#destination_code'+srno).val('');
									  $('#km'+srno).val('');
									  $('#toll'+srno).val('');
									  $('#extra_km'+srno).val('');
									  $('#less_km'+srno).val('');
									  $('#extra_toll'+srno).val('');

						      }else{

						      var namevehicleType = dublicateName +','+vehicle_type;

						      $("#dublicateName").val(namevehicleType);

						        var explode = dublicateName.split(',');

						       // alert(explode);

						          var lengthdd = explode.length;

						           for (let i = 0; i < lengthdd - 1; i++) {

						              if(vehicle_type == explode[i]){

						                  $('#vehicle_type'+srno).val('');
														  $('#source_code'+srno).val('');
														  $('#destination_code'+srno).val('');
														  $('#km'+srno).val('');
														  $('#toll'+srno).val('');
														  $('#extra_km'+srno).val('');
														  $('#less_km'+srno).val('');
														  $('#extra_toll'+srno).val('');

														  console.log('srno',srno);
						              }
						            
						           }

						      }

						    }*/

	}
</script>

<script type="text/javascript">

	function getRouteDetails(){



		var route_name = $("#route_name").val();
		var loadAvg    = $("#loadAvg").val();
		var emptyAvg   = $("#emptyAvg").val();
		var ulAvg      = $("#ulAvg").val();
	//	var dept_code = $("#dept_code").val();

//alert(dept_code);

		 $.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });

		$.ajax({

		  url:"{{ url('get-vehicle-routes-details') }}",

		   method : "POST",

		   type: "JSON",

		   data: {route_name: route_name},

		   success:function(data){


				var data1 = JSON.parse(data);
				//console.log(data1.km);

				if (data1.response == 'error') {

				   // $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

				}else if(data1.response == 'success'){
					// console.log(data1.data[0]);

					//var overload = data1.data[0].OVERLOAD;

				
					/*if(overload==1){
					  
					  $(".optionsRadios1#option1").prop('checked',true);
					  $(".optionsRadios1#option2").prop('disabled',true);

					}else if(overload==0){

						$(".optionsRadios1#option2").prop('checked',true);
						$(".optionsRadios1#option1").prop('disabled',true);
					}
*/

					//$("#rate").val(data1.data[0].RATE);

					$('#bodyTable').empty();

					var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>VEHICLE</div><div class='box10 texIndbox1'>SOURCE</div><div class='box10 texIndbox1'>DESTINATION</div><div class='box10 texIndbox1'>KMS</div><div class='box10 texIndbox1'>TOLL</div><div class='box10 texIndbox1'>ENAHANCE WEIGHT RATE</div><div class='box10 texIndbox1'>EXTRA KMS</div><div class='box10 texIndbox1'>LESS KMS</div><div class='box10 texIndbox1'>EXTRA TOLL</div></div>";

						$('#bodyTable').append(headtbl);

				   // $('#bodyTable').empty();

						var srno =1;
						var totaldiselcal=0;
					 $.each(data1.data, function(k, getData) {

						if(getData.VEHICLE_TYPE=='fullload'){

							var caldesile =  parseFloat(getData.KM) / parseFloat(loadAvg);
							
						//	$("#fullLoadkm").val(getData.KM);

						}else if(getData.VEHICLE_TYPE=='empty'){

							var caldesile =  parseFloat(getData.KM) / parseFloat(emptyAvg);
							
						}
						else if(getData.VEHICLE_TYPE=='underload'){

							var caldesile =  parseFloat(getData.KM) / parseFloat(ulAvg);

							
						}

						 totaldiselcal += caldesile;

						var tableData = "<div class='box-row'><div class='box10 texIndbox1'>"+getData.VEHICLE_TYPE+"</div><div class='box10 texIndbox1'>"+getData.FROM_PLACE+"</div><div class='box10 texIndbox1'>"+getData.TO_PLACE+"</div><div class='box10 texIndbox1'>"+getData.KM+"</div><input type='hidden' id='kmcal"+srno+"' value='"+caldesile+"' /><div class='box10 texIndbox1'>"+getData.TOLL+"</div><div class='box10 texIndbox1'>"+getData.WEIGHT_RATE+"</div><div class='box10 texIndbox1'>"+getData.EXTRA_KM+"</div><div class='box10 texIndbox1'>"+getData.LESS_KM+"</div><div class='box10 texIndbox1'>"+getData.EXTRA_TOLL+"</div></div>";

						$('#bodyTable').append(tableData);

						srno++;
					});

					 

					/*$("#totalkm").val(data1.km);
					$("#totaldiselcal").val(totaldiselcal);*/

					 $("#IndList1").empty();

					 $.each(data1.expense_data, function(k, getData) {

						$("#IndList1").append($('<option>',{

						  value:getData.FLEETIND,

						  'data-xyz':getData.FLEETIND,
						  text:getData.FLEETIND

						}));

					
				  });


		   }


		}
	 });

	}

</script>

<script type="text/javascript">
	function editable2() {
  var input = document.getElementsByTagName("input")[0];
  var att = document.createAttribute("type");
  att.value = "text";
  input.setAttributeNode(att);
}
</script>
<!-- <script type="text/javascript">

 

  $(".optionsRadios1").on('change',function () { 
	var radio_btn = $(this).val();

   if(radio_btn=='double point'){

   	$("#indicator1").val('DELIVERY CHARGE');
    $("#Amt1").val('500');
    $(".optionsRadios1").prop('disabled', true);

   }else{

   	$("#indicator1").val('');
    $("#Amt1").val('');
   }

	



	
});

</script> -->


<script type="text/javascript">
	$(document).ready(function() {


		   

	  $('#a1').change(function(){
		  var diselexp = $('#a1').val();
		  if(diselexp){
		  $('#diesel_slip_no').val('');
		  $('#diesedl_cr').val('');
		  $( "#diesel_slip_no" ).prop( "disabled", true );
		  $( "#diesedl_cr" ).prop( "disabled", true );

		  $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
		  $('#hidesubmitbtn').prop( "disabled", true );

		}else{
			$( "#diesel_slip_no" ).prop( "disabled", false );
		  $( "#diesedl_cr" ).prop( "disabled", false );
		}
	  });

	  $('#diesedl_cr').on('input',function(){
		$('#enterslipnomsg').html('');
		  var diselcr = $('#diesedl_cr').val();
		  
		  if(diselcr){
			$('#a1').prop( "disabled", true );
			$('#enterslipnomsg').html('Diesel Slip No Is Required').css('color','red');
			$('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
			$( "#hidesubmitbtn" ).prop( "disabled", true );
			return true;
		  }else{
			 $('#a1').prop( "disabled", false );
			$('#enterslipnomsg').html('');
			$('#filerrormsg').html('');
			return false;
		  }
	  });

	  $('#diesel_slip_no').on('input',function(){
	   var diesel_slip_no =  $('#diesel_slip_no').val();
		  if(diesel_slip_no){
			$('#enterslipnomsg').html('');
		   // $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
		   
		  }else{
			$('#enterslipnomsg').html('Diesel Slip No Is Required').css('color','red');
			$('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
		   // $( "#hidesubmitbtn" ).prop( "disabled", true );
		  }
	  });

	  $('#diesel_slip_no').change(function(){
		 var diselslipno = $('#diesel_slip_no').val();

		 var driver_exp = $('#a2').val();
		 var fooding_exp = $('#a4').val();
		 var admin_exp = $('#a3').val();
		 var uloading_exp = $('#a5').val();
		 var toll_exp = $('#a6').val();
		 var other_exp = $('#a7').val();
		 var total_adv = parseInt(driver_exp)+parseInt(fooding_exp)+parseInt(admin_exp)+parseInt(uloading_exp)+parseInt(toll_exp)+parseInt(other_exp);

		// console.log(total_adv);

		 if(diselslipno){
		  $('#a1').val('');
		  $('#TOTAL').val(total_adv);
		 }

	  });


	  $('#diesel_qty').on('input',function(){
		  var dieselQty = $(this).val();
		  if(dieselQty){

		  $('#hidesubmitbtn').prop( "disabled", false );
		  $('#filerrormsg').html('');
		}else{
		  $('#hidesubmitbtn').prop( "disabled", true );
		}
	  });

	  $('#invoice_no').on('input',function(){
		  var invoice_no = $(this).val();
		if(invoice_no){

		   $('#invoice_no').css('border-color','#d2d6de').focus();
			document.getElementById("invcErr").innerHTML = '';
		   $('#trip_no').css('border-color','#ff0000');
		   $('#trip_no').prop('readonly',false);
		
		}else{
		 
		 $('#invoice_no').css('border-color','#ff0000').focus();
		 document.getElementById("invcErr").innerHTML = 'The invoice no filed is required';
		 $('#trip_no').css('border-color','#d2d6de').focus();
		 $('#trip_no').prop('readonly',true);
		}
	  });



	  $('#trip_no').on('change',function(){


		  var val = $(this).val();

		  var xyz = $('#tripList option').filter(function() {

		  return this.value == val;

		  }).data('xyz');

		  var msg = xyz ?  xyz : 'No Match';


		 // document.getElementById("depotText").innerHTML = msg; 

		  if(msg=='No Match'){

			 $(this).val('');
		
		 $('#trip_type').css('border-color','#ff0000').focus();
		 document.getElementById("tripErr").innerHTML = 'The trip no filed is required';
		 $('#trip_type').css('border-color','#d2d6de').focus();
		 $('#vehicle_no,#series_code').prop('readonly',false);
		 $('#vehicle_no,#series_code,#seriesName,#Plant_code,#plantname,#profitctrId,#pfctName,#customer_code,#customer_name,#from_place,#to_place,#vehicle_inward_no,#model,#loadcpct,#loadAvg,#ulcpct,#ulAvg,#emptyAvg,#driver_name,#route_code,#route_name,#owner_type,#transporter_code,#transporter_name').val('');

		 $('#itemTable').empty();
		 $('#totalqty').empty();
     $('#bodyTable').empty();

		  }else{

			  $('#trip_no').css('border-color','#d2d6de').focus();
			  document.getElementById("tripErr").innerHTML = '';
		    $('#trip_type').css('border-color','#ff0000');
		    $('#vehicle_no,#series_code').prop('readonly',true);
		  }

		
	  });


	    $("#vehicle_no").on('change', function () {  

		  var val = $(this).val();

		  var xyz = $('#truckList option').filter(function() {

		  return this.value == val;

		  }).data('xyz');

		  var msg = xyz ?  xyz : 'No Match';

		  //alert(msg+xyz);

		 

		  if(msg=='No Match'){

			 $(this).val('');

			 document.getElementById("vehicleErr").innerHTML = 'The vehicle no filed is required';
			
					$('#vehicle_no').css('border-color','#ff0000').focus();
					$('#trip_type').css('border-color','#d2d6de').focus();
					$('#trip_type').prop('readonly',true);

					$('#trip_no,#series_code,#seriesName,#Plant_code,#plantname,#profitctrId,#pfctName,#customer_code,#customer_name,#from_place,#to_place,#vehicle_inward_no,#model,#loadcpct,#loadAvg,#ulcpct,#ulAvg,#emptyAvg,#driver_name,#route_code,#route_name,#owner_type,#transporter_code,#transporter_name').val('');

					$('#itemTable').empty();
					$('#totalqty').empty();
					$('#bodyTable').empty();


					

			  }else{

			  document.getElementById("vehicleErr").innerHTML = '';
				$('#vehicle_no').css('border-color','#d2d6de').focus();
				$('#trip_type').css('border-color','#ff0000').focus();
				$('#trip_type').prop('readonly',false);
				$('#invcErr').html('');
			  }

		});

	 

	  $('#trip_type').on('change',function(){

		  var trip_type = $(this).val();

		if(trip_type){

		 
			document.getElementById("tripTypeErr").innerHTML = '';
		   $('#trip_type').css('border-color','#d2d6de').focus();
		 //  $('#trip_type').prop('readonly',true);
		
		}else{
		 
		
		 document.getElementById("tripTypeErr").innerHTML = 'The trip type filed is required';

		  $('#trip_type').css('border-color','#ff0000');
		  // $('#trip_type').prop('readonly',false);
		
		}
	  });

	  $('#shipment_no').on('input',function(){
		  var shipment_no = $(this).val();
		if(shipment_no){

		   $('#shipment_no').css('border-color','#d2d6de').focus();
			document.getElementById("shipmentErr").innerHTML = '';
		   $('#vehicle_inward_no').css('border-color','#ff0000');
		   $('#vehicle_inward_no').prop('readonly',false);
		
		}else{
		 
		 $('#shipment_no').css('border-color','#ff0000').focus();
		  document.getElementById("shipmentErr").innerHTML = 'The shipment no field required';
		 $('#vehicle_inward_no').css('border-color','#d2d6de').focus();
		 $('#vehicle_inward_no').prop('readonly',true);
		}
	  });

	  $('#lr_no').on('input',function(){
		  var lr_no = $(this).val();
		if(lr_no){

		   $('#lr_no').css('border-color','#d2d6de').focus();
		   $('#vehicle_inward_no').css('border-color','#ff0000');
		   $('#vehicle_inward_no').prop('readonly',false);
		
		}else{
		 
		 $('#lr_no').css('border-color','#ff0000').focus();
		 $('#vehicle_inward_no').css('border-color','#d2d6de').focus();
		 $('#vehicle_inward_no').prop('readonly',true);
		}
	  });

	   $('#driver_name').on('input',function(){
		  var driver_name = $(this).val();
		if(driver_name){

		   $('#driver_name').css('border-color','#d2d6de').focus();
		   $('#item_code').css('border-color','#ff0000');
		   $('#item_code').prop('readonly',false);
		
		}else{
		 
		 $('#driver_name').css('border-color','#ff0000').focus();
		 $('#item_code').css('border-color','#d2d6de').focus();
		 $('#item_code').prop('readonly',true);
		}
	  });

	   $('#stoqtyum').on('input',function(){
		  var stoqtyum = $(this).val();
		if(stoqtyum){

		   $('#stoqtyum').css('border-color','#d2d6de').focus();
		  
		
		}else{
		 
		 $('#stoqtyum').css('border-color','#ff0000').focus();
		 
		}
	  });


	   /*dubliation name*/

	  

	   /*dubliation name*/


	

	  $("#item_code").bind('change', function () {  

		  var val = $(this).val();

		  var xyz = $('#itemList option').filter(function() {

		  return this.value == val;

		  }).data('xyz');

		  var msg = xyz ?  xyz : 'No Match';

		  //alert(msg+xyz);

		  document.getElementById("itemText").innerHTML = msg; 

		  if(msg=='No Match'){

			 $(this).val('');
			 document.getElementById("itemText").innerHTML = '';
			 document.getElementById("itemErr").innerHTML = 'The item code field is required';
			 $('#item_code').css('border-color','#ff0000').focus();
			  $('#stoqtyum').css('border-color','#d2d6de').focus();
			  $('#stoqtyum').prop('readonly',true);

			   $('#stoUM').val('');
				$('#stoAum').val('');
			  $('#cfator').val('');

		  }else{
			$('#item_code').css('border-color','#d2d6de').focus();
			document.getElementById("itemErr").innerHTML = '';

			$('#stoqtyum').css('border-color','#ff0000').focus();
			$('#stoqtyum').prop('readonly',false);
		  }

		});



		$("#vehicle_type").bind('change', function () {  

		  var val = $(this).val();

		  var xyz = $('#wheelList option').filter(function() {

		  return this.value == val;

		  }).data('xyz');

		  var msg = xyz ?  xyz : 'No Match';

	

		  if(msg=='No Match'){

			 $(this).val('');
			
			 $('#vehicle_type').css('border-color','#ff0000').focus();
			  $('#driver_name').css('border-color','#d2d6de').focus();
			  $('#driver_name').prop('readonly',true);

		  }else{
			$('#vehicle_type').css('border-color','#d2d6de').focus();
			$('#driver_name').css('border-color','#ff0000').focus();
			$('#driver_name').prop('readonly',false);
		  }

		});

		

	  $("#item_code").change(function(){

		 $.ajaxSetup({

		  headers: {

			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

		  }

		 });

		var item_code =  $(this).val();

		var itemCode = item_code.split("-");

		var itemcode = itemCode[0];

		$.ajax({

		  url:"{{ url('item-um-aum') }}",

		   method : "POST",

		   type: "JSON",

		   data: {itemcode: itemcode},

		   success:function(data){

			
				var data1 = JSON.parse(data);

				if (data1.response == 'error') {

					$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
					$('#stoUM').val('');
					$('#stoAum').val('');
					$('#cfator').val('');

				}else if(data1.response == 'success'){
					// console.log(data1.data[0]);
					$('#stoUM').val(data1.data[0].UM_CODE);
					$('#stoAum').val(data1.data[0].AUM_CODE);
					$('#cfator').val(data1.data[0].AUM_FACTOR);      
				}else{

					$('#stoUM').val('');
					$('#stoAum').val('');
					$('#cfator').val('');

				}
		   }

		});

	  });



	  

	   $('.Number').keypress(function (event) {
	  var keycode = event.which;
	  if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
		  event.preventDefault();
	  }
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

  $(".delete").on('click', function() {


	  var rowCount = $('#tbledata tr').length;


	  var whenitmselect = $('#dubindicatoraddmore').val();
        var splt_arrayOne = whenitmselect.split(',');
        var whenitmcheck = $('#indidubName').val();
        var splt_arrayTwo = whenitmcheck.split(',');


				splt_arrayOne = splt_arrayOne.filter(function(val) {
            return splt_arrayTwo.indexOf(val) == -1;
        });
         
        splt_arrayTwo = splt_arrayTwo.filter(val => !splt_arrayTwo.includes(val));
        $('#dubindicatoraddmore').val(splt_arrayOne);

        splt_arrayTwo = splt_arrayTwo.filter(function(val) {
            return splt_arrayOne.indexOf(val) == -1;
        });
         
        splt_arrayOne = splt_arrayOne.filter(val => !splt_arrayOne.includes(val));
        $('#indidubName').val(splt_arrayOne);



	  
	  console.log('rowCount',rowCount);
	  if(rowCount == 2){
		 $('#submitdata').prop('disabled',true);
	  }

	  $('.case:checkbox:checked').parents("tr").remove();

	  $('.check_all').prop("checked", false); 

	  quantity =0;
	   $(".quantityC").each(function () {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				quantity += parseFloat(this.value);
			}

		  $("#basicTotal").val(quantity.toFixed(2));

		});


	      var btotal =0;

					$(".basicamt").each(function () {
					   
					  if (!isNaN(this.value) && this.value.length != 0) {
						  btotal += parseFloat(this.value);
					  }

					$(".bTotal").html(btotal.toFixed(2));

				  });



	   var dataCl =0;
		 $(".quaPcountrow").each(function () {
			//add only if the value is number
			if (!isNaN(this.value) && this.value.length != 0) {
				dataCl += parseFloat(this.value);
			}

		  $("#allquaPcount").val(dataCl);

		});


	  check();

  }); /*--function close--*/


  var f=2;

  var row_i=1;

  $(".addmore").on('click',function(){


	  count=$('table tr').length;



	 var data ="<tr class='useful'><td class='tdthtablebordr' style='text-align:center;'><input type='checkbox' class='case' id='firstrow"+f+"' onclick='checkcheckboxaddmore("+f+")' /><span id='snum"+f+"'></span> </td><td class='tdthtablebordr' style='width: 25px;text-align:center;'><div class='input-group'><input list='IndList"+f+"' class='inputboxclr SetInCenter' style='width: 105px;line-height: 0.1;margin-left:4px;' id='indicator"+f+"' name='indicator[]' onchange='getIndDetails("+f+")'/><datalist id='IndList"+f+"'></datalist></div></td><td class='tdthtablebordr tooltips' style='text-align:center;'><input type='text' class='inputboxclr getAccNAme' style='width: 100px;line-height: 0.1;' id='gl_code"+f+"' name='gl_code[]'/><input type='hidden' class='inputboxclr getAccNAme' style='width: 100px;line-height: 0.1;' id='gl_name"+f+"' name='gl_name[]'/><small class='tooltiptextitem tooltiphide' id='itemNameTooltip1'></small></td><td class='tdthtablebordr' style='text-align:center;'><div style='display: inline-flex;border: none;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate basicamt' oninput='getAmount("+f+")'  id='Amt"+f+"' name='Amt[]' style='width: 100px;line-height: 0.1;text-align:right;'/></div><div><small id='errmsgqty"+f+"'></small></div><input type='hidden' value='' id='othercompAmt"+f+"' name='othercompAmt[]'/></td></tr>";

	  $('table').append(data);


 

	 /*expense data*/

	   var totalkm       = $("#totalkm").val();
			

		 $.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });

		 $.ajax({

		  url:"{{ url('get-vehicle-expense-data-by-km') }}",

		   method : "POST",

		   type: "JSON",

		   data: {totalkm: totalkm},

		   success:function(data){

		   //	console.log(data);return false;

		   	var data1 = JSON.parse(data);
				

				if (data1.response == 'error') {

				   

				}else if(data1.response == 'success'){

					console.log('sd',i);
						
					  $.each(data1.lrexp_data, function(k, getLrData) {

							 		$("#IndList"+row_i).append($('<option>',{

								  value:getLrData.LRIND_NAME,

								  'data-xyz':getLrData.LRIND_NAME,
								  text:getLrData.LRIND_NAME

								}));

					 });


		   }
		 }

		 });
	 /*expense data*/
		 f++;
		 row_i++;
  });  /*--function close--*/

  function select_all() {

	$('input[class=case]:checkbox').each(function(){ 

	  if($('input[class=check_all]:checkbox:checked').length == 0){ 

		$(this).prop("checked", false); 

	  }else{

		$(this).prop("checked", true); 

	  } 

	});
  }

  function check(){

	obj = $('table tr').find('span');
	 // console.log('obj',obj);
	if(obj.length==0){
	  $('#basicTotal').val(0.00);
	  $('#submitdata').prop('disabled',true);
	  $('#submitdata').prop('disabled',true);
	 // $('#bTotal').html(0.00);



	}else{
	  $.each( obj, function( key, value ) {

		  id= value.id;

		  //$('#'+id).html(key+1);

	  });
	}
  }


</script>


<script type="text/javascript">
  
  function getWheelInd(wheelType){

  //  alert(wheelType);return false;

	   $.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });


	   $.ajax({

		  url:"{{ url('get-wheelType-details') }}",

		   method : "POST",

		   type: "JSON",

		   data: {wheelType: wheelType},

		   success:function(data){

			  console.log(data);

				var data1 = JSON.parse(data);

				if (data1.response == 'error') {

					$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

				}else if(data1.response == 'success'){
					// console.log(data1.data[0]);
				   // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);
					  
					 $.each(data1.data, function(k, getData) {

						 var num = 1;
					 
						$("#IndList"+num).append($('<option>',{

						  value:getData.FLEETIND,

						  'data-xyz':getData.FLEETIND,
						  text:getData.FLEETIND

						}));

						num++;
					
				  });


		   }


		}
	 });



  }
</script>

<script type="text/javascript">
	
	function getToPlace(num){

		var from_place = $("#from_place").val();
		var to_place   = $("#to_place").val();
		var vehicle_type = $("#vehicle_type"+num).val();
		//var to_place = $("#to_place").val();

		if(vehicle_type=='fullload'){

			var destination_name   = '';

			$("#source_code"+num).val(from_place);

		}else{

			var srno = num - 1;
		    var destination_name = $("#destination_code"+srno).val();

			$("#source_code"+num).val(destination_name);
		}


		$.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });


	   $.ajax({

		  url:"{{ url('get-toplace-from-route') }}",

		   method : "POST",

		   type: "JSON",

		   data: {from_place:from_place,to_place:to_place,destination_name:destination_name},

		   success:function(data){

			 // console.log(data);

				var data1 = JSON.parse(data);

				if (data1.response == 'error') {

					$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

				}else if(data1.response == 'success'){
					// console.log(data1.data[0]);
				   // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);
				
				if(vehicle_type=='fullload'){

				   	if(data1.from_data=='' || data1.from_data==null){


				   	}else{

				   		     $("#toplaceList"+num).empty();
					  
							  $.each(data1.from_data, function(k, getData) {

							 
								$("#toplaceList"+num).append($('<option>',{

								  value:getData.TO_PLACE,

								  'data-xyz':getData.TO_PLACE,
								  text:getData.TO_PLACE

								}));
							
						  	});


				   	}

				   }else{

				   	if(data1.to_data=='' || data1.to_data==null){

				   			alert('DESTINATION NOT AVILBLE');
				   	}else{

				   		     $("#toplaceList"+num).empty();
					  
							  $.each(data1.to_data, function(k, getData) {

							 
								$("#toplaceList"+num).append($('<option>',{

								  value:getData.TO_PLACE,

								  'data-xyz':getData.TO_PLACE,
								  text:getData.TO_PLACE

								}));
							
						  	});


				   	}
				   }



				   	
					


		   }


		}
	 });

	}

</script>

<script type="text/javascript">
  
  function getIndDetails(num){

  //  alert(wheelType);return false;
		var indicator     = $("#indicator"+num).val();
		var totalkm       = $("#totalkm").val();
		var totaldiselcal = $("#totaldiselcal").val();
		var diesel_rate   = $("#diesel_rate").val();
		var ulcpct        = $("#ulcpct").val();
		//var itemqty       = $("#itemqtytotal").val();
        var itemqty       = $("#freight_qty").val();
		var kmcal         = $("#fullLoadkm").val();
		var dubindicator  = $("#dubindicator").val();
		var dubindicatoraddmore = $("#dubindicatoraddmore").val();
        var toll          = $("#totaltoll").val();
	    var extratoll     = $("#totalextratoll").val();


	                 if(dubindicatoraddmore ==''){

						      $("#dubindicatoraddmore").val(indicator);

						    }else{

						      if(indicator == dubindicatoraddmore){
						       
					             $("#indicator"+num).val('');
								  
								 $("#dubindaddMsg").html('Dublicate Indicator Type').css('color','red');

						      }else{

						      var indicatorNew = dubindicatoraddmore +','+indicator;

						      $("#dubindicatoraddmore").val(indicatorNew);

						        var explode = indicatorNew.split(',');

						       // alert(explode);

						          var lengthdd = explode.length;

						           for (let i = 0; i < lengthdd - 1; i++) {

						              if(indicator == explode[i]){

						                 $("#indicator"+num).val('');

						                 $("#dubindaddMsg").html('Dublicate Indicator Type').css('color','red');
						              }else{

						              	$("#dubindaddMsg").html('');
						              }
						            
						           }

						      }

						}




		var ele = document.getElementsByName('point_delivery');
              
            for(i = 0; i < ele.length; i++) {
                if(ele[i].checked){

                	var delivery_value = ele[i].value;
                	
                }else{

                }
                
            }


       /* var nameindicator = dubindicator1 +','+indicator;

        $("#dubindicator").val(nameindicator);

        var dubindicator   = $("#dubindicator").val();*/


		var explode = dubindicator.split(',');

		var lengthdd = explode.length;

				//var ind_array = [];

				for (let i = 0; i < lengthdd - 1; i++) {

					if(indicator == explode[i]){

						                 
						$("#indicator"+num).val('');

						$("#dubindMsg").html('Dublicate Indicator Type').css('color','red');
							
				    }else{

				    	$("#dubindMsg").html('');	
				    }
						            
				}

	//	alert(num);

		if(indicator){

			$("#vehicle_type"+num).prop('readonly',true);
			//$("#extra_toll"+num).prop('readonly',true);

		}else{

			$("#vehicle_type"+num).prop('readonly',false);
		//	$("#extra_toll"+num).prop('readonly',false);

			$("#Amt"+num).val('');
			$("#gl_code"+num).val('');
			$("#gl_name"+num).val('');
		}

			var indicator2     = $("#indicator"+num).val();

			if(indicator2){



	   $.ajaxSetup({
		  headers: {
			  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		  }
		 });


	   $.ajax({

		  url:"{{ url('get-Indicator-details') }}",

		   method : "POST",

		   type: "JSON",

		   data: {indicator:indicator,totalkm:totalkm},

		   success:function(data){

	   
				var data1 = JSON.parse(data);

				if (data1.response == 'error') {

					$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

				}else if(data1.response == 'success'){
				   // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);
						


				   if(indicator=='DIESEL'){

					  var deiselCal = parseFloat(totaldiselcal) * parseFloat(diesel_rate);

						$("#Amt"+num).val(deiselCal.toFixed(2));
						$("#gl_code"+num).val(data1.data[0].GL_CODE);
						$("#gl_name"+num).val(data1.data[0].GL_NAME);

					  }else{

						 $("#gl_code"+num).val(data1.data[0].GL_CODE);
						 $("#gl_name"+num).val(data1.data[0].GL_NAME);
						 //$("#Amt"+num).val(data1.data[0].RATE);

					  }

					  if(indicator=='OVERLOAD ALLOWANCE'){

					   var qty  =  parseFloat(itemqty) - parseFloat(ulcpct);

					  	if(isNaN(qty)){

					  		var totalqty = 0.00;

					  	}else{

					  		var weight_rate =  data1.data[0].RATE;

					  		if(weight_rate){

					  			var calqty = parseFloat(qty) * parseFloat(weight_rate);
					  		}else{
					  			var calqty = parseFloat(qty);
					  		}

					  		

					  		// var calqty = qty * 0.6;

					      var totalqty = parseFloat(calqty) * parseFloat(kmcal);

					  	}

					  	$("#Amt"+num).val(totalqty.toFixed(2));
					  	$("#gl_code"+num).val(data1.data[0].GL_CODE);
					  	$("#gl_name"+num).val(data1.data[0].GL_NAME);


					 

					  }


					  if(indicator=='DELIVERY CHARGE'){

					  		if(delivery_value=='double point'){

					  			
					  			$("#Amt"+num).val(500);

					  		}else{

					  			$("#Amt"+num).val(0.00);
					  		}
					  	}

					  if(indicator=='TOLL'){

					  	var amount = toll;

					  	 $("#Amt"+num).val(amount);

					  }

                      if(indicator=='EXTRA TOLL'){

                        var amount = extratoll;

                        $("#Amt"+num).val(amount);

                      }

                      if(indicator=='ON ACCOUNT'){

                      	  $("#emp_code"+num).css('display','block');

                          console.log('emp_data',data1.emp_data);
                          $.each(data1.emp_data, function(k, getData) {

					     $("#empList"+num).append($('<option>',{

						  value:getData.ACC_CODE,

						  'data-xyz':getData.ACC_CODE,
						  text:getData.ACC_CODE+''+getData.ACC_NAME

						}));

					    });
                        

                      }


					  $("#gl_code"+num).val(data1.data[0].GL_CODE);
					  $("#gl_name"+num).val(data1.data[0].GL_NAME);
	
				   

					var btotal =0;

					$(".basicamt").each(function () {
					   
					  if (!isNaN(this.value) && this.value.length != 0) {
						  btotal += parseFloat(this.value);
					  }

					  

					$(".bTotal").html(btotal.toFixed(2));

				  });

			   
					  
		   }


		}
	 });

}

  }
</script>
<script type="text/javascript">
  
  function getvrnoBySeries(){

	var seriesCode = $('#series_code').val();
	var transcode = $('#transcode').val();

   //alert(transcode);

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

		  //  alert(data1.vrno_series.LAST_NO);

			  if (data1.response == 'error') {

				$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

			  }else if(data1.response == 'success'){

				  if(data1.vrno_series == ''){

				  }else{
					if(data1.vrno_series){
					  var getlastno = data1.vrno_series.LAST_NO;
					}else{
					  var getlastno = '';
					}

					if(data1.vrnodata == ''){

					  $('#vrseqnum').val(getlastno);
					  $('#getVrNo').val(getlastno);
					}else{
					  var lastNo = parseInt(getlastno) + parseInt(1);
					  $('#vrseqnum').val(lastNo);
					  $('#getVrNo').val(lastNo);
					}
				  }

			  }

		  }

	});

}
</script>

<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;

    $("#addButton").click(function () {
                
	    if(counter>10){
	            alert("Only 10 textboxes allow");
	            return false;
	    }   
        
  		var newTextBoxDiv = $(document.createElement('div'))
         .attr("class", 'rowcount' + counter);

        	

    getcount=$('.divTableBody .trrowget').length;

    var newrow = '<div class="divTableRow rowcount TextBoxesGroup_'+counter+' trrowget"><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="checkbox" class="casecheck" id="tablesecnd'+counter+'" onclick="checkcheckbox('+counter+');"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><span id="snumtwo'+counter+'">'+getcount+'.</span><input type="hidden" class="rowCountRoute" name="rowCountRoute[]" id="" value="'+counter+'"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input list="vehicleList'+counter+'"  id="vehicle_type'+counter+'"  style="width: 103px;text-transform:uppercase;" onchange="getToPlace('+counter+')" name="vehicle_type[]" autocomplete="off"><datalist id="vehicleList'+counter+'"><option value="fullload" data-xyz="fullload">FULLLOAD</option><option value="empty" data-xyz="empty">EMPTY</option></datalist></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'" class="tooltips"><input list="fromList'+counter+'" id="source_code'+counter+'" value="" name="source_code[]"  onchange="getToPlace('+counter+')"   style="width: 100px;"><datalist id="fromList'+counter+'"><?php foreach($from_place_list as $key) { ?><option value="<?= $key->FROM_PLACE ?>" data-xyz="<?= $key->FROM_PLACE ?>"><?= $key->FROM_PLACE ?></option><?php } ?></datalist><small class="tooltiptext tooltiphide" id="accountNameTooltip'+counter+'"></small></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input list="toplaceList'+counter+'"  id="destination_code'+counter+'" value="" name="destination_code[]" onchange="getRoute('+counter+')"  style="width: 100px;" autocomplete="off"><datalist id="toplaceList'+counter+'"></datalist></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="text" id="km'+counter+'" class="getkmtotal" value="" name="km[]" style="width: 80px;text-align: right;" maxlength="10"><input type="hidden" class="getdiesel" id="diesel'+counter+'" value="" name="diesel[]" style="width: 100px;" maxlength="10"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="textbox" class="allToll" id="toll'+counter+'" value="" name="toll[]" style="width: 80px;text-align: right;" maxlength="10"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1"><input type="textbox" class="getweight_rate" id="weight_rate'+counter+'"  value="" name="weight_rate[]" style="width: 100px;text-align: right;" maxlength="10" readonly=""></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="textbox" id="extra_km'+counter+'" value="" name="extra_km[]" style="width: 80px;text-align: right;" maxlength="10"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="textbox" id="less_km'+counter+'" value="" name="less_km[]" style="width: 80px;text-align: right;" maxlength="10"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="textbox"  class="allExtraToll" id="extra_toll'+counter+'" value="" oninput="extraToll('+counter+')" name="extra_toll[]" style="width: 80px;text-align: right;" maxlength="10"></div></div></div></div>';



    //newTextBoxDiv.after().html(newrow);
            
    $(".divTableBody").append(newrow);


    

	  var planNo = $("#trip_no").val();

	  var plan_no = planNo.split(" ");
	  
	  var palnno = plan_no[2];

	 


	  $.ajaxSetup({

			  headers: {

				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

			  }
	  });

	 /* $.ajax({

			url:"{{ url('/get-vehicle-plan-details') }}",

			method : "POST",

			type: "JSON",

			data: {planNo: planNo},

			success:function(data){


			  var data1 = JSON.parse(data);
			  //console.log(data);

				if (data1.response == 'error') {

				  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

				}else if(data1.response == 'success'){
				  if(data1.data==''){
					 $("#acc_code").val('');
					 $("#acc_name").val('');
					 $("#vehicle_no").val('');
					 $("#from_place").val('');
					 $("#to_place").val('');
					

				  }else{

						

					 $.each(data1.route_data, function(k, getData) {

							$("#vehicleList"+getcount).append($('<option>',{

						  value:getData.VEHICLE_TYPE,

						  'data-xyz':getData.VEHICLE_TYPE,
						  text:getData.VEHICLE_TYPE

						}));

							$("#fromList"+getcount).append($('<option>',{

						  value:getData.FROM_PLACE,

						  'data-xyz':getData.FROM_PLACE,
						  text:getData.FROM_PLACE

						}));


						


						
					});

					


				   
				  }
				}

			}

		  });*/


  

                
    counter++;
     });


	


     /*$("#removeButton").click(function () {
    var count2 = counter - 1;
       console.log(count2);

    if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
    counter--;
            
        $(".TextBoxesGroup_"+count2).remove();
            
     });*/
     $(".removeBtntbl").on('click', function() {


        $('.casecheck:checkbox:checked').parents(".trrowget").remove();
        //console.log('yes');

        var whenitmselect = $('#dublicateName').val();
        var splt_arrayOne = whenitmselect.split(',');
        var whenitmcheck = $('#deletedubName').val();
        var splt_arrayTwo = whenitmcheck.split(',');


				splt_arrayOne = splt_arrayOne.filter(function(val) {
            return splt_arrayTwo.indexOf(val) == -1;
        });
         
        splt_arrayTwo = splt_arrayTwo.filter(val => !splt_arrayTwo.includes(val));
        $('#dublicateName').val(splt_arrayOne);

        splt_arrayTwo = splt_arrayTwo.filter(function(val) {
            return splt_arrayOne.indexOf(val) == -1;
        });
         
        splt_arrayOne = splt_arrayOne.filter(val => !splt_arrayOne.includes(val));
        $('#deletedubName').val(splt_arrayOne);


                      gr_amt =0;
                          $(".getkmtotal").each(function () {
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  gr_amt += parseFloat(this.value);

                              }
                            $("#totalkm").val(gr_amt.toFixed(3));
                          });

                         //var allGrandAmount = parseFloat($('#totalkm').val());

                     diesel_amt =0;
                         $(".getdiesel").each(function () {
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  diesel_amt += parseFloat(this.value);   
                              }

                            $("#totaldiselcal").val(diesel_amt.toFixed(3));

                          });

                  // var allGrandAmount = parseFloat($('#totaldiselcal').val());

									   alltoll =0;
                         $(".allToll").each(function () {
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  alltoll += parseFloat(this.value);

                              }
                            $("#totaltoll").val(alltoll.toFixed(3));
                          });

                       allextratoll =0;
                        $(".allExtraToll").each(function () {
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  allextratoll += parseFloat(this.value);

                              }
                            $("#totalextratoll").val(allextratoll.toFixed(3));
                          });

        checksectbl();
     });

     function checksectbl(){

    obj = $('.divTableRow .TextBoxesGroup').find('span'); 



    objfirst = $('table tr').find('span'); 


    if(obj.length==0){
      
      $('#submitdata').prop('disabled',true);
      $('#submitNDwn').prop('disabled',true);
      $('#expenseid').prop('disabled',true);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;
         

          $('#'+id).html(key+1);

      });
    } 
      
  }

        
     $("#getButtonValue").click(function () {
        
    var msg = '';
    for(i=1; i<counter; i++){
      msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
    }
        alert(msg);
     });
  });
</script>


<script type="text/javascript">

	function checkcheckbox(checkid){

			var load_type = $('#vehicle_type'+checkid).val();
		 	var from_place = $('#source_code'+checkid).val();
		 	var to_place = $('#destination_code'+checkid).val();

		 	var dublicateName = load_type+'_'+from_place+'_'+to_place;

		 			
					 if($('#tablesecnd'+checkid).is(':checked')) {

					 		var delArry = $("#deletedubName").val();

					 		if(delArry==''){

					 			$("#deletedubName").val(dublicateName);

					 		}else{

										  var getPrevVal = $("#deletedubName").val();

											$("#deletedubName").val(getPrevVal+','+dublicateName);

					 		}

    			}else{

    				var itmafterUncheck = $('#deletedubName').val();
           
          var explodIUnChckTm = itmafterUncheck.split(',');


          const index = explodIUnChckTm.indexOf(dublicateName);
          if (index > -1) {
            explodIUnChckTm.splice(index, 1);
          }

            $('#deletedubName').val(explodIUnChckTm);
    			}

	}


	function checkcheckboxaddmore(checkid){

			var indtype = $('#indicator'+checkid).val();



		 			
					 if($('#firstrow'+checkid).is(':checked')) {

					 		var delArry = $("#indidubName").val();



					 		if(delArry==''){

					 			$("#indidubName").val(indtype);

					 		}else{

										var getPrevVal = $("#indidubName").val();

									$("#indidubName").val(getPrevVal+','+indtype);

					 		}

    			}else{

    				   var itmafterUncheck = $('#indidubName').val();
           
			          var explodIUnChckTm = itmafterUncheck.split(',');


			          const index = explodIUnChckTm.indexOf(indtype);
			          if (index > -1) {
			            explodIUnChckTm.splice(index, 1);
			          }

			            $('#indidubName').val(explodIUnChckTm);
			    	}

	}

	

</script>



<script type="text/javascript">

 function submitAllData(valD){

 	var downloadFlg = valD;

    $('#donwloadStatus').val(downloadFlg);

    $("#submitdata").prop('disabled',true);
    $("#submitNDown").prop('disabled',true);


      var trcount=$('table tr').length;



          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          console.log(data);

        //  return false;

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/Transaction/Logistic/Save-Trip-Expense'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                 var data1 = JSON.parse(data);

                 console.log(data);

               if(data1.response=='error'){
                  var responseVar =false;

                    var url = "{{ url('/Transaction/View-Trip-Expense-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar =true;
                  if(downloadFlg == 1){
                      var fyYear   = data1.data[0].FY_CODE;
                      var fyCd     = fyYear.split('-');
                      var seriesCd = data1.data[0].SERIES_CODE;
                      var vrNo     = data1.data[0].VRNO;
                      var fileN    = 'TRIPEXP_'+fyCd[0]+''+seriesCd+''+vrNo;
                      var link = document.createElement('a');
                      link.href = data1.url;
                      link.download = fileN+'.pdf';
                      link.dispatchEvent(new MouseEvent('click'));
                  }
                  var url = "{{ url('/Transaction/View-Trip-Expense-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }

              },

          });
      
  }


       
</script>

<script type="text/javascript">
	function getRefTripData(){

		var ref_trip_no = $("#ref_trip_no").val();
            var itemqtytotal = $("#itemqtytotal").val();
            var tripHid = $("#tripHid").val();

		var splitRefNo = ref_trip_no.split("~");

		var RefTripNo = splitRefNo[0];
		var RefTripHid = splitRefNo[1];

		 $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });


		  $.ajax({

              type: 'POST',

              url: "<?php echo url('/get-ref-qty-for-ref-trip-no'); ?>",

              data: { RefTripNo:RefTripNo,RefTripHid:RefTripHid,tripHid:tripHid}, // here $(this) refers to the ajax object not form

              success: function (data) {

                 var data1 = JSON.parse(data);

                 console.log(data);

               if(data1.response=='error'){
                 

                }else{

                  if(data1.alldata=='' || data1.alldata==null){

                  }else{

                     $('#itemTable').empty();
                      $('#totalqty').empty();

                     var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DO DATE</div><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>ITEM NAME</div><div class='box10 texIndbox1'>QTY</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>LR DATE</div></div>";

                     $('#itemTable').append(headtbl);

                        var srn =1;
                        var totalqty = 0;
                     $.each(data1.alldata, function(k, getData) {

                         totalqty += parseFloat(getData.QTY);
                        
                      var tableData = "<div class='box-row'><div class='box10 texIndbox1'>"+getData.DO_NO+"</div><div class='box10 texIndbox1'>"+getData.DO_DATE+"</div><div class='box10 texIndbox1'>"+getData.ITEM_CODE+"</div><div class='box10 texIndbox1'>"+getData.ITEM_NAME+"</div><div class='box10 texIndbox1'>"+getData.QTY+"</div><input type='hidden' value='"+getData.QTY+"' id='itemqty"+srn+"'/><div class='box10 texIndbox1'>"+getData.LR_NO+"</div><div class='box10 texIndbox1'>"+getData.LR_DATE+"</div></div>";

                        $('#itemTable').append(tableData);

                        srn++;

                  });


                     var  qty_total = "<div class='totlsetinres box-row'>Total : <input type='text' value='"+totalqty.toFixed(3)+"' style='padding: 0px;width: 85px;text-align: right;line-height: 1.1;' id='itemqtytotal' readonly/></div>";
                    
                        $('#totalqty').append(qty_total);


                  }

                 	if(data1.data=='' || data1.data==null){


                 	}else{

                 		var freightQty = data1.data[0].FREIGHT_QTY;

                 		if(freightQty){

                              var freightQty_qt = parseFloat(itemqtytotal) + parseFloat(freightQty);


                 			$("#ref_qty").val(data1.data[0].FREIGHT_QTY);

                              $("#freight_qty").val(freightQty_qt.toFixed(3));



                 		}else{

                 			$("#ref_qty").val(data1.data[0].FQTY);
                 		}

                 		
                 	}

                 	if(data1.data_comp=='' || data1.data_comp==null){

                 	}else{


                 		$("#ref_comp_code").val(data1.data_comp.ACC_CODE);
                 		$("#ref_comp_name").val(data1.data_comp.ACC_NAME);

                 	}

                }

              },

          });


	}



	$("#bank_code1").on('change', function () {


		          var btotal =0;
		          var srno =1;
		          var othercompCal=0;
		          var myarray = [];

		          var bTotal      = $("#bTotal").html();
		          var ref_qty     = $("#ref_qty").val();
		          var freight_qty = $("#freight_qty").val();

		          var totalFreightQty = parseFloat(ref_qty) + parseFloat(freight_qty);

		          var expenseTon = parseFloat(bTotal) / parseFloat(totalFreightQty);

		          var othercomp_qty = parseFloat(ref_qty) * parseFloat(expenseTon);


					$(".basicamt").each(function () {
					   
					  btotal = this.value;

					/*  if(isNaN(btotal)){

					  	 var sf = '0.00';
					  }else{
					  	 var sf = btotal;
					  }*/


					  var refamt_cal = parseFloat(btotal) * 100 / bTotal;

					  var RefAmt_Cal = refamt_cal.toFixed(2);

					  console.log('RefAmt_Cal',RefAmt_Cal);
					  if(isNaN(RefAmt_Cal)){

					  }else{
					  		var othercomp_exp = parseFloat(othercomp_qty) * parseFloat(RefAmt_Cal) / 100;
					  }

					  

					  
					   	 othercompCal += parseFloat(othercomp_exp);	

					   $("#othercompAmt"+srno).val(othercomp_exp.toFixed(2));

					   $("#otherCompTotal").html(othercompCal.toFixed(2));
					   $("#refCompTotal").val(othercompCal.toFixed(2));
					  
					   console.log('srno',srno);
					  myarray.push(othercomp_exp);

					  srno++;
					});
					   



	           });

					

</script>

@endsection