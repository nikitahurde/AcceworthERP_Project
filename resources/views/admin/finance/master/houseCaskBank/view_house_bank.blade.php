@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .buttons-excel:before {
    content: '\f1c9';
    font-family: FontAwesome;
    padding-right: 5px;
  }
  .buttons-excel {
    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
  }
  .dt-button {
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
  .alignLeftClass{
    text-align: left;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }

  .input {
    position: absolute;
    opacity: 0;
  }
  .label {
     width: 100%;
    padding: 9px 30px;
    background: #e5e5e5;
    cursor: pointer;
    font-weight: bold;
    font-size: 14px;
    color: #7f7f7f;
    transition: background 0.1s, color 0.1s;
  }
  .label:hover {
    background: #d8d8d8;
  }
  .label:active {
    background: #ccc;

  }
  .input:focus + .label {
    z-index: 1;
  }
  .input:checked + .label {
    background: #52a0ce;
    color: #000;
  }
  .panel {
    display: none;
    padding: 20px 30px 30px;
    background: #fff;
    width: 100%;
  }
  @media (min-width: 600px) {
     .label {
        width: auto;
     }
     .panel {
        order: 99;
     }
  }
  .input:checked + .label + .panel {
    display: block;

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
  .coltbOne{
    width:6%;
  }
  .coltbTwo{
    width:20%;
  }
  .coltbThree{
    width:20%;
  }
  .coltbFour{
    width:27%;
  }
  .coltbFive{
    width:10%;
  }
  .coltbSix{
    width:10%;
  }
  .coltbSeven{
    width:7%;
  }
  .tabTable > table > tbody > tr > th{
    border:1px solid grey !important;
    background-color: #b6d2f0;
    padding:5px;
  }
  .tabTable > table > tbody > tr > td{
    border:1px solid grey !important;
    padding:5px;
  }
  .tabtask{
   padding: 6px !important; 
   font-weight:700;
  }
  .allBtnStyle{
    font-size: 10px;
    padding: 0px 2px;
  }
  .actionBTN {
    font-size: 10px;
    padding: 0px 2px;
}
</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>View House Bank <small>View Details</small></h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}">Master</a></li>

        <li class="active"><a href="{{ url('/Master/House-bank-cash/View-House-Bank-Mast') }}">Master House Bank</a></li>

        <li class="active"><a href="{{ url('/Master/House-bank-cash/View-House-Bank-Mast') }}">View House Bank</a></li>

      </ol>

  </section>
<!-- Main content -->
  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View House Bank</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/Master/House-bank-cash/House-Bank-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add House Bank</a>

            </div>

          </div><!-- /.box-header -->

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

          <div class="box-body">

            <table id="houseBankMast" class="table table-bordered table-striped table-hover">

              <thead>

                <tr>

                  <th class="text-center"></th>
                  <th class="text-center">Bank Code</th>
                  <th class="text-center">Bank Name</th>
                  <th class="text-center">PFCT Code</th>
                  <th class="text-center">PFCT Name</th>
                  <th class="text-center">Gl Code </th>
                  <th class="text-center">Gl Name </th>
                  <th class="text-center">Action</th>

                </tr>

              </thead>

            </table>

          </div><!-- /.box-body -->

        </div><!-- /.box -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.content -->

</div>

<div class="modal fade" id="houseBankDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-sm" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span>

          </button>

      </div>

      <div class="modal-body">
        <i class="fa fa-caret-right"></i> &nbsp;You Want To Delete This Data...!
        <div class="row" style="margin-top: 5%;" id="delText"></div>
      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">cancel</button>

        <form action="#" method="post">

          @csrf

          <input type="hidden" name="housebankID" value="" id="hsID">

          <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Asset/View-Asset-Group">

          <input type="hidden" name="tblName" id="tblName" value="MASTER_HOUSEBANK">
          <input type="hidden" name="tblName2" id="tblName2" value="">
          <input type="hidden" name="colName" id="colName" value="BANK_CODE">
          <input type="hidden" name="colNameTwo" id="colNameTwo" value="BANK_NAME">
          <input type="hidden" name="colNameThree" id="colNameThree" value="GL_CODE">
          <input type="hidden" name="colNameFour" id="colNameFour" value="GL_NAME">

          <input type="hidden" name="colNameFive" id="colNameFive" value="COMP_CODE">

          <input type="hidden" name="colNameSix" id="colNameSix" value="COMP_NAME">

          <input type="button" value="Delete" id="del_data" style="margin-top: -12%;" class="btn btn-sm btn-danger" disabled="" onclick="funDelData()">

        </form>

      </div>

    </div>

  </div>

</div>

@include('admin.include.footer')

<script type="text/javascript">

  function format(d) {
    uniqTblID = d.BANK_CODE;
    return '<div id="childData_'+uniqTblID+'" class="chieldTable">'+
            '<div class="nav-tabs-custom">'+
              '<ul class="nav nav-tabs" style="background-color: #ebe7db;height: 32px;">'+
                '<li class="active"><a href="#tab1_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="true">Basic Details</a></li>'+
                '<li class=""><a href="#tab2_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="false">Accounting Details</a></li>'+
              '</ul>'+

              '<div class="tab-content">'+

                  '<div class="tab-pane active tabTable" id="tab1_'+uniqTblID+'">'+
                    '<table class="table-border" style="width: 100%;">'+
                      '<tr id="tabOne'+uniqTblID+'">'+
                        '<th>Acc No</th>'+
                        '<th>MICR Code</th>'+
                        '<th>IFS Name</th>'+
                      '</tr>'+

                    '</table>'+
                  '</div>'+

                  '<div class="tab-pane tabTable" id="tab2_'+uniqTblID+'">'+
                   '<table class="table-border" style="width: 100%;">'+
                      '<tr id="tabTwo'+uniqTblID+'">'+
                        '<th>Address</th>'+
                        '<th>Phone No</th>'+
                        '<th>Fax No</th>'+
                        '<th>Email Id</th>'+
                      '</tr>'+

                    '</table>'+
                  '</div>'+
                
              '</div>'+
            '</div>'+
          '</div>';

  }

  $(document).ready(function(){

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    load_data();

    function load_data(){

        var t = $('#houseBankMast').DataTable({
          footerCallback: function ( row, data, start, end, display ) {
          var api = this.api(), data;

          var rowcount = data.length;
          var getRow = rowcount-1;
          
          if(rowcount > 0){
             $('.buttons-excel').attr('disabled',false);
          }else{
             $('.buttons-excel').attr('disabled',true);
          }
          
         },
          processing: true,

          serverSide: true,

          scrollX: true,
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
          buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [1,2,3,4,5,6]
                      },
                      title: 'MASTER HOUSE BANK'+$("#headerexcelDt").val(),
                      filename: 'MASTER_HOUSE_BANK_'+$("#headerexcelDt").val(),
                    }
                  ],          ajax:{

            url:'{{ url("/Master/House-bank-cash/View-House-Bank-Mast") }}'

          },

          columns: [

                  {
                    data:"",
                    render: function(data, type, full, meta) {
                      return '<button id="showchildtable" class="allBtnStyle" onclick="showchildtable(\''+full.BANK_CODE+'\','+full['DT_RowIndex']+')"><i class="fa fa-plus" id="minus'+full['DT_RowIndex']+'"title="Edit"></i></button>';
                    },
                    className:'mast-plant-control'
                  },

                  {data:'BANK_CODE'},
                  {data:'BANK_NAME'},
                  {data:'PFCT_CODE'},
                  {data:'PFCT_NAME'},
                  {data:'GL_NAME'},
                  {data:'GL_CODE'},

                  // {
                  //   data:'BANK_NAME',
                  //   render: function (data, type, full, meta){

                  //     if(full['BANK_CODE'] == null){
                  //       var bankCode = '--';
                  //     }else{
                  //       var bankCode = full['BANK_CODE'];
                  //     }

                  //     if(full['BANK_NAME'] == null){
                  //       var bankName = '--';
                  //     }else{
                  //       var bankName = full['BANK_NAME'];
                  //     }
                      
                  //     if(full['BANK_CODE'] !=null && full['BANK_NAME'] !=null){

                  //       var bank_Name = 'display' && bankName.length > 15 ? bankName.substr(0, 15) + '…' : bankName;
                  //       return '<span data-tip="'+bankName+'">'+ bank_Name+' ( '+bankCode+' )</span> ';
                  //     }else{
                  //       return bankName+' ( '+bankCode+' )';
                  //     }
                  //   },
                  //   className:'coltbThree'
                  // },
                  // {
                  //   data:'PFCT_NAME',
                  //   render: function (data, type, full, meta){

                  //     if(full['PFCT_CODE'] == null){
                  //       var pfctCode = '--';
                  //     }else{
                  //       var pfctCode = full['PFCT_CODE'];
                  //     }

                  //     if(full['PFCT_NAME'] == null){
                  //       var pfctName = '--';
                  //     }else{
                  //       var pfctName = full['PFCT_NAME'];
                  //     }
                      
                  //     if(full['PFCT_CODE'] !=null && full['PFCT_NAME'] !=null){

                  //       var pfct_Name = 'display' && pfctName.length > 15 ? pfctName.substr(0, 15) + '…' : pfctName;
                  //       return '<span data-tip="'+pfctName+'">'+ pfct_Name+' ( '+pfctCode+' )</span> ';
                  //     }else{
                  //       return pfctName+' ( '+pfctCode+' )';
                  //     }

                  //   },
                  //   className:'coltbTwo'
                  // },
                  // {
                  //   data:'GL_NAME',
                  //   render: function (data, type, full, meta){

                  //     if(full['GL_CODE'] == null){
                  //       var glCode = '--';
                  //     }else{
                  //       var glCode = full['GL_CODE'];
                  //     }

                  //     if(full['GL_NAME'] == null){
                  //       var glName = '--';
                  //     }else{
                  //       var glName = full['GL_NAME'];
                  //     }
                      
                  //     if(full['GL_CODE'] !=null && full['GL_NAME'] !=null){

                  //       var gl_Name = 'display' && glName.length > 15 ? glName.substr(0, 15) + '…' : glName;
                  //       return '<span data-tip="'+glName+'">'+ gl_Name+' ( '+glCode+' )</span> ';
                  //     }else{
                  //       return glName+' ( '+glCode+' )';
                  //     }

                  //   },
                  //   className:'coltbTwo'
                  // },
                 
                  {
                    render: function (data, type, full, meta){

                    
                      var enableBtn = 'enable';
                      var deletebtn ='<input type="hidden" id="deleteinput_'+full['BANK_CODE']+'" value="'+full['BANK_CODE']+'"><a href="Edit-House-Bank-Mast/'+btoa(full['BANK_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return deleteHB(\''+full['BANK_CODE']+'\','+full['DT_RowIndex']+');"><i class="fa fa-trash" title="Delete"></i></button>';
                     

                      return deletebtn;

                     },className:"text-center"
                  },
          ],
        });

        $('#houseBankMast tbody').on('click', 'td.mast-plant-control', function () {
          var tr = $(this).closest('tr');
          var row = t.row( tr );
   
          if ( row.child.isShown() ) {
              // This row is already open - close it
              row.child.hide();
              tr.removeClass('shown');
          }else{
              // Open this row
              row.child( format(row.data()) ).show();
              tr.addClass('shown');
          }
        });

    }

  });


  function showchildtable(bank_Cd,rowId){

    var bankCd = bank_Cd;

    var tabId = bankCd;

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#minus"+rowId).toggleClass('fa-plus fa-minus rotate');

    $.ajax({

          url:"{{  url('view-house-bank-mast-chield-data') }}",
          method : "POST",
          type: "JSON",
          data: {bankCd: bankCd},
          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

            }else if(data1.response == 'success'){

              var accNo    = (data1.data.ACCT_NUMBER != null) ? data1.data.ACCT_NUMBER : '---';
              var micrNo   = (data1.data.MICR_CODE != null) ? data1.data.MICR_CODE : '---';
              var ifscCode = (data1.data.IFS_CODE != null) ? data1.data.IFS_CODE : '---';

              $('#tabOne'+tabId).after('<tr><td>'+accNo+'</td><td>'+micrNo+'</td><td>'+ifscCode+'</td></tr>');

              var add1        = (data1.data.ADD1 != null) ? data1.data.ADD1 : '---';
              var add2        = (data1.data.ADD2 != null) ? data1.data.ADD2 : '---';
              var add3        = (data1.data.ADD3 != null) ? data1.data.ADD3 : '---';
              var cityName    = (data1.data.CITY_NAME != null) ? data1.data.CITY_NAME : '---';
              var distName    = (data1.data.DIST_NAME != null) ? data1.data.DIST_NAME : '---';
              var stateName   = (data1.data.STATE_NAME != null) ? data1.data.STATE_NAME : '---';
              var countryName = (data1.data.COUNTRY_NAME != null) ? data1.data.COUNTRY_NAME : '---';
              var pinCode     = (data1.data.PIN_CODE != null) ? data1.data.PIN_CODE : '---';
              var contactNo   = (data1.data.CONTACTNO != null) ? data1.data.CONTACTNO : '---';
              var faxNo       = (data1.data.FAX_NO != null) ? data1.data.FAX_NO : '---';
              var email       = (data1.data.EMAIL != null) ? data1.data.EMAIL : '---';

              $('#tabTwo'+tabId).after('<tr><td>'+add1+' '+add2+' '+add3+' '+cityName+' '+distName+' '+stateName+' '+countryName+' '+pinCode+'</td><td>'+contactNo+'</td><td>'+faxNo+'</td><td>'+email+'</td></tr>');

            }

            

          }
    });
    
  }

