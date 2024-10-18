@extends('admin.main')



@section('AdminMainContent')


@include('admin.include.header')



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


</style>



<div class="content-wrapper">



        <section class="content-header">



          <h1>




            Master Valuation Transaction


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



            <li class="Active"><a href="{{ URL('/Master/Cost-Center/Valuation-Tran-Mast')}}">Master Valuation Trans</a></li>



            <li class="Active"><a href="{{ URL('/Master/Cost-Center/Valuation-Tran-Mast')}}">Add Valuation Trans</a></li>




           <?php } else { ?>



             <li class="Active"><a href="{{ URL('/Master/Cost-Center/Edit-Valuation-Tran-Mast/'.base64_encode($idvaltrans))}}">Master Valuation Trans</a></li>



             <li class="Active"><a href="{{ URL('/Master/Cost-Center/Edit-Valuation-Tran-Mast/'.base64_encode($idvaltrans))}}">Update Valuation Trans</a></li>



           <?php } ?>




          </ol>

        </section>



  <section class="content">


    <div class="row">


      <div class="col-sm-2"></div>

      <div class="col-sm-7">


        <div class="box box-primary Custom-Box">


            <div class="box-header with-border" style="text-align: center;">


              <?php if($button=='Save') { ?>



               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Master Valuation Transaction</h2>



             <?php } else{  ?>


              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Master Valuation Transaction</h2>


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




              <?php if($button=='Save') { ?>



               <div class="row">

                  <div class="col-md-6">


                    <div class="form-group">

                      <label>
                        Company Code : 
                        <span class="required-field"></span>
                      </label>

                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                          <?php $compcount = count($comp_list); ?>
                          <input list="compList" type="text" class="form-control Number" name="comp_code" id="comp_code" value="<?php if($compcount == 1){echo $compcount[0]->COMP_CODE;}else{echo $comp_code;} ?>" placeholder="Select Company Code" maxlength="6">

                         <datalist id="compList">

                            <option value="">--SELECT--</option>

                            @foreach($comp_list as $key)

                              <option value="{{ $key->COMP_CODE }}" data-xyz ="<?php echo $key->COMP_NAME; ?>" <?php if($comp_code==$key->COMP_CODE){ echo 'selected';} ?>> {{ $key->COMP_CODE }} = {{ $key->COMP_NAME }}</option>

                            @endforeach


                         </datalist>




                        </div>


                         <div class="pull-left showSeletedName" id="compText"></div>

                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}




                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                  <div class="col-md-6">


                    <div class="form-group">

                      <label>



                        Valuation Code : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">


                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                          <?php $valcount = count($valution_code); ?>
                          <input list="valList" type="text" class="form-control Number" name="valution_code" id="valution_code" value="<?php if($valcount == 1){echo $valution_code[0]->VALUATION_CODE;}else{echo $val_code;} ?>" placeholder="Select Valution Code" maxlength="6">

                         <datalist id="valList">

                            <option value="">--SELECT--</option>

                            @foreach($valution_code as $key)


                            <option value="{{ $key->VALUATION_CODE }}" data-xyz ="<?php echo $key->VALUATION_NAME; ?>" <?php if($val_code==$key->VALUATION_CODE){ echo 'selected';} ?>> {{ $key->VALUATION_CODE }} = {{ $key->VALUATION_NAME }}</option>

                            @endforeach


                         </datalist>




                        </div>


                         <div class="pull-left showSeletedName" id="valText"></div>

                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('valution_code', '<p class="help-block" style="color:red;">:message</p>') !!}




                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>



              </div>



              <div class="row">

                  <div class="col-md-6">




                    <div class="form-group">


                      <label>



                        Item Type : 




                        <span class="required-field"></span>


                      </label>



                        <div class="input-group">


                          <span class="input-group-addon"><i class="fa fa-list"></i></span>
                          
                          <input list="itemList" type="text" class="form-control Number" name="item_type" value="{{$item_type}}" id="item_type" placeholder="Select Series Code" maxlength="6">

                          <datalist id="itemList">

                            <option value="">--SELECT--</option>


                            @foreach($itmtype_list as $key)



                            <option value="{{ $key->ITEMTYPE_CODE }}" data-xyz ="<?php echo $key->ITEM_TYPE_NAME; ?>" <?php if($item_type==$key->ITEMTYPE_CODE){ echo 'selected';} ?>> {{ $key->ITEMTYPE_CODE }} = {{ $key->ITEM_TYPE_NAME }}</option>




                            @endforeach


                          </datalist>



                        </div>

                         <div class="pull-left showSeletedName" id="itmtypText"></div>

                         <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('item_type', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>

                    </div>



                    <!-- /.form-group -->



                  </div>





                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                        DRGL Code : 







                        <span class="required-field"></span>







                      </label>







                        <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>







                          <input type="text" class="form-control Number" name="drgl_code" value="{{$drgl_code}}" placeholder="Enter DRGL Code" maxlength="6" autocomplete="off">


                        </div>


                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('drgl_code', '<p class="help-block" style="color:red;">:message</p>') !!}







                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>







              </div>



              <!-- /.row -->




              <div class="row">





                  <div class="col-md-6">




                    <div class="form-group">




                      <label>



                       CRGL Code : 




                        <span class="required-field"></span>



                      </label>


                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control Number" name="crgl_code" id="crgl_code" value="{{$crgl_code}}" placeholder="Enter CRGL Code" maxlength="6" autocomplete="off">


                      </div> 

                      <small id="emailHelp" class="form-text text-muted">




                        {!! $errors->first('crgl_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>

                    <!-- /.form-group -->



                  </div>


              </div>



              <!-- /.row -->



          <?php } ?>

         


<?php if(isset($button)){ if($button=='Update') { ?>



              <div class="row">


                <div class="col-md-6">


                    <div class="form-group">

                      <label>
                        Company Code : 
                        <span class="required-field"></span>
                      </label>

                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                          <?php $compcount = count($comp_list); ?>
                          <input list="compList" type="text" class="form-control Number" name="comp_code" id="comp_code" value="<?php if($compcount == 1){echo $compcount[0]->COMP_CODE;}else{echo $comp_code;} ?>" placeholder="Select Company Code" maxlength="6" autocomplete="off">

                         <datalist id="compList">

                            <option value="">--SELECT--</option>

                            @foreach($comp_list as $key)

                              <option value="{{ $key->COMP_CODE }}" data-xyz ="<?php echo $key->COMP_NAME; ?>" <?php if($comp_code==$key->COMP_CODE){ echo 'selected';} ?>> {{ $key->COMP_CODE }} = {{ $key->COMP_NAME }}</option>

                            @endforeach


                         </datalist>




                        </div>


                         <div class="pull-left showSeletedName" id="compText"></div>

                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}




                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>


                <div class="col-md-6">



                    <div class="form-group">


                      <label>


                        Valuation Code : 



                        <span class="required-field"></span>


                      </label>



                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>


                          <input list="valList" type="text" class="form-control" name="valution_code" placeholder="Select Valuation Code" value="{{ $valuation_code}}" maxlength="6" autocomplete="off">
                         
                          <datalist id="valList">

                            <option value="">--SELECT--</option>


                            @foreach($valution_code as $key)

                            <option value="{{ $key->VALUATION_CODE }}" <?php if($valuation_code==$key->VALUATION_CODE){ echo 'selected';} ?>> {{ $key->VALUATION_CODE }} = {{ $key->VALUATION_NAME }}</option>



                            @endforeach

                        </datalist>


                        </div>



                          <small id="emailHelp" class="form-text text-muted">


                            {!! $errors->first('valution_code', '<p class="help-block" style="color:red;">:message</p>') !!}


                          </small>


                    </div>


                    <!-- /.form-group -->


                </div>










            </div>



            <div class="row">


                  <div class="col-md-6">




                    <div class="form-group">


                      <label>



                        Item Type : 




                        <span class="required-field"></span>


                      </label>



                        <div class="input-group">


                          <span class="input-group-addon"><i class="fa fa-list"></i></span>
                          
                          <input list="itemList" type="text" class="form-control Number" name="item_type" value="{{$item_type}}" id="item_type" placeholder="Select Series Code" maxlength="6" autocomplete="off">

                          <datalist id="itemList">

                            <option value="">--SELECT--</option>


                            @foreach($itmtype_list as $key)



                            <option value="{{ $key->ITEMTYPE_CODE }}" data-xyz ="<?php echo $key->ITEM_TYPE_NAME; ?>" <?php if($item_type==$key->ITEMTYPE_CODE){ echo 'selected';} ?>> {{ $key->ITEMTYPE_CODE }} = {{ $key->ITEM_TYPE_NAME }}</option>




                            @endforeach


                          </datalist>



                        </div>

                         <div class="pull-left showSeletedName" id="itmtypText"></div>

                         <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('item_type', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>

                    </div>



                    <!-- /.form-group -->



                  </div>






                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                        DRGL Code : 







                        <span class="required-field"></span>







                      </label>







                        <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>







                          <input type="text" class="form-control" name="drgl_code" value="{{$drgl_code}}" placeholder="Enter DRGL Code" maxlength="6" autocomplete="off">







                        </div>







                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('drgl_code', '<p class="help-block" style="color:red;">:message</p>') !!}







                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>







              </div>



              <!-- /.row -->



              <div class="row">



                  <div class="col-md-6">







                    <div class="form-group">







                      <label>



                       CRGL Code : 





                        <span class="required-field"></span>





                      </label>




                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>


                          <input type="text" class="form-control" name="crgl_code" id="crgl_code" value="{{$crgl_code}}" placeholder="Enter CRGL Code" maxlength="6" autocomplete="off">




                      </div> 







                      <small id="emailHelp" class="form-text text-muted">







                        {!! $errors->first('crgl_code', '<p class="help-block" style="color:red;">:message</p>') !!}







                      </small>







                    </div>







                    <!-- /.form-group -->







                  </div>





                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                       Valuation Transaction Block : 







                        <span class="required-field"></span>







                      </label>





                          <br>

                          <label for="vtrBlock1">Yes</label>&nbsp;&nbsp;

                          <input type="radio" name="valtran_block" id="valtran_block" value="YES" <?php if($valtran_block=='YES'){ echo 'checked';} ?>> &nbsp;&nbsp;&nbsp;



                          <label for="vtrBlock1">No</label>&nbsp;&nbsp;

                           <input type="radio"  name="valtran_block" id="valtran_block"  value="NO" <?php if($valtran_block=='NO'){ echo 'checked';} ?>>





                      <small id="emailHelp" class="form-text text-muted">







                        {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}







                      </small>







                    </div>







                    <!-- /.form-group -->







                  </div>







              </div>



              <!-- /.row -->



<?php } }?>











              <div style="text-align: center;">







                 <button type="Submit" class="btn btn-primary">



                  <input type="hidden" name="idvaltrans" value="{{$idvaltrans}}">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 







                 </button>







              </div>







            </form>







          </div><!-- /.box-body -->







           







          </div>







      </div>







      <div class="col-sm-3">







        <div class="box-tools pull-right">







          <a href="{{ url('/Master/Cost-Center/View-Valuation-Tran-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Valuation Trans</a>







        </div>







      </div>















    </div>







     







  </section>







</div>



@include('admin.include.footer')


<script type="text/javascript">



  $(document).ready(function() {







    $('.datepicker').datepicker({



        format: 'yyyy-mm-dd',



        orientation: 'bottom',



        todayHighlight: 'true',



        endDate: 'today',

        

        autoclose:'true'



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
  $(document).ready(function(){

  $("#valution_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#valList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("valText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });

  $("#comp_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("compText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });





  $("#transaction_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#tranList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("transText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });





  $("#item_type").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("itmtypText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });
   });
</script>










@endsection