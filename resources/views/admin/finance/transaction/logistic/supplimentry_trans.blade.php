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
 

   <form id="salesordertrans">
      @csrf
  <section class="content">
  <div class="row">
   <!--  <div class="col-sm-2"></div> -->
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

      <div class="box-body">
      
        
         <div class="row">
        
          <div class="col-md-2">
          <div class="form-group">
            <label>
            Transaction Date : 
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="text" class="form-control datepicker" name="date" placeholder="Enter Transaction Date" id="tr_date" value="{{ date('d-m-Y') }}">
              <?php 
              $diesel_rate_date = $diesel_rate->DATE;
              $dt = date("d-m-Y", strtotime($diesel_rate_date)); ?>
              <input type="hidden" name="diesel_rate_date" id="diesel_rate_date" value="<?= $dt ?>">
            </div>
              <small id="emailHelp" class="form-text text-muted">
              {!! $errors->first('date', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>

          </div>
          <!-- /.form-group -->
          </div>

          
          <div class="col-md-2">
          <div class="form-group">
            <label>
            Trip No 
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
              <input list="tripList" class="form-control" name="trip_no" value="{{ old('trip_no')}}" id="trip_no" placeholder="Enter Trip Number" style="text-transform:uppercase" onchange="getplanDetails(this.value)" autocomplete="off">

              <datalist id="tripList">
              <?php foreach($trip_list as $key) {

                    $vrNo = $key->VRNO;
                    
                    $SericeCode = $key->SERIES_CODE;
                    
                    $FyYr = $key->FY_CODE;
                    
                    $getYr = explode("-",$FyYr);
                    
                    $BgYr = $getYr[0];
                    
                    $newVrNo = $BgYr.' '.$SericeCode.' '.$vrNo; 


                ?>
                
                <option value="<?= $newVrNo; ?>"><?= $newVrNo; ?></option>
              <?php  } ?>
              
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
            <label>
            Old Vehicle No: 
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-truck" aria-hidden="true"></i>
              </span>
             <input list="truckList" name="vehicle_no" id="vehicle_no" class="form-control vehiclenumup" placeholder="Enter Vehicle No" value="{{ old('vehicle_no') }}" autocomplete="off">

             <datalist id="truckList">

              <?php foreach($truck_list as $key) { ?>

               <option value="<?= $key->TRUCK_NO ?>" data-xyz="<?= $key->WHEEL_TYPE ?>"><?= $key->TRUCK_NO ?></option>

               <?php  } ?>
             
             </datalist>

            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          </div>

           <div class="col-md-2">
                    <div class="form-group">
                      <label>
                        New Vehicle No: 
                        <span class="required-field"></span>
                      </label>
                      <div class="input-group">
                          <span class="input-group-addon">
                            <i class="fa fa-truck" aria-hidden="true"></i>
                          </span>
                       <input list="vehicleList" name="new_vehicle_no" id="new_vehicle_no" class="form-control vehiclenumup" placeholder="Enter New Vehicle No" value="{{ old('truck_no') }}" onchange="getVehicleDetails()">

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

                      <label>

                        Transporter Code: 

                        <span class="required-field requiredhide"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input list="transportList" class="form-control" name="transporter_code"  value="" id="transporter_code" placeholder="Enter Transporter" autocomplete="off">

                            <datalist id="transportList">

                              <?php foreach ($transport_list as $key) { ?>
                                
                                <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_CODE ?> [<?= $key->ACC_NAME ?>]</option>

                              <?php } ?>

                               <option value="">--SELECT--</option>
                              
                            </datalist>


                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('transporter_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Transporter Name: 

                        <span class="required-field requiredhide"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control" name="transporter_name" id="transporter_name"  value="" placeholder="Enter Transporter" autocomplete="off" readonly="">

                            

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('transporter', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
            <!-- /.col -->
            

            

         
        <!-- /.col -->


          
        <!-- /.col -->

          
        
        </div>
        <!-- /.row -->

        <div class="row">

          <div class="col-md-2">

            <div class="form-group">

              <label>Series Code: 

              <span class="required-field"></span>

              </label>

              <div class="input-group">

              <span class="input-group-addon" style="padding: 1px 7px;">
                 <i class="fa fa-newspaper-o" aria-hidden="true" id="serisicon"></i>

                <div class="" id="appndbtn">
                  
                </div>
              </span>
               
              <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

              <datalist id="seriesList1">

               

              </datalist>

              </div>

              <small id="series_code_errr" style="color: red;"></small>

            </div>
            <!-- /.form-group -->
            </div>
            <!-- /.col -->

            <div class="col-md-3">

            <div class="form-group">

              <label> Series Name : </label>

              <div class="input-group">

                <div class="input-group-addon">

                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                </div>


                <input type="text" class="form-control" name="series_name" value="" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

              </div>

            </div>
            
            </div>
          <div class="col-md-2">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                               </span>
                            
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="" readonly autocomplete="off" onchange="PlantCode()">

                              <datalist id="PlantcodeList">

                                

                              </datalist>

                            </div>

                            <small>  

                                <div class="pull-left showSeletedName" id="plantText"></div>

                            </small>

                            <small id="plant_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Plant Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="plant_name" value="" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                       <div class="col-md-2">

                        <div class="form-group">

                          <label>Profit Center Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                              <input type="text"  id="profitctrId" name="pfct_code" class="form-control  pull-left" placeholder="Select Profit Center Code"  readonly >


                            </div>

                          <small id="profit_center_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                       

          


        </div>

        <div class="row">

          <div class="col-md-3">

                        <div class="form-group">

                          <label> Profit Center Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="pfct_name" id="pfctName" placeholder="Enter Profit Center Name" readonly>

                            </div>

                        </div>
                        
                    </div>
                     <div class="col-md-2">

                        <div class="form-group">

                          <label> Customer Code : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="customer_code" id="customer_code" placeholder="Enter Customer Code" readonly>

                            </div>

                        </div>
                        
                    </div>
          <div class="col-md-3">

                        <div class="form-group">

                          <label> Customer Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="customer_name" id="customer_name" placeholder="Enter Customer Name" readonly>

                            </div>

                        </div>
                        
                    </div>

          

          <div class="col-md-2">

          <div class="form-group">

            <label>

             From Place: 

            <span class="required-field"></span>

            </label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

              <input list="fromplaceList" class="form-control" name="from_place" id="from_place"  value="" placeholder="Enter From Place" autocomplete="off"/>

              <datalist id="fromplaceList">

              <?php foreach ($area_list as $key) { ?>

                <option value="<?= $key->AREA_CODE ?>" data-xyz="<?= $key->AREA_NAME ?>"><?= $key->AREA_CODE ?> [<?= $key->AREA_NAME ?>]</option>

              <?php } ?>
              
              
              </datalist>

            </div>

            <small id="emailHelp" class="form-text text-muted">

            {!! $errors->first('from_place', '<p class="help-block" style="color:red;">:message</p>') !!}

            </small>

          </div>

          <!-- /.form-group -->

          </div>

          <div class="col-md-2">

          <div class="form-group">

            <label>

            To Place: 

            <span class="required-field"></span>

            </label>

            <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>


              <input list="toplaceList"  id="to_place" name="to_place" class="form-control pull-left" value="" placeholder="Enter To Place" autocomplete="off" readonly>

               <datalist id="toplaceList">

              <?php foreach ($area_list as $key) { ?>

                <option value="<?= $key->AREA_CODE ?>" data-xyz="<?= $key->AREA_NAME ?>"><?= $key->AREA_CODE ?> [<?= $key->AREA_NAME ?>]</option>

              <?php } ?>
              
              
              </datalist>
            </div> 

            <small id="emailHelp" class="form-text text-muted">

            {!! $errors->first('to_place', '<p class="help-block" style="color:red;">:message</p>') !!}

            </small>
             <small>
              <!-- <div class="pull-left showSeletedName" id="makeText"></div> -->
            </small>

          </div>

         
        </div>

       <!--  <div class="col-md-2">
          <div class="form-group">
            <label>
             Vehicle Inward No:  
            <span class="required-field"></span>
            </label>
          <div class="input-group">
             <div class="input-group-addon">
              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
             </div>
            <input list="vehicleInward" name="vehicle_inward_no" id="vehicle_inward_no" class="form-control" placeholder="Enter Inward No" value="{{ old('vehicle_inward_no')}}" onchange="getTruckDetails()" readonly="">

            <datalist id="vehicleInward">
            <?php foreach($vehicle_list as $key) { 



                $vrNo = $key->VRNO;
                
                $SericeCode = $key->SERIES_CODE;
                
                $FyYr = $key->FY_CODE;

                $getYr = explode("-",$FyYr);

                $BgYr = $getYr[0];

                $newVrNo = $BgYr.' '.$SericeCode.' '.$vrNo;


               


              ?>

              <option value="<?= $newVrNo ?>"><?= $newVrNo ?></option>

             <?php  } ?>
             
            </datalist>
           </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('vehicle_inward_no', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            <small id="vehicleinwardErr" style="color: red;"></small>
           
           
          </div>
          </div> -->

           

          

         
        
        
        </div>
         
        <div class="row">


          <div class="col-md-2">
          <div class="form-group">
            <label>
             TRIP Type: 
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </span>
             <input  list="triptypeList" name="trip_type" class="form-control" placeholder="Enter TRIP Type"  id="trip_type">

             <datalist id="triptypeList">
                <option value="UP">UP</option>
                <option value="DOWN">DOWN</option>
             </datalist>

            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('wheel_type', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          </div>
          <div class="col-md-2">

           <div class="form-group">
            <label>
             Model : 
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
              </span>
             <input type="text" id='model' name="model" readonly="" class="form-control"  >
            </div>
            
            
           </div>
            
          
        
         </div>

           <div class="col-md-2">
           

          <div class="form-group">
            <label>
            Load Capacity : 
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
              </span>
             <input type="text" id='loadcpct' name="loadcpct" class="form-control" readonly="" >
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
           </div>
         </div>

         

           <div class="col-md-2">

          <div class="form-group">
            <label>
             Load Avg :  
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
              </span>
             <input type="text" id='loadAvg' name="loadAvg" readonly="" class="form-control"  >
            </div>
            
           </div>

          </div>

           <div class="col-md-2">
           <div class="form-group">
            <label>
            U/L Capacity : 
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
              </span>
             <input type="text" id='ulcpct' name="ulcpct" class="form-control" readonly="" >
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('ulcpct', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
           </div>
         </div>

         

           <div class="col-md-2">

          <div class="form-group">
            <label>
             U/L Avg :  
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
              </span>
             <input type="text" id='ulAvg' name="ulAvg" readonly="" class="form-control"  >
            </div>
            
           </div>

          </div>


          
         
         
           
        
        </div>

        <div class="row">
           <div class="col-md-2">
           
          <div class="form-group">
            <label>
             Empty Avg :  
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
              </span>
             <input type="text" id='emptyAvg' name="emptyAvg" readonly="" class="form-control"  >
            </div>
            
           </div>

          
          </div>
            <div class="col-md-2">
          <div class="form-group">
            <label>
            Driver Name: 
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-user" aria-hidden="true"></i>
              </span>
             <input name="driver_name" id="driver_name" class="form-control" placeholder="Enter Driver Name" value="{{ old('driver_name') }}">
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('driver_name', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          </div>
         

          <div class="col-md-2">
          <div class="form-group">
            <label>
            Diesel Rate 
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
              <input type="text" class="form-control" name="diesel_rate" id="diesel_rate" value="{{ old('diesel_rate')}}" placeholder="Enter Diesel Rate" readonly=""> 
            </div>
              <small id="emailHelp" class="form-text text-muted">
              {!! $errors->first('diesel_rate', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>
          </div>
          <!-- /.form-group -->
          </div>

          <div class="col-md-2">
          <div class="form-group">
            <label>
            Route Code 
            <span class="required-field"></span>
            </label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
              <input list="routeList" class="form-control" name="route_code" id="route_code"  placeholder="Enter Route Code" onchange="getRouteDetails()"> 

              <datalist id="routeList">

              <?php foreach ($route_list as $key) { ?>

                <option value="<?= $key->ROUTE_CODE ?>" data-xyz="<?= $key->ROUTE_CODE ?>"><?= $key->ROUTE_CODE ?></option>

              <?php }  ?>
              
              </datalist>
            </div>
              <small id="emailHelp" class="form-text text-muted">
              {!! $errors->first('route_code', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>
          </div>
          <!-- /.form-group -->
          </div>

        <div class="col-md-3">
            <div class="form-group">
              <label>
              Route Name 
              <span class="required-field"></span>
              </label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                <input list="routeList" class="form-control" name="route_name" id="route_name" value="{{ old('route_name')}}" placeholder="Enter Route Name" onchange="getRouteDetails()"> 

                <datalist id="routeList">

                
                </datalist>
              </div>
                <small id="emailHelp" class="form-text text-muted">
                {!! $errors->first('route_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                </small>
            </div>
          <!-- /.form-group -->
          </div>


        
          
        </div>

       
        <!-- /.row -->

        <div class="row">

            <div class="col-md-2">
            <div class="form-group">
              <label>
              Owner 
              <span class="required-field"></span>
              </label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                <input type="text" class="form-control" name="owner_type" id="owner_type"  placeholder="Enter Owner Name" readonly=""> 

                
              </div>
                <small id="emailHelp" class="form-text text-muted">
                {!! $errors->first('owner_type', '<p class="help-block" style="color:red;">:message</p>') !!}
                </small>
            </div>
          <!-- /.form-group -->
          </div>

          

           <div class="col-md-3">
          <div class="form-group">
             <label>
              &nbsp;
            
            </label>
             <div class="input-group">

              <input type="radio" class="optionsRadios1" name="point_delivery" value="single point" checked="">&nbsp;&nbsp;<span style="font-weight: 700 !important;font-size: 12px !important;">Single Point Del.</span> &nbsp;&nbsp;

              <input type="radio" class="optionsRadios1" name="point_delivery" id="doublepoint" value="double point" >&nbsp;&nbsp<span style="font-weight: 700 !important;font-size: 12px !important;">Double Point Del.<span>



            </div>

              <small id="emailHelp" class="form-text text-muted">
              {!! $errors->first('trip_no', '<p class="help-block" style="color:red;">:message</p>') !!}
              </small>
              <small id="invcErr" style="color: red;"></small>
          </div>
          <!-- /.form-group -->
          </div>
          
        </div>

      </div><!-- /.box-body -->


      
       
      </div>


    </div>
     
  </div>
   
  </section>

  <section class="content">
  <div class="row">
   <!--  <div class="col-sm-2"></div> -->
    <div class="col-sm-12">
     <div class="box box-warning Custom-Box">
     
      
         <div class="box-body">
        <div class="row">
        <div class="col-md-12">
          <p style="font-weight: bold;font-size: 12px;">ITEM/DO DETAILS</p>
        </div>
          <div class="col-md-12">
          
          
           <div class="table-responsive">

            <div class="boxer"  id="itemTable">
            
               <div class='box-row'><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DO DATE</div><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>ITEM NAME</div><div class='box10 texIndbox1'>QTY</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>LR DATE</div></div>
              

             </div>
           
            
             <div id="totalqty" style="float:right;margin-top:10px;"></div>
           </div>

           
          </div>

        </div>
         </div>
      
         

     </div>
     
     </div>
   </div>
  </section>


  <style type="text/css">
  /* DivTable.com */
.divTable{
  display: table;
  width: 100%;
}
.divTableRow {
  display: table-row;
}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
}
.divTableCell, .divTableHead {
  border: 1px solid #999999;
  display: table-cell;
  padding: 4px 10px;
  text-align: center;
  /*font-weight: bold;*/
  font-size:12px;
  

}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
  font-weight: bold;
}
.divTableFoot {
  background-color: #EEE;
  display: table-footer-group;
  font-weight: bold;
}
.divTableBody {
  display: table-row-group;
}
</style>
<!-- start enquiry vendor--->

<!-- <section class="content" style="margin-top: -10%;">

    <div class="row">



      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

          <div class="row">
            <div class="col-md-12">
          <p style="font-weight: bold;font-size: 12px">ROUTE DETAILS</p>
        </div>
          </div>    


   <div class="divTable">
    <div class="divTableBody1 box-row">

       <div class="divTableRow trrowget">
        
        <div class="divTableCell"></div>
        <div class="divTableCell" style="font-weight:bold;">Sr.No</div>
        <div class="divTableCell" style="font-weight:bold;">VEHICLE</div>
        <div class="divTableCell" style="font-weight:bold;">SOURCE</div>
        <div class="divTableCell" style="font-weight:bold;">DESTINATION</div>
        <div class="divTableCell" style="font-weight:bold;">KMS</div>
        <div class="divTableCell" style="font-weight:bold;">TOLL</div>
        <div class="divTableCell" style="font-weight:bold;">EXTRA KMS</div>
        <div class="divTableCell" style="font-weight:bold;">LESS KMS</div>
        <div class="divTableCell" style="font-weight:bold;">EXTRA TOLL</div>
        
      </div>




    </div>
  </div> 

      

 <div class="divTable">
    <div class="divTableBody box-row">
      <div class="divTableRow trrowget">
        
        <div class="divTableCell"></div>
        <div class="divTableCell" style="font-weight:bold;">Sr.No</div>
        <div class="divTableCell" style="font-weight:bold;">VEHICLE</div>
        <div class="divTableCell" style="font-weight:bold;">SOURCE</div>
        <div class="divTableCell" style="font-weight:bold;">DESTINATION</div>
        <div class="divTableCell" style="font-weight:bold;">KMS</div>
        <div class="divTableCell" style="font-weight:bold;">TOLL</div>
        <div class="divTableCell" style="font-weight:bold;">EXTRA KMS</div>
        <div class="divTableCell" style="font-weight:bold;">LESS KMS</div>
        <div class="divTableCell" style="font-weight:bold;">EXTRA TOLL</div>
        
      </div>

   

     <div class="divTableRow rowcount TextBoxesGroup_1 trrowget">

          <div class="divTableCell">
            <div class='TextBoxesGroup'>
            <div id="TextBoxDiv1">
              
            <input type="checkbox" class="casecheck" id="tablesecnd1">
            </div>
          </div>
        </div>
      
            <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <span id="snumtwo1">1.</span>
              </div>
            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">

              <input list="vehicleList1" id='vehicle_type1'  style="width: 103px;" name="vehicle_type[]" onchange="getRoute(1)">
             
              <datalist id="vehicleList1">
                
                </datalist>
              </div>
              

            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1" class="tooltips">
              <input list="fromList1" id='source_code1' value="" name="source_code[]"  style="width: 100px;" readonly="">

              <datalist id="fromList1">
                
              </datalist>

              <small class="tooltiptext tooltiphide" id="accountNameTooltip1"></small>
              </div>
            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='textbox' id='destination_code1' value="" name="destination_code[]" style="width: 100px;" readonly="">
              </div>
            </div></div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='textbox' class="getkmtotal" id='km1' value="" name="km[]" style="width: 100px;" maxlength="10" readonly="">

              <input type='text' class="getdiesel" id='diesel1' value="" name="diesel[]" style="width: 100px;" maxlength="10" readonly="">

            
              
              </div>
            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='textbox' id='toll1'  value="" name="toll[]" style="width: 100px;" maxlength="10" readonly="">
              </div>
            </div>
          </div>

          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='textbox' id='extra_km1' value="" name="extra_km[]" style="width: 100px;" maxlength="10" readonly="">
              </div>
            </div>
          </div>
          <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='textbox' id='less_km1' value="" name="less_km[]" style="width: 100px;" maxlength="10" readonly="">
              </div>
            </div>
          </div>
            <div class="divTableCell"><div class='TextBoxesGroup'>
              <div id="TextBoxDiv1">
              <input type='textbox' id='extra_toll1' value="" name="extra_toll[]" style="width: 100px;" maxlength="10" readonly="">

              <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="text" name="totalkm" id="totalkm">
                    <input type="text" name="totaldiselcal" id="totaldiselcal">
                   <input type="text" name="fullLoadkm" id="fullLoadkm">
              </div>
            </div>
          </div>



         
    
    </div> 

    

 </div>
<div class="divTablebtn"></div>
 </div>
 <div class="col-md-12"></div><br>
  <div class="row">
      <div class="col-md-12">



    <button type="button" class='btn btn-danger btn-sm removeBtntbl' id="removeButton"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

    <button type="button" class='btn btn-primary btn-sm' id="addButton"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;" ></i>&nbsp; Add More</button>
    
    <input type="hidden" name="dublicateName" id="dublicateName">


    </div>

  </div>  
    
       

    </div>


        </div>
      </div>
    </div>  
</section> -->


  <section class="content">
  <div class="row">
    <div class="col-md-12">

      <div class="box box-primary Custom-Box">
      
         <div class="box-body">
        <div class="row">
        <div class="col-md-12">
          <p style="font-weight: bold;font-size: 12px">ROUTE DETAILS</p>
        </div>
          <div class="col-md-12">
            
          
           <div class="table-responsive">

            <div class="boxer"  id="bodyTable">
            
              <div class='box-row' id="hidebodytable"><div class='box10 texIndbox1'>&nbsp;</div><div class='box10 texIndbox1'>SR.NO</div><div class='box10 texIndbox1'>VEHICLE</div><div class='box10 texIndbox1'>SOURCE</div><div class='box10 texIndbox1'>DESTINATION</div><div class='box10 texIndbox1'>KMS</div><div class='box10 texIndbox1'>TOLL</div><div class='box10 texIndbox1'>EXTRA KMS</div><div class='box10 texIndbox1'>LESS KMS</div><div class='box10 texIndbox1'>EXTRA TOLL</div></div>
                
             </div>
            

           </div>

          </div>

              <input class="credittotldesn inputboxclr" type="hidden" name="totalkm" id="totalkm">
            <input type="hidden" name="totaldiselcal" id="totaldiselcal">
            <input type="hidden" name="fullLoadkm" id="fullLoadkm">
        </div>
         </div>
      </div>
    </div>

    
  </div>

   </section>
 

  <section class="content" style="margin-top: -10%;">

  <div class="row">

    <div class="col-sm-12">

    <div class="box box-primary Custom-Box">



      <div class="box-body">

      

      <div class="col-sm-6" id="expenseTable">

          

        <div class="">

        <table class="table tdthtablebordr " border="1" cellspacing="0" id="tbledata">



          <input type ="hidden" name="comp_name" id="getCompName">
          <input type ="hidden" name="fy_year" id="getFyYear">
          <input type ="hidden" name="trans_date" id="getTransDate">
          <input type ="hidden" name="vr_no" id="getVrNo">
         <!--  <input type ="hidden" name="trans_code" id="getTransCode"> -->
         <!--  <input type ="hidden" name="departCode" id="getAccCode">

          <input type ="hidden" name="departName" id="getDeptName">
          <input type ="hidden" name="pfct_code" id="getPfctCode">
          <input type ="hidden" name="pfct_name" id="getPfctName">
          <input type ="hidden" name="plant_code" id="getPlantCode">
          <input type ="hidden" name="plant_name" id="getPlantName">
          <input type ="hidden" name="series_code" id="getSeriesCode">
          <input type ="hidden" name="series_name" id="getSeriesName">
          <input type ="hidden" name="tax_code" id="getTaxCode">
          <input type="hidden" name="due_days" id="gateduedays">
          <input type="hidden" name="getdue_date" id="gateduedate">
          
          <input type ="hidden" name="party_ref_no" id="getpartyrfNo">
          <input type ="hidden" name="party_ref_date" id="getpartyrfDate">
          <input type ="hidden" name="consine_code" id="getcosine">
          <input type ="hidden" name="rfhead1" id="getrfhead1">
          <input type ="hidden" name="rfhead2" id="getrfhead2">
          <input type ="hidden" name="rfhead3" id="getrfhead3">
          <input type ="hidden" name="rfhead4" id="getrfhead4">
          <input type ="hidden" name="rfhead5" id="getrfhead5">
          <input type ="hidden" name="rfhead5" id="getrfhead5">

          <input type="hidden" name="cost_code" id="cost_code"> -->


          <input type="hidden" name="comp_name" value="<?php echo Session::get('company_name'); ?>">
          <input type="hidden" name="fiscal_year" value="<?php echo Session::get('macc_year'); ?>">
         
             <thead>
               <th colspan="5" class="text-center"><button type="button" onclick="getExpenseData()" id="expenseid" class="btn btn-primary btn-sm" style="float:left;" disabled> <i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 11px;"></i> &nbsp; &nbsp;GET EXPENSE</button> EXPENSE DETAILS </th>
                
            </thead>


            <thead>
             <!--  <th>&nbsp;</th> -->
              <th>SR.NO</th>
              <th>INDICATOR</th>
              <th>GL CODE</th>
              <th>AMT</th>
             
            </thead>

         


          <tr class="useful expenseBody">



          <td class="tdthtablebordr" style='text-align: center !important;'>
            <input type='checkbox' class='case' id="firstrow" disabled="" />
          </td>

          <!-- <td class="tdthtablebordr">
            <span id='snum' style="width: 10px;">1.</span>
          </td> --> 
           
          <td class="tdthtablebordr" style="text-align: center;width: 25px;">
            <div class="input-group">
            <input list="IndList1" class="inputboxclr SetInCenter" style="width: 105px;line-height: 0.1;margin-left: 4px;" id='indicator1' name="indicator[]" onchange="getIndDetails(1)" readonly/>

              <datalist id="IndList1">

                
              </datalist>
            </div>
            
          </td>

          

          <td class="tdthtablebordr tooltips" style="text-align: center;">

            <input type="text" class="inputboxclr getAccNAme" style="width: 100px;line-height: 0.1;" id='gl_code1' name="gl_code[]" readonly="" />


              
            <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>
            
          </td>

          <td class="tdthtablebordr" style="text-align: center;">

            <div style="display: inline-flex;border: none;">

            <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate basicamt"  id='Amt1' name="Amt[]" readonly="" style="width: 100px;text-align: right;line-height: 0.1;"/>
        
            </div>
             <div><small id="errmsgqty1"></small></div>

          </td>

          

          </tr>

         

        </table>
         
        

        </div><!-- /div -->
         <div class="row">

          <div class="col-md-12">
           <div style="margin-left: 72%;">  <label> Total  : </label> <span id='bTotal' class="bTotal"></span></div>
           <input type="hidden" name="dubindicator" id="dubindicator">
           </div>

         
        </div>

        <button type="button" class='btn btn-danger btn-sm delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

      <button type="button" class='btn btn-info btn-sm addmore' id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>




      </div>

     

                    
    

    <div class="col-sm-6" id="marketTable">
        
        <div class="">


              <div style="height:23px;font-weight: bold;padding-top: 12px;font-size:12px;text-align: center;background-color: #b8daff;">
                 ADVANCE
              </div>
              <div id="dublicateerr" style="color: red;text-align: center;"></div>
            <div class="boxer" id="bodyTable1">

                 
               <div class='box-row' style="background-color: #b8daff;">
                <div class='box10 texIndbox1'>PAYMENT TYPE</div>
                <div class='box10 texIndbox1'>ADAVANCE PERCENT</div>
                <div class='box10 texIndbox1'>ADAVANCE AMOUNT</div>
               </div>

               <input type="hidden" name="bankCodeDup" id="bankCodeDup">
               
              
              <div class='box-row'>
                
                <div class='box10 texIndbox1'>
                  <input list="paymentList" class="inputboxclr SetInCenter" style="width: 105px;line-height: 0.1;" id='payment_type' name="payment_type"  autocomplete='off'/>
                  <datalist id="paymentList">

                    <option value="UPI PAYMENT">UPI PAYMENT</option>
                    <option value="RTGS">RTGS</option>
                    <option value="NEFT">NEFT</option>
                    
                  </datalist>
               </div>
                <div class='box10 texIndbox1'> 
                <input type="text" class="inputboxclr SetInCenter" style="width: 105px;line-height: 0.1;text-align:right;" id='adv_rate' name="adv_rate"  autocomplete='off'/>
                </div>
                <div class='box10 texIndbox1'> 
                <input type="text" class="inputboxclr SetInCenter getqtytotal adv_amount" style="width: 105px;line-height: 0.1;text-align:right;" id='adv_amount' name="adv_amount"  autocomplete='off'  oninput="advamtcal();"/>
                </div>
              </div>

             </div>
           
            

        

        </div><!-- /div -->

        <div class="row">

            <div class="col-md-12">
           <div style="margin-left: 72%;margin-top: 15px;">  <label> Total  : </label> <span class='bTotal' ></span></div>
           
           </div>

         
        </div>


      </div>


      <div class="col-sm-6">
        
        <div class="">


              <div style="height:23px;font-weight: bold;padding-top: 12px;font-size:12px;text-align: center;background-color: #b8daff;">
                 PAYMENT MODE
              </div>
              <div id="dublicateerr" style="color: red;text-align: center;"></div>
            <div class="boxer" id="bodyTable1">

                 
               <div class='box-row' style="background-color: #b8daff;">
                <div class='box10 texIndbox1'>CODE</div>
                <div class='box10 texIndbox1'>NAME</div>
                <div class='box10 texIndbox1'>AMT</div>
               </div>

               <input type="hidden" name="bankCodeDup" id="bankCodeDup">
               
              <?php $sr=1; for ($i=0; $i < 4 ; $i++) {  ?>
              <div class='box-row'>
                <div class='box10 texIndbox1'>
                 <input list="bankList<?= $sr ?>" class="debitcreditbox dr_amount inputboxclr SetInCenter"  id="bank_code<?= $sr ?>" name="bank_code[]"  style="width: 80px" onchange="bankName(<?= $sr ?>);"  autocomplete='off'/>

                  <datalist id="bankList<?= $sr ?>">
                  
                  <?php foreach ($bank_list as $key) { ?>
                    
                    <option value="<?= $key->BANK_CODE; ?>" data-xyz="<?= $key->BANK_NAME; ?>"><?= $key->BANK_CODE; ?></option>

                  <?php } ?>

                  </datalist>
               </div>
                <div class='box10 texIndbox1'>
                <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter"  id='bank_name<?= $sr ?>' name="bank_name[]"  style="width: 140px" autocomplete='off'/>
               </div>
                <div class='box10 texIndbox1'> 
                <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter banktotal" oninput="banktotal(<?= $sr ?>)"  id='bankAmt<?= $sr ?>' name="bankAmt[]"  autocomplete='off' style="width: 80px"/>
                </div>
              </div>

              <?php $sr++; } ?>
             </div>
           
            

        

        </div><!-- /div -->

        <div class="row">

          <div class="col-md-12">
           <div style="margin-left: 66%;margin-top: 15px;">  <label> Total  : </label> <span id='bankTotal'></span>
           </div>
           </div>
         
        </div>


      </div>

        <div id="errMsg" style="text-align: right;color: red;margin-right: 167px;"></div>
       

         
      


    
   

    <br>
      

     

   
  </div><!-- /.box-body -->

  <div class="row" style="line-height:7">

     <p class="text-center">

        <button class="btn btn-success btn-sm" type="button" id="submitdata" disabled="" onclick="submitAllData(0)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

        <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

       <!--  <button class="btn btn-success btn-sm" type="button" id="submitdata" disabled="" onclick="submitData()"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button> -->

        <button class="btn btn-success btn-sm" type="button" onclick="submitAllData(1)" id="submitNDown"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save &amp; Download</button>

           <input type="hidden" id="donwloadStatus" name="donwloadStatus" value="">

       </p>
    
    </div>

</div>

</div>

</div>

</section>




  <!-- <section class="content">
  <div class="row">
   
    <div class="col-sm-9">
    <div class="box box-success Custom-Box" style="width: 104% !important;">
    
      <div class="box-body">
       <div class="row">
         
          <div class="col-md-4">
           <div class="form-group">
            <label>
            Driver Exp : 
            
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
              </span>
             <input type="number" name="drv_exp" class="form-control" id="a2" placeholder="Enter Driver Exp" value="{{ old('drv_exp') }}" onfocusout='calculate()'>
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('drv_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          
          </div>

          <div class="col-md-4">
           <div class="form-group">
            <label>
            Fooding Exp: 
            
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
              </span>
             <input type="number" name="fooding" class="form-control" placeholder="Enter Fooding Exp" value="{{ old('fooding') }}" onfocusout='calculate()' id="a4">
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('fooding', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          
          </div>

          <div class="col-md-4">
           <div class="form-group">
            <label>
            Admin Exp : 
            
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
              </span>
             <input type="number" name="p_exp" class="form-control" placeholder="Enter Admin Exp" value="{{ old('p_exp') }}" id="a3" onfocusout='calculate()'>
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('p_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
           <div class="form-group">
            <label>
            U-Loading Exp : 
            
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
              </span>
             <input type="number" name="lu_exp" class="form-control" placeholder="Enter LU Exp" value="{{ old('lu_exp') }}" onfocusout='calculate()' id="a5">
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('lu_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          
          </div>


          <div class="col-md-4">
           <div class="form-group">
            <label>
            Toll Exp: 
            
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
              </span>
             <input type="number" name="toll" class="form-control" placeholder="Enter Toll Exp" value="{{ old('toll') }}" id="a6" onfocusout='calculate()'>
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('toll', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          
          </div>

        
          <div class="col-md-4">
           <div class="form-group">
            <label>
            Diesel Exp: 
            
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
              </span>
             <input type="number" name="Disel" class="form-control" id="a1" placeholder="Enter Diesel Exp" value="{{ old('Disel') }}" onfocusout='calculate()'>
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('Disel', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
           
          </div>
        </div>  

        <div class="row">
          <div class="col-md-4">
           <div class="form-group">
            <label>
             Other Exp : 
             
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
              </span>
             <input type="number" name="other_exp" class="form-control" placeholder="Enter Other Exp" value="{{ old('other_exp') }}" id="a7" onfocusout='calculate()'>
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('other_exp', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
           
          </div>

          <div class="col-md-4">
           <div class="form-group">
            <label>
             Total Adv : 
            
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-calculator" aria-hidden="true"></i>
              </span>
             <input type="number" name="total_adv" class="form-control" placeholder="Enter Total Adv" value="{{ old('total_adv') }}" id="TOTAL" readonly>
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('total_adv', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          
          </div>

          <div class="col-md-4">
           <div class="form-group">
            <label>
             Meter Reading : 
            
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-tachometer" aria-hidden="true"></i>
              </span>
             <input type="text" name="METER_READING" class="form-control" placeholder="Enter Meter Reading" value="{{ old('METER_READING') }}" id="meter_reading">
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('METER_READING', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          
          </div>
        
        </div>
      </div>
    </div>
    </div>

    <div class="col-sm-3">
    <div class="box box-success Custom-Box">
      
      <div class="box-body">
      <div class="row">

        <div class="col-md-3" style="width: 100%;">
           <div class="form-group">
            <label>
             Diesel Cr : 
            
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-flask" aria-hidden="true"></i>
              </span>
             <input type="text" name="DIESEL_CR" class="form-control" placeholder="Enter Diesel Cr" value="{{ old('DIESEL_CR') }}" id="diesedl_cr">
            </div>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('DIESEL_CR', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          
          </div>
        </div>

        <div class="row">
          <div class="col-md-3" style="width: 100%;">
           <div class="form-group">
            <label>
             Diesel Slip No : 
             
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-file" aria-hidden="true"></i>
              </span>
             <input type="text" name="deisel_slip_no" class="form-control" placeholder="Enter Diesel Slip No" value="{{ old('deisel_slip_no') }}" id="diesel_slip_no">
            </div>
            <small id="enterslipnomsg"></small>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('deisel_slip_no', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
          
          </div>
        </div>

        <div class="row">
          <div class="col-md-3" style="width: 100%;">
           <div class="form-group">
            <label>
             Diesel Qty : 
            
            </label>
            <div class="input-group">
              <span class="input-group-addon">
              <i class="fa fa-tachometer" aria-hidden="true"></i>
              </span>
             <input type="text" name="diesel_qty" class="form-control" placeholder="Enter Diesel Qty" value="{{ old('diesel_qty') }}" id="diesel_qty">
            </div>
            <small id="filerrormsg"></small>
            <small id="emailHelp" class="form-text text-muted">
            {!! $errors->first('diesel_qty', '<p class="help-block" style="color:red;">:message</p>') !!}
            </small>
            
          </div>
           
          </div>
        </div>
        
      </div>
      </div>
    </div>
    
  </div>
   
  </section> -->


  <!-- <div class="box-body">
    <div style="text-align: center;margin-top: -4%;
  margin-bottom: 5%;">
           <button type="Submit" class="btn btn-primary" id="hidesubmitbtn">
          <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 
           </button>
     </div>
   </div> -->

 </form>
</div>

@include('admin.include.footer')



<script type="text/javascript">
  
  $(document).ready(function() {
  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    orientation: 'bottom',
    todayHighlight: 'true',
    endDate:'today',
    autoclose: 'true'
  });


  $("#transporter_code").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#transportList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $("#transporter_code").val('');
             $("#transporter_name").val('');
             $("#transporter_name").prop('readonly', false);

          }else{

             $("#transporter_name").val(msg);

             $('#transporter_code').css('border-color','#d2d6de');
             $("#transporter_name").prop('readonly', true);
          } 

        });
});


  $( window ).on( "load", function() {

   getvrnoBySeries();

  var tr_date = $("#diesel_rate_date").val();

  $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });


     $.ajax({

      url:"{{ url('get-diesel-rate-details') }}",

       method : "POST",

       type: "JSON",

       data: {tr_date: tr_date},

       success:function(data){

       // console.log(data);

        var data1 = JSON.parse(data);

        if (data1.response == 'error') {

          /*$('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");*/

        }else if(data1.response == 'success'){
          // console.log(data1.data[0]);
           // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);
            $("#diesel_rate").val(data1.data.DIESEL_RATE)
            



       }


    }
   });


     
    var depot_code =  $("#dept_code").val();

    if(depot_code==''){

     $('#dept_code').css('border-color','#ff0000').focus();
    

      }else{
      $('#dept_code').css('border-color','#d2d6de').focus();
      
      }
  });
</script>



<script type="text/javascript">

function banktotal(sno){
  

          var btotal =0;

          $(".banktotal").each(function () {
             
            if (!isNaN(this.value) && this.value.length != 0) {
              btotal += parseFloat(this.value);
            }

            

          $("#bankTotal").html(btotal.toFixed(2));

          });


    var banktot = $("#bankTotal").html();
    var bTotal = $(".bTotal").html();

    if(bTotal < banktot){

      $("#errMsg").html('Expense total and bank total should be same.');
      $("#submitdata").prop('disabled',true);

    }else if(bTotal == banktot){
      $("#submitdata").prop('disabled',false);
      $("#errMsg").html('');
    }else{
      $("#errMsg").html('');
      $("#submitdata").prop('disabled',true);
    
    }


}


</script>

<script type="text/javascript">
  
   function getVehicleDetails(){

    var vehicle_no = $("#new_vehicle_no").val();
    var old_vehicle_no = $("#vehicle_no").val();

    if(old_vehicle_no == vehicle_no){

      $("#new_vehicle_no").val('');
     
      $("#vehicleerr").html('New Vehicle And Old Vehicle Do Not Same').css('color','red');

    }else{
        $("#vehicleerr").html('');
    }

    var tripid = $("#tripid").val();

    $("#expenseid").prop("disabled",false);


    if(vehicle_no){

       $('#new_vehicle_no').css('border-color','#d2d6de').focus();
      document.getElementById("invcErr").innerHTML = '';
     
    
    }else{
     
     $('#new_vehicle_no').css('border-color','#ff0000').focus();
     document.getElementById("invcErr").innerHTML = 'The invoice no filed is required';
    
    }


    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
    });

    $.ajax({

      url:"{{ url('/get-vehicle-details') }}",

      method : "POST",

      type: "JSON",

      data: {vehicle_no: vehicle_no,tripid:tripid},

      success:function(data){


        var data1 = JSON.parse(data);
        console.log(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){
          if(data1.data==''){
           $("#acc_code").val('');
           $("#acc_name").val('');
           $("#vehicle_no").val('');
           $("#from_place").val('');
           $("#to_place").val('');
          

          }else{

            var loadAvg = data1.data.LOAD_AVG;
            var emptyAvg = data1.data.EMPTY_AVG;
            var ulAvg = data1.data.UL_AVG;


           $("#model").val(data1.data.MODEL);
           $("#loadcpct").val(data1.data.LOAD_CPCT);
           $("#loadAvg").val(data1.data.LOAD_AVG);
           $("#ulcpct").val(data1.data.UL_CPCT);
           $("#ulAvg").val(data1.data.UL_AVG);
           $("#emptyAvg").val(data1.data.EMPTY_AVG);
           $("#owner_type").val(data1.data.OWNER);
           

           var  owner_type = data1.data.OWNER;


           if(owner_type=='MARKET'){

              $("#expenseTable").hide();
              $("#marketTable").css('display','block');
               $("#transporter_code").prop('readonly', false);
                $(".requiredhide").show();

              $(".bTotal").html(data1.data.ADV_AMT);
            //  $('#transporter_code').css('border-color','#d2d6de').focus();

               $('#driver_name').css('border-color','#d2d6de').focus();
               $('#transporter_code').css('border-color','#ff0000');
            

           }else{

            $("#expenseTable").show();
            $("#marketTable").css('display','none');
            $("#payment_type").val('');
            $("#adv_rate").val('');
            $("#adv_amount").val('');
            $("#transporter_code").prop('readonly', true);
            $(".requiredhide").hide();

            $('#transporter_code').css('border-color','#d2d6de').focus();
            $('#driver_name').css('border-color','#ff0000');

           }


              $('#bodyTable').empty();

          var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>&nbsp;</div><div class='box10 texIndbox1'>SR.NO</div><div class='box10 texIndbox1'>VEHICLE</div><div class='box10 texIndbox1'>SOURCE</div><div class='box10 texIndbox1'>DESTINATION</div><div class='box10 texIndbox1'>KMS</div><div class='box10 texIndbox1'>TOLL</div><div class='box10 texIndbox1'>EXTRA KMS</div><div class='box10 texIndbox1'>LESS KMS</div><div class='box10 texIndbox1'>EXTRA TOLL</div></div>";

            $('#bodyTable').append(headtbl);

            var srno =1;
            var totaldiselcal=0;
           $.each(data1.route_data, function(k, getData) {

            if(getData.VEHICLE_TYPE=='fullload'){

              var caldesile =  parseFloat(getData.KM) / parseFloat(loadAvg);
              
              $("#fullLoadkm").val(getData.KM);

            }else if(getData.VEHICLE_TYPE=='empty'){

              var caldesile =  parseFloat(getData.KM) / parseFloat(emptyAvg);
              
            }
            else if(getData.VEHICLE_TYPE=='underload'){

              var caldesile =  parseFloat(getData.KM) / parseFloat(ulAvg);

              
            }


            $("#vehicleList1").append($('<option>',{

              value:getData.VEHICLE_TYPE,

              'data-xyz':getData.VEHICLE_TYPE,
              text:getData.VEHICLE_TYPE

            }));





            /*  $("#fromList1").append($('<option>',{

              value:getData.FROM_PLACE,

              'data-xyz':getData.FROM_PLACE,
              text:getData.FROM_PLACE

            }));*/

            //totaldiselcal += caldesile;

            

            var dataTbale = "<div class='divTableRow rowcount TextBoxesGroup_"+srno+" trrowget'><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+srno+"'><input type='checkbox' class='casecheck' id='tablesecnd"+srno+"'></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+srno+"'><span id='snumtwo"+srno+"'>"+srno+".</span></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+srno+"'><input list='vehicleList"+srno+"'  value='"+getData.VEHICLE_TYPE+"' id='vehicle_type"+srno+"'  style='width: 103px;' name='vehicle_type[]'><datalist id='vehicleList"+srno+"'><option value='"+getData.VEHICLE_TYPE+"'>"+getData.VEHICLE_TYPE+"</option></datalist></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+srno+"' type='textbox'  class='tooltips'><input list='fromList"+srno+"' id='source_code"+srno+"'   value='"+getData.FROM_PLACE+"' name='source_code[]'  style='width: 100px;'><datalist id='fromList"+srno+"'><option value='"+getData.FROM_PLACE+"'>"+getData.FROM_PLACE+"</option></datalist><small class='tooltiptext tooltiphide' id='accountNameTooltip"+srno+"' type='textbox''></small></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+srno+"'><input list='toList"+srno+"' id='destination_code"+srno+"'  value='"+getData.TO_PLACE+"' name='destination_code[]' style='width: 100px;'><datalist id='toList"+srno+"'><option value='"+getData.FROM_PLACE+"'>"+getData.TO_PLACE+"</option></datalist></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+srno+"' type='textbox' ><input type='textbox' id='km"+srno+"' class='getkmtotal' value='"+getData.KM+"' name='km[]' style='width: 100px;' maxlength='10'><input type='hidden' id='kmcal"+srno+"' value='"+caldesile+"' /></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+srno+"'><input type='textbox' id='toll"+srno+"' value='"+getData.TOLL+"' name='toll[]' style='width: 100px;' maxlength='10'></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv1'><input type='textbox' id='extra_km"+srno+"' value='"+getData.EXTRA_KM+"' name='extra_km[]' style='width: 100px;' maxlength='10'></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+srno+"'><input type='textbox' id='less_km"+srno+"' value='"+getData.LESS_KM+"' name='less_km[]' style='width: 100px;' maxlength='10'></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv1'><input type='textbox' id='extra_toll"+srno+"' value='"+getData.EXTRA_TOLL+"' name='extra_toll[]' style='width: 100px;' maxlength='10'><input type='hidden' class='getdiesel' id='diesel"+srno+"' value='"+caldesile+"' name='diesel[]' style='width: 100px;' maxlength='10' readonly=''></div></div></div></div>"

            $('#bodyTable').append(dataTbale);

            srno++;

            
          });


         /*  $("#totalkm").val(data1.km);
          $("#totaldiselcal").val(totaldiselcal);*/


                      gr_amt =0;
                         $(".getkmtotal").each(function () {
                         
                              if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  gr_amt += parseFloat(this.value.replaceAll(',', ''));

                                  
                              }

                            $("#totalkm").val(gr_amt);

                          });

                         var allGrandAmount = parseFloat($('#totalkm').val());


                     diesel_amt =0;
                         $(".getdiesel").each(function () {
                         
                              if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  diesel_amt += parseFloat(this.value.replaceAll(',', ''));

                                  
                              }

                            $("#totaldiselcal").val(diesel_amt.toFixed(3));

                          });

                   var allGrandAmount = parseFloat($('#totaldiselcal').val());


           
          }
        }

      }

      });


  }

</script>

<script type="text/javascript">

  function advamtcal(){

  

        var adv_amt =0;
             $(".adv_amount").each(function () {
             
                  if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                      //gr_amt1 = parseFloat(qtyval);
                      adv_amt += parseFloat(this.value.replaceAll(',', ''));

                        console.log(adv_amt);
                  }

                $(".bTotal").html(adv_amt.toFixed(2));

              });
  }

</script>

 <script type="text/javascript">
  

   function getplanDetails(planNo){

    //var truckNo = $("#vehicle_no").val();

    var plan_no = planNo.split(" ");
    
    var palnno = plan_no[2];

   


    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
    });

    $.ajax({

      url:"{{ url('/get-vehicle-plan-details') }}",

      method : "POST",

      type: "JSON",

      data: {planNo: planNo},

      success:function(data){


        var data1 = JSON.parse(data);
        //console.log(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){
          if(data1.data==''){
           $("#acc_code").val('');
           $("#acc_name").val('');
           $("#vehicle_no").val('');
           $("#from_place").val('');
           $("#to_place").val('');
          

          }else{

            var loadAvg = data1.vehicle_data.LOAD_AVG;
            var emptyAvg = data1.vehicle_data.EMPTY_AVG;
            var ulAvg = data1.vehicle_data.UL_AVG;


            var explode = data1.inward_data.FY_CODE;
            var fy_year = explode.split('-');

          //  alert(fy_year);
            var fy_code = fy_year[0];
            var series_code = data1.inward_data.SERIES_CODE;
            var vrno = data1.inward_data.VRNO;

            var gate_inward = fy_code+' '+series_code+' '+vrno;

           $("#acc_code").val(data1.data.TRANSPORT_CODE);
           $("#acc_name").val(data1.data.TRANSPORT_NAME);
           $("#series_code").val(data1.data.SERIES_CODE);
           $("#seriesName").val(data1.data.SERIES_NAME);

           $("#Plant_code").val(data1.data.PLANT_CODE);
           $("#plantname").val(data1.data.PLANT_NAME);

           $("#profitctrId").val(data1.data.PFCT_CODE);
           $("#pfctName").val(data1.data.PFCT_NAME);

           $("#customer_code").val(data1.data.ACC_CODE);
           $("#customer_name").val(data1.data.ACC_NAME);

           $("#vehicle_no").val(data1.data.VEHICLE_NO);
           $("#from_place").val(data1.data.FROM_PLACE);
           $("#to_place").val(data1.data.TO_PLACE);
           $("#truck_no").val(data1.data.VEHICLE_NO);
           $("#vehicle_type").val(data1.vehicle_data.WHEEL_TYPE);
           $("#vehicle_inward_no").val(gate_inward);
           $("#trip_type").val(data1.data.TRIP_TYPE);
          /* $("#driver_name").val(data1.inward_data.DRIVER_NAME);
           $("#model").val(data1.vehicle_data.MODEL);
           $("#loadcpct").val(data1.vehicle_data.LOAD_CPCT);
           $("#loadAvg").val(data1.vehicle_data.LOAD_AVG);
           $("#ulcpct").val(data1.vehicle_data.UL_CPCT);
           $("#ulAvg").val(data1.vehicle_data.UL_AVG);
           $("#emptyAvg").val(data1.vehicle_data.EMPTY_AVG);*/
           $("#route_code").val(data1.data.ROUTE_CODE);
           $("#route_name").val(data1.data.ROUTE_NAME);
           $("#owner_type").val(data1.data.OWNER);
           $("#tripid").val(data1.data.TRIPHID);

           var  owner_type = data1.data.OWNER;
/*
           if(owner_type=='MARKET'){

              $("#expenseTable").hide();
              $("#marketTable").css('display','block');
              $("#payment_type").val(data1.data.PAYMENT_MODE);
              $("#adv_rate").val(data1.data.ADV_RATE);
              $("#adv_amount").val(data1.data.ADV_AMT);


              $(".bTotal").html(data1.data.ADV_AMT);



           }else{

            $("#expenseTable").show();
            $("#marketTable").css('display','none');
            $("#payment_type").val('');
            $("#adv_rate").val('');
            $("#adv_amount").val('');

           }*/



            $('#itemTable').empty();

           var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DO DATE</div><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>ITEM NAME</div><div class='box10 texIndbox1'>QTY</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>LR DATE</div></div>";

           $('#itemTable').append(headtbl);

            var srn =1;
            var total = 0;
           $.each(data1.lr_data, function(k, getData) {

             total += parseFloat(getData.QTY);
            
            var tableData = "<div class='box-row'><div class='box10 texIndbox1'>"+getData.DO_NO+"</div><div class='box10 texIndbox1'>"+getData.DO_DATE+"</div><div class='box10 texIndbox1'>"+getData.ITEM_CODE+"</div><div class='box10 texIndbox1'>"+getData.ITEM_NAME+"</div><div class='box10 texIndbox1'>"+getData.QTY+"</div><input type='hidden' value='"+getData.QTY+"' id='itemqty"+srn+"'/><div class='box10 texIndbox1'>"+getData.LR_NO+"</div><div class='box10 texIndbox1'>"+getData.LR_DATE+"</div></div>";

            $('#itemTable').append(tableData);

            srn++;

          });


           var  qty_total = "<div class='totlsetinres box-row'>Total : <input type='text' value='"+total.toFixed(3)+"' style='padding: 0px;width: 85px;text-align: right;line-height: 1.1;' id='itemqtytotal'/></div>";
                    
                   $('#totalqty').append(qty_total);



            $('#bodyTable').empty();

          var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>VEHICLE</div><div class='box10 texIndbox1'>SOURCE</div><div class='box10 texIndbox1'>DESTINATION</div><div class='box10 texIndbox1'>KMS</div><div class='box10 texIndbox1'>TOLL</div><div class='box10 texIndbox1'>EXTRA KMS</div><div class='box10 texIndbox1'>LESS KMS</div><div class='box10 texIndbox1'>EXTRA TOLL</div></div>";

            $('#bodyTable').append(headtbl);

           // $('#bodyTable').empty();

            var srno =1;
            var totaldiselcal=0;
           $.each(data1.route_data, function(k, getData) {

            if(getData.VEHICLE_TYPE=='fullload'){

              var caldesile =  parseFloat(getData.KM) / parseFloat(loadAvg);
              
           // $("#fullLoadkm").val(getData.KM);

            }else if(getData.VEHICLE_TYPE=='empty'){

              var caldesile =  parseFloat(getData.KM) / parseFloat(emptyAvg);
              
            }
            else if(getData.VEHICLE_TYPE=='underload'){

              var caldesile =  parseFloat(getData.KM) / parseFloat(ulAvg);

              
            }


            $("#vehicleList1").append($('<option>',{

              value:getData.VEHICLE_TYPE,

              'data-xyz':getData.VEHICLE_TYPE,
              text:getData.VEHICLE_TYPE

            }));


              
           

            srno++;

            
          });






           
          }
        }

      }

      });


  }

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
  $("#account_code").bind('change', function () {
  var Acccode =  $(this).val();
  var xyz = $('#AccountList option').filter(function() {

  return this.value == Acccode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
   $(this).val('');
   $('#accountName').val('');
   document.getElementById("acccode_err").innerHTML = 'The Account code field is required.';
    $('#getAccCode').val('');
    $('#emplList').empty();
    $('#emp_code').val('');
    $('#emp_code').prop('readonly',true);
    $('#empName').html('');
    $('#emplyeeName').val('');
  }else{
  $('#accountName').val(msg);
   document.getElementById("acccode_err").innerHTML = '';
   var AccountCode = $('#account_code').val();
   var vrseqnum = $('#vrseqnum').val();
   var transcode = $('#transcode').val();
   $('#getAccCode').val(AccountCode);
   $('#getDeptName').val(msg);
   $('#getVrNo').val(vrseqnum);
   $('#getTransCode').val(transcode);
   //$('#emp_code').prop('readonly',false);
  
  }

  // objvalidtn.checkBlankFieldValidation();

});
</script>



<script type="text/javascript">
  
  function getTruckDetails(){


  //alert(truckNo);return false;
  var vehicle_inward = $("#vehicle_inward_no").val();

    if(vehicle_inward){

    $('#vehicle_inward_no').css('border-color','#d2d6de').focus();
    document.getElementById("vehicleinwardErr").innerHTML = '';

    $('#trans_code').css('border-color','#ff0000');
    $('#trans_code').prop('readonly',false);
    
    }else{
     
     $('#vehicle_inward_no').css('border-color','#ff0000').focus();
     document.getElementById("vehicleinwardErr").innerHTML = 'The vehicle inward field required';
     $('#trans_code').css('border-color','#d2d6de').focus();
     $('#trans_code').prop('readonly',true);
    }


  var explode = vehicle_inward.split(' ');
  var fy_code = explode[0];
  var series_code = explode[1];
  var vr_no = explode[2];
  
     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });


     $.ajax({

      url:"{{ url('get-truckno-details') }}",

       method : "POST",

       type: "JSON",

       data: {fy_code: fy_code,series_code:series_code,vr_no:vr_no},

       success:function(data){

        console.log(data);

        var data1 = JSON.parse(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){
           console.log(data1.data.WHEEL_TYPE);
           // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);
            $("#truck_no").val(data1.data.VEHICLE_NO);
            $("#driver_name").val(data1.data.DRIVER_NAME);
            $("#vehicle_type").val(data1.datafleet.WHEEL_TYPE);
            $("#model").val(data1.datafleet.MODEL);
            $("#loadcpct").val(data1.datafleet.LOAD_CPCT);
            $("#loadAvg").val(data1.datafleet.LOAD_AVG);
            $("#emptyAvg").val(data1.datafleet.EMPTY_AVG);

           $.each(data1.dataexp, function(k, getData) {

             var num = 1;
           
            $("#IndList"+num).append($('<option>',{

              value:getData.FLEETIND,

              'data-xyz':getData.FLEETIND,
              text:getData.FLEETIND

            }));

            num++;
          
          });



       }


    }
   });



  }
</script>



<script type="text/javascript">
  calculate = function()
  {
  var DEISEL=DRV_Exp=P_Exp=Fooding=Fooding=LU_Exp=Other_Exp=Toll=0;
  
  
   DEISEL = document.getElementById('a1').value;
   DRV_Exp = document.getElementById('a2').value; 
   P_Exp = document.getElementById('a3').value; 
   Fooding = document.getElementById('a4').value; 
   LU_Exp = document.getElementById('a5').value; 
   Toll = document.getElementById('a6').value; 
   Other_Exp = document.getElementById('a7').value; 
   
   if(DEISEL=="")DEISEL=0;
   if(DRV_Exp=="")DRV_Exp=0;
   if(P_Exp=="")P_Exp=0;
   if(Fooding=="")Fooding=0;
   if(LU_Exp=="")LU_Exp=0;
   if(Toll=="")Toll=0;
   if(Other_Exp=="")Other_Exp=0;
   
    
   
  document.getElementById('TOTAL').value = parseInt(DEISEL)+parseInt(DRV_Exp)+parseInt(P_Exp)+parseInt(Fooding)+parseInt(LU_Exp)+parseInt(Toll)+parseInt(Other_Exp);

   }
</script>

<!-- <script type="text/javascript">

  $(".optionsRadios1").on('change',function () { 

   var radio_btn = $(this).val();

   var route_code = $("#route_code").val();

  // alert(route_name);

     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });

   if(radio_btn=='double point'){


    $(".optionsRadios1").prop('disabled',true);

    $.ajax({

      url:"{{ url('get-vehicle-routes-delivery-charge') }}",

       method : "POST",

       type: "JSON",

       data: {route_code: route_code},

       success:function(data){


        var data1 = JSON.parse(data);
      
        //alert();

        if (data1.response == 'error') {

           // $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){
          

          $("#indicator1").val(data1.expens_data[0].FLEETIND);
          $("#gl_code1").val(data1.expens_data[0].GL_CODE);
          $("#Amt1").val(data1.expens_data[0].RATE);


          var btotal =0;

          $(".basicamt").each(function () {
             
            if (!isNaN(this.value) && this.value.length != 0) {
              btotal += parseFloat(this.value);
            }

            

          $("#bTotal").html(btotal.toFixed(2));

          });
      
         }


    }
   });

   }else{

    $("#indicator1").val('');
    $("#gl_code1").val('');
    $("#Amt1").val('');
   }
  
});

</script> -->

<script type="text/javascript">

  function getExpenseData(){

      var totalkm       = $("#totalkm").val();
      var tripid        = $("#tripid").val();
      var totaldiselcal = $("#totaldiselcal").val();
      var diesel_rate   = $("#diesel_rate").val();
      var ulcpct        = $("#ulcpct").val();
      var itemqty       = $("#itemqtytotal").val();
      var kmcal         = $("#fullLoadkm").val();

        var ele = document.getElementsByName('point_delivery');
              
            for(i = 0; i < ele.length; i++) {
                if(ele[i].checked){

                  var delivery_value = ele[i].value;
                  
                }else{

                }
                
            }



     

      //alert(delvery_point);return false;

      $("#indicator1").prop('readonly',false);
      $("#gl_code1").prop('readonly',false);
      $("#Amt1").prop('readonly',false);
      $("#firstrow").prop('disabled',false);
      $("#deletehidn").prop('disabled',false);
      $("#addmorhidn").prop('disabled',false);
      $("#addButton").prop('disabled',true);
      $("#removeButton").prop('disabled',true);
      $(".optionsRadios1").prop('readonly',true);


    //  alert(totalkm);


     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });

     $.ajax({

     // url:"{{ url('get-vehicle-expense-data-by-km') }}",
        url:"{{ url('get-vehicle-expense-data-suppl') }}",
       method : "POST",

       type: "JSON",

       data: {totalkm: totalkm,tripid:tripid},

       success:function(data){

       // console.log(data);return false;

        var data1 = JSON.parse(data);
        

        if (data1.response == 'error') {

           

        }else if(data1.response == 'success'){


              //  $("#IndList1").empty();

                  

                  //alert(totaldiselcal);

           var num =1;
           var sff =[];

           $.each(data1.expense_data, function(k, getData) {

               /*sff.push(getData.IND_CODE);

             if(getData.IND_CODE =='DIESEL'){

            var deiselCal = parseFloat(totaldiselcal) * parseFloat(diesel_rate);

           
              var amount = deiselCal.toFixed(2);

            }else if(getData.IND_CODE=='DELIVERY CHARGE'){

                if(delivery_value=='double point'){

                  var amount = '500';

                }else{

                  var amount = '0.00';
                }

            }else if(getData.IND_CODE=='OVERLOAD ALLOWANCE'){

              var qty  =  parseFloat(itemqty) - parseFloat(ulcpct);

              var calqty = qty * 0.6;

              var totalqty = calqty * kmcal;

              var amount =  totalqty.toFixed(2);


            }else{

              var amount = getData.RATE;
            
            }
*/

            

            $("#vehicle_type"+num).prop('readonly',true);
          
            var expense_data = "<div class='divTableRow rowcount TextBoxesGroup_"+num+" trrowget'><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+num+"'><input type='checkbox' class='casecheck' id='tablesecnd"+num+"'></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+num+"'><input type='text'  value='"+getData.IND_CODE+"' id='ind"+num+"'  style='width: 103px;' name='indicator[]'></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+num+"' type='textbox'  class='tooltips'><input type='text' id='glcode"+num+"'   value='"+getData.GL_CODE+"' name='gl_code[]'  style='width: 100px;'><small class='tooltiptext tooltiphide' id='accountNameTooltip"+num+"' type='textbox''></small></div></div></div><div class='divTableCell'><div class='TextBoxesGroup'><div id='TextBoxDiv"+num+"'><input type='text' id='rateAmt"+num+"' class='basicamt'  value='"+getData.AMOUNT+"' name='Amt[]' style='width: 100px;text-align:right;'><datalist id='toList"+num+"'><option value=''></option></datalist></div></div></div></div>"

            


            $('.expenseBody').before(expense_data);


            $("#IndList1").append($('<option>',{

              value:getData.FLEETIND,

              'data-xyz':getData.FLEETIND,
              text:getData.FLEETIND

            }));

            num++;


                  var btotal =0;
                  $(".basicamt").each(function () {
                   
                  if (!isNaN(this.value) && this.value.length != 0) {
                    btotal += parseFloat(this.value);
                  }

                  

                $(".bTotal").html(btotal.toFixed(2));

                });
          
          });

           $("#dubindicator").val(sff);
           $("#expenseid").prop('disabled',true);

        //   console.log('fleetind',sff);



       }
     }

     });


  }
  
</script>

<script type="text/javascript">

  function getRoute(srno){

    var route_code    = $('#route_code').val();
    var loadAvg       = $("#loadAvg").val();
    var emptyAvg      = $("#emptyAvg").val();
    var ulAvg         = $("#ulAvg").val();
    var dublicateName = $("#dublicateName").val();
    var vehicle_type  = $('#vehicle_type'+srno).val();
    var vehicletype   = $('#vehicle_type1').val();

          


               if(dublicateName ==''){

                  $("#dublicateName").val(vehicle_type);

                }else{

                  if(vehicle_type == dublicateName){


                   
                    $('#vehicle_type'+srno).val('');
                    $('#source_code'+srno).val('');
                    $('#destination_code'+srno).val('');
                    $('#km'+srno).val('');
                    $('#toll'+srno).val('');
                    $('#extra_km'+srno).val('');
                    $('#less_km'+srno).val('');
                    $('#extra_toll'+srno).val('');

                  }else{

                  var namevehicleType = dublicateName +','+vehicle_type;

                  $("#dublicateName").val(namevehicleType);

                    var explode = dublicateName.split(',');

                      var lengthdd = explode.length;

                       for (let i = 0; i < lengthdd - 1; i++) {

                          if(vehicle_type == explode[i]){

                              $('#vehicle_type'+srno).val('');
                              $('#source_code'+srno).val('');
                              $('#destination_code'+srno).val('');
                              $('#km'+srno).val('');
                              $('#toll'+srno).val('');
                              $('#extra_km'+srno).val('');
                              $('#less_km'+srno).val('');
                              $('#extra_toll'+srno).val('');

                              console.log('srno',srno);
                          }
                        
                       }

                  }

                }


  

      var xyz = $('#vehicleList'+srno+' option').filter(function() {

      return this.value == vehicle_type;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match'; 

      if(msg=='No Match'){

        $('#vehicle_type'+srno).val('');
        $('#source_code'+srno).val('');
        $('#destination_code'+srno).val('');
        $('#km'+srno).val('');
        $('#toll'+srno).val('');
        $('#extra_km'+srno).val('');
        $('#less_km'+srno).val('');
        $('#extra_toll'+srno).val('');
        $('#dublicateName'+srno).val('');

          
      }else{


    var vehicle_type2 = $('#vehicle_type'+srno).val();



   if(vehicle_type2){

      

     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });

     $.ajax({

      url:"{{ url('get-vehicle-routes-details-by-vehicle-type') }}",

       method : "POST",

       type: "JSON",

       data: {route_code: route_code,vehicle_type:vehicle_type},

       success:function(data){

       // console.log(data);return false;

        var data1 = JSON.parse(data);
        

        if (data1.response == 'error') {

           

        }else if(data1.response == 'success'){





              $("#expenseid").prop("disabled",false);

              $("#source_code"+srno).val(data1.data[0].FROM_PLACE);
              $("#destination_code"+srno).val(data1.data[0].TO_PLACE);
              $("#km"+srno).val(data1.data[0].KM);
              
              $("#toll"+srno).val(data1.data[0].TOLL);
              $("#extra_km"+srno).val(data1.data[0].EXTRA_KM);
              $("#less_km"+srno).val(data1.data[0].LESS_KM);
              $("#extra_toll"+srno).val(data1.data[0].EXTRA_TOLL);


              var vehicle_type = data1.data[0].VEHICLE_TYPE;

              var km =  data1.data[0].KM;

              if(vehicle_type=='fullload'){

              var caldesile =  parseFloat(km) / parseFloat(loadAvg);
              
              $("#fullLoadkm").val(km);

              }else if(vehicle_type=='empty'){

                var caldesile =  parseFloat(km) / parseFloat(emptyAvg);
                
              }
              else if(vehicle_type=='underload'){

                var caldesile =  parseFloat(km) / parseFloat(ulAvg);

                
              }

                 $("#diesel"+srno).val(caldesile);


                      gr_amt =0;
                         $(".getkmtotal").each(function () {
                         
                              if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  gr_amt += parseFloat(this.value.replaceAll(',', ''));

                                  
                              }

                            $("#totalkm").val(gr_amt);

                          });

                         var allGrandAmount = parseFloat($('#totalkm').val());


                     diesel_amt =0;
                         $(".getdiesel").each(function () {
                         
                              if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  diesel_amt += parseFloat(this.value.replaceAll(',', ''));

                                  
                              }

                            $("#totaldiselcal").val(diesel_amt.toFixed(3));

                          });

                   var allGrandAmount = parseFloat($('#totaldiselcal').val());

                



       }
     }

     });

    }
        
    
      }



  



  }
  
</script>

<script type="text/javascript">

  function getRouteDetails(){



    var route_name = $("#route_name").val();
    var loadAvg    = $("#loadAvg").val();
    var emptyAvg   = $("#emptyAvg").val();
    var ulAvg      = $("#ulAvg").val();
  //  var dept_code = $("#dept_code").val();

//alert(dept_code);

     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });

    $.ajax({

      url:"{{ url('get-vehicle-routes-details') }}",

       method : "POST",

       type: "JSON",

       data: {route_name: route_name},

       success:function(data){


        var data1 = JSON.parse(data);
        //console.log(data1.km);

        if (data1.response == 'error') {

           // $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){
          // console.log(data1.data[0]);

          //var overload = data1.data[0].OVERLOAD;

        
          /*if(overload==1){
            
            $(".optionsRadios1#option1").prop('checked',true);
            $(".optionsRadios1#option2").prop('disabled',true);

          }else if(overload==0){

            $(".optionsRadios1#option2").prop('checked',true);
            $(".optionsRadios1#option1").prop('disabled',true);
          }
*/

          //$("#rate").val(data1.data[0].RATE);

          $('#bodyTable').empty();

          var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>VEHICLE</div><div class='box10 texIndbox1'>SOURCE</div><div class='box10 texIndbox1'>DESTINATION</div><div class='box10 texIndbox1'>KMS</div><div class='box10 texIndbox1'>TOLL</div><div class='box10 texIndbox1'>EXTRA KMS</div><div class='box10 texIndbox1'>LESS KMS</div><div class='box10 texIndbox1'>EXTRA TOLL</div></div>";

            $('#bodyTable').append(headtbl);

           // $('#bodyTable').empty();

            var srno =1;
            var totaldiselcal=0;
           $.each(data1.data, function(k, getData) {

            if(getData.VEHICLE_TYPE=='fullload'){

              var caldesile =  parseFloat(getData.KM) / parseFloat(loadAvg);
              
            //  $("#fullLoadkm").val(getData.KM);

            }else if(getData.VEHICLE_TYPE=='empty'){

              var caldesile =  parseFloat(getData.KM) / parseFloat(emptyAvg);
              
            }
            else if(getData.VEHICLE_TYPE=='underload'){

              var caldesile =  parseFloat(getData.KM) / parseFloat(ulAvg);

              
            }

             totaldiselcal += caldesile;

            var tableData = "<div class='box-row'><div class='box10 texIndbox1'>"+getData.VEHICLE_TYPE+"</div><div class='box10 texIndbox1'>"+getData.FROM_PLACE+"</div><div class='box10 texIndbox1'>"+getData.TO_PLACE+"</div><div class='box10 texIndbox1'>"+getData.KM+"</div><input type='text' id='kmcal"+srno+"' value='"+caldesile+"' /><div class='box10 texIndbox1'>"+getData.TOLL+"</div><div class='box10 texIndbox1'>"+getData.EXTRA_KM+"</div><div class='box10 texIndbox1'>"+getData.LESS_KM+"</div><div class='box10 texIndbox1'>"+getData.EXTRA_TOLL+"</div></div>";

            $('#bodyTable').append(tableData);

            srno++;
          });

           

          /*$("#totalkm").val(data1.km);
          $("#totaldiselcal").val(totaldiselcal);*/

           $("#IndList1").empty();

           $.each(data1.expense_data, function(k, getData) {

            $("#IndList1").append($('<option>',{

              value:getData.FLEETIND,

              'data-xyz':getData.FLEETIND,
              text:getData.FLEETIND

            }));

          
          });


       }


    }
   });

  }

