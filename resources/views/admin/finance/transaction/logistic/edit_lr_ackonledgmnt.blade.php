@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')



<style type="text/css">

    .tooltip{
      color: #66CCFF !important;
    }

  .PageTitle{
    margin-right: 1px !important;
  }

  .texIndbox1{
        width: 5%; 
        text-align: center;
        font-size: 12px;
        padding:0px 5px 0px 5px !important;

        }
    .itemdetailshead{

      padding:4px 0px 4px 0px !important;
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

  .secondSection{

    display: none;
  }

  .rightcontent{

  text-align:right;


}
.hidebtn{
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

  .hideinmobile{
    display: none;
  }

}


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

  width: 100px;

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

.settblebrodr{
  border: 1px solid #cac6c6;
}

.tdlboxshadow{

  box-shadow: 0px 1px 4px -1px rgba(161,155,161,1);

}



.btn {

    display: inline-block;

    font-weight: 400;

    text-align: center;

    vertical-align: middle;

    cursor: pointer;

    -webkit-user-select: none;

    -moz-user-select: none;

    -ms-user-select: none;

    user-select: none;

    padding: .375rem .75rem;

    font-size: 14px;

    line-height: 1.5;

    border-radius: .25rem;

    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.btn-success {

    color: #fff;

    background-color: #28a745;

    border-color: #28a745;

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

.container{

    max-width: 1200px;

    margin: 0px auto;

    padding: 0px 15px;

}

.inputboxclr{

  border: 1px solid #d7d3d3;
  margin-bottom:2px !important;
}

.tdthtablebordr{
  border: 1px solid #00BB64;
  padding: 2px !important;
  padding-bottom: 2px !important;
}

input:focus{border:1px solid yellow;} 

.space{margin-bottom: 2px;}

.but{

    width:105px;

    background:#00BB64;

    border:1px solid #00BB64;

    height:40px;

    border-radius:3px;

    color:white;

    margin-top:10px;

    margin:0px 0px 0px 11px;

    font-size: 14px;

}

.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 0px;

    padding-bottom: 0px !important;

    line-height: 1;

    vertical-align: top;

    border-top: 1px solid #ddd;

    text-align: center;

    border-top: 1px solid #83e25c;
}

.ref::before {

  color: navy;

  content: "Ch :";
}

.toalvaldesn{

    text-align: right;

    font-weight: 800;

    margin-top: 1%;
}

.debitotldesn{

    width: 277%;

    margin-left: 45%;

    text-align: end;

}

.credittotldesn{

    width: 277%;

    margin-left: -11%;

    text-align: end;
}

.debitcreditbox{

  width: 91px;

  text-align: end;
}

.savebtnstyle{

    color: #fff;

    background-color: #204d74;

    border-color: #122b40;
}

.cnaclbtnstyle{

    color: #fff;

    background-color: #d9534f;

    border-color: #d43f3a;
}

.instrumentlbl{

    font-size: 12px;

    margin-left: -5px;
}

.instTypeMode{

    width: 56%;

    margin-bottom: 5px;
}

.textdesciptn{

  width: 250px;

  margin-bottom: 5px;
}

.tdsratebtn{

  margin-top: 3% !important;
  font-weight: 600 !important;
  font-size: 10px !important;

}
.viewbtnitem{
    padding-bottom: 0px;
    padding-top: 0px;
    font-size: 12px;
    margin-bottom: 4px;
}

.tdsInputBox{

  margin-bottom: 2%;

}

.modltitletext{
  font-weight: 800;
  color: #5696bb;
  text-align: center;
  font-size: 16px;
}

.textSizeTdsModl{

  font-size: 13px;

}

.btn_new{
    display: inline-block;
    font-weight: 600;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding: 0.375rem 0.75rem;
    font-size: 14px;
    line-height: 1.5;
    border-radius: 1.25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.bankshowwhenrecpt{

  display: none !important;
}

.setboxWidthIndex{

  width: 25px;

  border: 1px solid #b8b6b6;

}

.SetInCenter{

  margin-top: 18%;

}

.AddM{

  width: 24px;

}
.divhsn{
      color: #3c8dbc;
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 8%;
}
.showdetail{
  display: none;

}
.showcodename{
  color: #5696bb;
    font-size: 13px;
    font-weight: 600;
}
.aplynotStatus{
  display: none;
}
@media screen and (max-width: 600px) {

  .debitotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: 13%;

  }

  .credittotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: -34%;
  }

  .totlsetinres{

    width: 130%;
    padding:2px;

  }

  .textdesciptn{

    margin-bottom: -1%;

  }

  .debitcreditbox{

    margin-top: 0%;

  }

  .rowClass{

    overflow-x: scroll;

  }

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

            LR Ackonwledgment
 
            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Logistics</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Add LR Ackonwledgment</a></li>

          </ol>

        </section>


<form id="salesordertrans">
      @csrf

  <section class="content">

    <div class="row">

     

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add LR Ackonwledgment</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Transaction/Logistic/View-lr-acknowledgment-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View LR Ackonwledgment</a>

              </div>

              

                  <div class="box-tools pull-right">

                    <a href="{{ url('/Transaction/Logistic/View-lr-acknowledgment-trans') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View LR Ackonwledgment</a>

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

                                if($get_Month > 3 && $get_year == $fyYear[1]){
                                    $vrDate = $ToDate;
                                }else{
                                    $vrDate = $CurrentDate;
                                }

                              ?>

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control transdatepicker" name="vr_date" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

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

                          <input list="deliveryList" class="form-control" name="trip_no" id="trip_no"  value="<?=  $trip_data[0]->TRIP_NO ?>" placeholder="Enter Trip No" onchange="getTripDetials()" autocomplete="off" readonly/>

                          <datalist id="deliveryList">

                            <?php foreach($trip_list as $key) { 

                                        $vrNo = $key->VRNO;
                              
                                        $SericeCode = $key->SERIES_CODE;
                                        
                                        $FyYr = $key->FY_CODE;

                                        $getYr = explode("-",$FyYr);

                                        $BgYr = $getYr[0];

                                        $newVrNo = $BgYr.' '.$SericeCode.' '.$vrNo;

                              ?>

                            <option value="<?= $newVrNo ?>~<?= $key->TRIPHID ?>" data-xyz="<?= $key->TRIPHID ?>"><?= $newVrNo ?> - <?= $key->VEHICLENO ?> - <?= $key->ACC_NAME ?>- <?= $key->TO_PLACE ?></option>

                            <?php } ?>
                            
                          </datalist>

                      </div>


                      <input type="hidden" name="tripid" id="tripid">
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
                          <input list="vehicleList" class="form-control" name="vehicle_no" id="vehicle_no" value="<?=  $trip_data[0]->VEHICLE_NO ?>" placeholder="Enter Vehicle No"  oninput="this.value = this.value.toUpperCase()"  onchange="getTripDetials()" autocomplete="off" readonly>
                            <datalist id="vehicleList">
                              
                              <?php foreach ($trip_list as $key) { ?>
                                
                              <option value="<?= $key->VEHICLENO ?>~<?= $key->TRIPHID ?>" data-xyz="<?= $key->TRIPHID ?>"><?= $key->VEHICLENO ?> - <?= $key->ACC_NAME ?> - <?= $key->TO_PLACE ?></option>

                              <?php   } ?>

                            </datalist>
                        </div>
                       <!--   <input type="hidden" name="trip_day" id="trip_day" value=""> -->
                          <input type="hidden" name="off_day" id="off_day" value="">

                         <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                          
                            </div>  
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>
                     <input type="hidden" name="tripHid" id="tripHid" value="">

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       LR NO : 


                      </label>

                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                          <input list="lrList" class="form-control" name="trip_lr_no" id="trip_lr_no" value="<?=  $trip_data[0]->LR_NO ?>" placeholder="Enter LR NO "  oninput="this.value = this.value.toUpperCase()"  onchange="getTripDetials()" autocomplete="off" readonly>
                            <datalist id="lrList">
                              
                              <?php foreach ($trip_list as $key) { ?>
                                
                              <option value="<?= $key->LR_NO ?>~<?= $key->TRIPBID ?>" data-xyz="<?= $key->TRIPBID ?>"><?= $key->LR_NO ?> - <?= $key->ACC_NAME ?> - <?= $key->TO_PLACE ?></option>

                              <?php   } ?>

                            </datalist>
                        </div>
                       <!--   <input type="hidden" name="trip_day" id="trip_day" value=""> -->
                          <input type="hidden" name="off_day" id="off_day" value="">

                         <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                          
                            </div>  
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>
                     <input type="hidden" name="tripHid" id="tripHid" value="">

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
                              
                            <input list="seriesList1"  id="series_code" name="series_code" class="form-control  pull-left" value="<?=  $trip_data[0]->SERIES_CODE ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();" readonly>

                            <datalist id="seriesList1">

                              <option selected="selected" value="">-- Select --</option>

                             

                            </datalist>

                          </div>

                          <small id="series_code_errr" style="color: red;"></small>

                        </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->

                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Series Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>


                              <input type="text" class="form-control" name="series_name" value="" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off" value="<?=  $trip_data[0]->SERIES_NAME ?>">

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
                             
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="<?=  $trip_data[0]->PLANT_CODE ?>" readonly autocomplete="off" onchange="PlantCode()">

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

                              <input type="text" class="form-control" name="plant_name" value="<?=  $trip_data[0]->PLANT_NAME ?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

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
                              <input type="text"  id="profitctrId" name="pfct_code" class="form-control  pull-left" placeholder="Select Profit Center Code" value="<?=  $trip_data[0]->PFCT_CODE ?>" readonly >


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

                              <input type="text" class="form-control" name="pfct_name" id="pfctName" placeholder="Enter Profit Center Name" value="<?=  $trip_data[0]->PFCT_NAME ?>" readonly>

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
                
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="<?=  $trip_data[0]->ACC_CODE ?>" placeholder="Select Customer" readonly="" 
                              > 

                              <datalist id="AccountList">

                              
                                @foreach ($getacc as $key)

                               <option value='<?php echo $key->ACC_CODE?>'  data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?></option>

                                @endforeach

                              </datalist>

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

                              <input type="text" class="form-control" name="acctname" value="<?=  $trip_data[0]->ACC_NAME ?>" id="accountName" placeholder="Enter Department Name" readonly autocomplete="off" >

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

                          <input list="fromplaceList" class="form-control" name="from_place" id="from_place"  value="<?=  $trip_data[0]->FROM_PLACE ?>"  placeholder="Enter From Place" autocomplete="off" readonly/>

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


                          <input list="toplaceList"  id="to_place" name="to_place" class="form-control pull-left" value="<?=  $trip_data[0]->TO_PLACE ?>" placeholder="Enter To Place" autocomplete="off" readonly>

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

                    <!-- /.form-group -->

                  </div>

                     <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Transporter Code: 

                        <!-- <span class="required-field"></span> -->

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input list="transportList" class="form-control" name="transporter_code"   id="transporter_code" placeholder="Enter Transporter" autocomplete="off"  value="<?=  $trip_data[0]->TRANSPORT_CODE ?>" onchange="getRate()" readonly="">

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

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Transporter Name: 

                      <!--   <span class="required-field"></span> -->

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control" name="transporter_name" id="transporter_name"  value="<?=  $trip_data[0]->TRANSPORT_NAME ?>" placeholder="Enter Transporter" autocomplete="off" readonly="">

                            

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

                       Lorry Receipt Date: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                          <?php $lr_date = date('d-m-Y',strtotime($trip_data[0]->LR_DATE)); ?>
                          <input type="text" class="form-control" name="lr_date" id="lorry_date" placeholder="Enter Lr Date" autocomplete="off" readonly=""  value="<?=  $lr_date ?>" />

                          

                      </div>



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

                        <input type="text" name="reporting_dt" class="form-control datepicker"  id="reporting_dt"  placeholder="Enter Reporting Date" autocomplete="off" >

                         

                      </div>


                    </div>

                  </div> -->
                


                  

                   <div class="col-md-3">

                    <div class="form-group">

                      <label>

                       Ack Date : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>


                            <?php $ack_date = date('d-m-Y',strtotime($trip_data[0]->ACK_DATE)); ?>

                        <input type="text" name="ack_date" class="form-control ArrDate"  id="ack_date"  placeholder="Enter Ack Date" autocomplete="off"  value="<?=  $ack_date ?>">

                         

                      </div>



                      

                      

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('trip_achive_dt', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>


                    <!-- /.form-group -->

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

                        <?php $delivery_date = date('d-m-Y',strtotime($trip_data[0]->DELIVERY_DATE)); ?>

                        <input type="text" name="delivery_dt" class="form-control datepicker"  id="delivery_dt" onchange="getDeliveryDate()" placeholder="Enter Trip Achive Date" autocomplete="off" value="<?=  $delivery_date ?>">

                         

                      </div>



                      

                      

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('trip_achive_dt', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>


                    </div>


                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-2">
                     <label>

                     Trip Plant Day: 

                      

                      </label>

                  <div class="input-group">
                      <input type="text" name="trip_day" id="trip_day" class="form-control" value="<?=  $trip_data[0]->TRIP_DAY ?>" placeholder="Day" readonly="" style="text-align: right;">

                    </div>
                  </div>

                  <div class="col-md-1">
                     <label>

                      Actual Day: 

                      </label>

                  <div class="input-group">
                      <input type="text" name="achive_day" id="achive_day" class="form-control" placeholder="Day" value="<?=  $trip_data[0]->DELIVERY_DAY ?>" readonly="">

                    </div>
                  </div>

                  <div class="col-md-2">
                     <label>

                      Vehicle Owner: 

                        <span class="required-field"></span>

                      </label>

                  <div class="input-group">
                      <input type="text" name="vehicle_owner" id="vehicle_owner" class="form-control" placeholder=" Vehicle Owner" readonly="" value="<?=  $trip_data[0]->OWNER ?>">

                    </div>
                  </div>

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

<section class="content" style="min-height: 200px;padding-top: 0px !important;margin-top: -15px;">
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

                  <div class="boxer"  id="itemTable" style="padding:2px !important;">
                  
                     <div class='box-row'><div class='box10 texIndbox1 itemdetailshead'>ITEM CODE</div><div class='box10 texIndbox1 itemdetailshead'>ITEM REMARK</div><div class='box10 texIndbox1 itemdetailshead'>DO NO</div><div class='box10 texIndbox1 itemdetailshead'>LR NO</div><div class='box10 texIndbox1 itemdetailshead'>DELIVERY NO</div><div class='box10 texIndbox1 itemdetailshead'>INVOICE NO</div><div class='box10 texIndbox1 itemdetailshead'>MATERIAL AMT</div><div class='box10 texIndbox1 itemdetailshead'>ISSUED QTY</div><div class='box10 texIndbox1 itemdetailshead'>LR QTY</div><div class='box10 texIndbox1 itemdetailshead'>RECD QTY</div><div class='box10 texIndbox1 itemdetailshead'>SHORTAGE QTY</div></div>
                    

                      <?php foreach ($trip_data as $key) { ?>
                     <div class='box-row'>
                       
                     <div class='box10 texIndbox1'><input style='padding: 0px;border:none;' type='text' value='<?= $key->ITEM_CODE ?>' name='item_code[]' id='item_code' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;border:none' type='text' value='<?= $key->ITEM_NAME ?>' name='item_name[]' id='item_name' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none' type='text' value='' name='do_name[]'  id='do_name' value='<?= $key->DO_NO ?>' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none' type='text' value='<?= $key->LR_NO ?>' name='lr_no[]'  id='lr_no' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none' type='text' value='<?= $key->DELIVERY_NO ?>' name='delivery_no[]' id='delivery_no' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none' type='text' value='<?= $key->INVC_NO ?>' name='invc_no[]' id='invc_no' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;border:none' type='text' value='<?= $key->MATERIAL_VAL ?>' name='material_value[]' id='material_value' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' value='<?= $key->QTY ?>'  id='issue_qty' name='issue_qty[]' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' value='<?= $key->NET_WEIGHT ?>'  id='net_qty' name='net_qty[]'  readonly=''/></div><div class='box10 texIndbox1' style=''><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' value='<?= $key->RECD_QTY ?>' name='recd_qty[]' id='recd_qty'  oninput='getShortagQty()'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 91px;text-align: right;border:none' type='text' value='<?= $key->SHORTAGE_QTY ?>' name='shortage_qty[]' id='shortage_qty' readonly=''/></div>

                    </div>
                    <?php } ?>

                   </div>

                 
                  

                 </div>

                  <div id="total" style="float:right;"></div>

                 
                </div>
              </div>
         </div>
      

     </div>
     
     </div>
  </div>

</section>

<section class="content" style="margin-top: -13%;" id="bodyId">

    <div class="row">

      <div class="col-sm-12">

               
          <ul class="nav nav-tabs">
                <li class="active"  style="float: none !important;">
                  <a href="#tab1info" id="basicInfo" data-toggle="tab" style="line-height: 0.428571 !important;"><b>Expenses Charged To Transfer</b></a>
                </li>
                <!-- <li id="secondTab">
                  <a href="#tab2info" data-toggle="tab" >Other Details</a>
                </li> -->
            </ul>
        <div class="box box-primary Custom-Box">

          <div class="box-body">
           
            <!-- <form id="salesordertrans">
              @csrf -->
              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                  
                  <input type="hidden" name="comp_name" value="<?php echo Session::get('company_name'); ?>">
                  <input type="hidden" name="fiscal_year" value="<?php echo Session::get('macc_year'); ?>">
                  <tr>

                    <!-- <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th> -->

                    <th style="width: 10px;"> Sr.No.</th>
                    
                  
                    <th>PENALTY </th>
                    <th>DESCRIPTION</th>
                    <th>PENALTY TYPE </th>
                    <th>GL CODE /GL NAME</th>
                    <th>REMARK </th>
                    <th>AMOUNT </th>
                    
                   
                  </tr>


                 
                <?php   $srno = 1; $inddicator=[]; $chargeamt=[]; $num=1; $count = count($penalty_list); foreach($penalty_list as $row)  { 

                        if($row->INDEX_CODE == 'L'){
                          $addAmtClass='data-action="add"';
                        }else if($row->INDEX_CODE == 'M'){
                          $addAmtClass='data-action="sub"';
                        }


                        foreach ($trip_exp_charge as $key){

                          $inddicator[]  = $key->INDICATOR;
                          $chargeamt[]   = $key->AMOUNT;
                         
                          $num++;

                          //$num = $num1 - 1;
                          
                        } 

                        $slno = $srno - 1;

                       //print_r($chargeamt);

                  ?>


                   

                  
                  <tr class="useful">

                   <!--  <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td> -->

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;"><?= $srno ?>.</span>
                    </td> 

                    <td class="tdthtablebordr tooltips">

                       <input type="text" class="inputboxclr" style="width: 70px;" id='penalty<?= $srno ?>' name="penalty[]" value="<?= $row->PENALTY_CODE  ?>" />
                      


                    </td>
                     <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr" style="width: 180px;" id='description<?= $srno ?>' name="description[]" value="<?= $row->HEAD  ?>" />
                     

                    </td>
                     <td class="tdthtablebordr tooltips">

                       <input type="text"  class="inputboxclr" style="width: 120px;" id='penalty_type<?= $srno ?>' name="penalty_type[]" value="<?= $row->INDEX_CODE  ?>-<?= $row->INDEX_NAME ?>" />

                       

                    </td>

                    <td class="tdthtablebordr tooltips">

                      <input type="text" class="inputboxclr" style="width: 60px;" id='gl_code<?= $srno ?>' name="gl_code[]" value="<?= $row->GL_CODE  ?>" />

                       <input type="text" class="inputboxclr" style="width: 120px;" id='gl_name<?= $srno ?>' name="gl_name[]" value="<?= $row->GL_NAME  ?>" />
                     

                    </td>

                    <td class="tdthtablebordr" >
                     
                        <div style="display: inline-flex;border: none;">

                        <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter moneyformate"  id='remark<?= $srno ?>' name="remark[]" style="width: 120px;margin-top: 0px;" />

                      </div>
                          
                     
                      
                      
                    </td>

                     <td class="tdthtablebordr">

                      <div style="display: inline-flex;border: none;">
                        
                      <input type='text' class="debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate"  <?php echo $addAmtClass;?> id='amount<?= $srno ?>' name="amount_exp[]" value="<?php if(in_array($row->PENALTY_CODE, $inddicator)){echo $chargeamt[$slno]; } ?>" oninput='Getqunatity(<?= $srno ?>)'style="width: 80px;margin-top: 0px;" autocomplete="off" />
                      <input type="hidden" id="qtyget<?= $srno ?>" class="totlqty">
                     <!--  <input type="text" name="unit_M[]" id="UnitM1" class="inputboxclr SetInCenter AddM"> -->

                      <input type="hidden" id="Cfactor1">

                      </div>
                       <div><small id="errmsgqty1"></small></div>

                    </td>

                   
                  </tr>

                <?php  $srno++; } ?>

                 <input type="hidden" class="inputboxclr" style="width: 70px;" id='penalty_count' name="penalty_count[]" value="<?= $count  ?>" />

                </table>

              </div><!-- /div -->

            
              <div class="row" style="display: flex;">

                  <div class="col-md-7"></div>

                    <div class="col-md-3 toalvaldesn">



                   <!--  <div class="totlsetinres">Total :</div>
 -->
                  </div>

                  <div class="col-md-1">
                     <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="basicTotal" value='0' readonly="" style="margin-top: 3px;width: 95px;margin-left:38px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>


        

<!-- 
        <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

        <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button> -->

       

      
      
  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>



  <section class="content" style="min-height: 500px;padding-top: 0px;margin-top:-120px;">


    <div class="row">
     <!--  <div class="col-sm-2"></div> -->

      <div class="col-sm-6">
        <div class="box box-warning Custom-Box">
         
          <div class="box-body">

              <div class="row">

                <div class="col-md-12">


                      <div class="row">

                  
                         <div class="col-md-4">

                            <div class="form-group">

                              <label>

                               Delivery By : 

                              <span class="required-field"></span>

                            </label>

                              <div class="input-group">

                                  <span class="input-group-addon">

                                    <i class="fa fa-caret-right"></i>

                                  </span>

                                <input type="text" name="delivery_by"  id="delivery_by" class="form-control" placeholder="Enter Delivery By" autocomplete="off">

                              </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('delivery_by', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                    <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Delivery Recevied By : 

                     

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="del_recd_by"  id="del_recd_by" class="form-control" placeholder="Enter Delivery Recevied By" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('del_recd_by', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Party Signature : 


                                      
                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <select class="form-control" name="party_sign" id="party_sign"  value="" autocomplete="off">
                                        
                                        <option value="">--SELECT--</option>
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                      </select>


                                  </div>
                             

                                </div>

                          
                              </div>

                           

                      </div>

                      <div class="row">

                          <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                  Party Stamp :

                                   <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                               

                                      <select class="form-control" name="party_stamp" id="party_stamp"  value="<?=  $trip_data[0]->PARTY_STAMP ?>" placeholder="Enter Party Stamp"  autocomplete="off" >
                                        
                                        <option value="YES" <?php if($trip_data[0]->PARTY_STAMP=='YES'){echo 'selected';} ?>>YES</option>
                                        <option value="NO" <?php if($trip_data[0]->PARTY_STAMP=='NO'){echo 'selected';} ?>>NO</option>
                                      </select>


                                  </div>

                                
                                </div>

                              </div>

                              <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Expense Paid By Party:

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                     

                                        <select class="form-control" name="expense_party" id="expense_party"  value="" autocomplete="off">
                                        
                                        <option value="">--SELECT--</option>
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                      </select>


                                  </div>

                                
                                </div>

                              
                              </div>
                             

                             <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                  Deduction Claim By Party :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>


                                      <select class="form-control" name="deduction_claim" id="deduction_claim"  value="" autocomplete="off">
                                        
                                        <option value="">--SELECT--</option>
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                      </select>


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>
                        
                      </div>

                      <div class="row">


                              <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Vehicle Return  :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                       <select class="form-control" name="vehicle_return" id="vehicle_return"  value="" autocomplete="off">
                                        
                                        <option value="">--SELECT--</option>
                                        <option value="YES">YES</option>
                                        <option value="NO">NO</option>
                                      </select>


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>

                              <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Vehicle Return Date  :
                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <input type="text" class="form-control datepicker" name="vehicle_return_date" id="vehicle_return_date"  value="" placeholder="Enter Vehicle Return Date"  autocomplete="off" />


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>

                               <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Warai Recipt No :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="warai_recipt_no" id="warai_recipt_no"  value="" placeholder="Enter Warai Recipt No"  autocomplete="off" />


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>

                              <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Warai Recipt Date  :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <input type="text" class="form-control datepicker" name="warai_recipt_date" id="warai_recipt_date"  value="" placeholder="Enter Warai Recipt Date"  autocomplete="off" />


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>
                            
                          </div>
                      
                   
                  

                </div>
                
              </div>


          </div>
        </div>

      </div>

           <!--  <div class="row">
                   <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Email:</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                      </div>
                      </div>
                  </div>
                </div>
 -->
      <div class="col-sm-6">
        <div class="box box-info Custom-Box">
         
          <div class="box-body">

            <div class="row">
              <div class="col-sm-12">

                 <div class="row">

                        <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Trip Freight No  :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <input type="text" class="form-control" name="trip_freight_no" id="trip_freight_no"  value="" placeholder="Enter Trip Freight No"  autocomplete="off"  style="text-align: right;"/>

                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>


                              <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Trip Freight Qty  :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <input type="text" class="form-control" name="trip_freight_qty" id="trip_freight_qty"  value="" placeholder="Enter Trip Qty"  autocomplete="off"  style="text-align: right;"/>

                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>

                              <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Trip Freight Rate  :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <input type="text" class="form-control" name="trip_freight_rate" id="trip_freight_rate"  value="" placeholder="Enter Trip Freight Rate"  autocomplete="off"  style="text-align: right;"/>

                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>


                            </div>

                            <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Trip Freight Amt  :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <input type="text" class="form-control" name="trip_freight_amt" id="trip_freight_amt"  value="<?=  $trip_data[0]->TRIP_FREIGHT_AMT ?>" placeholder="Enter Trip Freight Amt"  autocomplete="off"  style="text-align: right;"/>

                                      <input type="hidden" name="temptrip_freight_amt" id="temptrip_freight_amt" value="0">
                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>


                               <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Add/Less Charges  :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <input type="text" class="form-control" name="add_less_chrg" id="add_less_chrg"  value="<?=  $trip_data[0]->ADD_LESS_CHRG ?>" placeholder="Enter Add/Less Charges"  autocomplete="off" style="text-align: right;"/>


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>

                               <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Basic Amount  :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <input type="text" class="form-control" name="basic_amt" id="basic_amt"  value="<?=  $trip_data[0]->BASIC_AMT ?>" placeholder="Enter Basic Amount"  autocomplete="off" style="text-align: right;"/>


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>


                              </div>

                              <div class="row">

                                <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Less Addvance  :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <input type="text" class="form-control" name="less_advance" id="less_advance"  value="<?=  $trip_data[0]->LESS_ADVANCE ?>" placeholder="Enter Warai Recipt Date"  autocomplete="off" style="text-align: right;"/>


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>
                              <div class="col-md-4">

                                <div class="form-group">

                                  <label>

                                   Net Amount  :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <input type="text" class="form-control" name="net_amount" id="net_amount"  value="<?=  $trip_data[0]->NET_AMOUNT ?>" placeholder="Enter Net Amount"  autocomplete="off" style="text-align: right;"/>


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>
                   
                            </div>
                  
                        
                
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

  </section>
  


 <section class="content" style="min-height: 500px;padding-top: 0px;margin-top:-173px;">
    <div class="row">
     <!--  <div class="col-sm-2"></div> -->

      <div class="col-sm-12">
         
        <div class="box box-success Custom-Box">
         
          <div class="box-body">

                 <p class="text-center">

                    <button class="btn btn-success btn-sm" type="button" id="submitdata" onclick="submitData()"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                    <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

                  </p>

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

  $( window ).on( "load", function() {

        getvrnoBySeries();
        
        var vr_date = $('#vr_date').val();

        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

         });

        var Plant_code =  $('#Plant_code').val();

      //  alert(Plant_code);
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
               
                  if(data1.data == ''){
                       var profitctr = '';
                       var pfctget = '';
                       var pfctName = '';
                       $('#profitctrId').val(profitctr);
                       $('#pfctName').val(pfctName);
                       $('#getPfctCode').val(pfctget);
                       $('#getPfctName').val(pfctName);
                    }else{

          
                      $('#profitctrId').val(data1.data[0].PFCT_CODE);
                      $('#pfctName').val(data1.data[0].PFCT_NAME);
                      $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                      $('#getPfctName').val(data1.data[0].PFCT_NAME);

                    }

                }

            }

          });


        var series_code =  $("#series_code").val();

         var trip_no =  $("#trip_no").val();

       
 

           if(trip_no==''){
        
             $('#trip_no').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else{

             $('#trip_no').css('border-color','#d2d6de');

           }
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

          $("#basicTotal").val(quantity.toFixed(3));

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

  $(".addmore").on('click',function(){

    var vrType =  $('#vr_type').val();

      if(vrType == 'Payment'){

        var getpaymode = 'To -';

      }else if(vrType == 'Receipt'){

       var getpaymode='By -';

      }

      count=$('table tr').length;

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> </td>";

      data +="<td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr' style='width: 120px;margin-top: 10px;margin-bottom: 8px;' id='penalty"+i+"' name='penalty[]' /></td><td class='tdthtablebordr tooltips'><textarea type='text' class='inputboxclr' style='width: 190px;margin-top: 10px;margin-bottom: 8px;height: 24px;' id='description"+i+"' name='description[]' /></<textarea></textarea></td><td class='tdthtablebordr tooltips'><input list='penaltyTypeList"+i+"' class='inputboxclr' style='width: 120px;margin-top: 10px;margin-bottom: 8px;' id='penalty_type"+i+"' name='penalty_type[]' onchange='getDoDetials("+i+")' /> <datalist id='penaltyTypeList"+i+"'><option value='ADDITION'>ADDITION</option><option value='DEDUCTION'>DEDUCTION</option></datalist></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-top: -9px'><input type='text' class='debitcreditbox dr_amount inputboxclr SetInCenter getqtytotal quantityC moneyformate'  id='amount"+i+"' name='amount[]' oninput='Getqunatity("+i+")'style='width: 80px;' readonly /><input type='hidden' id='qtyget"+i+"' class='totlqty'><input type='hidden' name='unit_M[]' id='UnitM"+i+"' class='inputboxclr SetInCenter AddM'><input type='hidden' id='Cfactor"+i+"'></div><div><small id='errmsgqty"+i+"'></small></div><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item Name/Item Code</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading'><span id='itemCodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='hsncodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='taxcodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemDetailshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemtypeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemgroupshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemclassshow"+i+"'> </span> </div><div class='box10 itmdetlheading'><span id='itemcategoryshow"+i+"'> </span> </div></div> </div></div> <div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div> </div></div></div></td><td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr' style='width: 120px;height: 26px;margin-top: 10px;margin-bottom: 8px;' id='remark"+i+"' name='remark[]' ></td>";

      $('table').append(data);


      i++;

      $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });


       $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

     // endDate: 'today',
      
      autoclose: 'true'

    });


  

  var trip_no = $("#trip_no").val();

  var explode =   trip_no.split(" ");

  var tripno = explode[2];
//alert(tripno);
  

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-trip-details-by-trip-no') }}",

          method : "POST",

          type: "JSON",

          data: {trip_no: trip_no},

          success:function(data){

            var data1 = JSON.parse(data);

           // console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

               
                  $("#deliveryList"+count).empty();

                  $("#do_no"+count).prop('readonly',false);

                  $.each(data1.data, function(k, getData){

                  
                     $("#deliveryList"+count).append($('<option>',{

                      value:getData.DELORDER_NO,

                      'data-xyz':getData.DELORDER_NO,
                      text:getData.DELORDER_NO


                    }));
                    
                    

                  })
                    
                  

              }

          }

    });






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
      $('#basicTotal').val(0.000);
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
  
