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


        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>

            Master Employee Leave Quota

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

            <li class="Active"><a href="{{ URL('/finance/cost-category')}}">Master Employee Leave Quota</a></li>



            <li class="Active"><a href="{{ URL('/finance/cost-category')}}">Add Leave Quota</a></li>


            <?php } else { ?>

           <li class="Active"><a href="#">Master Employee Leave Quota</a></li>



           <li class="Active"><a href="#">Update Leave Quota</a></li>



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

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Leave Quota</h2>
              
               <?php } else{  ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Leave Quota</h2>

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

                       <label>Year : 

                        <span class="required-field"></span>

                       </label>

                       <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="text" class="form-control leaveYeardatepicker rightcontent" name="leave_year" value="{{ $leave_year }}" placeholder="Leave Year" autocomplete="off" id="leaveYear" <?php if($button=='Update') { ?> readonly <?php } ?>>

                        <?php if($button=='Save') { ?>

                         

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>

                        <?php } ?>



                        </div>

                          <small id="emailHelp" class="form-text text-muted">


                          {!! $errors->first('leave_year', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                  </div>

                  <div class="col-md-4">

                                <div class="form-group">

                                  <label for="exampleInputEmail1">Employee Code : <span class="required-field"></span></label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                        <input list="emp_code_list"  id="empcode" name="empcode" class="form-control  pull-left" value="{{$empcode}}" placeholder="Select Employee Code" autocomplete="off">

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

                              </div>

                   </div>

                   <div class="col-md-4">

                      <div class="form-group">

                        <label for="exampleInputEmail1">Employee Name : <span class="required-field"></span></label>

                          <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                              <input   id="empname" name="empname" class="form-control  pull-left" value="{{ $empname }}" placeholder="Employee Name" readonly>

                           

                          </div>
                          

                        
                    </div>

                   </div>

              </div>

              <div class="row">

                 <div class="col-md-4">

                      <div class="form-group">

                        <label for="exampleInputEmail1">Leave Type : <span class="required-field"></span></label>

                          <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                              <input list="leave_type_list"  id="leave_type" name="leave_type" class="form-control  pull-left" value="{{ $leave_type}}" placeholder="Select Employee Leave Type" autocomplete="off">

                            <datalist id="leave_type_list">
                            
                               <option value="">--SELECT--</option>

                               @foreach($emp_leavetype as $rows)

                                <option value="{{ $rows->LEAVE_CODE }}" data-xyz ="{{ $rows->LEAVE_NAME }}">{{ $rows->LEAVE_CODE }} = {{ $rows->LEAVE_NAME }}</option>

                               @endforeach

                            </datalist>

                          </div>
                          <div class="pull-left showSeletedName" id="codeText"></div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('leave_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                   </div>

                   <div class="col-md-4">

                      <div class="form-group">

                        <label for="exampleInputEmail1">Leave Name : <span class="required-field"></span></label>

                          <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                              <input id="leave_name" name="leave_name" class="form-control  pull-left" value="{{ $leave_name}}" placeholder="Leave Name" readonly>

                            

                          </div>
                          <div class="pull-left showSeletedName" id="codeText"></div>

                    </div>

                   </div>

                 <div class="col-md-4">
                   <div class="form-group">
                    <label> Opening :

                     <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="number" class="form-control" name="leave_opening" value="{{$leave_opening}}" placeholder="Leave Opening" autocomplete="off">
                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                   {!! $errors->first('leave_opening', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>



                    </div>

                  </div>

                 

                  

              </div>

              <div class="row">

                <div class="col-md-4">
                   <div class="form-group">
                    <label> Addition :

                     <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="number" class="form-control" name="leave_addition" value="{{$leave_addition}}" placeholder="Leave Addition" autocomplete="off">
                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                   {!! $errors->first('leave_addition', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>



                    </div>

                  </div>

                <div class="col-md-4">
                   <div class="form-group">
                    <label> Deduction :

                     <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="number" class="form-control" name="leave_deduction" value="{{$leave_deduction}}" placeholder="Leave Deduction" autocomplete="off">
                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                   {!! $errors->first('leave_deduction', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>



                    </div>

                  </div>
                
                <div class="col-md-4">
                   <div class="form-group">
                    <label> Balance :

                     <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="number" class="form-control" name="leave_balance" value="{{$leave_balance}}" placeholder="Leave Balance" autocomplete="off">
                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                   {!! $errors->first('leave_balance', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>



                    </div>

                  </div>
              </div>



            <?php if($button=='Update') { ?>



              <div class="row">


                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Leave Quota Block : <span class="required-field"></span></label>
                       <div class="input-group">

                        <input type="radio" class="optionsRadios1" name="leaveQuata_block" value="YES" <?php if($leavequota_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                        <input type="radio" class="optionsRadios1" name="leaveQuata_block" value="NO" <?php if($leavequota_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                       </div>

                       <small id="emailHelp" class="form-text text-muted">
                        {!! $errors->first('leave_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                       </small>


                     </div>

                   </div>







                </div>



<?php } ?>
              <div style="text-align: center;">




                  <?php if($button=='Update') { ?>
                 <input type="hidden" value="{{$leaveId}}" id="leaveId" name="leaveId">
                 <?php } ?>


                 <button type="Submit" class="btn btn-primary">



                



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 







                 </button>







              </div>







            </form>







          </div><!-- /.box-body -->

       </div>







      </div>
      <div class="col-sm-3">

        <div class="box-tools pull-right">


         <a href="{{ url('/Master/Employee/View-Emp-leave-Quota-Mast') }}" class="btn btn-primary" style="margin-bottom: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Leave Quota</a>

    </div>

  </div> 

</div>

<script type="text/javascript">
  $(document).ready(function(){
    $('.leaveYeardatepicker').datepicker({
      format: "MM yy",
      viewMode: "months", 
      minViewMode: "months",
      autoclose:true //to close picker once year is selected

     });


    $("#empcode").bind('change', function () {  

          var val = $(this).val();
          var xyz = $('#emp_code_list option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
            console.log('msg',msg);
          if(msg == 'No Match'){
              $(this).val('');
               $('#empname').val('');
          }else{
            $('#empname').val(msg);
          }


      });

     $("#leave_type").bind('change', function () {  

          var val = $(this).val();
          console.log('val',val);
          var xyz = $('#leave_type_list option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
            console.log('msg',msg);
          if(msg == 'No Match'){
              $(this).val('');
               $('#leave_name').val('');
          }else{
            $('#leave_name').val(msg);
          }


      });
});
</script>


  </section>







</div>



@include('admin.include.footer')

@endsection