</script>

<script type="text/javascript">
  function editable2() {
  var input = document.getElementsByTagName("input")[0];
  var att = document.createAttribute("type");
  att.value = "text";
  input.setAttributeNode(att);
}
</script>
<!-- <script type="text/javascript">

 

  $(".optionsRadios1").on('change',function () { 
  var radio_btn = $(this).val();

   if(radio_btn=='double point'){

    $("#indicator1").val('DELIVERY CHARGE');
    $("#Amt1").val('500');
    $(".optionsRadios1").prop('disabled', true);

   }else{

    $("#indicator1").val('');
    $("#Amt1").val('');
   }

  



  
});

</script> -->


<script type="text/javascript">
  $(document).ready(function() {


       

    $('#a1').change(function(){
      var diselexp = $('#a1').val();
      if(diselexp){
      $('#diesel_slip_no').val('');
      $('#diesedl_cr').val('');
      $( "#diesel_slip_no" ).prop( "disabled", true );
      $( "#diesedl_cr" ).prop( "disabled", true );

      $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
      $('#hidesubmitbtn').prop( "disabled", true );

    }else{
      $( "#diesel_slip_no" ).prop( "disabled", false );
      $( "#diesedl_cr" ).prop( "disabled", false );
    }
    });

    $('#diesedl_cr').on('input',function(){
    $('#enterslipnomsg').html('');
      var diselcr = $('#diesedl_cr').val();
      
      if(diselcr){
      $('#a1').prop( "disabled", true );
      $('#enterslipnomsg').html('Diesel Slip No Is Required').css('color','red');
      $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
      $( "#hidesubmitbtn" ).prop( "disabled", true );
      return true;
      }else{
       $('#a1').prop( "disabled", false );
      $('#enterslipnomsg').html('');
      $('#filerrormsg').html('');
      return false;
      }
    });

    $('#diesel_slip_no').on('input',function(){
     var diesel_slip_no =  $('#diesel_slip_no').val();
      if(diesel_slip_no){
      $('#enterslipnomsg').html('');
       // $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
       
      }else{
      $('#enterslipnomsg').html('Diesel Slip No Is Required').css('color','red');
      $('#filerrormsg').html('Diesel Qty Is Required').css('color','red');
       // $( "#hidesubmitbtn" ).prop( "disabled", true );
      }
    });

    $('#diesel_slip_no').change(function(){
     var diselslipno = $('#diesel_slip_no').val();

     var driver_exp = $('#a2').val();
     var fooding_exp = $('#a4').val();
     var admin_exp = $('#a3').val();
     var uloading_exp = $('#a5').val();
     var toll_exp = $('#a6').val();
     var other_exp = $('#a7').val();
     var total_adv = parseInt(driver_exp)+parseInt(fooding_exp)+parseInt(admin_exp)+parseInt(uloading_exp)+parseInt(toll_exp)+parseInt(other_exp);

    // console.log(total_adv);

     if(diselslipno){
      $('#a1').val('');
      $('#TOTAL').val(total_adv);
     }

    });


    $('#diesel_qty').on('input',function(){
      var dieselQty = $(this).val();
      if(dieselQty){

      $('#hidesubmitbtn').prop( "disabled", false );
      $('#filerrormsg').html('');
    }else{
      $('#hidesubmitbtn').prop( "disabled", true );
    }
    });

    $('#invoice_no').on('input',function(){
      var invoice_no = $(this).val();
    if(invoice_no){

       $('#invoice_no').css('border-color','#d2d6de').focus();
      document.getElementById("invcErr").innerHTML = '';
       $('#trip_no').css('border-color','#ff0000');
       $('#trip_no').prop('readonly',false);
    
    }else{
     
     $('#invoice_no').css('border-color','#ff0000').focus();
     document.getElementById("invcErr").innerHTML = 'The invoice no filed is required';
     $('#trip_no').css('border-color','#d2d6de').focus();
     $('#trip_no').prop('readonly',true);
    }
    });

    $('#trip_no').on('input',function(){
      var invoice_no = $(this).val();
    if(invoice_no){

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

    $('#trip_type').on('input',function(){
      var invoice_no = $(this).val();
    if(invoice_no){

       $('#trip_type').css('border-color','#d2d6de').focus();
      document.getElementById("invcErr").innerHTML = '';
       $('#acct_code').css('border-color','#ff0000');
       $('#acct_code').prop('readonly',false);
    
    }else{
     
     $('#trip_type').css('border-color','#ff0000').focus();
     document.getElementById("invcErr").innerHTML = 'The invoice no filed is required';
     $('#acct_code').css('border-color','#d2d6de').focus();
     $('#acct_code').prop('readonly',true);
    }
    });

    $('#shipment_no').on('input',function(){
      var shipment_no = $(this).val();
    if(shipment_no){

       $('#shipment_no').css('border-color','#d2d6de').focus();
      document.getElementById("shipmentErr").innerHTML = '';
       $('#vehicle_inward_no').css('border-color','#ff0000');
       $('#vehicle_inward_no').prop('readonly',false);
    
    }else{
     
     $('#shipment_no').css('border-color','#ff0000').focus();
      document.getElementById("shipmentErr").innerHTML = 'The shipment no field required';
     $('#vehicle_inward_no').css('border-color','#d2d6de').focus();
     $('#vehicle_inward_no').prop('readonly',true);
    }
    });

    $('#lr_no').on('input',function(){
      var lr_no = $(this).val();
    if(lr_no){

       $('#lr_no').css('border-color','#d2d6de').focus();
       $('#vehicle_inward_no').css('border-color','#ff0000');
       $('#vehicle_inward_no').prop('readonly',false);
    
    }else{
     
     $('#lr_no').css('border-color','#ff0000').focus();
     $('#vehicle_inward_no').css('border-color','#d2d6de').focus();
     $('#vehicle_inward_no').prop('readonly',true);
    }
    });

     $('#driver_name').on('input',function(){
      var driver_name = $(this).val();
    if(driver_name){

       $('#driver_name').css('border-color','#d2d6de').focus();
       $('#item_code').css('border-color','#ff0000');
       $('#item_code').prop('readonly',false);
    
    }else{
     
     $('#driver_name').css('border-color','#ff0000').focus();
     $('#item_code').css('border-color','#d2d6de').focus();
     $('#item_code').prop('readonly',true);
    }
    });

     $('#stoqtyum').on('input',function(){
      var stoqtyum = $(this).val();
    if(stoqtyum){

       $('#stoqtyum').css('border-color','#d2d6de').focus();
      
    
    }else{
     
     $('#stoqtyum').css('border-color','#ff0000').focus();
     
    }
    });


     /*dubliation name*/

    $("#dept_code").bind('change', function () {  

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
       document.getElementById("depotErr").innerHTML = 'The depot code filed is required';
        $('#dept_code').css('border-color','#ff0000').focus();
        $('#invoice_no').css('border-color','#d2d6de').focus();
        $('#invoice_no').prop('readonly',true);

      }else{
      $('#dept_code').css('border-color','#d2d6de').focus();
      document.getElementById("depotErr").innerHTML = '';
      $('#invoice_no').css('border-color','#ff0000').focus();
      $('#invoice_no').prop('readonly',false);
      }


    });


     /*dubliation name*/




    $("#acct_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#accountList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      //alert(msg+xyz);

      document.getElementById("accountText").innerHTML = msg; 

      if(msg=='No Match'){

       $(this).val('');
       document.getElementById("accountText").innerHTML = '';
       document.getElementById("accountErr").innerHTML = 'The account code field is required';

       $('#acct_code').css('border-color','#ff0000').focus();
        $('#area_code').css('border-color','#d2d6de').focus();
        $('#area_code').prop('readonly',true);

      }else{

      $('#acct_code').css('border-color','#d2d6de').focus();
      document.getElementById("accountErr").innerHTML = '';

      $('#area_code').css('border-color','#ff0000').focus();
      $('#area_code').prop('readonly',false);

      }

    });

    $("#area_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#areaList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      //alert(msg+xyz);

      document.getElementById("areaText").innerHTML = msg; 

      if(msg=='No Match'){

       $(this).val('');
       document.getElementById("areaErr").innerHTML = 'The area code field required';

       $('#area_code').css('border-color','#ff0000').focus();
        $('#shipment_no').css('border-color','#d2d6de').focus();
        $('#shipment_no').prop('readonly',true);

      }else{
      document.getElementById("areaErr").innerHTML = '';
      $('#area_code').css('border-color','#d2d6de').focus();
      $('#shipment_no').css('border-color','#ff0000').focus();
      $('#shipment_no').prop('readonly',false);
      }

    });

    $("#item_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#itemList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      //alert(msg+xyz);

      document.getElementById("itemText").innerHTML = msg; 

      if(msg=='No Match'){

       $(this).val('');
       document.getElementById("itemText").innerHTML = '';
       document.getElementById("itemErr").innerHTML = 'The item code field is required';
       $('#item_code').css('border-color','#ff0000').focus();
        $('#stoqtyum').css('border-color','#d2d6de').focus();
        $('#stoqtyum').prop('readonly',true);

         $('#stoUM').val('');
        $('#stoAum').val('');
        $('#cfator').val('');

      }else{
      $('#item_code').css('border-color','#d2d6de').focus();
      document.getElementById("itemErr").innerHTML = '';

      $('#stoqtyum').css('border-color','#ff0000').focus();
      $('#stoqtyum').prop('readonly',false);
      }

    });

     $("#trans_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#transList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      //alert(msg+xyz);

      document.getElementById("transText").innerHTML = msg; 

      if(msg=='No Match'){

       $(this).val('');
       document.getElementById("transText").innerHTML = '';
       $('#trans_code').css('border-color','#ff0000').focus();
        $('#item_code').css('border-color','#d2d6de').focus();
        $('#item_code').prop('readonly',true);
       

      }else{
      $('#trans_code').css('border-color','#d2d6de').focus();
      $('#item_code').css('border-color','#ff0000').focus();
      $('#item_code').prop('readonly',false);
      }

    });


     $("#truck_no").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#truckList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      //alert(msg+xyz);

      document.getElementById("transText").innerHTML = msg; 

      if(msg=='No Match'){

       $(this).val('');
       document.getElementById("transText").innerHTML = '';
       $('#truck_no').css('border-color','#ff0000').focus();
        $('#vehicle_type').css('border-color','#d2d6de').focus();
        $('#vehicle_type').prop('readonly',true);

      }else{
      $('#truck_no').css('border-color','#d2d6de').focus();
      $('#vehicle_type').css('border-color','#ff0000').focus();
      $('#vehicle_type').prop('readonly',false);
      }

    });

    $("#vehicle_type").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#wheelList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      //alert(msg+xyz);

      document.getElementById("transText").innerHTML = msg; 

      if(msg=='No Match'){

       $(this).val('');
       document.getElementById("transText").innerHTML = '';
       $('#vehicle_type').css('border-color','#ff0000').focus();
        $('#driver_name').css('border-color','#d2d6de').focus();
        $('#driver_name').prop('readonly',true);

      }else{
      $('#vehicle_type').css('border-color','#d2d6de').focus();
      $('#driver_name').css('border-color','#ff0000').focus();
      $('#driver_name').prop('readonly',false);
      }

    });



    $("#item_code").change(function(){

     $.ajaxSetup({

      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

     });

    var item_code =  $(this).val();

    var itemCode = item_code.split("-");

    var itemcode = itemCode[0];

    $.ajax({

      url:"{{ url('item-um-aum') }}",

       method : "POST",

       type: "JSON",

       data: {itemcode: itemcode},

       success:function(data){

      
        var data1 = JSON.parse(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
          $('#stoUM').val('');
          $('#stoAum').val('');
          $('#cfator').val('');

        }else if(data1.response == 'success'){
          // console.log(data1.data[0]);
          $('#stoUM').val(data1.data[0].UM_CODE);
          $('#stoAum').val(data1.data[0].AUM_CODE);
          $('#cfator').val(data1.data[0].AUM_FACTOR);      
        }else{

          $('#stoUM').val('');
          $('#stoAum').val('');
          $('#cfator').val('');

        }
       }

    });

    });



    $("#stoqtyum").on('input',function(){

      var stoQty = $("#stoqtyum").val();

      var cFactor = $("#cfator").val();

      var result = stoQty*cFactor;

      if(stoQty<0){

         alert('Pleas Select More Than 0 Quantity');

         $("#stoqtyum").val('0');

         $("#stoQtyAum").val('');

      }else{

         $("#stoQtyAum").val(result);

      }

    });


    $('#stoQtyAum').on('input',function(){

      var stoQtyAumvar = $('#stoQtyAum').val();
      var stoCfactor = $('#cfator').val();

      result = stoQtyAumvar / stoCfactor;

      $('#stoqtyum').val(result.toFixed(2));

    });

     $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
      event.preventDefault();
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

