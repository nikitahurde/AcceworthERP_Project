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
	.fieldLable{
		font-size: 12px;
    	font-weight: 700;
    	color:#095e90;
	    float: right;
	}
	.displyinline{
	    display: flex;
  	}
  	.instTypeMode{
	   	width: 46%;
	    margin-bottom: 5px;
	    margin-right: 1px;
	}
	.tdsratebtnHide{
	  	display: none;
	}
	label{
		line-height:1;
	}
	.datehide{
    	display: none;
  	}
  	.toalvaldesn{
	    text-align: right;
	    font-weight: 800;
	    margin-top: 3px;
	}
	.debitotldesn{
	    margin-right: 5px;
	    width: 126px;
	    text-align: end;
	}
	.credittotldesn{
	    text-align: end;
	    width: 126px;
	}
	.btnstyle{
		padding:3px;
		font-size: 12px;
		line-height: 1;
	}
	.debitcreditbox{
		text-align: end;
	}
	.modltitletext{
	  	text-align: center;
    	font-weight: 700;
    	color: #5696bb;
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
  	.lableName{
		margin:0px;
		margin-top: 5px;
	    margin-bottom: 9px;
	}
	.tdsBtnStyle{
		margin-top: 5px;
		display:flex;
	}
	.iconBtnSty{
	    border-radius: 100px;
    	padding: 4px;
	}
	.tdsBtnSty{
	    font-weight: 600;
	    padding: 1px;
	    font-size: 10px;
	}
	.crdrInput{
		text-align:right;
		width:15%;
	}
	.glCodeCl{
		width:7%;
	}
	.nameIndbox{
		width:15%;
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
	.payAdcBtn{
		display:none;
	}
</style>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
	      Pdc Cheque Transaction
	      <small>Add Details</small>
	    </h1>

	    <ul class="breadcrumb">
	    	<li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="{{ url('/dashboard') }}">Transaction</a></li>
			<li class="active"><a href="{{ url('/finance/form-transaction-mast') }}"> Pdc Cheque</a></li>
			<li class="active"><a href="{{ url('/finance/form-transaction-mast') }}">Add Pdc Cheque</a></li>
	    </ul>
	</section>

<form id="cahsbanktrans">
    @csrf
	<section class="content">
		<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary Custom-Box">

					<div class="box-header with-border" style="text-align: center;">

			            <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Pdc Cheque Transaction</h2>
			            <div class="box-tools pull-right">
			              <a href="{{ url('/finance/view-cash-bank') }}" class="btn btn-primary" style="margin-right: 10px;padding: 1px 5px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>
			            </div>

        	 		</div><!-- /.box-header -->
	        
		        	<div class="box-body">

		        		<div class="row">

		        			<div class="col-md-2">

			                	<div class="form-group">

			                  		<label>Date: <span class="required-field"></span></label>
			                    
			                    	<div class="input-group">
			                     	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				                      <?php 

				                        $CurrentDate = date("d-m-Y");
				                        $FromDate    = date("d-m-Y", strtotime($fromDate));  
				                        $ToDate      = date("d-m-Y", strtotime($toDate));  
				                        $spliDate    = explode('-', $CurrentDate);
				                        $yearGet     = Session::get('macc_year');
				                        $fyYear      = explode('-', $yearGet);
				                        $get_Month   = $spliDate[1];
				                        $get_year    = $spliDate[2];

				                        if($get_Month >3 && $get_year == $fyYear[1]){
				                            $vrDate = $ToDate;
				                        }else{
				                            $vrDate = $CurrentDate;
				                        }

				                      ?>
			                      	<input type="hidden" id="fy_year" value="{{$yearGet}}">
			                      	<input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
			                      	<input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
			                      	<input type="text" class="form-control  transdatepicker rightcontent" name="vrDate" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date"  autocomplete="off">

			                    	</div>

			                    	<small id="showmsgfordate" style="color: red;"></small>

			                	</div><!-- /.form-group -->
		                
		              		</div><!-- /. col-->

			              	<div class="col-md-2">
	              
			                	<div class="form-group">

			                  	<label> T Code : <span class="required-field"></span></label>

				                  	<div class="input-group">

				                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

				                      <input type="text" class="form-control" name="tran_code" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

				                  	</div>

			                	</div><!-- /.form-group -->
			              	</div> <!-- /. col-->

			              	<div class="col-md-2">

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

					                     	@foreach ($getseries as $key)

					                      	<option value='<?php echo $key->SERIES_CODE; ?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>"><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

					                     	@endforeach

				                     	</datalist>

				                  	</div>
				                  	<small id="serscode_err" style="color: red;" class="form-text text-muted"></small>
				                 
				               	</div><!-- /.form-group -->
				            </div> <!-- /. col-->

				            <div class="col-md-3">

			                	<div class="form-group">

				                  <label>Series Name: 
				                    <span class="required-field"></span>
				                  </label>

				                  <div class="input-group">

				                    	<div class="input-group-addon">

				                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

				                    	</div>

				                    	<input type="text" id="seriesText" name="seriesname" class="form-control  pull-left" value="<?php if($getcount == 1){echo $getseries[0]->SERIES_NAME;}else{} ?>" placeholder="Select Series Name"  data-toggle="tooltip" data-placement="top">

				                  </div>
			                       
			                	</div><!-- /.form-group -->
			              	</div><!-- /.col -->

		              		<div class="col-md-2">

			                	<div class="form-group">
			                
				                  	<label> Vr No: </label>

				                  	<div class="input-group">

				                    	<span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
				                    
				                    	<input type="text" class="form-control rightcontent" name="vr_no" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off" >

				                  	</div>

		               	 		</div> 
		              		</div> 
		        			
		        		</div> <!-- /. row -->

		        		<div class="row">

		        			<div class="col-md-2">

		                		<div class="form-group">

		                    		<label>GL Code : <span class="required-field"></span></label>

				                  	<div class="input-group">
				                     	<span class="input-group-addon" style="padding: 1px 12px;">
				                        	<i class="fa fa-sort-numeric-asc" id="firsticon"></i>
				                        	<div class="" id="appndplantbtn"></div>
				                     	</span>
				                      
				                    	<input type="text" class="form-control" name="glCode" id="gl_code" value="{{ old('gl_code') }}" placeholder="Enter GL Code" readonly="" autocomplete="off">

				                  	</div>

		                		</div><!-- /.form-group -->

              				</div><!-- /. col-->

	              			<div class="col-md-3">

			                	<div class="form-group">

				                  	<label> GL Name : <span class="required-field"></span></label>

				                  	<div class="input-group tooltips">

				                      	<span class="input-group-addon"><i class="fa fa-building-o"></i></span>

				                      	<input type="text" class="form-control" name="glName" value="{{ old('gl_name') }}" id="gl_name" placeholder="Enter GL Name" readonly autocomplete="off">

				                      	<span class="tooltiptext tooltiphide" id="glNameTooltip"></span>
			                 	 	</div>

			                	</div><!-- /.form-group -->

			               	</div>

		        			<div class="col-md-2">

		                		<div class="form-group">

		                    		<label>Acc Code : <span class="required-field"></span></label>

				                  	<div class="input-group">
				                     	<span class="input-group-addon" style="padding: 1px 12px;">
				                        	<i class="fa fa-sort-numeric-asc" id="firsticon"></i>
				                        	<div class="" id="appndplantbtn"></div>
				                     	</span>
				                      
				                    	<input list="accList" class="form-control" name="accCode" id="acc_code" value="{{ old('acc_code') }}" placeholder="Enter GL Code"  autocomplete="off">

				                    	<datalist id='accList'>

				        					<?php foreach ($acc_list as $key) { ?>
				        							
				        							<option value="<?= $key->ACC_CODE ?>" data-xyz='<?= $key->ACC_NAME ?>'><?= $key->ACC_CODE ?> <?= $key->ACC_NAME ?></option>

				        					 <?php } ?>
				                    	</datalist>
				                    		
				                  	</div>

		                		</div><!-- /.form-group -->

              				</div><!-- /. col-->

	              			<div class="col-md-3">

			                	<div class="form-group">

				                  	<label> Acc Name : <span class="required-field"></span></label>

				                  	<div class="input-group tooltips">

				                      	<span class="input-group-addon"><i class="fa fa-building-o"></i></span>

				                      	<input type="text" class="form-control" name="accName" value="{{ old('acc_name') }}" id="acc_name" placeholder="Enter Acc Name" readonly autocomplete="off">

				                      	<span class="tooltiptext tooltiphide" id="glNameTooltip"></span>
			                 	 	</div>

			                	</div><!-- /.form-group -->

			               	</div><!-- /.col -->

		               		<div class="col-md-2">

		                		<div class="form-group">

			                  		<label> Vr Type :  <span class="required-field"></span></label>

				                  	<div class="input-group">

				                      	<span class="input-group-addon"><i class="fa fa-building-o"></i></span>
				                       
				                       	<select name="vrType" id="vr_type" class="form-control" disabled autocomplete="off" style="padding: 0px;">
				                          	<option value="">--Select--</option>
				                         	<option value="Payment">Payment</option>
				                         	<option value="Receipt">Receipt</option>
				                       	</select>

				                 	</div>

			                  		<small id="vr_type_err" style="color: red;"></small>
			                  		<input type="hidden" id="vrTypeData" name="vrTypeData">
		                		</div><!-- /.form-group -->

		              		</div><!-- /.col -->

		              		<!-- /.col -->

		        		</div> <!-- /. row -->

		        		<div class="row">

		        			<div class="col-md-2">

                				<div class="form-group">
                
                  					<label>Pfct Code: <span class="required-field"></span></label>

                  					<div class="input-group">

				                      	<div class="input-group-addon">

				                        	<i class="fa fa-newspaper-o" aria-hidden="true"></i>

				                      	</div>
		                      			<?php $pfcount = count($pfct_list); ?>
		                      			<input list="profitList"  id="profitId" name="pfctCode" class="form-control  pull-left" placeholder="Select Profit Center Code" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_CODE; }else{} ?>" readonly autocomplete="off">

				                     	<datalist id="profitList">

					                        @foreach ($pfct_list as $key)

					                        <option value='<?php echo $key->PFCT_CODE?>'   data-xyz ="<?php echo $key->PFCT_NAME; ?>" ><?php echo $key->PFCT_NAME ; echo " [".$key->PFCT_CODE."]" ; ?></option>

					                        @endforeach

				                     	</datalist>

                  					</div>
				                  	<small>  
				                      	<div class="pull-left showSeletedName" id="profitText"></div>
				                  	</small>
			                  		<small id="profit_center_err" style="color: red;"> </small>

                				</div><!-- /.form-group -->
              				</div><!-- /.col -->

              				<div class="col-md-3">

			                	<div class="form-group">

			                  		<label>Pfct Name: <span class="required-field"></span></label>

				                  	<div class="input-group">

					                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
					                    <div class="pull-left showSeletedName" id="profit_names"></div>
					                    <input type="text" class="form-control" id="profit_name" name="profitName" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_NAME; }else{} ?>" placeholder="Enter Profit Center Name" readonly>

				                  	</div>

			                  		<small id="comp_code_err" style="color: red;"></small>
			                  
			                	</div><!-- /.form-group -->
		             		</div>

		        			<div class="col-md-2">

		                		<div class="form-group">

		                  			<label>From Cheque No</label>

		                    		<div class="input-group">

			                     		<div class="input-group-addon">

				                        	<i class="fa fa-newspaper-o" aria-hidden="true"></i>

				                     	</div>
		                      			
		                      			<input type="text" class="form-control" id="chequeNo" name="chequeNo" placeholder="From Cheque No" value=""  autocomplete="off">

		                      			

		                    		</div>
			                    	<small>  

			                        <div class="pull-left showSeletedName" id="saleRText"></div>

			                    	</small>

		                    		<small id="saleR_err" style="color: red;"> </small>

		                		</div><!-- /.form-group -->
		              		</div><!--  /.col -->

		              		<div class="col-md-2">

		                		<div class="form-group">

		                  			<label>Cheque Of Cheque</label>

		                    		<div class="input-group">

			                     		<div class="input-group-addon">

				                        	<i class="fa fa-newspaper-o" aria-hidden="true"></i>

				                     	</div>
		                      			
		                      			<input type="text" class="form-control" id="Nocheque" name="Nocheque" placeholder="Select Cheque Of Cheque" value=""  autocomplete="off">

		                    		</div>
			                    	<small>  

			                        <div class="pull-left showSeletedName" id="saleRText"></div>

			                    	</small>

		                    		<small id="saleR_err" style="color: red;"> </small>

		                		</div><!-- /.form-group -->
		              		</div>

		              		<div class="col-md-2">

		                		<div class="form-group">

		                  			<label>Amount</label>

		                    		<div class="input-group">

			                     		<div class="input-group-addon">

				                        	<i class="fa fa-newspaper-o" aria-hidden="true"></i>

				                     	</div>
		                      			
		                      			<input type="text" class="form-control" id="tempAmount" name="tempAmount" placeholder="Select Ammount" value=""  autocomplete="off">

		                    		</div>
			                    	<small>  

			                        <div class="pull-left showSeletedName" id="saleRText"></div>

			                    	</small>

		                    		<small id="saleR_err" style="color: red;"> </small>

		                		</div><!-- /.form-group -->
		              		</div>

		              		
		        			
		        		</div> <!-- /. row -->

		        		<div class="row">
		        			<div class="col-md-2">

			                	<div class="form-group">

			                  		<label>Cheque Start Date: <span class="required-field"></span></label>
			                    
			                    	<div class="input-group">
			                     	<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				                     
			                     
			                      	<input type="text" class="form-control  transdatepicker rightcontent" name="chqstartDate" id="chqstartDate" value="{{ $vrDate }}" placeholder="Select Date"  autocomplete="off">

			                    	</div>

			                    	<small id="showmsgfordate" style="color: red;"></small>

			                	</div><!-- /.form-group -->
		                
		              		</div>
		        			<div class="col-md-2">
		              			<div class="form-group">
		              				<div class="input-group">
		              			    <button class="btn btn-primary btnstyle btn-xs" type="button" id="cheuqebtn" onclick="getcheuqeData()" style="margin-top: 18px;font-size: 12px;line-height: 1"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Proceed</button>
		              			  </div>
		              			</div>
		              		</div>
		        			
		        		</div>

		        	</div> <!-- /. box body -->

				</div> <!-- /. custom box -->
			</div> <!-- /. col 12 -->
		</div> <!-- /. row -->
	</section> <!-- /. section -->

	<section class="content" style="margin-top: -10%;">
		<div class="row">
			<div class="col-sm-1"></div>
			<div class="col-sm-10">
				<div class="box box-primary Custom-Box">
					<div class="box-body">
						<div class="table-responsive">
							<table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
								<tr>
				                    
				                    <th>Sr.No.</th>
				                    <th style="text-align: center;">Cheque No</th>
				                    <th style="text-align: center;">Cheque Date</th>
				                    <th style="text-align: center;">Amount</th>			          
				                    <th style="text-align: center;">Particuler</th>			          
			                  	</tr>

							</table> <!--  table -->
						</div><!-- /.table-responsive -->


						<div class="row" style="text-align:center;"> 
                
			                <input type="hidden" name="rowCount" id="rowCount" value="">
			                <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
			               
			                <button class="btn btn-success btnstyle" type="button" id="submitdata" onclick="submitCBData()" ><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>
			                <button class="btn btn-warning btnstyle" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>
			             

		              	</div><!-- /. row-->

					</div><!-- /.box-body -->
				</div><!-- /.custom box -->
			</div><!-- /.col -->
			<div class="col-sm-1"></div>
		</div><!-- /. row -->
	</section><!-- /. section -->



