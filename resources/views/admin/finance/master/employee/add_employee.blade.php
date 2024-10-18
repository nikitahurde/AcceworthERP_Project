@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')



@include('admin.include.sidebar')

<style type="text/css">



  .PageTitle{



    margin-right: 1px !important;



  }

  .rightcontent{

  text-align:right;


}
::placeholder {
  
  text-align:left;
}



 .required-field::before {



    content: "*";



    color: red;



  }





  .Custom-Box {



    /*border: 1px solid #e0dcdc;

    border-radius: 10px;*/ 



      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);



  }



.showinmobile{

  display: none;

}

.secondSection{



  display: none;

}

#login {
    font-size: 10px !important;
    width: 17px;
    margin-top: 1px;
    margin: -4px;
    padding: 1px;
    /*padding-bottom: 6%;*/
}



 @media screen and (max-width: 600px) {



  .showinmobile{



    display: block;



  }

  .PageTitle{

    float: left;

  }

  .hideinmobile{

    display: none;

  }





}





.stepwizard-step p {

    margin-top: 10px;

}



.stepwizard-row {

    display: table-row;

}



.stepwizard {

    display: table;

    width: 100%;

    position: relative;

}



.stepwizard-step button[disabled] {

    opacity: 1 !important;

    filter: alpha(opacity=100) !important;

}



.stepwizard-row:before {

    top: 14px;

    bottom: 0;

    position: absolute;

    content: " ";

    width: 100%;

    height: 1px;

    background-color: #ccc;

    z-order: 0;



}



.stepwizard-step {

    display: table-cell;

    text-align: center;

    position: relative;

}



.btn-circle {

  width: 30px;

  height: 30px;

  text-align: center;

  padding: 6px 0;

  font-size: 12px;

  line-height: 1.428571429;

  border-radius: 15px;

}

.setwidthsel{

  width: 100px;

}

.amntFild{

  display: none;

}

.nonAccFild{

 display: none;

}

.showSeletedName{



    font-size: 15px;



    margin-top: 1%;

    margin-bottom: 3%;



    text-align: center;



    font-weight: 600;



    color: #4f90b5;

    text-transform: capitalize;

    text-align: center;



  }

.settblebrodr{

  border: 1px solid #cac6c6;

}

.tdlboxshadow{

  box-shadow: 0px 1px 4px -1px rgba(161,155,161,1);



}

.capitalizeLetter {
    text-transform: capitalize;
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

    font-size: 10px;

}

.text-center{

  text-align: center;

}





.title{

    margin-top: 50px;

    margin-bottom: 20px;

}



table {

    border-collapse: collapse;

}



.table-responsive {

    display: block;

    width: 100%;

    overflow-x: auto;

    -webkit-overflow-scrolling: touch;

}



.table {

    width: 100%;

    margin-bottom: 1rem;

    color: #212529;

}



.table thead th {

    vertical-align: bottom;

    border-bottom: 2px solid #dee2e6;

}

.table td, .table th {

    padding: .75rem;

    vertical-align: top;



}

.container{

    max-width: 1200px;

    margin: 0px auto;

    padding: 0px 15px;

}

/* table{border-collapse:collapse;border-radius:25px;width:880px;} */

/*table, td, th{border:1px solid #00BB64;}*/

/*tr,input{height:30px;border:1px solid #c8bebe;}*/



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



.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 8px;

    padding-bottom: 0px !important;

    line-height: 1.0;

    vertical-align: top;

    border-top: 1px solid #ddd;

    text-align: center;
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

.debitotldesn{

    width: 277%;

    margin-left: 45%;

    text-align: end;

}

.credittotldesn{

    width: 277%;

    margin-left: -11%;

    text-align: end;

}

.debitcreditbox{


  margin-top: 0%;

  text-align: left;

}

.companyNameBox{

  margin-top: 0%;

  text-align: left;

}

.designationBox{

  margin-top: 0%;

  text-align: left;

}

.savebtnstyle{

    color: #fff;

    background-color: #204d74;

    border-color: #122b40;

}

.cnaclbtnstyle{

    color: #fff;

    background-color: #d9534f;

    border-color: #d43f3a;

}

.instrumentlbl{

      font-size: 12px;

    margin-left: -5px;

}

.instTypeMode{

    width: 56%;

    margin-bottom: 5px;

}

.textdesciptn{

  width: 250px;

    margin-bottom: 5px;

}

.tdsratebtn{

  margin-top: 33% !important;

  font-weight: 600 !important;

  font-size: 10px !important;

}

.tdsratebtnHide{

  display: none;

}

.tdsInputBox{

  margin-bottom: 2%;

}

.modltitletext{

  text-align: center;

    font-weight: 700;

    color: #5696bb;

}

.textSizeTdsModl{

  font-size: 13px;

}

@media screen and (max-width: 600px) {



  .debitotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: 13%;

  }



  .credittotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: -34%;

  }

  .totlsetinres{

    width: 130%;

  }

  .textdesciptn{

    margin-bottom: -1%;

  }

  .debitcreditbox{

    margin-top: 0%;

  }



}

</style>

<style type="text/css">

  

  .required-field::before {

    content: "*";

    color: red;

  }
  

  .rightcontent{

  text-align:right;


}

::placeholder {
  
  text-align:left;
}

.showinmobile{
  display: none;
}


.beforhidetble{
  display: none;
}
/*.popover{
    left: 92.4922px!important;
    width: 100%!important;
}*/
.setetxtintd{
    font-size: 14px !important;
    padding-top: 2% !important;
    padding-bottom: 2% !important;
}
.nameheading{
    font-size: 12px;
}
.setheightinput{
    height: 0%;
}
.SameAsAbove{
  margin-top: 5%;
  margin-bottom: 14%;
  font-weight: 700;
  font-size: 13px;
  text-align: center;
}
.PerAddress{
  margin-top: 0%;
  margin-bottom: 4%;
  font-size: 22px;
  font-weight: 800;
  text-align: center;
  text-decoration: underline;
  color: gray;
}
.custom-options {
     position: absolute;
     display: block;
     top: 100%;
     left: 0;
     right: 0;
     border-top: 0;
     background: #f3eded;
     transition: all 0.5s;
     opacity: 0;
     visibility: hidden;
     pointer-events: none;
     z-index: 2;
     -webkit-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
     -moz-box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
     box-shadow: 0px 0px 10px -5px rgba(0,0,0,0.75);
}
 .custom-select .custom-options {
     opacity: 1;
     visibility: visible;
     pointer-events: all;
}
 .custom-option {
    position: relative;
    display: block;
    padding-top: 10px;
    padding-left: 21%;
    font-size: 14px;
    font-weight: 600;
    color: #3b3b3b;
    line-height: 2px;
    cursor: pointer;
    transition: all 0.5s;
}
.CheckBoxAddSame{
    margin-left: 4%;
    margin-top: 0%;
    padding-bottom: -115px;
    width: 100p;
    width: 25px;
    height: 25px;
    cursor: pointer;
}

.content_comp{
    min-height: 250px;
    margin-top: -5%;
    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;
}
 
.CloseListDepot{
  display: none;
}
 @media screen and (max-width: 600px) {

  .showinmobile{

    display: block;

  }
  .PageTitle{
    float: left;
  }
  .hideinmobile{
    display: none;
  }
   .popover {
    left: 56.4922px!important;
    width: 100%!important;
  }
   .setheightinput{
    width: 65%!important;
  }
  #serachcode{
    margin-left: 5%!important;
  }


}

.design-process-section .text-align-center {
    line-height: 25px;
    margin-bottom: 12px;
}
.design-process-content {
    border: 1px solid #e9e9e9;
    position: relative;
   
}
.design-process-content img {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 0;
    max-height: 100%;
}
.design-process-content h3 {
    margin-bottom: 16px;
}
.design-process-content p {
    line-height: 26px;
    margin-bottom: 12px;
}
.process-model {
    list-style: none;
    padding: 0;
    position: relative;
    max-width: 780px;
    margin: 50px auto 26px;
    border: none;
    z-index: 0;
}
.process-model li::after {
    background: #e5e5e5 none repeat scroll 0 0;
    bottom: 0;
    content: "";
    display: block;
    height: 4px;
    margin: 0 auto;
    position: absolute;
    right: -85px;
    top: 33px;
    width: 102%;
    z-index: -1;
}
.process-model li.visited::after {
    background: #3c8dbc;
}
.process-model li:last-child::after {
    width: 0;
}
.process-model li {
    display: inline-block;
    width: 24%;
    text-align: center;
    float: none;
}
.tab-content-custom{
  border: 1px solid #d0d0d0 !important;
  border-radius: 10px !important;
}
.nav-tabs.process-model > li.active > a, .nav-tabs.process-model > li.active > a:hover, .nav-tabs.process-model > li.active > a:focus, .process-model li a:hover, .process-model li a:focus {
    border: none;
    background: transparent;

}
.process-model li a {
    padding: 0;
    border: none;
    color: #606060;
}
.process-model li.active,
.process-model li.visited {
    color: #3c8dbc;
}
.process-model li.active a,
.process-model li.active a:hover,
.process-model li.active a:focus,
.process-model li.visited a,
.process-model li.visited a:hover,
.process-model li.visited a:focus {
    color: #3c8dbc;
}
.process-model li.active p,
.process-model li.visited p {
    font-weight: 600;
}
.process-model li i {
    display: block;
    height: 68px;
    width: 68px;
    text-align: center;
    margin: 0 auto;
    background: #f5f6f7;
    border: 2px solid #e5e5e5;
    line-height: 65px;
    font-size: 30px;
    border-radius: 50%;
}
.process-model li.active i, .process-model li.visited i  {
    background: #fff;
    border-color: #3c8dbc;
}
.process-model li p {
    font-size: 14px;
    margin-top: 11px;
}
.process-model.contact-us-tab li.visited a, .process-model.contact-us-tab li.visited p {
    color: #606060!important;
    font-weight: normal
}
.process-model.contact-us-tab li::after  {
    display: none; 
}
.process-model.contact-us-tab li.visited i {
    border-color: #e5e5e5; 
}



@media screen and (max-width: 560px) {
  .more-icon-preocess.process-model li span {
        font-size: 23px;
        height: 50px;
        line-height: 46px;
        width: 50px;
    }
    .more-icon-preocess.process-model li::after {
        top: 24px;
    }
}
@media screen and (max-width: 380px) { 
    .process-model.more-icon-preocess li {
        width: 16%;
    }
    .more-icon-preocess.process-model li span {
        font-size: 16px;
        height: 35px;
        line-height: 32px;
        width: 35px;
    }
    .more-icon-preocess.process-model li p {
        font-size: 8px;
    }
    .more-icon-preocess.process-model li::after {
        top: 18px;
    }
    .process-model.more-icon-preocess {
        text-align: center;
    }
}
  /* DivTable.com */
