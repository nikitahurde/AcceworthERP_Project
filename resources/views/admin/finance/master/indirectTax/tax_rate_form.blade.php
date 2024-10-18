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
    font-weight: 800;

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
    width: 60%;
}
.submitbtnC{
  display: none;
} 
.rightnumber{
  text-align: right;
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



            <small>Add Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/Master/InDirect-Direct-Tax/Tax-Rate-Mast')}}">Master Tax Rate  </a></li>



            <li class="Active"><a href="{{ URL('/Master/InDirect-Direct-Tax/Tax-Rate-Mast')}}">Add Tax Rate </a></li>



          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Tax Rate</h2>

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







               <form action="{{ url('Master/InDirect-Direct-Tax/Tax-Rate-Save') }}" method="POST" id="InwardTrnas">

                @csrf
                 

                  <div class="row">

                    <div class="col-xs-12">

                      <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-3 TaxCodeMargin">

                          <div class="form-group">

                          <label>Tax Code : <span class="required-field"></span></label>

                           <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                           <input list="taxList"  id="tax_code" name="tax_code" class="form-control  pull-left" value="" placeholder="Select Tax Code" maxlength="6" autocomplete="off">

                            <datalist id="taxList">

                              @foreach($tax_list as $row)

                                <option value='{{ $row->TAX_CODE }}' data-xyz ="{{ $row->TAX_NAME }}"<?php if($tran_code==$row->TAX_CODE) { echo 'selected'; } else { echo '';}?>>{{ $row->TAX_CODE }} = {{ $row->TAX_NAME }} </option>

                               @endforeach

                            </datalist>

                            <input type="hidden" id="tax_name" name="tax_name" value="">

                          </div>

                          <small> 

                            <div class="pull-left showSeletedName" id="taxText"></div>

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

                                      <!-- <datalist id="HeadList1"> -->

                                        <select name="amthead0" id="amthead1" maxlength="4" class="headBox" disabled="true">
                                            
                                            
                                               @foreach($tax_ind_list as $key)

                                               <option <?php if($key->TAXIND_CODE =='B01'){echo "selected";} ?> value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}</option>

                                              
                                               @endforeach


                                        </select>

                                        <?php $basicName; ?>
                                         @foreach($tax_ind_list as $key1)

                                         <small class="HeadTextshow" id="HeadText1"><?php  if($key1->TAXIND_CODE =='B01'){echo $key1->TAXIND_NAME;} ?></small>

                                          
                                         <?php  if($key1->TAXIND_CODE =='B01'){$basicName = $key1->TAXIND_NAME;} ?> 
                                               @endforeach



                                               <input type="hidden" id="HeadName1" name="HeadName1" value="<?php echo  $basicName; ?>">

                                         <input type="hidden" id="basicval1" name="amthead1">
                                        

                                         <input type="hidden" value="A" name="static_ind_bs">
                                         <input type="hidden" value="1" name="taxIndCode1" id="taxIndCode1">


                                     <!--  </datalist> -->

                                    
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

                                    <th scope="row"><input type="text" name="amthead[]" id="amthead2" value="" list="HeadList2" maxlength="4" class="headBox" onchange="haedcname(2)">



                                      <datalist id="HeadList2">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>

                                     <input type="hidden" name="headamt[]" id="headamt"  maxlength="15" class="headBox" value='0'>

                                      <small class="HeadTextshow" id="HeadText2"></small>
                                      <input type="hidden" class="" name="HeadName[]" id="HeadName2" value="">

                                     <input type="hidden" value="B" name="static_ind[]">
                                     <input type="hidden" value="" name="taxIndCode[]" id="taxIndCode2">
                                    </th>



                                    <td>
                                      <select name="afratei[]" class="setwidthsel" id="afratei2" onchange="rate_if_az(2);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{$key->RATE_VALUE }}"><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>

                                    <?php } ?>

                                     </select>
                                      <small id="indexErr2">
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic2" value="" size="9" maxlength="12" class="textBox rightnumber Number" oninput="logicvalidated(2)">
                                      <small id="logicErr2"></small>
                                    </td>



                                    <td>
                                      <input type="text" name="afrate[]" id="afrate2" value="" size="5" maxlength="11" class="textBox rightnumber" oninput="ratevalidate(2)">
                                    <small id="rateErr2"></small>
                                    </td>



                                    <td><input type="text" name="ToDate[]" id="ToDate2" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete=off></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate2" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                      <input list="glList2"  id="afgl_code2" name="afgl_code[]"  value="" class="textBox" size="9" placeholder="Select Gl-Code" onchange="glCodeName(2)" autocomplete="off">

                                      <datalist id="glList2">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>

                                      <small class="HeadTextshow" id="glText2"></small>
                                      <input type="hidden" id="afgl_name2" name="afgl_name[]" value="">

                                    </td>



                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock2" name="statici[]">
                                      
                                          <option value="1" selected>Yes</option>
                                          <option value="0">No</option>
                                        </select>
                                      
                                      </div>

                                    </td>

                                  </tr>







                                  <tr>

                                     <th class="text-center">3</th>

                                     <th scope="row"><input type="text" name="amthead[]" id="amthead3" value="" list="HeadList3" maxlength="15" class="headBox" onchange="haedcname(3)">

                                      <datalist id="HeadList3">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>

                                       <small class="HeadTextshow" id="HeadText3"></small>
                                       <input type="hidden" class="" name="HeadName[]" id="HeadName3" value="">
                                       <input type="hidden" value="C" name="static_ind[]">
                                       <input type="hidden" value="" name="taxIndCode[]" id="taxIndCode3">

                                    </th>



                                    <td><select name="afratei[]" id="afratei3" class="setwidthsel" onchange="rate_if_az(3);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}"><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select>
                                    <small id="indexErr3">
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic3" value="" size="9" maxlength="12" class="textBox rightnumber Number" oninput="logicvalidated(3)">
                                      <small id="logicErr3"></small>
                                    </td>



                                     <td><input type="text" name="afrate[]" id="afrate3" value="" size="5" maxlength="11" class="textBox rightnumber" oninput="ratevalidate(3)">
                                      <small id="rateErr3"></small>
                                     </td>



                                     <td><input type="text" name="ToDate[]" id="ToDate3" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                     <td><input type="text" name="FromDate[]" id="FromDate3" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                      <input list="glList3"  id="afgl_code3" name="afgl_code[]"  value="" class="textBox" placeholder="Select Gl-Code" size="9" onchange="glCodeName(3)" autocomplete="off">

                                      <datalist id="glList3">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>
                                        <small class="HeadTextshow" id="glText3"></small>
                                         <input type="hidden" id="afgl_name3" name="afgl_name[]" value="">
                                    </td>



                                    <td>

                                      <div class="staticBlock">

                                       <select class="StaticBlockGet" id="staticIndBlock3" name="statici[]">
                                          
                                          <option value="1" selected>Yes</option>
                                          <option value="0">No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>





                                  <tr>

                                     <th class="text-center">4</th>

                                     <th scope="row"><input type="text" name="amthead[]" id="amthead4" maxlength="15" list="HeadList4" value="" class="headBox" onchange="haedcname(4)">

                                      <datalist id="HeadList4">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>

                                       <small class="HeadTextshow" id="HeadText4"></small>
                                       <input type="hidden" class="" name="HeadName[]" id="HeadName4" value="">
                                       <input type="hidden" value="D" name="static_ind[]">
                                       <input type="hidden" value="" name="taxIndCode[]" id="taxIndCode4">
                                     </th>

                                    

                                    <td><select name="afratei[]" id="afratei4" class="setwidthsel" onchange="rate_if_az(4);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}"><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select>
                                    <small id="indexErr4">
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic4" value="" size="9" maxlength="12" class="textBox rightnumber Number" oninput="logicvalidated(4)">
                                      <small id="logicErr4"></small>
                                    </td>

                                    <td><input type="text" name="afrate[]" id="afrate4" value="" size="5" maxlength="11" class="textBox rightnumber" oninput="ratevalidate(4)">
                                      <small id="rateErr4"></small>
                                    </td>

                                    <td><input type="text" name="ToDate[]" id="ToDate4" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>

                                    <td><input type="text" name="FromDate[]" id="FromDate4" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>

                                    <td>
                                      <input list="glList4"  id="afgl_code4" name="afgl_code[]"  value="" class="textBox" placeholder="Select Gl-Code"size="9" onchange="glCodeName(4)" autocomplete="off">

                                      <datalist id="glList4">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>
                                      <small class="HeadTextshow" id="glText4"></small>
                                       <input type="hidden" id="afgl_name4" name="afgl_name[]" value="">
                                    </td>

                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock4" name="statici[]">
                                          
                                          <option value="1" selected>Yes</option>
                                          <option value="0">No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>





                                  <tr>

                                     <th class="text-center">5</th>

                                     <th scope="row"><input type="text" name="amthead[]" id="amthead5" maxlength="15" list="HeadList5" value="" class="headBox" onchange="haedcname(5)">

                                      <datalist id="HeadList5">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>

                                       <small class="HeadTextshow" id="HeadText5"></small>
                                       <input type="hidden" class="" name="HeadName[]" id="HeadName5" value="">
                                       <input type="hidden" value="E" name="static_ind[]">
                                       <input type="hidden" value="" name="taxIndCode[]" id="taxIndCode5">
                                    </th>

                                    

                                    <td><select name="afratei[]" id="afratei5" class="setwidthsel" onchange="rate_if_az(5);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}"><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select>
                                    <small id="indexErr5">
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic5" value="" size="9" maxlength="12" class="textBox rightnumber Number" oninput="logicvalidated(5)">
                                      <small id="logicErr5"></small>
                                    </td>



                                    <td><input type="text" name="afrate[]" id="afrate5" value="" size="5" maxlength="11" class="textBox rightnumber" oninput="ratevalidate(5)">
                                      <small id="rateErr5"></small>
                                    </td>



                                    <td><input type="text" name="ToDate[]" id="ToDate5" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate5" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>





                                    <td>
                                      <input list="glList5"  id="afgl_code5" name="afgl_code[]"  value="" class="textBox" placeholder="Select Gl-Code"size="9" onchange="glCodeName(5)" autocomplete="off">

                                      <datalist id="glList5">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>
                                      <small class="HeadTextshow" id="glText5"></small>
                                       <input type="hidden" id="afgl_name5" name="afgl_name[]" value="">
                                    </td>



                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock5" name="statici[]">
                                          <option value="1" selected>Yes</option>
                                          <option value="0">No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>



                                  <tr>

                                     <th class="text-center">6</th>

                                     <th scope="row"><input type="text" name="amthead[]" id="amthead6" maxlength="15" value="" list="HeadList6"  class="headBox" onchange="haedcname(6)">

                                      <datalist id="HeadList6">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>

                                       <small class="HeadTextshow" id="HeadText6"></small>
                                       <input type="hidden" class="" name="HeadName[]" id="HeadName6" value="">
                                       <input type="hidden" value="F" name="static_ind[]">
                                       <input type="hidden" value="" name="taxIndCode[]" id="taxIndCode6">
                                     </th>



                                    <td><select name="afratei[]" id="afratei6" class="setwidthsel" onchange="rate_if_az(6);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{$key->RATE_VALUE}}"><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select>
                                    <small id="indexErr6">
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic6" value="" size="9" maxlength="12" class="textBox rightnumber Number" oninput="logicvalidated(6)">
                                      <small id="logicErr6"></small>
                                    </td>



                                    <td><input type="text" name="afrate[]" id="afrate6" value="" size="5" maxlength="11" class="textBox rightnumber" oninput="ratevalidate(6)">
                                      <small id="rateErr6"></small>
                                    </td>



                                    <td><input type="text" name="ToDate[]" id="ToDate6" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate6" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom" autocomplete="off"></td>



                                    <td>
                                      <input list="glList6"  id="afgl_code6" name="afgl_code[]"  value="" class="textBox" placeholder="Select Gl-Code"size="9" onchange="glCodeName(6)" autocomplete="off">

                                      <datalist id="glList6">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>
                                      <small class="HeadTextshow" id="glText6"></small>
                                       <input type="hidden" id="afgl_name6" name="afgl_name[]" value="">
                                    </td>



                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock6" name="statici[]">
                                          <option value="1" selected>Yes</option>
                                          <option value="0">No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>





                                 <tr>

                                     <th class="text-center">7</th>

                                     <th scope="row"><input type="text" name="amthead[]" id="amthead7" maxlength="15" list="HeadList7" value="" class="headBox" onchange="haedcname(7)">

                                      <datalist id="HeadList7">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>

                                       <small class="HeadTextshow" id="HeadText7"></small>
                                       <input type="hidden" class="" name="HeadName[]" id="HeadName7" value="">
                                       <input type="hidden" value="G" name="static_ind[]">
                                       <input type="hidden" value="" name="taxIndCode[]" id="taxIndCode7">
                                     </th>



                                    <td><select name="afratei[]" id="afratei7" class="setwidthsel" onchange="rate_if_az(7);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}"><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select>
                                    <small id="indexErr7">
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic7" value="" size="9" maxlength="12" class="textBox rightnumber Number" oninput="logicvalidated(7)">
                                      <small id="logicErr7"></small>
                                    </td>



                                    <td><input type="text" name="afrate[]" id="afrate7" value="" size="5" maxlength="11" class="textBox rightnumber" oninput="ratevalidate(7)">
                                      <small id="rateErr7"></small>
                                    </td>



                                    <td><input type="text" name="ToDate[]" id="ToDate7" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate8" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td>
                                     <input list="glList7"  id="afgl_code7" name="afgl_code[]"  value="" class="textBox" placeholder="Select Gl-Code"size="9" onchange="glCodeName(7)" autocomplete="off">

                                      <datalist id="glList7">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>
                                      <small class="HeadTextshow" id="glText7"></small>
                                      <input type="hidden" id="afgl_name7" name="afgl_name[]" value="">
                                    </td>



                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock7" name="statici[]">
                                          <option value="1" selected>Yes</option>
                                          <option value="0">No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>

                                 



                                  <tr>

                                    <th class="text-center">8</th>

                                    <th scope="row"><input type="text" name="amthead[]" id="amthead8" value="" list="HeadList8" maxlength="15" class="headBox" onchange="haedcname(8)">

                                      <datalist id="HeadList8">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>

                                       <small class="HeadTextshow" id="HeadText8"></small>
                                       <input type="hidden" class="" name="HeadName[]" id="HeadName8" value="">
                                       <input type="hidden" value="H" name="static_ind[]">
                                       <input type="hidden" value="" name="taxIndCode[]" id="taxIndCode8">
                                    </th>



                                    <td><select name="afratei[]" id="afratei8" class="setwidthsel" onchange="rate_if_az(8);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}"><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select>
                                    <small id="indexErr8">
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic8" value="" size="9" maxlength="12" class="textBox rightnumber Number" oninput="logicvalidated(8)">
                                      <small id="logicErr8"></small>
                                    </td>



                                    <td><input type="text" name="afrate[]" id="afrate8" value="" size="5" maxlength="11" class="textBox rightnumber" oninput="ratevalidate(8)">
                                      <small id="rateErr8"></small>
                                    </td>



                                    <td><input type="text" name="ToDate[]" id="ToDate8" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate8" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td>
                                      <input list="glList8"  id="afgl_code8" name="afgl_code[]"  value="" class="textBox" placeholder="Select Gl-Code"size="9" onchange="glCodeName(8)" autocomplete="off">

                                      <datalist id="glList8">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>
                                      <small class="HeadTextshow" id="glText8"></small>
                                      <input type="hidden" id="afgl_name8" name="afgl_name[]" value="">
                                    </td>



                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock8" name="statici[]">
                                          <option value="1" selected>Yes</option>
                                          <option value="0">No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>



                                 

                                  <tr>

                                     <th class="text-center">9</th>

                                     <th scope="row"><input type="text" name="amthead[]" id="amthead9" value="" list="HeadList9" maxlength="15" class="headBox" onchange="haedcname(9)">

                                      <datalist id="HeadList9">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>

                                       <small class="HeadTextshow" id="HeadText9"></small>
                                       <input type="hidden" class="" name="HeadName[]" id="HeadName9" value="">
                                       <input type="hidden" value="I" name="static_ind[]">
                                       <input type="hidden" value="" name="taxIndCode[]" id="taxIndCode9">
                                     </th>



                                    

                                    <td><select name="afratei[]" id="afratei9" class="setwidthsel" onchange="rate_if_az(9);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}"><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select>
                                    <small id="indexErr9">
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic9" value="" size="9" maxlength="12" class="textBox rightnumber Number" oninput="logicvalidated(9)">
                                      <small id="logicErr9"></small>
                                    </td>



                                    <td><input type="text" name="afrate[]" id="afrate9" value="" size="5" maxlength="11" class="textBox rightnumber" oninput="ratevalidate(9)">
                                      <small id="rateErr9"></small>
                                    </td>



                                    <td><input type="text" name="ToDate[]" id="ToDate9" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate9" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td>
                                      <input list="glList9"  id="afgl_code9" name="afgl_code[]"  value="" class="textBox" placeholder="Select Gl-Code"size="9" onchange="glCodeName(9)" autocomplete="off">

                                      <datalist id="glList9">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>
                                      <small class="HeadTextshow" id="glText9"></small>
                                      <input type="hidden" id="afgl_name9" name="afgl_name[]" value="">
                                    </td>

                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock9" name="statici[]">
                                          <option value="1" selected>Yes</option>
                                          <option value="0">No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>



                                  <tr>

                                    <th class="text-center">10</th>

                                     <th scope="row"><input type="text" name="amthead[]" id="amthead10" value="" list="HeadList10" maxlength="15" class="headBox" onchange="haedcname(10)">

                                      <datalist id="HeadList10">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>

                                       <small class="HeadTextshow" id="HeadText10"></small>
                                       <input type="hidden" class="" name="HeadName[]" id="HeadName10" value="">
                                       <input type="hidden" value="J" name="static_ind[]">
                                       <input type="hidden" value="" name="taxIndCode[]" id="taxIndCode10">
                                     </th>

                                    

                                    <td><select name="afratei[]" id="afratei10" class="setwidthsel" onchange="rate_if_az(10);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}"><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select>
                                    <small id="indexErr10">
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic10" value="" size="9" maxlength="12" class="textBox rightnumber Number" oninput="logicvalidated(10)">
                                      <small id="logicErr10"></small>
                                    </td>



                                    <td><input type="text" name="afrate[]" id="afrate10" value="" size="5" maxlength="11" class="textBox rightnumber" oninput="ratevalidate(10)">
                                      <small id="rateErr10"></small>
                                    </td>



                                    <td><input type="text" name="ToDate[]" id="ToDate10" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate10" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td>
                                      <input list="glList10"  id="afgl_code10" name="afgl_code[]"  value="" class="textBox" placeholder="Select Gl-Code"size="9" onchange="glCodeName(10)" autocomplete="off">

                                      <datalist id="glList10">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>
                                      <small class="HeadTextshow" id="glText10"></small>
                                      <input type="hidden" id="afgl_name10" name="afgl_name[]" value=""> 
                                    </td>

                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock10" name="statici[]">
                                          <option value="1" selected>Yes</option>
                                          <option value="0">No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>



                                  <tr>

                                     <th class="text-center">11</th>

                                     <th scope="row"><input type="text" name="amthead[]" id="amthead11" value="" list="HeadList11" class="headBox" onchange="haedcname(11)">

                                      <datalist id="HeadList11">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>

                                       <small class="HeadTextshow" id="HeadText11"></small>
                                       <input type="hidden" class="" name="HeadName[]" id="HeadName11" value="">
                                       <input type="hidden" value="K" name="static_ind[]">
                                       <input type="hidden" value="" name="taxIndCode[]" id="taxIndCode11">
                                     </th>

                                    

                                    <td><select name="afratei[]" id="afratei11" class="setwidthsel" onchange="rate_if_az(11);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{$key->RATE_VALUE}}" ><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select>
                                    <small id="indexErr11">
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic11" value="" size="9" maxlength="12" class="textBox rightnumber Number" oninput="logicvalidated(11)">
                                      <small id="logicErr11"></small>
                                    </td>



                                    <td><input type="text" name="afrate[]" id="afrate11" value="" size="5" maxlength="11" class="textBox rightnumber" oninput="ratevalidate(11)">
                                      <small id="rateErr11"></small>
                                    </td>



                                    <td><input type="text" name="ToDate[]" id="ToDate11" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate11" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td>
                                      <input list="glList11"  id="afgl_code11" name="afgl_code[]"  value="" class="textBox" placeholder="Select Gl-Code"size="9" onchange="glCodeName(11)" autocomplete="off">

                                      <datalist id="glList11">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>
                                      <small class="HeadTextshow" id="glText11"></small>
                                      <input type="hidden" id="afgl_name11" name="afgl_name[]" value="">
                                    </td>

                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock11" name="statici[]">
                                         <option value="1" selected>Yes</option>
                                          <option value="0">No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>



                                  <tr>

                                     <th class="text-center">12</th>

                                     <th scope="row"><input type="text" name="amthead[]" id="amthead12" value="" list="HeadList12" class="headBox" onchange="haedcname(12)">

                                      <datalist id="HeadList12">

                                         <option value="">--SELECT--</option>



                                         @foreach($tax_ind_list as $key)



                                         <option value="{{$key->TAXIND_CODE}}" data-xyz="{{$key->TAXIND_NAME}}">{{ $key->TAXIND_CODE }}-[{{ $key->TAXIND_NAME }}]</option>



                                         @endforeach



                                      </datalist>

                                       <small class="HeadTextshow" id="HeadText12"></small>
                                       <input type="hidden" class="" name="HeadName[]" id="HeadName12" value="">
                                       <input type="hidden" value="L" name="static_ind[]">
                                       <input type="hidden" value="" name="taxIndCode[]" id="taxIndCode12">
                                     </th>  

                                    

                                    <td><select name="afratei[]" id="afratei12" class="setwidthsel" onchange="rate_if_az(12);">

                                      <option value="">--Index--</option>

                                      <?php foreach ($rate_list as $key){ ?>

                                      <option value="{{ $key->RATE_VALUE }}"><?php echo $key->RATE_VALUE; ?> = <?php echo $key->RATE_NAME ?> </option>



                                    <?php } ?>

                                    </select>
                                    <small id="indexErr12">
                                      </small>
                                  </td>



                                    <td><input type="text" name="aflogic[]" id="aflogic12" value="" size="9" maxlength="12" class="textBox rightnumber Number" oninput="logicvalidated(12)">
                                      <small id="logicErr12"></small>
                                    </td>



                                    <td><input type="text" name="afrate[]" id="afrate12" value="" size="5" maxlength="11" class="textBox rightnumber" oninput="ratevalidate(12)">
                                      <small id="rateErr12"></small>
                                    </td>



                                    <td><input type="text" name="ToDate[]" id="ToDate12" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td><input type="text" name="FromDate[]" id="FromDate12" value="" size="6" maxlength="11" class="datepicker DatePickerToFrom"></td>



                                    <td>
                                      <input list="glList12"  id="afgl_code12" name="afgl_code[]"  value="" class="textBox" size="9" placeholder="Select Gl-Code" onchange="glCodeName(12)" autocomplete="off">

                                      <datalist id="glList12">

                                        @foreach($gl_code_list as $row)

                                          <option value='{{ $row->GL_CODE }}' data-xyz ="{{ $row->GL_NAME }}">{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>

                                         @endforeach

                                      </datalist>
                                      <small class="HeadTextshow" id="glText12"></small>
                                      <input type="hidden" id="afgl_name12" name="afgl_name[]" value="">
                                    </td>

                                    <td>

                                      <div class="staticBlock">

                                        <select class="StaticBlockGet" id="staticIndBlock12" name="statici[]">
                                          <option value="1" selected>Yes</option>
                                          <option value="0">No</option>
                                        </select>

                                      </div>

                                    </td>

                                  </tr>

                                </tbody>

                              </table>
                        
                          </div>
                        </div>
                      <div style="text-align: center;">
                          <div id="showAllErrMsg"></div><br>
                        <button type="button" id="submitokbtn" class="btn btn-primary okbtnhideaftrcheck"  onclick="return checkvalidation()">OK</button>
                        
                        <button type="submit" class="btn btn-primary submitbtnC"  style="margin-left: 10%;" id="submitbtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Save</button>
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

  $(document).ready(function() {

    $( window ).on( "load", function() {

     var amhead =  $('#amthead1').val();
        if(amhead){
            $('#basicval1').val(amhead);
            //$('#amthead1').prop('disabled',true);
        }else{

        }
    });

    $('.Number').keypress(function (event) {
      var keycode = event.which;
      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
          event.preventDefault();
      }
      if (keycode == 46 || this.value.length==10) {
        return false;
      }
    });

  });

