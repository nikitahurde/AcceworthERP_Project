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
    /*border: 1px solid #e0dcdc;
    border-radius: 10px;
*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .content {
    min-height: 250px !important;
    padding: 0px !important;
    margin-right: auto !important;
    margin-left: auto !important;
    padding-left: 15px !important;
    padding-right: 15px !important;
  }
  .showSeletedName {
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  .vehiclenumup{
    text-transform: uppercase;
  }
</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Fleet Transaction  SDF
            <small>Update Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('dashboard') }}">Fleet</a></li>
            <li><a href="">Fleet Transaction</a></li>
            <li><a href="">Edit Fleet Trans</a></li>
          </ol>
        </section>
<form action="{{ url('form-fleet-trans-update') }}" method="POST" >
               @csrf    
	<section class="content">
    <div class="row">
     <!--  <div class="col-sm-2"></div> -->
      <div class="col-sm-12" style="padding-top: 5%;">
        <div class="box box-info Custom-Box">
            <div class="box-header with-border" style="text-align: center;">
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Fleet Transaction </h2><div class="box-tools pull-right">
          <a href="{{ url('/logistic/view-fleet-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View fleet Transaction</a>
        </div>
              
              
            </div><!-- /.box-header -->
            @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>
                  <i class="icon fa fa-check"></i>
                  Success...!
                </h4>
                 {!! session('alert-success') !!}
              </div>


            @endif


            @if(Session::has('alert-error'))

              <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4>
                  <i class="icon fa fa-ban"></i>
                  Error...!
                </h4>
                {!! session('alert-error') !!}
              </div>

            @endif

          <div class="box-body">
           
               <div class="row">
                
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>
                        Transaction Date : 
                        <span class="required-field"></span>
                      </label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <?php 

                              $Transaction_date = date("d-m-Y", strtotime($fleet_trans->TR_DATE));

                          ?>


                          <input type="hidden" name="fleet_id"  value="{{ $fleet_trans->FLEETTRANID }}">

                          <input type="text" class="form-control datepicker" name="date" placeholder="Enter Transaction Date" value="{{  $Transaction_date }}">
                        </div>
                          <small id="emailHelp" class="form-text text-muted">
                            {!! $errors->first('date', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>


                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Depot Name : <span class="required-field"></span></label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                          </div>
                          <input list="depotList"  id="dept_code" name="dept_code" class="form-control  pull-left" value="{{ $fleet_trans->DEPOT_CODE }}" placeholder="Select Depot Name" >

                          <datalist id="depotList">
                            <option selected="selected" value="">-- Select --</option>
                            @foreach ($depot_list as $key)
                            
                            <option value='<?php echo $key->DEPOT_CODE?>'   data-xyz ="<?php echo $key->DEPOT_NAME; ?>" ><?php echo $key->DEPOT_NAME ; echo " [".$key->DEPOT_CODE."]" ; ?></option>

                            @endforeach
                          </datalist>
                      </div>
                      <small>  
                        <div class="pull-left showSeletedName" id="depotText"></div>
                     </small>
                     <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('dept_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                     
                  </div>
                    <!-- /.form-group -->
                  </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <div class="form-group">
                      <label>
                        Invoice Number 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                          <input type="text" class="form-control" name="invoice_no" value="{{ $fleet_trans->INVOICE_NO }}" placeholder="Enter Invoice Number">
                      </div>
                          <small id="emailHelp" class="form-text text-muted">
                            {!! $errors->first('invoice_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>
                    </div>
                    <!-- /.form-group -->
                  </div>
                <!-- /.col -->

                
              </div>
              <!-- /.row -->

              <div class="row">

                 <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </div>

                           <input list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ $fleet_trans->ACC_CODE }}" placeholder="Select Account Code" >

                          <datalist id="accountList">
                            <option selected="selected" value="">-- Select --</option>
                            @foreach ($acc_list as $key)
                            
                            <option value='<?php echo $key->ACC_CODE?>' <?php if($fleet_trans->ACC_CODE==$key->ACC_CODE){ echo 'selected';} ?>   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>
                            
                            @endforeach
                          </datalist>
                      </div>
                      <small>  
                        <div class="pull-left showSeletedName" id="accountText"></div>
                     </small>
                     <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('acct_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                  </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Area : <span class="required-field"></span></label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-street-view" aria-hidden="true"></i>
                          </div>
                          <input list="areaList"  id="area_code" name="area_code" class="form-control  pull-left" value="{{ $fleet_trans->AREA_CODE}}" placeholder="Select Area">

                          <datalist id="areaList">
                           
                            @foreach ($area_list as $key)
                            
                            <option value='<?php echo $key->AREA_CODE?>'   data-xyz ="<?php echo $key->AREA_NAME; ?>" ><?php echo $key->AREA_NAME; echo " [".$key->AREA_CODE."]" ; ?></option>

                            @endforeach
                          </datalist>
                      </div>
                      <small>  
                        <div class="pull-left showSeletedName" id="areaText"></div>
                     </small>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('area_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                     
                  </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label>
                        Shipment No
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                          <input type="text" class="form-control" name="shipment_no" value="{{ $fleet_trans->SHIPMENT_NO }}" placeholder="Enter Shipment No">
                      </div>
                          <small id="emailHelp" class="form-text text-muted">
                            {!! $errors->first('shipment_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>
                    </div>
                    <!-- /.form-group -->
                  </div>
                
                  
                
              </div>
              <!-- /.row -->

          </div><!-- /.box-body -->
           
          </div>
      </div>
       
    </div>
     
	</section>


  <section class="content">
    <div class="row">
     <!--  <div class="col-sm-2"></div> -->
      <div class="col-sm-12">
        <div class="box box-warning Custom-Box">
         
          <div class="box-body">
             <div class="row">
                 <div class="col-md-2">
                    <div class="form-group">
                      <label>
                        L R NO:  
                        <span class="required-field"></span>
                      </label>
                    <div class="input-group">
                      <div class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                      </div>
                      <input type="text" name="lr_no" class="form-control" placeholder="Enter L R NO" value="{{ $fleet_trans->LR_NO }}" readonly>
                    </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('lr_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                     
                     
                    </div>
                  </div>
                    <!-- /.form-group -->
                 

                  <div class="col-md-2 setinmobileDiv">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Transporter : <span class="required-field"></span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-bus" aria-hidden="true"></i>
                            </div>
                            <input list="transList" id="trans_code" name="trans_code" class="form-control  pull-left" value="{{ $fleet_trans->TRPT_CODE }}" placeholder="Select Transporter">
                            <datalist id="transList">
                              <option selected="selected" value="">-- Select --</option>
                              @foreach ($acctype_list as $key)                  

                              <option value='<?php echo $key->ATYPE_CODE?>'   data-xyz ="<?php echo $key->ATYPE_NAME; ?>" ><?php echo $key->ATYPE_NAME ; echo " [".$key->ATYPE_CODE."]" ; ?></option>                        
                              @endforeach
                            </datalist>
                        </div>

                        <small>  
                          <div class="pull-left showSeletedName" id="transText"></div>
                       </small>

                        <small id="emailHelp" class="form-text text-muted">
                              {!! $errors->first('trans_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>

                    </div>

                  </div><!-- /.col -->

                   <div class="col-md-3">
                    <div class="form-group">
                      <label>
                        Truck No: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                          </span>
                      
                        <input list="truckList" name="truck_no" id="truck_no" class="form-control vehiclenumup" placeholder="Enter Truck No" value="{{ $fleet_trans->TRUCK_NO }}" onchange="getTruckDetails(this.value);">

                       <datalist id="truckList">

                          <?php foreach($truck_list as $key) { ?>

                             <option value="<?= $key->TRUCK_NO ?>" data-xyz="<?= $key->WHEEL_TYPE ?>"><?= $key->TRUCK_NO ?></option>

                           <?php  } ?>
                         
                       </datalist>

                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('truck_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label>
                       Vehicle Type: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                          </span>
                       <input  list="wheelList" name="vehicle_type" class="form-control" placeholder="Enter Driver Name" onchange="getWheelInd(this.value);" id="vehicle_type" value="{{ $fleet_trans->VEHICLE_TYPE }}">

                       <datalist id="wheelList">
                         
                       </datalist>

                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('vehicle_type', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>


                  <div class="col-md-3">
                    <div class="form-group">
                      <label>
                        Driver Name: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                          </span>
                       <input name="driver_name" class="form-control" placeholder="Enter Driver Name" value="{{ $fleet_trans->DRIVER_NAME }}">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('driver_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>
              </div>

              <div class="row">
                <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Item : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-ship" aria-hidden="true"></i>

                        </div>

                        <input list="itemList" id="item_code" name="material" class="form-control  pull-left" value="{{ $fleet_trans->ITEM_CODE }}" placeholder="Select Item">



                          <datalist id="itemList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($item_list as $key)

                            

                            <option value='<?php echo $key->ITEM_CODE?>'   data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="itemText"></div>

                     </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('material', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="errorItem" class="form-text text-muted">

                           

                      </small>

                  </div>

                </div><!-- /.col -->


                 <div class="col-md-2">
                     <div class="form-group">
                      <label>
                         Qty: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                        <input type="hidden" id="cfator">
                       <input name="sto_qty_um" id="stoqtyum" class="form-control" placeholder="Enter Qty UM" value="{{ $fleet_trans->QTY }}">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('sto_qty_um', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                      <label>
                        UM: 
                        <span class="required-field"></span>
                      </label>
                     
                       <input name="stoUM" id="stoUM" class="form-control" placeholder="Enter UM" readonly value="{{ $fleet_trans->UM }}">

                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('stoUM', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                      <label>
                         AQty: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                          </span>
                       <input name="sto_qty_aum" id="stoQtyAum" class="form-control" placeholder="Enter Qty AUM" value="{{ $fleet_trans->AQTY }}">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('sto_qty_aum', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                      <label>
                        AUM: 
                        <span class="required-field"></span>
                      </label>
                     
                       <input name="stoAum" id="stoAum" class="form-control" placeholder="Enter AUM" readonly value="{{ $fleet_trans->AUM }}">
                      
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('stoAum', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>
              </div>

              <div class="row">

                 

              </div>

              <div class="row">
                 
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>
                        Overload : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                        
                       <input type="radio" name="overload" class="optionsRadios1" value="Y" <?php if($fleet_trans->OVERLOAD=='Y') {echo 'checked';} ?>>&nbsp; &nbsp;&nbsp;&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                       <input type="radio" name="overload" class="optionsRadios1" value="N" <?php if($fleet_trans->OVERLOAD=='N') { echo 'checked'; } ?>>&nbsp; &nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('overload', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-2">
                     <div class="form-group">
                      <label>
                        Rate : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </span>
                       <input type="text" name="rate" class="form-control" placeholder="Enter Rate" value="{{ $fleet_trans->RATE }}" id="rate" readonly="">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>
              </div>

                  <div class="row">

                  <div class="col-md-2">
                     
                    <div class="form-group">
                      <label>
                        load Capacity : 
                      </label>
                      <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;text-align: right;" value="{{ $fleet_trans->LOAD_CAPACITY }}" id='loadcpct' name="loadcpct" readonly=""  />
                    </div>
                 </div>

                  <div class="col-md-2">
                     
                    <div class="form-group">
                      <label>
                        Model : 
                      </label>
                    
                      <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;" id='model' name="model" value="{{ $fleet_trans->MODEL }}" readonly="" />
                    </div>
                
                 </div>

                   <div class="col-md-2">
                     
                    <div class="form-group">
                      <label>
                        loaded Avg : 
                        
                      </label>
                     
                      
                      <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;text-align: right;" value="{{ $fleet_trans->LOAD_AVERAGE }}" id='loadAvg' name="loadAvg"/>
                     </div>
                  </div>


                   <div class="col-md-2">
                     
                   
                      <label>
                        Empty Avg :  
                      
                      </label>
                      
                     <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;text-align: right;" value="{{ $fleet_trans->EMPTY_AVERAGE }}" id='emptyAvg' name="emptyAvg"/>
                      
                  </div>
                

          </div>
          </div><!-- /.box-body -->

          </div>

      </div>
       
    </div>
     
  </section>

   <section class="content">
    <div class="row">
      <div class="col-md-12">

        <div class="box box-primary Custom-Box">
            
               <div class="box-body">
                <div class="row">
                  <div class="col-md-12">
                    <span style="font-weight: bold;">ROUTE DETAILS</span>
                  

                     <div class="table-responsive">

                        <div class="boxer" id="bodyTable">
                        
                             <div class='box-row'><div class='box10 texIndbox1'>VEHICLE</div><div class='box10 rateIndbox'>SOURCE</div><div class='box10 rateIndbox'>DESTINATION</div><div class='box10 rateBox'>KMS</div><div class='box10 amountBox'>TOLL</div><div class='box10 amountBox'>EXTRA KMS</div><div class='box10 amountBox'>LESS KMS</div><div class='box10 amountBox'>EXTRA TOLL</div></div>
                              
                       </div>


                      

                     </div>

                   
                  </div>
                </div>
               </div>
            </div>
      </div>

      
    </div>

   </section>

   <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <div class="col-sm-6">

              <div class="">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">



                  <input type ="hidden" name="comp_name" id="getCompName">
                  <input type ="hidden" name="fy_year" id="getFyYear">
                  <input type ="hidden" name="trans_date" id="getTransDate">
                  <input type ="hidden" name="vr_no" id="getVrNo">
                 <!--  <input type ="hidden" name="trans_code" id="getTransCode"> -->
                 <!--  <input type ="hidden" name="departCode" id="getAccCode">

                  <input type ="hidden" name="departName" id="getDeptName">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="pfct_name" id="getPfctName">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="plant_name" id="getPlantName">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
                  <input type ="hidden" name="series_name" id="getSeriesName">
                  <input type ="hidden" name="tax_code" id="getTaxCode">
                  <input type="hidden" name="due_days" id="gateduedays">
                  <input type="hidden" name="getdue_date" id="gateduedate">
                  
                  <input type ="hidden" name="party_ref_no" id="getpartyrfNo">
                  <input type ="hidden" name="party_ref_date" id="getpartyrfDate">
                  <input type ="hidden" name="consine_code" id="getcosine">
                  <input type ="hidden" name="rfhead1" id="getrfhead1">
                  <input type ="hidden" name="rfhead2" id="getrfhead2">
                  <input type ="hidden" name="rfhead3" id="getrfhead3">
                  <input type ="hidden" name="rfhead4" id="getrfhead4">
                  <input type ="hidden" name="rfhead5" id="getrfhead5">
                  <input type ="hidden" name="rfhead5" id="getrfhead5">

                  <input type="hidden" name="cost_code" id="cost_code"> -->


                  <input type="hidden" name="comp_name" value="<?php echo Session::get('company_name'); ?>">
                  <input type="hidden" name="fiscal_year" value="<?php echo Session::get('macc_year'); ?>">
               
                       <thead>
                           <th colspan="5" class="text-center">EXPENSE HEAD</th>
                           
                        </thead>
                        <thead>
                          <th>&nbsp;</th>
                          <th>SR.NO</th>
                          <th>INDICATOR</th>
                          <th>GL CODE</th>
                          <th>AMT</th>
                         
                        </thead>

                 
                

                  <?php $total=0; $srno=1; foreach ($tran_exp_list as $key) { 

                        $total += floatval($key->AMOUNT);
                    ?>
                  <tr class="useful">


                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;"><?= $srno; ?>.</span>
                      
                    </td> 
                     
                    <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                        <input list="IndList" class="inputboxclr SetInCenter" style="width: 120px;margin-bottom: 5px;" id='indicator<?= $srno; ?>' name="indicator[]" onchange="getIndDetails(<?= $srno; ?>)" value="<?= $key->INDICATOR ?>" />

                          <datalist id="IndList">

                              
                          </datalist>

                          <input type="hidden" name="fleettransId" value="<?= $key->FLEETTRANEXPID ?>">
                      </div>
                      
                    </td>

                  

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;" id='gl_code<?= $srno; ?>' name="gl_code[]" value="<?= $key->GL_CODE ?>" readonly="" />

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>
                      
                    </td>

                    <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;margin-top: -3%;">

                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate basicamt"  id='Amt<?= $srno; ?>' name="Amt[]" readonly="" value="<?= $key->AMOUNT ?>" style="width: 80px;text-align: right;"/>
              
                      </div>
                       <div><small id="errmsgqty1"></small></div>

                    </td>

                    
                  </tr>
                  <?php $srno++; } ?>

               

                </table>
               
                

              </div><!-- /div -->
               <div class="row">

                  <div class="col-md-12">
                   <div style="margin-left: 72%;">  <label> Total  : </label> <span id='bTotal'> <?=  $total.'.00'; ?></span></div>
                   </div>

                 
                </div>

              <button type="button" class='btn btn-danger delete' id="deletehidn"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

            <!-- <button type="button" class='btn btn-info addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button> -->


            </div>



            <div class="col-sm-6">
              
              <div class="">


                          <div style="height:41px;font-weight: bold;padding-top: 12px;text-align: center;background-color: #b8daff;">
                                 CASH BANK HEAD
                          </div>
                        <div class="boxer" id="bodyTable1">

                                 
                             <div class='box-row' style="background-color: #b8daff;">
                                <div class='box10 texIndbox1'>CODE</div>
                                <div class='box10 rateIndbox'>NAME</div>
                                <div class='box10 rateIndbox'>AMT</div>
                             </div>


                          
                            <?php $total =0; $sr=1; foreach($tran_pmt_list as $val) {  

                                $total += $val->PAYMENT;
                              ?>
                            <div class='box-row'>
                              <div class='box10 texIndbox1'>
                               <input list="bankList<?= $sr ?>" class="debitcreditbox dr_amount inputboxclr SetInCenter"  id="bank_code<?= $sr ?>" name="bank_code[]" value="<?= $val->BANK_CODE; ?>"  style="width: 80px" onchange="bankName(<?= $sr ?>);" />

                                  <datalist id="bankList<?= $sr ?>">
                                    
                                    <?php foreach ($bank_list as $key) { ?>
                                      
                                      <option value="<?= $key->BANK_CODE; ?>" data-xyz="<?= $key->BANK_NAME; ?>"><?= $key->BANK_CODE; ?></option>

                                    <?php } ?>

                                  </datalist>
                             </div>
                              <div class='box10 texIndbox1'>
                                <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='bank_name<?= $sr ?>' name="bank_name[]"  style="width: 140px" value="<?= $val->BANK_NAME; ?>"/>


                                <input type="hidden" name="fleetpmtId" value="<?= $val->FLEETTRANPMTID ?>">

                             </div>
                              <div class='box10 texIndbox1'> 
                                <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter banktotal" oninput="banktotal(<?= $sr ?>)"  id='bankAmt<?= $sr ?>' name="bankAmt[]"  value="<?= $val->PAYMENT; ?>" style="width: 80px"/>
                              </div>
                            </div>

                          <?php $sr++; } ?>

                          
                       </div>
                     
                      

                

              </div><!-- /div -->

                <div class="row">

                    <div class="col-md-12">
                     <div style="margin-left: 66%;margin-top: 15px;">  <label> Total  : </label> <span id='bankTotal'><?= $total.'.00' ?></span>
                     </div>
                   </div>
                 
                </div>


            </div>

              <div id="errMsg" style="text-align: right;color: red;margin-right: 167px;"></div>
             

               
            


        
   

      <br>
          

       

     
  </div><!-- /.box-body -->

  <div class="row">

         <p class="text-center">

              <button class="btn btn-success" type="Submit" id="submitdata"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update</button>

              <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

             </p>
        
      </div>

</div>

</div>

</div>

</section>


  <!-- <div class="box-body">
    <div style="text-align: center;margin-top: -4%;
    margin-bottom: 5%;">
                   <button type="Submit" class="btn btn-primary" id="hidesubmitbtn">
                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 
                   </button>
       </div>
     </div> -->

 </form>
</div>

@include('admin.include.footer')

<script type="text/javascript">

$(document).ready(function() {

  $(window).on("load", function() {

   
    var area_code = $("#area_code").val();
    var dept_code = $("#dept_code").val();

     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });

    $.ajax({

          url:"{{ url('get-vehicle-routes-details') }}",

           method : "POST",

           type: "JSON",

           data: {area_code: area_code,dept_code: dept_code},

           success:function(data){

              console.log(data);

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                    // console.log(data1.data[0]);
                    console.log('ROUTES',data1);

                     $.each(data1.data, function(k, getData) {

                    
                        
                      var tableData = "<div class='box-row'><div class='box10 texIndbox1'>"+getData.VEHICLE_TYPE+"</div><div class='box10 texIndbox1'>"+getData.FROM_PLACE+"</div><div class='box10 texIndbox1'>"+getData.TO_PLACE+"</div><div class='box10 texIndbox1'>"+getData.KM+"</div><div class='box10 texIndbox1'>"+getData.TOLL+"</div><div class='box10 texIndbox1'>"+getData.EXTRA_KM+"</div><div class='box10 texIndbox1'>"+getData.LESS_KM+"</div><div class='box10 texIndbox1'>"+getData.EXTRA_TOLL+"</div></div>";

                        $('#bodyTable').append(tableData);
                  });


           }


        }
     });


    var wheelType = $("#vehicle_type").val();

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });


       $.ajax({

          url:"{{ url('get-wheelType-details') }}",

           method : "POST",

           type: "JSON",

           data: {wheelType: wheelType},

           success:function(data){

              console.log(data);

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                    // console.log(data1.data[0]);
                   // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);

                     // var count = data1.data.length;
                     
                         
                      var num = 1;
                     $.each(data1.data, function(k, getData) {

                       

                        $("#IndList").append($('<option>',{

                          value:getData.FLEETIND,

                          'data-xyz':getData.FLEETIND,
                          text:getData.FLEETIND

                        }));

                        num++;
                    
                  });


           }


        }
     });



         $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        var itemcode =  $("#item_code").val();



        /*$('#stoqtyum').val('');
        $('#stoQtyAum').val('');
        $('#cfator').val('');*/

        $.ajax({

          url:"{{ url('item-um-aum') }}",

           method : "POST",

           type: "JSON",

           data: {itemcode: itemcode},

           success:function(data){

            
                var data1 = JSON.parse(data);



                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                   // console.log(data1.data[0].aum_factor);

                    $('#stoUM').val(data1.data[0].UM_CODE);
                    $('#stoAum').val(data1.data[0].AUM_CODE);
                    $('#cfator').val(data1.data[0].AUM_FACTOR);
                        

                }
           }

        });

  
       
});

});

