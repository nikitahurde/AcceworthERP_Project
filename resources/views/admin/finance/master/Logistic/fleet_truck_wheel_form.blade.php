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

 .required-field::before {

    content: "*";

    color: red;

  }

  .Custom-Box {

    /*border: 1px solid #e0dcdc;

    border-radius: 10px;

*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }
   .setheightinput{
    height: 0%;
  }
  .nameheading{
    font-size: 12px;
  }
  .setetxtintd{
    font-size: 12px !important;
    padding-top: 2% !important;
    padding-bottom: 2% !important;
  }

  .beforhidetble{
    display: none;
  }

 .custom-options {
     position: absolute;
     display: block;
     top: 100%;
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
.CloseListDepot{
  display: none;
}
.popover{
    left: 2.4922px!important;
    width: 169%!important;
}
.showinmobile{
  display: none;
}
 @media screen and (max-width: 600px) {

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

            Master Fleet Wheel Type

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/form-fleet-truck-wheel')}}">Master Fleet Wheel Type</a></li>

            <li class="Active"><a href="{{ URL('/form-fleet-truck-wheel')}}">Add Fleet Wheel Type </a></li>

          </ol>

        </section>

       <form action="{{ url('fleet-truck-wheel-save') }}" method="POST" >

        @csrf

        <section class="content">

          <div class="row">

            <div class="col-sm-2"></div>

            <div class="col-sm-7">

              <div class="box box-primary Custom-Box">

                  <div class="box-header with-border" style="text-align: center;">

                    <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Fleet Wheel Type</h2>

                    
                      <div class="box-tools pull-right showinmobile">

                        <a href="{{ url('/view-flet-truck-wheel') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fleet Wheel Type</a>

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

                 

                     <div class="row">

                      

                          <div class="col-md-6">

                          <div class="form-group">

                            <label>

                              Wheel Code : 

                              <span class="required-field"></span>

                            </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                <input type="text" class="form-control" name="wheel_code" value="{{old('wheel_code')}}" placeholder="Enter Wheel Code" id="whelcodSearch" maxlength="4" autocomplete="off">

                                <div class="custom-select">
                                  <div id="showSearchCodeList" class="custom-options">
                                
                                  </div>  
                                </div>

                                <span class="input-group-addon" style="padding: 5px;">

                                  <div class="">
                                      <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true"></i></button>
                                  </div>

                                  <div id="myForm" class="hide">
                                       <div class="row">
                                            <div class="col-md-9">
                                              <input type="text" name="WheelNameH" id="WheelNameH" class="form-control input-md setheightinput" oninput="this.value = this.value.toUpperCase()">
                                            </div>
                                            <div class="col-md-3" style="margin-left: -7%;">
                                              
                                              <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                            </div>
                                          </div>
                                      <div id="result">
                                      <table class="table table-bordered" style="margin-top: 3%;" id="HideWhenSearch">
                                        <thead>
                                          <tr>
                                           <th class="nameheading">Wheel Code</th>
                                           <th class="nameheading">Wheel Name</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach ($help_Twheel_list as $keys) { ?>

                                            <tr>
                                              <td class="setetxtintd"><?php echo $keys->WHEEL_CODE; ?></td>
                                              <td class="setetxtintd"><?php echo $keys->WHEEL_NAME; ?></td>
                                            </tr>
                                           
                                          <?php } ?>
                                            
                                        </tbody>
                                      </table>

                                      <table class="table table-bordered beforhidetble" style="margin-top: 3%;" id="ShowWhenSeaech">
                                        <thead>
                                          <tr>
                                           <th class="nameheading">Wheel Code</th>
                                           <th class="nameheading">Wheel Name</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          
                                        </tbody>
                                      </table>
                                      <span id="errorItem"></span>

                                  </div>
                                  </div>

                                </span>

                              </div>

                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('wheel_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>



                          </div>

                          <!-- /.form-group -->

                        </div>



                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                             Wheel Name: 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="wheel_name" value="{{old('wheel_name')}}" placeholder="Enter Wheel Name" maxlength="30" autocomplete="off">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('wheel_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>



                        

                    </div>

                    <!-- /.row -->



                </div><!-- /.box-body -->

                 

                </div>

            </div>

            <div class="col-sm-3 hideinmobile">

              <div class="box-tools pull-right">

                <a href="{{ url('/view-flet-truck-wheel') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fleet Wheel Type</a>

              </div>

            </div>



          </div>

           

        </section>

        <section class="content" style="margin-top: -84px !important;">

          <div class="row">

            <div class="col-sm-1"></div>

            <div class="col-sm-10">

              <div class="box box-warning Custom-Box">

                  <div class="box-header with-border">

                  <div class="box-body">

                     <div class="row">


                        <div class="col-md-3">

                          <div class="form-group">

                            <label>

                             HEAD

                              <span class="required-field"></span>

                            </label>

                            <?php for ($i=1; $i < 8; $i++) { ?>
                            
                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                                <input list="indList<?= $i ?>" class="form-control" name="indicator[]" id="indicator<?= $i ?>"  placeholder="Enter  Indicator"  oninput="this.value = this.value.toUpperCase()" onchange="indChange(<?= $i ?>)" autocomplete="off">

                                <datalist id="indList<?= $i ?>">

                                 <option value="JALPANI">JALPANI</option>
                                  <option value="FOODING">FOODING</option>
                                  <option value="U/L">U/L</option>
                                  <option value="ADMIN">ADMIN</option>
                                  <option value="DESIEL">DESIEL</option>
                                  <option value="HOLTING">HOLTING</option>
                                  <option value="OTHER">OTHER</option>
                                 
                                </datalist>

                              </div>
                               <small id="indicatorerr" style="color:red;"></small>
                                <br>
                             <?php } ?>
                             

                               <div class="custom-select">
                                  <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                                
                                  </div>  
                              </div>

                                <small id="emailHelp" class="form-text text-muted">

                                  {!! $errors->first('truck_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>



                          </div>

                          <!-- /.form-group -->

                        </div>



                        <div class="col-md-2">

                          <div class="form-group">

                            <label>

                             INDEX 

                              <span class="required-field"></span>

                            </label>


                            <?php for ($j=1; $j < 8; $j++) {  ?>
                            
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                <input list="indexList<?= $j ?>" class="form-control  rdate" name="index[]" id="index<?= $j ?>"  value="" placeholder="Enter Index"/ autocomplete="off">

                                    <datalist id="indexList<?= $j ?>">
                                  
                                     <option value="L">L</option>
                                     <option value="R">R</option>

                                    </datalist>



                            </div>
                            <small id="indexerr" style="color:red;"></small>
                            <br>

                          <?php } ?>

                             

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>


                        <div class="col-md-2">

                          <div class="form-group">

                            <label>

                             RATE 

                              <span class="required-field"></span>

                            </label>

                            <?php for ($k=1; $k < 8; $k++) {  ?>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-money"></i></span>

                                <input type="text" class="form-control  rdate" name="rate[]"  value="" placeholder="Enter Rate" id="rate<?= $k ?>" autocomplete="off"/>


                            </div>

                             <small id="rateerr" style="color:red;"></small>
                            <br>

                          <?php } ?>

                             

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>



                         <div class="col-md-3">

                          <div class="form-group">

                            <label>

                             GL CODE

                              <span class="required-field"></span>

                            </label>


                             <?php for ($m=1; $m < 8; $m++) {  ?>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                <input list="glCodeList<?= $m ?>" class="form-control  rdate" name="gl_code[]"  value="{{ old('regd_date') }}" id="gl_code<?= $m ?>" placeholder="Enter Gl Code" maxlength="10" autocomplete="off"/>


                                <datalist id="glCodeList<?= $m ?>">
                                  
                                  <?php foreach($gl_list as $key) { ?>

                                         <option value="<?= $key->GL_CODE ?>" data-xyz="<?= $key->GL_NAME ?>"><?= $key->GL_CODE ?><?= $key->GL_NAME ?></option>

                                      <?php   } ?>

                                </datalist>


                            </div>
                            <small id="gl_codeerr" style="color:red;"></small>
                            <br>

                          <?php } ?>


                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>



                        
                        <div class="col-md-2">

                          <div class="form-group">

                            <label>

                             DEFUALT

                              <span class="required-field"></span>

                            </label>

                            <?php for ($n=1; $n < 8; $n++) {  ?>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input list="defaultList<?= $n ?>" class="form-control  rdate" name="defulat_value[]"  value="NO" id="defulat_value<?= $n ?>" placeholder="Enter value" maxlength="10" autocomplete="off" />


                                <datalist id="defaultList<?= $n ?>">
                                  
                                 

                                  <option value="YES">YES</option>
                                  <option value="NO" selected>NO</option>


                                </datalist>


                            </div>
                            <small id="gl_codeerr" style="color:red;"></small>
                            <br>

                          <?php } ?>

                             

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>
                      <!-- /.col -->

                      

                    </div>

                      <div class="col-sm-1"></div>
                 
                    <div style="text-align: center;">

                       <button type="Submit" class="btn btn-primary" onclick="return validation();">

                      <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                       </button>

                    </div>

                 

                </div><!-- /.box-body -->

                 

                </div>

            </div>

           



          </div>

           

        </section>


       </form>

</div>







@include('admin.include.footer')





<script type="text/javascript">
  
  function indChange(ind){

    var indicator =  $("#indicator"+ind).val();

    if(indicator=='DESIEL'){

      $("#defulat_value"+ind).val('YES');
      $("#defulat_value"+ind).prop('readonly',true);

    }else{

      $("#defulat_value"+ind).val('NO');
      $("#defulat_value"+ind).prop('readonly',false);

    }

  }
</script>

<script type="text/javascript">

  

  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'yyyy/mm/dd',

      orientation: 'bottom',

      todayHighlight: 'true',

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


<script type="text/javascript">
  $(document).ready(function(){
    $('#whelcodSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var whelcodSearch = $('#whelcodSearch').val();
        //console.log(depot_code_search);

        if(whelcodSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-fleet-truc-wheel-code') }}",

             method : "POST",

             type: "JSON",

             data: {whelcodSearch: whelcodSearch},

             success:function(data){

                 console.log(data);
                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                       var objcity = data1.data;
                       //$('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.WHEEL_CODE+'</span><br>');
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
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Wheel Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var HelpWheelCode = $('#WheelNameH').val();

          if(HelpWheelCode == ''){
            $('#HideWhenSearch').show();
            $('#ShowWhenSeaech').hide();
            $('#errorItem').html('');
          }else{

             $.ajax({

                url:"{{ url('help-wheel-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpWheelCode: HelpWheelCode},

                 success:function(data){

                     // console.log(data);
                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Company Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;
                          
                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.wheel_code+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.wheel_name+'</td></tr>');
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
       // console.log('hii');
          $('.popover').fadeOut();
    })
  });
</script>
<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>
@endsection