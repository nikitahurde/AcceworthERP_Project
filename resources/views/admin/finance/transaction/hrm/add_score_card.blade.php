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
    text-align: center;
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
            Score Card Trans
            <small>Add Details</small>
          </h1>

          <ul class="breadcrumb">

        <li>

          <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a>

        </li>

        <li>

          <a href="{{ url('/dashboard') }}">Transaction</a>

        </li>

        <li class="active">

          <a href="#"> Add Score Card </a>

        </li>

      </ul>

        </section>



  <section class="content">

    <div class="row">
    
      <div class="col-sm-12"> 

        <div class="pull-right showinmobile">

          <a href="{{ url('/Transaction/ScoreCard/view-score-card-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Score Card</a>

        </div>

        <div class="pull-right hideinmobile" style="padding: 10px;">

          <a href="{{ url('/Transaction/ScoreCard/view-score-card-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Score Card</a>

        </div>

         @if(Session::has('alert-success'))

          <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

              <h4>
                  <i class="icon fa fa-check"></i>
                    Success...!

              </h4>

              {!! session('alert-success') !!}

          </div>

        @endif

        @if(Session::has('alert-error'))

          <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4>
                  <i class="icon fa fa-ban"></i>
                  Error...!
                </h4>

                {!! session('alert-error') !!}

          </div>


        @endif

      </div>
      

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

                <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Score Card Trans</h2>

            </div>

          <div class="box-body">

            <form action="#" method="POST" enctype="multipart/form-data" id="scoreCardForm">
            <div class="row">
              @csrf

            <div class="col-md-2">

               <div class="form-group">
                
                <label>Fy Year: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input type="text" id="fy_year" name="fy_year" class="form-control" value="{{$MaccYear}}" readonly>

                       <?php $CurrentDate =date("d-m-Y"); ?>
                                
                      <input type="hidden" class="form-control" name="vr_date" id="vr_date"value="{{$CurrentDate}}" >

                    </div>

                </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2">

               <div class="form-group">
                
                <label>T Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input type="text" id="t_code" name="t_code" class="form-control" value="{{$trans_list}}" readonly>

                    </div>

                </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2">

               <div class="form-group">
                
                <label>Series Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                      
                      <?php $series_code = count($seriesData);  ?>

                      <input list="series_list" id="series_code" name="seriesCode" class="form-control  pull-left" value="<?php if($series_code == 1){echo $seriesData[0]->SERIES_CODE;}else{echo old('seriesCode');}?>" placeholder="Series Code" onchange="getvrnoBySeries()">

                      <datalist id="series_list">

                        @foreach($seriesData as $rows)
           
                          <option value="{{$rows->SERIES_CODE}}" data-xyz ="{{ $rows->SERIES_NAME}}">{{ $rows->SERIES_CODE }} = {{ $rows->SERIES_NAME }}</option>
                                       

                        @endforeach

                      </datalist>

                    </div>

                </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-4">

              <div class="form-group">

                <label>Series Name: 

                  <span class="required-field"></span>

                </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                  </div>
                   
                   @foreach($seriesData as $rows)
                  <input type="text"  id="seriesName" name="seriesName" class="form-control  pull-left" value="{{ $rows->SERIES_NAME }}" placeholder="Series Name" readonly >
                  @endforeach
                   
                </div>

              </div>
                  <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">

                <label> Vr No: </label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                  <input type="text" class="form-control rightcontent" name="vrno" value="" placeholder="Enter Vr No" id="vrseqnum" readonly="">

                </div>

              </div>
                  <!-- /.form-group -->
            </div>
            </div>

            <div class="row">

            <div class="col-md-2">

               <div class="form-group">
                
                <label>Emp Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input list="empList" type="text" id="emp_code" name="emp_code" class="form-control" value=""  autocomplete="off" placeholder="Emp Code" oninput="funEmpCode()">

                      <datalist id='empList'>
                          <?php foreach($emp_list as $key) { ?>

                          <option value='<?= $key->EMP_CODE ?>' data-xyz='<?= $key->EMP_NAME?>'>{{ $key->EMP_CODE  }} = {{ $key->EMP_NAME  }}</option>

                          <?php } ?>
                      </datalist>
                    </div>
                    
                    <small id="empCodeErr"></small>

                </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Emp Name : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input type='text' id='emp_name' class="form-control" name="emp_name" value="" autocomplete="off" placeholder="Emp Name" readonly>
                                   
                      
                  </div>

                </div>
               
            </div>
            
            <div class="col-md-2">

              <div class="form-group">
                
                <label>Grade : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input type="text" id="grade_code" name="grade_code" class="form-control" value="" placeholder="Grade"  autocomplete="off" readonly>

                      <input type="hidden" id="grade_name" name="grade_name" class="form-control" value="" placeholder="Grade Name">
                  </div>

              </div>
                
            </div>

            <div class="col-md-2">

               <div class="form-group">
                
                <label>Designation : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input type="text" id="desig_name" name="desig_name" class="form-control" value=""  autocomplete="off"  placeholder="Designation" readonly> 

                      <input type="hidden" id="desig_code" name="desig_code" class="form-control" value="">
                    </div>

              </div>
 
            </div>

            <div class="col-md-3">

               <div class="form-group">
                
                <label>Department : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input type="text" id="dept_name" name="dept_name" class="form-control" value=""  autocomplete="off" placeholder="Department" readonly="">

                      <input type="hidden" id="dept_code" name="dept_code" class="form-control" value="">

                    </div>

              </div>
              
            </div>
            </div>
            <div class="row">
            
            
            <div class="col-md-5">

               <div class="form-group">
                
                <label>Remarks : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <textarea id="remarks" name="remarks" rows="1" class="form-control" placeholder="Remarks"></textarea>
                    </div>

              </div>
               
            </div>
            
          </div>

          <h4 style="font-weight: 700;font-size: 16px;">Add Function</h4>

           <div class="row">

            <div class="col-sm-12">

              <div class="box box-primary Custom-Box">

                <div class="box-body">

                  <div class="table-responsive">

                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblScoreCard">

                      <tr>

                        <th>

                          <input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row">

                        </th>

                        <th>Sr.No.</th>

                        <th>Function <small style="color:red;font-size:14px;text-align:center;">*</small> </th>

                        <th>Target Date <small style="color:red;font-size:14px;">*</small></th>

                        <th>Start Date <small style="color:red;font-size:14px;">*</small></th>

                        <th>End Date <small style="color:red;font-size:14px;">*</small></th>
                        
                      </tr>

                      <tr class="useful">
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/>
                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <span id='snum'>1.</span>

                          <input type='hidden' name='ScoreCardDetlSlno[]' id='ScoreCardDetlSlno' value='1'>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type='text' name='function[]' id='function1' value='' class='' style="margin-bottom:5px;" autocomplete="off" disabled="" onchange="functionActivate()"><br>

                          <small id="functionErr1"></small>

                        </td>
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                         <input type="text" name='targetDt[]' id='targetDt1' class="scoreCardDate"  autocomplete="off" style="margin-bottom:5px;" disabled=""><br>
                         
                          <small id="targetDtErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type="text" name='startDt[]' id='startDt1' class="scoreCardDate"  autocomplete="off" style="margin-bottom:5px;" disabled=""><br>

                          <small id="startDtErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='EndDate[]' id='endDt1' class="scoreCardDate" autocomplete="off" style="margin-bottom:5px;" disabled=""><br>

                         <small id="endDtErr1"></small>

                        </td>
                      </tr>

                    </table>

              </div>

              <button type="button" class='btn btn-danger delete' id="deleteFunction"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

              <button type="button" class='btn btn-info addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

              <div class="text-center col-md-12">
                
                <button type="button" class="btn btn-success" id="btnSave" onclick="funAddFunActivity()">Save</button>
                <button class="btn btn-warning" id="btnReset" type="reset"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp;Reset</button>
              </div>
             </div>

            </div>
        </div>
      </div>

       <h4 style="font-weight: 700;font-size: 16px;">Add Milestone</h4>

           <div class="row">

            <div class="col-sm-12">

              <div class="box box-primary Custom-Box">

                <div class="box-body">

                  <div class="table-responsive">

                    <table class="table tdthtablebordr" border="1" cellspacing="0" id="tblMilestone">

                      <tr>

                        <th>

                          <input class='check_all' type='checkbox' onclick="select_all()" title="Delete All Row">

                        </th>

                        <th>Sr.No.</th>

                        <th>Function <small style="color:red;font-size:14px;">*</small> </th>

                        <th>Milestone <small style="color:red;font-size:14px;">*</small></th>

                        <th>Task <small style="color:red;font-size:14px;">*</small></th>

                        <th>Weightage <small style="color:red;font-size:14px;">*</small></th>
                        
                        <th>Target Date <small style="color:red;font-size:14px;">*</small></th>

                        <th>Start Date <small style="color:red;font-size:14px;">*</small></th>

                        <th>End Date <small style="color:red;font-size:14px;">*</small></th>

                       </tr>

                      <tr class="useful">
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          <input type='checkbox' class='case' title="Delete Single Row" onclick="select_all()"/>
                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <span id='snum'>1.</span>

                          <input type='hidden' name='ScoreCardMilestone[]' id='ScoreCardMilestone' value='1'>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input list="funActivitylist" type='text' name='milestoneFun[]' id='milestoneFun1' value='' class='' style="margin-bottom:5px;width:120px;" autocomplete="off" disabled="" onclick="funMileStone(1)">
                          <datalist id="funActivitylist">
                            
                          </datalist>
                          <br>

                          <small id="milestoneFunErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type='text' name='milestone[]' id='milestone1' value='' class='' style="margin-bottom:5px;width:120px;" autocomplete="off" disabled=""><br>

                          <small id="milestoneErr1"></small>

                        </td>
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                         <input type="text" name='milestoneTask[]' id='milestoneTask1' class=""  autocomplete="off" style="margin-bottom:5px;width:120px;" disabled=""><br>
                         
                          <small id="milestoneTaskErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                         <input type="text" name='milstoneWeightage[]' id='milstoneWeightage1' class="number"  autocomplete="off" style="width:120px;margin-bottom:5px;" disabled=""><br>
                         
                          <small id="milstoneWeightageErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type="text" name='milstoneTargetDt[]' id='milstoneTargetDt1' class="scoreCardDate"  autocomplete="off" style="width:120px;margin-bottom:5px;" disabled=""><br>

                          <small id="milstoneTargetDtErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type="text" name='milstoneStartDt[]' id='milstoneStartDt1' class=""  autocomplete="off" style="width:120px;margin-bottom:5px;"disabled=""><br>

                          <small id="milstoneStartDtErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='milstoneEndDate[]' id='milstoneEndDt1' class="" autocomplete="off" style="width:120px;margin-bottom:5px;" disabled=""><br>

                         <small id="milstoneEndDtErr1"></small>

                        </td>
                      </tr>

                    </table>

              </div>

              <button type="button" class='btn btn-danger delete' id="deletehidn"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

              <button type="button" class='btn btn-info addMilestone' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>

             <div class="text-center"><small id="totalWErr"></small></div>
             </div>
            </div>
        </div>
      </div>
      

          <div class="row col-md-12">
            <div class="text-center">
            <button type="button" class="btn btn-success" id="checkValidation"><i class="fa fa-save"></i> Save</button>
            </div>
          </div>

          </div>
            
          
          </form>

            </div>
   
           

          </div>
        </div><!-- /.box-body -->


        </div>

      </div>


    </div>

  </section>
