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

          <!--   <form action="" method="POST">

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

                                if($get_Month > 3 && $get_year == $fyYear[1]){
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

                            <?php foreach($trip_list as $key) { 


                                        $vrNo = $key->VRNO;
                              
                                        $SericeCode = $key->SERIES_CODE;
                                        
                                        $FyYr = $key->FY_CODE;

                                        $getYr = explode("-",$FyYr);

                                        $BgYr = $getYr[0];

                                        $newVrNo = $BgYr.' '.$SericeCode.' '.$vrNo;

                              ?>

                            <option value="<?= $newVrNo; ?>~<?= $key->TRIPHID; ?>" data-xyz="<?= $key->TRIPHID; ?>"><?= $newVrNo ?> - <?= $key->VEHICLE_NO ?> - <?= $key->ACC_NAME ?>- <?= $key->TO_PLACE ?></option>

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

                          <input list="vehicleList" class="form-control" name="vehicle_no" id="vehicle_no" value="{{ $vehicle_no }}" placeholder="Enter Vehicle No"  oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getTripDetials()" >

                            <datalist id="vehicleList">
                              
                              <?php foreach ($trip_list as $key) { ?>
                                
                              <option value="<?= $key->VEHICLE_NO ?>~<?= $key->TRIPHID; ?>" data-xyz="<?= $key->TRIPHID; ?>"><?= $key->VEHICLE_NO ?> - <?= $key->ACC_NAME ?>- <?= $key->TO_PLACE ?></option>

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

                          <input type="hidden" name="tripHid" id="tripHid" value="">

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


                     <!--  <form name="data-form" id="data-form" enctype="multipart/form-data">
                        @csrf
                    <div class="row" style="margin-top: 12px;">

                      <div class="col-md-3">
                        <button type="button" class="btn btn-primary btn-sm" id="upload-btn">Choose File</button>

                        <button type="submit" class="btn btn-warning btn-sm" id="importbtn" disabled="">IMPORT</button>

                        <small id="excelerr" style="color: red;"></small>
                     </div>
                       
                    <div class="col-md-3">

                          <input type="file" name="import_file" class="custom-file-input form-control" id="customFile" style="display:none;">
                         
                        
                          <input type="hidden" name="tempvrno" id="tempvrno">
                          <input type="hidden" name="temptransporter" id="temptransporter">

                           
                      </div>
                      


                       
                    </div>

                  
                    </form> -->
                  
                </div>

                <!-- HIDDEN FIELDS -->

                <input type="hidden" id="generateLrNo" value="1">

                <!-- HIDDEN FIELDS -->
            
                          

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

            <div class="boxer"  id="itemTable" style="line-height:1;">
            
               <div class='box-row'><div class='box10 texIndbox1'>INVOICE NO</div><div class='box10 texIndbox1'>INVOICE DATE</div><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DO DATE</div><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>REMARK</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>LR DATE</div><div class='box10 texIndbox1'>WAGON NO</div><div class='box10 texIndbox1'>WAGON DATE</div><div class='box10 texIndbox1'>LR QTY</div><div class='box10 texIndbox1'>DELIVERY NO</div><div class='box10 texIndbox1'>TARE WEIGHT</div><div class='box10 texIndbox1'>GROSS WEIGHT</div><div class='box10 texIndbox1'>NET WEIGHT</div><div class='box10 texIndbox1'>E-WAY BILL NO</div><div class='box10 texIndbox1'>E-WAY BILL DATE</div><div class='box10 texIndbox1'>MATERIAL VALUE</div></div>
              

             </div>
           
            

           </div>

           <div id="total" style="float:right;"></div>
           <div id="errEwyBill" style="text-align:center;margin-top: 10px;"></div>

           
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

                              <input list="routeList" class="form-control" name="route_code"  id="route_code" placeholder="Enter Route Code" autocomplete="off"  onchange="getRouteLocation()" readonly="">

                              <datalist id="routeList">
                                <?php foreach($route_list as $key) { ?>

                                  <option value="<?= $key->ROUTE_CODE ?>" data-xyz="<?= $key->ROUTE_NAME ?>"><?= $key->ROUTE_CODE ?> - <?= $key->ROUTE_NAME ?></option>

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

                          <input list="fromplaceList" class="form-control" name="from_place" id="from_place"  value="{{ $from_place }}" placeholder="Enter From Place" autocomplete="off" readonly="" />

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


                          <input list="toplaceList"  id="to_place" name="to_place" class="form-control pull-left" value="{{ $to_place }}" placeholder="Enter To Place" autocomplete="off" readonly="">

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

                          <input type="text" class="form-control" name="trip_day" id="trip_day"  value="" placeholder="Enter Trip Days" autocomplete="off" readonly="">

                            

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

                          <input type="text" class="form-control" name="off_days" id="off_days"  value="" placeholder="Enter Off Days" autocomplete="off" readonly="">

                            

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

                        <!-- <span class="required-field"></span> -->

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

                       <!--  <span class="required-field"></span> -->

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
                   

                  <!--  <div class="col-md-2">

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

                  </div> -->

                             <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                    Driver Name : 

                                   

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="driver_name" id="driver_name"  value="" placeholder="Select Driver Name " autocomplete="off" readonly="" />

                                        <input type="hidden" name="headid" id="headid" value="">



                                  </div>
                             

                                </div>

                          
                              </div>

                             <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Driver Mobile :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="mobile_no" id="mobile_no"  value="" placeholder="Enter Mobile No"  autocomplete="off"  readonly=""/>


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>

                 			<div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Licence No :

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="licence_no" id="licence_no"  value="" placeholder="Enter Licence No"  autocomplete="off" />


                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>

                </div>

                   <div class="row">

                    
                              <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Driver Add :

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

                                  
                                    <input type="hidden" class="form-control" name="vehicle_type" id="vehicle_type"  value="" placeholder="Enter Vehicle Type" autocomplete="off" readonly="">
                                    <input type="hidden" class="form-control" name="vehicle_type_name" id="vehicle_type_name"  value="" autocomplete="off" readonly="">
                                   <input type="hidden" class="form-control" name="sale_rate" value="" id="sale_rate" placeholder="Enter Sale Rate" readonly autocomplete="off">
                                    <input type="hidden" class="form-control" name="fsohid" value="" id="fsohid" placeholder="Enter Sale Rate" readonly autocomplete="off">
                                    <input type="hidden" class="form-control" name="fsobid" value="" id="fsobid" placeholder="Enter Sale Rate" readonly autocomplete="off">
                                    <input type="hidden" class="form-control" name="vehicle_model" value="" id="vehicle_model" placeholder="Enter Vehicle Model" readonly autocomplete="off">
                                </div>



                                <!-- /.form-group -->

                              </div>
                              


                          </div>

                          
               <!--  <div class="row">


                    <div class="col-md-12">

                     <button type="button" class="btn btn-primary btn-sm" style="margin-top: 14px;font-size: 10px !important;float: right;" data-toggle="modal" data-target="#ratevalueModal1">Rate Calc</button>

                     </div>
                  
                </div> -->
                 <p style="text-align: center;"><small id="requiredMsg"></small></p>

                 <p class="text-center">
                    <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
                    <button class="btn btn-success btn-sm" type="button" id="submitdata" onclick="submitData(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                    <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

                    <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitData(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save &amp; Download Pdf</button>

                  </p>

          </div>

         
        </div>
      </div>
    </div>
  </section>

</form>
  
</div>



<div id="dublicateModal" class="modal fade" tabindex="-1">
          <div class="modal-dialog modal-sm" style="margin-top: 13%;width: 30%;">
              <div class="modal-content" style="border-radius: 5px;">
                  <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                  </div>
                  <div class="modal-body">
                    <p style="text-align:center;"><b>Gross Weight Should Be Greter Than Tare Weight !</b></p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" >Cancel</button>
                      <button type="button" class="btn btn-primary btn-sm" id="savedataAfterAlert" data-dismiss="modal">Ok</button>
                  </div>
              </div>
          </div>
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
  function vrDate() {
      
     var vrDate =  $("#vr_date").val();
     //alert(vrDate);

     $("#vr_date").val(vrDate);

  }
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


  function netWeightCal(srno) {

    var tare_weight = parseFloat($("#tare_weight"+srno).val());
    var gross_weight = parseFloat($("#gross_weight"+srno).val());

    if(tare_weight){


      if(gross_weight < tare_weight){

        $("#dublicateModal").modal('show');
        $("#net_weight"+srno).val('');
        $("#tare_weight"+srno).val('');
      }else{

        var total_weight = parseFloat(gross_weight) - parseFloat(tare_weight);

        $("#net_weight"+srno).val(total_weight);
         $("#submitdata").prop('disabled',false);
         $("#submitdatapdf").prop('disabled',false);
         $("#dublicateModal").modal('hide');

      }

    }else{

        $("#net_weight"+srno).val('');
         $("#submitdata").prop('disabled',true);
         $("#submitdatapdf").prop('disabled',true);
    }

  }


function netWeight(srno){


 var netweight = $("#net_weight"+srno).val();


 if(netweight){

    $("#submitdata").prop('disabled',false);
    $("#submitdatapdf").prop('disabled',false);

 }else{

   $("#submitdata").prop('disabled',true);
   $("#submitdatapdf").prop('disabled',true);

 }


}

 
  
   $(document).ready(function() {

 
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


  function getLrDateValidate(num){
        var do_date = $('#do_date'+num).val();
        var lr_date = $('#lr_date'+num).val();

        
        
   }
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
            // $('#transporter_code').css('border-color','#d2d6de');
             // $("#transporter_code").prop('readonly', true);
          }else{
            $('#vehicle_no').css('border-color','#d2d6de');
            $('#trip_no').css('border-color','#d2d6de');
          //  $('#transporter_code').css('border-color','#ff0000').focus();
           // $("#transporter_code").prop('readonly', false);
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

         $("#route_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#routeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

         if(msg=='No Match'){

             $(this).val('');
             $('#route_name').val('');
         }else{
            $('#route_name').val(msg);
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

  var tripNo    = $("#trip_no").val();
  var vehicleNo = $("#vehicle_no").val();
  var vr_date    = $("#vr_date").val();
 

  if(tripNo){

    
     $('#trip_no').css('border-color','#d2d6de');

        var trip_No = tripNo.split('~');
        var trip_no = trip_No[0];
        var tripHid =trip_No[1];
        $('#tripHid').val(tripHid);

         $("#getTripNum").val(trip_no);
         $("#getVrDate").val(vr_date);
      
  }else{
       
       $("#account_code,#accountName").val('');

      var splitTrip = vehicleNo.split('~');
      var vehicle_no =splitTrip[0];
      var tripHid    =splitTrip[1];

      $('#tripHid').val(tripHid);
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

          data: {trip_no:trip_no,vehicle_no:vehicle_no,tripHid:tripHid},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                 /* if(data1.data_inward=='' || data1.data_inward==null){

                  $("#driver_name").val('');
                  $("#mobile_no").val('');
                  $("#licence_no").val('');
                  $("#driver_add").val('');
                  $("#gate_inward").val('');

                  }else{

                  var series_code = data1.data_inward.SERIES_CODE;
                  var fy_code = data1.data_inward.FY_CODE;
                  var fycode = fy_code.split("-");
                  var vrno = data1.data_inward.VRNO;
                  var gate_inward = fycode[0]+' '+series_code+' '+vrno;
                  $("#driver_name").val(data1.data_inward.DRIVER_NAME);
                  $("#mobile_no").val(data1.data_inward.DRIVER_CONTACT_NO);
                  $("#licence_no").val(data1.data_inward.DRIVER_LS_NO);
                  $("#driver_add").val(data1.data_inward.DRIVER_ADD);
                  $("#gate_inward").val(gate_inward);
                  }*/
              		

                  

                  var vehicle_type = data1.trip_type;

                //  console.log('vehicle_type',data1.trip_type);

                  if(vehicle_type=='VEHICLENO'){


                  var trip_series_code = data1.data[0].SERIES_CODE;
                  var trip_fy_code = data1.data[0].FY_CODE;
                  var trip_fycode = trip_fy_code.split("-");
                  var trip_vrno = data1.data[0].VRNO;

                  var trip_no = trip_fycode[0]+' '+trip_series_code+' '+trip_vrno;

                   $("#trip_no").val(trip_no);

                   $("#getTripNum").val(trip_no);
                   $("#getVrDate").val(vr_date);

                  }

                 
                  if(data1.data =='' || data1.data ==null){

                  }else{




                    var fyCode = data1.data[0].FY_CODE;
                    var fyYear = fyCode.split("-");
                    var fyYearCode = fyYear[0];
                    var seriesCode = data1.data[0].SERIES_CODE;
                    var vrNo = data1.data[0].VRNO;

                  $("#headid").val(data1.data[0].TRIPHID);
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
                  $("#vehicle_type").val(data1.data[0].VEHICLE_TYPE);
                  $("#vehicle_type_name").val(data1.data[0].VEHICLE_TYPE_NAME);
                  $("#driver_name").val(data1.data[0].DRIVER_NAME);
                  $("#mobile_no").val(data1.data[0].DRIVER_MOBILE);
                  $("#licence_no").val(data1.data[0].LICENCE_NO);
                  $("#driver_add").val(data1.data[0].DRIVER_ADD);
                  $("#vehicle_model").val(data1.data[0].MODEL);

             	
             		var routeCode = data1.data[0].ROUTE_CODE;

             		if(routeCode=='' || routeCode==null){

             			$("#route_code").prop('readonly',false);
             		}else{
             			$("#route_code").prop('readonly',true);
             		}
                 
                  $("#trip_no").prop('readonly',true);
                  $("#vehicle_no").prop('readonly',true);
                  $("#series_code").prop('readonly',true);
                  
                  
               
                  $("#deliveryList1").empty();
                  $('#total').empty();

                  $("#do_no1").prop('readonly',false);

                  $('#itemTable').empty();

                   var headtbl = "<div class='box-row'><div class='box10 texIndbox1'>INVOICE NO</div><div class='box10 texIndbox1'>INVOICE DATE</div><div class='box10 texIndbox1'>DO NO</div><div class='box10 texIndbox1'>DO DATE</div><div class='box10 texIndbox1'>ITEM CODE</div><div class='box10 texIndbox1'>REMARK</div><div class='box10 texIndbox1'>CP CODE</div><div class='box10 texIndbox1'>CP NAME</div><div class='box10 texIndbox1'>LR NO</div><div class='box10 texIndbox1'>LR DATE</div><div class='box10 texIndbox1'>WAGON NO</div><div class='box10 texIndbox1'>WAGON DATE</div><div class='box10 texIndbox1'>LR QTY</div><div class='box10 texIndbox1'>DELIVERY NO</div><div class='box10 texIndbox1'>GROSS WEIGHT</div><div class='box10 texIndbox1'>TARE WEIGHT</div><div class='box10 texIndbox1'>NET WEIGHT</div><div class='box10 texIndbox1'>E-WAY BILL NO</div><div class='box10 texIndbox1'>E-WAY BILL Date</div><div class='box10 texIndbox1'>MATERIAL VALUE</div></div>";

                   $('#itemTable').append(headtbl);

                    var srno =1;
                    var total =0;
                   $.each(data1.data, function(k, getData) {


                    total += parseFloat(getData.QTY);


                        var do_date = getData.DO_DATE;

                        var date = new Date(do_date);
                        var month = date.getMonth() + 1;
                        if(data=='0000-00-00'){
                          var DO_DATE =  '00-00-0000';
                        }else{
                          
                         var DO_DATE = date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                        }

                        var curr_date = new Date();

                        var curr_month = curr_date.getMonth() + 1;
                        if(curr_date=='0000-00-00'){
                          var Current_date =  '00-00-0000';
                        }else{
                          
                         var Current_date = curr_date.getDate() + "-" + (curr_month.toString().length > 1 ? curr_month : "0" + curr_month) + "-" +  curr_date.getFullYear();
                        }

                        console.log('CurrentDate',Current_date);

                        var ewaybillNo = getData.EBILL_NO;

                        if(ewaybillNo==null){

                          var ewaybill_no = '';
                        }else{

                          var ewaybill_no = ewaybillNo;
                        }

                        var ewaybillDt = getData.EWAYB_VALIDDT;

                        var ewaydate = new Date(ewaybillDt);
                        var ewaymonth = ewaydate.getMonth() + 1;

                        if(ewaybillDt==null || ewaybillDt=='0000-00-00'){

                          var ewaybill_dt = '';
                        }else{

                         // var ewaybill_dt = ewaybillDt;

                          var ewaybill_dt = ewaydate.getDate() + "-" + (ewaymonth.toString().length > 1 ? ewaymonth : "0" + ewaymonth) + "-" +  ewaydate.getFullYear();


                        }

                        var fyYear = getData.FY_CODE;
                        var splitFy = fyYear.split('-');
                        var fy_code = splitFy[0];
                        var vr_no = getData.VRNO;


                     //   var ewaybillDt = getData.EWAYB_VALIDDT;

                     var lrno='1';

                     if(srno == 1){
                      var lrNogen = fy_code+'-'+vr_no+'/'+srno;
                     }else{
                      var lrNogen ='';
                     }
                      var invcNo = getData.INVC_NO;
                      var invcDate = getData.INVC_DATE;

                       var WagonNo = getData.WAGON_NO;
                       var delNo = getData.DELIVERY_NO;
                       var grossWt = getData.GROSS_WEIGHT;
                       var materlVal = getData.MATERIAL_VAL;

                       //alert(WagonNo);

                      if(invcNo==null){
                        var INVC_NO ='';
                      }else{
                        var INVC_NO =invcNo;
                      }

                       if(grossWt==null){
                        var GROSS_WEIGHT ='';
                      }else{
                        var GROSS_WEIGHT =grossWt;
                      }

                       if(materlVal==null){
                        var MATERIAL_VAL ='';
                      }else{
                        var MATERIAL_VAL =materlVal;
                      }

                     // console.log('delNo',delNo);

                      if(delNo==null || delNo==''){
                        var DELIVERY_NO ='';
                      }else{
                        var DELIVERY_NO =delNo;
                      }

                      if(WagonNo==null){
                        var WAGON_NO ='';
                      }else{
                        var WAGON_NO =WagonNo;
                      }

                    

                      if(invcDate==null || invcDate=='1970-01-01'){
                       var fullinvcDate = Current_date;
                      }else{
                        var getinvcDate= invcDate.split('-'); 


                        var invcdt =getinvcDate[2];
                        var invcmonth =getinvcDate[1];
                        var invcyr =getinvcDate[0];

                        var fullinvcDate =  invcdt+'-'+invcmonth+'-'+invcyr;
                      }

                    var tableData = "<div class='box-row'><div class='box10 texIndbox1'><input style='padding: 0px;width: 90px;' type='text' class='inputboxclr'  name='invoice_no[]' value='"+INVC_NO+"' id='invoice_no"+srno+"'  autocomplete='off' placeholder='Invoice No' /></div><div class='box10 texIndbox1 clr'><input style='padding: 0px;width: 90px;' type='text'  value='"+fullinvcDate+"' name='invoice_date[]' placeholder='Invoice Date'  class='datepicker inputboxclr clr' id='invoice_date"+srno+"'   autocomplete='off'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 90px;border:none' type='hidden' name='body_id[]' id='body_id"+srno+"' class='inputboxclr'  value='"+getData.TRIPBID+"' readonly=''/><input style='padding: 0px;width: 90px;border:none;text-align:right;' type='text' name='do_no[]' id='do_no"+srno+"' class='inputboxclr'  value='"+getData.DO_NO+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 90px;border:none;text-align:right;' class='inputboxclr' type='text'  value='"+DO_DATE+"' name='do_date[]' id='do_date"+srno+"'   class='datepicker' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 90px;border:none' class='inputboxclr' type='text' value='"+getData.ITEM_CODE+"' name='item_code[]' id='item_code"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;border:none' class='inputboxclr' type='text' value='"+getData.ITEM_NAME+"' name='item_name[]' id='item_name"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;border:none' class='inputboxclr cpCddata' type='text' value='"+getData.CP_CODE+"' name='cp_code[]' id='cp_code"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;border:none' class='inputboxclr' type='text' value='"+getData.CP_NAME+"' name='cp_name[]' id='cp_name"+srno+"' readonly=''/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align:right;' type='text' class='inputboxclr' name='lr_no[]' placeholder='Lr No'  id='lr_no"+srno+"' value='"+lrNogen+"' autocomplete='off'/><input type='hidden' value='1' name='uniqLrNo[]' id='uniqLrNo"+srno+"'></div><div class='box10 texIndbox1'><input class='datepicker inputboxclr lr_date'  type='text' value='"+vr_date+"' name='lr_date[]'  id='lr_date"+srno+"' onchange='getLrDateValidate("+srno+")' placeholder='Lr Date' style='padding: 0px;width: 85px;text-align:right;' autocomplete='off' onchange='getfsoRate("+srno+");'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;' type='text' class='inputboxclr' value='"+WAGON_NO+"' name='wagon_no[]' id='wagon_no"+srno+"'   autocomplete='off' placeholder='Wagon No' /></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;' type='text' value=''  name='wagon_date[]'  class='datepicker inputboxclr' id='wagon_date"+srno+"' autocomplete='off' placeholder='Wagon Date'/> </div><div class='box10 texIndbox1'><input style='padding: 0px;width: 70px;text-align: right;' type='text' class='getqtytotal'  id='qty"+srno+"'  value='"+getData.QTY+"'  name='qty[]' oninput='Getqunatity("+srno+")'  placeholder='Lr Qty'  /><input type='hidden' style='padding: 0px;width: 20px;text-align: right;' name='unit_M[]' value='"+getData.UM+"' id='UnitM"+srno+"' class='inputboxclr AddM'><input type='hidden' id='qtyget"+srno+"' class='totlqty'><input type='hidden' id='Cfactor"+srno+"'></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;' type='text' class='inputboxclr' value='"+DELIVERY_NO+"' placeholder='Delivery No' name='delivery_no[]' id='delivery_no"+srno+"'   autocomplete='off'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align:right;' type='text' class='inputboxclr' value='"+GROSS_WEIGHT+"' name='gross_weight[]' id='gross_weight"+srno+"'  placeholder='Gross Weight'  autocomplete='off'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align:right;' type='text' class='inputboxclr' value='' name='tare_weight[]' id='tare_weight"+srno+"' placeholder='Tare Weight' oninput='netWeightCal("+srno+")'   autocomplete='off'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align:right;' type='text' class='inputboxclr' value='"+getData.QTY+"' name='net_weight[]' oninput='netWeight("+srno+")' id='net_weight"+srno+"' placeholder='Net Weight'  autocomplete='off'/></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align:right;' type='text' class='inputboxclr' value='"+ewaybill_no+"' name='ewaybill_no[]' id='ewaybill_no"+srno+"'  placeholder='Eway Bill No'  autocomplete='off' oninput='getEwayBillInfo("+srno+")' /></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;' type='text' class='inputboxclr datepicker_eway' value='"+ewaybill_dt+"' name='ewaybill_date[]' id='ewaybill_date"+srno+"' placeholder='Eway Bill Date'   autocomplete='off' /></div><div class='box10 texIndbox1'><input style='padding: 0px;width: 85px;text-align: right;' type='text' class='inputboxclr'  id='material_value"+srno+"' value='"+MATERIAL_VAL+"' name='material_value[]' autocomplete='off' placeholder='Material Value' /></div></div>";

                      /*$('.clr').css('cursor','text');
                      $('.clr').css('background-color','#ddf5ff');
                      $('.clr').css('background-color','#ddf5ff');*/

                      

                    $('#itemTable').append(tableData);

                    validationLrno(srno,fy_code,vr_no);

                    $('.datepicker').datepicker({

                      format: 'dd-mm-yyyy',

                      orientation: 'bottom',

                      todayHighlight: 'true',

                      endDate: 'today',
                      
                      autoclose: 'true'

                    });


                     $('.datepicker_eway').datepicker({

                      format: 'dd-mm-yyyy',

                     

                    });
                    

                      srno++;
                  });

                   var  sf = "<div class='totlsetinres'><span id='lr_date_err' style='color:red;'></span> Total : <input type='text' value='"+total.toFixed(3)+"' style='padding: 0px;width: 85px;text-align: right;' readonly id='basicTotal'/></div>";
                    
                   $('#total').append(sf);

              }
            }

          }

    });

}

</script>

<script type="text/javascript">

   $('body').on('focus',".form_date", function(){
          $(this).datepicker({
                  format: 'dd-mm-yyyy',
                  orientation: 'bottom',
                  todayHighlight: 'true',
                  autoclose: 'true'

            });
        });

</script>
<script type="text/javascript">

  function getfsoRate(srno){

    //  alert(srno);return false;

      var vehicle_no = $("#vehicle_no").val();
      var vr_date    = $("#lr_date"+srno).val();
      var account_code    = $("#account_code").val();
      var plant_code    = $("#Plant_code").val();
      var vehicle_type    = $("#vehicle_type").val();



      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });


      $.ajax({

          url:"{{ url('get-fso_rate-by-trip') }}",

          method : "POST",

          type: "JSON",

          data: {vehicle_no: vehicle_no,vehicle_type:vehicle_type,vr_date:vr_date,account_code:account_code,plant_code:plant_code},

          success:function(data){

            var data1 = JSON.parse(data);

       
              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                   console.log(data1.data);


                  if(data1.data=='' || data1.data==null){

                      $("#sale_rate").val('0.00');
                      $("#fsohid").val('0.00');
                      $("#fsobid").val('0.00');
                   }else{

                      $("#sale_rate").val(data1.data[0].RATE);
                      $("#fsohid").val(data1.data[0].FSOHID);
                      $("#fsobid").val(data1.data[0].FSOBID);
                   }

              }

          }

    });



  }
</script>

<script type="text/javascript">

  function getEwayBillInfo(billNo){

   var ewaybillNo =  $("#ewaybill_no"+billNo).val();
   var Plant_code =  $("#Plant_code").val();

   console.log(ewaybillNo);


   $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });


    $.ajax({

          url:"{{ url('get-ewaybill-details-for-trip-plan') }}",

          method : "POST",

          type: "JSON",

          data: {ewaybillNo: ewaybillNo,Plant_code:Plant_code},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                $("#errEwyBill").html('Data Not Found').css('color','red');
                console.log('data not found in api');

              }else if(data1.response == 'success'){

                  var info = data1.data.response;

                    if(info == null){

                        console.log('not found');

                        $("#errEwyBill").html('Eway Bill No Not Found').css('color','red');
                        $("#ewaybill_date"+billNo).val('');
                     
                    }else{

                        $("#errEwyBill").html('');
                        $("#ewaybill_date"+billNo).val(info.validUpto);


                    }
                 

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
  
     var gr_amt;
     if(checkqty){
      
      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value);

                
            }

          $("#basicTotal").val(gr_amt.toFixed(3));

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());

     }else{

      $("#delivery_no").prop('readonly',true);
     
      gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value);

                
            }

          $("#basicTotal").val(gr_amt.toFixed(3));

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());
     }
    



  }
