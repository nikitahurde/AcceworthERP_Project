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
      Supplimentry Trip
      <small>Add Details</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('dashboard') }}">Trip Expense</a></li>
      <li><a href="{{ url('logistic/fleet-transaction') }}">Supplimentry Trip</a></li>
      <li><a href="{{ url('logistic/fleet-transaction') }}">Add Supplimentry Trip</a></li>
      </ol>
    </section>
 

   
    <section class="content">
      <div class="row">
        <div class="col-sm-12" style="padding-top: 2%;">
          <div class="box box-info Custom-Box">

            <div class="box-header with-border" style="text-align: center;">
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Supplimentry Trip (Trip Creation) </h2>

               <div class="box-tools pull-right">
              <a href="{{ url('/logistic/view-fleet-transaction') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Supplimentry Trip</a>
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

         <form action="{{url('/add-supplimentry_trans')}}" method="post">

          @csrf

          <div class="box-body">
      
            <div class="row">
        
              <div class="col-md-2">
                <div class="form-group">
                  <label>Transaction Date : <span class="required-field"></span></label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="text" class="form-control datepicker" name="date" placeholder="Enter Transaction Date" id="tr_date" value="{{ date('d-m-Y') }}">
                   
                  </div>

                  <small id="emailHelp" class="form-text text-muted">
                  {!! $errors->first('date', '<p class="help-block" style="color:red;">:message</p>') !!}
                  </small>

                </div>
        
            </div>

            <div class="col-md-2">

              <div class="form-group">

                <label> Trip No<span class="required-field"></span></label>

                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                  <input list="tripList" class="form-control" name="trip_no" value="{{ old('trip_no')}}" id="trip_no" placeholder="Enter Trip Number" onchange="getTripDetials(this.value)" style="text-transform:uppercase" >

                  <datalist id="tripList">
                    @foreach($trip_list as $rows)

                      <option value="{{ $rows->TRIP_NO }}" data-xyz="<?= $rows->VEHICLE_NO?>">{{ $rows->TRIP_NO}} - <?= $rows->VEHICLE_NO?> - <?= $rows->ACC_NAME?> - <?= $rows->TO_PLACE ?></option>

                   @endforeach
                  
                  
                  </datalist>

                </div>
                <input type="hidden" name="tripid" id="tripid">
                <small id="emailHelp" class="form-text text-muted">
                {!! $errors->first('trip_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                </small>
                <small id="invcErr" style="color: red;"></small>
            </div>
          <!-- /.form-group -->
          </div>

          <div class="col-md-2">

            <div class="form-group">
              <label>Old Vehicle No: <span class="required-field"></span></label>
              <div class="input-group">
                <span class="input-group-addon">
                <i class="fa fa-truck" aria-hidden="true"></i>
                </span>
                <input list="truckList" name="vehicle_no" id="vehicle_no" class="form-control vehiclenumup" placeholder="Enter Vehicle No" value="{{ old('vehicle_no') }}" autocomplete="off" onchange="getTripDetials(this.value)">

                <datalist id="truckList">

                  
                  @foreach($old_truck_list as $rows)

                   <option value="{{ $rows->VEHICLE_NO }}" data-xyz="<?= $rows->TRIP_NO?>">{{ $rows->TRIP_NO}} - <?= $rows->VEHICLE_NO?> - <?= $rows->ACC_NAME?> - <?= $rows->TO_PLACE ?></option>

                  @endforeach
                 
                </datalist>

              </div>
              <small id="emailHelp" class="form-text text-muted">
              {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>
            
            </div>
          </div>

           <div class="col-md-2">
              <div class="form-group">
                <label>New Vehicle No:<span class="required-field"></span></label>
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-truck" aria-hidden="true"></i>
                  </span>
                  <input list="vehicleList" name="new_vehicle_no" id="new_vehicle_no" class="form-control" placeholder="Enter New Vehicle No" value="{{ old('truck_no') }}" onchange="getVehicleDetails()">

                  <datalist id="vehicleList">

                      <?php foreach($truck_list as $key) { ?>

                         <option value="<?= $key->TRUCK_NO ?>" data-xyz="<?= $key->WHEEL_TYPE ?>"><?= $key->TRUCK_NO ?></option>

                       <?php  } ?>
                     
                   </datalist>

                  </div>
                  <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('truck_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                  </small>
                  <small id="vehicleerr"></small>
                      
              </div>
          </div>

          <div class="col-md-2">

            <div class="form-group">

              <label>From Place:  <span class="required-field"></span></label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                <input type="text" class="form-control" name="from_place" id="from_place"  value="" placeholder="Enter From Place" autocomplete="off" readonly>

               

              </div>

              <small id="emailHelp" class="form-text text-muted">

              {!! $errors->first('from_place', '<p class="help-block" style="color:red;">:message</p>') !!}

              </small>

          </div>

          <!-- /.form-group -->

          </div>

          <div class="col-md-2">

            <div class="form-group">

              <label> To Place: <span class="required-field"></span> </label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                
                  <input type="text"  id="to_place" name="to_place" class="form-control pull-left" value="" placeholder="Enter To Place" autocomplete="off" readonly>

                  
                </div> 

                <small id="emailHelp" class="form-text text-muted">

                {!! $errors->first('to_place', '<p class="help-block" style="color:red;">:message</p>') !!}

                </small>
           

          </div>

         
        </div>
           
       </div>

       <div class="row text-center" style="margin-top:2%;">
         <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp; Update</button>
         <button class="btn btn-warning" type="reset"><i class="fa fa-refresh"></i>&nbsp; Reset</button>
       </div>
        
      
      </div><!-- /.box-body -->

      </form>
  
      </div>


    </div>
     
  </div>
   
  </section>

 
 
</div>

@include('admin.include.footer')



<script type="text/javascript">

  $('#trip_no').on('input',function(){
    var invoice_no = $(this).val();
    if(invoice_no){

       var tripNo = $('#trip_no').val();
       $('#trip_no').css('border-color','#d2d6de').focus();
       document.getElementById("invcErr").innerHTML = '';
       $('#new_vehicle_no').css('border-color','#ff0000');
       $('#new_vehicle_no').prop('readonly',false);


       
    
    }else{
     
     $('#trip_no').css('border-color','#ff0000').focus();
     document.getElementById("invcErr").innerHTML = 'The invoice no filed is required';
     $('#new_vehicle_no').css('border-color','#d2d6de').focus();
     $('#new_vehicle_no').prop('readonly',true);
    }
  });

  function getTripDetials(trip_no){

    var trip_no = $('#trip_no').val();
    var vehicle_no = $('#vehicle_no').val();

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('/get-data-from-trip-head') }}",

          method : "POST",

          type: "JSON",

          data: {trip_no: trip_no,vehicle_no:vehicle_no},

         

          success:function(data){

            var data1 = JSON.parse(data);
            if(data1.response == 'success'){

              console.log('data1',data1.data);
              $('#vehicle_no').val(data1.data[0]['VEHICLE_NO']);
              $('#from_place').val(data1.data[0]['FROM_PLACE']);
              $('#to_place').val(data1.data[0]['TO_PLACE']);
              $('#trip_no').val(data1.data[0]['TRIP_NO']);

            }else if(data1.response == 'error'){

            }else{

            }
      }

    });


  }
  
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





@endsection