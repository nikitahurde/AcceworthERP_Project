@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .tooltip{
    color: #66CCFF !important;
  }
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
  .withoutDo{
    display:none;
  }
  .rightcontent{
    text-align:right;
  }
  ::placeholder {
    text-align:left;
  }
  .showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  } 
  .text-center{
    text-align: center;
  }
  .title{
    margin-top: 50px;
    margin-bottom: 20px;
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

    padding: 5px;
    padding-bottom: 0px !important;
    line-height: 1;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
    border-top: 1px solid #83e25c;
  } 
  .readField{
    background-color:#eeeeee;
  }
</style>


<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Trip Plan
      <small>Add Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

      <li class="active"><a href="{{ url('/form-mast-fleet') }}">Logistics</a></li>

      <li class="active"><a href="{{ url('/form-mast-fleet') }}">Update Trip Plan</a></li>

    </ol>

  </section>

  <form id="salesordertrans">
    @csrf

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Trip Plan</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/view-mast-fleet') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Trip Plan</a>

              </div>

              <div class="box-tools pull-right">

                <a href="{{ url('/view-vehicle-planing-mast') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Trip Plan</a>

              </div>

            </div><!-- /.box-header -->

            <div class="box-body">

              <div class="modalspinner hideloaderOnModl"></div>

              <div class="row">
                <input type="hidden" id="" name="updateId" value="{{$tripPlanningData->TRIPHID}}">
                <!-- /.col -->
                <div class="col-md-2">

                  <div class="form-group">

                    <label>Date: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="text" class="form-control transdatepicker" name="vr_date" id="vr_date" value="{{ date('d-m-Y', strtotime($tripPlanningData->VRDATE)) }}" placeholder="Select Date" autocomplete="off">

                      </div>

                      <small id="showmsgfordate" style="color: red;"></small>

                      <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                  </div>
                      <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-2">

                  <div class="form-group">

                    <label> T Code : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="trans_code" value="{{ $tripPlanningData->TRAN_CODE }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                        <input type="hidden" id="transtaxCode" >

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                      <!-- /.form-group -->
                </div>
                  <!-- /.col -->
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
                        
                      <input list="seriesList1"  id="series_code" name="series_code" class="form-control  pull-left" value="{{$tripPlanningData->SERIES_CODE}}" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly onchange="getvrnoBySeries();">

                    </div>

                    <small id="series_code_errr" style="color: red;"></small>

                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Series Name : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>


                        <input type="text" class="form-control" name="series_name" value="{{$tripPlanningData->SERIES_NAME}}" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

                      </div>

                  </div>
                  
                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Vr No: </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                    

                      <input type="text" class="form-control" name="vro" value="{{$tripPlanningData->VRNO}}" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                   </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->

              </div>
              <!-- /.row -->

              <div class="row">
            
                <div class="col-md-2" style="width: 192px;">

                  <div class="form-group">

                    <label>&nbsp;</label>

                    <div class="input-group">

                      <input type="radio" class="optionsRadios1" name="do_type" value="With DO" checked="" disabled>&nbsp;&nbsp;<span style="font-weight: 700 !important;font-size: 12px !important;">With DO.</span> &nbsp;&nbsp;

                      <input type="radio" class="optionsRadios1" name="do_type" id="doublepoint" value="Without DO" disabled>&nbsp;&nbsp<span style="font-weight: 700 !important;font-size: 12px !important;">Without DO.</span>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('do_type', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>
                    <small id="invcErr" style="color: red;"></small>

                  </div>
                  <!-- /.form-group -->
                </div>
                  <!-- /.col -->

                <div class="col-md-2 withDo">

                  <div class="form-group">

                    <label>Customer Code : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="{{$tripPlanningData->ACC_CODE}}" placeholder="Select Customer" readonly onchange="getDoDetailsByCust()" autocomplete="off"> 


                      </div>

                      <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                      <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                      <small id="acccode_code_errr" style="color: red;"></small>

                  </div>
                      <!-- /.form-group -->
                </div>
                  <!-- /.col -->

                <div class="col-md-2  withoutDo">

                  <div class="form-group">

                    <label>Customer Code : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
          
                        <input list="AccountList_wdo"  id="account_code_wdo" name="AccCodeWdo" class="form-control  pull-left" value="" placeholder="Select Customer"  autocomplete="off" readonly onchange="getDoDetailsByCustWdo()" > 

                      </div>

                      <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                      <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                      <small id="acccode_code_errr" style="color: red;"></small>

                  </div>
                      <!-- /.form-group -->
                </div>
                    <!-- /.col -->  

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Customer Name : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="acctname" value="{{$tripPlanningData->ACC_NAME}}" id="accountName" placeholder="Enter Department Name" readonly autocomplete="off">

                    </div>
                      
                  </div>
                  
                </div>
                  <!-- /.col -->
               
              </div> <!-- row -->

              <div class="row">
                   
                  <input type="hidden" class="form-control" name="fsorder_no" value="" id="fsorder_no" placeholder="Enter Freight Sale No" readonly autocomplete="off">

                  <input type="hidden" class="form-control" name="sale_rate" value="" id="sale_rate" placeholder="Enter Sale Rate" readonly autocomplete="off">
                  <input type="hidden" class="form-control" name="fsohid" value="" id="fsohid" placeholder="Enter Sale Rate" readonly autocomplete="off">
                  <input type="hidden" class="form-control" name="fsobid" value="" id="fsobid" placeholder="Enter Sale Rate" readonly autocomplete="off">
                  <input type="hidden" class="form-control" name="refNo" value="" id="refNo"  readonly autocomplete="off">

                  <input type="hidden" class="form-control" name="sale_qty" value="" id="sale_qty" placeholder="Enter Sale Qty" readonly autocomplete="off">
                       
                  <!-- /.col -->

              </div>

              <!-- /.row -->

            </div><!-- /.box-body -->

          </div><!-- /.custom box -->

        </div><!-- /.col-sm12 -->

      </div><!-- ./row -->

    </section><!-- /.section -->

    <section class="content" style="margin-top: -10%;" id="bodyId">

      <div class="row">

        <div class="col-sm-12">

          <ul class="nav nav-tabs">
            <li class="active"  style="float: none !important;">
              <a href="#tab1info" id="basicInfo" data-toggle="tab" style='line-height:0.5'><b>Item/DO Details</b></a>
            </li>
            <!-- <li id="secondTab">
              <a href="#tab2info" data-toggle="tab" >Other Details</a>
            </li> -->
          </ul>

          <div class="box box-primary Custom-Box">

            <div class="box-body">

              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                  
                  <input type="hidden" name="comp_name" value="<?php echo Session::get('company_name'); ?>">
                  <input type="hidden" name="fiscal_year" value="<?php echo Session::get('macc_year'); ?>">

                  <tr>

                    <th style="width: 10px;"> Sr.No.</th>
                   	<th>CUSTOMER CODE </th>
                    <th>CUSTOMER NAME</th>
                    <th style="width: 10%;" class="doorderNo">DORDER NO.</th>
                    <th class="withoutDo">CONSIGNEE</th>
                    <th class="withoutDo">ADDRESS</th>
                    <th class="withoutDo">TO PLACE</th>
                    <th>ITEM CODE </th>
                    <th>ITEM NAME</th>
                    <th class="withDo">CP NAME/CP CODE</th>
                    <th class="withDo">SP NAME/SP CODE</th>
                    <th class="withDo">ITEM SLNO</th>
                    <th class="withDo">TO PLACE</th>
                    <th>QTY</th>
                    <th>AQTY</th>
              
                  </tr>

                  <?php $slno=1;$totalQty=0; foreach($tripPlanbodyData as $row){ $totalQty +=$row->QTY; ?>

                    <tr class="useful" id="first_Row">

                      <td class="tdthtablebordr">
                        <span id='snum' style="width: 10px;">{{$slno}}.</span>
                      </td>

                      <td class="tdthtablebordr withDo" style="width: 10%;">

                        <input list="custList1" class="inputboxclr readField"  name="custCode[]" id="custCode1" value="{{$row->ACC_CODE}}" placeholder="Customer Code" onchange="getRowDoDetailsByCust({{$slno}})"  autocomplete="off" readonly>

                      </td>

                      <td class="tdthtablebordr withDo" style="width: 10%;">

                        <input type="text" class="inputboxclr readField"  name="custName[]" id="custName{{$slno}}" value="{{$row->ACC_NAME}}"  placeholder="Customer Name"  autocomplete="off" readonly> 

                      </td>

                      <td class="tdthtablebordr doorderNo" style="width: 10%;">

                        <input list="deliveryList1" class="inputboxclr readField"  name="do_no[]" id="do_no1" value="{{$row->DO_NO}}" placeholder="Select Do No" onchange="getDoDetials(1)" readonly oninput="donumber(1)" autocomplete="off">

                      </td>

                      <td class="tdthtablebordr tooltips" style="width: 15%;">
                     
                        <input list="ItemList1" class="inputboxclr readField"  id='ItemCodeId1' name="item_code[]" value="{{$row->ITEM_CODE}}" oninput="this.value = this.value.toUpperCase()"  onchange="getItemQty(1)" autocomplete="off" placeholder="Select Item Code" readonly />

                      </td>

                      <td class="tdthtablebordr tooltips" style="width: 20%;">

                        <input type="text" class="inputboxclr readField" id='Item_Name_id1' value="{{$row->ITEM_NAME}}" name="item_name[]" placeholder="Enter Item Name" readonly />
                       
                      </td>

                      <td class="tdthtablebordr withDo" style="width: 15%;">
                      
                        <input list="ConsineeList1" class="inputboxclr readField"  id='consignee1' name="consignee[]" placeholder="Consinee Code" onchange="consigneeName(1)" value="{{$row->CP_CODE}}" oninput="this.value = this.value.toUpperCase()" autocomplete='off' readonly="" />

                        <div style='margin-top:2px;'>

                          <input type="text" class="inputboxclr readField" name="consineeName[]" id="consineeName1" value="{{$row->CP_NAME}}" autocomplete='off' readonly placeholder="Consinee Name">

                        </div>
                       
                      </td>

                      <td class="tdthtablebordr withDo" style="width: 15%;">
                      
                        <input list="SpList1" class="inputboxclr readField"  id='sp_code1' name="sp_code[]" placeholder="Sp Code" value="{{$row->SP_CODE}}" onchange="getspName(1)"  oninput="this.value = this.value.toUpperCase()" autocomplete='off' readonly=""/>

                        <div style='margin-top:2px;'>

                          <input type="text" class="inputboxclr readField" name="spName[]" id="spName1" autocomplete='off' value="{{$row->SP_NAME}}" readonly placeholder="Sp Name">
                         
                        </div>
                       
                      </td>

                      <td class="tdthtablebordr withDo" style="width: 15%;">

                        <input type="text" class="inputboxclr rightcontent readField"  id='item_slno1' style='width: 70px;' value="{{$row->SLNO}}" name="item_slno[]" placeholder="Item Slno" readonly  oninput="this.value = this.value.toUpperCase()" autocomplete='off' />

                      </td>

                      <td class="tdthtablebordr tooltips withDo" style="width: 15%;">

                        <input list="toplaceList1" class="inputboxclr readField"  id='to_place1' name="to_place[]" value="{{$row->TO_PLACE}}" onchange="toPlaceW(1);" autocomplete='off' oninput="this.value = this.value.toUpperCase()"  placeholder="Select To Place" readonly />

                      </td>

                      <td class="tdthtablebordr" style="width: 5%;">

                        <div style="display: inline-flex;border: none;">

                          <input type='text' class="inputboxclr getqtytotal quantityC rightcontent readField"  id='qty1' name="qty[]" oninput='Getqunatity(1)' value="{{$row->QTY}}" style="width: 65px;"  placeholder='Enter Qty' readonly autocomplete="off"  />

                        </div>

                      </td>

                      <td class="tdthtablebordr" style="width: 5%;">

                        <div style="display: inline-flex;border: none;">

                          <input type='text' class="inputboxclr getqtytotal quantityC rightcontent readField"  id='Aqty1' name="Aqty[]" oninput='Getqunatity(1)' style="width: 65px;" value="{{$row->AQTY}}" readonly placeholder='Enter Qty' autocomplete="off"  />

                        </div>

                      </td>
                      
                    </tr>

                  <?php $slno++;} ?>

                </table>

              </div><!-- /table-responsive -->

              <div class="row">
  
                <div class="col-md-4">

                </div>

                <div class="col-md-4">
                </div>

                <div class="col-md-4">

                  <div style="display: flex;float: right;">
                      <div class="toalvaldesn" style="margin-top: 5%;">Total :</div>
                      <input class="debitcreditbox inputboxclr rightcontent readField" type="text" name="TotlDebit" id="basicTotal" value="{{$totalQty}}" readonly="" style="width: 98px;">

                      <input type="hidden" name="basicTotalTemp" id="basicTotalTemp" value="">
                  </div>
                    <!-- id="totldramt" -->
                </div><!-- /.col -->

              </div><!-- /.row -->
              
            </div><!-- /.box-body -->

          </div><!-- /.custom box -->

        </div><!-- /.col-sm-12 -->

      </div><!-- /.row -->

    </section><!-- /.section -->

    <section class="content" style="margin-top: -10%;">

      <div class="row">

        <div class="col-sm-12">

          <ul class="nav nav-tabs">
            <li class="active"  style="float: none !important;">
              <a href="#tab1info" id="basicInfo" data-toggle="tab" style="line-height:0.5;"><b>Freight Details</b></a>
            </li>
          </ul>

          <div class="box box-warning Custom-Box">
         
            <div class="box-body">

              <div class="row">
          
                <div class="col-md-2">

                  <div class="form-group">

                    <label>Plant Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon" style="padding: 1px 7px;">
                           <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                         </span>
                        <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" value="{{$tripPlanningData->PLANT_CODE}}" placeholder="Select Plant" maxlength="11" value="" readonly autocomplete="off" onchange="PlantCode()">

                      </div>

                      <small>  

                          <div class="pull-left showSeletedName" id="plantText"></div>

                      </small>

                      <small id="plant_err" style="color: red;"> </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Plant Name : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" name="plant_name" value="{{$tripPlanningData->PLANT_NAME}}" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                      </div>

                  </div>
                  
                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Profit Center Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>
                        <input type="text"  id="profitctrId" value="{{$tripPlanningData->PFCT_CODE}}" name="pfct_code" class="form-control  pull-left" placeholder="Select Profit Center Code"  readonly >


                      </div>

                    <small id="profit_center_err" style="color: red;"> </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label> Profit Center Name : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" value="{{$tripPlanningData->PFCT_NAME}}" name="pfct_name" id="pfctName" placeholder="Enter Profit Center Name" readonly>

                      </div>

                  </div>
                  
                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                     From Place: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <input list="fromplaceList" class="form-control" name="from_place" id="from_place" value="{{$tripPlanningData->FROM_PLACE}}" placeholder="Enter From Place" readonly autocomplete="off"/>


                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('from_place', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>
                    <!-- /.form-group -->
                </div><!-- /.col -->
                            
              </div>

              <div class="row">
                  
                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                     To Place: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <input list="headtoplaceList" class="form-control" name="head_toplace" id="head_toplace" value="{{$tripPlanningData->TO_PLACE}}" placeholder="Enter To Place" autocomplete="off" readonly/>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('head_toplace', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                  <!-- /.form-group -->

                </div>
              
                <div class="col-md-1">

                  <div class="form-group">

                    <label>

                      Trip Days: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                        <input type="text" class="form-control" name="trip_day" id="trip_day"  value="{{$tripPlanningData->TRIP_DAY}}" placeholder="Enter Trip Days" autocomplete="off" readonly>

                          

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('trip_day', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      Off Days: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-car"></i></span>

                        <input list="offdaysList" class="form-control" name="off_days" id="off_days" value="{{$tripPlanningData->OFF_DAY}}" placeholder="Enter Off Days" readonly autocomplete="off">

                          <datalist id="offdaysList">
                            <option value="NA">NA</option>
                            <option value="SUNDAY">SUNDAY</option>
                            <option value="MONDAY">MONDAY</option>
                            <option value="TUESDAY">TUESDAY</option>
                            <option value="WEDNESDAY">WEDNESDAY</option>
                            <option value="THURSDAY">THURSDAY</option>
                            <option value="FRIDAY">FRIDAY</option>
                            <option value="SATURDAY">SATURDAY</option>
                          </datalist>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('transporter', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>

                      Vehicle No : 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                      <input list="vehicleList" class="form-control" name="vehicle_no" id="vehicle_no" value="{{$tripPlanningData->VEHICLE_NO}}" placeholder="Enter Vehicle No" maxlength="13" oninput="getvehicleOwner();" autocomplete="off" >

                      <datalist id="vehicleList">
                              
                        <?php foreach ($vehicle_list as $key) { ?>
                          
                        <option value="<?= $key->TRUCK_NO ?>" data-xyz="<?= $key->TRUCK_NO ?>"><?= $key->TRUCK_NO ?> - <?= $key->OWNER ?></option>

                        <?php   } ?>

                      </datalist>
                      
                    </div>
                    <small id="vehicleErr1msg" style="color:red;"></small>
                    <div class="custom-select">
                      <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                    
                      </div>  
                    </div>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                     Vehicle Owner: 

                      <span class="required-field" id="compn_req"></span>

                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                      <input list="ownerList" class="form-control" name="vehicle_owner"  placeholder="Enter Vehicle Owner" value="{{$tripPlanningData->OWNER}}" id="vehicle_owner" autocomplete="off" />

                      <datalist id="ownerList">
                        
                      </datalist>

                    </div><br>
                    <small id="vownererr" style="color: red;"></small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Vehicle Type:<span class="required-field" id="compn_req"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                      <input list="vehicleTypeList" value="{{$tripPlanningData->VEHICLE_TYPE}}" class="form-control" name="vehicle_type"  placeholder="Enter Vehicle Owner" id="vehicle_type" autocomplete="off"  oninput="getfsoRate();"/>

                       <datalist id="vehicleTypeList">
                                        <?php foreach($freightType_list as $key) { ?>

                                        <option value="<?= $key->FREIGHTTYPE_NAME ?>" data-xyz="<?= $key->FREIGHTTYPE_CODE ?>"><?= $key->FREIGHTTYPE_CODE ?> - <?= $key->FREIGHTTYPE_NAME ?></option>

                                        <?php } ?>
                                        
                                      </datalist>
                                     
                                      <input type="hidden" id="vehicleType_name" name="vehicleType_name" value="{{$tripPlanningData->VEHICLE_TYPE_NAME }}" />
                                      <input type="hidden" id="whee_type_code" name="whee_type_code" value="{{$tripPlanningData->WHEELTYPE_CODE }}" />
                       
                    </div><br>
                   
                    <small id="vownererr" style="color: red;"></small>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row">

                <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Wheel Type: 

                                    <span class="required-field" id="compn_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="wheelTypeList" class="form-control" name="whee_type_name"  placeholder="Enter Vehicle Owner" id="whee_type_name" autocomplete="off" value="{{$tripPlanningData->WHEELTYPE_NAME}}"/>



                                      <datalist id="wheelTypeList">

                                        <?php foreach($wheel_list as $key) { ?>

                                        <option value="<?= $key->WHEEL_NAME ?>" data-xyz="<?= $key->WHEEL_CODE ?>"><?= $key->WHEEL_CODE ?> - <?= $key->WHEEL_NAME ?></option>

                                        <?php } ?>
                                        
                                      </datalist>
                                     
                                     
                                  </div><br>

                                 
                                   <small id="vownererr" style="color: red;"></small>

                                </div>

                                

                                <!-- /.form-group -->

                              </div>

                              <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Min Guarantee: 

                                    <span class="required-field" id="compn_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="minList" class="form-control" name="min_gurrentee"  placeholder="Enter Min Guarantee" id="min_gurrentee" autocomplete="off" value="{{$tripPlanningData->MIN_GUARANTEE}}" />

                                      <datalist id="minList">
                                        <?php foreach($freightType_list as $key) { ?>

                                        <option value="<?= $key->FREIGHTTYPE_NAME ?>" data-xyz="<?= $key->FREIGHTTYPE_CODE ?>"><?= $key->FREIGHTTYPE_CODE ?> - <?= $key->FREIGHTTYPE_NAME ?></option>

                                        <?php } ?>
                                        
                                      </datalist>
                                     
                                    
                                  </div><br>

                                 
                                   <small id="vownererr" style="color: red;"></small>

                                </div>

                                

                                <!-- /.form-group -->

                              </div>
                  
                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      Vendor/Agent Code: 

                      <span class="required-field hideclass"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-car"></i></span>

                        <input list="transportList" class="form-control" name="transporter_code"  value="{{$tripPlanningData->TRANSPORT_CODE}}" id="transporter_code" placeholder="Enter Transporter" autocomplete="off" onchange="getRate()">

                        <datalist id="transportList">

                          <?php foreach ($transport_list as $key) { ?>
                            
                            <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> [<?= $key->ACC_NAME ?>]</option>

                          <?php } ?>

                           <option value="">--SELECT--</option>
                          
                        </datalist>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('transporter_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>
                    <!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      Transporter Name: 

                      <span class="required-field hideclass"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-car"></i></span>

                        <input type="text" class="form-control" name="transporter_name" id="transporter_name" value="{{$tripPlanningData->TRANSPORT_NAME}}" placeholder="Enter Transporter" autocomplete="off" readonly="">
                          
                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('transporter', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                     Purchase Freight Order : 

                      <span class="required-field hideclass"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon">

                          <i class="fa fa-caret-right"></i>

                        </span>

                      <input list="fpoList" name="fright_order" class="form-control" value="{{$tripPlanningData->FPO_NO}}" id="fright_order" placeholder="Enter Fright Order" autocomplete="off" readonly="">



                      </datalist>

                      <input type="hidden" name="vehicleId" value="">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('fright_order', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      Freight Qty : 

                      <span class="required-field hideclass"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon">

                          <i class="fa fa-caret-right"></i>

                        </span>

                      <input type="text" name="freight_qty"  id="freight_qty" class="form-control" value="{{$tripPlanningData->FREIGHT_QTY}}" placeholder="Enter Freight Qty" autocomplete="off" oninput="chnageadvRate()">


                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('freight_qty', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->
                  
                

              </div><!-- ./row -->

              <div class="row">


                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      Rate : 

                      <span class="required-field hideclass"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon">

                          <i class="fa fa-caret-right"></i>

                        </span>

                      <input type="text" name="rate"  id="rate" class="form-control" placeholder="Enter Rate" autocomplete="off" value="{{$tripPlanningData->FPO_RATE}}" oninput="chnageadvRate()">

                      <input type="hidden" name="mfprate" id="mfprate">
                      <input type="hidden" name="rate_basis" id="rate_basis">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      Amount : 

                      <span class="required-field hideclass"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon">

                          <i class="fa fa-caret-right"></i>

                        </span>

                      <input type="text" name="amount"  id="amount" class="form-control" placeholder="Enter Amount" value="{{$tripPlanningData->AMOUNT}}" autocomplete="off" oninput="chnageadvRate()" readonly="">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      Payment Mode : 

                      <span class="required-field hideclass"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon">

                          <i class="fa fa-caret-right"></i>

                        </span>

                      <input list="paymentList" name="payment_mode"  id="payment_mode" class="form-control" placeholder="Enter Payment Mode" value="{{$tripPlanningData->PAYMENT_MODE}}" autocomplete="off" readonly="">

                      <datalist id="paymentList">
                          <option value="UPI PAYMENT" data-xyz="UPI PAYMENT">UPI PAYMENT</option>
                          <option value="RTGS" data-xyz="RTGS">RTGS</option>
                          <option value="NEFT" data-xyz="NEFT">NEFT</option>
                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      Adv. Type : 

                      <span class="required-field hideclass"></span>

                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                      <input list="typeList" class="form-control" name="adv_type" id="adv_type"  value="{{$tripPlanningData->ADV_TYPE}}" placeholder="Select Adv Type" autocomplete="off" onchange="advanceType();" readonly=""/>

                      <datalist id="typeList">

                        <option value="Lumsum">Lumsum</option>
                        <option value="Percent">Percent</option>
                        <option value="Qty">Qty</option>
                        
                      </datalist>
                        
                    </div>
                    <input type="hidden" id="advtype" name="advtype" value="">

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                     Adv. Rate:<span class="required-field hideclass" id="compc_req"></span>

                    </label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building"></i></span>

                        <input type="text" class="form-control" name="adv_rate" id="adv_rate"  value="{{$tripPlanningData->ADV_RATE}}" oninput="chnageadvRate();" placeholder="Enter Adv Rate"  autocomplete="off" readonly=""/>

                        <input type="hidden" name="advcal_rate" id="advcal_rate">
                        <input type="hidden" name="advrate" id="advrate" value="">
                        

                    </div>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      Adv. Amount : 

                      <span class="required-field hideclass"></span>

                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                      <input type="text" class="form-control" name="adv_amount"  placeholder="Enter Adv Amount" id="adv_amount" value="{{$tripPlanningData->ADV_AMT}}" autocomplete="off" readonly="" />

                      <input type="hidden" id="advAmount" value="" name="advAmount">

                    </div><br>

                    <small id="adverr" style="color: red;"></small>

                  </div><!-- /.form-group -->

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class='row'>

                  <div class="col-md-2">

                                    <div class="form-group">

                                      <label>

                                        Trip Expense : 

                                        <span class="required-field hideclass"></span>

                                      </label>

                                            <div class="input-group">

                                                <span class="input-group-addon">

                                                  <i class="fa fa-caret-right"></i>

                                                </span>

                                              <input list="expenseList" name="trip_expense"  id="trip_expense" class="form-control" placeholder="Enter Trip Expense" value="YES" autocomplete="off">

                                              <datalist id="expenseList">
                                                  <option value="YES" data-xyz="YES">YES</option>
                                                  <option value="NO" data-xyz="NO">NO</option>
                                                 
                                              </datalist>

                                            </div>

                                      <small id="emailHelp" class="form-text text-muted">

                                        {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                                      </small>

                                    </div>

                    <!-- /.form-group -->

                          </div>


                          <div class="col-md-2">

                                    <div class="form-group">

                                      <label>

                                        Vehicle Model : 


                                      </label>

                                            <div class="input-group">

                                                <span class="input-group-addon">

                                                  <i class="fa fa-caret-right"></i>

                                                </span>

                                              <input type="text" name="vehicle_model"  id="vehicle_model" class="form-control" placeholder="Enter Trip Model" autocomplete="off" value="{{$tripPlanningData->MODEL}}">


                                            </div>

                                      

                                    </div>

                    <!-- /.form-group -->

                          </div>

                <input type="hidden" name="route_code" id="route_code">
                <input type="hidden" name="route_name" id="route_name">
                
              </div>

              <div id="requiredMsg" style="text-align: center;"></div></br>
              <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">

              <p class="text-center">
                <button class="btn btn-success btn-sm" type="button" id="submitdata" onclick="submitTriplanData(0)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

                <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitTriplanData(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>

              </p>

            </div><!-- /.box body -->
         
          </div><!-- /.custom-box -->

        </div><!-- /.col-sm-12 -->

      </div><!-- /.row -->

    </section><!-- /.section -->

</form><!-- /.section -->
  
</div>

<!-- Modal -->

<div id="advrateModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm" style="margin-top: 13%;">
        <div class="modal-content" style="border-radius: 5px;width: 130%;">
            <div class="modal-header" style="text-align: center;">
                <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                
            </div>
             <div class="modal-body">
     
             <center> <b> Rate Amount And Advance Amount Are Same .Are You Sure ? </b></center>

             </div>
            <div class="modal-footer">
              <center>
              <button type="button" class="btn btn-secondary" id="submitbtnno">No</button>
              <button type="button" class="btn btn-primary" id="submitbtnyes">Yes</button>
              </center>
            </div>
        </div>
    </div>
</div>


<div id="vehiclemsgModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-sm" style="margin-top: 13%;">
    <div class="modal-content" style="border-radius: 5px;width: 130%;">
      <div class="modal-header" style="text-align: center;">
          <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
          
      </div>
       <div class="modal-body">

       

       <small id="vehiclemsg"></small>

       </div>
      <div class="modal-footer">
        <center>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
        </center>
      </div>
    </div>
  </div>
</div>

<div id="vehicleCpctmsgModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-sm" style="margin-top: 13%;">
    <div class="modal-content" style="border-radius: 5px;width: 130%;">
      <div class="modal-header" style="text-align: center;">
          <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
          
      </div>
       <div class="modal-body">

       

       <small id="vehicleCpctmsg"></small>

       </div>
      <div class="modal-footer">
        <center>
        
        <button type="button" class="btn btn-primary" data-dismiss="modal">ok</button>
        </center>
      </div>
    </div>
  </div>
</div>

<div id="vehicleErrmsgModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-sm" style="margin-top: 13%;">
    <div class="modal-content" style="border-radius: 5px;width: 80%;">
      <div class="modal-header" style="text-align: center;">
          <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
      </div>
      <div class="modal-body">
    
          <div style="text-align:center;"> <small id="vehicleErrmsg"></small></div>

      </div>
      <div class="modal-footer">
        <center>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
        
        </center>
      </div>
    </div>
  </div>
</div>

<div id="doNotmsgModal" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-sm" style="margin-top: 13%;">
    <div class="modal-content" style="border-radius: 5px;width: 130%;">
      <div class="modal-header" style="text-align: center;">
          <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
          
      </div>
       <div class="modal-body">

       <center> <b> DO Data Not Avilable For This Customer ? </b></center>

       </div>
      <div class="modal-footer">
        <center>
      <!--   <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> -->
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
        </center>
      </div>
    </div>
  </div>
</div>

@include('admin.include.footer')

<script type="text/javascript">

  $(document).ready(function(){
    var vehicleOwner = $('#vehicle_owner').val();
    if(vehicleOwner == 'SELF' || vehicleOwner == 'DUMP'){
      $('#transporter_code,#rate,#freight_qty,#amount,#payment_mode').prop('readonly',true);
    }


      $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });
      
  });
  
  function getvehicleOwner(){

    var vehicle_no   = $("#vehicle_no").val();
    var vr_date      = $("#vr_date").val();
    var account_code = $("#account_code").val();
    var plant_code   = $("#Plant_code").val();
    var from_place   = $("#from_place").val();
    var to_place     = $("#head_toplace").val();
    var basicTotal   = $("#basicTotal").val();
    var maxlength    = vehicle_no.length;

    if(maxlength >= '8'){

      $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
      });

      $.ajax({

          url:"{{ url('get-vehicle-owner-by-vehicle') }}",

          method : "POST",

          type: "JSON",

          data: {vehicle_no: vehicle_no,from_place:from_place,to_place:to_place,vr_date:vr_date,account_code:account_code,plant_code:plant_code},

          beforeSend: function() {
              $('.modalspinner').removeClass('hideloaderOnModl');
          },

          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              $('.modalspinner').addClass('hideloaderOnModl');

              var owner = new Array();
              owner[0] = 'MARKET';
                    
              var options = '';

              for (var i = 0; i < owner.length; i++) {
                options += '<option value="' + owner[i] + '" />';
              }

              document.getElementById('ownerList').innerHTML = options;
               
            }else if(data1.response == 'success'){

                if(data1.transporter_data=='' || data1.transporter_data==null){

                    $("#transporter_code").val('');
                    $("#transporter_name").val('');
                }else{

                    $("#transporter_code").val(data1.transporter_data[0].ACC_CODE);
                    $("#transporter_name").val(data1.transporter_data[0].ACC_NAME);
                }

                if(data1.data=='' || data1.data==null){

                  $('.modalspinner').addClass('hideloaderOnModl');
                   
                  var owner = new Array();
                  owner[0] = 'MARKET';
                  
                  var options = '';

                  for (var i = 0; i < owner.length; i++) {
                    options += '<option value="' + owner[i] + '" />';
                  }

                  document.getElementById('ownerList').innerHTML = options;

                  $("#submitdata").prop('disabled',true);

                }else{

                  var vehicle_owner = data1.data.OWNER;
                  var vehicle_type = data1.data.WHEEL_TYPE;
                  $("#vehicle_owner").val(vehicle_owner);
                
                  if(vehicle_owner=='SELF'){

                    var owner = new Array();
                    owner[0] = 'SELF';
                    owner[1] = 'DUMP';

                    var options = '';

                    for (var i = 0; i < owner.length; i++) {
                      options += '<option value="' + owner[i] + '" />';
                    }

                    document.getElementById('ownerList').innerHTML = options;

                     $("#transporter_code,#transporter_name,#fright_order,#freight_qty,#rate,#amount,#payment_mode,#adv_type,#adv_rate,#adv_amount,#freight_qty").prop('readonly',true);

                     $("#submitdata").prop('disabled',false);
                     $("#submitdatapdf").prop('disabled',false);

                  }else{
                  
                      $("#submitdata").prop('disabled',true);
                      $("#submitdatapdf").prop('disabled',true);

                  }
                  
                  var registraion_date = data1.data.REGD_DATE;
                  
                }

                if(data1.route_data=='' || data1.route_data==null){

                  $('.modalspinner').addClass('hideloaderOnModl');
                  $("#route_code").val('');
                  $("#route_name").val('');

                }else{

                  var route_code = data1.route_data.ROUTE_CODE;
                  var route_name = data1.route_data.ROUTE_NAME;
                  $("#route_code").val(route_code);
                  $("#route_name").val(route_name);
                }

                if(data1.vehicle_trip=='' || data1.vehicle_trip==null){

                }else{

                  var lr_status = data1.vehicle_trip.LR_ACK_STATUS;

                    if(lr_status==0){

                      $("#vehicle_no").val('');
                      $("#vehicle_owner").val('');
                      
                      
                      //$("#vehicleErrDubmsg").html('DUBLICATE TRIP CAN NOT CREATE FOR THIS VEHICLE');

                       $("#vehicleErrmsgModal").modal('show');

                     $("#vehicleErrmsg").html('<b>DUBLICATE TRIP CAN NOT CREATE FOR THIS VEHICLE </b>');

                     $("#submitData").prop('disabled',true);
                     
                    }else{
                      $("#submitData").prop('disabled',false);
                      $("#vehicleErrDubmsg").html('');

                    }

                }
                   
                if(data1.vehicle_info.response == null){
              
                    $("#vehicleErr1msg").html('<b>Vehicle Not Found</b>');
                     
                }else{

                    var regd_date = data1.vehicle_info.response.regnDate;
                 
                    var cuurnt_date = new Date().toLocaleDateString('fr-CA');

                    var explode1 =   cuurnt_date.split("-");

                    var year1 = explode1[0];

                    var explode2 =   regd_date.split("/");

                    var year2 = explode2[2];

                    var diff_date = year1 - year2;

                    if(diff_date > 10){

                        $("#vehiclemsgModal").modal('show');

                        $("#vehiclemsg").html('<b>Vehicle Is More Than 10 Years Old.Are Sure To Proceed ?</b>');
                    }
                      
                    var gross_weight = data1.vehicle_info.response.gvw;

                    var underload_weight = data1.vehicle_info.response.unldWt;

                    var capct = parseFloat(gross_weight) - parseFloat(underload_weight);

                    var total = parseFloat(capct / 1000);

                    var calculatPercnt = parseFloat(total * 5/100);

                    var fianlValue = calculatPercnt + total;

                    if(fianlValue < basicTotal){

                      $("#vehicleCpctmsgModal").modal('show');

                      $("#vehicleCpctmsg").html('<b>Total Qty Is Greater than Vehicle Capacity </b>');

                      //$("#submitdata").prop('disabled',false);

                    }else{
                     // $("#submitdata").prop('disabled',true);
                    }

                }

            }/*/ .response codn*/

          },/*/. success function*/
          complete: function() {
            $('.modalspinner').addClass('hideloaderOnModl');
          },

      });

    }

  } /* /.MAIN FUNCTION*/

  function getRate(){

    var basicTotal = $("#basicTotal").val();

    var trans_code = $("#transporter_code").val();

    var to_place = $("#head_toplace").val();

    var FreightQtyTotal = $("#basicTotal").val();

    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }
    });

    $.ajax({

        url:"{{ url('get-freight-pur-order-details') }}",

        method : "POST",

        type: "JSON",

        data: {trans_code: trans_code,to_place:to_place},

        success:function(data){

          var data1 = JSON.parse(data);
          
          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            $("#freight_qty").val(FreightQtyTotal);

          }else if(data1.response == 'success'){

              if(data1.data=='' || data1.data==null){

                $("#freight_qty").val(FreightQtyTotal);

              }else{

                  var fy_year     =  data1.data[0].FY_CODE;
                  var series_code =  data1.data[0].SERIES_CODE;
                  var vr_no       =  data1.data[0].VRNO;
                  
                  var fy_code     =  fy_year.split("-");
                  
                  var fycode      = fy_code[1];
                  
                  var pordervrno  = fycode+' '+series_code+' '+vr_no;
                
                  var rate       = data1.data[0].RATE;
                  var rate_basis = data1.data[0].RATE_BASIS;
                  var amount     =  parseFloat(basicTotal) * parseFloat(rate);
                  
                  $("#rate").val(rate);
                  $("#amount").val(amount);
                  $("#fright_order").val(pordervrno);
                  $("#mfprate").val(rate);
                  $("#rate_basis").val(rate_basis);
                  $("#freight_qty").val(basicTotal);

              }
                   
          } /* /.success codn*/

        }/*/. success fucn*/

    });/*/. ajaxfun*/

  }

</script>

<script type="text/javascript">



  $("#vehicle_owner").bind('change', function () {

    var VehicleOwner =  $(this).val();

    var Vehicle_No =  $("#vehicle_no").val();

    if(VehicleOwner){

      if(VehicleOwner=='DUMP' || VehicleOwner=='SELF'){

        $("#transporter_code,#transporter_name,#fright_order,#rate,#amount,#payment_mode,#adv_type,#adv_rate,#freight_qty").prop('readonly',true);

        $("#submitdata").prop("disabled",false);

      }else{

        //$("#transporter_code").prop('readonly',false);

        $("#submitdata").prop("disabled",true);
      }

    }else{
      $("#submitdata").prop('disabled',true);
    }

  });


  $(document).ready(function(){
   $('#truck_no').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var truck_no = $('#truck_no').val();

        if(truck_no == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-truck-no') }}",

             method : "POST",

             type: "JSON",

             data: {truck_no: truck_no},

             success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                       var objcity = data1.data;
                       $('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<small class="custom-option">'+
                            objcity.truck_no+'</small><br>');
                         });
                        
                  }
             }

          });
       }

    });

    $("#submitbtnno").on('click', function() {

      $('#advrateModal').modal('toggle');
      $('#submitdata').prop('disabled',true);

    });

     $("#submitbtnyes").on('click', function() {

      $('#advrateModal').modal('toggle');
      $('#submitdata').prop('disabled',false);

    });
    

  });