</script>



<script type="text/javascript">



  function haedcname(headid){

      var taxInd = $('#amthead'+headid).val();

     

      if(taxInd=='GT01'){
        $('#afgl_code'+headid).prop('readonly',true);
        $('#headamt').val('1');
        $('#showAllErrMsg').html('');
      }else{
        $('#afgl_code'+headid).prop('readonly',false);
        $('#headamt').val('0');
        $('#submitbtn').addClass('submitbtnC');
        $('#submitokbtn').show();
      }

      var xyz = $('#HeadList'+headid+' option').filter(function() {

        return this.value == taxInd;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){

         $('#amthead'+headid).val('');

       document.getElementById("HeadText"+headid).innerHTML = ''; 
       $('#afrate'+headid).val('');
       $('#aflogic'+headid).val('');
       $('#afratei'+headid).val('');

        $('#indexErr'+headid).html('');
        $('#HeadName'+headid).val('');
        $('#logicErr'+headid).html('');
        $('#rateErr'+headid).html('');
         $('#taxIndCode'+headid).val('');

      }else{

        document.getElementById("HeadText"+headid).innerHTML = msg; 

            $('#indexErr'+headid).html('Required').css('color','red');
            $('#logicErr'+headid).html('Required').css('color','red');
            $('#rateErr'+headid).html('Required').css('color','red');
            $('#HeadName'+headid).val(msg);

             $('#submitbtn').addClass('submitbtnC');
           $('#submitokbtn').show();

         if(taxInd == 'ST01' || taxInd == 'ST02' || taxInd=='R01' || taxInd=='GT01'){
              $('#afrate'+headid).val(100);
              $('#rateErr'+headid).html('');

              $('#afrate'+headid).prop('readonly',true);
         }else{
              $('#afrate'+headid).val('');
              $('#afrate'+headid).prop('readonly',false);
         }
      }


      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      $.ajax({

          url:"{{ url('get-tax-indicator-details') }}",

          method : "POST",

          type: "JSON",

          data: {taxInd: taxInd},

           success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){
                 
                  if(data1.data==''){

                  }else{
                    $('#taxIndCode'+headid).val(data1.data[0].tax_ind_code);
                     
                  }

       
                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

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

       document.getElementById("glText"+glcodeid).innerHTML = ''; 
       $('#afgl_name'+glcodeid).val();

      }else{

        $('#afgl_code'+glcodeid).val(val);

        document.getElementById("glText"+glcodeid).innerHTML = msg; 

        $('#afgl_name'+glcodeid).val(msg);

       // $('#HeadText').innerHTML(msg);

      }

  }

  function rate_if_az(rateid){
   // console.log(rateid);

    //  for(i=rateid;i<=rateid;i++){

          var rateIndex = $('#afratei'+rateid).val();

         if(rateIndex == 'A' || rateIndex == 'Z' || rateIndex == 'P' || rateIndex == 'Q' || rateIndex == 'R' ){

           $('#staticIndBlock'+rateid).val(1);

           $('#staticIndBlock'+rateid).prop('disabled', true);

         }else{

           $('#staticIndBlock'+rateid).val(0);

           $('#staticIndBlock'+rateid).prop('disabled', false);

         }

         if(rateIndex){
            $('#indexErr'+rateid).html('');
            // $('#submitbtn').show();
         }else{

           $('#indexErr'+rateid).html('Required').css('color','red');
           $('#submitbtn').addClass('submitbtnC');
           $('#submitokbtn').show();
         }

         if(rateIndex == 'L' || rateIndex == 'M' || rateIndex == 'R'){
            $('#aflogic'+rateid).prop('readonly',true);
            $('#aflogic'+rateid).val('');
            $('#logicErr'+rateid).html('');
            $('#afrate'+rateid).val(100).prop('readonly',true);
            $('#rateErr'+rateid).html('');
         }else if(rateIndex == 'Z'){
            $('#afrate'+rateid).val(100).prop('readonly', true);
            $('#logicErr'+rateid).html('');
            $('#rateErr'+rateid).html('');
         }else{
             $('#aflogic'+rateid).prop('readonly',false);
             $('#logicErr'+rateid).html('Required').css('color','red');
              $('#afrate'+rateid).val('').prop('readonly',false);
              $('#rateErr'+rateid).html('Required').css('color','red');
         }



    //  }

  }


  function logicvalidated(logicid){
      var logicGet = $('#aflogic'+logicid).val();

      if(logicGet){
        $('#logicErr'+logicid).html('');
      }else{
        $('#logicErr'+logicid).html('Required').css('color','red');
        $('#submitbtn').addClass('submitbtnC');
        $('#submitokbtn').show();
      }
  }

  function ratevalidate(ratesid){

      var rateGet = $('#afrate'+ratesid).val();

      if(rateGet){
        $('#rateErr'+ratesid).html('');
      }else{
        $('#rateErr'+ratesid).html('Required').css('color','red');
        $('#submitbtn').addClass('submitbtnC');
        $('#submitokbtn').show();
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

          if(msg == 'No Match'){

            document.getElementById("taxText").innerHTML = ''; 
            $('#tax_name').val('');

          }else{
            document.getElementById("taxText").innerHTML = msg; 
            $('#tax_name').val(msg);
          }



          



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




  function checkvalidation()
{
   
   var error = 1;
   var error1 = [];
   

    for(var q=2;q<=12;q++){

       var headamt = $('#headamt').val();
      
    /*   if(amthead=='GT01'){
        var amtvalue = amthead;

        var amtcount =amtvalue.length;
        console.log('amtcount',amtcount);
       }else{
        var amtvalue ='';
      //  console.log('falsevalue',amtvalue);
      console.log('amtcount',0);
       }
*/

       var logi_err =  $('#logicErr'+q).html();
       var logic =  $('#aflogic'+q).val();

       var rate_err =  $('#rateErr'+q).html();
       var rate =  $('#afrate'+q).val();


       var index =  $('#afratei'+q).val();
       var index_err =  $('#indexErr'+q).html();
      // console.log('index_err =>',index_err);
     
       if(logi_err != '' && logic == ''){
        var error = 0;
       // console.log('0 =>',error);
       }

        if(rate_err != '' && rate == ''){
        var error = 2;
      //  console.log('2 =>',error);
       }

       if(index_err == 'Required' && index == ''){
        var error =3;
        //console.log('3 =>',error);
       }

    }  



  


    if(error == 0 || error == 2 || error == 3 ){
      $('#showAllErrMsg').html('<div class="alert alert-danger alert-dismissible" role="alert"><strong>Error ...!</strong> Some Fields Are Required.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          
      $('#submitbtn').addClass('submitbtnC');
      return false
     }else if(headamt==0){
      $('#showAllErrMsg').html('<div class="alert alert-danger alert-dismissible" role="alert"><strong>Error ...!</strong> Grand Total Fields Are Required.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

      $('#submitbtn').addClass('submitbtnC');
      return false
     }
     else{
       $('#showAllErrMsg').html('');
      $('#submitokbtn').hide();
      $('#submitbtn').removeClass('submitbtnC');
        return true
     }

     
   

}

</script>




@endsection