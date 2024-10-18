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

  @media screen and (max-width: 600px) {

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
    width: 100%;
    margin-bottom: 2px;
  }
  .tdthtablebordr{
    border: 1px solid #00BB64;
  }
  .table>tbody>tr>td, .table>tbody>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 3px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #00a65a;
    text-align: center;
  }
  .headingText{
    font-size: 16px;
    font-weight: 800;
    color: #5696bb;
    margin-bottom: 1%;
  }
  .readField{
    background-color: #eeeeee;
  }
  .old_bilty_Cls{
    display:none;
  }
  .new_bilty_cls{
    display:none;
  }
  .new_bilty_storage{
    display:none;
  }
  .firstBlock{
    border: 1px solid lightgrey;
    padding-top: 12px;
    -webkit-box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 75%);
    -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 4px 0px rgb(0 0 0 / 38%);
    padding-bottom: 12px;
    height: 340px;
  }
  .secondBlock{
    border: 1px solid lightgrey;
    padding-top: 9px;
    -webkit-box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 75%);
    -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 4px 0px rgb(0 0 0 / 38%);
    margin-left: 4px;
  }
  .thirdBlock{
    border: 1px solid lightgrey;
    padding-top: 9px;
    -webkit-box-shadow: 0px 0px 5px 0px rgb(0 0 0 / 75%);
    -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 4px 0px rgb(0 0 0 / 38%);
    margin-left: 4px;
    margin-top: 4px;
  }
  .numRight{
    text-align:right !important;
  }
  .biltyTitle{
    font-weight: 600;
    border: 1px solid #17a2b8;
    padding: 2px;
    border-radius: 3px;
    font-size: 14px !important;
    background-color: #17a2b8;
    color: #fff;
  }
</style>

