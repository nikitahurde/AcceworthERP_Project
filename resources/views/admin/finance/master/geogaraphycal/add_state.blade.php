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


   box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);



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
.creditCls{
  display: none;
}
::placeholder {
  
  text-align:left;
}
.showinmobile{
  display: none;
}
.SubmitBtn{
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

}

</style>






<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master State



            <small> Add Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/master/geogaraphycal/state-master')}}">Geographical  </a></li>



            <li class="Active"><a href="{{ URL('/master/geogaraphycal/state-master')}}">Add State </a></li>



          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add State</h2>

               <div class="box-tools pull-right">

                <a href="{{ url('/master/geogaraphycal/view-state-master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View State</a>

              </div>



            </div><!-- /.box-header -->



             @if(Session::has('alert-success'))


              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">


                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-check"><i>

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


              <form action="{{ url('/master/geogaraphycal/state-master-save') }}" method="POST" id="CountryForm">

                @csrf

                  <div class="row">

                    <div class="col-lg-12">

                      <div class="row">

                        <div class="col-sm-4">
                          
                          <div class="form-group">

                            <label>

                             State Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="state_code" id="statenCode" value="{{old('state_code')}}" placeholder="Enter State Code" maxlength="6">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('state_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                        <div class="col-sm-4">
                          
                          <div class="form-group">

                            <label>

                             State Name : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                                <input type="text" class="form-control" name="state_name" id="stateName" value="{{old('state_name')}}" placeholder="Enter State Name" maxlength="20">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('state_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>


                       <div class="col-sm-4">
                          
                          <div class="form-group">

                            <label>

                             Country Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input list="countryList" class="form-control" name="country_code" id="countryCode" value="{{old('country_code')}}" placeholder="Enter Country Code" maxlength="6"><br>

                                 <input  type="text" class="form-control" name="countryName" id="countryName" value="{{old('country_name')}}" placeholder="Enter Country Name" maxlength="6">

                                <datalist id="countryList">

                                  <option selected="selected" value="">-- Select --</option>

                                  @foreach ($country_list as $key)

                                  <option value='<?php echo $key->COUNTRY_CODE; ?>'   data-xyz ="<?php echo $key->COUNTRY_NAME; ?>"><?php echo $key->COUNTRY_NAME ; echo " [".$key->COUNTRY_CODE."]" ; ?></option>

                                  @endforeach

                                </datalist>

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('country_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                      </div>


                      
                    </div>

                  </div>

                  <div style="text-align: center;">
                
                     <button type="Submit" class="btn btn-primary">

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                     </button>

                  </div>
                  

              </form>

            </div>

          </div>

        </div>

      </div>

    </section>

</div>


@include('admin.include.footer')



<script type="text/javascript">

  $(document).ready(function() {

    $( window ).on( "load", function() {

     var amhead =  $('#amthead1').val();
        if(amhead){
            $('#basicval1').val(amhead);
            //$('#amthead1').prop('disabled',true);
        }else{

        }
    });

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



  function haedcname(headid){

      var taxInd = $('#amthead'+headid).val();

     

      if(taxInd=='GT01'){
        $('#afgl_code'+headid).prop('readonly',true);
        $('#headamt').val('1');
        $('#showAllErrMsg').html('');
      }else{
        $('#afgl_code'+headid).prop('readonly',false);
        $('#headamt').val('0');
        $('#submitbtn').addClass('submitbtnC');
        $('#submitokbtn').show();
      }

      var xyz = $('#HeadList'+headid+' option').filter(function() {

        return this.value == taxInd;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){

         $('#amthead'+headid).val('');

       document.getElementById("HeadText"+headid).innerHTML = ''; 
       $('#afrate'+headid).val('');
       $('#aflogic'+headid).val('');
       $('#afratei'+headid).val('');

        $('#indexErr'+headid).html('');
        $('#logicErr'+headid).html('');
        $('#rateErr'+headid).html('');
         $('#taxIndCode'+headid).val('');

      }else{

        document.getElementById("HeadText"+headid).innerHTML = msg; 

            $('#indexErr'+headid).html('Required').css('color','red');
            $('#logicErr'+headid).html('Required').css('color','red');
            $('#rateErr'+headid).html('Required').css('color','red');

             $('#submitbtn').addClass('submitbtnC');
           $('#submitokbtn').show();

         if(taxInd == 'ST01' || taxInd == 'ST02' || taxInd=='R01' || taxInd=='GT01'){
              $('#afrate'+headid).val(100);
              $('#rateErr'+headid).html('');

              $('#afrate'+headid).prop('readonly',true);
         }else{
              $('#afrate'+headid).val('');
              $('#afrate'+headid).prop('readonly',false);
         }
      }


      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      $.ajax({

          url:"{{ url('get-tax-indicator-details') }}",

          method : "POST",

          type: "JSON",

          data: {taxInd: taxInd},

           success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){
                 
                  if(data1.data==''){

                  }else{
                    $('#taxIndCode'+headid).val(data1.data[0].tax_ind_code);
                     
                  }

       
                } /*if close*/

           }  /*success function close*/

      });  /*ajax close*/

  }


  function glCodeName(glcodeid){

      var val = $('#afgl_code'+glcodeid).val();

      //console.log(val);

      var xyz = $('#glList'+glcodeid+' option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){

         $('#afgl_code'+glcodeid).val('');

       document.getElementById("glText"+glcodeid).innerHTML = ''; 

      }else{

        document.getElementById("glText"+glcodeid).innerHTML = msg; 

       // $('#HeadText').innerHTML(msg);

      }

  }

  function rate_if_az(rateid){
   // console.log(rateid);

    //  for(i=rateid;i<=rateid;i++){

          var rateIndex = $('#afratei'+rateid).val();

         if(rateIndex == 'A' || rateIndex == 'Z' || rateIndex == 'P' || rateIndex == 'Q' || rateIndex == 'R' ){

           $('#staticIndBlock'+rateid).val(1);

           $('#staticIndBlock'+rateid).prop('disabled', true);

         }else{

           $('#staticIndBlock'+rateid).val(0);

           $('#staticIndBlock'+rateid).prop('disabled', false);

         }

         if(rateIndex){
            $('#indexErr'+rateid).html('');
            // $('#submitbtn').show();
         }else{

           $('#indexErr'+rateid).html('Required').css('color','red');
           $('#submitbtn').addClass('submitbtnC');
           $('#submitokbtn').show();
         }

         if(rateIndex == 'L' || rateIndex == 'M' || rateIndex == 'R'){
            $('#aflogic'+rateid).prop('readonly',true);
            $('#aflogic'+rateid).val('');
            $('#logicErr'+rateid).html('');
            $('#afrate'+rateid).val(100).prop('readonly',true);
            $('#rateErr'+rateid).html('');
         }else if(rateIndex == 'Z'){
            $('#afrate'+rateid).val(100).prop('readonly', true);
            $('#logicErr'+rateid).html('');
            $('#rateErr'+rateid).html('');
         }else{
             $('#aflogic'+rateid).prop('readonly',false);
             $('#logicErr'+rateid).html('Required').css('color','red');
              $('#afrate'+rateid).val('').prop('readonly',false);
              $('#rateErr'+rateid).html('Required').css('color','red');
         }



    //  }

  }


  function logicvalidated(logicid){
      var logicGet = $('#aflogic'+logicid).val();

      if(logicGet){
        $('#logicErr'+logicid).html('');
      }else{
        $('#logicErr'+logicid).html('Required').css('color','red');
        $('#submitbtn').addClass('submitbtnC');
        $('#submitokbtn').show();
      }
  }

  function ratevalidate(ratesid){

      var rateGet = $('#afrate'+ratesid).val();

      if(rateGet){
        $('#rateErr'+ratesid).html('');
      }else{
        $('#rateErr'+ratesid).html('Required').css('color','red');
        $('#submitbtn').addClass('submitbtnC');
        $('#submitokbtn').show();
      }
  }



    $(document).ready(function(){





        $('.datepicker').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          endDate: 'today',

          autoclose: 'true'

        });



        $("#trans_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#transList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("transText").innerHTML = msg; 



        });



        $("#tax_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#taxList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("taxText").innerHTML = msg; 



        });



        $("#series_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#seriesList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("seriesText").innerHTML = msg; 



        });



        $("#gi_code").bind('change', function () {  



          var val = $(this).val();



          var xyz = $('#giList option').filter(function() {



          return this.value == val;



          }).data('xyz');



          var msg = xyz ?  xyz : 'No Match';



          //alert(msg+xyz);



          document.getElementById("giText").innerHTML = msg; 



        });





      $("#countryCode").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#countryList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#countryName").val('');
        }else{
          $("#countryName").val(msg);
        }


      });



    });

