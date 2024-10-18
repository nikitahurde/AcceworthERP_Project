@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')



<style type="text/css">

  .indicateClass{
    border: 1px solid;
    width: 15px;
    padding: 1px;
    background-color: #eaeff1;
    border-color: #f1c88c;
    margin-right: 3px;
    margin-bottom: 3px;
    line-height: 0px;
}
.circleindicate{
  border: 1px solid;
    width: 3px;
    border-radius: 50px;
    padding: 4px;
    background-color: #e78e0e;
    color: #e78e0e;

}
.indicateAppClass{
    border: 1px solid;
    width: 15px;
    padding: 1px;
    background-color: #eaeff1;
    border-color: #67bfa7;
    margin-right: 3px;
    margin-bottom: 3px;
    line-height: 0px;
}
.circleAppindicate{
  border: 1px solid;
    width: 3px;
    border-radius: 50px;
    padding: 4px;
    background-color: #00a65a;
    color: #00a65a;
}
.indicateRejClass{
    border: 1px solid;
    width: 15px;
    padding: 1px;
    background-color: #eaeff1;
    border-color: #F18C91;
    margin-right: 3px;
    margin-bottom: 3px;
    line-height: 0px;

}
.circleRejindicate{
  border: 1px solid;
    width: 3px;
    border-radius: 50px;
    padding: 4px;
    background-color: #dd4b39;
    color: #dd4b39;
}

  .PageTitle{

    margin-right: 1px !important;

  }

 .required-field::before {

    content: "*";

    color: red;

  }

  .Custom-Box {

    /*border: 1px solid #e0dcdc;

    border-radius: 10px;

*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }
  .showinmobile{
    display: none;
  }
  .glyphicon-minus:before {
    content: "" !important;
}

.glyphicon-plus:before {
    content: "" !important;
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



.panel-group .panel {
        border-radius: 0;
        box-shadow: none;
        border-color: #EEEEEE;
    }

    .panel-default > .panel-heading {
        padding: 0;
        border-radius: 0;
        color: #212121;
        background-color: #FAFAFA;
        border-color: #EEEEEE;
    }

    .panel-title {
        font-size: 14px;
    }

    .panel-title > a {
        display: block;
        padding: 15px;
        text-decoration: none;
    }

    .more-less {
        float: right;
        color: #fff;
        margin-top:-8px;
    }

    .panel-default > .panel-heading + .panel-collapse > .panel-body {
        border-top-color: #EEEEEE;
    }

/* ----- v CAN BE DELETED v ----- */
body {
 /*   background-color: #26a69a;*/
    background-color: #222d32;
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

</style>



<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">
            
          <h1>

           Pending For Approval

            <small>Approval Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Approval Details</a></li>

          <!--   <li class="active"><a href="{{ url('/form-mast-um') }}">Master Um</a></li>

            <li class="active"><a href="{{ url('/form-mast-um') }}">Add Mast Um</a></li> -->

          </ol>

        </section>

  <section class="content">

    <div class="row">

     <!--  <div class="col-sm-1"></div> -->

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <div class="row">
                  <div class="col-md-4">
                    <div class="indicateClass">
                    
                      <div class="circleindicate"><div style="margin-left: 20px;margin-bottom: 2px;font-size: small;font-weight: bold;white-space: nowrap;color: #444;">Pending Order</div> </div>
                       
                    </div>
                    <div class="indicateAppClass">
                      <div class="circleAppindicate"><div style="margin-left: 20px;margin-bottom: 2px;font-size: small;font-weight: bold;white-space: nowrap;color: #444;">Success Order</div></div>
                      
                    </div>
                    <div class="indicateRejClass">
                      <div class="circleRejindicate"><div style="margin-left: 20px;margin-bottom: 2px;font-size: small;font-weight: bold;white-space: nowrap;color: #444;">Rejected Order</div></div>
                      
                    </div>
                  </div>
                  <div class="col-md-4">
                    <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;margin-top: 16px;">Pending For Approval </h2>
                  </div>
                  <div class="col-md-4">
                      <!-- <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                      </div> -->
                  </div>
              </div>

               
              
                
             <!--  <div class="box-tools pull-right showinmobile">

                <a href="{{ url('/view-mast-um') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Um</a>

              </div> -->
              

              

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

          <div class="">

    
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

      <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <!-- <i class="more-less glyphicon glyphicon-plus"></i> -->
                        <button class="more-less btn btn-primary btn-sm">View/Approve</button>

                        <div class="row">
                        <div class="col-md-4">
                        <b>Purchase Indent</b>&nbsp;
                        </div>

                        <div class="col-md-4" style="margin-left: -100px;">
                       <span class="label label-warning" title="Pending Order">{{ $indnetcount }}</span>&nbsp;<span class="label label-success" title="Success Order">{{ $indnetapprovecount }}</span>&nbsp;<span class="label label-danger" title="Reject Order">{{ $indnetrejctcount }}</span>
                     </div>

                     </div>
                       <!-- <span class="label label-primary">4</span> -->
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <table id="example12" class="table table-bordered table-striped table-hover">

                    <thead>
                      


                      <tr>

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Tran Code</th>

                        <th class="text-center">Series code</th>

                        <th class="text-center">Vr.No</th>

                        <th class="text-center">Account Code</th>

                        <th class="text-center">Approved By</th>
                        
                        <th class="text-center">Action</th>


                      </tr>

                    </thead>

                    <tbody>

                  <?php  $sr=1; foreach($user_approve_indent as $key) {

                        

                    ?>
                        <tr>
                          <td>{{ $sr++ }}</td>
                          <td>{{ $key->TRAN_CODE}}</td>
                          <td>{{ $key->SERIES_CODE}}</td>
                          <td>{{ $key->VRNO}}</td>
                          <td>{{ $key->VRDATE}}</td>
                          <td>{{ $key->APPROVE_IND}}</td>
                          <input type="hidden" name="approve_ind" id="approve_ind" value="">
                          <td>
                            <center>
                              <?php if($key->APPROVE_STATUS=='1') { ?>
                               <div>

                                <button type="button" onclick="return showindentapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                            </div>
                               <div>
                                <small class="label label-success"><i class="fa fa-check"></i> Approved</small>
                                </div>
                                
                              <?php }  else if($key->REJECTED_STATUS=='1' && $key->APPROVE_STATUS=='2') { ?>
                                <div>

                                <button type="button" onclick="return showindentapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO  ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                              </div>
                                <div>
                                <small class="label label-danger"><i class="fa fa-cross"></i> Rejected</small></div>

                             
                                <?php }  else { ?>

                                      <?php if($key->APPROVE_STATUS=='3' || $key->APPROVE_STATUS=='0') {?>
                                    <div>
                                     <button type="button" onclick="return showindentapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO  ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                                      </button>
                                    </div>

                                      <div>
                                <small class="label label-warning"><i class="fa fa-cross"></i> Pending</small></div>
                                <?php } else { ?>

                                   <button type="button" on class="btn btn-primary btn-sm" disabled=""><i class="fa fa-eye"></i>
                              </button>

                                <?php }}?>
                            </center>
                          </td>
                        
                        
                        </tr>
                  
                    <?php } ?>

                   
                    </tbody>

                    

                  </table>
                </div>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                       <!--  <i class="more-less glyphicon glyphicon-plus"></i> -->
                       <button class="more-less btn btn-primary btn-sm">View/Approve</button>

                       <div class="row">
                        <div class="col-md-4">
                        <b>Purchase Quatation</b>&nbsp;
                        </div>

                        <div class="col-md-4" style="margin-left: -100px;">
                          <span class="label label-warning" title="Pending Order">{{ $quatationcount }}</span>&nbsp;<span class="label label-success" title="Success Order">{{ $qutationapprovecount }}</span>&nbsp;<span class="label label-danger" title="Reject Order">{{ $qutationrejctcount }}</span>
                        </div>
                      </div>
                      <!-- <span class="label label-primary">4</span> -->
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                   <table id="example12" class="table table-bordered table-striped table-hover">

                    <thead>
                      


                      <tr>

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Tran Code</th>

                        <th class="text-center">Series code</th>

                        <th class="text-center">Vr.No</th>

                        <th class="text-center">Account Code</th>

                        <th class="text-center">Approved By</th>
                        
                        <th class="text-center">Action</th>


                      </tr>

                    </thead>

                    <tbody>
                  <?php $sr=1; foreach($user_approve_qutation as $key) {?>
                        <tr>
                          <td>{{ $sr++ }}</td>
                          <td>{{ $key->TRAN_CODE}}</td>
                          <td>{{ $key->SERIES_CODE}}</td>
                          <td>{{ $key->VRNO}}</td>
                          <td>{{ $key->VRDATE}}</td>
                          <td>{{ $key->APPROVE_IND}}</td>
                          <input type="hidden" name="approve_ind" id="approve_ind" value="">
                          <td>
                            <center>
                              <?php if($key->APPROVE_STATUS=='1') { ?>
                              
                                <div>
                                  <button type="button" onclick="return showqutationapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                                  </button>
                                </div>
                                <div>
                                   <small class="label label-success"><i class="fa fa-check"></i> Approved</small>
                                </div>
                                
                              <?php }  else if($key->REJECTED_STATUS=='1' && $key->APPROVE_STATUS=='2') { ?>

                                <div>
                                  <button type="button" onclick="return showqutationapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                                   </button>
                                </div>
                                <div>
                                 <small class="label label-danger"><i class="fa fa-cross"></i> Rejected</small>

                                </div>

                                
                             
                                <?php }  else { ?>

                                      <?php if($key->APPROVE_STATUS=='3') {?>
                                     <button type="button" onclick="return showqutationapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                                <div>
                                 <small class="label label-warning"><i class="fa fa-cross"></i> Pending</small>

                                </div>
                                <?php } else { ?>

                                   <button type="button" on class="btn btn-primary btn-sm" disabled=""><i class="fa fa-eye"></i>
                              </button>

                                <?php }}?>
                            </center>
                          </td>
                        
                        
                        </tr>
                  
                    <?php } ?>
                    </tbody>

                    

                  </table>
                </div>
            </div>


        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                       <!--  <i class="more-less glyphicon glyphicon-plus"></i> -->
                        <button class="more-less btn btn-primary btn-sm">View/Approve</button>
                       <div class="row">
                        <div class="col-md-4">
                        <b>Purchase Contract</b>&nbsp;
                        </div>
                        <div class="col-md-4" style="margin-left: -100px">
                        <span class="label label-warning" title="Pending Order">{{ $contractcount }}</span>&nbsp;<span class="label label-success" title="Pending Order">{{ $contractapprovecount }}</span>&nbsp;<span class="label label-danger" title="Pending Order">{{ $contractrejctcount }}</span>
                        </div>
                        
                        </div>
                        <!-- <span class="label label-primary">4</span> -->
                    </a>
                </h4>
            </div>
            <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                   <table id="example12" class="table table-bordered table-striped table-hover">

                    <thead>
                      


                      <tr>

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Tran Code</th>

                        <th class="text-center">Series code</th>

                        <th class="text-center">Vr.No</th>

                        <th class="text-center">Account Code</th>

                        <th class="text-center">Approved By</th>
                        
                        <th class="text-center">Action</th>


                      </tr>

                    </thead>

                    <tbody>
                  <?php $sr=1; foreach($user_approve_contract as $key) {?>
                        <tr>
                          <td>{{ $sr++ }}</td>
                          <td>{{ $key->TRAN_CODE}}</td>
                          <td>{{ $key->SERIES_CODE}}</td>
                          <td>{{ $key->VRNO}}</td>
                          <td>{{ $key->VRDATE}}</td>
                          <td>{{ $key->APPROVE_IND}}</td>
                          <input type="hidden" name="approve_ind" id="approve_ind" value="">
                          <td>
                            <center>
                              <?php if($key->APPROVE_STATUS=='1') { ?>
                              <div>
                                <button type="button" onclick="return showcontractapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                              </div>
                              <div>
                                <small class="label label-success"><i class="fa fa-check"></i> Approved</small>
                              </div>
                              <?php }  else if($key->REJECTED_STATUS=='1' && $key->APPROVE_STATUS=='2') { ?>

                                <div>
                                   <button type="button" onclick="return showcontractapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                                   </button>
                                </div>
                                <div>
                                   <small class="label label-danger"><i class="fa fa-cross"></i> Rejected</small>
                                </div>
                                <?php }  else { ?>

                                      <?php if($key->APPROVE_STATUS=='3') {?>
                                     <button type="button" onclick="return showcontractapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                              <div>
                                   <small class="label label-warning"><i class="fa fa-cross"></i> Pending</small>
                                </div>
                                <?php } else { ?>

                                   <button type="button" on class="btn btn-primary btn-xs" disabled=""><i class="fa fa-eye"></i>
                              </button>

                                <?php }}?>
                            </center>
                          </td>
                        
                        
                        </tr>
                  
                    <?php } ?>
                    </tbody>

                    

                  </table>
                </div>
            </div>

            
        </div>

         <!-- START - PURCHASE ORDER -->

         <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <!-- <i class="more-less glyphicon glyphicon-plus"></i> -->

                      
                  <button class="more-less btn btn-primary btn-sm">View/Approve</button>
                      <div class="row">
                        <div class="col-md-4">
                        <b>Purchase Order</b> &nbsp;
                        </div>
                        <div class="col-md-4" style="margin-left: -100px;">
                        <span class="label label-warning" title="Pending Order">{{ $approvalcount }}</span>&nbsp;<span class="label label-success" title="Success Order">{{ $orderapprovecount }}</span>&nbsp;<span class="label label-danger" title="Reject Order">{{ $orderrejctcount }}</span> 
                      </div>
                    </div>
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                        <table id="example12" class="table table-bordered table-striped table-hover">

                    <thead>

                      <tr>

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Tran Code</th>

                        <th class="text-center">Series code</th>

                        <th class="text-center">Vr.No</th>

                        <th class="text-center">Account Code</th>

                        <th class="text-center">Approved By</th>
                        
                        <th class="text-center">Action</th>


                      </tr>

                    </thead>

                    <tbody>
                  <?php $sr=1; foreach($user_approve_data as $key) {?>
                        <tr>
                          <td>{{ $sr++ }}</td>
                          <td>{{ $key->TRAN_CODE}}</td>
                          <td>{{ $key->SERIES_CODE}}</td>
                          <td>{{ $key->VRNO}}</td>
                          <td>{{ $key->VRDATE}}</td>
                          <td>{{ $key->APPROVE_IND}}</td>

                           <input type="hidden" name="approve_ind" id="approve_ind" value="">
                          <td>
                            <center>
                              <?php if($key->APPROVE_STATUS=='1') { ?>
                              
                                <small class="label label-success"><i class="fa fa-check"></i> Approved</small>

                                <button type="button" onclick="return showorderapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>

                              <?php }  else if($key->REJECTED_STATUS=='1' && $key->APPROVE_STATUS=='2') { ?>

                                 <small class="label label-danger"><i class="fa fa-cross"></i> Rejected</small>
                                 <button type="button" onclick="return showorderapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>

                              <?php } else { ?>
                                <?php if($key->APPROVE_STATUS=='3') {?>
                                     <button type="button" onclick="return showorderapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>
                                     </button>
                              <div>
                                   <small class="label label-warning"><i class="fa fa-cross"></i> Pending</small>
                                </div>
                            
                                <?php }  else { ?>
                                  <button type="button" on class="btn btn-primary btn-xs" disabled=""><i class="fa fa-eye"></i>
                              </button>

                            <?php } } ?>
                            </center>
                          </td>
                        
                        
                        </tr>
                  
                    <?php } ?>
                    </tbody>

                    

                  </table>
                </div>
            </div>
        </div>


         <!-- END - PURCHASE ORDER -->

     <!--     START - PURCHASE BILL -->

     <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                        <!-- <i class="more-less glyphicon glyphicon-plus"></i> -->

                      
                  <button class="more-less btn btn-primary btn-sm">View/Approve</button>
                      <div class="row">
                        <div class="col-md-4">
                        <b>Purchase Bill</b> &nbsp;
                        </div>
                        <div class="col-md-4" style="margin-left: -100px;">
                        <span class="label label-warning" title="Pending Order">{{ $pendingbillcount }}</span>&nbsp;<span class="label label-success" title="Success Order">{{ $billapprovecount }}</span>&nbsp;<span class="label label-danger" title="Reject Order">{{ $billrejctcount }}</span> 
                      </div>
                    </div>
                    </a>
                </h4>
            </div>
            <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                        <table id="example12" class="table table-bordered table-striped table-hover">

                    <thead>

                      <tr>

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Tran Code</th>

                        <th class="text-center">Series code</th>

                        <th class="text-center">Vr.No</th>

                        <th class="text-center">Account Code</th>

                        <th class="text-center">Approved By</th>
                        
                        <th class="text-center">Action</th>


                      </tr>

                    </thead>

                    <tbody>
                  <?php $sr=1; foreach($user_approve_bill as $key) {?>
                        <tr>
                          <td>{{ $sr++ }}</td>
                          <td>{{ $key->TRAN_CODE}}</td>
                          <td>{{ $key->SERIES_CODE}}</td>
                          <td>{{ $key->VRNO}}</td>
                          <td>{{ $key->VRDATE}}</td>
                          <td>{{ $key->APPROVE_IND}}</td>

                           <input type="hidden" name="approve_ind" id="approve_ind" value="">
                          <td>
                            <center>
                              <?php if($key->APPROVE_STATUS=='1') { ?>
                              
                                <small class="label label-success"><i class="fa fa-check"></i> Approved</small>

                                <button type="button" onclick="return showbillapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>

                              <?php }  else if($key->REJECTED_STATUS=='1' && $key->APPROVE_STATUS=='2') { ?>

                                 <small class="label label-danger"><i class="fa fa-cross"></i> Rejected</small>
                                 <button type="button" onclick="return showbillapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>

                              <?php } else { ?>
                                <?php if($key->APPROVE_STATUS=='3') {?>
                                     <button type="button" onclick="return showbillapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i>
                                     </button>
                              <div>
                                   <small class="label label-warning"><i class="fa fa-cross"></i> Pending</small>
                                </div>
                            
                                <?php }  else { ?>
                                  <button type="button" on class="btn btn-primary btn-xs" disabled=""><i class="fa fa-eye"></i>
                              </button>

                            <?php } } ?>
                            </center>
                          </td>
                        
                        
                        </tr>
                  
                    <?php } ?>
                    </tbody>

                    

                  </table>
                </div>
            </div>
        </div>

     <!--     START - PURCHASE BILL -->


       <!--  STORE REQUISTION -->

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                       <!--  <i class="more-less glyphicon glyphicon-plus"></i> -->
                       <button class="more-less btn btn-primary btn-sm">View/Approve</button>

                      <div class="row">
                        <div class="col-md-4">
                            <b>Store Requistion</b>&nbsp;
                        </div>

                        <div class="col-md-4" style="margin-left: -100px;">
                         <span class="label label-warning" title="Pending Order">{{ $requistioncount }}</span>&nbsp;<span class="label label-success" title="Pending Order">{{ $requistionapprovecount }}</span>&nbsp;<span class="label label-danger" title="Pending Order">{{ $requistionrejctcount }}</span>
                       </div>
                     </div>
                        <!-- <span class="label label-primary">4</span> -->
                    </a>
                </h4>
            </div>
            <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                   <table id="example12" class="table table-bordered table-striped table-hover">

                    <thead>
                      


                      <tr>

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Tran Code</th>

                        <th class="text-center">Series code</th>

                        <th class="text-center">Vr.No</th>

                        <th class="text-center">Account Code</th>

                        <th class="text-center">Approved By</th>
                        
                        <th class="text-center">Action</th>


                      </tr>

                    </thead>

                    <tbody>
                  <?php $sr=1; foreach($user_approve_requistion as $key) {?>
                        <tr>
                          <td>{{ $sr++ }}</td>
                          <td>{{ $key->TRAN_CODE }}</td>
                          <td>{{ $key->SERIES_CODE}}</td>
                          <td>{{ $key->VRNO }}</td>
                          <td>{{ $key->VRDATE}}</td>
                          <td>{{ $key->APPROVE_IND}}</td>
                          <input type="hidden" name="approve_ind" id="approve_ind" value="">
                          <td>
                            <center>
                              <?php if($key->APPROVE_STATUS=='1') { ?>
                              <div>
                                <button type="button" onclick="return showstorereqapproval('<?= $key->TRAN_CODE  ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                              </div>
                              <div>
                                <small class="label label-success"><i class="fa fa-check"></i> Approved</small>
                              </div>
                              <?php }  else if($key->REJECTED_STATUS=='1' && $key->APPROVE_STATUS=='2') { ?>

                                <div>
                                   <button type="button" onclick="return showstorereqapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                                   </button>
                                </div>
                                <div>
                                   <small class="label label-danger"><i class="fa fa-cross"></i> Rejected</small>
                                </div>
                                <?php }  else { ?>

                                      <?php if($key->APPROVE_STATUS=='3') {?>
                                <div>
                                    <button type="button" onclick="return showstorereqapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                                   </button>
                                </div>
                                <div>
                                   <small class="label label-warning"><i class="fa fa-cross"></i>Pending</small>
                                </div>
                                <?php } else { ?>

                                   <button type="button" on class="btn btn-primary btn-xs" disabled=""><i class="fa fa-eye"></i>
                                 </button>

                                <?php }}?>
                            </center>
                          </td>
                        
                        
                        </tr>
                  
                    <?php } ?>
                    </tbody>

                    

                  </table>
                </div>
            </div>

            
        </div>
       <!--  STORE REQUISTION -->

       <!-- SALE ORDER -->

       <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                       <!--  <i class="more-less glyphicon glyphicon-plus"></i> -->
                       <button class="more-less btn btn-primary btn-sm">View/Approve</button>

                    <div class="row">
                         
                      <div class="col-md-4">
                        <b>Sales Order</b>&nbsp;

                       </div> 

                       <div class="col-md-4" style="margin-left: -100px;">

                        <span class="label label-warning" title="Pending Order">{{ $saleordercount }}</span>&nbsp;<span class="label label-success" title="Pending Order">{{ $saleorderapprovecount }}</span>&nbsp;<span class="label label-danger" title="Pending Order">{{ $saleorderrejectcount }}</span>
                         
                      </div>

                    </div>
                        <!-- <span class="label label-primary">4</span> -->
                    </a>
                </h4>
            </div>
            <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                   <table id="example12" class="table table-bordered table-striped table-hover">

                    <thead>
                      

                      <tr>

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Tran Code</th>

                        <th class="text-center">Series code</th>

                        <th class="text-center">Vr.No</th>

                        <th class="text-center">Account Code</th>

                        <th class="text-center">Approved By</th>
                        
                        <th class="text-center">Action</th>


                      </tr>

                    </thead>

                    <tbody>
                  <?php $sr=1; foreach($user_approve_saleorder as $key) {?>
                        <tr>
                          <td>{{ $sr++ }}</td>
                          <td>{{ $key->TRAN_CODE }}</td>
                          <td>{{ $key->SERIES_CODE }}</td>
                          <td>{{ $key->VRNO}}</td>
                          <td>{{ $key->VRDATE}}</td>
                          <td>{{ $key->APPROVE_IND}}</td>
                          <input type="hidden" name="approve_ind" id="approve_ind" value="">
                          <td>
                            <center>
                              <?php if($key->APPROVE_STATUS=='1') { ?>
                              <div>
                                <button type="button" onclick="return showtaskrow('<?= $key->TRAN_CODE  ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                              </div>
                              <div>
                                <small class="label label-success"><i class="fa fa-check"></i> Approved</small>
                              </div>
                              <?php }  else if($key->REJECTED_STATUS=='1' && $key->APPROVE_STATUS=='2') { ?>

                                <div>
                                   <button type="button" onclick="return showtaskrow('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                                   </button>
                                </div>
                                <div>
                                   <small class="label label-danger"><i class="fa fa-cross"></i> Rejected</small>
                                </div>
                                <?php }  else { ?>

                                      <?php if($key->approve_status=='3') {?>
                                     <button type="button" onclick="return showtaskrow('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                                <?php } else { ?>

                                   <button type="button" on class="btn btn-primary btn-xs" disabled=""><i class="fa fa-eye"></i>
                              </button>

                                <?php }}?>
                            </center>
                          </td>
                        
                        
                        </tr>
                  
                    <?php } ?>
                    </tbody>

                    

                  </table>
                </div>
            </div>

            
        </div>



       <!-- SALE ORDER -->

       <!-- Start Emp Task List -->

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                       <!--  <i class="more-less glyphicon glyphicon-plus"></i> -->
                       <button class="more-less btn btn-primary btn-sm">View/Approve</button>

                    <div class="row">
                         
                      <div class="col-md-4">
                        <b>Task List</b>&nbsp;

                       </div> 

                       <div class="col-md-4" style="margin-left: -100px;">

                        <span class="label label-warning" title="Pending Status">{{ $taskcount }}</span>&nbsp;<span class="label label-success" title="Pending Order">{{ $taskApprovecount }}</span>&nbsp;<span class="label label-danger" title="Pending Order">{{ $taskRejectCount }}</span>
                         
                      </div>

                    </div>
                        <!-- <span class="label label-primary">4</span> -->
                    </a>
                </h4>
            </div>
            <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                <div class="panel-body">
                   <table id="example12" class="table table-bordered table-striped table-hover">

                    <thead>
                      

                      <tr>

                        <th class="text-center">Sr.NO</th>

                        <th class="text-center">Tran Code</th>

                        <th class="text-center">Series code</th>

                        <th class="text-center">Emp Name</th>
                        
                        <th class="text-center">Function</th>

                        <th class="text-center">Task</th>
                        
                        <th class="text-center">Weightage</th>
                        
                        <th class="text-center">Score</th>

                        <th class="text-center">Action</th>


                      </tr>

                    </thead>

                    <tbody>
                  <?php $sr=1; foreach($task_approve_requistion as $key) {?>
                        <tr>
                          <?php $fisyr = $key->FY_CODE; 
                            $FY =  explode('-', $fisyr);
                            $strFy = $FY[0];
                           ?>
                          <td>{{ $sr++ }}</td>
                          <td>{{ $key->TRAN_CODE }}</td>
                          <td>{{$strFy}} {{ $key->SERIES_CODE }} {{$key->VRNO}}</td>
                          <td>{{$key->emp_name}} [ {{$key->emp_code}} ]</td>
                          <td>{{ $key->userFun}}</td>
                          <td>{{ $key->userTask}}</td>
                          <td class="text-right">{{ $key->weightage}}</td>
                          <td class="text-right">{{ $key->funScore}}</td>
                          <input type="hidden" name="approve_ind" id="approve_ind" value="">
                          <td>
                            <center>
                              <?php if($key->APPROVE_STATUS=='1') { ?>
                              <div>
                                <button type="button" disabled class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                              </div>
                              <div>
                                <small class="label label-success"><i class="fa fa-check"></i> Submitted</small>
                              </div>
                              <?php }  else if($key->selfscore == '0') { ?>

                              <div>
                                <button type="button" disabled class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                                </button>
                              </div>

                              <?php }  else { ?>
                              
                              <?php if($key->APPROVE_STATUS=='3' ) {?>
                                     <button type="button" onclick="return showtaskapproval('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $strFy ?>','<?= $key->VRNO ?>','<?= $key->userFun ?>','<?= $key->userTask ?>','<?= $key->weightage?>','<?= $key->SLNO ?>','<?= $key->APPROVE_IND  ?>','<?= $key->ScoreCardId ?>', '<?= $key->taskSrno ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                                <?php } } ?>

                            </center>
                          </td>
                        
                        
                        </tr>
                  
                    <?php } ?>
                    </tbody>

                    

                  </table>
                </div>
            </div>

            
        </div>
       <!-- End Emp Task List -->

       <!-- START EMP PAYMENT ADVICE -->
        
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                       <!--  <i class="more-less glyphicon glyphicon-plus"></i> -->
                       <button class="more-less btn btn-primary btn-sm">View/Approve</button>

                    <div class="row">
                         
                      <div class="col-md-4">
                        <b>Emp Payment Advice</b>&nbsp;

                       </div> 

                       <div class="col-md-4" style="margin-left: -100px;">

                        <span class="label label-warning" title="Pending Status">{{ $countPAdvice }}</span>&nbsp;<span class="label label-success" title="Payment Approve">{{ $pApprovecount }}</span>&nbsp;<span class="label label-danger" title="Payment Reject">{{ $adviceRejectCount }}</span>
                         
                      </div>

                    </div>
                        <!-- <span class="label label-primary">4</span> -->
                    </a>
                </h4>
            </div>
            <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                <div class="panel-body">
                   <table id="example12" class="table table-bordered table-striped table-hover">

                    <thead>
                      

                      <tr>

                        <th class="text-center">Sr.No</th>

                        <th class="text-center">Tran Code</th>

                        <th class="text-center">Series Code</th>
                        
                        <th class="text-center">Month Yr</th>

                        <th class="text-center">Acc Name</th>
                        
                        <th class="text-center">Payment Type</th>

                        <th class="text-center">Amount</th>
                        
                        <th class="text-center">Tenure</th>
                        
                        <th class="text-center">Action</th>


                      </tr>

                    </thead>

                    <tbody>
                  <?php $sr=1; foreach($payment_approve_requistion as $key) {?>
                        <tr>
                          <?php $fisyr = $key->FY_CODE; 
                            $FY =  explode('-', $fisyr);
                            $strFy = $FY[0];
                           ?>
                          <td>{{ $sr++ }}</td>
                          <td>{{ $key->TRAN_CODE }}</td>
                          <td>{{$strFy}} {{ $key->SERIES_CODE }} {{$key->VRNO}} </td>
                          <td>{{$key->MONTH_YR}} </td>
                          <td>{{$key->ACC_NAME}} [ {{$key->ACC_CODE}} ]</td>

                          <td>{{ $key->PAYMENT_TYPE}}</td>

                          <td>{{ $key->DR_AMT}}</td>
                          <td class="text-right">{{ $key->TENURE}}</td>
                          <input type="hidden" name="approve_ind" id="approve_ind" value="">
                          <td>
                            <center>
                              <?php if($key->APPROVE_STATUS=='1') { ?>
                              <div>
                                <button type="button" disabled class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                              </div>
                              <div>
                                <small class="label label-success"><i class="fa fa-check"></i> Submitted</small>
                              </div>
                              <?php } else if($key->APPROVE_STATUS=='0'){ ?>
                              
                                 <button type="button" disabled class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                                 </button>

                              <?php }else if($key->APPROVE_STATUS=='2'){ ?>

                                  <button type="button" disabled class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                                  </button><br>

                                   <small class="label label-danger"><i class="fa fa-close"></i> Rejected</small>
             
                               <?php } else { ?>
                              
                              <?php if($key->APPROVE_STATUS=='3' ) {?>
                                     <button type="button" onclick="return showpaymetapprove('<?= $key->TRAN_CODE ?>','<?= $key->SERIES_CODE ?>','<?= $strFy ?>','<?= $key->VRNO ?>','<?= $key->SLNO ?>','<?= $key->MONTH_YR ?>','<?= $key->APPROVE_IND  ?>','<?= $key->ACC_NAME  ?>','<?= $key->ACC_CODE  ?>','<?= $key->PAYMENT_TYPE  ?>','<?= $key->DR_AMT  ?>','<?= $key->ADVICEHEADID  ?>','<?= $key->APPROVE_USER  ?>')" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i>
                              </button>
                                <?php } } ?>

                            </center>
                          </td>
                        
                        
                        </tr>
                  
                    <?php } ?>
                    </tbody>

                    

                  </table>
                </div>
            </div>

            
        </div>

       <!-- END EMP PAYMENT ADVICE -->

    </div><!-- panel-group -->
    
    
</div><!-- container -->

          </div><!-- /.box-body -->

           

          </div>

      </div>

      <!-- <div class="col-sm-3 hideinmobile">

        <div class="box-tools pull-right">

          <a href="{{ url('/view-mast-um') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Um</a>

        </div>

      </div> -->



    </div>

     

  </section>

</div>

<div class="modal fade" id="showtaskList" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <center><h3 class="modal-title" id="exampleModalLabel" style="font-size: 17px;color: #3c8dbc;">Score Card for Function Head</h3></center>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <form action="{{ url('Add-Score-Function-Head') }}" method="post">

      @csrf

      <div class="modal-body">

          <div class="box-body">

            <div class="table-responsive" style="border-top: 1px solid !important;"> 
                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th>Tran Code</th>
                    
                    <th>Series Code</th>

                    <th style="width:200px;">Function</th>

                    <th style="width:200px;">Task</th>

                    <th>Weightage</th>

                    <th>Score</th>

                  </tr>

                  <tbody id="scoredata">
                     
                  </tbody>
                  
                </table>

              </div><!-- /div -->

              <div class="row" style="display: flex;">
                 
                  <div class="col-md-6"> 
                    <div class="form-group">
                    
                    <textarea type="text" name="remark" cols="10" rows="3" id="functionHead_remark" class="form-control" placeholder="Enter Remark" id="" style="margin: 0px 152px 0px 0px; width: 257px; height: 76px;"></textarea>
                    <small id="msg"></small>
                   
                    </div>

                  </div>

              </div>

      <br>
      <!-- model -->

      
      <!-- model -->

        <div class="row">
          
          <button type="submit" class="btn btn-sm btn-primary" style="margin-left: 10px;" disabled id="funHeadScore">Submit</button>
          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>

        </div>
      </div>

    </form>

  </div><!-- /.box-body -->
         
</div>



      <div class="modal-footer">


      </div>

       </form>



    </div>



  </div>



</div>

<div class="modal fade" id="paymentAdviceApprove" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <center><h3 class="modal-title" id="exampleModalLabel" style="font-size: 17px;color: #3c8dbc;">Payment Advice Head</h3></center>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <form action="{{ url('Add-payment-advice-Head') }}" method="post">

      @csrf

      <div class="modal-body">

          <div class="box-body">

            <div class="table-responsive" style="border-top: 1px solid !important;"> 
                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th>Tran Code</th>
                    
                    <th>Series Code</th>

                    <th style="width:200px;">Month Year</th>

                    <th style="width:200px;">Acc Name</th>

                    <th>Payment Type</th>

                    <th>Amount</th>

                  </tr>

                  <tbody id="paymentData">
                     
                  </tbody>
                  
                </table>

              </div><!-- /div -->

              <div class="row" style="display: flex;">
                 
                  <div class="col-md-6"> 
                    <div class="form-group">
                    
                    <textarea type="text" name="remark" cols="10" rows="3" id="remark" class="form-control" placeholder="Enter Remark" id="" style="margin: 0px 152px 0px 0px; width: 257px; height: 76px;"></textarea>
                    <small id="paymentRemark"></small>
                   
                    </div>

                  </div>

              </div>


      <br>
      <!-- model -->

      
      <!-- model -->

        <div class="row">
          
              <?php if($statusVis4=='FALSE') { ?>

              <?php } else { ?>
                <div class="col-md-7" style="float: left;">
                  
                  <input type="submit" name="Approve" <?php if($statusVis4=='FALSE') {?> disabled <?php  } ?>  value="Approve" class="btn btn-sm btn-primary">
                  <button type="button"   <?php if($statusVis4=='FALSE') {?>  disabled <?php  } ?>  onclick="rejectpaymentreqbtn()" class="btn btn-sm btn-warning" style="margin-left: 10px;">Reject</button>

                <?php } ?>
                  

                  <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>

                </div>
        </div>
      </div>

    </form>

  </div><!-- /.box-body -->
         
</div>



      <div class="modal-footer">


      </div>

       </form>



    </div>



<div class="modal fade" id="purchaseDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-lg" role="document">



    <div class="modal-content">



      <div class="modal-header">



       <center><h3 class="modal-title" id="exampleModalLabel" style="font-size: 17px;color: #3c8dbc;">Approval For Purchase Order</h3></center> 



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>

 <form action="{{ url('change-status-purchase-order') }}" method="post">



            @csrf

      <div class="modal-body">



           <div class="box-body">

            <form id="salesordertrans">
              @csrf
              <div class="table-responsive" style="border-top: 1px solid !important;">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty</th>

                    <th>A-Qty</th>

                    <th>Rate</th>

                    <th>Basic</th>

                  </tr>

                   <tbody id="approvdata">
                     
                   </tbody>
                  
                </table>

              </div><!-- /div -->

             <!--  <div class="row">
                <div class="col-md-6">
                     <div class="form-group mb-4">
                        <label for="staticEmail2">Basic Total</label>
                        <input type="text"  class="form-control-plaintext" id="" >
                      </div>
                </div>
              </div> -->

             


               <div class="row" style="display: flex;">
                 
                  <div class="col-md-6"> 
                    <div class="form-group">
                    
                    <textarea type="text" name="approve_remark" cols="10" rows="3" id="approve_remark" class="form-control" placeholder="Enter Remark" id="" style="margin: 0px 152px 0px 0px; width: 257px; height: 76px;"></textarea>
                    <small id="msg"></small>
                   
                    </div>

                  </div>

              </div>

        

      <br>

        
       <!-- model -->

      
      <!-- model -->

        <div class="row">
          <?php if($statusVis=='FALSE') {?>
            
        <?php } else{ ?>
          <div class="col-md-7" style="float: left;">
          <input type="submit" name="Approve" <?php if($statusVis=='FALSE') {?> disabled <?php  } ?>  value="Approve" class="btn btn-sm btn-primary">
          <button type="button"   <?php if($statusVis=='FALSE') {?> disabled <?php  } ?>  onclick="rejectbtn(1)" class="btn btn-sm btn-warning" style="margin-left: 10px;">Reject</button>
          <?php  } ?> 

          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>

            </div>
            </div>

    </form>

  </div><!-- /.box-body -->
         
</div>



      <div class="modal-footer">


      </div>

       </form>



    </div>



  </div>



</div>

<!-- PURCHASE BILL  -->

<div class="modal fade" id="purchaseBill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-lg" role="document">



    <div class="modal-content">



      <div class="modal-header">



       <center><h3 class="modal-title" id="exampleModalLabel" style="font-size: 17px;color: #3c8dbc;">Approval For Purchase Order</h3></center> 



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>

 <form action="{{ url('change-status-purchase-bill') }}" method="post">



            @csrf

      <div class="modal-body">



           <div class="box-body">

            <form id="salesordertrans">
              @csrf
              <div class="table-responsive" style="border-top: 1px solid !important;">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty</th>

                    <th>A-Qty</th>

                    <th>Rate</th>

                    <th>Basic</th>

                  </tr>

                   <tbody id="approvbilldata">
                     
                   </tbody>
                  
                </table>

              </div><!-- /div -->

             <!--  <div class="row">
                <div class="col-md-6">
                     <div class="form-group mb-4">
                        <label for="staticEmail2">Basic Total</label>
                        <input type="text"  class="form-control-plaintext" id="" >
                      </div>
                </div>
              </div> -->

             


               <div class="row" style="display: flex;">
                 
                  <div class="col-md-6"> 
                    <div class="form-group">
                    
                    <textarea type="text" name="approve_remark_bill" cols="10" rows="3" id="approve_remark_bill" class="form-control" placeholder="Enter Remark" id="" style="margin: 0px 152px 0px 0px; width: 257px; height: 76px;"></textarea>
                    <small id="msg"></small>
                   
                    </div>

                  </div>

              </div>

        

      <br>

        
       <!-- model -->

      
      <!-- model -->

        <div class="row">
          <?php if($statusVis6=='FALSE') {?>
            
        <?php } else{ ?>
          <div class="col-md-7" style="float: left;">
          <input type="submit" name="Approve" <?php if($statusVis6=='FALSE') {?> disabled <?php  } ?>  value="Approve" class="btn btn-sm btn-primary">
          <button type="button"   <?php if($statusVis6=='FALSE') {?> disabled <?php  } ?>  onclick="rejectbillbtn(1)" class="btn btn-sm btn-warning" style="margin-left: 10px;">Reject</button>
          <?php  } ?> 

          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>

            </div>
            </div>

    </form>

  </div><!-- /.box-body -->
         
</div>



      <div class="modal-footer">


      </div>

       </form>



    </div>



  </div>



</div>
<!-- PURCHASE BILL  -->

<div class="modal fade" id="purchaseIndent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-lg" role="document">



    <div class="modal-content">



      <div class="modal-header">



       <center><h3 class="modal-title" id="exampleModalLabel" style="font-size: 17px;color: #3c8dbc;">Approval For Purchase Indent</h3></center> 



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>

 <form action="{{ url('change-status-purchase-indent') }}" method="post">



            @csrf

      <div class="modal-body">



           <div class="box-body">

            <form id="salesordertrans">
              @csrf
              <div class="table-responsive" style="border-top: 1px solid !important;">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty</th>

                    <th>A-Qty</th>

                    <th>Date</th>

                   

                  </tr>

                   <tbody id="approvindentdata">
                     
                   </tbody>
                  
                </table>

              </div><!-- /div -->

             <!--  <div class="row">
                <div class="col-md-6">
                     <div class="form-group mb-4">
                        <label for="staticEmail2">Basic Total</label>
                        <input type="text"  class="form-control-plaintext" id="" >
                      </div>
                </div>
              </div> -->

             


               <div class="row" style="display: flex;">
                 
                  <div class="col-md-6"> 
                    <div class="form-group">
                    
                    <textarea type="text" name="approve_remark_indent" cols="10" rows="3" id="approve_remark_indent" class="form-control"   placeholder="Enter Remark"  style="margin: 0px 152px 0px 0px; width: 257px; height: 76px;"></textarea>
                    <small id="msg"></small>
                   
                    </div>

                  </div>

              </div>

        

      <br>

        
       <!-- model -->

      
      <!-- model -->

      	
        <div class="row">
          <?php if($statusVis1=='FALSE') {?>
            

        <?php } else { ?>
          
          <div class="col-md-7" style="float: left;">
          <input type="submit" name="Approve" id="indappbtn" <?php if($statusVis1=='FALSE') {?> disabled <?php  } ?>  value="Approve" class="btn btn-sm btn-primary">
          <button type="button" id="indrejbtn" style="margin-left: 10px;"  <?php if($statusVis1=='FALSE') {?>  disabled <?php  } ?>  onclick="rejectindentbtn(1)" class="btn btn-sm btn-warning">Reject</button>
          
        <?php  } ?> 
       
          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>
        
            </div>
            </div>

    </form>

  </div><!-- /.box-body -->
         
</div>



      <div class="modal-footer">


      </div>

       </form>



    </div>



  </div>



</div>


<div class="modal fade" id="purchaseQutation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-lg" role="document">



    <div class="modal-content">



      <div class="modal-header">



       <center><h3 class="modal-title" id="exampleModalLabel" style="font-size: 17px;color: #3c8dbc;">Approval For Purchase Quatation</h3></center> 



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>

 <form action="{{ url('change-status-purchase-quatation') }}" method="post">



            @csrf

      <div class="modal-body">



           <div class="box-body">

            <form id="salesordertrans">
              @csrf
              <div class="table-responsive" style="border-top: 1px solid !important;">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty</th>

                    <th>A-Qty</th>

                    <th>Date</th>

                   

                  </tr>

                   <tbody id="approvquatationdata">
                     
                   </tbody>
                  
                </table>

              </div><!-- /div -->

             <!--  <div class="row">
                <div class="col-md-6">
                     <div class="form-group mb-4">
                        <label for="staticEmail2">Basic Total</label>
                        <input type="text"  class="form-control-plaintext" id="" >
                      </div>
                </div>
              </div> -->

             


               <div class="row" style="display: flex;">
                 
                  <div class="col-md-6"> 
                    <div class="form-group">
                    
                    <textarea type="text" name="approve_remark_quatation" cols="10" rows="3" id="approve_remark_quatation" class="form-control" placeholder="Enter Remark"  style="margin: 0px 152px 0px 0px; width: 257px; height: 76px;"></textarea>
                    <small id="msg"></small>
                   
                    </div>

                  </div>

              </div>

        

      <br>

        
       <!-- model -->

      
      <!-- model -->

        <div class="row">

          <?php if($statusVis2=='FALSE') { ?>

          <?php } else { ?>
          
            <div class="col-md-7" style="float: left;">
          <input type="submit" name="Approve" <?php if($statusVis2=='FALSE') {?> disabled <?php  } ?>  value="Approve" class="btn btn-sm btn-primary">
          <button type="button"   <?php if($statusVis2=='FALSE') {?>  disabled <?php  } ?>  onclick="rejectquatationbtn(1)" class="btn btn-sm btn-warning" style="margin-left: 10px;">Reject</button>
        
        <?php } ?>

          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>

            </div>
            </div>

    </form>

  </div><!-- /.box-body -->
         
</div>



      <div class="modal-footer">


      </div>

       </form>



    </div>



  </div>



</div>


<div class="modal fade" id="purchaseContract" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-lg" role="document">



    <div class="modal-content">



      <div class="modal-header">



       <center><h3 class="modal-title" id="exampleModalLabel" style="font-size: 17px;color: #3c8dbc;">Approval For Purchase Contract</h3></center> 



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>

 <form action="{{ url('change-status-purchase-contract') }}" method="post">



            @csrf

      <div class="modal-body">



           <div class="box-body">

            <form id="salesordertrans">
              @csrf
              <div class="table-responsive" style="border-top: 1px solid !important;">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Qty</th>

                    <th>A-Qty</th>

                    <th>Date</th>

                   

                  </tr>

                   <tbody id="approvcontractdata">
                     
                   </tbody>
                  
                </table>

              </div><!-- /div -->

             <!--  <div class="row">
                <div class="col-md-6">
                     <div class="form-group mb-4">
                        <label for="staticEmail2">Basic Total</label>
                        <input type="text"  class="form-control-plaintext" id="" >
                      </div>
                </div>
              </div> -->

             


               <div class="row" style="display: flex;">
                 
                  <div class="col-md-6"> 
                    <div class="form-group">
                    
                    <textarea type="text" name="approve_remark_contract" cols="10" rows="3" id="approve_remark_contract" class="form-control" placeholder="Enter Remark" id="" style="margin: 0px 152px 0px 0px; width: 257px; height: 76px;"></textarea>
                    <small id="msg"></small>
                   
                    </div>

                  </div>

              </div>

        

      <br>

        
       <!-- model -->

      
      <!-- model -->

        <div class="row">
          
          <?php if($statusVis3=='FALSE') { ?>

          <?php } else { ?>
            <div class="col-md-7" style="float: left;">
          <input type="submit" name="Approve" <?php if($statusVis3=='FALSE') {?> disabled <?php  } ?>  value="Approve" class="btn btn-sm btn-primary">
          <button type="button"   <?php if($statusVis3=='FALSE') {?>  disabled <?php  } ?>  onclick="rejectcontractbtn(1)" class="btn btn-sm btn-warning" style="margin-left: 10px;">Reject</button>

        <?php } ?>
          

          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>

            </div>
            </div>

    </form>

  </div><!-- /.box-body -->
         
</div>



      <div class="modal-footer">


      </div>

       </form>



    </div>



  </div>



</div>


<div class="modal fade" id="storeRequsition" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-lg" role="document">



    <div class="modal-content">



      <div class="modal-header">



       <center><h3 class="modal-title" id="exampleModalLabel" style="font-size: 17px;color: #3c8dbc;">Approval For Store Requistion </h3></center> 



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>

 <form action="{{ url('change-status-store-requisition') }}" method="post">



            @csrf

      <div class="modal-body">



           <div class="box-body">

            <form id="salesordertrans">
              @csrf
              <div class="table-responsive" style="border-top: 1px solid !important;">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Tran Code</th>

                    <th>Qty</th>

                    <th>A-Qty</th>


                   

                  </tr>

                   <tbody id="approvrequistiondata">
                     
                   </tbody>
                  
                </table>

              </div><!-- /div -->

             <!--  <div class="row">
                <div class="col-md-6">
                     <div class="form-group mb-4">
                        <label for="staticEmail2">Basic Total</label>
                        <input type="text"  class="form-control-plaintext" id="" >
                      </div>
                </div>
              </div> -->

             


               <div class="row" style="display: flex;">
                 
                  <div class="col-md-6"> 
                    <div class="form-group">
                    
                    <textarea type="text" name="approve_remark_requistion" cols="10" rows="3" id="approve_remark_requistion" class="form-control" placeholder="Enter Remark" id="" style="margin: 0px 152px 0px 0px; width: 257px; height: 76px;"></textarea>
                    <small id="msg"></small>
                   
                    </div>

                  </div>

              </div>

        

      <br>

        
       <!-- model -->

      
      <!-- model -->

        <div class="row">
          
          <?php if($statusVis4=='FALSE') { ?>

          <?php } else { ?>
            <div class="col-md-7" style="float: left;">
          <input type="submit" name="Approve" <?php if($statusVis4=='FALSE') {?> disabled <?php  } ?>  value="Approve" class="btn btn-sm btn-primary">
          <button type="button"   <?php if($statusVis4=='FALSE') {?>  disabled <?php  } ?>  onclick="rejectstorereqbtn(1)" class="btn btn-sm btn-warning" style="margin-left: 10px;">Reject</button>

        <?php } ?>
          

          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>

            </div>
            </div>

    </form>

  </div><!-- /.box-body -->
         
</div>



      <div class="modal-footer">


      </div>

       </form>



    </div>



  </div>



</div>

<div class="modal fade" id="saleOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">



  <div class="modal-dialog modal-lg" role="document">



    <div class="modal-content">



      <div class="modal-header">



       <center><h3 class="modal-title" id="exampleModalLabel" style="font-size: 17px;color: #3c8dbc;">Approval For Sales Order </h3></center> 



        <button type="button" class="close" data-dismiss="modal" aria-label="Close">



          <span aria-hidden="true">&times;</span>



        </button>



      </div>

 <form action="{{ url('change-status-sale-order') }}" method="post">



            @csrf

      <div class="modal-body">



           <div class="box-body">

            <form id="salesordertrans">
              @csrf
              <div class="table-responsive" style="border-top: 1px solid !important;">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th>Item Code</th>

                    <th>Item Name</th>

                    <th>Tran Code</th>

                    <th>Qty</th>

                    <th>A-Qty</th>



                  </tr>

                   <tbody id="approvsaleorderdata">
                     
                   </tbody>
                  
                </table>

              </div><!-- /div -->

             <!--  <div class="row">
                <div class="col-md-6">
                     <div class="form-group mb-4">
                        <label for="staticEmail2">Basic Total</label>
                        <input type="text"  class="form-control-plaintext" id="" >
                      </div>
                </div>
              </div> -->


               <div class="row" style="display: flex;">
                 
                  <div class="col-md-6"> 
                    <div class="form-group">
                    
                    <textarea type="text" name="approve_remark_sale" cols="10" rows="3" id="approve_remark_sale" class="form-control" placeholder="Enter Remark" id="" style="margin: 0px 152px 0px 0px; width: 257px; height: 76px;"></textarea>
                    <small id="msg"></small>
                   
                    </div>

                  </div>

              </div>

        

      <br>

        
       <!-- model -->

      
      <!-- model -->

        <div class="row">
          
          <?php if($statusVis4=='FALSE') { ?>

          <?php } else { ?>
            <div class="col-md-7" style="float: left;">
          <input type="submit" name="Approve" <?php if($statusVis4=='FALSE') {?> disabled <?php  } ?>  value="Approve" class="btn btn-sm btn-primary">
          <button type="button"   <?php if($statusVis4=='FALSE') {?>  disabled <?php  } ?>  onclick="rejectsaleorderbtn(1)" class="btn btn-sm btn-warning" style="margin-left: 10px;">Reject</button>

        <?php } ?>
          

          <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" style="margin-left: 10px;">Cancel</button>

            </div>
            </div>

    </form>

  </div><!-- /.box-body -->
         
</div>



      <div class="modal-footer">


      </div>

       </form>



    </div>



  </div>



</div>

@include('admin.include.footer')


<script type="text/javascript">

  function showtaskapproval(tran_code='', series_code='',fyYr='',vrno='',userFun='',userTask='',weightage='',slno='',approve_ind='',scoreCardId='', taskslno=''){

    $("#scoredata").html('');

    if(tran_code){

      var bodyscoreTbl = "<tr class='useful'><td class='tdthtablebordr><span style='width: 190px;'>"+tran_code+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+fyYr+"</span>"+' '+"<span style='width: 190px;'>"+series_code+"</span>"+' '+" <span style='width: 190px;'>"+vrno+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+userFun+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+userTask+"</span><span style='width: 190px;'><input type='hidden' name='scoreCardId' value="+scoreCardId+"><input type='hidden' name='taskslno' value="+taskslno+"><input type='hidden' name='approve_ind' value="+approve_ind+"><input type='hidden' name='weightage' id='weightage' value="+weightage+"></span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+weightage+"</span></td><td class='tdthtablebordr text-center'><input type='text' name='score' id='funScore' class='form-control' value='' oninput='funFunHeadScore()' style='width:100px;' autocomplete='off'><span id='funScoreErr'></span></td></tr>";

    }  
      
      $("#scoredata").append(bodyscoreTbl);
        
      $("#showtaskList").modal('show');
  }

  function showpaymetapprove(tran_code,series_code,fy_yr,vrno,slno,month_yr,appr_ind,acc_name,acc_code,payment_type,amount,headId,user){
   
    $("#paymentData").html('');

    if(tran_code){

      var bodyscoreTbl = "<tr class='useful'><td class='tdthtablebordr><span style='width: 190px;'>"+tran_code+"</span></td><input type='hidden' name='headId' value="+headId+" id='headId'><input type='hidden' name='userId' value="+user+" id='userId'><input type='hidden' name='tranCode' id='tranCode' value="+tran_code+"><input type='hidden' name='vrno' id='vrno' value="+vrno+"><td class='tdthtablebordr'><span style='width: 190px;'>"+fy_yr+"</span>"+' '+"<span style='width: 190px;'>"+series_code +"</span>"+' '+"<span style='width: 190px;'>"+vrno+"</span></td><td class='tdthtablebordr'>"+month_yr+"</td><td class='tdthtablebordr'><span style='width: 190px;'>"+acc_name+"</span>"+' '+"<span style='width: 190px;'>["+acc_code+"]</span></td><td class='tdthtablebordr'>"+payment_type+"</td><td class='tdthtablebordr'>"+amount+"</td></tr>";

    }  
      
      $("#paymentData").append(bodyscoreTbl);
        
      $("#paymentAdviceApprove").modal('show');
  }

  function funFunHeadScore(){

    var score = $('#funScore').val();
    var weightage = $('#weightage').val();
    var weight = parseInt(weightage);

    if(score < 0 || score == '') {
      $('#funHeadScore').prop('disabled',true);
      $('#funScoreErr').html('Enter Score in between Weightage range').css('color','red');
      

    }else if(score > weight){

      $('#funHeadScore').prop('disabled',true);
       
      $('#funScoreErr').html('Score is grater than Weightage').css('color','red');
     

    }else if(score > 0 && score <= weight){

      $('#funScoreErr').html('');
      $('#funHeadScore').prop('disabled',false);
      
    }else{}
  }

  function showorderapproval(tran_code='',series_code='',vr_no='',slno='',approve_ind=''){

    if(tran_code && series_code){

       $.ajax({

                  url:"{{ url('get_order_by_approval_purchase') }}",

                  method : "POST",

                  type: "JSON",

                  data: {tran_code: tran_code,series_code:series_code,vr_no:vr_no,slno:slno,approve_ind:approve_ind},

                  success:function(data){

                      var obj = JSON.parse(data);
                        
                     $("#approve_ind").val(obj.approve_ind);

                      $("#approvdata").empty();
                      var counter =1;


                      $.each(obj.data,function(key,value){


                      var paymntHead = "<tr class='useful'><td class='tdthtablebordr><span style='width: 190px;'>"+value.ITEM_CODE+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.ITEM_NAME+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.ORDERQTY+"</span>"+'-'+"<span style='width: 190px;'>"+value.UM+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.ORDERAQTY+"</span>"+'-'+"<span style='width: 190px;'>"+value.AUM+"<input type='hidden' name='tran_code' value='"+value.TRAN_CODE+"' id='tran_code_"+counter+"'><input type='hidden' name='series_code' value='"+value.SERIES_CODE+"' id='series_code_"+counter+"'><input type='hidden' name='vr_no' id='vr_no_"+counter+"' value='"+value.VRNO+"'><input type='hidden' name='sl_no' value='"+value.SLNO+"' id='sl_no_"+counter+"'></span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.RATE+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.BASICAMT+"</span></td></tr>";

                       if(value.APPROVE_REMARK){
                          $("#approve_remark").html(value.APPROVE_REMARK);
                        }else{
                          $("#approve_remark").html('');
                        }


                        $("#approvdata").append(paymntHead);
                    
                        $("#purchaseDelete").modal('show');

    
                       counter++;
                      });
                   }

              });
        
      }
  }

  function getadvicePay(checkid){
      //console.log('ok');

      var paymentid =[];

      $(".checkRowSub").each(function (){
                
                if($(this).is(":checked")){

                  paymentid.push($(this).val());
                }
        });
      var gettotalnetamt=0;

       for(var i=0;i<paymentid.length;i++){
          
          var netAmt = $('#pay_advice_amt_'+checkid+'_'+paymentid[i]).val();
          var gettotalnetamt = gettotalnetamt + parseFloat(netAmt);
          
          $('#totalnetGetamt'+checkid).val(gettotalnetamt.toFixed(2));

          var showindr = $('#totalnetGetamt'+checkid).val();

          if(showindr){

            $('#dr_amount'+checkid).val(showindr);
            $('#submitdata').prop('disabled',false);
            $('#simulationbtn').prop('disabled',false);
            $('#addmorhidn').prop('disabled',false);
            $('#deletehidn').prop('disabled',false);
          }else{
            $('#submitdata').prop('disabled',true);
            $('#simulationbtn').prop('disabled',true);
            $('#addmorhidn').prop('disabled',true);
            $('#deletehidn').prop('disabled',true);
          }
       }
  }

  function setOnOff(rowid,payval){

        var check = document.getElementById('checkboxid_'+rowid+'_'+payval);
        if(check.checked){

           // $('#checkboxid_'+rowid+'_'+payval).attr('checked',true);
            $('#onOff_'+rowid+'_'+payval).val('on');
        }else{
         // $('#checkboxid_'+rowid+'_'+payval).attr('checked',false);
             $('#onOff_'+rowid+'_'+payval).val('off');
        }
     
     
  }
</script>

<script type="text/javascript">

  $(document).ready(function(){
    $('#um_code_search').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var um_code = $('#um_code').val();

        if(um_code == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-um-code') }}",

             method : "POST",

             type: "JSON",

             data: {um_code: um_code},

             success:function(data){

                  var data1 = JSON.parse(data);


                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                       var objcity = data1.data;
                       $('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                      //  console.log(objcity.um_code);
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.um_code+'</span><br>');
                         });
                        
                  }
             }

          });
       }

    });

    $("body").click(function() {
        $("#showSearchCodeList").hide("fast");
    });
  });
