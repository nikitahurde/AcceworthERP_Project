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

.rightcontent{

  text-align:right;


}

::placeholder {
  
  text-align:left;
}
   

  .setheightinput{
    height: 0%;
  }
  .nameheading{
    font-size: 12px;
  }
  .setetxtintd{
    font-size: 12px !important;
    padding-top: 2% !important;
    padding-bottom: 2% !important;
  }

  .beforhidetble{
    display: none;
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
.CloseListDepot{
  display: none;
}
.popover{
    left: 64.4922px!important;
    width: 169%!important;
}
.showinmobile{
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
.showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }
</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Company

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-company') }}">Master Company</a></li>

            <li class="active"><a href="{{ url('/form-mast-company') }}">Add  Company</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Company</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Master/Setting/View-Company-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Company</a>

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

            <form action="{{ url('form-mast-company-save') }}" method="POST" enctype="multipart/form-data">

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Company Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control codeCapital" name="company_code" value="{{ old('company_code')}}" placeholder="Enter Company Code" id="companyCodeSearch" oninput="this.value = this.value.toUpperCase()" maxlength="6" autocomplete="off">

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>


                          <span class="input-group-addon" style="padding: 1px;">

                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>

                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="CompNameH" id="CompNameH" class="form-control input-md setheightinput" oninput="this.value = this.value.toUpperCase()">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Company Code</th>
                                     <th class="nameheading">Company Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($help_copm_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd"><?php echo $key->COMP_CODE; ?></td>
                                        <td class="setetxtintd"><?php echo $key->COMP_NAME; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                      
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Company Code</th>
                                     <th class="nameheading">Company Name</th>
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

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Company Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="company_name" value="{{ old('company_name')}}" placeholder="Enter Company Name" maxlength="40"autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('company_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

                <!-- /.col -->

                

              </div>

              <!-- /.row -->

              <div class="row">



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Account Code: 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="accList"  name="acc_code"  class="form-control" value="{{ old('acc_code')}}" id="acc_code" maxlength="30" placeholder="Select Account Code" autocomplete="off">

                          <datalist id="accList">
                          
                             <option value="">--SELECT--</option>

                             @foreach($acc_list as $key)

                              <option value="{{ $key->ACC_CODE  }}" data-xyz ="{{ $key->ACC_NAME }}">{{ $key->ACC_CODE }} = {{ $key->ACC_NAME }}</option>

                             @endforeach

                          </datalist>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Account Name: 

                       

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" id="acc_name" name="acc_name" value="{{ old('acc_name')}}" placeholder="Enter Account Name"  style="padding-right: 15%" autocomplete="off" readonly=""> 

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('acc_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <!-- /.col -->

                

              </div>

              <div class="row">



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Contact Number 1: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input type="text" class="form-control Number rightcontent" name="contact_no1" value="{{ old('contact_no1')}}" placeholder="Enter Contact Number 1" maxlength="20" style="padding-right: 15%;z-index: auto;" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('contact_no1', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Contact Number 2

                       

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input type="text" class="form-control Number rightcontent" name="contact_no2" value="{{ old('contact_no2')}}" placeholder="Enter Contact Number 2" maxlength="20" style="padding-right: 15%" autocomplete="off">

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('contact_no2', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <!-- /.col -->

                

              </div>

              <!-- /.row -->



                <div class="row">



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Fax Number: 

                       

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-fax"></i></span>

                          <input type="text" class="form-control" name="fax_no" value="{{ old('fax_no')}}" placeholder="Enter Fax Number" maxlength="20" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fax_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Email-Id:

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                          <input type="email" class="form-control" name="emailid" value="{{ old('emailid')}}" placeholder="Enter Email Id" maxlength="40" autocomplete="off">

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('emailid', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <!-- /.col -->

                

              </div>





              <div class="row">

                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Address: 

                        <span class="required-field"></span>

                      </label>

                      

                      <input type="text" name="address_one" class="form-control" placeholder="Address 1" value="{{ old('address_one')}}" maxlength="40" autocomplete="off">

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_one', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <input type="text" name="address_two" class="form-control" style="margin-top: 2%" placeholder="Address 2" value="{{ old('address_two')}}" maxlength="40" autocomplete="off">

                      <input type="text" name="address_three" class="form-control" style="margin-top: 2%" placeholder="Address 3" value="{{ old('address_three')}}" maxlength="40" autocomplete="off">

                      

                    </div>

                    <!-- /.form-group -->
                    
                   

                  </div>


                   <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        City Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                        <span class="input-group-addon">

                          <i class="fa fa-home" aria-hidden="true"></i>
                        </span>


                      <!--  <input name="city" class="form-control" value="{{ old('city_code')}}" placeholder="Enter City Name" id="city" maxlength="30" autocomplete="off"> -->
                        <input list="cityList" class="form-control" name="city_code" id="city" value="" placeholder="Enter City" maxlength="30" onchange="addresDetails()" autocomplete="off">

                          <datalist id="cityList">

                            <option value=''>--SELECT--</option>

                            @foreach($city_lists as $row)

                              <option value='{{ $row->CITY_CODE }}'data-xyz="{{ $row->CITY_NAME }}">{{ $row->CITY_CODE }}[{{ $row->CITY_NAME }}] </option>

                            @endforeach

                          </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('city_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                    <!-- /.form-group -->

                    <div class="form-group">

                      <label>

                        Pincode : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc"></i>

                          </span>

                        <input type="text" name="pincode" class="form-control rightcontent" value="{{ old('pincode')}}" placeholder="Enter Pincode" maxlength="6" autocomplete="off" id="pincode">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('pincode', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>

                   



                

              </div>



              <div class="row">

                <div class="col-md-6">

                   <div class="form-group">

                      <label>

                        District : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc"></i>

                          </span>

                        <input type="text" name="district" class="form-control" value="{{ old('district')}}" placeholder="Enter District" maxlength="30" autocomplete="off"  id="district" readonly="">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('district', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                  
                </div>

                 <div class="col-md-6">

                   

                    <div class="form-group">

                      <label>

                        State  : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc"></i>

                          </span>

                      
                        
                        <input list="stateList" type="text" name="state_code"  class="form-control" value="{{ old('state_code')}}" id="statecode" maxlength="30" placeholder="Select State" autocomplete="off" readonly="">

                        <datalist id="stateList">

                        <option value="">--SELECT STATE--</option>

                       @foreach ($state_list as $key)

                        <option data-xyz ="<?php echo $key->STATE_NAME; ?>" value="{{$key->STATE_CODE}}">{{$key->STATE_NAME }}</option>

                        @endforeach

                        </datalist>

                    </div>

                      <div class="pull-left showSeletedName" id="companyText"></div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('state_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>



                   

                  </div>
                
                 
                </div>

                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label>
                        PAN No : 
                        <span class="required-field"></span>
                      </label>

                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc"></i>
                          </span>

                          <input type="text" name="pan_no" class="form-control" placeholder="Enter PAN No"  maxlength="30" value="{{ old('pan_no')}}" autocomplete="off">
                      </div>

                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('pan_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>
                        TAN No : 
                      </label>

                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc"></i>
                          </span>

                          <input type="text" name="tan_no" class="form-control" placeholder="Enter TAN No"  maxlength="30" value="{{ old('tan_no')}}" autocomplete="off">
                      </div>

                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('tan_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>
                        GST No : 
                        <!-- <span class="required-field"></span> -->
                      </label>

                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc"></i>
                          </span>

                          <input type="text" name="gst_no" class="form-control  nextOnEnterBtn" placeholder="Enter GST No" value="{{ old('gst_no')}}" autocomplete="off">
                      </div>

                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('gst_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label>
                        CIN No : 
                       
                      </label>

                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc"></i>
                          </span>

                          <input type="text" name="cin_no" class="form-control" placeholder="Enter CIN No"  maxlength="30"  value="{{ old('cin_no')}}" autocomplete="off" >
                      </div>

                      <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('cin_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-6">
                   <div class="form-group">

                      <label>

                        Country : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-flag"></i>

                          </span>

                    <input type="text" name="country_name" class="form-control" placeholder="Enter Country Name" value="India" maxlength="30" autocomplete="off" readonly="" id="country">

                    </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                      </div>
                       <div class="col-md-6">
                   <div class="form-group">

                      <label>

                        Logo : <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-user"></i>

                          </span>

                    <input type="file" class="form-control" name="logo" id="logo" alt="logo">

                    </div>
                     <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('logo', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                     
                    </div>
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

      <div class="col-sm-3 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/Master/Setting/View-Company-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Company</a>

        </div>

      </div>



    </div>

     

	</section>

</div>



@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/CommonAjax.js') }}" ></script>

<script type="text/javascript">
   $(document).ready(function(){      
    $(".Number").keypress(function(event){
        var keycode = event.which;
        if (!(keycode >= 48 && keycode <= 57)) {
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

  $(document).ready(function() {
  $(".Number").on("keypress", function(evt) {
    var keycode = evt.charCode || evt.keyCode;
    if (keycode == 46 || this.value.length==10) {
      return false;
    }
  });

  });

</script>

<script type="text/javascript">

  $(document).ready(function() {
  $(".pincode").on("keypress", function(evt) {
    var keycode = evt.charCode || evt.keyCode;
    if (keycode == 46 || this.value.length==6) {
      return false;
    }
  });

  });

</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#companyCodeSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var companyCodeSearch = $('#companyCodeSearch').val();
        //console.log(depot_code_search);

        if(companyCodeSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-company-code') }}",

             method : "POST",

             type: "JSON",

             data: {companyCodeSearch: companyCodeSearch},

             success:function(data){

                 console.log(data);
                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                       var objcity = data1.data;
                       //$('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.COMP_CODE+'</span><br>');
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
        title: 'Help Company Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var HelpCompCode = $('#CompNameH').val();

           if(HelpCompCode == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

                $.ajax({

                url:"{{ url('help-company-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpCompCode: HelpCompCode},

                 success:function(data){

                     // console.log(data);
                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Company Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;
                          
                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             var headData = "<tr><th class='nameheading'>Company Code</th><th class='nameheading'>Company Name</th></tr>";
                             $('#ShowWhenSeaech').html(headData);
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.COMP_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.COMP_NAME+'</td></tr>');
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
       // console.log('hii');
          $('.popover').fadeOut();
    })

    $("#statecode").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#stateList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        //alert(msg+xyz);

       document.getElementById("companyText").innerHTML = msg; 

        if(msg=='No Match'){

           $(this).val('');
        

        }

      });

     $("#acc_code").bind('change', function(){  

        var val = $(this).val();

        var xyz = $('#accList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';
        console.log('msg',msg);
        if(msg == 'No Match'){

            $('#acc_code').val('');
            $('#acc_name').val('');

        }else{

            $('#acc_code').val(val);
            $('#acc_name').val(msg);
        }


    });

  });
</script>
<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>
@endsection



