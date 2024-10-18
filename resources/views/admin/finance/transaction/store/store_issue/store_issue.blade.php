@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .tooltip{
    color: #66CCFF !important;
  }
  .PageTitle{
    margin-right: 1px !important;
  }
  .required-field::before {
    content: "*";
    color: red;
  }
  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  ::placeholder {
    text-align:left;
  }
  .showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
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
  .inputboxclr{
    border: 1px solid #d7d3d3;
  }
  .tdthtablebordr{
    border: 1px solid #00BB64;
  }
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 2px 5px 2px 5px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
    border-top: 1px solid #83e25c;
  }
  .amntAlign{
    text-align:right;
  }
  .readonlyField{
    background-color: #eeeeee;
  }
  .withpreTran{
    display:none;
  }
  .withoutreTran{
    display:none;
  }
  .headingStyle{
    color: #3c8dbc;
    font-weight: 800;
  }
  .modalTblInput{
    text-align:right;
  }

</style>


<div class="content-wrapper">
        <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      {{ $title }}
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
        <a href="{{ url('/Transaction/Store/Store-Issue') }}"> {{ $title }}</a>
      </li>

    </ul>

  </section>

<form id="storeIssueForm">
  @csrf
  <section class="content">

    <div class="row">
      
      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme"> {{ $title }}</h2>

            <div class="box-tools pull-right">

              <a href="{{ url('Transaction/Store/View-Store-Requistion') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Store Issue.</a>

            </div>

          </div><!-- /.box-header -->

          <div class="box-body">

            <div class="row">

              <div class="col-md-2">

                <div class="form-group">

                  <label>Date: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                    <?php 

                        $CurrentDate =date("d-m-Y");
                           
                        $FromDate    = date("d-m-Y", strtotime($fromDate));  
                           
                        $ToDate      = date("d-m-Y", strtotime($toDate));  
                           
                        $formCurrentDt = date("Y-m-d", strtotime($CurrentDate));

                        if($formCurrentDt > $toDate){
                          $vrDate =$ToDate;
                        }else{
                          $vrDate =$CurrentDate;
                        }

                      ?>

                      <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                      <input type="hidden" name="" value="<?php echo $vrDate; ?>" id="ToDateFy">

                    <input type="text" class="form-control transdatepicker" name="vrDate" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off" onchange="requisition.vrDate()">

                  </div>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> T Code : </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="tranCode" value="{{ $trans_list->TRAN_CODE }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                    </div>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Series Code: 

                    <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                    <span class="input-group-addon" style="padding: 1px 7px;">
                         <i class="fa fa-newspaper-o" aria-hidden="true" ></i>
                    </span>

                    <?php $sriescount =  count($series_list); ?>
                    <input list="seriesList"  id="series_code" name="seriesCode" class="form-control  pull-left" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_CODE;}else{echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries();">

                    <input type="hidden" value="{{ $series_list[0]->POST_CODE }}" id="post_code">

                    <datalist id="seriesList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($series_list as $key)

                        <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Series Name : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="seriesName" value="<?php if($sriescount == 1){echo $series_list[0]->SERIES_NAME;}else{} ?>" id="seriesName" placeholder="Enter Series Name" value="" readonly autocomplete="off">

                    </div>

                </div>
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Vr No: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                    <input type="text" class="form-control" name="vrNo" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                  </div>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Requistion No. : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="reqList" class="form-control" name="req_no" value="" id="req_no" placeholder="Select Requistion No." autocomplete="off" >
                      
                      <datalist id="reqList">

                        <option selected="selected" value="">-- Select --</option>
                        <?php foreach($requstion_list as $row) { 

                          $date    = $row->FY_CODE;
                          $getdata = explode('-', $date);
                        ?>

                        <option value="<?= $getdata[0];?> <?= $row->SERIES_CODE ?> <?= $row->VRNO; ?>" data-xyz="<?= $row->SREQHID;?>"><?= $getdata[0];?> <?= $row->SERIES_CODE ?> <?= $row->VRNO; ?></option>

                      <?php } ?>

                      </datalist>

                    </div>
                    <input type="hidden" name="reqHeadId" id="reqHeadId">
                    <small id="empName" class="showcodename"></small>

                </div>
                
              </div><!-- /.col -->

            </div><!-- /.row -->

            <div class="row">


              <div class="col-md-2">

                <div class="form-group">

                  <label> Job Work Order No: </label>

                  <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                    </div>

                    <input list="orderList" class="form-control" name="job_work_order_no" value="" id="job_work_order_no" placeholder="Select Work Order No." autocomplete="off" onchange="requisition.getItemByReqNum(getitemurl,1)" readonly="">


                    <datalist id="orderList">

                      <option selected="selected" value="">-- Select --</option>
                    <?php foreach($order_list as $row) { 

                        $date    = $row->FY_CODE;
                        $getdata = explode('-', $date);

                        // print_r($getdata);
                      ?>

                      <option value="<?= $getdata[0];?> <?= $row->SERIES_CODE ?> <?= $row->VRNO; ?>"><?= $getdata[0];?> <?= $row->SERIES_CODE ?> <?= $row->VRNO; ?></option>

                    <?php } ?>

                    </datalist>

                  </div>

                  <small id="empName" class="showcodename"></small>

                </div>
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Job Card No. : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="jobcardList" class="form-control" name="job_card_no" value="" id="job_card_no" placeholder="Select Job Card No." autocomplete="off" onchange="requisition.getItemByReqNum(getitemurl,1)">


                      <datalist id="jobcardList">

                        <option selected="selected" value="">-- Select --</option>
                      <?php foreach($jobcard_list as $row) { 

                          $date    = $row->FY_CODE;
                          $getdata = explode('-', $date);

                          // print_r($getdata);
                        ?>

                        <option value="<?= $getdata[0];?> <?= $row->SERIES_CODE ?> <?= $row->VRNO; ?>"><?= $getdata[0];?> <?= $row->SERIES_CODE ?> <?= $row->VRNO; ?></option>

                      <?php } ?>

                      </datalist>

                    </div>

                    <small id="empName" class="showcodename"></small>

                </div>
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Plant Code: <span class="required-field"></span></label>

                  <div class="input-group">

                    <span class="input-group-addon" style="padding: 1px 7px;">
                       <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </span>
                    <?php $plcount = count($plant_list); ?>
                    <input list="PlantcodeList" class="form-control" id="Plant_code" name="plantcode" placeholder="Select Plant" maxlength="11" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_CODE;}?>" autocomplete="off" onchange="getpfctByPlant()">

                    <datalist id="PlantcodeList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($plant_list as $key)

                      <option value='<?php echo $key->PLANT_CODE?>'   data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

                      @endforeach

                    </datalist>

                  </div>

                </div><!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Plant Name : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="plantname" value="<?php if($plcount == 1){echo $plant_list[0]->PLANT_NAME;}?>" id="plantname" placeholder="Enter Profit Plant Name" readonly autocomplete="off">

                    </div>

                </div>
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label>Profit Center Code: <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                      <input list="profitList"  id="profitctrId" name="pfctCode" class="form-control  pull-left" value="" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

                    </div>

                </div> <!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Profit Center Name : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="pfctname" value="" id="pfctName" placeholder="Enter Profit Center Name" readonly autocomplete="off">

                    </div>

                </div>
                
              </div><!-- /.col -->

            

            </div><!-- /.row -->

            <div class="row">

            	  <div class="col-md-2">

                <div class="form-group">

                  <label>Department Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="deptList"  id="dept_code" name="dept_code" class="form-control  pull-left" value="" placeholder="Select Department" 
                      onchange="deptFun()"> 

                      <datalist id="deptList">

                        @foreach ($dept_list as $key)

                        <option value='<?php echo $key->DEPT_CODE?>'   data-xyz ="<?php echo $key->DEPT_NAME; ?>" ><?php echo $key->DEPT_NAME ; echo " [".$key->DEPT_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                </div> <!-- /.form-group -->

              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Department Name : </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="deptname" value="" id="deptname" placeholder="Enter Department Name" readonly autocomplete="off">

                    </div>

                </div>
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Employee Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="emplList" class="form-control" name="emp_code" value="" id="emp_code" placeholder="Enter Employee Code" autocomplete="off">

                      <datalist id="emplList">

                        @foreach ($emp_list as $key)

                        <option value='<?php echo $key->EMP_CODE?>'   data-xyz ="<?php echo $key->EMP_NAME; ?>" ><?php echo $key->EMP_NAME ; echo " [".$key->EMP_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>

                </div>
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Employee Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="emp_name" value="" id="emp_name" placeholder="Enter Employee Name" autocomplete="off" readonly>
                    </div>

                </div>
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Cost Center Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="costList" class="form-control" name="cost_center_code" value="" id="cost_center_code" placeholder="Enter Cost Center Code" autocomplete="off" onchange="costCenterFun()">

                      <datalist id="costList">
                        <?php foreach ($cost_list as $key) { ?>
                          
                        <option value="<?= $key->COST_CODE ?>" data-xyz="<?= $key->COST_NAME ?>"><?= $key->COST_CODE ?> <?= $key->COST_NAME ?></option>

                        <?php } ?>  

                      </datalist>

                    </div>

                </div>
                
              </div><!-- /.col -->

              <div class="col-md-2">

                <div class="form-group">

                  <label> Cost Center Name : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input type="text" class="form-control" name="cost_center_name" value="" id="cost_center_name" placeholder="Enter Cost Center Name" autocomplete="off" readonly="">

                    </div>

                </div>
                
              </div><!-- /.col -->
              
            </div><!-- /.row -->

            <div class="row">
              
            </div><!-- /.row -->

          </div><!-- /.box-body -->

        </div><!-- /.custom-box -->

      </div><!-- /.col-sm-12 -->

    </div><!-- /.row -->

  </section><!-- /.section -->

  <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">
            
            <div class="table-responsive">

              <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

             	<thead>
                  <th><input class='check_all'  type='checkbox' onclick="select_all()"/></th>
                  <th> Sr.No.</th>
                  <th>Item Code</th>
                  <th>Item Name</th>
                  <th>Req. Qty</th>
                  <th>Req. A-Qty</th>
                  <th>Issue Qty</th>
                  <th>Issue A-Qty</th>
                 </thead>

                <tr class="useful">

                  <td class="tdthtablebordr">
                    <input type='checkbox' class='case' id="firstrow1"/>
                  </td>

                  <td class="tdthtablebordr" style="width:5%;">
                    <span id='snum' style="width: 10px;">1.<input type="hidden" name="tblRow[]" value="1"></span>
                  </td> 

                  <td class="tdthtablebordr" style="width:10%;">

                    <div class="input-group">

                      <input type="text" class="inputboxclr withpreTran" id='item_codeWT1' name="itemPo[]" onclick="ShowItemOnModal(1);" oninput="this.value = this.value.toUpperCase()" readonly/>

                      <input list="ItemList1" class="inputboxclr" id='item_codeWOT1' name="item_code[]" onchange="showItemDetails(1)" oninput="this.value = this.value.toUpperCase()" autocomplete="off" />

                      <datalist id="ItemList1">

                          <option selected="selected" value="">-- Select --</option>

                          @foreach ($item_list as $key)

                          <option value='<?php echo $key->ITEM_CODE?>' data-xyz ="<?php echo $key->ITEM_NAME; ?>" ><?php echo $key->ITEM_NAME ; echo " [".$key->ITEM_CODE."]" ; ?></option>

                          @endforeach

                      </datalist>

                      <input list="batchList1" class="inputboxclr" id='batch_no1' name="batch_no[]" oninput="this.value = this.value.toUpperCase()" style="margin-top: 2px;" autocomplete="off" onchange="getBatchQty(1);" />

                      <datalist id="batchList1">
                        
                      </datalist>

                    </div>

                    <!-- <div style="text-align: initial;font-weight: 700;color: #3c8dbc;">Batch Qty : <small id="itembatch_Qty1"></small></div> -->

                    <div><p id="stockavlble1" class="badge" style="background-color:#25b6bd;margin: 3px 0 1px">Batch Qty : <small id="itembatch_Qty1"></small></p>
                       </div>
                      
                    <input type="hidden" id="itmC_code1" name="itemcodeC[]">
                    <input type="hidden" id="selectedItem1">
                    <input type="hidden" id="selectedRowId1">
                    <input type="hidden" id="req_bodyId1" name="req_bodyId[]">
                    <input type="hidden" id="itemPlant1" name="itemPlant">

                  </td>

                  <td class="tdthtablebordr" style="width:55%;">

                    <input type="text" class="inputboxclr" id='item_Name1' name="item_name[]" readonly style="width:100%;" autocomplete="off"/>

                    <textarea id="remark_data1" rows="1" class="inputboxclr" name="remark[]" placeholder="Enter Description" autocomplete="off" style="width:100%;margin-top: 1px;"></textarea>

                  </td>

                  <td class="tdthtablebordr" style="width:10%;"> 

                    <div style="display:flex;">

                      <input type='text' class="inputboxclr amntAlign"  id='req_qty1' name="req_qty[]" readonly style="width:70px;" autocomplete="off"/>
                      <input type="text" name="req_unit_M[]" id="req_UnitM1" class="inputboxclr" readonly style="width:30px;" autocomplete="off">

                    </div>

                  </td>

                  <td class="tdthtablebordr" style="width:10%;">

                    <div style="display:flex;">

                      <input type='text' class="inputboxclr amntAlign"  id='req_A_qty1' name="req_Aqty[]" readonly style="width:70px;" autocomplete="off"/>

                      <input type="text" name="req_add_unit_M[]" id="req_AddUnitM1" class="inputboxclr" readonly style="width:30px;" autocomplete="off">

                    </div>

                  </td>

                  <td class="tdthtablebordr" style="width:10%;">

                    <div style="display:flex;">

                      <input type='text' class="inputboxclr amntAlign"  id='qty1' name="qty[]" oninput="calAQty(1)" style="width:70px;" autocomplete="off"/>
                     
                      <input type="text" name="unit_M[]" id="UnitM1" style="width:30px;" class="inputboxclr" readonly autocomplete="off">

                      <input type="hidden" id="Cfactor1">

                    </div>

                  </td>

                  <td class="tdthtablebordr" style="width:10%;">

                    <div style="display:flex;">

                      <input type='text' class="inputboxclr amntAlign"  id='A_qty1' name="Aqty[]" style="width:70px;" readonly autocomplete="off"/>

                      <input type="text" name="add_unit_M[]" id="AddUnitM1" style="width:30px;" class="inputboxclr" readonly autocomplete="off">

                    </div>

                  </td>
                  
                </tr>
                
              </table><!-- /.table -->

            </div><!-- /.table resonsive -->

            <div class="row">
              
              <div class="col-md-12">
                
                <button type="button" class='btn btn-danger delete' id="deletehidn" style="line-height: 1;padding: 2px 4px;"><i class="fa fa-minus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Delete</button>

                <button type="button" class='btn btn-info addmore' id="addmorhidn" style="line-height: 1;padding: 2px 4px;"><i class="fa fa-plus" aria-hidden="true" style="font-size: 12px;"></i>&nbsp; Add More</button>

              </div><!-- /.col -->

            </div><!-- /.row -->

            <div class="row">

              <div style="text-align: center;">

                <small id="qtyErrMsg"></small>

                <button type="button" class="btn btn-primary" id="submit_data" onclick="submitdata();">

                  <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save

                </button>

                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

              </div>
              
            </div><!-- row -->

          </div><!-- /.box body -->

        </div><!-- /.custom box -->

      </div><!-- /.col -->

    </div><!-- /.row -->
    
  </section><!-- /.section -->

