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
    font-size: 18px;

  }
.required-field{
  margin-right: 2px!important;
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
   /*padding-inline: 50px;*/

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
  .classAddrs{
    display:flex;
  }
  

 .iconshowhide{
    display:none;
  }

  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 12%), 0 1px 2px 4px rgb(0 0 0 / 8%);
}

</style>


<div class="content-wrapper">

  <!-- Content Header (Page header) -->

    <section class="content-header">

      <h1>Master Account<small>Update Details</small></h1>

        <ol class="breadcrumb">

          <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

          <li><a href="{{ URL('/dashboard')}}">Master</a></li>

          <li class="Active"><a href="">Master Account </a></li>

          <li class="Active"><a href="">Update Master Account </a></li>

        </ol>

    </section>

    <section class="content">

      <div class="row">

         @if(Session::has('alert-success'))

              <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i>Success...!</h4>

                {!! session('alert-success') !!}

              </div>

            @endif

            @if(Session::has('alert-error'))

              <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-ban"></i>Error...!</h4>

                {!! session('alert-error') !!}

              </div>

            @endif

            <div class="stepwizard">

                <div class="stepwizard-row setup-panel">

                  <div class="stepwizard-step">

                      <a href="#step-1" type="button" class="btn btn-primary btn-circle" id="stepone" style="pointer-events: none">1</a>

                      <p>Baisc Details</p>

                  </div>

                 <!--  <div class="stepwizard-step hidebegore" id="show_second">

                      <a href="#step-2" type="button" class="btn btn-default btn-circle" id="steptwo" style="pointer-events: none">2</a>

                      <p>Direct/Indirect Tax</p>

                  </div> -->

                  <div class="stepwizard-step hidebegore" id="show_second">

                      <a href="#step-2" type="button" class="btn btn-default btn-circle" id="steptwo" style="pointer-events: none">2</a>

                      <p>Address Details</p>

                  </div>

                   <!-- <div class="stepwizard-step hideThired" id="show_third">

                      <a href="#step-3" type="button" class="btn btn-default btn-circle" id="stepthree" style="pointer-events: none">4</a>

                      <p>Bank Details</p>

                  </div> -->

                </div>

              </div><!-- stepwizard -->

        <form action="{{ url('/Master/Customer-Vendor/Account-Update') }}" method="POST" id="InwardTrnas">

        @csrf   

        <div class="col-md-12"> 

        <div class="row setup-content" id="step-1">  

          <div class="col-sm-12">

            <div class="box box-primary Custom-Box">

              <div class="box-header with-border" style="text-align: center;">

                <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update Account</h2>

                <div class="box-tools pull-right">

                  <a href="{{ url('Master/Customer-Vendor/View-Account-Mast')}}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View Account</a>

                </div>

              </div><!-- /.box-header -->

              <div class="box-body">

                 <div class="col-xs-12">

                  <div class="col-md-12">

                    <div class="row">

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Account Type Code: 
                          </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="text" class="form-control" name="acctype_code" value="<?php echo $PartyFinance_list->ATYPE_CODE ?>[<?php echo  $PartyFinance_list->ATYPE_NAME?>]" readonly=""> 
                          <!--   <select class="form-control" name="acctype_code" id="acctype_code" maxlength="6">

                                    <option value="">--Select--</option>

                                   <?php foreach ($acctype_lists as $key) { ?>

                                   <option value="<?php echo $key->ATYPE_CODE ?>[<?php echo  $key->ATYPE_NAME?>]" <?php if($PartyFinance_list->ATYPE_CODE == $key->ATYPE_CODE){echo "selected";} ?>><?php echo $key->ATYPE_CODE?>[<?php echo   $key->ATYPE_NAME?>]</option>
                                   
                                      <?php } ?>

                                </select> -->


                          </div>

                          <small id="transcodeErr" class="form-text text-muted"></small>

                        </div><!-- /.form-group -->
                        <input type="hidden" id="isBankReq">
                      </div><!-- /col -->

                     

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Account Name: <span class="required-field"></span>

                          </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                            <input type="text" id="acc_name" name="acc_name" class="form-control  pull-left" value="{{ $PartyFinance_list->ACC_NAME }}" placeholder="Select Acc Name" maxlength="40">

                          </div>

                          <small id="accnameErr" class="form-text text-muted"></small>

                        </div><!-- /.form-group -->

                      </div>

                       <div class="col-md-3">

                        <div class="form-group">

                          <label>Account Code: <span class="required-field"></span></label>



                            <div class="input-group">



                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input type="hidden" name="F_party_id" id="party_id" value="{{ $PartyFinance_list->ACC_CODE }}">

                              <input type="hidden" name="acc_code_id" id="acc_code_id" value="{{ $PartyFinance_list->ACC_CODE }}">

                              <input type="text" id="acc_code" name="acc_code" class="form-control pull-left" placeholder="Select Acc Code" value="{{ $PartyFinance_list->ACC_CODE }}" maxlength="6" readonly="">
                            
                            </div>

                            <small id="acccodeErr" class="form-text text-muted"> </small>

                        </div><!-- /.form-group -->

                      </div><!-- /.col -->

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>GL Code: <span class="required-field"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                                <?php $glcount = count($gl_lists); 

                                $glcode = $PartyFinance_list->GL_CODE;
                                $glname = $PartyFinance_list->GL_NAME;
                                $glname_code = '';
                                if($glcode != '' && $glname!=''){

                                  $glname_code = $glcode.'['.$glname.']';

                                }else{
                                  $glname_code = '';
                                }
                                
                                ?>

                                  <input list="GLList" type="text" class="form-control" name="gl_code" id="gl_code" placeholder="Select Gl Code" maxlength="6" value="<?php echo $glname_code ?>" autocomplete="off">

                                  <datalist id="GLList">
                                    <option value="">--Select--</option>

                                    <?php foreach ($gl_lists as $key) { ?>

                                      <option value="<?php echo $key->GL_CODE  ?>" data-xyz="{{ $key->GL_NAME }}"><?php echo $key->GL_CODE?> = <?php echo $key->GL_NAME?></option>


                                    <?php } ?>

                                  </datalist>
                              
                            </div>
                            <small id="glcodeErr"  class="form-text text-muted"></small>
                            
                        </div>

                        <!-- /.form-group -->

                      </div><!-- /col -->

                    </div>

                    <div class="row">
                      
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Company Code:</label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input list="compList" id="comp_code" name="comp_code" class="form-control pull-left" placeholder="Select Company Code" value="{{ $PartyFinance_list->COMP_CODE }}" maxlength="6" readonly>

                              <datalist id="compList">

                                  @foreach($company_lists as $key) 

                                    <option value="{{$key->COMP_CODE}}" data-xyz="{{ $key->COMP_NAME  }}">{{$key->COMP_CODE }} = {{$key->COMP_NAME}}</option>

                                  @endforeach

                              </datalist>

                            </div>

                        </div>
                        <!-- /.form-group -->
                      </div><!-- /.col -->

                      <div class="col-md-3">
                        
                        <div class="form-group">

                          <label>Company Name : </label>
                            
                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                              <input  type="text" class="form-control" name="comp_name" id="comp_name" placeholder="Select Company Name" value="{{ $PartyFinance_list->COMP_CODE }}" readonly>

                            </div>

                        </div>
                      </div><!-- /.col -->
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Account Category Code: 
                          </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <select class="form-control" name="acccategory_code" id="acccategory_code" maxlength="6">

                                <option value="">--Select--</option>

                               <?php foreach ($acccategory_lists as $key) { ?>

                               <option value="<?php echo $key->ACATG_CODE ?>[<?php echo   $key->ACATG_NAME?>]" <?php if($PartyFinance_list->ACATG_CODE == $key->ACATG_CODE){echo "selected";} ?>><?php echo $key->ACATG_CODE?>[<?php echo   $key->ACATG_NAME?>]</option>

                                  <?php } ?>

                            </select>

                          </div>

                          <small id="transcodeErr" class="form-text text-muted"></small>

                        </div><!-- /.form-group -->

                      </div><!-- /col -->

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Account Class Code:</label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <select class="form-control" name="accclass_code" id="accclass_code" maxlength="6">

                                  <option value="">--Select--</option>

                                  <?php foreach ($accclass_lists as $key) { ?>

                                    <option value="<?php echo $key->ACLASS_CODE ?>[<?php echo $key->ACLASS_NAME?>]" <?php if($PartyFinance_list->ACLASS_CODE == $key->ACLASS_CODE ){echo "selected";} ?>><?php echo $key->ACLASS_CODE ?>[<?php echo $key->ACLASS_NAME?>]</option>

                                  <?php } ?>

                              </select>
                        
                            </div>

                            <small id="taxcodeErr" class="form-text text-muted"> </small>

                        </div><!-- /.form-group -->

                      </div><!-- /.col -->

                      

                    </div>

                    <div class="row">
                    
                      <div class="col-md-3">

                        <div class="form-group">

                          <label>Credit Limit: </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input type="text" class="form-control" name="credit_limit" id="credit_limit" placeholder="Enter Credit Limit"  value="{{ $PartyFinance_list->CREADIT_LIMIT }}"  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))">
                              
                            </div>

                            <div class="pull-left showSeletedName" id="accClassText"></div>

                            <small id="taxcodeErr" class="form-text text-muted"> </small>

                        </div>

                        <!-- /.form-group -->

                      </div><!-- col -->

                      <div class="col-md-3">

                        <div class="form-group">

                          <label>GP Days: </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input type="text" class="form-control" value="{{ $PartyFinance_list->GP_DAYS }}" name="gp_days" id="gp_days" placeholder="Enter GP Days">
                              
                            </div>

                            <div class="pull-left showSeletedName" id="accClassText"></div>

                            <small id="gpErr" class="form-text text-muted"> </small>

                        </div>

                        <!-- /.form-group -->

                      </div><!-- /col -->

                      <div class="col-md-2">

                        <div class="form-group">

                          <label>Alias Code :</span> </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input type="text" class="form-control" name="AliasCode" id="AliasCodeId" placeholder="Enter Alias Code" value="{{ $PartyFinance_list->ALIAS_CODE }}" autocomplete="off">
                              
                            </div>
                            <small id="aliasCod" class="form-text text-muted"></small>
                            <div class="pull-left showSeletedName" id="accClassText"></div>

                        </div><!-- /.form-group -->

                      </div><!-- col -->

                      <div class="col-md-4">

                        <div class="form-group">

                          <label>Alias Name : </label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                              <input type="text" class="form-control" name="AliasName" id="AliasNameId" placeholder="Enter Alias Name" value="{{ $PartyFinance_list->ALIAS_NAME }}" autocomplete="off">
                              
                            </div>
                            <small id="aliasNm" class="form-text text-muted"> </small>
                            <div class="pull-left showSeletedName" id="accClassText"></div>

                        </div>
                      </div><!-- col -->

                    <!--   <center> <button class="btn btn-primary btn-md nextBtn" type="button" id="firstStep">Next</button></center>
 -->
                    </div><!-- row -->

                    <div class="row">

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>SAP Code : </label>

                        <div class="input-group">

                          <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </span>
                          <input type="text" class="form-control" name="sap_code" id="sapCode" placeholder="Enter SAP Code"  value="{{ $PartyFinance_list->SAP_CODE }}" autocomplete="off">
                        </div>
                        <small id="taxcodeErr" class="form-text text-muted"> </small>
                        <div class="pull-left showSeletedName" id="sapCodeText"></div>
                    </div> <!-- /.form-group -->
                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>File Path : </label>

                        <div class="input-group">

                          <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </span>
                          <input type="text" class="form-control" name="file_path" id="filePath" placeholder="Enter File Path"  value="{{ $PartyFinance_list->FILE_PATH }}" autocomplete="off">
                        </div>
                        <small id="taxcodeErr" class="form-text text-muted"> </small>
                        <div class="pull-left showSeletedName" id="filePathText"></div>
                    </div> <!-- /.form-group -->
                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Bill Format : </label>

                        <div class="input-group">

                          <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </span>

                          <input list="accBillFormat" class="form-control" name="bill_format" id="billFormat" placeholder="Select Bill Format" value="<?php echo $PartyFinance_list->BILL_FORMAT; ?>" autocomplete="off">

                          <datalist id="accBillFormat">
                            <option value="">--Select--</option>

                              <option value="JSW_BILL" <?php if($PartyFinance_list->BILL_FORMAT == "JSW_BILL"){echo "selected";} ?> data-xyz="JSW_BILL">JSW_BILL</option>
                              <option value="TATA_BILL" <?php if($PartyFinance_list->BILL_FORMAT == "TATA_BILL"){echo "selected";} ?> data-xyz="TATA_BILL">TATA_BILL</option>
                              <option value="JCOP_BILL" <?php if($PartyFinance_list->BILL_FORMAT == "JCOP_BILL"){echo "selected";} ?> data-xyz="JCOP_BILL">JCOP_BILL</option>
                              <option value="C_AND_F_BILL" <?php if($PartyFinance_list->BILL_FORMAT == "C_AND_F_BILL"){echo "selected";} ?> data-xyz="C_AND_F_BILL">C_AND_F_BILL</option>
                              <option value="OTHER_PARTY" <?php if($PartyFinance_list->BILL_FORMAT == "OTHER_PARTY"){echo "selected";} ?> data-xyz="OTHER_PARTY">OTHER_PARTY</option>

                          </datalist>

                        </div>

                        <small id="taxcodeErr" class="form-text text-muted"> </small>

                        <div class="pull-left showSeletedName" id="billFormatText"></div>

                    </div> <!-- /.form-group -->
                  </div>
                </div> <!-- ./row -->

                  </div><!-- col-md  -->

              </div><!-- col-xs -->
              </div><!-- /.box-body -->

            </div><!-- /.custom-box -->

            <div class="box box-warning Custom-Box">
             
              <div class="box-header with-border" style="text-align: center;">

                <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Direct/Indirect Tax</h2>
              </div><!-- /.box-header -->

              <div class="box-body">
                
                <div class="col-xs-12">

                <div class="col-md-12">

                  <div class="row">

                    <div class="col-md-2">

                      <div class="form-group">

                        <label>TAX Code: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <select class="form-control" name="tax_code" id="tax_code" maxlength="6">

                              <option value="">--Select--</option>

                                <?php foreach ($tax_lists as $key) { ?>

                                  <option value="<?php echo $key->TAX_CODE ?>" <?php if($PartyFinance_list->TAX_CODE == $key->TAX_CODE){echo 'selected';} ?>><?php echo $key->TAX_CODE?> = <?php echo $key->TAX_NAME?></option>

                                <?php } ?>

                          </select>

                        </div>
                        <small id="contactperErr" class="form-text text-muted"> </small>

                      </div><!-- /.form-group -->

                    </div><!-- COL-MD -->

                    <div class="col-md-2">

                      <div class="form-group">

                        <label>TDS Type: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></span>

                            <input list="tdsTypeList" id="tds_type" name="tds_type" class="form-control pull-left" placeholder="Enter TDS Type" maxlength="15" value="{{$PartyFinance_list->TDS_NO}}" autocomplete="off">

                            <datalist id="tdsTypeList">
                              <option value=""> ---- Select ----</option>
                              <option value="01" data-xyz="INDIVISUAL">INDIVISUAL</option>
                              <option value="03" data-xyz="HUF">HUF</option>
                              <option value="05" data-xyz="FIRM">FIRM</option>
                              <option value="07" data-xyz="AOP">AOP</option>
                              <option value="08" data-xyz="AOP (TRUST)">AOP (TRUST)</option>
                              <option value="11" data-xyz="CO-OPERATIVE">CO-OPERATIVE</option>
                              <option value="12" data-xyz="COMPANY PUBLIC INTEREST">COMPANY PUBLIC INTEREST</option>
                              <option value="13" data-xyz="COMPANY NON-PUBLIC INTEREST">COMPANY NON-PUBLIC INTEREST</option>
                              <option value="14" data-xyz="COMPANY PRIVATE">COMPANY PRIVATE</option>
                              <option value="16" data-xyz="LOCAL AUTHORITY">LOCAL AUTHORITY</option>
                            </datalist>

                          </div>

                          <small id="contactperErr" class="form-text text-muted"> </small>

                      </div><!-- /.form-group -->

                    </div>

                    <div class="col-md-2">

                      <div class="form-group">

                        <label>TDS Code: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <select class="form-control" name="tds_code" id="tds_code" maxlength="6">

                                <option value="">--Select--</option>

                                <?php foreach ($tds_lists as $key) { ?>

                                  <option value="<?php echo $key->TDS_CODE ?>" <?php if($PartyFinance_list->TDS_CODE == $key->TDS_CODE){echo 'selected';} ?>><?php echo $key->TDS_CODE?> = <?php echo $key->TDS_NAME?></option>

                                <?php } ?>

                          </select>

                        </div>

                        <small id="accnameErr" class="form-text text-muted"></small>

                      </div><!-- /.form-group -->

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>TAN No: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="text" id="tan_no" name="tan_no" class="form-control pull-left" placeholder="Enter Tan No" value="{{$PartyFinance_list->TAN_NO}}" maxlength="15">

                          </div>

                          <small id="contactperErr" class="form-text text-muted"> </small>

                      </div><!-- /.form-group -->

                    </div>

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>TIN No: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" id="tinno" name="tinno" class="form-control pull-left" placeholder="Enter Tin No" value="{{$PartyFinance_list->TIN_NO}}" maxlength="15">

                        </div>

                        <small id="accnameErr" class="form-text text-muted"></small>

                      </div><!-- /.form-group -->

                    </div><!-- COL -->

                  </div><!-- ROW -->

                  <div class="row">

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Sale Tax No: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="text" id="sales_taxno" name="sales_taxno" class="form-control pull-left" placeholder="Enter Sale Tax No" value="{{$PartyFinance_list->SALES_TAXNO}}" maxlength="15">

                          </div>

                          <small id="contactperErr" class="form-text text-muted"> </small>

                      </div><!-- /.form-group -->

                    </div><!-- COL -->

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>CSale Tax No: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" id="csales_taxno" name="csales_taxno" class="form-control pull-left" placeholder="Enter CSale Tax No" value="{{ $PartyFinance_list->CSALES_TEXNO }}" maxlength="15">

                        </div>

                        <small id="accnameErr" class="form-text text-muted"></small>

                      </div> <!-- /.form-group -->

                    </div><!-- COL -->

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Service Tax No: </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="text" id="service_taxno" name="service_taxno" class="form-control pull-left" placeholder="Enter Service Tax No" value="{{$PartyFinance_list->SERVICE_TAXNO}}" maxlength="15">

                          </div>

                          <small id="contactperErr" class="form-text text-muted"> </small>

                      </div><!-- /.form-group -->

                    </div><!-- COL -->

                    <div class="col-md-3">

                      <div class="form-group">

                        <label>Pan No: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" id="panno" name="panno" class="form-control pull-left" placeholder="Enter Pan No" value="{{$PartyFinance_list->PAN_NO}}" maxlength="10" >

                        </div>

                        <small id="accnameErr" class="form-text text-muted"></small>

                      </div><!-- /.form-group -->

                    </div>

                  </div><!-- ROW -->

                 <!--  <center>
                    <button class="btn btn-danger" type="button" id="backBtn2">Back</button>
                    <button class="btn btn-primary btn-md  nextBtn" type="button" id="secondstep">Next</button>
                  </center> -->

                </div><!-- COL -->

              </div><!-- COL -->
              </div>

            </div>

             <div class="box box-success Custom-Box">


              <div class="box-header with-border" style="text-align: center;">

                <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Bank Details</h2>
              </div><!-- /.box-header -->

              <div class="box-body">
                 <div class="col-xs-12">

                  <div class="col-md-12">

                    <div class="row">

                      <div class="col-md-4">

                        <div class="form-group">

                          <label>Bank Name: <span class="required-field iconshowhide" id="bankNameTx"></span></label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Enter Bank Name" value="{{$PartyFinance_list->BANK_NAME }}">

                          </div>

                          <small id="banknameErr" class="form-text text-muted"></small>

                        </div><!-- /.form-group -->

                      </div><!-- COL -->

                      <div class="col-md-4">

                        <div class="form-group">

                          <label>Account Number: <span class="required-field iconshowhide" id="accNameTx"></span>

                          </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="text" class="form-control" name="acc_number" id="acc_number" placeholder="Enter Account Number" value="{{$PartyFinance_list->ACC_NUMBER }}" maxlength="20">
                                
                          </div>

                          <small id="accnumberErr" class="form-text text-muted"></small>

                        </div><!-- /.form-group -->



                      </div><!-- COL -->

                      <div class="col-md-4">

                        <div class="form-group">

                          <label>Branch: <span class="required-field iconshowhide" id="branchTx"></span></label>

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                              <input type="text" id="branch_name" name="branch_name" class="form-control pull-left" placeholder="Enter Branch Name" value="{{$PartyFinance_list->BRANCH_NAME}}">

                            </div>

                            <small id="branchnameErr" class="form-text text-muted"> </small>

                        </div><!-- /.form-group -->

                      </div><!-- COL -->

                    </div><!-- ROW -->

                    <div class="row">

                      <div class="col-md-4">

                        <div class="form-group">

                          <label>IFSC Code: <span class="required-field iconshowhide" id="ifscTx"></span>

                          </label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <input type="text" id="ifsc_code" name="ifsc_code" class="form-control pull-left" placeholder="Enter IFSC Code" value="{{$PartyFinance_list->IFSC_CODE }}" maxlength="11">

                          </div>

                          <small id="ifsccodeErr" class="form-text text-muted"></small>

                        </div><!-- /.form-group -->

                      </div><!-- COL -->

                      <div class="col-md-8">

                        <div class="form-group">

                          <label>Address: <span class="required-field iconshowhide" id="addresTx"></span></label>

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>

                            <textarea class="form-control" col="50" rows="3" name="bank_address" placeholder="Enter Address" value="{{$PartyFinance_list->BANK_ADDRESS }}">{{$PartyFinance_list->BANK_ADDRESS }} </textarea>
                             <!--  <input type="text" id="branch_name" name="branch_name" class="form-control pull-left" placeholder="Enter Branch Name"> -->

                          </div>

                          <small id="bankaddressErr" class="form-text text-muted"> </small>

                        </div><!-- /.form-group -->

                      </div><!-- COL -->

                    </div><!-- ROW -->

                    

                   
                
                    <!-- <center> <button class="btn btn-danger" type="button" id="backBtn4">Back</button><button class="btn btn-primary btn-md" type="submit" id="submitdata" onclick="return validation()">Save</button></center> -->

                     <div>
                    <!--   <button class="btn btn-primary btn-md nextBtn" type="button" id="firstStep" style="width: 80px;margin-right: 0.5%;"><i class="fa fa-arrow-right"></i>Next</button> -->
                    <div class="col-md-5"></div>

                   <?php $updatedby = $PartyFinance_list->LAST_UPDATE_BY;
                     $update_by = $updatedby!= 'null' ? $updatedby : '-----';
                    ?>
                    <div class="col-md-4">  <button class="btn btn-primary" type="button" id="firstStep" style="width:80px;"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;Next </button></div>
                    <div class="col-md-3 text-right"><p>Last Updated By : {{$update_by}} </p></div>

                    

                     </div>

                  </div><!-- COL- MD -->

                </div><!-- COL-XS -->
              </div>
               
             </div>

          </div><!-- /.col-sm-12 -->

        </div>

        <!-- End First Step -->

        <div class="row setup-content" id="step-2">
          
          <div class="col-xs-12">

            <div class="col-md-12">

              <div class="row">

                <div class="col-sm-12">

                  <div class="box box-primary Custom-Box">

                    <div class="box-body">

                      <div class="table-responsive tdthtablebordr Custom-Box" style="overflow-x: unset;border-radius:7px;">

                        <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                          <tr>
                            <th><input class='check_all' type='checkbox' onclick="select_all()"/ title="Delete All Row"></th>
                            <th>Sr.No.</th>
                            <th style="text-align: center;">Contact Information</th>
                            <th style="text-align: center;">Others</th>
                          </tr>

                          <?php $totlRowExist = count($party_address); ?>

                          <?php if($party_address){ ?>
                                           
                           <?php $srno=1; foreach($party_address as $key) { 

                            if($srno==1){
                              $addReadonly ='disabled';
                            }else{
                              $addReadonly ='';
                            }

                          ?>

                          <tr class="useful">

                            <td class="tdthtablebordr">
                              <input type='checkbox' class='case' title="Delete Single Row" name='countcheckbox[]' id='countcheckbox1' <?php echo $addReadonly;?>/>
                            </td>

                            <?php if($srno==1){ ?>

                            <td class="tdthtablebordr">
                              <span id='snum'>{{ $srno }}.</span>
                              <input type="hidden" name="slno[]" id="slno{{$srno}}" value="{{ $key->CPCODE }}">
                            </td>

                            <?php }else{ ?>

                            <td class="tdthtablebordr">
                              <span id='snum{{$srno}}'>{{ $srno }}.</span>

                            <input type="hidden" name="slno[]" id="slno{{$srno}}" value="{{ $key->CPCODE }}">
                            </td>

                            <?php } ?>

                            <td class="tdthtablebordr" id="contactData" style="width: 45%;">

                              <small id="contactInfoReq"></small>

                              <div class="input-group" style="width: 100%;">

                                <div class="classAddrs">
                                  <span class="required-field"></span>
                                  <textarea  name="address[]" id="address{{$srno}}" cols="20" rows="2" placeholder="Address" style="width: 100%;;margin-bottom: 5px;">{{ $key->ADD1 }}</textarea>
                                </div>

                                <div class="row">

                                  <div class="col-md-6">

                                    <div class="classAddrs">
                                      <span class="required-field"></span> 
                                      <input type="text" class="inputboxclr  getAccNAme form-group " style="width: 120px;margin-bottom: 5px;"  id="contact_person{{$srno}}" name="contact_person[]" placeholder="Contact Person"  value="{{ $key->CONTACT_PERSON }}" autocomplete="off"/>
                                    </div>

                                    <div class="classAddrs">
                                      <span class="required-field"></span>
                                      <input type="text" class="textdesciptn discription forperticulr Number"  name="phone[]" id="phone{{$srno}}" placeholder="Phone No" value="{{ $key->CONTACT_NO }}" style="margin-bottom: 5px;width: 120px;" maxlength="10" autocomplete="off">
                                    </div>

                                    <div class="classAddrs">
                                      <span class="required-field"></span>
                                      <input type="text" class="textdesciptn discription forperticulr"  name="email[]" id="email{{$srno}}" value="{{ $key->EMAIL_ID }}" placeholder="Email" style="margin-bottom: 5px;width: 120px;" autocomplete="off">
                                    </div>

                                    <div class="classAddrs">
                                      <span class="required-field"></span>
                                      <input list="offDaysList{{$srno}}" class="textdesciptn discription forperticulr form-group"  name="offDays[]" id="offDays{{$srno}}" placeholder="Off Days" value="{{ $key->OFF_DAYS }}" style="margin-bottom: 5px;width: 120px;">
                                      <datalist id="offDaysList{{$srno}}">

                                          <option value="">--SELECT--</option>
                                          <option value="SUNDAY" data-xyz="SUNDAY">SUNDAY</option>
                                          <option value="MONDAY" data-xyz="MONDAY">MONDAY</option>
                                          <option value="TUESDAY" data-xyz="TUESDAY">TUESDAY</option>
                                          <option value="WEDNESDAY" data-xyz="WEDNESDAY">WEDNESDAY</option>
                                          <option value="THURSDAY" data-xyz="THURSDAY">THURSDAY</option>
                                          <option value="FRIDAY" data-xyz="FRIDAY">FRIDAY</option>
                                          <option value="SATURDAY" data-xyz="SATURDAY">SATURDAY</option>

                                      </datalist>
                                    </div>

                                  </div>

                                  <div class="col-md-6">

                                    <?php 

                                    $citycode = $key->CITY_CODE;
                                    $cityname = $key->CITY_NAME;
                                    $cityname_code = '';
                                    if($citycode != '' && $cityname!=''){

                                      $cityname_code = $citycode.'['.$cityname.']';

                                    }else{
                                      $cityname_code = '';
                                    }
                                    ?>
                                    <?php  ?>

                                    <div class="classAddrs">
                                      <span class="required-field"></span>
                                      <input list="cityList{{$srno}}" class="textdesciptn discription forperticulr form-group"  name="city[]" id="city{{$srno}}" placeholder="City" value="<?php echo $cityname_code;?>" onchange="getFullAdrs(<?php echo $srno; ?>)" style="margin-bottom: 5px;width: 120px;" autocomplete="off">
                                      <datalist id="cityList{{$srno}}">

                                          @foreach($city_lists as $keys) 

                                            <option value="{{$keys->CITY_CODE}}" data-xyz="{{ $keys->CITY_NAME  }}">{{$keys->CITY_CODE }} = {{$keys->CITY_NAME}}</option>

                                          @endforeach

                                      </datalist>
                                    </div>

                                    <?php 

                                    $distcode = $key->DIST_CODE;
                                    $distname = $key->DIST_NAME;
                                    $distname_code = '';
                                    if($distcode != '' && $distname!=''){

                                      $distname_code = $distcode.'['.$distname.']';

                                    }else{
                                      $distname_code = '';
                                    }
                                    ?>

                                    <div class="classAddrs">
                                      <span class="required-field"></span>
                                      <input type="text" class="textdesciptn discription forperticulr"  name="district[]" id="district{{$srno}}" placeholder="District" value="<?php echo $distname_code;?>" style="margin-bottom: 5px;width: 120px;" readonly>
                                    </div>

                                    <?php 

                                    $statecode = $key->STATE_CODE;
                                    $statename = $key->STATE_NAME;
                                    $statename_code = '';
                                    if($statecode != '' && $statename!=''){

                                      $statename_code = $statecode.'['.$statename.']';

                                    }else{
                                      $statename_code = '';
                                    }
                                    ?>

                                    <div class="classAddrs">
                                      <span class="required-field"></span>
                                      <input type="text" class="textdesciptn discription forperticulr"  name="state[]" id="state{{$srno}}" placeholder="Enter State" value="<?php echo $statename_code; ?>" style="margin-bottom: 5px;width: 120px;" readonly>
                                    </div>

                                    <div class="classAddrs">
                                      <span class="required-field"></span>
                                      <input type="text" class="textdesciptn discription forperticulr form-group Number"  name="pincode[]" id="pincode{{$srno}}" placeholder="Pincode" maxlength="8"  value="{{$key->PIN_CODE}}" style="margin-bottom: 5px;width: 120px;" >
                                    </div>
                                    
                                  </div>
                                  
                                </div>

                              </div>

                            </td>

                            <td class="tdthtablebordr">

                              <div class="row">

                                <div class="col-md-4">

                                  <select type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 1px;height: 26px;" id='gst_type{{$srno}}' name="gst_type[]" >
                                    <option value="">--select--</option>
                                    <option value="Register" <?php if($key->GST_TYPE=='Register'){echo 'selected';} ?>>Register</option>
                                    <option value="UnRegister" <?php if($key->GST_TYPE=='UnRegister'){echo 'selected';} ?>>UnRegister</option>
                                    <option value="Not-Applicable" <?php if($key->GST_TYPE=='Not-Applicable'){echo 'selected';} ?>>Not-Applicable</option>
                                  </select>

                                </div>
                              

                                <div class="col-md-4">
                                  <input type="text" class="textdesciptn discription forperticulr"  name="gst_num[]" id="gst_num{{$srno}}" value="{{$key->GST_NUM}}" style="width: 120px;margin-bottom: 5px;" placeholder="GST No">
                                </div>

                                  <div class="col-md-4">

                                  <input type="text" class="inputboxclr getAccNAme" style="width: 97px;margin-bottom: 5px;" id='ecc_no{{$srno}}' name="ecc_no[]" value="{{$key->ECC_NO}}" placeholder="ECC NO" />

                                </div>

                              </div>

                              <div class="row">

                                <div class="col-md-12">

                                <textarea type="text" class="textdesciptn discription forperticulr"  name="range_address[]" value="{{$key->RANGE_ADD}}" id="range_address{{$srno}}" style="width: 100%;margin-bottom: 5px;" placeholder="Range Address">{{$key->RANGE_ADD}}</textarea>
                              </div>

                              </div>
                              <div class="row">
                                
                                <div class="col-md-6">

                                  <input type="text" class="textdesciptn discription forperticulr" value="{{$key->RANGE_NO}}" name="range_no[]" id="range_no{{$srno}}" style="width: 120px;margin-bottom: 5px;" placeholder="Range No">

                                </div>
                                <div class="col-md-6">
                                <input type="text" class="textdesciptn discription forperticulr"  name="division[]" id="division{{$srno}}" value="{{$key->DIVISION}}" style="width: 120px;margin-bottom: 5px;" placeholder="Division">

                              </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                               
                                  <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;" id='range_name{{$srno}}' name="range_name[]" value="{{$key->RANGE_NAME}}" placeholder="Range Name" />
                             
                                </div>

                                <div class="col-md-6">

                                 <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;" id='collector{{$srno}}' name="collector[]" value="{{$key->COLLECTOR}}" style="width: 120px;margin-bottom: 5px;" placeholder="Collector" />

                               </div>
                              </div>

                            </td>
                          </tr>
                          <?php $srno++; } }else{ ?>

                           <tr class="useful">

                              <td class="tdthtablebordr"><input type='checkbox' class='case' title="Delete Single Row" name='countcheckbox[]' id='countcheckbox1' disabled/></td>

                              <td class="tdthtablebordr">

                                <span id='snum'>1.</span>

                                <input type="hidden" name="slno[]" id="slno1" value="1">

                              </td> 

                              <td class="tdthtablebordr" style="width: 45%;">

                                <small id="contactInfoReq"></small>

                                <div class="input-group" style="width: 100%;">

                                    <div class="classAddrs">
                                    
                                      <span class="required-field"></span>
                                      <textarea  name="address[]" id="address1" cols="20" rows="2" placeholder="Address" style="width: 100%;;margin-bottom: 5px;" value="{{ old('address') }}"></textarea></div>

                                    <div class="row">
                                      <div class="col-md-6">

                                        <div class="classAddrs"><span class="required-field"></span> <input type="text" class="inputboxclr  getAccNAme form-group " style="width: 120px;margin-bottom: 5px;"  id="contact_person1" name="contact_person[]" placeholder="Contact Person"  value="{{ old('contact_person') }}" autocomplete="off"/></div>

                                        <div class="classAddrs"><span class="required-field"></span>
                                         <input type="text" class="textdesciptn discription forperticulr Number"  name="phone[]" id="phone1" placeholder="Phone No" value="{{ old('phone') }}" style="margin-bottom: 5px;width: 120px;" maxlength="10" autocomplete="off">
                                        </div>

                                        <div class="classAddrs"><span class="required-field"></span>
                                          <input type="text" class="textdesciptn discription forperticulr"  name="email[]" id="email1" value="{{ old('email') }}" placeholder="Email" style="margin-bottom: 5px;width: 120px;" autocomplete="off">
                                        </div>

                                        <div class="classAddrs"><span class="required-field"></span>
                                          <input list="offDaysList1" class="textdesciptn discription forperticulr form-group"  name="offDays[]" id="offDays1" placeholder="Off Days" value="{{ old('offDays') }}" onchange="getFullAdrs(1)" style="margin-bottom: 5px;width: 120px;" autocomplete="off">
                                          <datalist id="offDaysList1">

                                              <option value="">--SELECT--</option>
                                              <option value="SUNDAY" data-xyz="SUNDAY">SUNDAY</option>
                                              <option value="MONDAY" data-xyz="MONDAY">MONDAY</option>
                                              <option value="TUESDAY" data-xyz="TUESDAY">TUESDAY</option>
                                              <option value="WEDNESDAY" data-xyz="WEDNESDAY">WEDNESDAY</option>
                                              <option value="THURSDAY" data-xyz="THURSDAY">THURSDAY</option>
                                              <option value="FRIDAY" data-xyz="FRIDAY">FRIDAY</option>
                                              <option value="SATURDAY" data-xyz="SATURDAY">SATURDAY</option>

                                          </datalist>
                                        </div>
                                    
                                      </div>

                                      <div class="col-md-6">
                                      
                                        <div class="classAddrs"><span class="required-field"></span>
                                          <input list="cityList1" class="textdesciptn discription forperticulr form-group"  name="city[]" id="city1" placeholder="City" value="{{ old('city') }}" onchange="getFullAdrs(1)" style="margin-bottom: 5px;width: 120px;" autocomplete="off">
                                          <datalist id="cityList1">

                                              @foreach($city_lists as $key) 

                                                <option value="{{$key->CITY_CODE}}" data-xyz="{{ $key->CITY_NAME  }}">{{$key->CITY_CODE }} = {{$key->CITY_NAME}}</option>

                                              @endforeach

                                          </datalist>
                                        </div>

                                        <div class="classAddrs"><span class="required-field"></span>
                                        <input type="text" class="textdesciptn discription forperticulr"  name="district[]" id="district1" placeholder="District" value="{{ old('district') }}" style="margin-bottom: 5px;width: 120px;" readonly></div>

                                        <div class="classAddrs"><span class="required-field"></span>
                                          <input list="stateList" class="textdesciptn discription forperticulr"  name="state[]" id="state1" placeholder="State" value="{{ old('state') }}" style="margin-bottom: 5px;width: 120px;" readonly>

                                        </div>

                                        <div class="classAddrs"><span class="required-field"></span><input type="text" class="textdesciptn discription forperticulr form-group Number"  name="pincode[]" id="pincode1" placeholder="Pincode" maxlength="8" value="{{ old('pincode') }}"  style="margin-bottom: 5px;width: 120px;"></div>

                                      </div>
                                    </div>
                                
                                </div>
                                
                              </td>

                              <td class="tdthtablebordr">

                                <div class="row">

                                  <div class="col-md-4">

                                    <select type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 1px;height: 26px;" id="gst_type1" onclick="GstType(1)" name="gst_type[]" value="">
                                      <option value="">--GST TYPE--</option>
                                      <option value="Register">Register</option>
                                      <option value="UnRegister">UnRegister</option>
                                      <option value="Not-Applicable">Not-Applicable</option>
                                    </select>

                                  </div>

                                  <div class="col-md-4">
                                    <div id="GstNo"></div>
                                    <input type="text" class="textdesciptn discription forperticulr" name="gst_num[]" id="gst_num1" style="width: 120px; margin-bottom: 5px; z-index: 0;" placeholder="GST No" value="" oninput="gstNum(1)">  
                                  </div>
                                  <div class="col-md-4">
                                    <input type="text" class="inputboxclr getAccNAme" style="width: 110px;margin-bottom: 5px;" id='ecc_no1' name="ecc_no[]"  placeholder="ECC NO"  value="{{ old('ecc_no') }}"/>
                                  </div>

                                </div>

                                <textarea type="text" class="textdesciptn discription forperticulr"  name="range_address[]" id="range_address1" style="width: 356px;margin-bottom: 5px;" placeholder="Range Address" value="{{ old('range_address') }}"></textarea>

                                <div class="row">
                                 
                                  <div class="col-md-6">

                                    <input type="text" class="textdesciptn discription forperticulr"  name="range_no[]" id="range_no1" style="width: 120px;margin-bottom: 5px;" placeholder="Range No" value="{{ old('range_no') }}">

                                  </div>
                                  <div class="col-md-6">
                                    <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;" id='range_name1' name="range_name[]" placeholder="Range Name"  value="{{ old('range_name') }}"/>

                                  </div>
                                </div>

                                <div class="row">

                                  <div class="col-md-6">
                                    
                                    <input type="text" class="textdesciptn discription forperticulr"  name="division[]" id="division1" style="width: 120px;margin-bottom: 5px;" placeholder="Division" value="{{ old('division') }}">

                                  </div>
                                  <div class="col-md-6">
                                    <input type="text" class="inputboxclr getAccNAme" style="width: 120px;margin-bottom: 5px;" id='collector1' name="collector[]" style="width: 120px;margin-bottom: 5px;" placeholder="Collector"  value="{{ old('collector') }}"/>

                                  </div>
                                </div>

                              </td>

                            </tr>
                          <?php }?>
                        </table><!-- table -->

                        <div class="row">

                          <div class="col-md-5">
                             <input type="hidden" value="{{$totlRowExist}}" id="preTotlRow">
                             <button type="button" class='btn btn-danger btn-sm delete' id="deletehidn" ><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                              <button type="button" class='btn btn-info btn-sm addmore' id="addmorhidn" ><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;"></i>&nbsp; Add More</button>
                          </div>

                          <div class="col-md-5">

                            <div class="form-group">

                              <label>Account Block: <span class="required-field"></span></label>

                              <div class="input-group">

                                  <input type="radio" class="optionsRadios1 nextOnEnterBtn" name="account_block" value="YES" <?php if($PartyFinance_list->ACC_BLOCK=='YES'){ echo 'checked';} else{ echo '';} ?> >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;YES &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                  <input type="radio" class="optionsRadios1 nextOnEnterBtn" name="account_block" value="NO" <?php if($PartyFinance_list->ACC_BLOCK=='NO'){ echo 'checked';} else{ echo '';} ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NO

                              </div>
                              
                            </div>

                          </div>
                          
                        </div><!-- /.row -->
                      
                        <p class="text-center"></p>
                        
                      </div><!-- /.table-responsive -->

                       <center>
             <!--  <button class="btn btn-danger" type="button" id="backBtn2">Back</button> <button class="btn btn-primary btn-md nextBtn" type="button" id="thirdStep">Next</button> -->


              <button class="btn btn-danger" type="button" id="backBtn2" style="width: 80px;margin-right: 0.5%;"> <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back</button><button class="btn btn-primary btn-md" type="button" id="submitdata" onclick="validation()" style="width: 80px;"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Confirm</button>
              <button class="btn btn-primary btn-md" type="submit" id="submit_data" style="width: 80px;" disabled><i class="fa fa-floppy-o" ></i>&nbsp;&nbsp;Update</button>

               </center> 
                      
                    </div><!-- /.box-body -->

                    <div>

                     

                      

                    </div><!-- /.box-body -->

                  </div><!-- custom box -->

                </div><!-- col -->

              </div><!-- /.col -->

            
                     
            </div><!-- /.col -->

          </div><!-- /.col -->

        </div>

        </div>

      </form>

      </div><!-- /.row -->

    </section><!-- /.content -->

  </div><!-- /.content wraper -->