</script>

<script type="text/javascript">
  
  $("#route_code").bind('change', function () {
  var val =  $(this).val();
  var xyz = $('#routeList option').filter(function() {

    return this.value == val;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';


  if(msg=='No Match'){
     $(this).val('');
    
      $('#route_name').val('');
  }else{
   
     $('#route_name').val(msg);
     $('#getRouteCode').val(val);
     $('#getRouteName').val(msg);
  }

});
</script>


<script type="text/javascript">
  
   function getRouteLocation() {
    
    var route_code = $("#route_code").val();

    if(route_code){

      $("#dono1").prop('readonly',false);

    }else{

      $("#dono1").prop('readonly',true);

    }

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });


      $.ajax({

            url:"{{ url('get-route-for-plan-by-route-code') }}",

            method : "POST",

            type: "JSON",

            data: {route_code: route_code},

            success:function(data){

              //console.log(data);

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);

                    $("#route_name").val(data1.data.ROUTE_NAME);
                    $("#from_place").val(data1.data.FROM_PLACE);
                    $("#to_place").val(data1.data.TO_PLACE);
                    $("#trip_day").val(data1.data.TRIP_DAYS);
                    $("#off_days").val(data1.data.HOLIDAYS);
                  


                }

            }

          });



  }
</script>

<script type="text/javascript">
  function getfsoRate(){

      var vehicle_no = $("#vehicle_no").val();
      var vr_date    = $("#vr_date").val();
      var account_code    = $("#account_code").val();
      var plant_code    = $("#Plant_code").val();
      var vehicle_type    = $("#vehicle_type").val();
      var vehicleType_name    = $("#vehicleType_name").val();
      var toplace    = $("#head_toplace").val();

      var vehicle_owner    = $("#vehicle_owner").val();

      console.log('vehicle_type',vehicle_type);

      console.log('vehicleType_name',vehicleType_name);

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });


      $.ajax({

          url:"{{ url('get-fso_rate-by-trip') }}",

          method : "POST",

          type: "JSON",

          data: {vehicle_no: vehicle_no,vehicle_type:vehicle_type,vr_date:vr_date,account_code:account_code,plant_code:plant_code,toplace:toplace,vehicle_owner:vehicle_owner},

          success:function(data){

            console.log(data);

            var data1 = JSON.parse(data);

       
              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                   console.log(data1.data);


                  if(data1.data=='' || data1.data==null){

                      $("#sale_rate").val('0.00');
                      $("#fsohid").val('0.00');
                      $("#fsobid").val('0.00');
                      $("#refNo").val('');
                   }else{
                     // alert(data1.data[0].RATE);
                      $("#sale_rate").val(data1.data[0].RATE);
                      $("#fsohid").val(data1.data[0].FSOHID);
                      $("#fsobid").val(data1.data[0].FSOBID);
                      $("#refNo").val(data1.data[0].REF_NO);
                   }

                   console.log('length',data1.vehicle_data.length);

                   var dataCount = data1.vehicle_data.length;

                   if(data1.vehicle_data=='' || data1.vehicle_data==null){

                    $("#whee_type_code").val('');
                    $("#whee_type_name").val('');
                    $("#min_gurrentee").val('');

                  }else{

                    if(dataCount > 1){

                        console.log('vehicle_data',data1.vehicle_data);

                     $("#wheelTypeList").empty();

                      $.each(data1.vehicle_data, function(k, getData){


                        $("#wheelTypeList").append($('<option>',{

                          value:getData.WHEEL_NAME,

                          'data-xyz':getData.WHEEL_NAME,
                          text:getData.WHEEL_NAME


                        }));

                      })

                    }else{

                      $("#whee_type_code").val(data1.vehicle_data[0].WHEEL_TYPE);
                      $("#whee_type_name").val(data1.vehicle_data[0].WHEEL_TYPE_NAME);
                      $("#min_gurrentee").val(data1.vehicle_data[0].MIN_GUARANTEE);

                      }

                    

                  }

              }

          }

    });



  }
