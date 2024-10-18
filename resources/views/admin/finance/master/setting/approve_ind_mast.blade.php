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
    left:80.4922px!important;
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
    <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>Master Approve Index

        <?php if($button=='Save') { ?>

        <small>Add Details</small>

        <?php } else { ?>

          <small>Update Details</small>

        <?php } ?>

    </h1>

    <ol class="breadcrumb">

        <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ URL('/dashboard')}}">Master</a></li>

        <?php if($button=='Save') { ?>

            <li class="Active"><a href="{{ URL('/finance/bank-mast')}}">Master Approve Index</a></li>

            <li class="Active"><a href="{{ URL('/finance/bank-mast')}}">Add Approve Index</a></li>

        <?php } else { ?>

             <li class="Active"><a href="{{ URL('/finance/bank-mast/'.base64_encode($approve_id))}}">Master Approve Index</a></li>

             <li class="Active"><a href="{{ URL('/finance/bank-mast/'.base64_encode($approve_id))}}">Update Approve Index</a></li>

        <?php } ?>

    </ol>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-2"></div>

          <div class="col-sm-7">

            <div class="box box-primary Custom-Box">

              <div class="box-header with-border" style="text-align: center;">

              <?php if($button=='Save') { ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add  Approve Index</h2>

               <div class="box-tools pull-right showinmobile">

                  <a href="{{ url('/finance/view-bank-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Approve Index</a>

               </div>

              <?php } else{  ?>

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update  Approve Index</h2>

              <div class="box-tools pull-right showinmobile">

                  <a href="{{ url('/finance/view-bank-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Approve Index</a>

               </div>

              <?php } ?>

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

            <form action="{{ url($action) }}" method="POST" >

               @csrf

               <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>Approve Code : 
                        <span class="required-field"></span>
                      </label>
                        
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control codeCapital" name="approve_code" value="{{ $approve_code }}" placeholder="Enter Approve Code" maxlength="10" id="bankCodeSearch" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('approve_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>Approve Name : <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="approve_name" value="{{$approve_name}}" placeholder="Enter Approve Name" maxlength="40" onautocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('approve_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>
                    </div>
                    <!-- /.form-group -->

                  </div>

                </div>
              <!-- /.row -->

              <div style="text-align: center;">


                  <input type="hidden" name="idapprov" value="{{$approve_id}}">
                 <button type="Submit" class="btn btn-primary">

                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

        </div>

      </div>

      <div class="col-sm-3 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/Master/Setting/View-Approved-Ind-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Approve Index</a>

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