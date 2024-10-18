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

    .textheight{

      height: 17px;
    }

  .PageTitle{
    margin-right: 1px !important;
  }

  .required-field::before {
    content: "*";
    color: red;
  }

  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }
  .withoutDo{

    display:none;
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

[data-tip] {
  position:relative;

}
[data-tip]:before {
  content:'';
  /* hides the tooltip when not hovered */
  display:none;
  content:'';
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid #1a1a1a; 
  position:absolute;
  top:20px;
  left:35px;
  z-index:8;
  font-size:0;
  line-height:0;
  width:0;
  height:0;
}
[data-tip]:after {
  display:none;
  content:attr(data-tip);
  position:absolute;
  top:25px;
  left:0px;
  padding:3px 3px;
  background:#1a1a1a;
  color:#fff;
  z-index:9;
  font-size: 0.75em;
  height:25px;
  line-height:18px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  white-space:nowrap;
  word-wrap:normal;
}
[data-tip]:hover:before,
[data-tip]:hover:after {
  display:block;
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

/*.inputwidth{
 width:100%;
}*/

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

    padding: 5px;

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

  width: 46px;

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
    padding: 2px 4px !important;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
}
.btn-sm-class{
    padding: 2px 4px !important;
    font-size: 12px !important;
    line-height: 1.5 !important;
    border-radius: 3px !important;
}
#AccTable{
  overflow-y: scroll !important;
}
.removeSpaceOnModl{
    padding: 2px 15px 2px 15px;
    text-align: center;
}
.modal-header--sticky {
  position: sticky;
  top: 0;
  background-color: inherit; /* [1] */
  z-index: 1055; /* [2] */
}

/* Footer fixed to the bottom of the modal */
.modal-footer--sticky {
  position: sticky;
  bottom: 0;
  background-color: inherit; /* [1] */
  z-index: 1055; /* [2] */
}
</style>




<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Trip Plan
 
            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Logistics</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Add Vehicle Trip Plan</a></li>

          </ol>

        </section>


<form id="salesordertrans">
      @csrf
  <section class="content">

    <div class="row">

       

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Trip Plan</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-fleet') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Trip Plan</a>

              </div>

              

                  <div class="box-tools pull-right">

                    <a href="{{ url('/view-vehicle-planing-mast') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Trip Plan</a>

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


                <div class="modalspinner hideloaderOnModl"></div>
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

                              <input type="text" class="form-control transdatepicker" name="vr_date" id="vr_date" value="{{ $CurrentDate }}" placeholder="Select Date" autocomplete="off">

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

                          <label> T Code : </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                              <input type="text" class="form-control" name="trans_code" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                              <input type="hidden" id="transtaxCode" >

                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

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
                              <?php $sriescount =  count($series_list); ?>
                            <input list="seriesList1"  id="series_code" name="series_code" class="form-control  pull-left" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();">

                            <datalist id="seriesList1">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($series_list as $key)

                                <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                              @endforeach

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


                              <input type="text" class="form-control" name="series_name" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>

                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Vr No: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          

                            <input type="text" class="form-control" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                         </div>
                        <!-- /.form-group -->
                      </div>
                      <!-- /.col -->

                    </div>
                    <!-- /.row -->

                    <div class="row">
            
                <div class="col-md-2" style="width: 192px;">
                  <div class="form-group">
                     <label>
                      &nbsp;
                    
                    </label>
                     <div class="input-group">

                      <input type="radio" class="optionsRadios1" name="do_type" value="With DO" checked="">&nbsp;&nbsp;<span style="font-weight: 700 !important;font-size: 12px !important;">With DO.</span> &nbsp;&nbsp;

                      <input type="radio" class="optionsRadios1" name="do_type" id="doublepoint" value="Without DO" >&nbsp;&nbsp<span style="font-weight: 700 !important;font-size: 12px !important;">Without DO.<span>


                    </div>


                         

                      <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('do_type', '<p class="help-block" style="color:red;">:message</p>') !!}
                      </small>
                      <small id="invcErr" style="color: red;"></small>
                  </div>
                  <!-- /.form-group -->
                 </div>

                    <div class="col-md-2 withDo">

                        <div class="form-group">

                          <label>Customer Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="" placeholder="Select Customer" readonly="" 
                             onchange="getDoDetailsByCust()" autocomplete="off"> 

                              <datalist id="AccountList">

                              
                                @foreach ($getacc_do as $key)

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


                       <div class="col-md-2  withoutDo">

                        <div class="form-group">

                          <label>Customer Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="AccountList_wdo"  id="account_code_wdo" name="AccCodeWdo" class="form-control  pull-left" value="" placeholder="Select Customer"  autocomplete="off" onchange="getDoDetailsByCustWdo()" > 

                              <datalist id="AccountList_wdo">

                              
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
                      

                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Customer Name : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="acctname" value="" id="accountName" placeholder="Enter Department Name" readonly autocomplete="off">

                            </div>
                            
                        </div>
                        
                      </div>

                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Employee Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="empList" class="form-control" name="emp_code" value="" id="emp_code" placeholder="Enter Employee Code"  autocomplete="off">

                              <datalist id="empList">
                                s
                              <?php foreach($employee_list as $accRow)  { ?>

                                <option value="<?= $accRow->ACC_CODE ?>" data-xyz="<?= $accRow->ACC_NAME ?>"><?= $accRow->ACC_NAME ?></option>

                               <?php } ?>

                              </datalist>

                            </div>
                            
                        </div>
                        
                      </div>
                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Employee Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="emp_name" value="" id="emp_name" placeholder="Enter Employee Name"  autocomplete="off" readonly>

                            </div>
                            
                        </div>
                        
                      </div>
               
                    

                    <div class="col-md-2">
                      <!--  <button type="button" class="btn btn-xs btn-primary" id="doDetailsBtn"  onclick="ShowDoDetails()" style="padding: 0px 1px; font-size: 12px;margin-top:16px;float:left;" >&nbsp;&nbsp;SHOW DO DETAILS&nbsp;&nbsp;</button> -->
                      <button type="button" class="btn btn-primary btn-sm-class" id="doDetailsBtn" onclick="ShowDoDetails()" style="margin-top: 7%;">&nbsp;&nbsp;<i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;SHOW DO DETAILS&nbsp;&nbsp;</button>
                      
                    </div>

              </div> <!-- row -->

             

            
              <!-- /.row -->


             
           
            

             <!--  <div style="text-align: center;">


                 <button type="Submit" class="btn btn-primary">

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{ $button }} 

                 </button>

              </div>
 -->
          

          </div><!-- /.box-body -->

           

          </div>

      </div>

     


    </div>

     

  </section>



