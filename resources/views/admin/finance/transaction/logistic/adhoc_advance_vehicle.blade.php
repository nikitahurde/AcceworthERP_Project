@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')



<<style type="text/css">


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
  .content {
  min-height: 80px !important;
  padding: 0px !important;
  margin-right: auto !important;
  margin-left: auto !important;
  padding-left: 15px !important;
  padding-right: 15px !important;
}
.showSeletedName {
  font-size: 15px;
  margin-top: 2%;
  text-align: center;
  font-weight: 600;
  color: #4f90b5;
}

.vehiclenumup{
  text-transform: uppercase;
}
.tdthtablebordr{
  padding:3px !important;
}
#marketTable{
  display:none;
}
</style>

<style type="text/css">

  .rTable { display: table; }

.rTableRow { display: table-row; }

.rTableHeading { display: table-header-group; }

.rTableBody { display: table-row-group; }

.rTableFoot { display: table-footer-group; }

.rTableCell, .rTableHead { display: table-cell; }

  .rTable {
   display: table;
   /*width: 100%;*/
}

.rTableRow {

   display: table-row;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

}

.rTableCell, .rTableHead {

   display: table-cell;

   padding: 3px 10px;

   border: 1px solid #ebe7e7;

}

.rTableHeading {

   display: table-header-group;

   background-color: #ddd;

   font-weight: bold;

}

.rTableFoot {

   display: table-footer-group;

   font-weight: bold;

   background-color: #ddd;

}

.rTableBody {

   display: table-row-group;

}

.setInline{

  display: flex;

  margin-bottom: 4px;

}

.rowClass{

  margin: 0px;

  margin-top: 3%;

}

.rowClass1{

  margin: 0px;

  margin-top: 0%;

}

.rowClassonModel{

   margin: 0px;

  margin-top: 1%;

}

.LableTextField{

  text-align: center;

  font-weight: 600;

}

.distClass{

  display: none;



}

.sgstBlock{

  display: none;

}

.cgstBlock{

  display: none;

}

.afforblck{

  display: none;

}

.affiveblck{

  display: none;

}

.afsixblck{

  display: none;

}

.afsevenblck{

  display: none;

}

.afheadeightblck{

  display: none;

}

.afheadnineblck{

  display: none;

}

.afheadtenblck{

  display: none;

}

.afheadelvnblck{

  display: none;

}

.afheadtwelblck{

  display: none;

}

.getheading{

  border: none;

  width: 61px;

}
.settaxcodemodel{
  font-size: 16px;
  font-weight: 800;
  color: #5d9abd;
}

thead th {
    height: 23px !important;
    background-color: #b8daff;
    text-align: center;
}

</style> 
<style>
        .boxer {
        display: table;
        border-collapse: collapse;
        }
        .boxer .box-row {
        display: table-row;
        }
        .boxer .box-row:first-child {
        font-weight:bold;
        }
        .boxer .box10 {
        display: table-cell;
        vertical-align: top;
        border: 1px solid #ddd;
        padding: 5px !important;
        }
        .boxer .hidebordritm {
        display: table-cell;
        vertical-align: top;
        border: none;
        padding: 5px;
        }
        .boxer .ebay {
        padding:5px 1.5em;
        }
        .boxer .google {
        padding:5px 1.5em;
        }
        .boxer .amazon {
        padding:5px 1.5em;
        }
        .center {
        text-align:center;
        }
        .right {
        float:right;
        }
        .texIndbox{
        width: 25%; 
        text-align: center;
        }
         .texIndbox1{
        width: 5%; 
        text-align: center;
        font-size: 12px;
        }
        .rateIndbox{
        width: 15%;
        text-align: center;
        }
        .itmdetlheading{
        vertical-align: middle !important;
        text-align: center;
        }
        .rateBox{
        width: 12% !important;
        text-align: center;
        }
        .amountBox{
        width: 12% !important;
        text-align: center;
        }
        .inputtaxInd{
        background-color: white !important;
        border: none;
        text-align: center;
        }
        .showind_Ch{
        display: none;
        }

        .btn-group-sm>.btn, .btn-sm {
          padding: 2px 4px;
          font-size: 12px;
          line-height: 1.5;
          border-radius: 3px;
      }
      </style>


