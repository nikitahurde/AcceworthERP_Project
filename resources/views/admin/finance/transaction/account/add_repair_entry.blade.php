@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
	.required-field::before {
	    content: "*";
	    color: red;
  	}
	.inputboxclr {
	    border: 1px solid #d7d3d3;
	    width:100%;
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
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 2px;
	    padding-bottom: 0px !important;
	    vertical-align: top;
	}
	label{
		line-height:1;
	}
	.texIndbox1{
		font-size:12px;
		line-height:1;
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
	.content {
      min-height: 250px;
      padding: 9px;
      margin-right: auto;
      margin-left: auto;
      padding-left: 15px;
      padding-right: 15px;
  	}
  	.box-header>.box-tools {
	    position: absolute !important;
	    right: 10px !important;
	    top: 2px !important;
  	}
	.texIndbox{
		width:3%;
	}
	.checkCls{
		margin:0px !important;
	}
	.modlrowSace{
		padding: 2px 5px 2px 5px !important; 
	}
	.amntRight{
		text-align:right !important;
	}
	.textLeft{
		text-align:left !important;
	}
	.firstBlock {
	    border: 1px solid lightgrey;
	    padding-top: 12px;
	    -webkit-box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 75%);
	    -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
	    box-shadow: 0px 0px 4px 0px rgb(0 0 0 / 38%);
	    padding-bottom: 12px;
	    height: 416px;
	}

	.secondBlock {
	    border: 1px solid lightgrey;
	    padding-top: 9px;
	    -webkit-box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 75%);
	    -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
	    box-shadow: 0px 0px 4px 0px rgb(0 0 0 / 38%);
	    margin-left: 0px;
	}
	.checkBoxCls{
		width:5%;
	}
	.widthClassdt{
	    width: 12%;
	}
	.vrNoCls{
		width: 17%;
	}
	.transCls{
		width:10%;
	}
	.adviceAmtCls{
		width:20%;
		text-align:right;
	}
	.remarkCls{

	}
	.chqDateHide{
		display:none;
	}
	.rowShow{
		display:none;
	}
	.entryBlock{
		display:none;
	}
	.showSelName{
		margin-top: 6px;
	    font-size: 12px;
	    color: #3c8dbc;
	    font-weight: 700;
	}
</style>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
	       Sister Concern Entry
	      <small>Add Details</small>
	    </h1>

	    <ul class="breadcrumb">
	    	<li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="{{ url('/dashboard') }}">Transaction</a></li>
			<li class="active"><a href="{{ url('/transaction/account/add-posting-payment-advice') }}"> Sister Concern Entry</a></li>
			<li class="active"><a href="{{ url('/transaction/account/add-posting-payment-advice') }}">Add Sister Concern Entry</a></li>
	    </ul>
	</section>