$(document).ready(function(){

  $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });
  
  });
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
 $('.ArrDate').datetimepicker({

    format:'DD-MM-YYYY hh:mm:ss'
  });
</script>

<script type="text/javascript">
  
  
   $(document).ready(function() {
    
    $("#delivery_by").on('input', function () { 

      var val  = $("#delivery_by").val();

      if(val){

      //  $("#party_stamp").prop('readonly',false);

      }else{
      //  $("#party_stamp").prop('readonly',true);
      }

   });


    $("#party_stamp").on('change', function () { 

      var val  = $("#party_stamp").val();

      if(val){

        $("#submitdata").prop('disabled',false);

      }else{
        $("#submitdata").prop('disabled',true);
      }

   });

  $("#net_weight").on('input', function () { 

      var val  = $("#net_weight").val();


      if(val){

        $("#submitdata").prop('disabled',false);
      }else{
        $("#submitdata").prop('disabled',true);
      }

  });

  $("#material_value1").on('input', function () { 

      var val  = $("#material_value1").val();


      if(val){

        $("#delivery_no").prop('readonly',false);
      }else{
        $("#delivery_no").val('');
        $("#delivery_no").prop('readonly',true);
      }

  });

  $("#delivery_no").on('input', function () { 

      var val  = $("#delivery_no").val();


      if(val){

        $("#gross_weight").prop('readonly',false);
      }else{
        $("#gross_weight").val('');
        $("#gross_weight").prop('readonly',true);
      }

  });


$("#gross_weight").on('input', function () { 

      var val  = $("#gross_weight").val();


      if(val){

        $("#net_weight").prop('readonly',false);
      }else{
        $("#net_weight").val('');
        $("#net_weight").prop('readonly',true);
      }

  });


  

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


      $("#transporter_code").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#transportList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $("#transporter_code").val('');
             $("#transporter_name").val('');

             $('#transporter_code').css('border-color','#d2d6de');
             $('#transporter_code').css('border-color','#ff0000').focus();
             $('#payment_mode').css('border-color','#d2d6de');
             $("#fright_order").val('');
             $("#rate").val('');
             $("#amount").val('');
             $("#fright_order").prop('readonly', false);
             $("#rate").prop('readonly', false);
             $("#amount").prop('readonly', false);
             $("#transporter_name").prop('readonly', false);

          }else{

             $("#transporter_name").val(msg);

             $('#transporter_code').css('border-color','#d2d6de');
             $('#payment_mode').css('border-color','#ff0000').focus();
             $("#fright_order").prop('readonly', true);
             $("#rate").prop('readonly', true);
             $("#amount").prop('readonly', true);
             $("#transporter_name").prop('readonly', true);
          } 

        });


