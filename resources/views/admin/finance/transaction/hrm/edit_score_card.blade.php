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
                       
                      <input type="text" id="fy_year" name="fy_year" class="form-control" value="{{$fisYear}}" readonly>

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
                       
                      <input type="text" id="t_code" name="t_code" class="form-control" value="{{$getData->TRAN_CODE}}" readonly>

                      <input type="hidden" id="scoreCardId" name="scoreCardId" class="form-control" value="{{$getData->SCORECARDID}}">

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

                      <input list="series_list" id="series_code" name="seriesCode" class="form-control  pull-left" value="{{$getData->SERIES_CODE}}" placeholder="Series Code" readonly>

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
                   
                  
                  <input type="text"  id="seriesName" name="seriesName" class="form-control  pull-left" value="{{$getData->SERIES_NAME}}" placeholder="Series Name" readonly >
                 
                   
                </div>

              </div>
                  <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">

                <label> Vr No: </label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                  <input type="text" class="form-control rightcontent" name="vrno" value="{{$getData->VRNO}}" placeholder="Enter Vr No" id="vrseqnum" readonly="">

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
                       
                      <input  type="text" id="emp_code" name="emp_code" class="form-control" value="{{$getData->EMP_CODE}}"  autocomplete="off" placeholder="Emp Code" readonly>

                    </div>
                    
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
                       
                      <input type='text' id='emp_name' class="form-control" name="emp_name" value="{{$getData->EMP_NAME}}" autocomplete="off" placeholder="Emp Name" readonly>
                                   
                      
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
                       
                      <input type="text" id="grade_code" name="grade_code" class="form-control" value="{{$getData->GRADE_CODE}}" placeholder="Grade"  autocomplete="off" readonly>

                      <input type="hidden" id="grade_name" name="grade_name" class="form-control" value="{{$getData->GRADE_NAME}}" placeholder="Grade Name">
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
                       
                      <input type="text" id="desig_name" name="desig_name" class="form-control" value="{{$getData->DESIG_NAME}}"  autocomplete="off"  placeholder="Designation" readonly> 

                      <input type="hidden" id="desig_code" name="desig_code" class="form-control" value="{{$getData->DESIG_CODE}}">
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
                       
                      <input type="text" id="dept_name" name="dept_name" class="form-control" value="{{$getData->DEPT_NAME}}"  autocomplete="off" placeholder="Department" readonly="">

                      <input type="hidden" id="dept_code" name="dept_code" class="form-control" value="{{$getData->DEPT_CODE}}">

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
                       
                      <textarea id="remarks" name="remarks" rows="1" class="form-control" placeholder="Remarks" value="{{$getData->REMARKS}}">{{$getData->REMARKS}}</textarea>
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

                        <th>Sr.No.</th>

                        <th>Function <small style="color:red;font-size:14px;text-align:center;">*</small> </th>

                        <th>Target Date <small style="color:red;font-size:14px;">*</small></th>

                        <th>Start Date <small style="color:red;font-size:14px;">*</small></th>

                        <th>End Date <small style="color:red;font-size:14px;">*</small></th>
                        
                      </tr>

                      <?php $srNo=1; ?>
                      @foreach($getFunData as $row)

                      <tr class="useful">
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <span id='snum'>{{$srNo}}</span>

                          <input type='hidden' name='ScoreCardDetlSlno[]' id='ScoreCardDetlSlno' value='1'>
                           <input type='hidden' name='Slno[]' id='ScoreCardDetlSlno' value='{{$row->SLNO}}'>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type='text' name='function[]' id='function1' value='{{$row->FUN_ACTIVATE}}' class='' style="margin-bottom:5px;" autocomplete="off"  readonly><br>

                          <small id="functionErr1"></small>

                        </td>
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                         <input type="text" name='targetDt[]' id='targetDt1' class="scoreCardDate"  autocomplete="off" style="margin-bottom:5px;" value="{{$row->TARGET_DATE}}"><br>
                         
                          <small id="targetDtErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type="text" name='startDt[]' id='startDt1' class="scoreCardDate" value="{{$row->START_DATE}}" autocomplete="off" style="margin-bottom:5px;"><br>

                          <small id="startDtErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='EndDate[]' id='endDt1' class="scoreCardDate" autocomplete="off" style="margin-bottom:5px;" value="{{$row->END_DATE}}"><br>

                         <small id="endDtErr1"></small>

                        </td>
                      </tr>
                      <?php $srNo++; ?>
                      @endforeach

                    </table>

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

                        <th>Sr.No.</th>

                        <th>Function <small style="color:red;font-size:14px;">*</small> </th>

                        <th>Milestone <small style="color:red;font-size:14px;">*</small></th>

                        <th>Task <small style="color:red;font-size:14px;">*</small></th>

                        <th>Weightage <small style="color:red;font-size:14px;">*</small></th>
                        
                        <th>Target Date <small style="color:red;font-size:14px;">*</small></th>

                        <th>Start Date <small style="color:red;font-size:14px;">*</small></th>

                        <th>End Date <small style="color:red;font-size:14px;">*</small></th>

                       </tr>

                      <?php $srNo=1; ?>
                      @foreach($getTask as $row)
                      <tr class="useful">
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>

                          <span id='snum'>{{$srNo}}</span>

                          <input type='hidden' name='ScoreCardMilestone[]' id='ScoreCardMilestone' value='1'>

                          <input type='hidden' name='milstoneSlno[]' id='milstoneSlno' value='{{$row->SLNO}}'>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type='text' name='milestoneFun[]' id='milestoneFun1' value='{{$row->FUNCTION}}' class='' style="margin-bottom:5px;width:120px;" autocomplete="off" readonly>
                          

                          <small id="milestoneFunErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type='text' name='milestone[]' id='milestone1' value='{{$row->MILESTONE}}' class='' style="margin-bottom:5px;width:120px;" autocomplete="off"><br>

                          <small id="milestoneErr1"></small>

                        </td>
                        
                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                         <input type="text" name='milestoneTask[]' id='milestoneTask1' class=""  autocomplete="off" style="margin-bottom:5px;width:120px;" value="{{$row->TASK}}"><br>
                         
                          <small id="milestoneTaskErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                         <input type="text" name='milstoneWeightage[]' id='milstoneWeightage1' class="number"  autocomplete="off" style="width:120px;margin-bottom:5px;" value="{{$row->WEIGHTAGE}}"><br>
                         
                          <small id="milstoneWeightageErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type="text" name='milstoneTargetDt[]' id='milstoneTargetDt1' class="scoreCardDate"  autocomplete="off" style="width:120px;margin-bottom:5px;"value="{{$row->TARGET_DATE}}"><br>

                          <small id="milstoneTargetDtErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input type="text" name='milstoneStartDt[]' id='milstoneStartDt1' class=""  autocomplete="off" style="width:120px;margin-bottom:5px;"value="{{$row->START_DATE}}"><br>

                          <small id="milstoneStartDtErr1"></small>

                        </td>

                        <td class="tdthtablebordr" style='padding-top: 2%;'>
                          
                          <input  type="text" name='milstoneEndDate[]' id='milstoneEndDt1' class="" autocomplete="off" style="width:120px;margin-bottom:5px;" value="{{$row->END_DATE}}"><br>

                         <small id="milstoneEndDtErr1"></small>

                        </td>
                      </tr>

                       <?php $srNo++; ?>
                      @endforeach

                    </table>

              </div>
             
             </div>
            </div>
        </div>
      </div>
      

          <div class="row col-md-12">
            <div class="text-center">
            <button type="button" class="btn btn-success" id="checkValidation"><i class="fa fa-save"></i> Update</button>
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

         url: "{{ url('/Transaction/ScoreCard/form-score-card-update') }}",
         
         data: data,

         success: function (data) {
         var data1 = JSON.parse(data);
         
         if(data1.response == 'success'){
       
           var getName = btoa('ScoreCardUpdate');

           window.location.href="/biztechERP_DEV/Transaction/TravelRequisition/success-message/"+getName;
         
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
