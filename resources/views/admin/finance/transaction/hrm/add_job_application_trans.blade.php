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

 .required-field::before {

    content: "*";

    color: red;

  }
  .hidebox{
    display: none;
  }
  .showbox{
    display: block;
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

.rightcontent{

  text-align:right;


}
.tcodemargin{
  margin-left: -3%;
}

::placeholder {
  
  text-align:left;
}
.dateWidth{
  width: 76% !important;
}
.vrmargin{
  margin-left: -7%;
}
.seriescodemargin{
  margin-left: -3%;
}
.seriescodewidth{
  width: 145% !important;
}
.pfctnamewidth{
  width: 145% !important;
}

.accnamewidth{
  width: 134% !important;
}
.accnamemargin{
  margin-left: -7%;
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

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }
.settblebrodr{
  border: 1px solid #cac6c6;
}
.tdlboxshadow{
  box-shadow: 0px 1px 4px -1px rgba(161,155,161,1);

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
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: right;
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
  width: 91px;
  text-align: end;
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
    width: 15%;
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
.numright{
  text-align: right;
}
.remarkbtn{
  display: flex;
    height: 26px;
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
    .dateWidth{
  width: 100% !important;
}
.vrmargin{
  margin-left: 0%;
}
.tcodemargin{
  margin-left: 0%;
}
.seriescodemargin{
  margin-left: 0%;
}
.seriescodewidth{
  width: 100% !important;
}
.sereiswidth{
  width: 100% !important;
}
.accnamewidth{
  width: 100% !important;
}
.pfctnamewidth{
  width: 100% !important;
}
.pfctnamemargin{
  margin-left: 0% !important;
}
.accnamemargin{
  margin-left: 0%;
}

}
</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

           Job Application

            <small>Add Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ URL('/dashboard')}}">Transaction</a></li>

            <li class="Active"><a href="{{ URL('/Transaction/JobApplication/add-job-application-trans')}}">Job Application </a></li>

            <li class="Active"><a href="{{ URL('/Transaction/JobApplication/add-job-application-trans')}}">Add Job Application </a></li>

          </ol>

        </section>

 <section class="content" id="">
  
    <div class="row">
      <div class="col-sm-12"> 

        <!-- <div class="pull-right showinmobile">

          <a href="{{ url('/Transaction/JobApplication/view-job-application-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Job Application</a>

        </div>

        <div class="pull-right hideinmobile" style="padding: 10px;">

          <a href="{{ url('/Transaction/JobApplication/view-job-application-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Job Application Trans</a>

        </div> -->

        @if(Session::has('alert-success'))

            <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -5%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i>

                  Success...!

                </h4>

                 {!! session('alert-success') !!}

            </div>

        @endif


        @if(Session::has('alert-error'))

            <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;margin-top: 5%;margin-bottom: -5%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-ban"></i>

                  Error...!

                </h4>

                {!! session('alert-error') !!}

            </div>

        @endif
        </div>
       
     </div>
     <div class="tab-content tab-content-custom">
         <div role="tabpanel" class="tab-pane active" id="discover">
            <div class="design-process-content">

        <section class="content">
            <form action="#" id="JobApplForm" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="row">
                <div class="col-sm-12">

                <div class="box box-primary Custom-Box">

                    <div class="box-header with-border" style="text-align: center;">

                      <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Job Application Details</h2>

                      <div class="box-tools pull-right">

                         <a href="{{ url('/Transaction/JobApplication/view-job-application-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Job Application</a>
                      </div>

                      <!-- <div class="pull-right showinmobile">

                        <a href="{{ url('/Transaction/JobApplication/view-job-application-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Job Application</a>

                      </div>

                      <div class="pull-right hideinmobile" style="padding: 10px;">

                        <a href="{{ url('/Transaction/JobApplication/view-job-application-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Job Application Trans</a>

                      </div> -->

                    </div><!-- /.box-header -->


                   <div class="box-body">

                    
                        <div class="row">
                         <div class="col-md-2">
                            <div class="form-group">

                             <label for="exampleInputEmail1">Date : <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>
                                 <?php $CurrentDate =date("d-m-Y"); ?>

                                <input type="text" id="jobAppDt" name="jobAppDt" class="form-control datepicker" value="{{$CurrentDate}}" placeholder="Date" autocomplete="off">

                            </div>
                            <small class="form-text text-muted" id="todayDtErr"></small>
                          </div> 
                         </div>

                         <div class="col-md-2">
                            
                            <div class="form-group">

                             <label for="exampleInputEmail1">Job Opening No. : <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                               <input list="jobList" id="jobOpeningNo" name="jobOpeningNo" class="form-control  pull-left Employee FormTextFirstUpper" value="" placeholder="Job Opening No" autocomplete="off" oninput="funJobOpenNo()">

                              <datalist id='jobList'>
                              <?php foreach($jobOpen_list as $key) { ?>

                              <option value='<?= $key->JOBID?>' data-xyz='<?= $key->POSITION_CODE?>'>{{ $key->JOBID }}</option>

                              <?php } ?>
                            </datalist>

                            

                             </div>

                             <small id="jobOpeningNoErr" class="form-text text-muted">

                             </small>

                            </div> 
                         </div>

                         <div class="col-md-2">
                            
                            <div class="form-group">

                             <label for="exampleInputEmail1">Emp Code : <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input list="empList" id="emp_code" name="emp_code" class="form-control  pull-left Employee FormTextFirstUpper" value="" placeholder="Emp Code" autocomplete="off" oninput="funEmpCode()" readonly>

                                <datalist id='empList'>
                                  <?php foreach($emp_list as $key) { ?>

                                  <option value='<?= $key->EMP_CODE ?>' data-xyz='<?= $key->EMP_NAME?>'>{{ $key->EMP_CODE  }} = {{ $key->EMP_NAME  }}</option>

                                  <?php } ?>
                                </datalist>

                             </div>

                            </div> 
                         </div>

                         <div class="col-md-3">
                            
                            <div class="form-group">

                             <label for="exampleInputEmail1">Emp Name : <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input  id="emp_name" name="emp_name" class="form-control  pull-left Employee FormTextFirstUpper" value="" placeholder="Emp Name" readonly>

                            </div>

                             <small id="nameErr" class="form-text text-muted">

                             </small>

                            </div> 
                         </div>

                         <div class="col-md-3">
                            
                            <div class="form-group">

                             <label for="exampleInputEmail1">Address : <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="address" name="address" class="form-control" value="" placeholder=" Address" autocomplete="off" readonly>

                             </div>

                             <small id="addressErr" class="form-text text-muted">
                            
                             </small>

                            </div> 
                         </div></div>
                         <div class="row">

                         <div class="col-md-3">
                            
                            <div class="form-group">

                             <label for="exampleInputEmail1">Pan No : <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="pan_no" name="pan_no" class="form-control" value="" placeholder=" Pan No" autocomplete="off" readonly>

                             </div>

                             <small id="pan_noErr" class="form-text text-muted">

                             </small>

                            </div> 
                         </div>

                         <div class="col-md-3">
                            
                            <div class="form-group">

                             <label for="exampleInputEmail1">Adhar No : <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="adhar_no" name="adhar_no" class="form-control" value="" placeholder=" Adhar No" autocomplete="off" readonly>

                             </div>

                             <small id="adhar_noErr" class="form-text text-muted">
                             
                             </small>

                            </div> 
                         </div>
                         
                         <div class="col-md-3">
                            
                            <div class="form-group">

                             <label for="exampleInputEmail1">Mobile No : <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="mobile_no" name="mobile_no" class="form-control" value="" placeholder="Mobile No" autocomplete="off" readonly>

                             </div>

                             <small id="mobile_noErr" class="form-text text-muted">

                             </small>

                            </div> 
                         </div>

                         <div class="col-md-3">
                            
                            <div class="form-group">

                             <label for="exampleInputEmail1">Position Code : <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="position_code" name="position_code" class="form-control" value="" placeholder="Enter Position" autocomplete="off" readonly>

                             </div>

                             <small id="positionErr" class="form-text text-muted">

                             </small>

                            </div> 
                         </div>

                         <div class="col-md-3">
                            
                            <div class="form-group">

                             <label for="exampleInputEmail1">Position Name: <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input class="form-control" type="text" id="pos_name" name="pos_name" value="" readonly>

                             </div>


                            </div> 
                         </div>


                         <div class="col-md-3">
                            
                            <div class="form-group">

                             <label for="exampleInputEmail1">Salary : <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="salary" name="salary" class="form-control" value="" placeholder="Enter Salary" autocomplete="off" readonly onchange="funSalary()">

                             </div>

                             <small id="salaryErr" class="form-text text-muted">

                             </small>

                            </div> 
                         </div>

                         <div class="col-md-3">

                          <div class="form-group">
                            
                            <label>Job Type : <span class="required-field"></span></label>

                              <div class="input-group">

                                  <div class="input-group-addon">

                                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                                  </div>
                                   
                                  <input list="typeList" type='textbox' id='jobType' class="form-control" name="jobType" value="" autocomplete="off" placeholder="Job Type" oninput="funJobType()" readonly>
                                               
                                  <datalist id='typeList'>
                                    
                                    <option selected='selected' value=''>-- Select --</option>

                                    <option  value='Full Time' data-xyz="Full Time">Full Time</option>
                                    
                                    <option  value='Part Time' data-xyz="Half Day">Part Time</option>
                                  
                                  </datalist>
                              </div>

                              <small id="jobTypeErr" class="form-text text-muted">

                              </small>

                          </div>
               
                         </div>

                         <div class="col-md-2">
                            
                            <div class="form-group">

                             <label for="exampleInputEmail1">Notice Period : <span class="required-field"></span></label>

                             <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="notice_period" name="notice_period" class="form-control" value="" placeholder="Notice Period" autocomplete="off" readonly onchange="funNoticePeriod()">

                             </div>

                             <small id="notice_periodErr" class="form-text text-muted">

                                  
                             </small>

                            </div> 
                         </div>

                         
                           
                        </div>
                       </div>
                   
                    </div>


        </section>


       <section class="content">

          <div class="row">

            <div class="col-sm-12">

            <div class="box box-primary Custom-Box">

              <div class="box-body">
                
                <div class="table-responsive">

                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblTravel">

                      <tr>

                        <th><input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row"></th>

                        <th>Sr.No.</th>

                        <th>Course Name <small style="color:red;font-size:14px;">*</small> </th>

                        <th>University Name <small style="color:red;font-size:14px;">*</small></th>

                        <th>Passing Year <small style="color:red;font-size:14px;">*</small></th>

                        <th>Percentage <small style="color:red;font-size:14px;">*</small></th>
                      
                      </tr>

                      <tr class="useful">
                        
                        <td class="tdthtablebordr">
                          <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/>
                        </td>

                        <td class="tdthtablebordr" >

                          <span id='snum'>1.</span>

                          <input type='hidden' name='EducationSlno[]' id='EducationSlno_id' value='1'>

                        </td>

                        <td class="tdthtablebordr">
                          
                            <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                                <input type='text' id='courseName1' value="" name="course_name[]" value="" autocomplete="true">
                            </div>

                          <small id="courseNameErr1"></small>

                        </td>

                       <td class="tdthtablebordr">
                          
                         <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                            <input type='text' id='university1' value="" name="university_name[]" value="" autocomplete="true">
                         </div>

                         <small id="universityErr1"></small>
                            
                       </td>

                       <td class="tdthtablebordr" style=''>
                          
                        <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                          <input type='text' id='passingYear1' name="passing_year[]" style="" value="" autocomplete="true">
                        </div>

                          <small id="passingYrErr1"></small>

                       </td>

                        <td class="tdthtablebordr" >
                          
                          <div id="TextBoxDiv1" style="padding-bottom: 10px;">
                            <input type='textbox' id='percentage1' value="" name="percentage[]" style="" value="" autocomplete="true">
                          </div>

                          <small id="percentageErr1"></small>

                        </td>

                      </tr>

                    </table>

              </div>

              <button type="button" class='btn btn-danger btn-sm delete' id="removeButton"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

              <button type="button" class='btn btn-primary btn-sm addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

                  
                  
                  <!-- </div> -->
             </div>
            </div>

            </div>
          </div>

    </section>


    <section class="content" style="margin-top:-50px !important;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-info Custom-Box">

            <div class="box-header with-border" style="text-align: Center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Previous Company Details</h2>


            </div><!-- /.box-header -->

            <div class="box-body">

             <div class="row">

                 <div class="col-md-3">
                            
                    <div class="form-group">

                     <label for="exampleInputEmail1">Company Name : <span class="required-field"></span></label>

                     <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input type="text" id="compName" name="compName" class="form-control" value="" placeholder="Enter Company Name" autocomplete="off">

                     </div>

                     <small id="compNameErr" class="form-text text-muted">

                          

                     </small>

                    </div> 
                 </div>

                 <div class="col-md-3">
                            
                    <div class="form-group">

                     <label for="exampleInputEmail1">Designation : <span class="required-field"></span></label>

                     <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input type="text" id="designation" name="designation" class="form-control" value="" placeholder="Enter Designation" autocomplete="off">

                     </div>

                     <small id="designationErr" class="form-text text-muted">

                         

                     </small>

                    </div> 
                 </div>

                 <div class="col-md-3">
                            
                    <div class="form-group">

                     <label for="exampleInputEmail1">Department : <span class="required-field"></span></label>

                     <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input type="text" id="department" name="department" class="form-control" value="" placeholder="Enter Department" autocomplete="off">

                     </div>

                     <small id="departmentErr" class="form-text text-muted">


                     </small>

                    </div> 
                 </div>
                 

                 <div class="col-md-3">
                            
                    <div class="form-group">

                     <label for="exampleInputEmail1">From Date : <span class="required-field"></span></label>

                     <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                        </div>

                        <input type="text" id="fromDate" name="fromDate" class="form-control datepicker" value="" placeholder="Enter From Date" autocomplete="off">

                     </div>

                     <small id="fromDateErr" class="form-text text-muted">

                          

                     </small>

                    </div> 
                 </div>
             </div>

             <p class="text-center">

                    <button class="btn btn-success" type="button" id="submitData"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

             </p><br>

            </div>

        </div>

      </div>
    
    </div>

    </form>
    </section>

  

  

              
             
          </div>
         
       </div>
      </div>
    </div>
  </section>

