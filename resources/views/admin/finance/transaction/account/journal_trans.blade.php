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
  .iconBtnSty{
      border-radius: 100px;
      padding: 4px;
  }
  .modltitletext {
    text-align: center;
    font-weight: 700;
    color: #5696bb;
  }
</style>





<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">



          <h1>

             Journal Transaction

            <small>Add Details</small>

          </h1>



          <ul class="breadcrumb">



            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>



            <li class="active"><a href="{{ url('/Transaction/Account/Journal-Trans') }}"> Journal</a></li>



            <li class="active"><a href="{{ url('/Transaction/Account/Journal-Trans') }}">Add Journal</a></li>



          </ul>



        </section>





<form id="journaltrans">

              @csrf

  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;">Journal Transaction</h2>



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

                      <?php 

                                $CurrentDate =date("d-m-Y");
                                   
                                $FromDate    = date("d-m-Y", strtotime($fromDate));  
                                   
                                $ToDate      = date("d-m-Y", strtotime($toDate));  
                                   
                                $spliDate    = explode('-', $CurrentDate);
                                   
                                $yearGet     = Session::get('macc_year');
                                   
                                $fyYear      = explode('-', $yearGet);
                                   
                                $get_Month   = $spliDate[1];
                                $get_year    = $spliDate[2];

                                if($get_Month > 3 && $get_year == $fyYear[1]){
                                    $vrDate = $ToDate;
                                }else{
                                    $vrDate = $CurrentDate;
                                }

                              ?>

                      <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                      <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                      <input type="text" class="form-control transdatepicker rightcontent" name="vr_date" id="vr_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

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

                          <input type="text" class="form-control" name="tran_code" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

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
                      <?php $srcount  =  count($series_list); ?>

                      <input list="seriesList"  id="series_code" name="series_Code" class="form-control  pull-left seriesWidth" value="<?php if($srcount ==1){echo $series_list[0]->SERIES_CODE;}else{ echo old('series_code');} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" onchange="getvrnoBySeries()"  autocomplete="off">

                      <datalist id="seriesList">

                        <option selected="selected" value="">-- Select --</option>
                        @foreach ($series_list as $key)

                        <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                        @endforeach

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

                      <input id="seriesText" name="series_Name" class="form-control  pull-left" value="<?php if($srcount ==1){echo $series_list[0]->SERIES_NAME;}else{ } ?>" placeholder="Enter Series Name" autocomplete="off" readonly="">

                      

                    </div>
                  
                          

              </div>
                    <!-- /.form-group -->
            </div>

            <div class="col-md-2">

              <div class="form-group">
              
                <label> Vr No: </label>

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                    <input type="hidden" name="" value="" id="vr_last_num">
                    
                    <input type="text" class="form-control rightcontent" name="vrno" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">

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
                    <?php $pfctcount = count($pfct_list); ?>
                    <input list="profitList"  id="profitId" name="pfct_code" class="form-control  pull-left" value="<?php if($pfctcount == 1){echo $pfct_list[0]->PFCT_CODE;}else{echo old('pfct_code');} ?>" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()"  autocomplete="off">

                    <datalist id="profitList">

                      <option selected="selected" value="">-- Select --</option>

                      @foreach ($pfct_list as $key)

                      <option value='<?php echo $key->PFCT_CODE?>'   data-xyz ="<?php echo $key->PFCT_NAME; ?>" ><?php echo $key->PFCT_NAME ; echo " [".$key->PFCT_CODE."]" ; ?></option>

                      @endforeach

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

                    <input type="text" class="form-control" id="profit_name" name="pfct_name" placeholder="Enter Profit Center Name" value="<?php if($pfctcount == 1){echo $pfct_list[0]->PFCT_NAME;}else{} ?>" readonly autocomplete="off">

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
                      <?php $salerCd = count($sale_rep_list); ?>

                      <input list="saleRepList" class="form-control" id="sale_rep_code" name="saleRepCode" placeholder="Select Sale Rep. code" maxlength="55" value="<?php if($salerCd == 1){echo $sale_rep_list[0]->ACC_CODE; echo "[ ".$sale_rep_list[0]->ACC_NAME." ]";}?>"  autocomplete="off">

                      <datalist id="saleRepList">

                         <option value="">--SELECT--</option>

                         @foreach ($sale_rep_list as $key)

                        <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME; echo " [".$key->ACC_CODE."]"; ?></option>

                        @endforeach

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

                  <tr class="useful">

                    <td class="tdthtablebordr"><input type='checkbox' class='case' title="Delete Single Row" />
                      <span id='snum'>1.</span>
                      <input type="hidden" name="totlRwCount[]" class="rowCountCls" value="1" id="totlCountRw1">
                    </td>

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
                        <small id="glReqMsg1" style="color:red;"></small>
                        <input list="GlList1" class="inputboxclr" style="margin-bottom: 5px;" id='gl_code1' name="gl_code[]" placeholder="Enter Gl Code" onchange="GlListData(1)" oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly />

                        <datalist id="GlList1">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($gl_list as $key)

                            <option value='<?php echo $key->GL_CODE?>' data-xyz ="<?php echo $key->GL_NAME; ?>" ><?php echo $key->GL_NAME ; echo " [".$key->GL_CODE."]" ; ?></option>

                            @endforeach

                        </datalist>
                        <input type="hidden" id="acctTag1" value="">
                        <input type="hidden" id="costCTag1" value="">
                      </div>

                      <div class="input-group" style="display:flex;">
                        <small id="accReqMsg1" style="color:red;"></small>
                        <input list="AccList1" class="inputboxclr" style="margin-bottom: 5px;" id="acc_code1" placeholder="Enter Account Code" name="acc_code[]" onchange="AccListData(1)" oninput="this.value = this.value.toUpperCase()" autocomplete="off" readonly />

                        <datalist id="AccList1">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($account_list as $key)

                            <option value='<?php echo $key->ACC_CODE?>' data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                            @endforeach

                        </datalist>

                      </div>

                      <div class="input-group" style="display:flex;">
                        <small id="costCenMsg1" style="color:red;"></small>
                        <input list="costCList1" class="inputboxclr" style="margin-bottom: 5px;" id='cost_code1' name="cost_code[]" placeholder="Enter Cost Center Code" onchange="costCListData(1)" autocomplete="off"/>

                        <datalist id="costCList1">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($cost_list as $key)

                            <option value='<?php echo $key->COST_CODE?>' data-xyz ="<?php echo $key->COST_NAME; ?>" ><?php echo $key->COST_NAME ; echo " [".$key->COST_CODE."]" ; ?></option>

                            @endforeach

                        </datalist>
                        
                      </div>

                      <div class="input-group" style="display:flex;">
                        <input list="revCList1" class="inputboxclr" style="margin-bottom: 5px;" id='rev_code1' name="rev_code[]" placeholder="Enter Reverse Code" onchange="revListData(1)" readonly autocomplete="off"/>

                        <datalist id="revCList1">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($reverseCdData as $key)

                            <option value='<?php echo $key->REVCODE?>' data-xyz ="<?php echo $key->REVNAME; ?>~<?php echo $key->REVTYPE;?>" ><?php echo $key->REVNAME ; echo " [".$key->REVCODE."]" ; ?></option>

                            @endforeach

                        </datalist>
                        
                      </div>
                      <input type="hidden" name="revName[]" id="revName1">
                      <input type="hidden" name="revType[]" id="revType1">
                      
                    </td>

                    <td class="tdthtablebordr"  style="width:45%;">

                      <input type="text" class="inputboxclr" style="margin-bottom: 5px;" id='gl_name1' name="gl_name[]" placeholder="Enter Gl Name" readonly /><br>

                      <input type="text" class="inputboxclr" style="margin-bottom: 5px;" id='acc_name1' name="acc_name[]" placeholder="Enter Account Name" readonly /><br>

                      <input type="text" class="inputboxclr" style="margin-bottom: 5px;" id='costC_name1' name="costC_name[]" placeholder="Enter Cost Center Name" readonly /><br>

                      <div class="input-group" style="display:flex;">

                        <input type="text" class="inputboxclr" style="margin-bottom: 5px;" id='discription1' name="particular[]" placeholder="Enter Remark" readonly /><br>

                        <!-- <input list="remarkList1" class="inputboxclr" id='discription1' name="particular[]" placeholder="Enter Remark" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>

                        <datalist id="remarkList1">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($remark_list as $key)

                            <option value='To - < ?php echo $key->REMARK?>' data-xyz ="To - < ?php echo $key->REMARK; ?>" >To - < ?php echo $key->REMARK ; ?></option>

                            @endforeach

                        </datalist> -->

                      </div>

                      <div class="input-group" style="display:flex;">

                        <input list="remarkList1" class="inputboxclr" id='narration1' name="narration[]" placeholder="Enter Narration" oninput="this.value = this.value.toUpperCase()" autocomplete="off"/>

                        <datalist id="remarkList1">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($remark_list as $key)

                            <option value='To - <?php echo $key->REMARK?>' data-xyz ="To - <?php echo $key->REMARK; ?>" >To - <?php echo $key->REMARK ; ?></option>

                            @endforeach

                        </datalist>

                      </div>

                    </td>

                    <td class="tdthtablebordr"  style="width:15%;vertical-align: middle;">
                      <input type='text' class="debitcreditbox dr_amount inputboxclr"  id='dr_amount1' name="dr_amount[]" autocomplete="off" onkeypress='NumberCredit()' oninput='GetDebitAmount(1)' readonly/>
                    </td>

                    <td class="tdthtablebordr"  style="width:15%;vertical-align: middle;">
                      <input type='text' class="debitcreditbox inputboxclr cr_amount" id='cr_amount1' name="cr_amount[]" autocomplete="off" onkeypress='NumberCredit()' oninput='GetCreditAmount(1)' readonly />

                      <input type="hidden" name="GettdsName[]" id="GettdsName1">
                      <input type="hidden" name="GettdsCode[]" id="GettdsCode1">
                      <input type="hidden" name="tdsRateH[]" id="tds_RateH1">
                      <input type="hidden" name="tdsCutAmt[]" id="tds_cutAmtH1">
                      <input type="hidden" name="netAmnt[]" id="netAmtH1">
                      <input type="hidden" name="tdsBaseAmt[]" id="tdsBaseAmtH1">
                      <input type="hidden" name="isTDSApply[]" id="isTDSApply1" value="0">

                      <!-- START TDS BUTTON CODE -- -->
                      <input type="hidden" id="tdsByAccCode1" value="" name="tdsCodeByAc[]">
                      <div style="display: flex;">
                        <button type='button' class='btn btn-primary btn-xs tdsratebtnHide' id='tds_rate1' data-toggle='modal' data-target='#tds_rate_model1' onclick='CalculateTdsRate(1)' style="padding: 0px;" disabled>Calc TDS</button>
                        <div id="appliedbtn1" style="margin-top: 3px;"></div>
                        <div id="canclebtn1" style="margin-top: 3px;"></div>
                      </div>
                      <!-- END TDS BUTTON CODE -- -->
                    </td>

                  </tr>

                </table>

              </div>

              <div class="row">

                <div class="col-md-3">
                  <button type="button" class='btn btn-danger delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                  <button type="button" class='btn btn-info addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
                </div>

                <div class="col-md-4">
                  <input type="hidden" name="pdfYesNoStatus" id="pdfYesNoStatus" value="">
                  <button class="btn btn-success" type="button" id="submitdata" onclick="submitJournalData(0)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                  <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancel</button>

                  <button class="btn btn-success" type="button" id="submitdatapdf" onclick="submitJournalData(1)" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download Pdf</button>
                </div>

                <div class="col-md-5">
                  <div id="showgreatermsg" style="text-align: end;color: red;"></div>
                  <div style="display:flex;float:right;">
                    <div class="totlsetinres" style="margin-top: 7px;"><b>Total : </b>&nbsp;</div>
                    <input class="crdrTotal inputboxclr" type="text" name="TotlDebit" id="totldramt" readonly>&nbsp;
                    <input class="crdrTotal inputboxclr" type="text" name="TotalCredit"  id="totlcramt" readonly>
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