<script type="text/javascript">

  $(".delete").on('click', function() {


    var rowCount = $('#tbledata tr').length;
    
    console.log('rowCount',rowCount);
    if(rowCount == 2){
     $('#submitdata').prop('disabled',true);
    }
    $('.case:checkbox:checked').parents("tr").remove();

    $('.check_all').prop("checked", false); 

    quantity =0;
     $(".quantityC").each(function () {
      //add only if the value is number
      if (!isNaN(this.value) && this.value.length != 0) {
        quantity += parseFloat(this.value);
      }

      $("#basicTotal").val(quantity.toFixed(2));

    });

     var dataCl =0;
     $(".quaPcountrow").each(function () {
      //add only if the value is number
      if (!isNaN(this.value) && this.value.length != 0) {
        dataCl += parseFloat(this.value);
      }

      $("#allquaPcount").val(dataCl);

    });


    check();

  }); /*--function close--*/


  var i=2;
  var qurow =1;

  $(".addmore").on('click',function(){

  var vrType =  $('#vr_type').val();

    if(vrType == 'Payment'){

    var getpaymode = 'To -';

    }else if(vrType == 'Receipt'){

     var getpaymode='By -';

    }

    count=$('table tr').length;


   var data ="<tr class='useful'><td class='tdthtablebordr' style='text-align:center;'><input type='checkbox' class='case' id='firstrow' /></td><td class='tdthtablebordr' style='width: 25px;text-align:center;'><div class='input-group'><input list='IndList"+i+"' class='inputboxclr SetInCenter' style='width: 105px;line-height: 0.1;margin-left:4px;' id='indicator"+i+"' name='indicator[]' onchange='getIndDetails("+i+")'/><datalist id='IndList"+i+"'></datalist></div></td><td class='tdthtablebordr tooltips' style='text-align:center;'><input type='text' class='inputboxclr getAccNAme' style='width: 100px;line-height: 0.1;text-align:center;' id='gl_code"+i+"' name='gl_code[]'/><small class='tooltiptextitem tooltiphide' id='itemNameTooltip1'></small></td><td class='tdthtablebordr' style='text-align:center;'><div style='display: inline-flex;border: none;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate basicamt'  id='Amt"+i+"' name='Amt[]' style='width: 100px;line-height: 0.1;text-align:right;'/></div><div><small id='errmsgqty"+i+"'></small></div></td></tr>";

    $('table').append(data);


    var  wheelType = $("#vehicle_type").val();

    

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });


     $.ajax({

      url:"{{ url('get-wheelType-details') }}",

       method : "POST",

       type: "JSON",

       data: {wheelType: wheelType},

       success:function(data){

       // console.log(data);

        var data1 = JSON.parse(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){
        
            
           $.each(data1.data, function(k, getData) {

            console.log('wheel_type',qurow);


           
            $("#IndList"+qurow).append($('<option>',{

              value:getData.FLEETIND,

              'data-xyz':getData.FLEETIND,
              text:getData.FLEETIND

            }));

          
          });


       }


    }
   });



    var route_name = $("#route_name").val();
  //  var dept_code = $("#dept_code").val();

