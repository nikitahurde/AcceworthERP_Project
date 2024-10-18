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
  .rightcontent{
    text-align:right;
  }
  ::placeholder {
    text-align:left;
  }
  .showSeletedName{
    font-size: 12px;
    margin-top: 1%;
    font-weight: 600;
    color: #4f90b5;
    }

  .beforhidetble{
    display: none;
  }
  .popover{
      left: 120.4922px!important;
      width: 100%!important;
  }
  .setetxtintd{
      font-size: 12px !important;
      padding-top: 2% !important;
      padding-bottom: 2% !important;
  }
  .nameheading{
      font-size: 12px;
  }
  .setheightinput{
      height: 0%;
  }
  .custom-options {
    position: absolute;
    display: block;
    top: 100%;
    left: 0;
    right: 0;
    border-top: 0;
    background: #f3eded;
    transition: all 0.5s;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    z-index: 2;
    -webkit-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
  }
  .custom-select .custom-options {
     opacity: 1;
     visibility: visible;
     pointer-events: all;
  }
  .custom-option {
    position: relative;
    display: block;
    padding-top: 10px;
    padding-left: 21%;
    font-size: 14px;
    font-weight: 600;
    color: #3b3b3b;
    line-height: 2px;
    cursor: pointer;
    transition: all 0.5s;
  }
  .CloseListDepot{
    display: none;
  }
  @media screen and (max-width: 600px) {
    .popover {
      left: 56.4922px!important;
      width: 100%!important;
    }
    .setheightinput{
      width: 65%!important;
    }
    #serachcode{
      margin-left: 5%!important;
    }
  }

</style>

