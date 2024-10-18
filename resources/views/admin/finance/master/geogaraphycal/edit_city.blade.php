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


   box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);



  }

  .showSeletedName{



    font-size: 15px;



    margin-top: 2%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;



  }
.rightcontent{

  text-align:right;


}
.creditCls{
  display: none;
}
::placeholder {
  
  text-align:left;
}
.showinmobile{
  display: none;
}
.SubmitBtn{
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



             Master City


            <small>: Update Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/master/geogaraphycal/city-master')}}">Geographical  </a></li>



            <li class="Active"><a href="{{ URL('/master/geogaraphycal/city-master')}}">Update City </a></li>



          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update City</h2>

               <div class="box-tools pull-right">

                <a href="{{ url('/master/geogaraphycal/view-city-master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View City</a>

              </div>



            </div><!-- /.box-header -->



             @if(Session::has('alert-success'))


              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">


                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-check"><i>

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


              <form action="{{ url('/master/geogaraphycal/city-master-update') }}" method="POST" id="CountryForm">

                @csrf

                  <div class="row">

                    <div class="col-lg-12">

                      <div class="row">

                        
                        <div class="col-sm-2">
                          
                          <div class="form-group">

                            <label>

                             City Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="city_code" id="cityCode" value="{{$city_list->CITY_CODE }}" placeholder="Enter City Code" maxlength="6" readonly="">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('city_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                        <div class="col-sm-3">
                          
                          <div class="form-group">

                            <label>

                             City Name : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                                <input type="text" class="form-control" name="city_name" id="cityName" value="{{$city_list->CITY_NAME }}" placeholder="Enter City Name" maxlength="20" readonly="">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('city_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                        <div class="col-sm-2">
                          
                          <div class="form-group">

                            <label>

                             Pin Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="pin_code" id="pinCode" value="{{$city_list->PIN_CODE }}" placeholder="Enter Pin Code" maxlength="6">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('pin_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                        <div class="col-sm-3">
                          
                          <div class="form-group">

                            <label>

                             District Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input list="districtList" class="form-control" name="district_code" id="districtCode" value="{{$city_list->DIST_CODE  }}" placeholder="Select District Code" maxlength="6">

                                <datalist id="districtList">

                                  <option selected="selected" value="">-- Select --</option>

                                  @foreach ($district_list as $key)

                                  <option value='<?php echo $key->DISTRICT_CODE; ?>'   data-xyz ="<?php echo $key->DISTRICT_NAME; ?>"><?php echo $key->DISTRICT_NAME ; echo " [".$key->DISTRICT_CODE."]" ; ?></option>

                                  @endforeach

                                </datalist>

                            </div>

                            <input type="hidden" name="district_name" id="distNameInput" value="{{$city_list->DIST_NAME }}"/>

                            <small id="distName">
                              
                            </small> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('district_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                        <div class="col-md-2">

                          <div class="form-group">

                            <label>

                              Block City: 

                              <span class="required-field"></span>

                            </label>

                           
                            <div class="input-group">

                                <input type="radio" class="optionsRadios1" name="city_block" value="YES"<?php if($city_list->CITY_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <input type="radio" class="optionsRadios1" name="city_block" value="NO"<?php if($city_list->CITY_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                            

                          </div>

                        </div>

                      </div>


                      
                    </div>

                  </div>

                  <div style="text-align: center;">
                
                     <button type="Submit" class="btn btn-primary">

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                     </button>

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




    $(document).ready(function(){

        $("#districtCode").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#districtList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){

            $('#district_code').val('');
            $('#distNameInput').val('');

          }else{
            document.getElementById("distName").innerHTML = msg; 

            $('#distNameInput').val(msg);
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

  });





</script>




@endsection