<section class="content" style="margin-top: -10%;" id="bodyId">

    <div class="row">

      <div class="col-sm-12">
          <ul class="nav nav-tabs">
                <li class="active"  style="float: none !important;">
                  <a href="#tab1info" id="basicInfo" data-toggle="tab" style='line-height:0.5'><b>Item/DO Details</b></a>
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

                    <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 10px;"> Sr.No.</th>
                   	<th>CUSTOMER CODE </th>
                    <th>CUSTOMER NAME</th>
                    <th style="width: 10%;" class="doorderNo">DORDER NO.</th>
                    <th class="withoutDo">CONSIGNEE</th>
                    <th class="withoutDo">ADDRESS</th>
                    <th class="withoutDo">TO PLACE</th>
                    <th>ITEM CODE </th>
                    <th>ITEM NAME</th>
                    <th class="withDo">CP NAME/CP CODE</th>
                     <th class="withDo">SP NAME/SP CODE</th>
                     <th class="withDo">ITEM SLNO</th>
                     <th style="width: 10%;" class="doorderNo">INVOICE NO.</th>
                    <th class="withDo">TO PLACE</th>
                    <th>QTY</th>
                    <th>AQTY</th>
                   
                   
                  </tr>

                  <tr class="useful" id="first_Row">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">1.</span>
                    </td>
                    <td class="tdthtablebordr withDo" style="width: 10%;">

                       <input list="custList1" class="inputboxclr getAccNAme inputwidth"  name="custCode[]" id="custCode1"   placeholder="Customer Code" onchange="getRowDoDetailsByCust(1)"  autocomplete="off" readonly="">

                      <datalist id="custList1">

                      		@foreach ($getacc_do as $key)

                               <option value='<?php echo $key->ACC_CODE?>'  data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?></option>

                                @endforeach
                         
                            
                      </datalist>

                    </td>
                    <td class="tdthtablebordr withDo" style="width: 10%;">

                       <input type="text" class="inputboxclr getAccNAme inputwidth"  name="custName[]" id="custName1"   placeholder="Customer Name"  autocomplete="off" readonly=""> 

                      <datalist id="deliveryList1">

                         
                            
                      </datalist>


                    </td>
                     <td class="tdthtablebordr withoutDo" style="width: 10%;">

                       <input list="custwdoList1" class="inputboxclr getAccNAme inputwidth"  name="custwdoCode[]" id="custwdoCode1"   placeholder="Customer Code" onchange="getRowDoDetailsByCust(1)"  autocomplete="off">

                      <datalist id="custwdoList1">

                          @foreach ($getacc_do as $key)

                               <option value='<?php echo $key->ACC_CODE?>'  data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?></option>

                                @endforeach
                         
                            
                      </datalist>

                    </td>
                    <td class="tdthtablebordr withoutDo" style="width: 10%;">

                       <input type="text" class="inputboxclr getAccNAme inputwidth"  name="custwdoName[]" id="custwdoName1"   placeholder="Customer Name"  autocomplete="off" readonly=""> 



                    </td>

                    <td class="tdthtablebordr doorderNo" style="width: 10%;">

                       <input list="deliveryList1" class="inputboxclr getAccNAme inputwidth"  name="do_no[]" id="do_no1"   placeholder="Select Do No" onchange="getDoDetials(1)" oninput="donumber(1)" autocomplete="off">

                      <datalist id="deliveryList1">

                         
                            
                      </datalist>

                      <input type="hidden" name="delorder_date[]" id="delorder_date1">

                      
                      <input type="hidden" name="slnodo[]" id="slnodo1">

                    </td>


                     <td class="tdthtablebordr withoutDo" style="width: 10%;">
                       <input list="ConsineeList_wdo1" class="inputboxclr  inputwidth"  id='consignee_wdo1' name="consignee_wdo[]" placeholder="Consinee Code"  onchange="consigneeName(1)"  oninput="this.value = this.value.toUpperCase()" autocomplete='off' />

                       <datalist id="ConsineeList_wdo1">

                              
                                @foreach ($getconsinee as $key)

                               <option value='<?php echo $key->ACC_CODE?>'  data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?></option>

                                @endforeach

                      </datalist>

                       <div style='margin-top:2px;'>
                        <input type="text" class="inputboxclr inputwidth" name="consineeName_wdo[]" id="consineeName_wdo1" autocomplete='off' readonly placeholder="Consinee Name">
                       </div>

                   
                     
                    </td>

                    <td class="tdthtablebordr withoutDo" style="width: 20%;">
                      <div class="input-group">
                       <input list="ConsineeAddList1" class="inputboxclr" style="width: 139px;" id='consigneeadd1' name="consigneeadd[]" onchange="getcityName(1)"  oninput="this.value = this.value.toUpperCase()" autocomplete='off' />

                       <datalist id="ConsineeAddList1">
                        </datalist>


                     </div>
                      <input type="hidden" name="cp_address[]" id="cp_address1">
                    </td>

                     <td class="tdthtablebordr tooltips withoutDo" style="width: 20%;">

                       

                       <input list="toplaceList_wdo1" class="inputboxclr inputwidth"  id='to_place_wdo1' name="to_place_wdo[]"  autocomplete='off' oninput="this.value = this.value.toUpperCase()" onchange="toPlaceWDo(1);"  placeholder="Select To Place"/>

                       <datalist id="toplaceList_wdo1">
                       

                      </datalist>
                     

                     </td>
                   
                    <td class="tdthtablebordr tooltips" style="width: 15%;">
                     
                         


                        <input list="ItemList1" class="inputboxclr inputwidth"  id='ItemCodeId1' name="item_code[]"   oninput="this.value = this.value.toUpperCase()"  onchange="getItemQty(1)" autocomplete="off" placeholder="Select Item Code" readonly="" />
                        <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>
                          <datalist id="ItemList1">

                            @foreach($item_list as $key)
                            <option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?>
                            @endforeach
                              
                            </option>

                             
                          </datalist>
                     
                          
                      
                       <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>
                      <!--  <div><p id="stockavlble1" class="badge" style="background-color:#25b6bd;"></p>
                       </div> -->
                      
                    </td>

                    <td class="tdthtablebordr tooltips" style="width: 20%;">


                       <input type="text" class="inputboxclr inputwidth getAccNAme" id='Item_Name_id1' name="item_name[]" placeholder="Enter Item Name" readonly />
                       <input type="hidden" class="inputboxclr inputwidth" id='aliseItem_code1' name="alise_item_code[]" placeholder="Enter Item Name" readonly />
                       <input type="hidden" class="inputboxclr inputwidth" id='aliseItem_Name1' name="alise_item_name[]" placeholder="Enter Item Name" readonly />
                     </br>
                       <textarea type="text" class="inputboxclr inputwidth getAccNAme" style="height: 20px;" id='remark1' name="remark[]" placeholder="Enter Description" row="0" autocomplete="off"></textarea>

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small>

                       <input type="hidden" name="do_qty[]" id="do_qty1">
                    </td>

                   

                     <td class="tdthtablebordr withDo" style="width: 15%;">

                     
                      
                       <input list="ConsineeList1" class="inputboxclr  inputwidth"  id='consignee1' name="consignee[]" placeholder="Consinee Code"  onchange="consigneeName(1)"  oninput="this.value = this.value.toUpperCase()" autocomplete='off' readonly="" />

                       <datalist id="ConsineeList1">

                              
                                @foreach ($getconsinee as $key)

                               <option value='<?php echo $key->ACC_CODE?>'  data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?></option>

                                @endforeach

                      </datalist>

                       <div style='margin-top:2px;'>
                        <input type="text" class="inputboxclr inputwidth" name="consineeName[]" id="consineeName1" autocomplete='off' readonly placeholder="Consinee Name">
                         <input type="hidden" class="inputboxclr inputwidth" name="consineeAdd[]" id="consineeAdd1" autocomplete='off' readonly placeholder="Consinee Add">
                         <input type="hidden" class="inputboxclr inputwidth" name="region[]" id="region1" autocomplete='off' readonly placeholder="region">
                         <input type="hidden" class="inputboxclr inputwidth" name="acatgory_code[]" id="acatgory_code1" autocomplete='off' readonly placeholder="Consinee Name">
                         <input type="hidden" class="inputboxclr inputwidth" name="rcomp_code[]" id="rcomp_code1" autocomplete='off' readonly placeholder="Consinee Name">
                         <input type="hidden" class="inputboxclr inputwidth" name="rcomp_name[]" id="rcomp_name1" autocomplete='off' readonly placeholder="Consinee Name">
                       </div>

                   
                     
                    </td>

                    <td class="tdthtablebordr withDo" style="width: 15%;">

                     
                      
                       <input list="SpList1" class="inputboxclr  inputwidth"  id='sp_code1' name="sp_code[]" placeholder="Sp Code"  onchange="getspName(1)"  oninput="this.value = this.value.toUpperCase()" autocomplete='off' readonly=""/>

                       <datalist id="SpList1">

                              
                                @foreach ($getconsinee as $key)

                               <option value='<?php echo $key->ACC_CODE?>'  data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?></option>

                                @endforeach

                      </datalist>

                       <div style='margin-top:2px;'>
                        <input type="text" class="inputboxclr inputwidth" name="spName[]" id="spName1" autocomplete='off' readonly >
                        <input type="hidden" class="inputboxclr inputwidth" name="ewaybill_no[]" id="ewaybill_no1" autocomplete='off' readonly>
                        <input type="hidden" class="inputboxclr inputwidth" name="ewaybill_dt[]" id="ewaybill_dt1" autocomplete='off' readonly>
                        
                        <input type="hidden" class="inputboxclr inputwidth" name="Invc_dt[]" id="Invc_dt1" autocomplete='off' readonly>
                        <input type="hidden" class="inputboxclr inputwidth" name="wagon_no[]" id="wagon_no1" autocomplete='off' readonly>
                        <input type="hidden" class="inputboxclr inputwidth" name="do_headId[]" id="do_headId1" autocomplete='off' readonly>
                        <input type="hidden" class="inputboxclr inputwidth" name="do_bodyId[]" id="do_bodyId1" autocomplete='off' readonly>
                        <input type="hidden" class="inputboxclr inputwidth" name="delivery_no[]" id="delivery_no1" autocomplete='off' readonly>
                        <input type="hidden" class="inputboxclr inputwidth" name="gross_wt[]" id="gross_wt1" autocomplete='off' readonly>
                        <input type="hidden" class="inputboxclr inputwidth" name="do_batch_no[]" id="do_batch_no1" autocomplete='off' readonly>


                         <input type="hidden" class="form-control" name="fsorder_no" value="" id="fsorder_no" placeholder="Enter Freight Sale No" readonly autocomplete="off">

                         <input type="hidden" class="form-control" name="sale_rate"  id="sale_rate" placeholder="Enter Sale Rate" readonly autocomplete="off">
                        <input type="hidden" class="form-control" name="fsohid"  id="fsohid" placeholder="Enter Sale Rate" readonly autocomplete="off">
                        <input type="hidden" class="form-control" name="fsobid"  id="fsobid" placeholder="Enter Sale Rate" readonly autocomplete="off">
                        <input type="hidden" class="form-control" name="refNo"  id="refNo"  readonly autocomplete="off">

                       <input type="hidden" class="form-control" name="sale_qty" value="" id="sale_qty" placeholder="Enter Sale Qty" readonly autocomplete="off">
                       </div>

                   
                     
                    </td>

                    <td class="tdthtablebordr withDo" style="width: 15%;">

                       <input type="text" class="inputboxclr  inputwidth rightcontent"  id='item_slno1' style='width: 70px;' name="item_slno[]" placeholder="Item Slno"   oninput="this.value = this.value.toUpperCase()" autocomplete='off' />

                    </td>

                     <td class="tdthtablebordr withDo"  style="width: 10%;">
                        <input type="text" class="inputboxclr inputwidth" name="Invc_no[]" id="Invc_no1" autocomplete='off' placeholder="Invoice No">
                     </td>

                     <td class="tdthtablebordr tooltips withDo" style="width: 15%;">

                       

                       <input list="toplaceList1" class="inputboxclr inputwidth"  id='to_place1' name="to_place[]"  onchange="toPlaceW(1);" autocomplete='off' oninput="this.value = this.value.toUpperCase()"  placeholder="Select To Place" readonly="" />

                       <datalist id="toplaceList1">
                       
                          <?php foreach ($area_list as $key) { ?>

                              <option value="<?= $key->CITY_NAME ?>" data-xyz="<?= $key->CITY_CODE ?>"><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option>

                            <?php } ?>

                      </datalist>
                     

                     </td>
                   

                    <td class="tdthtablebordr" style="width: 5%;">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="dr_amount inputboxclr  inputwidth getqtytotal quantityC moneyformate qtyclc rightcontent"  id='qty1' name="qty[]" oninput='Getqunatity(1)' value='' style="width: 65px;"  placeholder='Enter Qty' autocomplete="off"  />
                      <input type='hidden'   id='pre_qty1' style='width:65px;' name='pre_qty[]' value=''   placeholder='Enter Qty' autocomplete='off'/>
                      <input type="hidden" id="qtyget1" class="totlqty">
                      <input list="umList1" name="unit_M[]"  style="width: 40px;" id="UnitM1" class="inputboxclr  AddM" autocomplete="off">

                      <datalist id="umList1">
                        <?php foreach($um_list as $key) { ?>
                          
                          <option value="<?= $key->UM_CODE ?>" data-xyz="<?= $key->UM_NAME ?>"><?= $key->UM_CODE ?> - <?= $key->UM_NAME ?></option>

                       <?php  } ?>
                      </datalist>

                      <input type="hidden" id="Cfactor1">

                      </div>
                       <div><small id="errmsgqty1"></small></div>

                    </td>

                    <td class="tdthtablebordr" style="width: 5%;">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="dr_amount inputboxclr  inputwidth getaqtytotal quantityC moneyformate qtyclc rightcontent"  id='Aqty1' name="Aqty[]" oninput='Getqunatity(1)' style="width: 65px;" value=''  placeholder='Enter Qty' autocomplete="off"  />
                      <input type="hidden" id="qtyget1" class="totlqty">
                      <input list="aumList1" name="unit_AUM[]" style="width: 40px;" id="UnitAUM1" class="inputboxclr  AddM" autocomplete="off">

                      <datalist id="aumList1">
                        <?php foreach($um_list as $key) { ?>
                          
                          <option value="<?= $key->UM_CODE ?>" data-xyz="<?= $key->UM_NAME ?>"><?= $key->UM_CODE ?> - <?= $key->UM_NAME ?></option>

                       <?php  } ?>
                      </datalist>

                      <input type="hidden" id="Cfactor1">

                      </div>
                       <div><small id="errmsgqty1"></small></div>

                    </td>

                     

                  </tr>

                </table>

              </div><!-- /div -->

             

              <div class="row">
    
              <div class="col-md-4">

                 <input type="hidden" name="dubindicator" id="dubindicator">
                 <input type="hidden" name="dubindicatoraddmore" id="dubindicatoraddmore">
                 <input type="hidden" name="indidubName1[]" id="indidubName" value="">

                  <button type="button" class="btn btn-danger btn-sm delete" id="deletehidn" disabled=""><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>
                  <button type="button" class="btn btn-info btn-sm addmore" id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

                  <small id="showDubDataMsg" style="color: red;"></small>
                  <input type="hidden" name="dublicateName1[]" id="dublicateName" value="">

                  <input type="hidden" name="deletedubName1[]" id="deletedubName" value="">

              </div>

              <div class="col-md-4">
                 <p style="text-align:center;"><small id="doqtyerr"></small></p>
              </div>
              <div><span id="cityMsg"></span></div>
              <div class="col-md-4">

                  <div style="display: flex;float: right;">
                      <div class="toalvaldesn" style="margin-top: 2%;margin-right: 21px;">Total :</div>
                      <input class="debitcreditbox inputboxclr" type="text" name="TotlDebit" id="basicTotal"  readonly="" style="width: 98px;margin-right: 26px;">
                      <input class="debitcreditbox inputboxclr" type="text" name="TotlAqty" id="basicAqtyTotal"  readonly="" style="width: 98px;">

                       <input type="hidden" name="basicTotalTemp" id="basicTotalTemp" value="">
                  </div>
                  <!-- id="totldramt" -->
              </div>

          </div>
              <!-- <div class="row" style="display: flex;">

                  <div class="col-md-7">
                   
                  </div>

                    <div class="col-md-3 toalvaldesn">

                      

                    <div class="totlsetinres">Total :</div>

                  </div>

                  <div class="col-md-1">
                     <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="basicTotal" readonly="" style="margin-top: 3px;margin-left: 35px;width:90px;">

                    <input type="hidden" name="basicTotalTemp" id="basicTotalTemp">
                  </div>

                  <div class="col-md-1"></div>

              </div>


        


        <button type="button" class='btn btn-danger btn-sm delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

        <button type="button" class='btn btn-info btn-sm addmore' id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button> -->

       

      
      
  </div><!-- /.box-body -->

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
                  <a href="#tab1info" id="basicInfo" data-toggle="tab" style="line-height:0.5;"><b>Freight Details</b></a>
                </li>
                <!-- <li id="secondTab">
                  <a href="#tab2info" data-toggle="tab" >Other Details</a>
                </li> -->
            </ul>
        <div class="box box-warning Custom-Box">
         
          <div class="box-body">

            <div class="row">
            


            <div class="col-md-2">

                        <div class="form-group">

                          <label>Plant Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon" style="padding: 1px 7px;">
                                 <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                               </span>
                              <?php $plcount = count($plant_list); ?>
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>"  autocomplete="off" onchange="PlantCode()">

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

                      <label>

                       From Place: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="fromplaceList" class="form-control" name="from_place" id="from_place"  value="{{ $from_place }}" placeholder="Enter From Place" autocomplete="off"/>

                          <datalist id="fromplaceList">

                            <?php foreach ($area_list as $key) { ?>

                              <option value="<?= $key->CITY_NAME ?>" data-xyz="<?= $key->CITY_CODE ?>"><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option>

                            <?php } ?>
                            
                            
                          </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('from_place', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
              

                    
              
                </div>

                <div class="row">
                  

                  
                   <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       To Place: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="headtoplaceList" class="form-control" name="head_toplace" id="head_toplace"  value="" placeholder="Enter To Place" autocomplete="off" readonly/>

                          <datalist id="headtoplaceList">

                            <?php foreach ($area_list as $key) { ?>

                              <option value="<?= $key->CITY_NAME ?>" data-xyz="<?= $key->CITY_CODE ?>"><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option>

                            <?php } ?>
                            
                            
                          </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('head_toplace', '<p class="help-block" style="color:red;">:message</p>') !!}

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

                          <input list="offdaysList" class="form-control" name="off_days" id="off_days"  value="" placeholder="Enter Off Days" autocomplete="off">

                            <datalist id="offdaysList">
                              <option value="NA">NA</option>
                              <option value="SUNDAY">SUNDAY</option>
                              <option value="MONDAY">MONDAY</option>
                              <option value="TUESDAY">TUESDAY</option>
                              <option value="WEDNESDAY">WEDNESDAY</option>
                              <option value="THURSDAY">THURSDAY</option>
                              <option value="FRIDAY">FRIDAY</option>
                              <option value="SATURDAY">SATURDAY</option>
                            </datalist>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('transporter', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>

                   <div class="col-md-3">

                    <div class="form-group">

                      <label>

                        Vehicle No : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input list="vehicleList" class="form-control" name="vehicle_no" id="vehicle_no" value="{{ $vehicle_no }}" placeholder="Enter Vehicle No" maxlength="13" oninput="getvehicleOwner();"  autocomplete="off"  readonly="" >

                            <datalist id="vehicleList">
                              
                              <?php foreach ($vehicle_list as $key) { ?>
                                
                              <option value="<?= $key->TRUCK_NO ?>" data-xyz="<?= $key->TRUCK_NO ?>"><?= $key->TRUCK_NO ?> - <?= $key->OWNER ?></option>

                              <?php   } ?>

                            </datalist>

                           <span class="input-group-addon" style="padding: 1px 7px;">
                            
                            <div class="">
                              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-backdrop="static" style="font-size: 10px !important;"><i class="fa fa-plus 2xs"></i></button>
                            </div>
                            
                            
                          </span>
                          

                           
                        </div>
                          <small id="vehicleErr1msg" style="color:red;"></small>
                          <small id="vehicleRemarkmsg" style="color:red;"></small>
                         <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                          
                            </div>  
                        </div>



                    </div>

                    <!-- /.form-group -->

                  </div>


                   <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Vehicle Owner: 

                                    <span class="required-field" id="compn_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="ownerList" class="form-control" name="vehicle_owner"  placeholder="Enter Vehicle Owner" id="vehicle_owner" autocomplete="off" />

                                      <datalist id="ownerList">

                                        
                                      </datalist>
                                     

                                  </div><br>

                                 
                                   <small id="vownererr" style="color: red;"></small>

                                </div>

                                

                                <!-- /.form-group -->

                              </div>


                              <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Vehicle Type: 

                                    <span class="required-field" id="compn_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="vehicleTypeList" class="form-control" name="vehicle_type"  placeholder="Enter Vehicle Owner" id="vehicle_type" autocomplete="off"  oninput="getfsoRate();"/>

                                      <datalist id="vehicleTypeList">
                                        <?php foreach($freightType_list as $key) { ?>

                                        <option value="<?= $key->FREIGHTTYPE_NAME ?>" data-xyz="<?= $key->FREIGHTTYPE_CODE ?>"><?= $key->FREIGHTTYPE_CODE ?> - <?= $key->FREIGHTTYPE_NAME ?></option>

                                        <?php } ?>
                                        
                                      </datalist>
                                     
                                      <input type="hidden" id="vehicleType_name" name="vehicleType_name" value="" />
                                      <input type="hidden" id="whee_type_code" name="whee_type_code" value="" />
                                     <!--  <input type="hidden" id="whee_type_name" name="whee_type_name" value="" />
                                      <input type="hidden" id="min_gurrentee" name="min_gurrentee" value="" /> -->
                                  </div><br>

                                 
                                   <small id="vownererr" style="color: red;"></small>

                                </div>

                                

                                <!-- /.form-group -->

                              </div>

                </div>

                <div class="row">

                  
                              <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Wheel Type: 

                                    <span class="required-field" id="compn_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="wheelTypeList" class="form-control" name="whee_type_name"  placeholder="Enter Vehicle Owner" id="whee_type_name" autocomplete="off" readonly/>



                                      <datalist id="wheelTypeList">

                                        <?php foreach($wheel_list as $key) { ?>

                                        <option value="<?= $key->WHEEL_NAME ?>" data-xyz="<?= $key->WHEEL_CODE ?>"><?= $key->WHEEL_CODE ?> - <?= $key->WHEEL_NAME ?></option>

                                        <?php } ?>
                                        
                                      </datalist>
                                     
                                     
                                  </div><br>

                                 
                                   <small id="vownererr" style="color: red;"></small>

                                </div>

                                

                                <!-- /.form-group -->

                              </div>

                              <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Min Guarantee: 

                                    <span class="required-field" id="compn_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="minList" class="form-control" name="min_gurrentee"  placeholder="Enter Min Guarantee" id="min_gurrentee" autocomplete="off" readonly/>

                                      <datalist id="minList">
                                        <?php foreach($freightType_list as $key) { ?>

                                        <option value="<?= $key->FREIGHTTYPE_NAME ?>" data-xyz="<?= $key->FREIGHTTYPE_CODE ?>"><?= $key->FREIGHTTYPE_CODE ?> - <?= $key->FREIGHTTYPE_NAME ?></option>

                                        <?php } ?>
                                        
                                      </datalist>
                                     
                                    
                                  </div><br>

                                 
                                   <small id="vownererr" style="color: red;"></small>

                                </div>

                                

                                <!-- /.form-group -->

                              </div>

                 <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Vendor/Agent Code: 

                        <span class="required-field hideclass"></span>

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

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Transporter Name: 

                        <span class="required-field hideclass"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-car"></i></span>

                          <input type="text" class="form-control" name="transporter_name" id="transporter_name"  value="" placeholder="Enter Transporter" autocomplete="off" readonly="">

                            

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('transporter', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                  </div>


                  <div class="col-md-2">

                    <div class="form-group">

                      <label>

                       Purchase Freight Order : 

                        <span class="required-field hideclass"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input list="fpoList" name="fright_order" class="form-control" value="{{ $fright_order }}" id="fright_order" placeholder="Enter Fright Order" autocomplete="off" readonly="">


                        <datalist id="fpoList">
                          <?php foreach ($fpo_list as $key) {


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

                        Freight Qty : 

                        <span class="required-field hideclass"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="freight_qty"  id="freight_qty" class="form-control" placeholder="Enter Freight Qty" autocomplete="off" oninput="chnageadvRate()" readonly="">


                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('freight_qty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                  
                  

                </div>

              <div class="row">

                <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Rate : 

                        <span class="required-field hideclass"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="rate"  id="rate" class="form-control" placeholder="Enter Rate" autocomplete="off" oninput="chnageadvRate()" readonly="">

                        <input type="hidden" name="mfprate" id="mfprate">
                        <input type="hidden" name="rate_basis" id="rate_basis">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                 


                    <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Amount : 

                        <span class="required-field hideclass"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input type="text" name="amount"  id="amount" class="form-control" placeholder="Enter Amount" autocomplete="off" oninput="chnageadvRate()" readonly="">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                    <div class="col-md-2">

                    <div class="form-group">

                      <label>

                        Payment Mode : 

                        <span class="required-field hideclass"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-caret-right"></i>

                          </span>

                        <input list="paymentList" name="payment_mode"  id="payment_mode" class="form-control" placeholder="Enter Payment Mode" autocomplete="off" readonly="">

                        <datalist id="paymentList">
                            <option value="UPI PAYMENT" data-xyz="UPI PAYMENT">UPI PAYMENT</option>
                            <option value="RTGS" data-xyz="RTGS">RTGS</option>
                            <option value="NEFT" data-xyz="NEFT">NEFT</option>
                        </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>
                             <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                    Adv. Type : 

                                    <span class="required-field hideclass"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="typeList" class="form-control" name="adv_type" id="adv_type"  value="" placeholder="Select Adv Type" autocomplete="off" onchange="advanceType();" readonly=""/>

                                      <datalist id="typeList">

                                        <option value="Lumsum">Lumsum</option>
                                        <option value="Percent">Percent</option>
                                        <option value="Qty">Qty</option>
                                        
                                      </datalist>
                                      

                                  </div>
                                  <input type="hidden" id="advtype" name="advtype" value="">

                      

                                </div>

                                <!-- /.form-group -->

                              </div>

                             <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                   Adv. Rate:<span class="required-field hideclass" id="compc_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="adv_rate" id="adv_rate"  value="" oninput="chnageadvRate();" placeholder="Enter Adv Rate"  autocomplete="off" readonly=""/>

                                      <input type="hidden" name="advcal_rate" id="advcal_rate">
                                      <input type="hidden" name="advrate" id="advrate" value="">
                                      

                                  </div>

                                
                                </div>

                                <!-- /.form-group -->

                              </div>

                              
                               <div class="col-md-2">

                                <div class="form-group">

                                  <label>

                                    Adv. Amount : 

                                    <span class="required-field hideclass"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="adv_amount"  placeholder="Enter Adv Amount" id="adv_amount"  autocomplete="off" readonly="" />

                                      <input type="hidden" id="advAmount" value="" name="advAmount">

                                  </div><br>

                                 
                                   <small id="adverr" style="color: red;"></small>

                                </div>


                              </div>


                               


                          </div>

                          <div class='row'>

                            <div class="col-md-2">

                                    <div class="form-group">

                                      <label>

                                        Trip Expense : 

                                        <span class="required-field hideclass"></span>

                                      </label>

                                            <div class="input-group">

                                                <span class="input-group-addon">

                                                  <i class="fa fa-caret-right"></i>

                                                </span>

                                              <input list="expenseList" name="trip_expense"  id="trip_expense" class="form-control" placeholder="Enter Trip Expense" value="YES" autocomplete="off">

                                              <datalist id="expenseList">
                                                  <option value="YES" data-xyz="YES">YES</option>
                                                  <option value="NO" data-xyz="NO">NO</option>
                                                 
                                              </datalist>

                                            </div>

                                      <small id="emailHelp" class="form-text text-muted">

                                        {!! $errors->first('rate', '<p class="help-block" style="color:red;">:message</p>') !!}

                                      </small>

                                    </div>

                    <!-- /.form-group -->

                          </div>


                          <div class="col-md-2">

                                    <div class="form-group">

                                      <label>

                                        Vehicle Model : 


                                      </label>

                                            <div class="input-group">

                                                <span class="input-group-addon">

                                                  <i class="fa fa-caret-right"></i>

                                                </span>

                                              <input type="text" name="vehicle_model"  id="vehicle_model" class="form-control" placeholder="Enter Trip Model" autocomplete="off" readonly="">


                                            </div>

                                      

                                    </div>

                    <!-- /.form-group -->

                          </div>
                               

                            <input type="hidden" name="route_code" id="route_code">
                            <input type="hidden" name="route_name" id="route_name">
                            
                          </div>
               <!--  <div class="row">


                    <div class="col-md-12">

                     <button type="button" class="btn btn-primary btn-sm" style="margin-top: 14px;font-size: 10px !important;float: right;" data-toggle="modal" data-target="#ratevalueModal1">Rate Calc</button>

                     </div>
                  
                </div> -->
                   <div id="requiredMsg" style="text-align: center;"></div></br>
                   <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
                 <p class="text-center">
                    <button class="btn btn-success btn-sm" type="button" id="submitdata" onclick="submitData(0)" disabled=""><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                    <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

                    <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitData(1)" disabled=""><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>

                  </p>

          </div>

         
        </div>
      </div>
    </div>
  </section>

</form>
  
<div id="myModal" class="modal fade" role="dialog" style="">
                    <div class="modal-dialog modal-lg">

                      <!-- Modal content-->
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <div class="text-center"><h4 class="modal-title" style="font-weight: 800;color: #3c8dbc;">Add New Vehical</h4></div>
                        </div>

                        <div class="modal-body">
                       
                          <div id="truckDuplicateMsg">
                           
                          </div>
                          <form action="{{ url('/form-mast-fleet-save') }}" method="post">
                            @csrf

                           <div class="row">

                             <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Owner : 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="ownerList1" class="form-control" name="owner" id="owner"  value="" placeholder="Select Owner" onchange="ownerselect(this.value);" autocomplete="off"/>

                                      <datalist id="ownerList1">
                                                              
                                        <option value="SELF" data-xyz="SELF">SELF</option>
                                        <option value="MARKET" data-xyz="MARKET">MARKET</option>

                                      </datalist>
                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('owner', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="ownerErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>

                              <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Owner Name: 

                                    <span class="required-field" id="ownerNameR"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                      <input type="text" class="form-control" name="owner_name" id="owner_name"  value="" placeholder="Owner Name" autocomplete="off"/>

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('owner_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>

                                </div>

                                <!-- /.form-group -->

                              </div>

                             <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Comp Code :<span class="required-field" id="compcodereq"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input list="compList" class="form-control" name="comp_code" id="comp_code"  value="{{ old('regd_date') }}" placeholder="Comp Code"  autocomplete="off" />

                                      <datalist id="compList">
                                      <?php foreach ($comp_list as $key) { ?>
                                        
                                        <option value="<?= $key->COMP_CODE ?>" data-xyz="<?= $key->COMP_NAME ?>"><?= $key->COMP_CODE ?> <?= " [".$key->COMP_NAME."]" ; ?></option>

                                      <?php   } ?>

                                      </datalist>
                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="comp_codeErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>

                               <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Comp Name : 

                                    <span class="required-field" id="compnamereq"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <input type="text" class="form-control" name="comp_name"  value="{{ old('regd_date') }}" placeholder="Comp Name" id="comp_name"  autocomplete="off" readonly="" />

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('comp_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="comp_nameErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>

                          </div>

                          <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                   Cost Center:

                                    <span class="required-field" id="cost_req"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-building"></i></span>

                                      <!-- <input type="text" class="form-control" name="base_location" value="{{ old('base_location') }}" placeholder="Enter Base Location"> -->


                                       <input list="depotList"  id="cost_code" name="cost_code" class="form-control  pull-left" value="{{ old('cost_code')}}" placeholder="Select Cost Code" maxlength="30" autocomplete="off">



                                      <datalist id="depotList">

                                        <option selected="selected" value="">-- Select --</option>

                                        @foreach ($cost_list as $key)

                                        

                                        <option value='<?php echo $key->COST_CODE ?>'   data-xyz ="<?php echo $key->COST_NAME; ?>" ><?php echo $key->COST_NAME; echo " [".$key->COST_CODE."]" ; ?></option>



                                        @endforeach

                                      </datalist>

                                  </div>

                                      <small id="emailHelp" class="form-text text-muted">

                                        {!! $errors->first('cost_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                                      </small>

                                       <small id="cost_codeErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Vehicle No : 

                                    <span class="required-field"></span>

                                  </label>

                                    <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                                      <input type="text" class="form-control" name="truck_no" id="truck_no" value="{{ old('truck_no') }}" placeholder="Enter Truck No" maxlength="13" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                                     

                                       <span class="input-group-addon">
                                        
                                        <div class="">
                                            <button type="button" id="login" class="btn btn-xs btn-info gly-radius" style="padding:0px 5px;font-size:3px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 9px;width: 9px;"></i></button>
                                        </div>
                                        <div id="myForm" class="hide">
                                             <div class="row">
                                                  <div class="col-md-9">
                                                    <input type="text" name="trucknoH" id="trucknoH" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                                  </div>
                                                  <div class="col-md-3" style="margin-left: -7%;">
                                                    
                                                    <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                                  </div>
                                                </div>
                                            <div id="result">
                                       
                                            <span id="errorItem"></span>

                                        </div>
                                        </div>
                                        
                                      </span>

                                       
                                    </div>

                                     <div class="custom-select">
                                        <div id="showSearchCodeList" class="custom-options" style="text-transform: uppercase;">
                                      
                                        </div>  
                                    </div>

                                      <small id="emailHelp" class="form-text text-muted">

                                        {!! $errors->first('truck_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                                      </small>
                                      <small id="truck_noErr"></small>



                                </div>

                                <!-- /.form-group -->

                              </div>

                             <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Regd Date : 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                      <input type="text" class="form-control datepicker rdate" name="regd_date" id="regd_date" value="" placeholder="Enter Regd Date" maxlength="10" autocomplete="off" />

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('regd_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="regd_dateErr"></small>


                                </div>

                                <!-- /.form-group -->

                              </div>


                                 <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Make: 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>


                                      <input list="mfgList"  id="make" name="make" class="form-control  pull-left" value="{{ old('make') }}" placeholder="Enter Make" maxlength="30" autocomplete="off">



                                      <datalist id="mfgList">

                                        <option  value="">-- Select --</option>

                                        @foreach($mfg_list as $key)

                                        
                                         
                                        <option value='<?php echo $key->MFG_CODE?>'   data-xyz ="<?php echo $key->MFG_NAME; ?>" ><?php echo $key->MFG_NAME ; echo " [".$key->MFG_CODE."]" ; ?></option>



                                        @endforeach

                                      </datalist>

                                  </div> 

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('make', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="makeErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>
                          </div>

                          <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Model: 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon"><i class="fa fa-car"></i></span>

                                      <input type="text" class="form-control" name="model" id="model" value="{{ old('model') }}" placeholder="Enter Model" maxlength="30" autocomplete="off">



                                  </div> 

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('model', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="modelErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Wheels Type : 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                        <i class="fa fa-cog" aria-hidden="true"></i>
                                      </span>

                                      <input list="wheelList"  id="wheel_type" name="wheel_type" class="form-control  pull-left" value="{{ old('wheel_type')}}" placeholder="Select Wheel Type" maxlength="4" autocomplete="off">



                                      <datalist id="wheelList">

                                        <option selected="selected" value="">-- Select --</option>

                                        @foreach ($wheel_list as $key)

                                        

                                        <option value='<?php echo $key->WHEEL_CODE?>'   data-xyz ="<?php echo $key->WHEEL_NAME; ?>" ><?php echo $key->WHEEL_NAME ; echo " [".$key->WHEEL_CODE."]" ; ?></option>



                                        @endforeach

                                      </datalist>

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('wheel_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="wheel_typeErr"></small>

                                  

                                </div>

                                <!-- /.form-group -->

                              </div>

                              <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Colour : 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <i class="fa fa-caret-right"></i>

                                      </span>

                                    <input type="text" name="colour" id="colour" class="form-control" value="{{ old('colour') }}" placeholder="Enter Colour" autocomplete="off">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('colour', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="colourErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Chasis No : 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <i class="fa fa-caret-right"></i>

                                      </span>

                                    <input type="text" name="chasis_no" id="chasis_no" class="form-control" value="{{ old('chasis_no') }}" placeholder="Enter Chasis No" autocomplete="off">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('chasis_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="chasis_noErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>

                              
                            
                          </div>

                          <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Engine No : 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <i class="fa fa-caret-right"></i>

                                      </span>

                                    <input type="text" name="engine_no" id="engine_no" class="form-control" value="{{ old('engine_no') }}" placeholder="Enter Engine No" maxlength="6" autocomplete="off">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('engine_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="engine_noErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Mfg Yr : 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <i class="fa fa-caret-right"></i>

                                      </span>

                                     <select class="form-control" id="mfg_yr" name="mfg_yr" style="padding-top: 3px;" value="">

                                      <?php 
                                      $currentDate = date("Y");
                                      for($i=$currentDate;$i>=2000;$i--){ ?>
                                       <option value="{{$i}}">{{$i}}</option>
                                      <?php } ?>
                                    </select>

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('mfg_yr', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="mfg_yrErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>
                              
                              <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Tare Weight : 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <i class="fa fa-caret-right"></i>

                                      </span>

                                     <input type="text" name="tare_weight" id="tare_weight" class="form-control" value="{{ old('tare_weight') }}" placeholder="Enter Tare Weight" autocomplete="off" oninput="funGrossWeight()">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('tare_weight', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  <small id="tare_weightErr"></small>

                                </div>

                                <!-- /.form-group -->

                              </div>
                              <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Gross Weight: 

                                    <span class="required-field"></span>

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <i class="fa fa-caret-right"></i>

                                      </span>

                                    <input type="text" name="gross_weight" id="gross_weight" class="form-control" value="{{ old('gross_weight') }}" placeholder="Enter Gross Weight" maxlength="6" autocomplete="off" oninput="funGrossWeight();">

                                  </div>

                                  <small id="grossWeiErr" style="line-height: 1.2;"></small>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('gross_weight', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  

                                </div>

                                <!-- /.form-group -->

                              </div>
                              
                            
                          </div>

                        
                          <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Load Capacity : 

                                    <!-- <span class="required-field"></span> -->

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <i class="fa fa-caret-right"></i>

                                      </span>

                                    <input type="text" name="load_capacity" id="load_capacity" class="form-control" value="0" placeholder="Enter Load Capacity" autocomplete="off" readonly="">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('load_capacity', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  
                                  </div>

                                <!-- /.form-group -->

                              </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Load Average : 

                                   <!--  <span class="required-field"></span> -->

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <i class="fa fa-caret-right"></i>

                                      </span>

                                    <input type="text" name="load_average" id="load_average" class="form-control" value="0" placeholder="Enter Load Average" autocomplete="off"  oninput="funemptyAvg()">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('load_average', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  
                                </div>

                                <!-- /.form-group -->

                              </div>

                              <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    UnderLoad Capacity : 

                                    <!-- <span class="required-field"></span> -->

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <i class="fa fa-caret-right"></i>

                                      </span>

                                    <input type="text" name="underload_capacity" id="underload_capacity" class="form-control" value="0" placeholder="Enter UnderLoad Capacity" autocomplete="off">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('underload_capacity', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>
                                  
                                </div>

                                <!-- /.form-group -->

                              </div>

                              <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    UnderLoad Average : 

                                    <!-- <span class="required-field"></span> -->

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <i class="fa fa-caret-right"></i>

                                      </span>

                                    <input type="text" name="underload_average" id="underload_average" class="form-control" value="0" placeholder="Enter Under Load Average" autocomplete="off"  oninput="funemptyAvg()">

                                  </div>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('underload_average', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>


                                </div>

                                <!-- /.form-group -->

                              </div>

                         </div>

                         <div class="row">
                            <div class="col-md-3">

                                <div class="form-group">

                                  <label>

                                    Empty Average : 

                                    <!-- <span class="required-field"></span> -->

                                  </label>

                                  <div class="input-group">

                                      <span class="input-group-addon">

                                        <i class="fa fa-caret-right"></i>

                                      </span>

                                    <input type="text" name="empty_average" id="empty_average" class="form-control" value="0" placeholder="Enter Empty Average" autocomplete="off" oninput="funemptyAvg()">

                                  </div>

                                  <small id="emptyAvgErr" style="line-height: 1.2;"></small>

                                  <small id="emailHelp" class="form-text text-muted">

                                    {!! $errors->first('empty_average', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>

                                </div>

                                <!-- /.form-group -->

                              </div>
                         </div>

                        

                          <div style="text-align: center;">

                             <button type="button" class="btn btn-primary" onclick="addVehical()">

                            <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                             </button>&nbsp;&nbsp;<button class="btn btn-warning" data-dismiss="modal">Cancel</button>

                          </div>

                        </form>
                          
                        </div>
                        <!-- <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div> -->
                      </div>

                    </div>
                  </div> 
</div>




<!-- Modal -->



<div id="advrateModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                 <center> <b> Rate Amount And Advance Amount Are Same .Are You Sure ? </b></center>

                 </div>
                <div class="modal-footer">
                  <center>
                  <button type="button" class="btn btn-secondary" id="submitbtnno">No</button>
                  <button type="button" class="btn btn-primary" id="submitbtnyes">Yes</button>
                  </center>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="allDoShow" aria-labelledby="myLargeModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg" style="margin-top: 1%;width:94%;">

            <div class="modal-content" style="border-radius: 5px;">

                <div class="modal-header removeSpaceOnModl modal-header--sticky">
                  <div style="text-align: center;">
                    <h4 class="modal-title" id="exampleModalLabel" style="font-weight: 800;color: #3c8dbc;">Do Details</h4>
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top: 9px;">
                    <small aria-hidden="true">&times;</small>
                  </button>
                </div>

                <div class="modal-body table-responsive">
                    <!-- <div class="boxer" id="itemListShow_1">

                    </div> -->

                    <table id="AccTable" class="table table-bordered table-striped table-hover" style="width:100% !important">

                    <!--  <div class="modalspinner hideloaderOnModl"></div> -->
                      <thead>

                        <tr>

                           <th class="text-center">#</th>
                           <th class="text-center">DO NUMBER</th>                              
                           <th class="text-center">INVOICE NO</th>
                           <th class="text-center">WAGON NO</th>
                           <th class="text-center">DELIVERY NO</th>
                           <th class="text-center">MATERIAL CODE</th>
                            <th class="text-center">ITEM DESC</th>
                           <th class="text-center">CP CODE /CP NAME</th>
                           <th class="text-center">SP CODE /SP NAME</th>
                           <th class="text-center">SLNO</th>
                           <th class="text-center">TO PLACE</th>
                           <th class="text-center">QTY</th>
                           <th class="text-center">CANCEL QTY</th>
                           <th class="text-center">DISPATCH QTY</th>
                           <th class="text-center">BAL QTY</th>
                           <th class="text-center">UM</th>
                           <th class="text-center">AQTY</th>
                           <th class="text-center">AUM</th>
                            <th class="text-center">EBILLNO</th>
                          
                        </tr> 
    

                      </thead>

                      <tbody>


                      </tbody>

                </table>



                </div>

                <div class="modal-footer removeSpaceOnModl modal-footer--sticky">

                  <div class="row">

                     <button class='btn  btn-sm' data-dismiss='modal' style='width: 8%;background-color:#d73925;color:#fff;'>Cancel</button>

                      <button type='button' class='btn btn-primary btn-sm' style='width: 5%;' id='ApplyOkitmbtn1' onclick='getCheckValue();'>Ok</button>
                    
                  </div>

                 

                </div>

            </div>

        </div>

      </div>


 <div id="allItemShow1" class="modal fade" tabindex="-1">

        <div class="modal-dialog modal-lg" style="margin-top: 13%;">

            <div class="modal-content" style="border-radius: 5px;">

                <div class="modal-header">

                  <div class="row">

                      <div class="col-md-12" style="text-align: center;">

                        <h5 class="modal-title modltitletext" id="exampleModalLabel">Do Details</h5>

                      </div>

                  </div>

                </div>

                <div class="modal-body table-responsive" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">
                    <div class="boxer" id="itemListShow_1">

                    </div>

                </div>

                <div class="modal-footer" style="text-align: center;" id="footer_item_1">

                </div>

            </div>

        </div>

      </div>


<div id="vehiclemsgModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                 

                 <small id="vehiclemsg"></small>

                 </div>
                <div class="modal-footer">
                  <center>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Yes</button>
                  </center>
                </div>
            </div>
        </div>
    </div>

<div id="vehicleCpctmsgModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                 

                 <small id="vehicleCpctmsg"></small>

                 </div>
                <div class="modal-footer">
                  <center>
                  
                  <button type="button" class="btn btn-primary" data-dismiss="modal">ok</button>
                  </center>
                </div>
            </div>
        </div>
    </div>

    <div id="vehicleErrmsgModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 80%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                 

                <div style="text-align:center;"> <small id="vehicleErrmsg"></small></div>

                 </div>
                <div class="modal-footer">
                  <center>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                  
                  </center>
                </div>
            </div>
        </div>
    </div>

    <div id="doNotmsgModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                 <div class="modal-body">
         
                 <center> <b> DO Data Not Avilable For This Customer ? </b></center>

                 </div>
                <div class="modal-footer">
                  <center>
                <!--   <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> -->
                  <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                  </center>
                </div>
            </div>
        </div>
    </div>

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

         var account_code =  $("#account_code").val();

        if(series_code==''){
        
           $('#series_code').css('border-color','#d2d6de');
        
           $('#series_code').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else{

            $('#account_code').prop('readonly',false);

             $('#series_code').css('border-color','#d2d6de');

            $('#account_code').css('border-color','#d2d6de');
        
            $('#account_code').css('border-color','#ff0000').focus();
           }

    });

  function funGrossWeight(){

   var tareWeight = $('#tare_weight').val();
   var grossWeight = $('#gross_weight').val();
   if(tareWeight == ''){

    $('#grossWeiErr').html('*Please Enter Tare weight').css('color','red');
    $('#gross_weight').val('');
     return false;
   }else{
    $('#grossWeiErr').html('');
   }

   if(parseInt(tareWeight) != '' || parseInt(grossWeight) == '' ){
    $('#load_capacity').val('0');
   }
  
  if(parseInt(grossWeight) <= parseInt(tareWeight)){

     $('#grossWeiErr').html('*Please Enter Gross weight greater than Tare weight').css('color','red');
     $('#load_capacity').val('0');
     return false;

   }else{
     
     $loadCapacity = parseInt(grossWeight) - parseInt(tareWeight);

     $('#grossWeiErr').html('');
     $('#load_capacity').val($loadCapacity);
     
   }

  }

  function fununderload_cap(){

    var load_cap = $('#load_capacity').val();
    var underLoad_cap = $('#underload_capacity').val();

    if(parseInt(underLoad_cap) >= parseInt(load_cap)){

      $('#underload_capErr').html('*Please Enter Underload Capacity is less than Load Capacity').css('color','red');
      return false;
    }else{
      $('#underload_capErr').html('');

    }

  }

  function funemptyAvg(){
    console.log('avg');

    var loadAvg = $('#load_average').val();
    var underloadAvg = $('#underload_average').val();
    var emptyAvg = $('#empty_average').val();

    if(parseInt(emptyAvg) < parseInt(loadAvg) || parseInt(emptyAvg) < parseInt(underloadAvg)){
      console.log('true');
       $('#emptyAvgErr').html('Plase Enter Empty Average is Greater than load Average and Usnderload Average').css('color','red');
       return false;
    }else{
       $('#emptyAvgErr').html('');
    }

  }

  function ownerselect(val){

    if(val=='MARKET'){

      $("#compcodereq").hide();
      $("#compnamereq").hide();
      $("#cost_req").hide();

    }else{
      $("#compcodereq").show();
      $("#compnamereq").show();
      $("#cost_req").show();
      $("#ownerNameR").show();
    }



  }

function toPlaceWDo(num){

    var toPlace_do = $("#to_place_wdo"+num).val();

      if(toPlace_do){

        $("#head_toplace").val(toPlace_do);
      }else{

         $("#head_toplace").val('');
      }



}

function toPlaceW(num){

    var toPlace = $("#to_place"+num).val();

      if(toPlace){

        $("#head_toplace").val(toPlace);
      }else{

         $("#head_toplace").val('');
      }



}

$("#vehicle_owner").bind('change', function () {

  var VehicleOwner =  $(this).val();

  var Vehicle_No =  $("#vehicle_no").val();

 

  if(VehicleOwner){

    if(VehicleOwner=='DUMP' || VehicleOwner=='SELF'){

    $("#transporter_code,#transporter_name,#fright_order,#rate,#amount,#payment_mode,#adv_type,#adv_rate").prop('readonly',true);

    $("#submitdata").prop("disabled",false);

    }else{

      //$("#transporter_code").prop('readonly',false);

      $("#submitdata").prop("disabled",true);
    }

  }else{
    $("#submitdata").prop('disabled',true);
  }

  



});

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
      $('#series_code').css('border-color','#d2d6de');
        
    $('#series_code').css('border-color','#ff0000').focus();

      $("#account_code").prop('readonly',true);
      $("#custCode1").prop('readonly',true);
  }else{
    $('#seriesName').val(msg);
     document.getElementById("series_code_errr").innerHTML = '';
     var sers_code = $('#series_code').val();
     $('#getSeriesCode').val(sers_code);
     $('#getSeriesName').val(msg);
     $('#series_code').css('border-color','#d2d6de');

     $("#account_code").prop('readonly',false);
     $("#custCode1").prop('readonly',false);
       
  }

   //objvalidtn.checkBlankFieldValidation();

});

  function addFunAdvRate(){
    

     var adv_type = $('#adv_type').val();
     var adv_rate = $('#adv_rate').val();
     var adv_amount = $('#adv_amount').val();

     if(adv_type){

      $('#advtype').val(adv_type);

     }
     if(adv_rate){
      $('#advrate').val(adv_rate);

     }
     if(adv_amount){
       $('#advAmount').val(adv_amount);

     }else{

     }
    $("#ratevalueModal").modal('hide');
  }

  function addVehical(){

    var owner              = $('#owner').val();
    var load_capacity      = $('#load_capacity').val();
    var load_average       = $('#load_average').val();
    var underload_capacity = $('#underload_capacity').val();
    var underload_average  = $('#underload_average').val();
    var empty_average      = $('#empty_average').val();

    if(owner == ''){
      $('#ownerErr').html('Owner Field is required').css('color','red');
      return false;
    }else{
       $('#ownerErr').html('');
    }

    if(owner == 'MARKET'){

      var truck_no     = $('#truck_no').val();
      var regd_date    = $('#regd_date').val();
      var make         = $('#make').val();
      var model        = $('#model').val();
      var wheel_type   = $('#wheel_type').val();
      var colour       = $('#colour').val();
      var chasis_no    = $('#chasis_no').val();
      var engine_no    = $('#engine_no').val();
      var mfg_yr       = $('#mfg_yr').val();
      var tare_weight  = $('#tare_weight').val();
      var gross_weight = $('#gross_weight').val();
      var comp_code    = $('#comp_code').val();
      var comp_name    = $('#comp_name').val();
      var cost_code    = $('#cost_code').val();

      if(truck_no == ''){
        $('#truck_noErr').html('truck no field is required').css('color','red');
        return false;
      }else{
         $('#truck_noErr').html('');
      }

      if(regd_date == ''){
        $('#regd_dateErr').html('regd date Field is required').css('color','red');
        return false;
      }else{
         $('#regd_dateErr').html('');
      }

      if(make == ''){
        $('#makeErr').html('make Field is required').css('color','red');
        return false;
      }else{
         $('#makeErr').html('');
      }

      if(model == ''){
        $('#modelErr').html('model Field is required').css('color','red');
        return false;
      }else{
         $('#modelErr').html('');
      }

      if(wheel_type == ''){
        $('#wheel_typeErr').html('wheel type Field is required').css('color','red');
        return false;
      }else{
         $('#wheel_typeErr').html('');
      }

      if(colour == ''){
        $('#colourErr').html('colour Field is required').css('color','red');
        return false;
      }else{
         $('#colourErr').html('');
      }

      if(chasis_no == ''){
        $('#chasis_noErr').html('chasis no Field is required').css('color','red');
        return false;
      }else{
         $('#chasis_noErr').html('');
      }

      if(engine_no == ''){
        $('#engine_noErr').html('engine no Field is required').css('color','red');
        return false;
      }else{
         $('#engine_noErr').html('');
      }

      if(mfg_yr == ''){
        $('#mfg_yrErr').html('mfg yr Field is required').css('color','red');
        return false;
      }else{
         $('#mfg_yrErr').html('');
      }

      if(tare_weight == ''){
        $('#tare_weightErr').html('tare weight Field is required').css('color','red');
        return false;
      }else{
         $('#tare_weightErr').html('');
      }

      if(gross_weight == ''){
        $('#gross_weightErr').html('Gross weight is required').css('color','red');
        return false;
      }else{
         $('#gross_weightErr').html('');


        $.ajaxSetup({

              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }

        });

        $.ajax({

              url:"{{ url('form-mast-fleet-save') }}",

               method : "POST",

               type: "JSON",

               data: {owner:owner,comp_code:comp_code,comp_name:comp_name,cost_code:cost_code,truck_no:truck_no,regd_date:regd_date,make:make,model:model,wheel_type:wheel_type,colour:colour,chasis_no:chasis_no,engine_no:engine_no,mfg_yr:mfg_yr,tare_weight:tare_weight,gross_weight:gross_weight,load_capacity:load_capacity,load_average:load_average,underload_capacity:underload_capacity,underload_average:underload_average,empty_average:empty_average},

               success:function(data){

                    var data1 = JSON.parse(data);
                    console.log('data1.response',data1.response);

                    if (data1.response == "duplicate") {
                      
                      $('#truckDuplicateMsg').html('<div class="alert alert-error alert-dismissible" style="width: 100%;margin-bottom: 1%;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4> <i class="icon fa fa-check"></i>Error...!</h4>Duplicate Fleet Can Not Added...!</div>');
                      
                       
                    }else if(data1.response == 'success'){

                         $("#myModal").modal('hide');

                         // var truckNo = data1.data->TRUCK_NO;
                         console.log(data1.data,'DATA');
                         var truckNo = data1.data['TRUCK_NO'];

                         $('#vehicle_no').val(truckNo);
                         // $('#vehicleList').append('<option>', { value : truckNo });

                          $("#vehicleList").append($('<option>',{

                          value:truckNo,

                          

                        }));
                          
                    }
               }

            });


      }



    }else{

      var comp_code    = $('#comp_code').val();
      var comp_name    = $('#comp_name').val();
      var cost_code    = $('#cost_code').val();
      var truck_no     = $('#truck_no').val();
      var regd_date    = $('#regd_date').val();
      var make         = $('#make').val();
      var model        = $('#model').val();
      var wheel_type   = $('#wheel_type').val();
      var colour       = $('#colour').val();
      var chasis_no    = $('#chasis_no').val();
      var engine_no    = $('#engine_no').val();
      var mfg_yr       = $('#mfg_yr').val();
      var tare_weight  = $('#tare_weight').val();
      var gross_weight = $('#gross_weight').val();

      if(comp_code == ''){
      $('#comp_codeErr').html('comp code Field is required').css('color','red');
      return false;
      }else{
         $('#comp_codeErr').html('');
      }

      if(comp_name == ''){
        $('#comp_nameErr').html('comp name Field is required').css('color','red');
        return false;
      }else{
         $('#comp_nameErr').html('');
      }

      if(cost_code == ''){
        $('#cost_codeErr').html('cost code Field is required').css('color','red');
        return false;
      }else{
         $('#cost_codeErr').html('');
      }

      if(truck_no == ''){
        $('#truck_noErr').html('truck no field is required').css('color','red');
        return false;
      }else{
         $('#truck_noErr').html('');
      }

      if(regd_date == ''){
        $('#regd_dateErr').html('regd date Field is required').css('color','red');
        return false;
      }else{
         $('#regd_dateErr').html('');
      }

      if(make == ''){
        $('#makeErr').html('make Field is required').css('color','red');
        return false;
      }else{
         $('#makeErr').html('');
      }

      if(model == ''){
        $('#modelErr').html('model Field is required').css('color','red');
        return false;
      }else{
         $('#modelErr').html('');
      }

      if(wheel_type == ''){
        $('#wheel_typeErr').html('wheel type Field is required').css('color','red');
        return false;
      }else{
         $('#wheel_typeErr').html('');
      }

      if(colour == ''){
        $('#colourErr').html('colour Field is required').css('color','red');
        return false;
      }else{
         $('#colourErr').html('');
      }

      if(chasis_no == ''){
        $('#chasis_noErr').html('chasis no Field is required').css('color','red');
        return false;
      }else{
         $('#chasis_noErr').html('');
      }

      if(engine_no == ''){
        $('#engine_noErr').html('engine no Field is required').css('color','red');
        return false;
      }else{
         $('#engine_noErr').html('');
      }

      if(mfg_yr == ''){
        $('#mfg_yrErr').html('mfg yr Field is required').css('color','red');
        return false;
      }else{
         $('#mfg_yrErr').html('');
      }

      if(tare_weight == ''){
        $('#tare_weightErr').html('tare weight Field is required').css('color','red');
        return false;
      }else{
         $('#tare_weightErr').html('');
      }

      if(gross_weight == ''){
        $('#gross_weightErr').html('Gross weight is required').css('color','red');
        return false;
      }else{
         $('#gross_weightErr').html('');


        $.ajaxSetup({

              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }

        });

        $.ajax({

              url:"{{ url('form-mast-fleet-save') }}",

               method : "POST",

               type: "JSON",

               data: {owner:owner,comp_code:comp_code,comp_name:comp_name,cost_code:cost_code,truck_no:truck_no,regd_date:regd_date,make:make,model:model,wheel_type:wheel_type,colour:colour,chasis_no:chasis_no,engine_no:engine_no,mfg_yr:mfg_yr,tare_weight:tare_weight,gross_weight:gross_weight,load_capacity:load_capacity,load_average:load_average,underload_capacity:underload_capacity,underload_average:underload_average,empty_average:empty_average},

               success:function(data){

                    var data1 = JSON.parse(data);

                    if (data1.response == 'duplicate') {

                        $('#truckDuplicateMsg').html('<div class="alert alert-error alert-dismissible" style="width: 100%;margin-bottom: 2%;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4> <i class="icon fa fa-check"></i>Error...!</h4>Can not save duplicate Truck No...!</div>');
                      
                       
                    }else if(data1.response == 'success'){

                          $("#myModal").modal('hide');
                          
                    }
               }

            });


      }

  }
    

    

   



  }

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
                           $('#showSearchCodeList').append('<small class="custom-option">'+
                            objcity.truck_no+'</small><br>');
                         });
                        
                  }
             }

          });
       }

    });

    $("body").click(function() {
        $("#showSearchCodeList").hide("fast");
    });


    $("#submitbtnno").on('click', function() {

      $('#advrateModal').modal('toggle');
      $('#submitdata').prop('disabled',true);

    });

     $("#submitbtnyes").on('click', function() {

      $('#advrateModal').modal('toggle');
      $('#submitdata').prop('disabled',false);

    });
    

  });


</script>

<script type="text/javascript">
  
  $("#route_code").bind('change', function () {
  var val =  $(this).val();
  var xyz = $('#routeList option').filter(function() {

    return this.value == val;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';


  if(msg=='No Match'){
     $(this).val('');
    
      $('#route_name').val('');
  }else{
   
     $('#route_name').val(msg);
     $('#getRouteCode').val(val);
     $('#getRouteName').val(msg);
  }

});
</script>


<script type="text/javascript">
  
   function getRouteLocation() {
    
    var route_code = $("#route_code").val();

    if(route_code){

      $("#dono1").prop('readonly',false);

    }else{

      $("#dono1").prop('readonly',true);

    }

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });


      $.ajax({

            url:"{{ url('get-route-for-plan-by-route-code') }}",

            method : "POST",

            type: "JSON",

            data: {route_code: route_code},

            success:function(data){

              //console.log(data);

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);

                    $("#route_name").val(data1.data.ROUTE_NAME);
                    $("#from_place").val(data1.data.FROM_PLACE);
                    $("#to_place").val(data1.data.TO_PLACE);
                    $("#trip_day").val(data1.data.TRIP_DAYS);
                    $("#off_days").val(data1.data.HOLIDAYS);
                  


                }

            }

          });



  }
</script>

<script type="text/javascript">
  $("#Plant_code").bind('change', function () {
  var Plantcode =  $(this).val();
  var xyz = $('#PlantcodeList option').filter(function() {

    return this.value == Plantcode;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

   $('#appndplantbtn').empty();
    $('#planticon').show();

  if(msg=='No Match'){
     $(this).val('');
     $('#plantname').val(''); 
      document.getElementById("plant_err").innerHTML = 'The Plant code field is required.';
     
      $('#getPlantCode').val('');
      $('#profitctrId').val('');
      $('#pfctName').val('');
  }else{
     document.getElementById("plant_err").innerHTML = '';
     $('#plantname').val(msg);
     var plntCode = $('#Plant_code').val();

     $('#account_code').prop('readonly',false);
     //alert(msg);
     $('#getPlantCode').val(plntCode);
     $('#getPlantName').val(msg);
     $('#planticon').hide();

     $('#appndplantbtn').append('<button type="button"  data-toggle="modal" data-target="#plant_detail" onclick="requisition.getplantdata(Plantdetailsurl)" class="btn btn-xs btn-info gly-radius" data-original-title="" title="" style="padding: 0px 5px 0px 5px;"> <i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i></button>');
    
  }
  
   //objvalidtn.checkBlankFieldValidation();

});
</script>

<script type="text/javascript">
  function getfsoRate(){

      var vehicle_no = $("#vehicle_no").val();
      var vr_date    = $("#vr_date").val();
      var account_code    = $("#account_code").val();
      var plant_code    = $("#Plant_code").val();
      var vehicle_type    = $("#vehicle_type").val();
      var vehicleType_name    = $("#vehicleType_name").val();
      var toplace    = $("#head_toplace").val();

      var vehicle_owner    = $("#vehicle_owner").val();

      console.log('vehicle_type',vehicle_type);

      console.log('vehicleType_name',vehicleType_name);

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });


      $.ajax({

          url:"{{ url('get-fso_rate-by-trip') }}",

          method : "POST",

          type: "JSON",

          data: {vehicle_no: vehicle_no,vehicle_type:vehicle_type,vr_date:vr_date,account_code:account_code,plant_code:plant_code,toplace:toplace,vehicle_owner:vehicle_owner},

          success:function(data){

            console.log(data);

            var data1 = JSON.parse(data);

       
              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                   console.log(data1.data);


                  if(data1.data=='' || data1.data==null){

                      $("#sale_rate").val('0.00');
                      $("#fsohid").val('0.00');
                      $("#fsobid").val('0.00');
                      $("#refNo").val('');
                   }else{
                     // alert(data1.data[0].RATE);
                      $("#sale_rate").val(data1.data[0].RATE);
                      $("#fsohid").val(data1.data[0].FSOHID);
                      $("#fsobid").val(data1.data[0].FSOBID);
                      $("#refNo").val(data1.data[0].REF_NO);
                   }

                   console.log('length',data1.vehicle_data.length);

                   var dataCount = data1.vehicle_data.length;

                   if(data1.vehicle_data=='' || data1.vehicle_data==null){

                    $("#whee_type_code").val('');
                    $("#whee_type_name").val('');
                    $("#min_gurrentee").val('');

                  }else{

                    if(dataCount > 1){

                        console.log('vehicle_data',data1.vehicle_data);

                     $("#wheelTypeList").empty();

                      $.each(data1.vehicle_data, function(k, getData){


                        $("#wheelTypeList").append($('<option>',{

                          value:getData.WHEEL_NAME,

                          'data-xyz':getData.WHEEL_NAME,
                          text:getData.WHEEL_NAME


                        }));

                      })

                    }else{

                      $("#whee_type_code").val(data1.vehicle_data[0].WHEEL_TYPE);
                      $("#whee_type_name").val(data1.vehicle_data[0].WHEEL_TYPE_NAME);
                      $("#min_gurrentee").val(data1.vehicle_data[0].MIN_GUARANTEE);

                      }

                    

                  }

              }

          }

    });



  }
</script>




<script type="text/javascript">
  
  function getvehicleOwner(){

  var vehicle_no = $("#vehicle_no").val();
  var vr_date    = $("#vr_date").val();
  var account_code    = $("#account_code").val();
  var plant_code    = $("#Plant_code").val();
  var from_place = $("#from_place").val();
  var to_place   = $("#head_toplace").val();
  var basicTotal = $("#basicTotal").val();


 

 // var getLength = $("#vehicle_no").attr('maxlength','4');
  var maxlength = vehicle_no.length;




if(maxlength >= '8'){


 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-vehicle-owner-by-vehicle') }}",

          method : "POST",

          type: "JSON",

          data: {vehicle_no: vehicle_no,from_place:from_place,to_place:to_place,vr_date:vr_date,account_code:account_code,plant_code:plant_code},

           beforeSend: function() {
              // console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                $('.modalspinner').addClass('hideloaderOnModl');

                 var owner = new Array();
                    owner[0] = 'MARKET';
                    
                    var options = '';


                    for (var i = 0; i < owner.length; i++) {
                      options += '<option value="' + owner[i] + '" />';
                    }

                    document.getElementById('ownerList').innerHTML = options;
               
              }else if(data1.response == 'success'){

                  /* if(data1.fso_rate=='' || data1.fso_rate==null){

                      $("#sale_rate").val('0.00');
                      $("#fsohid").val('');
                      $("#fsobid").val('');
                   }else{

                      $("#sale_rate").val(data1.fso_rate[0].RATE);
                       $("#fsohid").val(data1.fso_rate[0].FSOHID);
                      $("#fsobid").val(data1.fso_rate[0].FSOBID);
                   }*/

                   if(data1.transporter_data=='' || data1.transporter_data==null){

                       $("#transporter_code").val('');
                      $("#transporter_name").val('');
                   }else{

                      $("#transporter_code").val(data1.transporter_data[0].ACC_CODE);
                      $("#transporter_name").val(data1.transporter_data[0].ACC_NAME);
                   }

                  if(data1.data=='' || data1.data==null){

                    $('.modalspinner').addClass('hideloaderOnModl');
                   
                    var owner = new Array();
                    owner[0] = 'MARKET';
                  
                    var options = '';

                    for (var i = 0; i < owner.length; i++) {
                      options += '<option value="' + owner[i] + '" />';
                    }

                    document.getElementById('ownerList').innerHTML = options;

                    $("#submitdata").prop('disabled',true);

                  }else{

                    

                  var vehicle_owner = data1.data.OWNER;
                  var vehicle_type = data1.data.FREIGHTTYPE_NAME;
                  var trip_model = data1.data.MODEL;
                  
                  
                  $("#vehicle_owner").val(vehicle_owner);
                  $("#vehicle_model").val(trip_model);
                  //$("#vehicle_type").val(vehicle_type);
                

                     
                  if(vehicle_owner=='SELF'){

                    

                    var owner = new Array();
                    owner[0] = 'SELF';
                    owner[1] = 'DUMP';

                    var options = '';


                    for (var i = 0; i < owner.length; i++) {
                      options += '<option value="' + owner[i] + '" />';
                    }

                    document.getElementById('ownerList').innerHTML = options;

                     $("#transporter_code,#transporter_name,#fright_order,#rate,#amount,#payment_mode,#adv_type,#adv_rate,#adv_amount,#freight_qty,#whee_type_name,#min_gurrentee,#vehicleType_name,#whee_type_code").prop('readonly',true);

                     $("#freight_qty").prop('readonly',false);
                     $("#freight_qty").val(basicTotal);
                     $("#submitdata").prop('disabled',false);
                     $("#submitdatapdf").prop('disabled',false);

                  }else{
                  
                      $("#submitdata").prop('disabled',true);
                      $("#submitdatapdf").prop('disabled',true);

                  }
                  
                  var registraion_date = data1.data.REGD_DATE;
                  
                }

               if(data1.last_trip_data=='' || data1.last_trip_data==null){

                        $("#vehicle_owner").val('');
                        $("#vehicle_type").val('');
                        $("#whee_type_name").val('');
                        $("#min_gurrentee").val('');
                       /* $("#transporter_code").val('');
                        $("#transporter_name").val('');*/
                       

                        $("#transporter_code,#transporter_name,#fright_order,#rate,#amount,#payment_mode,#adv_type,#adv_rate").prop('readonly',true);
                }else{

                      
                        $("#vehicle_owner").val(data1.last_trip_data[0].OWNER);
                        $("#vehicle_type").val(data1.last_trip_data[0].VEHICLE_TYPE);
                        $("#whee_type_name").val(data1.last_trip_data[0].WHEELTYPE_NAME);
                        $("#min_gurrentee").val(data1.last_trip_data[0].MIN_GUARANTEE);
                        $("#transporter_code").val(data1.last_trip_data[0].TRANSPORT_CODE);
                        $("#transporter_name").val(data1.last_trip_data[0].TRANSPORT_NAME);
                        $("#freight_qty").val(basicTotal);

                      $("#transporter_code,#transporter_name,#fright_order,#rate,#amount,#payment_mode,#adv_type,#adv_rate").prop('readonly',false);
                       
                       
               }

              if(data1.route_data=='' || data1.route_data==null){

                    $('.modalspinner').addClass('hideloaderOnModl');
                    $("#route_code").val('');
                    $("#route_name").val('');

                  }else{

                  var route_code = data1.route_data.ROUTE_CODE;

                  var route_name = data1.route_data.ROUTE_NAME;

                  $("#route_code").val(route_code);
                  $("#route_name").val(route_name);
              }


            /*  if(data1.vehicle_trip=='' || data1.vehicle_trip==null){

                }else{

                  var lr_status = data1.vehicle_trip.EPOD_STATUS;

                    if(lr_status==0){

                      $("#vehicle_no").val('');
                      $("#vehicle_owner").val('');
               
                       $("#vehicleErrmsgModal").modal('show');

                     $("#vehicleErrmsg").html('<b>DUBLICATE TRIP CAN NOT CREATE FOR THIS VEHICLE </b>');

                     $("#submitData").prop('disabled',true);
                   
                    }else{
                      $("#submitData").prop('disabled',false);
                      $("#vehicleErrDubmsg").html('');

                    }

                }*/
                   //console.log('vehicle_info',data1.vehicle_info.response);
              if(data1.vehicle_info.response == null){
              
                     $("#vehicleErr1msg").html('<b>Api Not Responded,Vehicle May Not Be Found</b>');
                      //$("#submitdata").prop('disabled',false);
                    
              }else{

              
                     var regd_date = data1.vehicle_info.response.regnDate;
                 
                     var cuurnt_date = new Date().toLocaleDateString('fr-CA');


                      var explode1 =   cuurnt_date.split("-");

                      var year1 = explode1[0];

                    ///  console.log('year1',year1);

                       var explode2 =   regd_date.split("/");

                      var year2 = explode2[2];

                       //console.log('year2',year2);

                       var diff_date = year1 - year2;
                            
                      // console.log('diff_date',diff_date);

                       if(diff_date > 10){

                          $("#vehiclemsgModal").modal('show');

                          $("#vehiclemsg").html('<b>Vehicle Is More Than 10 Years Old.Are Sure To Proceed ?</b>');
                       }


                      
                      var gross_weight = data1.vehicle_info.response.gvw;

                      var underload_weight = data1.vehicle_info.response.unldWt;


                      var capct = parseFloat(gross_weight) - parseFloat(underload_weight);

                      var total = parseFloat(capct / 1000);

                      var calculatPercnt = parseFloat(total * 5/100);

                      var fianlValue = calculatPercnt + total;


                     if(fianlValue < basicTotal){

                      $("#vehicleCpctmsgModal").modal('show');

                      $("#vehicleCpctmsg").html('<b>Total Qty Is Greater than Vehicle Capacity </b>');

                      //$("#submitdata").prop('disabled',false);

                    }else{
                     // $("#submitdata").prop('disabled',true);
                    }


              }

            }

          },

           complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },

    });

}

}
</script>

<script type="text/javascript">

  $(".delete").on('click', function() {


      var rowCount = $('#tbledata tr').length;



        var whenitmselect = $('#dubindicatoraddmore').val();
        var splt_arrayOne = whenitmselect.split(',');
        var whenitmcheck = $('#dublicateName').val();
        var splt_arrayTwo = whenitmcheck.split(',');


        splt_arrayOne = splt_arrayOne.filter(function(val) {
            return splt_arrayTwo.indexOf(val) == -1;
        });
         
        splt_arrayTwo = splt_arrayTwo.filter(val => !splt_arrayTwo.includes(val));
        $('#dubindicatoraddmore').val(splt_arrayOne);

        splt_arrayTwo = splt_arrayTwo.filter(function(val) {
            return splt_arrayOne.indexOf(val) == -1;
        });
         
        splt_arrayOne = splt_arrayOne.filter(val => !splt_arrayOne.includes(val));
        $('#dublicateName').val(splt_arrayOne);
      
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


    

    // alert(testval);

      count=$('#tbledata tr').length;

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> </td>";

      data +="<td class='tdthtablebordr withDo' style='width: 10%;'><input list='custList"+i+"' class='inputboxclr getAccNAme inputwidth'  name='custCode[]' id='custCode"+i+"'   placeholder='Customer Code' onchange='getRowDoDetailsByCust("+i+")'  autocomplete='off'><datalist id='custList"+i+"'>@foreach ($getacc as $key)<option value='<?php echo $key->ACC_CODE?>'  data-xyz='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo '['.$key->ACC_CODE.']'; ?></option>@endforeach</datalist></td><td class='tdthtablebordr withDo' style='width: 10%;'><input type='text' class='inputboxclr getAccNAme inputwidth'  name='custName[]' id='custName"+i+"'   placeholder='Customer Name'  autocomplete='off'></td><td class='tdthtablebordr withoutDo' style='width: 10%;'><input list='custwdoList"+i+"' class='inputboxclr getAccNAme inputwidth'  name='custwdoCode[]' id='custwdoCode"+i+"'   placeholder='Customer Code' onchange='getRowDoDetailsByCust("+i+")'  autocomplete='off'><datalist id='custwdoList"+i+"'>@foreach ($getacc as $key)<option value='<?php echo $key->ACC_CODE?>'  data-xyz='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo '['.$key->ACC_CODE.']'; ?></option>@endforeach</datalist></td><td class='tdthtablebordr withoutDo' style='width: 10%;'><input type='text' class='inputboxclr getAccNAme inputwidth'  name='custwdoName[]' id='custwdoName"+i+"'   placeholder='Customer Name'  autocomplete='off' readonly=''></td><td class='tdthtablebordr tooltips doorderNo' id='dono_hide"+i+"' style='width: 10%;'><input list='deliveryList"+i+"' class='inputboxclr getAccNAme'  name='do_no[]' id='do_no"+i+"'  value='' placeholder='Select Do No' onchange='getDoDetials("+i+")' autocomplete='off'><datalist id='deliveryList"+i+"'></datalist><input type='hidden' name='delorder_date[]' id='delorder_date"+i+"'><input type='hidden' name='slnodo[]' id='slnodo"+i+"'></td>"+
          "<td class='tdthtablebordr withoutDo' style='width: 20%;'><input list='ConsineeList_wdo"+i+"' class='inputboxclr  inputwidth'  id='consignee_wdo"+i+"' name='consignee_wdo[]' placeholder='Consinee Code'  onchange='consigneeName("+i+")'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><datalist id='ConsineeList_wdo"+i+"'>@foreach ($getconsinee as $key)<option value='<?php echo $key->ACC_CODE?>'  data-xyz='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo '['.$key->ACC_CODE.']'; ?></option>@endforeach</datalist><div style='margin-top:2px;'><input type='text' class='inputboxclr inputwidth' name='consineeName_wdo[]' id='consineeName_wdo"+i+"' autocomplete='off' readonly placeholder='Consinee Name'><input type='hidden' class='inputboxclr inputwidth' name='consineeAdd[]' id='consineeAdd"+i+"' autocomplete='off' readonly placeholder='Consinee Add'><input type='hidden' class='inputboxclr inputwidth' name='region[]' id='region"+i+"' autocomplete='off' readonly placeholder='region'></div></td>"+
          "<td class='tdthtablebordr withoutDo' style='width: 25px;'><div class='input-group'><input list='ConsineeAddList"+i+"' class='inputboxclr' style='width:139px;' id='consigneeadd"+i+"' name='consigneeadd[]' onchange='getcityName("+i+")'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><datalist id='ConsineeAddList"+i+"'></datalist><input type='hidden' name='cp_address[]' id='cp_address"+i+"'></div></td>"+
          "<td class='tdthtablebordr tooltips withoutDo'><input list='toplaceList_wdo"+i+"' class='inputboxclr inputwidth'  id='to_place_wdo"+i+"' name='to_place_wdo[]' onchange='toPlaceWDo("+i+");'  autocomplete='off' oninput='this.value = this.value.toUpperCase()'  placeholder='Select To Place'/><datalist id='toplaceList_wdo"+i+"'></datalist></td>"+
          "<td class='tdthtablebordr'><div class='input-group'><input list='ItemList"+i+"' class='inputboxclr' id='ItemCodeId"+i+"' placeholder='Enter Item Code' name='item_code[]' onchange='getItemQty("+i+");' oninput='this.value = this.value.toUpperCase()' readonly autocomplete='off' placeholder='Select Item Code'/><datalist id='ItemList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($item_list as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option>@endforeach</datalist></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+i+"' data-toggle='modal' data-target='#view_detail"+i+"' onclick='showItemDetail("+i+")'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i></button><input type='hidden' name='stockavlblevalue' id='stockavlblevalue"+i+"'><input type='hidden' name='scrab_code[]' id='scrab_code"+i+"'></td>"+
          "<td class='tdthtablebordr tooltips'><input type='text' class='inputboxclr getAccNAme' id='Item_Name_id"+i+"' name='item_name[]' placeholder='Enter Item Name' readonly /><input type='hidden' class='inputboxclr inputwidth' id='aliseItem_code"+i+"' name='alise_item_code[]' placeholder='Enter Item Name' readonly /><input type='hidden' class='inputboxclr inputwidth' id='aliseItem_Name"+i+"' name='alise_item_name[]' placeholder='Enter Item Name' readonly /></br><textarea id='remark"+i+"' rows='1'  class='' name='remark[]' placeholder='Enter Description' ></textarea><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></small><input type='hidden' name='do_qty[]' id='do_qty"+i+"'><div><p id='batchno"+i+"' class='badge' style='background-color:#25b6bd;'></p></div><input type='hidden' name='batch_no[]' id='batch_no"+i+"'></td>"+
          "<td class='tdthtablebordr withDo' style='width: 15%;'><input list='ConsineeList"+i+"' class='inputboxclr  inputwidth'  id='consignee"+i+"' name='consignee[]' readonly placeholder='Consinee Code'  onchange='consigneeName("+i+")'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><datalist id='ConsineeList"+i+"'>@foreach ($getacc as $key)<option value='<?php echo $key->ACC_CODE?>'  data-xyz='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo '['.$key->ACC_CODE.']'; ?></option>@endforeach</datalist><div style='margin-top:2px;'><input type='text' class='inputboxclr inputwidth' name='consineeName[]' id='consineeName"+i+"' autocomplete='off' readonly placeholder='Consinee Name'><input type='hidden' class='inputboxclr inputwidth' name='consineeAdd[]' id='consineeAdd"+i+"' autocomplete='off' readonly placeholder='Consinee Add'><input type='hidden' class='inputboxclr inputwidth' name='region[]' id='region"+i+"' autocomplete='off' readonly placeholder='region'><input type='hidden' class='inputboxclr inputwidth' name='acatgory_code[]' id='acatgory_code"+i+"' autocomplete='off' readonly placeholder='Consinee Name'><input type='hidden' class='inputboxclr inputwidth' name='rcomp_code[]' id='rcomp_code"+i+"' autocomplete='off' readonly placeholder='Consinee Name'><input type='hidden' class='inputboxclr inputwidth' name='rcomp_name[]' id='rcomp_name"+i+"' autocomplete='off' readonly placeholder='Consinee Name'></div></td>"+
          "<td class='tdthtablebordr withDo' style='width: 10%;'><input list='SpList"+i+"' class='inputboxclr  inputwidth'  id='sp_code"+i+"' name='sp_code[]' placeholder='Sp Code'  onchange='getspName("+i+")'  readonly oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><datalist id='SpList"+i+"'>@foreach ($getconsinee as $key)<option value='<?php echo $key->ACC_CODE?>'  data-xyz='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo '['.$key->ACC_CODE.']'; ?></option>@endforeach</datalist><div style='margin-top:2px;'><input type='text' class='inputboxclr inputwidth' name='spName[]' id='spName"+i+"' autocomplete='off' readonly placeholder='Sp Name'><input type='hidden' class='inputboxclr inputwidth' name='ewaybill_no[]' id='ewaybill_no"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='ewaybill_dt[]' id='ewaybill_dt"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='Invc_dt[]' id='Invc_dt"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='wagon_no[]' id='wagon_no"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='do_headId[]' id='do_headId"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='do_bodyId[]' id='do_bodyId"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='delivery_no[]' id='delivery_no"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='gross_wt[]' id='gross_wt"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='do_batch_no[]' id='do_batch_no"+i+"' autocomplete='off' readonly></div></td>"+
          "<td class='tdthtablebordr withDo' style='width: 15%;'><input type='text' class='inputboxclr  inputwidth rightcontent'  id='item_slno"+i+"' style='width: 70px;' name='item_slno[]' placeholder='Item Slno'   oninput='this.value = this.value.toUpperCase()' autocomplete='off' /></td>"+
          "<td class='tdthtablebordr withDo'><input type='text' class='inputboxclr inputwidth' name='Invc_no[]' id='Invc_no"+i+"' autocomplete='off'></td>"+
          "<td class='tdthtablebordr tooltips withDo'><input list='toplaceList"+i+"' class='inputboxclr inputwidth'  id='to_place"+i+"' name='to_place[]' onchange='toPlaceW("+i+");' readonly  autocomplete='off' oninput='this.value = this.value.toUpperCase()'  placeholder='Select To Place'/><datalist id='toplaceList"+i+"'><?php foreach ($area_list as $key) { ?><option value='<?= $key->CITY_NAME ?>' data-xyz='<?= $key->CITY_CODE ?>'><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option><?php } ?></datalist></td>"+
          "<td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-bottom: 5px'><input type='text' class='dr_amount inputboxclr  getqtytotal quantityC moneyformate rightcontent' style='width: 65px;'  id='qty"+i+"' name='qty[]' oninput='Getqunatity("+i+")'  placeholder='Enter Qty Name'/><input type='hidden'   id='pre_qty"+i+"' style='width:65px;' name='pre_qty[]' value='' oninput='Getqunatity("+i+")'  placeholder='Enter Qty' autocomplete='off'/><input type='hidden' id='qtyget"+i+"' class='totlqty'><input list='umList"+i+"' name='unit_M[]' style='width: 40px;' id='UnitM"+i+"' class='inputboxclr  AddM'><datalist id='umList"+i+"'><?php foreach($um_list as $key) { ?><option value='<?= $key->UM_CODE ?>' data-xyz='<?= $key->UM_NAME ?>'><?= $key->UM_CODE ?> - <?= $key->UM_NAME ?></option><?php  } ?></datalist><input type='hidden' id='Cfactor"+i+"'></div><div><small id='errmsgqty"+i+"'></small></div></td>"+
          "<td class='tdthtablebordr' style='width: 5%;'><div style='display: inline-flex;border: none;'><input type='text' class='dr_amount inputboxclr  inputwidth getqtytotal quantityC moneyformate qtyclc rightcontent'  id='Aqty"+i+"' name='Aqty[]' oninput='Getqunatity("+i+")' style='width: 65px;' value=''  placeholder='Enter Qty' autocomplete='off'  /><input type='hidden' id='qtyget"+i+"' class='totlqty'><input list='aumList"+i+"' name='unit_AUM[]' style='width: 40px;' id='UnitAUM"+i+"' class='inputboxclr  AddM' autocomplete='off'><datalist id='aumList"+i+"'><?php foreach($um_list as $key) { ?><option value='<?= $key->UM_CODE ?>' data-xyz='<?= $key->UM_NAME ?>'><?= $key->UM_CODE ?> - <?= $key->UM_NAME ?></option><?php  } ?></datalist><input type='hidden' id='Cfactor"+i+"'></div><div><small id='errmsgqty"+i+"'></small></div></td></tr>";

      $('table').append(data);

        var testval = [];
       $('.optionsRadios1:checked').each(function() {
         testval.push($(this).val());
       });


          if(testval == 'Without DO'){

              $(".doorderNo").hide();

                $(".withoutDo").show();
                $(".withDo").hide();
               // $("#doDetailsBtn").prop("disabled",true);
           }else{

           // $("#doDetailsBtn").prop("disabled",false);
            $(".doorderNo").show();
            $(".withDo").show();
            $(".withoutDo").hide();

           }


     



      $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });




  var account_code = $("#account_code").val();

//alert(do_no);
 console.log('length i ',i);
 console.log('length count ',count);

 var counti = i;

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-do-details-by-customer') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code},

          success:function(data){

            var data1 = JSON.parse(data);

       
              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){


                   $("#deliveryList"+counti).empty();

                  $.each(data1.data, function(k, getData){
                     
                      var plan_qty = parseFloat(getData.QTY);
                      var dispacth_qty =parseFloat(getData.DISPATCH_PLAN_QTY);

                      
                      
                      if(plan_qty != dispacth_qty){

                            $("#deliveryList"+counti).append($('<option>',{

                          value:getData.DORDER_NO,

                          'data-xyz':getData.DORDER_NO,
                          text:getData.DORDER_NO+' - '+getData.ITEM_NAME+' - '+getData.CP_NAME+' - '+getData.TO_PLACE


                        }));

                      }
                     
                    
                    // var off_days =  data1.acc_data.OFF_DAYS;

                     //$("#off_days").val(off_days);

                  })
                  

              }

          }

    });


 i++;

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

    obj = $('#tbledata tr').find('span');
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
  
  
function advanceType(){



     var adv_type = $("#adv_type").val();
     var qty = $("#freight_qty").val();
     var rate = $("#rate").val();

     if(adv_type){

     
      $('#adv_type').css('border-color','#d2d6de');

      if(adv_type=='Lumsum'){

            $("#adv_amount").prop('readonly', false);
            $("#adv_rate").prop('readonly', true);
            $("#compc_req").hide();

          }else{
            $("#adv_amount").prop('readonly', true);
            $("#adv_rate").prop('readonly', false);
            $("#compc_req").show();
          } 

     }else{

         $("#adv_amount").val('');
         $("#adv_rate").val('');
         $('#adv_type').css('border-color','#ff0000').focus();
     }

     

  }
 function chnageadvRate(){

             var adv_rate      = $("#adv_rate").val();
             var adv_type = $("#adv_type").val();
             var qty      = $("#freight_qty").val();
             var amount   = $("#amount").val();

            if(adv_rate){

              $("#submitdata").prop('disabled', false);
              $("#submitdatapdf").prop('disabled', false);
              $("#vehicle_model").prop('readonly', false);

            if(adv_type=='Percent'){

               var calrate     =   $("#advcal_rate").val();

               var advance_amt =parseFloat(amount) * parseFloat(adv_rate) /100;

               if(parseFloat(advance_amt) > parseFloat(amount)){

                $("#adv_amount").val('');
                $("#adverr").html('adv amount should be less than amount');
                $("#submitdata").prop('disabled', true);

               }else{ 

                console.log(advance_amt);
                
                var advanceAmt = Math.round(advance_amt / 1000) * 1000;
                //var amount =roundoffCal.toFixed(2);

                 $("#adv_amount").val(advanceAmt.toFixed(2));
                 $("#adverr").html('');
                 $("#submitdata").prop('disabled', false);
               }

              

            }else if(adv_type=='Qty'){

              var calamt = parseFloat(qty) * parseFloat(adv_rate);

               if(parseFloat(calamt) > parseFloat(amount)){

                $("#adv_amount").val('');
                
                $("#adverr").html('adv amount should be less than amount');
                $("#submitdata").prop('disabled', true);
               }else{

                 $("#adverr").html('');
                 $("#adv_amount").val(calamt.toFixed(2));
                 $("#submitdata").prop('disabled', false);
               }

              //$("#adv_amount").val(calamt);

            }
          }else{

            $("#adv_amount").val('');
            $("#submitdata").prop('disabled', true);
          }

  }
  
