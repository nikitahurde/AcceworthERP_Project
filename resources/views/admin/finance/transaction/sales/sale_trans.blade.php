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
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  @media screen and (max-width: 600px) {

    .PageTitle{

      float: left;

    }

  }

  .rightcontent{

    text-align:right;


  }

  ::placeholder {
    
    text-align:left;
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

  input:focus{border:1px solid yellow;} 

  .space{margin-bottom: 2px;}


  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 6px;

    padding-bottom: 0px !important;

    line-height: 1.42857143;

    vertical-align: top;

    border-top: 1px solid #ddd;

    text-align: center;
  }

  .tdsratebtn{

    margin-top: 3% !important;

    font-weight: 600 !important;

    font-size: 10px !important;

  }

  .modltitletext{
    font-weight: 800;
    color: #5696bb;
    font-size: 16px;
  }
  .box-header>.box-tools {

    position: absolute !important;

    right: 10px !important;

    top: 2px !important;

  }
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

  .boxer .boxNF {
    display: table-cell;
    vertical-align: top;
    border-bottom: 1px solid #80808054;
    padding: 5px;
    color: #dd4b39;
    font-size: 16px;
    font-weight: 600;
  }

  .center {
    text-align:center;
  }
  .settaxcodemodel{
    font-size: 16px;
    font-weight: 800;
    color: #5d9abd;

  }
  .srnonum{
    width: 49px !important;
  }
  .inputtaxInd{
    width: 94px !important;
  }
  .qualitychrc{
    width: 66px !important;
  }
  .rightcontent{
    width: 89px !important;
  }
  .hideColm{
  display: none;
  }
  .checkstyling{
    height: 26px;
    width: 17px;
  }
  .table_sim{
  display:table;         
  width:auto;                
  border:1px solid  #666666;         
 
}
.table-row_sim{
  display:table-row;
  width:auto;
  clear:both;
}
.table-row_sim_head{
  display:table-row;
  width:auto;
  clear:both;
  text-align: center;
  font-weight: 600;
}
.table-col_sim{
  float:left;
  display:table-column;         
  width:131px;         
  border:1px solid  #ccc;
  padding: 2px;
}
.table-col_sim_glacc{
  float:left;
  display:table-column;         
  width: 259px;      
  border:1px solid  #ccc;
  padding: 2px;
}
.table-col_sim_srno{
  float:left;
  display:table-column;         
  width:43px;         
  border:1px solid  #ccc;
  padding: 2px;
}
</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales Bill Transaction
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
          <a href="{{ url('/finance/form-transaction-mast') }}"> Sales Bill Transaction</a>
        </li>

       

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Sales Bill Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/transaction/sales/view-sales-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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
          <form id="myForm">
          @csrf
 
            <div class="row">
              
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

                    <input type="text" class="form-control transdatepicker" name="vr" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

                  </div>

                  <small id="showmsgfortransdate" style="color: red;"></small>

                </div>
                <!-- /.form-group -->
              </div> <!-- /. col-md-2 -->

              <div class="col-md-2">

                  <div class="form-group">

                    <label> T Code : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                        <input type="text" class="form-control" name="tran" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                        <input type="hidden" id="transtaxCode" >
                      </div>

                  </div><!-- /.form-group -->
              </div> <!--  /. col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Series Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="seriesList"  id="series_code" name="seriesCode" onchange="getvrnoBySeries()" class="form-control  pull-left" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="seriesList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($series_list as $key)

                        <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                      <input type="hidden" name="series_name" id="seriesName">

                    </div>

                      <input type="hidden" id="seriesGlC" name="seriesGlC">
                    <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>

                    <small id="showSeriesErr" style="color: red;"></small>
                </div><!-- /.form-group -->
              </div> <!-- /. col-md-2 -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Vr No: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>


                    <input type="text" class="form-control" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                  </div>


                 </div>
                <!-- /.form-group -->
              </div> <!-- /. col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Acc Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="{{ old('AccCode')}}" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="AccountList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($acc_list as $key)

                        <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                    <input type="hidden" id="accGlCode" name="accGlCode">
                    <input type="hidden" id="accGlName" name="accGlName"> 
                    <input type="hidden" value="" id="creditLimit">
                    <input type="hidden" value="" id="closingAmt">
                    <small id="shwoErrAccCode" style="color: red;"></small>
                </div><!-- /.form-group -->
              </div> <!-- /. col-md-2 -->
            </div> <!-- /.row -->

            <div class="row">

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Acc Name: <span class="required-field"></span></label>

                      <div class="">

                        <input  id="AccountText" name="AccountText" class="form-control  pull-left" value="" placeholder="Select Account Name" readonly autocomplete="off">
                       
                      </div>

                  </div>
                  <!-- /.form-group -->
                </div><!-- /.col-md-2 -->

                <div class="col-md-3">

                  <div class="form-group" style="margin-bottom: 0px;">

                    <label>Post Good Issue: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                        </div>

                        <input list="saleOrderNoList" class="form-control" id="saleOrderNo" name="plantcode" placeholder="Select Post Good Issue No" maxlength="25" autocomplete="off">

                        <datalist id="saleOrderNoList">

                           <option value="">--SELECT--</option>

                        </datalist>

                      </div>
                      <input type="hidden" name="netAmount" id="netAmount">
                      <small id="pgiErr" style="color: red;"></small>
                      <small id="soNotFound" style="color: red;"></small><br>
                      <small id="shwoErrsalevrno" style="color: red;"></small>
                      <input type="hidden" id="pfctCodeso">
                      <input type="hidden" id="pfctNameso">
                      <input type="hidden" id="plantCodeso">
                      <input type="hidden" id="plantNameso">
                      <input type="hidden" id="dueDayso">
                      <input type="hidden" id="dueDateso">
                      <input type="hidden" id="cpcodeso">
                      <input type="hidden" id="costCenter">
                      <input type="hidden" id="costCentername">
                      <input type="hidden" id="srcodeso">
                      <input type="hidden" id="srnameso">
                      <input type="hidden" id="trptcodeso">
                      <input type="hidden" id="trptnameso">
                      <input type="hidden" id="vehiclenoso">
                      <input type="hidden" id="ebillnoso">
                      <input type="hidden" id="lrnoso">
                      <input type="hidden" id="seriesCodeso">
                      <input type="hidden" id="cpCode">
                  </div>
                    <!-- /.form-group -->
                </div> <!-- /.col-md-2 -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Party Ref. No.: </label>

                      <div class="">

                        <input  id="partyRefNo" name="partyRefNo" class="form-control  pull-left" value="" placeholder="Enter Party Ref. No." readonly autocomplete="off">
                       
                      </div>

                  </div>
                  <!-- /.form-group -->
                </div><!-- /.col-md-2 -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Party Ref. Date: </label>

                      <div class="">

                        <input  id="partyRefDate" name="partyRefDate" class="form-control  pull-left" value="" placeholder="Enter Party Ref. Date" readonly autocomplete="off">
                       
                      </div>

                  </div>
                  <!-- /.form-group -->
                </div><!-- /.col-md-2 -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Rfhead 1 :</label>

                      <div class="input-group">

                        <input  id="rfHeadOne" name="rfHeadOne" class="form-control  pull-left" value="" placeholder="Enter Rfhead 1" readonly autocomplete="off">
                       
                      </div>

                  </div>
                  <!-- /.form-group -->
                </div><!-- /.col-md-2 -->
              
            </div>

            <div class="row">

              <div class="col-md-3">

                <div class="form-group">

                  <label>Rfhead 2 : </label>

                    <div class="">

                      <input  id="rfHeadTwo" name="rfHeadTwo" class="form-control  pull-left" value="" placeholder="Enter Rfhead 2" readonly autocomplete="off">
                     
                    </div>

                </div>
                <!-- /.form-group -->
              </div><!-- /.col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Rfhead 3 : </label>

                    <div class="">

                      <input  id="rfHeadThre" name="rfHeadThre" class="form-control  pull-left" value="" placeholder="Enter Rfhead 3" readonly autocomplete="off">
                     
                    </div>

                </div>
                <!-- /.form-group -->
              </div><!-- /.col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Rfhead 4 : </label>

                    <div class="">

                      <input  id="rfHeadFour" name="rfHeadFour" class="form-control  pull-left" value="" placeholder="Enter Rfhead 4" readonly autocomplete="off">
                     
                    </div>

                </div>
                <!-- /.form-group -->
              </div><!-- /.col-md-2 -->

              <div class="col-md-3">

                <div class="form-group">

                  <label>Rfhead 5 : </label>

                    <div class="">

                      <input  id="rfHeadFive" name="rfHeadFive" class="form-control  pull-left" value="" placeholder="Enter Rfhead 5" readonly autocomplete="off">
                     
                    </div>

                </div>
                <!-- /.form-group -->
              </div><!-- /.col-md-2 -->

            </div> <!-- /.row -->

            <div class="row">
              
              <div class="" style="margin-top: 3.5%;text-align: center;">

                 <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                  <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

              </div>

            </div>

            <div class="row">

              <div class="col-md-4"></div>
              <div class="col-md-4">

                

              </div> <!--  ./col -->
              <div class="col-md-4"></div>
              
            </div> <!-- /. row -->

            <div class="row">
                <p id="checkBoxSelectMsg" style="text-align: center;color:red;padding-top: 10px;"></p>
            </div>
          </form>
            
        </div><!-- /.box-body -->

        <div class="box-body">

          <table id="saleBillManage" class="table table-bordered table-striped table-hover billgenerate">

            <thead class="theadC">

              <tr>

                <th class="text-center" width="5%" style="text-align: left;"><input class='check_all checkstyling'  type='checkbox' id="all_checkbox" /> </th>
                <th class="text-center" width="5%">Vr. No. </th>
                <th class="text-center" width="10%">Vr. Date </th>
                <th class="text-center" width="5%">Trans code </th>
                <th class="text-center" width="10%">Series </th>
                <th class="text-center" width="10%">Plant Code </th>
                <th class="text-center" width="10%">Item Name </th>
                <th class="text-center" width="10%">Qty </th>
                <th class="text-center" width="10%">AQty </th>
                <th class="text-center ratebk">Rate </th>
                <th class="text-center" width="10%">Basic </th>
                <th class="text-center" width="5%">Action </th>
                <th class="text-center hideColm">grandAmt </th>
              </tr>

            </thead>

            <tbody id="defualtSearch">

            </tbody>

            <tfoot align="right">
              <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
            </tfoot>

          </table>

          <div style="text-align: center;">

            <input type="hidden" id="taxaplyYorN" value="NO" name="taxaplyYorN">
            <input type="hidden" id="taxCodeU" value="">
            <button class="btn btn-primary " type="button" id="simulationbtn" disabled><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp;&nbsp; Simulation</button> 

            <button type="button" name="submit" value="submit" id="submitinsalebill" onclick="submitAllData(0)" class='btn btn-success' disabled style="width: 16%;">&nbsp;Submit&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button> 


          <button class="btn btn-success" type="button" onclick="submitAllData(1)" id="submitNDown" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save &amp; Download</button>

            <input type="hidden" id="donwloadStatus" name="donwloadStatus" value="">
        

          </div>

        </div><!-- /.box-body -->

        </div><!-- /.custom -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.section -->

