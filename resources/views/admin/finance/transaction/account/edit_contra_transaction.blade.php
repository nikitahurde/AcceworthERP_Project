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
  .rightcontent{
    text-align:right;
  }
  ::placeholder {
    text-align:left;
  }
  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .btn{
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
  input:focus{border:1px solid yellow;} 

  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
  }
  .debitcreditbox{
    width: 100%;
    text-align: end;
  }
  .instrumentlbl{
        font-size: 12px;
      margin-left: -14px;
  }
  .instTypeMode{
      width: 15%;
      margin-bottom: 5px;
      margin-right: 15px;
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


<form id="contratransaction">
    @csrf
  <section class="content"> 

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Contra Transaction</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Transaction/Account/View-Contra-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

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

              <div class="col-md-2">

                <div class="form-group">

                  <label>Date: <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <?php $vrDate =$contra_list[0]->VRDATE; 
                        $vr_Date = date('d-m-Y',strtotime($vrDate)); 
                      ?>
                      <input type="text" class="form-control transdatepicker rightcontent" name="contraDate" id="vr_date" value="{{ $vr_Date }}" placeholder="Select Date" autocomplete="off" readonly>

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>

                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-2">
              
              <div class="form-group">

                  <label> T Code : </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="trancode" value="{{  $contra_list[0]->TRAN_CODE }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                      </div>

              </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">

                  <label>Series : 
                    <span class="required-field"></span>
                  </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>


                      <input list="seriesList"  id="series_code" name="seriescode" class="form-control  pull-left" value="<?php echo $contra_list[0]->SERIES_CODE; ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" onchange="getvrnoBySeries()"  autocomplete="off" readonly>

                      <datalist id="seriesList">

                        <option selected="selected" value="">-- Select --</option>


                      </datalist>

                    </div>
                    <small id="serscode_err" style="color: red;" class="form-text text-muted">
                    </small>
                       
                    <small id="series_code_errr" style="color: red;"></small>
                          
              </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-4">

              <div class="form-group">

                  <label>Series Name: 
                    <span class="required-field"></span>
                  </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input id="seriesText" name="seriesName" class="form-control  pull-left" value="<?php echo $contra_list[0]->SERIES_NAME; ?>" placeholder="Select Series" autocomplete="off" readonly="">

                    </div>
                  
              </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">
                
                <label> Vr No: </label>

                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                    
                    <input type="text" class="form-control rightcontent" name="vrNo" value="<?php echo $contra_list[0]->VRNO; ?>" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                  </div>
                  <small id="transerror"></small>
                
              </div>
                <!-- /.form-group -->
            </div>

            </div>

            <div class="row">
              
                <!-- /.col -->            

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Profit Center Code: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                      <input list="profitList"  id="profitId" name="pfctcode" class="form-control  pull-left" value="<?php echo $contra_list[0]->PFCT_CODE; ?>" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

                      <datalist id="profitList">

                        

                      </datalist>

                  </div>
                  <small id="profit_center_err" style="color: red;"> </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-4">

              <div class="form-group">
                
                <label>Profit Center Name: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input  id="profitText" name="profitName" class="form-control  pull-left" value="<?php echo $contra_list[0]->PFCT_NAME; ?>" placeholder="Select Profit Center Name" readonly="">


                  </div>
                

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
         
              <div class="table-responsive">
                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                  <tr>
                    <th>To /From</th>
                    <th>Account Code</th>
                    <th>Account Name</th>
                    <th>Debit-DR</th>
                    <th>Credit-CR</th>
                  </tr>

                  <!-- < ?php echo "<PRE>"; print_r($contra_list);exit; ?> -->

                  <?php $totlCount = count($contra_list); 
                      for($r=0;$r<$totlCount;$r++){ 
                      $srNo=$r+1;
                      if($r==0){
                        $toForm = 'Given To (Dr)';
                        $addClassdr = '';
                        $addClasscr = 'hidden';
                        $radOnlyCls = '';
                        $debitCls = 'debitAmt';
                        $creditCls ='';
                      }else if($r==1){
                        $toForm = 'Taken From (Cr)';
                        $addClasscr = '';
                        $addClassdr = 'hidden';
                        $radOnlyCls = 'readonly';
                        $debitCls ='';
                        $creditCls ='getcreditno';
                      }

                  ?>

                      <tr class="useful">

                        <td>
                          {{$toForm}}
                        </td>

                        <td class="">

                          <div class="input-group">
                            <input list="AccList{{$srNo}}" class="inputboxclr getacccode" style="width: 107px;margin-bottom: 5px;" id='acc_code{{$srNo}}' name="acc_code[]" 
                            value="{{$contra_list[$r]->GL_CODE}}"  onchange="AccListData({{$srNo}});" oninput="this.value = this.value.toUpperCase()"/>

                            <datalist id="AccList{{$srNo}}">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($List_acc_Code as $key)

                              <option value='<?php echo $key->GL_CODE?>' data-xyz ="<?php echo $key->GL_NAME; ?>" ><?php echo $key->GL_NAME ; echo " [".$key->GL_CODE."]" ; ?></option>

                              @endforeach

                            </datalist>
                          </div>

                        </td>

                        <td class="">
                          <input type="text" class="inputboxclr getAccNAme" style="width: 230px;margin-bottom: 5px;" id='acc_name{{$srNo}}' value="{{$contra_list[$r]->GL_NAME}}" name="acc_name[]" readonly />
                        </td>

                        <td>
                          <input type="text" class="debitcreditbox inputboxclr" name="debit_to[]" id="<?echo $debitCls;?>" value="{{$contra_list[$r]->DRAMT}}" <?php echo $addClassdr;?> <?php echo $radOnlyCls;?>>
                        </td>
                        <td>
                          <input type="text" class="debitcreditbox inputboxclr" value="{{$contra_list[$r]->CRAMT}}" id="<?php echo $creditCls;?>" name="credit_by[]" <?php echo $addClasscr;?> <?php echo $radOnlyCls;?>>
                        </td>

                      </tr>

                  <?php } ?>
                  <tr>
                    <td colspan="5">

                      <div style="display:flex;margin-left:10%;">

                        <label for="" class="instrumentlbl">I Type : </label>
                        <input list="InstTypeList" id="inst_type" class="instTypeMode getinstrument" name="instrument_type" value="{{$contra_list[0]->INST_TYPE}}" placeholder="Select I Type">

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

                          <label>cheque No : </label>
                          <input type="text" class="inputboxclr onchenkno" style="width: 85px;margin-bottom: 4px;margin-right: 15px;" id="cheque_no" value="{{$contra_list[0]->INST_NO}}" name="instrument_no">

                          <div>

                            <label>Cheque Date : </label>
                            <?php $instDate =$contra_list[0]->INST_DATE; 
                              $ins_Date = date('d-m-Y',strtotime($instDate)); 
                            ?>
                            <input type="text" class="transdatepicker rightcontent" name="instrument_date" id="instrumentDate" placeholder="Select Date" style="width: 40%;" value="{{$ins_Date}}" readonly=""><br>
                            <small id="showmsgforinstrudate" style="float: right;"></small>

                          </div>

                          <label style="vertical-align: inherit;">Perticular</label>
                          <textarea rows="1" type="text" id="perticular" style="width: 230px;" name="particular">{{$contra_list[0]->PARTICULAR}}</textarea>
                        
                      </div>
                                          
                    </td>
                  </tr>
                </table>
              </div>

              <div>

              <div class="row" style="text-align:center;">
                <p id="showWhenEmpty"></p>

                <input type="hidden" name="upCompCd" value="{{$contra_list[0]->COMP_CODE}}">
                <input type="hidden" name="upFyCd" value="{{$contra_list[0]->FY_CODE}}">
                <input type="hidden" name="upTranCd" value="{{$contra_list[0]->TRAN_CODE}}">
                <input type="hidden" name="UpSeriesCd" value="{{$contra_list[0]->SERIES_CODE}}">
                <input type="hidden" name="UpvrNo" value="{{$contra_list[0]->VRNO}}">

                <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
                <button class="btn btn-success" type="button" id="submitdata"  onclick="submitContraData(0)" ><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>
                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>
                <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitContraData(1)" ><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button>
              </div>
              
          </div><!-- /.box-body -->

        </div>

      </div>

    </div>

  </section>

</form>

</div>

@include('admin.include.footer')

<script type="text/javascript">


    $("#inst_type").bind('change', function () {
      var inst_type =  $(this).val();
      var xyz = $('#InstTypeList option').filter(function() {

        return this.value == inst_type;

      }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

     if(msg=='No Match'){
       $(this).val('');
       $('#perticular').val('');
       $('#cheque_no').val('');
    }else{

        var inst_type = $('#inst_type').val();
        if(inst_type){
          $('#perticular').val(inst_type+'-');
        }else{
          $('#perticular').val('');
        }
    }

  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
      $('#cheque_no').on('input',function(){
          var perticular = $('#perticular').val();
          var cheque_no = $('#cheque_no').val();

          var checkPer = perticular+cheque_no;
           var res = perticular.split("-");
           console.log(res);
          if(res[1] == ''){
            $('#perticular').val(checkPer);
          }else if(res[1] == cheque_no){

          }else{
               $('#perticular').val('');
               var checkno11 = $('#cheque_no').val();

               var getpre = perticular;

               var res1 = getpre.split("-");
               var discrptn = res1[0]+'-'+checkno11;
               $('#perticular').val(discrptn);   
          }

      });
  });
</script>

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
           $('#acc_code'+AccCode).css('border-color','#ff0000');
           $('#debitAmt').prop('readonly',true);
        }else{
            $('#acc_name'+AccCode).val(msg);
            $('#acc_code'+AccCode).css('border-color','#d2d6de');
            $('#debitAmt').prop('readonly',false);
            $('#vr_date,#series_code,#profitId').prop('readonly',true);
        }

        var accCdOne = $('#acc_code1').val();
        var accCdTwo = $('#acc_code2').val();

        if(accCdOne && accCdTwo){
          $('#submitdata').prop('disabled',false);
          $('#submitdatapdf').prop('disabled',false);
        }else{
          $('#submitdata').prop('disabled',true);
          $('#submitdatapdf').prop('disabled',true);
          
        }


  }
