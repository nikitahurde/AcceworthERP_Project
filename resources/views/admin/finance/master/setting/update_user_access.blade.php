@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')


<style type="text/css">

  html{ height: 100%; }
            body{ padding: 0; margin: 0; height: 100%; }
            /*h2{color: white; font-family: sans-serif; background-color: teal; padding: 10px; font-weight: lighter; }
            h2 a{ float: right; color: white; text-decoration: none; vertical-align: bottom; }*/
            #wrap{width: 550px;margin: 0 auto; }
            pre, pre.noclick{ text-align: left; background-color: #EEE; border-left: 5px solid teal; cursor: pointer; border-top: 1px solid transparent; border-bottom: 1px solid transparent; border-right: 1px solid transparent; }
            pre:hover{ background-color: #f4f4f4; border-color: teal; }
            pre:active{ background-color: #DDD; }
            pre.noclick{ cursor: inherit; }
            pre.noclick:hover{ background-color: #EEE; border-top-color: transparent; border-right-color: transparent; border-bottom-color: transparent; }
            footer{font-family: sans-serif; font-size: 12px;}
            footer p{color: #aaa;}
            footer p a{color: yellowgreen; text-decoration: none;}
            .title{font-size: 57px; font-weight: bold; color: #555;margin-bottom: 0;}
            .subtitle{font-size: 14px; color: #999;margin-top: -10px; }
            .version{ font-size: 10px; font-weight: lighter; font-family: sans-serif; color: #555; }
            .s{ color: teal; }
            .b{ color: purple; }
            .f{ font-weight: bold; }
            .n{ font-weight: bold; }
            pre{padding: 10px; background-color: #EEE;}
            hr{ height: 5px; border: 0; margin: 0; }
      .comment{color: #AAA;}
      .string{color: teal;}
      .tag{color: blue;}
      .attr{color: green;}
      .button_download{
        display: block;
        font-family: sans-serif;
        cursor: pointer;
        width: 60px;
        padding: 10px 30px 10px 30px;
        font-weight: bold;
        font-size: 20px;
        text-decoration: none;
        text-align: center;
        margin: 0 auto;
        background-color: #444;
        color: #EEE;
        transition: all 0.3s;
        -moz-transition: all 0.3s;
        -webkit-transition: all 0.3s;
        -o-transition: all 0.3s;
        -ms-transition: all 0.3s;
      }
      /*.button_download:hover{
        width: 480px;
        background-color: yellowgreen;
        color: #444;
      }*/
      .step{ font-weight: bold; }

  .required-field::before {

    content: "*";

    color: red;

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
.hideform{
  display: none;
}
.showform{
  display: block;
}

.beforhidetble{
  display: none;
}
.popover{
    left: 80.4922px!important;
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
     top: 80%;
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

#loadingmessage{ 
  position: fixed;
  bottom: 0;
  z-index: 100;
  width: 50%;
  height:50%;
  display: none;
  background: #ffffff05;
}

/* --- overlay spinner --- */

/* Absolute Center Spinner */
.overlay-spinner {
    position: fixed;
    z-index: 999;
    height: 2em;
    width: 2em;
    overflow: show;
    margin: auto;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

/* Transparent Overlay */
.overlay-spinner:before {
    content: '';
    display: block;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.overlay-spinner:not(:required) {
    /* hide "loading..." text */
    font: 0/0 a;
    color: transparent;
    text-shadow: none;
    background-color: transparent;
    border: 0;
}

.overlay-spinner:not(:required):after {
    content: '';
    display: block;
    font-size: 10px;
    width: 1em;
    height: 1em;
    margin-top: -0.5em;
    -webkit-animation: spinner 1500ms infinite linear;
    -moz-animation: spinner 1500ms infinite linear;
    -ms-animation: spinner 1500ms infinite linear;
    -o-animation: spinner 1500ms infinite linear;
    animation: spinner 1500ms infinite linear;
    border-radius: 0.5em;
    -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
   box-shadow: rgba(74 156 204) 1.5em 0 0 0, rgba(74 156 204) 1.1em 1.1em 0 0, rgba(74 156 204) 0 1.5em 0 0, rgba(74 156 204) -1.1em 1.1em 0 0, rgba(74 156 204) -1.5em 0 0 0, rgba(74 156 204) -1.1em -1.1em 0 0, rgba(74 156 204) 0 -1.5em 0 0, rgba(74 156 204) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@-moz-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@-o-keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
@keyframes spinner {
    0% {
        -webkit-transform: rotate(0deg);
        -moz-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        -o-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -moz-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        -o-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

.hideloader{
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

          <h1>

            User Right

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/finance/tax')}}">User Right</a></li>

            <li class="Active"><a href="{{ URL('/finance/tax')}}">User Right</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-9">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add User Right</h2>

              <div class="box-tools pull-right showinmobile">

              <a href="{{ url('/finance/view-tax') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View User Right</a>

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

<?php  
 $getdata=[]; 
 $userid=[]; 

 ?>


        <?php foreach($form_name as $key) {

               $getdata[]= $key->FORMCODE;
               $userid[]= $key->USER_CODE;
               
       } ?>

           <div class="overlay-spinner hideloader"></div>

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        User Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          
                         <input list="Usercodelist" class="form-control" id="user_code" name="user_code" value="{{ $user_code->USER_CODE}}" placeholder="Enter User Code" maxlength="20" readonly=""> 

                       
                          
                          

                        </div>
                         <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
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

                       User Name: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                       <input list="Usernamelist" class="form-control" name="user_name" value="{{ $user_code->USER_NAME }}" placeholder="Enter User Name" maxlength="30" readonly="">

                           
                          

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

              </div>



               <br>


               <form method="POST" id="update_form">

               @csrf

             
              <div class="row">
                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       1 . Master Company: 

                        <input type="hidden" name="userid" id="userid" value="{{ $userId }}">

                       <input type="hidden" name="user_name" id="user_name"> 

                        <span class="required-field"></span>

                      </label>

                     
                    </div>

                    <!-- /.form-group -->

                  </div>
                   <div class="col-md-6">

                    <div class="form-group">


                      <div class="input-group">
 
                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <!-- <input list="Usernamelist" class="form-control" name="user_name" value="{{old('user_name')}}" placeholder="Enter User Name" maxlength="30"> -->
                          
                                
                                    
                                                        
                           
                           <select class="allcheckbox form-control" multiple="" name="form_name[]">
                             
                            <?php foreach($comp_code as $key) { ?>


                            <option value="{{ $key->COMP_CODE }}" <?php if(in_array($key->COMP_CODE, $getdata)){echo "selected";} ?>>{{ $key->COMP_CODE }}</option>

                          <?php }  ?>
                           </select>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
              </div>

          <br>
              <div class="row">
                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       2 . Profit Center: 

                        <span class="required-field"></span>

                      </label>

                     
                    </div>

                    <!-- /.form-group -->

                  </div>
                   <div class="col-md-6">

                    <div class="form-group">

                   

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <!-- <input list="Usernamelist" class="form-control" name="user_name" value="{{old('user_name')}}" placeholder="Enter User Name" maxlength="30"> -->


                          <select class="allcheckbox form-control" multiple="" name="form_name[]">


                            <?php foreach($profit_code as $key) { ?>
                            <option value="{{ $key->PFCT_CODE }}" <?php if(in_array($key->PFCT_CODE, $getdata)){echo "selected";} ?>>{{ $key->PFCT_CODE }} {{ $key->PFCT_NAME }}</option>

                          <?php } ?>

                        </select>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
              </div>

              <br>
              <div class="row">
                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       3 . Master Plant: 

                        <span class="required-field"></span>

                      </label>

                     
                    </div>

                    <!-- /.form-group -->

                  </div>
                   <div class="col-md-6">

                    <div class="form-group">


                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                         <!--  <input list="Usernamelist" class="form-control" name="user_name" value="{{old('user_name')}}" placeholder="Enter User Name" maxlength="30"> -->

                           <select class="allcheckbox form-control" multiple="" name="form_name[]">

                            <?php foreach($plant_code as $key) { ?>
                            <option value="{{ $key->PLANT_CODE }}" <?php if(in_array($key->PLANT_CODE, $getdata)){echo "selected";} ?>>{{ $key->PLANT_CODE }} ({{ $key->PLANT_NAME }})
                            </option>

                          <?php } ?>
                        </select>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
              </div>
              <br>

               <div class="row">
                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       4 . Master Transaction: 

                        <span class="required-field"></span>

                      </label>

                     
                    </div>

                    <!-- /.form-group -->

                  </div>
                   <div class="col-md-6">

                    <div class="form-group">

                     
                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <!-- <input list="Usernamelist" class="form-control" name="user_name" value="{{old('user_name')}}" placeholder="Enter User Name" maxlength="30"> -->

                           <select class="allcheckbox form-control" multiple="" name="form_name[]">
                            <?php foreach($trans_code as $key) { ?>
                            <option value="{{ $key->form_code }}" <?php if(in_array($key->form_code, $getdata)){echo "selected"; } ?>>{{ $key->form_code }} ({{ $key->form_name }})</option>

                          <?php } ?>

                         </select>

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

                       5 . Forms: 

                        <span class="required-field"></span>

                      </label>

                     
                    </div>

                    <!-- /.form-group -->

                  </div>
                   <div class="col-md-6">

                    <div class="form-group">

                    

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <!-- <input list="Usernamelist" class="form-control" name="user_name" value="{{old('user_name')}}" placeholder="Enter User Name" maxlength="30"> -->
                          <select class="allcheckbox form-control" multiple="" name="form_name[]">
                             <?php foreach($form_code as $key) { ?>
                            <option value="{{ $key->form_code }}" <?php if(in_array($key->form_code, $getdata)){echo "selected";} ?>>{{ $key->form_code }}</option>
                          <?php } ?>

                          </select>
                           
                           


                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
            

              <!-- /.row -->



              <div style="text-align: center;">

                 <div id='loadingmessage' style='display:none'>
                      <img src="{{ URL::asset('public/dist/img/loader/Spinner-1s-200px (1).gif') }}" class="user-image" alt="User Image">
                </div>
                

                <button type="button" class="btn btn-danger" id="btncancel">

                <i class="fa fa-window-close" aria-hidden="true"></i>&nbsp;&nbsp; Cancel 

                 </button>

                
                 <button type="Submit" class="btn btn-primary" id="btnsubmit">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>

              </div>
            



            </form>

                
              </div>





          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-2">

        <div class="box-tools pull-right hideinmobile">

          <a href="{{ url('/Master/Setting/view-user-right') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Rights</a>

        </div>

      </div>



    </div>

     

  </section>

</div>


<!--  <pre onclick="not2()"><span class="f">notif(</span>{
  msg: <span class="s">"&lt;b&gt;Oops!&lt;/b&gt; A wild error appeared!"</span>,
  type: <span class="s">"error"</span>,
  position: <span class="s">"center"</span>
}<span class="f">)</span>;</pre> -->

@include('admin.include.footer')

<!--  <script type="text/javascript">
  
  
   $(window).load(function() {
      
   notif({
        msg: "&lt;b&gt;Oops!&lt;/b&gt; A wild error appeared!",
        type: "error",
        position: "center"
      });
});
   
  
    
    
  </script> -->

   <script type="text/javascript">
     $(document).ready(function(){
      $("#user_code").on('change', function (){

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });

        var userid = $(this).val();

        
        
       //alert(userid);return false;

         $.ajax({

                url:"{{ url('get-userright-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {userid: userid},

                 success:function(returndata){
                  
                 $("#showedit").html(returndata);
                 $("#hideform").addClass('hideform');
                 $("#hideform").removeClass('showform');
                 $("#userid").val(userid);
                 if(returndata==''){
                  $("#hideform").addClass('showform');
                 }

                 var obj = JSON.parse(returndata);


                 if(obj.response=='error'){

                   //$("#showedit").addClass('hideform');
                    $("#hideform").removeClass('hideform');
                    $("#hideform").addClass('showform');
                    $("#userid").val(userid);
                    $("#username").val(userid);
                    $("#showedit").html('');
                   
                 }else{
                  $("#showedit").html('');
                  
                 }

                 
               
                   
                 }

              });


      });

     });
  </script>


   <script type="text/javascript">
     $(document).ready(function(){
      $("#username").on('change', function (){

      
        var username = $(this).val();

        if(username!=''){
          $("#user_name").val(username);
          $("#user_name1").val(username);
        }else{
          $("#user_name").val('');
          $("#user_name1").val('');
        }

       
      });




      $("#user_code").on('change', function (){

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });

        var userid = $(this).val();

        
        
      // alert(userid);return false;

         $.ajax({

                url:"{{ url('get-userright-username') }}",

                 method : "POST",

                 type: "JSON",

                 data: {userid: userid},

                 success:function(returndata){

        
                 var obj = JSON.parse(returndata);
                 //alert(obj.response);


                 if(obj.response=='success'){

                   
                    $("#username").val(obj.data);
                 //   $("#showedit").html('');
                   
                 }else if(obj.response=='error'){
                  $("#username").val('');

                 }
                   
                 }

              });


      });

     });
  </script>
   
<script type="text/javascript">
   $(document).ready(function(){

    $("#user_code11").bind('change', function () {  


          var val = $(this).val();



          var xyz = $('#Usercodelist option').filter(function() {

       //     alert(xyz);return false;



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';

          //alert(msg);return false;

        //  $("#userid").val(msg);


          document.getElementById("bankText").innerHTML = msg; 


        });

   });
</script>

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Depot Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
        html:true,
        content:  $('#myForm').html()
    }).on('click', function(){
      // had to put it within the on click action so it grabs the correct info on submit
      $('#serachcode').click(function(){

           $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });

          var HelptaxCode = $('#help_tax').val();

           if(HelptaxCode == ''){

              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-tax-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelptaxCode: HelptaxCode},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Depot Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><th>Tax Code</th><th>Tax Name</th></tr><tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.tax_code+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.tax_name+'</td></tr>');
                             });
                      }
                 }

              });
           }
      })
  })
})
</script>

<script type="text/javascript">
  $(document).ready(function(){
     $('body').on('click', '#closeModel', function () {
          $('.popover').fadeOut();
    })
  });
</script>

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#tax_code').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var tax_code = $('#tax_code').val();

        if(tax_code == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-tax-code') }}",

             method : "POST",

             type: "JSON",

             data: {tax_code: tax_code},

             success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                       var objcity = data1.data;
                       $('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.tax_code+'</span><br>');
                         });
                        
                  }
             }

          });
       }

    });

    $("body").click(function() {
        $("#showSearchCodeList").hide("fast");
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

<script>
$(document).ready(function(){

 $('.allcheckbox').multiselect({
  nonSelectedText: 'Select',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'212px',
  includeSelectAllOption: true,
  maxHeight: 150

  
 });



 $('#framework_form').on('submit', function(event){
  event.preventDefault();

  //alert('hi');return false;

   $('.overlay-spinner').removeClass('hideloader');

  var form_data = $(this).serialize();

   $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
   type: 'POST',
   url:"{{ url('/Master/Setting/save-user_right_data') }}",
   //method:"POST",
   data:form_data,
   success:function(data)
   {
    var obj = JSON.parse(data);

    if(obj.response=='success'){
      
      $('.overlay-spinner').addClass('hideloader');
          var url = "{{url('/Master/Setting/view-user-right')}}"
        setTimeout(function(){ window.location = url; });
    }
   }
  });
 });


 $('#update_form').on('submit', function(event){
  event.preventDefault();

  
  $('#loadingmessage').show();
  $("#btnsubmit").prop('disabled', true);
  $("#btncancel").prop('disabled', true);

  var form_data = $(this).serialize();

   $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
   type: 'POST',
   url:"{{ url('update-user_right_data') }}",
   //method:"POST",
   data:form_data,
   success:function(data)
   {
    var obj = JSON.parse(data);

    if(obj.response=='success'){

      $('#loadingmessage').hide();
  
          notif({
        msg: "Access Granted...! </b>",
        type: "success",
        position: "center"
      });
 setTimeout(function () { 
      window.location.href = "{{ url('/Master/Setting/view-user-right') }}";
    }, 3000);
    }else{
      $('#loadingmessage').hide();
      $("#btnsubmit").prop('disabled', false);
      $("#btncancel").prop('disabled', false);
    }
   }
  });
 });

 
 
 
 
});
</script>

@endsection