</script>



<script type="text/javascript">

$(document).ready(function(){



    $('#submitfirstbtn').click(function(){

        var tax_code = $("#tax_code").val();

        var trans_code = $("#trans_code").val();

        var series_code  =  $("#series_code").val();

        var gi_code   =  $("#gi_code").val();



        if(tax_code=='' && trans_code=='' && series_code=='' && gi_code==''){

          $("#taxcodeErr").html('The Tax code field is required.').css('color','red');

          $("#transcodeErr").html('The Trans code field is required.').css('color','red');

          $("#sericecodeErr").html('The Series code field is required.').css('color','red');

          $("#glcodeErr").html('The Gl Code field is required.').css('color','red');



        }else if(tax_code==''){

          $("#taxcodeErr").html('The Tax code field is required.').css('color','red');

          $("#transcodeErr").html('');

          $("#sericecodeErr").html('');

          $("#glcodeErr").html('');

          return false;

        }else if(trans_code==''){

          $("#taxcodeErr").html('');

          $("#transcodeErr").html('The Trans code field is required.').css('color','red');

          $("#sericecodeErr").html('');

          $("#glcodeErr").html('');

          return false;

        }else if(series_code==''){

          $("#taxcodeErr").html('');

          $("#transcodeErr").html('');

          $("#sericecodeErr").html('The Series code field is required.').css('color','red');

          $("#glcodeErr").html('');

          return false;

        }else if(gi_code==''){

          $("#taxcodeErr").html('');

          $("#transcodeErr").html('');

          $("#sericecodeErr").html('');

          $("#glcodeErr").html('The Gl Code field is required.').css('color','red');

          return false;

        }else{

          $('#amountfield').removeClass('amntFild');

          $("#taxcodeErr").html('');

          $("#transcodeErr").html('');

          $("#sericecodeErr").html('');

          $("#glcodeErr").html('');

          $('#amntFild').removeClass('amntFild');

          $('a[href="#step-2"]').click();

        }



    });



   /* $('#submitsecondbtn').click(function(){





    });*/









 



});

