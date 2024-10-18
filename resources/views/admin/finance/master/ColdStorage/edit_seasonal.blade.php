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

    <h1>Seasonal Master<small>Update Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Master</a></li>

      <li class="Active"><a href="{{ URL('/Master/ColdStorage/Add-Seasonal-Mast')}}">Seasonal Master</a></li>

      <li class="Active"><a href="{{ URL('/Master/ColdStorage/Add-Seasonal-Mast')}}">Add Seasonal Master</a></li>
         
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-md-12">

        <div class="box box-primary Custom-Box" >

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Seasonal Master</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/Master/ColdStorage/View-Seasonal-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Seasonal Master</a>

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

            <form action="{{ url('Master/ColdStorage/Seasonal-Update') }}" method="POST" >

              @csrf

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Seasonal Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input type="text" class="form-control" name="seasonal_code" id="seasonal_code" value="{{ $classData->SEASONAL_CODE }}" placeholder="Enter Seasonal Code" id="seasonal_code" autocomplete="off" readonly>

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

                      <input type="text" class="form-control" name="seasonal_name" value="{{ $classData->SEASONAL_NAME }}" placeholder="Enter Seasonal Name" id="seasonal_name" autocomplete="off">

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

                        <input list="itemList" class="form-control" name="item_code" value="{{ $classData->ITEM_CODE }}" placeholder="Eneter Item Code" id="item_code" autocomplete="off">

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

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control" name="item_name" value="{{ $classData->ITEM_NAME }}" placeholder="Eneter Item Name" id="item_name" autocomplete="off" readonly>

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

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>
                        <?php $fromDate = date("d-m-Y", strtotime($classData->FROM_DATE)); ?>
                        <input type="text" class="form-control datepicker" id="from_date" name="from_date" placeholder="Enter From Date" value="{{ $fromDate }}" autocomplete="off">

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

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>
                        <?php $middleDate = date("d-m-Y", strtotime($classData->MIDDLE_DATE)); ?>
                        <input type="text" class="form-control" id="middle_date" name="middle_date" placeholder="Enter Middle Date" value="{{ $middleDate }}" autocomplete="off">

                        <datalist id="floor_list">
                          
                          <option value=""> --SELECT-- </option>
                        

                        </datalist>

                      </div>
                      <small id="middleDateMsg" style="color:red;"></small>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('floor_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>End Date: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>
                        <?php $toDate = date("d-m-Y", strtotime($classData->END_DATE)); ?>
                        <input type="text" class="form-control" id="dateto" name="dateto" placeholder="Enter End Date" value="{{$toDate}}" autocomplete="off">

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

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input type="text" class="form-control numberRight" id="ratePerBag" name="ratePerBag" placeholder="Enter Rate Per Bag" value="{{$classData->RATE_PER_BAG}}" autocomplete="off">

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

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input  class="form-control numberRight" id="minQtyOne" name="minQtyOne" placeholder="Enter Min Qty 1" value="{{$classData->MINQTY_ONE}}" autocomplete="off">

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

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input class="form-control numberRight" id="minRateOne" name="minRateOne" placeholder="Enter Min Rate 1" value="{{$classData->MINRATE_ONE}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('minRateOne', '<p class="help-block" style="color:red;line-height:1">:message</p>') !!}
                      </small>

                  </div>

                </div>

              </div>

              <div class="row">
                
                <div class="col-md-2">

                  <div class="form-group">

                    <label>Min Qty 2: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input class="form-control numberRight" id="minQtyTwo" name="minQtyTwo" placeholder="Enter Min Qty 2" value="{{$classData->MINQTY_TWO}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('minQtyTwo', '<p class="help-block" style="color:red;line-height:1">:message</p>') !!}
                      </small>

                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Min Rate 2: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input  class="form-control numberRight" id="minRateTwo" name="minRateTwo" placeholder="Enter Min Rate 2" value="{{$classData->MINRATE_TWO}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('minRateTwo', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                  </div>

                </div>

                 <div class="col-md-5">

                  <div class="form-group">

                    <label>Seasonal Block : <span class="required-field"></span></label>

                      <div class="input-group">

                        <input type="radio" class="optionsRadios1" name="seasonal_block" value="YES" <?php if($classData->BLOCK_SEASONAL=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <input type="radio" class="optionsRadios1" name="seasonal_block" value="NO" <?php if($classData->BLOCK_SEASONAL=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('bean_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div>
                
              </div>

              <div style="text-align: center;">
                <input type="hidden" name="seasonalId" value="{{$classData->SEASONAL_CODE}}">
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