$(document).ready(function(){


  $("#adv_amount").on('input', function () { 

     var adv_amount = $(this).val();
     var adv_type = $("#adv_type").val();
     var amount = $("#amount").val();

     if(adv_amount){

      $("#submitdata").prop('disabled', false);
       if(adv_type=='Lumsum'){

               if(parseFloat(adv_amount) > parseFloat(amount)){

                $("#adv_amount").val('');
                
                $("#adverr").html('adv amount should be less than amount');
                $("#submitdata").prop('disabled', true);

               }else if(parseFloat(adv_amount) == parseFloat(amount)){

                    $("#advrateModal").modal();

                    $("#submitdata").prop('disabled', true);

               }else{

                $("#adverr").html('');
                $("#submitdata").prop('disabled', false);
               }


            }
     }else{
      $("#submitdata").prop('disabled', true);
     }

  });

});

</script>

<script type="text/javascript">

  $(document).ready(function() {

  $("#rate").on('input', function () { 

    var rate = $(this).val();

    if(rate){

       var qty = $("#freight_qty").val();

      var amt = parseFloat(rate) * parseFloat(qty);

      $("#amount").val(amt.toFixed(2));

      $("#amount").prop('readonly',false);

      $("#payment_mode").prop('readonly',false);

    }else{

      $("#amount").prop('readonly',true);
      $("#payment_mode").prop('readonly',true);
    }


    chnageadvRate();
   

    });


  $("#amount").on('input', function () { 

    var amount = $(this).val();

    if(amount){

       var qty = $("#freight_qty").val();

      var rate = parseFloat(amount) / parseFloat(qty);
 
      $("#rate").val(rate.toFixed(2));

      $("#payment_mode").prop('readonly',false);

    }else{

      $("#payment_mode").prop('readonly',false);

    }


      chnageadvRate();
   

    });



  $("#freight_qty").on('input', function () { 

    var qty = $(this).val();
    var vehicle_owner = $("#vehicle_owner").val();

    if(vehicle_owner=='SELF'){

        if(qty){

           $("#submitdata").prop('disabled',false);
        }else{
          $("#submitdata").prop('disabled',true);
        }

    }else{

    if(qty){

      $("#rate").prop('readonly',false);

      var rate = $("#rate").val();

     var amount      =  parseFloat(qty) * parseFloat(rate);

      $("#amount").val(amount.toFixed(2));


    }else{
       $("#rate").prop('readonly',true);


    }

    chnageadvRate();


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
             //$('#payment_mode').css('border-color','#d2d6de');
             $("#fright_order").val('');
             $("#rate").val('');
             $("#freight_qty").val('');
             $("#amount").val('');
             $("#fright_order").prop('readonly', true);
              $("#rate").val('');
              $("#amount").val('');
              $("#fright_order").val('');
              $("#mfprate").val('');
              $("#rate_basis").val('');
              $("#freight_qty").prop('readonly', true);
              $("#rate").prop('readonly', true);
              $("#payment_mode").prop('readonly', true);
          }else{

             $("#transporter_name").val(msg);
             $('#transporter_code').css('border-color','#d2d6de');
           //  $('#payment_mode').css('border-color','#ff0000').focus();
             $("#freight_qty").prop('readonly', false);
             $("#rate").prop('readonly', false);
             $("#payment_mode").prop('readonly', false);
            
    
          } 

        });



       /* $("#do_no").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#deliveryList1 option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

         if(msg=='No Match'){

             $(this).val('');
         }

        });*/

        $("#vehicle_no").on('change', function () {  

          var val = $(this).val();
          var chk_owner =  $("#vehicle_owner").val();
          var chk_vehicle =  $("#vehicle_no").val();

          //alert(chk_vehicle);
         
          var xyz = $('#vehicleList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg);

          if(msg=='No Match' && (chk_owner=='' || chk_vehicle=='')){

            $("#vehicle_owner").val('');
            $("#vehicle_type").val('');
            $("#transporter_code").val('');
            $("#transporter_name").val('');
            $("#fright_order").val('');
            $("#freight_qty").val('');
            $("#rate").val('');
            $("#amount").val('');
            $("#payment_mode").val('');
            $("#adv_type").val('');
            $("#adv_rate").val('');
            $("#adv_amount").val('');
            $("#sale_rate").val('');
            $("#fsohid").val('');
            $("#fsobid").val('');
            $("#whee_type_name").val('');
            $("#min_gurrentee").val('');
            //$("#submitdata").prop('disabled',true);
             
          }else{
           //$("#submitdata").prop('disabled',false);
         
          }


        
           

        });


        $("#vehicle_type").on('change', function () {  

          var val = $(this).val();

          var VehicleOwner =  $("#vehicle_owner").val();


 

          var xyz = $('#vehicleTypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

            $("#vehicle_type").val('');
            $("#transporter_code").prop('readonly',true);
            $("#sale_rate").val('');
            $("#fsohid").val('');
            $("#fsobid").val('');
            $("#vehicleType_name").val('');
            $("#whee_type_name").val('');
            $("#min_gurrentee").val('');
            $("#whee_type_code").val('');
             
          }else{

            $("#vehicleType_name").val(msg);

           if(VehicleOwner){

                if(VehicleOwner=='DUMP' || VehicleOwner=='SELF'){

                $("#transporter_code,#transporter_name,#fright_order,#rate,#amount,#payment_mode,#adv_type,#adv_rate,#whee_type_name,#min_gurrentee").prop('readonly',true);

                $("#submitdata").prop("disabled",false);

                }else{

                  $("#submitdata").prop("disabled",true);
                  $("#transporter_code").prop('readonly',false);
                  $("#whee_type_name").prop('readonly',false);

                }

              }
          }


        
           

        });

        $("#whee_type_name").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#wheelTypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

           var explodeData = val.split(' ');

           var min_gurrentee = explodeData[1]+' '+explodeData[2];

          if(msg=='No Match'){

            $("#min_gurrentee").val('');
            $("#transporter_code").prop('readonly',true);
            $("#whee_type_code").val('');
             
          }else{

            $("#min_gurrentee").val(min_gurrentee);
            $("#whee_type_code").val(msg);

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
         

         $("#account_code").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#AccountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
             $("#accountName").val('');
             $("#do_no1").val('');
             $("#custCode1").val('');
            $("#custName1").val('');

          }else{

            $("#accountName").val(msg);
            $("#custCode1").val(val);
            $("#custName1").val(msg);

          }

        });


         $("#emp_code").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#empList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
             $("#emp_name").val('');
             $("#empName").val('');

          }else{

            $("#emp_name").val(msg);
            /*$("#empName").val(msg);
            $("#empCode").val(val);*/
            

          }

        });

         $("#account_code_wdo").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#AccountList_wdo option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $(this).val('');
             $("#accountName").val('');
             $("#do_no1").val('');
          }else{

            $("#accountName").val(msg);
            $("#custwdoCode1").val(val);
            $("#custwdoName1").val(msg);

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



 function getspName(srno){

      var sp_code = $("#sp_code"+srno).val();

     

    var xyz = $('#SpList'+srno+' option').filter(function() {

          return this.value == sp_code;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

        $("#sp_code"+srno).val('');

        $("#spName"+srno).val('');

      }else{

        
        $("#spName"+srno).val(msg);

      }

 }


  function getItemQty(srno){

    var ItemCode = $("#ItemCodeId"+srno).val();
    var do_no = $("#do_no"+srno).val();

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

                    


    var xyz = $('#ItemList'+srno+' option').filter(function() {

          return this.value == ItemCode;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      

      if(msg=='No Match'){

             $('#ItemCodeId'+srno).val('');

             document.getElementById("Item_Name_id"+srno).value = '';

             $('#qty'+srno).val('');
             $('#UnitM'+srno).val('');
             $('#Aqty'+srno).val('');
             $('#UnitAUM'+srno).val('');
             $('#remark'+srno).val('');
             $('#consignee'+srno).val('');
             $('#consineeName'+srno).val('');
             $('#sp_code'+srno).val('');
             $('#spName'+srno).val('');
             $('#item_slno'+srno).val('');
             $('#to_place'+srno).val('');
             $('#qty'+srno).prop('readonly',true); 
             $('#remark'+srno).prop('readonly',true);
             $("#consignee"+srno).prop('readonly', true);
             $("#consineeName"+srno).prop('readonly', true);
             $("#sp_code"+srno).prop('readonly', true);
             $("#spName"+srno).prop('readonly', true);
             $("#to_place"+srno).prop('readonly', true);
             $('#ItemCodeId'+srno).css('border-color','#d2d6de');
             $('#ItemCodeId'+srno).css('border-color','#ff0000').focus();
             $("#addmorhidn").prop('disabled', true);
             $("#deletehidn").prop('disabled', true);

      }else{

         document.getElementById("Item_Name_id"+srno).value = msg;

          
        $('#itemNameTooltip'+srno).removeClass('tooltiphide'); 

         $('#itemNameTooltip'+srno).html(msg); 

         $('#remark'+srno).prop('readonly',false); 
         $('#qty'+srno).prop('readonly',false); 
         $('#remark'+srno).prop('readonly',false);
         $("#consignee"+srno).prop('readonly', false);
         $("#consineeName"+srno).prop('readonly', false);
         $("#sp_code"+srno).prop('readonly', false);
         $("#spName"+srno).prop('readonly', false);
        // $("#to_place"+srno).prop('readonly', true);
         $('#route_code').prop('readonly',false); 
         $('#vehicle_no').prop('readonly',false); 
         $("#addmorhidn").prop('disabled', false);
         $("#deletehidn").prop('disabled', false);
         
         $('#ItemCodeId'+srno).css('border-color','#d2d6de');
      //   $('#vehicle_no').css('border-color','#ff0000').focus();

        $('#vr_date,#series_code,#account_code,#due_days,#emp_code,#cost_center_code').prop('readonly',true); 



      }


    $.ajax({

            url:"{{ url('get-item-delivery-order-qty') }}",

             method : "POST",

             type: "JSON",

             data: {ItemCode: ItemCode,do_no:do_no},

             success:function(data){

               // console.log(data);

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                     $("#qty"+srno).val('');
                     $("#basicTotal").val('');
                  }else if(data1.response == 'success'){

                    if(data1.data==''){

                    }else{

                    var do_qty = data1.data[0].QTY;
                    var to_place = data1.data[0].TO_PLACE;
                    var cp_code = data1.data[0].CP_CODE;
                    var cp_name = data1.data[0].CP_NAME;
                    var des_plan_qty = data1.data[0].DISPATCH_PLAN_QTY;
                    var um = data1.data[0].um;
                    var aqty = data1.data[0].AQTY;
                    var aum = data1.data[0].AUM;
                    var doslno = data1.data[0].SLNO;
                    var item_desc = data1.data[0].REMARK;
                    var sp_code = data1.data[0].SP_CODE;
                    var sp_name = data1.data[0].SP_NAME;
                    var sl_no = data1.data[0].SLNO;
                    var alise_item_code = data1.data[0].ALIAS_ITEM_CODE;
                    var alise_item_name = data1.data[0].ALIAS_ITEM_NAME;
                    var acatg_code = data1.data[0].ACATG_CODE;
                    var refcomp_code = data1.data[0].SISCONCERN_COMP_CODE;
                    var refcomp_name = data1.data[0].SISCONCERN_COMP_NAME;
                    var invc_no = data1.data[0].DO_INVC_NO;
                    var invc_dt = data1.data[0].DO_INVC_DT;
                    var wagon_no = data1.data[0].DO_WAGON_NO;
                    var do_headId = data1.data[0].DORDERHID;
                    var do_bodyId = data1.data[0].DORDERBID;
                    var delivery_no = data1.data[0].DO_DELIVERY_NO;
                    var gross_wt = data1.data[0].GROSS_WT;
                    var batch_no = data1.data[0].BATCH_NO;

                 
                    var dispatch_qty = parseFloat(do_qty) - parseFloat(des_plan_qty);

                     $("#qty"+srno).val(dispatch_qty.toFixed(3));
                     $("#pre_qty"+srno).val(dispatch_qty.toFixed(3));
                     $("#to_place"+srno).val(to_place);
                     $("#to_place"+srno).val(to_place);
                     $("#to_place"+srno).val(to_place);
                     $("#consignee"+srno).val(cp_code);
                     $("#consineeName"+srno).val(cp_name);
                     $("#acatgory_code"+srno).val(acatg_code);
                     $("#rcomp_code"+srno).val(refcomp_code);
                     $("#rcomp_name"+srno).val(refcomp_name);
                     $("#do_qty"+srno).val(dispatch_qty);
                     $("#slnodo"+srno).val(doslno);
                     $("#head_toplace").val(to_place);
                     $("#UnitM"+srno).val(um);
                     $("#Aqty"+srno).val(aqty);
                     $("#UnitAUM"+srno).val(aum);
                     $("#remark"+srno).val(item_desc);
                     $("#sp_code"+srno).val(sp_code);
                     $("#spName"+srno).val(sp_name);
                     $("#item_slno"+srno).val(sl_no);
                     $("#aliseItem_code"+srno).val(alise_item_code);
                     $("#aliseItem_Name"+srno).val(alise_item_name);
                     $("#Invc_no"+srno).val(invc_no);
                     $("#Invc_dt"+srno).val(invc_dt);
                     $("#wagon_no"+srno).val(wagon_no);
                     $("#do_headId"+srno).val(do_headId);
                     $("#do_bodyId"+srno).val(do_bodyId);
                     $("#delivery_no"+srno).val(delivery_no);
                     $("#gross_wt"+srno).val(gross_wt);
                      $("#do_batch_no"+srno).val(batch_no);

                      if(data1.trip_data=='' || data1.trip_data==null){

                          $("#trip_day").val('');

                        }else{

                          $("#trip_day").val(data1.trip_data.TRIP_DAYS);

                        }

                        if(data1.offday_data=='' || data1.trip_data==null){
                          $("#off_days").val('');
                        }else{
                          $("#off_days").val(data1.offday_data[0].OFF_DAYS);
                          $("#consineeAdd"+srno).val(data1.offday_data[0].ADD1);
                          $("#region"+srno).val(data1.offday_data[0].STATE_CODE);
                        }
                     
                     

                      gr_amt =0;
                         $(".getqtytotal").each(function () {
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  gr_amt += parseFloat(this.value);

                                  
                              }

                            $("#basicTotal").val(gr_amt.toFixed(3));
                            $("#basicTotalTemp").val(gr_amt.toFixed(3));

                          });

                         var allGrandAmount = parseFloat($('#basicTotal').val());


                         gr_amt1 =0;
                         $(".getaqtytotal").each(function () {
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  gr_amt1 += parseFloat(this.value);

                                  
                              }

                            $("#basicAqtyTotal").val(gr_amt1.toFixed(3));
                           

                          });

                    }


                    var dublicateName = do_no+'_'+ItemCode;


                     var existVal = $("#dublicateName").val();

                        if(existVal == ''){

                          $("#dublicateName").val(dublicateName);
                        
                        }else{

                          var blnkAry = [];
                          var existGet = $("#dublicateName").val();

                          if (existGet.indexOf(',') != -1) {

                            var segments = existGet.split(',');

                            for(var i=0;i<segments.length;i++){
                              blnkAry.push(segments[i]);
                            }

                            var checkDub = blnkAry.includes(dublicateName);

                            if(checkDub == true){
                              $('#showDubDataMsg').html('Dublicate Details');

                              console.log('dublicate');
                              
                                    $('#do_no'+srno).val('');
                                    $('#ItemCodeId'+srno).val('');
                                    $('#Item_Name_id'+srno).val('');
                                    $('#remark'+srno).val('');
                                    $('#consignee'+srno).val('');
                                    $('#consineeName'+srno).val('');
                                    $('#sp_code'+srno).val('');
                                    $('#spName'+srno).val('');
                                    $('#item_slno'+srno).val('');
                                    $('#to_place'+srno).val('');
                                    $('#qty'+srno).val('');
                                    $('#UnitM'+srno).val('');
                                    $('#Aqty'+srno).val('');
                                    $('#UnitAUM'+srno).val('');
                             
                              
                            }else if(checkDub == false){
                              $('#showDubDataMsg').html('');
                              var getPrevVal = $("#dublicateName").val();
                              $("#dublicateName").val(getPrevVal+','+dublicateName);
                              
                              
                            }

                          }else{

                              var blnkAry1 = [];
                              var existGet1 = $("#dublicateName").val();
                              blnkAry1.push(existGet1);

                              var checkDub1 = blnkAry1.includes(dublicateName);

                              if(checkDub1 == true){
                                $('#showDubDataMsg').html('Dublicate Details');

                                console.log('dublicate');
                                     $('#do_no'+srno).val('');
                                    $('#ItemCodeId'+srno).val('');
                                    $('#Item_Name_id'+srno).val('');
                                    $('#remark'+srno).val('');
                                    $('#consignee'+srno).val('');
                                    $('#consineeName'+srno).val('');
                                    $('#sp_code'+srno).val('');
                                    $('#spName'+srno).val('');
                                    $('#item_slno'+srno).val('');
                                    $('#to_place'+srno).val('');
                                    $('#qty'+srno).val('');
                                    $('#UnitM'+srno).val('');
                                    $('#Aqty'+srno).val('');
                                    $('#UnitAUM'+srno).val('');
                                
                              }else if(checkDub1 == false){
                                $('#showDubDataMsg').html('');
                                var getPrevVal1 = $("#dublicateName").val();
                                $("#dublicateName").val(getPrevVal1+','+dublicateName);
                                

                              
                              }


                          }

                    }

                   
                        
                  }
             }

          });


  }

</script>

<script type="text/javascript">
  
  function getvrnoBySeries(){

    var seriesCode = $('#series_code').val();
    var transcode = $('#transcode').val();

    if (seriesCode=='') {
      $('#account_code').css('border-color','#d2d6de');
      $('#series_code').css('border-color','#ff0000').focus();
    }else{
      $('#series_code').css('border-color','#d2d6de');
      $('#account_code').css('border-color','#ff0000').focus();
    }

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

                  if(data1.vrno_series == '' || data1.vrno_series == null){
                    $('#vrseqnum').val('');
                      $('#getVrNo').val('');
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

  var to_place = $("#head_toplace").val();

  var FreightQtyTotal = $("#basicTotal").val();

  //var getorder =  fright_order.split(" ");

  //var series_code = getorder[1];
  //var vrno = getorder[2];
//alert(to_place);

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-freight-pur-order-details') }}",

          method : "POST",

          type: "JSON",

          data: {trans_code: trans_code,to_place:to_place},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                $("#freight_qty").val(FreightQtyTotal);
                 //$("#payment_mode").prop("readonly",true);



              }else if(data1.response == 'success'){


                    if(data1.data=='' || data1.data==null){


                       $("#freight_qty").val(FreightQtyTotal);

                    }else{

                        var fy_year     =  data1.data[0].FY_CODE;
                        var series_code =  data1.data[0].SERIES_CODE;
                        var vr_no       =  data1.data[0].VRNO;
                        
                        var fy_code     =  fy_year.split("-");
                        
                        var fycode      = fy_code[1];
                        
                        var pordervrno  = fycode+' '+series_code+' '+vr_no;
                      
                        var rate       = data1.data[0].RATE;
                        var rate_basis = data1.data[0].RATE_BASIS;
                        var amount     =  parseFloat(basicTotal) * parseFloat(rate);
                        
                        $("#rate").val(rate);
                        $("#amount").val(amount);
                        $("#fright_order").val(pordervrno);
                        $("#mfprate").val(rate);
                        $("#rate_basis").val(rate_basis);
                        $("#freight_qty").val(basicTotal);

                    }
                   
                  /*$("#accountName").val(data1.data[0].ACC_NAME);
                  $("#from_place").val(data1.data[0].FROM_PLACE);
                  $("#to_place").val(data1.data[0].TO_PLACE);*/
                  

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

     $('#vr_date,#series_code,#account_code,#accountName').prop('readonly',true); 

    $('#doublepoint,#doDetailsBtn').prop('disabled',true);
     
  }else{
      
       $('#do_no').css('border-color','#ff0000');
       $('#do_no').css('border-color','#ff0000').focus();

       $("#fsorder_no,#sale_rate,#sale_qty").val('');


           
            $("#ItemCodeId"+srno).val('');
            $("#Item_Name_id"+srno).val('');
            $("#remark"+srno).val('');
            $("#qty"+srno).val('');
            $("#basicTotal").val('');
            $("#UnitM"+srno).val('');
            $("#remark"+srno).val('');
  }

     // $('#vr_date,#series_code,#Plant_code,#account_code').prop('readonly',false); 

                  

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-do-details-do-order') }}",

          method : "POST",

          type: "JSON",

          data: {do_no: do_no},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                 $("#ItemList"+srno).empty();

              }else if(data1.response == 'success'){


                    

                    if(data1.data==''){
                      $("#do_no"+srno).val('');
                      $("#ItemCodeId"+srno).val('');
                      $("#Item_Name_id"+srno).val('');
                      $("#remark"+srno).val('');
                      $("#qty"+srno).val('');
                      $("#basicTotal"+srno).val('');

                     

                    }else{

                        $("#delorder_date"+srno).val(data1.data[0].DORDER_DATE);

                         $("#ItemList"+srno).empty();

                        $("#ItemCodeId"+srno).prop('readonly',false);


                        $.each(data1.data, function(k, getData){

                    
                                 $("#ItemList"+srno).append($('<option>',{

                                value:getData.ITEM_CODE,

                                'data-xyz':getData.ITEM_NAME,
                                text:getData.ITEM_NAME+'-'+'DO['+getData.DORDER_NO+']'+'-'+getData.TO_PLACE+''


                              }));
                              
                              

                            })


                          $('#Plant_code').val(data1.data[0].PLANT_CODE);
                          $('#plantname').val(data1.data[0].PLANT_NAME);
                          $('#profitctrId').val(data1.data[0].PFCT_CODE);
                          $('#pfctName').val(data1.data[0].PFCT_NAME);
                          $('#from_place').val(data1.data[0].FROM_PLACE);
                          
                        }
                        

              }

          }

    });

}