</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showallDataM">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content" style="border-radius: 5px;">
      <div class="modal-header">
        <h5 class="modal-title modltitletext" id="exampleModalLabel" style="font-size: 17px;">Simulation Of Purchase Bill</h5>
      </div>
      <div class="modal-body" id="modelbody">

         <div class="table_sim" >
             <div class="table-row_sim_head" style="background-color: #ffebcd;">
                <div class="table-col_sim_srno">Sr.No.</div>
                <div class="table-col_sim_glacc">Gl / Acc Code</div>
                <div class="table-col_sim">Debit-DR</div>
                <div class="table-col_sim">Credit-CR</div>
            </div>
            <div id="sim_body_data"></div>
          </div>

         <section>

  
        </section>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="">Ok</button>
      </div>
    </div>
  </div>
</div>


<!--  when gl/post & Credit Limit Is Low not applied show model -->

    <div id="gl_not_N_creditLow" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm" style="margin-top: 13%;">
            <div class="modal-content" style="border-radius: 5px;">
                <div class="modal-header" style="text-align: center;">
                    <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                    
                </div>
                <div class="modal-body">
                  <p id="showWhenCrLimitLow"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
                </div>
            </div>
        </div>
    </div>

<!--  when gl/post & Credit Limit Is Low not applied show model -->

@include('admin.include.footer')



