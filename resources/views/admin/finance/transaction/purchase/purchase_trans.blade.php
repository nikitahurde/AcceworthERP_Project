@extends('admin.main')

@section('AdminMainContent')

@include('admin.include.header')

<meta name="csrf-token" content="{{ csrf_token() }}">

@include('admin.include.navbar')

@include('admin.include.sidebar')

<style type="text/css">

  .Custom-Box {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .box-header>.box-tools {

    position: absolute !important;

    right: 10px !important;

    top: 2px !important;

  }

  .required-field::before {

    content: "*";

    color: red;

  }

  .showAccName{

    border: none;

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

  }

  .defualtSearchNew{

    display: none;

  }

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }
  .alignLeftClass{
    text-align: left;
  }
  .alignRightClass{
    text-align: right;
  }
  .alignCenterClass{
    text-align: center;
  }
  .showmsg{
    display: none;
  }
  .boxer {
    display: table;
    border-collapse: collapse;

  }

  .boxer .box-row {
    display: table-row;

  }

  .boxer .box-row:first-child {
    font-weight:bold;
  }

  .boxer .box10 {
    display: table-cell;
    vertical-align: top;
    border: 1px solid #ddd;
    padding: 5px;
  }

  .boxer .boxNF {
    display: table-cell;
    vertical-align: top;
    border-bottom: 1px solid #80808054;
    padding: 5px;
    color: #dd4b39;
    font-size: 16px;
    font-weight: 600;
  }

  .center {
    text-align:center;
  }

  .right {
    float:right;
  }
  .settaxcodemodel{
    font-size: 16px;
    font-weight: 800;
    color: #5d9abd;

  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .inputtaxInd{
    width: 94px !important;
  }
  .rateindx{
    width: 90px !important;
  }
  .rightcontent{
    width: 89px !important;
  }
  .srnonum{
    width: 49px !important;
  }
  .qualitychrc{
    width: 66px !important;
  }
  .actionBtn{
    font-size: 11px;
    font-weight: 600;
    width: 67px;
  }
  .dt-buttons{
    margin-bottom: -30px!important;
  }
  .dt-button{
   
    
    display: inline-block!important;
    font-weight: 600 !important;
    text-align: center!important;
    white-space: nowrap!important;
    vertical-align: middle!important;
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    user-select: none!important;
    border: 1px solid transparent!important;
    padding: .375rem .75rem!important;
    font-size: 15px!important;
    line-height: 1.5!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
  }

.dt-button:before {
  content: '\f02f';
  font-family: FontAwesome;
  padding-right: 5px;
  
}

.buttons-excel{

    color: #212529;
    background-color: #ffc107;
    border-color: #ffc107;
}
.buttons-excel:before {
  content: '\f1c9';
  font-family: FontAwesome;
  padding-right: 5px;
  
}
.hideColm{
  display: none;
}
.ratebk{
  width: 65px;
  text-align: right;
}
.checkstyling{
    height: 26px;
    width: 17px;
}
.texttotal{
  display: none;
}
.notecreateC{
  display: none;
}
.table_sim{
  display:table;         
  width:auto;                
  border:1px solid  #666666;         
 
}
.table-row_sim{
  display:table-row;
  width:auto;
  clear:both;
}
.table-row_sim_head{
  display:table-row;
  width:auto;
  clear:both;
  text-align: center;
  font-weight: 600;
}
.table-col_sim{
  float:left;
  display:table-column;         
  width:131px;         
  border:1px solid  #ccc;
  padding: 2px;
}
.table-col_sim_glacc{
  float:left;
  display:table-column;         
  width: 259px;      
  border:1px solid  #ccc;
  padding: 2px;
}
.table-col_sim_srno{
  float:left;
  display:table-column;         
  width:43px;         
  border:1px solid  #ccc;
  padding: 2px;
}
.showind_Ch{
    display: none;
  }
</style>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

    <h1> Purchase Bill Transaction
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

        <a href="{{ url('/Transaction/Purchase/Purchase-Bill-Transaction') }}"> Purchase Bill</a>

      </li>

    </ul>

  </section>

  <section class="content">

      <div class="box box-primary Custom-Box">

        <div class="box-header with-border" style="text-align: center;">

          <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">Purchase Bill Transaction</h2>

          <div class="box-tools pull-right">

            <a href="{{ url('/Transaction/Purchase/View-Purchase-Bill-Trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>

          </div>

        </div><!-- /.box-header -->

        <div class="box-body">

          <div class="overlay-spinner hideloader"></div>

          <form id="myForm">

            @csrf

              <div class="row">

                <div class="col-md-3">

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

                        <input type="text" class="form-control transdatepicker" name="vr" id="trans_date" value="{{ $vrDate }}" placeholder="Select Date" autocomplete="off">

                    </div>
                    <small id="showmsgfortransdate" style="color: red;"></small>
                    <small id="shwoErrdate" style="color: red;"></small>

                  </div>
                  <!-- /.form-group -->
                </div> <!-- ./col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> T Code : </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <input type="text" class="form-control" name="tran" value="{{ $trans_head }}" id="transcode" placeholder="Enter Transaction Head" readonly autocomplete="off">

                      <input type="hidden" id="transtaxCode" >

                      <input type="hidden" name="cr_t_head" id="transCode_cr" value="{{$trans_head_auto_N}}">

                      <input type="hidden" name="seriesOf_autoNot" id="seriesOf_autoNot" value="{{$seriesTcode_auto_N}}">

                      <input type="hidden" name="glof_autoNot" id="glof_autoNot" value="<?php if(isset($glof_autoNot)){echo $glof_autoNot;} ?>">

                    </div>
                    <small id="shwoErrtCode"></small>

                  </div>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Series Code: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <?php $secount = count($series_list); ?>
                      <input list="seriesList1"  id="seriesByTc" name="series" class="form-control  pull-left" value="<?php if($secount == 1){echo $series_list[0]->SERIES_CODE;} ?>" placeholder="Select Series" oninput="this.value = this.value.toUpperCase()" autocomplete="off" onchange="getvrnoBySeries()">

                        <datalist id="seriesList1">

                          <option selected="selected" value="">-- Select --</option>

                            @foreach ($series_list as $key)

                              <option value='<?php echo $key->SERIES_CODE?>'   data-xyz ="<?php echo $key->SERIES_NAME; ?>" ><?php echo $key->SERIES_NAME ; echo " [".$key->SERIES_CODE."]" ; ?></option>

                            @endforeach

                        </datalist>

                    </div>
                    <input type="hidden" id="seriesGlC" name="seriesGl" value="">
                    <input type="hidden" id="seriesGlName" name="seriesGlName" value="">
                    <small id="serscode_err" style="color: red;" class="form-text text-muted"></small>

                    <small id="series_code_errr" style="color: red;"></small>

                  </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                    <label>Series Name: 

                      <span class="required-field"></span>

                    </label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <input   id="seriesText" name="seriesText" class="form-control  pull-left" value="<?php if($secount == 1){echo $series_list[0]->SERIES_NAME;} ?>" placeholder="Select Series" readonly autocomplete="off">

                    </div>

                  </div>
                      <!-- /.form-group -->
                </div>
                <!-- /.col -->
                
              </div><!-- ./row -->

              <div class="row">
                
                <div class="col-md-2">

                  <div class="form-group">

                    <label> Vr No: </label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                      <input type="hidden" name="" value="<?php if(isset($to_num)){echo $to_num;} ?>" id="vr_last_num">

                      <input type="hidden" name="" value="<?php if(isset($to_num_auto_N)){echo $to_num_auto_N;} ?>" id="vr_last_num_cr">
                      <input type="text" class="form-control" name="vro" value="" placeholder="Enter Vr No" id="vrseqnum" readonly autocomplete="off">
                       <input type="hidden" class="form-control" name="vrno_cr" value="<?php if($last_num_auto_N == '1'){echo $last_num_auto_N; }else{echo $last_num_auto_N+1;} ?>" placeholder="Enter Vr No" id="vrseqnum_cr" readonly autocomplete="off">


                    </div>
                    <small id="shwoErrVrNo"></small>

                  </div>
                  <!-- /.form-group -->
                </div> <!-- ./col -->

                <div class="col-md-3">

                  <div class="form-group">
                    
                    <label>Acc Code : <span class="required-field"></span></label>

                    <div class="input-group">

                      <div class="input-group-addon">

                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                      </div>

                      <?php $account = count($getacc); ?>

                        

                      <input list="AccountList"  id="account_code" name="AccCode" class="form-control  pull-left" <?php if($Acc_Code) { ?> value="<?= $Acc_Code ?>" readonly <?php } else { ?> value="<?php if($account == 1){echo $getacc[0]->ACC_CODE;} ?>" <?php } ?> placeholder="Select Account" oninput="this.value = this.value.toUpperCase()" autocomplete="off" >

                      <datalist id="AccountList">

                        <option selected="selected" value="">-- Select --</option>

                        @foreach ($getacc as $key)

                          <option value='<?php echo $key->ACC_CODE?>'   data-xyz ="<?php echo $key->ACC_NAME; ?>" ><?php echo $key->ACC_NAME ; echo " [".$key->ACC_CODE."]" ; ?></option>

                        @endforeach

                      </datalist>

                    </div>
                    <input type="hidden" value="{{$account}}" id="acccount" >
                    <input type="hidden" value="" id="acc_Gl" >
                    <input type="hidden" value="" id="acc_GLName" >
                    <small id="acccode_err" style="color: red;" class="form-text text-muted"> </small>
                    <small id="shwoErrAccCode" style="color: red;"></small>

                  </div>
                <!-- /.form-group -->
                </div>
                <!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Acc Name : <span class="required-field"></span></label>

                    <div class="input-group tooltips">

                      <input  id="AccountText" name="AccountText" class="form-control  pull-left" <?php if($Acc_Code) { ?> value="<?= $getacc[0]->ACC_NAME ?>" <?php } else { ?> value="<?php if($account == 1){echo $getacc[0]->ACC_NAME;} ?>" <?php } ?> placeholder="Select Account" readonly autocomplete="off">

                      <span class="tooltiptext tooltiphide" id="accountNameTooltip" style="margin-left: -129px;"></span>

                    </div>

                  </div>
                <!-- /.form-group -->
                </div> <!-- ./col -->

                <div class="col-md-4">

                  <div class="form-group">

                    <label>GRN No : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-building-o"></i></span>

                      <?php if($vrno){ ?>

                          <input  type="text" id="grnrvrno1" name="" class="form-control  pull-left" value="<?php if($vrno){ echo $startYr.' '.$seriesCd.' '.$vrno; }else{} ?>" placeholder="Enter GRN No" autocomplete="off" <?php if($vrno){echo 'disabled'; }?>>
                      <?php }else{ ?>

                        <input  list="grnnoList" id="grnrvrno" name="" class="form-control  pull-left" value="" placeholder="Enter GRN No" autocomplete="off" <?php if($vrno){echo 'disabled'; }?>>

                        <datalist id="grnnoList">
                          
                        </datalist>

                      <?php } ?>

                    </div>
                    <small id="grnNotFound" style="color: red;"> </small>
                    <small id="grnvnoerr" style="color: red;"> </small>
                    <input type="hidden" id="pfctCodegrn" name="pfctCodegrn">
                    <input type="hidden" id="seriesCodegrn" name="seriesCodegrn">
                    <input type="hidden" id="plantCodegrn" name="plantCodegrn">
                    <input type="hidden" id="cpCodeGrn" name="cpCodeGrn">
                    <input type="hidden" id="pfctNamegrn" name="pfctNamegrn">
                    <input type="hidden" id="plantNamegrn" name="plantNamegrn">
                    <input type="hidden" id="costcenterGrn" name="costcenterGrn">
                    <input type="hidden" id="costcenterNameGrn" name="costcenterNameGrn">

                  </div>

                </div> <!-- ./col -->

              </div><!-- /.row -->

              <div class="row">
              
                

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Party Bill No: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="text" class="form-control" name="vr" id="partyBilNo" value="" placeholder="Enter Party Bill No" autocomplete="off">

                    </div>  
                    <small id="shwoErrPartyBilNo" style="color: red;"></small>
                  </div>
                  <!-- /.form-group -->
                </div> <!-- ./col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Party Bill Date: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <?php  
                            $FromDate= date("d-m-Y", strtotime($fromDate));  
                            $ToDate= date("d-m-Y", strtotime($toDate));  
                            $CurrentDate =date("d-m-Y");
                        ?>

                        <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">

                        <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">

                        <input type="text" class="form-control transdatepicker" name="vr" id="partyBilldate" value="{{ $CurrentDate }}" placeholder="Select Date" autocomplete="off">

                    </div>

                    <small id="showmsgfordate" style="color: red;"></small>
                    <small id="shwoErrPartyBildate" style="color: red;"></small>

                  </div>
                  <!-- /.form-group -->
                </div> <!-- ./col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label>Party Bill Amount: <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type="text" class="form-control" name="partyBilAmt" id="partyBilAmt" value="" placeholder="Enter Party Bill Amount" autocomplete="off">
                        <input type="hidden" name="diffcrdr" id="diffcrdr">
                        <input type="hidden" name="totalBasic" id="totalBasic">

                        <input type="hidden" name="netAmount" id="netAmount">
                    </div>
                    <small id="shwoErrPartyBilAmt" style="color: red;"></small>

                  </div>
                  <!-- /.form-group -->
                </div> <!-- ./col -->

              </div><!-- ./row --> 

              <div class="row">

                <div class="col-md-4"></div>
                <div class="col-md-4">

                  <div class="">

                   <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                    <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

                  </div>

                </div> <!--  ./col -->
                <div class="col-md-4"></div>
                
              </div> <!-- /. row -->

              <div class="row">
                <p id="checkBoxSelectMsg" style="text-align: center;color:red;padding-top: 10px;"></p>
              </div>

          </form>

        </div><!-- /.box-body -->


        <div class="box-body">

          <table id="PurchaseBillManage" class="table table-bordered table-striped table-hover billgenerate">

            <thead class="theadC">

              <tr>

                <th class="text-center" width="5%" style="text-align: left;"><input class='check_all checkstyling'  type='checkbox' id="all_checkbox" /> </th>
                <th class="text-center" width="5%">Vr. No. </th>
                <th class="text-center" width="10%">Vr. Date </th>
                <th class="text-center" width="5%">Trans code </th>
                <th class="text-center" width="10%">Series </th>
                <th class="text-center" width="10%">Plant Code </th>
                <th class="text-center" width="10%">Item Name </th>
                <th class="text-center" width="10%">Qty </th>
                <th class="text-center" width="10%">AQty </th>
                <th class="text-center ratebk">Rate </th>
                <th class="text-center" width="10%">Basic </th>
                <th class="text-center" width="5%">Action </th>
                <th class="text-center hideColm">grandAmt </th>
              </tr>

            </thead>

            <tbody id="defualtSearch">

            </tbody>
            <tfoot align="right">
              <tr>
                <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th class="hideColm"></th>
              </tr>
            </tfoot>


          </table>


           <div style="text-align: center;">

            <input type="hidden" id="taxaplyYorN" value="NO" name="taxaplyYorN">
            <input type="hidden" id="taxCodeU" value="">
            <button class="btn btn-primary " type="button" id="simulationbtn" disabled><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp;&nbsp; Simulation</button> 

            <button type="submit" name="submit" value="submit" id="submitinpurchasebill" class='btn btn-success' disabled style="width: 16%;" onclick="submitAllData(0)">&nbsp;Submit&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button> 

            <button class="btn btn-success" type="button" onclick="submitAllData(1)" id="submitNDown" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save & Download</button>

            <input type="hidden" id="donwloadStatus" name="donwloadStatus" value="">

          </div>

          

        </div><!-- /.box-body -->


      </div><!-- ./custom box -->

      

  </section> <!-- /.section -->

  <!--show modal when Amount is not equal  -->

    <div id="amntIsNotEqual" class="modal fade" tabindex="-1">
      <div class="modal-dialog modal-sm" style="margin-top: 13%;">
        <div class="modal-content" style="border-radius: 5px;">
          <div class="modal-header">
              <h5 class="modal-title" style="color: red;font-weight: 800;">Alert !!</h5>
          </div>
          <div class="modal-body">
            <p>Total Is Not Equal To Party Bill Amount </p>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
          </div>
        </div>
      </div>
    </div>

  <!-- show modal when Amount is not equal -->

</div> <!-- /. content wrapper -->
@include('admin.include.footer')


<div class="modal fade" id="tax_calc_onDiff_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document" style="margin-top: 5%;">

    <div class="modal-content" style="border-radius: 5px;">

      <div class="modal-header">

        <div class="row">

          <div class="col-md-5">

            <div class="form-group">

                <lable class="settaxcodemodel col-md-4" style="padding: 0px;">Tax Code - </lable>

                         

                <input type="text" class="settaxcodemodel col-md-7" id="tax_difcode1" style="border: none; padding: 0px;" readonly>

            </div>

          </div>

          <div class="col-md-6">

            <h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation</h5>

          </div>

          <div class="col-md-1"></div>

        </div>

      </div>

      <div class="modal-body table-responsive">

          <div class="modalspinner hideloaderOnModl"></div>

          <div class="boxer" id="tax_rateOnDif_1">

            <!-- End of 'box-row' -->
            <!-- Start of 'box-row' -->
            <!-- End of 'box-row' -->     

          </div>

      </div>

      <div class="modal-footer">

        <center>
        <span  id="footer_ok_btnondif1"></span>
        <span  id="footer_tax_btnondif1" style="width: 10px;"></span>
       </center>

      </div>

    </div>

  </div>

</div>


<!-- when tax not applied then show model -->

  <div id="taxNotAppied" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-sm" style="margin-top: 13%;">
        <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header" style="text-align: center;">
                <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
                
            </div>
            <div class="modal-body">
              <p id="taxnotApMsg"></p>
               <div id="notecreatemsg" class="notecreateC" style="text-align: center;">
                  <label class="radio-inline">
                    <input type="radio" name="notecrdr" checked value="NO" id="noset" class="noteset">NO
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="notecrdr" value="YES" id="yesset" class="noteset">YES
                  </label>
               </div>
               <p id="diffNotEqual"></p>
            </div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancel</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="whenproceed()" id="proceedBtn">Proceed</button>
            </div>
        </div>
    </div>
  </div>
<!-- when tax not applied then show model -->



<style type="text/css">
  ol.collection {
    margin: 0px;
    padding: 0px;
}

li {
    list-style: none;
}

.setCrDrRight{
      text-align: end;
}
.hideshow_li{
  display: none !important;
}


/* 2 Column Card Layout */
@media screen and (max-width: 736px) {
    .collection-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 20px;
    }

    .item {
        border: 1px solid gray;
        border-radius: 2px;
        padding: 10px;
    }

    /* Don't display the first item, since it is used to display the header for tabular layouts*/
    .collection-container>li:first-child {
        display: none;
    }

    .attribute::before {
        content: attr(data-name);
    }

    /* Attribute name for first column, and attribute value for second column. */
    .attribute {
        display: grid;
        grid-template-columns: minmax(9em, 30%) 1fr;
    }
}

