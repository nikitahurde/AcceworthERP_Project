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

.showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;
    margin-bottom: 2%;

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
.popover{
   left: 45.977px !important;
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







            Master House Cash







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



           



            <li class="Active"><a href="{{ URL('/Master/House-bank-cash/House-Cash-Mast')}}">Master House Cash</a></li>



            <li class="Active"><a href="{{ URL('/Master/House-bank-cash/House-Cash-Mast')}}">Add House Cash</a></li>



           



           <?php } else { ?>







             <li class="Active"><a href="{{ URL('/Master/House-bank-cash/Edit-House-Cash/'.base64_encode($houscash_id))}}">Master House Cash</a></li>



             <li class="Active"><a href="{{ URL('/Master/House-bank-cash/Edit-House-Cash/'.base64_encode($houscash_id))}}">Update House Cash</a></li>



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



               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Master House Cash</h2>

               

             <?php } else{  ?>




              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Master House Cash</h2>

               

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


                        GL Code : <span class="required-field"></span>


                      </label>


                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></span>


                          <input type="hidden" name="gl_code_name" id="gl_code_name" value="{{ $gl_code_name }}">

                          <input list="glList" type="text" class="form-control Number" name="gl_code" id="gl_code" placeholder="Select GL Code" value="{{ $gl_code }}" maxlength="20">


                          <datalist id="glList">

                            <option value="">--SELECT--</option>


                            @foreach($glmst_list as $key)


                            <option value="{{ $key->GL_CODE }}" data-xyz ="<?php echo $key->GL_NAME; ?>" <?php if($gl_code==$key->GL_CODE){ echo 'selected';} ?>> {{ $key->GL_CODE }} = {{ $key->GL_NAME }}</option>



                            @endforeach

                          </datalist>


                        </div>

                          <div class="pull-left showSeletedName" id="glText">{{ $gl_code_name }}</div>

                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}







                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                   <div class="col-md-6">


                    <div class="form-group">



                      <label>



                        Cash Code : 

                        <span class="required-field"></span>


                      </label>
                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>


                          <input type="text" class="form-control Number codeCapital" name="cash_code" value="{{$cash_code}}" placeholder="Enter Cash Code" id="cash_code_search" maxlength="6" <?php if($button=='Update') { ?> readonly <?php } ?>>

                        <?php if($button=='Save') { ?>
                          <span class="input-group-addon" style="padding: 1px 7px;left: 50%">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>
                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="cashC" id="cashC" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -12%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Cash Code</th>
                                    <th class="nameheading">Cash Name</th>
                                    
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($help_cash_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd" ><?php echo $key->CASH_CODE; ?></td>
                                        <td class="setetxtintd" ><?php echo $key->CASH_NAME; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                      
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

                            {!! $errors->first('cash_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>


                    </div>



                    <!-- /.form-group -->



                  </div>

                  
                 
               </div>


               <div class="row">


                  <div class="col-md-6">
                    <div class="form-group">

                      <label> Cash Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control Number" name="cash_name" id="cash_name" placeholder="Enter Cash Name" value="{{ $cash_name }}" maxlength="40">

                        </div>

                        <div class="pull-left showSeletedName" id="glText"></div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('cash_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">


                      <label>


                        Company Name : 




                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                          <?php $compcount = count($comp_list); ?>

                          <input list="compList"  type="text" class="form-control" name="company_code" id="company_code" placeholder="Select Company Code" value="<?php if($compcount ==1){echo $comp_list[0]->COMP_CODE;}else{echo $company_code;} ?>" maxlength="40">

                          <datalist id="compList">

                            <option value="">--SELECT--</option>



                            @foreach($comp_list as $key)

                            <option value="{{ $key->COMP_CODE }}" data-xyz ="<?php echo $key->COMP_NAME; ?>" <?php if($company_code==$key->COMP_CODE){ echo 'selected';} ?>> {{ $key->COMP_CODE }} = {{ $key->COMP_NAME }}</option>



                            @endforeach


                          </datalist>


                        </div>

                          <input type="hidden" value="<?php if($compcount ==1){echo $comp_list[0]->COMP_NAME;}else{echo $compName;} ?>" name="compName" id="compName">
                          <div class="pull-left showSeletedName" id="compText"><?php if($compcount ==1){echo $comp_list[0]->COMP_NAME;}else{echo $compName;} ?></div>

                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>


                    </div>

                    <!-- /.form-group -->

                  </div>


              </div>


              <div class="row">


                   <div class="col-md-6">


                    <div class="form-group">

                      <label>

                        Profit Center Name : 


                      </label>


                        <div class="input-group">


                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                          <?php $pfcount = count($pfct_list); ?>

                          <input list="pfctList" class="form-control" id="pfct_code" name="pfct_code" placeholder="Select Pfct Code" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_CODE;}else{echo $pfct_code;} ?>" maxlength="6" autocomplete="off">



                          <datalist id="pfctList">

                        </datalist>



                        </div>

                            <input type="hidden" value="<?php if($pfcount == 1){echo $pfct_list[0]->PFCT_NAME;}else{echo $pfctName;} ?>" name="pfctName" id="pfctName">
                            <div class="pull-left showSeletedName" id="pfctText"><?php if($pfcount == 1){echo $pfct_list[0]->PFCT_NAME;}else{echo $pfctName;} ?></div>


                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('pfct_code', '<p class="help-block" style="color:red;">:message</p>') !!}







                          </small>



                    </div>



                    <!-- /.form-group -->



                  </div>









              </div>



              <!-- /.row -->











<?php if($button=='Update') { ?>



              <div class="row">







                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                       House Block : 







                        <span class="required-field"></span>







                      </label>







                        <div class="input-group">







                          <input type="radio" class="optionsRadios1" name="house_block" value="YES" <?php if($house_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;







                          <input type="radio" class="optionsRadios1" name="house_block" value="NO" <?php if($house_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO







                        </div>







                          <small id="emailHelp" class="form-text text-muted">







                            {!! $errors->first('house_block', '<p class="help-block" style="color:red;">:message</p>') !!}







                          </small>















                    </div>







                    <!-- /.form-group -->







                  </div>







                </div>



<?php } ?>











              <div style="text-align: center;">







                 <button type="Submit" class="btn btn-primary">



                  <input type="hidden" name="idhousecash" value="{{$houscash_id}}">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 







                 </button>







              </div>







            </form>







          </div><!-- /.box-body -->







           







          </div>







      </div>







      <div class="col-sm-3 hideinmobile">







        <div class="box-tools pull-right">







          <a href="{{ url('/Master/House-bank-cash/View-House-Cash-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View House Cash</a>







        </div>







      </div>















    </div>







     







  </section>







</div>

@include('admin.include.footer')


<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Cash Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var HelpcashCode = $('#cashC').val();

           if(HelpcashCode == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('/finance/help-cash-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpcashCode : HelpcashCode},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Cash Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.CASH_CODE+'</td></tr>');
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

<!-- <script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script> -->


<script type="text/javascript">
  $(document).ready(function(){
    $('#cash_code_search').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var cash_code_search = $('#cash_code_search').val();

        if(cash_code_search == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('/finance/search-cash-code') }}",

             method : "POST",

             type: "JSON",

             data: {cash_code_search: cash_code_search},

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
                            objcity.CASH_CODE+'</span><br>');
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


  $("#company_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
             $(this).val('');
             $('#compText').html('');
             $('#compName').val('');
             $('#pfctName').val('');
             $('#pfctText').html('');
             $("#pfctList").empty();
             $('#pfct_code').val('');
          }else{

            $('#compText').html(msg);
            $('#compName').val(msg);

            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            var comp_code =  $('#company_code').val();

            $.ajax({

              url:"{{ url('get-plant-data-against-company') }}",

              method : "POST",

              type: "JSON",

              data: {comp_code: comp_code},

              success:function(data){

                var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                  }else if(data1.response == 'success'){

                    if(data1.data == ''){

                    }else{

                      $.each(data1.pfctdata, function(k, getData){

                      $("#pfctList").empty();

                      $("#pfctList").append($('<option>',{

                        value:getData.PFCT_CODE,
                        'data-xyz':getData.PFCT_NAME,
                        text:getData.PFCT_NAME


                      }));

                    });

                    }

                  }

              }

            });

          }

  });




  $("#pfct_code").bind('change', function () {  

          var val = $("#pfct_code").val();

          var xyz = $('#pfctList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
             $("#pfct_code").val('');
             $("#pfctName").val('');
             $('#pfctText').html('');
          }else{
            $('#pfctText').html(msg);
            $('#pfctName').val(msg);
          }

        });


  $("#gl_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#glList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

            $(this).val('');
            $("#glText").html('');
            $('#gl_code_name').val('');
          }else{
            $("#gl_code_name").val(msg);
            $("#glText").html(msg);
          }

        });
   });
</script>

<script type="text/javascript">

  $(document).ready(function() {
  $(".Number").on("keypress", function(evt) {
    var keycode = evt.charCode || evt.keyCode;
    if (keycode == 46 || this.value.length==11) {
      return false;
    }
  });

  });

</script>

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











@endsection