@include('admin.include.footer')

<script>

  $( window ).on( "load", function() {
    var accType = $('#acctype_code').val();

    if(accType != undefined){
      var splitAccType = accType.split('[');
      var accTypeCode  = splitAccType[0];
      accTypeFun(accTypeCode);
    }
    
  });

  $("#acctype_code").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#accList option').filter(function() {

      return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match'; 

      if(msg=='No Match'){
        $(this).val('');
        $('#acctypeText').val('');
        $('#isBankReq').val('');
        $('#accTypeErr').html('The account type field is required.').css('color','red');
        $("#aliasCodeReq").addClass('getAccType');
      }else{
        $('#acctype_code').val(val+'['+msg+']');
        $('#accTypeErr').html('');



          if (msg == 'SALES REPRESENTATIV') {
          console.log('srss',msg);
            $("#aliasCodeReq").removeClass('getAccType');

          }else{

            $("#aliasCodeReq").addClass('getAccType');

          }
      }


    });

  function accTypeFun(accType) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    var splitAccType = accType.split('[');
    var accTypeCode  = splitAccType[0];

    $.ajax({

          url:"{{ url('check-n-get-data-against-accType') }}",

           method : "POST",

           type: "JSON",

           data: {accTypeCode: accTypeCode},

           success:function(data){

              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

              }else if(data1.response == 'success'){

                console.log('data1',data1.data);

                if(data1.data == ''){

                }else{
                  $('#isBankReq').val(data1.data[0].BANK_REQ);
                  var bankReqYes = $('#isBankReq').val();
                  if(bankReqYes == 'YES'){
                    $('#bankNameTx,#accNameTx,#branchTx,#ifscTx,#addresTx').removeClass('iconshowhide');
                  }else{
                    $('#bankNameTx,#accNameTx,#branchTx,#ifscTx,#addresTx').addClass('iconshowhide');
                  }
                }
                    
              }
           }

    });

  }

  function getFullAdrs(num){

    var val = $("#city"+num).val();
    var xyz = $('#cityList'+num+' option').filter(function() {

      return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg == 'No Match'){
      $("#city"+num).val('');
    }else{
      var city = $("#city"+num).val();

      $("#city"+num).val(val+'['+msg+']');

      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({

            url:"{{ url('get-full-address-against-city') }}",
            method : "POST",
            type: "JSON",
            data: {city: city},
            success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                    $('#district'+num).val('');
                    $('#state'+num).val('');
                    $('#pincode'+num).val('');

                }else if(data1.response == 'success'){

                    var details = data1.data;
                    // console.log('details',details);
                    $('#district'+num).val(details[0]['DISTRICT_CODE']+'['+details[0]['DISTRICT_NAME']+']');
                    $('#state'+num).val(details[0]['STATE_CODE']+'['+details[0]['STATE_NAME']+']');
                    $('#pincode'+num).val(details[0]['PIN_CODE']);
                }
            }

      });

    }

  }
   $(document).ready(function(){
    $('#address1').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });

      $("#backBtn2").click(function(event) {

        $('a[href="#step-1"]').click();
            
      });

      $("#backBtn3").click(function(event) {

          $('a[href="#step-2"]').click();
              
      });

      $("#backBtn4").click(function(event) {

          $('a[href="#step-4"]').click();
              
      });



      // $('#address1').on('change',function(){
      //   var add = $('#address1').val();
      //   console.log('Address', add);

      // if(add != ''){
      //     $('#thirdStep').prop('disabled',false);
      //     }else{
      //     $('#thirdStep').prop('disabled',true);
      // }
