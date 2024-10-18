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

.table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #c2d9ff;
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
.showMsg{
  display: none;
}


.buttons-excel {
    color: #212529 !important;
    background-color: #ffc107 !important;
    border-color: #ffc107 !important;
    padding: 0px 6px 0px 6px !important;
}

</style>


<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Purchase Indent Report
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">Purchase</a></li>

            <li class="active"><a href="{{ url('/report/purchase/purchase-indent-report') }}">Purchase Indent Rep.</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Purchase Indent Report</h2>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->



            </div><!-- /.box-header -->

            <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

              <div class="row">

                <div class="col-md-3">

                   <div class="form-group">

                    <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                        $ToDate= date("d-m-Y", strtotime($toDate));   ?>

                      <label for="exampleInputEmail1"> From Date : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="hidden" name="" value="<?php echo $FromDate;?>" id="FromDateFy">

                        <input type="hidden" name="" value="<?php echo $ToDate;?>" id="ToDateFy">
                       
                        <input type="text" name="from_date" id="from_date" class="form-control fromDatePc rightcontent" placeholder="Select Transaction Date" value="{{$FromDate}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_from_date">

                        

                      </small>

                  </div>

                 </div>



                 <div class="col-md-3">

                   <div class="form-group">

                      <label for="exampleInputEmail1"> To Date : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy_1">

                        <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy_1">

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

                    <label for="exampleInputEmail1">Vr. No. :</label>

                  <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>



                           <input list="indentList" id="vr_num" name="vr_num" class="form-control  pull-left" value="{{ old('vr_num')}}" placeholder="Select Vr Number" autocomplete="off">



                          <datalist id="indentList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($indent_list as $key)

                            <?php 

                              $vrNo = $key->VRNO;
                              
                              $SericeCode = $key->SERIES_CODE;
                              
                              $FyYr = $key->FY_CODE;

                              $getYr = explode("-",$FyYr);

                              $BgYr = $getYr[0];

                              $newVrNo = $BgYr.'-'.$SericeCode.' '.$vrNo;


                            ?>
                            
                            <option value='<?php echo $newVrNo; ?>'   data-xyz ="<?php echo $newVrNo; ?>" ><?php echo $newVrNo; ?></option>

                            

                            @endforeach

                          </datalist>
                          <small>  

                            <div class="pull-left showSeletedName" id="transText"></div>

                         </small>

                         <small id="show_err_trans">

                            

                          </small>
                         <span id='searcherr' style="color: red;"></span>

                      </div>

                   </div>
                  
                </div><!-- /.col -->


                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Item :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>



                           <input list="accountList" id="item_code" name="item_code" class="form-control  pull-left" value="{{ old('item_code')}}" placeholder="Select Item" autocomplete="off">



                          <datalist id="accountList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($item_list as $key)

                            

                            <option value='<?php echo $key->ITEM_CODE?>'   data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME; echo " [".$key->ITEM_CODE."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="accountText"></div>

                     </small>

                     <small id="show_err_item_code">

                        

                     </small>

                  </div>



                </div><!-- /.col -->
                

              </div><!-- /.row -->



              <div class="row">

                
                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Report Type : <span class="required-field"></span> </label>

                      <div class="input-group">

                      
                          <input type="radio" id="pendingId" name="reporttype"  value="pending" checked=""> &nbsp; <b>Pending</b> &nbsp;&nbsp;
                          <input type="radio" id="CompleteId" name="reporttype" value="complete">  &nbsp; <b>Complete</b>&nbsp;&nbsp;
                          <input type="radio" id="allId" name="reporttype" value="allitem">  &nbsp; <b>All</b>


                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="pfctText"></div>

                     </small>

                     <small id="show_err_dept_code">

                      </small>
                     
                  </div>

                </div>
                


                <div class="col-md-8">

                  <div style="margin-top: 2%;">

                    <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" style="padding: 1px 1px 1px 1px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp; Search &nbsp;&nbsp;</button>

                    <button type="button" class="btn btn-warning" name="searchdata" id="ResetId" style="padding: 1px 1px 1px 1px;">&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp; Reset &nbsp;&nbsp;</button>

                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#QueryModal" style="padding: 1px 1px 1px 1px;">&nbsp;&nbsp;<i class="fa fa-hourglass" aria-hidden="true"></i> &nbsp;&nbsp; Query &nbsp;&nbsp;</button>

                    <!-- <button class="btn btn-primary" disabled id="PindReprtExl"  onclick="excelReportBtn()" ><i class="fa fa-file-excel-o" aria-hidden="true"></i> <b>Excel</b></button> -->

                  </div>

                </div>

              </div>


            </div><!-- /.box-body -->



            <div class="box-body" style="margin-top: -2%;">

 

<table id="PurchaseIndentReportTable" class="table table-bordered table-striped table-hover">
  <thead class="theadC">

    <tr>
      <th class="text-center" width="3%">Sr.No</th>
      <th class="text-center" width="5%">Vr Date</th>
      <th class="text-center" width="5%">Vr no. </th>
      <th class="text-center" width="3%">Trans. code</th>
      <th class="text-center" width="4%">Plant Code</th>
      <th class="text-center" width="17%">Item Name</th>
      <th class="text-center" width="5%">Qty</th>
      <th class="text-center" width="3%">UM</th>
      <th class="text-center" width="5%">A-Qty</th>
      <th class="text-center" width="3%">AUM</th>
       <th class="text-center" width="5%">Status</th>
      <th class="text-center" width="5%">Action</th>
     
    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>
 

