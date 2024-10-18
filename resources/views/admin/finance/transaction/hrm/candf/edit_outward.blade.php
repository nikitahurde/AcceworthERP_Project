
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
  ::placeholder {
    text-align:left;
  }
  @media screen and (max-width: 600px) {

    .showinmobile{
      display: block;
    }
    .PageTitle{
      float: left;
    }

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
  .inputboxclr{
    border: 1px solid #d7d3d3;
  }
  .tdthtablebordr{
    border: 1px solid #00BB64;
  }
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 3px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #00a65a;
    text-align: center;
  }
  .showcodename{
    color: #5696bb;
    font-size: 13px;
    font-weight: 600;
  }

</style>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
      Update Dispatch Outward
      <small>Add Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>
      <li class="active"><a href="{{ url('/form-mast-fleet') }}">Update Dispatch Outward</a></li>
      <li class="active"><a href="{{ url('/form-mast-fleet') }}">Add Dispatch Outward</a></li>

    </ol>

  </section><!-- /.section -->

<form id="loadingSlipTran">
  @csrf

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Dispatch Outward</h2>

              <div class="box-tools pull-right showinmobile">
                <a href="{{ url('/transaction/CandF/view-outward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Dispatch Outward</a>
              </div>

              <div class="box-tools pull-right">
                <a href="{{ url('/transaction/CandF/view-outward-trans') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Dispatch Outward</a>
              </div>

            </div><!-- /.box-header -->

            @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i>Success...!</h4>

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

            <div class="modalspinner hideloaderOnModl"></div>

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Date : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>

                    <?php 

                        $CurrentDate =date("d-m-Y");
                           
                        $FromDate    = date("d-m-Y", strtotime($fromDate));  
                           
                        $ToDate      = date("d-m-Y", strtotime($toDate));  
                           
                        $spliDate    = explode('-', $CurrentDate);
                           
                        $yearGet     = Session::get('macc_year');
                           
                        $fyYear      = explode('-', $yearGet);
                           
                        $get_Month   = $spliDate[1];
                        $get_year    = $spliDate[2];

                        if($get_Month > 3 && $get_year == $fyYear[1]){
                            $vrDate = $ToDate;
                        }else{
                            $vrDate = $CurrentDate;
                        }

                    ?>

                    <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
                    <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
                    <input type="text" name="transaction_date" id="transaction_date" class="form-control datepicker" placeholder="Enter Date" value="{{$vrDate}}">

                  </div>
                  <small id="showmsgfordate"></small>

                </div><!-- /.form group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input list="vehicleList" id="vehicle_no" name="vehicle_no" class="form-control  pull-left" value="<?= $outward_data[0]->VEHICLE_NO ?>" placeholder="Enter Vehicle No" onchange="getTripDeatils();" autocomplete="off" readonly>

                    <datalist id="vehicleList">
                              
                      <?php foreach ($vehicleNo_list as $key) { ?>
                        
                      <option value="<?= $key->VEHICLE_NO ?>~<?= $key->TRIP_NO ?>" data-xyz="<?= $key->VEHICLE_NO ?>"><?= $key->VEHICLE_NO ?><?= $key->TRIP_NO ?></option>

                      <?php   } ?>

                    </datalist>

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Series Code : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="series_code" name="series_code" class="form-control  pull-left" value="<?= $outward_data[0]->SERIES_CODE ?>" readonly placeholder="Enter Series Code">

                  </div>

                </div>

              </div><!-- /.col --> 

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Series Name : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="series_name" name="series_name" class="form-control  pull-left" value="<?= $outward_data[0]->SERIES_NAME ?>" readonly placeholder="Enter Series Name">

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Plant Code : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="plant_code" name="plant_code" class="form-control pull-left" value="<?= $outward_data[0]->PLANT_CODE ?>" readonly placeholder="Enter Plant Code">

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Plant Name : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input tye="text" id="plant_name" name="plant_name" class="form-control  pull-left" value="<?= $outward_data[0]->PLANT_NAME ?>" readonly placeholder="Enter Plant Name">

                  </div>

                </div>

              </div><!-- /.col -->

            </div><!-- /.row -->

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Pfct Code : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input tye="text" id="pfct_code" name="pfct_code" class="form-control  pull-left" value="<?= $outward_data[0]->PFCT_CODE ?>" readonly placeholder="Enter Pfct Code">

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Pfct Name : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="pfct_name" name="pfct_name" class="form-control  pull-left" value="<?= $outward_data[0]->PFCT_NAME ?>" readonly placeholder="Enter Pfct Name">

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Customer Code : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="customer_code" name="customer_code" class="form-control  pull-left" value="<?= $outward_data[0]->ACC_CODE ?>" readonly placeholder="Enter Customer Code">

                     <input type="hidden" id="tran_code" name="tran_code" class="form-control  pull-left" value="<?= $outward_data[0]->TRAN_CODE ?>" >
                     <input type="hidden" id="rake_no" name="rake_no" class="form-control  pull-left" value="<?= $outward_data[0]->RAKE_NO ?>" >
                     <input type="hidden" id="rake_date" name="rake_date" class="form-control  pull-left" value="<?= $outward_data[0]->RAKE_DATE ?>" >
                     <input type="hidden" id="place_date" name="place_date" class="form-control  pull-left" value="<?= $outward_data[0]->PLACE_DATE ?>" >
                     <input type="hidden" id="vr_date" name="vr_date" class="form-control  pull-left" value="<?= $outward_data[0]->VRDATE ?>" >
                     <input type='hidden' class='inputboxclr'  name='trip_type' id='trip_type' value='<?= $outward_data[0]->TRPT_TYPE ?>' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='trip_No' id='trip_No' value='<?= $outward_data[0]->TRIP_NO ?>' autocomplete='off' readonly />
                    
                     <!-- <input type='hidden' class='inputboxclr'  name='inwardId' id='inwardId' value='' autocomplete='off' readonly /> -->

                     <input type='hidden' class='inputboxclr'  name='trip_headid' id='trip_headid' value='<?= $outward_data[0]->TRIPHID ?>' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='cfgateId' id='cfgateId' value='' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='trip_accCode' id='trip_accCode' value='' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='trip_accName' id='trip_accName' value='' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='trip_comp' id='trip_comp' value='' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='trip_fycode' id='trip_fycode' value='' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='trip_pfctCode' id='trip_pfctCode' value='' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='trip_seriesCode' id='trip_seriesCode' value='' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='trip_tranCode' id='trip_tranCode' value='' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='trip_seriesName' id='trip_seriesName' value='' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='trip_pfctName' id='trip_pfctName' value='' autocomplete='off' readonly />
                       <input type='hidden' class='inputboxclr'  name='trip_vrDate' id='trip_vrDate' value='' autocomplete='off' readonly />
                       <input type='hidden' class='inputboxclr'  name='trip_vehicleType' id='trip_vehicleType' value='' autocomplete='off' readonly />
                     <input type='hidden' class='inputboxclr'  name='tripNo' id='tripNo' value='' autocomplete='off' readonly />

                    




                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Customer Name : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="custmoer_name" name="custmoer_name" class="form-control  pull-left" value="<?= $outward_data[0]->ACC_NAME ?>" readonly placeholder="Enter Customer Name">

                  </div>

                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Lifting Point : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input list="addList" id="custmoer_add" name="custmoer_add" class="form-control  pull-left" value="<?= $outward_data[0]->ACC_ADD ?>" placeholder="Enter Customer Add">

                    <datalist id="addList">


                    </datalist>

                  </div>

                </div>

              </div>

               <input type="hidden" id="dubcp_code" name="dubcp_code" class="form-control  pull-left" value="">

               <input type="hidden" id="generateLrNo" value="1">
               <input type="hidden" id="VrNo" name='VrNo' value="<?= $outward_data[0]->VRNO ?>">
               <input type="hidden" id="slno" name='slno' value="<?= $outward_data[0]->SLNO ?>">
               <input type="hidden" id="fy_code" name='fyCode' value="<?= $outward_data[0]->FyCode ?>">
               <input type="hidden" id="compCode" name='compCode' value="<?= $outward_data[0]->compCode ?>">



            </div><!-- row -->
            
          </div><!-- /.box-body -->
          
        </div><!-- /.custom box -->

      </div><!-- /.col-sm-12 -->

    </div><!-- /.row -->

  </section><!-- /.section -->

  <section class="content" style="margin-top: -10%;" id="datatableId">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-warning Custom-Box">

          <div class="box-body table-responsive">

            <div class="col-sm-12">
              <p style="font-weight: bold;font-size: 12px;">ITEM/DO DETAILS</p>
              <input type="hidden" name="data_count" id="data_count" value="">
            </div>
            <div class="">

              <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

              <tr>
                <th style='width: 10px;'> Sr.No.</th>
                <th>CP CODE</th>
                <th>CP NAME</th>
                <th>INVOICE NO</th>
                <th>INVOICE DATE</th>
                <th>DO NO</th>
                <th>DO DATE</th>
                <th>BATCH NO</th>
                <th>ITEM CODE</th>
                <th>ITEM NAME</th>
                <th>REMARK</th>
                <th>LR NO</th>
                <th>LR DATE</th>
                <th>WAGON NO</th>
                <th>WAGON DATE</th>
                <th>RAKE NO</th>
                <th>LS QTY</th>
                <th>ISSUED QTY</th>
                <th>AQTY</th>
                <th>DELIVERY NO</th>
                <th>E-WAY BILL NO</th>
                <th>E-WAY BILL DATE</th>
                <th>Material Value</th>
              </tr>

              <?php $srno=1; foreach($outward_data as $key) { 

                    $invcDate = date('d-m-Y',strtotime($key->INVOICE_DATE));
                    $doDate = date('d-m-Y',strtotime($key->ORDER_DATE));
                    $lrDate = date('d-m-Y',strtotime($key->LR_DATE));
                    $ewayBillDate = date('d-m-Y',strtotime($key->EWAY_BILL_DT));

                    if($key->WAGON_DATE='0000-00-00'){
                      $wagonDate = '0000-00-00';
                    }else{
                      $wagonDate = date('d-m-Y',strtotime($key->WAGON_DATE));
                    }
                    

                  ?>
                  <tr> 
                  <td><?= $srno; ?></td>
                   <td><input list='cpCodelist<?= $srno; ?>' type='text' style='padding: 0px;width: 90px;' class='inputboxclr cpCddata'  name='cp_code[]' id='cp_code<?= $srno; ?>' value='<?= $key->CP_CODE ?>' autocomplete='off' onchange='getCpName(<?= $srno; ?>);' />
                   	<datalist id='cpCodelist<?= $srno; ?>'>
                   		<?php foreach ($acc_list as $row) { ?>

                   	    	<option value="<?= $row->ACC_CODE ?>" data-xyz='<?= $row->ACC_NAME ?>'><?= $row->ACC_CODE ?> - <?= $row->ACC_NAME ?></option>

                   	     <?php 	} ?>
                   	</datalist>
                   </td>
                  <td><input type='text' style='padding: 0px;width: 90px;' class='inputboxclr'  name='cp_name[]' id='cp_name<?= $srno; ?>' value='<?= $key->CP_NAME ?>' autocomplete='off' readonly /><input type='text' style='padding: 0px;width: 90px;' class='inputboxclr'  name='cp_add[]' id='cp_add<?= $srno; ?>' value='<?= $key->CP_ADD ?>' autocomplete='off' readonly /><input type='hidden'  name='sp_code[]' id='sp_code<?= $srno; ?>' value='<?= $key->SP_CODE ?>' autocomplete='off' readonly /><input type='hidden'  name='sp_name[]' id='sp_name<?= $srno; ?>' value='<?= $key->SP_NAME ?>' autocomplete='off' readonly /></td>
                  <td><input style='padding: 0px;width: 90px;border:none' type='hidden' name='body_id[]' id='body_id<?= $srno; ?>' class='inputboxclr'  value='<?= $key->CFOUTWARDID ?>' readonly><input style='padding: 0px;width: 90px;border:none' type='hidden' name='triphead_id[]' id='triphead_id<?= $srno; ?>' class='inputboxclr'  value='<?= $key->TRIPHID ?>' readonly><input style='padding: 0px;width: 90px;border:none' type='hidden' name='inwardId[]' id='inwardId<?= $srno; ?>' class='inputboxclr'  value='<?= $key->CFINWARDID ?>' readonly=/><input style='padding: 0px;width: 90px;border:none' type='hidden' name='vrno[]' id='vrno<?= $srno; ?>' class='inputboxclr'  value='<?= $key->VRNO ?>' /><input style='padding: 0px;width: 90px;border:none' type='hidden' name='slno[]' id='slno<?= $srno; ?>' class='inputboxclr'  value='<?= $key->SLNO ?>' /><input type='text' style='padding: 0px;width: 90px;' class='inputboxclr' readonly name='invoice_no[]' id='invoice_no<?= $srno; ?>' value='<?= $key->INVOICE_NO ?>' autocomplete='off'  />
                  </td>
                  <td><input type='text' style='padding: 0px;width: 90px;' value='<?= $invcDate ?>' name='invoice_date[]' readonly class='datepicker inputboxclr clr' id='invoice_date<?= $srno; ?>' autocomplete='off'/>
                  </td>
                  <td><input type='text' style='padding: 0px;width: 90px;text-align:right;' name='do_no[]' id='do_no<?= $srno; ?>' class='inputboxclr' readonly value='<?= $key->ORDER_NO ?>'/>
                  </td>
                  <td><input style='padding: 0px;width: 90px;text-align:right;' class='inputboxclr datepicker' type='text' readonly value='<?= $doDate ?>' name='do_date[]' id='do_date<?= $srno; ?>'/>
                  </td>
                  <td><input style='padding: 0px;width: 90px;text-align:right;' type='text' class='inputboxclr' readonly name='batch_no[]' id='batch_no<?= $srno; ?>' value='<?= $key->BATCH_NO ?>' autocomplete='off' readonly />
                  </td>
                  <td><input style='padding: 0px;width: 90px;' class='inputboxclr' list='itemcodeList' value='<?= $key->ITEM_CODE ?>' name='item_code[]' onchange='getitemName()' id='item_code<?= $srno; ?>' /><datalist id='itemcodeList'><?php foreach ($item_list as $row) { ?><option value='<?= $row->ITEM_CODE ?>' data-xyz='<?= $row->ITEM_NAME ?>'><?= $row->ITEM_CODE ?> - <?= $row->ITEM_NAME ?></option><?php   } ?></datalist><input type='hidden' value='' name='stdRateItem' id='stdRateItem<?= $srno; ?>'>
                  </td>
                  <td><input style='padding: 0px;' class='inputboxclr' type='text' value='<?= $key->ITEM_NAME ?>' name='item_name[]' readonly id='item_name<?= $srno; ?>' />
                  </td>
                  <td><input style='padding: 0px;' class='inputboxclr' type='text' value='<?=  $key->REMARK ?>' name='item_remark[]' readonly id='item_remark<?= $srno; ?>' />
                  </td>
                   <td><input style='padding: 0px;width: 85px;text-align: right;' type='text' class='inputboxclr' name='lr_no[]'  id='lr_no<?= $srno; ?>' value='<?= $key->LR_NO ?>' autocomplete='off' /><input style='padding: 0px;width: 85px;text-align: right;' type='hidden' class='inputboxclr' name='uniqLrNo[]'  id='uniqLrNo' value='' autocomplete='off'/>
                  </td>
                  <td><input style='padding: 0px;width: 85px;text-align: right;' type='text' class='inputboxclr datepicker' name='lr_date[]'  id='lr_date<?= $srno; ?>' value='<?= $lrDate ?>' autocomplete='off'/>
                  </td>
                  <td><input style='padding: 0px;width: 85px;' type='text' class='inputboxclr' value='<?= $key->WAGON_NO ?>' name='wagon_no[]' id='wagon_no<?= $srno; ?>'  autocomplete='off'/>
                  </td>
                  <td><input style='padding: 0px;width: 85px;text-align: right;' type='text' value='<?= $wagonDate ?>' readonly name='wagon_date[]' class='datepicker inputboxclr' id='wagon_date<?= $srno; ?>' autocomplete='off'/>
                  </td>
                  <td><input style='padding: 0px;width: 85px;text-align: right;' type='text' value='<?= $key->RAKE_NO ?>' readonly name='rakeNo[]' class='datepicker inputboxclr' id='rakeNo<?= $srno; ?>' autocomplete='off'/>
                  </td>
                  <td><input style='padding: 0px;width: 70px;text-align: right;text-align: right;' type='text' class='inputboxclr' readonly id='qty<?= $srno; ?>' value='<?= $key->QTY ?>' name='qty[]' style='width: 80px;' /><input style='padding: 0px;width: 70px;text-align: right;text-align: right;' type='hidden' class='inputboxclr' id='unit_M<?= $srno; ?>' value='<?= $key->UM ?>' name='unit_M[]' style='width: 80px;' /><input style='padding: 0px;width: 70px;text-align: right;text-align: right;' type='hidden' class='inputboxclr' id='qty_Arecd<?= $srno; ?>' value='<?= $key->AQTY ?>' name='qty_Arecd[]' style='width: 80px;' />
                  </td>
                  <td><input style='padding: 0px;width: 70px;text-align: right;' type='text' class='inputboxclr' id='issue_qty<?= $srno; ?>' value='<?= $key->QTYISSUED ?>' name='issue_qty[]' style='width: 80px;' oninput="totalvalCalculation(<?= $srno; ?>,'Q')"/>
                  <input style='padding: 0px;width: 70px;text-align: right;' type='hidden' class='inputboxclr' id='old_issue_qty<?= $srno; ?>' value='<?= $key->QTYISSUED ?>' name='old_issue_qty[]' style='width: 80px;' oninput='getShortagQty()'/>
                  <input style='padding: 0px;width: 70px;text-align: right;' type='hidden' class='inputboxclr' id='cfactor<?= $srno; ?>' value='<?= $key->CFACTOR ?>' name='cfactor[]' style='width: 80px;'/>
                  </td>
                  <td><input style='padding: 0px;width: 70px;text-align: right;' type='text' class='inputboxclr' id='issue_Aqty<?= $srno; ?>' value='<?= $key->AQTISSUED ?>' name='issue_Aqty[]' style='width: 80px;' oninput="totalvalCalculation(<?= $srno; ?>,'A')"/>
                  </td>
                  <td><input style='padding: 0px;width: 85px;' type='text' class='inputboxclr' value='<?= $key->DELIVERY_NO ?>' name='delivery_no[]' id='delivery_no<?= $srno; ?>'  autocomplete='off'/>
                  </td>
                  <td><input style='padding: 0px;width: 85px;text-align:right;' type='text' class='inputboxclr' value='<?= $key->EWAY_BILL_NO ?>'  name='ewaybill_no[]' id='ewaybill_no<?= $srno; ?>' autocomplete='off'  />
                  </td>
                  <td><input style='padding: 0px;width: 85px;text-align: right;' type='text' class='inputboxclr datepicker' value='<?= $ewayBillDate ?>' name='ewaybill_date[]' id='ewaybill_date<?= $srno; ?>' autocomplete='off'  /><input type='hidden' class='inputboxclr'  name='sp_add[]' id='sp_add<?= $srno; ?>' value='<?= $key->SP_ADD ?>' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='length[]' id='length<?= $srno; ?>' value='<?= $key->LENGTH ?>' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='width[]' id='width<?= $srno; ?><?= $srno; ?>' value='<?= $key->WIDTH ?>' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='height[]' id='height<?= $srno; ?>' value='<?= $key->HEIGHT ?>' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='odc[]' id='odc<?= $srno; ?>' value='<?= $key->ODC ?>' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='aqty[]' id='aqty<?= $srno; ?>' value='<?= $key->AQTY ?>' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='um[]' id='um<?= $srno; ?>' value='<?= $key->UM ?>' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='Aum[]' id='Aum<?= $srno; ?>' value='<?= $key->AUM ?>' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='obd_no[]' id='obd_no<?= $srno; ?>' value='<?= $key->OBD_NO ?>' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='cam_no[]' id='cam_no<?= $srno; ?>' value='<?= $key->CAM_NO ?>' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='trpt_code[]' id='trpt_code<?= $srno; ?>' value='<?= $key->TRPT_CODE ?>' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='trpt_name[]' id='trpt_name<?= $srno; ?>' value='<?= $key->TRPT_NAME ?>' autocomplete='off' readonly />
                  </td>
                  <td><input type='text' style='padding: 0px;width: 90px;text-align: right;' class='inputboxclr'  name='material_value[]'  id='material_value<?= $srno; ?>' value='<?= $key->MATERIAL_VALUE ?>' autocomplete='off'/>
                  </td>
                </tr> 
              <?php $srno++; } ?>

              </table>

             <small id='recd_qtyErr'style='font-size:12px;line-height: 1.0;margin-left: 80%'></small>
                          
            </div>

           <!--  <button type="button" class='btn btn-info btn-sm addmore' disabled id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
            <button type="button" class='btn btn-danger btn-sm delete' disabled id="deletehidn"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button> -->

          </div>

        </div>

      </div>

    </div>

  </section>

  <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-warning Custom-Box">

          <div class="box-body">

            <div class="col-sm-12">
              <p style="font-weight: bold;font-size: 12px;padding-bottom: 10px;">Freight Details </p>
            </div>

            <div class="row">
