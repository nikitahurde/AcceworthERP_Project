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

            Master Driver
 
            <small> : Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/master/logistic/driver-master') }}">Logistics</a></li>

            <li class="active"><a href="{{ url('/master/logistic/driver-master') }}">Add  Driver Master</a></li>

          </ol>

        </section>

  <section class="content">

    <div class="row">

     <!--  <div class="col-sm-2"></div> -->
     <div class="col-sm-1"></div>
      <div class="col-sm-10">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Master Driver</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/master/logistic/view-driver-master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Master Driver</a>

              </div>

              <div class="hideinmobile">

			        <div class="box-tools pull-right" style="margin-top: -22px;">

			          <a href="{{ url('/master/logistic/view-driver-master') }}" class="btn btn-primary"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Master Driver</a>

			        </div>

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

            <form action="{{ url('/master/logistic/save-driver-master') }}" method="POST" >

               @csrf

               <div class="row">

                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Vehicle No. : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                          <input  type="text" class="form-control" name="vehicleNo" id="vehicleNoId"  value="{{ old('vehicleNo') }}" placeholder="Enter Vehicle Number" autocomplete="off"/>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('vehicleNo', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Driver Name : <span class="required-field" id="compc_req"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input list="driverList" class="form-control" name="driverNm" id="driverNmId"  value="{{ old('driverNm') }}" placeholder="Select Driver Name"  autocomplete="off" />

                          <datalist id="driverList">
                          <?php foreach ($employee_list as $key) { ?>
                            
                            <option value="<?php echo $key->EMP_CODE.' - '.$key->EMP_NAME; ?>" data-xyz="<?= $key->EMP_NAME ?>"><?= $key->EMP_CODE ?> <?= " [".$key->EMP_NAME."]" ; ?></option>

                          <?php   } ?>

                          </datalist>
                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('driverNm', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        From Date : <span class="required-field" id="compc_req"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control datepicker" name="fromeDate" id="fromeDateId"  value="{{ old('fromeDate') }}" placeholder="Select From Date"  autocomplete="off" />

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fromeDate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        To Date : 

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control datepicker" name="toDate"  value="{{ old('toDate') }}" placeholder="Enter To-Date" id="comp_name"  autocomplete="off" readonly/>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('toDate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
              </div>

              <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       Mobile No. :

                        <span class="required-field" id="cost_req"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building"></i></span>
                           <input type="text"  id="driveMobNoId" name="driveMobNo" class="form-control  pull-left" value="{{ old('driveMobNo')}}" placeholder="Enter Mobile Number" maxlength="10" autocomplete="off">

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('driveMobNo', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                          <small>
                          <div class="pull-left showSeletedName" id="depotText"></div>
                        </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       License No. : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-card"></i></span>

                          <input type="text" class="form-control" name="licenseNo" id="licenseNoId" value="{{ old('licenseNo') }}" placeholder="Enter License Number" maxlength="20" autocomplete="off">

                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('licenseNo', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

              	 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       License Exp. Date : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-card"></i></span>

                          <input type="text" class="form-control datepicker" name="licenseExpDate" id="licenseExpDateId" value="{{ old('licenseExpDate') }}" placeholder="Select License Date" autocomplete="off">

                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('licenseExpDate', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
             
              <div class="col-md-3">

                    <div class="form-group">

                      <label>

                      Contact Name  : 

                        
                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                          <input type="text" class="form-control  nextOnEnterBtn" name="contactname" id="contactnameId" value="{{ old('contactname') }}" placeholder="Enter contact Name" autocomplete="off">

                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('contactname', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
             
             
              </div>
              <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                      Reference Mobile No :

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                           <input type="text"  id="driveMobNoId" name="referenceNo" class="form-control  pull-left nextOnEnterBtn" value="{{ old('referenceNo')}}" placeholder="Enter Mobile Number" maxlength="10" autocomplete="off">

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('referenceNo', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                          <small>
                          <div class="pull-left showSeletedName" id="depotText"></div>
                        </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       Relation: 

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                          <input type="text" class="form-control nextOnEnterBtn" name="relation" id="relationId" value="{{ old('relation') }}" placeholder="Enter Relation" maxlength="15" autocomplete="off">

                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('relation', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>
                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                     Permanent Address : 

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                          <input type="text" class="form-control  nextOnEnterBtn" name="Permentaddress" id="PermentaddressId" value="{{ old('Permentaddress') }}" placeholder="Enter Parmanent Address" autocomplete="off">

                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('Permentaddress', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
             

                 <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       Temporary Address : 

                      </label>

                        <div class="input-group">

                         <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                         
                           <textarea rows="1" type="text" name='temporaryaddress' id='temporaryaddressId' class="form-control nextOnEnterBtn" value ="{{ old('temporaryaddress') }}"placeholder="Temporary Address"></textarea>
                    
                          
           
                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('temporaryaddress', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                  
             
              </div>
              <div class="row">

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                      Adhar No:

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                           <input type="text"  id="adharnoId" name="adharno" class="form-control  pull-left nextOnEnterBtn" value="{{ old('adharno')}}" placeholder="Enter Adhar No" maxlength="12" autocomplete="off">

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('adharno', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                          <small>
                          <div class="pull-left showSeletedName" id="depotText"></div>
                        </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       Guaranter Name: 

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>
                          <input type="text" class="form-control nextOnEnterBtn" name="guarantername" id="guaranternameId" value="{{ old('guarantername') }}" placeholder="Enter Guaranter Name" maxlength="15" autocomplete="off">

                           
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('guarantername', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>
                </div>

              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

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

  
  $(document).ready(function() {

    $("#driverNmId").bind('change', function () {  

      var val = $(this).val();
      var xyz = $('#driverList option').filter(function() {
      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $(this).val('');
      }

    });

    /*$('#fromeDateId').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      endDate: 'today',
      
      autoclose: 'true'

    });

    var currentDate = new Date().getFullYear();
    var date = new Date();
    var y = date.getFullYear();var  m = date.getMonth();
    console.log('current',currentDate);
    var fSDate = new Date(y, m, 1);
    var fEDate = new Date(y, m + 1, 0);

    
      $('#licenseExpDateId').datepicker({
        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        endDate: fEDate,
        minDate :currentDate,
        todayHighlight: true,
        autoclose:true,
        
     });*/


     $('#fromeDateId').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      endDate: 'today',
      
      autoclose: 'true'

    });

   $("#toDateId").click(function() {
          
    var fr_date = $('#fromeDateId').val();
    
    var fromDt     = fr_date.split("-");

    var d         = new Date(fromDt[2], fromDt[1] - 1, fromDt[0]);
   
    console.log('date',d.setDate(d.getDate() + 1));
    var getdate   = d.getDate();
    var getMonth  = d.getMonth()+1;
    var getYear   = d.getFullYear();
    var formDate  = getYear+'-'+getMonth+'-'+getdate;
    console.log('formDate',formDate);

    var d         = new Date(formDate);
    var mo        = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
    var da        = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

    var next_date =da+'-'+mo+'-'+getYear;
    console.log('next_date',next_date);
  
    if(fr_date != ''){
      $('#toDateId').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      endDate: 'today',
      
      autoclose: 'true'

    });

      // $('#toDateId').datepicker({
      //     format: 'dd-mm-yyyy',
      //     orientation: 'bottom',
      //     todayHighlight: 'true',
      //     startDate: next_date,
      //     autoclose: 'true'
      //   });

       $('#toDateId').datepicker('show');
         
    }
   
   });
  
    var currentDate = new Date().getFullYear();
    var date = new Date();
    var y = date.getFullYear();var  m = date.getMonth();
    console.log('current',currentDate);
    var fSDate = new Date(y, m, 1);
    var fEDate = new Date(y, m + 1, 0);

    var stDate = $('#licenseExpDateId').val();

    
      $('#licenseExpDateId').datepicker({
        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        startDate:'today',
      //  endDate: fEDate,
        todayHighlight: true,
        autoclose:true,
        
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