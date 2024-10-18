@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
	.namestyle{
		font-size: 15px;
	    margin-top: 2%;
	    text-align: center;
	    font-weight: 600;
	    color: #4f90b5;
	}
</style>

<div class="content-wrapper">

	<section class="content-header">

      <h1>

        Bill Allocation Report
        <small> Bill Allocation Report Details</small>

      </h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}">Report</a></li>

        <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">Bill Allocation Report</a></li>

      </ol>

    </section>
	<section class="content">

		<div class="box box-primary Custom-Box">

			<div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Bill Allocation Report</h2>

            </div>

            <div class="box-body">

				<div class="row">

					<div class="col-md-2"></div>

					<div class="col-md-3">

						<div class="form-group">

		                    <label>Customer : 
		                    	<span class="required-field"></span>
		                    </label>

		                    <div class="input-group">

		                      <div class="input-group-addon">
		                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
		                      </div>

		                      <input list="customerList"  id="customer_code" name="customer_code" class="form-control  pull-left serieswidth" value="" placeholder="Select Customer Code"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

		                      <datalist id="customerList">
		                        <option selected="selected" value="">-- Select --</option>

		                        @foreach($customerData as $datac)

		                         <option value='<?php echo $datac->ACC_CODE?>'   data-xyz ="<?php echo $datac->ACC_NAME; ?>" ><?php echo $datac->ACC_NAME ; echo " [".$datac->ACC_CODE."]" ; ?></option>

		                        @endforeach
		                        
		                      </datalist>

		                    </div>
		                    <small id="customerName" class="namestyle"></small>
		              	</div>

					</div>
					<div class="col-md-3">
						<div class="form-group">

		                    <label>Vendor : 
		                    	<span class="required-field"></span>
		                    </label>

		                    <div class="input-group">

		                      <div class="input-group-addon">
		                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>
		                      </div>

		                      <input list="vendorList"  id="vendor_code" name="vendor_code" class="form-control  pull-left serieswidth" value="" placeholder="Select Vendor Code"  oninput="this.value = this.value.toUpperCase()" autocomplete="off">

		                      <datalist id="vendorList">
		                        <option selected="selected" value="">-- Select --</option>
		                      </datalist>

		                    </div>
		                    <small id="vendorName" class="namestyle"></small>
		              	</div>
					</div>

					<div class="col-md-2">
						<button type="button" style="padding:1px;margin-top: 4%;" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 5px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>
					</div>

					<div class="col-md-2"></div>

				</div>
			</div>

			<div class="box-body">

				<table id="billAllocatntbl" class="table table-bordered table-striped table-hover">

  					<thead class="theadC">
		      
					    <tr>
					      <th class="text-center" width="25%">Vr. Date</th>
					      <th class="text-center" width="20%">Vr. No.</th>
					      <th class="text-center" width="25%">Particular</th>
					      <th class="text-center" width="10%">Dr Amt. </th>
					      <th class="text-center" width="10%">Cr Amt. </th>
					      <th class="text-center" width="10%">Balance <input type="hidden" value="" id="headBal"></th>
					    </tr>
  					</thead>

					<tbody id="defualtSearch">

					</tbody>

				  	<tfoot align="right">
					    <tr>
					      <th></th><th></th><th></th><th></th><th></th><th></th>
					    </tr>
				  	</tfoot>
				</table>
			</div>
		</div>
	</section>
</div>


@include('admin.include.footer')