<!-- /.col -->

              <!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>

                   From Place: 

                    <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <input list="fromplaceList" class="form-control" name="from_place" id="from_place"  value="<?= $outward_data[0]->FROM_PLACE ?>" placeholder="Enter From Place" autocomplete="off" readonly/>

                      <input type="hidden" name="tri_days" id="tri_days" value="<?= $outward_data[0]->TRIP_DAYS ?>">

                  </div>

                </div>

                <!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>

                    To Place: 

                    <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>


                      <input type="text"  id="to_place" name="to_place" class="form-control pull-left" value="<?= $outward_data[0]->TO_PLACE ?>" placeholder="Enter To Place" autocomplete="off"  readonly>
                      <input type="hidden"  id="temp_to_place" name="temp_to_place" class="form-control pull-left" value="" placeholder="Enter To Place" autocomplete="off">
                      <input type="hidden"  id="sr_flag" name="sr_flag" class="form-control pull-left" value="<?= $outward_data[0]->SLR_FLAG ?>" placeholder="Enter To Place" autocomplete="off">

                  </div> 

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>

                   LR Remark: 

                   <!--  <span class="required-field"></span> -->

                  </label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>

                      <textarea type="text" id="lr_remark" name="lr_remark" class="form-control pull-left" value="<?= $outward_data[0]->LR_REMARK ?>" placeholder="Enter LR Remark" autocomplete="off" cols="25" rows="1"></textarea>

                  </div> 

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Transporter Code: </label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-car"></i></span>

                      <input list="transportList" class="form-control" name="transporter_code"  value="<?= $outward_data[0]->TRPT_CODE ?>" id="transporter_code" placeholder="Enter Transporter" autocomplete="off" onchange="getRate()" readonly="">

                  </div> 

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Transporter Name: </label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-car"></i></span>

                      <input type="text" class="form-control" name="transporter_name" id="transporter_name"  value="<?= $outward_data[0]->TRPT_NAME ?>" placeholder="Enter Transporter" autocomplete="off" readonly="">

                  </div> 

                </div><!-- /.form-group -->

              </div>
              
            </div><!-- /. row -->

            <div class="row">

              <!-- /.col -->

             <!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Driver Name : </label>

                  <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                      <input type="text" class="form-control" name="driver_name" id="driver_name"  value="<?= $outward_data[0]->DRIVER_NAME ?>" placeholder="Select Driver Name " autocomplete="off" />

                      <input type="hidden" name="headid" id="headid" value="">
                      <input type="hidden" name="vrno" id="vrno" value="">

                  </div>
             
                </div>

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Driver Mobile :</label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building"></i></span>

                    <input type="text" class="form-control" name="mobile_no" id="mobile_no" value="<?= $outward_data[0]->MOBILE_NUMBER ?>"  placeholder="Enter Mobile No"  autocomplete="off"  />

                  </div>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Vehicle Type :</label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building"></i></span>

                    <input type="text" class="form-control" name="vehicle_type" id="vehicle_type"  placeholder="Enter Vehicle Type"  autocomplete="off" value="<?= $outward_data[0]->VEHICLE_TYPE ?>" />

                    <input type="hidden" name="getEntryVrNo" id="getEntryVrNo" value="">

                  </div>

                </div><!-- /.form-group -->

              </div>

              <div class="col-md-4" style="margin-top: 20px;font-weight: bold;">

                <small id="slrMsg"></small>
                
              </div>
              
            </div><!-- /. row -->

            <div style="text-align: center;"><span id="errmsg" style="color: red;font-weight: bold;"></span></div>

            <div class="row" style="margin-top: 10px;">
              <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
              <div class="col-md-12" style="text-align: center;">

                <button class="btn btn-success" type="button" id="submitdata" onclick="submitLoadingSlipTrans(0)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

                <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitLoadingSlipTrans(1)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>
              </div>

            </div><!-- /.row -->
            
          </div><!-- /.box-body -->
          
        </div><!-- /.custom box -->
        
      </div><!-- /.col -->
      
    </div><!-- /.row -->
    
  </section><!-- /.section -->