<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ $title }}
        <small>Add Details</small>
      </h1>

      <ul class="breadcrumb">

        <li>
          <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>

        <li>
          <a href="{{ url('/dashboard') }}">Transaction</a>
        </li>

        <li class="active">
          <a href="{{ url('/finance/transaction/store/store-requistion') }}"> {{ $title }}</a>
        </li>

       

      </ul>

    </section>

  <form id="salesordertrans">
          @csrf
    <section class="content">

      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> {{ $title }}</h2>

              <div class="box-tools pull-right">

                <!-- <a href="{{ url('/Transaction/Logistic/View-Vehicle-Gate-Inward') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Vehicle Adhoc Adv.</a> -->

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
   <div class="overlay-spinner hideloader"></div>
  
    <div class="row">
      <div class="col-md-12">
        <div class="panel with-nav-tabs panel-info">
       

          <div class="panel-body">

            <div class="modalspinner hideloaderOnModl"></div>

              <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab1info">

                    <div class="row">

                      <!-- /.col -->
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                              <?php 

                              date_default_timezone_set('Asia/Kolkata');

                                $CurrentDate = date("d-m-Y");
                                   
                              //  print_r($CurrentDate);

                              ?>
                            

                              <input type="text" class="form-control transdatepicker" name="vr_date" id="vr_date" value="{{ $CurrentDate }}" placeholder="Select Date" autocomplete="off">

                            </div>

                            <small id="showmsgfordate" style="color: red;"></small>

                            <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>
                        </div>
                            <!-- /.form-group -->
                      </div>


                      <div class="col-md-3">
                              <div class="form-group">

                                <label>Vehicle No : <span class="required-field"></span></label>

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                    <input list="vehicleList" class="form-control" name="vehicle_no" id="vehicle_no" placeholder="Enter Vehicle No" maxlength="15" autocomplete="off" onchange="getTruckDetails(this.value)">

                                    <datalist id="vehicleList">
                                      
                                      <?php foreach($vehicle_list as $key) { ?>

                                        <option value="<?= $key->VEHICLE_NO ?>" data-xyz="<?= $key->VEHICLE_NO ?>"><?= $key->VEHICLE_NO ?></option>
                                        

                                      <?php  } ?>

                                    </datalist>

                                </div>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                                </small>

                                <small id="vehicleno_err" style="color: red;"></small>


                              </div>
                          </div>
                          <!-- /.col -->

                           <div class="col-md-3">
                            <div class="form-group">

                              <label>Driver Name: <span class="required-field"></span> </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                            

                                <input type="text" class="form-control" name="driver_name" id="driver_name" value="" placeholder="Enter Driver Name" autocomplete="off">

                                <input type="hidden" class="form-control" name="driver_code" id="driver_code" value="" placeholder="Enter Driver Name" autocomplete="off">

                              </div>

                             <small id="drivername_err" style="color: red;"></small>

                              <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('driver_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">

                              <label>Driver Contact No: <span class="required-field"></span></label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              
                                <input type="text" class="form-control Number" name="driver_contact_no" id="driver_contact_no" value="" placeholder="Enter Contact Number" autocomplete="off" maxlength="10">

                              </div>

                             <small id="driverno_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('driver_contact_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>

                          
                     
                      
                    </div>
                  


                  <div class="row">


                        
                            <div class="col-md-3">
                            <div class="form-group">

                              <label>Driver License No: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                              
                                <input type="text" class="form-control" name="driver_license_no" id="driver_license_no" value="" placeholder="Enter License No" autocomplete="off">

                              </div>

                             <small id="driverlic_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('driver_license_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>

                          
                          <div class="col-md-3">
                            <div class="form-group">

                              <label>Driver License Exp Dt: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                              
                                <input type="text" class="form-control transdatepicker" name="driver_license_ex_dt" id="driver_license_ex_dt" value="" placeholder="Enter License Dt" autocomplete="off">

                              </div>

                             <small id="driverlicdt_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('driver_license_ex_dt', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>

                          <div class="col-md-5">
                            <div class="form-group">

                              <label>Remark: </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                                <textarea class="form-control" name="remark" id="remark" value="" cols="20" rows="2" placeholder="Enter remark" autocomplete="off"></textarea>
                               <!--  <input type="text" class="form-control" name="remark" id="remark" value="" placeholder="Enter remark" autocomplete="off"> -->

                              </div>

                             <small id="remark_err" style="color: red;"></small>

                                <small id="emailHelp" class="form-text text-muted">

                                     {!! $errors->first('remark', '<p class="help-block" style="color:red;">:message</p>') !!}
                                     
                                 </small>
                            </div>
                            <!-- /.form-group -->
                          </div>

                    
                  </div>

              
                </div>
            </div> <!-- /.tab first -->


                  
           </div>
        
      </div>

  </div>
 </div>
</div>
        
</div><!-- /.box-body -->

</div><!-- /.custom -->

</div><!-- /.col -->

</section><!-- /.section -->

  <section class="content">

      <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">

          <div class="box box-primary Custom-Box">

           

          <div class="box-body">
             <div class="overlay-spinner hideloader"></div>
            
              <div class="row">
                <div class="col-md-12">
                  <div class="panel with-nav-tabs panel-info">
                 
                        <div class="col-sm-12">
                    
                          <div class="">


                          <div style="height:23px;font-weight: bold;padding-top: 12px;font-size:12px;text-align: center;background-color: #b8daff;">
                             PAYMENT MODE
                          </div>
                          <div id="dublicateerr" style="color: red;text-align: center;"></div>
                        <div class="boxer" id="bodyTable1">

                             
                           <div class='box-row' style="background-color: #b8daff;">
                            <div class='box10 texIndbox1'>CODE</div>
                            <div class='box10 texIndbox1'>NAME</div>
                            <div class='box10 texIndbox1'>DIESEL</div>
                            <div class='box10 texIndbox1'>CASH</div>
                            <div class='box10 texIndbox1'>AMT</div>
                           </div>

                           <input type="hidden" name="bankCodeDup" id="bankCodeDup">
                           
                          <?php $sr=1; for ($i=0; $i < 1 ; $i++) {  ?>
                          <div class='box-row'>
                            <div class='box10 texIndbox1'>
                             <input list="bankList<?= $sr ?>" class="debitcreditbox dr_amount inputboxclr SetInCenter"  id="bank_code<?= $sr ?>" name="bank_code[]"  style="width: 80px" onchange="bankName(<?= $sr ?>);"  autocomplete='off'/>

                              <datalist id="bankList<?= $sr ?>">
                              
                              <?php foreach ($bank_list as $key) { ?>
                                
                                <option value="<?= $key->BANK_CODE; ?>" data-xyz="<?= $key->BANK_NAME; ?>"><?= $key->BANK_CODE; ?> - <?= $key->BANK_NAME; ?></option>

                              <?php } ?>

                              </datalist>
                           </div>
                            <div class='box10 texIndbox1'>
                            <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='bank_name<?= $sr ?>' name="bank_name[]"  style="width: 90px" autocomplete='off'/>
                           </div>
                           <div class='box10 texIndbox1'>
                            <input type='text' class="debitcreditbox dr_amount inputboxclr banktotal"  id='diesel_amt<?= $sr ?>' name="diesel_amt[]"  oninput="banktotal(<?= $sr ?>)" style="width: 90px;text-align:right;" autocomplete='off'/>
                           </div>
                           <div class='box10 texIndbox1'>
                            <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter banktotal_diesel"  id='cash_amt<?= $sr ?>' name="cash_amt[]" oninput="banktotal(<?= $sr ?>)"  style="width: 90px;text-align:right;" autocomplete='off'/>
                           </div>
                            <div class='box10 texIndbox1'> 
                            <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter" readonly  id='bankAmt<?= $sr ?>' name="bankAmt[]"  autocomplete='off' style="width: 80px;text-align:right;"/>
                            </div>
                          </div>

                          <?php $sr++; } ?>
                         </div>
                       

                          </div><!-- /div -->

                          <div class="row">

                            <div class="col-md-12">
                             <div style="margin-left: 83%;margin-top: 15px;">  <label> Total  : </label> <span id='bankTotal'></span>
                             </div>

                             </div>

                            
                           
                          </div>


                        <div class="row">
                        <div class="col-md-2"></div>
                            <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
                            <div class="col-md-6" style="text-align: center;margin-top: 20px;">
                               <button type="button" class="btn btn-success btn-sm" onclick="return submitAllData(0)" disabled="" id="submidata">Submit</button>

                               <button type="button" class="btn btn-warning btn-sm" >Cancel</button>

                                <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitAllData(1)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>
                           </div>
                        <div class="col-md-2">
                        </div>
                      </div>


                     </div>
                              
                </div>

            </div>
           </div>
          </div>
        
          </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

</section><!-- /.section -->
</form>

</div>



@include('admin.include.footer')




 <script type="text/javascript">
   
  function EmpCode(){

  var empcode =  $("#emp_code").val();

   if(empcode==''){
  
     $('#emp_code').css('border-color','#d2d6de');
     $('#acc_code').css('border-color','#d2d6de');
     $('#emp_code').css('border-color','#ff0000').focus();
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#emp_code').css('border-color','#d2d6de');
      $('#acc_code').css('border-color','#ff0000').focus();
     // $('#asset_code').css('border-color','#ff0000').focus();
     }

  var xyz = $('#emplList option').filter(function() {

    //console.log(this.value);

    return this.value == empcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
     $('#empName').html('');
     document.getElementById("empcode_err").innerHTML = 'The employee code field is required.';
     $('#emplyeeName').val('');
     //$("#ItemCodeId1").prop('readonly',true);
  }else{
    $('#empName').html(msg);
    $('#emplyeeName').val(empcode);
    document.getElementById("empcode_err").innerHTML = '';
/*    $('#due_days').prop('readonly',false);
*/    //$('#ItemCodeId1').prop('readonly',false);

  }
 //objvalidtn.checkBlankFieldValidation();

}

$("#vehicle_plan_no").on('change', function () {

  var vehicle_plan_no =  $(this).val();

  if(vehicle_plan_no==''){
  
     $('#vehicle_plan_no').css('border-color','#d2d6de');
     $('#driver_name').css('border-color','#d2d6de');
     $('#vehicle_plan_no').css('border-color','#ff0000').focus();
    
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#vehicle_plan_no').css('border-color','#d2d6de');
      $('#driver_name').css('border-color','#ff0000').focus();
     
     // $('#asset_code').css('border-color','#ff0000').focus();
     }



});

$("#vehicle_no").on('change', function () {

  var vehicle_no =  $(this).val();

  if(vehicle_no==''){
  
     $('#vehicle_no').css('border-color','#d2d6de');
    
     //$('#driver_name').css('border-color','#d2d6de');
     $('#vehicle_no').css('border-color','#ff0000').focus();
     $('#vehicle_plan_no').css('border-color','#ff0000');
    
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#vehicle_no').css('border-color','#d2d6de');
    //  $('#driver_name').css('border-color','#ff0000').focus();
       $('#vehicle_plan_no').css('border-color','#d2d6de');
     
     // $('#asset_code').css('border-color','#ff0000').focus();
     }



});



$("#driver_name").on('input', function () {

  var driver_name =  $(this).val();

  if(driver_name==''){
  
     $('#driver_name').css('border-color','#d2d6de');
     $('#driver_contact_no').css('border-color','#d2d6de');
     $('#driver_name').css('border-color','#ff0000').focus();
   
    
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#driver_name').css('border-color','#d2d6de');
      $('#driver_contact_no').css('border-color','#ff0000');
      
      
     
     // $('#asset_code').css('border-color','#ff0000').focus();
     }



});

$("#driver_contact_no").on('input', function () {

  var driver_contact_no =  $(this).val();

  if(driver_contact_no==''){
  
     $('#driver_contact_no').css('border-color','#d2d6de');
     
     $('#driver_contact_no').css('border-color','#ff0000').focus();

       $('#submidata').prop('disabled',true);

     }else{
      $('#driver_contact_no').css('border-color','#d2d6de');
       $('#submidata').prop('disabled',false);
      
     }



});

$("#acc_code").on('change', function () {
  var Acccode =  $(this).val();

  if(Acccode==''){
  
     $('#acc_code').css('border-color','#d2d6de');
     $('#order_no').css('border-color','#d2d6de');
     $('#acc_code').css('border-color','#ff0000').focus();
    
     //$('#asset_code').css('border-color','#d2d6de');
     }else{
      $('#acc_code').css('border-color','#d2d6de');
      $('#order_no').css('border-color','#ff0000').focus();
     
     // $('#asset_code').css('border-color','#ff0000').focus();
     }


  var xyz = $('#accList option').filter(function() {

    return this.value == Acccode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
      $("#acc_name").val(''); 
     document.getElementById("accode_err").innerHTML = 'The Account code field is required.';
     
      
  }else{
      
      $("#acc_name").val(msg);  
     document.getElementById("accode_err").innerHTML = '';
     
    
  }

  // objvalidtn.checkBlankFieldValidation();

});






 </script>

 <script type="text/javascript">
   function StatusChange(status){

    if(status=='Plan'){
      $("#estimate_time").prop('readonly',false);
    }else{
      $("#estimate_time").prop('readonly',true);
    }
}

/*$('.timepicker').datetimepicker({
  useCurrent: false,
  format: "hh:mm A"
})*/


 </script>

 <script type="text/javascript">
 $('.ArrDate').datetimepicker({

    format:'DD-MM-YYYY hh:mm:ss'
  });
</script>

<script type="text/javascript">

  
  $(document).ready(function() {

     $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

    });

     $("#date_birth").change(function(event){

        var date_birth =  $("#date_birth").val();
        var driving_ls_no =  $("#driver_license_no").val();

         var cuurnt_date = new Date().toLocaleDateString('fr-CA');

         var getDate  = cuurnt_date.split("-");

        var year =  getDate[0];
        var month =  getDate[1];
        var date =  getDate[2];

        var currentDate = year+"/"+month+"/"+date;

    

          $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

            $.ajax({

            url:"{{ url('get-driving-license-details') }}",

            method : "POST",

            type: "JSON",

            data: {date_birth: date_birth,driving_ls_no:driving_ls_no},

             /*beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },*/

            success:function(data){

              var data1 = JSON.parse(data);

              console.log(data1);
                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  console.log(data1.data);
                  //console.log('data1.data[0]',data1.data[0]);
                  if(data1.data == ''){
                      
                    }else{
                        

                        var dr_ls_dt = data1.data.response.dlNtValdToDt;

                        var getlsDate  = dr_ls_dt.split("/");

                        var lsyear =  getlsDate[2];
                        var lsmonth =  getlsDate[1];
                        var lsdate =  getlsDate[0];

                        var drlsDate = lsyear+"/"+lsmonth+"/"+lsdate;


                        if(drlsDate < currentDate){

                            $("#vehiclemsgModal").modal('show');

                            $("#vehicleageMsg").html('<b> Driving License Is Expired </b>');

                             $("#submidata").prop('disabled',true);        
                             
                          }else{
                            $("#submidata").prop('disabled',false);

                              $("#driver_license_ex_dt").val(drlsDate);
                          }

                   


                    }

                }

            },

           /* complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },*/

          });


        /*var cuurnt_date = new Date().toLocaleDateString('fr-CA');

        var getDate  = cuurnt_date.split("-");

        var year =  getDate[0];
        var month =  getDate[1];
        var date =  getDate[2];

        var currentDate = date+"-"+month+"-"+year;

        if(ls_expire_date < currentDate){

          $("#vehiclemsgModal").modal('show');

          $("#vehicleageMsg").html('<b> Driving License Is Expired </b>');

           $("#submidata").prop('disabled',true);        
           
        }else{
          $("#submidata").prop('disabled',false);
        }*/

      

     });

    //$('.moneyformate').mask("#,##0.00", {reverse: true});

    $( window ).on( "load", function() {
        var vr_date = $('#vr_date').val();

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var Plant_code =  $('#Plant_code').val();
       // console.log(Plant_code);
          $.ajax({

            url:"{{ url('get-pfct-code-name-by-plant-indend') }}",

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                	console.log(data1.data);
                  //console.log('data1.data[0]',data1.data[0]);
                  if(data1.data == ''){
                       var profitctr = '';
                       var pfctget = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfct_name').val(pfctName);
                       $('#getPfctCode').val(pfctget);
                       $('#getPfctName').val(pfctName);
                    }else{
                      $('#profitctrId').val(data1.data[0].PFCT_CODE);
                      $('#pfct_name').val(data1.data[0].PFCT_NAME);
                      $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                      $('#getPfctName').val(data1.data[0].PFCT_NAME);

                    }

                }

            }

          });

    });

    /*$('#due_days').on('input',function(){
      
        dueDays = parseInt($('#due_days').val());

        if(dueDays){
            var vr_date = $('#vr_date').val();
            var explodeDate =  vr_date.split('-');
            var expDate= explodeDate[0];
            var expMonth= explodeDate[1];
            var expYear= explodeDate[2];
            var mergeDate = expMonth+'-'+expDate+'-'+expYear;
            var getduedate = new Date(mergeDate);

            getduedate.setDate(getduedate.getDate() + dueDays); 
            var getdate = getduedate.getDate();
            var getMonth=getduedate.getMonth()+1;
            var getYear = getduedate.getFullYear();
            var duedate1 =getYear+'-'+getMonth+'-'+getdate;

            var d = new Date(duedate1);
            var mo = new Intl.DateTimeFormat('en', { month: 'numeric', month: '2-digit' }).format(d);
            var da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);

            var duedate =da+'-'+mo+'-'+getYear;

            if(isNaN(dueDays)){
              
              $("#due_date").val('');
               $('#due_days').css('border-color','#ff0000').focus();
               $('#gateduedate').val('');
            }else{

            $("#due_date").val(duedate);
            $('#gateduedate').val(duedate);
            $("#ItemCodeId1").prop('readonly',false);
            $('#due_days').css('border-color','#d2d6de');

            }

           if (/\D/g.test(this.value))
            {
              // Filter non-digits from input value.
              this.value = this.value.replace(/\D/g, '');
            }
        }else{
          $('#due_date').val('');
          $('#gateduedate').val('');
          $('#ItemCodeId1').prop('readonly',true);
        } 

        
       

       
    });*/

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
  
  function bankName(num){


    var Bankcode =  $("#bank_code"+num).val();
     var bankCodeDup =     $("#bankCodeDup").val();

     //alert(Bankcode);

     if(bankCodeDup == Bankcode){

     // alert('dublicate');
    $("#dublicateerr").html('dublicate bank code not allowed');

    $("#bank_code"+num).val('');

    return false;
     }else{

    var xyz = $("#bankList"+num+" option").filter(function() {

      return this.value == Bankcode;

    }).data('xyz');

     var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
       
    }else{
    
      $("#bank_name"+num).val(msg);
      $("#bankCodeDup").val(Bankcode);
      $("#dublicateerr").html('');
    }

     }

     

  }