/*
        $("#do_no").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#deliveryList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

         if(msg=='No Match'){

             $(this).val('');
         }

        });*/

        $("#lr_no").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#deliveryList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');

             $('#lr_no').css('border-color','#d2d6de');
             $('#lr_no').css('border-color','#ff0000').focus();
             $('#trip_achive_dt').css('border-color','#d2d6de');
              $("#trip_achive_dt").prop('readonly', true);
          }else{
            $('#lr_no').css('border-color','#d2d6de');
            $('#trip_achive_dt').css('border-color','#ff0000').focus();
            $("#trip_achive_dt").prop('readonly', false);
          }

        });



        $("#trip_achive_dt").bind('change', function () {  

          var val = $(this).val();

    
          if(val==''){

             $(this).val('');

             $('#trip_achive_dt').css('border-color','#d2d6de');
             $('#trip_achive_dt').css('border-color','#ff0000').focus();
            

          }else{
               $('#trip_achive_dt').css('border-color','#d2d6de');
          }

        });
         


        $("#from_place").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#fromplaceList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
             
          }

        });

        $("#to_place").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#toplaceList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
             
          }

        });

        $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
             
          }

        });

        $("#comp_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

         if(msg=='No Match'){

             $(this).val('');
             $('#comp_name').val('');
         }else{
            $('#comp_name').val(msg);
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


  function getItemUm(){

    var ItemCode = $("#item_code").val();

   $.ajax({

            url:"{{ url('get-item-um-aum') }}",

             method : "POST",

             type: "JSON",

             data: {ItemCode: ItemCode},

             success:function(data){

                  var data1 = JSON.parse(data);

                  //console.log(data1.data[0].UM_CODE);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                     $("#um_code").val(data1.data[0].UM_CODE);
                        
                  }
             }

          });

  }


  function getItemQty(srno){

    var ItemCode = $("#ItemCodeId"+srno).val();

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });



    $.ajax({

            url:"{{ url('get-item-trip-plan-qty') }}",

             method : "POST",

             type: "JSON",

             data: {ItemCode: ItemCode},

             success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                     $("#qty"+srno).val('');
                    $("#basicTotal").val('');
                  }else if(data1.response == 'success'){

                     $("#qty"+srno).val(data1.data[0].QTY);


                      gr_amt =0;
                         $(".getqtytotal").each(function () {
                         
                              if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  gr_amt += parseFloat(this.value.replaceAll(',', ''));

                                  
                              }

                            $("#basicTotal").val(gr_amt.toFixed(3));

                          });

                         var allGrandAmount = parseFloat($('#basicTotal').val());
                        
                  }
             }

          });


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

