@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .box-header>.box-tools {
    position: absolute !important;
    right: 10px !important;
    top: 2px !important;
  }
  .required-field::before {
    content: "*";
    color: red;
  }
  .showSeletedName{
    font-size: 12px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
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
  .totlLable{
    width: 6%;
    text-align: center;
    margin-top: 7px;
    font-weight: 700;
  }
  .numberRight{
    text-align:right;
  }
  .showhideCls{
    display:none;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Goods Receipt Note
      <small>Inward Transaction Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transation </a></li>
      <li class="active"><a href="{{ url('/form-inward-trans') }}">Goods Receipt Note </a></li>
      <li class="active"><a href="{{ url('/form-inward-trans') }}">Add Goods Receipt Note</a></li>

    </ol>

  </section>


<form id="inwardTran">
    @csrf

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle formTitle" style="font-weight: 800;color: #5696bb;">Add Goods Receipt Note</h2>

        <div class="box-tools pull-right">

          <a href="{{ url('transaction/c-and-f/view-inward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View Goods Receipt Note</a>

        </div>

      </div><!-- /.box-header -->

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

                    <input type="text" class="form-control" name="tran_code" value="{{$tranlist->TRAN_CODE }}" placeholder="Enter Trans Code" maxlength="15" id="tran_code" readonly >

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('trans_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label> Series Code : <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                    <?php $seriesCnt = count($seriesList); 
                        if($seriesCnt == 1){
                          $seriesCode = $seriesList[0]->SERIES_CODE;
                          $seriesName = $seriesList[0]->SERIES_NAME;
                        }else{
                          $seriesCode ='';
                          $seriesName ='';
                        }
                    ?>

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

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input list="vehicleList" id="vehicle_no" name="vehicle_no" class="form-control  pull-left" value="{{ old('vehicle_no')}}" placeholder="Enter Vehicle No" onchange="vehicleDetails(1)" autocomplete="off">

                  <datalist id="vehicleList">

                    @foreach ($vehicle_list as $key)

                    <option value='<?php echo $key->VEHICLE_NUMBER?>~<?php echo $key->CFGATEID?>'   data-xyz ="<?php echo $key->VEHICLE_NUMBER; ?>~<?php echo $key->CFGATEID?>" ><?php echo $key->VEHICLE_NUMBER ;?></option>

                    @endforeach
                    
                  </datalist>

                </div>

                <input type="hidden" name="gateEntryVrno" id="gateEntryVrno">
                <input type="hidden" name="gateEntryTblId" id="gateEntryTblId">

              </div>

            </div><!-- /.col --> 

            <div class="col-md-2">

              <div class="form-group">

                <label>Transporter Type: <span class="required-field"></span></label>

                 <div class="input-group">

                  <input type="radio" class="optionsRadios1 transType" name="trans_type" value="SELF" checked="">&nbsp;Self &nbsp;
                  <input type="radio" class="optionsRadios1 transType" name="trans_type" value="MARKET" >&nbsp;&nbsp;Market &nbsp;&nbsp;

                </div>
                <input type="hidden" name='transpoterType' value='SELF' id="transporterType">

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Transporter Code : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input list="transList" id="trans_code" name="trans_code" class="form-control  pull-left" value="{{ old('trans_code')}}" placeholder="Enter Transporter Code" oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly>

                  <datalist id="transList">

                    <option selected="selected" value="">-- Select --</option>

                    @foreach ($transporter_list as $key)

                    <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                    @endforeach

                  </datalist>

                </div>

                <small>  
                  <div class="pull-left showSeletedName" id="transText"></div>
                </small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Transporter Name : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="trans_name" name="trans_name" class="form-control  pull-left" value="{{ old('trans_name')}}" placeholder="Enter Transporter Name" autocomplete="off" oninput="this.value = this.value.toUpperCase()" readonly>

                </div>

              </div>

            </div><!-- /.col -->
            
          </div><!-- /.row -->

          <div class="row">

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Plant Code : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input list="plantList" id="plant_code" name="plant_code" class="form-control  pull-left" value="{{ old('plant_code')}}" placeholder="Enter Plant Code" autocomplete="off" oninput="this.value = this.value.toUpperCase()" readonly>

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

                  <input type="text" id="plant_name" name="plant_name" class="form-control  pull-left" value="{{ old('plant_name')}}" placeholder="Enter Plant Name" oninput="this.value = this.value.toUpperCase()" readonly>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Profit Center Code : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="pfct_code" name="pfct_code" class="form-control  pull-left" value="{{ old('account_code')}}" placeholder="Enter Profit Center Code" autocomplete="off" oninput="this.value = this.value.toUpperCase()" readonly>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Profit Center Name : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="pfct_name" name="pfct_name" class="form-control  pull-left" value="{{ old('pfct_name')}}" placeholder="Enter Profit Center Name" oninput="this.value = this.value.toUpperCase()" readonly>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">U/L Contractor Code : </label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input list="contractorList" id="ulContractorCode" name="ulContractorCode" class="form-control  pull-left" value="{{ old('ulContractorCode')}}" autocomplete="off" placeholder="Enter U/L Contractor Code" oninput="this.value = this.value.toUpperCase()">

                  <datalist id="contractorList">
                      
                    @foreach ($contractor_list as $key)

                    <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                    @endforeach

                  </datalist>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">U/L Contractor Name : </label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="ulContractor_name" name="ulContractor_name" class="form-control  pull-left" value="{{ old('ulContractor_name')}}" autocomplete="off" placeholder="Enter U/L Contractor Name" oninput="this.value = this.value.toUpperCase()" readonly>

                </div>

              </div>

            </div><!-- /.col -->
            
          </div><!-- /.row -->

          <div class="row">
            
            <div class="col-md-2">

              <div class="form-group">

                <label> Transport: <span class="required-field"></span></label>

                 <div class="input-group">

                  <input type="radio" class="optionsRadios1 transportType" name="charge_type" value="BY_RAKE" checked="">&nbsp;By Rake &nbsp;
                  <input type="radio" class="optionsRadios1 transportType" name="charge_type" value="BY_ROAD" >&nbsp;&nbsp;By Road &nbsp;&nbsp;

                </div>
                <input type="hidden" name='tranPort_Type' value='BY_RAKE' id="tranPort_Type">
              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Rake No. : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input list="rakeNoList" id="rake_no" name="rake_no" class="form-control  pull-left" value="{{ old('rake_no')}}" placeholder="Enter Rake No." autocomplete="off" onchange="getDetailOfRackNo()">

                  <datalist id="rakeNoList">

                    <option value=""> -- Select -- </option>
                    
                     @foreach ($rakeNo_list as $key)

                    <option value='<?php echo $key->RAKE_NO?>'   data-xyz ="<?php echo $key->RAKE_NO; ?>"><?php echo $key->RAKE_NO ;?></option>

                    @endforeach

                  </datalist>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Slip No : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="slip_no" name="slip_no" class="form-control pull-left" value="{{ old('slip_no')}}" placeholder="Enter Slip No">

                </div>

              </div>

            </div>

            <div class="col-md-2 showhideCls">

              <div class="form-group">

                <label for="exampleInputEmail1">Customer Code : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input list="customerList" id="customer_code" name="customer_code" class="form-control  pull-left" value="{{ old('customer_code')}}" autocomplete="off" placeholder="Enter Customer Code">

                  <datalist id="customerList">

                    <option value=""> -- Select -- </option>
                    
                     @foreach ($contractor_list as $key)

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

                  <input list="cpList" id="cp_code" name="cp_code" class="form-control  pull-left" value="{{ old('customer_code')}}" autocomplete="off" placeholder="Enter Cp Code">

                  <datalist id="cpList">

                    <option value=""> -- Select -- </option>
                    
                     @foreach ($consignee_list as $key)

                    <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                    @endforeach

                  </datalist>

                </div>

              </div>

            </div><!-- /.col -->

            <!-- /.col -->

           

          </div><!-- /.row -->



          <div class="row showhideCls">

             <div class="col-md-2 showhideCls">

              <div class="form-group">

                <label for="exampleInputEmail1">CP Name : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="cp_name" name="cp_name" class="form-control pull-left" value="{{ old('cp_name')}}" placeholder="Enter Cp Name" readonly>

                </div>

              </div>

            </div>
             <div class="col-md-2 showhideCls">

              <div class="form-group">

                <label for="exampleInputEmail1">Invoice No : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="invoice_no" name="invoice_no" autocomplete="off" class="form-control pull-left" value="{{ old('invoice_no')}}" placeholder="Enter Invoice No">

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2 showhideCls">

              <div class="form-group">

                <label for="exampleInputEmail1">Invoice Date : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="invoice_date" name="invoice_date" autocomplete="off" class="form-control pull-left invoiceDate" value="{{ old('invoice_date')}}" placeholder="Enter Invoice Date">

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Order No : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="order_no" name="order_no" autocomplete="off" class="form-control pull-left" value="{{ old('order_no')}}" placeholder="Enter Order No">

                </div>

              </div>

            </div><!-- /.col --> 

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Order Date : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input type="text" id="order_date" name="order_date" autocomplete="off" class="form-control pull-left orderDate" value="{{ old('order_date')}}" placeholder="Enter Order Date">

                </div>

              </div>

            </div><!-- /.col --> 
            
          </div><!-- /.row -->

      </div><!-- /.box-body -->

    </div><!-- /. custom box -->

  </section><!-- /.section -->

  <section class="content"  style="margin-top: -20px;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <div class="modalspinner hideloaderOnModl"></div>

            <div class="table-responsive">

              <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbleBodydata">

                <tr>
                  <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th>
                  <th style='width: 10px;'> Sr.No.</th>
                  <th>Batch No</th>
                  <th>Item Code</th>
                  <th>Item Name</th>
                  <th>Rake/STO Qty</th>
                  <th>UM</th>
                  <th>Rake/STO Aqty</th>
                  <th>AUM</th>
                  <th>Qty Recd</th>
                  <th>AQty Recd</th>
                  <th>Location Code</th>
                  <th>Location Name</th>
                </tr>

                <tr>

                  <td class="tdthtablebordr">
                    <input type="hidden" id="tempItemSave1" value="">
                    <input type='checkbox' class='case' id="tblcheckrow1" onclick="checkcheckbox(1);"/>
                  </td>

                  <td class="tdthtablebordr">
                    <span id='snum'>1.</span>
                    <input type="hidden" class="rowCountCls" id='rowCount1' name="rowCount[]" value="1">
                  </td>

                  <td class="tdthtablebordr" style="width: 12%;">

                    <div>
                      <input list="batchList1" class="inputboxclr" id='batchNo1' name="batch_No[]"   oninput="this.value = this.value.toUpperCase()" readonly onchange="getItemAgainstBatch(1,'BATCH')" autocomplete="off"/>
                      <datalist id="batchList1">
                        <option value=""></option>
                      </datalist>

                    </div>
                    <input type="hidden" id="batchSlno1" name="batchSlno[]">
                  </td>

                  <td class="tdthtablebordr" style="width: 10%;">

                    <div>
                      <input list="itemList1" class="inputboxclr" id='Item_Code1' name="item_code[]"   oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off" onchange="getItemDetails(1,'ITEM')"/>
                      <datalist id="itemList1">
                        <option value=""> -- Select --</option>
                      </datalist>
                    </div>
                    
                  </td>

                  <td class="tdthtablebordr" style="width: 15%;">

                    <div>
                      <input type="text" class="inputboxclr" id='Item_name1' name="item_name[]"   oninput="this.value = this.value.toUpperCase()" autocomplete="off" style="background-color: #eeeeee;" readonly />
                    </div>
                    
                  </td>

                  <td class="tdthtablebordr" style="width: 7%;">

                    <input type="text" class="inputboxclr numberRight rakeQtyCl" id='rakeQty1' name="rake_Qty[]"  autocomplete="off" oninput="calcAQty(1,'RAKE')"/>
                    <input type="hidden" id="cFactor1" name="cFactor[]">
                  </td>

                  <td class="tdthtablebordr" style="width: 4%;">

                    <input type="text" class="inputboxclr" id='umCode1' name="umCode[]"   oninput="this.value = this.value.toUpperCase()" autocomplete="off" style="background-color: #eeeeee;" readonly />
                    
                  </td>

                  <td class="tdthtablebordr" style="width: 7%;">

                    <input type="text" class="inputboxclr numberRight rakeAQtyCl" id='rakeAQty1' name="rake_AQty[]" oninput="this.value = this.value.toUpperCase()" style="background-color: #eeeeee;" />



                  </td>

                  <td class="tdthtablebordr" style="width: 4%;">

                    <input list="aumList1" class="inputboxclr" id='aumCode1' name="aumCode[]"   oninput="this.value = this.value.toUpperCase()" style="background-color: #eeeeee;"  />

                    <datalist id="aumList1">

                        <?php foreach ($aum_list as $key) { ?>   
                          <option value="<?= $key->UM_CODE ?>" data-xyz="<?= $key->UM_CODE ?>"><?= $key->UM_CODE ?></option>
                         <?php } ?>
                    </datalist>
                    
                  </td>

                  <td class="tdthtablebordr" style="width: 9%;">

                      <input type="text" class="inputboxclr numberRight qtyRecdCl" id='qty_recd1' name="qty_recd[]" autocomplete="off" oninput="calcAQty(1,'RECD')" />

                  </td>

                  <td class="tdthtablebordr" style="width: 8%;">

                      <input type="text" class="inputboxclr numberRight aqtyRecdCl" id='qty_Arecd1' name="qty_Arecd[]"   oninput="this.value = this.value.toUpperCase()" style="background-color: #eeeeee;" readonly />

                  </td>

                  <td class="tdthtablebordr" style="width: 9%;">

                    <div>
                      <input list="locationList1" class="inputboxclr" id='location_Code1' name="location_code[]" oninput="this.value = this.value.toUpperCase()" onchange="locationDetails(1)" autocomplete="off" />

                      <datalist id="locationList1">
                        
                      </datalist>

                    </div>
                    
                  </td>

                  <td class="tdthtablebordr" style="width: 15%;">

                    <div>
                      <input type="text" class="inputboxclr" id='location_name1' name="location_name[]"   oninput="this.value = this.value.toUpperCase()" style="background-color: #eeeeee;" readonly />
                    </div>
                    
                  </td>

                </tr>

              </table><!-- /.table -->

            </div><!-- /.table-responsive -->

            <div class="row">

              <div class="col-md-12" style="display: flex;">

                <div style="width:35%;">
                  <input type="hidden" name="dublicateName1[]" id="dublicateName" value="">
                  <input type="hidden" name="deletedubName1[]" id="deletedubName" value="">
                  <button type="button" class='btn btn-danger delete' id="deletehidn" ><i class="fa fa-minus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Delete</button>

                  <button type="button" class='btn btn-info addmore' id="addmorhidn" ><i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Add More</button>
                  
                  <small id="showDubDataMsg" style="color: red;"></small>
                </div>

                <div class="totlLable" style="width:6%;">
                  Total : 
                </div>

                <div style="width:6%">
                
                  <input class="debitcreditbox inputboxclr numberRight" style="background-color: #eeeeee;" type="text" name="totalQty" id="total_rakeQty" readonly>

                </div>
                <div style="width:4%">&nbsp;</div>
                <div style="width:6%">
                
                  <input class="debitcreditbox inputboxclr numberRight" style="background-color: #eeeeee;" type="text" name="totalQty" id="total_rakeAQty" readonly>

                </div>
                <div style="width:5%">&nbsp;</div>
                <div style="width:7%">
                
                  <input class="debitcreditbox inputboxclr numberRight" style="background-color: #eeeeee;" type="text" name="totalQty" id="total_recdQty" readonly>

                </div>
                <div style="width:1%">&nbsp;</div>
                <div style="width:7%">
                
                  <input class="debitcreditbox inputboxclr numberRight" style="background-color: #eeeeee;" type="text" name="totalQty" id="total_recdAqty" readonly>

                </div>
                
              </div><!-- /.col-md-12 -->
              
            </div><!-- /.row -->

            <div class="row" style="text-align:center;margin-bottom: 5px;font-weight: 700;">
              <small id="fieldReqMsg" style="color:red;"></small>
            </div>

            <div class="row" style="margin-top: 10px;">

              <div class="col-md-12" style="text-align: center;">
                <button class="btn btn-success" type="button" id="submitdata" onclick="submitInwardTrans(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>
              </div>

            </div><!-- /.row -->

          </div><!-- /. box body -->

        </div><!-- /.Custom-Box -->

      </div><!-- /.col-sm-12 -->

    </div><!-- /.row -->
    
  </section><!-- /.section -->

</form>

</div><!-- /.content-wrapper -->

<div class="modal fade" id="fileUploadModal" role="dialog">
  <div class="modal-dialog modal-sm" style="top: 25%;">
    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 5px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color: #d44656;font-weight: 600;"> <i class="fa fa-exclamation" aria-hidden="true"></i> Alert</h4>
      </div>
      <div class="modal-body">
       <span style="font-size: 15px;font-weight: 600;">Sto qty and rcv qty + return qty not equal</span>
      </div>
    </div>
  </div>
</div>


@include('admin.include.footer')

<script type="text/javascript">

  $(document).ready(function(){

    getvrnoBySeries();

    fieldValidation();

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

      fieldValidation();

    });

    $('#cp_code').on('change',function(){

      var cp_Code = $('#cp_code').val();
      var xyz = $('#cpList option').filter(function() {
        return this.value == cp_Code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      if(msg=='No Match'){
        $('#cp_name').val('');
        $('#cp_code').val('');
      }else{  
        $('#cp_name').val(msg);
      }

    });

    $('#invoice_no,#order_no').on('input',function(){
      fieldValidation();
    });
    $('#invoice_date,#order_date').on('change',function(){
      fieldValidation();
    });
  });

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

      fieldValidation();

      var seriesCode = $('#series_code').val();
      var transcode  = $('#tran_code').val();

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
      });

      $.ajax({

        url:"{{ url('get-last-no-vr-sequence-by-series-new') }}",
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
                        var lastNo = parseInt(getlastno);
                        $('#vrseqnum').val(lastNo);
                    }else{
                        var getlastno = '';
                    }
                }

            } /* /. success */
         } /* /. success function */
    }); /* /. ajax function */
  } /* /. main function */

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

        totalQtyCalculation();

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
      }else{

        $.each( obj, function( key, value ) {
          id=value.id;
          $('#'+id).html(key+1);
        });

      }

    }

  /* ---------- DELETE ROW ---------- */ 

  /* ----------- ADD MORE ROW FUNCTIONALITY --------------- */ 

    var slNo=1;
    var i=2;

    $(".addmore").on('click',function(){

      count=$('table tr').length;
      var batchVar = 'BATCH';
      var itemVar = 'ITEM';
      var rakeVar = 'RAKE';
      var recdVar = 'RECD';
      var data = "<tr><td class='tdthtablebordr'><input type='hidden' id='tempItemSave"+i+"' value=''><input type='checkbox' class='case' id='tblcheckrow"+i+"' onclick='checkcheckbox("+i+");'/></td>"+
                "<td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span><input type='hidden' class='rowCountCls' id='rowCount"+i+"' name='rowCount[]' value='"+i+"'></td>"+
                "<td class='tdthtablebordr' style='width: 1%;'><div><input list='batchList"+i+"' class='inputboxclr' id='batchNo"+i+"' name='batch_No[]' oninput='this.value = this.value.toUpperCase()' onchange='getItemAgainstBatch("+i+",\""+batchVar+"\");' autocomplete='off'/><datalist id='batchList"+i+"'><option value=''></option></datalist></div><input type='hidden' name='batchSlno[]' id='batchSlno"+i+"'></td>"+
                "<td class='tdthtablebordr' style='width: 10%;'><div><input list='itemList"+i+"' class='inputboxclr' id='Item_Code"+i+"' name='item_code[]' readonly oninput='this.value = this.value.toUpperCase()' autocomplete='off' onchange='getItemDetails("+i+",\""+itemVar+"\");'/><datalist id='itemList"+i+"'><option value=''> -- Select --</option></datalist></div></td>"+
                "<td class='tdthtablebordr' style='width: 15%;'><div><input type='text' class='inputboxclr' id='Item_name"+i+"' name='item_name[]' oninput='this.value = this.value.toUpperCase()' autocomplete='off' style='background-color: #eeeeee;' readonly /></div></td>"+
                "<td class='tdthtablebordr' style='width: 7%;'><input type='text' class='inputboxclr numberRight rakeQtyCl' id='rakeQty"+i+"' name='rake_Qty[]'   oninput='calcAQty("+i+",\""+rakeVar+"\");'/><input type='hidden' id='cFactor"+i+"' name='cFactor[]'></td>"+
                "<td class='tdthtablebordr' style='width: 4%;'><input type='text' class='inputboxclr' id='umCode"+i+"' name='umCode[]' oninput='this.value = this.value.toUpperCase()' style='background-color: #eeeeee;' readonly /></td>"+
                "<td class='tdthtablebordr' style='width: 7%;'><input type='text' class='inputboxclr numberRight rakeAQtyCl' id='rakeAQty"+i+"' name='rake_AQty[]' oninput='this.value = this.value.toUpperCase()' style='background-color: #eeeeee;' /></td>"+
                "<td class='tdthtablebordr' style='width: 4%;'><input list='aumList"+i+"' class='inputboxclr' id='aumCode"+i+"' name='aumCode[]' oninput='this.value = this.value.toUpperCase()' style='background-color: #eeeeee;'  /><datalist id='aumList"+i+"'><?php foreach ($aum_list as $key) { ?><option value='<?= $key->UM_CODE ?>' data-xyz='<?= $key->UM_CODE ?>'><?= $key->UM_CODE ?></option><?php } ?></datalist></td>"+
                "<td class='tdthtablebordr' style='width: 9%;'><input type='text' class='inputboxclr numberRight qtyRecdCl' id='qty_recd"+i+"' name='qty_recd[]' oninput='calcAQty("+i+",\""+recdVar+"\")' /></td>"+
                "<td class='tdthtablebordr' style='width: 8%;'><input type='text' class='inputboxclr numberRight aqtyRecdCl' id='qty_Arecd"+i+"' name='qty_Arecd[]' oninput='this.value = this.value.toUpperCase()' style='background-color: #eeeeee;' readonly /></td>"+
                "<td class='tdthtablebordr' style='width: 9%;'><div><input list='locationList"+i+"' class='inputboxclr' id='location_Code"+i+"' name='location_code[]' oninput='this.value = this.value.toUpperCase()' onchange='locationDetails("+i+")' /><datalist id='locationList"+i+"'></datalist></div></td>"+
                "<td class='tdthtablebordr' style='width: 15%;'><div><input type='text' class='inputboxclr' id='location_name"+i+"' name='location_name[]'   oninput='this.value = this.value.toUpperCase()' style='background-color: #eeeeee;' readonly /></div></td></tr>";

      $('table').append(data);

        var rakeNum = $("#rake_no").val();

        if(rakeNum==''){
          $('#rakeQty'+i).prop('readonly',false).css('background-color','#fff');
        }else{
          $('#rakeQty'+i).prop('readonly',true).css('background-color','#eeeeee');
        }

      /* ---------- USE AJAX ON ADD MORE FUCNTIONALITY ------------------- */

          var transport_Type = $("input[type='radio'][name='charge_type']:checked").val();
          var rakeNo         = $("#rake_no").val();
          var gtbatchNo      = $("#batchNo"+i).val();
          var slitBatch      = gtbatchNo.split('~');
          var batchNo        = slitBatch[0];
          var batchslno      = slitBatch[1];

          $.ajax({

          url:"{{ url('get-all-itemList') }}",
          method : "POST",
          type: "JSON",
          data: {rakeNo:rakeNo,transport_Type:transport_Type,batchNo:batchNo,batchslno:batchslno},

          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){


              if(data1.itemdata == ''){

              }else{

                $("#itemList"+slNo).empty();
                $.each(data1.itemdata, function(k, getData){

                  $("#itemList"+slNo).append($('<option>',{

                    value:getData.ITEM_CODE,

                    'data-xyz':getData.ITEM_NAME,
                    'text':getData.ITEM_NAME+' '+getData.LENGTH+'x'+getData.WIDTH+'x'+getData.HEIGHT

                  }));

                });

              }

              if(data1.BatchNoList == ''){

                }else{
                  
                  $("#batchList"+slNo).empty();

                    $.each(data1.BatchNoList, function(k, getData){

                      $("#batchList"+slNo).append($('<option>',{

                        value:getData.BATCH_NO+'~'+getData.SLNO,

                        'data-xyz':getData.BATCH_NO+'~'+getData.SLNO,
                        'text':getData.BATCH_NO+'-'+getData.ITEM_NAME+'-'+getData.QTY+'-'+getData.WAGON_NO

                      }));
  
                    });

                }/* rake data*/

            } /* success codn*/

          } /* success*/

        }); /* /. ajax*/

        vehicleDetails(i);

      /* ---------- USE AJAX ON ADD MORE FUCNTIONALITY ------------------- */

    i++;slNo++;});
  /* ----------- ADD MORE ROW FUNCTIONALITY --------------- */ 

    function locationDetails(slNo){

      var location_Code = $('#location_Code'+slNo).val();

      var xyz = $('#locationList'+slNo+' option').filter(function() {

        return this.value == location_Code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#location_Code'+slNo).val('');
        $('#location_name'+slNo).val('');
      }else{
        $('#location_name'+slNo).val(msg);
      }
    }

    function getItemAgainstBatch(slNo,fieldType){

        var transDate  = $('#transaction_date').val();
        var seriesCd   = $('#series_code').val();
        var vehicle_No = $('#vehicle_no').val();

        if(transDate && seriesCd && vehicle_No){
          $('#submitdata').prop('disabled',false);
        }else{
          $('#submitdata').prop('disabled',true);
        }

        var batch_no = $('#batchNo'+slNo).val();
        var rakeNo = $('#rake_no').val();
        $('#Item_Code'+slNo).prop('readonly',false);
        
        var transportType = $("input[type='radio'][name='charge_type']:checked").val();

        if(transportType == 'BY_RAKE'){

          var xyz = $('#batchList'+slNo+' option').filter(function() {

            return this.value == batch_no;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
            $('#batchNo'+slNo+',#Item_Code'+slNo+',#Item_name'+slNo+',#rakeQty'+slNo+',#umCode'+slNo+',#rakeAQty'+slNo+',#aumCode'+slNo+',#qty_recd'+slNo+',#qty_Arecd'+slNo+',#batchSlno'+slNo+'').val('');

          }else{
            $('#Item_Code'+slNo+',#Item_name'+slNo+',#rakeQty'+slNo+',#umCode'+slNo+',#rakeAQty'+slNo+',#aumCode'+slNo+',#qty_recd'+slNo+',#qty_Arecd'+slNo+',#batchSlno'+slNo+'').val('');
            var getBatchSlno = msg.split('~');
            var batchSlno = getBatchSlno[1];
            $('#batchSlno'+slNo).val(batchSlno);

          }

        }
        $('#batchNo'+slNo).css('border-color','#d4d4d4');
          var temItem = $('#tempItemSave'+slNo).val();
          var getSelData = $('#dublicateName').val(); 
          var slptData = getSelData.split(',');
          var index = slptData.indexOf(temItem);
          if (index > -1) { // only splice array when item is found
            slptData.splice(index, 1); // 2nd parameter means remove one item only
          }
          $('#dublicateName').val('');
          $('#dublicateName').val(slptData);

        $('#transaction_date,#series_code,#vehicle_no,#ulContractorCode,#rake_no,#trans_code').prop('readonly',true);
        $("input[name=trans_type]").prop("disabled",true);
        $("input[name=charge_type]").prop("disabled",true);

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        var getBatchNo = $('#batchNo'+slNo).val();
        var splitBatchNo = getBatchNo.split('~');
        var batchNo = splitBatchNo[0];
        var batchslno = splitBatchNo[1];
        var transport_Type = $("input[type='radio'][name='charge_type']:checked").val();

        $.ajax({

          url:"{{ url('get-all-itemList') }}",
          method : "POST",
          type: "JSON",
          data: {transport_Type:transport_Type,batchNo:batchNo,batchslno:batchslno,rakeNo:rakeNo},

          beforeSend: function() {
            console.log('start spinner');
            $('.modalspinner').removeClass('hideloaderOnModl');
          },
          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.itemdata == ''){

              }else{

                if(data1.itemdata.length == 1){
                  $('#Item_Code'+slNo).val(data1.itemdata[0].ITEM_CODE);

                }else{
                }

                if(batch_no && fieldType=='BATCH'){

                  $("#itemList"+slNo).empty();
                  $.each(data1.itemdata, function(k, getData){

                    $("#itemList"+slNo).append($('<option>',{

                      value:getData.ITEM_CODE,

                      'data-xyz':getData.ITEM_NAME,
                      'text':getData.ITEM_NAME+' '+getData.LENGTH+'x'+getData.WIDTH+'x'+getData.HEIGHT

                    }));

                  });

                }else{}

                getItemDetails(slNo,'ITEM');
                

                /*}else if(batch_no && fieldType=='ITEM' && rakeNo==''){

                  $('#umCode'+slNo).val(data1.data.UM);
                  $('#aumCode'+slNo).val(data1.data.AUM);
                  $('#cFactor'+slNo).val(data1.data.AUM_FACTOR);
                }else if(batch_no && fieldType=='ITEM' && rakeNo){

                  $('#rakeQty'+slNo).val(data1.data[0].QTY);
                  $('#rakeAQty'+slNo).val(data1.data[0].AQTY);
                  $('#umCode'+slNo).val(data1.data[0].UM);
                  $('#aumCode'+slNo).val(data1.data[0].AUM);
                  $('#cFactor'+slNo).val(data1.data[0].CFACTOR);

                }*/

              }

            } /* success codn*/

          }, /* success*/
          complete: function() {
            console.log('end spinner');
            $('.modalspinner').addClass('hideloaderOnModl');
          },

        }); /* /. ajax*/


    }

    function getItemDetails(slNo,fieldType){

      $('#fieldReqMsg').html('');

      var item_Code = $('#Item_Code'+slNo).val();

      var xyz = $('#itemList'+slNo+' option').filter(function() {

        return this.value == item_Code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){

        $('#umCode'+slNo).val('');
        $('#aumCode'+slNo).val('');
        $('#cFactor'+slNo).val('');
        $('#Item_name'+slNo).val('');
        $('#Item_Code'+slNo).val('');
        $('#rakeQty'+slNo).val('');
        $('#rakeAQty'+slNo).val('');
        $('#qty_recd'+slNo).val('');
        $('#qty_Arecd'+slNo).val('');

        var temItem = $('#tempItemSave'+slNo).val();
        var getSelData = $('#dublicateName').val(); 
        var slptData = getSelData.split(',');
        var index = slptData.indexOf(temItem);
        if (index > -1) { // only splice array when item is found
          slptData.splice(index, 1); // 2nd parameter means remove one item only
        }
        $('#dublicateName').val('');
        $('#dublicateName').val(slptData);
      }else{
        $('#umCode'+slNo).val('');
        $('#aumCode'+slNo).val('');
        $('#cFactor'+slNo).val('');
        $('#Item_name'+slNo).val('');
        $('#rakeQty'+slNo).val('');
        $('#rakeAQty'+slNo).val('');
        $('#qty_recd'+slNo).val('');
        $('#qty_Arecd'+slNo).val('');
        $('#Item_name'+slNo).val(msg);
      
      } /* /. match codn*/

      var ItemCode = $('#Item_Code'+slNo).val();
      var rakeNo   = $('#rake_no').val();
      var gtbatchNo  = $('#batchNo'+slNo).val();
      var slitBatchNo = gtbatchNo.split('~');
      var batchNo = slitBatchNo[0];
      var batchslno  = $('#batchSlno'+slNo).val();

      var checkDublicates = batchNo+'_'+batchslno+'_'+ItemCode;

     // console.log('batchNo',batchNo+' '+batchSlno);

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

          url:"{{ url('get-all-itemList') }}",
          method : "POST",
          type: "JSON",
          data: {ItemCode: ItemCode,rakeNo:rakeNo,batchNo:batchNo,batchslno:batchslno},

          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

             // console.log('data1.itemDetails',data1.itemDetails);
              if(data1.itemDetails == ''){

              }else{

                if(rakeNo){

                    console.log('data1.itemDetails.QTYRECD',data1.itemDetails.QTYRECD);
                    console.log('data1.itemDetails.QTY',data1.itemDetails.QTY);

                 // var balQty = parseFloat(data1.itemDetails.QTY) - parseFloat(data1.itemDetails.QTYRECD);

                 var balQty = parseFloat(data1.itemDetails.QTY);

                  var aRecdQty = parseFloat(balQty) / parseFloat(data1.itemDetails.CFACTOR);

                  $('#rakeQty'+slNo).val(data1.itemDetails.QTY);
                  $('#rakeAQty'+slNo).val(data1.itemDetails.AQTY);
                  $('#qty_recd'+slNo).val(balQty.toFixed(3));
                  $('#qty_Arecd'+slNo).val(aRecdQty.toFixed(3));
                  $('#umCode'+slNo).val(data1.itemDetails.UM);
                  $('#aumCode'+slNo).val(data1.itemDetails.AUM);
                  $('#cFactor'+slNo).val(data1.itemDetails.CFACTOR);

                }else{

                  $('#umCode'+slNo).val(data1.itemDetails.UM);
                  $('#aumCode'+slNo).val(data1.itemDetails.AUM);
                  $('#cFactor'+slNo).val(data1.itemDetails.AUM_FACTOR);

                }

                totalQtyCalculation();

                var existVal = $("#dublicateName").val();

                if(existVal == ''){
                  $("#dublicateName").val(checkDublicates);
                  $("#tempItemSave"+slNo).val(checkDublicates);
                }else{
                  var blnkAry = [];
                  var existGet = $("#dublicateName").val();

                  if (existGet.indexOf(',') != -1) {

                    var segments = existGet.split(',');

                    for(var i=0;i<segments.length;i++){
                      blnkAry.push(segments[i]);
                    }

                    var checkDub = blnkAry.includes(checkDublicates);

                    if(checkDub == true){
                      $('#showDubDataMsg').html('Dublicate Details');
                      
                      $('#batchSlno'+slNo).val('');
                      $('#batchNo'+slNo).val('');
                      $('#Item_name'+slNo).val('');
                      $('#Item_Code'+slNo).val('');
                      $('#rakeQty'+slNo).val('');
                      $('#umCode'+slNo).val('');
                      $('#rakeAQty'+slNo).val('');
                      $('#aumCode'+slNo).val('');
                      $('#qty_recd'+slNo).val('');
                      $('#qty_Arecd'+slNo).val('');
                      $('#location_Code'+slNo).val('');
                      $('#location_name'+slNo).val('');
                      totalQtyCalculation();
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
                      $('#batchNo'+slNo).val('');
                      $('#batchSlno'+slNo).val('');
                      $('#Item_name'+slNo).val('');
                      $('#Item_Code'+slNo).val('');
                      $('#rakeQty'+slNo).val('');
                      $('#umCode'+slNo).val('');
                      $('#rakeAQty'+slNo).val('');
                      $('#aumCode'+slNo).val('');
                      $('#qty_recd'+slNo).val('');
                      $('#qty_Arecd'+slNo).val('');
                      $('#location_Code'+slNo).val('');
                      $('#location_name'+slNo).val('');
                      totalQtyCalculation();
                    }else if(checkDub1 == false){
                      $('#showDubDataMsg').html('');
                      var getPrevVal1 = $("#dublicateName").val();
                      $("#dublicateName").val(getPrevVal1+','+checkDublicates);
                      $("#tempItemSave"+slNo).val(checkDublicates);                              
                    }

                  }
                }

              }

            } /* success codn*/

          } /* success*/

        }); /* /. ajax*/

    }/* /. main function*/

    function totalQtyCalculation(){

      var totqty = 0;

      $(".rakeQtyCl").each(function () {
        
          if (!isNaN(this.value) && this.value.length != 0) {
              totqty += parseFloat(this.value);
          }

        $("#total_rakeQty").val(totqty.toFixed(3));

      });

      var totAqty = 0;

      $(".rakeAQtyCl").each(function () {
        
          if (!isNaN(this.value) && this.value.length != 0) {
              totAqty += parseFloat(this.value);
          }

        $("#total_rakeAQty").val(totAqty.toFixed(3));

      });

      var totrecd = 0;

      $(".qtyRecdCl").each(function () {
        
          if (!isNaN(this.value) && this.value.length != 0) {
              totrecd += parseFloat(this.value);
          }

        $("#total_recdQty").val(totrecd.toFixed(3));

      });

      var totArecd = 0;

      $(".aqtyRecdCl").each(function () {
        
          if (!isNaN(this.value) && this.value.length != 0) {
              totArecd += parseFloat(this.value);
          }

        $("#total_recdAqty").val(totArecd.toFixed(3));

      });

    }/* /. total*/

    function calcAQty(slno,QtyType){
      $('#fieldReqMsg').html('');
      if(QtyType == 'RAKE'){

        var cFactor = parseFloat($('#cFactor'+slno).val());
        var rakeQty = parseFloat($('#rakeQty'+slno).val());

        var rakeAQty = rakeQty / cFactor;
        $('#rakeAQty'+slno).val(rakeAQty.toFixed(3));

        var totqty = 0;

        $(".rakeQtyCl").each(function () {
          
            if (!isNaN(this.value) && this.value.length != 0) {

                totqty += parseFloat(this.value);

            }

          $("#total_rakeQty").val(totqty.toFixed(3));

        });

        var totAqty = 0;

        $(".rakeAQtyCl").each(function () {
          
            if (!isNaN(this.value) && this.value.length != 0) {

                totAqty += parseFloat(this.value);

            }

          $("#total_rakeAQty").val(totAqty.toFixed(3));

        });

      }

      if(QtyType == 'RECD'){

        var cFactorRecd = parseFloat($('#cFactor'+slno).val());
        var recdQty = parseFloat($('#qty_recd'+slno).val());
        var rake_Qty = parseFloat($('#rakeQty'+slno).val());

        var recdAQty = recdQty / cFactorRecd;
        $('#qty_Arecd'+slno).val(recdAQty.toFixed(3));

        var tot_qty = 0;

        $(".qtyRecdCl").each(function () {
          
            if (!isNaN(this.value) && this.value.length != 0) {
                tot_qty += parseFloat(this.value);
            }

          $("#total_recdQty").val(tot_qty.toFixed(3));

        });

        var tot_Aqty = 0;

        $(".aqtyRecdCl").each(function () {
          
            if (!isNaN(this.value) && this.value.length != 0) {
                tot_Aqty += parseFloat(this.value);
            }

          $("#total_recdAqty").val(tot_Aqty.toFixed(3));

        });

      }
      

    }

    function vehicleDetails(srNo){

      //console.log('srNo',srNo);

      var vehicleNo = $("#vehicle_no").val();

      var xyz = $('#vehicleList option').filter(function() {

          return this.value == vehicleNo;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $("#gateEntryTblId,#plant_code,#plant_name,#pfct_code,#pfct_name,#vehicle_no,#gateEntryVrno").val('');
        $("#locationList"+srNo).empty();
      }else{
        $("#gateEntryTblId,#plant_code,#plant_name,#pfct_code,#pfct_name,#gateEntryVrno").val('');
        $("#locationList"+srNo).empty();

        var vehicleSplit = msg.split('~');
        $('#gateEntryTblId').val(vehicleSplit[1]); 

      }
      if(srNo == 1){

        fieldValidation();
      }

      var vehicleNum = $("#vehicle_no").val();
      var splitData = vehicleNum.split('~');
      var vehicle_No = splitData[0];
      var gateEntryTblId = splitData[1];

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

        $.ajax({

              url:"{{ url('get-vehicle-details-against-vehicle') }}",

              method : "POST",

              type: "JSON",

              data: {vehicle_No: vehicle_No,gateEntryTblId:gateEntryTblId},

              success:function(data){

                    var data1 = JSON.parse(data);

                    if (data1.response == 'error') {
                          
                        $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Data Not Found...!</p>");

                    }else if(data1.response == 'success'){
                        
                        if(data1.data == ''){

                        }else{
                          $("#gateEntryVrno").val(data1.data[0].VRNO);
                          $("#plant_code").val(data1.data[0].PLANT_CODE);
                          $("#plant_name").val(data1.data[0].PLANT_NAME);
                          $("#pfct_code").val(data1.data[0].PFCT_CODE);
                          $("#pfct_name").val(data1.data[0].PFCT_NAME);
                        }

                        if(data1.data_storage_location == ''){

                        }else{

                          $("#locationList"+srNo).empty();
                          $.each(data1.data_storage_location, function(k, getData){

                            $("#locationList"+srNo).append($('<option>',{

                              value:getData.LOCATION_CODE,

                              'data-xyz':getData.LOCATION_NAME,
                              'text':getData.LOCATION_NAME

                            }));

                          });

                        }
                                                 
                    }
              }

        });

  }

  function getDetailOfRackNo(){


      var rakeNum = $("#rake_no").val();

      var xyz = $('#rakeNoList option').filter(function() {

          return this.value == rakeNum;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $("#rake_no").val('');
        $("#batchList1").empty();
        $('#rakeQty1').prop('readonly',false).css('background-color','#fff');
      }else{
        $("#batchList1").empty();
        $('#rakeQty1').prop('readonly',true).css('background-color','#eeeeee');
      }

      fieldValidation();

    var rackNo = $('#rake_no').val();

    $.ajaxSetup({

        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $.ajax({

          url:"{{ url('get-vehicle-details-against-vehicle') }}",

          method : "POST",

          type: "JSON",

          data: {rackNo: rackNo},

          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {
                  
                $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Data Not Found...!</p>");

            }else if(data1.response == 'success'){

              if(data1.data_rackNum == ''){

              }else{

                if(data1.data_rackNum == ''){

                }else{
                  
                  $("#batchList1").empty();

                    $.each(data1.data_rackNum, function(k, getData){

                      $("#batchList1").append($('<option>',{

                        value:getData.BATCH_NO+'~'+getData.SLNO,

                        'data-xyz':getData.BATCH_NO+'~'+getData.SLNO,
                        'text':getData.BATCH_NO+'-'+getData.SLNO+'-'+getData.ITEM_NAME+'-'+getData.QTY+'-'+getData.WAGON_NO

                      }));

                    });

                }/* rake data*/

              }

            }/* /. success codn*/

          }/* /. success function*/

    }); /* /. ajax function*/


  }
  
</script>

 <script>

      $(function () {

        //Initialize Select2 Elements

        $(".select2").select2();

        //Datemask dd/mm/yyyy

        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});

        //Datemask2 mm/dd/yyyy

        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});

        //Money Euro

        $("[data-mask]").inputmask();

      });

 </script>



