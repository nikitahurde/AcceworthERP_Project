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
  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  ::placeholder {
    text-align:left;
  }

  @media screen and (max-width: 600px) {

    .PageTitle{
      float: left;
    }

  }
  .showSeletedName{
    font-size: 12px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  .text-center{
    text-align: center;
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
  .inputboxclr{
    border: 1px solid #d7d3d3;
  }

  .tdthtablebordr{
    border: 1px solid #00BB64;
    
  }
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 3px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
    border-top: 1px solid #83e25c;
  } 
  .toalvaldesn{
    text-align: right;
    font-weight: 800;
    margin-top: 1%;
  }
  .credittotldesn{
    width: 277%;
    margin-left: 80%;
    text-align: end;
  }
  .debitcreditbox{
    width: 91px;
    text-align: end;
  }
  .viewbtnitem{
    padding-bottom: 0px;
    padding-top: 0px;
    font-size: 12px;
    margin-bottom: 4px;
  }
  .modltitletext{
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .showdetail{
    display: none;
  }
  .showcodename{
    color: #5696bb;
    font-size: 13px;
    font-weight: 600;
  }
  @media screen and (max-width: 600px) {

    .credittotldesn{
      width: 89px;
      margin-bottom: 5px;
      margin-left: -34%;
    }
    .totlsetinres{
      width: 130%;
    }
    .debitcreditbox{
      margin-top: 0%;
    }

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


 
    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> {{ $title }}</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('Transaction/Logistic/View-Freight-Sale-Order') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Freight Sale.</a>

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
              <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab1info">

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

                              <input type="text" class="form-control transdatepicker" name="vr" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off" onchange="vrDate()">

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

                              <input type="text" class="form-control" name="tran" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

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
                            <input list="seriesList1"  id="series_code" name="series" class="form-control  pull-left" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();">

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


                              <input type="text" class="form-control" name="tran" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

                            </div>

                        </div>
                        
                      </div>
                      <!-- /.col -->

                       <div class="col-md-2">

                        <div class="form-group">

                          <label> Vr No: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="hidden" name="" value="{{$to_num}}" id="vr_last_num">

                            <input type="text" class="form-control" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                         </div>
                        <!-- /.form-group -->
                      </div>



                    </div>
                    <!-- /.row -->


                    <div class="row">

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Customer Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="" placeholder="Select Account"
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

                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Customer Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="account_name" value="" id="account_name" placeholder="Enter Department Name" readonly autocomplete="off">

                            </div>
                            
                        </div>
                        
                      </div>

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Freight Type Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="frieghtypeList"  id="frieghtype_code" name="frieghttype_code" class="form-control  pull-left" value="" placeholder="Select Freight Type Code"
                            > 

                              <datalist id="frieghtypeList">

                              
                                @foreach ($freightType_list as $key)

                               <option value='<?php echo $key->FREIGHTTYPE_CODE?>'  data-xyz="<?php echo $key->FREIGHTTYPE_NAME; ?>" ><?php echo $key->FREIGHTTYPE_NAME; echo "[".$key->FREIGHTTYPE_CODE."]"; ?></option>

                                @endforeach

                              </datalist>

                            </div>

                            <small id="frieght_type_errr" style="color: red;"></small>

                        </div>
                            <!-- /.form-group -->
                      </div>

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Freight Type Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="frieghtype_name" value="" id="frieghtype_name" placeholder="Enter Freight Type Name" readonly autocomplete="off">

                            </div>
                            
                        </div>
                        
                      </div>
                     
                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Ref No : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="ref_no" value="" id="ref_no" placeholder="Enter Refrence No" autocomplete="off" readonly>

                        

                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="refno_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div>
                      
                      <div class="col-md-2">

                        <div class="form-group">

                          <label> Ref Date : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type=text class="form-control fromdatepicker" name="ref_date" value="" id="ref_date" placeholder="Enter Refrence Date" autocomplete="off" readonly>

                          

                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="refdate_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div>
                      
                      <!-- <button type="button" class="btn btn-warning btn-sm" style="margin-top: 10px;" id="importbtn" disabled="">Import</button>
                       -->
                    

                    </div> <!-- row -->
                    
                    <div class="row">


                      <div class="col-md-2">

                        <div class="form-group">

                          <label> DO Excel Code : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="doExcelList" class="form-control" name="do_excel_code"  id="do_excel_code" placeholder="Enter DO Excel Code" autocomplete="off" >

                              <datalist id="doExcelList">
                                
                                <?php foreach($do_excel_list as $key) { ?>

                                  <option value="<?= $key->EXLCONFIG_CODE ?>" data-xyz="<?= $key->EXLCONFIG_NAME ?>"><?= $key->EXLCONFIG_CODE ?> - <?= $key->EXLCONFIG_NAME ?></option>
                                
                                <?php } ?>

                              </datalist>

                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="freight_order_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div> 

                      <div class="col-md-3">

                        <div class="form-group">

                          <label> DO Excel Name : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input type="text" class="form-control" name="do_excel_name"  id="do_excel_name" placeholder="Enter DO Excel Name" autocomplete="off" readonly>


                            </div>

                            <small id="empName" class="showcodename"></small>
                            <small id="freight_order_err" style="color: red;" class="form-text text-muted"> </small>


                        </div>
                        
                      </div> 


                     <form name="data-form" id="data-form" enctype="multipart/form-data">
                        @csrf
                      <div class="col-md-3">

                        <div class="form-group">

                          <label for="exampleInputEmail1">Select File : </label>

                          <input type="file" name="import_file" class="form-control-file" id="customFile">

                          <small id="excelerr" style="color: red;"></small>

                        </div>
                      </div>

                        <div class="col-md-2" style="margin-top: 7px;margin-left: -20px;">
                          <button type="submit" class="btn btn-primary btn-sm-class" id="importbtn" >&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;IMPORT FREIGHT&nbsp;&nbsp;</button>
                        </div>

                        <div>
                          <input type="hidden" name="tempvrno" id="tempvrno">
                          <input type="hidden" name="temptransporter" id="temptransporter">
                          <input type="hidden" name="tempdoexcelcode" id="tempdoexcelcode">
                        </div>
                      

                   </form>
                    	

                     
                      
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

    </div><!-- /.row -->

  </section><!-- /.section -->


  <section class="content" style="margin-top: -10%;display: none;" id="datatableId">

  <div class="row">

   <div class="col-sm-12">

    <div class="box box-primary Custom-Box">


            <div class="box-body">

            

                <form id="bodyformId">
                  
                  <div id="dfg" class="table-responsive" style="padding-top: 5px;">

                   <div class="modalspinner hideloaderOnModl"></div>

                    <table id="example" class="table display nowrap table-bordered table-striped table-hover" style="overflow-x: scroll;">

                       <input type="hidden" name="" id="ececelCount" value='<?php echo count($columnlist); ?>'>

                        <input type="hidden" name="tempdataCount" id="tempdataCount" value=''>

                      <thead>

                        <tr>

                           <th class="text-center">Sr.NO</th>
                           <th class="text-center">STATUS</th>
                         
                           <?php $srno=1; foreach($columnlist as $key) { ?>

                              

                             <th class="text-center"><?= $key->EXCEL_COL ?><input type='hidden'  value="<?= $key->TEMPEXCEL_COL ?>" id="excelcol<?= $srno  ?>" data-id='<?php echo $key->TBL_COL; ?>'><input type="hidden" value="<?php echo $key->TBL_COL; ?>" name="temptable_col"></th>
                              
                             

                           <?php $srno++; } ?>

                          

                        </tr> 
    

                      </thead>

                      <tbody>

                    

                      </tbody>

                      

                    </table>

                </div>

                    <p class="text-center">

                      <button class="btn btn-success btn-sm-class" type="button" id="submitexceldata" onclick="submitData()"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Save&nbsp;&nbsp;</button>

                       

                      <button class="btn btn-warning btn-sm-class" type="button" id="CancleExcelBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Cancle&nbsp;&nbsp;</button>

                    </p>

            </form> 

       </div>
     </div>
   </div>

          


  <!-- ADD ACC MASTER -->

  <div class="modal fade" id="newAccModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">

        
        <h5 class="modal-title menutext" id="exampleModalLabel" style="text-align:center;">SELECT ACOUNT</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <!-- add master acc -->

    <div class="box-body">

        <form  id="accformid">
         @csrf
        <div id="AccPageShow">
          
           

        </div>

            <input type="hidden" name="temptableidacc" id="temptableidacc">
            <input type="text" name="tblcolacc" id="tblcolacc">
            <input type="text" name="tblcolsp" id="tblcolsp">
            <input type="text" name="tblcoldo" id="tblcoldo">
            <input type="hidden" name="temptableidDo" id="temptableidDo">

      </form>
    
    </div>

         <!-- add master acc -->
      </div>

       
      </div>
      
    </div>
  </div>


  <!-- ADD ACC MASTER -->


<!-- ACC CODE MODAL -->

<div class="modal fade" id="AccModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">
    <div class="modal-content">
      <div class="modal-header">

        <div class="row">

         
              <div class="col-md-4">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#newAccModal" style="font-size:12px;line-height:1;margin-top: -8px;" onclick="hideAccModal()">
                 Add New Account
              </button>
              </div>
              <div class="col-md-4">
                
                <h5 class="modal-title menutext" id="exampleModalLabel" style="text-align: center;">SELECT ACOUNT</h5>
              </div>
              <div class="col-md-4">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                     </button>
              </div>
            
        </div>
      
      </div>

       


      <div class="modal-body">

      
        
        <div class='row'>

          <div class="col-md-12">

                   <input type="hidden" name="accAliseName" id="accAliseName" value="">
                   <table id="AccTable" class="table table-bordered table-striped table-hover" style="width:100%">

                     <div class="modalspinner hideloaderOnModl"></div>
                      <thead>

                        <tr>

                           <th class="text-center">#</th>
                           <th class="text-center">ACC CODE</th>                              
                           <th class="text-center">ACC NAME</th>
                           <th class="text-center">ALIAS CODE</th>
                           <th class="text-center">ALIAS NAME</th>
                           <th class="text-center">ADDRESS</th>
                           <th class="text-center">CITY NAME</th>
                          
                        </tr> 
    

                      </thead>

                      <tbody>


                  </tbody>

                </table>

               
          </div>
          
        
        </div>
        </div>

        <div class="modal-footer" style="text-align:center;">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="getAccValue();">Save</button>
      </div>
      </div>
      
    </div>
  </div>

  <!-- ACC CODE MODAL -->

  <!-- ITEM CODE MODAL -->
  <div class="modal fade" id="ItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">
    <div class="modal-content">

      <div class="modal-header">

        <div class="row">
          <div class="col-md-4">
             <button type="button" class="btn btn-primary btn-lg" data-toggle="modal"  style="font-size:12px;line-height:1;text-align: center;margin-top: -8px;" onclick="hideItemModal()">
                 Add New Item
          </button> 
          </div>
          <div class="col-md-4">
             <h5 class="modal-title menutext" id="exampleModalLabel" style="text-align: center;">SELECT ITEM</h5>
          </div>
          <div class="col-md-4">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          
        </div>
       
        
       
        
        
        
      </div>

      <div class="modal-body">
        
          

            <div class="row">

                <div class="col-md-12">
                  <input type="hidden" name="itemAliseName" id="itemAliseName" value="">
                   <table id="ItemTable" class="table table-bordered table-striped table-hover" style="width:100%">

                     <!-- <div class="modalspinner hideloaderOnModl"></div> -->
                      <thead style="width:100%">

                        <tr style="width:100%">

                           <th class="text-center">#</th>

                           <th class="text-center">ITEM CODE/</th>
                              
                           <th class="text-center">ITEM NAME</th>
                          
                        </tr> 
    

                      </thead>

                      <tbody style="width:100%">


                      </tbody>

                </table>

                </div>

          </div>
        </div>

        <div class="modal-footer" style="text-align:center;">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-sm" onclick="getItemValue();">Save</button>
      </div>
      </div>
      
    </div>
  </div>


  
 <!-- <input type="hidden" name="temptableid" id="temptableid">
  <input type="hidden" name="tblcol" id="tblcol"> -->


  

  <!-- ITEM CODE MODAL -->

 <!--  ADD NEW ITEM MODAL -->

 <div class="modal fade" id="newItemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title menutext" id="exampleModalLabel" style="text-align:center">ADD NEW ITEM</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
       <!--  item form -->

       <div class="box-body">

        <form id="itemformid">

               @csrf
            <div id="ItemPageShow"></div>


            <input type="hidden" name="temptableid" id="temptableid">
            <input type="hidden" name="tblcol" id="tblcol">
            <input type="hidden" name="tblcol2" id="tblcol2">

          </form>

      </div><!-- /.box-body -->
       <!--  item form -->
        
      </div>

         <div class="modal-footer" style="text-align:center;">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary btn-sm" onclick="submitItemData()"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save </button>
            </div>
        
      </div>
      
    </div>
  </div>
 <!--  ADD NEW ITEM MODAL -->
</div>

 </section>



  <section class="content" style="margin-top: -10%;" id="bodyId">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

           <form id="salesordertrans">
              @csrf
              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">



                  <input type ="hidden" name="comp_name" id="getCompName">
                  <input type ="hidden" name="fy_year" id="getFyYear">
                  <input type ="hidden" name="trans_date" id="getTransDate">
                  <input type ="hidden" name="vr_no" id="getVrNo">
                  <input type ="hidden" name="trans_code" id="getTransCode">
                  <input type ="hidden" name="AccCode" id="getAccCode">

                  <input type ="hidden" name="AccName" id="getAccName">
                  <input type ="hidden" name="pfct_code" id="getPfctCode">
                  <input type ="hidden" name="pfct_name" id="getPfctName">
                  <input type ="hidden" name="plant_code" id="getPlantCode">
                  <input type ="hidden" name="plant_name" id="getPlantName">
                  <input type ="hidden" name="series_code" id="getSeriesCode">
                  <input type ="hidden" name="series_name" id="getSeriesName">
                  <input type ="hidden" name="tax_code" id="getTaxCode">
                  <input type="hidden" name="due_days" id="gateduedays">
                  <input type="hidden" name="getrefNo" id="getrefNo">
                  <input type="hidden" name="getrefDate" id="getrefDate">
                   <input type="hidden" name="getfreightTypeCode" id="getfreightTypeCode">
                  <input type="hidden" name="getfreightTypeName" id="getfreightTypeName">
                  <input type="hidden" name="getvalidfrmDate" id="getvalidfrmDate">
                  <input type="hidden" name="getvalidtoDate" id="getvalidtoDate">
                  
                  <input type ="hidden" name="party_ref_no" id="getpartyrfNo">
                  <input type ="hidden" name="party_ref_date" id="getpartyrfDate">
                  <input type ="hidden" name="consine_code" id="getcosine">
                  <input type ="hidden" name="rfhead1" id="getrfhead1">
                  <input type ="hidden" name="rfhead2" id="getrfhead2">
                  <input type ="hidden" name="rfhead3" id="getrfhead3">
                  <input type ="hidden" name="rfhead4" id="getrfhead4">
                  <input type ="hidden" name="rfhead5" id="getrfhead5">
                  <input type ="hidden" name="rfhead5" id="getrfhead5">

                  <input type="hidden" name="cost_code" id="cost_code">


                  <input type="hidden" name="comp_name" value="<?php echo Session::get('company_name'); ?>">
                  <input type="hidden" name="fiscal_year" value="<?php echo Session::get('macc_year'); ?>">
               
                  <tr>

                    <th style="width: 10%;"><input class='check_all'  type='checkbox' onclick="select_all()"/></th>

                    <th style="width: 10%;"> Sr.No.</th>

                    <th>Route Code</th>
                    <th>Route Name</th>
                    <th>From Place</th>
                    <th>To Place</th>
                    <th>Vehicle Type </th>
                    <th>Rate Basis </th>
                    <th>Rate</th>
                  

                  </tr>

                  <tr class="useful">

                    <td class="tdthtablebordr">
                      <input type='checkbox' class='case' id="firstrow" />
                    </td>

                    <td class="tdthtablebordr">
                      <span id='snum' style="width: 10px;">1.</span>
                    </td> 

                    <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input list="routeList1" class="inputboxclr" style="width: 120px;" id='route_code1' name="route_code[]"   oninput="this.value = this.value.toUpperCase()"  onchange="getRouteLocation(1)" autocomplete='off'/>

                      <datalist id="routeList1">
                                <?php foreach($route_list as $key) { ?>

                                  <option value="<?= $key->ROUTE_CODE ?>" data-xyz="<?= $key->ROUTE_NAME ?>"><?= $key->ROUTE_CODE ?> [<?= $key->ROUTE_NAME ?>]</option>

                                <?php  } ?>
                     </datalist>

                      
                     </div>
                    </td> 

                    <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input type="text" class="inputboxclr" style="width: 220px;" id='route_name1' name="route_name[]"   oninput="this.value = this.value.toUpperCase()" autocomplete='off'/>


                      
                     </div>
                    </td> 

                     <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input list="fromplaceList1" class="inputboxclr" style="width: 130px;" id='from_place1' name="from_place[]"   oninput="this.value = this.value.toUpperCase()"  onchange="getRouteDetails(1)" autocomplete='off'/>

                       <datalist id="fromplaceList1">

                        
                         
                       </datalist>
                     </div>
                    </td>
                    <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                       <input list="toplaceList1" class="inputboxclr" style="width: 130px;" id='to_place1' name="to_place[]"   oninput="this.value = this.value.toUpperCase()"  autocomplete='off'/>

                        <datalist id="toplaceList1">

                      
                         
                       </datalist>
                     </div>
                    </td>
                    <td class="tdthtablebordr" style="width: 25px;">
                      <div class="input-group">
                        <input list="vehciletypeList1" class="inputboxclr" style="width: 100px;" id='vehicle_type1' name="vehicle_type[]"   oninput="this.value = this.value.toUpperCase()"  />

                          <datalist id="vehciletypeList1">

                            <?php foreach($vehicletype_list as $key) { ?>

                              <option value='<?php echo $key->WHEEL_CODE?>' data-xyz ="<?php echo $key->WHEEL_NAME; ?>" ><?php echo $key->WHEEL_NAME ; echo " [".$key->WHEEL_CODE."]" ; ?></option>

                            <?php } ?>

                          </datalist><br>

                          
                      </div>
                       <button type="button" class="btn btn-primary btn-xs showdetail viewbtnitem" id="viewItemDetail1" data-toggle="modal" data-target="#view_detail1"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>
                       <div><p id="stockavlble1" class="badge" style="background-color:#25b6bd;"></p>
                       </div>
                      
                    </td>

                    <td class="tdthtablebordr tooltips" style="width: 25px;">

                      <input list="ratebasisList1" class="inputboxclr getAccNAme" style="width: 108px;" id='rate_basis1' name="rate_basis[]" autocomplete='off' />

                      <datalist id="ratebasisList1">

                        <option value="LR QTY" data-xyz='LR QTY'>LR QTY</option>
                        <option value="RECIEPT QTY" data-xyz='RECIEPT QTY'>RECIEPT QTY</option>
                        <option value="GUARANTED QTY" data-xyz='GUARANTED QTY'>GUARANTED QTY</option>

                      </datalist>

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small><br>


                    </td>
                     <td class="tdthtablebordr tooltips" style="width: 25px;">

                      <input type="text" class="debitcreditbox dr_amount inputboxclr getqtytotal quantityC moneyformate"  oninput='Getqunatity(1)' style="width: 100px;margin-bottom: 5px;" id='rate1' name="rate[]" autocomplete='off'/>

                      <small class="tooltiptextitem tooltiphide" id="itemNameTooltip1"></small><br>


                    </td>

                    
                     
                    

                    

                  </tr>

                </table>

              </div><!-- /div -->

           
              <div class="row" style="display: flex;">

                  <div class="col-md-6"></div>

                    <div class="col-md-4 toalvaldesn">



                    <div class="totlsetinres">Total :</div>

                  </div>

                  <div class="col-md-1">
                     <input type="hidden" id="allquaPcount" name="allquaPcount" value="0">
                    <input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="basicTotal" readonly="" style="margin-top: 0px;width: 100px;">

                  </div>

                  <div class="col-md-1"></div>

              </div>


               <input type="hidden" name="importExcel" id="importExcel">

       
          <br>

          <div>
            <button type="button" class='btn btn-danger btn-sm delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

            <button type="button" class='btn btn-info btn-sm addmore' id="addmorhidn" disabled=""><i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Add More</button>

            <p class="text-center">

              <button class="btn btn-success btn-sm" type="button" id="submitdata" onclick="submitData()" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

              <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

            </p>

          </div>

     </form>

       

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
                padding: 5px;
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
                width: 20%;
                text-align: center;
              }
              .amountBox{
                width: 20%;
                text-align: center;
              }
            </style>
      

      <!-- show modal when click on view btn after item select item -->

        <div class="modal fade" id="view_detail1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Item Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox1">Item Name/Item Code</div>
                    <div class="box10 rateIndbox">HSN Code</div>
                    <div class="box10 rateIndbox">Tax Code</div>
                    <div class="box10 rateBox">Item Detail</div>
                    <div class="box10 amountBox">Item Type</div>
                    <div class="box10 amountBox">Item Group</div>
                    <div class="box10 amountBox">Item Class</div>
                    <div class="box10 amountBox">Item Category</div>
                  </div>
                  
                  <div class="box-row">
                    <div class="box10 itmdetlheading">
                      <small id="itemCodeshow1"> </small>
                    </div>
                   <!--  <div class="box10 itmdetlheading">
                      <small id="itemNameshow1"> </small>
                    </div> -->
                    <div class="box10 itmdetlheading">
                      <small id="hsncodeshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="taxcodeshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemDetailshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemtypeshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemgroupshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemclassshow1"> </small>
                    </div>
                    <div class="box10 itmdetlheading">
                      <small id="itemcategoryshow1"> </small>
                    </div>
                  </div>
                  
                </div>
              </div>


              <div class="modal-footer" style="text-align: center;">
               
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button>

              </div>

            </div>

          </div>

        </div>

      <!-- show modal when click on view btn after item select item -->

      <!-- show modal when click on view btn after  select series -->

        <div class="modal fade" id="series_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Series Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox1">Series Code</div>
                    <div class="box10 rateIndbox">Series Name</div>
                    <div class="box10 rateIndbox">Tran Code</div>
                    <div class="box10 rateIndbox">Gl Code</div>
                    <div class="box10 rateBox">Post Code</div>

                    <div class="box10 amountBox">Rfhead1</div>
                    <div class="box10 amountBox">Rfhead2</div>
                    <div class="box10 amountBox">Rfhead3</div>
                    <div class="box10 amountBox">Rfhead4</div>
                  </div>
                  
                  <div class="box-row">
                    <div class="box10 itmdetlheading">
                      <span id="seriesCodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="seriesNameshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="trancodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="glcodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="postcodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead1show"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead2show"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead3show"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="rfhead4show"> </span>
                    </div>
                  </div>
                  
                </div>
              </div>


              <div class="modal-footer" style="text-align: center;">
               
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button>

              </div>

            </div>

          </div>

        </div>

      <!-- show modal when click on view btn after item select series -->


      <!-- show modal when click on view btn after  select plantcode -->

        <div class="modal fade" id="plant_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Plant Detail</h5>
                  </div>


                </div>

              </div>

              <div class="modal-body table-responsive">
                <div class="boxer" id="">

                  <div class="box-row">
                    <div class="box10 texIndbox1">Plant Name/Plant Code</div>
                   
                    <div class="box10 rateIndbox">Pfct Code</div>
                    <div class="box10 rateIndbox">Address</div>
                    <div class="box10 rateBox">City</div>

                    <div class="box10 amountBox">Pin Code</div>
                    <div class="box10 amountBox">District</div>
                    <div class="box10 amountBox">state</div>
                    <div class="box10 amountBox">Email</div>
                    <div class="box10 amountBox">Phone No</div>

                  </div>
                  
                  <div class="box-row">
                    <div class="box10 itmdetlheading">
                      <span id="plantCodeshow"> </span>
                    </div>
                    
                    <div class="box10 itmdetlheading">
                      <span id="plantpfctcodeshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantaddshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantcityshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantpinshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantdistshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantstateshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantemailshow"> </span>
                    </div>
                    <div class="box10 itmdetlheading">
                      <span id="plantphoneshow"> </span>
                    </div>
                  </div>
                  
                </div>
              </div>


              <div class="modal-footer" style="text-align: center;">
               
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button>

              </div>

            </div>

          </div>

        </div>

      <!-- show modal when click on view btn after item select plantcode -->


     


   
  </div><!-- /.box-body -->

</div>

</div>

</div>

</section>

</div>

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/freightsale_order.js') }}" ></script>


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
             var do_excel_code = $('#tempdoexcelcode').val();
             var account_code = $('#account_code').val();

             //alert(do_excel_code);return false;

          //console.log(files);

           if(files.length > 0){


             var fd = new FormData();


             fd.append('file',files[0]);
             fd.append('tempvrno',tempvrno);
             fd.append('temptransporter',temptransporter);
             fd.append('do_excel_code',do_excel_code);
             fd.append('account_code',account_code);

              
                  $.ajaxSetup({

                      headers: {

                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                      }
                });

                $("#vr_date,#series_code,#Plant_code,#account_code,#freight_order_no,#customFile,#importbtn").prop('readonly', true);

                  $("#importExcel").val('IMPORTEXCEL');

               
               $.ajax({

                url: "<?php echo url('/finance/freight-sale-order-import'); ?>",
                type : "POST",
                data : fd,
                contentType: false,
                processData: false,
                dataType: 'json',
                  beforeSend: function() {
                  console.log('start spinner');
                      $('.modalspinner').removeClass('hideloaderOnModl');
                },
                success:function (data) {


                     var new_data_count = data.new_data_count;

                      console.log('newdata',new_data_count);

                      if(new_data_count > 0){

	                    $("#submitexceldata").prop('disabled',false);
	                    
	                  }else{

	                  	 $("#submitexceldata").prop('disabled',true);

	                  }
                  
                    $("#datatableId").css("display","block");
                    $("#bodyId").css("display","none");



                    var t = $("#example").DataTable({

                         processing: true,
                         serverSide:true,
                         //scrollY:500,
                         //scrollX:true,
                         paging: true,
                         searching : true,
                        //stateSave: true,
                         pageLength:100,
                         

                          ajax:{

                            url : "{{ url('/Transaction/Logistic/View-Freight-Sale-Order-Details') }}",
                            
                           },
    

                     columns: [
                        
                         { data:"DT_RowIndex",className:"text-center"},
                         {  
                          render: function (data, type, full, meta){

                                  if(full['DO_EXIST_STATUS']=='NO' && full['DO_UPDATE_STATUS']=='0'){

                                       return '<button type="button" class="btn btn-success btn-xs" style="font-size:10px;"><i class="fa fa-check" aria-hidden="true"></i></button>';

                                    }else{

                                      return '<button type="button" class="btn btn-danger btn-xs" style="font-size:10px;">ALREADY EXIST</button>';

                                    }

                              },
        
                         },

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

                        
                      
                    ],

                   "fnRowCallback": function(nRow, aData,data, type, full, meta) {

                      
                        if((aData['ITEM_STATUS']=='YES' && aData['DO_EXIST_STATUS']=='NO') || (aData['ACC_STATUS']=='YES' && aData['DO_EXIST_STATUS']=='NO') || (aData['SP_STATUS']=='YES' && aData['DO_EXIST_STATUS']=='NO')) {
                          $('td', nRow).css('color', '#f75656');
                          
                          $(nRow).attr('class','misMatch');

                        
                        }

                      },

                       });

                  },

                   complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },

                    
            }); // ajax end

         }
    }); // form submit end
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

    $( window ).on( "load", function() {

      getvrnoBySeries();
        
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
                  
                  if(data1.data == '' ){
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

    });



    

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
  $("#do_excel_code").on('change', function () { 

      var excel_code = $(this).val();
      var vrseqnum = $("#vrseqnum").val();
      var account_code = $("#account_code").val();
     

       var xyz = $('#doExcelList option').filter(function() {

          return this.value == excel_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg =='No Match'){
            $('#do_excel_name').val('');

            $('#tempdoexcelcode').val('');
            $('#tempvrno').val('');
            $('#temptransporter').val('');
            
             //$("#bodyId").css('display','block');

             
          }else{
            $('#do_excel_name').val(msg);
            $('#excelName').val(msg);
            $('#tempdoexcelcode').val(excel_code);
            $('#tempvrno').val(vrseqnum);
            $('#temptransporter').val(account_code);
            
            //$("#bodyId").css('display','none');
          }

    /*  if(excel_code){

        $("#bodyId").css('display','none');
      }else{

         $("#bodyId").css('display','block');
      }
*/
  

});
</script>

<script type="text/javascript">

  $(document).ready(function(){

    $( window ).on( "load", function() {

     var vrseqno = $('#vrseqnum').val();

     var vrlastnum = $('#vr_last_num').val();

      if(vrseqno == ''){

        $('#setdisable').prop('disabled',true);

      }else if(vrseqno==vrlastnum){

        $('#setdisable').prop('disabled',true);

      }else{

        $('#setdisable').prop('disabled',false);

      }



       var account_code =  $("#account_code").val();

        if(account_code==''){
        
           $('#account_code').css('border-color','#d2d6de');
        
           //$('#account_code').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else{
            $('#account_code').css('border-color','#d2d6de');
           
           // $('#asset_code').css('border-color','#ff0000').focus();
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

  $(".addmore").on('click',function(){

    var vrType =  $('#vr_type').val();

      if(vrType == 'Payment'){

        var getpaymode = 'To -';

      }else if(vrType == 'Receipt'){

       var getpaymode='By -';

      }

      count=$('table tr').length;

      var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span> </td>";

      data +="<td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='routeList1' class='inputboxclr' style='width: 120px;' id='route_code"+i+"' name='route_code[]'   oninput='this.value = this.value.toUpperCase()'  onchange='getRouteLocation("+i+")' autocomplete='off'/><datalist id='routeList"+i+"'><?php foreach($route_list as $key) { ?><option value='<?= $key->ROUTE_CODE ?>' data-xyz='<?= $key->ROUTE_NAME ?>'><?= $key->ROUTE_CODE ?> <?= $key->ROUTE_NAME ?> </option><?php  } ?></datalist></div></td><td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input type='text' class='inputboxclr' style='width: 220px;' id='route_name"+i+"' name='route_name[]'   oninput='this.value = this.value.toUpperCase()' autocomplete='off'/></div></td><td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='fromplaceList"+i+"' class='inputboxclr' style='width: 130px;' id='from_place"+i+"' name='from_place[]'   oninput='this.value = this.value.toUpperCase()' onchange='getRouteDetails("+i+")'  autocomplete='off'/><datalist id='fromplaceList"+i+"'></datalist></div></td><td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='toplaceList"+i+"' class='inputboxclr' style='width: 130px;' id='to_place"+i+"' name='to_place[]'   oninput='this.value = this.value.toUpperCase()'  /><datalist id='toplaceList"+i+"'></datalist></div></td> <td class='tdthtablebordr' style='width: 25px;'><div class='input-group'><input list='vehciletypeList"+i+"' class='inputboxclr' style='width: 100px;' id='vehicle_type"+i+"' name='vehicle_type[]'   oninput='this.value = this.value.toUpperCase()'  /><datalist id='vehciletypeList"+i+"'><?php foreach($vehicletype_list as $key) { ?><option value='<?php echo $key->WHEEL_CODE?>' data-xyz ='<?php echo $key->WHEEL_NAME; ?>' ><?php echo $key->WHEEL_NAME ; echo ' ['.$key->WHEEL_CODE.']' ; ?></option><?php } ?></datalist><br></div><button type='button' class='btn btn-primary btn-xs showdetail viewbtnitem' id='viewItemDetail1' data-toggle='modal' data-target='#view_detail1'><i class='fa fa-info' aria-hidden='true' style='font-size: 13px;'></i> </button><div><p id='stockavlble1' class='badge' style='background-color:#25b6bd;'></p></div></td><td class='tdthtablebordr tooltips' style='width: 25px;'><input list='ratebasisList"+i+"' class='inputboxclr getAccNAme' style='width: 108px;' id='rate_basis"+i+"' name='rate_basis[]' autocomplete='off' /><datalist id='ratebasisList"+i+"'><option value='LR QTY' data-xyz='LR QTY'>LR QTY</option><option value='RECIEPT QTY' data-xyz='RECIEPT QTY'>RECIEPT QTY</option><option value='GUARANTED QTY' data-xyz='GUARANTED QTY'>GUARANTED QTY</option></datalist><small class='tooltiptextitem tooltiphide' id='itemNameTooltip"+i+"'></small><br></td><td class='tdthtablebordr tooltips' style='width: 25px'><input type='text' class='debitcreditbox dr_amount inputboxclr getqtytotal quantityC moneyformate'  oninput='Getqunatity("+i+")' style='width: 100px;margin-bottom:5px;' id='rate"+i+"' name='rate[]' autocomplete='off'/><small class='tooltiptextitem tooltiphide' id='itemNameTooltip1'></small><br></td><div class='modal fade' id='view_detail"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog modal-md' role='document' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Item Detail</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id=''><div class='box-row'><div class='box10 texIndbox1'>Item Name/Item Code</div><div class='box10 rateIndbox'>HSN Code</div><div class='box10 rateIndbox'>Tax Code</div><div class='box10 rateBox'>Item Detail</div><div class='box10 amountBox'>Item Type</div><div class='box10 amountBox'>Item Group</div><div class='box10 amountBox'>Item Class</div><div class='box10 amountBox'>Item Category</div></div><div class='box-row'><div class='box10 itmdetlheading'><span id='itemCodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='hsncodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='taxcodeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemDetailshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemtypeshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemgroupshow"+i+"'> </span></div><div class='box10 itmdetlheading'><span id='itemclassshow"+i+"'> </span> </div><div class='box10 itmdetlheading'><span id='itemcategoryshow"+i+"'> </span> </div></div> </div></div> <div class='modal-footer' style='text-align: center;'> <button type='button' class='btn btn-primary' data-dismiss='modal' style='padding-left: 25px;padding-right: 25px;'>Ok</button></div> </div></div></div></td>";

      $('table').append(data);



      var route_code = $("#route_code").val();


    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });


      $.ajax({

            url:"{{ url('get-route-location-by-route-code') }}",

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

                  $("#fromplaceList"+count).empty();
                   $("#toplaceList"+count).empty();
                   // $("#vehciletypeList"+count).empty();
                    
                  $.each(data1.data, function(k, getData){

                  
                    $("#fromplaceList"+count).append($('<option>',{

                      value:getData.FROM_PLACE,

                      'data-xyz':getData.FROM_PLACE,
                      text:getData.FROM_PLACE


                    }));

                   

                    $("#toplaceList"+count).append($('<option>',{

                      value:getData.TO_PLACE,

                      'data-xyz':getData.TO_PLACE,
                      text:getData.TO_PLACE


                    }));

                    

                   /* $("#vehciletypeList"+count).append($('<option>',{

                      value:getData.VEHICLE_TYPE,

                      'data-xyz':getData.VEHICLE_TYPE,
                      text:getData.VEHICLE_TYPE


                    }));*/

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

 $("#freight_order_no").on('change', function () {

  var freight =  $(this).val();

  var xyz = $('#freightList option').filter(function() {

    return this.value == freight;

  }).data('xyz');

  var msg = xyz ?  xyz : 'No Match';

  if(msg=='No Match'){
     $(this).val('');
    
     document.getElementById("costcode_err").innerHTML = 'The Cost code field is required.';
      $('#importbtn').prop('disabled',true);
      $('#dono1').prop('readonly',true);
       $("#cost_code").val('');
  }else{

   
     document.getElementById("costcode_err").innerHTML = '';
    
     $('#importbtn').prop('disabled',false);
     $('#dono1').prop('readonly',false);
    
  }

  // objvalidtn.checkBlankFieldValidation();

});
	

</script>

<script type="text/javascript">

 $("#valid_to_dt").on('change', function () {

  var valid_to_date =  $(this).val();
  var valid_from_date =  $("#valid_from_dt").val();

  if(valid_from_date > valid_to_date){

        $(this).val('');
      $("#valid_to_err").html('valid to date should be greter than valid from date');
  }else{
    $("#valid_to_err").html('');
  }

  

  

});
  

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

  function getRouteLocation(srno) {
    
    var route_code = $("#route_code"+srno).val();

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });


      $.ajax({

            url:"{{ url('get-route-location-by-route-code') }}",

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


                  $("#route_name"+srno).val(data1.data[0].ROUTE_NAME);
                  $("#from_place"+srno).val(data1.data[0].FROM_PLACE);
                  $("#to_place"+srno).val(data1.data[0].TO_PLACE);
                //  $("#vehicle_type"+srno).val(data1.data[0].VEHICLE_TYPE);
                  $("#fromplaceList"+srno).empty();
                   $("#toplaceList"+srno).empty();
                    //$("#vehciletypeList"+srno).empty();

                  $.each(data1.data, function(k, getData){

                    

                    $("#fromplaceList"+srno).append($('<option>',{

                      value:getData.FROM_PLACE,

                      'data-xyz':getData.FROM_PLACE,
                      text:getData.FROM_PLACE


                    }));

                   

                    $("#toplaceList"+srno).append($('<option>',{

                      value:getData.TO_PLACE,

                      'data-xyz':getData.TO_PLACE,
                      text:getData.TO_PLACE


                    }));

                    

                    $("#vehciletypeList"+srno).append($('<option>',{

                      value:getData.VEHICLE_TYPE,

                      'data-xyz':getData.VEHICLE_TYPE,
                      text:getData.VEHICLE_TYPE


                    }));

                  })

                }

            }

          });



  }

  

  function getRouteDetails(fromCode) {
    
    var route_code = $("#route_code"+fromCode).val();
    var from_place = $("#from_place"+fromCode).val();

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
      });


      $.ajax({

            url:"{{ url('get-route-details-by-from-place') }}",

            method : "POST",

            type: "JSON",

            data: {route_code: route_code,from_place:from_place},

            success:function(data){

              //console.log(data);

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                  //console.log('data1.data[0]',data1.data[0]);

                    

                    $("#to_place"+fromCode).val(data1.data.TO_PLACE);
                    $("#vehicle_type"+fromCode).val(data1.data.VEHICLE_TYPE);

                  

                }

            }

          });



  }

</script>




<script type="text/javascript">
	$( window ).on( "load", function() {

    var fromdateintrans = $('#FromDateFy').val();

    var todateintrans = $('#ToDateFy').val();

    var fromdateintrans_1 = $('#FromDateFy_1').val();
    var todateintrans_1 = $('#ToDateFy_1').val();



    $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate: fromdateintrans,

      endDate : todateintrans,

      autoclose: 'true',
    

    });

    $('.partyrefdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      startDate :fromdateintrans_1,

      endDate : todateintrans_1,

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
    }else{
      $('#Plant_code').css('border-color','#ff0000').focus();
    }

    


});
</script>

<script type="text/javascript">
  
  $(document).ready(function () {

  var currentdate = new Date();

$('.fromdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true',

      endDate: "currentdate",

      maxDate: currentdate

    

    });


$('.todatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true',
     
      startDate: "currentdate",

      minDate: currentdate

    });

});