</form>
  
</div>


@include('admin.include.footer')

<script>

$(document).ready(function() {

  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    orientation: 'bottom',
    todayHighlight: 'true',
    endDate:'today',
    autoclose: 'true'
  });
  
});


function getCpName(num){

	var cp_code = $('#cp_code'+num).val();

	//alert(cp_code);return false;

        var xyz = $('#cpCodelist'+num+' option').filter(function() {
          return this.value == cp_code;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

     

        if(msg=='No Match'){
          $("#cp_name"+num).val('');
        }else{

          $("#cp_name"+num).val(msg);
          $("#cp_add"+num).val('');

        }

}


  function getTripDeatils(){

    var vehicleNo1 = $('#vehicle_no').val();
    var tran_vr_date = $('#transaction_date').val();

    var splitData = vehicleNo1.split('~');

    var vehicleNo = splitData[0];
    var tripno = splitData[1];
    
    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }
    });

    $.ajax({

        url:"{{ url('get-trip-no-details-against-vehicle') }}",
       // url:"{{ url('get-outward-dispatch-against-vehicle') }}",

        method : "POST",
        type: "JSON",
        data: {vehicleNo: vehicleNo,tripno:tripno},

        beforeSend: function() {
          console.log('start spinner');
          $('.modalspinner').removeClass('hideloaderOnModl');
        },

        success:function(data){

            var data1 = JSON.parse(data);

            console.log(data1);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.data_vehicle_type == '' || data1.data_vehicle_type ==null){

                   $('#vehicle_type').val('');
              }else{

                  $('#vehicle_type').val(data1.data_vehicle_type.WHEEL_TYPE);

              }

            console.log('accADDRESS',data1.data_accAddress);

              if(data1.data_accAddress=='' || data1.data_accAddress==null){

              }else{


                $("#addList").empty();
                $.each(data1.data_accAddress, function(k, getData) {

                    $("#addList").append($('<option>',{

                          value:getData.ADD1,

                          'data-xyz':getData.ADD1,
                          text:getData.ADD1

                    }));

                });/* /. each loop */

              }


               if(data1.data_vehicleOut == '' || data1.data_vehicleOut == null){

              }else{

                console.log('data_vehicleOut',data1.data_vehicleOut.VRNO);

                $("#getEntryVrNo").val(data1.data_vehicleOut[0].VRNO);
              } 

              if(data1.data_outward == ''){

              }else{

                console.log('rakeno',data1.data_outward[0].RAKE_NO);

                $("#route_code").val(data1.data_outward[0].ROUTE_CODE);
                $("#route_name").val(data1.data_outward[0].ROUTE_NAME);
                $("#from_place").val(data1.data_outward[0].FROMPLACE);
                $("#to_place").val(data1.data_outward[0].TOPLACE);
                $("#temp_to_place").val(data1.data_outward[0].TO_PLACE);
                $("#sr_flag").val(data1.data_outward[0].SLR_FLAG);
                $("#transporter_code").val(data1.data_outward[0].TRIP_TRPTCODE);
                $("#transporter_name").val(data1.data_outward[0].TRIP_TRPTNAME);
                $("#series_code").val(data1.data_outward[0].SERIES_CODE);
                $("#series_name").val(data1.data_outward[0].SERIES_NAME);
                $("#plant_code").val(data1.data_outward[0].PLANT_CODE);
                $("#plant_name").val(data1.data_outward[0].PLANT_NAME);
                $("#pfct_code").val(data1.data_outward[0].PFCT_CODE);
                $("#pfct_name").val(data1.data_outward[0].PFCT_NAME);
                $("#customer_code").val(data1.data_outward[0].ACC_CODE);
                $("#custmoer_name").val(data1.data_outward[0].ACC_NAME);
                $("#driver_name").val(data1.data_outward[0].DRIVER_NAME);
                $("#driver_name").val(data1.data_outward[0].DRIVER_NAME);
                $("#tran_code").val(data1.data_outward[0].TRAN_CODE);
                $("#headid").val(data1.data_outward[0].CFOUTWARDID);
                $("#rake_no").val(data1.data_outward[0].RAKE_NO);
                $("#rake_date").val(data1.data_outward[0].RAKE_DATE);
                $("#place_date").val(data1.data_outward[0].PLACE_DATE);
                $("#vr_date").val(data1.data_outward[0].VRDATE);
                $("#trip_type").val(data1.data_outward[0].TRPT_TYPE);
                //$("#inwardId").val(data1.data_outward[0].CFINWARDID);

                $("#trip_headid").val(data1.data_outward[0].TRIPHID);
                $("#cfgateId").val(data1.data_outward[0].CFGATEID);
                $("#trip_accCode").val(data1.data_outward[0].TRIP_ACCCODE);
                $("#trip_accName").val(data1.data_outward[0].TRIP_ACCNAME);
                $("#trip_comp").val(data1.data_outward[0].TRIP_COMP);
                $("#trip_fycode").val(data1.data_outward[0].TRIP_FYCODE);
                $("#trip_pfctCode").val(data1.data_outward[0].TRIP_PFCTCODE);
                $("#trip_seriesCode").val(data1.data_outward[0].TRIP_SERIESCODE);
                $("#trip_tranCode").val(data1.data_outward[0].TRIP_TRANCODE);
                $("#trip_seriesName").val(data1.data_outward[0].TRIP_SERIESNAME);
                $("#trip_pfctName").val(data1.data_outward[0].TRIP_PFCTNAME);
                $("#trip_vrDate").val(data1.data_outward[0].TRIP_VRDATE);
                $("#trip_vehicleType").val(data1.data_outward[0].VEHICLETYPE);
                $("#tripNo").val(data1.data_outward[0].TRIP_NO);

                console.log('tripno',data1.data_outward[0].TRIP_NO);

                var sr_flag = data1.data_outward[0].SLR_FLAG;

                if(sr_flag==1){

                  $("#slrMsg").html('SUPPLEMENTARY LR HAS BEEN GENRATED FOR THIS TRIP').css('color','red');
                }else{
                  $("#slrMsg").html('');
                }
               
                $("#vrnols").val(data1.data_outward[0].VRNO);

                var fyCode = data1.data_outward[0].FY_CODE;
                var splitFyCode = fyCode.split('-');
                var Fy_code = splitFyCode[0];

                $("#fy_code").val(Fy_code);

                $("#mobile_no").val(data1.data_outward[0].MOBILE_NUMBER);

                $('#tbledata').empty();
               
                var headtbl = "<tr><th style='width: 10px;'> Sr.No.</th><th>CP CODE</th><th>CP NAME</th><th>INVOICE NO</th><th>INVOICE DATE</th><th>DO NO</th><th>DO DATE</th><th>BATCH NO</th><th>ITEM CODE</th><th>ITEM NAME</th><th>REMARK</th><th>LR NO</th><th>LR DATE</th><th>WAGON NO</th><th>WAGON DATE</th><th>RAKE NO</th><th>LS QTY</th><th>ISSUED QTY</th><th>AQTY</th><th>DELIVERY NO</th><th>E-WAY BILL NO</th><th>E-WAY BILL DATE</th><th>MATERIAL VALUE</th></tr>";

                $('#tbledata').append(headtbl);
                
                var srno=1;
                var lr_noAry = [];
                $.each(data1.data_outward, function(k, getData) {

                  var stdRate =  getData.STDRATE;
                  var qty     =  getData.QTY;

                  var mate_value =  parseFloat(stdRate) * parseFloat(qty);

                  var invDt = getData.INVOICE_DATE;
                  var splitDt = invDt.split('-');
                  var invoiceDate = splitDt[2]+'-'+splitDt[1]+'-'+splitDt[0];

                  var doDt = getData.ORDER_DATE;
                  var splitdo = invDt.split('-');
                  var doDate = splitdo[2]+'-'+splitdo[1]+'-'+splitdo[0];

                  var eWayBValidDt = getData.EWAY_BILL_DT;

                  if(eWayBValidDt){
                    var eWayDt = getData.EWAY_BILL_DT;
                    var spliteWay = eWayDt.split('-');
                    var eWayBillDate = spliteWay[2]+'-'+spliteWay[1]+'-'+spliteWay[0];
                  }else{
                    var eWayBillDate = '';
                  }

                  var wagonDt = getData.WAGON_DATE;

                  if(wagonDt){
                    var wagonDT = getData.WAGON_DATE;
                    var spliteWagon = wagonDT.split('-');
                    var wagonDate = spliteWagon[2]+'-'+spliteWagon[1]+'-'+spliteWagon[0];
                  }else{
                    var wagonDate = '';
                  }

                  var ebillNo     = (getData.EWAY_BILL_NO == '') || (getData.EWAY_BILL_NO == null) ? '' : getData.EWAY_BILL_NO;  

                  var CurrentDate = date = new Date();

                  var day = date.getDate();
                  var month = date.getMonth() + 1;
                  var year = date.getFullYear();
                  var  currentDate = day+'-'+month+'-'+year;
                  var fyYear = getData.FY_CODE;
                  var splitFy = fyYear.split('-');
                  var fy_code = splitFy[0];
                  var lr_slno = getData.LR_SLNO;
                  var vr_no = getData.VRNO;
                  lr_noAry.push(getData.LR_SLNO);
                  var lr_no = fy_code+'-'+vr_no+'/'+lr_slno;

                  $("#data_count").val(data1.data_outward.length);

                  var bodyData = "<tr><td>"+srno+"</td>"+
                  "<td><input type='text' style='padding: 0px;width: 90px;' class='inputboxclr cpCddata'  name='cp_code[]' id='cp_code"+srno+"' value='"+getData.CP_CODE+"' autocomplete='off' readonly /></td>"+
                  "<td><input type='text' style='padding: 0px;width: 90px;' class='inputboxclr'  name='cp_name[]' id='cp_name"+srno+"' value='"+getData.CP_NAME+"' autocomplete='off' readonly /><input type='text' style='padding: 0px;width: 90px;' class='inputboxclr'  name='cp_add[]' id='cp_add"+srno+"' value='"+getData.CP_ADD+"' autocomplete='off' readonly /><input type='hidden'  name='sp_code[]' id='sp_code"+srno+"' value='"+getData.SP_CODE+"' autocomplete='off' readonly /><input type='hidden'  name='sp_name[]' id='sp_name"+srno+"' value='"+getData.SP_NAME+"' autocomplete='off' readonly /></td>"+
                  "<td><input style='padding: 0px;width: 90px;border:none' type='hidden' name='body_id[]' id='body_id"+srno+"' class='inputboxclr'  value='"+getData.CFOUTWARDID+"' readonly=/><input style='padding: 0px;width: 90px;border:none' type='hidden' name='inwardId[]' id='inwardId"+srno+"' class='inputboxclr'  value='"+getData.CFINWARDID+"' readonly=/><input style='padding: 0px;width: 90px;border:none' type='hidden' name='vrno[]' id='vrno"+srno+"' class='inputboxclr'  value='"+getData.VRNO+"' /><input style='padding: 0px;width: 90px;border:none' type='hidden' name='slno[]' id='slno"+srno+"' class='inputboxclr'  value='"+getData.SLNO+"' /><input type='text' style='padding: 0px;width: 90px;' class='inputboxclr' readonly name='invoice_no[]' id='invoice_no"+srno+"' value='"+getData.INVOICE_NO+"' autocomplete='off'  /></td>"+
                  "<td><input type='text' style='padding: 0px;width: 90px;' value='"+invoiceDate+"' name='invoice_date[]' readonly class='datepicker inputboxclr clr' id='invoice_date"+srno+"' autocomplete='off'/></td>"+
                  "<td><input type='text' style='padding: 0px;width: 90px;text-align:right;' name='do_no[]' id='do_no"+srno+"' class='inputboxclr' readonly value='"+getData.ORDER_NO+"'/></td>"+
                  "<td><input style='padding: 0px;width: 90px;text-align:right;' class='inputboxclr datepicker' type='text' readonly value='"+doDate+"' name='do_date[]' id='do_date"+srno+"'/></td>"+
                  "<td><input style='padding: 0px;width: 90px;text-align:right;' type='text' class='inputboxclr' readonly name='batch_no[]' id='batch_no"+srno+"' value='"+getData.BATCH_NO+"' autocomplete='off' readonly /></td>"+
                  "<td><input style='padding: 0px;width: 90px;' class='inputboxclr' list='itemcodeList"+srno+"' value='"+getData.ITEM_CODE+"' name='item_code[]' onchange='getitemName("+srno+")' id='item_code"+srno+"' /><datalist id='itemcodeList"+srno+"'><?php foreach ($item_list as $key) { ?><option value='<?= $key->ITEM_CODE ?>' data-xyz='<?= $key->ITEM_NAME ?>'><?= $key->ITEM_CODE ?> - <?= $key->ITEM_NAME ?></option><?php   } ?></datalist><input type='hidden' value='"+stdRate+"' name='stdRateItem' id='stdRateItem"+srno+"'></td>"+
                  "<td><input style='padding: 0px;' class='inputboxclr' type='text' value='"+getData.ITEM_NAME+"' name='item_name[]' readonly id='item_name"+srno+"' /></td>"+
                  "<td><input style='padding: 0px;' class='inputboxclr' type='text' value='"+getData.REMARK+"' name='item_remark[]' readonly id='item_remark"+srno+"' /></td>"+
                   "<td><input style='padding: 0px;width: 85px;text-align: right;' type='text' class='inputboxclr' name='lr_no[]' readonly id='lr_no"+srno+"' value='"+lr_no+"' autocomplete='off' readonly/><input style='padding: 0px;width: 85px;text-align: right;' type='hidden' class='inputboxclr' name='uniqLrNo[]'  id='uniqLrNo"+srno+"' value='"+lr_slno+"' autocomplete='off'/></td>"+
                    "<td><input style='padding: 0px;width: 85px;text-align: right;' type='text' class='inputboxclr datepicker' name='lr_date[]'  id='lr_date"+srno+"' value='"+tran_vr_date+"' autocomplete='off'/></td>"+
                  "<td><input style='padding: 0px;width: 85px;' type='text' class='inputboxclr' value='"+getData.WAGON_NO+"' name='wagon_no[]' readonly id='wagon_no"+srno+"'  autocomplete='off'/></td>"+
                  "<td><input style='padding: 0px;width: 85px;text-align: right;' type='text' value='"+wagonDate+"' readonly name='wagon_date[]' class='datepicker inputboxclr' id='wagon_date"+srno+"' autocomplete='off'/></td>"+
                  "<td><input style='padding: 0px;width: 85px;text-align: right;' type='text' value='"+getData.RAKE_NO+"' readonly name='rakeNo[]' class='datepicker inputboxclr' id='rakeNo"+srno+"' autocomplete='off'/></td>"+
                  "<td><input style='padding: 0px;width: 70px;text-align: right;text-align: right;' type='text' class='inputboxclr' readonly id='qty"+srno+"' value='"+getData.QTY+"' name='qty[]' style='width: 80px;' /><input style='padding: 0px;width: 70px;text-align: right;text-align: right;' type='hidden' class='inputboxclr' id='unit_M"+srno+"' value='"+getData.UM+"' name='unit_M[]' style='width: 80px;' /><input style='padding: 0px;width: 70px;text-align: right;text-align: right;' type='hidden' class='inputboxclr' id='qty_Arecd"+srno+"' value='' name='qty_Arecd[]' style='width: 80px;' /></td>"+
                  "<td><input style='padding: 0px;width: 70px;text-align: right;' type='text' class='inputboxclr' id='issue_qty"+srno+"' value='"+getData.QTY+"' name='issue_qty[]' style='width: 80px;' oninput='getShortagQty("+srno+")'/></td>"+
                  "<td><input style='padding: 0px;width: 70px;text-align: right;' type='text' class='inputboxclr' id='issue_Aqty"+srno+"' value='"+getData.AQTY+"' name='issue_Aqty[]' style='width: 80px;' oninput='getShortagQty("+srno+")'/></td>"+
                  "<td><input style='padding: 0px;width: 85px;' type='text' class='inputboxclr' value='"+getData.DELIVERY_NO+"' name='delivery_no[]' readonly id='delivery_no"+srno+"'  autocomplete='off'/></td>"+
                  "<td><input style='padding: 0px;width: 85px;text-align:right;' type='text' class='inputboxclr' value='"+ebillNo+"' readonly name='ewaybill_no[]' id='ewaybill_no"+srno+"' autocomplete='off'  /></td>"+
                  "<td><input style='padding: 0px;width: 85px;text-align: right;' type='text' class='inputboxclr datepicker' readonly value='"+eWayBillDate+"' name='ewaybill_date[]' id='ewaybill_date"+srno+"' autocomplete='off'  /><input type='hidden' class='inputboxclr'  name='sp_add[]' id='sp_add"+srno+"' value='"+getData.SP_ADD+"' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='length[]' id='length"+srno+"' value='"+getData.LENGTH+"' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='width[]' id='width"+srno+"' value='"+getData.WIDTH+"' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='height[]' id='height"+srno+"' value='"+getData.HEIGHT+"' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='odc[]' id='odc"+srno+"' value='"+getData.ODC+"' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='aqty[]' id='aqty"+srno+"' value='"+getData.AQTY+"' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='um[]' id='um"+srno+"' value='"+getData.UM+"' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='Aum[]' id='Aum"+srno+"' value='"+getData.AUM+"' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='obd_no[]' id='obd_no"+srno+"' value='"+getData.OBD_NO+"' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='cam_no[]' id='cam_no"+srno+"' value='"+getData.CAM_NO+"' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='trpt_code[]' id='trpt_code"+srno+"' value='"+getData.TRPT_CODE+"' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='trpt_name[]' id='trpt_name"+srno+"' value='"+getData.TRPT_NAME+"' autocomplete='off' readonly /></td><td><input type='text' style='padding: 0px;width: 90px;text-align: right;' class='inputboxclr'  name='material_value[]' readonly id='material_value"+srno+"' value='"+mate_value.toFixed(2)+"' autocomplete='off'/></td></tr>";

                  $('#tbledata').append(bodyData);

                  $(document).ready(function() {

                      $('.datepicker').datepicker({
                        format: 'dd-mm-yyyy',
                        orientation: 'bottom',
                        todayHighlight: 'true',
                        endDate:'today',
                        autoclose: 'true'
                      });
                      
                    });

                srno++;});/* /. each loop */

                uniqueArray = lr_noAry.filter(function(item, pos) {
                    return lr_noAry.indexOf(item) == pos;
                });

                var lastLrNo = uniqueArray.sort((a,b)=>a-b)[uniqueArray.length - 1];
                $('#generateLrNo').val(lastLrNo);

              } /* chck data is blank or not*/

            }/* /. response codn*/

            var form_place =  $("#from_place").val();
            var to_place = $("#to_place").val();

            $.ajax({

              url:"{{ url('get-trip-days-from-place-to-place') }}",

              method : "POST",

              type: "JSON",

              data: {form_place: form_place,to_place:to_place},

              success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  if(data1.data=='' || data1.data==null){

                  }else{

                    $("#tri_days").val(data1.data.TRIP_DAYS);
                    $("#route_code").val(data1.data.ROUTE_CODE);
                    $("#route_name").val(data1.data.ROUTE_NAME);
                  }
                
                }

              }

            }); /* /. AJAX*/

        },/* /. success fun*/
        complete: function() {
          console.log('end spinner');
          $('.modalspinner').addClass('hideloaderOnModl');
        },

    }); /* /. ajax fun*/

  }

