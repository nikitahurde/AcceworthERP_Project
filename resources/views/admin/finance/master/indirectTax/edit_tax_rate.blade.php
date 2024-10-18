@extends('admin.main')


@section('AdminMainContent')


@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')


@include('admin.include.sidebar')

<style type="text/css">


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

.setwidthsel{

  width: 72px;

}

.amntFild{

  display: none;

}

.nonAccFild{

 display: none;

}

.showSeletedName{



    font-size: 15px;



    margin-top: 2%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;



  }

.headBox{

  width: 100px !important;

}

.staticBlock{

  width: 90px;

}

.DatePickerToFrom{

    padding: 2px !important;

    border-radius: 1px !important;

    border: 1px solid #767676 !important;

}


.HeadTextshow{

    color: #3c8dbc;

    font-size: 90%;

}



.GlTextshow{

    font-weight: 900;

    color: #4f90b5;



  }
.required-field::before {

    content: "*";

    color: red;

  }
.TaxCodeMargin{
  margin-left: 4%;
}
.StaticBlockGet{
  -webkit-appearance: menulist-button;
    height: 24px;
}
.taxIndClass {
   -webkit-appearance: menulist-button;
   height: 24px;
}
.taxGlClass{
  -webkit-appearance: menulist-button;
   height: 24px;
   width: 100%;
}
.box-header>.box-tools {
    position: absolute !important;
    right: 10px !important;
    top: 3px !important;
}
.glblock{
  width: 90px;
}
</style>

<style>
  @media only screen and (max-width: 600px) {
   .TaxCodeMargin{
      margin-left: 0%;
    }
  }

</style>