</script>

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Depot Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var HelpUmCode = $('#umnameH').val();

           if(HelpUmCode == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-um-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpUmCode: HelpUmCode},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Depot Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.um_code+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.um_name+'</td></tr>');
                             });
                      }
                 }

              });
           }
      })
  })
})
</script>

<script type="text/javascript">
  $(document).ready(function(){
     $('body').on('click', '#closeModel', function () {
          $('.popover').fadeOut();
    })
  });
</script>

<script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
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
  function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>


<script type="text/javascript">
   $(document).ready(function(){

     $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

    

    var t = $("#example1").DataTable({

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/finance/transaction/purchase-order-approval') }}"

       },
       searching : true,
    

       columns: [
        
       
         { data:"DT_RowIndex",className:"text-center"},
         { data: "TRAN_CODE" },
         { data: "SERIES_CODE"},
         { data: "VRNO" },
         { data: "VRDATE" },
        
         {  data :"action" },

         
         
        
      ],

       


     });



});
</script>

<script type="text/javascript">
  function changeStatus(userid) {

    //alert(userid);return false;

    $("#purchaseDelete").modal('show');

    $("#UserID").val(userid);
  }
  
</script>



<script type="text/javascript">

  function rejectbtn(btnvalue){


        var approve_remark = $('#approve_remark').val();
        var vr_no          = $('#vr_no_'+btnvalue).val();
        var tran_code      = $('#tran_code_'+btnvalue).val();
        var sl_no          = $('#sl_no_'+btnvalue).val();
        var approve_ind    = $('#approve_ind').val();

        if(approve_remark==''){

          $("#msg").html('approve remark field is required.').css('color','red');

          return false;
        }

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });
        
         $.ajax({

            url:"{{ url('reject-approve-purchase-order') }}",

             method : "POST",

             type: "JSON",

             data: {approve_remark: approve_remark,vr_no:vr_no,tran_code:tran_code,sl_no:sl_no,approve_ind:approve_ind},

             success:function(data){

              console.log(data);
              var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });

                 /* var data1 = JSON.parse(data);


                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                   console.log(data1.response);


                 var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });
                        
                  }*/
             }

          });


  }
