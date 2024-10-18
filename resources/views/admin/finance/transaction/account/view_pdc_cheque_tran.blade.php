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
    width:10%;
  }
  .dtglName{
    width:15%;
  }
  .dtDrcrAmt{
    width:11%;
    text-align:right;
  }
  .dtAction{
    width:5%;
  }

  /* ---- custom table css ----- */

    .divTable{
      display: table;
      width: 100%;
    }
    .divTableRow {
      display: table-row;
    }
    .divTableCell {
      border: 1px solid #d4d4d4;
      display: table-cell;
      padding: 6px 8px;
      text-align: center;
      font-weight: bold;
      background-color: #f5deba;
    }
    .divTableBodyRow {
      border: 1px solid #d4d4d4;
      display: table-cell;
      padding: 3px 8px;
      text-align: center;
      font-size: 12px;
    }
    .divTableFoot {
      background-color: #EEE;
      display: table-footer-group;
      font-weight: bold;
    }
    .divTableBody {
      display: table-row-group;
    }
    .colmnOneCDT{
      width: 5%;
    }
    .colmnTwoCDT{
      width: 9%;
      text-align:left;
    }
    .colmnThreeCDT{
      width: 10%;
      text-align:left;
    }
    .colmnFourCDT{
      width: 13%;
      text-align:left;
    }
    .colmnFiveCDT{
      width: 10%;
      text-align:left;
    }

/* ---- custom table css ----- */
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>Pdc Cheque Trans <small> View Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report/MIS</a></li>

      <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">Pdc Cheque Trans Report</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Pdc Cheque Trans</h2>

        <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Account/Pdc-Chq-Transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Pdc Cheque Trans</a>

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
              <th class="text-center dtVrno"> Series Name</th>
              <th class="text-center dtglName">Gl Name</th>
              <th class="text-center dtglName">Acc Name</th>
              <th class="text-center dtglName">Pfct Name</th>
             
              <th class="text-center dtAction">Action</th>
             
            </tr>

          </thead>

          <tbody id="defualtSearch">

            

          </tbody>
         
  
        </table>

      </div><!-- /.box-body -->

    </div>

  </section>

   <section class="content" style="margin-top: -4%;">

                <div class="row">

                  <div class="col-xs-12">

                    <div class="box box-primary Custom-Box">

                      <div class="box-body">

                        <div class="divTable">

                          <div class="divTableBody" id="chieldBodyDetails">
                            
                          </div><!-- /.divTableBody -->
                          
                        </div><!-- /.div table -->
                        
                      </div><!-- /.box-body -->
                      
                    </div><!-- /.Custom-Box -->
                    
                  </div><!-- /.col -->
                  
                </div><!-- /.row -->
    
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

            <input type="hidden" name="cashbankid" value="" id='getuserid'>

            <input type="submit" value="delete" class="btn btn-sm btn-danger" style="margin-top: -20%;">

          </form>

         </div>

      </div>

    </div>

  </div>
 
<!-- ---------  modal for data delete -------------- -->

@include('admin.include.footer')