</div>




@include('admin.include.footer')


<script type="text/javascript">

$( window ).on( "load", function() {

    $('#jobOpeningNo').css('border-color','#ff0000').focus();
    
});

var currentDate = new Date();
$('.datepicker').datepicker({

      multidate: false,
      format : 'yyyy-mm-dd',
      todayHighlight: true,
      
      startDate :currentDate,
      
});

function funJobOpenNo(){

  var jobOpeningNo = $('#jobOpeningNo').val();
  if(jobOpeningNo == ''){

    $('#jobOpeningNo').css('border-color','#ff0000').focus();

  }else{
   $('#jobOpeningNo').css('border-color','#d2d6de');

   var emp_code = $('#emp_code').val();
   if(emp_code == ''){

    $('#emp_code').prop('readonly',false);
    $('#emp_code').css('border-color','#ff0000').focus();
   }else{
    $('#emp_code').css('border-color','#d2d6de'); 
   }
  
  }
}

function funEmpCode(){

  var emp_code = $('#emp_code').val();
  if(emp_code == ''){

    $('#emp_code').css('border-color','#ff0000').focus();

  }else{
   $('#emp_code').css('border-color','#d2d6de');

   var salary = $('#salary').val();
   if(salary == ''){

    $('#salary').prop('readonly',false);
    $('#salary').css('border-color','#ff0000').focus();
   }else{
    $('#salary').css('border-color','#d2d6de'); 
   }
  
  }
}

