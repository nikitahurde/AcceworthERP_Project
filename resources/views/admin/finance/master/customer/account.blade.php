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
.boxer {
  display: table;
  border-collapse: collapse;
  width: 72%;
}
.boxer .box-row {
  display: table-row;
}
.boxer .box-row:first-child {
  font-weight:bold;
}
.boxer .box {
  display: table-cell;
  vertical-align: top;
  border: 1px solid #dde0e4;
  padding: 5px;
  font-family:monospace;

}
.boxer .ebay {
  padding:5px 1.5em;
}
.boxer .google {
  padding:5px 1.5em;
}
.boxer .amazon {
  padding:5px 1.5em;
}
.center {
  text-align:center;
}
.right {
  float:right;
}
.stepwizard-step p {
  margin-top: 10px;
}
.tdthtablebordr{
  border: 1px solid #8c9192;
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
  font-size: 12px;
  margin-top: 0%;
  font-weight: 600;
  color: #4f90b5;
  line-height: 1;
  border:none;
}
  .hidebegore{
    display: none;
  }
  .hideThired{
    display: none;
  }
  .hideFouth{
    display: none;
  }
  .beforhidetble{
    display: none;
  }
  .popover{
    left: 180.4922px!important;
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
  .getAccType{
    display:none;
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
  .classAddrs{
    display: flex;
  }
  .iconshowhide{
    display:none;
  }
 @media screen and (max-width: 600px) {

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
    
    <h1> Master Account<small>Add Details</small></h1>

    <ol class="breadcrumb">

      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Master</a></li>

      <li class="Active"><a href="{{ URL('/finance/party-finance-master')}}">Master Account </a></li>

      <li class="Active"><a href="{{ URL('/finance/party-finance-master')}}">Add Account </a></li>

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

                <h4> <i class="icon fa fa-ban"></i> Error...!</h4>

                {!! session('alert-error') !!}

            </div>

          @endif

        <div class="col-sm-12">

          <div class="stepwizard">

                <div class="stepwizard-row setup-panel">

                  <div class="stepwizard-step">

                      <a href="#step-1" type="button" class="btn btn-primary btn-circle" id="stepone" style="pointer-events: none">1</a>

                      <p>Baisc Details</p>

                  </div>

                  <!-- <div class="stepwizard-step hidebegore" id="show_second">

                      <a href="#step-2" type="button" class="btn btn-default btn-circle" id="steptwo"disabled="disabled" style="pointer-events: none">2</a>

                      <p>Direct/Indirect Tax</p>

                  </div> -->

                  <div class="stepwizard-step hidebegore" id="show_second">

                      <a href="#step-2" type="button" class="btn btn-default btn-circle" id="steptwo" disabled="disabled" style="pointer-events: none">2</a>

                      <p>Address Details</p>

                  </div>

                 <!--  <div class="stepwizard-step hideThired" id="show_third">

                      <a href="#step-3" type="button" class="btn btn-default btn-circle" id="stepthree" disabled="disabled" style="pointer-events: none">4</a>

                      <p>Bank Details</p>

                  </div> -->

                </div>

          </div>

        <form id="accMaster">

        @csrf

        <div class="row setup-content" id="step-1">

        <div class="col-md-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Add Account</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('Master/Customer-Vendor/View-Account-Mast') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View Account</a>

              </div>

          </div><!-- /.box-header -->

          <div class="box-body">

             <div class="col-xs-12">

              <div class="col-md-12">

                <div class="row">

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Account Type Code : <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <?php $acCount = count($acctype_lists); ?>
                            <input list="accList" type="text" class="form-control" name="acctype_code" id="acctype_code" placeholder="Select Account type" value="{{ old('acctype_code') }}" <?php if($acCount ==1){echo $acctype_lists[0]->ATYPE_CODE; }else{} ?> autocomplete="off"><br>

                              <datalist id="accList">

                              <?php foreach ($acctype_lists as $key) { ?>

                                <option value="<?php echo $key->ATYPE_CODE; ?>" data-xyz="{{ $key->ATYPE_NAME  }}"><?php echo $key->ATYPE_CODE;?> = <?php echo   $key->ATYPE_NAME;?></option>

                              <?php } ?>

                              </datalist>
                        
                        </div>
                        <input type="hidden" value="" id="isBankReq">
                        <small id="accTypeErr" class="form-text text-muted"></small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Account Name: <span class="required-field"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                        <input type="text" id="acc_name" name="acc_name" class="form-control  pull-left uppercase" value="{{ old('acc_name') }}" placeholder="Select Acc Name" style="text-transform:uppercase" oninput="funGenAccCode(this)" maxlength="40" autocomplete="off">

                      </div>

                      <small id="accnameErr" class="form-text text-muted"></small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Account Code: <span class="required-field"></span><samll id="accCodeDubErr" style="color: red"></samll></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                        <input type="text" id="acc_code" name="acc_code" class="form-control pull-left codeCapital" placeholder="Select Acc Code" maxlength="6" value="{{ old('acc_code') }}" autocomplete="off" readonly="" >

                        

                       <!--  <div class="custom-select">
                          <div id="showSearchCodeList" class="custom-options">
                        
                          </div>  
                        </div> -->

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('acc_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="acccodeErr" class="form-text text-muted"> </small>

                    </div><!-- /.form-group -->

                  </div>

                   <div class="col-md-3">

                    <div class="form-group">

                      <label>GL Code: <span class="required-field"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <?php $glcount = count($gl_lists); ?>

                              <input list="GLList" type="text" class="form-control" name="gl_code" id="gl_code" placeholder="Select Gl Code" value="{{ old('gl_code') }}" autocomplete="off" >

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

                  </div>

                  

                  

                </div>

                <div class="row">

                  <div class="col-md-3">
                    
                    <div class="form-group">

                      <label>Company Code : </label>
                        
                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input list="compList" type="text" class="form-control" name="comp_code" id="comp_code" placeholder="Select Comp Code" value="" autocomplete="off">

                          <datalist id="compList">

                              @foreach($company_lists as $key) 

                                <option value="{{$key->COMP_CODE}}" data-xyz="{{ $key->COMP_NAME  }}">{{$key->COMP_CODE }} = {{$key->COMP_NAME}}</option>

                              @endforeach

                          </datalist>
                      
                        </div>
                    </div>

                  </div>

                  <div class="col-md-3">
                    
                    <div class="form-group">

                      <label>Company Name : </label>
                        
                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                          <input  type="text" class="form-control" name="comp_name" id="comp_name" placeholder="Select Company Name" value="" readonly="">

                        </div>

                    </div>

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Account Category Code: </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>
                        <?php $accat = count($acccategory_lists); ?>
                        <input list="accCatList" type="text" class="form-control" name="acccategory_code" id="acccategory_code" placeholder="Select Account Category" value="{{ old('acccategory_code') }}<?php if($accat ==1){echo $acccategory_lists[0]->ACATG_CODE;}else{}?>" autocomplete="off">

                        <datalist id="accCatList">

                              <option value="">--Select--</option>

                              <?php foreach ($acccategory_lists as $key) { ?>

                                <option value="<?php echo $key->ACATG_CODE ?>" data-xyz="{{ $key->ACATG_NAME }}"><?php echo $key->ACATG_CODE?> = <?php echo   $key->ACATG_NAME?></option>

                              <?php } ?>

                        </datalist>   

                      </div>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Account Class Code: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                            <?php $classcount = count($accclass_lists); ?>

                              <input list="accClassList" type="text" class="form-control" name="accclass_code" id="accclass_code" placeholder="Select Account Class" value="{{ old('accclass_code') }}" autocomplete="off">

                              <datalist id="accClassList">
                                <option value="">--Select--</option>

                                <?php foreach ($accclass_lists as $key) { ?>

                                  <option value="<?php echo $key->ACLASS_CODE  ?>" data-xyz="{{ $key->ACLASS_NAME }}"><?php echo $key->ACLASS_CODE?> = <?php echo $key->ACLASS_NAME?></option>

                                <?php } ?>

                              </datalist>
                          
                        </div>


                    </div>

                    <!-- /.form-group -->

                  </div>

                 

                </div>

                <div class="row">

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Credit Limit: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="credit_limit" id="credit_limit" placeholder="Enter Credit Limit"  value="" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)) " autocomplete="off">
                          
                        </div>
                        <small id="taxcodeErr" class="form-text text-muted"> </small>
                        <div class="pull-left showSeletedName" id="accClassText"></div>

                        

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>GP Days: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="gp_days" id="gp_days" placeholder="Enter GP Days" autocomplete="off">
                          
                        </div>
                        <small id="gpErr" class="form-text text-muted"> </small>
                        <div class="pull-left showSeletedName" id="accClassText"></div>

                        

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>Alias Code :<span class="required-field getAccType" id="aliasCodeReq"></span> </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="AliasCode" id="AliasCodeId" placeholder="Enter Alias Code" value="" autocomplete="off">
                          
                        </div>
                        <small id="aliasCod" class="form-text text-muted"></small>
                        <div class="pull-left showSeletedName" id="accClassText"></div>

                    </div>

                    <!-- /.form-group -->

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>Alias Name :<span class="required-field getAccType"></span> </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" class="form-control" name="AliasName" id="AliasNameId" placeholder="Enter Alias Name" autocomplete="off">
                          
                        </div>
                        <small id="aliasNm" class="form-text text-muted"> </small>
                        <div class="pull-left showSeletedName" id="accClassText"></div>

                        

                    </div>

                    <!-- /.form-group -->

                  </div>
                  
                </div> <!-- /.row -->

                <div class="row">

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>SAP Code : </label>

                        <div class="input-group">

                          <span class="input-group-addon">
                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </span>
                          <input type="text" class="form-control" name="sap_code" id="sapCode" placeholder="Enter SAP Code"  value="" autocomplete="off">
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
                          <input type="text" class="form-control" name="file_path" id="filePath" placeholder="Enter File Path"  value="" autocomplete="off">
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

                          <input list="accBillFormat" class="form-control" name="bill_format" id="billFormat" placeholder="Select Bill Format" autocomplete="off">

                          <datalist id="accBillFormat">
                            <option value="">--Select--</option>

                              <option value="JSW_BILL" data-xyz="JSW_BILL">JSW_BILL</option>
                              <option value="TATA_BILL" data-xyz="TATA_BILL">TATA_BILL</option>
                              <option value="JCOP_BILL" data-xyz="JCOP_BILL">JCOP_BILL</option>
                              <option value="C_AND_F_BILL" data-xyz="C_AND_F_BILL">C_AND_F_BILL</option>
                              <option value="OTHER_PARTY" data-xyz="OTHER_PARTY">OTHER_PARTY</option>

                          </datalist>

                        </div>
                        <small id="taxcodeErr" class="form-text text-muted"> </small>

                        <div class="pull-left showSeletedName" id="billFormatText"></div>

                    </div> <!-- /.form-group -->
                  </div>
                </div> <!-- ./row -->

              </div>

            </div>
          </div>

        </div><!-- first box -->

          <!-- start Second box direct indirect tax -->
        <div class="box box-warning Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Direct/Indirect Tax</h2>

          </div>

           <div class="box-body">

            <div class="col-xs-12">

              <div class="col-md-12">

                <div class="row">

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>TAX Code: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>
                          </span>

                          <input list="taxcodeList" type="text" class="form-control" name="tax_code" id="tax_code" placeholder="Select Tax Code" value="{{ old('tax_code') }}" maxlength="15" autocomplete="off">

                            <datalist id="taxcodeList">

                              <option value="">--Select--</option>

                              <?php foreach ($tax_lists as $key) { ?>

                                <option value="<?php echo $key->TAX_CODE ?>" data-xyz="{{ $key->TAX_NAME }}"><?php echo $key->TAX_CODE?> = <?php echo $key->TAX_NAME ?></option>

                              <?php } ?>

                            </datalist>

                        </div>

                        <div class="pull-left showSeletedName" id="taxcodeText"></div>

                        <small id="contactperErr" class="form-text text-muted"> </small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-2">

                    <div class="form-group">

                      <label>TDS Type: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></span>

                          <input list="tdsTypeList" id="tds_type" name="tds_type" class="form-control pull-left" placeholder="Enter TDS Type" maxlength="15" value="{{ old('tds_type') }}" autocomplete="off">

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

                        <input list="tdsList" type="text" class="form-control" name="tds_code" id="tds_code" placeholder="Select Tds Code" maxlength="15" value="{{ old('tds_code') }}" autocomplete="off">

                        <datalist id="tdsList">

                              <option value="">--Select--</option>

                              <?php foreach ($tds_lists as $key) { ?>

                                <option value="<?php echo $key->TDS_CODE ?>" data-xyz="{{ $key->TDS_NAME }}"><?php echo $key->TDS_CODE?> = <?php echo $key->TDS_NAME?></option>

                              <?php } ?>

                        </datalist>

                      </div>
                      <div class="pull-left showSeletedName" id="tdscodeText"></div>
                      <small id="accnameErr" class="form-text text-muted"></small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>TAN No: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></span>

                          <input type="text" id="tan_no" name="tan_no" class="form-control pull-left" placeholder="Enter Phone No.1" maxlength="15" value="{{ old('tan_no') }}" autocomplete="off">

                        </div>

                        <small id="contactperErr" class="form-text text-muted"> </small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>TIN No: </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></span>

                        <input type="text" id="tinno" name="tinno" class="form-control pull-left" placeholder="Enter Phone No.1" maxlength="15" value="{{ old('tinno') }}" autocomplete="off">

                      </div>

                      <small id="accnameErr" class="form-text text-muted" style="color: red;"></small>

                    </div><!-- /.form-group -->

                  </div>

                </div>

                <div class="row">

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Sale Tax No: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <input type="text" id="sales_taxno" name="sales_taxno" class="form-control pull-left" placeholder="Enter Sale Tax No" maxlength="15" value="{{ old('sales_taxno') }}" autocomplete="off">

                        </div>

                        <small id="contactperErr" class="form-text text-muted"> </small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>CSale Tax No: </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                        <input type="text" id="csales_taxno" name="csales_taxno" class="form-control pull-left" placeholder="Enter CSale Tax No" maxlength="15" value="{{ old('csales_taxno') }}" autocomplete="off">

                      </div>

                      <small id="accnameErr" class="form-text text-muted"></small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Service Tax No: </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-desc" aria-hidden="true"></i></span>

                          <input type="text" id="service_taxno" name="service_taxno" class="form-control pull-left" placeholder="Enter Service Tax No" maxlength="15" value="{{ old('service_taxno') }}" autocomplete="off">
                        
                        </div>

                        <small id="contactperErr" class="form-text text-muted"> </small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label>Pan No: </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                        <input type="text" id="panno" name="panno" class="form-control pull-left" placeholder="Enter Pan No" maxlength="10" value="{{ old('panno') }}" autocomplete="off">

                      </div>

                      <small id="accnameErr" class="form-text text-muted"></small>

                    </div><!-- /.form-group -->

                  </div>

                </div>

                <!-- <center><button class="btn btn-danger" type="button" id="backBtn2">Back</button><button class="btn btn-primary btn-md nextBtn" type="button" id="secondstep">Next</button></center> -->

              </div>

            </div>
            
          </div>
          

        </div>

        <div class="box box-success Custom-Box">
         
          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Bank Details</h2>

          </div> 

          <div class="box-body">
             <div class="col-xs-12">

              <div class="col-md-12">

                <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>Bank Name: <span class="required-field iconshowhide" id="bankNameTx"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                        <input type="text" class="form-control" name="bank_name" id="bank_name" value="" placeholder="Enter Bank Name" value="{{ old('bank_name') }}" autocomplete="off">

                      </div>

                      <small id="banknameErr" class="form-text text-muted"></small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>Account Number : <span class="required-field iconshowhide" id="accNameTx"></span></label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                        <input type="text" class="form-control" name="acc_number" id="acc_number" value="" placeholder="Enter Account Number" value="{{ old('acc_number') }}" maxlength="20" autocomplete="off">
                            
                      </div>

                      <small id="accnumberErr" class="form-text text-muted"></small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>Branch : <span class="required-field iconshowhide" id="branchTx"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                          <input type="text" id="branch_name" name="branch_name" class="form-control pull-left" placeholder="Enter Branch Name" value="{{ old('branch_name') }}" maxlength="50" autocomplete="off">

                        </div>

                        <small id="branchnameErr" class="form-text text-muted"> </small>

                    </div><!-- /.form-group -->

                  </div>

                </div>

                <div class="row">

                  <div class="col-md-4">

                    <div class="form-group">

                      <label>IFSC Code : 
                          <span class="required-field iconshowhide" id="ifscTx"></span>
                      </label>

                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                        <input type="text" id="ifsc_code" name="ifsc_code" class="form-control pull-left" placeholder="Enter IFSC Code" value="{{ old('ifsc_code') }}" maxlength="11" autocomplete="off">

                      </div>

                      <small id="ifsccodeErr" class="form-text text-muted"></small>

                    </div><!-- /.form-group -->

                  </div>

                  <div class="col-md-8">

                    <div class="form-group">

                      <label>Address : <span class="required-field iconshowhide" id="addresTx"></span></label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>

                          <textarea class="form-control" col="50" rows="2" name="bank_address" placeholder="Enter Address" id="bank_address" value="{{ old('bank_address') }}"></textarea>
                          <!--  <input type="text" id="branch_name" name="branch_name" class="form-control pull-left" placeholder="Enter Branch Name"> -->
                        
                        </div>

                        <small id="bankaddressErr" class="form-text text-muted"> </small>

                    </div><!-- /.form-group -->

                  </div>

                </div>

                <center>
                  <!-- <button class="btn btn-danger" type="button" id="backBtn4">Back</button> -->
                  <!-- <button class="btn btn-primary btn-md" type="button" id="submitdata" onclick="validation()">Save</button></center> -->

                  <button class="btn btn-primary" type="button" id="firstStep" style="width:80px;"><i class="fa fa-arrow-right" aria-hidden="true"></i>&nbsp;&nbsp;Next </button>

              </div>

            </div>
          </div>

        </div>



        </div>
      
       

        </div><!-- first step -->
       
        <div class="row setup-content" id="step-2">

          <div class="box-body">
             <div class="col-xs-12">

              <div class="col-md-12">

                <div class="row">

                  <div class="col-sm-12">

                    <div class="box box-primary Custom-Box">

                      <div class="box-body">

                          <div class="table-responsive tdthtablebordr Custom-Box" style="overflow-x: unset;border-radius:7px;">

                          <table class="table tdthtablebordr " border="1" cellspacing="0" id="tbledata">

                            <tr>

                              <th><input class='check_all' type='checkbox' onclick="select_all()"/ title="Delete All Row"></th>
                              <th>Sr.No.</th>
                              <th style="text-align: center;">Contact Information</th>
                              <th style="text-align: center;">Others</th>
                          
                            </tr>

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
                                        <input type="text" class="textdesciptn discription forperticulr"  name="district[]" id="district1" placeholder="District" value="{{ old('district') }}" style="margin-bottom: 5px;width: 120px;" ></div>

                                        <div class="classAddrs"><span class="required-field"></span>
                                          <input list="stateList" class="textdesciptn discription forperticulr"  name="state[]" id="state1" placeholder="State" value="{{ old('state') }}" style="margin-bottom: 5px;width: 120px;" >

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

                          </table>

                          </div>

                          <div style="margin-top:1%;">
          
                            <button type="button" class='btn btn-danger btn-sm delete' id="deletehidn" disabled><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button>

                            <button type="button" class='btn btn-info btn-sm addmore' id="addmorhidn" disabled><i class="fa fa-plus" aria-hidden="true" style="font-size: 11px;" ></i>&nbsp; Add More</button>

                          </div><!-- /.box-body -->

                      </div>

                    </div>

                  </div>
                          
                  <center>  <button class="btn btn-danger" type="button" id="backBtn2" style="width: 80px;margin-right: 0.5%;"> <i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;&nbsp;Back</button><button class="btn btn-primary btn-md" type="button" id="submitdata" onclick="validation()" style="width: 80px;"><i class="fa fa-floppy-o"></i>&nbsp;&nbsp;Save</button></center>

                </div>

              </div>

            </div>
          </div>
          
        </div>
        


        </form>


        </div>
        

        <!-- close here -->

      </div>

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
      if (keycode == 46 || this.value.length==10) {
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

  });


function GstType(num){
  
  var gst_type = $("#gst_type"+num).val();

  if(gst_type=='Register'){

    $("#thirdStep").prop('disabled',true);
     $('#gst_num'+num).css('border-color','red');
  }else{

    $("#thirdStep").prop('disabled',false);

   $('#gst_num'+num).val('');
    $('#gst_num'+num).css('border-color','black');
  }
}

function gstNum(num){

  var gst_num = $("#gst_num"+num).val();

  if(gst_num){

    $("#thirdStep").prop('disabled',false);
    $('#gst_num1').css('border-color','#d2d6de');
  }else{

    $("#thirdStep").prop('disabled',true);
  }

}
</script>

<script type="text/javascript">
  $(document).ready(function(){


   $('#address1').on('input',function(){

       var address = $('#address1').val();
     
       if(address){
        $('#addmorhidn').prop('disabled',false);
        $('#deletehidn').prop('disabled',false);
       }else{
        $('#addmorhidn').prop('disabled',true);
        $('#deletehidn').prop('disabled',false);
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
       // $('#acc_name').val('');
        $('#acc_code').val('');
      }else{
        $('#acctype_code').val(val+'['+msg+']');
        $('#accTypeErr').html('');
        // $('#acc_name').val('');
        $('#acc_code').val('');


        if (msg == 'SALES REPRESENTATIV') {
         
          $("#aliasCodeReq").removeClass('getAccType');

        }else{

            $("#aliasCodeReq").addClass('getAccType');

        }
      }

      var accType      = $(this).val();
      var splitAccType = accType.split('[');
      var accTypeCode  = splitAccType[0];

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

      });

      $.ajax({

            url:"{{ url('check-n-get-data-against-accType') }}",

             method : "POST",

             type: "JSON",

             data: {accTypeCode: accTypeCode},

             success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                }else if(data1.response == 'success'){

                  if(data1.data == ''){

                  }else{
                    $('#isBankReq').val(data1.data[0].BANK_REQ);
                    var bankReqYes = $('#isBankReq').val();
                    // var bankReqYes = 'YES';
                    if(bankReqYes == 'YES'){
                      $('#bankNameTx,#accNameTx,#branchTx,#ifscTx,#addresTx').removeClass('iconshowhide');
                    }else{
                      $('#bankNameTx,#accNameTx,#branchTx,#ifscTx,#addresTx').addClass('iconshowhide');
                    }
                  }
                      
                }
             }

      });

    });

  $("#acccategory_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accCatList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
             $(this).val('');
             $('#accCatText').val('');
          }else{
            $('#acccategory_code').val(val+'['+msg+']');
          }

        });

      $("#accclass_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accClassList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){
             $(this).val('');
             $('#accClassText').val('');
          }else{
            $('#accclass_code').val(val+'['+msg+']');
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
             $('#glText').val('');

          }else{
            $('#gl_code').val(val+'['+msg+']');
            $('#glcodeErr').html('');
          }

      });




  /*$("#state").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#stateList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';


         document.getElementById("stateText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          
          
          }else{

            

          }

        });*/


  $("#tax_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#taxcodeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

         document.getElementById("taxcodeText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });

  $("#tds_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#tdsList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);


         document.getElementById("tdscodeText").innerHTML = msg; 

          if(msg=='No Match'){

             $(this).val('');
          

          }

        });




   });