<script type="text/javascript">

  $(document).ready(function() {

    $( window ).on( "load", function() {

      var fromdateintrans = $('#FromDateFy').val();

      var todateintrans = $('#ToDateFy').val();

      var fromdateintrans_1 = $('#FromDateFy_1').val();
      var todateintrans_1 = $('#ToDateFy_1').val();

        $('.transdatepicker').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          startDate :fromdateintrans,

          endDate : todateintrans,

          autoclose: 'true'

        });

        $('.partyrefdatepicker').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          startDate :fromdateintrans_1,

          endDate : todateintrans_1,

          autoclose: 'true'

        });

    });

  });

  function getvrnoBySeries(){

    var series = $('#series_code').val();
    var seriesSplit = series.split('[');
    var seriesCode = seriesSplit[0];
    var transcode = $('#transcode').val();

    var xyz = $('#seriesList option').filter(function() {

    return this.value == series;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $('#series_code').val('');
      $('#vrseqnum').val('');
    }else{

      $('#series_code').val(series+'[ '+msg+' ]');
      $('#seriesName').val(msg);

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

            console.log('data1.response',data1.response);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.data == ''){
                    $('#seriesGlC').val('');
                  }else{
                    $('#seriesGlC').val(data1.data[0].POST_CODE);
                  }

                  if(data1.vrno_series == ''){

                  }else{
                    if(data1.vrno_series){
                      var getlastno = data1.vrno_series.LAST_NO;
                    }else{
                      var getlastno = '';
                    }

                    if(data1.vrnodata == ''){
                     // $('#vrseqnum').val(getlastno);
                      $('#vrseqnum').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);
                     // $('#getVrNo').val(lastNo);
                    }
                  }

              }

          }

    });
   
    }

    

  }


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

    });

    $("#all_checkbox").click(function(){
        if(this.checked){
            $('.pb_checkitm').each(function(){
                this.checked = true;
            });
            $('#submitinsalebill').prop('disabled',false);
            $('#submitNDown').prop('disabled',false);
            $('#simulationbtn').prop('disabled',false);
            $('#CalcTaxinDif1').prop('disabled',false);
            $('#settextfot').removeClass('texttotal');
        }else{
             $('.pb_checkitm').each(function(){
                this.checked = false;
              });
             $('#submitinsalebill').prop('disabled',true);
             $('#submitNDown').prop('disabled',true);
             $('#simulationbtn').prop('disabled',true);
             $('#CalcTaxinDif1').prop('disabled',true);
             $('#settextfot').addClass('texttotal');
        }

        var checkedCount = $("#saleBillManage input:checked").length;

        var creditAmount = 0;
        var grandAmt = 0;

        if(checkedCount > 0){

          $("#simulationbtn").prop('disabled',false);
          $("#submitinsalebill").prop('disabled',false);
          $("#submitNDown").prop('disabled',false);
          $("#CalcTaxinDif1").prop('disabled',false);
          $('#settextfot').removeClass('texttotal');
        }else{
          $("#simulationbtn").prop('disabled',true);
          $("#submitinsalebill").prop('disabled',true);
          $("#submitNDown").prop('disabled',true);
          $("#CalcTaxinDif1").prop('disabled',true);
          $('#settextfot').addClass('texttotal');
        }
        for (var i = 0; i < checkedCount; i++) {
          var ii= i+1;
          var amount = $("#saleBillManage input:checked")[i].parentNode.parentNode.children[10].innerHTML;

          var gr_amount = $("#saleBillManage input:checked")[i].parentNode.parentNode.children[12].innerHTML;


          if (amount != "") {
            creditAmount += parseFloat(amount);
          } else {
            creditAmount = 0;
          }

          if (gr_amount !="") {
            grandAmt += parseFloat(gr_amount);
          } else {
            grandAmt = 0;
          }

          $("#netAmt").text(grandAmt.toFixed(2));
          $("#netAmount").val(grandAmt.toFixed(2));
          $("#basicTotalAmt").text(creditAmount.toFixed(2));
        }


    });

    $("#account_code").bind('change', function () {  

          var account_code = $('#account_code').val();
          var trans_code = $('#transcode').val();

          var xyz = $('#AccountList option').filter(function() {

          return this.value == account_code;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
            $('#AccountText').val('');
            $('#account_code').val('');
            $('#accGlCode').val('');
            $('#accGlName').val('');
            $("#saleOrderNo").val();
            $('#saleOrderNoList').empty('');
            $('#pfctCodeso').val('');
            $('#seriesCodeso').val('');
            $('#accountNameTooltip').addClass('tooltiphide');
            $('#pfctNameso').val('');
            $('#plantCodeso').val('');
            $('#plantNameso').val('');
            $('#dueDayso').val('');
            $('#dueDateso').val('');
            $('#cpcodeso').val('');
            $('#costCenter').val('');
            $('#costCentername').val('');
            $('#srcodeso').val('');
            $('#srnameso').val('');
            $('#trptcodeso').val('');
            $('#trptnameso').val('');
            $('#vehiclenoso').val('');
            $('#ebillnoso').val('');
            $('#lrnoso').val('');
            $('#cpCode').val('');
            $('#saleOrderNo').val('');
          }else{

            $('#accGlCode').val('');
            $('#accGlName').val('');
            $("#saleOrderNo").val();
            $('#saleOrderNoList').empty('');
            $('#pfctCodeso').val('');
            $('#seriesCodeso').val('');
            $('#pfctNameso').val('');
            $('#plantCodeso').val('');
            $('#plantNameso').val('');
            $('#dueDayso').val('');
            $('#dueDateso').val('');
            $('#cpcodeso').val('');
            $('#costCenter').val('');
            $('#costCentername').val('');
            $('#srcodeso').val('');
            $('#srnameso').val('');
            $('#trptcodeso').val('');
            $('#trptnameso').val('');
            $('#vehiclenoso').val('');
            $('#ebillnoso').val('');
            $('#lrnoso').val('');
            $('#saleOrderNo').val('');
            $('#cpCode').val('');

            $('#AccountText').val(msg);
          //  $('#accountName').val(msg);

            $('#accountNameTooltip').removeClass('tooltiphide');

            $('#accountNameTooltip').html(msg);

            $.ajaxSetup({

              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

            $.ajax({

              url:"{{ url('check-state-n-get-trans-by-sale-vrno') }}",

              method : "POST",

              type: "JSON",

              data: {account_code: account_code,trans_code:trans_code},

              success:function(data){

                var data1 = JSON.parse(data);
                // console.log('data1.data',data1.response);
                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>"); 
                   $('#soNotFound').html('Post Goods Issue No. Not Found');
                      $('#saleOrderNo').prop('readonly',true);                     

                }else if(data1.response == 'success'){

                   if(data1.sale_quotation_data== ''){
                      $('#soNotFound').html('Post Goods Issue No. Not Found');
                      $('#saleOrderNo').prop('readonly',true);
                    }else{
                     $("#saleOrderNoList").empty();
                     $('#saleOrderNo').val('');
                     $('#saleOrderNo').prop('readonly',false);
                     $('#soNotFound').html('');
                      $.each(data1.sale_quotation_data, function(k, getData){

                        console.log('getData',getData);

                        var startyear = getData.FY_CODE;
                        var getyear = startyear.split("-");

                        $("#saleOrderNoList").append($('<option>',{

                          value:getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,

                          'data-xyz':getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
                          text:getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO

                        }));

                      }); 

                    }

                    if(data1.acc_GlData == ''){
                      $('#accGlCode').val('');
                      $('#accGlName').val('');
                    }else{
                      $('#accGlCode').val(data1.acc_GlData.GL_CODE);
                      $('#accGlName').val(data1.acc_GlData.GL_NAME);
                    }

                    if(data1.creditLimit == ''){

                    }else{
                      $('#creditLimit').val(data1.creditLimit);
                    }

                    if(data1.data_opngAmt == ''){

                    }else{

                      var count = data1.data_opngAmt.length;
                      var lastAmt = parseInt(count) - 1;
                      var clsongAmt = data1.data_opngAmt[lastAmt].balence;
                      var removeComma=clsongAmt.replace(/\,/g,'');
                    
                      var closingAmt = Math.abs(removeComma);
                      $('#closingAmt').val(closingAmt);
                  
                    }

                } /*if close*/

              }  /*success function close*/

            });  /*ajax close*/

          }

    });


    $("#saleOrderNo").bind('change', function () {  

        var soVrno = $(this).val();
       
        var xyz = $('#saleOrderNoList option').filter(function() {

        return this.value == soVrno;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';
           // console.log('msg',msg);

        if(msg == 'No Match'){

          $('#saleOrderNo').val('');
          $('#pfctCodeso').val('');
          $('#pfctNameso').val('');
          $('#plantCodeso').val('');
          $('#plantNameso').val('');
          $('#dueDayso').val('');
          $('#dueDateso').val('');
          $('#cpcodeso').val('');
          $('#costCenter').val('');
          $('#costCentername').val('');
          $('#srcodeso').val('');
          $('#srnameso').val('');
          $('#trptcodeso').val('');
          $('#trptnameso').val('');
          $('#vehiclenoso').val('');
          $('#ebillnoso').val('');
          $('#lrnoso').val('');
          $('#seriesCodeso').val('');
          $('#cpCode').val('');

        }else{
          $('#pfctCodeso').val('');
          $('#pfctNameso').val('');
          $('#plantCodeso').val('');
          $('#plantNameso').val('');
          $('#dueDayso').val('');
          $('#dueDateso').val('');
          $('#cpcodeso').val('');
          $('#costCenter').val('');
          $('#costCentername').val('');
          $('#srcodeso').val('');
          $('#srnameso').val('');
          $('#trptcodeso').val('');
          $('#trptnameso').val('');
          $('#vehiclenoso').val('');
          $('#ebillnoso').val('');
          $('#lrnoso').val('');
          $('#seriesCodeso').val('');
          $('#cpCode').val('');

          $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

          });

          $.ajax({

            url:"{{ url('get-soetail-by-so-vrno') }}",

            method : "POST",

            type: "JSON",

            data: {soVrno: soVrno},

            success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){

                 if(data1.data== ''){

                    $('#pfctCodeso').val('');
                    $('#pfctNameso').val('');
                    $('#plantCodeso').val('');
                    $('#plantNameso').val('');
                    $('#dueDayso').val('');
                    $('#dueDateso').val('');
                    $('#cpcodeso').val('');
                    $('#costCenter').val('');
                    $('#costCentername').val('');
                    $('#srcodeso').val('');
                    $('#srnameso').val('');
                    $('#partyRefNo').val('');
                    $('#partyRefDate').val('');
                    $('#rfHeadOne').val('');
                    $('#rfHeadTwo').val('');
                    $('#rfHeadThre').val('');
                    $('#rfHeadFour').val('');
                    $('#rfHeadFive').val('');
                    $('#cpCode').val('');
                    $('#trptcodeso').val('');
                    $('#trptnameso').val('');
                    $('#vehiclenoso').val('');
                    $('#ebillnoso').val('');
                    $('#lrnoso').val('');
                    
                  }else{
                    $('#pfctCodeso').val(data1.data[0].PFCT_CODE);
                    $('#pfctNameso').val(data1.data[0].PFCT_NAME);
                    $('#plantCodeso').val(data1.data[0].PLANT_CODE);
                    $('#plantNameso').val(data1.data[0].PLANT_NAME);
                    $('#dueDayso').val(data1.data[0].DUEDAYS);
                    $('#dueDateso').val(data1.data[0].DUEDATE);
                    $('#cpcodeso').val(data1.data[0].CPCODE);
                    $('#costCenter').val(data1.data[0].COST_CENTER);
                    $('#costCentername').val(data1.data[0].COST_CENTER_NAME);
                    $('#srcodeso').val(data1.data[0].SR_CODE);
                    $('#srnameso').val(data1.data[0].SR_NAME);
                    //$('#seriesCodeso').val(data1.data[0].series_code);
                    $('#partyRefNo').val(data1.data[0].PREFNO);
                    $('#partyRefDate').val(data1.data[0].PREFDATE);
                    $('#rfHeadOne').val(data1.data[0].RFHEAD1);
                    $('#rfHeadTwo').val(data1.data[0].RFHEAD2);
                    $('#rfHeadThre').val(data1.data[0].RFHEAD3);
                    $('#rfHeadFour').val(data1.data[0].RFHEAD4);
                    $('#rfHeadFive').val(data1.data[0].RFHEAD5);
                    $('#cpCode').val(data1.data[0].CPCODE);
                    $('#trptcodeso').val(data1.data[0].TRPT_CODE);
                    $('#trptnameso').val(data1.data[0].TRPT_NAME);
                    $('#vehiclenoso').val(data1.data[0].VEHICAL_NO);
                    $('#ebillnoso').val(data1.data[0].E_WAY_BILL_NO);
                    $('#lrnoso').val(data1.data[0].LR_NO);
                  }


              } /*if close*/

            }  /*success function close*/

          });  /*ajax close*/

        }

    });

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


    $('#vr_date').on('change',function(){
        var trans_date = $('#vr_date').val();
        var slipD =  trans_date.split('-');
        var Tdate = slipD[0];
        var Tmonth = slipD[1];
        var Tyear = slipD[2];
        var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;   
        var selectedDate = new Date(getproperDate);
        var todayDate = new Date();  

        if(selectedDate > todayDate){

          $('#showmsgfortransdate').html('Transaction Date Can Not Be Greater Than Today').css('color','red');
          $('#vr_date').val('');
          return false;

        }else{
          $('#showmsgfortransdate').html('');
          return true;
        }    

    });

    $('#partyBilDate').on('change',function(){
        var partyDate = $('#partyBilDate').val();
        var slipD =  partyDate.split('-');
        var Tdate = slipD[0];
        var Tmonth = slipD[1];
        var Tyear = slipD[2];
        var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;   
        var selectedDate = new Date(getproperDate);
        var todayDate = new Date();  

        if(selectedDate > todayDate){

          $('#showmsgfordate').html('Party Bill Date Can Not Be Greater Than Today').css('color','red');
          $('#partyBilDate').val('');
          return false;

        }else{
          $('#showmsgfordate').html('');
          return true;
        }    

    });

  });

