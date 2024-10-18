@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
	.hideAcBlck{
		display: none;
	}
</style>

<div class="content-wrapper">
	<section class="content-header">

		<h1>Pending Bills / Payment<small>View Details</small></h1>

		<ol class="breadcrumb">

	        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

	        <li><a href="{{ url('/dashboard') }}">Report</a></li>

	        <li class="active"><a href="{{ url('/report-pending-complete-bill-payment') }}">Pending Bills / Payment</a></li>

      	</ol>
		
	</section>

	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary Custom-Box">
					<div class="box-body">
						<div class="row">
                            <!-- <div class="col-md-1"></div> -->
							<div class="col-md-3">
								<div class="form-group" style="margin-bottom: 5%;">
									<label for="exampleInputEmail1">Report Type : <span class="required-field"></span> </label>

									<div class="input-group">

									  <input type="radio" id="pendingId" name="reporttype"  value="pending"> &nbsp; <b>Pending</b> &nbsp;&nbsp;
									  <input type="radio" id="CompleteId" name="reporttype" value="complete">  &nbsp; <b>Complete</b>&nbsp;&nbsp;
									  <input type="radio" id="allId" name="reporttype" value="all" checked="">  &nbsp; <b>All</b>

									</div>
								</div>
							</div>

							<div class="col-md-2">
								<div class="form-group" style="margin-bottom: 5%;">
									<label for="exampleInputEmail1">Type : <span class="required-field"></span> </label>

									<div class="input-group">

									  <input type="radio" id="BillId" name="billPay"  value="Bill" checked=""> &nbsp; <b>Bill</b> &nbsp;&nbsp;
									  <input type="radio" id="PaymentId" name="billPay" value="Payment">  &nbsp; <b>Payment</b>&nbsp;&nbsp;

									</div>
								</div>
							</div>

							<div class="col-md-3">

								<div class="form-group">
									<label>Acc Type<span class="required-field"></span></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

										<input list="acctypeList" type="text" class="form-control" name="acctype_code" id="acctype_code" placeholder="Select Account type" value="">

										<datalist id="acctypeList">
											<option value="">--Select--</option>

											<?php foreach ($BIL_TRACK as $key) { ?>
												<option value="<?php echo $key->ATYPE_CODE; ?>" data-xyz="{{ $key->ATYPE_NAME  }}"><?php echo $key->ATYPE_CODE;?> = <?php echo   $key->ATYPE_NAME;?></option>
											<?php } ?>
										</datalist>
									</div>
								</div>

							</div>

							<div class="col-md-3 hideAcBlck" id="acc_blck">

								<div class="form-group">
									<label>Acc Code<span class="required-field"></span></label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

										<input list="acccodeList" type="text" class="form-control" name="acc_code" id="acc_code" placeholder="Select Account" value="">

										<datalist id="acccodeList">
											<option value="">--Select--</option>
										</datalist>
									</div>
								</div>

							</div>

							<div class="col-md-2" style="margin-top: 1%;">
								<button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;width: 80%;" id="btnsearch" onclick="searchData()"><i class="fa fa-search"></i>&nbsp;&nbsp; Search</button>
							</div>

						</div>
					</div>

					<div class="box-body hideshwTbl" id="recordTbl">

			            <table id="custVenData" class="table table-bordered table-striped table-hover">

			              <thead>

			                <tr>
			                  <th class="text-center" id="bpVrnoLable">Bill Vrno</th>
			                  <th class="text-center" id="bpDateLable">Bill Date</th>
			                  <th class="text-center" id="bpAmtLable">Bill Amount</th>
			                  <th class="text-center">Alloc Amount</th>
			                  <th class="text-center">Balance Amount</th>
			                </tr>

			              </thead>
			              <tbody>
			              
			              </tbody>
			            </table>

			        </div>

				</div>
			</div>
		</div>
	</section>
</div>

@include('admin.include.footer')

<script>
	$(document).ready(function(){
		$("#acctype_code").bind('change', function () {  
			var val = $(this).val();
			var xyz = $('#acctypeList option').filter(function() {
				return this.value == val;
			}).data('xyz');

			var msg = xyz ?  xyz : 'No Match';

			if(msg=='No Match'){
				$(this).val('');
				$('#acc_code').val();
				$("#acccodeList").empty();
				$('#acc_blck').addClass('hideAcBlck');
			}else{
				var codename = val+'-'+msg;
				$('#acctype_code').val(codename);
				$('#acc_blck').removeClass('hideAcBlck');
			}

			var accType   = $('#acctype_code').val();
			var split_at  = accType.split('-');
			var accTypeCd = split_at[0];
			$.ajaxSetup({
				headers: {
				  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});

			$.ajax({
				url    : "{{ url('get-acc-data-against-atype') }}",
				method : "POST",
				type   : "JSON",
				data   : {accTypeCd: accTypeCd},

				success:function(data){

					var data1 = JSON.parse(data);

					if (data1.response == 'error') {

					}else if(data1.response == 'success'){

						if(data1.accCodeList==''){}else{

							$.each(data1.accCodeList, function(k, getACC){
                       
		                        $("#acccodeList").append($('<option>',{

		                          value:getACC.ACC_CODE,

		                          'data-xyz':getACC.ACC_NAME,
		                          text:getACC.ACC_NAME+' ['+getACC.ACC_CODE+']'

		                        }));

		                    }); 

						}

					}
				}
	      	});

    	});
	});

	function searchData(){

		var custven     = $('#acctype_code').val();
		var splicd      = custven.split('-');
		var acc_type    = splicd[0];
		var acc_code    = $('#acc_code').val();
		
		var report_type = $("input[type='radio'][name='reporttype']:checked").val();
		var billPay     = $("input[type='radio'][name='billPay']:checked").val();

		if(billPay == 'Bill'){
			$('#bpVrnoLable').html('Bill Vrno');
			$('#bpDateLable').html('Bill Date');
			$('#bpAmtLable').html('Bill Amount');
		}else if(billPay == 'Payment'){
			$('#bpVrnoLable').html('Pmt Vrno');
			$('#bpDateLable').html('Pmt Date');
			$('#bpAmtLable').html('Pmt Amount');
		}

	    if(acc_type!=''){
			$('#custVenData').DataTable().destroy();
			load_data_query(acc_code,acc_type,report_type,billPay);
			
	    }else{
			$('#custVenData').DataTable().destroy();
			load_data_query();
	    }

  	}

  	function load_data_query(acc_code='',acc_type='',report_type='',billPay=''){
        //$('#btnsearch').prop('disabled',true);
        $('#custVenData').DataTable({

           processing: true,
           serverSide: true,
           scrollX: true,
           pageLength:'25',
           dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
          
           buttons: [],
         
           ajax:{
               url:'{{ url("/get-all-data-of-bill-payment") }}',
               data: {acc_code:acc_code,acc_type:acc_type,report_type:report_type,billPay:billPay},
               method:"POST"
            },
            columns: [

              { 
                render: function (data, type, full, meta) {
					var seriesCode = full['SERIES_CODE'];
					var fyCode     = full['FY_CODE'];
					var splitfy = fyCode.split('-');

					return seriesCode+' '+splitfy[0]+' '+full['BilVrno'];
                }
              },
              { 
                data:"BilVrDate",
                className:"widthcolumn"
              },
              { 
                data:"BillAmt",
                className:"widthcolumn"
              },
              { 
                data:"AlocAmt",
                className:"widthcolumn"
              },
              { 
                data:"BalAmt",
                className:"widthcolumn"
              },
               
            ]

        });
  	}
</script>