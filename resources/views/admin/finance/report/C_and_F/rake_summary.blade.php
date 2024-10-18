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

</style>


<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

           Rake Summary
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">C and F</a></li>
            
            <li class="active"><a href="{{ url('report/c_and_f/rake-report') }}"> Rake Summary</a></li>

          </ol>

        </section>

<section class="content">

    <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Rake Summary</h2>


        </div><!-- /.box-header -->

        <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

            <div class="row">

                <!-- <div class="col-md-4"></div> -->

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Rake Summary  <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="stock_list" id="stock_summary" name="stock_summary" class="form-control  pull-left" value="" placeholder="Select Rake Summary" autocomplete="off">


                          <datalist id="stock_list">
                           
                           <option value="SS1-RAKE WAGON CONSIGNEE WISE" data-xyz ="SS1">RAKE WAGON CONSIGNEE WISE SUMMARY</option>
                           <option value="SS2-RAKE WAGON WISE COUNT OF CONSIGNEE" data-xyz ="SS2">RAKE – WAGON WISE COUNT OF CONSIGNEE</option>
                           
                           
                          </datalist>

                      </div>

                      <small id="stocksumm_err"></small>

                      <small>  

                        <div class="pull-left showSeletedName" id="fromPlaceText"></div>

                     </small>

                     <small id="show_err_from_place"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Rake No :</label>

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

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Wagon No :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                           <input list="wagonlist" id="wagon_no" name="wagon_no" class="form-control  pull-left" value="" placeholder="Select Wagon No." autocomplete="off">


                          <datalist id="wagonlist">

                            <?php foreach ($wagon_list as $value): ?>

                              <option value="<?php echo $value->WAGON_NO;?>"data-xyz ="{{ $value->WAGON_NO }}">{{$value->WAGON_NO}}</option>
                              
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


                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Consinee :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="custList" id="cust_no" name="cust_no" class="form-control  pull-left" value="" placeholder="Select Consignee" autocomplete="off">


                          <datalist id="custList">

                            <?php foreach ($trip_list as $value): ?>

                              <option value="<?php echo $value->CP_CODE.'-'.$value->CP_NAME; ?>"data-xyz ="{{ $value->CP_NAME }}">{{ $value->CP_CODE}} = {{$value->CP_NAME}}</option>
                              
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

            </div><!-- /. 1st row -->

            <div class="row">
              <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Item :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="itemlist" id="item_code" name="item_code" class="form-control  pull-left" value="" placeholder="Select Item" autocomplete="off">


                          <datalist id="itemlist">

                            <?php foreach ($item_list as $value): ?>

                              <option value="<?php echo $value->ITEM_CODE.'-'.$value->ITEM_NAME; ?>"data-xyz ="{{ $value->ITEM_NAME }}">{{ $value->ITEM_CODE}} = {{$value->ITEM_NAME}}</option>
                              
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

                <div class="col-md-4 text-center" style="margin-top: 9px;">

                  
                  <button type="button" style="padding: 1px;" class="btn btn-primary" id="ProceedBtnId">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                  <button type="button" style="padding: 1px;" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

                 </div>

                <div class="col-md-4" style="margin-top: 1%;"><small id="errmsg" style="font-weight:600;font-size: 12px;" ></small></div>
            </div>

          </div><!-- /.box-body -->

        	<div class="box-body" style="margin-top: 1%;">

                <table id="stockSummaryRtTbl" class="table table-bordered table-striped table-hover" style="display:'';width: 100%">
                  <thead class="theadC">

                    <tr>
                      <th class="text-center" width="5%" id="thRakeNo"></th>
                      <th class="text-center" width="15%" id="thRakeNo">Account Name/Code</th>
                      <th class="text-center" width="5%" id="thRakeNo">Rake No</th>
                      <th class="text-center" width="5%" id="">Rake Date</th>
                      <th class="text-center" width="7%" id="">Placement Date</th>
                      <th class="text-center" width="25%">Consignee</th>
                      <th class="text-center" width="10%">Count Wagon No</th>
                      <th class="text-center" width="9%">Qty</th>
                      <th class="text-center" width="9%">Average Qty</th>
                     
                    </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                  <tfoot align="right">
                    <tr>
                     <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot>
                 
                </table>

                <table id="rakeWagonRtTbl" class="table table-bordered table-striped table-hover " style="display:none;width: 100%">
                  <thead class="theadC">

                    <tr>
                      <th class="text-center" width="3%" id="thRakeNo">#</th>
                      <th class="text-center" width="15%" id="thRakeNo">Account Name/Code</th>
                      <th class="text-center" width="10%" id="thRakeNo">Rake No</th>
                      <th class="text-center" width="5%" id="">Rake Date</th>
                      <th class="text-center" width="5%" id="">Placement Date</th>
                      <th class="text-center" width="10%" id=""> Wagon No</th>
                      <th class="text-center" width="10%" >Consignee Count</th>
                    </tr>

                  </thead>

                  <tbody id="defualtSearch">

                  </tbody>

                  <tfoot align="right">
                    <tr>
                      <th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                  </tfoot>
                 
                </table>

            </div><!-- /.box-body -->
           
    </div>