</table>



</div><!-- /.box-body -->

           

          </div>

  </section>

</div>



  {{--****** Start : Query Model ******--}}


  <div class="modal fade" id="QueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style='border-radius: 5px;
    -webkit-box-shadow: 0px 1px 8px 0px rgb(0 0 0 / 75%);
    -moz-box-shadow: 0px 1px 8px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 1px 8px 0px rgb(0 0 0 / 75%'>
        <div class="modal-header" style='text-align:center'>
          <div class="modal-title" id="queryModalLabel" style="font-size: 135%;font-weight: 800;">Query</div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times-circle-o" aria-hidden="true"></i>
          </button>
        </div>
        <div class="modal-body">
          <section>
            <div class="row">
              
              <div class="col-sm-12">
                <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Query Fields</th>
                  <th scope="col" class="text-center">Operator</th>
                  <th scope="col" class="text-center">Values</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>1</th>
                  <td class='QueryTableTd'>Plant :</td>
                  <td style="text-align: center;">
                      <select id="plantCodeOperator" name="plantCodeOperator" style="width: 70%;font-size: initial;" onchange="plantQueryOperator(this.value)">
                        <option value=''>--Select--</option>
                        <option value='='>=</option>
                        <option value='=='>==</option>
                        <option value='!='>!=</option>
                        <option value='>'>></option>
                        <option value='<'><</option>
                        <option value='>='>>=</option>
                        <option value='<='><=</option>
                        <option value='LIKE'>LIKE</option>
                        <option value='BETWEEN'>BETWEEN</option>
                        <option value='AND'>AND</option>
                        <option value='OR'>OR</option>
                      </select>
                    <small id="showErrorRecNoOpt"></small>
                  </td>
                  <td style="text-align: center;">
                    <input list="plantList" id="plantCodeValue" name="plantCodeValue" class="pull-left" placeholder="Select Plant" autocomplete="off" readonly style="margin-left: 15%;" onchange="plantQueryValue(this.value)">
                        <datalist id="plantList">
                          <option selected="selected" value="">-- Select --</option>
                          @foreach ($master_plant as $key)

                          <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME; echo " [".$key->PLANT_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>
                    <small id="showErrorRecNoVal"></small>
                  </td>
                </tr>
                <tr>
                  <th>2</th>
                  <td class='QueryTableTd'>Series :</td>
                  <td style="text-align: center;">
                      <select id="seriesCodeOperator" name="seriesCodeOperator" style="width: 70%;font-size: initial;" onchange="seriesQueryOperator(this.value)">
                        <option value=''>--Select--</option>
                        <option value='='>=</option>
                        <option value='=='>==</option>
                        <option value='!='>!=</option>
                        <option value='>'>></option>
                        <option value='<'><</option>
                        <option value='>='>>=</option>
                        <option value='<='><=</option>
                        <option value='LIKE'>LIKE</option>
                        <option value='BETWEEN'>BETWEEN</option>
                        <option value='AND'>AND</option>
                        <option value='OR'>OR</option>
                      </select>
                    <small id="showErrorLastUpOpt"></small>
                  </td>
                  <td style="text-align: center;">
                    <input list="seriesList" id="seriesCodeValue" name="seriesCodeValue" class="pull-left" placeholder="Select Series" autocomplete="off" readonly style="margin-left: 15%;" onchange="seriesQueryValue(this.value)">
                        <datalist id="seriesList">
                          <option selected="selected" value="">-- Select --</option>
                          @foreach ($master_series as $key)

                          <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME; echo " [".$key->SERIES_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>
                    <small id="showErrorLastUpVal"></small>
                  </td>
                </tr>
                <tr>
                  <th>3</th>
                  <td class='QueryTableTd'>Profit Center :</td>
                  <td style="text-align: center;">
                      <select id="profitCenterOperator" name="profitCenterOperator" style="width: 70%;font-size: initial;" onchange="pfctQueryOperator(this.value)">
                        <option value=''>--Select--</option>
                        <option value='='>=</option>
                        <option value='=='>==</option>
                        <option value='!='>!=</option>
                        <option value='>'>></option>
                        <option value='<'><</option>
                        <option value='>='>>=</option>
                        <option value='<='><=</option>
                        <option value='LIKE'>LIKE</option>
                        <option value='BETWEEN'>BETWEEN</option>
                        <option value='AND'>AND</option>
                        <option value='OR'>OR</option>
                      </select>
                    <small id="showErrorVrNoOpt"></small>
                  </td>
                  <td style="text-align: center;">
                    <input list="pfctList" id="profitCenterValue" name="profitCenterValue" class="pull-left" placeholder="Select Profit Center" autocomplete="off" readonly style="margin-left: 15%;" onchange="pfctQueryValue(this.value)">
                        <datalist id="pfctList">
                          <option selected="selected" value="">-- Select --</option>
                          @foreach ($master_pfct as $key)

                          <option value='<?php echo $key->PFCT_CODE?>'   data-xyz ="<?php echo $key->PFCT_NAME; ?>" ><?php echo $key->PFCT_NAME; echo " [".$key->PFCT_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>
                    <small id="showErrorVrNoVal"></small>
                  </td>
                </tr>
                <tr>
                  <th>4</th>
                  <td class='QueryTableTd'>Department :</td>
                  <td style="text-align: center;">
                      <select id="departmentOperator" name="departmentOperator" style="width: 70%;font-size: initial;" onchange="deptQueryOperator(this.value)">
                        <option value=''>--Select--</option>
                        <option value='='>=</option>
                        <option value='=='>==</option>
                        <option value='!='>!=</option>
                        <option value='>'>></option>
                        <option value='<'><</option>
                        <option value='>='>>=</option>
                        <option value='<='><=</option>
                        <option value='LIKE'>LIKE</option>
                        <option value='BETWEEN'>BETWEEN</option>
                        <option value='AND'>AND</option>
                        <option value='OR'>OR</option>
                      </select>
                    <small id="showErrorSeriesNoOpt"></small>
                  </td>
                  <td style="text-align: center;">
                    <input list="deptList" id="departmentValue" name="departmentValue" class="pull-left" placeholder="Select Department" autocomplete="off" readonly style="margin-left: 15%;" onchange="deptQueryValue(this.value)">
                        <datalist id="deptList">
                          <option selected="selected" value="">-- Select --</option>
                          @foreach ($master_dept as $key)

                          <option value='<?php echo $key->DEPT_CODE?>'   data-xyz ="<?php echo $key->DEPT_NAME; ?>" ><?php echo $key->DEPT_NAME; echo " [".$key->DEPT_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>
                    <small id="showErrorSeriesNoVal"></small>
                  </td>
                </tr>
                <tr>
                  <th>5</th>
                  <td class='QueryTableTd'>Employee :</td>
                  <td style="text-align: center;">
                      <select id="employeeOperator" name="employeeOperator" style="width: 70%;font-size: initial;" onchange="empQueryOperator(this.value)">
                        <option value=''>--Select--</option>
                        <option value='='>=</option>
                        <option value='=='>==</option>
                        <option value='!='>!=</option>
                        <option value='>'>></option>
                        <option value='<'><</option>
                        <option value='>='>>=</option>
                        <option value='<='><=</option>
                        <option value='LIKE'>LIKE</option>
                        <option value='BETWEEN'>BETWEEN</option>
                        <option value='AND'>AND</option>
                        <option value='OR'>OR</option>
                      </select>
                    <small id="showErrorAccCodeOpt"></small>
                  </td>
                  <td style="text-align: center;">
                    <input list="empList" id="employeeValue" name="employeeValue" class="pull-left" placeholder="Select Empolyee" autocomplete="off" readonly style="margin-left: 15%;" onchange="empQueryValue(this.value)">
                        <datalist id="empList">
                          <option selected="selected" value="">-- Select --</option>
                          @foreach ($master_emp as $key)

                          <option value='<?php echo $key->EMP_CODE?>'   data-xyz ="<?php echo $key->EMP_NAME; ?>" ><?php echo $key->EMP_NAME; echo " [".$key->EMP_CODE."]" ; ?></option>

                          @endforeach

                        </datalist>
                    <small id="showErrorAccCodeVal"></small>
                  </td>
                </tr>
                <tr>
                  <th>6</th>
                  <td class='QueryTableTd'>Qty :</td>
                  <td style="text-align: center;">
                      <select id="QtyOperator" name="QtyOperator" style="width: 70%;font-size: initial;" onchange="qtyQueryOperator(this.value)">
                        <option value=''>--Select--</option>
                        <option value='='>=</option>
                        <option value='=='>==</option>
                        <option value='!='>!=</option>
                        <option value='>'>></option>
                        <option value='<'><</option>
                        <option value='>='>>=</option>
                        <option value='<='><=</option>
                        <option value='LIKE'>LIKE</option>
                        <option value='BETWEEN'>BETWEEN</option>
                        <option value='AND'>AND</option>
                        <option value='OR'>OR</option>
                      </select>
                    <small id="showErrorAmtOpt"></small>
                  </td>
                  <td style="text-align: center;">
                    <input type="text" name="QtyValue" id="QtyValue" class="ValuesTd" value="" placeholder="Enter Qty" readonly oninput="qtyQueryValue(this.value);">
                    <small id="showErrorAmtVal"></small>
                  </td>
                </tr>

              </tbody>
            </table>
              </div>
              
            </div>
          </section>  
        </div>
        <div class="modal-footer" style='text-align:center;'>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close &nbsp;&nbsp;<i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
          <button type="button" id="ProceedBtnId" class="btn btn-primary" disabled="">Proceed &nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>

        </div>
      </div>
    </div>
  </div>



  <input type="hidden" value="" name="plantCodeOperators" id="plantCodeOperators">
  <input type="hidden" value="" name="plantCodeValues" id="plantCodeValues">

  <input type="hidden" value="" name="seriesCodeOperators" id="seriesCodeOperators">
  <input type="hidden" value="" name="seriesCodeValues" id="seriesCodeValues">

  <input type="hidden" value="" name="profitCenterOperators" id="profitCenterOperators">
  <input type="hidden" value="" name="profitCenterValues" id="profitCenterValues">

  <input type="hidden" value="" name="departmentOperators" id="departmentOperators">
  <input type="hidden" value="" name="departmentValues" id="departmentValues">

  <input type="hidden" value="" name="employeeOperators" id="employeeOperators">
  <input type="hidden" value="" name="employeeValues" id="employeeValues">

  <input type="hidden" value="" name="QtyOperators" id="QtyOperators">
  <input type="hidden" value="" name="QtyValues" id="QtyValues">

  <input type="hidden" value="" name="OtherDetailsIds" id="OtherDetailsIds">
  <input type="hidden" value="" name="OtherDetailsValueIds" id="OtherDetailsValueIds">


  

  {{--****** End : Query Model ******--}}



  {{--**** Start : Quality Parameter Model ****--}}

    <div id="quaPdomModel_2">
         
    </div>


    {{--**** End : Quality Parameter Model ****--}}



@include('admin.include.footer')



 <script type="text/javascript">

  //employeeValue


  function excelReportBtn(){

    var from_date = $("#from_date").val();
    var to_date   = $("#to_date").val();
    var vrn       = $("#vr_num").val();
    var item_codes = $("#item_code").val();


    if(item_codes == ''){
      item_code = 0;
    }else{
      item_code = item_codes;
    }
  
  // alert(item_code);return false;
    var vr = vrn.split(" ");
    var vrno = vr[1];

    if (vrn == '') {
       vr_num = 0;
    }else{
       vr_num = vrno;
    }


    var pendingId  =  $('#pendingId').is(":checked");

    var CompleteId =  $('#CompleteId').is(":checked");

    var allId      =  $('#allId').is(":checked");


    var ReportTypes;

    if(pendingId){
      ReportTypes = $('#pendingId').val();
    }else if(CompleteId){
      ReportTypes = $('#CompleteId').val();
    }else if(allId){
      ReportTypes = $('#allId').val();
    }else{
      ReportTypes = 'Not Found';
    }
   

   // alert(vr_num);return false;

    var plantCodeOperators    =  $('#plantCodeOperators').val();
    if (plantCodeOperators == '') {
      plantCodeOperator = 0;
    }else{
      plantCodeOperator = plantCodeOperators;
    }

    var plantCodeValues       =  $('#plantCodeValues').val();
    if (plantCodeValues == '') {
      plantCodeValue = 0;
    }else{
      plantCodeValue = plantCodeValues;
    }

    var seriesCodeOperators   =  $('#seriesCodeOperators').val();
    if (seriesCodeOperators == '') {
      seriesCodeOperator = 0;
    }else{
      seriesCodeOperator = seriesCodeOperators;
    }

    var seriesCodeValues      =  $('#seriesCodeValues').val();
    if (seriesCodeValues == '') {
      seriesCodeValue = 0;
    }else{
      seriesCodeValue = seriesCodeValues;
    }

    var profitCenterOperators =  $('#profitCenterOperators').val();
    if (profitCenterOperators == '') {
      profitCenterOperator = 0;
    }else{
      profitCenterOperator = profitCenterOperators;
    }

    var profitCenterValues    =  $('#profitCenterValues').val();
    if (profitCenterValues == '') {
      profitCenterValue = 0;
    }else{
      profitCenterValue = profitCenterValues;
    }
   
    var departmentOperators   =  $('#departmentOperators').val();
    if (departmentOperators == '') {
      departmentOperator = 0;
    }else{
      departmentOperator = departmentOperators;
    }

    var departmentValues      =  $('#departmentValues').val();
    if (departmentValues == '') {
      departmentValue = 0;
    }else{
      departmentValue = departmentValues;
    }

    var employeeOperators     =  $('#employeeOperators').val();
    if (employeeOperators == '') {
      employeeOperator = 0;
    }else{
      employeeOperator = employeeOperators;
    }

    var employeeValues        =  $('#employeeValues').val();
    if (employeeValues == '') {
      employeeValue = 0;
    }else{
      employeeValue = employeeValues;
    }

    var QtyOperators          =  $('#QtyOperators').val();
    console.log('QtyOP', QtyOperators);
    if (QtyOperators == '') {
      QtyOperator = 0;
    }else{
      QtyOperator = QtyOperators;
    }

    console.log('QtyOperators', QtyOperator);

    var QtyValues             =  $('#QtyValues').val();
    console.log('Qtyv', QtyValues);
    if (QtyValues == '') {
      QtyValue = 0;
    }else{
      QtyValue = QtyValues;
    }
    console.log('QtyValue', QtyValue);
   

   var pageName = 'purchaseIndent';

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });


      window.location.href = "{{ url('/report/purchase/purchase-indent/purchase-indent-report-excel/') }}"+'/'+vr_num+'/'+item_code+'/'+plantCodeOperator+'/'+plantCodeValue+'/'+seriesCodeOperator+'/'+seriesCodeValue+'/'+profitCenterOperator+'/'+profitCenterValue+'/'+departmentOperator+'/'+departmentValue+'/'+employeeOperator+'/'+employeeValue+'/'+QtyOperator+'/'+QtyValue+'/'+from_date+'/'+to_date+'/'+ReportTypes;

  }


    $( window ).on( "load", function() {

      var fromdateintrans = $('#FromDateFy').val();
      var todateintrans = $('#ToDateFy').val();

      var fromdateintrans_1 = $('#FromDateFy_1').val();
      var todateintrans_1 = $('#ToDateFy_1').val();

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

        startDate :fromdateintrans_1,

        endDate : todateintrans_1,

        autoclose: 'true'

      });

    });

    $(document).ready(function(){



        $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

        });



        $('#item_code').change(function(){

         

          var acountCode = $('#item_code').val();

          $('#showaccCode').val(acountCode);

        });

    });


