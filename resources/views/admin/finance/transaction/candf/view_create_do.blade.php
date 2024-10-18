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
   .tooltip{
      color: #66CCFF !important;
    }

  .PageTitle{
    margin-right: 1px !important;
  }

  .required-field::before {
    content: "*";
    color: red;
  }

  

  .secondSection{

    display: none;
  }

  .rightcontent{

  text-align:right;


}
.hidebtn{
display: none;
}

::placeholder {
  
  text-align:left;
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

  table.dataTable {
      clear: both;
      margin-top: 10px !important;
      margin-bottom: 6px !important;
      max-width: none !important;
  }
 
  @media screen and (max-width: 600px) {

  .PageTitle{

    float: left;

  }

}

.showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
}
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>View Delivery Order - Rake<small> : View Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

      <li class="active"><a href="{{ url('/transaction/c-and-f/view-create-delivery-order') }}">C and F</a></li>

      <li class="active"><a href="{{ url('/transaction/c-and-f/view-create-delivery-order') }}">View Delivery Order - Rake</a></li>

    </ol>

  </section>
<!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Delivery Order - Rake</h3>

            <div class="box-tools pull-right">

              <a href="{{ url('/transaction/c-and-f/create-delivery-order') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Delivery Order - Rake</a>

            </div>

          </div><!-- /.box-header -->

          @if(Session::has('alert-success'))

            <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-check"></i>Success...!

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

                  <th class="text-center">Rake No</th>
                  <th class="text-center">Rake Date</th>
                  <th class="text-center">Plant Code/Name</th>
                  <th class="text-center">CP Code/Name</th>
                  <th class="text-center">SP Code/Name</th>
                  <th class="text-center">To Place</th>
                  <th class="text-center">Delivery Order No.</th>
                  <th class="text-center">Qty</th>
                  <th class="text-center">UM</th>
                  <th class="text-center">TRPT Type</th>
                  <th class="text-center">TRPT Code/Name</th>

                </tr>

              </thead>

              <tbody>


              </tbody>

                <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot>

            </table>

          </div><!-- /.box-body -->

        </div><!-- /.box -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.content -->

</div>


@include('admin.include.footer')


<script type="text/javascript">
    $(document).ready(function(){

      $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

      });

      var date1 = new Date();
      var month = date1.getMonth() + 1;
      var tdate = date1.getDate();
      var mn = month.toString().length > 1 ? month : "0" + month;
      var yr = date1.getFullYear();
      var hr =  date1.getHours(); 
      var min = date1.getMinutes();
      var sec = date1.getSeconds(); 

      var curr_date = tdate+''+mn+''+yr;
      var curr_time = hr+':'+min+':'+sec;

      var t = $("#example").DataTable({

             footerCallback: function (row, data, start, end, display) {

              var api = this.api(), data;


     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var rowcount = data.length;
                  console.log('rowcount',rowcount);
                var getRow = rowcount-1;
                var opebal = api.column(7).data();

                console.log('opebal',opebal);
     

            

            var amountTotal = api
                .column(7)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

                  console.log('amountTotal',amountTotal);


                 $( api.column(0).footer() ).html('Total :-').css('text-align','right');
                 $( api.column(7).footer() ).html(amountTotal.toFixed(2)).css('text-align','right');

          
        },





        processing: true,
        serverSide:false,
        //scrollY:500,
        scrollX:true,
        paging: true,
        pageLength: 50,
        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
        buttons: [
                  {
                    extend: 'excelHtml5',
                    title: 'do_summary_list_'+curr_date+'_'+curr_time,
                    exportOptions: {
                        columns: [0,1,2,3,4,5,6,7,8,9]
                    }
                  }
                ],
        ajax:{

            url : "{{ url('/transaction/candf/list-off-delivery-order-rake') }}"

        },
        searching : true,
  
        columns: [
        
          { data: "RAKE_NO",className:"text-right"},
          {
              data:'RAKE_DATE',
              render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
              },
              className:"text-right"
          },
          
          {  
            render: function (data, type, full, meta){

                  var PLANTCODE = full['PLANT_CODE'];
                  var PLANTNAME = full['PLANT_NAME'];

                  return PLANTCODE+' - '+PLANTNAME;

            },
            className:"text-left"

          },
          {  
            render: function (data, type, full, meta){

                  var CPCODE = full['CP_CODE'];
                  var CPNAME = full['CP_NAME'];

                  return CPCODE+' - '+CPNAME;

            },
            className:"text-left"

          },
          {  
            render: function (data, type, full, meta){

                  var SPCODE = full['SP_CODE'];
                  var SPNAME = full['SP_NAME'];

                  return SPCODE+' - '+SPNAME;

            },
            className:"text-left"

          },
          { data: "TO_PLACE",className:"text-left"},
          { data: "ORDER_NO",className:"text-right"},
          { data: "QTY",className:"text-right"},
          {  
            render: function (data, type, full, meta){

               
                  var UM  = full['UM'];
                

                  return'<span class="label label-success">'+UM+'</span>';

            },
            className:"text-right"

          },
          {  
            render: function (data, type, full, meta){

                  var TRPTTYPE = full['TRPT_TYPE'];

                  return TRPTTYPE;

            },
            className:"text-left"

          },
          {  
            render: function (data, type, full, meta){

                  var TRPTCODE = full['TRPT_CODE'];
                  var TRPTNAME = full['TRPT_NAME'];

                  return TRPTCODE+' - '+TRPTNAME;

            },
            className:"text-left"

          },
          
              
        ],

      });

    });
</script>

<script type="text/javascript">

  function getID(cmpCd,fyCd,tranCd,sereisCd,vrNo){
    var fieldCol = cmpCd+'~'+fyCd+'~'+tranCd+'~'+sereisCd+'~'+vrNo;
    $("#vehicleEntryDelete").modal('show');
    $('#deletvehicle').val(fieldCol);

  }

</script>

@endsection