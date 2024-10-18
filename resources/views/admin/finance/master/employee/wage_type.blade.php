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

.setwidthsel{

  width: 72px;

}

.amntFild{

  display: none;

}

.nonAccFild{

 display: none;

}

.showSeletedName{



    font-size: 15px;



    margin-top: 2%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;



  }

.headBox{

  width: 100px !important;

}

.staticBlock{

  width: 90px;

}
.settaxcodemodel{
    font-size: 18px;
    font-weight: 800;
    color: #5d9abd;

  }

.DatePickerToFrom{

    padding: 2px !important;

    border-radius: 1px !important;

    border: 1px solid #767676 !important;

}


.HeadTextshow{

    color: #3c8dbc;
    font-size: 90%;
    font-weight: 800;

}
.required-field::before {

    content: "*";

    color: red;

  }
.TaxCodeMargin{
  margin-left: 4%;
}
.StaticBlockGet{
  -webkit-appearance: menulist-button;
    height: 24px;
    width: 60%;
}
.submitbtnC{
  display: none;
} 
.rightnumber{
  text-align: right;
}

input[type=checkbox], input[type=radio] {
    margin: 4px 15px 0 !important;
    margin-top: 1px\9;
    line-height: normal;
}

</style>

<style>
  @media only screen and (max-width: 600px) {
   .TaxCodeMargin{
      margin-left: 0%;
    }
  }

</style>