</form>

</div>

<!-- ----- SHOW MODAL WHEN SELECT ISSUE NO & DISPLAY ITEM DETAILE FROM STORE ISSUE ------ -->
  
    <div id="issueItemShow1" class="modal fade" tabindex="-1">

      <div class="modal-dialog modal-lg" style="margin-top: 5%;">

        <div class="modal-content" style="border-radius: 5px;">

          <div class="modal-header" style="padding: 5px;">

            <div class="row">

                <div class="col-md-12" style="text-align: center;">
                  <h5 class="modal-title headingStyle" id="exampleModalLabel">Item Details</h5>
                </div>

            </div>

          </div>

          <div class="modal-body table-responsive">

            <table class="table tdthtablebordr storeIssue_ItemTbl" border="1" cellspacing="0" id="storeIssueItemTbl1">

              <tr>
                <th>#</th>
                <th>Vr No</th>
                <th>Item Name</th>
                <th>Issue Qty</th>
                <th>Return Qty</th>
                <th>Bal Qty</th>
              </tr>
              
            </table>
            
          </div>

          <div class="modal-footer" style="text-align: center;padding: 2px;" id="footer_item_1">

            

          </div>

        </div>

      </div>

    </div>

<!-- ----- SHOW MODAL WHEN SELECT ISSUE NO & DISPLAY ITEM DETAILE FROM STORE ISSUE ------ -->

