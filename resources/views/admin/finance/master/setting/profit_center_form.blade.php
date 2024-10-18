@extends('admin.main')




@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')


@include('admin.include.sidebar')



<style type="text/css">

    .showSeletedName{

      font-size: 12px;
      margin-top: 2px;
      text-align: center;
      font-weight: 600;
      color: #4f90b5;
  }

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



            Master Profit Center



            <small>Add Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/finance/profit-center-mast') }}">Master Profit Center</a></li>



            <li class="active"><a href="{{ url('/finance/profit-center-mast') }}">Add Profit Center</a></li>



          </ol>



        </section>



	<section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-8">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Profit Center </h2>


              <div class="box-tools pull-right showinmobile">

                   <a href="{{ url('/Master/Setting/View-Profit-Center-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Profit Center</a>

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


            <form action="{{ url('/finance/form-profit-center-save') }}" method="POST" >



               @csrf



               <div class="row">

                 <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Company Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                         <input list="compList"  id="comp_code" name="comp_code" class="form-control  pull-left" value="{{ old('comp_code')}}" placeholder="Select Company Code" maxlength="40" style="z-index: 1;" autocomplete="off">



                          <datalist id="compList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($comp_list as $key)

                            

                            <option value='<?php echo $key->COMP_CODE ?>'   data-xyz ="<?php echo $key->COMP_NAME; ?>" ><?php echo $key->COMP_CODE  ; echo " [".$key->COMP_NAME."]" ; ?></option>



                            @endforeach

                          </datalist>



                      </div>
                      <input type="hidden" id="compName" name="compName">
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



                        Profit Center Code: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                          <input type="text" class="form-control codeCapital" name="pfct_code" id="profit_code" value="{{ old('pfct_code')}}" placeholder="Enter Profit Center Code" maxlength="6" autocomplete="off" readonly="">


                           <!-- <span class="input-group-addon" style="padding: 1px 7px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>
                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="help_pfct" id="help_pfct" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;width:200px;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Pfct Code</th>
                                     <th class="nameheading">Pfct Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($help_pfct_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd"><?php echo $key->PFCT_CODE ; ?></td>
                                        <td class="setetxtintd"><?php echo $key->PFCT_NAME; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                      
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;width:200px;display: none;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Pfct Code</th>
                                     <th class="nameheading">Pfct Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                                <span id="errorItem"></span>

                            </div>
                            </div>
                            
                          </span> -->


                        </div>

                      <!--   <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                        </div> -->
                          
                          <small id="pfctcodeErr" style="font-weight:600;"></small>

                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('pfct_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>







                    </div>



                    <!-- /.form-group -->



                  </div>



                
                </div>

                <div class="row">

                 

                    <div class="col-md-6">



                    <div class="form-group">

                      <label>Profit Center Name : 
                        <span class="required-field"></span>
                       </label>

                      <div class="input-group">

                         <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                        
                         <input type="text" class="form-control" name="profit_name" value="{{ old('profit_name') }}" placeholder="Enter Profit Center Name" maxlength="40" autocomplete="off">
                    
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('profit_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>

                  <div class="col-md-6">



                    <div class="form-group">

                        <label> Address 1 : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                         <textarea class="form-control" id="" rows="1" name="add1" value="{{ old('add1') }}" placeholder="Enter Address 1" maxlength="40" autocomplete="off"></textarea>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('add1', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>
                    </div>
                  </div>

              </div>

              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                        <label> Address 2 : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                         <textarea class="form-control" id="" rows="1" name="add2" value="{{ old('add2') }}" placeholder="Enter Address 2" maxlength="40" autocomplete="off"></textarea>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('add2', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>

                  </div>

                </div>
                <div class="col-md-6">

                  <div class="form-group">

                        <label> Address 3  :  </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <textarea class="form-control" id="" rows="1" name="add3" value="{{ old('add3') }}" placeholder="Enter Address 3" maxlength="40" autocomplete="off"></textarea>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('add3', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                  </div>
              </div>

              <div class="row">
                
                <div class="col-md-4">

                  <div class="form-group">

                        <label> City : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-home"></i></span>

                          <input  list="cityList" class="form-control" type="text" id="city"  name="city" value="{{ old('city') }}" placeholder="Enter City" maxlength="30" onchange="addresDetails()" autocomplete="off">


                          <datalist id="cityList">

                                        <option value=''>--SELECT--</option>

                                        @foreach($city_lists as $row)

                                          <option value='{{ $row->CITY_CODE }}'data-xyz="{{ $row->CITY_NAME }}">{{ $row->CITY_CODE }}[{{ $row->CITY_NAME }}] </option>

                                        @endforeach

                        </datalist>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('city', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                  
                </div>

                <div class="col-md-4">

                  <div class="form-group">

                        <label> District : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input class="form-control" type="text" id="district"  name="district" value="{{ old('district') }}" placeholder="Enter District" maxlength="30" autocomplete="off" readonly="">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('district', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                  
                </div>

                <div class="col-md-4">



                    <div class="form-group">



                      <label>State</label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="stateList"  id="statecode" name="state" class="form-control  pull-left" value="{{ old('state')}}" placeholder="Select State" maxlength="30" style="z-index: 1;" autocomplete="off" readonly="">

                          


                      </div>
                      <div class="pull-left showSeletedName" id="compText"></div>


                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('state', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>

                  </div>
               

              </div>

              <div class="row">
                
                <div class="col-md-4">
                  <div class="form-group">

                        <label> Country : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input class="form-control" type="text" id="country"  name="country" value="{{ old('country') }}" placeholder="Enter Country" maxlength="30" autocomplete="off" readonly="">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">

                        <label> Pin Code : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input class="form-control" type="text" id="pincode"  name="pin_code" value="{{ old('pin_code') }}" placeholder="Enter Pin Code" maxlength="6" autocomplete="off" readonly="">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('pin_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">

                        <label> Phone 1 : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input class="form-control Number" type="text" id="phone1"  name="phone1" value="{{ old('phone1') }}" placeholder="Enter Phone 1" maxlength="11" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('phone1', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

              </div>

              <div class="row">
                
                <div class="col-md-4">
                  <div class="form-group">

                        <label> Phone2 : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input class="form-control Number" type="text" id="phone2"  name="phone2" value="{{ old('phone2') }}" placeholder="Enter Phone 2" maxlength="11" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('phone2', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">

                        <label> Fax No : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-fax"></i></span>

                          <input class="form-control" type="text" id="fax_no"  name="fax_no" value="{{ old('fax_no') }}" placeholder="Enter Fax No" maxlength="20" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fax_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">

                        <label> Email Id : </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input class="form-control" type="text" id="email_id"  name="email_id" value="{{ old('email_id') }}" placeholder="Enter Email Id" maxlength="20" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('email_id', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>
                </div>

              </div>



              <div style="text-align: center;">



                 <button type="Submit" class="btn btn-primary" id="submitdata">
                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 
                </button>
                 <button type="reset" class="btn btn-warning">
                  <i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reset 
                </button>



              </div>



            </form>



          </div><!-- /.box-body -->




          </div>



      </div>



      <div class="col-sm-3">

        <div class="box-tools pull-right hideinmobile">

          <a href="{{ url('/Master/Setting/View-Profit-Center-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Profit Center</a>

        </div>

      </div>







    </div>



     



	</section>



</div>







@include('admin.include.footer')


<script src="{{ URL::asset('public/dist/js/viewjs/CommonAjax.js') }}" ></script>


<script type="text/javascript">
    $(document).ready(function(){

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
           $('#compName').val('');
           $('#profit_code').val('');
           document.getElementById("compText").innerHTML = '';

        }else{

          $('#compName').val(msg);
          funGenPfctCode();
        }

      });

      function funGenPfctCode(){

        var compcode = $('#comp_code').val();

        if(compcode){

          var likename = compcode;
          // console.log('likename',likename);
          var tbl_name = 'MASTER_PFCT';
          var col_code = 'PFCT_CODE';
        

          $.ajaxSetup({

                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }

           });

          $.ajax({

           url:"{{ url('/Master/generate-dyanamic-code') }}",

           data: {likename:likename,tbl_name:tbl_name,col_code:col_code},

            success:function(data){
              var data1 = JSON.parse(data);

              if(data1.response == 'success'){

                var newcode = data1.data;
                
                if(newcode != '' || newcode != null){
                  $('#profit_code').val(newcode);
                }else{
                  $('#profit_code').val('');
                }

              }
            },

            error : function(){

              $('#pfctcodeErr').html('*PFCT Code is not Gernerated...!').css('color','red');
              $('#submitdata').prop('disabled',true);

            }
          });

        }
      
      }


    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#profit_code').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var profit_code = $('#profit_code').val();

        if(profit_code == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-pfct-code') }}",

             method : "POST",

             type: "JSON",

             data: {profit_code: profit_code},

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
                            objcity.pfct_code+'</span><br>');
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
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Depot Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var HelppfctCode = $('#help_pfct').val();

           if(HelppfctCode == ''){

              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-pfct-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelppfctCode: HelppfctCode},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Depot Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><th>Pfct Code</th><th>Pfct Name</th></tr><tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.pfct_code+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.pfct_name+'</td></tr>');
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

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>

<script type="text/javascript">
$(document).ready(function(){
  $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
    if (keycode == 46 || this.value.length==11) {
    return false;
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
    if (keycode == 46 || this.value.length==10) {
    return false;
  }
});

});

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