<script type="text/javascript">
  
  function getRate(){

  var basicTotal = $("#basicTotal").val();

  var trans_code = $("#transporter_code").val();



  //var getorder =  fright_order.split(" ");

  //var series_code = getorder[1];
  //var vrno = getorder[2];
//alert(do_no);

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-freight-pur-order-details') }}",

          method : "POST",

          type: "JSON",

          data: {trans_code: trans_code},

          success:function(data){

            var data1 = JSON.parse(data);

            //console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                    var fy_year     =  data1.data[0].FY_CODE;
                    var series_code =  data1.data[0].SERIES_CODE;
                    var vr_no       =  data1.data[0].VRNO;
                    
                    var fy_code     =  fy_year.split("-");
                    
                    var fycode      = fy_code[1];
                    
                    var pordervrno  = fycode+' '+series_code+' '+vr_no;
                    
                    
                    var rate        = data1.data[0].RATE;
                    var amount      =  parseFloat(basicTotal) * parseFloat(rate);
                    
                    
                    $("#rate").val(rate);
                    $("#amount").val(amount);
                    $("#fright_order").val(pordervrno);
                  /*$("#accountName").val(data1.data[0].ACC_NAME);
                  $("#from_place").val(data1.data[0].FROM_PLACE);
                  $("#to_place").val(data1.data[0].TO_PLACE);*/
                  

              }

          }

    });

}

</script>

<script type="text/javascript">