@include('admin.include.footer')

<script src="{{ URL::asset('public/dist/js/viewjs/store_tran.js') }}" ></script>


<script type="text/javascript">

  $(document).ready(function(){

    $( window ).on( "load", function() {

     var vrseqno = $('#vrseqnum').val();

     var vrlastnum = $('#vr_last_num').val();

      if(vrseqno == ''){

        $('#setdisable').prop('disabled',true);

      }else if(vrseqno==vrlastnum){

        $('#setdisable').prop('disabled',true);

      }else{

        $('#setdisable').prop('disabled',false);

      }



       var series_code =  $("#series_code").val();

        if(series_code==''){
        
           //$('#series_code').css('border-color','#d2d6de');
        
           $('#series_code').css('border-color','#ff0000').focus();
           //$('#asset_code').css('border-color','#d2d6de');
           }else{
           	
            $('#Plant_code').css('border-color','#ff0000').focus();
           
           // $('#asset_code').css('border-color','#ff0000').focus();
           }

    });

  });

</script>

<script>

/* --------- START : DELETE ROW -------- */

  $(".delete").on('click', function() {

      $('.case:checkbox:checked').parents("tr").remove();

      $('.check_all').prop("checked", false); 

      check();

  });

  function select_all() {

    $('input[class=case]:checkbox').each(function(){ 
      if($('input[class=check_all]:checkbox:checked').length == 0){ 
          $(this).prop("checked", false); 
      }else{
          $(this).prop("checked", true); 
      } 

    });

  }

  function check(){

    obj = $('#tbledata tr').find('span');

    console.log('obj',obj);

    if(obj.length==0){
      $('#submit_data').prop('disabled',true);
    }else{

      $.each( obj, function( key, value ) {
        id=value.id;
        $('#'+id).html(key+1);
      });

    }

  }