<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>Master Plant <small>Add Details</small></h1>

        <ol class="breadcrumb">

          <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

          <li><a href="{{ URL('/dashboard')}}">Master</a></li>

          <li class="Active"><a href="{{ URL('/form-fleet-truck-wheel')}}">Master Plant  </a></li>

          <li class="Active"><a href="{{ URL('/form-fleet-truck-wheel')}}">Add Plant </a></li>

        </ol>

    </section>

    <section class="content">

      <form action="{{ url('/Master/Setting/form-mast-plant-save') }}" method="POST">
               @csrf

      <div class="row">

          <div class="col-sm-12">

            <div class="box box-primary Custom-Box">

              <div class="box-header with-border" style="text-align: center;">

                <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Plant</h2>

              </div><!-- /.box-header -->

            <div>

              <a href="{{ url('/Master/Setting/View-Plant_Mast') }}" class="btn btn-primary pull-right" style="margin-right: 2%"><i class="fa fa-plus"></i>&nbsp;&nbsp;View Plant</a>

            </div>

            <div class="box-body">

              <div class="stepwizard">

                  <div class="stepwizard-row setup-panel">

                      <div class="stepwizard-step" id="step_1" >

                          <a href="#step-1" type="button"  class="btn btn-primary btn-circle" style="pointer-events: none">1</a>

                          <p>Basic Details</p>

                      </div>

                     <!--  <div class="stepwizard-step hidebtn showbtn" id="step_2">

                          <a href="#step-2" type="button" class="btn btn-default btn-circle" style="pointer-events: none">2</a>

                          <p>Amount Field</p>

                      </div> -->

                      <!-- <div class="stepwizard-step hidebtn showbtn" id="step_3">

                          <a href="#step-3" type="button" class="btn btn-default btn-circle" style="pointer-events: none">3</a>

                          <p>Non Accounting Field</p>

                      </div> -->

                  </div>

              </div>

             

              <div class="row setup-content" id="step-1">

                  <div class="col-xs-12">

                      <div class="col-md-12">

                          <h5> <span id="showmsg" style="color: green"></span></h5>

                          <div class="row">

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Company Code:<span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                  <input list="compList" type="text" name="comp_code" id="comp_code" class="form-control" placeholder="Select Company Code" value="{{ old('comp_code') }}" maxlength="11" style="z-index: 1;" autocomplete="off">

                                  <datalist id="compList">

                                    <option value=''>--SELECT--</option>

                                    @foreach($comp_list as $row)

                                      <option value='{{ $row->COMP_CODE }}'data-xyz="{{ $row->COMP_NAME }}" <?php if($tran_code==$row->COMP_CODE) { echo 'selected'; } else { echo '';}?>>{{ $row->COMP_CODE }} = {{ $row->COMP_NAME }} </option>

                                    @endforeach

                                  </datalist>

                                </div>
                                <input type="hidden" value="" name="compName" id="compName">
                                <div class="showSeletedName" id="compText"></div>
                                <small id="comp_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>

                              </div> <!-- /.form-group -->

                            </div>

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Profit Center Code : <span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                  <select class="form-control" name="profit_code" id="profit_code" maxlength="6" autocomplete="off">
                                      <option value="">--SELECT--</option>

                                  </select>

                                </div>

                                <small id="pfct_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('profit_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>

                              </div><!-- /.form-group -->

                            </div>

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Plant Code :  <span class="required-field"></span><small id="plantCodeDubrerr" style="color: red;"></small></label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                  <input type="text" class="form-control codeCapital" name="plant_code" id="plant_code" value="{{ $series_code }}" placeholder="Plant Code" maxlength="6" autocomplete="off" readonly="">

                                </div>

                                <small id="plantc_err" style="color: red;"></small>
                                <small id="plantCodeErr" style="font-weight:600;"></small>
                
                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>

                              </div><!-- /.form-group -->

                            </div>

                            <div class="col-md-4">

                              <div class="form-group">

                                <label>Plant Name : <span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                  <input type="text" class="form-control" name="plant_name" id="plant_name" value="{{ $series_name }}" placeholder="Enter Plant Name" maxlength="40" autocomplete="off">

                                </div>

                                <small id="plantn_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('plant_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>

                              </div><!-- /.form-group -->

                            </div>

                          </div> <!--  /.row -->

                          <div class="row">

                            <div class="col-md-4">

                              <div class="form-group">

                                <label> Address 1: </label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                                  <input type="text" class="form-control" name="address1" id="address1" value="{{ $rfhead1 ?? '' }}" placeholder="Address 1" maxlength="40" style="z-index: 1;" autocomplete="off">

                                </div>

                              </div>

                            </div>

                            <div class="col-md-4">

                              <div class="form-group">

                                <label> Address 2: </label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                                  <input type="text" class="form-control" name="address2" id="address2" value="{{ $rfhead2 ?? '' }}" placeholder="Address 2" maxlength="40" autocomplete="off">

                                </div>

                              </div>

                            </div>

                            <div class="col-md-4">

                              <div class="form-group">

                                <label> Address 3: </label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                                  <input type="text" class="form-control" name="address3" id="address3" value="{{ $rfhead2 ?? '' }}" placeholder="Address 3"maxlength="40">

                                </div>

                              </div>

                            </div>

                          </div> <!-- /.row -->

                          <div class="row">

                            <div class="col-md-3">

                              <div class="form-group">

                                <label> Phone No 1: </label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                  <input type="text" class="form-control Number rightcontent" name="phone1"  id="phone1" value="{{ $rfhead4 ?? '' }}" placeholder="Enter Phone No 1" maxlength="10" autocomplete="off">

                                </div>

                              </div>

                            </div>

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Phone No 2:</label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                  <input type="text" class="form-control Number rightcontent" id="phone2" name="phone2" value="{{ $rfhead5 ?? '' }}" placeholder="Enter Phone No 2" maxlength="10" autocomplete="off">

                                </div>

                              </div>

                            </div>

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Fax: </label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-fax"></i></span>

                                  <input type="text" class="form-control" name="fax" id="fax" value="{{ $rfhead4 ?? '' }}" placeholder="Enter Fax" maxlength="12" autocomplete="off">

                                </div>

                              </div>

                            </div>

                            <div class="col-md-3">

                              <div class="form-group">

                                <label> Email-id: <span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                  <input type="email" class="form-control" name="email_id" id="email_id" value="{{ old('email_id') }}" placeholder="Enter Email-id" maxlength="40" autocomplete="off">

                                </div>

                                <small id="email_err" style="color: red;"></small>
                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('email_id', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>

                              </div>

                            </div>

                          </div>

                          <div class="row">

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>City : <span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-home"></i></span>

                                  <input list="cityList" class="form-control" name="city" id="city" value="{{ old('city') }}" placeholder="Enter City" maxlength="30" onchange="addresDetails()" autocomplete="off">

                                  <datalist id="cityList">

                                    <option value=''>--SELECT--</option>

                                    @foreach($city_lists as $row)

                                      <option value='{{ $row->CITY_CODE }}'data-xyz="{{ $row->CITY_NAME }}">{{ $row->CITY_CODE }}[{{ $row->CITY_NAME }}] </option>

                                    @endforeach

                                  </datalist>

                                </div>
                                <small id="cityCode_err" style="color: red;"></small>
                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('city', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>
                              </div>

                            </div>

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>District : <span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                  <input type="text" class="form-control" name="district" id="district" value="{{ $rfhead5 ?? '' }}" placeholder="Enter District" maxlength="30" readonly>

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

                                  <input list="stateList" type="text" class="form-control" name="state" value="{{ old('state_code') }}" placeholder="Select State" maxlength="30" id="statecode" readonly>

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

                            <div class="col-md-3">

                              <div class="form-group">

                                <label>Country : <span class="required-field"></span></label>

                                <div class="input-group">

                                  <span class="input-group-addon"><i class="fa fa-flag"></i></span>

                                  <input type="text" class="form-control" name="country" id="country" value="India" placeholder="Enter Country" maxlength="30" readonly>

                                </div>

                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>

                              </div>

                            </div>
                            
                          </div> <!-- row -->

                          <div class="row">

                            <div class="col-md-2">

                              <div class="form-group">

                                <label>Pincode : <span class="required-field"></span></label>

                                  <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                    <input type="text" class="form-control Number rightcontent" name="pincode" id="pincode" value="{{ old('pincode') }}" placeholder="Enter Pincode" maxlength="6" readonly>

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

                                  <input list="categoryList" class="form-control" name="plantCat" id="plantCatId" value="{{ old('plantCat') }}" placeholder="Select Plant Category" autocomplete="off">

                                  <datalist id="categoryList">

                                    <option value=''>--SELECT--</option>

                                    <option value='Yard' data-xyz="Yard">Yard</option>
                                    <option value='Ex-Siding' data-xyz="Ex-Siding">Ex-Siding</option>
                                    <option value='Others' data-xyz="Others">Others</option>

                                  </datalist>

                                </div>
                                <small id="plantCat_err" style="color: red;"></small>
                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('plantCat', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>
                              </div>

                            </div>

                          </div>

                          <!-- <center><button class="btn btn-primary" type="button" id="submitBtn">Next</button></center> -->

                      </div>

                  </div>

              </div>

                
              
             

          </div>

      </div>


    </div>

  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Amount Field</h2>

         </div>
        <div class="box-body">

          <div class="row">

            <div class="col-xs-12">

              <div class="col-md-12">

                <div class="row">

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>TAN No. : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control" name="tan_no" id="tan_no" value="{{ old('tan_no') }}" placeholder="Enter TAN No" maxlength="10" autocomplete="off">

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

                        <input type="text" class="form-control" name="tin_no"  id="tin_no" value="{{ old('tin_no') }}" placeholder="Enter TIN No" maxlength="10" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('series_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>CIN No. : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control Number" name="cin_no" id="cin_no" value="{{ old('cin_no') }}" placeholder="Enter CIN No" maxlength="4" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>PAN No. : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control" name="pan_no"  id="pan_no" value="{{ old('pan_no') }}" placeholder="Enter PAN No" maxlength="10" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('series_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>GST No. : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control" name="gst_no" id="gst_no" value="{{ old('gst_no') }}" placeholder="Enter GST No" maxlength="15" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        <input type="text" class="form-control" name="esic_no"  id="esic_no" value="{{ old('esic_no') }}" placeholder="Enter ESIC No" maxlength="15">

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

                        <input type="tetx" name="sale_tax_no" id="sale_tax_no" class="form-control" value="{{ old('sale_tax_no') }}" placeholder="Enter Sale Tax No" maxlength="10">

                      </div>

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>CSale Tax No : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" name="csale_tax_no" id="csale_tax_no" class="form-control" value="{{ old('csale_tax_no') }}" placeholder="Enter CSale Tax No" maxlength="10" autocomplete="off">

                      </div>

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Service Tax No. :</label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control" name="service_tax_no"  id="service_tax_no" value="{{ $rfhead4 ?? '' }}" placeholder="Service Tax No" maxlength="10">

                      </div>

                    </div>

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>EPFO No. : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control" name="epfo_no"  id="epfo_no" value="{{ old('epfo_no') }}" placeholder="EPFO No" maxlength="15" autocomplete="off"> 

                      </div>

                    </div>

                  </div>

                </div>

                <input type="hidden" name="lastid" id="lastid" value="">

                <!-- <center> <button class="btn btn-danger" type="button" id="backBtn1">Back</button>  <button class="btn btn-primary" type="button" id="submitBtn22">Next</button>
                </center> -->

              </div>

            </div>

          </div>
          
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-success">
        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Non Accounting Field</h2>

         </div>
        <div class="box-body">

          <div class="row">

            <div class="col-xs-12">

              <div class="col-md-12">

                <span id="showmsg2" style="color: green;"></span>

                  <div class="row"> 

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>ECC No. : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="ecc_no"  id="ecc_no" value="{{ $series_code }}" placeholder="Enter ECC No" maxlength="15" autocomplete="off">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Range No : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="range_no" id="range_no" value="{{ $series_name }}" placeholder="Enter Range No" maxlength="17" autocomplete="off">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Range Name: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                          <input type="text" name="range_name" id="range_name" class="form-control" value="{{ old('range_name') }}" placeholder="Enter Range Name" maxlength="20">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Range Address1 : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" name="range_addres1" id="range_addres1" class="form-control" value="{{ old('range_addres1') }}"placeholder="Enter Range Address1" maxlength="20" autocomplete="off">

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

                          <input type="text" class="form-control" name="range_addres2" id="range_addres2" value="{{ $rfhead4 ?? '' }}" placeholder="Range Address2" maxlength="20" autocomplete="off">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Division: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="division" id="division" value="{{ $rfhead4 ?? '' }}" placeholder="Enter Division" maxlength="20" autocomplete="off">

                        </div>

                      </div>

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Collector : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="hidden" name="lastid1" id="lastid1">

                          <input type="text" class="form-control" name="collector" id="collector" value="{{ $rfhead5 ?? '' }}" placeholder="Enter Collector" maxlength="20" autocomplete="off">

                        </div>

                      </div>
                      
                    </div>

                  </div>

                  <div style="text-align: center;">

                    <center><button type="submit" class="btn btn-primary" id=""><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Save</button>
                      <button class="btn btn-warning" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reset</button>
                    </center>

                  </div>

              </div>

            </div>

          </div>
          
        </div>
      </div>
    </div>
  </div>

  </form> 

</section>

</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/CommonAjax.js') }}" ></script>
<script type="text/javascript">

  $(document).ready(function(){

    $('#profit_code').on('change',function(){
        // $('#plant_code').val('');
    });

    $("#submitBtn3").click(function(event){

      var plant_code  = $("#plant_code").val();
      var plant_name  = $("#plant_name").val();
      var comp_code   =  $("#comp_code").val();
      var profit_code =  $("#profit_code").val();
      var email_id    =  $("#email_id").val();
      var citycode    =  $("#city").val();
      var filter      = /^[a-z0-9._-]+@[a-z]+.[a-z]{2,5}$/i;

      if(plant_code=='' && plant_name=='' && comp_code=='' && email_id=='' && citycode=='' && profit_code==''){

        $("#plantc_err").html('The Plant code field is required.');
        $("#plantn_err").html('The Plant name field is required.');
        $("#comp_err").html('The Company Code field is required.');
        $("#email_err").html('The email field is required.');
        $("#cityCode_err").html('The City field is required.');
        $("#pfct_err").html('The Profit Center field is required.');
        return false;

      }

      if(plant_code=='' && plant_name=='' && comp_code==''){

        $("#plantc_err").html('The Plant code field is required.');

        $("#plantn_err").html('The Plant name field is required.');

        $("#comp_err").html('The Company Code field is required.');

        $("#email_err").html('');
        $("#cityCode_err").html('');
        $("#pfct_err").html('');

        return false;

      }

      if(plant_code=='' && plant_name==''){

        $("#plantc_err").html('The Plant code field is required.');

        $("#plantn_err").html('The Plant name field is required.');

        $("#comp_err").html('');
        $("#email_err").html('');
        $("#cityCode_err").html('');
        $("#pfct_err").html('');

        return false;

      }

      if(comp_code=='' && email_id==''){

         $("#comp_err").html('The Company Code field is required.');

        $("#email_err").html('The email field is required.');

        $("#plantc_err").html('');
        $("#plantn_err").html('');
        $("#cityCode_err").html('');
        $("#pfct_err").html('');

        return false;

      }

      if(plant_code==''){

        $("#plantc_err").html('The Plant Code field is required.');

        $("#plantn_err").html('');
        $("#comp_err").html('');
        $("#email_err").html('');
        $("#cityCode_err").html('');
        $("#pfct_err").html('');

        return false;

      }

      if(profit_code==''){

        $("#pfct_err").html('The Profit Code field is required.');

        $("#plantc_err").html('');
        $("#plantn_err").html('');
        $("#comp_err").html('');
        $("#email_err").html('');
        $("#cityCode_err").html('');
       
        return false;

      }

      if(plant_name==''){

       $("#plantn_err").html('The Plant Name field is required.');

        $("#plantc_err").html('');
        $("#comp_err").html('');
        $("#email_err").html('');
        $("#cityCode_err").html('');
        $("#pfct_err").html('');

       return false;

      }

      if(comp_code==''){

        $("#comp_err").html('The Company Code field is required.');

        $("#plantc_err").html('');
        $("#plantn_err").html('');
        $("#email_err").html('');
        $("#cityCode_err").html('');
        $("#pfct_err").html('');

        return false;

      }
      if(citycode==''){

        $("#cityCode_err").html('The City field is required.');

        $("#plantc_err").html('');
        $("#plantn_err").html('');
        $("#comp_err").html('');
        $("#email_err").html('');
        $("#pfct_err").html('');

        return false;

      }
      if(email_id==''){

        $("#email_err").html('The Email field is required.');
        
        $("#plantc_err").html('');
        $("#plantn_err").html('');
        $("#comp_err").html('');
        $("#cityCode_err").html('');
        $("#pfct_err").html('');

          return false;

      }else if(!filter.test(email_id))
      {
        $("#email_err").html('The valid Email field is required.');

        $("#plantc_err").html('');
        $("#plantn_err").html('');
        $("#comp_err").html('');
        $("#cityCode_err").html('');
        $("#pfct_err").html('');

        return false;     
      }else if(email_id.length > 40){
         $("#email_err").html('Email-id is not Greater 40 Character.');
         $("#plantc_err").html('');
         $("#plantn_err").html('');
         $("#comp_err").html('');
         $("#cityCode_err").html('');
         $("#pfct_err").html('');
      }else{
          // $('.showbtn').removeClass('hidebtn');
          // $("#step_3").addClass('hidebtn');
          // $('a[href="#step-2"]').click();
          
         // document.getElementById("submitdata").reset();
          $("#email_err").html('');
          $("#plantc_err").html('');
          $("#plantn_err").html('');
          $("#comp_err").html('');
          $("#pfct_err").html('');
      }

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

      $.ajax({

        url: "{{ url('/finance/get_pfct') }}",

        method : 'POST',

        type: 'JSON',

        data: {comp_code: comp_code},

      })

      .done(function(data) {

        $("#profit_code").html(data);

      })

    });

</script>

<script type="text/javascript">

    $(document).ready(function(){

      $("#comp_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#compList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
          $('#comp_code').val('');
          $('#compText').html('');
          $('#compName').val('');
          $('#plant_code').val('');
        }else{
          $('#compText').html(msg);
          $('#compName').val(msg);
          $('#plant_code').val('');
          funGenPlantCode();
        }

      });

      $("#tax_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#taxList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

          document.getElementById("taxText").innerHTML = msg; 

      });

      function funGenPlantCode(){

        var compcode = $('#comp_code').val();

        if(compcode){

          var likename = compcode;
          // console.log('likename',likename);
          var tbl_name = 'MASTER_PLANT';
          var col_code = 'PLANT_CODE';
        

          $.ajaxSetup({

                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

           });

          $.ajax({

           url:"{{ url('/Master/generate-dyanamic-code') }}",

           data: {likename:likename,tbl_name:tbl_name,col_code:col_code},

            success:function(data){
              var data1 = JSON.parse(data);

              if(data1.response == 'success'){

                var newcode = data1.data;
                
                if(newcode != '' || newcode != null){
                  $('#plant_code').val(newcode);
                }else{
                  $('#plant_code').val('');
                }

              }
            },
            error:function(){
              $('#plantCodeErr').html('*Plant Code is not Generated...!').css('color','red');
              $('#submitBtn').prop('disabled',true);

            }
          });

        }
  
      }

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

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Plant Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var PlantCodeHelp = $('#PlantCodeHelp').val();

           if(PlantCodeHelp == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-plant-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {PlantCodeHelp: PlantCodeHelp},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Gl key Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                              $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.PLANT_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.PLANT_NAME+'</td></tr>');
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
    $('#plant_code').on('input',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var plant_code = $('#plant_code').val();
      var comp_code = $('#comp_code').val();
      var pfct_code = $('#profit_code').val();

        if(plant_code == '' && comp_code =='' && pfct_code ==''){

           $('#showSearchCodeList').hide();

        }else{

          $.ajax({

            url:"{{ url('search-plant-code-get') }}",

             method : "POST",

             type: "JSON",

             data: {plant_code: plant_code,comp_code:comp_code,pfct_code:pfct_code},

             success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                       $("#plantCodeDubrerr").html('');
                       $("#submitBtn").prop('disabled',false);
                  }else if(data1.response == 'success'){

                      console.log('exist',data1.existpl_data);

                      if(data1.existpl_data ==''){
                        $("#plantCodeDubrerr").html('');
                        $("#submitBtn").prop('disabled',false);
                      }else{
                        $("#plantCodeDubrerr").html('This plant code already exist');
                        $("#submitBtn").prop('disabled',true);
                      }

                      var count =   data1.data.length;
                      if(count > 0){

                        
                      }

                       var objcity = data1.data;
                       $('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.PLANT_CODE+'</span><br>');
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
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>

@endsection