<div class="content-wrapper">

  <section class="content-header">
    <h1>{{ $title }}<small>Add Details</small></h1>

    <ul class="breadcrumb">

      <li>
        <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
      </li>

      <li>
        <a href="{{ url('/dashboard') }}">Transaction</a>
      </li>

      <li class="active">
        <a href="{{ url('/Transaction/ColdStorage/Bilty-Mast') }}"> {{ $title }}</a>
      </li>

    </ul>

  </section>

  <form id="biltyTrans">
    @csrf
    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> {{ $title }}</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Transaction/ColdStorage/View-Bilty-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Bilty Transfer.</a>

              </div>

            </div><!-- /.box-header -->

            <div class="box-body">

              <div class="overlay-spinner hideloader"></div>

                <div class="row">

                  <?php 

                      $CurrentDate =date("d-m-Y");
                         
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

                  <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                  <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Customer Code: <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>
            
                          <input list="accList"  id="acc_code" name="acc_code" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Customer Code"> 
                        </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Customer Name: <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>
            
                          <input type="text"  id="acc_name" name="acc_name" class="form-control  pull-left" value="" placeholder="Enter Customer Name" autocomplete="off" readonly> 

                        </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">
                    
                    <div class="form-group">

                      <label>Builty No: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input list="biltyNoList" class="form-control" name="bilty_no" id="bilty_no" value="" placeholder="Select Builty No" onchange="getBiltyData();" autocomplete="off">

                        <datalist id="biltyNoList">

                          <?php foreach ($biltyList as $key) { 
                              $fyYear    = $key->FY_CODE;
                              $splitFy   = explode('-',$fyYear);
                              $startYear = $splitFy[0];
                              $vrNo      = $key->VRNO;
                              $biltyNo   = $startYear.' '.$key->SERIES_CODE.' '.$vrNo;
                            ?>

                            <option value="<?= $biltyNo; ?>" data-xyz="<?= $biltyNo; ?>"><?= $biltyNo; echo ' '.$key->ACC_NAME; ?></option>

                            <?php } ?>

                          </datalist>

                      </div>

                    </div><!-- /.form-group -->

                  </div><!-- col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Item Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input type="text"  id="item_code" name="item_code" class="form-control  pull-left" value="" placeholder="Enter Item Code" autocomplete="off" readonly> 

                      </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label> Item Name : </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" name="item_name" value="" id="item_name" placeholder="Enter Item Name" value="" readonly autocomplete="off">

                        </div>

                    </div>
                    
                  </div><!-- /.col -->

                </div><!-- ./row -->

                <div class="row">

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Packing Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input type="text"  id="packing_code" name="packing_code" class="form-control  pull-left" value="" readonly placeholder="Enter Packing Code" autocomplete="off"> 

                      </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Packing Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input type="text"  id="packing_name" name="packing_name" class="form-control  pull-left" value="" placeholder="Enter Packing Name" autocomplete="off" readonly=""> 

                      </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>Storage Charge Type: <span class="required-field"></span></label>

                       <div class="input-group">

                        <input type="radio" class="optionsRadios1 stChargeType" name="charge_typere" value="PER_UNIT_PER_MONTH" checked="">&nbsp;&nbsp;&nbsp;Per Unit Per Month &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="optionsRadios1 stChargeType" name="charge_typere" value="SEASONAL" >&nbsp;&nbsp;&nbsp;&nbsp;Seasonal &nbsp;&nbsp;&nbsp;&nbsp;

                        <input type="radio" class="optionsRadios1 stChargeType" name="charge_typere" value="FIXED">&nbsp;&nbsp;&nbsp;&nbsp;Fixed

                      </div>
                      <input type="hidden" value="" name="st_ChargeType" id="st_ChargeType">
                    </div>
                
                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label> Quantity : </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" name="qty" value="" id="qty" placeholder="Enter Quantity" value="" readonly autocomplete="off">

                        </div>

                    </div>
                    
                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Rate Per Month : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input type="text"  id="ratePerMonth" name="ratePerMonth" class="form-control  pull-left" value="" autocomplete="off" readonly placeholder="Enter Rate Per Month"> 

                      
                      </div>

                    </div><!-- /.form-group -->

                  </div><!-- /.col -->
                  
                </div><!-- /.row -->

                <div class="row">
                  
                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Market Rate : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input type="text"  id="market_rate" name="market_rate" class="form-control  pull-left" value="" autocomplete="off" readonly placeholder="Enter Market Per"> 
                      </div>
                       <input type="hidden"  id="tilValidDate" name="biltyDate" class="form-control  pull-left" value="" autocomplete="off" readonly placeholder="Enter Bilty Date">
                       <input type="hidden"  id="billRate" name="billRate" class="form-control  pull-left" value="" autocomplete="off" readonly placeholder="Enter Bill Rate">
                    </div><!-- /.form-group -->

                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Bilty Transfer Type: <span class="required-field"></span></label>

                       <div class="input-group">

                        <input type="radio" class="optionsRadios1 biltyTranType" name="bilty_trans_type" value="full_bilty" checked="" onchange="biltyTransType();">&nbsp;Full Bilty<input type="radio" class="optionsRadios1 biltyTranType" name="bilty_trans_type" value="same_bilty"  onchange="biltyTransType();">&nbsp;Part Bilty
                      </div>

                    </div>
                
                  </div><!-- /.col -->

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>&nbsp; </label>

                       <div class="input-group">

                        <input type="radio" class="optionsRadios1 newOldBilty" name="newOld_Bilty" value="new_bilty" checked="">&nbsp;New Bilty &nbsp;
                        <input type="radio" class="optionsRadios1 newOldBilty" name="newOld_Bilty" value="old_bilty" id="oldBilty">&nbsp;<span id="oldBiltyNm">Old Bilty</span> &nbsp;

                      </div>
                      
                    </div>
                
                  </div><!-- /.col -->

                </div><!-- /.row -->
            
              </div><!-- /.box-body -->

          </div><!-- /.custom -->

        </div><!-- /.col -->

      </div><!-- /.row -->

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-body">

              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbleBodydata">

                  <tr id="headingOfTbl">
                    <th>Sr.No.</th>
                    <th>Cold Storage</th>
                    <th>Chamber</th>
                    <th>Floor</th>
                    <th>Block</th>
                    <th>Bilty Qty</th>
                    <th>Dispatched Qty</th>
                    <th>Balence Qty</th>
                    <th>Qty Issued</th>
                  </tr>

                </table><!-- /.table -->

              </div><!-- /.table-responsive -->

            </div><!-- /. box-body -->

          </div><!-- /. Custom-Box -->

        </div><!-- /.col-sm-12 -->

      </div><!-- /.row -->

      <div class="row" style="margin-bottom:2%;">

        <div class="col-sm-12">

          <div class="" style="border: none;box-shadow: none;">

            <div class="box-header" style="text-align: center;background-color: #ecf0f5;padding: 0;">

              <h2 class="box-title biltyTitle" id="getPAgeTitleNAme"> Bilty Transfer To</h2>

            </div>
          </div>

        </div>

      </div>

      <div class="row old_bilty_Cls" id="oldBiltySect">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-body">

              <div class="headingText" style="text-align:center;"> Transfer To</div><br>

              <div class="row">

                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <div class="table-responsive">

                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="biltyTranstbl">

                      <tr>
                        <th>Customer</th>
                        <th>Bilty Transfer Date</th>
                      </tr>

                      <tr>
                        <td class="tdthtablebordr" style="width:75%;">
                          <div>
                            <input list="coldStorageList1" class="inputboxclr" id="cold_storage1" name="cold_Storage[]" oninput="this.value = this.value.toUpperCase()" onchange="coldStorageData(1)" autocomplete="off">
                            <datalist id="coldStorageList1">
                              <option selected="selected" value="">-- Select --</option>
                              <?php foreach ($customerList as $key) { ?>
                                <option value="<?php echo $key->ACC_CODE?>"   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?>
                                </option>
                              <?php } ?>
                            </datalist>
                          </div>
                        </td>
                        <td class='tdthtablebordr'  style='width:25%;'>
                          <div>
                            <input type="text" class="form-control transdatepicker" name="outdate" id="outwardDate" value="" placeholder="Select Date" autocomplete="off">
                          </div>
                        </td>
                      </tr>

                    </table><!-- /.table -->

                  </div><!-- /.table-responsive -->
                </div>
                <div class="col-md-3"></div>
                
              </div>

            </div><!-- /. box-body -->

          </div><!-- /. Custom-Box -->

        </div><!-- /.col-sm-12 -->

      </div><!-- /.row -->

      <div class="row new_bilty_cls" id="newBiltySect">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-body">

              <div class="headingText" style="text-align:center;"> New Bilty</div><br>

              <div class="col-md-12">

                <div class="row">

                  <div class="col-md-5 firstBlock">

                    <div class="row">

                      <div class="col-md-6">

                        <div class="form-group">

                          <label>Builty Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                             <?php 

                                $CurrentDate =date("d-m-Y");
                                   
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

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control transdatepicker" name="bilty_date" id="bilty_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

                            </div>
                            <small id="showmsgfordate" style="color:red;"></small>
                        </div><!-- /.form-group -->

                      </div><!-- /.col -->


                      <div class="col-md-6">

                        <div class="form-group">

                          <label>Customer Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="accList"  id="acc_code" name="acc_code" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Customer Code"> 

                            </div>

                        </div><!-- /.form-group -->

                      </div><!-- /.col -->
                      
                    </div><!-- row -->

                    <div class="row">
                      
                      <div class="col-md-5">

                        <div class="form-group">

                          <label> Vehicle No : <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              <input list="vehicleNoList" class="form-control" name="vehicle_no" value="" id="vehicleNo" placeholder="Enter Vehicle No" autocomplete="off" onchange="getinwardStorageData();" readonly>

                              <datalist id="vehicleNoList">
                          
                                <?php foreach ($vehicleNolist as $key) { ?>

                                  <option value="<?= $key->VEHICLE_NO; ?>" data-xyz="<?= $key->VEHICLE_NO; ?>"><?= $key->VEHICLE_NO; ?></option>
                               <?php } ?>

                              </datalist>

                            </div>

                        </div>
                            <!-- /.form-group -->
                      </div><!-- /.col -->

                      <div class="col-md-7">

                        <div class="form-group">

                          <label>Customer Name: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text"  id="acc_name" name="acc_name" class="form-control  pull-left" value="" placeholder="Enter Customer Name" readonly> 

                            </div>

                        </div><!-- /.form-group -->

                      </div><!-- /.col -->

                    </div><!-- row -->

                    <div class="row">

                      <div class="col-md-5">

                        <div class="form-group">

                          <label> Plant Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              <input list="plantList" class="form-control" name="plant_code" value="" id="plant_code" placeholder="Enter Plant Code" autocomplete="off" readonly>

                            </div>

                        </div><!-- /.form-group -->

                      </div><!-- /.col -->

                      <div class="col-md-7">

                        <div class="form-group">

                          <label> Plant Name : <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              <input type="text" class="form-control" name="plant_name" value="" id="plant_name" placeholder="Enter Plant Name" autocomplete="off" readonly>

                            </div>

                        </div><!-- /.form-group -->

                      </div><!-- /.col -->
                      
                    </div><!-- row -->

                    <div class="row">

                      <div class="col-md-5">

                        <div class="form-group">

                          <label> Pfct Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              <input type="text" class="form-control" name="pfct_code" value="" id="pfct_code" placeholder="Enter Pfct Code" autocomplete="off" readonly>

                            </div>

                        </div><!-- /.form-group -->

                      </div><!-- /.col -->

                      <div class="col-md-7">

                        <div class="form-group">

                          <label> Pfct Name : <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              <input type="text" class="form-control" name="pfct_name" value="" id="pfct_name" placeholder="Enter Pfct Name" autocomplete="off" readonly>

                            </div>

                        </div><!-- /.form-group -->

                      </div><!-- /.col -->
                      
                    </div><!-- row -->

                    <div class="row">

                      <div class="col-md-5">

                        <div class="form-group">

                          <label>Item Code: <span class="required-field"></span></label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                            </div>
              
                            <input type="text"  id="item_code" name="item_code" class="form-control  pull-left" value="" placeholder="Enter Item Code" autocomplete="off" readonly=""> 

                          </div>

                        </div><!-- /.form-group -->

                      </div><!-- /.col -->

                      <div class="col-md-7">

                        <div class="form-group">

                          <label> Item Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="item_name" value="" id="item_name" placeholder="Enter Item Name" value="" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div><!-- /.col -->
                      
                    </div><!-- row -->

                    <div class="row">

                      <div class="col-md-5">

                        <div class="form-group">

                          <label>Packing Code: <span class="required-field"></span></label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                            </div>
              
                            <input type="text"  id="packing_code" name="packing_code" class="form-control  pull-left" value="" placeholder="Enter Packing Code" autocomplete="off" readonly=""> 

                          </div>

                        </div><!-- /.form-group -->

                      </div><!-- /.col -->

                      <div class="col-md-7">

                        <div class="form-group">

                          <label>Packing Name: <span class="required-field"></span></label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                            </div>
              
                            <input type="text"  id="packing_name" name="packing_name" class="form-control  pull-left" value="" placeholder="Enter Packing Name" autocomplete="off" readonly=""> 

                          </div>

                        </div><!-- /.form-group -->

                      </div><!-- /.col -->
                      
                    </div><!-- row -->
                    
                  </div><!-- col md 5 -->

                  <div class="col-md-7">

                    <div class="row">

                      <div class="col-md-12 secondBlock">

                      <div class="row">

                        <div class="col-md-3">

                          <div class="form-group">

                            <label> T Code : <span class="required-field"></span></label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                <input type="text" class="form-control" name="transcode" value="{{$tranlist->TRAN_CODE}}" id="transcode" placeholder="Enter T Code" autocomplete="off" readonly>

                              </div>

                          </div>

                        </div><!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label> Series Code : <span class="required-field"></span></label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                <input list="seriesList" class="form-control" name="series_code" value="" id="series_code" placeholder="Enter Series Code" autocomplete="off" onchange="getvrnoBySeries();" readonly>

                                <datalist id="seriesList">
                                    <?php foreach ($seriesList as $key) { ?>

                                    <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>
                                      
                                    <?php   } ?>
                                </datalist>

                              </div>

                          </div><!-- /.form-group -->

                        </div><!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label> Series Name : <span class="required-field"></span></label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                <input type="text" class="form-control" name="series_name" value="" id="series_name" placeholder="Enter Series Name" readonly autocomplete="off">

                              </div>

                          </div><!-- /.form-group -->
                          
                        </div><!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label> Vr No : <span class="required-field"></span></label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                <input type="text" class="form-control" name="vrseqnum" value="" id="vrseqnum" placeholder="Enter Vr No" readonly autocomplete="off">

                              </div>

                          </div><!-- /.form-group -->
                          
                        </div><!-- /.col -->
                        
                      </div><!-- /.row -->

                      <div class="row">

                        <div class="col-md-4">

                          <div class="form-group">

                            <label> Inward Storage Date: </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input type="text" class="form-control" name="inward_date" value="" id="inward_date" placeholder="Enter Inward Storage Date" readonly autocomplete="off">

                              </div>

                          </div>
                          
                        </div><!-- /.col -->

                        <div class="col-md-8">

                          <div class="form-group">

                            <label>Storage Charge Type: <span class="required-field"></span></label>

                             <div class="input-group">

                              <input type="radio" class="optionsRadios1 stChargeType" name="charge_type" value="PER_UNIT_PER_MONTH" checked="">&nbsp;&nbsp;&nbsp;Per Unit Per Month &nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" class="optionsRadios1 stChargeType" name="charge_type" value="SEASONAL" >&nbsp;&nbsp;&nbsp;&nbsp;Seasonal &nbsp;&nbsp;&nbsp;&nbsp;

                              <input type="radio" class="optionsRadios1 stChargeType" name="charge_type" value="FIXED">&nbsp;&nbsp;&nbsp;&nbsp;Fixed

                            </div>

                          </div>
                      
                        </div><!-- /.col -->
                        
                      </div><!-- /.row -->

                      <div class="row">

                        <div class="col-md-4">

                          <div class="form-group">

                            <label> Quantity : </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input type="text" class="form-control" name="qty" value="" id="qty" placeholder="Enter Quantity" value="" readonly autocomplete="off">

                              </div>

                          </div>
                          
                        </div><!-- /.col -->

                        <div class="col-md-4">

                          <div class="form-group">

                            <label> Billed Quantity : </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input type="text" class="form-control" name="billedQty" value="" id="billedQty" placeholder="Enter Billed Quantity" oninput="billedQtyChk();" value="" autocomplete="off" readonly>

                              </div>
                              <small id="msgBilledErr" style="color:red;font-weight:600;"></small>
                          </div>
                          
                        </div><!-- /.col -->

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>Rate Per Month : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text"  id="ratePerMonth" name="ratePerMonth" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Rate Per Month" readonly> 

                            
                            </div>

                          </div><!-- /.form-group -->

                        </div><!-- /.col -->
                        
                      </div><!-- /.row -->

                      <div class="row">

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>Market Rate : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text"  id="market_rate" name="market_rate" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Market Per" readonly> 

                            
                            </div>

                          </div><!-- /.form-group -->

                        </div><!-- /.col -->

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>Market Value : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text"  id="market_value" name="market_value" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Market Value" readonly> 
                            
                            </div>

                          </div><!-- /.form-group -->

                        </div><!-- /.col -->

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>Reciept Valid Till : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text"  id="validTill_date" name="valid_date" class="form-control  pull-left transdatepicker" value="" autocomplete="off" placeholder="Select Reciept Valid Date" readonly>
                            
                            </div>  
                            <small id="validtillDtMsg" style="color:red;"></small>
                          </div><!-- /.form-group -->

                        </div><!-- /.col -->
                        
                      </div><!-- /.row -->

                      </div><!-- col md12 -->
                      
                    </div><!-- main row -->

                    <div class="row">

                      <div class="col-md-12 thirdBlock">

                      <div class="row">

                        <div class="col-md-4">

                          <div class="form-group">

                            <label> Stack Number :</label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control Number" name="stack_number" value="" id="stack_number" placeholder="Enter Stack Number" autocomplete="off" autocomplete="off" readonly>

                            </div>

                          </div>
                        
                        </div><!-- col -->

                        <div class="col-md-4">

                          <div class="form-group">

                            <label> Class Standard Of Quality 
                            </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="class_quality" name="class_quality" class="form-control  pull-left" value="" placeholder="Enter Class Standard Of Quality" autocomplete="off" style="text-align: end;" readonly>

                              </div>

                          </div>
                             
                        </div><!-- col -->

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>Identification Mark: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              
                                <input type="text" class="form-control" name="identity_mark" id="identity_mark" value="" placeholder="Enter Identification Mark" autocomplete="off" readonly>

                              </div>
                          </div>
                              
                        </div><!-- /.col -->
                        
                      </div><!-- /.row -->

                      <div class="row">

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>Condition Of Goods: <span class="required-field"></span></label>

                            <div class="input-group">
                              <input type="hidden" name="prodCondtn" value="" id="prodCondtn">
                              <input type="radio" class="optionsRadios1" name="prod_cond" value="GOOD">&nbsp;&nbsp;GOOD&nbsp;&nbsp;
                              <input type="radio" class="optionsRadios1" name="prod_cond" value="BAD" >&nbsp;&nbsp;BAD&nbsp;&nbsp;

                              <input type="radio" class="optionsRadios1" name="prod_cond" value="AVG" checked="">&nbsp;&nbsp;AVG&nbsp;&nbsp;

                            </div>
                          </div>
                            
                        </div><!-- /.col -->

                        <div class="col-md-5">

                          <div class="form-group">

                            <label>Remark: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                            
                              <input type="text" class="form-control" name="Remark" id="Remark" value="" placeholder="Select Remark" autocomplete="off" readonly>

                            </div>

                          </div>
                                  
                        </div><!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label> Vehicle Type : <span class="required-field"></span> </label>

                            <div class="input-group">
                              <input type="hidden" name="vehicleType" id="vehicleType" value="">
                              <input type="radio" class="optionsRadios1" name="vehicle_type" value="EMPTY" checked="">&nbsp;&nbsp;EMPTY&nbsp;&nbsp;

                              <input type="radio" class="optionsRadios1" name="vehicle_type" value="LOAD">&nbsp;&nbsp;LOAD&nbsp;&nbsp;

                            </div>

                          </div>

                        </div><!-- /.col -->
                        
                      </div><!-- /.row -->

                      <div class="row">

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>Driver Name : <span class="required-field"></span></label>

                            <div class="input-group">
                              
                              <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                            
                              <input type="text" class="form-control" name="driver_name" id="driver_name" value="" placeholder="Enter Driver Name" readonly autocomplete="off">

                            </div>
                          </div>
                            
                        </div><!-- /.col -->

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>Driver ID : <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-newspaper-o"></i></span>
                            
                              <input type="text" class="form-control" name="driver_id" id="driver_id" value="" placeholder="Enter Driver ID" readonly autocomplete="off">

                            </div>

                          </div>
                                  
                        </div><!-- /.col -->

                        <div class="col-md-4">

                          <div class="form-group">

                            <label> Mobile Number : <span class="required-field"></span> </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                              <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{ old('mobile_number') }}" readonly placeholder="Enter Mobile Number" maxlength="10">

                            </div>

                          </div>

                        </div><!-- /.col -->
                        
                      </div><!-- /.row -->

                      </div><!-- col md 12 -->
                      
                    </div><!-- main row -->
                                      
                  </div><!-- col md 7 -->
                  
                </div><!-- ./row -->

                </div> <!-- col md 12 -->


            </div><!-- /. box-body -->

          </div><!-- /. Custom-Box -->

        </div><!-- /.col-sm-12 -->

      </div><!-- /.row -->

    </section><!-- /.section -->

    <section class="content new_bilty_storage"  style="margin-top: -10%;" id="newBiltyStorage">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-body">

              <div class="row">

                <div class="col-md-12">
                  <div class="table-responsive">

                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="newStorageLoc">

                    </table><!-- /.table -->

                  </div><!-- /.table-responsive -->
                </div>
                
              </div>

            </div><!-- /. box-body -->

          </div><!-- /. Custom-Box -->

        </div><!-- /.col-sm-12 -->

      </div><!-- /.row -->

    </section><!-- /.section -->

  </form>
