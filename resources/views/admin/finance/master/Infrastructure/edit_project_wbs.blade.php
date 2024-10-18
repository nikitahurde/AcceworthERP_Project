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

      <h1>Master Project WBS <small>Update Details</small> </h1>


      <ol class="breadcrumb">


        <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ URL('/dashboard')}}">Master</a></li>
        
        <li class="Active"><a href="{{ url('Master/Infrastructure/View-Project-Wbs-Master') }}">Master Project WBS</a></li>

        <li class="Active"><a href="{{ url('Master/Infrastructure/View-Project-Wbs-Master') }}">Add Project WBS</a></li>

      </ol>

    </section>

    <section class="content">

    <div class="row">

     <!-- <div class="col-sm-1"></div> -->

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Upadte Project WBS</h2>

            <div class="box-tools pull-right">

              <a href="{{url('Master/Infrastructure/update-Project-Wbs-Master')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Project WBS</a>

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
            <form action="{{ url('Master/Infrastructure/update-Project-Wbs-Master') }}" method="POST" >

              @csrf
            <div class="row">

            <div class="col-sm-12">

              <div class="box box-primary Custom-Box">

                <div class="box-body">

                  <div class="table-responsive">

                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblProj_details">

                      <tr>

                        <th>

                          <input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row">

                        </th>

                        <th>Sr.No.</th>

                        <th>Project Code <small style="color:red;font-size:14px;text-align:center;">*</small> </th>

                        
                        <th>WBS Code <small style="color:red;font-size:14px;">*</small></th>

                        <th>WBS Name <small style="color:red;font-size:14px;">*</small></th>
                        
                        <th>WBS Plant Start Date <small style="color:red;font-size:14px;">*</small></th>
                        <th>WBS Plant End Date <small style="color:red;font-size:14px;">*</small></th>
                        <th>WBS Actual Start Date <small style="color:red;font-size:14px;">*</small></th>
                        <th>WBS Actual End Date <small style="color:red;font-size:14px;">*</small></th>
                        <th>WBS Status <small style="color:red;font-size:14px;">*</small></th>
                        <th>WBS Progress <small style="color:red;font-size:14px;">*</small></th>
                       
                        
                      </tr>
                      <?php if($editdata){ ?>

                      <tr class="useful">
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/>
                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <span id='snum'>1.</span>

                          <input type='hidden' name='ProjectInfoDetlSlno' id='ProjectInfoDetlSlno' value='1'>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <input type="hidden" value="{{ $editdata->PROJECTID}}" name="codehidn">

                         
                          <input list='projectcode_list' name='project_code[]' id='project_code1' value='{{$editdata->PROJECT_CODE }} - {{$editdata->PROJECT_NAME}}'  class='' style="margin-bottom:5px;" autocomplete="off" onclick="funProjCode(1)" >
                           <datalist id='projectcode_list'>
                          <?php foreach($project_code as $key) { ?>

                          <option value='<?= $key->PROJECT_CODE ?> - <?= $key->PROJECT_NAME ?>' data-xyz='<?= $key->PROJECT_NAME?>'>{{ $key->PROJECT_CODE   }} = {{ $key->PROJECT_NAME  }}</option>

                          <?php } ?>
                      </datalist>

                          

                          <small id="project_codeErr1"></small>

                        </td>
                        
                        

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type="text" name='wbscode[]' id='wbscode1' class=""  autocomplete="off" style="margin-bottom:5px;"  maxlength="10"value="{{$editdata->WBS_CODE}}"><br>

                          <small id="wbs_codeErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='wbsname[]' id='wbsname1' class="" autocomplete="off" style="margin-bottom:5px;"  maxlength="30" value="{{$editdata->WBS_NAME}}"><br>

                         <small id="wbsnameErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <?php
                             $ps_dt = $editdata->WBS_PLAN_STDATE;
                            if($ps_dt){
                             $pltstdt = date('d-m-Y',strtotime($editdata->WBS_PLAN_STDATE));
                          }else{
                              $pltstdt = '';
                            }
                              ?>
                          
                          <input  type="text" name='wbs_plantst_date' value='{{$pltstdt}}' id='plantstdate1' class="plantst_date" autocomplete="off" style="margin-bottom:5px;" maxlength="10" value="{{$pltstdt}}"><br>

                         <small id="wbsstdateErr1"></small>

                        </td>
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                           
                          <?php
                             $wbss_dt = $editdata->WBS_PLAN_ENDATE;
                            if($wbss_dt){
                             $wbsetdt = date('d-m-Y',strtotime($editdata->WBS_PLAN_ENDATE));
                          }else{
                              $wbsetdt = '';
                            }
                              ?>
                          <input  type="text"  name='wbs_planted_date[]' value='{{ $wbsetdt}}' id='planteddate1' class="planted_date" autocomplete="off" style="margin-bottom:5px;" maxlength="10" value="{{ $wbsetdt}}" ><br>

                         <small id="wbseddateErr1"></small>

                        </td>
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                           <?php
                             $was_dt = $editdata->WBS_PLAN_ENDATE;
                            if($was_dt){
                             $wbscstdt = date('d-m-Y',strtotime($editdata->WBS_PLAN_ENDATE));
                          }else{
                              $wbscstdt = '';
                            }
                              ?>
                          <input  type="text" name='wbs_actual_stdate[]' value='{{ $wbscstdt}}'id='actualstdate1' class="actualst_date" autocomplete="off" style="margin-bottom:5px;" maxlength="10" value="{{ $wbscstdt}}" ><br>

                         <small id="wbsactualstartErr1"></small>

                        </td>
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <?php
                             $wae_dt = $editdata->WBS_PLAN_ENDATE;
                            if($wae_dt){
                             $wbscetdt = date('d-m-Y',strtotime($editdata->WBS_PLAN_ENDATE));
                          }else{
                              $wbscetdt = '';
                            }
                              ?>
                          
                          <input  type="text" name='wbs_actual_eddate[]' velue='{{$wbscetdt}}' id='actualeddate1' class="actualed_date" autocomplete="off" style="margin-bottom:5px;" maxlength="10"  value="{{$wbscetdt }}"><br>

                         <small id="wbsactualendErr1"></small>

                        </td>
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='wbs_status[]' id='wbsstatus1' class="" autocomplete="off" style="margin-bottom:5px;" maxlength="20" value="{{ $editdata->WBS_STATUS}}"><br>

                         <small id="statusErr1"></small>

                        </td>
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='wbs_progress[]' id='wbsprogress1' class="" autocomplete="off" style="margin-bottom:5px;" maxlength="10" value="{{ $editdata->WBS_PROGRESS}}"><br>

                         <small id="progressErr1"></small>

                        </td>
                      </tr>
                      <?php } ?>
                    </table>

              </div>

             <!--  <button type="button" class='btn btn-danger delete' id="deleteFunction"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

              <button type="button" class='btn btn-info addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
 -->
              <div class="text-center col-md-12">
                
                <button type="submit" class="btn btn-success updatebtn" id="AddProjectDetail"><i class="fa fa-floppy-o"></i> Update</button>
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

  $('.plantst_date').datepicker({

    format: 'dd-mm-yyyy',
    orientation: 'bottom',
    todayHighlight: 'true',
    autoclose: 'true'

  });


});