</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.billgenerate').DataTable({
            "scrollX": true
    });
  });

  function CalculateTax(taxid){

    $.ajaxSetup({
        headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
    });

      var basicAmt = $('#sobasicAmt'+taxid).val();
      
      $('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt);

      var poiHeadId  = $('#soheadid'+taxid).val();
      var poiBodyId  = $('#sobodyid'+taxid).val();
      var ItemCode = $('#soitmcode'+taxid).val();
      var tax_code = $('#sotaxcode'+taxid).val();

      $.ajax({

              url:"{{ url('get-a-field-calc-by-tax-in-sales') }}",

              method : "POST",

              type: "JSON",

              data: {poiHeadId: poiHeadId,poiBodyId:poiBodyId,ItemCode:ItemCode,tax_code:tax_code},

              success:function(data){
                  //console.log(data);
                  var data1 = JSON.parse(data);
                   //console.log('Get Data => ',data1);
                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      $("#CalcTax1").prop('disabled',false);

                    //console.log('data1.data',data1.data);
                      
                        if(data1.data==''){

                        }else{

                        var basicheadval = parseFloat($('#basic'+taxid).val());

                          var counter = 1;

                          var countI ='';

                          var dataI ='';

                          $('#tax_rate_'+taxid).empty();

                          var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div><div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div></div>";

                          $('#tax_rate_'+taxid).append(TableHeadData);

                          $.each(data1.data, function(k, getData) {
                           
                            var datacount = data1.data.length;

                            dataI = datacount;

                            $('#data_count'+taxid).val(datacount);

                             $('#tax_code'+taxid).val(getData.tax_code);

                             if(getData.TAX_AMT){
                                var taxAmt = getData.TAX_AMT;
                             }else{
                                var taxAmt =0;
                             }

                             if(getData.TAXGL_CODE == null || getData.TAXGL_CODE == ''){
                                var GLCODE ='';
                             }else{
                                var GLCODE =getData.TAXGL_CODE;
                             }

                             if(getData.TAX_LOGIC == null || getData.TAX_LOGIC == ''){
                                var TAXLOGIC ='';
                             }else{
                                var TAXLOGIC =getData.TAX_LOGIC;
                             }

                           var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly></div><div class='box10 rateIndbox'> <input type='text' class='form-control rateindx' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' readonly> </div><div class='box10 rateBox'><input type='text' style='width: 100%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 100%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+taxAmt+"' readonly><input type='hidden' name='logic_"+counter+"' id='logic_id_"+taxid+"_"+counter+"' value='"+TAXLOGIC+"'><input type='hidden' name='static_"+counter+"' id='static_id_"+taxid+"_"+counter+"' value='"+getData.STATIC_IND+"'><input type='hidden' name='gl_"+counter+"' id='glcode_"+taxid+"_"+counter+"' value='"+GLCODE+"'></div></div> ";

                            $('#tax_rate_'+taxid).append(TableData);

                            var IndexSelct = getData.rate_index;

                             objcity = data1.data_rate;

                                $.each(objcity, function (i, objcity) {

                                  var rateSel = '';

                                  if(IndexSelct == objcity.rt_value){

                                    $('#indicator_'+taxid+'_'+counter).append($('<option>',

                                    { 

                                      value: objcity.rt_value,

                                      text : objcity.rt_value+' = '+objcity.rate_name,

                                      selected : true

                                    }));

                                  }else{
                                  
                                     $('#indicator_'+taxid+'_'+counter).append($('<option>',

                                      { 

                                        value: objcity.rt_value,

                                        text : objcity.rt_value+' = '+objcity.rate_name,

                                        selected : false

                                      }));

                                  }

                              }); // .each loop

                             countI = counter;

                            counter++;

                          });  

                         // console.log('dataI',dataI);
                        //  console.log('countI',countI);
                      
                         var butn =  $('#footer_tax_btn'+taxid).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                          var tblData = "<button type='button' class='btn btn-primary ' style='width: 10%;' data-dismiss='modal' id='ApplyOkbtn"+taxid+"' >Ok</button>";

                            $('#footer_tax_btn'+taxid).append(tblData);

                           /* var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'  >Cancel</button>";
                             
                           $('#footer_ok_btn'+taxid).append(cancelfooter);*/

                         }else{

                         }

                        }

                    } // success close

              } //success function close

      }); //ajax close 

  } /*function close*/

  function qty_parameter(qty){

    var ItemCode = $('#soitmcode'+qty).val();
    var poi_HeadId = $("#soheadid"+qty).val();
    var poi_BodyId = $("#sobodyid"+qty).val();

      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/get-quo-paramter-for-item-sales') }}",

            data: {ItemCode:ItemCode,poi_HeadId:poi_HeadId,poi_BodyId:poi_BodyId}, // here $(this) refers to the ajax object not form

            success: function (data) {


              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      if(data1.data==''){
                          $('#qua_par_'+qty).empty();
                          var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div><div class='box10 amountBox'>VendorQcValue</div><div class='box10 amountBox'>ActualQcValue</div><div class='box10 amountBox'>ThirdPartyQcValue</div></div><div class='box-row'><div class='boxNF' style='border-left: 1px solid #b0b0b06e;'></div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF'>Not Found</div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF' style='border-right: 1px solid #b0b0b06e;'></div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);
                        }else{

                          $('#qua_par_'+qty).empty();
                           //$('#footer_qaulity_btn'+qty).empty();
                           // $('#footer_ok_btn'+qty).empty();


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);

                        var sr_no=1;
                          $.each(data1.data, function(k, getData) {

                            if(data1.item_code){
                              var item_code = data1.item_code;
                            }else if(getData.ITEM_CODE){
                               var item_code = getData.ITEM_CODE;
                            }

                            if(getData.IQUA_CODE){
                              var IQUACHAR = getData.IQUA_CODE;
                            }else if(getData.IQUA_CHAR){
                               var IQUACHAR = getData.IQUA_CHAR;
                            }

                            if(getData.CHAR_FROMVALUE){
                              var FROM_VALUE = getData.CHAR_FROMVALUE;
                            }else if(getData.VALUE_FROM){
                               var FROM_VALUE = getData.VALUE_FROM;
                            }

                            if(getData.CHAR_TOVALUE){
                              var TO_VALUE = getData.CHAR_TOVALUE;
                            }else if(getData.VALUE_TO){
                               var TO_VALUE = getData.VALUE_TO;
                            }

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control srnonum' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.ICATG_CODE+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 '><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control qualitychrc' value="+IQUACHAR+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+FROM_VALUE+" readonly></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+TO_VALUE+" readonly></div></div>";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });


                          var butn =  $('#footerqp_quality_btn'+qty).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+qty+"'  style='width: 36px;'>Ok</button>";

                           $('#footerqp_quality_btn'+qty).append(tblData);

                           /*  var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>";
                             
                           $('#footerqp_ok_btn'+qty).append(cancelfooter)*/;

                         }else{
                          
                         }

                        }

                    }
           
            
            },

        });

  }  /* ./ quality Paramter*/

