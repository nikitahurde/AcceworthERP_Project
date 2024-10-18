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

  <section class="content-header">

    <h1> Master Cold Storage<small>Add Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Master</a></li>

      <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Master Cold Storage</a></li>

      <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Add Cold Storage</a></li>

    </ol>

  </section>


  <section class="content">

    <div class="row">

      <div class="col-md-12">

        <div class="box box-primary Custom-Box" >

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Master Cold Storage</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/Master/ColdStorage/View-Cold-storage-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Cold Storage</a>

            </div>

          </div><!-- /.box-header -->

          @if(Session::has('alert-success'))

            <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i>Success...!</h4>

                  {!! session('alert-success') !!}

            </div>

          @endif

          @if(Session::has('alert-error'))

            <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-ban"></i>Error...!</h4>

                {!! session('alert-error') !!}

            </div>

          @endif

          <div class="box-body">

            <form action="{{ url('Master/ColdStorage/Cold-storage-Save') }}" method="POST" >

              @csrf

              <div class="row">
                  
                <div class="col-md-2">

                  <div class="form-group">

                    <label>Company Code : <span class="required-field"></span></label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input list="compList" class="form-control" name="comp_code" value="{{$comp_code}}" placeholder="Enter Company Code" id="comp_code" >

                        <datalist id='compList'>
                            <?php foreach($comp_list as $key) { ?>

                            <option value='<?= $key->COMP_CODE ?>' data-xyz='<?= $key->COMP_NAME?>'>{{ $key->COMP_CODE}} = {{ $key->COMP_NAME}}</option>

                            <?php } ?>
                        </datalist>

                    </div>

                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group">

                    <label> Company Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input type="text" class="form-control" name="comp_name" value="{{$comp_name}}" placeholder="Enter Company Name" id="comp_name" readonly>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('comp_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>

                </div>

                <div class="col-md-3">
                    
                  <div class="form-group">

                    <label>Plant Code : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">
                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                        </div>
                            
                        <input list="plantList" id="plant_code" name="plant_code" class="form-control  pull-left  FormTextFirstUpper" value="{{old('plant_code')}}" placeholder="Enter Plant Code" autocomplete="off">

                        <datalist id='plantList'>
                            <option value=""> --- SELECT -- </option>
                        </datalist>

                      </div>

                      <small id="plantcodeErr"></small>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Plant Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input  class="form-control" id="plantName" name="plant_name" placeholder="Plant Name" value="{{old('plant_name')}}" readonly autocomplete="off">

                      </div>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Cold Storage Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input text="text" class="form-control" name="cs_code" id="cold_storage_code" value="{{old('cs_code')}}" placeholder="Enter Cold Storage Code" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cs_code', '<p class="help-block" style="color:red;line-height: 1;">:message</p>') !!}

                      </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Cold Storage Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input text="text" class="form-control" name="cold_storage_name" id="cold_storage_name" value="{{old('cold_storage_name')}}" placeholder="Enter Cold Storage Name" autocomplete="off">

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('cold_storage_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Cold Display Name :</label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input text="text" class="form-control" name="cold_display_name" id="cold_display_name" value="{{old('cold_display_name')}}" placeholder="Enter Cold Display Name" autocomplete="off">

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('cold_display_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Cold Alias Name : </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input text="text" class="form-control" name="cold_alias_name" id="cold_alias_name" value="{{old('cold_alias_name')}}" placeholder="Enter Cold Alias Name" autocomplete="off">

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('cold_alias_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Cold GST No : </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input text="text" class="form-control" name="cold_gst_no" id="cold_gst_no" value="{{old('cold_gst_no')}}" placeholder="Enter Cold GST No" autocomplete="off">

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('cold_gst_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Cold License No: </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input text="text" class="form-control" name="cold_license_no" id="cold_license_no" value="{{old('cold_license_no')}}" placeholder="Enter Cold License No" autocomplete="off">

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('cold_license_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Cold Address: </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <textarea rows="1" cols="0" text="text" class="form-control" name="cold_address" id="cold_address" value="{{old('cold_address')}}" placeholder="Enter Cold Address" autocomplete="off"></textarea>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('cold_address', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Cold Phone No: </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input text="text" class="form-control Number" name="cold_phone_no" id="cold_phone_no" value="{{old('cold_phone_no')}}" placeholder="Enter Cold Phone No" autocomplete="off">

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('cold_phone_no', '<p class="help-block" style="color:red;">:message</p>') !!}
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

    </div>

  </section>

</div>

@include('admin.include.footer')

<script type="text/javascript">
$(document).ready(function(){
  
    var comp_code = $('#comp_code').val();
    getPlantAgainstComp(comp_code);

   $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
    if (keycode == 46 || this.value.length==10) {
    return false;
  }
});

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
        $('#plant_code,#plantName').val('');
        $("#plantList").empty();
        $('#comp_name').val(msg);
        var comp_code = $("#comp_code").val();
        getPlantAgainstComp(comp_code);

    }
  });

  $("#plant_code").bind('change', function () {  

    var val = $(this).val();
          
    var xyz = $('#plantList option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
          
    if(msg == 'No Match'){

        $(this).val('');

         $('#plantName').val('');

    }else{

      $('#plantName').val(msg);
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

                $("#plantList").empty();

                $.each(data1.data, function(k, getAum){

                  $("#plantList").append($('<option>',{

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