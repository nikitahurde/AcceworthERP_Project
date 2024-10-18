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
            <div class="row">
              
              <div class="col-md-4">

               

                </div>

                <div class="col-md-4">
                   <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> {{ $title }}</h2>
                </div>

              <div class="col-md-4">
                
                <div class="box-tools pull-right">

                  <a href="{{ url('Transaction/Logistic/View-Freight-Sale-Order') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View e-Proc Status.</a>

                </div>
              </div>

            </div>
          </div>

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
                      <div class="col-md-3">

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

                      

                       <div class="col-md-3">

                <div class="form-group">

                  <label>Plant Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="plantList"  id="plantCodeId" onchange="getNameofPlantCode()" name="plantCode"  class="form-control  pull-left" placeholder="Select Plant"  value="{{ old('plantCode')}}" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="plantList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($plantlist as $key)

                        <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                      <input type="hidden" name="plant_name" id="seriesName">

                    </div>
                    <small id="plantcode_err" style="color: red;" class="form-text text-muted"> </small>

                    <small id="showplantErr" style="color: red;"></small>

                </div><!-- /.form-group -->

              </div> <!-- /. col-md-2 -->

              <div class="col-md-2">

                  <div class="form-group">

                    <label> Plant Category : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="plantCatg" value="{{ old('plantCatg')}}" id="plantCatgId" placeholder="Enter Plant Category" readonly autocomplete="off">

                      </div>

                  </div><!-- /.form-group -->
              </div> <!--  /. col-md-2 -->

                      <div class="col-md-3">

                <div class="form-group">

                  <label>Tran Type : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="tranTypeList"  id="tranTypeId" name="tranType" class="form-control  pull-left" value="{{ old('tranType')}}" placeholder="Select Transaction Type"  autocomplete="off">

                      <datalist id="tranTypeList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($accCatglist as $key)

                        <option value='<?php echo $key->ACATG_CODE?>'   data-xyz ="<?php echo $key->ACATG_NAME; ?>" ><?php echo $key->ACATG_NAME ; echo " [".$key->ACATG_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>
                    <small id="shwoErrTranCode" style="color: red;"></small>
                </div><!-- /.form-group -->

              </div>
                     
                    </div>
                    <!-- /.row -->

                    
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
                          <button type="submit" class="btn btn-primary btn-sm-class" id="importbtn" disabled=''>&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;UPLOAD EPROC&nbsp;&nbsp;</button>
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

    <div class="modalspinner hideloaderOnModl"></div>
  <section class="content" style="margin-top: -10%;display: none;" id="datatableId">

  <div class="row">

   <div class="col-sm-12">

    <div class="box box-primary Custom-Box">


            <div class="box-body">

            

                <form id="bodyformId">
                  
                  <div id="dfg" class="" style="padding-top: 5px;">

                   


                   <input type="hidden" name="trans_type" id="trans_type" value="">

                    <table id="example" class="table display nowrap table-bordered table-striped table-hover" style="overflow-x: scroll;">

                       <input type="hidden" name="" id="ececelCount" value='<?php echo count($columnlist); ?>'>

                        <input type="hidden" name="tempdataCount" id="tempdataCount" value=''>
                        <div id="successMsg" style="text-align: center;"></div>
                      <thead>

                        <tr>

                           <th class="text-center">Sr.NO</th>
                           <th class="text-center">TRANSACTION NO</th>
                           <th class="text-center">DELIVERY NO</th>
                           <th class="text-center">INVOICE NO</th>
                           <th class="text-center">BILL NO</th>
                           <th class="text-center">CAL FREIGHT VAL</th>
                           <th class="text-center">UPLOAD BONUS AMT</th>
                           <th class="text-center">CAL BONUS AMT</th>
                           <th class="text-center">UPLOAD PENULTY AMT</th>
                           <th class="text-center">CAL PENULTY AMT</th>
                           <th class="text-center">UPLOAD BILL AMT</th>
                           <th class="text-center">CAL BILL AMT</th>
                           <th class="text-center">SHORT VAL</th>
                           <th class="text-center">PENULTY</th>
                           <th class="text-center">PAYBLE BILL AMT</th>
                           <th class="text-center">CGST</th>
                           <th class="text-center">SGST</th>
                           <th class="text-center">BILL DATE</th>
                           <th class="text-center">SECTION CODE</th>
                           <th class="text-center">DELIVERY QTY</th>
                           <th class="text-center">QTY DELIVERD</th>
                           <th class="text-center">DELIVERY DATE</th>
                           <th class="text-center">TRIPLAN COVERD</th>
                           <th class="text-center">E CONDN</th>
                           <th class="text-center">CURRENT STATUS</th>
                           <th class="text-center">UPLOAD DATE</th>
                           <th class="text-center">POSTING DATE</th>
                           <th class="text-center">PO NUMBER</th>
                           <th class="text-center">MIN GUARENTEE</th>
                           <!-- <th class="text-center">STATUS</th> -->
                         
                           

                        </tr> 
    

                      </thead>

                      <tbody>

                    

                      </tbody>

                      

                    </table>

                </div>

                     <p class="text-center">

                      <button class="btn btn-success btn-sm-class" type="button" id="submitexceldata" onclick="submitData()"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;Update&nbsp;&nbsp;</button>

                       

                      <button class="btn btn-warning btn-sm-class" type="button" id="CancleExcelBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Cancle&nbsp;&nbsp;</button>

                    </p>
 
            </form> 

       </div>
     </div>
   </div>

          




  
 <!-- <input type="hidden" name="temptableid" id="temptableid">
  <input type="hidden" name="tblcol" id="tblcol"> -->


  

  <!-- ITEM CODE MODAL -->

 <!--  ADD NEW ITEM MODAL -->

 
 <!--  ADD NEW ITEM MODAL -->
