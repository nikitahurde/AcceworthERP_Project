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

    font-size: 12px;

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
 
            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Master Fleet</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Add  Fleet</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

     <!--  <div class="col-sm-2"></div> -->
     <div class="col-sm-1"></div>
      <div class="col-sm-10">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Master Fleet</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-fleet') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fleet</a>

              </div>

              <div class="hideinmobile">

              <div class="box-tools pull-right" style="margin-top: -22px;">

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

            <form action="{{ url('form-mast-fleet-save') }}" method="POST" >

               @csrf

               <div class="row">

                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Owner : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input list="ownerList" class="form-control nextOnEnterBtn" name="owner" id="owner"  value="{{ old('owner') }}" placeholder="Select Owner" onchange="ownerselect(this.value);" autocomplete="off"/>

                          <datalist id="ownerList">
                                                  
                            <option value="SELF" data-xyz="SELF">SELF</option>
                            <option value="MARKET" data-xyz="MARKET">MARKET</option>

                          </datalist>
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('owner', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Owner Name: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control nextOnEnterBtn" name="owner_name" id="owner_name"  value="{{ old('owner_name') }}" placeholder="Owner Name" autocomplete="off"/>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('owner_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Company Code : <span class="required-field" id="compc_req"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="compList" class="form-control nextOnEnterBtn" name="comp_code" id="comp_code"  value="{{ old('regd_date') }}" placeholder="Enter Company Code"  autocomplete="off" />

                          <datalist id="compList">
                          <?php foreach ($comp_list as $key) { ?>
                            
                            <option value="<?= $key->COMP_CODE ?>" data-xyz="<?= $key->COMP_NAME ?>"><?= $key->COMP_CODE ?> <?= " [".$key->COMP_NAME."]" ; ?></option>

                          <?php   } ?>

                          </datalist>
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Company Name : 

                        <span class="required-field" id="compn_req"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control next" name="comp_name"  value="{{ old('regd_date') }}" placeholder="Enter Company Name" id="comp_name"  autocomplete="off"/>

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

                       Cost Center:

                        <span class="required-field" id="cost_req"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building"></i></span>

                          <!-- <input type="text" class="form-control" name="base_location" value="{{ old('base_location') }}" placeholder="Enter Base Location"> -->


                           <input list="depotList"  id="Depot" name="cost_code" class="form-control  pull-left  nextOnEnterBtn" value="{{ old('cost_code')}}" placeholder="Select Cost Code" maxlength="30" autocomplete="off"><br>

                            <input type="hidden"  id="Depotname" name="costName" readonly>



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

                        Vehicle No : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input id="text" class="form-control nextOnEnterBtn" name="truck_no" id="truck_no" value="{{ old('truck_no') }}" placeholder="Enter Truck No" maxlength="13" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                         

                           <span class="input-group-addon" style="padding: 2px 7px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius" style="padding:0px 5px;font-size:7px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 9px;width: 9px;"></i></button>
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

                          <input type="text" class="form-control datepicker rdate nextOnEnterBtn" name="regd_date"  value="{{ old('regd_date') }}" placeholder="Enter Regd Date" maxlength="10" autocomplete="off" />

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


                          <input list="mfgList"  id="make" name="make" class="form-control  pull-left nextOnEnterBtn" value="{{ old('make') }}" placeholder="Enter Make" maxlength="30" autocomplete="off"><br>

                           <input type="hidden"  id="makeSname" name="makeName" readonly>



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
             
              </div>

              <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Model: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control nextOnEnterBtn" name="model"  value="{{ old('model') }}" placeholder="Enter Model" maxlength="30" autocomplete="off">



                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('model', '<p class="help-block" style="color:red;">:message</p>') !!}

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


                        <input list="wheelList"  id="wheel_type" name="wheel_type" class="form-control  pull-left nextOnEnterBtn" value="{{ old('wheel_type')}}" placeholder="Select Wheel Type" maxlength="4" autocomplete="off"><br>

                        <input type="hidden"  id="wheelSname" name="wheelTypeName" readonly>



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

                          <input type="text" class="form-control nextOnEnterBtn" name="freight_type_code" id="freight_type_code"  value="{{ old('freight_type_code') }}" readonly placeholder="Freight Type Code" maxlength="30" autocomplete="off">



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

                          <input type="text" class="form-control nextOnEnterBtn" name="freight_type_name" id="freight_type_name"  value="{{ old('freight_type_name') }}" readonly placeholder="Freight Type Name" maxlength="30" autocomplete="off">



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

                        <input type="text" name="colour" class="form-control nextOnEnterBtn" value="{{ old('colour') }}" placeholder="Enter Colour" autocomplete="off">

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

                        <input type="text" name="chasis_no" class="form-control nextOnEnterBtn" value="{{ old('chasis_no') }}" placeholder="Enter Chasis No" autocomplete="off">

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

                        <input type="text" name="engine_no" class="form-control nextOnEnterBtn" value="{{ old('engine_no') }}" placeholder="Enter Engine No" maxlength="6" autocomplete="off">

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

                        <select class="form-control" id="mfg_yr" name="mfg_yr" style="padding-top: 3px;" value="{{ old('mfg_yr') }}">

                          <?php 
                          $currentDate = date("Y");
                          for($i=$currentDate;$i>=2000;$i--){ ?>
                           <option value="{{$i}}">{{$i}}</option>
                          <?php } ?>
                        </select>

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

                        <input type="text" name="tare_weight" id="tare_weight" class="form-control nextOnEnterBtn" value="{{ old('tare_weight') }}" placeholder="Enter Tare Weight" autocomplete="off" oninput="funGrossWeight()">

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

                        <input type="text" name="rc_weight" id="rc_weight" class="form-control nextOnEnterBtn" value="{{ old('rc_weight') }}" placeholder="Enter Rc Weight" maxlength="6" autocomplete="off" oninput="funGrossWeight();" readonly>
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

                        <input type="text" name="gross_weight" id="gross_weight" class="form-control nextOnEnterBtn" value="{{ old('gross_weight') }}" placeholder="Enter Gross Weight" maxlength="6" autocomplete="off" oninput="funGrossWeight();">
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

                        <input type="text" name="load_capacity" class="form-control" value="{{ old('load_capacity','0') }}" id="load_capacity" placeholder="Enter Load Capacity" readonly autocomplete="off">

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

                       <!--  <span class="required-field"></span> -->

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="load_average" id="load_average" class="form-control nextOnEnterBtn" value="{{ old('load_average','0') }}" placeholder="Enter Load Average" autocomplete="off"  oninput="funemptyAvg()">

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

                        <!-- <span class="required-field"></span> -->

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="underload_capacity" class="form-control nextOnEnterBtn" value="{{ old('underload_capacity','0') }}" id="underload_capacity" placeholder="Enter UnderLoad Capacity" autocomplete="off" oninput="fununderload_cap();">

                      </div>

                      <small id="underload_capErr" style="line-height: 1.2;"></small>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('underload_capacity', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        <input type="text" name="underload_average" id="underload_average"  class="form-control nextOnEnterBtn" value="{{ old('underload_average','0') }}" placeholder="Enter Under Load Average" autocomplete="off"  oninput="funemptyAvg()">

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

                        <input type="text" name="empty_average" id="empty_average" class="form-control nextOnEnterBtn" value="{{ old('empty_average','0') }}" placeholder="Enter Empty Average" autocomplete="off" oninput="funemptyAvg()">

                      </div>
                      <small id="emptyAvgErr" style="line-height: 1.2;"></small>

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

                        <input type="text" name="body_length" class="form-control nextOnEnterBtn" value="{{ old('body_length') }}" placeholder="Enter Body Length" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('body_length', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                
              </div>


              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

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

  function funGrossWeight(){


    var tareWeight = $('#tare_weight').val();
    var grossWeight = $('#gross_weight').val();
    if (tareWeight == '') {
      $('#grossWeiErr').html('*Please Enter Tare weight').css('color', 'red');
      $('#gross_weight').val('');
      $('#rc_weight').val('');
      return false;
    } else {
      $('#grossWeiErr').html('');
    }

    if (parseInt(tareWeight) === '' || parseInt(grossWeight) === '') {
      $('#load_capacity').val('0');
      $('#rc_weight').val('0');
      return false;
    }

    if(parseInt(grossWeight) <= parseInt(tareWeight)){

      $('#grossWeiErr').html('*Please Enter Gross weight greater than Tare weight').css('color','red');
      $('#load_capacity').val('0');
      $('#rc_weight').val('');
      return false;

    }else{

      $loadCapacity = parseInt(grossWeight) - parseInt(tareWeight);

      $('#grossWeiErr').html('');
      $('#load_capacity').val($loadCapacity);

    }

    if (isNaN(parseInt(tareWeight)) || isNaN(parseInt(grossWeight))) {
      $('#load_capacity').val('');
      $('#rc_weight').val('');
      return false;
    } else {
      var rcWeight = parseInt(grossWeight) - parseInt(tareWeight);

      $('#rcWeiErr').html('');
      $('#rc_weight').val(rcWeight);
    }



  }

  function fununderload_cap(){

    var load_cap = $('#load_capacity').val();
    var underLoad_cap = $('#underload_capacity').val();

    if(parseInt(underLoad_cap) >= parseInt(load_cap)){

      $('#underload_capErr').html('*Please Enter Underload Capacity is less than Load Capacity').css('color','red');
      return false;
    }else{
      $('#underload_capErr').html('');

    }

  }

  function funemptyAvg(){
    console.log('avg');

    var loadAvg = $('#load_average').val();
    var underloadAvg = $('#underload_average').val();
    var emptyAvg = $('#empty_average').val();

    if(parseInt(emptyAvg) < parseInt(loadAvg) || parseInt(emptyAvg) < parseInt(underloadAvg)){
      console.log('true');
       $('#emptyAvgErr').html('Plase Enter Empty Average is Greater than load Average and Usnderload Average').css('color','red');
       return false;
    }else{
       $('#emptyAvgErr').html('');
    }

  }

  function ownerselect(val){

    if(val=='MARKET'){

      $("#compc_req").hide();
      $("#compn_req").hide();
      $("#cost_req").hide();

      $("#comp_code").prop('readonly',true);

      $("#comp_name").prop('readonly',true);

    }else{
      $("#compc_req").show();
      $("#compn_req").show();
      $("#cost_req").show();
      $("#comp_code").prop('readonly',false);

      $("#comp_name").prop('readonly',false);

    }



  }
</script>
<script type="text/javascript">
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
// $(function () {
//     var start = new Date();
//     start.setFullYear(start.getFullYear() - 70);
//     console.log('start',start.setFullYear(start.getFullYear() - 70));
//     var end = new Date();
//     end.setFullYear(end.getFullYear() - 18);
//     var currentDate = new Date().getFullYear();
//     console.log('end', end.setFullYear(end.getFullYear() - 18))

//     $('#currentYear').datepicker({
//         format: 'yyyy',
//         minView: "years",
//         viewMode: "years", 
//         minViewMode: "years",
//         changeYear:true,
//        yearRange: "1900:1999",

//     });
// });
  

  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      endDate: 'today',
      
      autoclose: 'true'

    });

    var currentDate = new Date().getFullYear();
    //   var date = new Date();
    // var y = date.getFullYear();var  m = date.getMonth();
    // console.log('current',currentDate);
    //    var fSDate = new Date(y, m, 1);
    //     var fEDate = new Date(y, m + 1, 0);

    
     //  $('#currentYear').datepicker({
     //    changeYear:true,
     //    format: 'yyyy',
     //    minView: "years",
     //    viewMode: "years", 
     //    minViewMode: "years",
     //    maxDate :currentDate,
     //    todayHighlight: true,
     //    autoclose:true,
        
     // });

     

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

           $('#Depotname').val(msg);

        if(msg == 'No Match'){

            $('#Depot').val('');
            $('#Depotname').val('');
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

          $('#makeSname').val(msg);

        if(msg == 'No Match'){

            $('#make').val('');
            $('#makeSname').val('');
        }

        });



        $("#wheel_type").on('change', function () {  

          var wheel_code = $(this).val();

          var xyz = $('#wheelList option').filter(function() {

          return this.value == wheel_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

         
          document.getElementById("wheelText").innerHTML = msg; 

          

        if(msg == 'No Match'){

            $('#wheel_type').val('');
            $('#wheelSname').val('');
        }else{
            $('#wheelSname').val(msg);


              $.ajaxSetup({

                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }

              });


             $.ajax({

                url:"{{ url('get-vehicle-freight-type') }}",

                 method : "POST",

                 type: "JSON",

                 data: {wheel_code: wheel_code},

                 success:function(data){

                      var data1 = JSON.parse(data);

                        console.log(data1.data);

                      if (data1.response == 'error') {
                          
                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Truck No Not Found...!</p>");

                      }else if(data1.response == 'success'){

                            if(data1.data=='' || data1.data==null){

                                
                            }else{

                                console.log(data1.data[0]);

                                 var freightTypeCode = data1.data[0].FREIGHTTYPE_CODE;
                                 var freightTypeName = data1.data[0].FREIGHTTYPE_NAME;

                                $("#freight_type_code").val(freightTypeCode);
                                $("#freight_type_name").val(freightTypeName);

                              }
                      }
                 }

              });



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