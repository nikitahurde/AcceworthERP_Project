@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')



<style type="text/css">

  .amountfl{

    text-align: right;

  }

  .textfl{

    text-align: left;

  }

  .showSeletedName{

     font-size: 12px;
     margin-top: 1.2%;
     margin-bottom: 3%;
     text-align: center;
     font-weight: 600;
     color: #4f90b5;
     text-transform: capitalize;
     text-align: center;

  }
  .modal-header .close {
    margin-top: -32px;
}

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
  .label-success {
    background-color: #00a65a !important;
    padding: 2px;
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

</style>







  <div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">


          <h1>


            Pending EPOD - Trips/LR



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li class="Active"><a href="{{ URL('/Dashboard/Trips-status')}}">Pending EPOD - Trips/LR</a></li>



            <li class="Active"><a href="{{ URL('/Dashboard/Trips-status')}}">View Pending EPOD - Trips/LR</a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Pending EPOD - Trips/LR </h3>



                  <div class="box-tools pull-right">



                    <a href="{{ url('/Dashboard/Trips-status') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Go  Back</a>



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

                        <!-- <th>Sr.No</th> -->
                        <th class="text-center" width="5%">DO Date</th>
                        <th class="text-center" width="5%">DO No.</th>
                        <th class="text-center" width="5%">LR No </th>
                        <th class="text-center" width="5%">LR Date</th>
                        <th class="text-center" width="7%">Vehical No.</th>
                        <th class="text-center" width="5%">Consignee Code</th>
                        <th class="text-center" width="10%">Consignee Name</th>
                        <th class="text-center" width="5%">Item Code</th>
                        <th class="text-center" width="10%">Item Name</th>
                        <th class="text-center" width="5%">Qty</th>
                        <th class="text-center" width="5%">UM</th>
                        <th class="text-center" width="5%">Account Code </th>
                        <th class="text-center" width="10%">Account Name </th>
                        <th class="text-center" width="5%">Action </th>

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







@include('admin.include.footer')

<script type="text/javascript">

$(function() {

   var date1 = new Date();
   var month = date1.getMonth() + 1;
   var tdate = date1.getDate();
   var mn    = month.toString().length > 1 ? month : "0" + month;
   var yr    = date1.getFullYear();
   var hr    =  date1.getHours(); 
   var min   = date1.getMinutes();
   var sec   = date1.getSeconds(); 
   
   var curr_date = tdate+''+mn+''+yr;
   var curr_time = hr+':'+min+':'+sec;
  $("#example").DataTable({

  footerCallback: function ( row, data, start, end, display ) {
        
       var rowcount = data.length;

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
   pageing: true,
   pageLength:'50',
   dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-2'l><'col-sm-2'i><'col-sm-8'p>>",
      
   buttons: [
                {
                  extend: 'excelHtml5',
                  exportOptions: {
                                columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13]
                  },
                  title: 'EPOD_PENDING_'+$("#headerexcelDt").val(),
                  filename: 'EPOD_PENDING_'+$("#headerexcelDt").val(),
                  footer: true
                }
    ],

  ajax:{
        url:'{{ url("/Trips/epod-status") }}',
       
  },

  columns: [

   {    
        data :'DO_DATE',
        render: function (data, type, full, meta) {

          var extDate = full['DO_DATE'];
          
          var extArr  = extDate.split('-');
          
          var year    =  extArr[0];
          var month   =  extArr[1];
          var mdate   =  extArr[2];

          return mdate+'-'+month+'-'+year;

      },className:'text-right'
    },
   {data:'DO_NUMBER',
    render : function (data, type, full, meta){
            var do_no =  full['DO_NUMBER']!= null  ?  full['DO_NUMBER'] : '----';
            return do_no;
    },className:'text-right'
   },
   {data:'LR_NO'},
   { 
        data :'LR_DATE',
        render: function (data, type, full, meta) {

        var extDate = full['LR_DATE'];
        
        var extArr  = extDate.split('-');
        
        var year    =  extArr[0];
        var month   =  extArr[1];
        var mdate   =  extArr[2];

        return mdate+'-'+month+'-'+year;

      },className:'text-right'
    },
   {data:'VEHICLE_NO'},
   {data:'CP_CODE'},
   {data:'CP_NAME'},
   {data:'ITEM_CODE'},
   {data:'ITEM_NAME'},
   {data:'QTY',
     render : function (data, type, full, meta){
           var qty =  full['QTY'];

            if(qty!= '' &&  qty!= null ){
              return qty;
            }else{
              return '---';
            }


            
    },
   },
   {data:'UM',
     render : function (data, type, full, meta){
            var um =  full['UM'];
            
            if(um!= '' && um!= null ){
              return um;
            }else{
              return '--';
            }


            
    },
   },
   {data:'ACC_CODE'},
   {data:'ACC_NAME'},
   { render : function (data, type, full, meta){
      return '<span class="label label-danger">Pending</span>';
      },
   },

  ],
     


});

});

</script>



@endsection







