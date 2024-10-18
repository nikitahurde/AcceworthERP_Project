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
            Emp Interview Trans
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

          <a href="#"> Emp Interview </a>

        </li>

      </ul>

        </section>



  <section class="content">

    <div class="row">

      <!-- <div class="col-sm-1"></div> -->

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Emp Interview</h2>

            <div class="box-tools pull-right">

                <a href="{{url('/Transaction/EmpInterview/view-emp-interview-trans')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Emp Interview</a>

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

            <div class="col-md-3">

               <div class="form-group">
                
                <label>Date : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-calendar" aria-hidden="true"></i>

                      </div>
                       
                      <input id="interview_date" name="interview_date" class="form-control  datepicker" value="{{$interview_date}}"  autocomplete="off" placeholder="Current Date">
                    </div>

	                 <small id="emailHelp" class="form-text text-muted">

	                      {!! $errors->first('interview_date', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

	                 </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

                <div class="form-group">

                  <label>Name : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                       <input type="text" class="form-control" name="name"  id="name" value="{{$name}}" autocomplete="off" placeholder="Name"> 

                    </div>

                     <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('name', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                   </small>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3">

                <div class="form-group">

                  <label>Interview Type : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                       <input list="interviewList" type='textbox' id='interview_type' class="form-control" name="interview_type" value="{{$interview_type}}" autocomplete="off" placeholder="Interview Type">
                                   
                      <datalist id='interviewList'>
                        
                        <option selected='selected' value=''>-- Select --</option>
                        <option value="Traditional Interview" data-xyz="Traditional Interview">Traditional Interview</option>

                        <option value="Phone Interview" data-xyz="Phone Interview">Phone Interview</option>

                        <option value="Video Interview" data-xyz="Video Interview">Video Interview</option>

                        <option value="Group Interview" data-xyz="Group Interview">Group Interview</option>

                        <option value="Working Interview" data-xyz="Working Interview">Working Interview</option>

                        <option value="Panel Interview" data-xyz="Panel Interview">Panel Interview</option>

                            
                      </datalist>

                    </div>

                     <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('interview_type', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                   </small>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3">

                <div class="form-group">

                  <label>Email : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                       <input type="email" class="form-control" name="email"  id="email" value="{{$email}}" autocomplete="off" placeholder="Email">

                    </div>

                     <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('email', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                   </small>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3">

                <div class="form-group">

                  <label>Education : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                       <input type="text" class="form-control" name="education"  id="education" value="{{$education}}" autocomplete="off" placeholder="Education">

                    </div>

                     <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('education', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                   </small>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3">

                <div class="form-group">

                  <label>Location : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                       <input type="text" class="form-control" name="location"  id="location" value="{{$location}}" autocomplete="off" placeholder="Location">

                    </div>

                     <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('location', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                   </small>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3">

                <div class="form-group">

                  <label>Position List : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input list="positionList"  id="position" name="position" class="form-control  pull-left" value="{{ $position}}" placeholder="Position List"  autocomplete="off">

                            <datalist id="positionList">
                            
                               <option value="">--SELECT--</option>

                               @foreach($position_list as $data1)

                                <option value="{{ $data1->POSITION_CODE }}" data-xyz ="{{ $data1->POSITION_NAME }}">{{ $data1->POSITION_CODE }} = {{ $data1->POSITION_NAME }}</option>

                               @endforeach

                            </datalist>


                    </div>

                     <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('position', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                   </small>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3">

                <div class="form-group">

                  <label>Position Name : </label>
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                       <input type="text" class="form-control" name="position_name"  id="position_name" value="{{$position_name}}" autocomplete="off" readonly placeholder="Position Name">

                    </div>

                     <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('position_name', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                   </small>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3">

                <div class="form-group">

                  <label>Interview By : <span class="required-field"></span></label>
                    
                    <div class="input-group">
                      
                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                       <input type="text" class="form-control" name="interview_by"  id="interviewBy" value="{{$interview_by}}" autocomplete="off" placeholder="Interview By">

                    </div>

                     <small id="emailHelp" class="form-text text-muted">

	                      {!! $errors->first('interview_by', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

	                 </small>
                </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Application Status : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input list="statusList" type='textpositionList' id='applStatus' class="form-control" name="applStatus" value="{{$applStatus}}" autocomplete="off" placeholder="Status">
                                   
                      <datalist id='statusList'>
                        
                        <option selected='selected' value=''>-- Select --</option>
                        <option value="Approved" data-xyz="Approved">Approved</option>
                        <option value="Reject" data-xyz="Reject">Reject</option>
                        <option value="Hold" data-xyz="Hold">Hold</option>

                            
                      </datalist>

                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('applStatus', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>HR Remark : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input  type='text' id='hr_remark' class="form-control" name="hr_remark" value="{{ $hr_remark }}" autocomplete="off" placeholder="Hr Status">
                                   
                      
				          </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('hr_remark', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
               
            </div>

            <div class="col-md-3">

              <div class="form-group">
                
                <label>Management Remark : <span class="required-field"></span></label>

                  <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                      </div>
                       
                      <input type="text" id="managment_remark" name="managment_remark" class="form-control" value="{{$managment_remark}}" placeholder="Management Remarks"  autocomplete="off" >
                  </div>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('managment_remark', '<p class="help-block" style="color:red;margin-left:5%;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>
            </div>

            <div class="row">

            
            
            <?php if($button=='Update') { ?>

            <div class="col-md-6">

                <div class="form-group">

	                <label>Emp Interview Block : <span class="required-field"></span></label>

	                <div class="input-group">

	                    <input type="radio" class="optionsRadios1" name="empInterview_block" value="YES" <?php if($empInterview_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;


	                    <input type="radio" class="optionsRadios1" name="empInterview_block" value="NO" <?php if($empInterview_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

	                </div>

	               <input type="hidden" name="idInterAppl" value="{{$id}}">

                </div>

            </div>

        </div>

         <?php } ?>

          <div class="row col-md-12">
	          <div class="text-center">
	           <button type="submit" class="btn btn-success" ><?php echo $button; ?></button>
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
$('.datepicker').datepicker({

      multidate: false,
      format : 'yyyy-mm-dd',
      todayHighlight: true,
      
      startDate :currentDate,
      
  });

$("#applStatus").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#statusList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

    	$('#applStatus').val('');
    	
    }
});

$("#interview_type").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#interviewList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

      $('#interview_type').val('');
      
    }
});

$("#position").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#positionList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){

      $('#position').val('');
      $('#position_name').val('');
      
    }else{
      $('#position_name').val(msg);
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

});
	
	

    
    
</script>




@endsection