</script>


<script type="text/javascript">

     function banktotal(sno){
  

          var btotal =0;
          var btotal_diesel =0;
          var btotal_cash =0;
          var diesel_cash_amt=0;




          $(".banktotal").each(function () {
             
            if (!isNaN(this.value) && this.value.length != 0) {
              btotal_diesel += parseFloat(this.value);
            }

           });
            

          $(".banktotal_diesel").each(function () {
             
            if (!isNaN(this.value) && this.value.length != 0) {
              btotal_cash += parseFloat(this.value);
            }



           });
          

          var btotal =  parseFloat(btotal_diesel) + parseFloat(btotal_cash);

          $("#bankTotal").html(btotal.toFixed(2));

          var diesel_amt = $("#diesel_amt"+sno).val();
          var cash_amt = $("#cash_amt"+sno).val();

          if(cash_amt==''){

            var newcashamt = 0;
          }else{
            var newcashamt = cash_amt;
          }


          if(diesel_amt==''){

            var newdiesel_amt = 0;
          }else{
            var newdiesel_amt = diesel_amt;
          }
          
            
              
          var diesel_cash_amt = parseFloat(newdiesel_amt) + parseFloat(newcashamt);

          $("#bankAmt"+sno).val(diesel_cash_amt.toFixed(2));


          var banktot = $("#bankTotal").html();
          var advtot = $(".bTotal").html();

          var balncetot =   parseFloat(advtot) - parseFloat(banktot);

            $("#balnceTotal").html(balncetot.toFixed(2));


          var bTotal = $(".bTotal").html();

          $("#submidata").prop('disabled',false);

    /*if(bTotal < banktot){

      $("#errMsg").html('Expense total and bank total should be same.');
      $("#submitdata").prop('disabled',true);
      $("#submitNDown").prop('disabled',true);

    }else if(bTotal == banktot){
      $("#submitdata").prop('disabled',false);
      $("#submitNDown").prop('disabled',false);
      $("#errMsg").html('');
    }else{
      $("#errMsg").html('');
      $("#submitdata").prop('disabled',true);
      $("#submitNDown").prop('disabled',true);
    
    }*/


}