</script>








<script type="text/javascript">
  
  
function advanceType(){



     var adv_type = $("#adv_type").val();
     var qty = $("#freight_qty").val();
     var rate = $("#rate").val();

     if(adv_type){

     
      $('#adv_type').css('border-color','#d2d6de');

      if(adv_type=='Lumsum'){

            $("#adv_amount").prop('readonly', false);
            $("#adv_rate").prop('readonly', true);
            $("#compc_req").hide();

          }else{
            $("#adv_amount").prop('readonly', true);
            $("#adv_rate").prop('readonly', false);
            $("#compc_req").show();
          } 

     }else{

         $("#adv_amount").val('');
         $("#adv_rate").val('');
         $('#adv_type').css('border-color','#ff0000').focus();
     }

     

  }
 function chnageadvRate(){

             var adv_rate      = $("#adv_rate").val();
             var adv_type = $("#adv_type").val();
             var qty      = $("#freight_qty").val();
             var amount   = $("#amount").val();

            if(adv_rate){

              $("#submitdata").prop('disabled', false);
              $("#submitdatapdf").prop('disabled', false);

            if(adv_type=='Percent'){

               var calrate     =   $("#advcal_rate").val();

               var advance_amt =parseFloat(amount) * parseFloat(adv_rate) /100;

               if(parseFloat(advance_amt) > parseFloat(amount)){

                $("#adv_amount").val('');
                $("#adverr").html('adv amount should be less than amount');
                $("#submitdata").prop('disabled', true);

               }else{ 

                console.log(advance_amt);
                
                var advanceAmt = Math.round(advance_amt / 1000) * 1000;
                //var amount =roundoffCal.toFixed(2);

                 $("#adv_amount").val(advanceAmt.toFixed(2));
                 $("#adverr").html('');
                 $("#submitdata").prop('disabled', false);
               }

              

            }else if(adv_type=='Qty'){

              var calamt = parseFloat(qty) * parseFloat(adv_rate);

               if(parseFloat(calamt) > parseFloat(amount)){

                $("#adv_amount").val('');
                
                $("#adverr").html('adv amount should be less than amount');
                $("#submitdata").prop('disabled', true);
               }else{

                 $("#adverr").html('');
                 $("#adv_amount").val(calamt.toFixed(2));
                 $("#submitdata").prop('disabled', false);
               }

              //$("#adv_amount").val(calamt);

            }
          }else{

            $("#adv_amount").val('');
            $("#submitdata").prop('disabled', true);
          }

  }
  
