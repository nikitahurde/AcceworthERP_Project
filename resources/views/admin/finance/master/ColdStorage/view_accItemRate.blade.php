@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
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

  @media screen and (max-width: 600px) {
    .viewpagein{
      width: auto;
    }
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

</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>Account Item Rate Master<small>View Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Master</a></li>

      <li class="active"><a href="{{ url('/Master/ColdStorage/View-Acc-Item-Rate-Mast') }}">Master Account Item Rate</a></li>

      <li class="active"><a href="{{ url('/Master/ColdStorage/View-Acc-Item-Rate-Mast') }}">View Account Item Rate</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Account Item Rate</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/Master/ColdStorage/Add-Acc-Item-Rate-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Account Item Rate</a>

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

            <table id="example" class="table table-bordered table-striped table-hover">

              <thead>

                <tr>

                  <th>Account Name</th>
                  <th>Item Name</th>
                  <th>Packing Name</th>
                  <th>IP Rate</th>
                  <th>Seasonal Rate</th>
                  <th>Fixed Rate</th>
                  <th>Cold Storage</th>
                  <th>Chamber Name</th>
                  <th>Floor Name</th>
                  <th>Block Name</th>
                  <th>Action</th>

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

  <div class="modal fade" id="accItemRateDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancel</button>

          <form action="{{ url('/Master/ColdStorage/Delete-Account-Item-Rate') }}" method="post">

            @csrf

            <input type="hidden" name="accItemRateId" value="" id="accItemRateId">

            <input type="submit" value="Delete" class="btn btn-sm btn-danger" style="margin-top: -15%;">

          </form>

        </div>

      </div>

    </div>

  </div>

@include('admin.include.footer')

<script type="text/javascript">

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
                            columns: [0,1,2,3,4,5,6,7,8,9]
                      },
                      title: ' MASTER ACCOUNT ITEM RATE '+$("#headerexcelDt").val(),
                      filename: 'MASTER_ACCOUNT_ITEM_RATE'+$("#headerexcelDt").val(),
                    }
                  ],
      ajax:{

        url : "{{ url('/Master/ColdStorage/View-Acc-Item-Rate-Mast') }}"

      },
      searching : true,
  
      columns: [
      
          { data: "ACC_CODE",
            render: function (data, type, full, meta){
              var accName = full['ACC_NAME'];
              var acc_name = 'display' && accName.length > 10 ? accName.substr(0, 10) + '…' : accName;
              return '<span data-tip="'+accName+'">'+ acc_name+' ( '+full['ACC_CODE']+' )</span> ';
            }
          },
          { data: "ITEM_CODE",
            render: function (data, type, full, meta){
              var itemName = full['ITEM_NAME'];
              var item_name = 'display' && itemName.length > 10 ? itemName.substr(0, 10) + '…' : itemName;
              return '<span data-tip="'+itemName+'">'+ item_name+' ( '+full['ITEM_CODE']+' )</span> ';
            }
          },
          { data: "PACKING_CODE",
            render: function (data, type, full, meta){
              var pkgName = full['PACKING_NAME'];
              var pkg_name = 'display' && pkgName.length > 10 ? pkgName.substr(0, 10) + '…' : pkgName;
              return '<span data-tip="'+pkgName+'">'+ pkg_name+' ( '+full['PACKING_CODE']+' )</span> ';
            }
          },
          { data: "IP_RATE"},
          { data: "S_RATE"},
          { data: "F_RATE"},
          { data: "CS_CODE",
            render: function (data, type, full, meta){
              if(full['CS_CODE'] == null || full['CS_CODE'] == ''){
                return '----';
              }else{
                var csName = full['CS_NAME'];
                var cs_name = 'display' && csName.length > 10 ? csName.substr(0, 10) + '…' : csName;
                return '<span data-tip="'+csName+'">'+ cs_name+' ( '+full['CS_CODE']+' )</span> ';
              }
              
            }
          },
          { data: "CHAMBER_CODE",
            render: function (data, type, full, meta){

              if(full['CHAMBER_CODE'] == null || full['CHAMBER_CODE'] == ''){
                return '----';
              }else{
                var chamberName = full['CHAMBER_NAME'];
                var chamber_name = 'display' && chamberName.length > 10 ? chamberName.substr(0, 10) + '…' : chamberName;
                return '<span data-tip="'+chamberName+'">'+ chamber_name+' ( '+full['CHAMBER_CODE']+' )</span> ';
              }
              
            }
          },
          { data: "FLOOR_CODE",
            render: function (data, type, full, meta){

              if(full['CHAMBER_CODE'] == null || full['CHAMBER_CODE'] == ''){
                return '----';
              }else{
                var floorName = full['FLOOR_NAME'];
                var floor_name = 'display' && floorName.length > 10 ? floorName.substr(0, 10) + '…' : floorName;
                return '<span data-tip="'+floorName+'">'+ floor_name+' ( '+full['FLOOR_CODE']+' )</span> ';
              }
              
            }
          },
          { data: "BLOCK_CODE",
            render: function (data, type, full, meta){

              if(full['CHAMBER_CODE'] == null || full['CHAMBER_CODE'] == ''){
                return '----';
              }else{
                var blockName = full['BLOCK_NAME'];
                var block_name = 'display' && blockName.length > 10 ? blockName.substr(0, 10) + '…' : blockName;
                return '<span data-tip="'+blockName+'">'+ block_name+' ( '+full['BLOCK_CODE']+' )</span> ';
              }
             
            }
          },
          {  
            render: function (data, type, full, meta){

                var enableBtn = 'enable';
                var deletebtn ='<a href="Edit-Acc-Item-Rate-Mast/'+btoa(full['COMP_CODE'])+'/'+btoa(full['ACC_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['COMP_CODE']+'\',\''+full['ACC_CODE']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                     
                return deletebtn;

            }

          },

      ],

    });

  });
</script>

<script type="text/javascript">

  function getID(compCd,AccCd){
    $("#accItemRateDelete").modal('show');
    var uniqId = compCd+'~'+AccCd;
    $('#accItemRateId').val(uniqId);
  }

</script>

@endsection