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

 .required-field::before {

    content: "*";

    color: red;

  }
  .hidebox{
    display: none;
  }
  .showbox{
    display: block;
  }

  .Custom-Box {
    /*border: 1px solid #e0dcdc;
    border-radius: 10px;*/ 
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
.tcodemargin{
  margin-left: -3%;
}

::placeholder {
  
  text-align:left;
}
.dateWidth{
  width: 76% !important;
}
.vrmargin{
  margin-left: -7%;
}
.seriescodemargin{
  margin-left: -3%;
}
.seriescodewidth{
  width: 145% !important;
}
.pfctnamewidth{
  width: 145% !important;
}

.accnamewidth{
  width: 134% !important;
}
.accnamemargin{
  margin-left: -7%;
}
.sereiswidth{
  width: 145% !important;
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
/* table{border-collapse:collapse;border-radius:25px;width:880px;} */
/*table, td, th{border:1px solid #00BB64;}*/
/*tr,input{height:30px;border:1px solid #c8bebe;}*/

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
    padding: 8px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: right;
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
    width: 15%;
    margin-bottom: 5px;
}
.textdesciptn{
  width: 250px;
    margin-bottom: 5px;
}
.tdsratebtn{
  margin-top: 33% !important;
  font-weight: 600 !important;
  font-size: 10px !important;
}
.tdsratebtnHide{
  display: none;
}
.tdsInputBox{
  margin-bottom: 2%;
}
.modltitletext{
  text-align: center;
    font-weight: 700;
    color: #5696bb;
}
.textSizeTdsModl{
  font-size: 13px;
}
.numright{
  text-align: right;
}
.remarkbtn{
  display: flex;
    height: 26px;
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
    .dateWidth{
  width: 100% !important;
}
.vrmargin{
  margin-left: 0%;
}
.tcodemargin{
  margin-left: 0%;
}
.seriescodemargin{
  margin-left: 0%;
}
.seriescodewidth{
  width: 100% !important;
}
.sereiswidth{
  width: 100% !important;
}
.accnamewidth{
  width: 100% !important;
}
.pfctnamewidth{
  width: 100% !important;
}
.pfctnamemargin{
  margin-left: 0% !important;
}
.accnamemargin{
  margin-left: 0%;
}
}
</style>


<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

          <h1>
            Payment Advice
            <small>Add Details</small>
          </h1>

          <ul class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}"> Payment Advice</a></li>

            <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}">Add Payment Advice</a></li>

          </ul>

        </section>



  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Payment Advice Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('view-payment-advice') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Payment Advice</a>

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
             
                  <!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Date: <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <?php 

                        $FromDate= date("d-m-Y", strtotime($fromDate));  
                        $ToDate= date("d-m-Y", strtotime($toDate));  

                      ?>
                      <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
                      <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
                      <input type="text" class="form-control transdatepicker dateWidth" name="date" id="vr_date" value="{{ old('vr_date')}}" placeholder="Select Date" >

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>
                    <!-- /.form-group -->
            </div>
            <div class="col-md-2 vrmargin">

              <div class="form-group">
                
                <label> Vr No: </label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                    <input type="hidden" name="" value="{{$to_num}}" id="vr_last_num">
                    
                    <input type="text" class="form-control rightcontent" name="vr_num" value="<?php if($last_num){echo $last_num+1;}else{} ?>" placeholder="Enter Vr No" id="vrseqnum" readonly>

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2 tcodemargin">
              
              <div class="form-group">

                  <label> T Code : </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="tracode" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

              </div>
                    <!-- /.form-group -->
            </div>
                <!-- /.col -->

            <div class="col-md-2 seriescodemargin">

              <div class="form-group">

                  <label>Series : 
                    <span class="required-field"></span>
                  </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                        <?php $seriecount = count($series_list); ?>

                      <input list="seriesList"  id="series_code" name="seriescode" class="form-control  pull-left seriescodewidth" value="<?php if($seriecount ==1){ echo $series_list[0]->series_code;}else{ echo old('seriescode');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" readonly>

                      <datalist id="seriesList">

                        <option  value="">-- Select --</option>
                        @foreach ($series_list as $key)

                        <option value='<?php echo $key->series_code?>' <?php if($seriecount ==1){?>selected="selected" <?php } ?>   data-xyz ="<?php echo $key->series_name; ?>" ><?php echo $key->series_name ; echo " [".$key->series_code."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>
                    <small id="serscode_err" style="color: red;" class="form-text text-muted">
                    </small>
                   <!--  <small>  

                        <div class="pull-left showSeletedName" id="seriesText"></div>

                    </small> -->
                       
                    <small id="series_code_errr" style="color: red;"></small>
                          

              </div>
                    <!-- /.form-group -->
            </div>


            <div class="col-md-3">

              <div class="form-group">

                  <label>Series Name: 
                    <span class="required-field"></span>
                  </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input  id="seriesText" name="seriescode" class="form-control  pull-left sereiswidth" value="<?php if($seriecount == 1){echo $series_list[0]->series_name;}else{} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" readonly>

                      

                    </div>
                    
                          

              </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Account Code: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                      <?php $accCount = count($help_account_list); ?>
                      <input list="accCList"  id="accCodId" name="acc_code" class="form-control  pull-left" value="<?php if($accCount == 1){ echo $help_account_list[0]->acc_code; }else{echo old('acc_code');} ?>" placeholder="Select Account Code" onkeyup='GetAccountCode();tdsrateByAccCode()' oninput="this.value = this.value.toUpperCase()" style="width: 76% !important;">

                      <datalist id="accCList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($help_account_list as $key)

                        <option value='<?php echo $key->acc_code?>'   data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>

                        @endforeach

                      </datalist>

                  </div>
                  <input type="hidden" id="tdsByAccCode">
                  <input type="hidden" id="tds_rates">
                 
                  <small id="profit_center_err" style="color: red;"> </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3 accnamemargin">

              <div class="form-group">
                
                <label>Account Name: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input  id="accCText" name="acc_code" class="form-control  pull-left accnamewidth" value="<?php if($accCount == 1){echo $help_account_list[0]->acc_name;}else{} ?>" placeholder="Select Account Name" readonly="">

                     

                  </div>
               
                  
                  <small id="profit_center_err" style="color: red;"> </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3" style="margin-left: 2%;">

              <div class="form-group">
                
                <label>Pfct Code: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                        <?php $pftccount  = count($pfct_list); ?>
                      <input list="profitList"  id="profitId" name="pfctcode" class="form-control  pull-left" value="<?php if($pftccount == 1){echo $pfct_list[0]->pfct_code;}else{echo old('pfct_code');} ?>" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly style="width: 70% !important;">

                      <datalist id="profitList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($pfct_list as $key)

                        <option value='<?php echo $key->pfct_code?>'   data-xyz ="<?php echo $key->pfct_name; ?>" ><?php echo $key->pfct_name ; echo " [".$key->pfct_code."]" ; ?></option>

                        @endforeach

                      </datalist>

                  </div>
                 
                  <small id="profit_center_err" style="color: red;"> </small>

              </div>
                <!-- /.form-group -->
            </div>
            <div class="col-md-3 pfctnamemargin" style="margin-left: -8%">

              <div class="form-group">
                
                <label>Pfct Name: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input id="profitText" name="pfctcode" class="form-control  pull-left pfctnamewidth" value="<?php if($pftccount == 1){echo $pfct_list[0]->pfct_name;}else{} ?>" placeholder="Select Profit Center Code"  readonly>


                  </div>

                  

              </div>
                <!-- /.form-group -->
            </div>

            </div>

            <div class="row">

              

            


            <div class="col-md-4">

              <div class="form-group">
                
                <label>Payment Type: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="pmttypeList"  id="pmt_type" name="pmt_type" class="form-control  pull-left" value="{{ old('pmt_type')}}" placeholder="Select Payment Type" >

                      <datalist id="pmttypeList">

                        <option selected="selected" value="">-- Select --</option>

                        <option value="Bill" data-xyz ="Bill">Bill</option>
                        <option value="Order/Contract" data-xyz ="Order/Contract">Order/Contract</option>
                        <option value="Adhoc" data-xyz ="Adhoc">Adhoc</option>
                        <option value="Employee Trip" data-xyz ="Employee Trip">Employee Trip</option>
                        <option value="Challan/LR" data-xyz ="Challan/LR">Challan/LR</option>
                        <option value="GRN" data-xyz ="GRN">GRN</option>


                      </datalist>

                  </div>
                 <!--  <small>  

                      <div class="pull-left showSeletedName" id="pmttypeText"></div>

                  </small> -->
                  <small id="profit_center_err" style="color: red;"> </small>

              </div>
                <!-- /.form-group -->
            </div>

            </div>

          


        </div><!-- /.box-body -->


        </div>

      </div>


    </div>

  </section>

  <section class="content" style="margin-top: -10%;">

    <div class="row hidebox" id="showboxdata">

      <div class="col-sm-12">
        <div class="box box-primary Custom-Box">
          <center> <span id="msg"></span></center> 
        
          <div class="box-body">
          
            <!-- <form id="cahsbanktranssss" method="POST" name='students' action="{{ url('save-cash-bank-transaction') }}"> -->
            <form id="paymentAdviceTran">
              @csrf
              <div class="table-responsive">
                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                  
                    
                </table>
              </div>

              <input type="hidden" name="company_code" id="companyName">
              <input type="hidden" name="fy_code" id="fisclYear">
              <input type="hidden" name="contra_date" id="contraDate">
              <input type="hidden" name="vr_no" id="seqVrNum">
              <input type="hidden" name="tran_code" id="transContraCode">
              <input type="hidden" name="series_code" id="CodeSeries">
              <input type="hidden" name="pfct_code" id="ProfitCenterCode">
              <div>
              
              <p class="text-center">

                <button class="btn btn-success" type="button" id="submitdata"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>
                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>
              </p>

              </form>

              
          
          </div><!-- /.box-body -->

        </div>

      </div>

    </div>

  </section>