/* --------- END : DELETE ROW -------- */

/* ------ START : ADD MORE ROW FUNCTIONALITY ---------- */

  var i=2;
  $(".addmore").on('click',function(){



   var rcount =$('#tbledata tr').length;

  // var rowCount = rcount + 1;

    var data = "<tr class='useful'><td class='tdthtablebordr'><input type='checkbox' class='case' id='firstrow"+i+"'/></td>"+
      "<td class='tdthtablebordr' style='width:5%;'><span id='snum' style='width: 10px;'>"+i+".</span><input type='hidden' name='tblRow[]' value='"+i+"'></td><td class='tdthtablebordr' style='width:10%;'><div class='input-group'><input type='text' class='inputboxclr withpreTran' id='item_codeWT"+i+"' name='itemPo[]' onclick='ShowItemOnModal("+i+")' autocomplete='off' oninput='this.value = this.value.toUpperCase()' readonly/><input list='ItemList"+i+"' class='inputboxclr' id='item_codeWOT"+i+"' name='item_code[]' onchange='showItemDetails("+i+")' oninput='this.value = this.value.toUpperCase()' /><datalist id='ItemList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($item_list as $key)<option value='<?php echo $key->ITEM_CODE?>' data-xyz ='<?php echo $key->ITEM_NAME; ?>' ><?php echo $key->ITEM_NAME ; echo ' ['.$key->ITEM_CODE.']' ; ?></option>@endforeach</datalist></div><input list='batchList"+i+"' class='inputboxclr' id='batch_no1' name='batch_no[]' oninput='this.value = this.value.toUpperCase()' style='margin-top: 2px;' autocomplete='off' onchange='getBatchQty("+i+");' /><datalist id='batchList"+i+"'></datalist><input type='hidden' id='itmC_code"+i+"' name='itemcodeC[]'><div><p id='stockavlble"+i+"' class='badge' style='background-color:#25b6bd;margin: 3px 0 1px'>Batch Qty : <small id='itembatch_Qty"+i+"'></small></p></div><input type='hidden' id='itmC_code"+i+"' name='itemcodeC[]'><input type='hidden' id='selectedItem"+i+"'><input type='hidden' id='selectedRowId"+i+"'><input type='hidden' id='req_bodyId"+i+"' name='req_bodyId[]'><input type='hidden' id='itemPlant"+i+"' name='itemPlant'></td>"+
      "<td class='tdthtablebordr' style='width:55%;'><input type='text' class='inputboxclr' id='item_Name"+i+"' name='item_name[]' autocomplete='off' readonly style='width:100%;'/><textarea id='remark_data"+i+"' rows='1' class='inputboxclr' name='remark[]' autocomplete='off' placeholder='Enter Description' style='width:100%;margin-top: 1px;'></textarea></td>"+
      "<td class='tdthtablebordr' style='width:10%;'><div style='display:flex;'><input type='text' class='inputboxclr amntAlign' autocomplete='off' id='req_qty"+i+"' name='req_qty[]' readonly style='width:70px;'/><input type='text' name='req_unit_M[]' id='req_UnitM"+i+"' class='inputboxclr' autocomplete='off' readonly style='width:30px;'></div></td>"+
      "<td class='tdthtablebordr' style='width:10%;'><div style='display:flex;'><input type='text' class='inputboxclr amntAlign' autocomplete='off' id='req_A_qty"+i+"' name='req_Aqty[]' readonly style='width:70px;'/><input type='text' name='req_add_unit_M[]' id='req_AddUnitM"+i+"' class='inputboxclr' autocomplete='off' readonly style='width:30px;'></div></td>"+
      "<td class='tdthtablebordr' style='width:10%;'><div style='display:flex;'><input type='text' class='inputboxclr amntAlign' autocomplete='off' id='qty"+i+"' name='qty[]' oninput='calAQty("+i+")' style='width:70px;' readonly /><input type='text' name='unit_M[]' id='UnitM"+i+"' style='width:30px;' autocomplete='off' class='inputboxclr' readonly><input type='hidden' id='Cfactor"+i+"'></div></td>"+
      "<td class='tdthtablebordr' style='width:10%;'><div id='issueItemShow"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-lg' style='margin-top: 5%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header' style='padding: 5px;'><div class='row'><div class='col-md-12' style='text-align: center;'><h5 class='modal-title headingStyle' id='exampleModalLabel'>Item Details</h5></div></div></div><div class='modal-body table-responsive'><table class='table tdthtablebordr storeIssue_ItemTbl' border='1' cellspacing='0' id='storeIssueItemTbl"+i+"'><tr><th>#</th><th>Vr No</th><th>Item Name</th><th>Issue Qty</th><th>Return Qty</th><th>Bal Qty</th></tr></table></div><div class='modal-footer' style='text-align: center;padding: 2px;' id='footer_item_"+i+"'></div></div></div></div><div style='display:flex;'><input type='text' class='inputboxclr amntAlign' autocomplete='off' id='A_qty"+i+"' name='Aqty[]' style='width:70px;' readonly /><input type='text' name='add_unit_M[]' autocomplete='off' id='AddUnitM"+i+"' style='width:30px;' class='inputboxclr' readonly></div></tr></td>";



      $('#tbledata').append(data);

       var reqNo = $('#req_no').val();

         if(reqNo){
         	//alert(+i);
         	 $('#item_codeWOT'+i).hide();
             $('#item_codeWT'+i).removeClass('withpreTran');

         	 
         }else{
         	
         	$('#item_codeWOT'+i).show();
             $('#item_codeWT'+i).addClass('withpreTran');
         }

  i++;});