function banktotal_cash(sno){
  

          var btotal =0;
          var diesel_amt = $("#diesel_amt"+sno).val();

          $(".banktotal_diesel").each(function () {
             
            if (!isNaN(this.value) && this.value.length != 0) {
              btotal += parseFloat(this.value);
            }

            var total_amt = parseFloat(diesel_amt) + parseFloat(btotal);

            $("#bankTotal").html(total_amt.toFixed(2));

          });


        var banktot = $("#bankTotal").html();
        var advtot = $(".bTotal").html();

        var balncetot =   parseFloat(advtot) - parseFloat(banktot);

          $("#balnceTotal").html(balncetot.toFixed(2));



    var bTotal = $(".bTotal").html();

    console.log(banktot);

    if(bTotal < banktot){

      $("#errMsg").html('Expense total and bank total should be same.');
      $("#submitdata").prop('disabled',true);
      $("#submitNDown").prop('disabled',true);

    }else if(bTotal == banktot){
      $("#submitdata").prop('disabled',false);
      $("#submitNDown").prop('disabled',false);
      $("#errMsg").html('');
    }else{
      $("#errMsg").html('');
      $("#submitdata").prop('disabled',true);
      $("#submitNDown").prop('disabled',true);
    
    }


}




</script>

<script type="text/javascript">
  
  function submitAllData(pdfFlag){

     var downloadFlg = pdfFlag;

     //alert(downloadFlg);return false;

     $('#pdfYesNoStatus').val(downloadFlg);

     var vehicle_no        =  $("#vehicle_no").val();
     var driver_name       =  $("#driver_name").val();
     var driver_contact_no =  $("#driver_contact_no").val();


     if(vehicle_no==''){
     $("#vehicleno_err").html('The vehicle no field is required');
      return false;
     }else{
      $("#vehicleno_err").html('');
     }

    if(driver_name==''){
      $("#drivername_err").html('The driver name field is required');
      return false;
     }else{
      $("#drivername_err").html('');
     } 
     if(driver_contact_no==''){
      $("#driverno_err").html('The driver contact no field is required');
      return false;
     }else if(driver_contact_no < 10){
      $("#driverno_err").html('');
      $("#driverno_err").html('The driver contact no field is 10 Digit required');
     }else{
      $("#driverno_err").html('');
     }


       $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

         var data = $("#salesordertrans").serialize();
        var submitdataurl = "<?php echo url('/Transaction/Logistic/Save-Vehicle-Adhoc-Advance'); ?>";


        $.ajax({

              type: 'POST',

              url: submitdataurl,

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                console.log(data);

                    var data1 = JSON.parse(data);

                   /*if (data1.response == 'success') {

                      var url = "{{ url('/Transaction/View-vehicle-Gate-Inward-msg') }}"
                      setTimeout(function(){ window.location = url+'/savedata';});

                    }*/

                    
                    if(data1.response=='error'){
              var responseVar =false;

                var url = "{{ url('/Transaction/View-vehicle-Gate-Inward-msg') }}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

           }else{

              var responseVar =true;

              if(downloadFlg == 1){
                  
                  var fileN     = 'ADHOC_'+1;
                  var link      = document.createElement('a');
                  link.href     = data1.url;
                  link.download = fileN+'.pdf';
                  link.dispatchEvent(new MouseEvent('click'));
                }
              var url = "{{ url('/Transaction/View-vehicle-Gate-Inward-msg') }}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

          }

           
              },

          });

      
  }