</script>


<script type="text/javascript">

  function showindentapproval(tran_code='',series_code='',vr_no='',slno='',approve_ind=''){

    
    //  alert(approve_ind);return false;

      if(tran_code && series_code){

       $.ajax({

                  url:"{{ url('get_indent_by_approval_purchase') }}",

                  method : "POST",

                  type: "JSON",

                  data: {tran_code: tran_code,series_code:series_code,vr_no:vr_no,slno:slno,approve_ind:approve_ind},

                  success:function(data){

                      var obj = JSON.parse(data);

                        
                     //console.log(obj.approve_ind);

                      $("#approve_ind").val(obj.approve_ind);

                      $("#approvindentdata").empty();
                      var counter =1;

                      $.each(obj.data,function(key,value){


                      var paymntHead = "<tr class='useful'><td class='tdthtablebordr><span style='width: 190px;'>"+value.ITEM_CODE+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.ITEM_NAME+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.QTYRECVD+"</span>"+'-'+"<span style='width: 190px;'>"+value.UM+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.AQTYRECD+"</span>"+'-'+"<span style='width: 190px;'>"+value.AUM+"<input type='hidden' name='tran_code' value='"+value.TRAN_CODE+"' id='tran_code_"+counter+"'><input type='hidden' name='series_code' value='"+value.SERIES_CODE+"' id='series_code_"+counter+"'><input type='hidden' name='vr_no' id='vr_no_"+counter+"' value='"+value.VRNO+"'><input type='hidden' name='sl_no' value='"+value.SLNO+"' id='sl_no_"+counter+"'></span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.VRDATE+"</span></td></tr>";
                        if(value.APPROVE_REMARK){
                          $("#approve_remark_indent").html(value.APPROVE_REMARK);
                        }else{
                          $("#approve_remark_indent").html('');
                        }
                        if(value.FLAG=='2'){

                        	$("#indappbtn").prop('disabled',true);
                        	$("#indrejbtn").prop('disabled',true);
                        }else{

                        	$("#indappbtn").prop('disabled',false);
                        	$("#indrejbtn").prop('disabled',false);

                        }
                      
                        $("#approvindentdata").append(paymntHead);
                    
                        $("#purchaseIndent").modal('show');

    
                       counter++;
                      });
                   }

              });
        
      }
  }

  

 