/* ------ END : ADD MORE ROW FUNCTIONALITY ---------- */
  
  function getvrnoBySeries(){

      var seriesCd = $('#series_code').val();

      var xyz = $('#seriesList option').filter(function() {
        return this.value == seriesCd;
      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
   
      if(msg=='No Match'){
        $('#series_code').val('');
        $('#vrseqnum').val('');
      }else{

        $('#seriesName').val(msg);
        var seriesCode = $('#series_code').val();
        var transcode   = $('#transcode').val();

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

              if(data1.vrno_series == ''){

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

            } /* /. success */

           } /* /. success function */

        }); /* /. ajax function */

    }/* CHECK MATCH VALUE*/

  } /* /. main function */

  $('#req_no').on('change',function(){

    var reqNo = $('#req_no').val();

    var xyz = $('#reqList option').filter(function() {
      return this.value == reqNo;
    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    //alert(msg);
     
    if(msg=='No Match'){
      $('#reqHeadId').val('');
      $('#req_no').val('');

      $('#item_codeWOT1').show();
      $('#item_codeWT1').addClass('withpreTran');

    }else{

      $('#reqHeadId').val(msg);
      $('#item_codeWOT1').hide();
      $('#item_codeWT1').removeClass('withpreTran');

      $.ajaxSetup({
     	 headers: {
     	   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     	 }
   		 });



      $.ajax({

          url:"{{ url('get-requestion-details-from-requestion') }}",
          method : "POST",
          type: "JSON",
          data: {msg:msg,reqNo:reqNo},

          success:function(data){

              var data1 = JSON.parse(data);

              console.log(data1);

              if(data1.response=='error'){


              }else{

              	if(data1.data=='' || data1.data==null){

              	}else{


              		$("#Plant_code").val(data1.data.PLANT_CODE);
              		$("#plantname").val(data1.data.PLANT_NAME);
              		$("#profitctrId").val(data1.data.PFCT_CODE);
              		$("#pfctName").val(data1.data.PFCT_NAME);
              		$("#dept_code").val(data1.data.DEPT_CODE);
              		$("#deptname").val(data1.data.DEPT_NAME);
              		$("#emp_code").val(data1.data.EMP_CODE);
              		$("#emp_name").val(data1.data.EMP_NAME);
              		$("#cost_center_code").val(data1.data.COST_CENTER);
              		$("#cost_center_name").val(data1.data.COST_NAME);

              	}

             }
          },

      });


    }

  });

  $('#emp_code').on('change',function(){

    var empCd = $('#emp_code').val();

    var xyz = $('#emplList option').filter(function() {
      return this.value == empCd;
    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
     
    if(msg=='No Match'){
      $('#reqHeadId').val('');
      $('#emp_code').val('');
    }else{
      $('#emp_name').val(msg);
    }

  });

  /* ------- SHOW DETAILS ON MODAL WHEN CHOOSE ISSUE NO ------ */

  ShowItemOnModal = (tblRow) =>{

    $('#issueItemShow'+tblRow).modal('show');

    var reqHeadID = $('#reqHeadId').val();
    var tranType  = "STORE_RETURN";

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

          url:"{{ url('get-item-details-from-store-table-against-store-no') }}",
          method : "POST",
          type: "JSON",
          data: {reqHeadID:reqHeadID,tranType:tranType},

          success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                if(data1.item_data == ''){

                }else{
                  $('#storeIssueItemTbl'+tblRow).empty();
                  var headData = "<tr><th>#</th><th>Vr No</th><th>Item Code</th><th>Item Name</th><th>Req Qty</th><th>Issue Qty</th><th>Bal Qty</th></tr>";

                  $('#storeIssueItemTbl'+tblRow).append(headData);

                  var slNo = 1;
                  $.each(data1.item_data, function(k, getData){

                    var balQty = parseFloat(getData.REQ_QTY) - parseFloat(getData.ISSUE_QTY);

                    var cFactor = getData.CFACTOR;
                    if((cFactor == 'null') || (cFactor == null) || (cFactor == '')){
                      c_factorFm=0;
                    }else{
                      c_factorFm= cFactor;
                    }

                    var bodyData = "<tr><td><input type='radio' id='sr_"+tblRow+"_"+slNo+"' name='selectItem' value='"+tblRow+"_"+slNo+"'></td>"+
                    "<td style='width:12%;'><input type='text' id='tblvrno_"+tblRow+"_"+slNo+"' class='form-control' value='"+getData.VRNO+"' style='text-align:left;' readonly=''></td>"+
                    "<td style='width:12%;'><input type='text' id='tblItemCd_"+tblRow+"_"+slNo+"' class='form-control' value='"+getData.ITEM_CODE+"' readonly='' style='text-align:left;'></td>"+
                    "<td style='width:40%;'><input type='text' id='tblItemNm_"+tblRow+"_"+slNo+"' class='form-control' value='"+getData.ITEM_NAME+"' readonly='' style='text-align:left;'></td>"+
                    "<td style='width:12%;'><input type='text' id='tblReqQty_"+tblRow+"_"+slNo+"' class='form-control modalTblInput' value='"+getData.REQ_QTY+"' readonly=''></td>"+
                    "<td style='width:12%;'><input type='text' id='tblIssueQty_"+tblRow+"_"+slNo+"' class='form-control modalTblInput' value='"+getData.ISSUE_QTY+"' readonly=''></td>"+
                   /* "<td style='width:12%;'><input type='text' id='tblReturnQty_"+tblRow+"_"+slNo+"' class='form-control modalTblInput' value='"+getData.RET_QTYISSUED+"' readonly=''></td>"+*/
                    "<td style='width:12%;'><input type='text' id='tblBalQty_"+tblRow+"_"+slNo+"' class='form-control modalTblInput' value='"+balQty.toFixed(3)+"' readonly=''><input type='hidden' id='mcfactor_"+tblRow+"_"+slNo+"' value='"+c_factorFm+"'><input type='hidden' id='mUM_"+tblRow+"_"+slNo+"' value='"+getData.UM+"'><input type='hidden' id='mAUM_"+tblRow+"_"+slNo+"' value='"+getData.AUM+"'><input type='hidden' id='mplant_"+tblRow+"_"+slNo+"' value='"+getData.PLANT_CODE+"'><input type='hidden' id='mreqBodyId_"+tblRow+"_"+slNo+"' value='"+getData.SREQBID+"'></td>"+
                    "</tr>";

                    $('#storeIssueItemTbl'+tblRow).append(bodyData);

                    /*var selectedItm = $("#sel_inputOnModal"+tblRow).val();
                    var selradioBtn = $('#sr_'+tblRow+'_'+slNo).val();
                    if(selectedItm){
                      if(selectedItm == selradioBtn){
                        $('#sr_'+tblRow+'_'+slNo).prop('disabled',false);
                        $('#sr_'+tblRow+'_'+slNo).attr('checked', true);
                        $('#ApplyOkitmbtn'+tblRow).prop('disabled',true);
                      }else{  
                        $('#sr_'+tblRow+'_'+slNo).prop('disabled',true);
                      }
                    }
                  */
                  slNo++;});

                  var butn =  $('#footer_item_'+tblRow).find(':button').html();

                  if(butn != 'Ok' || butn =='undefined'){

                    var tableFooer = "<button type='button' class='btn btn-primary ' style='width: 16%;' data-dismiss='modal' id='ApplyOkitmbtn"+tblRow+"' onclick='selectItemOnModl("+tblRow+")'>Ok</button><button type='button' class='btn btn-danger notshowcnlbtn' data-dismiss='modal' style='width: 16%;margin-top: 0% !important;' id='addbtnwhenselect'>Cancel</button>"

                    $('#footer_item_'+tblRow).append(tableFooer);

                  }else{

                  }

                  var selectedItem = $('#selectedItem'+tblRow).val();

                  var uniqByitm = $('#selectedRowId'+tblRow).val();

                  if(selectedItem){

                      $('#sr_'+uniqByitm).prop('checked',true);

                      $('#ApplyOkitmbtn'+tblRow).prop('disabled',true);

                      $('#addbtnwhenselect'+tblRow).removeClass('notshowcnlbtn');

                      $('input[name="selectItem"]').each(function() {
                         //if not selected
                        if ($(this).is( ":not(:checked)")) {
                          // add disable
                          $(this).attr('disabled', 'disabled');
                        }
                      });

                  }

                }/* /.codn*/

              } /* /. success codn*/

          } /* /. success fun*/

    }); /* /. ajax fun*/

  }/* /. main fun*/