</div>


@include('admin.include.footer')
<script type="text/javascript">

$( window ).on( "load", function() {
    getvrnoBySeries();
    $('#emp_code').css('border-color','#ff0000').focus();
    
}); 

function getvrnoBySeries(){

    var seriesCode = $('#series_code').val();
    var transcode  = $('#t_code').val();
    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('get-vr-sequence-by-series') }}",

          method : "POST",

          type: "JSON",

          data: {seriesCode: seriesCode,transcode:transcode},

          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  if(data1.vrno_series == '' || data1.vrno_series ==null){
                    $('#vrseqnum').val('');
                  }else{
                    if(data1.vrno_series){
                      var getlastno = data1.vrno_series.LAST_NO;
                    }else{
                      var getlastno = '';
                    }
                    if(data1.vrnodata == ''){
                      $('#vrseqnum').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);


                    }
                  }

              }

          }

    });

  }

function funEmpCode(){

   var empcode = $('#emp_code').val();
   if(empcode == ''){
     $('#emp_code').css('border-color','#ff0000').focus();
   }else{
    $('#emp_code').css('border-color','#d2d6de');
    $('#function1').prop('disabled',false);
    $('#targetDt1').prop('disabled',false);
    $('#startDt1').prop('disabled',false);
    $('#endDt1').prop('disabled',false);
   }

}

