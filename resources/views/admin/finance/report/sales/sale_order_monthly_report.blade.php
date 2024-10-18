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

            Sales Order Monthly Report
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">Sales</a></li>

            <li class="active"><a href="{{ url('/report/purchase/purchase-quotation-report') }}">Sales Order Rep.</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Sales Order Monthly Report</h2>


            </div><!-- /.box-header -->

            <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

              <div class="row">

                <div class="col-md-3"></div>

                <div class="col-md-3">

                   <div class="form-group">

                    <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                        $ToDate= date("d-m-Y", strtotime($toDate));   ?>

                      <label for="exampleInputEmail1"> From Date : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                       
                        <input type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Select Transaction Date" value="{{$FromDate}}" autocomplete="off">

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

                        <input type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Select Transaction Date" value="{{$ToDate}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_to_date">

                      </small>

                  </div>

                 </div>

                 

                 <!-- /.col -->

                <!-- <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Acc Code :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="accList" id="acc_code" name="acc_code" class="form-control  pull-left rightcontent" value="{{ old('acc_code')}}" placeholder="Enter Acc. Code" autocomplete="off">


                          <datalist id="accList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($acc_list as $key)


                            <option value='< ?php echo $key->ACC_CODE; ?>'   data-xyz ="< ?php echo $key->ACC_NAME; ?>" >< ?php echo $key->ACC_CODE; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div> --><!-- /.col -->

                <!--  <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Item Code :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="itemList" id="item_code" name="item_code" class="form-control  pull-left rightcontent" value="{{ old('item_code')}}" placeholder="Enter Item Code" autocomplete="off">


                          <datalist id="itemList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($item_list as $key)

                            

                            <option value='< ?php echo $key->ITEM_CODE?>'   data-xyz ="< ?php echo $key->ITEM_CODE; ?>" >< ?php echo $key->ITEM_CODE; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div> -->

              </div><!-- /.row -->



              <div class="row">

               <!-- <div class="col-md-4">

                 
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

                </div> -->
                <div class="col-md-4"></div>
                <div class="col-md-4" style="margin-top: 10px;">

                  
              <!--  <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button> -->

               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#QueryModal" id="summrybtn"><i class="fa fa-hourglass" aria-hidden="true"></i> &nbsp;&nbsp;Summary</button>

                <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

               <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#QueryModal"><i class="fa fa-hourglass" aria-hidden="true"></i> &nbsp;&nbsp;Query</button>

                <button class="btn btn-primary" id="PindReprtExl"  onclick="excelReportBtn('excel')" disabled=""><i class="fa fa-file-excel-o" aria-hidden="true"></i> <b>Excel</b></button> -->

                 <button type="button" class="btn btn-primary" name="searchdata" onclick="excelReportBtn('month')" disabled="" id="excelbtn"><i class="fa fa-calendar" aria-hidden="true"></i> &nbsp;&nbsp;Excel</button>


                </div>


              </div>


              <div class="col-md-4"></div>

            </div><!-- /.box-body -->



            <div class="box-body" style="margin-top: 4%;">

<table id="example" class="table table-bordered table-striped table-hover">
 <!--  <thead class="theadC">

    

    <tr>
			<th>ACC NAME</th>
			<th>ACC CODE</th>
			<th>ITEM_CODE </th>
			<th>ITEM_NAME </th>
			<th>ACC NAME</th>
			<th>ACC CODE</th>
			<th>ITEM_CODE </th>
			<th>ITEM_NAME </th>
			<th>ACC NAME</th>
			<th>ACC CODE</th>
			<th>ITEM_CODE </th>
			<th>ITEM_NAME </th>	
			

     	
    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody> -->
 
 

 <!-- <body>
		<div class="container">
			<table id="example" class="display" width="100%">
			</table>
		</div>
	</body> -->
</table>



</div><!-- /.box-body -->

           

          </div>

  </section>

</div>



   {{--****** Start : Query Model ******--}}


  <div class="modal fade" id="QueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="width:55%;">
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
              
             <div class="col-md-6">


                      <div class="input-group">

                          <input type="radio" id="date" name="radiobtn" class="pull-left rightcontent radioBtn" value="date" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>DATE</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                 

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                  
                      <div class="input-group">

                          <input type="radio" id="series_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="series code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>SERIES CODE</b>

                      </div>


                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>
              
            </div>

            <div class="row">
              
             <div class="col-md-6">

                  <div class="form-group">


                      <div class="input-group">

                          <input type="radio" id="month" name="radiobtn" class="pull-left rightcontent radioBtn" value="month" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>MONTH</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                     <div class="input-group">

                          <input type="radio" id="acc_code1" name="radiobtn" class="pull-left rightcontent radioBtn" value="acc code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>ACC CODE</b>

                      </div>


                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>
              
            </div>

            <div class="row">
              
             <div class="col-md-6">

                  <div class="form-group">

                      
                        <div class="input-group">

                          <input type="radio" id="tax_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="tax code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>TAX CODE</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                       <div class="input-group">

                          <input type="radio" id="area_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="area code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>AREA CODE</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>
              
            </div>

            <div class="row">
              
             <div class="col-md-6">

                  <div class="form-group">

                      
                        <div class="input-group">

                          <input type="radio" id="area_acc_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="area acc code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>AREA CODE AND ACC CODE</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                       <div class="input-group">

                          <input type="radio" id="item_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="item code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>ITEM CODE</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>
              
            </div>

            <div class="row">
              
             <div class="col-md-6">

                  <div class="form-group">

                      
                        <div class="input-group">

                          <input type="radio" id="acc_item_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="acc item code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>ACC CODE AND ITEM CODE</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                       <div class="input-group">

                          <input type="radio" id="area_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="item code acc code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>ITEM CODE AND ACC CODE</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>
              
            </div>

            <div class="row">
              
             <div class="col-md-6">

                  <div class="form-group">

                      
                        <div class="input-group">

                          <input type="radio" id="acc_item_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="acc item code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>AREA CODE AND ITEM CODE</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                       <div class="input-group">

                          <input type="radio" id="area_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="area code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b> AREA CODE AND ACC CODE AND ITEM CODE</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>
              
            </div>


            <div class="row">
              
             <div class="col-md-6">

                  <div class="form-group">

                      
                        <div class="input-group">

                          <input type="radio" id="acc_item_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="acc item code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>AREA CODE AND ITEM CODE AND ACC CODE</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>

                <div class="col-md-6">

                  <div class="form-group">

                       <div class="input-group">

                          <input type="radio" id="area_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="item code month" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>ITEM CODE AND MONTH</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>
              
            </div>

            <div class="row">
              
             
                <div class="col-md-6">

                  <div class="form-group">

                       <div class="input-group">

                          <input type="radio" id="area_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="acc code month" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>ACC CODE AND MONTH</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>

                 <div class="col-md-6">

                  <div class="form-group">

                      
                        <div class="input-group">

                          <input type="radio" id="acc_item_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="acc item code month" autocomplete="off">&nbsp;&nbsp;&nbsp;<b> ACC CODE AND ITEM CODE AND MONTH</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>
              
            </div>

            <div class="row">
              
            

                <div class="col-md-6">

                  <div class="form-group">

                       <div class="input-group">

                          <input type="radio" id="area_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="item acc code month" autocomplete="off">&nbsp;&nbsp;&nbsp;<b>ITEM CODE AND ACC CODE AND MONTH</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>

                 <div class="col-md-6">

                  <div class="form-group">

                      
                        <div class="input-group">

                          <input type="radio" id="acc_item_code" name="radiobtn" class="pull-left rightcontent radioBtn" value="cost code" autocomplete="off">&nbsp;&nbsp;&nbsp;<b> COST CODE</b>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>
              
            </div>


            

          </section>  
        </div>
        <div class="modal-footer" style='text-align:center;'>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close &nbsp;&nbsp;<i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
          <button type="button" id="ProceedBtnId" class="btn btn-primary">Proceed &nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>


  {{--****** End : Query Model ******--}}



  {{--**** Start : Quality Parameter Model ****--}}

    <div id="quaPdomModel_2">
         
    </div>


    {{--**** End : Quality Parameter Model ****--}}



@include('admin.include.footer')



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


  function accQueryOperator(getVal){

    var accCodeValue =  $('#accCode').val();
    

    if(accCodeValue == '' && getVal !=''){
      $("#accCode").attr("readonly", false);
      $("#ProceedBtnId").attr("", true);
    }else if(accCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#accCode").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#accCode").val('');
    }

  }

  function accQueryValue(accCodeValue){

    var getVal =  $('#accCodeOperator').val();

    if(getVal == '' && accCodeValue !=''){
      $("#accCodeValue").attr("readonly", false);
      $("#ProceedBtnId").attr("disabled", true);
    }else if(accCodeValue != '' && getVal !=''){
      $("#ProceedBtnId").attr("disabled", false);
    }else{
      $("#accCodeValue").attr("readonly", true);
      $("#ProceedBtnId").attr("disabled", true);
      $("#accCodeValue").val('');
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
  //employeeValue


  function excelReportBtn(type){

          var from_date  = $("#from_date").val();
          var to_date    = $("#to_date").val();
       /*   var item_codes = $("#item_code").val();
          var acc_codes  = $("#acc_code").val();*/


 var codes = $('input[name=radiobtn]:checked').val();

 //alert(code);return false;
         /* var pendingId  =  $('#pendingId').is(":checked");
          
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
            ReportTypes = '0';
          }*/


        //  alert(ReportTypes);return false;



   if(codes == ''){
      code = 0;
   }else{
    code = codes;
   }


   

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });


      window.location.href = "{{ url('/report/sale/sale-monthly-order/sale-monthly-order-excel/') }}"+'/'+from_date+'/'+to_date+'/'+code;
        /*const win = window.open(
            "{{ url('/report/purchase/purchase-indent/purchase-indent-report-excel/') }}"+'/'+vr_num);
        const timer = setInterval(() => {
          if (win.closed) {
            clearInterval(timer);
            console.log('close');
            //alert('"Secure Payment" window closed!');
          }
        }, 500);*/
      

        /*$.ajax({
            type: 'GET',
            url: "{{ url('/report/purchase/purchase-indent/purchase-indent-report-excel') }}",

            data: {from_date:from_date,to_date:to_date,vr_num:vr_num,item_code:item_code,plantCodeOperator:plantCodeOperator,plantCodeValue:plantCodeValue,seriesCodeOperator:seriesCodeOperator,seriesCodeValue:seriesCodeValue,profitCenterOperator:profitCenterOperator,profitCenterValue:profitCenterValue,departmentOperator:departmentOperator,departmentValue:departmentValue,employeeOperator:employeeOperator,employeeValue:employeeValue,QtyOperator:QtyOperator,QtyValue:QtyValue}, 
            success: function(data){

                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(data);
                link.download = `Invoice_details_report.xlsx`;
                link.click();
            },

            fail: function(data) {
                console.log('fail',  data);
            }

        })*/

  }

</script>


<!-- <script type="text/javascript">

load_data_query1();

var columns = [];  // Create an empty array for the columns option

 function load_data_query1(from_date='',to_date='',item_code='',acc_code='',series_code='') {

    $.ajax({
      url: '{{ url("/get-data-from-query-monthly-sales-quotation") }}',
      data: {from_date:from_date,to_date:to_date,item_code:item_code,acc_code:acc_code,series_code:series_code},  // All of the data from the server is return, used on;y for this example
      success: function (data) {
        
     

        //columnNames = Object.keys(data.data[0]);
        
        console.log('datacolumn',columnNames);
        // Iterate each of the columnNames to build the columns.data and columns.title optins
        for (var i in columnNames) {
          
          // Push the {data: ..., title: ...} onto array
          columns.push({data: columnNames[i],name: columnNames[i], 
                    title: columnNames[i]});

          /*columns[i] = {
            'title': columnNames[i],
            'data': columnNames[i]
        }*/
        }
        

        console.log('datacolumn',columns);
        // Once columns array is built init server side Datatables
	    $('#example1').DataTable( {
		    processing: true,
		    serverSide: true,
		    scrollX: true,
		    ajax: '{{ url("/get-data-from-query-monthly-sales-quotation") }}',
		    data: {from_date:from_date,to_date:to_date,item_code:item_code,acc_code:acc_code,series_code:series_code},
		    columns: columns,
		    //data: columns,
	
	    } );
      }
    });
}

</script> -->

<script type="text/javascript">

load_data_query();
var columns = []; 
var columnNames = [];

//$('#example').DataTable().destroy();

  function load_data_query(from_date='',to_date='',code=''){

    //alert(code);

    var getcomName = '<?php echo Session::get('company_name'); ?>';
    var getFY      = '<?php echo Session::get('macc_year'); ?>';
    var getnewdate = new Date();
    var getday = getnewdate.getDate();
    var getMonth = getnewdate.getMonth()+1;
    var getYear = getnewdate.getFullYear();


    var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

    var getdate = getday+''+getMonth+''+getYear;

    /*console.log('from_date',from_date);
    console.log('to_date',to_date);
    console.log('bank_code',bank_code);
    console.log('acct_code',acct_code);
    console.log('vr_num',vr_num);
    console.log('AmountValueId',AmountValueId);*/

   

   /* var column_titles = table.column_titles.map(function(header) {
      console.log(column_titles);
                return {

                    'title': column_titles
                };
            });*/

     //$('#example').DataTable().destroy();

      

            
      $.ajax({
      url: '{{ url("/get-data-from-query-monthly-sales-order") }}',
      data: {from_date:from_date,to_date:to_date,code:code}, 

             
         success: function (data) { 

           
          //$('#example').DataTable().draw();

        
         console.log('datacolumn',data.data[0]);

         
         	columnNames = Object.keys(data.data[0]);
         


         for (var i in columnNames) {
          
          // Push the {data: ..., title: ...} onto array
          columns.push({data: columnNames[i],name: columnNames[i], 
                    title: columnNames[i]});

          /*columns[i] = {
            'title': columnNames[i],
            'data': columnNames[i]
        }*/
        }

      
       // $('#example').empty(); 
     
  /*var table = $('#example');
          if ($.fn.DataTable.isDataTable(table)) {
            $('#example').DataTable().destroy();
            $('#example').empty();
          }*/
 //$('#example').DataTable().draw();

 // $("#example").DataTable().clear().destroy();

   var table = $('#example').DataTable({

        

          processing: true,
          serverSide: true,
          scrollX: true,
         // retrieve: true,
          
        //  dom: "Bfrtip",
        //  destroy: true,
          pageLength:'25',
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
          
          buttons: [
                      /*{
                        extend: 'excelHtml5',
                        filename: 'PQR_'+getdate+'_'+gettime,
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9]
                        }
                      },
                      {
                        extend: 'pdfHtml5',
                        filename: 'PQR_'+getdate+'_'+gettime,
                        title: getcomName,
                        exportOptions: {
                              columns: [0,1,2,3,4,5,6,7,8,9]
                        },
                        
                      },*/
                      
                    ],
         
          ajax:{
            url:'{{ url("/get-data-from-query-monthly-sales-order") }}',
            data: {from_date:from_date,to_date:to_date,code:code}

          
        },
         

        columns: columns
        
      });

    $("#summrybtn").prop('disabled',true);
    $("#excelbtn").prop('disabled',false);
 
  }


  });


   }
  
/*getQuaParData*/
  $(document).ready(function() {

    $('#lastUpdateValueId').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });


    $('#ProceedBtnId').click(function(){


           
            var code      = $('input[name=radiobtn]:checked').val();
            
            var from_date = $('#from_date').val();
            
            
            var to_date   = $('#to_date').val();



         //   alert(from_date);return false;
           
            /*var plantCodeValue       =  $('#plantCodeValue').val();
            
            var seriesCodeOperator   =  $('#seriesCodeOperator').val();
            
            var seriesCodeValue      =  $('#seriesCodeValue').val();
            
            var profitCenterOperator =  $('#profitCenterOperator').val();
            var profitCenterValue    =  $('#profitCenterValue').val();
            
            var QtyOperator          =  $('#QtyOperator').val();
            var QtyValue             =  $('#QtyValue').val();
            
            var accCodeOperator      =  $('#accCodeOperator').val();
            var accCode              =  $('#accCode').val();
            
            var pendingId            =  $('#pendingId').is(":checked");
            
            var CompleteId           =  $('#CompleteId').is(":checked");
            
            var allId                =  $('#allId').is(":checked");*/
            
           /* var ReportTypes;
            
            if(pendingId){
            ReportTypes    = $('#pendingId').val();
            }else if(CompleteId){
            ReportTypes    = $('#CompleteId').val();
            }else if(allId){
            ReportTypes    = $('#allId').val();
            }else{
            ReportTypes    = 'Not Found';
            }
*/

            //alert(ReportTypes);return false;

/*
        $('#plantCodeOperators').val(plantCodeOperator);
        $('#plantCodeValues').val(plantCodeValue);
        $('#seriesCodeOperators').val(seriesCodeOperator);
        $('#seriesCodeValues').val(seriesCodeValue);
        $('#profitCenterOperators').val(profitCenterOperator);
        $('#profitCenterValues').val(profitCenterValue);
        $('#QtyOperators').val(QtyOperator);
        $('#QtyValues').val(QtyValue);
        $('#accCodeOperators').val(accCodeOperator);
        $('#accCodes').val(accCode);
        $('#reportTypes').val(accCode);

     var from_date = '';
     var to_date = '';
     var bank_code = '';
     var item_code = '';
     var vr_num = '';*/
   

    // var from_date = '';
    // var to_date = '';
     var item_code = '';
     //var acc_code = '';


            $("#from_date").prop('readonly',true);
      $("#to_date").prop('readonly',true);        
      $("#acct_code").prop('readonly',true);
      $("#vr_num").prop('readonly',true);
      $("#btnsearch").prop('disabled',true);

   
      if (series_code!='') {
            

      	//	$('#example').empty(); 
         /* $('#example').DataTable().clear().destroy();
            $('#PurchaseIndentReportTable').DataTable().destroy();
          setTimeout(function () {
                     
                 }, 100);*/
        //$('#example').DataTable().clear()



load_data_query(from_date,to_date,code);
          

          $('#QueryModal').modal('hide');
          $('#recordNumberId').val('');
          $('#recordNumberValueId').val('');
          $('#plantCodeOperator').val('');
          $('#plantCodeValue').val('');
          $('#seriesCodeOperator').val('');
          $('#seriesCodeValue').val('');
          $('#profitCenterOperator').val('');
          $('#profitCenterValue').val('');
          $('#QtyOperator').val('');
          $('#QtyValue').val('');
          $('#accCodeOperator').val('');
          $('#accCode').val('');
         

      }else{

          $('#PurchaseIndentReportTable').DataTable().destroy();

          load_data_query();

         $('#QueryModal').modal('hide');
          $('#recordNumberId').val('');
          $('#recordNumberValueId').val('');
          $('#plantCodeOperator').val('');
          $('#plantCodeValue').val('');
          $('#seriesCodeOperator').val('');
          $('#seriesCodeValue').val('');
          $('#profitCenterOperator').val('');
          $('#profitCenterValue').val('');
          $('#QtyOperator').val('');
          $('#QtyValue').val('');
          $('#accCodeOperator').val('');
          $('#accCode').val('');
         
      }


    });


    $('#btnsearch').click(function(){

          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var acc_code =  $('#acc_code').val();

          var item_code =  $('#item_code').val();
         
         // var vr_num =  $('#vr_num').val();

          

          if (from_date!='' || to_date!='' || item_code=='' || acc_code!='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
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

            load_data_query(from_date,to_date,item_code,acc_code);

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            
          }


        });


    $('#ResetId').click(function(){

       /*$('#example').DataTable().destroy();
       $('#example').dataTable().fnClearTable();*/
       location.reload(true);
     // load_data_query();
  
      $('#bank_code').val('');
      
      $('#item_code').val('');
      $('#vr_num').val('');
      $('#accountText').html('');


      $("#from_date").prop('readonly',false);
      $("#to_date").prop('readonly',false);        
      $("#acct_code").prop('readonly',false);
      $("#vr_num").prop('readonly',false);
      $("#btnsearch").prop('disabled',false);
     

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

   //console.log('ItemCode => ',ItemCode);


    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/finance/get-quality-parameter-by-purchase-enquery-report') }}",

            data: {ItemCode:ItemCode}, // here $(this) refers to the ajax object not form

            success: function (data) {


            var data1 = JSON.parse(data);

            $('#qua_par_'+qty).empty();

            if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

            }else if(data1.response == 'success'){

              if(data1.data==''){

              }else{

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
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.item_category+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+data1.item_code+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control inputtaxInd' value="+getData.iqua_char+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_decs_"+qty+"_"+sr_no+"' name='iqua_desc[]' class='form-control inputtaxInd' value="+getData.iqua_desc+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent inputtaxInd' value="+getData.char_fromvalue+" readonly></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent inputtaxInd' value="+getData.char_tovalue+" readonly></div></div> ";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });

                          var butn =  $('#footer_quality_btn'+qty).find(':button').html();

                          //console.log('butn',butn);

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



  function showCalTax(srNo,headid,bodyId){

      var headid,bodyId;

        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

        });

        $.ajax({

              url:"{{ url('/get-calTax-for-salequo-reports') }}",

               method : "POST",

               type: "JSON",

               data: {headid:headid,bodyId:bodyId},

               success:function(data){

                  var data1 = JSON.parse(data);

                 // console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{
                        var obj_row = data1.data;
                        var obj_row1 = data1.tax_code;

                       // console.log('taxC => ',obj_row1[0].TAX_CODE);

                        $('#showTaxCode').html('');

                        $('#showTaxCode').html(obj_row1[0].TAX_CODE);

                        var srac=1;
                        /*var countAcc= data1.data.length;
                        $('#accCount'+headid+'_'+srNo).html(countAcc);*/
                        $('#getCalTaxData'+srNo).empty();
                        var headData = '<div class="box-row" id="appendbody'+srNo+'"><div class="box10 texIndbox1">Sr.No.</div><div class="box10 rateIndbox">Tax Indicator</div><div class="box10 rateIndbox">Rate Indicator</div><div class="box10 rateIndbox">Rate</div><div class="box10 rateIndbox">Amount</div></div></div>';
                      $('#getCalTaxData'+srNo).append(headData);



                        $.each(obj_row, function (i, obj_row) {




                            var bodyData = '<div class="box-row"><div class="box10 itmdetlheading"><span id="srnum">'+srac+'</span></div><div class="box10 itmdetlheading" style="text-align: left;"><span id="accCode">'+obj_row.TAXIND_NAME+'</span> </div><div class="box10 itmdetlheading"><span id="accName"> '+obj_row.RATE_INDEX+'</span></div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.TAX_RATE+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.TAX_AMT+'</span> </div></div>';

                            srac++;
                            $('#getCalTaxData'+srNo).append(bodyData);
                        });
                      }
                      
                  }
               }

          });
    }


    function showQuaParDetails(srNo,headid,bodyId){

        var headid,bodyId;

            $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

        $.ajax({

              url:"{{ url('/get-qua-sale-reports') }}",

               method : "POST",

               type: "JSON",

               data: {headid:headid,bodyId:bodyId},

               success:function(data){

                  var data1 = JSON.parse(data);

                 // console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       

                      }else{
                        var obj_row = data1.data;
                        var srac=1;
                        
                        //$('#showItemName').html();
                        /*var countAcc= data1.data.length;
                        $('#accCount'+headid+'_'+srNo).html(countAcc);*/
                        $('#getQuaParData'+srNo).empty();
                        var headData = '<div class="box-row" id="appendbody'+srNo+'"><div class="box10 texIndbox1">Sr.No.</div><div class="box10 rateIndbox">Item Category</div><div class="box10 rateIndbox">Quality Char</div><div class="box10 rateIndbox">Description</div><div class="box10 rateIndbox">From Value</div><div class="box10 rateIndbox">To Value</div></div></div>';
                      $('#getQuaParData'+srNo).append(headData);

                        $.each(obj_row, function (i, obj_row) {

                          $('#showItemCode').html('');
                          //console.log('itemC => ',obj_row.ITEM_CODE);
                          $('#showItemCode').html(obj_row.ITEM_CODE);

                            var bodyData = '<div class="box-row"><div class="box10 itmdetlheading"><span id="srnum">'+srac+'</span></div><div class="box10 itmdetlheading" style="text-align: left;"><span id="accCode">'+obj_row.  ICATG_CODE+'</span> </div><div class="box10 itmdetlheading"><span id="accName"> '+obj_row.IQUA_CHAR+'</span></div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.IQUA_DESC+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.CHAR_FROMVALUE+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.CHAR_TOVALUE+'</span> </div></div>';

                            srac++;
                            $('#getQuaParData'+srNo).append(bodyData);
                        });
                      }
                      
                  }
               }

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

@endsection