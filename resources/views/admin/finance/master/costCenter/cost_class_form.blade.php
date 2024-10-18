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







            Master Cost Class





           <?php if($button == 'Save'){ ?>

            <small>Add Details</small>
          <?php }else{ ?>
            <small>Update Details</small>
          <?php } ?>






          </h1>







          <ol class="breadcrumb">







            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>







            <li><a href="{{ url('/dashboard') }}">Master</a></li>







            <li class="active"><a href="{{ url('/Master/Cost-Center/Cost-Class-Mast') }}">Master Cost Class</a></li>





            <?php if($button == 'Save'){ ?> 

              <li class="active"><a href="{{ url('/Master/Cost-Center/Cost-Class-Mast') }}">Add Cost Class</a></li>

            <?php }else{ ?>

              <li class="active"><a href="{{ url('/Master/Cost-Center/Cost-Class-Mast') }}">Update Cost Class</a></li>

           <?php } ?>







          </ol>







        </section>







	<section class="content">







    <div class="row">







      <div class="col-sm-1"></div>







      <div class="col-sm-8">







        <div class="box box-primary Custom-Box">







            <div class="box-header with-border" style="text-align: center;">






              <?php if($button == 'Save'){ ?>
                <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Cost Class </h2>
              <?php }else{ ?>
                <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Cost Class </h2>
              <?php } ?>
              

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Master/Cost-Center/View-Cost-Class-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Cost Class</a>

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



                        Cost Class Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">


                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                           <input type="text" class="form-control codeCapital" name="cost_class_code" value="{{ $cost_class_code }}" placeholder="Enter Cost Class Code" maxlength="20" id="CostClsSearch" <?php if($button=='Update') { ?> readonly <?php } ?> autocomplete="off">

                           <?php if($button=='Save') { ?>
                           <span class="input-group-addon" style="padding: 1px 7px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>
                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="GlmstnameH" id="CostClsHelp" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Cost Class Code</th>
                                     <th class="nameheading">Cost Class Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($costcls_mst_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd"><?php echo $key->CCLASS_CODE; ?></td>
                                        <td class="setetxtintd"><?php echo $key->CCLASS_NAME; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Cost Class Code</th>
                                     <th class="nameheading">Cost Class Name</th>
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







                            {!! $errors->first('cost_class_code', '<p class="help-block" style="color:red;">:message</p>') !!}







                          </small>







                    </div>







                    <!-- /.form-group -->







                  </div>







                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                       Cost Class Name : 







                        <span class="required-field"></span>







                      </label>







                      <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>







                          <input type="text" class="form-control" name="cost_class_name" value="{{ $cost_class_name }}" placeholder="Enter Cost Class Name" maxlength="40" autocomplete="off">







                      </div>







                      <small id="emailHelp" class="form-text text-muted">







                        {!! $errors->first('cost_class_name', '<p class="help-block" style="color:red;">:message</p>') !!}







                      </small>







                    </div>







                    <!-- /.form-group -->







                  </div>



                </div>



               

                



<?php if($button=='Update') { ?>



<div class="row">







                 <div class="col-md-6">







                    <div class="form-group">







                      <label>







                        Cost Class Block : 







                        <span class="required-field"></span>







                      </label>







                      <div class="input-group">







                         







                          <input type="radio" class="optionsRadios1" name="cost_class_block" value="1" <?php if($cost_class_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                          <input type="radio" class="optionsRadios1" name="cost_class_block" value="0" <?php if($cost_class_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO







                      </div>







                      <small id="emailHelp" class="form-text text-muted">







                        {!! $errors->first('cost_class_block', '<p class="help-block" style="color:red;">:message</p>') !!}







                      </small>







                    </div>







                    <!-- /.form-group -->







                  </div>







           </div>     



<?php } ?>







              <div style="text-align: center;">



              	<input type="hidden" name="cost_class_id" value="{{ $cost_class_id }}">



                 <button type="Submit" class="btn btn-primary">







                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  {{ $button }}





                 </button>







              </div>







            </form>







          </div><!-- /.box-body -->







           







          </div>







      </div>







      <div class="col-sm-3 hideinmobile">



        <div class="box-tools pull-right">


          <a href="{{ url('/Master/Cost-Center/View-Cost-Class-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Cost Class</a>





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
        title: 'Help Cost Class Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var CostClsHelp = $('#CostClsHelp').val();

           if(CostClsHelp == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-costclasscode-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {CostClsHelp: CostClsHelp},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Cost Class Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.CCLASS_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.CCLASS_NAME+'</td></tr>');
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
    $('#CostClsSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var CostClsSearch = $('#CostClsSearch').val();

        if(CostClsSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-costcls-get') }}",

             method : "POST",

             type: "JSON",

             data: {CostClsSearch: CostClsSearch},

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
                            objcity.CCLASS_CODE+'</span><br>');
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