/* ------------- get trip details against vehicle no --------------- */


  function getShortagQty(recdQty){

    var issue_qty = $('#issue_qty'+recdQty).val();
    var recd_qty  = $('#qty'+recdQty).val();
    var stdRate   = $('#stdRateItem'+recdQty).val();

    var materialVal = parseFloat(issue_qty) * parseFloat(stdRate);
    $('#material_value'+recdQty).val(materialVal.toFixed(2));
  
    if(parseFloat(issue_qty) > parseFloat(recd_qty)){

       var material_Val = parseFloat(recd_qty) * parseFloat(stdRate);
      $('#material_value'+recdQty).val(material_Val.toFixed(2));
      $('#issue_qty'+recdQty).val(recd_qty);
      $('#recd_qtyErr').html('*Can not enter greater than LS qty').css('color','red');

    }else{
      $('#recd_qtyErr').html('');
    }

  }


   function totalvalCalculation(num,qfeild){


      var mqty = $("#issue_qty"+num).val();
      var maqty = $("#issue_Aqty"+num).val();
      var issuedQty = $("#issue_Aqty"+num).val();
      var mcFactor = $("#cfactor"+num).val();
      var recd_qty  = $('#qty'+num).val();

      if(parseFloat(mqty) > parseFloat(recd_qty)){

     //var material_Val = parseFloat(recd_qty) * parseFloat(stdRate);
     // $('#material_value'+num).val(material_Val.toFixed(2));

      $('#issue_qty'+num).val('0.000');
      $("#issue_Aqty"+num).val('0.000');
      $('#recd_qtyErr').html('*Can not enter greater than LS qty').css('color','red');

	   }else{
		        $('#recd_qtyErr').html('');
		    	if(qfeild=='Q'){

	              maqty = parseFloat(mqty) / parseFloat(mcFactor);
	               $("#issue_Aqty"+num).val(maqty.toFixed(3));
			      }else{

			          mqty = parseFloat(maqty) * parseFloat(mcFactor);
			          $("#issue_qty"+num).val(mqty.toFixed(3));
			      }    
	    }

               

     
      var totqty = 0;

      $(".qtyVal").each(function () {
        
          if (!isNaN(this.value) && this.value.length != 0) {
              totqty += parseFloat(this.value);
          }

        $("#total_Qty").val(totqty.toFixed(3));

      });

      var totAqty = 0;

      $(".aqtyval").each(function () {
        
          if (!isNaN(this.value) && this.value.length != 0) {
              totAqty += parseFloat(this.value);
          }

        $("#total_AQty").val(totAqty.toFixed(3));

      });

  }

