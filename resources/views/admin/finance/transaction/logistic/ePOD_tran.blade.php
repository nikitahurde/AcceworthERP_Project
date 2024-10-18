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

    line-height: 1.42857143;

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

</style>




<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Electronic proof of delivery
 
            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Logistics</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Add Electronic proof of delivery</a></li>

          </ol>

        </section>


<form action="#" method="post" id="ePodSaveForm" enctype="multiple/form-data">
      @csrf
  <section class="content">

    <div class="row">

     

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Electronic proof of delivery</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-ePOD-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Electronic proof of delivery</a>

              </div>

              

                  <div class="box-tools pull-right">

                    <a href="{{ url('/view-ePOD-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Electronic proof of delivery</a>

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

                                if($get_Month >3 && $get_year == $fyYear[1]){
                                    $vrDate = $ToDate;
                                }else{
                                    $vrDate = $CurrentDate;
                                }

                              ?>

                              <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                              <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                              <input type="text" class="form-control transdatepicker" name="vr_date" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off" onchange="vrDate()">

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

                          <input list="deliveryList" class="form-control" name="trip_no" id="trip_no"  value="" placeholder="Enter Trip No" autocomplete="off"   onchange="getTripDetials()" >

                          <datalist id="deliveryList">

                              @foreach($trip_list as $rows)

                                   <option value="{{ $rows->TRIP_NO }}~{{ $rows->TRIPHID }}" data-xyz="<?= $rows->VEHICLE_NO?>">{{ $rows->VRDATE}} - {{ $rows->TRIP_NO}} - <?= $rows->VEHICLE_NO?> - <?= $rows->ACC_NAME?> - <?= $rows->TO_PLACE ?></option>

                              @endforeach
                            
                          </datalist>

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

                          <input list="truckList" class="form-control" name="truck_no" id="truck_no" placeholder="Vehical No" value=""  autocomplete="off"   onchange="getTripDetials()">

                                <datalist id="truckList">
                                  
                                  @foreach($trip_list as $rows)

                                   <option value="{{ $rows->VEHICLE_NO}}~{{ $rows->TRIPHID }}" data-xyz="<?= $rows->TRIP_NO?>">{{ $rows->VRDATE}} - {{ $rows->VEHICLE_NO}} - <?= $rows->TRIP_NO?> - <?= $rows->ACC_NAME?> - <?= $rows->TO_PLACE ?></option>

                                  @endforeach

                                </datalist>

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

                  
                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       LR NO : 


                      </label>

                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                          <input list="lrList" class="form-control" name="trip_lr_no" id="trip_lr_no" value="" placeholder="Enter LR NO "  oninput="this.value = this.value.toUpperCase()"  onchange="getTripDetials()" autocomplete="off">
                            <datalist id="lrList">
                              
                              <?php foreach ($triplr_list as $key) { ?>
                                
                              <option value="<?= $key->LR_NO ?>~<?= $key->TRIPHID ?>" data-xyz="<?= $key->TRIPHID ?>"><?= $key->VRDATE ?> - <?= $key->LR_NO ?> - <?= $key->ACC_NAME ?> - <?= $key->TO_PLACE ?></option>

                              <?php   } ?>

                            </datalist>

                            <input type="hidden" name="t_lrno" id="t_lrno" value="">
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
                              <?php $sriescount =  count($series_list); ?>
                            <input list="seriesList1"  id="series_code" name="series_code" class="form-control  pull-left" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();" readonly>

                            <datalist id="seriesList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($series_list as $key)

                                <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                              @endforeach

                            </datalist>

                          </div>

                        <br>
                        <small id="series_codeErr" class="form-text text-muted" ></small>

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


                              <input type="text" class="form-control" name="series_name" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

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
                              <?php $plcount = count($plant_list); ?>
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>" readonly autocomplete="off" onchange="PlantCode()">

                              <datalist id="PlantcodeList">

                                <option selected="selected" value="">-- Select --</option>

                                @foreach ($plant_list as $key)

                                <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

                                @endforeach

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

                              <input type="text" class="form-control" name="plant_name" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME;}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

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

                          <label>Customer Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="" placeholder="Select Customer" readonly="" 
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

                              <input type="text" class="form-control" name="acctname" value="" id="accountName" placeholder="Customer Name" readonly autocomplete="off">

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

                          <input list="fromplaceList" class="form-control" name="from_place" id="from_place"  value="" placeholder="From Place" autocomplete="off" readonly/>

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


                          <input list="toplaceList"  id="to_place" name="to_place" class="form-control pull-left" value="" placeholder=" To Place" autocomplete="off" readonly>

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

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input list="transportList" class="form-control" name="transporter_code"   id="transporter_code" placeholder=" Transporter Code" autocomplete="off"  readonly="">

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

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control" name="transporter_name" id="transporter_name"  value="" placeholder="Transporter Name" autocomplete="off" readonly="">

                            

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

                          <input type="text" class="form-control" name="trip_date" id="trip_date" placeholder="Trip Date" autocomplete="off" readonly="" />

                       
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

                          <input type="text" class="form-control" name="lr_date" id="lorry_date" placeholder="Lr Date" autocomplete="off" readonly="" />

                          <input type="hidden" name="max_date" id="max_date" value="">

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

                           <?php 

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

                          <input  type="text" name="vechicalArrDT" id="vechicalArrDT" class="form-control ArrDate" placeholder="Arrival Date & Time"  style="z-index: 1;" autocomplete="off"/ value="">

                               
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

                        <input type="text" name="delivery_dt" class="form-control datepicker"  id="delivery_dt" onchange="getDeliveryDate()" placeholder="Trip Achive Date" autocomplete="off" >

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

                        <input type="text" name="achive_day" id="achive_day" class="form-control" placeholder="Day" readonly="">

                        <input type="hidden" name="TripHId" id="TripHId" class="form-control" placeholder="Day" readonly="">

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

                        <input type="text" name="actual_day" id="actual_day" class="form-control" placeholder="Day" readonly="">

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
        <div class="row">
        <div class="col-md-12">
          <p style="font-weight: bold;font-size: 12px;">ITEM/DO DETAILS</p>
        </div>
          <div class="col-md-12">
          
          
           <div class="table-responsive" id="item_bodyTbl">

            <div class="boxer"  id="itemTable">
            
               <div class='box-row'><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>ITEM REMARK</div><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>DELIVERY NO</div><div class='box10 texIndbox1'>INVOICE NO</div><div class='box10 texIndbox1'>MATERIAL AMT</div><div class='box10 texIndbox1'>ISSUE QTY</div><div class='box10 texIndbox1'>LR QTY</div><div class='box10 texIndbox1'>RECD QTY</div><div class='box10 texIndbox1'>SHORTAGE QTY</div></div>
               <div id="itemTblBody"></div>
              

             </div>
             <!-- <div class="row col-md-12" style="float:right;"><div class='box-row' id="total"></div></div> -->

            </div>

            <div class="row col-md-12">
              <div class='box10 texIndbox1' id="total" ></div>
              <div class='box10 texIndbox1' id="reciQty" ></div>
            </div>
            <!-- <div id="total" class="box-row"></div> -->

         </div>
        </div>

       <!--  <div class="row col-md-12 text-center" style="margin-top: 10px;">
         <button type="button" class="btn btn-primary" id="updateData" style="padding-top: 3px;padding-bottom: 3px;font-size: 14px;">Save</button>
        <button type="reset" class="btn btn-warning" style="padding-top: 3px;padding-bottom: 3px;font-size: 14px;">Reset</button>
    </div> -->

      </div>
      
         

     </div>
     
     </div>
   </div>

   
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
         <button type="button" class="btn btn-primary" id="updateData" style="padding-top: 3px;padding-bottom: 3px;font-size: 14px;">Save</button>
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

         var lr_no =  $("#lr_no").val();

        if(series_code==''){
        
           $('#series_code').css('border-color','#d2d6de');
        
           // $('#series_code').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else{
          //  $('#series_code').prop("readonly",true);
           }
 

           if(lr_no==''){
        
           $('#lr_no').css('border-color','#d2d6de');
        
           $('#lr_no').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else{

           }
    });

  function getDeliveryDate(){

   // var lorry_date  = $("#lorry_date").val();
    var lorry_date  = $("#max_date").val();
    var delivery_dt = $("#delivery_dt").val();
    var off_day     = $("#off_day").val();
    var trip_day    = $("#trip_day").val();
    var getlrlDt    = lorry_date.split("-");
    var getdelDt    = delivery_dt.split("-");

    var getLorryDt   =  getlrlDt[1]+'-'+getlrlDt[0]+'-'+getlrlDt[2];
    var getDeliveryDt   =  getdelDt[1]+'-'+getdelDt[0]+'-'+getdelDt[2];

    console.log('max_date',lorry_date);
    console.log('delivery_dt',delivery_dt);

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
    var recd_qty = $('#recd_qty'+recdQty).val();
    var net_qty = $('#net_weight'+recdQty).val();
    var tl_row = $('#totalRow').val();
    var recdQtyVal = 0;
    var recdShtVal = 0;
   // var recdNetVal = 0;

    if(issue_qty != '' && recd_qty != ''){
       var shortage_qty = parseFloat(net_qty) - parseFloat(recd_qty);
       $('#shortage_qty'+recdQty).val(shortage_qty.toFixed(3));

    }else{
        $('#shortage_qty'+recdQty).val(''); 
    }

   

    if(tl_row > 0){

      for(var i=1;i<=tl_row;i++){

       var calrecQty = $('#recd_qty'+i).val();
       var calShtQty = $('#shortage_qty'+i).val();
      // var calNetQty = $('#net_weight'+i).val();
      
      
       if(calrecQty != '')

         recdQtyVal += parseFloat(calrecQty);
         //recdNetVal += parseFloat(calNetQty);
         recdShtVal += parseFloat(calShtQty);

         $('#recdQty').val(recdQtyVal.toFixed(3));
         //$('#recdQty').val(recdNetVal);

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

$("#trip_lr_no").bind('change', function () { 
  console.log('ch');

  var val = $(this).val();
          
  var xyz = $('#lrList option').filter(function() {

  return this.value == val;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

   if(msg == 'No Match'){
    $('#t_lrno').val('');

   }else{
      $('#t_lrno').val(msg);
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
  var mlr_no = $('#trip_lr_no').val();
  var set_trip_no = '';
  var set_truckNo = '';
  var set_lrNo = '';
  
  if(mtrip_no || mvehicle_no || mlr_no){

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
    $('#trip_lr_no').prop('readonly',true);

  }else if(mvehicle_no){
     console.log('vehicle');
    set_trip_no = $('#t_tripno').val();
    set_truck_No = mvehicle_no;

    var splitTripId = set_truck_No.split('~');
    var set_truckNo = splitTripId[0];
    var TripId = splitTripId[1];
    $("#TripHId").val(TripId);
    $('#trip_lr_no').prop('readonly',true);

  }else if(mlr_no){
     console.log('vehicle');
    set_trip_no = $('#t_tripno').val();
    set_lr_No = mlr_no;

    var splitTripId = set_lr_No.split('~');
    var set_lrNo    = splitTripId[0];
    var TripId      = splitTripId[1];
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

          data: {set_truckNo:set_truckNo,set_trip_no:set_trip_no,set_lrNo:set_lrNo,TripId:TripId},

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
                   console.log('lorry_date',lorry_date);

                  if(lorry_date == '' || lorry_date == null || lorry_date =='0000-00-00'){
                   
                    var lr_date = '0000-00-00';
                  }else{

                    var date = new Date(lorry_date);
                    var month = date.getMonth() + 1;
                          
                    var lr_date =  date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }

                //console.log(lr_date);

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

                   var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>ITEM REMARK</div><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DELIVERY NO</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>INVOICE NO</div><div class='box10 texIndbox1'>MATERIAL AMT</div><div class='box10 texIndbox1'>ISSUE QTY</div><div class='box10 texIndbox1'>LR QTY</div><div class='box10 texIndbox1'>RECD QTY</div><div class='box10 texIndbox1'>SHORTAGE QTY</div></div>";

                   $('#itemTable').append(headtbl);

                    var srno =1;
                    var total =0;
                    var net_total =0;
                    var dataLen = data1.data.length;
                    console.log('data',data1.data);
                   $.each(data1.data, function(k, getData) {

                    total += parseFloat(getData.QTY); 
                    net_total += parseFloat(getData.NET_WEIGHT); 
                    
                    var tableData = "<div class='box-row'><div class='box10 texIndbox1'><input style='padding: 0px;border:none;' type='text' value='"+getData.ITEM_CODE+"' name='item_code[]' id='item_code"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;border:none;' type='text' value='"+getData.ITEM_NAME+"' name='item_name[]' id='item_name"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none;' type='text' value='"+getData.DO_NO+"' name='do_name[]'  id='do_name"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none;' type='text' value='"+getData.delivery_no+"' name='delivery_no[]' id='delivery_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 90px;border:none;' type='text' value='"+getData.LR_NO+"' name='lr_no[]'  id='lr_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;border:none;' type='text' value='"+getData.INVC_NO+"' name='invc_no[]' id='invc_no"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' value='"+getData.MATERIAL_VAL+"' name='material_value[]' id='material_value"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' value='"+getData.QTY+"'  id='issue_qty"+srno+"' name='issue_qty[]' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;border:none;' type='text' value='"+getData.NET_WEIGHT+"'  id='net_weight"+srno+"' name='net_weight[]' readonly=''/></div><div class='box10 texIndbox1' style=''><input style='padding: 0px;width: 85px;text-align: right;margin-bottom:4%;' type='text' class='RecQtyNumber' value='"+getData.QTY+"' name='recd_qty[]' id='recd_qty"+srno+"' oninput='getShortagQty("+srno+")' autocomplete='off'/><br><small id='recd_qtyErr"+srno+"'style='font-size:12px;line-height: 1.0;'></small></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 91px;text-align: right;' type='text' value='' name='shortage_qty[]' id='shortage_qty"+srno+"' readonly=''/><br><small id='shortage_qtyErr"+srno+"'></small></div></div>";

                      $('#itemTable').append(tableData);



                      srno++;
                  });

                  var footer = '<div class="box-row"><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"></div><div class="box10 texIndbox1"><input type="hidden" id="totalRow" value=""></div><div class="box10 texIndbox1"><input type="text" value="" id="issQty" style="padding: 0px;width: 85px;text-align: right;" readonly/></div><div class="box10 texIndbox1"><input type="text" value="" id="netQty" style="padding: 0px;width: 85px;text-align: right;" readonly/></div><div class="box10 texIndbox1"><input type="text" value="" id="recdQty" style="padding: 0px;width: 85px;text-align: right;" readonly/></div><div class="box10 texIndbox1"><input type="text" value="" id="shortQty" style="padding: 0px;width: 85px;text-align: right;" readonly/></div></div>'; 

                  $('#itemTable').append(footer);
                    
                   

                   var uploadData = "<div class='box-row'><div class='box10 texIndbox1'><input type='checkbox' class='case' title='Delete Single Row' /></div><div class='box10 texIndbox1'><input  type='text' value='' name='doc_name' id='doc_name1' autocomplete='off'><br><small id='doc_nameErr1'></small></div><div class='box10 texIndbox1 form-control-file'><input  type='file' value='' name='doc_imagename' id='doc_imagename1' autocomplete='off' ><br><small id='doc_imageErr1'></small></small></div></div>";

                    $('#docUpdateTable').append(uploadData);

                    $('.addmore').attr('disabled',false);
                    $('.delete ').attr('disabled',false);

                   $('#totalRow').val(dataLen);
                   $('#issQty').val(total.toFixed(3));
                   $('#netQty').val(net_total.toFixed(3));
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

</script>



@endsection