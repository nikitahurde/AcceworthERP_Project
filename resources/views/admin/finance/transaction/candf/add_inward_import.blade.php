@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .box-header>.box-tools {
    position: absolute !important;
    right: 10px !important;
    top: 2px !important;
  }
  .required-field::before {
    content: "*";
    color: red;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Import Inward
      <small>: Import Inward Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transation </a></li>
      <li class="active"><a href="{{ url('/form-inward-trans') }}">Inward Trans</a></li>
      <li class="active"><a href="{{ url('/form-inward-trans') }}">Import Inward </a></li>

    </ol>

  </section>


<form id="inwardImportTran">
    @csrf

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle formTitle" style="font-weight: 800;color: #5696bb;">Import Inward</h2>

        <div class="box-tools pull-right">

          <a href="{{ url('transaction/c-and-f/view-inward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View Inward</a>

        </div>

      </div><!-- /.box-header -->

      <div class="box-body">

          <div class="row">

            <div class="col-md-4"></div>

            <div class="col-md-2">

              <div class="form-group">

                <label>Rake No: <span class="required-field"></span></label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                  <input list="rakeNoList" class="form-control" name="rake_no" value="" placeholder="Enter Rake No" maxlength="15" id="rake_no" autocomplete="off">

                  <datalist id="rakeNoList">

                    <option value=""> -- Select -- </option>
                    
                     @foreach ($rakeNo_list as $key)

                    <option value='<?php echo $key?>'   data-xyz ="<?php echo $key; ?>"><?php echo $key ;?></option>

                    @endforeach

                  </datalist>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2" style="margin-top: 10px;">

              <button class="btn btn-success" type="button" id="submitdata" onclick="submitImportInward()">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp; Import Rake &nbsp;&nbsp;</button>
              
            </div><!-- /.col -->

            <div class="col-md-4"></div>

          </div><!-- /.row -->

      </div><!-- /.box-body -->

    </div><!-- /. custom box -->

  </section><!-- /.section -->

</form>

</div><!-- /.content-wrapper -->


@include('admin.include.footer')


<script type="text/javascript">

/* --------------- START : SUBMIT DATA ------------ */

  function submitImportInward(){

    var data = $("#inwardImportTran").serialize();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/transaction/CandF/save-inward-import-tran') }}",

          data: data, // here $(this) refers to the ajax object not form
          success: function (data) {
              
            var data1 = JSON.parse(data);
            if(data1.response == 'error') {

              var responseVar = false;
              var url = "{{url('candf/inward-tran/save-msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

            }else{

              var responseVar = true;
              var url = "{{url('candf/inward-tran/save-msg')}}";
              setTimeout(function(){ window.location = url+'/'+responseVar; });
              
            }/* /. condition*/

          },/* /. success function*/

      }); /* /. ajax*/

  }/* /. main function */

/* --------------- END : SUBMIT DATA ------------ */

</script>

@endsection