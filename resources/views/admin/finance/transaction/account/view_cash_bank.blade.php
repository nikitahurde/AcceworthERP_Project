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

  @media only screen and (max-width: 600px) {
    
    .dataTables_filter{
      margin-left: 35%;
    }
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
  [data-tip] {
    position:relative;
  }
  [data-tip]:before {
    content:'';
    /* hides the tooltip when not hovered */
    display:none;
    content:'';
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-bottom: 5px solid #1a1a1a; 
    position:absolute;
    top:12px;
    left:35px;
    z-index:8;
    font-size:0;
    line-height:0;
    width:0;
    height:0;
  }
  [data-tip]:after {
    display:none;
    content:attr(data-tip);
    position:absolute;
    top:17px;
    left:0px;
    padding:3px 3px;
    background:#1a1a1a;
    color:#fff;
    z-index:9;
    font-size: 0.75em;
    height:25px;
    line-height:18px;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    white-space:nowrap;
    word-wrap:normal;
  }
  [data-tip]:hover:before,
  [data-tip]:hover:after {
    display:block;
  }
  .box-header {
      color: #444;
      display: block;
      padding: 3px;
      position: relative;
  }
  table.dataTable {
      clear: both;
      margin-top: 0px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }
  .hideCol{
    display:none;
  }
  .dtvrDate{
    width:7%;
  }
  .dtVrno{
    width:7%;
  }
  .dtglName{
    width:17%;
  }
  .dtDrcrAmt{
    width:7%;
    text-align:right;
  }
  .dtAction{
    width:5%;
  }
  .modltitletext {
    text-align: center;
    font-weight: 700;
    color: #5696bb;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>Cash /Bank Transaction <small> View Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report/MIS</a></li>

      <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">Cash /Bank Transaction Report</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Cash /Bank Transaction</h2>

        <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Account/Cash-Bank-Transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Cash/Bank Trans</a>

        </div>
      </div>

      @if(Session::has('alert-success'))

        <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

          <h4><i class="icon fa fa-check"></i>Success...!</h4>

          {!! session('alert-success') !!}

        </div>

      @endif

      @if(Session::has('alert-error'))

        <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4><i class="icon fa fa-ban"></i>Error...!</h4>

            {!! session('alert-error') !!}

        </div>

      @endif

      <!-- /.box-header -->

      <div class="box-body">

        <form id="myForm">
          @csrf

          <div class="row">
                      
            <div class="col-md-3">

              <div class="form-group">

                 <label for="exampleInputEmail1"> Account Code: </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc"></i>

                  </div>

                  <input list="accList" name="accCode" id="accCode" class="form-control " placeholder="Select Account Code" >

                  <datalist id="accList">

                 <?php foreach($acc_list as $key) { ?>

                    <option value="<?= $key->ACC_CODE ?>" data-xyz="<?= $key->ACC_NAME ?>"><?= $key->ACC_NAME ?></option>

                  <?php } ?>
                  </datalist>

                </div>

                <small id="show_err_to_date">

                </small>

              </div>

            </div>
                        
            <div class="col-md-3">

              <div class="form-group">

                 <label for="exampleInputEmail1"> Bank Code: </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc"></i>

                  </div>

                  <input list="BankList" name="BankCode" id="BankCode" class="form-control" placeholder="Select Bank Code" >

                  <datalist id="BankList">

                    <option selected="selected" value="">-- Select --</option>

                    @foreach ($series_list as $key)
                
                      <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>
                    @endforeach

                  </datalist>

                </div>
                <small>  
                    <div class="pull-left showSeletedName" id="BankText"></div>
                </small>
                <small id="show_err_to_date">

                </small>

              </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">
                    <?php

                   $From_date  = date("d-m-Y", strtotime($fromDate));
                   $To_date    = date("d-m-Y", strtotime($toDate));
                   $Today_date = date("d-m-Y");

                     ?>
                    
                  <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $From_date }}">
                  <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $To_date }}">
                  <input autocomplete="off" type="hidden" name="" id="todayDate" value="{{ $Today_date }}">

                  <label for="exampleInputEmail1">From Date : </label>

                  <div class="input-group">
                    <div class="input-group-addon">

                      <i class="fa fa-calendar"></i>

                    </div>
                     <input autocomplete="off" type="text" name="from_date" id="fromDate" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="<?php echo $From_date; ?>">

                  </div>
                  <small id="show_err_from_date" style="color: red;"></small>
                     
                </div>

              </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                 <label for="exampleInputEmail1"> To Date: </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-calendar"></i>

                  </div>
                  <input type="text" name="to_datecash" id="to_datecash" class="form-control datepicker1" placeholder="Select Transaction Date" value="<?php echo $Today_date; ?>">

                </div>
                <small id="show_err_to_date">

                </small>

              </div>

            </div>

            <div class="col-md-2" style="margin-top: 12px;">

              <div class="">

                <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="font-size: 12px;padding: 2px;"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                <button type="button" class="btn btn-default" name="searchdata" id="ResetId" style="font-size: 12px;padding: 2px;"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

              </div>

            </div>

          </div>

        </form>

        <table id="InwardDispatch" class="table table-bordered table-striped table-hover">

          <thead class="theadC">

            <tr>

              <th class="text-center dtvrDate">Vr Date.</th>

              <th class="text-center dtVrno">Vr No.</th>

              <th class="text-center dtglName">Gl Name</th>

              <th class="text-center dtglName">Acc Name</th>

              <th class="text-center dtglName">Perticular</th>

              <th class="text-center dtDrcrAmt">Debit-DR </th>

              <th class="text-center dtDrcrAmt">Credit-CR</th>

              <th class="text-center dtDrcrAmt">TDS Amt</th>

              <th class="text-center hideCol">Acc Code</th>
              <th class="text-center hideCol">Gl Code</th>

              <th class="text-center dtAction">Action</th>
              <th class="text-center dtAction">PDF</th>
              <th class="text-center hideCol">vrnoseries</th>

            </tr>

          </thead>

          <tbody id="defualtSearch">

            

          </tbody>
          <tfoot align="right">
            <tr><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr>
          </tfoot>
  
        </table>

      </div><!-- /.box-body -->

    </div>

  </section>

