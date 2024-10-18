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
</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>View Plant <small>View Details</small></h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}">Master</a></li>

        <li class="active"><a href="{{ url('/finance/view-tax') }}">Master Plant</a></li>

        <li class="active"><a href="{{ url('/finance/view-tax') }}">View Plant</a></li>

      </ol>

  </section>
<!-- Main content -->
  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Plant</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/Master/Setting/Plant_Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Plant</a>

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

            <table id="plantMast" class="table table-bordered table-striped table-hover">

              <thead>

                <tr>

                  <th class="text-center" ></th>
                  <th class="text-center"  style="width:7%;">Company Code</th>
                  <th class="text-center" style="width:15%;">Company Name</th>
                  <th class="text-center" style="width:9%;">PFCT Code</th>
                  <th class="text-center" style="width:15%;">PFCT Name</th>
                  <th class="text-center" style="width:9%;">Plant Code</th>
                  <th class="text-center" style="width:15%;">Plant Name</th>
                  <th class="text-center" style="width:15%;">Address</th>
                  <th class="text-center" style="width:10%;">Email-id </th>
                  <th class="text-center" style="width:9%;">State </th>
                  <th class="text-center" style="width:5%;">Action</th>

                </tr>

              </thead>

            </table>

          </div><!-- /.box-body -->

        </div><!-- /.box -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.content -->

</div>

<div class="modal fade" id="plantDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">cancel</button>

        <form action="{{ url('/Master/Setting/Delete-Plant_Mast') }}" method="post">

          @csrf

          <input type="hidden" name="PlantID" value="" id="PlantID">

          <input type="submit" value="Delete" class="btn btn-sm btn-danger" style="margin-top: -20%;">

        </form>

      </div>

    </div>

  </div>

</div>

@include('admin.include.footer')