</script>



<script type="text/javascript">

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

<script>

  function funGenAccCode(element){

    var getAccName = $('#acc_name').val();
    var tbl_name = 'MASTER_ACC';
    var col_code = 'ACC_CODE';
    
    if(getAccName){

      var max_chars = 1;
  
      var element_value ;
      if(getAccName.length >= max_chars) {
        element_value = element.value.substr(0, 1);
        element_value = element_value.toUpperCase();
      }else if(getAccName.length <= max_chars){
         $('#acc_code').val('');
      }else{
        $('#acc_code').val('');
      }
   
      var acc_type = $('#acctype_code').val();
      var atype = acc_type.split("[");
      var acctype_name = atype[0];
     
     

      var aname = element_value;
      var likename = acctype_name+''+aname;
      
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
              $('#acc_code').val(newcode);
            }else{
              $('#acc_code').val('');
            }

          }
        }
      }); /* /.ajax*/

    }else{
      $('#acc_code').val('');
    } /* /. codn*/
     
  }/* /. main fucn*/

</script>

<script type="text/javascript">

  

   $(document).ready(function(){
   	$('#address1').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
         return false;
     }
    });

    $('#firstStep').click(function(){

      var comp_code = $("#comp_code").val();

      var comp_name = $("#comp_name").val();
      
      var acc_code  = $("#acc_code").val();

      var AliasCode  = $("#AliasCodeId").val();

      var acc_name  = $("#acc_name").val();
      var acc_type  = $("#acctype_code").val();
      var gl_code   = $("#gl_code").val();
      var aliasCd = $('#AliasCodeId').val();

      var bank_name        = $("#bank_name").val();
      var acc_number       = $("#acc_number").val();
      var branch_name      = $("#branch_name").val();
      var ifsc_code        = $("#ifsc_code").val();
      var bank_address     = $("#bank_address").val();
      var isBankDetailsReg = $('#isBankReq').val();
      // var isBankDetailsReg = 'YES';

          // console.log('acc_type',acc_type);

          /*if (acc_type=='SALES REPRESENTATIV' || acc_type=='SR' || acc_type=='SR[SALES REPRESENTATIVE]') {

            $('#aliasCod').html('*The alias code field is required.').css('color','red');

          }else{

            $('#aliasCod').html('');
            

          }*/


      if(acc_code.trim() == '' || acc_name.trim() == '' || acc_type.trim() == '' || gl_code.trim() == ''){

         $('#acccodeErr').html('*The account code field is required.').css('color','red');

         $('#accnameErr').html('*The account name field is required.').css('color','red');

         $('#accTypeErr').html('*The account type field is required.').css('color','red');
         $('#glcodeErr').html('*The gl code field is required.').css('color','red');
       
       return false;

      }else if(acc_code.trim() == ''){

           $('#acccodeErr').html('The account code field is required.').css('color','red');

           return false;

      }else if(acc_name.trim() == ''){

           $('#accnameErr').html('The account name field is required.').css('color','red');

           return false;

      }else if(acc_type.trim() == ''){

           $('#accTypeErr').html('The account type field is required.').css('color','red');

           return false;

      }else if(acc_name.trim() == '' && acc_type.trim() == '' &&  gl_code.trim() == ''){

          $('#acccodeErr').html('');

          $('#accnameErr').html('The account name field is required.').css('color','red');

          $('#accTypeErr').html('The account type field is required.').css('color','red');
          $('#glcodeErr').html('The gl code field is required.').css('color','red');

          return false;

      }else if(acc_type.trim() == '' &&  gl_code.trim() == ''){

          $('#acccodeErr').html('');
          $('#accnameErr').html('');

          $('#accTypeErr').html('The account type field is requireds.').css('color','red');
          $('#glcodeErr').html('The gl code field is required.').css('color','red');

          return false;

      }else if(gl_code.trim() == ''){

          $('#accTypeErr').html('');

          $('#glcodeErr').html('The gl code field is required.').css('color','red');

          return false;

      }else if(acc_type=='SALES REPRESENTATIV' || acc_type=='SR' || acc_type=='SR[SALES REPRESENTATIVE]' && aliasCd==''){
              $('#aliasCod').html('*The alias code field is required.').css('color','red');
                return false;
      }else{

            $('#acccodeErr').html('');

            $('#accnameErr').html('');

            $('#accTypeErr').html('');
            $('#aliasCod').html('');

            // $('#stepone').removeClass('btn-primary');

            // $('#steptwo').addClass('btn-primary');

            // $('#step-1').css('display','none');

            // $('#step-2').css('display','block');

            // $('#show_second').removeClass('hidebegore');

           

            // return true;

       }

       if(isBankDetailsReg == 'YES'){

        if(bank_name.trim() ==''){
         
          $('#banknameErr').html('The bank name field is required.').css('color','red');
          return false;
        }else{
          $('#banknameErr').html('');
        }

        if(acc_number.trim() == ''){
          $('#accnumberErr').html('The account number field is required.').css('color','red');
          return false;
        }else{
          $('#accnumberErr').html('');
        }

        if(branch_name.trim() == ''){
          $('#branchnameErr').html('The branch name field is required.').css('color','red');
          return false;
        }else{
          $('#branchnameErr').html('');
        }

        if(ifsc_code.trim() == ''){
          $('#ifsccodeErr').html('The ifsc code field is required.').css('color','red');
          return false;
        }else{
          $('#ifsccodeErr').html('');
        }

        if(bank_address.trim() == ''){
          $('#bankaddressErr').html('The bank address field is required.').css('color','red');
          return false;
        }else{
          $('#bankaddressErr').html('');
        }

        if(bank_name && acc_number && branch_name && ifsc_code && bank_address){
          // submitAccMaster();

             // $('#stepone').removeClass('btn-primary');

            $('#steptwo').addClass('btn-primary');

            $('#step-1').css('display','none');

            $('#step-2').css('display','block');

            $('#show_second').removeClass('hidebegore');

           

            return true;
        }

      }else{
        // submitAccMaster();

         $('#steptwo').addClass('btn-primary');

        $('#step-1').css('display','none');

        $('#step-2').css('display','block');

        $('#show_second').removeClass('hidebegore');

       

        return true;
      }

      });



      /*$('#secondstep').click(function(){

               $('#step-1').css('display','none');

               $('#step-2').css('display','none');

               $('#step-3').css('display','block');

               $('#steptwo').removeClass('btn-primary');

               $('#stepthree').addClass('btn-primary');

               $('#show_third').removeClass('hideThired');

            

      });



      $('#thirdStep').click(function(){

               $('#step-1').css('display','none');

               $('#step-2').css('display','none');

               $('#step-3').css('display','none');

               $('#step-4').css('display','block');

               $('#stepthree').removeClass('btn-primary');

               $('#stepfour').addClass('btn-primary');

               $('#show_four').removeClass('hideFouth');

      });

*/
$('#secondstep').click(function(){

               $('#step-1').css('display','none');

               $('#step-2').css('display','none');

               $('#step-3').css('display','none');

               $('#step-4').css('display','block');

               $('#steptwo').removeClass('btn-primary');

               $('#stepfour').addClass('btn-primary');

                $('#show_four').removeClass('hideFouth');
               

            

      });



      $('#thirdStep').click(function(){

        var addrs    = $('#address1').val();
        var contact  = $('#contact_person1').val();
        var phoneNo  = $('#phone1').val();
        var email    = $('#email1').val();
        var offDays    = $('#offDays1').val();
        var city     = $('#city1').val();
        var district = $('#district1').val();
        var state    = $('#state1').val();
        var pincode  = $('#pincode1').val();
       
        if(addrs && contact && phoneNo && email && offDays && city && district && state && pincode ){
              $('#contactInfoReq').html('');
              $('#step-1').css('display','none');

               $('#step-2').css('display','none');

               $('#step-3').css('display','block');

               $('#step-4').css('display','none');

               $('#stepfour').removeClass('btn-primary');

               $('#stepthree').addClass('btn-primary');

              $('#show_third').removeClass('hideThired');

        }else{
            $('#contactInfoReq').html('Contact Information Required').css('color','red');
        }

               


      });






  });

