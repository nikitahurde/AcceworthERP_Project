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



            Seasonal Master



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

           

            <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Seasonal Master</a></li>

            <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Add Seasonal Master</a></li>

           

           <?php } else { ?>



             <li class="Active"><a href="{{ URL('/Master/Item/Edit-Item-Group-Mast/'.base64_encode($seasonalId))}}">Seasonal Master</a></li>

             <li class="Active"><a href="{{ URL('/Master/Item/Edit-Item-Group-Mast/'.base64_encode($seasonalId))}}">Update Seasonal Master</a></li>

           <?php } ?>

            



          </ol>



        </section>



  <section class="content">


    <div class="row col-md-12">
      
    </div>
    <div class="row">



      <!-- <div class="col-sm-2"></div> -->





      <div class="col-md-12">



        <div class="box box-primary Custom-Box" >

          <div class="box-header with-border" style="text-align: center;">

            <?php if($button=='Save') { ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Seasonal Master</h2>
               <div class="box-tools pull-right">

                <a href="{{ url('/Master/ColdStorage/View-Seasonal-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Seasonal Master</a>

              </div>



             <?php } else{  ?>



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Seasonal Master</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Master/ColdStorage/View-Seasonal-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Cold Storage</a>

              </div>

             <?php } ?>



              



              



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
                  
                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Seasonal Id : <span class="required-field"></span></label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="season_id" value="{{$season_id}}" placeholder="Enter Season Id" id="season_id" <?php if($button == 'Update')  { echo 'readonly'; } ?> autocomplete="off">

                      </div>

                       <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('season_id', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>

                    </div>

                  </div>


                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                      Seasonal : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="season" value="{{$season}}" placeholder="Enter Season" id="season" autocomplete="off">
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('season', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Item Name: <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input  class="form-control" id="item_name" name="item_name" placeholder="Enter Item Name" value="<?php echo $item_name; ?>" autocomplete="off">

                          </div>

                      </div>
                                <!-- /.form-group -->
                  </div>

                  

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>From Date: <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calendar" aria-hidden="true"></i>

                          </div>

                          <input  class="form-control datepicker" id="from_dt" name="from_dt" placeholder="Enter From Date" value="<?= $from_dt ?>" autocomplete="off">

                          </div>

                      </div>
                                <!-- /.form-group -->
                  </div>

              </div>

              <div class="row">


                 <div class="col-md-3">


                    <div class="form-group">


                      <label>



                       Middle Date: 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>



                          <input text="text" class="form-control datepicker" name="middle_dt" id="middle_dt" value="<?= $middle_dt ?>" placeholder="Enter Middle Date" autocomplete="off">


                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('middle_dt', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>



                    </div>



                  </div>


                <div class="col-md-3">


                    <div class="form-group">


                      <label>Date :<span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input text="text" class="form-control datepicker" name="temp_dt" id="temp_dt" value="<?= $temp_dt ?>" placeholder="Enter Temp Date" autocomplete="off">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('temp_dt', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>



                    </div>



                  </div>

                  <div class="col-md-3">


                    <div class="form-group">

                      <label>Rate Per Bag: <span class="required-field"></span>

                      </label>
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input text="text" class="form-control" name="rate_per_bag" id="rate_per_bag" value="<?= $rate_per_bag ?>" placeholder="Enter Rate per Bag" autocomplete="off">


                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('rate_per_bag', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>

                  </div>

                  <div class="col-md-3">


                    <div class="form-group">

                      <label>Min Qty 1 : <span class="required-field"></span>

                      </label>
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input text="text" class="form-control" name="min_qty_one" id="min_qty_one" value="<?= $min_qty_one ?>" placeholder="Enter Min Qty 1" autocomplete="off">


                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('min_qty_one', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>

                    </div>

                  </div>




              </div>

              <div class="row">

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Min Qty 2 : <span class="required-field"></span>

                    </label>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input text="text" class="form-control" name="min_qty_two" id="min_qty_two" value="<?= $min_qty_two ?>" placeholder="Enter Min Qty 2" autocomplete="off">


                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('min_qty_two', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>

                  </div>

                </div>

                <?php if($button=='Update') { ?>


                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                      Seasonal Block : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <input type="radio" class="optionsRadios1" name="seasonal_block" value="YES" <?php if($block_seasonal=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                          <input type="radio" class="optionsRadios1" name="seasonal_block" value="NO" <?php if($block_seasonal=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('seasonal_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>







                    </div>



                  </div>


              <?php } ?>

                  

            </div>
             

            <div style="text-align: center;">



                 <button type="Submit" class="btn btn-primary">

                  

                  <input type="hidden" name="seasonalId" value="{{$seasonalId}}">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 



                 </button>



              </div>



            </form>



          </div><!-- /.box-body -->



           



          </div>



      </div>



  </div>



     



  </section>



</div>


@include('admin.include.footer')



    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script> -->
   

   
<!-- <script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 350,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    
    Webcam.attach( '#my_camera' );
    
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }


</script> -->

<script type="text/javascript">
  $("#series_code").bind('change', function () {
      console.log('hi');
      var Seriescode =  $(this).val();
      var xyz = $('#seriesList1 option').filter(function() {

        return this.value == Seriescode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      
        console.log('msg',msg);
      if(msg=='No Match'){
         $(this).val('');
         $('#getSeriesCode').val('');
      }else{
         $('#series_code').val(Seriescode+'[ '+msg+' ]');
         $('#getSeriesCode').val(Seriescode);
      }

    objvalidtn.checkBlankFieldValid();
  });
</script>

<script type="text/javascript">
  
   $('#demo').datetimepicker({

    });
</script>

<script type="text/javascript">
$(document).ready(function(){
   $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
    if (keycode == 46 || this.value.length==10) {
    return false;
  }
});
  $("#plant_list").bind('change', function () {  

          var val = $(this).val();
          
          var xyz = $('#plantList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
          
          if(msg == 'No Match'){

              $(this).val('');

               $('#plantName').val('');

          }else{

            $('#plantName').val(msg);
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
        title: 'Help Item Group Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var ItemGroupH = $('#ItemGroupH').val();

           if(ItemGroupH == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-itemgroup-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {ItemGroupH: ItemGroupH},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Item Group Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ITEMGROUP_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ITEMGROUP_NAME+'</td></tr>');
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

   $('.datepicker').datepicker({

            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            todayHighlight: 'true',
            autoclose: 'true'
    });

  });
</script>

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>



@endsection