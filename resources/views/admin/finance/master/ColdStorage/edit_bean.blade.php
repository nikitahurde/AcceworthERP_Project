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

    <h1>Master Bean <small>Update Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Master</a></li>

      <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Master Bean </a></li>

      <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Update Bean </a></li>
         
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-md-12">

        <div class="box box-primary Custom-Box" >

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Bean </h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/Master/ColdStorage/View-Bing-storage-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Bean </a>

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

                <h4> <i class="icon fa fa-ban"></i>Error...!</h4>

                {!! session('alert-error') !!}

            </div>

          @endif

          <div class="box-body">

            <form action="{{ url('Master/ColdStorage/Bing-storage-Update') }}" method="POST" >

              @csrf

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Cold Storage Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input list="coldStorage_list" class="form-control" name="cs_code" id="cs_code" value="{{ $classData->CS_CODE }}" placeholder="Cold Storage Code" id="cs_code" autocomplete="off" readonly>

                      <datalist id="coldStorage_list">
                          
                        <option value=""> --SELECT-- </option>
                        @foreach($coldstorage_list as $key)

                          <option value='<?php echo $key->CS_CODE; ?>'   data-xyz ="<?php echo $key->CS_NAME; ?>"><?php echo $key->CS_NAME ; echo " [".$key->CS_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('cs_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Cold Storage Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input type="text" class="form-control" name="cs_name" value="{{ $classData->CS_NAME }}" placeholder="Cold Storage Name" id="cs_name" readonly autocomplete="off">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('cs_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>
                  
                <div class="col-md-3">

                  <div class="form-group">

                    <label>Chamber Code : <span class="required-field"></span></label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input list="chamber_list" class="form-control" name="chamber_code" value="{{ $classData->CHAMBER_CODE }}" placeholder="Chamber Code" id="chamber_code" autocomplete="off" readonly>

                        <datalist id="chamber_list">
                          
                        <option value=""> --SELECT-- </option>
                        @foreach($chamber_list as $key)

                          <option value='<?php echo $key->CHAMBER_CODE; ?>'   data-xyz ="<?php echo $key->CHAMBER_NAME; ?>"><?php echo $key->CHAMBER_NAME ; echo " [".$key->CHAMBER_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('chamber_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>

                </div>
              
                <div class="col-md-4">

                  <div class="form-group">

                    <label>Chamber Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input  class="form-control" id="chamber_name" name="chamber_name" placeholder="Chamber Name" value="{{ $classData->CHAMBER_NAME }}" readonly autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('chamber_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Floor Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                        </div>

                        <input list="floor_list" class="form-control" id="floor_code" name="floor_code" placeholder="Floor Code" value="{{ $classData->FLOOR_CODE }}" autocomplete="off" readonly> 

                        <datalist id="floor_list">
                          
                          <option value=""> --SELECT-- </option>
                          @foreach($floor_list as $key)

                            <option value='<?php echo $key->FLOOR_CODE; ?>'   data-xyz ="<?php echo $key->FLOOR_NAME; ?>"><?php echo $key->FLOOR_NAME ; echo " [".$key->FLOOR_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('floor_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Floor Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input  class="form-control" id="floor_name" name="floor_name" placeholder="Floor Name" value="{{ $classData->FLOOR_NAME }}" readonly autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('floor_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Block Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                        </div>

                        <input list="block_list" class="form-control" id="block_code" name="block_code" placeholder="Block Code" value="{{ $classData->BLOCK_CODE }}" autocomplete="off" readonly>

                        <datalist id="block_list">
                          
                          <option value=""> --SELECT-- </option>
                          @foreach($block_list as $key)

                            <option value='<?php echo $key->BLOCK_CODE; ?>'   data-xyz ="<?php echo $key->BLOCK_NAME; ?>"><?php echo $key->BLOCK_NAME ; echo " [".$key->BLOCK_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('block_code', '<p class="help-block" style="color:red;line-height:1">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Block Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input  class="form-control" id="block_name" name="block_name" placeholder="Block Name" value="{{ $classData->BLOCK_NAME }}" readonly autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('block_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Bean Code: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                        </div>

                        <input class="form-control" id="bean_code" name="bean_code" placeholder="Bean Code" value="{{ $classData->BEAN_CODE }}" readonly autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('bean_code', '<p class="help-block" style="color:red;line-height:1">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Bean Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input class="form-control" id="bean_name" name="bean_name" placeholder="Bean Name" value="{{ $classData->BEAN_NAME }}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('bean_name', '<p class="help-block" style="color:red;line-height:1">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Storage Capacity: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                        </div>

                        <input  class="form-control" id="storage_capacity" name="storage_capacity" placeholder="Storage Capacity" value="{{ $classData->STORAGE_CAPACITY }}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('storage_capacity', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-5">

                  <div class="form-group">

                    <label>Bean Block : <span class="required-field"></span></label>

                      <div class="input-group">

                        <input type="radio" class="optionsRadios1" name="bean_block" value="YES" <?php if($classData->BINGSTORAGE_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <input type="radio" class="optionsRadios1" name="bean_block" value="NO" <?php if($classData->BINGSTORAGE_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('bean_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div>
                
              </div>

              <div style="text-align: center;">

                <input type="hidden" name="compCd" value="{{ $classData->COMP_CODE }}">
                <input type="hidden" name="csCd" value="{{ $classData->CS_CODE }}">
                <input type="hidden" name="chamberCd" value="{{ $classData->CHAMBER_CODE }}">
                <input type="hidden" name="floorCd" value="{{ $classData->FLOOR_CODE }}">
                <input type="hidden" name="blockCd" value="{{ $classData->BLOCK_CODE }}">
                <input type="hidden" name="beanCd" value="{{ $classData->BEAN_CODE }}">

                <button type="Submit" class="btn btn-primary">

                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

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

  $("#cs_code").bind('change', function () {

      var cs_code =  $(this).val();
      var xyz = $('#coldStorage_list option').filter(function() {

        return this.value == cs_code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $(this).val('');
         $('#cs_name').val('');
      }else{
         $('#cs_name').val(msg);
      }
  });

  $("#chamber_code").bind('change', function () {

      var chamber_code =  $(this).val();
      var xyz = $('#chamber_list option').filter(function() {

        return this.value == chamber_code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $(this).val('');
         $('#chamber_name').val('');
      }else{
         $('#chamber_name').val(msg);
      }
  });

  $("#floor_code").bind('change', function () {

      var floorcode =  $(this).val();
      var xyz = $('#floor_list option').filter(function() {

        return this.value == floorcode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $(this).val('');
         $('#floor_name').val('');
      }else{
         $('#floor_name').val(msg);
      }
  });

  $("#block_code").bind('change', function () {

      var blockcode =  $(this).val();
      var xyz = $('#block_list option').filter(function() {

        return this.value == blockcode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $(this).val('');
         $('#block_name').val('');
      }else{
         $('#block_name').val(msg);
      }
  });

</script>


<script type="text/javascript">
$(document).ready(function(){
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
</script>

@endsection