//       $("#contactData").change(function () {
//    var add = $("#address1 :selected").val();
//    var contact = $("#contact_person1 :selected").val();

//    if (add == '' && contact == '') {
//      $("#thirdStep").attr('disabled','disabled'); 
//    }
//    else {
//      $("#thirdStep").removeAttr('disabled'); 
//    }
// });

  });
  $(document).ready(function(){
      $('#gst_type').on('change',function(){
      var gst_type = $('#gst_type').val();

      if(gst_type == 'Register'){
          $('#GstNumReq').html('GST No field is required').css('color','red');
          $('#submitdata').prop('disabled',true);
          $('#gst_num').val('');
      }else{
          $('#GstNumReq').html('');
           $('#submitdata').prop('disabled',false);
      }

  });

  $('#gst_num').on('input',function(){
       var gst_num = $('#gst_num').val();
       var gst_type = $('#gst_type').val();
       if(gst_num){
        $('#submitdata').prop('disabled',false);
        $('#GstNumReq').html('');
       }else if(gst_type == 'Register'){
          $('#submitdata').prop('disabled',true);
           $('#GstNumReq').html('GST No field is required').css('color','red');
       }else{
         $('#gst_num').val('');
         $('#GstNumReq').html('');
           $('#submitdata').prop('disabled',false);
       }
  });

  $("#comp_code").bind('change', function () { 
          
          var val = $(this).val();

          var xyz = $('#compList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg =='No Match'){
            $('#comp_code').val('');
            $('#comp_name').val('');
             
          }else{
            $('#comp_name').val(msg);
          }

  });

  $("#gl_code").bind('change', function () {  

    var val = $(this).val();

    var xyz = $('#GLList option').filter(function() {

    return this.value == val;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
       $(this).val('');

    }else{
      $('#gl_code').val(val+'['+msg+']');
      $('#glcodeErr').html('');
    }

});

  });
</script>


<script type="text/javascript">

  $('document').ready(function(){

      $('#firstStep').click(function(){
          // console.log('firststep');
          var acc_code = $("#acc_code").val();

          var acc_name = $("#acc_name").val();

          var gl_code   = $("#gl_code").val();

          var AliasCode  = $("#AliasCodeId").val();
          var acc_type  = $("#acctype_code").val();

          /*if (acc_type=='SALES REPRESENTATIV' || acc_type=='SR' || acc_type=='SR[SALES REPRESENTATIV]') {

            $('#aliasCod').html('*The alias code field is required.').css('color','red');

          }else{

            $('#aliasCod').html('');
            

          }*/

          if(acc_code.trim() == '' && acc_name.trim() == '' && (gl_code == '[]' || gl_code.trim() == '') ){



           $('#glcodeErr').html('The gl code field is required.').css('color','red');
           $('#acccodeErr').html('The account code field is required.').css('color','red');

           $('#accnameErr').html('The account code field is required.').css('color','red');

          /* $('#step-1').css('display','block');

           $('#step-2').css('display','none');

           $('#step-3').css('display','none');*/

           return false;

          }else if(acc_code.trim() == ''){

             $('#acccodeErr').html('The account code field is required.').css('color','red');

             return false;

          }else if(acc_name.trim() == ''){

            $('#acccodeErr').html('');

            $('#accnameErr').html('The account code field is required.').css('color','red');

            return false;



          }else if((gl_code == '[]' || gl_code.trim() == '')){

            $('#glcodeErr').html('');

            $('#glcodeErr').html('The gl code field is required.').css('color','red');

            return false;



          }else if(acc_type=='SALES REPRESENTATIV' || acc_type=='SR' || acc_type=='SR[SALES REPRESENTATIVE]' && aliasCd==''){
              $('#aliasCod').html('*The alias code field is required.').css('color','red');
                return false;
          }else{

            $('#acccodeErr').html('');

            $('#accnameErr').html('');

            $('#stepone').removeClass('btn-primary');

            $('#steptwo').addClass('btn-primary');

            $('#step-1').css('display','none');

            $('#step-2').css('display','block');

            $('#show_second').removeClass('hidebegore');

           

            return true;

          }

      });



      
// $('#secondstep').click(function(){
//                console.log('secondstep');
//                $('#step-1').css('display','none');

//                $('#step-2').css('display','none');

//                $('#step-3').css('display','none');

//                $('#step-4').css('display','block');

//                $('#steptwo').removeClass('btn-primary');

//                $('#stepfour').addClass('btn-primary');

//                 $('#show_four').removeClass('hideFouth');
               

            

//       });


      // $('#thirdStep').click(function(){
      //     console.log('thirdStep');
      //      var addr     = $('#address1').val();
      //      var contact  = $('#contact_person1').val();
      //      var phoneNo  = $('#phone1').val();
      //      var email    = $('#email1').val();
      //      var offDays  = $('#offDays1').val();
      //      var city     = $('#city1').val();
      //      var district = $('#district1').val();
      //      var state    = $('#state1').val();
      //      var pincode  = $('#pincode1').val();

      //     if(addr.trim() == '' && contact.trim() == '' && phoneNo.trim() == '' && city.trim() == '' && pincode.trim() == '' && district.trim() == '' && state == '' && email.trim() == '' && offDays.trim() == ''){
            
      //       $('#contactInfoReq').html('Contact Information Required.').css('color','red');
      //       return false;

      //     }else if(addr.trim() == ''){

      //        $('#contactInfoReq').html('Address Required.').css('color','red');

      //        return false;

      //     }else if(contact.trim() == ''){

      //       $('#contactInfoReq').html('');

      //       $('#contactInfoReq').html('Contact Required.').css('color','red');

      //       return false;

      //     }else if(phoneNo.trim() == ''){

      //       $('#contactInfoReq').html('');

      //       $('#contactInfoReq').html('Contact Person Required.').css('color','red');

      //       return false;

      //     }else if(city.trim() == ''){

      //       $('#contactInfoReq').html('');

      //       $('#contactInfoReq').html('City Required.').css('color','red');

      //       return false;

      //     }
      //     else if(pincode.trim() == ''){

      //       $('#contactInfoReq').html('');

      //       $('#contactInfoReq').html('Pincode Required.').css('color','red');

      //       return false;

      //     }
      //     else if(district.trim() == ''){

      //       $('#contactInfoReq').html('');

      //       $('#contactInfoReq').html('District Required.').css('color','red');

      //       return false;

      //     }
      //     else if(state== ''){

      //       $('#contactInfoReq').html('');

      //       $('#contactInfoReq').html('State Required.').css('color','red');

      //       return false;

      //     }
      //     else if(email.trim() == ''){

      //       $('#contactInfoReq').html('');

      //       $('#contactInfoReq').html('Email Required.').css('color','red');

      //       return false;

      //     }
      //     else if(offDays.trim() == ''){

      //       $('#contactInfoReq').html('');

      //       $('#contactInfoReq').html('Off Days Required.').css('color','red');

      //       return false;

      //     }
      //     else{

      //        $('#contactInfoReq').html('');
      //         $('#step-1').css('display','none');

      //          $('#step-2').css('display','none');

      //          $('#step-3').css('display','block');

      //          $('#step-4').css('display','none');

      //          $('#stepfour').removeClass('btn-primary');

      //          $('#stepthree').addClass('btn-primary');

      //         $('#show_third').removeClass('hideThired');


           

      //       return true;

      //     }

      // });
    
 });

$(document).ready(function () {



    var navListItems = $('div.setup-panel div a'),

            allWells = $('.setup-content'),

            allNextBtn = $('.nextBtn');



    allWells.hide();



    navListItems.click(function (e) {

        e.preventDefault();

        var $target = $($(this).attr('href')),

                $item = $(this);



        if (!$item.hasClass('disabled')) {

            navListItems.removeClass('btn-primary').addClass('btn-default');

            $item.addClass('btn-primary');

            allWells.hide();

            $target.show();

            $target.find('input:eq(0)').focus();

        }

    });



    allNextBtn.click(function(){

        var curStep = $(this).closest(".setup-content"),

            curStepBtn = curStep.attr("id"),

            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),

            curInputs = curStep.find("input[type='text'],input[type='url']"),

            isValid = true;



        $(".form-group").removeClass("has-error");

        for(var i=0; i<curInputs.length; i++){

            if (!curInputs[i].validity.valid){

                isValid = false;

                $(curInputs[i]).closest(".form-group").addClass("has-error");

            }

        }



       /* if (isValid)

            nextStepWizard.removeAttr('disabled').trigger('click');*/

    });



    $('div.setup-panel div a.btn-primary').trigger('click');

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

    var srno = $('#slno1').val();
    $('#submit_data').prop('disabled',true);

    // var trlength = $('#tbledata').length;
    // console.log('trlength',trlength);



    // $('#thirdStep').prop('disabled',false);
    // document.getElementById("thirdStep").disabled = true;

  
      var getpaymode = 'To -';

    count=$('table tr').length;

    /* ---- check field is blank --- */
    var rowNo = parseInt(i) - parseInt(1);
    var addr = $('#address'+rowNo).val();
    var cont_per = $('#contact_person'+rowNo).val();
    var phone = $('#phone'+rowNo).val();
    var c_email = $('#email'+rowNo).val();
    var c_offdays = $('#offDays'+rowNo).val();
    var c_city = $('#city'+rowNo).val();
    var c_district = $('#district'+rowNo).val();
    var c_state = $('#state'+rowNo).val();
    var c_pincode = $('#pincode'+rowNo).val();

    if(addr == ''){

      $('#contactInfoReq').html('All Fields is Required').css('color','red');
      return false;

    }else{

      $('#contactInfoReq').html('');

    }
     if(cont_per == ''){

      $('#contactInfoReq').html('All Fields is Required').css('color','red');
      return false;

    }else{

      $('#contactInfoReq').html('');

    }

    if(phone == ''){

      $('#contactInfoReq').html('All Fields is Required').css('color','red');
      return false;

    }else{

      $('#contactInfoReq').html('');

    }

    if(c_email == ''){

      $('#contactInfoReq').html('All Fields is Required').css('color','red');
      return false;

    }else{

      $('#contactInfoReq').html('');

    }

    if(c_offdays == ''){

      $('#contactInfoReq').html('All Fields is Required').css('color','red');
      return false;

    }else{

      $('#contactInfoReq').html('');

    }

    if(c_city == ''){

      $('#contactInfoReq').html('All Fields is Required').css('color','red');
      return false;

    }else{

      $('#contactInfoReq').html('');

    }
    if(c_district == ''){

      $('#contactInfoReq').html('All Fields is Required').css('color','red');
      return false;

    }else{

      $('#contactInfoReq').html('');

    }

    if(c_pincode == ''){

      $('#contactInfoReq').html('All Fields is Required').css('color','red');
      return false;

    }else{

      $('#contactInfoReq').html('');

    }
     if(c_state == ''){

      $('#contactInfoReq').html('All Fields is Required').css('color','red');
      return false;

    }else{

      $('#contactInfoReq').html('');

    }
    // console.log('count',count);

    var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case' name='countcheckbox[]' id='countcheckbox"+count+"'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='slno[]' id='slno"+i+"' value='"+count+"'></td>";

    data +="<td class='tdthtablebordr' style='width: 45%;'><small id='contactInfoReq'></small><div class='input-group' style='width: 100%;'> <div class='classAddrs'><span class='required-field'></span><textarea  name='address[]' id='address"+i+"' cols='20' rows='2' placeholder='Address' style='width: 100%;margin-bottom: 5px;' value='{{ old('address') }}'></textarea></div><div class='row'><div class='col-md-6'><div class='classAddrs'><span class='required-field'></span> <input type='text' class='inputboxclr  getAccNAme form-group ' style='width: 120px;margin-bottom: 5px;'  id='contact_person"+i+"' name='contact_person[]' placeholder='Contact Person'  value='{{ old('contact_person') }}' autocomplete='off'/></div><div class='classAddrs'><span class='required-field'></span><input type='text' class='textdesciptn discription forperticulr Number'  name='phone[]' id='phone"+i+"' placeholder='Phone No' value='{{ old('phone') }}' style='margin-bottom: 5px;width: 120px;' maxlength='10' autocomplete='off'></div><div class='classAddrs'><span class='required-field'></span><input type='text' class='textdesciptn discription forperticulr'  name='email[]' id='email"+i+"' value='{{ old('email') }}' placeholder='Email' style='margin-bottom: 5px;width: 120px;' autocomplete='off'></div><div class='classAddrs'><span class='required-field'></span><input list='offDaysList"+i+"' class='textdesciptn discription forperticulr form-group'  name='offDays[]' id='offDays"+i+"' placeholder='Off Days' value='{{ old('offDays') }}' onchange='getFullAdrs("+i+")' style='margin-bottom: 5px;width: 120px;'><datalist id='offDaysList"+i+"'><option value=''>--SELECT--</option><option value='SUNDAY' data-xyz='SUNDAY'>SUNDAY</option><option value='MONDAY' data-xyz='MONDAY'>MONDAY</option><option value='TUESDAY' data-xyz='TUESDAY'>TUESDAY</option><option value='WEDNESDAY' data-xyz='WEDNESDAY'>WEDNESDAY</option><option value='THURSDAY' data-xyz='THURSDAY'>THURSDAY</option><option value='FRIDAY' data-xyz='FRIDAY'>FRIDAY</option><option value='SATURDAY' data-xyz='SATURDAY'>SATURDAY</option></datalist></div></div><div class='col-md-6'><div class='classAddrs'><span class='required-field'></span><input list='cityList"+i+"' class='textdesciptn discription forperticulr form-group'  name='city[]' id='city"+i+"' placeholder='City' value='{{ old('city') }}' onchange='getFullAdrs("+i+")' style='margin-bottom: 5px;width: 120px;' autocomplete='off'><datalist id='cityList"+i+"'>@foreach($city_lists as $key)<option value='{{$key->CITY_CODE}}' data-xyz='{{ $key->CITY_NAME  }}'>{{$key->CITY_CODE }} = {{$key->CITY_NAME}}</option>@endforeach</datalist></div><div class='classAddrs'><span class='required-field'></span> <input type='text' class='textdesciptn discription forperticulr'  name='district[]' id='district"+i+"' placeholder='District' value='{{ old('district') }}' style='margin-bottom: 5px;width: 120px;' readonly></div><div class='classAddrs'><span class='required-field'></span><input list='stateList' class='textdesciptn discription forperticulr'  name='state[]' id='state"+i+"' placeholder='State' value='{{ old('state') }}' style='margin-bottom: 5px;width: 120px;' readonly></div><div class='classAddrs'><span class='required-field'></span><input type='text' class='textdesciptn discription forperticulr form-group Number' readonly name='pincode[]' id='pincode"+i+"' placeholder='Pincode' maxlength='8' value='{{ old('pincode') }}' style='margin-bottom: 5px;width: 120px;'></div></div></div></div></td><td class='tdthtablebordr'><div class='row'><div class='col-md-4'><select type='text' class='inputboxclr getAccNAme' style='width: 120px;margin-bottom: 5px;height:25px;' id='gst_type"+i+"' name='gst_type[]' onclick='GstType("+i+")' ><option value=''>--GST TYPE--</option><option value='Register'>Register</option><option value='UnRegister'>UnRegister</option><option value='Not-Applicable'>Not-Applicable</option></select></div><div class='col-md-4'><input type='text' class='textdesciptn discription forperticulr'  name='gst_num[]' id='gst_num"+i+"' style='width: 120px;margin-bottom: 5px;' placeholder='GST No' oninput='gstNum("+i+")'></div><div class=col-md-4><input type='text' class='inputboxclr getAccNAme' style='width: 110px;margin-bottom: 5px;' id='ecc_no"+i+"' name='ecc_no[]' style='width: 120px;margin-bottom: 5px;' placeholder='ECC NO'></div></div><div class='row'><div class='col-md-12'><textarea type=text class='textdesciptn discription forperticulr'  name='range_address[]' id='range_address"+i+"' style='width: 356px;margin-bottom: 5px;' placeholder='Range Address'></textarea></div></div><div class=row><div class='col-md-6'><input type='text' class='textdesciptn discription forperticulr'  name='range_no[]' id='range_no"+i+"' style='width: 120px;margin-bottom: 5px;' placeholder='Range No'></div><div class='col-md-6'><input type='text' class='inputboxclr getAccNAme' style='width: 120px;margin-bottom: 5px;' id='range_name"+i+"' name='range_name[]' placeholder='Range Name' /></div></div><div class=row><div class='col-md-6'><input type='text' class='textdesciptn discription forperticulr'  name='division[]' id='division"+i+"' style='width: 120px;margin-bottom: 5px;' placeholder='Division'></div><div class='col-md-6'><input type='text' class='inputboxclr getAccNAme' style='width: 120px;margin-bottom: 5px;' id='collector"+i+"' name='collector[]' style='width: 120px;margin-bottom: 5px;' placeholder='Collector' /></div></div></td></tr>";

    $('table').append(data);

    i++;



});

