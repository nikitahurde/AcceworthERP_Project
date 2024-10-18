@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .numriRight{
    text-align: right !important;
  }
  
  .Custom-Box {
    /*border: 1px solid #e0dcdc;
    border-radius: 10px;*/ 
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }
  .text-center{
    text-align: center;
  }
  .title{
      margin-top: 50px;
      margin-bottom: 20px;
  }
  table {
      border-collapse: collapse;
  }
  .table-responsive {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
  }
  .table {
      width: 100%;
      margin-bottom: 1rem;
      color: #212529;
  }
  .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #dee2e6;
  }
  .table td, .table th {
    padding: .75rem;
    vertical-align: top;
  }
  .tdthtablebordr{
    border: 1px solid #00BB64;
  }
  input:focus{border:1px solid yellow;} 
  .space{margin-bottom: 2px;}
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
  }
  .inputfield{
    width:100%;
    margin-bottom:5px;
  }
  .namefield{
    text-align:left;
  }
  .showSeletedName {
    font-size: 12px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
    line-height: 1;
  }
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>
       Master Cheque Leaf Config  
      <small>Update Details</small>
    </h1>

    <ul class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Master</a></li>

      <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}"> Master Cheque Leaf Config </a></li>

      <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}">Update Cheque Leaf Config </a></li>

    </ul>

  </section> <!-- /. section-->

  <form action="{{ url('configration/Setting/update-cheque-leaf-config') }}" method="POST" enctype="multipart/form-data">

    @csrf
    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Update Cheque Leaf Config </h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/configration/Setting/view-cheque-leaf-config') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Cheque Leaf Config  </a>

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

              <div class="row" style="margin-bottom: 10px;">
                
                <div class="col-md-3">
                  
                </div>

                <div class="col-md-2">
                  
                  <div class="form-group">

                    <label>Series : 
                      <span class="required-field"></span>
                    </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>


                      <input list="seriesList"  id="series_code" name="series" class="form-control  pull-left serieswidth" value="{{$leafNo_data[0]->SERIES_CODE}}" placeholder="Select Series"  oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

                    </div>
                    <input type="hidden" id="series_name" name="series_name">
                    <div id="seriesName" class="showSeletedName"></div>
                 
                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>

                      GL Code : 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="text" class="form-control" name="gl_code" id="glCode" value="{{$leafNo_data[0]->GL_CODE}}" placeholder="Enter GL code" maxlength="6" readonly>

                    </div>
                    <div class="pull-left showSeletedName" id="glName"></div>
                    <input type="hidden" id="gl_name" name="gl_name">
                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                  <!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">
                  
                  <div class="form-group">

                    <label>

                      Leaf No : 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="text" class="form-control" name="chqLeafNo" id="chqLeafNo" value="{{$leafNo_data[0]->CHQLEAF_NO}}" placeholder="Enter Leaf No" maxlength="6" readonly>

                    </div>
                    
                  </div>

                </div>

                <div class="col-md-3">
                  
                </div>

              </div>

              <div class="row">

                <div class="col-md-4"></div>

                <div class="col-md-4">
                  <div class="table-responsive">
                    
                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                      <tr>
                        <th>Field</th>
                        <th>Row</th>
                        <th>Column</th>
                      </tr>

                      <?php $srNo=1; foreach($leafNo_data as $rows){ ?>

                        <tr>
                            
                          <td>
                            <div class="namefield"><?php echo $rows->FIELD; ?></div>
                            <input type="hidden" class="inputfield" name="fieldName[]" value="{{$rows->FIELD}}">
                            <input type="hidden" id="slno1" name="srno[]" value="{{$srNo}}">
                          </td>

                          <td>
                            <input type="text" class="inputfield Number" id="rwDate1" name="rwData[]" value="{{$rows->LEAFROW}}" style="text-align:right;">
                          </td>
                          <td>
                              <input type="text" class="inputfield Number" id="colDate1" name="ColData[]" value="{{$rows->LEAFCOLUMN}}" style="text-align:right;">
                          </td>

                        </tr>

                      <?php $srNo++;} ?>

                    </table><!-- /. table-->
                    
                  </div><!-- /. table-responsive-->
                </div>
                <div class="col-md-4"></div>
              </div><!-- /. row-->

              <div class="row" style="text-align:center;"> 
                  
                  <button class="btn btn-success" type="submit" id="submitdata"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                  <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>
              </div><!-- /. row-->

            </div><!-- /. box-body-->
            
          </div><!-- /. custom box-->
          
        </div><!-- /. col-->
        
      </div> <!-- /. row-->
    </section> <!-- /. section-->
  </form><!-- /. form-->
</div> <!-- /. content-wrapper-->


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

  $("#series_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#seriesList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $('#glCode,#series_name,#gl_name').val('');
          $('#glName,#seriesName').html('');
        }else{
          $('#series_name').val(msg);
          $('#seriesName').html(msg);
        }

        var seriesCode = $('#series_code').val();
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
                        $('#gl_name').val(data1.data[0].GL_NAME);
                        $('#glName').html(data1.data[0].GL_NAME);
                      }

                  }

              }

        });

    });

  });

</script>


@endsection
