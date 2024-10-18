@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')
<style type="text/css">

    .tooltip{f
      color: #66CCFF !important;
    }

  .PageTitle{
    margin-right: 1px !important;
  }

  .required-field::before {
    content: "*";
    color: red;
  }

  .onFocusBorder{
    border-color: red !important;
  }

  .onFacusSelectMulti{
    border: 1px solid red !important;
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

            Dynamic Query
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li class="active"><a href="{{ url('/report/purchase/purchase-contract-report') }}">Dynamic Query</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Make Dynamic Query</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('/Report/View-Dynamic-query-report') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Dynamic Query</a>

              </div>
            </div><!-- /.box-header -->

            <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

              <div class="row">
               
                <div class="col-md-3">

                   <div class="form-group">

                      <label for="exampleInputEmail1">Transaction : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>



                           <input list="tranList" id="tran_code" name="tran_code" class="form-control  pull-left" value="{{ old('tran_code')}}" onchange="transCodeJS();" placeholder="Select Transaction" autocomplete="off" readonly>

                          <datalist id="tranList">

                          @foreach ($tran_list as $key)
                            <option value='<?php echo $key->TRAN_CODE ?>'   data-xyz ="<?php echo $key->TRAN_CODENAME; ?>" ><?php echo $key->TRAN_CODENAME ; echo " [".$key->TRAN_CODE ."]" ; ?></option>
                          @endforeach

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName1" id="transName" style="color:#5d9abd;font-weight:700;"></div>

                     </small>

                     <small id="show_err_acct_code">

                        <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                     </small>

                  </div>

                  
                </div><!-- /.col -->

                <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Query Name : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="queryList" id="queryName" name="queryName" class="form-control  pull-left" value="" onchange="transCodeJS();" placeholder="Enter Query Name" autocomplete="off" readonly>

                          <datalist id="queryList">

                            <option selected="selected" value="">-- Select --</option>

                          </datalist>

                      </div>
                      <input type="hidden" id="queryNameWS">

                    </div>

                </div><!-- /.col -->

                <div class="col-md-3">

                   <div class="form-group">

                      <label for="exampleInputEmail1">Report Name : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>



                           <input list="reportList" id="report_name" name="report_name" class="form-control  pull-left" value="{{ old('report_name')}}" placeholder="Select Report Name" autocomplete="off" readonly>

                          <datalist id="reportList">

                            <option  value="ALL-TRAN" data-xyz ="ALL-TRAN">
                              ALL TRAN
                            </option> 
                            <option  value="USER-SPECIFIC" data-xyz ="USER-SPECIFIC">
                              USER SPECIFIC
                            </option>

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName1" id="accountText1"></div>

                     </small>

                  </div>

                  
                </div><!-- /.col -->

                <div class="col-md-3">

                   <div class="form-group">

                      <label for="exampleInputEmail1">User List :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>



                           <input list="userList" id="user_name" name="user_name" class="form-control  pull-left" value="{{ old('user_name')}}" placeholder="Select User" autocomplete="off" disabled="true" onchange="getUserName(this.value)">

                          <datalist id="userList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($user_list as $key)

                            <option value='<?php echo $key->USER_NAME ?>'   data-xyz ="<?php echo $key->USER_NAME; ?>" ><?php echo $key->USER_NAME ; echo " [".$key->USER_NAME ."]" ; ?></option>

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName1" id="accountText1"></div>

                     </small>

                  </div>

                  
                </div><!-- /.col -->

              </div>

              <div class="row">

                <div class="col-md-3">

                   <div class="form-group">

                      <label for="exampleInputEmail1">PFCT : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>



                           <input list="pfctList" id="pfct" name="pfct" class="form-control  pull-left" value="{{ old('pfct')}}" placeholder="Select PFCT" autocomplete="off">

                          <datalist id="pfctList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($pfct_list as $key)

                            <option value='<?php echo $key->PFCT_CODE ?>'   data-xyz ="<?php echo $key->PFCT_NAME; ?>" ><?php echo $key->PFCT_NAME ; echo " [".$key->PFCT_CODE ."]" ; ?></option>

                            @endforeach

                          </datalist>

                      </div>

                      <small id="pfctText" style="color:#5d9abd;font-weight: 700;">  </small>
                  </div>

                  
                </div><!-- /.col -->

                <div class="col-md-3">

                   <div class="form-group">

                      <label for="exampleInputEmail1">PLANT : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>



                           <input list="plantList" id="plant" name="plant" class="form-control  pull-left" value="{{ old('plant')}}" placeholder="Select PLANT" autocomplete="off">

                          <datalist id="plantList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($plant_list as $key)

                            <option value='<?php echo $key->PLANT_CODE ?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME; echo " [".$key->PLANT_CODE."]" ; ?></option>

                            @endforeach

                          </datalist>

                      </div>

                      <small id="plantText" style="color:#5d9abd;font-weight:700">  </small>

                  </div>

                  
                </div><!-- /.col -->

                <div class="col-md-3">

                   <div class="form-group">

                    <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                        $ToDate= date("d-m-Y", strtotime($toDate));   ?>

                      <label for="exampleInputEmail1"> From Date : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                        <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
                       
                        <input type="text" name="from_date" id="from_date" class="form-control fromDatePc rightcontent" placeholder="Select Transaction Date" value="{{$FromDate}}" autocomplete="off" onchange="fromDt(this.value)">

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

                        <input type="text" name="to_date" id="to_date" class="form-control toDatePc rightcontent" placeholder="Select Transaction Date" value="{{$ToDate}}" autocomplete="off" onchange="getToDt(this.value)">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_to_date">

                      </small>

                  </div>

                 </div>

              </div><!-- /.row -->

              <div class="row">
                <div class="col-md-3">
                   
                    <div>
                      <button class="btn btn-success" type="button" id="submitdata" disabled onclick="tranName(1)"><i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp; Search</button>

                      <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reset</button>

                    </div>

                </div>
              </div>


            </div><!-- /.box-body -->



          </div>

          <div class="box box-warning Custom-Box">

            <div class="box-body">

               <form id="dynamicQueryTran">
                @csrf

                <div class="row">
                  
                  <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail01"> GROUP 1 : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                           <input list="grpOneList" id="groupOne" name="group1[]" class="form-control" value="{{ old('group1')}}" placeholder="Select Fields" readonly autocomplete="off" onchange="getGrouOne(this.value)">

                          <datalist id="grpOneList">

                            <option selected="selected" value="">-- Select --</option>

                          </datalist>

                        </div>
                        <input type="hidden" id="grponeAlies" >
                        <input type="hidden" id="tblNamefirst" >
                        <small id="groupOneErr" style="color: red;"></small>

                    </div>




                 </div>

                 <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1"> GROUP 2 : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                           <input list="grpTwoList" id="groupTwo" name="group2[]" class="form-control" value="{{ old('group2')}}" placeholder="Select Fields" readonly autocomplete="off" onchange="getGroupTwo(this.value)">

                          <datalist id="grpTwoList">

                            <option selected="selected" value="">-- Select --</option>

                          </datalist>

                        </div>
                        <input type="hidden" id="grpTwoAlies">
                        <input type="hidden" id="tblNameTwo">
                        <small id="groupTwoErr" style="color: red;"></small>

                    </div>

                 </div>

                 <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1"> GROUP 3 : <span class="required-field"></span></label>

                      <div id="charFidDiv">
                        {{-- <select class="allcheckbox form-control" multiple="" id="charField" name="charfield[]" disabled="true" autocomplete="off" onchange="getChrField(this.value)">
                        </select> --}}
                         <input type="text" class="inputboxclr form-control" id="charField" onclick="getMultiColName(1);" readonly name="charfield[]" readonly="true" autocomplete="off"/>
                      </div>

                      <input type="hidden" id="groupT_col">
                      <input type="hidden" id="groupT_table">

                      <small id="groupThreeErr" class="form-text text-muted" style="color:red;">
                      </small>

                    </div>

                 </div>

                 <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1"> Data Columns : <span class="required-field"></span></label>

                       
                         <input type="text" class="inputboxclr form-control" id="groupThree" onclick="getDataColm(1);" name="group3[]" readonly autocomplete="off"/>

                         <input type="hidden" id="dataCol_col">
                         <input type="hidden" id="dataCol_table">
                      <small id="dataColumnErr" class="form-text text-muted" style="color:red;">
                      </small>

                    </div>

                 </div>
                 

                </div>

                <input type="hidden" name="tCodeHide" id="tCodeHide" value="" />
                <input type="hidden" name="reportNameHide" id="reportNameHide" value="" />
                <input type="hidden" name="usrHide" id="usrHide" value="" />
                <input type="hidden" name="pfctHide" id="pfctHide" value="" />
                <input type="hidden" name="plantHide" id="plantHide" value="" />
                <input type="hidden" name="fromDtHide" id="fromDtHide" value="" />
                <input type="hidden" name="toDtHide" id="toDtHide" value="" />

                <input type="hidden" id="hiddenColName" value="" name="hiddenColName[]">
                <small id="showcreatedQuery" style="font-size: 17px;font-weight: 600;display:none;"></small>
                <p class="text-center">

                  <button class="btn btn-success" type="button" id="submitdataOne" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Create & Download</button>

                  <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Reset</button>

                </p>


      {{-- START : get Char Fileds Column : Modal --}}

          <div id="taxSelectModel1" class="modal fade" tabindex="-1">

            <div id="modalLen" class="modal-dialog" style="margin-top: 5%;">

                <div class="modal-content" style="border-radius: 5px;">

                    <div class="modal-header">

                      <div class="row">

                        <h5 class="modal-title modltitletext" id=""  style="font-weight: 800;text-align: center;margin-left: -1%;">Select Character Fields</h5>

                      </div>

                    </div>

                    <div class="modal-body table-responsive">

                        <div  style="line-height: 23px;">

                          <div class="col-sm-12">
                            <div class="row" id="showtaxcodeMul1" style="line-height: 0.3 !important;">
                              
                            </div>
                          </div>
                          
                        </div>

                    </div>

                    <div class="modal-footer" style="text-align: center;" id="taxCodeSelect1">

                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="selectColumnData(1);" style="width: 83px;">Ok</button>   

                    </div>

                </div>

            </div>

          </div>

    {{-- END : get Char Fileds Column : Modal --}}


    {{-- START : get Char Fileds Column : Modal --}}

          <div id="numSelectModel1" class="modal fade" tabindex="-1">

            <div id="modalLenNum" class="modal-dialog" style="margin-top: 5%;">

                <div class="modal-content" style="border-radius: 5px;">

                    <div class="modal-header">

                      <div class="row">

                        <h5 class="modal-title modltitletext" id=""  style="font-weight: 800;text-align: center;margin-left: -1%;">Select Character Fields</h5>

                      </div>

                    </div>

                    <div class="modal-body table-responsive">

                        <div  style="line-height: 23px;">

                          <div class="col-sm-12">
                            <div class="row" id="showNumFields1" style="line-height: 0.3 !important;">
                              
                            </div>
                          </div>
                          
                        </div>

                    </div>

                    <div class="modal-footer" style="text-align: center;" id="taxCodeSelect1">

                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="selectNumColumnData(1);" style="width: 83px;">Ok</button>   

                    </div>

                </div>

            </div>

          </div>

    {{-- END : get Char Fileds Column : Modal --}}

              </form>


            </div>

          </div>

  </section>

</div>



@include('admin.include.footer')



 <script type="text/javascript">

    $(document).ready(function(){

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

      $('.allcheckbox').multiselect({
        nonSelectedText: 'Select',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'100%',
        includeSelectAllOption: true,
        maxHeight: 150

        
      });

      $("#tran_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#tranList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
            $(this).val('');
            $('#transName').html('');
            $('#tran_code').val('');
          }else{
            $('#transName').html(msg);
          }
          filedValidatin();
      });

      $("#report_name").bind('change', function () {

          var val = $(this).val();

          var xyz = $('#reportList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
            $(this).val('');
          }else{
          }

          var reportVal = $('#report_name').val();

          if(reportVal == 'USER-SPECIFIC'){
            $('#user_name').prop('disabled',false);
          }else{
            $('#user_name').prop('disabled',true);
          }
          filedValidatin();
      });

      $("#pfct").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#pfctList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
          $('#pfctText').html('');
          $('#pfct').val('');
        }else{
          $('#pfctText').html(msg);
        }
        filedValidatin();

      });

      $("#plant").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#plantList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg == 'No Match'){
          $('#plantText').html('');
          $('#plant').val('');
        }else{
          $('#plantText').html(msg);
        }
        filedValidatin();

      });

      $('#queryName').on('input',function(){
          var queryName = $('#queryName').val();
          if(queryName){
            $('#queryName').css('border-color','#d2d6de');
          }else{
            $('#queryName').css('border-color','#ff0000');
          }

          var xyz = $('#queryList option').filter(function() {

            return this.value == queryName;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
          $('#queryNameWS').val(msg);

          filedValidatin();
      });

    });

    function fromDt(fromDtVal){
      filedValidatin();
    }

    function getToDt(fromDtVal){
      filedValidatin();
    }

    function transCodeJS(){
      var tranCode  = $('#tran_code').val();
      var queryName = $('#queryNameWS').val();
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url:"{{ url('Report/get-queryName-against-tCode') }}",
        method : "POST",
        type: "JSON",
        data: {tranCode:tranCode,queryName:queryName},
        success:function(data){
          var data1 = JSON.parse(data);

          if(data1.response == 'error'){

          }else if(data1.response == 'success'){

              if(data1.data_query !=''){
                $.each(data1.data_query, function(k, tblVal){
                  $("#queryList").append($('<option>',{

                    value:tblVal.QUERY_NAME,

                    'data-xyz':tblVal.QUERY_NAME_WSPACE,
                    text:tblVal.QUERY_NAME

                  }));
                });
              }
              console.log('data1.alldata_query',data1.alldata_query);
              if(data1.alldata_query !=''){
                if(tranCode && queryName){
                  $('#user_name,#pfct,#plant').prop('readonly',false);
                  $('#submitdata').prop('disabled',false);
                  $('#report_name').val(data1.alldata_query[0].REPORT_NAME);
                  $('#user_name').val(data1.alldata_query[0].USER_LIST);
                  $('#pfct').val(data1.alldata_query[0].PFTC_CODE);
                  $('#plant').val(data1.alldata_query[0].PLANT_CODE);

                  var fromDate= data1.alldata_query[0].FROM_DATE;
                  var slpiFrDate = fromDate.split('-');
                  var from_Date = slpiFrDate[2]+'-'+slpiFrDate[1]+'-'+slpiFrDate[0];
                  $('#from_date').val(from_Date);

                  var toDate= data1.alldata_query[0].TO_DATE;
                  var slpitoDate = toDate.split('-');
                  var to_Date = slpitoDate[2]+'-'+slpitoDate[1]+'-'+slpitoDate[0];
                  $('#to_date').val(to_Date);
                  filedValidatin();
                }
              }else{
                $('#report_name').val('');
                $('#user_name').val('');
                $('#pfct').val('');
                $('#plant').val('');
               // $('#from_date').val('');
               // $('#to_date').val('');
              }
              
          }
        }
      });

    }

    function tranName(rowID){
      $('#tran_code,#queryName,#user_name,#report_name,#pfct,#plant,#from_date,#to_date').prop('readonly',true);
      var val     = $('#tran_code').val();
      var queryNm = $('#queryNameWS').val();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        url:"{{ url('get-data-from-transaction') }}",
        method : "POST",
        type: "JSON",
        data: {tranName:val,queryNm:queryNm},
        success:function(data){
          var data1 = JSON.parse(data);
          if (data1.response == 'error') {

          }else if(data1.response == 'success'){
            

            if(data1.dynamicQData !=''){
              $('#groupOne').val(data1.dynamicQData[0].GROUP1);
              $('#groupTwo').val(data1.dynamicQData[0].GROUP2);

              var hiddnCol = $('#hiddenColName').val();
              if(hiddnCol == ''){
                $('#hiddenColName').val(data1.dynamicQData[0].GROUP1+','+data1.dynamicQData[0].GROUP2);
              }

              var grpOne = $('#groupOne').val();
              if(grpOne){
                setTimeout(function () {
                  getGrouOne(grpOne);
                }, 500);
              }

              var grpTwo = $('#groupTwo').val();
              if(grpTwo){
                setTimeout(function () {
                  getGroupTwo(grpTwo);
                }, 1000);
              }


               $('#groupOne').prop('readonly',false);
               $('#groupTwo').prop('readonly',false);
            }else{
              $('#groupOne').prop('readonly',false);
              $('#groupOne').css('border-color','#ff0000').focus();
            }
            

            $.each(data1.configTbl, function(k, tblVal){

              $("#grpOneList").append($('<option>',{
                value:tblVal.COLUMN_NAME,
                'data-xyz':tblVal.COLUMN_NAME,
                text:tblVal.COLUMN_NAME

              }));

              $("#grpTwoList").append($('<option>',{

                value:tblVal.COLUMN_NAME,
                'data-xyz':tblVal.COLUMN_NAME,
                text:tblVal.COLUMN_NAME

              }));

            });

            /* --- START : for HEAD Varchar - fields --- */

                var srNo = 2;
                     
                $("#showtaxcodeMul"+rowID).empty();
                $("#firstCol_"+rowID).empty();
                $("#secondCol_"+rowID).empty();
                $("#thirdCol_"+rowID).empty();
                $("#fourCol_"+rowID).empty();

                var taxData1 = '<div class="col-sm-3" id="firstCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                $('#showtaxcodeMul'+rowID).append(taxData1);

                var taxData2 = '<div class="col-sm-3" id="secondCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                $('#showtaxcodeMul'+rowID).append(taxData2);

                var taxData3 = '<div class="col-sm-3" id="thirdCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                $('#showtaxcodeMul'+rowID).append(taxData3);

                var taxData4 = '<div class="col-sm-3" id="fourCol_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                $('#showtaxcodeMul'+rowID).append(taxData4);

                var dataLen = data1.chrConfigTbl.length;

                if(data1.dynamicQData !=''){
                  var grpThree= data1.dynamicQData[0].GROUP3;
                  var splitGRpThr = grpThree.split(',');
                  $('#charField').val(grpThree);

                  var hidd_nCol = $('#hiddenColName').val();
                  if(hidd_nCol != ''){
                    var existhiddnCol = $('#hiddenColName').val();
                    $('#hiddenColName').val(existhiddnCol+','+grpThree);
                  }
                  
                  setTimeout(function () {
                    selectColumnData(1);
                  }, 1500);
                }

                var dataLen_Dc = data1.chrConfigTbl.length;

                if(dataLen_Dc < 10){
                  $('#modalLen').addClass('modal-sm');
                  $("#firstCol_"+rowID).css('width','100%');
                }else{
                  $('#modalLen').addClass('modal-lg');
                  $('#modalLen').css('width','85%');
                }
                
                $.each(data1.chrConfigTbl, function(key, value) {

                  if(jQuery.inArray(value.COLUMN_NAME, splitGRpThr) !== -1){
                    var checkedVal = 'checked';
                    var disabledchk = 'disabled';
                  }else{
                    var checkedVal = '';
                    var disabledchk = '';
                  }
                    
                  var rowNo = key + 1;

                  if(rowNo > 10 && rowNo < 20){
                    
                    var dataRow2 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" id="nameTbl_'+rowID+'" name="tblColName[]" data-chr="'+value.COLUMN_NAME+'" data-len="'+value.COLUMN_NAME+'" '+checkedVal+' value="'+value.COLUMN_NAME+'~'+value.ALIAS+'~'+value.TABLE_NAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLUMN_NAME+'</label></div><br>';

                    $('#secondCol_'+rowID).append(dataRow2);

                  }else if(rowNo >= 20 && rowNo < 30){

                    var dataRow3 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" id="nameTbl_'+rowID+'" name="tblColName[]" data-chr="'+value.COLUMN_NAME+'" data-len="'+value.COLUMN_NAME+'" '+checkedVal+' value="'+value.COLUMN_NAME+'~'+value.ALIAS+'~'+value.TABLE_NAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLUMN_NAME+'</label></div><br>';

                    $('#thirdCol_'+rowID).append(dataRow3);

                   //console.log('above 20 less 30',);

                  }else if(rowNo >= 30 && rowNo < 45){

                    var dataRow4 = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" id="nameTbl_'+rowID+'" name="tblColName[]" data-chr="'+value.COLUMN_NAME+'" data-len="'+value.COLUMN_NAME+'" '+checkedVal+' value="'+value.COLUMN_NAME+'~'+value.ALIAS+'~'+value.TABLE_NAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLUMN_NAME+'</label></div><br>';

                    $('#fourCol_'+rowID).append(dataRow4);

                    //console.log('above 30 less 45',);

                  }else{

                    //console.log('else',rowNo);

                    var taxData = '<div style="margin-left:5%">'+rowNo+') <input type="checkbox" class="taxcodeset" name="tblColName[]" id="nameTbl_'+rowID+'" data-chr="'+value.COLUMN_NAME+'" data-len="'+value.COLUMN_NAME+'" '+checkedVal+' value="'+value.COLUMN_NAME+'~'+value.ALIAS+'~'+value.TABLE_NAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLUMN_NAME+'</label></div><br>';

                    $('#firstCol_'+rowID).append(taxData);

                  }

                  srNo++;
                  
                });


            /* --- END : for HEAD Varchar - fields --- */

            /* --- START : for BODY Num-fields --- */

                var srNoDc = 2;
                   
                $("#showNumFields"+rowID).empty();
                $("#firstColDc_"+rowID).empty();
                $("#secondColDc_"+rowID).empty();
                $("#thirdColDc_"+rowID).empty();
                $("#fourColDc_"+rowID).empty();

                var datacol_data = '<div class="col-sm-3" id="firstColDc_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                $('#showNumFields'+rowID).append(datacol_data);

                var datacol_Data2 = '<div class="col-sm-3" id="secondColDc_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                $('#showNumFields'+rowID).append(datacol_Data2);

                var datacol_Data3 = '<div class="col-sm-3" id="thirdColDc_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                $('#showNumFields'+rowID).append(datacol_Data3);

                var datacol_Data4 = '<div class="col-sm-3" id="fourColDc_'+rowID+'" style="padding-top: 2%;padding-bottom: 2%;"></div>';

                $('#showNumFields'+rowID).append(datacol_Data4);


                if(data1.dynamicQData !=''){
                  var dataCol= data1.dynamicQData[0].DATA_COLUMN;
                  var splitdataCol = dataCol.split(',');

                  $('#groupThree').val(dataCol);

                  var hiddn_Col = $('#hiddenColName').val();
                  if(hiddn_Col != ''){
                    var exist_hiddnCol = $('#hiddenColName').val();
                    $('#hiddenColName').val(exist_hiddnCol+','+dataCol);
                  }
                  
                  setTimeout(function () {
                    selectNumColumnData(1);
                  }, 2000);

                }

                var dataLenDc = data1.intConfigTbl.length;

                if(dataLenDc < 10){
                  $('#modalLenNum').addClass('modal-sm');
                  $("#firstColDc_"+rowID).css('width','100%');
                }else{
                  $('#modalLenNum').addClass('modal-lg');
                  $('#modalLenNum').css('width','85%');
                }

                $.each(data1.intConfigTbl, function(keyDc, value) {

                  if(jQuery.inArray(value.COLUMN_NAME, splitdataCol) !== -1){
                    var checkedVal = 'checked';
                    var disabledchk = 'disabled';
                  }else{
                    var checkedVal = '';
                    var disabledchk = '';
                  }

                  var row_No = keyDc + 1;

                  if(row_No > 10 && row_No < 20){

                    var datacolTwo = '<div style="margin-left:5%">'+row_No+') <input type="checkbox" class="taxcodeset" id="datacnameTbl_'+rowID+'" name="dataColName[]" data-chr="'+value.COLUMN_NAME+'" data-len="'+value.COLUMN_NAME+'" value="'+value.COLUMN_NAME+'~'+value.ALIAS+'~'+value.TABLE_NAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLUMN_NAME+'</label></div><br>';

                    $('#secondColDc_'+rowID).append(datacolTwo);

                  }else if(row_No >= 20 && row_No < 30){

                    var dataRow3 = '<div style="margin-left:5%">'+row_No+') <input type="checkbox" class="taxcodeset" id="datacnameTbl_'+rowID+'" name="dataColName[]" data-chr="'+value.COLUMN_NAME+'" data-len="'+value.COLUMN_NAME+'" value="'+value.COLUMN_NAME+'~'+value.ALIAS+'~'+value.TABLE_NAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLUMN_NAME+'</label></div><br>';

                    $('#thirdColDc_'+rowID).append(dataRow3);

                  }else if(row_No >= 30 && row_No < 45){

                    var dataRow4 = '<div style="margin-left:5%">'+row_No+') <input type="checkbox" class="taxcodeset" id="datacnameTbl_'+rowID+'" name="dataColName[]" data-chr="'+value.COLUMN_NAME+'" data-len="'+value.COLUMN_NAME+'" value="'+value.COLUMN_NAME+'~'+value.ALIAS+'~'+value.TABLE_NAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLUMN_NAME+'</label></div><br>';

                    $('#fourColDc_'+rowID).append(dataRow4);

                  }else{
                    var taxDataOne = '<div style="margin-left:5%">'+row_No+') <input type="checkbox" class="taxcodeset" name="dataColName[]" id="datacnameTbl_'+rowID+'" data-chr="'+value.COLUMN_NAME+'" data-len="'+value.COLUMN_NAME+'" '+checkedVal+' value="'+value.COLUMN_NAME+'~'+value.ALIAS+'~'+value.TABLE_NAME+'" style="margin-left:2%;"><label for="html" style="margin-left:2%;">'+value.COLUMN_NAME+'</label></div><br>';

                    $('#firstColDc_'+rowID).append(taxDataOne);
                  }

                });

              /* --- END : for BODY Num-fields --- */

          }
        } /* success */
      });

    }/* main function close */


    /* ---------- group 1 --------------*/

    function getGrouOne(groupOneVal){
      var grpOne =  $('#groupOne').val();
      var xyz = $('#grpOneList option').filter(function() {

        return this.value == grpOne;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#groupOne').val('');       
        $('#grponeAlies').val('');       
        $('#tblNamefirst').val('');  
        $('#groupTwo').css('border-color','#d2d6de');
        $('#groupOne').css('border-color','#ff0000').focus();
        $('#groupTwo').prop('readonly',true);     
      }else{ 
        $('#grponeAlies').val('');       
        $('#tblNamefirst').val('');  
        $('#groupTwo').prop('readonly',false);
        $('#groupOne').css('border-color','#d2d6de');
        $('#groupTwo').css('border-color','#ff0000').focus();

        var grpTwo =$('#groupTwo').val();
        var grpThre =$('#charField').val();
        var grpFour =$('#groupThree').val();
        var allCol = grpTwo+','+grpThre+','+grpFour;
        var aryCol = allCol.split(',');
        var alreadyExist = aryCol.includes(grpOne);
        if(alreadyExist == true){
          $('#groupOneErr').html('Please Selct Another Fields...!');
          $('#groupOne').val('');       
          $('#grponeAlies').val('');       
          $('#tblNamefirst').val('');  
          $('#groupTwo').css('border-color','#d2d6de');
          $('#groupOne').css('border-color','#ff0000').focus();
        }else{
          $('#groupOneErr').html('');
          $('#groupOne').css('border-color','#d2d6de');
          $('#groupTwo').css('border-color','#ff0000').focus();
        }

        var group_check = 'one';
        getaliseVal(grpOne,group_check);
      }

      enableSaveBtn();
    }

    /* ---------- group 1 --------------*/

    /* ---------- group 2 --------------*/

    function getGroupTwo(groupTwoVal){
      var grpTwo =  $('#groupTwo').val();
      var xyz = $('#grpTwoList option').filter(function() {

        return this.value == grpTwo;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg == 'No Match'){
        $('#groupTwo').val('');
        $('#grpTwoAlies').val('');
        $('#tblNameTwo').val('');
        $('#charField').css('border-color','#d2d6de');
        $('#groupTwo').css('border-color','#ff0000').focus();
      }else{
        $('#grpTwoAlies').val('');
        $('#tblNameTwo').val('');
        var groupOneVal = $('#groupOne').val();
        var grpThreval  =  $('#charField').val();
        var grpFourval  =  $('#groupThree').val();
        var allCol = groupOneVal+','+grpThreval+','+grpFourval;
        var aryCol = allCol.split(',');
        var alreadyExist = aryCol.includes(grpTwo);
        if(alreadyExist == true){
          $('#groupTwo').val('');
          $('#grpTwoAlies').val('');
          $('#tblNameTwo').val('');
          $('#groupTwoErr').html('Please Selct Another Fields...!');
          $('#charField').css('border-color','#d2d6de');
          $('#groupTwo').css('border-color','#ff0000').focus();
        }else{
          $('#groupTwoErr').html('');
          $('#groupTwo').css('border-color','#d2d6de');
          $('#charField').css('border-color','#ff0000').focus();
        }
        var group_check = 'two';
        getaliseVal(grpTwo,group_check);
      }
      enableSaveBtn();
    }

    /* ---------- group 2 --------------*/

    /* ---------- group 3 --------------*/

    function getMultiColName(rowId){

      var redVal = $('#charField').prop('readonly');

      $('#taxSelectModel'+rowId).modal('show');
   
    }

    function selectColumnData(getRowId){
      var colNameT = [];
      var allcolThree = [];
      var tempAry = [];
      $('#nameTbl_'+getRowId+':checked').each(function(i){

        var selectVal = $(this).val();
        var splitData = selectVal.split('~');
        colNameT.push(splitData[0]);
        allcolThree.push(selectVal);

      });

      var group_one = $('#groupOne').val();
      tempAry.push(group_one); 
      var group_two = $('#groupTwo').val();
      tempAry.push(group_two); 
      var group_four = $('#groupThree').val();
      var spligf      = group_four.split(',');

      var totalexistCol = tempAry.concat(spligf);

      var storeChecked = [];
      for(var i=0;i<colNameT.length;i++){

        if(jQuery.inArray(colNameT[i], totalexistCol) !== -1){
          var checkedVal = 'checked';
          storeChecked.push(checkedVal);
        }else{
          var checkedVal = '';
        }
      }

      if(storeChecked.length >0){
        $('#groupThreeErr').html('Please Selct Another Fields...!');
        $('#charField').val('');
        $('#groupT_col').val('');
        $('#groupT_table').val('');
        $('#groupThree').css('border-color','#d2d6de');
        $('#charField').css('border-color','#ff0000').focus();
      }else{
        $('#groupThreeErr').html('');
        $('#charField').val(colNameT);
        var columnNameT =[];
        var tableNameT =[];
        for(var j=0;j<allcolThree.length;j++){
            var splitall = allcolThree[j].split('~');
             columnNameT.push(splitall[1]+splitall[0]);
             tableNameT.push(splitall[1]+splitall[2]);
        }
        $('#groupT_col').val(columnNameT);
        $('#groupT_table').val(tableNameT);
        $('#charField').css('border-color','#d2d6de');
        $('#groupThree').css('border-color','#ff0000').focus();
      }
      enableSaveBtn();
    }

    /* ---------- group 3 --------------*/

    /* ---------- group 4 --------------*/

    function getDataColm(dataColVal){

      $('#numSelectModel'+dataColVal).modal('show');

    }

    function selectNumColumnData(getUniqNo){

      var dataCol_col = [];
      var alldataCol  = [];
      var tempAry     = [];
      $('#datacnameTbl_'+getUniqNo+':checked').each(function(i){

        var select_Val = $(this).val();
        var splitVal   = select_Val.split('~');
        dataCol_col.push(splitVal[0]);
        alldataCol.push(select_Val);
      });

      var group_one   = $('#groupOne').val();
      tempAry.push(group_one);
      var group_two   = $('#groupTwo').val();
      tempAry.push(group_two);
      var group_three = $('#charField').val();
      var spligt      = group_three.split(',');

      var totalexistCol = tempAry.concat(spligt);

      var store_Checked =[];
      for(var i=0;i<dataCol_col.length;i++){

        if(jQuery.inArray(dataCol_col[i], totalexistCol) !== -1){
          var checkedVal = 'checked';
          store_Checked.push(checkedVal);
        }else{
          var checkedVal = '';
        }

      } 

      if(store_Checked.length >0){
        $('#dataColumnErr').html('Please Selct Another Fields...!');
        $('#groupThree').val('');
        $('#dataCol_col').val('');
        $('#dataCol_table').val('');
        $('#groupThree').css('border-color','#ff0000').focus();
      }else{
        $('#dataColumnErr').html('');
        $('#groupThree').val(dataCol_col);
        var columnNameT =[];
        var tableNameT =[];
        for(var j=0;j<alldataCol.length;j++){
            var splitall = alldataCol[j].split('~');
             columnNameT.push(splitall[1]+splitall[0]);
             tableNameT.push(splitall[1]+splitall[2]);
        }
        $('#dataCol_col').val(columnNameT);
        $('#dataCol_table').val(tableNameT);
        $('#groupThree').css('border-color','#d2d6de');
      }
      enableSaveBtn();
    }

    /* ---------- group 4 --------------*/

    /* ---------- get alises & table name --------------*/

    function getaliseVal(groupVal,group_check){
      var transCode = $('#tran_code').val();
      var groupOne  = groupVal;

      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });
      $.ajax({
        url:"{{ url('get-data-from-transaction') }}",
        method : "POST",
        type: "JSON",
        data: {tranName:transCode,groupOne:groupOne},
        success:function(data){
          var data1 = JSON.parse(data);
          if (data1.response == 'error') {
            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                   

          }else if(data1.response == 'success'){

              var groupOne = $('#groupOne').val();
              var groupTwo = $('#groupTwo').val();

              if(group_check == 'one'){
                  if(groupOne){
                    $('#grponeAlies').val(data1.aliesTData[0].ALIAS);
                    $('#tblNamefirst').val(data1.aliesTData[0].ALIAS+data1.aliesTData[0].TABLE_NAME);

                  }
              }

              if(group_check == 'two'){
                  if(groupTwo){
                    $('#grpTwoAlies').val(data1.aliesTData[0].ALIAS);
                    $('#tblNameTwo').val(data1.aliesTData[0].ALIAS+data1.aliesTData[0].TABLE_NAME);
                  }
              }

          }
        }
      });
    }
    /* ---------- get alises & table name --------------*/




