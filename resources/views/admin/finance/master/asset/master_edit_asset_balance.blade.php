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


.showinmobile{
  display: none;
}
.arrow{
  left: 59.4828%;
}

.beforhidetble{
  display: none;
}
.popover{
    left: 92.4922px!important;
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



            Master Asset Balance 



            <small> Update Details</small>



          </h1>



          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('Master/Asset/Asset-Balance-Master') }}">Master Asset </a></li>

            <li class="active"><a href="{{ url('Master/Asset/View-Asset-Balance-Master') }}">View Master Asset Balance</a></li>

            <li class="active"><a href="javascript:void(0)">Update Asset Balance</a></li>


          </ol>

        </section>



	<section class="content">



    <div class="row">


      <div class="col-sm-11">


        <div class="box box-primary Custom-Box">


            <div class="box-header with-border" style="text-align: center;">


              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Asset Balance </h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('Master/Asset/View-Asset-Balance-Master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Asset Balance</a>

              </div>

              
              <div class="box-tools pull-right hideinmobile">

                <a href="{{ url('Master/Asset/View-Asset-Balance-Master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Asset Balance</a>

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



            <form action="{{ url('Master/Asset/Asset-Balance-Master-Update/') }}" method="POST" >

               @csrf

               <div class="row">
                 
                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Company Name : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input list="compList" id="comp_code" name="comp_code" class="form-control  pull-left" value="{{ $COMP_CODE }}" placeholder="Select Company Name" autocomplete="off" maxlength="6" >

                               <input list="compList" id="comp_name" name="comp_name" class="form-control  pull-left" value="{{ $COMP_NAME }}" placeholder="Select Company Name" autocomplete="off" maxlength="6"><br>


                            <datalist id='compList'>
                              <?php foreach($comp_list as $key) { ?>

                              <option value='<?= $key->COMP_CODE; ?>' data-xyz='<?= $key->COMP_NAME ?>'>{{ $key->COMP_NAME }}</option>

                              <?php } ?>
                            </datalist>

                        </div>

                        <input type="hidden" name="comp_name" value="{{ $COMP_NAME }}">
                        <input type="hidden" name="fyCode" value="{{ $FY_CODE }}">
                        <input type="hidden" name="asset_name" value="{{ $ASSET_NAME }}">

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        FY Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="fyList" id="fy_code" name="fy_code" class="form-control  pull-left" value="{{ $FY_CODE }}" placeholder="Select FY Code" autocomplete="off" maxlength="9" readonly>


                            <datalist id='fyList'>
                              <?php foreach($fy_list as $key) { ?>

                              <option value='<?= $key->FY_CODE; ?>' data-xyz='<?= $key->FY_CODE ?>'>{{ $key->FY_CODE }}</option>

                              <?php } ?>
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('fy_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Asset Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input list="assetList" id="asset_code" name="asset_code" class="form-control  pull-left" value="{{ $ASSET_CODE }}" placeholder="Select Asset Code" autocomplete="off" maxlength="9">

                             <input list="assetList" id="asset_name" name="asset_name" class="form-control  pull-left" value="{{ $ASSET_NAME }}" placeholder="Select Asset Name" autocomplete="off" maxlength="9">


                            <datalist id='assetList'>
                              <?php foreach($asset_list as $key) { ?>

                              <option value='<?= $key->ASSET_CODE; ?>' data-xyz='<?= $key->ASSET_NAME ?>'>{{ $key->ASSET_NAME }}</option>

                              <?php } ?>
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('asset_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

               </div>

               <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        YROPGB : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YROPGB" id="YROPGB" value="{{ $YROPGB }}" placeholder="Enter YROPGB" maxlength="9" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('YROPGB', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        YRDRGB : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YRDRGB" id="YRDRGB" value="{{ $YRDRGB }}" placeholder="Enter YRDRGB" maxlength="9" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('YRDRGB', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        YRCRGB : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YRCRGB" id="YRCRGB" value="{{ $YRCRGB }}" placeholder="Enter YRCRGB" maxlength="9" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('YRCRGB', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                </div>

                <!-- /.col -->

              <!-- /.row -->

              <div class="row">
               
                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        YRCLGB : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YRCLGB" id="YRCLGB" value="{{ $YRCLGB }}" placeholder="Enter YRCLGB" maxlength="9" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('YRCLGB', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        YROPDB : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YROPDB" id="YROPDB" value="{{ $YROPDB }}" placeholder="Enter YROPDB" maxlength="9" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('YROPDB', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        RYDRDB : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="RYDRDB" id="RYDRDB" value="{{ $RYDRDB }}" placeholder="Enter RYDRDB" maxlength="9" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('RYDRDB', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

              </div>

              <!-- /.row -->

              <div class="row">
                
                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        YRCRDB : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YRCRDB" id="YRCRDB" value="{{ $YRCRDB }}" placeholder="Enter YRCRDB" maxlength="9" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('YRCRDB', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        YRCLDB : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YRCLDB" id="YRCLDB" value="{{ $YRCLDB }}" placeholder="Enter YRCLDB" maxlength="9" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('YRCLDB', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        YRCLNB : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YRCLNB" id="YRCLNB" value="{{ $YRCLNB }}" placeholder="Enter YRCLNB" maxlength="9" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('YRCLNB', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

              </div>
              <!-- /.row -->

              <div class="row">
                
                <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        YROPNB : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YROPNB" id="YROPNB" value="{{ $YROPNB }}" placeholder="Enter YROPNB" maxlength="9" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('YROPNB', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Block Asset Balance : 

                        <span class="required-field"></span>

                      </label>

                     
                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="asset_bal_block" value="0" <?php if($FLAG=='0'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="asset_bal_block" value="1" <?php if($FLAG=='1'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                  </div>

              </div>
              <!-- /.row -->

              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update
                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

        </div>

      </div>

      <div class="col-sm-1"></div>

    </div>


	</section>


</div>


@include('admin.include.footer')



<script type="text/javascript">



$(document).ready(function(){

    $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

  });



  $("#comp_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#compList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#comp_name").val('');
        }else{
          $("#comp_name").val(msg);
        }


      });





    $("#asset_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#assetList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#asset_name").val('');
        }else{
          $("#asset_name").val(msg);
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

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Acc Class Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var AccClsHelp = $('#AccClsHelp').val();

           if(AccClsHelp == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-AccCode-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {AccClsHelp: AccClsHelp},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Acc Class Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ACLASS_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ACLASS_NAME+'</td></tr>');
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
    $('#AccClassSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var AccClassSearch = $('#AccClassSearch').val();

        if(AccClassSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-acc-class-get') }}",

             method : "POST",

             type: "JSON",

             data: {AccClassSearch: AccClassSearch},

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
                            objcity.ACLASS_CODE+'</span><br>');
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

<!-- <script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script> -->







@endsection