<form id="SisterConcernEntry">
    @csrf
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary Custom-Box">

					<div class="box-header with-border" style="text-align: center;">

			            <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Sister Concern Entry</h2>
			            <div class="box-tools pull-right">
			              <a href="{{ url('/finance/view-cash-bank') }}" class="btn btn-primary" style="margin-right: 10px;padding: 1px 5px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>
			            </div>

        	 		</div><!-- /.box-header -->
	        
		        	<div class="box-body">

		        		<div class="col-md-12">

		        			<div class="row">

		        				<!--  ---- HIDDEN FIELD  -->

		        				<input type="hidden" value="{{$accGlOfComp[0]->ACC_CODE}}" id="logincompAccCd">
		        				<input type="hidden" value="{{$accGlOfComp[0]->ACC_NAME}}" id="logincompAccNm">
		        				<input type="hidden" value="{{$accGlOfComp[0]->GL_CODE}}" id="accGlCd">
		        				<input type="hidden" value="{{$accGlOfComp[0]->GL_NAME}}" id="accGlNm">
		        				<input type="hidden" value="" id="tranTbl_HId" name="tranTbl_HId">

		        				<!--  ---- HIDDEN FIELD  -->

			        			<div class="col-md-6 firstBlock">

			        				<div class="row">

			        					<div class="col-md-12">

			        						<div class="form-group">

						                     	<div class="input-group">

							                        <input type="radio" class="optionsRadios1" name="tran_Type_SS" value="CashBank" onclick="typeSSFun()" checked>&nbsp;Cash Bank &nbsp;
							                        <input type="radio" class="optionsRadios1" name="tran_Type_SS" value="Journal" onclick="typeSSFun()">&nbsp;Journal &nbsp;

						                     	</div>

						                    </div><!-- /.form-group -->
			        						
			        					</div><!-- /.col -->
			        					
			        				</div><!-- /.row -->

			        				<div class=" row">

			        					<div class="col-md-6">

				                          	<div class="form-group">

					                            <label> Acc Code : <span class="required-field"></span></label>

												<div class="input-group">

													<span class="input-group-addon"><i class="fa fa-building-o"></i></span>

													<input list="accList" class="form-control" name="acc_code" value="" id="acc_code" placeholder="Enter Acc Code" autocomplete="off">

													<datalist id="accList">

														<option selected="selected" value="">-- Select --</option>

								                     	@foreach ($accList as $key)

								                      		<option value='<?php echo $key->ACC_CODE; ?>' data-xyz ="<?php echo $key->ACC_NAME.'~'.$key->COMP_CODE_CTBL.'~'.$key->COMP_NAME_CTBL; ?>"><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

								                     	@endforeach
		                                    		</datalist>

												</div>
												<div id="showaccName" class="showSelName"></div>
				                           </div><!-- /.form-group -->

				                        </div><!-- /.col  -->

				                        <div class="col-md-3" style="margin-top: 3%;">

				                        	<label>&nbsp;</label>

				                        	<button type="button" class="btn btn-primary btn-sm btnStyle" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true" ></i> &nbsp;&nbsp;Search</button>
				                        	
				                        </div><!-- /.col -->

				                        <div class="col-md-3">
	              
						                	<div class="form-group">

						                  	<label> T Code : <span class="required-field"></span></label>

							                  	<div class="input-group">

							                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

							                      <input type="text" class="form-control" name="tran_code" value="A0" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

							                  	</div>

						                	</div><!-- /.form-group -->
						              	</div> <!-- /. col-->
			        					
			        				</div><!-- /.row -->

			        				<div class="row">
			        					
			        					<small id="errMsg" style="color:red;"></small>

			        				</div><!-- /.row -->

			        				<div class="row" style="margin-top: 1px;">

			        					<table id="tblPostData" class="table table-bordered table-striped table-hover billgenerate">

							            	<thead class="theadC">

							              		<tr>
													<th class="text-center" width="5%">Vr Date</th>
													<th class="text-center" width="5%">Vr No</th>
													<th class="text-center" width="5%">T Code</th>
													<th class="text-center" width="5%">Gl Name</th>
													<th class="text-center" width="5%">Dr Amt</th>
													<th class="text-center" width="5%">Particular</th>
							              		</tr>

							            	</thead>

								            <tbody id="defualtSearch">

								            </tbody>
								            
							          	</table>
			        					
			        				</div>

			        			</div><!-- /.first block -->

			        			<div class="col-md-6 secondBlock" style="height: 194px;">

			        				<div class="row">
			        					
			        					<div class="col-md-4">

			        						<div class="form-group">

						                     	<div class="input-group">

							                        <input type="radio" class="optionsRadios1" name="tranType" value="CashBank" onclick="trantypeFun()" checked>&nbsp;Cash Bank &nbsp;
							                        <input type="radio" class="optionsRadios1" name="tranType" value="Journal" onclick="trantypeFun()">&nbsp;Journal &nbsp;

						                     	</div>
						                     	<input type="hidden" name="seleTranType" id="seleTranType">
						                    </div><!-- /.form-group -->
			        						
			        					</div>

			        					<div class="col-md-8">

			        						<div class="row">
			        					
					        					<input type="hidden" name="accCompCd" id="accComp">
					        					<div id="accCompNm" style="text-align: center;color: cadetblue;font-weight: 700;"></div>
					        				</div>
					        						
			        					</div>

			        				</div><!-- /.row -->

			        				<div class="row">

			        					<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Date: <span class="required-field"></span></label>
						                    
						                    	<div class="input-group">
						                     	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						                      	<?php 

													$CurrentDate =date("d-m-Y");
													$FromDate    = date("d-m-Y", strtotime($fromDate));
													$ToDate      = date("d-m-Y", strtotime($toDate));  
							                           
							                        $formCurrentDt = date("Y-m-d", strtotime($CurrentDate));

							                        if($formCurrentDt > $toDate){
							                          $vrDate =$ToDate;
							                        }else{
							                          $vrDate =$CurrentDate;
							                        }

							                    ?>
						                      	<input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
						                      	<input type="hidden" name="" value="<?php echo $vrDate; ?>" id="ToDateFy">
						                      	<input type="text" class="form-control transdatepicker rightcontent" name="vrDate" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date"  autocomplete="off">

						                    	</div>

						                    	<small id="showmsgfordate" style="color: red;"></small>

						                	</div><!-- /.form-group -->
					                
					              		</div><!-- /. col-->

					              		<div class="col-md-4">

				        					<div class="form-group">

							                  	<label>Series : 
							                    	<span class="required-field"></span>
							                  	</label>

							                  	<div class="input-group">

													<div class="input-group-addon">

													<i class="fa fa-newspaper-o" aria-hidden="true"></i>

													</div>

							                     	<?php $getcount = count($getseries); ?>

							                     	<input list="seriesList"  id="series_code" name="seriescode" class="form-control  pull-left serieswidth" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();">

							                     	<datalist id="seriesList">

								                     	<option selected="selected" value="">-- Select --</option>

							                     	</datalist>

							                     	<!-- --- IF CHEQUBOOK EXIST ------ -->

							                     		<input type="hidden" name="checkChequeBookOpen" id="IsChequeBookOpen">

							                     	<!-- --- IF CHEQUBOOK EXIST ------ -->

							                  	</div>
					                 
					               			</div><!-- /.form-group -->

					               		</div><!-- /.col -->

					               		<div class="col-md-4">

						                	<div class="form-group">

							                  <label>Series Name: 
							                    <span class="required-field"></span>
							                  </label>

							                  <div class="input-group">

							                    	<div class="input-group-addon">

							                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

							                    	</div>

							                    	<input type="text" id="seriesText" name="seriesname" class="form-control  pull-left" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_NAME;}else{} ?>" placeholder="Select Series Name"  data-toggle="tooltip" data-placement="top" readonly>

							                  </div>
						                       
						                	</div><!-- /.form-group -->
						              	</div><!-- /.col -->

			        				</div><!-- /.row -->

			        				<div class="row rowShow" id="headCB">

			        					<div class="col-md-3">

						                	<div class="form-group">
						                
							                  	<label> Vr No: </label>

							                  	<div class="input-group">

							                    	<span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
							                    
							                    	<input type="text" class="form-control rightcontent" name="vr_no" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off" >

							                  	</div>

					               	 		</div> <!-- /.form-group -->
					              		</div> <!-- /.col -->

					              		<div class="col-md-4">

					                		<div class="form-group">

					                    		<label>GL Code : <span class="required-field"></span></label>

							                  	<div class="input-group">
							                     	<span class="input-group-addon" style="padding: 1px 12px;">
							                        	<i class="fa fa-sort-numeric-asc" id="firsticon"></i>
							                        	<div class="" id="appndplantbtn"></div>
							                     	</span>

							                    	<input type="text" class="form-control" name="postingCode" id="gl_code" value="{{ old('gl_code') }}" placeholder="Enter GL Code" readonly autocomplete="off">

							                  	</div>

					                		</div><!-- /.form-group -->

					                	</div><!-- /. col-->

					                	<div class="col-md-4">

						                	<div class="form-group">

							                  	<label> GL Name : <span class="required-field"></span></label>

							                  	<div class="input-group tooltips">

							                      	<span class="input-group-addon"><i class="fa fa-building-o"></i></span>

							                      	<input type="text" class="form-control" name="postingName" value="{{ old('gl_name') }}" id="gl_name" placeholder="Enter GL Name" readonly autocomplete="off">

							                      	<span class="tooltiptext tooltiphide" id="glNameTooltip"></span>
						                 	 	</div>

						                	</div><!-- /.form-group -->

						               	</div><!-- /.col -->

			        				</div><!-- /.row -->

			        				<div class="row rowShow" id="headCBtWO">

			        					<div class="col-md-4">

					                		<div class="form-group">

						                  		<label> Vr Type :  <span class="required-field"></span></label>

							                  	<div class="input-group">

							                      	<span class="input-group-addon"><i class="fa fa-building-o"></i></span>
							                       	<input type="text" class="form-control" name="vrType" value="" id="vrType" placeholder="Enter Vr Type" readonly="" autocomplete="off">

							                 	</div>

					                		</div><!-- /.form-group -->

					              		</div><!-- /.col -->

					              		<div class="col-md-4">

			                				<div class="form-group">
			                
			                  					<label>Pfct Code: <span class="required-field"></span></label>

			                  					<div class="input-group">

							                      	<div class="input-group-addon">

							                        	<i class="fa fa-newspaper-o" aria-hidden="true"></i>

							                      	</div>
					                      			<?php $pfcount = count($pfct_list); ?>
					                      			<input list="profitList"  id="profitId" name="pfctCode" class="form-control  pull-left" placeholder="Select Profit Center Code" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_CODE; }else{} ?>" autocomplete="off">

							                     	<datalist id="profitList">

								                        @foreach ($pfct_list as $key)

								                        <option value='<?php echo $key->PFCT_CODE?>'   data-xyz ="<?php echo $key->PFCT_NAME; ?>" ><?php echo $key->PFCT_NAME ; echo " [".$key->PFCT_CODE."]" ; ?></option>

								                        @endforeach

							                     	</datalist>

			                  					</div>

			                				</div><!-- /.form-group -->
			              				</div><!-- /.col -->

			              				<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Pfct Name: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
								                    <div class="pull-left showSeletedName" id="profit_names"></div>
								                    <input type="text" class="form-control" id="profit_name" name="profitName" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_NAME; }else{} ?>" placeholder="Enter Profit Center Name" readonly>

							                  	</div>

						                  		<small id="comp_code_err" style="color: red;"></small>
						                  
						                	</div><!-- /.form-group -->
					             		</div><!-- /.col -->

			        				</div><!-- /.row -->

			        				<div class="row rowShow" id="headJV">

			        					<div class="col-md-3">

						                	<div class="form-group">
						                
							                  	<label> Vr No: </label>

							                  	<div class="input-group">

							                    	<span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
							                    
							                    	<input type="text" class="form-control rightcontent" name="vr_noJV" value="" placeholder="Enter Vr No" id="vrseqnumJV" readonly autocomplete="off" >

							                  	</div>

					               	 		</div> <!-- /.form-group -->

					              		</div> <!-- /.col -->

					              		<div class="col-md-4">

			                				<div class="form-group">
			                
			                  					<label>Pfct Code: <span class="required-field"></span></label>

			                  					<div class="input-group">

							                      	<div class="input-group-addon">

							                        	<i class="fa fa-newspaper-o" aria-hidden="true"></i>

							                      	</div>
					                      			<?php $pfcount = count($pfct_list); ?>
					                      			<input list="profitListJV"  id="profitIdJV" name="pfctCodeJV" class="form-control  pull-left" placeholder="Select Profit Center Code" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_CODE; }else{} ?>" autocomplete="off">

							                     	<datalist id="profitListJV">

								                        @foreach ($pfct_list as $key)

								                        <option value='<?php echo $key->PFCT_CODE?>' data-xyz ="<?php echo $key->PFCT_NAME; ?>" ><?php echo $key->PFCT_NAME ; echo " [".$key->PFCT_CODE."]" ; ?></option>

								                        @endforeach

							                     	</datalist>

			                  					</div>

			                				</div><!-- /.form-group -->
			              				</div><!-- /.col -->

			              				<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Pfct Name: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
								                    <div class="pull-left showSeletedName" id="profit_names"></div>
								                    <input type="text" class="form-control" id="profit_nameJV" name="profitNameJV" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_NAME; }else{} ?>" placeholder="Enter Profit Center Name" readonly>

							                  	</div>

						                  		<small id="comp_code_err" style="color: red;"></small>
						                  
						                	</div><!-- /.form-group -->
					             		</div><!-- /.col -->
			        					
			        				</div><!-- /.row -->
			        				
			        			</div><!-- /.second block -->

			        			<div class="col-md-6 secondBlock" style="height: 220px;">
			        				
			        				<div class="row entryBlock" id="cbEntry">

			        					<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Acc code / Name: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input list="accListCB" class="form-control" id="accCode" name="accCode" value="" placeholder="Enter Acc code" autocomplete="off" readonly>

								                    <datalist id="accListCB">

								                    	@foreach ($acc_list as $key)

								                      		<option value='<?php echo $key->ACC_CODE; ?>' data-xyz ="<?php echo $key->ACC_NAME; ?>"><?php echo $key->ACC_NAME; ?></option>

								                     	@endforeach
								                    	
								                    </datalist>

								                    <input type="text" class="form-control" id="accName" name="accName" value="" placeholder="Enter Acc Name" readonly>

							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->

					             		<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Gl code / Name: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input list="glListCB" class="form-control" id="glCode" name="glCode" value="" placeholder="Enter Gl code" autocomplete="off" readonly>

								                    <datalist id="glListCB">
								                    	@foreach ($gl_list as $key)

								                      		<option value='<?php echo $key->GL_CODE; ?>' data-xyz ="<?php echo $key->GL_NAME; ?>"><?php echo $key->GL_NAME; ?></option>

								                     	@endforeach
								                    </datalist>

								                    <input type="text" class="form-control" id="glName" name="glName" value="" placeholder="Enter Gl Name" readonly>

							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->

					             		<div class="col-md-3">

						                	<div class="form-group">

						                  		<label>Credit-CR: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input type="text" class="form-control amntRight" id="dr_amount" name="cr_amountcb" value="" placeholder="Enter Credit-CR" readonly>
								                    
							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->
			        					
			        				</div><!-- /.row -->

			        				<div class="row entryBlock" id="journalEntry1">

			        					<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Acc code / Name: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input list="accCdList" class="form-control" id="accCode1" onchange="AccountCodeFun()" name="accCodeJV[]" value="" placeholder="Enter Acc code" autocomplete="off">
								                    <datalist id="accCdList">

								                     	<option selected="selected" value="">-- Select --</option>

								                     	@foreach ($accCdList as $key)

								                      	<option value='<?php echo $key->ACC_CODE; ?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>"><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

								                     	@endforeach

							                     	</datalist>

								                    <input type="text" class="form-control" id="accName1" name="accNameJV[]" value="" placeholder="Enter Acc Name" readonly>

							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->

					             		<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Gl code / Name: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input list="glJvList" class="form-control" id="glCode1" name="glCodeJV[]" value="" placeholder="Enter Gl code" autocomplete="off">

								                    <datalist id="glJvList">
								                    	@foreach ($gl_list as $key)

								                      		<option value='<?php echo $key->GL_CODE; ?>' data-xyz ="<?php echo $key->GL_NAME; ?>"><?php echo $key->GL_NAME; ?></option>

								                     	@endforeach
								                    </datalist>
								                    <input type="text" class="form-control" id="glName1" name="glNameJV[]" value="" placeholder="Enter Gl Name" readonly>

							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->

					             		<div class="col-md-3">

						                	<div class="form-group">

						                  		<label>Dedit-DR: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input type="text" class="form-control amntRight" id="dr_amountJV" name="dr_amountJV[]" value="" placeholder="Enter Dedit-DR" readonly>

								                    <input type="hidden" class="form-control amntRight" id="cr_amountJV1" name="cr_amountJv[]" value="" placeholder="Enter Credit-CR" readonly>
								                    
							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->	
			        					
			        				</div><!-- /.row -->

			        				<div class="row entryBlock" id="journalEntry2">
			        					
			        					<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Acc code / Name: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input type="text" class="form-control" id="accCode2" name="accCodeJV[]" value="" placeholder="Enter Acc code" readonly autocomplete="off">
								                    <input type="text" class="form-control" id="accName2" name="accNameJV[]" readonly value="" placeholder="Enter Acc Name" readonly>

							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->

					             		<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Gl code / Name: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input type="text" class="form-control" id="glCode2" name="glCodeJV[]" readonly value="" placeholder="Enter Gl code" autocomplete="off">
								                    <input type="text" class="form-control" id="glName2" name="glNameJV[]" readonly value="" placeholder="Enter Gl Name" readonly>

							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->

					             		<div class="col-md-3">

						                	<div class="form-group">

						                  		<label>Credit-CR: <span class="required-field"></span></label>

							                  	<div class="input-group">

							                  		<input type="hidden" class="form-control amntRight" id="dr_amountJV1" name="dr_amountJV[]" value="" placeholder="Enter Dedit-DR" readonly>

								                    <input type="text" class="form-control amntRight" id="cr_amountJV" name="cr_amountJv[]" value="" placeholder="Enter Credit-CR" readonly>
								                    
							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->

			        				</div><!-- /.row -->

			        			</div>
			        			
			        		</div> <!-- /. row -->

			        		<div style="text-align: center;margin-top:2%;">

			        			<small style="color:red;font-weight:700" id="reqMsg"></small><br>

			        			<input type="hidden" id="payAdvTblData" name="payAdvTblData">
						
								<button type="button" name="submit" value="submit" disabled id="submitposting" class='btn btn-success' style="width: 16%;" onclick="submitAllData(0)">&nbsp;Post&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button> 		        		
								
					    	</div>
		        			
		        		</div><!-- /.col -->

		        	</div> <!-- /. box body -->

				</div> <!-- /. custom box -->

			</div> <!-- /. col 12 -->
		</div> <!-- /. row -->

	</section> <!-- /. section -->

