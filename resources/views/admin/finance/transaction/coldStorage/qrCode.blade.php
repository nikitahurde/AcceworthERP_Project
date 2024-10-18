@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')


<div class="content-wrapper">

    <section class="content">

      	<div class="row">

      		<div class="col-md-3"></div>

	        <!-- <div class="col-sm-12">

				<div class="visible-print text-center">
				    <h1>Laravel 6 - QR Code Generator Example</h1>
				     
				    {!! QrCode::size(250)->generate('ItSolutionStuff.com'); !!}
				     
				    <p>example by ItSolutionStuf.com.</p>
				</div>
			</div> -->
			<div class="col-md-3">
				<div class="card">
		            <div class="card-header">
		                <h2>Simple QR Code</h2>
		            </div>
		            <div class="card-body">
		            	<?php $name ='kamini'; ?>
		            	<!-- < ?php echo QrCode::size(70)->generate($name) ?> -->
		                <!-- {!! QrCode::size(70)->generate('kamini') !!} -->
		                <?php 

		                	$customXML = new SimpleXMLElement(QrCode::size(70)->generate($name));
							$dom = dom_import_simplexml($customXML);
							echo $dom->ownerDocument->saveXML($dom->ownerDocument->documentElement);
		                 ?>
		            </div>
	    		</div>
	    	</div>
	    </div>
	</section>
</div>





@include('admin.include.footer')