<script>
	$("#customer_code").bind('change', function () {  

      	var val = $(this).val();

      	var xyz = $('#customerList option').filter(function() {

      		return this.value == val;

      	}).data('xyz');

      	var msg = xyz ?  xyz : 'No Match';

      	if(msg == 'No Match'){
      		$(this).val('');
      		$('#customerName').html('');
      	}else{
      		$('#customerName').html(msg);
      	}

    });

    $("#vendor_code").bind('change', function () {  

      	var val = $(this).val();

      	var xyz = $('#vendorList option').filter(function() {

      		return this.value == val;

      	}).data('xyz');

      	var msg = xyz ?  xyz : 'No Match';

      	if(msg == 'No Match'){
      		$(this).val('');
      		$('#vendorName').html('');
      	}else{
      		$('#vendorName').html(msg);
      	}

    });

    function load_data_query(customer_code= ''){

    		var getcomName = '<?php echo Session::get('company_name'); ?>';
	      var getFY      = '<?php echo Session::get('macc_year'); ?>';
	      var getnewdate = new Date();
	      var getday = getnewdate.getDate();
	      var getMonth = getnewdate.getMonth()+1;
	      var getYear = getnewdate.getFullYear();

	      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

	      var getdate = getday+''+getMonth+''+getYear;
    	
         $('#billAllocatntbl').DataTable({

           	processing: true,
	         serverSide: false,
	         info: true,
	         bPaginate: false,
	         scrollY: 400,
	         fixedHeader: true,
	         order: [[0, 'asc'],[1, 'asc']],
	         dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
	         buttons: [
	                      {
	                        extend: 'excelHtml5',
	                        filename: 'BILL_ALLOCATION_'+getdate+'_'+gettime,
	                        title: getcomName+'-'+getFY+'-'+'- BILL ALLOCATION ',
	                        exportOptions: {
	                              columns: [0,1,2,3,4,5]
	                        }
	                      }

	                  ],
           ajax:{
               url:'{{ url("/get-data-for-bill-allocation") }}',
               data: {customer_code:customer_code}
            },
            columns: [

            	{ 
			        	data :'VRDATE',
			        	render: function (data, type, full, meta) {

			            var extDate = full['VRDATE'];
			            
			            var extArr  = extDate.split('-');
			            
			            var year    =  extArr[0];
			            var month   =  extArr[1];
			            var mdate   =  extArr[2];

			            return mdate+'-'+month+'-'+year;

			          },className:'text-right'
			    	},
            	{ 
	              	data:"VRNO",
	              	render: function (data, type, full, meta) {

						var VRNO       = full['VRNO'];
						var SERIESCODE = full['SERIES_CODE'];
						var fyCode     = full['FY_CODE'];
		            
		            var extArr  = fyCode.split('-');
		            
		            var first_year    =  extArr[0];
		           

		            return first_year+' '+SERIESCODE+' '+VRNO;

		          	},className:'text-left'
            	},
            	{ 
	              data:"PARTICULAR",
	              className:"text-left"
            	},
            	{ 
	              data:"DRAMT",
	              className:"text-right"
            	},
            	{ 
	              data:"CRAMT",
	              className:"text-right"
            	},
            	{ 
	              	data:"DRAMT",
	              	render: function (data, type, full, meta) {

						var DRAMT = full['DRAMT'];
						var CRAMT = full['CRAMT'];
						

		            var headBal = $('#headBal').val();

		            console.log('head bal',headBal);

		            if (headBal=='') {

		            	var totBal = parseFloat(DRAMT) - parseFloat(CRAMT);
		            	$('#headBal').val(totBal);
		            	var mHeadBal = $('#headBal').val();

		            }else{

		            	var headBal1 = $('#headBal').val();

		            	var mHeadBal = parseFloat(headBal1) + parseFloat(DRAMT) - parseFloat(CRAMT);

		            	$('#headBal').val('');
		            	$('#headBal').val(mHeadBal);

		            }

		            var headBl = parseFloat(mHeadBal);

		            var newBal = headBl.toFixed(2);

		            return newBal;

		          	},className:'text-right'
            	},
	             
          	]

      	});
   }

    $(document).ready(function(){
    	$('#btnsearch').click(function(){

            var customer_code  =  $('#customer_code').val(); 
          	if (customer_code!='') {
          
            	$('#billAllocatntbl').DataTable().destroy();
            	load_data_query(customer_code);

          	}else{
           	 	$('#billAllocatntbl').DataTable().destroy();
            	load_data_query();
            
         	}

        });
    });



</script>

@endsection