</script>

<script type="text/javascript">

function funDelData(){

 var AssetCode  = $("#hsID").val();
 var del_remark = $("#del_remark").val();
 var tblName    = $("#tblName").val();
 var tblName2   = $("#tblName2").val();
 var colName1   = $("#colName").val();
 var colName2   = $("#colNameTwo").val();
 var colName3   = $("#colNameThree").val();
 var colName4   = $("#colNameFour").val();
 var colName5   = $("#colNameFive").val();
 var colName6   = $("#colNameSix").val();

 var AssetViewLink = $("#AssetViewLink").val();
 
 $.ajaxSetup({

        headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

  });

  $.ajax({

    url:"{{ url('/Master/Asset/Delete-Data') }}",
    
    method : "POST",
    
    type: "JSON",
    
    data: {AssetCode: AssetCode,del_remark:del_remark,tblName:tblName,tblName2:tblName2,colName1:colName1,colName2:colName2,colName3:colName3,colName4:colName4,colName5:colName5,colName6:colName6,AssetViewLink:AssetViewLink},
    
    success:function(data){

     var data1 = JSON.parse(data);
     
     if(data1.response =='success'){

       // $('#costTypeDelete').modal('hide');
       // $('#del_remark').val('');
       location.reload();
     }else if(data1.response =='error'){
        location.reload();
     }else{

     }
     
    }
  
});

}

  function deleteHB(bankCd,rowId){

    var hiddnId = bankCd;

    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $("#houseBankDelete").modal('show');

    $("#hsID").val(hiddnId);
  }

  function deleteRemark(){
    
    var remark = $('#del_remark').val();

    if(remark.length > 10){
       $('#del_data').attr('disabled',false);
    }else{
      $('#del_data').attr('disabled',true);
    }

    // console.log('remark',remark);
  }

</script>

@endsection