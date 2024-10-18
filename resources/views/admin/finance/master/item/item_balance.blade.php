@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@include('admin.include.navbar')

@include('admin.include.sidebar')


<style type="text/css">

  .required-field::before {
    content: "*";
    color: red;
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

      <h1> Master Item Balance

        <?php if($button=='Save') { ?>

          <small>Add Details</small>

            <?php } else { ?>

              <small>Update Details</small>

            <?php } ?>

        </h1>

        <ol class="breadcrumb">

          <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

          <li><a href="{{ URL('/dashboard')}}">Master</a></li>

        <?php if($button=='Save') { ?>

          <li class="Active"><a href="{{ URL('/finance/tds-rate-mast')}}">Master Item Balance</a></li>

          <li class="Active"><a href="{{ URL('/finance/tds-rate-mast')}}">Add Item Balance</a></li>

        <?php } else { ?>

          <li class="Active"><a href="{{ URL('/finance/edit-tds-rate-mast/'.base64_encode($ItemBalId))}}">Master Item Balance</a></li>

          <li class="Active"><a href="{{ URL('/finance/edit-tds-rate-mast/'.base64_encode($ItemBalId))}}">Update Item Balance</a></li>

        <?php } ?>

        </ol>

    </section>

    <section class="content">

      <div class="row">

        <div class="col-sm-12">

          <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <?php if($button=='Save') { ?>

                <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Master Item Balance</h2>

                <div class="box-tools pull-right">

                  <a href="{{ url('/Master/Item/View-Item-Bal-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Balance</a>

                </div>

             <?php } else{  ?>

                <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Update Master Item Balance</h2>

                <div class="box-tools pull-right">

                  <a href="{{ url('/Master/Item/View-Item-Bal-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Item Balance</a>

                </div>

             <?php } ?>

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

            <form action="{{ url($action) }}" method="POST">

               @csrf

              <?php if($button=='Save') { ?>

               <div class="row">

               

                <input type="hidden" value="{{$trans_head}}" name="trans_head">
                <input type="hidden" value="{{$seriesCode}}" name="seriesCode">
                
                <input type="hidden" value="<?php if(empty($item_legder)){echo $last_num;}else{echo $last_num+1;}?>" name="vrnum">

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>

                        Company Name : 

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="compList" type="text" class="form-control" name="company_name"  id="company_name" placeholder="Select Company Code" value="{{ $company_name }}" maxlength="11" autocomplete="off">

                          <datalist id="compList">
                        
                            <option value="">--SELECT--</option>

                            @foreach($company_data as $key)

                            <option value="{{ $key->COMP_CODE }}" data-xyz ="<?php echo $key->COMP_NAME; ?>" <?php if($company_name==$key->COMP_CODE){ echo 'selected';} ?>> {{ $key->COMP_CODE }} = {{ $key->COMP_NAME }}</option>


                            @endforeach

                          </datalist>

                        </div>

                        <div class="pull-left showSeletedName" id="compText"></div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('company_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label> FY Year : <span class="required-field"></span> </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>

                          <input list="yearList" type="text" class="form-control" name="fy_year" id="fy_year" placeholder="Select Fy Year" value="{{ $fy_year }}" maxlength="12">

                          <datalist id="yearList">

                            <option value="">--SELECT--</option>

                            @foreach($fy_data as $key)

                            <option value="{{ $key->FY_CODE }}" data-xyz ="<?php echo $key->FY_CODE; ?>" <?php if($fy_year==$key->FY_CODE){ echo 'selected';} ?>> {{ $key->FY_CODE }}</option>

                            @endforeach

                           </datalist>

                        </div>

                        <div class="pull-left showSeletedName" id="fyText"></div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('fy_year', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>
                    </div>
                    <!-- /.form-group -->
                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>Plant Name :  <span class="required-field"></span>  </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <?php $plntCount = count($plant_data); ?>

                          <input list="plantList" type="text" class="form-control" name="plant_name" id="plant_name" placeholder="Select Plant Name" value="<?php if($plntCount == 1){echo $plant_data[0]->PLANT_CODE;}else{echo $plant_name;} ?>" maxlength="11" autocomplete="off">

                            <datalist id="plantList">
                           
                              <option value="">--SELECT--</option>

                              @foreach($plant_data as $key)

                                <option value="{{ $key->PLANT_CODE }}" data-xyz ="<?php echo $key->PLANT_NAME; ?>" <?php if($plant_name==$key->PLANT_CODE){ echo 'selected';} ?>> {{ $key->PLANT_CODE }} = {{ $key->PLANT_NAME }}</option>

                              @endforeach

                            </datalist>

                        </div>

                        <div class="pull-left showSeletedName" id="plantText"></div>

                          <small id="emailHelp" class="form-text text-muted">

                              {!! $errors->first('plant_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                        </div>
                    <!-- /.form-group -->
                  </div>

              </div>

              <!-- /.row -->

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                    <label> Item Name : <span class="required-field"></span> </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <?php $itmcount = count($item_data); ?>
                          <input list="itemList" class="form-control" id="item_name" name="item_code" value="<?php if($itmcount == 1){echo $item_data[0]->item_code;}else{echo $item_name;} ?>" placeholder="Select Item Name" maxlength="11" autocomplete="off">

                            <datalist id="itemList">
                              <option value="">--SELECT--</option>

                              @foreach($item_data as $key)

                                <option value="{{ $key->ITEM_CODE }}" data-xyz ="<?php echo $key->ITEM_NAME; ?>" <?php if($item_name==$key->ITEM_CODE){ echo 'selected';} ?>> {{ $key->ITEM_CODE }} = {{ $key->ITEM_NAME }}</option>

                              @endforeach
                    
                            </datalist>

                      </div>
                      <input type="hidden" name="itmName" id="itmName">

                      <div class="pull-left showSeletedName" id="itemText"></div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item_code', '<p class="help-block" style="color:red;">:message</p>') !!}
                         

                        </small>

                      </div>
                    <!-- /.form-group -->

                </div> 

                <div class="col-md-4">

                  <div class="form-group">

                    <label> YROPQTY : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control yropQty" name="YROPQTY" id="yropQty" oninput="CalAQty();" value="{{$YROPQTY}}" placeholder="Enter YROPQTY" maxlength="11">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('YROPQTY', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        <input type="hidden" name="" id="cfactor">

                  </div>
                    <!-- /.form-group -->
                </div> 

                <div class="col-md-4">

                  <div class="form-group">

                    <label>YROPAQTY : <span class="required-field"></span></label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YROPAQTY" id="YROPAQTY" value="{{$YROPAQTY}}" placeholder="Enter YROPAQTY" maxlength="11" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                           {!! $errors->first('YROPAQTY', '<p class="help-block" style="color:red;">:message</p>') !!}


                      </small>

                  </div>

                  <!-- /.form-group -->

                </div>

              </div>
              <!-- /.row -->

              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                    <label>YROPVAL : <span class="required-field"></span></label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YROPVAL" id="YROPVAL" value="{{$YROPVAL}}" placeholder="Enter YROPVAL" maxlength="11">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                           {!! $errors->first('YROPVAL', '<p class="help-block" style="color:red;">:message</p>') !!}


                      </small>

                  </div>

                  <!-- /.form-group -->

                </div>

                <div class="col-md-4">

                  <div class="form-group">

                    <label> Moving Average Value :  </span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-tasks"></i></span>

                          <input type="text" class="form-control" name="moving_avg_val" id="moving_avg_val" value="{{$moving_avg_val}}" placeholder="Enter Moving Average Value">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('moving_avg_val', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                    <!-- /.form-group -->
                </div>

                <div class="col-md-4">

                  <div class="form-group">

                    <label>Standard Price :</span> </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-money"></i></span>

                        <input type="text" class="form-control" name="standard_price" id="standard_price" value="{{$standard_price}}" placeholder="Enter Standard Price" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('standard_price', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <!-- <div class="col-md-4">

                  <div class="form-group">

                    <label>YrQtyRecd : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-money"></i></span>

                        <input type="text" class="form-control" name="yrQtyRecd" id="yrQtyRecd" value="{{$yrQtyRecd}}" placeholder="Enter YrQtyRecd">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('yrQtyRecd', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                  
                </div> -->

              </div>
              <!-- /.row -->

              <!-- <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                    <label>YrAQtyRecd : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-money"></i></span>

                        <input type="text" class="form-control" name="yrAQtyRecd" id="yrAQtyRecd" value="{{$yrAQtyRecd}}" placeholder="Enter YrAQtyRecd">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('yrAQtyRecd', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                  
                </div>

                <div class="col-md-4">

                  <div class="form-group">

                    <label>YrQtyIssued : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-money"></i></span>

                        <input type="text" class="form-control" name="yrQtyIssued" id="yrQtyIssued" value="{{$yrQtyIssued}}" placeholder="Enter YrQtyIssued">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('yrQtyIssued', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                  
                </div>

                <div class="col-md-4">

                  <div class="form-group">

                    <label>YrAQtyIssue : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-money"></i></span>

                        <input type="text" class="form-control" name="yrAQtyIssue" id="yrAQtyIssue" value="{{$yrAQtyIssue}}" placeholder="Enter YrAQtyIssue">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('yrAQtyIssue', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                  
                </div>

              </div> -->

              <!-- <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                    <label>YrQtyBlock :</label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-money"></i></span>

                        <input type="text" class="form-control" name="yrQtyBlock" id="yrQtyBlock" value="{{$yrQtyBlock}}" placeholder="Enter YrQtyBlock">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('yrQtyBlock', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                 
                </div>

                <div class="col-md-4">

                  <div class="form-group">

                    <label>BlockQty : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-money"></i></span>

                        <input type="text" class="form-control" name="BlockQty" id="BlockQty" value="{{ $BlockQty}}" placeholder="Enter BlockQty">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('BlockQty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                 
                </div>
                <div class="col-md-4">

                  <div class="form-group">

                    <label>BlockAQty : </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-money"></i></span>

                        <input type="text" class="form-control" name="BlockAQty" id="BlockAQty" value="{{ $BlockAQty }}" placeholder="Enter BlockAQty">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('BlockAQty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                  
                </div>
                
              </div> -->

          <?php } ?>

          
<?php if(isset($button)){ if($button=='Update') { ?>


              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                      <label> Company Name :  <span class="required-field"></span> </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                          <input list="compList" type="text" class="form-control" name="company_name" placeholder="Select Company Name" value="{{ $company_name }}" maxlength="11" readonly autocomplete="off">

                          <datalist id="compList">

                            <option value="">--SELECT--</option>

                            @foreach($company_data as $key)

                             <option value="{{ $key->COMP_CODE }}" <?php if($company_name==$key->COMP_CODE){ echo 'selected';} ?>> {{ $key->COMP_CODE }} = {{ $key->COMP_NAME }}</option>

                            @endforeach

                          </datalist>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('company_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                    </div>

                    <!-- /.form-group -->

                </div>

                <div class="col-md-4">

                  <div class="form-group">

                    <label> FY Year :  <span class="required-field"></span>  </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-calendar-check-o"></i></span>

                        <input list="yearList" type="text" class="form-control" name="fy_year" id="fy_year" placeholder="Select Fy Year" value="{{ $fy_year }}" maxlength="11" readonly> 

                        <datalist id="yearList">

                          <option value="">--SELECT--</option>

                          @foreach($fy_data as $key)

                            <option value="{{ $key->FY_CODE }}" <?php if($fy_year==$key->FY_CODE){ echo 'selected';} ?>> {{ $key->FY_CODE }}</option>

                          @endforeach

                        </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('fy_year', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-4">

                  <div class="form-group">

                    <label> Plant Name : <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                        <input list="plantList" type="text" class="form-control" name="plant_name" placeholder="Select Plant Name" value="{{ $plant_name}}" maxlength="11" readonly>

                        <datalist id="plantList">

                          <option value="">--SELECT--</option>

                          @foreach($plant_data as $key)

                             <option value="{{ $key->PLANT_CODE }}"> {{ $key->PLANT_CODE }} = {{ $key->PLANT_NAME }}</option>

                          @endforeach

                        </datalist>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                          {!! $errors->first('plant_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>
                  <!-- /.form-group -->

                </div>

            </div>

            <div class="row">
            
              <div class="col-md-4">

                <div class="form-group">

                  <label>Item Name : <span class="required-field"></span> </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc"></i></span>

                      <input list="itemList" class="form-control" id="item_name" name="item_name" value="{{ $item_name }}" placeholder="Select Item Name" maxlength="11" readonly>

                      <datalist id="itemList">

                        <option value="">--SELECT--</option>

                        @foreach($item_data as $key)

                          <option value="{{ $key->ITEM_CODE }}"> {{ $key->ITEM_CODE }} = {{ $key->ITEM_NAME }}</option>

                        @endforeach

                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('item_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>

                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>YROPQTY :  <span class="required-field"></span>  </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                      <input type="text" class="form-control yropQty" name="YROPQTY" id="yropQty1" value="{{$YROPQTY}}"  oninput="CalAQtyup();" placeholder="Enter YROPQTY">

                    </div> 

                    <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('YROPQTY', '<p class="help-block" style="color:red;">:message</p>') !!}

                    </small>
                    <input type="hidden" name="" id="cfactor1">

                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">

                  <div class="form-group">

                    <label>YROPAQTY : <span class="required-field"></span></label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control" name="YROPAQTY" id="YROPAQTY1" value="{{$YROPAQTY}}" placeholder="Enter YROPAQTY" maxlength="11" readonly>

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                           {!! $errors->first('YROPAQTY', '<p class="help-block" style="color:red;">:message</p>') !!}


                      </small>

                  </div>

                  <!-- /.form-group -->

                </div>

            </div>
            <!-- /.row -->

            <div class="row">

              <div class="col-md-4">

                <div class="form-group">

                  <label> YROPVAL :  <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                    <input type="text" class="form-control" name="YROPVAL" id="YROPVAL" value="{{$YROPVAL}}" placeholder="Enter YROPVAL">

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('YROPVAL', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div>
                <!-- /.form-group -->
              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label>Moving Average Value :  </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-tasks"></i></span>

                    <input type="text" class="form-control" name="moving_avg_val" id="moving_avg_val" value="{{$moving_avg_val}}" placeholder="Enter Moving Average Value">

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('moving_avg_val', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                 </div>
                  <!-- /.form-group -->
              </div>

              <div class="col-md-4">

                <div class="form-group">

                  <label> Standard Price : </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-money"></i></span>

                    <input type="text" class="form-control" name="standard_price" id="standard_price" value="{{$standard_price}}" placeholder="Enter Standard Price" readonly>

                  </div> 

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('standard_price', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

                </div>
                <!-- /.form-group -->

              </div>

            </div>
              <!-- /.row -->

           
            <!-- /.row -->

           
            
<?php } }?>











              <div style="text-align: center;">





                <input type="hidden" name="ItemBalId" value="{{$ItemBalId}}">

                 <button type="Submit" class="btn btn-primary">



                 



                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; {{$button}} 







                 </button>







              </div>







            </form>







          </div><!-- /.box-body -->







           







          </div>







      </div>
















    </div>







     







  </section>







</div>



@include('admin.include.footer')


<script type="text/javascript">


  $( window ).on( "load", function() {

    var itemC = $('#item_name').val();


      $.ajaxSetup({

              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

            $.ajax({

                  url:"{{ url('get-cfactor-by-item') }}",

                  method : "POST",

                  type: "JSON",

                  data: {itemC: itemC},

                  success:function(data){

                      var data1 = JSON.parse(data);
                    
                      if (data1.response == 'error') {

                          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                            
                      }else if(data1.response == 'success'){

                          if(data1.data==''){
                             $('#cfactor').val('');
                             $('#cfactor1').val('');
                          }else{
                            $('#cfactor').val(data1.data.AUM_FACTOR);
                            $('#cfactor1').val(data1.data.AUM_FACTOR);
                          }  

                      }
                   }

            });


  });



  $(document).ready(function() {



    $('.datepicker').datepicker({



        format: 'yyyy-mm-dd',



        orientation: 'bottom',



        todayHighlight: 'true',



        endDate: 'today',

        

        autoclose:'true'



    });



  });



</script>

<script type="text/javascript">
  
   $(document).ready(function(){

    $("#YROPVAL").on('input', function () {  

      var yropval = $(this).val();
      var yropqty = $('.yropQty').val();

      if(yropval){

        var stndprice = parseInt(yropval) / parseInt(yropqty);


        $("#standard_price").val(stndprice.toFixed(2));


      }else{
        $("#standard_price").val('');
      }


    })

});
</script>


<script type="text/javascript">
  $(document).ready(function(){

    $("#company_name").bind('change', function () {  

          var val = $(this).val();


          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("compText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

    });


    $("#fy_year").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#yearList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("fyText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

    });

    $("#plant_name").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#plantList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("plantText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

    });

    $("#item_name").bind('change', function () {  

          var itemC = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == itemC;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         document.getElementById("itemText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
             $('#cfactor').val('');
             $('#itmName').val('');
          }else{
            $('#itmName').val(msg);
            $.ajaxSetup({

              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

            $.ajax({

                  url:"{{ url('get-cfactor-by-item') }}",

                  method : "POST",

                  type: "JSON",

                  data: {itemC: itemC},

                  success:function(data){

                      var data1 = JSON.parse(data);
                    
                      if (data1.response == 'error') {

                          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
                            
                      }else if(data1.response == 'success'){

                          if(data1.data==''){
                             $('#cfactor').val('');
                          }else{
                            $('#cfactor').val(data1.data.AUM_FACTOR);
                          }  

                      }
                   }

            });

          }

    });


   });

    function CalAQty(){
     var quantity =$('#yropQty').val();
      var cfactor = $('#cfactor').val();
      var total = quantity * cfactor;

      $('#YROPAQTY').val(total.toFixed(2));

      if(quantity){
      }else{
         $('#YROPAQTY').val(0);
      }
    
    }

     function CalAQtyup(){

      var quantityup =$('#yropQty1').val();
      var cfactorup = $('#cfactor1').val();
      var totalup = quantityup * cfactorup;
      console.log('quantityup',totalup);

      $('#YROPAQTY1').val(totalup.toFixed(2));

      if(quantityup){
      }else{
         $('#YROPAQTY1').val(0);
      }
    
    }



</script>



@endsection