<script type="text/javascript">

  $(document).ready(function(){

    $('.transType').on('click',function(){

      var transType = $(this).val();
      if(transType == 'SELF'){
        $('#trans_code').prop('readonly',true);
        $('#transporterType').val(transType);
      }else if(transType == 'MARKET'){
         $('#trans_code').prop('readonly',false);
         $('#transporterType').val(transType);
      }

    });

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

        fieldValidation();

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({

          url:"{{ url('get-all-itemList') }}",
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

              if(data1.itemdata==''){

              }else{

                $("#itemList1").empty();

                $.each(data1.itemdata, function(k, getItem){

                  $("#itemList1").append($('<option>',{

                    value:getItem.ITEM_CODE,

                    'data-xyz':getItem.ITEM_NAME,
                    text:getItem.ITEM_NAME

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

    $("#trans_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#transList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $('#trans_name').val('');
        }else{
           $('#trans_name').val(msg);
        }

    });

    $("#ulContractorCode").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#contractorList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $(this).val('');
        $('#ulContractor_name').val('');
      }else{
        $('#ulContractor_name').val(msg);
      }

    });

  })

  function checkcheckbox(checkid){
    
      var getbatchNo = $('#batchNo'+checkid).val();
      var splitBatch = getbatchNo.split('~');
      var fiedlOne = splitBatch[0];
      var fieldTwo = $('#batchSlno'+checkid).val();
      var fieldThree = $('#Item_Code'+checkid).val();

      var dublicateName = fiedlOne+'_'+fieldTwo+'_'+fieldThree;
          
      if($('#tblcheckrow'+checkid).is(':checked')) {

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

    $( window ).on( "load", function() {

      var fromdateintrans = $('#FromDateFy').val();
      var todateintrans = $('#ToDateFy').val();

      $('.transdatepicker').datepicker({

        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        startDate :fromdateintrans,
        endDate : 'today',
        autoclose: 'true'
      });

      $('.invoiceDate').datepicker({

        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        startDate :fromdateintrans,
        endDate : 'today',
        autoclose: 'true'
      });

      $('.orderDate').datepicker({

        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        startDate :fromdateintrans,
        endDate : todateintrans,
        autoclose: 'true'
      });

    });

  });

</script>

<script type="text/javascript">
  
  $(document).ready(function() {

    $('input:text:first').focus();
     
    $('input:text').bind("keydown", function(e) {

      var n = $("input:text").length;

      if (e.which == 13){ 

        //Enter key

        e.preventDefault(); //Skip default behavior of the enter key

        var nextIndex = $('input:text').index(this) + 1;
        if(nextIndex < n)
          $('input:text')[nextIndex].focus();
        else
        {
          $('input:text')[nextIndex-1].blur();
          
        }
      }
    });
   
  });

  function fieldValidation(){

      var transDate     = $('#transaction_date').val();
      var seriesCd      = $('#series_code').val();
      var vehicleNo     = $('#vehicle_no').val();
      var rakeNo        = $('#rake_no').val();
      var custCode      = $('#customer_code').val();
      var invoiceNo     = $('#invoice_no').val();
      var invoiceDate   = $('#invoice_date').val();
      var orderNo       = $('#order_no').val();
      var orderDate     = $('#order_date').val();
      var transportType = $("input[type='radio'][name='charge_type']:checked").val();

      if(transDate){
        $('#transaction_date').css('border-color','#d4d4d4');
        if(seriesCd){
          $('#series_code').css('border-color','#d4d4d4');
          if(vehicleNo){
            $('#vehicle_no').css('border-color','#d4d4d4');
            if(transportType == 'BY_RAKE'){
              if(rakeNo){
                $('#rake_no').css('border-color','#d4d4d4');
              }else{
                $('#rake_no').css('border-color','#ff0000').focus();
              }
            }else if(transportType == 'BY_ROAD'){
              $('#rake_no').css('border-color','#d4d4d4');
              if(custCode){
                $('#customer_code').css('border-color','#d4d4d4');
                if(invoiceNo){
                  $('#invoice_no').css('border-color','#d4d4d4');
                  if(invoiceDate){
                    $('#invoice_date').css('border-color','#d4d4d4');
                    if(orderNo){
                      $('#order_no').css('border-color','#d4d4d4');
                      if(orderDate){
                        $('#order_date').css('border-color','#d4d4d4');
                      }else{
                        $('#order_date').css('border-color','#ff0000').focus();
                      }
                    }else{
                      $('#order_no').css('border-color','#ff0000').focus();
                    }
                  }else{
                    $('#invoice_date').css('border-color','#ff0000').focus();
                  }
                }else{
                  $('#invoice_no').css('border-color','#ff0000').focus();
                }
              }else{
                $('#customer_code').css('border-color','#ff0000').focus();
              }
            }
          }else{
            $('#vehicle_no').css('border-color','#ff0000').focus();
          }
        }else{
          $('#series_code').css('border-color','#ff0000').focus();
        }
      }else{
        $('#transaction_date').css('border-color','#ff0000').focus();
      }

      if(transDate && seriesCd && vehicleNo){
        if(transportType == 'BY_RAKE' && rakeNo){
          $('#batchNo1').prop('readonly',false).css('border-color','#ff0000').focus();
        }else if(transportType == 'BY_ROAD' && custCode && invoiceNo && invoiceDate && orderNo && orderDate){
          $('#batchNo1').prop('readonly',false).css('border-color','#ff0000').focus();
        }else{
          $('#batchNo1').prop('readonly',true);
        }
      }else{
        $('#batchNo1').prop('readonly',true);
      }
  }

/* --------------- START : SUBMIT DATA ------------ */

  function submitInwardTrans(pdfFlag){

    var valuebatchNo   =[];
    var valueitem_code =[];
    var valueqty_recd  =[];
    var valueqty_rake  =[];
    var rowIDget=[];

    $(".rowCountCls").each(function () {
        
         rowIDget.push(this.value);

    });

    for(var y=0;y<rowIDget.length;y++){

      var colIdSlno = rowIDget[y];
     //console.log('colIdSlno',colIdSlno);
      var batch_No = $('#batchNo'+colIdSlno).val();
      var itemcode = $('#Item_Code'+colIdSlno).val();
      var qtyRecd  = $('#qty_recd'+colIdSlno).val();
      var rakeQty  = $('#rakeQty'+colIdSlno).val();

      valuebatchNo.push(batch_No);
      valueitem_code.push(itemcode);
      valueqty_recd.push(qtyRecd);
      valueqty_rake.push(rakeQty);
    }
    
    var found_batchNo = valuebatchNo.find(function (batch_No) {
      return batch_No == '';
    });

    var found_itemCd = valueitem_code.find(function (item_cd) {
      return item_cd == '';
    });

    var found_qtyRecd = valueqty_recd.find(function (qtyRecd) {
      return qtyRecd == '';
    });

    var found_rakeQty = valueqty_rake.find(function (qtyrake) {
      return qtyrake == '';
    });

    if(found_batchNo == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_itemCd == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_qtyRecd == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else if(found_rakeQty == ''){
      $('#fieldReqMsg').html("Please Select Data In Above Row Otherwise Delete The Row.");
    }else{
      $('#fieldReqMsg').html("");
        var data = $("#inwardTran").serialize();

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/transaction/CandF/inward-trans-submit') }}",

            data: data, // here $(this) refers to the ajax object not form
            success: function (data) {
                
              var data1 = JSON.parse(data);
              if(data1.response == 'error') {

                var responseVar = false;
                var url = "{{url('candf/inward-tran/save-msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });

              }else{

                var responseVar = true;
                var url = "{{url('candf/inward-tran/save-msg')}}";
                setTimeout(function(){ window.location = url+'/'+responseVar; });
                
              }/* /. condition*/

            },/* /. success function*/

        }); /* /. ajax*/

    }/* /. codn*/

  }/* /. main function */

/* --------------- END : SUBMIT DATA ------------ */

</script>

@endsection