/* 1 Column Card Layout */
@media screen and (max-width:580px) {
    .collection-container {
        display: grid;
        grid-template-columns: 1fr;
    }
}

/* Tabular Layout */
@media screen and (min-width: 737px) {
    /* The maximum column width, that can wrap */
    .item-container {
        display: grid;
      /*  grid-template-columns: 1fr 2fr 5fr 5fr 2fr 2fr 2fr 3fr;*/
        grid-template-columns: 1fr 5fr 4fr 4fr;
    }
    .item-containerPay {
        display: grid;
        grid-template-columns: 1fr 2fr 1fr 1fr 2fr 2fr;
    }
    .attribute-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(var(--column-width-min), 1fr));
    }

    /* Definition of wrapping column width for attribute groups. */
    .part-information {
        --column-width-min: 3em;
    }

    .part-id {
        --column-width-min: 3em;
    }

    .vendor-information {
        --column-width-min: 8em;
    }

    .quantity {
        --column-width-min: 5em;
    }

    .cost {
        --column-width-min: 12em;
    }

    .duty {
        --column-width-min: 5em;
    }

    .freight {
        --column-width-min: 5em;
    }

    .collection {
        border-top: 1px solid gray;
    }
    .input-border{
      border: none;
      text-align: right;
    }

    /* In order to maximize row lines, only display one line for a cell */
    .attribute {
        border-right: 1px solid gray;
        border-bottom: 1px solid gray;
        padding: 2px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;

    }

    .collection-container>.item-container:first-child {
        background-color: blanchedalmond;
    }
    .collection-container>.item-containerPay:first-child {
        background-color: blanchedalmond;
    }

    .item-container:hover {
        background-color: rgb(200, 227, 252);
    }

    /* Center header labels */
    .collection-container>.item-container:first-child .attribute {
        display: flex;
        align-items: center;
        justify-content: center;
        text-overflow: initial;
        overflow: auto;
        white-space: normal;
    }
    .collection-container>.item-containerPay:first-child .attribute {
        display: flex;
        align-items: center;
        justify-content: center;
        text-overflow: initial;
        overflow: auto;
        white-space: normal;
    }
    
}
</style>

<div class="modal fade in" id="showallDataM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">

        <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;">

          <div class="modal-content" style="border-radius: 5px;">

            <div class="modal-header">
              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                  <h5 class="modal-title modltitletext" id="exampleModalLabel">Simulation Of Purchase Bill</h5>
                </div>
                <div class="col-md-2"></div>
              </div>
            </div>

            <div class="modal-body table-responsive">
              <div class="boxer" id="sim_body_data" style="font-size: 12px;color: #000;width:100%;">
              </div>
            </div>

            <div class="modal-footer">
                <span id="siml_footer1" style="width: 10px;"><button type="button" class="btn btn-primary " style="width: 10%;" data-dismiss="modal">Ok</button></span>
            </div>

          </div>

        </div>

      </div>

<div id="glNotFound" class="modal fade" tabindex="-1">
  <div class="modal-dialog modal-sm" style="margin-top: 13%;">
      <div class="modal-content" style="border-radius: 5px;">
          <div class="modal-header" style="text-align: center;">
            <h5 class="modal-title" style="color: #dd4b39;font-weight: 800;font-size: 18px;"><i class="fa fa-exclamation-triangle" aria-hidden="true" style="font-size: 25px;"></i>   Alert </h5>
            
          </div>
          <div class="modal-body">
            <p id='tranGl'></p>
            <p id='autoTrnasGl'></p>
            <p id='accCodeGl'></p>
          </div>
          <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-primary" data-dismiss="modal" style="width: 90px;">Ok</button>
          </div>
      </div>
  </div>