</script>







<script type="text/javascript">

  /*function close*/
  /*requisition.ItemCodeGet();

  requisition.checkBlankFieldValidation();*/


 function inrFormat(val) {
  var x = val;
  x = x.toString();
  var afterPoint = '';
  if (x.indexOf('.') > 0)
    afterPoint = x.substring(x.indexOf('.'), x.length);
  x = Math.floor(x);
  x = x.toString();
  var lastThree = x.substring(x.length - 3);
  var otherNumbers = x.substring(0, x.length - 3);
  console.log(otherNumbers);
  if (otherNumbers != '')
    lastThree = ',' + lastThree;
  var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
  return res;
}
  



</script>





<script type="text/javascript">
  

  $('#account_code').on('change',function(){
      var deptCode = $(this).val();

      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });

      $.ajax({

            url:"{{ url('get-employe-data-by-department') }}",

            method : "POST",

            type: "JSON",

            data: {deptCode: deptCode},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);
                  $.each(data1.data, function(k, getData){

                    $("#emplList").empty();

                    $("#emplList").append($('<option>',{

                      value:getData.EMP_CODE,

                      'data-xyz':getData.EMP_NAME,
                      text:getData.EMP_NAME


                    }));

                  })

                }

            }

          });


  });

</script>

<script type="text/javascript">
  

   function getTruckDetails(truckNo){

      //var truckNo = $("#vehicle_no").val();
      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });

     

      $.ajax({

            url:"{{ url('get-vehicle-detials-for-adhoc-advance') }}",

            method : "POST",

            type: "JSON",

            data: {truckNo: truckNo},

             /*beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },*/

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);
                    // $("#vehicle_type").val(data1.vehicle_type.WHEEL_TYPE);        
              
                     $("#driver_name").val(data1.data.EMP_NAME);
                     $("#driver_code").val(data1.data.EMP_CODE);
                     $("#driver_contact_no").val(data1.data.MOBILE_NO);
                     $("#driver_license_no").val(data1.data.LICENSE_NO);
                     $("#driver_license_ex_dt").val(data1.data.LICENSE_EXDT);

                }

            },

            /*complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },*/

          });


  }