.divTable{
  display: table;
  width: 100%;
}
.divTableRow {
  display: table-row;
}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
}
.divTableCell, .divTableHead {
  border: 1px solid #999999;
  display: table-cell;
  padding: 3px 10px;
  text-align: center;
    font-weight: bold;
  

}
.divTableHeading {
  background-color: #EEE;
  display: table-header-group;
  font-weight: bold;
}
.divTableFoot {
  background-color: #EEE;
  display: table-footer-group;
  font-weight: bold;
}
.divTableBody {
  display: table-row-group;
}
</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

           Master Employee  

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Master</a></li>

            <li class="Active"><a href="{{ URL('/finance/gl-mast')}}">Master Employee</a></li>

            <li class="Active"><a href="{{ URL('/finance/gl-mast')}}">Add Employee</a></li>

          </ol>

        </section>

 <section class="design-process-section content" id="process-tab">
  <div>
    <div class="row">
      <div class="col-sm-12"> 

          <div class="pull-right showinmobile">

            <a href="{{ url('/Master/Employee/View-Employee-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Employee Mas.</a>

          </div>

          <div class="pull-right hideinmobile">

            <a href="{{ url('/Master/Employee/View-Employee-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Employee Mas.</a>

          </div>

           @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -5%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-check"></i>

                  Success...!

                </h4>

                 {!! session('alert-success') !!}

              </div>

            @endif


            @if(Session::has('alert-error'))

              <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -5%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-ban"></i>

                  Error...!

                </h4>

                {!! session('alert-error') !!}

              </div>

            @endif

             <div id="empDeailSuccessMsg">
                
              </div>


            @if(Session::has('alert-success-family'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -5%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-check"></i>

                  Success...!

                </h4>

                 {!! session('alert-success-family') !!}

              </div>

            @endif


            @if(Session::has('alert-error-family'))

              <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -5%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>

                  <i class="icon fa fa-ban"></i>

                  Error...!

                </h4>

                {!! session('alert-error-family') !!}

              </div>

            @endif

        <!-- design process steps--> 
        <!-- Nav tabs -->
        <ul class="nav nav-tabs process-model more-icon-preocess" role="tablist">
          <li role="presentation" id="firsttab" class="active"><a href="#discover" aria-controls="discover" role="tab" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i>
            <p>Employee Details</p>
            </a></li>
          <li role="presentation" id="secondTab"><a href="#strategy" aria-controls="strategy" role="tab" data-toggle="tab"><i class="fa fa-users" aria-hidden="true"></i>
            <p>Employee Family Details</p>
            </a></li>
          <li role="presentation"><a href="#optimization" aria-controls="optimization" role="tab" data-toggle="tab"><i class="fa fa-graduation-cap" aria-hidden="true"></i>
            <p>Employee Career Details</p>
            </a></li>
          <li role="presentation"><a href="#content" aria-controls="content" role="tab" data-toggle="tab"><i class="fa fa-book" aria-hidden="true"></i>
            <p>Employee Education Details</p>
            </a></li>
        </ul>
        <!-- end design process steps--> 
        <!-- Tab panes -->
        <div class="tab-content tab-content-custom">
          <div role="tabpanel" class="tab-pane active" id="discover">
            <div class="design-process-content">

  <section class="content">

    <div class="row">

      {{-- <div class="col-sm-1"></div> --}}

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Employee Details</h2>

            </div><!-- /.box-header -->


          <div class="box-body">

            <form action="{{ url('/Master/Employee/add-employee-save') }}" method="POST" enctype="multipart/form-data">

               @csrf

               <div class="row">

                

                  <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Employee Name : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-user" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="employee_name_id" name="employee_name" class="form-control  pull-left EmpName FormTextFirstUpper" value="{{ old('employee_name')}}" placeholder="Enter Employee Name" autocomplete="off" maxlength="40"  oninput="funGenEmpCode(this)">

                          <input type="hidden" id="comp_code" name="comp_code" value="{{$comp_code}}">

                         

                      </div>

                      


                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('employee_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Employee Code : <span class="required-field"></span></label>

                        <div class="input-group">

                         <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                         <input type="text" id="employee_code_id" name="employee_code" class="form-control  pull-left EmpName codeCapital" value="{{ old('employee_code')}}" placeholder="Employee Code" autocomplete="off" maxlength="6" readonly="">

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                          
                          <!-- <span class="input-group-addon" style="padding: 0px 5px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true" ></i></button>
                            </div>
                            
                            <div id="myForm" class="hide">
                                 <div class="row" >
                                      <div class="col-md-9">
                                        <input type="text" name="empcodeH" id="empcodeH" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                <table class="table table-bordered" style="margin-top: 3%;width:200px;" id="HideWhenSearch">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Emp Code</th>
                                     <th class="nameheading">Emp Name</th>
                                    </tr>
                                  </thead>
                                  <tbody style="line-height:2.428571 !important ;">
                                    <?php foreach ($help_acc_type_list as $key) { ?>

                                      <tr>
                                        <td class="setetxtintd"><?php echo $key->EMP_CODE; ?></td>
                                        <td class="setetxtintd"><?php echo $key->EMP_NAME; ?></td>
                                      </tr>
                                     
                                    <?php } ?>
                                      
                                  </tbody>
                                </table>

                                <table class="table table-bordered beforhidetble" style="margin-top: 3%;width:200px;display: none;" id="ShowWhenSeaech">
                                  <thead>
                                    <tr>
                                     <th class="nameheading">Emp Code</th>
                                     <th class="nameheading">Emp Name</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    
                                  </tbody>
                                </table>
                                <span id="errorItem"></span>

                            </div>
                            </div>
                            
                          </span> -->
                         
                        </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('employee_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                      <label>

                        Date Of Birth : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                              <i class="fa fa-calendar" aria-hidden="true"></i>

                          </div>

                        <input type='text'  id="date_of_birth_id" name="date_of_birth" class="form-control  pull-left " value="{{ old('date_of_birth')}}" placeholder="Select Date Of Birth"  autocomplete="off">

                    </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('date_of_birth', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                  </div>
                  <!-- /.form-group -->
              </div>


                <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Birth Place : </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-home" aria-hidden="true"></i>

                          </div>

                          <input type="text" id="birth_place_id" name="birth_place" class="form-control  pull-left EmpDepartment FormTextFirstUpper" value="{{ old('birth_place')}}" placeholder="Enter Birth Place" autocomplete="off" maxlength="20">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('birth_place', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                  </div>

                </div><!-- /.col -->
                  
                  


                  

              </div>

              <!-- /.row -->

                <!-- /.row -->

                <div class="row">


                    <div class="col-md-3">

                      <div class="form-group">

                          <label for="exampleInputEmail1">Gender : <span class="required-field"></span></label>

                          <div class="input-group" style="margin-top: 3%;">

                              <input class="form-check-input" type="radio" name="gender" id="gender_id" value="Male" {{(old('gender') == 'Male') ? 'checked' : ''}}>&nbsp;&nbsp;&nbsp;

                                  <label class="form-check-label" for="inlineRadio1">Male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                  <input
                                     class="form-check-input"
                                    type="radio"
                                    name="gender"
                                    id="gender_id"
                                    value="Female"{{(old('gender') == 'Female') ? 'checked' : ''}} 
                                    >&nbsp;&nbsp;&nbsp;
                                  <label class="form-check-label" for="inlineRadio1" >Female</label>

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('gender', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->

                  <div class="col-md-3">

                    <div class="form-group">

                          <label>

                            Cast : 

                          </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                                <i class="fa fa-user" aria-hidden="true"></i>

                            </div>

                          <input type='text'  id="cast_id" name="emp_cast" class="form-control  pull-left FormTextFirstUpper" value="{{ old('emp_cast')}}" placeholder="Enter Cast"  autocomplete="off" maxlength="20">

                        </div>

                            <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('emp_cast', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                    </div>
                      <!-- /.form-group -->
                  </div>


                  <div class="col-md-3">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Religion :</label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-bars" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="religion_id" name="emp_religion" class="form-control  pull-left  FormTextFirstUpper" value="{{ old('emp_religion')}}" placeholder="Enter Religion" autocomplete="off" maxlength="50">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('emp_religion', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                  </div><!-- /.col -->

                  <div class="col-md-3">

                      <div class="form-group">

                        <label>

                        Blood Group : 


                        </label>

                         <div class="input-group">

                            <div class="input-group-addon">

                                <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input list="blood_group_list"  id="blood_group_id" name="blood_group" class="form-control  pull-left " value="{{ old('blood_group')}}" placeholder="Select Employee Grade"  autocomplete="off" maxlength="10"><br>

                             <input type="text" id="blood_group_name" name="emp_blood_name" readonly>

                            <datalist id="blood_group_list">

                                <option selected="selected" value="">-- Select --</option>
                                <option value="O+" data-xyz ="O-Positive">[O-Positive]</option>
                                 <option value="O-" data-xyz ="O-Negative">[O-Negative]</option>
                                <option value="A+" data-xyz ="A-Positive">[A-Positive]</option>
                                 <option value="A-" data-xyz ="A-Negative">[A-Negative]</option>
                                <option value="B+" data-xyz ="B-Positive">[B-Positive]</option>
                                 <option value="B-" data-xyz ="B-Negative">[B-Negative]</option>
                                 <option value="AB+" data-xyz ="AB-Positive">[AB-Positive]</option>
                                 <option value="AB-" data-xyz ="AB-Negative">[AB-Negative]</option>
                                

                            </datalist>

                          </div>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('blood_group', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                      </div>
                    <!-- /.form-group -->
                    </div><!-- /.col -->

              </div>


              <div class="row">

                  

                    <div class="col-md-2">

                      <div class="form-group" style="width: 116px;">

                          <label for="exampleInputEmail1">Marital Status :</label>

                          <div class="input-group" style="margin-top: 3%;">

                              <input
                    class="form-check-input"
                    type="radio"
                    name="marital_status"
                    id="marital_status_id"
                    value="YES"{{(old('marital_status') == 'YES') ? 'checked' : ''}} 
                    
                 >&nbsp;&nbsp;&nbsp;

                  <label class="form-check-label" for="inlineRadio1">Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                  <input
                     class="form-check-input"
                    type="radio"
                    name="marital_status"
                    id="marital_status_id"
                    value="NO"{{(old('marital_status') == 'NO') ? 'checked' : ''}}
                  >&nbsp;&nbsp;&nbsp;
                  <label class="form-check-label" for="inlineRadio1">No</label>

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('marital_status', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->

                  <div class="col-md-4" style='margin-right: -4px;margin-left: 2px;'>

                    <div class="form-group">

                        <label for="exampleInputEmail1">Email : <span class="required-field"></span></label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-envelope" aria-hidden="true"></i>

                            </div>

                            <input type="email" id="email_id" name="emp_email" class="form-control  pull-left" value="{{ old('emp_email')}}" placeholder="Enter Email" autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('emp_email', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                  </div><!-- /.col -->

                  <div class="col-md-3">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Mobile : <span class="required-field"></span></label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-mobile" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="mobile_id" name="emp_mobile" class="form-control  pull-left Number" value="{{ old('emp_mobile')}}" placeholder="Enter Mobile Number" autocomplete="off" maxlength="20">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('emp_mobile', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                  </div><!-- /.col -->
                  
                  <div class="col-md-3">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Adhar Card No : <span class="required-field"></span></label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="adhar_no" name="adhar_no" class="form-control  pull-left AdharNo" value="{{old('adhar_no')}}" placeholder="Enter Adhar Card No" autocomplete="off" maxlength="20">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('adhar_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                  </div><!-- /.col -->


              </div>

              <div class="row">

                  

                  <div class="col-md-3">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Pan Card No : <span class="required-field"></span></label>

                          <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="pan_no" name="pan_no" class="form-control  pull-left PanNo" value="{{old('pan_no')}}" placeholder="Enter Pan Card No" autocomplete="off" maxlength="20">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('pan_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                  </div><!-- /.col -->

                  <div class="col-md-3">

              <div class="form-group">
                
                <label>Account Code:</label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                     
                      <input list="accCList"  id="accCodId" name="acc_code" class="form-control  pull-left" value="" placeholder="Select Account Code" autocomplete="off">

                      <datalist id="accCList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach($accTypeData as $rows)

                         @if($rows->ATYPE_CODE == 'EV')
                         <option value="{{$rows->ACC_CODE}}"data-xyz ="{{ $rows->ACC_NAME }}">{{ $rows->ACC_CODE}} = {{ $rows->ACC_NAME }}</option>
                        @endif
                       @endforeach

                      </datalist>

                  </div>

                  <small id="accCodIdErr"></small>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('acc_code', '<p class="help-block" style="color:red;margin-right:8%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>
                
              </div>

            </div><!-- /.box-body -->
        </div>
    </div>

      {{-- <div class="col-sm-1"></div> --}}

</div>

     

</section>


<section class="content_comp">

    <div class="row">

      {{-- <div class="col-sm-1"></div> --}}

      <div class="col-sm-12">

        <div class="box box-warning Custom-Box">

            <div class="box-header with-border" style="text-align: Center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Bank Details</h2>


            </div><!-- /.box-header -->

          <div class="box-body">

               <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Bank Name : <span class="required-field"></span></label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-bank" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="bankName_id" name="bankName" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('bankName')}}" placeholder="Enter Bank Name" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('bankName', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->
                  
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Bank Branch Name : <span class="required-field"></span></label>

                          <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-bank" aria-hidden="true"></i></span>

                              <input type="text" id="branch_name_id" name="branch_name" class="form-control  pull-left FormTextFirstUpper" value="{{ old('branch_name')}}" placeholder="Select Branch Name" autocomplete="off" maxlength="40">

                          </div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('branch_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Bank IFSC No. : <span class="required-field"></span></label>

                          <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-bank" aria-hidden="true"></i></span>

                              <input type="text" id="bank_ifsc_id" name="bank_ifsc" class="form-control  pull-left" value="{{ old('bank_ifsc')}}" placeholder="Select IFSC Number" maxlength="10" autocomplete="off">

                          </div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('bank_ifsc', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->

                  

              </div>

              <!-- /.row -->

              <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Bank Account No. : <span class="required-field"></span></label>

                          <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-bank" aria-hidden="true"></i></span>

                              <input type="text" id="bank_account_id" name="bank_account" class="form-control  pull-left" value="{{ old('bank_account')}}" placeholder="Select Account Number" autocomplete="off" minlength="9" maxlength="19">

                          </div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('bank_account', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->
                    <div class="col-md-4">

                      <div class="form-group">

                          <label for="exampleInputEmail1">Bank MICR No. : </label>

                          <div class="input-group">

                              <div class="input-group-addon">

                              <i class="fa fa-bank" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="bank_micr_id" name="bank_micr" class="form-control  pull-left EmpOrgPosition FormTextFirstUpper" value="{{ old('bank_micr')}}" placeholder="Enter MICR Number" autocomplete="off" maxlength="10">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('bank_micr', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->

                </div>


              
          </div><!-- /.box-body -->

           

          </div>

      </div>

      {{-- <div class="col-sm-1"></div> --}}



    </div>

     

  </section>


<section class="content_comp">

    <div class="row">

      {{-- <div class="col-sm-1"></div> --}}

      <div class="col-sm-12">

        <div class="box box-info Custom-Box">

            <div class="box-header with-border" style="text-align: Center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Company Details</h2>


            </div><!-- /.box-header -->

          <div class="box-body">

               <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                       Joining Date : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calendar" aria-hidden="true"></i>

                          </div>

                           <input type="text" class="form-control" name="joining_date" value="{{old('joining_date')}}" placeholder="Select Joining Date" id="joining_date_id" autocomplete="off">
                       
                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('joining_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>


                  <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Designation : <span class="required-field"></span></label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-address-card" aria-hidden="true"></i>

                            </div>

                            <input list="desgList" id="designation_id" name="emp_designation" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('emp_designation')}}" placeholder="Enter Designation" autocomplete="off" maxlength="10"><br>



                            <input type="text" id="designation_name" name="desigN_name" value="" >






                            <datalist id='desgList'>
                              <?php foreach($designation_list as $key) { ?>

                              <option value='<?= $key->DESIG_CODE ?>' data-xyz='<?= $key->DESIG_NAME ?>'>{{ $key->DESIG_NAME }}</option>

                              <?php } ?>
                            </datalist>

                            <input type="hidden" id="desig_name" name="desig_name" value="">

                        </div>
                        <div class="pull-left showSeletedName" id="desigText"></div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('emp_designation', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->
                  
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Department : <span class="required-field"></span></label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>

                            <input list="emp_dept_list"  id="department_id" name="emp_department" class="form-control  pull-left" value="{{ old('emp_department')}}" placeholder="Select Company Name" maxlength="6" autocomplete="off">


                             <input type="text"  id="emp_department_name" name="deptR_name" readonly>


                            <datalist id="emp_dept_list">
                            
                               <option value="">--SELECT--</option>

                               @foreach($dept_list as $data1)

                                <option value="{{ $data1->DEPT_CODE }}" data-xyz ="{{ $data1->DEPT_NAME }}">{{ $data1->DEPT_CODE }} = {{ $data1->DEPT_NAME }}</option>

                               @endforeach

                            </datalist>

                            <input type="hidden" id="dept_name" name="dept_name" value="">

                          </div>

                          <div class="pull-left showSeletedName" id="deptText"></div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('emp_department', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                  </div><!-- /.col -->

                  

              </div>

              <!-- /.row -->

              <div class="row">

                  <div class="col-md-4">

                      <div class="form-group">

                        <label>

                        Grade : 

                        </label><span class="required-field"></span></label>

                         <div class="input-group">

                            <div class="input-group-addon">

                                <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                            </div>

                            <input list="emp_grade_list"  id="emp_grade_list_id" name="emp_grade" class="form-control  pull-left " value="{{ old('emp_grade')}}" placeholder="Select Employee Grade"  autocomplete="off" maxlength="6"><br>


                             <input type="text"  id="grade_nameto" name="Grade_Name" readonly>

                            <datalist id="emp_grade_list">

                              <?php foreach($grade_list as $key) { ?>
                                <option value="{{ $key->GRADE_CODE }}" data-xyz ="{{ $key->GRADE_NAME }}">{{ $key->GRADE_CODE }} = {{ $key->GRADE_NAME }}</option>
                               
                               <?php } ?>

                            </datalist>

                            <input type="hidden" id="grade_name" name="grade_name" value="">

                          </div>

                          <div class="pull-left showSeletedName" id="gradeText"></div>

                          <small>  

                            <div class="pull-left showSeletedName" id="glsch_codeText"></div>

                         </small>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('emp_grade', '<p class="help-block" style="color:red;">:message</p>') !!}

                            </small>

                      </div>
                    <!-- /.form-group -->
                    </div>

                    <div class="col-md-4">

                      <div class="form-group">

                          <label for="exampleInputEmail1">Org_Position : </label>

                          <div class="input-group">

                              <div class="input-group-addon">

                              <i class="fa fa-bars" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="org_position_id" name="org_position" class="form-control  pull-left EmpOrgPosition FormTextFirstUpper" value="{{ old('org_position')}}" placeholder="Enter Department" autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('org_position', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->

                  <div class="col-md-4">

                      <div class="form-group">

                          <label for="exampleInputEmail1">Company Code : <span class="required-field"></span></label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input id="comp_code_id" name="comp_code" class="form-control  pull-left" value="{{ $comp_code}}" placeholder="Select Company Name" maxlength="6" autocomplete="off" readonly="">

                          <!-- <datalist id="comp_code_list">
                          
                             <option value="">--SELECT--</option>

                             @foreach($comp_list as $row)

                              <option value="{{ $row->COMP_CODE }}" data-xyz ="{{ $row->COMP_NAME }}">{{ $row->COMP_CODE }} = {{ $row->COMP_NAME }}</option>

                             @endforeach

                          </datalist> -->

                          <input type="hidden" id="comp_name" name="comp_name" value="{{$comp_name}}">

                        </div>

                          <div class="pull-left showSeletedName" id="compText">{{$comp_name}}</div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('comp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->



                </div>


              <div class="row">

                    <div class="col-md-4">

                      <div class="form-group">

                          <label for="exampleInputEmail1">Plant Code : <span class="required-field"></span></label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input list="plant_code_list"  id="plant_code_id" name="plant_code" class="form-control  pull-left" value="{{ old('plant_code')}}" placeholder="Select Company Name" maxlength="6" autocomplete="off" ><br>

                             <input type="text"  id="plant_nameto" name="Plant_Name" readonly>

                            <datalist id="plant_code_list">
                          
                             <option value="">--SELECT--</option>

                             @foreach($plant_list as $key)

                              <option value="{{ $key->PLANT_CODE  }}" data-xyz ="{{ $key->PLANT_NAME }}">{{ $key->PLANT_CODE }} = {{ $key->PLANT_NAME }}</option>

                             @endforeach

                            </datalist>

                            <input type="hidden" id="plant_name" name="plant_name" value="">

                          </div>

                          <div class="pull-left showSeletedName" id="plantText"></div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->

                  <div class="col-md-4">

                      <div class="form-group">

                          <label for="exampleInputEmail1">Profit Center Code : <span class="required-field"></span></label>


                          <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input list="Profit_center_code_list"  id="Profit_center_code_id" name="Profit_center_code" class="form-control  pull-left" value="{{ old('Profit_center_code')}}" placeholder="Select Company Name" maxlength="6" ><br>


                              <input type="text"  id="pfct_name_bind" name="ptct_name" readonly >


                            <datalist id="Profit_center_code_list">
                            
                               <option value="">--SELECT--</option>

                               @foreach($profit_list as $rows)

                                <option value="{{ $rows->PFCT_CODE }}" data-xyz ="{{ $rows->PFCT_NAME }}">{{ $rows->PFCT_CODE }} = {{ $rows->PFCT_NAME }}</option>

                               @endforeach

                            </datalist>

                            <input type="hidden" id="pfct_name" name="pfct_name" value="">

                          </div>

                          <div class="pull-left showSeletedName" id="pfctText"></div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('Profit_center_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->

                  <div class="col-md-4">

                      <div class="form-group">

                        <label for="exampleInputEmail1">Cost Code : </label>


                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input list="cost_code_list"  id="cost_code_id" name="cost_code" class="form-control  pull-left" value="{{ old('cost_code')}}" placeholder="Select Company Name" maxlength="6" ><br>

                             <input type="text"  id="emp_cost_name" name="costST_NameE" readonly >

                            <datalist id="cost_code_list">
                            
                               <option value="">--SELECT--</option>

                               @foreach($cost_list as $keys)

                                <option value="{{ $keys->COST_CODE }}" data-xyz ="{{ $keys->COST_NAME }}">{{ $keys->COST_CODE }} = {{ $keys->COST_NAME }}</option>

                               @endforeach

                            </datalist>

                            <input type="hidden" id="cost_name" name="cost_name" value="">

                          </div>

                          <div class="pull-left showSeletedName" id="costText"></div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('cost_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->



                </div><!-- /.row -->


                <div class="row">

                    <div class="col-md-4">

                      <div class="form-group">

                          <label for="exampleInputEmail1">ESIC No. : </label>

                          <div class="input-group">

                              <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="esic_no_id" name="esic_no" class="form-control  pull-left" value="{{ old('esic_no')}}" placeholder="Enter ESIC No" autocomplete="off" maxlength="12">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('esic_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->


                    <div class="col-md-4">

                      <div class="form-group">

                          <label for="exampleInputEmail1">EPF No : </label>

                          <div class="input-group">

                              <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="epf_no_id" name="epf_no" class="form-control  pull-left" value="{{ old('epf_no')}}" placeholder="Enter Plant Code" autocomplete="off" maxlength="12">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('epf_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->

                  <div class="col-md-4">

                      <div class="form-group">

                          <label for="exampleInputEmail1">EPFO_UAN No. : </label>

                          <div class="input-group">

                              <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="epfo_uan_no_id" name="epfo_uan_no" class="form-control  pull-left" value="{{ old('epfo_uan_no')}}" placeholder="Enter EPFO_UAN No" autocomplete="off" maxlength="12">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('epfo_uan_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->



                </div><!-- /.row -->


                <div class="row">

                    <div class="col-md-4">

                      <div class="form-group">

                          <label for="exampleInputEmail1">Left Date : <span class="required-field"></span></label>

                          <div class="input-group">

                              <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="left_date_id" name="left_date" class="form-control  pull-left" value="{{ old('left_date')}}" placeholder="Enter Left Date" autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('left_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->


                    <div class="col-md-4">

                      <div class="form-group">

                          <label for="exampleInputEmail1">Left Reason : </label>

                          <div>

                              <textarea id="left_reason_id" name="left_reason" class="form-control FormTextFirstUpper" autocomplete="off" >
                              <?php echo old('left_reason'); ?> 
                            </textarea>

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('left_reason', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div><!-- /.col -->

                </div><!-- /.row -->
              
          </div><!-- /.box-body -->

           

          </div>

      </div>

      {{-- <div class="col-sm-1"></div> --}}



    </div>

     

  </section>

  <section class="content_comp">

    <div class="row">

      {{-- <div class="col-sm-1"></div> --}}

      <div class="col-sm-12">

        <div class="box box-warning Custom-Box">

            <div class="box-header with-border" style="text-align: Center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Employee Address</h2>


            </div><!-- /.box-header -->

          <div class="box-body">

              <div class="PerAddress">Present Address : </div>

               <div class="row">

                  <div class="col-md-2"></div>


                  <div class="col-md-8">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Address : <span class="required-field"></span></label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-address-card" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="address_line_1_id" name="address_line_1" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('address_line_1')}}" placeholder="Flat,  House no, Building, Company, Apartment" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('address_line_1', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->
                  
                 <div class="col-md-2"></div>

                  

              </div>

              <!-- /.row -->

              <div class="row">

                  <div class="col-md-2"></div>


                  <div class="col-md-8">

                    <div class="form-group">

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-address-card" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="address_line_2_id" name="address_line_2" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('address_line_2')}}" placeholder="Area, Colony, Street, Sector, Village" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('address_line_2', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->
                  
                 <div class="col-md-2"></div>

                  

              </div>


              <div class="row">

                  <div class="col-md-2"></div>


                  <div class="col-md-8">

                    <div class="form-group">

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-address-card" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="address_line_3_id" name="address_line_3" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('address_line_3')}}" placeholder="Landmark e.g. near XYZ Hospital/Temple/School" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('address_line_3', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->
                  
                 <div class="col-md-2"></div>

                
              </div>

              <div class="row">

                  <div class="col-md-2"></div>


                  <div class="col-md-8">

                    <div class="col-md-6">

                      <div class="form-group">

                        <label for="exampleInputEmail1">Pin Code : <span class="required-field"></span></label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="pin_code_id" name="pin_code" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('pin_code')}}" placeholder="Enter Pincode" autocomplete="off">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('pin_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                    </div>

                    <div class="col-md-6">

                      <div class="form-group">

                        <label for="exampleInputEmail1">City : <span class="required-field"></span></label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-home" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="add_city_id" name="add_city" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('add_city')}}" placeholder="Enter City" autocomplete="off" maxlength="20">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('add_city', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                    </div>
                    
                </div><!-- /.col -->
                  
                 <div class="col-md-2"></div>

                  

              </div>

              <div class="row">

                  <div class="col-md-2"></div>


                  <div class="col-md-8">

                    <div class="col-md-6">

                      <div class="form-group">

                          <label for="exampleInputEmail1">State : <span class="required-field"></span></label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>

                            <input list="state"  id="add_state_id" name="add_state" class="form-control  pull-left" value="{{ old('add_state')}}" placeholder="Select State Name" ><br>


                            <input type="text" id="add_state_name" name="emp_add_state" readonly>

                          <datalist id="state">
                          
                             <option value="">--SELECT--</option>

                             @foreach($state_list as $key)

                              <option value="{{ $key->STATE_CODE  }}" data-xyz ="{{ $key->STATE_NAME }}">{{ $key->STATE_CODE }} = {{ $key->STATE_NAME }}</option>

                             @endforeach

                          </datalist>

                        </div>

                          <div class="pull-left showSeletedName" id="plantText"></div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('add_state', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div>

                    

                    <div class="col-md-6">

                      <div class="form-group">

                        <label for="exampleInputEmail1">Country : <span class="required-field"></span></label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-globe" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="add_country_id" name="add_country" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="India" placeholder="Enter Country" autocomplete="off" readonly="true" maxlength="20">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('add_country', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                    </div>

                    

                </div><!-- /.col -->
                  
                 <div class="col-md-2"></div>

                  

              </div>


              <div class="row" style="margin-top: 4%;">
                
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                  <div>
                    <div class="PerAddress">
                      Permanent Address : 
                    </div>
                    <div class='SameAsAbove'>
                      <div>
                        Same As Above : 
                      </div>
                      <input type="checkbox" name="sameAsAbouveAddress" id="AddSameCheckBox" class="CheckBoxAddSame form-check-input" value="{{ old('sameAsAbouveAddress')}}">
                    </div>
                  </div>
                </div>
                <div class="col-sm-4"></div>


              </div>
                
              <div class="row">

                  <div class="col-md-2"></div>


                  <div class="col-md-8">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Address : <span class="required-field"></span></label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-address-card" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="perm_address_line_1_id" name="perm_address_line_1" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('perm_address_line_1')}}" placeholder="Flat,  House no, Building, Company, Apartment" autocomplete="off">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('perm_address_line_1', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->
                  
                 <div class="col-md-2"></div>

                  

              </div>

              <!-- /.row -->

              <div class="row">

                  <div class="col-md-2"></div>


                  <div class="col-md-8">

                    <div class="form-group">

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-address-card" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="perm_address_line_2_id" name="perm_address_line_2" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('perm_address_line_2')}}" placeholder="Area, Colony, Street, Sector, Village" autocomplete="off" maxlength="40">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('perm_address_line_2', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->
                  
                 <div class="col-md-2"></div>

                  

              </div>


              <div class="row">

                  <div class="col-md-2"></div>


                  <div class="col-md-8">

                    <div class="form-group">

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-address-card" aria-hidden="true"></i>

                            </div>

                            <input type="text" id="perm_address_line_3_id" name="perm_address_line_3" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('perm_address_line_3')}}" placeholder="Landmark e.g. near XYZ Hospital/Temple/School" autocomplete="off" maxlength="40">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('perm_address_line_3', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->
                  
                 <div class="col-md-2"></div>

                
              </div>

              <div class="row">

                  <div class="col-md-2"></div>


                  <div class="col-md-8">

                    <div class="col-md-6">

                      <div class="form-group">

                        <label for="exampleInputEmail1">Pin Code : <span class="required-field"></span></label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="perm_pin_code_id" name="perm_pin_code" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('perm_pin_code')}}" placeholder="Enter Pincode" autocomplete="off" maxlength="6">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('perm_pin_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                    </div>

                    <div class="col-md-6">

                      <div class="form-group">

                        <label for="exampleInputEmail1">City : <span class="required-field"></span></label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-home" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="perm_add_city_id" name="perm_add_city" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('perm_add_city')}}" placeholder="Enter City" autocomplete="off" maxlength="20">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('perm_add_city', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                    </div>
                    
                </div><!-- /.col -->
                  
                 <div class="col-md-2"></div>

                  

              </div>

              <div class="row">

                  <div class="col-md-2"></div>


                  <div class="col-md-8">

                    <!-- <div class="col-md-6">

                      <div class="form-group">

                          <label for="exampleInputEmail1">State : <span class="required-field"></span></label>

                          <div class="input-group">

                            <input list="state"  id="add_state_id" name="add_state" class="form-control  pull-left" value="{{ old('add_state')}}" placeholder="Select State Name" maxlength="11" >

                          <datalist id="state">
                          
                             <option value="">--SELECT--</option>

                             @foreach($state_list as $key)

                              <option value="{{ $key->STATE_CODE  }}" data-xyz ="{{ $key->STATE_NAME }}">{{ $key->STATE_CODE }} = {{ $key->STATE_NAME }}</option>

                             @endforeach

                          </datalist>

                        </div>

                          <div class="pull-left showSeletedName" id="plantText"></div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('add_state', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                      

                    </div> -->

                    <div class="col-md-6">

                      <div class="form-group">

                          <label for="exampleInputEmail1">State : <span class="required-field"></span></label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-building-o" aria-hidden="true"></i></span>

                            <input list="state"  id="perm_add_state_id" name="perm_add_state" class="form-control  pull-left" value="{{ old('perm_add_state')}}" placeholder="Select State Name" maxlength="20" >

                             <input list="state"  id="perm_add_state_name" name="emp_perm_add_state" readonly>

                          <datalist id="state">
                          
                             <option value="">--SELECT--</option>

                             @foreach($state_list as $key)

                              <option value="{{ $key->STATE_CODE  }}" data-xyz ="{{ $key->STATE_NAME }}">{{ $key->STATE_CODE }} = {{ $key->STATE_NAME }}</option>

                             @endforeach

                          </datalist>

                        </div>

                          <div class="pull-left showSeletedName" id="plantText"></div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('state_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                  </div>


                    <div class="col-md-6">

                      <div class="form-group">

                        <label for="exampleInputEmail1">Country : <span class="required-field"></span></label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-globe" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="perm_add_country_id" name="perm_add_country" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="India" placeholder="Enter Country" autocomplete="off" readonly="true" maxlength="20">

                          </div>

                          <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('perm_add_country', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                      </div>

                    </div>

                    

                </div><!-- /.col -->
                  
                 <div class="col-md-2"></div>

                  

              </div>

            </div><!-- /.box-body -->


          </div>

      </div>

      {{-- <div class="col-sm-1"></div> --}}



    </div>

     

  </section>

  <section class="content_comp">

    <div class="row">

      {{-- <div class="col-sm-1"></div> --}}

      <div class="col-sm-12">

        <div class="box box-info Custom-Box">

            <div class="box-header with-border" style="text-align: Center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Upload Document</h2>


            </div><!-- /.box-header -->

          <div class="box-body">

               <div class="row" style="margin-top: 1%;">

                  <div class="col-md-4">



                    <div class="form-group">

                        <label for="exampleInputEmail1">Passport : </label>

                        <input type="file" class="form-control-file" name="passport" value="{{ old('passport')}}" id="passport_id">

                    </div>

                </div><!-- /.col -->
                  
                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Adhar Card : </label>

                          <input type="file" id="adharcard_id" name="adharcard" class="form-control-file" value="{{ old('adharcard')}}">

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('adharcard', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">PAN Card : </label>

                          <input type="file" id="pancard_id" name="pancard" class="form-control-file" value="{{ old('pancard')}}">

                        <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('pancard', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                </div><!-- /.col -->

                  

              </div>

              <!-- /.row -->

              <div class="row" style="margin-top: 3%;">

                  <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Voter-Id : </span></label>

                          <input type="file" id="voter_id" name="voter_id" class="form-control-file" value="{{ old('voter_id')}}">

                    </div>

                  </div><!-- /.col -->

                    <div class="col-md-4">

                      <div class="form-group">

                          <label for="exampleInputEmail1">Driving Licence : </label>

                            <input type="file" id="drivingcard_id" name="drivingcard" class="form-control-file" value="{{ old('drivingcard')}}">

                      </div>

                    </div><!-- /.col -->

                </div>

                <div style="text-align: center;margin-top: 4%;margin-bottom: 1%;">

                 <button type="Submit" class="btn btn-primary">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                 </button>

              </div>

            </form>


              
          </div><!-- /.box-body -->

           

          </div>

      </div>

      {{-- <div class="col-sm-1"></div> --}}



    </div>

     

  </section>

              
             </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="strategy">
            <div class="design-process-content">

                <section class="content">

                  <div class="row">

                    {{-- <div class="col-sm-1"></div> --}}

                    <div class="col-sm-12">

                      <div class="box box-primary Custom-Box">

                          <div class="box-header with-border" style="text-align: center;">

                            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Employee Family Details</h2>
                          
                          </div><!-- /.box-header -->

                        <div class="box-body">

                          <form   id="addemployDetail"  method="POST" >

                             @csrf

                             <div class="row">

                              <div class="col-md-3">

                                <div class="form-group">

                                  <label for="exampleInputEmail1">Employee Code : <span class="required-field"></span></label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                        <input list="emp_code_list"  id="rel_emp_code_id" name="rel_emp_code" class="form-control  pull-left" value="{{ old('rel_emp_code')}}" placeholder="Select Employee Code" maxlength="6">

                                      <datalist id="emp_code_list">
                                      
                                         <option value="">--SELECT--</option>

                                         @foreach($emp_list as $rows)

                                          <option value="{{ $rows->EMP_CODE }}" data-xyz ="{{ $rows->EMP_NAME }}">{{ $rows->EMP_CODE }} = {{ $rows->EMP_NAME }}</option>

                                         @endforeach

                                      </datalist>

                                      <input type="hidden" id="rel_emp_name" name="rel_emp_name" value="">

                                    </div>
                                     <small id="rel_emp_codeErr" class="form-text text-muted"></small>

                                    <div class="pull-left showSeletedName" id="codeText"></div>

                                  <small id="emailHelp" class="form-text text-muted">

                                        {!! $errors->first('rel_emp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>

                              </div>

                              </div><!-- /.col -->

                                <div class="col-md-5">

                                <div class="form-group">

                                  <label for="exampleInputEmail1">Father/Mother/Wife Name : <span class="required-field"></span></label>

                                  <div class="input-group">

                                      <div class="input-group-addon">

                                        <i class="fa fa-user" aria-hidden="true"></i>

                                      </div>

                                      <input type="text" id="relative_name_id" name="relative_name" class="form-control  pull-left EmpName FormTextFirstUpper" value="{{ old('relative_name')}}" placeholder="Enter Father/Mother/Wife Full Name" autocomplete="off">

                                  </div>
                                  
                                  <small id="relative_name_idErr" class="form-text text-muted"></small>
                                  <small id="emailHelp" class="form-text text-muted">

                                        {!! $errors->first('relative_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                                  </small>

                              </div>

                              </div><!-- /.col -->

                              <div class="col-md-4">

                                <div class="form-group">

                                    <label>

                                      Date Of Birth : 

                                      <span class="required-field"></span>

                                    </label>

                                    <div class="input-group">

                                        <div class="input-group-addon">

                                            <i class="fa fa-calendar" aria-hidden="true"></i>

                                        </div>

                                      <input type='text'  id="relative_date_of_birth_id" name="relative_date_of_birth" class="form-control  pull-left " value="{{ old('relative_date_of_birth')}}" placeholder="Select Date Of Birth"  autocomplete="off">

                                  </div>
                                        <small id="relative_date_of_birthErr" class="form-text text-muted"></small>
                                        <small id="emailHelp" class="form-text text-muted">

                                            {!! $errors->first('relative_date_of_birth', '<p class="help-block" style="color:red;">:message</p>') !!}

                                        </small>

                                </div>
                                <!-- /.form-group -->
                            </div>


                              
                            
                            </div>

                            <!-- /.row -->

                              <!-- /.row -->

                              <div class="row">

                                <div class="col-md-4">

                                <div class="form-group">

                                    <label for="exampleInputEmail1">Relation : <span class="required-field"></span></label>

                                      <div class="input-group">

                                        <div class="input-group-addon">

                                          <i class="fa fa-home" aria-hidden="true"></i>

                                        </div>

                                        <input type="text" id="relation_with_emp_id" name="relation_with_emp" class="form-control  pull-left EmpDepartment FormTextFirstUpper" value="{{ old('relation_with_emp')}}" placeholder="Enter Relation With Employee" autocomplete="off" maxlength="10">

                                      </div>
                                      <small id="relation_with_empErr" class="form-text text-muted"></small>
                                      <small id="emailHelp" class="form-text text-muted">

                                          {!! $errors->first('relation_with_emp', '<p class="help-block" style="color:red;">:message</p>') !!}

                                      </small>

                                </div>

                              </div><!-- /.col -->


                                  <div class="col-md-4">

                                    <div class="form-group">

                                        <label for="exampleInputEmail1">Gender : <span class="required-field"></span></label>

                                        <div class="input-group" style="margin-top: 3%;">

                                          <input class="form-check-input"type="radio" name="relative_gender"
                                                id="relative_gender_idvalue">&nbsp;&nbsp;&nbsp;

                                          <label class="form-check-label" for="inlineRadio1">Male</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                          <input class="form-check-input"  type="radio" name="relative_gender"  id="relative_gender_id" value="Female"/>&nbsp;&nbsp;&nbsp;
                                        <label class="form-check-label" for="inlineRadio1">Female</label>

                                      </div>
                                        <small id="relative_genderErr" class="form-text text-muted"></small>
                                        <small id="emailHelp" class="form-text text-muted">

                                            {!! $errors->first('relative_gender', '<p class="help-block" style="color:red;">:message</p>') !!}

                                        </small>

                                    </div>

                                </div><!-- /.col -->


                                <div class="col-md-4">

                                <div class="form-group">

                                    <label for="exampleInputEmail1">Email-Id : <span class="required-field"></span></label>

                                      <div class="input-group">

                                        <div class="input-group-addon">

                                          <i class="fa fa-envelope" aria-hidden="true"></i>

                                        </div>

                                        <input type="text" id="relative_email_id" name="relative_email" class="form-control  pull-left EmpDepartment FormTextFirstUpper" value="{{ old('relative_email')}}" placeholder="Enter Relation With Employee" autocomplete="off" maxlength="20">

                                      </div>
                                      <small id="relative_emailErr" class="form-text text-muted"></small>
                                      <small id="emailHelp" class="form-text text-muted">

                                          {!! $errors->first('relative_email', '<p class="help-block" style="color:red;">:message</p>') !!}

                                      </small>

                                </div>

                              </div><!-- /.col -->

                            </div>

                            <!-- /.row -->

                              <div class="row">

                                <div class="col-md-4">

                                <div class="form-group">

                                    <label for="exampleInputEmail1">Mobile No. : <span class="required-field"></span></label>

                                      <div class="input-group">

                                        <div class="input-group-addon">

                                          <i class="fa fa-mobile" aria-hidden="true"></i>

                                        </div>

                                        <input type="text" id="relative_mob_id" name="relative_mob" class="form-control  pull-left Number" value="{{ old('relative_mob')}}" placeholder="Enter Mobile Number" autocomplete="off" maxlength="10">

                                      </div>
                                      <small id="relative_mobErr" class="form-text text-muted"></small>
                                      <small id="emailHelp" class="form-text text-muted">

                                          {!! $errors->first('relative_mob', '<p class="help-block" style="color:red;">:message</p>') !!}

                                      </small>

                                </div>

                              </div><!-- /.col -->

                            </div>
                            <div style="text-align: center;margin-top: 1%;margin-bottom: 1%;">

                               <button type="button" class="btn btn-primary" id="submitEmpFamilyDetail">

                              <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                               </button>
                        
                            </div>
                          </form>
                        </div><!-- /.box-body -->
                      </div>
                    </div>
                  </div>
                </section>
              </div>
            </div>

          <div role="tabpanel" class="tab-pane" id="optimization">
            <section class="content" style="margin-top: 2%;">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">

        

          <div class="box-body">

         

            <form method="POST" id="emplyeCarerDetail"> 

              @csrf

              <div class="table-responsive empTable">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="careertbl">

                  <tr>

                    <th><input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row"></th>

                    <th>Sr.No.</th>

                    <th>Employee Code</th>

                    <th>Company Name</th>

                    <th>Designation</th>

                    <th>Department</th>

                    <th>From / To Date</th>

                  </tr>

                  <tr class="useful">



                    <td class="tdthtablebordr" style='padding-top: 23px;'>
                      <input type='checkbox' class='case' title="Delete Single Row" />
                    </td>

                    <td class="tdthtablebordr" style='padding-top: 22px;'>

                      <span id='snum'>1.</span>

                      <input type='hidden' name='CareerDetlSlno[]' id='CareerDetlSlno_id' value='1'>

                    </td> 

                    <td class="tdthtablebordr">

                      <div class="input-group">

                      <input list='empList' class='inputboxclr form-control getacccode debitcreditbox emplyCode FormTextFirstUpper' style="text-align: left;width: 107px;" id='emp_code1' name='emp_code[]' placeholder='Emp Code' maxlength="6">


                         <input type="text" name='emp_name[]' id='emp_name1'placeholder='Emp Name' maxlength="6" readonly>



                        <datalist id='empList'>
                          <option selected='selected' value=''>-- Select --</option>
                            @foreach ($emp_list as $key)
                              <option value='<?php echo $key->EMP_CODE?>' data-xyz ='<?php echo $key->EMP_NAME; ?>' ><?php echo $key->EMP_NAME ; echo ' ['.$key->EMP_CODE.']' ; ?>
                            
                              </option>
                            @endforeach
                        </datalist>

                      </div>
                      <div class="pull-left showSeletedName" id="empNameGet"></div>
                      <small id="employCodeErr1"></small>
                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('emp_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </td>

                    <td class="tdthtablebordr">

                      <input type="text" class="inputboxclr form-control companyNameBox FormTextFirstUpper" placeholder='Enter Company Name'  id='comp_name1' name="comp_name[]" value="{{ old('comp_name')}}" maxlength="40">

                      <br><small id="compNameErr1"></small>

                    </td>

                    <td class="tdthtablebordr">

                      <!-- <input type='text' class="designationBox dr_amount inputboxclr" placeholder='Enter Designation'  id='designation1' name="designation[]"/ value="{{ old('designation')}}"> -->

                      <input list="desgList" id="designation1" name="designation[]" class="form-control  pull-left EmpDesignation FormTextFirstUpper" value="{{ old('designation')}}" placeholder="Enter Designation" autocomplete="off"><br>


                      <input type="text" id="designationname1" name="designation_name[]" readonly>



                            <datalist id='desgList'>
                              <?php foreach($designation_list as $key) { ?>

                              <option value='<?= $key->DESIG_CODE ?>' data-xyz='<?= $key->DESIG_NAME ?>'>{{ $key->DESIG_NAME }}</option>

                              <?php } ?>
                            </datalist>

                      <br><small id="designtnErr1"></small>

                    </td>

                    <td class="tdthtablebordr">

                      <input list='deptlist' class='form-control  pull-left EmpDesignation FormTextFirstUpper' style='' id='deptList1' name='DeptList[]' placeholder='Select Department' maxlength="20" /><br>

                        <input type="text" id='deptName1' name='DeptListName[]' placeholder='Select Department' maxlength="20" />

                      <datalist id='deptlist'>
                        <option selected='selected' value=''>
                          -- Select --
                        </option>
                          @foreach ($dept_list as $row)
                            <option value='<?php echo $row->DEPT_CODE?>' data-xyz ='<?php echo $row->DEPT_NAME; ?>' >
                              <?php echo $row->DEPT_NAME ; echo ' ['.$row->DEPT_CODE.']' ; ?>
                              
                            </option>
                          @endforeach
                      </datalist>

                      <br><small id="deptListErr1"></small>
                    </td>

                    <td class="tdthtablebordr">
                      <div class="row">
                        <div class="col-md-6">
                           <input type="text" class="inputboxclr form-control form_date FormTextFirstUpper" style="width: 100px;text-align: center;" id='form_date1' name="form_date[]"  placeholder="From Date" / value="{{ old('from_date')}}">
                        </div>
                        <div class="col-md-6">
                           <input type="text" style="width: 100px;text-align: center;" class="form-control to_date FormTextFirstUpper"  name="to_date[]" id="to_date1" placeholder="To Date" value="{{ old('to_date')}}">
                        </div>
                      </div>

                     

                     
                      <br>
                      <small id="toDateErr1"></small>
                      <small id="fromDateErr1"></small>
                    </td>

                  </tr>

                </table>

              </div>

              <button type="button" class='btn btn-danger delete' id="deletehidn"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

              <button type="button" class='btn btn-primary addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 13px;"></i>&nbsp; Add More</button>

              <div class="col-md-12"><span id="careerErrShow"></span></div>

              <p class="text-center">

               <!--  <button type="button" class="btn btn-success" id="checkValidation">Ok</button> -->

                <button class="btn btn-success" type="button" id="submitEmpCareerData"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

              </p>


            </form>


          </div><!-- /.box-body -->



        </div>



      </div>



    </div>



  </section>
          </div>

  <div role="tabpanel" class="tab-pane" id="content">
      <section class="content" style="margin-top: 2%;">

        <div class="row">

            <div class="col-sm-12">

              <form method="POST" id="emplyeEductnDetail"> 

              @csrf
              <div class="box box-primary Custom-Box">

                  <div class="box-body" style="overflow-x: auto;">

                      <div class="divTable">
                        <div class="divTableBody">
                          <div class="divTableRow trrowget">
                              
                              <div class="divTableCell"></div>
                              <div class="divTableCell">Sr.No</div>
                              <div class="divTableCell">Emp Code</div>
                              <div class="divTableCell">Course Name</div>
                              <div class="divTableCell">University Name</div>
                              <div class="divTableCell">Passing Year</div>
                              <div class="divTableCell">Percentage</div>
                              
                          </div>

                          <div class="divTableRow rowcount TextBoxesGroup_1 trrowget">

                              <div class="divTableCell">
                                <div class='TextBoxesGroup'>
                                  <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                                    
                                    <input type="checkbox" class="casecheck" id="tablesecnd1">
                                  </div>
                                </div>
                              </div>
                            
                              <div class="divTableCell">
                                <div class='TextBoxesGroup'>
                                  <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                                  <span id="snumtwo1">1.</span>
                                  <input type='hidden' name='EductnDetlSlno[]' id='EductDetlSlno_id1' value='1'>
                                  </div>
                                </div>
                              </div>

                              <div class="divTableCell">
                                <div class='TextBoxesGroup'>
                                  <div id="TextBoxDiv1" style="padding-top: 10px;">

                                    <input list="empListedu" type='textbox' id='emp_edu1' style="width: 103px;" name="empl_code[]" value="{{ old('empl_code') }}" maxlength="6"><br>

                                      <input type="text" id='emp_edu_name1'name="empl_name[]" readonly>
                                   
                                    <datalist id='empListedu'>
                                      <option selected='selected' value=''>-- Select --</option>
                                        @foreach ($emp_list as $key)
                                          <option value='<?php echo $key->EMP_CODE?>' data-xyz ='<?php echo $key->EMP_NAME; ?>' ><?php echo $key->EMP_NAME ; echo ' ['.$key->EMP_CODE.']' ; ?>
                                        
                                          </option>
                                        @endforeach
                                    </datalist>
                                   
                                  </div>
                                   <small id="emp_eduMSg1"></small>
                                </div>
                              </div>

                              <div class="divTableCell">
                                <div class='TextBoxesGroup'>
                                    <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                                      <input type='textbox' id='courseName1'  name="course_name[]" value="{{ old('course_name') }}" maxlength="20" autocomplete="off">

                                     </div>
                                     <small id="courseNameMSg1"></small>
                                  </div>
                              </div>

                              <div class="divTableCell">
                                <div class='TextBoxesGroup'>
                                    <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                                      <input type='textbox' id='university1'  name="universit_name[]" value="{{ old('universit_name') }}" autocomplete="off">

                                    </div>
                                    <small id="universityMSg1"></small>
                                </div>
                              </div>

                              <div class="divTableCell">
                                <div class='TextBoxesGroup'>
                                  <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                                    <input type='textbox' id='passingYear1' name="passing_year[]" style="width: 100px;" value="{{ old('passing_year') }}" maxlength="4" autocomplete="off">

                                   </div>
                                   <small id="passingYearMSg1"></small>
                                </div>
                              </div>

                              <div class="divTableCell">
                                <div class='TextBoxesGroup'>
                                  <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                                    <input type='textbox' id='percentage1'  name="percentage[]" style="width: 100px;" value="{{ old('percentages') }}"  maxlength="5" autocomplete="off">

                                   </div>
                                   <small id="percentageMSg1"></small>
                                </div>
                              </div>

                          </div>

                        </div>

                        

                       </div>

                  </div>

                  <div class="row" style="margin: 0px;">
                    <div class="col-md-12">

                  <button type="button" class='btn btn-danger btn-sm removeBtntbl' id="removeButton"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                  <button type="button" class='btn btn-primary btn-sm' id="addButton"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

                  
                  
                  </div>
                  <div class="col-md-12"><span id="eduErrShow"></span></div>
                  
                </div>
                <p class="text-center">

                    <button class="btn btn-success" type="button" id="submitEmpEduData"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                </p><br>



                </div>
              </form>
              </div>
          </div>
      </section>
  </div>
        </div>
      </div>
    </div>
  </section>

</div>




@include('admin.include.footer')


<script type="text/javascript">
$(document).ready(function(){
  $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
    if (keycode == 46 || this.value.length==10) {
    return false;
  }
});
  $('.AdharNo').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
    if (keycode == 46 || this.value.length==12) {
    return false;
  }
});

$('.PanNo').keypress(function (event) {
    var keycode = event.which;
    
    if (this.value.length==10) {
    return false;
  }
});


});

$(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Emp Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;left:58.815px" id="closeModel">X</a>',
        html:true,
        content:  $('#myForm').html()
    }).on('click', function(){
      // had to put it within the on click action so it grabs the correct info on submit
      $('#serachcode').click(function(){

           $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

           });

          var HelpEmpCode = $('#empcodeH').val();

           if(HelpEmpCode == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-emp-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpEmpCode: HelpEmpCode},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Emp Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                         console.log('data');

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.EMP_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.EMP_NAME+'</td></tr>');
                             });
                      }
                 }

              });
           }
      })
  })
})

$(document).ready(function(){

  $(".FormTextFirstUpper").keyup(function () {  
        $('.FormTextFirstUpper').css('textTransform', 'capitalize');  
    });





  $('#joining_date_id').datepicker({

            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            todayHighlight: 'true',
            autoclose: 'true'
    });

    $('#date_of_birth_id').datepicker({

            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            todayHighlight: 'true',
            autoclose: 'true'
    });

    $('#left_date_id').datepicker({

            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            todayHighlight: 'true',
            autoclose: 'true'
    }); 


    $('#relative_date_of_birth_id').datepicker({

            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            todayHighlight: 'true',
            autoclose: 'true'
    });

    $('.form_date').datepicker({

            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            todayHighlight: 'true',
            autoclose: 'true'
    });

    $('.to_date').datepicker({

            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            todayHighlight: 'true',
            autoclose: 'true'
    });

    $('#AddSameCheckBox').change(function() {

        if($(this).is(":checked")) {

            var returnVal = 'CHECKED...!';
            
            var addL1   = $('#address_line_1_id').val();
            var addL2   = $('#address_line_2_id').val();
            var addL3   = $('#address_line_3_id').val();
            var pinC    = $('#pin_code_id').val();
            var City    = $('#add_city_id').val();
            var state   = $('#add_state_id').val();
            var country = $('#add_country_id').val();


            $('#perm_address_line_1_id').val(addL1).prop('readonly', 'true');
            $('#perm_address_line_2_id').val(addL2).prop('readonly', 'true');;
            $('#perm_address_line_3_id').val(addL3).prop('readonly', 'true');;
            $('#perm_pin_code_id').val(pinC).prop('readonly', 'true');;
            $('#perm_add_city_id').val(City).prop('readonly', 'true');;
            $('#perm_add_state_id').val(state).prop('readonly', 'true');;
            $('#perm_add_country_id').val(country).prop('readonly', 'true');;



        }else{

          var returnVal1 = 'UN-CHECKED...!';
            
            $('#perm_address_line_1_id').val('').removeAttr('readonly');
            $('#perm_address_line_2_id').val('').removeAttr('readonly');
            $('#perm_address_line_3_id').val('').removeAttr('readonly');
            $('#perm_pin_code_id').val('').removeAttr('readonly');
            $('#perm_add_city_id').val('').removeAttr('readonly');
            $('#perm_add_state_id').val('').removeAttr('readonly');
            $('#perm_add_country_id').val('').removeAttr('readonly');
        }
               
    });


    $("#plant_code_id").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#plant_code_list option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        document.getElementById("plantText").innerHTML = msg; 

        $('#plant_nameto').val(msg);

        if(msg == 'No Match'){

            $('#plant_code_id').val('');
            $('#plant_nameto').val('');
        }


    });


    // $("#comp_code_id").bind('change', function () {  

    //     var val = $(this).val();

    //     var xyz = $('#comp_code_list option').filter(function() {

    //     return this.value == val;

    //     }).data('xyz');

    //     var msg = xyz ?  xyz : 'No Match';

    //     document.getElementById("compText").innerHTML = msg;

    //     $('#comp_name').val(msg); 

    //     if(msg == 'No Match'){

    //         $('#comp_code_id').val('');

    //         $('#comp_name').val(msg);
    //     }


    // });

    $("#designation_id").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#desgList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        document.getElementById("desigText").innerHTML = msg;

        $('#designation_name').val(msg);

        if(msg == 'No Match'){

          $('#designation_id').val('');
          $('#designation_name').val('');  
        }


    });

    $("#emp_grade_list_id").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#emp_grade_list option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        document.getElementById("gradeText").innerHTML = msg;

        $('#grade_nameto').val(msg); 

        if(msg == 'No Match'){

          $('#emp_grade_list_id').val('');  
          $('#grade_nameto').val('');  
        }


    });

    $("#Profit_center_code_id").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#Profit_center_code_list option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        document.getElementById("pfctText").innerHTML = msg; 
        $('#pfct_name_bind').val(msg);

        if(msg == 'No Match'){

           $('#Profit_center_code_id').val('');
           $('#pfct_name_bind').val('');

        }


    });


    $("#cost_code_id").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#cost_code_list option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        document.getElementById("costText").innerHTML = msg;

        $('#emp_cost_name').val(msg); 

        if(msg == 'No Match'){

           $('#cost_code_id').val('');
           $('#emp_cost_name').val('');

        }


    });

    $("#department_id").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#emp_dept_list option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        document.getElementById("deptText").innerHTML = msg; 

        $('#emp_department_name').val(msg);

        if(msg == 'No Match'){

          $('#department_id').val('');
          $('#emp_department_name').val('');
            
        }
    });

    $("#blood_group_id").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#blood_group_list option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
          $(this).val('');
          $("#blood_group_name").val('');
        }else{
          $("#blood_group_name").val(msg);
        }
    });

       $("#add_state_id").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#state option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#add_state_name").val('');
        }else{
          $("#add_state_name").val(msg);
        }


      });


    $("#perm_add_state_id").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#state option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

         if(msg=='No Match'){
          $(this).val('');
          $("#perm_add_state_name").val('');
        }else{
          $("#perm_add_state_name").val(msg);
        }
    });

    $("#rel_emp_code_id").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#emp_code_list option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        document.getElementById("codeText").innerHTML = msg;

        if(msg == 'No Match'){

            $('#rel_emp_code_id').val('');
            $('#rel_emp_name').val('');

        }else{

            $('#rel_emp_name').val(msg);
        }


    });

       $("#emp_code1").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#empList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#emp_name1").val('');
        }else{
          $("#emp_name1").val(msg);
        }


      });

        $("#designation1").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#desgList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#designationname1").val('');
        }else{
          $("#designationname1").val(msg);
        }


      });

        $("#deptList1").bind('change', function () {  

            var val = $(this).val();

            var xyz = $('#deptlist option').filter(function() {

                return this.value == val;

            }).data('xyz');

            var msg = xyz ?  xyz : 'No Match';

            if(msg=='No Match'){
                $(this).val('');
                $("#deptName1").val('');
            }else{
                $("#deptName1").val(msg);
            }


        });



     


    $("#emp_edu1").bind('change', function () {  

            var val = $(this).val();

            var xyz = $('#empListedu option').filter(function() {

                return this.value == val;

            }).data('xyz');

            var msg = xyz ?  xyz : 'No Match';

            if(msg=='No Match'){
                $(this).val('');
                $("#emp_edu_name1").val('');
            }else{
                $("#emp_edu_name1").val(msg);
            }


        });





    // script for tab steps
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

          var href = $(e.target).attr('href');
          var $curr = $(".process-model  a[href='" + href + "']").parent();

          $('.process-model li').removeClass();

          $curr.addClass("active");
          $curr.prevAll().addClass("visited");
      });
    // end  script for tab steps