<script type="text/javascript">

  function format(d) {
    uniqTblID = d.COMP_CODE+'_'+d.PFCT_CODE+'_'+d.PLANT_CODE;
    return '<div id="childData_'+uniqTblID+'" class="chieldTable">'+
            '<div class="nav-tabs-custom">'+
              '<ul class="nav nav-tabs" style="background-color: #ebe7db;height: 32px;">'+
                '<li class="active"><a href="#tab1_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="true">Basic Details</a></li>'+
                '<li class=""><a href="#tab2_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="false">Accounting Details</a></li>'+
                '<li class=""><a href="#tab3_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="false">Non-Accounting Details</a></li>'+
              '</ul>'+

              '<div class="tab-content">'+

                  '<div class="tab-pane active tabTable" id="tab1_'+uniqTblID+'">'+
                    '<table class="table-border" style="width: 100%;">'+
                      '<tr id="tabOne'+uniqTblID+'">'+
                        '<th>Plant Name</th>'+
                        '<th>Address</th>'+
                        '<th>Phone no</th>'+
                        '<th>Email Id</th>'+
                        '<th>Country</th>'+
                        '<th>State</th>'+
                        '<th>District</th>'+
                        '<th>City</th>'+
                        '<th>Pincode</th>'+
                      '</tr>'+

                    '</table>'+
                  '</div>'+

                  '<div class="tab-pane tabTable" id="tab2_'+uniqTblID+'">'+
                   '<table class="table-border" style="width: 100%;">'+
                      '<tr id="tabTwo'+uniqTblID+'">'+
                        '<th>TAN No</th>'+
                        '<th>TIN No</th>'+
                        '<th>CIN No</th>'+
                        '<th>PAN No</th>'+
                        '<th>GST No</th>'+
                        '<th>ESIC No</th>'+
                        '<th>Sale Tax No</th>'+
                        '<th>CSale Tax No</th>'+
                        '<th>Service Tax No</th>'+
                        '<th>EPFO No</th>'+
                      '</tr>'+

                    '</table>'+
                  '</div>'+

                  '<div class="tab-pane tabTable" id="tab3_'+uniqTblID+'">'+
                    '<table class="table-border" style="width: 100%;">'+
                      '<tr  id="tabThree'+uniqTblID+'">'+
                        '<th>ECC No</th>'+
                        '<th>Range No</th>'+
                        '<th>Range Name</th>'+
                        '<th>Range Address1</th>'+
                        '<th>Range Address2</th>'+
                        '<th>Division</th>'+
                        '<th>Collector</th>'+
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

        var t = $('#plantMast').DataTable({
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
          paging: true,
          //dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
           dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
        buttons:  [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [1,2,3,4,5,6,7,8,9]
                      },
                      title: ' MASTER PLANT'+$("#headerexcelDt").val(),
                      filename: 'MASTER_PLANT_'+$("#headerexcelDt").val(),
                    }
                  ],
          ajax:{

            url:'{{ url("/Master/Setting/View-Plant_Mast") }}'

          },

          columns: [

                  {
                    data:"",
                    render: function(data, type, full, meta) {
                      return '<button id="showchildtable" class="allBtnStyle" onclick="showchildtable(\''+full.COMP_CODE+'\',\''+full.PFCT_CODE+'\',\''+full.PLANT_CODE+'\','+full.DT_RowIndex+')"><i class="fa fa-plus" id="minus'+full['DT_RowIndex']+'"title="Edit"></i></button>';
                    },
                    className:'mast-plant-control'
                  },
                  {data : 'COMP_CODE'},
                  {data : 'COMP_NAME'},


                  { 
                    data:'PFCT_CODE',
                    render: function (data, type, full, meta){
                    
                      if(full['PFCT_CODE'] == null){
                        var pfctCode = '--';
                      }else{
                        var pfctCode = full['PFCT_CODE'];
                      }

                      return pfctCode;
                   }

                  },

                  {
                    data:'PFCT_NAME',
                    render: function (data, type, full, meta){
                      
                      if(full['PFCT_NAME'] == null){
                        var pfctName = '--';
                      }else{
                        var pfctName = full['PFCT_NAME'];
                      }
                     
                      var pfct_Name = 'display' && pfctName.length > 15 ? pfctName.substr(0, 15) + '…' : pfctName;
                        return '<span data-tip="'+pfctName+'">'+ pfct_Name+'</span> ';
                      
                    },
                    className:'coltbThree'
                  },
                  { 

                   data:'PLANT_CODE',
                   render: function (data, type, full, meta){
                      
                      if(full['PLANT_CODE'] == null){
                        var plantCode = '--';
                      }else{
                        var plantCode = full['PLANT_CODE'];
                      }
                      return plantCode;
                   }
                  },

                  {
                    data:'PLANT_NAME',
                    render: function (data, type, full, meta){

                    

                      if(full['PLANT_NAME'] == null){
                        var plantName = '--';
                      }else{
                        var plantName = full['PLANT_NAME'];
                      }
                      
                      // if(full['PLANT_CODE'] !=null && full['PLANT_NAME'] !=null){

                        var plant_Name = 'display' && plantName.length > 15 ? plantName.substr(0, 15) + '…' : plantName;
                        return '<span data-tip="'+plant_Name+'">'+ plantName+'</span> ';
                      // }else{
                      //   return plantName+' ( '+plantCode+' )';
                      // }

                    },
                    className:'coltbTwo'
                  },
                  {
                    render: function (data, type, full, meta){

                      if(full['ADD1'] == null){
                        var addOne = '';
                      }else{
                        var addOne = full['ADD1'];
                      }

                      if(full['ADD2'] == null){
                        var addTwo = '';
                      }else{
                        var addTwo = full['ADD2'];
                      }

                      if(full['ADD3'] == null){
                        var addThree = '';
                      }else{
                        var addThree = full['ADD3'];
                      }

                      var addr =  addOne+' '+addTwo+' '+addThree;

                      var plant_addr = 'display' && addr.length > 15 ? addr.substr(0, 15) + '…' : addr;
                        return '<span data-tip="'+addr+'">'+ plant_addr+'</span> ';

                    }
                  },
                  {
                    data:'EMAIL',
                    name:'EMAIL',
                    className:'coltbFive'
                  },
                  {
                    data:'STATE_NAME',
                    name:'STATE_NAME',
                    className:'coltbSix'
                  },
                  {
                    data:'action',
                    name:'action',orderable: false, searchable: false,className:'text-center'
                  }
          ],
        });

        $('#plantMast tbody').on('click', 'td.mast-plant-control', function () {
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


  function showchildtable(compcd,pfctcd,plantcd,getId){

    var compCode = compcd;
    var pftcCode = pfctcd;
    var plantCode = plantcd;

    var tabId = compCode+'_'+pftcCode+'_'+plantCode;

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $("#minus"+getId).toggleClass('fa-plus fa-minus rotate');
    $.ajax({

          url:"{{  url('view-plant-mast-chield-basic-data') }}",
          method : "POST",
          type: "JSON",
          data: {compCode: compCode,pftcCode:pftcCode,plantCode:plantCode},
          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

            }else if(data1.response == 'success'){

              // var phone_no = data1.data.PHONE1;
              // if(phone_no == '' || phone_no == null){
              //   phoneNo = '';
              // }else{
              //   phoneNo = phone_no;
              // }
              var phoneNo = (data1.data.PHONE1 != null) ? data1.data.PHONE1 : '---';
              var addr = (data1.data.ADD1 != null) ? data1.data.ADD1 : '---';

              $('#tabOne'+tabId).after('<tr><td>'+data1.data.PLANT_NAME+'</td><td>'+addr+'</td><td>'+phoneNo+'</td><td>'+data1.data.EMAIL+'</td><td>'+data1.data.COUNTRY_CODE+'</td><td>'+data1.data.STATE_CODE+'</td><td>'+data1.data.DIST_CODE+'</td><td>'+data1.data.CITY_CODE+'</td><td>'+data1.data.PIN_CODE+'</td></tr>');

              if(data1.data.TIN_NO){
                var tinNo=data1.data.TIN_NO;
              }else{
                var tinNo='----';
              }

              if(data1.data.TAN_NO){
                var tanNo=data1.data.TAN_NO;
              }else{
                var tanNo='----';
              }

              if(data1.data.CIN_NO){
                var cinNo=data1.data.CIN_NO;
              }else{
                var cinNo='----';
              }

              if(data1.data.PAN_NO){
                var panNo=data1.data.PAN_NO;
              }else{
                var panNo='----';
              }

              if(data1.data.GST_NO){
                var gstNo=data1.data.GST_NO;
              }else{
                var gstNo='----';
              }

              if(data1.data.ESIC_NO){
                var esicNo=data1.data.ESIC_NO;
              }else{
                var esicNo='----';
              }

              if(data1.data.SALES_TAXNO){
                var saleTaxNo=data1.data.SALES_TAXNO;
              }else{
                var saleTaxNo='----';
              }

              if(data1.data.CSALES_TAXNO){
                var csaleTaxNo=data1.data.CSALES_TAXNO;
              }else{
                var csaleTaxNo='----';
              }

              if(data1.data.SERVICE_TAXNO){
                var serviceTaxNo=data1.data.SERVICE_TAXNO;
              }else{
                var serviceTaxNo='----';
              }

              if(data1.data.EPFO_NO){
                var epfoNo=data1.data.EPFO_NO;
              }else{
                var epfoNo='----';
              }

              $('#tabTwo'+tabId).after('<tr><td>'+tinNo+'</td><td>'+tanNo+'</td><td>'+cinNo+'</td><td>'+panNo+'</td><td>'+gstNo+'</td><td>'+esicNo+'</td><td>'+saleTaxNo+'</td><td>'+csaleTaxNo+'</td><td>'+serviceTaxNo+'</td><td>'+epfoNo+'</td></tr>');


              var ecc_no     = (data1.data.ECC_NO != null) ? data1.data.ECC_NO : '---';
              var range_no   = (data.RANGE_NO != null) ? data.RANGE_NO : '---';
              var range_name = (data1.data.RANGE_NAME != null) ? data1.data.RANGE_NAME : '---';
              var addr1      = (data1.data.RANGE_ADD1 != null) ? data1.data.RANGE_ADD1 : '---';
              var addr2      = (data1.data.RANGE_ADD2 != null) ? data1.data.RANGE_ADD2 : '---';
              var division   = (data1.data.DIVISION != null) ? data1.data.DIVISION : '---';
              var collector  = (data1.data.COLLECTOR != null) ? data1.data.COLLECTOR : '---';

              $('#tabThree'+tabId).after('<tr><td>'+ecc_no+'</td><td>'+range_no+'</td><td>'+range_name+'</td><td>'+addr1+'</td><td>'+addr2+'</td><td>'+division+'</td><td>'+collector+'</td></tr>');

            }

            

          }
    });
    
  }

</script>

<script type="text/javascript">

  function deletePlant(compCd,pfctCd,plantCd){
    var hiddnId = compCd+'~'+pfctCd+'~'+plantCd;
    $("#plantDelete").modal('show');
    $("#PlantID").val(hiddnId);
  }

</script>

@endsection