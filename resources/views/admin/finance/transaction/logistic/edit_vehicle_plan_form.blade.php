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
  .showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }


.rdate{

  text-align:right;


}

::placeholder {
  
  text-align:left;
}

.showinmobile{
  display: none;
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

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

             Vehicle Planing
 
            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Logistics</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Add Vehicle Planing</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

     

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Vehicle Planing</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-fleet') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Vehicle Planing</a>

              </div>

              

                  <div class="box-tools pull-right">

                    <a href="{{ url('/view-vehicle-planing-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Vehicle Planing</a>

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

            <form action="{{url('Vehicle-Planing-Update') }}" method="post">

               @csrf

               <div class="row">

                      <!-- /.col -->
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                              
                              <input type="text" class="form-control transdatepicker" name="vr_date" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off" onchange="vrDate()" readonly>

                              <input type="hidden" name="vehicalPlanId" value="{{$vehicalID}}">

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

                              <input type="text" class="form-control" name="trans_code" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                              <input type="hidden" id="transtaxCode" >

                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                        </div>
                            <!-- /.form-group -->
                      </div>
                        <!-- /.col -->
                      <div class="col-md-3">

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
                              <?php $sriescount =  count($series_list); ?>
                            <input list="seriesList1"  id="series_code" name="series_code" class="form-control  pull-left" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();">

                            <datalist id="seriesList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($series_list as $key)

                                <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                              @endforeach

                            </datalist>

                          </div>

                          <small id="series_code_errr" style="color: red;"></small>

                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->

                      <div class="col-md-4">

                        <div class="form-group">

                          <label> Series Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>


                              <input type="text" class="form-control" name="series_name" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>
                      <!-- /.col -->

                    </div>
                    <!-- /.row -->

                    <div class="row">
            
                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Vr No: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="hidden" name="" value="{{$to_num}}" id="vr_last_num">

                            <input type="text" class="form-control" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                         </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                               </span>
                              <?php $plcount = count($plant_list); ?>
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>" readonly autocomplete="off" onchange="PlantCode()">

                              <datalist id="PlantcodeList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($plant_list as $key)

                                <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small>  

                                <div class="pull-left showSeletedName" id="plantText"></div>

                            </small>

                            <small id="plant_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-4">

                        <div class="form-group">

                          <label> Plant Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="plant_name" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME;}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>


                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Profit Center Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <input type="text"  id="profitctrId" name="pfct_code" class="form-control  pull-left" placeholder="Select Profit Center Code"  readonly >


                            </div>

                          <small id="profit_center_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      
                    </div> <!-- row -->

               <div class="row">

                   <div class="col-md-3">

                        <div class="form-group">

                          <label> Profit Center Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="pfct_name" id="pfctName" placeholder="Enter Profit Center Name" readonly>

                            </div>

                        </div>
                        
                    </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       Delivery No: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          
                          <input list="deliveryList" class="form-control" name="do_no" id="do_no"  value="{{ $delivery_no}}" placeholder="Enter Do No" onchange="getDoDetials()" autocomplete="off"   />

                          <datalist id="deliveryList">

                            <?php foreach($do_list as $key) { ?>

                            <option value="<?= $key->DORDER_NO ?>" data-xyz="<?= $key->DORDER_NO ?>"><?= $key->DORDER_NO ?></option>

                            <?php } ?>
                            
                          </datalist>

                      </div>



                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('do_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Vehicle No : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="vehicleList" class="form-control" name="vehicle_no" id="vehicle_no" value="{{ $vehicle_no }}" placeholder="Enter Vehicle No" maxlength="13" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                            <datalist id="vehicleList">
                              
                              <?php foreach ($vehicle_list as $key) { ?>
                                
                              <option value="<?= $key->TRUCK_NO ?>" data-xyz="<?= $key->TRUCK_NO ?>"><?= $key->TRUCK_NO ?></option>

                              <?php   } ?>

                            </datalist>

                           
                          

                           
                        </div>

                        <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                          
                            </div>  
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>


                   <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Transporter Code: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input list="transportList" class="form-control" name="transporter_code"  value="{{ $trans_code }}" id="transporter_code" placeholder="Enter Transporter" autocomplete="off">

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

                  </div>

                  




                  

                <!-- /.col -->

                

              </div>

            
              <!-- /.row -->


              <div class="row">


                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Transporter Name: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control" name="transporter_name" id="transporter_name"  value="{{$trans_name}}" placeholder="Enter Transporter" autocomplete="off">

                            

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('transporter', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                
                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       From Place: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="fromplaceList" class="form-control" name="from_place" id="from_place"  value="{{ $from_place }}" placeholder="Enter From Place" autocomplete="off"/>

                          <datalist id="fromplaceList">

                            <?php foreach ($area_list as $key) { ?>

                              <option value="<?= $key->AREA_CODE ?>" data-xyz="<?= $key->AREA_NAME ?>"><?= $key->AREA_CODE ?> [<?= $key->AREA_NAME ?>]</option>

                            <?php } ?>
                            
                            
                          </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('from_place', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        To Place: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>


                          <input list="toplaceList"  id="to_place" name="to_place" class="form-control pull-left" value="{{ $to_place }}" placeholder="Enter To Place" autocomplete="off">

                           <datalist id="toplaceList">

                            <?php foreach ($area_list as $key) { ?>

                              <option value="<?= $key->AREA_CODE ?>" data-xyz="<?= $key->AREA_NAME ?>"><?= $key->AREA_CODE ?> [<?= $key->AREA_NAME ?>]</option>

                            <?php } ?>
                            
                            
                          </datalist>
                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('to_place', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                       <small>
                          <!-- <div class="pull-left showSeletedName" id="makeText"></div> -->
                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
               

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Item : 

                        <span class="required-field"></span>

                      </label>

                         <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-cog" aria-hidden="true"></i>
                          </span>

                        <input list="itemList"  id="item_code" name="item_code" class="form-control" value="{{$item_code}}" placeholder="Select Item" onchange="getItemUm();getItemQty();" autocomplete="off">

                        <datalist id="itemList">

                          <?php foreach($item_list as $key) { ?>
                            
                          <option value="<?= $key->ITEM_CODE ?>" data-xyz="<?= $key->ITEM_NAME ?>"><?= $key->ITEM_CODE ?> <?= $key->ITEM_NAME ?></option>

                           <?php  } ?>
                          
                        </datalist>


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small>
                          <div class="pull-left showSeletedName" id="wheelText"></div>
                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                 

              </div>

              <div class="row">
                

                 <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Qty : 

                        <span class="required-field"></span>

                      </label>

                         <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-cog" aria-hidden="true"></i>
                          </span>

                        <input type="text"  id="qty" name="qty" class="form-control" value="{{$qty}}" placeholder="Select Date" autocomplete="off">
                       

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small>
                          <div class="pull-left showSeletedName" id="wheelText"></div>
                      </small>

                    </div>


                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-1">

                    <div class="form-group">

                      <label>

                        UM : 

                        <span class="required-field"></span>

                      </label>

                         <div class="input-group">

                        <input type="text"  id="um_code" name="um_code" class="form-control" value="{{$um}}" autocomplete="off">
                       

                      </div>

                    

                      <small>
                          <div class="pull-left showSeletedName" id="wheelText"></div>
                      </small>

                    </div>

                   
                    <!-- /.form-group -->

                  </div>
                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       Purchase Fright Order : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="fright_order" class="form-control" value="{{ $fright_order }}" placeholder="Enter Fright Order" autocomplete="off">


                        <datalist>
                          <?php foreach ($fpo_list as $key) {


                                        $vrNo = $key->VRNO;
                              
                                        $SericeCode = $key->SERIES_CODE;
                                        
                                        $FyYr = $key->FY_CODE;

                                        $getYr = explode("-",$FyYr);

                                        $BgYr = $getYr[0];

                                        $newVrNo = $BgYr.' '.$SericeCode.' '.$vrNo;

                           ?>
                          
                              <option value="<?= $newVrNo ?>"><?= $newVrNo ?></option>

                          <?php  } ?>
                        </datalist>

                         <input type="hidden" name="vehicleId" value="{{ $vehicleId }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fright_order', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Rate : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="rate"  id="rate" class="form-control" placeholder="Enter Rate" autocomplete="off" value="{{$rate}}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    
                    
                    <button type="button" class="btn btn-primary btn-sm" style="margin-top: 10px;" data-toggle="modal" data-target="#ratevalueModal">Rate Calc</button>


                    <div class="modal fade" id="ratevalueModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Rate</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                           <div class="row">

                             <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                    Adv Type : 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="typeList" class="form-control" name="adv_type" id="adv_type"  value="{{$advType}}" placeholder="Select Adv Type" autocomplete="off"/>

                                      <datalist id="typeList">

                                        <option value="Lumsum">Lumsum</option>
                                        <option value="Percent">Percent</option>
                                        <option value="Qty">Qty</option>
                                        
                                      </datalist>

                                  </div>
                                   <input type="hidden" id="advtype" name="advtype" value="{{$advType}}">

                      

                                </div>

                                <!-- /.form-group -->

                              </div>

                             <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Adv Rate:<span class="required-field" id="compc_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="adv_rate" id="adv_rate"  value="{{$advRate}}" placeholder="Enter Adv Rate"  autocomplete="off" />

                                      <input type="hidden" name="advcal_rate" id="advcal_rate">
                                      <input type="hidden" name="advrate" id="advrate" value="{{$advRate}}">
                                  </div>

                                 
                                </div>

                                <!-- /.form-group -->

                              </div>

                               <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                    Adv Amount : 

                                    <span class="required-field" id="compn_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="adv_amount"  placeholder="Enter Adv Amount" id="adv_amount"  autocomplete="off" value="{{$advAmt}}"readonly="" />

                                  </div>
                                  <input type="hidden" id="advAmount" value="{{$advAmt}}" name="advAmount">


                                
                                  <small id="comp_nameErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>


                              
                              


                          </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="addFunAdvRate();">Save changes</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                
                
              </div>

            

              <div style="text-align: center;">


                 <button type="submit" class="btn btn-primary">

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{ $button }} 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

     


    </div>

     

  </section>

</div>



@include('admin.include.footer')

<script type="text/javascript">

  $( window ).on( "load", function() {

        getvrnoBySeries();
        
        var vr_date = $('#vr_date').val();

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var Plant_code =  $('#Plant_code').val();

      //  alert(Plant_code);
       // console.log(Plant_code);
          $.ajax({

            url:"{{ url('get-pfct-code-name-by-plant-indend') }}",

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
               
                  if(data1.data == ''){
                       var profitctr = '';
                       var pfctget = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctCode').val(pfctget);
                       $('#getPfctName').val(pfctName);
                    }else{

          
                      $('#profitctrId').val(data1.data[0].PFCT_CODE);
                      $('#pfctName').val(data1.data[0].PFCT_NAME);
                      $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                      $('#getPfctName').val(data1.data[0].PFCT_NAME);

                    }

                }

            }

          });

    });

  function ownerselect(val){

    if(val=='MARKET'){

      $("#compc_req").hide();
      $("#compn_req").hide();
      $("#cost_req").hide();

    }else{
      $("#compc_req").show();
      $("#compn_req").show();
      $("#cost_req").show();
    }



  }

  function addFunAdvRate(){
    

     var adv_type = $('#adv_type').val();
     var adv_rate = $('#adv_rate').val();
     var adv_amount = $('#adv_amount').val();

     if(adv_type){

      $('#advtype').val(adv_type);

     }
     if(adv_rate){
      $('#advrate').val(adv_rate);

     }
     if(adv_amount){
       $('#advAmount').val(adv_amount);

     }else{

     }
    $("#ratevalueModal").modal('hide');
  }

  

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
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.truck_no+'</span><br>');
                         });
                        
                  }
             }

          });
       }

    });

    $("body").click(function() {
        $("#showSearchCodeList").hide("fast");
    });
  });

  $(document).ready(function(){
     $('body').on('click', '#closeModel', function () {
          $('.popover').fadeOut();
    })
  });

  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
  });


  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      endDate: 'today',
      
      autoclose: 'true'

    });

});