<div class="content-wrapper">

  <section class="content-header">

    <h1>Master Employee Wage Type<small>Add Details</small></h1>

    <ol class="breadcrumb">

     <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

     <li><a href="{{ URL('/dashboard')}}">Master</a></li>

     <li class="Active"><a href="{{ URL('/finance/tran-tax-mast')}}">Master Wage Type  </a></li>
     
     <li class="Active"><a href="{{ URL('/finance/tran-tax-mast')}}">Add Wage Type </a></li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Wage Type</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('/Master/Employee/View-Emp-Wage-Type-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Wage Type</a>

            </div>

          </div><!-- /.box-header -->

          @if(Session::has('alert-success'))

          <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

          <h4><i class="icon fa fa-check"></i>Success...!</h4>{!! session('alert-success') !!}

          </div>

          @endif

          @if(Session::has('alert-error'))

          <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

          <h4><i class="icon fa fa-ban"></i>Error...!</h4>

           {!! session('alert-error') !!}

          </div>

          @endif

          <div class="box-body" style="overflow-x: auto;">

            <form action="{{ url('/Master/Employee/Wage-Type-Save') }}" method="POST" id="wagetypeform">

            @csrf

            <div class="row">

              
              <div class="col-xs-12">

                
                <div class="row">
                  
                  <div class="col-md-4"></div>
                  
                  <div class="col-md-3 TaxCodeMargin">

                    <div class="form-group">

                      <label>Grade Code : <span class="required-field"></span></label>

                      <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                      <input list="grade_list"  id="grade_code" name="grade_code" class="form-control  pull-left"  placeholder="Select Grade Code" oninput="gradecode(2)" autocomplete="off">

                      <datalist id="grade_list">

                        @foreach($grade_list as $rows)

                          <option value="{{ $rows->GRADE_CODE }}" data-xyz ="{{ $rows->GRADE_NAME }}">{{ $rows->GRADE_CODE }} = {{ $rows->GRADE_NAME }}</option>
                                             
                        @endforeach

                      </datalist>
                      
                      </div>
                      
                      <small> 

                        <div class="pull-left showSeletedName" id="taxText"></div>

                      </small>

                      <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('grade_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-5"></div>
                
                </div>

                <div class="row" style="    margin-top: 3%;">
                  <div class="col-md-12" >

                    <table class="table table-bordered table-striped table-hover">

                      <tbody>

                      <style>
                        .TdBold{
                        font-weight:bold;
                      }
                      </style>                           

                      <tr align="center">

                        <td class="TdBold" style="width:5%;">Sr.No</td>

                        <td class="TdBold" style="width:10%;">Wage Indicator</td>

                        <td class="TdBold" style="width:5%;">Index</td>

                        <td class="TdBold" style="width:5%;">Rate</td>

                        <td class="TdBold" style="width:5%;">Logic</td>

                        <td class="TdBold" style="width:5%;">Static</td>

                        <td class="TdBold" style="width:5%;">Month/Year</td>

                      </tr>

                      <tr>

                        <th class="text-center">1
                       
                        </th>

                        <td>

                          <select name="amthead0" id="wageindicator_code1" maxlength="15" class="headBox" disabled="true" value="">

                            @foreach($wageindicator_list as $key)

                              <option <?php if($key->WAGEIND_CODE  =='CTC'){echo "selected";} ?> value="{{$key->WAGEIND_CODE}}" data-xyz="{{$key->WAGEIND_NAME}}">{{ $key->WAGEIND_CODE }}</option>

                            @endforeach

                          </select><br>

                          @foreach($wageindicator_list as $key1)

                          <small class="HeadTextshow" id="HeadText1"><?php  if($key1->WAGEIND_CODE =='CTC'){echo $key1->WAGEIND_NAME;} ?>
                               
                          </small>

                          @endforeach

                          <input type="hidden" id="basicval1" name="amthead1">

                          <input type="hidden" value="A" name="static_ind_bs">

                          <input type="hidden" value="1" name="taxIndCode1" id="taxIndCode1">
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>

                      <?php 
                                 
                      $dataSr = 2;

                      $dataRow = 20-1;

                      for($i=0;$i<$dataRow;$i++){
                       
                      ?>
                      <tr>

                        <th class="text-center"><?php echo $dataSr; ?>
                        </th>

                        <td class="row">
                        
                          <div class="input-group col-sm-12">
                            <input type="hidden" name="srno" id="srno" value="">

                            <input list="wageindicator_list<?php echo $dataSr; ?>"  id="wageindicator_code<?php echo $dataSr; ?>" name="wageindicator_code[]" class="form-control  pull-left" value=""onchange="indicator(<?php echo $dataSr; ?>)" placeholder="Select Wage Indicator" disabled autocomplete="off">

                            <datalist id="wageindicator_list<?php echo $dataSr; ?>">
                              
                              <option value="">--SELECT--</option>

                                @foreach($wageindicator_list as $rows)

                                <option value="{{ $rows->WAGEIND_CODE }}" data-xyz ="<?php echo $rows->WAGEIND_NAME; ?>">{{ $rows->WAGEIND_CODE }} = {{ $rows->WAGEIND_NAME }}</option>
                                 

                                 @endforeach

                            </datalist>

                          </div>

                          <input type="hidden" name="wageIndType[]" id="wageIndType<?php echo $dataSr; ?>" value="">
                          
                          <small id="wageindicatorErr<?php echo $dataSr; ?>"></small>
                          
                          <div class="pull-left showSeletedName" id="wageIndicatorText<?php echo $dataSr; ?>">
                            
                          </div>

                        </td>

                        <td>
                          
                          <div class="input-group">

                            <input list="rate_list<?php echo $dataSr; ?>"  id="rate_code<?php echo $dataSr; ?>" name="rate_code[]" class="form-control" placeholder="---Select Rate Code---" oninput="ratecode(<?php echo $dataSr; ?>)" autocomplete="off">

                            <datalist id="rate_list<?php echo $dataSr; ?>">
                                          
                              <option value="">--SELECT--</option>

                                 @foreach($rate_list as $rows)

                                  <option value="{{ $rows->RATE_VALUE }}"data-xyz ="{{ $rows->RATE_NAME }}" ><?php echo $rows->RATE_VALUE; ?> = <?php echo $rows->RATE_NAME ?></option>

                                  @endforeach

                            </datalist>

                            <input type="hidden" name="rate_name[]" id="rate_name<?php echo $dataSr; ?>" value="">



                          </div>
                        </td>

                        <td>

                          <input type="text" name="rate[]" class="form-control  pull-left" id="rate<?php echo $dataSr; ?>"value="" oninput="removerateval(<?php echo $dataSr; ?>)"placeholder="Rate" oninput="ratevalidate(<?php echo $dataSr; ?>)" disabled autocomplete="off">

                          <small id="rateErr<?php echo $dataSr; ?>">
                          </small>

                        </td>

                        <td>

                          <input type="text" name="logic[]" class="form-control  pull-left"  id="logic<?php echo $dataSr; ?>" value="" placeholder="Logic"  onclick="funSelLogic(<?php echo $dataSr; ?>)" disabled autocomplete="off">

                          <small id="logicErr<?php echo $dataSr; ?>">
                          </small>

                        </td>

                        <td>

                          <select class="form-control" id="static<?php echo $dataSr; ?>" name="static[]">
                          
                            <option value="1" selected>Yes</option>

                            <option value="0">No</option>

                          </select>
                        </td>

                        <td>

                          <select class="form-control" id="monthOrYr<?php echo $dataSr; ?>" name="monthOrYr[]">
                          
                            <option value="Monthly" selected>Monthly</option>

                            <option value="Quarterly">Quarterly</option>

                            <option value="Half Year">Half Year</option>

                            <option value="Yearly">Yearly</option>
                              
                         </select>

                        </td>

                      </tr>
                      
                      <?php 
                        $dataSr++;  }
                      ?>
                                 
                    </tbody>
                  
                  </table>
                        
                </div>
                </div>

                <div class="text-center">
                  <div id="showAllErrMsg"></div><br>
                </div>

                <div style="text-align: center;">
                
                  <div id="showAllErrMsg"></div><br>
                  <button type="button" id="submitokbtn" class="btn btn-primary okbtnhideaftrcheck"  onclick="return checkvalidation()">OK</button>

                
                  <button type="submit" class="btn btn-primary submitbtnC"  style="margin-left: 10%;" id="submitbtn"><i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Save</button>
                </div>

                <div class="modal fade" id="selectLogic" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="">

                  <div class="modal-dialog modal-sm" role="document" style="margin-top: 5%;">

                    <div class="modal-content" style="border-radius: 5px;">

                        <div class="modal-header text-center">

                         <label class="settaxcodemodel">Select Logic</label>

                        </div>

                        <style>

                          .boxer {
                            display: table;
                            border-collapse: collapse;
                          }
                          .boxer .box-row {
                            display: table-row;
                          }
                          .boxer .box-row:first-child {
                            font-weight:bold;
                          }
                          .boxer .box10 {
                            display: table-cell;
                            vertical-align: top;
                            border: 1px solid #ddd;
                            padding: 5px;
                          }
                          .boxer .ebay {
                            padding:5px 1.5em;
                          }
                          .boxer .google {
                            padding:5px 1.5em;
                          }
                          .boxer .amazon {
                            padding:5px 1.5em;
                          }
                          .center {
                            text-align:center;
                          }
                          .right {
                            float:right;
                          }
                          .texIndbox{
                            width: 15%; 
                            text-align: center;
                          }
                          .texIndbox_itm{
                            width: 20%;
                          }
                          .texIndbox_vr{
                            width: 12%;
                          }
                          .rateIndbox{
                            width: 15%;
                            text-align: center;
                          }
                          .rateBox{
                            width: 20%;
                            text-align: center;
                          }
                          .amountBox{
                            width: 20%;
                            text-align: center;
                          }
                          .inputtaxInd{
                            background-color: white !important;
                            border: none;
                            text-align: center;
                          }
                          .showind_Ch{
                            display: none;
                          }

                        </style>

                        <div class="modal-body table-responsive">

                            <div class="modalspinner hideloaderOnModl"></div>
                            
                            <div class="boxer" id="logic_Data"></div>

                        </div>

                        <div class="modal-footer">

                          <center>

                            <span  id="footer_modal_pay1" style="width: 56px;"></span>
                            <input type="hidden" id="rowIdUn" value="">
                            <button type="button" class="btn btn-primary" onclick="getCheckboxValue(); getLogicVal()" data-dismiss="modal" style="width:100px">OK</button>
                          </center>
                        
                        </div>

                      </div>

                      </div>

                      </div>
                      
                  </div>

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

 function removerateval(inputId){
  var rateVal =  $('#rate'+inputId).val();

   if(rateVal){
    $('#rateErr'+inputId).html('');
    $('#logic'+inputId).prop('disabled', false);
   }else{
    $('#rateErr'+inputId).html('Required');
   }
 }

 function removelogicval(inputId){
  // setTimeout(function() {
  var logicVal =  $('#logic'+inputId).val();
  console.log('logic value', logicVal);
  var nextid = inputId+1;
   if(logicVal){
    $('#logicErr'+inputId).html('');
    $('#wageindicator_code'+nextid).prop('disabled', false);
   }else{
    $('#logicErr'+inputId).html('Required');
   }
    // }, 1000);
 }

 function funSelLogic(srno){
  
  var wagecode = [];
  for(var i=1; i<srno; i++){

     var sr = srno-i;

     wagecodeVal = $('#wageindicator_code'+sr).val();
     
     wagecode.push(wagecodeVal);
     
  }
  
  $('#selectLogic').modal('show');

  $('#logic_Data').empty();

   var srNo = 1;
   $('#rowIdUn').val(srno);
   for(var j = wagecode.length; j>0 ; j--){
    
     var p= parseInt(j)-1;
     var tableData = '<div class="form-check">'+
      '<input type="checkbox" class="form-check-input allcheck" id="checkLogic'+srNo+'" name="lagicVal[]" value="'+srNo+'" >'+
      '<label class="form-check-label" for="check1">' +wagecode[p]+'</label>'+
      '</div>';

     var getInputVal = $('#logic'+srno).val();

     var inputVal  = getInputVal.split(",");
     
     $('#logic_Data').append(tableData);

     if(getInputVal !=''){
       
        for(i=0; i < inputVal.length; i++){
       
        $("#checkLogic"+inputVal[i]).attr("checked", true);

      }
        
     }
    
     srNo++;
  }
}

 function getCheckboxValue(){
    
    var inputs = document.querySelectorAll('.allcheck'); 
   
    var idRow = parseInt($('#rowIdUn').val());
   
    var idnextRow = idRow+1;
    var logics = [];  
    
        for (var i = 1; i <= inputs.length; i++) {

            logicsVal = $('#checkLogic'+i+':checked').val();
           
            if(logicsVal != undefined){

             logics.push(logicsVal);

            }
        } 

        $('#logic'+idRow).val(logics);
 }

 function getLogicVal(){

  setTimeout(function() {

    var idRow = parseInt($('#rowIdUn').val());
    var logicval = $('#logic'+idRow).val();
    var idnextRow = idRow+1;
    
    if(logicval != ''){

       $('#logicErr'+idRow).html('');

       $('#wageindicator_code'+idnextRow).prop('disabled', false);

    }else {

       $('#logicErr'+idRow).html('Required').css('color', 'red');

       $('#wageindicator_code'+idnextRow).prop('disabled', true);
    }

   }, 500);

 }

 function gradecode(inputid){
  var gradeVal =  $('#grade_code').val();

   if(gradeVal){
    $('#gradecodeErr').html('');
    $('#wageindicator_code'+inputid).prop('disabled', false);
    $('#wageindicatorErr'+inputid).html('Required').css('color','red');
   }else{
    $('#gradecodeErr').html('Required');

   }
 }


function ratecode(ratecodeId){

  var ratecode =$('#rate_code'+ratecodeId).val();

  var nextId = ratecodeId+1;

  if(ratecode == 'L' || ratecode == 'M'){
   
    $('#rate'+ratecodeId).prop('readonly', true);
    $('#logic'+ratecodeId).prop('disabled', false);
    $('#rate'+ratecodeId).val('100');
    $('#logic'+ratecodeId).val('');
    $('#logic'+ratecodeId).prop('readonly', true);
    $('#rateErr'+ratecodeId).html('');
    $('#logicErr'+ratecodeId).html('');
    $('#wageindicator_code'+nextId).prop('disabled', false);

   }else{

     $('#rate'+ratecodeId).prop('readonly', false);
     $('#logic'+ratecodeId).prop('readonly', false);
     $('#rateErr'+ratecodeId).html('Required');
     $('#logicErr'+ratecodeId).html('Required');
     $('#wageindicator_code'+nextId).prop('disabled', true);

   }

  if(ratecode == 'Z'){

    $('#rate'+ratecodeId).prop('readonly', true);
    $('#rate'+ratecodeId).val('100');
    $('#rateErr'+ratecodeId).html('');
    $('#logic'+ratecodeId).prop('disabled', false);

  }

  var xyzInd = $('#rate_list'+ratecodeId+' option').filter(function() {

  return this.value == ratecode;

  }).data('xyz');

  var msgInd = xyzInd ?  xyzInd : 'No Match';

  if(msgInd=='No Match'){

    $('#rate_name'+ratecodeId).val('');
    $('#rate_code'+ratecodeId).val('');
     

  }else{

    $('#rate_name'+ratecodeId).val(msgInd);

  }
}

function indicator(headid){

    var valInd = $('#wageindicator_code'+headid).val();

    var xyzInd = $('#wageindicator_list'+headid+' option').filter(function() {

    return this.value == valInd;

    }).data('xyz');

    var msgInd = xyzInd ?  xyzInd : 'No Match';

    if(msgInd=='No Match'){

      $('#rateErr'+headid).html('Required');
      $('#wageindicator_code'+headid).val('');
      $('#wageIndicatorText'+headid).html('');
      $('#wageindicatorErr'+headid).html('Required').css('color','red');

    }else{

      $('#wageIndicatorText'+headid).html(msgInd);
      $('#wageindicatorErr'+headid).html('');
      $('#rateErr'+headid).html('');
      $('#rate'+headid).prop('disabled', false);
    }

    var wageInd = $('#wageindicator_code'+headid).val();
    var rate = $('#rate'+headid).val();
    var logic = $('#logic'+headid).val();
  
    if(rate == ''){

       $('#rateErr'+headid).html('Required').css('color','red');
       
       $('#rateErr'+headid).onfocus = null;

    }else{

      $('#rateErr'+headid).html('');
    }

    if(logic == ''){

     $('#logicErr'+headid).html('Required').css('color','red');

    }else{

      $('#logicErr'+headid).html('');
    }

    var wageindicator_code = $('#wageindicator_code'+headid).val();
      
    $.ajaxSetup({
        headers: {

             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
    });

    $.ajax({

      type: 'POST',

      url: "{{ url('/Master/Employee/wage-indicator-type') }}",

      data: {wageindicator_code : wageindicator_code}, // here $(this) refers to the ajax object not form

      success: function (data) {

      var obj = JSON.parse(data);

      if (obj.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                    
      }else if(obj.response == 'success'){

        if(obj.data==''){

        }else{
          
           $('#wageIndType'+headid).val(obj.data.WAGEIND_TYPE);
        }

      }

      },

    });
      
 }    

 function checkvalidation()
 {
   
   var error = 1;
   var error1 = [];
   
    var gradecode =  $('#grade_code').val();
    var k;var i;
    for (var i = 2; i <= 20; i++) {
 
      var headamt = $('#wageindicator_code'+i).val();

       var srno =  $('#srNo'+i).val();
       console.log('sr', srno);
      
       var logic =  $('#logic'+i).val();
       var logi_err =  $('#logicErr'+i).html();

       var rate =  $('#rate'+i).val();
       var rate_err =  $('#rateErr'+i).html();


       var wageIndi =  $('#wageindicator_code'+i).val();
       var wageIndi_err =  $('#wageindicatorErr'+i).html();

       if(wageIndi_err == 'Required' && wageIndi == ''){

        var error =3;
       
       }else if(rate_err != '' && rate == ''){

        var error = 0;
       
       }else if(logi_err != '' && logic == ''){

        var error = 2;
       
       }
      
       if(error == 0 || error == 2 || error == 3){
           
            $('#showAllErrMsg').html('');

            $('#showAllErrMsg').html('<div class="alert alert-danger alert-dismissible" role="alert"><strong>Error ...!</strong> Some Fields Are Required or Enter Proper Logi.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                
            $('#submitbtn').addClass('submitbtnC');

        }else{

            $('#showAllErrMsg').html('');
            $('#showAllErrMsg').html('<div class="alert alert-danger alert-dismissible" role="alert"><strong>Error ...!</strong> Select NP Wage Indicator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            

        }

        if(wageIndi == 'NP'){

           $('#showAllErrMsg').html('');
           $('#submitokbtn').hide();
              $('#submitbtn').removeClass('submitbtnC');
                return true;
        }
        else{
          $('#showAllErrMsg').html('');

              $('#showAllErrMsg').html('<div class="alert alert-danger alert-dismissible" role="alert"><strong>Error ...!</strong> Select NP Wage Indicator.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        }
    }
  }

  $(document).ready(function(){

      $("#grade_code").bind('change', function () {  

         var val = $(this).val();

         var xyz = $('#grade_list option').filter(function() {

          return this.value == val;

         }).data('xyz');

         var msg = xyz ?  xyz : 'No Match';

         document.getElementById("taxText").innerHTML = msg; 

      });

    });


  
</script>

@endsection