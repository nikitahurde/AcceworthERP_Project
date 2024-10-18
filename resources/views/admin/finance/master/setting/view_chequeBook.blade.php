@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
  .text-right{
    text-align: right;
  }
  .text-left{
    text-align: left;
  }
  .text-center{
    text-align: center;
  }

  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }
  .notification {
    background-color: #3c8dbc;
    color: white;
    text-decoration: none;
    padding: 2px 4px;
    position: relative;
    display: inline-block;
    border-radius:3px;
  }
  .notification .badge {
    position: absolute;
    top: -10px;
    right: -10px;
    padding: 2px 6px;
    border-radius: 50%;
    background-color: red;
    color: white;
  }
  .viewaccnot{
    font-size: 12px;
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
  
   .texIndbox1{
    width: 5%; 
    text-align: center;
  }
  .rateIndbox{
    width: 15%;
    text-align: center;
  }
  .itmdetlheading{
    vertical-align: middle !important;
    text-align: left;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .removeextraSInC{
    padding: 2px !important;
  }
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .chieldtblecls>tbody>tr>td {
    line-height: 1;
  }
  .iconSize{
    font-size: 10px;
  }
  .btn-group-xs>.btn, .btn-xs {
    padding: 1px 3px;
    font-size: 12px;
    line-height: 1;
    border-radius: 3px;
  }
  .modal-header .close {
    margin-top: -44px;
  }
</style>

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>

        Master Chequebook

        <small>View Details</small> 

      </h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}"> Master </a></li>

        <li class="active"><a href="{{ url('/configration/Setting/view-chequeBook') }}"> Master Chequebook</a></li>

        <li class="active"><a href="{{ url('/configration/Setting/view-chequeBook') }}">View Chequebook</a></li>

      </ol>

    </section>

    <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-xs-12">
             
          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Chequebook</h3>

              <div class="box-tools pull-right">

                <a href="{{ url('/configration/Setting/add-chequeBook') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Chequebook</a>

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
                <h4><i class="icon fa fa-ban"></i>Error...!</h4>
                {!! session('alert-error') !!}
              </div>

            @endif

            <div class="box-body">

              <table id="example" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Series Code</th>
                    <th class="text-center">Series Name</th>
                    <th class="text-center">Bank Account Code</th>
                    <th class="text-center">Bank Account</th>
                    <th class="text-center">Cheque Date</th>
                    <th class="text-center">From Cheque No </th>
                    <th class="text-center">To Cheque No</th>
                    <th class="text-center">Last Cheque No</th>
                    <th class="text-center">No of Leaf</th>
                    <th class="text-center">Action</th>
                  </tr>

                </thead>

                <tbody>

                </tbody>
                  
              </table>

            </div><!-- /.box-body -->

          </div><!-- /.box -->

        </div><!-- /.col -->

      </div><!-- /.row -->

    </section><!-- /.content -->

  </div>

<!-- --------------- delete modal ---------------- -->

  <div class="modal fade" id="DeleteChequebook" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

            <form action="{{ url('/configration/Setting/delete-chequebook-data') }}" method="post">

              @csrf

              <input type="hidden" name="headID" id="tblHeadID" value="">
              <input type="hidden" name="bodyID" id="tblBodyID" value="">
              <input type="hidden" name="slNum" id="tblSlno" value="">

              <input type="hidden" name="AssetViewLink" id="AssetViewLink" value="Master/Asset/View-Asset-Group">

              <input type="hidden" name="tblName" id="tblName" value="MASTER_CHEQUEBOOK_BODY">
              <input type="hidden" name="tblName2" id="tblName2" value="MASTER_CHEQUEBOOK_HEAD">
              <input type="hidden" name="colName" id="colName" value="CHQBHID">
              <input type="hidden" name="colNameTwo" id="colNameTwo" value="CHQBHID">
              <input type="hidden" name="colNameThree" id="colNameThree" value="">
              <input type="hidden" name="colNameFour" id="colNameFour" value="">

              <input type="hidden" name="colNameFive" id="colNameFive" value="">

              <input type="hidden" name="colNameSix" id="colNameSix" value="">

              <input type="button" value="Delete" id="del_data" style="margin-top: -12%;" class="btn btn-sm btn-danger" disabled="" onclick="funDelData()">

            </form>

        </div>

      </div>

    </div>

  </div>

<!-- --------------- delete modal ---------------- -->

@include('admin.include.footer')

<script type="text/javascript">

   function format ( d ) {
    //console.log('d',d);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.CHQBHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th class="removeextraSInC">Cheque No</th>'+
            '<th class="removeextraSInC">Cheque Date</th>'+
            '<th class="removeextraSInC">GL Code</th>'+
            '<th class="removeextraSInC">GL Name</th>'+
            '<th class="removeextraSInC">Account Code</th>'+
            '<th class="removeextraSInC">Account Name</th>'+
            '<th class="removeextraSInC">Amount</th>'+
            '<th class="removeextraSInC">Remark</th>'+
            '<th class="removeextraSInC">Action</th>'+
            '</tr></tbody>'+
    '</table>';
  }

  $(document).ready(function(){

    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    var t = $("#example").DataTable({
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
      serverSide:false,
      //scrollY:500,
      scrollX:true,
      paging: true,
      dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
        buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [1,2,3,4,5,6,7,8,9]
                      },
                      title: ' MASTER CHEQUE BOOK'+$("#headerexcelDt").val(),
                      filename: 'MASTER_CHEQUE_BOOK'+$("#headerexcelDt").val(),
                    }
                  ],
      ajax:{

        url : "{{ url('/configration/Setting/view-chequeBook') }}"

      },
      searching : true,

      columns: [
        
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
              return '<button id="showchildtable" onclick="showchildtable('+full.CHQBHID+')"><i class="fa fa-plus" id="minus'+full.CHQBHID+'" title="Edit"></i></button>'
            }
          },
          {  render: function(data, type, full, meta) {
               var series_code = full['SERIES_CODE'] != null ? full['SERIES_CODE'] : '---';
               return series_code;
            },
          },
          { 
            render: function(data, type, full, meta) {
               

                if(full.SERIES_NAME == null){
                  var seriesname = '--';
                }else{
                  var seriesname = full.SERIES_NAME;
                }
                return seriesname;
            }
          },

          {  render: function(data, type, full, meta) {
               var gl_code = full['GL_CODE'] != null ? full['GL_CODE'] : '---';
               return gl_code;
            },
          },
          { 
            render: function(data, type, full, meta) {
              

                if(full.GL_NAME == null){
                  var glname = '--';
                }else{
                  var glname = full.GL_NAME;
                }
                return glname;
            }
          },
          { data:"CHQBKDATE", 
            render: function (data) {
                var date = new Date(data);
                var month = date.getMonth() + 1;
                if(data=='0000-00-00'){
                  return '00-00-0000';
                }else{
                  
                return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                }
            },className:'text-right'
          },
          { data:"FROMCHEQUENO",
            className :'text-right'
          },
          { data:"TOCHEQUENO",
            className :'text-right'
          },
          { data:"LASTCHEQUENO",
            className :'text-right'
          },
          { 
            render: function (data, type, full, meta) {
                var toChqNo = full['TOCHEQUENO'];
                var fromChqNo = full['FROMCHEQUENO'];

                var noOfLeaf = toChqNo - fromChqNo;
                return noOfLeaf;
            },className :'text-right'
          },
          {
            render: function (data, type, full, meta) {
              // console.log(full['CASHGLCD']);
              if((full['CASHGLCD'] == '') || (full['CASHGLCD'] == null)){
                return '<a href="edit-chequebook/'+btoa(full['CHQBHID'])+'/'+btoa('NULL')+'/'+btoa('NULL')+'" class="btn btn-warning btn-xs actionBTN"><i class="fa fa-pencil iconSize" title="edit"></i></a> | <button type="button" data-toggle="modal"  class="btn btn-danger btn-xs actionBTN" onclick="return deleteChqbk('+full['CHQBHID']+',\'ALL\',\'ALL\','+full['DT_RowIndex']+')"><i class="fa fa-trash iconSize" title="delete"></i></button>';
              }else{
                return '<a class="btn btn-warning btn-xs actionBTN" disabled><i class="fa fa-pencil iconSize " title="edit"></i></a> | <button type="button" data-toggle="modal" class="btn btn-danger btn-xs actionBTN" disabled><i class="fa fa-trash iconSize" title="delete"></i></button>';
              }
              
            }, className :'text-center'
          }
                 
      ],
    });

    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
       // console.log(tr);
        var row = t.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    });

  });

  function showchildtable(tblHeadId){
      var tblHeadId;

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      $("#minus"+tblHeadId).toggleClass('fa-plus fa-minus rotate');

      $.ajax({

        url:"{{ url('configration/Setting/chequebook-chield-data') }}",
        method : "POST",
        type: "JSON",
        data: {tblHeadId: tblHeadId},
        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {
              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
          }else if(data1.response == 'success'){
              if(data1.data==''){

              }else{

                var objrow = data1.data;
                var srNo=1;
                var tableid = objrow[0].CHQBHID;
                
                $.each(objrow, function (i, objrow1) {
                  if((objrow1.GL_NAME == null) ||  (objrow1.GL_CODE == null) ||  (objrow1.ACC_NAME == null) ||  (objrow1.ACC_CODE == null)){
                    var glName = '----';
                    var glCode = '----';;
                    var accName = '----';;
                    var accCode = '----';;
                  }else{
                    var glName = objrow1.GL_NAME;
                    var glCode = objrow1.GL_CODE;
                    var accName = objrow1.ACC_NAME;
                    var accCode = objrow1.ACC_CODE;
                  }
                  var remark = objrow1.REMARK != null ? objrow1.REMARK : '----';
                  var cheilData = '<tr><td class="removeextraSInC text-right">'+objrow1.CHEQUENO+'</td><td class="text-right removeextraSInC">'+objrow1.CHEQUEDATE+'</td><td class="text-left removeextraSInC">'+glCode+'</td><td class="text-left removeextraSInC">'+glName+' </td><td class="text-left removeextraSInC">'+accCode+' </td><td class="text-left removeextraSInC">'+accName+' </td><td class="text-right removeextraSInC text-right">'+objrow1.AMOUNT+' </td><td class="text-left removeextraSInC">'+remark+' </td><td class="text-center removeextraSInC"><a href="edit-chequebook/'+btoa(objrow1['CHQBHID'])+'/'+btoa(objrow1['CHQBBID'])+'/'+btoa(objrow1['SLNO'])+'" class="btn btn-warning btn-xs actionBTN"><i class="fa fa-pencil iconSize" title="edit"></i></a> | <button type="button" data-toggle="modal"  class="btn btn-danger btn-xs actionBTN" onclick="return deleteChqbk('+objrow1['CHQBHID']+','+objrow1['CHQBBID']+','+objrow1['SLNO']+')"><i class="fa fa-trash iconSize" title="delete"></i></button></td></tr>';

                  $('#childData_'+tableid).append(cheilData);
                });
                
              }
          }
        }
      });
  }

</script>

<script type="text/javascript">

function funDelData(){

 var AssetCode  = $("#tblHeadID").val();
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
     }else{

     }

    }
  
});

}

  function deleteChqbk(headID,bodyID,slno,rowId){

    console.log('headID',headID);
    console.log('bodyID',bodyID);
    console.log('slno',slno);


    $('#delText').html('<div class="col-md-12 "><div class="form-group"><label>Remarks : <span class="required-field"></span></label><textarea class="form-control" id="del_remark" name="del_remark'+rowId+'" rows="2" oninput="deleteRemark()"></textarea></div></div>');

    $("#DeleteChequebook").modal('show');

    $('#tblHeadID').val(headID);
    $('#tblBodyID').val(bodyID);
    $('#tblSlno').val(slno);


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