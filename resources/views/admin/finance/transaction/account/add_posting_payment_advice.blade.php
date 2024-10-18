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
	    height: 394px;
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
</style>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
	       Posting Payment Advice
	      <small>Add Details</small>
	    </h1>

	    <ul class="breadcrumb">
	    	<li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="{{ url('/dashboard') }}">Transaction</a></li>
			<li class="active"><a href="{{ url('/transaction/account/add-posting-payment-advice') }}"> Posting Payment Advice</a></li>
			<li class="active"><a href="{{ url('/transaction/account/add-posting-payment-advice') }}">Add Posting Payment Advice</a></li>
	    </ul>
	</section>

<form id="postingPayAdvice">
    @csrf
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary Custom-Box">

					<div class="box-header with-border" style="text-align: center;">

			            <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Posting Payment Advice</h2>
			            <div class="box-tools pull-right">
			              <a href="{{ url('/finance/view-cash-bank') }}" class="btn btn-primary" style="margin-right: 10px;padding: 1px 5px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>
			            </div>

        	 		</div><!-- /.box-header -->

        	 		@if(Session::has('alert-success'))

			          	<div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;    text-align: initial;">

			            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

				            <h4>

				            <i class="icon fa fa-check"></i>

				            Success...!

				            </h4>

			            	{!! session('alert-success') !!}

			          	</div>

			        @endif

			        @if(Session::has('alert-error'))

			          	<div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;    text-align: initial;">

			            	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

					            <h4>

					            <i class="icon fa fa-ban"></i>

					            Error...!

					            </h4>

			            		{!! session('alert-error') !!}

			          	</div>

			        @endif
	        
		        	<div class="box-body">

		        		<div class="col-md-12">

		        			<div class="row">

			        			<div class="col-md-6 firstBlock">

			        				<div class=" row">

			        					<div class="col-md-6">

				                          	<div class="form-group">

					                            <label> Acc Code : <span class="required-field"></span></label>

												<div class="input-group">

													<span class="input-group-addon"><i class="fa fa-building-o"></i></span>

													<input list="accList" class="form-control" name="acc_code" value="" id="acc_code" placeholder="Enter Acc Code" autocomplete="off">

													<datalist id="accList">

														<option selected="selected" value="">-- Select --</option>

								                     	<?php foreach ($accList as $key){ 

															$bankCd = $key->BANK_CODE;
															$bankNm = $key->BANK_NAME;
															$accNo  = $key->ACC_NUMBER;
								                     		
															$getBankCd = ($bankCd) ? $bankCd : 'NO';
															$getBankNm = ($bankNm) ? $bankNm : 'NO';
															$getAccNo  = ($accNo) ? $accNo : 'NO';
								                     	?>

								                      		<option value='<?php echo $key->ACC_CODE; ?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>~<?php echo $key->GL_CODE; ?>~<?php echo $key->GLNAME; ?>~<?php echo $getBankCd; ?>~<?php echo $getBankNm; ?>~<?php echo $getAccNo; ?>"><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

								                      	<?php } ?>
		                                    		</datalist>

												</div>
												<input type="hidden" name="" id="acc_NameS">
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

							                      <input type="text" class="form-control" name="tran_code" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

							                  	</div>

						                	</div><!-- /.form-group -->
						              	</div> <!-- /. col-->
			        					
			        				</div><!-- /.row -->

			        				<div class="row">
			        					
			        					<small id="errMsg" style="color:red;"></small>

			        				</div><!-- /.row -->

			        				<div class="row">

			        					<table id="tblPostData" class="table table-bordered table-striped table-hover billgenerate">

							            	<thead class="theadC">

							              		<tr>
													<th class="text-center" width="1%">#</th>
													<th class="text-center" width="5%">Vr Date</th>
													<th class="text-center" width="5%">Vr No</th>
													<th class="text-center" width="5%">T Code</th>
													<th class="text-center" width="5%">Advice Amt</th>
													<th class="text-center" width="5%">Particular</th>
							              		</tr>

							            	</thead>

								            <tbody id="defualtSearch">

								            </tbody>
								            
							          	</table>
			        					
			        				</div>

			        				<div class="row" style="text-align: center;">
			        					<button type="button" class="btn btn-primary btn-sm btnStyle" name="selOkdata" id="selOkdata" value="sel_data" onclick="checkDataSel();" disabled><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Proceed</button>
			        				</div>
			        				
			        			</div><!-- /.first block -->

			        			<div class="col-md-6 secondBlock">

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

							                     	<input list="seriesList"  id="series_code" name="seriescode" class="form-control  pull-left serieswidth" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series"  oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off" onchange="getvrnoBySeries();">

							                     	<datalist id="seriesList">

								                     	<option selected="selected" value="">-- Select --</option>

								                     	@foreach ($getseries as $key)

								                      	<option value='<?php echo $key->SERIES_CODE; ?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>"><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

								                     	@endforeach

							                     	</datalist>

							                     	<!-- --- IF CHEQUBOOK EXIST ------ -->

							                     		<input type="hidden" name="checkChequeBookOpen" id="IsChequeBookOpen">
							                     		<input type="hidden" name="bankOfSeriesGl" id="bankOfSeriesGl">

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

			        				<div class="row">

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

			        				<div class="row">

			        					<div class="col-md-4">

					                		<div class="form-group">

						                  		<label> Vr Type :  <span class="required-field"></span></label>

							                  	<div class="input-group">

							                      	<span class="input-group-addon"><i class="fa fa-building-o"></i></span>
							                       	<input type="text" class="form-control" name="vrType" value="Payment" id="vrType" placeholder="Enter Vr Type" readonly="" autocomplete="off">

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
			        				
			        			</div><!-- /.second block -->

			        			<div class="col-md-6 secondBlock" style="height: 232px;">
			        				
			        				<div class="row">

			        					<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Acc code / Name: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input type="text" class="form-control" id="accCode" name="accCode" value="" placeholder="Enter Acc code" readonly>
								                    <input type="text" class="form-control" id="accName" name="accName" value="" placeholder="Enter Acc Name" readonly>

							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->

					             		<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Gl code / Name: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input type="text" class="form-control" id="glCode" name="glCode" value="" placeholder="Enter Gl code" readonly>
								                    <input type="text" class="form-control" id="glName" name="glName" value="" placeholder="Enter Gl Name" readonly>

							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->

					             		<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Bank Detail: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input type="text" class="form-control" id="bankCode" name="bankCode" value="" placeholder="Enter Bank Code / Name" readonly>
								                    <input type="text" class="form-control" id="bank_accNo" name="bank_accNo" value="" placeholder="Enter Bank Acc No." readonly>

							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->
			        					
			        				</div><!-- /.row -->

			        				<div class="row">

			        					<div class="col-md-4">

						                	<div class="form-group">

						                  		<label>Cost code / Name: </label>

							                  	<div class="input-group">

								                    <input list="costList" class="form-control" id="costCode" name="costCode" value="" placeholder="Enter Cost code" readonly>

								                    <datalist id="costList">

														<option selected="selected" value="">-- Select --</option>

								                     	@foreach ($cost_list as $key)

								                      		<option value='<?php echo $key->COST_CODE; ?>'   data-xyz ="<?php echo $key->COST_NAME; ?>"><?php echo $key->COST_NAME ; echo " [".$key->COST_CODE."]" ; ?></option>

								                     	@endforeach
		                                    		</datalist>

								                    <input type="text" class="form-control" id="costName" name="costName" value="" placeholder="Enter Cost Name" readonly>

							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->

					             		<div class="col-md-5">

						                	<div class="form-group">

						                  		<label>Instrument Type No: <span class="required-field"></span></label>

							                  	<div class="input-group" style="display: flex;">

								                    <input list="InstTypeList" class="form-control" id="inst_type" name="instrument_type" value="" placeholder="Enter Instrument Type" style="width: 50%;" autocomplete="off" onchange="changechqdate()" readonly>
								                    <datalist id="InstTypeList">
							                            <option selected="selected" value="">-- Select --</option>
							                            
							                            <option value='CH' data-xyz ="Cheque">Cheque[CH]</option>
							                            <option value='DD' data-xyz ="Demand Draft">Demand Draft[DD]</option>
							                            <option value='TR' data-xyz ="Transfer receipt">Transfer receipt[TR]</option>
							                            <option value='TT' data-xyz ="Tele Transfer">Tele Transfer[TT]</option>  
							                            <option value='MT' data-xyz ="Money Transfer">Money Transfer[MT]</option>
							                            <option value='RT' data-xyz ="RTGS">RTGS[RT]</option>     
							                            <option value='BA' data-xyz ="Bank Advise">Bank Advise[BA]</option>     
							                            <option value='EC' data-xyz ="Electronic Clearence">Electronic Clearence[EC]</option>     
							                            <option value='FT' data-xyz ="Fund Transfer">Fund Transfer[FT]</option>     
							                            <option value='NEFT' data-xyz ="National Electronic Funds Transfer">National Electronic Funds Transfer[NEFT]</option>     
							                            <option value='IMPS' data-xyz ="Immediate Payment Service">Immediate Payment Service[IMPS]</option>     
							                            <option value='UPI' data-xyz ="Unified Payments Interface">Unified Payments Interface[UPI]</option>     
							                            <option value='NA' data-xyz ="Not Applicable">Not Applicable[NA]</option>     

				                          			</datalist>

								                    <input list='chequeNoList' class="form-control" id="cheque_no" name="instrument_no" value="" placeholder="Enter Instrument No" onchange="getdicbypay()" autocomplete="off" readonly>

								                    <datalist id="chequeNoList"></datalist>

							                  	</div>
							                  	<div class="input-group chqDateHide" id="showDate">
							                  		
							                  		<input type="text" name="chquedate" id="chquedate" value="" class="form_date form-control chqdatepicker" placeholder="select date" style="width: 100%;" autocomplete="off" readonly>

							                  	</div>
							                  	<input type="hidden" name="chequeTblData" id="chkTblId">
						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->	

					             		<div class="col-md-3">

						                	<div class="form-group">

						                  		<label>Debit-DR: <span class="required-field"></span></label>

							                  	<div class="input-group">

								                    <input type="text" class="form-control amntRight" id="dr_amount" name="dr_amount" value="" placeholder="Enter Debit-DR" readonly>
								                    
							                  	</div>

						                	</div><!-- /.form-group -->

					             		</div><!-- /.col -->
			        					
			        				</div><!-- /.row -->

			        				<div class="row">

					             		<div class="col-md-12">

					                		<div class="form-group">

						                  		<label> Remark :  <span class="required-field"></span></label>

							                  	<div class="input-group">

							                      	<span class="input-group-addon"><i class="fa fa-building-o"></i></span>
							                       	<textarea type="text" class="form-control" name="remark" id="remark" value="" placeholder="Enter Remark" autocomplete="off" rows="3"></textarea>

							                 	</div>

							                 	<input type="hidden" name="" id="datatblremark">

					                		</div><!-- /.form-group -->

					              		</div><!-- /.col -->
			        					
			        				</div><!-- /.row -->

			        			</div>
			        			
			        		</div> <!-- /. row -->

			        		<div style="text-align: center;margin-top:2%;">

			        			<small style="color:red;font-weight:700" id="amtMsg"></small><br>
			        			<small style="color:red;font-weight:700" id="reqMsg"></small><br>

			        			<input type="hidden" id="payAdvTblData" name="payAdvTblData">
						
								<button type="button" name="submit" value="submit" disabled id="submitposting" class='btn btn-success' style="width: 16%;" onclick="submitAllData(0)">&nbsp;Post&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button> 		   

								<button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>     		
								
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