</script>

<script type="text/javascript">
  
  function getTruckDetails(truckNo){

    //alert(truckNo);return false;

       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });


       $.ajax({

          url:"{{ url('get-truckno-details') }}",

           method : "POST",

           type: "JSON",

           data: {truckNo: truckNo},

           success:function(data){

              console.log(data);

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                    // console.log(data1.data[0]);
                   // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);
                      $("#model").val(data1.data[0].MODEL)
                      $("#loadcpct").val(data1.data[0].LOAD_CAPACITY)
                      $("#loadAvg").val(data1.data[0].LOAD_AVERAGE);
                      $("#emptyAvg").val(data1.data[0].EMPTY_AVERAGE);

                     $.each(data1.data, function(k, getData) {

                     
                        $("#wheelList").append($('<option>',{

                          value:getData.WHEEL_TYPE,

                          'data-xyz':getData.WHEEL_TYPE,
                          text:getData.WHEEL_TYPE

                        }));
                    
                  });


           }


        }
     });



  }
</script>
<script type="text/javascript">
  
  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      endDate:'today',
      autoclose: 'true'
    });


   
});
</script>
<script type="text/javascript">
  
  function bankName(num){


      var Bankcode =  $("#bank_code"+num).val();


       var xyz = $("#bankList"+num+" option").filter(function() {

          return this.value == Bankcode;

      }).data('xyz');

       var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
           
        }else{
        
            $("#bank_name"+num).val(msg);
        }

  }