/* --------------- START : SUBMIT DATA ------------ */

  function submitLoadingSlipTrans(pdfFlag){


    var route_code = $("#route_code").val();
    var route_name = $("#route_name").val();

    if(route_code=='' && route_name==''){

     
       $("#errmsg").html('*All fields are required');
       return false;

    }else{


    var downloadFlg = pdfFlag;

    $('#pdfYesNoStatus').val(downloadFlg);
    var data = $("#loadingSlipTran").serialize();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        type: 'POST',

        url: "{{ url('/transaction/CandF/outward-dispatch-update') }}",

        data: data, // here $(this) refers to the ajax object not form
        success: function (data) {
            
            var data1 = JSON.parse(data);

            console.log(data1);

            if(data1.response=='error'){

              var responseVar =false;

              var url = "{{ url('/Transaction/View-lorry-receipt-msg') }}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

            }else{

              var responseVar =true;

              if(downloadFlg == 1){

                    var ulrLenght = data1.url.length;

                    console.log(ulrLenght);

                    for(var q=0;q<ulrLenght;q++){

                      var fileN     = 'LRTRAN_'+q+''+downloadFlg;
                      
                      var link      = document.createElement('a');
                      link.href = data1.url[q];
                      link.download = fileN+'.pdf';

                      link.dispatchEvent(new MouseEvent('click'));

                    }
                   
                  }

              var url = "{{ url('/candf/outward-dispatch/save-msg') }}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

            }
         
        },/* /. success function*/

    }); /* /. ajax*/

  }

  }/* /. main function */

