@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .Custom-Box {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .box-header>.box-tools {

    position: absolute !important;

    right: 10px !important;

    top: 2px !important;

  }

  .required-field::before {

    content: "*";

    color: red;

  }

  .showAccName{

    border: none;

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

  }

  .defualtSearchNew{

    display: none;

  }

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }
  .alignLeftClass{
    text-align: left;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .showmsg{
    display: none;
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
    border: none;
    padding: 5px;
    color: #dd4b39;
    font-size: 16px;
    font-weight: 600;
  }

  .center {
    text-align:center;
  }

  .right {
    float:right;
  }
  .settaxcodemodel{
    font-size: 16px;
    font-weight: 800;
    color: #5d9abd;

  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .inputtaxInd{
    width: 94px !important;
  }
  .rateindx{
    width: 90px !important;
  }
  .rightcontent{
    width: 89px !important;
  }
  .srnonum{
    width: 49px !important;
  }
  .qualitychrc{
    width: 66px !important;
  }
  .actionBtn{
    font-size: 11px;
    font-weight: 600;
    width: 67px;
  }
  .tooltiphide{
    display: none;
  }
  .dt-buttons{
    margin-bottom: -30px!important;
  }
  .dt-button{
   
    
    display: inline-block!important;
    font-weight: 600 !important;
    text-align: center!important;
    white-space: nowrap!important;
    vertical-align: middle!important;
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    user-select: none!important;
    border: 1px solid transparent!important;
    padding: .375rem .75rem!important;
    font-size: 15px!important;
    line-height: 1.5!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
  }

  .dt-button:before {
    content: '\f02f';
    font-family: FontAwesome;
    padding-right: 5px;
    
  }

  .buttons-excel{

      color: #212529;
      background-color: #ffc107;
      border-color: #ffc107;
  }
  .buttons-excel:before {
    content: '\f1c9';
    font-family: FontAwesome;
    padding-right: 5px;
    
  }
</style>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1>Mul. Purchase Bill Transaction
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

        <a href="{{ url('/finance/form-transaction-mast') }}">Mul. Purchase Bill Transaction</a>

      </li>

    </ul>

  </section>

  <section class="content">

      <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Mul. Purchase Bill Transaction</h2>

          <div class="box-tools pull-right">

            <a href="{{ url('/finance/transaction/view-purchase-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

          </div>

        </div><!-- /.box-header -->

        <div class="box-body">

          <form id="myForm">

            @csrf

              <div class="row">

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Date: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <?php  
                            $FromDate= date("d-m-Y", strtotime($fromDate));  
                            $ToDate= date("d-m-Y", strtotime($toDate));  
                            $CurrentDate =date("d-m-Y");
                        ?>

                        <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                        <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                        <input type="text" class="form-control transdatepicker" name="vr" id="trans_date" value="{{ $CurrentDate }}" placeholder="Select Date" autocomplete="off">

                    </div>
                    <small id="showmsgfortransdate" style="color: red;"></small>
                    <small id="shwoErrdate" style="color: red;"></small>

                  </div>
                  <!-- /.form-group -->
                </div> <!-- ./col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> T Code : </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="tran" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                      <input type="hidden" id="transtaxCode" >

                    </div>
                    <small id="shwoErrtCode"></small>

                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-2">

                  <div class="form-group">

                    <label> Vr No: </label>

                    <div class="input-group">



                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                      <input type="hidden" name="" value="{{$to_num}}" id="vr_last_num">



                      <input type="text" class="form-control" name="vro" value="<?php if($vrNumber==''){echo $last_num;}else{echo $vrNumber+1;} ?>" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">



                    </div>
                    <small id="shwoErrVrNo"></small>

                  </div>
                  <!-- /.form-group -->
                </div> <!-- ./col -->

                <div class="col-md-3">

                  <div class="form-group">
                    
                    <label>Acc Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <?php $account = count($getacc); ?>

                      <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" value="<?php if($account == 1){echo $getacc[0]->acc_code;} ?>" placeholder="Select Account" oninput="this.value = this.value.toUpperCase()" autocomplete="off">

                      <datalist id="AccountList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($getacc as $key)

                          <option value='<?php echo $key->acc_code?>'   data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                    <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>
                    <small id="shwoErrAccCode" style="color: red;"></small>

                  </div>
                <!-- /.form-group -->
                </div>
                  <!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label>Acc Name : <span class="required-field"></span></label>

                    <div class="input-group tooltips">

                      <input  id="AccountText" name="AccountText" class="form-control  pull-left" value="<?php if($account == 1){echo $getacc[0]->acc_name;} ?>" placeholder="Select Account" readonly autocomplete="off">

                      <span class="tooltiptext tooltiphide" id="accountNameTooltip" style="margin-left: -129px;"></span>
                    </div>

                  </div>
                <!-- /.form-group -->
                </div> <!-- ./col -->
                
              </div><!-- ./row -->

              <div class="row">
              
                <div class="col-md-3">

                  <div class="form-group">

                    <label>Purchase Order No : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input  list="prOrdrList" id="prOrdrvrno" name="" class="form-control  pull-left" value="" placeholder="Enter Purchase Order No" autocomplete="off">

                      <datalist id="prOrdrList">
                        
                      </datalist>

                    </div>

                    <small id="prOrdrNotFound" style="color: red;"> </small>
                    <small id="prOrdrerr" style="color: red;"> </small>

                  </div>

                </div> <!-- ./col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Party Bill No: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="text" class="form-control" name="vr" id="partyBilNo" value="" placeholder="Enter Party Bill No" autocomplete="off">

                    </div>  
                    <small id="shwoErrPartyBilNo" style="color: red;"></small>
                  </div>
                  <!-- /.form-group -->
                </div> <!-- ./col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Party Bill Date: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <?php  
                            $FromDate= date("d-m-Y", strtotime($fromDate));  
                            $ToDate= date("d-m-Y", strtotime($toDate));  
                            $CurrentDate =date("d-m-Y");
                        ?>

                        <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                        <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                        <input type="text" class="form-control transdatepicker" name="vr" id="partyBilldate" value="{{ $CurrentDate }}" placeholder="Select Date" autocomplete="off">

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>
                    <small id="shwoErrPartyBildate" style="color: red;"></small>

                  </div>
                  <!-- /.form-group -->
                </div> <!-- ./col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Party Bill Amount: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="text" class="form-control" name="partyBilAmt" id="partyBilAmt" value="" placeholder="Enter Party Bill Amount" autocomplete="off">

                    </div>
                    <small id="shwoErrPartyBilAmt" style="color: red;"></small>

                  </div>
                  <!-- /.form-group -->
                </div> <!-- ./col -->

              </div><!-- ./row --> 

              <div class="row">

                <div class="col-md-4">

                  <div class="">

                   <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                    <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

                  </div>

                </div> <!--  ./col -->
                
              </div> <!-- /. row -->

              <div class="row">
                <p id="checkBoxSelectMsg" style="text-align: center;color:red;padding-top: 10px;"></p>
              </div>

          </form>

        </div><!-- /.box-body -->


        <div class="box-body">

          <table id="mulPurchaseBill" class="table table-bordered table-striped table-hover billgenerate">

            <thead class="theadC">

              <tr>

                <th class="text-center"># </th>
                <th class="text-center">Vr. No. </th>
                <th class="text-center">Vr. Date </th>
                <th class="text-center">Trans code </th>
                <th class="text-center">Series </th>
                <th class="text-center">Plant Code </th>
                <th class="text-center" >Item Name </th>
                <th class="text-center">Qty </th>
                <th class="text-center">AQty </th>
                <th class="text-center">Rate </th>
                <th class="text-center">Basic </th>
                <th class="text-center">Action </th>
              </tr>

            </thead>

            <tbody id="defualtSearch">

            </tbody>
            <tfoot align="right">
              <tr>
                <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
              </tr>
            </tfoot>


          </table>

          <button type="submit" name="submit" value="submit" id="submitinMulpurchasebill" class='btn btn-success'>submit</button> 

        </div><!-- /.box-body -->

      </div><!-- ./custom box -->

  </section> <!-- /.section -->

  <!--show modal when Amount is not equal  -->

    <div id="amntIsNotEqual" class="modal fade" tabindex="-1">
      <div class="modal-dialog modal-sm" style="margin-top: 13%;">
        <div class="modal-content" style="border-radius: 5px;">
          <div class="modal-header">
              <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
          </div>
          <div class="modal-body">
            <p>Total Is Not Equal To Party Bill Amount </p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
          </div>
        </div>
      </div>
    </div>

  <!-- show modal when Amount is not equal -->

</div> <!-- /. content wrapper -->
@include('admin.include.footer')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
 <script>

    $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();
      //Datemask dd/mm/yyyy
      $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
      //Datemask2 mm/dd/yyyy
      $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
      //Money Euro
      $("[data-mask]").inputmask();

    });

 </script>

 <script type="text/javascript">

    $(document).ready(function(){

        $("#account_code").bind('change', function () {  

          var accCode = $(this).val();

          var xyz = $('#AccountList option').filter(function() {

          return this.value == accCode;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
            $('#AccountText').val('');
            $('#account_code').val('');
            $("#prOrdrList").empty();
            $('#prOrdrvrno').val('');
            $('#accountNameTooltip').addClass('tooltiphide'); 

          }else{

            $('#accountNameTooltip').removeClass('tooltiphide');

             $('#accountNameTooltip').html(msg); 

            $('#AccountText').val(msg);

            $.ajaxSetup({

              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

            $.ajax({

              url:"{{ url('get-pur-ordr-no-by-acc-in-mul-purchase-bill') }}",

              method : "POST",

              type: "JSON",

              data: {accCode: accCode},

              success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                    if(data1.data== ''){
                      $('#prOrdrNotFound').html('Purchase Order No. Not Found');
                      $('#prOrdrvrno').prop('readonly',true);

                    }else{

                        $('#prOrdrNotFound').html('');
                        $('#prOrdrvrno').prop('readonly',false);
                        $("#prOrdrList").empty();
                        $('#prOrdrvrno').val('');

                        $.each(data1.data, function(k, getData){

                          var startyear = getData.fiscal_year;
                          var getyear = startyear.split("-");

                          $("#prOrdrList").append($('<option>',{

                            value:getyear[0]+' '+getData.series_code+' '+getData.vr_no,

                            'data-xyz':getyear[0]+' '+getData.series_code+' '+getData.vr_no,
                            text:getyear[0]+' '+getData.series_code+' '+getData.vr_no

                          }));

                        }); 

                    }


                } /*if close*/

              }  /*success function close*/

            });  /*ajax close*/

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
</script>
<script type="text/javascript">

  $(document).ready(function(){

    var creditAmount = 0
    $('#mulPurchaseBill').DataTable();

    $("#mulPurchaseBill").on('change', function() {

      var checkedCount = $("#mulPurchaseBill input:checked").length;
      var creditAmount = 0

      for (var i = 0; i < checkedCount; i++) {

        var amount = $("#mulPurchaseBill input:checked")[i].parentNode.parentNode.children[10].innerHTML

        if (amount != "") {
          creditAmount += parseFloat(amount);
        } else {
          creditAmount = 0;
        }
      }
  
      $("#basicTotalAmt").text(creditAmount.toFixed(2));

    });


    function load_data(account_code='',purOrderNo=''){

      $('#mulPurchaseBill').DataTable({

        footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;

                $( api.column( 9 ).footer() ).html('Total :-').css('text-align','right');

                $( api.column( 10 ).footer() ).html('<small id="basicTotalAmt"></small>');
                    
          
        },  

          processing: true,
          serverSide: true,
          scrollX: true,
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
                            title: 'Purchase Bill Report',
                            exportOptions: {
                                  columns: [1,2,3,4,5,6,7,8,9,10]
                            }
                          },
                    ],
          ajax:{
            url:'{{ url("get-data-from-pur-ordr-for-multi-pur-bill") }}',
            data: {account_code:account_code,purOrderNo:purOrderNo},
            method:"POST",
          },
          columns: [

            {
                data:'DT_RowIndex',
                'render': function (data, type, full, meta){
                  //console.log('full',bodyid);
                  return '<input type="checkbox" name="flit_id[]" class="pb_checkitm" value="'+full['purchase_order_head_id'] +'/'+full['purordrbodyid'] +'/'+full['item_code'] +'/'+full['DT_RowIndex']+'"><input type="hidden" name="poheadid[]" id="poheadid'+full['DT_RowIndex']+'" value="'+full['purchase_order_head_id'] + '"><input type="hidden" name="pobodyid[]"  id="pobodyid'+full['DT_RowIndex']+'" value="'+full['purordrbodyid'] + '"><input type="hidden" id="poitmcode'+full['DT_RowIndex']+'" name="itmcode[]" class="" value="'+full['item_code'] + '"><input type="hidden" id="potaxcode'+full['DT_RowIndex']+'" name="taxcode[]" class="" value="'+full['tax_code'] + '"><input type="hidden" id="pobasicAmt'+full['DT_RowIndex']+'" name="pobasicAmt[]" class="basicAmtC" value="'+full['basic_amt'] + '">';
                }
            },
            {
              data:'vr_no',
              name:'vr_no'
            },
            {
              data:'vr_date',
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
              data:'tran_code',
              name:'tran_code'
            },
            {
              data:'series_code',
              name:'series_code'
            },
            {
              data:'plant_code',
              name:'plant_code'
            },  
            {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['item_name']+'</p>'+'<p style="line-height:2px;font-weight: 700;">('+full['item_code']+')</p>';
                    
                      return series;

                     }
            },
            {
                data:'quantity',
                name:'quantity',
                className:'alignRightClass'
            },
            {
                data:'Aquantity',
                name:'Aquantity',
                className:'alignRightClass'
            },
            {
                data:'rate',
                name:'rate',
                className:'alignRightClass'
            },
            {
                data:'basic_amt',
                name:'basic_amt',
                className:'alignRightClass'
            },
            {
                data:'',
                    'render': function (data, type, full, meta){
                    return '<button type="button" class="btn btn-primary btn-xs tdsratebtn actionBtn" id="CalcTax'+full['DT_RowIndex']+'" data-toggle="modal" data-target="#tds_rate_model'+full['DT_RowIndex']+'" onclick="CalculateTax('+full['DT_RowIndex']+'); ">Calc Tax </button><button type="button" class="btn btn-primary btn-xs tdsratebtn actionBtn" id="qualityParamter'+full['DT_RowIndex']+'" data-toggle="modal" data-target="#qp_model'+full['DT_RowIndex']+'" onclick="qty_parameter('+full['DT_RowIndex']+')">Qlt. Param. </button><div class="modal fade" id="tds_rate_model'+full['DT_RowIndex']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"> <div class="col-md-3"></div><div class="col-md-6"><h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation</h5></div><div class="col-md-3"></div></div></div><div class="modal-body table-responsive"><div class="boxer" id="tax_rate_'+full['DT_RowIndex']+'"></div></div><div class="modal-footer"><center><span  id="footer_ok_btn'+full['DT_RowIndex']+'"></span><span  id="footer_tax_btn'+full['DT_RowIndex']+'" style="width: 10px;"></span></center> </div></div></div></div><div class="modal fade" id="qp_model'+full['DT_RowIndex']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"> <h5 class="modal-title modltitletext" id="exampleModalLabel">Qaulity Parameter</h5></div></div></div><div class="modal-body table-responsive" style="text-align: -webkit-center;"><div class="boxer" id="qua_par_'+full['DT_RowIndex']+'"> </div></div><div class="modal-footer"><center><small style="text-align: center;" id="footerqp_ok_btn'+full['DT_RowIndex']+'"></small><small style="text-align: center;" id="footerqp_quality_btn'+full['DT_RowIndex']+'"></small></center> </div> </div></div></div>';
                }
            },
            

          ]


      });

    }


    /*$('#btnsearch').click(function(){
        
        var partyBilN    =  $('#partyBilNo').val();
        var partyBildate =  $('#partyBilldate').val();
        var partyBilAmt  =  $('#partyBilAmt').val();
        var trans_date  =  $('#trans_date').val();
        var account_code =  $('#account_code').val();
        var grnrvrno     =  $('#grnrvrno').val();

        if (account_code!='' && grnrvrno!='') {
            $('#acccode_err').html('');
            $('#grnvnoerr').html('');
          $('#PurchaseBillManage').DataTable().destroy();
            load_data(account_code,grnrvrno);

        }else{

          $('#acccode_err').html('Enter Account Code');
          $('#grnvnoerr').html('Enter GRN No');
          return false;
        }
        
    });*/


    $('#btnsearch').click(function(){
        
        var partyBilN    =  $('#partyBilNo').val();
        var partyBildate =  $('#partyBilldate').val();
        var partyBilAmt  =  $('#partyBilAmt').val();
        var trans_date  =  $('#trans_date').val();
        var account_code =  $('#account_code').val();
        var puordr_vrno     =  $('#prOrdrvrno').val();
        var getpuOrNo = puordr_vrno.split(' ');
        var purOrderNo = getpuOrNo[2];

        if(partyBilN !=''){
          if(partyBildate !=''){
            if(partyBilAmt !=''){
              if(trans_date !=''){
                if(account_code !=''){

                    $('#mulPurchaseBill').DataTable().destroy();
                    load_data(account_code,purOrderNo);
                    $('#prOrdrerr').html('')
                        $('#shwoErrAccCode').html('')
                        $('#shwoErrdate').html('')
                        $('#shwoErrPartyBilAmt').html('')
                        $('#shwoErrPartyBildate').html('')
                        $('#shwoErrPartyBilNo').html('')
                  
                    }else{
                      $('#shwoErrAccCode').html('Account Code Field Is Required');
                    }
                  }else{
                    $('#shwoErrdate').html('Date Field Is Required');
                  }
                }else{
                   $('#shwoErrPartyBilAmt').html('Party Bill Amount Field Is Required');
                }
            }else{
              $('#shwoErrPartyBildate').html('Party Bill Date Field Is Required');
            }
        }else{
            $('#shwoErrPartyBilNo').html('Party Bill No Field Is Required');
        }
        
    });


  });


</script>

<script type="text/javascript">
  
  function CalculateTax(taxid){

    $.ajaxSetup({
        headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
    });

      var basicAmt = $('#basic'+taxid).val();

      $('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt);


      var poHeadId  = $('#poheadid'+taxid).val();
      var poBodyId  = $('#pobodyid'+taxid).val();
      var itemCode = $('#poitmcode'+taxid).val();
      var tax_code = $('#potaxcode'+taxid).val();

      $.ajax({

              url:"{{ url('get-a-field-calc-for-mul-purchase-bill') }}",

              method : "POST",

              type: "JSON",

              data: {poHeadId: poHeadId,poBodyId:poBodyId,itemCode:itemCode,tax_code:tax_code},

              success:function(data){
                  //console.log(data);
                  var data1 = JSON.parse(data);
                   //console.log('Get Data => ',data1);
                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      $("#CalcTax1").prop('disabled',false);

                     // console.log('data1.data',data1.data);
                      
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

                           var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.tax_ind_name+" readonly></div><div class='box10 rateIndbox'> <input type='text' class='form-control rateindx' name='rate_ind[]' value='"+getData.rate_index+"' id='indicator_"+taxid+"_"+counter+"' readonly> </div><div class='box10 rateBox'><input type='text' style='width: 100%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.tax_rate+"' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 100%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+getData.tax_amt+"' readonly><input type='hidden' name='logic_"+counter+"' id='logic_id_"+taxid+"_"+counter+"' value='"+getData.tax_logic+"'><input type='hidden' name='static_"+counter+"' id='static_id_"+taxid+"_"+counter+"' value='"+getData.static+"'></div></div> ";

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

                         }else{

                         }

                        }

                    } // success close

              } //success function close

      }); //ajax close 

  } /*function close*/

  function qty_parameter(qty){

    var itemCode = $('#poitmcode'+qty).val();
    var poheadid = $("#poheadid"+qty).val();
    var pobodyid = $("#pobodyid"+qty).val();


      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/get-qty-param-frm-pur-order-by-itm') }}",

            data: {itemCode:itemCode,poheadid:poheadid,pobodyid:pobodyid}, // here $(this) refers to the ajax object not form

            success: function (data) {


              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){
                      console.log('data1.data',data1.data);
                      if(data1.data==''){
                         $('#qua_par_'+qty).empty();
                          var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div><div class='box10 amountBox'>VendorQcValue</div><div class='box10 amountBox'>ActualQcValue</div><div class='box10 amountBox'>ThirdPartyQcValue</div></div><div class='box-row'><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF'>Not Found</div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF'></div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);
                        }else{

                          $('#qua_par_'+qty).empty();
                           //$('#footer_qaulity_btn'+qty).empty();
                           // $('#footer_ok_btn'+qty).empty();


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div><div class='box10 amountBox'>VendorQcValue</div><div class='box10 amountBox'>ActualQcValue</div><div class='box10 amountBox'>ThirdPartyQcValue</div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);

                        var sr_no=1;
                          $.each(data1.data, function(k, getData) {

                            if(data1.item_code){
                              var item_code = data1.item_code;
                            }else if(getData.item_code){
                               var item_code = getData.item_code;
                            }

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control srnonum' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.item_category+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 '><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control qualitychrc' value="+getData.iqua_char+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_decs_"+qty+"_"+sr_no+"' name='iqua_desc[]' class='form-control inputtaxInd' value="+getData.iqua_desc+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+getData.char_fromvalue+" ></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+getData.char_tovalue+" ></div><div class='box10 amountBox'><input type='text' id='venQcVal_"+qty+"_"+sr_no+"' name='venQcVal[]' class='form-control rightcontent' value='' ></div><div class='box10 amountBox'><input type='text' id='actualQcVal_"+qty+"_"+sr_no+"' name='actualQcVal[]' class='form-control rightcontent' value='' ></div><div class='box10 amountBox'><input type='text' id='thirdPartyQcVal_"+qty+"_"+sr_no+"' name='thirdPartyQcVal[]' class='form-control rightcontent' value='' ></div></div>";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });


                          var butn =  $('#footerqp_quality_btn'+qty).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+qty+"'  style='width: 36px;'>Ok</button>";

                           $('#footerqp_quality_btn'+qty).append(tblData);

                         }else{
                          
                         }

                        }

                    }
           
            
            },

        });

  }  /* ./ quality Paramter*/

