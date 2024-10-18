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
  .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #c2d9ff;
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
  .crBal{
    display:none;
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
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .showSeletedName {
    font-size: 12px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  .rightcontent{
    text-align:right;
  }
  ::placeholder {
    text-align:left;
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
    font-size: 12px!important;
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
  .vrDateDataTbl{
    width: 7%;
    text-align: left;
  }
  .vrVrNoDataTbl{
    width: 9%;
    text-align: left;
  }
  .refDataTbl{
    width: 19%;
    text-align: left;
  }
  .drAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .crAmtDataTbl{
    width: 15%;
    text-align: right;
  }
  .balAmtDataTbl{
    width: 15%;
    text-align: left;
  }
  .balTypeDataTbl{
    width: 5%;
    text-align: left;
  }
  .pfctDataTbl{
    width: 15%;
    text-align: left;
  }
  .btn-sm {
    padding: 4px 10px;
    font-size: 12px;
    line-height: 1.5;
    border-radius: 3px;
  }

  .content-header h1 {
      margin-top: 2%;
  }
  .content-header .breadcrumb {
      margin-top: 2%;
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
  .content {
      min-height: 250px;
      padding: 9px;
      margin-right: auto;
      margin-left: auto;
      padding-left: 15px;
      padding-right: 15px;
  }
  .printBtnCls{
    display:none;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Statement of Account Report
      <small>View Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report</a></li>

      <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">List Statement of Account Report</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Statement of Account Report</h2>

      </div><!-- /.box-header -->

      <div class="box-body">

        <form id="myForm">

          @csrf

          <?php date_default_timezone_set('Asia/Kolkata'); ?>

          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-2">
              
              <div class="form-group">
                
                <label for="exampleInputEmail1">Account Type : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-alpha-asc"></i>

                    </div>
                   
                    <input list="accountTypeList" id="acct_type" name="acct_type" class="form-control  pull-left" value="{{ old('acct_type')}}" placeholder="Select Account Type Code" autocomplete="off">

                    <datalist id="accountTypeList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($accType_list as $key)

                      <option value='<?php echo $key->ATYPE_CODE ?>'   data-xyz ="<?php echo $key->ATYPE_NAME; ?>" ><?php echo $key->ATYPE_NAME; echo" [".$key->ATYPE_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div>

              </div>

            </div> <!-- /.COL -->

            <div class="col-md-2">

              <div class="form-group">
                
                <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-alpha-asc"></i>

                    </div>
                   
                    <input list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Account Code" autocomplete="off">

                    <datalist id="accountList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($acc_list as $key)

                      <option value='<?php echo $key->ACC_CODE ?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo" [".$key->ACC_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div>

                  <small id="show_err_acc_code"></small>

              </div>

            </div><!-- /.COL -->

            <div class="col-md-3">

              <div class="form-group">
                
                <label for="exampleInputEmail1">Account Name : </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-alpha-asc"></i>

                    </div>
                   
                    <input type="text" id="acct_name" name="acct_name" readonly="true" class="form-control  pull-left" value="" placeholder="Account Name" autocomplete="off">
                  
                  </div>

                  <small id="show_err_acc_name"></small>

              </div>

            </div><!-- /.COL -->

            <div class="col-md-4">

              <div style="margin-top: 2%;">
                <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 1px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                <button type="button" style="padding: 1px;" class="btn btn-warning" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>
              </div>

            </div><!-- /.COL -->

          </div><!-- /.box-body -->

        </form><!-- /.FORM -->

      </div><!-- /.box-body -->

      <div class="box-body">

        <!-- <button type="button" id="btnpdf" class="btn btn-danger btn-sm" style="margin-left: 60px !important;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Pdf </button> -->

        <table id="statementOfAccReport" class="table table-bordered table-striped table-hover">

          <thead class="theadC">

            <tr>
              <th class="text-center">#</th>
              <th class="text-center">Acc Code / Name</th>
              <th class="text-center">YrOpDr</th>
              <th class="text-center">YrOpCr</th>
              <th class="text-center">Yr.Dr.Amt</th>
              <th class="text-center">Yr.Cr.Amt</th>
              <th class="text-center">Cl.Dr.Amt</th>
              <th class="text-center">Cl.Cr.Amt</th>
            </tr>

          </thead>

          <tbody id="defualtSearch">

          </tbody>

        </table>

      </div><!-- /.box-body -->

      <div class="row" style="text-align: center;padding-bottom: 10px;">
        <button type="button" class="btn btn-primary btn-md" onclick="return confirmprintFun()" style="padding-bottom:5px;padding-top:2px;" id="print_Btn" disabled>Confirm</button>

        <a href="" class="btnprn btn btn-primary printBtnCls" id="printBtn" data-dismiss="modal"  style="padding-top: 2px;padding-bottom: 4px;">Print</a>

      </div>

    </div><!-- /. Custom-Box-->

  </section><!-- /. section-->

</div><!-- /.DIV -->

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/jquery.printPage.js') }}"></script>

 <script type="text/javascript">

    $(document).ready(function(){

        $("#acct_code").bind('change', function () {  

          //console.log('acc_code');

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          //console.log('acc_code',xyz);

          var msg = xyz ?  xyz : 'No Match';

          //console.log('acc_code',msg);

          if(msg == 'No Match'){
            $('#acct_name').val('');
            $('#show_err_acc_code').html('<p style="color:red;">* Account Code Fields isset required.</p>');
            $(this).val('');
            
          }else{
            $('#acct_name').val(msg);
          }

        });


/* ~~~~~~~~~~~ Account Statement Data Table ~~~~~~~~~~~~~~~ */

    //load_data();

    function load_data(acct_code = '',acct_type=''){

      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();


      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;

      $('#statementOfAccReport').DataTable({

          processing: true,
          serverSide: false,
          info: true,
          bPaginate: false,
          scrollY: 300,
          scroller: true,
          fixedHeader: true,
          order: [[0, 'asc']],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                    {
                      extend: 'excelHtml5',
                      filename: 'ACCOUNT_STATEMENT_'+getdate+'_'+gettime,
                      title: getcomName+'\n'+getFY+'\n'+' ACCOUNT STATEMENT',
                      exportOptions: {
                            columns: [1,2]
                      }
                    }

                  ],
          ajax:{
            url:'{{ url("/report/statement-of-acc-data") }}',
            data: {acct_code:acct_code,acct_type:acct_type}
          },
          columns: [

            {   
                data:'DT_RowIndex',
                'render': function (data, type, full, meta){
                  //console.log('full',bodyid);

                  var accName = full['acc_name'].split(' ').join('_');
                  var newaccName = accName.split('.').join('_');

                  return '<input type="checkbox" name="flit_id[]" class="pb_checkitm selectedAcc" value="'+full['ACC_CODE']+'~'+full['yropdr']+'~'+full['yropcr']+'~'+full['yrdramt']+'~'+full['yrcramt']+'~'+full['cldramt']+'~'+full['clcramt']+'">';
                }
            },
            {
              render: function (data, type, full, meta) {
                return full['ACC_CODE']+' - '+full['acc_name'];
              }
            },
            {
                data:'yropdr',
                name:'yropdr',
                className:'text-right'
               
            },
            {
                data:'yropcr',
                name:'yropcr',
               className:'text-right'
            },
            {
                data:'yrdramt',
                name:'yrdramt',
               className:'text-right'
            },
            {
                data:'yrcramt',
                name:'yrcramt',
               className:'text-right'
            },
            {
                data:'cldramt',
                name:'cldramt',
               className:'text-right'
            },
            {
                data:'clcramt',
                name:'clcramt',
               className:'text-right'
            }
            
          ]


      });


   }


/* ~~~~~~~~~~~ ./ Account Statement Data Table ~~~~~~~~~~~~~~~ */


/* ---------- Search Button Clicked -----------*/


  $('#btnsearch').click(function(){

      var acct_code   =  $('#acct_code').val();
      var acct_type   =  $('#acct_type').val();

      $('#statementOfAccReport').DataTable().destroy();
      load_data(acct_code,acct_type);

  });

  $("#statementOfAccReport").on('change', function() {

    var checkedCount = $("#statementOfAccReport input:checked").length;

    if(checkedCount > 0){
      $('#print_Btn').prop('disabled',false);
    }else{
      $('#print_Btn').prop('disabled',true);
    }
    $('#btnsearch').prop('disabled',true);
    $('#acct_type').prop('readonly',true);
    $('#acct_code').prop('readonly',true);

  });

/* ---------- ./ Search Button Clicked -----------*/

  $('#ResetId').click(function(){

    $('#acct_code').val('');
    $('#show_err_acc_code').val('');
   
  });

  $('#acct_type').on('change',function(){

    var acct_type  = $('#acct_type').val();

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }
    });

    $.ajax({

      url:"{{ url('get-account-list-against-acc-type') }}",
        method : "POST",
        type: "JSON",
        data: {acct_type: acct_type},
        success:function(data){
          var data1 = JSON.parse(data);
          if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.data_accList == ''){

              }else{
                $('#accountList').empty();
                $.each(data1.data_accList, function(k, getData){

                    $("#accountList").append($('<option>',{

                      value:getData.ACC_CODE,

                      'data-xyz':getData.ACC_NAME,
                      text:getData.ACC_CODE+'[ '+getData.ACC_NAME+' ]'

                    }));

                });

              }

          } /* /. success */
      } /* /. success function */
    }); /* /. ajax function */

  }); /* /.acc type*/

});


function confirmprintFun(){

  var checkitm = [];
  
  $('.selectedAcc').each(function(){
      if($(this).is(":checked")){
        
        var itmchk = $(this).val();

        checkitm.push(itmchk);
       
      }
  });

  $('#print_Btn').addClass('printBtnCls');
  $('#printBtn').removeClass('printBtnCls');
  $('.selectedAcc').prop('disabled',true);
  var linkURl      = "{{ url('/Report/Account/Print-statement-of-acc') }}"+'/'+checkitm;
    $('#printBtn').attr('href',linkURl);

  $('.btnprn').printPage();

}
</script>

<script type="text/javascript">
  $(document).ready(function(){
    /*$('.btnprn').printPage();
    for(var i=0;i<4;i++){
    
    }*/
    /*var mediaQueryList = window.matchMedia('print');

    mediaQueryList.addListener(function(mql) {
      if ((mql.matches)) {
        var url = "{{ url('configration/Setting/view-cheque-leaf-config') }}";
        setTimeout(function(){ window.location = url; });

      }else{
        var url = "{{ url('configration/Setting/view-cheque-leaf-config') }}";
    setTimeout(function(){ window.location = url; });
      }
    });*/
    
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



@endsection