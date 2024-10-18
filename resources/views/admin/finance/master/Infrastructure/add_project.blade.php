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



            Poject Master


            <small> Add Details</small>



          </h1>



          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('Master/Infrastructure/View-Project-Master') }}">Master Poject</a></li>

           

            <li class="active"><a href="{{ url('Master/Infrastructure/View-Project-Master') }}">Add Project </a></li>


          </ol>

        </section>



	<section class="content">


    <div class="row">


      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> Add Project Master</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('Master/Infrastructure/View-Project-Master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Project  List</a>

              </div>

              <div class="box-tools pull-right hideinmobile">


                  <a href="{{ url('Master/Infrastructure/View-Project-Master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Project  List</a>


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



            <form action="{{ url('Master/Infrastructure/Save-Project-Master') }}" method="POST" >

               @csrf

               <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Project Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                           <input type="" class="form-control codeCapital" name="Poject_code" id="asset_dep_code" value="{{ old('Poject_code')}}" placeholder="Enter Poject Code" maxlength="6" autocomplete="off">


                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                        

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('Poject_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Project Name: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="group_code" name="Name_project" class="form-control  pull-left" value="{{ old('Name_project')}}" placeholder="Enter Poject name" autocomplete="off">


                            <datalist id='glList'>
                              
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('Name_project', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Project Discription : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text"  name="Project_dis" class="form-control  pull-left" value="{{ old('Project_dis')}}" placeholder="Enter Project Discription" autocomplete="off" >
                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('Project_dis', '<p class="help-block" style="color:red;">:message</p>') !!}
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

                        Plant Start Date : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-calendar" aria-hidden="true"></i>

                            </div>

                          <input type="text" class="form-control" name="Plant_start" id="start_date" value="{{ old('Plant_start')}}" placeholder="Select Start Date" autocomplete="off" >
                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('Plant_start', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                <!-- /.col -->

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Plant End Date : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>

                           <input type="text" class="form-control" name="Plant_enddate" id="end_date" value="{{ old('Plant_enddate')}}" placeholder="Select Plant End Date" autocomplete="off" >


                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                        

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('Plant_enddate', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <!-- /.col -->
                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Actual Start Date : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-calendar" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="actual_date" name="Actual_start" class="form-control  pull-left" value="{{ old('Actual_start')}}" placeholder="Select Actual Startdate" autocomplete="off">
                           
                        </div>

                         <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('Actual_start', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

        <div class="row">

         <div class="col-md-12">
                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Actual End Date : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-calendar" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="actend_date" name="Actual_enddate" class="form-control  pull-left" value="{{ old('Actual_enddate')}}" placeholder="Select Actual Startdate" autocomplete="off">
                           
                        </div>

                           <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('Actual_enddate', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>
                    </div>
                    <!-- /.form-group -->
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

      <div class="col-sm-1"></div>

    </div>


	</section>


</div>


@include('admin.include.footer')



<script type="text/javascript">


$(document).ready(function() {


      $('#start_date').datepicker({

        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        // startDate :fromdateintrans,
        // endDate : 'today',
        autoclose: 'true'
      });

    
  
 // $('#start_date').datepicker({
 //      format: 'yyyy-mm-dd',
 //      orientation: 'bottom',
 //      todayHighlight: 'true',
 //      autoclose: 'true'

 //    });
  

    $('#end_date').datepicker({
      format: 'dd-mm-yyyy',
     orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });
    $('#actual_date').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });

     $('#actend_date').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });
    

});


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