</script>

<script type="text/javascript">

    $(document).ready(function(){

         var creditAmount = 0;
         var grandAmt = 0;
        $('#saleBillManage').DataTable();

        $("#saleBillManage").on('change', function() {
          var creditAmount = 0;
          var grandAmt = 0;
            var checkedCount = $("#saleBillManage input:checked").length;
            if(checkedCount > 0){
              $("#simulationbtn").prop('disabled',false);
              $("#submitinsalebill").prop('disabled',false);
              $("#submitNDown").prop('disabled',false);
            }else{
              $("#simulationbtn").prop('disabled',true);
              $("#submitinsalebill").prop('disabled',true);
              $("#submitNDown").prop('disabled',true);
            }
           
            for (var i = 0; i < checkedCount; i++) {
              var ii= i+1;
              var amount = $("#saleBillManage input:checked")[i].parentNode.parentNode.children[10].innerHTML;

              var gr_amount = $("#saleBillManage input:checked")[i].parentNode.parentNode.children[12].innerHTML;

              if (amount != "") {
                creditAmount += parseFloat(amount);
              } else {
                creditAmount = 0;

              }

              if (gr_amount !="") {
                grandAmt += parseFloat(gr_amount);
              } else {
                grandAmt = 0;
              }
            }
           
            $("#basicTotalAmt").text(creditAmount.toFixed(2));
            $("#netAmt").text(grandAmt.toFixed(2));
            $("#netAmount").val(grandAmt.toFixed(2));
        });

    }); 

    function load_data(account_code='',saleOrderNo=''){

      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();


      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
          
      $('#saleBillManage').DataTable({

          footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;

                $( api.column( 9 ).footer() ).html('<div class="texttotal" id="settextfot">Total :- <br> Net Amt :-</div>').css('text-align','right');

                $( api.column( 10 ).footer() ).html('<small id="basicTotalAmt"></small><br><small id="netAmt"></small>');
            
          }, 

          processing: true,
          serverSide: true,
          scrollX: true,
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
             
              buttons: [
                          {
                            extend: 'excelHtml5',
                            exportOptions: {
                                  columns: [1,2,3,4,5,6,7,8,9,10]
                            }
                          },
                          {
                            extend: 'pdfHtml5',
                            filename: 'PURCHASE_BILL_REPORT_'+getdate+'_'+gettime,
                            title: getcomName+'\n'+getFY+'\n'+' PURCHASE BILL REPORT',
                            exportOptions: {
                                  columns: [1,2,3,4,5,6,7,8,9,10]
                            }
                          },
                        ],
          ajax:{
            url:'{{ url("get-data-from-so-fro-sale-bill") }}',
            data: {account_code:account_code,saleOrderNo:saleOrderNo},
            method:"POST",
          },
          columns: [

            {
                data:'DT_RowIndex',
                'render': function (data, type, full, meta){
                  //console.log('full',bodyid);
                  return '<input type="checkbox" name="flit_id[]" class="pb_checkitm checkstyling" value="'+full['SCHALLANHID'] +'/'+full['salchalnbodyid'] +'/'+full['ITEM_CODE'] +'/'+full['DT_RowIndex']+'/'+full['TAX_CODE']+'"><input type="hidden" name="soheadid[]" id="soheadid'+full['DT_RowIndex']+'" value="'+full['SCHALLANHID'] + '"><input type="hidden" name="sobodyid[]"  id="sobodyid'+full['DT_RowIndex']+'" value="'+full['salchalnbodyid'] + '"><input type="hidden" id="soitmcode'+full['DT_RowIndex']+'" name="itmcode[]" class="" value="'+full['ITEM_CODE'] + '"><input type="hidden" id="sotaxcode'+full['DT_RowIndex']+'" name="taxcode[]" class="" value="'+full['TAX_CODE'] + '"><input type="hidden" id="sobasicAmt'+full['DT_RowIndex']+'" name="sobasicAmt[]" class="basicAmtC" value="'+full['BASICAMT'] + '"><input type="hidden" id="pfctcd'+full['DT_RowIndex']+'" name="pfctcd[]" class="" value="'+full['PFCT_CODE'] + '">';
                }
            },
            {
              data:'VRNO',
              name:'VRNO',
              className:'alignRightClass'
            },
            {
              data:'VRDATE',
              className:'alignRightClass',
                render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
                }
            },
            {
              data:'TRAN_CODE',
              name:'TRAN_CODE'
            },
            {
              data:'SERIES_CODE',
              name:'SERIES_CODE'
            },
            {
              data:'PLANT_CODE',
              name:'PLANT_CODE'
            },  
            {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['ITEM_NAME']+'</p>'+'<p style="line-height:2px;font-weight: 700;">('+full['ITEM_CODE']+')</p>';
                    

                      return series;


                         

                     }
        

            },
            {
                data:'QTYISSUED',
                name:'QTYISSUED',
                className:'alignRightClass'
            },
            {
                data:'AQTYISSUED',
                name:'AQTYISSUED',
                className:'alignRightClass'
            },
            {
                data:'RATE',
                name:'RATE',
                className:'ratebk'
            },
            {
                data:'BASICAMT',
                name:'BASICAMT',
                className:'alignRightClass'
            },
            {
                data:'',
                    'render': function (data, type, full, meta){
                    return '<input type="hidden" value="'+full['DRAMT']+'" id="grandAmt'+full['DT_RowIndex']+'"><button type="button" class="btn btn-primary btn-xs tdsratebtn actionBtn" id="CalcTax'+full['DT_RowIndex']+'" data-toggle="modal" data-target="#tds_rate_model'+full['DT_RowIndex']+'" onclick="CalculateTax('+full['DT_RowIndex']+'); ">Calc Tax </button><button type="button" class="btn btn-primary btn-xs tdsratebtn actionBtn" id="qualityParamter'+full['DT_RowIndex']+'" data-toggle="modal" data-target="#qp_model'+full['DT_RowIndex']+'" onclick="qty_parameter('+full['DT_RowIndex']+')">Qlt. Param. </button><div class="modal fade" id="tds_rate_model'+full['DT_RowIndex']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"> <div class="col-md-3"><input type="text" class="settaxcodemodel col-md-7" id="tax_code'+full['DT_RowIndex']+'" style="border: none; padding: 0px;" readonly></div><div class="col-md-6"><h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation</h5></div><div class="col-md-3"></div></div></div><div class="modal-body table-responsive"><div class="boxer" id="tax_rate_'+full['DT_RowIndex']+'"></div></div><div class="modal-footer"><center><span  id="footer_ok_btn'+full['DT_RowIndex']+'"></span><span  id="footer_tax_btn'+full['DT_RowIndex']+'" style="width: 10px;"></span></center> </div></div></div></div><div class="modal fade" id="qp_model'+full['DT_RowIndex']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-md" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"> <h5 class="modal-title modltitletext" id="exampleModalLabel">Qaulity Parameter</h5></div></div></div><div class="modal-body table-responsive"  style="text-align: -webkit-center;"><div class="boxer" id="qua_par_'+full['DT_RowIndex']+'"> </div></div><div class="modal-footer"><center><small style="text-align: center;" id="footerqp_ok_btn'+full['DT_RowIndex']+'"></small><small style="text-align: center;" id="footerqp_quality_btn'+full['DT_RowIndex']+'"></small></center> </div> </div></div></div>';
                }
            },
            {
                data:'DRAMT',
                name:'DRAMT',
                className:'hideColm'
            },
            

          ]


      });

    }


  $(document).ready(function(){

    $('#btnsearch').click(function(){
        
        var series_code  =  $('#series_code').val();
        var partyBilN    =  $('#partyBilNo').val();
        var partyBildate =  $('#partyBilDate').val();
        var partyBilAmt  =  $('#partyBilAmt').val();
        var trans_date   =  $('#vr_date').val();
        var account_code =  $('#account_code').val();
        var so_vrno      =  $('#saleOrderNo').val();
        var getsoNo      = so_vrno.split(' ');
        var saleOrderNo  = getsoNo[2];

        if(series_code!=''){
          $('#showSeriesErr').html('');
          if(account_code !=''){
             $('#shwoErrAccCode').html('');
             if(so_vrno !=''){
                $('#pgiErr').html('');
                $('#saleBillManage').DataTable().destroy();
                load_data(account_code,saleOrderNo);
                $('#grnvnoerr').html('');
                $('#shwoErrAccCode').html('');
                $('#shwoErrdate').html('');
                $('#shwoErrPartyBilAmt').html('');
                $('#shwoErrPartyBildate').html('');
                $('#shwoErrPartyBilNo').html('');
                $('#shwoErrsalevrno').html('');
                $('#vr_date,#account_code,#saleOrderNo,#partyBilNo,#partyBilAmt,#partyBilDate,#series_code').prop('disabled',true);

             }else{
                $('#pgiErr').html('The Post Good Issue field is required.');
             }
          }else{
            $('#shwoErrAccCode').html('The Account Code field is required.');
          }
        }else{
          $('#showSeriesErr').html('The Series Code field is required.');
          
        }
        
    });

    $('#ResetId').click(function(){
              
        $('#account_code').val('');
        $('#AccountText').val('');
        $('#saleOrderNo').val('');
        $('#partyBilNo').val('');
        $('#partyBilAmt').val('');
        $('#account_code').prop('disabled',false);
        $('#AccountText').prop('disabled',true);
        $('#saleOrderNo').prop('disabled',false);
        $('#partyBilNo').prop('disabled',false);
        $('#partyBilAmt').prop('disabled',false);
        $('#partyBilDate').prop('disabled',false);
        $('#saleBillManage').DataTable().destroy();
          load_data();

    });


   /* $('#submitinsalebill').on('click',function(){

      whenproceed();

    });*/


  });
    
  function submitAllData(valD){


    var downloadFlg = valD;
    $('#donwloadStatus').val(downloadFlg);

    //alert(downloadFlg);return false;
    
      var checkboxcount = $('input[type="checkbox"]:checked').length;
      
      if(checkboxcount > 0){
        $('#checkBoxSelectMsg').html('');

          var checkitm          = [];
          var tax_indictorName  = [];
          var rate_indictorName = [];
          var afrate_Name       = [];
          var taxAmount         = [];
          var taxglName         = [];

          $('.pb_checkitm').each(function(){
              if($(this).is(":checked"))
              {
                
               var itmchk = $(this).val();
               checkitm.push(itmchk);
               
              }
          });

          var accCode        = $('#account_code').val();
          var sovrno         = $('#saleOrderNo').val();
          var accountName    = $('#AccountText').val();
          var transcode      = $('#transcode').val();
          var trans_date     = $('#vr_date').val();
          var vrseqnum       = $('#vrseqnum').val();
          var seriesGl       = $('#seriesGlC').val();
          var partyBilNo     = $('#partyBilNo').val();
          var partyBilDate   = $('#partyBilDate').val();
          var rfHeadOne      = $('#rfHeadOne').val();
          var rfHeadTwo      = $('#rfHeadTwo').val();
          var rfHeadThre     = $('#rfHeadThre').val();
          var rfHeadFour     = $('#rfHeadFour').val();
          var rfHeadFive     = $('#rfHeadFive').val();
          var diffcrdr       = $('#diffcrdr').val();
          var totalBasic     = $('#totalBasic').val();
          var pofitcCode     = $('#pfctCodeso').val();
          var plantCodeso    = $('#plantCodeso').val();
          var seriesCode     = $('#seriesCodeso').val();
          var netAmount      = $('#netAmount').val();
          var seriesByTc     = $('#series_code').val();
          var splitSeries    = seriesByTc.split('[');
          var series_Code    = splitSeries[0];
          var accGlCode      = $('#accGlCode').val();
          var accGlName      = $('#accGlName').val();
          var donwloadStatus = $('#donwloadStatus').val();
          var series_name    = $('#seriesName').val();
          var cpCode         = $('#cpCode').val();
          var closingAmt     = parseFloat($('#closingAmt').val());
          var creditLimit    = parseFloat($('#creditLimit').val());

          var pfctNamePgi      = $('#pfctNameso').val();
          var plantNamePgi     = $('#plantNameso').val();
          var dueDayPgi        = $('#dueDayso').val();
          var dueDatePgi       = $('#dueDateso').val();
          var costCnterPgi     = $('#costCenter').val();
          var costCentrNamePgi = $('#costCentername').val();
          var srcodePgi        = $('#srcodeso').val();
          var srcodeNamePgi    = $('#srnameso').val();
          var trptcodePgi      = $('#trptcodeso').val();
          var trptNamePgi      = $('#trptnameso').val();
          var vehicleNoPgi     = $('#vehiclenoso').val();
          var ebillNoPgi       = $('#ebillnoso').val();
          var lrnoPgi          = $('#lrnoso').val();
          var seriesCodePgi    = $('#seriesCodeso').val();

          var NewclosingAmt = parseFloat(netAmount) + closingAmt;
            console.log('NewclosingAmt',NewclosingAmt);

           // console.log('creditLimit',creditLimit);
           // return false;
          //alert(donwloadStatus);return false;
          //var createNote     = $('#createNote').val();
         // var taxcode_crdr   = $('#taxCodeU').val();
          //var glof_autoNot   = $('#glof_autoNot').val();
          //var seriesAutoNote = $('#seriesOf_autoNot').val();
          //var accountGl      = $('#acc_Gl').val();

          if(NewclosingAmt > creditLimit){
            
            $("#gl_not_N_creditLow").modal('show');
            $("#showWhenCrLimitLow").html('The Post Goods Issue Total Amount Should Not Be Greater Than Available Credit Limit.<br> Credit Limit : '+creditLimit+'<br>Credit Avail : '+NewclosingAmt+'<br>Balence :');
          }else{

              $('.overlay-spinner').removeClass('hideloader');

              $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

              });

              $.ajax({

                  url:"{{ url('finance/save-sale-transaction') }}",

                  method : "POST",

                  type: "JSON",

                  data: {checkitm: checkitm,accCode:accCode,sovrno:sovrno,accountName:accountName,transcode:transcode,trans_date:trans_date,vrseqnum:vrseqnum,pofitcCode:pofitcCode,plantCodeso:plantCodeso,seriesCode:seriesCode,series_Code:series_Code,netAmount:netAmount,seriesGl:seriesGl,accGlCode:accGlCode,accGlName:accGlName,donwloadStatus:donwloadStatus,series_name:series_name,cpCode:cpCode,pfctNamePgi:pfctNamePgi,plantNamePgi:plantNamePgi,dueDayPgi:dueDayPgi,dueDatePgi:dueDatePgi,costCnterPgi:costCnterPgi,costCentrNamePgi:costCentrNamePgi,srcodePgi:srcodePgi,srcodeNamePgi:srcodeNamePgi,trptcodePgi:trptcodePgi,trptNamePgi:trptNamePgi,vehicleNoPgi:vehicleNoPgi,ebillNoPgi:ebillNoPgi,lrnoPgi:lrnoPgi,seriesCodePgi:seriesCodePgi,partyBilNo:partyBilNo,partyBilDate:partyBilDate,rfHeadOne:rfHeadOne,rfHeadTwo:rfHeadTwo,rfHeadThre:rfHeadThre,rfHeadFour:rfHeadFour,rfHeadFive:rfHeadFive},
                  success:function(data){

                    var data1 = JSON.parse(data);

                    if (data1.response == 'error') {
                      var responseVar = false;
                      var url = "{{url('Transaction/Sales/Sales-Bill-Save-Msg')}}"
                      setTimeout(function(){ window.location = url+'/'+responseVar; });
                    }else{
                      var responseVar = true;
                      if(downloadFlg == 1){
                        var fyYear   = data1.data[0].FY_CODE;
                        var fyCd     = fyYear.split('-');
                        var seriesCd = data1.data[0].SERIES_CODE;
                        var vrNo     = data1.data[0].VRNO;
                        var fileN    = 'SBILL_'+fyCd[0]+''+seriesCd+''+vrNo;
                        var link = document.createElement('a');
                        link.href = data1.url;
                        link.download = fileN+'.pdf';
                        link.dispatchEvent(new MouseEvent('click'));
                      }
                      var url = "{{url('Transaction/Sales/Sales-Bill-Save-Msg')}}"
                      setTimeout(function(){ window.location = url+'/'+responseVar; });
                    }

                  }
              });

            }
      }else{
        $('#checkBoxSelectMsg').html('Must Be Select At Least One checkbox.');
      }
  }

  