function getLorryDetials(){

  var lr_no = $("#lr_no").val();

  var explode =   lr_no.split(" ");

  var lrno = explode[2];
//alert(tripno);
  if(lr_no){

     $('#lr_no').css('border-color','#d2d6de');
     
  }else{
      
       $('#lr_no').css('border-color','#ff0000');
       $('#lr_no').css('border-color','#ff0000').focus();

       $("#account_code,#accountName").val('');
  }

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-lr-details-by-lr-no') }}",

          method : "POST",

          type: "JSON",

          data: {lr_no: lr_no},

          success:function(data){

            var data1 = JSON.parse(data);

            //console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){


                  var lorry_date = data1.data[0].vrDate;

                  var date = new Date(lorry_date);
                        var month = date.getMonth() + 1;
                       
                          
                        var ds =  date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                        

                  $("#account_code").val(data1.data[0].ACC_CODE);
                  $("#accountName").val(data1.data[0].ACC_NAME);
                  $("#lorry_date").val(ds);
                  $("#vehicle_no").val(data1.data[0].VEHICLE_NO);
                  $("#transporter_code").val(data1.data[0].TRANSPORT_CODE);
                  $("#transporter_name").val(data1.data[0].TRANSPORT_NAME);
                  $("#from_place").val(data1.data[0].FROM_PLACE);
                  $("#to_place").val(data1.data[0].TO_PLACE);
                  $("#trip_day").val(data1.data[0].TRIP_DAY);
                  $("#off_day").val(data1.data[0].OFF_DAY);



                   $('#itemTable').empty();

                   var headtbl = "<div class='box-row'><div class='box10 texIndbox1 itemdetailshead'>ITEM CODE</div><div class='box10 texIndbox1 itemdetailshead'>ITEM REMARK</div><div class='box10 texIndbox1 itemdetailshead'>DO NO</div><div class='box10 texIndbox1 itemdetailshead'>LR NO</div><div class='box10 texIndbox1 itemdetailshead'>DELIVERY NO</div><div class='box10 texIndbox1 itemdetailshead'>INVOICE NO</div><div class='box10 texIndbox1 itemdetailshead'>MATERIAL AMT</div><div class='box10 texIndbox1 itemdetailshead'>LR QTY</div><div class='box10 texIndbox1 itemdetailshead'>RECD QTY</div><div class='box10 texIndbox1 itemdetailshead'>SHORTAGE QTY</div></div>";

                   $('#itemTable').append(headtbl);

                    var srno =1;
                   $.each(data1.data, function(k, getData) {

                      
                    var tableData = "<div class='box10 texIndbox1'><input style='padding: 0px;border:none;' type='text' value='"+getData.ITEM_CODE+"' name='item_code[]' id='item_code"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;border:none' type='text' value='"+getData.ITEM_NAME+"' name='item_name[]' id='item_name"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none' type='text' value='"+getData.DO_NO+"' name='do_name[]'  id='do_name"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none' type='text' value='"+getData.LR_NO+"' name='lr_no[]'  id='lr_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none' type='text' value='"+getData.DELIVERY_NO+"' name='delivery_no[]' id='delivery_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none' type='text' value='"+getData.INVC_NO+"' name='invc_no[]' id='invc_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;border:none' type='text' value='"+getData.MATERIAL_VAL+"' name='material_value[]' id='material_value"+srno+"' readonly=''/></div><div class='box10 texIndbox1' style='color:blue;'><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' value='"+getData.QTY+"'  id='issue_qty"+srno+"' name='issue_qty[]' readonly=''/></div><div class='box10 texIndbox1' style='background-color:#d0e0ed !important;'><input style='padding: 0px;width: 85px;text-align: right;border:none;background-color:#d0e0ed !important;' type='text' value='' name='recd_qty[]' id='recd_qty"+srno+"' oninput='getShortagQty("+srno+")'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 91px;text-align: right;border:none' type='text' value='' name='shortage_qty[]' id='shortage_qty"+srno+"' readonly=''/></div>";

                    $('#itemTable').append(tableData);

                      srno++;
                  });
             
                
                    
                  

              }

          }

    });

}

</script>


<script type="text/javascript">

