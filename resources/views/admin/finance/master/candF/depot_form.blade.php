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

  .rightcontent{

  text-align:right;


}

::placeholder {
  
  text-align:left;
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
.popover{
    left: 92.4922px!important;
    width: 100%!important;
}
.showinmobile{
  display: none;
}
.showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

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

            Master Depot

            <small>Add Details</small>



          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-depot') }}">Master Depot</a></li>

            <li class="active"><a href="{{ url('/form-mast-depot') }}">Add Master Depot</a></li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Master Depot</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-depot') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Depot</a>

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

            <form action="{{ url('form-mast-depot-save') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Depot Code:
                         

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon" style="padding: 5px 7px;"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="depot_code" placeholder="Enter Depot Code" value="{{ old('depot_code')}}" id="depot_code_search" oninput="this.value = this.value.toUpperCase()" maxlength="6" autocomplete="off">

                          <span class="input-group-addon" style="padding: 1px 7px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>
                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="depotnameH" id="depotnameH" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Depot Code</th>
                                     <th class="nameheading">Depot Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($help_depot_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd"><?php echo $key->DEPOT_CODE; ?></td>
                                        <td class="setetxtintd"><?php echo $key->DEPOT_NAME; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                      
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Depot Code</th>
                                     <th class="nameheading">Depot Name</th>
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
                        </div>
                         
                        <small id="shoemsgonin">
                          
                        </small>                      

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('depot_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Depot Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="depot_name" placeholder="Enter Depot Name" value="{{ old('depot_name')}}" style="z-index: 1;" maxlength="30" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('depot_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

                <!-- /.col -->

                

              </div>

              <!-- /.row -->



              <div class="row">



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Contact Number : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input type="text" class="form-control Number rightcontent" name="contact_no" value="{{ old('contact_no')}}" placeholder="Enter Contact Number" maxlength="10" style="z-index: 1;" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('contact_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Contact Email 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                          <input type="text" class="form-control" name="contact_email" value="{{ old('contact_email')}}" placeholder="Enter Contact Email" maxlength="30" style="text-transform: lowercase;" autocomplete="off">

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('contact_email', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <!-- /.col -->

                

              </div>

              <!-- /.row -->





              <div class="row">

                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Address: 

                        <span class="required-field"></span>

                      </label>

                      

                      <input type="text" name="address_one" class="form-control" placeholder="Address 1" value="{{ old('address_one')}}" maxlength="30" autocomplete="off">

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('address_one', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <input type="text" name="address_two" class="form-control" style="margin-top: 2%" placeholder="Address 2" value="{{ old('address_two')}}" maxlength="30" autocomplete="off">

                      <input type="text" name="address_three" class="form-control" style="margin-top: 2%" placeholder="Address 3" value="{{ old('address_three')}}" maxlength="30" autocomplete="off">

                      

                    </div>

                    <!-- /.form-group -->

                    
                     


                  </div>

                   <div class="col-md-6">

                  <div class="form-group">

                      <label>

                        City Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true"></i>

                          </span>

                       <input name="city_code" class="form-control" placeholder="Enter City Code" value="{{ old('city_code') }}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('city_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                   

                </div>

                <div class="col-md-6">

                    
                     <div class="form-group">

                      <label>

                        Pincode : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc"></i>

                          </span>

                        <input type="text" name="pincode" class="form-control rightcontent Number" value="{{ old('pincode') }}" placeholder="Enter Pincode" maxlength="6" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('pincode', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->

                  </div>





                

              </div>



              <div class="row">

                 <div class="col-md-6">
                   <div class="form-group">

                      <label>

                        District: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true"></i>

                          </span>

                       <input name="district" class="form-control" placeholder="Enter District" value="{{ old('district') }}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('district', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>
                 </div>

                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Country: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true"></i>

                          </span>

                       <input name="country" class="form-control" placeholder="Enter Country" value="India" maxlength="30" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>
                    
                  </div>
                   

                    <!-- /.form-group -->

                   

                  </div>


           
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">

                      <label>

                        State Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc"></i>

                          </span>

                          <input list="stateList" type="text" name="state_code" class="form-control" id="state_code" maxlength="30" placeholder="Select State" value="{{ old('state_code') }}" autocomplete="off">

                      

                        <datalist id="stateList">

                        <option value="">--SELECT STATE--</option>

                       @foreach ($state_list as $key)

                        <option value="{{$key->STATE_CODE}}" data-xyz ="<?php echo $key->STATE_NAME; ?>">{{$key->STATE_CODE}} - {{$key->STATE_NAME }}</option>

                        @endforeach

                     
                        </datalist>
                    </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="stateText"></div>

                     </small>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('state_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                  </div>
                

              </div>

              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-2 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/view-mast-depot') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Depot</a>

        </div>

      </div>



    </div>

     

	</section>

</div>



@include('admin.include.footer')


<script type="text/javascript">
  $(document).ready(function(){
    $('#depot_code_search').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var depot_code_search = $('#depot_code_search').val();

        if(depot_code_search == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-depot') }}",

             method : "POST",

             type: "JSON",

             data: {depot_code_search: depot_code_search},

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
                            objcity.DEPOT_CODE+'</span><br>');
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



<!-- <script type="text/javascript">
  
  $(document).ready(function() {

 $('input:text:first').focus();
   

 $(document).on('keypress', 'input,select,button', function (e) {

    var n = $("input,select,button").length;

    if (e.which == 13)

    { //Enter key

      e.preventDefault(); //Skip default behavior of the enter key

      var nextIndex = $('input,select,button').index(this) + 1;
      if(nextIndex < n)
        $('input,select,button')[nextIndex].focus();
      else
      {
        $('input,select,button')[nextIndex-1].blur();
        
      }
    }
  });
 
});

</script> -->

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

  $(document).ready(function() {
  $(".Number").on("keypress", function(evt) {
    var keycode = evt.charCode || evt.keyCode;
    if (keycode == 46 || this.value.length==10) {
      return false;
    }
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

          var HelpdepotCode = $('#depotnameH').val();

           if(HelpdepotCode == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-depot-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpdepotCode: HelpdepotCode},

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
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.DEPOT_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.DEPOT_NAME+'</td></tr>');
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
  $("#state_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#stateList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("stateText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });
   });
</script>

<!-- <script type="text/javascript">

  $(document).ready(function() {
  $(".pincode").on("keypress", function(evt) {
    var keycode = evt.charCode || evt.keyCode;
    if (keycode == 46 || this.value.length==6) {
      return false;
    }
  });

  });

</script> -->


@endsection