</script>


<script type="text/javascript">

 function submitData(){


      var trcount=$('table tr').length;



          var data = $("#salesordertrans,#bodyformId").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/finance/save-freight-sale-order'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

              console.log(data);

                 var data1 = JSON.parse(data);

                if(data1.response=='error'){
                  var responseVar =false;

                    var url = "{{ url('/Transaction/view-freight-sale-order-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar =true;
                  var url = "{{ url('/Transaction/view-freight-sale-order-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }

              },

          });
      
  }
       
</script>

<script type="text/javascript">
	function Getqunatity(qtyId){

     var rate =$('#rate'+qtyId).val();
     var checkqty =$('#qty'+qtyId).val();
     var stockqty =$('#stockavlblevalue'+qtyId).val();
     console.log('qty',checkqty);

      if(rate){

        $("#deletehidn").prop('disabled', false);
        $("#addmorhidn").prop('disabled', false);
      }else{
        $("#deletehidn").prop('disabled', true);
        $("#addmorhidn").prop('disabled', true);
      }

       

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
        $('#qty'+qtyId).val(val);
      }

     
     $('#A_qty'+qtyId).val(total.toFixed(2));

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

          $("#basicTotal").val(gr_amt.toFixed(2));

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

          $("#basicTotal").val(gr_amt.toFixed(2));

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

                  if(data1.vrno_series == '' || data1.vrno_series==null){

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
  
  function PlantCode(){

    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var Plant_code = $('#Plant_code').val();

      if (Plant_code=='') {
        $('#Plant_code').css('border-color','#ff0000').focus();
      }else{
        $('#Plant_code').css('border-color','#d2d6de');
        $('#account_code').css('border-color','#ff0000').focus();
      }

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

              }

          }

        }

      });
  }
</script>
@endsection