</script>




<script type="text/javascript">

  function plantQueryOperator(getVal){

    var plantCodeValue =  $('#plantCodeValue').val();

    if(plantCodeValue == '' && getVal !=''){
      $("#plantCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(plantCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#plantCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#plantCodeValue").val('');
    }

  }

  function plantQueryValue(plantCodeValue){

    var getVal =  $('#plantCodeOperator').val();

    if(getVal == '' && plantCodeValue !=''){
      $("#plantCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(plantCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#plantCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#plantCodeValue").val('');
    }

  }


  function seriesQueryOperator(getVal){

    var seriesCodeValue =  $('#seriesCodeValue').val();

    if(seriesCodeValue == '' && getVal !=''){
      $("#seriesCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(seriesCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#seriesCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#seriesCodeValue").val('');
    }

  }

  function seriesQueryValue(seriesCodeValue){

    var getVal =  $('#seriesCodeOperator').val();

    if(getVal == '' && seriesCodeValue !=''){
      $("#seriesCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(seriesCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#seriesCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#seriesCodeValue").val('');
    }

  }

  function deptQueryOperator(getVal){

    var departmentValue =  ('#departmentValue').val();

    if(departmentValue == '' && getVal !=''){
      $("#departmentValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(departmentValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#departmentValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#departmentValue").val('');
    }

  }

  function deptQueryValue(departmentValue){

    var getVal =  $('#departmentOperator').val();

    if(getVal == '' && departmentValue !=''){
      $("#departmentValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(departmentValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#departmentValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#departmentValue").val('');
    }

  }


  function pfctQueryOperator(getVal){

    var profitCenterValue =  $('#profitCenterValue').val();

    if(profitCenterValue == '' && getVal !=''){
      $("#profitCenterValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(profitCenterValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#profitCenterValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#profitCenterValue").val('');
    }

  }

  function pfctQueryValue(profitCenterValue){

    var getVal =  $('#profitCenterOperator').val();

    if(getVal == '' && profitCenterValue !=''){
      $("#profitCenterValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(profitCenterValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#profitCenterValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#profitCenterValue").val('');
    }

  }



  function empQueryOperator(getVal){

    var employeeValue =  $('#employeeValue').val();

    if(employeeValue == '' && getVal !=''){
      $("#employeeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(employeeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#employeeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#employeeValue").val('');
    }

  }

  function empQueryValue(employeeValue){

    var getVal =  $('#employeeOperator').val();

    if(getVal == '' && employeeValue !=''){
      $("#employeeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(employeeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#employeeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#employeeValue").val('');
    }

  }

  function qtyQueryOperator(getVal){

    var qtyValue =  $('#QtyValue').val();

    if(qtyValue == '' && getVal !=''){
      $("#QtyValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(qtyValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#QtyValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#QtyValue").val('');
    }

  }

  function qtyQueryValue(employeeValue){

    var getVal =  $('#QtyOperator').val();

    if(getVal == '' && employeeValue !=''){
      $("#QtyValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(employeeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#QtyValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#QtyValue").val('');
    }

  }

  


  load_data_query()
  function load_data_query(plantCodeOperator= '', plantCodeValue='',seriesCodeOperator='',seriesCodeValue='',profitCenterOperator='',profitCenterValue='',departmentOperator= '', departmentValue='',employeeOperator='',employeeValue='',QtyOperator='',QtyValue='',OtherDetailsId='',OtherDetValueId='', item_code='',from_date='',to_date='',vr_nums='',ReportTypes=''){

    var getcomName = '<?php echo Session::get('company_name'); ?>';
    var compN = getcomName.split('-');
    var newCompName = compN[1];
    var getFY      = '<?php echo Session::get('macc_year'); ?>';
    var getnewdate = new Date();
    var getday = getnewdate.getDate();
    var getMonth = getnewdate.getMonth()+1;
    var getYear = getnewdate.getFullYear();


    var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

    var getdate = getday+''+getMonth+''+getYear;

    var vr_numss = vr_nums.split(' ');

    var vr_num = vr_numss[1];
    
      $('#PurchaseIndentReportTable').DataTable({

          processing: true,
          serverSide: false,
          info: true,
          bPaginate: false,
          scrollY: 400,
          scrollX: true,
          scroller: true,
          fixedHeader: true,
          order: [[0, 'asc'],[1, 'asc']],
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-3'l><'col-sm-3'i><'col-sm-6'p>>",
          buttons: [
                      {
                        extend: 'excelHtml5',
                        filename: 'PURCHASE_INDENT_REPORT_'+getdate+'_'+gettime,
                        title: getcomName+'\n'+getFY+'\n'+' PURCHASE INDENT REPORT',
                        exportOptions: {
                              columns: [1,2,3,4,5,6,7,8,9,10]
                        }
                      }

                  ],
          ajax:{
            url:'{{ url("/get-data-from-query") }}',
            data: {plantCodeOperator:plantCodeOperator,plantCodeValue:plantCodeValue,seriesCodeOperator:seriesCodeOperator,seriesCodeValue:seriesCodeValue,profitCenterOperator:profitCenterOperator,profitCenterValue:profitCenterValue,departmentOperator:departmentOperator,departmentValue:departmentValue,employeeOperator:employeeOperator,employeeValue:employeeValue,QtyOperator:QtyOperator,QtyValue:QtyValue,OtherDetailsId:OtherDetailsId,OtherDetValueId:OtherDetValueId,item_code:item_code,vr_num:vr_num,from_date:from_date,to_date:to_date,ReportTypes:ReportTypes}
          },
          columns: [

            { 
              data:"DT_RowIndex",
              className:"text-center"
            },
            {
                className:'text-right',
                render: function (data, type, full, meta){

                var dtvr = full['VRDATE'];
                  
                var vrdt = dtvr.split('-');
                var newDt0 = vrdt[0];
                var newDt1 = vrdt[1];
                var newDt2 = vrdt[2];

                return newDt2+'-'+newDt1+'-'+newDt0;

              },
              className:'text-left'
            },
            {
                className:'text-right',
                render: function (data, type, full, meta){

                var fy     = full['FY_CODE'];
                var vrno   = full['VR_NO'];
                var series = full['SERIES_CODE'];
                  
                var getFy = fy.split('-');
                var newFy = getFy[0];

                return newFy+' '+series+' '+vrno;

                },
                className:'text-left'
            },
            {
                data:'TRAN_CODE',
                name:'TRAN_CODE',
                className: "text-left"
            },
            {
                data:'PLANT_CODE',
                name:'PLANT_CODE',
                className: "text-left"
            },
            {
              render: function (data, type, full, meta){
                  
                var itemName = '<p>'+full['ITEM_NAME']+'</p>'+'<p style="line-height:2px;">('+full['ITEM_CODE']+')<input type="hidden" id="ItemCodeId'+full['DT_RowIndex']+'" value="'+full['ITEM_CODE']+'"><input type="hidden" id="HId'+full['DT_RowIndex']+'" value="'+full['PINDHID']+'"><input type="hidden" id="BId'+full['DT_RowIndex']+'" value="'+full['PINDBID']+'"></p>';
                return itemName;

              },
              className:'text-left'
            },
            {
                className: "alignRightClass",
                render: function (data, type, full, meta){
                  var QTYR     = full['QTYRECVD'];
                  return QTYR;
                },
                className:'text-right'
            },
            {
                className: "alignRightClass",
                render: function (data, type, full, meta){
                  var UM       = full['UM'];
                  return ' <small class="label label-info"> '+UM+'</small>';
                },
                className:'text-left'
            },
            {
                className: "alignRightClass",
                render: function (data, type, full, meta){
                  var AQTYR     = full['AQTYRECD'];
                  var AUM       = full['AUM'];
                  return AQTYR;
                },
                className:'text-right'
            },
            {
                className: "alignRightClass",
                render: function (data, type, full, meta){
                  var AUM       = full['AUM'];
                  return ' <small class="label label-info"> '+AUM+'</small>';
                },
                className:'text-left'
            },
            {
              data:null,
              render: function (data, type, full, meta){

                if(full['PENQHID']==0 && full['PENQBID']==0){

                  var itemName = '<small class="label label-danger"><i class="fa fa-clock-o"></i> Pending</small>';

                }else if(full['PENQHID']!=0 && full['PENQBID']!=0){

                  var itemName = '<small class="label label-success"><i class="fa fa-check"></i> Completed</small>';

                }else{

                  var itemName = '<a class="btn btn-danger btn-xs"><i class="fa fa-close" aria-hidden="true"></i> Pending </a>';

                }

                
                return itemName;


              },
                className:'text-center'
            },
            {
              data:null,
              render: function (data, type, full, meta){
                var qcBtn = '<button type="button" class="btn btn-primary btn-xs" id="CalcTax1" data-toggle="modal" data-target="#quality_parametr'+full['DT_RowIndex']+'" onclick="qty_parameter('+full['DT_RowIndex']+')" style="padding-bottom: 0px;padding-top: 0px;font-size:12px;">Quality Parametr </button><span id="MsgShow'+full['DT_RowIndex']+'"class="showMsg"><small class="label label-danger"><i class="fa fa-times"></i> Not Found</small></span>';
                var qpdomModel = "<div class='modal fade' id='quality_parametr"+full['DT_RowIndex']+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'><div class='modal-dialog' role='document'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><div class='row'><div class='col-md-12'><h5 class='modal-title modltitletext' style='padding-bottom: 0px;padding-top: 0px;' id='exampleModalLabel' >Qaulity Parameter</h5></div></div></div><div class='modal-body table-responsive'><div class='boxer' id='qua_par_"+full['DT_RowIndex']+"'></div></div><div class='modal-footer'><center><small style='text-align: center;' id='footer_ok_btn"+full['DT_RowIndex']+"'></small><small style='text-align: center;' id='footer_quality_btn"+full['DT_RowIndex']+"'></small></center></div></div></div></div>";
                $('#quaPdomModel_2').append(qpdomModel);
                $("#PindReprtExl").attr("disabled", false);
                return qcBtn;
              },
              className:'text-center'
            }
            
          ]


      });


   }
  

  $(document).ready(function() {

    $('#lastUpdateValueId').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });


    $('#ProceedBtnId').click(function(){

     var plantCodeOperator    =  $('#plantCodeOperator').val();
     var plantCodeValue       =  $('#plantCodeValue').val();

     var seriesCodeOperator   =  $('#seriesCodeOperator').val();
     var seriesCodeValue      =  $('#seriesCodeValue').val();

     var profitCenterOperator =  $('#profitCenterOperator').val();
     var profitCenterValue    =  $('#profitCenterValue').val();
     
     var departmentOperator   =  $('#departmentOperator').val();
     var departmentValue      =  $('#departmentValue').val();

     var employeeOperator     =  $('#employeeOperator').val();
     var employeeValue        =  $('#employeeValue').val();

     var QtyOperator          =  $('#QtyOperator').val();
     var QtyValue             =  $('#QtyValue').val();

     var OtherDetailsId       =  $('#OtherDetailsId').val();
     var OtherDetValueId      =  $('#OtherDetailsValueId').val();

      $('#plantCodeOperators').val(plantCodeOperator);
      $('#plantCodeValues').val(plantCodeValue);
      $('#seriesCodeOperators').val(seriesCodeOperator);
      $('#seriesCodeValues').val(seriesCodeValue);
      $('#profitCenterOperators').val(profitCenterOperator);
      $('#profitCenterValues').val(profitCenterValue);
      $('#departmentOperators').val(departmentOperator);
      $('#departmentValues').val(departmentValue);
      $('#employeeOperators').val(employeeOperator);
      $('#employeeValues').val(employeeValue);
      $('#QtyOperators').val(QtyOperator);
      $('#QtyValues').val(QtyValue);
      $('#OtherDetailsIds').val(OtherDetailsId);
      $('#OtherDetailsValueIds').val(OtherDetValueId);

      var from_date = '';
      var to_date = '';
      var item_code = '';
      var vr_num = '';

      var pendingId  =  $('#pendingId').is(":checked");

      var CompleteId =  $('#CompleteId').is(":checked");

      var allId      =  $('#allId').is(":checked");

 
      var ReportTypes;

      if(pendingId){
        ReportTypes = $('#pendingId').val();
      }else if(CompleteId){
        ReportTypes = $('#CompleteId').val();
      }else if(allId){
        ReportTypes = $('#allId').val();
      }else{
        ReportTypes = 'Not Found';
      }

     

      if (plantCodeOperator!='' || plantCodeValue!='' || seriesCodeOperator!='' || seriesCodeValue!='' || profitCenterOperator!='' || profitCenterValue!='' || departmentOperator!='' || departmentValue!='' || employeeOperator!='' || employeeValue!='' || QtyOperator!='' || QtyValue!='' || OtherDetailsId!='' || OtherDetValueId!='' || from_date == '' || to_date =='' || item_code=='' || vr_num=='' || ReportTypes=='') {
            

          $('#PurchaseIndentReportTable').DataTable().destroy();

          load_data_query(plantCodeOperator,plantCodeValue,seriesCodeOperator,seriesCodeValue,profitCenterOperator,profitCenterValue,departmentOperator,departmentValue,employeeOperator,employeeValue,QtyOperator,QtyValue,OtherDetailsId,OtherDetValueId,item_code,from_date,to_date,vr_num,ReportTypes);

          $('#QueryModal').modal('hide');
          $('#plantCodeOperator').val('');
          $('#plantCodeValue').val('');
          $('#seriesCodeOperator').val('');
          $('#seriesCodeValue').val('');
          $('#profitCenterOperator').val('');
          $('#profitCenterValue').val('');
          $('#departmentOperator').val('');
          $('#departmentValue').val('');
          $('#employeeOperator').val('');
          $('#employeeValue').val('');
          $('#QtyOperator').val('');
          $('#QtyValue').val('');
          $('#OtherDetailsId').val('');
          $('#OtherDetailsValueId').val('');


      }else{

          $('#PurchaseIndentReportTable').DataTable().destroy();

          load_data_query();

          $('#QueryModal').modal('hide');
          $('#plantCodeOperator').val('');
          $('#plantCodeValue').val('');
          $('#seriesCodeOperator').val('');
          $('#seriesCodeValue').val('');
          $('#profitCenterOperator').val('');
          $('#profitCenterValue').val('');
          $('#departmentOperator').val('');
          $('#departmentValue').val('');
          $('#employeeOperator').val('');
          $('#employeeValue').val('');
          $('#QtyOperator').val('');
          $('#QtyValue').val('');
          $('#OtherDetailsId').val('');
          $('#OtherDetailsValueId').val('');
         
      }


    });


    $('#btnsearch').click(function(){

          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var item_code =  $('#item_code').val();
         
          var vr_num =  $('#vr_num').val();

          var plantCodeOperator         =  '';
          var plantCodeValue    =  '';
          var seriesCodeOperator        =  '';
          var seriesCodeValue   =  '';
          var profitCenterOperator          =  '';
          var profitCenterValue     =  '';
          var departmentOperator      =  '';
          var departmentValue =  '';
          var employeeOperator       =  '';
          var employeeValue  =  '';
          var QtyOperator        =  '';
          var QtyValue   =  '';
          var OtherDetailsId  =  '';
          var OtherDetValueId =  '';

          var pendingId  =  $('#pendingId').is(":checked");

          var CompleteId =  $('#CompleteId').is(":checked");

          var allId      =  $('#allId').is(":checked");

     
          var ReportTypes;

          if(pendingId){
            ReportTypes = $('#pendingId').val();
          }else if(CompleteId){
            ReportTypes = $('#CompleteId').val();
          }else if(allId){
            ReportTypes = $('#allId').val();
          }else{
            ReportTypes = 'Not Found';
          }
          

          if (item_code!='' || from_date!='' || to_date!='' || vr_num!='' || plantCodeOperator=='' || plantCodeValue=='' || seriesCodeOperator=='' || seriesCodeValue=='' || profitCenterOperator=='' || profitCenterValue=='' || departmentOperator=='' || departmentValue=='' || employeeOperator=='' || employeeValue=='' || QtyOperator=='' || QtyValue=='' || OtherDetailsId=='' || OtherDetValueId=='' || ReportTypes=='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_item_code').html('');
            $('#show_err_trans').html('');

            if(from_date!=''){
              if(to_date==''){
                $('#show_err_to_date').html('Please select to date').css('color','red');
                return false;
              }
            }

            if(to_date!=''){
              if(from_date==''){
                $('#show_err_from_date').html('Please select from date').css('color','red');
                return false;
              }
            }

            $('#PurchaseIndentReportTable').DataTable().destroy();

            load_data_query(plantCodeOperator,plantCodeValue,seriesCodeOperator,seriesCodeValue,profitCenterOperator,profitCenterValue,departmentOperator,departmentValue,employeeOperator,employeeValue,QtyOperator,QtyValue,OtherDetailsId,OtherDetValueId,item_code,from_date,to_date,vr_num,ReportTypes);

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            
          }


        });


    $('#ResetId').click(function(){
  
      $('#item_code').val('');
      $('#vr_num').val('');
      $('#accountText').html('');

    
      $('#PurchaseIndentReportTable').DataTable().destroy();
      load_data_query();

    });
  

});