//alert(dept_code);

     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });

    $.ajax({

      url:"{{ url('get-vehicle-routes-details') }}",

       method : "POST",

       type: "JSON",

       data: {route_name: route_name},

       success:function(data){


        var data1 = JSON.parse(data);
        //console.log(data1.km);

        if (data1.response == 'error') {

           // $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){
          // console.log(data1.data[0]);

          


          //$("#totalkm").val(data1.km);

           $("#IndList"+qurow).empty();

           $.each(data1.expense_data, function(k, getData) {

            $("#IndList"+qurow).append($('<option>',{

              value:getData.FLEETIND,

              'data-xyz':getData.FLEETIND,
              text:getData.FLEETIND

            }));

          
          });


       }


    }
   });

  



    i++;
    qurow++;

  });  /*--function close--*/

  /*<td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -3%;'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter'  id='A_qty"+i+"' name='Aqty[]'  style='width: 80px' readonly /><input type='text' name='add_unit_M[]' id='AddUnitM"+i+"' class='inputboxclr SetInCenter AddM'></div></td>*/

  function select_all() {

  $('input[class=case]:checkbox').each(function(){ 

    if($('input[class=check_all]:checkbox:checked').length == 0){ 

    $(this).prop("checked", false); 

    }else{

    $(this).prop("checked", true); 

    } 

  });
  }

  function check(){

  obj = $('table tr').find('span');
   // console.log('obj',obj);
  if(obj.length==0){
    $('#basicTotal').val(0.00);
    $('#submitdata').prop('disabled',true);
  }else{
    $.each( obj, function( key, value ) {

      id= value.id;

      $('#'+id).html(key+1);

    });
  }
  }