</script>

<script type="text/javascript">
  calculate = function()
  {
    var DEISEL=DRV_Exp=P_Exp=Fooding=Fooding=LU_Exp=Other_Exp=Toll=0;
    
    
     DEISEL = document.getElementById('a1').value;
     DRV_Exp = document.getElementById('a2').value; 
     P_Exp = document.getElementById('a3').value; 
     Fooding = document.getElementById('a4').value; 
     LU_Exp = document.getElementById('a5').value; 
     Toll = document.getElementById('a6').value; 
     Other_Exp = document.getElementById('a7').value; 
     
     if(DEISEL=="")DEISEL=0;
     if(DRV_Exp=="")DRV_Exp=0;
     if(P_Exp=="")P_Exp=0;
     if(Fooding=="")Fooding=0;
     if(LU_Exp=="")LU_Exp=0;
     if(Toll=="")Toll=0;
     if(Other_Exp=="")Other_Exp=0;
   
      
     
    document.getElementById('TOTAL').value = parseInt(DEISEL)+parseInt(DRV_Exp)+parseInt(P_Exp)+parseInt(Fooding)+parseInt(LU_Exp)+parseInt(Toll)+parseInt(Other_Exp);

     }
</script>
<script type="text/javascript">

 

  $(".optionsRadios1").on('change',function () { 
    var radio_btn = $(this).val();
    console.log(radio_btn);  
    var area_code = $("#area_code").val(); 
    var dept_code = $('#dept_code').val(); 
     getRate(area_code,dept_code,radio_btn);
    
});

   function getRate(area_code,dept_code,radio_btn)
   {
     
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });

      var loadType = radio_btn;
      var DEPOT_PLANT = dept_code;
      var DESTINATION = area_code;
     
      $.ajax({
        type: 'POST',
        url: "{{ url('/fleet_rate') }}",
        data: {
        'loadType': loadType, 
        'DEPOT_PLANT': DEPOT_PLANT, 
        'DESTINATION': DESTINATION, 
        'act': 'getRate'
        },
        success: function (data) {

           console.log("Data ==> ",data);

          if (data == '') {

             $("#rate").val('');

          }else{

            var obj = JSON.parse(data);
           
              $("#rate").val(obj.rate);
          }
          
          
        
        
        }
      }); 
        
       
     
   }