function getTripDetials(){

  var tripNo = $("#trip_no").val();

  var vehicleNo = $("#vehicle_no").val();

  var trip_lr_no = $("#trip_lr_no").val();

  var penalty_count = $("#penalty_count").val();

 /* var explode =   trip_no.split(" ");

  var tripno = explode[2];*/

  //alert(trip_lr_no);


if(tripNo){

       $('#trip_no').css('border-color','#d2d6de');
    
        var trip_No    = tripNo.split('~');
        var trip_no    =trip_No[0];
        var tripHid    =trip_No[1];

        $('#tripHid').val(tripHid);
        $("#getTripNum").val(trip_no);

        $("#trip_lr_no").prop('readonly',true);
         //$("#getVrDate").val(vr_date);
  }else if(vehicleNo){
       
       $("#account_code,#accountName").val('');

        var splitTrip = vehicleNo.split('~');
        var vehicle_no =splitTrip[0];
        var tripHid    =splitTrip[1];

        $('#tripHid').val(tripHid);

        $("#trip_lr_no").prop('readonly',true);

  }else if(trip_lr_no){

        var splitTrip = trip_lr_no.split('~');
        var lrNo     =splitTrip[0];
        var tripHid    =splitTrip[1];

        $('#tripHid').val(tripHid);
        $("#trip_lr_no").prop('readonly',false);

  }


// var tripHid = $('#tripHid').val();

  /*if(tripno){

     $('#trip_no').css('border-color','#d2d6de');
     
  }else{
      
       $('#trip_no').css('border-color','#ff0000');
      

       $("#account_code,#accountName").val('');
  }*/

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-trip-details-by-trip-no-lr-ack') }}",

          method : "POST",

          type: "JSON",

          data: {trip_no:trip_no,vehicle_no:vehicle_no,tripHid:tripHid,lrNo:lrNo},

          success:function(data){

            var data1 = JSON.parse(data);

            //console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){


                  var vehicle_type = data1.trip_type;


                if(vehicle_type=='VEHICLENO' || vehicle_type=='LR_NO'){

                  var trip_series_code = data1.data[0].SERIES_CODE;
                  var trip_fy_code = data1.data[0].FY_CODE;
                  var trip_fycode = trip_fy_code.split("-");
                  var trip_vrno = data1.data[0].VRNO;
                  //var trip_hid = data1.data[0].TRIPHID;

                  var trip_no = trip_fycode[0]+' '+trip_series_code+' '+trip_vrno;

                  $("#trip_no").val(trip_no);

                  $('#trip_no').css('border-color','#d2d6de');
              
                  }

                  var owner = data1.data[0].OWNER;

                    //console.log('owner',owner);


                 var lorry_date = data1.data[0].LR_DATE;
                 

                  var date = new Date(lorry_date);
                  var month = date.getMonth() + 1;
                          
                  var lr_date =  date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();

                  var report_date = data1.data[0].REPORT_DATE;

                  var r_date = new Date(report_date);
                  var r_month = r_date.getMonth() + 1;
                          
                  var reporting_date =  r_date.getDate() + "-" + (r_month.toString().length > 1 ? r_month : "0" + r_month) + "-" +  r_date.getFullYear();


                  //console.log('lr_date',lr_date);

                  var delivery_date = data1.data[0].DELIVERY_DATE;

                  var d_date = new Date(delivery_date);
                  var d_month = d_date.getMonth() + 1;
                          
                  var del_date =  d_date.getDate() + "-" + (d_month.toString().length > 1 ? d_month : "0" + d_month) + "-" +  d_date.getFullYear();


                  var vehilce_out_dt_new = data1.data[0].VEHICLE_OUT_DT_TIME;
                  
                  if((vehilce_out_dt_new == '') || (vehilce_out_dt_new == null)){

                    var vehicle_out_date = '00-00-0000';
                    console.log('VEHICLE_OUT_DT_TIME column found empty or null in TRIP_BODY table.... Please checked....');

                  }else{

                    var out_date = vehilce_out_dt_new.split(' ');

                    var  vehilce_out_dt =  out_date[0];

                    var vd_date = new Date(vehilce_out_dt);

                    var vd_month = vd_date.getMonth() + 1;
                          
                    var vehicle_out_date =  vd_date.getDate() + "-" + (vd_month.toString().length > 1 ? vd_month : "0" + vd_month) + "-" +  vd_date.getFullYear();

                  }

                  


                  var ackment_date_time =  $("#ack_date").val();

                  var getack_date = ackment_date_time.split(" ");

                  var ackment_date = getack_date[0];


                  $("#account_code").val(data1.data[0].ACC_CODE);
                  $("#accountName").val(data1.data[0].ACC_NAME);
                  $("#tripid").val(data1.data[0].TRIPHID);

                  $("#series_code").val(data1.data[0].SERIES_CODE);
                  $("#seriesName").val(data1.data[0].SERIES_NAME);
                  $("#Plant_code").val(data1.data[0].PLANT_CODE);
                  $("#plantname").val(data1.data[0].PLANT_NAME);
                  $("#profitctrId").val(data1.data[0].PFCT_CODE);
                  $("#pfctName").val(data1.data[0].PFCT_NAME);

                  $("#route_code").val(data1.data[0].ROUTE_CODE);
                  $("#route_name").val(data1.data[0].ROUTE_NAME);
                  $("#trip_day").val(data1.data[0].TRIP_DAY);
                  $("#off_days").val(data1.data[0].OFF_DAY);
                  $("#from_place").val(data1.data[0].FROM_PLACE);
                  $("#to_place").val(data1.data[0].TO_PLACE);
                  $("#vehicle_no").val(data1.data[0].VEHICLE_NO);
                  $("#transporter_code").val(data1.data[0].TRANSPORT_CODE);
                  $("#transporter_name").val(data1.data[0].TRANSPORT_NAME);
                  $("#lorry_date").val(lr_date);
                  $("#reporting_dt").val(reporting_date);
                  $("#delivery_dt").val(del_date);
                  $("#achive_day").val(data1.data[0].TRIP_ACHIVE_DAY);
                  $("#driver_name").val(data1.data[0].DRIVER_NAME);
                  $("#mobile_no").val(data1.data[0].DRIVER_MOBILE);
                  $("#licence_no").val(data1.data[0].LICENCE_NO);
                  $("#driver_add").val(data1.data[0].DRIVER_ADD);

                  $("#vehicle_owner").val(owner);
                 var actual_day = data1.data[0].TRIP_ACHIVE_DAY;
                 //var actual_day = 5;
                 var plan_day = data1.data[0].TRIP_DAY;

                 var day_diff = parseFloat(actual_day) - parseFloat(plan_day);

                 //console.log('day diff',day_diff);
               
                  $("#deliveryList1").empty();

                  $("#do_no1").prop('readonly',false);

                   $('#itemTable').empty();
                    $('#total').empty();

                   var headtbl = "<div class='box-row' style='padding:2px;'><div class='box10 texIndbox1 itemdetailshead'>ITEM CODE</div><div class='box10 texIndbox1 itemdetailshead'>ITEM REMARK</div><div class='box10 texIndbox1 itemdetailshead'>DO NO</div><div class='box10 texIndbox1 itemdetailshead'>LR NO</div><div class='box10 texIndbox1 itemdetailshead'>DELIVERY NO</div><div class='box10 texIndbox1 itemdetailshead'>INVOICE NO</div><div class='box10 texIndbox1 itemdetailshead'>MATERIAL AMT</div><div class='box10 texIndbox1 itemdetailshead'>LR QTY</div><div class='box10 texIndbox1 itemdetailshead'>RECD QTY</div><div class='box10 texIndbox1 itemdetailshead'>SHORTAGE QTY</div></div>";

                   $('#itemTable').append(headtbl);


                    var srno =1;
                    var material_value =0;
                    var qty_total =0;
                    var recdqty_total =0;
                    var shrtqty_total =0;
                   $.each(data1.data, function(k, getData) {

                     material_value += parseFloat(getData.MATERIAL_VAL);
                     qty_total += parseFloat(getData.QTY);
                     recdqty_total += parseFloat(getData.RECD_QTY);
                     shrtqty_total += parseFloat(getData.SHORTAGE_QTY);



                    var tableData = "<div class='box-row'><div class='box10 texIndbox1'><input style='padding: 0px;border:none;' type='text' value='"+getData.TRIPBID+"' name='bodyId[]' id='bodyId"+srno+"' readonly=''/><input style='padding: 0px;border:none;' type='text' value='"+getData.ITEM_CODE+"' name='item_code[]' id='item_code"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;border:none;' type='text' value='"+getData.ITEM_NAME+"' name='item_name[]' id='item_name"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none;' type='text' value='"+getData.DO_NO+"' name='do_name[]'  id='do_name"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none;' type='text' value='"+getData.LR_NO+"' name='lr_no[]'  id='lr_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none;' type='text' value='"+getData.DELIVERY_NO+"' name='delivery_no[]' id='delivery_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none;' type='text' value='"+getData.INVC_NO+"' name='invc_no[]' id='invc_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' value='"+getData.MATERIAL_VAL+"' name='material_value[]' id='material_value"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' value='"+getData.QTY+"'  id='issue_qty"+srno+"' name='issue_qty[]' readonly=''/></div><div class='box10 texIndbox1 clr' id='divrecd_qty"+srno+"'><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' class='inputboxclr clr getlrqtytotal' value='"+getData.RECD_QTY+"' name='recd_qty[]' id='recd_qty"+srno+"' oninput='getShortagQty("+srno+")' autocomplete='off'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 91px;text-align: right;border:none;' type='text' value='"+getData.SHORTAGE_QTY+"' name='shortage_qty[]' id='shortage_qty"+srno+"' readonly=''/></div></div>";

                    $('#itemTable').append(tableData);

              
                    

                      srno++;
                  });
                  

                   var  total_qty = "<div class='totlsetinres' style='padding:2px;'>Total : <input type='text' class='inputboxclr' value='"+qty_total.toFixed(3)+"' id='lrqty_total' style='padding: 0px;width: 85px;text-align: right;font-size: 12px;' readonly/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' id='recdqty_total' value='"+recdqty_total.toFixed(3)+"' class='inputboxclr' style='padding: 0px;width: 85px;text-align: right;font-size: 12px;' readonly/> &nbsp;&nbsp;&nbsp;<input type='text' value='"+shrtqty_total.toFixed(3)+"' id='shrtqty_total' class='inputboxclr' style='padding: 0px;width: 85px;text-align: right;font-size: 12px;' readonly/></div>";
                    
                   $('#total').append(total_qty);


                   /*shortage recovery*/

                  var material_rate =  parseFloat(material_value) / parseFloat(qty_total);

                  var shortage_recy =  parseFloat(material_rate) * parseFloat(shrtqty_total);

                  var shortage_recovery_data =  parseFloat(shortage_recy) * 1.5;

                    //console.log('shortage_recovery',shortage_recovery_data);

                  if(isNaN(shortage_recovery_data)){


                  var  shortage_recovery = '0.00';
                 //  console.log('if');

                  }else{

                   var  shortage_recovery = shortage_recovery_data.toFixed(2);
                    //console.log('else');
                  }

               

                    var getdellDt = del_date.split("-");
                    var getoutDt =  lr_date.split("-");
                 // var getoutDt =  vehicle_out_date.split("-");

                  var getOutwardDt   =   getoutDt[1]+'-'+getoutDt[0]+'-'+getoutDt[2];
                  var getDeliveryDt   =  getdellDt[1]+'-'+getdellDt[0]+'-'+getdellDt[2];


                  var startDay= new Date(getDeliveryDt);  
                  var endDay  = new Date(getOutwardDt); 

                  var dayno = startDay.getDay();


                  //console.log('lr_date',getOutwardDt);
                  //console.log('delivery_date',getDeliveryDt);
                  //console.log('startDay',startDay);
                  //console.log('dayno',dayno);


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
                                      
                  var days_of_delivery = millisBetween / (1000 * 3600 * 24);

                 //console.log('days_of_delivery',day_diff);


                 if(day_diff > 0){

                  var qtyTotal = qty_total.toFixed(3);

                     
                  if(days_of_delivery==1){

                     var late_delivery_charges = parseFloat(qtyTotal * 20) * parseFloat(day_diff);

                  }else if((days_of_delivery > 2 || days_of_delivery < 4)){

                     var late_delivery_charges = parseFloat(qtyTotal * 50) * parseFloat(day_diff);
                    //console.log('dayscharges',late_delivery_charges);

                  }else if((days_of_delivery > 5 || days_of_delivery < 7)){

                      var late_delivery_charges = parseFloat(qtyTotal * 70) * parseFloat(day_diff);

                  }else if((days_of_delivery > 8  || days_of_delivery < 10)){

                      var late_delivery_charges = parseFloat(qtyTotal * 90) * parseFloat(day_diff);

                  }else if(days_of_delivery > 10){

                     var late_delivery_charges = parseFloat(qtyTotal * 110) * parseFloat(day_diff);
                  }else{

                     var  late_delivery_charges = 0.00;
                     //console.log('dayscharges',late_delivery_charges);

                  }

                }else{
                    var  late_delivery_charges = 0.00;
                }
     
                  var getlrlDt = ackment_date.split("-");
                  var getdelDt = del_date.split("-");

                  var getLorryDt   =  getlrlDt[1]+'-'+getlrlDt[0]+'-'+getlrlDt[2];
                  var getDeliveryDt   =  getdelDt[1]+'-'+getdelDt[0]+'-'+getdelDt[2];


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


                   if(actual_day < 15){

                      var lr_penalty_chrges = '0.00';

                    }else if((actual_day > 15) &&  (actual_day <= 20)){

                      var lr_penalty_chrges = '-500';

                    }else if((actual_day >= 21) && (actual_day <= 30)){

                      var lr_penalty_chrges = '-1000';

                    }else if(actual_day >= 31){

                       var lr_penalty_chrges = '-3000';
                    }else{

                    }
                    
                        //console.log('owner',owner)

                        if(owner=='MARKET'){


                             var total, f = $('#basicTotal'),s = $('.getqtytotal');

                             
                             var totalBasic =[];
                             //var bbTotal = [];
                             
                           var bTotal = 0;
                           for (var m = 1; m <= penalty_count; m++) {


                                     var penalty_decs = $("#description"+m).val();
                                     var penalty_type = $("#penalty_type"+m).val();
                                    
                                     
                                     if(penalty_decs=='Shortage Recovery'){

                                       $("#amount"+m).val('-'+shortage_recovery);
                                      
                                       if(penalty_type=='M-LUMSUM DEDUCTION'){

                                         var totalval = $('#amount'+m).val();

                                           totalBasic.push(bTotal);

                                         

                                            bTotal = parseFloat(bTotal) + parseFloat(totalval);

                                            //console.log(bTotal);
                                        /* if(m==1){
                                         }else{
                                            var srno = m - 1;
                                            bTotal = parseFloat(totalBasic[srno]) + parseFloat(totalval);
                                         }
                                         

                                         totalBasic.push(bTotal);*/
                                          
                                       }
                                       
                                     }


                                      if(penalty_decs=='LR Penalty Charges'){

                                       $("#amount"+m).val('-'+lr_penalty_chrges);

                                        var totalval = $('#amount'+m).val();
                                        totalBasic.push(bTotal);

                                        bTotal = parseFloat(bTotal) + parseFloat(totalval);

                                          //  console.log('val2',totalval);

                                     }


                                     if(penalty_decs=='Late Del Charges'){

                                       $("#amount"+m).val('-'+late_delivery_charges);

                                       var totalval = $('#amount'+m).val();
                                        totalBasic.push(bTotal);

                                         bTotal = parseFloat(bTotal) + parseFloat(totalval);

                                          //console.log('val3',totalval);

                                     }

                                    
                                    
                           }

                           //console.log('totalBasic',bTotal);

                          if(isNaN(bTotal)){

                            $("#basicTotal").val(0.00);
                           $("#add_less_chrg").val(0.00);

                          }else{

                            $("#basicTotal").val(bTotal);
                            $("#add_less_chrg").val(bTotal);
                          }
                    
                    }
                          

                  if(owner=='MARKET'){

                  var pfNo= data1.data[0].FPO_NO;
                  var rate_basis = data1.data[0].RATE_BASIS;


                   var pfqty =  parseFloat(data1.data[0].FREIGHT_QTY);
                  var pfrate =  parseFloat(data1.data[0].FPO_RATE);
                  var adv_amt =  parseFloat(data1.data[0].ADV_AMT);

                  //console.log('advanceamt',adv_amt);

                  if(pfqty > qty_total || pfqty > recdqty_total){

                    var total_rate = pfqty * pfrate;


                  }else{

                       if(rate_basis=='LR QTY'){

                         var total_rate = qty_total * pfrate;

                        }else if(rate_basis=='RECIEPT QTY'){

                          var total_rate = recdqty_total * pfrate;

                        }else if(rate_basis=='GUARANTED QTY'){

                          var total_rate = pfqty * pfrate;

                        }else{
                           var total_rate =0.00;

                        }


                  }

                  //console.log('totalrate',total_rate);

                 

                 

                  var net_amount =  parseFloat(total_rate) -  parseFloat(adv_amt);
 

                  $('#trip_freight_no').val(pfNo);
                  $('#trip_freight_qty').val(pfqty.toFixed(3));
                  $('#trip_freight_rate').val(pfrate.toFixed(2));
                  $('#trip_freight_amt').val(total_rate.toFixed(2));
                  $('#temptrip_freight_amt').val(total_rate.toFixed(2));

                  $('#less_advance').val(adv_amt.toFixed(2));
                  var add_less_charges =  $('#add_less_chrg').val();


                  var less_advance     =$('#less_advance').val();
                  var temp_trip_freight_amt = $('#temptrip_freight_amt').val();

                  var basicAmt = parseFloat(temp_trip_freight_amt)  + parseFloat(add_less_charges);

                    $("#basic_amt").val(basicAmt);

                  var freight_amt = parseFloat(temp_trip_freight_amt)  - parseFloat(bTotal);

                  //console.log(freight_amt);

                  var amount      = parseFloat(freight_amt)  - parseFloat(less_advance);

                          // console.log(temp_trip_freight_amt);
                         
                 $('#net_amount').val(amount.toFixed(2));

             //    console.log(freight_amt);

                  //$('#net_amount').val(net_amount.toFixed(2));
                  

                  }else{

                  $('#trip_freight_amt').val('0');
                  $('#temptrip_freight_amt').val('0');

                  $('#less_advance').val('0');

                  $('#net_amount').val('0');

                  }
                  

              }

          }

    });

}