<script type="text/javascript">
  function deleteCashBank(id){
      //console.log(id);
     $('#getuserid').val(id);

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

          $('#InwardDispatch').DataTable({

           
              processing: true,
              serverSide: true,
              scrollX: false,
              'fnCreatedRow': function (nRow, aData, iDataIndex) {
                  
               $(nRow).attr('onclick', "showBodyDetail(\""+aData['PCHQHID']+"\")"); // or whatever you choose to set as the id
            },
             // dom : 'Bfrtip',
             pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
              buttons: [
                        'excelHtml5',
                        ],
              
              ajax:{
                url:'{{ url("/Transaction/Account/View-Pdc-Chq-Transaction") }}',
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
                  data :'SERIES_CODE',
                   className:'dtglName',
                  render: function (data, type, full, meta){

                      if(full['SERIES_CODE'] == null){
                        var seriesCode = '--';
                      }else{
                        var seriesCode = full['SERIES_CODE']+' - '+full['SERIES_NAME'];
                      }
                      

                      return seriesCode;
                       
                  },
                 
                },
                {   
                  data :'GL_CODE',
                   className:'dtglName',
                  render: function (data, type, full, meta){

                      if(full['GL_CODE'] == null){
                        var glCode = '--';
                      }else{
                        var glCode = full['GL_CODE']+' - '+full['GL_NAME'];
                      }
                      

                      return glCode;
                       
                  },
                 
                },
                 {    
                    data :'ACC_NAME',
                    className:'dtglName',
                    render: function (data, type, full, meta){

                      if(full['ACC_NAME'] == null){
                        var accCode ='--';
                      }else{
                        var accCode =full['ACC_CODE']+'-'+full['ACC_NAME'];
                      }

                      return accCode;


                  },
                  
                },
                {    
                    data :'PFCT_NAME',
                    className:'dtglName',
                    render: function (data, type, full, meta){

                      if(full['PFCT_NAME'] == null){
                        var pfctCode ='--';
                      }else{
                        var pfctCode =full['PFCT_CODE']+'-'+full['PFCT_NAME'];
                      }

                      return pfctCode;


                  },
                  
                },
               
               
                {
                    data:'action',
                    name:'action',
                    className:'dtAction'
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

 function downloadPDF(compCd,fyCd,tranCd,seriesCd,vrno,vrType){
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

          data: {compCd: compCd,fyCd:fyCd,tranCd:tranCd,seriesCd:seriesCd,vrno:vrno,vrType:vrType},

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

<script type="text/javascript">
  function showBodyDetail(headId){

     // var fieldName = headId;
      var fieldName = headId;

      var pageIndentity='PDC_CHEQUE_TRAN';

      $.ajaxSetup({

        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

      $.ajax({

          url:"{{ url('show-details-on-click-of-row-in-view-page') }}",

          method : "POST",

          type: "JSON",

          data: {fieldName:fieldName,pageIndentity:pageIndentity},

          success:function(data){

            var data1 = JSON.parse(data);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
              }else if(data1.response == 'success'){

                  $('#chieldBodyDetails').empty();

                  var headData = "<div class='divTableRow'><div class='divTableCell'>Sr.No</div><div class='divTableCell'>VR DATE</div><div class='divTableCell'>Cheque No</div><div class='divTableCell'>Cheque Date</div><div class='divTableCell'>Cheque Amt</div><div class='divTableCell'>Particuler</div></div>";

                    $('#chieldBodyDetails').append(headData);

                  if(data1.dataDetails==''){
                   
                  }else{

                    var slno=1,totlAmt=0;
                    $.each(data1.dataDetails, function(k, getData){
                      totlAmt +=parseFloat(getData.CHEQUE_AMT);
                    
                      var doDate     = getData.VRDATE;
                      var splitDt    = doDate.split('-');
                      var formDoDate = splitDt[2]+'-'+splitDt[1]+'-'+splitDt[0];
                      var bodyData ="<div class='divTableRow'><div class='divTableBodyRow colmnOneCDT'>"+slno+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT' style='text-align:left;'>"+formDoDate+"</div>"+
                        "<div class='divTableBodyRow colmnTwoCDT'>"+getData.CHEQUE_NO+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT'>"+getData.CHEQUE_DATE+"</div>"+
                        "<div class='divTableBodyRow colmnThreeCDT' style='text-align:right;'>"+getData.CHEQUE_AMT+"</div>"+
                        "<div class='divTableBodyRow colmnFourCDT' style='text-align:right;'>"+getData.PARTICULAR+"</div>";

                      $('#chieldBodyDetails').append(bodyData);

                    slno++;});

                    var footerData = "<div class='divTableRow'><div class='divTableBodyRow'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow'></div><div class='divTableBodyRow' style='text-align:right;'></div><div class='divTableCell' style='text-align:right;'>"+totlAmt.toFixed(3)+"</div></div>";

                    $('#chieldBodyDetails').append(footerData);
                    
                  } /* /. CHECK DATA*/

              }/* /. RESPONSE CHECK*/

          }/* /. SUCCESS FUNCTION*/

      });/* /. AJAX FUCNTION*/

  }
</script>


@endsection