</script>




<script type="text/javascript">

  function rejectindentbtn(btnvalue){

        var approve_remark_indent = $('#approve_remark_indent').val();
        var vr_no          = $('#vr_no_'+btnvalue).val();
        var tran_code      = $('#tran_code_'+btnvalue).val();
        var sl_no          = $('#sl_no_'+btnvalue).val();
        var approve_ind    = $('#approve_ind').val();

      //  alert(approve_ind);return false;

        if(approve_remark==''){

          $("#msg").html('approve remark field is required.').css('color','red');

          return false;
        }

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });
        
         $.ajax({

            url:"{{ url('reject-approve-purchase-indent') }}",

             method : "POST",

             type: "JSON",

             data: {approve_remark_indent: approve_remark_indent,vr_no:vr_no,tran_code:tran_code,sl_no:sl_no,approve_ind:approve_ind},

             success:function(data){

             console.log(data);
              var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });

                 /* var data1 = JSON.parse(data);


                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                   console.log(data1.response);


                 var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });
                        
                  }*/
             }

          });


  }
</script>



<script type="text/javascript">

  function showqutationapproval(tran_code='',series_code='',vr_no='',slno='',approve_ind=''){

    
    //  alert(approve_ind);return false;

      if(tran_code && series_code){

       $.ajax({

                  url:"{{ url('get_quatation_by_approval_purchase') }}",

                  method : "POST",

                  type: "JSON",

                  data: {tran_code: tran_code,series_code:series_code,vr_no:vr_no,slno:slno,approve_ind:approve_ind},

                  success:function(data){

                      var obj = JSON.parse(data);

                        
                     //console.log(obj.approve_ind);

                      $("#approve_ind").val(obj.approve_ind);

                      $("#approvquatationdata").empty();
                      var counter =1;

                      $.each(obj.data,function(key,value){


                      var paymntHead = "<tr class='useful'><td class='tdthtablebordr><span style='width: 190px;'>"+value.ITEM_CODE+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.ITEM_NAME+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.QTYRECD+"</span>"+'-'+"<span style='width: 190px;'>"+value.UM+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.AQTYRECD+"</span>"+'-'+"<span style='width: 190px;'>"+value.AUM+"<input type='hidden' name='tran_code' value='"+value.TRAN_CODE+"' id='tran_code_"+counter+"'><input type='hidden' name='series_code' value='"+value.PENQ_VRNO+"' id='series_code_"+counter+"'><input type='hidden' name='vr_no' id='vr_no_"+counter+"' value='"+value.VRNO+"'><input type='hidden' name='sl_no' value='"+value.SLNO+"' id='sl_no_"+counter+"'></span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+'-'+"</span></td></tr>";

                      if(value.APPROVE_REMARK){
                          $("#approve_remark_quatation").html(value.APPROVE_REMARK);
                        }else{
                          $("#approve_remark_quatation").html('');
                        }

                        $("#approvquatationdata").append(paymntHead);
                    
                        $("#purchaseQutation").modal('show');

    
                       counter++;
                      });
                   }

              });
        
      }
  }

  

 