</div>

 <script>

    $(function () {
      //Initialize Select2 Elements
      $(".select2").select2();
      //Datemask dd/mm/yyyy
      $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
      //Datemask2 mm/dd/yyyy
      $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
      //Money Euro
      $("[data-mask]").inputmask();

    });

 </script>

 <script type="text/javascript">

    function getvrnoBySeries(){

    var seriesCode = $('#seriesByTc').val();
    var transcode = $('#transcode').val();

    var xyz = $('#seriesList1 option').filter(function() {

      return this.value == seriesCode;

    }).data('xyz');

    var msg = xyz ?  xyz : 'No Match';

    if(msg=='No Match'){
      $('#seriesByTc').val('');
      $('#seriesText').val('');
      $('#seriesGlC').val(''); 
      $('#seriesGlName').val(''); 
      document.getElementById("series_code_errr").innerHTML = 'The Series code field is required.';
    }else{
      $('#seriesText').val(msg);
      document.getElementById("series_code_errr").innerHTML = '';
      //$('#vrseqnum').val(''); 
      $('#seriesGlC').val(''); 
      $('#seriesGlName').val(''); 
      $('#seriesByTc').css('border-color','#d2d6de');
      $('#account_code').css('border-color','#ff0000');
    }

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
                    $('#vrseqnum').val('');
                    $('#getVrNo').val('');
                  }else{
                    if(data1.vrno_series){
                      var getlastno = data1.vrno_series.LAST_NO;
                    }else{
                      var getlastno = '';
                    }

                    if(data1.vrnodata == ''){
                      $('#vrseqnum').val(getlastno);
                      $('#getVrNo').val(getlastno);
                    }else{
                      var lastNo = parseInt(getlastno) + parseInt(1);
                      $('#vrseqnum').val(lastNo);
                      $('#getVrNo').val(lastNo);
                    }

                    if(data1.data == ''){

                    }else{
                      $('#seriesGlC').val(data1.data[0].POST_CODE);
                      $('#seriesGlName').val(data1.data[0].GL_NAME);
                    }
                  }

              }

          }

    });

  }

   $(document).ready(function(){

    


    $("#all_checkbox").click(function(){
        if(this.checked){
            $('.pb_checkitm').each(function(){
                this.checked = true;
            });
            $('#submitinpurchasebill').prop('disabled',false);
            $('#submitNDown').prop('disabled',false);
            $('#simulationbtn').prop('disabled',false);
            $('#CalcTaxinDif1').prop('disabled',false);
            $('#settextfot').removeClass('texttotal');
        }else{
             $('.pb_checkitm').each(function(){
                this.checked = false;
              });
             $('#submitinpurchasebill').prop('disabled',true);
             $('#submitNDown').prop('disabled',true);
             $('#simulationbtn').prop('disabled',true);
             $('#CalcTaxinDif1').prop('disabled',true);
             $('#settextfot').addClass('texttotal');
        }

        var checkedCount = $("#PurchaseBillManage input:checked").length;

        var creditAmount = 0
      var grandAmt = 0
      var partyBAmt = $('#partyBilAmt').val();

      if(checkedCount > 0){

        $("#simulationbtn").prop('disabled',false);
        $("#submitinpurchasebill").prop('disabled',false);
        $("#submitNDown").prop('disabled',false);
        $("#CalcTaxinDif1").prop('disabled',false);
        $('#settextfot').removeClass('texttotal');
      }else{
        $("#simulationbtn").prop('disabled',true);
        $("#submitinpurchasebill").prop('disabled',true);
        $("#submitNDown").prop('disabled',true);
        $("#CalcTaxinDif1").prop('disabled',true);
        $('#settextfot').addClass('texttotal');
      }
      for (var i = 0; i < checkedCount; i++) {
         var ii= i+1;
        var amount = $("#PurchaseBillManage input:checked")[i].parentNode.parentNode.children[10].innerHTML;

        var gr_amount = $("#PurchaseBillManage input:checked")[i].parentNode.parentNode.children[12].innerHTML;

        if (amount != "") {
          creditAmount += parseFloat(amount);
        } else {
          creditAmount = 0;

        }
        if (gr_amount !="") {
          grandAmt += parseFloat(gr_amount);
        } else {
          grandAmt = 0;
        }
      }

      if(partyBAmt > grandAmt){

       var diffAmt =  parseFloat(partyBAmt) - parseFloat(grandAmt);
      }else if(grandAmt > partyBAmt){
        var diffAmt =  parseFloat(grandAmt) - parseFloat(partyBAmt);
      }else if(grandAmt == partyBAmt){
         var diffAmt =  parseFloat(grandAmt) - parseFloat(partyBAmt);
         $('#CalcTaxinDif1').prop('disabled',true);
      }
      $("#diffAmt").text(diffAmt.toFixed(2));
      $("#diffcrdr").val(diffAmt.toFixed(2));
      $("#basicTotalAmt").text(creditAmount.toFixed(2));
      $("#totalBasic").val(creditAmount.toFixed(2));
      $("#netAmt").text(grandAmt.toFixed(2));
      $("#netAmount").val(grandAmt.toFixed(2));

    });
   

  $('#simulationbtn').on('click',function(){

    $('#showallDataM').modal('show');

    var checkboxcount = $('input[type="checkbox"]:checked').length;
    
    var checkitm = [];
    var tax_indictorName  = [];
    var rate_indictorName = [];
    var afrate_Name       = [];
    var taxAmount         = [];
    var taxglName         = [];

      $('.pb_checkitm').each(function(){

        if($(this).is(":checked"))
          {
            
           var itmchk = $(this).val();

           checkitm.push(itmchk);
           
          }

      });

      $('input[name^="footer_tax_ind"]').each(function (){
                  
            tax_indictorName.push($(this).val());

      });



      $('input[name^="footer_rate_ind"]').each(function (){
            
            rate_indictorName.push($(this).val());

      });

      $('input[name^="footer_af_rate"]').each(function (){
            
            afrate_Name.push($(this).val());

      });

      $('input[name^="footer_amount"]').each(function (){
            
            taxAmount.push($(this).val());

      });

      $('input[name^="footer_taxGlCode"]').each(function (){
            
            taxglName.push($(this).val());

      });

      var seriesGl    = $('#seriesGlC').val();
      var taxaplyYorN = $('#taxaplyYorN').val();
      var createNote  = $('#createNote').val();
      var partyBilAmt = $('#partyBilAmt').val();
      var accCode     = $('#account_code').val();
      var netAmt      = $('#netAmount').val();
      var diff_CrDr   = $('#diffcrdr').val();
      var noteName   = $('#createNote').val();
      
    
      $.ajax({

              url:"{{ url('get-simulation-data-for-purchase-bill') }}",

              method : "POST",

              type: "JSON",

              data: {checkitm: checkitm,seriesGl:seriesGl,taxaplyYorN:taxaplyYorN,tax_indictorName:tax_indictorName,rate_indictorName:rate_indictorName,afrate_Name:afrate_Name,taxAmount:taxAmount,taxglName:taxglName,createNote:createNote,partyBilAmt:partyBilAmt,accCode:accCode,netAmt:netAmt,diffCrDr:diff_CrDr,noteName:noteName},

              success:function(data){

                  var data1 = JSON.parse(data);
                  console.log('data1',data1);
                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                        //console.log('data1.data',data1.data_sim);
                      
                        if(data1.data_sim==''){

                        }else{
                          var srno = 1;
                          $('#sim_body_data').empty();

                          var headData = "<div class='box-row' style='background-color: blanchedalmond;'><div class='box10 texIndbox'>Sr.No.</div><div class='box10 glCodeCl'>Gl/ Acc Code</div><div class='box10 rateIndbox'>Debit-DR</div><div class='box10 rateIndbox'>Credit-CR</div></div>";

                          $('#sim_body_data').append(headData);
                          
                          $.each(data1.data_sim, function(k, getData) {

                            if(getData.IND_ACC_CODE){
                              var accGl = getData.IND_ACC_CODE;
                              var accglName = getData.accName;
                            }else if(getData.IND_GL_CODE){
                              var accGl = getData.IND_GL_CODE;
                              var accglName = getData.glName;
                            }else{
                              var accGl = '--';
                              var accglName = '--';

                            }
                           
                            var bodyData = "<div class='box-row'><div class='box10 texIndbox'>"+srno+"</div><div class='box10 glCodeCl'>"+accGl+" ( "+accglName+" )</div><div class='box10 rateIndbox'>"+getData.DR_AMT+"</div><div class='box10 rateIndbox'>"+getData.CR_AMT+"</div></div>";
                            $('#sim_body_data').append(bodyData);

                          srno++;});   /* ./ each*/

                        }
                      
                    } // success close

              } //success function close

      }); //ajax close 

      

   });

  
  });

 </script>

 <script type="text/javascript">

    $(document).ready(function(){

        $("#account_code").bind('change', function () {  

          var accCode = $(this).val();


          var xyz = $('#AccountList option').filter(function() {

          return this.value == accCode;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
            $('#acc_Gl').val('');
            $('#AccountText').val('');
            $('#account_code').val('');
            $('#acc_GLName').val('');
            $("#grnnoList").empty();
            $('#grnrvrno').val('');
            $('#cpCodeGrn').val('');
            $('#pfctCodegrn').val('');
            $('#seriesCodegrn').val('');
            $('#plantCodegrn').val('');
            $('#pfctNamegrn').val('');
            $('#plantNamegrn').val('');
            $('#costcenterGrn').val('');
            $('#costcenterNameGrn').val('');
            $('#accountNameTooltip').addClass('tooltiphide');
          }else{
            $('#AccountText').val('');
            $('#acc_GLName').val('');
            $("#grnnoList").empty();
            $('#grnrvrno').val('');
            $('#cpCodeGrn').val('');
            $('#pfctCodegrn').val('');
            $('#seriesCodegrn').val('');
            $('#plantCodegrn').val('');
            $('#pfctNamegrn').val('');
            $('#plantNamegrn').val('');
            $('#costcenterGrn').val('');
            $('#costcenterNameGrn').val('');

            $('#account_code').css('border-color','#d2d6de');
            $('#grnrvrno').css('border-color','#ff0000');
            $('#acc_Gl').val('');
            $('#acc_GLName').val('');
            $('#AccountText').val(msg);

             $('#accountNameTooltip').removeClass('tooltiphide');

             $('#accountNameTooltip').html(msg);

            $.ajaxSetup({

              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

            $.ajax({

              url:"{{ url('get-grn-no-by-acc-in-purchase-bill') }}",

              method : "POST",

              type: "JSON",

              data: {accCode: accCode},

              success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                    if(data1.glFetch == null || data1.glFetch ==''){
                          $('#acc_Gl').val('');
                        }else{
                          if(data1.glFetch.GL_CODE == ''){
                            var glCode ='';
                            var glName ='';
                            $("#glNotFound").modal('show');
                             $('#accCodeGl').html('<i class="fa fa-caret-right" aria-hidden="true" style="font-size: 15px;"></i> &nbsp; No <b>Gl Code</b> Define For <small style="font-size: 13px;font-weight: bold;">'+accText+'</small>.');
                             $('#tranGl').html('');
                             $('#autoTrnasGl').html('');
                          }else{
                            var glCode =data1.glFetch.GL_CODE;
                            var glName =data1.glFetch.GL_NAME;
                          }
                          $('#acc_Gl').val(glCode);
                          $('#acc_GLName').val(glName);

                          
                        }

                   if(data1.data== ''){
                      $('#grnNotFound').html('GRN No. Not Found');
                      $('#grnrvrno').prop('readonly',true);
                    }else{
                     $("#grnnoList").empty();
                     $('#grnrvrno').val('');
                     $('#grnrvrno').prop('readonly',false);
                     $('#grnNotFound').html('');
                      $.each(data1.data, function(k, getData){

                        var startyear = getData.FY_CODE;
                        var getyear = startyear.split("-");

                        $("#grnnoList").append($('<option>',{

                          value:getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,

                          'data-xyz':getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
                          text:getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO

                        }));

                      }); 

                    }


                } /*if close*/

              }  /*success function close*/

            });  /*ajax close*/

          }

        });

        $("#grnrvrno").bind('change', function () {  

          var grnVrno = $(this).val();
          var xyz = $('#grnnoList option').filter(function() {

          return this.value == grnVrno;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';
         // console.log('msg',msg);

          if(msg == 'No Match'){

            $('#grnrvrno').val('');
            $('#pfctCodegrn').val('');
            $('#pfctNamegrn').val('');
            $('#seriesCodegrn').val('');
            $('#plantCodegrn').val('');
            $('#plantNamegrn').val('');
            $('#cpCodeGrn').val('');
            $('#costcenterGrn').val('');
            $('#costcenterNameGrn').val('');

          }else{

            $('#grnrvrno').css('border-color','#d2d6de');

            $.ajaxSetup({

              headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

            $.ajax({

              url:"{{ url('get-grndetail-by-grn-vrno') }}",

              method : "POST",

              type: "JSON",

              data: {grnVrno: grnVrno},

              success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                }else if(data1.response == 'success'){

                   if(data1.data== ''){
                      
                    }else{
                      $('#pfctCodegrn').val(data1.data[0].PFCT_CODE);
                      $('#pfctNamegrn').val(data1.data[0].PFCT_NAME);
                      $('#seriesCodegrn').val(data1.data[0].SERIES_CODE);
                      $('#plantCodegrn').val(data1.data[0].PLANT_CODE);
                      $('#plantNamegrn').val(data1.data[0].PLANT_NAME);
                      $('#cpCodeGrn').val(data1.data[0].CPCODE);
                      $('#costcenterGrn').val(data1.data[0].COST_CENTER);
                      $('#costcenterNameGrn').val(data1.data[0].COST_CENTER_NAME);
                    }


                } /*if close*/

              }  /*success function close*/

            });  /*ajax close*/

          }

        });

    });

</script>
<script type="text/javascript">
  $(document).ready(function(){
   $('.billgenerate').DataTable({
            "scrollX": true
        });


    

    });
</script>
<script type="text/javascript">

  $(document).ready(function(){

    var creditAmount = 0
    $('#PurchaseBillManage').DataTable();

    $("#PurchaseBillManage").on('change', function() {

      var checkedCount = $("#PurchaseBillManage input:checked").length;
     // alert(checkedCount);
      var creditAmount = 0
      var grandAmt = 0
      var partyBAmt = $('#partyBilAmt').val();

      if(checkedCount > 0){

        $("#simulationbtn").prop('disabled',false);
        $("#submitinpurchasebill").prop('disabled',false);
        $("#submitNDown").prop('disabled',false);
        $("#CalcTaxinDif1").prop('disabled',false);
        $('#settextfot').removeClass('texttotal');
      }else{
        $("#simulationbtn").prop('disabled',true);
        $("#submitinpurchasebill").prop('disabled',true);
        $("#submitNDown").prop('disabled',true);
        $("#CalcTaxinDif1").prop('disabled',true);
        $('#settextfot').addClass('texttotal');
      }
      for (var i = 0; i < checkedCount; i++) {
         var ii= i+1;
        var amount = $("#PurchaseBillManage input:checked")[i].parentNode.parentNode.children[10].innerHTML;

        var gr_amount = $("#PurchaseBillManage input:checked")[i].parentNode.parentNode.children[12].innerHTML;

        if (amount != "") {
          creditAmount += parseFloat(amount);
        } else {
          creditAmount = 0;

        }
        if (gr_amount !="") {
          grandAmt += parseFloat(gr_amount);
        } else {
          grandAmt = 0;
        }
      }

      if(partyBAmt > grandAmt){

       var diffAmt =  parseFloat(partyBAmt) - parseFloat(grandAmt);
      }else if(grandAmt > partyBAmt){
        var diffAmt =  parseFloat(grandAmt) - parseFloat(partyBAmt);
      }else if(grandAmt == partyBAmt){
        var diffAmt =  parseFloat(grandAmt) - parseFloat(partyBAmt);
        $('#CalcTaxinDif1').css('display','none');
        $('#notapplytax').html('');
      }
      $("#diffAmt").text(diffAmt.toFixed(2));
      $("#diffcrdr").val(diffAmt.toFixed(2));
      $("#basicTotalAmt").text(creditAmount.toFixed(2));
      $("#totalBasic").val(creditAmount.toFixed(2));
      $("#netAmt").text(grandAmt.toFixed(2));
      $("#netAmount").val(grandAmt.toFixed(2));

    });


    function load_data(account_code='',grnrvrno=''){

      var getcomName = '<?php echo Session::get('company_name'); ?>';
      var getFY      = '<?php echo Session::get('macc_year'); ?>';
      var getnewdate = new Date();
      var getday = getnewdate.getDate();
      var getMonth = getnewdate.getMonth()+1;
      var getYear = getnewdate.getFullYear();


      var gettime= "<?php date_default_timezone_set('Asia/Kolkata'); $daytime=date('h:i:s'); echo date("his", strtotime($daytime)); ?>";

      var getdate = getday+''+getMonth+''+getYear;
          
      $('#PurchaseBillManage').DataTable({

        footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;

                $( api.column( 9 ).footer() ).html('<div class="texttotal" id="settextfot">Total :- <br> Bill Amt :- <br> Diff :- </div>').css('text-align','right').css('line-height','1');

                $( api.column( 10 ).footer() ).html('<small id="basicTotalAmt"></small><br><small id="netAmt"></small><br><small id="diffAmt"></small>');
                

                var taxCod = [];
                $.each(data, function(k, getData) {
                  taxCod.push(getData.TAX_CODE);
                //  console.log('getData',getData.tax_code);
                });

                var uniqueChars = taxCod.filter((c, index) => {
                    return taxCod.indexOf(c) === index;
                });

                console.log('uniqueChars.length',uniqueChars.length);

                if(uniqueChars.length > 1){

                   $( api.column( 11 ).footer() ).html('<br><div id=""><small class="label label-danger"><i class="fa fa-times"></i>&nbsp; Not Found</small></div>');

               //  console.log('greater');
                }else{

                   $('#taxCodeU').val(uniqueChars[0]);
                   $( api.column( 11 ).footer() ).html('<br><button class="btn btn-primary btn-xs actionBtn" id="CalcTaxinDif1" data-toggle="modal" data-target="#tax_calc_onDiff_model1" onclick="CalculateTaxOnDif(1); getGrandTotal(1);" id="taxcalBtn" disabled>calc Tax</button><br><div id="notapplytax"><small class="label label-danger"><i class="fa fa-times"></i>&nbsp; Not Applied</small></div><div id="applytax"></div><input type="hidden" id="createNote" val="">');
                  // console.log('less',uniqueChars);
                }
          
        },  

          processing: true,
          serverSide: true,
          scrollX: true,
          columnDefs: [
             { orderable: false, targets:0 }
          ],
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
             
              buttons: [
                          {
                            extend: 'excelHtml5',
                            exportOptions: {
                                  columns: [1,2,3,4,5,6,7,8,9,10]
                            }
                          },
                          {
                            extend: 'pdfHtml5',
                            filename: 'PURCHASE_BILL_REPORT_'+getdate+'_'+gettime,
                            title: getcomName+'\n'+getFY+'\n'+' PURCHASE BILL REPORT',
                            exportOptions: {
                                  columns: [1,2,3,4,5,6,7,8,9,10]
                            }
                          },
                        ],
          ajax:{
            url:'{{ url("get-data-from-grn-fro-pur-bill") }}',
            data: {account_code:account_code,grnrvrno:grnrvrno},
            method:"POST",
          },
          columns: [

            {
                data:'DT_RowIndex',
                'render': function (data, type, full, meta){
                  //console.log('full',bodyid);
                  return '<input type="checkbox" name="flit_id[]" class="pb_checkitm checkstyling" value="'+full['GRNHID'] +'/'+full['GRNBID'] +'/'+full['ITEM_CODE'] +'/'+full['DT_RowIndex']+'/'+full['TAX_CODE']+'"><input type="hidden" name="grnheadid[]" id="grnheadid'+full['DT_RowIndex']+'" value="'+full['GRNHID'] + '"><input type="hidden" name="grnbodyid[]"  id="grnbodyid'+full['DT_RowIndex']+'" value="'+full['GRNBID'] + '"><input type="hidden" id="grnitmcode'+full['DT_RowIndex']+'" name="itmcode[]" class="" value="'+full['ITEM_CODE'] + '"><input type="hidden" id="grntaxcode'+full['DT_RowIndex']+'" name="taxcode[]" class="" value="'+full['TAX_CODE'] + '"><input type="hidden" id="grnbasicAmt'+full['DT_RowIndex']+'" name="grnbasicAmt[]" class="basicAmtC" value="'+full['BASICAMT'] + '"><input type="hidden" id="pfctcd'+full['DT_RowIndex']+'" name="pfctcd[]" class="" value="'+full['PFCT_CODE'] + '">';
                }
            },
            {
              data:'VRNO',
              name:'VRNO',
              className:'alignRightClass'
            },
            {
              data:'VRDATE',
              className:'alignRightClass',
                render: function (data) {
                  var date = new Date(data);
                  var month = date.getMonth() + 1;
                  if(data=='0000-00-00'){
                    return '00-00-0000';
                  }else{
                    
                  return date.getDate() + "-" + (month.toString().length > 1 ? month : "0" + month) + "-" +  date.getFullYear();
                  }
                }
            },
            {
              data:'TRAN_CODE',
              name:'TRAN_CODE'
            },
            {
              data:'SERIES_CODE',
              name:'SERIES_CODE'
            },
            {
              data:'PLANT_CODE',
              name:'PLANT_CODE'
            },  
            {  
            render: function (data, type, full, meta){

                   
                      var series = '<p>'+full['ITEM_NAME']+'</p>'+'<p style="line-height:2px;font-weight: 700;">('+full['ITEM_CODE']+')</p>';
                    

                      return series;


                         

                     }
        

            },
            {
                data:'QTYRECED',
                name:'QTYRECED',
                className:'alignRightClass'
            },
            {
                data:'AQTYRECD',
                name:'AQTYRECD',
                className:'alignRightClass'
            },
            {
                data:'RATE',
                name:'RATE',
                className:'ratebk'
            },
            {
                data:'BASICAMT',
                name:'BASICAMT',
                className:'alignRightClass'
            },
            {
                data:'',
                    'render': function (data, type, full, meta){
                    return '<input type="hidden" value="'+full['CRAMT']+'" id="grandAmt'+full['DT_RowIndex']+'"><button type="button" class="btn btn-primary btn-xs tdsratebtn actionBtn" id="CalcTax'+full['DT_RowIndex']+'" data-toggle="modal" data-target="#tds_rate_model'+full['DT_RowIndex']+'" onclick="CalculateTax('+full['DT_RowIndex']+'); ">Calc Tax </button><button type="button" class="btn btn-primary btn-xs tdsratebtn actionBtn" id="qualityParamter'+full['DT_RowIndex']+'" data-toggle="modal" data-target="#qp_model'+full['DT_RowIndex']+'" onclick="qty_parameter('+full['DT_RowIndex']+')">Qlt. Param. </button><div class="modal fade" id="tds_rate_model'+full['DT_RowIndex']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"> <div class="col-md-3"><input type="text" class="settaxcodemodel col-md-7" id="tax_code'+full['DT_RowIndex']+'" style="border: none; padding: 0px;" readonly></div><div class="col-md-6"><h5 class="modal-title modltitletext" id="exampleModalLabel">Tax / Charges / etc Calculation</h5></div><div class="col-md-3"></div></div></div><div class="modal-body table-responsive"><div class="boxer" id="tax_rate_'+full['DT_RowIndex']+'"></div></div><div class="modal-footer"><center><span  id="footer_ok_btn'+full['DT_RowIndex']+'"></span><span  id="footer_tax_btn'+full['DT_RowIndex']+'" style="width: 10px;"></span></center> </div></div></div></div><div class="modal fade" id="qp_model'+full['DT_RowIndex']+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;"><div class="modal-header"><div class="row"><div class="col-md-12"> <h5 class="modal-title modltitletext" id="exampleModalLabel">Qaulity Parameter</h5></div></div></div><div class="modal-body table-responsive"  style="text-align: -webkit-center;"><div class="boxer" id="qua_par_'+full['DT_RowIndex']+'"> </div></div><div class="modal-footer"><center><small style="text-align: center;" id="footerqp_ok_btn'+full['DT_RowIndex']+'"></small><small style="text-align: center;" id="footerqp_quality_btn'+full['DT_RowIndex']+'"></small></center> </div> </div></div></div>';
                }
            },
            {
                data:'CRAMT',
                name:'CRAMT',
                className:'hideColm'
            },
            

          ]


      });

    }



    $('#btnsearch').click(function(){
        
        var partyBilN    =  $('#partyBilNo').val();
        var partyBildate =  $('#partyBilldate').val();
        var partyBilAmt  =  $('#partyBilAmt').val();
        var trans_date   =  $('#trans_date').val();
        var account_code =  $('#account_code').val();
        var seriesC      =  $('#seriesByTc').val();
        var grnrvrno     =  $('#grnrvrno').val();
        var grnrbyvrno   =  $('#grnrvrno1').val();
        var seriesGlC    =  $('#seriesGlC').val();
        var acc_Gl       =  $('#acc_Gl').val();
        var glof_autoNot =  $('#glof_autoNot').val();
        var accText      =  $('#AccountText').val();

        if(seriesGlC){
          var series_gl =seriesGlC;
          var transGl = '';
        }else{
          var series_gl ='';
          var transGl = '<i class="fa fa-caret-right" aria-hidden="true" style="font-size: 15px;"></i> &nbsp; No <b>Post Code</b> Define For <b> Purchase Bill </b>.';
        }

        if(acc_Gl){
          var account_gl =acc_Gl;
          var acccd ='';
        }else{
          var account_gl ='';
          var acccd = '<i class="fa fa-caret-right" aria-hidden="true" style="font-size: 15px;"></i> &nbsp; No <b>Gl Code</b> Define For <small style="font-size: 13px;font-weight: bold;">'+accText+'</small>.';
        }

        if(glof_autoNot){
          var gl_AutoN =glof_autoNot;
          var glAuto_NF ='';
        }else{
          var gl_AutoN ='';
          var glAuto_NF = '<i class="fa fa-caret-right" aria-hidden="true" style="font-size: 15px;"></i> &nbsp; No <b>Post Code</b> Define For <b> AutoGenerated Note </b>.';
        }

        if(grnrbyvrno){
          var grnr_vrno=grnrbyvrno;
          var getgrnNo     = grnr_vrno.split(' ');
          var grnrvrno     = getgrnNo[2];
        }else if(grnrvrno){
          var grnr_vrno=grnrvrno;
          var getgrnNo     = grnr_vrno.split(' ');
          var grnrvrno     = getgrnNo[2];
        }else{
          var grnr_vrno='';
        }
      

        if(seriesC!=''){
            if(account_code !=''){
              if(grnr_vrno !=''){
                if(partyBilN !=''){
                  if(partyBildate !=''){
                    if(partyBilAmt !=''){
                      if(series_gl=='' || account_gl=='' || glof_autoNot=='' || (series_gl=='' && account_gl=='' && glof_autoNot=='')){
                           $("#glNotFound").modal('show');
                           $('#tranGl').html(transGl);
                           $('#accCodeGl').html(acccd);
                           $('#autoTrnasGl').html(glAuto_NF);

                      }else{
                        $('#PurchaseBillManage').DataTable().destroy();
                        load_data(account_code,grnrvrno);
                        $('#grnvnoerr').html('');
                        $('#shwoErrAccCode').html('');
                        $('#shwoErrdate').html('');
                        $('#shwoErrPartyBilAmt').html('');
                        $('#shwoErrPartyBildate').html('');
                        $('#shwoErrPartyBilNo').html('');
                        $('#seriesByTc,#trans_date,#account_code,#grnrvrno,#partyBilNo,#partyBilAmt,#partyBilldate').prop('disabled',true);
                      }
                        
                    }else{
                      $('#shwoErrPartyBilAmt').html('Party Bill Amount Field Is Required');
                    }
                  }else{
                    $('#shwoErrPartyBildate').html('Party Bill Date Field Is Required');
                  }
                }else{
                  $('#shwoErrPartyBilNo').html('Party Bill No Field Is Required');
                }
              }else{
                 $('#grnvnoerr').html('GRN No Field Is Required');
              }
            }else{
              $('#shwoErrAccCode').html('Account Code Field Is Required');
            }
        }else{
          $('#serscode_err').html('Series Code Field Is Required');
        }

      
        
    });

    $('#ResetId').click(function(){
              
        //location.reload();

        var grnurl = "{{ url('Transaction/Purchase/Purchase-Bill-Trans') }}";

         window.location = grnurl;

    });


  });


</script>

<script type="text/javascript">
  
  function CalculateTax(taxid){

    $.ajaxSetup({
        headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
    });

      var basicAmt = $('#basic'+taxid).val();

      $('#FirstBlckAmnt_'+taxid+'_1').val(basicAmt);


      var grnHeadId  = $('#grnheadid'+taxid).val();
      var grnBodyId  = $('#grnbodyid'+taxid).val();
      var itemCode = $('#grnitmcode'+taxid).val();
      var tax_code = $('#grntaxcode'+taxid).val();

      $.ajax({

              url:"{{ url('get-a-field-calc-for-purchase-bill') }}",

              method : "POST",

              type: "JSON",

              data: {grnHeadId: grnHeadId,grnBodyId:grnBodyId,itemCode:itemCode,tax_code:tax_code},

              success:function(data){
                  //console.log(data);
                  var data1 = JSON.parse(data);
                   //console.log('Get Data => ',data1);
                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      $("#CalcTax1").prop('disabled',false);

                    //console.log('data1.data',data1.data);
                      
                        if(data1.data==''){

                        }else{

                        var basicheadval = parseFloat($('#basic'+taxid).val());

                          var counter = 1;

                          var countI ='';

                          var dataI ='';

                          $('#tax_rate_'+taxid).empty();

                          var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div><div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div></div>";

                          $('#tax_rate_'+taxid).append(TableHeadData);

                          $.each(data1.data, function(k, getData) {

                            var datacount = data1.data.length;

                            dataI = datacount;

                            $('#data_count'+taxid).val(datacount);

                             $('#tax_code'+taxid).val(getData.TAX_CODE);

                           var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='tax_ind_"+taxid+"_"+counter+"' name='head_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly></div><div class='box10 rateIndbox'> <input type='text' class='form-control rateindx' name='rate_ind[]' value='"+getData.RATE_INDEX+"' id='indicator_"+taxid+"_"+counter+"' readonly> </div><div class='box10 rateBox'><input type='text' style='width: 100%;' id='rate_"+taxid+"_"+counter+"' name='af_rate[]' value='"+getData.TAX_RATE+"' class='form-control' readonly></div><div class='box10 amountBox'><input type='text' style='width: 100%;' class='form-control' name='amount[]' id='FirstBlckAmnt_"+taxid+"_"+counter+"' value='"+getData.TAX_AMT+"' readonly><input type='hidden' name='logic_"+counter+"' id='logic_id_"+taxid+"_"+counter+"' value='"+getData.TAX_LOGIC+"'><input type='hidden' name='static_"+counter+"' id='static_id_"+taxid+"_"+counter+"' value='"+getData.STATIC_IND+"'></div></div> ";

                            $('#tax_rate_'+taxid).append(TableData);

                            var IndexSelct = getData.RATE_INDEX;

                             objcity = data1.data_rate;

                                $.each(objcity, function (i, objcity) {

                                  var rateSel = '';

                                  if(IndexSelct == objcity.RATE_VALUE){

                                    $('#indicator_'+taxid+'_'+counter).append($('<option>',

                                    { 

                                      value: objcity.RATE_VALUE,

                                      text : objcity.RATE_VALUE+' = '+objcity.RATE_NAME,

                                      selected : true

                                    }));

                                  }else{
                                  
                                     $('#indicator_'+taxid+'_'+counter).append($('<option>',

                                      { 

                                        value: objcity.RATE_VALUE,

                                        text : objcity.RATE_VALUE+' = '+objcity.RATE_NAME,

                                        selected : false

                                      }));

                                  }

                              }); // .each loop

                             countI = counter;

                            counter++;

                          });  

                         // console.log('dataI',dataI);
                        //  console.log('countI',countI);
                      
                         var butn =  $('#footer_tax_btn'+taxid).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                          var tblData = "<button type='button' class='btn btn-primary ' style='width: 10%;' data-dismiss='modal' id='ApplyOkbtn"+taxid+"' >Ok</button>";

                            $('#footer_tax_btn'+taxid).append(tblData);

                           /* var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'  >Cancel</button>";
                             
                           $('#footer_ok_btn'+taxid).append(cancelfooter);*/

                         }else{

                         }

                        }

                    } // success close

              } //success function close

      }); //ajax close 

  } /*function close*/

  function qty_parameter(qty){

    var itemCode = $('#grnitmcode'+qty).val();
    var grn_HeadId = $("#grnheadid"+qty).val();
    var grn_BodyId = $("#grnbodyid"+qty).val();


      $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });

        $.ajax({

            type: 'POST',

            url: "{{ url('/get-qty-parameter-frm-purchase-grn-by-itm') }}",

            data: {itemCode:itemCode,grn_HeadId:grn_HeadId,grn_BodyId:grn_BodyId}, // here $(this) refers to the ajax object not form

            success: function (data) {


              var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      if(data1.data==''){
                          $('#qua_par_'+qty).empty();
                          var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div><div class='box10 amountBox'>VendorQcValue</div><div class='box10 amountBox'>ActualQcValue</div><div class='box10 amountBox'>ThirdPartyQcValue</div></div><div class='box-row'><div class='boxNF' style='border-left: 1px solid #b0b0b06e;'></div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF'>Not Found</div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF'></div><div class='boxNF' style='border-right: 1px solid #b0b0b06e;'></div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);
                        }else{

                          $('#qua_par_'+qty).empty();
                           //$('#footer_qaulity_btn'+qty).empty();
                           // $('#footer_ok_btn'+qty).empty();


                           var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox1'>Sr.no</div><div class='box10 rateIndbox'>Item Category</div><div class='box10 rateIndbox'>Quality Char</div><div class='box10 rateIndbox'>Description</div><div class='box10 rateBox'>From Value</div><div class='box10 amountBox'>To Value</div><div class='box10 amountBox'>VendorQcValue</div><div class='box10 amountBox'>ActualQcValue</div><div class='box10 amountBox'>ThirdPartyQcValue</div></div>";

                          $('#qua_par_'+qty).append(TableHeadData);

                        var sr_no=1;
                          $.each(data1.data, function(k, getData) {

                            if(data1.item_code){
                              var item_code = data1.item_code;
                            }else if(getData.ITEM_CODE){
                               var item_code = getData.ITEM_CODE;
                            }

                            var quaP_count = data1.data.length;
                            $('#quaP_count'+qty).val(quaP_count);
                          var TableBody ="<div class='box-row'><div class='box10 texIndbox1'><input type='text' id='sr_num_"+qty+"_"+sr_no+"' name='head_tax_ind[]' class='form-control srnonum' value="+sr_no+" readonly></div><div class='box10 rateIndbox'><input type='text' id='item_category_"+qty+"_"+sr_no+"' name='item_category[]' class='form-control inputtaxInd' value="+getData.ICATG_CODE+" readonly><input type='text' id='item_code_qua_"+qty+"_"+sr_no+"' name='item_code_que[]' class='form-control inputtaxInd' value="+item_code+" readonly></div><div class='box10 '><input type='text' id='iqua_char_"+qty+"_"+sr_no+"' name='iqua_char[]' class='form-control qualitychrc' value="+getData.IQUA_CHAR+" readonly></div><div class='box10 rateIndbox'><input type='text' id='iqua_decs_"+qty+"_"+sr_no+"' name='iqua_desc[]' class='form-control inputtaxInd' value="+getData.IQUA_DESC+" readonly></div><div class='box10 rateBox'><input type='text' id='fromvalue_"+qty+"_"+sr_no+"' name='char_fromvalue[]' class='form-control rightcontent' value="+getData.CHAR_FROMVALUE+" readonly></div><div class='box10 amountBox'><input type='text' id='tovalue_"+qty+"_"+sr_no+"' name='char_tovalue[]' class='form-control rightcontent' value="+getData.CHAR_TOVALUE+" readonly></div><div class='box10 amountBox'><input type='text' id='venQcVal_"+qty+"_"+sr_no+"' name='venQcVal[]' class='form-control rightcontent' value='' readonly></div><div class='box10 amountBox'><input type='text' id='actualQcVal_"+qty+"_"+sr_no+"' name='actualQcVal[]' class='form-control rightcontent' value='' readonly></div><div class='box10 amountBox'><input type='text' id='thirdPartyQcVal_"+qty+"_"+sr_no+"' name='thirdPartyQcVal[]' class='form-control rightcontent' value='' readonly></div></div>";

                          $('#qua_par_'+qty).append(TableBody);
                              
                             
                          sr_no++ });


                          var butn =  $('#footerqp_quality_btn'+qty).find(':button').html();

                         if(butn != 'Ok' || butn =='undefined'){

                         var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+qty+"'  style='width: 36px;'>Ok</button>";

                           $('#footerqp_quality_btn'+qty).append(tblData);

                           /*  var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'>Cancel</button>";
                             
                           $('#footerqp_ok_btn'+qty).append(cancelfooter)*/;

                         }else{
                          
                         }

                        }

                    }
           
            
            },

        });

  }  /* ./ quality Paramter*/

