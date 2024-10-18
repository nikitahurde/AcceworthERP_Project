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

            Master Employee Wage Indicator

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

            <li class="Active"><a href="{{ URL('/finance/cost-category')}}">Master Employee Wage Indicator</a></li>



            <li class="Active"><a href="{{ URL('/finance/cost-category')}}">Add Wage Indicator</a></li>


            <?php } else { ?>

           <li class="Active"><a href="#">Master Employee Wage Indicator</a></li>



           <li class="Active"><a href="#">Update Employee Wage Indicator</a></li>



           <?php } ?>
          
          </ol>

        </section>

<section class="content">

    <div class="row">

     <div class="col-sm-1"></div>

      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <?php if($button=='Save') { ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Wage Indicator</h2>
              
               <?php } else{  ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Wage Indicator</h2>

            <?php } ?>

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

            <form action="{{ url($action) }}" method="POST" >


              @csrf
                <div class="row">

                  <div class="col-md-5">

                    <div class="form-group">

                       <label>Wage Indicator Code : 

                        <span class="required-field"></span>

                       </label>

                       <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control codeCapital" name="wageindicator_code" value="{{$wageindicator_code}}" placeholder="Wage Indicator Code" maxlength="4" id="wageIndicatorCode" <?php if($button=='Update') { ?> readonly <?php } ?> autocomplete="off">

                        <?php if($button=='Save') { ?>

                         

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>

                        <?php } ?>



                        </div>

                          <small id="emailHelp" class="form-text text-muted">


                          {!! $errors->first('wageindicator_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                  </div>

                  <div class="col-md-7">
                   <div class="form-group">
                    <label> Wage Indicator Name :

                     <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control wageIndName"  id="wageIndName" name="wageindicator_name" value="{{$wageindicator_name}}" placeholder="Wage Indicator Name" autocomplete="off">
                    </div>

                    <small id="indName" class="form-text text-muted">

                   {!! $errors->first('wageindicator_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



              </div>

              <div class="row">

                  <div class="col-md-5">

                      <div class="form-group">

                      <label>Wage Indicator Type : 
                        <span class="required-field"></span>
                      </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>


                          <input list="wageIndTypeList"  id="wageIndType" name="wageIndType" class="form-control  pull-left serieswidth" value="<?php echo $wageIndType; ?>" placeholder="Wage Indicator Type"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" maxlength="10">

                          <datalist id="wageIndTypeList">

                            <option selected="selected" value="">-- Select --</option>
                            <option value="<?php if($wageIndType == 'Earning'){echo 'selected';}else{echo 'Earning';}?>">Earning</option>
                            <option value="<?php if($wageIndType == 'Deduction'){echo 'selected';}else{echo 'Deduction';}?>">Deduction</option>
                            <option value="<?php if($wageIndType == 'None'){echo 'selected';}else{echo 'None';}?>">None</option>
                           

                          </datalist>

                        </div>
                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('wageIndType', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>
                              

                    </div>

                  </div>
              </div>



            <?php if($button=='Update') { ?>



              <div class="row">







                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                       Wage Indicator Block : 







                        <span class="required-field"></span>







                      </label>







                        <div class="input-group">







                          <input type="radio" class="optionsRadios1" name="wageindicator_block" value="YES" <?php if($wageindicator_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;







                          <input type="radio" class="optionsRadios1" name="wageindicator_block" value="NO" <?php if($wageindicator_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO







                        </div>







                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('wageindicator_block', '<p class="help-block" style="color:red;">:message</p>') !!}







                          </small>















                    </div>







                    <!-- /.form-group -->







                  </div>







                </div>



<?php } ?>
              <div style="text-align: center;">







                 <button type="Submit" class="btn btn-primary" id="saveBtn">



                  <input type="hidden" name="idwageindicator" value="{{$wageindicator_code}}">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 







                 </button>
               </div>
            </form>
          </div><!-- /.box-body -->
       </div>
     </div>

    <div class="col-sm-3">

       <div class="box-tools pull-right">
         <a href="{{ url('/Master/Employee/View-Emp-Wage-Indicator-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Wage Indicator</a>
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

// $('.wageIndName').keypress(function (event) {
//     var keycode = event.which;
    
//     var input = document.getElementById('wageIndName');
//     console.log('keycode',input.value.indexOf(" "));
   
//     if (input.value.indexOf(" ") >-1) {
//        $('#indName').html('<p style="color:Red;">GiveIndicator Name Without Space.</p>');
//        $('#saveBtn').prop('disabled',true);
//        return false;
//   }
//  else{
//       $('#indName').html('');
//       $('#saveBtn').prop('disabled',false);
//   }
// });

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