$(document).ready(function(){


  $("#adv_amount").on('input', function () { 

     var adv_amount = $(this).val();
     var adv_type = $("#adv_type").val();
     var amount = $("#amount").val();

     if(adv_amount){

      $("#submitdata").prop('disabled', false);
       if(adv_type=='Lumsum'){

               if(parseFloat(adv_amount) > parseFloat(amount)){

                $("#adv_amount").val('');
                
                $("#adverr").html('adv amount should be less than amount');
                $("#submitdata").prop('disabled', true);

               }else if(parseFloat(adv_amount) == parseFloat(amount)){

                    $("#advrateModal").modal();

                    $("#submitdata").prop('disabled', true);

               }else{

                $("#adverr").html('');
                $("#submitdata").prop('disabled', false);
               }


            }
     }else{
      $("#submitdata").prop('disabled', true);
     }

  });

});

</script>

<script type="text/javascript">

  $(document).ready(function() {

  $("#rate").on('input', function () { 

    var rate = $(this).val();

    if(rate){

       var qty = $("#freight_qty").val();

      var amt = parseFloat(rate) * parseFloat(qty);

      $("#amount").val(amt.toFixed(2));

      $("#amount").prop('readonly',false);

      $("#payment_mode").prop('readonly',false);

    }else{

      $("#amount").prop('readonly',true);
      $("#payment_mode").prop('readonly',true);
    }


    chnageadvRate();
   

    });


  $("#amount").on('input', function () { 

    var amount = $(this).val();

    if(amount){

       var qty = $("#freight_qty").val();

      var rate = parseFloat(amount) / parseFloat(qty);
 
      $("#rate").val(rate.toFixed(2));

      $("#payment_mode").prop('readonly',false);

    }else{

      $("#payment_mode").prop('readonly',false);

    }


      chnageadvRate();
   

    });


  $("#whee_type_name").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#wheelTypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

           var explodeData = val.split(' ');

           var min_gurrentee = explodeData[1]+' '+explodeData[2];

          if(msg=='No Match'){

            $("#min_gurrentee").val('');
            $("#transporter_code").prop('readonly',true);
            $("#whee_type_code").val('');
             
          }else{

            $("#min_gurrentee").val(min_gurrentee);
            $("#whee_type_code").val(msg);

          }


        });



  $("#freight_qty").on('input', function () { 

    var qty = $(this).val();

    if(qty){

      $("#rate").prop('readonly',false);

      var rate = $("#rate").val();

     var amount      =  parseFloat(qty) * parseFloat(rate);

      $("#amount").val(amount.toFixed(2));


    }else{
       $("#rate").prop('readonly',true);


    }


    chnageadvRate();
    

    });



    });




   

