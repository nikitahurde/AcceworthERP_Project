@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



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

  .rightcontent{

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

            Master HSN

            <small>Update Details</small>

          </h1>

         <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/Master/Item-Tax/Edit-Hsn-Mast/'.base64_encode($hsn_list->HSN_CODE))}}">Master HSN </a></li>

            <li class="Active"><a href="{{ URL('/Master/Item-Tax/Edit-Hsn-Mast/'.base64_encode($hsn_list->HSN_CODE))}}">Update HSN </a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update HSN</h2>

              <div class="box-tools pull-right showinmobile">

              <a href="{{ url('/Master/Item-Tax/View-Hsn-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View HSN</a>

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

            <form action="{{ url('Master/Item-Tax/Hsn-Update') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        HSN Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="hidden" name="hsn_id" value="{{ $hsn_list->HSN_CODE }}">

                          <input type="text" class="form-control" name="hsn_code" value="{{ $hsn_list->HSN_CODE }}" placeholder="Enter HSN Code" maxlength="8" readonly="">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('hsn_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        HSN Name: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="hsn_name" value="{{ $hsn_list->HSN_NAME }}" placeholder="Enter HSN Name" maxlength="40">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('hsn_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

              </div>

              <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        HSN Discription: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <input type="text" class="form-control" name="hsn_discription" value="{{ $hsn_list->HSN_DISCRIPTION }}" placeholder="Enter HSN Discription" maxlength="50">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('hsn_discription', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        HSN Block : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="hsn_block" value="YES" <?php if($hsn_list->HSN_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="hsn_block" value="NO" <?php if($hsn_list->HSN_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('hsn_list', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                
              </div>
              <!-- /.row -->





              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-3">

        <div class="box-tools pull-right hideinmobile">

          <a href="{{ url('/Master/Item-Tax/View-Hsn-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View HSN</a>

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