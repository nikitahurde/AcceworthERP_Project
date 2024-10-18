@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<!-- <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

        <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
        <script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script> -->


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

</style>


<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Delivery Order  
            <small><b> : Monthly Report Details</b></small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/report/logistic/do-pending/monthly-report') }}">Delivery Order</a></li>

            <li class="active"><a href="{{ url('/report/logistic/do-pending/monthly-report') }}">Delivery Order Monthly Report</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Delivery Order Monthly Report</h2>


            </div><!-- /.box-header -->

            <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

              <div class="row">
              
                <div class="col-md-2">

                    <div class="form-group">

                     <?php $FromDate= date("d-m-Y", strtotime($fyYear_info->FY_FROM_DATE));  
                        $ToDate= date("d-m-Y", strtotime($fyYear_info->FY_TO_DATE));   ?>
                      
                      <label for="exampleInputEmail1"> From Date :<span class="required-field"></span> </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="hidden" name="" value="{{$FromDate}}" id="FromDateFy">

                        <input type="hidden" name="" value="{{$ToDate}}" id="ToDateFy">
                       
                        <input type="text" name="from_date" id="from_date" class="form-control fromDatePc rightcontent" placeholder="Select Transaction Date" value="{{$FromDate}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_from_date">

                        

                      </small>

                    </div>

                </div>


                <div class="col-md-2">

                   <div class="form-group">

                      <label for="exampleInputEmail1"> To Date :<span class="required-field"></span> </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="text" name="to_date" id="to_date" class="form-control toDatePc rightcontent" placeholder="Select Transaction Date" value="{{$ToDate}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_to_date">

                      </small>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Consinee :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="consineeList" id="consineeId" name="consineeNmCo" class="form-control  pull-left" value="" placeholder="Select Consinee" autocomplete="off">


                          <datalist id="consineeList">

                            <?php foreach ($consinee_list as $value): ?>

                              <option value="<?php echo $value->ACC_CODE.'-'.$value->ACC_NAME; ?>"data-xyz ="{{ $value->ACC_NAME }}">{{ $value->ACC_CODE}} = {{$value->ACC_NAME}}</option>
                              
                            <?php endforeach ?>
                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>
<style>
  .frmToPlaceInp{
    width: 130% !important;
  }
  .toPlaceCol{
    margin-left:3% !important;
  }
</style>
                <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">From Place :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="fromPlace_list" id="from_place" name="from_place" class="form-control  pull-left frmToPlaceInp" value="" placeholder="Select From Place" autocomplete="off">


                          <datalist id="fromPlace_list">
                            <?php foreach ($city_list as $value): ?>

                              <option value="<?php echo $value->CITY_CODE.'-'.$value->CITY_NAME; ?> "data-xyz ="{{ $value->CITY_CODE }}">{{ $value->CITY_NAME}} = {{$value->CITY_CODE}}</option>
                              
                            <?php endforeach ?>
                           
                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="fromPlaceText"></div>

                     </small>

                     <small id="show_err_from_place"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

                <div class="col-md-2 toPlaceCol">

                    <div class="form-group">

                      <label for="exampleInputEmail1">To Place :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="toPlace_list" id="to_place" name="to_place" class="form-control  pull-left frmToPlaceInp" value="" placeholder="Select To Place" autocomplete="off">


                          <datalist id="toPlace_list">
                           <?php foreach ($city_list as $value): ?>

                              <option value="<?php echo $value->CITY_CODE.'-'.$value->CITY_NAME; ?>"data-xyz ="{{ $value->CITY_CODE }}">{{ $value->CITY_NAME}} = {{$value->CITY_CODE}}</option>
                              
                            <?php endforeach ?>
                            
                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="toPlaceText"></div>

                     </small>

                     <small id="show_err_to_place"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

              </div><!-- /.row -->

    <!-- -------------- Button Start --------- -->
              <div class="row">

              
                <div class="col-md-4"></div>
                <div class="col-md-4" style="margin-top: 1%;">

                    
                  <button type="button" class="btn btn-primary" id="ProceedBtnId">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                  <button type="button" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

                  <!-- <button type="button" class="btn btn-warning" name="searchdata" onclick="excelReportBtn('month')" disabled="" id="excelbtn">&nbsp;&nbsp;<i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;&nbsp;Excel&nbsp;&nbsp;</button> -->

                </div>

                <div class="col-md-4"></div>

              </div>

    <!-- -------------- Button End --------- -->

          </div><!-- /. 1st box-body -->



           <div class="box-body" style="margin-top: 1%;">

                <table id="doMonthlyReportTbl" class="table table-bordered table-striped table-hover">
                  <thead class="theadC">

                    <tr>
                      <th class="text-center">D.O. No.</th>
                      <th class="text-center">D.O. Date</th>
                      <th class="text-center">Account Name/Code</th>
                      <th class="text-center">Consinee Name/Code</th>
                      <th class="text-center">From Place</th>
                      <th class="text-center">To Place</th>
                      <th class="text-center">Item Name/Code</th>
                      <th class="text-center">Qty</th>
                                            
                    </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>
                 
                </table>

            </div><!-- /. 2nd box-body -->

          </div>

  </section>

