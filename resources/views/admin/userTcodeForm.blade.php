@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

<?php if(Session::get('usertype')=='CRM'){ ?>

  @include('admin.include.crmnavbar')

  @include('admin.include.crmsidebar')

<?php }  else { ?>

  @include('admin.include.navbar')

  @include('admin.include.sidebar')

<?php } ?>


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
    border-radius: 10px;*/    
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  .rdate{
    text-align:right;
  }
  ::placeholder {
    text-align:left;
  }
  .showinmobile{
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

}

</style>


<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            User TCode Form

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/Dashboard/user/tcode/form') }}">Master UserTcode</a></li>

            <li class="active"><a href="{{ url('/Dashboard/user/tcode/form') }}">Add Mast UserTcode</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add UserTcode</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/dashboard') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View </a>

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

            <form action="{{ url('save-user-tcode-data') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        User Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input type="text" class="form-control" name="user_code" id="user_code" value="{{ Session::get('userid') }}" placeholder="Enter User Code" maxlength="13" readonly oninput="this.value = this.value.toUpperCase()">
                           
                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('user_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Form Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="codeFormList" type="text" id="formCode" class="form-control" name="form_code"  value="" placeholder="Enter Form Code" />

                          <datalist id="codeFormList">

                            <option  value="">-- Select --</option>

                            @foreach($userFormData as $key)

                            <option value='<?php echo $key->FORM_CODE?>'   data-xyz ="<?php echo $key->FORM_NAME; ?>" ><?php echo $key->FORM_NAME ; echo " [".$key->FORM_CODE."]" ; ?></option>

                            @endforeach

                          </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('form_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

                <!-- /.col -->

                

              </div>

              <!-- /.row -->



              <div class="row">


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Form Name: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>


                          <input type="text"  id="form_name" name="form_name" class="form-control  pull-left" value="{{ old('form_name') }}" placeholder="Enter Form Name" maxlength="30" readonly> 

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('form_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                       <small>
                          <div class="pull-left showSeletedName" id="makeText"></div>
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

      <!-- <div class="col-sm-2 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/view-mast-fleet') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fleet</a>

        </div>

      </div> -->



    </div>

     

  </section>

</div>



@include('admin.include.footer')



<script type="text/javascript">

  $(document).ready(function(){

    $("#formCode").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#codeFormList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      console.log('msg',msg);
      if(msg=='No Match'){

         $(this).val('');
         $('#form_name').val('');

      }else{
        $('#form_name').val(msg);
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