</section>

</div>

<input type="hidden" id="excelName" value="" />



  <!-- Start : Quality Parameter Model ****-->

    <div id="quaPdomModel_2">
         
    </div>
  

  <!----**** End : Quality Parameter Model ****-->



@include('admin.include.footer')



 <script type="text/javascript">

 function plusBtnClick(getId){
  
   var rakecpcode = $('.cpcode_'+getId).val();
   var cust_no = $('#cust_no').val();
   var r_no = $('.rakeno_'+getId).val();
   var rakeno = $('#rack_no').val();
   var rakeno1 = $('.rakeno1_'+getId).val();
   var rakewagonno = $('.wagonno_'+getId).val();
   var wagonno = $('#wagon_no').val();
   // console.log('getId',getId);
   console.log('rakecpcode',rakecpcode);

   var splitecust = cust_no.split('-');
   var rake_cpcode = splitecust[0];

   // console.log('r_no',r_no);
   
   $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $("#minus"+getId).toggleClass('fa-plus fa-minus rotate');

    $.ajax({

       url:"{{ url('/view-rake-detail-consignee-wise') }}",

               method : "POST",

               type: "JSON",

               data: {rake_cpcode:rake_cpcode,rakeno:rakeno,rakeno1:rakeno1,wagonno:wagonno,rakecpcode:rakecpcode,r_no:r_no},

               success:function(data){

                var data1 = JSON.parse(data);
                
                
                if (data1.response == 'success') {

                  if(data1.data=='' ){

                       console.log('blank');
                  }else{

                    var objrow = data1.data;

                    console.log('objrow',objrow);
                   

                    if(objrow){
                      $.each(objrow, function (i, objrow){

                        var remark = objrow.REMARK != null ?  objrow.REMARK : '----';

                        $('#tabOne'+rakecpcode).after('<tr><td class="text-left">'+objrow.wagon_no+'</td><td class="text-left">'+objrow.BATCH_NO+'</td><td class="text-left">'+objrow.ITEM_NAME+' [ '+objrow.ITEM_CODE+' ]</td><td class="text-left">'+remark+'</td><td class="text-right">'+objrow.qty+'</td><td class="text-right">'+objrow.totalQty+'</td></tr>');

                     });

                    }else{

                    }

                   
                  }
                }

               }
    });


  }

  function plusWagonClick(getId){
  
   var rakeno1 = $('.rakeno1_'+getId).val();
   var wagonno = $('.wagonno_'+getId).val();
   // console.log('wagonno',wagonno);
   // console.log('rakeno1',rakeno1);
   
   $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $("#minus"+getId).toggleClass('fa-plus fa-minus rotate');

    $.ajax({

       url:"{{ url('/view-consignee-detail') }}",

               method : "POST",

               type: "JSON",

               data: {rakeno1:rakeno1,wagonno:wagonno},

               success:function(data){

                var data1 = JSON.parse(data);
                console.log('data1',data1);
                
                
                if (data1.response == 'success') {

                  if(data1.data=='' ){

                       console.log('blank');
                  }else{

                    var objrow = data1.data;
                   

                    if(objrow){
                      $.each(objrow, function (i, objrow){

                        $('#tab_One'+wagonno).after('<tr><td class="text-left">'+objrow.cp_code+'</td><td class="text-left">'+objrow.cp_name+'</td><td class="text-right">'+objrow.qty+'</td><td class="text-right">'+objrow.aqty+'</td></tr>');

                     });

                    }else{

                    }

                   
                  }
                }

               }
    });


  }



	$(document).ready(function(){

	    var d = new Date();
        var strDate = d.getDate() + "0" + (d.getMonth()+1) + "" + d.getFullYear();

        var time = d.getHours() + "" + d.getMinutes() + "" + d.getSeconds();

        $('#excelName').val(strDate+'_'+time);

        $( window ).on( "load", function() {

          $('#stock_summary_modal').modal('show');

          var fromdateintrans = $('#FromDateFy').val();
          var todateintrans = $('#ToDateFy').val();

          $('.fromDatePc').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });

          $('.toDatePc').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });

        });

	});


  function format(d) {
    uniqTblID = d.CP_CODE;
    return '<div id="childData_'+uniqTblID+'" class="chieldTable">'+
            '<div class="nav-tabs-custom">'+
              '<ul class="nav nav-tabs" style="background-color: #ebe7db;height: 32px;">'+
                '<li class="active"><a href="#tab1_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="true">Details</a></li>'+
              '</ul>'+

              '<div class="tab-content">'+

                  '<div class="tab-pane active tabTable" id="tab1_'+uniqTblID+'">'+
                    '<table class="table-border" style="width: 100%;">'+
                      '<tr id="tabOne'+uniqTblID+'">'+
                        '<th class="text-center">Wagon No.</th>'+
                        '<th class="text-center">Batch No.</th>'+
                        '<th class="text-center">Item</th>'+
                        '<th class="text-center">Item Description</th>'+
                        '<th class="text-center">Qty</th>'+
                        '<th class="text-center">A Qty</th>'+
                      '</tr>'+

                    '</table>'+
                  '</div>'+
  
              '</div>'+
            '</div>'+
          '</div>';

  }

   function format1(d) {
    uniqTblID = d.WAGON_NO;
    return '<div id="childData1_'+uniqTblID+'" class="chieldTable">'+
            '<div class="nav-tabs-custom">'+
              '<ul class="nav nav-tabs" style="background-color: #ebe7db;height: 32px;">'+
                '<li class="active"><a href="#tab1_'+uniqTblID+'" class="tabtask" data-toggle="tab" aria-expanded="true">Details</a></li>'+
              '</ul>'+

              '<div class="tab-content">'+

                  '<div class="tab-pane active tabTable" id="tabWagon_'+uniqTblID+'">'+
                    '<table class="table-border" style="width: 100%;">'+
                      '<tr id="tab_One'+uniqTblID+'">'+
                        '<th class="text-center">Consinee Code</th>'+
                        '<th class="text-center">Consinee Name</th>'+
                        '<th class="text-center">Qty</th>'+
                        '<th class="text-center">A Qty</th>'+
                      '</tr>'+

                    '</table>'+
                  '</div>'+
  
              '</div>'+
            '</div>'+
          '</div>';

  }

  function excelReportBtn(type){

    var velType = $('input[name=vehicleType]:checked').val();

    var from_date    =  $('#from_date').val();

    var to_date      =  $('#to_date').val();
    
    var ConsineeCode =  $('#cust_no').val();
    
    var trspAgent    =  $('#transpAgentId').val();
    
    var fromPlace    =  $('#from_place').val();

    var toPlace      =  $('#to_place').val();

    if(velType == ''){
      vehicleType = 0;
    }else{
      vehicleType = velType;
    }

    if(ConsineeCode == ''){
      Consinee = 0;
    }else{
      Consinee = ConsineeCode;
    }

    if(fromPlace == ''){
      from_place = 0;
    }else{
      from_place = fromPlace;
    }

    if(toPlace == ''){
      to_place = 0;
    }else{
      to_place = toPlace;
    }

    if(trspAgent == ''){
      transpAgent = 0;
    }else{
      transpAgent = trspAgent;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    window.location.href = "{{ url('/report/logistic/trip-planning/monthly-trip-planning-report-excel/') }}"+'/'+from_date+'/'+to_date+'/'+vehicleType+'/'+Consinee+'/'+from_place+'/'+to_place+'/'+transpAgent;

    /*window.location.href = "{{ url('/report/purchase/purchase-monthly-order/purchase-monthly-order-excel/') }}"+'/'+vehicleType+'/'+from_date+'/'+to_date+'/'+Consinee+'/'+transpAgent+'/'+plant+'/'+from_place+'/'+to_place;*/
       
  }


/* START : Load Data Table */

load_data_query();


function load_data_query( stocksummary='',rack_no= '',cust_no= '',item_code= '',wagon_no= ''){

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

  // console.log('stocksummary',stocksummary);
  // console.log('rack_no',rack_no);
  // console.log('cust_no',cust_no);
  // console.log('item_code',item_code);
  // console.log('wagon_no',wagon_no);

  
   if(stocksummary == 'SS1'){

    $('#stockSummaryRtTbl').css('display','');
    $('#rakeWagonRtTbl').css('display','none');

    var t = $('#stockSummaryRtTbl').DataTable({
    
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
          var getRow = rowcount-1;
          
          if(rowcount > 0){
             $('.buttons-excel').attr('disabled',false);
          }else{
             $('.buttons-excel').attr('disabled',true);
          }
          
          var tlwagonNo = api
                  .column( 6 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

          var tlqty = api
                  .column(7)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

          var tlAvQty = api
                  .column( 8 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

          $( api.column(5).footer() ).html('Total :-').css('text-align','right');
          $( api.column(6).footer() ).html(tlwagonNo).css('text-align','right');
          $( api.column(7).footer() ).html(tlqty).css('text-align','right');
          $( api.column(8).footer() ).html(tlAvQty).css('text-align','right');
         

         },
      
          
        processing: true,
        serverSide: false,
        info: true,
        bPaginate: false,
        scrollY: 400,
        scrollX: true,
        scroller: true,
        fixedHeader: true,
        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
        buttons: [
                  {
                    extend: 'excelHtml5',
                    title: 'rake_report_'+curr_date+'_'+curr_time,
                    footer: true
                  }
                  ],
        ajax:{
          url:'{{ url("/get-data-rake-report") }}',

          data: {stocksummary:stocksummary,rack_no:rack_no,cust_no:cust_no,item_code:item_code,wagon_no:wagon_no},

        },
        columns: [

          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
             return '<button id="showchildtable" onclick="plusBtnClick('+full['DT_RowIndex']+')"><i class="fa fa-plus" id="minus'+full['DT_RowIndex']+'"title="Edit"></i></button><input type="hidden" value='+full['RAKE_NO']+' class="rakeno_'+full['DT_RowIndex']+'"><input type="hidden" value='+full['CP_CODE']+' class="cpcode_'+full['DT_RowIndex']+'">';
            }
          },
          { 
            data :'ACC_NAME',
            render: function(data, type, full, meta) {
              var accCode = full['ACC_CODE'];
              var accName = full['ACC_NAME'];

              var accCdNm = accName+' ['+accCode+'] ';

              return accCdNm;
            },
            className:'text-left'
          },
          { data :'RAKE_NO',className:'text-right'},
          { data :'RAKE_DATE',
            render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
            },
            className:'text-right'

          },
          { data :'PLACE_DATE',
            render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
            },
            className:'text-right'

          },
          {
              render: function (data, type, full, meta){
                
              var cp_code = full['CP_CODE'] != '' ? full['CP_CODE'] : '---';
              var cp_name = full['CP_NAME'] != '' ? full['CP_NAME'] : '---';
            
              var cp_codename =  cp_name +' [' + cp_code + ' ] ';

              return cp_codename;

            }
              
          },

          {data:'WAGON_NO',className:'text-right'},

          {data:'QTY',
             render:function (data, type, full) {
             return parseFloat(data).toFixed(2);
           },className:'text-right'},

          {data:'AVGQTY',
             render:function (data, type, full) {
             return parseFloat(data).toFixed(2);
           },className:'text-right'},

        ]

    });

    $('#stockSummaryRtTbl tbody').on('click', 'td.details-control', function () {

       var tr = $(this).closest('tr');
       console.log(tr);
        var row = t.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

  }else if(stocksummary == 'SS2'){

    $('#stockSummaryRtTbl').css('display','none');
    $('#rakeWagonRtTbl').css('display','');

    var w = $('#rakeWagonRtTbl').DataTable({
    
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
          var getRow = rowcount-1;
          
          if(rowcount > 0){
             $('.buttons-excel').attr('disabled',false);
          }else{
             $('.buttons-excel').attr('disabled',true);
          }

          var count_cp = api
                  .column(6)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

          $( api.column(5).footer() ).html('Total :-').css('text-align','right');
          $( api.column(6).footer() ).html(count_cp).css('text-align','right');

         },
      
          
        processing: true,
        serverSide: false,
        info: true,
        bPaginate: false,
        scrollY: 400,
        scrollX: true,
        scroller: true,
        fixedHeader: true,
        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
        buttons: [
                  {
                    extend: 'excelHtml5',
                    title: 'rake_report_'+curr_date+'_'+curr_time,
                    footer: true
                  }
                  ],
        ajax:{
          url:'{{ url("/get-data-rake-report") }}',

          data: {stocksummary:stocksummary,rack_no:rack_no,cust_no:cust_no,item_code:item_code,wagon_no:wagon_no},

        },
        columns: [
          
           { data:"",className:'details-control',
            render: function(data, type, full, meta) {
             return '<button id="showchildtable" onclick="plusWagonClick('+full['DT_RowIndex']+')"><i class="fa fa-plus" id="minus'+full['DT_RowIndex']+'"title="Edit"></i></button><input type="hidden" value='+full['RAKE_NO']+' class="rakeno1_'+full['DT_RowIndex']+'"><input type="hidden" value='+full['WAGON_NO']+' class="wagonno_'+full['DT_RowIndex']+'">';
          }
          },
          { 
            data :'ACC_NAME',
            render: function(data, type, full, meta) {
              var accCode = full['ACC_CODE'];
              var accName = full['ACC_NAME'];

              var accCdNm = accName+' ['+accCode+'] ';

              return accCdNm;
            },
            className:'text-left'
          },
          { data :'RAKE_NO',className:'text-right'},
          { data :'RAKE_DATE',
            render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
            },
            className:'text-right'

          },
          { data :'PLACE_DATE',
            render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
            },
            className:'text-right'

          },
          { data :'WAGON_NO',className:'WAGON_NO'},
         
          {data:'CP_COUNT',
             render:function (data, type, full) {
             return parseFloat(data).toFixed(2);
           },className:'text-right'},
        
        ]

    });

    $('#rakeWagonRtTbl tbody').on('click', 'td.details-control', function () {

       var tr = $(this).closest('tr');
       console.log(tr);
        var row = w.row( tr );
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format1(row.data()) ).show();
            tr.addClass('shown');
        }
    } );

  }else{
     $('#stockSummaryRtTbl').DataTable({
    
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
          var getRow = rowcount-1;
          
          if(rowcount > 0){
             $('.buttons-excel').attr('disabled',false);
          }else{
             $('.buttons-excel').attr('disabled',true);
          }
          
          var tlwagonNo = api
                  .column( 5 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

          var tlqty = api
                  .column( 6)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

          var tlAvQty = api
                  .column( 7 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

          $( api.column(5).footer() ).html('Total :-').css('text-align','right');
          $( api.column(6).footer() ).html(tlwagonNo).css('text-align','right');
          $( api.column(7).footer() ).html(tlqty).css('text-align','right');
          $( api.column(8).footer() ).html(tlAvQty).css('text-align','right');
         

         },
      
          
        processing: true,
        serverSide: false,
        info: true,
        bPaginate: false,
        scrollY: 400,
        scrollX: true,
        scroller: true,
        fixedHeader: true,
        dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
        buttons: [
                  {
                    extend: 'excelHtml5',
                    title: 'rake_report_'+curr_date+'_'+curr_time,
                    footer: true
                  }
                  ],
        ajax:{
          url:'{{ url("/get-data-rake-report") }}',

          data: {stocksummary:stocksummary},

        },
        columns: [
          
          { data:"",className:'details-control',
            render: function(data, type, full, meta) {
             return '<button id="showchildtable" onclick="plusBtnClick('+full['DT_RowIndex']+')"><i class="fa fa-plus" id="minus'+full['DT_RowIndex']+'"title="Edit"></i></button><input type="hidden" value='+full['CP_CODE']+' class="cpcode_'+full['DT_RowIndex']+'"><input type="hidden" value='+full['RAKE_NO']+' class="rakeno_'+full['RAKE_NO']+'"><input type="hidden" value='+full['RAKE_NO']+' class="wagonno_'+full['WAGON_NO']+'">';
          }
          },
          { 
            data :'ACC_NAME',
            render: function(data, type, full, meta) {
              var accCode = full['ACC_CODE'];
              var accName = full['ACC_NAME'];

              var accCdNm = accName+' ['+accCode+'] ';

              return accCdNm;
            },
            className:'text-left'
          },
          { data :'RAKE_NO',className:'text-right'},
          { data :'RAKE_DATE',
            render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
            },
            className:'text-right'

          },
          { data :'PLACE_DATE',
            render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
            },
            className:'text-right'

          },
          {
              render: function (data, type, full, meta){
                
              var cp_code = full['CP_CODE'];
              var cp_name = full['CP_NAME'];
            
              var cp_codename =  cp_name +'[' + cp_code + ' ] ';

              return cp_codename;

            }
              
          },

          {data:'WAGON_NO',className:'text-right'},

          {data:'QTY',
             render:function (data, type, full) {
             return parseFloat(data).toFixed(2);
           },className:'text-right'},

          {data:'AVGQTY',
             render:function (data, type, full) {
             return parseFloat(data).toFixed(2);
           },className:'text-right'},

        ]

    });
  }
   
  


}


