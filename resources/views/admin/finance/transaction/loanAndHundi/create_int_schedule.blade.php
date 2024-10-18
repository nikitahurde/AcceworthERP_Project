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
  .rightcontent{
    text-align:right;
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
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 6px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
  }
  .center {
    text-align:center;
  }
  .rightcontent{
    width: 89px !important;
  }
/* ----- excel btn css ------ */

  table.dataTable {
      clear: both;
      margin-top: 10px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }

  /* /.----- excel btn css ------ */

  @media screen and (max-width: 600px) {
    
    .PageTitle{
      float: left;
    }

  }

</style>

<div class="content-wrapper">
        <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Interest Schedule 
        <small>: Add Details</small>
      </h1>

      <ul class="breadcrumb">

        <li>
          <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>
        </li>

        <li>
          <a href="{{ url('/dashboard') }}">Transaction</a>
        </li>

        <li>
          <a href="{{ url('/dashboard') }}">Create Interest Schedule</a>
        </li>

        <li class="active">
          <a href="{{ url('/transaction/property-rental-utility/add-billing-schedule') }}">   Interest Schedule </a>
        </li>

      </ul>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Interest Schedule </h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/transaction/property-rental-utility/view-billing-schedule') }}" class="btn btn-primary btnSize" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Interest Schedule</a>

              </div>

            </div><!-- /.box-header -->

            <div class="box-body">

              <div class="overlay-spinner hideloader"></div>

              <div class="row">

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Acc Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">
                        <i class="fa fa-address-card-o" aria-hidden="true"></i>
                      </div>

                      <input list="accList"  id="accCode"  name="accCode" class="form-control  pull-left" value="{{ old('accCode')}}" placeholder="Select Acc Code" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="accList">

                        <option selected="selected" value="">-- Select --</option>

                        <?php foreach ($accList as $key){?>

                          <option value='<?php echo $key->ACC_CODE;?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                        <?php } ?>

                      </datalist>

                    </div>

                  </div><!-- /.form-group -->

                </div> <!-- /. col-md-2 -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Loan Tran No : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">
                        <i class="fa fa-address-card-o" aria-hidden="true"></i>
                      </div>

                      <input list="loanNoList"  id="loanTrnanNo"  name="loanTrnanNo" class="form-control  pull-left" value="{{ old('loanTrnanNo')}}" placeholder="Select Loan Tran No" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                      <datalist id="loanNoList">

                        <option selected="selected" value="">-- Select --</option>

                      </datalist>

                    </div>

                  </div><!-- /.form-group -->

                </div> <!-- /. col-md-2 -->
              
              </div> <!-- /.row -->

              <div class="row">
                
                <div class="" style="margin-top: 1%;text-align: center;">

                   <button type="button" class="btn btn-primary btnSize" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                    <button type="button" class="btn btn-warning btnSize" name="resetBtn" onClick="window.location.reload();"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

                </div>

              </div>
          
            </div><!-- /.box-body -->

            <div class="box-body">

              <form id="rental_billing_schedule_tbl">
                @csrf
                <div class="table-responsive">

                  <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                    <tr>

                      <th width="5%"> Sr.No.</th>
                      <th  width="15%">Schedule Date</th>
                      <th  width="15%">Interest Amount</th>
                      <th  width="50%">Particular</th>

                    </tr>

                  </table> <!-- ./ Table Close -->

                </div><!-- /div -->

                <p class="text-center">
             
                  <button class="btn btn-success btnSize" type="button" id="submitdata" onclick="submitAllData(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                  <button class="btn btn-warning btnSize" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>
                </p>

              </form>

            </div><!-- /.box-body -->

          </div><!-- /.custom -->

        </div><!-- /.col -->

      </div><!-- /.row -->

    </section><!-- /.section -->

</div>

@include('admin.include.footer')

<script type="text/javascript">

/* -------- START : SEARCH BTN CLICK ----------- */

  $(document).ready(function(){

    $('#btnsearch').click(function(){

      var loanNo = $('#loanTrnanNo').val();
        
       $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/transaction/property-rental-utility/get-sale-order-data') }}",

          data: {loanNo:loanNo}, 

          success: function (data) {

            var data1 = JSON.parse(data);

            console.log('data err',data1);

              if (data1.response == 'error') {

               console.log('error');

               $('#submitdata').prop('disabled',true);

              }else{

                  var srNo = 1;

                  var INITAMT = parseFloat(data1.sale_order_list[0].BASICAMT);

                  if (IncInd == 'Yearly') {

                    var YEARMONTH = 12;
                    var INCMONTH  = 12;

                  }else if(IncInd == 'Half Yearly'){

                    var YEARMONTH = 6;
                    var INCMONTH  = 6;

                  }else if(IncInd == 'Quarterly'){

                    var YEARMONTH = 3;  
                    var INCMONTH  = 3;
                    
                  }else{

                    var YEARMONTH = 1;
                    var INCMONTH  = 1;
                  }


                  for (var i = 0; i < tenureInMh; i++) {

                    if (srNo>YEARMONTH) {

                      YEARMONTH = parseFloat(YEARMONTH) + parseFloat(INCMONTH);
                      var MINCAMT = parseFloat(INITAMT)*parseFloat(IncRate)/100;
                      INITAMT = Math.round(parseFloat(INITAMT) + MINCAMT);

                    }

                    var MPARTICULAR = 'Rent for the month of '+data1.next_date_list[i];

                    var data="<tr><td>"+srNo+".</td>"+
                            "<td><input type='text' class='inputboxclr SetInCenter' style='width: 90px;text-align:right;' value='"+data1.next_date_list[i]+"' id='scheduleDtId"+i+"' name='scheduleDt[]'readonly/></td>"+
                            "<td><input type='text' class='inputboxclr' id='scheduleAmtId"+i+"' name='scheduleAmt[]' readonly value='"+INITAMT+"'/></td>"+
                            "<td><div style=''><textarea type='textarea' class='SetInCenter' style='width:500px;height: 25px;'  id='particular"+i+"' name='particular[]' col='1'>"+MPARTICULAR+"</textarea></td></tr>";
                        $('table').append(data);
                    srNo++;
                  
                  } /* ./ Tenure Count If Close */

                  $('#submitdata').prop('disabled',false);
              }
           
          },

      });

    });

/* -------- END : SEARCH BTN CLICK ----------- */

    $("#accCode").bind('change', function () {  

      var accCode = $('#accCode').val();
      var xyz = $('#accList option').filter(function() {

      return this.value == accCode;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#AccountText').val('');
      }else{
        $('#AccountText').val(msg);
      }

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/transaction/loan-hundi/get-loan-no') }}",

          data: {accCode:accCode}, // here $(this) refers to the ajax object not form

          success: function (data) {

            var data1 = JSON.parse(data);

            console.log('data err',data1);

            if (data1.response == 'error') {

               $('#shwoErrOrderNo').html('*The Sale Order No Not Found.');

            }else{

              $('#shwoErrOrderNo').html('');
              $('#loanNoList').empty();

              $.each(data1.get_data, function(k, getData){

                var fyCd   = getData.FY_CODE;
                var mfyCd  = fyCd.split('-');
                var loanNo = mfyCd[0]+' '+getData.SERIES_CODE+' '+getData.VRNO;

                $("#loanNoList").append($('<option>',{
                  value: loanNo ,
                  'data-xyz': loanNo,
                  text: loanNo

                }));

              });

            }
           
          },

      });

    });

