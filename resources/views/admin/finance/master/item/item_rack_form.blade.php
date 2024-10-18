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

  .showSeletedName{



    font-size: 15px;



    margin-top: 2%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;



  }



</style>







<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master Item Rack


            <?php if($button == 'Save'){ ?>
              <small>Add Details</small>
            <?php }else { ?>
             <small>Update Details</small>
            <?php  }?>
            



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/finance/form-mast-rack') }}">Master Item Rack</a></li>

            <?php if($button == 'Save'){ ?>
              <li class="active"><a href="{{ url('/finance/form-mast-rack') }}">Add Item Rack</a></li>
            <?php }else { ?>
              <li class="active"><a href="{{ url('/finance/form-mast-rack') }}">Update Item Rack</a></li>
            <?php  }?>

            



          </ol>



        </section>



	<section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-8">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              

              <?php if($button == 'Save'){ ?>
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Item Rack </h2>
            <?php }else { ?>
            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Item Rack </h2>
            <?php  }?>

              



              



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



                  <?php if($button=='Update') { $setreadonly = 'readonly'; }else{$setreadonly = '';}?>

                 



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Item Code: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                            <input list="itemList"  id="item_code" name="item_code" class="form-control  pull-left" value="{{ $item_code }}" placeholder="Select Item Code" maxlength="11" <?php echo $setreadonly;?> autocomplete="off">



                          <datalist id="itemList">

                          

                           

                             <option value="">--SELECT--</option>

                             @foreach($item_list as $key)



                             <option value="{{ $key->ITEM_CODE }}" data-1 ="{{ $key->ITEM_NAME }}" <?php if($item_code == $key->ITEM_CODE){ echo "selected";} ?>>{{ $key->ITEM_CODE }} = {{ $key->ITEM_NAME }}</option>



                             @endforeach

                          </datalist>



                        </div>

                        <div class="pull-left showSeletedName" id="itemText"></div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Rack Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></span>

                          <input list="rackList"  id="rack_code" name="rack_code" class="form-control  pull-left" value="{{ $rack_code }}" placeholder="Select Rack Code" maxlength="11" <?php echo $setreadonly;?> autocomplete="off">

                        

                          <datalist id="rackList">



                             <option value="">--SELECT--</option>

                             @foreach($rack_list as $row)

                            <option value="{{ $row->RACK_CODE }}" data-xyz ="{{ $row->RACK_NAME }}" <?php if($rack_code ==$row->RACK_CODE){ echo 'selected'; } ?>>{{ $row->RACK_CODE }} = {{ $row->RACK_NAME }}</option>



                             @endforeach

                           </datalist>



                      </div>

                      <div class="pull-left showSeletedName" id="rackText"></div>

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('rack_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>

               
            <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Company Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                            <input list="compList"  id="comp_code" name="comp_code" class="form-control  pull-left" value="{{ $comp_code }}" placeholder="Select Comp Code" maxlength="11" autocomplete="off">



                          <datalist id="compList">

                          

                           

                             <option value="">--SELECT--</option>

                             @foreach($comp_list as $key)



                             <option value="{{ $key->COMP_CODE }}" data-xyz ="{{ $key->COMP_NAME }}" >{{ $key->COMP_CODE }} = {{ $key->COMP_NAME }}</option>



                             @endforeach

                          </datalist>



                        </div>

                        <div class="pull-left showSeletedName" id="itemText"></div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Plant Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></span>

                          <input list="plantList"  id="plant_code" name="plant_code" class="form-control  pull-left" value="{{ $plant_code }}" placeholder="Select Plant Code" maxlength="11" autocomplete="off">

                        

                          <datalist id="plantList">



                             <option value="">--SELECT--</option>

                             @foreach($plant_list as $row)

                            <option value="{{ $row->PLANT_CODE }}" data-xyz ="{{ $row->PLANT_NAME }}" <?php if($plant_code ==$row->PLANT_CODE){ echo 'selected'; } ?>>{{ $row->PLANT_CODE }} = {{ $row->PLANT_NAME }}</option>

                             @endforeach

                           </datalist>



                      </div>

                      <div class="pull-left showSeletedName" id="rackText"></div>

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>

            <div class="row">
              <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        PFCT Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></span>

                          <input list="pfctList"  id="pfct_code" name="pfct_code" class="form-control  pull-left" value="{{ $pfct_code }}" placeholder="Select Pfct Code" maxlength="11" autocomplete="off">


                          <datalist id="pfctList">



                             <option value="">--SELECT--</option>

                             @foreach($pfct_list as $row)

                            <option value="{{ $row->PFCT_CODE }}" data-xyz ="{{ $row->PFCT_NAME }}" <?php if($pfct_code ==$row->PFCT_CODE){ echo 'selected'; } ?>>{{ $row->PFCT_CODE }} = {{ $row->PFCT_NAME }}</option>



                             @endforeach

                           </datalist>


                      </div>

                      <div class="pull-left showSeletedName" id="rackText"></div>

                      <small id="emailHelp" class="form-text text-muted">


                        {!! $errors->first('pfct_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>


                  </div>

                  <?php if($button=='Update') { ?>

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Item Rack Block : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                         



                          <input type="radio" class="optionsRadios1" name="item_rack_block" value="YES" <?php if($item_rack_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="item_rack_block" value="NO" <?php if($item_rack_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('rack_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



             

<?php } ?>
            </div>

                  

                  

                



                <!-- /.col -->







              <!-- /.row -->





              <!-- /.row -->





              <div style="text-align: center;">

              	<input type="hidden" name="item_rack_id" value="{{ $item_rack_id }}">

                 <button type="Submit" class="btn btn-primary">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  {{ $button }}





                 </button>



              </div>



            </form>



          </div><!-- /.box-body -->



           



          </div>



      </div>



      <div class="col-sm-3">



        <div class="box-tools pull-right">



          <a href="{{ url('/Master/Item/View-Item-Rack-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Rack</a>



        </div>



      </div>







    </div>



     



	</section>



</div>







@include('admin.include.footer')



<script type="text/javascript">



    $(document).ready(function(){



        $("#item_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#itemList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("itemText").innerHTML = msg; 



        });



        $("#rack_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#rackList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("rackText").innerHTML = msg; 



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




@endsection