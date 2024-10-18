@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
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

  .showSeletedName {
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
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
  .hideCol{
    display:none;
  }
  .dtvrDate{
    width:7%;
  }
  .dtVrno{
    width:10%;
  }
  .dtglName{
    width:15%;
  }
  .dtDrcrAmt{
    width:11%;
    text-align:right;
  }
  .dtAction{
    width:5%;
  }
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>Project Cost Analysis<small> View Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Master</a></li>

      <li class="active"><a href="{{ url('/report/c-and-f/gate-entry/panding-outward') }}">Project Cost Analysis</a></li>

      <li class="active"><a href="{{ url('/report/c-and-f/gate-entry/panding-outward') }}">View Project Cost Analysis</a></li>
    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> View Cost Analysis</h2>

        <div class="box-tools pull-right">

          <a href="{{ url('/Transaction/Account/Cash-Bank-Transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Cost Analysis</a>

        </div>
      </div>

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
           <div class="row" >

            <div class="col-md-12">
            <table id="example" class="table table-bordered table-striped table-hover" style="width: 100%">
              <thead>
                        <th class="text-center">Project Code</th>
        				<th class="text-center">Project Name</th>
        				<th class="text-center">Wbs Code</th>
        				<th class="text-center">Wbs Name</th>
        				<th class="text-center">Budget Amount</th>
        				<th class="text-center">Actual Amount</th>
                <th class="text-center">Balance Amount</th>
        				   
              </thead>
              <tbody>
                
                <tr>
                


                </tr>
                
              </tbody>
            </table>
              
            
              
            </div>
            </div>

          </div><!-- /.box-body -->

        </div><!-- /.box -->

      </div><!-- /.col -->

    </div><!-- /.row -->

  </section><!-- /.content -->

</div>



  

<input type="hidden" id="excelName" value="" />



  {{--**** Start : Quality Parameter Model ****--}}

    <div id="quaPdomModel_2">
         
    </div>


    {{--**** End : Quality Parameter Model ****--}}



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
      var mn    = month.toString().length > 1 ? month : "0" + month;
      var yr    = date1.getFullYear();
      var hr    = date1.getHours(); 
      var min   = date1.getMinutes();
      var sec   = date1.getSeconds(); 

      var curr_date = tdate+''+mn+''+yr;
      var curr_time = hr+':'+min+':'+sec;

      
      var t = $("#example").DataTable({
        footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;

            // converting to interger to find total
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            var rowcount = data.length;

             if(rowcount > 0){

               $('.buttons-excel').attr('disabled',false);

            }else{

               $('.buttons-excel').attr('disabled',true);
            }
        },

        processing: true,
        serverSide:false,
        scrollX:true,
        paging: true,
        pageLength: 100,
        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
        buttons: [
                  {
                    extend: 'excelHtml5',
                    title: 'Project_Budget'
                    
                  }
                ],
        ajax:{

            url : "{{ url('report/infrastructure/project-budget-report') }}"

        },
        searching : true,
  
        columns: [
                 {data:'PROJECT_CODE'},
                 {data:'PROJECT_NAME'},
                 {data:'WBS_CODE'},
                 {data:'WBS_NAME'},
                 {data:'BUDGET_AMOUNT'},
                 {data:'DRAMT'},
                 {
                    className: "text-right",
                    render: function (data, type, full, meta){
                  
                      var budgetamount = full['BUDGET_AMOUNT'];
                      var dramt = full['DRAMT'];
                      return budgetamount - dramt;
                    }     
                }
                  
                  
        
        ],

      });

    });

 
 $(document).ready(function() {


/* ..........START : Search Button Click ......... */

$('#ProceedBtnId').click(function(){
  
  var rack_no   =  $('#rack_no').val();
  var acc_code  =  $('#acc_code').val();
  var custno    =  $('#cust_no').val();
  var itemcode  =  $('#item_code').val();
  var to_place  =  $('#to_place').val();

  var splitAcc = acc_code.split('-');
  var acc_code = splitAcc[0];
  
  var splitecust = custno.split('-');
  var cust_no = splitecust[0];
  
  var splitItem = itemcode.split('-');
  var item_code = splitItem[0];

  var splitToPlace = to_place.split('-');
  var toPlace = splitToPlace[0];
  var blankData = '';

 $('#rack_no').prop('disabled',true);
 $('#acc_code').prop('disabled',true);
 $('#cust_no').prop('disabled',true);
 $('#item_code').prop('disabled',true);
 $('#to_place').prop('disabled',true);
 $('#ProceedBtnId').prop('disabled',true);



  if(rack_no != '' || acc_code !='' || cust_no != '' || item_code != '' || toPlace != '' ){

      load_data_query(blankData,rack_no,acc_code,cust_no,item_code,toPlace);

  }else{
    load_data_query();
 }


});

/* ..........END : Search Button Click ......... */


   
  

});


$(document).ready(function() {

  jQuery.extend(jQuery.expr[':'], {
    focusable: function (el, index, selector) {
        return $(el).is('a, button, :input, [tabindex]');
    }
});

$(document).on('keypress', 'input,select', function (e) {
    if (e.which == 13) {
        e.preventDefault();
        // Get all focusable elements on the page
        var $canfocus = $(':focusable');
        var index = $canfocus.index(document.activeElement) + 1;
        if (index >= $canfocus.length) index = 0;
        $canfocus.eq(index).focus();
    }
});

});
           


  



  


</script>

@endsection