$(".delete").on('click', function() {

    $('.case:checkbox:checked').parents("tr").remove();

    $('.check_all').prop("checked", false); 

    check();

});


var i=2;

$(".addmore").on('click',function(){

     count=$('#careertbl tr').length;

     countTr = count-1;

      var emp_code    =  $('#emp_code'+countTr).val();
      var comp_name   =  $('#comp_name'+countTr).val();
      var designation =  $('#designation'+countTr).val();
      var deptList    =  $('#deptList'+countTr).val();
      var form_date   =  $('#form_date'+countTr).val();
      var to_date     =  $('#to_date'+countTr).val();

      if(emp_code == ''){

        $('#employCodeErr'+countTr).html('Emp Code Field Is Required').css('color','red');

        return false;
      }else{

        $('#employCodeErr'+countTr).html('');      }

      if(comp_name == ''){
        
        $('#compNameErr'+countTr).html('Company Name Field Is Required').css('color','red');

        return false;
      }else{

        $('#compNameErr'+countTr).html('');      }

      if(designation == ''){
        
        $('#designtnErr'+countTr).html('Designation Field Is Required').css('color','red');

        return false;
      }else{

         $('#designtnErr'+countTr).html('');

      }

      if(deptList == ''){
        
        $('#deptListErr'+countTr).html('Department Field Is Required').css('color','red');

        return false;
      }else{

         $('#deptListErr'+countTr).html('');

      }

      if(form_date == ''){
        
        $('#fromDateErr'+countTr).html('From Date Field Is Required').css('color','red');

        return false;
      }else{
       
         $('#fromDateErr'+countTr).html('');

      }

      if(to_date == ''){
        
        $('#toDateErr'+countTr).html('To Date Field Is Required').css('color','red');

        return false;
      }
      else{

         $('#toDateErr'+countTr).html('');

          var data="<tr><td class='tdthtablebordr' style='padding-top: 23px;'><input type='checkbox' class='case'/></td><td class='tdthtablebordr' style='padding-top: 22px;'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='CareerDetlSlno[]' id='CareerDetlSlno_id' value='"+count+"'></td>";

          data +="<td class='tdthtablebordr'><div class='input-group'><input list='empList"+i+"' class='inputboxclr getacccode debitcreditbox emplyCode' style='text-align:left;width: 107px;margin-bottom: 5px;' id='emp_code"+i+"' name='emp_code[]' placeholder='Select Employee Code'/><datalist id='empList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($emp_list as $key)<option value='<?php echo $key->EMP_CODE?>' data-xyz ='<?php echo $key->EMP_NAME; ?>' ><?php echo $key->EMP_NAME ; echo ' ['.$key->EMP_CODE.']' ; ?></option>@endforeach</datalist></div><div class='pull-left showSeletedName' id='empNameGet'></div><small id='employCodeErr"+i+"'></small><small id='emailHelp' class='form-text text-muted'></small></td> <td class='tdthtablebordr'><input type='text' class='inputboxclr companyNameBox' placeholder='Enter Company Name'  id='comp_name"+i+"' name='comp_name[]' /><br><small id='compNameErr"+i+"'></small></td><td class='tdthtablebordr'><input type='text' class='designationBox dr_amount inputboxclr' placeholder='Enter Designation'  id='designation"+i+"' name='designation[]'/><br><small id='designtnErr"+i+"'></small></td><td class='tdthtablebordr'><input list='deptlist"+i+"' class='inputboxclr getacccode debitcreditbox' style='width: 107px;margin-bottom: 5px;' id='deptList"+i+"' name='DeptList[]' placeholder='Select Department'/><datalist id='deptlist"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($dept_list as $row)<option value='<?php echo $row->DEPT_CODE?>' data-xyz ='<?php echo $row->DEPT_NAME; ?>' ><?php echo $row->DEPT_NAME ; echo ' ['.$row->DEPT_CODE.']' ; ?></option>@endforeach</datalist><br><small id='deptListErr"+i+"'></small></td><td class='tdthtablebordr'><input type='text' class='inputboxclr form_date1' style='width: 100px;margin-bottom: 5px;text-align: center;' id='form_date1' name='form_date[]'  placeholder='From Date' /><input type='text' style='width: 100px;text-align: center;' class='textdesciptn to_date1'  name='to_date[]' id='to_date1' placeholder='To Date' ><br> <small id='toDateErr"+i+"'></small><br><small id='fromDateErr"+i+"'></small></td></tr>";

          $('#careertbl').append(data);

          i++;
      }

  });



  $('body').on('focus',".form_date1,.to_date1", function(){
    $(this).datepicker({
            format: 'dd-mm-yyyy',
            orientation: 'bottom',
            todayHighlight: 'true',
            autoclose: 'true'

      });
  });


});