</script>
<script type="text/javascript">

  $(document).ready(function(){

      $("#transporter_code").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#transportList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $("#transporter_code").val('');
             $("#transporter_name").val('');
             $('#transporter_code').css('border-color','#d2d6de');
             $('#transporter_code').css('border-color','#ff0000').focus();
             //$('#payment_mode').css('border-color','#d2d6de');
             $("#fright_order").val('');
             $("#rate").val('');
             $("#freight_qty").val('');
             $("#amount").val('');
             $("#fright_order").prop('readonly', true);
              $("#rate").val('');
              $("#amount").val('');
              $("#fright_order").val('');
              $("#mfprate").val('');
              $("#rate_basis").val('');
              $("#freight_qty").prop('readonly', true);
              $("#rate").prop('readonly', true);
              $("#payment_mode").prop('readonly', true);
          }else{

             $("#transporter_name").val(msg);
             $('#transporter_code').css('border-color','#d2d6de');
           //  $('#payment_mode').css('border-color','#ff0000').focus();
             $("#freight_qty").prop('readonly', false);
             $("#rate").prop('readonly', false);
             $("#payment_mode").prop('readonly', false);
            
    
          } 

        });


        $("#vehicle_no").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#vehicleList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

            $("#vehicle_owner").val('');
            $("#vehicle_type").val('');
            $("#transporter_code").val('');
            $("#transporter_name").val('');
            $("#fright_order").val('');
            $("#freight_qty").val('');
            $("#rate").val('');
            $("#amount").val('');
            $("#payment_mode").val('');
            $("#adv_type").val('');
            $("#adv_rate").val('');
            $("#adv_amount").val('');
            $("#sale_rate").val('');
            $("#fsohid").val('');
            $("#fsobid").val('');
            //$("#submitdata").prop('disabled',true);
             
          }else{
           //$("#submitdata").prop('disabled',false);
         
          }

        });


        $("#vehicle_type").on('change', function () {  

          var val = $(this).val();

          var VehicleOwner =  $("#vehicle_owner").val();
 
          var xyz = $('#vehicleTypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

            $("#vehicle_type").val('');
            $("#transporter_code").prop('readonly',true);
            $("#sale_rate").val('');
            $("#fsohid").val('');
            $("#fsobid").val('');

            $("#whee_type_code").val('');
            $("#whee_type_name").val('');
            $("#min_gurrentee").val('');
             
          }else{

            if(VehicleOwner){

              if(VehicleOwner=='DUMP' || VehicleOwner=='SELF'){

                $("#transporter_code,#transporter_name,#fright_order,#rate,#amount,#payment_mode,#adv_type,#adv_rate,#freight_qty").prop('readonly',true);

                $("#submitdata").prop("disabled",false);

              }else{

                $("#submitdata").prop("disabled",true);
                $("#transporter_code").prop('readonly',false);

              }

            }
          }
    
        });

        $("#payment_mode").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#paymentList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');

             $('#payment_mode').css('border-color','#d2d6de');
             $('#payment_mode').css('border-color','#ff0000').focus();
             $('#adv_type').css('border-color','#d2d6de');
              $("#adv_type").prop('readonly', true);
          }else{
            $('#payment_mode').css('border-color','#d2d6de');
            $('#adv_type').css('border-color','#ff0000').focus();
            $("#adv_type").prop('readonly', false);
          }

        });
         

        $("#from_place").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#fromplaceList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
             
          }

        });

        $("#to_place").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#toplaceList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
             
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

