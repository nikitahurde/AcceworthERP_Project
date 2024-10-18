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
  ::placeholder {
    text-align:left;
  }
  .numberRight{
    text-align:end;
  }

</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>Master Seasonal <small>Add Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Master</a></li>

      <li class="Active"><a href="{{ URL('/Master/ColdStorage/Add-Seasonal-Mast')}}">Master Seasonal </a></li>

      <li class="Active"><a href="{{ URL('/Master/ColdStorage/Add-Seasonal-Mast')}}">Add Seasonal </a></li>
         
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-md-12">

        <div class="box box-primary Custom-Box" >

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Seasonal </h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/Master/ColdStorage/View-Seasonal-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Seasonal </a>

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

            <form action="{{ url('Master/ColdStorage/Seasonal-Save') }}" method="POST" >

              @csrf

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Seasonal Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="text" class="form-control" name="seasonal_code" id="seasonal_code" value="{{ old('seasonal_code')}}" placeholder="Seasonal Code" id="seasonal_code" autocomplete="off">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('seasonal_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Seasonal Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input type="text" class="form-control" name="seasonal_name" value="{{old('seasonal_name')}}" placeholder="Seasonal Name" id="seasonal_name" autocomplete="off">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('seasonal_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                </div>
                  
                <div class="col-md-2">

                  <div class="form-group">

                    <label>Item Code : <span class="required-field"></span></label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input list="itemList" class="form-control" name="item_code" value="{{old('item_code')}}" placeholder="Item Code" id="item_code" autocomplete="off">

                        <datalist id="itemList">
                          
                        <option value=""> --SELECT-- </option>
                        @foreach($itemList as $key)

                          <option value='<?php echo $key->ITEM_CODE; ?>'   data-xyz ="<?php echo $key->ITEM_NAME; ?>"><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>

                </div>

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Item Name : <span class="required-field"></span></label>

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                        <input type="text" class="form-control" name="item_name" value="{{old('item_name')}}" placeholder="Item Name" id="item_name" readonly autocomplete="off">

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('item_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>

                </div>
              
                <div class="col-md-2">

                  <div class="form-group">

                    <label>From Date: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control datepicker" id="from_date" name="from_date" placeholder="From Date" value="{{old('from_date')}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Middle Date: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" id="middle_date" name="middle_date" placeholder="Middle Date" value="{{old('middle_date')}}" autocomplete="off">

                        <datalist id="floor_list">
                          
                          <option value=""> --SELECT-- </option>
                        

                        </datalist>

                      </div>
                      
                      <small id="middleDateMsg" style="color:red;"></small>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('middle_date', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>End Date: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control" id="dateto" name="dateto" placeholder="End Date" value="{{old('dateto')}}" autocomplete="off">

                      </div>
                      <small id="toDateMsg" style="color:red;"></small>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('dateto', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Rate Per Bag: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-money" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control numberRight Number" id="ratePerBag" name="ratePerBag" placeholder="Rate Per Bag" value="{{old('ratePerBag')}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('ratePerBag', '<p class="help-block" style="color:red;line-height:1">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Min Qty 1: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control numberRight Number" id="minQtyOne" name="minQtyOne" placeholder=" Min Qty 1" value="{{old('minQtyOne')}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('minQtyOne', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Min Rate 1: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control numberRight Number" id="minRateOne" name="minRateOne" placeholder="Min Rate 1" value="{{old('minRateOne')}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('minRateOne', '<p class="help-block" style="color:red;line-height:1">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Min Qty 2: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control numberRight Number" id="minQtyTwo" name="minQtyTwo" placeholder=" Min Qty 2" value="{{old('minQtyTwo')}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('minQtyTwo', '<p class="help-block" style="color:red;line-height:1">:message</p>') !!}
                      </small>

                  </div>

                </div>

              </div>

              <div class="row">
                
                

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Min Rate 2: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control numberRight Number" id="minRateTwo" name="minRateTwo" placeholder="Min Rate 2" value="{{old('minRateTwo')}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('minRateTwo', '<p class="help-block" style="color:red;">:message</p>') !!}
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

    $('.datepicker').datepicker({

            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            todayHighlight: 'true',
            autoclose: 'true'
    });

    $("#item_code").bind('change', function () {

      var item_code =  $(this).val();
      var xyz = $('#itemList option').filter(function() {

        return this.value == item_code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $(this).val('');
         $('#item_name').val('');
      }else{
        $('#item_name').val(msg);
      }
    });


    $("#middle_date").click(function() {

        $("#middle_date").datepicker("destroy");

        var fromDate = $('#from_date').val();
        var splitFrom    = fromDate.split("-");

        var mergeFrDate = splitFrom[1]+'-'+splitFrom[0]+'-'+splitFrom[2];
        var getmergeFr = new Date(mergeFrDate);

        getmergeFr.setDate(getmergeFr.getDate() + 1); 

        var getdate = getmergeFr.getDate();
        var getMonth=getmergeFr.getMonth()+1;
        var getYear = getmergeFr.getFullYear();
        var netDate =getYear+'-'+getMonth+'-'+getdate;

        var dt = new Date(netDate);
        var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(dt);
        var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(dt);

        var middleDateStart =da+'-'+mo+'-'+getYear;

        $('#middle_date').datepicker({
          format: 'dd-mm-yyyy',
          orientation: 'bottom',
          todayHighlight: 'true',
          startDate: middleDateStart,
          autoclose: 'true'
        });
         $('#middle_date').datepicker('show');

        
    });

    $("#dateto").click(function() {

        $("#dateto").datepicker("destroy");

        var middlDate = $('#middle_date').val();
        var splitMiddl    = middlDate.split("-");

        var mergeFrDate = splitMiddl[1]+'-'+splitMiddl[0]+'-'+splitMiddl[2];
        var getmergeFr = new Date(mergeFrDate);

        getmergeFr.setDate(getmergeFr.getDate() + 1); 

        var getdate = getmergeFr.getDate();
        var getMonth=getmergeFr.getMonth()+1;
        var getYear = getmergeFr.getFullYear();
        var netDate =getYear+'-'+getMonth+'-'+getdate;

        var dt = new Date(netDate);
        var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(dt);
        var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(dt);

        var EndDateStart =da+'-'+mo+'-'+getYear;
        
        $('#dateto').datepicker({
          format: 'dd-mm-yyyy',
          orientation: 'bottom',
          todayHighlight: 'true',
          startDate: EndDateStart,
          autoclose: 'true'
        });
         $('#dateto').datepicker('show');
        
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