</script>

  
  <script type="text/javascript">
  

   function getplanDetails(){


      //var vehicle_no = $("#vehicle_no").val();

      var planNo     = $("#vehicle_plan_no").val();

      var plan_no    = planNo.split(" ");
      
      var palnno     = plan_no[2];

    

      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });


      if(planNo){


      $.ajax({

            url:"{{ url('/get-vehicle-plan-details') }}",

            method : "POST",

            type: "JSON",

            data: {planNo: planNo},

            /*beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },*/

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");


                }else if(data1.response == 'success'){


                  if(data1.data==''){
                     $("#acc_code").val('');
                     $("#acc_name").val('');
                     $("#Plant_code").val('');
                     $("#plantname").val('');
                     $("#profitctrId").val('');
                     $("#pfct_name").val('');
                     $("#vehicle_no").val('');
                     $("#from_place").val('');
                     $("#to_place").val('');
                    

                  }else{

                    var driver_name = data1.driver_data.DRIVER_NAME;
                    var driver_no = data1.driver_data.DRIVER_CONTACT_NO;

                     $("#acc_code").val(data1.data.TRANSPORT_CODE);
                     $("#acc_name").val(data1.data.TRANSPORT_NAME);
                     $("#Plant_code").val(data1.data.PLANT_CODE);
                     $("#plantname").val(data1.data.PLANT_NAME);
                     $("#profitctrId").val(data1.data.PFCT_CODE);
                     $("#pfct_name").val(data1.data.PFCT_NAME);
                     $("#vehicle_no").val(data1.data.VEHICLE_NO);
                     $("#from_place").val(data1.data.FROM_PLACE);
                     $("#to_place").val(data1.data.TO_PLACE);

                     if(driver_name){

                      $("#driver_name").val(data1.driver_data.DRIVER_NAME);
                      $('#driver_name').css('border-color','#d2d6de');

                     }

                     if(driver_no){

                      $("#driver_contact_no").val(driver_no);
                      $('#driver_contact_no').css('border-color','#d2d6de');

                      $("#submidata").prop('disabled',false);

                     }



                         var cuurnt_date = new Date().toLocaleDateString('fr-CA');

                        if(data1.vehicle_info.response == null){

                          $("#vehicleNotFoundModal").modal('show');
                          $("#vehicleageNotFoundMsg").html('<b style="text-align:center;"> Vehicle Not Found </b>');

                        

                        }

                        
                          console.log(data1.vehicle_info.response);

                          var regd_date = data1.vehicle_info.response.regnDate;

                          var explode1 =   cuurnt_date.split("-");

                          var year1 = explode1[0];

                          var explode2 =   regd_date.split("/");

                          var year2 = explode2[2];

                          var diff_date = year1 - year2;


                          var getdate = cuurnt_date.split("-");
 
                          var year = getdate[0];
                          var month = getdate[1];
                          var date =  getdate[2];

                          var currentDate =  year+"/"+month+"/"+date;

                          
                        
                       
                         /* start  fit date expired */

                          var fit_date = data1.vehicle_info.response.fitUpto;

                          if(fit_date){

                          var getfitdate = fit_date.split("/");
                           var fit_date  = getfitdate[0];
                           var fit_month = getfitdate[1];
                           var fit_year  = getfitdate[2];
                           var fitDate =  fit_year+"/"+fit_month+"/"+fit_date;

                          }else{

                          }

                          

                           /* end fit date expired */

                         
                          /* start tax date expired */

                          var tax_date = data1.vehicle_info.response.taxUpto;

                          if(tax_date){

                           var gettaxdate = tax_date.split("-");

                           var tax_date  = gettaxdate[0];
                           var tax_month = gettaxdate[1];
                           var tax_year  = gettaxdate[2];
                           var taxDate =  tax_year+"/"+tax_month+"/"+tax_date;

                          }else{

                          }

                           

                          /* end tax date expired */


                        /* start insurance date expired */

                          var insurance_date = data1.vehicle_info.response.insuranceUpto;


                          if(insurance_date){

                               var getinsudate = insurance_date.split("/");
                               var insu_date  = getinsudate[0];
                               var insu_month = getinsudate[1];
                               var insu_year  = getinsudate[2];
                               var insuranceDate =  insu_year+"/"+insu_month+"/"+insu_date;

                          }else{


                          }

                         

                         /* end insurance date expired */


                            /* start permit  date expired */

                          var permit_date = data1.vehicle_info.response.permitValidUpto;

                          if(permit_date){

                            var getpermitdate = permit_date.split("/");

                           var permit_date  = getpermitdate[0];
                           var permit_month = getpermitdate[1];
                           var permit_year  = getpermitdate[2];

                           var permitDate =  permit_year+"/"+permit_month+"/"+permit_date;
                          }else{

                          }

                            

                           /* end  permit  date expired */

                           /* start puc  date expired */

                        
                          var puccUpto = data1.vehicle_info.response.puccUpto;

                          if(puccUpto){

                            var puc_date = data1.vehicle_info.response.puccUpto;

                           var getpucdate = puc_date.split("/");

                           var puc_date  = getpucdate[0];
                           var puc_month = getpucdate[1];
                           var puc_year  = getpucdate[2];

                           var pucDate =  puc_year+"/"+puc_month+"/"+puc_date;

                          }else{


                          }

                          
                           /* start puc  date expired */

                           if(diff_date > 10){

                              $("#vehiclemsgModal").modal('show');
                              $("#vehicleageMsg").html('<b> Vehicle Is More Than 10 Years Old</b>');

                               $("#vehicle_type").val('');        
                               $("#acc_code").val('');
                               $("#acc_name").val('');
                               $("#Plant_code").val('');
                               $("#plantname").val('');
                               $("#profitctrId").val('');
                               $("#pfct_name").val('');
                               $("#vehicle_no").val('');
                               $("#from_place").val('');
                               $("#to_place").val('');
                               $("#vehicle_plan_no").val('');
                                $("#vehicle_plan_no").val('');


                           }


                    if(fitDate < currentDate){

                       $("#vehiclemsgModal").modal('show');

                       $("#vehicleageMsg").html('<b> Vehicle Fitness Certificate Is Expired </b>');

                        $("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#vehicle_plan_no").val('');

                      }else if(taxDate < currentDate){

                        $("#vehiclemsgModal").modal('show');
                        $("#vehicleageMsg").html('<b> Vehicle Tax Certificate Is Expired</b>');

                         $("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#vehicle_plan_no").val('');

                      }else if(insuranceDate  < currentDate){

                        $("#vehiclemsgModal").modal('show');

                        $("#vehicleageMsg").html('<b> Vehicle Insurance Certificate Is Expired </b>');

                         $("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#vehicle_plan_no").val('');

                      }else if(pucDate < currentDate){

                        $("#vehiclemsgModal").modal('show');

                        $("#vehicleageMsg").html('<b> Vehicle Puc Certificate Is Expired </b>');

                         $("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#vehicle_plan_no").val('');

                      }else if(permitDate < currentDate){

                        $("#vehiclemsgModal").modal('show');

                        $("#vehicleageMsg").html('<b> Vehicle Permit Certificate Is Expired </b>');

                         $("#vehicle_type").val('');        
                         $("#acc_code").val('');
                         $("#acc_name").val('');
                         $("#Plant_code").val('');
                         $("#plantname").val('');
                         $("#profitctrId").val('');
                         $("#pfct_name").val('');
                         $("#vehicle_no").val('');
                         $("#from_place").val('');
                         $("#to_place").val('');
                         $("#vehicle_plan_no").val('');
                         $("#vehicle_plan_no").val('');
                      }
                   
                  }
                }

            },
            /*complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },*/

          });

    }else{

        $("#acc_code").val('');
        $("#acc_name").val('');
        $("#Plant_code").val('');
        $("#plantname").val('');
        $("#profitctrId").val('');
        $("#pfct_name").val('');
        $("#vehicle_no").val('');
        $("#from_place").val('');
        $("#to_place").val('');
        $("#confirm_date").val('');
    }


  }