</form>
	
</div> <!-- /. content wrapper -->

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/PdcChqTranJs.js') }}" ></script>



<!--  -------- add more functionality -------- -->

<script type="text/javascript">
	
	$( window ).on( "load", function() {

        getvrnoBySeries();

    });


    $("#acc_code").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#accList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
             $("#acc_name").val('');
             $("#acc_code").val('');
             

          }else{

            $("#acc_name").val(msg);
           
          }

        });


    function getcheuqeData(){

     var count = $('table tr').length;

     var nocheque = $('#Nocheque').val();
     var chequeNo = $('#chequeNo').val();
     var Amount = $('#tempAmount').val();

     	//var countCheque = nocheque.length();


     		console.log(nocheque);



     		for (var i = 0; i < nocheque; i++) {


     			var icount = i + 1;

     			        var vrDate   = $('#chqstartDate').val();
				        var splitDt  = vrDate.split('-');
				        var newVrDt  = splitDt[1]+'-'+splitDt[0]+'-'+splitDt[2];

				        var dateForm = new Date(newVrDt);
				        var n = dateForm.getDate();
				        dateForm.setDate(1);
				        dateForm.setMonth(dateForm.getMonth() + icount);
				        dateForm.setDate(Math.min(n, getDaysInMonth(dateForm.getFullYear(),dateForm.getMonth())));
				        
				        var Lyear = dateForm.getFullYear();

				        var d = new Date(dateForm);
				        var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
				        var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

				        var formMatureDt =da+'-'+mo+'-'+Lyear;

     			

     			var checNumber = parseInt(chequeNo) + parseInt(i);
     			
     			 var data="<tr><td class='tdthtablebordr' style='width:5%;text-align:center;'>"+icount+"</td>"+
			    	"<td class='tdthtablebordr' style='width:9%;text-align:right;'><input type='text' id='chequeNo"+icount+"' name='chequeNo[]' value='"+checNumber+"'  style='text-align:right;' readonly></td>"+
			    	"<td class='tdthtablebordr' style='width:9%;text-align:right;'><input type='text' class='transdatepicker rightcontent' id='checkDate"+icount+"' name='checkDate[]' value='"+formMatureDt+"' style='text-align:right;'></td>"+
			    	"<td class='tdthtablebordr' style='width:9%;text-align:right;'><input type='text' id='Amount"+icount+"' name='Amount[]' value='"+Amount+"' style='text-align:right;'></td>"+
			    	"<td class='tdthtablebordr' style='width:20%;'><input type='text' id='Particuler"+icount+"' name='Particuler[]' style='width:95%;' value='By Cheque No "+checNumber+" By Date "+formMatureDt+"'></td></tr>";
	    	      $('table').append(data);

	    	            
     		}

    	


    }


    function isLeapYear(year) { 
    return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0)); 
  }

  function getDaysInMonth(year, month) {
      return [31, (isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
  }

</script>


<!--  -------- add more functionality -------- -->

<script>

/* ---------- get vrno against series code ------------- */
	
	function getvrnoBySeries(){
		var seriesCode = $('#series_code').val();
    	var transcode = $('#transcode').val();

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
	                 	if(data1.vrno_series){
	                   		var getlastno = data1.vrno_series.LAST_NO;
	                 	}else{
	                   		var getlastno = '';
	                 	}

	                 	if(data1.vrnodata == ''){
		                   	$('#vrseqnum').val(getlastno);
		                   	$('#hidnvrseq').val(getlastno);
	                 	}else{
		                   	var lastNo = parseInt(getlastno) + parseInt(1);
		                   	$('#vrseqnum').val(lastNo);
		                   	$('#hidnvrseq').val(lastNo);
	                 	}
	               	}

	               	if(data1.data ==''){

	               	}else{
	               		$("#gl_code").val(data1.data[0].GL_CODE);
	                  	$("#gl_name").val(data1.data[0].GL_NAME);

	                  	var glcodeh = $('#gl_code').val();
	                  	if(glcodeh){
		                  	$('#firsticon').css('display','none');
		                  	$('#appndplantbtn').html('<button type="button" data-toggle="modal" data-target="#gl_detail" onclick="getgldata()" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;font-size: 9px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
	                  	}
	               	}

	               	/* ---------- get cheque no deatils ------- */

                      console.log('data1.chqNoList',data1.chqNoList);
                      $("#chequeNoList1").empty();

                      if(data1.chqNoList == ''){

                      }else{


                        $.each(data1.chqNoList, function(k, getData){

                            var upId = getData.CHEQUENO+'~'+getData.CHQBHID+'~'+getData.CHQBBID+'~'+getData.SLNO;
                            $("#chequeNoList1").append($('<option>',{

                              value:getData.CHEQUENO,

                              'data-xyz':upId


                            }));

                        });

                      }
                    /* ---------- get cheque no deatils ------- */

            } /* /. success */
         } /* /. success function */
   	}); /* /. ajax function */
	} /* /. main function */

	function getgldata(){

	   $.ajaxSetup({

	            headers: {

	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

	            }

    	});

    	var series_code =  $('#series_code').val();

    	$.ajax({

            url:"{{ url('gl_code_by_series_code') }}",

            method : "POST",

            type: "JSON",

            data: {series_code: series_code},

            success:function(data){

               var data1 = JSON.parse(data);
                    
               if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                            
               }else if(data1.response == 'success'){

                  if(data1.data==''){

                  }else{
                        
                     $('#glschcshow').html(data1.gl_data.GLSCH_CODE);
                     $('#glcdshow').html(data1.gl_data.GL_CODE);
                     $('#glnshow').html(data1.gl_data.GL_NAME);
                     $('#gltypeshow').html(data1.gl_data.GLSCH_TYPE);


                  }

               }
           	}
	 	});

	}


	


	