</div>



@include('admin.include.footer')

<script type="text/javascript">

  
/*getQuaParData*/
  $(document).ready(function() {

    $('#lastUpdateValueId').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });

  
    var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker1').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date,
      autoclose: 'true'

    });

/* START : Load Data Table */

load_data_query();

function load_data_query(from_date= '', to_date='',Consinee='',from_place='',to_place=''){

      $('#doMonthlyReportTbl').DataTable({

          processing: true,
          serverSide: true,
          scrollX: true,
          pageLength:'25',
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
          buttons:  [
                     
                    ],
          ajax:{
            url:'{{ url("/get-data-delivery-order-monthly-report") }}',
            data: {from_date:from_date,to_date:to_date,Consinee:Consinee,from_place:from_place,to_place:to_place}
          },
          columns: [
            {
                data:'DORDER_NO',
                name:'DORDER_NO',
                className: "text-right"
               
            },
            {
                render: function (data, type, full, meta){
                  
                var vrdate = full['DORDER_DATE'];
              
                var getDt = vrdate.split('-');

                var yy = getDt[0];
                var mm = getDt[1];
                var dd = getDt[2];

                var vrDt =  dd +'-' + mm + '-'+yy;

                return vrDt;

              },
              className:"text-right"
                
            },
            
            {
                render: function (data, type, full, meta){
                  
                var acc_code = full['ACCCODE'];
                var acc_name = full['ACCNAME'];

                var acccode_name =  acc_name +' [ ' + acc_code +' ]';

                return acccode_name;

              },
              className:"text-left"
               
            },
            {
              render: function (data, type, full, meta){
                  
                var cp_code = full['CP_CODE'];
                var cp_name = full['CP_NAME'];

                var cp_full_name =  cp_name +' [ ' + cp_code + ' ] ';
                $("#PindReprtExl").prop('disabled',false);
                return cp_full_name;

              },
              className:"text-left"
               
            },
            {
                data:'FROM_PLACE',
                name:'FROM_PLACE',
                className: "text-left"
               
            },
            {
                data:'TO_PLACE',
                name:'TO_PLACE',
                className: "text-left"
               
            },
            {
              render: function (data, type, full, meta){
                  
                var item_code = full['ITEM_CODE'];
                var item_name = full['ITEM_NAME'];

                var itemode_name =  item_name +' [ ' + item_code + ' ] ';
               
                return itemode_name;

              },
              className:"text-left"
               
            },
            
            {
                render: function (data, type, full, meta){
                  
                  var qty = full['QTY'];
                  var um = full['UM'];

                  if(um==null){
                   var getUm = '';
                  }else{
                    var getUm = um;
                  }

                  var qty_um =  qty +' ' + getUm;
                 
                  return qty_um;

              },
                className: "text-right"
               
            }
            
            
          ]


      });


  }


/* END : Load Data Table */


/* ..........START : Search Button Click ......... */

    $('#ProceedBtnId').click(function(){

    var from_date   =  $('#from_date').val();

    var to_date     =  $('#to_date').val();
    
    var Consinee    =  $('#consineeId').val();
  
    var from_place  =  $('#from_place').val();

    var to_place    =  $('#to_place').val();

    console.log('from_date',from_date);
    console.log('to_date',to_date);
    console.log('Consinee',Consinee);
    console.log('from_place',from_place);
    console.log('to_place',to_place);
           
      $("#from_date").prop('readonly',true);
      $("#to_date").prop('readonly',true);        
      $("#consineeId").prop('readonly',true);
      $("#from_place").prop('disabled',true);
      $("#to_place").prop('disabled',true);

   
        if (from_date=='' || to_date=='' || Consinee=='' || from_place=='' || to_place=='') {

          if(from_date !=''){
            if(to_date==''){
              $('#show_err_to_date').html('Please select to date').css('color','red');
            return false;
            }else{
              $('#show_err_to_date').html('');
            }
          }
          
          if(to_date !=''){
            if(from_date ==''){
             $('#show_err_from_date').html('Please select from date').css('color','red');
            return false;
            }else{
              $('#show_err_from_date').html('');
            }
          }

          $('#doMonthlyReportTbl').DataTable().destroy();

          load_data_query(from_date,to_date,Consinee,from_place,to_place);

        }else{

          $('#doMonthlyReportTbl').DataTable().destroy();

          load_data_query();

        }


    });

/* ..........END : Search Button Click ......... */













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