@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">
  
  .alignLeftClass{
    text-align: left;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .hideshwTbl{
    display: none;
  }
  .widthcolumn{
    width: 15%;
  }
  .amtfield{
    width: 15%;
    text-align: right;
  }
  #resp-table {
      width: 100%;
      display: table;
  }
  .resp-table-body{
      display: table-row-group;
  }
  .resp-table-row{
      display: table-row;
  }
  .table-body-cell{
      display: table-cell;
      border: 1px solid #dddddd;
      padding: 8px;
      line-height: 1.42857143;
      vertical-align: top;
  }
  .hideshowcard{
    display: none;
  }
  .lableHS{
    display: none;
  }
  .texIndbox1{
    text-align: left !important;
  }
  .rightcontent{
    text-align: right !important;
  }
  .bthead{
    text-align: center;
  }
  .b_thead{
    text-align: center;
  }
</style>


<div class="content-wrapper">

  <section class="content-header">

    <h1>Customer/Vendor Position<small>View Details</small></h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}">Report</a></li>

        <li class="active"><a href="{{ url('/view-customer-vendor/position') }}">Customer/Vendor Position</a></li>

      </ol>
  </section>
<!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6" style="display: flex;">
                  <div class="form-group" style="margin-right: 5px;">

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                      <input list="acctypeList" type="text" class="form-control" name="acctype_code" id="acctype_code" placeholder="Select Account type" value="">

                      <datalist id="acctypeList">

                      <option value="">--Select--</option>

                      <?php foreach ($BIL_TRACK as $key) { ?>

                        <option value="<?php echo $key->ATYPE_CODE; ?>" data-xyz="{{ $key->ATYPE_NAME  }}"><?php echo $key->ATYPE_CODE;?> = <?php echo   $key->ATYPE_NAME;?></option>

                      <?php } ?>

                      </datalist>
                                      
                    </div>
                    <small id="acctypeName" class="modltitletext"></small>
                  </div>
                  <div>
                     <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;" id="btnsearch" onclick="searchData()" disabled>Ok</button>
                     <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i>Reset</button>
                  </div>

                </div>
                <div class="col-md-3"></div>
                
            </div>
          </div>
      
          <div class="box-body hideshwTbl" id="recordTbl">

            <table id="custVenData" class="table table-bordered table-striped table-hover">

              <thead>

                <tr>
                  <th class="text-center">Code</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Balence </th>
                </tr>

              </thead>
              <tbody>

              
              </tbody>
            </table>

          </div><!-- /.box-body -->

          <div class="box-body">
            <div id="resp-table">
              <div class="resp-table-body" id="chieldDataOfRow">
                  
              </div>
              <div class="resp-table-body" id="chieldDatapayment">
                  
              </div>
              <div class="resp-table-body" id="chieldDataBalence">
                  
              </div>

            </div>

          </div>

        </div><!-- /.box -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.content -->

</div>


<!-- show modal when bill pending btn click -->

  <div class="modal fade" id="ViewPBT_Detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">

      <div class="modal-content" style="border-radius: 5px;">

        <div class="modal-header">

          <div class="row">
            <div class="col-md-12">
              <h4 class="modal-title modltitletext" id="exampleModalLabel">AGE ANALYSIS OF <small id="partyNC" class="modltitletext"></small></h4>
            </div>
          </div>

        </div>
    
        <div class="modal-body table-responsive" style="margin-left: 79px;">
          <div class="boxer" id="biltrkBody">
                        
          </div>
        </div>

        <div class="modal-footer" style="text-align: center;">
         
          <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;margin-top: 0% !important;">Cancel</button>

        </div>

      </div>

    </div>

  </div>

  <div id="alocModlId">
    
  </div>

<!-- show modal when bill pending btn click -->


@include('admin.include.footer')