</script>






<script type="text/javascript">
  
  function itemCodeGet(ItemId){

    var ItemCode =  $('#ItemCodeId'+ItemId).val();
  //  var do_no =  $('#do_no'+ItemId).val();

    //alert(do_no);

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
             $('#remark'+ItemId).val('');
             $('#AddUnitM'+ItemId).val('');
             $('#qty'+ItemId).prop('readonly',true); 
             $('#remark'+ItemId).prop('readonly',true); 
             $('#ItemCodeId'+ItemId).css('border-color','#d2d6de');
             $('#ItemCodeId'+ItemId).css('border-color','#ff0000').focus();
             $('#batchno'+ItemId).html(''); 
             $("#addmorhidn").prop('disabled', true);

      }else{

         document.getElementById("Item_Name_id"+ItemId).value = msg;

          
        $('#itemNameTooltip'+ItemId).removeClass('tooltiphide'); 

         $('#itemNameTooltip'+ItemId).html(msg); 

         $('#remark'+ItemId).prop('readonly',false); 
         $('#qty'+ItemId).prop('readonly',false); 
         $('#remark'+ItemId).prop('readonly',false); 
         $('#route_code').prop('readonly',false); 
         $('#vehicle_no').prop('readonly',false); 
         $("#addmorhidn").prop('disabled', false);
         $('#ItemCodeId'+ItemId).css('border-color','#d2d6de');
      //   $('#vehicle_no').css('border-color','#ff0000').focus();

        $('#vr_date,#series_code,#account_code,#due_days,#emp_code,#cost_center_code').prop('readonly',true); 



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
               
                 console.log(data1.data);


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

                     

                    }else{

                      

                          $('#UnitM'+ItemId).val(data1.data[0].UM_CODE);

                          $('#AddUnitM'+ItemId).val(data1.data[0].AUM_CODE);

                          $('#Cfactor'+ItemId).val(data1.data[0].AUM_FACTOR);

                          $('#scrab_code'+ItemId).val(data1.data_hsn[0].SCRAP_CODE);

                        //  $('#slnodo'+ItemId).val(data1.slnodo);

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
                         
                              if (!isNaN(this.value) && this.value.length != 0) {
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

  function donumber(num){

      var do_number = $("#do_no"+num).val();

      if(do_number){

        $("#ItemCodeId"+num).prop('readonly',false);
      }else{
           $("#ItemCodeId"+num).prop('readonly',true);
      }
  }
  
</script>

<script type="text/javascript">
  function Getqunatity(qtyId){


     var checkqty = $('#qty'+qtyId).val();
     var pre_qty  = $('#pre_qty'+qtyId).val();

     var doqty      =$('#do_qty'+qtyId).val();
     //var totalBasic = parseFloat($('#basicTotalTemp').val());
     var totalBasic = parseFloat($('#basicTotal').val());
     var stockqty   =$('#stockavlblevalue'+qtyId).val();

     if(parseFloat(checkqty) > parseFloat(pre_qty)){


              $("#doqtyerr").html('qty should be greter than previous qty').css('color','red');
              
              $('#qty'+qtyId).val(pre_qty);                          

      }else{
              $("#doqtyerr").html('');
            }

     var trcount=$('#tbledata tr').length;
      
      var getCalQty=0;
      var getCalAQty=0;
     for(var e=0;e<trcount;e++){

      if(e >= 1){
        var newQty = $('#qty'+e).val();
        var newAQty = $('#Aqty'+e).val();
         getCalQty += parseFloat(newQty);
         getCalAQty += parseFloat(newAQty);

      }
        
     }

     $("#basicTotal").val(getCalQty.toFixed(3));
     $("#basicAqtyTotal").val(getCalAQty.toFixed(3));
    // console.log('getCalQty',getCalQty);
      //var glcdAry = [];

      /*for(var y=1;y<=trcount;y++){
       
        var glCd = $('#gl_code'+y).val();
        glcdAry.push(glCd);

      }*/
     
    /* var quantity =$('#qty'+qtyId).val().replaceAll(',', '');
     var cfactor = $('#Cfactor'+qtyId).val();
     var total = quantity * cfactor;

     console.log('orgqty',checkqty);
   
      if (quantity.length < 1){
        ('#qty'+qtyId).val('0.00');
        
      }else {
        var val = parseFloat(quantity);
        var formatted = inrFormat(quantity);

        $('#qty'+qtyId).val(val);
      }
*/
    
     /* if(checkqty){
     
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);

      }else{
        
          $("#deletehidn").prop('disabled', true);
          $("#addmorhidn").prop('disabled', true);
      }*/

      var gr_amt1 =0;
       $(".qtyclc").each(function () {

        
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 += parseFloat(this.value);
              console.log('total ',this.value);

            }



            /*if(qtyId >1){

              var newAmt = parseFloat(gr_amt1) - parseFloat(checkqty);
             
            }else{
               var newAmt = parseFloat(gr_amt1) - parseFloat(0);
            }

            $("#basicTotal").val(newAmt.toFixed(3));*/

           /* if(parseFloat(checkqty) > parseFloat(doqty)){

              $("#doqtyerr").html('do qty should be greater than trip plan qty').css('color','red');

              $('#qty'+qtyId).val(doqty);

              $("#basicTotal").val();
          
              }else{
               
                $("#doqtyerr").html('');

                $("#basicTotal").val();
              }*/
          

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());


        $("#vehicle_no").prop('readonly',false);
       // $("#submitdata").prop('disabled',false);



  }
</script>

<script type="text/javascript">

 function submitData(pdfFlag){

     var downloadFlg = pdfFlag;

     $('#pdfYesNoStatus').val(downloadFlg);

   //  alert(downloadFlg);return false;

        var trcount=$('table tr').length;
        var data = $("#salesordertrans").serialize();

        var vehicle_owner =  $("#vehicle_owner").val();
        var vehicle_no    =  $("#vehicle_no").val();
        var vehicle_type  =  $("#vehicle_type").val();
        var off_days      =  $("#off_days").val();
        var trip_day      =  $("#trip_day").val();
        var freight_qty   =  $("#freight_qty").val();

       // alert(vehicle_owner);return false;

          if(vehicle_no=='' || vehicle_owner=='' || vehicle_type=='' || off_days=='' || trip_day=='' || freight_qty==''){

              $("#requiredMsg").html('* Fields Are Required').css('color','red');

               return false;
          }

        if(vehicle_owner=='MARKET'){

          var transporter_code =  $("#transporter_code").val();
          var freight_qty =  $("#freight_qty").val();
          var rate =  $("#rate").val();
          var amount =  $("#amount").val();
          var payment_modem =  $("#payment_mode").val();
          var adv_type =  $("#adv_type").val();
          var adv_amount =  $("#adv_amount").val();

          if(transporter_code=='' || freight_qty=='' || rate=='' || amount=='' || payment_modem=='' || adv_type=='' || adv_amount==''){

            $("#requiredMsg").html('* Fields Are Required').css('color','red');

            return false;
          }

        }


          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/finance/save-vehicle-plan'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                 var data1 = JSON.parse(data);

                 console.log(data);

             
              if(data1.response=='error'){
                  var responseVar =false;

                var url = "{{ url('view-vehicle-planing-mast') }}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

              var responseVar =true;

              if(downloadFlg == 1){
                  var fyYear    = data1.data[0].FY_CODE;
                  var fyCd      = fyYear.split('-');
                  var seriesCd  = data1.data[0].SERIES_CODE;
                  var vrNo      = data1.data[0].VRNO;
                  var fileN     = 'LP_'+fyCd[0]+''+seriesCd+''+vrNo;
                  var link      = document.createElement('a');
                  link.href     = data1.url;
                  link.download = fileN+'.pdf';
                  link.dispatchEvent(new MouseEvent('click'));
                }
              var url = "{{ url('/Transaction/View-vehicle-Plan-msg') }}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

          }

              },

          });
      
  }

  function submitLoadingSlipTrans(pdfFlag){
    
    var downloadFlg = pdfFlag;

    $('#pdfYesNoStatus').val(downloadFlg);

    var data = $("#salesordertrans").serialize();

    var vehicle_owner =  $("#vehicle_owner").val();
        var vehicle_no =  $("#vehicle_no").val();
        var vehicle_type =  $("#vehicle_type").val();

       // alert(vehicle_owner);return false;

          if(vehicle_no=='' || vehicle_owner=='' || vehicle_type==''){

              $("#requiredMsg").html('* Fields Are Required').css('color','red');

               return false;
          }

        if(vehicle_owner=='MARKET'){

          var transporter_code =  $("#transporter_code").val();
          var freight_qty =  $("#freight_qty").val();
          var rate =  $("#rate").val();
          var amount =  $("#amount").val();
          var payment_modem =  $("#payment_mode").val();
          var adv_type =  $("#adv_type").val();
          var adv_amount =  $("#adv_amount").val();

          if(transporter_code=='' || freight_qty=='' || rate=='' || amount=='' || payment_modem=='' || adv_type=='' || adv_amount==''){

            $("#requiredMsg").html('* Fields Are Required').css('color','red');

            return false;
          }

        }

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        type: 'POST',

        url: "{{ url('/Transaction/loading-slip-submit') }}",

        data: data, // here $(this) refers to the ajax object not form
        success: function (data) {
          
          var data1 = JSON.parse(data);
           if(data1.response=='error'){
              var responseVar =false;

                var url = "{{ url('view-vehicle-planing-mast') }}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

           }else{

              var responseVar =true;

              if(downloadFlg == 1){
                  var fyYear    = data1.data[0].FY_CODE;
                  var fyCd      = fyYear.split('-');
                  var seriesCd  = data1.data[0].SERIES_CODE;
                  var vrNo      = data1.data[0].VRNO;
                  var fileN     = 'LP_'+fyCd[0]+''+seriesCd+''+vrNo;
                  var link      = document.createElement('a');
                  link.href     = data1.url;
                  link.download = fileN+'.pdf';
                  link.dispatchEvent(new MouseEvent('click'));
                }
              var url = "{{ url('/Transaction/View-vehicle-Plan-msg') }}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

          }
        }
    });
    // console.log('data',JSON.stringify(data));

  }
 


       
