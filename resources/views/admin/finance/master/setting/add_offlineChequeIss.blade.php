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

            Master Offline Cheque Issue

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/configration/Setting/add-offline-ckeque-issue') }}"> Master Offline Cheque Issue</a></li>

            <li class="active"><a href="{{ url('/configration/Setting/add-offline-ckeque-issue') }}">Add Offline Cheque Issue</a></li>

          </ol>

        </section>

        <section class="content">

          <div class="row">

            <div class="col-sm-1"></div>

              <div class="col-sm-8">

                <div class="box box-primary Custom-Box">

                  <div class="box-header with-border" style="text-align: center;">

                    <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add  Offline Cheque Issue</h2>

                    <div class="box-tools pull-right showinmobile">

                      <a href="{{ url('/configration/Setting/view-offline-cheque-issue') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Offline Cheque Issue</a>

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

                    <form action="{{ url('configration/Setting/save-offline-cheque-issue') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                      <div class="row">

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                              Series Code: <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                              <input list="seriesList" class="form-control" name="series_code" value="{{ old('series_code')}}" id="SeriesCode" placeholder="Enter Series Code" maxlength="6" style="z-index: auto;" autocomplete="off">

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

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                              Post Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                              <input type="text" class="form-control" name="posting_code" id="postingCode" value="{{ old('posting_code')}}" placeholder="Enter Post code" maxlength="6" readonly autocomplete="off">

                            </div>
                            <div class="pull-left showSeletedName" id="postingName"></div>
                            <input type="hidden" id="posting_name" name="posting_name">
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('posting_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div><!-- /.col -->

                      </div><!-- /.row -->

                      <div class="row">

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>Cancel Cheque : <span class="required-field"></span></label>

                            <div class="input-group">

                              <input type="radio" class="optionsRadios1" name="cancle_chq" value="1" onclick="chqStatus()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                              <input type="radio" class="optionsRadios1" name="cancle_chq" value="0"  onclick="chqStatus()" checked="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                            </div>

                          </div>
                          <!-- /.form-group -->
                        </div>

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                              GL Code : 

                              <div style="display: contents" id="req_Gl"><span class="required-field"></span></div>

                            </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                              <input list="glList" class="form-control" name="gl_code" id="glCode" value="{{ old('gl_code')}}" placeholder="Enter GL code" maxlength="6" autocomplete="off" >

                              <datalist id="glList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($gl_list as $key)

                                <option value='<?php echo $key->GL_CODE?>' data-xyz ="<?php echo $key->GL_NAME; ?>" ><?php echo $key->GL_NAME ; echo " [".$key->GL_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div>
                            <div class="pull-left showSeletedName" id="glName"></div>
                            <div class="pull-left" id="reqGlMsg" style="color:red;font-size: 12px;line-height: 1;"></div>
                            <input type="hidden" id="acctTag">
                            <input type="hidden" id="gl_name" name="gl_name">
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div><!-- /.col -->

                      </div> <!-- /.row -->

                      <div class="row">

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>Account Code:</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                <input list="accList" class="form-control" name="acc_code" value="{{ old('acc_code')}}" id="acc_code" placeholder="Enter Account Code" maxlength="6">

                                <datalist id="accList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($party_list as $key)

                                <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                                @endforeach

                              </datalist>

                            </div> 
                            <div class="pull-left showSeletedName" id="accName"></div>
                            <input type="hidden" id="acc_name" name="acc_name">
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                              Cheque No: 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">
                              
                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                              <input list="chequeNoList" name="cheque_no" id="chequeNo" class="form-control" placeholder="Enter Cheque No" value="{{ old('cheque_no')}}" maxlength="6">

                              <datalist id="chequeNoList">

                                <option selected="selected" value="">-- Select --</option>

                              </datalist>

                            </div>
                            <input type="hidden" id="updatedataId" name="updatedataId">
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('cheque_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->
                          
                        </div>

                      </div>

                      <div class="row">

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>
                              Cheque Date<span class="required-field"></span>
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
                                <input type="text" class="form-control transdatepicker" name="chequeDate" value="{{$vrDate}}" placeholder="Enter Cheque Date">

                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('chequeDate', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->
                        </div> <!-- /.col -->

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                             Amount:

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                <input type="text" class="form-control" name="amount" value="{{ old('amount')}}" id="amount" placeholder="Enter amount" maxlength="6">

                            </div>
                            <div id="errorMsg" style="color:red;">
                              
                            </div>
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('amount', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->

                        </div> <!-- /.col -->
                   
                      </div>

                      <div class="row">
                        
                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                             Remark:

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="remark" value="{{ old('remark')}}" id="remark" placeholder="Enter Remark" maxlength="40" autocomplete="off">

                            </div>
                            <div id="errorMsg" style="color:red;">
                              
                            </div>
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('remark', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->

                        </div> <!-- /.col -->

                      </div>

                      <div style="text-align: center;">

                         <button type="Submit" class="btn btn-primary" id="submitBTN">

                        <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                         </button>

                      </div>

                    </form>

                  </div><!-- /.box-body -->

                </div>

              </div>

              <div class="col-sm-3 hideinmobile">

                <div class="box-tools pull-right">

                  <a href="{{ url('/configration/Setting/view-offline-cheque-issue') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Offline Cheque Issue</a>

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

    $('#glCode').bind('change', function () {

      var val = $('#glCode').val();

      var xyz = $('#glList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#glCode').val('');
        $('#gl_name').val('');
        $('#glName').html('');
      }else{
        $('#gl_name').val(msg);
        $('#glName').html(msg);
      }

      var glCode = $('#glCode').val();
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      $.ajax({
          type: 'POST',
          url: "{{ url('/get-gl-tag-from-gl-master') }}",
          data: {glCode: glCode},
          success: function (data) {
            var data1 = JSON.parse(data);
            if(data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              var accountTag    = data1.data_tag[0].ACCOUNT_TAG;

              /* --- check account tag YES if YES then account code req ----*/
                  
                  $('#acctTag').val(accountTag); 
                  if(accountTag == 'YES'){
                    var acCode = $('#acc_code').val();
                    if(acCode == ''){
                      $('#acc_code').css('border-color','red');
                      $('#submitBTN').prop('disabled',true);
                    }else{}
                    
                  }else{
                    $('#acc_code').css('border-color','#d7d3d3');
                    $('#submitBTN').prop('disabled',false);
                    $('#acc_code').val('');
                    $('#acc_name').val('');
                  }

                /* --- check account tag YES if YES then account code req ----*/

            }
          }
      });
    });

    $("#acc_code").bind('change', function () {

        var val = $('#acc_code').val();

        var xyz = $('#accList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
          $('#acc_code').val('');
          $('#accName').html('');
          $('#acc_name').val('');
        }else{
          $('#accName').html(msg);
          $('#acc_name').val(msg);
        }
        IfaccTagYes();
    });

    $("#chequeNo").bind('change', function () {

        var val = $(this).val();

        var xyz = $('#chequeNoList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';
        console.log('msg',msg);
        if(msg == 'No Match'){
          $('#chequeNo').val('');
          $('#updatedataId').val('');
        }else{
          $('#updatedataId').val(msg);
        }
        
    });

    
    $("#SeriesCode").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#seriesList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $('#seriesName,#series_Name,#postingCode,#posting_name,#acc_code,#accName,#acc_name,#accTag,#chequeNo,#updatedataId').val('');
          $('#postingName').html('');
          $('#chequeNoList').empty();
        }else{
          $('#series_Name').val(msg);
          $('#seriesName').html(msg);
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
                      
                    /* ---------- get gl deatils ------- */

                      if(data1.data == ''){

                      }else{
                        $('#postingCode').val(data1.data[0].GL_CODE);
                        $('#postingName').html(data1.data[0].GL_NAME);
                        $('#posting_name').val(data1.data[0].GL_NAME);
                      }
                    /* ---------- get gl deatils ------- */

                    /* ---------- get cheque no deatils ------- */

                      console.log('data1.chqNoList',data1.chqNoList);

                      if(data1.chqNoList == ''){

                      }else{

                        $.each(data1.chqNoList, function(k, getData){

                            var upId = getData.CHEQUENO+'~'+getData.CHQBHID+'~'+getData.CHQBBID+'~'+getData.SLNO;
                            $("#chequeNoList").append($('<option>',{

                              value:getData.CHEQUENO,

                              'data-xyz':upId


                            }));

                        });

                      }
                    /* ---------- get cheque no deatils ------- */

                  } /* /. success*/

              } /* /. success function */

        }); /* /. ajax function */

    }) /* /. main function */

  });

  function IfaccTagYes(){
    var accTag = $('#acctTag').val();
    console.log('accTag',accTag);

    if(accTag == 'YES'){

      var accCode = $('#acc_code').val();
      if(accCode == ''){
        $('#acc_code').css('border-color','#ff0000');
        $('#submitBTN').prop('disabled',true);
      }else{
        $('#acc_code').css('border-color','#d4d4d4');
        $('#submitBTN').prop('disabled',false);
      }

    }else{
     // $('#acc_code').val('');
      $('#acc_code').css('border-color','#d4d4d4');
      $('#submitBTN').prop('disabled',false);
    }
  }

  function chqStatus(){
    var isChqCancle =  $('input[name="cancle_chq"]:checked').val();
    if(isChqCancle == 'YES'){
      $('#req_Gl').css('display','none');
      $('#reqGlMsg').html('');
    }else{
      $('#req_Gl').css('display','contents');
      $('#reqGlMsg').html('Gl Field Is Required');
    }
  }
</script>
@endsection