</script>

<script type="text/javascript">

  function rejectquatationbtn(btnvalue){


        var approve_remark_quatation = $('#approve_remark_quatation').val();
        var vr_no          = $('#vr_no_'+btnvalue).val();
        var tran_code      = $('#tran_code_'+btnvalue).val();
        var sl_no          = $('#sl_no_'+btnvalue).val();

        var approve_ind    = $('#approve_ind').val();

      

      //  alert(approve_ind);return false;


          console.log(vr_no);
        if(approve_remark==''){

          $("#msg").html('approve remark field is required.').css('color','red');

          return false;
        }

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });
        
         $.ajax({

            url:"{{ url('reject-approve-purchase-quatation') }}",

             method : "POST",

             type: "JSON",

             data: {approve_remark_quatation: approve_remark_quatation,vr_no:vr_no,tran_code:tran_code,sl_no:sl_no,approve_ind:approve_ind},

             success:function(data){

             console.log(data);
              var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });

                 /* var data1 = JSON.parse(data);


                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                   console.log(data1.response);


                 var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });
                        
                  }*/
             }

          });


  }
</script>

<script type="text/javascript">

  function showcontractapproval(tran_code='',series_code='',vr_no='',slno='',approve_ind=''){

    
    //  alert(approve_ind);return false;

      if(tran_code && series_code){

       $.ajax({

                  url:"{{ url('get_contract_by_approval_purchase') }}",

                  method : "POST",

                  type: "JSON",

                  data: {tran_code: tran_code,series_code:series_code,vr_no:vr_no,slno:slno,approve_ind:approve_ind},

                  success:function(data){

                      var obj = JSON.parse(data);

                        
                     //console.log(obj.approve_ind);

                      $("#approve_ind").val(obj.approve_ind);

                      $("#approvcontractdata").empty();
                      var counter =1;

                      $.each(obj.data,function(key,value){


                      var paymntHead = "<tr class='useful'><td class='tdthtablebordr><span style='width: 190px;'>"+value.ITEM_CODE+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.ITEM_NAME+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.QTYRECD+"</span>"+'-'+"<span style='width: 190px;'>"+value.UM+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.AQTYRECD+"</span>"+'-'+"<span style='width: 190px;'>"+value.AUM+"<input type='hidden' name='tran_code' value='"+value.TRAN_CODE+"' id='tran_code_"+counter+"'><input type='hidden' name='series_code' value='"+value.SERIES_CODE+"' id='series_code_"+counter+"'><input type='hidden' name='vr_no' id='vr_no_"+counter+"' value='"+value.VRNO+"'><input type='hidden' name='sl_no' value='"+value.SLNO+"' id='sl_no_"+counter+"'></span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.VRDATE+"</span></td></tr>";

                      if(value.APPROVE_REMARK){
                          $("#approve_remark_contract").html(value.APPROVE_REMARK);
                        }else{
                          $("#approve_remark_contract").html('');
                        }

                        $("#approvcontractdata").append(paymntHead);
                    
                        $("#purchaseContract").modal('show');

    
                       counter++;
                      });
                   }

              });
        
      }
  }

  

 