</script>


<script type="text/javascript">

  function getShortagQty(recdQty){

    var issue_qty = $('#issue_qty'+recdQty).val();
    var recd_qty = $('#recd_qty'+recdQty).val();
    var penalty_count = $("#penalty_count").val();
    var material_value = $("#material_value"+recdQty).val();
    var qty_total = $("#lrqty_total").val();
    var actual_day = $("#achive_day").val();
    var plan_day = $("#trip_day").val();
    var getDeliveryDt = $("#delivery_dt").val();
    var getOutwardDt = $("#lorry_date").val();


    if(parseFloat(recd_qty) > parseFloat(issue_qty)){

      $('#recd_qty'+recdQty).val('');
      $('#shortage_qty'+recdQty).val('');


    }else{
                  var startDay= new Date(getDeliveryDt);  
                  var endDay  = new Date(getOutwardDt); 

                  var dayno = startDay.getDay();


                  //console.log('lr_date',getOutwardDt);
                  //console.log('delivery_date',getDeliveryDt);
                  //console.log('startDay',startDay);
                 // console.log('dayno',dayno);


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
                                      
                  var days_of_delivery = millisBetween / (1000 * 3600 * 24);

                //console.log( 'days_of_delivery',day_diff);

                var day_diff = parseFloat(actual_day) - parseFloat(plan_day);


                 if(day_diff > 0){

                  var qtyTotal = qty_total.toFixed(3);

                     
                  if(days_of_delivery==1){

                     var late_delivery_charges = parseFloat(qtyTotal * 20) * parseFloat(day_diff);

                  }else if((days_of_delivery > 2 || days_of_delivery < 4)){

                     var late_delivery_charges = parseFloat(qtyTotal * 50) * parseFloat(day_diff);
                    //console.log('dayscharges',late_delivery_charges);

                  }else if((days_of_delivery > 5 || days_of_delivery < 7)){

                      var late_delivery_charges = parseFloat(qtyTotal * 70) * parseFloat(day_diff);

                  }else if((days_of_delivery > 8  || days_of_delivery < 10)){

                      var late_delivery_charges = parseFloat(qtyTotal * 90) * parseFloat(day_diff);

                  }else if(days_of_delivery > 10){

                     var late_delivery_charges = parseFloat(qtyTotal * 110) * parseFloat(day_diff);
                  }else{

                     var  late_delivery_charges = 0.00;
                     //console.log('dayscharges',late_delivery_charges);

                  }

                }else{
                    var  late_delivery_charges = 0.00;
                }



                  var shortage_qty = parseFloat(issue_qty) - parseFloat(recd_qty);

                  $('#shortage_qty'+recdQty).val(shortage_qty.toFixed(3));
                  $('#shrtqty_total').val(shortage_qty.toFixed(3));


                   var material_rate =  parseFloat(material_value) / parseFloat(qty_total);

                    var shortage_recy =  parseFloat(material_rate) * parseFloat(shortage_qty);

                    var shortage_recovery_data =  parseFloat(shortage_recy) * 1.5;

                     // console.log('shortage_recovery',shortage_recovery_data);

                    if(isNaN(shortage_recovery_data)){


                    var  shortage_recovery = '0.00';
                   //  console.log('if');

                    }else{

                     var  shortage_recovery = shortage_recovery_data.toFixed(2);
                      //console.log('else');
                    }


                        if(actual_day < 15){

                              var lr_penalty_chrges = '0.00';

                            }else if((actual_day > 15) &&  (actual_day <= 20)){

                              var lr_penalty_chrges = '-500';

                            }else if((actual_day >= 21) && (actual_day <= 30)){

                              var lr_penalty_chrges = '-1000';

                            }else if(actual_day >= 31){

                               var lr_penalty_chrges = '-3000';
                            }else{

                            }
                             var totalBasic =[];
                            var bTotal = 0;
                           for (var m = 1; m <= penalty_count; m++) {


                                     var penalty_decs = $("#description"+m).val();
                                     var penalty_type = $("#penalty_type"+m).val();
                                    
                                     if(penalty_decs=='Shortage Recovery'){

                                       $("#amount"+m).val('-'+shortage_recovery);
                                      
                                       if(penalty_type=='M-LUMSUM DEDUCTION'){

                                         var totalval = $('#amount'+m).val();

                                           totalBasic.push(bTotal);

                                            bTotal = parseFloat(bTotal) + parseFloat(totalval);

                                           // console.log(bTotal);
                                        /* if(m==1){
                                         }else{
                                            var srno = m - 1;
                                            bTotal = parseFloat(totalBasic[srno]) + parseFloat(totalval);
                                         }
                                         

                                         totalBasic.push(bTotal);*/
                                          
                                       }
                                       
                                     }

                                      if(penalty_decs=='LR Penalty Charges'){

                                       $("#amount"+m).val('-'+lr_penalty_chrges);

                                        var totalval = $('#amount'+m).val();
                                        totalBasic.push(bTotal);

                                        bTotal = parseFloat(bTotal) + parseFloat(totalval);

                                          //  console.log('val2',totalval);

                                     }

                                     if(penalty_decs=='Late Del Charges'){

                                       $("#amount"+m).val('-'+late_delivery_charges);

                                       var totalval = $('#amount'+m).val();
                                        totalBasic.push(bTotal);

                                         bTotal = parseFloat(bTotal) + parseFloat(totalval);

                                          //console.log('val3',totalval);

                                     }
 
                                    
                           }


                          if(isNaN(bTotal)){

                            $("#basicTotal").val(0.00);
                           $("#add_less_chrg").val(0.00);

                          }else{

                            $("#basicTotal").val(bTotal);
                            $("#add_less_chrg").val(bTotal);
                          }



                         gr_amt =0;
                     $(".getlrqtytotal").each(function () {
                     
                          if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                              //gr_amt1 = parseFloat(qtyval);
                              gr_amt += parseFloat(this.value.replaceAll(',', ''));

                              
                          }

                        $("#recdqty_total").val(gr_amt.toFixed(3));

                      });


    } 

    if(recd_qty==''){
      $('#recd_qty'+recdQty).val('');
      $('#shortage_qty'+recdQty).val('');
    }

   

  }

</script>

<script type="text/javascript">

function getDeliveryDate(){

var lorry_date  = $("#lorry_date").val();
var delivery_dt = $("#delivery_dt").val();
var off_day     = $("#off_day").val();
var trip_day    = $("#trip_day").val();

               

var getlrlDt = lorry_date.split("-");
var getdelDt = delivery_dt.split("-");

var getLorryDt   =  getlrlDt[1]+'-'+getlrlDt[0]+'-'+getlrlDt[2];
var getDeliveryDt   =  getdelDt[1]+'-'+getdelDt[0]+'-'+getdelDt[2];

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




      if(Aachive_days > trip_day)
       {

         $('#remark5').css('border-color','#ff0000');
                        
          /*$("#penalty1").val('D001');
          $("#description1").val('LATE DELIVERY CHARGES');
          $("#penalty_type1").val('DEDUCTION');            
          $("#remark1").val('RB304');
          $("#addmorhidn").prop('disabled',false);  */
                          
          }
      else{

        $('#remark5').css('border-color','#d2d6de');

         /* $("#penalty1").val('');
          $("#description1").val('');
          $("#penalty_type1").val('');
          $("#remark1").val('');
          $("#addmorhidn").prop('disabled',true);*/
          } 




 if(Aachive_days == trip_day) {

 
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

                //console.log('2');
              }

                

      }

}

  }

</script>


<script type="text/javascript">

function getDeliveryDate1(){

  var delivery_dt = $("#delivery_dt").val();

  var lr_no    = $("#lr_no").val();

  var explode =   lr_no.split(" ");

  var lrno = explode[2];



 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-achive-date-for-target-date') }}",

          method : "POST",

          type: "JSON",

          data: {lrno: lrno,trip_achive_dt:trip_achive_dt},

          success:function(data){

           // console.log(data);

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){


                  var target_date = data1.data.TARGET_DATE;
                  var target_days = data1.data.TARGET_DAY;
                  var achive_date = data1.achive_date;

                  var date = new Date(target_date);
                        var month = date.getMonth() + 1;
                        if(data=='0000-00-00'){
                          return '00-00-0000';
                        }else{
                          
                        var caldate =  date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                        }


                        var startDay = new Date(achive_date);  
                        var endDay = new Date(target_date);  
                      
                       
                      var millisBetween = startDay.getTime() - endDay.getTime();  
                      
                  
                        var Aachive_days = millisBetween / (1000 * 3600 * 24);  

                         $("#achive_day").val(Aachive_days);

                         var diff_days =  Aachive_days - target_days;

                        if(Aachive_days > target_days){

                          var amt = 34 * 40 * diff_days;

                          //alert('APPLY LATE DELIVERY CHARGES');

                          $("#penalty1").val('D001');
                          $("#description1").val('LATE DELIVERY CHARGES');
                          $("#penalty_type1").val('DEDUCTION');
                          $("#amount1").val(amt);
                          $("#remark1").val('RB304');
                          $("#addmorhidn").prop('disabled',false);
                        }

                  
                

                    
                  

              }

          }

    });

}