/* ------- SHOW DETAILS ON MODAL WHEN CHOOSE ISSUE NO ------ */

  function selectItemOnModl(seleRow){

    var seleItem = $("input[type='radio'][name='selectItem']:checked").val();
    var res      = seleItem.split("_");
    var res1     = res[0];
    var res2     = res[1];

    var selitemcode = $('#tblItemCd_'+res1+'_'+res2).val();
    var selitemName = $('#tblItemNm_'+res1+'_'+res2).val();
    var reqQty      = $('#tblReqQty_'+res1+'_'+res2).val();
    var balIssuQty  = $('#tblBalQty_'+res1+'_'+res2).val();
    var plantCode   = $('#mplant_'+res1+'_'+res2).val();
    var cFactor     = $('#mcfactor_'+res1+'_'+res2).val();
    var itemUm      = $('#mUM_'+res1+'_'+res2).val();
    var itemAum     = $('#mAUM_'+res1+'_'+res2).val();
    var reqBodyId   = $('#mreqBodyId_'+res1+'_'+res2).val();

    /* ------- put data --------- */

    $('#req_bodyId'+seleRow).val(reqBodyId);
    $('#item_codeWT'+seleRow).val(selitemcode);
    $('#item_Name'+seleRow).val(selitemName);
    $('#req_qty'+seleRow).val(reqQty);
    $('#qty'+seleRow).val(balIssuQty);
    $('#selectedItem'+seleRow).val(selitemcode);
    $('#selectedRowId'+seleRow).val(seleItem);
    $('#itmC_code'+seleRow).val(selitemcode);

    $('#req_UnitM'+seleRow).val(itemUm);
    $('#req_AddUnitM'+seleRow).val(itemAum);
    $('#UnitM'+seleRow).val(itemUm);
    $('#AddUnitM'+seleRow).val(itemAum);
    $('#Cfactor'+seleRow).val(cFactor);
    $('#itemPlant'+seleRow).val(plantCode);

    var calAqty = parseFloat(reqQty) * parseFloat(cFactor);
    $('#req_A_qty'+seleRow).val(calAqty);
    $('#A_qty'+seleRow).val(calAqty);

    /* ------- put data --------- */

    getBatchAgainstItem(plantCode,selitemcode,seleRow);

  }

  function getBatchAgainstItem(plantCode,selitemcode,slno){

    $.ajaxSetup({
        headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
    });

    $.ajax({

          url:"{{ url('get-batch-no-against-item-from-item-bal') }}",

          method : "POST",

          type: "JSON",

          data: {plantCode:plantCode,selitemcode:selitemcode},

          /*beforeSend: function() {
            console.log('start spinner');
                $('.modalspinner').removeClass('hideloaderOnModl');
          },*/

          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.batch_list == ''){

              }else{
                console.log('data1.batch_list',data1.batch_list);
                $("#batchList"+slno).empty();
                $.each(data1.batch_list, function(k, getData){

                    $("#batchList"+slno).append($('<option>',{

                      value:getData.BATCH_NO,
                      'data-xyz':getData.BATCH_NO,
                      text:getData.BATCH_NO

                    }));

                }); 

              }

            }/*/.SUCCESS CODN*/

          }/*/. SUCCESS FUNCTION*/

    });/*/.AJAX FUNCTION*/

  }

  function getBatchQty(srNo){

    var batchNo     = $('#batch_no'+srNo).val();
    var selitemcode = $('#itmC_code'+srNo).val();
    var plantCode   = $('#itemPlant'+srNo).val();

    $.ajaxSetup({
        headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
    });

    $.ajax({

          url:"{{ url('get-batch-no-against-item-from-item-bal') }}",

          method : "POST",

          type: "JSON",

          data: {batchNo:batchNo,selitemcode:selitemcode,plantCode:plantCode},

          /*beforeSend: function() {
            console.log('start spinner');
                $('.modalspinner').removeClass('hideloaderOnModl');
          },*/

          success:function(data){

            var data1 = JSON.parse(data);
            console.log('data1.batch_list[0].CLQTY',data1.batch_list);
            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){
              //console.log('data1.batch_list',data1.batch_list);
              if(data1.batch_list == ''){

              }else{
                
                $('#itembatch_Qty'+srNo).html(data1.batch_list[0].CLQTY);
              }

            }/*/.SUCCESS CODN*/

          }/*/. SUCCESS FUNCTION*/

    });/*/.AJAX FUNCTION*/

  }

  function showItemDetails(slNO){

    var itemCd = $('#item_codeWOT'+slNO).val();

      var xyz = $('#ItemList'+slNO+' option').filter(function() {
        return this.value == itemCd;
      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
   
      if(msg=='No Match'){
        $('#item_codeWOT'+slNO).val('');
      }else{

        var plantCode   = $('#Plant_code').val();
        var selitemcode = $('#item_codeWOT'+slNO).val();
        var batchNo     = '';
        $.ajax({

          url:"{{ url('get-batch-no-against-item-from-item-bal') }}",

          method : "POST",

          type: "JSON",

          data: {batchNo:batchNo,selitemcode:selitemcode,plantCode:plantCode},

          /*beforeSend: function() {
            console.log('start spinner');
                $('.modalspinner').removeClass('hideloaderOnModl');
          },*/

          success:function(data){

            var data1 = JSON.parse(data);
           
            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){
              console.log('data1.item_batch_list',data1.item_batch_list);

              if(data1.item_batch_list == ''){

              }else{
                
                $("#batchList"+slNO).empty();
                $.each(data1.item_batch_list, function(k, getData){

                    $("#batchList"+slNO).append($('<option>',{

                      value:getData.BATCH_NO,
                      'data-xyz':getData.BATCH_NO,
                      text:getData.BATCH_NO

                    }));

                }); 

              }

              if(data1.item_batch_list ==''){

                if(data1.batch_list == ''){

                }else{
                  
                  $('#itembatch_Qty'+slNO).html(data1.batch_list[0].CLQTY);
                }
              }

            }/*/.SUCCESS CODN*/

             itemDataDetails(slNO);

          }/*/. SUCCESS FUNCTION*/

        });/*/.AJAX FUNCTION*/

      }/* /. NO MATCH CODN*/


     

  }


function itemDataDetails(slNO){

	var itemCd = $('#item_codeWOT'+slNO).val();

    	alert(itemCd);
   
    var xyz = $('#ItemList'+slNO+' option').filter(function() {
      return this.value == itemCd;
    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';
 
    if(msg=='No Match'){
      $('#item_codeWOT'+slNO+',#itmC_code'+slNO+',#item_Name'+slNO+',#UnitM'+slNO+',#AddUnitM'+slNO+',#Cfactor'+slNO+'').val('');

    }else{

    	$('#itmC_code'+slNO+',#item_Name'+slNO+',#UnitM'+slNO+',#AddUnitM'+slNO+',#Cfactor'+slNO+'').val('');

      $('#itmC_code'+slNO).val(itemCd);
      $('#item_Name'+slNO).val(msg);
      $('#qty'+slNO).prop('readonly',false);
      var ItemCode = $('#item_codeWOT'+slNO).val();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      var itemgetUrl = folderName+'/get-item-um-aum';

      $.ajax({

        url:itemgetUrl,
        method : "POST",
        type: "JSON",
        data: {ItemCode: ItemCode},
        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

          }else if(data1.response == 'success'){

            if(data1.data == ''){

            }else{
              $('#req_qty'+slNO+',#req_A_qty'+slNO+'').val(0);
              $('#issue_qty'+slNO+',#issue_A_qty'+slNO+'').val(0);
              $('#UnitM'+slNO).val(data1.data[0].UM_CODE);
              $('#AddUnitM'+slNO).val(data1.data[0].AUM_CODE);
              $('#Cfactor'+slNO).val(data1.data[0].AUM_FACTOR);
            }

          } /* /. success */

         } /* /. success function */

      }); /* /. ajax function */

    }
}


  function submitdata(){

      var data = $("#storeIssueForm").serialize();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({

          type: 'POST',
          url: "{{ url('finance/save-store-issue-transaction') }}",
          data: data, // here $(this) refers to the ajax object not form
          success: function (data) {

            var data1 = JSON.parse(data);

            if(data1.response=='error'){

              var responseVar = false;

              var url = "{{url('finance/view-store-issue-msg')}}";

            }else{

              var responseVar = true;

              var url = "{{url('finance/view-store-issue-msg')}}";

            }
              
            setTimeout(function(){ window.location = url+'/'+responseVar; });
           
          },

      });

  } 

</script>