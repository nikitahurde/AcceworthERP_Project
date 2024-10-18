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

            Master Fleet
 
            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Master Fleet</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Update  Fleet</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

     <!--  <div class="col-sm-2"></div> -->
     <div class="col-sm-1"></div>
      <div class="col-sm-10">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Fleet</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-fleet') }}" class="btn btn-primary"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fleet</a>

              </div>

            <div class="hideinmobile">

              <div class="box-tools pull-right">

                <a href="{{ url('/view-mast-fleet') }}" class="btn btn-primary"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fleet</a>

              </div>

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

            <form action="{{ url('form-mast-fleet-update') }}" method="POST" >

               @csrf

               <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Owner : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building"></i></span>

                          <input list="ownerList" class="form-control" name="owner" id="owner"  value="{{ $fleet_list->OWNER }}" placeholder="Select Owner" onchange="ownerselect(this.value);" autocomplete="off"/>

                          <datalist id="ownerList">
                                                  
                            <option value="SELF" data-xyz="SELF">SELF</option>
                            <option value="MARKET" data-xyz="MARKET">MARKET</option>

                          </datalist>
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('owner', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                 </div>

                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Owner Name: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="owner_name" id="owner_name"  value="{{ $fleet_list->OWNER_NAME}}" placeholder="Owner Name" autocomplete="off"/>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('owner_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                 <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Company Code : 

                        <span class="required-field" id="compc_req"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="compList" class="form-control" name="comp_code" id="comp_code"  value="{{ $fleet_list->COMP_CODE }}" placeholder="Enter Comp Code"  readonly />

                          <datalist id="compList">
                          <?php foreach ($comp_list as $key) { ?>
                            
                            <option value="<?= $key->COMP_CODE ?>" data-xyz="<?= $key->COMP_NAME ?>"><?= $key->COMP_CODE ?> <?= " [".$key->COMP_NAME."]" ; ?></option>

                          <?php   } ?>

                          </datalist>
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Company Name : 

                        <span class="required-field" id="compn_req"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="comp_name"  value="{{ $fleet_list->COMP_NAME }}" placeholder="Enter Comp Name" id="comp_name" readonly/>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('comp_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

              </div>

              <div class="row">

                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Vehicle No : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="truckList" class="form-control" name="truck_no" id="truck_no" value="{{ $fleet_list->TRUCK_NO }}" placeholder="Enter Truck No" maxlength="13" oninput="this.value = this.value.toUpperCase()" readonly="">

                          <datalist id="truckList">

                            <?php foreach($truck_list as $key) { ?>

                            <option value="<?= $key->TRUCK_NO ?>"><?= $key->TRUCK_NO ?></option>

                            <?php } ?>
                          
                            
                          </datalist>

                           <span class="input-group-addon" style="padding: 5px 7px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius" style="padding: 1px 6px !important;font-size: 5px !important;line-height: 1.2 !important;margin-top:-2px;"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>
                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="trucknoH" id="trucknoH" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                            <table class="table table-bordered" style="margin-top: 3%;width: 200px;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Truck No</th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($help_truck_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd" style="text-transform: uppercase;"><?php echo $key->TRUCK_NO; ?></td>
                                        
                                      </tr>
                                     
                                    <?php } ?>
                                      
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;width: 200px;display: none;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Truck No</th>
                                     
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                                <span id="errorItem"></span>

                            </div>
                            </div>
                            
                          </span>

                           
                        </div>

                         <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                          
                            </div>  
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('truck_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Regd Date : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                           <?php $regd_date = date("d-m-Y", strtotime($fleet_list->REGD_DATE)); ?>

                          <input type="text" class="form-control datepicker rdate" name="regd_date"  value="{{ $regd_date  }}" placeholder="Enter Regd Date" maxlength="10" />

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                     <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Make: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>


                          <input list="mfgList"  id="make" name="make" class="form-control  pull-left" value="{{ $fleet_list->MAKE }}" placeholder="Enter Make" maxlength="30">



                          <datalist id="mfgList">

                            <option  value="">-- Select --</option>

                            @foreach($mfg_list as $key)

                            
                             
                            <option value='<?php echo $key->MFG_CODE?>'   data-xyz ="<?php echo $key->MFG_NAME; ?>" ><?php echo $key->MFG_NAME ; echo " [".$key->MFG_CODE."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('make', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                       <small>
                          <div class="pull-left showSeletedName" id="makeText"></div>
                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Model: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control" name="model"  value="{{ $fleet_list->MODEL }}" placeholder="Enter Model" maxlength="30">



                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('model', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  

                 
              </div>

            

              

              <div class="row">

                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       Cost Center:

                        <span class="required-field" id="cost_req"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building"></i></span>

                          <!-- <input type="text" class="form-control" name="base_location" value="{{ old('base_location') }}" placeholder="Enter Base Location"> -->


                           <input list="depotList"  id="Depot" name="cost_code" class="form-control  pull-left" value="{{ $fleet_list->COST_CODE }}" placeholder="Select Cost Code" maxlength="30">



                          <datalist id="depotList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($cost_list as $key)

                            

                            <option value='<?php echo $key->COST_CODE ?>'   data-xyz ="<?php echo $key->COST_NAME; ?>" ><?php echo $key->COST_NAME; echo " [".$key->COST_CODE."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('cost_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                          <small>
                          <div class="pull-left showSeletedName" id="depotText"></div>
                        </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Wheels Type : 

                        <span class="required-field"></span>

                      </label>

                <div class="input-group">

                          <span class="input-group-addon">

                            <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                            <i class="fa fa-list" aria-hidden="true"></i>
                          </span>

                      <!--  <input name="wheel_type" class="form-control" value="{{ old('wheel_type') }}" placeholder="Enter Wheels Type"> -->


                        <input list="wheelList"  id="wheel_type" name="wheel_type" class="form-control  pull-left" value="{{ $fleet_list->WHEEL_TYPE }}" placeholder="Select Wheel Type" maxlength="4">



                          <datalist id="wheelList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($wheel_list as $key)

                            

                            <option value='<?php echo $key->WHEEL_CODE?>'   data-xyz ="<?php echo $key->WHEEL_NAME; ?>" ><?php echo $key->WHEEL_NAME ; echo " [".$key->WHEEL_CODE."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('wheel_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small>
                          <div class="pull-left showSeletedName" id="wheelText"></div>
                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Freight Type Code: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control nextOnEnterBtn" name="freight_type_code" id="freight_type_code"  value="{{ $fleet_list->FREIGHTTYPE_CODE }}" readonly placeholder="Freight Type Code" maxlength="30" autocomplete="off">



                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('freight_type_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Freight Type Name: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control nextOnEnterBtn" name="freight_type_name" id="freight_type_name"  value="{{ $fleet_list->FREIGHTTYPE_NAME }}" readonly placeholder="Freight Type Name" maxlength="30" autocomplete="off">



                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('freight_type_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                 

              
                
              </div>

              <div class="row">


                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Colour : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="colour" class="form-control" value="{{ $fleet_list->COLOUR }}" placeholder="Enter Colour">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('colour', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Chassis No : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="chasis_no" class="form-control" value="{{ $fleet_list->CHASIS_NO }}" placeholder="Enter Chasis No">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('chasis_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Engine No : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="engine_no" class="form-control" value="{{ $fleet_list->ENGINE_NO }}" placeholder="Enter Engine No" maxlength="6">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('engine_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                 
                    <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Mfg Yr : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="mfg_yr" class="form-control" value="{{ $fleet_list->MFG_YR }}" placeholder="Enter Mgf Yr">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('mfg_yr', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                   

              </div>

              <div class="row">


                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Tare Weight : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="tare_weight" id="tare_weight" class="form-control nextOnEnterBtn" value="{{ $fleet_list->TARE_WEIGHT }}" placeholder="Enter Tare Weight" autocomplete="off" oninput="funGrossWeight()">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tare_weight', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  


                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        RC Weight: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="rc_weight" id="rc_weight" class="form-control nextOnEnterBtn" value="{{ $fleet_list->RC_WEIGHT }}" placeholder="Enter Rc Weight" maxlength="6" autocomplete="off" oninput="funGrossWeight();" readonly>
                      </div>

                      <small id="rcWeiErr" style="line-height: 1.2;"></small>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('rc_weight', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Gross Weight: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="gross_weight" id="gross_weight" class="form-control nextOnEnterBtn" value="{{ $fleet_list->GROSS_WEIGHT }}" placeholder="Enter Gross Weight" maxlength="6" autocomplete="off" oninput="funGrossWeight();">
                      </div>

                      <small id="grossWeiErr" style="line-height: 1.2;"></small>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gross_weight', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                                
                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Load Capacity : 

                        <!-- <span class="required-field"></span> -->

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="load_capacity" class="form-control" value="{{ $fleet_list->LOAD_CPCT }}" id="load_capacity" placeholder="Enter Load Capacity" readonly autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('load_capacity', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


              </div>


             
              <div class="row">

                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Load Average : 

                        <!-- <span class="required-field"></span> -->

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="load_average" class="form-control" value="{{ $fleet_list->LOAD_AVG }}" placeholder="Enter Load Average">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('load_average', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Underload Capacity : 

                      <!--   <span class="required-field"></span> -->

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="underload_capacity" class="form-control" value="{{ $fleet_list->UL_CPCT }}" placeholder="Enter UnderLoad Capacity" maxlength="6">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('load_capacity', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
               
                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Underload Average : 

                        <!-- <span class="required-field"></span> -->

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="underload_average" class="form-control" value="{{ $fleet_list->UL_AVG }}" placeholder="Enter Under Load Average">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('underload_average', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                  


                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Empty Average : 

                        <!-- <span class="required-field"></span> -->

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="empty_average" class="form-control" value="{{ $fleet_list->EMPTY_AVG }}" placeholder="Enter Empty Average">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('empty_average', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                  
                
              
                
              </div>

              <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Body-Length : 

                       

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="body_length" class="form-control nextOnEnterBtn" value="{{ $fleet_list->BODY_LENGTH }}" placeholder="Enter Body Length" autocomplete="off">
                        

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('body_length', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <div class="col-md-5">

                    <div class="form-group">

                      <label>

                        Block Fleet: 

                        <span class="required-field"></span>

                      </label>

                     
                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="fleet_block" value="YES"<?php if($fleet_list->FLEET_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="fleet_block" value="NO"<?php if($fleet_list->FLEET_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                  </div>
                
              </div>

             

              <div style="text-align: center;">

                  <input type="hidden" name="fleetIdId" id="fleetIdId" value="{{ $fleet_list->MASTERFLEETID }}">
                  
                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

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
function funGrossWeight() {
  var tareWeight = $('#tare_weight').val();
  var grossWeight = $('#gross_weight').val();
  
  if (tareWeight === '') {
    $('#grossWeiErr').html('*Please Enter Tare weight').css('color', 'red');
    $('#gross_weight').val('');
    $('#rc_weight').val('');
    $('#load_capacity').val('');
    return false;
  } else {
    $('#grossWeiErr').html('');
  }
  
  if (tareWeight === '' || grossWeight === '') {
    $('#load_capacity').val('');
    $('#rc_weight').val('');
    return false;
  }
  
  if (parseInt(grossWeight) <= parseInt(tareWeight)) {
    $('#grossWeiErr').html('*Please Enter Gross weight greater than Tare weight').css('color', 'red');
    $('#load_capacity').val('');
    $('#rc_weight').val('');
    return false;
  } else {
    var rcWeight = parseInt(grossWeight) - parseInt(tareWeight);
    var loadCapacity = parseInt(grossWeight) - parseInt(tareWeight);
    $('#rcWeiErr').html('');
    $('#rc_weight').val(rcWeight);
    $('#load_capacity').val(loadCapacity);
    return true;
  }
}

  function ownerselect(val){
    console.log('val',val);

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
</script>

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Truck No <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
        html:true,
        content:  $('#myForm').html()
    }).on('click', function(){
      // had to put it within the on click action so it grabs the correct info on submit
      $('#serachcode').click(function(){

           $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });

          var HelpTruckNo = $('#trucknoH').val();

           if(HelpTruckNo == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-trcuk-no-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpTruckNo: HelpTruckNo},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Truck No Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><th>Truck No</th></tr><tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;text-transform:uppercase">'+objcity.truck_no+'</td></tr>');
                             });
                      }
                 }

              });
           }
      })
  })
})
</script>

<script type="text/javascript">
  $(document).ready(function(){
     $('body').on('click', '#closeModel', function () {
          $('.popover').fadeOut();
    })
  });
</script>

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
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


  $(document).ready(function(){



        $("#Depot").bind('change', function () {  

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

        $("#make").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#mfgList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("makeText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("makeText").innerHTML = '';

          }

        });



        $("#wheel_type").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#wheelList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("wheelText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("wheelText").innerHTML = '';

          }

        });


        $("#comp_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          if(msg=='No Match'){

             $(this).val('');
             $("#comp_name").val('');
            
             $("#comp_name").prop('readonly', false);

          }else{

            $("#comp_name").val(msg);
            $("#comp_name").prop('readonly', true);


          }

        });

      });

</script>

<!-- <script type="text/javascript">
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
</script> -->
@endsection