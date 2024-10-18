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

  .showSeletedName{



    font-size: 15px;



    margin-top: 2%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;



  }





  .rightcontent{



  text-align:right;





}



::placeholder {

  

  text-align:left;

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

     top: 80%;

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



            Master HSN Rate



            <small>Add Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/Master/Item-Tax/Hsn-Rate-Mast')}}">Master HSN Rate</a></li>



            <li class="Active"><a href="{{ URL('/Master/Item-Tax/Hsn-Rate-Mast')}}">Add HSN Rate</a></li>



          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-2"></div>



      <div class="col-sm-7">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Master HSN Rate</h2>



              <div class="box-tools pull-right showinmobile">



              <a href="{{ url('/Master/Item-Tax/View-Hsn-Rate-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View HSN Rate</a>



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



            <form action="{{ url('Master/Item-Tax/Hsn-Rate-Save') }}" method="POST" >



               @csrf



               <div class="row">



                



                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        HSN Code : 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input list="hsn_codeList" class="form-control " id="hsn_code" name="hsn_code" value="{{old('hsn_code')}}" placeholder="Enter HSN Code" maxlength="8" autocomplete="off">



                          <datalist id="hsn_codeList">



                            <option selected="selected" value="">-- Select --</option>



                            @foreach ($hsn_list as $key)



                            



                            <option value='<?php echo $key->HSN_CODE?>'   data-xyz ="<?php echo $key->HSN_NAME; ?>" ><?php echo $key->HSN_NAME ; echo " [".$key->HSN_CODE."]" ; ?></option>







                            @endforeach



                          </datalist>



                        </div>



                        <small>  



                          <div class="pull-left showSeletedName" id="hsn_codeText"></div>



                        </small>



                        <small id="emailHelp" class="form-text text-muted">



                          {!! $errors->first('hsn_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                        </small>







                    </div>



                    <!-- /.form-group -->



                  </div>







                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Tax Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></span>



                          <input list="taxInd_list" class="form-control" name="tax_code" id="taxCode" value="{{old('tax_code')}}" placeholder="Enter Tax Code" maxlength="6" autocomplete="off">



                          <datalist id="taxInd_list">



                            <option selected="selected" value="">-- Select --</option>



                            @foreach ($tax_code as $key)



                            



                            <option value='<?php echo $key->TAX_CODE?>'   data-xyz ="<?php echo $key->TAX_NAME; ?>" ><?php echo $key->TAX_NAME ; echo " [".$key->TAX_CODE."]" ; ?></option>







                            @endforeach



                          </datalist>



                      </div> 

                        <input type="hidden" id="taxType" value="" name="taxType">

                      <small>  



                          <div class="pull-left showSeletedName" id="taxInd_Text"></div>



                      </small>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('tax_code', '<p class="help-block" style="color:red;">:message</p>') !!}



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


                        Tax Rate : 


                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></span>



                          <input type="text" class="form-control" name="tax_rate" id="taxRate" value="{{old('tax_rate')}}" placeholder="Enter Tax Rate" maxlength="30" autocomplete="off">


                      </div> 

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('tax_rate', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>
              </div>







              <div style="text-align: center;">



                 <button type="Submit" class="btn btn-primary">



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 



                 </button>



              </div>



            </form>



          </div><!-- /.box-body -->



           



          </div>



      </div>



      <div class="col-sm-3">



        <div class="box-tools pull-right hideinmobile">



          <a href="{{ url('/Master/Item-Tax/View-Hsn-Rate-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View HSN Rate</a>



        </div>



      </div>







    </div>



     



  </section>



</div>









@include('admin.include.footer')



<script type="text/javascript">



    $(document).ready(function(){



        $("#hsn_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#hsn_codeList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          if(msg == 'No Match'){

              $('#hsn_code').val('');

              $('#hsn_codeText').html('');

          }else{

             document.getElementById("hsn_codeText").innerHTML = msg; 

          }





        });



        $("#taxCode").bind('change', function () {  

          var taxCode = $(this).val();

          var xyz = $('#taxInd_list option').filter(function() {

          return this.value == taxCode;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
          
          if(msg == 'No Match'){

              $('#taxCode').val('');
              $('#taxType').val('');

             $('#taxInd_Text').html('');

          }else{

            document.getElementById("taxInd_Text").innerHTML = msg; 

            $.ajaxSetup({
              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $.ajax({

                url:"{{ url('get-taxdetail-by-tax-code') }}",

                method : "POST",

                type: "JSON",

                data: {taxCode: taxCode},

                  success:function(data){

                    var data1 = JSON.parse(data);

                    if (data1.response == 'error') {

                          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
                    }else if(data1.response == 'success'){
                       
                        if(data1.data==''){

                        }else{
                          $('#taxType').val(data1.data.tax_type);
                        }
                    } /*if close*/

                  }  /*success function close*/

            });  /*ajax close*/

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