</script>

<script type="text/javascript">
  
  function CalculateTaxOnDif(taxdif){

    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

    });

      var tax_code  = $('#taxCodeU').val();
      var acc_gl  = $('#acc_Gl').val();
      var series_gl  = $('#seriesGlC').val();
      var basicAmt1 = $('#diffAmt').html();
      var taxdifdd = $('#tax_difcode'+taxdif).val();
      //$('#dfFirstBlckAmnt_'+taxdif+'_1').val(basicAmt1);
     // console.log($('#FirstBlckAmnt_'+taxdif+'_1').val(basicAmt));

    if(taxdifdd == ''){

    //  var tax_code = $('#taxByItem'+taxdif).val();

      $.ajax({

              url:"{{ url('get-a-field-calc-for-purchase-bill') }}",

              method : "POST",

              type: "JSON",

              data: {tax_code: tax_code},

              beforeSend: function() {
                console.log('start spinner');
                    $('.modalspinner').removeClass('hideloaderOnModl');
              },

              success:function(data){
              //console.log('Get Data => ',data);
                  //console.log(data);
                  var data1 = JSON.parse(data);
                   
                    if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){

                      //$("#CalcTax1").prop('disabled',false);
                        
                        if(data1.data==''){

                        }else{

                        //var basicheadval = basicAmt1;

                        var rateTotal =0;
                        var rateTotal_cut =0;
                        $.each(data1.data, function(k, getData) {

                          if(getData.RATE_INDEX == 'P' || getData.RATE_INDEX == 'Q'){
                              rateTotal += parseFloat(getData.TAX_RATE);
                          }else{}

                          if(getData.RATE_INDEX == 'N' || getData.RATE_INDEX == 'O'){
                              rateTotal_cut += parseFloat(getData.TAX_RATE);
                          }else{}

                          /*if(getData.rate_index == 'N' || getData.rate_index == 'O'){
                              rateTotal += - parseFloat(getData.tax_rate);
                          }*/
                        });

                        var getratePer = '1.'+rateTotal;
                        var basicheadval_P = parseFloat(basicAmt1)/parseFloat(getratePer);

                        if(rateTotal_cut < 10){
                            var rateVal ='0'+rateTotal_cut;
                        }else{
                            var rateVal = rateTotal_cut;
                        }
                        var getratePer_d = '1.'+rateVal;

                        var basicheadval = parseFloat(basicheadval_P)*parseFloat(getratePer_d);

                          var counter = 1;
                          
                          var countI ='';
                          var dataI ='';

                          $('#tax_rateOnDif_'+taxdif).empty();

                          //console.log('data1.data ->',data1.data);

                         var TableHeadData =  "<div class='box-row'><div class='box10 texIndbox'>Tax Indicator</div><div class='box10 rateIndbox'>Rate Indicator</div><div class='box10 rateBox'>Rate</div><div class='box10 amountBox'>Amount</div></div>";

                         $('#tax_rateOnDif_'+taxdif).append(TableHeadData);
                         var datacount1 = data1.data.length;
                         var num = 1; 
                          $.each(data1.data, function(k, getData) {
                           // console.log('datacount1',datacount1);
                            console.log('getData.TAX_RATE',getData.TAX_RATE);
                            var datacount = data1.data.length;
                            dataI = datacount;
                              
                            var getGrandAmt = parseInt(datacount) - parseInt(1);
                            var grandAmt = data1.data[getGrandAmt].TAXIND_NAME;

                            if ((getData.RATE_INDEX == null && getData.TAX_RATE == null) || getData.RATE_INDEX == null || getData.TAX_RATE == null) {

                             $('#tax_difcode'+taxdif).val(getData.TAX_CODE);
                             
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='dftax_ind_"+taxdif+"_"+counter+"' name='footer_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly>  </div><div class='box10 rateIndbox'><input type='text' id='dfindicator_"+taxdif+"_"+counter+"' name='footer_rate_ind[]' class='form-control' value='---' readonly></div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='dfrate_"+taxdif+"_"+counter+"' value='---' name='footer_af_rate[]' class='form-control' readonly='true'></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control' name='footer_amount[]' id='dfFirstBlckAmnt_"+taxdif+"_"+counter+"' value='"+basicheadval.toFixed(2)+"' readonly><input type='hidden' name='footer_logicget[]' id='dflogic_id_"+taxdif+"_"+counter+"' value='0'><input type='hidden' name='footer_staticget[]' id='dfstatic_id_"+taxdif+"_"+counter+"' value='0'><input type='hidden' name='footer_taxGlCode[]' id='dftax_gl_code_"+taxdif+"_"+counter+"' value='"+series_gl+"'></div></div>";



                            }else{
                               // console.log('data1.data[getGrandAmt]',data1.data[getGrandAmt]);

                             
                                if(num == datacount1){
                                  var classname = 'grandTotalGet';
                                }else{
                                  var classname = '';
                                }



                                //console.log('rate',javascript_array);
                               var TableData = "<div class='box-row'><div class='box10 texIndbox'><input type='text' id='dftax_ind_"+taxdif+"_"+counter+"' name='footer_tax_ind[]' class='form-control inputtaxInd' value="+getData.TAXIND_NAME+" readonly></div><div class='box10 rateIndbox'> <input type='text' class='form-control' name='footer_rate_ind[]' value='"+getData.RATE_INDEX+"' id='dfindicator_"+taxdif+"_"+counter+"' oninput='getGrandTotal("+taxdif+");' readonly> </div><div class='box10 rateBox'><input type='text' style='width: 75%;margin-left: 12%;' id='dfrate_"+taxdif+"_"+counter+"' name='footer_af_rate[]' value='"+getData.TAX_RATE+"' class='form-control' oninput='getGrandTotal("+taxdif+");' readonly='true'></div><div class='box10 amountBox'><input type='text' style='width: 72%;margin-left: 15%;' class='form-control "+classname+"' name='footer_amount[]' id='dfFirstBlckAmnt_"+taxdif+"_"+counter+"' value='' oninput='getGrandTotal("+taxdif+");' readonly><input type='hidden' name='footer_logicget[]' id='dflogic_id_"+taxdif+"_"+counter+"' value='"+getData.TAX_LOGIC+"'><input type='hidden' name='footer_staticget[]' id='dfstatic_id_"+taxdif+"_"+counter+"' value='"+getData.STATIC_IND+"'><input type='hidden' name='footer_taxGlCode[]' id='dftax_gl_code_"+taxdif+"_"+counter+"' value='"+getData.TAX_GL_CODE+"'></div></div> <div id='dfindicatorShow_"+taxdif+"_"+counter+"' class='modal fade' tabindex='-1'><div class='modal-dialog modal-sm' style='margin-top: 13%;width: 69%;'> <div class='modal-content' style='border-radius: 5px;'><div class='modal-header'> <h5 class='modal-title' style='color: #3c8dbc;font-weight: 800;text-align: center;font-size: 16px;'>Change Indicator</h5></div><div class='modal-body'><div class='row'><?php $c=1; foreach ($rate_list as $key) { ?><div class='col-md-6' style='text-align: justify;'><input type='radio' id='dfcInd_"+taxdif+"_"+counter+"_{{$c}}' name='chang_indval' value='<?php echo $key->RATE_VALUE ?>'>&nbsp;&nbsp;<?php echo $key->RATE_VALUE ?> - <?php echo $key->RATE_NAME ?> <br></div><?php $c++; } ?></div></div><div class='modal-footer' style='text-align:center;'><button type='button' class='btn btn-primary' onclick='setIndOnOk("+taxdif+","+counter+"); getGrandTotal("+taxdif+");'>Apply</button></div></div></div></div>";

                              

                            }


                            $('#tax_rateOnDif_'+taxdif).append(TableData);



                            var IndexSelct = getData.RATE_INDEX;
                           
                             objcity = data1.data_rate;
                         
                                $.each(objcity, function (i, objcity) {
                                  
                                  var rateSel = '';
                                  if(IndexSelct == objcity.RATE_VALUE){

                                    $('#dfindicator_'+taxdif+'_'+counter).append($('<option>',
                                    { 

                                      value: objcity.RATE_VALUE,

                                      text : objcity.RATE_VALUE+' = '+objcity.RATE_NAME,

                                      selected : true

                                    }));
                                
                                  }else{
                                   
                                     $('#dfindicator_'+taxdif+'_'+counter).append($('<option>',
                                      { 

                                        value: objcity.RATE_VALUE,

                                        text : objcity.RATE_VALUE+' = '+objcity.RATE_NAME,

                                        selected : false

                                      }));
                                      }

                                  }); // .each loop
                                num++;
                             countI = counter;

                            counter++;



                          });  

                         // console.log('dataI',dataI);
                        //  console.log('countI',countI);

                          


                         var butn =  $('#footer_tax_btnondif'+taxdif).find(':button').html();

                        //  console.log('if dataI',butn);
                         if(butn != 'Ok' || butn =='undefined'){

                          var tblData = "<button type='button' class='btn btn-primary ' data-dismiss='modal' id='ApplyOkbtn"+taxdif+"' onclick='OkGetGransVal("+taxdif+","+dataI+","+countI+",1);' style='width: 36px;'>Ok</button>";

                           $('#footer_tax_btnondif'+taxdif).append(tblData);
                          /*
                             var cancelfooter = "<button type='button' class='btn btn-danger' data-dismiss='modal'  onclick='OkGetGransVal("+taxdif+","+dataI+","+countI+",0);'>Cancel</button>";
                             
                           $('#footer_ok_btn'+taxdif).append(cancelfooter);*/

                         }else{
                         
                         }

                        //  console.log('butn',butn);
                         

                         
                        }
                     
                    } // success close

              }, //success function close

              complete: function() {
                 console.log('end spinner');
                   $('.modalspinner').addClass('hideloaderOnModl');
              },

      }); //ajax close 

    }else{

   // console.log('show');

    }

  } /*function close*/

  function ind_forChange(rowid,countid){

      $('#dfindicatorShow_'+rowid+'_'+countid).modal('show');

      var already_ind = $('#dfindicator_'+rowid+'_'+countid).val();

           

      console.log('already_ind',already_ind);

      for(var w=1;w<=9;w++){

        var setInd = $('#dfcInd_'+rowid+'_'+countid+'_'+w).val();

        if(setInd == 'N' || setInd == 'O' || setInd == 'P' || setInd=='Q' || setInd=='R' || already_ind == 'N'){
                if(setInd == 'L' || setInd == 'M' || setInd == 'Z'){
                  $('#dfcInd_'+rowid+'_'+countid+'_'+w).prop('disabled',true);
                }
                
        }else if(setInd == 'L' || setInd == 'M'){
            if(setInd == 'N' || setInd == 'O' || setInd == 'P' || setInd=='Q' || setInd=='R' || already_ind == 'N' || setInd == 'Z'){
              $('#dfcInd_'+rowid+'_'+countid+'_'+w).prop('disabled',true);
            }
        }

        if(setInd == already_ind){

              $('#dfcInd_'+rowid+'_'+countid+'_'+w).prop('checked',true);

         }

      }

  }

  function setIndOnOk(indid,indnmeid){

    var ind_value= $("input[type='radio'][name='chang_indval']:checked").val();

    //console.log('ind_value',ind_value);

    if(ind_value =='M'){
        $('#dfrate_'+indid+'_'+indnmeid).val(100).prop('disabled',true);
        $('#dflogic_id_'+indid+'_'+indnmeid).val('null');
        $('#dfFirstBlckAmnt_'+indid+'_'+indnmeid).val('');
     
    }else{
         $('#dfrate_'+indid+'_'+indnmeid).prop('disabled',false);
    } 

    
    $('#dfindicator_'+indid+'_'+indnmeid).val(ind_value);

    $('#dfindicatorShow_'+indid+'_'+indnmeid).modal('hide');

  }


 /* $('#partyBilAmt').on('input',function(){
      var enterPBA = $(this).val();
      $('#').val(enterPBA.toFixed());
      console.log('enterPBA',enterPBA);
  });*/

  function OkGetGransVal(aplyid,datacount,countercount,staticvalue){
    $('#createNote').html('');
    var partyBAmt =  parseFloat($('#partyBilAmt').val());
    var creditAmount =  $('#netAmt').html();

   // console.log('partyBAmt -> ',partyBAmt);
   // console.log('creditAmount -> ',creditAmount);

    if(partyBAmt > creditAmount){
     // $('#setdrcrNote').html('Creadit Note');
      var appliedbtn ='<small class="label label-success"><i class="fa fa-check"></i>&nbsp; Debit Note</small>';
      $('#notapplytax').html('');
      
      $('#applytax').html(appliedbtn);
      $('#createNote').val('Debit Note');

    }

    if(creditAmount > partyBAmt){

      var appliedbtn ='<small class="label label-success"><i class="fa fa-check"></i>&nbsp; Creadit Note</small>';
      $('#notapplytax').html('');
      $('#applytax').html(appliedbtn);
      $('#createNote').val('Creadit Note');
    }

    $('#submitdata').prop('disabled', false);
    $('#taxaplyYorN').val('YES');

  }


  function getGrandTotal(getid){

    setTimeout(function() {

      $('.modalspinner').addClass('hideloaderOnModl');

      totalAmount = 0;

      qunatity = $("#qty"+getid).val();

      for(l=2;l<=12;l++){

        rate = $("#dfrate_"+getid+"_"+l).val();   

        indicator = $("#dfindicator_"+getid+"_"+l).val();

        logic = $("#dflogic_id_"+getid+"_"+l).val();

        static = $("#dfstatic_id_"+getid+"_"+l).val();

        if(logic == null){

        }else{ 

          if(logic.length >0){

            indicatorCalculation(indicator,rate,logic,l,getid);

          }

        }

        if(indicator == 'L' || indicator == 'M'){
          $("#dfFirstBlckAmnt_"+getid+"_"+l).prop('readonly',false);
        }else{
          $("#dfFirstBlckAmnt_"+getid+"_"+l).prop('readonly',true);
        }

        //if(static == 0){

           // $("#dfindicator_"+getid+"_"+l).prop('readonly',true);

           // $("#dfrate_"+getid+"_"+l).prop('readonly',false);

           // $("#dfFirstBlckAmnt_"+getid+"_"+l).prop('readonly',false);

           // $("#changeInd_"+getid+"_"+l).removeClass('showind_Ch');

            
              // $("#dfindicator_"+getid+"_"+l).prop('readonly',true);

            // $("#dfrate_"+getid+"_"+l).prop('readonly',true);

            // $("#dfFirstBlckAmnt_"+getid+"_"+l).prop('readonly',false);

            // $("#changeInd_"+getid+"_"+l).addClass('showind_Ch');
            

       // }else{

            // $("#dfindicator_"+getid+"_"+l).prop('readonly',true);

            // $("#dfrate_"+getid+"_"+l).prop('readonly',true);

          //   $("#dfFirstBlckAmnt_"+getid+"_"+l).prop('readonly',true);

          //   $("#changeInd_"+getid+"_"+l).addClass('showind_Ch');

       // }

        if(indicator == 'R'){

            var amntF_R =  parseFloat(qunatity) * parseFloat(rate);

            $('#dfFirstBlckAmnt_'+getid+"_"+l).val(amntF_R);

        }else{}


      }

    }, 500);

    $('.modalspinner').removeClass('hideloaderOnModl');

      //$("#total_cramount").val(parseFloat(totalAmount));

    //$("#temp_cramount").val(Math.round(parseFloat(totalAmount))); 

  } /*function close*/

  function indicatorCalculation(indicator,rate,logic,l,incNum){

   console.log('indicator',indicator);
   console.log('rate',rate);
   console.log('logic',logic);
   console.log('l',l);
   console.log('incNum',incNum);

    var totalLogicVal = 0;

      if(logic.length >0){

        logicVal= "";

        for(j=1; j<=logic.length; j++)

        {

          k = logic.substring(j-1,j);

          var BlocValue = $("#dfFirstBlckAmnt_"+incNum+"_"+k).val();

          if(BlocValue!="")

            totalLogicVal = parseFloat(totalLogicVal) + parseFloat(BlocValue);

        }

      }



    //$("#FirstBlckAmnt_"+incNum+"_"+l).val(0);

    if(indicator == 'A'){
      roundofrate= ((parseFloat(totalLogicVal) * rate)/100);
      roundof= Math.round(roundofrate) - parseFloat(totalLogicVal);
         $("#dfFirstBlckAmnt_"+incNum+"_"+l).val(roundof.toFixed(2));
 
    }

    if(indicator=="N"){

        amtMinus= -((parseFloat(totalLogicVal) * rate)/100);    

        $("#dfFirstBlckAmnt_"+incNum+"_"+l).val(amtMinus.toFixed(2));

    }

    var inde_M_amt = parseFloat($("#dfFirstBlckAmnt_"+incNum+"_"+l).val());
   
    if(isNaN(inde_M_amt)){
      indm = '';
      $("#dfFirstBlckAmnt_"+incNum+"_"+l).val(indm);
    }else{

      if(indicator=="M"){
        var lumMinus; 

        lumMinus= parseFloat($("#dfFirstBlckAmnt_"+incNum+"_"+l).val()); 

        if(lumMinus > 0){
          var indicatorMAmt1=  -(lumMinus);
        }else if(lumMinus < 0){
          var indicatorMAmt1=  (lumMinus);
        }
        // indicatorMAmt=  -(parseFloat(indicatorMAmt) +  amtMinus);
        /// console.log('indicatorMAmt1',indicatorMAmt1);
         indicatorMAmt = indicatorMAmt1;
         $("#dfFirstBlckAmnt_"+incNum+"_"+l).val(indicatorMAmt);

      }
    }


    if(indicator=="P"){

        addition = ((parseFloat(totalLogicVal) * rate)/100);    

        $("#dfFirstBlckAmnt_"+incNum+"_"+l).val(addition.toFixed(2));

    }

    if(indicator=="Q"){

       additionRoundOff = ((parseFloat(totalLogicVal) * rate)/100);    

        $("#dfFirstBlckAmnt_"+incNum+"_"+l).val(Math.round(additionRoundOff.toFixed(2)));

    }

    if(indicator=="Z"){

        subtotalview = ((parseFloat(totalLogicVal) * rate)/100);    

        $("#dfFirstBlckAmnt_"+incNum+"_"+l).val(subtotalview.toFixed(2));

    }

    
    if(indicator=="O"){

        deductionRoundOff = -((parseFloat(totalLogicVal) * rate)/100);    

        $("#dfFirstBlckAmnt_"+incNum+"_"+l).val(Math.round(deductionRoundOff.toFixed(2)));

    }




  } /*function close*/

 