<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master Tax Rate



            <small>Update Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/finance/tax-rate-master')}}">Update Master Tax Rate  </a></li>



            <li class="Active"><a href="{{ URL('/finance/tax-rate-master')}}">Update Tax Rate </a></li>



          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Tax Rate</h2>

              <div class="box-tools pull-right">



                <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tax-Rate-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Tax Rate</a>



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





            <div class="box-body" style="overflow-x: auto;">







               <form action="{{ url('/Master/InDirect-Direct-Tax/Update-Tax-Rate') }}" method="POST" id="TaxRateID">

                @csrf
                 

                  <div class="row">

                    <div class="col-xs-12">
                      <input type="hidden" name="vr_tax_rate" value="<?php echo $tax_code_lists->TAX_CODE; ?>">
                      <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-3 TaxCodeMargin">

                          <div class="form-group">

                          <label>Tax Code : <span class="required-field"></span></label>

                           <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                           <input list="taxList"  id="tax_code" name="tax_code" class="form-control  pull-left" value="<?php echo $tax_code_lists->TAX_CODE;?>" placeholder="Select Tax Code" maxlength="6" readonly>

                            <datalist id="taxList">

                              @foreach($tax_list as $row)

                                <option value='{{ $row->TAX_CODE }}' data-xyz ="{{ $row->TAX_NAME }}">{{ $row->TAX_CODE }} = {{ $row->TAX_NAME }} </option>

                               @endforeach

                            </datalist>

                          </div>

                          <small> 

                            <div class="pull-left showSeletedName" id="taxText"><?php echo $tax_code_lists->TAX_NAME;?></div>
                            <input type="hidden" id="tax_name" name="tax_name" value="<?php echo $tax_code_lists->TAX_NAME;?>">

                          </small>

                          <small id="taxcodeErr" class="form-text text-muted"> 
                             {!! $errors->first('tax_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                        </div>

                          <!-- /.form-group -->

                      </div>

                       <div class="col-md-5"></div>
                      </div>



                        <div class="row" style="    margin-top: 3%;">

                          <div class="col-md-12" >

                           
                              <table class="table table-bordered table-striped table-hover">

                                

                                <tbody>

<style>
  .TdBold{
  font-weight:bold;
}
</style>                           

                                  <tr align="center">

                                    <td class="TdBold">Sr.No</td>

                                    <td class="TdBold">Head</td>

                                    <td class="TdBold">Index</td>

                                    <td class="TdBold">Logic</td>

                                    <td class="TdBold">Rate</td>

                                    <td class="TdBold">ToDate</td>

                                    <td class="TdBold">FromDate</td>

                                    <td class="TdBold">GLCode</td>

                                    <td class="TdBold">Static</td>

                                  </tr>

                                  <tr>

                                    <th class="text-center">1</th>

                                    <th scope="row">
                                      <select class="taxIndClass setwidthsel" id="HeadList1" name="amthead1"  class="headBox" onchange="haedcname(1)" readonly="true">
                                        <option value="">--select--</option>}
                                        option
                                         @foreach($tax_ind_list as $key)
                                        <option value="{{$key->TAXIND_CODE}}" <?php 
                                  if(isset($tran_tax_data[0]->TAXIND_CODE)){
                                    if($tran_tax_data[0]->TAXIND_CODE == $key->TAXIND_CODE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>{{ $key->TAXIND_CODE }}</option>
                                         @endforeach
                                      </select>

                                      <input type="hidden" value="A" name="static_ind_bs">

                                    </th>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                    <td></td>

                                  </tr>



                                  <tr>

                                    <th class="text-center">2</th>

                                    <th scope="row">

                                     <!--  <select class="taxIndClass setwidthsel" id="amthead2" name="amthead[]"  class="headBox" onchange="haedcname(2)"> -->
                                      <input name="amthead[]" id="amthead2" value="<?php if(isset($tran_tax_data[1]->TAXIND_CODE)) echo $tran_tax_data[1]->TAXIND_CODE; ?>" list="HeadList2" maxlength="4" class="headBox" onchange="haedcname(2)">
                                        <datalist id="HeadList2">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>
                                        
                                        <small class="HeadTextshow" id="HeadText2"><?php if(isset($tran_tax_data[1]->TAXIND_NAME)) echo $tran_tax_data[1]->TAXIND_NAME; ?></small>
                                        <input type="hidden" name="headName[]" id="headName2" value="<?php if(isset($tran_tax_data[1]->TAXIND_NAME)) echo $tran_tax_data[1]->TAXIND_NAME; ?>">
                                     
                                    </th>




                                    <td><select name="afratei[]" class="setwidthsel taxIndClass" id="afratei2" onchange="rate_if_az(2);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{$key->RATE_VALUE }}" <?php 
                                  if(isset($tran_tax_data[1]->RATE_INDEX)){
                                    if($tran_tax_data[1]->RATE_INDEX == $key->RATE_VALUE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>
                                          <?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> 
                                      </option>



                                    <?php } ?>

                                    </select>
                                      <small id="sericecodeErr" class="form-text text-muted">
                                           {!! $errors->first('afratei', '<p class="help-block" style="color:red;">:message</p>') !!}
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic2" value="<?php if(isset($tran_tax_data[1]->TAX_LOGIC)){
                                      echo $tran_tax_data[1]->TAX_LOGIC;
                                    } ?>" size="9" maxlength="12" class="textBox">
                                      <small id="sericecodeErr" class="form-text text-muted">
                                         {!! $errors->first('aflogic', '<p class="help-block" style="color:red;">:message</p>') !!}
                                      </small>
                                    </td>



                                    <td>
                                      <input type="text" name="afrate[]" id="afrate2" value="<?php if(isset($tran_tax_data[1]->TAX_RATE)){
                                      echo $tran_tax_data[1]->TAX_RATE;
                                    } ?>" size="5" maxlength="11" class="textBox">
                                    <small id="sericecodeErr" class="form-text text-muted">
                                         {!! $errors->first('afrate', '<p class="help-block" style="color:red;">:message</p>') !!}
                                      </small>
                                    </td>

                                      <?php 
                                      $to_dt = '';
                                      $from_dt = '';
                                      if(isset($tran_tax_data[1]->TO_DATE)){

                                      $todate = $tran_tax_data[1]->TO_DATE;
                                           if($todate != '0000-00-00'){
                                              $to_dt =  date('d-m-Y',strtotime($todate));
                                            }else{
                                              $to_dt = '';
                                            }
                                       }else { }

                                       if(isset($tran_tax_data[1]->FROM_DATE)){
                                            $fromdate = $tran_tax_data[1]->FROM_DATE;
                                           if($fromdate != '0000-00-00'){
                                              $from_dt =  date('d-m-Y',strtotime($tran_tax_data[1]->FROM_DATE));
                                            }else{
                                              $from_dt = '';
                                            }
                                       }else {}
                                      

                                     ?>

                                    <td><input type="text" name="ToDate[]" id="ToDate2" value="{{$to_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate2" value="{{$from_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                      <input list="glList2"  id="afgl_code2" name="afgl_code[]"  value="<?php if(isset($tran_tax_data[1]->TAX_GL_CODE)){echo $tran_tax_data[1]->TAX_GL_CODE;}?>" class="taxIndClass glblock" placeholder="Select Gl-Code" size="25" onchange="glCodeName(2)">

                                      <datalist id="glList2">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>
                                      <small class="GlTextshow" id="glText2"><?php if(isset($tran_tax_data[1]->TAX_GL_NAME)){echo $tran_tax_data[1]->TAX_GL_NAME;}?></small>
                                      <input type="hidden" id="gl_name2" name="glName[]" value="<?php if(isset($tran_tax_data[1]->TAX_GL_NAME)){echo $tran_tax_data[1]->TAX_GL_NAME;}?>">
                                    </td>




                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock2" name="statici[]">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php 
                                  if(isset($tran_tax_data[1]->STATIC_IND)){
                                    if($tran_tax_data[1]->STATIC_IND == 1){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>Yes</option>
                                          <option value="0" <?php 
                                  if(isset($tran_tax_data[1]->STATIC_IND)){
                                    if($tran_tax_data[1]->STATIC_IND == 0){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>No</option>
                                        </select>
                                      
                                      </div>

                                    </td>

                                  </tr>







                                  <tr>

                                     <th class="text-center">3</th>

                                     <th scope="row">

                                      <input name="amthead[]" id="amthead3" value="{{$tran_tax_data[2]->TAXIND_CODE}}" list="HeadList3" maxlength="4" class="headBox" onchange="haedcname(3)">
                                        <datalist id="HeadList3">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>
                                        
                                        <small class="HeadTextshow" id="HeadText3">{{$tran_tax_data[2]->TAXIND_NAME}}</small>
                                        <input type="hidden" name="headName[]" id="headName3" value="{{$tran_tax_data[2]->TAXIND_NAME}}">

                                    </th>



                                    <td><select name="afratei[]" id="afratei3" class="taxIndClass setwidthsel" onchange="rate_if_az(3);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}" <?php 
                                  if(isset($tran_tax_data[2]->RATE_INDEX)){
                                    if($tran_tax_data[2]->RATE_INDEX == $key->RATE_VALUE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select></td>



                                    <td><input type="text" name="aflogic[]" id="aflogic3" value="<?php if(isset($tran_tax_data[2]->TAX_LOGIC)){
                                      echo $tran_tax_data[2]->TAX_LOGIC;
                                    } ?>" size="9" maxlength="12" class="textBox"></td>



                                     <td><input type="text" name="afrate[]" id="afrate3" value="<?php if(isset($tran_tax_data[2]->TAX_RATE)){
                                      echo $tran_tax_data[2]->TAX_RATE;
                                    } ?>" size="5" maxlength="11" class="textBox"></td>

                                      <?php
                                      $to_dt = '';
                                      $from_dt = '';
                                      if(isset($tran_tax_data[2]->TO_DATE)){
                                      $todate = $tran_tax_data[2]->TO_DATE;
                                           if($todate != '0000-00-00'){
                                              $to_dt =  date('d-m-Y',strtotime($todate));
                                            }else{
                                              $to_dt = '';
                                            }
                                       }else { }

                                       if(isset($tran_tax_data[2]->FROM_DATE)){
                                            $fromdate = $tran_tax_data[2]->FROM_DATE;
                                           if($fromdate != '0000-00-00'){
                                              $from_dt =  date('d-m-Y',strtotime($tran_tax_data[2]->FROM_DATE));
                                            }else{
                                              $from_dt = '';
                                            }
                                       }else {}
                                      

                                     ?>

                                     <td><input type="text" name="ToDate[]" id="ToDate3" value="{{$to_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                     <td><input type="text" name="FromDate[]" id="FromDate3" value="{{$from_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                        <input list="glList3"  id="afgl_code3" name="afgl_code[]"  value="<?php if(isset($tran_tax_data[2]->TAX_GL_CODE)){echo $tran_tax_data[2]->TAX_GL_CODE;}?>" class="taxIndClass glblock" placeholder="Select Gl-Code" size="25" onchange="glCodeName(3)">

                                        <datalist id="glList3">

                                          @foreach($gl_code_list as $row)

                                            <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                           @endforeach

                                        </datalist>
                                         <small class="GlTextshow" id="glText3"><?php if(isset($tran_tax_data[2]->TAX_GL_NAME)){echo $tran_tax_data[2]->TAX_GL_NAME;}?></small>
                                      <input type="hidden" id="gl_name3" name="glName[]" value="<?php if(isset($tran_tax_data[2]->TAX_GL_NAME)){echo $tran_tax_data[2]->TAX_GL_NAME;}?>">
                                    </td>



                                    <td>

                                      <div class="staticBlock">

                                       <select class="StaticBlockGet" id="staticIndBlock3" name="statici[]">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php 
                                  if(isset($tran_tax_data[2]->STATIC_IND)){
                                    if($tran_tax_data[2]->STATIC_IND == 1){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>Yes</option>
                                          <option value="0" <?php 
                                  if(isset($tran_tax_data[2]->STATIC_IND)){
                                    if($tran_tax_data[2]->STATIC_IND == 0){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>





                                  <tr>

                                     <th class="text-center">4</th>

                                     <th scope="row">

                                     <input name="amthead[]" id="amthead4" value="<?php if(isset($tran_tax_data[3]->TAXIND_CODE)) echo $tran_tax_data[3]->TAXIND_CODE; ?>" list="HeadList4" maxlength="4" class="headBox" onchange="haedcname(4)">
                                        <datalist id="HeadList4">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>
                                        
                                        <small class="HeadTextshow" id="HeadText2"><?php if(isset($tran_tax_data[3]->TAXIND_NAME)) echo $tran_tax_data[3]->TAXIND_NAME; ?></small>
                                        <input type="hidden" name="headName[]" id="headName2" value="<?php if(isset($tran_tax_data[3]->TAXIND_NAME)) echo $tran_tax_data[3]->TAXIND_NAME; ?>">

                                  </th>

                                    

                                    <td><select name="afratei[]" id="afratei4" class="taxIndClass setwidthsel" onchange="rate_if_az(4);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}" <?php 
                                  if(isset($tran_tax_data[3]->RATE_INDEX)){
                                    if($tran_tax_data[3]->RATE_INDEX == $key->RATE_VALUE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select></td>



                                    <td><input type="text" name="aflogic[]" id="aflogic4" value="<?php if(isset($tran_tax_data[3]->TAX_LOGIC)){
                                      echo $tran_tax_data[3]->TAX_LOGIC;
                                    } ?>" size="9" maxlength="12" class="textBox"></td>

                                    <td><input type="text" name="afrate[]" id="afrate4" value="<?php if(isset($tran_tax_data[3]->TAX_RATE)){
                                      echo $tran_tax_data[3]->TAX_RATE;
                                    } ?>" size="5" maxlength="11" class="textBox"></td>

                                    
                                     <?php 
                                      $to_dt = '';
                                      $from_dt = '';
                                      if(isset($tran_tax_data[3]->TO_DATE)){
                                      $todate = $tran_tax_data[3]->TO_DATE;
                                           if($todate != '0000-00-00'){
                                              $to_dt =  date('d-m-Y',strtotime($todate));
                                            }else{
                                              $to_dt = '';
                                            }
                                       }else { }

                                       if(isset($tran_tax_data[3]->FROM_DATE)){
                                            $fromdate = $tran_tax_data[3]->FROM_DATE;
                                           if($fromdate != '0000-00-00'){
                                              $from_dt =  date('d-m-Y',strtotime($tran_tax_data[3]->FROM_DATE));
                                            }else{
                                              $from_dt = '';
                                            }
                                       }else {}
                                      

                                     ?>
                                    <td><input type="text" name="ToDate[]" id="ToDate4" value="{{$to_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>

                                    <td><input type="text" name="FromDate[]" id="FromDate4" value="{{$from_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>

                                    <td>
                                        <input list="glList4"  id="afgl_code4" name="afgl_code[]"  value="<?php if(isset($tran_tax_data[3]->TAX_GL_CODE)){echo $tran_tax_data[3]->TAX_GL_CODE;}?>" class="taxIndClass glblock" placeholder="Select Gl-Code" size="25" onchange="glCodeName(4)">

                                        <datalist id="glList4">

                                          @foreach($gl_code_list as $row)

                                            <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                           @endforeach

                                        </datalist>
                                        <small class="GlTextshow" id="glText4"><?php if(isset($tran_tax_data[3]->TAX_GL_NAME)){echo $tran_tax_data[3]->TAX_GL_NAME;}?></small>
                                       <input type="hidden" id="gl_name4" name="glName[]" value="<?php if(isset($tran_tax_data[3]->TAX_GL_NAME)){echo $tran_tax_data[3]->TAX_GL_NAME;}?>">
                                    </td>

                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock4" name="statici[]">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php 
                                  if(isset($tran_tax_data[3]->STATIC_IND)){
                                    if($tran_tax_data[3]->STATIC_IND == 1){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>Yes</option>
                                          <option value="0" <?php 
                                  if(isset($tran_tax_data[3]->STATIC_IND)){
                                    if($tran_tax_data[3]->STATIC_IND == 0){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>





                                  <tr>

                                     <th class="text-center">5</th>

                                     <th scope="row">

                                       <input name="amthead[]" id="amthead5" value="<?php if(isset($tran_tax_data[4]->TAXIND_CODE)) echo $tran_tax_data[4]->TAXIND_CODE; ?>" list="HeadList5" maxlength="4" class="headBox" onchange="haedcname(5)">
                                        <datalist id="HeadList5">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>
                                        
                                        <small class="HeadTextshow" id="HeadText5"><?php if(isset($tran_tax_data[43]->TAXIND_NAME)) echo $tran_tax_data[4]->TAXIND_NAME; ?></small>
                                        <input type="hidden" name="headName[]" id="headName5" value="<?php if(isset($tran_tax_data[4]->TAXIND_NAME)) echo $tran_tax_data[4]->TAXIND_NAME; ?>">

                                  </th>

                                    

                                    <td><select name="afratei[]" id="afratei5" class="taxIndClass setwidthsel" onchange="rate_if_az(5);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}" <?php 
                                  if(isset($tran_tax_data[4]->RATE_INDEX)){
                                    if($tran_tax_data[4]->RATE_INDEX == $key->RATE_VALUE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select></td>



                                    <td><input type="text" name="aflogic[]" id="aflogic5" value="<?php if(isset($tran_tax_data[4]->TAX_LOGIC)){
                                      echo $tran_tax_data[4]->TAX_LOGIC;
                                    } ?>" size="9" maxlength="12" class="textBox"></td>



                                    <td><input type="text" name="afrate[]" id="afrate5" value="<?php if(isset($tran_tax_data[4]->TAX_RATE)){
                                      echo $tran_tax_data[4]->TAX_RATE;
                                    } ?>" size="5" maxlength="11" class="textBox"></td>

                                    
                                   <?php 
                                      $to_dt = '';
                                      $from_dt = '';
                                      if(isset($tran_tax_data[4]->TO_DATE)){
                                      $todate = $tran_tax_data[4]->TO_DATE;
                                       if($todate != '0000-00-00'){
                                          $to_dt =  date('d-m-Y',strtotime($todate));
                                        }else{
                                          $to_dt = '';
                                        }
                                   }else { }

                                   if(isset($tran_tax_data[4]->FROM_DATE)){
                                        $fromdate = $tran_tax_data[4]->FROM_DATE;
                                       if($fromdate != '0000-00-00'){
                                          $from_dt =  date('d-m-Y',strtotime($tran_tax_data[3]->FROM_DATE));
                                        }else{
                                          $from_dt = '';
                                        }
                                   }else {}
                                    ?>

                                    <td><input type="text" name="ToDate[]" id="ToDate5" value="{{$to_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate5" value="{{$from_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom"  autocomplete="off"></td>

                                    <td>
                                        <input list="glList5"  id="afgl_code5" name="afgl_code[]"  value="<?php if(isset($tran_tax_data[4]->TAX_GL_CODE)){echo $tran_tax_data[4]->TAX_GL_CODE;}?>" class="taxIndClass glblock" placeholder="Select Gl-Code" size="25" onchange="glCodeName(5)">

                                        <datalist id="glList5">

                                          @foreach($gl_code_list as $row)

                                            <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                           @endforeach

                                        </datalist>
                                         <small class="GlTextshow" id="glText5"><?php if(isset($tran_tax_data[4]->TAX_GL_NAME)){echo $tran_tax_data[4]->TAX_GL_NAME;}?></small>
                                        <input type="hidden" id="gl_name5" name="glName[]" value="<?php if(isset($tran_tax_data[4]->TAX_GL_NAME)){echo $tran_tax_data[4]->TAX_GL_NAME;}?>">
                                    </td>



                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock5" name="statici[]">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php 
                                  if(isset($tran_tax_data[4]->STATIC_IND)){
                                    if($tran_tax_data[4]->STATIC_IND == 1){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>Yes</option>
                                          <option value="0" <?php 
                                  if(isset($tran_tax_data[4]->STATIC_IND)){
                                    if($tran_tax_data[4]->STATIC_IND == 0){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>



                                  <tr>

                                     <th class="text-center">6</th>

                                     <th scope="row">
                                    

                                      <input name="amthead[]" id="amthead6" value="<?php if(isset($tran_tax_data[5]->TAXIND_CODE)) echo $tran_tax_data[5]->TAXIND_CODE; ?>" list="HeadList6" maxlength="4" class="headBox" onchange="haedcname(6)">
                                        <datalist id="HeadList6">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>
                                        
                                        <small class="HeadTextshow" id="HeadText6"><?php if(isset($tran_tax_data[5]->TAXIND_NAME)) echo $tran_tax_data[5]->TAXIND_NAME; ?></small>
                                        <input type="hidden" name="headName[]" id="headName6" value="<?php if(isset($tran_tax_data[5]->TAXIND_NAME)) echo $tran_tax_data[5]->TAXIND_NAME; ?>">

                                     </th>



                                    <td><select name="afratei[]" id="afratei6" class="taxIndClass setwidthsel" onchange="rate_if_az(6);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{$key->RATE_VALUE}}" <?php 
                                  if(isset($tran_tax_data[5]->RATE_INDEX)){
                                    if($tran_tax_data[5]->RATE_INDEX == $key->RATE_VALUE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select></td>



                                    <td><input type="text" name="aflogic[]" id="aflogic6" value="<?php if(isset($tran_tax_data[5]->TAX_LOGIC)){
                                      echo $tran_tax_data[5]->TAX_LOGIC;
                                    } ?>" size="9" maxlength="12" class="textBox"></td>



                                    <td><input type="text" name="afrate[]" id="afrate6" value="<?php if(isset($tran_tax_data[5]->TAX_RATE)){
                                      echo $tran_tax_data[5]->TAX_RATE;
                                    } ?>" size="5" maxlength="11" class="textBox"></td>

                                     <?php 
                                      $to_dt = '';
                                      $from_dt = '';
                                      if(isset($tran_tax_data[5]->TO_DATE)){
                                      $todate = $tran_tax_data[5]->TO_DATE;
                                           if($todate != '0000-00-00'){
                                              $to_dt =  date('d-m-Y',strtotime($todate));
                                            }else{
                                              $to_dt = '';
                                            }
                                       }else { }

                                       if(isset($tran_tax_data[5]->FROM_DATE)){
                                            $fromdate = $tran_tax_data[5]->FROM_DATE;
                                           if($fromdate != '0000-00-00'){
                                              $from_dt =  date('d-m-Y',strtotime($tran_tax_data[5]->FROM_DATE));
                                            }else{
                                              $from_dt = '';
                                            }
                                       }else {}
                                      

                                     ?>

                                    <td><input type="text" name="ToDate[]" id="ToDate6" value="{{$to_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate6" value="{{$from_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                        <input list="glList6"  id="afgl_code6" name="afgl_code[]"  value="<?php if(isset($tran_tax_data[5]->TAX_GL_CODE)){echo $tran_tax_data[5]->TAX_GL_CODE;}?>" class="taxIndClass glblock" placeholder="Select Gl-Code" size="25" onchange="glCodeName(6)">

                                        <datalist id="glList6">

                                          @foreach($gl_code_list as $row)

                                            <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                           @endforeach

                                        </datalist>
                                        <small class="GlTextshow" id="glText6"><?php if(isset($tran_tax_data[5]->TAX_GL_NAME)){echo $tran_tax_data[5]->TAX_GL_NAME;}?></small>
                                        <input type="hidden" id="gl_name6" name="glName[]" value="<?php if(isset($tran_tax_data[5]->TAX_GL_NAME)){echo $tran_tax_data[5]->TAX_GL_NAME;}?>">
                                    </td>



                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock6" name="statici[]">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php 
                                  if(isset($tran_tax_data[5]->STATIC_IND)){
                                    if($tran_tax_data[5]->STATIC_IND == 1){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>Yes</option>
                                          <option value="0" <?php 
                                  if(isset($tran_tax_data[5]->STATIC_IND)){
                                    if($tran_tax_data[5]->STATIC_IND == 0){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>





                                 <tr>

                                     <th class="text-center">7</th>

                                     <th scope="row">
                                    
                                      <input name="amthead[]" id="amthead7" value="<?php if(isset($tran_tax_data[6]->TAXIND_CODE)) echo $tran_tax_data[6]->TAXIND_CODE; ?>" list="HeadList6" maxlength="4" class="headBox" onchange="haedcname(7)">
                                        <datalist id="HeadList7">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>
                                        
                                        <small class="HeadTextshow" id="HeadText7"><?php if(isset($tran_tax_data[6]->TAXIND_NAME)) echo $tran_tax_data[6]->TAXIND_NAME; ?></small>
                                        <input type="hidden" name="headName[]" id="headName7" value="<?php if(isset($tran_tax_data[6]->TAXIND_NAME)) echo $tran_tax_data[6]->TAXIND_NAME; ?>">


                                     </th>



                                    <td><select name="afratei[]" id="afratei7" class="taxIndClass setwidthsel" onchange="rate_if_az(7);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}" <?php 
                                  if(isset($tran_tax_data[6]->RATE_INDEX)){
                                    if($tran_tax_data[6]->RATE_INDEX == $key->RATE_VALUE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select></td>



                                    <td><input type="text" name="aflogic[]" id="aflogic7" value="<?php if(isset($tran_tax_data[6]->TAX_LOGIC)){
                                      echo $tran_tax_data[6]->TAX_LOGIC;
                                    } ?>" size="9" maxlength="12" class="textBox"></td>



                                    <td><input type="text" name="afrate[]" id="afrate7" value="<?php if(isset($tran_tax_data[6]->TAX_RATE)){
                                      echo $tran_tax_data[6]->TAX_RATE;
                                    } ?>" size="5" maxlength="11" class="textBox"></td>

                                   <?php 
                                      $to_dt = '';
                                      $from_dt = '';
                                      if(isset($tran_tax_data[6]->TO_DATE)){
                                      $todate = $tran_tax_data[6]->TO_DATE;
                                           if($todate != '0000-00-00'){
                                              $to_dt =  date('d-m-Y',strtotime($todate));
                                            }else{
                                              $to_dt = '';
                                            }
                                       }else { }

                                       if(isset($tran_tax_data[6]->FROM_DATE)){
                                            $fromdate = $tran_tax_data[6]->FROM_DATE;
                                           if($fromdate != '0000-00-00'){
                                              $from_dt =  date('d-m-Y',strtotime($tran_tax_data[6]->FROM_DATE));
                                            }else{
                                              $from_dt = '';
                                            }
                                       }else {}
                                      

                                     ?>

                                    <td><input type="text" name="ToDate[]" id="ToDate7" value="{{$to_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate7" value="{{$from_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                        <input list="glList7"  id="afgl_code7" name="afgl_code[]"  value="<?php if(isset($tran_tax_data[6]->TAX_GL_CODE)){echo $tran_tax_data[6]->TAX_GL_CODE;}?>" class="taxIndClass glblock" placeholder="Select Gl-Code" size="25" onchange="glCodeName(7)">

                                        <datalist id="glList7">

                                          @foreach($gl_code_list as $row)

                                            <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                           @endforeach

                                        </datalist>
                                        <small class="GlTextshow" id="glText7"><?php if(isset($tran_tax_data[6]->TAX_GL_NAME)){echo $tran_tax_data[6]->TAX_GL_NAME;}?></small>
                                        <input type="hidden" id="gl_name7" name="glName[]" value="<?php if(isset($tran_tax_data[6]->TAX_GL_NAME)){echo $tran_tax_data[6]->TAX_GL_NAME;}?>">
                                    </td>



                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock7" name="statici[]">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php 
                                  if(isset($tran_tax_data[7]->STATIC_IND)){
                                    if($tran_tax_data[7]->STATIC_IND == 1){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>Yes</option>
                                          <option value="0" <?php 
                                  if(isset($tran_tax_data[7]->STATIC_IND)){
                                    if($tran_tax_data[7]->STATIC_IND == 0){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>

                                 



                                  <tr>

                                    <th class="text-center">8</th>

                                    <th scope="row">
                                       <input name="amthead[]" id="amthead8" value="<?php if(isset($tran_tax_data[7]->TAXIND_CODE)) echo $tran_tax_data[7]->TAXIND_CODE; ?>" list="HeadList8" maxlength="4" class="headBox" onchange="haedcname(8)">
                                        <datalist id="HeadList8">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>
                                        
                                        <small class="HeadTextshow" id="HeadText8"><?php if(isset($tran_tax_data[7]->TAXIND_NAME)) echo $tran_tax_data[7]->TAXIND_NAME; ?></small>
                                        <input type="hidden" name="headName[]" id="headName8" value="<?php if(isset($tran_tax_data[7]->TAXIND_NAME)) echo $tran_tax_data[7]->TAXIND_NAME; ?>">

                                    </th>



                                    <td><select name="afratei[]" id="afratei8" class="taxIndClass setwidthsel" onchange="rate_if_az(8);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}" <?php 
                                  if(isset($tran_tax_data[7]->RATE_INDEX)){
                                    if($tran_tax_data[7]->RATE_INDEX == $key->RATE_VALUE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select></td>



                                    <td><input type="text" name="aflogic[]" id="aflogic8" value="<?php if(isset($tran_tax_data[7]->TAX_LOGIC)){
                                      echo $tran_tax_data[7]->TAX_LOGIC;
                                    } ?>" size="9" maxlength="12" class="textBox"></td>



                                    <td><input type="text" name="afrate[]" id="afrate8" value="<?php if(isset($tran_tax_data[7]->TAX_RATE)){
                                      echo $tran_tax_data[7]->TAX_RATE;
                                    } ?>" size="5" maxlength="11" class="textBox"></td>

                                    <?php 
                                      $to_dt = '';
                                      $from_dt = '';
                                      if(isset($tran_tax_data[7]->TO_DATE)){
                                      $todate = $tran_tax_data[7]->TO_DATE;
                                           if($todate != '0000-00-00'){
                                              $to_dt =  date('d-m-Y',strtotime($todate));
                                            }else{
                                              $to_dt = '';
                                            }
                                       }else { }

                                       if(isset($tran_tax_data[7]->FROM_DATE)){
                                            $fromdate = $tran_tax_data[7]->FROM_DATE;
                                           if($fromdate != '0000-00-00'){
                                              $from_dt =  date('d-m-Y',strtotime($tran_tax_data[7]->FROM_DATE));
                                            }else{
                                              $from_dt = '';
                                            }
                                       }else {}
                                      

                                     ?>

                                    <td><input type="text" name="ToDate[]" id="ToDate8" value="{{$to_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate8" value="{{$from_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                      <input list="glList8"  id="afgl_code8" name="afgl_code[]"  value="<?php if(isset($tran_tax_data[7]->TAX_GL_CODE)){echo $tran_tax_data[7]->TAX_GL_CODE;}?>" class="taxIndClass glblock" placeholder="Select Gl-Code" size="25" onchange="glCodeName(8)">

                                      <datalist id="glList8">

                                      @foreach($gl_code_list as $row)

                                        <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                       @endforeach

                                      </datalist>
                                      <small class="GlTextshow" id="glText8"><?php if(isset($tran_tax_data[7]->TAX_GL_NAME)){echo $tran_tax_data[7]->TAX_GL_NAME;}?></small>
                                      <input type="hidden" id="gl_name8" name="glName[]" value="<?php if(isset($tran_tax_data[7]->TAX_GL_NAME)){echo $tran_tax_data[7]->TAX_GL_NAME;}?>">
                                    </td>



                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock8" name="statici[]">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php 
                                  if(isset($tran_tax_data[7]->STATIC_IND)){
                                    if($tran_tax_data[7]->STATIC_IND == 1){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>Yes</option>
                                          <option value="0" <?php 
                                  if(isset($tran_tax_data[7]->STATIC_IND)){
                                    if($tran_tax_data[7]->STATIC_IND == 0){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>



                                 

                                  <tr>

                                     <th class="text-center">9</th>

                                     <th scope="row">
                                      <input name="amthead[]" id="amthead9" value="<?php if(isset($tran_tax_data[8]->TAXIND_CODE)) echo $tran_tax_data[8]->TAXIND_CODE; ?>" list="HeadList9" maxlength="4" class="headBox" onchange="haedcname(9)">
                                        <datalist id="HeadList9">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>
                                        
                                        <small class="HeadTextshow" id="HeadText9"><?php if(isset($tran_tax_data[8]->TAXIND_NAME)) echo $tran_tax_data[8]->TAXIND_NAME; ?></small>
                                        <input type="hidden" name="headName[]" id="headName9" value="<?php if(isset($tran_tax_data[8]->TAXIND_NAME)) echo $tran_tax_data[8]->TAXIND_NAME; ?>">

                                     </th>



                                    

                                    <td><select name="afratei[]" id="afratei9" class="taxIndClass setwidthsel" onchange="rate_if_az(9);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}" <?php 
                                  if(isset($tran_tax_data[8]->RATE_INDEX)){
                                    if($tran_tax_data[8]->RATE_INDEX == $key->RATE_VALUE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select></td>



                                    <td><input type="text" name="aflogic[]" id="aflogic9" value="<?php if(isset($tran_tax_data[8]->TAX_LOGIC)){
                                      echo $tran_tax_data[8]->TAX_LOGIC;
                                    } ?>" size="9" maxlength="12" class="textBox"></td>



                                    <td><input type="text" name="afrate[]" id="afrate9" value="<?php if(isset($tran_tax_data[8]->TAX_RATE)){
                                      echo $tran_tax_data[8]->TAX_RATE;
                                    } ?>" size="5" maxlength="11" class="textBox"></td>

                                    <?php
                                      $to_dt = '';
                                      $from_dt = '';
                                      if(isset($tran_tax_data[8]->TO_DATE)){
                                      $todate = $tran_tax_data[8]->TO_DATE;
                                           if($todate != '0000-00-00'){
                                              $to_dt =  date('d-m-Y',strtotime($todate));
                                            }else{
                                              $to_dt = '';
                                            }
                                       }else { }

                                       if(isset($tran_tax_data[8]->FROM_DATE)){
                                            $fromdate = $tran_tax_data[8]->FROM_DATE;
                                           if($fromdate != '0000-00-00'){
                                              $from_dt =  date('d-m-Y',strtotime($tran_tax_data[8]->FROM_DATE));
                                            }else{
                                              $from_dt = '';
                                            }
                                       }else {}
                                      

                                     ?>

                                    <td><input type="text" name="ToDate[]" id="ToDate9" value="{{$to_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate9" value="{{$from_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                        <input list="glList9"  id="afgl_code9" name="afgl_code[]"  value="<?php if(isset($tran_tax_data[8]->TAX_GL_CODE)){echo $tran_tax_data[8]->TAX_GL_CODE;}?>" class="taxIndClass glblock" placeholder="Select Gl-Code" size="25" onchange="glCodeName(9)">

                                        <datalist id="glList9">

                                          @foreach($gl_code_list as $row)

                                            <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                           @endforeach

                                        </datalist>
                                        <small class="GlTextshow" id="glText9"><?php if(isset($tran_tax_data[8]->TAX_GL_NAME)){echo $tran_tax_data[8]->TAX_GL_NAME;}?></small>
                                        <input type="hidden" id="gl_name9" name="glName[]" value="<?php if(isset($tran_tax_data[8]->TAX_GL_NAME)){echo $tran_tax_data[8]->TAX_GL_NAME;}?>">
                                    </td>

                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock9" name="statici[]">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php 
                                  if(isset($tran_tax_data[8]->STATIC_IND)){
                                    if($tran_tax_data[8]->STATIC_IND == 1){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>Yes</option>
                                          <option value="0" <?php 
                                  if(isset($tran_tax_data[8]->STATIC_IND)){
                                    if($tran_tax_data[8]->STATIC_IND == 0){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>



                                  <tr>

                                    <th class="text-center">10</th>

                                     <th scope="row">
                                     <input name="amthead[]" id="amthead10" value="<?php if(isset($tran_tax_data[9]->TAXIND_CODE)) echo $tran_tax_data[9]->TAXIND_CODE; ?>" list="HeadList10" maxlength="4" class="headBox" onchange="haedcname(10)">
                                        <datalist id="HeadList10">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>
                                        
                                        <small class="HeadTextshow" id="HeadText10"><?php if(isset($tran_tax_data[9]->TAXIND_NAME)) echo $tran_tax_data[9]->TAXIND_NAME; ?></small>
                                        <input type="hidden" name="headName[]" id="headName10" value="<?php if(isset($tran_tax_data[9]->TAXIND_NAME)) echo $tran_tax_data[9]->TAXIND_NAME; ?>">

                                     </th>

                                    

                                    <td><select name="afratei[]" id="afratei10" class="taxIndClass setwidthsel" onchange="rate_if_az(10);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}" <?php 
                                  if(isset($tran_tax_data[9]->RATE_INDEX)){
                                    if($tran_tax_data[9]->RATE_INDEX == $key->RATE_VALUE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select></td>



                                    <td><input type="text" name="aflogic[]" id="aflogic10" value="<?php if(isset($tran_tax_data[9]->TAX_LOGIC)){
                                      echo $tran_tax_data[9]->TAX_LOGIC;
                                    } ?>" size="9" maxlength="12" class="textBox"></td>



                                    <td><input type="text" name="afrate[]" id="afrate10" value="<?php if(isset($tran_tax_data[9]->TAX_RATE)){
                                      echo $tran_tax_data[9]->TAX_RATE;
                                    } ?>" size="5" maxlength="11" class="textBox"></td>

                                    <?php 
                                      $to_dt = '';
                                      $from_dt = '';
                                      if(isset($tran_tax_data[9]->TO_DATE)){
                                      $todate = $tran_tax_data[9]->TO_DATE;
                                           if($todate != '0000-00-00'){
                                              $to_dt =  date('d-m-Y',strtotime($todate));
                                            }else{
                                              $to_dt = '';
                                            }
                                       }else { }

                                       if(isset($tran_tax_data[9]->FROM_DATE)){
                                            $fromdate = $tran_tax_data[9]->FROM_DATE;
                                           if($fromdate != '0000-00-00'){
                                              $from_dt =  date('d-m-Y',strtotime($tran_tax_data[9]->FROM_DATE));
                                            }else{
                                              $from_dt = '';
                                            }
                                       }else {}
                                      

                                     ?>

                                    <td><input type="text" name="ToDate[]" id="ToDate10" value="{{$to_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate10" value="{{$from_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                        <input list="glList10"  id="afgl_code10" name="afgl_code[]"  value="<?php if(isset($tran_tax_data[9]->TAX_GL_CODE)){echo $tran_tax_data[9]->TAX_GL_CODE;}?>" class="taxIndClass glblock" placeholder="Select Gl-Code" size="25" onchange="glCodeName(10)">

                                        <datalist id="glList10">

                                          @foreach($gl_code_list as $row)

                                            <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                           @endforeach

                                        </datalist>
                                        <small class="GlTextshow" id="glText10"><?php if(isset($tran_tax_data[9]->TAX_GL_NAME)){echo $tran_tax_data[9]->TAX_GL_NAME;}?></small>
                                        <input type="hidden" id="gl_name10" name="glName[]" value="<?php if(isset($tran_tax_data[9]->TAX_GL_NAME)){echo $tran_tax_data[9]->TAX_GL_NAME;}?>">
                                    </td>

                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock10" name="statici[]">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php 
                                  if(isset($tran_tax_data[9]->STATIC_IND)){
                                    if($tran_tax_data[9]->STATIC_IND == 1){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>Yes</option>
                                          <option value="0" <?php 
                                  if(isset($tran_tax_data[9]->STATIC_IND)){
                                    if($tran_tax_data[9]->STATIC_IND == 0){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>



                                  <tr>

                                     <th class="text-center">11</th>

                                     <th scope="row">
                                      <input name="amthead[]" id="amthead11" value="<?php if(isset($tran_tax_data[10]->TAXIND_CODE)) echo $tran_tax_data[10]->TAXIND_CODE; ?>" list="HeadList11" maxlength="4" class="headBox" onchange="haedcname(11)">
                                        <datalist id="HeadList11">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>
                                        
                                        <small class="HeadTextshow" id="HeadText11"><?php if(isset($tran_tax_data[10]->TAXIND_NAME)) echo $tran_tax_data[10]->TAXIND_NAME; ?></small>
                                        <input type="hidden" name="headName[]" id="headName11" value="<?php if(isset($tran_tax_data[10]->TAXIND_NAME)) echo $tran_tax_data[10]->TAXIND_NAME; ?>">

                                     </th>

                                    

                                    <td><select name="afratei[]" id="afratei11" class="taxIndClass setwidthsel" onchange="rate_if_az(11);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{$key->RATE_VALUE}}" <?php 
                                  if(isset($tran_tax_data[10]->rate_index)){
                                    if($tran_tax_data[10]->rate_index == $key->RATE_VALUE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select></td>



                                    <td><input type="text" name="aflogic[]" id="aflogic11" value="<?php if(isset($tran_tax_data[10]->TAX_LOGIC)){
                                      echo $tran_tax_data[10]->TAX_LOGIC;
                                    } ?>" size="9" maxlength="12" class="textBox"></td>



                                    <td><input type="text" name="afrate[]" id="afrate11" value="<?php if(isset($tran_tax_data[10]->TAX_RATE)){
                                      echo $tran_tax_data[10]->TAX_RATE;
                                    } ?>" size="5" maxlength="11" class="textBox"></td>

                                   <?php 
                                      $to_dt = '';
                                      $from_dt = '';
                                     if(isset($tran_tax_data[10]->TO_DATE)){
                                      $todate = $tran_tax_data[10]->TO_DATE;
                                           if($todate != '0000-00-00'){
                                              $to_dt =  date('d-m-Y',strtotime($todate));
                                            }else{
                                              $to_dt = '';
                                            }
                                       }else { }

                                       if(isset($tran_tax_data[10]->FROM_DATE)){
                                            $fromdate = $tran_tax_data[10]->FROM_DATE;
                                           if($fromdate != '0000-00-00'){
                                              $from_dt =  date('d-m-Y',strtotime($tran_tax_data[10]->FROM_DATE));
                                            }else{
                                              $from_dt = '';
                                            }
                                       }else {}
                                      

                                     ?>

                                    <td><input type="text" name="ToDate[]" id="ToDate11" value="{{$to_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate11" value="{{$from_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                        <input list="glList11"  id="afgl_code11" name="afgl_code[]"  value="<?php if(isset($tran_tax_data[10]->TAX_GL_CODE)){echo $tran_tax_data[10]->TAX_GL_CODE;}?>" class="taxIndClass glblock" placeholder="Select Gl-Code" size="25" onchange="glCodeName(11)">

                                        <datalist id="glList11">

                                          @foreach($gl_code_list as $row)

                                            <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                           @endforeach

                                        </datalist>
                                        <small class="GlTextshow" id="glText11"><?php if(isset($tran_tax_data[10]->TAX_GL_NAME)){echo $tran_tax_data[10]->TAX_GL_NAME;}?></small>
                                        <input type="hidden" id="gl_name11" name="glName[]" value="<?php if(isset($tran_tax_data[10]->TAX_GL_NAME)){echo $tran_tax_data[10]->TAX_GL_NAME;}?>">
                                    </td>

                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock11" name="statici[]">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php 
                                  if(isset($tran_tax_data[10]->STATIC_IND)){
                                    if($tran_tax_data[10]->STATIC_IND == 1){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>Yes</option>
                                          <option value="0" <?php 
                                  if(isset($tran_tax_data[10]->STATIC_IND)){
                                    if($tran_tax_data[10]->STATIC_IND == 0){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>



                                  <tr>

                                     <th class="text-center">12</th>

                                     <th scope="row">
                                     <input name="amthead[]" id="amthead12" value="<?php if(isset($tran_tax_data[11]->TAXIND_CODE)) echo $tran_tax_data[11]->TAXIND_CODE; ?>" list="HeadList12" maxlength="4" class="headBox" onchange="haedcname(12)">
                                        <datalist id="HeadList12">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>
                                        
                                        <small class="HeadTextshow" id="HeadText12"><?php if(isset($tran_tax_data[11]->TAXIND_NAME)) echo $tran_tax_data[11]->TAXIND_NAME; ?></small>
                                        <input type="hidden" name="headName[]" id="headName12" value="<?php if(isset($tran_tax_data[11]->TAXIND_NAME)) echo $tran_tax_data[11]->TAXIND_NAME; ?>">

                                     </th>

                                    

                                    <td><select name="afratei[]" id="afratei12" class="taxIndClass setwidthsel" onchange="rate_if_az(12);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}" <?php 
                                  if(isset($tran_tax_data[11]->RATE_INDEX)){
                                    if($tran_tax_data[11]->RATE_INDEX == $key->RATE_VALUE){
                                    echo 'selected';
                                    }
                                  }
                                  ?>><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select></td>



                                    <td><input type="text" name="aflogic[]" id="aflogic12" value="<?php if(isset($tran_tax_data[11]->TAX_LOGIC)){
                                      echo $tran_tax_data[11]->TAX_LOGIC;
                                    } ?>" size="9" maxlength="12" class="textBox"></td>



                                    <td><input type="text" name="afrate[]" id="afrate12" value="<?php if(isset($tran_tax_data[11]->TAX_RATE)){
                                      echo $tran_tax_data[11]->TAX_RATE;
                                    } ?>" size="5" maxlength="11" class="textBox"></td>

                                     <?php 
                                      $to_dt = '';
                                      $from_dt = '';
                                      if(isset($tran_tax_data[11]->TO_DATE)){
                                      $todate = $tran_tax_data[11]->TO_DATE;
                                           if($todate != '0000-00-00'){
                                              $to_dt =  date('d-m-Y',strtotime($todate));
                                            }else{
                                              $to_dt = '';
                                            }
                                       }else { }

                                       if(isset($tran_tax_data[11]->FROM_DATE)){
                                            $fromdate = $tran_tax_data[11]->FROM_DATE;
                                           if($fromdate != '0000-00-00'){
                                              $from_dt =  date('d-m-Y',strtotime($tran_tax_data[11]->FROM_DATE));
                                            }else{
                                              $from_dt = '';
                                            }
                                       }else {}
                                      

                                     ?>

                                    <td><input type="text" name="ToDate[]" id="ToDate12" value="{{$to_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate12" value="{{$from_dt}}" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                        <input list="glList12"  id="afgl_code11" name="afgl_code[]"  value="<?php if(isset($tran_tax_data[11]->TAX_GL_CODE  )){echo $tran_tax_data[11]->TAX_GL_CODE ;}?>" class="taxIndClass glblock" placeholder="Select Gl-Code" size="25" onchange="glCodeName(12)">

                                        <datalist id="glList12">

                                          @foreach($gl_code_list as $row)

                                            <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                           @endforeach

                                        </datalist>
                                        <small class="HeadTextshow" id="glText11"><?php if(isset($tran_tax_data[9]->TAX_GL_NAME)){echo $tran_tax_data[9]->TAX_GL_NAME;}?></small>
                                        <input type="hidden" id="gl_name11" name="glName[]" value="<?php if(isset($tran_tax_data[9]->TAX_GL_NAME)){echo $tran_tax_data[9]->TAX_GL_NAME;}?>">
                                    </td>

                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock12" name="statici[]">
                                          <option value="">--Select--</option>
                                          <option value="1" <?php 
                                  if(isset($tran_tax_data[11]->STATIC_IND)){
                                    if($tran_tax_data[11]->STATIC_IND == 1){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>Yes</option>
                                          <option value="0" <?php 
                                  if(isset($tran_tax_data[11]->STATIC_IND)){
                                    if($tran_tax_data[11]->STATIC_IND == 0){
                                    echo 'selected';
                                    }
                                  }
                                  ?>>No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>

                                </tbody>

                              </table>
                        
                          </div>
                        </div>
                      <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary" id="submitthirdbtn" style="margin-left: 10%;"><i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Update</button>
                      </div>

                  </div>

                </div>

                  

                </form>



          </div>



      </div>



</div>





    </div>



     



  </section>



</div>















@include('admin.include.footer')







<script type="text/javascript">



  function haedcname(headid){

      var val = $('#amthead'+headid).val();

      console.log('val',val);
      console.log('headid',headid);

      var xyz = $('#HeadList'+headid+' option').filter(function() {



        return this.value == val;



      }).data('xyz');



      var msg = xyz ?  xyz : 'No Match';

      console.log('msg',val);

      if(msg == 'No Match'){

         $('#afhead'+headid).val('');
         $('#headName'+headid).val('');

       document.getElementById("HeadText"+headid).innerHTML = ''; 

      }else{

        document.getElementById("HeadText"+headid).innerHTML = msg;
        $('#headName'+headid).val(msg); 

       // $('#HeadText').innerHTML(msg);

      }

  }





  function rate_if_az(rateid){

      for(i=rateid;i<=rateid;i++){

          var rateIndex = $('#afratei'+i).val();

          //var rateIndex1 = $('#afratei3').val();

          //console.log(rateIndex);

         if(rateIndex == 'A'){

           $('#statici'+i+'1').prop('checked',true);

           $('#statici'+i+'2').prop('disabled', true);

         }else if(rateIndex == 'Z'){

           $('#statici'+i+'1').prop('checked',true);

           $('#staticIndBlock'+i).prop('disabled', true);

         }else{

           $('#statici'+i+'1').prop('checked',false);

           $('#statici'+i+'2').prop('disabled', false);

         }





      }

  }


  function glCodeName(glcodeid){

      var val = $('#afgl_code'+glcodeid).val();

      //console.log(val);

      var xyz = $('#glList'+glcodeid+' option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){

         $('#afgl_code'+glcodeid).val('');
         $('#gl_name'+glcodeid).val('');

       document.getElementById("glText"+glcodeid).innerHTML = ''; 

      }else{

        document.getElementById("glText"+glcodeid).innerHTML = msg; 
        $('#gl_name'+glcodeid).val(msg);

       // $('#HeadText').innerHTML(msg);

      }

  }



    $(document).ready(function(){



      



        $('.datepicker').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          endDate: 'today',

          autoclose: 'true'

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



        $("#tax_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#taxList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("taxText").innerHTML = msg; 

          $('#tax_name').val(msg);



        });



        $("#series_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#seriesList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("seriesText").innerHTML = msg; 



        });



        $("#gi_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#giList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("giText").innerHTML = msg; 



        });



    });

</script>



<script type="text/javascript">

$(document).ready(function(){



    $('#submitfirstbtn').click(function(){

        var tax_code = $("#tax_code").val();

        var trans_code = $("#trans_code").val();

        var series_code  =  $("#series_code").val();

        var gi_code   =  $("#gi_code").val();



        if(tax_code=='' && trans_code=='' && series_code=='' && gi_code==''){

          $("#taxcodeErr").html('The Tax code field is required.').css('color','red');

          $("#transcodeErr").html('The Trans code field is required.').css('color','red');

          $("#sericecodeErr").html('The Series code field is required.').css('color','red');

          $("#glcodeErr").html('The Gl Code field is required.').css('color','red');



        }else if(tax_code==''){

          $("#taxcodeErr").html('The Tax code field is required.').css('color','red');

          $("#transcodeErr").html('');

          $("#sericecodeErr").html('');

          $("#glcodeErr").html('');

          return false;

        }else if(trans_code==''){

          $("#taxcodeErr").html('');

          $("#transcodeErr").html('The Trans code field is required.').css('color','red');

          $("#sericecodeErr").html('');

          $("#glcodeErr").html('');

          return false;

        }else if(series_code==''){

          $("#taxcodeErr").html('');

          $("#transcodeErr").html('');

          $("#sericecodeErr").html('The Series code field is required.').css('color','red');

          $("#glcodeErr").html('');

          return false;

        }else if(gi_code==''){

          $("#taxcodeErr").html('');

          $("#transcodeErr").html('');

          $("#sericecodeErr").html('');

          $("#glcodeErr").html('The Gl Code field is required.').css('color','red');

          return false;

        }else{

          $('#amountfield').removeClass('amntFild');

          $("#taxcodeErr").html('');

          $("#transcodeErr").html('');

          $("#sericecodeErr").html('');

          $("#glcodeErr").html('');

          $('#amntFild').removeClass('amntFild');

          $('a[href="#step-2"]').click();

        }



    });



   /* $('#submitsecondbtn').click(function(){





    });*/









 



});

</script>



<script type="text/javascript">

  $(document).ready(function(){



    $('#submitsecondbtn').click(function(){



      $('#nonaccfield').removeClass('nonAccFild');

      $('a[href="#step-3"]').click();





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