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

            Master Task

            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/edit-mast-task/'.base64_encode($task_list->TASK_CODE)) }}">Master Task</a></li>

            <li class="active"><a href="{{ url('/edit-mast-task/'.base64_encode($task_list->TASK_CODE)) }}">Update  Task</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master Task</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-task') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Task</a>

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

            <form action="{{ url('form-mast-task-update') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Task Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                         <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="task_code" value="{{ $task_list->TASK_CODE }}" placeholder="Task Code" maxlength="13" oninput="this.value = this.value.toUpperCase()" readonly>

                          <input type="hidden" name="taskcodeId" value="{{ $task_list->TASK_CODE }}">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('task_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Task Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="task_name" value="{{ $task_list->TASK_NAME  }}" placeholder="Enter Task Name" maxlength="40">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('task_name', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        Department: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                         
                         <input list="deptList"  id="dept_code" name="dept_code" class="form-control  pull-left" value="{{ $task_list->DEPT_CODE }}" placeholder="Enter Department" maxlength="30" autocomplete="off">



                          <datalist id="deptList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($dept_list as $key)

                            <option value='<?php echo $key->DEPT_CODE?>'   data-xyz ="<?php echo $key->DEPT_NAME; ?>" ><?php echo $key->DEPT_NAME ; echo " [".$key->DEPT_CODE."]" ; ?></option>

                            @endforeach

                          </datalist>

                      </div> 

                        <input type="hidden" id="dept_name" name="dept_name" value="">

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('dept_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small>
                          <div class="pull-left showSeletedName" id="deptText">{{ $task_list->DEPT_NAME  }}</div>
                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Block Task: 

                        <span class="required-field"></span>

                      </label>

                     
                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="task_block" value="YES" <?php if($task_list->TASK_BLOCK=='YES'){ echo 'checked';}else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="task_block" value="NO" <?php if($task_list->TASK_BLOCK=='NO'){ echo 'checked';}else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('task_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                  </div>

                <!-- /.col -->

              </div>

              <!-- /.row -->

              <div class="row">

                  
                
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

          <a href="{{ url('/view-mast-task') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Task</a>

        </div>

      </div>



    </div>

     

  </section>

</div>



@include('admin.include.footer')



<script type="text/javascript">

  $("#dept_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#deptList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        document.getElementById("deptText").innerHTML = msg; 

        if(msg == 'No Match'){

            $('#department').val('');
            $('#dept_name').val('');
        }else{
            $('#department').val(val);
            $('#dept_name').val(msg);
        }


    });

  

  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      endDate: 'today',

      autoclose: 'true'
     // startDate: 'today',

    });

});


$(document).ready(function(){



        $("#dept_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#deptList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         // document.getElementById("makeText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             //document.getElementById("makeText").innerHTML = '';

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