</div>

 </section>


</div>


<div id="updateModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;width: 130%;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #3c8dbc;font-weight: 800;font-size: 18px;">Update Data</h5>
                    
                </div>
                 <div class="modal-body">
         
                 

                 <small><b>Are sure to update this data ?</b></small>
                 <input type="hidden" name="delivery_no" id="delivery_no" value="">
                 <input type="hidden" name="temp_id" id="temp_id" value="">

                 </div>
                <div class="modal-footer">
                  <center>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                  <button type="button" class="btn btn-primary" onclick="updateData()">Yes</button>
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
         
                 

                 <small id="vehicleCpctmsg">Data Not Available...!</small>

                 </div>
                <div class="modal-footer">
                  <center>
                  
                  <button type="button" class="btn btn-primary" data-dismiss="modal">ok</button>
                  </center>
                </div>
            </div>
        </div>
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
             var do_excel_code   = $('#tempdoexcelcode').val();
             var account_code    = $('#account_code').val();
             var tranType        = $('#tranTypeId').val();

              $("#trans_type").val(tranType);

            // alert(tranType);

             //alert(do_excel_code);return false;

          //console.log(files);

           if(files.length > 0){


             var fd = new FormData();


             fd.append('file',files[0]);
             fd.append('tempvrno',tempvrno);
             fd.append('temptransporter',temptransporter);
             fd.append('do_excel_code',do_excel_code);
             fd.append('account_code',account_code);
             fd.append('tranType',tranType);

              
                  $.ajaxSetup({

                      headers: {

                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                      }
                });

                $("#vr_date,#series_code,#Plant_code,#account_code,#freight_order_no,#customFile,#importbtn").prop('readonly', true);

                  $("#importExcel").val('IMPORTEXCEL');

               
               $.ajax({

                url: "<?php echo url('/logistic/e-Proc-Status-import'); ?>",
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


                     $("#submitexceldata").prop('disabled',false);
                  
                    $("#datatableId").css("display","block");
                    $("#bodyId").css("display","none");



                    var t = $("#example").DataTable({

                         processing: true,
                         serverSide:true,
                         scrollY:500,
                         scrollX:true,
                         paging: true,
                         searching : true,
                        //stateSave: true,
                         pageLength:100,
                         
                          ajax:{

                            url : "{{ url('/Transaction/Logistic/View-Eproc-Data-Details') }}",
                            
                           },
    

                     columns: [
                        
                         { data:"DT_RowIndex",className:"text-center"},
                        /* {  
                          render: function (data, type, full, meta){

                             return '<button type="button" class="btn btn-success btn-xs" style="font-size:10px;" onclick="return getdelNo('+full['ID']+',\''+full['COL2']+'\');" data-tip="ACC CODE">UPDATE</button>';

                               

                              },
        
                         },*/

                        { 
                          data:"TRANSACTION_CODE",className:"text-center",
                           render: function (data, type, full, meta){

                                  var col1 = full['TRANSACTION_CODE']+'<input type="hidden" value="'+full['TRANSACTION_CODE']+'" name="column1[]"/>';

                                  return  col1;
                           }
                        },
                        { data:"DELIVERY_NO",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col2 = full['DELIVERY_NO']+'<input type="hidden" value="'+full['DELIVERY_NO']+'" name="column2[]"/>';

                                  return  col2;
                           }

                         },
                         { data:"INVOICE_NO",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col24 = full['INVOICE_NO']+'<input type="hidden" value="'+full['INVOICE_NO']+'" name="column24[]"/>';

                                  return  col24;
                           }

                         },
                        { data:"BILL_NO",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col3 = full['BILL_NO']+'<input type="hidden" value="'+full['BILL_NO']+'" name="column3[]"/>';

                                  return  col3;
                           }
                        },
                        { data:"CAL_FREIGHT_VAL",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col4 = full['CAL_FREIGHT_VAL']+'<input type="hidden" value="'+full['CAL_FREIGHT_VAL']+'" name="column4[]"/>';

                                  return  col4;
                           }

                        },
                        { data:"UPLOAD_BONUS_AMT",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col5 = full['UPLOAD_BONUS_AMT']+'<input type="hidden" value="'+full['UPLOAD_BONUS_AMT']+'" name="column5[]"/>';

                                  return  col5;
                           }
                        },
                        { data:"CAL_BONUS_AMT",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col5 = full['CAL_BONUS_AMT']+'<input type="hidden" value="'+full['CAL_BONUS_AMT']+'" name="column5[]"/>';

                                  return  col5;
                           }
                        },
                        { data:"UPLAOD_PENALTY_AMT",className:"text-center",

                           render: function (data, type, full, meta){

                                  var col6 = full['UPLAOD_PENALTY_AMT']+'<input type="hidden" value="'+full['UPLAOD_PENALTY_AMT']+'" name="column6[]"/>';

                                  return  col6;
                           }
                        },
                        { data:"CAL_PENALTY_AMT",className:"text-center",

                           render: function (data, type, full, meta){

                                  var col6 = full['CAL_PENALTY_AMT']+'<input type="hidden" value="'+full['CAL_PENALTY_AMT']+'" name="column6[]"/>';

                                  return  col6;
                           }
                        },
                        { data:"UPLAOD_BILL_AMT",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col7 = full['UPLAOD_BILL_AMT']+'<input type="hidden" value="'+full['UPLAOD_BILL_AMT']+'" name="column7[]"/>';

                                  return  col7;
                           }
                        },
                        { data:"CAL_BILL_AMT",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col7 = full['CAL_BILL_AMT']+'<input type="hidden" value="'+full['CAL_BILL_AMT']+'" name="column7[]"/>';

                                  return  col7;
                           }
                        },
                        { data:"SHORT_VAL",className:"text-center",

                           render: function (data, type, full, meta){

                                  var col8 = full['SHORT_VAL']+'<input type="hidden" value="'+full['SHORT_VAL']+'" name="column8[]"/>';

                                  return  col8;
                           }
                        },
                        { data:"PENULTY",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col9 = full['PENULTY']+'<input type="hidden" value="'+full['PENULTY']+'" name="column9[]"/>';

                                  return  col9;
                           }
                        },
                        { data:"PAYBEL_BILL_AMT",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col10 = full['PAYBEL_BILL_AMT']+'<input type="hidden" value="'+full['PAYBEL_BILL_AMT']+'" name="column10[]"/>';

                                  return  col10;
                           }
                        },
                        { data:"CGST",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col11 = full['CGST']+'<input type="hidden" value="'+full['CGST']+'" name="column11[]"/>';

                                  return  col11;
                           }
                        },
                        { data:"SGST",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col12 = full['SGST']+'<input type="hidden" value="'+full['SGST']+'" name="column12[]"/>';

                                  return  col12;
                           }
                        },
                        { data:"BILL_DATE",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col13 = full['BILL_DATE']+'<input type="hidden" value="'+full['BILL_DATE']+'" name="column13[]"/>';

                                  return  col13;
                           }
                        },
                        { data:"SECTION_CODE",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col14 = full['SECTION_CODE']+'<input type="hidden" value="'+full['SECTION_CODE']+'" name="column14[]"/>';

                                  return  col14;
                           }
                        },
                        { data:"DELIVERY_QTY",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col15 = full['DELIVERY_QTY']+'<input type="hidden" value="'+full['DELIVERY_QTY']+'" name="column15[]"/>';

                                  return  col15;
                           }
                        },
                        { data:"QTY_DELIVERD",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col16 = full['QTY_DELIVERD']+'<input type="hidden" value="'+full['QTY_DELIVERD']+'" name="column16[]"/>';

                                  return  col16;
                           }
                        },
                        { data:"DELIVERY_DATE",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col17 = full['DELIVERY_DATE']+'<input type="hidden" value="'+full['DELIVERY_DATE']+'" name="column17[]"/>';

                                  return  col17;
                           }
                        },
                        { data:"TRAPLN_COVERD",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col18 = full['TRAPLN_COVERD']+'<input type="hidden" value="'+full['TRAPLN_COVERD']+'" name="column18[]"/>';

                                  return  col18;
                           }
                        },
                        { data:"E_CONDITION",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col19 = full['E_CONDITION']+'<input type="hidden" value="'+full['E_CONDITION']+'" name="column19[]"/>';

                                  return  col19;
                           }
                        },
                        { data:"CURRENT_STATUS",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col20 = full['CURRENT_STATUS']+'<input type="hidden" value="'+full['CURRENT_STATUS']+'" name="column20[]"/>';

                                  return  col20;
                           }
                        },
                        { data:"UPLOAD_DATE",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col21 = full['UPLOAD_DATE']+'<input type="hidden" value="'+full['UPLOAD_DATE']+'" name="column21[]"/>';

                                  return  col21;
                           }
                        },
                         { data:"POSTING_DATE",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col21 = full['POSTING_DATE']+'<input type="hidden" value="'+full['POSTING_DATE']+'" name="column21[]"/>';

                                  return  col21;
                           }
                        },
                        { data:"PO_NUMBER",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col22 = full['PO_NUMBER']+'<input type="hidden" value="'+full['PO_NUMBER']+'" name="column22[]"/>';

                                  return  col22;
                           }
                        },
                        { data:"MIN_GUARENTEE",className:"text-center",

                          render: function (data, type, full, meta){

                                  var col23 = full['MIN_GUARENTEE']+'<input type="hidden" value="'+full['MIN_GUARENTEE']+'" name="column23[]"/>';

                                  return  col23;
                           }
                        },
                       
                      
                    ],

                   "fnRowCallback": function(nRow, aData,data, type, full, meta) {


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
  
  function getNameofPlantCode(){

    var plantCode   = $('#plantCodeId').val();

    var xyz = $('#plantList option').filter(function() {

    return this.value == plantCode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    console.log('nm',msg);

    if(msg == 'No Match'){
      $('#plantCodeId').val('');
      $('#showplantErr').html(msg);
      $('#plantCodeId').prop('readonly',false);
      $('#plantCodeId').css('border-color','#ff0000').focus();
    }else{
      $('#plantCodeId').css('border-color','#d4d4d4');
      $('#itemCodeId').css('border-color','#ff0000').focus();
      $('#plantCodeId').prop('readonly',true);
      $('#plantCodeId').val(plantCode+' [ '+msg+' ]');
      $('#plant_name').val(msg);
      $('#showplantErr').html('');
      
    }

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('/transition/get-plant-categoryfromplant-code') }}",

          method : "POST",

          type: "JSON",

          data: {plantCode: plantCode},

          success:function(data){

            var data1 = JSON.parse(data);

            $('#plantCatgId').val('');
            $('#plantState').val('');

              if (data1.response == 'error') {
                $('#plantCatgId').val('');
                $('#plantState').val('');
                $('#showplantCatErr').html("<p style='color:red'>Plant Category Not Found...!</p>");

              }else if(data1.response == 'success'){

                 $('#plantCatgId').val(data1.get_data[0].PLANT_CATEGORY);

                 if (data1.get_data[0].STATE_CODE!='' || data1.get_data[0].STATE_CODE!='NULL') {

                   $('#plantState').val(data1.get_data[0].STATE_CODE);

                 }else{

                  $('#plantState').val('not-found');

                 }

              }

          }

    });

  }
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
  
  function getdelNo(id,delNumber){

        $("#updateModal").modal();

        $("#delivery_no").val(delNumber);
        $("#temp_id").val(id);

   }

