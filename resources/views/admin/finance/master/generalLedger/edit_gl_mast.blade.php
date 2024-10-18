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

  .showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

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

            Master General Ledger

            <small>Update Details</small>

          </h1>

         <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/Master/General-Ledger/Edit-Gl-Mast/'.base64_encode($gl_list->GL_CODE))}}">Master General Ledger </a></li>

            <li class="Active"><a href="{{ URL('/Master/General-Ledger/Edit-Gl-Mast/'.base64_encode($gl_list->GL_CODE))}}">Update General Ledger </a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update General Ledger</h2>


             <div class="box-tools pull-right showinmobile">

              <a href="{{ url('/Master/General-Ledger/View-Gl-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View General Ledger</a>

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

            <form action="{{ url('form-gl-mast-update') }}" method="POST" >

               @csrf

               <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Company Code :</label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="comp_codeList"  id="comp_code" name="comp_code" class="form-control  pull-left " value="{{ $gl_list->COMP_CODE }}" placeholder="Select Comp Code" maxlength="6" autocomplete="off" >

                            <datalist id="comp_codeList">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($comp_list as $key)

                              <option value='<?php echo $key->COMP_CODE?>'   data-xyz ="<?php echo $key->COMP_NAME; ?>" ><?php echo $key->COMP_NAME ; echo " [".$key->COMP_CODE."]" ; ?></option>

                              @endforeach

                            </datalist>

                            <input type="hidden" id="compName" name="comp_name" value="{{ $gl_list->COMP_NAME }}">

                        </div>

                        <small>  

                          <div class="pull-left showSeletedName" id="comp_codeText"></div>

                       </small>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                  </div><!-- /.col -->


                  <div class="col-md-6">

                    <div class="form-group">

                        <label for="exampleInputEmail1">General Schedule Code : <span class="required-field"></span></label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="glsch_codeList"  id="glsch_code" name="glsch_code" class="form-control  pull-left " value="{{ $gl_list->GLSCH_CODE }}" placeholder="Select Glsch Code" maxlength="6" autocomplete="off" readonly>



                            <datalist id="glsch_codeList">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($glsch_lists as $key)

                              

                              <option value='<?php echo $key->GLSCH_CODE?>'   data-xyz ="<?php echo $key->GLSCH_NAME; ?>" ><?php echo $key->GLSCH_NAME ; echo " [".$key->GLSCH_CODE."]" ; ?></option>



                              @endforeach

                            </datalist>

                            <input type="hidden" id="glsch_name" name="glsch_name" value="{{ $gl_list->GLSCH_NAME }}">

                        </div>

                        <small>  

                          <div class="pull-left showSeletedName" id="glsch_codeText"></div>

                       </small>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('glsch_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                  </div><!-- /.col -->

              </div>

              <!-- /.row -->

              <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        General Ledger Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="hidden" name="glmast_id" value="{{ $gl_list->GL_CODE }}">

                          <input type="text" class="form-control" name="gl_code" value="{{ $gl_list->GL_CODE }}" placeholder="Enter Gl Code" maxlength="6" autocomplete="off" readonly>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                      General Ledger Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="gl_name" value="{{ $gl_list->GL_NAME }}" placeholder="Enter Gl Name" maxlength="40" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gl_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

              </div>

              <div class="row">
                  
                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        General Ledger Type : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-bars"></i></span>

                          <input list="gltypeList" type="text" name="glsch_type" class="form-control" placeholder="Select Gl Type" autocomplete="off" value="{{ $gl_list->GLSCH_TYPE }}" id="glschType" maxlength="12">

                         <datalist id="gltypeList">
                            <option value="">--Select--</option>
                            <option value="AA" data-xyz ="ASSETS" <?php if($gl_list->GLSCH_TYPE == 'ASSETS'){ echo "selected"; }else{ echo '';} ?>>ASSETS</option>
                            <option value="LB" data-xyz ="LIABILITIES" <?php if($gl_list->GLSCH_TYPE == 'LIABILITIES'){ echo "selected"; }else{ echo '';} ?>>LIABILITIES</option>
                            <option value="EX"  data-xyz ="EXPENDITURES"<?php if($gl_list->GLSCH_TYPE == 'EXPENDITURES'){ echo "selected"; }else{ echo '';} ?>>EXPENDITURES</option>
                            <option value="RS" data-xyz ="REVENUES" <?php if($gl_list->GLSCH_TYPE == 'REVENUES'){ echo "selected"; }else{ echo '';} ?>>REVENUES</option>
                            <option value="OT" data-xyz ="OTHERS" <?php if($gl_list->GLSCH_TYPE == 'OTHERS'){ echo "selected"; }else{ echo '';} ?>>OTHERS</option>
                         </datalist>

                         <input type="hidden" id="gltype_name" name="gltype_name" value="{{$gl_list->GLSCHTYPE_NAME}}">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('glsch_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                          <small id="glschTypeName" class="showSeletedName"></small> 


                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                      Account Tag : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="account_tag" value="YES" <?php if($gl_list->ACCOUNT_TAG=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" class="optionsRadios1" name="account_tag" value="NO" <?php if($gl_list->ACCOUNT_TAG=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('account_tag', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                      Cost Tag : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="cost_tag" value="YES" <?php if($gl_list->COST_TAG=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" class="optionsRadios1" name="cost_tag" value="NO" <?php if($gl_list->COST_TAG=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('cost_tag', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                   <div class="col-md-6">

                    <div class="form-group">

                      <label>

                      Asset Tag : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="asset_tag" value="YES" <?php if($gl_list->ASSET_TAG=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <input type="radio" class="optionsRadios1" name="asset_tag" value="NO" <?php if($gl_list->ASSET_TAG=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('assest_tag', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>
              </div>


              <div class="row">
                
                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Auto Posting : 

                        

                      </label>

                       <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="autoposting" value="YES" <?php if($gl_list->AUTOPOSTING=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="autoposting" value="NO" <?php if($gl_list->AUTOPOSTING=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                      </div>

                     

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-6">
                    <div class="form-group">

                      <label>
                          General Ledger Block : <span class="required-field"></span>
                      </label>

                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="gl_block" value="YES" <?php if($gl_list->GL_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="gl_block" value="NO" <?php if($gl_list->GL_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('autoposting', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

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

      <div class="col-sm-3">

        <div class="box-tools pull-right hideinmobile">

          <a href="{{ url('/Master/General-Ledger/View-Gl-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View General Ledger</a>

        </div>

      </div>



    </div>

     

  </section>

</div>







@include('admin.include.footer')

<script type="text/javascript">

    $(document).ready(function(){

        $("#comp_code").bind('change', function () {
          var val = $(this).val();
          var xyz = $('#comp_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
            $("#comp_code").val('');
            $("#comp_codeText").html('');
            $("#compName").val('');
          }else{
            $("#comp_codeText").html(msg);
            $("#compName").val(msg);
          }

        });

        $("#glsch_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#glsch_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("glsch_codeText").innerHTML = msg; 

        });
    });
</script>

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
  $(document).ready(function(){
  
    $("#glschType").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#gltypeList option').filter(function() {

          return this.value == val;

        }).data('xyz');
        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){

            $(this).val('');
            $('#glschTypeName').html('');
            $('#gltype_name').val('');
        }else{
          $('#glschTypeName').html(msg);
          $('#gltype_name').val(msg);
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