<script type="text/javascript">

  function submitTriplanData(pdfFlag){

    var downloadFlg = pdfFlag;

    $('#pdfYesNoStatus').val(downloadFlg); 

    var data = $("#salesordertrans").serialize();

    $('.overlay-spinner').removeClass('hideloader');

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

        type: 'POST',

        url: "{{ url('/logistic/trip-Planing-Update') }}",

        data: data, // here $(this) refers to the ajax object not form

        success: function (data) {

          var data1 = JSON.parse(data);

          if(data1.response=='error'){

            var responseVar =false;

            var url = "{{ url('logistic/trip-planning-update-msg') }}"
            setTimeout(function(){ window.location = url+'/'+responseVar; });

          }else{

            var responseVar =true;

            /*if(downloadFlg == 1){
                var fyYear    = data1.data[0].FY_CODE;
                var fyCd      = fyYear.split('-');
                var seriesCd  = data1.data[0].SERIES_CODE;
                var vrNo      = data1.data[0].VRNO;
                var fileN     = 'LP_'+fyCd[0]+''+seriesCd+''+vrNo;
                var link      = document.createElement('a');
                link.href     = data1.url;
                link.download = fileN+'.pdf';
                link.dispatchEvent(new MouseEvent('click'));
            }*/
            var url = "{{ url('/logistic/trip-planning-update-msg') }}"
            setTimeout(function(){ window.location = url+'/'+responseVar; });

          }

        },

    });
      
  }
      
</script>



@endsection