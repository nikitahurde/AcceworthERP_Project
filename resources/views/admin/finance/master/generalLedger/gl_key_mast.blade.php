@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')


<style type="text/css">
  .required-field::before {

    content: "*";

    color: red;

  }
    .showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

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

            Master General Ledger Key

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/Master/General-Ledger/Gl-Key-Mast')}}">Master  General Ledger Key</a></li>

            <li class="Active"><a href="{{ URL('/Master/General-Ledger/Gl-Key-Mast')}}">Add  General Ledger Key</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add  General Ledger Key</h2>

              
                <div class="box-tools pull-right showinmobile">

                  <a href="{{ url('/Master/General-Ledger/View-Gl-Key-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View  General Ledger Key
                  </a>

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

            <form action="{{ url($action) }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                         General Ledger key Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control codeCapital" name="glkey_code" value="{{ $glkeycode }}" placeholder="Enter General Ledger key Code" maxlength="4" id="glkeysearch" autocomplete="off" <?php if($button=='Update') { ?>readonly <?php } ?>>
                          <?php if($button=='Save') { ?>
                          <span class="input-group-addon" style="padding: 1px 7px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>
                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="GlmstnameH" id="GlkeyHelp" class="form-control input-md setheightinput" style="text-transform: uppercase;" >
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Glkey Code</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($glkey_mst_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd"><?php echo $key->GLKEY_CODE; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Transaction Code</th>
                                     <th class="nameheading">Transaction Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                                <span id="errorItem"></span>

                            </div>
                            </div>
                            
                          </span>

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                        <?php } ?>
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('glkey_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                      </div>

                    <!-- /.form-group -->
                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label for="exampleInputEmail1"> General Ledger Code : <span class="required-field"></span></label>

                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-list-ol" aria-hidden="true"></i>
                          </div>

                          <?php $glcount = count($gl_code_list); ?>
                          <input list="accountList" id="gl_code" name="gl_code" class="form-control  pull-left " value="<?php echo $glcode; ?>" placeholder="Select General Ledger Code" maxlength="6" <?php if($button=='Update') { ?>readonly <?php } ?>>

                          <datalist id="accountList">

                            <option value="">-- Select --</option>

                            @foreach ($gl_code_list as $key)

                            <option value='<?php echo $key->GL_CODE?>'   data-xyz ="<?php echo $key->GL_NAME; ?>" ><?php echo $key->GL_NAME ; echo " [".$key->GL_CODE."]" ; ?></option>

                            @endforeach

                          </datalist>

                          <input type="hidden" id="gl_name" name="gl_name" value="<?php if($glcount == 1){echo $gl_code_list[0]->GL_NAME;}else{echo $glname;} ?>">

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="accountText"></div>

                      </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>

                  </div><!-- /.col -->

              </div>

              <!-- /.row -->


              <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Account type Code : <span class="required-field"></span></label>

                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-list-ol" aria-hidden="true"></i>
                          </div>
                          <?php $typecount = count($acctype_code_list); ?>
                          <input list="accountTypeList" id="acctype_code" name="acctype_code" class="form-control  pull-left" value="<?php if($typecount ==1){echo $acctype_code_list[0]->ATYPE_CODE;}else{echo $acctypecode; } ?>" placeholder="Select Account type Code" maxlength="6" autocomplete="off">

                          <datalist id="accountTypeList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($acctype_code_list as $key)

                            <option value='<?php echo $key->ATYPE_CODE?>'   data-xyz ="<?php echo $key->ATYPE_NAME; ?>" ><?php echo $key->ATYPE_NAME ; echo " [".$key->ATYPE_CODE."]" ; ?></option>

                            @endforeach

                          </datalist>

                          <input type="hidden" id="acctype_name" name="acctype_name" value="<?php if($typecount ==1){echo $acctype_code_list[0]->ATYPE_NAME;}else{echo $acctypename; } ?>">

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="accountTypeText"></div>

                      </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('acctype_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>

                  </div><!-- /.col -->


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Amount Type : 

                        <span class="required-field"></span>

                      </label><br>


                              <input type="radio" name="amt_type" value="1" <?php if($amt_type == '1'){ echo "checked";}else{ echo '';} ?>> Yes
                              <input type="radio" name="amt_type" value="0" <?php if($amt_type == '0'){ echo "checked";}else{ echo '';} ?>> No


                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('amt_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                      </div>

                    <!-- /.form-group -->
                  </div>

              </div>

              <!-- /.row -->
<?php if($button=='Update') { ?>
                <div class="row">


                 <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        GlKey Block : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                         



                          <input type="radio" class="optionsRadios1" name="glkey_block" value="YES" <?php if($glkey_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="glkey_block" value="NO" <?php if($glkey_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('department_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>
          </div>

<?php } ?>


              <div style="text-align: center;">

                <input type="hidden" name="glkey_id" value="{{ $key_id }}">
                <input type="hidden" name="glcode" value="{{ $glcode }}">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-3">

        <div class="box-tools pull-right hideinmobile">

          <a href="{{ url('/Master/General-Ledger/View-Gl-Key-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View  General Ledger Key</a>

        </div>

      </div>



    </div>

     

  </section>

</div>







@include('admin.include.footer')

<script type="text/javascript">
   $(document).ready(function(){

    

      $("#gl_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
          $(this).val('');
          document.getElementById("accountText").innerHTML = ''; 
          $('#gl_name').val('');
          }else{
          document.getElementById("accountText").innerHTML = msg;
          $('#gl_name').val(msg);

          }


      });

      $("#acctype_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountTypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

           if(msg == 'No Match'){
            $(this).val('');
            document.getElementById("accountTypeText").innerHTML = '';
            $('#acctype_name').val('');
          }else{

          document.getElementById("accountTypeText").innerHTML = msg; 
          $('#acctype_name').val(msg);
          } 

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

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Gl Key Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var GlkeyHelp = $('#GlkeyHelp').val();

           if(GlkeyHelp == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-gl-key-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {GlkeyHelp: GlkeyHelp},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Gl key Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.glkey_code+'</td></tr>');
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
    $('#glkeysearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var glkeysearch = $('#glkeysearch').val();

        if(glkeysearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-glkey-code-get') }}",

             method : "POST",

             type: "JSON",

             data: {glkeysearch: glkeysearch},

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
                            objcity.glkey_code+'</span><br>');
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
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>

@endsection