@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')
<style type="text/css">

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

  .boxer {
    display: table;
    border-collapse: collapse;
  }
  .boxer .box-row {
    display: table-row;
  }
  .boxer .box-row:first-child {
    font-weight:bold;
  }
  .tabs {
     display: flex;
     flex-wrap: wrap;
     /*max-width: 700px;*/
     background: #efefef;
     box-shadow: 0 48px 80px -32px rgba(0, 0, 0, 0.25);
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

.btn {

    display: inline-block;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    padding: .375rem .75rem;
    font-size: 14px;
    line-height: 1.5;
    border-radius: .25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

.btn-success {

    color: #fff;
    background-color: #28a745;
    border-color: #28a745;

}

.btn-info {

    color: #fff;
    background-color: #04a9ff;
    border-color: #04a9ff;

}


.text-center{

  text-align: center;

}


.title{

    margin-top: 50px;
    margin-bottom: 20px;

}




.container{

    max-width: 1200px;
    margin: 0px auto;
    padding: 0px 15px;

}

.inputboxclr{

  border: 1px solid #d7d3d3;
}

.tdthtablebordr{
  border: 1px solid #00BB64;
}

input:focus{border:1px solid yellow;} 

.space{margin-bottom: 2px;}

.but{

    width:105px;
    background:#00BB64;
    border:1px solid #00BB64;
    height:40px;
    border-radius:3px;
    color:white;
    margin-top:10px;
    margin:0px 0px 0px 11px;
    font-size: 14px;

}

 .required-field::before {

    content: "*";

    color: red;

  }

.ref::before {

  color: navy;
  content: "Ch :";
}

.toalvaldesn{

    text-align: right;
    font-weight: 800;
    margin-top: 1%;
}

.credittotldesn{

    width: 277%;
    margin-left: -11%;
    text-align: end;
}

.debitcreditbox{

  width: 91px;
  text-align: end;
}

.tdsratebtn{
  margin-top: 24% !important;
  font-weight: 800 !important;
  font-size: 11px !important;

}
.viewbtnitem{
    padding-bottom: 0px;
    padding-top: 0px;
    font-size: 12px;
    margin-bottom: 4px;
}
.modltitletext{
  font-weight: 800;
  color: #5696bb;
  text-align: center;
  font-size: 16px;
}
.SetInCenter{

  margin-top: 18%;

}
.AddM{

  width: 24px;

}
.showdetail{
  display: none;

}
.showcodename{
  color: #5696bb;
    font-size: 13px;
    font-weight: 600;
}
.aplynotStatus{
  display: none;
}

.panel.with-nav-tabs .panel-heading{
    padding: 5px 5px 0 5px;
}
.panel.with-nav-tabs .nav-tabs{
  border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
  margin-bottom: -1px;
}

.with-nav-tabs.panel-info .nav-tabs > li > a,
.with-nav-tabs.panel-info .nav-tabs > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li > a:focus {
  color: #31708f;
}
.with-nav-tabs.panel-info .nav-tabs > .open > a,
.with-nav-tabs.panel-info .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-info .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-info .nav-tabs > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li > a:focus {
  color: #31708f;
  background-color: #bce8f1;
  border-color: transparent;
}
.with-nav-tabs.panel-info .nav-tabs > li.active > a,
.with-nav-tabs.panel-info .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.active > a:focus {
  color: #31708f;
  background-color: #fff;
  border-color: #bce8f1;
  border-bottom-color: transparent;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #d9edf7;
    border-color: #bce8f1;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #31708f;   
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #bce8f1;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #31708f;
}
.boxer {
  display: table;
  border-collapse: collapse;
}
.boxer .box-row {
  display: table-row;
}
.boxer .box-row:first-child {
  font-weight:bold;
}
.boxer .box10 {
  display: table-cell;
  vertical-align: top;
  border: 1px solid #ddd;
  padding: 5px;
}
.boxer .hidebordritm {
  display: table-cell;
  vertical-align: top;
  border: none;
  padding: 5px;
}
.center {
  text-align:center;
}
.right {
  float:right;
}
.texIndbox{
  width: 25%; 
  text-align: center;
}
 .texIndbox1{
  width: 5%; 
  text-align: center;
}
.rateIndbox{
  width: 15%;
  text-align: center;
}
.itmdetlheading{
  vertical-align: middle !important;
  text-align: center;
}
.rateBox{
  width: 20%;
  text-align: center;
}
.amountBox{
  width: 20%;
  text-align: center;
}
.inputtaxInd{
  background-color: white !important;
  border: none;
  text-align: center;
}
@media screen and (max-width: 600px) {

  .credittotldesn{

    width: 89px;
    margin-bottom: 5px;
    margin-left: -34%;
  }

  .totlsetinres{

    width: 130%;

  }

  .debitcreditbox{

    margin-top: 0%;

  }

  .rowClass{
    overflow-x: scroll;
  }

}

</style>


<style type="text/css">



  .Custom-Box {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .OperatorTd{
    width: 35px !important;
  }
  .ValuesTd{
    width: 50% !important;
  }

  .QueryTableTd{
    font-size: 14px !important;
    font-weight: 600 !important;
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

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

 }
 .rightcontent{

  text-align:right;


}

.modal-header .close {
    margin-top: -25px !important;
    margin-right: 2% !important;
}

::placeholder {
  
  text-align:left;
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
.sstblCls{
  display: inline-table;;
}
.rake_wagonRpCls{
  display: none;
}
.required-field::before {

    content: "*";

    color: red;

  }

</style>


<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>
           Rake Stock Summary
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/report/c_and_f/rake-report') }}">C And F</a></li>
            
            <li class="active"><a href="{{ url('/report/c_and_f/rake-stock-summary') }}"> Rake Stock Summary</a></li>

          </ol>

        </section>

<section class="content">

    <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Rake Stock Summary</h2>


        </div><!-- /.box-header -->

        <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

            <div class="row">
              <div class="col-md-4"></div>
                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Rake No :
                     <span class="required-field"></span>
                      </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input list="rakelist" id="rack_no" name="rack_no" class="form-control  pull-left" value="" placeholder="Select Rake No." autocomplete="off">


                          <datalist id="rakelist">

                            <?php foreach ($rake_list as $value): ?>

                              <option value="<?php echo $value->RAKE_NO;?>"data-xyz ="{{ $value->RAKE_NO }}">{{$value->RAKE_NO}}</option>
                              
                            <?php endforeach ?>
                          </datalist>

                      </div>

                      <small id="show_err_rakeno"></small>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

            </div><!-- /. 1st row -->

            <div class="row">            
                
                <div class="col-md-4"></div>
                <div class="col-md-4 text-center" style="margin-top: 9px;">

                  
                  <button type="button" style="padding: 1px;" class="btn btn-primary" id="ProceedBtnId">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                  <button type="button" style="padding: 1px;" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

                 </div>

                <div class="col-md-4" style="margin-top: 1%;"><small id="errmsg" style="font-weight:600;font-size: 12px;" ></small></div>
            </div>

          </div><!-- /.box-body -->

          <div class="box-body" style="margin-top: 1%;">

                <table id="rakeTable" class="table table-bordered table-striped table-hover" style="display:'';">
                  <thead class="theadC">

                    <tr>
                      <th class="text-center"width="11%">Rake Date</th>
                      <th class="text-center"width="11%">Wagon No</th>
                      <th class="text-center"width="11%">Qty Recd</th>
                      <th class="text-center"width="11%">Um</th>
                      <th class="text-center"width="11%">Aqty Recd</th>
                      <th class="text-center"width="11%">Aum</th>
                      <th class="text-center"width="11%">Qty Issued</th>
                      <th class="text-center"width="11%">Aqty Issued</th>
                      <th class="text-center"width="12%">Item Name</th>
                    </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                </table>

            </div><!-- /.box-body -->
           
    </div>

</section>

</div>

<input type="hidden" id="excelName" value="" />



  {{--**** Start : Quality Parameter Model ****--}}

    <div id="quaPdomModel_2">
         
    </div>


    {{--**** End : Quality Parameter Model ****--}}



@include('admin.include.footer')



 <script type="text/javascript">

  $(document).ready(function(){

      var d = new Date();
        var strDate = d.getDate() + "0" + (d.getMonth()+1) + "" + d.getFullYear();

        var time = d.getHours() + "" + d.getMinutes() + "" + d.getSeconds();

        $('#excelName').val(strDate+'_'+time);

        $( window ).on( "load", function() {

            var fromdateintrans = $('#FromDateFy').val();
            var todateintrans = $('#ToDateFy').val();

            $('#from_date').datepicker({

              format: 'dd-mm-yyyy',

              orientation: 'bottom',

              todayHighlight: 'true',

              startDate :fromdateintrans,

              endDate : todateintrans,

              autoclose: 'true'

            });

            $('#to_date').datepicker({

              format: 'dd-mm-yyyy',

              orientation: 'bottom',

              todayHighlight: 'true',

              startDate :fromdateintrans,

              endDate : todateintrans,

              autoclose: 'true'

            });

        });

  });




/* START : Load Data Table */

load_data_query()

  function load_data_query(rackNo=''){

      $('#rakeTable').DataTable({
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
        buttons:   [
                    {
                      extend: 'excelHtml5',
                      exportOptions: {
                            columns: [0,1,2,3,4,5,6,8]
                      },
                      
                      title: ' RACK STOCK SUMMARY'+$("#headerexcelDt").val(),
                      filename: 'RACK_STOCK_SUMMERY_'+$("#headerexcelDt").val(),
                    }
                  ],
          ajax:{
            url:'{{ url("/report/c_and_f/get-rake-stock-summary") }}',
            data: {rackNo:rackNo},
          },
          columns: [

            
            {
                data:'RAKE_DATE',
                className:'text-left',
                render: function (data) {
                    var date = new Date(data);
                    var month = date.getMonth() + 1;
                    if(data=='0000-00-00'){
                      return '00-00-0000';
                    }else{
                      
                    return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                    }
                },
                className:'text-left'
            },
            {
                data:'WAGON_NO',
                name:'WAGON_NO',
                className: "text-left"
            },
            {
                data:'QTYRECD',
                name:'QTYRECD',
                className: "text-right"
            },
            {
                data:'UM',
                name:'UM',
                className: "text-right"
            },
            {
                data:'AQTYRECD',
                name:'AQTYRECD',
                className: "text-right"
            },
             {
                data:'AUM',
                name:'AUM',
                className: "text-right"
            },
            {
                data:'QTYISSUED',
                name:'QTYISSUED',
                className: "text-right"
            },
            {
                data:'AQTYISSUED',
                name:'AQTYISSUED',
                className: "text-right"
            },
            {
                data:'ITEM_NAME',
                name:'ITEM_NAME',
                className: "text-left"
            },
         
          ]


      });


   }


/* END : Load Data Table */

  


$(document).ready(function() {

  /* ..........START : Search Button Click ......... */

  $('#ProceedBtnId').click(function(){
    
    var rackNo      =  $('#rack_no').val();
   

    if(rackNo!= ''){

        $('#ProceedBtnId').attr('disabled',true);
        $('#cust_no').attr('disabled',true);
        $('#item_code').attr('disabled',true);
        $('#wagon_no').attr('disabled',true);
        $('#rack_no').attr('disabled',true);
        $('#stock_summary').attr('disabled',true);

        $('#stocksumm_err').html('');

        $('#rakeTable').DataTable().destroy();
        $('#errmsg').html('');
        load_data_query(rackNo);

    }else{
        $('#rakeTable').DataTable().destroy();
        load_data_query();
    }
        

  });

  /* ..........END : Search Button Click ......... */


    $('#ResetId').click(function(){

      $('#tripPlanReportTbl').DataTable().destroy();

        $("#from_date").prop('readonly',false);
        $("#to_date").prop('readonly',false);        
        $("#cust_no").prop('readonly',false);
        $("#transpAgentId").prop('readonly',false);
        $("#from_place").prop('disabled',false);
        $("#to_place").prop('disabled',false);
     

    });
  

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