function funProjCode(id){

 $("#project_code"+id).bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#projectcode_list option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

     if(msg == 'No Match'){
      $('#project_code'+id).val('');
     }else{

     }
    })
  }  

$(function(){


  var i=2;

  $(".addmore").on('click',function(){


        count=$('#tblProj_details tr').length;

        countTr = count-1;

        
        var project_code  =  $('#project_code'+countTr).val();

        if(project_code == ''){
          $('#project_codeErr'+countTr).html('Project Code Is Required').css('color','red');
          return false;
        }
        else{
          $('#project_codeErr'+countTr).html('');
        }
        

      
        
        var wbs_code  =  $('#wbscode'+countTr).val();
        if(wbs_code == ''){
          $('#wbs_codeErr'+countTr).html('WBS code Is Required').css('color','red');
          return false;
        }else{
          $('#wbs_codeErr'+countTr).html('');
        }

        var wbs_name  =  $('#wbsname'+countTr).val();
        if(wbs_name == ''){
          $('#wbsnameErr'+countTr).html('WBS NameIs Required').css('color','red');
        return false;

        }else{
        
        $('#wbsnameErr'+countTr).html('');
        }

        var wbs_plantst_date  =  $('#plantstdate'+countTr).val();

        if(wbs_plantst_date == ''){
          $('#wbsstdateErr'+countTr).html('WBS Stdate Is Required').css('color','red');
        return false;

        }else{

          $('#wbsstdateErr'+countTr).html('').css('color','red');
         }
          var wbs_planted_date  =  $('#planteddate'+countTr).val();

        if(wbs_planted_date == ''){
          $('#wbseddateErr'+countTr).html('WBS Etdate Is Required').css('color','red');
        return false;

        }else{

          $('#wbseddateErr'+countTr).html('').css('color','red');
        }
          var wbs_actualst_date  =  $('#actualstdate'+countTr).val();

        if(wbs_actualst_date == ''){
          $('#wbsactualstartErr'+countTr).html('WBS Actual stdate Is Required').css('color','red');
        return false;

        }else{

          $('#wbsactualstartErr'+countTr).html('').css('color','red');
        } 


          var wbs_actualed_date  =  $('#actualeddate'+countTr).val();

        if(wbs_actualed_date == ''){
          $('#wbsactualendErr'+countTr).html('WBS Actual eddate Is Required').css('color','red');
        return false;

        }else{

          $('#wbsactualendErr'+countTr).html('').css('color','red');
        }  
          var wbs_status  =  $('#wbsstatus'+countTr).val();

        if(wbs_status == ''){
          $('#statusErr'+countTr).html('WBS Status Is Required').css('color','red');
        return false;

        }else{

          $('#statusErr'+countTr).html('').css('color','red');

        }  
          var wbs_progress  =  $('#wbsprogress'+countTr).val();

        if(wbs_progress == ''){
          $('#progressErr'+countTr).html('WBS Progress Is Required').css('color','red');
        return false;

        }else{

          $('#progressErr'+countTr).html('').css('color','red');

         var data="<tr><td class='tdthtablebordr' style='padding-top: 23px;'><input type='checkbox' class='case'/></td><td class='tdthtablebordr' style='padding-top: 22px;'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='ProjectInfoDetlSlno' id='ProjectInfoDetlSlno' value='"+count+"'></td>";
        data +="<td class='tdthtablebordr' style='padding-top: 2%;'><input list='projectcode_list' name='project_code[]' id='project_code"+count+"' value='' class='' style='margin-bottom:5px;'' autocomplete='off' onclick='funProjCode("+count+")'><datalist id='projectcode_list'><?php foreach($project_code as $key) { ?><option value='<?= $key->PROJECT_CODE ?> - <?= $key->PROJECT_NAME ?>' data-xyz='<?= $key->PROJECT_NAME?>'>{{ $key->PROJECT_CODE}} = {{ $key->PROJECT_NAME  }}</option> <?php } ?></datalist><small id='project_codeErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='wbscode[]' id='wbscode"+count+"' class=''  autocomplete='off' style='margin-bottom:5px;' ><br><small id='wbscodeErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='wbsname[]' id='wbsname"+count+"' class='' autocomplete='off' style='margin-bottom:5px;'  maxlength='30'><br><small id='wbsnameErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='wbs_plantst_date[]' id='plantstdate"+count+"' class='plantst_dt' autocomplete='off' style='margin-bottom:5px;'><br><small id='wbsstdateErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='wbs_planted_date[]' id='planteddate"+count+"' class='planted_dt' autocomplete='off' style='margin-bottom:5px;'><br><small id='wbseddateErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='wbs_actual_stdate[]' id='actualstdate"+count+"' class='actualst_dt' autocomplete='off' style='margin-bottom:5px;'><br><small id='wbsactualstartErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='wbs_actual_eddate[]' id='actualeddate"+count+"' class='actualed_dt' autocomplete='off' style='margin-bottom:5px;'><br><small id='wbsactualendErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='wbs_status[]' id='wbsstatus"+count+"' class='' autocomplete='off' style='margin-bottom:5px;' maxlength='20'><br><small id='statusErr"+count+"'></small></td><td class='tdthtablebordr'style='padding-top: 2%;'><input  type='text' name='wbs_progress[]' id='wbsprogress"+count+"' class='' autocomplete='off' style='margin-bottom:5px;' maxlength='10'><br><small id='progressErr"+count+"'></small></td></tr>";

        $('#tblProj_details').append(data);

        i++;

        $('.plantst_dt').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

        });

        $('.planted_dt').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

        });

        $('.actualst_dt').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

        });

        $('.actualed_dt').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          autoclose: 'true'

        });
       
       }

    });



});

 $("#AddProjectDetail").on('click',function(){

   
        count=$('#tblProj_details tr').length;

        countTr = count-1;

        
        var project_code  =  $('#project_code'+countTr).val();

        if(project_code == ''){
          $('#project_codeErr'+countTr).html('Project Code Is Required').css('color','red');
          return false;
        }
        else{
          $('#project_codeErr'+countTr).html('');
        }
        

      
        
        var wbs_code  =  $('#wbscode'+countTr).val();
        if(wbs_code == ''){
          $('#wbs_codeErr'+countTr).html('WBS code Is Required').css('color','red');
          return false;
        }else{
          $('#wbs_codeErr'+countTr).html('');
        }

        var wbs_name  =  $('#wbsname'+countTr).val();
        if(wbs_name == ''){
          $('#wbsnameErr'+countTr).html('WBS NameIs Required').css('color','red');
        return false;

        }else{
        
        $('#wbsnameErr'+countTr).html('');
        }

        var wbs_plantst_date  =  $('#plantstdate'+countTr).val();

        if(wbs_plantst_date == ''){
          $('#wbsstdateErr'+countTr).html('WBS Stdate Is Required').css('color','red');
        return false;

        }else{

          $('#wbsstdateErr'+countTr).html('').css('color','red');
         }
          var wbs_planted_date  =  $('#planteddate'+countTr).val();

        if(wbs_planted_date == ''){
          $('#wbseddateErr'+countTr).html('WBS Etdate Is Required').css('color','red');
        return false;

        }else{

          $('#wbseddateErr'+countTr).html('').css('color','red');
        }
          var wbs_actualst_date  =  $('#actualstdate'+countTr).val();

        if(wbs_actualst_date == ''){
          $('#wbsactualstartErr'+countTr).html('WBS Actual stdate Is Required').css('color','red');
        return false;

        }else{

          $('#wbsactualstartErr'+countTr).html('').css('color','red');
        } 


          var wbs_actualed_date  =  $('#actualeddate'+countTr).val();

        if(wbs_actualed_date == ''){
          $('#wbsactualendErr'+countTr).html('WBS Actual eddate Is Required').css('color','red');
        return false;

        }else{

          $('#wbsactualendErr'+countTr).html('').css('color','red');
        }  
          var wbs_status  =  $('#wbsstatus'+countTr).val();

        if(wbs_status == ''){
          $('#statusErr'+countTr).html('WBS Status Is Required').css('color','red');
        return false;

        }else{

          $('#statusErr'+countTr).html('').css('color','red');

        }  
          var wbs_progress  =  $('#wbsprogress'+countTr).val();

        if(wbs_progress == ''){
          $('#progressErr'+countTr).html('WBS Progress Is Required').css('color','red');
        return false;

        }else{

          $('#progressErr'+countTr).html('').css('color','red');
}
});

