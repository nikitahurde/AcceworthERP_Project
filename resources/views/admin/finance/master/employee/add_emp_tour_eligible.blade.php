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

      <h1>Master Employee Tour Eligible

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

       <li class="Active"><a href="{{ URL('/Master/Employee/Emp-Tour-Eligible-Mast')}}">Master Emp Tour Eligible</a></li>

       <li class="Active"><a href="{{ URL('/Master/Employee/Emp-Tour-Eligible-Mast')}}">Add Emp Tour Eligible</a></li>

       <?php } else { ?>

       <li class="Active"><a href="#">Master Employee Tour Eligible</a></li>

       <li class="Active"><a href="#">Update Employee Tour Eligible</a></li>

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

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Employee Tour Eligible</h2>
              
               <?php } else{  ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Employee Tour Eligible</h2>

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

                       <label>Grade : 

                        <span class="required-field"></span>

                       </label>

                       <div class="input-group">

                          <div class="input-group-addon">

                                <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="grade_list"  id="grade_id" name="grade" class="form-control  pull-left " value="{{ $grade }}" placeholder="Select Grade"  autocomplete="off" <?php if($button=='Update') { ?> readonly <?php } ?>>

                          <?php if($button=='Save') { ?>

                            <datalist id="grade_list">

                              <?php foreach($gradeList as $key) { ?>
                              <option value="{{ $key->GRADE_CODE  }}" data-xyz ='<?php echo $key->GRADE_NAME; ?>'>{{ $key->GRADE_CODE  }} ({{ $key->GRADE_NAME }})
                              </option>

                              <?php } ?>
                                
                            </datalist>
                          <?php } ?>

                      </div>

                      <div class="pull-left showSeletedName" id="gradeText"></div>

                      <small id="emailHelp" class="form-text text-muted">


                       {!! $errors->first('grade', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                       <label>Grade Name: 

                        <span class="required-field"></span>

                       </label>

                       <div class="input-group">

                          <div class="input-group-addon">

                                <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="grade_name" name="grade_name" class="form-control  pull-left " value="{{ $gradeName }}" placeholder="Grade Name"  autocomplete="off" readonly>
                      </div>

                      <small id="emailHelp" class="form-text text-muted">


                       {!! $errors->first('grade_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>

                  <div class="col-md-4">

                   <div class="form-group">

                    <label> City Code :

                     <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>

                      <input list="city_list"  id="city_id" name="city_code" class="form-control  pull-left" value="{{ $city_code}}" placeholder="Select City Class" autocomplete="off" >

                      <datalist id="city_list">
                      
                         <option value="">--SELECT--</option>

                         @foreach($city_list as $row)

                          <option value="{{ $row->CITY_CODE }}" data-xyz ="{{ $row->CITY_CLASS }}">{{ $row->CITY_CODE }} = {{ $row->CITY_CLASS }}</option>

                         @endforeach

                      </datalist>

                     <!--  <input type="hidden" id="city_class" name="city_class" value="{{ $city_class}}"> -->

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('city_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

				         </div>
            </div>
            
            <div class="row">

              <div class="col-md-4">

                   <div class="form-group">

                    <label> City Class

                     <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>

                      <input type="text" id="city_name" name="city_name" class="form-control  pull-left" value="{{ $city_class}}" placeholder="City Name" readonly="">
                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('city_class', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>

                 </div>

            	<div class="col-md-4">

                <div class="form-group">

                  <label> Expenditure Head :

                    <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                    <input type="text" class="form-control" name="expenditure_head" value="{{ $expenditure_head }}" placeholder="Expenditure Head" autocomplete="off">

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                     {!! $errors->first('expenditure_head', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

				        </div>

				     </div>

             <div class="col-md-4">

                <div class="form-group">

                  <label> Eligible Amount :

                    <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                    <input type="text" class="Number form-control" name="eligible_amt" value="{{ $eligible_amt }}" placeholder="Eligible Amount" autocomplete="off">

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                     {!! $errors->first('eligible_amt', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div>

             </div>

             <?php if($button=='Update') { ?>

             <div class="col-md-6">

              <label> Tour Eligible Block :</label>

              <div class="input-group">

                <input type="radio" class="form-check-input" name="tourElig_block" value="YES" <?php if($tourElig_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;<label class="form-check-label" for="radio1">YES</label>&nbsp;&nbsp;&nbsp;


                <input type="radio" class="form-check-input" name="tourElig_block" value="NO" <?php if($tourElig_block=='NO'){ echo 'checked';} else{ echo '';} ?> >&nbsp;&nbsp;&nbsp;<label class="form-check-label" for="radio1">NO</label>

              </div>

             </div>

            <?php } ?>

				
          </div>

          <div style="text-align: center;margin-top:10px;">

            <button type="Submit" class="btn btn-primary">

            <?php if($button=='Update') { ?>
                
            <input type="hidden" name="tourElig_Id" value="{{$tourEligId}}">

            <?php } ?>

            <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 

            </button>

          </div>

          </form>

      </div><!-- /.box-body -->

    </div>

    </div>

    <div class="col-sm-3">

      <div class="box-tools pull-right">

       <a href="{{ url('/Master/Employee/View-Emp-Tour-Eligible-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Tour Eligible</a>
      
      </div>

   </div>

   </div>

</section>

</div>

@include('admin.include.footer')



<script type="text/javascript">

$(document).ready(function(){
  $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
   
});

});

$("#grade_id").bind('change', function () {  

  var val = $(this).val();

  var xyz = $('#grade_list option').filter(function() {

  return this.value == val;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg == 'No Match'){

    $('#grade_id').val('');
    $('#grade_name').val('');
      
  }else{
    $('#grade_name').val(msg);
  }

});

$("#city_id").bind('change', function () {  

  var val = $(this).val();

  $('#city_class').val('');

  var xyz = $('#city_list option').filter(function() {

  return this.value == val;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  $('#city_class').val(msg);

  if(msg == 'No Match'){

    $('#city_id').val('');
   $('#city_name').val('');
      
  }else{
    $('#city_name').val(msg);
  }

}); 
</script>


@endsection