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



            Master Item Packing



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

           

            <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Master Item Packing</a></li>

            <li class="Active"><a href="{{ URL('/Master/Item/Item-Group-Mast')}}">Add Item Packing</a></li>

           

           <?php } else { ?>



             <li class="Active"><a href="{{ URL('/Master/Item/Edit-Item-Group-Mast/'.base64_encode($vehicleId))}}">Master Item Packing</a></li>

             <li class="Active"><a href="{{ URL('/Master/Item/Edit-Item-Group-Mast/'.base64_encode($vehicleId))}}">Update Item Packing</a></li>

           <?php } ?>

            



          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <?php if($button=='Save') { ?>



               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Master Item Packing</h2>
               <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Master/ColdStorage/View-Item-Packing-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Packing</a>

              </div>



             <?php } else{  ?>



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Master Item Packing</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Master/ColdStorage/View-Vehicle-entry-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Packing</a>

              </div>

             <?php } ?>

              <div class="box-tools pull-right">



		          <a href="{{ url('/Master/ColdStorage/View-Item-Packing-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Packing</a>



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

                 <div class="col-md-2">



                    <div class="form-group">



                      <label>



                       Packing ID : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="packing_id" id="packing_id" value="{{ $packing_id }}" placeholder="Enter Packing Id" maxlength="40">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('packing_id', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>


                   <div class="col-md-3">



                    <div class="form-group">



                      <label>



                       Packing Name : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="packing_name" id="packing_name" value="{{ $packing_name }}" placeholder="Enter Driver Name" maxlength="40">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('packing_name', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>


                  </div>

                   <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       Item Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="itemList" class="form-control" name="item_code" placeholder="Enter Item Code"  id="item_code" value="{{$item_code}}" onchange="ItemCodeGet()">

                          <datalist id="itemList">

                          <?php foreach($item_list as $key) { ?>
                           
                                  <option value="<?= $key->ITEM_CODE ?>" data-xyz="<?= $key->ITEM_NAME ?>"><?= $key->ITEM_CODE ?> - <?= $key->ITEM_CODE ?></option>


                          <?php } ?>

                           </datalist>
                        </div>


                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>


                  </div>

                   <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       UM : 

                        <span class="required-field"></span>


                      </label>


                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="um" id="UnitM" value="{{ $um }}" placeholder="Enter Um" maxlength="2" readonly="">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('um', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>


                  </div>


                  <div class="col-md-2">


                    <div class="form-group">



                      <label>



                      AUM : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="aum" id="AddUnitM" value="{{ $aum }}" placeholder="Enter AUM" maxlength="2" readonly="">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('aum', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



              </div>

              <div class="row">



                   <div class="col-md-2">


                    <div class="form-group">



                      <label>



                       C Factor : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="c_factor" id="Cfactor" value="{{ $c_factor }}" placeholder="Enter C factor" maxlength="10">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('c_factor', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                   <div class="col-md-3">



                    <div class="form-group">



                      <label>



                       Rate : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="rate" id="rate" value="{{ $rate }}" placeholder="Enter Rate" maxlength="40">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>


                  <div class="col-md-2">


                    <div class="form-group">



                      <label>



                      L : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                         <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="length" id="length" value="{{ $length }}" placeholder="Enter length" maxlength="10">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('length', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>
                  <div class="col-md-2">


                    <div class="form-group">



                      <label>



                       W : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                         <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="width" id="width" value="{{ $width }}" placeholder="Enter width" maxlength="10">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('width', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>
                  <div class="col-md-2">


                    <div class="form-group">



                      <label>



                       H : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="height" id="height" value="{{ $height }}" placeholder="Enter height" maxlength="10">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('height', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>

                  
                 
              </div>

             </div>

              <div class="row">


              	 <div class="col-md-2">



                    <div class="form-group">



                      <label>



                       Cubic Space : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="cubic_space" id="cubic_space" value="{{ $cubic_space }}" placeholder="Enter Cubic Space" maxlength="40">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('cubic_space', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>


                  <div class="col-md-3">


                    <div class="form-group">



                      <label>



                      HSN CODE : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input list="hsnList" class="form-control" name="hsn_code" id="hsn_code" value="{{ $hsn_code }}" placeholder="Enter Hsn Code" maxlength="10">

                          <datalist id="hsnList">

                          	<?php foreach ($hsn_list as $key) { ?>
                          		
                          	<option value="<?= $key->HSN_CODE ?>" data-xyz="<?= $key->HSN_NAME ?>"><?= $key->HSN_CODE ?> - <?= $key->HSN_NAME ?></option>

                             <?php	} ?>

                          </datalist>



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('hsn_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                  <div class="col-md-3">



                    <div class="form-group">



                      <label>



                      RATE VALIDATE NO OF DAYS : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="no_days" id="no_days" value="{{ $no_days }}" placeholder="Enter No Of Days" maxlength="40">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('no_days', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>


                  </div>

                  <div class="col-md-2">


                    <div class="form-group">



                      <label>



                      GST TAX %: 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="gst_no" id="gst_no" value="{{ $gst_no }}" placeholder="Enter gst" maxlength="10">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('gst_no', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                  <div class="col-md-2">


                    <div class="form-group">



                      <label>



                      Min Qty 1: 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                         <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="min_qty1" id="min_qty1" value="{{ $min_qty1 }}" placeholder="Enter Min Qty 1" maxlength="10">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('min_qty1', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

              </div>

               <div class="row">


                  

                  <div class="col-md-2">


                    <div class="form-group">



                      <label>



                      Min Qty 2: 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="min_qty2" id="min_qty2" value="{{ $min_qty2 }}" placeholder="Enter  Min Qty 2" maxlength="10">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('min_qty2', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                  <div class="col-md-2">


                    <div class="form-group">



                      <label>


                      Min Rate 1: 


                        <span class="required-field"></span>


                      </label>



                      <div class="input-group">



                         <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="min_rate1" id="min_rate1" value="{{ $min_rate1 }}" placeholder="Enter Min Rate 1" maxlength="10">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('min_rate1', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                    <div class="col-md-2">


                    <div class="form-group">



                      <label>



                      Min Rate 2: 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="min_rate2" id="min_rate2" value="{{ $min_rate2 }}" placeholder="Enter Min Rate 2" maxlength="10">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('min_rate2', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>
                 
              </div>


             <div class="row">

                

                  <?php if($button=='Update') { ?>


                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Item Packing Block : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <input type="radio" class="optionsRadios1" name="item_packing_block" value="YES" <?php if($item_packing_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                          <input type="radio" class="optionsRadios1" name="item_packing_block" value="NO" <?php if($item_packing_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('item_packing_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>







                    </div>



                  </div>


<?php } ?>
                 
              </div>


              
                <!-- <div class="row">
                  <div class="col-md-6">
                      <div id="my_camera"></div>
                      <br/>
                      <input type=button value="Take Snapshot" onClick="take_snapshot()">
                      <input type="hidden" name="image" class="image-tag">
                  </div>
                  <div class="col-md-6">
                      <div id="results">Your captured image will appear here...</div>
                  </div>
                  
            </div>

 -->

              <!-- /.row -->









              <div style="text-align: center;">



                 <button type="Submit" class="btn btn-primary">

                  <input type="hidden" name="itempacking_id" value="{{$vehicleId}}">

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
    $('#SearchItemGroup').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var SearchItemGroup = $('#SearchItemGroup').val();

        if(SearchItemGroup == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-itemgroup-code-get') }}",

             method : "POST",

             type: "JSON",

             data: {SearchItemGroup: SearchItemGroup},

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
                            objcity.ITEMGROUP_CODE+'</span><br>');
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


<script type="text/javascript">
	
	function ItemCodeGet(){

		var ItemCode =  $('#item_code').val();

		//alert(ItemCode);

	$.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });


	if(ItemCode){

        $.ajax({

          url:"{{ url('get-item-um-aum') }}",

          method : "POST",

          type: "JSON",

          data: {ItemCode: ItemCode},

           success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                  //console.log(data1.data);
                 
                    if(data1.data==''){

                      var umcode = '';

                      var aumcode = '';

                      var cfactor = '';

                      $('#UnitM').val(umcode);

                      $('#AddUnitM').val(aumcode);

                      $('#Cfactor').val(cfactor);

                    }else{

                      $('#UnitM').val(data1.data[0].UM_CODE);

                      $('#AddUnitM').val(data1.data[0].AUM_CODE);

                      $('#Cfactor').val(data1.data[0].AUM_FACTOR);

                      $('#viewItemDetail').removeClass('showdetail');
                    
                    }
                   

                } /*if close*/

           }  /*success function close*/

        });  /*ajax close*/

      }else{

      }

	}

</script>



@endsection