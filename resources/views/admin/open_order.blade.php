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

  .datebill{
     width: 90px;
     text-align: right;
  }
  .texIndbox{
    text-align: left !important;
  }
  .texIndboxright{
    text-align: right !important;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
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
</style>

  <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Open Order
           <!--  < ?php echo ucwords($form_name) ?>  -->

          <!--   <small><b>< ?php echo $form_number; ?></b></small> -->

             <small><b>Open Order Details</b></small> 

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Open Order</a></li>
          </ol>


        </section>



        <!-- Main content -->

        <section class="content">

          <div class="row">

            <div class="col-xs-12">
             
              <div class="box box-primary Custom-Box">

                <div class="box-header with-border" style="text-align: center;">

                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">View Open Order Status</h3>

                  <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Sales/Post-Good-Issue') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Open Order Status</a>

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

                        <th class="text-center">Item Code</th>

                        <th class="text-center">Item Name</th>

                        <th class="text-center">Order Qty</th>

                        <th class="text-center">Issued Qty</th>

                        <th class="text-center">Balance Qty</th>

                        <th class="text-center">Amount</th>

                        <th class="text-center">Status</th>

                      </tr>

                    </thead>

                    <tbody>

                    <?php $srno=1; $COUNT=COUNT($open_order); foreach ($open_order as $row) { 



                        $balenceQty = $row->OrderQty - $row->qtyIssued;
                        if($row->OrderQty == $row->qtyIssued){}else{
                      ?>
                      <tr>
                          <td align="center"><?= $COUNT; ?>{{ $row->ITEM_CODE }}</td>
                          <td align="center">{{ $row->ITEM_NAME }}</td>
                          <td align="center">{{ $row->OrderQty }}</td>
                          <td align="center">{{ $row->qtyIssued }}</td>
                          <td align="center">{{ $balenceQty }}</td>
                          <td align="center">{{ $row->DRAMT }}</td>
                          <td align="center"><small class="label label-danger"><i class="fa fa-clock-o"></i> Pending</small>&nbsp;<button type="button" id="ordrDetail<?php echo $srno; ?>" class="btn btn-xs btn-info gly-radius" data-toggle="modal" data-target="#openordrInfo_<?php echo $srno; ?>" onclick="showDetails(<?php echo $srno; ?>,<?php echo $row->SORDERHID; ?>,'<?php echo $row->ITEM_CODE; ?>');" data-original-title="" title=""> <i class="fa fa-info" aria-hidden="true"></i></button><div class="modal fade" id="openordrInfo_<?php echo $srno; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"><h5 class="modal-title modltitletext" id="exampleModalLabel">Party Details</h5></div></div></div><div class="modal-body table-responsive"><div class="boxer" id="detailBody_<?php echo $srno; ?>"></div><div class="modal-footer" style="text-align: center;"><button type="button" class="btn btn-primary" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Ok</button></div></div></div></div></div></td>
                         
                      </tr>

                    <?php } $srno++; } ?>
                </tbody>

                    

                  </table>

                  
                </div><!-- /.box-body -->
                  
              </div><!-- /.box -->

            </div><!-- /.col -->

          </div><!-- /.row -->

        </section><!-- /.content -->

      </div>



@include('admin.include.footer')

<script>
  
  function showDetails(rowId,headid,itemCd){
      
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

          url:"{{ url('Dashboard/Party-Details-Of-Open-Order') }}",

          method : "POST",

          type: "JSON",

          data: {headid: headid,itemCd:itemCd},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.data_ordrDetl == ''){

                  }else{

                    $('#detailBody_'+rowId).empty();
                    var TableHeadData =  "<div class='box-row'><div class='box10 rateIndbox' style='width:20%;'>ACC CODE</div><div class='box10 rateIndbox'style='width:20%;'>ITEM CODE</div><div class='box10 rateIndbox' style='width:12%;'>VRDATE</div><div class='box10 rateIndbox' style='width:12%;'>VRNO</div><div class='box10 rateIndbox' style='width:10%;'>ORDERQTY</div><div class='box10 rateIndbox' style='width:10%;'>ISSUEQTY</div><div class='box10 rateIndbox' style='width:10%;'>BALQTY</div></div>";
                    $('#detailBody_'+rowId).append(TableHeadData);

                    $.each(data1.data_ordrDetl, function(k, getData){

                      var balanceQty =  getData.OrderQty - getData.IssuedQty;

                       var fy_code = getData.FY_CODE.split('-');

                       var date = new Date(getData.VRDATE);
    var getdate =  ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + '-' + ((date.getMonth() > 8) ? (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '-' + date.getFullYear();


                        var bodyData = "<div class='box-row'><div class='box10 texIndbox'>"+getData.ACC_NAME+' ('+getData.ACC_CODE+')'+"</div><div class='box10 texIndbox'>"+getData.ITEM_CODE+' ('+getData.ITEM_NAME+')'+"</div><div class='box10 texIndbox' style='text-align: right !important;'>"+getdate+"</div><div class='box10 texIndbox'>"+fy_code[1]+' '+getData.SERIES_CODE+' '+getData.VRNO+"</div><div class='box10 texIndboxright' style='text-align:right;'>"+getData.OrderQty+"</div><div class='box10 texIndboxright'>"+getData.IssuedQty+"</div><div class='box10 texIndboxright'>"+balanceQty+"</div></div>"

                        $('#detailBody_'+rowId).append(bodyData);
                    });
                  }
                
              }

          }

    });

  } 

