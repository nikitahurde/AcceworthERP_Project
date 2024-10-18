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

  .showSeletedName{

      font-size: 15px;
      margin-top: 2%;
      text-align: center;
      font-weight: 600;
      color: #4f90b5;
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



            Master Profit Center



            <small>Add Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/form-mast-account-type') }}">Master Profit Center</a></li>



            <li class="active"><a href="{{ url('/form-mast-account-type') }}">Add Profit Center</a></li>



          </ol>



        </section>



	<section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-8">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Profit Center </h2>

               <div class="box-tools pull-right showinmobile">


                  <a href="{{ url('/Master/Setting/View-Profit-Center-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Profit Center</a>



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



            <form action="{{ url('/finance/form-profit-center-update') }}" method="POST" >



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



                         <input list="compList"  id="comp_code" name="comp_code" class="form-control  pull-left" value="{{ $pfct_list->COMP_CODE  }}" placeholder="Select Company Code" maxlength="6" readonly>



                          <datalist id="compList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($comp_list as $key)

                            

                            <option value='<?php echo $key->COMP_CODE?>'   data-xyz ="<?php echo $key->COMP_NAME; ?>" ><?php echo $key->COMP_CODE ; echo " [".$key->COMP_NAME."]" ; ?></option>



                            @endforeach

                          </datalist>



                      </div>
                        <div class="pull-left showSeletedName" id="compText"></div>


                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>
                   <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Profit Center Code: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                          <input type="text" class="form-control" name="profit_code" value="{{ $pfct_list->PFCT_CODE }}" placeholder="Enter Profit Center Code" maxlength="6" readonly="">



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('profit_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>







                    </div>



                    <!-- /.form-group -->



                  </div>
                  
                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Profit Center Name : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>



                          <input type="text" class="form-control" name="profit_name" value="{{ $pfct_list->PFCT_NAME }}" placeholder="Enter Profit Center Name" maxlength="40" autocomplete="off">



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('profit_name', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                 

                 <div class="col-md-6">



                    <div class="form-group">

                        <label> Address 1 : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                         <textarea class="form-control" id="" rows="1" name="add1" value="{{ $pfct_list->ADD1 }}" placeholder="Enter Address1" maxlength="40" autocomplete="off">{{ $pfct_list->ADD1 }}</textarea>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('add1', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>
                    </div>
                  </div>

             

              

                <div class="col-md-6">

                  <div class="form-group">

                        <label> Address 2 : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                         <textarea class="form-control" id="" rows="1" name="add2" value="{{ $pfct_list->ADD2 }}" placeholder="Enter Address2" maxlength="40" autocomplete="off">{{ $pfct_list->ADD2 }}</textarea>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('add2', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>

                  </div>

                </div>
                <div class="col-md-6">

                  <div class="form-group">

                        <label> Address 3 :  </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <textarea class="form-control" id="" rows="1" name="add3" value="{{ $pfct_list->ADD3 }}" placeholder="Enter Address3" maxlength="40" autocomplete="off"> {{ $pfct_list->ADD3 }}</textarea>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('add3', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                  </div>
             

                <div class="col-md-4">

                  <div class="form-group">

                        <label> City : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-home"></i></span>

                         <?php $citycode = $pfct_list->CITY_CODE;
                          if($citycode != '' && $citycode != null){
                            $citycode_name = $pfct_list->CITY_CODE.'['.$pfct_list->CITY_NAME.']';
                          }else{
                            $citycode_name = '';
                          }
                      ?>

                         <input  list="cityList" class="form-control" type="text" id="city"  name="city" value="{{ $citycode_name }}" placeholder="Enter City" maxlength="30" onchange="addresDetails()" autocomplete="off" autocomplete="off">


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

                    </div>
                  
                </div>

                <div class="col-md-4">

                  <div class="form-group">

                        <label> District : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                          
                          <?php $distcode = $pfct_list->DIST_CODE;
                          if($distcode != '' && $distcode != null){
                            $distcode_name = $pfct_list->DIST_CODE.'['.$pfct_list->DIST_NAME.']';
                          }else{
                            $distcode_name = '';
                          }
                         ?>

                          <input class="form-control" type="text" id="district"  name="district" value="{{ $distcode_name }}" placeholder="Enter District" maxlength="30" readonly="">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('district', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                  
                </div>

                <div class="col-md-4">



                    <div class="form-group">



                      <label>State</label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                          
                          <?php $statecode = $pfct_list->STATE_CODE;
                          if($statecode != '' && $statecode != null){
                            $statecodename = $pfct_list->STATE_CODE.'['.$pfct_list->STATE_NAME.']';
                          }else{
                            $statecodename = '';
                          }
                         ?>

                          <input list="stateList"  id="statecode" name="state" class="form-control  pull-left" value="{{ $statecodename }}" placeholder="Select State" maxlength="30" style="z-index: 1;"  readonly="">

                          <datalist id="stateList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($state_list as $key)

                            

                            <option value='<?php echo $key->STATE_CODE  ?>'   data-xyz ="<?php echo $key->STATE_NAME; ?>" ><?php echo $key->STATE_CODE   ; echo " [".$key->STATE_NAME."]" ; ?></option>



                            @endforeach

                          </datalist>



                      </div>
                      <div class="pull-left showSeletedName" id="compText"></div>


                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('state', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>

                  </div>
               
               <div class="col-md-4">
                  <div class="form-group">

                        <label> Country : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-flag"></i></span>
                          
                          <?php $countrycode = $pfct_list->COUNTRY_CODE;
                          if($countrycode != '' && $countrycode != null){
                            $countrycodename = $pfct_list->COUNTRY_CODE.'['.$pfct_list->COUNTRY_NAME.']';
                          }else{
                            $countrycodename = '';
                          }
                         ?>
                          <input class="form-control" type="text" id="country"  name="country" value="{{ $countrycodename }}" placeholder="Enter Country" maxlength="30"  readonly="">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">

                        <label> Pin Code : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input class="form-control" type="text" id="pincode"  name="pin_code" value="{{ $pfct_list->PIN_CODE }}" placeholder="Enter Pin Code" maxlength="6"  readonly="">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('pin_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">

                        <label> Phone1 : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input class="form-control Number" type="text" id="phone1"  name="phone1" value="{{ $pfct_list->PHONE1 }}" placeholder="Enter Phone1" maxlength="11">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('phone1', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

             

             
                
                <div class="col-md-4">
                  <div class="form-group">

                        <label> Phone2 : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input class="form-control Number" type="text" id="phone2"  name="phone2" value="{{ $pfct_list->PHONE2 }}" placeholder="Enter Phone2" maxlength="11">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('phone2', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">

                        <label> Fax No : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-fax"></i></span>

                          <input class="form-control" type="text" id="fax_no"  name="fax_no" value="{{ $pfct_list->FAX_NO }}" placeholder="Enter Fax No" maxlength="20" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fax_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">

                        <label> Email Id : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input class="form-control" type="text" id="email_id"  name="email_id" value="{{ $pfct_list->EMAIL_ID }}" placeholder="Enter Email Id" maxlength="20" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('email_id', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

                <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        PFCT Block : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                         



                          <input type="radio" class="optionsRadios1" name="pfct_block" value="YES" <?php if($pfct_list->PFCT_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="pfct_block" value="NO" <?php if($pfct_list->PFCT_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('pfct_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

             



              </div>



              <!-- /.row -->



              <!-- /.row -->


              <div style="text-align: center;">

                <input type="hidden" name="pfctId" value="{{ $pfct_list->PFCT_CODE }}">

                 <button type="Submit" class="btn btn-primary">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 



                 </button>



              </div>



            </form>



          </div><!-- /.box-body -->



           



          </div>



      </div>



      <div class="col-sm-3">



        <div class="box-tools pull-right hideinmobile">



          <a href="{{ url('/Master/Setting/View-Profit-Center-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Profit Center</a>



        </div>



      </div>







    </div>



     



	</section>



</div>







@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/CommonAjax.js') }}" ></script>


<script type="text/javascript">

$(document).ready(function(){
  $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
    if (keycode == 46 || this.value.length==11) {
    return false;
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
    $(document).ready(function(){

        $("#comp_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("compText").innerHTML = msg; 

           if(msg=='No Match'){

             $(this).val('');
             document.getElementById("compText").innerHTML = '';

          }

        });
    });
</script>

@endsection