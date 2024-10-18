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

            <li class="active"><a href="#"> Emp Payment Advice</a></li>

            <li class="active"><a href="{{ url('/Transaction/PaymentAdvice/add-emp-payment-advice-trans') }}">Add Emp Payment Advice</a></li>

          </ul>

        </section>



  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Employee Payment Advice</h2>

              <div class="box-tools pull-right">

                <a href="{{url('/Transaction/PaymentAdvice/view-emp-payment-advice-transaction')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Emp Payment Advice</a>

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
         @csrf
        <div class="box-body">
           <!--  <form action="{{ url('/Transaction/PaymentAdvice/Emp-payment-Advice')}}" method="POST" enctype="multipart/form-data"> -->
            <div class="row">

             
              <div class="col-md-3">

                <div class="form-group">

                  <label>Date: <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <?php $CurrentDate =date("d-m-Y"); ?>
                      
                     
                       <input type="text" class="form-control  fydatepicker" name="advice_trans_date" id="today_date"value="{{$CurrentDate}}" onchange="todayDate()" >

                    </div>

                    <small id="today_dateErr"></small>

                   

                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-2">
              
              <div class="form-group">

                  <label> T Code : </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="tracode" value="{{$trans_list}}" id="transcode" placeholder="Enter Transaction Head" readonly>

                      </div>

                      
              </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">
                
                <label> Vr No: </label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                   
                    
                    <input type="text" class="form-control rightcontent" name="vr_num" value="" placeholder="Enter Vr No" id="vrseqnum" readonly>

                  </div>

                 

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

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                        <input list="seriesList"  id="series_code" name="seriescode" class="form-control  pull-left " value="" placeholder="Select Series" autocomplete="off"  oninput="getvrnoBySeries()" >

                      <datalist id="seriesList">

                        <option  value="">-- Select --</option>
                         @foreach($seriesData as $rows)
                         
                          <option value="{{$rows->SERIES_CODE}}"data-xyz ="{{ $rows->SERIES_NAME }}">{{ $rows->SERIES_CODE}} = {{ $rows->SERIES_NAME }}</option>

                        @endforeach

                      </datalist>

                    </div>

                   <small id="series_codeErr"></small>

                   
                          

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

                       
                        <input type="text"  id="seriesName" name="seriesName" class="form-control" value="" placeholder="Series Name" readonly>
                       
                      

                    </div>
                  </div>
                    <!-- /.form-group -->
            </div>

            </div>
            <div class="row">

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Plant Code: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                       
                      <input list="plantcodelist"  id="plantCode" name="plantCode" class="form-control  pull-left" value="" placeholder="Select Plant Code" autocomplete="off" oninput="plantCode()" readonly>

                      <datalist id="plantcodelist">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach($plantData as $rows)
                         
                          <option value="{{$rows->PLANT_CODE}}"data-xyz ="{{ $rows->PLANT_NAME }}">{{ $rows->PLANT_CODE}} = {{ $rows->PLANT_NAME }}</option>
                        

                        @endforeach

                       

                      </datalist>

                  </div>

                  <small id="plantCodeErr"></small>
                 
              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Plant Name: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                       
                      <input id="plantName" name="plantName" class="form-control  pull-left" value="" placeholder="Plant Name" readonly="" >
                  </div>

                  <small id="plantNameErr"></small>
                 
                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('plantName', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">

                
                <label>Pfct Code: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                       
                      <input id="profitcen_code" name="profitcen_code" class="form-control  pull-left" value="" placeholder="Select Profit Center Code" readonly>

                      

                  </div>

                  <small id="profitcen_codeErr"></small>
                 
                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('profitcen_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">

                  <label>PFCT Name: 
                    <span class="required-field"></span>
                  </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input  id="profitcenter_name" name="profitcenter_name" class="form-control  pull-left sereiswidth" value="" placeholder="Select Series" readonly>
                    </div>

                    <small id="profitcenter_nameErr"></small>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('profitcenter_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    
                          

              </div>
                    <!-- /.form-group -->
            </div>

            </div>
            <div class="row">

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Account Code: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                     
                      <input list="accCList"  id="accCodId" name="acc_code" class="form-control  pull-left" value="" placeholder="Select Account Code" autocomplete="off" oninput="funAccCode()" readonly>

                      <datalist id="accCList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach($accTypeData as $rows)

                         @if($rows->ATYPE_CODE == 'E')
                         <option value="{{$rows->ACC_CODE}}"data-xyz ="{{ $rows->ACC_NAME }}">{{ $rows->ACC_CODE}} = {{ $rows->ACC_NAME }}</option>
                        @endif
                       @endforeach

                      </datalist>

                  </div>

                  <small id="accCodIdErr"></small>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('acc_code', '<p class="help-block" style="color:red;margin-right:8%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Account Name: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input  id="acc_name" name="acc_name" class="form-control  pull-left" value="" placeholder="Select Account Name" readonly="">

                     

                  </div>

                  <small id="acc_nameErr"></small>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('acc_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Payment Type: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="pmttypeList"  id="pmt_type" name="pmt_type" class="form-control  pull-left" value="{{ old('pmt_type')}}" placeholder="Select Payment Type" oninput="funPayType()" autocomplete="off" readonly>

                      <datalist id="pmttypeList">

                        <option selected="selected" value="">-- Select --</option>

                        <option value="Advance" data-xyz ="Advance">Advance</option>
                        <option value="Loan" data-xyz ="Loan">Loan</option>
                        

                      </datalist>

                  </div>

                  <small id="pmt_typeErr"></small>
                 
                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('pmt_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Amount: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                       
                      <input id="dr_amt" name="dr_amt" class="form-control  pull-left" value="" placeholder="Amount" autocomplete="off" oninput="funAmount()" readonly>

                     

                  </div>

                  <small id="amountErr"></small>
                 
                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('pmt_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            </div>
            <div class="row">

            <div id="loanDiv" style="display:none;">
            <div class="col-md-3">

              <div class="form-group">
                
                <label>EMI: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                       
                      <input   id="emiAmount" name="emiAmount" class="form-control  pull-left" value="" placeholder="EMI Amount" oninput="funEMIAmt()" autocomplete="off">

                     

                  </div>

                  <small id="emiAmountErr"></small>
                 
                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('emiAmount', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Tenure: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                       
                      <input   id="tenure" name="tenure" class="form-control  pull-left" value="" placeholder="EMI Amount" readonly>

                     

                  </div>

                  <small id="tenureErr"></small>
                 
                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('tenure', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>
            </div>

            </div>
   
            <div class="row">
              <div class="text-center">
               <button type="button" class="btn btn-success" onclick="funSaveData()">Save</button>
              </div>
            </div>

          </div>

            
            
          <!-- </form> -->

            

          


        </div><!-- /.box-body -->


        </div>

      </div>


    </div>

  </section>

  



</div>


 



@include('admin.include.footer')
<script type="text/javascript">

	
	$('.fydatepicker').datepicker({

      format: 'dd-mm-yyyy',

      todayHighlight: 'true',


      autoclose: 'true',



    });

  $( window ).on( "load", function() {

    $('#series_code').css('border-color','#ff0000').focus();
    getvrnoBySeries();
    
   

  })

  function getvrnoBySeries(){
   
    var seriesCode = $('#series_code').val();
    var transcode  = $('#transcode').val();

    if(seriesCode == ''){
      $('#series_code').css('border-color','#ff0000').focus();
    }
    else{
      $('#series_code').css('border-color', '#d2d6de');
      $("#series_code").prop('readonly',true);
      $('#plantCode').css('border-color', '#ff0000').focus();
      $('#plantCode').prop('readonly',false);
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

            // console.log('data1.response',data1.response);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){
                   if(data1.vrno_series == '' || data1.vrno_series ==null){
                    $('#vrseqnum').val('');
                  }else{
                   
                    if(data1.vrno_series){
                      var getlastno = data1.vrno_series.LAST_NO;
                    }else{
                      var getlastno = '';
                    }

                    if(data1.vrnodata == ''){
                      $('#vrseqnum').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);


                    }
                  }

              }

          }

    });

  }

  function funSeriesList(){
    var seriesCode = $("#series_code").val();
    
    if(seriesCode == ''){
      $('#series_code').css('border-color','#ff0000').focus();
    }
    else{
      $('#series_code').css('border-color', '#d2d6de');
      $("#series_code").prop('readonly',true);
      $('#plantCode').css('border-color', '#ff0000').focus();
      $('#plantCode').prop('readonly',false);
    }
  }

  function plantCode(){

     var plantCode = $("#plantCode").val();
    
    if(plantCode == ''){
      $('#plantCode').css('border-color','#ff0000').focus();
    }
    else{
      $('#plantCode').css('border-color', '#d2d6de');
      $("#plantCode").prop('readonly',true);
      $("#accCodId").prop('readonly',false);
      $('#accCodId').css('border-color', '#ff0000').focus();
    }

  }

  function funAccCode(){

    var accCodId = $("#accCodId").val();
    
    if(accCodId == ''){
      $('#accCodId').css('border-color','#ff0000').focus();
    }
    else{
      $('#accCodId').css('border-color', '#d2d6de');
      $("#accCodId").prop('readonly',true);
      $("#pmt_type").prop('readonly',false);
      $('#pmt_type').css('border-color', '#ff0000').focus();
    }

  }

  function funPayType(){
      
    var pmt_type = $('#pmt_type').val();
      
    if(pmt_type == ''){
      $('#pmt_type').css('border-color','#ff0000').focus();
    }
    else{

        if(pmt_type == "Loan"){
          $('#loanDiv').css('display','Block');
        }
        else{
          $('#loanDiv').css('display','None');
        }

      $('#pmt_type').css('border-color', '#d2d6de');
      $("#pmt_type").prop('readonly',true);
      $("#dr_amt").prop('readonly',false);
      $('#dr_amt').css('border-color', '#ff0000').focus();
    }
      
  }

  function funAmount(){
    var dr_amt = $('#dr_amt').val();
      
    if(dr_amt == ''){
      $('#dr_amt').css('border-color','#ff0000').focus();
    }
    else{
      $('#dr_amt').css('border-color', '#d2d6de');
     }
  }

    $("#accCodId").bind('change', function () {  

          var val = $(this).val();
          var xyz = $('#accCList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
           
          if(msg == 'No Match'){
              $(this).val('');
              $('#acc_name').val('');
                
          }else{
           $('#acc_name').val(msg);
           
          }

    });

    $("#series_code").bind('change', function () {  

          var val = $(this).val();
          var xyz = $('#seriesList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
           
          if(msg == 'No Match'){
              $(this).val('');
              $('#seriesName').val('');
                
          }else{
           $('#seriesName').val(msg);
           
          }

      });


    $("#plantCode").bind('change', function () {  

          var val = $(this).val();
          
          var xyz = $('#plantcodelist option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
          
          if(msg == 'No Match'){
              $(this).val('');
               $('#plantName').val('');
               $('#profitcen_code').val('');
               $('#profitcenter_name').val('');
          }else{
            $('#plantName').val(msg);

            var plant_code = val ;
           

            $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/Transaction/EmployeePay/transaction-pfct-code') }}",

            data: {plant_code:plant_code}, // here $(this) refers to the ajax object not form

            success: function (data) {

              var obj = JSON.parse(data);

               if (obj.response == 'success') {

                   $('#profitcen_code').val(obj.data.pfct_code);
                   $('#profitcenter_name').val(obj.data.pfct_name);

                  }
                else{

                }

            },

        });
          }
    });

    function funEMIAmt(){

      var loanAmt = $('#dr_amt').val();
      

      var emiAmt = $('#emiAmount').val();
     

      if(loanAmt != '' && emiAmt != ''){
        

        var emiAmtMonthly = parseFloat(loanAmt) / parseFloat(emiAmt);
        $('#tenure').val(emiAmtMonthly);

      }else{
       
        $('#tenure').val('');
      }
    }

    function funSaveData(){

      var todayDate = $('#today_date').val();
      var transcode = $('#transcode').val();
      var vr_num    = $('#vrseqnum').val();
     
      if(todayDate == ''){
        $('#today_dateErr').html('<p style="color:red;">Enter Date</p>');
      }else{
        $('#today_dateErr').html('');
      }

      var series_code = $('#series_code').val();
      var seriesName = $('#seriesName').val();

      if(series_code == ''){
        $('#series_codeErr').html('<p style="color:red;">Enter Series Code</p>');
      }else{
        $('#series_codeErr').html('');
      }

      var plantCode = $('#plantCode').val();
      var plantName = $('#plantName').val();
      var profitcen_code = $('#profitcen_code').val();
      var profitcenter_name = $('#profitcenter_name').val();

      if(plantCode == ''){
        $('#plantCodeErr').html('<p style="color:red;">Enter Plant Code</p>');
      }else{
        $('#plantCodeErr').html('');
      }

      var accCodId = $('#accCodId').val();
      var acc_name = $('#acc_name').val();

      if(accCodId == ''){
        $('#accCodIdErr').html('<p style="color:red;">Enter Account Code </p>');
      }else{
        $('#accCodIdErr').html('');
      }

      var pmt_type = $('#pmt_type').val();
      var dr_amt = $('#dr_amt').val();

      if(pmt_type == ''){
        $('#pmt_typeErr').html('<p style="color:red;">Enter Payment Type </p>');
      }else{
        $('#pmt_typeErr').html('');
      }

      if(pmt_type == 'Loan'){


        var emiAmount = $('#emiAmount').val();

        if(emiAmount == ''){
          $('#emiAmountErr').html('<p style="color:red;">Enter EMI Amount</p>');
        }else{
          $('#emiAmountErr').html('');
        }

        var tenure = $('#tenure').val();

        if(tenure == ''){
          $('#tenureErr').html('<p style="color:red;">Enter Tenure</p>');
        }else{
          $('#tenureErr').html('');
        }
      }
      else{

        

      }

       $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
         });

        $.ajax({

            type: 'POST',

            url: "{{ url('/Transaction/PaymentAdvice/Emp-payment-Advice') }}",

            data: {todayDate:todayDate,transcode:transcode,vr_num:vr_num,series_code,series_code,seriesName:seriesName,plantCode:plantCode,plantName:plantName,profitcen_code:profitcen_code,profitcenter_name:profitcenter_name,accCodId:accCodId,acc_name:acc_name,pmt_type:pmt_type,dr_amt:dr_amt,emiAmount:emiAmount,tenure:tenure}, // here $(this) refers to the ajax object not form

           success: function (data) {

            var obj = JSON.parse(data);

              if (obj.response == 'success') {
               
               var getName = btoa('EMPPAYMENTADVICE');

               var url ="/Transaction/TravelRequisition/success-message/";

               window.location = url+'/'+getName;
              }

           
           },

        });



    }
</script>




@endsection