</script>

<script type="text/javascript">
$(function() {

   var date1 = new Date();
                var month = date1.getMonth() + 1;
                var tdate = date1.getDate();
                var mn    = month.toString().length > 1 ? month : "0" + month;
                var yr    = date1.getFullYear();
                var hr    = date1.getHours(); 
                var min   = date1.getMinutes();
                var sec   = date1.getSeconds(); 

                var curr_date = tdate+''+mn+''+yr;
                var curr_time = hr+':'+min+':'+sec;
$("#example").DataTable({
"scrollX": true,
Processing: true,
              serverSide: true,
              scrollX: false,
             // dom : 'Bfrtip',
             pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
              buttons: [
                        {
                        extend: 'excelHtml5',
                        title: 'open_order_'+curr_date+'_'+curr_time,
                        footer: true
                      }
                        ],



              columns: [

              
                {
                    data:'VRDATE',
                    className:'text-right',
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
                         
                    var seriesC = full['SERIES_CODE'];
                    var getFY   = full['FY_CODE'].split(" ");
                    var FYNEW   = getFY[0];
                    var VR      = full['VRNO'];

                    var VRNEW  = seriesC+' '+FYNEW+' '+VR;
                    var NEWACC = full['ACC_NAME']+' '+'['+full['ACC_CODE']+']';

                    return VRNEW;
                               
                  }  
                },
                
                {   
                  render: function (data, type, full, meta){
                    
                    var NEWACC = full['ACC_CODE']+' '+'['+full['ACC_NAME']+']';

                    return NEWACC;   
                  },
                },

                  {
                    data:'ITEM_CODE',
                    name:'ITEM_CODE',
                    className:'text-right'
                },

                  {
                    data:'ITEM_NAME',
                    name:'ITEM_NAME',
                    className:'text-right'
                },

                {
                    data:'ORDERQTY',
                    name:'ORDERQTY',
                    className:'text-right'
                },


                  {
                    data:'QTYISSUED',
                    name:'QTYISSUED',
                    className:'text-right'
                },

                {
                    data:'BALQTY',
                    name:'BALQTY',
                    className:'text-right'
                },

                {
                    data:'AMOUNT',
                    name:'AMOUNT',
                    className:'text-right'
                },



                {
                    data:'DRAMT',
                    name:'DRAMT',
                    className:'text-right'
                },
                
               
              ]
              



              






});

});
</script>
@endsection



