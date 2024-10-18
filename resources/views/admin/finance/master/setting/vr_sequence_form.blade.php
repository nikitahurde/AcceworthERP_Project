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

  .rightcontent{

  text-align:right;


}
.showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }

::placeholder {
  
  text-align:left;
}


</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->


        <section class="content-header">


          <h1>


            Master Vr Sequence


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

            <li class="Active"><a href="{{ URL('/finance/vr-sequence')}}">Master Vr Sequence</a></li>



            <li class="Active"><a href="{{ URL('/finance/vr-sequence')}}">Add Vr Sequence</a></li>



           <?php } else { ?>


             <li class="Active"><a href="{{ URL('/finance/edit-vr-sequence/'.base64_encode($vrseq_id))}}">Master Vr Sequence</a></li>



             <li class="Active"><a href="{{ URL('/finance/edit-vr-sequence/'.base64_encode($vrseq_id))}}">Update Vr Sequence</a></li>



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

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add  Vr Sequence</h2>

             <?php } else{  ?>

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update  Vr Sequence</h2>

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

                        Company Name : 

                        <span class="required-field"></span>

                      </label>


                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="compList" type="text" class="form-control" name="company_code" id="company_code" placeholder="Select Company" maxlength="6" value="{{ $company_code }}"  <?php if($button=='Update') { ?> readonly <?php } ?>>

                            <datalist id="compList">

                              <option value="">--SELECT--</option>

                              @foreach($comp_list as $key)

                              <option value="{{ $key->COMP_CODE }}" data-xyz ="<?php echo $key->COMP_NAME; ?>"> {{ $key->COMP_CODE }} = {{ $key->COMP_NAME }}</option>

                              @endforeach
                        
                           </datalist>

                        </div>


                          <div class="pull-left showSeletedName" id="compText"></div>
                          <small id="emailHelp" class="form-text text-muted">


                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}


                          </small>

                    </div>


                    <!-- /.form-group -->


                  </div>

                     <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Fy Code : 

                        <span class="required-field"></span>

                      </label>


                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <?php $macyaer = Session::get('macc_year'); ?>
                          <input type="text" class="form-control" name="fy_code" id="fy_code" placeholder="Select Fy" maxlength="9" value="{{ $macyaer }}" readonly="">

                           

                        </div>


                          <div class="pull-left showSeletedName" id="compText"></div>
                          <small id="emailHelp" class="form-text text-muted">


                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}


                          </small>

                    </div>


                    <!-- /.form-group -->


                  </div>


                  


              </div>



              <!-- /.row -->







              <!-- /.row -->





              <div class="row">




                 <div class="col-md-6">







                    <div class="form-group">







                      <label>







                        Transaction Code : 







                        <span class="required-field"></span>







                      </label>







                        <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input list="tranList" type="text" class="form-control" name="tran_code" id="transactnid" placeholder="Select Transaction" maxlength="2" <?php if($button=='Update') { ?> readonly <?php } ?> value="{{ $tran_code }}" >  

                          <datalist id="tranList">

                            <option value="">--SELECT--</option>



                            @foreach($transaction_list as $key)



                            <option value="{{ $key->TRAN_CODE }}" data-xyz ="<?php echo $key->TRAN_HEAD; ?>" > {{ $key->TRAN_CODE }} = {{ $key->TRAN_HEAD }}</option>



                            @endforeach


                          </datalist>







                        </div>




                           <div class="pull-left showSeletedName" id="tranText"></div>


                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}







                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>


                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                        Series Code : 







                        <span class="required-field"></span>







                      </label>







                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>




                          <input list="seriesList" class="form-control" id="seriesid" name="series_code" placeholder="Select Series Code" maxlength="6" value="{{ $series_code }}" <?php if($button=='Update') { ?> readonly <?php } ?>>

                          <datalist id="seriesList">

                            <?php if($button=='Save'){ ?>



                            <option value="">--SELECT--</option>



                          <?php }else{ ?>



                            <option value="">--SELECT--</option>

                            <option value="{{$series_code}}"> {{ $series_code }}</option>



                          <?php } ?>



                          </datalist>


                        </div>







                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}







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







                        From No : 







                        <span class="required-field"></span>







                      </label>







                        <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control rightcontent Number" name="from_no" id="from_no" value="{{$from_no}}" placeholder="Enter From No" maxlength="11">





                        </div>







                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('from_no', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>


                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                        To No : 







                        <span class="required-field"></span>







                      </label>







                        <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control rightcontent Number" name="to_no" value="{{$to_no}}" placeholder="Enter To No" maxlength="11">



                        </div>







                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('to_no', '<p class="help-block" style="color:red;">:message</p>') !!}







                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>





              </div>


