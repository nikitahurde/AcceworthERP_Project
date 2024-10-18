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

  .required-field::before {
    content: "*";
    color: red;
  }

  .texIndbox1{
        width: 5%; 
        text-align: center;
        font-size: 12px;

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
}

.tdthtablebordr{
  border: 1px solid #00BB64;
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

    padding: 6px;

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

            Lorry Receipt
 
            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Logistics</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Add Lorry Receipt</a></li>

          </ol>

        </section>



  <section class="content">

    <div class="row">

     

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Lorry Receipt</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Transaction/Logistic/View-lorry-receipt-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Lorry Receipt</a>

              </div>

              

                  <div class="box-tools pull-right">

                    <a href="{{ url('/Transaction/Logistic/View-lorry-receipt-trans') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Lorry Receipt</a>

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

          <!--   <form action="{{ $action }}" method="POST">

               @csrf -->

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

                                if($get_Month >=3 && $get_year == $fyYear[1]){
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

                          <input list="deliveryList" class="form-control" name="trip_no" id="trip_no"  value="" placeholder="Enter Trip No" onchange="getTripDetials()" autocomplete="off" />

                          <datalist id="deliveryList">

                            <?php foreach($trip_list as $row) { 

                               $date    = $row->FY_CODE;
                               $getdata = explode('-', $date);

                              ?>

                            <option value="<?= $getdata[0];?> <?= $row->SERIES_CODE ?> <?= $row->VRNO; ?>" data-xyz="<?= $getdata[0];?> <?= $row->SERIES_CODE ?> <?= $row->VRNO; ?>"><?= $getdata[0];?> <?= $row->SERIES_CODE ?> <?= $row->VRNO; ?></option>

                            <?php } ?>
                            
                          </datalist>

                      </div>



                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('do_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                   <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Vehicle No : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="vehicleList" class="form-control" name="vehicle_no" id="vehicle_no" value="{{ $vehicle_no }}" placeholder="Enter Vehicle No" maxlength="13" oninput="this.value = this.value.toUpperCase()" autocomplete="off" >

                            <datalist id="vehicleList">
                              
                              <?php foreach ($vehicle_list as $key) { ?>
                                
                              <option value="<?= $key->TRUCK_NO ?>" data-xyz="<?= $key->TRUCK_NO ?>"><?= $key->TRUCK_NO ?></option>

                              <?php   } ?>

                            </datalist>

                         
                          

                           
                        </div>

                         <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                          
                            </div>  
                        </div>

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
                             
                            <input list="seriesList1"  id="series_code" name="series_code" class="form-control  pull-left" value="" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();">

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

                              <input type="text" class="form-control" name="acctname" value="" id="accountName" placeholder="Enter Department Name" readonly autocomplete="off">

                            </div>
                            
                        </div>
                        
                      </div>


                      <form name="data-form" id="data-form" enctype="multipart/form-data">
                        @csrf
                    <div class="row" style="margin-top: 12px;">

                      <div class="col-md-3">
                        <button type="button" class="btn btn-primary btn-sm" id="upload-btn">Choose File</button>

                        <button type="submit" class="btn btn-warning btn-sm" id="importbtn" disabled="">IMPORT</button>

                        <small id="excelerr" style="color: red;"></small>
                     </div>
                       
                    <div class="col-md-3">
<!-- 
                      <input type="file" class="btn btn-warning btn-sm pull-right" disabled="" value="import"> -->

                    
     
                          <input type="file" name="import_file" class="custom-file-input form-control" id="customFile" style="display:none;">
                         
                        
                          <input type="hidden" name="tempvrno" id="tempvrno">
                          <input type="hidden" name="temptransporter" id="temptransporter">

                           
                      </div>
                      


                       
                    </div>

                  
                    </form>
                  
                </div>

            
              
          

          </div><!-- /.box-body -->

           

          </div>

      </div>

     


    </div>

     

  </section>



  <section class="content" style="margin-top: -10%;display: none;" id="datatableId">

  <div class="row">

   <div class="col-sm-12">

    <div class="box box-primary Custom-Box">

          <input type="hidden" name="" id="ececelCount" value='<?php echo count($columnlist); ?>'>

     <div class="box-body">

            
                <form id="bodyformId">
                  
               
                  <div id="dfg">
                  <table id="example" class="table table-bordered table-striped table-hover">

                    <thead>

                   
                      <tr>


                       <!--  <th class="text-center">Sr.NO</th>

                        <th class="text-center">Delivery No</th>

                        <th class="text-center">Sl No</th>

                        <th class="text-center">Item Code</th>

                        <th class="text-center">Description</th>

                        <th class="text-center">Alocated Qty</th>

                        <th class="text-center">Allocated Date</th>

                        <th class="text-center">Consinee</th>

                        <th class="text-center">Lot No </th>

                        <th class="text-center">Destination Name</th>

                        <th class="text-center">Item/Acc Name</th> -->
                         <th class="text-center">Sr.NO</th>

                         

                         <?php $srno=1; foreach($columnlist as $key) { ?>

                            

                           <th class="text-center"><?= $key->EXCEL_COL ?><input type='hidden'  value="<?= $key->TEMPEXCEL_COL ?>" id="excelcol<?= $srno  ?>" data-id='<?php echo $key->TBL_COL; ?>'><input type="hidden" value="<?php echo $key->TBL_COL; ?>" name="temptable_col"></th>
                            
                           

                         <?php $srno++; } ?>

                         <th class="text-center">Status</th>

                      </tr> 
  

                  <!--   < ?php foreach($columnlist as $key) { ?>

                        <th class="text-center">< ?= $key->EXCEL_COL ?></th>
                     < ?php } ?> -->

                    </thead>

                    <tbody>

                  

                    </tbody>

                    

                  </table>

                </div>

                <p class="text-center">

                   <input type="hidden" name="importExcel" id="importExcel">

                  <!-- <button class="btn btn-success btn-sm" type="button" id="submitexceldata" onclick="submitData()"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>
  

                  <button class="btn btn-warning btn-sm" type="button" id="CancleExcelBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button> -->

                </p>

               </form>

              </div>
            </div>
          </div>

        </div>

      </section>

<form id="salesordertrans">
      @csrf
<section class="content" style="min-height: 200px;padding-top: 0px !important;margin-top: -15px;" id="bodyId">
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
            
               <div class='box-row'><div class='box10 texIndbox1'>INVOICE NO</div><div class='box10 texIndbox1'>INVOICE DATE</div><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DO DATE</div><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>REMARK</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>LR DATE</div><div class='box10 texIndbox1'>WAGON NO</div><div class='box10 texIndbox1'>WAGON DATE</div><div class='box10 texIndbox1'>BILL QTY</div><div class='box10 texIndbox1'>MATERIAL VALUE</div></div>
              

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




 <section class="content" style="margin-top: -10%;">
    <div class="row">
     <!--  <div class="col-sm-2"></div> -->
      <div class="col-sm-12">
         <ul class="nav nav-tabs">
                <li class="active"  style="float: none !important;">
                  <a href="#tab1info" id="basicInfo" data-toggle="tab" style="line-height: 0.428571;"><b>Freight Details</b></a>
                </li>
                <!-- <li id="secondTab">
                  <a href="#tab2info" data-toggle="tab" >Other Details</a>
                </li> -->
            </ul>
        <div class="box box-warning Custom-Box">
         
          <div class="box-body">

            <div class="row">

              <div class="col-md-2">

                      <input type ="hidden" name="accCode" id="getAccCode">
                      <input type ="hidden" name="accName" id="getAccName">
                      <input type ="hidden" name="pfctCode" id="getPfctCode">
                      <input type ="hidden" name="pfctName" id="getPfctName">
                      <input type ="hidden" name="plantCode" id="getPlantCode">
                      <input type ="hidden" name="plantName" id="getPlantName">
                      <input type ="hidden" name="seriesCode" id="getSeriesCode">
                      <input type ="hidden" name="seriesName" id="getSeriesName">
                      <input type ="hidden" name="VehilceNum" id="getVehilceNum">
                      <input type ="hidden" name="TripNum" id="getTripNum">
                      <input type ="hidden" name="VrDate" id="getVrDate">

                        <div class="form-group">

                          <label> Route Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="routeList" class="form-control" name="route_code"  id="route_code" placeholder="Enter Route Code" autocomplete="off"  onchange="getRouteLocation()">

                              <datalist id="routeList">
                                <?php foreach($route_list as $key) { ?>

                                  <option value="<?= $key->ROUTE_CODE ?>" data-xyz="<?= $key->ROUTE_NAME ?>"><?= $key->ROUTE_CODE ?></option>

                                <?php  } ?>
                              </datalist>

                              
                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="valid_to_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div>

                       <div class="col-md-3">

                        <div class="form-group">

                          <label> Route Name : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="route_name" id="route_name" placeholder="Enter Route Name" autocomplete="off" readonly>

                              
                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="valid_to_err" style="color: red;" class="form-text text-muted"> </small>


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

                          <input list="fromplaceList" class="form-control" name="from_place" id="from_place"  value="{{ $from_place }}" placeholder="Enter From Place" autocomplete="off"/>

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


                          <input list="toplaceList"  id="to_place" name="to_place" class="form-control pull-left" value="{{ $to_place }}" placeholder="Enter To Place" autocomplete="off">

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
               
              
                   <div class="col-md-1">

                    <div class="form-group">

                      <label>

                        Trip Days: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <!-- <span class="input-group-addon"><i class="fa fa-car"></i></span> -->

                          <input type="text" class="form-control" name="trip_day" id="trip_day"  value="" placeholder="Enter Trip Days" autocomplete="off">

                            

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('trip_day', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>


                   <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Off Days: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control" name="off_days" id="off_days"  value="" placeholder="Enter Off Days" autocomplete="off">

                            

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('transporter', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>


              
                </div>

                <div class="row">

                 
                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Transporter Code: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input list="transportList" class="form-control" name="transporter_code"  value="{{ $transporter }}" id="transporter_code" placeholder="Enter Transporter" autocomplete="off" onchange="getRate()" readonly="">

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

                          <input type="text" class="form-control" name="transporter_name" id="transporter_name"  value="" placeholder="Enter Transporter" autocomplete="off" readonly="">

                            

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('transporter', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                   
                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       Delivery No : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="delivery_no" class="form-control" value="" id="delivery_no" placeholder="Enter Delivery No" autocomplete="off">
 


                         <input type="hidden" name="vehicleId" value="{{ $vehicleId }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fright_order', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>


                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       Gross Weight: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="gross_weight"  id="gross_weight" class="form-control" placeholder="Enter Gross Weight" autocomplete="off" readonly="">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gross_weight', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Net Weight : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="net_weight"  id="net_weight" class="form-control" placeholder="Enter Net Weight" autocomplete="off" readonly="">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('net_weight', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                 

                </div>

              <div class="row">

                 

                    <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Gate Entry : 

                     

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input list="gateinwardList" name="gate_inward"  id="gate_inward" class="form-control" placeholder="Enter Gate Entry" autocomplete="off">

                        <datalist id="gateinwardList">
                           
                        </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('gate_inward', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                             <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                    Driver Name : 

                                   

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="driver_name" id="driver_name"  value="" placeholder="Select Driver Name " autocomplete="off" />


                                  </div>
                             

                                </div>

                          
                              </div>

                             <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Driver Mobile :</span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="mobile_no" id="mobile_no"  value="" placeholder="Enter Mobile No"  autocomplete="off" />


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>

                              <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Licence No :</span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="licence_no" id="licence_no"  value="" placeholder="Enter Licence No"  autocomplete="off" />


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>


                              <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Driver Add :</span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="driver_add" id="driver_add"  value="" placeholder="Enter Driver Add"  autocomplete="off" />


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>


                                <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Remark :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="remark" id="remark"  value="" placeholder="Enter Remark"  autocomplete="off" />


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>
                              


                          </div>

                          <div class="row">



                              <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   E-Bill No :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="ebill_no" id="ebill_no"  value="" placeholder="Enter E-Bill No"  autocomplete="off" />


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>

                            
                          </div>
               <!--  <div class="row">


                    <div class="col-md-12">

                     <button type="button" class="btn btn-primary btn-sm" style="margin-top: 14px;font-size: 10px !important;float: right;" data-toggle="modal" data-target="#ratevalueModal1">Rate Calc</button>

                     </div>
                  
                </div> -->

                 <p class="text-center">

                    <button class="btn btn-success btn-sm" type="button" id="submitdata" onclick="submitData()" disabled=""><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

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

        if(series_code==''){
        
           $('#series_code').css('border-color','#d2d6de');
        
           $('#series_code').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else{
          // 	$('#series_code').prop("readonly",true);
           }
 

           if(trip_no==''){
        
           $('#trip_no').css('border-color','#d2d6de');
        
           $('#trip_no').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else{

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

   $('#upload-btn').click(function(e){
        e.preventDefault();
        $('#customFile').click();

        var fileValue = $("#customFile").val();

         $("#importbtn").prop('disabled', false);

        

      }
    );

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
  
  
   $(document).ready(function() {

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

        $("#vehicle_no").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#vehicleList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');

             $('#vehicle_no').css('border-color','#d2d6de');
             $('#vehicle_no').css('border-color','#ff0000').focus();
             $('#transporter_code').css('border-color','#d2d6de');
              $("#transporter_code").prop('readonly', true);
          }else{
            $('#vehicle_no').css('border-color','#d2d6de');
            $('#transporter_code').css('border-color','#ff0000').focus();
            $("#transporter_code").prop('readonly', false);
          }

        });



        $("#payment_mode").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#paymentList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');

             $('#payment_mode').css('border-color','#d2d6de');
             $('#payment_mode').css('border-color','#ff0000').focus();
             $('#adv_type').css('border-color','#d2d6de');
              $("#adv_type").prop('readonly', true);
          }else{
            $('#payment_mode').css('border-color','#d2d6de');
            $('#adv_type').css('border-color','#ff0000').focus();
            $("#adv_type").prop('readonly', false);
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

                  console.log(data1.data[0].UM_CODE);

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

            console.log(data1);

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

function getTripDetials(){

  var trip_no = $("#trip_no").val();
  var vr_date = $("#vr_date").val();

  var explode =   trip_no.split(" ");

  var tripno = explode[2];
//alert(tripno);
  if(tripno){

     $('#trip_no').css('border-color','#d2d6de');

     $("#getTripNum").val(trip_no);
     $("#getVrDate").val(vr_date);
     
      
  }else{
      
       $('#trip_no').css('border-color','#ff0000');
       $('#trip_no').css('border-color','#ff0000').focus();

       $("#account_code,#accountName").val('');
  }

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

            console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){


              		var series_code = data1.data_inward.SERIES_CODE;
              		var fy_code = data1.data_inward.FY_CODE;
              		var fycode = fy_code.split("-");
              		var vrno = data1.data_inward.VRNO;

              		var gate_inward = fycode[0]+' '+series_code+' '+vrno;

                  $("#account_code").val(data1.data[0].ACC_CODE);
                  $("#getAccCode").val(data1.data[0].ACC_CODE);
                  $("#accountName").val(data1.data[0].ACC_NAME);
                  $("#getAccName").val(data1.data[0].ACC_NAME);
                  $("#series_code").val(data1.data[0].SERIES_CODE);
                  $("#getSeriesCode").val(data1.data[0].SERIES_CODE);
                  $("#getSeriesName").val(data1.data[0].SERIES_NAME);
                  $("#seriesName").val(data1.data[0].SERIES_NAME);
                  $("#Plant_code").val(data1.data[0].PLANT_CODE);
                  $("#getPlantCode").val(data1.data[0].PLANT_CODE);
                  $("#plantname").val(data1.data[0].PLANT_NAME);
                  $("#getPlantName").val(data1.data[0].PLANT_NAME);
                  $("#getPfctCode").val(data1.data[0].PFCT_CODE);
                  $("#profitctrId").val(data1.data[0].PFCT_CODE);
                  $("#pfctName").val(data1.data[0].PFCT_NAME);
                  $("#getPfctName").val(data1.data[0].PFCT_NAME);
                  $("#route_code").val(data1.data[0].ROUTE_CODE);
                  $("#route_name").val(data1.data[0].ROUTE_NAME);
                  $("#trip_day").val(data1.data[0].TRIP_DAY);
                  $("#off_days").val(data1.data[0].OFF_DAY);
                  $("#from_place").val(data1.data[0].FROM_PLACE);
                  $("#to_place").val(data1.data[0].TO_PLACE);
                  $("#vehicle_no").val(data1.data[0].VEHICLE_NO);
                  $("#getVehilceNum").val(data1.data[0].VEHICLE_NO);
                  $("#transporter_code").val(data1.data[0].TRANSPORT_CODE);
                  $("#transporter_name").val(data1.data[0].TRANSPORT_NAME);
             
                  $("#driver_name").val(data1.data_inward.DRIVER_NAME);
                  $("#mobile_no").val(data1.data_inward.DRIVER_CONTACT_NO);
                  $("#licence_no").val(data1.data_inward.DRIVER_LS_NO);
                  $("#driver_add").val(data1.data_inward.DRIVER_ADD);


                  $("#gate_inward").val(gate_inward);
                  
               
                  $("#deliveryList1").empty();

                  $("#do_no1").prop('readonly',false);

                  $('#itemTable').empty();

                   var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>INVOICE NO</div><div class='box10 texIndbox1'>INVOICE DATE</div><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DO DATE</div><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>REMARK</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>LR DATE</div><div class='box10 texIndbox1'>WAGON NO</div><div class='box10 texIndbox1'>WAGON DATE</div><div class='box10 texIndbox1'>BILL QTY</div><div class='box10 texIndbox1'>MATERIAL VALUE</div></div>";

                   $('#itemTable').append(headtbl);

                    var srno =1;
                    var total =0;
                   $.each(data1.data, function(k, getData) {


                    total += parseFloat(getData.QTY);


                      
                    var tableData = "<div class='box-row'><div class='box10 texIndbox1'><input style='padding: 0px;width: 90px;' type='text' class='inputboxclr'  name='invoice_no[]' id='invoice_no"+srno+"'  autocomplete='off'/></div><div class='box10 texIndbox1 clr'><input style='padding: 0px;width: 90px;' type='text'  value='' name='invoice_date[]'  class='datepicker inputboxclr clr' id='invoice_date"+srno+"'   autocomplete='off'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 90px;border:none' type='text' name='do_no[]' id='do_no"+srno+"' class='inputboxclr'  value='"+getData.DELORDER_NO+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 90px;border:none;' class='inputboxclr' type='text'  value='"+getData.DELORDER_DATE+"' name='do_date[]' id='do_date"+srno+"'   class='datepicker' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 90px;border:none' class='inputboxclr' type='text' value='"+getData.ITEM_CODE+"' name='item_code[]' id='item_code"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;border:none' class='inputboxclr' type='text' value='"+getData.ITEM_NAME+"' name='item_name[]' id='item_name"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;' type='text' class='inputboxclr' name='lr_no[]'  id='lr_no"+srno+"' /></div><div class='box10 texIndbox1'><input class='datepicker inputboxclr'  type='text' value='' name='lr_date[]'  id='lr_date"+srno+"' style='padding: 0px;width: 85px;' autocomplete='off'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;' type='text' class='inputboxclr' value='' name='wagon_no[]' id='wagon_no"+srno+"'   autocomplete='off'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;' type='text' value=''  name='wagon_date[]'  class='datepicker inputboxclr' id='wagon_date"+srno+"' autocomplete='off'/> </div><div class='box10 texIndbox1'><input style='padding: 0px;width: 70px;text-align: right;border:none' type='text' class='inputboxclr'  id='qty"+srno+"'  value='"+getData.QTY+"'  name='qty[]' oninput='Getqunatity("+srno+")'style='width: 80px;'   /><input type='hidden' style='padding: 0px;width: 20px;text-align: right;' name='unit_M[]' value='"+getData.UM+"' id='UnitM"+srno+"' class='inputboxclr AddM'><input type='hidden' id='qtyget"+srno+"' class='totlqty'><input type='hidden' id='Cfactor"+srno+"'></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;' type='text' class='inputboxclr'  id='material_value"+srno+"' name='material_value[]' /></div></div>";

                      /*$('.clr').css('cursor','text');
                      $('.clr').css('background-color','#ddf5ff');
                      $('.clr').css('background-color','#ddf5ff');*/

                      

                    $('#itemTable').append(tableData);

                    $('.datepicker').datepicker({

                      format: 'dd-mm-yyyy',

                      orientation: 'bottom',

                      todayHighlight: 'true',

                      endDate: 'today',
                      
                      autoclose: 'true'

                    });

                    

                      srno++;
                  });

                   var  sf = "<div class='totlsetinres'>Total : <input type='text' value='"+total.toFixed(3)+"' style='padding: 0px;width: 85px;text-align: right;'/></div>";
                    
                   $('#total').append(sf);

              }

          }

    });

}

</script>




<script type="text/javascript">

function getDoDetials(srno){

  var do_no = $("#do_no"+srno).val();

//alert(do_no);
  if(do_no){

     $('#do_no').css('border-color','#d2d6de');
     
  }else{
      
       $('#do_no').css('border-color','#ff0000');
       $('#do_no').css('border-color','#ff0000').focus();

       $("#account_code,#accountName,#fsorder_no,#sale_rate,#sale_qty").val('');
  }

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-do-details-for-trip-plan') }}",

          method : "POST",

          type: "JSON",

          data: {do_no: do_no},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                   $("#do_date"+srno).val(data1.data[0].DELORDER_DATE);

                   $("#ItemList"+srno).empty();

                  $("#ItemCodeId"+srno).prop('readonly',false);

                  $.each(data1.data, function(k, getData){

                  
                     $("#ItemList"+srno).append($('<option>',{

                      value:getData.ITEM_CODE,

                      'data-xyz':getData.ITEM_NAME,
                      text:getData.ITEM_CODE


                    }));
                    
                    

                  })
                    
                  

              }

          }

    });

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
                console.log('stock',data1.totalstock);
                console.log('stockbatch',data1.batchNo);

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
  console.log(otherNumbers);
  if (otherNumbers != '')
    lastThree = ',' + lastThree;
  var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
  return res;
}
  



</script>

<script type="text/javascript">
  function Getqunatity(qtyId){

     var checkqty =$('#qty'+qtyId).val();
     var stockqty =$('#stockavlblevalue'+qtyId).val();
     console.log('qty',checkqty);

     
     var gr_amt;
     if(checkqty){

        $("#delivery_no").prop('readonly',false);

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

      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value.replaceAll(',', ''));

                
            }

          $("#basicTotal").val(gr_amt.toFixed(3));

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());

     }else{

      $("#delivery_no").prop('readonly',true);
      $('#A_qty'+qtyId).val(0.000);

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
</script>

<script type="text/javascript">

 function submitData(){


      var trcount=$('table tr').length;



         // var data = $("#salesordertrans").serialize();
         var data = $("#salesordertrans,#bodyformId").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/Transaction/Logistic/Save-lorry-receipt-trans'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                console.log(data);

                 var data1 = JSON.parse(data);

                if(data1.response=='error'){
                  var responseVar =false;

                    var url = "{{ url('/Transaction/View-lorry-receipt-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar =true;
                 var url = "{{ url('/Transaction/View-lorry-receipt-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }

              },

          });
      
  }


       