</form>
	
</div> <!-- /. content wrapper -->

@include('admin.include.footer')

<script>

/* ----- START : GETTING ACC LIST FROM TABLE -------- */

	function typeSSFun(){

		var tranTypeSS = $('input[name="tran_Type_SS"]:checked').val();

		if(tranTypeSS == 'CashBank'){
			$('#transcode').val('A0');
		}else if(tranTypeSS == 'Journal'){
			$('#transcode').val('A2');
		}

		$('#accList').empty();
		$('#acc_code').val('');
		$.ajaxSetup({
     	 	headers: {
	          	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      	}
	    });

		$.ajax({

   			url:"{{ url('get-acc-code-list-against-ssTran-type-in-ss') }}",
         	method : "POST",
         	type: "JSON",
         	data: {tranTypeSS: tranTypeSS},
         	success:function(data){
         		var data1 = JSON.parse(data);

         		if (data1.response == 'error') {
               		$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
            	}else if(data1.response == 'success'){

            		if(data1.data_acc == ''){

            		}else{

            			$('#accList').empty();

            			$.each(data1.data_acc, function(k, getData){

                            $("#accList").append($('<option>',{

                              value:getData.ACC_CODE,
                              'data-xyz':getData.ACC_NAME+'~'+getData.COMP_CODE_CTBL+'~'+getData.COMP_NAME_CTBL,
                              text:getData.ACC_NAME

                            }));

                        });

            		}

            	}

         	}/* /. success fucntion*/

        }); /* /. ajax function*/

	}/*/. function*/

