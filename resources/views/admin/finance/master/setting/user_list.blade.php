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

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master User

            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/edit-user/'.base64_encode($user_list->USER_CODE)) }}">Master User</a></li>

            <li class="active"><a href="{{ url('/edit-user/'.base64_encode($user_list->USER_CODE)) }}">Update  User</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update  User</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-user') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View User</a>

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

            <form action="{{ url('form-mast-user-update') }}" method="POST" enctype="multipart/form-data">

               @csrf

               <div class="row">

                  <div class="col-md-6">

                  <div class="form-group">

                      <label>

                       User Code/ID : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input type="hidden" name="UserID" value="{{ $user_list->USER_CODE }}">

                          <input type="text" class="form-control" name="user_code" value="{{ $user_list->USER_CODE }}" placeholder="Enter  User Code" maxlength="30">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('user_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                </div>

              <div class="col-md-6">

                  <div class="form-group">

                      <label>

                       Account Code : 

                       <!--  <span class="required-field"></span> -->

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="AccList" class="form-control" name="acc_code" value="{{ $user_list->ACC_CODE }}" placeholder="Enter Acc Code" maxlength="30" onchange="GetAccType(this.value)">

                          <datalist id="AccList">

                            <?php foreach ($acc_code as $key) { ?>


                              <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> <?= $key->ACC_NAME ?></option>

                            <?php } ?>
                            
                          </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('user_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                </div>



              </div>

              <!-- /.row -->



              <div class="row">


                  
                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Email-Id : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                          <input type="text" class="form-control" name="email_id" value="{{ $user_list->EMAIL_ID }}" placeholder="Enter User Email Id" maxlength="30" style="text-transform: lowercase;">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('email_id', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        User-Name : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input type="text" class="form-control" name="user_name" value="{{ $user_list->USER_NAME }}" placeholder="Enter User-Id" maxlength="30">

                          

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                        Password : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-key"></i></span>

                          <input type="password" class="form-control" name="password" value="{{ $user_list->PASSWORD }}" maxlength="30"  readonly="">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('password', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        User Type : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-code"></i></span>

                         <input list="userList" type="text" name="user_type" id="user_type" class="form-control" maxlength="30" value="{{ $user_list->USER_TYPE }}">

                          <datalist id="userList">
                          
                            <option>--SELECT USERTYPE</option>

                            <option value="admin" <?php if($user_list->USER_TYPE== "admin"){ echo "SELECTED"; } ?>>Admin</option>



                            <option value="superAdmin" <?php if($user_list->USER_TYPE== "superAdmin"){ echo "SELECTED";} ?>>Superadmin</option>

                            <option value="user" <?php if($user_list->USER_TYPE== "user"){ echo "SELECTED";} ?>>User</option>
                          </datalist>
                         
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                 

                </div>

               
              </div>

                <div class="row">

                  <div class="col-md-5">
                   <div class="form-group">

                      <label>Approve User:<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-check"></i></span>

                          <!-- <input list="Usernamelist" class="form-control" name="user_name" value="{{old('user_name')}}" placeholder="Enter User Name" maxlength="30"> -->
                            <?php $explode = explode(',', $user_list->APPROVE_USER);?>

                        <select class="allcheckbox form-control" multiple="" name="approve_user[]">
                            <?php foreach($approve_ind as $key) { ?>
                            <option value="{{ $key->approve_code }}" <?php if(in_array($key->approve_code, $explode)){echo 'selected';} ?> >{{ $key->approve_code }} {{ $key->approve_name }}</option>

                          <?php } ?>
                        </select>


                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div> 

                  <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">User Image : <span class="required-field"></span></label>

                        <input type="file" class="form-control-file" name="user_img" value="" id="user_img">

                    </div>

                  </div>

                  <div class="col-md-2">
                    
                    <?php if($user_list->IMAGE){ echo '<img src="data:image/jpeg;base64,'.base64_encode($user_list->IMAGE). '" style="height:70px;width:60px"/>';}  ?>
                  </div>

              
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">

                      <label>

                        Block User: 

                        <span class="required-field"></span>

                      </label>

                     
                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="user_block" value="1" <?php if($user_list->FLAG=='1'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="user_block" value="0" <?php if($user_list->FLAG=='0'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('FLAG', '<p class="help-block" style="color:red;">:message</p>') !!}

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

          <a href="{{ url('/Master/Setting/View-User-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View User</a>

        </div>

      </div>



    </div>

     

  </section>

</div>



@include('admin.include.footer')

<script type="text/javascript">
  $(document).ready(function(){

 $('.allcheckbox').multiselect({
  nonSelectedText: 'Select',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'212px',
  includeSelectAllOption: true,
  maxHeight: 200

  
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