/* --------- BILL TRACK MODAL ----------- */

	$(document).ready(function() {

		/*$("#PurchaseBillManage").on('change', function() {

		});
*/
	    var na = 1;
	    $('.tabnext').each(function() {         
	        $(this).attr('tabindex', na++);
	    });

	    $('body').on('focus',".form_date", function(){
	      $(this).datepicker({
	              format: 'dd-mm-yyyy',
	              orientation: 'bottom',
	              todayHighlight: 'true',
	              autoclose: 'true'

	        });
	    });

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


	function submitCBData(valp){

	
    	var data = $("#cahsbanktrans").serialize();


      		$.ajaxSetup({
	     	 	headers: {

		          	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

		      	}
		    });


		    $.ajax({

		        type: 'POST',
		        url: "{{ url('/save-pdc-cheque-transaction') }}",
		        dataType: "json",
		        data: data, 

		        success: function (data) {

		        	console.log(data);


		          var data1 = JSON.parse(JSON.stringify(data));

		         if (data1.response == 'error') {
		            var responseVar = false;
		            var url = "{{url('/view-cash-bank-success-msg')}}"
		            setTimeout(function(){ window.location = url+'/'+responseVar; });
		          }else{
		           
		            var url = "{{url('/view-cash-bank-success-msg')}}"
		            setTimeout(function(){ window.location = url+'/'+responseVar; });
		          }
		      
		        },
		    });

      	/* /. else*/
	    

}

</script>




@endsection