@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

.stepwizard-step p {

    margin-top: 10px;

}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;

}

.stepwizard-step button[disabled] {

    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.showSeletedName{

    font-size: 13px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
    margin-bottom: 2%;
  }

.stepwizard-row:before {

    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}

.stepwizard-step {

    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}

.hidestep{
    display: none;
}

.hidebtn{
  display: none;
}

.rightcontent{

  text-align:right;
}

::placeholder {
  text-align:left;
}

.required-field::before {

    content: "*";
    color: red;

  }

</style>




<div class="content-wrapper">







        <!-- Content Header (Page header) -->







        <section class="content-header">







          <h1>







            Master House Bank







            <small>Add Details</small>







          </h1>







          <ol class="breadcrumb">







            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>







            <li><a href="{{ URL('/dashboard')}}">Master</a></li>







            <li class="Active"><a href="{{ URL('/finance/house-bank-mast')}}">Master House Bank  </a></li>







            <li class="Active"><a href="{{ URL('/finance/house-bank-mast')}}">Add House Bank </a></li>







          </ol>







        </section>







  <section class="content">







    <div class="row">


       <div class="col-sm-1"></div>


      <div class="col-sm-8">







        <div class="box box-primary Custom-Box">







            <div class="box-header with-border" style="text-align: center;">







              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add House Bank</h2>



              



            </div><!-- /.box-header -->



           







            <div class="box-body">











              <div class="stepwizard">



                  <div class="stepwizard-row setup-panel">



                      <div class="stepwizard-step" id="showstep1">



                         <a href="#step-1" type="button" class="btn btn-primary btn-circle" id="stepone">1</a>


                          <p>Basic Details </p>



                      </div>



                      <!-- <div class="stepwizard-step hidebtn showbtn"> -->

                        <div class="stepwizard-step hidestep" id="show_second">

                          <!-- <a href="#step-2" type="button" class="btn btn-default btn-circle" style="margin-right: 50%;">2</a> -->
                           <a href="#step-2" type="button" class="btn btn-default btn-circle" id="steptwo" disabled="disabled">2</a>



                          <p style=" margin-right: 46%;">Address</p>



                      </div>



                      <!-- <div class="stepwizard-step hidebtn showbtn">



                          <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>



                          <p>Non Accounting Field</p>



                      </div> -->



                  </div>



              </div>



             <form action="{{ url('Master/House-bank-cash/House-Bank-Save') }}" method="POST">
              @csrf


                  <div class="row setup-content" id="step-1">



                      <div class="col-xs-12">



                          <div class="col-md-12">



                           <center>  <h5> <span id="showmsg" style="color: green"></span></h5></center> 

                            <div class="row">
                                  
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label> Bank Name: <span class="required-field"></span></label>
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>

                                      <input type="hidden" name="bank_code_name" id="bank_code_name">
                                      <input list="bankList" type="bank_name" name="bank_name" class="form-control" autocomplete="off" id="bank_name" value="{{ old('bank_name') }}" placeholder="Enter Bank Name" maxlength="6">

                                        <datalist id="bankList">

                                          <option value=''>--SELECT--</option>

                                          @foreach($bank_list as $row)

                                            <option value='{{ $row->BANK_CODE }}' data-xyz ="<?php echo $row->BANK_NAME; ?>" <?php if($tran_code==$row->BANK_CODE) { echo 'selected'; } else { echo '';}?>>{{ $row->BANK_CODE }} = {{ $row->BANK_NAME }} </option>

                                          @endforeach

                                        </datalist>

                                      </div>

                                      <div class="pull-left showSeletedName" id="bankText"></div>

                                      <small id="bank_err" style="color: red;"></small>

                                      <small id="emailHelp" class="form-text text-muted">

                                          {!! $errors->first('bank_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                                      </small>
                                </div>
                                <!-- /.form-group -->
                              </div>

                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>
                                    Gl Name : <span class="required-field"></span>
                                  </label>
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                                    <input type="hidden" name="gl_code_name" id="gl_code_name">
                                    <input list="glList" type="text" name="gl_name" class="form-control" id="gl_name" value="{{ old('gl_name') }}" autocomplete="off" placeholder="Enter GL Name" maxlength="6">
                                      <datalist id="glList">
                                        <option value=''>--SELECT--</option>
                                          @foreach($gl_list as $row)
                                            <option value='{{ $row->GL_CODE }}' data-xyz ="<?php echo $row->GL_NAME; ?>" <?php if($tran_code==$row->GL_CODE) { echo 'selected'; } else { echo '';}?>>{{ $row->GL_CODE }} = {{ $row->GL_NAME }} </option>
                                          @endforeach
                                      </datalist>
                                  </div>
                                  <div class="pull-left showSeletedName" id="glText"></div>
                                  <small id="gl_err" style="color: red;"></small>
                                  <small id="emailHelp" class="form-text text-muted">
                                    {!! $errors->first('gl_code_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                                  </small>
                                </div>
                              </div>

                            </div>

                            <div class="row">
                              
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>
                                    Company Code: 
                                  </label>
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                    <input type="hidden" name="comp_code_name" id="comp_code_name">
                                    <input list="compList" name="comp_code" class="form-control" id="comp_code" placeholder="Select Company Name" value="{{ old('comp_code') }}" autocomplete="off" maxlength="6">
                                      <datalist id="compList">
                                        <option value=''>--SELECT--</option>
                                        @foreach($comp_list as $row)
                                          <option value='{{ $row->COMP_CODE }}' data-xyz ="<?php echo $row->COMP_NAME; ?>">{{ $row->COMP_CODE }} = {{ $row->COMP_NAME }} </option>
                                        @endforeach
                                      </datalist>
                                  </div>
                                  <div class="pull-left showSeletedName" id="compText"></div>
                                  <small id="comp_err" style="color: red;"></small>
                                  <small id="emailHelp" class="form-text text-muted">
                                    {!! $errors->first('trans_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                                  </small>
                                </div>
                              </div>


                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>
                                    Profit Center Code : 
                                  </label>
                                  <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                                    <input type="hidden" name="pfct_code_name" id="pfct_code_name">
                                    <input list="pfctList" name="profit_code" class="form-control" id="profit_code" placeholder="Select PFCT Name" value="{{ old('profit_code') }}" autocomplete="off" maxlength="6">
                                      <datalist id="pfctList">
                                        <option value=''>--SELECT--</option>
                                        @foreach($pfct_list as $row)
                                          <option value='{{ $row->PFCT_CODE }}' data-xyz ="<?php echo $row->PFCT_NAME; ?>">{{ $row->PFCT_CODE }} = {{ $row->PFCT_NAME }} </option>
                                        @endforeach
                                      </datalist>
                                  </div>
                                  <div class="pull-left showSeletedName" id="pfctText"></div>
                                  <small id="comp_err" style="color: red;"></small>
                                  <small id="emailHelp" class="form-text text-muted">
                                    {!! $errors->first('profit_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                                  </small>
                                </div>
                                <!-- /.form-group -->
                              </div>

                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label> Account Type: </label>
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-list" aria-hidden="true"></i></span>

                                        <input list="accTypeList" name="acc_type" class="form-control" id="acc_type" placeholder="Enter Account Type" value="{{ old('acc_type') }}" autocomplete="off" maxlength="25">

                                        <datalist id="accTypeList">
                                          <option value=''>--SELECT--</option>
                                            <option value='CURRENT ACCOUNT' data-xyz ="CURRENT ACCOUNT">CURRENT ACCOUNT</option>
                                            <option value='SAVINGS ACCOUNT' data-xyz ="SAVINGS ACCOUNT">SAVINGS ACCOUNT</option>
                                            <option value='SALARY ACCOUNT' data-xyz ="SALARY ACCOUNT">SALARY ACCOUNT</option>
                                            <option value='FIXED DEPOSIT ACCOUNT' data-xyz ="FIXED DEPOSIT ACCOUNT">FIXED DEPOSIT ACCOUNT</option>
                                            <option value='RECURRING DEPOSIT ACCOUNT' data-xyz ="RECURRING DEPOSIT ACCOUNT">RECURRING DEPOSIT ACCOUNT</option>
                                            <option value='NRI ACCOUNT' data-xyz ="NRI ACCOUNT">NRI ACCOUNT</option>
                                            <option value='CASH/PETTY CASH' data-xyz ="CASH/PETTY CASH">CASH/PETTY CASH</option>
                                        </datalist>

                                      </div>
                                      <small id="emailHelp" class="form-text text-muted">

                                          {!! $errors->first('acc_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                                      </small>
                                  </div>
                                  <!-- /.form-group -->
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label> Account Number:</label>
                                      <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                        <input type="text" name="acc_num" class="form-control" id="acc_num" placeholder="Enter Account TNumberype" value="{{ old('acc_num') }}" autocomplete="off" maxlength="20">

                                      </div>


                                      <small id="emailHelp" class="form-text text-muted">

                                          {!! $errors->first('acc_num', '<p class="help-block" style="color:red;">:message</p>') !!}

                                      </small>
                                  </div>
                                  <!-- /.form-group -->
                                </div>
                            </div>




                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label> MICR Code:</label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" name="micr_code" class="form-control" id="micr_code" placeholder="Enter MICR Code" value="{{ old('micr_code') }}" autocomplete="off" maxlength="10">

                      </div>

                    </div>
                    <!-- /.form-group -->
                    <small id="micr_err" style="color: red;"></small>

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>IFS Name:  </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                        <input type="text" name="ifs_name" class="form-control" id="ifs_name" placeholder="Enter IFS Name" value="{{ old('ifs_name') }}" autocomplete="off" maxlength="15">

                      </div>

                    </div>

                    <small id="ifs_err" style="color: red;"></small>
                    <!-- /.form-group -->

                  </div>

                </div>
                 <!--  <center> <button class="btn btn-primary" type="button" id="submitBtn">Save</button></center>  -->
                <center> <button class="btn btn-primary btn-md" type="button" id="firstStep">Next</button></center>




                          </div>



                      </div>



              </div>







           



                  <div class="row setup-content" id="step-2">



                      <div class="col-xs-12">



                          <div class="col-md-12">



                             <span id="showmsg1" style="color: green;"></span>

<div class="row">



                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                       Address : 







                      </label>







                      <div class="input-group">

                          <input type="text" class="form-control" name="address1" id="address1" value="{{ $rfhead1 ?? '' }}" placeholder="Address 1" maxlength="40">


                          <input type="text" class="form-control" name="address2" id="address2" value="{{ $rfhead2 ?? '' }}" placeholder="Address 2" style="margin-top: 2%;" maxlength="40">


                          <input type="text" class="form-control" name="address3" id="address3" value="{{ $rfhead2 ?? '' }}" placeholder="Address 3" style="margin-top: 2%;" maxlength="40">


                      </div>



                    </div>





                    <!-- /.form-group -->







                  </div>



                 



                 



                  <div class="col-md-6">







                    <div class="form-group">


                      <label>


                      Phone No 1: <span class="required-field"></span>

                      </label>




                      <div class="input-group">


                          <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>


                          <input type="text" class="form-control Number rightcontent" name="phone1"  id="phone1" value="{{ $rfhead4 ?? '' }}" placeholder="Phone No 1" maxlength="10">



                      </div>
                       <small id="phone1_err" style="color: red;"></small>


                    </div>


                  </div>







                   <div class="col-md-6">







                    <div class="form-group">







                      <label>







                       Phone No 2:







                      </label>







                      <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-phone-square"></i></span>







                          <input type="text" class="form-control Number rightcontent" id="phone2" name="phone2" value="{{ $rfhead5 ?? '' }}" placeholder="Enter Phone No 2" maxlength="10">







                      </div>







                    







                    </div>







                    <!-- /.form-group -->







                  </div>



                </div>







                <div class="row">



                 







                   <div class="col-md-6">







                    <div class="form-group">







                      <label>







                      Fax: 







                      </label>







                      <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-fax"></i></span>







                          <input type="text" class="form-control" name="fax" id="fax" value="{{ $rfhead4 ?? '' }}" placeholder="Enter Fax" maxlength="12">







                      </div>







                      







                    </div>







                    <!-- /.form-group -->







                  </div>







                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                      Email-id: <span class="required-field"></span>







                      </label>







                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>



                          <input type="email" class="form-control" name="email_id" id="email_id" value="" placeholder="Enter Email-id" maxlength="40">







                      </div>







                      







                      <small id="email_err" style="color: red;"></small>



                    </div>



                    <!-- /.form-group -->







                  </div>



                </div>



                <div class="row">



                  <div class="col-md-6">
                    <div class="form-group">
                      <label> City : <span class="required-field"></span></label>
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                          <input list="cityList" type="city" name="city" class="form-control" id="city" placeholder="Enter City Name" onchange="addresDetails()" maxlength="6">

                            <datalist id="cityList">

                              <option value=''>--SELECT CITY--</option>

                              @foreach($city_list as $row)

                                <option value='{{ $row->CITY_CODE }}' data-xyz ="<?php echo $row->CITY_NAME; ?>">{{ $row->CITY_CODE }} = {{ $row->CITY_NAME }} </option>

                              @endforeach

                            </datalist>

                          </div>

                          <div class="pull-left showSeletedName" id="cityText"></div>

                          <small id="city_err" style="color: red;"></small>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('city', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                    </div>
                  </div>

                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                       District : <span class="required-field"></span>







                      </label>







                      <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>







                          <input type="text" class="form-control" name="district" id="district" value="{{ $rfhead5 ?? '' }}" placeholder="Enter District" maxlength="20" readonly>







                      </div>
                      <small id="district_err" style="color: red;"></small>






                    







                    </div>







                    <!-- /.form-group -->







                  </div>
   


                  







                  



                



                <!-- /.col -->







              </div>







              <div class="row">


                <div class="col-md-6">







                    <div class="form-group">







                      <label>







                       State : <span class="required-field"></span>







                      </label>







                      <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>


                              <input type="text" name="state_code" class="form-control" id="statecode" maxlength="4" placeholder="Select State" readonly>


                      </div>
                      <small id="state_code_err" style="color: red;"></small>
                         <div class="pull-left showSeletedName" id="stateText"></div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('state_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>




                    </div>



                    <!-- /.form-group -->


                  </div>
                  

                  <div class="col-md-6">







                    <div class="form-group">







                      <label>







                       Country : <span class="required-field"></span>







                      </label>







                      <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-globe"></i></span>







                          <input type="text" class="form-control" name="country" id="country" value="India" placeholder="Enter Country" readonly>







                      </div>
                         <small id="country_err" style="color: red;"></small>






                    







                    </div>







                    <!-- /.form-group -->







                  </div>






                <!-- /.col -->



              </div>



              <div class="row">



                <div class="col-md-6">



                    <div class="form-group">







                      <label>



                       Pincode : <span class="required-field"></span>



                      </label>





                      <div class="input-group">







                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>







                          <input type="text" class="form-control Number rightcontent" name="pincode" id="pincode" value="{{ $rfhead5 ?? '' }}" placeholder="Enter Pincode" maxlength="6" readonly>







                      </div>
                      <small id="pincode_err" style="color: red;"></small>


                    </div>



                    <!-- /.form-group -->



                  </div>



              </div>

                   <input type="hidden" name="lastid" id="lastid" value="">



                     <center> 
                      <button class="btn btn-primary" type="submit">Save</button>
                     </center>



                          </div>



                      </div>



                  </div>



                </form>



                







          </div>







      </div>







</div>







<div class="col-sm-3">
  




                <a href="{{ url('/Master/House-bank-cash/View-House-Bank-Mast') }}" class="btn btn-primary pull-right" style="margin-right: 2%"><i class="fa fa-plus"></i>&nbsp;&nbsp;View House Bank</a>



</div>


    </div>


  </section>







</div>







@include('admin.include.footer')


<script src="{{ URL::asset('public/dist/js/viewjs/CommonAjax.js') }}" ></script>

<script type="text/javascript">
  function validation(){

          var comp_code = $("#comp_code").val();

          var profit_code = $("#profit_code").val();

          var gl_name = $("#gl_name").val();

          var bank_name = $("#bank_name").val();


          if(comp_code=='' && profit_code=='' && gl_name=='' && bank_name==''){

          //  alert('hi');return false;

           $('#comp_err').html('The account code field is required.').css('color','red');

           $('#pfct_err').html('The pfct code field is required.').css('color','red');

           $('#gl_err').html('The gl coed field is required.').css('color','red');

           $('#bank_err').html('The bank code field is required.').css('color','red');


           return false;

          }else{

             //alert('hello');return false;

            $('#acccodeErr').html('');

            $('#accnameErr').html('');

            $('#stepone').removeClass('btn-primary');

            $('#steptwo').addClass('btn-primary');

            $('#step-1').css('display','none');

            $('#step-2').css('display','block');

            $('#show_second').removeClass('hidestep');

            //$('#showstep1').css('display','none');

          }
  }
</script>


<script type="text/javascript">

  $('document').ready(function(){

      $('#firstStep').click(function(){

          var comp_code = $("#comp_code").val();

          var profit_code = $("#profit_code").val();

          var gl_name = $("#gl_name").val();

          var bank_name = $("#bank_name").val();


          if(gl_name=='' && bank_name==''){


           $('#gl_err').html('The gl coed field is required.').css('color','red');

           $('#bank_err').html('The bank code field is required.').css('color','red');


           return false;

          }else if(gl_name== ''){

            $('#comp_err').html('');
            $('#pfct_err').html('');

            $('#gl_err').html('The gl code field is required.').css('color','red');

            return false;
          }
          else if(bank_name== ''){

            $('#comp_err').html('');
            $('#pfct_err').html('');
            $('#gl_err').html('');

            $('#bank_err').html('The bank code field is required.').css('color','red');

            return false;
          }else{

             //alert('hello');return false;

            $('#acccodeErr').html('');

            $('#accnameErr').html('');

            $('#stepone').removeClass('btn-primary');

            $('#steptwo').addClass('btn-primary');

            $('#step-1').css('display','none');

            $('#step-2').css('display','block');

            $('#show_second').removeClass('hidestep');

            //$('#showstep1').css('display','none');

          }

      });




  });

</script>



<script type="text/javascript">



$(document).ready(function(){



   $("#submitBtns2").click(function(event) {







    var comp_code   = $("#comp_code").val();

    

    var profit_code = $("#profit_code").val();

    

    var bank_name   =  $("#bank_name").val();

    

    var gl_name     =  $("#gl_name").val();

    

    var micr_code   =  $("#micr_code").val();

    

    var ifs_name    =  $("#ifs_name").val();





    

    var filter      = /^[a-z0-9._-]+@[a-z]+.[a-z]{2,5}$/i;



     



    if(comp_code==''){



     

      $("#comp_err").html('The comp code field is required.');

      

      

    }else{



      $("#comp_err").html('');

    }



    if(profit_code==''){



      $("#pfct_err").html('The profit code field is required.');

       

    }else{

       $("#pfct_err").html('');

    }



    if(bank_name==''){



  $("#bank_err").html('The bank name field is required.');    

   



    }else{



      $("#bank_err").html('');

    }



    if(gl_name==''){



       $("#gl_err").html('The gl name field is required.');

        return false;




    }else{

      $("#gl_err").html('');

    }







  



   var data = $("#submitdata").serialize();


//alert(data);return false;



    $.ajaxSetup({







          headers: {







              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')







          }







         });







    $.ajax({



        type: 'POST',



        url: "{{ url('/finance/form-mast-house-bank-save') }}",



        data: data, // here $(this) refers to the ajax object not form



        success: function (data) {



         // alert(data);return false;



             var data1 = JSON.parse(data);



            



           $('.showbtn').removeClass('hidebtn');



           $('#showmsg').html('Bank House Was Successfully Added...!');



           document.getElementById("submitdata").reset();

           $("#comp_err").html('');

           $("#pfct_err").html('');

           $("#bank_err").html('');

           $("#gl_err").html('');

           $("#micr_err").html('');

           $("#ifs_err").html('');





           $("#lastid").val(data1.id);



            setTimeout(function(){ $('a[href="#step-2"]').click();$('#showmsg').html('');

},1000);



        },



    });











     /* Act on the event */



   });







});



</script>







<script type="text/javascript">



$(document).ready(function(){



   $("#submitBtn2").click(function(event) {



    var email_id   = $("#email_id").val();
    var phone1   = $("#phone1").val();
    var country   = $("#country").val();
    var state_code   = $("#state_code").val();
    var district   = $("#district").val();
    var city   = $("#city").val();
    var Pincode   = $("#Pincode").val();



    if(email_id==''){

          $("#email_err").html('The email id field is required.');

        }else{

          $("#email_err").html('');

        }

    if(phone1==''){

          $("#phone1_err").html('The phone no. 1 field is required.');

         
        }else{

          $("#phone1_err").html('');

        }
    if(country==''){

          $("#country_err").html('The country field is required.');

         
        }else{

          $("#country_err").html('');

        }

    if(state_code==''){

          $("#state_code_err").html('The state field is required.');

         
        }else{

          $("#state_code_err").html('');

        } 

    if(district==''){

          $("#district_err").html('The district field is required.');

         
        }else{

          $("#district_err").html('');

        }
  if(city==''){

      $("#city_err").html('The city field is required.');

     
    }else{

      $("#city_err").html('');

    }

    if(Pincode==''){

      $("#pincode_err").html('The pincode field is required.');
      return false;
     
    }else{

      $("#pincode_err").html('');

    }




   var data = $("#submitdata2").serialize();



    $.ajaxSetup({







          headers: {







              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')







          }







         });







    $.ajax({



        type: 'POST',



        url: "{{ url('/finance/form-mast-plant-save2') }}",



        data: data, // here $(this) refers to the ajax object not form



        success: function (data) {



          console.log(data);



             var data1 = JSON.parse(data);



            



           /*$('.showbtn').removeClass('hidebtn');*/



           $('#showmsg1').html('Bank House Was Successfully Added...!');



           document.getElementById("submitdata2").reset();







           $("#lastid1").val(data1.id);







        },



    });











     /* Act on the event */



   });







});



</script>











<script type="text/javascript">



  



      $("#comp_code" ).change(function() {







           $.ajaxSetup({



          headers: {



              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')



          }



         });



        



      var comp_code = $("#comp_code").val();



     // alert(comp_code);return false;




      $.ajax({



        url: "{{ url('/finance/get_pfct') }}",



        method : 'POST',



        type: 'JSON',



        data: {comp_code: comp_code},



      })



      .done(function(data) {







       // alert(data);return false;







       // var obj = $.parseJSON(data);



        console.log(data);







        $("#profit_code").html(data);







      })



    



    });







</script>



<script type="text/javascript">


    $(document).ready(function(){

        $("#comp_code").bind('change', function () {  


          var val = $(this).val();



          var xyz = $('#compList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';


          $("#comp_code_name").val(msg);

          document.getElementById("compText").innerHTML = msg; 


        });





      $("#profit_code").bind('change', function () {  


          var val = $(this).val();



          var xyz = $('#pfctList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';


          $("#pfct_code_name").val(msg);

          document.getElementById("pfctText").innerHTML = msg; 


        });



       $("#bank_name").bind('change', function () {  


          var val = $(this).val();



          var xyz = $('#bankList option').filter(function() {

       //     alert(xyz);return false;



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';

          $("#bank_code_name").val(msg);

          //alert(msg);return false;

          document.getElementById("bankText").innerHTML = msg; 


        });



        $("#gl_name").bind('change', function () {  


          var val = $(this).val();



          var xyz = $('#glList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';

          $("#gl_code_name").val(msg);



          document.getElementById("glText").innerHTML = msg; 


        });

        


    
    $("#state_code").bind('change', function () {  


          var val = $(this).val();



          var xyz = $('#stateList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          document.getElementById("stateText").innerHTML = msg; 


        });


    });



</script>







<script type="text/javascript">



$(document).ready(function () {







    var navListItems = $('div.setup-panel div a'),



            allWells = $('.setup-content'),



            allNextBtn = $('.nextBtn');







    allWells.hide();







    navListItems.click(function (e) {



        e.preventDefault();



        var $target = $($(this).attr('href')),



                $item = $(this);







        if (!$item.hasClass('disabled')) {



            navListItems.removeClass('btn-primary').addClass('btn-default');



            $item.addClass('btn-primary');



            allWells.hide();



            $target.show();



            $target.find('input:eq(0)').focus();



        }



    });







    allNextBtn.click(function(){



        var curStep = $(this).closest(".setup-content"),



            curStepBtn = curStep.attr("id"),



            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),



            curInputs = curStep.find("input[type='text'],input[type='url']"),



            isValid = true;







        $(".form-group").removeClass("has-error");



        for(var i=0; i<curInputs.length; i++){



            if (!curInputs[i].validity.valid){



                isValid = false;



                $(curInputs[i]).closest(".form-group").addClass("has-error");



            }



        }







        if (isValid)



            nextStepWizard.removeAttr('disabled').trigger('click');



    });







    $('div.setup-panel div a.btn-primary').trigger('click');



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

  $("#acc_type").on('change', function () {  

  var val = $("#acc_type").val();

  var xyz = $('#accTypeList option').filter(function(el) {

    return this.value == val;

  }).data('xyz');

  var msg = xyz ? xyz : 'No Match';

  if(msg=='No Match'){  
    $('#acc_type').val('');
  }else{
    
  }
          
});



});



</script>







@endsection