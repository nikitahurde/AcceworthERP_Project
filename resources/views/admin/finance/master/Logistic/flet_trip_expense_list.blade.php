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

.headBox{

    width: 80px !important;

  }

.showSeletedName {
    color: #3c8dbc;
    font-size:90%;
    font-weight: 800;
    padding:10px 0px 10px 2px;
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

            Master Fleet Trip Expense

            <small>Update Details</small>

          </h1>

         <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/edit-flet-truck-wheel/'.base64_encode($trip_exp[0]->KM))}}">Master Trip Expense </a></li>

            <li class="Active"><a href="{{ URL('/edit-flet-truck-wheel/'.base64_encode($trip_exp[0]->KM))}}">Update Trip Expense </a></li>

          </ol>

        </section>

 <form action="{{ url('fleet-trip-expense-update') }}" method="POST" >

         @csrf
	<section class="content">

    <div class="row">

      <div class="col-sm-2"></div>

      <div class="col-sm-7">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Master Trip Expense</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-flet-truck-wheel') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Trip Expense</a>

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

           

               <div class="row">

                


                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                      KM: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="km" value="{{ $trip_exp[0]->KM }}" placeholder="Enter Km" readonly="">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('km', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Block Trip Expense: 

                        <span class="required-field"></span>

                      </label>

                     
                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="truck_block" value="YES" <?php if($trip_exp[0]->BLOCK_TRIPEXP=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="truck_block" value="NO" <?php if($trip_exp[0]->BLOCK_TRIPEXP=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('country', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>

                  </div>
                  

              </div>

              
              <!-- /.row -->





              <!-- <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>

              </div> -->

            

          </div><!-- /.box-body -->

           

          </div>

      </div>

      
       <div class="col-sm-3 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/view-fleet-trip-expense') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fleet Trip Expense</a>

        </div>

      </div>


    </div>

     
	</section>

   <section class="content" style="margin-top: -84px !important;">

    <div class="row">

      <div class="col-sm-1"></div>

      <div class="col-sm-10">

        <div class="box box-warning Custom-Box">

            <div class="box-header with-border">

            <div class="box-body">

              <?php $count = count($trip_exp); for ($i=0; $i < $count; $i++) { ?>

               <div class="row">


                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                       HEAD

                        <span class="required-field"></span>

                      </label>

                      <!-- < ?php echo '<pre>'; print_r($trip_exp); ?> -->

                      


                      
                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input type="hidden" name="id[]" value="{{ $trip_exp[$i]->FLEETEXPID  }}">

                          <input list="indList<?= $i ?>" class="form-control headBox" name="indicator[]" id="indicator<?= $i ?>"  placeholder="Enter  Indicator"  oninput="this.value = this.value.toUpperCase()" onchange="indChange(<?= $i ?>)" value="{{ $trip_exp[$i]->FLEETIND_CODE }}">

                          <datalist id="indList<?= $i ?>">

                            <option value="JALPANI" data-xyz="L01">L01 = JALPANI</option>
                            <option value="FOODING" data-xyz="L02">L02 =FOODING</option>
                            <option value="U/L" data-xyz="L03">L03 = U/L</option>
                            <option value="ADMIN" data-xyz="L04"> L04 = ADMIN</option>
                            <option value="DIESEL" data-xyz="L05">L05 = DIESEL</option>
                            <option value="OVERLOAD ALLOWANCE" data-xyz="L06">L06 = OVERLOAD ALLOWANCE</option>
                            <option value="HOLTING" data-xyz="L07">L07 = HOLTING</option>
                            <option value="TOLL" data-xyz="L08">L08 = TOLL</option>
                            <option value="FOOD & SAVING" data-xyz="L09">L09 = FOOD & SAVING</option>
                            <option value="OVERLOAD" data-xyz="L10">L10 = OVERLOAD</option>
                            <option value="DELIVERY CHARGE" data-xyz="L11">L11 DELIVERY CHARGE</option>
                            <option value="SALARY" data-xyz="L12">L12 = SALARY</option>
                            <option value="ADD" data-xyz="L13">L13 = ADD</option>
                            <option value="DEDUCTION" data-xyz="L14">L14 = DEDUCTION</option>
                            <option value="UPLOADING / LOADING" data-xyz="L15">L15 = UPLOADING / LOADING</option>
                            <option value="OTHER" data-xyz="L16"> L16 = OTHER</option>
                           
                          </datalist>

                          <input type="hidden" id="indicatorName<?= $i ?>" name="indicator_name[]" value="{{ $trip_exp[$i]->FLEETIND }}">

                           <div class="pull-left showSeletedName" id="plantText<?= $i ?>" >{{ $trip_exp[$i]->FLEETIND }}</div>

                        </div>
                         <small id="indicatorerr" style="color:red;"></small>
                          <br>
                      
                                 

                         <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                          
                            </div>  
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('truck_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       INDEX 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="indexList<?= $i ?>" class="form-control  rdate" name="index[]" id="index<?= $i ?>"   placeholder="Enter Index" value="{{ $trip_exp[$i]->FLEETINDEX }}"/>

                              <datalist id="indexList<?= $i ?>">
                            
                               <option value="L" >L</option>
                               <option value="R">R</option>

                              </datalist>



                      </div>
                      <small id="indexerr" style="color:red;"></small>
                      <br>

                   

                       

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       RATE 

                        <span class="required-field"></span>

                      </label>

                     

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-money"></i></span>

                          <input type="text" class="form-control  rdate" name="rate[]"  placeholder="Enter Rate" id="rate<?= $i ?>" value="{{ $trip_exp[$i]->RATE }}"/>


                      </div>

                       <small id="rateerr" style="color:red;"></small>
                      <br>

                       

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                   <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       GL CODE

                        <span class="required-field"></span>

                      </label>


                       
                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="glCodeList<?= $i ?>" class="form-control  rdate" name="gl_code[]"  value="{{ $trip_exp[$i]->GL_CODE }}" id="gl_code<?= $i ?>" placeholder="Enter Gl Code" maxlength="10" />


                          <datalist id="glCodeList<?= $i ?>">
                            
                            <?php foreach($gl_list as $key) { ?>

                                   <option value="<?= $key->GL_CODE ?>" data-xyz="<?= $key->GL_NAME ?>"><?= $key->GL_CODE ?><?= $key->GL_NAME ?></option>

                                <?php   } ?>

                          </datalist>


                      </div>
                      <small id="gl_codeerr" style="color:red;"></small>
                      <br>

              


                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  
                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       DEFUALT

                        <span class="required-field"></span>

                      </label>

                      
                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="defaultList<?= $i ?>" class="form-control  rdate" name="defulat_value[]"  value="NO" id="defulat_value<?= $i ?>" placeholder="Enter value" maxlength="10" />


                          <datalist id="defaultList<?= $i ?>">
                            
                           

                            <option value="YES">YES</option>
                            <option value="NO" selected>NO</option>


                          </datalist>


                      </div>
                      <small id="gl_codeerr" style="color:red;"></small>
                      <br>

                   

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                <!-- /.col -->

                

              </div>

            <?php  } ?>

               
           
               <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary" onclick="return validation();">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update 

                 </button>

              </div>


           

          </div><!-- /.box-body -->

           

      </div>

    </div>

   </div>



</section>


</form>
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
</script>
<script type="text/javascript">
  
  function indChange(ind){

    var indicator =  $("#indicator"+ind).val();

    if(indicator=='DESIEL'){

      $("#defulat_value"+ind).val('YES');
      $("#defulat_value"+ind).prop('readonly',true);

    }else{

      $("#defulat_value"+ind).val('NO');
      $("#defulat_value"+ind).prop('readonly',false);

    }

     var xyz = $('#indList'+ind+' option').filter(function() {

        return this.value == indicator;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        $("#indicator"+ind).val(msg);

        if(msg == 'No Match'){

            $("#indicator"+ind).val('');
            $("#indicatorName"+ind).val('');
            document.getElementById("plantText"+ind).innerHTML = ''; 

        }else{

            $("#indicatorName"+ind).val(indicator);
            document.getElementById("plantText"+ind).innerHTML = indicator; 
        }

  }
</script>


@endsection