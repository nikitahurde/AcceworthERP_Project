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
.showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

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

            Master Tax Indicator

            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/Master/InDirect-Direct-Tax/Edit-Tax-Indicator-Mast/'.base64_encode($tax_ind_list->TAXIND_CODE)) }}">Master Tax Indicator</a></li>

            <li class="active"><a href="{{ url('/Master/InDirect-Direct-Tax/Edit-Tax-Indicator-Mast/'.base64_encode($tax_ind_list->TAXIND_CODE)) }}">Update Tax Indicator</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master Tax Indicator</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Tax Indicator</a>

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

            <form action="{{ url('Master/InDirect-Direct-Tax/Tax-Indicator-Update') }}" method="POST" >

               @csrf

              <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Tax Indicator Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                          <input type="hidden" name="updateTaxIndId" value="{{$tax_ind_list->TAXIND_CODE}}"> 
                          <input type="text" class="form-control" name="tax_ind_code" value="{{ $tax_ind_list->TAXIND_CODE }}" placeholder="Enter Tax Indicator Code" id="ItemCodeSearch" oninput="this.value = this.value.toUpperCase()" maxlength="4" readonly="">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('tax_ind_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                    <!-- /.form-group -->

                </div>

                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Tax Indicator Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="tax_ind_name" value="{{ $tax_ind_list->TAXIND_NAME }}" placeholder="Enter Tax Indicator Name" maxlength="40">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tax_ind_name', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        Block Tax Indicator: 

                        <span class="required-field"></span>

                      </label>

                     
                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="tax_ind_block" value="YES" <?php if($tax_ind_list->TAXIND_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="tax_ind_block" value="NO" <?php if($tax_ind_list->TAXIND_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


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

          <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tax-Indicator-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Tax Indicator</a>

        </div>

      </div>



    </div>

     

	</section>

</div>



@include('admin.include.footer')


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
<!-- <script type="text/javascript">
  
  $(document).ready(function() {

 $('input:text:first').focus();
   

 $(document).on('keypress', 'input,select', function (e) {

    var n = $("input,select").length;

    if (e.which == 13)

    { //Enter key

      e.preventDefault(); //Skip default behavior of the enter key

      var nextIndex = $('input,select').index(this) + 1;
      if(nextIndex < n)
        $('input,select')[nextIndex].focus();
      else
      {
        $('input,select')[nextIndex-1].blur();
        
      }
    }
  });
 
});

</script> -->

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





@endsection