$(document).ready(function() {
  
  
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

});



function qty_parameter(qty){

   var ItemCode = $("#ItemCodeId"+qty).val();
   var HeadId   = $("#HId"+qty).val();
   var BodyId   = $("#BId"+qty).val();

   var pageName = 'purchaseIndent';

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/finance/get-quality-parameter-by-item') }}",

            data: {ItemCode:ItemCode,pageName:pageName,HeadId:HeadId,BodyId:BodyId}, // here $(this) refers to the ajax object not form

            success: function (data) {


            var data1 = JSON.parse(data);

            var dataLen = data1.data.length;

            console.log('len', dataLen);

            if (data1.response == 'error') {

              $('#quality_parametr'+qty).modal('hide'); 
              $('#MsgShow'+qty).removeClass('showMsg');
              console.log('show message');

            }else if(data1.response == 'success'){



              if(dataLen < 0){

                $('#quality_parametr'+qty).modal('hide');
                $('#MsgShow'+qty).removeClass('showMsg');  

              }else{
                          $('#MsgShow'+qty).addClass('showMsg');
                          $('#qua_par_'+qty).empty();
                          $('#footer_quality_btn'+qty).empty();
                          // $('#footer_qaulity_btn'+qty).empty();
                          //  $('#footer_ok_btn'+qty).empty();


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);

                        var sr_no=1;
                          $.each(data1.data, function(k, getData) {

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.ICATG_CODE+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+data1.ITEM_CODE+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+getData.IQUA_CHAR+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_decs_"+qty+"_"+sr_no+"' name='iqua_desc[]' class='form-control inputtaxInd' value="+getData.IQUA_DESC+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent inputtaxInd' value="+getData.CHAR_FROMVALUE+" readonly></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent inputtaxInd' value="+getData.CHAR_TOVALUE+" readonly></div></div> ";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });

                          var butn =  $('#footer_quality_btn'+qty).find(':button').html();

                          console.log('butn',butn);

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = " <button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+qty+"' onclick='getvalue("+qty+",1)' > <i class='fa fa-check-circle-o' aria-hidden='true'></i> &nbsp; Ok</button>";

                           $('#footer_quality_btn'+qty).append(tblData);

                         }else{
                          
                         }


                        }

                    }
           
            
            },

        });



  }