</div>


 




@include('admin.include.footer')



<script type="text/javascript">
  /*account code list*/

/*account code list*/
  $(document).ready(function() {

    $('#getcreditno,#debitAmt').on('input',function(){
          var creditno = $('#getcreditno').val();
          var debitAmt = $('#debitAmt').val();
          if(creditno && debitAmt){
            $('#submitdata').prop('disabled',false);
          }else{
            $('#submitdata').prop('disabled',true);
          }
    });


    /*series code*/
  $("#series_code").bind('change', function () {
    var seriescode =  $(this).val();
    var xyz = $('#seriesList option').filter(function() {

      return this.value == seriescode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    $("#seriesText").val(msg);

   /* document.getElementById("seriesText").innerHTML = msg; */

    if(msg=='No Match'){
       $(this).val('');
      /* document.getElementById("seriesText").innerHTML = '';*/
       $("#seriesText").val('');
       $('#CodeSeries').val('');
       $('#profitId').prop('readonly',true);
    }else{
      $('#CodeSeries').val(seriescode);
      $('#profitId').prop('readonly',false);
    }

  });
  /*series code*/


  /*profit center code*/
  $("#profitId").bind('change', function () {  
    var val = $(this).val();
    var xyz = $('#profitList option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    //document.getElementById("profitText").innerHTML = msg; 
    $("#profitText").val(msg);

      if(msg=='No Match'){
         $(this).val('');
         $('#ProfitCenterCode').val('');
        $("#profitText").val('');
      }else{
              $('#ProfitCenterCode').val(val);
      }
            
  }); 

  $("#accCodId").bind('change', function () {  
    var val = $(this).val();
    var xyz = $('#accCList option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

      $("#accCText").val(msg);

  //  document.getElementById("accCText").innerHTML = msg; 

      if(msg=='No Match'){
         $(this).val('');
         $('#tds_rates').val('');
         $("#accCText").val('');
         //document.getElementById("accCText").innerHTML = '';
      }else{
             
      }
            
  }); 

   $("#pmt_type").bind('change', function () {  
    var val = $(this).val();
    //console.log(val);
    var xyz = $('#pmttypeList option').filter(function() {

      return this.value == val;

    }).data('xyz');
   // console.log(xyz);

    var msg = xyz ?  xyz : 'No Match';

    //document.getElementById("pmttypeText").innerHTML = msg; 
  //  console.log(msg);

      if(msg=='No Match'){
         $(this).val('');
         $('#pmt_type').val('');
       //  document.getElementById("pmttypeText").innerHTML = '';
      }else{
              //$('#ProfitCenterCode').val(val);
      }
            
  });
  /*profit center code*/

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
  
  $(document).ready(function() {

    $( window ).on( "load", function() {
      var fromdateintrans = $('#FromDateFy').val();

      var todateintrans = $('#ToDateFy').val();

        $('.transdatepicker').datepicker({

          format: 'dd-mm-yyyy',
          orientation: 'bottom',
          todayHighlight: 'true',
          startDate :fromdateintrans,
          endDate : todateintrans,
          autoclose: 'true'
        });

    });

    /*vr date*/
    $('#vr_date').on('change',function(){
      var transDate = $('#vr_date').val();
      var compcode = $('#company_code').val();
      var fyyear = $('#fy_year').val();
      var vrseqno = $('#vrseqnum').val();
      var transcode = $('#transcode').val();
      var slipD =  transDate.split('-');
      var Tdate = slipD[0];
      var Tmonth = slipD[1];
      var Tyear = slipD[2];
      var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;
           // console.log(getproperDate);
      var selectedDate = new Date(getproperDate);
      var todayDate = new Date();
            
        if(selectedDate > todayDate){
          $('#showmsgfordate').html('Transaction Date Can Not Be Greater Than Today').css('color','red');
          $('#vr_date').val('');
          $('#contraDate').val('');
           $('#series_code').prop('readonly',true);
          return false;
        }else{
          $('#showmsgfordate').html('');
          $('#contraDate').val(transDate);
          $('#companyName').val(compcode);
          $('#fisclYear').val(fyyear);
          $('#seqVrNum').val(vrseqno);
          $('#transContraCode').val(transcode);
          $('#series_code').prop('readonly',false);
          return true;
        }
    });
    /*vr date*/


  });


</script>


<script type="text/javascript">
  $(document).ready(function(){

    $( window ).on( "load", function() {

     var vrseqno = $('#vrseqnum').val();
     var vrlastnum = $('#vr_last_num').val();
    // console.log(vrseqno,'',vrlastnum);

      if(vrseqno == ''){
        $('#setdisable').prop('disabled',true);
      }else if(vrseqno==vrlastnum){
        $('#setdisable').prop('disabled',true);
      }else{
        $('#setdisable').prop('disabled',false);

      }
  });

  });

</script>

<script type="text/javascript">
  
  $(document).ready(function(){
      $('#pmt_type').on('change',function(){



        var accCode = $('#accCodId').val();
        var pmt_type = $('#pmt_type').val();

         $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

          });

        if(pmt_type =='Bill'){

             $.ajax({

              url:"{{ url('get-data-from-acc-ledger-for-pay-advice') }}",

              method : "POST",

              type: "JSON",

              data: {accCode: accCode},

              success:function(data){

                  var data1 = JSON.parse(data);
             
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                   

                    if(data1.data==''){
                     
                    }else{

                        $('#tbledata').empty();

                       var headData = '<tr><th>Sr No</th><th>Vr Date</th><th>Vr No</th><th>Bill Amt</th><th>Bill Advice & Payment Done</th><th>Bill Advice Done Payment Pending</th><th>Order Amount Payment Done</th><th>Order Advice Pending</th><th>Advice Amt</th><th>TDs Amt</th><th>Net Amt</th></tr>';

                       $('#tbledata').append(headData);


                       var tdsRate = $('#tds_rates').val();
                        var srNo1 =1;

                        $.each(data1.data,function(key,value){


                        var bil_adv_pending = 0.00;
                        var bill_Adv_done   = 0.00;
                        var pendingAmt      = 0.00;
                        var paidAmt         = 0.00;

                        var accCode = value.acc_code;
                        var reftrans = value.ref_trans_code;
                        var refvrno = value.ref_vrno;
                        var refseries = value.ref_series;

                        var partyvrdate = value.partyref_date;
                        var explodevrP =  partyvrdate.split('-');
                        var gettransDate = explodevrP[2]+'-'+explodevrP[1]+'-'+explodevrP[0];

                          paidAmt = value.paidAmt;
                          bil_adv_pending = value.billpendingAmt;
                          bill_Adv_done = value.billpaidAmt;
                          pendingAmt = value.pendingAmt;

                          if(bill_Adv_done == null){
                            bill_Adv_done =0.00;
                          }

                          if(bil_adv_pending == null){
                            bil_adv_pending =0.00;
                          }

                          if(paidAmt == null){
                            paidAmt =0.00;
                          }

                          if(pendingAmt == null){
                            pendingAmt=0.00;
                          }
                            

                            adviceAmt = value.billamt -  value.billpaidAmt - value.billpendingAmt-value.paidAmt -value.pendingAmt;

                          var tdsAmount = adviceAmt * tdsRate /100;
                          var net_amount = adviceAmt - tdsAmount;
                     
                         var NewRow = '<tr><td>'+srNo1+'<input type="checkbox" class="checkRowSub" value="'+value.partyref_no+'" name="slnoNum[]"></td>';

                             NewRow += '<input type="hidden" style="width: 82px;" id="vr_dt_'+srNo1+'" name="vr_date[]" value="'+gettransDate+'"><td>'+gettransDate+'<input type="hidden" style="width: 82px;" id="ref_tcode'+srNo1+'" name="ref_trans_code[]" value="'+value.tran_code+'"><input type="hidden" style="width: 82px;" id="ref_seris'+srNo1+'" name="ref_series[]" value="'+value.series_code+'"></td>';

                             NewRow += '<input type="hidden" style="width: 82px;" id="vr_no_'+srNo1+'" name="refvr_no[]" value="'+value.partyref_no+'"><td>'+value.partyref_no+'</td>';
                             NewRow += '<input type="hidden" style="width: 82px;" id="billAmt'+srNo1+'" name="billAmt[]" value="'+ value.billamt+'"><td>'+ value.billamt+'</td>';
                             NewRow += '<input type="hidden" style="width: 82px;" id="bill_Adv_done'+srNo1+'" name="bill_Adv_done[]" value="'+bill_Adv_done+'"><td>'+bill_Adv_done+'</td>';
                             NewRow += '<input type="hidden" style="width: 82px;" id="bil_adv_pending'+srNo1+'" name="bil_adv_pending[]" value="'+bil_adv_pending+'"><td>'+bil_adv_pending+'</td>';
                             NewRow += '<input type="hidden" style="width: 82px;" id="ordr_amt_done'+srNo1+'" name="ordr_amt_done[]" value="'+paidAmt+'"><td>'+paidAmt+'</td>';
                             NewRow += '<input type="hidden" style="width: 82px;" id="ordr_amt_pending'+srNo1+'" name="ordr_amt_pending[]" value="'+pendingAmt+'"><td>'+pendingAmt+'</td>';
                             NewRow += '<td><input type="text" style="width: 82px;" class="numright" id="advice_amt_'+srNo1+'" name="adv_amountt[]" value="'+adviceAmt.toFixed(2)+'" oninput="calTdsAmt('+srNo1+')"><input type="hidden" style="width: 82px;" class="numright" id="advice_amount_temp_'+srNo1+'" name="advice_amount_temp[]" value=""></td>';
                             NewRow += '<td><input type="text" id="tds_amt'+srNo1+'" class="numright" readonly style="width: 76px;" name="tds_amount[]" value="'+tdsAmount.toFixed(2)+'"></td>';
                             NewRow += '<td><div class="remarkbtn"><input type="text" id="net_amt'+srNo1+'" class="numright" readonly style="width: 71px;margin-right: 2px;" name="net_amount[]" value="'+net_amount.toFixed(2)+'"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reamrkModl'+srNo1+'" id="remarkbtn_'+srNo1+'" onclick="showRemarkModel('+srNo1+')">R</button></div> <div id="reamrkModl'+srNo1+'" class="modal " ><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" style="text-align:center;">Remark</h5></div><div class="modal-body"><textarea  class="form-control" name="remarkDes[]"rows="3" value=""></textarea></div><div class="modal-footer"><button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button></div></div></div></div></td>';
                             
                             NewRow += '</tr>';

                            $("#showboxdata").addClass('showbox');
                             $("#tbledata").append(NewRow);

                             srNo1++;
                        });
                        
                      }  // else close

                  } // success close
              }  //success function close

          }); //ajax close

        }else if(pmt_type =='Order/Contract'){

            $.ajax({

              url:"{{ url('get-data-by-acc-code-for-pay-advice') }}",

              method : "POST",

              type: "JSON",

              data: {accCode: accCode},

              success:function(data){

                // console.log(data);

                  var data1 = JSON.parse(data);


             
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){
                   // console.log(data1.data);
                      if(data1.data==''){
                     
                      }else{

                         $("#tbledata").empty();

                         var headData = '<tr><th>Sr No</th><th>Vr Date</th><th>Vr No</th><th>Advance Amt As Per Order</th><th>Advice & Payment Done</th><th>Advice Done Payment Pending</th><th>Balence</th><th>Advice Amt <span id="errmsg" style="font-size:10px;font-weight: 500;"></span></th><th>TDS Amt</th><th>Net Pay</th></tr>';

                          $("#tbledata").append(headData);

                       var tdsRate = parseFloat($('#tds_rates').val());
                       var srNo =1;
                       var totalOrderAmt=0.00;
                       var totalPendingAmt=0.00;
                       var totalBal=0.00;
                       var totalAdvAmt=0.00;
                       var totaltdsAmt=0.00;
                       var totalNetAmt=0.00;
                        $.each(data1.data,function(key,value){

                             totalOrderAmt += parseFloat(value.adv_amt);
                             totalPendingAmt += parseFloat(value.pendingAmt || 0);

                            var vrdate = value.vr_date;
                            var explodevr =  vrdate.split('-');

                            var gettransDate = explodevr[2]+'-'+explodevr[1]+'-'+explodevr[0];
                             
                             var pendingAmt = 0.00;
                             var paidAmt = 0.00;

                             var accCode = value.acc_code;

                                paidAmt = value.paidAmt;
                                pendingAmt = value.pendingAmt;

                                if(paidAmt == null){
                                  paidAmt =0.00;
                                }

                                if(pendingAmt == null){
                                  pendingAmt =0.00;
                                }
                                
                              var balence = value.adv_amt - paidAmt - pendingAmt;

                              var advac_amt = parseFloat(value.adv_amt);
                              var tdsAmount = advac_amt * tdsRate /100;
                              
                              var tdsAmtNew = tdsAmount.toFixed(2);
                              var net_amount = balence - parseFloat(tdsAmount);

                              totalBal += parseFloat(balence);
                              totalAdvAmt +=  parseFloat(advac_amt);
                              totaltdsAmt += parseFloat(tdsAmount);
                              totalNetAmt += parseFloat(net_amount);
                           
                            
                            
                                
                             
                         var NewRow = '<tr><td>'+srNo+'<input type="checkbox" class="checkRowSub" name="slnoNum[]" value="'+value.vr_no+'" name="paymentAdviceF[]"></td>';
                             NewRow += '<input type="hidden" style="width: 82px;" id="vr_dt_'+srNo+'" name="vr_date[]" value="'+value.vr_date+'"><td style="    width: 12%;">'+gettransDate+'<input type="hidden" style="width: 82px;" id="ref_tcode'+srNo+'" name="ref_trans_code[]" value="'+value.tran_code+'"><input type="hidden" style="width: 82px;" id="ref_seris'+srNo+'" name="ref_series[]" value="'+value.series_code+'"></td>';
                             NewRow += '<input type="hidden" style="width: 82px;" id="vr_no_'+srNo+'" name="refvr_no[]" value="'+value.vr_no+'"><td>'+value.vr_no+'</td>';
                             NewRow += '<input type="hidden" style="width: 82px;" class="totCrAmt" id="cr_amt'+srNo+'" name="cr_amt[]" value="'+value.adv_amt+'"><td>'+ value.adv_amt+'</td>';
                             NewRow += '<input type="hidden" style="width: 82px;" id="paid_amt'+srNo+'" name="ad_pay_done[]" value="'+paidAmt+'"><td>'+paidAmt+'</td>';
                             NewRow += '<input type="hidden" style="width: 82px;" id="pending_amt'+srNo+'" name="getAdvice_amt[]" value="'+pendingAmt+'"><td>'+pendingAmt+'</td>';
                             NewRow += '<input type="hidden" style="width: 82px;" id="balenc_'+srNo+'" name="balence[]" value="'+balence.toFixed(2)+'"><td>'+balence.toFixed(2)+'</td>';
                             NewRow += '<td><input type="text" style="width: 82px;" class="numright" id="advice_amt_'+srNo+'" name="adv_amountt[]" value="'+balence.toFixed(2)+'" oninput="calTdsAmt('+srNo+')"><input type="hidden" style="width: 82px;" class="numright" id="advice_amount_temp_'+srNo+'" name="advice_amount_temp[]" value="'+balence.toFixed(2)+'"></td>';
                             NewRow += '<td><input type="text" id="tds_amt'+srNo+'" class="numright" readonly style="width: 76px;" name="tds_amount[]" value="'+tdsAmtNew+'"></td>';
                             NewRow += '<td><div class="remarkbtn"><input type="text" id="net_amt'+srNo+'" class="numright" readonly style="width: 71px;margin-right: 2px;" name="net_amount[]" value="'+net_amount.toFixed(2)+'"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reamrkModl'+srNo+'" id="remarkbtn_'+srNo+'" onclick="showRemarkModel('+srNo+')">R</button></div> <div id="reamrkModl'+srNo+'" class="modal " ><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" style="text-align:center;">Remark</h5></div><div class="modal-body"><textarea  class="form-control" name="remarkDes[]"rows="3" value=""></textarea></div><div class="modal-footer"><button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button></div></div></div></div></td>';
                             NewRow += '</tr>';

                             $("#showboxdata").addClass('showbox');

                             $("#tbledata").append(NewRow);

                             

                             srNo++;
                        });


                         // console.log(totalPendingAmt);
                              var headData1 = '<tr><th colspan="3"><span>Total</span></th><th><span id="ordr_total">'+totalOrderAmt.toFixed(2)+'</span></th></th><th><span id="paidtotl"></span></th><th><span id="pendingtotl">'+totalPendingAmt.toFixed(2)+'</span></th><th><span id="balencTotl">'+totalBal.toFixed(2)+'</span></th><th><span id="advicTotal">'+totalAdvAmt.toFixed(2)+'</span></th><th><span id="tdstotal">'+totaltdsAmt.toFixed(2)+'</span></th><th><span id="nettotal">'+totalNetAmt.toFixed(2)+'</span></th></tr>';

                       $('#tbledata').append(headData1);
                        
                      }

                  }
              }

          });

        }else if(pmt_type == 'Adhoc'){

        //  console.log('Adhoc');

             $("#tbledata").empty();

             var headData = '<tr><th>Sr No</th><th>Vr Date</th><th>Vr No</th><th>Order Amt</th><th>Advice & Payment Done</th><th>Advice Done Payment Pending</th><th>Balence</th><th>Advice Amt <span id="errmsg" style="font-size:10px;font-weight: 500;"></span></th><th>TDS Amt</th><th>Net Pay</th></tr><tr><td>1<input type="checkbox" class="checkRowSub" name="slnoNum[]" value="1" name="paymentAdviceF[]"></td><td>--<input type="hidden" style="width: 82px;" id="vr_dt_1" name="vr_date[]" value="--"><input type="hidden" style="width: 82px;" id="ref_tcode1" name="ref_trans_code[]" value="--"><input type="hidden" style="width: 82px;" id="ref_seris1" name="ref_series[]" value="--"></td><td><input type="hidden" style="width: 82px;" id="vr_no_1" name="refvr_no[]" value="1">--</td><td>--</td><td>--</td><td>--</td><td>--</td><td><input type="text" style="width: 82px;" class="numright" id="advice_amt_1" name="adv_amountt[]" value="" oninput="calTdsAmt(1)"></td><td><input type="text" id="tds_amt1" class="numright" readonly="" style="width: 76px;" name="tds_amount[]" value=""></td><td><div class="remarkbtn"><input type="text" id="net_amt1" class="numright" readonly style="width: 71px;margin-right: 2px;" name="net_amount[]" value=""><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reamrkModl1" id="remarkbtn1" onclick="showRemarkModel(1)">R</button></div> <div id="reamrkModl1" class="modal" ><div class="modal-dialog modal-sm"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" style="text-align:center;">Remark</h5></div><div class="modal-body"><textarea  class="form-control" name="remarkDes[]"rows="3" value=""></textarea></div><div class="modal-footer"><button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button></div></div></div></div></tr>';

              $("#tbledata").append(headData);

              $("#showboxdata").addClass('showbox');

        }else{}

         

          

      });
  });


function showRemarkModel(srNum){
 //   $('#reamrkModl'+srNum).modal('show');
}
</script>

<script type="text/javascript">

    function calTdsAmt(rowval){
        var advice_amt = $('#advice_amt_'+rowval).val();
        var advice_amt_temp = $('#advice_amount_temp_'+rowval).val();
        var balance_amt = $('#balenc_'+rowval).val();

        var tds_rates = $('#tds_rates').val();

        var result_tds = advice_amt * tds_rates /100;
        $('#tds_amt'+rowval).val(result_tds);

       var tdsAmtval =  $('#tds_amt'+rowval).val();

       var netAmount = advice_amt - tdsAmtval;
       $('#net_amt'+rowval).val(netAmount);

       if(parseFloat(balance_amt) < parseFloat(advice_amt)){

        $("#errmsg").html('advice ammount should be less than balance ammount').css('color','red');

        $('#advice_amt_'+rowval).val(advice_amt_temp);
        
       }else{
        $("#errmsg").html('');
       // $('#advice_amt_'+rowval).val(advice_amt);
       }

    }
    function GetAccountCode(){
    //console.log(Accid);
      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var accountcode =  $('#accCodId').val();
      
        $.ajax({

              url:"{{ url('acc-code-for-cash-bank') }}",

               method : "POST",

               type: "JSON",

               data: {accountcode: accountcode},

               success:function(data){

                    var data1 = JSON.parse(data);
               
                    if (data1.response == 'error') {

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                        if(data1.data==''){
                          var nottds = '';
                          $('#tdsByAccCode').val(nottds);
                        }else{
                          $('#tdsByAccCode').val(data1.data[0].tds_code);
                         
                        }
                    }
               }

          });
  }

  function tdsrateByAccCode(){

    setTimeout(function() {
       $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var tdsCode = $('#tdsByAccCode').val();
      var acCode = $('#accCodId').val();
        $.ajax({

              url:"{{ url('tds-rate-calculate') }}",

               method : "POST",

               type: "JSON",

               data: {tdsCode: tdsCode,acCode:acCode},

               success:function(data){

                    var data1 = JSON.parse(data);
               
                    if (data1.response == 'error') {

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){
                        
                        $('#tds_rates').val(data1.data[0].tds_rate);
                      

                    }
               }

          });

        }, 500);
  }

</script>
<script type="text/javascript">
  $(document).ready(function(){


    $("#submitdata").click(function () {

      

      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

            var acc_code    = $("#accCodId").val();
            var series_code = $("#series_code").val();
            var trans_code  = $("#transcode").val();
            var vrseq_num  = $("#vrseqnum").val();
            var vr_date  = $("#vr_date").val();
            //alert(acc_code);return false;
            var paymentid = [];
            var slnum     = [];
            var refvrno   = [];
            var adviceamt = [];
            var tdsamt    = [];
            var netpay    = [];
            var reftrans  = [];
            var refseris  = [];
            var remarkDes = [];



 
            //Loop through all checked CheckBoxes in GridView.
            $(".checkRowSub").each(function (){
                
                if($(this).is(":checked")){

                  paymentid.push($(this).val());
                  
                }


            });

            $('input[name^="slnoNum"]').each(function (){
                
                slnum.push($(this).val());

            });

            $('textarea[name^="remarkDes"]').each(function (){
                
                remarkDes.push($(this).val());

            });
            console.log(remarkDes);

            $('input[name^="refvr_no"]').each(function (){
                
                refvrno.push($(this).val());

            });

            $('input[name^="adv_amountt"]').each(function (){
                
                adviceamt.push($(this).val());

            });

           

            $('input[name^="tds_amount"]').each(function (){
                
                tdsamt.push($(this).val());

            });

          

            $('input[name^="net_amount"]').each(function (){
                
                netpay.push($(this).val());

            });

            $('input[name^="ref_trans_code"]').each(function (){
                
                reftrans.push($(this).val());

            });

            $('input[name^="ref_series"]').each(function (){
                
                refseris.push($(this).val());

            });


            


          
            $.ajax({

              url:"{{ url('save-payment-advice-perchase-order') }}",

               method : "POST",

               type: "JSON",

               data: {paymentid:paymentid,trans_code:trans_code,series_code:series_code,vrseq_num:vrseq_num,vr_date:vr_date,slnum:slnum,acc_code:acc_code,reftrans:reftrans,refseris:refseris,refvrno:refvrno,adviceamt:adviceamt,tdsamt:tdsamt,netpay:netpay,remarkDes:remarkDes},

               success:function(data){
                // console.log(data);
                 
                  var obj = JSON.parse(data);

                  if(obj.response=='success'){

                var url = "{{url('finance/view-payment-msg')}}"
                setTimeout(function(){ window.location = url+'/savedata'; });
                  }

               }

               });

            
            //Display selected Row data in Alert Box.
           // return false;
        });
  })
</script>
@endsection