</script>


<script type="text/javascript">
  
  $(document).ready(function(){
      $('#simulationbtn').on('click',function(){

    $('#showallDataM').modal('show');

    var checkboxcount = $('input[type="checkbox"]:checked').length;
    
    var checkitm = [];

      $('.pb_checkitm').each(function(){

        if($(this).is(":checked"))
          {
            
           var itmchk = $(this).val();

           checkitm.push(itmchk);
           
          }

      });

      var seriesGl     = $('#seriesGlC').val();
      var accCode      = $('#account_code').val();
      var netAmnt      = $('#netAmount').val();

      $.ajax({

          url:"{{ url('get-simulation-data-for-sale-bill') }}",

          method : "POST",

          type: "JSON",

          data: {checkitm: checkitm,seriesGl:seriesGl,accCode:accCode,netAmnt:netAmnt},

          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

            }else if(data1.response == 'success'){

                if(data1.data_sim==''){

                }else{

                  var srno = 1;
                  $('#sim_body_data').empty();
                  $.each(data1.data_sim, function(k, getData) {

                    if(getData.IND_ACC_CODE){
                      var accGl = getData.IND_ACC_CODE;
                      var accglName = getData.accName;
                    }else if(getData.IND_GL_CODE){
                      var accGl = getData.IND_GL_CODE;
                      var accglName = getData.glName;
                    }else{
                      var accGl = '--';
                      var accglName = '--';

                    }
                   
                    var bodyData = '<div class="table-row_sim tooltips"><div class="table-col_sim_srno" style="text-align: center;">'+srno+'</div><div class="table-col_sim_glacc"><small class="tooltipcoderef" >'+getData.CODE_NAME+'</small>'+accGl+' ( '+accglName+' )</div><div class="table-col_sim" style="text-align: right;">'+getData.DR_AMT+'</div><div class="table-col_sim" style="text-align: right;">'+getData.CR_AMT+'</div></div>';
                    $('#sim_body_data').append(bodyData);
                  srno++;});   /* ./ each*/

                }

            }


          }

      });
      

   });
  });
</script>

@endsection