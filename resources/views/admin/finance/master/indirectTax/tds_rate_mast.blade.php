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



            Master TDS Rate



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

           

            <li class="Active"><a href="{{ URL('/Master/InDirect-Direct-Tax/Tds-Rate-Mast')}}">Master TDS Rate</a></li>

            <li class="Active"><a href="{{ URL('/Master/InDirect-Direct-Tax/Tds-Rate-Mast')}}">Add TDS Rate</a></li>

           

           <?php } else { ?>



             <li class="Active"><a href="{{ URL('/Master/InDirect-Direct-Tax/Edit-Tds-Rate-Mast/'.base64_encode($tdsrate_id))}}">Master TDS Rate</a></li>

             <li class="Active"><a href="{{ URL('/Master/InDirect-Direct-Tax/Edit-Tds-Rate-Mast/'.base64_encode($tdsrate_id))}}">Update TDS Rate</a></li>

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



               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Master TDS Rate</h2>

               <div class="box-tools pull-right showinmobile">

                  <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View TDS Rate</a>

               </div>




             <?php } else{  ?>



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Master TDS Rate</h2>

               <div class="box-tools pull-right showinmobile">

                  <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View TDS Rate</a>

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



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        TDS Code : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <?php if($button=='Update') { $readVar = 'readonly';}else{$readVar = '';}?>
                          <?php $tdscount = count($tds_list); ?>
                          <input list="tdsList" type="text" class="form-control" name="tds_code" id="tds_code" value="<?php if($tdscount == 1){echo $tds_list[0]->TDS_CODE;}else{echo $tds_code;} ?>" placeholder="Select Tds Code" <?php echo $readVar;?> maxlength="6" autocomplete="off" >

                          <datalist id="tdsList">
                          

                            <option value="">--SELECT--</option>


                            @foreach($tds_list as $key)


                            <option value="{{ $key->TDS_CODE }}" data-xyz ="<?php echo $key->TDS_NAME; ?>" <?php if($tds_code==$key->TDS_CODE){ echo 'selected';} ?>> {{ $key->TDS_CODE }} = {{ $key->TDS_NAME }}</option>



                            @endforeach

                            </datalist>

                         



                        </div>


                        <div class="pull-left showSeletedName" id="tdsText"></div>

                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('tds_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>





                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Account Code : 



                        <!-- <span class="required-field"></span> -->



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <?php $account = count($acc_list); ?>

                          <input list="accList" type="text" class="form-control" name="acc_code" id="acc_code" value="<?php if($account == 1){echo $acc_list[0]->ACC_CODE;}else{echo $acc_code;} ?>" placeholder="Select Acc Code" maxlength="6" autocomplete="off">

                          <datalist id="accList">



                            <option value="">--SELECT--</option>



                            @foreach($acc_list as $key)



                            <option value="{{ $key->ACC_CODE }}" data-xyz ="<?php echo $key->ACC_NAME; ?>" <?php if($acc_code==$key->ACC_CODE){ echo 'selected';} ?>> {{ $key->ACC_CODE }} = {{ $key->ACC_NAME }}</option>



                            @endforeach


                          </datalist>



                        </div>


                        <div class="pull-left showSeletedName" id="accText"></div>

                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}



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



                        TDS Rate : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="tds_rate" value="{{$tds_rate}}" placeholder="Enter TDS Rate" maxlength="11" autocomplete="off">



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('tds_rate', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        From Date : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <?php 
                                if($from_date){

                               $FromDate = date("d-m-Y", strtotime($from_date));
                             }else{
                               $FromDate = date("d-m-Y");
                             }

                              // print_r($FromDate); 
                          ?>

                          <input type="text" class="form-control datepicker" id="from_date" name="from_date" value="{{ $FromDate }}" placeholder="Enter From Date" readonly="">



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}



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



                       To Date : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>


                          <?php 
                              if($to_date){

                               $ToDate = date("d-m-Y", strtotime($to_date)); 
                              }else{

                               $ToDate = date("d-m-Y"); 
                              }
                          ?>
                          <input type="text" class="form-control datepicker1" name="to_date" id="to_date" value="{{ $ToDate }}" placeholder="Enter To Rate" readonly="">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                  <?php if($button=='Update') { ?>

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       TDS Block : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <input type="radio" class="optionsRadios1" name="tdsrate_block" value="YES" <?php if($tdsrate_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                          <input type="radio" class="optionsRadios1" name="tdsrate_block" value="NO" <?php if($tdsrate_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('tdsrate_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>







                    </div>



                    <!-- /.form-group -->



                  </div>

                <?php } ?>



              </div>

              <!-- /.row -->



             



               









              <div style="text-align: center;">



                 <button type="Submit" class="btn btn-primary">

                  <input type="hidden" name="idtds" value="{{$tdsrate_id}}">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 



                 </button>



              </div>



            </form>



          </div><!-- /.box-body -->



           



          </div>



      </div>



      <div class="col-sm-3 hideinmobile">



        <div class="box-tools pull-right">



          <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tds-Rate-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View TDS Rate</a>



        </div>



      </div>







    </div>



     



  </section>



</div>















@include('admin.include.footer')


<script type="text/javascript">

  /*$(function () {
            $("#datepicker").datepicker();
            $('#to_date').datepicker("destroy");
    $('#from_date').datepicker("destroy");
        });*/
  $(document).ready(function(){

    

  $("#tds_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#tdsList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("tdsText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });





  $("#acc_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("accText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });
   });
</script>



<script type="text/javascript">

  

  $(document).ready(function() {



    $('.datepicker').datepicker({

        format: 'dd-mm-yyyy',

        orientation: 'bottom',

        todayHighlight: 'true',

        endDate: 'today',
        
        autoclose:'true'

    });

    $('.datepicker1').datepicker({

        format: 'dd-mm-yyyy',

        orientation: 'bottom',

        todayHighlight: 'true',

        startDate: 'today',
        
        autoclose:'true'

    });

   



  });



  

</script>



<!-- <script type="text/javascript">

  $('#itemcategory_name').on('change',function(){



   var email =  $('#itemcategory_name').val();



    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

      if(!regex.test(email)) {

        alert('wrong');

        $('#itemcategory_name').val('');

        return false;

      }else{

        return true;

      }



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



@endsection