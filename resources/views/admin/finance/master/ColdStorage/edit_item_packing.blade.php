@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

	.required-field::before {
		content: "*";
		color: red;
	}
  	.showinmobile{
	  display: none;
	}
	.beforhidetble{
	  display: none;
	}
	.setetxtintd{
	    font-size: 12px !important;
	    padding-top: 2% !important;
	    padding-bottom: 2% !important;
	}
	.nameheading{
	    font-size: 12px;
	}
	.setheightinput{
	    height: 0%;
	}
	.custom-options {
		position: absolute;
		display: block;
		top: 100%;
		left: 0;
		right: 0;
		border-top: 0;
		background: #f3eded;
		transition: all 0.5s;
		opacity: 0;
		visibility: hidden;
		pointer-events: none;
		z-index: 2;
		-webkit-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
		-moz-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
		box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
	}
	.custom-select .custom-options {
		opacity: 1;
		visibility: visible;
		pointer-events: all;
	}
	.custom-option {
		position: relative;
		display: block;
		padding-top: 10px;
		padding-left: 21%;
		font-size: 14px;
		font-weight: 600;
		color: #3b3b3b;
		line-height: 2px;
		cursor: pointer;
		transition: all 0.5s;
	}
	.CloseListDepot{
	  display: none;
	}
	@media screen and (max-width: 600px) {

		.showinmobile{
			display: block;
		}
		.PageTitle{
			float: left;
		}
	}
	::placeholder {
	    text-align:left;
  	}
	.numberRight{
		text-align:end;
	}

