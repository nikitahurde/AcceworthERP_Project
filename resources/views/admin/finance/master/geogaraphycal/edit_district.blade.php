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

</style>



<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">



          <h1>



            Master District



            <small>: Update Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/master/geogaraphycal/district-master')}}">Geographical  </a></li>



            <li class="Active"><a href="{{ URL('/master/geogaraphycal/district-master')}}">Update District </a></li>



          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update District</h2>

               <div class="box-tools pull-right">

                <a href="{{ url('/master/geogaraphycal/view-district-master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View District</a>

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


              <form action="{{ url('/master/geogaraphycal/district-master-update') }}" method="POST" id="CountryForm">

                @csrf

                  <div class="row">

                    <div class="col-lg-12">

                      <div class="row">

                        <div class="col-sm-3">
                          
                          <div class="form-group">

                            <label>

                             District Name : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                                <input type="text" class="form-control" name="district_name" id="districtName" value="{{$district_list->DISTRICT_NAME}}" placeholder="Enter District Name" maxlength="20" autocomplete="off">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('district_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                        <div class="col-sm-3">
                          
                          <div class="form-group">

                            <label>

                             District Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="district_code" id="districtCode" value="{{$district_list->DISTRICT_CODE}}" placeholder="Enter District Code" readonly maxlength="6" autocomplete="off">

                                <input type="hidden" name="districtId" value="{{$district_list->ID}}">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('district_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>


                        <div class="col-sm-3">
                          
                          <div class="form-group">

                            <label>

                             State Code : 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input list="stateList" class="form-control" name="state_code" id="stateCode" value="{{$district_list->STATE_CODE}}" placeholder="Enter State Code" maxlength="6" autocomplete="off">

                                <datalist id="stateList">

                                  <option selected="selected" value="">-- Select --</option>

                                  @foreach ($state_list as $key)

                                  <option value='<?php echo $key->STATE_CODE; ?>' data-xyz ="<?php echo $key->STATE_NAME; ?>"><?php echo $key->STATE_NAME ; echo " [".$key->STATE_CODE."]" ; ?></option>

                                  @endforeach

                                </datalist>

                                <input type="hidden" id="state_name" name="state_name" value="{{$district_list->STATE_NAME}}">

                            </div> 

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('state_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                        </div>

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>

                              Block District: 

                              <span class="required-field"></span>

                            </label>

                           
                            <div class="input-group">

                                <input type="radio" class="optionsRadios1" name="district_block" value="YES"<?php if($district_list->DISTRICT_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                <input type="radio" class="optionsRadios1" name="district_block" value="NO"<?php if($district_list->DISTRICT_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                            

                          </div>

                        </div>


                      </div>


                      
                    </div>

                  </div>

                  <div style="text-align: center;">
                
                     <button type="Submit" class="btn btn-primary">

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

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

$(document).ready(function(){

    $("#stateCode").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#stateList option').filter(function() {
      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

      $('#state_name').val('');

    }else{

      $('#state_name').val(msg);

    }

    });

});

</script>









@endsection