/* END : Load Data Table */

  


$(document).ready(function() {

 

 


/* ..........START : Search Button Click ......... */

$('#ProceedBtnId').click(function(){
  
  var rack_no      =  $('#rack_no').val();
  var stocksummary =  $('#stock_summary').val();
  var custno       =  $('#cust_no').val();
  var cust_name    =  $('#cust_name').val();
  var itemcode     =  $('#item_code').val();
  var wagon_no     =  $('#wagon_no').val();
  var item_name    =  $('#item_name').val();



  var splitesumm = stocksummary.split('-');
  var stock_sum = splitesumm[0];

  var splitecust = custno.split('-');
  var cust_no = splitecust[0];

  var splitItem = itemcode.split('-');
  var item_code = splitItem[0];

  // console.log('stock_sum',stock_sum);
  // console.log('rack_no',rack_no);
  // console.log('cust_no',cust_no);
  // console.log('item_code',item_code);
  // console.log('wagon_no',wagon_no);

    if (stocksummary!='') {

    	$('#ProceedBtnId').attr('disabled',true);
	    $('#cust_no').attr('disabled',true);
	    $('#item_code').attr('disabled',true);
      $('#wagon_no').attr('disabled',true);
	    $('#rack_no').attr('disabled',true);
	    $('#stock_summary').attr('disabled',true);

        $('#stockSummaryRtTbl').DataTable().destroy();
        // $('#rakeWagonRtTbl').DataTable().destroy();
        $('#stocksumm_err').html('');

         if(rack_no!= '' || wagon_no != '' || custno!='' || itemcode!= ''){

            $('#stockSummaryRtTbl').DataTable().destroy();
            $('#errmsg').html('');
            load_data_query(stock_sum,rack_no,cust_no,item_code,wagon_no);

          }else{
            $('#stockSummaryRtTbl').DataTable().destroy();
            load_data_query(stock_sum);
          }
       
     
      }

	    

    else{
    
	    $('#stocksumm_err').html('Please select Stock Summary').css('color','red');
	      return false;

	    $('#stockSummaryRtTbl').DataTable().destroy();
	    // $('#rakeWagonRtTbl').DataTable().destroy();

    // load_data_query();

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