</script>

<script type="text/javascript">

  function rejectcontractbtn(btnvalue){


        var approve_remark_contract = $('#approve_remark_contract').val();
        var vr_no          = $('#vr_no_'+btnvalue).val();
        var tran_code      = $('#tran_code_'+btnvalue).val();
        var sl_no          = $('#sl_no_'+btnvalue).val();

        var approve_ind    = $('#approve_ind').val();

      

      //alert(approve_ind);return false;


          //console.log(vr_no);
        if(approve_remark==''){

          $("#msg").html('approve remark field is required.').css('color','red');

          return false;
        }

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });
        
         $.ajax({

            url:"{{ url('reject-approve-purchase-contract') }}",

             method : "POST",

             type: "JSON",

             data: {approve_remark_contract: approve_remark_contract,vr_no:vr_no,tran_code:tran_code,sl_no:sl_no,approve_ind:approve_ind},

             success:function(data){

             console.log(data);
              var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });

                 /* var data1 = JSON.parse(data);


                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                   console.log(data1.response);


                 var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });
                        
                  }*/
             }

          });


  }
</script>


<script type="text/javascript">

  function showstorereqapproval(tran_code='',series_code='',vr_no='',slno='',approve_ind=''){

    
      //alert(approve_ind);return false;
      //$("#storeRequsition").modal('show');

      if(tran_code && series_code){

       $.ajax({

                  url:"{{ url('get_store_requistion_by_approval_purchase') }}",

                  method : "POST",

                  type: "JSON",

                  data: {tran_code: tran_code,series_code:series_code,vr_no:vr_no,slno:slno,approve_ind:approve_ind},

                  success:function(data){

                      var obj = JSON.parse(data);

                        
                     console.log(obj.approve_ind);

                      $("#approve_ind").val(obj.approve_ind);

                      $("#approvrequistiondata").empty();
                      var counter =1;

                      $.each(obj.data,function(key,value){


                      var paymntHead = "<tr class='useful'><td class='tdthtablebordr><span style='width: 190px;'>"+value.ITEM_CODE+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.ITEM_NAME+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.SERIES_CODE+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.QTYRECD+"</span>"+'-'+"<span style='width: 190px;'>"+value.UM+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.AQTYRECD+"</span>"+'-'+"<span style='width: 190px;'>"+value.AUM+"<input type='hidden' name='tran_code' value='"+value.TRAN_CODE+"' id='tran_code_"+counter+"'><input type='hidden' name='series_code' value='"+value.SERIES_CODE+"' id='series_code_"+counter+"'><input type='hidden' name='vr_no' id='vr_no_"+counter+"' value='"+value.VRNO+"'><input type='hidden' name='sl_no' value='"+value.SLNO+"' id='sl_no_"+counter+"'></span></td></tr>";

                      if(value.APPROVE_REMARK){
                          $("#approve_remark_requistion").html(value.APPROVE_REMARK);
                        }else{
                          $("#approve_remark_requistion").html('');
                        }

                        $("#approvrequistiondata").append(paymntHead);
                    
                        $("#storeRequsition").modal('show');

    
                       counter++;
                      });
                   }

              });
        
      }
  }

  

 