</script>


<script type="text/javascript">

$(document).ready(function() {

    $( window ).on( "load", function() {

      var seriesCode = $('#seriesByTc').val();
      var transcode  = $('#transcode').val();
      var accCode    = $('#account_code').val();
      var grnrvrno   = $('#grnrvrno').val();

      if(seriesCode){
        $('#seriesByTc').css('border-color','#d2d6de');
        if(accCode){
            $('#seriesByTc').css('border-color','#ff0000');
            $('#account_code').css('border-color','#d2d6de');
            if(grnrvrno){
                  $('#account_code').css('border-color','#d2d6de');
                 $('#seriesByTc').css('border-color','#ff0000');
                 $('#account_code').css('border-color','#ff0000');
            }else{
              $('#account_code').css('border-color','#ff0000');
            }
        }else{
          $('#account_code').css('border-color','#ff0000');
        }
      }else{
        $('#seriesByTc').css('border-color','#ff0000');
      }
    
      $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

      $.ajax({

              url:"{{ url('get-gl-by-series-for-purchase') }}",

               method : "POST",

               type: "JSON",

               data: {seriesCode: seriesCode,transcode:transcode},

               success:function(data){

                    var data1 = JSON.parse(data);
               
                    if (data1.response == 'error') {

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){
                        console.log('data1.data',data1.data);
                        if(data1.data == ''){
                          $('#seriesGlC').val('');
                          $('#seriesGlName').val('');
                        }else{
                           $('#seriesGlC').val(data1.data[0].POST_CODE);
                           $('#seriesGlName').val(data1.data[0].GL_NAME);
                        }

                    }
               }

          });

    });

    setTimeout(function() {

      var accCode = $('#account_code').val();

      $.ajax({

              url:"{{ url('get-grn-no-by-acc-in-purchase-bill') }}",

               method : "POST",

               type: "JSON",

               data: {accCode:accCode},

               success:function(data){

                    var data1 = JSON.parse(data);
               
                    if (data1.response == 'error') {

                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){
                        if(data1.glFetch == null || data1.glFetch ==''){
                          $('#acc_Gl').val('');
                        }else{
                          if(data1.glFetch.GL_CODE == ''){
                            var glCode ='';
                          }else{
                            var glCode =data1.glFetch.GL_CODE;
                          }
                          $('#acc_Gl').val(glCode);
                          
                        }

                        if(data1.data== ''){
                      $('#grnNotFound').html('GRN No. Not Found');
                      $('#grnrvrno').prop('readonly',true);
                    }else{
                     $("#grnnoList").empty();
                     $('#grnrvrno').val('');
                     $('#grnrvrno').prop('readonly',false);
                     $('#grnNotFound').html('');
                      $.each(data1.data, function(k, getData){

                        var startyear = getData.FY_CODE;
                        var getyear = startyear.split("-");

                        $("#grnnoList").append($('<option>',{

                          value:getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,

                          'data-xyz':getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO,
                          text:getyear[0]+' '+getData.SERIES_CODE+' '+getData.VRNO

                        }));

                      }); 

                    }

                    }
               }

          });

    }, 500);

    setTimeout(function() {
    var seriesgl     =  $('#seriesGlC').val();
    var accgl        =  $('#acc_Gl').val();
    var glof_autoNot =  $('#glof_autoNot').val();
    var accCode      =  $('#account_code').val();
    var accText      =  $('#AccountText').val();
    var accCount     =  $('#acccount').val();

   

    var transGl;
    var autoGl;
    var acccd;
     
    if((glof_autoNot!='' && accgl!='')||(glof_autoNot!='')){

    }else{
       $("#glNotFound").modal('show');
    }

    /*if(seriesgl ==''){
       transGl = '<i class="fa fa-caret-right" aria-hidden="true" style="font-size: 15px;"></i> &nbsp; No <b>Post Code</b> Define For <b> Purchase Bill </b>.';
    }
*/
    if(glof_autoNot==''){
       autoGl = '<i class="fa fa-caret-right" aria-hidden="true" style="font-size: 15px;"></i> &nbsp; No <b>Post Code</b> Define For <b> AutoGenerated Note </b>.';
    }

    if(accCount == 0){
      if(accgl == ''){
       acccd = '<i class="fa fa-caret-right" aria-hidden="true" style="font-size: 15px;"></i> &nbsp; No <b>Gl Code</b> Define For <small style="font-size: 13px;font-weight: bold;">'+accText+'</small>.'
      }
    }
    

    //$('#tranGl').html(transGl);
    $('#autoTrnasGl').html(autoGl);
    $('#accCodeGl').html(acccd);

    //$('#submitinpurchasebill').prop('disabled',true);

    
     }, 1000);

    var fromdateintrans = $('#FromDateFy').val();
    var todateintrans = $('#ToDateFy').val();
    var fromdateintrans_1 = $('#FromDateFy_1').val();
    var todateintrans_1 = $('#ToDateFy_1').val();

      $('.transdatepicker').datepicker({

        format: 'dd-mm-yyyy',

        orientation: 'bottom',

        todayHighlight: 'true',

        startDate :fromdateintrans,

        endDate : todateintrans,

        autoclose: 'true'

      });

    $('#partyBilldate').on('change',function(){
        var partyDate = $('#partyBilldate').val();
        var slipD =  partyDate.split('-');
        var Tdate = slipD[0];
        var Tmonth = slipD[1];
        var Tyear = slipD[2];
        var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;   
        var selectedDate = new Date(getproperDate);
        var todayDate = new Date();  

        if(selectedDate > todayDate){

          $('#showmsgfordate').html('Party Bill Date Can Not Be Greater Than Today').css('color','red');
          $('#partyBilldate').val('');
          return false;

        }else{
          $('#showmsgfordate').html('');
          return true;
        }    

    });

    $('#trans_date').on('change',function(){
        var trans_date = $('#trans_date').val();
        var slipD =  trans_date.split('-');
        var Tdate = slipD[0];
        var Tmonth = slipD[1];
        var Tyear = slipD[2];
        var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;   
        var selectedDate = new Date(getproperDate);
        var todayDate = new Date();  

        if(selectedDate > todayDate){

          $('#showmsgfortransdate').html('Transaction Date Can Not Be Greater Than Today').css('color','red');
          $('#trans_date').val('');
          return false;

        }else{
          $('#showmsgfortransdate').html('');
          return true;
        }    

    });

});