function select_all() {

      $('input[class=case]:checkbox').each(function(){ 

          if($('input[class=check_all]:checkbox:checked').length == 0){ 

              $(this).prop("checked", false); 

          } else {

              $(this).prop("checked", true); 

          } 

      });

  }

  function check(){

      obj = $('#careertbl tr').find('span');

      $.each( obj, function( key, value ) {

          id=value.id;

          $('#'+id).html(key+1);

      });

  }
  
  $(document).ready(function(){
    $('#checkValidation').on('click',function(){

      var  count=$('table tr').length;
      var trCount = count-1;

      for(var q=0;q<trCount;q++){

        var w = q +1;
        var emplyCode   =  $('#emp_code'+w).val();

        var comp_name   =  $('#comp_name'+w).val();
        var designation =  $('#designation'+w).val();
        var deptList    =  $('#deptList'+w).val();
        var from_date   =  $('#form_date'+w).val();
        var to_date     =  $('#to_date'+w).val();

        if(emplyCode){

        }else{
          
          $('#employCodeErr'+w).html('Emp Code Field Is Required').css('color','red');
        }

        if(comp_name){

        }else{
          
          $('#compNameErr'+w).html('Comp Name Field Is Required').css('color','red');
        }

        if(designation){

        }else{
          
          $('#designtnErr'+w).html('Designation Field Is Required').css('color','red');
        }

        if(deptList){

        }else{
          
          $('#deptListErr'+w).html('Department Field Is Required').css('color','red');
        }

        if(to_date==''){
            $('#toDateErr'+w).html('Please select to date').css('color','red');
            return false;
          }
        
        if(from_date==''){
            $('#fromDateErr'+w).html('Please select from date').css('color','red');
            return false;
          }
       }
       
      
    });
  });

  $(document).ready(function(){
     $('body').on('click', '#closeModel', function () {
          $('.popover').fadeOut();
    })
  });


