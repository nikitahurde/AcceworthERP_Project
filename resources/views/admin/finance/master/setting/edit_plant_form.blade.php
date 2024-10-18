@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

 .required-field::before {
    content: "*";
    color: red;
  }
  .stepwizard-step p {
    margin-top: 10px;

  }
  .stepwizard-row {
    display: table-row;
  }
  .stepwizard {
    display: table;
    width: 100%;
    position: relative;
  }
  .stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
  }
  .stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
  }
  .stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
  }
  .btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
  }
  .hidebtn{
    display: none;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>Master Plant<small>Update Details</small></h1>

      <ol class="breadcrumb">

        <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ URL('/dashboard')}}">Master</a></li>
        <li class="Active"><a href="{{ URL('/form-fleet-truck-wheel')}}">Master  Plant  </a></li>
        <li class="Active"><a href="{{ URL('/form-fleet-truck-wheel')}}">Update  Plant </a></li>

      </ol>
  </section>

  <section class="content">

    <form action="{{ url('/Master/Setting/form-mast-plant-update') }}" method="POST">
              @csrf

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Plant</h2>

          </div><!-- /.box-header -->

          <div>

            <a href="{{ url('/Master/Setting/View-Plant_Mast') }}" class="btn btn-primary pull-right" style="margin-right: 2%"><i class="fa fa-plus"></i>&nbsp;&nbsp;View Plant</a>

          </div>

          <div class="box-body">

            <div class="stepwizard">

              <div class="stepwizard-row setup-panel">

                <div class="stepwizard-step" id="step_1">

                  <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>

                  <p>Basic Details</p>

                </div>

              </div>

            </div>

            <div class="row setup-content" id="step-1">

              <div class="col-xs-12">

                <div class="col-md-12">

                  <h5 style="text-align: center;"><span id="showmsg" style="color: green"></span></h5>

                  <div class="row">

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Company Code: <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input list="compList" name="comp_code" id="comp_code" value="{{ $plant_data->COMP_CODE }}" class="form-control" readonly>

                          <datalist id="compList">

                            <option value=''>--SELECT--</option>

                            @foreach($comp_list as $row)

                              <option value='{{ $row->COMP_CODE }}' data-xyz='{{ $row->COMP_NAME }}'>{{ $row->COMP_CODE }} = {{ $row->COMP_NAME }} </option>

                            @endforeach

                          </datalist>
                       
                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        <small id="comp_err" style="color: red;"></small>

                      </div><!-- /.form-group -->

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Profit Center Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="pfctList" type="text" class="form-control" name="profit_code" id="profit_code" value="{{ $plant_data->PFCT_CODE}}" readonly> 

                          <datalist id="pfctList"> 
                            <option value="">--SELECT--</option>

                            <option value="{{ $plant_data->PFCT_CODE}}">{{ $plant_data->PFCT_CODE}}</option>

                          </datalist>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('profit_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                      </div>

                    </div>

                    <div class="col-md-2">

                      <div class="form-group">

                        <label>Plant Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control Number" name="plant_code" id="plant_code" value="{{ $plant_data->PLANT_CODE }}" placeholder="Enter Plant Code" readonly>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>


                        <small id="plantc_err" style="color: red;"></small>

                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Plant Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="plant_name" id="plant_name" value="{{ $plant_data->PLANT_NAME }}" placeholder="Enter Plant Name" readonly>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('plant_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        <small id="plantn_err" style="color: red;"></small>

                      </div>

                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Address : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="address1" id="address1" value="{{ $plant_data->ADD1 }}" placeholder="Address 1" autocomplete="off">

                        </div>
                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Address : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa ffa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="address2" id="address2" value="{{ $plant_data->ADD2 }}" placeholder="Address 2" autocomplete="off">

                        </div>
                      </div>

                    </div>

                    <div class="col-md-4">

                      <div class="form-group">

                        <label>Address : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="address3" id="address3" value="{{ $plant_data->ADD3 }}" placeholder="Address 3" autocomplete="off">

                        </div>
                      </div>

                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Phone No 1: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input type="text" class="form-control Number" name="phone1"  id="phone1" value="{{ $plant_data->PHONE1 }}" placeholder="Phone No 1" maxlength="10" autocomplete="off">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Phone No 2:</label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input type="text" class="form-control Number" id="phone2" name="phone2" value="{{ $plant_data->PHONE2 }}" placeholder="Enter Phone No 2" maxlength="10" autocomplete="off">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Fax: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-fax"></i></span>

                          <input type="text" class="form-control" name="fax" id="fax" value="{{ $plant_data->FAX }}" placeholder="Enter Fax" autocomplete="off">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Email-id: <span class="required-field"></span> </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                          <input type="email" class="form-control" name="email_id" id="email_id" value="{{ $plant_data->EMAIL }}" placeholder="Enter Email-id" autocomplete="off" maxlength="40">

                        </div>

                        <small id="email_err" style="color: red;"></small>

                      </div>

                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-2">

                      <div class="form-group">

                        <label>City : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-home"></i></span>

                          <input list="cityList" class="form-control" name="city" id="city" value="{{ $plant_data->CITY_CODE }}[{{ $plant_data->CITY_NAME }}]" placeholder="Enter City" onchange="getFullAdrs()" autocomplete="off">

                          <datalist id="cityList">

                            <option value=''>--SELECT--</option>

                            @foreach($city_lists as $row)

                              <option value='{{ $row->CITY_CODE }}'data-xyz="{{ $row->CITY_NAME }}">{{ $row->CITY_CODE }}[{{ $row->CITY_NAME }}] </option>

                            @endforeach

                          </datalist>

                          

                        </div>
                        <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('city', '<p class="help-block" style="color:red;">:message</p>') !!}

                         </small>
                        <small id="cityCode_err" style="color: red;"></small>
                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label> District : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="district" id="district" value="{{ $plant_data->DIST_CODE }}[{{ $plant_data->DIST_NAME }}]" placeholder="Enter District" readonly>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('district', '<p class="help-block" style="color:red;">:message</p>') !!}

                         </small>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>State : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="stateList" type="text" class="form-control" name="state" value="{{ $plant_data->STATE_CODE }}[{{ $plant_data->STATE_NAME }}]" placeholder="Select State" maxlength="2" id="statecode" readonly>

                          <datalist id="stateList">

                            <option value="">--SELECT STATE--</option>

                           @foreach ($state_list as $key)

                            <option value="{{$key->STATE_CODE}}" data-xyz ="<?php echo $key->STATE_NAME; ?>">{{$key->STATE_CODE}} - {{$key->STATE_NAME }}</option>

                            @endforeach

                          </datalist>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('state', '<p class="help-block" style="color:red;">:message</p>') !!}

                         </small>

                      </div>

                    </div>

                    <div class="col-md-2">

                      <div class="form-group">

                        <label>Country : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-flag"></i></span>

                          <input type="text" class="form-control" name="country" id="country" value="{{ $plant_data->COUNTRY_CODE }}[{{ $plant_data->COUNTRY_NAME }}]" placeholder="Enter Country" readonly>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                         </small>

                      </div>

                    </div>
                  
                    <div class="col-md-2">

                      <div class="form-group">

                        <label>Pincode : <span class="required-field"></span> </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                          <input type="text" class="form-control Number" name="pincode" value="{{ $plant_data->PIN_CODE }}" placeholder="Enter Pincode" id="pincode" maxlength="8" readonly>
                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('pincode', '<p class="help-block" style="color:red;">:message</p>') !!}

                         </small>

                      </div>
                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Plant Category : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-home"></i></span>

                          <select class="form-control" name="plantCat" id="plantCatId" value="{{ old('plantCat') }}" placeholder="Select Plant Category" autocomplete="off">
                            <option value=''>--SELECT--</option>
                            <option value='Yard' <?php if ($plant_data->PLANT_CATEGORY == 'Yard') {echo 'selected';} ?> >Yard</option>
                            <option value='Ex-Siding' <?php if ($plant_data->PLANT_CATEGORY == 'Ex-Siding') {echo 'selected';} ?> >Ex-Siding</option>
                            <option value='Others' <?php if ($plant_data->PLANT_CATEGORY == 'Others') {echo 'selected';} ?> >Others</option>
                          </select>

                        </div>
                        <small id="plantCat_err" style="color: red;"></small>
                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('plantCat', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>
                      </div>

                    </div>

                  </div>

                  <input type="hidden" name="updateid1" id="updateid1" value="{{ $plant_data->PLANT_CODE }}">  

                <!--   <center><button class="btn btn-primary " type="button" id="submitBtn">Next</button></center> -->

                </div>

              </div>

            </div>

        </div>

      </div>

    </div>

  </div>

  <div class="row">

      <div class="col-sm-12">

        <div class="box box-warning">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Amount Field</h2>

          </div><!-- /.box-header -->
          
          <div class="box-body">
           
            <div class="col-xs-12">

              <div class="col-md-12">

                <div class="row">
                  
                  <div class="col-md-2">

                      <div class="form-group">

                        <label>TAN No. : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="tan_no" id="tan_no" value="{{ $plant_data->TAN_NO }}" placeholder="Enter TAN No" maxlength="10">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                      </div>
                    </div>

                    <div class="col-md-2">

                      <div class="form-group">

                        <label>TIN No. : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="tin_no"  id="tin_no" value="{{ $plant_data->TIN_NO }}" placeholder="Enter TIN No" maxlength="9">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('series_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>CIN No. :</label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control Number" name="cin_no" id="cin_no" value="{{ $plant_data->CIN_NO }}" placeholder="Enter CIN No" maxlength="4">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                      </div>

                    </div>

                    <div class="col-md-2">

                      <div class="form-group">

                        <label> PAN No. : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="pan_no"  id="pan_no" value="{{ $plant_data->PAN_NO }}" placeholder="Enter PAN No" maxlength="10">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('series_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                      </div>

                    </div>

                    <div class="col-md-2">

                      <div class="form-group">

                        <label>GST No. : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="gst_no" id="gst_no" value="{{ $plant_data->GST_NO }}" placeholder="Enter GST No" maxlength="15">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('gst_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                      </div>

                    </div>
                </div>

                <div class="row">

                  <div class="col-md-3">

                      <div class="form-group">

                        <label>ESIC No. : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="esic_no"  id="esic_no" value="{{ $plant_data->ESIC_NO }}" placeholder="Enter ESIC No" maxlength="17">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('series_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                      </div>

                    </div>

                    <div class="col-md-2">

                      <div class="form-group">

                        <label> Sale Tax No: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="tetx" name="sale_tax_no" id="sale_tax_no" value="{{ $plant_data->SALES_TAXNO }}" class="form-control" placeholder="Enter Sale Tax No" maxlength="17">

                          </div>

                      </div>

                    </div>

                    <div class="col-md-2">

                      <div class="form-group">

                        <label> CSale Tax No : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" name="csale_tax_no" id="csale_tax_no" class="form-control" placeholder="Enter CSale Tax No" maxlength="17" value="{{ $plant_data->CSALES_TAXNO }}">

                        </div>
                
                      </div>

                    </div>

                    <div class="col-md-2">

                      <div class="form-group">

                        <label> Service Tax No. : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="service_tax_no"  id="service_tax_no" value="{{ $plant_data->SERVICE_TAXNO }}" placeholder="Service Tax No" maxlength="17" >

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>EPFO No. : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="epfo_no"  id="epfo_no" value="{{ $plant_data->EPFO_NO }}" maxlength="12" placeholder="EPFO No">

                        </div>

                      </div>

                    </div>
                    <input type="hidden" name="lastid" id="lastid" value="{{ $plant_data->PLANT_CODE }}">
                  
                </div>
                
              </div>

            </div>
           
          </div>

      </div>

    </div>

  </div>

   <div class="row">

      <div class="col-sm-12">

        <div class="box box-success">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Non Accounting Field</h2>

          </div><!-- /.box-header -->
          
          <div class="box-body">
           
            <div class="row">

              <div class="col-xs-12">

                <div class="col-md-12">

                  <h5 style="text-align: center;"> <span id="showmsg2" style="color: green;"></span></h5>

                  <div class="row">

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>ECC No. : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="ecc_no"  id="ecc_no" value="{{ $plant_data->ECC_NO }}"placeholder="Enter ECC No" maxlength="17">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Range No : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="range_no" id="range_no" value="{{ $plant_data->RANGE_NO }}" placeholder="Enter Range No">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Range Name: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                          <input type="text" name="range_name" id="range_name" value="{{ $plant_data->RANGE_NAME }}" class="form-control" placeholder="Enter Range Name">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Range Address1 : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" name="range_addres1" id="range_addres1" value="{{ $plant_data->RANGE_ADD1 }}" class="form-control" placeholder="Enter Range Address1">

                        </div>

                      </div>

                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Range Address2: </label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                            <input type="text" class="form-control" name="range_addres2"  id="range_addres2" value="{{ $plant_data->RANGE_ADD2 }}" placeholder="Range Address2">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Division: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="division" id="division" value="{{ $plant_data->DIVISION }}" placeholder="Enter Division">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Collector : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="collector" id="collector" value="{{ $plant_data->COLLECTOR }}" placeholder="Enter Rfhead 5">

                        </div>

                      </div>

                    </div>

                  </div>

                  <div style="text-align: center;">

                    <input type="hidden" name="lastid1" id="lastid1" value="{{ $plant_data->PLANT_CODE }}">
                    <center><button type="submit" class="btn btn-primary" id="submitBtn3"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Update</button></center>

                  </div>

                </div>

              </div>

            </div>
           
          </div>

      </div>

    </div>

  </div>

  <br>

  </form> 

  </section>

</div>

<br>

@include('admin.include.footer')



<script type="text/javascript">

  function getFullAdrs(num){

    var val = $("#city").val();
    var xyz = $('#cityList option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $("#city").val('');
      $("#district").val('');
      $("#statecode").val('');
      $("#country").val('');
      $("#pincode").val('');
    }else{
      $("#district").val('');
      $("#statecode").val('');
      $("#country").val('');
      $("#pincode").val('');
      var city = $("#city").val();

      $("#city").val(val+'['+msg+']');

      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({

            url:"{{ url('get-full-address-against-city') }}",
            method : "POST",
            type: "JSON",
            data: {city: city},
            success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                }else if(data1.response == 'success'){

                    var details = data1.data;
                    console.log('details',details);
                    $('#district').val(details[0]['DISTRICT_CODE']+'['+details[0]['DISTRICT_NAME']+']');
                    $('#statecode').val(details[0]['STATE_CODE']+'['+details[0]['STATE_NAME']+']');
                    $('#country').val(details[0]['COUNTRY_CODE']+'['+details[0]['COUNTRY_NAME']+']');
                    $('#pincode').val(details[0]['PIN_CODE']);
                }
            }

      });

    }

  }

$(document).ready(function(){

   $("#submitBtn").click(function(event) {



    var plant_code = $("#plant_code").val();

    var plant_name = $("#plant_name").val();

    var comp_code  =  $("#comp_code").val();

    var email_id   =  $("#email_id").val();

    var filter = /^[a-z0-9._-]+@[a-z]+.[a-z]{2,5}$/i;

     

    if(plant_code=='' && plant_name=='' && comp_code=='' && email_id==''){

      $("#plantc_err").html('The plant code field is required.');

      $("#plantn_err").html('The plant name field is required.');

      $("#comp_err").html('The comp code field is required.');

      $("#email_err").html('The email field is required.');

      return false;

    }

    if(plant_code=='' && plant_name=='' && comp_code==''){

      $("#plantc_err").html('The plant code field is required.');

      $("#plantn_err").html('The plant name field is required.');

      $("#comp_err").html('The comp code field is required.');

      return false;

    }

    if(plant_code=='' && plant_name==''){

      $("#plantc_err").html('The plant code field is required.');

      $("#plantn_err").html('The plant name field is required.');

      return false;

    }

    if(comp_code=='' && email_id==''){

       $("#comp_err").html('The comp code field is required.');

      $("#email_err").html('The email field is required.');

      return false;

    }

    if(plant_code==''){

      $("#plantc_err").html('The plant code field is required.');

      return false;

    }

    if(plant_name==''){

     $("#plantn_err").html('The plant name field is required.');

    }

    if(comp_code==''){

      $("#comp_err").html('The comp code field is required.');

      return false;

    }if(email_id==''){

        $("#email_err").html('The email field is required.');

        return false;

    }else if(!filter.test(email_id))
    {
       $("#email_err").html('The valid email field is required.');

        return false;;       
    }else{
           $('a[href="#step-2"]').click();
          
           //$("#step_1").addClass('hidebtn');
    }


     /* Act on the event */

   });



});

</script>



<script type="text/javascript">

$(document).ready(function(){

   $("#submitBtn2").click(function(event) {



   $('a[href="#step-3"]').click();
          
   // $("#step_2").addClass('hidebtn')


     /* Act on the event */

   });



});

</script>

<script type="text/javascript">

$(document).ready(function(){

   $("#submitBtn32222").click(function(event) {



   var data = $("#submitdata3").serialize();



    $.ajaxSetup({



          headers: {



              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')



          }



         });



    $.ajax({

        type: 'POST',

        url: "{{ url('/finance/form-mast-plant-save3') }}",

        data: data, // here $(this) refers to the ajax object not form

        success: function (data) {
         

             var data1 = JSON.parse(data);

            

           /*$('.showbtn').removeClass('hidebtn');*/

            var url = "{{url('finance/view-plant-msg-update')}}"
        setTimeout(function(){ window.location = url+'/updatedata'; });

           /*$('#showmsg2').html('Plant Was Successfully Updated...!');

           setTimeout(function(){ window.location.reload();},1500);*/



          

        },

    });





     /* Act on the event */

   });



});

</script>



<script type="text/javascript">

  

      $("#comp_code" ).change(function() {



           $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        

      var comp_code = $("#comp_code").val();

     // alert(comp_code);return false;





      $.ajax({

        url: "{{ url('/finance/get_pfct') }}",

        method : 'POST',

        type: 'JSON',

        data: {comp_code: comp_code},

      })

      .done(function(data) {



       // alert(data);return false;



       // var obj = $.parseJSON(data);

        console.log(data);



        $("#profit_code").html(data);



      })

    

    });



</script>

<script type="text/javascript">



    $(document).ready(function(){



        $("#trans_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#transList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("transText").innerHTML = msg; 



        });



        $("#tax_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#taxList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("taxText").innerHTML = msg; 



        });



    });

</script>



<script type="text/javascript">

$(document).ready(function () {



    var navListItems = $('div.setup-panel div a'),

            allWells = $('.setup-content'),

            allNextBtn = $('.nextBtn');



    allWells.hide();



    navListItems.click(function (e) {

        e.preventDefault();

        var $target = $($(this).attr('href')),

                $item = $(this);



        if (!$item.hasClass('disabled')) {

            navListItems.removeClass('btn-primary').addClass('btn-default');

            $item.addClass('btn-primary');

            allWells.hide();

            $target.show();

            $target.find('input:eq(0)').focus();

        }

    });



    allNextBtn.click(function(){

        var curStep = $(this).closest(".setup-content"),

            curStepBtn = curStep.attr("id"),

            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),

            curInputs = curStep.find("input[type='text'],input[type='url']"),

            isValid = true;



        $(".form-group").removeClass("has-error");

        for(var i=0; i<curInputs.length; i++){

            if (!curInputs[i].validity.valid){

                isValid = false;

                $(curInputs[i]).closest(".form-group").addClass("has-error");

            }

        }



        if (isValid)

            nextStepWizard.removeAttr('disabled').trigger('click');

    });



    $('div.setup-panel div a.btn-primary').trigger('click');

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