</script>


<script type="text/javascript">

  function showsaleorderapproval(tran_code='',series_code='',vr_no='',slno='',approve_ind=''){

    
      //alert(approve_ind);return false;
      //$("#storeRequsition").modal('show');

      if(tran_code && series_code){

       $.ajax({

                  url:"{{ url('get_sale_order_by_approval_sale') }}",

                  method : "POST",

                  type: "JSON",

                  data: {tran_code: tran_code,series_code:series_code,vr_no:vr_no,slno:slno,approve_ind:approve_ind},

                  success:function(data){

                      var obj = JSON.parse(data);

                        
                      $("#approve_ind").val(obj.approve_ind);

                      $("#approvsaleorderdata").empty();
                      var counter =1;

                      $.each(obj.data,function(key,value){


                      var paymntHead = "<tr class='useful'><td class='tdthtablebordr><span style='width: 190px;'>"+value.ITEM_CODE+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.ITEM_NAME+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.TRAN_CODE+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.ORDERQTY+"</span>"+'-'+"<span style='width: 190px;'>"+value.UM+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.ORDERAQTY+"</span>"+'-'+"<span style='width: 190px;'>"+value.AUM+"<input type='hidden' name='tran_code' value='"+value.TRAN_CODE+"' id='tran_code_"+counter+"'><input type='hidden' name='series_code' value='"+value.SERIES_CODE+"' id='series_code_"+counter+"'><input type='hidden' name='vr_no' id='vr_no_"+counter+"' value='"+value.VRNO+"'><input type='hidden' name='sl_no' value='"+value.SLNO+"' id='sl_no_"+counter+"'></span></td></tr>";

                      if(value.APPROVE_REMARK){
                          $("#approve_remark_sale").html(value.APPROVE_REMARK);
                        }else{
                          $("#approve_remark_sale").html('');
                        }

                        $("#approvsaleorderdata").append(paymntHead);
                    
                        $("#saleOrder").modal('show');

    
                       counter++;
                      });
                   }

              });
        
      }
  }

  

 