</script>

<script type="text/javascript">
  function updateData(){

    var delivery_no = $("#delivery_no").val();
    var temp_id     = $("#temp_id").val();

    console.log(delivery_no);
    console.log(temp_id);

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });


     $.ajax({

          url:"{{ url('update-data-to-sale-bill-eproc') }}",

          method : "POST",

          type: "JSON",

          data: {temp_id:temp_id,delivery_no:delivery_no},

          success:function(data){

            console.log(data);

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                      $('#updateModal').modal('hide');
                      $('#example').DataTable().ajax.reload();
                      $('#successMsg').html('DATA NOT UPDATED').css('color','red');
                      setTimeout(function(){

                        $('#successMsg').hide();
                            
                        }, 2000);

              }else if(data1.response == 'success'){

                      $('#updateModal').modal('hide');
                      $('#example').DataTable().ajax.reload();
                      $('#successMsg').html('DATA SUCCESSFULLY UPDATED').css('color','red');
                      setTimeout(function(){

                        $('#successMsg').hide();
                            
                        }, 2000);
                      


                      
              }

          }

    });


  }
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
            $("#importbtn").prop('disabled',true);

             
          }else{
            $('#do_excel_name').val(msg);
            $('#excelName').val(msg);
            $('#tempdoexcelcode').val(excel_code);
            $('#tempvrno').val(vrseqnum);
            $('#temptransporter').val(account_code);
            $("#importbtn").prop('disabled',false);
            
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

  function showExcelBtn(){

    var do_excel = $('#do_excel_cd').val();

    if(do_excel){
      $('#downloadExcel').css('display','');
    }else{
      $('#downloadExcel').css('display','none');
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

              //url: "< ?php echo url('/finance/save-freight-sale-order'); ?>",
              url: "<?php echo url('/finance/save-eproc-status'); ?>",

              data: data, // here $(this) refers to the ajax object not form

              success: function (data) {

              console.log(data);

                 var data1 = JSON.parse(data);

               if(data1.response=='error'){
                  var responseVar =false;



                  $("#vehicleCpctmsgModal").modal();

                  $('#example').DataTable().clear().draw();


                  $('.overlay-spinner').addClass('hideloader');
                    var url = "{{ url('/logistic/e-proc-status-success-msg') }}"
                    setTimeout(function(){ window.location = url+'/'+responseVar; });

                }else{

                  var responseVar =true;
                  var url = "{{ url('/logistic/e-proc-status-success-msg') }}"
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