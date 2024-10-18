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

    <h1>Master Bean <small>Add Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Master</a></li>

      <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Master Bean </a></li>

      <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Add Bean </a></li>
         
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-md-12">

        <div class="box box-primary Custom-Box" >

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Bean </h2>

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

            <form action="{{ url('Master/ColdStorage/Bing-storage-Save') }}" method="POST" >

              @csrf

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Cold Storage Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="hidden" name="comp_code" id="comp_code" value="">
                      <input type="hidden" name="comp_name" id="comp_name" value="">

                      <input list="coldStorage_list" class="form-control" name="cs_code" id="cs_code" value="{{ old('cs_code')}}" placeholder="Cold Storage Code" id="cs_code" autocomplete="off">

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

                      <input type="text" class="form-control" name="cs_name" value="{{old('cs_name')}}" placeholder="Enter Cold Storage Name" id="cs_name" readonly autocomplete="off">

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

                        <input list="chamber_list" class="form-control" name="chamber_code" value="{{old('chamber_code')}}" placeholder="Chamber Code" id="chamber_code" autocomplete="off">

                        <datalist id="chamber_list">
                          
                        <option value=""> --SELECT-- </option>
                       
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

                        <input  class="form-control" id="chamber_name" name="chamber_name" placeholder="Chamber Name" value="{{old('chamber_name')}}" readonly autocomplete="off">

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

                        <input list="floor_list" class="form-control" id="floor_code" name="floor_code" placeholder="Floor Code" value="{{old('floor_code')}}" autocomplete="off">

                        <datalist id="floor_list">
                          
                          <option value=""> --SELECT-- </option>
                        

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

                        <input  class="form-control" id="floor_name" name="floor_name" placeholder="Floor Name" value="{{old('floor_name')}}" autocomplete="off">

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

                        <input list="block_list" class="form-control" id="block_code" name="block_code" placeholder="Block Code" value="{{old('block_code')}}" autocomplete="off">

                        <datalist id="block_list">
                          
                          <option value=""> --SELECT-- </option>
                          

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

                        <input  class="form-control" id="block_name" name="block_name" placeholder="Block Name" value="{{old('block_name')}}" autocomplete="off">

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

                        <input class="form-control" id="bean_code" name="bean_code" placeholder="Bean Code" value="{{old('bean_code')}}" autocomplete="off">

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

                        <input class="form-control" id="bean_name" name="bean_name" placeholder=" Bean Name" value="{{old('bean_name')}}" autocomplete="off">

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

                        <input  class="form-control" id="storage_capacity" name="storage_capacity" placeholder="Storage Capacity" value="{{old('storage_capacity')}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('storage_capacity', '<p class="help-block" style="color:red;">:message</p>') !!}
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

  $("#cs_code").bind('change', function () {

      var cs_code =  $(this).val();
      var xyz = $('#coldStorage_list option').filter(function() {

        return this.value == cs_code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $(this).val('');
         $('#cs_name').val('');

         $('#chamber_list,#floor_list,#block_list').empty();
        $('#comp_name,#comp_code,#chamber_code,#chamber_name,#floor_code,#floor_name,#block_code,#block_name').val('');
      }else{
        $('#cs_name').val(msg);
        $('#chamber_list,#floor_list,#block_list').empty();
        $('#comp_name,#comp_code,#chamber_code,#chamber_name,#floor_code,#floor_name,#block_code,#block_name').val('');

        var csCD = $('#cs_code').val();
        var master = 'COLDSTORAGE';
        getStorage(csCD,'','',master);

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

         $('#floor_list,#block_list').empty();
        $('#floor_code,#floor_name,#block_code,#block_name').val('');
      }else{
        $('#floor_list,#block_list').empty();
        $('#floor_code,#floor_name,#block_code,#block_name').val('');

        $('#chamber_name').val(msg);

        var csCD = $('#cs_code').val();
        var chamberCD = $('#chamber_code').val();
        var master = 'CHAMBERSTORAGE';
        getStorage(csCD,chamberCD,'',master);

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

         $('#block_list').empty();
        $('#block_code,#block_name').val('');
      }else{
         $('#floor_name').val(msg);

        var csCD = $('#cs_code').val();
        var chamberCD = $('#chamber_code').val();
        var floorCD = $('#floor_code').val();
        var master = 'FLOORSTORAGE';

         getStorage(csCD,chamberCD,floorCD,master);
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

  function getStorage(field1,field2,field3,master){

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

          url:"{{ url('cold-storage/get-prev-storage-data') }}",
          method : "POST",
          type: "JSON",
          data: {field1: field1,field2:field2,field3:field3,master:master},
          success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {
                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
              }else if(data1.response == 'success'){

                if(data1.coldStorage_list==''){

                }else{
                  $('#comp_code').val(data1.coldStorage_list.COMP_CODE);
                  $('#comp_name').val(data1.coldStorage_list.COMP_NAME);
                }


                if(data1.chamber_list==''){

                }else{

                  $("#chamber_list").empty();

                  $.each(data1.chamber_list, function(k, getAum){

                    $("#chamber_list").append($('<option>',{

                      value:getAum.CHAMBER_CODE,

                      'data-xyz':getAum.CHAMBER_NAME,
                      text:getAum.CHAMBER_NAME

                    }));

                  });

                }

                if(data1.floor_list==''){

                }else{

                  $("#floor_list").empty();

                  $.each(data1.floor_list, function(k, getAum){

                    $("#floor_list").append($('<option>',{

                      value:getAum.FLOOR_CODE,

                      'data-xyz':getAum.FLOOR_NAME,
                      text:getAum.FLOOR_NAME

                    }));

                  });

                }

                if(data1.block_list==''){

                }else{

                  $("#block_list").empty();

                  $.each(data1.block_list, function(k, getAum){

                    $("#block_list").append($('<option>',{

                      value:getAum.BLOCK_CODE,

                      'data-xyz':getAum.BLOCK_NAME,
                      text:getAum.BLOCK_NAME

                    }));

                  });

                }

              }
          }
    });

  }
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