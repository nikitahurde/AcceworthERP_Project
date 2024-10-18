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
  .actionBTN{
    font-size: 10px;
    /*padding: 0px 2px;*/
    padding: 0.1rem 0.5rem !important;
  }
  .texIndbox1{
    width: 5%; 
    text-align: center;
    font-size: 12px;
  }
  .required-field::before {
    content: "*";
    color: red;
  }
  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }
  .showinmobile{
    display: none;
  }
  ::placeholder {
    text-align:left;
  }
  @media screen and (max-width: 600px) {

    .showinmobile{
      display: block;
    }
    .PageTitle{
      float: left;
    }

  }
  .showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  .btn-info {
    color: #fff;
    background-color: #04a9ff;
    border-color: #04a9ff;

  }
  .text-center{
    text-align: center;
  }
  .title{
    margin-top: 50px;
    margin-bottom: 20px;
  }
  table {
    border-collapse: collapse;
  }

  .table-responsive {
    display: block;
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
  }

  .table {
    width: 100%;
    margin-bottom: 1rem;
    color: #212529;
  }

  .table thead th {
    vertical-align: bottom;
    border-bottom: 2px solid #dee2e6;
  }

  .table td, .table th {
      padding: .75rem;
      vertical-align: top;
  }

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 0px;

    padding-bottom: 0px !important;

    line-height: 1.42857143;

    vertical-align: top;

    border-top: 1px solid #ddd;

    text-align: center;

    border-top: 1px solid #83e25c;
}


.AddM{

  width: 24px;

}
.readOnlyField{
    margin: 3px;
    border-color: rgb(215, 211, 211);
    border: 1px solid #d7d3d3;
    background-color: #eeeeee;
}
</style>




<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Edit Electronic proof of delivery
 
            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Logistics</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Edit Electronic proof of delivery</a></li>

          </ol>

        </section>