</script>

<script type="text/javascript">
  
  function PlantCode(){

    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var Plant_code = $('#Plant_code').val();
      var to_place = $('#head_toplace').val();

      $.ajax({

        url:"{{ url('Get-Pfct-Code-Name-By-Plant-Vehicle-Plan') }}",

        method : "POST",

        type: "JSON",

        data: {Plant_code: Plant_code,to_place:to_place},

        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

            console.log('data1.data[0]',data1.data_plant);

            if(data1.data_plant==''){
                    $("#from_place").val('');
            }else{

              $("#from_place").val(data1.data_plant);

            }

            if(data1.data == ''){
                 var profitctr = '';
                 var pfctget = '';
                 var pfctName = '';
                 var statec = '';
                 $('#profitctrId').val(profitctr);
                 $('#pfctName').val(pfctName);
                 $('#getPfctName').val(pfctName);
                 $('#getPfctCode').val(pfctget);
                 $('#getStateByPlant').val(statec);
              }else{
                $('#profitctrId').val(data1.data[0].PFCT_CODE);
                $('#pfctName').val(data1.data[0].PFCT_NAME);
                $('#getPfctName').val(data1.data[0].PFCT_NAME);
                $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                $('#getStateByPlant').val(data1.data[0].STATE);
               // $('#from_place').val(data1.data[0].CITY_NAME);
                $('#trip_day').val(data1.data_trip.TRIP_DAYS);
                //$('#off_days').val(data1.data_trip.OFF_DAY);

              }

          }

        }

      });
  }