</script>

<script type="text/javascript">
 $(function(){
    $('#login').popover({
       
        placement: 'bottom',
        title: 'Help Account Code <a  class="btn btn-default btn-xs pull-right" style="margin-top: -1%;" id="closeModel">X</a>',
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

          var AccCodeHelp = $('#AccCodeHelp').val();

           if(AccCodeHelp == ''){
              $('#HideWhenSearch').show();
              $('#ShowWhenSeaech').hide();
              $('#errorItem').html('');
           }else{

              $.ajax({

                url:"{{ url('help-Acc-code-getdataforfinance') }}",

                 method : "POST",

                 type: "JSON",

                 data: {AccCodeHelp: AccCodeHelp},

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
                           //  $('#ShowWhenSeaech').empty();
                             $.each(objcity, function (i, objcity) {
                               $('#ShowWhenSeaech').append('<div class="box" style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.acc_code+'</div><div style="font-size: 12px;padding-top: 2%;padding-bottom: 2%;">'+objcity.acc_name+'</div>');
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

    $('#acc_name').on('keyup',function(){
        var acc_name = $('#acc_name').val();
        if(acc_name){
          $('#accnameErr').html('');
        }else{
          $('#accnameErr').html('The account name field is required.');
        }
    });

    $('#acc_code').on('input',function(){

      $.ajaxSetup({

            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

      });

      var acc_code = $('#acc_code').val();

        if(acc_code == ''){

           $('#showSearchCodeList').hide();
            $('#acccodeErr').html('The account code field is required.');
        }else{
          $('#acccodeErr').html('');

       $.ajax({

            url:"{{ url('search-Acc-code-get') }}",

             method : "POST",

             type: "JSON",

             data: {acc_code: acc_code},

             success:function(data){

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                      $('#showSearchCodeList').empty();
                      $("#accCodeDubErr").html('');
                      $("#firstStep").prop('disabled',false);
                  }else if(data1.response == 'success'){

                      var count = data1.data_acc.length;

                      if(count > 0){

                        $("#accCodeDubErr").html('This acc code already exist');
                        $("#firstStep").prop('disabled',true);
                      }else{
                        $("#accCodeDubErr").html('');
                        $("#firstStep").prop('disabled',false);
                      }
                      
                       var objcity = data1.data;
                       $('#shoemsgonin').html('');
                       $('#showSearchCodeList').show();
                          $('#showSearchCodeList').empty();
                         $.each(objcity, function (i, objcity) {
                           $('#showSearchCodeList').append('<span class="custom-option">'+
                            objcity.ACC_CODE+'</span><br>');
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
    check();

});

var i=2;

$(".addmore").on('click',function(){

      var getpaymode = 'To -';

    count=$('table tr').length;

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

    var data="<tr><td class='tdthtablebordr'><input type='checkbox' class='case' name='countcheckbox[]' id='countcheckbox"+count+"'/></td><td class='tdthtablebordr'><span id='snum"+i+"'>"+count+".</span><input type='hidden' name='slno[]' id='slno"+i+"' value='"+count+"'></td>";

    data +="<td class='tdthtablebordr' style='width: 45%;'><small id='contactInfoReq'></small><div class='input-group' style='width: 100%;'> <div class='classAddrs'><span class='required-field'></span><textarea  name='address[]' id='address"+i+"' cols='20' rows='2' placeholder='Address' style='width: 100%;margin-bottom: 5px;' value='{{ old('address') }}'></textarea></div><div class='row'><div class='col-md-6'><div class='classAddrs'><span class='required-field'></span> <input type='text' class='inputboxclr  getAccNAme form-group ' style='width: 120px;margin-bottom: 5px;'  id='contact_person"+i+"' name='contact_person[]' placeholder='Contact Person'  value='{{ old('contact_person') }}'/></div><div class='classAddrs'><span class='required-field'></span><input type='text' class='textdesciptn discription forperticulr Number'  name='phone[]' id='phone"+i+"' placeholder='Phone No' value='{{ old('phone') }}' style='margin-bottom: 5px;width: 120px;' maxlength='10'></div><div class='classAddrs'><span class='required-field'></span><input type='text' class='textdesciptn discription forperticulr'  name='email[]' id='email"+i+"' value='{{ old('email') }}' placeholder='Email' style='margin-bottom: 5px;width: 120px;'></div><div class='classAddrs'><span class='required-field'></span><input list='offDaysList"+i+"' class='textdesciptn discription forperticulr form-group'  name='offDays[]' id='offDays"+i+"' placeholder='Off Days' value='{{ old('offDays') }}' onchange='getFullAdrs("+i+")' style='margin-bottom: 5px;width: 120px;'><datalist id='offDaysList"+i+"'><option value=''>--SELECT--</option><option value='SUNDAY' data-xyz='SUNDAY'>SUNDAY</option><option value='MONDAY' data-xyz='MONDAY'>MONDAY</option><option value='TUESDAY' data-xyz='TUESDAY'>TUESDAY</option><option value='WEDNESDAY' data-xyz='WEDNESDAY'>WEDNESDAY</option><option value='THURSDAY' data-xyz='THURSDAY'>THURSDAY</option><option value='FRIDAY' data-xyz='FRIDAY'>FRIDAY</option><option value='SATURDAY' data-xyz='SATURDAY'>SATURDAY</option></datalist></div></div><div class='col-md-6'><div class='classAddrs'><span class='required-field'></span><input list='cityList"+i+"' class='textdesciptn discription forperticulr form-group'  name='city[]' id='city"+i+"' placeholder='City' value='{{ old('city') }}' onchange='getFullAdrs("+i+")' style='margin-bottom: 5px;width: 120px;'><datalist id='cityList"+i+"'>@foreach($city_lists as $key)<option value='{{$key->CITY_CODE}}' data-xyz='{{ $key->CITY_NAME  }}'>{{$key->CITY_CODE }} = {{$key->CITY_NAME}}</option>@endforeach</datalist></div><div class='classAddrs'><span class='required-field'></span> <input type='text' class='textdesciptn discription forperticulr'  name='district[]' id='district"+i+"' placeholder='District' value='{{ old('district') }}' style='margin-bottom: 5px;width: 120px;' readonly></div><div class='classAddrs'><span class='required-field'></span><input list='stateList' class='textdesciptn discription forperticulr'  name='state[]' id='state"+i+"' placeholder='State' value='{{ old('state') }}' style='margin-bottom: 5px;width: 120px;' readonly></div><div class='classAddrs'><span class='required-field'></span><input type='text' class='textdesciptn discription forperticulr form-group Number'  name='pincode[]' id='pincode"+i+"' placeholder='Pincode' maxlength='8' value='{{ old('pincode') }}'  style='margin-bottom: 5px;width: 120px;'></div></div></div></div></td><td class='tdthtablebordr'><div class='row'><div class='col-md-4'><select type='text' class='inputboxclr getAccNAme' style='width: 120px;margin-bottom: 5px;height:25px;' id='gst_type"+i+"' name='gst_type[]' onclick='GstType("+i+")' ><option value=''>--GST TYPE--</option><option value='Register'>Register</option><option value='UnRegister'>UnRegister</option><option value='Not-Applicable'>Not-Applicable</option></select></div><div class='col-md-4'><input type='text' class='textdesciptn discription forperticulr'  name='gst_num[]' id='gst_num"+i+"' style='width: 120px;margin-bottom: 5px;' placeholder='GST No' oninput='gstNum("+i+")'></div><div class=col-md-4><input type='text' class='inputboxclr getAccNAme' style='width: 110px;margin-bottom: 5px;' id='ecc_no"+i+"' name='ecc_no[]' style='width: 120px;margin-bottom: 5px;' placeholder='ECC NO'></div></div><div class='row'><div class='col-md-12'><textarea type=text class='textdesciptn discription forperticulr'  name='range_address[]' id='range_address"+i+"' style='width: 356px;margin-bottom: 5px;' placeholder='Range Address'></textarea></div></div><div class=row><div class='col-md-6'><input type='text' class='textdesciptn discription forperticulr'  name='range_no[]' id='range_no"+i+"' style='width: 120px;margin-bottom: 5px;' placeholder='Range No'></div><div class='col-md-6'><input type='text' class='inputboxclr getAccNAme' style='width: 120px;margin-bottom: 5px;' id='range_name"+i+"' name='range_name[]' placeholder='Range Name' /></div></div><div class=row><div class='col-md-6'><input type='text' class='textdesciptn discription forperticulr'  name='division[]' id='division"+i+"' style='width: 120px;margin-bottom: 5px;' placeholder='Division'></div><div class='col-md-6'><input type='text' class='inputboxclr getAccNAme' style='width: 120px;margin-bottom: 5px;' id='collector"+i+"' name='collector[]' style='width: 120px;margin-bottom: 5px;' placeholder='Collector' /></div></div></td></tr>";

    $('table').append(data);

    i++;



});


</script>


<script type="text/javascript">

  $("#acctype_code").click(function(){
   var acc_type =  $('#acctype_code').val();
   
  });

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

                }else if(data1.response == 'success'){

                    var details = data1.data;
                    $('#district'+num).val(details[0]['DISTRICT_CODE']+'['+details[0]['DISTRICT_NAME']+']');
                    $('#state'+num).val(details[0]['STATE_CODE']+'['+details[0]['STATE_NAME']+']');
                    $('#pincode'+num).val(details[0]['PIN_CODE']);
                }
            }

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
      submitAccMaster();
     
    }
     
  }

  function submitAccMaster(){

    var data = $("#accMaster").serialize();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }

    });

    $.ajax({

      type: 'POST',

      url: "{{ url('/Master/Customer-Vendor/Account-Save') }}",

      data: data, // here $(this) refers to the ajax object not form
      success: function (data) {
          
          var data1 = JSON.parse(data);
          if(data1.response == 'error') {
            var responseVar = false;
            var url = "{{url('master/acc-master/save-msg')}}"
            setTimeout(function(){ window.location = url+'/'+responseVar; });
          }else{
            var responseVar = true;
            var url = "{{url('master/acc-master/save-msg')}}";
            setTimeout(function(){ window.location = url+'/'+responseVar; });
          }

      },

    });

  }
</script>

@endsection