<form id="ePodUpdateForm" enctype="multiple/form-data">
      @csrf
  <section class="content">

    <div class="row">

     

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Edit Electronic proof of delivery</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-ePOD-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Electronic proof of delivery</a>

              </div>

              

                  <div class="box-tools pull-right">

                    <a href="{{ url('/view-ePOD-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Electronic proof of delivery</a>

                  </div>



            </div><!-- /.box-header -->

        

          <div class="box-body">

       

               <div class="row">

                      <input type="hidden" name="hidnTripHeadId" value="{{$classData[0]->TRIPHID}}">

                      <!-- /.col -->
                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Date: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                             <?php 

                                $CurrentDate =date("d-m-Y");
                                   
                                $FromDate    = date("d-m-Y", strtotime($fromDate));  
                                   
                                $ToDate      = date("d-m-Y", strtotime($toDate));  
                                   
                                $spliDate    = explode('-', $CurrentDate);
                                   
                                $yearGet     = Session::get('macc_year');
                                   
                                $fyYear      = explode('-', $yearGet);
                                   
                                $get_Month   = $spliDate[1];
                                $get_year    = $spliDate[2];

                                if($get_Month >3 && $get_year == $fyYear[1]){
                                    $vrDate = $ToDate;
                                }else{
                                    $vrDate = $CurrentDate;
                                }

                              ?>

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control" name="vr_date" id="vr_date" value="<?php echo date('d-m-Y',strtotime($classData[0]->VRDATE)) ?>" readonly placeholder="Select Date" autocomplete="off" onchange="vrDate()">

                            </div>

                            <small id="showmsgfordate" style="color: red;"></small>

                            <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>
                        </div>
                            <!-- /.form-group -->
                      </div>
                          <!-- /.col -->
                    <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       Trip No: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control" name="trip_no" id="trip_no"  value="{{$classData[0]->TRIP_NO}}" placeholder="Enter Trip No" autocomplete="off" readonly>

                          <input type="hidden" name="tvehicleNo" id="tvehicleNo" value="">

                      </div>
                      <br>
                      <small id="trip_noErr" class="form-text text-muted" ></small>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('do_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                   

                  </div> 

                    <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Vehicle No : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input type="text" class="form-control" name="truck_no" id="truck_no" placeholder="Vehical No" value="{{$classData[0]->VEHICLE_NO}}"  autocomplete="off" readonly>

                          <input type="hidden" name="t_tripno" id="t_tripno" value="">
   
                        </div>

                        <input type="hidden" name="trip_day" id="trip_day" value="">
                        <input type="hidden" name="off_day" id="off_day" value="">

                        <div class="custom-select">
                          <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                          
                          </div>  
                        </div>
                        <br>
                        <small id="truck_noErr" class="form-text text-muted" ></small>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>



                    </div>

                    <!-- /.form-group -->

                  </div>

                  

                  
                        <!-- /.col -->
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
                              
                            <input type="text" id="series_code" name="series_code" class="form-control  pull-left" value="{{$classData[0]->SERIES_CODE}}" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();" readonly>

                          </div>

                        <br>
                        <small id="series_codeErr" class="form-text text-muted" ></small>

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


                              <input type="text" class="form-control" name="series_name" value="{{$classData[0]->SERIES_NAME}}" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>
                      <!-- /.col -->

                      

                      
                    </div>
                    <!-- /.row -->

                    <div class="row">
            
                   

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                               </span>
                              <input type="text" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="{{$classData[0]->PLANT_CODE}}" readonly autocomplete="off" onchange="PlantCode()">

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

                              <input type="text" class="form-control" name="plant_name" value="{{$classData[0]->PLANT_NAME}}" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

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
                              <input type="text"  id="profitctrId" name="pfct_code" class="form-control  pull-left" placeholder="Select Profit Center Code" value="{{$classData[0]->PFCT_CODE}}" readonly >


                            </div>

                          <small id="profit_center_err" style="color: red;"> </small>

                        </div>
                        <!-- /.form-group -->
                      </div>

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> Profit Center Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" value="{{$classData[0]->PFCT_NAME}}" name="pfct_name" id="pfctName" placeholder="Enter Profit Center Name" readonly>

                            </div>

                        </div>
                        
                    </div>  

                     <div class="col-md-2">

                        <div class="form-group">

                          <label>Customer Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input type="text" id="account_code" name="AccCode" class="form-control  pull-left" value="{{$classData[0]->ACC_CODE}}" placeholder="Select Customer" readonly="" 
                              > 


                            </div>

                            <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                            <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                            <small id="acccode_code_errr" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>


                     
                    </div> <!-- row -->

               <div class="row">

                    <div class="col-md-3">

                        <div class="form-group">

                          <label> Customer Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="acctname" value="{{$classData[0]->ACC_NAME}}" id="accountName" placeholder="Customer Name" readonly autocomplete="off">

                            </div>
                            
                        </div>
                        
                      </div>

                 

                <!-- /.col -->

                   


                      <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       From Place: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control" name="from_place" id="from_place"  value="{{$classData[0]->FROM_PLACE}}" placeholder="From Place" autocomplete="off" readonly/>


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


                          <input type="text"  id="to_place" name="to_place" class="form-control pull-left" value="{{$classData[0]->TO_PLACE}}" placeholder=" To Place" autocomplete="off" readonly>

                          
                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('to_place', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                       <small>
                          <!-- <div class="pull-left showSeletedName" id="makeText"></div> -->
                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                     <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Transporter Code: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control" name="transporter_code" value="{{$classData[0]->TRANSPORT_CODE}}"  id="transporter_code" placeholder=" Transporter Code" autocomplete="off"  readonly="">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('transporter_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Transporter Name: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control" name="transporter_name" id="transporter_name"  value="{{$classData[0]->TRANSPORT_NAME}}" placeholder="Transporter Name" autocomplete="off" readonly="">

                            

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('transporter', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                  

              </div>

            
              <div class="row">

                <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       Trip Date: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control" name="trip_date" value="<?php echo date('d-m-Y' ,strtotime($classData[0]->VRDATE)); ?>" id="trip_date" placeholder="Trip Date" autocomplete="off" readonly="" />

                       
                      </div>

                      <small id="lrdateErr"></small>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('trip_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       Lorry Receipt Date: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control" name="lr_date" id="lorry_date" value="<?php echo date('d-m-Y',strtotime($classData[0]->blrDate)) ?>" placeholder="Lr Date" autocomplete="off" readonly="" />

                          <input type="hidden" name="max_date" id="max_date" value="<?= $GretestDate[0]->DATE ?>">

                      </div>

                      <small id="lrdateErr"></small>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('lr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                  
                  <!-- <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       Reporting  Date : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="reporting_dt" class="form-control datepicker"  id="reporting_dt"  placeholder="Reporting Date" autocomplete="off" >

                         

                      </div>
                      <br>
                    <small id="reporting_dtErr" class="form-text text-muted" ></small>

                  </div>
                   <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('reporting_dt', '<p class="help-block" style="color:red;line-height: 1.0;">:message</p>') !!}

                      </small>
                    
                  </div> -->
                
                 <!-- <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       Ack Date : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                           < ?php 

                              date_default_timezone_set('Asia/Kolkata');

                                $CurrentDate = date("d-m-Y H:i:s");
                                   
                              //  print_r($CurrentDate);

                              ?>

                        <input type="text" name="ack_date" class="form-control ArrDate"  id="ack_date"  value="{{ $CurrentDate }}" placeholder=" Ack Date" autocomplete="off" >

                         

                      </div>

                      <br>
                      <small id="ack_dateErr" class="form-text text-muted" ></small>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('ack_date', '<p class="help-block" style="color:red;line-height: 1.0;">:message</p>') !!}

                      </small>


                    </div>


                     /.form-group 

                  </div>-->

                   <div class="col-md-2">

                    <div class="form-group">

                      <label>Arrival Date & Time: <span class="required-field"></span></label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-caret-right"></i></span>
                          <?php $ariveDate =$classData[0]->ARRIVAL_DATE; 
                              $explodData = explode(' ',$ariveDate);
                              $arivDt = date('d-m-Y',strtotime($explodData[0]));
                              $formArriveDate = $arivDt.' '.$explodData[1].' '.$explodData[2];
                          ?>
                          <input  type="text" name="vechicalArrDT" id="vechicalArrDT" class="form-control ArrDate" placeholder="Arrival Date & Time"  style="z-index: 1;" autocomplete="off"/ value="{{$formArriveDate}}">

                               
                      </div>

                      <br>
                      <small id="vechicalArrDTErr" class="form-text text-muted" ></small>

                      <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('vechicalArrDT', '<p class="help-block" style="color:red;line-height: 1.0;">:message</p>') !!}
                      </small>

                    </div>

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       Delivery Date : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="delivery_dt" class="form-control datepicker" value="<?php echo date('d-m-Y',strtotime($classData[0]->DELIVERY_DATE)) ?>" id="delivery_dt" onchange="getDeliveryDate()" placeholder="Trip Achive Date" autocomplete="off" >

                      </div>

                      <small id="delivery_dtErr" class="form-text text-muted" ></small>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('delivery_dt', '<p class="help-block" style="color:red;line-height: 1.0;">:message</p>') !!}

                      </small>


                    </div>


                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-2">
                     <label>

                      Trip Day: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                        </div>

                        <input type="text" name="achive_day" id="achive_day" value="{{$classData[0]->TRIP_DAY}}" class="form-control" placeholder="Day" readonly="">

                      </div>

                  </div>

                  <div class="col-md-2">
                     <label>

                      Trip plan Day: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                        </div>

                        <input type="text" name="actual_day" id="actual_day" value="{{$classData[0]->TRIP_ACHIVE_DAY}}" class="form-control" placeholder="Day" readonly="">

                        <input type="hidden" name="TripHId" id="TripHId" class="form-control" placeholder="Day" readonly="">

                      </div>

                  </div>
                </div>

                <div class="row">

                  

                  

                 <!--  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       Trip Achive Include Holiday: 

                      
                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="trip_holiday"  id="trip_holiday" class="form-control datepicker" placeholder="Enter Trip Achive Include Holiday" onchange="getHolidayDate()" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gross_weight', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                

                  </div> -->
                    
                
              </div>
          

          </div><!-- /.box-body -->

           

          </div>

      </div>

     


    </div>

  </section>

  <section class="content" style="min-height: 100px;padding-top: 0px !important;margin-top: -15px;">

    <div class="row">
    <!--  <div class="col-sm-2"></div> -->

      <div class="col-sm-12">

        <div class="box box-warning Custom-Box">
      
          <div class="box-body">

            <div class="table-responsive">

              <div class="col-md-12">
                <p style="font-weight: bold;font-size: 12px;margin-top: 5px;">ITEM/DO DETAILS</p>
              </div>

              <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                <tr>

                  <th class="tdthtablebordr">ITEM CODE</th>
                  <th class="tdthtablebordr">ITEM REMARK</th>
                  <th class="tdthtablebordr">DO NO</th>
                  <th class="tdthtablebordr">LR NO</th>
                  <th class="tdthtablebordr">DELIVERY NO</th>
                  <th class="tdthtablebordr">INVOICE NO</th>
                  <th class="tdthtablebordr">MATERIAL AMT</th>
                  <th class="tdthtablebordr">ISSUE QTY</th>
                  <th class="tdthtablebordr">LR QTY</th>
                  <th class="tdthtablebordr">RECD QTY</th>
                  <th class="tdthtablebordr">SHORTAGE QTY</th>

                </tr>

                <?php $srNo=1;$totalIssQty=0;$totalRecdQty=0;$totalShorQty=0;$net_total=0; $rowCount = count($classData); foreach ($classData as $row) { 

                    $totalIssQty  += $row->bISSUED_QTY;
                    $totalRecdQty += $row->bRECD_QTY;
                    $totalShorQty += $row->bSHORTAGE_QTY;
                    $net_total    += $row->NET_WEIGHT;

                ?>

                  <tr>
                    
                    <td class="tdthtablebordr">
                      <input type="hidden" name="hidnTripBodyId[]" value="{{$row->TRIPBID}}">
                      <div class="input-group" style="display:flex;">
                        <input type="text" class="inputboxclr readOnlyField" id='item_code{{$srNo}}' name="item_code[]" placeholder="Enter Item Code" value="{{$row->bITEM_CODE}}" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off"/>
                      </div>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;">
                        <input type="text" class="inputboxclr readOnlyField" id='item_name{{$srNo}}' readonly name="item_name[]" placeholder="Enter Item Name" value="{{$row->bITEM_NAME}}" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>
                      </div>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;">
                        <input type="text" class="inputboxclr readOnlyField" id='do_name{{$srNo}}' readonly name="do_name[]" placeholder="Enter Do Name" value="{{$row->bDO_NO}}" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>
                      </div>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;">
                        <input type="text" class="inputboxclr readOnlyField" id='lr_no{{$srNo}}' readonly name="lr_no[]" placeholder="Enter LR No" value="{{$row->bLR_NO}}" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>
                      </div>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;">
                        <input type="text" class="inputboxclr readOnlyField" id='delivery_no{{$srNo}}' readonly name="delivery_no[]" placeholder="Enter Delivery No" value="{{$row->bDELIVERY_NO}}" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>
                      </div>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;">
                        <input type="text" class="inputboxclr readOnlyField" id='invc_no{{$srNo}}' readonly name="invc_no[]" placeholder="Enter Invoice No" value="{{$row->bINVC_NO}}" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>
                      </div>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;">
                        <input type="text" class="inputboxclr readOnlyField" id='material_value{{$srNo}}' readonly name="material_value[]" placeholder="Enter Invoice No" value="{{$row->bMATERIAL_VAL}}" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>
                      </div>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;">
                        <input type="text" class="inputboxclr readOnlyField" id='issue_qty{{$srNo}}' readonly name="issue_qty[]" placeholder="Enter Issued Qty" value="{{$row->bISSUED_QTY}}" oninput="this.value = this.value.toUpperCase()" style="text-align: end;width: 100px;" autocomplete="off"/>
                      </div>
                    </td>
                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;">
                        <input type="text" class="inputboxclr readOnlyField" id='net_qty{{$srNo}}' readonly name="net_qty[]" placeholder="Enter Issued Qty" value="{{$row->NET_WEIGHT}}" oninput="this.value = this.value.toUpperCase()" style="text-align: end;width: 100px;" autocomplete="off"/>
                      </div>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;">
                        <input type="text" class="inputboxclr" id='recd_qty{{$srNo}}' name="recd_qty[]" placeholder="Enter Recd Qty" value="{{$row->NET_WEIGHT}}" oninput="getShortagQty(<?= $srNo ?>)" style="text-align: end;width: 100px;" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>
                      </div>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;">
                        <input type="text" class="inputboxclr readOnlyField" id='shortage_qty{{$srNo}}' name="shortage_qty[]" placeholder="Enter Shortage Qty" value="{{$row->bSHORTAGE_QTY}}" style="text-align: end;width: 100px;" oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly/>
                      </div>
                    </td>

                  </tr>

                <?php $srNo++;} ?>

                  <tr>
                    <td colspan="">&nbsp;</td>
                    <td colspan="">&nbsp;</td>
                    <td colspan="">&nbsp;</td>
                    <td colspan="">&nbsp;</td>
                    <td colspan="">&nbsp;</td>
                    <td colspan="">&nbsp;</td>
                    <td colspan="">&nbsp;</td>
                    <td class="tdthtablebordr">


                     <div class="input-group" style="display:flex;float:right;">
                        <input type="text" value="<?= number_format((float)$totalIssQty, 3, '.', ''); ?>" id="issQty" style="padding: 0px;width: 100%;text-align: right;" readonly="">
                      </div>
                    </td>
                     <td class="tdthtablebordr">


                     <div class="input-group" style="display:flex;float:right;">
                        <input type="text" value="<?= number_format((float)$net_total, 3, '.', ''); ?>" id="netQty" style="padding: 0px;width: 100%;text-align: right;" readonly="">
                      </div>
                    </td>
                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;float:right;">
                        <input type="text" value="<?= number_format((float)$net_total, 3, '.', ''); ?>" id="recdQty" style="padding: 0px;width: 100%;text-align: right;" readonly="">
                      </div>
                    </td>
                    <td class="tdthtablebordr">
                      <div class="input-group" style="display:flex;float:right;">
                        <input type="text" value="<?= number_format((float)$totalShorQty, 3, '.', ''); ?>" id="shortQty" style="padding: 0px;width: 100%;text-align: right;" readonly="">
                        <input type="hidden" name="totalRow" id="totalRow" value="{{ $rowCount }}">
                      </div>
                    </td>
                  </tr>
                
              </table>
              
            </div><!-- /.table responsive -->

          </div><!-- /.box-body -->
      
        </div><!-- /.Custom-Box -->
     
      </div><!-- /.col-sm-12 -->

    </div><!-- /.row -->

   
  </section>
   
  <section class="content" style="min-height: 200px;padding-top: 0px !important;margin-top: -15px;">
  <div class="row">
    <!-- <div class="col-sm-2"></div> -->
    <div class="col-sm-12">
     <div class="box box-warning Custom-Box">
     
      
         <div class="box-body">
        <div class="row">
        <div class="col-md-12">
          <p style="font-weight: bold;font-size: 12px;">UPLOAD DOCUMENT</p>
        </div>
          <div class="col-md-2"></div>
          <div class="col-md-8">
          
          
           <div class="table-responsive" id="docUpdateTbl">

            <div class="boxer"  id="docUpdateTable">
            
               <div class='box-row'><div class='box10 texIndbox1'>#</div><div class='box10 texIndbox1'>DOCUMENT NAME</div><div class='box10 texIndbox1'>UPLOAD IMAGE</div></div>
               <div id="itemTblBody"></div>
              

             </div>

            </div>
            <div style="margin-top:2% !important;">

            <button type="button" class='btn btn-danger delete actionBTN' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;" ></i>&nbsp; Delete</button>
            
            <button type="button" class='btn btn-info addmore actionBTN' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;" ></i>&nbsp; Add More</button>
         </div>

            

         </div>
         
       
        </div>

        <div class="row col-md-12 text-center" style="margin-top: 10px;">
         <button type="button" class="btn btn-primary" onclick="submitEPODTran()" style="padding-top: 3px;padding-bottom: 3px;font-size: 14px;">Save</button>
        <button type="reset" class="btn btn-warning" style="padding-top: 3px;padding-bottom: 3px;font-size: 14px;">Reset</button>
    </div>

      </div>
      
         

     </div>
     
     </div>
   </div>

   
  </section>
      




</form>
</div>
  




<!-- Modal -->







@include('admin.include.footer')
<script type="text/javascript">

  $(document).ready(function(){
    var lorry_date = $('#lorry_date').val();

    var lorryDtSplit = lorry_date.split('-');

    var formLorryDate = lorryDtSplit[1]+'-'+lorryDtSplit[0]+'-'+lorryDtSplit[2];

    var lrydate = new Date(formLorryDate);

    

    var startDate = new Date();

    var arrDate = $('#vechicalArrDT').val();
    var splitAryDt = arrDate.split(' ');
    
    var formAryDt = splitAryDt[0];
    

   $('.ArrDate').datetimepicker({
     format:'DD-MM-YYYY hh:mm A',
     minDate:lrydate,
     maxDate:startDate,
   });

   $(".ArrDate").on("dp.change", function(e) {
      $(this).data('DateTimePicker').hide();
   });

   $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      //startDate: formAryDt,
     // endDate:'today',
      
      autoclose: 'true'

    });

  });

  function getDeliveryDate(){

   // var lorry_date  = $("#lorry_date").val();
    var lorry_date  = $("#max_date").val();
    var delivery_dt = $("#delivery_dt").val();
    var off_day     = $("#off_day").val();
    var trip_day    = $("#trip_day").val();
    var getlrlDt    = lorry_date.split("-");
    var getdelDt    = delivery_dt.split("-");

    //alert(lorry_date);return false;

    

    var getLorryDt   =  getlrlDt[1]+'-'+getlrlDt[2]+'-'+getlrlDt[0];
    var getDeliveryDt   =  getdelDt[1]+'-'+getdelDt[0]+'-'+getdelDt[2];

    console.log('max_date',getLorryDt);
    console.log('delivery_dt',getDeliveryDt);

    var startDay = new Date(getDeliveryDt);  
    var endDay = new Date(getLorryDt); 

    var dayno = startDay.getDay();

    var days = new Array(7);
            days[0] = "Sunday";
            days[1] = "Monday";
            days[2] = "Tuesday";
            days[3] = "Wednesday";
            days[4] = "Thursday";
            days[5] = "Friday";
            days[6] = "Saturday";


    var delivery_day = days[startDay.getDay()];

    var millisBetween = startDay.getTime() - endDay.getTime();  
                        
    var Aachive_days = millisBetween / (1000 * 3600 * 24);

    $("#achive_day").val(Aachive_days);

    if(Aachive_days > trip_day){

      $('#remark5').css('border-color','#ff0000');
                            
              /*$("#penalty1").val('D001');
              $("#description1").val('LATE DELIVERY CHARGES');
              $("#penalty_type1").val('DEDUCTION');            
              $("#remark1").val('RB304');
              $("#addmorhidn").prop('disabled',false);  */
                              
    }else{

      $('#remark5').css('border-color','#d2d6de');

             /* $("#penalty1").val('');
              $("#description1").val('');
              $("#penalty_type1").val('');
              $("#remark1").val('');
              $("#addmorhidn").prop('disabled',true);*/
    } 

    if(Aachive_days == trip_day){

      if(delivery_day == off_day){

        $("#delivery_dt").val('');

        var dd = $("#delivery_dt").val();

        if(dd==''){

            startDay.setDate(startDay.getDate() + 1); 

            var getdate = startDay.getDate();
            var getMonth=startDay.getMonth()+1;
            var getYear = startDay.getFullYear();
            var duedate1 =getdate+'-'+getMonth+'-'+getYear;
                  
                  var next_day = Aachive_days + 1;
            setTimeout(function(){
               $("#delivery_dt").val(duedate1);
               $("#achive_day").val(next_day);
               }, 200);

          }else{

                    // console.log('2');
          }

      }

    }

  }

  function getShortagQty(recdQty){

    var issue_qty = $('#issue_qty'+recdQty).val();
    var net_qty = $('#net_qty'+recdQty).val();
    var recd_qty = $('#recd_qty'+recdQty).val();
    var tl_row = $('#totalRow').val();
    var recdQtyVal = 0;
    var recdShtVal = 0;
    var recdnetVal = 0;

    if(issue_qty != '' && recd_qty != ''){
       var shortage_qty = parseFloat(net_qty) - parseFloat(recd_qty);
       $('#shortage_qty'+recdQty).val(shortage_qty.toFixed(3));

    }else{
        $('#shortage_qty'+recdQty).val(''); 
    }

   
    if(tl_row > 0){

      for(var i=1;i<=tl_row;i++){

       var calrecQty = $('#recd_qty'+i).val();
       var calnetQty = $('#net_qty'+i).val();
       var calShtQty = $('#shortage_qty'+i).val();
       console.log('calrecQty',calrecQty);
      
       if(calrecQty != '')
        //console.log('recdQtyVal',recdQtyVal);
         recdQtyVal += parseFloat(calrecQty);
         recdnetVal += parseFloat(calnetQty);
         recdShtVal += parseFloat(calShtQty);

         $('#recdQty').val(recdQtyVal.toFixed(3));
         $('#netQty').val(recdnetVal.toFixed(3));

         if(calShtQty != ''){
           $('#shortQty').val(recdShtVal.toFixed(3));
         }
        


      }
      // console.log('recdQtyVal',recdQtyVal);
    }



    // if(parseFloat(recd_qty) > parseFloat(issue_qty)){

    //   $('#recd_qty'+recdQty).val('');
    //   $('#recd_qtyErr'+recdQty).html('*Can not enter greater than issue qty').css('color','red');
    //   $('#shortage_qty'+recdQty).val('');

    // }else{

    //   var shortage_qty = parseFloat(issue_qty) - parseFloat(recd_qty);
    //   $('#recd_qtyErr'+recdQty).html('');
    //   $('#shortage_qty'+recdQty).val(shortage_qty.toFixed(3));
    // } 

    // if(recd_qty==''){
    //   $('#recd_qty'+recdQty).val('');
    //   $('#shortage_qty'+recdQty).val('');
    // }
}
     
        
  $(document).ready(function(){
     $('body').on('click', '#closeModel', function () {
          $('.popover').fadeOut();
    })

//     $('.Number').keypress(function (event) {
//     var keycode = event.which;
//     if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
//         event.preventDefault();
//     }
//     if (keycode == 46 || this.value.length==10) {
//     return false;
//   }
// });
  });

  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });

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