$(document).ready(function(){

    var counter = 2;
        
    $("#addButton").click(function () {

        count = counter-1;

        var emp_code = $('#emp_edu'+count).val();
        var courseName = $('#courseName'+count).val();
        var university = $('#university'+count).val();
        var passingYear = $('#passingYear'+count).val();
        var percentage = $('#percentage'+count).val();

        if(emp_code == ''){

            $('#emp_eduMSg'+count).html('Emp code field is required').css('color','red');
            return false;

        }else{
            
            $('#emp_eduMSg'+count).html('');
        }

        if(courseName == ''){

            $('#courseNameMSg'+count).html('Course Name field is required').css('color','red');
            return false;
        }else{

            $('#courseNameMSg'+count).html('');
           
        }

        if(university == ''){

            $('#universityMSg'+count).html('University Name field is required').css('color','red');
            return false;

        }else{

            $('#universityMSg'+count).html('');
        }

        if(passingYear == ''){

            $('#passingYearMSg'+count).html('Passing Year field is required').css('color','red');
            return false;

        }else{
      
           $('#passingYearMSg'+count).html('');

        }

        if(percentage == ''){

            $('#percentageMSg'+count).html('Percentage field is required').css('color','red');
            return false;

        }else{

            $('#percentageMSg'+count).html('');
        }

        if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
        }   
        
        var newTextBoxDiv = $(document.createElement('div'))
             .attr("class", 'rowcount' + counter);

             //onsole.log(counter);
        var count1 = counter-1;

        getcount=$('.divTableBody .trrowget').length;

        var newrow = '<div class="divTableRow rowcount TextBoxesGroup_'+counter+' trrowget"><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv'+counter+'" style="padding-bottom: 10px;"><input type="checkbox" class="casecheck" id="tablesecnd'+counter+'"></div> </div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;"><span id="snumtwo'+counter+'">'+getcount+'.</span><input type="hidden" name="EductnDetlSlno[]" id="EductDetlSlno_id'+getcount+'" value="'+getcount+'"></div></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-top: 10px;"><input list="empListedu" type="textbox" id="emp_edu'+counter+'" style="width: 103px;" name="empl_code[]"><datalist id="empListedu"><option selected="selected" value="">-- Select --</option>@foreach ($emp_list as $key)<option value="<?php echo $key->EMP_CODE?>" data-xyz ="<?php echo $key->EMP_NAME; ?>" ><?php echo $key->EMP_NAME; echo ' ['.$key->EMP_CODE.']' ; ?> </option> @endforeach</datalist></div><small id="emp_eduMSg'+counter+'"></small></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;"><input type="textbox" name="course_name[]" id="courseName'+counter+'" value=""></div><small id="courseNameMSg'+counter+'"></small></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;"><input type="textbox" name="universit_name[]" id="university'+counter+'" value=""></div><small id="universityMSg'+counter+'"></small></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;"><input type="textbox" id="passingYear'+counter+'" name="passing_year[]" value="" style="width: 100px;"></div><small id="passingYearMSg'+counter+'"></small></div></div><div class="divTableCell"><div class="TextBoxesGroup"><div id="TextBoxDiv1" style="padding-bottom: 10px;"><input type="textbox" id="percentage'+counter+'" name="percentage[]" value="" style="width: 100px;"></div><small id="percentageMSg'+counter+'"></small></div></div></div>';

        $(".divTableBody").append(newrow);

        counter++;

     });


    $(".removeBtntbl").on('click', function() {
        $('.casecheck:checkbox:checked').parents(".trrowget").remove();
        
        checksectbl();
    });

    function checksectbl(){

        obj = $('.divTableRow .TextBoxesGroup').find('span'); 

        objfirst = $('table tr').find('span'); 


        if(obj.length==0){
          
          $('#submitdata').prop('disabled',true);
        }else if(objfirst.length == 0){
          $('#submitdata').prop('disabled',true);
        }else{
          $.each( obj, function( key, value ) {

              id= value.id;
              $('#'+id).html(key+1);

          });
        } 
      
    }

        
    $("#getButtonValue").click(function () {
        
        var msg = '';
        for(i=1; i<counter; i++){
          msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
        }
            alert(msg);
    });

  });


  $(document).ready(function(){

      $("#submitEmpFamilyDetail").click(function(event) {

      var rel_emp_code      = $("#rel_emp_code_id").val();
      var relative_name     = $("#relative_name_id").val();
      var relative_dob      = $("#relative_date_of_birth_id").val();
      var relative_with_emp = $("#relation_with_emp_id").val();
      var relative_mob      = $("#relative_mob_id").val();
      var relative_email    = $("#relative_email_id").val();

      if(rel_emp_code.trim() ==''){

       $('#rel_emp_codeErr').html('The Emp. Code field is required.').css('color','red');
       
       return false;

      }else {

      $('#rel_emp_codeErr').html('');

      }

      if(relative_name.trim() ==''){

        $('#relative_name_idErr').html('The Emp.Relative Name field is required.').css('color','red');
        
        return false;

      }else {

        $('#relative_name_idErr').html('');

      }

      if(relative_dob.trim() ==''){

        $('#relative_date_of_birthErr').html('The DOB field is required.').css('color','red');
        
        return false;

      }else {

          $('#relative_date_of_birthErr').html('');

      }

      if(relative_with_emp.trim() ==''){

       $('#relation_with_empErr').html('The Relation field is required.').css('color','red');
        
        return false;

      }else {
          $('#relation_with_empErr').html('');

      }
         
     if ($('input[type=radio][name=relative_gender]:checked').length == 0){

       $('#relative_genderErr').html('The Gender field is required.').css('color','red');
       
       return false;

     }else{

       $('#relative_genderErr').html('');
       
     }

     if(relative_email.trim() ==''){

       $('#relative_emailErr').html('The Email-Id field is required.').css('color','red');
       
       return false;

     }else {
          $('#relative_emailErr').html('');

     }

     if(relative_mob.trim() ==''){

       $('#relative_mobErr').html('The Mobile No is required.').css('color','red');
      
      return false;

     }else {

        $('#relative_mobErr').html('');

     } 

    var data = $("#addemployDetail").serialize();

        $.ajaxSetup({

          headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',
            url: "{{ url('/Master/Employee/add-employee-family') }}",

            data:data, // here $(this) refers to the ajax object not form

            success: function (data) {

            
                    var data1 = JSON.parse(data);

                      if (data1.response == 'success') {

                       $('#empDeailSuccessMsg').html('<div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -5%;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4> <i class="icon fa fa-check"></i>Success...!</h4>Employee Family Details Successfully Save...!</div>');

                          $('#addemployDetail')[0].reset();

                      }else{

                         $('#empDeailSuccessMsg').html('<div class="alert alert-error alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -5%;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4> <i class="icon fa fa-close"></i>Failed...!</h4>Employee Family Details Already Save...!</div>');

                          $('#addemployDetail')[0].reset();

                      }
                  },

        });
              
      });

      $("#submitEmpCareerData").click(function(event) {

        countTr = $('#careertbl tr').length;

        count = countTr - 1;


        var emp_code    = $('#emp_code'+count).val();
        var comp_name   = $('#comp_name'+count).val();
        var designation = $('#designation'+count).val();
        var deptList    = $('#deptList'+count).val();
        var form_date   = $('#form_date'+count).val();
        var to_date     = $('#to_date'+count).val();
        
        if(emp_code ==''){

          $('#careerErrShow').html('Emp Code is Required').css('color','red');

        }

        if(comp_name ==''){

          $('#careerErrShow').html('Company Name is required').css('color','red');

        }
        if(designation ==''){

          $('#careerErrShow').html('Designation  is Required').css('color','red');

        }
        if(deptList ==''){

          $('#careerErrShow').html('Department IS Required').css('color','red');

        }
        if(form_date ==''){

          $('#careerErrShow').html('From Date is Required').css('color','red');

        }
        if(to_date ==''){

          $('#careerErrShow').html('To Date is Required').css('color','red');

        }else{

           var data = $("#emplyeCarerDetail").serialize();
           

        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/Master/Employee/employee-career-details-save') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

             var data1 = JSON.parse(data);

                if (data1.response == 'success') {

                    $('#empDeailSuccessMsg').html('<div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -3%;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4> <i class="icon fa fa-check"></i>Success...!</h4>Employee Career Details Successfully Save...!</div>');

                    $("#emplyeCarerDetail")[0].reset();

                }else{

                     $('#empDeailSuccessMsg').html('<div class="alert alert-error alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -3%;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4> <i class="icon fa fa-check"></i>Success...!</h4>Employee Career Details Already Save...!</div>');

                    $("#emplyeCarerDetail")[0].reset();

                }
            },

        });

        }
      
      });

      $("#submitEmpEduData").click(function(event) {

        var courseName = $('#courseName1').val();

        var university = $('#university1').val();

        var passingYear = $('#passingYear1').val();

        var percentage = $('#percentage1').val();

        if(courseName=='' && university=='' && passingYear=='' && percentage==''){

          $('#eduErrShow').html('All Field IS Required').css('color','red');

        }else{


            var data = $("#emplyeEductnDetail").serialize();

            $.ajaxSetup({

                  headers: {

                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                  }
            });

            $.ajax({

                type: 'POST',

                url: "{{ url('/Master/Employee/employee-education-details-save') }}",

                data: data, // here $(this) refers to the ajax object not form

                success: function (data) {

                    var data1 = JSON.parse(data);

                if (data1.response == 'success') {

                    $('#empDeailSuccessMsg').html('<div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -3%;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4> <i class="icon fa fa-check"></i>Success...!</h4>Employee Education Details Successfully Save...!</div>');

                    $("#emplyeEductnDetail")[0].reset();

                }else{

                     $('#empDeailSuccessMsg').html('<div class="alert alert-error alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -3%;"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4> <i class="icon fa fa-check"></i>Success...!</h4>Employee Education Details Already Save...!</div>');

                    $("#emplyeEductnDetail")[0].reset();

                }

                },

            });

        }

              
      });

  });

