@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">



@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
	title{
  	display:none !important;
  }
</style>

<div class="content-wrapper">
  	<!-- Content Header (Page header) -->
  	<section class="content-header">

	    <h1>
	       Cash Bank Transaction
	      <small>Add Details</small>
	    </h1>

	    <ul class="breadcrumb">

	      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

	      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

	      <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}"> Cash Bank</a></li>

	      <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}">Add Cash Bank</a></li>

	    </ul>

  	</section> <!-- /. section-->

  	<section class="content">

    	<div class="row">

      		<div class="col-sm-12">

        		<div class="box box-primary Custom-Box">

        			<div class="box-header with-border" style="text-align: center;">

            			<h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Cash Bank Transaction</h2>

				            <div class="box-tools pull-right">

				              <a href="{{ url('/finance/view-cash-bank') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

				            </div>

          			</div><!-- /.box-header -->

          			<div class="box-body">

            			<div class="row">

            				<table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
								<tr>
									<th>Sr.No.</th>
									<th>Tax Code</th>
									<th>Tax Name</th>
									<th>Tax Type</th>
									<th>Tax Block</th>
								</tr>

								<?php $srno=1; foreach($students as $rows){ ?>

								<tr>
									<td>{{$srno}}</td>
									<td>{{$rows->TAX_CODE}}</td>
									<td>{{$rows->TAX_NAME}}</td>
									<td>{{$rows->TAX_TYPE}}</td>
									<td>{{$rows->TAX_BLOCK}}</td>
								</tr>

								<?php $srno++;} ?>
							</table>
            			</div>

            			<div class="row">
            				<a href="{{ url('/students') }}" class="btnprn btn">Print Preview</a></center>
            			</div>

            		</div>

        		</div>
        	</div>
        </div>
    </section>

</div>
	

<script src="{{ URL::asset('public/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('public/plugins/jQuery/jquery-2.2.4.min.js') }}" ></script>

<script src="{{ URL::asset('public/dist/js/viewjs/jquery.printPage.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.btnprn').printPage();
	});
</script>


@endsection