/*account code list*/
  $(document).ready(function() {

    $('#getcreditno,#debitAmt').on('input',function(){
          var creditno  = $('#getcreditno').val();
          var debitAmt  = $('#debitAmt').val();
          console.log('debitAmt',debitAmt);
          var vrseqnum  = $('#vrseqnum').val();
          var transcode = $('#transcode').val();
          var accCdOne  = $('#acc_code1').val();
          var accCdTwo  = $('#acc_code2').val();
          if(creditno && debitAmt && transcode && accCdOne && accCdTwo){
            $('#submitdata').prop('disabled',false);
            $('#submitdatapdf').prop('disabled',false);
          }else{
            $('#submitdata').prop('disabled',true);
            $('#submitdatapdf').prop('disabled',true);
            
          }

          if(debitAmt){
              $('#getcreditno').val('');
              $('#getcreditno').val(debitAmt);
          }else{
            $('#getcreditno').val('');
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

    //document.getElementById("seriesText").innerHTML = msg; 

    if(msg=='No Match'){
       $(this).val('');
       $("#seriesText").val('');
       $("#vrseqnum").val('');
       $("#seqVrNum").val('');
      // document.getElementById("seriesText").innerHTML = '';
       $('#CodeSeries').val('');
       $('#profitId').prop('readonly',true);
    }else{
      $('#CodeSeries').val(seriescode);
      $('#profitId').prop('readonly',false);
    }
    filedValidatin();
  });
  /*series code*/


  /*profit center code*/
  $("#profitId").bind('change', function () {  
    var val = $(this).val();
    var xyz = $('#profitList option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    $("#profitText").val(msg);

      if(msg=='No Match'){
         $(this).val('');
         $('#ProfitCenterCode').val('');
         $("#profitText").val('');
         $('#profitId').css('border-color','#ff0000');
         $('#profit_center_err').html('The profit center code field is required.');
      }else{
          $('#ProfitCenterCode').val(val);
          $('#profitId').css('border-color','#d2d6de');
          $('#profit_center_err').html('');
      }
    filedValidatin();        
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

      filedValidatin();
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

  function filedValidatin(){

   var seriescode = $('#series_code').val();
   var pfctCode   = $('#profitId').val();

    if(seriescode && pfctCode){
      $('#acc_code1').prop('readonly',false).css('border-color','#d2d6de');
      $('#acc_code2').prop('readonly',false).css('border-color','#d2d6de');
    }else{
      $('#acc_code1').prop('readonly',true).css('border-color','#ff0000');
      $('#acc_code2').prop('readonly',true).css('border-color','#ff0000');
    }

  }  

function submitContraData(valp){

  var downloadFlg    = valp;
  var inst_type      = $('#inst_type').val();
  var giventoaccCode =  $('#acc_code1').val();
  var takefmaccCode  =  $('#acc_code2').val();
  var debitAmt       =  $('#debitAmt').val();
  var creditAmt      =  $('#getcreditno').val();

   $('#pdfYesNoStatus').val(downloadFlg);

  if(inst_type && giventoaccCode && takefmaccCode && debitAmt && creditAmt){

        $('#showWhenEmpty').html('');

        var data = $("#contratransaction").serialize();

        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/Transaction/Account/Update-Contra-Trans') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {
              
              var data1 = JSON.parse(data);
              console.log('data1',data1);
              if (data1.response == 'Error') {
                var responseVar = false;
                var url = "{{url('/Transaction/Account/View-Contra-Trans-Success-Msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }else{
                var responseVar = true;
                if(downloadFlg == 1){
                    var link = document.createElement('a');
                    link.href = data1.url;
                    link.download = data1.fileName;
                    link.dispatchEvent(new MouseEvent('click'));
                }
                var url = "{{url('/Transaction/Account/View-Contra-Trans-Success-Msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }

            },

        });

  }else{
    $('#showWhenEmpty').html('Above field is required').css('color','red');
  }

}



</script>


@endsection