</script>




<script type="text/javascript">


  $(document).ready(function() {

    $( window ).on( "load", function() {
      filedValidatin();
    });

    $("#submitdataOne").click(function(event) {

        var tranCode  = $('#tran_code').val();
        var pfctCode  = $('#pfct').val();
        var plantcode = $('#plant').val();
        var fromdate  = $('#from_date').val();
        var splidate = fromdate.split('-');
        var fromDateForm = splidate[2]+'-'+splidate[1]+'-'+splidate[0];
        var todate    = $('#to_date').val();
        var splitodate = todate.split('-');
        var toDateForm = splitodate[2]+'-'+splitodate[1]+'-'+splitodate[0];
        var reportName = $('#report_name').val();
        var userName   = $('#user_name').val();
        var queryName  = $('#queryName').val();
        var queryNameWS  = $('#queryNameWS').val();
         if(userName == ''){
          var user_name = '--';
        }else{
          var user_name = userName;
        }


        var groupOne      = $('#groupOne').val();
        var groupOneAlies = $('#grponeAlies').val();

        var groupTwo      = $('#groupTwo').val();
        var groupTwoAlies = $('#grpTwoAlies').val();

        var columnGrpOne   = groupOneAlies+groupOne;
        var columnGrpTwo   = groupTwoAlies+groupTwo;
        var columnGrpThree = $('#groupT_col').val();
        var columnGrpFour  = $('#dataCol_col').val();

        var gTrplComma = columnGrpThree.replaceAll(',', ' AND ');

        var tableGrpOne  = $('#tblNamefirst').val();
        var tableGrpTwo  = $('#tblNameTwo').val();
        var tableGrpThre = $('#groupT_table').val();
        var tableGrpFour = $('#dataCol_table').val();

        var colGrpThree = $('#charField').val();
        var colGrpFour = $('#groupThree').val();

        var allTableName = tableGrpOne+','+tableGrpTwo+','+tableGrpThre+','+tableGrpFour;
        var splittable = allTableName.split(',');
        var uniqTableName = splittable.filter((c, index) => {
            return splittable.indexOf(c) === index;
        });

        var allTblName = [];
        var aliesWhere ='';
        for(var i=0;i<uniqTableName.length;i++){
            var splitTName = uniqTableName[i].split('.');
            var tableName = splitTName[1]+' '+splitTName[0];
            allTblName.push(tableName);

            var last3 = uniqTableName[i].slice(-5);

            if('_HEAD' == last3){
              var tablNme = uniqTableName[i];
              var spliBydot = tablNme.split('.');
              var aliesWhere = spliBydot[0];
            }
        }


        if(pfctCode !='' && plantcode!=''){
          var whereCodn = aliesWhere+".TRAN_CODE='"+tranCode+"' AND "+aliesWhere+".PFCT_CODE='"+pfctCode+"' AND "+aliesWhere+".PLANT_CODE='"+plantcode+"' AND ("+aliesWhere+".VRDATE BETWEEN '"+fromDateForm+"' AND '"+toDateForm+"')";
        }else if(pfctCode =='' && plantcode!=''){
          var whereCodn = aliesWhere+".TRAN_CODE='"+tranCode+"' AND "+aliesWhere+".PLANT_CODE='"+plantcode+"' AND ("+aliesWhere+".VRDATE BETWEEN '"+fromDateForm+"' AND '"+toDateForm+"')";
        }else if(plantcode == '' &&  pfctCode!=''){
          var whereCodn = aliesWhere+".TRAN_CODE='"+tranCode+"' AND "+aliesWhere+".PFCT_CODE='"+pfctCode+"' AND ("+aliesWhere+".VRDATE BETWEEN '"+fromDateForm+"' AND '"+toDateForm+"')";
        }else{
          var whereCodn = aliesWhere+".TRAN_CODE='"+tranCode+"' AND ("+aliesWhere+".VRDATE BETWEEN '"+fromDateForm+"' AND '"+toDateForm+"')";
        }

        //var groupByVal = 'GROUP BY '+columnGrpOne+' AND '+columnGrpTwo+' AND '+gTrplComma;

        var groupByVal = 'GROUP BY '+columnGrpOne+' AND '+columnGrpTwo;

        var cretaeQuery = columnGrpOne+","+columnGrpTwo+","+columnGrpThree+","+columnGrpFour+" FROM "+allTblName+" WHERE "+whereCodn+" "+groupByVal;

        //console.log('cretaeQuery',cretaeQuery);return false;
      
      window.location.href = "{{ url('/reporte/dynamicQuery-save/') }}"+'/'+cretaeQuery+'/'+tranCode+'/'+reportName+'/'+user_name+'/'+fromdate+'/'+todate+'/'+queryName+'/'+queryNameWS+'/'+groupOne+'/'+groupTwo+'/'+columnGrpThree+'/'+columnGrpFour+'/'+groupOne+'/'+groupTwo+'/'+colGrpThree+'/'+colGrpFour;
      
              
    });


    $('#ResetId').click(function(){
  
      $('#bank_code').val('');
      
      $('#acct_code').val('');
      $('#vr_num').val('');

      document.getElementById("depotText").innerHTML = '';
      document.getElementById("accountText").innerHTML = '';
      $('#PurchaseIndentReportTable').DataTable().destroy();
      load_data_query();

    });
  

});

