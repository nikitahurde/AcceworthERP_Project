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
  .showcodename{
    color: #5696bb;
    font-size: 13px;
    font-weight: 600;
  }
  .numerRight{
    text-align:right;
  }
  .readonlyField{
    background-color: #eee;
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
  .hideBtn{
    display:none;
  }
  .showhideCls{
    display:none;
  }

</style>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
      Create Loading Slip W/O Plan
      <small>Add Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>
      <li class="active"><a href="{{ url('/transaction/candf/view-loading-slip') }}">Create Loading Slip</a></li>
      <li class="active"><a href="{{ url('/transaction/candf/view-loading-slip') }}">Add Loading Slip</a></li>

    </ol>

  </section><!-- /.section -->

<form id="loadingSlipTran">
  @csrf

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Create Loading Slip W/O Plan</h2>

              <div class="box-tools pull-right showinmobile">
                <a href="{{ url('/transaction/candf/view-loading-slip') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Create Loading Slip</a>
              </div>

              <div class="box-tools pull-right">
                <a href="{{ url('/transaction/candf/view-loading-slip') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Create Loading Slip</a>
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
                           
                        $formCurrentDt = date("Y-m-d", strtotime($CurrentDate));

                        if($formCurrentDt > $toDate){
                          $vrDate =$ToDate;
                        }else{
                          $vrDate =$CurrentDate;
                        }

                    ?>

                    <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
                    <input type="hidden" name="" value="<?php echo $vrDate; ?>" id="ToDateFy">
                    <input type="text" name="transaction_date" id="transaction_date" class="form-control transdatepicker" placeholder="Enter Date" value="{{$vrDate}}">

                  </div>
                  <small id="showmsgfordate"></small>

                </div><!-- /.form group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>

                   Trans Code : 

                    <span class="required-field"></span>

                  </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="text" class="form-control" name="trans_code" value="{{$tranlist->TRAN_CODE }}" placeholder="Enter Trans Code" maxlength="15" id="trans_code" readonly >

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('trans_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div>

              </div>

              <div class="col-md-2">

                <div class="form-group">

                  <label> Series Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <?php $seriesCnt = count($seriesList); 
                        if($seriesCnt == 1){
                          $seriesCode = $seriesList[0]->SERIES_CODE;
                          $seriesName = $seriesList[0]->SERIES_NAME;
                        }else{
                          $seriesCode ='';
                          $seriesName ='';
                        }
                      ?>

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input list="seriesList" class="form-control" name="series_code" value="{{$seriesCode}}" id="series_code" placeholder="Enter Series Code" autocomplete="off" onchange="getvrnoBySeries();">

                      <datalist id="seriesList">
                          <?php foreach ($seriesList as $key) { ?>

                          <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>
                            
                          <?php   } ?>
                      </datalist>

                    </div>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Series Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="series_name" value="{{$seriesName}}" id="series_name" placeholder="Enter Series Name" readonly autocomplete="off">

                    </div>

                </div><!-- /.form-group -->
                
              </div><!-- /.col -->

              <div class="col-md-2">

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

              <div class="col-md-5">

                <div class="form-group">

                  <label> Transporter Type: <span class="required-field"></span></label>

                   <div class="input-group">

                    <input type="radio" class="optionsRadios1 transporterType" name="trans_type" value="SELF" checked="">&nbsp;Self &nbsp;
                    <input type="radio" class="optionsRadios1 transporterType" name="trans_type" value="MARKET">&nbsp;&nbsp;Other Transporter &nbsp;&nbsp;
                    <input type="radio" class="optionsRadios1 transporterType" name="trans_type" value="SISTER_CONCERN" >&nbsp;&nbsp;Sister Concern &nbsp;&nbsp;
                    <input type="radio" class="optionsRadios1 transporterType" name="trans_type" value="EX_YARD" >&nbsp;&nbsp;Customer Scope &nbsp;&nbsp;

                  </div>

                </div><!-- /.form group -->
                <input type="hidden" id="getTransportType" value="SELF" name="seletedTransType">
              </div><!-- /.col --> 

              <div class="col-md-2">

                <div class="form-group">

                  <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                      <i class="fa fa-list-ol" aria-hidden="true"></i>
                    </div>

                    <input list="vehicleList" id="vehicle_no" name="vehicle_no" class="form-control  pull-left" value="{{ old('vehicle_no')}}" placeholder="Enter Vehicle No" onchange="getvehicleDeatils();" autocomplete="off">

                    <datalist id="vehicleList">
                      
                      <?php foreach ($vehicleNo_list as $key) {
                        $seriesCd = $key->SERIES_CODE;
                        $fyCd = $key->FY_CODE;
                        $splitFyCd = explode('-',$fyCd);
                        $vrNum = $key->VRNO;

                        $vrseqNo = $splitFyCd[0].'/'.$seriesCd.'/'.$vrNum;

                       ?>
                        
                      <option value="<?= $key->VEHICLE_NUMBER ?>~<?= $key->CFGATEID ?>" data-xyz="<?= $key->VEHICLE_NUMBER ?>~<?= $key->CFGATEID ?>"><?= $key->VEHICLE_NUMBER ?>~<?= $vrseqNo;?></option>

                      <?php   } ?>

                    </datalist>

                  </div>
                  <input type="hidden" name="tblGateId" id="tblGateId">
                  <input type="hidden" name="gateEntryVrno" id="gateEntryVrno">
                  <input type="hidden" name="trip_no" id="trip_no">
                  <input type="hidden" name="driver_name" id="driver_name">
                  <input type="hidden" name="driver_id" id="driver_id">
                  <input type="hidden" name="driver_mobNo" id="driver_mobNo">
                  <input type="hidden" name="plant_code" id="plant_code">
                  <input type="hidden" name="plant_name" id="plant_name">
                  <input type="hidden" name="pfct_code" id="pfct_code">
                  <input type="hidden" name="pfct_name" id="pfct_name">
                  <input type="hidden" name="tripHeadId" id="tripHeadId">

                  <input type="hidden" name="trip_compCode" id="trip_compCode">
                  <input type="hidden" name="trip_fyCode" id="trip_fyCode">
                  <input type="hidden" name="trip_pfctCode" id="trip_pfctCode">
                  <input type="hidden" name="trip_tranCode" id="trip_tranCode">
                  <input type="hidden" name="trip_seriesCode" id="trip_seriesCode">
                  <input type="hidden" name="trip_accCode" id="trip_accCode">
                  <input type="hidden" name="trip_accName" id="trip_accName">
                  <input type="hidden" name="trip_fromplace" id="trip_fromplace">
                  <input type="hidden" name="trip_toplace" id="trip_toplace">
                  <input type="hidden" name="trip_vrDate" id="trip_vrDate">


                  <input type="hidden" id="generateLrNo" value="1">

                </div>

              </div><!-- /.col -->

              <div class="col-md-3">

              <div class="form-group">

                <label> Transport: <span class="required-field"></span></label>

                 <div class="input-group">

                  <input type="radio" class="optionsRadios1 transportType" name="charge_type" value="BY_RAKE" checked="">&nbsp;&nbsp;&nbsp;By Rake &nbsp;
                  <input type="radio" class="optionsRadios1 transportType" name="charge_type" value="BY_ROAD" >&nbsp;&nbsp;&nbsp;By Road &nbsp;&nbsp;

                </div>
                <input type="hidden" name='tranPort_Type' value='BY_RAKE' id="tranPort_Type">
              </div>

            </div>



            </div><!-- /.row -->

            <div class="row">
              <div class="col-md-2 showhideCls">

              <div class="form-group">

                <label for="exampleInputEmail1">Customer Code : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input list="customerList" id="customer_code" name="customer_code" class="form-control  pull-left" value="{{ old('customer_code')}}" autocomplete="off" placeholder="Enter Customer Code" onchange="getBatchNoByAcc()">

                  <datalist id="customerList">

                    <option value=""> -- Select -- </option>
                    
                     @foreach ($customer_list as $key)

                    <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                    @endforeach

                  </datalist>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2 showhideCls">

              <div class="form-group">

                <label for="exampleInputEmail1">Customer Name : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="customer_name" name="customer_name" class="form-control pull-left" value="{{ old('customer_name')}}" placeholder="Enter Customer Name" readonly>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2 showhideCls">

              <div class="form-group">

                <label for="exampleInputEmail1">CP Code : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input list="cpList" id="cpCode" name="cpCode" class="form-control  pull-left" value="{{ old('cp_code')}}" autocomplete="off" placeholder="Enter Cp Code">

                  <datalist id="cpList">

                    <option value=""> -- Select -- </option>
                    
                     @foreach ($consignee_list as $key)

                    <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                    @endforeach

                  </datalist>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2 showhideCls">

              <div class="form-group">

                <label for="exampleInputEmail1">CP Name : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="cpName" name="cpName" class="form-control pull-left" value="{{ old('cpName')}}" placeholder="Enter Cp Name" readonly>

                </div>

              </div>

            </div><!-- /.col -->
               <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Transporter Code : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input list="trptList" id="trpt_code" name="trpt_code" class="form-control  pull-left" value="{{ old('trpt_code')}}" autocomplete="off" placeholder="Enter Transporter Code" readonly="">

                  <datalist id="trptList">

                    <option value=""> -- Select -- </option>
                    
                      @foreach ($trptlist as $key)

                    <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                    @endforeach

                  </datalist>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Transporter Name : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="trpt_name" name="trpt_name" class="form-control pull-left" value="{{ old('trpt_name')}}" placeholder="Enter Transporter Name" readonly>

                </div>

              </div>

            </div><!-- /.col -->
              
            </div>
          </div><!-- /.box-body -->
          
        </div><!-- /.custom box -->

      </div><!-- /.col-sm-12 -->

    </div><!-- /.row -->

  </section><!-- /.section -->

  <section class="content" style="margin-top: -10%;" id="datatableId">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-warning Custom-Box">

          <div class="box-body">

            <div class="col-sm-12">
              <p style="font-weight: bold;font-size: 12px;">ITEM/DO DETAILS</p>
            </div>
            <div class="col-sm-12" id="bodyDataNotFound" style="font-weight: bold;font-size: 12px;color:red;    text-align: center;">
            </div>

            <div class="table-responsive">

              <table class="table tdthtablebordr" border="1" cellspacing="0" id="bodytbledata">

                <tr>
                  <th><input class='check_all'  type='checkbox' onclick='select_all()'/></th>
                  <th style='width: 10px;'> Sr.No.</th>
                  <th>BATCH NO</th>
                  <th>ITEM CODE</th>
                  <th>ITEM NAME</th>
                  <th>SALE ORDER NO</th>
                  <th>RAKE NO</th>
                  <th>WAGON NO</th>
                  <th>Location CODE</th>
                  <th>Location NAME</th>
                  <th>AQUANTITY</th>
                  <th>AUM</th>
                  <th>QUANTITY</th>
                  <th>UM</th>
                  <th>CP CODE</th>
                  <th>CP NAME</th>
                  <th class="showhideCls">JOB WORK</th>
                </tr>

                <tr>
                  <td class='tdthtablebordr'>
                    <input type="hidden" id="tempItemSave1" value="">
                    <input type='checkbox' class='case' id='firstrow1' onclick='checkcheckbox(1);'/>
                  </td>
                  <td><span id='snum'>1.</span>
                    <input type='hidden' class='rowCountCls' name='rowCount[]' id='rowCount1' value='1'>
                  </td>
                  <td class='tdthtablebordr'>
                    <input list='batchNoList1' value='' name='batch_no[]'  class='inputboxclr' id='batch_no1' readonly onchange='getInwardDetails(1,"BATCH");' autocomplete='off'/>
                    <datalist id='batchNoList1'>
                      <option value=''></option>
                      <?php foreach ($orderNo_list as $key) { ?>

                          <option value='<?php echo $key->BATCH_NO.'~'.$key->SLNO.'~'.$key->CFINWARDID;?>' data-xyz ="<?php echo $key->BATCH_NO.'~'.$key->SLNO.'~'.$key->CFINWARDID; ?>" ><?php echo $key->BATCH_NO.'-'.$key->ITEM_NAME.'-'.$key->LOADBALQTY.'-'.$key->WAGON_NO.'-'.$key->INVOICE_NO.'-'.$key->RAKE_NO;?></option>

                      <?php   } ?>
                    </datalist>
                    <input type="hidden" id="batchSlno1" name="batchSlno[]">
                    <input type="hidden" id="tblHeadId1" name="tblHeadId[]">
                  </td>
                  <td class='tdthtablebordr' >
                    <input list='itemList1' name='item_code[]' id='item_code1' class='inputboxclr'  value='' onchange='getInwardDetails(1,"ITEM");' autocomplete="off" />
                    <datalist id='itemList1'><option value=''></option>
                    </datalist>
                  </td>
                  <td class='tdthtablebordr'>
                    <input class='inputboxclr readonlyField' type='text'  value='' name='item_name[]' id='item_name1' readonly/>
                  </td>
                  <td class='tdthtablebordr'>
                    <div>
                      <input list='doNoList1' class='inputboxclr' name='sOrderNo[]' id='sOrderNo1' value='' autocomplete='off' onchange='getInwardDetails(1,"ORDER");' />
                      <datalist id='doNoList1'>
                      </datalist>
                    </div>
                  </td>
                  <td class='tdthtablebordr'>
                    <div>
                      <input type="text" class='inputboxclr readonlyField' name='rakeNum' id='rakeNum1' value='' autocomplete='off' readonly />
                    </div>
                  </td>
                  <td class='tdthtablebordr'>
                    <input value='' name='wagon_no[]' class='inputboxclr readonlyField' id='wagon_no1' autocomplete='off' readonly/>
                  </td>
                  <td class='tdthtablebordr'>
                    <input type='text' name='location_code[]' id='location_code1' readonly class='inputboxclr readonlyField'  value='' />
                  </td>
                  <td class='tdthtablebordr'>
                    <input type='text' name='location_name[]' id='location_name1' readonly class='inputboxclr readonlyField'  value='' />
                  </td>
                  <td class='tdthtablebordr' >
                    <input class='inputboxclr numerRight aQtyVal' type='text' value='' name='addQuantity[]' id='addquantity1' oninput="calcQty(1,'AQTY')" autocomplete='off'/>
                  </td>
                  <td class='tdthtablebordr' >
                    <input list="aumList1" class='inputboxclr readonlyField' value='' name='addum_code[]' id='addum_code1' readonly/>
                    <datalist id="aumList1">
                      <?php foreach ($umList as $key) { ?>

                          <option value='<?php echo $key->UM_CODE?>'   data-xyz ="<?php echo $key->UM_NAME; ?>" ><?php echo $key->UM_NAME ; echo " [".$key->UM_CODE."]" ; ?></option>
                            
                        <?php   } ?>
                    </datalist>
                  </td>
                  <td class='tdthtablebordr' >
                    <input class='inputboxclr numerRight qtyVal' type='text' value='' name='quantity[]' id='quantity1' oninput="calcQty(1,'QTY')" autocomplete='off'/>
                    <input type="hidden" name="cFactor[]" id="cFactor1" value='0'>
                  </td>
                  <td class='tdthtablebordr' >
                    <input class='inputboxclr readonlyField' type='text' value='' name='um_code[]' id='um_code1' readonly/>
                  </td>
                  <td class='tdthtablebordr'>
                    <input type='text' name='cp_code[]' id='cp_code1' readonly class='inputboxclr readonlyField'  value='' />
                    <input type='hidden' class='cpCddata' value='' id='lrGenInfo1'>
                    <input type='hidden' value='1' name='uniqLrNo[]' id='uniqLrNo1'>
                    <input type="hidden" name="doTRPTCode[]" id="doTRPTCode1">
                    <input type="hidden" name="doTRPTName[]" id="doTRPTName1">
                  </td>
                  <td class='tdthtablebordr'>
                    <input type='text' name='cp_name[]' id='cp_name1' readonly class='inputboxclr readonlyField'  value='' />
                  </td>

                   <td class='tdthtablebordr showhideCls'>
                    <input list='jobWorkList1' class='inputboxclr' name='jobWork[]' id='jobWork1' value='' onchange="getJwItemName(1)" autocomplete='off' />
                      <datalist id='jobWorkList1'>
                        <?php foreach ($jwitem_list as $key) { ?>
                          <option value="<?= $key->ITEM_CODE ?>" data-xyz='<?= $key->ITEM_NAME ?>'><?= $key->ITEM_CODE ?> - <?= $key->ITEM_NAME ?></option>
                       <?php    } ?>
                      </datalist>
                      <input text='hidden' class='inputboxclr showhideCls' name='jobwrokitemName[]' id='jobwrokitemName1' value='' autocomplete='off' />
                  </td>

                </tr>
                
              </table><!-- /.table -->
              
            </div><!-- /.table-responsive  -->

            <div class="row">

              <div class="col-md-12" style="display: flex;">
                <div style="width:57%">
                  
                  <button type="button" class='btn btn-danger delete' id="deletehidn" ><i class="fa fa-minus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Delete</button>

                  <button type="button" class='btn btn-info addmore' id="addmorhidn" ><i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Add More</button>
                  <small id="showDubDataMsg" style="color: red;"></small>
                  <input type="hidden" name="dublicateName1[]" id="dublicateName" value="">
                  <input type="hidden" name="deletedubName1[]" id="deletedubName" value="">

                </div>
                <div style="width:8%">
                  <input class="debitcreditbox inputboxclr numerRight" style="background-color: #eeeeee;" type="text" name="totalaQty" id="total_AQty" readonly>
                </div>
                <div style="width:7%">&nbsp;</div>
                <div style="width:8%">
                  <input class="debitcreditbox inputboxclr numerRight" style="background-color: #eeeeee;" type="text" name="totalQty" id="total_Qty" readonly>
                </div>
                
              </div>

            </div>

            <div class="row" style="text-align:center;margin-bottom: 5px;font-weight: 700;">
              <small id="fieldReqMsg" style="color:red;"></small>
            </div>
            <div class="row">

              <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
              <div class="col-md-12" style="text-align: center;">
                <button class="btn btn-success" type="button" id="submitdata" onclick="submitLoadingSlipTrans(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

                <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitLoadingSlipTrans(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>
              </div>
              
            </div>

          </div><!-- /.box-body -->

        </div><!-- /.custom-box -->

      </div><!-- /.col-12 -->

    </div><!-- /.row -->

  </section><!-- /.section -->

</form>
  
</div>


@include('admin.include.footer')

<script type="text/javascript">
  
  $(document).ready(function() {

    getvrnoBySeries();

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

    });

    $('.transporterType').on('click',function(){

      var transport_Type = $("input[type='radio'][name='trans_type']:checked").val();
      $('#getTransportType').val(transport_Type);

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

        url:"{{ url('get-trip-no-details-against-vehicle') }}",
        method : "POST",
        type: "JSON",
        data: {transport_Type: transport_Type},
        beforeSend: function() {
          console.log('start spinner');
          $('.modalspinner').removeClass('hideloaderOnModl');
        },
        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

            if(data1.data_vehicle_list == ''){
              $("#vehicleList").empty();
              $("#vehicle_no,#trip_no,#gateEntryVrno,#driver_name,#driver_id,#driver_mobNo,#plant_code,#plant_name,#pfct_code,#pfct_name").val('');
            }else{
              $("#vehicle_no,#trip_no,#gateEntryVrno,#driver_name,#driver_id,#driver_mobNo,#plant_code,#plant_name,#pfct_code,#pfct_name").val('');
              $("#vehicleList").empty();

              $.each(data1.data_vehicle_list, function(k, getItem){

                var sereisCd = getItem.SERIES_CODE;
                var fycd = getItem.FY_CODE;
                var splitFy = fycd.split('-');
                var vrno =getItem.VRNO;
                var vrseqNum = splitFy[0]+'/'+sereisCd+'/'+vrno;

                $("#vehicleList").append($('<option>',{

                  value:getItem.VEHICLE_NUMBER+'~'+getItem.CFGATEID,
                  'data-xyz':getItem.VEHICLE_NUMBER+'~'+getItem.CFGATEID,
                  text:getItem.VEHICLE_NUMBER+'~'+vrseqNum

                }));

              });

            }

          }/* /. success condition*/

        },/*/. success function*/
        complete: function() {
          console.log('end spinner');
          $('.modalspinner').addClass('hideloaderOnModl');
        },

      });

    });

  });/* /. */

  function getvrnoBySeries(){

      var series_Code = $('#series_code').val();

      var xyz = $('#seriesList option').filter(function() {
        return this.value == series_Code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#series_code').val('');
        $('#vrseqnum').val('');
        $('#series_name').val('');
      }else{
        $('#vrseqnum').val('');
        $('#series_name').val(msg);
      }

      var seriesCode = $('#series_code').val();
      var transcode  = $('#trans_code').val();

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
                    }else{
                        var lastNo = parseInt(getlastno) + parseInt(1);
                        $('#vrseqnum').val(lastNo);
                    }
                }

            } /* /. success */
         } /* /. success function */
    }); /* /. ajax function */
  } /* /. main function */