/* ---------- get vrno against series code ------------- */
	
	function getvrnoBySeries(){
		
		var seriesCd =  $('#series_code').val();
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

	   			url:"{{ url('get-last-no-vr-sequence-by-series-new') }}",
	         	method : "POST",
	         	type: "JSON",
	         	data: {seriesCode: seriesCode,transcode:transcode},
	         	success:function(data){
	         		var data1 = JSON.parse(data);
	         		if (data1.response == 'error') {

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

		                if(data1.glList == ''){

		                }else{
		                	var pfct_code = (data1.glList[0].PFCT_CODE == null) ? '':data1.glList[0].PFCT_CODE;
		                	var pfct_name = (data1.glList[0].PFCT_NAME == null) ? '':data1.glList[0].PFCT_NAME;
		                	$('#profitId').val(pfct_code);
		                	$('#profit_name').val(pfct_name);
		                }

		               	if(data1.data ==''){

		               	}else{
		               		$("#gl_code").val(data1.data[0].GL_CODE);
		                  	$("#gl_name").val(data1.data[0].GL_NAME);

		               	}

		               	/* ----- get bank code of series gl ----- */

		               	if(data1.bank_seriesGl == ''){

		               	}else{
		               		$('#bankOfSeriesGl').val(data1.bank_seriesGl[0].BANK_CODE);
		               	}

		               	/* ----- get bank code of series gl ----- */

		               	/* ---------- get cheque no deatils ------- */

	                    $("#chequeNoList").empty();

	                    if(data1.chqNoList == ''){
	                      	$('#IsChequeBookOpen').val('NO');
	                    }else{
	                      	$('#IsChequeBookOpen').val('');
	                      	$('#IsChequeBookOpen').val('YES');
	                        $.each(data1.chqNoList, function(k, getData){

	                            var upId = getData.CHEQUENO+'~'+getData.CHQBHID+'~'+getData.CHQBBID+'~'+getData.SLNO;
	                            $("#chequeNoList").append($('<option>',{

	                              value:getData.CHEQUENO,
	                              'data-xyz':upId

	                            }));

	                        });

	                     }

	                    /* ---------- get cheque no deatils ------- */

	                    /* ----------- set instrument type if bank is same ------- */
						
						var bankserieslGl = $('#bankOfSeriesGl').val();
						var amount        = parseFloat($('#dr_amount').val());
						var bankData      = $('#bankCode').val();
						var dataSplit     = bankData.split('-');
						var bank_code     = dataSplit[0];
						var bank_name     = dataSplit[1];
						var f_amount      = parseFloat(200000);

	                    if(bankserieslGl == bank_code){
	                    	$('#inst_type').val('FT');
	                    }else{
	                    	if(amount < f_amount){
	                    		$('#inst_type').val('NEFT');
	                    	}else if(amount >= f_amount){
	                    		$('#inst_type').val('RT');
	                    	}
	                    }
	                    /* ----------- set instrument type if bank is same------- */

	                    var remarkF   = $('#datatblremark').val();
						var instTypeF = $('#inst_type').val();
						var cheNoF    = $('#cheque_no').val();
					
						var newRemark = remarkF+'/'+instTypeF+'/'+cheNoF;
						console.log('newRemark',newRemark);
						$('#remark').val('');
						$('#remark').val(newRemark);

	            	} /* /. success */
	         	} /* /. success function */
	   		}); /* /. ajax function */

		}
		setTimeout(function() {
			fieldValidation();
		}, 500);
	} /* /. main function */


	function fieldValidation(){

		var sereisCd = $('#series_code').val();
		var pfctCd   = $('#profitId').val();
		console.log('pfctCd',pfctCd);
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

	function changechqdate(datevalue){

		$('#vr_date,#profitId,#series_code').prop('readonly',true);
		$(".transdatepicker" ).datepicker( "destroy" )

      	var intType =  $('#inst_type').val();

      	var xyz = $('#InstTypeList option').filter(function() {

          	return this.value == intType;

        }).data('xyz');

 	 	var msg = xyz ?  xyz : 'No Match';
      	if(msg == 'No Match'){
        	$('#intTypeName').val('');
      	}else{
        	$('#intTypeName').val(msg);
      	}

      	var insttype = $("#inst_type").val();
      	var vrDate = $("#vr_date").val();

      	if(insttype=='CH'){
	        $('#cheque_no,#chquedate').prop('readonly',false);
	        $("#showDate").removeClass('chqDateHide');
	        $('#chquedate').val(vrDate);
      	}else{
	        $('#cheque_no,#chquedate').prop('readonly',true);
	        $("#showDate").addClass('chqDateHide');
	        $('#cheque_no').val('');
	        $('#chquedate').val('');
      	}


      	/* ------ REMARK FIELD --------- */

			var remarkF   = $('#datatblremark').val();
			var instTypeF = $('#inst_type').val();
			var cheNoF    = $('#cheque_no').val();
		
			var newRemark = remarkF+'/'+instTypeF+'/'+cheNoF;
			
			$('#remark').val('');
			$('#remark').val(newRemark);

      	/* ------ REMARK FIELD --------- */

      	var drAmt = parseFloat($('#dr_amount').val());
      	var f_amount = parseFloat(500000);

      	if(insttype == 'IMPS'){

      		if(drAmt > f_amount){

      			$('#amtMsg').html('Amount is greater than '+drAmt+' IMPS limit');
      		}else{
      			$('#amtMsg').html('');
      		}

      	}else{
      		$('#amtMsg').html('');
      	}

    }

    function getdicbypay(slno){

      	var cheQno =  $('#cheque_no').val();
      	var vr_type =  $('#vr_type').val();

      	var xyz = $('#chequeNoList option').filter(function() {

          	return this.value == cheQno;

        }).data('xyz');

      	var msg = xyz ?  xyz : 'No Match';

      	var chqListAvail = $('#IsChequeBookOpen').val();

      	if(chqListAvail == 'YES'){

	        if(msg == 'No Match'){
	          $('#cheque_no').val('');
	          $('#chkTblId').val('');
	        }else{
	          $('#chkTblId').val(msg);
	        }

      	}

      	/* ------ REMARK FIELD --------- */

			var remarkF   = $('#datatblremark').val();
			var instTypeF = $('#inst_type').val();
			var cheNoF    = $('#cheque_no').val();
		
			var newRemark = remarkF+'/'+instTypeF+'/'+cheNoF;
			console.log('newRemark',newRemark);
			$('#remark').val('');
			$('#remark').val(newRemark);

      	/* ------ REMARK FIELD --------- */

      
  	}

/* ---------- get vrno against series code ------------- */

/* ---------- START : SEARCH DATA -----------------*/

    function load_data(accCode=''){
          
      $('#tblPostData').DataTable({

			processing: true,
         	serverSide: true,
         	scrollY: '150px',
          	ajax:{
	            url:'{{ url("Transaction/get-posting-data-against-account") }}',
	            data: {accCode:accCode},
	            method:"POST",
          	},
          	columns: [
          	{
                data:'DT_RowIndex',
                'render': function (data, type, full, meta){
                  //console.log('full',bodyid);
                  return '<input type="checkbox" name="chkData_id[]" class="pb_checkitm selectDataPA" value="'+full['PAYID'] +'~'+full['COMP_CODE'] +'~'+full['FY_CODE'] +'~'+full['SERIES_CODE']+'~'+full['VRNO']+'~'+full['SLNO']+'">';
                }
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
              data:'ADVICE_AMT',
              name:'ADVICE_AMT',
              className:'adviceAmtCls'
            },
            {
              data:'REMARK',
              name:'REMARK',
              className:'remarkCls'
            },	
          ]

      });

    }

    $(document).ready(function(){

    	$("#tblPostData").on('change', function() {

    		var checkedCount = $("#tblPostData input:checked").length;
    		if(checkedCount > 0){
    			$('#selOkdata').prop('disabled',false);
    			$('#btnsearch').prop('disabled',true);
				$('#acc_code').prop('readonly',true);
    		}else{
    			$('#selOkdata').prop('disabled',true);
    			$('#btnsearch').prop('disabled',false);
				$('#acc_code').prop('readonly',false);
    		}

    	});

    });	

    function checkDataSel(){
    	var checkedCount = $("#tblPostData input:checked").length;

    	var totalAmt=0;
		var remarkTxt=[];
		for(var i=0; i<checkedCount; i++) {

			var amount = $("#tblPostData input:checked")[i].parentNode.parentNode.children[4].innerHTML;
			var remark = $("#tblPostData input:checked")[i].parentNode.parentNode.children[5].innerHTML;
			remarkTxt.push(remark);

			if (amount != "") {
            totalAmt += parseFloat(amount);
          	}else{
            totalAmt = 0;

          	}

		}/* /. for loop*/

		var paymentid = [];

        $(".selectDataPA").each(function (){
              
            if($(this).is(":checked")){

              paymentid.push($(this).val());
            }
        });

        $('#payAdvTblData').val(paymentid);

		$('#btnsearch').prop('disabled',true);
		$('#acc_code').prop('readonly',true);
		$('.selectDataPA').prop('disabled',true);

		var accCodeGet = $('#acc_code').val();
		var accNameGet = $('#acc_NameS').val();

		$('#accCode').val(accCodeGet);
		$('#accName').val(accNameGet);
		$('#dr_amount').val(totalAmt);
		$('#remark').val(remarkTxt);
		$('#datatblremark').val(remarkTxt);

		$('#series_code').prop('readonly',false);

    }

    function showselectedData(payAdviceId,compCd,fyCd,sereisCd,vrNo,slNo,accCode,accName,drAmt,remark){

    	$('#btnsearch').prop('disabled',true);
    	$('#acc_code').prop('readonly',true);

    	var payAdvData = payAdviceId+'~'+compCd+'~'+fyCd+'~'+sereisCd+'~'+vrNo+'~'+slNo;

    	$('#accCode').val(accCode);
    	$('#accName').val(accName);
    	$('#dr_amount').val(drAmt);
    	$('#remark').val(remark);
    	$('#datatblremark').val(remark);
    	$('#payAdvTblData').val(payAdvData);

    	/* ------ REMARK FIELD --------- */

			var remarkF   = $('#datatblremark').val();
			var instTypeF = $('#inst_type').val();
			var cheNoF    = $('#cheque_no').val();
		
			var newRemark = remarkF+'/'+instTypeF+'/'+cheNoF;
			
			$('#remark').val('');
			$('#remark').val(newRemark);

      	/* ------ REMARK FIELD --------- */


    	fieldValidation();
    }

   	$(document).ready(function(){

   		$( window ).on( "load", function() {

	      getvrnoBySeries();
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

	        $('.chqdatepicker').datepicker({

	          format: 'dd-mm-yyyy',
	          orientation: 'bottom',
	          todayHighlight: 'true',
	          startDate :fromdateintrans,
	          endDate : todateintrans,
	          autoclose: 'true'
	        });

	    });

   		$('#btnsearch').click(function(){
        
			var accCode = $('#acc_code').val();

			if(accCode != ''){
				$('#errMsg').html('');
				$('#tblPostData').DataTable().destroy();
	     		load_data(accCode);
	    	}else{
	    		$('#errMsg').html('The Acc Code field is required.');
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
		
		$('#acc_code').on('change',function(){

	    	var acccode =  $('#acc_code').val();

	        var xyz = $('#accList option').filter(function() {

	            return this.value == acccode;

	        }).data('xyz');

        	var msg = xyz ?  xyz : 'No Match';

        	if(msg == 'No Match'){
        		$('#acc_code').val('');
        		$('#glCode').val('');
        		$('#glName').val('');
        		$('#bankCode').val('');
        		$('#bank_accNo').val('');
        		$('#acc_NameS').val('');
        	}else{
        		$('#glCode,#glName,#bankCode,#bank_accNo,#acc_NameS').val('');
        		
        		var slitMsg = msg.split('~');
        		var accName = slitMsg[0];
        		var glCode = slitMsg[1];
        		var glName = slitMsg[2];
        		var bankCd = (slitMsg[3] !='NO') ? slitMsg[3] :'';
        		var bankNm = (slitMsg[4] !='NO') ? slitMsg[4] :'';
        		var bankAccNo = (slitMsg[5]) ? slitMsg[5] :'';
        		var bankCdNm = bankCd+'-'+bankNm;
        		$('#glCode').val(glCode);
        		$('#glName').val(glName);
        		$('#bankCode').val(bankCdNm);
        		$('#bank_accNo').val(bankAccNo);
        		$('#acc_NameS').val(accName);

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

	    /*$('#cheque_no').on('change',function(){

	    	var chequeNo =  $('#cheque_no').val();

	        var xyz = $('#chequeNoList option').filter(function() {

	            return this.value == chequeNo;

	        }).data('xyz');

        	var msg = xyz ?  xyz : 'No Match';

        	if(msg == 'No Match'){
        		$('#cheque_no').val('');
        	}else{
        		$('#chequeTblData').val(msg);
        	}

	    });*/

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

		var accountGl = $('#accCode').val();
		var postingGl = $('#gl_code').val();
		var accGl     = $('#glCode').val();
		var bankCd    = $('#bankCode').val();

		if(accountGl && postingGl && accGl && bankCd){

			var data = $("#postingPayAdvice").serialize();
			
			$.ajaxSetup({
	     	 	headers: {

		          	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

		      	}
		    });

		    $.ajax({

	       	 	type: 'POST',
		        url: "{{ url('/transaction/account/save-postng-payment-advice') }}",
		        dataType: "json",
		        data: data, 
		        success: function (data) {

		          var data1 = JSON.parse(JSON.stringify(data));

		          if (data1.response == 'error') {
		            var responseVar = false;
		            var url = "{{url('/view-posting-payment-advice-success-msg')}}"
		            setTimeout(function(){ window.location = url+'/'+responseVar; });
		          }else{
		            var responseVar = true;

		            var fyYear   = data1.data[0].FY_CODE;
                  	var fyCd     = fyYear.split('-');
                  	var seriesCd = data1.data[0].SERIES_CODE;
                  	var vrNo     = data1.data[0].VRNO;
                  	var fileN    = 'CB_'+fyCd[0]+''+seriesCd+''+vrNo;
                  	var link = document.createElement('a');
                  	link.href = data1.url;
                  	link.download = fileN+'.pdf';
                  	link.dispatchEvent(new MouseEvent('click'));

		            var url = "{{url('/view-posting-payment-advice-success-msg')}}"
		            setTimeout(function(){ window.location = url+'/'+responseVar; });
		          }
		      
		        },
		    });

		}else{

			$('#reqMsg').html('* Fields is required ..... !');
		}

    }

</script>

@endsection