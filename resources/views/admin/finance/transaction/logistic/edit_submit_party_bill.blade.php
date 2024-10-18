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
  .setlable{
    margin-top: 6px;
  }
  .setleftcalblock{
    margin-bottom: -10px;
  }
  .setlableRight{
    padding-right: 12px;
  }
  .selectlable{
        padding-left: 6px;
  }
  .lastrightbox{

      width: 44.7%;
      margin-left: -25px;

  }
  .lbleRightBox{
    padding-top: 26%;
  }

  @media screen and (max-width: 600px) {

    .lastrightbox{

      width: 100%;
      margin-left: 0px;
    }
    .lbleRightBox{
      padding-top: 0px;
    }

  }
</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Fleet Challan Receipt
            <small>Update Details</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Fleet Challan Receipt</li>
          </ol>
        </section>
<form action="{{ url('update-fleet-challan-receipt') }}" method="POST" >
               @csrf    
  <section class="content">
    <div class="row">
     <!--  <div class="col-sm-2"></div> -->
      <div class="col-sm-12" style="padding-top: 5%;">
        <div class="box box-info Custom-Box">
            <div class="box-header with-border" style="text-align: center;">
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Fleet Challan Receipt </h2><div class="box-tools pull-right">
          <a href="{{ url('/logistic/fleet-challan-receipt') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fleet Challan Rec</a>
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
                          

                          <input type="text" class="form-control datepicker" name="date" placeholder="Enter Transaction Date" value="{{ $fleet_trans->TR_DATE }}" readonly>
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
                          <input list="depotList"  id="dept_code" name="dept_code" class="form-control  pull-left" value="{{ $fleet_trans->DEPOT_CODE }}" placeholder="Select Depot Name" readonly>

                          <datalist id="depotList">
                            <option selected="selected" value="">-- Select --</option>
                            @foreach ($depot_list as $key)
                            
                            <option value='<?php echo $key->depot_code?>'   data-xyz ="<?php echo $key->depot_name; ?>" ><?php echo $key->depot_name ; echo " [".$key->depot_code."]" ; ?></option>

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
                          <input type="text" class="form-control" name="invoice_no" value="{{ $fleet_trans->INVOICE_NO }}" placeholder="Enter Invoice Number" readonly>
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

                           <input list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ $fleet_trans->ACC_CODE }}" placeholder="Select Account Code" readonly>

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
                          <input list="areaList"  id="area_code" name="area_code" class="form-control  pull-left" value="{{ $fleet_trans->  AREA_CODE}}" placeholder="Select Area" readonly>

                          <datalist id="areaList">
                            <option selected="selected" value="">-- Select --</option>
                            @foreach ($area_list as $key)
                            
                            <option value='<?php echo $key->AREA_CODE?>'   data-xyz ="<?php echo $key->AREA_NAME; ?>" ><?php echo $key->AREA_NAME ; echo " [".$key->AREA_CODE."]" ; ?></option>

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
                 <div class="col-md-4">
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
                 

                  <div class="col-md-4 setinmobileDiv">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Transporter : <span class="required-field"></span></label>
                        <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-bus" aria-hidden="true"></i>
                            </div>
                            <input list="transList" id="trans_code" name="trans_code" class="form-control  pull-left" value="{{ $fleet_trans->TRPT_CODE }}" placeholder="Select Transporter" readonly>
                            <datalist id="transList">
                              <option selected="selected" value="">-- Select --</option>
                              @foreach ($acctype_list as $key)                  

                              <option value='<?php echo $key->ATYPE_CODE?>'   data-xyz ="<?php echo $key->acctype_name; ?>" ><?php echo $key->acctype_name ; echo " [".$key->ATYPE_CODE."]" ; ?></option>                        
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

                   <div class="col-md-4">
                    <div class="form-group">
                      <label>
                        Truck No: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                          </span>
                       <input name="truck_no" class="form-control" placeholder="Enter Country" value="{{ $fleet_trans->TRUCK_NO }}" readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('truck_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>
              </div>

              <div class="row">
                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Item : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-ship" aria-hidden="true"></i>

                        </div>

                        <input list="itemList" id="item_code" name="material" class="form-control  pull-left" value="{{ $fleet_trans->ITEM_CODE }}" placeholder="Select Item" readonly>



                          <datalist id="itemList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($item_list as $key)

                            

                            <option value='<?php echo $key->item_code?>'   data-xyz ="<?php echo $key->item_name; ?>" ><?php echo $key->item_name ; echo " [".$key->item_code."]" ; ?></option>

                            

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
              </div>

              <div class="row">

                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                         Qty UM: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                        <input type="hidden" id="cfator">
                       <input name="sto_qty_um" id="stoqtyum" class="form-control" placeholder="Enter Qty UM" value="{{ $fleet_trans->UM }}" readonly>
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
                     
                       <input name="stoUM" id="stoUM" class="form-control" placeholder="Enter UM" readonly>

                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('stoUM', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>

                  <div class="col-md-4">
                     <div class="form-group">
                      <label>
                         Qty AUM: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                          </span>
                       <input name="sto_qty_aum" id="stoQtyAum" class="form-control" placeholder="Enter Qty AUM" value="{{ $fleet_trans->AUM }}" readonly>
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
                     
                       <input name="stoAum" id="stoAum" class="form-control" placeholder="Enter AUM" readonly>
                      
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('stoAum', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                  </div>

              </div>

              <div class="row">
                 
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>
                        Overload : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                        
                       <input type="radio" name="overload" class="optionsRadios1" value="Y" readonly <?php if($fleet_trans->OVERLOAD=='Y') {echo 'checked';} ?>>&nbsp; &nbsp;&nbsp;&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                       <input type="radio" name="overload" class="optionsRadios1" readonly value="N" <?php if($fleet_trans->OVERLOAD=='N') { echo 'checked'; } ?>>&nbsp; &nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('overload', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">
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

                  
          </div><!-- /.box-body -->

          </div>

      </div>
       
    </div>
     
  </section>

   <section class="content">
    <div class="row">
     <!--  <div class="col-sm-2"></div> -->
      <div class="col-sm-9">
        <div class="box box-success Custom-Box">
         
          <div class="box-body">
             <div class="row">
                 
                <div class="col-md-4">
                     <div class="form-group">
                      <label>
                        Driver Exp : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="drv_exp" class="form-control" id="a2" placeholder="Enter Driver Exp" value="{{ $fleet_trans->DRIVER_EXP }}" onfocusout='calculate()' readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('drv_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                </div>

                <div class="col-md-4">
                     <div class="form-group">
                      <label>
                        Fooding Exp : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="fooding" class="form-control" placeholder="Enter Fooding Exp" value="{{ $fleet_trans->FOODING_EXP }}" onfocusout='calculate()' id="a4" readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('fooding', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                </div>

                <div class="col-md-4">
                     <div class="form-group">
                      <label>
                       Admin Exp : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="p_exp" class="form-control" placeholder="Enter P Exp" value="{{ $fleet_trans->ADMIN_EXP }}" id="a3" onfocusout='calculate()' readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('p_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                </div>
              </div>

              <div class="row"> 
                <div class="col-md-4">
                     <div class="form-group">
                      <label>
                        U-Loading Exp : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="lu_exp" class="form-control" placeholder="Enter LU Exp" value="{{ $fleet_trans->ULOADING_EXP }}" onfocusout='calculate()' id="a5" readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('lu_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                </div>

                <div class="col-md-4">
                     <div class="form-group">
                      <label>
                        Toll Exp : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="toll" class="form-control" placeholder="Enter Toll Exp" value="{{ $fleet_trans->TOLL_EXP }}" id="a6" onfocusout='calculate()' readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('toll', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                </div>
                
                <div class="col-md-4">
                     <div class="form-group">
                      <label>
                        Diesel Exp: 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="Disel" class="form-control" id="a1" placeholder="Enter Diesel Exp" value="{{ $fleet_trans->DIESEL_QTY }}" onfocusout='calculate()' readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('Disel', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                </div>
              </div>    

              <div class="row">
                <div class="col-md-4">
                     <div class="form-group">
                      <label>
                       Other Exp : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                          </span>
                       <input type="number" name="other_exp" class="form-control" placeholder="Enter Other Exp" value="{{ $fleet_trans->OTHER_EXP }}" id="a7" onfocusout='calculate()' readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('other_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                </div>

                <div class="col-md-4">
                     <div class="form-group">
                      <label>
                       Total Adv : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                          </span>
                  <input type="number" name="total_adv" id="total_adv" class="form-control" placeholder="Enter Total Adv" value="{{ $fleet_trans->TOTAL_ADV }}" id="TOTAL" readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('total_adv', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                </div>

                <div class="col-md-4">
                     <div class="form-group">
                      <label>
                       Meter Reading : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-tachometer" aria-hidden="true"></i>
                          </span>
                       <input type="text" name="METER_READING" class="form-control" placeholder="Enter Meter Reading" value="{{ $fleet_trans->METER_READING }}" id="meter_reading" readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('METER_READING', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                </div>
                  
              </div>
             
          </div><!-- /.box-body -->

          </div>

      </div>

      <div class="col-sm-3">
        <div class="box box-success Custom-Box">
         
          <div class="box-body">

            <div class="row">

              <div class="col-md-3" style="width: 100%;">
                     <div class="form-group">
                      <label>
                       Diesel Cr : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-flask" aria-hidden="true"></i>
                          </span>
                       <input type="text" name="DIESEL_CR" class="form-control" placeholder="Enter Diesel Cr" value="{{ $fleet_trans->DIESEL_CR }}" id="diesedl_cr" readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('DIESEL_CR', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>
            </div>

            <div class="row">
                  <div class="col-md-3" style="width: 100%;">
                     <div class="form-group">
                      <label>
                       Diesel Slip No : 
                        
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-file" aria-hidden="true"></i>
                          </span>
                       <input type="text" name="deisel_slip_no" class="form-control" placeholder="Enter Diesel Slip No" value="{{ $fleet_trans->DIESEL_SLIP_NO }}" id="diesel_slip_no" readonly> 
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('deisel_slip_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>
            </div>

            <div class="row">
                  <div class="col-md-3" style="width: 100%;">
                     <div class="form-group">
                      <label>
                       Disel Qty : 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </span>
                       <input type="text" name="DIESEL_QTY" class="form-control" placeholder="Enter Disel Quantity" value="{{ $fleet_trans->DIESEL_QTY }}" id="DIESEL_QTY" readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('DIESEL_QTY', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  </div>
            </div>

          </div>
        </div>
      </div>

       
    </div>
     
  </section>


  <section class="content">
    <div class="row">
     <!--  <div class="col-sm-2"></div> -->
      <div class="col-sm-7">
        <div class="box box-primary Custom-Box">

              

              
              <div class="box-body">
              
                  <div class="col-md-3">
                     <div class="form-group">
                      <label>
                       Damage Qty UM : 
                        
                      </label> 
                      <input type="hidden" name="fleet_id"  value="{{ $fleet_trans->id }}">
                       <input type="number" name="dmg_qty" class="form-control"  placeholder="Enter Damage Quantity" id="dmg_qty" value="<?php if(!empty($fleet_trans->DAMAGE_QTY)){ echo $fleet_trans->DAMAGE_QTY; } else{ echo '0';} ?>" >
                     <input type="hidden" name="" id="damagecfactor" value="">
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('dmg_qty', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      <small class="damage_err" style="color: red;"></small>
                      
                    </div>
                    <!-- /.form-group -->
                  
              </div>
              <div class="col-md-3">
                     <div class="form-group lbleRightBox">
                      <label>
                       UM : 
                        
                      </label>
                      
                          
                      <input type="text" class="form-control" id="damageUm" placeholder="Enter email" disabled="">
                     
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('DIESEL_QTY', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  
              </div>
              <div class="col-md-3">
                     <div class="form-group lbleRightBox">
                      <label>
                        Aqty AUM : 
                        
                      </label>
                      
                          
                      <input type="text" class="form-control Number" id="damg_aqty" name="damage_aqty" placeholder="Enter Damage AQuantity AUM" value="" readonly=''>
                     
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('DIESEL_QTY', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                      
                    </div>
                    <!-- /.form-group -->
                  
              </div>
              <div class="col-md-3">
                     <div class="form-group lbleRightBox">
                      <label>
                       AUM: 
                        
                      </label>
                      
                          
                       <input type="number" class="form-control" id="damageAum" placeholder="Enter AUM" disabled="">
                     
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('DIESEL_QTY', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  
              </div>
          </div>

              
             <div class="box-body">
              
                  <div class="col-md-3">
                     <div class="form-group">
                      <label>
                       Shortage Qty UM 
                        
                      </label> 
                      <input type="hidden" name="fleet_id"  value="{{ $fleet_trans->id }}">
                        <input type="number" name="shortage_qty" class="form-control" id="shortage_qty" placeholder="Enter Shortage Qty" value="<?php if(!empty($fleet_trans->SHORTAGE_QTY)){ echo $fleet_trans->SHORTAGE_QTY; } else{ echo '0';} ?>">
                     
                     
                      <small class="shortag_err" style="color:red;">
                        
                      </small>
                    </div>
                    <!-- /.form-group -->
                  
              </div>
              <div class="col-md-3">
                     <div class="form-group lbleRightBox">
                      <label>
                       UM : 
                        
                      </label>
                      
                          
                        <input type="text" class="form-control" id="sortUm" placeholder="Enter UM" disabled="">
                     
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('DIESEL_QTY', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  
              </div>
              <div class="col-md-3">
                     <div class="form-group lbleRightBox">
                      <label>
                        Aqty AUM : 
                        
                      </label>
                      
                       <input type="hidden" name="" id="sortcfactor" value="">  
                       <input type="text" class="form-control Number" id="sort_aqty" name="sort_aqty" placeholder="Enter Sort Quantity AUM" value="" readonly=''>
                     
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('DIESEL_QTY', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  
              </div>
              <div class="col-md-3">
                     <div class="form-group lbleRightBox">
                      <label>
                       AUM: 
                        
                      </label>
                      
                          
                      <input type="text" class="form-control" id="sortAum" placeholder="Enter AUM" disabled="" >
                     
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('DIESEL_QTY', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  
              </div>
          </div>

          <div class="box-body">
              
                  <div class="col-md-3">
                     <div class="form-group">
                      <label>
                       Recevied Qty UM 
                        
                      </label> 
                     
                         <input type="number" name="recvd_qty"  value="{{ $fleet_trans->UM }}" id="recvd_qty" class="form-control" readonly>
                        <input type="hidden" name="const_rcv_qty" id="const_rcv_qty" value="{{ $fleet_trans->UM }}">
                     
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('dmg_qty', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  
              </div>
              <div class="col-md-3">
                     <div class="form-group lbleRightBox ">
                      <label>
                       UM : 
                        
                      </label>
                      
                     <input type="text" class="form-control" id="recivdUm"  name="recivdUm" placeholder="Enter UM" readonly="">
                     
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('um', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  
              </div>
              <div class="col-md-3">
                     <div class="form-group lbleRightBox">
                      <label>
                        Aqty AUM : 
                        
                      </label>
                      
                          
                        <input type="text" class="form-control Number" id="recd_aqty" name="aqty_recd" placeholder="Enter Recived AQuantity AUM" value="{{ $fleet_trans->AUM }}" readonly=''>
                     
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('DIESEL_QTY', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  
              </div>
              <div class="col-md-3">
                     <div class="form-group lbleRightBox">
                      <label>
                       AUM: 
                        
                      </label>
                      
                          
                       <input type="text" class="form-control" id="recivdAum" name="recivdAum" placeholder="Enter AUM" readonly="">
                     
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('DIESEL_QTY', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      
                    </div>
                    <!-- /.form-group -->
                  
              </div>
          </div>
             

              
          </div>

      </div>


<div class="col-sm-5 lastrightbox">
        <div class="box box-primary Custom-Box">

              <div class="box-body setleftcalblock">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label setlable setlableRight">Fright Amount :</label>
                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-money" aria-hidden="true"></i>
                        </span>
                        <input type="text" name="fright_amt" id="fright_amt" class="form-control Number"  placeholder="Enter Fright Amount" value="<?php if(!empty($fleet_trans->FRIGHT_AMT)){ echo $fleet_trans->FRIGHT_AMT; } else{ echo '';} ?>" readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('fright_amt', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                    </div>
                  </div>
              </div>

              <div class="box-body setleftcalblock">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label setlable setlableRight">Additional Exp :</label>
                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                        </span>
                        <input type="text" name="addl_exp" id="addl_exp" class="form-control Number" placeholder="Enter Additional Exp" value="<?php if(!empty($fleet_trans->ADDL_EXP)){ echo $fleet_trans->ADDL_EXP; } else{ echo '';} ?>"  >
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('addl_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                    </div>
                  </div>
              </div>
               <div class="box-body setleftcalblock">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label setlable">Adt Exp Rem :</label>
                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-thumb-tack" aria-hidden="true"></i>
                        </span>
                        <input type="text" name="addl_exp_remark" class="form-control" placeholder="Enter Additional Exp Remark" value="<?php if(!empty($fleet_trans->ADDL_EXP_REMARK)){ echo $fleet_trans->ADDL_EXP_REMARK; } else{ echo '';} ?>" >
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('addl_exp_remark', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                    </div>
                  </div>
              </div>
              <div class="box-body setleftcalblock">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label setlable">Sub-Total :</label>
                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                        </span>
                        <input type="text" name="sub_total" id="sub_total" class="form-control Number"  placeholder="Enter Sub Total" value="<?php if(!empty($fleet_trans->SUB_TOTAL)){ echo $fleet_trans->SUB_TOTAL; } else{ echo '';} ?>" readonly="">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('sub_total', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                    </div>
                  </div>
              </div>

              <!-- <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label setlable">Service Rate :</label>
                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                        </span>
                        <input type="text" name="service_amt" id="service_amt" class="form-control Number" placeholder="Enter Service Amount" value="< ?php if(!empty($fleet_trans->SERVICE_AMT)){ echo $fleet_trans->SERVICE_AMT; } else{ echo '';} ?>"  >
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('service_amt', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                    </div>
                  </div>
              </div> -->

              <div class="box-body setleftcalblock">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label setlable" style="padding-right: 10px;">Service Charge :</label>
                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                        </span>
                        
                        <input type="text" name="service_chrge" class="form-control Number" id="service_chrge" placeholder="Enter Service Charge" value="<?= $servicechrg->service_charge ?>" readonly=''>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('service_chrge', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                    </div>
                  </div>
              </div>


              <div class="box-body setleftcalblock">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label setlable">TDS Rate :</label>
                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                        </span>
                        <input type="text" name="tds_rate" class="form-control Number" id="tds_rate" placeholder="Enter TDS Rate" value="<?php if(!empty($fleet_trans->TDS_RATE)){ echo $fleet_trans->TDS_RATE; } else{ echo '';} ?>" >
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('total_adv', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                    </div>
                  </div>
              </div>

              <div class="box-body setleftcalblock">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label setlable">TDS Amount :</label>
                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                        </span>
                        <input type="text" name="tds_amt" id="tds_amt" class="form-control" placeholder="Enter TDS Amount" value="<?php if(!empty($fleet_trans->TDS_AMT)){ echo $fleet_trans->TDS_AMT; } else{ echo '';} ?>" readonly=''>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('tds_amt', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                    </div>
                  </div>
              </div>

              <div class="box-body setleftcalblock">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label setlable">Stamp :</label>
                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-gavel" aria-hidden="true"></i>
                        </span>
                        <select class="form-control selectlable" name="Stamp" id="Stamp">
                          <option value="">--SELECT--</option>
                          <option value="YES" <?php if(!empty($fleet_trans->STAMP && $fleet_trans->STAMP=='YES')){ echo 'selected'; } else{ echo '';} ?>>YES</option>
                          <option value="NO" <?php if(!empty($fleet_trans->STAMP && $fleet_trans->STAMP=='NO')){ echo 'selected'; } else{ echo '';} ?>>NO</option>
                        </select>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('Stamp', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                    </div>
                  </div>
              </div>


              <div class="box-body setleftcalblock">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label setlable" style="padding-right: 9px;">Stamp Charges :</label>
                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-gavel" aria-hidden="true"></i>
                        </span>
                        <input type="text" name="stamp_charge"  class="form-control" id="stamp_charge" value="<?php if(!empty($fleet_trans->STAMP_CHARGES)){ echo $fleet_trans->STAMP_CHARGES; } else{ echo '';} ?>" placeholder="Enter Stamp Charge ">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('Stamp', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                    </div>
                  </div>
              </div>


              <div class="box-body">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-5 control-label setlable">Net Payment :</label>
                    <div class="col-sm-7">
                      <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-calculator" aria-hidden="true"></i>
                        </span>
                        <input type="hidden" name="LR_REC_DATE" value="{{$tr_date}}">
                        <input type="text" name="net_payment" class="form-control" id="net_payment" placeholder="Enter Net Payment" value="<?php if(!empty($fleet_trans->NET_PAYMENT)){ echo $fleet_trans->NET_PAYMENT; } else{ echo '';} ?>" readonly>
                      </div>
                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('net_payment', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                    </div>
                  </div>
              </div>
         

          </div>

      </div>
       
    </div>


     
  </section>


  <div class="box-body">
    <div style="text-align: center;
    margin-bottom: 5%;">
                   <button type="Submit" id="updatebtn" class="btn btn-primary">
                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 
                   </button>
       </div>
     </div>

 </form>
</div>

@include('admin.include.footer')

<script type="text/javascript">

$(document).ready(function(){

   var qty = $("#stoqtyum").val();
   var rate = $("#rate").val();

   var frght_rate= parseFloat(qty) * parseFloat(rate);

if(qty!=''){
  $("#fright_amt").val(frght_rate);
}else{
  $("#fright_amt").val('');
}
    
});
</script>
<script type="text/javascript">
  $(document).ready(function(){

  $("#service_amt").on('input', function() {  

          var service_amt = $(this).val();

          var sub_total = $("#sub_total").val();
          var net_pay = $("#net_payment").val();
          var tds_rate = $("#tds_rate").val();
          var tds_amt = $("#tds_amt").val();

          if(service_amt==''){
            $("#tds_rate").val('');
            $("#tds_amt").val('');
            $("#net_payment").val(sub_total);
          }
          /*if(service_amt=='' && tds_rate!=''){

            var net_pay = parseFloat(sub_total) -parseFloat(tds_amt);
            $("#net_payment").val(net_pay);

          }*/

           if(service_amt!=''){


            var service_chrge = parseFloat((service_amt / 100) * sub_total);

            var fixservieCharg = service_chrge.toFixed(2);

            /*console.log(service_chrge);*/
            $("#service_chrge").val(fixservieCharg);

            var net_pay = parseFloat(sub_total) -parseFloat(fixservieCharg);
            $("#net_payment").val(net_pay);


          }else{

            $("#service_chrge").val('');
          }

          
      });

});

</script>


<script type="text/javascript">
  $(document).ready(function(){

  $('#shortage_qty').on('input', function(event) {
      
        var dmg_qty = $("#dmg_qty").val();
        var shortage_qty = $(this).val();
        var recvd_qty = $("#recvd_qty").val();
        var getum = $('#stoqtyum').val();
        var const_rcv_qty = $("#const_rcv_qty").val();
        var cFactor = $("#cfator").val();
        var rate = $("#rate").val();

        var result = shortage_qty*cFactor;
       
       if(shortage_qty==''){

        var additon = parseFloat(const_rcv_qty) - parseFloat(dmg_qty);

      console.log(additon);
        $('#recvd_qty').val(additon);
       }
        if(shortage_qty!='' && shortage_qty!= null){
         var additon = parseFloat(dmg_qty) + parseFloat(shortage_qty);
          //console.log('additon ',additon);
            if(parseFloat(additon) > parseFloat(getum)){
              $(".shortag_err").html('Shortage qty + damage qty not greter than quantity');
              $('#recvd_qty').val('');
            }else if(parseInt(shortage_qty) > parseInt(getum)){
               $(".shortag_err").html('Shortage qty not greter than quantity');
                $("#fright_amt").val('');
                $('#recvd_qty').val('');
            }
            else{
              $(".shortag_err").html('');
            }

           var dmgnrecv = parseFloat(const_rcv_qty) - parseFloat(shortage_qty); 
           $('#recvd_qty').val(dmgnrecv);

           var recvd_qty_aum = cFactor * dmgnrecv;

           $("#recd_aqty").val(recvd_qty_aum);

           var frightAmt =  dmgnrecv * rate;
            $("#fright_amt").val(frightAmt);
      }else{

        var additon = parseFloat(recvd_qty) - parseFloat(dmg_qty);
        if ( shortage_qty.length > 0 )
      {
        console.log('shrt add + ',parseFloat(additon));
      }else{

       console.log('shrt add - ',parseFloat(additon));
       //$("#recd_aqty").val(parseFloat(additon));

      document.getElementById("recvd_qty").value = "000";
      }
        
        
      }


      /*if(parseInt(shortage_qty) > parseInt(getum)){
        $(".shortag_err").html('Shortage qty not greter than quantity');
        $("#fright_amt").val('');
        $('#recvd_qty').val('');
      }else {
        $(".shortag_err").html('');

      }*/

     if(dmg_qty!=''){

        var dmgnrecv = parseFloat(const_rcv_qty) - parseFloat(dmg_qty) - parseFloat(shortage_qty);
          $('#recvd_qty').val(dmgnrecv);

          var recvd_qty_aum = cFactor * dmgnrecv;

            $("#recd_aqty").val(recvd_qty_aum);

              var frightAmt = dmgnrecv * rate;
            $("#fright_amt").val(frightAmt);

          if(parseFloat(shortage_qty) > parseFloat(getum)){
              $("#shortag_err").html('Shortage qty not greter than quantity');
              $("#fright_amt").val('');
            }else {
              $("#shortag_err").html('');

            }

          }else{
            $('#recvd_qty').val('');
          }

       if(shortage_qty<0){

               alert('Pleas Select More Than 0 Quantity');

               $("#shortage_qty").val('0');

               $("#shortage_qty").val('');

            }else{

               $("#sort_aqty").val(result);

            }
    
    });

  $('#dmg_qty').on('input', function(event) {
      
        var dmg_qty = $("#dmg_qty").val();
        var shortage_qty = $("#shortage_qty").val();
        var getum = $('#stoqtyum').val();
        var recvd_qty = $("#recvd_qty").val();
        var const_rcv_qty = $("#const_rcv_qty").val();
        var cFactor = $("#cfator").val();
        var result = dmg_qty*cFactor;
        var rate = $("#rate").val();

        

      if(dmg_qty!='' && dmg_qty!= null){
         var additon = parseFloat(dmg_qty) + parseFloat(shortage_qty);
         console.log('dmg additon ',additon);
            if(additon  > getum){
              $(".damage_err").html('Shortage qty + damage qty not greter than quantity');
              $("#fright_amt").val('');
                    $('#recvd_qty').val('');

            }else if(parseFloat(dmg_qty) > parseFloat(getum)){

              $(".damage_err").html('Damage qty not greter than quantity');
                $("#fright_amt").val('');
                        $('#recvd_qty').val('');
            }
            else{
              $(".damage_err").html('');
            }


        var dmgnrecv = parseFloat(const_rcv_qty) - parseFloat(dmg_qty);

         $('#recvd_qty').val(dmgnrecv);

          var recvd_qty_aum = cFactor * dmgnrecv;
          $("#recd_aqty").val(recvd_qty_aum);

            var frightAmt = dmgnrecv * rate;
        $("#fright_amt").val(frightAmt);
       }
       else{

        var additon = parseFloat(recvd_qty) - parseFloat(shortage_qty);
        console.log('dmg add ',additon);
        $("#recd_aqty").val(additon);
      }

       if(parseFloat(dmg_qty) > parseFloat(getum)){
        $("#damage_err").html('Damage qty not greter than quantity');
        $("#fright_amt").val('');
        $("#recd_aqty").val('');
      }else {
        $("#damage_err").html('');
        
      }
       if(shortage_qty!=''){

          var dmgnrecv = parseFloat(const_rcv_qty) - parseFloat(dmg_qty) - parseFloat(shortage_qty);
          $('#recvd_qty').val(dmgnrecv);

          var recvd_qty_aum = cFactor * dmgnrecv;

          $("#recd_aqty").val(recvd_qty_aum);

           var frightAmt =  dmgnrecv * rate;
        $("#fright_amt").val(frightAmt);
         }

         if(dmg_qty<0){

               alert('Pleas Select More Than 0 Quantity');

               $("#damg_aqty").val('0');

               $("#damg_aqty").val('');

            }else{

               $("#damg_aqty").val(result);

            }

  
      

    });

  });
   
 </script>



<script type="text/javascript">
  
  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      orientation: 'bottom',
      todayHighlight: 'true',
      endDate:'today'
    });
});
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

      $("#dept_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 

      });

      $("#acct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

      });

      $("#area_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#areaList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("areaText").innerHTML = msg; 

        });

      $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("itemText").innerHTML = msg; 

        });

       $("#trans_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#transList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("transText").innerHTML = msg; 

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


    });

</script>
<script type="text/javascript">
  $(document).ready(function(){
        $( window ).on( "load", function() {
            //console.log($('#item_code').val());

           $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
           });

           var item_code = $('#item_code').val();
           //console.log(item_code);

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

                          $('#recivdUm').val(data1.data[0].um_code);
                          $('#recivdAum').val(data1.data[0].aum);
                          $('#recivdcfactor').val(data1.data[0].aum_factor);

                          $('#sortUm').val(data1.data[0].um_code);
                          $('#sortAum').val(data1.data[0].aum);
                          $('#sortcfactor').val(data1.data[0].aum_factor);


                          $('#damageUm').val(data1.data[0].um_code);
                          $('#damageAum').val(data1.data[0].aum);
                          $('#damagecfactor').val(data1.data[0].aum_factor);
                        }

                }
              
            
           }

        });

    });
     });
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
  $(document).ready(function(){

  //.... * Start: Get Net-Payment On Page Load*......//

    var fringhtAmount = parseFloat($('#fright_amt').val());
    var servcCharg = parseFloat($('#service_chrge').val());

    var netPay = fringhtAmount - servcCharg;

    $('#net_payment').val(netPay);

  //.... * End: Get Net-Payment On Page Load*......//


  /* .......Start: TDS Exp Calculation.........*/

  $('#tds_rate').on('input',function(){

    var TdsRate   = parseFloat($(this).val());
    var AddlExp   = parseFloat($('#addl_exp').val());
    var AddlExpZ  = parseFloat(0);
    var FrightAmt = parseFloat($('#fright_amt').val());
    var ServChar  = parseFloat($('#service_chrge').val());
    var SubTotGet = parseFloat($('#sub_total').val());
    var StampChrg = parseFloat($('#stamp_charge').val());
    
    var TdsAmtZ   = parseFloat(0);
    var ServCharZ = parseFloat(0);
    var SubTot    = '';
    var NetPay    = '';
    var StampChrgn = '';

    var getTdsAmount = FrightAmt * TdsRate / 100;

    $('#tds_amt').val(getTdsAmount);

    var TdsAmt    = parseFloat($('#tds_amt').val());

      if (TdsAmt == '' || isNaN(TdsAmt)) {

        if (SubTotGet == '' || isNaN(SubTotGet)) {

          SubTot = FrightAmt;

        }else{

          SubTot = SubTotGet;
        }

        if (StampChrg == '' || isNaN(StampChrg)) {

          StampChrgn = 0;

        }else{

          StampChrgn = StampChrg;

        }

        NetPay = SubTot - ServChar - StampChrgn;

        $('#tds_amt').val('');

        $('#net_payment').val(NetPay);

      }else{

        if (SubTotGet == '' || isNaN(SubTotGet)) {

          SubTot = FrightAmt;

        }else{

          SubTot = SubTotGet;
        }

        if (StampChrg == '' || isNaN(StampChrg)) {

          StampChrgn = 0;

        }else{

          StampChrgn = StampChrg;

        }

        NetPay = SubTot - ServChar - TdsAmt - StampChrgn;

        $('#net_payment').val(NetPay);

      }

      


  });


  /* .......End: TDS Exp Calculation.........*/



  /* .......Start: Additional Exp Calculation.........*/

    $('#addl_exp').on('input',function(){
        
      var AddlExp   = parseFloat($(this).val());
      var AddlExpZ  = parseFloat(0);
      var FrightAmt = parseFloat($('#fright_amt').val());
      var ServChar  = parseFloat($('#service_chrge').val());
      var TdsAmt    = parseFloat($('#tds_amt').val());
      var StampChrg = parseFloat($('#stamp_charge').val());
      var TdsAmtZ   = parseFloat(0);
      var ServCharZ = parseFloat(0);
      var SubTot    = '';
      var NetPay    = '';
      var StampChrgn = '';
      var TdsAmtN = '';
      var SubTotN = '';

     console.log('TDS AMT => ',TdsAmt);

      if (AddlExp == '' || isNaN(AddlExp)) {
        

        if (TdsAmt == '' || isNaN(TdsAmt)) {

          TdsAmtN = 0;

        }else{

          TdsAmtN = TdsAmt;
        }

        if (StampChrg == '' || isNaN(StampChrg)) {

          StampChrgn = 0;

        }else{

          StampChrgn = StampChrg;

        }

        $('#sub_total').val('');

        NetPay = FrightAmt - ServChar - TdsAmtN - StampChrgn;

        $('#net_payment').val(NetPay);

      }else{

        if (TdsAmt == '' || isNaN(TdsAmt)) {

          TdsAmtN = 0;

        }else{

          TdsAmtN = TdsAmt;
        }

        if (StampChrg == '' || isNaN(StampChrg)) {

          StampChrgn = 0;

        }else{

          StampChrgn = StampChrg;

        }

        SubTot = FrightAmt + AddlExp;

        if(isNaN(SubTot) || SubTot ==''){

          SubTotN = 0;

        }else{

          $('#sub_total').val(SubTot);

          SubTotN = SubTot;

        }

        NetPay = SubTotN - ServChar - TdsAmtN - StampChrgn;

        console.log('NetPay => ',NetPay);
        console.log('SubTotN => ',SubTotN);
        console.log('ServChar => ',ServChar);
        console.log('TdsAmtN => ',TdsAmtN);
        console.log('StampChrgn => ',StampChrgn);

        $('#net_payment').val(NetPay);

      }

     
      


    });


  /* .......End: Additional Exp Calculation.........*/


 
  /* .......Start: STAMP Charges Exp Calculation.......*/

    $('#Stamp').on('change',function(){

      var stampvalue = $('#Stamp').val();

      var AddlExp   = parseFloat($('#addl_exp').val());
      var AddlExpZ  = parseFloat(0);
      var FrightAmt = parseFloat($('#fright_amt').val());
      var ServChar  = parseFloat($('#service_chrge').val());
      var TdsAmt    = parseFloat($('#tds_amt').val());
      
      var SubTotGet = parseFloat($('#sub_total').val());
      var TdsAmtZ   = parseFloat(0);
      var ServCharZ = parseFloat(0);
      var SubTot    = '';
      var NetPay    = '';
      var StampChrgn = '';
      var TdsAmtN = '';
      var SubTotN = '';
        
        if(stampvalue == 'YES'){

          $('#stamp_charge').prop( "disabled", true );
          $('#stamp_charge').val('');

          var StampChrg = parseFloat($('#stamp_charge').val());

          if (TdsAmt == '' || isNaN(TdsAmt)) {

            TdsAmtN = 0;

          }else{

            TdsAmtN = TdsAmt;
          }

          if (SubTotGet == '' || isNaN(SubTotGet)) {

            SubTotN = FrightAmt;

          }else{

            SubTotN = SubTotGet;

          }

          StampChrgn = 0;

          var StChr = StampChrgn;

          NetPay = SubTotN - ServChar - TdsAmtN - StChr;

          $('#net_payment').val(NetPay);


        }else{

          $('#stamp_charge').prop( "disabled", false );
          $('#stamp_charge').val(200);

          var StampChrg = parseFloat($('#stamp_charge').val());

          if (TdsAmt == '' || isNaN(TdsAmt)) {

            TdsAmtN = 0;

          }else{

            TdsAmtN = TdsAmt;
          }

          if (SubTotGet == '' || isNaN(SubTotGet)) {

            SubTotN = FrightAmt;

          }else{

            SubTotN = SubTotGet;

          }


          var StChr = StampChrg;

          NetPay = SubTotN - ServChar - TdsAmtN - StChr;

          $('#net_payment').val(NetPay);

        }


        


    });
    

  /* .......End: STAMP Charges Exp Calculation.......*/


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


@endsection