<!------- MODAL FOR CALCULATE TDS ------------>

      <div class="modal fade" id="tds_rate_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
                    <input type="text" id="tds_name1" name="tds_section[]" value="" style="margin-bottom:3px;" readonly>
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Tds Rate</label>
                    
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="tdsRate1" name="tdsRates[]" readonly style="text-align: right;margin-bottom:3px;">
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Tds Base Amount</label>
                    
                  </div>
                  <div class="col-md-4">
                    <input type="hidden" id="tds_base_Amt1" name="baseTDSAmt[]" value="">
                    <input type="text" id="Net_amount1" readonly style="text-align: right;">
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Tds Amount calculate</label>
                    
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="tds_Amt_cal1" readonly style="text-align: right;">
                  </div>
                  <div class="col-md-2"></div>
              </div>
              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Net Amount</label>
                    
                  </div>
                  <div class="col-md-4">
                    <input type="text" id="deduct_tds_Amt1" readonly name="base_amt_tds[]" style="text-align: right;">
                  </div>
                  <div class="col-md-2"></div>
              </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-primary" style="width: 30%;padding: 3px;" data-dismiss="modal" id="ApplyTds1" onclick="Applytds(1)">Apply TDS</button>
              <button type="button" class="btn btn-warning" style="width: 24%;padding: 3px;" data-dismiss="modal" onclick="cancleBtntds(1)">Cancle</button>
            </div>
          </div>
        </div>
      </div>