</script>



<script type="text/javascript">
    $(document).ready(function() {

      $('#a1').change(function(){
          var diselexp = $('#a1').val();
          if(diselexp){
          $('#diesel_slip_no').val('');
          $('#diesedl_cr').val('');
          $('#diesel_qty').val('');
          $( "#diesel_slip_no" ).prop( "disabled", true );
          $( "#diesedl_cr" ).prop( "disabled", true );

          $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
          $('#hidesubmitbtn').prop( "disabled", true );

        }else{
            $( "#diesel_slip_no" ).prop( "disabled", false );
          $( "#diesedl_cr" ).prop( "disabled", false );
        }
      });

      $('#diesedl_cr').on('input',function(){
        $('#enterslipnomsg').html('');
          var diselcr = $('#diesedl_cr').val();
          
          if(diselcr){
            $('#a1').val('');
            $('#diesel_slip_no').val('');
            $('#diesel_qty').val('');
            $('#a1').prop( "disabled", true );
            $('#enterslipnomsg').html('Diesel Slip No Is Required').css('color','red');
            $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
            $( "#hidesubmitbtn" ).prop( "disabled", true );
            return true;
          }else{
             $('#a1').prop( "disabled", false );
            $('#enterslipnomsg').html('');
            $('#filerrormsg').html('');
            return false;
          }
      });

      $('#diesel_slip_no').on('input',function(){
       var diesel_slip_no =  $('#diesel_slip_no').val();
          if(diesel_slip_no){
            $('#enterslipnomsg').html('');
           // $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
           
          }else{
            $('#enterslipnomsg').html('Diesel Slip No Is Required').css('color','red');
            $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
           // $( "#hidesubmitbtn" ).prop( "disabled", true );
          }
      });

      $('#diesel_slip_no').change(function(){
         var diselslipno = $('#diesel_slip_no').val();

         var driver_exp = $('#a2').val();
         var fooding_exp = $('#a4').val();
         var admin_exp = $('#a3').val();
         var uloading_exp = $('#a5').val();
         var toll_exp = $('#a6').val();
         var other_exp = $('#a7').val();
         var total_adv = parseInt(driver_exp)+parseInt(fooding_exp)+parseInt(admin_exp)+parseInt(uloading_exp)+parseInt(toll_exp)+parseInt(other_exp);

        // console.log(total_adv);

         if(diselslipno){
          $('#a1').val('');
          $('#TOTAL').val(total_adv);
         }

      });


      $('#diesel_qty').on('input',function(){
          var dieselQty = $(this).val();
          if(dieselQty){

          $('#hidesubmitbtn').prop( "disabled", false );
          $('#filerrormsg').html('');
        }else{
          $('#hidesubmitbtn').prop( "disabled", true );
        }
      });

      $("#dept_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("depotText").innerHTML = '';

          }

      });

      $("#acct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("accountText").innerHTML = '';

          }

      });

      $("#area_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#areaList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("areaText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("areaText").innerHTML = '';

          }

        });

      $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("itemText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("itemText").innerHTML = '';

          }

        });

       $("#trans_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#transList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("transText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("transText").innerHTML = '';

          }

        });


      $("#item_code").change(function(){

         $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        var itemcode =  $(this).val();


        $.ajax({

          url:"{{ url('item-um-aum') }}",

           method : "POST",

           type: "JSON",

           data: {itemcode: itemcode},

           success:function(data){

            
                var data1 = JSON.parse(data);



                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                   // console.log(data1.data[0].aum_factor);

                   /* $('#stoUM').val(data1.data[0].UM_CODE);
                    $('#stoAum').val(data1.data[0].AUM_CODE);*/
                    $('#cfator').val(data1.data[0].AUM_FACTOR);
                        

                }
           }

        });

      });



      $("#stoqtyum").on('input',function(){

            var stoQty = $("#stoqtyum").val();

            var cFactor = $("#cfator").val();

            var result = stoQty*cFactor;

            if(stoQty<0){

               alert('Pleas Select More Than 0 Quantity');

               $("#stoqtyum").val('0');

               $("#stoQtyAum").val('');

            }else{

               $("#stoQtyAum").val(result);

            }

        });


      $('#stoQtyAum').on('input',function(){

            var stoQtyAumvar = $('#stoQtyAum').val();
            var stoCfactor = $('#cfator').val();

            result = stoQtyAumvar / stoCfactor;

            $('#stoqtyum').val(result.toFixed(2));

        });

      $( window ).on( "load", function() {
            //console.log($('#item_code').val());

             $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
             });

             var item_code = $('#item_code').val();

          $.ajax({

            url:"{{ url('get-umaum-show-in-edit') }}",
             method : "POST",
             type: "JSON",
             data: {item_code: item_code},
             success:function(data){
              
                  var data1 = JSON.parse(data);

                  
                  //console.log("Data  ==> ",data1.data);
                  

                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                  }else if(data1.response == 'success'){

                        var fetchitemcode = data1.data[0].item_code;
                          if(item_code == fetchitemcode){

                            $('#stoUM').val(data1.data[0].um_code);
                            $('#stoAum').val(data1.data[0].aum);
                            $('#cfator').val(data1.data[0].aum_factor);

                          }

                  }
                
              
             }

          });

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
  
  function getIndDetails(num){

  //  alert(wheelType);return false;
      var indicator = $("#indicator"+num).val();
      var vehicle_type = $("#vehicle_type").val();

      //alert(indicator);

       $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
         });


       $.ajax({

          url:"{{ url('get-Indicator-details') }}",

           method : "POST",

           type: "JSON",

           data: {indicator: indicator,vehicle_type:vehicle_type},

           success:function(data){

       
                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                    $("#gl_code"+num).val('0.000');
                    $("#Amt"+num).val('0.000');

                     var btotal =0;

                        $(".basicamt").each(function () {
                           
                          if (!isNaN(this.value) && this.value.length != 0) {
                              btotal += parseFloat(this.value);
                          }

                          

                        $("#bTotal").html(btotal.toFixed(2));

                      });

                }else if(data1.response == 'success'){
                   // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);
                    

                    var rate =parseFloat(data1.data[0].RATE);
                    $("#gl_code"+num).val(data1.data[0].GL_CODE);

                    $("#Amt"+num).val(rate.toFixed(2));

                    var btotal =0;

                        $(".basicamt").each(function () {
                           
                          if (!isNaN(this.value) && this.value.length != 0) {
                              btotal += parseFloat(this.value);
                          }

                          

                        $("#bTotal").html(btotal.toFixed(2));

                      });

               
                      
           }


        }
     });


  }