</script>
<script type="text/javascript">
  $('.transportType').on('click',function(){

        var transport_Type = $(this).val();
        if(transport_Type == 'BY_RAKE'){
          $('#rake_no').prop('readonly',false);
          $('#itemList1').empty();
          $('#batchList1').empty();
          $('#tranPort_Type').val(transport_Type);
          $('.showhideCls').hide();
        }else if(transport_Type == 'BY_ROAD'){
          $('#rake_no').prop('readonly',true);
          $('#rake_no').val('');
          $('#itemList1').empty();
          $('#batchList1').empty();
          $('#tranPort_Type').val(transport_Type);
          $('.showhideCls').show();
        }
      });


  $('#customer_code').on('change',function(){

      var cust_Code = $('#customer_code').val();
      var xyz = $('#customerList option').filter(function() {
        return this.value == cust_Code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      if(msg=='No Match'){
        $('#customer_name').val('');
        $('#customer_code').val('');
      }else{  
        $('#customer_name').val(msg);
      }

     // fieldValidation();

    });

   $('#trpt_code').on('change',function(){

      var cust_Code = $('#trpt_code').val();
      var xyz = $('#trptList option').filter(function() {
        return this.value == cust_Code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      if(msg=='No Match'){
        $('#trpt_name').val('');
        $('#trpt_code').val('');
      }else{  
        $('#trpt_name').val(msg);
      }

     // fieldValidation();

    });

    $('#cpCode').on('change',function(){

      var cp_Code = $('#cpCode').val();
      var xyz = $('#cpList option').filter(function() {
        return this.value == cp_Code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      if(msg=='No Match'){
        $('#cpName').val('');
        $('#cpCode').val('');
      }else{  
        $('#cpName').val(msg);
        
      }

    });
</script>
<script type="text/javascript">
  
  function getBatchNoByAcc(){

    var customer_code = $("#customer_code").val();
     var transport_Type = $("input[type='radio'][name='charge_type']:checked").val();


    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        url:"{{ url('get-batch-no-details-against-customer') }}",

        method : "POST",

        type: "JSON",

        data: {customer_code:customer_code,transport_Type:transport_Type},

        success:function(data){

          console.log('data1',data);
          var data1 = JSON.parse(data);
          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

            if(data1.data == ''){

            }else{
              
              console.log(data1.data[0]);

                  $("#batchNoList1").empty();

                  $.each(data1.data, function(k, getData){

                    $("#batchNoList1").append($('<option>',{

                      value:getData.BATCH_NO+'~'+getData.SLNO+'~'+getData.CFINWARDID,

                      'data-xyz':getData.BATCH_NO+'~'+getData.SLNO+'~'+getData.CFINWARDID,
                      'text':getData.BATCH_NO+'-'+getData.ITEM_NAME+'-'+getData.LOADBALQTY+'-'+getData.WAGON_NO+'-'+getData.INVOICE_NO+'-'+getData.RAKE_NO

                    }));

                  });

            }

          }/* /. SUCCESS CODN*/

        } /* /. SUCCESS FUNCTION*/

    });

  }

</script>

<script>

  /* ---------- DELETE ROW ---------- */ 

    $(".delete").on('click', function() {

        $('.case:checkbox:checked').parents("tr").remove();

        $('.check_all').prop("checked", false); 

        check();

        totalvalCalculation();

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
        $('#submitdata,#submitdatapdf').prop('disabled',true);
      }else{

        $.each( obj, function( key, value ) {
          id=value.id;
          $('#'+id).html(key+1);
        });

      }

    }

  /* ---------- DELETE ROW ---------- */ 

  /* ---------- START : ADD MORE FUNCTINALITY -------------- */
  var i=2;
  $(".addmore").on('click',function(){
    
    count=$('table tr').length;

      var prevId = parseInt(i) - parseInt(1);
     // console.log('prevId',prevId);
      $('#batch_no'+prevId+',#item_code'+prevId+',#sOrderNo'+prevId+'').prop('readonly',true).css('background-color','#eee');

     var data = "<tr><td class='tdthtablebordr'><input type='hidden' id='tempItemSave"+i+"' value=''><input type='checkbox' class='case' id='firstrow"+i+"' onclick='checkcheckbox("+i+");'/></td>"+
        "<td><span id='snum"+i+"'>"+count+".</span><input type='hidden' class='rowCountCls' name='rowCount[]' id='rowCount"+i+"' value='"+i+"'></td>"+
        "<td class='tdthtablebordr'><input list='batchNoList"+i+"' value='' name='batch_no[]'  class='inputboxclr' id='batch_no"+i+"' onchange='getInwardDetails("+i+",\""+'BATCH'+"\");' autocomplete='off'/><datalist id='batchNoList"+i+"'><option value=''></option><?php foreach ($orderNo_list as $key) { ?><option value='<?php echo $key->BATCH_NO.'~'.$key->SLNO.'~'.$key->CFINWARDID;?>' data-xyz ='<?php echo $key->BATCH_NO.'~'.$key->SLNO.'~'.$key->CFINWARDID; ?>' ><?php echo $key->BATCH_NO.'-'.$key->ITEM_NAME.'-'.$key->LOADBALQTY.'-'.$key->WAGON_NO.'-'.$key->INVOICE_NO.'-'.$key->RAKE_NO;?></option><?php   } ?></datalist><input type='hidden' id='batchSlno"+i+"' name='batchSlno[]'><input type='hidden' id='tblHeadId"+i+"' name='tblHeadId[]'></td>"+
        "<td class='tdthtablebordr' ><input list='itemList"+i+"' name='item_code[]' id='item_code"+i+"' class='inputboxclr'  value='' onchange='getInwardDetails("+i+",\""+'ITEM'+"\");' autocomplete='off' /><datalist id='itemList"+i+"'><option value=''></option></datalist></td>"+
        "<td class='tdthtablebordr'><input class='inputboxclr readonlyField' type='text'  value='' name='item_name[]' id='item_name"+i+"' readonly/></td>"+
        "<td class='tdthtablebordr'><div><input list='doNoList"+i+"' class='inputboxclr' name='sOrderNo[]' id='sOrderNo"+i+"' value='' autocomplete='off' onchange='getInwardDetails("+i+",\""+'ORDER'+"\");' /><datalist id='doNoList"+i+"'><option value=''></option></datalist></div></td>"+
        "<td class='tdthtablebordr'><div><input type='text' class='inputboxclr readonlyField' name='rakeNum' id='rakeNum"+i+"' value='' autocomplete='off' readonly /></div></td>"+
        "<td class='tdthtablebordr'><input value='' name='wagon_no[]' class='inputboxclr readonlyField' id='wagon_no"+i+"' autocomplete='off' readonly/></td>"+
        "<td class='tdthtablebordr'><input type='text' name='location_code[]' id='location_code"+i+"' readonly class='inputboxclr readonlyField'  value='' /></td>"+
        "<td class='tdthtablebordr'><input type='text' name='location_name[]' id='location_name"+i+"' readonly class='inputboxclr readonlyField'  value='' /></td>"+
        "<td class='tdthtablebordr' ><input class='inputboxclr numerRight aQtyVal' type='text' value='' name='addQuantity[]' id='addquantity"+i+"' autocomplete='off' oninput='calcQty("+i+",\""+'AQTY'+"\")'/></td>"+
        "<td class='tdthtablebordr'><input list='aumList"+i+"' class='inputboxclr readonlyField' value='' name='addum_code[]' id='addum_code"+i+"' readonly/><datalist id='aumList"+i+"'><?php foreach ($umList as $key) { ?><option value='<?php echo $key->UM_CODE?>'   data-xyz ='<?php echo $key->UM_NAME; ?>' ><?php echo $key->UM_NAME ; echo ' ['.$key->UM_CODE.']' ; ?></option><?php   } ?></datalist></td>"+
        "<td class='tdthtablebordr'><input class='inputboxclr numerRight qtyVal' type='text' value='' name='quantity[]' id='quantity"+i+"' autocomplete='off' oninput='calcQty("+i+",\""+'QTY'+"\")'/><input type='hidden' name='cFactor[]' id='cFactor"+i+"' value='0'></td>"+
        "<td class='tdthtablebordr' ><input class='inputboxclr readonlyField' type='text' value='' name='um_code[]' id='um_code"+i+"' readonly/></td>"+
        "<td class='tdthtablebordr'><input type='text' name='cp_code[]' id='cp_code"+i+"' readonly class='inputboxclr readonlyField'  value='' /><input type='hidden' class='cpCddata' value='' id='lrGenInfo"+i+"'><input type='hidden' value='1' name='uniqLrNo[]' id='uniqLrNo"+i+"'><input type='hidden' name='doTRPTCode[]' id='doTRPTCode"+i+"'><input type='hidden' name='doTRPTName[]' id='doTRPTName"+i+"'></td>"+
        "<td class='tdthtablebordr'><input type='text' name='cp_name[]' id='cp_name"+i+"' readonly class='inputboxclr readonlyField'  value='' /></td>"+
        "<td class='tdthtablebordr showhideCls'><input list='jobWorkList1' class='inputboxclr' name='jobWork[]' id='jobWork"+i+"' value='' onchange='getJwItemName("+i+")' autocomplete='off' /><datalist id='jobWorkList"+i+"'><?php foreach ($jwitem_list as $key) { ?><option value='<?= $key->ITEM_CODE ?>' data-xyz='<?= $key->ITEM_NAME ?>'><?= $key->ITEM_CODE ?> - <?= $key->ITEM_NAME ?></option><?php    } ?></datalist><input text='hidden' class='inputboxclr showhideCls' name='jobwrokitemName[]' id='jobwrokitemName"+i+"' value='' autocomplete='off' /></td></tr>";
        
      $('table').append(data);


      

        var transport_Type = $("input[type='radio'][name='charge_type']:checked").val();

      
        //var transport_Type = $("input[type='radio'][name='charge_type']:checked").val();

      if(transport_Type == 'BY_RAKE'){
         
          $('.showhideCls').hide();

        }else if(transport_Type == 'BY_ROAD'){
         
          $('.showhideCls').show();

           var customer_code = $("#customer_code").val();

          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

    $.ajax({

        url:"{{ url('get-batch-no-details-against-customer') }}",

        method : "POST",

        type: "JSON",

        data: {customer_code:customer_code,transport_Type:transport_Type},

        success:function(data){

          console.log('data1 ajax',data);
          var data1 = JSON.parse(data);
          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

            if(data1.data == ''){

            }else{
              
              console.log('BATCHNO ajax',data1.data);
              console.log('I ajax',i);

                  $("#batchNoList"+count).empty();

                  $.each(data1.data, function(k, getData){

                    $("#batchNoList"+count).append($('<option>',{

                      value:getData.BATCH_NO+'~'+getData.SLNO+'~'+getData.CFINWARDID,

                      'data-xyz':getData.BATCH_NO+'~'+getData.SLNO+'~'+getData.CFINWARDID,
                      'text':getData.BATCH_NO+'-'+getData.ITEM_NAME+'-'+getData.LOADBALQTY+'-'+getData.WAGON_NO+'-'+getData.INVOICE_NO+'-'+getData.RAKE_NO

                    }));

                  });

            }

          }/* /. SUCCESS CODN*/

        } /* /. SUCCESS FUNCTION*/

    });
        

  }

    
      


  i++;}); /* /. ADD MORE FUNCTION*/

  /* ---------- END : ADD MORE FUNCTINALITY -------------- */

  function checkcheckbox(slNo){

    var gtbatchNo   = $('#batch_no'+slNo).val();
    var splitBatch  = gtbatchNo.split('~');
    var batchNo     = splitBatch[0];
    var batchslnoNo = splitBatch[1];
    var tblHeadId = splitBatch[2];
    var itemCd      = $('#item_code'+slNo).val();
    var orderNo     = $('#sOrderNo'+slNo).val();

    var dublicateName = batchNo+'~'+batchslnoNo+'~'+tblHeadId+'~'+itemCd+'~'+orderNo;

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
</script>

<script>

  function calcQty(slno,fieldType){

    var cFactor     = parseFloat($('#cFactor'+slno).val());
    var quantity    = parseFloat($('#quantity'+slno).val());
    var addquantity = parseFloat($('#addquantity'+slno).val());

    if(fieldType=='QTY'){

      if(quantity){

        var aqty = quantity / cFactor;
        if(aqty == Infinity){
          $('#addquantity'+slno).val(0.000);
        }else{
          var aqtyRound = Math.round(aqty);
          $('#addquantity'+slno).val(aqtyRound);
        }

      }else{
        $('#addquantity'+slno).val(0.000);
      }
            
      totalvalCalculation();
    }else if(fieldType=='AQTY'){

      if(addquantity){
        var qty = addquantity * cFactor;
        $('#quantity'+slno).val(qty.toFixed(3));
      }else{
        $('#quantity'+slno).val(0.000);
      }
      
      totalvalCalculation();
    }

  }

  function getvehicleDeatils(){

    var vehicle_No = $("#vehicle_no").val();


    var xyz = $('#vehicleList option').filter(function() {
      return this.value == vehicle_No;
    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
    if(msg == 'No Match'){
      $("#vehicle_no,#trip_no,#gateEntryVrno,#driver_name,#driver_id,#driver_mobNo,#plant_code,#plant_name,#pfct_code,#pfct_name,#tripHeadId,#trip_compCode,#trip_fyCode,#trip_pfctCode,#trip_tranCode,#trip_seriesCode,#trip_accCode,#trip_accName,#trip_fromplace,#trip_toplace,#trip_vrDate,#tblGateId").val('');
      $('#batch_no1').prop('readonly',true);
    }else{
    	

      $("#tblGateId,#trip_no,#gateEntryVrno,#driver_name,#driver_id,#driver_mobNo,#plant_code,#plant_name,#pfct_code,#pfct_name,#tripHeadId,#trip_compCode,#trip_fyCode,#trip_pfctCode,#trip_tranCode,#trip_seriesCode,#trip_accCode,#trip_accName,#trip_fromplace,#trip_toplace,#trip_vrDate").val('');
      $('#batch_no1').prop('readonly',false);

      var gateidsplit = msg.split('~');

       $("#tblGateId").val(gateidsplit[1]);
    }

    var vehicle_no = $('#vehicle_no').val();

   var vehicle_nosp = vehicle_no.split('~');
    var vehicleNo = vehicle_nosp[0];
    var tblGateId = $("#tblGateId").val();
    var transport_Type = $("input[type='radio'][name='trans_type']:checked").val();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        url:"{{ url('get-trip-no-details-against-vehicle') }}",

        method : "POST",

        type: "JSON",

        data: {vehicleNo: vehicleNo,transport_Type:transport_Type,tblGateId:tblGateId},

        success:function(data){

          //console.log('data1',data);
          var data1 = JSON.parse(data);
          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

            if(data1.data_vehicle == ''){

            }else{
              $('#gateEntryVrno').val(data1.data_vehicle[0].VRNO);
              $('#trip_no').val(data1.data_vehicle[0].TRIP_NO);
                $('#driver_name').val(data1.data_vehicle[0].DRIVER_NAME);
                $('#driver_id').val(data1.data_vehicle[0].DRIVER_ID);
                $('#driver_mobNo').val(data1.data_vehicle[0].MOBILE_NUMBER);
                $('#plant_code').val(data1.data_vehicle[0].PLANT_CODE);
                $('#plant_name').val(data1.data_vehicle[0].PLANT_NAME);
                $('#pfct_code').val(data1.data_vehicle[0].PFCT_CODE);
                $('#pfct_name').val(data1.data_vehicle[0].PFCT_NAME);
                $('#tripHeadId').val(data1.data_vehicle[0].TRIPHID);
                $('#trip_compCode').val(data1.data_vehicle[0].TRIP_COMP_CODE);
                $('#trip_fyCode').val(data1.data_vehicle[0].TRIP_FY_CODE);
                $('#trip_pfctCode').val(data1.data_vehicle[0].TRIP_PFCT_CODE);
                $('#trip_tranCode').val(data1.data_vehicle[0].TRIP_TRAN_CODE);
                $('#trip_seriesCode').val(data1.data_vehicle[0].TRIP_SERIES_CODE);
                $('#trip_accCode').val(data1.data_vehicle[0].TRIP_ACC_CODE);
                $('#trip_accName').val(data1.data_vehicle[0].TRIP_ACC_NAME);
                $('#trip_fromplace').val(data1.data_vehicle[0].TRIP_FROM_PLACE);
                $('#trip_toplace').val(data1.data_vehicle[0].TRIP_TO_PLACE);
                $('#trip_vrDate').val(data1.data_vehicle[0].TRIP_VRDATE);

                /*if(data1.data_vehicle[0].TRPT_CODE){
                  $('#trpt_code').val(data1.data_vehicle[0].TRPT_CODE);
                  $('#trpt_name').val(data1.data_vehicle[0].TRPT_NAME);
                  $('#trpt_code').prop('readonly',true);
                  $('#trpt_name').prop('readonly',true);
                }else{
                  $('#trpt_code').val('');
                  $('#trpt_name').val('');
                  $('#trpt_code').prop('readonly',false);
                  $('#trpt_name').prop('readonly',false);
                }*/
            }

          }/* /. SUCCESS CODN*/

        } /* /. SUCCESS FUNCTION*/

    }); /* /. AJAX FUNCTION*/

  }

  function getJwItemName(slNo){

    

      var jobworkitem = $("#jobWork"+slNo).val();

      var xyz = $('#jobWorkList'+slNo+' option').filter(function() {

        return this.value == jobworkitem;
      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
           $("#jobWork"+slNo).val('');
           $('#jobwrokitemName'+slNo).val('');
      }else{
        
        $('#jobwrokitemName'+slNo).val(msg);
      }

    
  }


  function getInwardDetails(slNo,fieldType){

    $('#transaction_date,#series_code,#vehicle_no').prop('readonly',true);
    $("input[name=trans_type]").prop("disabled",true);
    $('#transaction_date').datepicker("destroy");

    if(fieldType == 'BATCH'){

      var batch_Num = $("#batch_no"+slNo).val();

      var xyz = $('#batchNoList'+slNo+' option').filter(function() {
        return this.value == batch_Num;
      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#batch_no'+slNo+',#item_code'+slNo+',#sOrderNo'+slNo+',#wagon_no'+slNo+',#rakeNum'+slNo+',#quantity'+slNo+',#um_code'+slNo+',#addquantity'+slNo+',#addum_code'+slNo+',#cp_code'+slNo+',#cp_name'+slNo+',#location_code'+slNo+',#location_name'+slNo+',#batchSlno'+slNo+',#tblHeadId'+slNo+'').val('');
      }else{
        $('#item_code'+slNo+',#sOrderNo'+slNo+',#wagon_no'+slNo+',#rakeNum'+slNo+',#quantity'+slNo+',#um_code'+slNo+',#addquantity'+slNo+',#addum_code'+slNo+',#cp_code'+slNo+',#cp_name'+slNo+',#location_code'+slNo+',#location_name'+slNo+',#batchSlno'+slNo+',#tblHeadId'+slNo+'').val('');
        console.log('msg',msg);
        var getBatchSlno = msg.split('~');
        var batchSlno = getBatchSlno[1];
        var tblHeadId = getBatchSlno[2];
        $('#batchSlno'+slNo).val(batchSlno);
        $('#tblHeadId'+slNo).val(tblHeadId);
      }

    }

    if(fieldType == 'ITEM'){
      
      var item_cd = $("#item_code"+slNo).val();
      var xyz = $('#itemList'+slNo+' option').filter(function() {
        return this.value == item_cd;
      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#item_code'+slNo+',#sOrderNo'+slNo+',#wagon_no'+slNo+',#rakeNum'+slNo+',#quantity'+slNo+',#um_code'+slNo+',#addquantity'+slNo+',#addum_code'+slNo+',#cp_code'+slNo+',#cp_name'+slNo+',#location_code'+slNo+',#location_name'+slNo+'').val('');
      }else{
        $('#item_name'+slNo).val(msg);
         $('#sOrderNo'+slNo+',#wagon_no'+slNo+',#rakeNum'+slNo+',#quantity'+slNo+',#um_code'+slNo+',#addquantity'+slNo+',#addum_code'+slNo+',#cp_code'+slNo+',#cp_name'+slNo+',#location_code'+slNo+',#location_name'+slNo+'').val('');
      }

    }

    if(fieldType == 'ORDER'){

      var orderNo = $("#sOrderNo"+slNo).val();

      var xyz = $('#doNoList'+slNo+' option').filter(function() {
        return this.value == orderNo;
      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#sOrderNo'+slNo+',#wagon_no'+slNo+',#rakeNum'+slNo+',#quantity'+slNo+',#um_code'+slNo+',#addquantity'+slNo+',#addum_code'+slNo+',#cp_code'+slNo+',#cp_name'+slNo+',#location_code'+slNo+',#location_name'+slNo+'').val('');
      }else{
        $('#wagon_no'+slNo+',#rakeNum'+slNo+',#quantity'+slNo+',#um_code'+slNo+',#addquantity'+slNo+',#addum_code'+slNo+',#cp_code'+slNo+',#cp_name'+slNo+',#location_code'+slNo+',#location_name'+slNo+'').val('');
      }

    }

    var temItem = $('#tempItemSave'+slNo).val();
    var getSelData = $('#dublicateName').val(); 
    var slptData = getSelData.split(',');
    var indexDt = slptData.indexOf(temItem);
    if (indexDt > -1) { // only splice array when item is found
      slptData.splice(indexDt, 1); // 2nd parameter means remove one item only
    }
    $('#dublicateName').val('');
    $('#dublicateName').val(slptData);
    
    var gtbatchNo   = $("#batch_no"+slNo).val();
    var slitBatchNo = gtbatchNo.split('~');
    var batchNo     = slitBatchNo[0];
    var batchslnoNo = slitBatchNo[1];
    var orderNo     = $("#sOrderNo"+slNo).val();
    var itemCode    = $("#item_code"+slNo).val();
    var inTblHeadId = $("#tblHeadId"+slNo).val();

    var transportType = $("input[type='radio'][name='charge_type']:checked").val();
    var cpCode = $("#cpCode").val();
    var cpName = $("#cpName").val();

   //alert(transportType);return false;

    if(orderNo && batchNo && itemCode){
        $('#submitdata,#submitdatapdf').prop('disabled',false);
      }

    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }
    });

    $.ajax({

        url:"{{ url('get-trip-no-details-against-vehicle') }}",

        method : "POST",

        type: "JSON",

        data: {orderNo: orderNo,batchNo:batchNo,batchslnoNo:batchslnoNo,itemCode:itemCode,fieldType:fieldType,transportType:transportType,inTblHeadId:inTblHeadId},

        success:function(data){

          var data1 = JSON.parse(data);

          console.log(data1);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

              $('#fieldReqMsg').html("");

              if(data1.data_inwardDt_list == ''){

              }else{

                if(batchNo && fieldType=='BATCH'){

                  if(data1.data_inwardDt_list.length == 1){
                    $('#item_code'+slNo).val(data1.data_inwardDt_list[0].ITEM_CODE);
                  }

                  $("#itemList"+slNo).empty();

                  $.each(data1.data_inwardDt_list, function(k, getBatchNo){

                    $("#itemList"+slNo).append($('<option>',{

                      value:getBatchNo.ITEM_CODE,

                      'data-xyz':getBatchNo.ITEM_NAME,
                      text:getBatchNo.ITEM_CODE+' [ '+getBatchNo.ITEM_NAME+' ]'

                    }));

                  });

                  getInwardDetails(slNo,"ITEM");

                }

                if(batchNo && itemCode && fieldType=='ITEM'){

                  if(data1.data_inwardDt_list.length == 1){
                    $('#sOrderNo'+slNo).val(data1.data_inwardDt_list[0].ORDER_NO);
                  }


                  $("#doNoList"+slNo).empty();

                  $.each(data1.data_inwardDt_list, function(k, getBatchNo){

                    $("#doNoList"+slNo).append($('<option>',{

                      value:getBatchNo.ORDER_NO,

                      'data-xyz':getBatchNo.ORDER_NO,
                      text:getBatchNo.ORDER_NO+'-'+getBatchNo.CP_NAME+'-'+getBatchNo.TO_PLACE

                    }));

                  });

                  getInwardDetails(slNo,"ORDER");

                }


                if(batchNo && itemCode && orderNo && fieldType=='ORDER'){

                  var inwardQTY = parseFloat(data1.data_inwardDt_list[0].QTYRECD);                                                          
                  var planloadQty = parseFloat(data1.data_inwardDt_list[0].LOADSLIP_QTY);                                                          
                  var issueQty = parseFloat(data1.data_inwardDt_list[0].QTYISSUED);                                                          
                  var loadBalQty = inwardQTY - planloadQty - issueQty;

                  var loadBalAqty = parseFloat(loadBalQty) / parseFloat(data1.data_inwardDt_list[0].CFACTOR);
                  
                  var aQtyRound = Math.round(loadBalAqty);
                 

                  $('#cFactor'+slNo).val(data1.data_inwardDt_list[0].CFACTOR);
                  $('#item_name'+slNo).val(data1.data_inwardDt_list[0].ITEM_NAME);
                  $('#wagon_no'+slNo).val(data1.data_inwardDt_list[0].WAGON_NO);
                  $('#rakeNum'+slNo).val(data1.data_inwardDt_list[0].RAKE_NO);
                  $('#quantity'+slNo).val(loadBalQty.toFixed(3));
                  $('#um_code'+slNo).val(data1.data_inwardDt_list[0].UM);
                  $('#addquantity'+slNo).val(aQtyRound);
                  $('#addum_code'+slNo).val(data1.data_inwardDt_list[0].AUM);
                  $('#addum_code'+slNo).prop('readonly',false).css('background-color','#fff');
                  //alert(transportType);
                  if(transportType=='BY_RAKE'){
                    $('#cp_code'+slNo).val(data1.data_inwardDt_list[0].CP_CODE);
                    $('#cp_name'+slNo).val(data1.data_inwardDt_list[0].CP_NAME);
                    $('#lrGenInfo'+slNo).val(data1.data_inwardDt_list[0].CP_CODE+'~'+data1.data_inwardDt_list[0].RAKE_NO);
                  }else{
                    $('#cp_code'+slNo).val(cpCode);
                    $('#cp_name'+slNo).val(cpName);
                    $('#lrGenInfo'+slNo).val(cpCode);
                  }
                  
                  $('#location_code'+slNo).val(data1.data_inwardDt_list[0].LOCATION_CODE);
                  $('#location_name'+slNo).val(data1.data_inwardDt_list[0].LOCATION_NAME);
                  $('#doTRPTCode'+slNo).val(data1.data_inwardDt_list[0].DO_TRPT_CODE);
                  $('#doTRPTName'+slNo).val(data1.data_inwardDt_list[0].DO_TRPTNAME);
                  $("#trpt_code").val(data1.data_trpt_data.TRPT_CODE);
                   $("#trpt_name").val(data1.data_trpt_data.TRPT_NAME);
                  totalvalCalculation();
                  
                  checkDubicateBodyEntry(slNo,orderNo,batchNo,batchslnoNo,itemCode,inTblHeadId);
                }

              } /* /. CODN */
          }/* /. SUCCESS CODN*/

        } /* /. SUCCESS FUNCTION*/

    }); /* /. AJAX FUNCTION*/

  }

  function validationLrno(slNo){

      if(slNo > 1){

        var cpCdAry = [];
    
        $(".cpCddata").each(function () {

          cpCdAry.push(this.value);
          
        });

        var rowWiseCPCode = $('#lrGenInfo'+slNo).val();
        
        cpCdAry.splice(-1);
        //console.log(cpCdAry,'cpCdAry');
        var isInArray = cpCdAry.includes(rowWiseCPCode);
        
        var postionOfVal = cpCdAry.indexOf(rowWiseCPCode);

        if(postionOfVal == '-1'){
         // console.log('not Same');
          var getexistVal = $('#generateLrNo').val();
          var lrNoGenerate = parseInt(getexistVal) + parseInt(1);
        //  console.log('getexistVal',getexistVal);
         // console.log('lrNoGenerate',lrNoGenerate);
          $('#generateLrNo').val(lrNoGenerate);
          $('#uniqLrNo'+slNo).val(lrNoGenerate);
        }else{
          var existLr =  parseInt(postionOfVal) + parseInt(1);

          var getExistlrNo = $('#uniqLrNo'+existLr).val();
          $('#uniqLrNo'+slNo).val(getExistlrNo);
        }

      }

  }

  /* ------- CHECK DUBLICATE ENTRY -------- */

  /* ---------- check duplicate entry --------- */

    function checkDubicateBodyEntry(slNo,dOrderNo,batch_no,batchslnoNo,itemCode,inTblHeadId){

      if(dOrderNo && batch_no && itemCode && inTblHeadId){

        var checkDublicates = batch_no+'~'+batchslnoNo+'~'+inTblHeadId+'~'+itemCode+'~'+dOrderNo;

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
              $('#sOrderNo'+slNo).val('');
              $('#batch_no'+slNo).val('');
              $('#batchSlno'+slNo).val('');
              $('#tblHeadId'+slNo).val('');
              $('#wagon_no'+slNo).val('');
              $('#rakeNum'+slNo).val('');
              $('#item_code'+slNo).val('');
              $('#item_name'+slNo).val('');
              $('#quantity'+slNo).val('');
              $('#um_code'+slNo).val('');
              $('#addquantity'+slNo).val('');
              $('#addum_code'+slNo).val('');
              $('#cp_code'+slNo).val('');
              $('#cp_name'+slNo).val('');
              $('#location_code'+slNo).val('');
              $('#location_name'+slNo).val('');
              $('#doNoList'+slNo).empty();
              $('#itemList'+slNo).empty();

              totalvalCalculation();
            }else if(checkDub == false){
              $('#showDubDataMsg').html('');
              var getPrevVal = $("#dublicateName").val();
              $("#dublicateName").val(getPrevVal+','+checkDublicates);
              $("#tempItemSave"+slNo).val(checkDublicates);
              validationLrno(slNo);
            }

          }else{

            var blnkAry1 = [];
            var existGet1 = $("#dublicateName").val();
            blnkAry1.push(existGet1);

            var checkDub1 = blnkAry1.includes(checkDublicates);

            if(checkDub1 == true){
              $('#showDubDataMsg').html('Dublicate Details');
              $('#sOrderNo'+slNo).val('');
              $('#batch_no'+slNo).val('');
              $('#batchSlno'+slNo).val('');
              $('#tblHeadId'+slNo).val('');
              $('#rakeNum'+slNo).val('');
              $('#wagon_no'+slNo).val('');
              $('#item_code'+slNo).val('');
              $('#item_name'+slNo).val('');
              $('#quantity'+slNo).val('');
              $('#um_code'+slNo).val('');
              $('#addquantity'+slNo).val('');
              $('#addum_code'+slNo).val('');
              $('#cp_code'+slNo).val('');
              $('#cp_name'+slNo).val('');
              $('#location_code'+slNo).val('');
              $('#location_name'+slNo).val('');
              $('#doNoList'+slNo).empty();
              $('#itemList'+slNo).empty();
              totalvalCalculation();
            }else if(checkDub1 == false){
              $('#showDubDataMsg').html('');
              var getPrevVal1 = $("#dublicateName").val();
              $("#dublicateName").val(getPrevVal1+','+checkDublicates);    
              $("#tempItemSave"+slNo).val(checkDublicates);
              validationLrno(slNo);                          
            }

          }
        }

      }else{
          
      }
    }

  /* ------- CHECK DUBLICATE ENTRY -------- */

  function totalvalCalculation(){

      var totqty = 0;

      $(".qtyVal").each(function () {
        
          if (!isNaN(this.value) && this.value.length != 0) {
              totqty += parseFloat(this.value);
          }

        $("#total_Qty").val(totqty.toFixed(3));

      });

      var totAqty = 0;

      $(".aQtyVal").each(function () {
        
          if (!isNaN(this.value) && this.value.length != 0) {
              totAqty += parseFloat(this.value);
          }

        $("#total_AQty").val(totAqty.toFixed(3));

      });

  }