/* -------- START : GET-ACC NAME ON ACC CHANGE ----------- */

  });

/* -------- END : GET-ACC NAME ON ACC CHANGE ----------- */


/* -------- START : SAVE BTN CLICK ----------- */
    
  function submitAllData(valD){

    var downloadFlg = valD;
   
    var formData = $("#rental_billing_schedule_tbl").serializeArray();

    console.log('serialize',formData);

    $('.overlay-spinner').removeClass('hideloader');

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

        type: 'POST',

        url: "{{ url('/transaction/property-rental-utility/save-billing-schedule') }}",

        data: formData,

        success: function (data) {

          var data1 = JSON.parse(data);

          console.log('data err',data1);

            if (data1.response == 'error') {

              console.log('error on save...!');
              var responseVar = false;
              var url = "{{url('/transaction/property-rental-utility/msg-billing-schedule')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

            }else{
             
              $('.overlay-spinner').removeClass('hideloader');
              console.log('success on save...!');
              var responseVar = true;
              var url = "{{url('/transaction/property-rental-utility/msg-billing-schedule')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

            }

          $('.overlay-spinner').addClass('hideloader');

          console.log('response ',data1);
         
        },

    });

  }


/* -------- END : SAVE BTN CLICK ----------- */

  
</script>

@endsection