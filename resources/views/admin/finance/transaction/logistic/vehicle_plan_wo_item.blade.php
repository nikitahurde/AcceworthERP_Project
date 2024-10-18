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

            Trip Plan Without Item
 
            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Logistics</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Add Vehicle Trip Plan Without Item</a></li>

          </ol>

        </section>


<form id="salesordertrans">
      @csrf
  <section class="content">

    <div class="row">

       

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add Trip Plan Without Item</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-fleet') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Trip Plan Without Item</a>

              </div>

              

                  <div class="box-tools pull-right">

                    <a href="{{ url('/view-vehicle-planing-mast') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Trip Plan Without Item</a>

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
            
                

                    <div class="col-md-2 withDo">

                        <div class="form-group">

                          <label>Customer Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="" placeholder="Select Customer"  autocomplete="off" onchange="getDoDetailsByCust()"> 

                              <datalist id="AccountList">

                              
                                @foreach ($getacc_do as $key)

                               <option value='<?php echo $key->ACC_CODE?>'  data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                            <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                            <small id="acccode_code_errr" style="color: red;"></small>

                            <!--  <input type="hidden" name="rake_no" id="rake_no" value=""> -->

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
                
                              <input list="AccountList_wdo"  id="account_code_wdo" name="AccCodeWdo" class="form-control  pull-left" value="" placeholder="Select Customer"  autocomplete="off" > 

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

                       <div class="col-md-2 ">

                        <div class="form-group">

                          <label>Rake No : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="rake_list"  id="rake_no" name="rake_no" class="form-control  pull-left" value="" placeholder="Select Rake"  autocomplete="off" onchange="getCpCodeByRakeAcc()"> 

                              <datalist id="rake_list">

                              
                              </datalist>



                            </div>



                            <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                            <small> <div class="pull-left showSeletedName" id="AccountText"></div> </small>

                            <small id="acccode_code_errr" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="input-group" style="display: none;">

                      <input type="radio" class="optionsRadios1" name="do_type" value="With DO" checked="">&nbsp;&nbsp;<span style="font-weight: 700 !important;font-size: 12px !important;">With DO.</span> &nbsp;&nbsp;

                      <input type="radio" class="optionsRadios1" name="do_type" id="doublepoint" value="Without DO" >&nbsp;&nbsp<span style="font-weight: 700 !important;font-size: 12px !important;">Without DO.<span>


                    </div>

              </div> <!-- row -->

               <div class="row">

                   
                              <input type="hidden" class="form-control" name="fsorder_no" value="" id="fsorder_no" placeholder="Enter Freight Sale No" readonly autocomplete="off">

                               <input type="hidden" class="form-control" name="sale_rate" value="" id="sale_rate" placeholder="Enter Sale Rate" readonly autocomplete="off">
                              <input type="hidden" class="form-control" name="fsohid" value="" id="fsohid" placeholder="Enter Sale Rate" readonly autocomplete="off">
                              <input type="hidden" class="form-control" name="fsobid" value="" id="fsobid" placeholder="Enter Sale Rate" readonly autocomplete="off">


                              <input type="hidden" class="form-control" name="sale_qty" value="" id="sale_qty" placeholder="Enter Sale Qty" readonly autocomplete="off">


                                
                       

                <!-- /.col -->

                

              </div>

            
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
                    <th class="withDo">SOLD TO PARTY</th>
                    <th class="withDo">SHIP TO PARTY</th>
                    <th class="withDo">ADDRESS</th>
                    <th class="withDo">TO PLACE</th>
                    <th>QTY</th>
                    <th>AQTY</th>
                   
                   
                  </tr>

                  <tr class="useful" id="first_Row">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10%;">1.</span>
                    </td> 

                   

                     <td class="tdthtablebordr withDo" style="width: 20%;">

                     
                      
                       <input list="ConsineeList1" class="inputboxclr  inputwidth"  id='consignee1' name="consignee[]" placeholder="SOLD TO PARTY" onchange="getcpName(1)"   oninput="this.value = this.value.toUpperCase()" autocomplete='off' readonly="" />

                       <datalist id="ConsineeList1">

                              
                                @foreach ($getacc as $key)

                               <option value='<?php echo $key->ACC_CODE?>'  data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?></option>

                                @endforeach

                      </datalist>

                       <div style='margin-top:2px;'>
                        <input type="text" class="inputboxclr inputwidth" name="consineeName[]" id="consineeName1" autocomplete='off' readonly placeholder="Consinee Name">
                       </div>

                  
                    </td>

                   

                    <td class="tdthtablebordr withDo" style="width: 20%;">

                     
                      
                       <input list="SpList1" class="inputboxclr  inputwidth"  id='sp_code1' name="sp_code[]" placeholder="SHIP TO PARTY"   onchange="consigneeName(1)"  oninput="this.value = this.value.toUpperCase()" autocomplete='off'  readonly=""/>

                       <datalist id="SpList1">

                              
                                @foreach ($getacc as $key)

                               <option value='<?php echo $key->ACC_CODE?>'  data-xyz="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo "[".$key->ACC_CODE."]"; ?></option>

                                @endforeach

                      </datalist>

                       <div style='margin-top:2px;'>
                        <input type="text" class="inputboxclr inputwidth" name="spName[]" id="spName1" autocomplete='off' readonly placeholder="Sp Name">
                        <input type="hidden" class="inputboxclr inputwidth" name="ewaybill_no[]" id="ewaybill_no1" autocomplete='off' readonly placeholder="Sp Name">
                        <input type="hidden" class="inputboxclr inputwidth" name="ewaybill_dt[]" id="ewaybill_dt1" autocomplete='off' readonly placeholder="Sp Name">
                       </div>

                   
                     
                    </td>

                      <td class="tdthtablebordr" style="width: 20%;">
                      <div class="input-group">
                       <input list="ConsineeAddList1" class="inputboxclr" style="width: width: 139px;" id='consigneeadd1' name="consigneeadd[]" onchange="getcityName(1)"  oninput="this.value = this.value.toUpperCase()" autocomplete='off' placeholder="ADDRESS" />

                       <datalist id="ConsineeAddList1">
                        </datalist>


                     </div>

                     <input type="hidden" name="cp_address1" id="cp_address1" value="">
                      
                    </td>


                     <td class="tdthtablebordr tooltips withDo" style="width: 20%;">

                       

                       <input list="toplaceList1" class="inputboxclr inputwidth"  id='to_place1' name="to_place[]"  onchange="toPlaceW(1);" autocomplete='off' oninput="this.value = this.value.toUpperCase()"  placeholder="Select To Place" readonly=""/>

                       <datalist id="toplaceList1">
                       
                          <?php foreach ($area_list as $key) { ?>

                              <option value="<?= $key->CITY_NAME ?>" data-xyz="<?= $key->CITY_CODE ?>"><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option>

                            <?php } ?>

                      </datalist>
                     
                      
                       <input type="hidden" name="body_to_place1" id="body_to_place1" value="">
                       <small id="toplaceMsg" style="color:red;"></small>
                     </td>
                   

                    <td class="tdthtablebordr" style="width: 15%;">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="dr_amount inputboxclr  inputwidth getqtytotal quantityC moneyformate qtyclc rightcontent"  id='qty1' name="qty[]" oninput='Getqunatity(1)' value='' style="width: 65px;"  placeholder='Enter Qty' autocomplete="off"  />
                      <input type="hidden" id="qtyget1" class="totlqty">
                      <input list="umList1" name="unit_M[]"  style="width: 40px;" id="UnitM1" class="inputboxclr  AddM" autocomplete="off" placeholder="UM">

                      <datalist id="umList1">
                        <?php foreach($um_list as $key) { ?>
                          
                          <option value="<?= $key->UM_CODE ?>" data-xyz="<?= $key->UM_NAME ?>"><?= $key->UM_CODE ?> - <?= $key->UM_NAME ?></option>

                       <?php  } ?>
                      </datalist>

                      <input type="hidden" id="Cfactor1">

                      </div>
                       <div><small id="errmsgqty1"></small></div>

                    </td>

                    <td class="tdthtablebordr" style="width: 15%;">

                      <div style="display: inline-flex;border: none;">

                      <input type='text' class="dr_amount inputboxclr  inputwidth getqtytotal quantityC moneyformate qtyclc rightcontent"  id='Aqty1' name="Aqty[]" oninput='Getqunatity(1)' style="width: 65px;" value=''  placeholder='Enter Qty' autocomplete="off"  />
                      <input type="hidden" id="qtyget1" class="totlqty">
                      <input list="aumList1" name="unit_AUM[]" style="width: 40px;" id="UnitAUM1" class="inputboxclr  AddM" autocomplete="off" placeholder="AUM">

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

                  <button type="button" class="btn btn-danger btn-sm delete" id="deletehidn" disabled=""><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>
                  <button type="button" class="btn btn-info btn-sm addmore" id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

              </div>

              <div class="col-md-4">
                 <p style="text-align:center;"><small id="doqtyerr"></small></p>
              </div>

              <div class="col-md-4">

                  <div style="display: flex;float: right;">
                      <div class="toalvaldesn" style="margin-top: 5%;">Total :</div>
                      <input class="debitcreditbox inputboxclr" type="text" name="TotlDebit" id="basicTotal"  readonly="" style="width: 98px;">

                       <input type="hidden" name="basicTotalTemp" id="basicTotalTemp" value="">
                       <input type="hidden" name="sr_flag" id="sr_flag" value="0">
                       
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
                              
                              <input list="PlantcodeList" class="form-control" id="Plant_code" name="plant_code" placeholder="Select Plant" maxlength="11" value=""  autocomplete="off" onchange="PlantCode()" readonly>

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

                      <label>

                       From Place: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input list="fromplaceList" class="form-control" name="from_place" id="from_place"  value="{{ $from_place }}" placeholder="Enter From Place" autocomplete="off" readonly="" />

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

                          <input list="offdaysList" class="form-control" name="off_days" id="off_days"  value="" placeholder="Enter Off Days" autocomplete="off" readonly="">

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
                                
                              <option value="<?= $key->TRUCK_NO ?>" data-xyz='<?= $key->TRUCK_NO ?>'><?= $key->TRUCK_NO ?> - <?= $key->OWNER ?></option>

                              <?php   } ?>

                            </datalist>

                           <span class="input-group-addon" style="padding: 1px 7px;">
                            
                            <div class="">
                              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-backdrop="static" style="font-size: 10px !important;"><i class="fa fa-plus 2xs"></i></button>
                            </div>
                            
                            
                          </span>
                          

                           
                        </div>
                          <small id="vehicleErr1msg" style="color:red;"></small>
                          <small id="vehicleErrDubmsg" style="color:red;"></small>
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
<!-- 
                                        <option value="SELF" data-xyz="SELF">SELF</option>
                                        <option value="MARKET" data-xyz="MARKET">MARKET</option>
                                        <option value="DUMP" data-xyz="DUMP">DUMP</option> -->
                                        
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

                                        <option value="<?= $key->FREIGHTTYPE_NAME ?>" data-xyz="<?= $key->FREIGHTTYPE_NAME ?>"><?= $key->FREIGHTTYPE_CODE ?> - <?= $key->FREIGHTTYPE_NAME ?></option>

                                        <?php } ?>
                                        
                                      </datalist>
                                     

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

                                      <input list="typeList" class="form-control" name="adv_type" id="adv_type"  value="" placeholder="Select Adv Type" autocomplete="off" onchange="advanceType();" readonly="" />

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

                                      <input type="text" class="form-control" name="adv_rate" id="adv_rate"  value="" oninput="chnageadvRate();" placeholder="Enter Adv Rate"  autocomplete="off" readonly="" />

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

                                

                                <!-- /.form-group -->

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

                                        <span class="required-field hideclass"></span>

                                      </label>

                                            <div class="input-group">

                                                <span class="input-group-addon">

                                                  <i class="fa fa-caret-right"></i>

                                                </span>

                                              <input type="text" name="vehicle_model"  id="vehicle_model" class="form-control" placeholder="Enter Vehicle Model" autocomplete="off" readonly="">

                                              

                                            </div>

                                      <small id="emailHelp" class="form-text text-muted">

                                        {!! $errors->first('vehicle_model', '<p class="help-block" style="color:red;">:message</p>') !!}

                                      </small>

                                    </div>

                    <!-- /.form-group -->

                          </div>


                          <div class="col-md-4" style="margin-top: 20px;font-weight: bold;">

                                <small id="slrMsg"></small>
                                
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
                 <p class="text-center">

                    <button class="btn btn-success btn-sm" type="button" id="submitdata" onclick="submitData()" disabled=""><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                    <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

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

        <div class="modal-dialog modal-lg" style="margin-top: 1%;width: 72%;">

            <div class="modal-content" style="border-radius: 5px;">

                <div class="modal-header removeSpaceOnModl modal-header--sticky">
                  <div style="text-align: center;">
                    <h4 class="modal-title" id="exampleModalLabel" style="font-weight: 800;color: #3c8dbc;">Do Details</h4>
                  </div>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="padding-top: 9px;">
                    <span aria-hidden="true">&times;</span>
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
                           <th class="text-center">DO DATE</th>
                           <th class="text-center">ITEM CODE/ITEM NAME</th>
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
         /* $.ajax({

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

          });*/


        var series_code =  $("#series_code").val();

         var do_no =  $("#do_no").val();

        if(series_code==''){
        
           $('#series_code').css('border-color','#d2d6de');
        
           $('#series_code').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else if(do_no==''){
        
           $('#do_no').css('border-color','#d2d6de');
        
           $('#do_no').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
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
    var body_to_place = $("#body_to_place"+num).val();
    var sp_code = $("#sp_code"+num).val();
    var cp_address_code =  $("#cp_address"+num).val();


      if(toPlace){

        $("#head_toplace").val(toPlace);
      }else{

         $("#head_toplace").val('');
      }

      if(toPlace == body_to_place){

        $("#sr_flag").val('0');
        $("#slrMsg").html('');
      }else{
         /*$("#sr_flag").val('1');
         $("#slrMsg").html('SUPPLEMENTARY LR WILL BE GENRATED FOR THIS TRIP').css('color','red');*/
      }

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

       $.ajax({

            url:"{{ url('validate-city-name-by-sp-code') }}",

             method : "POST",

             type: "JSON",

             data: {sp_code:sp_code,toPlace:toPlace,cp_address_code:cp_address_code},

             success:function(data){


                  var data1 = JSON.parse(data);

                  if(data1.response=='error'){

                    $("#to_place"+num).val('');
                    $("#toplaceMsg").html('CITY NAME NOT ASIGN FOR THIS CONSINEE IN MASTER');
                    
                  }else{
                    $("#toplaceMsg").html('');
                  }

                 
             }

          });



}

$("#vehicle_owner").bind('change', function () {

  var VehicleOwner =  $(this).val();

  var Vehicle_No =  $("#vehicle_no").val();

  if(Vehicle_No){

    $("#submitdata").prop("disabled",false);
  }else{

    $("#submitdata").prop("disabled",true);
  }

    

  if(VehicleOwner){

    if(VehicleOwner=='DUMP' || VehicleOwner=='SELF'){

    $("#transporter_code,#transporter_name,#fright_order").prop('readonly',true);

    $("#transporter_code,#transporter_name,#fright_order").val('');
    }else{

      $("#transporter_code,#transporter_name,#fright_order").prop('readonly',false);

      $("#transporter_code,#transporter_name").val('');
    }

     //$("#submitdata").prop('disabled',false);

  }else{
    //$("#submitdata").prop('disabled',true);
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
  }else{
    $('#seriesName').val(msg);
     document.getElementById("series_code_errr").innerHTML = '';
     var sers_code = $('#series_code').val();
     $('#getSeriesCode').val(sers_code);
     $('#getSeriesName').val(msg);
     $('#series_code').css('border-color','#d2d6de');
       
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
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.truck_no+'</span><br>');
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
      $('#from_place').prop('readonly',true);
      $('#trip_day').prop('readonly',true);
      $('#off_days').prop('readonly',true);
      $('#vehicle_no').prop('readonly',true);

  }else{
     document.getElementById("plant_err").innerHTML = '';
     $('#plantname').val(msg);
     var plntCode = $('#Plant_code').val();

     $('#account_code').prop('readonly',false);
     //alert(msg);
     $('#getPlantCode').val(plntCode);
     $('#getPlantName').val(msg);
     $('#from_place').prop('readonly',false);
     $('#trip_day').prop('readonly',false);
     $('#off_days').prop('readonly',false);
     $('#vehicle_no').prop('readonly',false);
     
    
  }
  
   //objvalidtn.checkBlankFieldValidation();

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
  function getfsoRate_OLD(){

      var vehicle_no = $("#vehicle_no").val();
      var vr_date    = $("#vr_date").val();
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
  
  function getvehicleOwner(){

  var vehicle_no = $("#vehicle_no").val();
  var from_place = $("#from_place").val();
  var to_place   = $("#head_toplace").val();
  var basicTotal = $("#basicTotal").val();

   var vr_date    = $("#vr_date").val();
  var account_code    = $("#account_code").val();
  var plant_code    = $("#Plant_code").val();


 

 // var getLength = $("#vehicle_no").attr('maxlength','4');
  var maxlength = vehicle_no.length;




if(maxlength >= '8'){


 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-vehicle-owner-by-vehicle-plan-wo-item') }}",

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


                if(data1.fso_rate=='' || data1.fso_rate==null){

                      $("#sale_rate").val('0.00');
                      $("#fsohid").val('');
                      $("#fsobid").val('');
                   }else{

                      $("#sale_rate").val(data1.fso_rate[0].RATE);
                       $("#fsohid").val(data1.fso_rate[0].FSOHID);
                      $("#fsobid").val(data1.fso_rate[0].FSOBID);
                   }

                   if(data1.transporter_data=='' || data1.transporter_data==null){

                       $("#transporter_code").val('');
                      $("#transporter_name").val('');
                   }else{

                      $("#transporter_code").val(data1.transporter_data[0].ACC_CODE);
                      $("#transporter_name").val(data1.transporter_data[0].ACC_NAME);
                   }


                if(data1.last_trip_data=='' || data1.last_trip_data==null){

                        $("#vehicle_owner").val('');
                        $("#vehicle_type").val('');
                        $("#whee_type_name").val('');
                        $("#min_gurrentee").val('');
                        $("#transporter_code").val('');
                        $("#transporter_name").val('');
                       

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


                  if(data1.data=='' || data1.data==null){

                    $('.modalspinner').addClass('hideloaderOnModl');

                      var owner = new Array();
                    owner[0] = 'MARKET';
                   

                    var options = '';


                    for (var i = 0; i < owner.length; i++) {
                      options += '<option value="' + owner[i] + '" />';
                    }

                    document.getElementById('ownerList').innerHTML = options;
                   
                      
                  }else{

                  var vehicle_owner = data1.data.OWNER;
                  var vehicle_type = data1.data.WHEEL_TYPE;
                  var vehicle_model = data1.data.MODEL;

                  $("#vehicle_owner").val(vehicle_owner);
                  $("#vehicle_model").val(vehicle_model);
                  //$("#vehicle_type").val(vehicle_type);
                    
                    console.log('dsf',vehicle_owner);


                  if(vehicle_owner=='SELF'){

       
                    var owner = new Array();
                    owner[0] = 'SELF';
                    owner[1] = 'DUMP';

                    var options = '';

                    for (var i = 0; i < owner.length; i++) {
                      options += '<option value="' + owner[i] + '" />';
                    }

                    document.getElementById('ownerList').innerHTML = options;

                    $("#fright_order,#freight_qty,#rate,#amount,#payment_mode").prop('readonly',true);

                  }else{

                  }
                    

                  var registraion_date = data1.data.REGD_DATE;
                  
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

               /* if(data1.vehicle_trip=='' || data1.vehicle_trip==null){

                }else{

                  var lr_status = data1.vehicle_trip.EPOD_STATUS;

                    if(lr_status==0){

                     $("#vehicle_no").val('');
                      $("#vehicle_owner").val('');
                      
                      $("#vehicleErrmsgModal").modal('show');

	                   $("#vehicleErrmsg").html('<b>DUBLICATE TRIP CAN NOT CREATE FOR THIS VEHICLE </b>');

                     
                    }else{
                      $("#submitData").prop('disabled',false);
                      $("#vehicleErrDubmsg").html('');

                    }

                }*/
                    

                  if(data1.vehicle_info.response == null){
                
                 
                     $("#vehicleErr1msg").html('<b>Vehicle Not Found</b>');
                   
             		}else{


                   $("#vehicleErr1msg").html('');

                  
              
                     var regd_date = data1.vehicle_info.response.regnDate;
                 
                     var cuurnt_date = new Date().toLocaleDateString('fr-CA');


                      var explode1 =   cuurnt_date.split("-");

                      var year1 = explode1[0];


                       var explode2 =   regd_date.split("/");

                      var year2 = explode2[2];

                       var diff_date = year1 - year2;
                            

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


	                     if(basicTotal > fianlValue){

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

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span></td>";

      data +="<td class='tdthtablebordr withDo' style='width: 15%;'><input list='ConsineeList"+i+"' class='inputboxclr  inputwidth'  id='consignee"+i+"' onchange='getcpName("+i+")' name='consignee[]' placeholder='Consinee Code'    oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><datalist id='ConsineeList"+i+"'>@foreach ($getacc as $key)<option value='<?php echo $key->ACC_CODE?>'  data-xyz='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo '['.$key->ACC_CODE.']'; ?></option>@endforeach</datalist><div style='margin-top:2px;'><input type='text' class='inputboxclr inputwidth' name='consineeName[]' id='consineeName"+i+"' autocomplete='off' readonly placeholder='Consinee Name'></div></td><td class='tdthtablebordr withDo' style='width: 10%;'><input list='SpList"+i+"' class='inputboxclr  inputwidth'  id='sp_code"+i+"' onchange='consigneeName("+i+")' name='sp_code[]' placeholder='Sp Code'  onchange='spName("+i+")'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><datalist id='SpList"+i+"'>@foreach ($getacc as $key)<option value='<?php echo $key->ACC_CODE?>'  data-xyz='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME; echo '['.$key->ACC_CODE.']'; ?></option>@endforeach</datalist><div style='margin-top:2px;'><input type='text' class='inputboxclr inputwidth' name='spName[]' id='spName"+i+"' autocomplete='off' readonly placeholder='Sp Name'><input type='hidden' class='inputboxclr inputwidth' name='ewaybill_no[]' id='ewaybill_no"+i+"' autocomplete='off' readonly><input type='hidden' class='inputboxclr inputwidth' name='ewaybill_dt[]' id='ewaybill_dt"+i+"' autocomplete='off' readonly></div></td><td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='ConsineeAddList"+i+"' class='inputboxclr' style='width:139px;' id='consigneeadd"+i+"' name='consigneeadd[]' onchange='getcityName("+i+")'  oninput='this.value = this.value.toUpperCase()' autocomplete='off' /><datalist id='ConsineeAddList"+i+"'></datalist></div><input type='hidden' name='cp_address"+i+"' id='cp_address"+i+"' value=''></td><td class='tdthtablebordr tooltips withDo'><input list='toplaceList"+i+"' class='inputboxclr inputwidth'  id='to_place"+i+"' name='to_place[]' onchange='toPlaceW("+i+");'  autocomplete='off' oninput='this.value = this.value.toUpperCase()'  placeholder='Select To Place'/><datalist id='toplaceList"+i+"'><?php foreach ($area_list as $key) { ?><option value='<?= $key->CITY_NAME ?>' data-xyz='<?= $key->CITY_CODE ?>'><?= $key->CITY_NAME ?> [<?= $key->CITY_CODE ?>]</option><?php } ?></datalist><input type='hidden' name='body_to_place"+i+"' id='body_to_place"+i+"' value=''></td><td class='tdthtablebordr'><div style='display: inline-flex;border: none;margin-bottom: 5px'><input type='text' class='dr_amount inputboxclr  getqtytotal quantityC moneyformate rightcontent' style='width: 65px;'  id='qty"+i+"' name='qty[]' oninput='Getqunatity("+i+")'  placeholder='Enter Qty Name'/><input type='hidden' id='qtyget"+i+"' class='totlqty'><input list='umList"+i+"' name='unit_M[]' style='width: 40px;' id='UnitM"+i+"' class='inputboxclr  AddM'>  <datalist id='umList"+i+"'><?php foreach($um_list as $key) { ?><option value='<?= $key->UM_CODE ?>' data-xyz='<?= $key->UM_NAME ?>'><?= $key->UM_CODE ?> - <?= $key->UM_NAME ?></option><?php  } ?></datalist><input type='hidden' id='Cfactor"+i+"'></div><div><small id='errmsgqty"+i+"'></small></div><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item Name/Item Code</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading'><span id='itemCodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='hsncodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='taxcodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemDetailshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemtypeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemgroupshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemclassshow"+i+"'> </span> </div><div class='box10 itmdetlheading'><span id='itemcategoryshow"+i+"'> </span> </div></div> </div></div> <div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div> </div></div></div></td><td class='tdthtablebordr' style='width: 5%;'><div style='display: inline-flex;border: none;'><input type='text' class='dr_amount inputboxclr  inputwidth getqtytotal quantityC moneyformate qtyclc rightcontent'  id='Aqty"+i+"' name='Aqty[]' oninput='Getqunatity("+i+")' style='width: 65px;' value=''  placeholder='Enter Qty' autocomplete='off'  /><input type='hidden' id='qtyget"+i+"' class='totlqty'><input list='aumList"+i+"' name='unit_AUM[]' style='width: 40px;' id='UnitAUM"+i+"' class='inputboxclr  AddM' autocomplete='off'><datalist id='aumList"+i+"'><?php foreach($um_list as $key) { ?><option value='<?= $key->UM_CODE ?>' data-xyz='<?= $key->UM_NAME ?>'><?= $key->UM_CODE ?> - <?= $key->UM_NAME ?></option><?php  } ?></datalist><input type='hidden' id='Cfactor"+i+"'></div><div><small id='errmsgqty"+i+"'></small></div></td>";

      $('#tbledata').append(data);

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


      i++;



      $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });




  var account_code = $("#account_code").val();
  var rake_no = $("#rake_no").val();

//alert(do_no);
 

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('get-cp-code-by-rake-acc-code') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code,rake_no:rake_no},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log('rake',data1);

            //console.log(data1.data_rake);

                  

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                   //$("#rake_no").val(data1.data[0].RAKE_NO);
                   $("#ConsineeList"+count).empty();
                   $("#SpList"+count).empty();
                   
                  $.each(data1.data, function(k, getData){

                      console.log('qty',);

                      var plan_qty = parseFloat(getData.QTY);
                      var dispacth_qty =parseFloat(getData.DISPATCH_PLAN_QTY);
                      
                      if(plan_qty != dispacth_qty){

                        $("#ConsineeList"+count).append($('<option>',{

                          value:getData.CP_CODE,

                          'data-xyz':getData.CP_NAME,
                          text:getData.CP_CODE+' - '+getData.CP_NAME

                        }));

                      }
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
             $("#vehicle_model").prop('readonly', false);

            if(adv_type=='Percent'){

               var calrate     =   $("#advcal_rate").val();

               var advance_amt =parseFloat(amount) * parseFloat(adv_rate) /100;

               if(parseFloat(advance_amt) > parseFloat(amount)){

                $("#adv_amount").val('');
                $("#adverr").html('adv amount should be less than amount');
                $("#submitdata").prop('disabled', true);

               }else{
                      
                var advanceAmt = Math.round(advance_amt / 1000) * 1000;
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

    if(qty){

      $("#rate").prop('readonly',false);

      var rate = $("#rate").val();

     var amount      =  parseFloat(qty) * parseFloat(rate);

      $("#amount").val(amount.toFixed(2));


    }else{
       $("#rate").prop('readonly',true);


    }


    chnageadvRate();
    

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
            
             
             $("#transporter_name").prop('readonly', false);

            $("#rate").val('');
            $("#amount").val('');
            $("#fright_order").val('');
            $("#mfprate").val('');
            $("#rate_basis").val('');
            $("#freight_qty").val('');
            $("#freight_qty").prop('readonly', true);
            $("#rate").prop('readonly', true);

          }else{

             $("#transporter_name").val(msg);

             $('#transporter_code').css('border-color','#d2d6de');
             $('#payment_mode').css('border-color','#ff0000').focus();
             $("#fright_order").prop('readonly', true);
            
             $("#transporter_name").prop('readonly', true);

             $("#freight_qty").prop('readonly', false);
             $("#rate").prop('readonly', false);
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

      /* $("#vehicle_no").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#vehicleList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

            $("#vehicle_owner").val('');
             $("#vehicle_type").val('');
            $("#transporter_code").val('');
            $("#transporter_name").val('');
            $("#sale_rate").val('');
            $("#fsohid").val('');
            $("#fsobid").val('');
            $("#submitdata").prop('disabled',true);

             
          }else{
            $("#submitdata").prop('disabled',false);
         
          }


        
           

        });*/


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
            $('#account_code').css('border-color','#d2d6de');
            $('#account_code').css('border-color','#ff0000').focus();
             //$("#consignee1").prop('readonly',true);
          }else{

            $('#account_code').css('border-color','#d2d6de');
           
            $("#accountName").val(msg);
            //$("#consignee1").prop('readonly',false);

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


function getcpName(srno){

      var consignee = $("#consignee"+srno).val();
      var acc_code = $("#account_code").val();
      var rake_no = $("#rake_no").val();


    var xyz = $('#ConsineeList'+srno+' option').filter(function() {

          return this.value == consignee;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

        $("#consignee"+srno).val('');

        $("#consineeName"+srno).val('');

        $("#sp_code"+srno).prop('readonly',true);

      }else{

        
        $("#consineeName"+srno).val(msg);
        $("#sp_code"+srno).prop('readonly',false);

        $.ajax({

            url:"{{ url('/get-transport-code-name-by-cpcode') }}",

             method : "POST",

             type: "JSON",

             data: {consignee:consignee,acc_code:acc_code,rake_no:rake_no},

             success:function(data){

               // console.log(data);

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                     $("#qty"+srno).val('');
                    $("#basicTotal").val('');
                  }else if(data1.response == 'success'){

                    if(data1.data==''){

                       $("#transporter_code").val('');
                       $("#transporter_name").val('');
                    }else{

                    
                    }

                      $("#SpList"+srno).empty();

                     $.each(data1.sp_data, function(k, getData){

                       $("#SpList"+srno).append($('<option>',{

                          value:getData.SP_CODE,

                          'data-xyz':getData.SP_NAME,
                          text:getData.SP_CODE+' - '+getData.SP_NAME


                        }));

                  });

                   
                        
                  }
             }

          });

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
             $('#ItemCodeId'+srno).css('border-color','#d2d6de');
             $('#ItemCodeId'+srno).css('border-color','#ff0000').focus();
             $("#addmorhidn").prop('disabled', true);

      }else{

         document.getElementById("Item_Name_id"+srno).value = msg;

          
        $('#itemNameTooltip'+srno).removeClass('tooltiphide'); 

         $('#itemNameTooltip'+srno).html(msg); 

         $('#remark'+srno).prop('readonly',false); 
         $('#qty'+srno).prop('readonly',false); 
         $('#remark'+srno).prop('readonly',false); 
         $('#route_code').prop('readonly',false); 
         $('#vehicle_no').prop('readonly',false); 
         $("#addmorhidn").prop('disabled', false);
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

                    var dispatch_qty = parseFloat(do_qty) - parseFloat(des_plan_qty);

                     $("#qty"+srno).val(dispatch_qty);
                     $("#to_place"+srno).val(to_place);
                     $("#consignee"+srno).val(cp_code);
                     $("#consineeName"+srno).val(cp_name);
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

                     

                      gr_amt =0;
                         $(".getqtytotal").each(function () {
                         
                              if (!isNaN(this.value.replaceAll(',', '')) && this.value.replaceAll(',', '').length != 0) {
                                  //gr_amt1 = parseFloat(qtyval);
                                  gr_amt += parseFloat(this.value.replaceAll(',', ''));

                                  
                              }

                            $("#basicTotal").val(gr_amt.toFixed(3));
                            $("#basicTotalTemp").val(gr_amt.toFixed(3));

                          });

                         var allGrandAmount = parseFloat($('#basicTotal').val());

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

          url:"{{ url('get-last-no-vr-sequence-by-series-new') }}",

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
                        var lastNo = parseInt(getlastno) +  parseInt(1);
                        $('#vrseqnum').val(lastNo);
                        $('#getVrNo').val(lastNo);
                    }else{
                        var getlastno = '';
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
                          $('#trip_day').val(data1.data_trip.TRIP_DAYS);

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
  function Getqunatity(qtyId){


     var checkqty = $('#qty'+qtyId).val();

     var doqty      =$('#do_qty'+qtyId).val();
     //var totalBasic = parseFloat($('#basicTotalTemp').val());
     var totalBasic = parseFloat($('#basicTotal').val());
     var stockqty   =$('#stockavlblevalue'+qtyId).val();

     var trcount=$('#tbledata tr').length;
      
      var getCalQty=0;
     for(var e=0;e<trcount;e++){

      if(e >= 1){
        var newQty = $('#qty'+e).val();
         getCalQty += parseFloat(newQty);

      }
        
     }

     $("#basicTotal").val(getCalQty.toFixed(3));
   
    
      if(checkqty){
      //  $('#rate'+qtyId).prop('readonly',false);
       // $("#submitdata").prop('disabled', false);
        $("#Plant_code").prop('readonly', false);
        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);

      }else{
        // $('#rate'+qtyId).prop('readonly',true);
         // $("#submitdata").prop('disabled', true);
          $("#Plant_code").prop('readonly', true);
          $("#deletehidn").prop('disabled', true);
          $("#addmorhidn").prop('disabled', true);
      }

      var gr_amt1 =0;
       $(".qtyclc").each(function () {

        
            if (!isNaN(this.value) && this.value.length != 0) {
                //gr_amt1 += parseFloat(this.value);
              console.log('total ',this.value);

            }

          

        });

       var allGrandAmount = parseFloat($('#basicTotal').val());


       // $("#submitdata").prop('disabled',false);



  }
</script>

<script type="text/javascript">

 function submitData(){


      var trcount=$('table tr').length;



          var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          var vehicle_owner =  $("#vehicle_owner").val();
          var vehicle_no =  $("#vehicle_no").val();
          var vehicle_type =  $("#vehicle_type").val();
          var off_days     =  $("#off_days").val();
          var trip_day     =  $("#trip_day").val();

         // alert(vehicle_owner);return false;

            if(vehicle_no=='' || vehicle_owner=='' || vehicle_type=='' || off_days=='' || trip_day==''){

                $("#requiredMsg").html('* Fields Are Required').css('color','red');

                 return false;
            }

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/finance/save-vehicle-plan-without-item'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

                 var data1 = JSON.parse(data);

                 console.log(data);

               if(data1.response=='error'){
                  var responseVar =false;

                    var url = "{{ url('/Transaction/View-vehicle-Plan-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar =true;
                  var url = "{{ url('/Transaction/View-vehicle-Plan-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }

              },

          });
      
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

   }


    
});

</script>


<script type="text/javascript">
  
  function getcityName(srno){

   var consinee_add = $("#consigneeadd"+srno).val();
  
    var consinee = $("#sp_code"+srno).val();

    var do_to_place = $("#body_to_place"+srno).val();


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
                  $('#errorCity').html("CITY NOT ASSIGN FOR THIS CONSINEE IN MASTER").css('color','red');

                }else if(data1.response == 'success'){

                  if(data1.data==''){

                    $('#errorCity').html("CITY NOT ASSIGN FOR THIS CONSINEE IN MASTER").css('color','red');

                  }else{

                    $("#to_place"+srno).val(data1.data.CITY_NAME);
                    $("#head_toplace").val(data1.data.CITY_NAME);
                      var city_name = data1.data.CITY_NAME;

                       if($.trim(do_to_place) == $.trim(city_name)){
                          $("#sr_flag").val('0');
                          $("#slrMsg").html('');
                        }else{
                           /*$("#sr_flag").val('1');
                           $("#slrMsg").html('SUPPLEMENTARY LR WILL BE GENRATED FOR THIS TRIP').css('color','red');*/
                           
                        }

                    $('#errorCity').html("");

                  }

                    

                }

            }

          });



  }

</script>

<script type="text/javascript">
  
  function getcityName_OLD(srno){

   var consinee_add = $("#consigneeadd"+srno).val();
  
    var consinee = $("#sp_code"+srno).val();


          var xyz = $('#ConsineeAddList'+srno+' option').filter(function() {

          return this.value == consinee_add;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //console.log(msg);

          if(msg=='No Match'){

          	$("#cp_address"+srno).val('');
          	$("#to_place_wdo"+srno).val('');
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

                  }else{

                    $("#to_place"+srno).val(data1.data.CITY_NAME);
                    $("#head_toplace").val(data1.data.CITY_NAME);
                   // $("#body_to_place1").val(data1.data.CITY_NAME);

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

           var acc_code = $("#account_code").val();
           var rake_no = $("#rake_no").val();
           var cp_code = $("#consignee"+num).val();
           var sp_code = $("#sp_code"+num).val();
          


          var xyz = $('#SpList'+num+' option').filter(function() {

          return this.value == sp_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

            $("#spName"+num).val('');
            $("#consigneeadd"+num).val('');
            $("#to_place"+num).val('');

          }else{
           $("#spName"+num).val(msg);
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

        data: {cp_code:cp_code,sp_code:sp_code,acc_code:acc_code,rake_no:rake_no},

        success:function(data){

          var data1 = JSON.parse(data);


          console.log(data1.data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
            

          }else if(data1.response == 'success'){
            //console.log('data1.data[0]',data1.data[0]);

             if(data1.data_do == '' || data1.data_do ==null){
                
              }else{

                $('#body_to_place'+num).val(data1.data_do.TO_PLACE);
                    
              }

            if(data1.data == ''){
                
              
              }else{
                  //alert(data1.data_do.TO_PLACE);
                    

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
<script type="text/javascript">

  function consigneeName_OLD(num){

   // alert(num);

         //  var val = $("#consignee"+num).val();

           var consinee_code = $("#sp_code"+num).val();
          


          var xyz = $('#SpList'+num+' option').filter(function() {

          return this.value == consinee_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

            $("#spName"+num).val('');
            $("#consigneeadd"+num).val('');
            $("#to_place"+num).val('');

          }else{
           $("#spName"+num).val(msg);
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

        data: {consinee_code: consinee_code},

        success:function(data){

          var data1 = JSON.parse(data);


          console.log(data1.data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
            

          }else if(data1.response == 'success'){
            //console.log('data1.data[0]',data1.data[0]);
            if(data1.data == ''){
                
              
              }else{

              //  $('#profitctrId').val(data1.data[0].PFCT_CODE);

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



<script type="text/javascript">
  
  function getDoDetailsByCust(){

   var account_code = $("#account_code").val();

   if (account_code=='') {
      $('#account_code').css('border-color','#ff0000').focus();
   }else{
      $('#account_code').css('border-color','#d2d6de');
      
   }

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

            console.log('rake',data1);

            //console.log(data1.data_rake);

                  $("#off_days").val(data1.acc_data.OFF_DAYS);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                   //$("#rake_no").val(data1.data[0].RAKE_NO);
                
                  console.log('rake',data1.data_rake);
                  $("#rake_list").empty();

                  $.each(data1.data_rake, function(k, getData){

                     $("#rake_list").append($('<option>',{

                          value:getData.RAKE_NO,

                          'data-xyz':getData.RAKE_NO,
                          text:getData.RAKE_NO


                        }));
                            

                  })

                
                
              }

          }

    });

  }
</script>

<script type="text/javascript">
  
  function getCpCodeByRakeAcc(){

   var account_code = $("#account_code").val();
   var rake_no      = $("#rake_no").val();

   if (account_code=='' && rake_no=='') {

      $("#consignee1").prop('readonly',true);
      $('#account_code').css('border-color','#ff0000').focus();
   }else{
      $('#account_code').css('border-color','#d2d6de');
      $("#consignee1").prop('readonly',false);
      
   }

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-cp-code-by-rake-acc-code') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code,rake_no:rake_no},

          success:function(data){

            var data1 = JSON.parse(data);

            console.log('rake',data1);

            //console.log(data1.data_rake);

                  

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                   //$("#rake_no").val(data1.data[0].RAKE_NO);
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

                      }
                  })
                
              }

          }

    });

  }
</script>
@endsection