@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

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
  .showSeletedName{

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }


.rdate{

  text-align:right;


}

::placeholder {
  
  text-align:left;
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

            Master Fleet Expense 
 
            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Master Fleet</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Add Mast Fleet</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

     <!--  <div class="col-sm-2"></div> -->

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Master Fleet Expense</h2>


               <div class="box-tools pull-right">

                <a href="{{ url('/view-fleet-exp-mast') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fleet Expense</a>

              </div>


              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-fleet') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Fleet Expense</a>

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

            <form action="{{ url('fleet-exp-save') }}" method="POST" >

               @csrf

               <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       FLEET TYPE

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="fleetList" class="form-control" name="fleet_type[]" id="fleet_type1"  placeholder="Enter Fleet Type"  oninput="this.value = this.value.toUpperCase()">

                          <datalist id="fleetList">
                            
                            <option value="14W">14 W</option>
                            <option value="10W">10 W</option>
                            <option value="8W">8 W</option>
                            <option value="6W">6 W</option>

                          </datalist>
                         
                        </div>
                         <small id="typeerr" style="color:red;"></small>
                        <br>

                         <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="fleetList1" class="form-control" name="fleet_type[]" id="fleet_type2" value="{{ old('truck_no') }}" placeholder="Enter Fleet Type" maxlength="13" oninput="this.value = this.value.toUpperCase()">

                           <datalist id="fleetList1">
                            
                             <option value="14W">14 W</option>
                            <option value="10W">10 W</option>
                            <option value="8W">8 W</option>
                            <option value="6W">6 W</option>
                          </datalist>


                        </div>

                        <br>


                         <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="fleetList2" class="form-control" name="fleet_type[]" id="fleet_type3" value="{{ old('truck_no') }}" placeholder="Enter Fleet Type" maxlength="13" oninput="this.value = this.value.toUpperCase()">

                           <datalist id="fleetList2">
                            
                             <option value="14W">14 W</option>
                            <option value="10W">10 W</option>
                            <option value="8W">8 W</option>
                            <option value="6W">6 W</option>

                          </datalist>

                        </div><br>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="fleetList3" class="form-control" name="fleet_type[]" id="fleet_type4" value="{{ old('truck_no') }}" placeholder="Enter Fleet Type" maxlength="13" oninput="this.value = this.value.toUpperCase()">

                         <datalist id="fleetList3">
                            
                             <option value="14W">14 W</option>
                            <option value="10W">10 W</option>
                            <option value="8W">8 W</option>
                            <option value="6W">6 W</option>

                          </datalist>

                        </div><br>

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

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       HEAD

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="indList" class="form-control" name="indicator[]" id="indicator1"  placeholder="Enter  Indicator"  oninput="this.value = this.value.toUpperCase()">

                          <datalist id="indList">

                            <?php foreach($lrexp_list as $key) { ?>

                               <option value="<?= $key->LRIND ?>"><?= $key->LRIND ?></option>

                            <?php   } ?>
                           
                          </datalist>

                        </div>
                         <small id="indicatorerr" style="color:red;"></small>
                        <br>

                         <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="indList1" class="form-control" name="indicator[]" id="indicator2" value="{{ old('truck_no') }}" placeholder="Enter  Indicator" maxlength="13" oninput="this.value = this.value.toUpperCase()">

                        <datalist id="indList1">

                            <?php foreach($lrexp_list as $key) { ?>

                               <option value="<?= $key->LRIND ?>"><?= $key->LRIND ?></option>

                            <?php   } ?>
                           
                          </datalist>


                        </div><br>


                         <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="indList2" class="form-control" name="indicator[]" id="indicator3" value="{{ old('truck_no') }}" placeholder="Enter  Indicator" maxlength="13" oninput="this.value = this.value.toUpperCase()">

                          <datalist id="indList2">

                            <?php foreach($lrexp_list as $key) { ?>

                               <option value="<?= $key->LRIND ?>"><?= $key->LRIND ?></option>

                            <?php   } ?>
                           
                          </datalist>
                        </div><br>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="indList3" class="form-control" name="indicator[]" id="indicator4" value="{{ old('truck_no') }}" placeholder="Enter  Indicator" maxlength="13" oninput="this.value = this.value.toUpperCase()">

                         <datalist id="indList3">

                            <?php foreach($lrexp_list as $key) { ?>

                               <option value="<?= $key->LRIND ?>"><?= $key->LRIND ?></option>

                            <?php   } ?>
                           
                          </datalist>

                        </div><br>

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

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="indexList" class="form-control  rdate" name="index[]" id="index1"  value="" placeholder="Enter Index"/>

                              <datalist id="indexList">
                            
                               <option value="L">L</option>

                              </datalist>



                      </div>
                      <small id="indexerr" style="color:red;"></small>
                      <br>

                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="indexList1" class="form-control  rdate" name="index[]" value=""placeholder="Enter Index"  id="index2"/>

                             <datalist id="indexList1">
                            
                               <option value="L">L</option>

                              </datalist>

                      </div><br>
                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="indexList2" class="form-control  rdate" name="index[]"  value="" placeholder="Enter Index" id="index3"/>

                            <datalist id="indexList2">
                            
                               <option value="L">L</option>

                              </datalist>


                      </div><br>
                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="indexList3" class="form-control  rdate" name="index[]"  value=""  placeholder="Enter Index" id="index4" />

                           <datalist id="indexList3">
                            
                               <option value="L">L</option>

                              </datalist>




                      </div><br>

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

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control  rdate" name="rate[]"  value="" placeholder="Enter Rate" id="rate1" />


                      </div>

                       <small id="rateerr" style="color:red;"></small>
                      <br>

                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control  rdate" name="rate[]" value=""placeholder="Enter Rate"  id="rate2"/>


                      </div><br>
                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control  rdate" name="rate[]"  value="" placeholder="Enter Rate" id="rate3"/>


                      </div><br>
                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control  rdate" name="rate[]"  value=""  placeholder="Enter Rate" id="rate4"/>


                      </div><br>

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

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="glCodeList" class="form-control  rdate" name="gl_code[]"  value="{{ old('regd_date') }}" id="gl_code1" placeholder="Enter Gl Code" maxlength="10" />


                          <datalist id="glCodeList">
                            
                            <?php foreach($lrexp_list as $key) { ?>

                                   <option value="<?= $key->GL_CODE ?>"><?= $key->GL_CODE ?></option>

                                <?php   } ?>

                          </datalist>


                      </div>
                      <small id="gl_codeerr" style="color:red;"></small>
                      <br>

                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="glCodeList1" class="form-control  rdate" name="gl_code[]"  value="{{ old('regd_date') }}" placeholder="Enter Gl Code" maxlength="10" id="gl_code2"/>

                           <datalist id="glCodeList1">
                            
                            <?php foreach($lrexp_list as $key) { ?>

                                   <option value="<?= $key->GL_CODE ?>"><?= $key->GL_CODE ?></option>

                                <?php   } ?>

                          </datalist>

                      </div><br>
                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="glCodeList2" class="form-control  rdate" name="gl_code[]"  value="{{ old('regd_date') }}" placeholder="Enter Gl Code" maxlength="10" id="gl_code3"/>

                           <datalist id="glCodeList2">
                           <?php foreach($lrexp_list as $key) { ?>

                                   <option value="<?= $key->GL_CODE ?>"><?= $key->GL_CODE ?></option>

                                <?php   } ?>

                          </datalist>


                      </div><br>
                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="glCodeList3" class="form-control  rdate" name="gl_code[]"  value="{{ old('regd_date') }}" placeholder="Enter Gl Code" maxlength="10" id="gl_code4"/>

                           <datalist id="glCodeList3">
                            
                            <?php foreach($lrexp_list as $key) { ?>

                                   <option value="<?= $key->GL_CODE ?>"><?= $key->GL_CODE ?></option>

                                <?php   } ?>

                          </datalist>


                      </div><br>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

                <!-- /.col -->

                

              </div>

            
           
              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary" onclick="return validation();">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                 </button>

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
  function validation(){

    var fleet_type = $("#fleet_type1").val();
    var indicator  = $("#indicator1").val();
    var index      = $("#index1").val();
    var rate       = $("#rate1").val();
    var gl_code    = $("#gl_code1").val();

    if(fleet_type ==''){

      $("#typeerr").html('This field is requiered');
      return false;
    }else{
      $("#typeerr").html('');
    }

    if(indicator ==''){
      $("#indicatorerr").html('This field is requiered');
      return false;
    }else{
      $("#indicatorerr").html('');
    }

    if(index ==''){
      $("#indexerr").html('This field is requiered');
      return false;
    }else{
      $("#indexerr").html('');
    }

    if(rate ==''){
      $("#rateerr").html('This field is requiered');
      return false;
    }else{
      $("#rateerr").html('');
    }

    if(gl_code ==''){
      $("#gl_codeerr").html('This field is requiered');
      return false;
    }else{
      $("#gl_codeerr").html('');
    }

  }
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#truck_no').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var truck_no = $('#truck_no').val();

        if(truck_no == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-truck-no') }}",

             method : "POST",

             type: "JSON",

             data: {truck_no: truck_no},

             success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                       var objcity = data1.data;
                       $('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.truck_no+'</span><br>');
                         });
                        
                  }
             }

          });
       }

    });

    $("body").click(function() {
        $("#showSearchCodeList").hide("fast");
    });
  });
</script>

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Truck No <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
        html:true,
        content:  $('#myForm').html()
    }).on('click', function(){
      // had to put it within the on click action so it grabs the correct info on submit
      $('#serachcode').click(function(){

           $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });

          var HelpTruckNo = $('#trucknoH').val();

           if(HelpTruckNo == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-trcuk-no-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpTruckNo: HelpTruckNo},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Truck No Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><th>Truck No</th></tr><tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;text-transform:uppercase">'+objcity.truck_no+'</td></tr>');
                             });
                      }
                 }

              });
           }
      })
  })
})
</script>

<script type="text/javascript">
  $(document).ready(function(){
     $('body').on('click', '#closeModel', function () {
          $('.popover').fadeOut();
    })
  });
</script>

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>

<script type="text/javascript">

  

  $(document).ready(function() {

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      endDate: 'today',
      
      autoclose: 'true'

    });

});


  $(document).ready(function(){



        $("#Depot").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("depotText").innerHTML = '';

          }

        });

        $("#make").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#mfgList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("makeText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("makeText").innerHTML = '';

          }

        });



        $("#wheel_type").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#wheelList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("wheelText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             document.getElementById("wheelText").innerHTML = '';

          }

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
@endsection