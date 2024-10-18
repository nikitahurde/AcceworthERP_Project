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


            <small>: Add Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/master/geogaraphycal/city-master')}}">Geographical  </a></li>



            <li class="Active"><a href="{{ URL('/master/geogaraphycal/city-master')}}">Add City </a></li>



          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add City</h2>

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


              <form action="{{ url('/master/geogaraphycal/city-master-save') }}" method="POST" id="CountryForm">

                @csrf

                  <div class="row">

                    <div class="col-lg-12">

                      <div class="row">
                       
                        <div class="col-sm-4">
                          
                          <div class="form-group">

                            <label>

                             City Name : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                                <input type="text" class="form-control" name="city_name" id="cityName" value="{{old('city_name')}}" placeholder="Enter City Name" autocomplete="off" oninput="funGenCityCode(this)">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('city_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>
                        
                        <div class="col-sm-2">
                          
                          <div class="form-group">

                            <label>

                             City Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="city_code" id="cityCode" value="{{old('city_code')}}" placeholder="City Code" readonly autocomplete="off">

                            </div> 

                            <small id="cityCodeErr" style="font-weight:600;"></small>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('city_code', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                                <input type="text" class="form-control" name="pin_code" id="pinCode" value="{{old('pin_code')}}" placeholder="Enter Pin Code" maxlength="6" autocomplete="off">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('pin_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                        <div class="col-sm-4">
                          
                          <div class="form-group">

                            <label>

                             District Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input list="districtList" class="form-control" name="district_code" id="districtCode" value="{{old('district_code')}}" placeholder="Select District Code" maxlength="6" autocomplete="off">

                                <datalist id="districtList">

                                  <option selected="selected" value="">-- Select --</option>

                                  @foreach ($district_list as $key)

                                  <option value='<?php echo $key->DISTRICT_CODE; ?>'   data-xyz ="<?php echo $key->DISTRICT_NAME; ?>"><?php echo $key->DISTRICT_NAME ; echo " [".$key->DISTRICT_CODE."]" ; ?></option>

                                  @endforeach

                                </datalist>

                            </div>

                            <input type="hidden" name="district_name" id="distNameInput" />
                            <div class="pull-left showSeletedName" id="distName"></div>


                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('district_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                      </div>


                      
                    </div>

                  </div>

                  <div style="text-align: center;">
                
                     <button type="Submit" class="btn btn-primary" id="submitdata">

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

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

  function funGenCityCode(element){

    var cityName = $('#cityName').val();
    var tbl_name = 'MASTER_CITY';
    var col_code = 'CITY_CODE';
    
    if(cityName){

      var max_chars = 3;
  
      var element_value ;
      if(cityName.length >= max_chars) {
        element_value = element.value.substr(0, 3);
        element_value = element_value.toUpperCase();
      }else if(cityName.length <= max_chars){
         $('#cityCode').val('');
      }else{
        $('#cityCode').val('');
      }
   
      var likename = element_value;
      
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
              $('#cityCode').val(newcode);
            }else{
              $('#cityCode').val('');
            }

          }
        },error:function(){
          $('#cityCodeErr').html('City Code is not Generated...!').css('color','red');
          $('#submitdata').prop('disabled', true);

        }
      }); /* /.ajax*/

    }else{
      $('#cityCode').val('');
    } /* /. codn*/
     
  }

  $(document).ready(function() {

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
            $('#distNameInput').val('');
          }else{
            $('#distNameInput').val(msg);

             document.getElementById("distName").innerHTML = msg; 
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