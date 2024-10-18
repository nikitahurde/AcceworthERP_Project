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
  .table>tbody>tr>td, .table>tbody>tr>th, .table>thead>tr>td, .table>thead>tr>th {

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
  .btnAllStyle{
      padding: 4px;
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
  .readField{
    background-color: #eeeeee;
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

                <a href="{{ url('/Transaction/ColdStorage/View-Bilty-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Bilty.</a>

              </div>

            </div><!-- /.box-header -->

            <div class="box-body">

              <div class="overlay-spinner hideloader"></div>
              
                <div class="col-md-12">

                <div class="row">

                  <div class="col-md-5 firstBlock">

                  <div class="modalspinner hideloaderOnModl"></div>

                    <div class="row">

                      <div class="col-md-6">

                        <div class="form-group">

                          <label> Vehicle No : <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              <input list="vehicleNoList" class="form-control" name="vehicle_no" value="" id="vehicleNo" placeholder="Enter Vehicle No" autocomplete="off" onchange="getinwardStorageData();">

                              <datalist id="vehicleNoList">
                          
                                <?php foreach ($vehicleNolist as $key) { ?>

                                  <option value="<?= $key->VEHICLE_NO; ?>" data-xyz="<?= $key->VEHICLE_NO; ?>"><?= $key->VEHICLE_NO; ?></option>
                               <?php } ?>

                              </datalist>

                            </div>

                        </div>
                            <!-- /.form-group -->
                      </div><!-- /.col -->

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

                          <label>Customer Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="accList"  id="acc_code" name="acc_code" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Customer Code" readonly> 

                            </div>

                        </div><!-- /.form-group -->

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

                        <div class="col-md-3">

                          <div class="form-group">

                            <label> Series Name : <span class="required-field"></span></label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                <input type="text" class="form-control" name="series_name" value="{{$seriesName}}" id="series_name" placeholder="Enter Series Name" readonly autocomplete="off">

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

                        <div class="col-md-3">

                          <div class="form-group">

                            <label> Quantity : </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input type="text" class="form-control numberRight" name="qty" value="" id="qty" placeholder="Enter Quantity" value="" readonly autocomplete="off">

                              </div>

                          </div>
                          
                        </div><!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label> UM : </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input type="text" class="form-control" name="item_um" value="" id="item_um" placeholder="Enter UM" value="" autocomplete="off" readonly>

                              </div>
                          </div>
                          
                        </div><!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label> A Quantity : </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input type="text" class="form-control numberRight" name="a_qty" value="" id="a_qty" placeholder="Enter A Quantity" value="" autocomplete="off" readonly>

                              </div>
                          </div>
                          
                        </div><!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label> AUM : </label>

                              <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                </div>

                                <input type="text" class="form-control" name="item_aum" value="" id="item_aum" placeholder="Enter AUM" value="" autocomplete="off" readonly>

                              </div>
                          </div>
                          
                        </div><!-- /.col -->
                        
                      </div><!-- /.row -->

                      <div class="row">

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>Rate Per Month : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text"  id="ratePerMonth" name="ratePerMonth" class="form-control  pull-left numberRight" value="" autocomplete="off" placeholder="Enter Rate Per Month"> 

                            
                            </div>

                          </div><!-- /.form-group -->

                        </div><!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>Rate Per Month UM : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text"  id="rent_um" name="rent_um" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Rate Per Month UM" readonly> 

                            
                            </div>

                          </div><!-- /.form-group -->

                        </div><!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>Market Rate : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text"  id="market_rate" name="market_rate" class="form-control  pull-left numberRight" value="" autocomplete="off" placeholder="Enter Market Per"> 

                            
                            </div>

                          </div><!-- /.form-group -->

                        </div><!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>Market Rate UM : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text"  id="marketRateUm" name="marketRateUm" class="form-control  pull-left" value="" autocomplete="off" placeholder="Enter Market Rate UM" readonly> 
                            
                            </div>

                          </div><!-- /.form-group -->

                        </div><!-- /.col -->
                        
                      </div><!-- /.row -->

                      <div class="row">

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>Market Value : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text"  id="market_value" name="market_value" class="form-control pull-left numberRight" value="" autocomplete="off" placeholder="Enter Market Value" readonly> 
                            
                            </div>

                          </div><!-- /.form-group -->

                        </div><!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>Reciept Valid Till : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text"  id="validTill_date" name="valid_date" class="form-control  pull-left transdatepicker" value="" autocomplete="off" placeholder="Select Reciept Valid Date">
                            
                            </div>  
                            <small id="validtillDtMsg" style="color:red;"></small>
                          </div><!-- /.form-group -->

                        </div><!-- /.col -->
                          
                      </div><!-- row -->

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

                              <input type="text" class="form-control Number" name="stack_number" value="" id="stack_number" placeholder="Enter Stack Number" autocomplete="off" autocomplete="off">

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

                                <input type="text" id="class_quality" name="class_quality" class="form-control  pull-left" value="" placeholder="Enter Class Standard Of Quality" autocomplete="off" style="text-align: end;">

                              </div>

                          </div>
                             
                        </div><!-- col -->

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>Identification Mark: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              
                                <input type="text" class="form-control" name="identity_mark" id="identity_mark" value="" placeholder="Enter Identification Mark" autocomplete="off">

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
                            
                              <input type="text" class="form-control" name="Remark" id="Remark" value="" placeholder="Select Remark" autocomplete="off">

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
            
              </div><!-- /.box-body -->

          </div><!-- /.custom -->

        </div><!-- /.col -->

      </div><!-- /.row -->

    </section><!-- /.section -->

    <section class="content"  style="margin-top: -10%;">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-body">

              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbleBodydata">

                </table><!-- /.table -->

              </div><!-- /.table-responsive -->

              <div class="row">

                <div class="col-md-12" style="text-align: center;">
                  <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
                  <button class="btn btn-success" type="button" id="submitdata" onclick="submitBiltyTrans(0)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                  <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

                  <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitBiltyTrans(1)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button>
                </div>

              </div><!-- /.row -->

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
  $( window ).on( "load", function() {

    getvrnoBySeries();
    fieldValidation();

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

  $(document).ready(function(){

    $('#validTill_date').on('change',function(){
        fieldValidation();
    });

    $('#Remark').on('change',function(){
        fieldValidation();
    });

    $('#bilty_date').on('change',function(){
      var transDate     = $('#bilty_date').val();
      var slipD         =  transDate.split('-');
      var Tdate         = slipD[0];
      var Tmonth        = slipD[1];
      var Tyear         = slipD[2];
      var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;
          
      var selectedDate = new Date(getproperDate);
      var todayDate = new Date();

      if(transDate){
        $('#err_datemsg').html('');
      }else{
        $('#err_datemsg').html('The Date field is required.');
      }
        
      if(selectedDate > todayDate){
        $('#showmsgfordate').html('Transaction Date Can Not Be Greater Than Today').css('color','red');
        $('#bilty_date').val('');
        return false;

      }else{
        $('#showmsgfordate').html('');
        var tr_Date = $('#bilty_date').val();
        return true;
      }

    });

    $('#validTill_date').on('change',function(){
        
        var chargeVal = $('input[name="charge_type"]:checked').val();
        var slip_no   = $("#slip_no").val();
        var plant_cd  = $("#plant_code").val();

        if(chargeVal == 'FIXED'){

          var validtillDate = $('#validTill_date').val();
          var biltyDate     = $('#bilty_date').val();

          if(validtillDate < biltyDate){
            $('#validtillDtMsg').html('Please select Greater Than Bilty Date');
            $('#validTill_date').val('');
          }else{
            $('#validtillDtMsg').html('');
          }

        }else{

        }

    });

  });

  function fieldValidation(){

    var vehicleNo  = $('#vehicleNo').val();
    var seriesCode = $('#series_code').val();
    var raterMonth = $('#ratePerMonth').val();
    var marketRate = $('#market_rate').val();
    var validDate  = $('#validTill_date').val();
    var remark     = $('#Remark').val();

    if(vehicleNo){
      $('#vehicleNo').css('border-color','#d4d4d4');
      if(seriesCode){
        $('#series_code').css('border-color','#d4d4d4');
        if(validDate){
          $('#validTill_date').css('border-color','#d4d4d4');
          if(remark){
            $('#Remark').css('border-color','#d4d4d4');
          }else{
            $('#Remark').css('border-color','#ff0000').focus();
          }
        }else{
          $('#validTill_date').css('border-color','#ff0000').focus();
        }
      }else{
        $('#series_code').css('border-color','#ff0000').focus();
      }
    }else{
      $('#vehicleNo').css('border-color','#ff0000').focus();
    }
  }

  function getvrnoBySeries(){

    var seriesCd =  $('#series_code').val();
    var xyz = $('#seriesList option').filter(function() {

      return this.value == seriesCd;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $('#series_code').val('');
      $('#series_name').val('');
      $('#vrseqnum').val('');
    }else{
       $('#vrseqnum').val('');
      $('#series_name').val(msg);
    }
    fieldValidation();
    var seriesCode = $('#series_code').val(); 
    var transcode = $('#transcode').val();

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

              }

          }

    });

  }

  function getinwardStorageData(){

    var vehicle_No    = $("#vehicleNo").val();
    var biltyDate     = $('#bilty_date').val();
    var splitDate     = biltyDate.split('-');
    var getproperDate = splitDate[1]+'-'+splitDate[0]+'-'+splitDate[2];
    var chargeVal     = $('input[name="charge_type"]:checked').val();
    fieldValidation();
      $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $.ajax({

            url:"{{ url('get-inward-data-by-acc-code') }}",

            method : "POST",

            type: "JSON",

            data: {vehicle_No : vehicle_No,chargeVal:chargeVal},

            beforeSend: function() {
              console.log('start spinner');
              $('.modalspinner').removeClass('hideloaderOnModl');
            },

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                    if(data1.data == ''){
                      
                      $('#item_code').val('');
                      $('#qty').val('');
                      $('#inward_date').val('');
                      $('#acc_code').val('');
                    }else{

                      $('#plant_code').val(data1.data[0].PLANT_CODE);
                      $('#plant_name').val(data1.data[0].PLANT_NAME);
                      $('#pfct_code').val(data1.data[0].PFCT_CODE);
                      $('#pfct_name').val(data1.data[0].PFCT_NAME);
                      $('#acc_code').val(data1.data[0].ACC_CODE);
                      $('#acc_name').val(data1.data[0].ACC_NAME);
                      $('#item_code').val(data1.data[0].ITEM_CODE);
                      $('#item_name').val(data1.data[0].ITEM_NAME);
                      $('#packing_code').val(data1.data[0].PACKING_CODE);
                      $('#packing_name').val(data1.data[0].PACKING_NAME);
                      $('#qty').val(data1.data[0].QTY);
                      $('#item_um').val(data1.data[0].UM_CODE);
                      $('#a_qty').val(data1.data[0].WEIGHT);
                      $('#item_aum').val(data1.data[0].AUM_CODE);
                      $('#rent_um').val(data1.data[0].UM_CODE);
                      $('#marketRateUm').val(data1.data[0].AUM_CODE);
                      $('#driver_name').val(data1.data[0].DRIVER_NAME);
                      $('#driver_id').val(data1.data[0].DRIVER_IDCARD);
                      $('#mobile_number').val(data1.data[0].DRIVER_CONTACT_NO);
                      $('#vehicleType').val(data1.data[0].VEHICLE_TYPE);
                      $('#prodCondtn').val(data1.data[0].PROD_CONDITION);
                      $("input[name=prod_cond][value='"+data1.data[0].PROD_CONDITION+"']").prop("checked",true);
                      $("input[name=prod_cond]").prop("disabled",true);
                      $("input[name=vehicle_type][value='"+data1.data[0].VEHICLE_TYPE+"']").prop("checked",true);
                      $("input[name=vehicle_type]").prop("disabled",true);
                      var inwardDt     = data1.data[0].VRDATE;
                      var splitDt      = inwardDt.split('-');
                      var inwardFromDt = splitDt[2]+'-'+splitDt[1]+'-'+splitDt[0];
                      $('#inward_date').val(inwardFromDt);

                      /* ---------- head column ---------- */

                      var headData = "<th style='width: 10px;'> Sr.No.</th><th>Cold Storage</th><th>Chamber</th><th>Floor</th><th>Block</th><th>Quantity</th><th>UM</th>";

                      $('#tbleBodydata').append(headData);

                      /* ---------- head column ---------- */

                      var slnoB = 1,totalQty=0;
                      $.each(data1.data, function(k, getData){

                         totalQty += parseFloat(getData.QUANTITY);

                        var bodyData = "<tr><td class='tdthtablebordr'><span id='snum'>"+slnoB+".</span><input type='hidden' name='totlRwCount[]' value='"+slnoB+"' id='totlCountRw"+slnoB+"'></td>"+
                        "<td class='tdthtablebordr' style='width: 20%;'><div><input type='text' class='inputboxclr readField' id='cold_Storage"+slnoB+"' name='cold_Storage[]'   oninput='this.value = this.value.toUpperCase()' value='"+getData.CS_CODE+"[ "+getData.CS_NAME+" ]' readonly autocomplete='off'/></div></td>"+
                        "<td class='tdthtablebordr' style='width: 20%;'><div><input type='text' class='inputboxclr readField' id='chamber_code"+slnoB+"' name='chamber_code[]'   oninput='this.value = this.value.toUpperCase()' value='"+getData.CHAMBER_CODE+"[ "+getData.CHAMBER_NAME+" ]' readonly autocomplete='off'/></div></td>"+
                        "<td class='tdthtablebordr' style='width: 20%;'><div><input type='text' class='inputboxclr readField' id='floor_code"+slnoB+"' name='floor_code[]'   oninput='this.value = this.value.toUpperCase()' value='"+getData.FLOOR_CODE+"[ "+getData.FLOOR_NAME+" ]' readonly autocomplete='off'/></div></td>"+
                        "<td class='tdthtablebordr'style='width: 20%;'><div><input type='text' class='inputboxclr readField' id='block_code"+slnoB+"' name='block_code[]'   oninput='this.value = this.value.toUpperCase()' value='"+getData.BLOCK_CODE+"[ "+getData.BLOCK_NAME+" ]' readonly autocomplete='off'/></div></td>"+
                        "<td class='tdthtablebordr' style='width: 15%;'><input type='text' class='inputboxclr readField' id='qunatity"+slnoB+"' name='qunatity[]'   oninput='this.value = this.value.toUpperCase()' style='text-align: end;' value='"+getData.QUANTITY+"' readonly autocomplete='off'/></td>"+
                        "<td class='tdthtablebordr' style='width: 5%;'><input type='text' class='inputboxclr readField' id='umCode"+slnoB+"' name='umCode[]'   oninput='this.value = this.value.toUpperCase()' value='"+getData.UM+"' readonly autocomplete='off'/></td></tr>";

                        $('#tbleBodydata').append(bodyData);

                      slnoB++
                      });/* each loop*/

                      var footerData = "<tfoot><td style='border-color: #fff;border-right: 1px solid #fff !important;'>&nbsp;</td><td style='width: 20%;border-color: #fff;border-right: 1px solid #fff !important;'>&nbsp;</td><td style='width: 20%;border-color: #fff;border-right: 1px solid #fff !important;'>&nbsp;</td><td style='width: 20%;border-color: #fff;border-right: 1px solid #fff !important;'>&nbsp;</td><td style='width: 20%;border-color: #fff;border-right: 1px solid #fff !important;text-align: end;padding-top: 1px;'><small style='font-size: 14px;font-weight: 800;'>Total : </small></td><td style='width: 15%;border-color: #fff;border-right: 1px solid #fff !important;padding-top: 2px;'><input type='text' class='inputboxclr readField' style='text-align: end;' value='"+totalQty+"' readonly autocomplete='off'></td><td style='width: 5%;border-color: #fff;border-right: 1px solid #fff !important;'>&nbsp;</td></tfoot>";

                      $('#tbleBodydata').append(footerData);
                      
                    }

                    if(chargeVal == 'PER_UNIT_PER_MONTH'){

                        if(data1.dataMasterRate == '' || data1.dataMasterRate == null){

                          if(data1.itemBalRate == '' || data1.itemBalRate == null){
                            $('#market_rate').val('0');
                          }else{
                            $('#market_rate').val('');
                            $('#market_rate').val(data1.dataitemBalRate.STDRATE);
                          }

                          if(data1.dataAccItemRate == '' || data1.dataAccItemRate == null){
                            $('#ratePerMonth').val('0');
                          }else{
                            $('#ratePerMonth').val('');
                            $('#ratePerMonth').val(data1.dataAccItemRate.IP_RATE);
                          }

                        }else{

                          var minQtyOne = parseFloat(data1.dataMasterRate.MIN_QTY1);
                          var minQtyTwo = parseFloat(data1.dataMasterRate.MIN_QTY2);
                          var quantity  = parseFloat($('#qty').val());
                          $('#ratePerMonth').val('');
                          $('#ratePerMonth').val(data1.dataMasterRate.RATE);

                          if((quantity < minQtyOne) && (quantity < minQtyTwo)){

                            $('#market_rate').val('');
                            $('#market_rate').val(data1.dataMasterRate.MIN_RATE1);

                          }else if((quantity >= minQtyOne) && (quantity < minQtyTwo)){

                            $('#market_rate').val('');
                            $('#market_rate').val(data1.dataMasterRate.MIN_RATE1);
                            
                          }else if((quantity >= minQtyOne && (quantity >= minQtyTwo))){

                            $('#market_rate').val('');
                            $('#market_rate').val(data1.dataMasterRate.MIN_RATE2);

                          }

                          var dueDays  = parseInt(data1.dataMasterRate.NO_DAYS);

                          var getduedate = new Date(getproperDate);
                          getduedate.setDate(getduedate.getDate() + dueDays); 
                          var getdate = getduedate.getDate();
                          var getMonth=getduedate.getMonth()+1;
                          var getYear = getduedate.getFullYear();
                          var duedate1 =getYear+'-'+getMonth+'-'+getdate;

                          var dval = new Date(duedate1);
                          var moval = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(dval);
                          var da_val = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(dval);

                          var duedate =da_val+'-'+moval+'-'+getYear;
                          $('#validTill_date').val(duedate);

                        }

                    }else if(chargeVal == 'SEASONAL'){

                        if(data1.dataMasterRate == '' || data1.dataMasterRate == null){

                          if(data1.itemBalRate == '' || data1.itemBalRate == null){
                            $('#market_rate').val('0');
                          }else{
                            $('#market_rate').val('');
                            $('#market_rate').val(data1.dataitemBalRate.STDRATE);
                          }

                          if(data1.dataAccItemRate == '' || data1.dataAccItemRate == null){
                            $('#ratePerMonth').val('0');
                          }else{
                            $('#ratePerMonth').val('');
                            $('#ratePerMonth').val(data1.dataAccItemRate.S_RATE);
                          }

                        }else{

                          var minQty_One = parseFloat(data1.dataMasterRate.MINQTY_ONE);
                          var minQty_Two = parseFloat(data1.dataMasterRate.MINQTY_TWO);
                          var quantity1  = parseFloat($('#qty').val());

                          $('#ratePerMonth').val('');
                          $('#ratePerMonth').val(data1.dataMasterRate.RATE_PER_BAG);

                          if((quantity1 < minQty_One) && (quantity1 < minQty_Two)){

                            $('#market_rate').val('');
                            $('#market_rate').val(data1.dataMasterRate.MINRATE_ONE);

                          }else if((quantity1 >= minQty_One) && (quantity1 < minQty_Two)){

                            $('#market_rate').val('');
                            $('#market_rate').val(data1.dataMasterRate.MINRATE_ONE);

                          }else if((quantity1 >= minQty_One && (quantity1 >= minQty_Two))){

                            $('#market_rate').val('');
                            $('#market_rate').val(data1.dataMasterRate.MINRATE_TWO);

                          }

                          var endDate    = data1.datamasterRate.END_DATE;
                          var splitEndDt = endDate.split('-');
                          var validSez   = splitEndDt[2]+'-'+splitEndDt[1]+'-'+splitEndDt[0];
                          $('#validTill_date').val(validSez);

                        }

                    }else if(chargeVal == 'FIXED'){

                        if(data1.dataMasterRate == '' || data1.dataMasterRate == null){
                          $('#market_rate').val('0');
                        }else{
                          $('#market_rate').val('');
                          $('#market_rate').val(data1.dataMasterRate.STDRATE);
                        }

                        if(data1.dataAccItemRate == '' || data1.dataAccItemRate == null){
                          $('#ratePerMonth').val('0');
                        }else{
                          $('#ratePerMonth').val('');
                          $('#ratePerMonth').val(data1.dataAccItemRate.F_RATE);
                        }

                    }

                    var aqty = parseFloat($('#a_qty').val());
                    var marketRate = parseFloat($('#market_rate').val());

                    var marketValue =  aqty * marketRate;
                    $('#market_value').val(marketValue.toFixed(2));
                   

                } /* -- success condtn*/

            }, /* ---- success function*/
            complete: function() {
              console.log('end spinner');
              $('.modalspinner').addClass('hideloaderOnModl');
            },

          });

  }

  $(document).ready(function(){

    $('.stChargeType').on('click',function(){

        $('#ratePerMonth').val('0');
        $('#market_rate').val('0');
        var chargeVal     = $(this).val();
        var accCode       = $('#acc_code').val();
        var itemCode      = $('#item_code').val();
        var packingCode   = $('#packing_code').val();
        var quantity      = parseFloat($('#qty').val());
        var biltyDate     = $('#bilty_date').val();
        var plantCode     = $('#plant_code').val();
        var splitDate     = biltyDate.split('-');
        var getproperDate = splitDate[1]+'-'+splitDate[0]+'-'+splitDate[2];

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({

            url:"{{ url('cold-storage/get-rate-per-month/by-storage-charge') }}",
            method : "POST",
            type: "JSON",
            data: {chargeVal: chargeVal,accCode:accCode,itemCode:itemCode,packingCode:packingCode,plantCode:plantCode}, 
            beforeSend: function() {
              console.log('start spinner');
              $('.modalspinner').removeClass('hideloaderOnModl');
            },
            success:function(data){

              var data1 = JSON.parse(data);

              console.log('data1.datamasterRate',data1.response);

              if (data1.response == 'error') {
                $('#ratePerMonth').val('0');
                $('#market_rate').val('0');
                $('#market_value').val('0');
                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
              }else if(data1.response == 'success'){

                if(chargeVal == 'PER_UNIT_PER_MONTH'){

                  if(data1.datamasterRate == '' || data1.datamasterRate == null){

                    if(data1.dataitemBalRate == '' || data1.dataitemBalRate == null){
                      $('#market_rate').val('0');
                    }else{
                      $('#market_rate').val('');
                      $('#market_rate').val(data1.dataitemBalRate.STDRATE);
                    }

                    if(data1.dataAccItemRate == '' || data1.dataAccItemRate == null){
                      $('#ratePerMonth').val('0');
                    }else{
                      $('#ratePerMonth').val('');
                      $('#ratePerMonth').val(data1.dataAccItemRate.IP_RATE);
                    }

                  }else{

                    var minQtyOne = parseFloat(data1.datamasterRate.MIN_QTY1);
                    var minQtyTwo = parseFloat(data1.datamasterRate.MIN_QTY2);
                    var quantity  = parseFloat($('#qty').val());
                    $('#ratePerMonth').val('');
                    $('#ratePerMonth').val(data1.datamasterRate.RATE);

                    if((quantity < minQtyOne) && (quantity < minQtyTwo)){

                      $('#market_rate').val('');
                      $('#market_rate').val(data1.datamasterRate.MIN_RATE1);

                    }else if((quantity >= minQtyOne) && (quantity < minQtyTwo)){

                      $('#market_rate').val('');
                      $('#market_rate').val(data1.datamasterRate.MIN_RATE1);
                      
                    }else if((quantity >= minQtyOne && (quantity >= minQtyTwo))){

                      $('#market_rate').val('');
                      $('#market_rate').val(data1.datamasterRate.MIN_RATE2);

                    }

                    var dueDays  = parseInt(data1.datamasterRate.NO_DAYS);

                    var getduedate = new Date(getproperDate);
                    getduedate.setDate(getduedate.getDate() + dueDays); 
                    var getdate = getduedate.getDate();
                    var getMonth=getduedate.getMonth()+1;
                    var getYear = getduedate.getFullYear();
                    var duedate1 =getYear+'-'+getMonth+'-'+getdate;

                    var dval = new Date(duedate1);
                    var moval = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(dval);
                    var da_val = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(dval);

                    var duedate =da_val+'-'+moval+'-'+getYear;
                    $('#validTill_date').val(duedate);

                  }

                }else if(chargeVal == 'SEASONAL'){

                 

                  if(data1.datamasterRate == '' || data1.datamasterRate == null){

                    if(data1.dataitemBalRate == '' || data1.dataitemBalRate == null){
                      $('#market_rate').val('0');
                    }else{
                      $('#market_rate').val('');
                      $('#market_rate').val(data1.dataitemBalRate.STDRATE);
                    }

                    if(data1.dataAccItemRate == '' || data1.dataAccItemRate == null){
                      $('#ratePerMonth').val('0');
                    }else{
                      $('#ratePerMonth').val('');
                      $('#ratePerMonth').val(data1.dataAccItemRate.S_RATE);
                    }

                  }else{

                    var minQty_One = parseFloat(data1.datamasterRate.MINQTY_ONE);
                    var minQty_Two = parseFloat(data1.datamasterRate.MINQTY_TWO);
                    var quantity1  = parseFloat($('#qty').val());
                    $('#ratePerMonth').val('');
                    $('#ratePerMonth').val(data1.datamasterRate.RATE_PER_BAG);

                    if((quantity1 < minQty_One) && (quantity1 < minQty_Two)){

                      $('#market_rate').val('');
                      $('#market_rate').val(data1.datamasterRate.MINRATE_ONE);

                    }else if((quantity1 >= minQty_One) && (quantity1 < minQty_Two)){

                      $('#market_rate').val('');
                      $('#market_rate').val(data1.datamasterRate.MINRATE_ONE);

                    }else if((quantity1 >= minQty_One && (quantity1 >= minQty_Two))){

                      $('#market_rate').val('');
                      $('#market_rate').val(data1.datamasterRate.MINRATE_TWO);

                    }

                    var endDate    = data1.datamasterRate.END_DATE;
                    var splitEndDt = endDate.split('-');
                    var validSez   = splitEndDt[2]+'-'+splitEndDt[1]+'-'+splitEndDt[0];
                    $('#validTill_date').val(validSez);

                  }

                }else if(chargeVal == 'FIXED'){

                  if((data1.datamasterRate) == '' || (data1.datamasterRate == null)){
                    $('#market_rate').val('0');
                  }else{
                    $('#market_rate').val('');
                    $('#market_rate').val(data1.datamasterRate.STDRATE);
                  }

                  if(data1.dataAccItemRate == ''){
                    $('#ratePerMonth').val('0');
                  }else{
                    $('#ratePerMonth').val('');
                    $('#ratePerMonth').val(data1.dataAccItemRate.F_RATE);
                  }

                }

                var qty = parseFloat($('#a_qty').val());
                var marketRate = parseFloat($('#market_rate').val());
                console.log('marketRate',marketRate);
                var marketValue =  qty * marketRate;
                $('#market_value').val(marketValue.toFixed(2));

              } /* -- success -- */
            }, /* -- success function -- */
            complete: function() {
              console.log('end spinner');
              $('.modalspinner').addClass('hideloaderOnModl');
            },    
          }); /* -- ajax -- */
        
    }); /* ---------- click function ---------- */
  }); /* ----------- function --------- */

  function submitBiltyTrans(pdfFlag){

      var downloadFlg = pdfFlag;

      $('#pdfYesNoStatus').val(downloadFlg);
      
      var data = $("#biltyTrans").serialize();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/Transaction/ColdStorage/Bilty-Trans-Save') }}",

          data: data, // here $(this) refers to the ajax object not form
          success: function (data) {
              
              var data1 = JSON.parse(data);
              if(data1.response == 'error') {

                var responseVar = false;
                var url = "{{url('Transaction/view-bilty-msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });

              }else{

                var responseVar = true;
                if(downloadFlg == 1){
                    var fyYear    = data1.data[0].FY_CODE;
                    var fyCd      = fyYear.split('-');
                    var seriesCd  = data1.data[0].SERIES_CODE;
                    var vrNo      = data1.data[0].VRNO;
                    var fileN     = 'BILTY_'+fyCd[0]+''+seriesCd+''+vrNo;
                    var link      = document.createElement('a');
                    link.href     = data1.url;
                    link.download = fileN+'.pdf';
                    link.dispatchEvent(new MouseEvent('click'));
                }

                var url = "{{url('Transaction/view-bilty-msg')}}";
                setTimeout(function(){ window.location = url+'/'+responseVar; });

              }

          },

      });

  }
</script>

@endsection