<div class="row">

  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                        Last No : 







                        <span class="required-field"></span>







                      </label>







                        <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control rightcontent Number" name="last_no" id="last_no" value="{{$last_no}}" placeholder="Enter Last No" maxlength="11">





                        </div>





                           <small id="lastNoError" style="color: red;"></small>

                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('last_no', '<p class="help-block" style="color:red;">:message</p>') !!}







                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>
  


              <!-- /.row -->


<?php if($button=='Update') { ?>



           







                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                       Vr Sequence Block : 







                        <span class="required-field"></span>







                      </label>







                        <div class="input-group">







                          <input type="radio" class="optionsRadios1" name="vrseq_block" value="YES" <?php if($vrseq_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;







                          <input type="radio" class="optionsRadios1" name="vrseq_block" value="NO" <?php if($vrseq_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO







                        </div>







                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('vrseq_block', '<p class="help-block" style="color:red;">:message</p>') !!}







                          </small>















                    </div>







                    <!-- /.form-group -->







                  </div>







               


<?php } ?>


 </div>









              <div style="text-align: center;">







                 <button type="Submit" id="submitBtn" class="btn btn-primary">



                  <input type="hidden" name="vrseqId" value="{{$vrseq_id}}">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 







                 </button>







              </div>







            </form>







          </div><!-- /.box-body -->







           







          </div>







      </div>







      <div class="col-sm-3">







        <div class="box-tools pull-right">







          <a href="{{ url('/Master/Setting/View-Vr-Sequence') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Vr Sequence </a>







        </div>







      </div>















    </div>







     







  </section>







</div>































@include('admin.include.footer')

<script type="text/javascript">
  $(document).ready(function(){

  $("#company_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

       //  document.getElementById("compText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');  
             document.getElementById("compText").innerHTML = '';        
          }else{
            document.getElementById("compText").innerHTML = msg;
          }

        });



  $("#pfct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#pfctList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

        // document.getElementById("pfctText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("pfctText").innerHTML = ''; 
          }else{
            document.getElementById("pfctText").innerHTML = msg; 
          }

        });





       $("#transactnid").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#tranList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

        // document.getElementById("tranText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          
             document.getElementById("tranText").innerHTML = ''; 
          }else{
            document.getElementById("tranText").innerHTML = msg; 
          }

        });


        $("#seriesid").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#seriesList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         //document.getElementById("tranText").innerHTML = msg; 

          if(msg=='No Match'){
             $(this).val('');
          }

        });

   });
</script>

<script type="text/javascript">
  $(document).ready(function() {

    $("#last_no").on('input', function(event) {

      var from_no = parseInt($('#from_no').val());
      var last_no = parseInt($(this).val());

      console.log("Form No...! ", from_no);

      console.log("Last No...! ", last_no);

      if (last_no < from_no ) {

        console.log("error...");

         $("#lastNoError").html('Last No Is Grater Than Form No.');

        $('#submitBtn').prop('disabled',true);

      }else{

        console.log("Last No...! ");
         $("#lastNoError").html('');
        $('#submitBtn').prop('disabled',false);

      }





    });


  });
</script>



 <script type="text/javascript">



  $(document).ready(function() {



      $("#company_code").change(function(){



         $.ajaxSetup({



            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }



         });



        var company_code =  $(this).val();

        

          $.ajax({



            url:"{{ url('fy-year-by-comp-code') }}",



             method : "POST",



             type: "JSON",



             data: {company_code: company_code},



             success:function(data){



              

                  var data1 = JSON.parse(data);



                  if (data1.response == 'error') {



                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");



                  }else if(data1.response == 'success'){

              

                    objcity = data1.data;



                      $('#fy_codeid').empty();



                        $.each(objcity, function (i, objcity) {

                          $('#fy_codeid').append($('<option>', { 

                              value: objcity.FY_CODE,

                              text : objcity.FY_CODE 

                          }));

                        });

                  }

             }



          });



      });





      $("#transactnid").change(function(){



         $.ajaxSetup({



            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }



         });



        var tran_code =  $(this).val();

        

          $.ajax({



            url:"{{ url('series-code-by-comp-code') }}",



             method : "POST",



             type: "JSON",



             data: {tran_code: tran_code},



             success:function(data){



              

                  var data1 = JSON.parse(data);



                  if (data1.response == 'error') {



                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");



                  }else if(data1.response == 'success'){

              

                    objcity = data1.data;



                      $('#seriesList').empty();

                      

                        $.each(objcity, function (i, objcity) {

                          $('#seriesList').append($('<option>', { 

                              value: objcity.SERIES_CODE,

                              'data-xyz': objcity.SERIES_CODE,

                              text : objcity.SERIES_CODE 

                          }));

                        });

                  }

             }



          });



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
    if (keycode == 46 || this.value.length==10) {
    return false;
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