function submitAllData(valD){

      var downloadFlg = valD;
      $('#donwloadStatus').val(downloadFlg);

      var basicTotalAmt = $('#basicTotalAmt').html();
      var partyBilAmt = $('#partyBilAmt').val();
      var taxaplyYorN = $('#taxaplyYorN').val();
      var istaxcode = $('#taxCodeU').val();
      var diffcrdr = $('#diffcrdr').val();
      var createNt = $('#createNote').val();
      var grandTot = $('.grandTotalGet').val();
      console.log('grandTot',grandTot);
      if(diffcrdr == '0.00'){
        whenproceed();
      }else{
        
        if(istaxcode && (taxaplyYorN == 'NO')){

          $("#taxNotAppied").modal('show');
          $('#taxnotApMsg').html('The <b>Tax</b> Has Not Been Applied. In Some Of The Above Entries.');

          $('#notecreatemsg').addClass('notecreateC');
        }else if(istaxcode && (taxaplyYorN == 'YES')){

            if(createNt == 'Debit Note'){
              whenproceed();
            }else if(createNt == 'Creadit Note'){

              if(grandTot == diffcrdr){
                $("#taxNotAppied").modal('show');
                $('#notecreatemsg').removeClass('notecreateC');
                $('#diffNotEqual').html('');
                $('#taxnotApMsg').html('Your Bill Difference Is Rs.<b>'+diffcrdr+'</b> And Its Auto Generated <b>'+createNt+'</b>.');
                $('#proceedBtn').prop('disabled',false);
              }else{
                $("#taxNotAppied").modal('show');
                $('#notecreatemsg').addClass('notecreateC');
                $('#taxnotApMsg').html('');
                $('#diffNotEqual').html('Grand Total Not Match With Difference Amount. Please Recheck Calculation Tax....!');
                $('#proceedBtn').prop('disabled',true);
              }

            }
            
          

        }else{
            whenproceed(valD);
        }   /* /. tax not apply if*/
      }
}


