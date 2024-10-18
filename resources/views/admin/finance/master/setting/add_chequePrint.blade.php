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
  ::placeholder {
    text-align:left;
  }
  .setheightinput{
    height: 0%;
  }
  .nameheading{
    font-size: 12px;
  }
  .setetxtintd{
    font-size: 12px !important;
    padding-top: 2% !important;
    padding-bottom: 2% !important;
  }
  .beforhidetble{
    display: none;
  }
  .custom-options {
    position: absolute;
    display: block;
    top: 100%;
    left: 0;
    right: 0;
    border-top: 0;
    background: #f3eded;
    transition: all 0.5s;
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    z-index: 2;
    -webkit-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
    -moz-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
    box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
  }
  .custom-select .custom-options {
    opacity: 1;
    visibility: visible;
    pointer-events: all;
  }
  .custom-option {
    position: relative;
    display: block;
    padding-top: 10px;
    padding-left: 21%;
    font-size: 14px;
    font-weight: 600;
    color: #3b3b3b;
    line-height: 2px;
    cursor: pointer;
    transition: all 0.5s;
  }
  .CloseListDepot{
    display: none;
  }
  .CloseListDepot{
    display: none;
  }
  .popover{
    left: 64.4922px!important;
    width: 169%!important;
  }
  .showinmobile{
    display: none;
  }
  @media screen and (max-width: 600px) {

    .popover {
      left: 56.4922px!important;
      width: 100%!important;
    }
    .setheightinput{
      width: 65%!important;
    }
    #serachcode{
      margin-left: 5%!important;
    }
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
  .showSeletedName{
    font-size: 14px;
    margin-top: 1%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  .headingStyle{
    font-size: 14px;
    font-weight: 600;
    color: #3c8dbc;
  }
</style>


<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Master Cheque Print

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('/configration/Setting/add-offline-ckeque-issue') }}">Master Cheque Print</a></li>

            <li class="active"><a href="{{ url('/configration/Setting/add-offline-ckeque-issue') }}">Add  Cheque Print</a></li>

          </ol>

        </section>

        <section class="content">

          <div class="row">

            <div class="col-sm-1"></div>

              <div class="col-sm-8">

                <div class="box box-primary Custom-Box">

                  <div class="box-header with-border" style="text-align: center;">

                    <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Cheque Print</h2>

                    <div class="box-tools pull-right showinmobile">

                      <a href="{{ url('/configration/Setting/view-offline-cheque-issue') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Cheque Print</a>

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

                    <form id="chequePrintForm" method="POST" enctype="multipart/form-data">

                    @csrf

                      <div class="row">

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>

                              Series Code: <span class="required-field"></span>

                            </label>

                              <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                <input list="seriesList" class="form-control" name="series_code" value="{{ old('series_code')}}" id="SeriesCode" placeholder="Enter Series Code" autocomplete="off" onchange="getCashBankDetailForChequerint()" style="z-index: auto;">

                                <datalist id="seriesList">

                                  <option selected="selected" value="">-- Select --</option>

                                  @foreach ($series_list as $key)

                                  <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                                  @endforeach

                                </datalist>

                              </div> 
                            
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->

                        </div>

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>

                              Series Name: <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                              <input type="text" class="form-control" name="seriesName" value="{{ old('series_name')}}" id="series_Name" placeholder="Enter Series Name" autocomplete="off" style="z-index: auto;" readonly>
                            </div> 

                          </div><!-- /.form-group -->

                        </div>

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>

                              Cheque No: 

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">
                              
                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                              <input list="chequeNoList" name="cheque_no" id="chequeNo" class="form-control" placeholder="Enter Cheque No" value="{{ old('cheque_no')}}" maxlength="6" autocomplete="off" >

                              <datalist id="chequeNoList">

                                <option selected="selected" value="">-- Select --</option>

                              </datalist>

                            </div>
                            <input type="hidden" id="updatedataId" name="updatedataId">
                            <input type="hidden" id="chqNoColId" name="chqNoColId">
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('cheque_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->
                          
                        </div>

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>

                              Cheque Leaf Config:

                              <span class="required-field"></span>

                            </label>

                            <div class="input-group">
                              
                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                              <input list="chqLeafNoList" name="chq_leaf_no" id="chqLeafNo" class="form-control" placeholder="Enter Chq Leaf Config" value="{{ old('chq_leaf_no')}}" autocomplete="off" maxlength="6" readonly>

                              <datalist id="chqLeafNoList">

                                <option selected="selected" value="">-- Select --</option>

                              </datalist>

                            </div>
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('chq_leaf_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->
                          
                        </div>

                      </div><!-- /.row -->


                      <div class="row">

                        
                        <div class="col-md-3">

                          <div class="form-group">

                            <label>Account Code:</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                <input type="text" class="form-control" name="acc_code" value="{{ old('acc_code')}}" autocomplete="off" id="acc_code" placeholder="Enter Acc Code" readonly>

                            </div> 
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div>

                          <!-- /.form-group -->

                        </div>

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>

                              Acc Name: <span class="required-field"></span>

                            </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                              <input type="text" class="form-control" name="acc_name" value="{{ old('acc_name')}}" id="acc_name" placeholder="Enter Acc Name" autocomplete="off" style="z-index: auto;" readonly>
                            </div> 
                              
                          </div><!-- /.form-group -->

                        </div>

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>
                              Cheque Date<span class="required-field"></span>
                            </label>
                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                             
                              <input type="text" class="form-control transdatepicker" name="chequeDate" autocomplete="off" value="" id="chqDate" placeholder="Enter Cheque Date" readonly>

                            </div>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('chequeDate', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->
                        </div> <!-- /.col -->

                        <div class="col-md-3">

                          <div class="form-group">

                            <label>

                             Amount:<span class="required-field"></span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                                <input type="text" class="form-control" name="amount" value="{{ old('amount')}}" id="amount" autocomplete="off" placeholder="Enter amount" readonly>

                            </div>
                            <div id="errorMsg" style="color:red;">
                              
                            </div>
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('amount', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->

                        </div> <!-- /.col -->

                      </div>

                      <div class="row">

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                             Amount in word:

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="amtWord" value="{{ old('amtWord')}}" id="amtWord" placeholder="Enter Amount in word" maxlength="100" readonly>

                            </div>
                            <div id="errorMsg" style="color:red;">
                              
                            </div>
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('amtWord', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->

                        </div> <!-- /.col -->

                        <div class="col-md-6">

                          <div class="form-group">

                            <label>

                             Beneficiary Name:

                            </label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                                <input type="text" class="form-control" name="beneficiary_Name" value="{{ old('beneficiary_Name')}}" id="beneficiary_Name" placeholder="Enter Beneficiary Name" maxlength="100">

                            </div>
                            <div id="errorMsg" style="color:red;">
                              
                            </div>
                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('beneficiary_Name', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                          </div><!-- /.form-group -->

                        </div> <!-- /.col -->

                      </div>

                      <div style="text-align: center;">

                        <button type="button" data-toggle="modal"  class="btn btn-primary btn-md" onclick="return confirmprintModal()" style="padding-bottom:5px;padding-top:2px;" id="print_Btn" disabled>Print</button>
                      </div>

                    </form>

                  </div><!-- /.box-body -->

                </div>

              </div>

              <div class="col-sm-3 hideinmobile">

                <div class="box-tools pull-right">

                  <a href="{{ url('/configration/Setting/view-offline-cheque-issue') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Cheque Print</a>

                </div>

              </div>

          </div>

       </section>

</div>

<!-- --------------- confirm modal ---------------- -->

  <div class="modal fade" id="confirmModl" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document" style="margin-top: 10%;">

      <div class="modal-content">

        <div class="modal-header">
          <h3 class="modal-title showSeletedName" id="exampleModalLabel">Cheque Print Confirmation....!</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">

          <p style="font-size: 12px;line-height: 1;color: #000;">
            Ensure cheque no <span id="showChqNo"></span> has been placed properly in prints...!
          </p>
          

        </div>

        <div class="modal-footer">

            <a href="" class="btnprn btn btn-primary" id="printBtn" data-dismiss="modal"  style="padding-top: 2px;padding-bottom: 4px;">Confirm</a>

            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

        </div>

      </div>

    </div>

  </div>

<!-- --------------- confirm modal ---------------- -->

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/jquery.printPage.js') }}"></script>

<script type="text/javascript">

  function amountInWords (num) {
    
      var fAMT=num,WAMT=0,FWORDS='';

    //FWORDS Four Crores Fifty Lakhs Twenty Five Thousand Five Hundred One 

    if(fAMT==0){
      FWORDS='Nil ';
    }else{

        WAMT = parseInt(fAMT/10000000);
        FWORDS=FWORDS+(WAMT>0 ? AWFWORD(WAMT)+(FWORDS==' One '?'Crore ':'Crores '):'');

        fAMT = fAMT - WAMT * 10000000;
        WAMT = parseInt(fAMT/100000);
        FWORDS=FWORDS+(WAMT>0 ? AWFWORD(WAMT)+(FWORDS==' One '?'Lakh ':"Lakhs "):'');

        fAMT = fAMT - WAMT * 100000;
        WAMT = parseInt(fAMT/1000);
        FWORDS=FWORDS+(WAMT>0 ? AWFWORD(WAMT)+"Thousand ":'');

        fAMT = fAMT - WAMT * 1000;
        WAMT = parseInt(fAMT/100);
        FWORDS=FWORDS+(WAMT>0 ? AWFWORD(WAMT)+"Hundred ":'');

        fAMT = fAMT - WAMT*100;
        WAMT = parseInt(fAMT);
        FWORDS=FWORDS+(WAMT>0 ? AWFWORD(WAMT):'');

        fAMT = fAMT - WAMT*1;
        fAMT = fAMT.toFixed(3);;
        WAMT = parseInt((fAMT-parseInt(fAMT))*100);
        FWORDS=FWORDS+(WAMT>0 ? "And Paise "+AWFWORD(WAMT):'');

    }

    FWORDS = FWORDS + "Only.";
  
    return FWORDS;
  }

  $(document).ready(function(){

    $("#chequeNo").bind('change', function () {

        var val = $(this).val();

        var xyz = $('#chequeNoList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
          $('#acc_code,#chequeNo,#acc_name,#chqDate,#amount,#amtWord,#beneficiary_Name,#chqNoColId').val('');
        }else{
          $('#chqNoColId').val(msg);
          $('#acc_code,#acc_name,#chqDate,#amount,#amtWord,#beneficiary_Name').val('');
          getCashBankDetailForChequerint();
        }

        setTimeout(function() {
          fieldValidation();
        }, 500);
        
    });
    
    $("#SeriesCode").bind('change', function () {

        var val = $(this).val();

        var xyz = $('#seriesList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
          $('#SeriesCode').val('');
          $('#series_Name').val('');
          $('#acc_code,#chequeNo,#chqLeafNo,#acc_name,#chqDate,#amount,#amtWord,#beneficiary_Name,#chqNoColId').val('');
          $('#chequeNoList').empty();
        }else{
          $('#series_Name').val(msg);
          $('#acc_code,#chequeNo,#chqLeafNo,#acc_name,#chqDate,#amount,#amtWord,#beneficiary_Name,#chqNoColId').val('');
          $('#chequeNoList').empty();
        }

        fieldValidation();
        
    });

  });

  function getCashBankDetailForChequerint(){

      var sereisCd   = $('#SeriesCode').val();
      var chequeNo   = $('#chequeNo').val();
      var chqNoColId = $('#chqNoColId').val();

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      $.ajax({
          type: 'POST',
          url: "{{ url('/account/get-cash-bank-details-for-cheque-print') }}",
          data: {sereisCd: sereisCd,chequeNo:chequeNo,chqNoColId:chqNoColId},
          success: function (data) {
            var data1 = JSON.parse(data);
            if(data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              console.log('data1.data_chequeNoList',data1.data_chequeNoList);

              if(data1.data_chequeNoList == ''){

              }else{
                $("#chequeNoList").empty();
                $.each(data1.data_chequeNoList, function(k, getData){

                    var upId = getData.CHEQUENO+'~'+getData.CHQBHID+'~'+getData.CHQBBID+'~'+getData.SLNO;
                    $("#chequeNoList").append($('<option>',{

                      value:getData.CHEQUENO,

                      'data-xyz':upId

                    }));

                });

              }
              console.log('data1.data_chequeNoDetails',data1.data_chequeNoDetails);
              if(data1.data_chequeNoDetails == ''){

              }else{
                var vrDate = data1.data_chequeNoDetails[0].CHEQUEDATE;
                var splitVrDate = vrDate.split('-');
                var vrDateForm = splitVrDate[2]+'-'+splitVrDate[1]+'-'+splitVrDate[0];
                $('#acc_code').val(data1.data_chequeNoDetails[0].ACC_CODE);
                $('#acc_name').val(data1.data_chequeNoDetails[0].ACC_NAME);
                $('#chqDate').val(vrDateForm);
                $('#amount').val(data1.data_chequeNoDetails[0].AMOUNT);
                $('#beneficiary_Name').val(data1.data_chequeNoDetails[0].ACC_NAME);

                //amountInWords(data1.data_chequeNoDetails[0].AMOUNT);
                var amount = data1.data_chequeNoDetails[0].AMOUNT;

                amount = amount.substring(0, amount.length-3);
                document.getElementById('amtWord').value = amountInWords(amount);
              }

              if(data1.data_chqLeafList == ''){

              }else{

                $("#chqLeafNo").val(data1.data_chqLeafList[0].CHQLEAF_NO);
                
              }

            }/* /. SUCCESS COND*/

          } /* /. SUCCESS FUN*/

      }); /* AJAX FUN*/

  } /* /. MAIN FUN*/

  function fieldValidation(){
    console.log('hi');
    var sereisCd     = $("#SeriesCode").val();
    var cheqNo       = $("#chequeNo").val();
    var cheqLeafNo   = $("#chqLeafNo").val();
    var chq_Date      = $("#chqDate").val();
    var amount       = $("#amount").val();
    var amountInword = $("#amtWord").val();

    if(sereisCd){
      $('#SeriesCode').prop('border-color','#d4d4d4');
      if(cheqNo){
        $('#chequeNo').prop('border-color','#d4d4d4');
        if(cheqLeafNo){
          $('#chqLeafNo').prop('border-color','#d4d4d4');
          if(chq_Date){
            $('#chqDate').prop('border-color','#d4d4d4');
            if(amount){
              $('#amount').prop('border-color','#d4d4d4');
              if(amountInword){
                $('#amtWord').prop('border-color','#d4d4d4');
              }else{
                $('#amtWord').prop('border-color','#ff0000');
              }
            }else{
              $('#amount').prop('border-color','#ff0000');
            }
          }else{
            $('#chqDate').prop('border-color','#ff0000');
          }
        }else{
          $('#chqLeafNo').prop('border-color','#ff0000');
        }
      }else{
        $('#chequeNo').prop('border-color','#ff0000');
      }
    }else{
      $('#SeriesCode').prop('border-color','#ff0000');
    }
    console.log('data all',sereisCd+' '+cheqNo+' '+cheqLeafNo+' '+chq_Date+' '+amount+' '+amountInword);
    if(sereisCd && cheqNo && cheqLeafNo && chq_Date && amount && amountInword){
      $('#print_Btn').prop('disabled',false);
    }else{
      $('#print_Btn').prop('disabled',true);
    }

    $('#amount').val(function(index,value){
          if(isNaN(value)){
            return value
          }else{
            if(value!=0){
              return (value*1).toLocaleString('en-IN',{minimumFractionDigits:2, maximumFractionDigits:2})
            } else return '';
          }
        });
  }

  function confirmprintModal(leafNo){

    var bnfName       = $('#beneficiary_Name').val();
    var chequeNo      = $('#chequeNo').val();
    var updatedChqCol = $('#chqNoColId').val();
    var chqDate       = $('#chqDate').val();
    var cheLeafNo     = $('#chqLeafNo').val();
    var amount        = $('#amount').val();
    var amtWord       = $('#amtWord').val();
    var bnf_Name      = bnfName.replaceAll(' ', '_');
    var amtInword     = amtWord.replaceAll(' ', '_');
    var linkURl      = "{{ url('/configration/Setting/printing-cheque') }}"+'/'+bnf_Name+'/'+chqDate+'/'+cheLeafNo+'/'+amount+'/'+amtInword+'/'+updatedChqCol;
    $('#printBtn').attr('href',linkURl);

    var chqNo = $('#chequeNo').val();
    $('#showChqNo').html(chqNo);
    $("#confirmModl").modal('show');

  }


   $(document).ready(function(){   

    $('#printBtn').on('click',function(){
      $("#confirmModl").modal('hide');
    });

    $(".Number").keypress(function(event){
        var keycode = event.which;
        if (!(keycode >= 48 && keycode <= 57)) {
            event.preventDefault();
        }
    });

 });
</script>

<script type="text/javascript">
  $(document).ready(function() {

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

  $(".Number").on("keypress", function(evt) {
    var keycode = evt.charCode || evt.keyCode;
    if (keycode == 46 || this.value.length==10) {
      return false;
    }
  });

  });


  function AWFWORD(WAMT){


    var WAMT,FDIGIT=0,SDIGIT=0,RWORDS='';

    FDIGIT = parseInt(WAMT/10);

    SDIGIT = WAMT - FDIGIT * 10;

    console.log('FDIGIT',FDIGIT);

      if(FDIGIT > 1){

        if(FDIGIT == 2){
          RWORDS = "Twenty ";
        }else if(FDIGIT == 3){
          RWORDS ="Thirty ";
        }else if(FDIGIT == 4){
          RWORDS ="Forty ";
        }else if(FDIGIT == 5){
          RWORDS ="Fifty ";
        }else if(FDIGIT == 6){
          RWORDS ="Sixty ";
        }else if(FDIGIT == 7){
          RWORDS ="Seventy ";
        }else if(FDIGIT == 8){
          RWORDS ="Eighty ";
        }else if(FDIGIT == 9){
          RWORDS ="Ninety ";
        }

      }

      if((FDIGIT > 1 && SDIGIT > 0) || (FDIGIT == 0 && (SDIGIT > 0 && SDIGIT <= 9))){

        if(SDIGIT ==1){
          RWORDS = RWORDS + "One ";
        }else if(SDIGIT ==2){

          RWORDS = RWORDS + "Two ";

        }else if(SDIGIT ==3){

          RWORDS = RWORDS + "Three ";

        }else if(SDIGIT ==4){

          RWORDS = RWORDS + "Four ";

        }else if(SDIGIT ==5){

          RWORDS = RWORDS + "Five ";

        }else if(SDIGIT ==6){

          RWORDS = RWORDS + "Six ";

        }else if(SDIGIT ==7){

          RWORDS = RWORDS + "Seven ";

        }else if(SDIGIT ==8){

          RWORDS = RWORDS + "Eight ";

        }else if(SDIGIT ==9){

          RWORDS = RWORDS + "Nine ";

        }

      }

      if(FDIGIT == 1 && SDIGIT ==0){
        RWORDS = RWORDS + "Ten ";
      }

      if(FDIGIT == 1 && ((SDIGIT > 0 && SDIGIT < 9) || (SDIGIT == 9))){

        if(SDIGIT == 1){
          RWORDS = RWORDS + "Eleven ";
        }else if(SDIGIT == 2){
          RWORDS = RWORDS + "Twelve ";
        }else if(SDIGIT == 3){
          RWORDS = RWORDS + "Thirteen ";
        }else if(SDIGIT == 4){
          RWORDS = RWORDS + "Fourteen ";
        }else if(SDIGIT == 5){
          RWORDS = RWORDS + "Fifteen ";
        }else if(SDIGIT == 6){
          RWORDS = RWORDS + "Sixteen ";
        }else if(SDIGIT == 7){
          RWORDS = RWORDS + "Seventeen ";
        }else if(SDIGIT == 8){
          RWORDS = RWORDS + "Eighteen ";
        }else if(SDIGIT == 9){
          RWORDS = RWORDS + "Nineteen ";
        }

      }

    return RWORDS;

  }

</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.btnprn').printPage();

    var mediaQueryList = window.matchMedia('print');

    mediaQueryList.addListener(function(mql) {
      if ((mql.matches)) {
        var url = "{{ url('configration/Setting/view-cheque-leaf-config') }}";
        setTimeout(function(){ window.location = url; });

      }else{
        var url = "{{ url('configration/Setting/view-cheque-leaf-config') }}";
        setTimeout(function(){ window.location = url; });
      }
    });
    
  });
</script>


@endsection