//    $('.RecQtyNumber').keypress(function (event) {
//     var keycode = event.which;
//     // console.log('keycode',keycode);
//     if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
//         event.preventDefault();
//     }
//     if (keycode == 46) {
//     return false;
//   }
// });

$(".RecQtyNumber").on("input", function(evt) {
   var self = $(this);
   self.val(self.val().replace(/[^0-9\.]/g, ''));
   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
   {
     evt.preventDefault();
   }
 });

    
});


  

});


$(function(){

  var i=2;

  $(".addmore").on('click',function(){ 

    var tbltr = parseInt(i) - parseInt(1);
    // console.log('tbltr',tbltr);

    var doc_name = $('#doc_name'+tbltr).val();
    if(doc_name == ''){
      $('#doc_nameErr'+tbltr).html('Enter Document Name').css({'color':'red','font-weight':'600','font-size':'12px'});
      return false;
    }else{
      $('#doc_nameErr'+tbltr).html('');
    }

    var doc_image = $('#doc_imagename'+tbltr).val();

    if(doc_image == ''){
      $('#doc_imageErr'+tbltr).html('Enter Document Name').css({'color':'red','font-weight':'600','font-size':'12px'});
      return false;
    }else{
      $('#doc_imageErr'+tbltr).html('');
    }

    var uploadData = "<div class='box-row'><div class='box10 texIndbox1'><input type='checkbox' class='case' title='Delete Single Row'/></div><div class='box10 texIndbox1'><input  type='text' value='' name='doc_name' id='doc_name"+i+"' autocomplete='off'><br><small id='doc_nameErr"+i+"'></small></div><div class='box10 texIndbox1'><input  type='file' value='' name='doc_imagename' id='doc_imagename"+i+"' autocomplete='off'><br><small id='doc_imageErr"+i+"'></small></div></div>";

    $('#docUpdateTable').append(uploadData);
    i++;
  });

  
});

