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
    color: #4e9ecc;
    margin-left: -2PX;
    margin-top: -1%;
    margin-bottom: 2%;
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

.btn {
    display: inline-block;
    padding: 3px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
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

[data-tip] {
  position:relative;

}
[data-tip]:before {
  content:'';
  /* hides the tooltip when not hovered */
  display:none;
  content:'';
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid #1a1a1a; 
  position:absolute;
  top:12px;
  left:35px;
  z-index:8;
  font-size:0;
  line-height:0;
  width:0;
  height:0;
}
[data-tip]:after {
  display:none;
  content:attr(data-tip);
  position:absolute;
  top:17px;
  left:0px;
  padding:3px 3px;
  background:#1a1a1a;
  color:#fff;
  z-index:9;
  font-size: 0.75em;
  height:25px;
  line-height:18px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  white-space:nowrap;
  word-wrap:normal;
}
[data-tip]:hover:before,
[data-tip]:hover:after {
  display:block;
}
</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            User Profile Right

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Configration</a></li>

            <li class="Active"><a href="{{ URL('/master/setting/user-profie-right')}}">User Profile Right</a></li>

          </ol>

        </section>

  <section class="content">



    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> User Profile Right</h2>

              <div class="box-tools pull-right">

              <a href="{{ url('/master/setting/view-user-profile-right') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View User Profile Right</a>
              

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


<form method="post" action="{{ url('/Master/Setting/save-user-right-data') }}" >
          <div class="box-body">
             @csrf

           <center> <span id="msg"></span></center>
           
          <div class="overlay-spinner hideloader"></div>

               <div class="row">
                 
                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        User Profile Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          
                          <input type="text" class="form-control" id="user_profile_code" name="user_profile_code" value="{{$profNo}}" placeholder="Enter User Profile" maxlength="20" readonly>

                        </div>
                       
                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('user_profile_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        User Profile : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          
                          <input type="text" class="form-control" id="user_profile" name="user_profile" value="{{old('user_profile')}}" placeholder="Enter User Profile" maxlength="20" style="text-transform:uppercase">

                        </div>
                       
                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('user_profile', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-4">
                    
                    <div class="form-group">

                      <label>
                          Company : 
                          <span class="required-field"></span>
                      </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>


                         <select class="allcheckbox form-control" multiple="" id="getComp" name="getComp[]">
                          <?php foreach($comp_data as $key) { ?>
                            <option value="<?php echo $key->COMP_CODE.'_'.$key->COMP_NAME; ?>">{{ $key->COMP_CODE }} - {{ $key->COMP_NAME }}</option>

                          <?php } ?>
                         </select>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('user_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>  

                </div>


              <div style="text-align: center;">

                  <button type="button" class="btn btn-primary" id="proceedBtn" onclick="getDataFromComp(1)"> Porceed &nbsp;&nbsp;<i class="fa fa-forward" aria-hidden="true"></i></button>
                  <button type="button" class="btn btn-warning" onclick="location.reload();" id="reloadBtn" > Reload &nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i></button>

              </div>

                <div id="showedit">

              
                </div>

<style>
  .nav-tabs {
    display: inline-flex;
    width: 100%;
    overflow-x: auto;
    border-bottom: 2px solid #DDD;
    -ms-overflow-style: none; 
    overflow: -moz-scrollbars-none; 
  }
  .nav-tabs>li.active>a,
  .nav-tabs>li.active>a:focus,
  .nav-tabs>li.active>a:hover {
      border-width: 0;
  }
  .nav-tabs>li>a {
      border: none;
      color: #666;
  }
  .nav-tabs>li.active>a,
  .nav-tabs>li>a:hover {
      border: none;
      color: #4285F4 !important;
      background: transparent;
  }
  .nav-tabs>li>a::after {
      content: "";
      background: #4285F4;
      height: 2px;
      position: absolute;
      width: 100%;
      left: 0px;
      bottom: 1px;
      transition: all 250ms ease 0s;
      transform: scale(0);
  }
  .nav-tabs>li.active>a::after,
  .nav-tabs>li:hover>a::after {
      transform: scale(1);  
  }
  .tab-nav>li>a::after {
      background: #21527d none repeat scroll 0% 0%;
      color: #fff;
  }
  .tab-pane {
      padding: 15px 0;
  }
  .tab-content {
      padding: 20px
  }

  .nav-tabs::-webkit-scrollbar {
      display: none; 
  }
  .card {
      background: #FFF none repeat scroll 0% 0%;
      box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3);
      margin-bottom: 30px;
  }
  .nav-tabs {
  display: inline-flex;
  width: 100%;
  overflow-x: auto;
  border-bottom: 2px solid #DDD;
  -ms-overflow-style: none;
  overflow: -moz-scrollbars-none; 
  }
  .nav-tabs>li.active>a,
  .nav-tabs>li.active>a:focus,
  .nav-tabs>li.active>a:hover {
      border-width: 0;
  }
  .nav-tabs>li>a {
      border: none;
      color: #666;
  }
  .nav-tabs>li.active>a,
  .nav-tabs>li>a:hover {
      border: none;
      color: #4285F4 !important;
      background: transparent;
  }
  .nav-tabs>li>a::after {
      content: "";
      background: #4285F4;
      height: 2px;
      position: absolute;
      width: 100%;
      left: 0px;
      bottom: 1px;
      transition: all 250ms ease 0s;
      transform: scale(0);
  }
  .nav-tabs>li.active>a::after,
  .nav-tabs>li:hover>a::after {
      transform: scale(1);  
  }
  .tab-nav>li>a::after {
      background: #21527d none repeat scroll 0% 0%;
      color: #fff;
  }
  .tab-pane {
      padding: 15px 0;
  }
  .tab-content {
      padding: 20px
  }

  .nav-tabs::-webkit-scrollbar {
      display: none;
  }
  .card {
      border-radius: 7px;
      background: #FFF none repeat scroll 0% 0%;
      margin-bottom: 30px;
      -webkit-box-shadow: 0px 0px 13px 0px rgba(130,130,130,1);
      -moz-box-shadow: 0px 0px 9px 0px rgba(130,130,130,1);
      box-shadow: 0px 0px 9px 0px rgba(130,130,130,1);
  }
@media (min-width: 992px){
  .container {
      width: 100%;
  }
}
</style>
                <div class="row">
                  <div class="col-sm-12">

                    <div class="container" style="margin-top: 2%;">
                      <div class="row" style="border-radius: 7px;">
                          <div class="" style="border-radius: 7px;">
                              <!-- Nav tabs -->
                              <div class="card" style="border-top: 3px solid #f39c12;">
                                  <ul class="nav nav-tabs" role="tablist">
                                      <li role="presentation" class="active"><a href="#Master" aria-controls="Master" class="tabDetails" role="tab" data-toggle="tab">Master</a></li>
                                      <li role="presentation"><a href="#ProfitCenter" aria-controls="ProfitCenter" class="tabDetails" role="tab" data-toggle="tab">Profit Center</a>
                                      </li>
                                      <li role="presentation"><a href="#Plant" aria-controls="Plant" role="tab" class="tabDetails" data-toggle="tab">Plant</a>
                                      </li>
                                      <li role="presentation"><a href="#Forms" aria-controls="Forms" role="tab" class="tabDetails" data-toggle="tab">Forms</a>
                                      </li>
                                      <li role="presentation"><a href="#Transaction" aria-controls="Transaction" class="tabDetails" role="tab" data-toggle="tab">Transaction</a>
                                      </li>
                                      <li role="presentation"><a href="#Report" aria-controls="Report" role="tab" class="tabDetails" data-toggle="tab">Report</a>
                                      </li>
                                      <div style="margin-top: 1%;margin-left: 20%;" class="checkAllMune">
                                        <label for="">Select All : &nbsp;&nbsp;</label>
                                        <span><input class='form-check-input' type='checkbox' value="selectAll" onchange="checkAll(this)" disabled name="chkAll">&nbsp;&nbsp;</span>
                                      </div>
                                  </ul>
                                  <!-- Tab panes -->
                                  <div class="tab-content">

                                      <div role="tabpanel" class="tab-pane active" id="Master">
                                        <div class="row" style="margin-top:-2%;">
                                          <div class="col-md-4"></div>
                                          <div class="col-md-4">
                                            <input type="text" name="searchForm" id="searchForm" class="form-control" placeholder="Search.....">
                                          </div>
                                        </div>

                                        <div class='row' style="margin-top: 4%;">
                                          <div class='col-md-12'>
                                            <div class='col-md-8 menutext' style='text-align:center;'>
                                              SECTION
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              ADD
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              EDIT
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              DELETE
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              VIEW
                                            </div>
                                          </div>
                                        </div>
                                        <input type="hidden" name="masterFmCount" value="<?php echo count($master_form); ?>">

                                        <div id="master_data">
                                        <?php 
                                          $srNo = 1;
                                          $mCount = count($master_form);
                                          /*print_r($mCount);*/
                                          foreach ($master_form as $key){
                                        ?>
                                          <div class='row'>
                                          <div class='col-md-12'>
                                            <div class='col-md-8 headName'>
                                              <input type='hidden' value='<?php echo $srNo; ?>'>
                                              <input class='form-check-input filtercheck' type='checkbox' value='<?php echo $key->FORM_CODE.'_'.$key->FORM_NAME.'_'.$key->MENU_NAME.'_'.$key->SUBMENU_NAME.'_'.$key->FORM_LINK; ?>' id='masterNm_<?php echo $srNo; ?>' name='form_name_<?php echo $srNo; ?>' onclick='check_access(<?php echo $srNo; ?>,"masterNm_","masterChk_")'>&nbsp;&nbsp;<label data-tip="<?php echo $key->FORM_NAME; ?>"><?php echo mb_strimwidth($key->FORM_NAME, 0, 50, "...").' ['.$key->FORM_CODE.'] ' ?></label> 
                                            </div>
                                            <div class='col-md-1'>
                                              <input class='form-check-input filtercheck masterChk_<?php echo $srNo; ?>' disabled type='checkbox' value='add' id='inward_trans1' name='add_<?php echo $srNo; ?>'>
                                            </div>
                                            <div class='col-md-1'>
                                              <input disabled class='form-check-input filtercheck masterChk_<?php echo $srNo; ?>' type='checkbox' value='edit' id='inward_trans1' name='edit_<?php echo $srNo; ?>'>
                                            </div>
                                            <div class='col-md-1'>
                                              <input class='form-check-input filtercheck masterChk_<?php echo $srNo; ?>' type='checkbox' value='delete' id='inward_trans1' name='delete_<?php echo $srNo; ?>' disabled>
                                            </div>
                                            <div class='col-md-1'>
                                              <input class='form-check-input filtercheck masterChk_<?php echo $srNo; ?>' type='checkbox' value='view' id='inward_trans1' name='view_<?php echo $srNo; ?>' disabled>
                                            </div>
                                          </div>
                                        </div>
                                        <?php $srNo++; } ?>
                                       


                                        <input type="hidden" name="masterFmOneCount" value="<?php echo count($master_form_one); ?>">

                                        <?php 
                                          $srNo1 = $srNo + 1;

                                          foreach ($master_form_one as $key){

                                        ?>
                                          <div class='row'>
                                          <div class='col-md-12'>
                                            <div class='col-md-8 headName'>
                                              <input type='hidden' value='<?php echo $srNo1; ?>'>
                                              <input class='form-check-input filtercheck' type='checkbox' value='<?php echo $key->FORM_CODE.'_'.$key->FORM_NAME.'_'.$key->MENU_NAME.'_'.$key->SUBMENU_NAME.'_'.$key->FORM_LINK; ?>' id='masterNm_<?php echo $srNo1; ?>' name='form_name_<?php echo $srNo1; ?>' onclick='check_access(<?php echo $srNo1; ?>,"masterNm_","masterChk_")'>&nbsp;&nbsp;<label data-tip="<?php echo $key->FORM_NAME; ?>"><?php echo mb_strimwidth($key->FORM_NAME, 0, 50, "...").' ['.$key->FORM_CODE.'] ' ?></label> 
                                            </div>
                                            <div class='col-md-1'>
                                              <input class='form-check-input filtercheck masterChk_<?php echo $srNo1; ?>' disabled type='checkbox' value='add' id='inward_trans' name='add_<?php echo $srNo1; ?>'>
                                            </div>
                                            <div class='col-md-1'>
                                              <input disabled class='form-check-input filtercheck masterChk_<?php echo $srNo1; ?>' type='checkbox' value='edit' id='inward_trans' name='edit_<?php echo $srNo1; ?>'>
                                            </div>
                                            <div class='col-md-1'>
                                              <input class='form-check-input filtercheck masterChk_<?php echo $srNo1; ?>' type='checkbox' value='delete' id='inward_trans' name='delete_<?php echo $srNo1; ?>' disabled>
                                            </div>
                                            <div class='col-md-1'>
                                              <input class='form-check-input filtercheck masterChk_<?php echo $srNo1; ?>' type='checkbox' value='view' id='inward_trans' name='view_<?php echo $srNo1; ?>' disabled>
                                            </div>
                                          </div>
                                        </div>
                                        <?php $srNo1++; } ?>

                                      </div>

                                      <!-- <div id="mastFormData"></div> -->
                                      </div>

                                      <input type="hidden" id="pfctSrNo" value="<?php echo $srNo1;?>">
                                      
                                      <div role="tabpanel" class="tab-pane" id="ProfitCenter">
                                        
                                        <div class="row" style="margin-top:-2%;">
                                          <div class="col-md-4"></div>
                                          <div class="col-md-4">
                                            <input type="text" name="searchPfctList" id="searchPfctList" class="form-control" placeholder="Search.....">
                                          </div>
                                        </div>


                                        <div class='row' style="margin-top:4%;">
                                          <div class='col-md-12'>
                                            <div class='col-md-8 menutext' style='text-align:center;'>
                                              SECTION
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              ADD
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              EDIT
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              DELETE
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              VIEW
                                            </div>
                                          </div>
                                        </div>

                                        <div id="pfctData">
                                          <div id="pfctMsg">No Record Found...!</div>
                                        </div>

                                      </div>
                                      <div role="tabpanel" class="tab-pane" id="Plant">

                                        <div class="row" style="margin-top:-2%;">
                                          <div class="col-md-4"></div>
                                          <div class="col-md-4">
                                            <input type="text" name="searchPlantList" id="searchPlantList" class="form-control" placeholder="Search.....">
                                          </div>
                                        </div>

                                        <div class='row' style="margin-top: 4%;">
                                          <div class='col-md-12'>
                                            <div class='col-md-8 menutext' style='text-align:center;'>
                                              SECTION
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              ADD
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              EDIT
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              DELETE
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              VIEW
                                            </div>
                                          </div>
                                        </div>
                                        <div id="plantData">
                                          <div id="plantMsg">No Record Found...!</div>
                                        </div>
                                      </div>

                                      <div role="tabpanel" class="tab-pane" id="Forms">

                                        <div class="row" style="margin-top:-2%;">
                                          <div class="col-md-4"></div>
                                          <div class="col-md-4">
                                            <input type="text" name="searchFormList" id="searchFormList" class="form-control" placeholder="Search.....">
                                          </div>
                                        </div>

                                        <div class='row' style="margin-top:4%;">
                                          <div class='col-md-12'>
                                            <div class='col-md-8 menutext' style='text-align:center;'>
                                              SECTION
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              ADD
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              EDIT
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              DELETE
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              VIEW
                                            </div>
                                          </div>
                                        </div>

                                        
                                        <div id="form_data">
                                        <?php 
                                          $srNo5 = 11111;
                                          $formCount = count($form_list);
                                          /*print_r($formCount);*/
                                          foreach ($form_list as $key){
                                        ?>
                                          <div class='row'>
                                          <div class='col-md-12'>
                                            <div class='col-md-8 headName'>
                                              <input type='hidden' value='<?php echo $srNo5; ?>'>
                                              <input class='form-check-input filtercheck' type='checkbox' value='<?php echo $key->FORM_CODE.'_'.$key->FORM_NAME.'_'.$key->MENU_NAME.'_'.$key->SUBMENU_NAME.'_'.$key->FORM_LINK; ?>' id='formNm_<?php echo $srNo5; ?>' name='form_name_<?php echo $srNo5; ?>' onclick='check_access(<?php echo $srNo5; ?>,"formNm_","formChk_")'>&nbsp;&nbsp;<label data-tip="<?php echo $key->FORM_NAME; ?>"><?php echo mb_strimwidth($key->FORM_NAME, 0, 50, "...").' ['.$key->FORM_CODE.'] ' ?></label> 
                                            </div>
                                            <div class='col-md-1'>
                                              <input class='form-check-input filtercheck formChk_<?php echo $srNo5; ?>' disabled type='checkbox' value='add' id='inward_trans' name='add_<?php echo $srNo5; ?>'>
                                            </div>
                                            <div class='col-md-1'>
                                              <input disabled class='form-check-input filtercheck formChk_<?php echo $srNo5; ?>' type='checkbox' value='edit' id='inward_trans' name='edit_<?php echo $srNo5; ?>'>
                                            </div>
                                            <div class='col-md-1'>
                                              <input class='form-check-input filtercheck formChk_<?php echo $srNo5; ?>' type='checkbox' value='delete' id='inward_trans' name='delete_<?php echo $srNo5; ?>' disabled>
                                            </div>
                                            <div class='col-md-1'>
                                              <input class='form-check-input filtercheck formChk_<?php echo $srNo5; ?>' type='checkbox' value='view' id='inward_trans' name='view_<?php echo $srNo5; ?>' disabled>
                                            </div>
                                          </div>
                                        </div>
                                        <?php $srNo5++; } ?>

                                        <input type="hidden" name="formNmCount" value="<?php echo $srNo5; ?>">

                                      </div>
                                      </div>
                                      <input type="hidden" id="tranSrNo" value="<?php echo $srNo5;?>">

                                      <div role="tabpanel" class="tab-pane" id="Transaction">

                                        <div class="row" style="margin-top:-2%;">
                                          <div class="col-md-4"></div>
                                          <div class="col-md-4">
                                            <input type="text" name="searchTranList" id="searchTranList" class="form-control" placeholder="Search.....">
                                          </div>
                                        </div>

                                        <div class='row' style="margin-top:4%;">
                                          <div class='col-md-12'>
                                            <div class='col-md-8 menutext' style='text-align:center;'>
                                              SECTION
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              ADD
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              EDIT
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              DELETE
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              VIEW
                                            </div>
                                          </div>
                                        </div>

                                        <div id="tranData">
                                          <div id="tranMsg">No Record Found...!</div>
                                        </div>
                                      </div>
                                      <div role="tabpanel" class="tab-pane" id="Report">

                                          <div class="row" style="margin-top:-2%;">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                              <input type="text" name="searchReportList" id="searchReportList" class="form-control" placeholder="Search.....">
                                            </div>
                                          </div>
                                          
                                          <div class='row' style="margin-top: 4%;">
                                          <div class='col-md-12'>
                                            <div class='col-md-8 menutext' style='text-align:center;'>
                                              SECTION
                                            </div>
                                            <!-- <div class='col-md-1 menutext'>
                                              ADD
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              EDIT
                                            </div>
                                            <div class='col-md-1 menutext'>
                                              DELETE
                                            </div> -->
                                            <div class='col-md-1 menutext'>
                                              VIEW
                                            </div>
                                          </div>
                                        </div>

                                        <div id="report_data">
                                        <?php 
                                          $srNo7 = 99999;
                                          $reportCount = count($report_form);
                                          //print_r($reportCount);
                                          foreach ($report_form as $key){
                                        ?>
                                          <div class='row'>
                                          <div class='col-md-12'>
                                            <div class='col-md-8 headName'>
                                              <input type='hidden' value='<?php echo $srNo7; ?>'>
                                              <input class='form-check-input filtercheck' type='checkbox' value='<?php echo $key->FORM_CODE.'_'.$key->FORM_NAME.'_'.$key->MENU_NAME.'_'.$key->SUBMENU_NAME.'_'.$key->FORM_LINK; ?>' id='reportNm_<?php echo $srNo7; ?>' name='form_name_<?php echo $srNo7; ?>' onclick='check_access(<?php echo $srNo7; ?>,"reportNm_","reportChk_")'>&nbsp;&nbsp;<label data-tip="<?php echo $key->FORM_NAME; ?>"><?php echo mb_strimwidth($key->FORM_NAME, 0, 50, "...").' ['.$key->FORM_CODE.'] ' ?></label> 
                                            </div>
                                            <!-- <div class='col-md-1'>
                                              <input class='form-check-input filtercheck reportChk1_<?php echo $srNo7; ?>' disabled type='checkbox' value='add' id='inward_trans1' name='add_<?php echo $srNo7; ?>'>
                                            </div>
                                            <div class='col-md-1'>
                                              <input disabled class='form-check-input filtercheck reportChk1_<?php echo $srNo7; ?>' type='checkbox' value='edit' id='inward_trans1' name='edit_<?php echo $srNo7; ?>'>
                                            </div>
                                            <div class='col-md-1'>
                                              <input class='form-check-input filtercheck reportChk1_<?php echo $srNo7; ?>' type='checkbox' value='delete' id='inward_trans1' name='delete_<?php echo $srNo7; ?>' disabled>
                                            </div> -->
                                            <div class='col-md-1'>
                                              <input class='form-check-input filtercheck reportChk_<?php echo $srNo7; ?>' type='checkbox' value='view' id='inward_trans' name='view_<?php echo $srNo7; ?>' disabled>
                                            </div>
                                          </div>
                                        </div>
                                        <?php $srNo7++; } ?>
                                        <input type="hidden" name="reportNmCount" value="<?php echo $srNo7; ?>">
                                      </div></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>  

                    
                  </div>
                </div>

                <div class="row">
 
                  <div style="text-align: center;">
                      
                      <input type="hidden" name="totalcount" id="totalcount">

                      <button type="Submit" class="btn btn-primary" id="submit" onclick="return validation();">

                        <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                      </button>

                  </div>

                </div>


            </div><!-- /.box-body -->

          </div>

      </div>
     

      </div>

    </div>

  </section>

</div>

 <!-- ******* START: Other Rights Modal ******* -->

  <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">

    <div class="modal-dialog modal_diloge modal-lg" role="document" >

      <div class="modal-content modal-popout-bg" style="border-radius: 7px;">

        <!-- start : header logos -->

        <div class="modal-header">

        <div style="text-align: center;">

          <span class="access_cont menutext">Access Control</span>

        </div>

        </div>
         
         
        <div class="modal-body">

          

        
          <div class="modal-footer">
            <div style="text-align: center;">
            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>

            </div>
          </div>


        </div>

      </div>

    </div>
      
</div>      

<!-- ******* END: Other Rights Modal ******* -->
</form>


@include('admin.include.footer')



<script type="text/javascript">
  $(document).ready(function(){
     $('body').on('click', '#closeModel', function () {
          $('.popover').fadeOut();
    });
     $('.tabDetails').on('click',function(){
      $('#searchPfctList,#searchReportList,#searchTranList,#searchFormList,#searchPlantList,#searchForm').val('');

      var value = $('#searchForm,#searchPfctList,#searchPlantList,#searchFormList,#searchTranList,#searchReportList').val().toLowerCase();
      if(value==''){

        $("#master_data .row,#pfctData .row,#form_data .row,#plantData .row,#tranData .row,#report_data .row").css({
          display: '',
        })
       
      }
      

     });
  });

</script>

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
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

  //var current_tab = $("#tabs .ui-state-active a").attr('href');
 // console.log('current_tab',current_tab);

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

$("#searchForm").on("keyup", function () {

   var value = $(this).val().toLowerCase();
    $("#master_data .row").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#searchPfctList").on("keyup", function () {
   var value = $(this).val().toLowerCase();
    $("#pfctData .row").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#searchPlantList").on("keyup", function () {
   var value = $(this).val().toLowerCase();
    $("#plantData .row").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#searchFormList").on("keyup", function () {
   var value = $(this).val().toLowerCase();
    $("#form_data .row").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#searchTranList").on("keyup", function () {
   var value = $(this).val().toLowerCase();
    $("#tranData .row").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#searchReportList").on("keyup", function () {
   var value = $(this).val().toLowerCase();
    $("#report_data .row").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});


 



 // $("#searchForm").on("keyup", function () {

 //  if (this.value.length > 0){

 //    // search_form = $('#searchForm').val();
 //    search_form = this.value;


  // }

    // console.log('search_data', search_form);

    // $('#master_data').hide();

    // $.ajaxSetup({
          
    //   headers: {
    //   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //   }
        
    // });

//     $.ajax({
        
//       url:"{{ url('/get-listof-form') }}",

//       method:"post",
      
//       data: {search_form:search_form},
      
//       success:function(data){

//         var obj = JSON.parse(data);

//         var formdata_len = obj.form_list.length;
//         console.log('obj',obj.form_list);
//         console.log('formdata_len',formdata_len);

//         if(formdata_len > 0){

//           var srNo = 1;

//           var nmFirst     = 'masterNm_';
//           var nmSecond    = 'masterChk_';
//           var menuName    = 'System';
//           var submenuName = 'Setting';
//           var formLink    = 'profict-center';

//             $("#mastFormData").empty();

//            $.each(obj.form_list, function(k, getData) {
//             console.log('from name',getData.FORM_NAME);

//             var body_data = "<div class='row'><div class='col-md-12'><div class='col-md-8 headName'><input type='hidden' value='"+srNo+"'><input class='form-check-input filtercheck' type='checkbox' value='"+getData.FORM_CODE+"_"+getData.FORM_NAME+"_"+getData.MENU_NAME+"_"+getData.SUBMENU_NAME+"_"+getData.FORM_LINK+"' >&nbsp;&nbsp;<label data-tip="+getData.FORM_NAME+">"+getData.FORM_NAME+"</label></div></div></div> </div>";
         
//             $("#mastFormData").append(body_data);

//             srNo++;
//            });
        
//         }else{

//         }


//       }
//     })

//   }else{
//     $('#master_data').show();
//   }

  
// })
</script>

<script>
$(document).ready(function(){

 $('.allcheckbox').multiselect({
  nonSelectedText: '...Select Company...',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'100%',
  includeSelectAllOption: true,
  maxHeight: 150

  
 });


 
 $('.headName input[type=checkbox]').prop("disabled",true);

 $('#proceedBtn').on('click', function(event){

  $('#proceedBtn').prop("disabled",true);

  var usrPrf = $('#user_profile').val();

  var getComp = $('#getComp').val();

  console.log('proceedbtn click...!',usrPrf);

  if(usrPrf!='' && getComp!=''){
    
    $('#user_profile').prop("readonly",true);
    $('#getComp').prop("readonly",true);

    $('.headName input[type=checkbox]').prop("disabled",false);
    $('.checkAllMune input[type=checkbox]').prop("disabled",false);

  }else{

    $('#user_profile').prop("readonly",false);
    $('#getComp').prop("readonly",false);
    $('.headName input[type=checkbox]').prop("disabled",true);
    $('.checkAllMune input[type=checkbox]').prop("disabled",true);

  }



 });
 
});
</script>

<script type="text/javascript">

  $(document).ready(function(){

     $('.allcheckbox').multiselect({
      nonSelectedText: 'Select',
      enableFiltering: true,
      enableCaseInsensitiveFiltering: true,
      buttonWidth:'100%',
      includeSelectAllOption: true,
      maxHeight: 200
     });

  });


  function checkAll(ele) {
     var checkboxes = document.getElementsByTagName('input');
     // console.log('ele.checked',ele.checked);
     if (ele.checked) {
         for (var i = 0; i < checkboxes.length; i++) {
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = true;
                 checkboxes[i].disabled = false;

             }
         }
     } else {
      // console.log('ch');
         for (var i = 0; i < checkboxes.length; i++) {
             console.log(i)
             if (checkboxes[i].type == 'checkbox') {
                 checkboxes[i].checked = false;
                 checkboxes[i].disabled = false;
             }
         }
     }
 }

  function check_access(id,formsID,formcehckID){

    console.log('id',id);
    console.log('formsID',formsID);
    console.log('formcehckID',formcehckID);


    var isChecked  = $('#'+formsID+id).is(':checked');

    if(isChecked){

      $('.'+formcehckID+id).prop('disabled',false);

    }else{

      var subCheckBox = $('.'+formcehckID+id).is(':checked');

      if(subCheckBox){

        $('.'+formcehckID+id).prop('checked', false);
        $('.'+formcehckID+id).prop('disabled',true);

      }else{

        $('.'+formcehckID+id).prop('disabled',true);
      }
      
    }


  }



    function getDataFromComp(value){

      var getComp = $("#getComp").val();

      console.log('comp',getComp);

        $('#user_profile').prop('readonly',true);
        $('#getComp').prop('readonly',true);

        $.ajaxSetup({

          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }

        });


      $.ajax({

         url:"{{ url('get-listof-data-fromComp') }}",

         method : "POST",

         type: "JSON",

         data: {getComp: getComp},

         success:function(data){
        
           var obj = JSON.parse(data);

           console.log('obj',obj.config_list);

           $("#pfctData").empty();
           $("#plantData").empty();
           $("#tranData").empty();
           
      
          var getPfctSr    = $('#pfctSrNo').val();

          var srno         = parseInt(getPfctSr);

          var getPfctLen   = obj.pfct_list.length;

          var getPlantLen  = obj.plant_list.length;

          var getConfigLen = obj.config_list.length;

          if (getPfctLen>0) {

            $.each(obj.pfct_list, function(k, getData) {

              $('#pfctMsg').css('display','none');
          
              if(getData.COMP_NAME!=''){

                var compNm = getData.COMP_CODE.slice(0, 10)+'...';

              }else{

                var compNm = '';

              }

              var nmFirst     = 'pfctInp_';
              var nmSecond    = 'pfctChk_';
              var menuName    = 'System';
              var submenuName = 'Setting';
              var formLink    = 'profict-center';

              var tabBody1 = "<input type='hidden' name='pfctNmCount' value='"+getPfctLen+"'><div class='row'><div class='col-md-12'><div class='col-md-8 headName'><input type='hidden' value='"+srno+"'><input class='form-check-input filtercheck' type='checkbox' value='"+getData.PFCT_CODE+"_"+getData.PFCT_NAME+"_"+menuName+"_"+submenuName+"_"+formLink+"' id='pfctInp_"+srno+"' name='form_name_"+srno+"' onclick='check_access("+srno+",\""+nmFirst+"\",\""+nmSecond+"\")'>&nbsp;&nbsp;<label data-tip='"+getData.PFCT_NAME+"'>"+getData.PFCT_NAME+" [ "+getData.PFCT_CODE+" ] [ "+getData.COMP_CODE+" ] [ "+compNm+" ]</label></div><div class='col-md-1'><input class='form-check-input filtercheck pfctChk_"+srno+"' disabled type='checkbox' value='add' id='inward_trans' name='add_"+srno+"'></div><div class='col-md-1'><input disabled class='form-check-input filtercheck pfctChk_"+srno+"' type='checkbox' value='edit' id='inward_trans' name='edit_"+srno+"'></div><div class='col-md-1'><input class='form-check-input filtercheck pfctChk_"+srno+"' type='checkbox' value='delete' id='inward_trans' name='delete_"+srno+"' disabled></div><div class='col-md-1'><input class='form-check-input filtercheck pfctChk_"+srno+"' type='checkbox' value='view' id='inward_trans' name='view_"+srno+"' disabled></div></div></div>";
                  srno++;

                $("#pfctData").append(tabBody1);
               
                
            });

          }else{

            var tabBody1 = "<br><br><br><br><b style='color:#f12020;margin-left: 40%;'>No Data Found...!<b>";

            $("#pfctData").append(tabBody1);

          }


          if (getPlantLen>0) {

            $.each(obj.plant_list, function(k, getData) {

              $('#plantMsg').css('display','none');
             

              if(getData.COMP_NAME!=''){

                var compNm = getData.COMP_CODE.slice(0, 10)+'...';

              }else{

                var compNm = '';

              }

              var nmFirst     = 'plantInp_';
              var nmSecond    = 'plantChk_';
              var menuName    = 'System';
              var submenuName = 'Setting';
              var formLink    = 'plant-code';

              var tabBody0 = "<input type='hidden' name='plantNmCount' value='"+getPlantLen+"'><div class='row'><div class='col-md-12'><div class='col-md-8 headName'><input type='hidden' value='"+srno+"' id='plantLen'><input class='form-check-input filtercheck' type='checkbox' value='"+getData.PLANT_CODE+"_"+getData.PLANT_NAME+"_"+menuName+"_"+submenuName+"_"+formLink+"' id='plantInp_"+srno+"' name='form_name_"+srno+"' onclick='check_access("+srno+",\""+nmFirst+"\",\""+nmSecond+"\")'>&nbsp;&nbsp;<label data-tip='"+getData.PLANT_NAME+"'>"+getData.PLANT_NAME+" ["+getData.PLANT_CODE+"] [ "+getData.COMP_CODE+" ] [ "+compNm+" ]</label></div><div class='col-md-1'><input class='form-check-input filtercheck plantChk_"+srno+"' disabled type='checkbox' value='add' id='inward_trans' name='add_"+srno+"'></div><div class='col-md-1'><input disabled class='form-check-input filtercheck plantChk_"+srno+"' type='checkbox' value='edit' id='inward_trans' name='edit_"+srno+"'></div><div class='col-md-1'><input class='form-check-input filtercheck plantChk_"+srno+"' type='checkbox' value='delete' id='inward_trans' name='delete_"+srno+"' disabled></div><div class='col-md-1'><input class='form-check-input filtercheck plantChk_"+srno+"' type='checkbox' value='view' id='inward_trans' name='view_"+srno+"' disabled></div></div></div>";
                  srno++;

                $("#plantData").append(tabBody0);
                
                srno++;
                
            });

          }else{

            var tabBody01 = "<br><br><br><br><b style='color:#f12020;margin-left: 40%;'>No Data Found...!<b>";

            $("#plantData").append(tabBody01);

          }

          
          if (getConfigLen>0) {

            $.each(obj.config_list, function(k, getData) {

               $('#tranMsg').css('display','none');

              if(getData.COMP_NAME!=''){

                // var compNm = getData.COMP_CODE.slice(0, 10)+'...';
                var compNm = getData.COMP_CODE;

              }else{

                var compNm = '';

              }

              var nmFirst     = 'tCode_';
              var nmSecond    = 'tCodeChk_';
              var menuName    = 'Financial Accounting';
              var submenuName = 'Transaction';
              var formLink    = 'Transaction';

              var tabBody01 = "<input type='hidden' name='tranNmCount' value='"+getConfigLen+"'><div class='row'><div class='col-md-12'><div class='col-md-8 headName'><input type='hidden' value='"+srno+"'><input class='form-check-input filtercheck' type='checkbox' value='"+getData.TRAN_CODE+"_"+getData.TRAN_HEAD+"_"+menuName+"_"+submenuName+"_"+formLink+"_"+getData.SERIES_NAME+"_"+getData.SERIES_CODE+"' id='tCode_"+srno+"' name='form_name_"+srno+"' onclick='check_access("+srno+",\""+nmFirst+"\",\""+nmSecond+"\")'>&nbsp;&nbsp;<label data-tip='"+getData.TRAN_HEAD+"'>"+getData.TRAN_HEAD+" ["+getData.TRAN_CODE+"] - ["+getData.SERIES_NAME+" ] [ "+getData.COMP_CODE+" ] [ "+compNm+" ]</label></div><div class='col-md-1'><input class='form-check-input filtercheck tCodeChk_"+srno+"' disabled type='checkbox' value='add' id='inward_trans' name='add_"+srno+"'></div><div class='col-md-1'><input disabled class='form-check-input filtercheck tCodeChk_"+srno+"' type='checkbox' value='edit' id='inward_trans' name='edit_"+srno+"'></div><div class='col-md-1'><input class='form-check-input filtercheck tCodeChk_"+srno+"' type='checkbox' value='delete' id='inward_trans' name='delete_"+srno+"' disabled></div><div class='col-md-1'><input class='form-check-input filtercheck tCodeChk_"+srno+"' type='checkbox' value='view' id='inward_trans' name='view_"+srno+"' disabled></div></div></div>";
                  srno++;

                $("#tranData").append(tabBody01);
                
                srno++;
                
            });

          }else{

            var tabBody02 = "<br><br><br><br><b style='color:#f12020;margin-left: 40%;'>No Data Found...!<b>";

            $("#tranData").append(tabBody02);

          }
        
           
         }

      });

    }

</script>
@endsection