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

    /*border: 1px solid #e0dcdc;

    border-radius: 10px;

*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }
  .showinmobile{
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

}

</style>



<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Master Unit Type

      <small>Add Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Master</a></li>

      <li class="active"><a href="{{ url('/Master/Customer-Vendor/Mast-Acc-Type') }}">Infrastructure</a></li>

      <li class="active"><a href="{{ url('/Master/Infrastructure/Add-Unit-Type') }}">Add Master Unit Type</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Unit Type </h2>

            <div class="box-tools pull-right showinmobile">

              <a href="{{ url('/Master/Infrastructure/View-unit-type') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Acc Type</a>

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

            <form action="{{ url('Master/Infrastructure/Add-Unit-Save') }}" method="POST" >

             @csrf

             <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label>

                    Unit Type Code : 

                    <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                    <input type="text" class="form-control codeCapital" name="unit_type_code" id="acc_type_code" value="{{ old('unit_type_code')}}" placeholder="Enter Unit Type Code" maxlength="6" autocomplete="off">
                    
                  </div>
                  
                  <small>  

                    {!! $errors->first('unit_type_code','<p class="help-block" style="color: red">:message</p>' ) !!}

                  </small>


                </div>

              </div>

              <!-- /.form-group -->

              

              <div class="col-md-4">

                <div class="form-group">

                  <label>

                    Unit Type Name : 

                    <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                    <input type="text" class="form-control" name="unit_type_name" value="{{ old('unit_type_name')}}" placeholder="Enter Unit Type Name" maxlength="40" autocomplete="off">

                  </div>

                  <small>  

                    {!! $errors->first('unit_type_name','<p class="help-block" style="color: red">:message</p>' ) !!}

                  </small>
                </div>

              </div>
              <!-- /.form-group -->



              <div class="col-md-4">

                <div class="form-group">

                  <label>

                    Unit Type Description : 

                    <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                    <input type="text" class="form-control" name="unit_type_desc" value="{{ old('unit_type_desc')}}" placeholder="Enter Unit Type Description" maxlength="40" autocomplete="off">

                  </div>

                  <small>  

                    {!! $errors->first('unit_type_desc','<p class="help-block" style="color: red">:message</p>' ) !!}

                  </small>

                </div>
                <!-- /.form-group -->

                
              </div>

              <!-- /.col -->

            </div>

            

            <!-- /.row -->

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

      <a href="{{ url('/Master/Infrastructure/View-unit-type') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Unit Type</a>

    </div>

  </div>

</div>

</section>

</div>


@include('admin.include.footer')
<script type="text/javascript">
  $(document).ready(function(){
   $('body').on('click', '#closeModel', function () {
    $('.popover').fadeOut();
  })
 });
</script>

<!-- <script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
  </script> -->

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