/* ----- START : GETTING ACC LIST FROM TABLE -------- */

	$(document).ready(function(){
		trantypeFun();
	});

/* --------- START : TRANSACTION TYPE ---------- */

	function trantypeFun(){

		var tranType          = $('input[name="tranType"]:checked').val();
		var getLoginCompAcc   = $('#logincompAccCd').val();
		var getLoginCompAccNm = $('#logincompAccNm').val();
		var accGlCd           = $('#accGlCd').val();
		var accGlNm           = $('#accGlNm').val();

		if(tranType == 'Journal'){
			$('#headJV').removeClass('rowShow');
			$('#headCB').addClass('rowShow');
			$('#headCBtWO').addClass('rowShow');
			$('#cbEntry').addClass('entryBlock');
			$('#journalEntry1').removeClass('entryBlock');
			$('#journalEntry2').removeClass('entryBlock');

			$('#accCode2').val(getLoginCompAcc);
			$('#accName2').val(getLoginCompAccNm);
			$('#glCode2').val(accGlCd);
			$('#glName2').val(accGlNm);

			$('#transcode').val('A2');
			$('#seleTranType').val('');
			$('#seleTranType').val('Journal');

		}else{
			$('#headJV').addClass('rowShow');
			$('#headCB').removeClass('rowShow');
			$('#headCBtWO').removeClass('rowShow');
			$('#cbEntry').removeClass('entryBlock');
			$('#journalEntry1').addClass('entryBlock');
			$('#journalEntry2').addClass('entryBlock');
			$('#transcode').val('A0');
			$('#seleTranType').val('');
			$('#seleTranType').val('CashBank');
		}	

		$('#series_code').val('');

		$.ajaxSetup({
     	 	headers: {
	          	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      	}
	    });

	    var accCompCd =  $('#accComp').val();
		var tranType  = $('input[name="tranType"]:checked').val();

		$.ajax({

   			url:"{{ url('get-series-against-company-of-acc') }}",
         	method : "POST",
         	type: "JSON",
         	data: {accCompCd: accCompCd,tranType:tranType},
         	success:function(data){
         		var data1 = JSON.parse(data);

         		if (data1.response == 'error') {
               		$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
            	}else if(data1.response == 'success'){

            		if(data1.data_series == ''){

            		}else{

            			$('#seriesList').empty();

            			$.each(data1.data_series, function(k, getData){

                            $("#seriesList").append($('<option>',{

                              value:getData.SERIES_CODE,
                              'data-xyz':getData.SERIES_NAME,
                              text:getData.SERIES_NAME

                            }));

                        });

            		}

            	}

         	}/* /. success fucntion*/

        }); /* /. ajax function*/

	}

