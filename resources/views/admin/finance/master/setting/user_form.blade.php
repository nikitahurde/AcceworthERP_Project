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

  .email_id::placeholder {
    text-transform: none;
  }

 .required-field::before {

    content: "*";

    color: red;

  }

  .btn {
    display: inline-block !important;
    padding: 2px 8px !important;
    margin-bottom: 0 !important;
    font-size: 12px !important;
    font-weight: 400 !important;
    line-height: 1.42857143 !important;
    text-align: center !important;
    white-space: nowrap !important;
    vertical-align: middle !important;
    -ms-touch-action: manipulation !important;
    touch-action: manipulation !important;
    cursor: pointer !important;
    -webkit-user-select: none !important;
    -moz-user-select: none !important;
    -ms-user-select: none !important;
    user-select: none !important;
    background-image: none !important;
    border: 1px solid transparent !important;
    border-radius: 4px !important;
}

.input-group-addon {
    padding: 2px 12px !important;
    font-size: 14px !important;
    font-weight: 400 !important;
    line-height: 1 !important;
    color: #555 !important;
    text-align: center !important;
    background-color: #eee !important;
}

.modal-header .close {
    margin-top: -22px !important;
}

  .showSeletedName{



    font-size: 15px;



    margin-top: 1%;

    margin-bottom: 3%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;

    text-transform: capitalize;

    text-align: center;



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

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-user') }}">Master User</a></li>

            <li class="active"><a href="{{ url('/form-mast-user') }}">Add  User</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add  User</h2>

              
              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-user') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View User</a>

              </div>

              <button type="button" class="btn btn-primary pull-right" id="copyFrom" data-toggle="modal" data-target="#copyFromModal"><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp;&nbsp;Copy From</button>
              

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

            <form action="{{ url('form-mast-user-save') }}" method="POST" enctype="multipart/form-data">

               @csrf

               <div class="col-md-12">

               <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                      <label>

                       User Code/ID: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input list="emplist" type="text" class="form-control" name="user_code" id="user_code" value="{{ old('user_code')}}" placeholder="Enter User Id" maxlength="30" autocomplete="off">

                           <datalist id='emplist'>
                                <?php foreach($empList as $key) { ?>

                                <option value='<?= $key->EMP_CODE?>' data-xyz='<?= $key->EMP_NAME?>'>{{ $key->EMP_CODE }} = {{$key->EMP_NAME}}</option>

                                <?php } ?>
                            </datalist>


                        </div>

                        <div class="pull-left showSeletedName" id="empText"></div>

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

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="AccList" class="form-control" name="acc_code" value="{{ old('acc_code')}}" placeholder="Enter Account Code" maxlength="30" onchange="GetAccType(this.value)" autocomplete="off">

                          <datalist id="AccList">

                            <?php foreach ($acc_code as $key) { ?>


                              <option value="<?php echo $key->ACC_CODE.'_'.$key->ACC_NAME; ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> <?= $key->ACC_NAME ?></option>

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
            </div>


              <div class="col-md-12">

               <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Email-Id : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                          <input type="text" class="form-control email_id" name="email_id" value="{{ old('email_id')}}" placeholder="Enter User Email Id" maxlength="30" style="text-transform: lowercase;"  autocomplete="off">

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

                          <input type="text" class="form-control" name="user_name" value="{{ old('user_name')}}" placeholder="Enter User Name" maxlength="30">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                  

              </div>

            </div>

            <div class="col-md-12">

              <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Password : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-key"></i></span>

                          <input type="password" class="form-control" name="password" placeholder="Enter Password" value="{{ old('password')}}" maxlength="15">

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

                        Confirm Password : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-key"></i></span>

                          <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password" value="{{ old('confirm_password') }}" maxlength="15">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('confirm_password', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

              </div>

            </div>

             <div class="col-md-12">
              <div class="row">

                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        User Type : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-code"></i></span>

                         <!--  <input list="userList" type="text" class="form-control" name="user_type" id="user_type" placeholder="Select User Type" value="{{ old('user_type')}}"> -->
                         

                         <select  type="text" class="form-control"  name="user_type" id="user_type">
                           
                            <option value="">--SELECT USERTYPE</option>

                            <option value="admin">Admin</option>

                            <option value="superAdmin">Superadmin</option>

                            <option value="user">User</option>

                            <option value="employee">Employee</option>

                            <option value="CRM">CRM - Customer Relationship Management</option>

                            <option value="SRM">SRM - </option>


                         </select>
                         <div id="copyUsrType"></div>

                         <input type="hidden" name="userTypeEmp" id="userTypeEmp" value="">

                   
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                 

                </div>


              <div class="col-md-6">

                <div class="form-group">

                <label>

                       Approve User: 
                </label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                   <select class="allcheckbox form-control" multiple="" id="approvUsrList" name="approve_user[]">
                    <?php foreach($approve_ind as $key) { ?>
                    <option value="<?php echo $key->approve_code.'-'.$key->approve_name; ?>">{{ $key->approve_code }} {{ $key->approve_name }}</option>

                  <?php } ?>
                   </select>

                   <div id="copyUsrAppr"></div>

                </div> 

                <small id="emailHelp" class="form-text text-muted">

                  {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                </small>

                 </div>
                </div> 
                 

                

              </div>

            </div>

            <div class="col-md-12">

              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                    <label>
                       User Profile Rights: 
                    </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-check"></i></span>

                       <select class="profileMultiSelect form-control" id="profRigList" multiple="" name="usr_profile[]">
                        <?php foreach($profile_list as $key) { ?>
                        <option value="<?php echo $key->PROFILE_CODE.'-'.$key->PROFILE_NAME;?>">{{ $key->PROFILE_NAME }} - {{ $key->PROFILE_CODE }}</option>

                        <?php } ?>
                       </select>

                       <div id="copyUsrProfRight"></div>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>
                </div> 

                <div class="col-md-6">
       
                  <div class="form-group">

                      <label for="exampleInputEmail1">User Image : <span class="required-field"></span></label>

                      <input type="file" class="form-control-file" name="user_img" value="" id="user_img" style="margin-top: 1%;">

                  </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('user_img', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div>
               
              </div>

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

      <div class="col-sm-2 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/Master/Setting/View-User-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View User</a>

        </div>

      </div>



    </div>

     

	</section>

</div>


<!-- Modal : copy from user  -->

  
<div class="modal fade" id="copyFromModal" tabindex="-1" role="dialog" aria-labelledby="copyFromModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div style="text-align:center;"><h4 class="modal-title" id="copyFromModalLabel">Copy User Rights</h4></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times-circle-o" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">

          <table id="example" class="table table-bordered table-striped table-hover">

            <thead>

              <tr>
                <th class="text-center">Sr.NO</th>

                <th class="text-center">#</th>
 
                <th class="text-center">User Code</th>

                <th class="text-center">User Name</th>

                <th class="text-center">User Type</th>

                <th class="text-center">Approve User</th>  

                <th class="text-center">Profile Rights</th>  
<!-- 
                <th class="text-center">Details</th>
 -->
              </tr>

            </thead>


              <tbody>

                  <?php  
                    $i=1;
                    foreach ($copy_userList as $row){
                      
                  ?>

                  <tr>
                        
                    <td style="text-align:center;">{{$i}}</td>
                    <td style="text-align:center;"><input class="form-check-input" type="radio" onclick="copyRgtRadio('<?php echo $i; ?>')" name="exampleRadios" id="exampleRadios1" value="<?php echo $row->USER_CODE.'_'.$row->USER_NAME.'_'.$row->USER_TYPE; ?> "></td>
                    <td>{{$row->USER_CODE}}</td>
                    <td>{{$row->USER_NAME}}</td>
                    <td>{{$row->USER_TYPE}}</td>
                    <td style="text-align:center;">
                      <button type="button" data-toggle="modal" id="apprvbtn1" data-target="#getApprovUsrDetail" onclick="getApprovUsrDetail('<?php echo $i; ?>','<?php echo $row->USER_CODE; ?>')" class="btn btn-xs btn-primary gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>
                    </td>
                    <td style="text-align:center;">
                      <button type="button" data-toggle="modal" id="profbtn1" data-target="#getPorfRightDetail" onclick="getPorfRightDetail('<?php echo $i; ?>','<?php echo $row->USER_CODE; ?>')" class="btn btn-xs btn-primary gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>
                    </td>
                  <!--   <td>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profileRgtModal">
                        Launch demo modal
                      </button>
                    </td> -->

                  </tr>

                  <?php $i++; } ?>

              </tbody>

          </table>
       
      </div>
      <div class="modal-footer" style="text-align:center;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="copyUserBtn(1)" id="copyUsrBtn" disabled>
          Copy User &nbsp;
          <i class="fa fa-arrow-down" aria-hidden="true"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<!-- End-Modal : copy from user  -->


<!-- Modal : Approve User --> 

<div class="modal fade" id="getApprovUsrDetail" tabindex="-1" role="dialog" aria-labelledby="getApprovUsrDetailLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div style="text-align:center;">
          <h5 class="modal-title" id="getApprovUsrDetailLabel">Approve User Details</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times-circle-o" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">

        <table id="example" class="table table-bordered table-striped table-hover">

            <thead>

              <tr>
                <th class="text-center">Sr.NO</th>

                <th class="text-center">User Code</th>

                <th class="text-center">User Profile</th>
                
              </tr>

            </thead>

            <tbody id="getApprvUsrDetails">


            </tbody>

        </table>

      </div>
      <div class="modal-footer" style='text-align:center;'>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- End-Modal : Approve User --> 


<!-- Modal : Profile Rights --> 

<div class="modal fade" id="getPorfRightDetail" tabindex="-1" role="dialog" aria-labelledby="getPorfRightDetailLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div style="text-align:center;">
          <h5 class="modal-title" id="getPorfRightDetailLabel">Profile Rights Details</h5>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-times-circle-o" aria-hidden="true"></i>
        </button>
      </div>
      <div class="modal-body">

        <table id="example" class="table table-bordered table-striped table-hover">

            <thead>

              <tr>
                <th class="text-center">Sr.NO</th>

                <th class="text-center">User Code</th>

                <th class="text-center">User Profile</th>

              </tr>

            </thead>

            <tbody id="getProRigtDetails">


            </tbody>

        </table>
      
      </div>
      <div class="modal-footer" style='text-align:center;'>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- End-Modal : Profile Rights --> 

@include('admin.include.footer')

<script type="text/javascript">
  $(document).ready(function(){

 $('.allcheckbox').multiselect({
  nonSelectedText: '...Select User Level...',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'100%',
  includeSelectAllOption: true,
  maxHeight: 200

  
 });

 $('.profileMultiSelect').multiselect({
  nonSelectedText: '...Select Profile...',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'100%',
  includeSelectAllOption: true,
  maxHeight: 200

  
 });

});
</script>

<script type="text/javascript">


$(document).ready(function() {

   

  $(".btn-group").css("border","1px solid #c7c7c7");

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

$("#user_code").bind('change', function () {  

    var val = $(this).val();
    
    var xyz = $('#emplist option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      // console.log('no match');
      document.getElementById("empText").innerHTML = '';
      $('#userTypeEmp').val('');
      $('#user_type').attr('disabled',false);
      $("#user_type option[value=" + $(this) + "]").show();

    }else{
      document.getElementById("empText").innerHTML = msg;
      $('#userTypeEmp').val('employee');
      $('#user_type').val('employee');
      $('#user_type').attr('disabled',true);
      $("#user_type option[value=" + $(this) + "]").hide();

    }

     

  });

});
</script>

<script type="text/javascript">
  
  function GetAccType(acc_code){

     $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

         $.ajax({
               url:"{{ url('transaction/sales/get-acc-type-by-acccode') }}",

               method : "POST",

               type: "JSON",

               data: {acc_code: acc_code},

               success:function(data){

               var obj = JSON.parse(data);

               var acc_type = obj.data.ATYPE_CODE;

              // console.log(acc_type);

               if(acc_type=='C'){

               $("#user_type").html('<option value="CRM" selected>CRM</option>');
               }else if(acc_type=='E'){

                for (var i = 0; i < 2; i++) {

                  $("#user_type").html('<option value="Employee">Employee</option><option value="CRM Employee">CRM Employee</option><option value="SRM Employee">SRM Employee</option>');
                  
                  }

                

               }else if(acc_type=='V'){

                $("#user_type").html('<option value="SRM" selected readonly>SRM</option>');

               }else{

                $("#user_type").html('<option value="admin" selected readonly>admin</option>');

               }
              

               }
          })
   

  }


  function copyRgtRadio(rightID){

    console.log('rightID',rightID);

    $('#copyUsrBtn').prop('disabled',false);



  }

  function copyUserBtn(getID){

   var userCopy = $("input[type='radio'][name='exampleRadios']:checked").val();

      $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

      });

      $.ajax({

          url:"{{ url('get-copy-user-details') }}",

          method : "POST",

          type: "JSON",

          data: {userCopy: userCopy},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log('data =>',data1);


              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                    console.log('data =>',data1);

                    $("#copyUsrAppr").empty()
                    $("#copyUsrProfRight").empty()
                    $("#copyUsrType").empty()

                    var srNo=1;
                    var appUsr = [];
                    var profUsr = [];
                    var uType;

                    $.each(data1.user_list, function(k, getData){

                      uType = getData.USER_TYPE;

                    });


                    $.each(data1.prof_list, function(k, getRow){
                      
                      profUsr.push(getRow.PROFILE_CODE+'-'+getRow.PROFILE_NAME);
                     
                    });

                    $.each(data1.apprv_list, function(k, getData){
                      appUsr.push(getData.APPROVE_USER+'-'+getData.APP_USER_NAME);
                      
                    });


                    if (appUsr.length > 0) {

                      $("#approvUsrList").next().hide();

                      var usrAppInp = '<input type="text" class="form-control" name="approve_user_copy" readonly value="'+appUsr+'">'

                      $('#copyUsrAppr').append(usrAppInp);

                    }else{

                      $('#approvUsrList').css('display','block');

                    }

                    if (appUsr.length > 0) {

                      //$('#profRigList').css('display','none');

                      $("#profRigList").next().hide();

                      var usrProfInp = '<input type="text" class="form-control" readonly name="usr_profile_copy" value="'+profUsr+'">'

                      $('#copyUsrProfRight').append(usrProfInp);

                    }else{

                      $('#profRigList').css('display','block');

                    }


                    $('#user_type').css('display','none')

                    var usrTypeInp = '<input type="text" class="form-control" readonly name="user_type" value="'+uType+'">'

                    $('#copyUsrType').append(usrTypeInp);

                    $('#copyFromModal').modal('hide');


              }

          }

      });


  }

  function getApprovUsrDetail(getID,usrId){

      $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

      });

      $.ajax({

          url:"{{ url('get-approve-user-details') }}",

          method : "POST",

          type: "JSON",

          data: {getID: getID,usrId:usrId},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                console.log('data1 => ',data1);

                  if(data1.data ==''){

                  }else{

                    $("#getApprvUsrDetails").empty()
                    var srNo=1;
                    $.each(data1.data, function(k, getData){

                       var tblDta = "<tr><td style='text-align:center'>"+srNo+"</td><td>"+getData.USER_CODE+"</td><td>"+getData.APP_USER_NAME+" [ "+getData.APPROVE_USER+" ]</td></tr>";

                        $('#getApprvUsrDetails').append(tblDta);
                        srNo++;
                    });

                  }

              }

          }

      });

  }

  function getPorfRightDetail(getID,usrId){

      $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

      });

      $.ajax({

          url:"{{ url('get-user-profile-details') }}",

          method : "POST",

          type: "JSON",

          data: {getID: getID,usrId:usrId},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                console.log('data1 => ',data1);

                  if(data1.data ==''){

                  }else{

                    $("#getProRigtDetails").empty()
                    var srNo=1;
                    $.each(data1.data, function(k, getData){

                       var tblDta = "<tr><td style='text-align:center'>"+srNo+"</td><td>"+getData.USER_CODE+"</td><td>"+getData.PROFILE_NAME+" [ "+getData.PROFILE_CODE+" ]</td></tr>";

                        $('#getProRigtDetails').append(tblDta);
                        srNo++;
                    });

                  }

              }

          }

      });

  }
  

</script>

@endsection