function functionActivate(){

 var funAct = $('#function1').val();
   if(funAct != ''){
     $('#emp_code').prop('readonly',true);
   }else{
    
   }

}                

$(function(){

var i=2;

$(".addmore").on('click',function(){
      
      count=$('#tblScoreCard tr').length;

      countTr = count-1;
      
      var fun_name  =  $('#function'+countTr).val();

      if(fun_name == ''){
        $('#functionErr'+countTr).html('Function Is Required').css('color','red');
        return false;
      }
      else{
        $('#functionErr'+countTr).html('');
      }
      

      var targetDt  =  $('#targetDt'+countTr).val();

      if(targetDt == ''){
        $('#targetDtErr'+countTr).html('Target Date Field Is Required').css('color','red');
        return false;
      }else{
        $('#targetDtErr'+countTr).html('');
      }
      
      var startDt  =  $('#startDt'+countTr).val();
      if(startDt == ''){
        $('#startDtErr'+countTr).html('Start Date Field Is Required').css('color','red');
        return false;
      }else{
        $('#startDtErr'+countTr).html('');
      }

      var endDt  =  $('#endDt'+countTr).val();
      if(endDt == ''){
        $('#endDtErr'+countTr).html('End Date Field Is Required').css('color','red');
      return false;

      }else{
      
      $('#endDtErr'+countTr).html('');

      var data="<tr><td class='tdthtablebordr' style='padding-top: 23px;'><input type='checkbox' class='case'/></td><td class='tdthtablebordr' style='padding-top: 22px;'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='ScoreCardDetlSlno[]' id='ScoreCardDetlSlno' value='"+count+"'></td>";

      data +="<td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='function[]' id='function"+count+"' value=''class='' style='margin-bottom: 5px; z-index: 0;'autocomplete='off'><br><small id='functionErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='targetDt[]' id='targetDt"+count+"' class='scoreCardDate' style='margin-bottom: 5px;' autocomplete='off'><br><small id='targetDtErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input rows='1' type='text' name='startDt[]' id='startDt"+count+"' class='scoreCardDate' style='margin-bottom: 5px;'autocomplete='off'><br><small id='startDtErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='EndDate[]' id='endDt"+count+"' class='scoreCardDate' style='margin-bottom: 5px;'autocomplete='off'><br><small id='endDtErr"+count+"'></small></td></tr>";

      $('#tblScoreCard').append(data);

      i++;

      var currentDate = new Date();
      $('.scoreCardDate').datepicker({
          format : 'dd-mm-yyyy',
          startDate :currentDate,
          todayHighlight: true,
          autoclose: true
      });
     }

  });

});