function whenproceed(valDn){

      var basicTotalAmt  = $('#basicTotalAmt').html();
      var partyBilAmt    = $('#partyBilAmt').val();
      var taxaplyYorN    = $('#taxaplyYorN').val();
      var checkboxcount  = $('input[type="checkbox"]:checked').length;
      
      var notyesORno     = $(".noteset:checked").val();
      
      var getwhichNote   = $('#createNote').val();
      
      var note_vrno      = $('#vrseqnum_cr').val();
      var note_transHead = $('#transCode_cr').val();

     // console.log('message_pri',message_pri);
    //  return false;
        
        if(checkboxcount > 0){

           $('#checkBoxSelectMsg').html('');
          
          var checkitm          = [];
          var tax_indictorName  = [];
          var rate_indictorName = [];
          var afrate_Name       = [];
          var taxAmount         = [];
          var taxglName         = [];

            $('.pb_checkitm').each(function(){
                if($(this).is(":checked"))
                {
                  
                 var itmchk = $(this).val();

               //  alert(itmchk);
                 checkitm.push(itmchk);
                 
                 }
            });

            $('input[name^="footer_tax_ind"]').each(function (){
                  
                  tax_indictorName.push($(this).val());

            });

            $('input[name^="footer_rate_ind"]').each(function (){
                  
                  rate_indictorName.push($(this).val());

            });

            $('input[name^="footer_af_rate"]').each(function (){
                  
                  afrate_Name.push($(this).val());

            });

            $('input[name^="footer_amount"]').each(function (){
                  
                  taxAmount.push($(this).val());

            });

            $('input[name^="footer_taxGlCode"]').each(function (){
                  
                  taxglName.push($(this).val());

            });

            var accCode        = $('#account_code').val();
            var grnrvrno       = $('#grnrvrno').val();
            var accountName    = $('#AccountText').val();
            var transcode      = $('#transcode').val();
            var trans_date     = $('#trans_date').val();
            var vrseqnum       = $('#vrseqnum').val();
            var seriesGl       = $('#seriesGlC').val();
            var seriesText     = $('#seriesText').val();
            var seriesGlName   = $('#seriesGlName').val();
            var partyBilNo     = $('#partyBilNo').val();
            var partyBilDate   = $('#partyBilldate').val();
            var diffcrdr       = $('#diffcrdr').val();
            var totalBasic     = $('#totalBasic').val();
            var pofitcCode     = $('#pfctCodegrn').val();
            var seriesCode     = $('#seriesCodegrn').val();
            var plantCode      = $('#plantCodegrn').val();
            var netAmount      = $('#netAmount').val();
            var createNote     = $('#createNote').val();
            var taxcode_crdr   = $('#taxCodeU').val();
            var glof_autoNot   = $('#glof_autoNot').val();
            var seriesAutoNote = $('#seriesOf_autoNot').val();
            var seriesByTc     = $('#seriesByTc').val();
            var accountGl      = $('#acc_Gl').val();
            var accGlName      = $('#acc_GLName').val();
            var profitCName    = $('#pfctNamegrn').val();
            var plantName      = $('#plantNamegrn').val();
            var cpCode         = $('#cpCodeGrn').val();
            var costCenterCd   = $('#costcenterGrn').val();
            var costCenterName = $('#costcenterNameGrn').val();
            var donwloadStatus = $('#donwloadStatus').val();

           // console.log('glof_autoNot',glof_autoNot);return false;
            
            $('.overlay-spinner').removeClass('hideloader');
            $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

            $.ajax({

              url:"{{ url('Transaction/Purchase/Save-Purchase-Bill-Trans') }}",

              method : "POST",

              type: "JSON",

              data: {checkitm: checkitm,accCode:accCode,grnrvrno:grnrvrno,accountName:accountName,transcode:transcode,trans_date:trans_date,vrseqnum:vrseqnum,basicTotalAmt:basicTotalAmt,partyBilAmt:partyBilAmt,seriesGl:seriesGl,seriesGlName:seriesGlName,partyBilNo:partyBilNo,partyBilDate:partyBilDate,diffcrdr:diffcrdr,totalBasic:totalBasic,pofitcCode:pofitcCode,seriesCode:seriesCode,plantCode:plantCode,tax_indictorName:tax_indictorName,rate_indictorName:rate_indictorName,afrate_Name:afrate_Name,taxAmount:taxAmount,taxglName:taxglName,netAmount:netAmount,taxaplyYorN:taxaplyYorN,notyesORno:notyesORno,createNote:createNote,note_vrno:note_vrno,note_transHead:note_transHead,taxcode_crdr:taxcode_crdr,glof_autoNot:glof_autoNot,seriesAutoNote:seriesAutoNote,seriesByTc:seriesByTc,accountGl:accountGl,accGlName:accGlName,seriesText:seriesText,profitCName:profitCName,plantName:plantName,cpCode:cpCode,costCenterCd:costCenterCd,costCenterName:costCenterName,donwloadStatus:donwloadStatus},


              success:function(data){

                var data1 = JSON.parse(data);

                if (data1.response == 'error') {
                  var responseVar = false;
                  var url = "{{url('/Transaction/Purchase/View-Purchase-bill-Msg')}}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });
                }else{
                  var responseVar = true;

                  if(donwloadStatus == 1){
                    var fyYear = data1.data[0].FY_CODE;
                    var fyCd = fyYear.split('-');
                    var seriesCd = data1.data[0].SERIES_CODE;
                    var vrNo = data1.data[0].VRNO;
                    var fileN = 'PBILL_'+fyCd[0]+''+seriesCd+''+vrNo;
                    var link = document.createElement('a');
                    link.href = data1.url;
                    link.download = fileN+'.pdf';
                    link.dispatchEvent(new MouseEvent('click'));
                  }

                  var url = "{{url('/Transaction/Purchase/View-Purchase-bill-Msg')}}"
                  setTimeout(function(){ window.location = url+'/'+responseVar; });
                }

              }

            }); /* /. ajax*/

        }else{
          $('#checkBoxSelectMsg').html('Must Be Select At Least One checkbox.');
        }


}
</script>

@endsection