</script>


<script type="text/javascript">
   $("#series_code").bind('change', function () {
  var Seriescode =  $(this).val();
  //console.log(Seriescode);
  var xyz = $('#seriesList1 option').filter(function() {

    return this.value == Seriescode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

    $('#appndbtn').empty();
    $('#serisicon').show();
  
  if(msg=='No Match'){
     $(this).val('');
     $('#seriesName').val('');
      document.getElementById("series_code_errr").innerHTML = 'The Series code field is required.';
    
     $('#getSeriesCode').val('');
     $('#serisicon').show();
     $('#series_code').css('border-color','#d2d6de');   
     $('#series_code').css('border-color','#ff0000').focus();
     $('#vehicle_plan_no').css('border-color','#d2d6de');

  }else{
    $('#seriesName').val(msg);
     document.getElementById("series_code_errr").innerHTML = '';
     var sers_code = $('#series_code').val();
     $('#getSeriesCode').val(sers_code);
     $('#getSeriesName').val(msg);
     $('#serisicon').hide();
     $('#series_code').css('border-color','#d2d6de');
     $('#vehicle_plan_no').css('border-color','#ff0000').focus();
        
  


  }

   //objvalidtn.checkBlankFieldValidation();

});
</script>




<script type="text/javascript">
	$( window ).on( "load", function() {

    getvrnoBySeries();

    var fromdateintrans = $('#FromDateFy').val();

    var todateintrans = $('#ToDateFy').val();

    var fromdateintrans_1 = $('#FromDateFy_1').val();
    var todateintrans_1 = $('#ToDateFy_1').val();

    $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true',

      startDate:'today',

    });

    $('.partyrefdatepicker').datepicker({

      format: 'yyyy-mm-dd',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });

    var vr_date = $('#vr_date').val();
    var series_code = $('#series_code').val();
    var profitctrId = $('#profitctrId').val();
    var account_code = $('#account_code').val();
    var Plant_code = $('#Plant_code').val();
    var transcode = $('#transcode').val();
    var vrseqnum = $('#vrseqnum').val();
    var headid = $('#headid').val();

 //   alert(headid);

    if(headid){
      
      $('#head_id').val(headid);
    }

    if(transcode && vrseqnum){
        $('#getVrNo').val(vrseqnum);
        $('#getTransCode').val(transcode);
    }

    if(vr_date){
      $('#getTransDate').val(vr_date);
    }

    if(series_code){
        $('#getSeriesCode').val(series_code);
    }

    if(profitctrId){
        $('#getPfctCode').val(profitctrId);
    }

    if(account_code){
        $('#getAccCode').val(account_code);
    }

    if(Plant_code){
        $('#getPlantCode').val(Plant_code);
    }

    


});
</script>

