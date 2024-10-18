@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')


<style type="text/css">

  .blink_me {
  animation: blinker 1s linear infinite;
  
}

@keyframes blinker {  
  50% { opacity: 0.5; }
}

  .menutitle{
      text-align: center;
      padding-top: 1%;
      margin-bottom: 4%;
  }
  .menutitle1{
      text-align: center;
      padding-top: 2%;
      margin-bottom: -2%;
  }
  .menutext{
      font-size: 14px;
      font-weight: 800;
     /* border-bottom: 1px solid #4e9ecc;*/
      color: #4e9ecc;
      margin-left: -3PX;
  }

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

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add User Right</h2>

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


           <center> <span id="msg"></span></center>
           
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

                          
                         <!--  <input list="Usercodelist" class="form-control" id="user_code" name="user_code" value="{{old('user_code')}}" placeholder="Enter User Code" maxlength="20"> -->

                          <select class="form-control usercode" id="user_code" name="user_code"  placeholder="Enter User Code" maxlength="20">
                              <option value="">--SELECT--</option>
                             <?php foreach($user_code as $key) { ?>
                            <option value="{{ $key->USER_CODE }}" data-xyz ="<?php echo $key->USER_NAME; ?>">{{ $key->USER_NAME }}</option>
                          <?php } ?>
                            
                          </select>
                          
                         

                        </div>
                         <div class="custom-select">
                            <div id="usercode_error" style="color:red;">
                          
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

                       <!--    <input list="Usernamelist" class="form-control" name="user_name" value="{{old('user_name')}}" placeholder="Enter User Name" maxlength="30"> -->
                        <input type="text" class="form-control" name="username" id="username" readonly="" placeholder="username">
                         
                           
                          

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

              </div>
               <br>

                <div id="showedit">

              
                </div>



            <div id="hideform">
           <!--   <form method="POST" id="framework_form"  > -->

            <form method="post" action="{{ url('/Master/Setting/save-user_right_data') }}" >

               @csrf
           
              

          

                <div class="row">

                
                <div class="col-md-6">
                  <div class="form-group">

                      <label>

                       4 . All Form: 

                        <span class="required-field"></span>

                      </label>

                     
                </div>
                </div>
                <div class="col-md-6">
                   <input type="hidden" name="userid" id="userid">
                   <input type="hidden" name="user_name" id="user_name">
                  <button type="button"  class="btn btn-primary btn-sm" onclick="return getFormName();" style="width: 250px;" id="selectform" disabled="">CLICK FOR SELECT FORM</button>
                  
                  </div>
                
                
              </div> <br/>
              <!-- /.row -->


              <div class="row">
 
              <div style="text-align: center;">

                <div id='loadingmessage' style='display:none'>
                      <img src="{{ URL::asset('public/dist/img/loader/Spinner-1s-200px (1).gif') }}" class="user-image" alt="User Image" width="20%;">
                </div>
                  <input type="hidden" name="totalcount" id="totalcount">

                 <button type="Submit" class="btn btn-primary" id="submit" onclick="return validation();">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                 </button>

              </div>
              </div>


              <!-- modalmodalmodal -->

  <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

  <div class="modal-dialog modal_diloge modal-lg" role="document" >

    <div class="modal-content modal-popout-bg" style="border-radius: 7px;">

      <!-- start : header logos -->

      <div class="modal-header">

       

      <div style="text-align: center;">

        <span class="access_cont menutext">Access Control</span>

      </div>

      </div>

      <!-- end : header logos -->

     <!--  <form method="post" action="{{ url('access-control-save') }}">

        @csrf -->

        <!-- <input type="hidden" name="userid" value=""> -->

      
    


       <!-- finnace  master -->
       

        <center><span id="msg"></span></center>
        <div class="modal-body">

          <div class="row">
            <div class="col-md-12">
              <div class="col-md-4"></div>
            <div class="col-md-4">
             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                <select id="Transaction" name="Transaction" class="form-control" onchange="getTransaction(this.value)">
                <option value="">--SELECT--</option>
                <option value="All">All Form</option>
                <option value="Master">Master</option>
                <option value="Configuration">Configuration</option>
                <option value="Master Company">Company</option>
                <option value="Transaction">Transaction</option>
                <option value="Reports">Report</option>
                
                </select>
              </div>
            </div>
           </div>
           </div>
        </div>
        <div id="headingForm" class="menutext" style="border-bottom: 1px;text-align:center;text-transform: uppercase;font-size: 15px;border-bottom-style:1px solid;">All Form</div>
        <br/>

            
        <div id="appnedForm">

          
        </div>
      <!-- finnace  master -->

      <div class="modal-footer">
        <div style="text-align: center;">
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>

        </div>
      </div>


    </div>

  </div>

