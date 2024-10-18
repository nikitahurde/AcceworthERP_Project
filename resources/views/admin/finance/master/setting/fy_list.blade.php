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

            Master FY

            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/edit-fy/'.base64_encode($fy_list->FY_CODE)) }}">Master FY</a></li>

            <li class="active"><a href="{{ url('/edit-fy/'.base64_encode($fy_list->FY_CODE)) }}">Update FY</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update  FY</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Master/Setting/View-Fy-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View FY</a>

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

            <form action="{{ url('form-mast-fy-update') }}" method="POST" >

               @csrf

               <div class="row">


                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Company Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="hidden" name="UserID" value="{{ $fy_list->FY_CODE }}">

                           <input type="text" name="company_code"  id="company_code" class="form-control" value="{{ $fy_list->COMP_CODE }}" placeholder="Enter Company Code" maxlength="6" readonly>
                        </div>

                        <div class="pull-left showSeletedName" id="companyText">{{ $fy_list->COMP_NAME }}</div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        FY Code: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="fy_code" value="{{ $fy_list->FY_CODE }}" placeholder="Enter Fy Code" maxlength="9" readonly>
                         

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fy_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

              </div>

              <!-- /.row -->



              <div class="row">



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        FY From Date : 

                        <span class="required-field"></span>

                      </label>
                      <?php 
                        $From_date = date("d-m-Y", strtotime($fy_list->FY_FROM_DATE));

                        
                       ?>
                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>

                          <input type="text" class="form-control datepicker" name="fy_from_date" value="{{ $From_date }}" placeholder="Enter From Date" maxlength="12">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fy_from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        FY To Date: 

                        <span class="required-field"></span>

                      </label>


                       <?php 
                        $To_date = date("d-m-Y", strtotime($fy_list->FY_TO_DATE));

                        
                       ?>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>

                          <input type="text" class="form-control datepicker" name="fy_to_date" value="{{ $To_date }}" placeholder="Enter To Date" maxlength="12">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fy_to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                   <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Block FY: 

                        <span class="required-field"></span>

                      </label>

                     
                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="fy_block" value="YES" <?php if($fy_list->BLOCK_FY=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="fy_block" value="NO" <?php if($fy_list->BLOCK_FY=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                  </div>
                

              </div>





              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-2 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/Master/Setting/View-Fy-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fy</a>

        </div>

      </div>



    </div>

     

	</section>

</div>







@include('admin.include.footer')





<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js

">

</script>

<script type="text/javascript">

  

  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      autoclose: 'true'

     // startDate: 'today',

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