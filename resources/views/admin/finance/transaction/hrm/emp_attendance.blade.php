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

  .ui-datepicker-calendar { display: none; }


}

</style>



<div class="content-wrapper">


        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>

            Employee Attendance

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

            <li class="Active"><a href="{{ URL('/finance/cost-category')}}">Master Employee Attendance</a></li>



            <li class="Active"><a href="{{ URL('/finance/cost-category')}}">Add Attendance</a></li>


            <?php } else { ?>

           <li class="Active"><a href="#">Master Employee Attendance</a></li>



           <li class="Active"><a href="#">Update Attendance</a></li>



           <?php } ?>
          
          </ol>

        </section>
<section class="content">

   

    <div class="row">

     <div class="col-sm-1"></div>
      
      <div class="col-sm-8">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <?php if($button=='Save') { ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Attendance</h2>
              
               <?php } else{  ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Attendance</h2>

            <?php } ?>

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

            <form action="{{ url($action) }}" method="POST" >


              @csrf
                <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                       <label>Month : 

                        <span class="required-field"></span>

                       </label>

                       <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
 
                        <input type="text" class="form-control  rightcontent <?php if($button=='Save') { ?> atteYearMonth  <?php } ?>" name="attend_year" value="{{$attend_year}}" placeholder="Year" onchange="funAttenYr()" id="attend_monthYr" <?php if($button=='Update') { ?> readonly  <?php } ?> autocomplete="off">

                        <?php if($button=='Save') { ?>

                         

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>

                        <?php } ?>



                        </div>

                          <small id="emailHelp" class="form-text text-muted">


                          {!! $errors->first('attend_year', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                          <small id="attendMonErr"></small>



                    </div>

                  </div>

                  <div class="col-md-4">

                                <div class="form-group">

                                  <label for="exampleInputEmail1">Emp. Code : <span class="required-field"></span></label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                                        <input list="emp_code_list"  id="empcode" name="empcode" class="form-control  pull-left" value="{{$empcode}}" placeholder="Emp Code" autocomplete="off" readonly>

                                      <datalist id="emp_code_list">
                                      
                                         <option value="">--SELECT--</option>

                                         @foreach($emp_list as $rows)

                                          <option value="{{ $rows->EMP_CODE }}" data-xyz ="{{ $rows->EMP_NAME }}">{{ $rows->EMP_CODE }} = {{ $rows->EMP_NAME }}</option>
                                         

                                         @endforeach

                                      </datalist>

                                    </div>
                                    <div class="pull-left showSeletedName" id="codeText"></div>

                                  <small id="emailHelp" class="form-text text-muted">

                                        {!! $errors->first('empcode', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>

                                  <small id="empCodeErr"></small>

                              </div>

                   </div>

                   <div class="col-md-4">

                                <div class="form-group">

                                  <label for="exampleInputEmail1">Emp. Name : <span class="required-field"></span></label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                                        <input id="empname" name="empname" class="form-control  pull-left" value="{{$empname}}" placeholder="Emp Name" readonly>

                                      

                                    </div>
                                    <div class="pull-left showSeletedName" id="codeText"></div>

                              </div>
                              <small id="emailHelp" class="form-text text-muted">

                                        {!! $errors->first('empname', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>

                   </div>

                   
                    



              </div>

              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                      <label for="exampleInputEmail1">MM Days: <span class="required-field"></span></label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>

                            <input id="mm_days" name="mm_days"  id="mm_days" class="form-control  pull-left" value="{{ $mm_days}}" placeholder="Month Days" readonly>

                          

                        </div>
                        <div class="pull-left showSeletedName" id="codeText"></div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('mm_days', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="attend_yrMonth"></small>

                  </div>

                </div>

                <div class="col-md-4">

                 <div class="form-group">
                  <label> Holidays :

                   <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="text" class="form-control" name="holidays"  id="holidays" value="{{$holidays}}" placeholder="Holidays" id="holidays" readonly>
                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                 {!! $errors->first('holidays', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>
                </div>

                </div>

                <div class="col-md-4">

                 <div class="form-group">
                  <label> Leave :

                   <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="text" class="form-control" name="leave" id="leave" value="{{$leave}}" placeholder="Leave" oninput="funleave()" autocomplete="off">
                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                 {!! $errors->first('leave', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                 

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-4">

                   <div class="form-group">

                    <label> Absent Days :

                     <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control" name="absent_days" id="absent_days" value="{{$absent_days}}" placeholder="Absent Days" oninput="funAbsentDay()" autocomplete="off">
                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                   {!! $errors->first('absent_days', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                  </div>

                  </div>

                  <div class="col-md-4">

                     <div class="form-group">

                      <label> Working Days :

                       <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                            <input type="text" class="form-control" id="working_days" name="working_days" value="{{$working_days}}" placeholder="Working Days" readonly>
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                     {!! $errors->first('working_days', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      </div>

                    </div>

                    <div class="col-md-4">

                     <div class="form-group">

                      <label> Present Days :

                       <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                            <input type="text" class="form-control" id="present_days" name="present_days" value="{{$present_days}}" placeholder="Present Days" readonly>
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                     {!! $errors->first('present_days', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>
                  <div class="row" style="">
                
                 <small id="leaveErr" style=""></small>
              </div>
              </div>
              


              <?php if($button=='Update') { ?>

                <div class="row">

                  <div class="col-md-6">

                   <div class="form-group">

                   <label>Leave Block : <span class="required-field"></span></label>

                      <div class="input-group">

                        <input type="radio" class="optionsRadios1" name="attendance_block" value="1" <?php if($attendance_block=='1'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                        <input type="radio" class="optionsRadios1" name="attendance_block" value="0" <?php if($attendance_block=='0'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                      </div>


                      <small id="emailHelp" class="form-text text-muted">


                       {!! $errors->first('leave_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>

                  </div>

              </div>



              <?php } ?>
              <?php if($button != 'Update'){$btnMode = 'disabled';}else{$btnMode = '';}?>

              <div style="text-align: center;">

                <button type="Submit" class="btn btn-primary" {{$btnMode}} id="saveAttend">

                   <input type="hidden" name="idAttend" value="{{$id}}">

                   <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 

                </button>

              </div>

            </form>

           </div><!-- /.box-body -->
          </div>
        </div>

      <div class="col-sm-3">
        <div class="box-tools pull-right">
          <a href="{{ url('/Transaction/Attendance/view-emp-attendance-transaction') }}" class="btn btn-primary" style="margin-bottom: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Attendance</a>

        </div> 
      </div>

      <script type="text/javascript">
    $(document).ready(function(){
    
    var currentDate = new Date();
    // $(function() {
    //   $('.atteYearMonth').datepicker({
    //     format: 'MM yyyy',
    //     viewMode: "months", 
    //     minViewMode: "months",
    //     todayHighlight: true,
    //     autoclose:true,
    //     startDate :currentDate,
    //     maxDate: currentDate,
    //     minView: "year"
    //  });
    // });

    $(function() {
      $('.atteYearMonth').datepicker({
        format: 'MM yyyy',
        viewMode: "months", 
        minViewMode: "months",
        todayHighlight: true,
        autoclose:true,
        maxDate: currentDate,
        minView: "year"
     });
    });
 


    $("#empcode").bind('change', function () {  

          var val = $(this).val();
          
          var xyz = $('#emp_code_list option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
           
          if(msg == 'No Match'){
              $(this).val('');
              $('#empname').val('');
              $('#leave').val('');
          }else{
            $('#empname').val(msg);
            $('#leave').val('');

            var emp_code = $('#empcode').val();
            
            var attend_monthYr = $('#attend_monthYr').val();
            
          }

           $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
          });

          $.ajax({

            type: 'POST',

            url: "{{ url('/Transaction/Attendance/CheckLeaveApplication') }}",

            data: {emp_code:emp_code,attend_monthYr:attend_monthYr}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var obj = JSON.parse(data);

              if (obj.response == 'error') {
                

              }else if (obj.response == 'success') {

                   console.log('Leave',obj.data);
                   
                   $('#leave').val(obj.data);

                   }
                

            },

        });


      });



});

function funAttenYr(button){

  var attend_monthYr = $('#attend_monthYr').val();
  $('#attend_monthYr').attr('readonly',true);
  // $('input').removeClass('atteYearMonth');
  $('.atteYearMonth').datepicker("destroy");
  

  
  $(document).ready(function(){
    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

    $.ajax({

            type: 'POST',

            url: "{{ url('/Transaction/Attendance/Check-PayMonth') }}",

            data: {attend_monthYr:attend_monthYr}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var obj = JSON.parse(data);

               if (obj.response == 'success') {

                   $('#mm_days').val(obj.data.MONTH_DAYS);
                   $('#holidays').val(obj.data.HOLIDAYS);

                   var attendYr = obj.data;
                   if(attendYr){
                    $('#attendMonErr').html('');
                    $('#saveAttend').prop('disabled', false);
                    $('#empcode').attr('readonly', false);

                   }
                   }
                else{
                  
                  $('#attendMonErr').html("<p style='color:red'>*Please Create Pay-Calender First.</p>");
                  $('#mm_days').val('');
                  $('#holidays').val('');
                  $('#saveAttend').prop('disabled', true);
                  $('#empcode').attr('readonly', true);
                }

            },

        });
  })
}


function funleave(){
 
 var leave = $('#leave').val();
 
 if(leave != ''){
  $('#leaveErr').html("");
 }
 else{
  $('#leaveErr').html("<p style='color:red'>Enter Leave.</p>");
 }
}

function funAbsentDay(){
 var attend_year = $('#attend_year').val();
 var absent_days = $('#absent_days').val();
 var leave = $('#leave').val();
 
 if(leave == '' || attend_year == '' ){
 
  $('#leaveErr').html("<p style='color:red;padding-left: 31px;font-size: 15px'>Enter All Field.</p>");
 }else{
  var mm_days = $('#mm_days').val();
  
  var holidays = $('#holidays').val();
  
  var leave    = $('#leave').val();
  
  var workingDay = parseFloat(mm_days) - parseFloat(holidays) - parseFloat(leave) - parseFloat(absent_days);
  $('#working_days').val(workingDay);

  

  var presentDay = parseFloat(workingDay) + parseFloat(holidays) + parseFloat(leave);
  $('#present_days').val(presentDay);

  if(absent_days == ''){
    $('#working_days').val('');
    $('#present_days').val('');
  }


 }

}
</script>

</section>

</div>

@include('admin.include.footer')

@endsection