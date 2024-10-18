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



    border-radius: 10px;



*/    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);



  }


.showinmobile{
  display: none;
}
.arrow{
  left: 59.4828%;
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

.panel-heading {
    padding: 0px 0px !important;
    border-bottom: none !important;
    border-top-left-radius: 3px !important;
    border-top-right-radius: 3px !important;
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



            Master Asset 



            <small> Add Details</small>



          </h1>



          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Master</a></li>

            <li class="active"><a href="{{ url('Master/Asset/Asset-Master') }}">Master Asset </a></li>

            <li class="active"><a href="{{ url('Master/Asset/Asset-Master') }}">Master Asset Master</a></li>

            <li class="active"><a href="{{ url('Master/Asset/Asset-Master') }}">Add Asset Master</a></li>


          </ol>

        </section>



	<section class="content">



    <div class="row">


      <div class="col-sm-11">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Asset Master </h2>

              <div class="box-tools pull-right showinmobile">

                <a href="{{ url('Master/Asset/View-Asset-Master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Asset Master</a>

              </div>

              <div class="box-tools pull-right">


                  <a href="{{ url('Master/Asset/View-Asset-Master') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Asset List</a>


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



            <form action="{{ url('Master/Asset/Save-Asset-Master') }}" method="POST" >

               @csrf

    <div class="row">
      <div class="col-md-12">
        <div class="panel with-nav-tabs panel-info">
          <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active" id="firstTab">
                  <a href="#tab1info" id="basicInfo" data-toggle="tab">Basic Info</a>
                </li>
                <li id="secondTab">
                  <a href="#tab2info" data-toggle="tab" >Purchase Details</a>
                </li>
                <li id="thirdTab">
                  <a href="#tab3info" data-toggle="tab" >Other Details</a>
                </li>
            </ul>
          </div>
          <div class="panel-body">
            <div class="tab-content">
              <div class="tab-pane fade in active" id="tab1info">

               <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Asset Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                           <input type="text" class="form-control codeCapital" name="asset_code" id="asset_code" value="{{ old('asset_code')}}" placeholder="Enter Asset Code" maxlength="6" autocomplete="off">


                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                        

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('asset_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Asset Name : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input type="text" class="form-control" name="asset_name" id="asset_name" value="{{ old('asset_name')}}" placeholder="Enter Asset Name" maxlength="40" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('asset_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Plant Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="plantList" id="plant_code" name="plant_code" class="form-control  pull-left" value="{{ old('plant_code')}}" placeholder="Enter Plant Code" onchange="getpfctByPlant()" autocomplete="off" maxlength="6"><br>

                              <input type="hidden" list="plantList" id="plant_name" name="plant_name" class="form-control  pull-left" value="{{ old('plant_name')}}" placeholder="Enter Plant Name" autocomplete="off" maxlength="6" readonly>


                            <datalist id='plantList'>
                              <?php foreach($plant_list as $key) { ?>

                              <option value='<?= $key->PLANT_CODE; ?>' data-xyz='<?= $key->PLANT_NAME ?>'>{{ $key->PLANT_NAME }}</option>

                              <?php } ?>
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('plant_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>


                </div>

                <!-- /.col -->

              <!-- /.row -->

              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        PFCT Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="pfctList" id="pfct_code" name="pfct_code" class="form-control  pull-left" value="{{ old('pfct_code')}}" placeholder="Enter PFCT Code" autocomplete="off" maxlength="6" readonly><br>

                            <input type="hidden" list="pfctList" id="pfct_name" name="pfct_name" class="form-control  pull-left" value="{{ old('pfct_name')}}" placeholder="Enter PFCT Name" autocomplete="off" maxlength="6" readonly>


                            <datalist id='pfctList'>
                              <?php foreach($pfct_list as $key) { ?>

                              <option value='<?= $key->PFCT_CODE; ?>' data-xyz='<?= $key->PFCT_NAME; ?>'>{{ $key->PFCT_NAME }}</option>

                              <?php } ?>
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('pfct_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Asset Group Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="groupList" id="asgroup_code" name="asgroup_code" class="form-control  pull-left" value="{{ old('asgroup_code')}}" placeholder="Enter Group Code" autocomplete="off" maxlength="6" onchange="assetGroup(this.value)"><br>

                            <input type="hidden" list="groupList" id="asgroup_name" name="asgroup_name" class="form-control  pull-left" value="{{ old('asgroup_name')}}" placeholder="Enter Group Name" autocomplete="off" maxlength="6" readonly>


                            <datalist id='groupList'>
                              <?php foreach($asgroup_list as $key) { ?>

                              <option value='<?= $key->ASGROUP_CODE ?>' data-xyz='<?= $key->ASGROUP_NAME ?>'>{{ $key->ASGROUP_NAME }}</option>

                              <?php } ?>
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('asgroup_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                          <small id="errorItem"></small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Asset Class Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="asclassList" id="asclass_code" name="asclass_code" class="form-control  pull-left" value="{{ old('asclass_code')}}" placeholder="Enter Class Code" autocomplete="off" maxlength="6"><br> 

                             <input type="hidden" list="asclassList" id="asclass_name" name="asclass_name" class="form-control  pull-left" value="{{ old('asclass_name')}}" placeholder="Enter Class Name" autocomplete="off" maxlength="6" readonly>



                            <datalist id='asclassList'>
                              <?php foreach($asclass_list as $key) { ?>

                              <option value='<?= $key->ASCLASS_CODE ?>' data-xyz='<?= $key->ASCLASS_NAME ?>'>{{ $key->ASCLASS_NAME }}</option>

                              <?php } ?>
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('asclass_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

              </div>
              <!-- /.row -->



              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Asset Category Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="ascagegoryList" id="ascategory_code" name="ascategory_code" class="form-control  pull-left" value="{{ old('ascategory_code')}}" placeholder="Enter Category Code" autocomplete="off" maxlength="6"><br>  

                           <input type="hidden" list="ascagegoryList" id="ascategory_name" name="ascategory_name" class="form-control  pull-left" value="{{ old('ascategory_name')}}" placeholder="Enter Category Name" autocomplete="off" maxlength="6" readonly>


                            <datalist id='ascagegoryList'>
                              <?php foreach($ascategory_list as $key) { ?>

                              <option value='<?= $key->ASCATG_CODE ?>' data-xyz='<?= $key->ASCATG_NAME ?>'>{{ $key->ASCATG_NAME }}</option>

                              <?php } ?>
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('ascategory_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Asset No: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                           <input type="text" class="form-control" name="asset_no" id="asset_no" value="{{ old('asset_no')}}" placeholder="Enter Asset Number" maxlength="15" autocomplete="off">


                          <div class="custom-select">
                            <div id="showSearchCodeList" class="custom-options">
                          
                            </div>  
                          </div>
                        

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('asset_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Cost Center : 

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="costcenterList" id="cost_center" name="cost_center" class="form-control  pull-left" value="{{ old('cost_center')}}" placeholder="Enter Cost Center" autocomplete="off" maxlength="6"><br>  

                            <input type="hidden" list="costcenterList" id="cost_center_name" name="cost_center_name" class="form-control  pull-left" value="{{ old('cost_center_name')}}" placeholder="Enter Cost Center Name" autocomplete="off" maxlength="6" readonly>


                            <datalist id='costcenterList'>
                              <?php foreach($costcenter_list as $key) { ?>

                              <option value='<?= $key->COST_CODE ?>' data-xyz='<?= $key->COST_NAME ?>'>{{ $key->COST_NAME }}</option>

                              <?php } ?>
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('cost_center', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

              </div>
              <!-- /.row -->
              
              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        GL Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="emplList" id="gl_code" name="gl_code" class="form-control  pull-left" value="{{ old('ascategory_code')}}" placeholder="Enter GL Code" autocomplete="off" maxlength="6"><br>

                             <input type="hidden" list="emplList" id="gl_name" name="gl_name" class="form-control  pull-left" value="{{ old('ascategory_name')}}" placeholder="Enter GL Name" autocomplete="off" maxlength="6" readonly>


                            <datalist id="emplList">

                              <option selected="selected" value="">-- Select --</option>

                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('gl_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Dep. Code: 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="depcodeList" id="dep_code" name="dep_code" class="form-control  pull-left" value="{{ old('dep_code')}}" placeholder="Enter Dep. Code" autocomplete="off" maxlength="6">


                            <datalist id='depcodeList'>
                              <?php foreach($dep_list as $key) { ?>

                              <option value='<?= $key->DEP_CODE ?>' data-xyz='<?= $key->DEP_CODE ?>'>{{ $key->DEP_CODE }}</option>

                              <?php } ?>
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('dep_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Item Code: 

                      </label>

                        <div class="input-group">

                            <div class="input-group-addon">

                              <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                            </div>

                            <input list="itemList" id="item_code" name="item_code" class="form-control  pull-left" value="{{ old('item_code')}}" placeholder="Enter Item Code" autocomplete="off" maxlength="16"><br> 

                            <input type="hidden" list="itemList" id="item_name" name="item_name" class="form-control  pull-left" value="{{ old('item_name')}}" placeholder="Enter Item Name" autocomplete="off" maxlength="16" readonly>



                            <datalist id='itemList'>
                              <?php foreach($item_list as $key) { ?>

                              <option value='<?= $key->ITEM_CODE ?>' data-xyz='<?= $key->ITEM_NAME ?>'>{{ $key->ITEM_NAME }}</option>

                              <?php } ?>
                            </datalist>

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

              </div>

              </div> <!-- /.tab first -->


              <div class="tab-pane fade" id="tab2info">

                  <div class="row">

                    <div class="col-md-4">

                      <div class="form-group">

                        <label>

                         Purchase Date: 

                        </label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-calendar" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="pur_date" name="pur_date" class="form-control  pull-left" value="{{ old('pur_date')}}" placeholder="Select Purchase Date" autocomplete="off" maxlength="6">

                          </div>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('pur_date', '<p class="help-block" style="color:red;">:message</p>') !!}
                            </small>

                      </div>
                    <!-- /.form-group -->
                    </div>


                    <div class="col-md-4">

                      <div class="form-group">

                        <label>

                          Purchase Acc. Code: 

                        </label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                              </div>

                              <input list="accList" id="acc_code" name="acc_code" class="form-control  pull-left" value="{{ old('acc_code')}}" placeholder="Enter Account Code" autocomplete="off" maxlength="6"><br>

                              <input type="hidden" list="accList" id="acc_name" name="acc_name" class="form-control  pull-left" value="{{ old('acc_name')}}" placeholder="Enter Account Name" autocomplete="off" maxlength="6" readonly>


                              <datalist id='accList'>
                                <?php foreach($acc_list as $key) { ?>

                                <option value='<?= $key->ACC_CODE ?>' data-xyz='<?= $key->ACC_NAME ?>'>{{ $key->ACC_NAME }}</option>

                                <?php } ?>
                              </datalist>

                          </div>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                            </small>

                      </div>
                    <!-- /.form-group -->
                    </div>

                    <div class="col-md-4">

                      <div class="form-group">

                        <label>

                          Purchase Rate : 

                        </label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="pur_rate" name="pur_rate" class="form-control  pull-left" value="{{ old('pur_rate')}}" placeholder="Enter Purchase Rate" autocomplete="off" maxlength="11">


                          </div>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('pur_rate', '<p class="help-block" style="color:red;">:message</p>') !!}
                            </small>

                      </div>
                    <!-- /.form-group -->
                    </div>

                  </div>

                  <div class="row">
                    
                    <div class="col-md-4">

                      <div class="form-group">

                        <label>

                          Purchase Amount : 

                        </label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="pur_amt" name="pur_amt" class="form-control  pull-left" value="{{ old('pur_amt')}}" placeholder="Enter Purchase Amount" autocomplete="off" maxlength="11">


                          </div>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('pur_amt', '<p class="help-block" style="color:red;">:message</p>') !!}
                            </small>

                      </div>
                    <!-- /.form-group -->
                    </div>

                    <div class="col-md-4">

                      <div class="form-group">

                        <label>

                          Purchase Qty. : 

                        </label>

                          <div class="input-group">

                              <div class="input-group-addon">

                                <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                              </div>

                              <input type="text" id="pur_qty" name="pur_qty" class="form-control  pull-left" value="{{ old('pur_qty')}}" placeholder="Enter Purchase Qty" autocomplete="off" maxlength="9">


                          </div>

                            <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('pur_qty', '<p class="help-block" style="color:red;">:message</p>') !!}
                            </small>

                      </div>
                    <!-- /.form-group -->
                    </div>

                  </div>

                </div>

                <div class="tab-pane fade" id="tab3info">

                  <div class="row">

                      <div class="col-md-4">

                        <div class="form-group">

                          <label>

                            Capitalize On Date : 

                            <span class="required-field"></span>

                          </label>

                            <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-calendar" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="pur_cod" name="pur_cod" class="form-control  pull-left" value="{{ old('pur_cod')}}" placeholder="Enter Capitalize On Date" autocomplete="off" maxlength="10">


                            </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('pur_cod', '<p class="help-block" style="color:red;">:message</p>') !!}
                              </small>

                        </div>
                    <!-- /.form-group -->
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                          <label>

                            ASEOD Date : 

                            <span class="required-field"></span>

                          </label>

                            <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-calendar" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="ASEOD" name="ASEOD" class="form-control  pull-left" value="{{ old('ASEOD')}}" placeholder="Enter ASEOD Date" autocomplete="off" maxlength="10">


                            </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('ASEOD', '<p class="help-block" style="color:red;">:message</p>') !!}
                              </small>

                        </div>
                    <!-- /.form-group -->
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                          <label>

                            Location : 

                            <span class="required-field"></span>

                          </label>

                            <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-map-marker" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="location" name="location" class="form-control  pull-left" value="{{ old('location')}}" placeholder="Enter Location" autocomplete="off" maxlength="9">


                            </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('location', '<p class="help-block" style="color:red;">:message</p>') !!}
                              </small>

                        </div>
                    <!-- /.form-group -->
                    </div>

                    

                  </div>

                  <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">

                          <label>

                            Manufacture : 

                          </label>

                            <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="as_mfg" name="as_mfg" class="form-control  pull-left" value="{{ old('as_mfg')}}" placeholder="Enter Manufacture" autocomplete="off" maxlength="9">


                            </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('as_mfg', '<p class="help-block" style="color:red;">:message</p>') !!}
                              </small>

                        </div>
                    <!-- /.form-group -->
                    </div>
                    
                    <div class="col-md-4">

                        <div class="form-group">

                          <label>

                            Made In : 

                          </label>

                            <div class="input-group">

                                <div class="input-group-addon">

                                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                                </div>

                                <input type="text" id="as_madeIn" name="as_madeIn" class="form-control  pull-left" value="{{ old('as_madeIn')}}" placeholder="Enter Manufacture" autocomplete="off" maxlength="9">


                            </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('as_madeIn', '<p class="help-block" style="color:red;">:message</p>') !!}
                              </small>

                        </div>
                    <!-- /.form-group -->
                    </div>

                    <div class="col-md-4">

                        <div class="form-group">

                          <label>

                            Old Asset : 

                          </label>

                            <div class="form-check">

                                <input class="form-check-input" type="radio" value="YES" name="old_asset" id="old_asset">

                                <label class="form-check-label" for="flexRadioDefault1">
                                  Yes
                                </label>
                                &nbsp;&nbsp;&nbsp;
                                 <input class="form-check-input" type="radio" value="NO" name="old_asset" id="old_asset" checked>

                                 <label class="form-check-label" for="flexRadioDefault2">
                                  No
                                </label>


                            </div>

                              <small id="emailHelp" class="form-text text-muted">

                                {!! $errors->first('as_madeIn', '<p class="help-block" style="color:red;">:message</p>') !!}
                              </small>

                        </div>
                    <!-- /.form-group -->
                    </div>

                  </div>  
                </div>

              </div>
          </div>
        </div>
      </div>
    </div>

    <!-- /.Tab Panel End -->


              <!-- /.row -->

              <div style="text-align: center;">

                 <button type="Submit" class="btn btn-primary">

                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save
                 </button>

              </div>

            </form>

          </div><!-- /.box-body -->

        </div>

      </div>

      <div class="col-sm-1"></div>

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

  });

});