function funGenEmpCode(element){

    var getEmpName = $('#employee_name_id').val();
    var getcompcode = $('#comp_code').val();
    // var getEmpName = $('#').val();
    var tbl_name = 'MASTER_EMP';
    var col_code = 'EMP_CODE';
    console.log('getEmpName',getEmpName.length);

    
    if(getcompcode && getEmpName.length > 1){
      console.log('kfgd');


      var max_chars = 1;
  
      var element_value ;
      if(getEmpName.length >= max_chars) {
        element_value = element.value.substr(0, 1);
        element_value = element_value.toUpperCase();
      }else if(getAccName.length <= max_chars){
         $('#acc_code').val('');
      }else{
        $('#acc_code').val('');
      }
   
      // var acc_type = $('#acctype_code').val();
      // var atype = acc_type.split("[");
      // var acctype_name = atype[0];
     
     

      // var aname = element_value;
      var likename = getcompcode+''+element_value;
      console.log('likename',likename);
      
      $.ajaxSetup({
        
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      
      });
      
      $.ajax({
      
        url:"{{ url('/Master/generate-dyanamic-code') }}",
        
        data: {likename:likename,tbl_name:tbl_name,col_code:col_code},
        
        success:function(data){

          var data1 = JSON.parse(data);
      
          if(data1.response == 'success'){
          
            var newcode = data1.data;
        
            if(newcode != '' || newcode != null){
              $('#employee_code_id').val(newcode);
            }else{
              $('#employee_code_id').val('');
            }

          }
        }
      }); /* /.ajax*/

    }else{
      $('#employee_code_id').val('');
    } /* /. codn*/
     
  }/* /. main fucn*/
</script>


@endsection