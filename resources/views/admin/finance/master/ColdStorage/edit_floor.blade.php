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
  @media screen and (max-width: 600px) {

    .PageTitle{
      float: left;
    }
  }

</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>Master Floor <small>Update Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Master</a></li>

      <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Master Floor </a></li>

      <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Update Floor </a></li>
         
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-md-12">

        <div class="box box-primary Custom-Box" >

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Floor </h2>

            <div class="box-tools pull-right">

              <a href="{{ url('Master/ColdStorage/View-Floor-storage-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Floor </a>

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

            <form action="{{ url('Master/ColdStorage/Floor-storage-Update') }}" method="POST" >

              @csrf

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Cold Storage Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input list="coldStorage_list" class="form-control" name="cs_code" id="cs_code" value="{{ $classData->CS_CODE }}" placeholder="Enter Cold Storage Code" id="cs_code" autocomplete="off"  readonly>

                      <datalist id="coldStorage_list">
                          
                        <option value=""> --SELECT-- </option>
                        @foreach($ColdStorageList as $key)

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

                      <input type="text" class="form-control" name="cs_name" value="{{$classData->CS_NAME}}" placeholder="Enter Cold Storage Name" id="cs_name" readonly autocomplete="off">

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

                        <input list="chamber_list" class="form-control" name="chamber_code" value="{{$classData->CHAMBER_CODE}}" placeholder="Eneter Chamber Code" id="chamber_code" autocomplete="off" readonly>

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

                        <input  class="form-control" id="chamber_name" name="chamber_name" placeholder="Enter Chamber Name" value="{{ $classData->CHAMBER_NAME }}" readonly autocomplete="off">

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

                        <input  class="form-control" id="floor_code" name="floor_code" placeholder="Enter Floor Code" value="{{ $classData->FLOOR_CODE }}" readonly autocomplete="off">

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

                        <input  class="form-control" id="floor_name" name="floor_name" placeholder="Enter Floor Name" value="{{ $classData->FLOOR_NAME }}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('floor_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Storage Capacity: </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                        </div>

                        <input  class="form-control" id="storage_capacity" name="storage_capacity" placeholder="Enter Storage Capacity" value="{{ $classData->STORAGE_CAPACITY }}" autocomplete="off" readonly>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('storage_capacity', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>
                
              </div>

              <div style="text-align: center;">
                <input type="hidden" name="compcode" id="comp_id" value="{{$classData->COMP_CODE}}">
                <input type="hidden" name="cscode" id="cs_id" value="{{$classData->CS_CODE}}">
                <input type="hidden" name="chamberCode" id="chamber_id" value="{{$classData->CHAMBER_CODE}}">
                <input type="hidden" name="floorstorage_id" id="floor_id" value="{{$classData->FLOOR_CODE}}">
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