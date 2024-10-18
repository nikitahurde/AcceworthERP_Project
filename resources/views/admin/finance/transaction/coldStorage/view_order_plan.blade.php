@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
  .chieldtblecls tr td{
    border: 1px solid #ccc4c4 !important;
  }
  .chieldtblecls tr th{
    border: 1px solid #ccc4c4 !important;
    text-align: center !important;
  }
  .columnhide{
    display:none;
  }
  .required-field::before {
    content: "*";
    color: red;
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
  .chieldtblecls tbody tr td {
    padding: 4px;
  }
  .chieldtblecls>tbody>tr>td {
    line-height: 0.5;
  }
  .amtRight{
    text-align:right;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1> Order Plan<small><b> Details</b></small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}"> Transaction </a></li>

      <li class="active"><a href="{{ url('/transaction/ColdStorage/view-order-plan-transaction') }}">Order Plan</a></li>

      <li class="active"><a href="{{ url('/transaction/ColdStorage/view-order-plan-transaction') }}">View Order Plan</a></li>

    </ol>

  </section>

  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">
             
        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Order Plan</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/ColdStorage/add-order-plan-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Order Plan</a>

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

              <table id="example" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th class="text-center">#</th>
                    <th class="text-center">Date</th>
                    <th class="text-center">Customer Name</th>
                    <th class="text-center">Item Name</th>
                    <th class="text-center">Packing Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Plant Name</th>
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


  <div class="modal fade" id="indentDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

        <div class="modal-header">

          <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

              <span aria-hidden="true">&times;</span>

            </button>

        </div>

        <div class="modal-body">

          You Want To Delete This Purchase Indent Data...!

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>

          <form action="{{ url('/finance/delete-purchase-body-indent') }}" method="post">
            @csrf

            <input type="hidden" name="bodyID" id="bodyID" value="">

            <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">

          </form>

        </div>

      </div>

    </div>

  </div>

@include('admin.include.footer')

<script type="text/javascript">

   function format ( d ) {
  //  console.log('d',d.id);
    // `d` is the original data object for the row
    return '<table border="0" class="table table-bordered table-striped table-hover chieldtblecls" id="childData_'+d.CSPHID+'" style="padding-left:50px;">'+
        '<tbody style="border: 2px solid #c1c1c1;"><tr>'+
            '<th>Sr. No.</th>'+
            '<th>Cold Storage</th>'+
            '<th>Chamber</th>'+
            '<th>Floor</th>'+
            '<th>Block</th>'+
            '<th>Qty</th>'+
            '<th>Um</th>'+
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

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/transaction/ColdStorage/view-order-plan-transaction') }}"

       },
       searching : true,
    

        columns: [
         
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
            return '<button id="showchildtable" onclick="showchildtable('+full.CSPHID+')"><i class="fa fa-plus" id="minus'+full.CSPHID+'" title="Toggle"></i></button>'
            }
          },
          {
              data:'VRDATE',
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
              },
              className:'dtvrDate'
          },
          {  
            render: function (data, type, full, meta){

              var accCd    = (full['ACC_CODE'] != null) ? full['ACC_CODE'] : '---';
              var accNm    = (full['ACC_NAME'] != null) ? full['ACC_NAME'] : '---';

              var acc_name = 'display' && accNm.length > 15 ? accNm.substr(0, 15) + '…' : accNm;
              return '<span data-tip="'+accNm+'">'+ acc_name+' ( '+accCd+' )</span> ';

            }
          },
          {  
            render: function (data, type, full, meta){

              var itemCd    = (full['ITEM_CODE'] != null) ? full['ITEM_CODE'] : '---';
              var itemNm    = (full['ITEM_NAME'] != null) ? full['ITEM_NAME'] : '---';

              var item_name = 'display' && itemNm.length > 15 ? itemNm.substr(0, 15) + '…' : itemNm;
              return '<span data-tip="'+itemNm+'">'+ item_name+' ( '+itemCd+' )</span> ';

            }
          },
          {  
            render: function (data, type, full, meta){

              var packingCd    = (full['PACKING_CODE'] != null) ? full['PACKING_CODE'] : '---';
              var packingNm    = (full['PACKING_NAME'] != null) ? full['PACKING_NAME'] : '---';

              var packing_name = 'display' && packingNm.length > 15 ? packingNm.substr(0, 15) + '…' : packingNm;
              return '<span data-tip="'+packingNm+'">'+ packing_name+' ( '+packingCd+' )</span> ';

            }
          },
          {
              data:'QTY',
              name:'QTY',
              className:'amtRight'
          },
          {  
            render: function (data, type, full, meta){

              var plantCd    = (full['PLANT_CODE'] != null) ? full['PLANT_CODE'] : '---';
              var plantNm    = (full['PLANT_NAME'] != null) ? full['PLANT_NAME'] : '---';

              var plant_name = 'display' && plantNm.length > 15 ? plantNm.substr(0, 15) + '…' : plantNm;
              return '<span data-tip="'+plantNm+'">'+ plant_name+' ( '+plantCd+' )</span> ';

            }
          },
          {  
            render: function (data, type, full, meta){
                   
                      var enableBtn = 'enable';
                      var deletebtn ='<a href="#" class="btn btn-warning btn-xs" title="edit" disabled><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dealerDelete('+full['CSPHID']+');" disabled><i class="fa fa-trash" title="Delete"></i></button>'; 

                      return deletebtn;
            }
        
          },

        ],

    });

    $('#example tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        console.log(tr);
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

  function showchildtable(tblid){

    var tblid;

    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });
             
    $("#minus"+tblid).toggleClass('fa-plus fa-minus rotate');

    $.ajax({

      url:"{{ url('transaction/ColdStorage/view-order-plan-chield-row-data') }}",

      method : "POST",

      type: "JSON",

      data: {tblid:tblid},

      success:function(data){

        var data1 = JSON.parse(data);
     
        if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      
        }else if(data1.response == 'success'){

          console.log('data1.data',data1.data);

            if(data1.data==''){
             
            }else{

                var objrow = data1.data;
                var srNo=1;
                var tableid = objrow[0].CSPHID;
                console.log('tableid',tableid);
                $.each(objrow, function (row, objrow) {
            
                    $('#childData_'+tableid).append('<tr><td class="text-center">'+srNo+'</td><td>'+objrow.CS_CODE+'[ '+objrow.CS_NAME+' ]</td><td>'+objrow.CHAMBER_CODE+'[ '+objrow.CHAMBER_NAME+' ]</td><td>'+objrow.FLOOR_CODE+'[ '+objrow.FLOOR_NAME+' ]</td><td>'+objrow.BLOCK_CODE+'[ '+objrow.BLOCK_CODE+' ]</td><td class="amtRight">'+objrow.QTY+'</td><td>'+objrow.UM+'</td></tr>');
                    srNo++;

                });

            }
          
        }
      }

    });
  }
</script>

@endsection