function filedValidatin() {

  var trans_code  = $('#tran_code').val();
  var query_name  = $('#queryName').val();
  var report_name = $('#report_name').val();
  var pfct_code   = $('#pfct').val();
  var plant_code  = $('#plant').val();
  var from_date   = $('#from_date').val();
  var to_date     = $('#to_date').val();

  if(trans_code){
    $('#tran_code').css('border-color','#d2d6de');
    $('#tran_code').prop('readonly',false);
    if(query_name){
      $('#queryName').css('border-color','#d2d6de');
      $('#queryName').prop('readonly',false);
      if(report_name){
        $('#report_name').css('border-color','#d2d6de');
        $('#report_name').prop('readonly',false);
        if(from_date){
          $('#from_date').css('border-color','#d2d6de');
          $('#from_date').prop('readonly',false);
          if(to_date){
            $('#to_date').css('border-color','#d2d6de');
            $('#to_date').prop('readonly',false);
          }else{
            $('#to_date').css('border-color','#ff0000');
            $('#to_date').prop('readonly',false);
          }
        }else{
          $('#from_date').css('border-color','#ff0000');
          $('#from_date').prop('readonly',false);
        }
      }else{
        $('#report_name').css('border-color','#ff0000');
        $('#report_name').prop('readonly',false);
      }
    }else{
      $('#queryName').css('border-color','#ff0000');
      $('#queryName').prop('readonly',false);
    }
  }else{
    $('#tran_code').css('border-color','#ff0000');
    $('#tran_code').prop('readonly',false);
  }
  

  var trans_code  = $('#tran_code').val();
  var report_name = $('#report_name').val();
  var pfct_code   = $('#pfct').val();
  var plant_code  = $('#plant').val();
  var from_date   = $('#from_date').val();
  var to_date     = $('#to_date').val();
  var query_name  = $('#queryName').val();

  if(trans_code && report_name && from_date && to_date && query_name){
    $('#submitdata').prop('disabled',false);
  }else{
    $('#submitdata').prop('disabled',true);
  }

}