/* --------- END : TRANSACTION TYPE ---------- */

	/* -------------- account code ------------------ */
  
  	function AccountCodeFun(){

	    var account_code =  $('#accCode1').val();

        var xyz = $('#accCdList option').filter(function() {
          return this.value == account_code;
        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){

          $('#accCode1').val('');
          $('#accName1').val('');
         
        }else{
          $('#accName1').val(msg);
        }

        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var accountcode =  $('#accCode1').val();
        var accountURL = "{{ url('acc-code-for-cash-bank') }}";

        $.ajax({

          	url:accountURL,
            method : "POST",
            type: "JSON",
            data: {accountcode: accountcode},
            success:function(data){
              	var data1 = JSON.parse(data);

              	if (data1.response == 'error') {

                  	$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
              	}else if(data1.response == 'success'){
               
                	if(data1.data==''){
                 
                	}else{
	                    $('#glCode1').val(data1.data[0].GL_CODE);
	                    $('#glName1').val(data1.data[0].GL_NAME);
                	}
              	}
            }
        });
  	}

/* -------------- account code ------------------ */

/* ---------- get vrno against series code ------------- */
	
	function getvrnoBySeries(){
		
		$("input[name=tranType]").prop("disabled",true);
		var seriesCd =  $('#series_code').val();
		var accCompCd =  $('#accComp').val();
		var xyz = $('#seriesList option').filter(function() {

	        return this.value == seriesCd;

      	}).data('xyz');

		var msg = xyz ?  xyz : 'No Match';

		if(msg == 'No Match'){
			$('#series_code').val('');
			$('#seriesText').val('');
		}else{
			$('#seriesText').val(msg);
			var seriesCode = $('#series_code').val();
    		var transcode = $('#transcode').val();

	    	$.ajaxSetup({

	         	headers: {

	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

	         	}
	   		});

	   		$.ajax({

	   			url:"{{ url('get-vr-sequence-by-series-in-ss') }}",
	         	method : "POST",
	         	type: "JSON",
	         	data: {seriesCode: seriesCode,transcode:transcode,accCompCd:accCompCd},
	         	success:function(data){
	         		var data1 = JSON.parse(data);
	         		if (data1.response == 'error') {
	         			$('#vrseqnum').val('');
	               		$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
	               		$('#IsChequeBookOpen').val('NO');

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
		                }

		               	if(data1.data ==''){

		               	}else{
		               		$("#gl_code").val(data1.data[0].GL_CODE);
		                  	$("#gl_name").val(data1.data[0].GL_NAME);

		               	}

	            	} /* /. success */
	         	} /* /. success function */
	   		}); /* /. ajax function */

		}

		fieldValidation();
		
	} /* /. main function */


	function fieldValidation(){
		var sereisCd = $('#series_code').val();
		var pfctCd   = $('#profitId').val();

		if(sereisCd){
			$('#series_code').css('border-color','#d7d3d3');
			if(pfctCd){
				$('#profitId').css('border-color','#d7d3d3');
			}else{
				$('#profitId').css('border-color','#ff0000');
			}
		}else{
			$('#series_code').css('border-color','#ff0000');
		}

		if(sereisCd && pfctCd){
			$('#costCode,#inst_type').prop('readonly',false);
			var acc_code = $('#accCode').val();
			if(acc_code){
				$('#submitposting').prop('disabled',false);
			}else{
				$('#submitposting').prop('disabled',true);
			}
		}else{
			$('#costCode,#inst_type,#submitposting').prop('readonly',true);
		}

		
	}