function funMileStone(id){
 $("#milestoneFun"+id).bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#funActivitylist option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

       if(msg == 'No Match'){
        $('#milestoneFun'+id).val('');
       }else{

          $('#milestone'+id).prop('disabled',false);
          $('#milestoneTask'+id).prop('disabled',false);
          $('#milstoneWeightage'+id).prop('disabled',false);
          $('#milstoneSuccRate'+id).prop('disabled',false);
          $('#milstoneTargetDt'+id).prop('disabled',false);
          $('#milstoneStartDt'+id).prop('disabled',false);
          $('#milstoneEndDt'+id).prop('disabled',false);
          $('#milstoneScore'+id).prop('disabled',false);

        findDt = $('#milestoneFun'+id).val();
        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });
  
        $.ajax({

            type: 'POST',

            url: "{{ url('/Transaction/ScoreCard/functionActivityDate') }}",

            
            data: {findDt:findDt},

            success: function (data) {
            var obj = JSON.parse(data);
            if(obj.response == 'success'){
              var data1 = obj.FuncDate;
             $.each(data1, function (i, data1) {
              
              var startDate = new Date(data1.START_DATE);
              var endDate = new Date(data1.END_DATE);

              $('#milstoneStartDt'+id).datepicker({
                  format : 'dd-mm-yyyy',
                  todayHighlight: true,
                  
                  startDate :startDate,
                  endDate: endDate,
                  autoclose:true
              });

               $('#milstoneEndDt'+id).datepicker({
                  format : 'dd-mm-yyyy',
                  todayHighlight: true,
                  
                  startDate :startDate,
                  endDate: endDate,
                  autoclose:true
              });
            
            })
           

            }
            
            
            
            
            }

        });
       }


    });
}