</script>

<script type="text/javascript">
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

<script type="text/javascript">
  
  $('#btnpdf').click(function(){

          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var item_code =  $('#item_code').val();
         
          var vr_num =  $('#vr_num').val();


          var plantCodeOperator         =  '';
          var plantCodeValue    =  '';
          var seriesCodeOperator        =  '';
          var seriesCodeValue   =  '';
          var profitCenterOperator          =  '';
          var profitCenterValue     =  '';
          var departmentOperator      =  '';
          var departmentValue =  '';
          var employeeOperator       =  '';
          var employeeValue  =  '';
          var QtyOperator        =  '';
          var QtyValue   =  '';
          var OtherDetailsId  =  '';
          var OtherDetValueId =  '';

        
          

          if (item_code!='' || from_date!='' || to_date!='' || vr_num!='' || plantCodeOperator=='' || plantCodeValue=='' || seriesCodeOperator=='' || seriesCodeValue=='' || profitCenterOperator=='' || profitCenterValue=='' || departmentOperator=='' || departmentValue=='' || employeeOperator=='' || employeeValue=='' || QtyOperator=='' || QtyValue=='' || OtherDetailsId=='' || OtherDetValueId=='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_item_code').html('');
            $('#show_err_trans').html('');

            if(from_date!=''){
              if(to_date==''){
                $('#show_err_to_date').html('Please select to date').css('color','red');
                return false;
              }
            }

            if(to_date!=''){
              if(from_date==''){
                $('#show_err_from_date').html('Please select from date').css('color','red');
                return false;
              }
            }

            
                            $.ajaxSetup({
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                              });

                             $.ajax({

                                url:"{{ url('/report/purchase-indent/pdf') }}",

                                method : "POST",

                                type: "GET",

                                data: {plantCodeOperator:plantCodeOperator,plantCodeValue:plantCodeValue,seriesCodeOperator:seriesCodeOperator,seriesCodeValue:seriesCodeValue,profitCenterOperator:profitCenterOperator,profitCenterValue:profitCenterValue,departmentOperator:departmentOperator,departmentValue:departmentValue,employeeOperator:employeeOperator,employeeValue:employeeValue,QtyOperator:QtyOperator,QtyValue:QtyValue,OtherDetailsId:OtherDetailsId,OtherDetValueId:OtherDetValueId,item_code:item_code,vr_num:vr_num,from_date:from_date,to_date:to_date},

                                

                                success: function(response){

                                 console.log('response',response);

                                  if(response.response == 'success' && response.data !=''){

                                      var link = document.createElement('a');
                                      link.href = response.url;
                                      link.download = 'purchase indent.pdf';
                                      link.dispatchEvent(new MouseEvent('click'));


                                  }else{
                                    alert('no data');
                                  }

                                   

                                }, 

                                
                          });

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            
          }


        });
</script>

@endsection