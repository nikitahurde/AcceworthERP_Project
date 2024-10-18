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
            Job Opening
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

          <a href="#"> Job Opening </a>

        </li>

      </ul>

        </section>



  <section class="content">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Job Opening</h2>

            <div class="box-tools pull-right">

                <a href="{{url('/Transaction/JobOpening/view-job-opening-trans')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Job Opening</a>

            </div>

          </div><!-- /.box-header -->

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
        
        <div class="box-body">
            <form action="{{ url($action)}}" method="POST" enctype="multipart/form-data">
            <div class="row">
              @csrf
              <div class="col-md-2">

                <div class="form-group">

                  <label>Company Code : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                       <input type="text" class="form-control" name="comp_code"  id="comp_code" value="{{$comp_code}}" readonly >

                    </div>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-4">

                <div class="form-group">

                  <label>Company Name : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                       <input type="text" class="form-control" name="comp_name"  id="comp_name" value="{{$comp_name}}" readonly >

                    </div>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">
                
                <label>Job Opening Date: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-calendar" aria-hidden="true"></i>

                      </div>
                       
                      <input id="jobOpen_date" name="jobOpen_date" class="form-control  datepicker" value="{{$jobOpen_date}}"  autocomplete="off" onchange="funJobOpenDt()">
                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('jobOpen_date', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">
                
                <label>Position : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input list="positionList" type='textbox' id='position_code' class="form-control" name="position_code" value="{{$position_code}}" autocomplete="off" oninput="funPositionCode()" readonly>
                                   
                      <datalist id='positionList'>
                        
                        <option selected='selected' value=''>-- Select --</option>

                            @foreach ($position_list as $key)
                              <option value='<?php echo $key->POSITION_CODE?>' data-xyz ='<?php echo $key->POSITION_NAME; ?>' >{{$key->POSITION_NAME}} 
                                        
                            </option>
                        @endforeach
                      </datalist>

                      


                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('position_code', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">
                
                <label>Position Name: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                     <input class="form-control" type="text" id="position_name" name="position_name" value="{{$position_name}}" readonly>
                  
                  </div>

              </div>
                <!-- /.form-group -->
            </div>
          </div>
          <div class="row">

            <div class="col-md-2">

              <div class="form-group">
                
                <label>Department : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input list="deptList" type='textbox' id='dept_code' class="form-control" name="dept_code" value="{{ $dept_code }}" autocomplete="off" oninput="funDeptCode()" readonly>
                                   
                      <datalist id='deptList'>
                        
                        <option selected='selected' value=''>-- Select --</option>

                            @foreach ($dept_list as $key)
                              <option value='<?php echo $key->DEPT_CODE ?>' data-xyz ='<?php echo $key->DEPT_NAME; ?>' >{{$key->DEPT_NAME}}  
                                        
                            </option>
                        @endforeach
                      </datalist>

                      


                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('dept_code', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Department Name: <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                     <input type="text" class="form-control" id="dept_name" name="dept_name" value="{{$dept_name}}" readonly>
                  
                  </div>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">
                
                <label>Application Date : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-calendar" aria-hidden="true"></i>

                      </div>
                       
                      <input id="applDate" name="applDate" class="form-control datepicker" value="{{$applDate}}" placeholder="Date"  autocomplete="off" onchange="funApplDate()" readonly>
                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('applDate', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Application Close Date : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-calendar" aria-hidden="true"></i>

                      </div>
                       
                      <input id="applCloseDate" name="applCloseDate" class="form-control datepicker" value="{{$applCloseDate}}" autocomplete="off" placeholder="Appl Close Date" onchange="funApplCloseDt()" readonly> 
                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('applCloseDate', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">
                
                <label>Contact Person : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-mobile" aria-hidden="true"></i>

                      </div>
                       
                      <input id="contactPerson" name="contactPerson" class="form-control  Number" value="{{$contactPerson}}" placeholder="Mob. No" autocomplete="off" onchange="funMobileNo()" readonly>
                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('contactPerson', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            </div>
            <div class="row">

            <div class="col-md-2">

              <div class="form-group">
                
                <label>No of Opening : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>
                       
					            <input type="text"  class="form-control Number" name="noOfOpening" id="noOfOpening" value="{{$noOfOpening}}" autocomplete="off" onchange="funNoOpening()" readonly>
                     
                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('contactPerson', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Qualilfication : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
					            <input type="text"  class="form-control" name="qualification" id="qualification" value="{{$qualification}}" autocomplete="off" onchange="funQualification()" readonly>
                     
                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('qualification', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">
                
                <label>Salary Range : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>
                       
					           <input type="text"  class="form-control" name="sal_range" id="sal_range" value="{{$sal_range}}" autocomplete="off" readonly onchange="funSalRange()">
                     
                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('sal_range', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Job Type : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
					            <input list="typeList" type='textbox' id='jobType' class="form-control" name="jobType" value="{{$jobType}}" autocomplete="off" oninput="funJobType()" readonly>
                                   
                      <datalist id='typeList'>
                        
                        <option selected='selected' value=''>-- Select --</option>

                        <option  value='Full Time'>Full Time</option>
                        
                        <option  value='Part Time'>Part Time</option>
                      
                      </datalist>
                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('sal_range', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">
                
                <label>Work Experience : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                      </div>
                       
                     <input type="text" class="form-control" name="work_experience" id="work_experience" value="{{$work_experience}}" autocomplete="off" onchange="funWorkExp()" readonly>

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('work_experience', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            </div>
            
            <div class="row col-md-12">
              
              <div class="col-md-6">

              <div class="form-group">
                
                <label>Job Description : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                     <textarea class="form-control" name="jobDescrption" id="jobDescrption" value="{{$jobDescrption}}" style=" height:120px;" autocomplete="off">{{$jobDescrption}}</textarea>

                  </div>

                  </div>
                <!-- /.form-group -->
            </div>
            </div>

            <?php if($button=='Update') { ?>

                

                  <div class="col-md-6">

                   <div class="form-group">

                   <label>Job Opening Block : <span class="required-field"></span></label>

                      <div class="input-group">

                        <input type="radio" class="optionsRadios1" name="job_block" value="YES" <?php if($jobOpen_Block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


                        <input type="radio" class="optionsRadios1" name="job_block" value="NO" <?php if($jobOpen_Block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                      </div>


                      <small id="emailHelp" class="form-text text-muted">


                       {!! $errors->first('leave_block', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <input type="hidden" name="idJobOpen" value="{{$id}}">


                    </div>

                  </div>

              



              <?php } ?>

          </div>
            
          <div class="row">
	          <div class="text-center" style="margin-bottom:20px;">
	           <button type="submit" class="btn btn-success" ><?php echo $button; ?></button>
	          </div>
          </div>
          </form>

            </div>
   
           

          </div>

            
            
          <!-- </form> -->

            

          


        </div><!-- /.box-body -->


        </div>

      </div>


    </div>

  </section>

  



</div>

@include('admin.include.footer')
<script type="text/javascript">

$( window ).on( "load", function() {

    $('#jobOpen_date').css('border-color','#ff0000');
    
});

function funJobOpenDt(){

  var jobOpenDt = $('#jobOpen_date').val();
  if(jobOpenDt == ''){

    $('#jobOpen_date').css('border-color','#ff0000').focus();

  }else{
   $('#jobOpen_date').css('border-color','#d2d6de');

   var position_code = $('#position_code').val();
   if(position_code == ''){

    $('#position_code').prop('readonly',false);
    $('#position_code').css('border-color','#ff0000').focus();
   }else{
    $('#position_code').css('border-color','#d2d6de'); 
   }
  
  }
}

function funPositionCode(){

  var position_code = $('#position_code').val();
  if(position_code == ''){

    $('#position_code').css('border-color','#ff0000').focus();

  }else{
   $('#position_code').css('border-color','#d2d6de');
   var dept_code = $('#dept_code').val();
   if(dept_code == ''){

    $('#dept_code').prop('readonly',false);
    $('#dept_code').css('border-color','#ff0000').focus();
   }else{
    $('#dept_code').css('border-color','#d2d6de'); 
   }
  
  }

}

function funDeptCode(){

  var dept_code = $('#dept_code').val();
  if(dept_code == ''){

    $('#dept_code').css('border-color','#ff0000').focus();

  }else{
   $('#dept_code').css('border-color','#d2d6de');

   var applDate = $('#applDate').val();
   if(applDate == ''){

    $('#applDate').prop('readonly',false);
    $('#applDate').css('border-color','#ff0000');
   }else{
    $('#applDate').css('border-color','#d2d6de'); 
   }
  
  }

}

function funApplDate(){

  var applDate = $('#applDate').val();
  if(applDate == ''){

    $('#applDate').css('border-color','#ff0000').focus();

  }else{
   $('#applDate').css('border-color','#d2d6de');

   var applCloseDate = $('#applCloseDate').val();
   if(applCloseDate == ''){

    $('#applCloseDate').prop('readonly',false);
    $('#applCloseDate').css('border-color','#ff0000');
   }else{
    $('#applCloseDate').css('border-color','#d2d6de'); 
   }
   
  }

}

function funApplCloseDt(){

  var applCloseDate = $('#applCloseDate').val();
  if(applCloseDate == ''){

    $('#applCloseDate').css('border-color','#ff0000').focus();

  }else{
   $('#applCloseDate').css('border-color','#d2d6de');

   var contactPerson = $('#contactPerson').val();
   if(contactPerson == ''){

    $('#contactPerson').prop('readonly',false);
    $('#contactPerson').css('border-color','#ff0000').focus();
   }else{
    $('#contactPerson').css('border-color','#d2d6de'); 
   }
   
  }

}

function funMobileNo(){

  var contactPerson = $('#contactPerson').val();
  if(contactPerson == ''){

    $('#contactPerson').css('border-color','#ff0000').focus();

  }else{
   $('#contactPerson').css('border-color','#d2d6de');

   var noOfOpening = $('#noOfOpening').val();
   if(noOfOpening == ''){

    $('#noOfOpening').prop('readonly',false);
    $('#noOfOpening').css('border-color','#ff0000').focus();
   }else{
    $('#noOfOpening').css('border-color','#d2d6de'); 
   }
   
  }

}

function funNoOpening(){

  var noOfOpening = $('#noOfOpening').val();
  if(noOfOpening == ''){

    $('#noOfOpening').css('border-color','#ff0000').focus();

  }else{
   $('#noOfOpening').css('border-color','#d2d6de');

   var qualification = $('#qualification').val();
   if(qualification == ''){

    $('#qualification').prop('readonly',false);
    $('#qualification').css('border-color','#ff0000').focus();
   }else{
    $('#qualification').css('border-color','#d2d6de'); 
   }
   
  }

}

function funQualification(){

  var qualification = $('#qualification').val();
  if(qualification == ''){

    $('#qualification').css('border-color','#ff0000').focus();

  }else{
   $('#qualification').css('border-color','#d2d6de');

   var sal_range = $('#sal_range').val();
   if(sal_range == ''){

    $('#sal_range').prop('readonly',false);
    $('#sal_range').css('border-color','#ff0000').focus();
   }else{
    $('#sal_range').css('border-color','#d2d6de'); 
   }
   
  }

}

function funSalRange(){

  var sal_range = $('#sal_range').val();
  if(sal_range == ''){

    $('#sal_range').css('border-color','#ff0000').focus();

  }else{
   $('#sal_range').css('border-color','#d2d6de');

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

   var work_experience = $('#work_experience').val();
   if(work_experience == ''){

    $('#work_experience').prop('readonly',false);
    $('#work_experience').css('border-color','#ff0000').focus();
   }else{
    $('#work_experience').css('border-color','#d2d6de'); 
   }
  
  }
}

function funWorkExp(){

  var work_experience = $('#work_experience').val();
  if(work_experience == ''){

    $('#work_experience').css('border-color','#ff0000').focus();

  }else{
   $('#work_experience').css('border-color','#d2d6de');
  }

}

var currentDate = new Date();

$('.datepicker').datepicker({

      multidate: false,
      format : 'yyyy-mm-dd',
      todayHighlight: true,
      
      startDate :currentDate,
      
  });


$("#position_code").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#positionList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

    	$('#position_code').val('');
    	$('#position_name').val('');

    }
    else{
      console.log('hello');
    	$('#position_name').val(msg);
    }
});

$("#dept_code").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#deptList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

    	$('#dept_code').val('');
    	$('#dept_name').val('');

    }
    else{
    	$('#dept_name').val(msg);
    }
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

$('.NumberAny').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
    
});

});
	
	

    
    
</script>




@endsection