</script>

<script type="text/javascript">

  function rejectpaymentreqbtn(){
       
        var vrno        = $('#vrno').val();
        var tran_code   = $('#tranCode').val();
        var headId      = $('#headId').val();
        var userId      = $('#userId').val();
        var remark      = $('#remark').val();

        if(remark ==''){

        $("#paymentRemark").html('remark field is required.').css('color','red');

        return false;
        }else{
          $("#paymentRemark").html('');
        }

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });
        
         $.ajax({

            url:"{{ url('reject-payment-advice-requistion') }}",

             method : "POST",

             type: "JSON",

             data: {vrno:vrno,tran_code:tran_code,headId: headId,userId:userId,remark:remark},

        //      success:function(data){

            
        //       var url = "{{url('/finance/reject-purchase-order-msg')}}"
        // setTimeout(function(){ window.location = url+'/savedata'; });

        //        }

                success: function (data) {
                      var data1 = JSON.parse(data)
                      
                      if(data1.response == 'success'){
                       
                        var getName = btoa('PaymentAdvice');

                        window.location.href="/biztechERP_DEV/Transaction/TravelRequisition/success-message/"+getName;
                               
                      }

                }

          });

  }

  function rejectstorereqbtn(btnvalue){


        var approve_remark_requistion = $('#approve_remark_requistion').val();
        var vr_no          = $('#vr_no_'+btnvalue).val();
        var tran_code      = $('#tran_code_'+btnvalue).val();
        var sl_no          = $('#sl_no_'+btnvalue).val();

        var approve_ind    = $('#approve_ind').val();

      

      //alert(approve_ind);return false;


          //console.log(vr_no);
        if(approve_remark_requistion==''){

          $("#msg").html('approve remark field is required.').css('color','red');

          return false;
        }

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });
        
         $.ajax({

            url:"{{ url('reject-approve-store-requistion') }}",

             method : "POST",

             type: "JSON",

             data: {approve_remark_requistion: approve_remark_requistion,vr_no:vr_no,tran_code:tran_code,sl_no:sl_no,approve_ind:approve_ind},

             success:function(data){

            
              var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });

                 /* var data1 = JSON.parse(data);


                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                   console.log(data1.response);


                 var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });
                        
                  }*/
             }

          });


  }
</script>

<script type="text/javascript">

  function rejectsaleorderbtn(btnvalue){


        var approve_remark_sale = $('#approve_remark_sale').val();
        var vr_no               = $('#vr_no_'+btnvalue).val();
        var tran_code           = $('#tran_code_'+btnvalue).val();
        var sl_no               = $('#sl_no_'+btnvalue).val();
        
        var approve_ind         = $('#approve_ind').val();

      

   //   alert(tran_code);return false;


          //console.log(vr_no);
        if(approve_remark_sale==''){

          $("#msg").html('approve remark field is required.').css('color','red');

          return false;
        }

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });
        
         $.ajax({

            url:"{{ url('reject-approve-sale-order') }}",

             method : "POST",

             type: "JSON",

             data: {approve_remark_sale: approve_remark_sale,vr_no:vr_no,tran_code:tran_code,sl_no:sl_no,approve_ind:approve_ind},

             success:function(data){

             console.log(data);
              var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });

                 /* var data1 = JSON.parse(data);


                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                   console.log(data1.response);


                 var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });
                        
                  }*/
             }

          });


  }
</script>


<script type="text/javascript">

  function showbillapproval(tran_code='',series_code='',vr_no='',slno='',approve_ind=''){


      if(tran_code && series_code){

       $.ajax({

                  url:"{{ url('get_bill_by_approval_purchase') }}",

                  method : "POST",

                  type: "JSON",

                  data: {tran_code: tran_code,series_code:series_code,vr_no:vr_no,slno:slno,approve_ind:approve_ind},

                  success:function(data){

                      var obj = JSON.parse(data);
                        
                     console.log(obj);
                      $("#approve_ind").val(obj.approve_ind);

                      $("#approvbilldata").empty();
                      var counter =1;


                      $.each(obj.data,function(key,value){


                      var paymntHead = "<tr class='useful'><td class='tdthtablebordr><span style='width: 190px;'>"+value.ITEM_CODE+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.ITEM_NAME+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.QTYRECD+"</span>"+'-'+"<span style='width: 190px;'>"+value.UM+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.AQTYRECD+"</span>"+'-'+"<span style='width: 190px;'>"+value.AUM+"<input type='hidden' name='tran_code' value='"+value.TRAN_CODE+"' id='tran_code_"+counter+"'><input type='hidden' name='series_code' value='"+value.SERIES_CODE+"' id='series_code_"+counter+"'><input type='hidden' name='vr_no' id='vr_no_"+counter+"' value='"+value.VRNO+"'><input type='hidden' name='sl_no' value='"+value.SLNO+"' id='sl_no_"+counter+"'></span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.RATE+"</span></td><td class='tdthtablebordr'><span style='width: 190px;'>"+value.BASICAMT+"</span></td></tr>";

                       if(value.APPROVE_REMARK){
                          $("#approve_remark_bill").html(value.APPROVE_REMARK);
                        }else{
                          $("#approve_remark_bill").html('');
                        }


                        $("#approvbilldata").append(paymntHead);
                    
                        $("#purchaseBill").modal('show');

    
                       counter++;
                      });
                   }

              });
      
      }
  }


</script>

<script type="text/javascript">

  function rejectbillbtn(btnvalue){


        var approve_remark = $('#approve_remark_bill').val();
        var vr_no          = $('#vr_no_'+btnvalue).val();
        var tran_code      = $('#tran_code_'+btnvalue).val();
        var sl_no          = $('#sl_no_'+btnvalue).val();
        var approve_ind    = $('#approve_ind').val();

        if(approve_remark==''){

          $("#msg").html('approve remark field is required.').css('color','red');

          return false;
        }

        $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });
        
         $.ajax({

            url:"{{ url('reject-approve-purchase-bill') }}",

             method : "POST",

             type: "JSON",

             data: {approve_remark: approve_remark,vr_no:vr_no,tran_code:tran_code,sl_no:sl_no,approve_ind:approve_ind},

             success:function(data){

              console.log(data);
              var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });

                 /* var data1 = JSON.parse(data);


                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                  }else if(data1.response == 'success'){

                   console.log(data1.response);


                 var url = "{{url('/finance/reject-purchase-order-msg')}}"
        setTimeout(function(){ window.location = url+'/savedata'; });
                        
                  }*/
             }

          });


  }
</script>
@endsection