</script>

<script type="text/javascript">
  
  function PlantCode1(){

    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var Plant_code = $('#Plant_code').val();

      $.ajax({

        url:"{{ url('Get-Pfct-Code-Name-By-Plant') }}",

        method : "POST",

        type: "JSON",

        data: {Plant_code: Plant_code},

        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){
            //console.log('data1.data[0]',data1.data[0]);
            if(data1.data == ''){
                 var profitctr = '';
                 var pfctget = '';
                 var pfctName = '';
                 var statec = '';
                 $('#profitctrId').val(profitctr);
                 $('#pfctName').val(pfctName);
                 $('#getPfctName').val(pfctName);
                 $('#getPfctCode').val(pfctget);
                 $('#getStateByPlant').val(statec);
              }else{
                $('#profitctrId').val(data1.data[0].PFCT_CODE);
                $('#pfctName').val(data1.data[0].PFCT_NAME);
                $('#getPfctName').val(data1.data[0].PFCT_NAME);
                $('#getPfctCode').val(data1.data[0].PFCT_CODE);
                $('#getStateByPlant').val(data1.data[0].STATE);
                $('#from_place').val(data1.data[0].CITY_NAME);
                $('#trip_day').val(data1.data_trip.TRIP_DAYS);

              }

          }

        }

      });
  }
</script>

<script type="text/javascript">

  $(".optionsRadios1").on('change',function () { 

   var radio_btn = $(this).val();

   if(radio_btn=='Without DO'){

    //$('#tbledata').empty();
    

      $(".withoutDo").show();
      $(".withDo").hide();
      $("#doDetailsBtn").prop("disabled",true);
      $(".doorderNo").hide();
     // $("#consignee1").removeClass('withoutDo');
      $("#ItemCodeId1").val('');
      $("#consignee_wdo1").val('');
      $("#to_place_wdo1").val('');
      $("#ItemCodeId1").val('');
      $("#Item_Name_id1").val('');
      $("#qty1").val('');
      $("#UnitM1").val('');
      $("#accountName").val('');
      $("#account_code_wdo").val('');
      
   }else{

    $("#doDetailsBtn").prop("disabled",false);
    $(".doorderNo").show();
    $(".withDo").show();
    $(".withoutDo").hide();
    $("#ItemCodeId1").val('');
    $("#Item_Name_id1").val('');
    $("#qty1").val('');
    $("#UnitM1").val('');
    $("#consignee_wdo1").val('');
    $("#to_place_wdo1").val('');
    $("#accountName").val('');
    $("#account_code").val('');
    $("#off_days").val('');

   }


    
});