</div>

<!-- ---------  modal for data delete -------------- -->

  <div class="modal fade" id="cashBankDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

        </div>

        <div class="modal-body">

          You Want To Delete This ...!

        </div>

        <div class="modal-footer">

       <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

      <form action="{{ url('/finance/delete-cash-bank') }}" method="post">

      @csrf

            <input type="hidden" name="cashbankid" value="" id='updateid'>

            <input type="submit" value="delete" class="btn btn-sm btn-danger" style="margin-top: -20%;">

          </form>

         </div>

      </div>

    </div>

  </div>
 
<!-- ---------  modal for data delete -------------- -->

<!------- MODAL FOR CALCULATE TDS ------------>

      

<!------- MODAL FOR CALCULATE TDS ------------>

@include('admin.include.footer')

<script type="text/javascript">
  function deleteCashBank(compCd,fyCd,tranCd,seriesCd,vrNo){
      $('#cashBankDelete').modal('show');
      var idComb = compCd+'~'+fyCd+'~'+tranCd+'~'+seriesCd+'~'+vrNo;
      $('#updateid').val(idComb);
    }
</script>
<script type="text/javascript">
  $(document).ready(function(){

      var fromDate  = $('#from_date_default').val()
      var toDate    = $('#to_date_default').val()
      var todayDate = $('#todayDate').val()

      $('.datepicker').datepicker({

        format: 'dd-mm-yyyy',

        orientation: 'bottom',

        todayHighlight: 'true',

        startDate :fromDate,

        endDate : todayDate,

        autoclose: 'true'

      });

      $('.datepicker1').datepicker({

        format: 'dd-mm-yyyy',

        orientation: 'bottom',

        todayHighlight: 'true',

        startDate :fromDate,

        endDate : todayDate,

        autoclose: 'true'

      });

      $("#BankCode").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#BankList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        //alert(msg+xyz);

         if(msg=='No Match'){

           $(this).val('');
        

        }

      });
      
  })