</script>

<script type="text/javascript">
  
   $(document).ready( function () {

       $("form#data-form").on("submit",function (e) {
           e.preventDefault();



           var formData = new FormData(this);
           //Ajax functionality here

             var files = $('#customFile')[0].files;
             var excel = $('#customFile').val();
          
             if(excel==''){
              
              $('#excelerr').html('This field is required');

              return false;
             }else{
              $('#excelerr').html('');
            }

             var tempvrno = $('#tempvrno').val();
             var temptransporter = $('#temptransporter').val();
             var vehicle_no = $('#vehicle_no').val();

         // console.log(files);

           if(files.length > 0){


             var fd = new FormData();


             fd.append('file',files[0]);
             fd.append('tempvrno',tempvrno);
             fd.append('temptransporter',temptransporter);
             fd.append('vehicle_no',vehicle_no);

             //alert(fd);return false;

                  $.ajaxSetup({

                      headers: {

                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                      }
                });

                $("#vr_date,#series_code,#Plant_code,#account_code,#freight_order_no,#customFile,#importbtn").prop('readonly', true);

                $("#importExcel").val('IMPORTEXCEL');


               $.ajax({

                url: "<?php echo url('/finance/lrimport'); ?>",
                type : "POST",
                data : fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                success:function (data) {

                  console.log(data);

             

                  $("#datatableId").css("display","block");
                  $("#bodyId").css("display","none");
                    
                    var t = $("#example").DataTable({

                         processing: true,
                         serverSide:false,
                         //scrollY:500,
                         scrollX:true,
                         paging: true,
                      
                         searching : true,
                         stateSave: true,

                          ajax:{

                            url : "{{ url('/Transaction/Logistic/View-Delivery-Order-Details') }}",
                            
                           },

                           searching : true,
    

                     columns: [
                        
                        { data:"DT_RowIndex",className:"text-center"},
                        { 
                          data:"COL1",className:"text-center",
                           render: function (data, type, full, meta){

                                  var col1 = full['COL1']+'<input type="hidden" value="'+full['COL1']+'" name="column1[]"/>';

                                  return  col1;
                           }
                        },
                        { data:"COL2",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col2 = full['COL2']+'<input type="hidden" value="'+full['COL2']+'" name="column2[]"/>';

                                  return  col2;
                           }

                         },
                        { data:"COL3",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col3 = full['COL3']+'<input type="hidden" value="'+full['COL3']+'" name="column3[]"/>';

                                  return  col3;
                           }
                        },
                        { data:"COL4",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col4 = full['COL4']+'<input type="hidden" value="'+full['COL4']+'" name="column4[]"/>';

                                  return  col4;
                           }

                        },
                        { data:"COL5",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col5 = full['COL5']+'<input type="hidden" value="'+full['COL5']+'" name="column5[]"/>';

                                  return  col5;
                           }
                        },
                        { data:"COL6",className:"text-center",

                           render: function (data, type, full, meta){

                                  var col6 = full['COL6']+'<input type="hidden" value="'+full['COL6']+'" name="column6[]"/>';

                                  return  col6;
                           }
                        },
                        { data:"COL7",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col7 = full['COL7']+'<input type="hidden" value="'+full['COL7']+'" name="column7[]"/>';

                                  return  col7;
                           }
                        },
                        { data:"COL8",className:"text-center",

                           render: function (data, type, full, meta){

                                  var col8 = full['COL8']+'<input type="hidden" value="'+full['COL8']+'" name="column8[]"/>';

                                  return  col8;
                           }
                        },
                        { data:"COL9",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col9 = full['COL9']+'<input type="hidden" value="'+full['COL9']+'" name="column9[]"/>';

                                  return  col9;
                           }
                        },
                        { data:"COL10",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col10 = full['COL10']+'<input type="hidden" value="'+full['COL10']+'" name="column10[]"/>';

                                  return  col10;
                           }
                        },
                        { data:"COL11",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col11 = full['COL11']+'<input type="hidden" value="'+full['COL11']+'" name="column11[]"/>';

                                  return  col11;
                           }
                        },
                        { data:"COL12",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col12 = full['COL12']+'<input type="hidden" value="'+full['COL12']+'" name="column12[]"/>';

                                  return  col12;
                           }
                        },
                        {  
                          render: function (data, type, full, meta){

                                if(full['DO_NUMBER']=='NO'){

                                      var accDbtn ='<button class="btn btn-danger btn-sm" title="edit" style="font-size: 10px; padding: 2px 2px;" onclick="return showItem('+full['ID']+');">NOT FOUND</button>';

                                         return accDbtn;

                                    }else{

                                      return '';
                                    }

                              },
        
                         },  
                       
                      
                    ],

                   "fnRowCallback": function(nRow, aData,data, type, full, meta) {

                         

                        if(aData['DO_NUMBER']=='NO') {
                          $('td', nRow).css('color', '#f75656');
                        }
                      },

                       });

                  

                  },
                    
            }); // ajax end

         }
    }); // form submit end
});



</script>
@endsection