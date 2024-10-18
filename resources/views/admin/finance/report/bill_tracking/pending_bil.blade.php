@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">
  
  .alignLeftClass{
    text-align: left;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .hideshwTbl{
    display: none;
  }
  .widthcolumn{
    width: 15%;
  }
  .amtfield{
    width: 15%;
    text-align: right;
  }
  #resp-table {
      width: 100%;
      display: table;
  }
  .resp-table-body{
      display: table-row-group;
  }
  .resp-table-row{
      display: table-row;
  }
  .table-body-cell{
      display: table-cell;
      border: 1px solid #dddddd;
      padding: 8px;
      line-height: 1.42857143;
      vertical-align: top;
  }
  .hideshowcard{
    display: none;
  }
  .headingLable{
    font-size: 14px;
    color: #3c8dbc;
    font-weight: 700;
  }
  .lableHS{
    display: none;
  }
  .modltitletext {
    text-align: center;
    font-weight: 700;
    color: #5696bb;
}
</style>


<div class="content-wrapper">

  <section class="content-header">

    <h1>Pending Bills<small>View Details</small></h1>

      <ol class="breadcrumb">

        <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

        <li><a href="{{ url('/dashboard') }}">Master</a></li>

        <li class="active"><a href="{{ url('/Master/General-Ledger/View-Glsch') }}">Master GLSCH</a></li>

        <li class="active"><a href="{{ url('/Master/General-Ledger/View-Glsch') }}">View GLSCH</a></li>

      </ol>
  </section>
<!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

            <table id="custVenData" class="table table-bordered table-striped table-hover">

              <thead>

                <tr>
                  <th class="text-center">Code/Name</th>
                  <th class="text-center">Dr Amount</th>
                  <th class="text-center">Allocation</th>
                </tr>

              </thead>
              <tbody>
                  <tr>

                    <td><?php echo $pendingBil[0]->ACC_CODE;?> - <?php echo $pendingBil[0]->ACC_NAME;?> <input type="hidden" id="accCode" value="{{$pendingBil[0]->ACC_CODE}} - {{$pendingBil[0]->ACC_NAME}}"></td>
                    <td><?php echo $pendingBil[0]->DRAMT;?><input type="hidden" id="drAmnt" value="{{$pendingBil[0]->DRAMT}}"></td>
                    <td><button type="button" class="btn btn-primary btn-xs viewBilTrak" id="ViewBillTrack" data-toggle="modal" data-target="#ViewBT_Detail" onclick="detailBillTrack()">Bill Track </button></td>
                  </tr>
              </tbody>
            </table>

          </div>

        </div><!-- /.box -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.content -->

</div>

<!-- show modal when click modal -->

  <div class="modal fade" id="ViewBT_Detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

          <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">

            <div class="modal-content" style="border-radius: 5px;">

              <div class="modal-header">

                <div class="row">
                      
                  <div class="col-md-12">
                    <h4 class="modal-title modltitletext" id="exampleModalLabel">Bill Tracking</h4>
                  </div>


                </div>

              </div>
              <div style="margin-top: 17px;text-align: center;">
                <small class="headstyle"> Party Name : </small> <small class="datastyle" id="partyName" style="margin-right: 5%;"></small>
                <small class="headstyle">Date:</small> <small class="datastyle" id="dateBT"></small>
              </div>
              <div class="modal-body table-responsive">
                <div id="noBillTrkFMsg1"></div>
                <div class="boxer" id="biltrkBody1">

                  
                
                  
                </div>
              </div>


              <div class="modal-footer" style="text-align: center;">
               
                <button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;" id="bilTrackSaveBtn1" onclick="saveBillTrack(1);">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;" onclick="cancleBillTrack(1)">Cancle</button>

              </div>

            </div>

          </div>

        </div>

<!-- show modal when click modal -->

@include('admin.include.footer')

<script type="text/javascript">

  function detailBillTrack(){

    $("#ViewBT_Detail").modal({
      show:false,
      backdrop:'static',
    });

    var accCode   = $('#accCode').val();
    var drAmnt    = $('#drAmnt').val();
    var today     = new Date();
    var toDate    = today.getDate();
    var toMonth   = today.getMonth() + 1;
    var toyear    = today.getFullYear();
    var todayDate = toDate+'-'+toMonth+'-'+toyear;

    $('#partyName').html(accCode);
    $('#dateBT').html(todayDate);

    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });



  }
    

</script>

@endsection