</style>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

        <h1>Master Item Packing

	        <small>Add Details</small>

        </h1>

        <ol class="breadcrumb">

        	<li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

        	<li><a href="{{ URL('/dashboard')}}">Master</a></li>


            <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Master Item Packing</a></li>

            <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Update Item Packing</a></li>

        </ol>

    </section>

    <section class="content">

    	<div class="row">

    		<div class="col-sm-12">

    			<div class="box box-primary Custom-Box">


    				<div class="box-header with-border" style="text-align: center;">

    					<h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Master Item Packing</h2>

						<div class="box-tools pull-right showinmobile">

							<a href="{{ url('/Master/ColdStorage/View-Item-Packing-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Packing</a>

						</div>

              			<div class="box-tools pull-right">

		          			<a href="{{ url('/Master/ColdStorage/View-Item-Packing-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Packing</a>

		        		</div>

            		</div><!-- /.box-header -->

            		@if(Session::has('alert-success'))

	              		<div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

	                		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

	                		<h4><i class="icon fa fa-check"></i> Success...!</h4>

	                 		{!! session('alert-success') !!}

	                 	</div>

	                @endif

	                @if(Session::has('alert-error'))

		                <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

		                	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

		                	<h4><i class="icon fa fa-ban"></i>Error...!</h4>

			                {!! session('alert-error') !!}

			            </div>

			        @endif

			        <div class="box-body">

			        	<form action="{{ url('Master/ColdStorage/item-packing-Update') }}" method="POST" >
			        		@csrf

			        		<div class="row">

			        			<div class="col-md-2">

			        				<div class="form-group">

			        					<label>Item Code :<span class="required-field"></span></label>

			        					<div class="input-group">

			        						<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

			        						<input list="itemList" class="form-control" name="item_code" placeholder="Enter Item Code"  id="item_code" value="{{ $classData->ITEM_CODE }}" readonly>

			        						<datalist id="itemList">

			        							<?php foreach($item_list as $key) { ?>

			        								<option value="<?= $key->ITEM_CODE ?>" data-xyz="<?= $key->ITEM_NAME ?>"><?= $key->ITEM_CODE ?> - <?= $key->ITEM_CODE ?></option>

			        							<?php } ?>

			        						</datalist>

			        					</div>

			        					<small id="emailHelp" class="form-text text-muted">

			        						{!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}

			        					</small>

			        				</div>

			        			</div>

			        			<div class="col-md-2">

			        				<div class="form-group">

			        					<label>Item Name :<span class="required-field"></span></label>

			        					<div class="input-group">

			        						<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

			        						<input type="text" class="form-control" name="item_name" placeholder="Enter Item Name"  id="item_name" value="{{ $classData->ITEM_NAME }}" readonly autocomplete="off">

			        					</div>

			        					<small id="emailHelp" class="form-text text-muted">

			        						{!! $errors->first('item_name', '<p class="help-block" style="color:red;">:message</p>') !!}

			        					</small>

			        				</div>

			        			</div>

			        			<div class="col-md-2">

			        				<div class="form-group">

			        					<label> UM : <span class="required-field"></span></label>

			        					<div class="input-group">

			        						<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

			        						<input type="text" class="form-control" name="um" id="UnitM" value="{{ $classData->UM }}" placeholder="Enter Um" maxlength="2" readonly="">

			        					</div> 

			        					<small id="emailHelp" class="form-text text-muted">

			        						{!! $errors->first('um', '<p class="help-block" style="color:red;">:message</p>') !!}

			        					</small>

			        				</div>

			        			</div>

			        			<div class="col-md-2">

			        				<div class="form-group">

			        					<label>AUM : <span class="required-field"></span></label>

			        					<div class="input-group">

			        						<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

			        						<input type="text" class="form-control" name="aum" id="AddUnitM" value="{{ $classData->AUM }}" placeholder="Enter AUM" maxlength="2" readonly="">

			        					</div> 

			        					<small id="emailHelp" class="form-text text-muted">

			        						{!! $errors->first('aum', '<p class="help-block" style="color:red;">:message</p>') !!}

			        					</small>

			        				</div>

			        			</div>

			        			<div class="col-md-2">

			        				<div class="form-group">

			        					<label>Packing ID : <span class="required-field"></span></label>

			        					<div class="input-group">

			        						<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

			        						<input type="text" class="form-control" name="packing_id" id="packing_id" value="{{ $classData->PACKING_ID }}" placeholder="Enter Packing Id" maxlength="40" readonly>

			        					</div> 

			        					<small id="emailHelp" class="form-text text-muted">

			        						{!! $errors->first('packing_id', '<p class="help-block" style="color:red;">:message</p>') !!}

			        					</small>

			        				</div>

			        			</div>

			        			<div class="col-md-2">

			        				<div class="form-group">

			        					<label>Packing Name : <span class="required-field"></span></label>

			        					<div class="input-group">

			        						<span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

			        						<input type="text" class="form-control" name="packing_name" id="packing_name" value="{{ $classData->PACKING_NAME }}" placeholder="Enter Packing Name" maxlength="40">

			        					</div> 

			        					<small id="emailHelp" class="form-text text-muted">

			        						{!! $errors->first('packing_name', '<p class="help-block" style="color:red;">:message</p>') !!}

			        					</small>

			        				</div>

			        			</div>

			        		</div>

			        		<div class="row">

			        			<div class="col-md-2">

			        				<div class="form-group">

			        					<label>C Factor : <span class="required-field"></span></label>

			        					<div class="input-group">

			        						<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

			        						<input type="text" class="form-control numberRight" name="c_factor" id="Cfactor" value="{{ $classData->C_FACTOR }}" placeholder="Enter C factor" maxlength="10" readonly>

			        					</div>

			        					<small id="emailHelp" class="form-text text-muted">

			        						{!! $errors->first('c_factor', '<p class="help-block" style="color:red;">:message</p>') !!}

			        					</small>

			        				</div>

			        			</div>

			        			<div class="col-md-2">

			        				<div class="form-group">

			        					<label>Rate (Rent PM) : <span class="required-field"></span></label>

			        					<div class="input-group">

			        						<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

			        						<input type="text" class="form-control numberRight" name="rate" id="rate" value="{{ $classData->RATE }}" placeholder="Enter Rate (Rent PM)" maxlength="40">

			        					</div> 

			        					<small id="emailHelp" class="form-text text-muted">

			        						{!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}

			        					</small>

			        				</div>

			        			</div>

			        			<div class="col-md-2">

			        				<div class="form-group">

			        					<label> Length : <span class="required-field"></span></label>

			        					<div class="input-group">

			        						<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

			        						<input type="text" class="form-control numberRight calcScace" name="length" id="length" value="{{ $classData->LENGTH }}" placeholder="Enter length" maxlength="10">

			        					</div>

			        					<small id="emailHelp" class="form-text text-muted">

			        						{!! $errors->first('length', '<p class="help-block" style="color:red;">:message</p>') !!}

			        					</small>

			        				</div>

			        			</div>

								<div class="col-md-2">

									<div class="form-group">

								  		<label>Width : <span class="required-field"></span></label>

								  		<div class="input-group">

								  			<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

								  			<input type="text" class="form-control numberRight calcScace" name="width" id="width" value="{{ $classData->WIDTH }}" placeholder="Enter width" maxlength="10">

								  		</div> 

								  		<small id="emailHelp" class="form-text text-muted">

								  			{!! $errors->first('width', '<p class="help-block" style="color:red;">:message</p>') !!}

								  		</small>

								  	</div>

								</div>

								<div class="col-md-2">

									<div class="form-group">

										<label>Height : <span class="required-field"></span></label>

										<div class="input-group">

											<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

											<input type="text" class="form-control numberRight calcScace" name="height" id="height" value="{{ $classData->HEIGHT }}" placeholder="Enter height" maxlength="10">

										</div> 

										<small id="emailHelp" class="form-text text-muted">

											{!! $errors->first('height', '<p class="help-block" style="color:red;">:message</p>') !!}

										</small>

									</div>

								</div>

								<div class="col-md-2">

									<div class="form-group">

										<label> Cubic Space : <span class="required-field"></span></label>

										<div class="input-group">

											<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

											<input type="text" class="form-control numberRight" name="cubic_space" id="cubic_space" value="{{ $classData->CUBIC_SPACE }}" placeholder="Enter Cubic Space" maxlength="40" readonly>

										</div> 

										<small id="emailHelp" class="form-text text-muted">

											{!! $errors->first('cubic_space', '<p class="help-block" style="color:red;">:message</p>') !!}

										</small>

									</div>

								</div>

							</div>

							<div class="row">

								<div class="col-md-2">

									<div class="form-group">

										<label>HSN CODE :  <span class="required-field"></span></label>

										<div class="input-group">

											<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

											<input list="hsnList" class="form-control" name="hsn_code" id="hsn_code" value="{{ $classData->HSN_CODE }}" placeholder="Enter Hsn Code" maxlength="10" readonly>

						                  	<datalist id="hsnList">

						                  		<?php foreach ($hsn_list as $key) { ?>
						                  		
						                  		<option value="<?= $key->HSN_CODE ?>" data-xyz="<?= $key->HSN_NAME ?>"><?= $key->HSN_CODE ?> - <?= $key->HSN_NAME ?></option>

						                     	<?php	} ?>

						                  	</datalist>

						                </div> 

						                <small id="emailHelp" class="form-text text-muted">

						                	{!! $errors->first('hsn_code', '<p class="help-block" style="color:red;">:message</p>') !!}

						                </small>

						            </div>

						        </div>

						        <div class="col-md-2">

			        				<div class="form-group">

			        					<label>HSN Name :<span class="required-field"></span></label>

			        					<div class="input-group">

			        						<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

			        						<input type="text" class="form-control" name="hsn_name" placeholder="Enter HSN Name"  id="hsn_name" value="{{ $classData->HSN_NAME }}" readonly autocomplete="off">

			        					</div>

			        					<small id="emailHelp" class="form-text text-muted">

			        						{!! $errors->first('hsn_name', '<p class="help-block" style="color:red;">:message</p>') !!}

			        					</small>

			        				</div>

			        			</div>

						        <div class="col-md-2">

						        	<div class="form-group">

						        		<label>Rate Validate No Of Days : <span class="required-field"></span></label>

						        		<div class="input-group">

						        			<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

						        			<input type="text" class="form-control numberRight" name="no_days" id="no_days" value="{{ $classData->NO_DAYS }}" placeholder="Rate Validate No Of Days" maxlength="40">

						        		</div> 

						        		<small id="emailHelp" class="form-text text-muted">

						        			{!! $errors->first('no_days', '<p class="help-block" style="color:red;">:message</p>') !!}

						        		</small>

						        	</div>

						        </div>

						        <div class="col-md-2">

						        	<div class="form-group">

						        		<label>GST TAX %: <span class="required-field"></span></label>

						        		<div class="input-group">

						        			<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

						        			<input type="text" class="form-control" name="gst_no" id="gst_no" value="{{ $classData->GST_NO }}" placeholder="Enter gst" maxlength="10">

						        		</div> 

						        		<small id="emailHelp" class="form-text text-muted">

						        			{!! $errors->first('gst_no', '<p class="help-block" style="color:red;">:message</p>') !!}

						        		</small>

						        	</div>

						        </div>

						        <div class="col-md-2">

						        	<div class="form-group">

						        		<label>Min Qty 1: <span class="required-field"></span></label>

						        		<div class="input-group">

						        			<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

						        			<input type="text" class="form-control numberRight" name="min_qty1" id="min_qty1" value="{{ $classData->MIN_QTY1 }}" placeholder="Enter Min Qty 1" maxlength="10">

						        		</div> 

						        		<small id="emailHelp" class="form-text text-muted">

						        			{!! $errors->first('min_qty1', '<p class="help-block" style="color:red;">:message</p>') !!}

						        		</small>

						        	</div>

						        </div>

						        <div class="col-md-2">

						    		<div class="form-group">

						    			<label>Min Rate 1: <span class="required-field"></span></label>

						    			<div class="input-group">

						    				<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

						    				<input type="text" class="form-control numberRight" name="min_rate1" id="min_rate1" value="{{ $classData->MIN_RATE1 }}" placeholder="Enter Min Rate 1" maxlength="10">

						    			</div> 

						    			<small id="emailHelp" class="form-text text-muted">

						    				{!! $errors->first('min_rate1', '<p class="help-block" style="color:red;">:message</p>') !!}

						    			</small>

						    		</div>

						    	</div>

						    </div>

						    <div class="row">

						    	<div class="col-md-2">

						    		<div class="form-group">

						    			<label>Min Qty 2: <span class="required-field"></span></label>

						    			<div class="input-group">

						    				<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

						    				<input type="text" class="form-control numberRight" name="min_qty2" id="min_qty2" value="{{ $classData->MIN_QTY2 }}" placeholder="Enter  Min Qty 2" maxlength="10">

						    			</div> 

						    			<small id="emailHelp" class="form-text text-muted">

						    				{!! $errors->first('min_qty2', '<p class="help-block" style="color:red;">:message</p>') !!}

						    			</small>

						    		</div>

						    	</div>

						    	<div class="col-md-2">

						    		<div class="form-group">

						    			<label>Min Rate 2: <span class="required-field"></span></label>

						    			<div class="input-group">

						    				<span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

						    				<input type="text" class="form-control numberRight" name="min_rate2" id="min_rate2" value="{{ $classData->MIN_RATE2 }}" placeholder="Enter Min Rate 2" maxlength="10">

						    			</div> 

						    			<small id="emailHelp" class="form-text text-muted">

						    				{!! $errors->first('min_rate2', '<p class="help-block" style="color:red;">:message</p>') !!}

						    			</small>

						    		</div>

						    	</div>

						    	<div class="col-md-6">

				                    <div class="form-group">

				                      <label>Item Packing Block : <span class="required-field"></span></label>

				                      <div class="input-group">

				                        <input type="radio" class="optionsRadios1" name="item_packing_block" value="YES" <?php if($classData->ITEMPAKCING_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				                        <input type="radio" class="optionsRadios1" name="item_packing_block" value="NO" <?php if($classData->ITEMPAKCING_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

				                      </div>

				                      <small id="emailHelp" class="form-text text-muted">

				                        {!! $errors->first('item_packing_block', '<p class="help-block" style="color:red;">:message</p>') !!}

				                      </small>

				                    </div>

				                  </div>

						    </div>

						    

          					<div style="text-align: center;">
          						<input type="hidden" id="itempacking_id" name="itempacking_id" value="{{$classData->PACKING_ID}}">
          						<input type="hidden" id="itempacking_id" name="itemcode_id" value="{{$classData->ITEM_CODE}}">
                 				<button type="Submit" class="btn btn-primary">

	                				<i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 				</button>

                 			</div>

                 		</form>

                 	</div><!-- /.box-body -->

                </div>

            </div>

        </div>

    </section>

</div>

@include('admin.include.footer')

<script type="text/javascript">
  
   	$(document).ready(function(){

   		$('#length,#width,#height').on('input',function(){

			var length = parseFloat($('#length').val());
			var width  = parseFloat($('#width').val());
			var height = parseFloat($('#height').val());
			
			var lenthVal = ((isNaN(length)) || (length=='')) ? '1' : length;
			var widthVal = ((isNaN(width)) || (width=='')) ? '1' : width;
			var heightVal = ((isNaN(height)) || (height=='')) ? '1' : height;

			var cubicSpace = lenthVal * widthVal * heightVal;

		    $("#cubic_space").val(cubicSpace);

   		});

   });
</script>

<script type="text/javascript">
$(document).ready(function(){
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

@endsection