<script type="text/javascript">

  $(document).ready(function(){

    $("#acctype_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#acctypeList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
         $(this).val('');
         $('#btnsearch').prop('disabled',true);
      }else{
        var codename = val+'-'+msg;
        $('#acctype_code').val(codename);
        $('#btnsearch').prop('disabled',false);
       
      }

    });

    $('#ResetId').click(function(){
                
        $('#acctype_code').val('');
        $('#custVenData').DataTable().destroy();
        load_data_query();
        $('#btnsearch').prop('disabled',false);
        $('#chieldDataOfRow').empty();
        $('#chieldDatapayment').empty();
        $('#chieldDataBalence').empty();
        $('#btnshow').addClass('hideshowcard');
    });
  });

  function load_data_query(cust_ven= ''){
        $('#btnsearch').prop('disabled',true);
        $('#custVenData').DataTable({

           'fnCreatedRow': function (nRow, aData, iDataIndex) {
                
                $(nRow).attr('onclick', "showDetail(\""+aData['ACC_CODE']+"\",\""+aData['ACC_TYPE']+"\",\""+aData['acc_name']+"\","+aData['ACCTRANID']+");"); // or whatever you choose to set as the id
            },
           processing: true,
           serverSide: true,
           scrollX: true,
           pageLength:'25',
           dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
          
           buttons: [],
         
           ajax:{
               url:'{{ url("/get-data-customer-or-vendor/position") }}',
               data: {cust_ven:cust_ven}
            },
            columns: [

              { 
                data:"ACC_CODE",
                className:"widthcolumn"
              },
              { 
                data:"acc_name",
                className:"alignLeftClass"
              },
              { 
                className:"amtfield",
                render: function (data, type, full, meta) {

                  //console.log('ff',full['ACCTRANID']);
                  
                  var attypecd = full['ACC_TYPE'];

                  if(attypecd == 'C'){
                    return full['clcramt']+'<input type="hidden" value='+full['ACC_TYPE']+' id="acc_type" >';
                  }else if(attypecd == 'D'){
                    return full['cldramt']+'<input type="hidden" value='+full['ACC_TYPE']+' id="acc_type" >';
                  }else{}

                }
              },
              /*{ 
                className:"amtfield",
                render: function (data, type, full, meta) {
                  
                  var attypecd = full['ACC_TYPE'];

                  if(attypecd == 'C'){
                    return full['cldramt']+'<input type="hidden" value='+full['ACC_TYPE']+' id="acc_type" >';
                  }else if(attypecd == 'D'){
                    return full['cldramt']+'<input type="hidden" value='+full['ACC_TYPE']+' id="acc_type" >';
                  }else{}

                }
              },*/
               
            ]

        });
  }

  function searchData(){

    $('#recordTbl').removeClass('hideshwTbl');
    var custven = $('#acctype_code').val();
    var splicd = custven.split('-');
    var cust_ven = splicd[0];
    if(cust_ven!=''){
      $('#custVenData').DataTable().destroy();
      load_data_query(cust_ven);
    }else{
      $('#custVenData').DataTable().destroy();
          load_data_query();
    }

  }

  function showDetail(accCode,accType,accName,accTrnasId){

    var accType = 'C';
    $('#chieldDataOfRow').empty();
    $('#chieldDatapayment').empty();
    $('#chieldDataBalence').empty();


    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    $.ajax({

          url:"{{ url('get-data-for-age-analysis-in-cv-position') }}",

          method : "POST",

          type: "JSON",

          data: {accCode:accCode,accType:accType},

          success:function(data){

              var data1 = JSON.parse(data);

              console.log(data1);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){

                  if(data1.pending_bil==''){
                   
                  }else{
                    $('#btnshow').removeClass('hideshowcard');
                    $('#lableHid').removeClass('lableHS')
                    $('#lableHid1').removeClass('lableHS')
                    $('#lableHid2').removeClass('lableHS')
                    $('#chieldDataOfRow').empty();

                    
                    /*pending bills */

                      var HeadData = '<div class="resp-table-row" style="font-weight: 700;background: #b8daff;"><div class="table-body-cell">'+accCode+'<input type="hidden" value="'+accCode+'" id="selAccCd"><input type="hidden" value="'+accName+'" id="selAccname"><input type="hidden" value="'+accType+'" id="accTypeC"></div><div class="table-body-cell">Action</div><div class="table-body-cell">Cr /Dr</div><div class="table-body-cell">Amount</div><div class="table-body-cell">Avg Days</div><div class="table-body-cell">0-30 Days</div><div class="table-body-cell">31-60 Days</div><div class="table-body-cell">61-90 Days</div><div class="table-body-cell">91-180 Days</div><div class="table-body-cell">180 Days </div></div>';
                      $('#chieldDataOfRow').append(HeadData);
                  
                      $.each(data1.pending_bil, function (i, obj_row) {
                        if(accType == 'D'){ 
                            var amtField = obj_row.DRAMT;
                            var crdr = 'Dr';
                        }else if(accType == 'C'){
                            var amtField = obj_row.CRAMT;
                             var crdr = 'Cr';
                        }

                        var bilmode ='Bill';
                        var url = "{{ url('get-pending-bills-report-data') }}";
                        var BodyData = '<div class="resp-table-row"><div class="table-body-cell"><b>Pending Bills</b></div><div class="table-body-cell"><button type="button" class="btn btn-primary btn-xs viewBilTrak" id="viewpendingBil" data-toggle="modal" data-target="#ViewPBT_Detail" onclick="pendingBills(\''+accCode+'\',\''+bilmode+'\','+accTrnasId+',\''+accType+'\')"><i class="fa fa-search" aria-hidden="true"></i> </button></div><div class="table-body-cell">'+crdr+'</div><div class="table-body-cell alignRightClass">'+amtField+'</div><div class="table-body-cell alignRightClass">'+obj_row.AVG_DAYS+'</div><div class="table-body-cell alignRightClass">'+obj_row.ZtoT+'</div><div class="table-body-cell alignRightClass">'+obj_row.TtoS+'</div><div class="table-body-cell alignRightClass">'+obj_row.StN+'</div><div class="table-body-cell alignRightClass">'+obj_row.Nt0OE+'</div><div class="table-body-cell alignRightClass">'+obj_row.G180+' </div></div>';
                        $('#chieldDataOfRow').append(BodyData);
                      });

                    /*pending bills*/

                  }


                  if(data1.pending_pay==''){

                  }else{

                    /*pending payments*/

                      $('#chieldDatapayment').empty();

                      $.each(data1.pending_pay, function (i, objrow) {
                        if(accType == 'D'){ 
                            var amtFieldpay = objrow.CRAMT;
                            var cr_Dr = 'Cr';
                        }else if(accType == 'C'){
                            var amtFieldpay = objrow.DRAMT;
                            var cr_Dr = 'Dr';
                        }
                         var paymode ='payement';
                        var BodyDatapay = '<div class="resp-table-row"><div class="table-body-cell"><b>Pending Payment</b></div><div class="table-body-cell"><button type="button" class="btn btn-primary btn-xs viewBilTrak" id="viewpendingBil" data-toggle="modal" data-target="#ViewPBT_Detail" onclick="pendingBills(\''+accCode+'\',\''+paymode+'\','+accTrnasId+',\''+accType+'\')"><i class="fa fa-search" aria-hidden="true"></i> </button></div><div class="table-body-cell">'+cr_Dr+'</div><div class="table-body-cell alignRightClass">'+amtFieldpay+'</div><div class="table-body-cell alignRightClass">'+objrow.AVG_DAYS+'</div><div class="table-body-cell alignRightClass">'+objrow.ZtoT+'</div><div class="table-body-cell alignRightClass">'+objrow.TtoS+'</div><div class="table-body-cell alignRightClass">'+objrow.StN+'</div><div class="table-body-cell alignRightClass">'+objrow.Nt0OE+'</div><div class="table-body-cell alignRightClass">'+objrow.G180+' </div></div>';
                        $('#chieldDatapayment').append(BodyDatapay);
                      });
                    /*pending payments*/
                  }


                  if(data1.balence==''){

                  }else{

                    /*balence*/

                      $('#chieldDataBalence').empty();

                      $.each(data1.balence, function (i, objBAL) {

                        if(accType == 'D'){ 
                            var cr_DrB = 'Dr';
                        }else if(accType == 'C'){
                            var cr_DrB = 'Cr';
                        }
                       
                        var BodyDataBAL = '<div class="resp-table-row" style="background: #fbead4;"><div class="table-body-cell"><b>Balence</b></div><div class="table-body-cell"></div><div class="table-body-cell">'+cr_DrB+'</div><div class="table-body-cell alignRightClass">'+objBAL.BALAMT+'</div><div class="table-body-cell alignRightClass">'+objBAL.AVG_DAYS+'</div><div class="table-body-cell alignRightClass">'+objBAL.ZtoT+'</div><div class="table-body-cell alignRightClass">'+objBAL.TtoS+'</div><div class="table-body-cell alignRightClass">'+objBAL.StN+'</div><div class="table-body-cell alignRightClass">'+objBAL.Nt0OE+'</div><div class="table-body-cell alignRightClass">'+objBAL.G180+' </div></div>';
                        $('#chieldDataBalence').append(BodyDataBAL);
                      });
                    /*balence*/
                  }
                  var url = "{{ url('get-pending-bills-report-data') }}";
                  $('#pendingBtn').append('<a href="'+url+'/'+accCode+'" class="btn btn-primary btn-sm"><i class="fa fa-search" aria-hidden="true"></i>Pending</a>')

                      
              }
          }

    });

  }

  function pendingBills(accCode,Dmode,upAccTrnaID,accType){

      $("#ViewPBT_Detail").modal({
        show:false,
        backdrop:'static',
      });

      console.log('Dmode',Dmode);

      var acc_Code   = accCode;
      
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
        url    : "{{ url('get-details-of-pending-bill') }}",
        method : "POST",
        type   : "JSON",
        data   : {acc_Code: acc_Code,Dmode:Dmode,accType:accType},

        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

          }else if(data1.response == 'success'){

            if(data1.pending_bil==''){}else{

              $('#biltrkBody').empty();
              $('#alocModlId').empty();

              if(accType == 'C'){

                if(Dmode == 'Bill'){
                  var amtLable = 'CrAmt';
                }else if(Dmode == 'payement'){
                  var amtLable = 'DrAmt';
                }

              }else if(accType == 'D'){
                
                if(Dmode == 'Bill'){
                  var amtLable = 'DrAmt';
                }else if(Dmode == 'payement'){
                  var amtLable = 'CrAmt';
                }
              }

              var headData = '<div class="box-row"><div class="box10 b_thead">VrNo</div><div class="box10 b_thead" >VrDate</div><div class="box10 b_thead">'+amtLable+'</div><div class="box10 b_thead">Days</div><div class="box10 b_thead">0-30 Days</div><div class="box10 b_thead">31-60 Days</div><div class="box10 b_thead">61-90 Days</div><div class="box10 b_thead">91-180 Days</div><div class="box10 b_thead">180 Days</div><div class="box10 b_thead">Action</div></div>';

              $('#biltrkBody').append(headData);
              var partyNm = $('#selAccname').val();
              $('#partyNC').html(partyNm+' - ( '+acc_Code+' )');

              var srnos=1;


              $.each(data1.pending_bil, function(k, getdata){

                  if(accType == 'C'){

                    if(Dmode == 'Bill'){
                      var crdrAmt = getdata.CRAMT;
                    }else if(Dmode == 'payement'){
                      var crdrAmt = getdata.DRAMT;
                    }

                  }else if(accType == 'D'){

                    if(Dmode == 'Bill'){
                      var crdrAmt = getdata.DRAMT;
                    }else if(Dmode == 'payement'){
                      var crdrAmt = getdata.CRAMT;
                    }
                  }

                  

                  var fyCode   = getdata.FY_CODE;
                  var spli_fy  = fyCode.split('-');
                  var vrSeq    = spli_fy[0]+' '+getdata.SERIES_CODE+' '+getdata.VRNO;
                  var vrDate   = getdata.VRDATE;
                  var spli_vrD = vrDate.split('-');
                  var formDate = spli_vrD[2]+'-'+spli_vrD[1]+'-'+spli_vrD[0];
                  var drVrno   = getdata.VRNO;
                  var drVrDate = getdata.VRDATE;
                  var againstUpId = getdata.ACCTRANID;
                  var bodyData = '<div class="box-row"><div class="box10 bthead">'+vrSeq+'</div><div class="box10 bthead" >'+formDate+'</div><div class="box10 alignRightClass">'+crdrAmt+'</div><div class="box10 alignRightClass">'+getdata.DAYS+'</div><div class="box10 alignRightClass">'+getdata.A1+'</div><div class="box10 alignRightClass">'+getdata.A2+'</div><div class="box10 alignRightClass">'+getdata.A3+'</div><div class="box10 alignRightClass">'+getdata.A4+'</div><div class="box10 alignRightClass">'+getdata.A5+'</div><div class="box10 bthead"><button type="button" class="btn btn-primary btn-xs" id="viewAlocationBill'+srnos+'" data-toggle="modal" data-target="#ViewAlocB_Detail'+srnos+'" onclick="amtAllocation(\''+acc_Code+'\','+crdrAmt+','+srnos+',\''+Dmode+'\','+drVrno+',\''+drVrDate+'\','+upAccTrnaID+',\''+accType+'\','+againstUpId+')"><i class="fa fa-search" aria-hidden="true"></i> Alloc</button></div></div>';
                   $('#biltrkBody').append(bodyData);

                   var alocBody = '<div class="modal fade" id="ViewAlocB_Detail'+srnos+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg" role="document" style="margin-top: 4%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header" style="padding-top: 1px;padding-bottom: 1px;"><div class="row"><div class="col-md-12"><h4 class="modal-title modltitletext" id="exampleModalLabel">'+Dmode+' Allocation</h4></div></div></div><div class="modal-body table-responsive" style="margin-left: 0px;margin-right: 19px;padding-top: 0px;margin-top: 0% !important;"><div class="boxer" id="bilAllocBody'+srnos+'"></div></div><div class="modal-footer" style="text-align: center;" id="bilAlocFooter'+srnos+'"></div></div></div></div>';
                   $('#alocModlId').append(alocBody);


              srnos++;});

    
            }

          }
        }
      });

  }

  function amtAllocation(accCode,crDrAmt,srNum,modepb,drVrno,drDate,upAcTrnsId,accTypes,againstUpID){

    $("#ViewAlocB_Detail"+srNum).modal({
        show:false,
        backdrop:'static',
      });

    var acc_Code   = accCode;

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
        url    : "{{ url('get-details-of-amnt-allocation') }}",
        method : "POST",
        type   : "JSON",
        data   : {acc_Code: acc_Code,modepb:modepb,accTypes:accTypes},

        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

          }else if(data1.response == 'success'){

            if(data1.pending_bil==''){}else{

              console.log('data1.pending_bil',data1.pending_bil);

              $('#bilAllocBody'+srNum).empty();
              $('#bilAlocFooter'+srNum).empty();

              if(accTypes == 'C'){
                if(modepb == 'Bill'){
                    var amntLable = 'CrAmt';
                    var bilPayvrno = 'Payment/VrNo';
                    var bilPayAmt = 'Payment Amt';
                }else if(modepb == 'payement'){
                    var amntLable = 'DrAmt';
                    var bilPayvrno = 'Bill/VrNo';
                    var bilPayAmt = 'Bill Amt';
                }
              }else if(accTypes == 'D'){
                if(modepb == 'Bill'){
                    var amntLable = 'DrAmt';
                    var bilPayvrno = 'Bill/VrNo';
                    var bilPayAmt = 'Bill Amt';
                }else if(modepb == 'payement'){
                    var amntLable = 'CrAmt';
                    var bilPayvrno = 'Payment/VrNo';
                    var bilPayAmt = 'Payment Amt';
                }
              }

              

              var headData = '<div class="box-row"><div class="box10 texIndbox1">'+amntLable+'<input type="hidden" value='+data1.pending_bil.length+' id="rowCounttot"><input type="hidden" id="dr_vrno'+srNum+'" name="drVrno" value='+drVrno+'><input type="hidden" name="drVrDate" id="dr_VrDate'+srNum+'"  value='+drDate+'></div><div class="box10 rateIndbox">Allocated so far</div><div class="box10 rateIndbox">Balence to be Allocated</div><div class="box10 rateBox">Allocated in this session</div><div class="box10 amountBox">Balence</div><div class="box10 amountBox"></div></div><div class="box-row"><div class="box10 texIndbox1 numriRight rightcontent"><small id="crdrAmt'+srNum+'"></small><input type="hidden" value="'+upAcTrnsId+'" id="upAccTrnId'+srNum+'"><input type="hidden" value="'+againstUpID+'" id="upDataAgainstID"></div><div class="box10 rateIndbox"></div><div class="box10 rateIndbox numriRight rightcontent"><small id="balenceCrDr'+srNum+'"></small></div><div class="box10 rateBox rightcontent"><small id="sessionBal">0</small><input type="hidden" value="0" id="hiddenSession_Bal"></div><div class="box10 amountBox rightcontent"><small id="totalBal'+srNum+'"></small><input type="hidden" value="'+crDrAmt+'" id="totalBalence'+srNum+'"></div><div class="box10 amountBox"></div></div>';
              $('#bilAllocBody'+srNum).append(headData);
              $('#balenceCrDr'+srNum).html(crDrAmt);
              $('#crdrAmt'+srNum).html(crDrAmt);
              $('#totalBal'+srNum).html(crDrAmt);

              var headAmt = '<div class="box-row"><div class="box10 bthead" style="width: 20%;">'+bilPayvrno+'</div><div class="box10 bthead">Date</div><div class="box10 bthead" >'+bilPayAmt+'</div><div class="box10 bthead">Prev. Alloc.</div><div class="box10 bthead">Alloc Amt</div><div class="box10 bthead">Bal. Amt</div></div>';
              $('#bilAllocBody'+srNum).append(headAmt);

              var sr_num=1;
              console.log('data1.pending_bil',data1.pending_bil.length);
              $.each(data1.pending_bil, function(k, getdata){
                var vrDate     = getdata.VRDATE;
                var spliDate   = vrDate.split('-');
                var vrDateForm = spliDate[2]+'-'+spliDate[1]+'-'+spliDate[0];
                var sessionYR  = getdata.FY_CODE;
                var splityr    = sessionYR.split('-');
                var vrSeq      = splityr[0]+' '+getdata.SERIES_CODE+' '+getdata.VRNO;

                if(accTypes == 'D'){
                  if(modepb == 'Bill'){
                      var crdrAmnt = getdata.CRAMT;
                  }else if(modepb == 'payement'){
                      var crdrAmnt = getdata.DRAMT;
                  }
                }else if(accTypes == 'C'){
                  if(modepb == 'Bill'){
                      var crdrAmnt = getdata.DRAMT;
                  }else if(modepb == 'payement'){
                      var crdrAmnt = getdata.CRAMT;
                  }
                }
                

                var DataAmt = '<div class="box-row"><div class="box10 texIndbox1">'+vrSeq+'<input type="hidden" name="accTranId[]" id="accTID'+sr_num+'" value="'+getdata.ACCTRANID+'"><input type="hidden" name="cr_vrno[]" id="cr_vrno'+sr_num+'" value="'+getdata.VRNO+'"><input type="hidden" name="cr_vrdate[]" id="cr_vrdate'+sr_num+'" value="'+getdata.VRDATE+'"></div><div class="box10 rateIndbox numriRight">'+vrDateForm+'</div><div class="box10 rateBox" style="text-align: end;">'+crdrAmnt+'<input type="hidden" value="'+crdrAmnt+'" id="billAmt'+sr_num+'"></div><div class="box10 amountBox"><input type="text" name="prevAlocAmt[]" class="rightcontent" id="prevAlocAmt" value="0" readonly></div><div class="box10 amountBox"><input type="text" class="rightcontent allocatAmt" id="aloctAmt'+sr_num+'" value="" name="alocateAmt[]" oninput="alocateAmt('+sr_num+','+srNum+');"></div><div class="box10 amountBox"><input type="text" class="rightcontent" name="balencAmt" id="balencAmt'+sr_num+'" value="'+crdrAmnt+'" readonly></div></div>';
                 $('#bilAllocBody'+srNum).append(DataAmt);
              sr_num++;});

              var baFooter = '<button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;" id="bilTrackSaveBtn1" onclick="saveBillTrack('+srNum+',\''+modepb+'\',\''+acc_Code+'\',\''+accTypes+'\','+againstUpID+');">Save</button><button type="button" class="btn btn-danger" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;margin-top: 0% !important;" onclick="cancleBillTrack('+srNum+')">Cancel</button>';
              $('#bilAlocFooter'+srNum).append(baFooter);

            }

          }
        }
    });

  }

  function alocateAmt(srNum,prevNum){
    var alocateAmt = parseFloat($('#aloctAmt'+srNum).val());
    var billAmt    = parseFloat($('#billAmt'+srNum).val());
    var totalBal   = parseFloat($('#totalBalence'+prevNum).val());
    var balence_Amt = parseFloat($('#balenceCrDr'+prevNum).html());   

    var sum = 0;
    $(".allocatAmt").each(function () {

      if (!isNaN(this.value) && this.value.length != 0) {
          sum += parseFloat(this.value);
      }
      $('#sessionBal').html(sum);
      $('#hiddenSession_Bal').val(sum);
    });
    var newsesAmt = sum - alocateAmt;

    var newBal = balence_Amt - newsesAmt;

    if(totalBal > billAmt){
        if(alocateAmt > billAmt){
          $('#aloctAmt'+srNum).val(billAmt);
        }
    }else if(billAmt > totalBal){
        if(alocateAmt > newBal){
          $('#aloctAmt'+srNum).val(newBal);
        }
    }

    var sum1 = 0;
    $(".allocatAmt").each(function () {

      if (!isNaN(this.value) && this.value.length != 0) {
          sum1 += parseFloat(this.value);
      }
      $('#sessionBal').html(sum1);
      $('#hiddenSession_Bal').val(sum1);
    });

    var balenceAmt = parseFloat($('#balenceCrDr'+prevNum).html());
    var sessionBal = parseFloat($('#sessionBal').html());
    var balence    = balenceAmt - sessionBal; 
    $('#totalBalence'+prevNum).val(balence);
    $('#totalBal'+prevNum).html(balence);

    var balAmt     = $('#balencAmt'+srNum).val();
    var alocateAmt = $('#aloctAmt'+srNum).val();
    var baleAlocat = $('#billAmt'+srNum).val();

    if(alocateAmt){
      var newBalAmt  = parseFloat(baleAlocat) - parseFloat(alocateAmt);
      $('#balencAmt'+srNum).val(newBalAmt);
    }else{
      var alocateAmt1 = 0;
      var newBalAmt  = parseFloat(baleAlocat) - parseFloat(alocateAmt1);
      $('#balencAmt'+srNum).val(newBalAmt);
    }
    


  }

  function cancleBillTrack(srNo){
    $('#bilAllocBody'+srNo).empty();
    //$('#exampleModalLabel').html('');
  }

  function saveBillTrack(srno,dmode,accCode,acc_types,against_UpID){

    var alocateAmt =[];
    var accTranId  =[];
    var cr_vrno    =[];
    var cr_vrdate  =[];

    var acType = $('#acctype_code').val();
    var splitType = acType.split('-'); 
    var acctype = splitType[0];

    var accName ='name';

    var drVrno      = $('#dr_vrno'+srno).val();
    var drDate      = $('#dr_VrDate'+srno).val();
    var accTrnsUpId = $('#upAccTrnId'+srno).val();
    var totlAloAmnt = $('#hiddenSession_Bal').val();

    $('input[name^="alocateAmt"]').each(function (){
                  
          alocateAmt.push($(this).val());

    });

    $('input[name^="accTranId"]').each(function (){
                  
          accTranId.push($(this).val());

    });

    $('input[name^="cr_vrno"]').each(function (){
                  
          cr_vrno.push($(this).val());

    });

    $('input[name^="cr_vrdate"]').each(function (){
                  
          cr_vrdate.push($(this).val());

    });

    $.ajaxSetup({

      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }

    });

    $.ajax({

            url:"{{ url('report-update-allocatAmt-bilpay') }}",

            method : "POST",

            type: "JSON",

            data: {alocateAmt: alocateAmt,accTranId:accTranId,dmode:dmode,drVrno:drVrno,drDate:drDate,cr_vrno:cr_vrno,cr_vrdate:cr_vrdate,accCode:accCode,accTrnsUpId:accTrnsUpId,acc_types:acc_types,against_UpID:against_UpID,totlAloAmnt:totlAloAmnt},

            success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {
                var responseVar = false;
                
              }else{
                var responseVar = true;
                $('#ViewPBT_Detail').modal('toggle');
                showDetail(accCode,acctype,accName);
              }

              
             // console.log('partyBill',partyBill);
             
              //$('#ViewBillTrack'+rwId).prop('disabled',true);
             // $('#AplyIconBT'+rwId).html('<i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 21px;margin-left: 3px;"></i>');
              /*if(msg == 'Success'){
                  
                var url = "{{ url('Transaction/Purchase/View-Purchase-Bill-Trans') }}";

                setTimeout(function(){ window.location = url; });
            
              }*/

              /*if(obj.data == 'success'){

                var url = "{{url('/view-customer-vendor/position')}}"
                setTimeout(function(){ window.location = url+'/'+acctype });

              }else{

              }*/

            }

      });


  }

</script>

@endsection