$("#emp_code").bind('change', function () {  

    var val = $(this).val();
    var xyz = $('#empList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

        $('#emp_code').val('');
        $('#emp_name').val('');
        $('#grade_code').val('');
        $('#grade_name').val('');
        $('#desig_code').val('');
        $('#desig_name').val('');
        $('#dept_code').val('');
        $('#dept_name').val('');
        $('#function1').prop('disabled',true);
        $('#targetDt1').prop('disabled',true);
        $('#startDt1').prop('disabled',true);
        $('#endDt1').prop('disabled',true);

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
              
              $('#grade_code').val(data1.GRADE_CODE);
              $('#grade_name').val(data1.GRADE_NAME);
              $('#desig_code').val(data1.DESIG_CODE);
              $('#desig_name').val(data1.DESIG_NAME);
              $('#dept_code').val(data1.DEPT_CODE);
              $('#dept_name').val(data1.DEPT_NAME);
              
            })
            
            }

        });
    }
});

$(function(){

var i=2;

$(".addMilestone").on('click',function(){
      
      count=$('#tblMilestone tr').length;

      countTr = count-1;
      
      var milestone_fun  =  $('#milestoneFun'+countTr).val();

      if(milestone_fun == ''){
        $('#milestoneFunErr'+countTr).html('Function Is Required').css('color','red');
        return false;
      }
      else{
        $('#milestoneFunErr'+countTr).html('');
      }

      var milestone  =  $('#milestone'+countTr).val();

      if(milestone == ''){
        $('#milestoneErr'+countTr).html('Milestone Is Required').css('color','red');
        return false;
      }
      else{
        $('#milestoneErr'+countTr).html('');
      }

      var milestoneTask  =  $('#milestoneTask'+countTr).val();

      if(milestoneTask == ''){
        $('#milestoneTaskErr'+countTr).html('Task Is Required').css('color','red');
        return false;
      }
      else{
        $('#milestoneTaskErr'+countTr).html('');
      }

      var weightage  =  $('#milstoneWeightage'+countTr).val();

      if(weightage == ''){
        $('#milstoneWeightageErr'+countTr).html('Weightage  Field Is Required').css('color','red');
        return false;
      }else{
        $('#milstoneWeightageErr'+countTr).html('');
      }

      var successRate  =  $('#milstoneSuccRate'+countTr).val();

      if(successRate == ''){
        $('#milstoneSuccRateErr'+countTr).html('Success Rate Field Is Required').css('color','red');
        return false;
      }else{
        $('#milstoneSuccRateErr'+countTr).html('');
      }

      var targetDt  =  $('#milstoneTargetDt'+countTr).val();

      if(targetDt == ''){
        $('#milstoneTargetDtErr'+countTr).html('Target Date Field Is Required').css('color','red');
        return false;
      }else{
        $('#milstoneTargetDtErr'+countTr).html('');
      }
      
      var startDt  =  $('#milstoneStartDt'+countTr).val();
      if(startDt == ''){
        $('#milstoneStartDtErr'+countTr).html('Start Date Field Is Required').css('color','red');
        return false;
      }else{
        $('#milstoneStartDtErr'+countTr).html('');
      }

      var endDt  =  $('#milstoneEndDt'+countTr).val();
      if(endDt == ''){
        $('#milstoneEndDtErr'+countTr).html('End Date Field Is Required').css('color','red');
      return false;

      }else{
      
      $('#milstoneEndDtErr'+countTr).html('');
      }

      var score  =  $('#milstoneScore'+countTr).val();
      if(score == ''){
        $('#milstoneScoreErr'+countTr).html('Score Field Is Required').css('color','red');
      return false;

      }else{
      
      $('#milstoneScoreErr'+countTr).html('');

      var data="<tr><td class='tdthtablebordr' style='padding-top: 23px;'><input type='checkbox' class='case'/></td><td class='tdthtablebordr' style='padding-top: 22px;'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='ScoreCardMilestone[]' id='ScoreCardMilestone' value='"+count+"'></td>";

      data +="<td class='tdthtablebordr' style='padding-top: 2%;'><input list='funActivitylist' type='text' name='milestoneFun[]' id='milestoneFun"+count+"' value='' style='width:120px;margin-bottom: 5px; z-index: 0;'autocomplete='off' onclick='funMileStone("+count+")'><datalist id='funActivitylist'></datalist><br><small id='milestoneFunErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='milestone[]' id='milestone"+count+"' value='' style='width:120px;margin-bottom: 5px; z-index: 0;'autocomplete='off' disabled><br><small id='milestoneErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='milestoneTask[]' id='milestoneTask"+count+"' value='' style='width:120px;margin-bottom: 5px; z-index: 0;'autocomplete='off' disabled><br><small id='milestoneTaskErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='milstoneWeightage[]' id='milstoneWeightage"+count+"' value='' style='width:120px;margin-bottom: 5px; z-index: 0;'autocomplete='off' class='number' disabled><br><small id='milstoneWeightageErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='milstoneTargetDt[]' id='milstoneTargetDt"+count+"' class='scoreCardDate' style='width:120px;margin-bottom: 5px;' autocomplete='off' disabled><br><small id='milstoneTargetDtErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input  type='text' name='milstoneStartDt[]' id='milstoneStartDt"+count+"' class='' style='width:120px;margin-bottom: 5px;'' autocomplete='off' disabled><br><small id='milstoneStartDtErr"+count+"'></small></td><td class='tdthtablebordr' style='padding-top: 2%;'><input type='text' name='milstoneEndDate[]' id='milstoneEndDt"+count+"' class='scoreCardDate' style='width:120px;margin-bottom: 5px;' autocomplete='off' disabled><br><small id='milstoneEndDtErr"+count+"'></small></td></tr>";

      $('#tblMilestone').append(data);

      i++;

      var currentDate = new Date();
      $('.scoreCardDate').datepicker({
          multidate: false,
          format : 'dd-mm-yyyy',
          todayHighlight: true,
          
          startDate :currentDate,
          maxDate: currentDate,
          autoclose:true
      });

      $('.number').keypress(function (event) {
      var keycode          = event.which;
      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
      event.preventDefault();
      }
      });
      
      }

  });

});



