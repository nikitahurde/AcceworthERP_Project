@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



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

.showinmobile{
  display: none;
}
.showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

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

            Master Depot

            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/edit-depot/'.base64_encode($depot_list->DEPOT_CODE)) }}">Master Depot</a></li>

            <li class="active"><a href="{{ url('/edit-depot/'.base64_encode($depot_list->DEPOT_CODE)) }}">Edit Mast Depot</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master Depot</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-depot') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Depot</a>

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

            <form action="{{ url('form-mast-depot-update') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Depot Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                        
                          <input type="text" class="form-control" name="depot_code" value="{{ $depot_list->DEPOT_CODE}}"  maxlength="6">
                     

                          <input type="hidden" class="form-control" name="depotId" value="{{ $depot_list->DEPOT_CODE}}" >

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('depot_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Depot Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="depot_name" value="{{ $depot_list->DEPOT_NAME}}" placeholder="Enter Depot Name" maxlength="30">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('depot_name', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        Contact Number : 

                        <span class="required-field"></span>

                      </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input type="text" class="form-control Number rightcontent" name="contact_no" value="{{$depot_list->CONTACT_PERSON}}" placeholder="Enter Contact Number"  maxlength="10">

                    </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('contact_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Contact Email 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                          <input type="email" class="form-control" name="contact_email" value="{{ $depot_list->CONTACT_EMAIL}}" placeholder="Enter Contact Email" maxlength="30" style="text-transform: lowercase;">

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('contact_email', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        Address One : 

                        <span class="required-field"></span>

                      </label>

                      <input type="text" name="address_one" value="{{ $depot_list->ADD1 }}" class="form-control" placeholder="Enter Address 1" maxlength="30">

                       <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_one', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <input type="text" name="address_two" value="{{ $depot_list->ADD2 }}" style="margin-top: 2%" class="form-control" placeholder="Enter Address 2" maxlength="30">

                      <input type="text" name="address_three" value="{{ $depot_list->ADD3 }}" style="margin-top: 2%" class="form-control" placeholder="Enter Address 3" maxlength="30">

                     
                    </div>

                    <!-- /.form-group -->
                     

                  </div>

                   <div class="col-md-6">
                   <div class="form-group">

                      <label>

                        City Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true"></i>

                          </span>

                       <input name="city_code" class="form-control" value="{{ $depot_list->CITY_CODE }}" placeholder="Enter City Code ">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('city_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                 

                </div>

                 <div class="col-md-6">

                   
                    <div class="form-group">

                      <label>

                        Pincode : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc"></i>

                          </span>

                        <input type="text" name="pincode" class="form-control pincode rightcontent" value="{{ $depot_list->PIN_CODE }}" placeholder="Enter Pincode"  maxlength="6">

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

                        District: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true"></i>

                          </span>

                       <input name="district" class="form-control" placeholder="Enter District" value="{{ $depot_list->DIST_CODE }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('district', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>
                
                 </div>
                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Country: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true"></i>

                          </span>

                       <input name="country" class="form-control" placeholder="Enter Country" value="{{ $depot_list->COUNTRY }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                  </div>

               
              </div>
                  
              <div class="row">
                 <div class="col-md-6">
                  <div class="form-group">

                      <label>

                        State Code : 

                        <span class="required-field"></span>

                      </label>

                       <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true">
                              
                            </i></span>


                      <input list="stateList" type="text" name="state_code" class="form-control" id="state_code" maxlength="30" placeholder="Select State" value="{{ $depot_list->STATE_CODE }}">

                    <datalist id="stateList">

                        <option value="">--SELECT STATE--</option>

                       @foreach ($state_list as $key)

                        <option value="{{$key->STATE_CODE}}" data-xyz ="<?php echo $key->STATE_NAME; ?>" <?php if($key->STATE_CODE==$depot_list->STATE_CODE) {echo 'selected';} ?>>{{$key->STATE_NAME }}</option>

                        @endforeach

                    </datalist>

                     </div>

                     <small>  

                        <div class="pull-left showSeletedName" id="stateText"></div>

                     </small>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('state_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Block Depot: 

                        <span class="required-field"></span>

                      </label>

                     
                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="depot_block" value="1" <?php if($depot_list->FLAG=='1'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="depot_block" value="0" <?php if($depot_list->FLAG=='0'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


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

      <div class="col-sm-2 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/view-mast-depot') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Depot</a>

        </div>

      </div>



    </div>

     

	</section>

</div>



@include('admin.include.footer')


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
<!-- <script type="text/javascript">
  
  $(document).ready(function() {

 $('input:text:first').focus();
   

 $(document).on('keypress', 'input,select', function (e) {

    var n = $("input,select").length;

    if (e.which == 13)

    { //Enter key

      e.preventDefault(); //Skip default behavior of the enter key

      var nextIndex = $('input,select').index(this) + 1;
      if(nextIndex < n)
        $('input,select')[nextIndex].focus();
      else
      {
        $('input,select')[nextIndex-1].blur();
        
      }
    }
  });
 
});

</script> -->

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
  $("#state_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#stateList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("stateText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

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


@endsection