/* ---------- get vrno against series code ------------- */

/* ---------- START : SEARCH DATA -----------------*/

    function load_data(accCode='',tranType=''){
          
      $('#tblPostData').DataTable({

			processing: true,
         	serverSide: true,
         	scrollY: '180px',
         	'fnCreatedRow': function (nRow, aData, iDataIndex) {
                console.log('aData',aData);
          		$(nRow).attr('onclick', "showselectedData("+aData['DRAMT']+","+aData['TBLHEADID']+")"); // or whatever you choose to set as the id
      		},
          	ajax:{
	            url:'{{ url("Transaction/get-repair-data") }}',
	            data: {accCode:accCode,tranType:tranType},
	            method:"POST",
          	},
          	columns: [
            {
                data:'VRDATE',
                className: "widthClassdt",	
                render: function (data) {
                    var date = new Date(data);
  
                    var month = date.getMonth() + 1;
                    if(data=='0000-00-00'){
                      return '00-00-0000';
                    }else{
                      
                    return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                    }
                } 
            },
            {
            	className:"vrNoCls",
              	render: function (data, type, full, meta){
	                var fyCd = full['FY_CODE'];
	                if(fyCd){
	                  var fysiclYR = fyCd;
	                  var fsYear = fysiclYR.split('-');
	                  var VRNO = fsYear[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
	                  var fy_cd = VRNO;
	                }else{
	                  var fy_cd='--';
	                }
	                return fy_cd;
              	},
            },
            {
              data:'TRAN_CODE',
              name:'TRAN_CODE',
              className:'transCls'
            },
            {
              data:'GL_NAME',
              name:'GL_NAME',
              className:'transCls'
            },
            {
              data:'DRAMT',
              name:'DRAMT',
              className:'adviceAmtCls'
            },
            {
              data:'PARTICULAR',
              name:'PARTICULAR',
              className:'remarkCls'
            },	
          ]

      });

    }

    function showselectedData(ColData,tranTblHId){

    	$('#btnsearch').prop('disabled',true);
    	$('#acc_code').prop('readonly',true);

    	$('#vrType').val('Receipt');
    	$('#dr_amount').val(ColData);
    	$('#cr_amountJV').val(ColData);
    	$('#dr_amountJV').val(ColData);
    	$('#tranTbl_HId').val(tranTblHId);

    	var tranType = $('input[name="tranType"]:checked').val();

		var loginCompAccCd = $('#logincompAccCd').val();
		var loginCompAccNm = $('#logincompAccNm').val();
		var accGl          = $('#accGlCd').val();
		var accName        = $('#accGlNm').val();

    	if(tranType == 'CashBank'){
    		$('#accCode').val(loginCompAccCd);
    		$('#accName').val(loginCompAccNm);
    		$('#glCode').val(accGl);
    		$('#glName').val(accName);
    	}else if(tranType == 'Journal'){
    		$('#cr_amountJV').val(ColData);
    		$('#dr_amountJV').val(ColData);

    		$('#accCode2').val(loginCompAccCd);
			$('#accName2').val(loginCompAccNm);
			$('#glCode2').val(accGl);
			$('#glName2').val(accName);
    	}

    	$.ajaxSetup({
     	 	headers: {
	          	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      	}
	    });

		var accCompCd =  $('#accComp').val();
		var tranType  = $('input[name="tranType"]:checked').val();

	    $.ajax({

   			url:"{{ url('get-series-against-company-of-acc') }}",
         	method : "POST",
         	type: "JSON",
         	data: {accCompCd: accCompCd,tranType:tranType},
         	success:function(data){
         		var data1 = JSON.parse(data);

         		if (data1.response == 'error') {
               		$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
            	}else if(data1.response == 'success'){

            		if(data1.data_series == ''){

            		}else{

            			$('#seriesList').empty();

            			$.each(data1.data_series, function(k, getData){

                            $("#seriesList").append($('<option>',{

                              value:getData.SERIES_CODE,
                              'data-xyz':getData.SERIES_NAME,
                              text:getData.SERIES_NAME

                            }));

                        });

            		}

            	}

         	}/* /. success fucntion*/

        }); /* /. ajax function*/


    	fieldValidation();
    }

   	$(document).ready(function(){

   		$( window ).on( "load", function() {

	      var fromdateintrans = $('#FromDateFy').val();

	      var todateintrans = $('#ToDateFy').val();

	        $('.transdatepicker').datepicker({

	          format: 'dd-mm-yyyy',
	          orientation: 'bottom',
	          todayHighlight: 'true',
	          startDate :fromdateintrans,
	          endDate : todateintrans,
	          autoclose: 'true'
	        });

	    });

   		$('#btnsearch').click(function(){
        
			var accCode  = $('#acc_code').val();
			var tranType = $('input[name="tran_Type_SS"]:checked').val();

			if(accCode != ''){
				$('#errMsg').html('');
				$('#tblPostData').DataTable().destroy();
	     		load_data(accCode,tranType);
	     		$("input[name=tran_Type_SS]").prop("disabled",true);
	    	}else{
	    		$('#errMsg').html('The Acc Code field is required.');
	    	}

	    	if(tranType == 'Journal'){

	    		$("input[name=tranType][value='Journal']").prop("checked",true);
	    		$("input[name=tranType]").prop("disabled",true);
	    		$('#headJV').removeClass('rowShow');
				$('#headCB').addClass('rowShow');
				$('#headCBtWO').addClass('rowShow');
				$('#cbEntry').addClass('entryBlock');
				$('#journalEntry1').removeClass('entryBlock');
				$('#journalEntry2').removeClass('entryBlock');
				$('#seleTranType').val('Journal');

	    	}else{
	    		$("input[name=tranType][value='CashBank']").prop("checked",true);

	    		$('#headJV').addClass('rowShow');
				$('#headCB').removeClass('rowShow');
				$('#headCBtWO').removeClass('rowShow');
				$('#cbEntry').removeClass('entryBlock');
				$('#journalEntry1').addClass('entryBlock');
				$('#journalEntry2').addClass('entryBlock');
				$('#seleTranType').val('CashBank');
	    	}

	    });

	    $('#profitId').on('change',function(){

	    	var pfctcode =  $('#profitId').val();

	        var xyz = $('#profitList option').filter(function() {

	            return this.value == pfctcode;

	        }).data('xyz');

        	var msg = xyz ?  xyz : 'No Match';

        	if(msg == 'No Match'){
        		$('#profitId').val('');
        	}else{
        		$('#profit_name').val(msg);
        	}

        	fieldValidation();

	    });

	    $('#profitIdJV').on('change',function(){

	    	var pfctcode =  $('#profitIdJV').val();

	        var xyz = $('#profitListJV option').filter(function() {

	            return this.value == pfctcode;

	        }).data('xyz');

        	var msg = xyz ?  xyz : 'No Match';

        	if(msg == 'No Match'){
        		$('#profitIdJV').val('');
        	}else{
        		$('#profit_nameJV').val(msg);
        	}

        	fieldValidation();

	    });
		
		$('#acc_code').on('change',function(){

	    	var acccode =  $('#acc_code').val();

	        var xyz = $('#accList option').filter(function() {

	            return this.value == acccode;

	        }).data('xyz');

        	var msg = xyz ?  xyz : 'No Match';

        	if(msg == 'No Match'){
        		$('#acc_code').val('');
        		$('#showaccName').html('');
        	}else{
        		var slitMsg = msg.split('~');
        		$('#showaccName').html(slitMsg[0]);
        		$('#accComp').val(slitMsg[1]);
        		$('#accCompNm').html(slitMsg[1]+' - '+slitMsg[2]);
        	}

	    });

	    $('#costCode').on('change',function(){

	    	$('#vr_date,#profitId,#series_code').prop('readonly',true);

	    	var costcode =  $('#costCode').val();

	        var xyz = $('#costList option').filter(function() {

	            return this.value == costcode;

	        }).data('xyz');

        	var msg = xyz ?  xyz : 'No Match';

        	if(msg == 'No Match'){
        		$('#costCode').val('');
        		$('#costName').val('');
        	}else{
        		$('#costName').val(msg);
        	}

	    });

   	});


/* ---------- END : SEARCH DATA -----------------*/


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


	function submitAllData(valp){

		var data = $("#SisterConcernEntry").serialize();
			
		$.ajaxSetup({
     	 	headers: {

	          	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

	      	}
	    });

	    $.ajax({

       	 	type: 'POST',
	        url: "{{ url('/transaction/account/save-sister-concern-entry') }}",
	        dataType: "json",
	        data: data, 
	        success: function (data) {

	          var data1 = JSON.parse(JSON.stringify(data));

	          if (data1.response == 'error') {
	            var responseVar = false;
	            var url = "{{url('/transaction/account/sister-concern-save-msg')}}"
	            setTimeout(function(){ window.location = url+'/'+responseVar; });
	          }else{
	            var responseVar = true;
	            var url = "{{url('/transaction/account/sister-concern-save-msg')}}"
	            setTimeout(function(){ window.location = url+'/'+responseVar; });
	          }
	      
	        },
	    });

    }

</script>

@endsection