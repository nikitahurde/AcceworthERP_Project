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


.showinmobile{
  display: none;
}
.showSeletedName{

    font-size: 12px;

    margin-top: 1%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }
.rightcontent{

  text-align:right;


}

::placeholder {
  
  text-align:left;
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

            Master Company

            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/edit-company/'.base64_encode($comp_list->COMP_CODE)) }}">Master Company</a></li>

            <li class="active"><a href="{{ url('/edit-company/'.base64_encode($comp_list->COMP_CODE)) }}">Update  Company</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update  Company</h2>

              
              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-company') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Company</a>

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

            <form action="{{ url('form-mast-company-update') }}" method="POST" enctype="multipart/form-data">

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Company Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="company_code" value="{{ $comp_list->COMP_CODE }}" maxlength="6" readonly="" autocomplete="off">

                          <input type="hidden" name="companyId" value="{{ $comp_list->COMP_CODE }}" placeholder="Enter Company Code">

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

                          <input type="text" class="form-control" name="company_name" value="{{ $comp_list->COMP_NAME }}" placeholder="Enter Company Name" maxlength="40" autocomplete="off">

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

                          <input list="accList"  name="acc_code"  class="form-control" value="{{ $comp_list->ACC_CODE }}" id="acc_code" maxlength="30" placeholder="Select Account Code" autocomplete="off">

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

                          <input type="text" class="form-control" id="acc_name" name="acc_name" value="{{ $comp_list->ACC_NAME }}" placeholder="Enter Account Name"  style="padding-right: 15%" autocomplete="off" readonly=""> 

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

                          <input type="text" class="form-control Number rightcontent" name="contact_no1" value="{{ $comp_list->PHONE1 }}" placeholder="Enter Contact Number 1" maxlength="20" autocomplete="off">

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

                          <input type="text" class="form-control Number rightcontent" name="contact_no2" value="{{ $comp_list->PHONE2 }}" placeholder="Enter Contact Number 2" maxlength="20" autocomplete="off">

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

                          <input type="text" class="form-control" name="fax_no" value="{{ $comp_list->FAX_NO }}" placeholder="Enter Fax Number" maxlength="20" autocomplete="off">

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

                          <input type="email" class="form-control" name="emailid" value="{{ $comp_list->EMAIL_ID }}" placeholder="Enter Email Id" maxlength="40" autocomplete="off">

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

                      

                      <input type="text" name="address_one" class="form-control" placeholder="Address 1" value="{{ $comp_list->ADD1 }}" maxlength="40" autocomplete="off">

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_one', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <input type="text" name="address_two" class="form-control" style="margin-top: 2%" placeholder="Address 2" value="{{ $comp_list->ADD2 }}" maxlength="40" autocomplete="off">

                      

                      <input type="text" name="address_three" class="form-control" style="margin-top: 2%" placeholder="Address 3" value="{{ $comp_list->ADD3 }}" maxlength="40" autocomplete="off">

                       
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

                     

                      <?php $citycode = $comp_list->CITY_CODE;
                          if($citycode != '' && $citycode != null){
                            $citycode_name = $comp_list->CITY_CODE.'['.$comp_list->CITY.']';
                            // echo $citycode_name;
                          }else{
                            $citycode_name = '';
                             // echo $citycode_name;
                          }
                      ?>

                      <input list="cityList" class="form-control" name="city_code" id="city" value="{{ $citycode_name}}" placeholder="Enter City" maxlength="30" onchange="addresDetails()" autocomplete="off">

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

                      <div class="form-group">

                      <label>

                        Pincode : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc"></i>

                          </span>

                        <input type="text" name="pincode"  id="pincode" class="form-control rightcontent" value="{{ $comp_list->PIN_CODE }}" maxlength="6" >

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('pincode', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->

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

                         <?php $distcode = $comp_list->DIST_CODE;
                          if($distcode != '' && $distcode != null){
                            $distcode_name = $comp_list->DIST_CODE.'['.$comp_list->DIST.']';
                          }else{
                            $distcode_name = '';
                          }
                         ?>

                        <input type="text" name="district" id="district" class="form-control" value="{{ $distcode_name }}" placeholder="Enter District" maxlength="30" readonly="">

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

                        <?php $statecode = $comp_list->STATE_CODE;
                          if($statecode != '' && $statecode != null){
                            $statecodename = $comp_list->STATE_CODE.'['.$comp_list->STATE.']';
                          }else{
                            $statecodename = '';
                          }
                         ?>

                        <input list="stateList" type="text" name="state_code" id="statecode" class="form-control" placeholder="Select State" value="{{$statecodename}}" maxlength="30" readonly="">

                      <datalist id='stateList'>

                        <option value="">--SELECT STATE--</option>

                       @foreach ($state_list as $key)

                        <option  data-xyz ="<?php echo $key->STATE_NAME; ?>"  value="{{$key->STATE_CODE}}" <?php if($key->STATE_CODE==$comp_list->STATE_CODE){ echo 'selected';} ?>>{{$key->STATE_NAME }}</option>

                        @endforeach

                      </datalist>

                    </div>
                       <div class="pull-left showSeletedName" id="sateText"></div>
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

                          <input type="text" name="pan_no" class="form-control" placeholder="Enter PAN No"  maxlength="30" value="{{ $comp_list->PAN_NO }}" autocomplete="off">
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

                          <input type="text" name="tan_no" class="form-control" placeholder="Enter TAN No"  maxlength="30" value="{{ $comp_list->TAN_NO}}" autocomplete="off">
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

                          <input type="text" name="gst_no" class="form-control  nextOnEnterBtn" placeholder="Enter GST No" value="{{$comp_list->GST_NO}}" autocomplete="off">
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

                          <input type="text" name="cin_no" class="form-control" placeholder="Enter CIN No"  maxlength="30" value="{{ $comp_list->CIN_NO }}" autocomplete="off">
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

                           <?php $countrycode = $comp_list->COUNTRY_CODE;
                          if($countrycode != '' && $countrycode != null){
                            $countrycodename = $comp_list->COUNTRY_CODE.'['.$comp_list->COUNTRY.']';
                          }else{
                            $countrycodename = '';
                          }
                         ?>

                    <input type="text" name="country_name" id="country" class="form-control" placeholder="Enter Country Name" value="{{$countrycodename}}" readonly="" autocomplete="off">

                    </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->


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

                      <?php if($comp_list->LOGO) { ?>
                      <img src= "{{ URL::asset('public/dist/img') }}/<?= $comp_list->LOGO ?>" style="width:50px;height:50px" value="{{ URL::asset('public/dist/img/<?= $comp_list->LOGO ?>') }}" />
                    <?php  } ?>
                    </div>
                      </div>

                  
                </div>

                <div class="row">
                 
                  
                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Block Company: 

                        <span class="required-field"></span>

                      </label>

                     
                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="comp_block" value="YES" <?php if($comp_list->BLOCK_COMP=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="comp_block" value="NO" <?php if($comp_list->BLOCK_COMP=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                  </div>

              </div>

              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

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

    $("#state_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#stateList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        //alert(msg+xyz);

       

        if(msg=='No Match'){

           $(this).val('');
        
           document.getElementById("sateText").innerHTML = ''; 
        }else{
          document.getElementById("sateText").innerHTML = msg; 
        }

      });

     $("#acc_code").bind('change', function(){  

        var val = $(this).val();

        var xyz = $('#accList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';
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
  $(document).ready(function(){
    $( window ).on( "load", function() {

        var val = $("#state_code").val();

        var xyz = $('#stateList option').filter(function() {

        return this.value == val;

        }).data('xyz');

       // console.log('xyz',xyz);

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){

           $(this).val('');
        
        }else{
          document.getElementById("sateText").innerHTML = msg; 
        }

    });
    
  });
</script>

@endsection