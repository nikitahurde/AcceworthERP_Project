@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')



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

    /*border: 1px solid #e0dcdc;

    border-radius: 10px;

*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }
  .showinmobile{
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
            Master Manufacturing

          <small>Update Details</small>
          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>
            <li><a href="{{ URL('/edit-manufature/'.base64_encode($edit_manufactur->MFG_CODE))}}">Vehicle Mfg</a></li>

            <li class="active">
              <a href="{{ URL('/edit-manufature/'.base64_encode($edit_manufactur->MFG_CODE))}}" >Update Vehicle Mfg </a>
            </li>

          </ol>

        </section>

	<section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master Manufacturing</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-manufature') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Manufacturing</a>

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

            <form action="{{ url('manufature-update') }}" method="POST" >

               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Vehicle Mfg Code : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="hidden" name="MfgID" value="{{ $edit_manufactur->MFG_CODE }}">

                          <input type="text" class="form-control" name="vehicle_mfg_code" value="{{ $edit_manufactur->MFG_CODE }}" placeholder="Enter Vehicle Mfg Code" maxlength="12" <?php if($btnControl=='disabled') {?> readonly <?php } ?>>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vehicle_mfg_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Vehicle Mfg Name: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="vehicle_mfg_name" value="{{ $edit_manufactur->MFG_NAME }}" placeholder="Enter Vehicle Mfg Name" maxlength="15">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('vehicle_mfg_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

              </div>

              <div class="row">
                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Block Vehicle Mfg: 

                        <span class="required-field"></span>

                      </label>

                     
                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="mfg_block" value="YES" <?php if($edit_manufactur->BLOCK_VEHICLEMFG=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="mfg_block" value="NO" <?php if($edit_manufactur->BLOCK_VEHICLEMFG=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                  </div>
                
              </div>

              <!-- /.row -->





              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <div class="col-sm-3 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/view-manufature') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Manufacturing</a>

        </div>

      </div>



    </div>

     

	</section>

</div>







@include('admin.include.footer')





<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js

">

</script>

<script type="text/javascript">

  

  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'yyyy/mm/dd',

      orientation: 'bottom',

      todayHighlight: 'true',

     // startDate: 'today',

    });

});

</script>

@endsection