</script>



<script type="text/javascript">

  $(document).ready(function(){



    $('#submitsecondbtn').click(function(){



      $('#nonaccfield').removeClass('nonAccFild');

      $('a[href="#step-3"]').click();





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




  function checkvalidation()
{
   
   var error = 1;
   var error1 = [];
   

    for(var q=2;q<=12;q++){

       var headamt = $('#headamt').val();
      
    /*   if(amthead=='GT01'){
        var amtvalue = amthead;

        var amtcount =amtvalue.length;
        console.log('amtcount',amtcount);
       }else{
        var amtvalue ='';
      //  console.log('falsevalue',amtvalue);
      console.log('amtcount',0);
       }
*/

       var logi_err =  $('#logicErr'+q).html();
       var logic =  $('#aflogic'+q).val();

       var rate_err =  $('#rateErr'+q).html();
       var rate =  $('#afrate'+q).val();


       var index =  $('#afratei'+q).val();
       var index_err =  $('#indexErr'+q).html();
      // console.log('index_err =>',index_err);
     
       if(logi_err != '' && logic == ''){
        var error = 0;
       // console.log('0 =>',error);
       }

        if(rate_err != '' && rate == ''){
        var error = 2;
      //  console.log('2 =>',error);
       }

       if(index_err == 'Required' && index == ''){
        var error =3;
        //console.log('3 =>',error);
       }

    }  



  


    if(error == 0 || error == 2 || error == 3 ){
      $('#showAllErrMsg').html('<div class="alert alert-danger alert-dismissible" role="alert"><strong>Error ...!</strong> Some Fields Are Required.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          
      $('#submitbtn').addClass('submitbtnC');
      return false
     }else if(headamt==0){
      $('#showAllErrMsg').html('<div class="alert alert-danger alert-dismissible" role="alert"><strong>Error ...!</strong> Grand Total Fields Are Required.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

      $('#submitbtn').addClass('submitbtnC');
      return false
     }
     else{
       $('#showAllErrMsg').html('');
      $('#submitokbtn').hide();
      $('#submitbtn').removeClass('submitbtnC');
        return true
     }

     
   

}

</script>




@endsection