</script>
<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(accCode='',BankCode='',toDate='',fromDate=''){

          var getcomName = '<?php echo Session::get('company_name'); ?>';
          var getFY      = '<?php echo Session::get('macc_year'); ?>';
          var getnewdate = new Date();
          var getday = getnewdate.getDate();
          var getMonth = getnewdate.getMonth()+1;
          var getYear = getnewdate.getFullYear();


          var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

          var getdate = getday+''+getMonth+''+getYear;

          $('#InwardDispatch').DataTable({

            footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // Remove the formatting to get integer data for summation
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                drTotal = api
                    .column( 5, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );

                crTotal = api
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
     
                // Update footer
                 $( api.column( 4).footer() ).html(
                    'Total :- '
                );

                $( api.column( 5).footer() ).html(drTotal.toFixed(2));
                $( api.column( 6).footer() ).html(crTotal.toFixed(2));
            },
              processing: true,
              serverSide: false,
              info: true,
              bPaginate: false,
              scrollY: 450,
              scrollX: true,
              scroller: true,
              fixedHeader: true,
              order: [[0, 'asc'],[1, 'asc']],
              columnDefs: [
                 { orderable: false, targets:2,orderable: false, targets:3,orderable: false, targets:4,orderable: false, targets:5,orderable: false, targets:6,orderable: false, targets:7,orderable: false, targets:8,orderable: false, targets:9 }
              ],
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
              buttons: [
                          {
                            extend: 'excelHtml5',
                            filename: 'CASH_BANK_BOOK_'+getdate+'_'+gettime,
                            title: getcomName+'\n'+getFY+'\n'+' CASH BANK BOOK',
                            exportOptions: {
                                  columns: [0,1,2,3,4,5,6,7]
                            }
                          }

                        ],
              ajax:{
                url:'{{ url("/finance/view-cash-bank") }}',
                data: {accCode:accCode,BankCode:BankCode,toDate:toDate,fromDate:fromDate}
              },

              columns: [

              
                {
                    data:'VRDATE',
                    className:'dtvrDate',
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
                  render: function (data, type, full, meta){
                         
                    var fy_code = full['FY_CODE'].split('-');

                    var VRNO = fy_code[0]+' '+full['SERIES_CODE']+' '+full['VRNO'];
                          
                    return VRNO;
                               
                  },
                  className:'dtVrno' 
                },
                
                {   
                  data :'GL_NAME',
                  render: function (data, type, full, meta){

                      if(full['GL_CODE'] == null){
                        var glCode = '--';
                      }else{
                        var glCode = full['GL_CODE'];
                      }
                      
                      if(full['GL_NAME'] == null){
                        var gName = '--';
                        return '-- ( -- )';
                      }else{
                        var glName = full['GL_NAME'];
                        console.log('glName',full['GL_NAME']);
                        var gName = 'display' && glName.length > 50 ? glName.substr(0, 50) + '…' : glName;
                        return '<span data-tip="'+glName+'">'+ gName+' ( '+glCode+' )</span> ';
                      }    
                  },
                  className:'dtglName'
                },

                {    
                    data :'ACC_NAME',
                    render: function (data, type, full, meta){

                      if(full['ACC_CODE'] == null){
                        var accCode ='--';
                      }else{
                        var accCode =full['ACC_CODE'];
                      }

                      if(full['ACC_NAME'] == null){
                        var accName ='--';
                        return '-- ( -- )';
                      }else{
                        var ac_Name = full['ACC_NAME'];
                        var accName ='display' && ac_Name.length > 40 ? ac_Name.substr(0, 40) + '…' : ac_Name;
                        return '<span data-tip="'+ac_Name+'">'+ accName+' ( '+accCode+' )</span> ';
                      }

                  },
                  className:'dtglName'
                },
                {
                    data:'PARTICULAR',
                    render:function(data, type, full, meta){

                      if(full.PARTICULAR==null){
                        var PARTICULAR ='--';
                      }else if(full.PARTICULAR=='To -'){
                        var PARTICULAR ='';
                      }else{
                        var PARTICULAR = full.PARTICULAR;
                      }

                      if(full.REF_TEXT==null){
                        var REF_TEXT ='--';
                      }else{
                        var REF_TEXT =full.REF_TEXT;
                      }
                      var remark =  PARTICULAR +'- '+ REF_TEXT;
                      var refText = 'display' && remark.length > 50 ? remark.substr(0, 50) + '…' : remark;
                      return '<span data-tip="'+remark+'">'+ refText+'</span> ';
                    },
                    className:'dtglName'
                },
                {
                    data:'DRAMT',
                    name:'DRAMT',
                    className:'dtDrcrAmt'
                },
                {
                    data:'CRAMT',
                    name:'CRAMT',
                    className:'dtDrcrAmt'
                },
                {
                    data:'TDS_AMT',
                    name:'TDS_AMT',
                    className:'dtDrcrAmt'
                },
                {
                    data:'ACC_CODE',
                    name:'ACC_CODE',
                    className:'hideCol'
                },
                {
                    data:'GL_CODE',
                    name:'GL_CODE',
                    className:'hideCol'
                },
                {
                    render: function (data, type, full, meta){

                      var deletebtn ='<a href="Account/Edit-Cash-Bank/'+btoa(full['COMP_CODE'])+'/'+btoa(full['FY_CODE'])+'/'+btoa(full['TRAN_CODE'])+'/'+btoa(full['SERIES_CODE'])+'/'+btoa(full['VRNO'])+'" class="btn btn-warning btn-xs" title="edit" style="font-size: 10px;padding: 0px 2px;pointer-events: none" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" style="font-size: 10px;padding: 0px 2px;" data-toggle="modal" onclick="return deleteCashBank(\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\',\''+full['VRNO']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                      return deletebtn;

                    },
                    className:'dtAction'
                },
                {
                  render:function(data, type, full, meta){

                    if(full['VRTYPE'] == 'Receipt'){
                      var bankVal='';
                      return '<button class="btn btn-success pdfbtndn" type="button" id="pdfDown" onclick="downloadPDF(\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\','+full['VRNO']+',\''+full['VRTYPE']+'\',\''+bankVal+'\');"><i class="fa fa-download" aria-hidden="true"></i></button>';

                    }else if(full['VRTYPE'] == 'Payment'){

                        return '<button type="button" class="btn btn-success" id="tds_rate'+full['DT_RowIndex']+'" data-toggle="modal" data-target="#pdfDownloadModl'+full['DT_RowIndex']+'"><i class="fa fa-download" aria-hidden="true"></i></button>'+
                        /* /pdf choice modal */
                        '<div class="modal fade" id="pdfDownloadModl'+full['DT_RowIndex']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="true">'+
                          '<div class="modal-dialog modal-sm" role="document" style="margin-top: 13%;">'+
                            '<div class="modal-content" style="border-radius: 5px;">'+
                              '<div class="modal-header">'+
                                '<h5 class="modal-title modltitletext" id="exampleModalLabel">Print Format</h5>'+
                              '</div>'+
                              '<div class="modal-body">'+
                                '<div class="row tdsInputBox">'+
                                  '<div class="col-md-12">'+
                                    '<input type="radio" id="paymentVoucher'+full['DT_RowIndex']+'" name="CASHPDFDL" value="PAYMENT_VOUCHER" checked>'+
                                    '<label>&nbsp;Payment Voucher&nbsp;</label>'+
                                    '<input type="radio" id="paymentRemidies'+full['DT_RowIndex']+'" name="CASHPDFDL" value="PAYMENT_REMITTANCE" >'+
                                    '<label>&nbsp;Payment Remittance &nbsp;</label><br>'+
                                  '</div>'+
                                '</div>'+
                              '</div>'+
                              '<div class="modal-footer" style="text-align: center;">'+
                                '<button type="button" class="btn btn-primary" style="width: 30%;padding: 3px;" data-dismiss="modal" id="PDFMODL'+full['DT_RowIndex']+'" onclick="cashDownloadPdf('+full['DT_RowIndex']+',\''+full['COMP_CODE']+'\',\''+full['FY_CODE']+'\',\''+full['TRAN_CODE']+'\',\''+full['SERIES_CODE']+'\','+full['VRNO']+',\''+full['VRTYPE']+'\')"><i class="fa fa-download" aria-hidden="true"></i></button>'+
                              '</div>'+
                            '</div>'+
                          '</div>'+
                        '</div>';

                    }
                    
                  },
                  className:'dtAction'
                },
                 {
                    data:{SERIES:'SERIES_CODE',VRNO:'VRNO'},
                    render:function(data, type, row){

                      console.log('row =>',data.SERIES_CODE);
                     

                      return data.SERIES+' '+data.VRNO;
                    },
                    className:'hideCol'
                },

              ]


          });


       }


      $('#btnsearch').click(function(){

          var acct_code =  $('#accCode').val();
          var bank_code =  $('#BankCode').val();
          var toDate    =  $('#to_datecash').val();
          var fromDate  =  $('#fromDate').val();

          if (acct_code!='' || bank_code!='' || toDate!='' || fromDate!='') {

            $('#show_err_acct_code').html('');
            $('#InwardDispatch').DataTable().destroy();
            load_data(acct_code,bank_code,toDate,fromDate);

          }else{

           $('#InwardDispatch').DataTable().destroy();
            load_data();
          }


        });


        $('#ResetId').click(function(){
           
          $('#accCode').val('');
          $('#BankCode').val('');

          $('#InwardDispatch').DataTable().destroy();
          load_data();

        });



  });

  function cashDownloadPdf(slno,compCd,fyCd,tranCd,seriesCd,vrNo,vrType){
    var cashPDf = $("input[type='radio'][name='CASHPDFDL']:checked").val();
    downloadPDF(compCd,fyCd,tranCd,seriesCd,vrNo,vrType,cashPDf);
    //console.log('cashPDf',cashPDf);
  }

 function downloadPDF(compCd,fyCd,tranCd,seriesCd,vrno,vrType,cashPDf){
        var compCd,fyCd,tranCd,seriesCd,vrno,vrType;
        //consreturn false;
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({

          url:"{{ url('Transaction/Account/download-pdf-on-view-page') }}",

          method : "POST",

          type: "JSON",

          data: {compCd: compCd,fyCd:fyCd,tranCd:tranCd,seriesCd:seriesCd,vrno:vrno,vrType:vrType,cashPDf:cashPDf},

          success:function(data){

            var data1 = JSON.parse(data);
            console.log('data1',data1);
            var fyYear = data1.data[0].FY_CODE;
            var fyCd = fyYear.split('-');
            var seriesCd = data1.data[0].SERIES_CODE;
            var vrNo = data1.data[0].VRNO;
            var fileN = 'CB_'+fyCd[0]+''+seriesCd+''+vrNo;
            var link = document.createElement('a');
            link.href = data1.url;
            link.download = fileN+'.pdf';
            link.dispatchEvent(new MouseEvent('click'));
          }

        });
      }

</script>


@endsection