</script>

<script type="text/javascript">

 function submitData(pdfFlag){

  var downloadFlg = pdfFlag;

  $('#pdfYesNoStatus').val(downloadFlg);

      var trcount=$('table tr').length;

     var route_code = $("#route_code").val();
     var from_place = $("#from_place").val();
     var to_place = $("#to_place").val();

     if(route_code=='' || from_place=='' || to_place==''){

     	  $("#requiredMsg").html('* Feilds Are Required').css('color','red');

     	  return false;
     }

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


                 var data1 = JSON.parse(data);
               
               if(data1.response=='error'){
                  var responseVar =false;
               
                  var url = "{{ url('/Transaction/View-lorry-receipt-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar =true;

                  if(downloadFlg == 1){

                    var ulrLenght = data1.url.length;

                    console.log(ulrLenght);

                    for(var q=0;q<ulrLenght;q++){

                      var fileN     = 'LRTRAN_'+q+''+downloadFlg;
                      
                      var link      = document.createElement('a');
                      link.href = data1.url[q];
                      link.download = fileN+'.pdf';

                      link.dispatchEvent(new MouseEvent('click'));

                    }
                   
                  }

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

<script type="text/javascript">
  function validationLrno(slNo,fyCd,vrNo){

      if(slNo > 1){

        var cpCdAry = [];
    
        $(".cpCddata").each(function () {

          cpCdAry.push(this.value);
          
        });



        var rowWiseCPCode = $('#cp_code'+slNo).val();


        
        cpCdAry.splice(-1);
        //console.log(cpCdAry,'cpCdAry');
        var isInArray = cpCdAry.includes(rowWiseCPCode);
        
        var postionOfVal = cpCdAry.indexOf(rowWiseCPCode);

        if(postionOfVal == '-1'){
         // console.log('not Same');
          var getexistVal = $('#generateLrNo').val();
          var lrNoGenerate = parseInt(getexistVal) + parseInt(1);
        //  console.log('getexistVal',getexistVal);
         // console.log('lrNoGenerate',lrNoGenerate);
          $('#generateLrNo').val(lrNoGenerate);
          $('#uniqLrNo'+slNo).val(lrNoGenerate);
          $('#lr_no'+slNo).val(fyCd+'-'+vrNo+'/'+lrNoGenerate);
        }else{
          var existLr =  parseInt(postionOfVal) + parseInt(1);

          var getExistlrNo = $('#uniqLrNo'+existLr).val();
          $('#uniqLrNo'+slNo).val(getExistlrNo);
          $('#lr_no'+slNo).val(fyCd+'-'+vrNo+'/'+getExistlrNo);
        }

      }

    }
</script>


@endsection