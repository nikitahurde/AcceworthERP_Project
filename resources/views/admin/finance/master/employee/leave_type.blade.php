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

    Master Employee Leave Type

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

    <li class="Active"><a href="{{ URL('/finance/cost-category')}}">Master Employee Leave Type</a></li>



    <li class="Active"><a href="{{ URL('/finance/cost-category')}}">Add Leave Type</a></li>


    <?php } else { ?>

   <li class="Active"><a href="#">Master Employee Leave Type</a></li>



   <li class="Active"><a href="#">Update Leave Type</a></li>



   <?php } ?>
  
  </ol>

</section>

<section class="content">

    <div class="row">

     <div class="col-sm-2"></div>

      <div class="col-sm-6">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <?php if($button=='Save') { ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Leave Type</h2>
              
               <?php } else{  ?>

               <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Leave Type</h2>

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

                  <div class="col-md-5">

                    <div class="form-group">

                       <label>Leave Code : 

                        <span class="required-field"></span>

                       </label>

                       <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input type="text" class="form-control codeCapital" name="leave_code" value="{{ $leave_code }}" placeholder="Leave Code" maxlength="12" id="leaveCode" <?php if($button=='Update') { ?> readonly <?php } ?> autocomple="off">

                        <?php if($button=='Save') { ?>

                         

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>

                        <?php } ?>



                        </div>

                          <small id="emailHelp" class="form-text text-muted">


                          {!! $errors->first('leave_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                  </div>

                  <div class="col-md-7">
                   <div class="form-group">
                    <label> Leave Name :

                     <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="leave_name" value="{{$leave_name}}" placeholder="Leave Name" autocomple="off">
                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                   {!! $errors->first('leave_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>



                    </div>
                </div>
             </div>



            <?php if($button=='Update') { ?>



              <div class="row">

                <div class="col-md-6">

                  <div class="form-group">

                      <label>Leave Block : <span class="required-field"></span></label>

                        <div class="input-group">

                         <input type="radio" class="optionsRadios1" name="leave_block" value="YES" <?php if($leave_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="leave_block" value="NO" <?php if($leave_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                        </div>

                          <small id="emailHelp" class="form-text text-muted">
                           
                           {!! $errors->first('leave_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                        </div>

                      </div>
                      </div>

          <?php } ?>
              <div style="text-align: center;">

                <button type="Submit" class="btn btn-primary">



                  <input type="hidden" name="idleavecode" value="{{$leave_code}}">



                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 
                
                </button>
              
              </div>

            </form>

         </div><!-- /.box-body -->

        </div>

     </div>


      <div class="col-sm-4">
       
       <div class="box-tools pull-right">

        <a href="{{ url('/Master/Employee/View-Emp-leaveType-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Leave Type</a>

       </div>

      </div>

  </div>


</section>


</div>


@include('admin.include.footer')


@endsection