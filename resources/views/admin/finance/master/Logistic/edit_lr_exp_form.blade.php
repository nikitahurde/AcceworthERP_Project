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

  .headBox{

    width: 80px !important;

  }

  .Custom-Box {

    /*border: 1px solid #e0dcdc;

    border-radius: 10px;

*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }
  .showSeletedName {
    color: #3c8dbc;
    font-size:90%;
    font-weight: 800;
    /*padding:5px 0px 10px 2px;*/
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

            Master LR Expenses
 
            <small>Update Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Master LR Expenses</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Update LR Expenses</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master LR Expenses</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-lr-exp-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View LR Expenses</a>

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

            <form action="{{ url('lr-exp-update') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                       HEAD

                        <span class="required-field"></span>

                      </label>

                       <div class="input-group" style="margin-bottom:6px !important;">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="indList" class="form-control" name="indicator" id="indicator"  placeholder="Head" value="{{$lrexp_list->LRIND}}" oninput="this.value = this.value.toUpperCase()" onchange="indChange()" autocomplete="off">

                          <input type="hidden" name="lrIndId" value="{{$lrexp_list->LREXPID}}">

                          <datalist id="indList">

                            <option value="JALPANI" data-xyz="L01">L01 = JALPANI</option>
                            <option value="FOODING" data-xyz="L02">L02 =FOODING</option>
                            <option value="U/L" data-xyz="L03">L03 = U/L</option>
                            <option value="ADMIN" data-xyz="L04"> L04 = ADMIN</option>
                            <option value="DIESEL" data-xyz="L05">L05 = DIESEL</option>
                            <option value="OVERLOAD ALLOWANCE" data-xyz="L06">L06 = OVERLOAD ALLOWANCE</option>
                            <option value="HOLTING" data-xyz="L07">L07 = HOLTING</option>
                            <option value="TOLL" data-xyz="L08">L08 = TOLL</option>
                            <option value="FOOD & SAVING" data-xyz="L09">L09 = FOOD & SAVING</option>
                            <option value="OVERLOAD" data-xyz="L10">L10 = OVERLOAD</option>
                            <option value="DELIVERY CHARGE" data-xyz="L11">L11 DELIVERY CHARGE</option>
                            <option value="SALARY" data-xyz="L12">L12 = SALARY</option>
                            <option value="ADD" data-xyz="L13">L13 = ADD</option>
                            <option value="DEDUCTION" data-xyz="L14">L14 = DEDUCTION</option>
                            <option value="UPLOADING / LOADING" data-xyz="L15">L15 = UPLOADING / LOADING</option>
                            <option value="OTHER" data-xyz="L16"> L16 = OTHER</option>
                           
                          </datalist>
                         
                          <input type="hidden" id="indicatorName" name="indicator_name" value="{{$lrexp_list->LRIND_NAME}}">

                          
                          <small id="indicatorerr" style="color:red;"></small>

                        </div>
                        <div class="pull-left showSeletedName" id="plantText">{{$lrexp_list->LRIND_NAME}}</div>
                        </br>


                         <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                          
                            </div>  
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('indicator', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                       INDEX 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="indexList" class="form-control  rdate" name="index" id="index"  value="{{$lrexp_list->LRINDEX}}" placeholder="Index" autocomplete="off" >

                              <datalist id="indexList">
                            
                               <option value="L">L</option>
                               <option value="R">R</option>
                               <option value="C">C</option>
                               <option value="M">M</option>

                              </datalist>



                      </div>
                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('index', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                      <small id="indexerr" style="color:red;"></small>
                      <br>

                   
                
                      
                    
                    </div>

                    <!-- /.form-group -->

                  </div>




                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                       GL CODE

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="glCodeList" class="form-control  rdate" name="gl_code"  value="{{ $lrexp_list->GL_CODE }}" id="gl_code" placeholder=" Gl Code" maxlength="10" autocomplete="off" >


                          <datalist id="glCodeList">
                            
                            <?php foreach($gl_list as $key) { ?>

                                   <option value="<?= $key->GL_CODE ?>" data-xyz="<?= $key->GL_NAME ?>"><?= $key->GL_CODE ?><?= $key->GL_NAME ?></option>

                                <?php   } ?>

                          </datalist>

                          <input type="hidden" name="gl_name" id="gl_name" value="{{ $lrexp_list->GL_NAME }}">


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                      <small id="gl_codeerr" style="color:red;"></small>
                      <br>

                    </div>


                  </div>


              </div>

            
           
              <div style="text-align: center;">

                 <button type="submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-2 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/view-lr-exp-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View LR Expenses</a>

        </div>

      </div>



    </div>

     

  </section>

</div>



@include('admin.include.footer')


<!-- <script type="text/javascript">
  function validation(){

    var indicator  = $("#indicator").val();
    var index      = $("#index").val();
    var gl_code    = $("#gl_code").val();


    if(indicator ==''){
      $("#indicatorerr").html('This field is requiered');
      return false;
    }else{
      $("#indicatorerr").html('');
    }

    if(index ==''){
      $("#indexerr").html('This field is requiered');
      return false;
    }else{
      $("#indexerr").html('');
    }

    if(gl_code ==''){
      $("#gl_codeerr").html('This field is requiered');
      return false;
    }else{
      $("#gl_codeerr").html('');
    }

  }
</script> -->

<!-- script type="text/javascript">
  $(document).ready(function(){
    $('#truck_no').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var truck_no = $('#truck_no').val();

        if(truck_no == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-truck-no') }}",

             method : "POST",

             type: "JSON",

             data: {truck_no: truck_no},

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
                            objcity.truck_no+'</span><br>');
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
</script> -->

<script type="text/javascript">

 
  function indChange(){

    var indicator =  $("#indicator").val();

    if(indicator=='DESIEL'){

      $("#defulat_value").val('YES');
      $("#defulat_value").prop('readonly',true);

    }else{

      $("#defulat_value").val('NO');
      $("#defulat_value").prop('readonly',false);

    }

     var xyz = $('#indList option').filter(function() {

       return this.value == indicator;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        $("#indicator").val(msg);

        if(msg == 'No Match'){

            $("#indicator").val('');
            $("#indicatorName").val('');
            document.getElementById("plantText").innerHTML = ''; 

        }else{

            $("#indicatorName").val(indicator);
             document.getElementById("plantText").innerHTML = indicator; 
        }

  }

  $("#gl_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#glCodeList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

       if(msg == 'No Match'){

            $('#gl_code').val('');
            $('#gl_name').val('');
            
        }else{

            $('#gl_code').val(val);
            $('#gl_name').val(msg);
        }


    });
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

  

  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      endDate: 'today',
      
      autoclose: 'true'

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