$(".delete").on('click', function() {
   
   
   $('.case:checkbox:checked').parents('#tblScoreCard tr').remove();

    $('.check_all').prop("checked", false); 

    check();

});

function check(){

      obj = $('#tblScoreCard tr').find('span');
      
      $.each( obj, function( key, value ) {

          id=value.id;

          $('#'+id).html(key+1);

      });

}

$(".delete").on('click', function() {
   
    $('.case:checkbox:checked').parents('#tblMilestone tr').remove();

    $('.check_all').prop("checked", false); 

    checkMilestone();

});

function checkMilestone(){

  obj = $('#tblMilestone tr').find('span');
  
  $.each( obj, function( key, value ) {

      id=value.id;

      $('#'+id).html(key+1);

  });

}

var currentDate = new Date();
$('.scoreCardDate').datepicker({
          multidate: false,
          format : 'dd-mm-yyyy',
          todayHighlight: true,
          
          startDate :currentDate,
          maxDate: currentDate,
          autoclose:true
});

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

  $('.number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
    });

});

$('#checkValidation').on('click',function(){

      var data         = $('#scoreCardForm').serialize();
      var empCode      = $('#emp_code').val();
      
      var count        = $('#tblScoreCard tr').length;
      var tblMilestone = $('#tblMilestone tr').length;
       
      var trCount      = count-1;
      var tblCount     = tblMilestone-1;
       
      for(var q=0;q<trCount;q++){

        var w = q +1;

        var funcActivity =  $('#function'+w).val();
        var targetDt     =  $('#targetDt'+w).val();
        var startDt      =  $('#startDt'+w).val();
        var endDt        =  $('#endDt'+w).val();
        
         
        if(funcActivity != ''){

          $('#functionErr'+w).html('');
        }else{
          
          $('#functionErr'+w).html('Function Field Is Required').css('color','red');
          return false;
        }

        if(targetDt != ''){

          $('#targetDtErr'+w).html('');
        }else{
          
          $('#targetDtErr'+w).html('Target Date Field Is Required').css('color','red');
          return false;
        }

        if(startDt != ''){

          $('#startDtErr'+w).html('');
        }else{
          
          $('#startDtErr'+w).html('Start Date Field Is Required').css('color','red');
          return false;
        }

        if(endDt != ''){

          $('#endDtErr'+w).html('');
        }else{
          
          $('#endDtErr'+w).html('End Date Field Is Required').css('color','red');
          return false;
        }

      }
      
      var totalWeightage = 0;
      for(var q=0;q<tblCount;q++){

        var y = q +1;

        var milestone_fun =  $('#milestoneFun'+y).val();
        var milestone     =  $('#milestone'+y).val();
        var milestoneTask =  $('#milestoneTask'+y).val();
        var weightage     =  $('#milstoneWeightage'+y).val();
        var successRate   =  $('#milstoneSuccRate'+y).val();
        var targetDt      =  $('#milstoneTargetDt'+y).val();
        var startDt       =  $('#milstoneStartDt'+y).val();
        var endDt         =  $('#milstoneEndDt'+y).val();
        var score         =  $('#milstoneScore'+y).val();
       

        if(milestone_fun == ''){

          $('#milestoneFunErr'+y).html('Function Is Required').css('color','red');
          return false;

        }else{

          $('#milestoneFunErr'+y).html('');
        }

        if(milestone == ''){

          $('#milestoneErr'+y).html('Milestone Is Required').css('color','red');
          return false;

        }else{

          $('#milestoneErr'+y).html('');

        }

        if(milestoneTask == ''){

        $('#milestoneTaskErr'+y).html('Task Is Required').css('color','red');
        return false;

        }else{

          $('#milestoneTaskErr'+y).html('');
        }

        if(weightage == ''){

          $('#milstoneWeightageErr'+y).html('Weightage  Field Is Required').css('color','red');
          return false;

        }else{

          totalWeightage = parseInt(totalWeightage) + parseInt(weightage);
          $('#milstoneWeightageErr'+y).html('');
        }

        if(successRate == ''){

          $('#milstoneSuccRateErr'+y).html('Success Rate Field Is Required').css('color','red');
          return false;

        }else{

          $('#milstoneSuccRateErr'+y).html('');
        }

        if(targetDt == ''){

          $('#milstoneTargetDtErr'+y).html('Target Date Field Is Required').css('color','red');
          return false;

        }else{

          $('#milstoneTargetDtErr'+y).html('');
        }
      
      
        if(startDt == ''){

          $('#milstoneStartDtErr'+y).html('Start Date Field Is Required').css('color','red');
          return false;

        }else{

          $('#milstoneStartDtErr'+y).html('');
        }

      
        if(endDt == ''){

          $('#milstoneEndDtErr'+y).html('End Date Field Is Required').css('color','red');
        return false;

        }else{
        
        $('#milstoneEndDtErr'+y).html('');
        }

     
        if(score == ''){

          $('#milstoneScoreErr'+y).html('Score Field Is Required').css('color','red');

          return false;

        }else{
      
         $('#milstoneScoreErr'+y).html('');}

         }

        if(totalWeightage < 100){

           $('#totalWErr').html('Weightage is Less than 100'  + '<br>'+ 'Can not Save Transaction').css('color','red').css('font-weight','900').css('font-size','12px');

           return false;

        }else if(totalWeightage > 100){

           $('#totalWErr').html('Weightage is Greater than 100' + '<br>'+ 'Can not Save Transaction').css('color','red').css('font-weight','900').css('font-size','12px');

           return false;

        }else{

           $('#totalWErr').html('');
        }

      $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

     });
  
     $.ajax({

         type: 'POST',

         url: "{{ url('/Transaction/ScoreCard/save-score-card') }}",
         
         data: data,

         success: function (data) {
         var data1 = JSON.parse(data);
         
         if(data1.response == 'success'){
       
          location.reload();
         
         }

        }
    });
    
 });

