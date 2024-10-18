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

  .rightcontent{
    text-align:right;
  }
  ::placeholder {
    text-align:left;
  }
 .required-field::before {
    content: "*";
    color: red;
  }
  .Custom-Box {
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .showinmobile{
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

  }
  .showSeletedName{
    font-size: 15px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
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
  .inputboxclr{
    border: 1px solid #d7d3d3;
    width: 100%;
    margin-bottom: 5px;
  }
  .tdthtablebordr{
    border: 1px solid #00BB64;
  }
  input:focus{border:1px solid yellow;} 
  .space{margin-bottom: 2px;}
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 8px;
    padding-bottom: 0px !important;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #00a65a;
    text-align: center;
  }
  .crdrTotal{
    width: 140px !important;
    text-align: end !important;
    margin-left: 10px;
    margin-right: 3px;
  }
  .debitcreditbox{
    margin-top: 0%;
    text-align: end;
  }
  .fieldLable {
    font-size: 12px;
    font-weight: 700;
    color: #095e90;
    float: right;
  }
  .lableName {
    margin: 0px;
    margin-top: 5px;
    margin-bottom: 9px;
  }

  .tdsratebtnHide{
    display: none;
  }
  .modltitletext {
    text-align: center;
    font-weight: 700;
    color: #5696bb;
  }
  .iconBtnSty{
      border-radius: 100px;
      padding: 4px;
  }
</style>





<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">



          <h1>

            Edit Journal Transaction

            <small>Add Details</small>

          </h1>



          <ul class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>



            <li class="active"><a href="{{ url('/Transaction/Account/Journal-Trans') }}"> Journal</a></li>



            <li class="active"><a href="{{ url('/Transaction/Account/Journal-Trans') }}">Edit Journal</a></li>



          </ul>



        </section>





<form id="journaltrans">

              @csrf

  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Edit Journal Transaction</h2>



              <div class="box-tools pull-right">



                <a href="{{ url('/Transaction/Account/View-Journal-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>



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

          <div class="row">
            
             <div class="col-md-2">

                <div class="form-group">

                  <label>Date: <span class="required-field"></span></label>
                    
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                      <?php $vrDate = date('d-m-Y',strtotime($journal_list[0]->VRDATE)); ?>

                      <input type="text" class="form-control transdatepicker rightcontent" name="vr_date" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off" readonly>

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
                </div>

                   <!-- /.form-group -->
            </div>

            <div class="col-md-2">
              
              <div class="form-group">

                  <label> T Code : </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                          <input type="text" class="form-control" name="tran_code" value="{{ $journal_list[0]->TRAN_CODE }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>
              </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-2 seriesMargin">

              <div class="form-group">

                  <label>Series : 
                    <span class="required-field"></span>
                  </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input list="seriesList"  id="series_code" name="series_Code" class="form-control  pull-left seriesWidth" value="<?php echo $journal_list[0]->SERIES_CODE; ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()"   autocomplete="off" readonly>

                      <datalist id="seriesList">

                      </datalist>

                    </div>
                    <small id="serscode_err" style="color: red;" class="form-text text-muted">
                    </small>
                       
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

                      <input id="seriesText" name="series_Name" class="form-control  pull-left" value="<?php echo $journal_list[0]->SERIES_NAME; ?>" placeholder="Enter Series Name" autocomplete="off" readonly="">

                      

                    </div>
                  
                          

              </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">
              
                <label> Vr No: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                    
                    <input type="text" class="form-control rightcontent" name="vrno" value="<?php echo $journal_list[0]->VRNO; ?>" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

                  </div>
                  <small id="transerror"></small>

                  <small id="emailHelp" class="form-text text-muted">

                    {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>

              </div>
                <!-- /.form-group -->
            </div>
                              
          </div>

          <div class="row">

            <div class="col-md-2">

              <div class="form-group">

                <label>Pfct Code: <span class="required-field"></span></label>

                  <div class="input-group">

                    <div class="input-group-addon">
                       <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    </div>
                    <input list="profitList"  id="profitId" name="pfct_code" class="form-control  pull-left" value="<?php echo $journal_list[0]->PFCT_CODE; ?>" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" readonly autocomplete="off">

                    <datalist id="profitList">

                      <option selected="selected" value="">-- Select --</option>

                    </datalist>

                  </div>
                  <small id="profit_center_err" style="color: red;"> </small>
              </div>
                <!-- /.form-group -->
            </div>

           <div class="col-md-3">

              <div class="form-group">

                  <label>Pfct Name: <span class="required-field"></span>

                  </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                    <div class="pull-left showSeletedName" id="profit_names"></div>

                    <input type="text" class="form-control" id="profit_name" name="pfct_name" placeholder="Enter Profit Center Name" value="<?php echo $journal_list[0]->PFCT_NAME; ?>" readonly autocomplete="off">

                  </div>

                  <small id="comp_code_err" style="color: red;"></small>

                  <small id="emailHelp" class="form-text text-muted">

                      {!! $errors->first('pfct_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                  </small>
                </div>
                  <!-- /.form-group -->
            </div>
                <!-- /.col -->  

              <div class="col-md-2">

                <div class="form-group">

                  <label>Sale Rep. code:</label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>
                     
                      <input list="saleRepList" class="form-control" id="sale_rep_code" name="saleRepCode" placeholder="Select Sale Rep. code" maxlength="55" value="<?php echo $journal_list[0]->SR_CODE; ?>" readonly autocomplete="off">

                      <datalist id="saleRepList">

                      </datalist>

                    </div>
                    <input type="hidden" name="saleResName" id="hidnsaleRepName">
                    <small>  

                        <div class="pull-left showSeletedName" id="saleRText"></div>

                    </small>

                    <small id="saleR_err" style="color: red;"> </small>

                </div>
                <!-- /.form-group -->
              </div><!--  /.col --> 


          </div>


        </div><!-- /.box-body -->

        </div>

      </div>

    </div>

  </section>



  <section class="content" style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-body">

              <div class="table-responsive">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th class="tdthtablebordr"><input class='check_all' type='checkbox' onclick="select_all()"/ title="Delete All Row"></th>

                    <th class="tdthtablebordr">Sr.No.</th>

                    <th class="tdthtablebordr">Gl / Account Code</th>

                    <th class="tdthtablebordr">Account Name</th>

                    <th class="tdthtablebordr">Debit-DR</th>

                    <th class="tdthtablebordr">Credit-CR</th>

                  </tr>

                  <?php $srNo=1;$drTotal =0;$crTotal =0; $totlRowExist = count($journal_list);

                    foreach($journal_list as $row){ 

                    $drTotal += $row->DRAMT;
                    $crTotal += $row->CRAMT;

                    $netAmount = $row->BASE_AMT - $row->TDS_AMT;

                    $drAmount = (($row->DRAMT =='0.00') || ($row->DRAMT==0.00)) ? '' :$row->DRAMT;
                    $crAmount = (($row->CRAMT =='0.00') || ($row->CRAMT==0.00)) ? '' :$row->CRAMT;

                    if(($row->TDS_APPLY_STATUS == 1) || ($row->TDS_APPLY_STATUS == '1')){
                      $tdsGlCode= $row->TDS_GLCODE;
                      $tdsGlName= $row->TDS_GLNAME;
                    }else{
                      $tdsGlCode='';
                      $tdsGlName='';
                    }

                    ?>

                    <tr class="useful">

                      <?php if($srNo==1){ ?>

                        <td class="tdthtablebordr">
                          <input type='checkbox' class='case' title="Delete Single Row" />
                          <span id='snum'><?php echo $srNo; ?>.</span>
                          <input type="hidden" name="totlRwCount[]" class="rowCountCls" value="{{$srNo}}" id="totlCountRw{{$srNo}}">
                        </td>

                      <?php }else{ ?>

                        <td class="tdthtablebordr">
                          <input type='checkbox' class='case' title="Delete Single Row" />
                          <span id='snum<?php echo $srNo; ?>'><?php echo $srNo; ?>.</span>
                          <input type="hidden" name="totlRwCount[]" class="rowCountCls" value="{{$srNo}}" id="totlCountRw{{$srNo}}">
                        </td>

                      <?php } ?>

                      <td class="tdthtablebordr" style="width:10%;">
                      <div class="row lableName">
                        <small class="fieldLable">Gl Code</small>
                      </div>
                      <div class="row lableName" style="margin-top: 12px;">
                        <small class="fieldLable">Account Code</small>
                      </div>
                      <div class="row lableName" style="margin-top: 12px;">
                        <small class="fieldLable">Cost Code</small>
                      </div>
                      <div class="row lableName" style="margin-top: 12px;">
                        <small class="fieldLable">Reverse Code</small>
                      </div>
                    </td> 

                      <td class="tdthtablebordr" style="width:15%;">

                        <div class="input-group" style="display:flex;">
                          <small id="glReqMsg{{$srNo}}" style="color:red;"></small>
                          <input list="GlList{{$srNo}}" class="inputboxclr" style="margin-bottom: 5px;" id='gl_code{{$srNo}}' name="gl_code[]" placeholder="Enter Gl Code" onchange="GlListData({{$srNo}})" value="{{$row->GL_CODE}}" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>

                          <datalist id="GlList{{$srNo}}">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($gl_list as $key)

                              <option value='<?php echo $key->GL_CODE?>' data-xyz ="<?php echo $key->GL_NAME; ?>" ><?php echo $key->GL_NAME ; echo " [".$key->GL_CODE."]" ; ?></option>

                              @endforeach

                          </datalist>
                          <input type="hidden" id="acctTag{{$srNo}}" value="">
                          <input type="hidden" id="costCTag{{$srNo}}" value="">
                        </div>

                        <div class="input-group" style="display:flex;">
                          <small id="accReqMsg{{$srNo}}" style="color:red;"></small>
                          <input list="AccList{{$srNo}}" class="inputboxclr" style="margin-bottom: 5px;" id="acc_code{{$srNo}}" placeholder="Enter Account Code" name="acc_code[]" onchange="AccListData({{$srNo}})" value="{{$row->ACC_CODE}}" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>

                          <datalist id="AccList{{$srNo}}">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($account_list as $key)

                              <option value='<?php echo $key->ACC_CODE?>' data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                              @endforeach

                          </datalist>

                        </div>

                        <div class="input-group" style="display:flex;">
                          <small id="costCenMsg{{$srNo}}" style="color:red;"></small>
                          <input list="costCList{{$srNo}}" class="inputboxclr" style="margin-bottom: 5px;" id='cost_code{{$srNo}}' name="cost_code[]" value="{{$row->COST_CODE}}" placeholder="Enter Cost Center Code" onchange="costCListData({{$srNo}})" autocomplete="off"/>

                          <datalist id="costCList{{$srNo}}">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($cost_list as $key)

                              <option value='<?php echo $key->COST_CODE?>' data-xyz ="<?php echo $key->COST_NAME; ?>" ><?php echo $key->COST_NAME ; echo " [".$key->COST_CODE."]" ; ?></option>

                              @endforeach

                          </datalist>
                        
                        </div>

                        <div class="input-group" style="display:flex;">
                          <input list="revCList{{$srNo}}" class="inputboxclr" style="margin-bottom: 5px;" id='rev_code{{$srNo}}' name="rev_code[]" placeholder="Enter Reverse Code" value="{{$row->REF_CODE}}" onchange="revListData({{$srNo}})" readonly autocomplete="off"/>

                          <datalist id="revCList{{$srNo}}">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($reverseCdData as $key)

                              <option value='<?php echo $key->REVCODE?>' data-xyz ="<?php echo $key->REVNAME; ?>" ><?php echo $key->REVNAME ; echo " [".$key->REVCODE."]" ; ?></option>

                              @endforeach

                          </datalist>
                          
                        </div>
                        <input type="hidden" name="revName[]" value="{{$row->REF_NAME}}" id="revName{{$srNo}}">
                        <input type="hidden" name="revType[]" id="revType{{$srNo}}">

                      </td>

                      <td class="tdthtablebordr"  style="width:45%;">

                        <input type="text" class="inputboxclr" style="margin-bottom: 5px;" id='gl_name{{$srNo}}' name="gl_name[]" value="{{$row->GL_NAME}}" placeholder="Enter Gl Name" readonly /><br>

                        <input type="text" class="inputboxclr" style="margin-bottom: 5px;" id='acc_name{{$srNo}}' name="acc_name[]" value="{{$row->ACC_NAME}}" placeholder="Enter Account Name" readonly /><br>

                        <input type="text" class="inputboxclr" style="margin-bottom: 5px;" id='costC_name{{$srNo}}' name="costC_name[]" value="{{$row->COST_NAME}}" placeholder="Enter Cost Center Name" readonly /><br>

                        <div class="input-group" style="display:flex;">

                          <input type="text" class="inputboxclr" style="margin-bottom: 5px;" id='discription{{$srNo}}' value="{{$row->PARTICULAR}}" name="particular[]" placeholder="Enter Remark" readonly /><br>

                        </div>

                        <div class="input-group" style="display:flex;">

                          <input list="remarkList{{$srNo}}" class="inputboxclr" id='narration{{$srNo}}' name="narration[]" value="{{$row->NARRATION}}" placeholder="Enter Narration" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>

                          <datalist id="remarkList{{$srNo}}">

                              <option selected="selected" value="">-- Select --</option>

                              @foreach ($remark_list as $key)

                              <option value='To - <?php echo $key->REMARK?>' data-xyz ="To - <?php echo $key->REMARK; ?>" >To - <?php echo $key->REMARK ; ?></option>

                              @endforeach

                          </datalist>

                        </div>

                      </td>

                      <td class="tdthtablebordr"  style="width:15%;vertical-align: middle;">
                        <input type='text' class="debitcreditbox dr_amount inputboxclr"  id='dr_amount{{$srNo}}' name="dr_amount[]" value="{{$drAmount}}" onkeypress='NumberCredit()' autocomplete="off" oninput='GetDebitAmount({{$srNo}})' readonly/>
                      </td>

                      <td class="tdthtablebordr"  style="width:15%;vertical-align: middle;">
                        <input type='text' class="debitcreditbox inputboxclr cr_amount" id='cr_amount{{$srNo}}' name="cr_amount[]" value="{{$crAmount}}" onkeypress='NumberCredit()' autocomplete="off" oninput='GetCreditAmount({{$srNo}})' readonly />

                        <input type="hidden" name="GettdsName[]" value="{{$tdsGlName}}" id="GettdsName{{$srNo}}">
                        <input type="hidden" name="GettdsCode[]" value="{{$tdsGlCode}}" id="GettdsCode{{$srNo}}">
                        <input type="hidden" name="tdsRateH[]" value="{{$row->TDS_RATE}}" id="tds_RateH{{$srNo}}">
                        <input type="hidden" name="tdsCutAmt[]" value="{{$row->TDS_AMT}}" id="tds_cutAmtH{{$srNo}}">
                        <input type="hidden" name="netAmnt[]" value="{{$netAmount}}" id="netAmtH{{$srNo}}">
                        <input type="hidden" name="tdsBaseAmt[]" value="{{$row->BASE_AMT}}" id="tdsBaseAmtH{{$srNo}}">
                        <input type="hidden" name="isTDSApply[]" id="isTDSApply{{$srNo}}" value="{{$row->TDS_APPLY_STATUS}}">

                        <!-- START TDS BUTTON CODE -- -->
                        <input type="hidden" id="tdsByAccCode{{$srNo}}" value="" name="tdsCodeByAc[]">
                        <div style="display: flex;">
                          <button type='button' class='btn btn-primary btn-xs tdsratebtnHide' id='tds_rate{{$srNo}}' data-toggle='modal' data-target='#tds_rate_model{{$srNo}}' onclick='CalculateTdsRate({{$srNo}})' style="padding: 0px;" disabled>Calc TDS</button>
                          <div id="appliedbtn{{$srNo}}" style="margin-top: 3px;"></div>
                          <div id="canclebtn{{$srNo}}" style="margin-top: 3px;"></div>
                        </div>
                        <!-- END TDS BUTTON CODE -- -->

                      </td>

                      <!------- MODAL FOR CALCULATE TDS ------------>

                        <div class="modal fade" id="tds_rate_model{{$srNo}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                          <div class="modal-dialog modal-sm" role="document" style="margin-top: 13%;">
                            <div class="modal-content" style="border-radius: 5px;">
                              <div class="modal-header">
                                <h5 class="modal-title modltitletext" id="exampleModalLabel">Calculate TDS</h5>
                              </div>
                              <div class="modal-body">
                                <div class="row tdsInputBox">
                                    <div class="col-md-4">
                                      <label class="textSizeTdsModl">Tds Section</label>
                                      
                                    </div>
                                    <div class="col-md-4">
                                      <input type="text" id="tds_name{{$srNo}}" name="tds_section[]" value="" style="margin-bottom:3px;" readonly>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row tdsInputBox">
                                    <div class="col-md-4">
                                      <label class="textSizeTdsModl">Tds Rate</label>
                                      
                                    </div>
                                    <div class="col-md-4">
                                      <input type="text" id="tdsRate{{$srNo}}" name="tdsRates[]" readonly style="text-align: right;margin-bottom:3px;">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row tdsInputBox">
                                    <div class="col-md-4">
                                      <label class="textSizeTdsModl">Tds Base Amount</label>
                                      
                                    </div>
                                    <div class="col-md-4">
                                      <input type="hidden" id="tds_base_Amt{{$srNo}}" name="baseTDSAmt[]" value="">
                                      <input type="text" id="Net_amount{{$srNo}}" readonly style="text-align: right;">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row tdsInputBox">
                                    <div class="col-md-4">
                                      <label class="textSizeTdsModl">Tds Amount calculate</label>
                                      
                                    </div>
                                    <div class="col-md-4">
                                      <input type="text" id="tds_Amt_cal{{$srNo}}" readonly style="text-align: right;">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                                <div class="row tdsInputBox">
                                    <div class="col-md-4">
                                      <label class="textSizeTdsModl">Net Amount</label>
                                      
                                    </div>
                                    <div class="col-md-4">
                                      <input type="text" id="deduct_tds_Amt{{$srNo}}" readonly name="base_amt_tds[]" style="text-align: right;">
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                              </div>
                              <div class="modal-footer" style="text-align: center;">
                                <button type="button" class="btn btn-primary" style="width: 30%;padding: 3px;" data-dismiss="modal" id="ApplyTds{{$srNo}}" onclick="Applytds({{$srNo}})">Apply TDS</button>
                                <button type="button" class="btn btn-warning" style="width: 24%;padding: 3px;" data-dismiss="modal" onclick="cancleBtntds({{$srNo}})">Cancle</button>
                              </div>
                            </div>
                          </div>
                        </div>

                      <!------- MODAL FOR CALCULATE TDS ------------>

                    </tr>

                  <?php $srNo++;} ?>  

                </table>

              </div>

              <div class="row">
                <input type="hidden" value="{{$totlRowExist}}" id="preTotlRow">
                <div class="col-md-3">
                  <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                  <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
                </div>

                <div class="col-md-4">

                  <input type="hidden" name="upCompCd" value="{{$journal_list[0]->COMP_CODE}}">
                  <input type="hidden" name="upFyCd" value="{{$journal_list[0]->FY_CODE}}">
                  <input type="hidden" name="upTranCd" value="{{$journal_list[0]->TRAN_CODE}}">
                  <input type="hidden" name="UpSeriesCd" value="{{$journal_list[0]->SERIES_CODE}}">
                  <input type="hidden" name="UpvrNo" value="{{$journal_list[0]->VRNO}}">
                
                  <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
                  <button class="btn btn-success" type="button" id="submitdata" onclick="submitJournalData(0)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                  <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>

                  <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitJournalData(1)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button>


                </div>

                <div class="col-md-5">
                  <div id="showgreatermsg" style="text-align: end;color: red;"></div>
                  <div style="display:flex;float:right;">
                    <div class="totlsetinres" style="margin-top: 7px;"><b>Total : </b>&nbsp;</div>
                    <input class="crdrTotal inputboxclr" type="text" value="{{ number_format((float)$drTotal, 2, '.', '') }}" name="TotlDebit" id="totldramt" readonly>&nbsp;
                    <input class="crdrTotal inputboxclr" type="text" name="TotalCredit" value="{{ number_format((float)$crTotal, 2, '.', '') }}" id="totlcramt" readonly>

                    
                  </div>
                </div>

              </div>

              <div>


              </div>

            


            
        
          </div><!-- /.box-body -->

        </div>

      </div>

    </div>

  </section>

</form>
</div>

<!-- --------- show modal when row is blank ----------- -->
  
    <div id="taxNotAppied" class="modal fade" tabindex="-1">
      <div class="modal-dialog modal-sm" style="margin-top: 13%;">
          <div class="modal-content" style="border-radius: 5px;">
              <div class="modal-header"  style="text-align: center;">
                  <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
                  
              </div>
              <div class="modal-body">
                <p id="whenRowBlnk" style="line-height:15px;"></p>
              </div>
              <div class="modal-footer" style="text-align: center;">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" >OK</button>
              </div>
          </div>
      </div>
    </div>

<!-- --------- show modal when row is blank ----------- -->

<!-- --------- show modal when autoposting YES ----------- -->
  
    <div id="autopostingApl1" class="modal fade" tabindex="-1">
      <div class="modal-dialog modal-sm" style="margin-top: 13%;">
          <div class="modal-content" style="border-radius: 5px;">
              <div class="modal-header"  style="text-align: center;">
                  <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
                  
              </div>
              <div class="modal-body">
                <p id="autopsyYes1" style="line-height:15px;"></p>
              </div>
              <div class="modal-footer" style="text-align: center;">
                  <button type="button" class="btn btn-primary" data-dismiss="modal" style="width: 26%;" onclick="filedBlank(1)">OK</button>
              </div>
          </div>
      </div>
    </div>

<!-- --------- show modal when autoposting YES ----------- -->

@include('admin.include.footer')


<script src="{{ URL::asset('public/dist/js/viewjs/journal_trans.js') }}" ></script>

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
  
  $(document).ready(function() {
    
    $( window ).on( "load", function() {

      var fromdateintrans = $('#FromDateFy').val();
     // console.log(fromdateintrans);
      var todateintrans = $('#ToDateFy').val();

        $('.transdatepicker').datepicker({

          format: 'dd-mm-yyyy',

          orientation: 'bottom',

          todayHighlight: 'true',

          startDate :fromdateintrans,

          endDate : todateintrans,

          autoclose: 'true'

        });

         $('#vr_date').datepicker("destroy");

        var totlRowEx = $('#preTotlRow').val();
        for (var i = 1; i <= totlRowEx; i++) {

          var drAmount = $('#dr_amount'+i).val();
          var crAmount = $('#cr_amount'+i).val();
          var accCode = $('#acc_code'+i).val();
          var isTDSApply = $('#isTDSApply'+i).val();
          console.log('crAmount',crAmount);
          if(drAmount !=0.00){
            $('#dr_amount'+i).prop('readonly',false);
          }else if(crAmount !=0.00){
            $('#cr_amount'+i).prop('readonly',false);
          }
          $('#rev_code'+i).prop('readonly',false);
          if(accCode !=''){
            EditAccListData(i);
          }

          if((isTDSApply == 1) || (isTDSApply == '1')){
            $('#tds_rate'+i).prop('disabled',false);
            $('#appliedbtn'+i).html('<small class="label label-success iconBtnSty"><i class="fa fa-check"></i></small></div>');
            $('#canclebtn'+i).html('');

          }

        }
        $('#deletehidn').prop('disabled',false);
        $('#addmorhidn').prop('disabled',false);
        
    });

  });

</script>



<script type="text/javascript">

$(".delete").on('click', function() {

    $('.case:checkbox:checked').parents("tr").remove();

    $('.check_all').prop("checked", false); 

    var sum = 0;
//dr amount
      $(".dr_amount").each(function () {

        //add only if the value is number

        if (!isNaN(this.value) && this.value.length != 0) {

            sum += parseFloat(this.value);

        }

      $("#totldramt").val(sum.toFixed(2));

    });

//cr amount

  var sumcr = 0;

    $(".cr_amount").each(function () {

        //add only if the value is number

        if (!isNaN(this.value) && this.value.length != 0) {

            sumcr += parseFloat(this.value);

        }

      $("#totlcramt").val(sumcr.toFixed(2));

    });

    var totalDrAmount = $('#totldramt').val();
    var totalCreditAm = $('#totlcramt').val();
   
    if((totalDrAmount > 0.00) && (totalCreditAm > 0.00)){
      if((totalDrAmount == totalCreditAm)){
          $('#submitdata').prop('disabled',false);
          $('#submitdatapdf').prop('disabled',false);
      }else{
          $('#submitdata').prop('disabled',true);
          $('#submitdatapdf').prop('disabled',true);
      }
    }else{
      $('#submitdata').prop('disabled',true);
      $('#submitdatapdf').prop('disabled',true);
    }

    check();

});

var ii=1;

var totl_Row = $('#preTotlRow').val();

if(totl_Row){
  var i = parseInt(totl_Row) + parseInt(ii);
}else{
  var i =0;
}

$(".addmore").on('click',function(){

    var getpaymode = 'To -';

    count=$('table tr').length;

    var data="<tr class='useful'><td class='tdthtablebordr'><input type='checkbox' class='case' title='Delete Single Row' /><span id='snum"+i+"'>"+count+".</span><input type='hidden' class='rowCountCls' name='totlRwCount[]' value='"+i+"' id='totlCountRw"+i+"'></td>";

    data +="<td class='tdthtablebordr' style='width:10%;'><div class='row lableName'><small class='fieldLable'>Gl Code</small></div><div class='row lableName' style='margin-top: 12px;'><small class='fieldLable'>Account Code</small></div><div class='row lableName' style='margin-top: 12px;'><small class='fieldLable'>Cost Code</small></div><div class='row lableName' style='margin-top: 12px;'><small class='fieldLable'>Reverse Code</small></div></td><td class='tdthtablebordr' style='width:15%;'><div class='input-group' style='display:flex;'><small id='glReqMsg"+i+"' style='color:red;'></small><input list='GlList"+i+"' class='inputboxclr' style='margin-bottom: 5px;' id='gl_code"+i+"' name='gl_code[]' placeholder='Enter Gl Code' onchange='GlListData("+i+")' oninput='this.value = this.value.toUpperCase()' /><datalist id='GlList"+i+"'><option selected='selected' value=''>-- Select --</option> @foreach ($gl_list as $key)<option value='<?php echo $key->GL_CODE?>' data-xyz ='<?php echo $key->GL_NAME; ?>' ><?php echo $key->GL_NAME ; echo ' ['.$key->GL_CODE.']' ; ?></option>@endforeach</datalist><input type='hidden' id='acctTag"+i+"' value=''><input type='hidden' id='costCTag"+i+"' value=''></div><div class='input-group' style='display:flex;'><small id='accReqMsg"+i+"' style='color:red;'></small><input list='AccList"+i+"' class='inputboxclr' style='margin-bottom: 5px;' id='acc_code"+i+"' placeholder='Enter Account Code' name='acc_code[]' onchange='AccListData("+i+")' oninput='this.value = this.value.toUpperCase()' /><datalist id='AccList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($account_list as $key)<option value='<?php echo $key->ACC_CODE?>' data-xyz ='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME ; echo ' ['.$key->ACC_CODE.']' ; ?></option> @endforeach</datalist></div><div class='input-group' style='display:flex;'><small id='costCenMsg"+i+"' style='color:red;'></small><input list='costCList"+i+"' class='inputboxclr' style='margin-bottom: 5px;' id='cost_code"+i+"' name='cost_code[]' placeholder='Enter Cost Center Code' onchange='costCListData("+i+")' /><datalist id='costCList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($cost_list as $key)<option value='<?php echo $key->COST_CODE?>' data-xyz ='<?php echo $key->COST_NAME; ?>' ><?php echo $key->COST_NAME ; echo ' ['.$key->COST_CODE.']' ; ?></option>@endforeach</datalist></div><div class='input-group' style='display:flex;'><input list='revCList"+i+"' class='inputboxclr' style='margin-bottom: 5px;' id='rev_code"+i+"' name='rev_code[]' placeholder='Enter Reverse Code' value='' onchange='revListData("+i+")' readonly autocomplete='off'/><datalist id='revCList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($reverseCdData as $key)<option value='<?php echo $key->REVCODE?>' data-xyz ='<?php echo $key->REVNAME; ?>' ><?php echo $key->REVNAME ; echo ' ['.$key->REVCODE.']' ; ?></option>@endforeach</datalist></div><input type='hidden' name='revName[]' value='{{$row->REF_NAME}}' id='revName"+i+"'></td><td class='tdthtablebordr'  style='width:45%;'><input type='text' class='inputboxclr' style='margin-bottom: 5px;' id='gl_name"+i+"' name='gl_name[]' placeholder='Enter Gl Name' readonly /><br><input type='text' class='inputboxclr' style='margin-bottom: 5px;' id='acc_name"+i+"' name='acc_name[]' placeholder='Enter Account Name' readonly /><br><input type='text' class='inputboxclr' style='margin-bottom: 5px;' id='costC_name"+i+"' name='costC_name[]' placeholder='Enter Cost Center Name' readonly /><br><div class='input-group' style='display:flex;'><input type='text' class='inputboxclr' style='margin-bottom: 5px;' id='discription"+i+"' value='' name='particular[]' placeholder='Enter Remark' readonly /><br></div><div class='input-group' style='display:flex;'><input list='remarkList"+i+"' class='inputboxclr' id='narration"+i+"' name='narration[]' value='' placeholder='Enter Narration' oninput='this.value = this.value.toUpperCase()' autocomplete='off'/><datalist id='remarkList"+i+"'><option selected='selected' value=''>-- Select --</option> @foreach ($remark_list as $key)<option value='To - <?php echo $key->REMARK?>' data-xyz ='To - <?php echo $key->REMARK; ?>' >To - <?php echo $key->REMARK ; ?></option>@endforeach</datalist></div></td><td class='tdthtablebordr'  style='width:15%;vertical-align: middle;'><input type='text' class='debitcreditbox dr_amount inputboxclr'  id='dr_amount"+i+"' name='dr_amount[]' onkeypress='NumberCredit()' oninput='GetDebitAmount("+i+")' readonly /></td><td class='tdthtablebordr'  style='width:15%;vertical-align: middle;'><input type='text' class='debitcreditbox inputboxclr cr_amount' id='cr_amount"+i+"' name='cr_amount[]' onkeypress='NumberCredit()' oninput='GetCreditAmount("+i+")' readonly />"+
      /* ---- SHOW AUTOPOSTING YES MODAL ---- */
      "<div id='autopostingApl"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'  style='text-align: center;'><h5 class='modal-title' style='color: red;font-weight: 800;'>Alert !!</h5></div><div class='modal-body'><p id='autopsyYes"+i+"' style='line-height:15px;'></p></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='width: 26%;' onclick='filedBlank("+i+")'>OK</button></div></div></div></div> </td></tr>";

    $('table').append(data);

    var glCode = $('#gl_code'+i).val();
    if((glCode == '') || (glCode == 'undefined') || (glCode == null)){
      $('#gl_code'+i).css('border-color','#ff0000');
    }else{
      $('#gl_code'+i).css('border-color','#d7d3d3');
    }

    var revCdType = $('#revType1').val();
    var revCd     = $('#rev_code1').val();
    var accCd     = $('#acc_code1').val();
    var accName   = $('#acc_name1').val();
    var glCd      = $('#gl_code1').val();
    var glName    = $('#gl_name1').val();
    var drAmnt    = $('#dr_amount1').val();
    var crAmnt    = $('#cr_amount1').val();
    var narration = $('#narration1').val();
    $('#narration'+i).val(narration);

    if((revCdType == 'A') || (revCdType == 'B') || (revCdType == 'R') || (revCdType == 'X')){
      $('#gl_code'+i).val(revCd);

      GlListData(i);

    }else{
      $('#acc_code'+i).val(revCd);

      AccListData(i);
    }

    if(drAmnt){
      $('#cr_amount'+i).val(drAmnt);
    }else if(crAmnt){
      $('#dr_amount'+i).val(crAmnt);
    }

    if(accCd){
      $('#rev_code'+i).val(accCd);

      if(drAmnt){
        $('#cr_amount'+i).val(drAmnt);
        $('#discription'+i).val('By - '+accName);
        $('#revName'+i).val(accName);
        $('#rev_code'+i).prop('readonly',false);
      }else if(crAmnt){
        $('#dr_amount'+i).val(crAmnt);
        $('#discription'+i).val('To - '+accName);
        $('#revName'+i).val(accName);
        $('#rev_code'+i).prop('readonly',false);
      }
      

    }else{

      $('#rev_code'+i).val(glCd);
      $('#discription'+i).val(glName);

      if(drAmnt){
        $('#cr_amount'+i).val(drAmnt);
        $('#discription'+i).val('By - '+glName);
        $('#revName'+i).val(glName);
        $('#rev_code'+i).prop('readonly',false);
      }else if(crAmnt){
        $('#dr_amount'+i).val(crAmnt);
        $('#discription'+i).val('To - '+glName);
        $('#revName'+i).val(glName);
        $('#rev_code'+i).prop('readonly',false);
      }

    }

    if(drAmnt){
      GetCreditAmount(i);
    }else{
      GetDebitAmount(i);
    }

    i++;



});



function select_all() {

    $('input[class=case]:checkbox').each(function(){ 

        if($('input[class=check_all]:checkbox:checked').length == 0){ 

            $(this).prop("checked", false); 

        } else {

            $(this).prop("checked", true); 

        } 

    });

}



function check(){

    obj = $('table tr').find('span');

    if(obj.length==0){

      $('#totldramt').val(0);
      $('#totlcramt').val(0);
      $('#submitdata').prop('disabled',true);
      $('#submitdatapdf').prop('disabled',true);
    }else{

        $.each( obj, function( key, value ) {

          var idname=value.id;

          $('#'+idname).html(key+1);

        });

    }    

}


</script>


<script type="text/javascript">

  function revListData(slno){
      console.log('slno',slno);
      var rev_code =  $('#rev_code'+slno).val();
      console.log('rev_code',rev_code);
      var drAmt = $('#dr_amount'+slno).val();
      var crAmt = $('#cr_amount'+slno).val();

        var xyz = $('#revCList'+slno+' option').filter(function() {

            return this.value == rev_code;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $('#discription'+slno).val('');
        }else{
          $('#discription'+slno).val('');
          var desc = $('#discription'+slno).val();

          var splitName = msg.split('~');
          var revName = splitName[0];
          var revType = splitName[1];
          $('#revName'+slno).val(revName);
          $('#revType'+slno).val(revType);
          if(desc == ''){
            if(drAmt){
              $('#discription'+slno).val('');
              $('#discription'+slno).val('To - '+revName);
            }else if(crAmt){
              $('#discription'+slno).val('');
              $('#discription'+slno).val('By - '+revName);
            }
          }
        }

  }

  function GlListData(srno){

      $("#autopostingApl"+srno).modal({
        show:false,
        backdrop:'static',
      });

      var gl_code =  $('#gl_code'+srno).val();

      var xyz = $('#GlList'+srno+' option').filter(function() {

          return this.value == gl_code;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $('#gl_code'+srno).val('');
        $('#gl_name'+srno).val('');
        $('#acctTag'+srno).val('');
        $('#costCTag'+srno).val('');
        $('#accReqMsg'+srno).html('');
        $('#dr_amount'+srno).prop('readonly',true);
        $('#cr_amount'+srno).prop('readonly',true);
        $('#gl_code'+srno).css('border-color','#ff0000');
        $('#dr_amount'+srno).val('');
        $('#cr_amount'+srno).val('');
      }else{
        $('#cr_amount'+srno).val('');
        $('#dr_amount'+srno).val('');
        $('#gl_name'+srno).val(msg);
        $('#accReqMsg'+srno).html('');
        $('#dr_amount'+srno).prop('readonly',false);
        $('#cr_amount'+srno).prop('readonly',false);
        $('#gl_code'+srno).css('border-color','#d7d3d3');
        $('#vr_date,#series_code,#sale_rep_code,#costCent_code,#profitId').prop('readonly',true);
      }

      var sum = 0;
      $(".dr_amount").each(function () {

        if (!isNaN(this.value) && this.value.length != 0) {

            sum += parseFloat(this.value);

        }

        $("#totldramt").val(sum.toFixed(2));

      });

      var sumcr = 0;

      $(".cr_amount").each(function () {

        if (!isNaN(this.value) && this.value.length != 0) {

            sumcr += parseFloat(this.value);

        }

      $("#totlcramt").val(sumcr.toFixed(2));

      });

      var glCode = $('#gl_code'+srno).val();
      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/get-gl-tag-from-gl-master') }}",

          data: {glCode: glCode},
          success: function (data) {
            var data1 = JSON.parse(data);
              if(data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){

                  var accountTag    = data1.data_tag[0].ACCOUNT_TAG;
                  var autoposting   = data1.data_tag[0].AUTOPOSTING;
                  var costCenterTag = data1.data_tag[0].COST_TAG;

                  if((accountTag == 'YES') || (costCenterTag == 'YES')){
                    $('#dr_amount'+srno).prop('readonly',true);
                    $('#cr_amount'+srno).prop('readonly',true);
                  }else{
                    $('#dr_amount'+srno).prop('readonly',false);
                    $('#cr_amount'+srno).prop('readonly',false);
                  }

                /* --- check account tag YES if YES then account code req ----*/
                  
                  $('#acctTag'+srno).val(accountTag); 
                  if(accountTag == 'YES'){
                    var acCode = $('#acc_code'+srno).val();
                    if(acCode == ''){
                      $('#acc_code'+srno).css('border-color','red');
                    }else{}
                    
                  }else{
                    $('#acc_code'+srno).css('border-color','#d7d3d3');
                    $('#acc_code'+srno).val('');
                    $('#acc_name'+srno).val('');
                  }

                /* --- check account tag YES if YES then account code req ----*/

                  /* --- check account tag YES if YES then account code req ----*/
                  
                  $('#costCTag'+srno).val(costCenterTag); 
                  if(costCenterTag == 'YES'){
                    var costCode = $('#cost_code'+srno).val();
                    if(costCode == ''){
                      $('#cost_code'+srno).css('border-color','red');
                    }else{}
                    
                  }else{
                    $('#cost_code'+srno).css('border-color','#d7d3d3');
                    $('#cost_code'+srno).val('');
                    $('#costC_name'+srno).val('');
                  }

                /* --- check account tag YES if YES then account code req ----*/

                /* --- check autoposting tag YES if YES then jv not generate  ----*/

                  if(autoposting == 'YES'){
                    $('#autopostingApl'+srno).modal('show');
                    $('#autopsyYes'+srno).html("<b>*</b> Can't create <b>JV</b> for this <b>GL</b> ...!");
                  }else{

                  }

                /* --- check autoposting tag YES if YES then jv not generate  ----*/



              }
          }
      });
  }

  function filedBlank(srNo){
    $('#gl_code'+srNo).val('');
    $('#gl_name'+srNo).val('');
    $('#acc_code'+srNo).css('border-color','#d7d3d3');
  }

  function submitJournalData(valp){

      var downloadFlg = valp;

      $('#pdfYesNoStatus').val(downloadFlg);

      var data = $("#journaltrans").serialize();

      var rowIDget =[];

      $(".rowCountCls").each(function () {
        
         rowIDget.push(this.value);

      });

      var glcdAry = [];
      var amntAry =[];
      var revcdAry =[];
      for(var y=0;y<rowIDget.length;y++){

        var colIdSlno = rowIDget[y];

        var glCd   = $('#gl_code'+colIdSlno).val();
        var drAmnt = $('#dr_amount'+colIdSlno).val();
        var crAmnt = $('#cr_amount'+colIdSlno).val();

        var revCd = $('#rev_code'+colIdSlno).val();
        

        if(drAmnt=='' && crAmnt==''){
          amntAry.push('YES');
        }else{
           
        }

        glcdAry.push(glCd);
        revcdAry.push(revCd);

      }

      var glBlank = glcdAry.find(function (element) {
        return element == '';
      });

      var revBlank = revcdAry.find(function (element) {
        return element == '';
      });

      var amtBlank = amntAry.find(function (element) {
        return element == 'YES';
      });

      var drAmt = $('#totldramt').val();
      var crAmt = $('#totlcramt').val();

      if(drAmt != crAmt){
        $("#taxNotAppied").modal('show');
        $('#whenRowBlnk').html('Enter Details In above row otherwise delete the row.');
      }else if(glBlank == ''){
        $("#taxNotAppied").modal('show');
        $('#whenRowBlnk').html('Enter Details In above row otherwise delete the row.');
      }else if(amtBlank =='YES'){
        $("#taxNotAppied").modal('show');
        $('#whenRowBlnk').html('Enter Details In above row otherwise delete the row.');
      }else if(revBlank == ''){
        $("#taxNotAppied").modal('show');
        $('#whenRowBlnk').html('<b>Enter Details In above row otherwise delete the row.<b>');
      }else{

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });

        $.ajax({

          type: 'POST',

          url: "{{ url('/Transaction/Account/update-Journal-Trans') }}",

          data: data, // here $(this) refers to the ajax object not form
          success: function (data) {
              
              var data1 = JSON.parse(data);
              if(data1.response == 'error') {
                var responseVar = false;
                var url = "{{url('finance/journal_tran_msg')}}"
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }else{
                var responseVar = true;
                
                if(downloadFlg == 1){
                  var fyYear = data1.data[0].FY_CODE;
                  var fyCd = fyYear.split('-');
                  var seriesCd = data1.data[0].SERIES_CODE;
                  var vrNo = data1.data[0].VRNO;
                  var fileN = 'JV_'+fyCd[0]+''+seriesCd+''+vrNo;
                  var link = document.createElement('a');
                  link.href = data1.url;
                  link.download = fileN+'.pdf';
                  link.dispatchEvent(new MouseEvent('click'));
                }

                var url = "{{url('finance/journal_tran_msg')}}";
                setTimeout(function(){ window.location = url+'/'+responseVar; });
              }

          },

        });

      } /*  ---- else -----*/

      

  }


</script>


@endsection