function  getHolidayDate(){

  var trip_holiday = $("#trip_holiday").val();

  if(trip_holiday){

  $("#penalty1").val('');
  $("#description1").val('');
  $("#penalty_type1").val('');
  $("#amount1").val('');
  $("#remark1").val('');


  }else{

  }

}

</script>

<script type="text/javascript">
  
  function itemCodeGet(ItemId){

    var ItemCode =  $('#ItemCodeId'+ItemId).val();

     var xyz = $('#ItemList'+ItemId+' option').filter(function() {

          return this.value == ItemCode;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      

      if(msg=='No Match'){

             $('#ItemCodeId'+ItemId).val('');

             document.getElementById("Item_Name_id"+ItemId).value = '';

             $('#qty'+ItemId).val('');

             $('#A_qty'+ItemId).val('');
             $('#UnitM'+ItemId).val('');
             $('#AddUnitM'+ItemId).val('');
             $('#ItemCodeId'+ItemId).css('border-color','#d2d6de');
             $('#ItemCodeId'+ItemId).css('border-color','#ff0000').focus();
             $('#batchno'+ItemId).html(''); 

      }else{

         document.getElementById("Item_Name_id"+ItemId).value = msg;

         
        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide'); 

         $('#itemNameTooltip'+ItemId).html(msg); 

         $('#remark_data'+ItemId).prop('readonly',false); 
         //$('#vehicle_no').prop('readonly',false); 
         $('#ItemCodeId'+ItemId).css('border-color','#d2d6de');
         

        $('#vr_date,#series_code,#Plant_code,#account_code,#due_days,#emp_code,#cost_center_code').prop('readonly',true); 



      }

     $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

   $.ajax({

          url:"{{ url('get-item-data-requsiton') }}",

          method : "POST",

          type: "JSON",

          data: {ItemCode: ItemCode},

           success:function(data){

                var data1 = JSON.parse(data);
               // console.log('stock',data1.totalstock);
               // console.log('stockbatch',data1.batchNo);

                if (data1.response == 'error') {

                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
                  
                }else if(data1.response == 'success'){

                    if(data1.data==''){

                      var umcode = '';

                      var aumcode = '';

                      var cfactor = '';

                      $('#UnitM'+ItemId).val(umcode);

                      $('#AddUnitM'+ItemId).val(aumcode);

                      $('#Cfactor'+ItemId).val(cfactor);

                      $("#addmorhidn").prop('disabled', true);

                    }else{

                         $("#addmorhidn").prop('disabled', false);

                          $('#UnitM'+ItemId).val(data1.data[0].UM_CODE);

                          $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                          $('#Cfactor'+ItemId).val(data1.data[0].AUM_FACTOR);

                          $('#scrab_code'+ItemId).val(data1.data_hsn[0].SCRAP_CODE);

                          $('#stockavlble'+ItemId).html('Stock : '+data1.totalstock);
                          $('#stockavlblevalue'+ItemId).val(data1.totalstock);

                          if(data1.batchNo==null || data1.batchNo==''){
                          $('#batchno'+ItemId).html('');
                          $('#batch_no'+ItemId).val('');
                          }else{
                            $('#batchno'+ItemId).html('Batch No : '+data1.batchNo);
                            $('#batch_no'+ItemId).val(data1.batchNo);
                          }


                          gr_amt =0;
                         $(".getqtytotal").each(function () {
                         
                              if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  gr_amt += parseFloat(this.value.replaceAll(',', ''));

                                  
                              }

                            $("#basicTotal").val(gr_amt.toFixed(3));

                          });

                         var allGrandAmount = parseFloat($('#basicTotal').val());

                         
                    
                    }

                    //console.log(data1.data_tax[0]);

                } /*if close*/

           }  /*success function close*/

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
 // console.log(otherNumbers);
  if (otherNumbers != '')
    lastThree = ',' + lastThree;
  var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
  return res;
}
  



</script>

<script type="text/javascript">
  
  function Getqunatity(qtyId){

     var stockqty         =$('#stockavlblevalue'+qtyId).val();
     var penalty_type     =$('#penalty_type'+qtyId).val();
     var net_amt          =$('#net_amount').val();
     var trip_freight_amt =$('#trip_freight_amt').val();
    
     var less_advance     =$('#less_advance').val();
     var vehicle_owner    =$('#vehicle_owner').val();
     var temp_trip_freight_amt = $('#temptrip_freight_amt').val();

     var penalty_count = $("#penalty_count").val();

      var bTotal = parseFloat($('#basicTotal').val());

     var indicatorMAmt = 0;

     var inde_M_amt = parseFloat($("#amount"+qtyId).val());


     if(isNaN(inde_M_amt)){

          indm = '';
          $("#amount"+qtyId).val(indm);

        }else{


          if(penalty_type=='M-LUMSUM DEDUCTION'){

             var totalval = $('#amount'+qtyId).val();

              if(totalval > 0){
                  var indicatorMAmt1=  -(totalval);

                }else if(totalval < 0){

                  var indicatorMAmt1=  (totalval);
                }

              
                var indicatorMAmt = indicatorMAmt1;

                 $('#amount'+qtyId).val(indicatorMAmt);

               }else if(penalty_type=='L-LUMSUM'){

                 var totalval = $('#amount'+qtyId).val();

                 $('#amount'+qtyId).val(totalval);

               }


      }

                          

                    
     // $("#basicTotal").val(bTotal);

     gr_a1mt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_a1mt += parseFloat(this.value);

            }

          $("#basicTotal").val(gr_a1mt.toFixed(2));

          $("#add_less_chrg").val(gr_a1mt.toFixed(2));

           var freight_amt = parseFloat(temp_trip_freight_amt)  + parseFloat(gr_a1mt);

           var amount      = parseFloat(freight_amt)  - parseFloat(less_advance);


          // console.log('fright_amt',temp_trip_freight_amt);
          // console.log('addless',gr_a1mt);

           var basicAmt = parseFloat(temp_trip_freight_amt)  + parseFloat(gr_a1mt);

            $("#basic_amt").val(basicAmt.toFixed(2));
           
            $('#net_amount').val(amount.toFixed(2)); 

        });

      /*var total=parseFloat($("#basicTotal").val()), f = $('#basicTotal'),s = $('.getqtytotal');

      s.on('input',function() {
        var t = $(this);
        t.data('i', t.val() * ((t.data('action') == 'sub') ? -1 : 1));
        s.each(function() {
          total += ~~$(this).data('i');
        });
        f.val(total); 

        console.log(total);

        if(total < 0){

          var final_total =  Math.abs(total);

        }else{
          var final_total = total;
        }

         $("#add_less_chrg").val(final_total);

      var freight_amt = parseFloat(temp_trip_freight_amt)  - parseFloat(final_total);

       var amount      = parseFloat(freight_amt)  - parseFloat(less_advance);
       
        $('#net_amount').val(amount); 



      });*/

/*
     if(net_amt){

        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);

        var  gr_amt =0;
        var deductAmt = 0;

      }else{

          $("#submitdata").prop('disabled', true);
          $("#deletehidn").prop('disabled', true);
          $("#addmorhidn").prop('disabled', true);
      }*/

     

  }
</script>

<script type="text/javascript">
  function Getqunatity1(qtyId){

     var checkqty         =$('#qty'+qtyId).val();
     var stockqty         =$('#stockavlblevalue'+qtyId).val();
     var penalty_type     =$('#penalty_type'+qtyId).val();
     var net_amt          =$('#net_amount').val();
     var trip_freight_amt =$('#trip_freight_amt').val();
     var less_advance     =$('#less_advance').val();
     var vehicle_owner    =$('#vehicle_owner').val();

     $("#submitdata").prop('disabled',false);

    
    var penalty =  penalty_type.split('-');
    
    var type_penalty = penalty[0];

   // console.log('erwer',checkqty);

     
     var gr_amt;
     if(checkqty){

         var quantity =$('#qty'+qtyId).val().replaceAll(',', '');
         var cfactor = $('#Cfactor'+qtyId).val();

         //console.log('cftor',cfactor);
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
        $('#qty'+qtyId).val(val);
      }

     
     $('#A_qty'+qtyId).val(total.toFixed(2));

      if(quantity){
      //  $('#rate'+qtyId).prop('readonly',false);
        $("#submitdata").prop('disabled', false);
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);

        

      }else{
        // $('#rate'+qtyId).prop('readonly',true);
         $('#A_qty'+qtyId).val(0.00);
          $("#submitdata").prop('disabled', true);
          $("#deletehidn").prop('disabled', true);
          $("#addmorhidn").prop('disabled', true);
      }


      //console.log('hii');



      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value.replaceAll(',', ''));

                
            }

          $("#basicTotal").val(gr_amt.toFixed(2));
          $("#add_less_chrg").val(gr_amt.toFixed(2));
          var amt = net_amt + gr_amt;
        var  final_net_amt = $("#net_amount").val(amt.toFixed(2)); 

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());

     }else{


       //console.log('hello');

      $('#A_qty'+qtyId).val(0.000);

      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value.replaceAll(',', ''));
                net_amt += parseFloat(this.value.replaceAll(',', ''));

                
            }

          $("#basicTotal").val(gr_amt.toFixed(2));
          $("#add_less_chrg").val(gr_amt.toFixed(2));

         

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());


       var add_less_chrg = parseFloat($('#add_less_chrg').val());

        if(vehicle_owner=='MARKET'){

            var amt = parseFloat(trip_freight_amt) - parseFloat(less_advance)+ parseFloat(add_less_chrg);

           $("#net_amount").val(amt.toFixed(2));
        }else{
          $("#net_amount").val(gr_amt.toFixed(2));
        }

      

     }
    



  }
</script>

<script type="text/javascript">

 function submitData(){


      var trcount=$('table tr').length;



          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/Transaction/Logistic/Save-lr-acknowledgment-trans'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                //console.log(data);

                 var data1 = JSON.parse(data);

                if(data1.response=='error'){
                  var responseVar =false;

                    var url = "{{ url('/Transaction/View-lr-acknowledgment-trans-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar =true;
                 var url = "{{ url('/Transaction/View-lr-acknowledgment-trans-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }

              },

          });
      
  }


       
</script>
@endsection