<!------- MODAL FOR CALCULATE TDS ------------>

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
</script>

<script type="text/javascript">

  function getvrnoBySeries(){

      var seriesCode = $('#series_code').val();
      var transcode  = $('#transcode').val();

      $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
      });

      $.ajax({

          url:"{{ url('get-last-no-vr-sequence-by-series-new') }}",

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
                        var lastNo = parseInt(getlastno) +  parseInt(1);
                        $('#vrseqnum').val(lastNo);
                        $('#transerror').html('');
                    }else{
                        var getlastno = '';
                        $('#transerror').html('');
                    }
                  }

              }

          }

      });

    }

  
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

        getvrnoBySeries();
        fieldValidation();

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

var i=2;

$(".addmore").on('click',function(){

      var getpaymode = 'To -';

    count=$('table tr').length;

    var data="<tr class='useful'><td class='tdthtablebordr'><input type='checkbox' class='case' title='Delete Single Row' /><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='totlRwCount[]' class='rowCountCls' value='"+i+"' id='totlCountRw"+i+"'></td><td class='tdthtablebordr' style='width:10%;'><div class='row lableName'><small class='fieldLable'>Gl Code</small></div><div class='row lableName' style='margin-top: 12px;'><small class='fieldLable'>Account Code</small></div><div class='row lableName' style='margin-top: 12px;'><small class='fieldLable'>Cost Code</small></div><div class='row lableName' style='margin-top: 12px;'><small class='fieldLable'>Reverse Code</small></div></td>";

    data +="<td class='tdthtablebordr' style='width:15%;'><div class='input-group' style='display:flex;'><small id='glReqMsg"+i+"' style='color:red;'></small><input list='GlList"+i+"' class='inputboxclr' style='margin-bottom: 5px;' id='gl_code"+i+"' name='gl_code[]' placeholder='Enter Gl Code' onchange='GlListData("+i+")' oninput='this.value = this.value.toUpperCase()' /><datalist id='GlList"+i+"'><option selected='selected' value=''>-- Select --</option> @foreach ($gl_list as $key)<option value='<?php echo $key->GL_CODE?>' data-xyz ='<?php echo $key->GL_NAME; ?>' ><?php echo $key->GL_NAME ; echo ' ['.$key->GL_CODE.']' ; ?></option>@endforeach</datalist><input type='hidden' id='acctTag"+i+"' value=''><input type='hidden' id='costCTag"+i+"' value=''></div><div class='input-group' style='display:flex;'><small id='accReqMsg"+i+"' style='color:red;'></small><input list='AccList"+i+"' class='inputboxclr' style='margin-bottom: 5px;' id='acc_code"+i+"' placeholder='Enter Account Code' name='acc_code[]' onchange='AccListData("+i+")' oninput='this.value = this.value.toUpperCase()' /><datalist id='AccList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($account_list as $key)<option value='<?php echo $key->ACC_CODE?>' data-xyz ='<?php echo $key->ACC_NAME; ?>' ><?php echo $key->ACC_NAME ; echo ' ['.$key->ACC_CODE.']' ; ?></option> @endforeach</datalist></div><div class='input-group' style='display:flex;'><small id='costCenMsg"+i+"' style='color:red;'></small><input list='costCList"+i+"' class='inputboxclr' style='margin-bottom: 5px;' id='cost_code"+i+"' name='cost_code[]' placeholder='Enter Cost Center Code' onchange='costCListData("+i+")' /><datalist id='costCList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($cost_list as $key)<option value='<?php echo $key->COST_CODE?>' data-xyz ='<?php echo $key->COST_NAME; ?>' ><?php echo $key->COST_NAME ; echo ' ['.$key->COST_CODE.']' ; ?></option>@endforeach</datalist></div><div class='input-group' style='display:flex;'><input list='revCList"+i+"' class='inputboxclr' style='margin-bottom: 5px;' id='rev_code"+i+"' name='rev_code[]' placeholder='Enter Reverse Code' onchange='revListData("+i+")' readonly autocomplete='off'/><datalist id='revCList"+i+"'><option selected='selected' value=''>-- Select --</option> @foreach ($reverseCdData as $key)<option value='<?php echo $key->REVCODE?>' data-xyz ='<?php echo $key->REVNAME; ?>' ><?php echo $key->REVNAME ; echo ' ['.$key->REVCODE.']' ; ?></option> @endforeach</datalist></div><input type='hidden' name='revName[]' id='revName"+i+"'><input type='hidden' name='revType[]' id='revType"+i+"'></td>"+
      "<td class='tdthtablebordr'  style='width:45%;'><input type='text' class='inputboxclr' style='margin-bottom: 5px;' id='gl_name"+i+"' name='gl_name[]' placeholder='Enter Gl Name' readonly /><br><input type='text' class='inputboxclr' style='margin-bottom: 5px;' id='acc_name"+i+"' name='acc_name[]' placeholder='Enter Account Name' readonly /><br><input type='text' class='inputboxclr' style='margin-bottom: 5px;' id='costC_name"+i+"' name='costC_name[]' placeholder='Enter Cost Center Name' readonly /><br><div class='input-group' style='display:flex;'><input type='text' class='inputboxclr' style='margin-bottom: 5px;' id='discription"+i+"' name='particular[]' placeholder='Enter Remark' readonly /><br></div><div class='input-group' style='display:flex;'><input list='remarkList"+i+"' class='inputboxclr' id='narration"+i+"' name='narration[]' placeholder='Enter Narration' oninput='this.value = this.value.toUpperCase()' autocomplete='off'/><datalist id='remarkList"+i+"'><option selected='selected' value=''>-- Select --</option>@foreach ($remark_list as $key)<option value='To - <?php echo $key->REMARK?>' data-xyz ='To - <?php echo $key->REMARK; ?>' >To - <?php echo $key->REMARK ; ?></option>@endforeach</datalist></div></td>"+
      "<td class='tdthtablebordr'  style='width:15%;vertical-align: middle;'><input type='text' class='debitcreditbox dr_amount inputboxclr'  id='dr_amount"+i+"' name='dr_amount[]' onkeypress='NumberCredit()' oninput='GetDebitAmount("+i+")' readonly /></td>"+
      "<td class='tdthtablebordr'  style='width:15%;vertical-align: middle;'><input type='text' class='debitcreditbox inputboxclr cr_amount' id='cr_amount"+i+"' name='cr_amount[]' onkeypress='NumberCredit()' oninput='GetCreditAmount("+i+")' readonly />"+
      "<input type='hidden' name='GettdsName[]' id='GettdsName"+i+"'><input type='hidden' name='GettdsCode[]' id='GettdsCode"+i+"'><input type='hidden' name='tdsRateH[]' id='tds_RateH"+i+"'><input type='hidden' name='tdsCutAmt[]' id='tds_cutAmtH"+i+"'><input type='hidden' name='netAmnt[]' id='netAmtH"+i+"'><input type='hidden' name='tdsBaseAmt[]' id='tdsBaseAmtH"+i+"'><input type='hidden' name='isTDSApply[]' id='isTDSApply"+i+"' value='0'><input type='hidden' id='tdsByAccCode"+i+"' value='' name='tdsCodeByAc[]'><div style='display: flex;'><button type='button' class='btn btn-primary btn-xs tdsratebtnHide' id='tds_rate"+i+"' data-toggle='modal' data-target='#tds_rate_model"+i+"' onclick='CalculateTdsRate("+i+")' style='padding: 0px;' disabled>Calc TDS</button><div id='appliedbtn"+i+"' style='margin-top: 3px;'></div><div id='canclebtn"+i+"' style='margin-top: 3px;'></div></div>"+
      /* ---- SHOW AUTOPOSTING YES MODAL ---- */
      "<div id='autopostingApl"+i+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'  style='text-align: center;'><h5 class='modal-title' style='color: red;font-weight: 800;'>Alert !!</h5></div><div class='modal-body'><p id='autopsyYes"+i+"' style='line-height:15px;'></p></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' data-dismiss='modal' style='width: 26%;' onclick='filedBlank("+i+")'>OK</button></div></div></div></div> "+
      /* ---- TDS CALCULATION MODAL ------ */
      "<div class='modal fade' id='tds_rate_model"+i+"' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true' data-keyboard='false' data-backdrop='static'><div class='modal-dialog modal-sm' role='document' style='margin-top: 13%;'><div class='modal-content' style='border-radius: 5px;'><div class='modal-header'><h5 class='modal-title modltitletext' id='exampleModalLabel'>Calculate TDS</h5></div><div class='modal-body'><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Section</label></div><div class='col-md-4'><input type='text' id='tds_name"+i+"' name='tds_section[]' value='' style='margin-bottom:3px;' readonly></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Rate</label></div><div class='col-md-4'><input type='text' id='tdsRate"+i+"' name='tdsRates[]' readonly style='text-align: right;margin-bottom:3px;'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Base Amount</label></div><div class='col-md-4'><input type='hidden' id='tds_base_Amt"+i+"' name='baseTDSAmt[]' value=''><input type='text' id='Net_amount"+i+"' readonly style='text-align: right;'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Tds Amount calculate</label></div><div class='col-md-4'><input type='text' id='tds_Amt_cal"+i+"' readonly style='text-align: right;'></div><div class='col-md-2'></div></div><div class='row tdsInputBox'><div class='col-md-4'><label class='textSizeTdsModl'>Net Amount</label></div><div class='col-md-4'><input type='text' id='deduct_tds_Amt"+i+"' readonly name='base_amt_tds[]' style='text-align: right;'></div><div class='col-md-2'></div></div></div><div class='modal-footer' style='text-align: center;'><button type='button' class='btn btn-primary' style='width: 30%;padding: 3px;' data-dismiss='modal' id='ApplyTds"+i+"' onclick='Applytds("+i+")'>Apply TDS</button><button type='button' class='btn btn-warning' style='width: 24%;padding: 3px;' data-dismiss='modal' onclick='cancleBtntds("+i+")'>Cancle</button></div></div></div></div> </td></tr>";

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

          id=value.id;

          $('#'+id).html(key+1);

        });

    }

    

}