/* --------------- END : SUBMIT DATA ------------ */

</script>

<script type="text/javascript">

  $(".delete").on('click', function() {

    $('.case:checkbox:checked').parents("tr").remove();

    $('.check_all').prop("checked", false); 

    check();

  }); /*--function close--*/

  function check(){

    obj = $('table tr').find('span');
    if(obj.length==0){

    }else{
      $.each( obj, function( key, value ) {

        id= value.id;

      });
    }
  }

  var count = $('#data_count').val();

  $(".addmore").on('click',function(){

  var srno = $('table tr').length;

   var data ="<tr><td><input type='checkbox' class='case' id='firstrow"+srno+"' onclick='checkcheckbox("+srno+");'/>"+srno+"</td>"+
        "<td><input list='spcodeList"+srno+"' style='padding: 0px;width: 90px;' class='inputboxclr cpCddata'  name='cp_code[]' onchange='getspName("+srno+")' id='cp_code"+srno+"' value='' autocomplete='off'/><datalist id='spcodeList"+srno+"'></datalist></td>"+
        "<td><input type='text' style='padding: 0px;width: 90px;' class='inputboxclr'  name='cp_name[]' id='cp_name"+srno+"' value='' autocomplete='off'  /><input type='text' style='padding: 0px;width: 90px;' class='inputboxclr'  name='cp_add[]' id='cp_add"+srno+"' value='' autocomplete='off' readonly /></td>"+
        "<td><input style='padding: 0px;width: 90px;border:none' type='hidden' name='body_id[]' id='body_id"+srno+"' class='inputboxclr'  value='' /><input style='padding: 0px;width: 90px;border:none' type='hidden' name='inwardId[]' id='inwardId"+srno+"' class='inputboxclr'  value='' readonly=/><input style='padding: 0px;width: 90px;border:none' type='hidden' name='vrno[]' id='vrno"+srno+"' class='inputboxclr'  value='' /><input style='padding: 0px;width: 90px;border:none' type='hidden' name='slno[]' id='slno"+srno+"' class='inputboxclr'  value='' /><input type='text' style='padding: 0px;width: 90px;' class='inputboxclr'  name='invoice_no[]' id='invoice_no"+srno+"' value='' autocomplete='off'  /></td>"+
        "<td><input type='text' style='padding: 0px;width: 90px;' value='' name='invoice_date[]'  class='datepicker inputboxclr clr' id='invoice_date"+srno+"' autocomplete='off'/></td>"+
        "<td><input type='text' style='padding: 0px;width: 90px;text-align:right;' name='do_no[]' id='do_no"+srno+"' class='inputboxclr'  value=''=''/></td>"+
        "<td><input style='padding: 0px;width: 90px;text-align:right;' class='inputboxclr datepicker' type='text'  value='' name='do_date[]' id='do_date"+srno+"'/></td>"+
        "<td><input style='padding: 0px;width: 90px;text-align:right;' type='text' class='inputboxclr'  name='batch_no[]' id='batch_no"+srno+"' value='' autocomplete='off' readonly /></td>"+
        "<td><input style='padding: 0px;width: 90px;' class='inputboxclr' list='itemcodeList"+srno+"' value='' name='item_code[]' id='item_code"+srno+"' onchange='getitemName("+srno+")'/><datalist id='itemcodeList"+srno+"'><?php foreach ($item_list as $key) { ?><option value='<?= $key->ITEM_CODE ?>' data-xyz='<?= $key->ITEM_NAME ?>'><?= $key->ITEM_CODE ?> - <?= $key->ITEM_NAME ?></option><?php   } ?></datalist></td>"+
        "<td><input style='padding: 0px;' class='inputboxclr' type='text' value='' name='item_remark[]' readonly id='item_remark"+srno+"' /></td>"+
        "<td><input style='padding: 0px;' class='inputboxclr' type='text' value='' name='item_name[]' id='item_name"+srno+"'/></td>"+
        "<td><input style='padding: 0px;width: 85px;text-align: right;' type='text' class='inputboxclr' name='lr_no[]' readonly id='lr_no"+srno+"' value='' autocomplete='off'/><input style='padding: 0px;width: 85px;text-align: right;' type='hidden' class='inputboxclr' name='uniqLrNo[]'  id='uniqLrNo"+srno+"' value='' autocomplete='off'/></td>"+
        "<td><input style='padding: 0px;width: 85px;text-align: right;' type='text' class='inputboxclr datepicker' name='lr_date[]'  id='lr_date"+srno+"' value='' autocomplete='off'/></td>"+
        "<td><input style='padding: 0px;width: 85px;' type='text' class='inputboxclr' value='' name='wagon_no[]' id='wagon_no"+srno+"' autocomplete='off'/></td>"+
        "<td><input style='padding: 0px;width: 85px;text-align: right;' type='text' value=''  name='wagon_date[]' class='datepicker inputboxclr' id='wagon_date"+srno+"' autocomplete='off'/></td>"+
         "<td><input style='padding: 0px;width: 85px;text-align: right;' type='text' value='' readonly name='rakeNo[]' class=' inputboxclr' id='rakeNo"+srno+"' autocomplete='off'/></td>"+
        "<td><input style='padding: 0px;width: 70px;text-align: right;text-align: right;' type='text' class='inputboxclr' id='qty"+srno+"' value='' name='qty[]' style='width: 80px;'/><input style='padding: 0px;width: 70px;text-align: right;text-align: right;' type='hidden' class='inputboxclr' id='unit_M"+srno+"' value='' name='unit_M[]' style='width: 80px;' /><input style='padding: 0px;width: 70px;text-align: right;text-align: right;' type='hidden' class='inputboxclr' id='qty_Arecd"+srno+"' value='' name='qty_Arecd[]' style='width: 80px;' /></td>"+
        "<td><input style='padding: 0px;width: 70px;text-align: right;' type='text' class='inputboxclr' id='issue_qty"+srno+"' value='' name='issue_qty[]' style='width: 80px;' oninput='getShortagQty("+srno+")'/></td>"+
         "<td><input style='padding: 0px;width: 70px;text-align: right;' type='text' class='inputboxclr' id='issue_Aqty"+srno+"' value='' name='issue_Aqty[]' style='width: 80px;' oninput='getShortagQty("+srno+")'/></td>"+
        "<td><input style='padding: 0px;width: 85px;' type='text' class='inputboxclr' value='' name='delivery_no[]' id='delivery_no"+srno+"'  autocomplete='off'/></td>"+
        "<td><input style='padding: 0px;width: 85px;text-align:right;' type='text' class='inputboxclr' value='' name='ewaybill_no[]' id='ewaybill_no"+srno+"' autocomplete='off'  /></td>"+
        "<td><input style='padding: 0px;width: 85px;text-align: right;' type='text' class='inputboxclr datepicker' value='' name='ewaybill_date[]' id='ewaybill_date"+srno+"' autocomplete='off'  /><input type='hidden'  name='sp_code[]' id='sp_code"+srno+"' value='' autocomplete='off' readonly /><input type='hidden'  name='sp_name[]' id='sp_name"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='sp_add[]' id='sp_add"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='length[]' id='length"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='width[]' id='width"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='height[]' id='height"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='odc[]' id='odc"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='aqty[]' id='aqty"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='um[]' id='um"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='Aum[]' id='Aum"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='obd_no[]' id='obd_no"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='delivery_no[]' id='delivery_no"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='cam_no[]' id='cam_no"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='trpt_code[]' id='trpt_code"+srno+"' value='' autocomplete='off' readonly /><input type='hidden' class='inputboxclr'  name='trpt_name[]' id='trpt_name"+srno+"' value='' autocomplete='off' readonly /></td><td><input type='text' style='padding: 0px;width: 90px;' class='inputboxclr'  name='material_value[]' id='material_value"+srno+"' value='' autocomplete='off'/></td></tr>";

        $('table').append(data);

        $('.datepicker').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          endDate: 'today',
          
          autoclose: 'true'

        });

        var vehicleNo = $('#vehicle_no').val();
    
        $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
        });

        $.ajax({

          url:"{{ url('get-trip-no-details-against-vehicle') }}",
          // url:"{{ url('get-outward-dispatch-against-vehicle') }}",
          method : "POST",
          type: "JSON",
          data: {vehicleNo: vehicleNo},

          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.data_outward == ''){

              }else{
              
                var rowsrno = parseInt(srno) - parseInt(1);
              
                $("#spcodeList"+rowsrno).empty();
                $.each(data1.data_outward, function(k, getData) {

                    $("#spcodeList"+rowsrno).append($('<option>',{

                          value:getData.CP_CODE,

                          'data-xyz':getData.CP_NAME,
                          text:getData.CP_CODE+'-'+getData.CP_NAME

                    }));

                });/* /. each loop */

              }

            }/* /. response codn*/

          }/* /. success fun*/

        }); /* /. ajax fun*/

   /*expense data*/

    srno++;
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