</script>

<script type="text/javascript">
  
  function banktotal(num){


             var btotal =0;

            $(".banktotal").each(function () {
               
              if (!isNaN(this.value) && this.value.length != 0) {
                  btotal += parseFloat(this.value);
              }

            $("#bankTotal").html(btotal.toFixed(2));

          });

          var total =   parseFloat($("#bTotal").html());

          var bstotal = parseFloat($("#bankTotal").html());
          
          if(bstotal > total || bstotal < total){

              $("#errMsg").html('Expense total and cash bank total should be same');

              $("#submitdata").prop('disabled',true);

          }else if(bstotal == total){
            $("#submitdata").prop('disabled',false);
            $("#errMsg").html('');
          }else{

              $("#errMsg").html('');
              

          }

          

       

  }



$(".delete").on('click', function() {

      $('.case:checkbox:checked').parents("tr").remove();

      $('.check_all').prop("checked", false); 

      var bsic_amt = 0;

       $(".basicamt").each(function () {
          //add only if the value is number
          if (!isNaN(this.value) && this.value.length != 0) {
              bsic_amt += parseFloat(this.value);
          }

          console.log(bsic_amt);

        $("#bTotal").html(bsic_amt.toFixed(2));

       var banktotal =  $("#bankTotal").html();

        if(bsic_amt == banktotal){
          $("#submitdata").prop('disabled',false);
          $("#errMsg").html('');
        }else{
          $("#errMsg").html('Expense total and cash bank total should be same');
          $("#submitdata").prop('disabled',true);
        }

      });



       var gr_amt =0;
       $(".setGrandAmnt").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                gr_amt += parseFloat(this.value);
            }

          $("#allgrandAmt").val(gr_amt.toFixed(2));

        });

       var taxCalC =0;
         $(".dataCountCl").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                taxCalC += parseFloat(this.value);
            }

          $("#allgetMCount").val(taxCalC.toFixed(2));

        });

       var basicAmnount = parseFloat($('#basicTotal').val());
       var allGrandAmount = parseFloat($('#allgrandAmt').val());

       if(allGrandAmount == '0.00'){
          $('#CalPayTerms').prop('disabled',true);
       }else{
          var otherAmount = allGrandAmount - basicAmnount;
          $('#otherTotalAmt').val(otherAmount);
       }

       var dataCl =0;
         $(".quaPcountrow").each(function () {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                dataCl += parseFloat(this.value);
            }

          $("#allquaPcount").val(dataCl);

        });
        
   

  }); 
</script>


@endsection