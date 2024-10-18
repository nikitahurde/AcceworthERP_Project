@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')


<style type="text/css">

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
      font-size: 19px;
      font-weight: 800;
      border-bottom: 1px solid #4e9ecc;
      color: #4e9ecc;
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

      <h1>Master Employee Position Activity

        <?php if($button=='Save') { ?>
        <small>Add Details</small>
          <?php } else { ?>
        <small>Update Details</small>
        <?php } ?>

      </h1>

      <ol class="breadcrumb">

       <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

       <li><a href="{{ URL('/dashboard')}}">Master</a></li>
      
       <?php if($button=='Save') { ?>

       <li class="Active"><a href="{{ URL('/Master/Employee/Emp-Position-Activity-Mast')}}">Master Employee Position Activity</a></li>

       <li class="Active"><a href="{{ URL('/Master/Employee/Emp-Position-Activity-Mast')}}">Add Employee Position Activity</a></li>

       <?php } else { ?>

       <li class="Active"><a href="#">Master Employee Position Activity</a></li>

       <li class="Active"><a href="#">Update Employee Position Activity</a></li>

       <?php } ?>
          
      </ol>

  </section>

  <section class="content">
    
    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-10">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <?php if($button=='Save') { ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Employee Position Activity</h2>
              
               <?php } else{  ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Employee Position Activity</h2>

              <?php } ?>

              <div class="box-tools pull-right hideinmobile">

                <a href="{{ url('/Master/Employee/View-Emp-Position-Activity-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Position Activity</a>

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


            <?php /*echo "<PRE>"; print_r($mulActivityCode);*/ ?>

            <form action="{{ url($action) }}" method="POST" >

             @csrf
              
              <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                       <label>Position Code : 

                        <span class="required-field"></span>

                       </label>

                       <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input list="positionList" type='textbox' id='position_code' class="form-control" name="position_code" value="{{$position_code}}" autocomplete="off">
                                   
                      <datalist id='positionList'>
                        
                        <option selected='selected' value=''>-- Select --</option>

                            @foreach ($position_list as $key)
                              <option value='<?php echo $key->POSITION_CODE?>' data-xyz ='<?php echo $key->POSITION_NAME; ?>' >{{$key->POSITION_NAME}} 
                                        
                            </option>
                        @endforeach
                      </datalist>

                     

                       </div>

                       <small id="emailHelp" class="form-text text-muted">
                        
                        {!! $errors->first('position_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>
                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                       <label>Position Name : 

                        <span class="required-field"></span>

                       </label>

                       <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                        <input type="text" class="form-control" id="pos_name" name="pos_name" value="{{$position_name}}" readonly>
                      </div>

                       <small id="emailHelp" class="form-text text-muted">
                        
                        {!! $errors->first('position_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>
                    </div>

                  </div>

                  <div class="col-md-5">
                    
                    <div class="form-group">

                      <label>Multiple Activity Code : 

                        <span class="required-field"></span>

                      </label>
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <?php if($button=='Save') { ?>

                        <select class="allcheckbox form-control" multiple="" name="mult_activity_code[]">

                            <?php foreach($activity_list as $key) { ?>
                            <option value="{{ $key->ACTIVITY_CODE }}">{{ $key->ACTIVITY_CODE }} ({{ $key->ACTIVITY_NAME }})
                            </option>

                          <?php } ?>
                        </select>
                        <?php } ?>

                        <?php if($button=='Update') { ?>

                        <select class="allcheckbox form-control " multiple="" name="mult_activity_code[]">

                          <?php foreach($activity_list as $key) { ?>
                            
                            <option  <?php if(in_array($key->ACTIVITY_CODE,$mulActivityCode)){echo 'selected';} ?> value="{{ $key->ACTIVITY_CODE }}">{{ $key->ACTIVITY_NAME }} ({{ $key->ACTIVITY_NAME }})
                            </option>

                        <?php } ?>  
                        </select>
                        <?php  }?>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('mult_activity_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                  </div>
              </div>

              <div class="row">
              
              <div class="col-md-4">

                <?php if($button=='Update') { ?>

                <label> Position Activity Block :</label>

                <div class="input-group">

                  <input type="radio" class="form-check-input" name="positionAct_block" value="YES" <?php if($positionAct_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;<label class="form-check-label" for="radio1">YES</label>&nbsp;&nbsp;&nbsp;


                  <input type="radio" class="form-check-input" name="positionAct_block" value="NO" <?php if($positionAct_block=='NO'){ echo 'checked';} else{ echo '';} ?> >&nbsp;&nbsp;&nbsp;<label class="form-check-label" for="radio1">NO</label>


                </div>

                <?php } ?>

              </div>

            </div>


            <div style="text-align: center;margin-top:10px;">

              <button type="Submit" class="btn btn-primary">
                
              <input type="hidden" name="posAct_code" value="{{ $position_code }}">

              <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 

              </button>

            </div>

          </form>
      
      </div><!-- /.box-body -->

      </div>

      </div>

      <!-- <div class="col-sm-3">

        <div class="box-tools pull-right hideinmobile">

          <a href="{{ url('/Master/Employee/View-Emp-Position-Activity-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Position Activity</a>

        </div>

      </div> -->
    
    </div>

  </section>

</div>



@include('admin.include.footer')

<script>

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

$(document).ready(function(){

 $('.allcheckbox').multiselect({
  nonSelectedText: 'Select',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'212px',
  includeSelectAllOption: true,
  maxHeight: 150
 
 });

 
});

$("#position_code").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#positionList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

      $('#position_code').val('');
      $('#pos_name').val('');

    }
    else{
      $('#pos_name').val(msg);
    }
});

</script>

@endsection