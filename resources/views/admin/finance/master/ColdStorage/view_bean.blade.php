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

</style>

<div class="content-wrapper">

  <section class="content-header">

    <h1>Bean Master<small>View Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Master</a></li>

      <li class="active"><a href="{{ url('/Master/ColdStorage/View-Bing-storage-Mast') }}">Master Bean</a></li>

      <li class="active"><a href="{{ url('/Master/ColdStorage/View-Bing-storage-Mast') }}">View Bean</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Bean</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/Master/ColdStorage/Bing-storage-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Bean</a>

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

                  <th>Cold Storage Code </th>
                  <th>Cold Storage Name</th>
                  <th>Chamber Code</th>
                  <th>Chamber Name</th>
                  <th>Floor Code</th>
                  <th>Floor Name</th>
                  <th>Block Code </th>
                  <th>Block Name </th>
                  <th>Bean Code</th>
                  <th>Bean Name</th>
                  <th>Capacity</th>
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

  <div class="modal fade" id="beanDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

          <form action="{{ url('/Master/ColdStorage/Delete-Bing-storage') }}" method="post">

            @csrf

            <input type="hidden" name="beanId" value="" id="beanId">

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
                            columns: [0,1,2,3,4,5,6,7,8,9,10]
                      },
                      title: ' MASTER BEAN'+$("#headerexcelDt").val(),
                      filename: 'MASTER_BEAN_'+$("#headerexcelDt").val(),
                    }
                  ],
      ajax:{

        url : "{{ url('/Master/ColdStorage/View-Bing-storage-Mast') }}"

      },
      searching : true,
  
      columns: [
      
          { data: "CS_CODE"},
          { data: "CS_NAME"},
          { data: "CHAMBER_CODE"},
          { data: "CHAMBER_NAME"},
          { data: "FLOOR_CODE"},
          { data: "FLOOR_NAME"},
          { data: "BLOCK_CODE"},
          { data: "BLOCK_NAME"},
          { data: "BEAN_CODE"},
          { data: "BEAN_NAME"},
          { data: "STORAGE_CAPACITY",className:"text-right"},
          {  
            render: function (data, type, full, meta){

                var enableBtn = 'enable';
                var deletebtn ='<a href="Edit-Bing-storage-Mast/'+btoa(full['COMP_CODE'])+'/'+btoa(full['CS_CODE'])+'/'+btoa(full['CHAMBER_CODE'])+'/'+btoa(full['FLOOR_CODE'])+'/'+btoa(full['BLOCK_CODE'])+'/'+btoa(full['BEAN_CODE'])+'" class="btn btn-warning btn-xs actionBTN" title="edit"><i class="fa fa-pencil" title="Edit"></i></a> | <button class="btn btn-danger btn-xs actionBTN" data-toggle="modal" onclick="return getID(\''+full['COMP_CODE']+'\',\''+full['CS_CODE']+'\',\''+full['CHAMBER_CODE']+'\',\''+full['FLOOR_CODE']+'\',\''+full['BLOCK_CODE']+'\',\''+full['BEAN_CODE']+'\');"><i class="fa fa-trash" title="Delete"></i></button>';
                     
                return deletebtn;

            },className:"text-center"

          },

      ],

    });

  });
</script>

<script type="text/javascript">

  function getID(compCd,csCd,chamberCd,floorCd,blockCd,beanCd){
    $("#beanDelete").modal('show');
    var uniqueID = compCd+'~'+csCd+'~'+chamberCd+'~'+floorCd+'~'+blockCd+'~'+beanCd;
    $('#beanId').val(uniqueID);
  }

</script>

@endsection