</script>

<script>
  
  function ShowDoDetails(){

  var account_code = $("#account_code").val();

  if(account_code){

     $('#account_code').css('border-color','#d2d6de');
     
  }else{
      
       $('#account_code').css('border-color','#ff0000');
       $('#account_code').css('border-color','#ff0000').focus();

       $("#account_code,#accountName,#fsorder_no,#sale_rate,#sale_qty").val('');
  }


   $("#allDoShow").modal('show');
  

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

  
    $('#AccTable').DataTable().destroy();

     var t = $("#AccTable").DataTable({

            oLanguage: {
              sProcessing: $('.modalspinner').removeClass('hideloaderOnModl')
          },
       processing: true,

      // serverSide:false,

       //scrollY:1000,

      // scrollX:true,

       //pageLength:30,
       paging: false,

      searching : true,


       ajax:{


        url : "{{ url('get-do-details-by-acc_code') }}",
        data: {account_code:account_code},

       },
    

       columns: [

         
         { 
              data:"DT_RowIndex",
              name:"DT_RowIndex",
              className:"text-center",
              'render': function (data, type, full, meta){
                         return '<input type="checkbox" name="itemname" class="ads_Checkbox" value="'+full['DT_RowIndex']+'" id="sr_'+full['DT_RowIndex']+'">';

                     }
        },

         
        { data: "DORDER_NO",className:"textLeft",

            render: function (data, type, full, meta){
                  
                var DO_NO = '<p>'+full['DORDER_NO']+'</p>'+'<p style="line-height:2px;"><input type="hidden" id="doOrderno_'+full['DT_RowIndex']+'" value="'+full['DORDER_NO']+'"><input type="hidden" id="poslno_'+full['DT_RowIndex']+'" value="'+full['SLNO']+'"><input type="hidden" id="doOrederDt_'+full['DT_RowIndex']+'" value="'+full['DORDER_DATE']+'"><input type="hidden" id="doHeadId_'+full['DT_RowIndex']+'" value="'+full['DORDERHID']+'"><input type="hidden" id="doBodyId_'+full['DT_RowIndex']+'" value="'+full['DORDERBID']+'"></p>'; 

                return DO_NO;

              }


        },
        

        { data: "DO_INVC_NO",className:"textLeft",
         render: function (data, type, full, meta){
                  
                var DO_INVC_NO = '<p>'+full['DO_INVC_NO']+'</p>'+'<p style="line-height:2px;"><input type="hidden" id="doOrederInvcNo_'+full['DT_RowIndex']+'" value="'+full['DO_INVC_NO']+'"></p>'; 

                return DO_INVC_NO;

              }
        },
        { 
         data: "DO_WAGON_NO",
         className:"textLeft",

        },

        { data: "DO_DELIVERY_NO",className:"textLeft",

          render: function (data, type, full, meta){
                  
                var itemName = '<p>'+full['DO_DELIVERY_NO']+'</p>'+'<input type="hidden" id="do_deliveryno_'+full['DT_RowIndex']+'" value="'+full['DO_DELIVERY_NO']+'"><input type="hidden" id="itemcode_'+full['DT_RowIndex']+'" value="'+full['ITEM_CODE']+'-'+full['ITEM_NAME']+'">'; 
               
                return itemName;
               
              }
        },
        { data: "ALIAS_ITEM_CODE",className:"textLeft",

          render: function (data, type, full, meta){
                  
                var AliseitemName = '<p>'+full['ALIAS_ITEM_CODE']+'</p>'+'<input type="hidden" id="aliseitemcode_'+full['DT_RowIndex']+'" value="'+full['ALIAS_ITEM_CODE']+'~'+full['ALIAS_ITEM_NAME']+'">'; 
               
                return AliseitemName;
               
              }
        },

        { data: "REMARK",className:"textLeft",

          render: function (data, type, full, meta){
                  
                var itemName = '<p>'+full['REMARK']+'</p>'+'<p style="line-height:2px;"><input type="hidden" id="itemdesc_'+full['DT_RowIndex']+'" value="'+full['REMARK']+'"></p>'; 

                return itemName;

              }
        },

         { data: "CP_CODE",className:"textLeft",

         render: function (data, type, full, meta){


                  
                var CP_CODE = '<p>'+full['CP_NAME']+'</p>'+'<p style="line-height:2px;">('+full['CP_CODE']+')<input type="hidden" id="cpCode_'+full['DT_RowIndex']+'" value="'+full['CP_CODE']+'"><input type="hidden" id="cpName_'+full['DT_RowIndex']+'" value="'+full['CP_NAME']+'"><input type="hidden" id="ACatgCode_'+full['DT_RowIndex']+'" value="'+full['ACATG_CODE']+'"><input type="hidden" id="RcompCode_'+full['DT_RowIndex']+'" value="'+full['SISCONCERN_COMP_CODE']+'"><input type="hidden" id="RcompName_'+full['DT_RowIndex']+'" value="'+full['SISCONCERN_COMP_NAME']+'"><input type="hidden" id="Invc_no_'+full['DT_RowIndex']+'" value="'+full['DO_INVC_NO']+'"><input type="hidden" id="Invc_dt_'+full['DT_RowIndex']+'" value="'+full['DO_INVC_DT']+'"><input type="hidden" id="wagon_no_'+full['DT_RowIndex']+'" value="'+full['DO_WAGON_NO']+'"><input type="hidden" id="delivery_no_'+full['DT_RowIndex']+'" value="'+full['DO_DELIVERY_NO']+'"><input type="hidden" id="gross_wt_'+full['DT_RowIndex']+'" value="'+full['GROSS_WT']+'"><input type="hidden" id="do_batch_no_'+full['DT_RowIndex']+'" value="'+full['BATCH_NO']+'"></p>'; 

                return CP_CODE;

              }


        },

         { data: "SP_CODE",className:"textLeft",

         render: function (data, type, full, meta){


                if(full['SP_NAME']==null){

                  var SP_NAME ='NOT FOUND';
                }else{
                   var SP_NAME =full['SP_NAME'];
                }

                if(full['SP_CODE']==null){

                  var SP_CODE ='N-F';
                }else{
                   var SP_CODE =full['SP_NAME'];
                }
                  
                var SP_CODE = '<p>'+SP_NAME+'</p>'+'<p style="line-height:2px;">('+SP_CODE+')<input type="hidden" id="spCode_'+full['DT_RowIndex']+'" value="'+SP_CODE+'"><input type="hidden" id="spName_'+full['DT_RowIndex']+'" value="'+SP_NAME+'"></p>'; 

                return SP_CODE;
                
                

              }


        },
        { data: "SLNO",className:"textLeft",

         render: function (data, type, full, meta){
                  
                var SLNO = '<p>'+full['SLNO']+'</p>'+'<p style="line-height:2px;">('+full['CP_CODE']+')<input type="hidden" id="itemSlNo_'+full['DT_RowIndex']+'" value="'+full['SLNO']+'">'; 

                return SLNO;

              }


        },



         { data: "TO_PLACE",className:"textLeft",

         render: function (data, type, full, meta){
                  
                var TO_PLACE = '<p>'+full['TO_PLACE']+'</p>'+'<p style="line-height:2px;"><input type="hidden" id="toPlace_'+full['DT_RowIndex']+'" value="'+full['TO_PLACE']+'"></p>'; 

                return TO_PLACE;

              }

        },
        { 
         render: function (data, type, full, meta){

                var do_qty = full['QTY'];
                /*var dispatch_qty = full['DISPATCH_PLAN_QTY'];
                var plan_qty =  parseFloat(do_qty) - parseFloat(dispatch_qty);
                  
                var QTY = '<p>'+plan_qty+'</p>'+'<p style="line-height:2px;"><input type="hidden" id="qtyOreder_'+full['DT_RowIndex']+'" value="'+plan_qty+'"></p>'; */

                return do_qty;

              }

        },
        { 
         render: function (data, type, full, meta){

                var CANCEL_QTY = full['CANCEL_QTY'];
              

                return CANCEL_QTY;

              }

        },
        { 
         render: function (data, type, full, meta){

                var DISPATCH_PLAN_QTY = full['DISPATCH_PLAN_QTY'];

                return DISPATCH_PLAN_QTY;

              }

        },
        { 
         render: function (data, type, full, meta){

                var do_qty = full['QTY'];
                var cancel_qty = full['CANCEL_QTY'];
                var dispatch_qty = full['DISPATCH_PLAN_QTY'];




                var plan_qty =  parseFloat(do_qty) - parseFloat(cancel_qty) - parseFloat(dispatch_qty);
                  
                var QTY = '<p>'+plan_qty.toFixed(3)+'</p>'+'<p style="line-height:2px;"><input type="hidden" id="qtyOreder_'+full['DT_RowIndex']+'" value="'+plan_qty.toFixed(3)+'"></p>'; 

                return QTY;

              }

        },
        {
         render: function (data, type, full, meta){

                if(full['um']==null){

                  var um = '';
                }else{

                  var um = '<p>'+full['um']+'</p>'+'<p style="line-height:2px;"><input type="hidden" id="qtyum_'+full['DT_RowIndex']+'" value="'+full['um']+'"></p>'; 
                }
                  
                

                return um;

              }

        },
        {
         render: function (data, type, full, meta){

                if(full['AQTY']==null){

                  var AQTY = '';
                }else{

                  var AQTY = '<p>'+full['AQTY']+'</p>'+'<p style="line-height:2px;"><input type="hidden" id="Aqty_'+full['DT_RowIndex']+'" value="'+full['AQTY']+'"></p>'; 
                }
                  
                

                return AQTY;

              }

        },
        {
         render: function (data, type, full, meta){

                if(full['AUM']==null){

                  var aum = '';
                }else{

                  var aum = '<p>'+full['AUM']+'</p>'+'<p style="line-height:2px;"><input type="hidden" id="qtyaum_'+full['DT_RowIndex']+'" value="'+full['AUM']+'"></p>'; 
                }
                  
                

                return aum;

              }

        },
        {
         render: function (data, type, full, meta){

                if(full['EWAY_BILL_NO']==null){

                  var ewaybillNo = '';
                }else{

                  var ewaybillNo = '<p>'+full['EWAY_BILL_NO']+'</p>'+'<p style="line-height:2px;"><input type="hidden" id="ewaybill_no_'+full['DT_RowIndex']+'" value="'+full['EWAY_BILL_NO']+'"><input type="hidden" id="ewaybill_dt_'+full['DT_RowIndex']+'" value="'+full['EWAY_BILL_DT']+'"></p>'; 
                }
                  
                

                return ewaybillNo;

              }

        },


      ],

      

     });


    

}
</script>


<script type="text/javascript">

function ShowDoDetails1(){

  var account_code = $("#account_code").val();

//alert(do_no);
  if(account_code){

     $('#account_code').css('border-color','#d2d6de');
     
  }else{
      
       $('#account_code').css('border-color','#ff0000');
       $('#account_code').css('border-color','#ff0000').focus();

       $("#account_code,#accountName,#fsorder_no,#sale_rate,#sale_qty").val('');
  }

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-do-details-by-customer') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log('customerdata',data1.data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                $("#deliveryList1").empty();
                $("#do_no1").val('');

                 $('#allItemShow1').modal('hide');

              }else if(data1.response == 'success'){

                if(data1.data==''){

                  $('#doNotmsgModal').modal('show');

                 }else{

                
                $('#allItemShow1').modal('show');

                $('#itemListShow_1').empty();

                var plant_code =  data1.data[0].PLANT_CODE;
                var to_place   =  data1.data[0].TO_PLACE;

                //console.log('toplace',to_place);

               /* var fy_year     =  data1.fso_data[0].FY_CODE;
                var series_code =  data1.fso_data[0].SERIES_CODE;
                var vr_no       =  data1.fso_data[0].VRNO;
                
                var fy_code     =  fy_year.split("-");
                
                var fycode      = fy_code[0];
                
                var sale_order  = fycode+' '+series_code+' '+vr_no;

                
                  $("#sale_rate").val(data1.fso_data[0].RATE);
                  $("#sale_qty").val(data1.fso_data[0].QTY);
                  $("#fsorder_no").val(sale_order);
*/
                 
                   var tableHead= "<div class='box-row'><div class='box10 texIndbox'>#</div><div class='box10 vrnoinbox'>DO No</div><div class='box10 vrnoinbox'>DO Date</div><div class='box10 itemIndbox'>Item </div><div class='box10 rateIndbox'>Consinee </div><div class='box10 rateIndbox'>To Place </div><div class='box10 rateIndbox'>Qty </div><div class='box10 rateIndbox'>UM </div></div>";

                    $('#itemListShow_1').append(tableHead);

                      var incemntval = 1;

                      var inval = '';

                      var itmCounts = data1.data.length;


                      $.each(data1.data, function(k, getData) {

                            console.log(getData.QTY);
                            console.log(getData.DISPATCH_PLAN_QTY);

                          var do_qty = getData.QTY;
                          var dispatch_qty = getData.DISPATCH_PLAN_QTY;
                          var dispatch_qty = getData.DISPATCH_PLAN_QTY;

                          var plan_qty =  parseFloat(do_qty) - parseFloat(dispatch_qty);

                          var startyear = getData.VRDATE;
                          var getyear = startyear.split("-");

                      
                      var tableBody = "<div class='box-row' id='hidebalNull_"+incemntval+"'><div class='box10 texIndbox'><input type='checkbox' id='sr_"+incemntval+"' class='ads_Checkbox' name='itemname' value='"+incemntval+"'></div><div class='box10 texIndbox' style='width: 15%;'><input type='text' id='doOrderno_"+incemntval+"' name='head_tax_ind11[]' class='form-control textheight' value="+getData.DORDER_NO+"  readonly></div><div class='box10 rateIndbox'><input type='text' id='doOrederDt_"+incemntval+"' name='qtyOrder' class='form-control rightcontent textheight' value="+getData.DORDER_DATE+" readonly></div><div class='box10 rateIndbox tooltips'><input type='hidden' value="+getData.FY_CODE+" id='sqfiscalyr_"+incemntval+"'><input type='hidden' value="+getData.SERIES_CODE+" id='poseries_"+incemntval+"'><input type='hidden' value="+getData.SERIES_CODE+" id='potran_"+incemntval+"'><input type='hidden' value="+getData.SERIES_CODE+" id='povrno_"+incemntval+"'><input type='hidden' value="+getData.SLNO+" id='poslno_"+incemntval+"'><input type='hidden' value="+getData.DORDERBID+" id='pobodyid_"+incemntval+"'><input type='hidden' value="+getData.DORDERHID+" id='poheadid_"+incemntval+"_"+incemntval+"'><input type='hidden' value='"+getData.REMARK+"' id='poitmdisciptn_"+incemntval+"'><input type='text' id='itemcode_"+incemntval+"' name='itemco' class='form-control textheight'  value='"+getData.ITEM_CODE+"-"+getData.ITEM_NAME+"' readonly><div class='tooltiptextitem tooltiphide' id='itemNameTooltip_"+incemntval+"'></div><input type='hidden' value="+getData.ODC+" id='taxCodeI_"+incemntval+"'></div><div class='box10 rateIndbox'><input type='text' id='cpCode_"+incemntval+"' name='qtyOrder' class='form-control rightcontent textheight' value="+getData.CP_CODE+"-"+getData.CP_NAME+" readonly></div><div class='box10 rateIndbox'><input type='text' id='toPlace_"+incemntval+"' name='qtyOrder' class='form-control rightcontent textheight' value="+getData.TO_PLACE+" readonly></div><div class='box10 rateIndbox'><input type='text' id='qtyOreder_"+incemntval+"' name='qtyOrder' class='form-control rightcontent textheight' value="+plan_qty+" readonly></div><div class='box10 rateIndbox'><input type='text' id='qtyum_"+incemntval+"' name='qtyOrder' class='form-control rightcontent textheight' readonly value="+getData.um+" ></div></div></div>";

                      $('#itemListShow_1').append(tableBody);

                      $('#itemNameTooltip_'+incemntval).removeClass('tooltiphide');

                     $('#itemNameTooltip_'+incemntval).html(getData.ITEM_NAME);

                     // getItemForCheckQty(itemId,incemntval);

                      inval = incemntval;

                      incemntval++;

                      });
                    
                  

                  var butn =  $('#footer_item_1').find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                          var tablefooter = "<button type='button' class='btn btn-primary btn-sm' style='width: 5%;' id='ApplyOkitmbtn1' onclick='getCheckValue();'>Ok</button><button type='button' class='btn btn-danger notshowcnlbtn btn-sm' data-dismiss='modal' style='width: 8%;'>Cancel</button>";

                            $('#footer_item_1').append(tablefooter);

                         }else{

                         }

                       }

              }else{
                $("#deliveryList1").empty();
                $("#do_no1").val('');


              }

          }

    });

}

</script>

<!-- <script type="text/javascript">
  
  function getCheckValue(){

    alert('hi');

  }
</script>
 -->
