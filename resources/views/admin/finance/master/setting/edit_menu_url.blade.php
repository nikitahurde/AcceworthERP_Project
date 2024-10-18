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

.beforhidetble{
  display: none;
}
.popover{
    left: 70.4922px!important;
    width: 110%!important;
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

   Master Menu URL

    <small>Add Details</small>

  </h1>

  <ol class="breadcrumb">


    <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

    <li><a href="{{ URL('/dashboard')}}">Setting</a></li>
    
  

    <li class="Active"><a href="#">Menu URL</a></li>



    <li class="Active"><a href="#">Update Menu URL</a></li>

  
  </ol>

</section>
<section class="content">

    <div class="row">

     <!-- <div class="col-sm-2"></div> -->

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Menu URL</h2>

                <div class="box-tools pull-right">
                   <a href="{{ url('/Master/Setting/view-menu-url') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Menu URL</a>

                </div>
            
          </div><!-- /.box-header -->
          
          @if(Session::has('alert-success'))


            <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">
            
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

              <h4><i class="icon fa fa-check"></i>

                 Success...!

              </h4>

              {!! session('alert-success') !!}

            </div>

            @endif

            @if(Session::has('alert-error'))
            <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

               <h4> <i class="icon fa fa-ban"></i>

                  Error...!
               </h4>

                {!! session('alert-error') !!}
            </div>

          @endif

          <div class="box-body">

            <form action="{{url('/Master/Setting/Update-menu-url')}}" method="POST" >


              @csrf
                <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                       <label>Menu Name : 

                        <span class="required-field"></span>

                       </label>

                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="menu_name" value="{{$editData->MENU_NAME}}" maxlength="100" id="menu_name" placeholder="Menu Name" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">


                        {!! $errors->first('menu_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                  </div>

                  <div class="col-md-4">

                   <div class="form-group">

                      <label>Submenu Name :

                       <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="submenu_name" value="{{$editData->SUBMENU_NAME}}" placeholder="Sub Menu Name" maxlength="100" autocomplete="off">
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('submenu_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-4">

                   <div class="form-group">

                      <label>Form Name :

                       <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="form_name" id="form_name" value="{{$editData->FORM_NAME}}" placeholder="Form Name" maxlength="60" autocomplete="off">
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('form_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-4">

                   <div class="form-group">

                      <label>Form Code :

                       <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="form_code" id="form_code" value="{{$editData->FORM_CODE}}" placeholder="Form code" maxlength="10" autocomplete="off">
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('form_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-6">

                   <div class="form-group">

                      <label>Form Link :

                       <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-paperclip"></i></span>

                          <input type="text" class="form-control" name="form_link" id="form_url" value="{{$editData->FORM_LINK}}" placeholder="Form URL" maxlength="200" autocomplete="off">
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('form_link', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

              </div>

              <div style="text-align: center;margin:1%;">
                <input type="hidden" name="form_id" value="{{$editData->ID}}">
                <button type="Submit" class="btn btn-primary">
                  <i class="fa fa-floppy-o"></i> Update
                </button>
<!-- 
                <button type="reset" class="btn btn-warning"><i class="fa fa-refresh"></i> Reset</button> -->

              </div>

            </form>


          </div><!-- /.box-body -->

          </div>

      </div>

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
        title: 'Help Cost Category Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var CostCatHelp = $('#CostCatHelp').val();

           if(CostCatHelp == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-costcat-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {CostCatHelp: CostCatHelp},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Cost Category Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.costcatg_code+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.costcatg_name+'</td></tr>');
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
    $('#CostCatSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var CostCatSearch = $('#CostCatSearch').val();

        if(CostCatSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-cost-cat-code-get') }}",

             method : "POST",

             type: "JSON",

             data: {CostCatSearch: CostCatSearch},

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
                            objcity.costcatg_code+'</span><br>');
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