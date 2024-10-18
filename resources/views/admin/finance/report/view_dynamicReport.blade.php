@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style>
  .pdfbtncl{
    padding: 0px;
    padding-left: 4px;
    padding-right: 4px;
  }
  .rightAlignCl{
    text-align: right;
  }
  .modal-header .close {
    margin-top: -32px;
  }
  .headingS{
    color: #5696bb;
    text-align: center;
    font-weight: 800;
    font-size: 18px;
  }
</style>


  <div class="content-wrapper">

    <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>Dynamic Query <small>View Details</small></h1>

        <ol class="breadcrumb">

          <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

          <li><a href="{{ URL('/dashboard')}}">Master</a></li>

          <li class="Active"><a href="{{ URL('/report/dynamic-query')}}">Dynamic Query</a></li>

          <li class="Active"><a href="{{ URL('/Report/View-Dynamic-query-report')}}">View Dynamic Query</a></li>

        </ol>

    </section>
    <!-- Main content -->

    <section class="content">

      <div class="row">

        <div class="col-xs-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h3 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">View Dynamic Query</h3>

              <div class="box-tools pull-right">

                <a href="{{ url('/report/dynamic-query') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Dynamic Query</a>

              </div>

            </div><!-- /.box-header -->

            @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i>Success...!</h4>{!! session('alert-success') !!}

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

              <?php
                    $FromDate    = date("d-m-Y", strtotime($fromDate));  
                    $ToDate      = date("d-m-Y", strtotime($toDate));
              ?>

              <input type="hidden" id="from_DateFy" value="{{$FromDate}}">
              <input type="hidden" id="to_DateFy" value="{{$ToDate}}">

              <table id="viewDynamicQuery" class="table table-bordered table-striped table-hover">

                <thead>

                  <tr>

                    <th class="text-center">Sr.No.</th>
                    <th class="text-center">Trans</th>
                    <th class="text-center">Report Name</th>
                    <th class="text-center">From Date</th>
                    <th class="text-center">To Date</th>
                    <th class="text-center">Query</th>
                    <th class="text-center">Excel</th>

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

<!-- show modal for date change -->

 

<!-- show modal for date change -->

@include('admin.include.footer')

<script type="text/javascript">

  $(document).ready(function(){ 

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    var t = $("#viewDynamicQuery").DataTable({

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/Report/View-Dynamic-query-report') }}"

       },
       searching : true,
  
       columns: [
        
       
          { data:"DT_RowIndex",className:"text-center"},
          { data: "TRAN_HEAD" },
          { data: "REPORT_NAME" },
          { data: "FROM_DATE",
            className:'rightAlignCl',
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
          { data: "TO_DATE",
            className:'rightAlignCl',
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
          { data: "QUERY_NAME" },
          {
            render:function(data, type, full, meta){

              return '<button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return changeDate(\''+full['FROM_DATE']+'\',\''+full['TO_DATE']+'\','+full['ID']+','+full['DT_RowIndex']+');"><i class="fa fa-calendar"></i></button><div class="modal fade" id="showDateModl'+full['DT_RowIndex']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-md" role="document"><div class="modal-content" style="border-radius: 2px;"><div class="modal-header"><h3 class="modal-title headingS" id="exampleModalLabel">Change Query Date</h3><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-2"></div><div class="col-md-4"><div class="form-group"><label>From Date: <span class="required-field"></span></label><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="hidden" value="" id="tblHiddenId'+full['DT_RowIndex']+'"><input type="text" class="form-control transdatepicker" name="fromDate" id="from_Date'+full['DT_RowIndex']+'" value="" placeholder="Select From Date" autocomplete="off"></div></div></div><div class="col-md-4"><div class="form-group"><label>To Date: <span class="required-field"></span></label><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control transdatepicker" name="todate" id="to_date'+full['DT_RowIndex']+'" value="" placeholder="Select To Date" autocomplete="off"></div></div></div><div class="col-md-2"></div><input type="hidden" value="" id="prevSqlQuery'+full['DT_RowIndex']+'"></div></div><div class="modal-footer" style="text-align:center;"> <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button><button type="button" class="btn btn-sm btn-success" data-dismiss="modal" onclick="downloadExcel('+full['DT_RowIndex']+');">Download</button></div></div></div></div>';



            }
          }
        
      ],

    });

  });

  function changeDate(fromDate,toDate,tblId,srNo){
    $('#showDateModl'+srNo).modal('show');
    var frDate = fromDate.split('-');
    var fyear   = frDate[0];
    var fmonth  = frDate[1];
    var fdate   = frDate[2];

    var newFrDate = fdate+'-'+fmonth+'-'+fyear;

    var to_Date = toDate.split('-');
    var tyear   = to_Date[0];
    var tmonth  = to_Date[1];
    var tdate   = to_Date[2];

    var newToDate = tdate+'-'+tmonth+'-'+tyear;

    $('#from_Date'+srNo).val(newFrDate);
    $('#to_date'+srNo).val(newToDate);
    $('#tblHiddenId'+srNo).val(tblId);

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url:"{{ url('Report/get-dynamic-query-for-change') }}",
      method : "POST",
      type: "JSON",
      data: {tblId:tblId},
      success:function(data){
        var data1 = JSON.parse(data);
        if (data1.response == 'error') {

        }else if(data1.response == 'success'){
          var prvSqlQuery = data1.data_query[0].SQLQUERY;
          $('#prevSqlQuery'+srNo).val(prvSqlQuery);
        }
      }
    });
  }

  function downloadExcel(srNoId){

    var existingQuery = $('#prevSqlQuery'+srNoId).val();
    var frDate        = $('#from_Date'+srNoId).val();
    var toDate        = $('#to_date'+srNoId).val();
    var tableUniqId   = $('#tblHiddenId'+srNoId).val();
    var fromDate      = frDate.split('-');
    var newFrDate     = fromDate[2]+'-'+fromDate[1]+'-'+fromDate[0];

    var to_Date       = toDate.split('-');
    var newtoDate     = to_Date[2]+'-'+to_Date[1]+'-'+to_Date[0];

    var splitQuery    = existingQuery.split('(');
    var strOne        = splitQuery[0];
    var strTwo        = splitQuery[1];
    var splitQuery1   = strTwo.split('GROUP BY');
    var strThree      = splitQuery1[0];
    var strFour       = splitQuery1[1];
    var splitQuery2   = strThree.split('BETWEEN');
    var strFive       = splitQuery2[0];

    var dateString = "("+strFive+"BETWEEN '"+newFrDate+"' AND '"+newtoDate+"')";
    var newSqlQuery = strOne+dateString+" GROUP BY"+strFour;
   
    window.location.href = "{{ url('/viewpage-excel-donwload-dynamic-report/') }}"+'/'+newSqlQuery+'/'+newFrDate+'/'+newtoDate+'/'+tableUniqId;

  }



  
  $(document).ready(function(){
    var fromdateintrans = $('#from_DateFy').val();
    var todateintrans = $('#to_DateFy').val();

    $('body').on('focus',".transdatepicker", function(){
      $(this).datepicker({
          format: 'dd-mm-yyyy',
          orientation: 'bottom',
          todayHighlight: 'true',
          startDate :fromdateintrans,
          endDate : todateintrans,
          autoclose: 'true'
      });
    });
  });
</script>

@endsection