</script>

<script type="text/javascript">

  function getspName(srno){

    var val = $('#cp_code'+srno).val();

    var xyz = $('#spcodeList'+srno+' option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
    }else{
      $("#cp_name"+srno).val(msg);
    }

    var fy_code = $('#fy_code').val();
    var vrno = $('#vrnols').val();
        
    if(srno > 1){

        var cpCdAry = [];
    
        $(".cpCddata").each(function () {

          cpCdAry.push(this.value);
          
        });

        var rowWiseCPCode = $('#cp_code'+srno).val();

        cpCdAry.splice(-1);
        var isInArray = cpCdAry.includes(rowWiseCPCode);

        var postionOfVal = cpCdAry.indexOf(rowWiseCPCode);

        if(postionOfVal == '-1'){
          console.log('not Same');
          var getexistVal = $('#generateLrNo').val();

          var lrNoGenerate = parseInt(getexistVal) + parseInt(1);
          $('#generateLrNo').val(lrNoGenerate);
          $('#uniqLrNo'+srno).val(lrNoGenerate);

          var lrslno = fy_code+'-'+vrno+'/'+lrNoGenerate;
           $('#lr_no'+srno).val(lrslno);
        }else{

          var existLr =  parseInt(postionOfVal) + parseInt(1);

          var getExistlrNo = $('#uniqLrNo'+existLr).val();
          console.log('getExistlrNo',getExistlrNo);
          $('#uniqLrNo'+srno).val(getExistlrNo);

            var lrslno = fy_code+'-'+vrno+'/'+getExistlrNo;


          $('#lr_no'+srno).val(lrslno);
        }
        
    }

  }

  function getitemName(srno){

    var val = $('#item_code'+srno).val();

      var xyz = $('#itemcodeList'+srno+' option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){

      // $("#vehicle_owner").val('');
             
    }else{
           
      $("#item_name"+srno).val(msg);
      //   $('#vehicle_no').css('border-color','#d2d6de');
      // $('#transporter_code').css('border-color','#ff0000').focus();
      // $("#transporter_code").prop('readonly', false);
    }
  }

