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
  .rightcontent{
    text-align:right;
  }
  ::placeholder {
    text-align:left;
  }
  .setheightinput{
    height: 0%;
  }
  .nameheading{
    font-size: 12px;
  }
  .setetxtintd{
    font-size: 12px !important;
    padding-top: 2% !important;
    padding-bottom: 2% !important;
  }
  .beforhidetble{
    display: none;
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
  .CloseListDepot{
    display: none;
  }
  .popover{
    left: 64.4922px!important;
    width: 169%!important;
  }
  .showinmobile{
    display: none;
  }
  @media screen and (max-width: 600px) {

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
  .showSeletedName{
    font-size: 12px;
    margin-top: 1%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
</style>


<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Chequebook

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/configration/Setting/add-chequeBook') }}">Master Chequebook</a></li>

            <li class="active"><a href="{{ url('/configration/Setting/add-chequeBook') }}">Add  Chequebook</a></li>

          </ol>

        </section>

        <section class="content">

          <div class="row">

            <div class="col-sm-1"></div>

              <div class="col-sm-8">

                <div class="box box-primary Custom-Box">

                  <div class="box-header with-border" style="text-align: center;">

                    <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add  Chequebook</h2>

                    <div class="box-tools pull-right showinmobile">

                      <a href="{{ url('/configration/Setting/view-chequeBook') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Chequebook</a>

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

                    <form action="{{ url('configration/Setting/save-cheque-book-data') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                      <div class="row">

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                              Company Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input type="text" class="form-control codeCapital" name="company_code" value="{{$compCode}}" placeholder="Enter Company Code" id="companyCodeSearch" oninput="this.value = this.value.toUpperCase()" maxlength="6" readonly>

                            </div>
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>
                            <div class="pull-left showSeletedName"><?php echo $compName; ?></div>
                          </div>

                        </div>

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                              Series Code: <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                              <input list="seriesList" class="form-control" name="series_code" value="{{ old('series_code')}}" id="SeriesCode" placeholder="Enter Series Code" maxlength="6" style="z-index: auto;">

                              <datalist id="seriesList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($series_list as $key)

                                <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div> 
                            <input type="hidden" id="series_Name" name="seriesName">
                            <div class="pull-left showSeletedName"  id="seriesName"></div>
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->

                        </div>

                      </div><!-- /.row -->

                      <div class="row">

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                              GL Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                              <input type="text" class="form-control" name="gl_code" id="glCode" value="{{ old('gl_code')}}" placeholder="Enter GL code" maxlength="6" readonly>

                            </div>
                            <div class="pull-left showSeletedName" id="glName"></div>
                            <input type="hidden" id="gl_name" name="gl_name">
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div><!-- /.col -->

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>
                              Chequebook Date<span class="required-field"></span>
                            </label>
                            <?php 

                              $CurrentDate = date("d-m-Y");
                              $FromDate    = date("d-m-Y", strtotime($fromDate));  
                              $ToDate      = date("d-m-Y", strtotime($toDate));  
                              $spliDate    = explode('-', $CurrentDate);
                              $yearGet     = Session::get('macc_year');
                              $fyYear      = explode('-', $yearGet);
                              $get_Month   = $spliDate[1];
                              $get_year    = $spliDate[2];

                              if($get_Month >=3 && $get_year == $fyYear[1]){
                                  $vrDate = $ToDate;
                              }else{
                                  $vrDate = $CurrentDate;
                              }

                            ?>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
                                <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
                                <input type="text" class="form-control transdatepicker" name="chequeBDate" value="{{$vrDate}}" placeholder="Enter Chequebook Date">

                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('chequeBDate', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->
                        </div> <!-- /.col -->

                      </div> <!-- /.row -->

                      <div class="row">

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>From cheque No: <span class="required-field"></span></label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="from_cheque_no" value="{{ old('from_cheque_no')}}" id="fromChequeNo" placeholder="Enter From cheque No" maxlength="6">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('from_cheque_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>No of Leaf:</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-file-o"></i></span>

                                <input list="noofLeafList" class="form-control" name="no_of_leaf" value="{{ old('no_of_leaf')}}" id="no_of_leaf" placeholder="Enter No Of Leaf" maxlength="6">

                                <datalist id="noofLeafList">
                                  <option value=""></option>
                                  <option value="25">25</option>
                                  <option value="50">50</option>
                                </datalist>

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('no_of_lead', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>

                        <div class="col-md-4">

                          <div class="form-group">

                            <label>

                             To Cheque No:

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                <input type="text" class="form-control" name="to_cheque_no" value="{{ old('to_cheque_no')}}" id="tochequeNo" placeholder="Enter To Cheque No" maxlength="6">

                            </div>
                            <div id="errorMsg" style="color:red;">
                              
                            </div>
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('to_cheque_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->

                        </div> <!-- /.col -->

                      </div>

                      <div class="row">

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                              Last Cheque No: 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                              
                              <input type="text" name="last_cheque_no" class="form-control" placeholder="Enter Last Cheque No" value="{{ old('last_cheque_no')}}" maxlength="6">
                              
                              <small id="emailHelp" class="form-text text-muted">
                              
                              {!! $errors->first('last_cheque_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                              
                              </small>

                           </div>

                           

                          </div><!-- /.form-group -->
                          
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

              <div class="col-sm-3 hideinmobile">

                <div class="box-tools pull-right">

                  <a href="{{ url('/configration/Setting/view-chequeBook') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Chequebook</a>

                </div>

              </div>

          </div>

	     </section>

</div>



@include('admin.include.footer')

<script type="text/javascript">
   $(document).ready(function(){      
    $(".Number").keypress(function(event){
        var keycode = event.which;
        if (!(keycode >= 48 && keycode <= 57)) {
            event.preventDefault();
        }
    });
 });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    var fromdateintrans = $('#FromDateFy').val();
    var todateintrans = $('#ToDateFy').val();
    $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      startDate :fromdateintrans,
      endDate : todateintrans,
      autoclose: 'true'
    });

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

  $(document).ready(function() {
  $(".Number").on("keypress", function(evt) {
    var keycode = evt.charCode || evt.keyCode;
    if (keycode == 46 || this.value.length==10) {
      return false;
    }
  });

  });

</script>


<script type="text/javascript">
  $(document).ready(function(){
    
    $("#SeriesCode").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#seriesList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $('#seriesName').val('');
          $('#series_Name').val('');
          $('#glCode').val('');
          $('#gl_name').val('');
          $('#glName').html('');
        }else{
          $('#series_Name').val(msg);
          $('#seriesName').val(msg);
        }

        var seriesCode = $('#SeriesCode').val();
        var transcode = 'A0';

        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

              url:"{{ url('get-vr-sequence-by-series') }}",

              method : "POST",

              type: "JSON",

              data: {seriesCode: seriesCode,transcode:transcode},

              success:function(data){

                var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                  }else if(data1.response == 'success'){

                      if(data1.data == ''){

                      }else{
                        $('#glCode').val(data1.data[0].GL_CODE);
                        $('#glName').html(data1.data[0].GL_NAME);
                        $('#gl_name').val(data1.data[0].GL_NAME);
                      }

                  }

              }

        });

    })

    $('#tochequeNo').on('input',function(){
      var toChequeNo   = parseInt($('#tochequeNo').val());
      var fromChequeNo = parseInt($('#fromChequeNo').val());
      console.log('toChequeNo',toChequeNo);
      console.log('fromChequeNo',fromChequeNo);
      if(toChequeNo > fromChequeNo){
        $('#errorMsg').html('');
      }else{
        $('#errorMsg').html('To Cheque No. should be greater than From cheque No.');
      }
    });

    $('#no_of_leaf').on('input',function(){
      var noOfleaf = $('#no_of_leaf').val();
      var fromChqNo = $('#fromChequeNo').val();

      var lastChqNo = parseInt(fromChqNo) + parseInt(noOfleaf) - parseInt(1);
      $('#tochequeNo').val(lastChqNo);
      console.log('lastChqNo',lastChqNo);
    });

  });
</script>
@endsection