$(".delete").on('click', function() {
  console.log('log');

    var val =  $('.case:checkbox:checked').val();
    $('.case:checkbox:checked').parents('#docUpdateTable div').remove();
    $('.check_all').prop("checked", false); 

    checkAccommo();
});

function checkAccommo(){

  obj = $('#tblFleetTran tr').find('span');
  $.each( obj, function(key, value) {

      id=value.id;
      $('#'+id).html(key+1);

  });

}

$("#trip_no").bind('change', function () { 
  // console.log('ch');

  var val = $(this).val();
          
  var xyz = $('#deliveryList option').filter(function() {

  return this.value == val;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

   if(msg == 'No Match'){
    $('#tvehicleNo').val('');

   }else{
      $('#tvehicleNo').val(msg);
   }
});

$("#truck_no").bind('change', function () { 
  console.log('ch');

  var val = $(this).val();
          
  var xyz = $('#truckList option').filter(function() {

  return this.value == val;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

   if(msg == 'No Match'){
    $('#t_tripno').val('');

   }else{
      $('#t_tripno').val(msg);
   }
});

// function funvehADt(){
//   console.log('INfun');
//   var vahicleADt = $('#vechicalArrDT').val();
//   if(vahicleADt != ''){
//     console.log('!blank');
//   }else{
//     console.log('-----');
//   }
// }


 var fromdatetrans = $('#FromDateFy').val();
 var todatetrans = $('#ToDateFy').val();

 $('.transdatepicker').datepicker({

        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        startDate :fromdatetrans,
        endDate : 'today',
        autoclose: 'true'
});

function getTripDetials(){

  // console.log('getval',getVal);
  setTimeout(function () {

  var mtrip_no = $('#trip_no').val();
  var mvehicle_no = $('#truck_no').val();
  var set_trip_no = '';
  var set_truckNo = '';
  
  if(mtrip_no || mvehicle_no){

     $('#truck_no').css('border-color','#d2d6de');
     
  }else{
      
       $('#truck_no').css('border-color','#ff0000');
       $('#truck_no').css('border-color','#ff0000').focus();

       $("#account_code,#accountName").val('');
  }

  if(mtrip_no){
    console.log('trip');
    set_truckNo = $('#tvehicleNo').val();
    set_trip_No = mtrip_no ;

   var splitTripId = set_trip_No.split('~');
    var set_trip_no = splitTripId[0];
    var TripId = splitTripId[1];

    $("#TripHId").val(TripId);

  }else if(mvehicle_no){
     console.log('vehicle');
    set_trip_no = $('#t_tripno').val();
    set_truck_No = mvehicle_no;

    var splitTripId = set_truck_No.split('~');
    var set_truckNo = splitTripId[0];
    var TripId = splitTripId[1];
    $("#TripHId").val(TripId);

  }else{

  }

  
  // console.log('set_truckNo',set_truckNo);
  // console.log('set_trip_no',set_trip_no);




 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('/get-truck-details-by-truck-no') }}",

          method : "POST",

          type: "JSON",

          data: {set_truckNo:set_truckNo,set_trip_no:set_trip_no,TripId:TripId},

          beforeSend: function() {
                $('.modalspinner').removeClass('hideloaderOnModl');
          },

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){


                    if(data1.max_data=='' || data1.max_data==null){


                    }else{
                         var max_date = data1.max_data[0].DATE;

                          if(max_date != '' && max_date != null){
                          var m_date = new Date(max_date);
                          var m_month = m_date.getMonth() + 1;
                                
                          var max_Date =  m_date.getDate() + "-" + (m_month.toString().length > 1 ? m_month : "0" + m_month) + "-" +  m_date.getFullYear();
                        }else{
                          var max_Date = '';
                        }

                        $("#max_date").val(max_Date);

                        }

                  // console.log('data', data1.data);

                  var lorry_date = data1.data[0].lr_date;
                  // var lorry_date = '2023-01-28';
                  // console.log('lorry_date',lorry_date);

                  if(lorry_date != '' && lorry_date != null){
                    var date = new Date(lorry_date);
                    var month = date.getMonth() + 1;
                          
                    var lr_date =  date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }else{
                    var lr_date = '';
                  }

                  var vr_date = data1.data[0].VRDATE;

                  if(vr_date != '' && vr_date != null){
                    var v_date = new Date(vr_date);
                    var v_month = v_date.getMonth() + 1;
                          
                    var v_Date =  v_date.getDate() + "-" + (v_month.toString().length > 1 ? v_month : "0" + v_month) + "-" +  v_date.getFullYear();
                  }else{
                    var v_Date = '';
                  }
                  

                  $('.datepicker').datepicker({

                    format: 'dd-mm-yyyy',

                    orientation: 'bottom',

                    todayHighlight: 'true',

                    startDate: date,
                    
                    autoclose: 'true'

                  });

                  $("#account_code").val(data1.data[0].ACC_CODE);
                  $("#accountName").val(data1.data[0].ACC_NAME);
                  $("#route_code").val(data1.data[0].ROUTE_CODE);
                  $("#route_name").val(data1.data[0].ROUTE_NAME);
                  $("#trip_day").val(data1.data[0].TRIP_DAY);
                  $("#actual_day").val(data1.data[0].TRIP_DAY);
                  $("#off_days").val(data1.data[0].OFF_DAY);
                  $("#from_place").val(data1.data[0].FROM_PLACE);
                  $("#to_place").val(data1.data[0].TO_PLACE);
                  $("#truck_no").val(data1.data[0].VEHICLE_NO);
                  // console.log('truckno',data1.data[0].VEHICLE_NO);
                  $("#trip_no").val(data1.data[0].TRIP_NO);
                  $("#transporter_code").val(data1.data[0].TRANSPORT_CODE);
                  $("#transporter_name").val(data1.data[0].TRANSPORT_NAME);
                  // $("#achive_day").val(data1.data[0].TRIP_DAY);
                  $("#lorry_date").val(lr_date);
                
                  $("#Plant_code").val(data1.data[0].PLANT_CODE);
                  $("#plantname").val(data1.data[0].PLANT_NAME);
                  $("#profitctrId").val(data1.data[0].PFCT_CODE);
                  $("#pfctName").val(data1.data[0].PFCT_NAME);
                  $("#series_code").val(data1.data[0].SERIES_CODE);
                  $("#seriesName").val(data1.data[0].SERIES_NAME);
                  $("#trip_date").val(v_Date);

                  // console.log('lr_date',new lr_date);
                   var startDate = new Date();
                   
                   $('.ArrDate').datetimepicker({
                     format:'DD-MM-YYYY hh:mm A',
                     maxDate:startDate,
                   });

                   $(".ArrDate").on("dp.change", function(e) {
                      $(this).data('DateTimePicker').hide();
                   });
                   


                  $("#gate_inward").val();
                  
                  $("#deliveryList1").empty();

                  $("#do_no1").prop('readonly',false);

                   $('#itemTable').empty();
                   $('#total').empty();

                   var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>ITEM REMARK</div><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DELIVERY NO</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>INVOICE NO</div><div class='box10 texIndbox1'>MATERIAL AMT</div><div class='box10 texIndbox1'>ISSUE QTY</div><div class='box10 texIndbox1'>RECD QTY</div><div class='box10 texIndbox1'>SHORTAGE QTY</div></div>";

                   $('#itemTable').append(headtbl);

                    var srno =1;
                    var total =0;
                    var dataLen = data1.data.length;
                    console.log('data',data1.data);
                   $.each(data1.data, function(k, getData) {

                    total += parseFloat(getData.QTY); 
                    
                    var tableData = "<div class='box-row'><div class='box10 texIndbox1'><input style='padding: 0px;border:none;' type='text' value='"+getData.ITEM_CODE+"' name='item_code[]' id='item_code"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;border:none;' type='text' value='"+getData.ITEM_NAME+"' name='item_name[]' id='item_name"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none;' type='text' value='"+getData.DO_NO+"' name='do_name[]'  id='do_name"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none;' type='text' value='"+getData.delivery_no+"' name='delivery_no[]' id='delivery_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 90px;border:none;' type='text' value='"+getData.LR_NO+"' name='lr_no[]'  id='lr_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none;' type='text' value='"+getData.INVC_NO+"' name='invc_no[]' id='invc_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' value='"+getData.MATERIAL_VAL+"' name='material_value[]' id='material_value"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' value='"+getData.QTY+"'  id='issue_qty"+srno+"' name='issue_qty[]' readonly=''/></div><div class='box10 texIndbox1' style=''><input style='padding: 0px;width: 85px;text-align: right;margin-bottom:4%;' type='text' class='RecQtyNumber' value='"+getData.QTY+"' name='recd_qty[]' id='recd_qty"+srno+"' oninput='getShortagQty("+srno+")' autocomplete='off'/><br><small id='recd_qtyErr"+srno+"'style='font-size:12px;line-height: 1.0;'></small></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 91px;text-align: right;' type='text' value='' name='shortage_qty[]' id='shortage_qty"+srno+"' readonly=''/><br><small id='shortage_qtyErr"+srno+"'></small></div></div>";

                      $('#itemTable').append(tableData);



                      srno++;
                  });

                  var footer = '<div class="box-row"><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"><input type="hidden" id="totalRow1" value=""></div><div class="box10 texIndbox1"><input type="text" value="" id="issQty" style="padding: 0px;width: 85px;text-align: right;" readonly/></div><div class="box10 texIndbox1"><input type="text" value="" id="recdQty" style="padding: 0px;width: 85px;text-align: right;" readonly/></div><div class="box10 texIndbox1"><input type="text" value="" id="shortQty" style="padding: 0px;width: 85px;text-align: right;" readonly/></div></div>'; 

                  $('#itemTable').append(footer);
                    
                   

                   var uploadData = "<div class='box-row'><div class='box10 texIndbox1'><input type='checkbox' class='case' title='Delete Single Row' /></div><div class='box10 texIndbox1'><input  type='text' value='' name='doc_name' id='doc_name1' autocomplete='off'><br><small id='doc_nameErr1'></small></div><div class='box10 texIndbox1 form-control-file'><input  type='file' value='' name='doc_imagename' id='doc_imagename1' autocomplete='off' ><br><small id='doc_imageErr1'></small></small></div></div>";

                    $('#docUpdateTable').append(uploadData);

                    $('.addmore').attr('disabled',false);
                    $('.delete ').attr('disabled',false);

                   $('#totalRow1').val(dataLen);
                   $('#issQty').val(total.toFixed(3));
                   $('#recdQty').val(total.toFixed(3));
                   $('#shortQty').val(0);

                   // $('#vechicalArrDT').css('border-color','rgb(255, 0, 0)');

              }  $('.overlay-spinner').removeClass('hideloader');

          }

    });
 }, 1000)

}