<script type="text/javascript">
  
  function getCheckValue(){


  //  alert('hi');return false;

    var i = 0;
    var arr = [];

      var do_no = [];
      var ItemCode = [];
      var toplace = [];
      var cpCode = [];
      var chekqty = 0;
      var chekAqty = 0;
      var sl_no =[];


       $('.ads_Checkbox:checked').each(function () {
          //arr[i++] = $(this).val();
          var slno = i + 1;
          var getvalue = $(this).val();

           var dono     = $("#doOrderno_"+getvalue).val();
           var do_date     = $("#doOrederDt_"+getvalue).val();
          // var toplace     = $("#doOrderno_"+getvalue).val();
           do_no = dono;
           var item_code = $("#itemcode_"+getvalue).val();
           var alise_item_code = $("#aliseitemcode_"+getvalue).val();

           var item_desc = $("#itemdesc_"+getvalue).val();
           var cp_code = $("#cpCode_"+getvalue).val();
           
           var cp_name= $("#cpName_"+getvalue).val();
           var acatg_code = $("#ACatgCode_"+getvalue).val();
           var rcomp_code = $("#RcompCode_"+getvalue).val();
           var rcomp_name = $("#RcompName_"+getvalue).val();
           var sp_code= $("#spCode_"+getvalue).val();
           var sp_name= $("#spName_"+getvalue).val();
           var to_place = $("#toPlace_"+getvalue).val();
           toplace = to_place;
           var dosl_no = $("#poslno_"+getvalue).val();
           var ewaybill_no = $("#ewaybill_no_"+getvalue).val();
           var ewaybill_dt = $("#ewaybill_dt_"+getvalue).val();
           var Invc_no = $("#Invc_no_"+getvalue).val();
           var Invc_dt = $("#Invc_dt_"+getvalue).val();
           var wagon_no = $("#wagon_no_"+getvalue).val();
           var delivery_no = $("#delivery_no_"+getvalue).val();
           var gross_wt = $("#gross_wt_"+getvalue).val();
           var do_headId = $("#doHeadId_"+getvalue).val();
           var do_bodyId = $("#doBodyId_"+getvalue).val();
           var do_batch_no = $("#do_batch_no_"+getvalue).val();

           var customer_code = $("#account_code").val();
           var customer_name = $("#accountName").val();

          //  alert(Invc_no);


           var getItem =  item_code.split("-");
           var itemCode = getItem[0];
           var itemName = getItem[1];

           ItemCode = itemCode;


           var getaliseItem =  alise_item_code.split("~");
           var aliseitemCode = getaliseItem[0];
           var aliseitemName = getaliseItem[1];

           //var do_no   = $("#doOrderno_"+getvalue).val();
           var qty_order = $("#qtyOreder_"+getvalue).val();

           chekqty += parseFloat(qty_order);

           var qtyum    = $("#qtyum_"+getvalue).val();

           if(qtyum){

            var qty_um = qtyum;
           }else{ 
            var qty_um ='';
           }

           var Aqty    = $("#Aqty_"+getvalue).val();
           chekAqty += parseFloat(Aqty);

           var qtyaum    = $("#qtyaum_"+getvalue).val();

           if(qtyaum){

            var qty_aum = qtyaum;
           }else{ 
            var qty_aum ='';
           }



          /* if(qty_um_data==null){

              var qty_um = '';
           }else{

              var qty_um = qty_um_data;
           }*/

           if(i==0){

              $("#do_no"+slno).val(do_no);
              $("#delorder_date"+slno).val(do_date);
              $("#ItemCodeId"+slno).val(itemCode);
              $("#Item_Name_id"+slno).val(itemName);
              $("#aliseItem_code"+slno).val(aliseitemCode);
              $("#aliseItem_Name"+slno).val(aliseitemName);

              $("#remark"+slno).val(item_desc);
              $("#qty"+slno).val(qty_order);
              $("#pre_qty"+slno).val(qty_order);
              $("#UnitM"+slno).val(qty_um);
              $("#Aqty"+slno).val(Aqty);
              $("#UnitAUM"+slno).val(qty_aum);
              $("#consignee"+slno).val(cp_code);
              $("#to_place"+slno).val(to_place);
              $("#slnodo"+slno).val(dosl_no);
              $("#item_slno"+slno).val(dosl_no);
              $("#consineeName"+slno).val(cp_name);
              $("#acatgory_code"+slno).val(acatg_code);
              $("#rcomp_code"+slno).val(rcomp_code);
              $("#rcomp_name"+slno).val(rcomp_name);

              $("#sp_code"+slno).val(sp_code);
              $("#spName"+slno).val(sp_name);
              $("#ewaybill_no"+slno).val(ewaybill_no);
              $("#ewaybill_dt"+slno).val(ewaybill_dt);
              $("#Invc_no"+slno).val(Invc_no);
              $("#Invc_dt"+slno).val(Invc_dt);
              $("#wagon_no"+slno).val(wagon_no);
               $("#delivery_no"+slno).val(delivery_no);
              $("#gross_wt"+slno).val(gross_wt);
              $("#do_headId"+slno).val(do_headId);
              $("#do_bodyId"+slno).val(do_bodyId);
              $("#do_batch_no"+slno).val(do_batch_no);

               cpCode.push(cp_code);
               sl_no.push(slno);
              

               $("#ItemCodeId"+slno).prop('readonly',true);
               $("#consignee"+slno).prop('readonly',true);
               $("#sp_code"+slno).prop('readonly',true);
               $("#to_place"+slno).prop('readonly',true);
               $("#do_no"+slno).prop('readonly',true);

           }else{
               cpCode.push(cp_code);
               sl_no.push(slno);

            var tr_Data = "<tr class='useful'><td class='tdthtablebordr'><input type='checkbox' class='case' /></td><td class='tdthtablebordr'><small id='snumm"+slno+"' style='width: 10px;'>"+slno+".</small></td> <td class='tdthtablebordr' style='width: 10%;'><input list='custList"+slno+"' class='inputboxclr getAccNAme inputwidth'  name='custCode[]' value='"+customer_code+"' id='custCode"+slno+"'   placeholder='Customer Code' onchange='getRowDoDetailsByCust("+slno+")'  autocomplete='off'><datalist id='custList"+slno+"'>@foreach ($getacc as $key)<option value='<?php echo $key->ACC_CODE?>'  data-xyz='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo '['.$key->ACC_CODE.']'; ?></option>@endforeach</datalist></td><td class='tdthtablebordr' style='width: 10%;'><input type='text' class='inputboxclr getAccNAme inputwidth'  name='custName[]' id='custName"+slno+"' value='"+customer_name+"'   placeholder='Customer Name'  autocomplete='off'></td><td class='tdthtablebordr doorderNo'><input list='deliveryList"+slno+"' class='inputboxclr inputwidth getAccNAme'  name='do_no[]' id='do_no"+slno+"' value='"+dono+"'  placeholder='Select Do No' onchange='getDoDetials("+slno+")' autocomplete='off'> <datalist id='deliveryList"+slno+"'></datalist><input type='hidden' name='delorder_date[]' id='delorder_date"+slno+"' value='"+do_date+"'><input type='hidden' name='slnodo[]' id='slnodo"+slno+"' value='"+dosl_no+"'></td><td class='tdthtablebordr tooltips' style='width: 25px;'><div class='input-group'><input list='ItemList1' class='inputboxclr'  id='ItemCodeId"+slno+"' name='item_code[]' value='"+itemCode+"'  oninput='this.value = this.value.toUpperCase()' readonly=' onchange='getItemQty("+slno+")' autocomplete='off' placeholder='Select Item Code' /><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+slno+"'></small><datalist id='ItemList"+slno+"'></datalist><br></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail"+slno+"' data-toggle='modal' data-target='#view_detail"+slno+"'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button></td><td class='tdthtablebordr tooltips'><input type='hidden' class='inputboxclr getAccNAme inputwidth'  id='Item_Name_id"+slno+"' name='item_name[]' value='"+itemName+"' placeholder='Enter Item Name' readonly /><input type='text' class='inputboxclr inputwidth' id='aliseItem_code"+i+"' value='"+aliseitemCode+"' name='alise_item_code[]' placeholder='Enter Item Name' readonly /><input type='hidden' class='inputboxclr inputwidth' id='aliseItem_Name"+i+"' value='"+aliseitemName+"' name='alise_item_name[]' placeholder='Enter Item Name' readonly /> </br><textarea type='text' class='inputboxclr inputwidth getAccNAme' style='height: 20px;' id='remark"+slno+"' name='remark[]' placeholder='Enter Description' row='0' autocomplete='off'>"+item_desc+"</textarea><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+slno+"'></small><input type='hidden' name='do_qty[]' value='"+qty_order+"' id='do_qty"+slno+"'></td><td class='tdthtablebordr' style='width: 20%;'><input list='ConsineeList"+slno+"' class='inputboxclr  inputwidth'  id='consignee"+slno+"' name='consignee[]' placeholder='Consinee Code'  onchange='consigneeName("+slno+")' value='"+cp_code+"'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><datalist id='ConsineeList"+slno+"'>@foreach ($getacc as $key)<option value='<?php echo $key->ACC_CODE?>'  data-xyz='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo '['.$key->ACC_CODE.']'; ?></option>@endforeach</datalist><div style='margin-top:2px;'><input type='text' class='inputboxclr inputwidth' name='consineeName[]' id='consineeName"+slno+"' value='"+cp_name+"' autocomplete='off' readonly placeholder='Consinee Name'><input type='hidden' class='inputboxclr inputwidth' name='consineeAdd[]' id='consineeAdd"+slno+"' autocomplete='off' readonly placeholder='Consinee Add'><input type='hidden' class='inputboxclr inputwidth' name='region[]' id='region"+slno+"' autocomplete='off' readonly placeholder='region'><input type='hidden' class='inputboxclr inputwidth' name='acatgory_code[]' id='acatgory_code"+slno+"' value='"+acatg_code+"' autocomplete='off' readonly placeholder='Consinee Name'><input type='hidden' class='inputboxclr inputwidth' name='rcomp_code[]' id='rcomp_code"+slno+"' value='"+rcomp_code+"' autocomplete='off' readonly placeholder='Consinee Name'><input type='hidden' class='inputboxclr inputwidth' name='rcomp_name[]' id='rcomp_name"+slno+"' value='"+rcomp_name+"' autocomplete='off' readonly placeholder='Consinee Name'></div></td><td class='tdthtablebordr' style='width: 10%;'><input list='SpList"+slno+"' class='inputboxclr  inputwidth'  id='sp_code"+slno+"' name='sp_code[]' value='"+sp_code+"' placeholder='Sp Code'  onchange='spName("+slno+")'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><datalist id='SpList"+i+"'>@foreach ($getacc as $key)<option value='<?php echo $key->ACC_CODE?>'  data-xyz='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo '['.$key->ACC_CODE.']'; ?></option>@endforeach</datalist><div style='margin-top:2px;'><input type='text' class='inputboxclr inputwidth' name='spName[]' id='spName"+i+"' autocomplete='off' value='"+sp_name+"' readonly placeholder='Sp Name'><input type='hidden' class='inputboxclr inputwidth' name='ewaybill_no[]' id='ewaybill_no"+i+"' value='"+ewaybill_no+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='ewaybill_dt[]' value='"+ewaybill_dt+"' id='ewaybill_dt"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='Invc_dt[]' value='"+Invc_dt+"' id='Invc_dt"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='wagon_no[]' value='"+wagon_no+"' id='wagon_no"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='do_headId[]' value='"+do_headId+"' id='do_headId"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='do_bodyId[]' value='"+do_bodyId+"' id='do_bodyId"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='delivery_no[]' value='"+delivery_no+"' id='delivery_no"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='gross_wt[]' value='"+gross_wt+"' id='gross_wt"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='do_batch_no[]' value='"+do_batch_no+"' id='do_batch_no"+i+"' autocomplete='off' readonly></div></td><td class='tdthtablebordr' style='width: 15%;'><input type='text' class='inputboxclr  inputwidth rightcontent'  id='item_slno"+i+"' style='width: 70px;' name='item_slno[]' placeholder='Item Slno' value='"+dosl_no+"'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' /></td><td class='tdthtablebordr doorderNo'><input type='text' class='inputboxclr inputwidth' name='Invc_no[]' value='"+Invc_no+"' id='Invc_no"+i+"' autocomplete='off' readonly></td><td class='tdthtablebordr tooltips'><input list='toplaceList"+slno+"' class='inputboxclr inputwidth'  id='to_place"+slno+"' name='to_place[]' onchange='toPlaceW("+slno+");'  autocomplete='off' value='"+to_place+"' oninput='this.value = this.value.toUpperCase()'  placeholder='Select To Place'/><datalist id='toplaceList"+slno+"'></datalist></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input type='text' class='dr_amount inputboxclr inputwidth  getqtytotal quantityC moneyformate qtyclc rightcontent'  id='qty"+slno+"' style='width:65px;' name='qty[]' value='"+qty_order+"' oninput='Getqunatity("+slno+")'  placeholder='Enter Qty' autocomplete='off'/><input type='hidden'   id='pre_qty"+slno+"' style='width:65px;' name='pre_qty[]' value='"+qty_order+"' oninput='Getqunatity("+slno+")'  placeholder='Enter Qty' autocomplete='off'/><input type='hidden' id='qtyget"+slno+"' class='totlqty'><input list='umList"+i+"' name='unit_M[]' id='UnitM"+slno+"' value='"+qty_um+"' class='inputboxclr  AddM' autocomplete='off'><datalist id='umList"+i+"'><?php foreach($um_list as $key) { ?><option value='<?= $key->UM_CODE ?>' data-xyz='<?= $key->UM_NAME ?>'><?= $key->UM_CODE ?> - <?= $key->UM_NAME ?></option><?php  } ?></datalist><input type='hidden' id='Cfactor"+slno+"'></div><div><small id='errmsgqty"+slno+"'></small></div></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;'><input type='text' class='dr_amount inputboxclr inputwidth  getqtytotal quantityC moneyformate qtyclc rightcontent'  id='Aqty"+slno+"' name='Aqty[]' value='"+Aqty+"' oninput='Getqunatity("+slno+")'  placeholder='Enter Qty' style='width:65px;' autocomplete='off'/><input type='hidden' id='qtyget"+slno+"' class='totlqty'><input  list='aumList"+i+"' name='unit_AUM[]' id='UnitAUM"+slno+"' value='"+qty_aum+"' class='inputboxclr  AddM' autocomplete='off'><datalist id='aumList"+i+"'><?php foreach($um_list as $key) { ?><option value='<?= $key->UM_CODE ?>' data-xyz='<?= $key->UM_NAME ?>'><?= $key->UM_CODE ?> - <?= $key->UM_NAME ?></option><?php  } ?></datalist><input type='hidden' id='Cfactor"+slno+"'></div><div><small id='errmsgqty"+slno+"'></small></div></td></tr>";
            $('table').append(tr_Data);




              /*$("#ItemCodeId"+slno).prop('readonly',false);
               $("#consignee"+slno).prop('readonly',false);
               $("#sp_code"+slno).prop('readonly',false);
               $("#to_place"+slno).prop('readonly',false);*/



           }

           

       i++; });

      /*console.log('to_place',toplace);

      console.log('cpCode',cpCode);*/


      //alert(cpCode);

      $("#head_toplace").val(toplace);

        //console.log(chekqty);

         $("#basicTotal").val(chekqty.toFixed(3));
         $("#basicAqtyTotal").val(chekAqty.toFixed(3));

      /* gr_amt =0;
       $(".getqtytotal").each(function () {
       
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 = parseFloat(qtyval);
                gr_amt += parseFloat(this.value);

                
            }

            $("#basicTotal").val(gr_amt.toFixed(3));
           

        });*/

        //alert(ItemCode);

      //  $('#allItemShow1').modal('hide');
        $('#allDoShow').modal('hide');
        $('#doDetailsBtn').prop('disabled',true);
        $('#doublepoint').prop('disabled',true);
        $('#vehicle_no').prop('readonly',false);

        $.ajax({

            url:"{{ url('get-item-delivery-order-qty') }}",

             method : "POST",

             type: "JSON",

             data: {ItemCode: ItemCode,do_no:do_no,cpCode:cpCode},

             success:function(data){

                console.log('gtadata',data);

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                     $("#qty"+srno).val('');
                    $("#basicTotal").val('');
                  }else if(data1.response == 'success'){

                   
                    

                    if(data1.data==''){

                    }else{


                      $('#Plant_code').val(data1.data[0].PLANT_CODE);
                      $('#plantname').val(data1.data[0].PLANT_NAME);
                      $('#profitctrId').val(data1.data[0].PFCT_CODE);
                      $('#pfctName').val(data1.data[0].PFCT_NAME);
                      $('#from_place').val(data1.data[0].FROM_PLACE);
                      
                       
                      if(data1.trip_data=='' || data1.trip_data==null){

                          $("#trip_day").val('');

                        }else{

                          $("#trip_day").val(data1.trip_data.TRIP_DAYS);

                        }

                        if(data1.offday_data=='' || data1.offday_data==null){
                          $("#off_days").val('');
                        }else{
                          $("#off_days").val(data1.offday_data[0].OFF_DAYS);
                        }
                      

                        if(data1.cp_address=='' || data1.cp_address==null){

                        }else{

                            
                          var sr_no = 0;
                          $.each(data1.cp_address, function(k, getData){

                                  console.log('slno',sl_no[sr_no]);


                                  $("#consineeAdd"+sl_no[sr_no]).val(getData.ADD1);
                                  $("#region"+sl_no[sr_no]).val(getData.STATE_CODE);
                               // console.log('cp_address',getData.ADD1);

                         sr_no++; });
                        }

                    }

                   
                        
                  }
             }

          });


      /*$.ajax({

        url:"{{ url('get-do-details-do-order') }}",

        method : "POST",

        type: "JSON",

        data: {do_no: do_no},

        success:function(data){

          var data1 = JSON.parse(data);


          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){
            //console.log('data1.data[0]',data1.data[0]);
            if(data1.data == ''){
                 var profitctr = '';
                 var pfctget = '';
                 var pfctName = '';
                 var statec = '';
                 $('#profitctrId').val(profitctr);
              
              }else{
                $('#Plant_code').val(data1.data[0].PLANT_CODE);
                $('#plantname').val(data1.data[0].PLANT_NAME);
                $('#profitctrId').val(data1.data[0].PFCT_CODE);
                $('#pfctName').val(data1.data[0].PFCT_NAME);
                $('#from_place').val(data1.data[0].FROM_PLACE);
                $('#trip_day').val(data1.data_trip.TRIP_DAYS);
                //$('#trip_day').val(data1.data_trip.TRIP_DAYS);
             
               

              }

          }

        }

      });*/

       
  }

</script>

<script type="text/javascript">
  
  function getDoDetailsByCust(){

   var account_code = $("#account_code").val();

   if (account_code=='') {
      $('#account_code').css('border-color','#ff0000').focus();
   }else{
      $('#account_code').css('border-color','#d2d6de');
      
   }

//alert(do_no);
 

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-do-details-by-customer') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code},

          success:function(data){

            var data1 = JSON.parse(data);

            //console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){


                   $("#deliveryList1").empty();

                  $.each(data1.data, function(k, getData){

                      console.log('qty',);

                      var plan_qty = parseFloat(getData.QTY);
                      var dispacth_qty =parseFloat(getData.DISPATCH_PLAN_QTY);
                      
                      if(plan_qty != dispacth_qty){

                            $("#deliveryList1").append($('<option>',{

                          value:getData.DORDER_NO,

                          'data-xyz':getData.DORDER_NO,
                          text:getData.DORDER_NO+' - '+getData.ITEM_NAME+' - '+getData.CP_NAME+' - '+getData.TO_PLACE


                        }));

                      }
                     
                    
                    

                  })

                
                
              }

          }

    });

  }
</script>

<script type="text/javascript">
  
  function getRowDoDetailsByCust(num){


  var testval = [];
       $('.optionsRadios1:checked').each(function() {
         testval.push($(this).val());
       });

  // alert(testval);

   if(testval=='Without DO'){
     var account_code = $("#custwdoCode"+num).val();

      var xyz = $('#custwdoList'+num+' option').filter(function() {

          return this.value == account_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $("#custCode"+num).val('');
             $("#custName"+num).val('');
             $("#do_no"+num).val('');
             $("#ItemCodeId"+num).val('');
             $("#Item_Name_id"+num).val('');
             $("#remark"+num).val('');
             $("#consignee"+num).val('');
             $("#consineeName"+num).val('');
             $("#item_slno"+num).val('');
             $("#to_place"+num).val('');
             $("#qty"+num).val('');
             $("#UnitM"+num).val('');
             $("#Aqty"+num).val('');
             $("#UnitAUM"+num).val('');
            // $("#do_no1").val('');
          }else{

            $("#custwdoName"+num).val(msg);

          }
   }else{
     var account_code = $("#custCode"+num).val();

      var xyz = $('#custList'+num+' option').filter(function() {

          return this.value == account_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $("#custCode"+num).val('');
             $("#custName"+num).val('');
             $("#do_no"+num).val('');
             $("#ItemCodeId"+num).val('');
             $("#Item_Name_id"+num).val('');
             $("#remark"+num).val('');
             $("#consignee"+num).val('');
             $("#consineeName"+num).val('');
             $("#item_slno"+num).val('');
             $("#to_place"+num).val('');
             $("#qty"+num).val('');
             $("#UnitM"+num).val('');
             $("#Aqty"+num).val('');
             $("#UnitAUM"+num).val('');
            // $("#do_no1").val('');
          }else{

            $("#custName"+num).val(msg);

          }

   }

  
  
  // var account_code = $("#custCode"+num).val();

   //var account_code = $("#custwdoCode"+num).val();

//
   
  
//alert(do_no);
 

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-do-details-by-customer') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code},

          success:function(data){

            var data1 = JSON.parse(data);

            //console.log(data1);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){


                   $("#deliveryList"+num).empty();

                  $.each(data1.data, function(k, getData){

                      console.log('qty',);

                      var plan_qty = parseFloat(getData.QTY);
                      var dispacth_qty =parseFloat(getData.DISPATCH_PLAN_QTY);
                      
                      if(plan_qty != dispacth_qty){

                            $("#deliveryList"+num).append($('<option>',{

                          value:getData.DORDER_NO,

                          'data-xyz':getData.DORDER_NO,
                          text:getData.DORDER_NO+' - '+getData.ITEM_NAME+' - '+getData.CP_NAME+' - '+getData.TO_PLACE


                        }));

                      }
                     
                    
                    

                  })

                
                
              }

          }

    });

  }
</script>

<script type="text/javascript">
  
  function getDoDetailsByCustWdo(){

   var account_code = $("#account_code_wdo").val();

   if (account_code=='') {
      $('#account_code_wdo').css('border-color','#ff0000').focus();
   }else{
      $('#account_code_wdo').css('border-color','#d2d6de');
      
   }

//alert(do_no);
 

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-do-details-by-customer-woitem') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code},

          success:function(data){

            var data1 = JSON.parse(data);

            //console.log(data1);

            console.log(data1.acc_data);

                  $("#off_days").val(data1.acc_data.OFF_DAYS);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){


                   $("#ConsineeList1").empty();
                   $("#SpList1").empty();

                  $.each(data1.data, function(k, getData){

                      console.log('qty',);

                      var plan_qty = parseFloat(getData.QTY);
                      var dispacth_qty =parseFloat(getData.DISPATCH_PLAN_QTY);
                      
                      if(plan_qty != dispacth_qty){

                            $("#ConsineeList1").append($('<option>',{

                          value:getData.CP_CODE,

                          'data-xyz':getData.CP_NAME,
                          text:getData.CP_CODE+' - '+getData.CP_NAME


                        }));

                            $("#SpList1").append($('<option>',{

                          value:getData.SP_CODE,

                          'data-xyz':getData.SP_NAME,
                          text:getData.SP_CODE+' - '+getData.SP_NAME


                        }));

                      }
                     
                    
                    

                  })

                
                
              }

          }

    });

  }
</script>

<script type="text/javascript">
  
  function getcityName(srno){

   var consinee_add = $("#consigneeadd"+srno).val();
   var consinee     = $("#consignee_wdo"+srno).val();


   var xyz = $('#ConsineeAddList'+srno+' option').filter(function() {

          return this.value == consinee_add;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //console.log(msg);

          if(msg=='No Match'){

            $("#cp_address"+srno).val('');
            $("#to_place_wdo"+srno).val('');
            $("#to_place"+srno).val('');
           $("#to_place"+srno).prop('readonly',true);

          }else{

           $("#cp_address"+srno).val(msg);
           $("#to_place"+srno).prop('readonly',false);
          }

 

         var cp_address_code =  $("#cp_address"+srno).val();



    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });



    $.ajax({

            url:"{{ url('get-city-name-by-adress') }}",

            method : "POST",

            type: "JSON",

            data: {consinee:consinee,cp_address_code:cp_address_code},

            success:function(data){

              //console.log(data);

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){

                  if(data1.data==''){

                   

                    $("#cityMsg").html('CITY NOT ASSIGN FOR THIS PARTY').css('color','red');

                  }else{


                    $("#to_place_wdo"+srno).val(data1.data.CITY_NAME);
                    $("#head_toplace").val(data1.data.CITY_NAME);
                    $("#cityMsg").html('');

                  }

                    

                }

            }

          });



  }

</script>



<script type="text/javascript">

  function consigneeName(num){

   // alert(num);

         //  var val = $("#consignee"+num).val();

           var sp_code = $("#consignee_wdo"+num).val();


          var xyz = $('#ConsineeList_wdo'+num+' option').filter(function() {

          return this.value == sp_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg){

            $("#consineeName_wdo"+num).val(msg);
            $("#ItemCodeId"+num).prop('readonly',false);

          }else{

            $("#consineeName_wdo"+num).val('');

          }

            $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

          });


      $.ajax({

        url:"{{ url('get-consinee-address-by-acc') }}",

        method : "POST",

        type: "JSON",

        data: {sp_code:sp_code},

        success:function(data){

          var data1 = JSON.parse(data);


          console.log(data1.data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
            $("#consigneeadd_wdo"+num).val('');

          }else if(data1.response == 'success'){
            //console.log('data1.data[0]',data1.data[0]);
            if(data1.data == ''){
                
              
                
                 $("#consigneeadd_wdo"+num).val('');
              }else{

              //  $('#profitctrId').val(data1.data[0].PFCT_CODE);

               // console.log(data1.data[0].CPCODE);

                    $("#ConsineeAddList"+num).empty();


                    $.each(data1.data, function(k, getData){

                    $("#ConsineeAddList"+num).append($('<option>',{

                          value:getData.ADD1,

                          'data-xyz':getData.CPCODE,
                          text:getData.ADD1


                        }));

                  });

              }

           
          }

        }

      });

  }
</script>
@endsection