</div>
      
</div>      <!-- modalmodalmodal -->
              

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
    
    function getTransaction(value){

     // alert(value);return false;
      var getform =   $("#Transaction").val();


       $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });





       $.ajax({

                url:"{{ url('get-formName-getdata-filter') }}",

                 method : "POST",

                 type: "JSON",

                 data: {getform: getform},

                 success:function(data){

                  console.log(data);

                 var obj = JSON.parse(data);

                 

                 $("#appnedForm").empty();
                 $("#headingForm").empty();

                 console.log('formNmse',getform);


                 if(getform=='Transaction'){

                  $("#headingForm").append('Transaction');

                 }else if(getform=='Reports'){
                  $("#headingForm").append('Reports');

                 }else if(getform=='Master'){
                  $("#headingForm").append('Master');

                 }else if(getform=='Configuration'){
                  $("#headingForm").append('Configuration');
                 }else if(getform=='All'){
                  $("#headingForm").append('All Forms');
                 }

               
                 var heading = "<div class='row'><div class='col-md-12'><div class='col-md-4'></div><div class='col-md-2 menutext'>ADD</div><div class='col-md-2 menutext'>EDIT</div><div class='col-md-2 menutext'>DELETE</div><div class='col-md-2 menutext'>VIEW</div></div></div>";

                 $("#appnedForm").append(heading);

                 var srno =1;

                $.each(obj.data, function(k, getData) {

                        

                      var tableBody = "<div class='row'><div class='col-md-12'><div class='col-md-4'><input type='hidden' value='"+srno+"'><input class='form-check-input filtercheck' type='checkbox' value='"+getData.FORM_CODE+"_"+getData.FORM_NAME+"' id='forms_"+srno+"' name='form_name_"+srno+"' onclick='check_access("+srno+")'>&nbsp;&nbsp;<label>"+getData.FORM_NAME+" ["+getData.FORM_CODE+"]</label> </div><div class='col-md-2'><input class='form-check-input filtercheck formcehck_"+srno+"' disabled type='checkbox' value='add' id='inward_trans' name='add_"+srno+"'></div><div class='col-md-2'><input disabled class='form-check-input filtercheck formcehck_"+srno+"' type='checkbox' value='edit' id='inward_trans' name='edit_"+srno+"'></div><div class='col-md-2'><input class='form-check-input filtercheck formcehck_"+srno+"' type='checkbox' value='delete' id='inward_trans' name='delete_"+srno+"' disabled></div><div class='col-md-2'><input class='form-check-input filtercheck formcehck_"+srno+"' type='checkbox' value='view' id='inward_trans' name='view_"+srno+"' disabled></div></div></div>";
                      srno++;

                      $("#appnedForm").append(tableBody);

                    
                    
                 });
                

                   $("#totalcount").val(srno);
                 
                   $("#exampleModal1").modal();
                   
                 }

              });

    }

  </script>
  <script type="text/javascript">
    
    function getFormName(){


        var user_code =  $("#userid").val();


     //   alert($user_code);
      

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });


       $.ajax({

                url:"{{ url('get-formName-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {user_code: user_code},

                 success:function(data){

                  console.log(data);

                 var obj = JSON.parse(data);

                 $("#exampleModal1").modal();

                 $("#appnedForm").empty();

                 var heading = "<div class='row'><div class='col-md-12'><div class='col-md-4'></div><div class='col-md-2 menutext'>ADD</div><div class='col-md-2 menutext'>EDIT</div><div class='col-md-2 menutext'>DELETE</div><div class='col-md-2 menutext'>VIEW</div></div></div>";

                 $("#appnedForm").append(heading);

                 var srno =1;

                $.each(obj.data, function(k, getData) {

                 

                     var tableBody = "<div class='row'><div class='col-md-12'><div class='col-md-4'><input type='hidden' value='"+srno+"'><input class='form-check-input filtercheck' type='checkbox' value='"+getData.FORM_CODE+"_"+getData.FORM_NAME+"' id='forms_"+srno+"' name='form_name_"+srno+"' onclick='check_access("+srno+")'>&nbsp;&nbsp;<label>"+getData.FORM_NAME+" ["+getData.FORM_CODE+"]</label> </div><div class='col-md-2'><input class='form-check-input filtercheck formcehck_"+srno+"' disabled type='checkbox' value='add' id='inward_trans' name='add_"+srno+"'></div><div class='col-md-2'><input disabled class='form-check-input filtercheck formcehck_"+srno+"' type='checkbox' value='edit' id='inward_trans' name='edit_"+srno+"'></div><div class='col-md-2'><input class='form-check-input filtercheck formcehck_"+srno+"' type='checkbox' value='delete' id='inward_trans' name='delete_"+srno+"' disabled></div><div class='col-md-2'><input class='form-check-input filtercheck formcehck_"+srno+"' type='checkbox' value='view' id='inward_trans' name='view_"+srno+"' disabled></div></div></div>";
                      srno++;

                      $("#appnedForm").append(tableBody);

                    
                    
                 });
                

                   $("#totalcount").val(srno);
                 
               
                   
                 }

              });



    }
  </script>

   <script type="text/javascript">
     $(document).ready(function(){
      $("#user_code").on('change', function (){

          $("#getFormName").prop('disabled', false);
          $("#selectform").prop('disabled', false);

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });

        var userid = $(this).val();

        
        
     //  alert(userid);return false;

         $.ajax({

                url:"{{ url('get-userright-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {userid: userid},

                 success:function(returndata){

                //  console.log('return data',returndata);
                  
                 $("#showedit").html(returndata);
                 $("#hideform").addClass('hideform');
                 $("#hideform").removeClass('showform');
                 $("#userid").val(userid);
                 if(returndata==''){
                  $("#hideform").addClass('showform');
                   //$("#username").val('');
                 }

                 var obj = JSON.parse(returndata);


                 if(obj.response=='error'){
                    
                   //$("#showedit").addClass('hideform');
                    $("#hideform").removeClass('hideform');
                    $("#hideform").addClass('showform');
                    $("#userid").val(userid);
                  //  $("#username").val(userid);
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




      $(".usercode").on('change', function (){

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

                  if(returndata==''){
                    $("#username").val('');
                  }
        
                 var obj = JSON.parse(returndata);
                //alert(obj.response);return false;


                 if(obj.response=='success'){

                   
                    $("#username").val(obj.data);
                 //   $("#showedit").html('');
                   
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
  
  function validation(){

  //$('.overlay-spinner').removeClass('hideloader');

   var user_code = $("#user_code").val();

   if(user_code==''){

        $("#usercode_error").html('The user code field is required');
       // alert('enter user code');return false;
       return false;
      }else{

        $("#usercode_error").html('');
      }
 }

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


 



 $('#framework_form1').on('submit', function(event){
  event.preventDefault();

  //alert('hi');return false;
 $('.overlay-spinner').removeClass('hideloader');

     //$("#overlay").fadeIn(300);

      var user_code = $("#user_code").val();

      var count_checked = $("input[name='form_name[]']").serializeArray();
     // var user_code = $("#user_code").val();
     


      if(user_code==''){

        $("#usercode_error").html('The user code field is required');
       // alert('enter user code');return false;
       return false;
      }else if(count_checked.length==0){
        
        
           $("#msg").html('Please check atleast one').css({'color':'red','font-size':'16px'});
           return false;
         
      }else{

  var form_data = $(this).serialize();
alert(form_data);return false;

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
      //$("#btnsubmit").prop('disabled', false);
           var url = "{{url('/Master/Setting/view-user-right')}}"
        setTimeout(function(){ window.location = url; });
    }else{
      notif({
        msg: "Error...! </b>",
        type: "error",
        position: "center"
      });
      setTimeout(function () { 
      window.location.reload();
    }, 3000);

     // $("#btnsubmit").prop('disabled', false);
      // $('#loadingmessage').hide();
    }
   }
  });
}
 });


 $('#update_form1').on('submit', function(event){
  event.preventDefault();

 
   $('.overlay-spinner').removeClass('hideloader');

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
          notif({
        msg: "Access Denied...!<b>User Inactivity...! </b>",
        type: "error",
        position: "center"
      });

          $('.overlay-spinner').addClass('hideloader');
    }
    
   
   }
  });
 });
 
 
 
});
</script>

<script type="text/javascript">

  function check_access(id)
  {

          var isChecked  = $('#forms_'+id).is(':checked');
          
          //var isChecked  = $('#forms_'+id).attr('checked');

          if(isChecked){

          $('.formcehck_'+id).prop('disabled',false);

          }else{
            $('.formcehck_'+id).prop('disabled',true);
          }

  }

</script>
@endsection