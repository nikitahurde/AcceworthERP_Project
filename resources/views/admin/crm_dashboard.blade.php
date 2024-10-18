
@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.crmnavbar')



@include('admin.include.crmsidebar')

<style type="text/css">

  .contentHeader{
    margin-top: 4% !important;
  }
  .settitle{
    font-weight: 600;
    font-size: 17px;
  }
  sup {
    top: -0.2em;
}
.shadow-lg  { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
.Box1:hover{
    border: 1px solid #a9e1f5;
    border-radius: 5px;
}
.Box2:hover{
    border: 1px solid #a0f5ce;
    border-radius: 5px;
}
.small-box h3 {
    font-size: 32px !important;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
}
.tabtask{
  font-weight: 600;
}
/*.content{
  height: auto !important;
}*/
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #ffffff;
}
tr, td{
  font-size: 12px !important;
  padding: 0px !important;
}
.showcursor{
  cursor: pointer
}
.btn-xs{
  padding: 0px 5px !important;
}
.modltitletext{
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    color: #69b0cb;
}
.showSeletedName{
  color: #5597b1;
    font-weight: 700;
}
.statusHead{
  font-size: 16px;
    font-weight: 700;
    color: #69b0cb;
}
.setmargin{
  padding-left: 4px;
}
.block_one{
    border: 1px solid #d7cfcf;
    padding: 5px;
    margin-bottom: 10px;
    border-top-color: #3c8dbc;
}
.bloc_two{
    border: 1px solid #d7cfcf;
    padding: 5px;
    margin-bottom: 10px;
    border-top-color: #e9350c !important;
}
.block_three{
    border: 1px solid #d7cfcf;
    padding: 5px;
    margin-bottom: 10px;
    border-top-color: #ff9800c9 !important;
}.nav-tabs-custom>.nav-tabs>li.active {
    border-top-color: #4EBE8A !important;
}
</style>



 <!-- =========== Start : demo page ============= -->



      <!-- Content Wrapper. Contains page content -->

      <div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header" >

          <h1>

            Dashboard 


            <small style="font-weight: 600;color: #3c8dbc;">| C & F Management System</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

            <li class="active">Dashboard</li>

          </ol>

        </section>


        <section class="content">
          <div class="row">

              <section class="col-sm-7 connectedSortable ui-sortable">
          

            <div class="row">


          <?php if(Session::get('usertype')=='CRM'){ ?>
              <div>

            <?php  $Fname = Session::get('form_name'); ?>

            <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSE0' == $row &&  Session::get('usertype')=='CRM' ||  'DCSE0' == $row && Session::get('usertype')=='SRM') { 

                ?>
              
              <a href="{{ url('/Transaction/Crm/View-Crm-Enquery-Trans') }}">
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>Top 10</h3>
                      <p style="font-size: 16px;font-weight: 700;">Enquiery</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-user"></i>
                    </div>
                    <div class="small-box-footer">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>

         <?php } else{} } }?>



         <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSQ0' == $row &&  Session::get('usertype')=='CRM' || 'DCSQ0' == $row &&  Session::get('usertype')=='SRM') { 

                ?>

              <a href="{{ url('/Transaction/Crm/View-Crm-Quotation-Trans') }}">
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>Top 10</h3>
                      <p style="font-size: 16px;font-weight: 700;">Quotation</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-pie-chart"></i>
                    </div>
                      <div class="small-box-footer">
                        <i class="fa fa-arrow-circle-right"></i>
                      </div>
                  </div>
                </div><!-- ./col -->
              </a>

        <?php } else{} } }?>

          <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSO0' == $row &&  Session::get('usertype')=='CRM' || 'DCSO0' == $row && Session::get('usertype')=='SRM') { 

                ?>

              <a href="{{ url('/Transaction/CRM/View-Crm-Order-Trans') }}">
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Top 10</h3>
                      <p style="font-size: 16px;font-weight: 700;">Orders</p>
                    </div>
                    <div class="icon">
                     <i class="fa fa-user-plus"></i>
                    </div>
                    <div class="small-box-footer">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div><!-- ./col -->
              </a>

               <?php } else{} } }?>


               
              </div>

            <?php  } ?>


            <?php if(Session::get('usertype')=='SRM'){ ?>
              <div>

            <?php  $Fname = Session::get('form_name'); ?>

            <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSE0' == $row && Session::get('usertype')=='SRM') { 

                ?>
              
              <a href="{{ url('/Transaction/Srm/View-Srm-Enquery-Trans') }}">
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <h3>Top 10</h3>
                      <p style="font-size: 16px;font-weight: 700;">Enquiery</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-user"></i>
                    </div>
                    <div class="small-box-footer">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
              </a>

         <?php } else{} } }?>



         <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSQ0' == $row &&  Session::get('usertype')=='SRM') { 

                ?>

              <a href="{{ url('/Transaction/Srm/View-Srm-Quotation-Trans') }}">
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      <h3>Top 10</h3>
                      <p style="font-size: 16px;font-weight: 700;">Quotation</p>
                    </div>
                    <div class="icon">
                      <i class="fa fa-pie-chart"></i>
                    </div>
                      <div class="small-box-footer">
                        <i class="fa fa-arrow-circle-right"></i>
                      </div>
                  </div>
                </div><!-- ./col -->
              </a>

        <?php } else{} } }?>

          <?php  if(isset($Fname)){

                $Fname = Session::get('form_name');
                
                foreach ($Fname as $row) { 

                  if('DCSO0' == $row && Session::get('usertype')=='SRM') { 

                ?>

              <a href="{{ url('/Transaction/SRM/View-Srm-Order-Trans') }}">
                <div class="col-lg-4 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <h3>Top 10</h3>
                      <p style="font-size: 16px;font-weight: 700;">Orders</p>
                    </div>
                    <div class="icon">
                     <i class="fa fa-user-plus"></i>
                    </div>
                    <div class="small-box-footer">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div><!-- ./col -->
              </a>

               <?php } else{} } }?>


               
              </div>

            <?php  } ?>
            </div>

            

            


          </section>

            <section class="col-sm-5 connectedSortable ui-sortable">

            @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4> <i class="icon fa fa-check"></i> Success...!</h4>

                 {!! session('alert-success') !!}
              </div>

            @endif

            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs" style="background-color: #ebe7db;">
                <li class="active"><a href="#tab_1" class="tabtask" data-toggle="tab" aria-expanded="true">Favourite</a></li>
                <li class=""><a href="#tab_2" class="tabtask" data-toggle="tab" aria-expanded="false">My Task</a></li>
                <li class=""><a href="#tab_3" class="tabtask" data-toggle="tab" aria-expanded="false">Task</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <input type="hidden" value="{{Session::get('userid')}}" id="LoginUser">
                  <table class="table-border">

                    <?php $srno=1; foreach ($pageData as $key) { ?>

                      <tr>
                        <td class="showcursor" onclick="clicklink('<?php echo $srno;?>','<?php echo $key->form_link;?>')">{{$key->FORM_CODE}} - {{$key->FORM_NAME}}</td>
                        <td><button class="btn btn-danger btn-xs" data-toggle="modal" onclick="return dleteuserTCode('<?php echo $key->USERTCODEID;?>','<?php echo $srno; ?>');"><i class="fa fa-trash" title="Delete"></i></button></td>
                        <!-- model for delete data -->
                        <div class="modal fade" id="usertcodeDelete<?php echo $srno; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h3 class="modal-title" id="exampleModalLabel">Are You Sure...!</h3>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                You Want To Delete This Data...!
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal" style="margin-right: 23%;">Cancle</button>
                                  <form action="{{ url('/delete-user-tcode-data') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="usertcodeId" id="usertcodeId<?php echo $srno; ?>" value="">
                                    <input type="submit" value="Delete" style="margin-top: -20%;" class="btn btn-sm btn-danger">
                                  </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- model for delete data -->
                      </tr>

                  <?php $srno++;} ?>
                  </table>
                  <a href="{{ url('Dashboard/user/tcode/form') }}" class="btn btn-primary btn-xs" title="edit" style="margin-top: 10px;">Add More</i></a>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <table class="table-border">
                      <tr>
                        <th>From User</th>
                        <th>Task Name</th>
                        <th>Target Date</th>
                        <th>Description</th>
                        <th>Action</th>
                      </tr>
                    <?php $tSrno =1; foreach ($MytaskData as $Mdata) {?>
                      <tr>
                        <td>{{$Mdata->USER_NAME}}</td>
                        <td>{{$Mdata->TASK_NAME}}</td>
                        <td>{{$Mdata->TARGET_DATE}}</td>
                        <td>{{$Mdata->DESCRIPTION}}</td>
                        <td><?php if($Mdata->CL_DATE && $Mdata->CL_REMARK){ ?><div id="AplyIconBT<?php echo $tSrno; ?>"><i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 21px;margin-left: 3px;"></i></div><?php }else{ ?><button type="button" class="btn btn-primary btn-xs" id="task_status<?php echo $tSrno; ?>" data-toggle="modal" data-target="#taskStatus<?php echo $tSrno; ?>" style="padding-bottom: 0px;padding-top: 0px;" onclick="getUniqId('<?php echo $Mdata->TASKID; ?>','<?php echo $tSrno; ?>');"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button><?php } ?></div>

                          <!-- modal -->

                          <div class="modal fade" id="taskStatus<?php echo $tSrno; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                          <div class="modal-dialog" role="document" style="margin-top: 5%;">

                            <div class="modal-content" style="border-radius: 5px;">

                              <div class="modal-header">

                                <div class="row">
                                  <input type="hidden" id="itmOnQp1">
                                  <div class="col-md-12">
                                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Update Task Status</h5>
                                  </div>

                                </div>

                              </div>
                              <form id="update_task_status">
                              <div class="modal-body table-responsive">
                                
                                <div class="box box-primary Custom-Box block_one">
                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label> From User: <span class="required-field"></span></label>

                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <input type="text"  id="fromUserUT" name="fromUserUT" class="form-control  pull-left" value="{{ $Mdata->USER_NAME }}" placeholder="Enter Close Date" readonly>

                                        </div> 

                                      </div>
                                      <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label> Task: <span class="required-field"></span></label>

                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <input type="text"  id="taskUT" name="taskUT" class="form-control  pull-left" value="{{ $Mdata->TASK_NAME }}" placeholder="Enter Task" readonly>

                                        </div> 

                                      </div>
                                      <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label> Target: <span class="required-field"></span></label>
                                        <?php $targetDate    = date("d-m-Y", strtotime($Mdata->TARGET_DATE));  ?>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <input type="text"  id="targetUT" name="targetUT" class="form-control  pull-left" value="{{ $targetDate }}" placeholder="Enter Target" readonly>

                                        </div> 

                                      </div>
                                      <!-- /.form-group -->
                                    </div>

                                  </div>

                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label> Description: <span class="required-field"></span></label>

                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <textarea type="text"  id="taskUT" name="taskUT" class="form-control  pull-left" placeholder="Enter Description" readonly>{{ $Mdata->DESCRIPTION }}</textarea>

                                        </div> 

                                      </div>
                                      <!-- /.form-group -->
                                    </div>
                                  </div>

                                </div>

                                <div class="box box-primary Custom-Box bloc_two">
                                    
                                  <div class="row">
                                    <div class="col-md-12">
                                      <table>
                                        <thead>
                                          <tr>
                                            <td style="font-weight: bold;text-align: center;width: 14%;">Vr Date</td>
                                            <td style="font-weight: bold;text-align: center;">Remark</td>
                                            <td style="font-weight: bold;text-align: center;width: 24%;">Remark By</td>
                                          </tr>
                                        </thead>
                                        <tbody id="allTaskGet<?php echo $tSrno; ?>">
                                          
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>

                                  <div class="row" >
                                  
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <?php $vrDateUP =date("d-m-Y"); ?>
                                        <div class="col-md-6">
                                          <label> Remark: <span class="required-field"></span></label>
                                          <input type="hidden" value="{{$vrDateUP}}" name="vrDateUP">
                                        </div>
                                        <div class="col-md-6" style="text-align: end;">
                                            <label>Vr Date: <?php echo $vrDateUP; ?></label>
                                        </div>
                                        <?php $vrDateUP =date("d-m-Y"); ?>
                                        <div class="input-group">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <textarea type="text" id="remarkUP" name="remarkUP" class="form-control  pull-left" value="" placeholder="Enter Remark" ></textarea>
                                        </div> 
                                      </div>
                                    </div>
                                  </div>

                                </div>

                                <div class="box box-primary Custom-Box block_three">
                                  <div class="row">  

                                    <div class="col-md-8">
                                      <div class="form-group">
                                        <label> Close Remark: <span class="required-field"></span></label>

                                        <div class="input-group">

                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <input type="text"  id="close_remark<?php echo $tSrno; ?>" name="close_remark" class="form-control  pull-left" value="" placeholder="Enter Remark" oninput="addCloseDate('<?php echo $tSrno; ?>')">

                                        </div> 

                                        <small id="emailHelp" class="form-text text-muted">

                                          {!! $errors->first('close_remark', '<p class="help-block" style="color:red;">:message</p>') !!}

                                        </small>
                                        <small>
                                          <div class="pull-left showSeletedName" id="makeText"></div>
                                        </small>

                                      </div>
                                      <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label> Close Date: <span class="required-field"></span></label>
                                        <?php $closeDate =date("d-m-Y"); ?>
                                        <div class="input-group">
                                          <input type="hidden" id="taskId<?php echo $tSrno; ?>" value="" name="uniqTaskId">
                                          <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                          <input type="text"  id="closeDate<?php echo $tSrno; ?>" name="closeDate" class="form-control  pull-left" value="" placeholder="Enter Close Date" readonly>

                                        </div> 

                                        <small id="emailHelp" class="form-text text-muted">

                                          {!! $errors->first('closeDate', '<p class="help-block" style="color:red;">:message</p>') !!}

                                        </small>
                                        <small>
                                          <div class="pull-left showSeletedName" id="makeText"></div>
                                        </small>

                                      </div>
                                      <!-- /.form-group -->
                                    </div>
                                  </div>
                                </div>

                            </div>
                          </form>

                              <div class="modal-footer" style="text-align: center;">
                               
                                <button type="button" class="btn btn-primary" onclick="updataskSatus('<?php echo $tSrno; ?>');">

                                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Save
                                   </button>
                                   <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Cancle</button>
                              
                              </div>
                              
                            </div>

                          </div>

                        </div>

                          <!-- modal -->


                        </td>

                       
                      </tr>
                    <?php $tSrno++;} ?>
                  </table>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                  <table class="table-border">

                      <tr>
                        <th>From User</th>
                        <th>To User</th>
                        <th>Task Name</th>
                        <th>Target Date</th>
                        <th>Description</th>
                        <th>Action</th>
                      </tr>

                    <?php $srnum=1; foreach ($taskData as $taskT) { ?>
                      <tr>
                        <td>{{$taskT->USER_NAME}}</td>
                        <td>{{$taskT->TO_USER_NAME}}</td>
                        <td>{{$taskT->TASK_NAME}}</td>
                        <td>{{$taskT->TARGET_DATE}}</td>
                        <td>{{$taskT->DESCRIPTION}}</td>
                        <td>
                        <div style="display: inline-flex;">

                        <?php if($taskT->STATUS =='0'){ ?>

                          <button type="button" class="btn btn-danger btn-xs" id="openTask<?php echo $srnum; ?>" data-toggle="modal" data-target="#open_task<?php echo $srnum; ?>" style="padding-bottom: 0px;padding-top: 0px;" onclick="getUniqId('<?php echo $taskT->TASKID; ?>','<?php echo $srnum; ?>');">Open</button>
                          <div class="modal fade" id="open_task<?php echo $srnum; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document" style="margin-top: 5%;">
                                <div class="modal-content" style="border-radius: 5px;">
                                  <div class="modal-header">
                                    <div class="row">
                                      <input type="hidden" id="itmOnQp1">
                                      <div class="col-md-12">
                                        <h5 class="modal-title modltitletext" id="exampleModalLabel">Close Task</h5>
                                      </div>
                                    </div>
                                  </div>
                                    <form id="opentasktrans">
                                      <div class="modal-body table-responsive">
                                          <div class="box box-primary Custom-Box block_one">
                                            <div class="row">  
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                  <label> To User: <span class="required-field"></span></label>
                                                  <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                    <input type="text" class="form-control  pull-left" value="{{ $taskT->TO_USER_NAME }}" placeholder="Enter Close Date" readonly>

                                                  </div> 
                                                </div>
                                              </div>

                                              <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> Task: <span class="required-field"></span></label>
                                                    <div class="input-group">
                                                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                      <input type="text" class="form-control  pull-left" value="{{ $taskT->TASK_NAME }}" placeholder="Enter Task" readonly>
                                                    </div> 
                                                </div>
                                              </div>
                                              <div class="col-md-4">
                                                <div class="form-group">
                                                    <label> Target: <span class="required-field"></span></label>
                                                    <?php $targetDate    = date("d-m-Y", strtotime($taskT->TARGET_DATE));  ?>
                                                  <div class="input-group">
                                                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                      <input type="text" class="form-control  pull-left" value="{{ $targetDate }}" placeholder="Enter Target" readonly>
                                                  </div> 
                                                </div>
                                              </div>
                                            </div>

                                            <div class="row">
                                              <div class="col-md-12">
                                                <div class="form-group">
                                                  <label> Description: <span class="required-field"></span></label>
                                                  <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                    <textarea type="text" class="form-control  pull-left" placeholder="Enter Description" readonly>{{ $taskT->DESCRIPTION }}</textarea>
                                                  </div> 
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="box box-primary Custom-Box bloc_two">
                                            <div class="row">
                                              <div class="col-md-12">
                                                <table>
                                                  <thead>
                                                    <tr>
                                                      <td style="font-weight: bold;text-align: center;width: 14%;">Vr Date</td>
                                                      <td style="font-weight: bold;text-align: center;">Remark</td>
                                                      <td style="font-weight: bold;text-align: center;width: 24%;">Remark By</td>
                                                    </tr>
                                                  </thead>
                                                  <tbody id="allOpenTask<?php echo $srnum; ?>">
                                                    
                                                  </tbody>
                                                </table>
                                              </div>
                                            </div>

                                            <div class="row" >
                                                <div class="col-md-4">
                                                  <div class="form-group">
                                                    <label> Vr Date: <span class="required-field"></span></label>
                                                    <?php $vrDateUP =date("d-m-Y"); ?>
                                                    <div class="input-group">
                                                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                      <input type="hidden" name="tranTaskId" value="{{$taskT->TASKID}}">
                                                      <input type="text" class="form-control  pull-left" name="openVrDt" value="{{$vrDateUP}}" placeholder="Enter Vr Date" readonly>
                                                    </div> 
                                                  </div>
                                                </div>
                                                <div class="col-md-8">
                                                  <div class="form-group">
                                                    <label> Remark: <span class="required-field"></span></label>
                                                    <?php $vrDateUP =date("d-m-Y"); ?>
                                                    <div class="input-group">
                                                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                                                      <textarea type="text" class="form-control  pull-left" name="openRemark" value="" placeholder="Enter Remark" ></textarea>
                                                    </div> 
                                                  </div>
                                                </div>
                                            </div>
                                          </div>
                                      </div>
                                    </form>
                                    <div class="modal-footer" style="text-align: center;">
                                   
                                      <button type="button" class="btn btn-primary" onclick="saveopenTask('<?php echo $srnum; ?>');">
                                          <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Save
                                        </button>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding-left: 25px;padding-right: 25px;">Cancle</button>
                                    </div>
                                </div>
                            </div>
                          </div>

                        <?php }else if($taskT->STATUS =='1'){?>

                          <button type="button" class="btn btn-warning btn-xs" id="closedTask<?php echo $srnum; ?>" data-toggle="modal" data-target="#closed_status<?php echo $srnum; ?>" style="padding-bottom: 0px;padding-top: 0px;" onclick="getclosedTask('<?php echo $taskT->TASKID; ?>','<?php echo $srnum; ?>');">Complete</button>

                        <?php }else if($taskT->STATUS =='2'){ ?>

                          <button type="button" class="btn btn-success btn-xs" style="padding-bottom: 0px;padding-top: 0px;" >Closed</button>

                        <?php } ?>
                        </div>
                        </td>
                        <div class="modal fade" id="closed_status<?php echo $srnum; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                          <div class="modal-dialog" role="document" style="margin-top: 5%;">

                            <div class="modal-content" style="border-radius: 5px;">

                              <div class="modal-header">

                                <div class="row">
                                  <input type="hidden" id="itmOnQp1">
                                  <div class="col-md-12">
                                    <h5 class="modal-title modltitletext" id="exampleModalLabel">Close Task</h5>
                                  </div>

                                </div>

                              </div>
                              <form id="closedtasktrans">
                                <div class="modal-body table-responsive">
                                
                                  <div class="row">  
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label>  Closed: <span class="required-field"></span></label>

                                        <div class="input-group">
                                          <input type="hidden" name="taskTranId" id="taskTranId<?php echo $srnum; ?>">
                                          <input type="radio" class="optionsRadios1" name="closedTask" value="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                          <input type="radio" class="optionsRadios1" name="closedTask" value="1" checked>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                        </div> 

                                      </div>
                                      <!-- /.form-group -->
                                    </div>

                                    <div class="col-md-6">
                                    </div>

                                  </div>
                                </div>
                              </form>

                              <div class="modal-footer" style="text-align: center;">
                               
                                <button type="button" class="btn btn-primary" onclick="saveClosedTask();">

                                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Save
                                   </button>
                              
                              </div>
                              
                            </div>

                          </div>

                        </div>
                      </tr>
                    <?php $srnum++;} ?>
                  </table>
                
                   <button type="button" class="btn btn-primary btn-xs" id="add_task" data-toggle="modal" data-target="#AddTask" style="padding-bottom: 0px;padding-top: 0px;">Add More</button>

                </div><!-- /.tab-pane -->
              </div><!-- /.tab-content -->
            </div>
          </section>

           <div class="modal fade" id="AddTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">

              <div class="row">
                <input type="hidden" id="itmOnQp1">
                <div class="col-md-12">
                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Assign Task</h5>
                </div>

              </div>

            </div>
            <form id="tasktrans">
            <div class="modal-body table-responsive">
              
              <div class="row">  
                <div class="col-md-6">
                  <div class="form-group">
                    <label> Vr Date: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                      <?php $CurrentDate =date("d-m-Y"); ?>
                      <input type="text"  id="vr_date" name="vr_date" class="form-control  pull-left" value="{{ $CurrentDate }}" placeholder="Enter Vr Date" readonly>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="makeText"></div>
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label> From User Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                      <input type="text"  id="from_user_Code" name="from_user_Code" class="form-control  pull-left" value="{{ Session::get('userid') }}" placeholder="Enter From User Code" readonly>

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('from_user_Code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="makeText"></div>
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

              </div>

              <div class="row">
                
                <div class="col-md-4">
                  <div class="form-group">
                    <label> To User Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                      <input list="userList"  id="to_user_Code" name="to_user_Code" class="form-control  pull-left" value="" placeholder="Enter To User Code">
                      <datalist id="userList">

                        <option  value="">-- Select --</option>
                          @foreach($user_list as $key)

                            <option value='<?php echo $key->USER_CODE?>'   data-xyz ="<?php echo $key->USER_NAME; ?>" ><?php echo $key->USER_NAME ; echo " [".$key->USER_CODE."]" ; ?></option>

                          @endforeach

                      </datalist>
                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('to_user_Code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="toUserName"></div>
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label> Task Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                      <input list="taskList"  id="task_code" name="task_code" class="form-control  pull-left" value="{{ old('task_code') }}" placeholder="Enter Task Code" maxlength="30">

                      <datalist id="taskList">

                        <option  value="">-- Select --</option>
                          @foreach($task_list as $key)

                            <option value='<?php echo $key->TASK_CODE?>'   data-xyz ="<?php echo $key->TASK_NAME; ?>" ><?php echo $key->TASK_NAME ; echo " [".$key->TASK_CODE."]" ; ?></option>

                          @endforeach

                      </datalist>

                    </div> 
                    <input type="hidden" value="" name="taskName" id="taskName">
                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('task_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <small>
                      <div class="pull-left showSeletedName" id="taskText"></div>
                    </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-4">
                <div class="form-group">
                  <label> Target Date: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                    <input type="text"  id="target_date" name="target_date" class="form-control  pull-left transdatepicker" value="{{ old('target_date') }}" placeholder="Enter Target Date">

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('target_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>
                  <small>
                    <div class="pull-left showSeletedName" id="makeText"></div>
                  </small>

                </div>
                <!-- /.form-group -->
              </div>

              </div>

            <div class="row">
              
              <div class="col-md-12">
                <div class="form-group">
                  <label> Description: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-caret-square-o-down"></i></span>
                    <textarea type="text"  id="description" name="description" class="form-control  pull-left" value="{{ old('description') }}" placeholder="Enter Description"></textarea>

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('description', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>
                  <small>
                    <div class="pull-left showSeletedName" id="makeText"></div>
                  </small>

                </div>
                <!-- /.form-group -->
              </div>
            </div>
          </div>
        </form>

            <div class="modal-footer" style="text-align: center;">
             
              <button type="button" class="btn btn-primary" onclick="saveTaskAssign();">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  Save
                 </button>
            
            </div>
            
          </div>

        </div>

      </div>

          </div>



        </section>
       


      
    </div><!-- /.row -->




 <!-- =========== End : demo page ============= -->

@include('admin.include.footer')

<script>
  function clicklink(srno,pagelink){

    window.location.href =pagelink;
  }

  function getUniqId(uniqId,sr_no){
    $('#taskId'+sr_no).val(uniqId);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

              url:"{{ url('fetch-all-task-of-user') }}",
              method : "POST",
              type: "JSON",
              data: {uniqId: uniqId},
              success:function(data){
                  var data1 = JSON.parse(data);
                  if (data1.response == 'error') {
                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                  }else if(data1.response == 'success'){
                    $('#allTaskGet'+sr_no).empty(); 
                    $('#allOpenTask'+sr_no).empty(); 
                    $.each(data1.task_data, function(k, getData) {
                      var dateForm =getData.VRDATE;
                      var slipdate = dateForm.split('-');
                      var taskDate = slipdate[2]+'-'+slipdate[1]+'-'+slipdate[0];
                      var loginUser = $('#LoginUser').val();
                      var taskUser = getData.USER_CODE;
                      if(loginUser == taskUser){
                        var add_Class = '';
                      }else{
                        var add_Class ='color:red';
                      }
                      var tbodyData = '<tr><td><div class="setmargin">'+taskDate+'</div></td><td><div class="setmargin">'+getData.REMARK+'</div></td><td style='+add_Class+'><div class="setmargin">'+getData.USER_NAME+'</div></td></tr>';
                      $('#allTaskGet'+sr_no).append(tbodyData);
                    });

                    $.each(data1.task_data, function(k, getData) {
                      var dateFormopn =getData.VRDATE;
                      var slipdateopn = dateFormopn.split('-');
                      var taskDateopn = slipdateopn[2]+'-'+slipdateopn[1]+'-'+slipdateopn[0];
                      var loginUseropn = $('#LoginUser').val();
                      var taskUseropn = getData.USER_CODE;
                      if(loginUseropn == taskUseropn){
                        var add_Classopn = '';
                      }else{
                        var add_Classopn ='color:red';
                      }

                      var tbodyDataopn = '<tr><td><div class="setmargin">'+taskDateopn+'</div></td><td><div class="setmargin">'+getData.REMARK+'</div></td><td style='+add_Classopn+'><div class="setmargin">'+getData.USER_NAME+'</div></td></tr>';
                      $('#allOpenTask'+sr_no).append(tbodyDataopn);
                    });
                  }
              }
      });

  }

  function OpenAllTaskStatus(taskId,){

  }

  function getclosedTask(taskTrnId,sr_no){
    $('#taskTranId'+sr_no).val(taskTrnId);
  }

  function dleteuserTCode(rowId,srNo){
      console.log(rowId);
      $('#usertcodeDelete'+srNo).modal('show');
     $('#usertcodeId'+srNo).val(rowId);

  }

  function addCloseDate(srnum){
      var getDate   = new Date();
      var get_date  = getDate.getDate();
      var get_month = getDate.getMonth() + 1;
      var get_year  = getDate.getFullYear();
      var closeDate = get_date+'-'+get_month+'-'+get_year;
      
      var closeRemark = $('#close_remark'+srnum).val();
      if(closeRemark){
        $('#closeDate'+srnum).val(closeDate);
      }else{
        $('#closeDate'+srnum).val('');
      }
  }

  function saveTaskAssign(){
    var data = $("#tasktrans").serialize();

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

            type: 'POST',

            url: "{{ url('/assign-task-to-user') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

             // console.log('data',data);
              //  console.log('data',data);
               window.location.href = "{{ url('dashboard') }}";
              },

    });
  }

  function updataskSatus(srNum){
    var data = $("#update_task_status").serialize();

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

            type: 'POST',

            url: "{{ url('/update-task-status-of-user') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

             // console.log('data',data);
              //  console.log('data',data);
               window.location.href = "{{ url('dashboard') }}";

               //$('#AplyIconBT'+srNum).html('<i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 21px;margin-left: 3px;"></i>');
              },

    });
  }

  function saveClosedTask(srNum){
    var data = $("#closedtasktrans").serialize();

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

            type: 'POST',

            url: "{{ url('/save-closed-task-trans') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

             // console.log('data',data);
              //  console.log('data',data);
               window.location.href = "{{ url('dashboard') }}";

               //$('#AplyIconBT'+srNum).html('<i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 21px;margin-left: 3px;"></i>');
              },

    });
  }

  function saveopenTask(srNum){
    var data = $("#opentasktrans").serialize();

    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $.ajax({

            type: 'POST',

            url: "{{ url('/save-reply-of-fromuser-for-touser') }}",

            data: data, // here $(this) refers to the ajax object not form

            success: function (data) {

             // console.log('data',data);
              //  console.log('data',data);
               window.location.href = "{{ url('dashboard') }}";

               //$('#AplyIconBT'+srNum).html('<i class="fa fa-check-circle" aria-hidden="true" style="color: green;font-size: 21px;margin-left: 3px;"></i>');
              },

    });
  }


  $(document).ready(function(){
    $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',

      autoclose: 'true'

    });

    $('#target_date').on('change',function(){
      var targetDate = $('#target_date').val();
      var vr_date = $('#vr_date').val();

      if(targetDate < vr_date){
        $('#target_date').val('');
      }else{
       
      }
     
    });

    $("#task_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#taskList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      if(msg=='No Match'){

         $(this).val('');
         $('#taskText').html('');
         $('#taskName').val('');

      }else{
        $('#taskText').html(msg);
        $('#taskName').val(msg);
      }

    });

    $("#to_user_Code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#userList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      if(msg=='No Match'){

         $(this).val('');
         $('#to_user_Code').val('');
         $('#toUserName').html('');

      }else{
        $('#toUserName').html(msg);
      }

    });
  });
</script> 
@endsection