function enableSaveBtn(){
  
  var groupOne   = $('#groupOne').val();
  var groupTwo   = $('#groupTwo').val();
  var groupThree = $('#charField').val();
  var groupFour  = $('#groupThree').val();
  var dataColumn = $('#dataCol_col').val();
  var dataTable  = $('#dataCol_table').val();

  if(groupOne && groupTwo && groupThree && groupFour && dataColumn && dataTable){
    $('#submitdataOne').prop('disabled',false);
  }else{
    $('#submitdataOne').prop('disabled',true);
  }

  if(groupOne){
    $('#groupOne').css('border-color','#d2d6de');
    $('#groupTwo').css('border-color','#ff0000').focus();
    if(groupTwo){
      $('#groupTwo').css('border-color','#d2d6de');
      $('#groupThree').css('border-color','#ff0000').focus();
      if(groupThree){
        $('#charField').css('border-color','#d2d6de');
        $('#groupThree').css('border-color','#ff0000').focus();
        if(groupFour){
          $('#groupThree').css('border-color','#d2d6de');
        }else{
          $('#groupThree').css('border-color','#ff0000').focus();
        }
      }else{
        $('#groupThree').css('border-color','#d2d6de');
        $('#charField').css('border-color','#ff0000').focus();
      }
    }else{
      $('#groupThree').css('border-color','#d2d6de');
      $('#groupTwo').css('border-color','#ff0000').focus();
    }
  }else{
    $('#groupTwo').css('border-color','#d2d6de');
    $('#groupOne').css('border-color','#ff0000').focus();
  }
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