function funSalary(){

  var salary = $('#salary').val();
  if(salary == ''){

    $('#salary').css('border-color','#ff0000').focus();

  }else{
   $('#salary').css('border-color','#d2d6de');

   var jobType = $('#jobType').val();
   if(jobType == ''){

    $('#jobType').prop('readonly',false);
    $('#jobType').css('border-color','#ff0000').focus();
   }else{
    $('#jobType').css('border-color','#d2d6de'); 
   }
  
  }
}

function funJobType(){

  var jobType = $('#jobType').val();
  if(jobType == ''){

    $('#jobType').css('border-color','#ff0000').focus();

  }else{
   $('#jobType').css('border-color','#d2d6de');

   var notice_period = $('#notice_period').val();
   if(notice_period == ''){

    $('#notice_period').prop('readonly',false);
    $('#notice_period').css('border-color','#ff0000').focus();
   }else{
    $('#notice_period').css('border-color','#d2d6de'); 
   }
  
  }
} 

function funNoticePeriod(){

  var notice_period = $('#notice_period').val();
  if(notice_period == ''){

    $('#notice_period').css('border-color','#ff0000').focus();

  }else{
   $('#notice_period').css('border-color','#d2d6de');

  }
}

$("#jobType").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#typeList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
        $('#jobType').val('');
    }
});