function check(){

    obj = $('table tr').find('span');

    if(obj.length==0){
      $('#thirdStep').prop('disabled',true);
    }else{
      $('#thirdStep').prop('disabled',false);
        $.each( obj, function( key, value ) {

          var idname=value.id;

          $('#'+idname).html(key+1);

        });

    }    

}

</script>


<script type="text/javascript">

  function validation(){

    var trcount=$('table tr').length;
    var valueaddress=[];
    var valuecon_person=[];
    var valuecon_phone=[];
    var valuecon_email=[];
    var valuecon_offDays=[];
    var valuecon_city=[];
    var valuecon_district=[];
    var valuecon_state=[];
    var valuecon_pincode=[];

    for(var y=1;y<trcount;y++){
      
      var address    = $('#address'+y).val();
      var con_person = $('#contact_person'+y).val();
      var con_phone = $('#phone'+y).val();
      var con_email = $('#email'+y).val();
      var con_offDays = $('#offDays'+y).val();
      var con_city = $('#city'+y).val();
      var con_district = $('#district'+y).val();
      var con_state = $('#state'+y).val();
      var con_pincode = $('#pincode'+y).val();

      valueaddress.push(address);
      valuecon_person.push(con_person);
      valuecon_phone.push(con_phone);
      valuecon_email.push(con_email);
      valuecon_offDays.push(con_offDays);
      valuecon_city.push(con_city);
      valuecon_district.push(con_district);
      valuecon_state.push(con_state);
      valuecon_pincode.push(con_pincode);
    }

    var found_addr = valueaddress.find(function (addr) {
      return addr == '';
    });
    var found_contact = valuecon_person.find(function (conPer) {
      return conPer == '';
    });
    var found_phone = valuecon_phone.find(function (conPh) {
      return conPh == '';
    });
    var found_email = valuecon_email.find(function (conEm) {
      return conEm == '';
    });
    var found_offDays = valuecon_offDays.find(function (conOffDay) {
      return conOffDay == '';
    });
    var found_city = valuecon_city.find(function (conCity) {
      return conCity == '';
    });
    var found_district = valuecon_district.find(function (conDis) {
      return conDis == '';
    });
    var found_state = valuecon_state.find(function (conState) {
      return conState == '';
    });
    var found_pincode = valuecon_pincode.find(function (conPincode) {
      return conPincode == '';
    });


    if(found_addr == ''){
      $('#contactInfoReq').html('All Fields is Required').css('color','red');
    }else if(found_contact == ''){
      $('#contactInfoReq').html('All Fields is Required').css('color','red');
    }else if(found_phone == ''){
      $('#contactInfoReq').html('All Fields is Required').css('color','red');
    }else if(found_email == ''){
      $('#contactInfoReq').html('All Fields is Required').css('color','red');
    }else if(found_offDays == ''){
      $('#contactInfoReq').html('All Fields is Required').css('color','red');
    }else if(found_city == ''){
      $('#contactInfoReq').html('All Fields is Required').css('color','red');
    }else if(found_district == ''){
      $('#contactInfoReq').html('All Fields is Required').css('color','red');
    }else if(found_state == ''){
      $('#contactInfoReq').html('All Fields is Required').css('color','red');
    }else if(found_pincode == ''){
      $('#contactInfoReq').html('All Fields is Required').css('color','red');
    }else{
      $('#contactInfoReq').html('');
      $('#submitdata').prop('disabled',true);
      $('#submit_data').prop('disabled',false);
    }
     
     /*var addr     = $('#address1').val();
     var contact  = $('#contact_person1').val();
     var phoneNo  = $('#phone1').val();
     var email    = $('#email1').val();
     var offDays  = $('#offDays1').val();
     var city     = $('#city1').val();
     var district = $('#district1').val();
     var state    = $('#state1').val();
     var pincode  = $('#pincode1').val();

      if(addr.trim() == '' && contact.trim() == '' && phoneNo.trim() == '' && city.trim() == '' && pincode.trim() == '' && district.trim() == '' && state == '' && email.trim() == '' && offDays.trim() == ''){
            
            $('#contactInfoReq').html('Contact Information Required.').css('color','red');
            return false;

          }else if(addr.trim() == ''){

             $('#contactInfoReq').html('Address Required.').css('color','red');

             return false;

          }else if(contact.trim() == ''){

            $('#contactInfoReq').html('');

            $('#contactInfoReq').html('Contact Required.').css('color','red');

            return false;

          }else if(phoneNo.trim() == ''){

            $('#contactInfoReq').html('');

            $('#contactInfoReq').html('Contact Person Required.').css('color','red');

            return false;

          }else if(city.trim() == ''){

            $('#contactInfoReq').html('');

            $('#contactInfoReq').html('City Required.').css('color','red');

            return false;

          }
          else if(pincode.trim() == ''){

            $('#contactInfoReq').html('');

            $('#contactInfoReq').html('Pincode Required.').css('color','red');

            return false;

          }
          else if(district.trim() == ''){

            $('#contactInfoReq').html('');

            $('#contactInfoReq').html('District Required.').css('color','red');

            return false;

          }
          else if(state== ''){

            $('#contactInfoReq').html('');

            $('#contactInfoReq').html('State Required.').css('color','red');

            return false;

          }
          else if(email.trim() == ''){

            $('#contactInfoReq').html('');

            $('#contactInfoReq').html('Email Required.').css('color','red');

            return false;

          }
          else if(offDays.trim() == ''){

            $('#contactInfoReq').html('');

            $('#contactInfoReq').html('Off Days Required.').css('color','red');

            return false;

          }else{
            $('#contactInfoReq').html('');
            $('#submitdata').prop('disabled',true);
            $('#submit_data').prop('disabled',false);
          }*/

      

     

  }
</script>


@endsection