</script>


<script type="text/javascript">
  
  function getWheelInd(wheelType){

  //  alert(wheelType);return false;

     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });


     $.ajax({

      url:"{{ url('get-wheelType-details') }}",

       method : "POST",

       type: "JSON",

       data: {wheelType: wheelType},

       success:function(data){

        console.log(data);

        var data1 = JSON.parse(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){
          // console.log(data1.data[0]);
           // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);
            
           $.each(data1.data, function(k, getData) {

             var num = 1;
           
            $("#IndList"+num).append($('<option>',{

              value:getData.FLEETIND,

              'data-xyz':getData.FLEETIND,
              text:getData.FLEETIND

            }));

            num++;
          
          });


       }


    }
   });



  }
</script>

<script type="text/javascript">
  
  function getIndDetails(num){

  //  alert(wheelType);return false;
    var indicator     = $("#indicator"+num).val();
    var totalkm       = $("#totalkm").val();
    var totaldiselcal = $("#totaldiselcal").val();
    var diesel_rate   = $("#diesel_rate").val();
    var ulcpct        = $("#ulcpct").val();
    var itemqty       = $("#itemqtytotal").val();
    var kmcal         = $("#fullLoadkm").val();
    var dubindicator   = $("#dubindicator").val();

    console.log(dubindicator);

     var explode = dubindicator.split(',');

    var lengthdd = explode.length;

        for (let i = 0; i < lengthdd - 1; i++) {

          if(indicator == explode[i]){

                             
            $("#indicator"+num).val('');
              
             }
                        
        }

  //  alert(num);

    if(indicator){

      $("#vehicle_type"+num).prop('readonly',true);
    }else{
      $("#vehicle_type"+num).prop('readonly',false);
    }

      var indicator2     = $("#indicator"+num).val();

      if(indicator2){



     $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
     });


     $.ajax({

      url:"{{ url('get-Indicator-details') }}",

       method : "POST",

       type: "JSON",

       data: {indicator: indicator,totalkm:totalkm},

       success:function(data){

     
        var data1 = JSON.parse(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){
           // console.log('wheel_type',data1.data[0].LOAD_AVERAGE);
          

           if(indicator=='DIESEL'){

            var deiselCal = parseFloat(totaldiselcal) * parseFloat(diesel_rate);

            $("#Amt"+num).val(deiselCal.toFixed(2));
            $("#gl_code"+num).val(data1.data[0].GL_CODE);

            }else{

             $("#gl_code"+num).val(data1.data[0].GL_CODE);
             $("#Amt"+num).val(data1.data[0].RATE);

            }

            if(indicator=='OVERLOAD ALLOWANCE'){

            var qty  =  parseFloat(itemqty) - parseFloat(ulcpct);

            var calqty = qty * 0.6;

            var totalqty = calqty * kmcal;

              $("#Amt"+num).val(totalqty.toFixed(2));
              $("#gl_code"+num).val(data1.data[0].GL_CODE);

            }

           

          var btotal =0;

          $(".basicamt").each(function () {
             
            if (!isNaN(this.value) && this.value.length != 0) {
              btotal += parseFloat(this.value);
            }

            

          $(".bTotal").html(btotal.toFixed(2));

          });

         
            
       }


    }
   });

}

     



  }
