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
.btn-sm {

    padding: 2px 4px;
    font-size: 12px !important;
    line-height: 1 !important;
    border-radius: 3px
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

           Upload Lorry Receipt
 
            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Logistics</a></li>

            <li class="active"><a href="{{ url('/form-mast-fleet') }}">Upload Lorry Receipt</a></li>

          </ol>

        </section>



  <section class="content" style="min-height: 10px !important;padding-bottom: 1px !important;">

    <div class="row">

     

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

             <!--  <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Upload Lorry Receipt</h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/Transaction/Logistic/View-lorry-receipt-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Lorry Receipt</a>

              </div> -->

              
<!-- 
                  <div class="box-tools pull-right">

                    <a href="{{ url('/Transaction/Logistic/View-lorry-receipt-trans') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Lorry Receipt</a>

                  </div> -->

                  <div class="row">


                <div class="col-md-4">

                 <!--  <form action="{{ url('/get-data-delivery-order-excel') }}" method="POST" enctype="multipart/form-data">
                  @csrf    
                  <div class="col-md-8">
                    <label> Excel File Template For Upload : : </label>
                     <div class="form-group">

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-file-excel-o" aria-hidden="true"></i>

                              </div>

                              <input list="doExcelListEx" class="form-control" name="do_excel_cd"  id="do_excel_cd" placeholder="Enter DO Excel Code" autocomplete="off" >

                              <datalist id="doExcelListEx">
                                
                                 < ?php foreach($do_excel_list as $key) { ?>

                                  <option value="< ?= $key->EXLCONFIG_CODE ?>" data-xyz="< ?= $key->EXLCONFIG_NAME ?>">< ?= $key->EXLCONFIG_CODE ?> - < ?= $key->EXLCONFIG_NAME ?></option>
                                
                                < ?php } ?>
                               

                              </datalist>

                            </div>
                        </div>
                      
                  </div>
                  <div class="col-md-4">
                    <button type="Submit" class="btn btn-success btn-sm"  id="downloadExcel" style="display:none;margin-top: 15%;margin-left:0%;width: 100%;"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp; Excel &nbsp;</button>
                  </div>
                  </form> -->
                </div>

                <div class="col-md-4" style="text-align:center;">
                   <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> {{ $title }}</h2>
                </div>
                  <div class="box-tools pull-right">

                    <a href="{{ url('/Transaction/Logistic/View-lorry-receipt-trans') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Lorry Receipt</a>

                  </div>
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

              
                    <!-- /.row -->

                   <div class="modalspinner hideloaderOnModl"></div>
                
                <div class="row">

                  <div class="col-md-12">
                      <form name="data-form" id="data-form" enctype="multipart/form-data">
                        @csrf
                    <div class="row" style="margin-top: 12px;">

                       <div class="col-md-2">

                        <div class="form-group">

                          <label>Customer Code : <span class="required-field"></span></label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>
                
                              <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="" placeholder="Select Customer"  autocomplete="off"> 

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

                          <label>Type : </label>

                            <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                              </div>

                              <input list="flietypeList" class="form-control" name="file_type" value="" id="file_type" placeholder="Enter Department Name" readonly autocomplete="off">

                              <datalist id="flietypeList">
                                  <option value="TATA" data-xyz="TATA">TATA</option>
                                  <option value="JSW" data-xyz="JSW">JSW</option>
                              </datalist>
                            </div>
                            
                        </div>
                        
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">

                          <label for="exampleInputEmail1">Select File : <span class="required-field"></span></label>

                         <!--  <input type="file" name="import_file" class="form-control-file" id="upload-btn"> -->
                          <input type="file" name="import_file" class="form-control-file" id="customFile">

                          <small id="excelerr" style="color: red;"></small>

                        </div>
                      </div>

                      <div class="col-md-2" style="margin-top: 7px;">
                        <button type="submit" class="btn btn-primary btn-sm" id="importbtn">&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;IMPORT LR&nbsp;&nbsp;</button>
                      </div>
                       
                      <div class="col-md-2">

                       <!--  <input type="file" name="import_file" class="custom-file-input form-control" id="customFile" style="display:none;"> -->
                       
                        <input type="hidden" name="tempvrno" id="tempvrno">
                        <input type="hidden" name="temptransporter" id="temptransporter">


                      </div>
                      


                       
                    </div>

                  
                    </form>
                  </div>
                </div>

            
              
          

          </div><!-- /.box-body -->

           

          </div>

      </div>

     


    </div>

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
                   <input type="hidden" name="accAliseCode" id="accAliseCode" value="">
                   <input type="hidden" name="accType" id="accType" value="">
                   <table id="AccTable" class="table table-bordered table-striped table-hover" style="width:100%">

                     <div class="modalspinner hideloaderOnModl"></div>
                      <thead>

                        <tr>

                           <th class="text-center">#</th>
                           <th class="text-center">ACC CODE</th>                              
                           <th class="text-center">ACC NAME</th>
                           <th class="text-center">ALIAS CODE</th>
                           <th class="text-center">ALIAS NAME</th>
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
          <div style='color: red;margin-bottom: 1%;'>Note : Please Check City Name Properly.</div>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="getAccValue();">Save</button>
      </div>
      </div>
      
    </div>
  </div>

  </section>



  <section class="content" id="datatableId" style="padding-top: 0px !;">

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
                         <th class="text-center">Update City</th>
                         <th class="text-center">Update Acc</th>
                         

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

                  

                  <!-- <button class="btn btn-success btn-sm" type="button" id="submitexceldata" onclick="submitData()"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>
  

                  <button class="btn btn-warning btn-sm" type="button" id="CancleExcelBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button> -->

                </p>

               </form>


                <form id="salesordertrans">
              @csrf


               
               

                 <input type="hidden" name="importExcel" id="importExcel">
                 <input type="hidden" name="customer_code" id="customer_code">
                 <input type="hidden" name="customer_name" id="customer_name">
                 <input type="hidden" name="importfilename" id="filename">
                 <input type="hidden" name="fileType" id="fileType">

              <p class="text-center"><small id="exit_error"></small></p>
          <p class="text-center">

                            <button class="btn btn-success btn-sm" type="button" id="submitdata" onclick="submitData()" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                            <button class="btn btn-warning btn-sm" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

              </p>

        </form>

              </div>
            </div>
          </div>

        </div>


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
            <input type="hidden" name="temptableid" id="temptableid">
            <input type="hidden" name="tblcolacc" id="tblcolacc">
            <input type="hidden" name="tblcol" id="tblcol">
            <input type="hidden" name="tblcoldo" id="tblcoldo">
            <input type="hidden" name="temptableidDo" id="temptableidDo">

      </form>
    
    </div>

         <!-- add master acc -->
      </div>

       
      </div>
      
    </div>
  </div>


      </section>


  
</div>

 <div id="existLr" class="modal fade" tabindex="-1">
      <div class="modal-dialog modal-sm" style="margin-top: 13%;">
          <div class="modal-content" style="border-radius: 5px;">
              <div class="modal-header"  style="text-align: center;">
                  <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
                  
              </div>
              <div class="modal-body">
                <p id="whenRowBlnk" style="line-height:15px;text-align:center;">This Data Already Exist</p>
              </div>
              <div class="modal-footer" style="text-align: center;">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" >OK</button>
              </div>
          </div>
      </div>
    </div>

<!-- Modal -->







@include('admin.include.footer')



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

  $("#do_excel_cd").on('change', function () { 

      var excel_code = $(this).val();

       var xyz = $('#doExcelListEx option').filter(function() {

          return this.value == excel_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg =='No Match'){
             $('#downloadExcel').css('display','none');
             $('#do_excel_cd').val('');
            
             
          }else{

             $('#downloadExcel').css('display','');
             // $('#do_excel_cd').val(msg);
          }
});
</script>

<script type="text/javascript">

  $("#account_code").on('change', function () { 

      var acc_code = $(this).val();

       var xyz = $('#AccountList option').filter(function() {

          return this.value == acc_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg =='No Match'){
             //$('#downloadExcel').css('display','none');
             $('#account_code').val('');
            
             
          }else{

            $('#accountName').val(msg);
            $('#customer_code').val(acc_code);
            $('#customer_name').val(msg);
            $('#file_type').prop('readonly',false);

             //$('#downloadExcel').css('display','');
             // $('#do_excel_cd').val(msg);
          }
});
</script>


<script type="text/javascript">
  
  function showAcc(id,accCode,acc_Name,accType){

     var excelcount =  $("#ececelCount").val();
     var excelExcount =  $("#ececelExcCount").val();

     //alert(id);

    var tblcol =[]; 

  if(accType=='YARD'){

    for(var i = 1; i <= excelcount; i++) {

       var table_col = $("#excelcol"+i).attr('data-id');

      if(table_col == 'ACC_NAME'){

        var excelcol =  $("#excelcol"+i).val();

        tblcol.push(excelcol);

      }

     
    }

    $("#tblcol").val(tblcol[0]);
    $("#temptableid").val(id);
    $("#tblcolacc").val(tblcol[0]);
    $("#temptableidacc").val(id);
    $("#accAliseName").val(acc_Name);
    $("#accAliseCode").val(accCode);
    $("#accType").val(accType);
  }else{

      for(var i = 1; i <= excelExcount; i++) {

       var table_col = $("#excelcol_exceeding"+i).attr('dataex-id');

      if(table_col == 'CP_NAME'){

        var excelcol =  $("#excelcol_exceeding"+i).val();

        tblcol.push(excelcol);

      }

     
    }


    $("#tblcol").val(tblcol[0]);
    $("#temptableid").val(id);
    $("#tblcolacc").val(tblcol[0]);
    $("#temptableidacc").val(id);
    $("#accAliseName").val(acc_Name);
    $("#accAliseCode").val(accCode);
    $("#accType").val(accType);

  }

    //alert(tblcol);return false;

    console.log('col',tblcol);
    console.log('id',id);

    console.log('acc_name',acc_Name);


    
    $("#AccModal").modal('show');

   /* $('#AccModal').modal({
       show:true,
       backdrop:'static'
    });*/

    $('#AccTable').DataTable().destroy();


     var t = $("#AccTable").DataTable({

            oLanguage: {
              sProcessing: $('.modalspinner').removeClass('hideloaderOnModl')
          },
       processing: true,

       serverSide:true,

       scrollX:true,


       ajax:{


        url : "{{ url('/Master/Customer-Vendor/View-Account-Consinee') }}"


       },

       searching : true,

    

       columns: [

         
         { 
              data:"DT_RowIndex",
              name:"DT_RowIndex",
              className:"text-center",
              'render': function (data, type, full, meta){
                    if(full['CITY_NAME']==''){
                         return '<input type="radio" name="accCodeValue" class="accCodeValue'+full['DT_RowIndex']+'" disabled>';
                       }else{
                          return '<input type="radio" name="accCodeValue" class="accCodeValue'+full['DT_RowIndex']+'" value="'+full['ACC_CODE']+'~'+full['ACC_NAME']+'~'+full['ACATG_CODE']+'">';
                       }

                     
                     }
        },

         { data: "ACC_CODE",className:"textLeft",
          },

         { data: "ACC_NAME",className:"textLeft",

        },
        { data: "ALIAS_CODE",className:"textLeft",
        },
         { data: "ALIAS_NAME",className:"textLeft",
        },

         { data: "CITY_NAME",className:"textLeft",

        },


      ],

      

     });

  }


</script>

<script type="text/javascript">
  
  function getAccValue(){

    var temptableid = $("#temptableid").val();
    var tempdataCount = $("#tempdataCount").val();
    var tempdataCount1 = $("#tempdataCount1").val();
    var accAliseName = $("#accAliseName").val();
    var accAliseCode = $("#accAliseCode").val();
    var accType = $("#accType").val();

     

   var getacc =  $("input[name='accCodeValue']:checked").val();



   var  explode =  getacc.split("~");

   var  accCode =  explode[0];
   var  accName =  explode[1];
   var  accCatCode =  explode[2];


   var tblcol = $("#tblcol").val();

   //alert(tblcol);

 
    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });


    $.ajax({

          url:"{{ url('update-acc-code-to-delivery-order') }}",

          method : "POST",

          type: "JSON",

          data: {accCode: accCode,accCatCode:accCatCode,accName:accName,accAliseName:accAliseName,accAliseCode:accAliseCode,temptableid:temptableid,tblcol:tblcol},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){


                 var new_data_count = data.new_data_count;

                  var new_acc_count = data.acc_count;

                  var citydocount = data.city_do_count;

                  console.log('newdata',new_data_count);

                  if(citydocount > 0){

                      $("#submitdata").prop('disabled',true);

                      $("#cityMisMatch").html('City Mismatch For Ship To Party');

                  }else if(new_data_count > 0 && new_acc_count > 0){

                     $("#submitdata").prop('disabled',false);

                  }else if(new_data_count > 0){

                      $("#submitdata").prop('disabled',false);

                  }else{

                    $("#submitdata").prop('disabled',true);
                  }
                 
                   $('#AccModal').modal('hide');

                   $('#example').DataTable().ajax.reload();

                  //submitbtnEnable(new_data_count,itemacc_count,allocqty_count,accType);


                 ///
                 

              }

          }

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

 function submitData(){


      var trcount=$('table tr').length;



         // var data = $("#salesordertrans").serialize();
         var data = $("#salesordertrans").serialize();

          $('.overlay-spinner').removeClass('hideloader');

          $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });

          $.ajax({

              type: 'POST',

              url: "<?php echo url('/Transaction/Logistic/Save-bulk-lorry-receipt'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {


                 var data1 = JSON.parse(data);

                console.log('data => ',data1);


                if(data1.response=='error'){

                  $("#submitdata").prop('disabled',true);
                  var responseVar =false;

                  var url = "{{ url('/Transaction/View-lorry-receipt-msg') }}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  $("#submitdata").prop('disabled',true);
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

           //$("#submitdata").prop('disabled',true);

           var formData = new FormData(this);
           //Ajax functionality here

             var files = $('#customFile')[0].files;
             var excel = $('#customFile').val();


          
             if(excel==''){
              
              $('#excelerr').html('This field is required');

              return false;
             }else{
              $('#excelerr').html('');
              $('#filename').val(excel);
            }

             var tempvrno = $('#tempvrno').val();
             var temptransporter = $('#temptransporter').val();
             var file_type = $('#file_type').val();
             $("#fileType").val(file_type);
         // console.log(files);

           if(files.length > 0){


             var fd = new FormData();


             fd.append('file',files[0]);
             fd.append('tempvrno',tempvrno);
             fd.append('temptransporter',temptransporter);
             fd.append('file_type',file_type);

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
                 beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
               },
                success:function (data) {

                  //var data1 = JSON.parse(data);

                 
                  var new_data_count = data.new_data_count;

                  var new_acc_count = data.acc_count;

                  var citydocount = data.city_do_count;

                  console.log('newdata',new_data_count);

                  console.log('new_acc_count',new_acc_count);

                  console.log('citydocount',citydocount);

                  /*if(new_data_count > 0){

                      $("#submitdata").prop('disabled',true);

                  }else{

                    $("#submitdata").prop('disabled',false)

                    }*/

                  if(citydocount > 0){

                      $("#submitdata").prop('disabled',true);

                      $("#cityMisMatch").html('City Mismatch For Ship To Party');

                  }else if(new_acc_count > 0){

                     $("#submitdata").prop('disabled',true);

                  }else if(new_data_count > 0){

                      $("#submitdata").prop('disabled',false);

                  }else{

                      $("#submitdata").prop('disabled',true);
                  }

                  /*if(new_data_count > 0 && new_acc_count > 0){

                      $("#submitData").prop('disabled',false);

                  }else{

                     $("#submitdata").prop('disabled',true);

                  }*/

                  

                  

                    var getcomName = '<?php echo Session::get('company_name'); ?>';
                    var getFY      = '<?php echo Session::get('macc_year'); ?>';
                    var getnewdate = new Date();
                    var getday = getnewdate.getDate();
                    var getMonth = getnewdate.getMonth()+1;
                    var getYear = getnewdate.getFullYear();


                    var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

                    var getdate = getday+''+getMonth+''+getYear;

                 
                  $("#datatableId").css("display","block");
                  $("#bodyId").css("display","none");
                    
                    var t = $("#example").DataTable({

                        processing: true,
                        serverSide: false,
                        info: true,
                        bPaginate: false,
                        scrollY: 400,
                        scrollX: true,
                        scroller: true,
                        fixedHeader: true,
                        order: [[2, 'asc'],[3, 'asc']],
                        columnDefs: [
                           { orderable: false, targets:0 }
                        ],
                        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",

                          ajax:{

                            url : "{{ url('/Transaction/Logistic/View-Lorry-Receipt-Bulk-Details') }}",
                            
                           },
                        buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'LOGISTICS_LR_UPLOAD'+getdate+'_'+gettime,
                        title: getcomName+'\n'+getFY+'\n'+' LOGISTICS LR UPLOAD',
                        exportOptions: {
                              columns: [1,2,3,4,5,6,7,8,9,10]
                        }
                      }

                    ],

                           searching : true,
    

                     columns: [
                        
                        { data:"DT_RowIndex",className:"text-center"},

                        {  
                          render: function (data, type, full, meta){

                                  if(full['CITY_STATUS']=='NO'){

                                       return '<button type="button" class="btn btn-success btn-sm" ><i class="fa fa-check" aria-hidden="true"></i></button>';

                                    }else{

                                       return '<button type="button" class="btn btn-danger btn-sm">City Mismatch</button>';

                                         

                                    }

                              },
        
                         },
                         {  
                          render: function (data, type, full, meta){

                                  if(full['ACC_STATUS']=='NO'){

                                       return '<button type="button" class="btn btn-success btn-sm" ><i class="fa fa-check" aria-hidden="true"></i></button>';

                                    }else{
                                       var accType = 'YARD';
                                       var accCode = "";
                                       return '<button type="button" class="btn btn-warning btn-sm" style="font-size: 10px; padding: 2px 2px;" data-toggle="modal" onclick="return showAcc('+full['ID']+',\''+accCode+'\',\''+full['COL6']+'\',\''+accType+'\');" data-tip="ACC CODE"><i class="fa fa-user-circle" aria-hidden="true" ></i></button>';

                                         

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
                        
                        { data:"COL12",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col12 = full['COL12']+'<input type="hidden" value="'+full['COL12']+'" name="column12[]"/>';

                                  return  col12;
                           }
                        },
                        { data:"COL13",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col13 = full['COL13']+'<input type="hidden" value="'+full['COL13']+'" name="column13[]"/>';

                                  return  col13;
                           }
                        },
                        { data:"COL14",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col13 = full['COL14']+'<input type="hidden" value="'+full['COL14']+'" name="column14[]"/>';

                                  return  col13;
                           }
                        },

                        { data:"COL15",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col15 = full['COL15']+'<input type="hidden" value="'+full['COL15']+'" name="column15[]"/>';

                                  return  col15;
                           }
                        },
                        { data:"COL16",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col16 = full['COL16']+'<input type="hidden" value="'+full['COL16']+'" name="column16[]"/>';

                                  return  col16;
                           }
                        },
                        { data:"COL17",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col17 = full['COL17']+'<input type="hidden" value="'+full['COL17']+'" name="column17[]"/>';

                                  return  col17;
                           }
                        },
                        { data:"COL18",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col18 = full['COL18']+'<input type="hidden" value="'+full['COL18']+'" name="column18[]"/>';

                                  return  col18;
                           }
                        },
                        { data:"COL19",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col19 = full['COL19']+'<input type="hidden" value="'+full['COL19']+'" name="column19[]"/>';

                                  return  col19;
                           }
                        },
                        { data:"COL20",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col20 = full['COL20']+'<input type="hidden" value="'+full['COL20']+'" name="column20[]"/>';

                                  return  col20;
                           }
                        },
                        { data:"COL21",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col21 = full['COL21']+'<input type="hidden" value="'+full['COL21']+'" name="column21[]"/>';

                                  return  col21;
                           }
                        },
                        { data:"COL22",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col22 = full['COL22']+'<input type="hidden" value="'+full['COL22']+'" name="column22[]"/>';

                                  return  col22;
                           }
                        },
                         { data:"COL23",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col23 = full['COL23']+'<input type="hidden" value="'+full['COL23']+'" name="column23[]"/>';

                                  return  col23;
                           }
                        },
                         { data:"COL24",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col24 = full['COL24']+'<input type="hidden" value="'+full['COL24']+'" name="column24[]"/>';

                                  return  col24;
                           }
                        },
                        
                        {  data:"TRIP_NO",className:"text-center",
                          render: function (data, type, full, meta){

                             if(full['DO_NUMBER']=='YES'){


                                 var TRIP_NO = '<input list="tripNolist'+full['DT_RowIndex']+'" name="tripNo" id="tripNo" placeholder="Select Trip" /><datalist id="tripNolist'+full['DT_RowIndex']+'"><option value=""></option></datalist>';



                                    return TRIP_NO;
                             }else{
                                var TRIP_NO = '<input list="tripNolist'+full['DT_RowIndex']+'" name="tripNo" id="tripNo" placeholder="Select Trip" onchange="return updateTripNo('+full['ID']+',\''+full['COL1']+'\',\''+full['COL12']+'\',\''+full['COL20']+'\',\''+full['COL22']+'\',\''+full['TRIP_NO']+'\');"/><datalist id="tripNolist'+full['DT_RowIndex']+'"><option value="'+full['TRIP_NO']+'"></option></datalist>';


                                    return TRIP_NO;
                             }
                              

                                /*if(full['DO_NUMBER']=='NO' || full['DO_NUMBER']=='YES'){

                                      
                                       
                                    }else{

                                        var TRIP_NO = full['TRIP_NO']+'<input list="tripNolist'+DT_RowIndex+'" name="tripNo" id="tripNo" placeholder="Select Trip"/><datalist id="tripNolist"><option value="'+full['TRIP_NO']+'"></option></datalist>';

                                    }
*/
                              },
        
                         },  
                       
                      
                    ],

                   "fnRowCallback": function(nRow, aData,data, type, full, meta) {

                         

                        if(aData['DO_NUMBER']=='YES' || aData['CITY_STATUS']=='YES' || aData['ACC_STATUS']=='YES') {
                          $('td', nRow).css('color', '#f75656');
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
  function updateTripNo(id,bill_doc,delivery_no,lr_no,Dest,trip_no){

           $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }
          });



           //return false;

           $.ajax({

            url:"{{ url('get-trip-no-for-update-trip') }}",

            method : "POST",

            type: "JSON",

            data: {id:id,bill_doc:bill_doc,delivery_no:delivery_no,lr_no:lr_no,Dest:Dest,trip_no:trip_no},

            success:function(data){

              var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                 
                  
                }else if(data1.response == 'success'){
                  

                     $('#example').DataTable().ajax.reload();
                 

                }

            }

          });

  }
</script>
@endsection