$("#jobOpeningNo").bind('change', function () {  

    var val = $(this).val();
    var xyz = $('#jobList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

        $('#position_code').val('');
        $('#pos_name').val('');

    }else{

        $('#position_code').val(msg);  
        var pos_id = msg;
        var jobId = $('#jobOpeningNo').val();

         $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });
  
        $.ajax({

            type: 'POST',

            url: "{{ url('/Transaction/JobApplication/PositionName') }}",

            
            data: {pos_id:pos_id,jobId:jobId},

            success: function (data) {
            var obj = JSON.parse(data);

            var data1 = obj.data;

            $.each(data1, function (i, data1) {
              
              $('#pos_name').val(data1.POSITION_NAME);

            })
            
            }

        });
    }
});

$("#emp_code").bind('change', function () {  

    var val = $(this).val();
    var xyz = $('#empList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

        $('#emp_code').val('');
        $('#emp_name').val('');
        $('#pan_no').val('');
        $('#adhar_no').val('');
        $('#mobile_no').val('');
        $('#address').val('');

    }else{

        $('#emp_name').val(msg);  
        var pos_id = msg;
        var emp_code = $('#emp_code').val();

         $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });
  
        $.ajax({

            type: 'POST',

            url: "{{ url('/Transaction/JobApplication/EmpInformation') }}",

            
            data: {emp_code:emp_code},

            success: function (data) {
            var obj = JSON.parse(data);

            var data1 = obj.data;

            $.each(data1, function (i, data1) {
              
              $('#pan_no').val(data1.PAN_NO);
              $('#adhar_no').val(data1.ADHAR_NO);
              $('#mobile_no').val(data1.CONTACT_NO);

              var address = data1.ADD1+', '+data1.ADD2+', '+data1.ADD3;
              $('#address').val(address);
              
            })
            
            }

        });
    }
});


