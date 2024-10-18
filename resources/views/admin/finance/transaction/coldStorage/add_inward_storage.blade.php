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

    .showinmobile{
      display: block;
    }
    .PageTitle{
      float: left;
    }
    .hideinmobile{
      display: none;
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
  .space{margin-bottom: 2px;}
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 3px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #00a65a;
    text-align: center;
  }
  .fieldName{
    border:none;
    padding:0px;
    color: #3c8dbc;
    font-weight: 700;
  }
  ::placeholder {
      text-align:left;
    }
  .numberRight{
    text-align:end;
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
        <a href="{{ url('/finance/transaction/store/store-requistion') }}"> {{ $title }}</a>
      </li>

    </ul>

  </section>

<form id="vehicleInwardTran">
  @csrf
  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> {{ $title }}</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/ColdStorage/view-inward-storage-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Inward Storage</a>

            </div>

          </div><!-- /.box-header -->

        <div class="box-body">

          <div class="overlay-spinner hideloader"></div>

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label>Vehicle No:<span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>
                    <input type="hidden" name="headID" id="headID">
                    <input list="vehicleNoList" class="form-control" name="vehicleNo" id="vehicleNo" value="{{ old('vehicleNo') }}" placeholder="Enter Vehicle No" maxlength="40" onchange="vehicleDetails()" autocomplete="off">

                    <datalist id="vehicleNoList">
                      
                      <?php foreach ($vehicleNolist as $key) { ?>

                        <option value="<?= $key->VEHICLE_NO; ?>" data-xyz="<?= $key->VEHICLE_NO; ?>"><?= $key->VEHICLE_NO; ?></option>
                     <?php } ?>

                    </datalist>

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('customerCd', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div> <!-- /.form-group -->

              </div>

              <div class="col-md-2">

                <div class="form-group">

                  <label>Date: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>


                      <input type="text" class="form-control transdatepicker" name="vr_date" id="dateTime" value="" placeholder="Select Date" autocomplete="off" readonly>

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>

                    <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                </div>
                    <!-- /.form-group -->
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Customer Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        
                        <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>

                        <div class="" id="appndplantbtn" style="margin-bottom: -3px;"> 
                        </div>

                      </div>

                      <input type="text" class="form-control" name="acc_code" value="" id="acc_code" placeholder="Enter Customer Code" autocomplete="off" readonly>


                    </div>

                </div>
                
              </div>

              <div class="col-md-2">

                <div class="form-group">

                  <label> Customer Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="acc_name" value="" id="acc_name" placeholder="Enter Customer Name" autocomplete="off" readonly="">

                    </div>

                </div>
                
              </div>

              <div class="col-md-2">

                <div class="form-group">

                  <label> Item Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">
                        
                        <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>

                        <div class="" id="appndplantbtn" style="margin-bottom: -3px;"> 
                        </div>

                      </div>

                      <input type="text" class="form-control" name="item_code" value="" id="item_code" placeholder="Enter Item Code" autocomplete="off" readonly>

                    </div>

                </div>
                
              </div>

              <div class="col-md-2">

                <div class="form-group">

                  <label> Item Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="item_name" value="" id="item_name" placeholder="Enter Item Name" autocomplete="off" readonly="">

                    </div>

                </div>
                
              </div>

            </div> <!-- /.row -->

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label style="width:50%;">UM:<span class="required-field"></span></label>
                  <label style="tab-size: 2">&nbsp;&nbsp;AUM:<span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <div style="display:flex;">
                      <input type="" class="form-control" name="um_OfItem" id="um_OfItem" value="" placeholder="Enter UM" maxlength="40" autocomplete="off" readonly>

                      <input type="" class="form-control" name="aum_OfItem" id="aum_OfItem" value="" placeholder="Enter AUM" maxlength="40" autocomplete="off" readonly>
                    </div>  

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('um_OfItem', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div> <!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Packing Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">
                        
                        <i class="fa fa-newspaper-o hiddenicon" aria-hidden="true" id="accicon"></i>

                        <div class="" id="appndplantbtn" style="margin-bottom: -3px;"> 
                        </div>

                      </div>

                      <input type="text" class="form-control" name="packing_code" value="" id="packing_code" placeholder="Enter Packing Code" autocomplete="off" readonly>

                    </div>

                </div>
                
              </div>

              <div class="col-md-2">

                <div class="form-group">

                  <label> Packing Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="packing_name" value="" id="packing_name" placeholder="Enter Packing Name" autocomplete="off" readonly>

                    </div>

                </div>
                
              </div>

              <div class="col-md-2">

                <div class="form-group">

                  <label>Qty :<span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <input type="text" class="form-control numberRight" name="qty" id="qty" value="{{ old('qty') }}" placeholder="Enter Qty" maxlength="10" autocomplete="off" readonly>

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('qty', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div><!-- /.form-group -->

              </div>

              <div class="col-md-2">

                <div class="form-group">

                  <label>Weight : <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <input type="text" class="form-control numberRight" name="weight" id="weight" value="{{ old('weight') }}" placeholder="Enter Weight" maxlength="40" autocomplete="off" readonly>

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('weight', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div><!-- /.form-group -->

              </div>

              <div class="col-md-2">

                <div class="form-group">

                  <label>Prod Cond : <span class="required-field"></span></label>

                  <div class="input-group">

                    <input type="radio" class="optionsRadios1" name="prod_cond" value="GOOD" checked>&nbsp;GOOD
                    <input type="radio" class="optionsRadios1" name="prod_cond" value="BAD">&nbsp;&nbsp;BAD
                    <input type="radio" class="optionsRadios1" name="prod_cond" value="AVG">&nbsp;&nbsp;AVG

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('prod_cond', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div><!-- /.form-group -->

              </div>
              
            </div><!-- row -->

            <div class="row">

              <div class="col-md-3">

                <div class="form-group">

                  <label>Plant Code: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <input type="text" class="form-control" name="plant_code" id="plant_code" value="{{ old('plant_code') }}" placeholder="Enter Plant Code" maxlength="10" autocomplete="off" readonly> 

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Plant Name: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <input type="text" class="form-control" name="plant_name" id="plant_name" value="{{ old('plant_code') }}" placeholder="Enter Plant Name" maxlength="10" autocomplete="off" readonly> 

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Pfct Code: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <input type="text" class="form-control" name="pfct_code" id="pfct_code" value="{{ old('pfct_code') }}" placeholder="Enter Pfct Code" maxlength="10" autocomplete="off" readonly> 

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('pfct_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Pfct Name: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <input type="text" class="form-control" name="pfct_name" id="pfct_name" value="{{ old('pfct_name') }}" placeholder="Enter Pfct Name" maxlength="10" autocomplete="off" readonly> 

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('pfct_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div><!-- /.form-group -->

              </div><!-- /.col -->
                  
            </div><!-- /.row -->
            
            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label> T Code : </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="trans_code" value="" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                      <input type="hidden" id="transtaxCode" >

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('trans_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Series Code: 

                    <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                    <span class="input-group-addon" style="padding: 1px 7px;">
                         <i class="fa fa-newspaper-o" aria-hidden="true" id="serisicon"></i>

                        <div class="" id="appndbtn">
                            
                        </div>
                    </span>

                    <input list="seriesList1"  id="series_code" name="series_code" class="form-control  pull-left" value="" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly>

                  

                  </div>

                  <small id="series_code_errr" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Series Name : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="series_name" value="" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

                    </div>

                </div>
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Vr No: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                    <input type="text" class="form-control numberRight" name="vr_no" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('vr_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                 </div> <!-- /.form-group -->

              </div><!-- /.col -->
            
              <div class="col-md-2">

                <div class="form-group">

                  <label>Estimate Date: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                    <input type="text" class="form-control estimateDate" name="estimate_time" id="estimate_time" value="" placeholder="Enter Estimate Date" autocomplete="off">

                  </div>

                  <small id="" style="color: red;"></small>

                   <small id="accode_err" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div>

            </div> <!-- row -->

            <div class="row">
                
              <div class="col-md-3">

                <div class="form-group">

                  <label>Driver Name: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                    <input type="text" class="form-control" name="driver_name" id="driver_name" value="" placeholder="Enter Driver Name" autocomplete="off" readonly>

                  </div>

                  <small id="drivername_err" style="color: red;"></small>

                  <small id="emailHelp" class="form-text text-muted">

                         {!! $errors->first('driver_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                         
                  </small>
                </div>
                <!-- /.form-group -->

              </div>

              <div class="col-md-3">

                <div class="form-group">

                  <label>Driver Id Card: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                  
                    <input type="text" class="form-control Number" name="driver_idCard" id="driver_idCard" value="" placeholder="Enter Id Card" autocomplete="off" maxlength="10" readonly>

                  </div>

                  <small id="driverno_err" style="color: red;"></small>

                  <small id="emailHelp" class="form-text text-muted">

                       {!! $errors->first('driver_idCard', '<p class="help-block" style="color:red;">:message</p>') !!}
                       
                   </small>

                </div><!-- /.form-group -->

              </div>

              <div class="col-md-2">

                <div class="form-group">

                  <label>Driver Mobile No: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                  
                    <input type="text" class="form-control Number" name="driver_contact_no" id="driver_contact_no" value="" placeholder="Enter Mobile No" autocomplete="off" maxlength="10" readonly>

                  </div>

                  <small id="driverno_err" style="color: red;"></small>

                  <small id="emailHelp" class="form-text text-muted">

                       {!! $errors->first('driver_contact_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                       
                   </small>

                </div><!-- /.form-group -->

              </div>

              <div class="col-md-2">

                <div class="form-group">

                  <label>Plan No.: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                
                    <input list="planNoList" class="form-control" name="plan_no" id="plan_no" value="" placeholder="Enter Plan No" autocomplete="off" onchange="OrderPlanNo()">

                    <datalist id="planNoList">
                      
                    </datalist>

                  </div>
                  <input type="hidden" id="planReq" value="0">
                </div><!-- /.form-group -->

              </div>

            </div> <!--  /. row -->
                  
        </div><!-- /.box-body -->

        </div><!-- /.custom box -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->

  <section class="content"  style="margin-top: -10%;">

    <div class="row"> 
      <div class="modalspinner hideloaderOnModl"></div>
      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <div class="table-responsive">
              <input type="hidden" id="existRowCount" value="">
              <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                <tr>

                  <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th>
                  <th style="width: 10px;"> Sr.No.</th>
                  <th>Item</th>
                  <th>Cold Storage</th>
                  <th>Chamber </th>
                  <th>Floor</th>
                  <th>Block</th>
                  <th>Quantity</th>
                  <th>UM</th>

                </tr>

                <tr>
                  <td class="tdthtablebordr">
                    <input type='checkbox' class='case' id="firstrow1" onclick='checkcheckbox(1);' />

                    <input type='hidden' id='tempItemSave1' value=''>
                  </td>

                  <td class="tdthtablebordr">
                    <span id='snum'>1.</span>
                    <input type="hidden" class="rowCountCls" id='rowCount1' name="rowCount[]" value="1">
                  </td> 

                  <td class="tdthtablebordr" style="width: 17%;">

                    <div>
                      <input type="text" class="inputboxclr" id='Item_Code1' name="item_code[]"   oninput="this.value = this.value.toUpperCase()" onchange="itemData(1)" style="background-color: #eeeeee;" readonly />
                    </div>
                    
                  </td>

                  <td class="tdthtablebordr" style="width: 17%;">

                    <div>

                      <input list="coldStorageList1" class="inputboxclr" id='cold_storage1' name="cold_Storage[]" oninput="this.value = this.value.toUpperCase()" onchange="coldStorageData(1)" autocomplete="off" readonly/>

                      <datalist id="coldStorageList1">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($coldStorageList as $key)

                          <option value='<?php echo $key->CS_CODE?>'   data-xyz ="<?php echo $key->CS_NAME; ?>" ><?php echo $key->CS_NAME ; echo " [".$key->CS_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>
                    
                  </td>

                  <td class="tdthtablebordr" style="width: 17%;">

                    <div>

                      <input list="chamberList1" class="inputboxclr" id='chamber_code1' name="chamber_code[]"   oninput="this.value = this.value.toUpperCase()" onchange="chamberData(1)" autocomplete="off"/>

                      <datalist id="chamberList1">

                        <option selected="selected" value="">-- Select --</option>

                      </datalist>

                    </div>
                    
                  </td>

                  <td class="tdthtablebordr" style="width: 17%;">

                    <div>
                      <input list="floorList1" class="inputboxclr" id='floor_code1' name="floor_code[]"   oninput="this.value = this.value.toUpperCase()" onchange="floorData(1)" autocomplete="off"/>

                      <datalist id="floorList1">

                        <option selected="selected" value="">-- Select --</option>

                      </datalist>
                    </div>
                    
                  </td>

                  <td class="tdthtablebordr"style="width: 16%;">

                    <div>
                      <input list="blockList1" class="inputboxclr" id='block_code1' name="block_code[]"   oninput="this.value = this.value.toUpperCase()" onchange="blockData(1)" autocomplete="off"/>

                      <datalist id="blockList1">

                        <option selected="selected" value="">-- Select --</option>

                      </datalist>
                    </div>
                    
                  </td>

                  <td class="tdthtablebordr" style="width: 10%;">

                      <input type="text" class="inputboxclr itmQty numberRight" id='qunatity1' oninput="getQtyTotl(1)" name="qunatity[]" autocomplete="off" oninput="this.value = this.value.toUpperCase()"  />
                      <input type="hidden" id="balenceSpace1">
                  </td>

                  <td class="tdthtablebordr" style="width: 6%;">

                      <input type="text" class="inputboxclr" id='umCode1' name="umCode[]"   oninput="this.value = this.value.toUpperCase()" style="background-color: #eeeeee;" readonly />

                  </td>

                </tr>
                
              </table><!-- /.table -->
              
            </div><!-- /.table-responsive -->

            <div class="row">

              <div class="col-sm-12" style="display: flex;">

                <div style="width: 85%;">

                  <button type="button" class='btn btn-danger delete' id="deletehidn" ><i class="fa fa-minus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Delete</button>

                  <button type="button" class='btn btn-info addmore' id="addmorhidn" ><i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Add More</button>
                  <small id="showDubDataMsg" style="color: red;"></small>
                  <input type="hidden" name="dublicateName1[]" id="dublicateName" value="">
                  <input type="hidden" name="deletedubName1[]" id="deletedubName" value="">  
                </div><!-- ./div -->

                <div style="width: 10%;">
                  <input class="debitcreditbox inputboxclr numberRight" style="background-color: #eeeeee;" type="text" name="totalQty" id="totalQty" readonly style="width: 98px;">
                </div><!-- ./div -->

                <div style="width: 5%;">&nbsp;</div><!-- ./div -->
                
              </div><!-- col-sm-12 -->

            </div><!-- row -->

            <div class="row" style="text-align:center;margin-bottom: 5px;font-weight: 700;">
              <small id="fieldReqMsg" style="color:red;"></small>
            </div>

            <div class="row" style="text-align: center;">

              <button class="btn btn-success" type="button" id="submitdata" onclick="submitData()"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

              <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>
              
            </div>
            
          </div><!-- /.box-body -->
          
        </div><!-- /.Custom-Box -->

      </div><!-- /.col -->

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

<script src="{{ URL::asset('public/dist/js/viewjs/coldStorageCommonjs.js') }}" ></script>

<script type="text/javascript">

  $(document).ready(function(){
    fieldValidation();
  });

  /* ---- FIELD VALIDATION ---- */

    function fieldValidation(){

      var varhicleNo   = $('#vehicleNo').val();
      var estimateTime = $('#estimate_time').val();
      var planReq      = $('#planReq').val();
      var plan_no      = $('#plan_no').val();
      console.log('planReq',planReq);
      if(varhicleNo){
        $('#vehicleNo').css('border-color','#d4d4d4');
        if(estimateTime){
          $('#estimate_time').css('border-color','#d4d4d4');
          if(planReq == 0){
            $('#plan_no').css('border-color','#d4d4d4');
          }else{
            if(plan_no){
              $('#plan_no').css('border-color','#d4d4d4');
            }else{
              $('#plan_no').css('border-color','#ff0000').focus();
            }
            
          }
        }else{
          $('#estimate_time').css('border-color','#ff0000').focus();
        }
      }else{
        $('#vehicleNo').css('border-color','#ff0000').focus();
      }
      if(varhicleNo && estimateTime && planReq == 0){
        $('#cold_storage1').prop('readonly',false).css('border-color','#ff0000');
      }else{
        $('#cold_storage1').prop('readonly',true).css('border-color','#d4d4d4');
      }

    }

  /* ---- FIELD VALIDATION ---- */

 /* ---------- DELETE ROW ---------- */ 

    $(".delete").on('click', function() {

        $('.case:checkbox:checked').parents("tr").remove();

        $('.check_all').prop("checked", false); 

        check();

        var whenitmselect = $('#dublicateName').val();
        var splt_arrayOne = whenitmselect.split(',');
        var whenitmcheck = $('#deletedubName').val();
        var splt_arrayTwo = whenitmcheck.split(',');

        splt_arrayOne = splt_arrayOne.filter(function(val) {
            return splt_arrayTwo.indexOf(val) == -1;
        });
         
        splt_arrayTwo = splt_arrayTwo.filter(val => !splt_arrayTwo.includes(val));
        $('#dublicateName').val(splt_arrayOne);

        splt_arrayTwo = splt_arrayTwo.filter(function(val) {
            return splt_arrayOne.indexOf(val) == -1;
        });
         
        splt_arrayOne = splt_arrayOne.filter(val => !splt_arrayOne.includes(val));
        $('#deletedubName').val(splt_arrayOne);

        var sumqty = 0;

        $(".itmQty").each(function () {
          
            if (!isNaN(this.value) && this.value.length != 0) {

                sumqty += parseFloat(this.value);

            }

          $("#totalQty").val(sumqty.toFixed(2));

        });

    });

    function select_all() {

      $('input[class=case]:checkbox').each(function(){ 
        if($('input[class=check_all]:checkbox:checked').length == 0){ 
            $(this).prop("checked", false); 
        }else{
            $(this).prop("checked", true); 
        } 

      });

    }

    function check(){

      obj = $('table tr').find('span');

      if(obj.length==0){
      $('#submitdata').prop('disabled',true);
      $('#totalQty').val('');
      }else{

        $.each( obj, function( key, value ) {
          id=value.id;
          $('#'+id).html(key+1);
        });

      }

    }



 /* ---------- DELETE ROW ---------- */ 

 /* ----------- ADD MORE ROW FUNCTIONALITY --------------- */ 

    var i=2;

    $(".addmore").on('click',function(){

      $('#submitdata').prop('disabled',false);

       count=$('table tr').length;

       var existRow = $('#existRowCount').val();
        if(existRow){
          var ii= parseInt(existRow) + parseInt(i);
        }else{
          var ii= i;
        }

      var data = "<tr><td class='tdthtablebordr'><input type='checkbox' class='case' id='firstrow"+ii+"' onclick='checkcheckbox("+ii+");' /><input type='hidden' id='tempItemSave"+ii+"' value=''></td>"+
        "<td class='tdthtablebordr'><span id='snum"+ii+"'>"+count+".</span><input type='hidden' class='rowCountCls' id='rowCount"+ii+"' name='rowCount[]' value='"+ii+"'></td>"+
        "<td class='tdthtablebordr' style='width: 17%;'><div><input type='text' class='inputboxclr' id='Item_Code"+ii+"' name='item_code[]'   oninput='this.value = this.value.toUpperCase()' onchange='itemData("+ii+")' style='background-color: #eeeeee;' readonly /></div></td>"+
        "<td class='tdthtablebordr' style='width: 17%;'><div><input list='coldStorageList"+ii+"' class='inputboxclr' id='cold_storage"+ii+"' name='cold_Storage[]'   oninput='this.value = this.value.toUpperCase()' onchange='coldStorageData("+ii+")' autocomplete='off' /><datalist id='coldStorageList"+ii+"'><option selected='selected' value=''>-- Select --</option>@foreach ($coldStorageList as $key)<option value='<?php echo $key->CS_CODE?>'   data-xyz ='<?php echo $key->CS_NAME; ?>' ><?php echo $key->CS_NAME ; echo ' ['.$key->CS_CODE.']' ; ?></option>@endforeach</datalist></div></td>"+
        "<td class='tdthtablebordr' style='width: 17%;'><div><input list='chamberList"+ii+"' class='inputboxclr' id='chamber_code"+ii+"' name='chamber_code[]'   oninput='this.value = this.value.toUpperCase()' onchange='chamberData("+ii+")' autocomplete='off'/><datalist id='chamberList"+ii+"'><option selected='selected' value=''>-- Select --</option></datalist></div></td>"+
        "<td class='tdthtablebordr' style='width: 17%;'><div><input list='floorList"+ii+"' class='inputboxclr' id='floor_code"+ii+"' name='floor_code[]'   oninput='this.value = this.value.toUpperCase()' onchange='floorData("+ii+")' autocomplete='off'/><datalist id='floorList"+ii+"'><option selected='selected' value=''>-- Select --</option></datalist></div></td>"+
        "<td class='tdthtablebordr'style='width: 16%;'><div><input list='blockList"+ii+"' class='inputboxclr' id='block_code"+ii+"' name='block_code[]'   oninput='this.value = this.value.toUpperCase()' onchange='blockData("+ii+")' autocomplete='off'/><datalist id='blockList"+ii+"'><option selected='selected' value=''>-- Select --</option></datalist></div></td>"+
        "<td class='tdthtablebordr' style='width: 10%;'><input type='text' class='inputboxclr numberRight itmQty' id='qunatity"+ii+"' name='qunatity[]' autocomplete='off' oninput='getQtyTotl("+ii+");' oninput='this.value = this.value.toUpperCase()'  /><input type='hidden' id='balenceSpace"+ii+"'></td>"+
        "<td class='tdthtablebordr' style='width: 6%;'><input type='text' class='inputboxclr' id='umCode"+ii+"' name='umCode[]' style='background-color: #eeeeee;' readonly  oninput='this.value = this.value.toUpperCase()'/></td>";

        $('table').append(data);

        var itemCd = $('#item_code').val();
        var itemNm = $('#item_name').val();
        var umCd = $('#um_OfItem').val();
        if(itemCd){
          $('#Item_Code'+ii).val(itemCd+'[ '+itemNm+' ]');
          $('#umCode'+ii).val(umCd);
        }
        
    i++;});

 /* ----------- ADD MORE ROW FUNCTIONALITY --------------- */ 
  
  $(document).ready(function() {

    $('#estimate_time').on('change',function(){

        fieldValidation();

    });

     $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

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

</script>

<script type="text/javascript">
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

    $('.estimateDate').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      startDate :fromdateintrans,
      endDate : todateintrans,
      autoclose: 'true'

    });

  });

</script>


<script type="text/javascript">

  function getQtyTotl(num){ 

    var qty = $('#qunatity'+num).val();
    if(qty){
      $('#qunatity'+num).css('border-color','#d4d4d4');
    }else{
      $('#qunatity'+num).css('border-color','#ff0000').focus();
    }

    /* ------- CHECK AVAILABLE SPACE ------ */

      var balenceSpace = parseFloat($('#balenceSpace'+num).val());
      var quantity = parseFloat($('#qunatity'+num).val());

      if(quantity > balenceSpace){
        $('#qunatity'+num).val('');
        $("#msgModal").modal('show');
        $('#msgErr').html('<b>Qty Should not be greater than available space</b>');

      }

    /* ------- CHECK AVAILABLE SPACE ------ */

    var sumqty = 0;

    $(".itmQty").each(function () {
      
        if (!isNaN(this.value) && this.value.length != 0) {

            sumqty += parseFloat(this.value);

        }

      $("#totalQty").val(sumqty.toFixed(3));

    });
  }

  function coldStorageData(srno){

    var coldst =  $('#cold_storage'+srno).val();
    var xyz = $('#coldStorageList'+srno+' option').filter(function() {

      return this.value == coldst;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $('#cold_storage'+srno+',#chamber_code'+srno+',#floor_code'+srno+',#block_code'+srno+'').val('');
      $('#chamberList'+srno+',#floorList'+srno+',#blockList'+srno+'').empty();
      $('#cold_storage'+srno).css('border-color','#ff0000').focus();
      $('#chamber_code'+srno).css('border-color','#d4d4d4');
      
    }else{
      $('#chamber_code'+srno+',#floor_code'+srno+',#block_code'+srno+'').val('');
      $('#chamberList'+srno+',#floorList'+srno+',#blockList'+srno+'').empty();
      $('#cold_storage'+srno).css('border-color','#d4d4d4');
      $('#chamber_code'+srno).css('border-color','#ff0000').focus();

      $('#cold_storage'+srno).val(coldst+'[ '+msg+' ]');

      var coldsCD = $('#cold_storage'+srno).val();
      var splitcd = coldsCD.split('[');
      var csCD = splitcd[0];
      var master = 'COLDSTORAGE';
      getStorage(csCD,'','','',master,srno);
    }

    $('#fieldReqMsg').html('');

  }

  function chamberData(srno){

    var chamberCd =  $('#chamber_code'+srno).val();
    var xyz = $('#chamberList'+srno+' option').filter(function() {

      return this.value == chamberCd;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $('#chamber_code'+srno+',#floor_code'+srno+',#block_code'+srno+'').val('');
      $('#floorList'+srno+',#blockList'+srno+'').empty();

      $('#chamber_code'+srno).css('border-color','#ff0000').focus();
      $('#floor_code'+srno).css('border-color','#d4d4d4');

    }else{

      $('#floor_code'+srno+',#block_code'+srno+'').val('');
      $('#floorList'+srno+',#blockList'+srno+'').empty();

      $('#chamber_code'+srno).css('border-color','#d4d4d4');
      $('#floor_code'+srno).css('border-color','#ff0000').focus();

      $('#chamber_code'+srno).val(chamberCd+'[ '+msg+' ]');

      var chambercode  = $('#chamber_code'+srno).val();
      var splitChamber = chambercode.split('[');
      var chamberCD    = splitChamber[0];

      var coldStoreCd    =  $('#cold_storage'+srno).val();
      var splitcoldStore = coldStoreCd.split('[');
      var csCD           = splitcoldStore[0];
      
      var master    = 'CHAMBERSTORAGE';
      getStorage(csCD,chamberCD,'','',master,srno);
    }

    $('#fieldReqMsg').html('');

  }

  function floorData(srno){

    var floorCd =  $('#floor_code'+srno).val();
    var xyz = $('#floorList'+srno+' option').filter(function() {

      return this.value == floorCd;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $('#floor_code'+srno+',#block_code'+srno+'').val('');
      $('#blockList'+srno+'').empty();
      $('#floor_code'+srno).css('border-color','#ff0000').focus();
      $('#block_code'+srno).css('border-color','#d4d4d4');
    }else{

      $('#block_code'+srno+'').val('');
      $('#blockList'+srno+'').empty();

      $('#floor_code'+srno).css('border-color','#d4d4d4');
      $('#block_code'+srno).css('border-color','#ff0000').focus();

      $('#floor_code'+srno).val(floorCd+'[ '+msg+' ]');

      var cstoreCD       =  $('#cold_storage'+srno).val();
      var splitcoldStore = cstoreCD.split('[');
      var csCD           = splitcoldStore[0];

      var chamberCode    = $('#chamber_code'+srno).val();
      var splitchamber   = chamberCode.split('[');
      var chamberCD      = splitchamber[0];

      var floorcode      = $('#floor_code'+srno).val();
      var splitfloor     = floorcode.split('[');
      var floorCD        = splitfloor[0];

      var master    = 'FLOORSTORAGE';

       getStorage(csCD,chamberCD,floorCD,'',master,srno);
    }

    $('#fieldReqMsg').html('');
  }

  function blockData(srno){

    var blockCd =  $('#block_code'+srno).val();
    var xyz = $('#blockList'+srno+' option').filter(function() {

      return this.value == blockCd;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $('#block_code'+srno).val('');
      $('#block_name'+srno).val('');
      $('#block_code'+srno).css('border-color','#ff0000').focus();
      $('#qunatity'+srno).css('border-color','#d4d4d4');
    }else{
      $('#block_code'+srno).css('border-color','#d4d4d4');
      $('#qunatity'+srno).css('border-color','#ff0000').focus();

      $('#block_code'+srno).val(blockCd+'[ '+msg+' ]');

      var cstoreCD       =  $('#cold_storage'+srno).val();
      var splitcoldStore = cstoreCD.split('[');
      var csCD           = splitcoldStore[0];

      var chamberCode    = $('#chamber_code'+srno).val();
      var splitchamber   = chamberCode.split('[');
      var chamberCD      = splitchamber[0];

      var floorcode      = $('#floor_code'+srno).val();
      var splitfloor     = floorcode.split('[');
      var floorCD        = splitfloor[0];

      var blockcode      = $('#block_code'+srno).val();
      var splitblock     = blockcode.split('[');
      var blockCD        = splitblock[0];

      var master    = 'BLOCKSTORAGE';

      getStorage(csCD,chamberCD,floorCD,blockCD,master,srno);
    }

    $('#fieldReqMsg').html('');

  }

  function getStorage(field1,field2,field3,field4,master,slNo){

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

          url:"{{ url('cold-storage/get-prev-storage-data') }}",
          method : "POST",
          type: "JSON",
          data: {field1: field1,field2:field2,field3:field3,field4:field4,master:master},
          success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {
                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
              }else if(data1.response == 'success'){

                if(data1.chamber_list==''){

                }else{

                  $("#chamberList"+slNo).empty();

                  $.each(data1.chamber_list, function(k, getAum){

                    $("#chamberList"+slNo).append($('<option>',{

                      value:getAum.CHAMBER_CODE,

                      'data-xyz':getAum.CHAMBER_NAME,
                      text:getAum.CHAMBER_NAME

                    }));

                  });

                }

                if(data1.floor_list==''){

                }else{

                  $("#floorList"+slNo).empty();

                  $.each(data1.floor_list, function(k, getAum){

                    $("#floorList"+slNo).append($('<option>',{

                      value:getAum.FLOOR_CODE,

                      'data-xyz':getAum.FLOOR_NAME,
                      text:getAum.FLOOR_NAME

                    }));

                  });

                }

                if(data1.block_list==''){

                }else{

                  $("#blockList"+slNo).empty();

                  $.each(data1.block_list, function(k, getAum){

                    $("#blockList"+slNo).append($('<option>',{

                      value:getAum.BLOCK_CODE,

                      'data-xyz':getAum.BLOCK_NAME,
                      text:getAum.BLOCK_NAME

                    }));

                  });

                }

                if(data1.bal_space_data == ''){

                }else{
                  $('#balenceSpace'+slNo).val(data1.bal_space_data[0].BALANCE_SPACE);
                }
              }
          }
    });

    if(field4){

      /* ------ if data change ------- */

      var temItem    = $('#tempItemSave'+slNo).val();
      var getSelData = $('#dublicateName').val(); 
      var slptData   = getSelData.split(',');
      var indexDt    = slptData.indexOf(temItem);
      if (indexDt > -1) { // only splice array when item is found
        slptData.splice(indexDt, 1); // 2nd parameter means remove one item only
      }
      $('#dublicateName').val('');
      $('#dublicateName').val(slptData);

    /* ------ if data change ------- */

      checkDubicateBodyEntry(slNo,field1,field2,field3,field4);
    }

  }
  
</script>

<script>

  function vehicleDetails(){

    var vehicle_No = $("#vehicleNo").val();

    var xyz = $('#vehicleNoList option').filter(function() {

        return this.value == vehicle_No;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
      $("#existRowCount,#vehicleNo,#dateTime,#acc_code,#acc_name,#item_code,#item_name,#um_OfItem,#aum_OfItem,#packing_code,#packing_name,#qty,#weight,#plant_code,#plant_name,#pfct_code,#pfct_name,#series_code,#seriesName,#vrseqnum,#driver_name,#driver_idCard,#driver_mobile,#plan_no").val('');
      $('#planReq').val('0');
      $('#planNoList').empty();
    }else{
      $("#existRowCount,#dateTime,#acc_code,#acc_name,#item_code,#item_name,#um_OfItem,#aum_OfItem,#packing_code,#packing_name,#qty,#weight,#plant_code,#plant_name,#pfct_code,#pfct_name,#series_code,#seriesName,#vrseqnum,#driver_name,#driver_idCard,#driver_mobile,#plan_no").val('');
      $('#planReq').val('0');
      $('#planNoList').empty();
    }

      $.ajaxSetup({

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }

      });

      $.ajax({

          url:"{{ url('get-vehicle-entry-details') }}",

          method : "POST",

          type: "JSON",

          data: {vehicle_No: vehicle_No},
          beforeSend: function() {
            console.log('start spinner');
            $('.modalspinner').removeClass('hideloaderOnModl');
          },
          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {
                    
              $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Data Not Found...!</p>");

            }else if(data1.response == 'success'){

                $("#headID").val(data1.datainwardEntry[0].CSVEHICLEHID);
                $("#acc_code").val(data1.datainwardEntry[0].ACC_CODE);
                $("#acc_name").val(data1.datainwardEntry[0].ACC_NAME);
                $("#item_code").val(data1.datainwardEntry[0].ITEM_CODE);
                $("#item_name").val(data1.datainwardEntry[0].ITEM_NAME);
                $("#packing_code").val(data1.datainwardEntry[0].PACKING_CODE);
                $("#packing_name").val(data1.datainwardEntry[0].PACKING_NAME);
                $("#qty").val(data1.datainwardEntry[0].QTY);
                $("#weight").val(data1.datainwardEntry[0].WEIGHT);
                $("input[name=prod_cond][value='"+data1.data.PROD_CONDITION+"']").prop("checked",true);
                $("input[name=prod_cond]").prop("disabled",true);
                $("#plant_code").val(data1.datainwardEntry[0].PLANT_CODE);
                $("#plant_name").val(data1.datainwardEntry[0].PLANT_NAME);
                $("#pfct_code").val(data1.datainwardEntry[0].PFCT_CODE);
                $("#pfct_name").val(data1.datainwardEntry[0].PFCT_NAME);
                $("#driver_name").val(data1.datainwardEntry[0].DRIVER_NAME);
                $("#driver_idCard").val(data1.datainwardEntry[0].DRIVER_IDCARD);
                $("#driver_contact_no").val(data1.datainwardEntry[0].DRIVER_CONTACT_NO);
                $("#transcode").val(data1.datainwardEntry[0].TRAN_CODE);
                $("#series_code").val(data1.datainwardEntry[0].SERIES_CODE);
                $("#seriesName").val(data1.datainwardEntry[0].SERIES_NAME);
                $("#vrseqnum").val(data1.datainwardEntry[0].VRNO);
                $("#umCode1").val(data1.datainwardEntry[0].UM_CODE);
                $("#um_OfItem").val(data1.datainwardEntry[0].UM_CODE);
                $("#aum_OfItem").val(data1.datainwardEntry[0].AUM_CODE);
                $("#Item_Code1").val(data1.datainwardEntry[0].ITEM_CODE+'[ '+data1.datainwardEntry[0].ITEM_NAME+' ]');

                var entryDate = data1.datainwardEntry[0].VRDATE;
                var splitDate = entryDate.split('-');
                var vr_Date = splitDate[2]+'-'+splitDate[1]+'-'+splitDate[0];
                $('#dateTime').val(vr_Date);
                $('#dateTime').datepicker("destroy");

                if(data1.dataOrderPlan == ''){
                  $('#planReq').val("0");
                }else{
                  $('#planReq').val("1");
                  $("#planNoList").empty();

                  $.each(data1.dataOrderPlan, function(k, getop){

                    $("#planNoList").append($('<option>',{

                      value:getop.CSPHID,

                      'data-xyz':getop.CSPHID,
                      text:getop.CSPHID

                    }));

                  });

                } /* /. ORDER PLAN CODN*/
                   
            } /* /. SUCCESS CODN */

            fieldValidation();
          },
          complete: function() {
            console.log('end spinner');
            $('.modalspinner').addClass('hideloaderOnModl');
          },


      });

    
  }

  function OrderPlanNo(){

    var planNo   = $('#plan_no').val();
    var acc_code = $('#acc_code').val();

    var xyz = $('#planNoList option').filter(function() {

        return this.value == planNo;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $('#plan_no').val('');
    }else{

      $.ajaxSetup({

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }

      });

      $.ajax({

          url:"{{ url('get-storage-space-from-order-plan') }}",

          method : "POST",

          type: "JSON",

          data: {planNo: planNo,acc_code:acc_code},
          beforeSend: function() {
            console.log('start spinner');
            $('.modalspinner').removeClass('hideloaderOnModl');
          },
          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {
                    
              $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Data Not Found...!</p>");

            }else if(data1.response == 'success'){

              if(data1.dataPlan == ''){

              }else{

                $('#cold_storage1').css('border-color','#d4d4d4');

                var slNo=1;
                $('#existRowCount').val(data1.dataPlan.length);
                $.each(data1.dataPlan, function(k, getcs){

                  if(slNo == 1){

                    $('#cold_storage'+slNo).val(getcs.CS_CODE+'[ '+getcs.CS_NAME+' ]');
                    $('#chamber_code'+slNo).val(getcs.CHAMBER_CODE+'[ '+getcs.CHAMBER_NAME+' ]');
                    $('#floor_code'+slNo).val(getcs.FLOOR_CODE+'[ '+getcs.FLOOR_NAME+' ]');
                    $('#block_code'+slNo).val(getcs.BLOCK_CODE+'[ '+getcs.BLOCK_NAME+' ]');
                    $('#qunatity'+slNo).val(getcs.QTY);

                  }else{  
                    var getItem     = $('#Item_Code1').val();
                    var umCode      = $('#umCode1').val();
                    var csCode      = getcs.CS_CODE+'[ '+getcs.CS_NAME+' ]';
                    var chamberCode = getcs.CHAMBER_CODE+'[ '+getcs.CHAMBER_NAME+' ]';
                    var floorCode   = getcs.FLOOR_CODE+'[ '+getcs.FLOOR_NAME+' ]';
                    var blockCode   = getcs.BLOCK_CODE+'[ '+getcs.BLOCK_NAME+' ]';

                    var trcount=$('table tr').length;

                    var bodyData = "<tr><td class='tdthtablebordr'><input type='checkbox' class='case' id='firstrow"+slNo+"' onclick='checkcheckbox("+slNo+");'/><input type='hidden' id='tempItemSave"+slNo+"' value=''></td>"+
                    "<td class='tdthtablebordr'><span id='snum"+slNo+"'>"+trcount+".</span><input type='hidden' class='rowCountCls' id='rowCount"+slNo+"' name='rowCount[]' value='"+slNo+"'></td>"+
                    "<td class='tdthtablebordr' style='width: 17%;'><div><input type='text' class='inputboxclr' value='"+getItem+"' id='Item_Code"+slNo+"' name='item_code[]'   oninput='this.value = this.value.toUpperCase()' onchange='itemData("+slNo+")' style='background-color: #eeeeee;' readonly /></div></td>"+
                    "<td class='tdthtablebordr' style='width: 17%;'><div><input list='coldStorageList"+slNo+"' class='inputboxclr' id='cold_storage"+slNo+"' name='cold_Storage[]' value='"+csCode+"' oninput='this.value = this.value.toUpperCase()' onchange='coldStorageData("+slNo+")' autocomplete='off' readonly/><datalist id='coldStorageList1'><option selected='selected' value=''>-- Select --</option>@foreach ($coldStorageList as $key)<option value='<?php echo $key->CS_CODE?>' data-xyz ='<?php echo $key->CS_NAME; ?>' ><?php echo $key->CS_NAME ; echo ' ['.$key->CS_CODE.']' ; ?></option>@endforeach</datalist></div></td>"+
                    "<td class='tdthtablebordr' style='width: 17%;'><div><input list='chamberList"+slNo+"' class='inputboxclr' id='chamber_code"+slNo+"' name='chamber_code[]' value='"+chamberCode+"' oninput='this.value = this.value.toUpperCase()' onchange='chamberData("+slNo+")' autocomplete='off'/><datalist id='chamberList"+slNo+"'><option selected='selected' value=''>-- Select --</option></datalist></div></td>"+
                    "<td class='tdthtablebordr' style='width: 17%;'><div><input list='floorList"+slNo+"' class='inputboxclr' id='floor_code"+slNo+"' name='floor_code[]' value='"+floorCode+"'  oninput='this.value = this.value.toUpperCase()' onchange='floorData("+slNo+")' autocomplete='off'/><datalist id='floorList"+slNo+"'><option selected='selected' value=''>-- Select --</option></datalist></div></td>"+
                    "<td class='tdthtablebordr'style='width: 16%;'><div><input list='blockList"+slNo+"' class='inputboxclr' value='"+blockCode+"' id='block_code"+slNo+"' name='block_code[]'   oninput='this.value = this.value.toUpperCase()' onchange='blockData("+slNo+")' autocomplete='off'/><datalist id='blockList"+slNo+"'><option selected='selected' value=''>-- Select --</option></datalist></div></td>"+
                    "<td class='tdthtablebordr' style='width: 10%;'><input type='text' class='inputboxclr itmQty numberRight' id='qunatity"+slNo+"' oninput='getQtyTotl("+slNo+")' name='qunatity[]' autocomplete='off' oninput='this.value = this.value.toUpperCase()' value='"+getcs.QTY+"' /><input type='hidden' id='balenceSpace"+slNo+"'></td>"+
                    "<td class='tdthtablebordr' style='width: 6%;'><input type='text' class='inputboxclr' id='umCode"+slNo+"' value='"+umCode+"' name='umCode[]'   oninput='this.value = this.value.toUpperCase()' style='background-color: #eeeeee;' readonly /></td></tr>";

                    $('table').append(bodyData);

                  }/* /. slno Codn*/

                  var cstoreCD       =  $('#cold_storage'+slNo).val();
                  var splitcoldStore = cstoreCD.split('[');
                  var csCD           = splitcoldStore[0];

                  var chamberCode    = $('#chamber_code'+slNo).val();
                  var splitchamber   = chamberCode.split('[');
                  var chamberCD      = splitchamber[0];

                  var floorcode      = $('#floor_code'+slNo).val();
                  var splitfloor     = floorcode.split('[');
                  var floorCD        = splitfloor[0];

                  var blockcode      = $('#block_code'+slNo).val();
                  var splitblock     = blockcode.split('[');
                  var blockCD        = splitblock[0];
                                    
                  if(cstoreCD){

                    var master         = 'COLDSTORAGE';
                    getStorage(csCD,'','','',master,slNo);

                  }

                  if(chamberCode){
                    
                    var master         = 'CHAMBERSTORAGE';
                    getStorage(csCD,chamberCD,'','',master,slNo);

                  }

                  if(floorCD){
                    var master    = 'FLOORSTORAGE';
                    getStorage(csCD,chamberCD,floorCD,'',master,slNo);
                  }
                  
                  if(blockcode){
                    var master    = 'BLOCKSTORAGE';
                    getStorage(csCD,chamberCD,floorCD,blockCD,master,slNo);
                  }

                  getQtyTotl();
                  
                slNo++;});

              }

            }/* /. SUCCESS CODN*/

          }, /* /.SUCCESS FUNC*/
          complete: function() {
            console.log('end spinner');
            $('.modalspinner').addClass('hideloaderOnModl');
          }, 

      }); /* / .AJAX*/

    } /* /. NO MATCH CODN*/

    fieldValidation();

  } /* /. ORDER PLAN NO FUNCTION*/

  /* ------- CHECK DUBLICATE BODY ENTRY -------- */

  function checkDubicateBodyEntry(slNo,coldStorage,chamber,floor,block){

      if(coldStorage && chamber && floor && block){

        var checkDublicates = coldStorage+'~'+chamber+'~'+floor+'~'+block;
        var existVal = $("#dublicateName").val();

        if(existVal == ''){
          $("#dublicateName").val(checkDublicates);
          $("#tempItemSave"+slNo).val(checkDublicates);
        }else{
          var blnkAry = [];
          var existGet = $("#dublicateName").val();

          if (existGet.indexOf(',') != -1){

            var segments = existGet.split(',');

            for(var i=0;i<segments.length;i++){
              blnkAry.push(segments[i]);
            }

            var checkDub = blnkAry.includes(checkDublicates);

            if(checkDub == true){
              $('#showDubDataMsg').html('Dublicate Details');
              
               $('#cold_storage'+slNo+',#chamber_code'+slNo+',#floor_code'+slNo+',#block_code'+slNo+',#balenceSpace'+slNo+'').val('');
              
                $('#blockList'+slNo+',#floor_code'+slNo+',#chamber_code'+slNo+'').empty();

            }else if(checkDub == false){
              $('#showDubDataMsg').html('');
              var getPrevVal = $("#dublicateName").val();
              $("#dublicateName").val(getPrevVal+','+checkDublicates);
              $("#tempItemSave"+slNo).val(checkDublicates);
            }

          }else{

            var blnkAry1 = [];
            var existGet1 = $("#dublicateName").val();
            blnkAry1.push(existGet1);

            var checkDub1 = blnkAry1.includes(checkDublicates);

            if(checkDub1 == true){
              $('#showDubDataMsg').html('Dublicate Details');
              
              $('#cold_storage'+slNo+',#chamber_code'+slNo+',#floor_code'+slNo+',#block_code'+slNo+',#balenceSpace'+slNo+'').val('');
              
              $('#blockList'+slNo+',#floor_code'+slNo+',#chamber_code'+slNo+'').empty();

             // totalvalCalculation();
            }else if(checkDub1 == false){
              $('#showDubDataMsg').html('');
              var getPrevVal1 = $("#dublicateName").val();
              $("#dublicateName").val(getPrevVal1+','+checkDublicates);    
              $("#tempItemSave"+slNo).val(checkDublicates);
                                     
            }

          }
        }

      }else{
          
      }
    }

    function checkcheckbox(slNo){

      var cstoreCD       =  $('#cold_storage'+slNo).val();
      var splitcoldStore = cstoreCD.split('[');
      var csCD           = splitcoldStore[0];

      var chamberCode    = $('#chamber_code'+slNo).val();
      var splitchamber   = chamberCode.split('[');
      var chamberCD      = splitchamber[0];

      var floorcode      = $('#floor_code'+slNo).val();
      var splitfloor     = floorcode.split('[');
      var floorCD        = splitfloor[0];

      var blockcode      = $('#block_code'+slNo).val();
      var splitblock     = blockcode.split('[');
      var blockCD        = splitblock[0];

      var dublicateName = csCD+'~'+chamberCD+'~'+floorCD+'~'+blockCD;

      if($('#firstrow'+slNo).is(':checked')) {
        
        var delArry = $("#deletedubName").val();

        if(delArry==''){
          $("#deletedubName").val(dublicateName);
        }else{
          var getPrevVal = $("#deletedubName").val();
          $("#deletedubName").val(getPrevVal+','+dublicateName);
        }

      }else{

        var itmafterUncheck = $('#deletedubName').val();
        var explodIUnChckTm = itmafterUncheck.split(',');
        const index = explodIUnChckTm.indexOf(dublicateName);
        if (index > -1) {
            explodIUnChckTm.splice(index, 1);
        }
        $('#deletedubName').val(explodIUnChckTm);
      }

    }

  /* ------- CHECK DUBLICATE BODY ENTRY -------- */

  function submitData(){

    var totalQty = parseFloat($('#totalQty').val());
    var headQty  = parseFloat($('#qty').val());

    var rowIDget         =[];
    var valuecoldStorage =[];
    var valuechamberCode =[];
    var valuefloorCode   =[];
    var valueblockCode   =[];
    var valuequantity    =[];

    $(".rowCountCls").each(function () {
        
         rowIDget.push(this.value);

    });

    for(var y=0;y<rowIDget.length;y++){

      var colIdSlno   = rowIDget[y];

      var coldStorage = $('#cold_storage'+colIdSlno).val();
      var chamberCode = $('#chamber_code'+colIdSlno).val();
      var floorCode   = $('#floor_code'+colIdSlno).val();
      var blockCode   = $('#block_code'+colIdSlno).val();
      var quantity    = $('#qunatity'+colIdSlno).val();

      valuecoldStorage.push(coldStorage);
      valuechamberCode.push(chamberCode);
      valuefloorCode.push(floorCode);
      valueblockCode.push(blockCode);
      valuequantity.push(quantity);

    }

    var found_coldStore = valuecoldStorage.find(function (coldStore) {
      return coldStore == '';
    });

    var found_chamberCode = valuechamberCode.find(function (chamber) {
      return chamber == '';
    });

    var found_floor = valuefloorCode.find(function (floor) {
      return floor == '';
    });

    var found_block = valueblockCode.find(function (block) {
      return block == '';
    });

    var found_quantity = valuequantity.find(function (quantity) {
      return quantity == '';
    });

    if(found_coldStore == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_chamberCode == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_floor == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_block == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_quantity == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else{

      if(totalQty != headQty){
        $("#msgModal").modal('show');
        $('#msgErr').html('<b>Storage Qty Should be Equal To Qty</b>');
      }else{

        var data = $("#vehicleInwardTran").serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

        $.ajax({

          type: 'POST',

          url: "{{ url('/transaction/ColdStorage/Save-inward-storage-transaction') }}",

          data: data, // here $(this) refers to the ajax object not form
          success: function (data) {
              
              var data1 = JSON.parse(data);
              
              if(data1.response == 'error') {
                var responseVar = false;
                var url = "{{url('transaction/ColdStorage/View-inward-storage-tran-msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }else{
                var responseVar = true;
                var url = "{{url('transaction/ColdStorage/View-inward-storage-tran-msg')}}";
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }

          },

        });

      } /* /.QTY CODN*/

    } /* /. CODN*/
    
  } /* /. SUBMIT FUNCTION*/
</script>


@endsection