</script>

<script type="text/javascript">
  
  $("#vehicle_no").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#vehicleList option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){

       $('#tran_code,#rake_no,#rake_date,#place_date,#vr_date,#trip_type,#trip_headid,#trip_accCode,#trip_accName,#trip_comp,#trip_fycode,#trip_pfctCode,#trip_seriesCode,#trip_tranCode,#trip_vrDate,#tripNo,#vrnols,#fy_code,#data_count').val('');

       $('#addmorhidn,#deletehidn').prop('disabled',true);
            
    }else{

       $('#tran_code,#rake_no,#rake_date,#place_date,#vr_date,#trip_type,#trip_headid,#trip_accCode,#trip_accName,#trip_comp,#trip_fycode,#trip_pfctCode,#trip_seriesCode,#trip_tranCode,#trip_vrDate,#tripNo,#vrnols,#fy_code,#data_count').val('');

       $('#addmorhidn,#deletehidn').prop('disabled',false);
    }
 
  });
</script>

<script type="text/javascript">
  
  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      endDate: 'today',
      
      autoclose: 'true'

    });

  });
</script>

<script type="text/javascript">
  function validationLrno(slNo){

    var fy_code = $('#fy_code').val();
    var vrno = $('#vrnols').val();
        
    if(slNo > 1){

        var cpCdAry = [];
    
        $(".cpCddata").each(function () {

          cpCdAry.push(this.value);
          
        });

        var rowWiseCPCode = $('#cp_code'+slNo).val();

        cpCdAry.splice(-1);
        var isInArray = cpCdAry.includes(rowWiseCPCode);

        var postionOfVal = cpCdAry.indexOf(rowWiseCPCode);

        if(postionOfVal == '-1'){
          console.log('not Same');
          var getexistVal = $('#generateLrNo').val();

          var lrNoGenerate = parseInt(getexistVal) + parseInt(1);
          $('#generateLrNo').val(lrNoGenerate);
          $('#uniqLrNo'+slNo).val(lrNoGenerate);

          var lrslno = fy_code+'-'+vrno+'/'+lrNoGenerate;
           $('#lr_no'+slNo).val(lrslno);
        }else{

          var existLr =  parseInt(postionOfVal) + parseInt(1);

          var getExistlrNo = $('#uniqLrNo'+existLr).val();
          console.log('getExistlrNo',getExistlrNo);
          $('#uniqLrNo'+slNo).val(getExistlrNo);

            var lrslno = fy_code+'-'+vrno+'/'+getExistlrNo;


          $('#lr_no'+slNo).val(lrslno);
        }
        
    }

  }
</script>

@endsection