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

  .beforhidetble{
    display: none;
  }
  .popover{
    left: 70.4922px!important;
    width: 110%!important;
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

  <section class="content-header">

    <h1>Master Unit WBS <small>Update Details</small> </h1>


    <ol class="breadcrumb">


      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Master</a></li>

      <li class="Active"><a href="{{ url('Master/Infrastructure/View-Unit-Wbs-Master') }}">Infrastructure</a></li>

      <li class="Active"><a href="{{ url('Master/Infrastructure/View-Project-Unit-Master') }}">Edit Unit WBS</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!-- <div class="col-sm-1"></div> -->

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Unit WBS</h2>

            <div class="box-tools pull-right">

              <a href="{{url('/Master/Infrastructure/view-unit-wbs-master')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Unit WBS</a>

            </div>

          </div><!-- /.box-header -->

          @if(Session::has('alert-success'))

          <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4><i class="icon fa fa-check"></i>

              Success...!

            </h4>

            {!! session('alert-success') !!}

          </div>

          @endif

          @if(Session::has('alert-error'))

          <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4> <i class="icon fa fa-ban"></i>

              Error...!
            </h4>

            {!! session('alert-error') !!}
          </div>

          @endif

          <div class="box-body">
            <form action="{{url('/Master/Infrastructure/update-unit-wbs-master')}}" method="POST" enctype="multipart/form-data" id="unitDetailForm">


              @csrf
              <div class="row">

                <div class="col-sm-12">

                  <div class="box box-primary Custom-Box">

                    <div class="box-body">

                      <div class="table-responsive">

                        <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblUnit_details">

                          <tr>

                            <th>

                              <input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row">

                            </th>

                            <th>Sr.No.</th>

                            <th>Unit Code <small style="color:red;font-size:14px;text-align:center;">*</small> </th>

                            <th>Unit Name <small style="color:red;font-size:14px;text-align:center;">*</small> </th>


                            <th>WBS Code <small style="color:red;font-size:14px;">*</small></th>

                            <th>WBS Name <small style="color:red;font-size:14px;">*</small></th>

                            <th>WBS Plant Start Date <small style="color:red;font-size:14px;">*</small></th>
                            <th>WBS Plant End Date <small style="color:red;font-size:14px;">*</small></th>
                            <th>WBS Actual Start Date <small style="color:red;font-size:14px;">*</small></th>
                            <th>WBS Actual End Date <small style="color:red;font-size:14px;">*</small></th>
                            <th>WBS Status <small style="color:red;font-size:14px;">*</small></th>
                            <th>WBS Progress <small style="color:red;font-size:14px;">*</small></th>


                          </tr>

                          <tr class="useful">

                            <td class="tdthtablebordr" style='padding-top: 2%;'>
                              <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/>
                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <span id='snum'>1.</span>

                           
                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                                 <input type='hidden' name='ProjectInfoDetlSlno[]' id='ProjectInfoDetlSlno1' value='{{$acctype_list->UNITWBSID}}'>

                              <input list='unitcode_list' name='unit_code[]' id='unit_code1' value='{{$acctype_list->UNITWBS_CODE}}' class='' style="margin-bottom:5px;" autocomplete="off" onclick="funUnitCode(1)" >

                              <datalist id='unitcode_list'>

                                @foreach ($unitListmaster as $key)

                                <option value='<?php echo $key->UNIT_CODE?>' data-xyz ="<?php echo $key->UNIT_CODE; ?>" ><?php echo $key->UNIT_CODE ; echo " [".$key->UNIT_CODE."]" ; ?></option>

                                @endforeach


                              </datalist>



                              <small id="unit_codeErr1"></small>

                            </td>


                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <input list='unitname_list' name='unit_name[]' id='unit_name1' value='{{$acctype_list->UNITWBS_NAME}}' class='' style="margin-bottom:5px;" autocomplete="off" onclick="funUnitName(1)" >
                              <datalist id='unitname_list'>


                                @foreach ($unitListmaster as $key)

                                <option value='<?php echo $key->UNIT_NAME?>' data-xyz ="<?php echo $key->UNIT_NAME; ?>" ><?php echo $key->UNIT_NAME ; echo " [".$key->UNIT_NAME."]" ; ?></option>

                                @endforeach



                              </datalist>



                              <small id="unit_nameErr1"></small>

                            </td>

                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <input list='wbs_codeList' name='wbscode[]' id='wbs_code1' value='{{$acctype_list->WBS_CODE}}' class='' style="margin-bottom:5px;" autocomplete="off" onclick="funWbsCode(1)" >

                              <datalist id='wbs_codeList'>

                                @foreach ($wbscodelist as $key)

                                <option value='<?php echo $key->WBS_CODE?>' data-xyz ="<?php echo $key->WBS_CODE; ?>" ><?php echo $key->WBS_CODE ; echo " [".$key->WBS_CODE."]" ; ?></option>

                                @endforeach


                              </datalist>



                              <small id="wbs_codeErr1"></small>

                            </td>


                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <input list='wbs_nameList' name='wbsname[]' id='wbs_name1' value='{{$acctype_list->WBS_NAME}}' class='' style="margin-bottom:5px;" autocomplete="off" onclick="funWbsName(1)" >

                              <datalist id='wbs_nameList'>

                                @foreach ($wbscodelist as $key)

                                <option value='<?php echo $key->WBS_NAME?>' data-xyz ="<?php echo $key->WBS_NAME; ?>" ><?php echo $key->WBS_NAME ; echo " [".$key->WBS_NAME."]" ; ?></option>

                                @endforeach

                              </datalist>



                              <small id="wbs_nameErr1"></small>

                            </td>



                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <input  type="text" name='wbs_plantst_date[]'value='{{$acctype_list->WBS_PLAN_STDATE}}' id='plantstdate1' class="plantst_date" autocomplete="off" style="margin-bottom:5px;" maxlength="10"><br>

                              <small id="wbsstdateErr1"></small>

                            </td>
                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <input  type="text"  name='wbs_planted_date[]' id='planteddate1' class="planted_date" value='{{$acctype_list->WBS_PLAN_ENDATE}}' autocomplete="off" style="margin-bottom:5px;" maxlength="10"><br>

                              <small id="wbseddateErr1"></small>

                            </td>
                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <input  type="text" name='wbs_actual_stdate[]' id='actualstdate1' class="actualst_date" value='{{$acctype_list->WBS_ACT_STDATE}}'autocomplete="off" style="margin-bottom:5px;" maxlength="10"><br>

                              <small id="wbsactualstartErr1"></small>

                            </td>
                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <input  type="text" name='wbs_actual_eddate[]' id='actualeddate1' class="actualed_date" value='{{$acctype_list->WBS_ACT_ENDATE}}'autocomplete="off" style="margin-bottom:5px;" maxlength="10"><br>

                              <small id="wbsactualendErr1"></small>

                            </td>
                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <input  type="text" name='wbs_status[]' id='wbsstatus1' class="" value="{{ $acctype_list->WBS_STATUS}}" autocomplete="off" style="margin-bottom:5px;" maxlength="20"><br>

                              <small id="statusErr1"></small>

                            </td>
                            <td class="tdthtablebordr" style='padding-top: 2%;'>

                              <input  type="text" name='wbs_progress[]' id='wbsprogress1' class="number" value="{{ $acctype_list->WBS_PROGRESS}}" autocomplete="off" style="margin-bottom:5px; text-align: right;" maxlength="10"><br>

                              <small id="progressErr1"></small>

                            </td>
                          </tr>

                        </table>

                      </div>

                     

                      <div class="text-center col-md-12">

                        <button type="button" class="btn btn-success" id="AddUnitDetail"><i class="fa fa-floppy-o"></i> Update</button>
                        <button class="btn btn-warning" id="btnReset" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Reset</button>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </form>

          </div><!-- /.box-body -->

        </div>


      </div>
    </div>

  </section>


</div>


@include('admin.include.footer')


<script type="text/javascript">

  $(document).ready(function(){

      $("input.number").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
      });

})


  $(document).ready(function(){

    $('.plantst_date').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });


  });

  function funUnitCode(id){

    $("#unit_code"+id).bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#unitcode_list option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

       if(msg=='No Match'){
          $(this).val('');
          $("#unit_name"+id).val('');
        }else{
          $("#unit_name"+id).val(msg);
        }
    })
  }  

  

   function funUnitName(id){

    $("#unit_name"+id).bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#unitname_list option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#unit_name'+id).val('');
      }else{

      }
    })
  } 

  function funWbsCode(id){

    $("#wbs_code"+id).bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#wbs_codeList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#wbs_code'+id).val('');
      }else{

      }
    })
  }  


  function funWbsName(id){

    $("#wbs_name"+id).bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#wbs_nameList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#wbs_name'+id).val('');
      }else{

      }
    })
  }   

  $(function(){


    var i=2;

    $(".addmore").on('click',function(){


      count=$('#tblUnit_details tr').length;

      countTr = count-1;

      var unit_code =  $('#unit_code'+countTr).val();
      var unit_name =  $('#unit_name'+countTr).val();
      var wbs_code =  $('#wbs_code'+countTr).val();
      var wbs_name =  $('#wbs_name'+countTr).val();
      var wbs_plantst_date  =  $('#plantstdate'+countTr).val();
      var wbs_planted_date  =  $('#planteddate'+countTr).val();
      var wbs_actualst_date  = $('#actualstdate'+countTr).val();
      var wbs_actualed_date  =  $('#actualeddate'+countTr).val();
      var wbs_status  =  $('#wbsstatus'+countTr).val();
      var wbs_progress  =  $('#wbsprogress'+countTr).val();
      console.log('wbs_progress',wbs_progress);


      if(unit_code == ''){
        $('#unit_codeErr'+countTr).html('Unit Code Is Required').css('color','red');
        return false;
      }
      else{
        $('#unit_codeErr'+countTr).html('');
      }

      if(unit_name == ''){
        $('#unit_nameErr'+countTr).html('Unit Name Is Required').css('color','red');
        return false;
      }
      else{
        $('#unit_nameErr'+countTr).html('');
      }

      if(wbs_code == ''){
        $('#wbs_codeErr'+countTr).html('WBS code Is Required').css('color','red');
        return false;
      }else{
        $('#wbs_codeErr'+countTr).html('');
      }


      if(wbs_name == ''){
        $('#wbs_nameErr'+countTr).html('WBS Name Is Required').css('color','red');
        return false;

      }else{

        $('#wbs_nameErr'+countTr).html('');
      }



      if(wbs_plantst_date == ''){
        $('#wbsstdateErr'+countTr).html('WBS Stdate Is Required').css('color','red');
        return false;

      }else{

        $('#wbsstdateErr'+countTr).html('').css('color','red');
      }

      if(wbs_planted_date == ''){
        $('#wbseddateErr'+countTr).html('WBS Etdate Is Required').css('color','red');
        return false;

      }else{

        $('#wbseddateErr'+countTr).html('').css('color','red');
      }



      if(wbs_actualst_date == ''){
        $('#wbsactualstartErr'+countTr).html('WBS Actual stdate Is Required').css('color','red');
        return false;

      }else{

        $('#wbsactualstartErr'+countTr).html('').css('color','red');
      } 

      if(wbs_actualed_date == ''){
        $('#wbsactualendErr'+countTr).html('WBS Actual eddate Is Required').css('color','red');
        return false;

      }else{

        $('#wbsactualendErr'+countTr).html('').css('color','red');
      }  



      if(wbs_status == ''){
        $('#statusErr'+countTr).html('WBS Status Is Required').css('color','red');
        return false;

      }else{

        $('#statusErr'+countTr).html('').css('color','red');

      }  
      if(wbs_progress == ''){
        $('#progressErr'+countTr).html('WBS Progress Is Required').css('color','red');
        return false;

      }else{

        $('#progressErr'+countTr).html('').css('color','red');




        var data="<tr><td class='tdthtablebordr' style='padding-top: 23px;'><input type='checkbox' class='case'/></td><td class='tdthtablebordr' style='padding-top: 22px;'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='ProjectInfoDetlSlno[]' id='ProjectInfoDetlSlno' value='"+count+"'></td>";
        data +="<td class='tdthtablebordr' style='padding-top: 2%;'><input list='unitcode_list' name='unit_code[]' id='unit_code"+count+"' value='' class='' style='margin-bottom:5px;' autocomplete='off' onclick='funProjCode(1)' ><datalist id='unitcode_list'>option value='anjali' data-xyz=''></option></datalist><small id='unit_codeErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input list='unitname_list' name='unit_name[]' id='unit_name"+count+"' value='' class='' style='margin-bottom:5px;' autocomplete='off' onclick='funProjCode(1)'><datalist id='unitname_list'><option value='anajli' data-xyz=''></option></datalist><small id='unit_nameErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input list='wbs_codeList' name='wbscode[]' id='wbs_code"+count+"' value='' class='' style='margin-bottom:5px;' autocomplete='off' onclick='funProjCode(1)'><datalist id='wbs_codeList'>@foreach ($wbscodelist as $key)<option value='<?php echo $key->WBS_CODE?>' data-xyz ='<?php echo $key->WBS_CODE; ?>' ><?php echo $key->WBS_CODE ; echo ' ['.$key->WBS_CODE.']' ; ?></option>@endforeach</datalist><small id='wbs_codeErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input list='wbs_nameList' name='wbsname[]' id='wbs_name"+count+"' value='' class='' style='margin-bottom:5px;' autocomplete='off' onclick='funProjCode(1)' ><datalist id='wbs_nameList'>@foreach ($wbscodelist as $key)option value='<?php echo $key->WBS_NAME?>' data-xyz ='<?php echo $key->WBS_NAME; ?>' ><?php echo $key->WBS_NAME ; echo ' ['.$key->WBS_NAME.']' ; ?></option>@endforeach</datalist><small id='wbs_nameErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='wbs_plantst_date[]'value='' id='plantstdate"+count+"' class='plantst_dt' autocomplete='off' style='margin-bottom:5px;' maxlength='10'><small id='wbsstdateErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text'  name='wbs_planted_date[]' id='planteddate"+count+"' class='planted_dt' autocomplete='off' style='margin-bottom:5px;' maxlength='10'><small id='wbseddateErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='wbs_actual_stdate[]' id='actualstdate"+count+"' class='actualst_dt' autocomplete='off' style='margin-bottom:5px;' maxlength='10'><small id='wbsactualstartErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='wbs_actual_eddate[]' id='actualeddate"+count+"' class='actualed_dt' autocomplete='off'style='margin-bottom:5px;'' maxlength='10'><small id='wbsactualendErr"+count+"'></small></td><td class='tdthtablebordr'style='padding-top: 2%;'><input  type='text'name='wbs_status[]'id='wbsstatus"+count+"'class='' autocomplete='off'style='margin-bottom:5px;'' maxlength='20'><small id='statusErr"+count+"'></small></td><td class='tdthtablebordr'style='padding-top: 2%;'><input  type='text'name='wbs_progress[]'id='wbsprogress1"+count+"' class=''autocomplete='off'style='margin-bottom:5px;' maxlength='10'><small id='progressErr"+count+"'></small></td></tr>";

        $('#tblUnit_details').append(data);

        i++;

        $('.plantst_dt').datepicker({

          format: "dd-mm-yyyy",

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

        });

        $('.planted_dt').datepicker({

          format: "dd-mm-yyyy",

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

        });

        $('.actualst_dt').datepicker({

          format: "dd-mm-yyyy",

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

        });

        $('.actualed_dt').datepicker({

          format: "dd-mm-yyyy",

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

        });




      }






    });

});



