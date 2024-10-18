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
  .Custom-Box {
    /*border: 1px solid #e0dcdc;
    border-radius: 10px;*/    
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
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
  .showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
  .beforhidetble{
    display: none;
  }
  .popover{
    left: 92.4922px!important;
    width: 100%!important;
  }
  .setetxtintd{
    font-size: 12px !important;
    padding-top: 2% !important;
    padding-bottom: 2% !important;
  }
  .nameheading{
    font-size: 12px;
  }
  .setheightinput{
    height: 0%;
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
</style>

<div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">

          <h1>

            Master Config
          <?php if($button=='Save') { ?>
            <small>Add Details</small>
          <?php } else { ?>
            <small>Update Details</small>
          <?php } ?>

          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Master</a></li>



            <li class="active"><a href="{{ url('/finance/view-config-mast') }}">Master Config</a></li>

            <?php if($button=='Save') { ?>

            <li class="active"><a href="{{ url('/finance/config-mast') }}">Add Config</a></li>

          <?php } else { ?>
            <li class="active"><a href="{{ url('/finance/config-mast') }}">Update Config</a></li>
          <?php } ?>

          </ol>



        </section>



  <section class="content">



    <div class="row">



      <div class="col-sm-1"></div>



      <div class="col-sm-8">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">


              <?php if($button=='Save') { ?>
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Config  </h2>
            <?php } else{  ?>

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Config  </h2>
            <?php } ?>


            <div class="box-tools pull-right showinmobile">



            <a href="{{ url('/finance/view-config-mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Config</a>



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



            <form action="{{ url($action) }}" method="POST" >



               @csrf



               <div class="row">


                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Transaction Code: 



                        <span class="required-field"></span>



                      </label>



                        <div class="input-group">

                          <input type="hidden" name="comp_code" value="{{$compCode}}">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input list="trnsList" type="text" name="trans_code" id="trans_code" class="form-control" value="{{ $tran_code }}" placeholder="Select Transaction" maxlength="2" <?php if($button=='Update') { ?> readonly <?php } ?> autocomplete="off">
                         <datalist id="trnsList">

                            <option value=''>--SELECT--</option>

                           @foreach($trans_list as $row)

                            <option value='{{ $row->TRAN_CODE }}' data-xyz ="<?php echo  $row->TRAN_HEAD; ?>">{{ $row->TRAN_CODE }} = {{ $row->TRAN_HEAD }} </option>

                           @endforeach

                        </datalist>



                        </div>
                        <input type="hidden" value="" name="tranName" id="tranName">

                        <div class="pull-left showSeletedName" id="transText"></div>
                          <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('trans_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                          </small>







                    </div>



                    <!-- /.form-group -->



                  </div>







                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Series Code : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>



                          <input type="text" class="form-control codeCapital" name="series_code" value="{{ $series_code }}" placeholder="Enter Series Code" maxlength="6" id="serach_series_code" onkeyup="return serieskeyup()"  <?php if($button=='Update') { ?> readonly <?php } ?> autocomplete="off" readonly>

                        <!--   <?php if($button=='Save') { ?>
                          <span class="input-group-addon" style="padding: 1px 7px;">
                            
                            <div class="">
                                <button type="button" id="login" class="btn btn-xs btn-info gly-radius"> <i class="fa fa-info" aria-hidden="true"></i></button>
                            </div>
                            <div id="myForm" class="hide">
                                 <div class="row">
                                      <div class="col-md-9">
                                        <input type="text" name="seriesNameH" id="seriesNameH" class="form-control input-md setheightinput" style="text-transform: uppercase;">
                                      </div>
                                      <div class="col-md-3" style="margin-left: -7%;">
                                        
                                        <button type="button" id="serachcode" class="btn btn-sm btn-primary" data-loading-text="Sending info.."><em class="icon-ok"></em> <i class="fa fa-search" aria-hidden="true"></i></button>
                                      </div>
                                    </div>
                                <div id="result">
                                
                                <span id="errorItem"></span>

                            </div>
                            </div>
                            
                          </span>

                          

                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>

                          <?php } ?> -->



                      </div>



                      <small id="emailHelp" class="form-text text-muted">


                      	<sapn id="series_code_err"></sapn>
                        {!! $errors->first('series_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                </div>
                <div class="row">

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Series Name : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>



                          <input type="text" class="form-control" name="series_name" id="series_name" value="{{ $series_name }}" placeholder="Enter Series Name" maxlength="40" autocomplete="off">



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('series_name', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label><span id="requirdpost"></span>Plant Code </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input list="plantList" type="text" class="form-control" name="plant_code" id="plant_code" placeholder="Select Plant Code" maxlength="" value="{{ $plant_code }}" style="z-index: 1;" autocomplete="off">
                          
                          <datalist id="plantList">

                            <option value="">--SELECT--</option>

                            @foreach($plant_list as $key)

                            <option value="{{$key->PLANT_CODE}}" data-xyz ="<?php echo  $key->PLANT_NAME; ?>"> {{ $key->PLANT_CODE }} = {{ $key->PLANT_NAME }}</option>

                            @endforeach

                          </datalist>

                          <input type="hidden" name="plant_name" id="plant_name" value="{{ $plant_name }}" >

                        </div>

                        <div class="pull-left showSeletedName" id="plantText"></div>
                        <!-- <small style="color: red;" id="PreqMsg"></small>
                        <div class="pull-left " id="posterrmsg"></div> -->

                        <small id="emailHelp" class="form-text text-muted">
                          {!! $errors->first('plant_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>



                      </div>

                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>PFCT Code </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input  type="text" class="form-control" name="pfct_code" id="pfct_code" placeholder="PFCT Code" maxlength="" value="{{ $pfct_code }}" style="z-index: 1;" autocomplete="off" readonly="">
                          
                         <!--  <datalist id="pfctList">

                            <option value="">--SELECT--</option>

                            @foreach($pfct_list as $key)

                            <option value="<?php echo  $key->PFCT_NAME.' - '.$key->PFCT_CODE; ?> " data-xyz ="<?php echo  $key->PFCT_NAME; ?>"> {{ $key->PFCT_CODE }} = {{ $key->PFCT_NAME }}</option>

                            @endforeach

                          </datalist> -->

                          <input type="hidden" name="pfct_name" id="pfct_name" value="{{ $pfct_name }}" >

                        </div>

                        <div class="pull-left showSeletedName" id="pfctText"></div>
                        <!-- <small style="color: red;" id="PreqMsg"></small>
                        <div class="pull-left " id="posterrmsg"></div> -->

                        <small id="emailHelp" class="form-text text-muted">
                          {!! $errors->first('pfct_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>



                      </div>

                  </div>

                  <div class="col-md-6">

                    <div class="form-group">

                      <label> Post Code : 

                        <span id="requirdpost"></span>

                        <?php if($trans_list_autopost) { ?>
                       
                       <span class="required-field"></span>

                       <?php } else { ?>

                       <?php }?>

                      </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                        <input list="postList" type="text" class="form-control" name="post_code" id="post_code" placeholder="Select Post Code" maxlength="6" value="{{ $post_code }}" style="z-index: 1;">
                         
                        <datalist id="postList">

                            <option value="">--SELECT--</option>

                            @foreach($post_list as $key)

                            <option value="{{ $key->GL_CODE }}" data-xyz ="<?php echo  $key->GL_NAME; ?>"> {{ $key->GL_CODE }} = {{ $key->GL_NAME }}</option>

                            @endforeach

                        </datalist>

                        <input type="hidden" name="post_name" id="post_name" value="{{ $post_name }}" >

                      </div>

                      <div class="pull-left showSeletedName" id="postText"></div>
                      <small style="color: red;" id="PreqMsg"></small>
                      <div class="pull-left " id="posterrmsg"></div>

                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('post_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>
</div>

<div class="row">
    
    <div class="col-md-6">

      <div class="form-group">

        <label>GL Code : 
          <span class="required-field showinmobile" id="requirdgl"></span>
          <span class="" id="hideshow"></span>
        </label>

        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

          <input list="glList" type="text" class="form-control" name="gl_code" id="gi_code" placeholder="Select GL Code" maxlength="6" value="{{ $gl_code }}" style="z-index: 1;" autocomplete="off">
          <datalist id="glList">

            <option value="">--SELECT--</option>

            @foreach($gl_list as $key)

            <option value="{{ $key->GL_CODE }}" data-xyz ="<?php echo  $key->GL_NAME; ?>"> {{ $key->GL_CODE }} = {{ $key->GL_NAME }}</option>

            @endforeach

          </datalist>

          <input type="hidden" name="gl_name" id="gl_name" value="{{$gl_name}}">
        </div>

        <div class="pull-left showSeletedName" id="glText"></div>
        <div class="pull-left" id="errmsg" style="font-size: 12px;"></div>

        <small id="emailHelp" class="form-text text-muted">

          {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}

        </small>

      </div>
      <!-- /.form-group -->

    </div>


    <div class="col-md-6">

        <div class="form-group">

          <label>

          Stock Flag : 

            <span class="required-field"></span>

          </label>

          <div class="input-group">

            <input type="radio" class="optionsRadios1" name="stock_flag" value="1" <?php if($stock_flag=='1'){ echo 'checked';} else{ echo '';} ?> checked="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" class="optionsRadios1" name="stock_flag" value="0" <?php if($stock_flag=='0'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

          </div>

          <small id="emailHelp" class="form-text text-muted">

            {!! $errors->first('stock_flag', '<p class="help-block" style="color:red;">:message</p>') !!}

          </small>

        </div>
    <!-- /.form-group -->
    </div>

</div>

  <div class="row">

    <div class="col-md-6">

        <div class="form-group">

          <label> Rfhead 1 : </label>

          <div class="input-group">

            <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>

            <input type="text" class="form-control" name="Rfhead1" value="{{ $rfhead1 ?? '' }}" placeholder="Enter Rfhead 1" maxlength="20" autocomplete="off">

          </div>
        </div>
          <!-- /.form-group -->

    </div>

    <div class="col-md-6">



                    <div class="form-group">



                      <label>

                        Rfhead 2 : 

                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>


                          <input type="text" class="form-control" name="Rfhead2" value="{{ $rfhead2 ?? '' }}" placeholder="Enter Rfhead 2" maxlength="20" style="z-index: 1;" autocomplete="off">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>

  </div>


                <div class="row">

                    
                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Rfhead 3 : 



                       



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>



                          <input type="text" class="form-control" name="Rfhead3" value="{{ $rfhead3 ?? '' }}" placeholder="Enter Rfhead 3" maxlength="20" autocomplete="off">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Rfhead 4 : 



                       



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>



                          <input type="text" class="form-control" name="Rfhead4" value="{{ $rfhead4 ?? '' }}" placeholder="Enter Rfhead 4" maxlength="20" autocomplete="off">



                      </div>



                      



                    </div>



                    <!-- /.form-group -->



                  </div>

                 

                </div>

                <div class="row">
                   

                  <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Rfhead 5 : 



                        



                      </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-arrow-right"></i></span>



                          <input type="text" class="form-control" name="Rfhead5" value="{{ $rfhead5 ?? '' }}" placeholder="Enter Rfhead 5" maxlength="20" autocomplete="off">



                      </div>



                    



                    </div>



                    <!-- /.form-group -->



                  </div>




<?php if($button=='Update') { ?>



                 <div class="col-md-6">



                    <div class="form-group">



                      <label>



                        Config Block : 



                        <span class="required-field"></span>



                      </label>



                      <div class="input-group">




                          <input type="radio" class="optionsRadios1" name="config_block" value="YES" <?php if($config_block=='YES'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                          <input type="radio" class="optionsRadios1" name="config_block" value="NO" <?php if($config_block=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('department_block', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                    </div>



                    <!-- /.form-group -->



                  </div>

                   




<?php } ?>

                <!-- /.col -->



                

              </div>

<?php if($button=='Save') { ?>
<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="approvebtn" disabled="">Approve User 
                    </button>

  </div>
  
</div>
<?php } ?>

<?php if($button=='Update') { ?>


<div class="row">
  <div class="col-md-6"></div>
  <div class="col-md-6" style="text-align: right;">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="approvebtn">Approve User 
                    </button>

  </div>
  
</div>
<?php } ?>

              <!-- /.row -->





              <!-- /.row -->





              <div style="text-align: center;">

                <input type="hidden" name="config_id" value="{{ $config_id }}">

            <button type="Submit" class="btn btn-primary" id="btnsubmit">


                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp;  {{ $button }}



                 </button>



              </div>

            <!--start modal -->
<style type="text/css">
  .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    border-top: 1px solid #b1a0a0 !important;
}
</style>
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;">Approve Users</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                        <!---- start table #b1a0a0---->
                        
                        <div class="table-responsive ">
                        
                        <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">
                        
                        <tr>
                        
                        <th><input class='check_all' type='checkbox' onclick="select_all()"/ title="Delete All Row"></th>
                        
                        <!-- <th>Sr.No.</th> -->
                        
                        <th style="text-align: center;">User Access</th>
                        
                        <th style="text-align: center;">Sequance Access</th>
                        
                        </tr>
                        <?php if($button=='Save') { ?>
                        <tr class="useful">
                        
                        <td class="tdthtablebordr"><input type='checkbox' name="checkname" class='case' disabled="" title="Delete Single Row" /></td>
                        
                        
                        <td class="tdthtablebordr" style="text-align: center;">
                        <input list="userAccess1" class="debitcreditbox dr_amount inputboxclr"  id='userhead1' name="userhead[]" style="width: 80px;" onchange='GetAccessName(1)'/>
                        
                        <datalist id="userAccess1">
                        
                        <option value=''></option>
                        
                        <?php foreach ($approve_ind as $key) { ?>
                        
                        <option value="{{ $key->approve_code}}" data-xyz="{{ $key->approve_name}}">{{ $key->approve_code}} [{{ $key->approve_name}}]</option>
                        
                        <?php } ?>
                        
                        </datalist>
                        
                        <input type="text" name="access_name[]" id="access_name1" value="">
                        
                        </td>
                        
                        <td class="tdthtablebordr" style="text-align: center;">
                        
                        <input type='text' class="debitcreditbox inputboxclr cr_amount" id='usersequance1' name="usersequance[]" value="1" style="width: 41px;margin-bottom: 5px;" readonly="" />
                        
                        </td>
                        
                        </tr>
                        <?php } ?>
                        
                        <?php if($button=='Update') { ?>
                        
                        <?php  $count = count($config_approve_data);


                          ?>
                        
                        <?php if($count > 0) { ?>
                        <?php $i=1;  foreach($config_approve_data as $row) { 
                        
                        
                        ?>
                        <tr class="useful">
                        
                        <td class="tdthtablebordr"><input type='checkbox' name="checkname"  class='case' title="Delete Single Row" /></td>
                        
                        
                        <td class="tdthtablebordr" style="text-align: center;">
                        <!--  <input list="userAccess1" class="debitcreditbox dr_amount inputboxclr"  id='userhead1' name="userhead[]" style="width: 80px;" onchange='GetAccessName(1)'/> -->
                        
                        <!--  <datalist id="userAccess1"> -->
                        
                        <select class="debitcreditbox dr_amount inputboxclr"  id='userhead1' name="userhead[]" style="width: 80px;" onchange='GetAccessName(<?= $i; ?>)'>
                        
                        <option value=''></option>
                        
                        <?php foreach ($approve_ind as $key) { ?>
                        
                        <option value="{{ $key->approve_code}}" data-xyz="{{ $key->approve_name}}" <?php if($key->approve_code == $row->APPROVE_IND){echo 'selected';} ?>>{{ $key->approve_code}}</option>
                        
                        <?php } ?>
                        </select>
                        <!-- </datalist> -->
                        <input type="text" name="access_name[]" id="access_name1" value="{{ $row->ACCESS_NAME }}">
                        
                        
                        </td>
                        
                        <td class="tdthtablebordr" style="text-align: center;">
                        
                        <input type='text' class="debitcreditbox inputboxclr cr_amount" id='usersequance1' name="usersequance[]" value="{{ $row->LAVEL_NAME }}" style="width: 41px;margin-bottom: 5px;" readonly="" />
                        
                        </td>
                        
                        </tr>
                        
                        <?php $i++; }  ?>
                        
                        <?php }else {  ?>
                        <tr class="useful">
                        
                        <td class="tdthtablebordr"><input type='checkbox' name="checkname" class='case' disabled="" title="Delete Single Row" /></td>
                        
                        
                        <td class="tdthtablebordr" style="text-align: center;">
                        <input list="userAccess1" class="debitcreditbox dr_amount inputboxclr"  id='userhead1' name="userhead[]" style="width: 80px;" onchange='GetAccessName(1)'/>
                        
                        <datalist id="userAccess1">
                        
                        <option value=''></option>
                        
                        <?php foreach ($approve_ind as $key) { ?>
                        
                        <option value="{{ $key->approve_code}}" data-xyz="{{ $key->approve_name}}">{{ $key->approve_code}} [{{ $key->approve_name}}]</option>
                        
                        <?php } ?>
                        
                        </datalist>
                        
                        <input type="text" name="access_name[]" id="access_name1" value="">
                        
                        </td>
                        
                        <td class="tdthtablebordr" style="text-align: center;">
                        
                        <input type='text' class="debitcreditbox inputboxclr cr_amount" id='usersequance1' name="usersequance[]" value="1" style="width: 41px;margin-bottom: 5px;" readonly="" />
                        
                        </td>
                        
                        </tr>
                        <?php } }?>
                        
                        </table>
                        
                        </div>
                        <!---- end table---->
                        
                        <button type="button" class='btn btn-danger btn-sm delete' id="deletehidn"><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>
                        
                        <button type="button" class='btn btn-info btn-sm addmore' id="addmorhidn"><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
                        <div class="modal-footer">
                        <button type="button" id="reset" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" disabled id="submitapp1">Save changes</button>
                        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        </div>
                        </div>
                        </div>
                        </div>
                        </div>

            <!--end modal -->


            </form>
 
        </div>


          </div><!-- /.box-body -->



           



          </div>



    



      <div class="col-sm-3">



        <div class="box-tools pull-right hideinmobile">



          <a href="{{ url('/Master/Setting/View-Config-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Config</a>



        </div>



      </div>







    </div>



     



  </section>



</div>







@include('admin.include.footer')

<script type="text/javascript">


  $(document).ready(function() {
    $("#reset").click(function() {
        $("tr td input").val("");
    });
});


function serieskeyup(){

	var series_code = $("#serach_series_code").val();


	if(series_code.trim()==''){

    	$("#series_code_err").html('The series code field is required.sapce not allowed').css('color','red');
    	return false;
    }else{
    	$("#series_code_err").html('');
    }


}
  
  function validate(){

    var gl_code   = $("#gi_code").val();
    var post_code = $("#post_code").val();
    var trans_code = $("#trans_code").val();
    

    


    if(trans_code=='P3' || trans_code=='P5' || trans_code=='S3' || trans_code=='S5'){

      if(gl_code==post_code){
        $("#glText").html('');

      $("#errmsg").html('gl code and post code not same').css('color','red');

      return false;
    }


    }

  }


</script>

<script type="text/javascript">

  function payAdviceSave(trans_code='',series_code='',vrno='',paymentid='',payflag='',payaccCode='',payadviceAmt='',payvrNo=''){

   $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });
      
    

            $.ajax({

              url:"{{ url('get-payment-advice-on-cash-bank') }}",

               method : "POST",

               type: "JSON",

               data: {paymentid:paymentid,trans_code:trans_code,series_code:series_code,payflag:payflag,payaccCode:payaccCode,vrno:vrno,payadviceAmt:payadviceAmt,payvrNo:payvrNo},

               success:function(data){
                 // console.log(data);
                 
                  var obj = JSON.parse(data);
                  //console.log(obj);
               }

               });
}
</script>

<script type="text/javascript">
  $(document).ready(function(){

 $('.allcheckbox').multiselect({
  nonSelectedText: 'Select',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'212px',
  includeSelectAllOption: true,
  maxHeight: 200

  
 });

});
</script>
<script type="text/javascript">



$(document).ready(function(){

    $('.Number').keypress(function (event) {

      var keycode = event.which;

      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {

          event.preventDefault();

      }

  });

 

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
  $(document).ready(function(){
   $("#plant_code").bind('change', function () {  

      var val = $(this).val();
      var Plant_code = '';

      var xyz = $('#plantList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
      // console.log('msg',msg);
      if(msg=='No Match'){
        $(this).val('');
        $('#plant_name').val('');
      }else{
        $('#plant_name').val(msg);
        document.getElementById("plantText").innerHTML = msg; 
        Plant_code = val;
      }



      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

       $.ajax({

            url:"{{ url('Get-Pfct-Code-Name-By-Plant') }}",

            method : "POST",

            type: "JSON",

            data: {Plant_code: Plant_code},

            success:function(data){

              var data1 = JSON.parse(data);
              // console.log('data',data1);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

                }else if(data1.response == 'success'){
                 
                  if(data1.data == ''){
                       var profitctr = '';
                       var pfctget = '';
                       var pfctName = '';
                       $('#pfct_code').val('');
                       $('#pfct_name').val('');
                       document.getElementById("plantText").innerHTML = ''; 
                      
                    }else{
                      $('#pfct_code').val(data1.data[0].PFCT_CODE);
                      $('#pfct_name').val(data1.data[0].PFCT_NAME);
                      document.getElementById("pfctText").innerHTML = data1.data[0].PFCT_NAME; 
                     

                    }

                }

            }

          });

      

  });
  
  $("#trans_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#trnsList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      document.getElementById("transText").innerHTML = msg; 

      if(msg=='No Match'){
        $(this).val('');
        $('#tranName').val('');
        $('#serach_series_code').val('');

      }else{
        $('#tranName').val(msg);

        funGenSeriesCode(val);
      }
      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({

          url:"{{ url('check-post-code-yes-no') }}",

          method : "POST",

          type: "JSON",

          data: {val: val},

          success:function(data){

              var data1 = JSON.parse(data);
            
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                    
              }else if(data1.response == 'success'){

                console.log('data1.data',data1.data);

                  if(data1.data==''){
                  }else{
                      if(data1.data[0].AUTO_POSTCODE == 'YES'){
                        $("#requirdpost").addClass('required-field')
                        $('#PreqMsg').html('Post Code Is Required');
                        $('#btnsubmit').prop('disabled',true);
                      }else{
                        $('#PreqMsg').html('');
                        $('#btnsubmit').prop('disabled',false);
                        $("#requirdpost").removeClass('required-field');
                        $("#post_code").val('');
                        $("#showSeletedName").html('');
                      }
                  }   



              }
           }

      });




  });

  function funGenSeriesCode(val){

    // var getAccName = $('#acc_name').val();
    var tbl_name = 'MASTER_CONFIG';
    var col_code = 'SERIES_CODE';
    
    if(val){

      // var max_chars = 1;
  
      // var element_value ;
      // if(getAccName.length >= max_chars) {
      //   element_value = element.value.substr(0, 1);
      //   element_value = element_value.toUpperCase();
      // }else if(getAccName.length <= max_chars){
      //    $('#acc_code').val('');
      // }else{
      //   $('#acc_code').val('');
      // }
   
      // var acc_type = $('#acctype_code').val();
      // var atype = acc_type.split("[");
      // var acctype_name = atype[0];
     
     

      // var aname = element_value;
      var likename = val;
      
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
              $('#serach_series_code').val(newcode);
            }else{
              $('#serach_series_code').val('');
            }

          }
        }
      }); /* /.ajax*/

    }else{
      $('#serach_series_code').val('');
    } /* /. codn*/
     
  }


  $("#gi_code").on('change', function () {  

          var val = $(this).val();

          var xyz = $('#glList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("glText").innerHTML = msg; 
         $("#errmsg").html('');

          if(msg=='No Match'){

             $(this).val('');
             $('#gl_name').val('');

          }else{

          	$('#gl_name').val(msg);
          }
        

        });

    $("#post_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#postList option').filter(function() {

        return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        document.getElementById("postText").innerHTML = msg; 

        if(msg=='No Match'){

            $(this).val('');
            $('#post_name').val('');
            $('#btnsubmit').prop('disabled',true);

        }else{
            
            $('#post_name').val(msg);
            $('#btnsubmit').prop('disabled',false);
        }
       

    });


   });
</script>

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Series Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var HelpSeriesCode = $('#seriesNameH').val();

           if(HelpSeriesCode == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-seriescode-code-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {HelpSeriesCode: HelpSeriesCode},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Gl Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.series_code+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.series_name+'</td></tr>');
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
    $('#serach_series_code').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });



      var serach_series_code = $('#serach_series_code').val();

        if(serach_series_code.trim() == ''){

				$('#showSearchCodeList').hide();

		

        }else{

       $.ajax({

            url:"{{ url('search-series-oninput') }}",

             method : "POST",

             type: "JSON",

             data: {serach_series_code: serach_series_code},

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
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.series_code+'</span><br>');
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
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script>



<script type="text/javascript">

$(".delete").on('click', function() {

    $('.case:checkbox:checked').parents("tr").remove();

    $('.check_all').prop("checked", false); 

    var sum = 0;


  

});

var i=2;

$(".addmore").on('click',function(){

      var getpaymode = 'To -';

    count=$('table tr').length;
    console.log(count);

    var data="<tr><td class='tdthtablebordr'><input type='checkbox' name='checkname' class='case'/></td>";

    data +="<td class='tdthtablebordr' style='text-align:center;'><div class='input-group'><input list='userAccess"+i+"' class='inputboxclr getacccode' id='userhead"+i+"' name='userhead[]' style='width:80px;margin-left:66px;margin-right: 3px;' onchange='GetAccessName("+i+")'><datalist id='userAccess"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($approve_ind as $key)<option value='<?php echo $key->approve_code?>' data-xyz ='<?php echo $key->approve_name; ?>' ><?php echo $key->approve_code ; echo ' ['.$key->approve_name.']' ; ?></option>@endforeach</datalist><input type='text' id='access_name"+i+"' name='access_name[]'></div></td><td class='tdthtablebordr' style='text-align:center;'><div class='input-group'>&nbsp;<input type='text' class='inputboxclr getacccode' id='usersequance"+i+"' name='usersequance[]' style='width: 41px;margin-bottom: 5px;margin-left: 40px;' value="+count+"></div></td></tr>";

    $('table').append(data);

    i++;



});

//var j=1;


</script>
<script type="text/javascript">
  
   function GetAccessName(accessid){

    var userhead =$("#userhead"+accessid).val();

    console.log('access',userhead);


     var xyz = $('#userAccess'+accessid+' option').filter(function() {

          return this.value == userhead;

          }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

    document.getElementById("access_name"+accessid).value = msg; 

          if(msg=='No Match'){
            
             $(this).val('');
             $("#submitapp1").prop('disabled', true);
             $("#access_name"+accessid).val('');
             $("#usersequance"+accessid).val('');
        

          }else{
           
            $("#submitapp1").prop('disabled', false);

          }

   }

   $("#series_name").on('input',function(){

    var series_name = $(this).val();
    var series_code = $("#serach_series_code").val();
    var trans_code = $("#trans_code").val();

    if(trans_code && series_code && trans_code){

      $("#approvebtn").prop('disabled',false);

    }else{
      $("#approvebtn").prop('disabled',true);
    }

   });
</script>



@endsection