</script>


<script type="text/javascript">

$(document).ready(function() {

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

    $('#partyBilldate').on('change',function(){
        var partyDate = $('#partyBilldate').val();
        var slipD =  partyDate.split('-');
        var Tdate = slipD[0];
        var Tmonth = slipD[1];
        var Tyear = slipD[2];
        var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;   
        var selectedDate = new Date(getproperDate);
        var todayDate = new Date();  

        if(selectedDate > todayDate){

          $('#showmsgfordate').html('Party Bill Date Can Not Be Greater Than Today').css('color','red');
          $('#partyBilldate').val('');
          return false;

        }else{
          $('#showmsgfordate').html('');
          return true;
        }    

    });

    $('#trans_date').on('change',function(){
        var trans_date = $('#trans_date').val();
        var slipD =  trans_date.split('-');
        var Tdate = slipD[0];
        var Tmonth = slipD[1];
        var Tyear = slipD[2];
        var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;   
        var selectedDate = new Date(getproperDate);
        var todayDate = new Date();  

        if(selectedDate > todayDate){

          $('#showmsgfortransdate').html('Transaction Date Can Not Be Greater Than Today').css('color','red');
          $('#trans_date').val('');
          return false;

        }else{
          $('#showmsgfortransdate').html('');
          return true;
        }    

    });

    $('#submitinMulpurchasebill').on('click',function(){

      var basicTotalAmt = $('#basicTotalAmt').html();
      var partyBillNo = $('#partyBilAmt').val();

      /*if (partyBillNo % 1 == 0) {
        var gettype = 'integer';
      } else {
        var gettype = 'decimal';
      }*/

      var checkboxcount = $('input[type="checkbox"]:checked').length;

      if(checkboxcount > 0){

        $('#checkBoxSelectMsg').html('');

          if(basicTotalAmt == partyBillNo){
          
            var checkitm=[];

            $('.pb_checkitm').each(function(){
                if($(this).is(":checked"))
                {
                 var itmchk = $(this).val();
                 checkitm.push(itmchk);
                 
                 }
            });

            var accCode     = $('#account_code').val();
            var prOrdrvrno  = $('#prOrdrvrno').val();
            var accountName = $('#AccountText').val();
            var transCode   = $('#transcode').val();
            var vrseq       = $('#vrseqnum').val();
            var transDate   = $('#trans_date').val();

            $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

            $.ajax({

              url:"{{ url('finance/save-multiple-purchase-bil-transaction') }}",

              method : "POST",

              type: "JSON",

              data: {checkitm: checkitm,accCode:accCode,prOrdrvrno:prOrdrvrno,accountName:accountName,transCode:transCode,vrseq:vrseq,transDate:transDate},

              success:function(data){

                var data1 = JSON.parse(data);
                var msg = data1.message;
                var partyBill = data1.partyBill;

                console.log('partyBill',partyBill);
                console.log('msg',msg);

                if(msg == 'Success'){

                    
                    //  window.location.href = "{{ url('finance/transaction/view-purchase-transaction') }}";
                         
                     // $('#showwhen').removeClass('showmsg');
                      //return false;

                    
                  }

              }

            }); /* /. ajax*/

        }else{

           $("#amntIsNotEqual").modal('show');
        }

      }else{
        $('#checkBoxSelectMsg').html('Must Be Select At Least One checkbox.');
      }

       

        
    });

});
</script>

@endsection


 <!--     var checkedCount = $("#PurchaseBillManage input:checked").length;
    var creditAmount = 0

    for (var i = 0; i < checkedCount; i++) {

      var amount = $(this).find('td:eq(6)').text();
      if (amount != "") {
        creditAmount += parseFloat(amount);
      } else {
        creditAmount = 0;
      }
  
    }
    console.log('creditAmount',creditAmount); -->