$(".delete").on('click', function() {


  $('.case:checkbox:checked').parents('#tblUnit_details tr').remove();

  $('.check_all').prop("checked", false); 

  check();

});

function check(){

  obj = $('#tblUnit_details tr').find('span');

  $.each( obj, function( key, value ) {

    id=value.id;

    $('#'+id).html(key+1);

  });

}

$('#AddUnitDetail').on('click',function(){

  var data         = $('#unitDetailForm').serialize();

  var count        = $('#tblUnit_details tr').length;
  var trCount      = count-1;

  for(var q=0;q<trCount;q++){

    var w = q +1;

    var unit_code =  $('#unit_code'+w).val();
    var unit_name =  $('#unit_name'+w).val();
    var wbs_code =  $('#wbs_code'+w).val();
    var wbs_name =  $('#wbs_name'+w).val();
    var wbs_plantst_date  =  $('#plantstdate'+w).val();
    var wbs_planted_date  =  $('#planteddate'+w).val();
    var wbs_actualst_date  = $('#actualstdate'+w).val();
    var wbs_actualed_date  =  $('#actualeddate'+w).val();
    var wbs_status  =  $('#wbsstatus'+w).val();
    var wbs_progress  =  $('#wbsprogress'+w).val();


    if(unit_code == ''){
      $('#unit_codeErr'+w).html('Unit Code Is Required').css('color','red');
      return false;
    }
    else{
      $('#unit_codeErr'+w).html('');
    }

    if(unit_name == ''){
      $('#unit_nameErr'+w).html('Unit Name Is Required').css('color','red');
      return false;
    }
    else{
      $('#unit_nameErr'+w).html('');
    }

    if(wbs_code == ''){
      $('#wbs_codeErr'+w).html('WBS code Is Required').css('color','red');
      return false;
    }else{
      $('#wbs_codeErr'+w).html('');
    }


    if(wbs_name == ''){
      $('#wbs_nameErr'+w).html('WBS Name Is Required').css('color','red');
      return false;

    }else{

      $('#wbs_nameErr'+w).html('');
    }



    if(wbs_plantst_date == ''){
      $('#wbsstdateErr'+w).html('WBS Stdate Is Required').css('color','red');
      return false;

    }else{

      $('#wbsstdateErr'+w).html('').css('color','red');
    }

    if(wbs_planted_date == ''){
      $('#wbseddateErr'+w).html('WBS Etdate Is Required').css('color','red');
      return false;

    }else{

      $('#wbseddateErr'+w).html('').css('color','red');
    }



    if(wbs_actualst_date == ''){
      $('#wbsactualstartErr'+w).html('WBS Actual stdate Is Required').css('color','red');
      return false;

    }else{

      $('#wbsactualstartErr'+w).html('').css('color','red');
    } 

    if(wbs_actualed_date == ''){
      $('#wbsactualendErr'+w).html('WBS Actual eddate Is Required').css('color','red');
      return false;

    }else{

      $('#wbsactualendErr'+w).html('').css('color','red');
    }  



    if(wbs_status == ''){
      $('#statusErr'+w).html('WBS Status Is Required').css('color','red');
      return false;

    }else{

      $('#statusErr'+w).html('').css('color','red');

    }  


    if(wbs_progress == ''){
      $('#progressErr'+w).html('WBS Progress Is Required').css('color','red');
      return false;

    }else{
      $('#progressErr'+w).html('');}

    }


    $.ajaxSetup({

      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });


    $.ajax({

      type: 'POST',

      url: "{{ url('/Master/Infrastructure/update-unit-wbs-master') }}",

      data: data,

      success: function (data) {


        var data1 = JSON.parse(data);
        console.log('data1',data1);   


        if(data1.response == 'success'){

          window.location.href = "{{ url('/Master/Infrastructure/view-unit-wbs-master')}}";


        }

      }
    });
  });



$(document).ready(function(){


  $('#plantstdate1').datepicker({

    format: "dd-mm-yyyy",

    orientation: 'bottom',

    todayHighlight: 'true',

    autoclose: 'true'

  });


  $('#planteddate1').datepicker({
    format: "dd-mm-yyyy",

    orientation: 'bottom',

    todayHighlight: 'true',

    autoclose: 'true'


  });
  $('#actualstdate1').datepicker({
    format: "dd-mm-yyyy",

    orientation: 'bottom',

    todayHighlight: 'true',

    autoclose: 'true'


  });

  $('#actualeddate1').datepicker({
    format: "dd-mm-yyyy",

    orientation: 'bottom',

    todayHighlight: 'true',

    autoclose: 'true'


  });




  $('.Number').keypress(function (event) {

    var keycode = event.which;

    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

      event.preventDefault();

    }

  });

});

</script>











@endsection