function funAddFunActivity(){

  var empcode = $('#emp_code').val();
   if(empcode == ''){
    $('#empCodeErr').html('Emp Code Is Required').css('color','red');
    return false;
    }
    else{
      $('#empCodeErr').html('');
    }
  
  var count     = $('#tblScoreCard tr').length;
       
  var trCount   = count-1;
  var funActivity = [];
  var funTargetDt = [];
  var funStartDt = [];
  var funEndDt = [];
  
  for(var q=0;q<trCount;q++){

    var w = q +1;
    var fun_name     =  $('#function'+w).val();
    var targetDt          =  $('#targetDt'+w).val();
    var startDt =  $('#startDt'+w).val();
    var endDt   =  $('#endDt'+w).val();
    
    if(fun_name == ''){
    $('#functionErr'+w).html('Function Is Required').css('color','red');
    return false;
    }
    else{
      $('#functionErr'+w).html('');
    }
    
    if(targetDt == ''){
      $('#targetDtErr'+w).html('Target Date Field Is Required').css('color','red');
      return false;
    }else{
      $('#targetDtErr'+w).html('');
    }
    
    if(startDt == ''){
      $('#startDtErr'+w).html('Start Date Field Is Required').css('color','red');
      return false;
    }else{
      $('#startDtErr'+w).html('');
    }

    if(endDt == ''){
      $('#endDtErr'+w).html('End Date Field Is Required').css('color','red');
    return false;

    }else{
    
    $('#endDtErr'+w).html('');

    funActivity.push(fun_name);
    funTargetDt.push(targetDt);
    funStartDt.push(startDt);
    funEndDt.push(endDt);

    }
   }

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

       });
    
    $.ajax({

         type: 'POST',

         url: "{{ url('/Transaction/ScoreCard/form-score-fun-activity-save') }}",
         
         data: {funActivity:funActivity,funTargetDt:funTargetDt,funStartDt:funStartDt,funEndDt:funEndDt},
         
         success: function (data) {
         var data1 = JSON.parse(data);
         var funlistData = data1.funList;
         
         if(data1.response == 'success'){

          $('#btnSave').prop('disabled',true);
          $('#btnReset').prop('disabled',true);
          $('.addmore').prop('disabled',true);
          $('#deleteFunction').prop('disabled',true);

          $("#funActivitylist").empty();
                    
          $.each(funlistData, function(k, getData){

            $("#funActivitylist").append($('<option>',{

              value:getData.FUNCTION_ACTIVITY,

              'data-xyz':getData.FUNCTION_ACTIVITY,
            }));

          });
           
           for(var q=0;q<trCount;q++){

            var w = q +1;
            
            $('#function'+w).attr('readonly',true);
            $('#targetDt'+w).attr('readonly','readonly');
            $('#targetDt'+w).datepicker("destroy");
            $('#startDt'+w).datepicker("destroy");
            $('#startDt'+w).attr('readonly',true);
            $('#endDt'+w).datepicker("destroy");
            $('#endDt'+w).attr('readonly',true);

           }

            $('#milestoneFun1').prop('disabled',false);
            
         }
         
        
         }
    });
}

  
  

    
    
</script>




@endsection
