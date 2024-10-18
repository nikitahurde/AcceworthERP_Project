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
  .showinmobile{
  display: none;
}

.beforhidetble{
  display: none;
}
.popover{
    left: 80.4922px!important;
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

  .showinmobile{

    display: block;

  }
  .PageTitle{
    float: left;
  }
  .hideinmobile{
    display: none;
  }
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



          <h1>



            Master Storage Location 

            <small>Add Details</small>

          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



           

            <li class="Active"><a href="{{ URL('/Master/Item/Add-Storage-location-Mast')}}">Cold Storage Master</a></li>

            <li class="Active"><a href="{{ URL('/Master/Item/Add-Storage-location-Mast')}}">Add Storage Location</a></li>

           



          </ol>



        </section>



  <section class="content">


    <div class="row col-md-12">
      
    </div>
    <div class="row">



      <!-- <div class="col-sm-2"></div> -->




      <div class="col-md-3"></div>
      <div class="col-md-6">



        <div class="box box-primary Custom-Box" >

          <div class="box-header with-border" style="text-align: center;">


               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Storage Location Master</h2>
               <div class="box-tools pull-right">

                <a href="{{ url('/Master/Item/View-Storage-location-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Storage Location Master</a>

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



            <form action="{{ url('Master/Item/Storage-location-Save') }}" method="POST" >



               @csrf



               <div class="row">
                  
                  <div class="col-md-5">

                    <div class="form-group">

                      <label>Company Code: <span class="required-field"></span></label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="compList" type="text" name="comp_code" id="comp_code" class="form-control" placeholder="Company Code"  style="z-index: 1;" autocomplete="off"/ value="">

                                <datalist id="compList">

                                      @foreach($comp_list as $rows)
                                      <option value="{{ $rows->COMP_CODE }}" data-xyz ="{{ $rows->COMP_NAME }}" autocomplete="off">{{ $rows->COMP_CODE }} = {{ $rows->COMP_NAME }}</option>
                                     
                                      @endforeach

                                </datalist>

                      </div>

                       <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>

                    </div>

                  </div>


                  <div class="col-md-7">

                    <div class="form-group">

                      <label>

                      Company Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="comp_name" value="" placeholder="Enter Company Name" id="comp_name" autocomplete="off" readonly>
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('comp_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>

                  </div>

              </div>

              <div class="row">

                <div class="col-md-5">

                    <div class="form-group">

                      <label>Plant Code: <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="plant_list"  id="plant_code" name="plant_code" class="form-control  pull-left" value="" placeholder="Enter Plant Code" autocomplete="off"/>

                            <datalist id="plant_list">
                            
                               <option value="">--SELECT--</option>

                            </datalist>

                          </div>

                      </div>
                                <!-- /.form-group -->
                  </div>

                  

                  <div class="col-md-7">

                    <div class="form-group">

                      <label>Plant Name: <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input  class="form-control" id="plant_name" name="plant_name" placeholder="Enter Plant Name" value="" autocomplete="off" readonly>

                          </div>

                      </div>
                                <!-- /.form-group -->
                  </div>
                
              </div>

              <div class="row">


                 <div class="col-md-5">


                    <div class="form-group">


                      <label>



                      Location Code: 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>



                          <input text="text" class="form-control" name="location_code" id="location_code" value="" placeholder="Enter Location Code" autocomplete="off">


                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('location_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>



                    </div>



                  </div>


                <div class="col-md-7">


                    <div class="form-group">


                      <label>Location Name :<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                        <input text="text" class="form-control" name="location_name" id="location_name" value="" placeholder="Enter Location Name" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('location_name', '<p class="help-block" style="color:red;">:message</p>') !!}

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

      <div class="col-md-3"></div>



  </div>



     



  </section>



</div>


@include('admin.include.footer')

<script type="text/javascript">

  $(document).ready(function(){

    var comp_code = $('#comp_code').val();
    getPlantAgainstComp(comp_code);
  
    $("#comp_code").bind('change', function () {  

      var val = $(this).val();
     
      var xyz = $('#compList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      
      if(msg == 'No Match'){
        $(this).val('');
        $('#comp_name').val('');
      }else{
        $('#comp_name').val(msg);
        var comp_code = $("#comp_code").val();
        getPlantAgainstComp(comp_code);
      }
    });

    $("#plant_code").bind('change', function () {  

      var val = $(this).val();
      var xyz = $('#plant_list option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      if(msg == 'No Match'){
        $(this).val('');
        $('#plant_name').val('');
      }else{
        $('#plant_name').val(msg);
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

  function getPlantAgainstComp(comp_code){

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

        url:"{{ url('get-plant-data-against-company') }}",
        method : "POST",
        type: "JSON",
        data: {comp_code:comp_code},
        success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {
                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
            }else if(data1.response == 'success'){
              if(data1.data==''){

              }else{

                $("#plant_list").empty();

                $.each(data1.data, function(k, getAum){

                  $("#plant_list").append($('<option>',{

                    value:getAum.PLANT_CODE,

                    'data-xyz':getAum.PLANT_NAME,
                    text:getAum.PLANT_NAME

                  }));

                });

              }

            }
        }
    });

  }
</script>


@endsection