</script>
<script type="text/javascript">
  
  function getvrnoBySeries(){

  var seriesCode = $('#series_code').val();
  var transcode = $('#transcode').val();

   //alert(transcode);

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

      //  alert(data1.vrno_series.LAST_NO);

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

<script type="text/javascript">

$(document).ready(function(){

    var counter = 2;

    $("#addButton").click(function () {
                
      if(counter>10){
              alert("Only 10 textboxes allow");
              return false;
      }   
        
      var newTextBoxDiv = $(document.createElement('div'))
         .attr("class", 'rowcount' + counter);

          

    getcount=$('.divTableBody .trrowget').length;

    var newrow = '<div class="divTableRow rowcount TextBoxesGroup_'+counter+' trrowget"><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="checkbox" class="casecheck" id="tablesecnd'+counter+'"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><span id="snumtwo'+counter+'">'+getcount+'.</span></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input list="vehicleList'+counter+'" id="vehicle_type'+counter+'"  style="width: 103px;" name="vehicle_type[]" onchange="getRoute('+counter+')"><datalist id="vehicleList'+counter+'"></datalist></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'" class="tooltips"><input list="fromList'+counter+'" id="source_code'+counter+'" value="" name="source_code[]"  style="width: 100px;"><datalist id="fromList'+counter+'"></datalist><small class="tooltiptext tooltiphide" id="accountNameTooltip'+counter+'"></small></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input list="toList'+counter+'" id="destination_code'+counter+'" value="" name="destination_code[]" style="width: 100px;"><datalist id="toList'+counter+'"></datalist></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="textbox" id="km'+counter+'" class="getkmtotal" value="" name="km[]" style="width: 100px;" maxlength="10"><input type="hidden" class="getdiesel" id="diesel'+counter+'" value="" name="diesel[]" style="width: 100px;" maxlength="10"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="textbox" id="toll'+counter+'" value="" name="toll[]" style="width: 100px;" maxlength="10"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="textbox" id="extra_km'+counter+'" value="" name="extra_km[]" style="width: 100px;" maxlength="10"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="textbox" id="less_km'+counter+'" value="" name="less_km[]" style="width: 100px;" maxlength="10"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'"><input type="textbox" id="extra_toll'+counter+'" value="" name="extra_toll[]" style="width: 100px;" maxlength="10"></div></div></div></div>';

    //newTextBoxDiv.after().html(newrow);
            
    $(".divTableBody").append(newrow);


    

    var planNo = $("#trip_no").val();

    var plan_no = planNo.split(" ");
    
    var palnno = plan_no[2];

   


    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
    });

    $.ajax({

      url:"{{ url('/get-vehicle-plan-details') }}",

      method : "POST",

      type: "JSON",

      data: {planNo: planNo},

      success:function(data){


        var data1 = JSON.parse(data);
        //console.log(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){
          if(data1.data==''){
           $("#acc_code").val('');
           $("#acc_name").val('');
           $("#vehicle_no").val('');
           $("#from_place").val('');
           $("#to_place").val('');
          

          }else{

            

           $.each(data1.route_data, function(k, getData) {

              $("#vehicleList"+getcount).append($('<option>',{

              value:getData.VEHICLE_TYPE,

              'data-xyz':getData.VEHICLE_TYPE,
              text:getData.VEHICLE_TYPE

            }));

              $("#fromList"+getcount).append($('<option>',{

              value:getData.FROM_PLACE,

              'data-xyz':getData.FROM_PLACE,
              text:getData.FROM_PLACE

            }));


            


            
          });

          


           
          }
        }

      }

      });


  

                
    counter++;
     });



     /*$("#removeButton").click(function () {
    var count2 = counter - 1;
       console.log(count2);

    if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   
        
    counter--;
            
        $(".TextBoxesGroup_"+count2).remove();
            
     });*/
     $(".removeBtntbl").on('click', function() {
        $('.casecheck:checkbox:checked').parents(".trrowget").remove();
        //console.log('yes');

        checksectbl();
     });

     function checksectbl(){

    obj = $('.divTableRow .TextBoxesGroup').find('span'); 



    objfirst = $('table tr').find('span'); 


    if(obj.length==0){
      
      $('#submitdata').prop('disabled',true);
      $('#submitNDwn').prop('disabled',true);
    }else if(obj.length == 0){
      $('#submitdata').prop('disabled',true);
      $('#submitNDwn').prop('disabled',true);
    }else{
      $.each( obj, function( key, value ) {

          id= value.id;
         

          $('#'+id).html(key+1);

      });
    } 
      
  }

        
     $("#getButtonValue").click(function () {
        
    var msg = '';
    for(i=1; i<counter; i++){
      msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
    }
        alert(msg);
     });
  });
</script>

<script type="text/javascript">

 function submitAllData(valD){

   var downloadFlg = valD;
    $('#donwloadStatus').val(downloadFlg);


      var trcount=$('table tr').length;



          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          console.log(data);

        //  return false;

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/Transaction/Logistic/Save-suplimentry-trip-save'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                 var data1 = JSON.parse(data);

                 console.log(data);

               if(data1.response=='error'){
                  var responseVar =false;

                    var url = "{{ url('/Transaction/View-Trip-Expense-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar =true;
                  if(downloadFlg == 1){
                      var fyYear   = data1.data[0].FY_CODE;
                      var fyCd     = fyYear.split('-');
                      var seriesCd = data1.data[0].SERIES_CODE;
                      var vrNo     = data1.data[0].VRNO;
                      var fileN    = 'TRIPEXP_'+fyCd[0]+''+seriesCd+''+vrNo;
                      var link = document.createElement('a');
                      link.href = data1.url;
                      link.download = fileN+'.pdf';
                      link.dispatchEvent(new MouseEvent('click'));
                  }
                  var url = "{{ url('/Transaction/View-Trip-Expense-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }

              },

          });
      
  }


       
</script>


@endsection