$(document).ready(function(){

  $("#updateData").click(function(event) {  

  var item_code = [];
  var recd_qty = [];
  var shortage_qty = [];
  // var docName    = [];
  // var docImageEpod    = []
   
   var truck_no      =  $('#truck_no').val();
   var series_code   =  $('#series_code').val();
   var trip_no       =  $('#trip_no').val();
   var lr_date      =  $('#lorry_date').val();
   var ack_date      =  $('#ack_date').val();
   var vechicalArrDT =  $('#vechicalArrDT').val();
   var delivery_dt   =  $('#delivery_dt').val();
   var achive_day    =  $('#achive_day').val();
   var TripHId    =  $('#TripHId').val();
   var objtwo = $('#item_bodyTbl .box-row');
   var itemb_len = objtwo.length - parseInt(1);
   var docuname = $('#doc_name1').val();
   var docuImg = $('#doc_imagename1').val();

   //alert(TripHId);return false;
   // var docuImg = $("#doc_imagename1").val();
   //  alert (docuImg);
   // console.log('docuImg',docuImg);
   // console.log('docuname',docuname);
   
   //  $('input[name^="doc_name"]').each(function (){
   //        docName.push($(this).val());
   //  });

   // console.log('docName',docName);
   //  $('input[name^="doc_imagename[]"]').each(function (){
   //        docImageEpod.push($(this).val());
   //  });

    // console.log('docImageEpod',docImageEpod);


    if(truck_no == ''){

      $('#truck_noErr').html('Truck No is Required').css('color','red');
      return false;

    }else{

      $('#truck_noErr').html('');
      
    }

    if(series_code == ''){

      $('#series_codeErr').html('Series Code is Required').css('color','red');
      return false;

    }else{

      $('#series_codeErr').html('');
      
    }

    // if(reporting_dt == ''){

    //   $('#reporting_dtErr').html('Series Code is Required').css('color','red');
    //   return false;

    // }else{

    //   $('#reporting_dtErr').html('');
      
    // }

    if(trip_no == ''){

      $('#trip_noErr').html('Series Code is Required').css('color','red');
      return false;

    }else{

      $('#trip_noErr').html('');
    } 

     if(lr_date == ''){

      $('#lrdateErr').html('Lorry Receipt Date is Required').css('color','red');
      return false;

    }else{

      $('#lrdateErr').html('');
    }  

    

    if(ack_date == ''){

      $('#ack_dateErr').html('Ack Date is Required').css('color','red');
      return false;

    }else{

      $('#ack_dateErr').html('');
    }  

    if(vechicalArrDT == ''){

      $('#vechicalArrDTErr').html('Arrival Date & Time is Required').css('color','red');
      return false;

    }else{

      $('#vechicalArrDTErr').html('');
    } 

    if(delivery_dt == ''){

      $('#delivery_dtErr').html('Delivery Date is Required').css('color','red');
      return false;

    }else{

      $('#delivery_dtErr').html('');
    } 

    
    for(var j=1;j<=itemb_len;j++){

     var itemcode  = $('#item_code'+j).val();
     var recdQty  = $('#recd_qty'+j).val();

     var shortageQty =  $('#shortage_qty'+j).val();

      if(recdQty==''){

        $('#recd_qtyErr'+j).html('Received Qunatity is Required').css('color','red');
        return false;

      }else{
        $('#recd_qtyErr'+j).html('');
        item_code.push(itemcode);
        recd_qty.push(recdQty);
        shortage_qty.push(shortageQty);

      }
      // console.log('recd_qty',recd_qty);
      // console.log('shortage_qty',shortage_qty);

    } 
 //    var img
 //   	$('#doc_imagename1').change(function(){
	//  let reader = new FileReader();

	//   img = reader.readAsDataURL(this.files[0]); 

	// });
	// var docuImg = $("#doc_imagename1").get(0).files[0];
 //    console.log('docImg',docuImg);

// var formData = new FormData(this);
    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
    });

    

   $.ajax({

            type: 'POST',
            url:'{{ url("/ePOD-transaction-Save") }}',
            // processData: false,
            // contentType: false,
            data: {truck_no:truck_no,series_code:series_code,trip_no:trip_no,ack_date:ack_date,vechicalArrDT:vechicalArrDT,delivery_dt:delivery_dt,item_code:item_code,recd_qty:recd_qty,shortage_qty:shortage_qty,achive_day:achive_day,docuname:docuname,docuImg:docuImg,TripHId:TripHId},
            // data:formData,
         //    cache : false,
   		    // processData: false,

            success: function (data) {
              var data1 = JSON.parse(data);
              // console.log(data1.response,'data1.response');
              
              if(data1.response == 'success'){

                // console.log('suucess');
               
                var getName = btoa('SUCCESSPOD');
                // console.log('getName',getName);

                var url = "{{url('/logistic/fleet-certificate-tran/success-message')}}";

               window.location = url+'/'+getName;
                       
              }

            }

        });

  });
});


function submitEPODTran(){

    var data = $("#ePodUpdateForm").serialize();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $.ajax({

      type: 'POST',

      url: "{{ url('/ePOD-transaction-Update') }}",

      data: data, // here $(this) refers to the ajax object not form
      success: function (data) {
          
          var data1 = JSON.parse(data);
          if(data1.response == 'error') {
            var responseVar = false;
            var url = "{{url('transaction/epod_update_msg')}}"
            setTimeout(function(){ window.location = url+'/'+responseVar; });
          }else{
            var responseVar = true;
           
            var url = "{{url('transaction/epod_update_msg')}}";
            setTimeout(function(){ window.location = url+'/'+responseVar; });
          }

      },

    });

}

</script>



@endsection