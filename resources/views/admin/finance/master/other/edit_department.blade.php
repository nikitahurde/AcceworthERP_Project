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



            Master Department



            <small>Update Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/Master/other/Edit-Department') }}">Master Department</a></li>



            <li class="active"><a href="{{ url('/Master/other/Edit-Department') }}">Update Department</a></li>



          </ol>



        </section>



	<section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-8">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Department </h2>

          
            <div class="box-tools pull-right showinmobile">


            <a href="{{ url('/Master/other/View-Department-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Department</a>


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



            <form action="{{ url('/Master/other/Department-Update') }}" method="POST" >



               @csrf



               <div class="row">


                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Department Code: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                          <input type="text" class="form-control" name="department_code" value="{{ $dept_list->DEPT_CODE }}" placeholder="Enter Department Code" maxlength="20" readonly="">



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('department_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>


                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Department Name : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>



                          <input type="text" class="form-control" name="department_name" value="{{ $dept_list->DEPT_NAME }}" placeholder="Enter Department Name" maxlength="40">



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('department_name', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>


                    <!-- /.form-group -->


                  </div>


                  <div class="col-md-6">

                    <div class="form-group">



                      <label>



                        Department Block : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="department_block" value="1" <?php if($dept_list->DEPT_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="department_block" value="0" <?php if($dept_list->DEPT_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>

                      <small id="emailHelp" class="form-text text-muted">


                        {!! $errors->first('department_block', '<p class="help-block" style="color:red;">:message</p>') !!}


                      </small>


                    </div>


                    <!-- /.form-group -->



                  </div>

                <!-- /.col -->


              </div>


              <div style="text-align: center;">

                <input type="hidden" name="deptId" value="{{ $dept_list->DEPT_CODE }}">

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


          <a href="{{ url('/Master/other/View-Department-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Department</a>


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