$(document).ready(function(){

var i=2;

$(".addmore").on('click',function(){

      count=$('#tblTravel tr').length;
      
      countTr = count-1;

      var courseName  =  $('#courseName'+countTr).val();

      if(courseName == ''){
        $('#courseNameErr'+countTr).html('Course Name Is Required').css('color','red');
      }

      var university  =  $('#university'+countTr).val();

      if(university == ''){
        $('#universityErr'+countTr).html('University Field Is Required').css('color','red');
      }
      var passingYear  =  $('#passingYear'+countTr).val();

      if(passingYear == ''){
        $('#passingYrErr'+countTr).html('Passing Year From Field Is Required').css('color','red');
      }

      var percentage  =  $('#percentage'+countTr).val();

      if(percentage == ''){
        $('#percentageErr'+countTr).html('Percentage Field Is Required').css('color','red');
      }else{
      
        $('#courseNameErr'+countTr).html('');
        $('#universityErr'+countTr).html('');
        $('#passingYrErr'+countTr).html('');
        $('#percentageErr'+countTr).html('');

      var data="<tr><td class='tdthtablebordr' style='padding-top: 23px;'><input type='checkbox' class='case'/></td><td class='tdthtablebordr' style='padding-top: 22px;'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='EducationSlno[]' id='EducationSlno_id' value='"+count+"'></td>";

      data +="<td class='tdthtablebordr' style='padding-top: 2%;'><div id='TextBoxDiv1' style='padding-bottom: 10px;'><input type='text' id='courseName"+i+"' value='' name='course_name[]'  maxlength='20' autocomplete='true'><small id='courseNameErr"+i+"'></small></div></td><td class='tdthtablebordr' style='padding-top: 2%;'><div id='TextBoxDiv1' style='padding-bottom: 10px;''><input type='text' id='university"+i+"' autocomplete='true' value='' name='university_name[]''></div><small id='universityErr"+i+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><div id='TextBoxDiv1' style='padding-bottom: 10px;'><input type='text' id='passingYear"+i+"' name='passing_year[]' style='' value='' maxlength='4' autocomplete='true'></div><small id='passingYrErr"+i+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><div id='TextBoxDiv1' style='padding-bottom: 10px;'><input type='textbox' id='percentage"+i+"' value='' name='percentage[]' style='' value='' maxlength='3' autocomplete='true'></div><small id='percentageErr"+i+"'></small></td></tr>";

      $('#tblTravel').append(data);

      i++;

      }

});


$(".delete").on('click', function() {
   
   $('.case:checkbox:checked').parents('#tblTravel tr').remove();

    $('.check_all').prop("checked", false); 

    check();

  });

 function check(){

      obj = $('#tblTravel tr').find('span');
      $.each( obj, function( key, value ) {

          id=value.id;
          
         
          $('#'+id).html(key+1);

      });

  }

   $("#submitData").click(function(event) {

       
        var courseName= [];
        var universityName= [];
        var passYr= [];
        var percen= [];
        var eduSlno= [];

        $('input[name^="course_name"]').each(function (){
                  
          courseName.push($(this).val());

        });
        
        $('input[name^="university_name"]').each(function (){
                          
                  universityName.push($(this).val());

        });
        
        $('input[name^="passing_year"]').each(function (){
                          
                  passYr.push($(this).val());

        });

        $('input[name^="percentage"]').each(function (){
                          
                  percen.push($(this).val());

        });

         $('input[name^="EducationSlno"]').each(function (){
                          
                  eduSlno.push($(this).val());

        });

        var todayDt = $('#jobAppDt').val();
        var jobOpeningNo = $('#jobOpeningNo').val();
        var emp_code = $('#emp_code').val();
        var emp_name = $('#emp_name').val();
        var address = $('#address').val();
        var pan_no = $('#pan_no').val();
        var adhar_no = $('#adhar_no').val();
        var mobile_no = $('#mobile_no').val();
        var salary = $('#salary').val();
        var jobType = $('#jobType').val();
        var notice_period = $('#notice_period').val();
        var compName = $('#compName').val();
        var designation = $('#designation').val();
        var department = $('#department').val();
        var fromDate = $('#fromDate').val();
        var position_code = $('#position_code').val();
        var pos_name = $('#pos_name').val();

        if(todayDt == ''){
           $('#todayDtErr').html('Date is required').css('color','red');
        }else{
           $('#todayDtErr').html('');
        }

        if(jobOpeningNo == ''){
           $('#jobOpeningNoErr').html('Job Opening is required').css('color','red');
        }else{
           $('#jobOpeningNoErr').html('');
        }

        if(emp_code == ''){
           $('#nameErr').html('Emp Code is required').css('color','red');
        }else{
           $('#nameErr').html('');
        }

        if(address == ''){
           $('#addressErr').html('Address is required').css('color','red');
        }else{
           $('#addressErr').html('');
        }

        if(pan_no == ''){
           $('#pan_noErr').html('Pan No. is required').css('color','red');
        }else{
           $('#pan_noErr').html('');
        }

        if(adhar_no == ''){
           $('#adhar_noErr').html('Adhar No. is required').css('color','red');
        }else{
           $('#adhar_noErr').html('');
        }

        if(mobile_no == ''){
           $('#mobile_noErr').html('Mobile No. is required').css('color','red');
        }else{
           $('#mobile_noErr').html('');
        }

        if(position_code == ''){
           $('#positionErr').html('Position is required').css('color','red');
        }else{
           $('#positionErr').html('');
        }

        if(salary == ''){
           $('#salaryErr').html('Salary is required').css('color','red');
        }else{
           $('#salaryErr').html('');
        }

        if(jobType == ''){
           $('#jobTypeErr').html('Job Type is required').css('color','red');
        }else{
           $('#jobTypeErr').html('');
        }

        if(notice_period == ''){
           $('#notice_periodErr').html('Notice Period is required').css('color','red');
        }else{
           $('#notice_periodErr').html('');
        }

        if(compName == ''){
           $('#compNameErr').html('Company Name is required').css('color','red');
        }else{
           $('#compNameErr').html('');
        }

        if(designation == ''){
           $('#designationErr').html('Designation is required').css('color','red');
        }else{
           $('#designationErr').html('');
        }

        if(department == ''){
           $('#departmentErr').html('Department is required').css('color','red');
        }else{
           $('#departmentErr').html('');
        }

        if(fromDate == ''){
           $('#fromDateErr').html('From Date is required').css('color','red');
        }else{
           $('#fromDateErr').html('');
        }
        
        $.ajaxSetup({

                  headers: {

                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                  }
        });

        $.ajax({

                type: 'POST',

                url: "{{ url('/Transaction/JobApplication/save-job-application') }}",

                data: {todayDt:todayDt,jobOpeningNo:jobOpeningNo,courseName:courseName,emp_code:emp_code,emp_name:emp_name,address:address,universityName:universityName,passYr:passYr,percen:percen,pan_no,adhar_no:adhar_no,mobile_no:mobile_no,salary:salary,jobType:jobType,notice_period:notice_period,compName:compName,designation:designation,department:department,fromDate:fromDate,position_code:position_code,pos_name:pos_name,eduSlno:eduSlno}, // here $(this) refers to the ajax object not form

                success: function (data) {
                      var data1 = JSON.parse(data);

                      if(data1.response == 'success'){

                        var getName = btoa('JobApplicationTran');

                        window.location.href="/biztechERP_DEV/Transaction/TravelRequisition/success-message/"+getName;
                       var data1 = JSON.parse(data); 
                      }else if(data1.response == 'Error'){

                        var getName = btoa('ErrorJobApplicationTran');

                        window.location.href="/biztechERP_DEV/Transaction/TravelRequisition/success-message/"+getName;

                      }

                     

                      

                },

            });

       

              
       });

});



</script>


@endsection