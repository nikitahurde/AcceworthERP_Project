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



            Master TDS



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

           

            <li class="Active"><a href="{{ URL('/Master/InDirect-Direct-Tax/Tds-Mast')}}">Master TDS</a></li>

            <li class="Active"><a href="{{ URL('/Master/InDirect-Direct-Tax/Tds-Mast')}}">Add TDS</a></li>

           

           <?php } else { ?>



             <li class="Active"><a href="{{ URL('/Master/InDirect-Direct-Tax/Edit-Tds-Mast/'.base64_encode($tds_id))}}">Master TDS</a></li>

             <li class="Active"><a href="{{ URL('/Master/InDirect-Direct-Tax/Edit-Tds-Mast/'.base64_encode($tds_id))}}">Update TDS</a></li>

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



               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Master TDS</h2>

               <div class="box-tools pull-right showinmobile">

                  <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tds-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View TDS</a>

               </div>



             <?php } else{  ?>



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Master TDS</h2>

               <div class="box-tools pull-right showinmobile">

                  <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tds-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View TDS</a>

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

                          <input type="text" class="form-control codeCapital" name="tds_code" value="{{$tds_code}}" placeholder="Enter TDS Code" maxlength="6" id="TdsCodeSearch" <?php if($button=='Update') { ?> readonly <?php } ?>>

                          <?php if($button=='Save') { ?>
                          <span class="input-group-addon" style="padding: 1px 7px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>
                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="GlmstnameH" id="tdsCodeHelp" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">TDS Code</th>
                                     <th class="nameheading">TDS Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($tds_code_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd"><?php echo $key->TDS_CODE; ?></td>
                                        <td class="setetxtintd"><?php echo $key->TDS_NAME; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">TDS Code</th>
                                     <th class="nameheading">TDS Name</th>
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

                            {!! $errors->first('tds_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                    </div>
                    <!-- /.form-group -->
                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       TDS Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="tds_name" id="tds_name" value="{{$tds_name}}" placeholder="Enter TDS Name" maxlength="40">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tds_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

              </div>

              <!-- /.row -->

              <div class="row">

                <div class="col-md-6">

                    <div class="form-group">

                      <label> TDS Section : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-puzzle-piece"></i></span>

                        <input type="text" class="form-control" name="tds_section" id="tds_section" value="{{$tds_section}}" placeholder="Enter TDS Section" maxlength="6">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tds_section', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>
                    <!-- /.form-group -->
                </div>

                <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        TDS Rate : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="tds_rate" value="{{$tds_rate}}" placeholder="Enter TDS Rate" maxlength="20">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('tds_rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                
              </div>

              <!-- row  -->



              <div class="row">



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        GL Code : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>


                          <input list="glList" type="text" class="form-control" value="{{ $gl_code }}" name="gl_code" id="gl_code" placeholder="Select GL Code" maxlength="6">
                         
                          <datalist id="glList">
                            <option value="">--SELECT--</option>


                            @foreach($gl_list as $key)



                            <option value="{{ $key->GL_CODE }}" data-xyz ="<?php echo $key->GL_NAME; ?>" <?php if($gl_code==$key->GL_CODE){ echo 'selected';} ?>> {{ $key->GL_CODE }} = {{ $key->GL_NAME }}</option>



                            @endforeach

                          </datalist>

                        </div>

                        <div class="pull-left showSeletedName" id="glText"></div>

                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Surcharge Rate : 



                        <!-- <span class="required-field"></span> -->



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="surcharge_rate" id="surcharge_rate" value="{{$surcharge_rate}}" placeholder="Enter Surcharge Rate" maxlength="11" autocomplete="off">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('surcharge_rate', '<p class="help-block" style="color:red;">:message</p>') !!}



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



                        Surcharge GL Code : 



                        <!-- <span class="required-field"></span> -->



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control Number" name="surchargegl_code" value="{{$surchargegl_code}}" placeholder="Enter Surcharge GL Code" maxlength="6" autocomplete="off">



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('surchargegl_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Cess Rate : 



                        <!-- <span class="required-field"></span> -->



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="cess_rate" id="cess_rate" value="{{$cess_rate}}" placeholder="Enter Cess Rate" maxlength="11" autocomplete="off">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('cess_rate', '<p class="help-block" style="color:red;">:message</p>') !!}



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



                        Cess GL Code : 



                        <!-- <span class="required-field"></span> -->



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control Number" name="cessgl_code" value="{{$cessgl_code}}" placeholder="Enter Cess GL Code" maxlength="6" autocomplete="off">



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('cessgl_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       Form No. : 



                        <!-- <span class="required-field"></span> -->



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control" name="form_no" id="form_no" value="{{$form_no}}" placeholder="Enter Form No." maxlength="10" autocomplete="off">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('form_no', '<p class="help-block" style="color:red;">:message</p>') !!}



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



                        From Date : 



                        <!-- <span class="required-field"></span> -->



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>


                          <?php
                              if($from_date){
                               $FromDate = date("d-m-Y", strtotime($from_date)); 
                              }else{
                                $FromDate = date("d-m-Y"); 
                              }
                          ?>
                          <input type="text" class="form-control datepicker" name="from_date" value="{{ $FromDate }}" placeholder="Enter From Date" maxlength="10" autocomplete="off">



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                       To Date : 




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

                          <input type="text" class="form-control datepicker1" name="to_date" id="to_date" value="" placeholder="Enter To Date" maxlength="10" autocomplete="off">



                      </div> 



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}



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



                       TDS Block : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <input type="radio" class="optionsRadios1" name="tds_block" value="YES" <?php if($tds_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;



                          <input type="radio" class="optionsRadios1" name="tds_block" value="NO" <?php if($tds_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                        </div>



                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('tds_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>







                    </div>



                    <!-- /.form-group -->



                  </div>



                </div>

<?php } ?>





              <div style="text-align: center;">



                 <button type="Submit" class="btn btn-primary">

                  <input type="hidden" name="idtds" value="{{$tds_id}}">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 



                 </button>



              </div>



            </form>



          </div><!-- /.box-body -->



           



          </div>



      </div>



      <div class="col-sm-3 hideinmobile">



        <div class="box-tools pull-right">



          <a href="{{ url('/Master/InDirect-Direct-Tax/View-Tds-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View TDS</a>



        </div>



      </div>







    </div>



     



  </section>



</div>















@include('admin.include.footer')



<script type="text/javascript">
  function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode;
 console.log(charCode);
    if (charCode != 46 && charCode != 45 && charCode > 31
    && (charCode < 48 || charCode > 57))
     return false;

  return true;
}
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
  $(document).ready(function(){

  $("#gl_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#glList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("glText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });

  
   });
</script>

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help TDS Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var tdsCodeHelp = $('#tdsCodeHelp').val();

           if(tdsCodeHelp == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-tdscode-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {tdsCodeHelp: tdsCodeHelp},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>TDS Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.TDS_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.TDS_NAME+'</td></tr>');
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
    $('#TdsCodeSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var TdsCodeSearch = $('#TdsCodeSearch').val();

        if(TdsCodeSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-tds-code-get') }}",

             method : "POST",

             type: "JSON",

             data: {TdsCodeSearch: TdsCodeSearch},

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
                            objcity.TDS_CODE+'</span><br>');
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