$(".delete").on('click', function() {
   
   
   $('.case:checkbox:checked').parents('#tblProj_details tr').remove();

    $('.check_all').prop("checked", false); 

    check();

});

function check(){

      obj = $('#tblProj_details tr').find('span');
      
      $.each( obj, function( key, value ) {

          id=value.id;

          $('#'+id).html(key+1);

      });

}

$('#AddProjectDetail').on('click',function(){

  var data         = $('#projectDetailForm').serialize();

  var count        = $('#tblProj_details tr').length;
  var trCount      = count-1;

  console.log('count',count);
  console.log('trCount',trCount);
  for(var q=0;q<trCount;q++){

       var w = q +1;
       console.log('w',w);

       var project_code =  $('#project_code'+w).val();
       var wing_no =  $('#wing_no'+w).val();
       var tower_no =  $('#tower_no'+w).val();
       var floorNo =  $('#floorNo'+w).val();
       var unit =  $('#unit'+w).val();


       if(project_code == ''){
          $('#project_codeErr'+w).html('Project Code Is Required').css('color','red');
          return false;
        }
        else{
          $('#project_codeErr'+w).html('');
        }
        

        var wing_no  =  $('#wing_no'+w).val();

        if(wing_no == ''){
          $('#wing_noErr'+w).html('Wing No Is Required').css('color','red');
          return false;
        }else{
          $('#wing_noErr'+w).html('');
        }
        
        var tower_no  =  $('#tower_no'+w).val();
        if(tower_no == ''){
          $('#tower_noErr'+w).html('Tower No Is Required').css('color','red');
          return false;
        }else{
          $('#tower_noErr'+w).html('');
        }

        var floorNo  =  $('#floorNo'+w).val();
        if(floorNo == ''){
          $('#floorNoErr'+w).html('Floor No Is Required').css('color','red');
        return false;

        }else{
        
        $('#floorNoErr'+w).html('');
        }

        var unit  =  $('#unit'+w).val();

        if(unit == ''){
          $('#unitErr'+w).html('Unit Is Required').css('color','red');
        return false;

        }else{
          $('#unitErr'+w).html('');

          $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

          });

          $.ajax({

               type: 'POST',

               url: "{{ url('/Master/Infrastructure/Save-Project-Detail-Master') }}",
               
               data: data,

               success: function (data) {
               var data1 = JSON.parse(data);
               
               if(data1.response == 'success'){
             
                // location.reload();

                 window.location.href = "{{ url('/Master/Infrastructure/View-Project-Detail-Master')}}";

               
               }else{

               }

              }
          });

        }

  }

  // console.log('data',data);

})

$(document).ready(function(){



 $('#planteddate1').datepicker({
  format: 'dd-mm-yyyy',
  orientation: 'bottom',
  todayHighlight: 'true',
  autoclose: 'true'

});
 $('#actualstdate1').datepicker({
  format: 'dd-mm-yyyy',
  orientation: 'bottom',
  todayHighlight: 'true',
  autoclose: 'true'

});

 $('#actualeddate1').datepicker({
  format: 'dd-mm-yyyy',
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