$(document).ready(function(){

  $("#adv_type").on('change', function () {  

          var val = $(this).val();
          var qty = $("#qty").val();
          var rate = $("#rate").val();

       

          if(val=='Lumsum'){

            $("#adv_amount").prop('readonly', false);
            $("#adv_rate").prop('readonly', true);
          }else{
            $("#adv_amount").prop('readonly', true);
            $("#adv_rate").prop('readonly', false);
          } 

          if(val=='Percent'){

              var calrate = parseFloat(qty) * parseFloat(rate)/100;

                $("#advcal_rate").val(calrate);
            }

          var xyz = $('#typeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $("#adv_rate").val('');
             $("#adv_amount").val('');

          }else{

             $("#transporter_name").val(msg);
          } 

        });


     $("#adv_rate").on('input', function () {  

            var val         = $(this).val();
            var adv_type    = $("#adv_type").val();
            var qty    = $("#qty").val();
           
           
            
            if(adv_type=='Percent'){

               var calrate     =   $("#advcal_rate").val();
               var advance_amt =parseFloat(val)/100 * parseFloat(calrate);
               $("#adv_amount").val(advance_amt);
            }else if(adv_type=='Qty'){

              var calamt = qty * val;
              
              $("#adv_amount").val(calamt);

            }
           



     });



      $("#transporter_code").on('change', function () {  

          var val = $(this).val();


          alert(val);

          var xyz = $('#transportList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $("#transporter_code").val('');
             $("#transporter_name").val('');

          }else{

             $("#transporter_name").val(msg);
          } 

        });



        $("#do_no").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#deliveryList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

         if(msg=='No Match'){

             $(this).val('');
         }

        });

        $("#vehicle_no").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#vehicleList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
             
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

        $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
             
          }

        });

        $("#comp_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

         if(msg=='No Match'){

             $(this).val('');
             $('#comp_name').val('');
         }else{
            $('#comp_name').val(msg);
         }

        });

      });


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


  function getItemUm(){

    var ItemCode = $("#item_code").val();

   $.ajax({

            url:"{{ url('get-item-um-aum') }}",

             method : "POST",

             type: "JSON",

             data: {ItemCode: ItemCode},

             success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1.data[0].UM_CODE);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                     $("#um_code").val(data1.data[0].UM_CODE);
                        
                  }
             }

          });

  }


  function getItemQty(){

    var ItemCode = $("#item_code").val();

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });



    $.ajax({

            url:"{{ url('get-item-delivery-order-qty') }}",

             method : "POST",

             type: "JSON",

             data: {ItemCode: ItemCode},

             success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                    $("#qty").val('');
                  }else if(data1.response == 'success'){

                     $("#qty").val(data1.data[0].QTY);
                        
                  }
             }

          });


  }


  
  function getvrnoBySeries(){

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
                      $('#getVrNo').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);
                      $('#getVrNo').val(lastNo);
                    }
                  }

              }

          }

    });

}

function getDoDetials(){

  var do_no = $("#do_no").val();


 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-do-details-do-order') }}",

          method : "POST",

          type: "JSON",

          data: {do_no: do_no},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                
                   $("#fromplaceList").empty();

                   $("#toplaceList").empty();

                   $("#itemList").empty();

                  $.each(data1.data, function(k, getData){

                

                    $("#fromplaceList").append($('<option>',{

                      value:getData.FROM_PLACE,

                      'data-xyz':getData.FROM_PLACE,
                      text:getData.FROM_PLACE


                    }));


                    $("#toplaceList").append($('<option>',{

                      value:getData.TO_PLACE,

                      'data-xyz':getData.TO_PLACE,
                      text:getData.TO_PLACE


                    }));


                     $("#itemList").append($('<option>',{

                      value:getData.ITEM_CODE,

                      'data-xyz':getData.ITEM_NAME,
                      text:getData.ITEM_CODE


                    }));

                  })
                    
                  

              }

          }

    });

}

</script>
@endsection