function getpfctByPlant(){

    var Plcode =  $('#plant_code').val();
    var xyz = $('#plantList option').filter(function() {
      return this.value == Plcode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
      $('#plant_code').val('');
      $('#pfct_code').val('');
    }else{
    }

    $.ajaxSetup({
          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    var Plant_code =  $('#plant_code').val();
    var pfctdataURL = "{{ url('Get-Pfct-Code-Name-By-Plant') }}";

    $.ajax({

      url:pfctdataURL,

      method : "POST",

      type: "JSON",

      data: {Plant_code: Plant_code},

      success:function(data){

        var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

            if(data1.data == ''){
                 var profitctr = '';
                 var pfctName = '';
                 $('#pfct_code').val(profitctr);
                 //$('#pfct_name').val(pfctName);
              }else{
                $('#pfct_code').val(data1.data[0].PFCT_CODE);
               // $('#pfct_name').val(data1.data[0].PFCT_NAME);
              }


          }

      }

    });

}

</script>

<script type="text/javascript">

  $(document).ready(function(){


      $("#plant_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#plantList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#plant_name").val('');
        }else{
          $("#plant_name").val(msg);
        }


      });




       $("#pfct_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#pfctList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#pfct_name").val('');
        }else{
          $("#pfct_name").val(msg);
        }


      });



       $("#asgroup_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#groupList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#asgroup_name").val('');
        }else{
          $("#asgroup_name").val(msg);
        }


      });



      $("#asclass_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#asclassList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#asclass_name").val('');
        }else{
          $("#asclass_name").val(msg);
        }


      });



      $("#ascategory_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#ascagegoryList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#ascategory_name").val('');
        }else{
          $("#ascategory_name").val(msg);
        }


      });


      $("#cost_center").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#costcenterList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#cost_center_name").val('');
        }else{
          $("#cost_center_name").val(msg);
        }


      });




       $("#gl_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#emplList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#gl_name").val('');
        }else{
          $("#gl_name").val(msg);
        }


      });


      
      $("#item_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#itemList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#item_name").val('');
        }else{
          $("#item_name").val(msg);
        }


      });


       $("#acc_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#accList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#acc_name").val('');
        }else{
          $("#acc_name").val(msg);
        }


      });







    });

  function assetGroup(asgroupCode){

    var ASGROUPCODE = asgroupCode;
   

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('get-gl-by-asgroupcode') }}",

          method : "POST",

          type: "JSON",

          data: {ASGROUPCODE: ASGROUPCODE},

          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $("#emplList").empty();

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  
                  $.each(data1.data, function(k, getData){

                    $("#emplList").empty();

                    $("#emplList").append($('<option>',{

                      value:getData.GL_CODE,

                      'data-xyz':getData.GL_NAME,
                      text:getData.GL_NAME

                    }));

                  });

              }

          }

    });

}


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
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Acc Class Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var AccClsHelp = $('#AccClsHelp').val();

           if(AccClsHelp == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-AccCode-getdata') }}",

                 method : "POST",

                 type: "JSON",

                 data: {AccClsHelp: AccClsHelp},

                 success:function(data){

                      var data1 = JSON.parse(data);

                      if (data1.response == 'error') {
                           $('#HideWhenSearch').hide();
                           $('#ShowWhenSeaech').hide();
                           $('#ShowWhenSeaech').empty();

                          $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'>Acc Class Code Not Found...!</p>");

                      }else if(data1.response == 'success'){

                          $('#errorItem').html('');

                           var objcity = data1.data;

                             $('#HideWhenSearch').hide();
                             $('#ShowWhenSeaech').show();
                             $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<tr><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ACLASS_CODE+'</td><td style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.ACLASS_NAME+'</td></tr>');
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
    $('#AccClassSearch').on('keyup',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var AccClassSearch = $('#AccClassSearch').val();

        if(AccClassSearch == ''){

           $('#showSearchCodeList').hide();

        }else{

       $.ajax({

            url:"{{ url('search-acc-class-get') }}",

             method : "POST",

             type: "JSON",

             data: {AccClassSearch: AccClassSearch},

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
                            objcity.ACLASS_CODE+'</span><br>');
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

  $(document).ready(function() {
    

    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();
    var crDate = ((''+day).length<2 ? '0' : '') + day + '-' +
        ((''+month).length<2 ? '0' : '') + month + '-' + d.getFullYear();
    var mm = month - 1;
    var newDt = '01-'+ ((''+month).length<2 ? '0' : '') + mm + '-' + d.getFullYear();
    var defDate = ((''+day).length<2 ? '0' : '') + day + '-' +
        ((''+month).length<2 ? '0' : '') + month + '-' + '9999';

     console.log('mm',defDate);

      $('#pur_date').datepicker({
        format: 'dd-mm-yyyy',
        orientation: 'bottom',
        todayHighlight: 'true',
        autoclose: 'true'
      });

      $('#pur_cod').datepicker({
        format: 'dd-mm-yyyy',
        // startDate:newDt,
        // endDate: '+0d',
        orientation: 'bottom',
        todayHighlight: 'true',
        autoclose: 'true',
      });

      $('#ASEOD').datepicker({
        format: 'dd-mm-yyyy',
        startDate:defDate,
        defaultDate:defDate,
        orientation: 'bottom',
        autoclose: 'true',

      });

  });
</script>

<!-- <script type="text/javascript">
  $('body').on('mouseleave','.popover', function () {
        $(this).hide();
    });
</script> -->







@endsection