<script type="text/javascript">
   $(document).ready(function() {
  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    orientation: 'bottom',
    todayHighlight: 'true',
    endDate:'today',
    autoclose: 'true'
  });
});

</script>

<script type="text/javascript">
	function Getqunatity(qtyId){

     var checkqty =$('#qty'+qtyId).val();
     var stockqty =$('#stockavlblevalue'+qtyId).val();
     console.log('qty',checkqty);

      if(parseFloat(checkqty) > parseFloat(stockqty)){
         console.log('error');

         $("#errmsgqty"+qtyId).html('req qty less than stock qty.').css('color','red');
         $('#qty'+qtyId).val('');
         $('#A_qty'+qtyId).val('');
          $("#submitdata").prop('disabled', true);
          $("#deletehidn").prop('disabled', true);

         
      }else{
        $("#errmsgqty"+qtyId).html('');
        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        
      }
     var gr_amt;
     if(checkqty){

         var quantity =$('#qty'+qtyId).val().replaceAll(',', '');
         var cfactor = $('#Cfactor'+qtyId).val();

         console.log('cftor',cfactor);
         var total = quantity * cfactor;
   
      if (quantity.length < 1){
        ('#qty'+qtyId).val('0.00');
        ('#A_qty'+qtyId).val('0.00');
      }else {
        var val = parseFloat(quantity);
        var formatted = inrFormat(quantity);

       /* if (formatted.indexOf('.') > 0) {
          var split = formatted.split('.');
          formatted = split[0] + '.' + split[1].substring(0, 2);
        }*/
        $('#qty'+qtyId).val(formatted);
      }

     
     $('#A_qty'+qtyId).val(total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

      if(quantity){
        $('#rate'+qtyId).prop('readonly',false);
        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);

        

      }else{
         $('#rate'+qtyId).prop('readonly',true);
         $('#A_qty'+qtyId).val(0.00);
          $("#submitdata").prop('disabled', true);
          $("#deletehidn").prop('disabled', true);
          $("#addmorhidn").prop('disabled', true);
      }

      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value.replaceAll(',', ''));

                
            }

          $("#basicTotal").val(gr_amt.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());

     }else{
      $('#A_qty'+qtyId).val(0.00);

      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value.replaceAll(',', ''));

                
            }

          $("#basicTotal").val(gr_amt.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());
     }
    



  }
</script>

<script type="text/javascript">
  
  function getvrnoBySeries(){

    var seriesCode = $('#series_code').val();
    var transcode = $('#transcode').val();



    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('get-vr-sequence-by-series') }}",

          method : "POST",

          type: "JSON",

          data: {seriesCode: seriesCode,transcode:transcode},

          success:function(data){

            var data1 = JSON.parse(data);


              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.vrno_series == ''){

                  }else{
                    if(data1.vrno_series){
                      var getlastno = data1.vrno_series.LAST_NO;
                    }else{
                      var getlastno = '';
                    }

                    if(data1.vrnodata == ''){
                      $('#vrseqnum').val(getlastno);
                      $('#getVrNo').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);
                      $('#getVrNo').val(lastNo);
                    }
                  }

              }

          }

    });

}
</script>


@endsection