</script>


<script type="text/javascript">

  

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

                  /*if((accountTag == 'YES') || (costCenterTag == 'YES')){
                    $('#dr_amount'+srno).prop('readonly',true);
                    $('#cr_amount'+srno).prop('readonly',true);
                  }else{
                    $('#dr_amount'+srno).prop('readonly',false);
                    $('#cr_amount'+srno).prop('readonly',false);
                  }*/

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
      var amntAry = [];
      var revcdAry = [];

      for(var y=0;y<rowIDget.length;y++){
        var colIdSlno = rowIDget[y];
        var glCd = $('#gl_code'+colIdSlno).val();
        glcdAry.push(glCd);

        var revCd = $('#rev_code'+colIdSlno).val();
        revcdAry.push(revCd);

        var drAmnt = $('#dr_amount'+colIdSlno).val();
        var crAmnt = $('#cr_amount'+colIdSlno).val();

        if((drAmnt=='' && crAmnt=='')){
          amntAry.push('YES');
        }else{
           
        }

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

      if(glBlank == ''){
        $("#taxNotAppied").modal('show');
        $('#whenRowBlnk').html('<b>Enter Details In above row otherwise delete the row.</b>');
      }else if(revBlank == ''){
        $("#taxNotAppied").modal('show');
        $('#whenRowBlnk').html('<b>Enter Details In above row otherwise delete the row.<b>');
      }else if(amtBlank =='YES'){
        $("#taxNotAppied").modal('show');
        $('#whenRowBlnk').html('<b>Enter Details In above row otherwise delete the row.<b>');
      }else if(drAmt >0.00 != crAmt > 0.00){
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

          url: "{{ url('/Transaction/Account/Save-Journal-Trans') }}",

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