/* --------------- START : SUBMIT DATA ------------ */

  function submitLoadingSlipTrans(pdfFlag){
    var downloadFlg = pdfFlag;

    $('#pdfYesNoStatus').val(downloadFlg);

    var trcount=$('table tr').length;
    var valueOrderNo=[];
    var valueBatchNo=[];
    var valueItemCode=[];
    var rowIDget=[];
    var valueQuantity=[];

    $(".rowCountCls").each(function () {
        
         rowIDget.push(this.value);

    });
  
    for(var y=0;y<rowIDget.length;y++){

      var colIdSlno = rowIDget[y];
      
      var orderNo = $('#sOrderNo'+colIdSlno).val();
      var batchNo = $('#batch_no'+colIdSlno).val();
      var itemCode = $('#item_code'+colIdSlno).val();
      var quantity = $('#quantity'+colIdSlno).val();

      valueOrderNo.push(orderNo);
      valueBatchNo.push(batchNo);
      valueItemCode.push(itemCode);
      valueQuantity.push(quantity);
    }

    var found_order = valueOrderNo.find(function (order_No) {
      return order_No == '';
    });

    var found_batch = valueBatchNo.find(function (batch_No) {
      return batch_No == '';
    });

    var found_item = valueItemCode.find(function (item_cd) {
      return item_cd == '';
    });

    var found_qty = valueQuantity.find(function (qty) {
      return qty == '';
    });


    if(found_order == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_batch == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_item == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_qty == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else{

      var data = $("#loadingSlipTran").serialize();

      var transDate      = $('#transaction_date').val();
      var series_code    = $('#series_code').val();
      var vehicle_no     = $('#vehicle_no').val();
      var transport_Type = $("input[type='radio'][name='trans_type']:checked").val();

      if(transDate && series_code && vehicle_no && transport_Type){

        $('#fieldReqMsg').html('');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/transaction/CandF/submit-loading-slip-without-plan') }}",

            data: data, // here $(this) refers to the ajax object not form
            success: function (data) {
              var data1 = JSON.parse(data);
              if(data1.response == 'error') {

                var responseVar = false;
                var url = "{{url('candf/loading-slip/save-msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });

              }else{

                var responseVar = true;

                if(downloadFlg == 1){
                  var fyYear    = data1.data[0].FY_CODE;
                  var fyCd      = fyYear.split('-');
                  var seriesCd  = data1.data[0].SERIES_CODE;
                  var vrNo      = data1.data[0].VRNO;
                  var fileN     = 'LS_'+fyCd[0]+''+seriesCd+''+vrNo;
                  var link      = document.createElement('a');
                  link.href     = data1.url;
                  link.download = fileN+'.pdf';
                  link.dispatchEvent(new MouseEvent('click'));
                }

                var url = "{{url('candf/loading-slip/save-msg')}}";
                setTimeout(function(){ window.location = url+'/'+responseVar; });
                
              }//* /. condition*/

            },/* /. success function*/

        }); /* /. ajax*/

      }else{
        
        $('#fieldReqMsg').html("All Fields Is Required....!");
      }

    }/* /. */

  }/* /. main function */

/* --------------- END : SUBMIT DATA ------------ */

</script>

@endsection