</div>

<!--  --------- MSG MODAL -------------  -->

<div id="msgModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-sm" style="margin-top: 13%;">
      <div class="modal-content" style="border-radius: 5px;">
          <div class="modal-header"  style="text-align: center;">
              <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
              
          </div>
          <div class="modal-body">
            <p id="msgErr" style="line-height:15px;"></p>
          </div>
          <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-primary" data-dismiss="modal" >OK</button>
          </div>
      </div>
  </div>
</div>

<!--  --------- MSG MODAL -------------  -->

@include('admin.include.footer')

<script type="text/javascript">

  function getBiltyData(){

    var biltyNo = $('#bilty_no').val();
    var tranCd  = 'C4';

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        url:"{{ url('transaction/ColdStorage/data-of-bilty-no') }}",
        method : "POST",
        type: "JSON",
        data: {biltyNo: biltyNo,tranCd:tranCd},
        success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.billDone == ''){

              }else{
                var billDate = [];

                $.each(data1.billDone, function(k, getData){
                  var getbillDate = getData.BILL_DATE;
                  billDate.push(getbillDate);
                });

              }

              if(data1.dataBilty == ''){

              }else{
                
                $("input[name=vehicle_type][value='"+data1.dataBilty[0].VEHICLE_TYPE+"']").prop("checked",true);
                $("input[name=vehicle_type]").prop("disabled",true);
                $('#acc_code').val(data1.dataBilty[0].ACC_CODE);
                $('#acc_name').val(data1.dataBilty[0].ACC_NAME);
                $('#item_code').val(data1.dataBilty[0].ITEM_CODE);
                $('#item_name').val(data1.dataBilty[0].ITEM_NAME);
                $('#packing_code').val(data1.dataBilty[0].PACKING_CODE);
                $('#packing_name').val(data1.dataBilty[0].PACKING_NAME);
                $('#qty').val(data1.dataBilty[0].HEADQTY);
                $('#ratePerMonth').val(data1.dataBilty[0].RATE_PER_MONTH);
                $('#market_rate').val(data1.dataBilty[0].MARKET_RATE);
                var receiptillDT    = data1.dataBilty[0].RECIEPT_TILL_DT;
                var splitDt         = receiptillDT.split('-');
                var reciptTillValid = splitDt[1]+'-'+splitDt[2]+'-'+splitDt[0];
                $('#tilValidDate').val(reciptTillValid);

                $("input[name=prod_cond][value='"+data1.dataBilty[0].COND_GOODS+"']").prop("checked",true);
                $("input[name=prod_cond]").prop("disabled",true);
                $('#st_ChargeType').val(data1.dataBilty[0].STORAGE_TYPE);
                $("input[name=charge_typere][value='"+data1.dataBilty[0].STORAGE_TYPE+"']").prop("checked",true);
                $("input[name=charge_typere]").prop("disabled",true);


                /* ---------- BODY DATA ---------- */

                  var slno=1;
                  $.each(data1.dataBilty, function(k, getData){

                    var balenceQty = parseFloat(getData.BODYQTY) - parseFloat(getData.QTY_ISSUED);

                    var bodyData = "<tr><td class='tdthtablebordr'><span id='snum'>"+slno+".</span><input type='hidden' name='totlRwCount[]' value='"+slno+"' id='totlCountRw"+slno+"'><input type='hidden' value='"+getData.BILTYHID+"' name='bilty_HeadId[]' id='biltyHeadId"+slno+"'><input type='hidden' value='"+getData.BILTYBID+"' name='bilty_BodyId[]' id='biltyBodyId"+slno+"'></td>"+
                    "<td class='tdthtablebordr' style='width: 14%;'><div><input list='coldStorageList"+slno+"' class='inputboxclr readField' id='cold_storage"+slno+"' value='"+getData.CS_CODE+"[ "+getData.CS_NAME+" ]' name='cold_Storage[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                    "<td class='tdthtablebordr' style='width: 14%;'><div><input list='chamberList"+slno+"' class='inputboxclr readField' id='chamber_code"+slno+"' value='"+getData.CHAMBER_CODE+"[ "+getData.CHAMBER_NAME+" ]' name='chamber_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                    "<td class='tdthtablebordr' style='width: 14%;'><div><input list='floorList"+slno+"' class='inputboxclr readField' id='floor_code"+slno+"' value='"+getData.FLOOR_CODE+"[ "+getData.FLOOR_NAME+" ]' name='floor_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                    "<td class='tdthtablebordr'style='width: 14%;'><div><input list='blockList"+slno+"' class='inputboxclr readField' id='block_code"+slno+"' value='"+getData.BLOCK_CODE+"[ "+getData.BLOCK_NAME+" ]' name='block_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                    "<td class='tdthtablebordr' style='width: 11%;'><input type='text' class='inputboxclr readField numRight' id='biltyQty"+slno+"' value="+getData.BODYQTY+" name='biltyQty[]'   oninput='this.value = this.value.toUpperCase()'  autocomplete='off' readonly/></td>"+
                    "<td class='tdthtablebordr' style='width: 11%;'><input type='text' class='inputboxclr readField numRight' id='dispatchQty"+slno+"' value="+getData.QTY_ISSUED+" name='dispatchQty[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></td>"+
                    "<td class='tdthtablebordr' style='width: 11%;'><input type='text' class='inputboxclr readField numRight' id='balenceQty"+slno+"' value="+balenceQty.toFixed(3)+" name='balenceQty[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></td>"+
                    "<td class='tdthtablebordr' style='width: 11%;'><input type='text' class='inputboxclr readField numRight' id='qtyIssued"+slno+"' oninput='qtyIssuedAmt("+slno+")' name='qtyIssued[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' /></td></tr>";

                    $('#headingOfTbl').after(bodyData);

                  slno++;});

                /* ---------- BODY DATA ---------- */


              }

            }

        }
    });

    biltyTransType();
  
  }

    function biltyTransType(){

        var transferType = $('input[name="bilty_trans_type"]:checked').val();

        //onsole.log('transferType',transferType);return false;

        if(transferType == 'same_bilty'){
          $('#oldBilty').hide();
          $('#oldBiltyNm').hide();
          $("input[name=newOld_Bilty][value='new_bilty']").prop("checked",true);
        }else{
          $('#oldBilty').show();
          $('#oldBiltyNm').show();
        }

        var newOld_Bilty     = $('input[name="newOld_Bilty"]:checked').val();

        if((transferType == 'same_bilty' && newOld_Bilty=='new_bilty') || (transferType == 'full_bilty' && newOld_Bilty=='new_bilty') ){

          $('#newBiltySect').removeClass('new_bilty_cls');
          $('#newBiltyStorage').removeClass('new_bilty_storage');
          $('#oldBiltySect').addClass('old_bilty_Cls');

          if(transferType == 'full_bilty'){
            var readCls = 'readonly';
            var addCla ='readField';
          }else if(transferType == 'same_bilty'){
            var readCls = '';
            var addCla ='';
          }

          var biltyNo = $('#bilty_no').val();
          var tranCd  = 'C4';
          console.log('biltyNo',biltyNo);
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({

              url:"{{ url('transaction/ColdStorage/data-of-bilty-no') }}",
              method : "POST",
              type: "JSON",
              data: {biltyNo: biltyNo,tranCd:tranCd},
              success:function(data){

                var data1 = JSON.parse(data);

                if(data1.dataBilty == ''){

                }else{

                  $('#newStorageLoc').empty();

                  var headData ="<tr><th>Sr.No.</th><th>Cold Storage</th><th>Chamber</th><th>Floor</th><th>Block</th><th>Bilty Qty</th><th>Dispatched Qty</th><th>Balence Qty</th><th>Qty Issued</th></tr>";

                  $('#newStorageLoc').append(headData);

                  var slno=1;
                  $.each(data1.dataBilty, function(k, getData){

                    var balenceQty = parseFloat(getData.BODYQTY) - parseFloat(getData.QTY_ISSUED);

                    if(transferType == 'full_bilty'){
                      var fullQty = balenceQty;
                    }else if(transferType == 'same_bilty'){
                      var fullQty = '';
                    }

                    var bodyData = "<tr><td class='tdthtablebordr'><span id='snum'>"+slno+".</span><input type='hidden' name='totlRwCount[]' value='"+slno+"' id='totlCountRw"+slno+"'><input type='hidden' value='"+getData.BILTYHID+"' name='bilty_HeadId[]' id='biltyHeadId"+slno+"'><input type='hidden' value='"+getData.BILTYBID+"' name='bilty_BodyId[]' id='biltyBodyId"+slno+"'></td>"+
                    "<td class='tdthtablebordr' style='width: 14%;'><div><input list='coldStorageList"+slno+"' class='inputboxclr readField' id='cold_storage"+slno+"' value='"+getData.CS_CODE+"[ "+getData.CS_NAME+" ]' name='cold_Storage[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                    "<td class='tdthtablebordr' style='width: 14%;'><div><input list='chamberList"+slno+"' class='inputboxclr readField' id='chamber_code"+slno+"' value='"+getData.CHAMBER_CODE+"[ "+getData.CHAMBER_NAME+" ]' name='chamber_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                    "<td class='tdthtablebordr' style='width: 14%;'><div><input list='floorList"+slno+"' class='inputboxclr readField' id='floor_code"+slno+"' value='"+getData.FLOOR_CODE+"[ "+getData.FLOOR_NAME+" ]' name='floor_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                    "<td class='tdthtablebordr'style='width: 14%;'><div><input list='blockList"+slno+"' class='inputboxclr readField' id='block_code"+slno+"' value='"+getData.BLOCK_CODE+"[ "+getData.BLOCK_NAME+" ]' name='block_code[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></div></td>"+
                    "<td class='tdthtablebordr' style='width: 11%;'><input type='text' class='inputboxclr readField numRight' id='biltyQty"+slno+"' value="+getData.BODYQTY+" name='biltyQty[]'   oninput='this.value = this.value.toUpperCase()'  autocomplete='off' readonly/></td>"+
                    "<td class='tdthtablebordr' style='width: 11%;'><input type='text' class='inputboxclr readField numRight' id='dispatchQty"+slno+"' value="+getData.QTY_ISSUED+" name='dispatchQty[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></td>"+
                    "<td class='tdthtablebordr' style='width: 11%;'><input type='text' class='inputboxclr readField numRight' id='balenceQty"+slno+"' value="+balenceQty.toFixed(3)+" name='balenceQty[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' readonly/></td>"+
                    "<td class='tdthtablebordr' style='width: 11%;'><input type='text' class='inputboxclr numRight "+addCla+"' "+readCls+" id='qtyIssued"+slno+"' oninput='qtyIssuedAmt("+slno+")' name='qtyIssued[]' value='"+fullQty+"' oninput='this.value = this.value.toUpperCase()' autocomplete='off' /></td></tr>";

                    $('#newStorageLoc').append(bodyData);

                  slno++;}); /*each*/

                }/*codn*/

              } /*success*/
          });/*ajax*/

        }else{
          $('#newBiltySect').addClass('new_bilty_cls');
          $('#newBiltyStorage').addClass('new_bilty_storage');
          $('#oldBiltySect').removeClass('old_bilty_Cls');
        }

    }

    $(document).ready(function(){

      $('.newOldBilty').on('change',function(){

        var biltyType = $(this).val();

        if(biltyType == 'old_bilty'){
          $('#oldBiltySect').removeClass('old_bilty_Cls');
          $('#newBiltySect').addClass('new_bilty_cls');
          $('#newBiltyStorage').addClass('new_bilty_storage');
          //$('#oldBiltySect').show();
          //$('#newBiltySect').hide();

        }else if(biltyType =='new_bilty'){
           $('#newBiltySect').removeClass('new_bilty_cls');
          $('#newBiltyStorage').removeClass('new_bilty_storage');
          $('#oldBiltySect').addClass('old_bilty_Cls');
        }


      });
    });

</script>

@endsection