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
    text-align: center;
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

}
</style>


<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">

          <h1>
             Contra Transaction
            <small>Add Details</small>
          </h1>

          <ul class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}"> Contra</a></li>

            <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}">Add Contra</a></li>

          </ul>

        </section>



  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Contra Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/finance/view-contra-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

            <?php  
                $first = 1;
                for ($i=0; $i < $first ; $i++) { 
                $FirstvrNum        =  $contra_trn_list[0]->vr_no;
                $FirsttransCode    =  $contra_trn_list[0]->tran_code;
                $FirstContraDate   =  $contra_trn_list[0]->contra_date;
                $FirstseriesCode   =  $contra_trn_list[0]->series_code;
                $FirstpfctCode     =  $contra_trn_list[0]->pfct_code;
                $FirstAccCode      =  $contra_trn_list[0]->acc_code;
                $FirstAccName      =  $contra_trn_list[0]->acc_name;
                $FirstdebitTo      =  $contra_trn_list[0]->debit_to;
                $Firstinstrumentpe =  $contra_trn_list[0]->instrument_type;
                $Firstinstnum      =  $contra_trn_list[0]->instrument_no;
                $Firstinstdate     =  $contra_trn_list[0]->instrument_date;
                $Firstparticular   =  $contra_trn_list[0]->particular;
                }
               
                for ($i=0; $i < $first ; $i++) { 
                $secondAccCode =   $contra_trn_list[1]->acc_code;
                $secondAccName =   $contra_trn_list[1]->acc_name;
                $secondCreditBy =   $contra_trn_list[1]->credit_by;
                }

              ?>

            <div class="row">

              <div class="col-md-6">

                  <div class="form-group">

                      <label>Company: <span class="required-field"></span>
                        </label>

                      <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="text" class="form-control" id="company_code" name="comp" placeholder="Enter Company Name" value="{{strtoupper(Session::get('company_name'))}}" readonly>

                      </div>

                      <small id="comp_code_err" style="color: red;"></small>
                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                  </div>
                    <!-- /.form-group -->
              </div>
              <!-- /.col -->
              <div class="col-md-3">

                  <div class="form-group">

                    <label> Fiscal Year : <span class="required-field"></span></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                      <input type="text" class="form-control" id="fy_year" name="fiscal" placeholder="Enter fy Year" value="{{strtoupper(Session::get('macc_year'))}}" readonly> 

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('fy_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                  </div>
                      <!-- /.form-group -->

              </div>
                  <!-- /.col -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Date: <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                   
                      <input type="hidden" name="" value="" id="FromDateFy">
                      <input type="hidden" name="" value="" id="ToDateFy">
                      <?php $orgDate = $FirstContraDate;  
                         $setcontradate = date("d-m-Y", strtotime($orgDate)); ?>
                      <input type="text" class="form-control transdatepicker" name="date" id="vr_date" value="{{$setcontradate}}" placeholder="Select Date" disabled>

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>
                    <!-- /.form-group -->
            </div>
            </div>

            <div class="row">
              <div class="col-md-2">

              <div class="form-group">
                
                <label> Vr No: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                    <input type="hidden" name="" value="" id="vr_last_num">
                    
                    <input type="text" class="form-control" name="vro" value="{{$FirstvrNum}}" placeholder="Enter Vr No" id="vrseqnum" readonly>

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2">
              
              <div class="form-group">

                  <label> T Code : </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="tracode" value="{{$FirsttransCode}}" id="transcode" placeholder="Enter Transaction Head" readonly>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

              </div>
                    <!-- /.form-group -->
            </div>
                <!-- /.col -->

            <div class="col-md-4">

              <div class="form-group">

                  <label>Series : 
                    <span class="required-field"></span>
                  </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="seriesList"  id="series_code" name="seriescode" class="form-control  pull-left" value="{{$FirstseriesCode}}" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" readonly>

                      <datalist id="seriesList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($series_list as $key)

                        <option value='<?php echo $key->series_code?>'   data-xyz ="<?php echo $key->series_name; ?>" ><?php echo $key->series_name ; echo " [".$key->series_code."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>
                    <small id="serscode_err" style="color: red;" class="form-text text-muted">
                    </small>
                    <small>  

                        <div class="pull-left showSeletedName" id="seriesText"></div>

                    </small>
                       
                    <small id="series_code_errr" style="color: red;"></small>
                          

              </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-4">

              <div class="form-group">
                
                <label>Profit Center Code: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="profitList"  id="profitId" name="pfctcode" class="form-control  pull-left" value="{{$FirstpfctCode}}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly>

                      <datalist id="profitList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($pfct_list as $key)

                        <option value='<?php echo $key->pfct_code?>'   data-xyz ="<?php echo $key->pfct_name; ?>" ><?php echo $key->pfct_name ; echo " [".$key->pfct_code."]" ; ?></option>

                        @endforeach

                      </datalist>

                  </div>
                  <small>  

                      <div class="pull-left showSeletedName" id="profitText"></div>

                  </small>
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

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">
        
          <div class="box-body">
         
            <!-- <form id="cahsbanktranssss" method="POST" name='students' action="{{ url('save-cash-bank-transaction') }}"> -->
            <form id="contratransaction">
              @csrf

            
              <div class="table-responsive">
                <input type="hidden" value="{{$FirstvrNum}}" name="flgup">
                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                  <tr>
                    <th>To /From</th>
                    <th>Account Code</th>
                    <th>Account Name</th>
                    <th>Debit-DR</th>
                    <th>Credit-CR</th>
                  </tr>
                  <tr class="useful">
                    <td>Given To (Dr)</td>
                    <td class="tdthtablebordr">
                      <div class="input-group">
                      <input list="AccList1" class="inputboxclr getacccode" style="width: 107px;margin-bottom: 5px;" id='acc_code1' name="acc_code[]" value="{{$FirstAccCode}}" onchange="AccListData(1);GetAccountCode(1)" oninput="this.value = this.value.toUpperCase()"/>

                        <datalist id="AccList1">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($List_acc_Code as $key)

                            <option value='<?php echo $key->gl_code?>' data-xyz ="<?php echo $key->gl_code; ?>" ><?php echo $key->gl_name; ?></option>

                            @endforeach

                          </datalist>
                      </div>
                    </td>
                    <td class="tdthtablebordr">
                      <input type="text" class="inputboxclr getAccNAme" style="width: 230px;margin-bottom: 5px;" value="{{$FirstAccName}}" id='acc_name1' name="acc_name[]"  readonly />
                    </td>
                    <td>
                      <input type="text" class="debitcreditbox inputboxclr" name="debit_to[]" value="{{$FirstdebitTo}}">
                    </td>
                    <td>
                      <input type="text" class="debitcreditbox inputboxclr" name="credit_by[]" hidden>
                    </td>
                   
                  </tr>
                  <tr class="useful">
                    <td>Taken From (Cr)</td>
                    <td class="tdthtablebordr">
                      <div class="input-group">
                      <input list="AccList2" class="inputboxclr getacccode" style="width: 107px;margin-bottom: 5px;" id='acc_code2' name="acc_code[]" value="{{$secondAccCode}}" onchange="AccListData(2);GetAccountCode(2)" oninput="this.value = this.value.toUpperCase()"/>

                        <datalist id="AccList2">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($List_acc_Code as $key)

                            <option value='<?php echo $key->gl_code?>' data-xyz ="<?php echo $key->gl_code; ?>" ><?php echo $key->gl_name;?></option>

                            @endforeach

                          </datalist>
                      </div>
                    </td>
                    <td class="tdthtablebordr">
                      <input type="text" class="inputboxclr getAccNAme" style="width: 230px;margin-bottom: 5px;" id='acc_name2' value="{{$secondAccName}}" name="acc_name[]" readonly />
                    </td>
                    <td>
                       <input type="text" class="debitcreditbox inputboxclr" name="debit_to[]" hidden>
                    </td>
                    <td>
                      <input type="text" class="debitcreditbox inputboxclr" name="credit_by[]" value="{{$secondCreditBy}}">
                    </td>
                   
                  </tr>
                  <tr>
                    <td colspan="3">
                       <label for="" class="instrumentlbl">I Type</label>
                      <input list="InstTypeList" id="inst_type" class="instTypeMode getinstrument" name="instrument_type" value="{{$Firstinstrumentpe}}" placeholder="Select I Type">

                          <datalist id="InstTypeList">
                            <option selected="selected" value="">-- Select --</option>
                            
                            <option value='CH' data-xyz ="Cheque">Cheque[CH]</option>
                            <option value='DD' data-xyz ="Demand Draft">Demand Draft[DD]</option>
                            <option value='TR' data-xyz ="Transfer receipt">Transfer receipt[TR]</option>
                            <option value='TT' data-xyz ="Tele Transfer">Tele Transfer[TT]</option>  
                            <option value='MT' data-xyz ="Money Transfer">Money Transfer[MT]</option>
                            <option value='RT' data-xyz ="RTGS">RTGS[RT]</option>     
                            <option value='BA' data-xyz ="Bank Advise">Bank Advise[BA]</option>     
                            <option value='EC' data-xyz ="Electronic Clearence">Electronic Clearence[EC]</option>     
                            <option value='NA' data-xyz ="Not Applicable">Not Applicable[NA]</option>     

                          </datalist>
                          <label>cheque No.</label>

                      <input type="text" class="inputboxclr onchenkno" style="width: 85px;margin-bottom: 4px;" id="cheque_no" value="{{$Firstinstnum}}" name="instrument_no">
                      <label>Cheque Date</label>


                      <?php $instrumntdate = $Firstinstdate;  
                     $checquedate = date("d-m-Y", strtotime($instrumntdate)); ?>
                      
                      <input type="text" class="transdatepicker" name="instrument_date" id="instrumentDate" placeholder="Select Date" value="{{ $checquedate }}" style="width: 26%;" readonly="">


                    <small id="showmsgforinstrudate" style="float: right;"></small>
                    </td>
                    <td colspan="2">
                      <label>Perticular</label>
                        <textarea rows="1" type="text" style="width: 230px;" name="particular">{{$Firstparticular}}</textarea>
                    </td>
                  </tr>
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


<!-- <script src="{{ URL::asset('public/dist/js/viewjs/cash_bank_trans.js') }}" ></script> -->



<script type="text/javascript">
  /*account code list*/
  function AccListData(AccCode){

        var accountcode =  $('#acc_code'+AccCode).val();

         var xyz = $('#AccList'+AccCode+' option').filter(function() {

            return this.value == accountcode;

            }).data('xyz');

            var msg = xyz ?  xyz : 'No Match';

            if(msg=='No Match'){

               $('#acc_code'+AccCode).val('');
               $('#acc_name'+AccCode).val('');
            }else{
              
            }

  }
/*account code list*/
  $(document).ready(function() {


    /*series code*/
  $("#series_code").bind('change', function () {
    var seriescode =  $(this).val();
    var xyz = $('#seriesList option').filter(function() {

      return this.value == seriescode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    document.getElementById("seriesText").innerHTML = msg; 

    if(msg=='No Match'){
       $(this).val('');
       document.getElementById("seriesText").innerHTML = '';
       $('#CodeSeries').val('');
    }else{
      $('#CodeSeries').val(seriescode);
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

    document.getElementById("profitText").innerHTML = msg; 

      if(msg=='No Match'){
         $(this).val('');
         $('#ProfitCenterCode').val('');
         document.getElementById("profitText").innerHTML = '';
      }else{
              $('#ProfitCenterCode').val(val);
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
          return false;
        }else{
          $('#showmsgfordate').html('');
          $('#contraDate').val(transDate);
          $('#companyName').val(compcode);
          $('#fisclYear').val(fyyear);
          $('#seqVrNum').val(vrseqno);
          $('#transContraCode').val(transcode);
          return true;
        }
    });
    /*vr date*/

    $('#instrumentDate').on('change',function(){
         var instrumntDate =  $('#instrumentDate').val();
         var slipD =  instrumntDate.split('-');
         var Tdate = slipD[0];
         var Tmonth = slipD[1];
         var Tyear = slipD[2];
         var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;

         var selectedinstDate = new Date(getproperDate);
         var todayDate = new Date();

        if(selectedinstDate > todayDate){
          $('#showmsgforinstrudate').html('Cheque Date Can Not Be Greater Than Today').css('color','red');
          $('#instrumentDate').val('');
          return false;
        }else{
          $('#showmsgforinstrudate').html('');
          return true;
        }

    });

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
  

  function GetAccountCode(Accid){
    //console.log(Accid);
      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      var accountcode =  $('#acc_code'+Accid).val();

        $.ajax({

              url:"{{ url('acc-code-for-contra') }}",

               method : "POST",

               type: "JSON",

               data: {accountcode: accountcode},

               success:function(data){

                    var data1 = JSON.parse(data);
               
                    if (data1.response == 'error') {

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                        if(data1.data==''){
                          var accNAme = '';
                          $('#acc_name'+Accid).val(accNAme);
                        }else{
                          if(data1.data[0].bank_name){
                            var banknme = ' - '+data1.data[0].bank_name;
                          }else{
                            var banknme ='';
                          }
                          $('#acc_name'+Accid).val(data1.data[0].bank_code+banknme);
                        }

                    }
               }

          });

  }



</script>



<script type="text/javascript">



$(document).ready(function(){

   $("#submitdata").click(function(event) {



            var data = $("#contratransaction").serialize();

              $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                    }
              });

              $.ajax({

                  type: 'POST',

                  url: "{{ url('/form-contra-transaction-update') }}",

                  data: data, // here $(this) refers to the ajax object not form

                  success: function (data) {

                  //  console.log(data);

                   window.location.href = "{{ url('/finance/view-contra-transaction') }}";
                  },

              });
             

   });

});

</script>


@endsection