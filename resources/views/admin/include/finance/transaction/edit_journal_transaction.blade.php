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



.showinmobile{

  display: none;

}

.secondSection{



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

.settblebrodr{

  border: 1px solid #cac6c6;

}

.tdlboxshadow{

  box-shadow: 0px 1px 4px -1px rgba(161,155,161,1);



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

.container{

    max-width: 1200px;

    margin: 0px auto;

    padding: 0px 15px;

}

/* table{border-collapse:collapse;border-radius:25px;width:880px;} */

/*table, td, th{border:1px solid #00BB64;}*/

/*tr,input{height:30px;border:1px solid #c8bebe;}*/



.inputboxclr{

  border: 1px solid #d7d3d3;

}

.tdthtablebordr{

  border: 1px solid #00BB64;

}

input:focus{border:1px solid yellow;} 

.space{margin-bottom: 2px;}

.but{

    width:105px;

    background:#00BB64;

    border:1px solid #00BB64;

    height:40px;

    border-radius:3px;

    color:white;

    margin-top:10px;

    margin:0px 0px 0px 11px;

    font-size: 14px;

}



.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

    padding: 8px;

    padding-bottom: 0px !important;

    line-height: 1.42857143;

    vertical-align: top;

    border-top: 1px solid #ddd;

    text-align: center;

}

.ref::before {

  color: navy;

  content: "Ch :";

}

.toalvaldesn{

    text-align: right;

    font-weight: 800;

    margin-top: 1%;

}

.debitotldesn{

    width: 277%;

    margin-left: 45%;

    text-align: end;

}

.credittotldesn{

    width: 277%;

    margin-left: -11%;

    text-align: end;

}

.debitcreditbox{

  width: 91px;

  margin-top: 23%;

  text-align: end;

}

.savebtnstyle{

    color: #fff;

    background-color: #204d74;

    border-color: #122b40;

}

.cnaclbtnstyle{

    color: #fff;

    background-color: #d9534f;

    border-color: #d43f3a;

}

.instrumentlbl{

      font-size: 12px;

    margin-left: -5px;

}

.instTypeMode{

    width: 56%;

    margin-bottom: 5px;

}

.textdesciptn{

  width: 250px;

    margin-bottom: 5px;

}

.tdsratebtn{

  margin-top: 33% !important;

  font-weight: 600 !important;

  font-size: 10px !important;

}

.tdsratebtnHide{

  display: none;

}

.tdsInputBox{

  margin-bottom: 2%;

}

.modltitletext{

  text-align: center;

    font-weight: 700;

    color: #5696bb;

}

.textSizeTdsModl{

  font-size: 13px;

}

@media screen and (max-width: 600px) {



  .debitotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: 13%;

  }



  .credittotldesn{

    width: 89px;

    margin-bottom: 5px;

    margin-left: -34%;

  }

  .totlsetinres{

    width: 130%;

  }

  .textdesciptn{

    margin-bottom: -1%;

  }

  .debitcreditbox{

    margin-top: 0%;

  }



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



            <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}"> Journal Trnsaction</a></li>



            <li class="active"><a href="{{ url('/finance/form-transaction-mast') }}">Add Journal Trnsaction</a></li>



          </ul>



        </section>







  <section class="content">



    <div class="row">



      <div class="col-sm-12">



        <div class="box box-primary Custom-Box">



            <div class="box-header with-border" style="text-align: center;">



              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Journal Transaction</h2>



              <div class="box-tools pull-right">



                <a href="{{ url('/finance/view-journal-transaction') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Transaction</a>



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

                

                <label> Vr No: </label>



                  <div class="input-group">



                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                  

                    

                    <input type="text" class="form-control" name="vro" value="{{$cashbank_list->vrno}}" placeholder="Enter Vr No" id="vrseqnum" readonly>



                  </div>



                  <small id="emailHelp" class="form-text text-muted">



                    {!! $errors->first('vrno', '<p class="help-block" style="color:red;">:message</p>') !!}



                  </small>



              </div>

                <!-- /.form-group -->

            </div>



            <div class="col-md-2">

              

              <div class="form-group">



                  <label> T Code : </label>



                      <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-building-o"></i></span>



                          <input type="text" class="form-control" name="tran" value="{{$cashbank_list->tran_code}}" id="transcode" placeholder="Enter Transaction Head" readonly>



                      </div>



                      <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('tran_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



              </div>

                    <!-- /.form-group -->

            </div>
                <!-- /.col -->

            <div class="col-md-5">



                <div class="form-group">



                    <label>Company: <span class="required-field"></span>

                      </label>



                    <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>



                          <input type="text" class="form-control" id="company_code" name="comp" placeholder="Enter Company Name" value="{{strtoupper(Session::get('company_name'))}}" readonly>



                    </div>



                    <small id="comp_code_err" style="color: red;"></small>

                      <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                </div>

                  <!-- /.form-group -->

            </div>
            <!-- /.col -->
            <div class="col-md-3">



                <div class="form-group">



                  <label> Fiscal Year : <span class="required-field"></span></label>



                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                    <input type="text" class="form-control" id="fy_year" name="fiscal" placeholder="Enter fy Year" value="{{strtoupper(Session::get('macc_year'))}}" readonly> 



                  </div>



                  <small id="emailHelp" class="form-text text-muted">



                        {!! $errors->first('fy_code', '<p class="help-block" style="color:red;">:message</p>') !!}



                  </small>



                </div>

                    <!-- /.form-group -->

            </div>
      
          </div>



          <div class="row">


                <!-- /.col -->


            <div class="col-md-3">



                <div class="form-group">



                  <label>Date: <span class="required-field"></span></label>

                    

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                     <?php $jr_date = date('d-m-Y'); ?>

                      <input type="text" class="form-control transdatepicker" name="vr" id="vr_date" value="{{ $jr_date }}" placeholder="Select Date" disabled>



                    </div>



                    <small id="showmsgfordate" style="color: red;"></small>



                      <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('vr_date', '<p class="help-block" style="color:red;">:message</p>') !!}



                      </small>



                </div>

                    <!-- /.form-group -->

            </div>

            <div class="col-md-3">



              <div class="form-group">

                

                <label>Profit Center Code: <span class="required-field"></span></label>



                  <div class="input-group">



                      <div class="input-group-addon">



                        <i class="fa fa-newspaper-o" aria-hidden="true"></i>



                      </div>



                      <input list="profitList"  id="profitId" name="pfct" class="form-control  pull-left" value="{{$cashbank_list->pfct_code}}" placeholder="Select Profit Center Code" oninput="this.value = this.value.toUpperCase()" disabled>



                  </div>

                  <small>  



                      <div class="pull-left showSeletedName" id="profitText"></div>



                  </small>

                  <small id="profit_center_err" style="color: red;"> </small>

              </div>

                <!-- /.form-group -->

            </div>

            <div class="col-md-6">



                <div class="form-group">



                    <label>Profit Center Name: <span class="required-field"></span>

                      </label>



                    <div class="input-group">



                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                          <div class="pull-left showSeletedName" id="profit_names"></div>

                          <input type="text" class="form-control" id="profit_name" name="profit" placeholder="Enter Profit Center Name" value="{{$cashbank_list->pfct_name}}" readonly>



                    </div>



                    <small id="comp_code_err" style="color: red;"></small>

                    <small id="emailHelp" class="form-text text-muted">



                            {!! $errors->first('pfct_name', '<p class="help-block" style="color:red;">:message</p>') !!}



                    </small>



                </div>

                  <!-- /.form-group -->

            </div>

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

         

            <!-- <form id="cahsbanktranssss" method="POST" name='students' action="{{ url('save-cash-bank-transaction') }}"> -->

            <form id="cahsbanktrans">

              @csrf

              <div class="table-responsive">

                <input type="hidden" id="" name="cashbankid" value="{{$cashbank_list->id}}">

                <input type="hidden" id="" name="existuniqAccode" value="{{$cashbank_list->update_flag}}">

                <table class="table tdthtablebordr" border="1" cellspacing="0" id="tbledata">

                  <tr>

                    <th><input class='check_all' type='checkbox' onclick="select_all()"/></th>

                    <th>Sr.No.</th>

                    <th>Account Code</th>

                    <th>Account Name</th>

                    <th>Debit-DR</th>

                    <th>Credit-CR</th>

                  </tr>

                <?php $i=1; foreach ($journal_list as $jv_list) { 
                  $count = count($journal_list);
                  ?>

                  <tr class="useful" id="tr_<?= $jv_list->id; ?>">

                    <input type="hidden" id="countJournal" name="countJournal" value="{{ $count }}">
                     <input type="hidden" id="" name="cashbankid[]" value="{{ $jv_list->id }}">

                    <input type="hidden" value="{{$jv_list->tds_amt}}" id="tds_amt_dr_cr">

                    <td class="tdthtablebordr"><input type='checkbox' class='case' id='del_<?php echo $jv_list->id; ?>'/></td>

                    <td class="tdthtablebordr">

                      <span id='snum'><?= $i++ ?></span>

                       <input  type="hidden" name="tds_rate_up" id="TdsRateByAccCode1" class="getRateForAcc" value="{{$jv_list->tds_rate}}">

                       <input type="hidden" name="tds_code_up" id="TdsSection1" value="{{$jv_list->tds_code}}">

                      <button type="button" class="btn btn-primary btn-xs tdsratebtn tdsratebtnHide" id="tds_rate1" data-toggle="modal" data-target="#tds_rate_model1" onclick="CalculateTdsRate(1)">Calc TDS</button>

                      <input type="hidden" name="" id="accNtdsrate1" value="{{$jv_list->acc_code}}">

                      

                    </td> 

                    <td class="tdthtablebordr">

                      <div class="input-group">

                      <input list="AccList1" class="inputboxclr getacccode" style="width: 107px;margin-bottom: 5px;" id='acc_code<?php echo $i;?>' name="acc_code_up[]" onkeyup='GetAccountCode(<?= $i ?>)' onchange="AccListData(1)" value="{{$jv_list->acc_code}}" oninput="this.value = this.value.toUpperCase()"/>



                        <datalist id="AccList1">



                            <option selected="selected" value="">-- Select --</option>



                            @foreach ($help_account_list as $key)



                            <option value='<?php echo $key->acc_code?>' data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>



                            @endforeach



                          </datalist>

                      </div>

                    </td>

                    <td class="tdthtablebordr">

                      <input type="text" class="inputboxclr getAccNAme" style="width: 250px;margin-bottom: 5px;" id='acc_name<?= $i; ?>' name="acc_name_up[]" value="{{$jv_list->acc_name}}" readonly />

                <input type="text" class="textdesciptn  forperticulr"  name="particular_up[]" id="discription<?= $i ?>" value="{{ $jv_list->particular }}" >

                    </td>

                    <?php $dr_amt =  floatval($jv_list->dr_amount);

                      /*if($dr_amt1){
                        $dr_amt=$dr_amt1;
                      }else{
                        $dr_amt='';
                      }*/
                     ?>

                    <td class="tdthtablebordr"><input type='text' class="debitcreditbox dr_amount inputboxclr"  id='dr_amount<?= $i ?>' name="dr_amount_up[]" value="{{$dr_amt}}" onkeypress='NumberCredit()' oninput='GetDebitAmount(<?= $i ?>)'/>

                    <input type="hidden" id="resultofdebit1" name="DebitdsAmt_up">

                    <input type="hidden" id="WhenTdsCutDebit1" name="base_amt_Debit_up" value="{{$jv_list->base_amt}}">

                    </td>

                    <?php $cr_amt=  floatval($jv_list->cr_amount);
                       /* if($cr_amt1){
                          $cr_amt=$cr_amt1;
                        }else{
                          $cr_amt='';
                        }*/

                     ?>

                    <td class="tdthtablebordr"><input type='text' class="debitcreditbox inputboxclr cr_amount" id='cr_amount<?= $i ?>' name="cr_amount_up[]" value="{{$cr_amt}}" onkeypress='NumberCredit()' oninput='GetCreditAmount(<?= $i ?>)'/>

                    <input type="hidden" id="resultofcredit1" name="CredittdsAmt">

                    <input type="hidden" id="WhenTdsCutCredit1" name="base_amt_Credit">

                    <input type="hidden" id="ivalue" value="<?= $i ?>">

                     </td>

                  </tr>
                <?php } ?>
                </table>

              </div>

              <div>
                <div class="row" style="display: flex;">

                    <div class="col-md-4"></div>

                    <div class="col-md-4 toalvaldesn"><div class="totlsetinres">Total :</div></div>

                    <div class="col-md-1"><input class="debitotldesn inputboxclr" type="text" name="TotlDebit" id="totldramt" readonly=""></div>

                    <div class="col-md-1"></div>

                    <div class="col-md-1"><input class="credittotldesn inputboxclr" type="text" name="TotalCredit" id="totlcramt" readonly=""></div>

                    <div class="col-md-1"></div>

                </div>
              </div>

              <div>
               <div class="row" style="display: flex;">
              </div>

              <div id="showgreatermsg" style="text-align: end;color: red;"></div>

              <input type="hidden" name="series_code" id="hidnseried"> 

              <input type="hidden" name="gl_code" id="hidnglcode"  value="{{$cashbank_list->gl_code}}"> 

              <input type="hidden" name="gl_name" id="hidnglnme" value="{{$cashbank_list->gl_name}}">

              <input type="hidden" name="bank_code" id="hidnbanknme">

              <input type="hidden" name="vrno" id="hidnvrseq">

              <input type="hidden" name="tran_code" id="hidntranscd">

              <input type="hidden" name="vr_type" id="hidnvrtyp">

              <input type="hidden" name="company_code" id="hidncopmnm">

              <input type="hidden" name="fy_code" id="hidnfyyear">

              <input type="hidden" name="vr_date" id="hidnvrdte">

              <input type="hidden" name="pfct_code" id="hidnpfitid">

              <input type="hidden" name="pfct_name" id="hidngpfitnme">

              </div>

             

              <!-- <p class="text-center"> <input type='submit' name='submit' value='submit' id="submitdata" class='btn but' disabled /></p>--> 

              

              <p class="text-center">
                 <button class="btn btn-danger pull-left" type="button" id="delete" ><i class="fa fa-minus" aria-hidden="true" style="font-size: 9px;"></i>&nbsp; Delete</button> 

               <!--  <button class="btn btn-primary " type="button" id="simulationbtn" ><i class="fa fa-clipboard" aria-hidden="true"></i>&nbsp;&nbsp; Simulation</button>  -->



                <button class="btn btn-success" type="button" id="submitdata" ><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Update</button>



                <a href="{{ url('finance/view-journal-transaction')}}" class="btn btn-warning"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</a>

              </p>







              <!-- model -->

      <div class="modal fade" id="tds_rate_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

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

                    <input type="text" id="tds_section1" name="tds_section" value="" readonly>

                  </div>

                  <div class="col-md-2"></div>

              </div>

              <div class="row tdsInputBox">

                  <div class="col-md-4">

                    <label class="textSizeTdsModl">Tds Rate</label>

                    

                  </div>

                  <div class="col-md-4">

                    <input type="text" id="tdsRate1" readonly>

                  </div>

                  <div class="col-md-2"></div>

              </div>

              <div class="row tdsInputBox">

                  <div class="col-md-4">

                    <label class="textSizeTdsModl">Tds Base Amount</label>

                    

                  </div>

                  <div class="col-md-4">

                    <input type="hidden" id="tds_base_Amt1" name="baseTDSAmt" value="" oninput="changetdsamt(1)">

                    <input type="text" id="deduct_tds_Amt1" readonly name="base_amt_tds">

                  </div>

                  <div class="col-md-2"></div>

              </div>

              <div class="row tdsInputBox">

                  <div class="col-md-4">

                    <label class="textSizeTdsModl">Tds Amount calculate</label>

                    

                  </div>

                  <div class="col-md-4">

                    <input type="text" id="tds_Amt_cal1" readonly>

                  </div>

                  <div class="col-md-2"></div>

              </div>

              <div class="row tdsInputBox">

                  <div class="col-md-4">

                    <label class="textSizeTdsModl">Net Amount</label>

                    

                  </div>

                  <div class="col-md-4">

                    <input type="text" id="Net_amount1" readonly>

                  </div>

                  <div class="col-md-2"></div>

              </div>

            </div>

           <!--  <div class="modal-footer" style="text-align: center;">

              <button type="button" class="btn btn-primary" style="width: 27%;" data-dismiss="modal" id="ApplyTds1" onclick="Applytds(1)">Apply TDS</button>

              <button type="button" class="btn btn-warning" style="width: 20%;" data-dismiss="modal">Cancle</button>

            </div> -->

          </div>

        </div>

      </div>

<!-- model -->





              </form>



              

          

          </div><!-- /.box-body -->



        </div>



      </div>



    </div>



  </section>







</div>



<!-- simulation Model -->

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

        grid-template-columns: 1fr 2fr 5fr 5fr 2fr 2fr;

    }



    .attribute-container {

        display: grid;

        grid-template-columns: repeat(auto-fit, minmax(var(--column-width-min), 1fr));

    }



    /* Definition of wrapping column width for attribute groups. */

    .part-information {

        --column-width-min: 10em;

    }



    .part-id {

        --column-width-min: 10em;

    }



    .vendor-information {

        --column-width-min: 8em;

    }



    .quantity {

        --column-width-min: 5em;

    }



    .cost {

        --column-width-min: 5em;

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

    

}

</style>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="showallDataM">

  <div class="modal-dialog modal-lg" role="document">

    <div class="modal-content" style="border-radius: 5px;">

      <div class="modal-header">

        <h5 class="modal-title modltitletext" id="exampleModalLabel" style="font-size: 17px;">Simulation Of Cash / Bank</h5>

      </div>

      <div class="modal-body" id="modelbody">

         <section>

            <ol class="collection collection-container simulationOl">

      <!-- The first list item is the header of the table -->

      <li class="item item-container">



        <div class="attribute" data-name="#" style="border-left: 1px solid gray;">Sr.No.</div>



        <!-- Enclose semantically similar attributes as a div hierarchy -->

        <div class="attribute-container part-information">

          <div class="attribute-container part-id">

            <div class="attribute" data-name="Part Number">Account Code</div>

          </div>

        </div>





        <div class="attribute-container cost">

          <div class="attribute">Account Name</div>

        </div>



        <div class="attribute-container cost">

          <div class="attribute">Perticular</div>

        </div>



        <div class="attribute-container duty">

          <div class="attribute">Debit-DR</div>

        </div>



        <div class="attribute-container freight">

          <div class="setCrDrRight">Credit-CR</div>

        </div>



      </li>

      <!-- The rest of the items in the list are the actual data -->

  

    </ol>

          </section>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-primary" data-dismiss="modal" id="">Ok</button>

      </div>

    </div>

  </div>

</div>

<!-- simulation Model -->





 









@include('admin.include.footer')





<script src="{{ URL::asset('public/dist/js/viewjs/journal_trans.js') }}" ></script>


<script type="text/javascript">
  
  $(document).ready(function(){

    $( window ).on( "load", function() {

      $count =  $("#countJournal").val();
    //alert($count);return false;
    if($count==2){

      $("#delete").prop('disabled',true);
    }else{
       $("#delete").prop('disabled',false);
    }

     var sum = 0;
      $(".dr_amount").each(function () {

         if (!isNaN(this.value) && this.value.length != 0) {
            sum += parseFloat(this.value);
           // $(".cr_amount").val('');

        }

        $("#totldramt").val(sum.toFixed(2));

      });



   //  alert(ddvalue);return false;

      var sumcr = 0;
       $(".cr_amount").each(function () {

         if (!isNaN(this.value) && this.value.length != 0) {
            sumcr += parseFloat(this.value);
        }

        $("#totlcramt").val(sumcr.toFixed(2));

      });

    });



  $('#delete').click(function(){


    $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

      });

    var post_arr = [];

    // Get checked checkboxes
    $('#tbledata input[type=checkbox]').each(function() {
      if (jQuery(this).is(":checked")) {
        var id = this.id;
        var splitid = id.split('_');
        var postid = splitid[1];
       //alert(postid);

        post_arr.push(postid);
        
      }
    });

    if(post_arr.length > 0){

        var isDelete = confirm("Do you really want to delete records?");
        if (isDelete == true) {
           // AJAX Request
           $.ajax({
              url:"{{ url('delete-multiple-data-journal') }}",
              method : "POST",
              type: "JSON",
              data: { post_id: post_arr},
              success: function(response){
                console.log(response);
                 $.each(post_arr, function( i,l ){
                     $("#tr_"+l).remove();
                 });

                  var sumdrD = 0;
                   //dr amount
                    $(".dr_amount").each(function () {
                      //add only if the value is number
                      if (!isNaN(this.value) && this.value.length != 0) {
                          sumdrD += parseFloat(this.value);
                          $("#totldramt").val(sumdrD.toFixed(2));
                      }else{
                        $("#totldramt").val('');
                      }
                   
                  });

                  //cr amount
                  var sumcrD = 0;
                  $(".cr_amount").each(function () {
                      //add only if the value is number
                      if (!isNaN(this.value) && this.value.length != 0) {
                          sumcrD += parseFloat(this.value);
                          $("#totlcramt").val(sumcrD.toFixed(2));
                      }else{
                       $("#totlcramt").val('');
                      }
                    

                  });

                   var df =  $("#totldramt").val();
                var cf =  $("#totlcramt").val();
                if(df==cf){
                  $("#submitdata").prop("disabled",false);
                }else{
                  $("#submitdata").prop("disabled",true);

                }
              }
           });


           
        } 
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





$('#cr_amount1').on('input',function(){

 var CrAmount = $('#cr_amount1').val();



  if(CrAmount){

    $('#resultofdebit1').val('');

  }

});



$('#dr_amount1').on('input',function(){

 var DebitAmt = $('#dr_amount1').val();



  if(DebitAmt){

    $('#resultofcredit1').val('');

  }

});









$( window ).on( "load", function() {


      var ivalue = $('#ivalue').val();


   //alert(ivalue);

      var DebitValue = $('#dr_amount1').val();


      var CreditValue = $('#cr_amount1').val();

      var tds_Amount = $('#tds_amt_dr_cr').val();

     

      if(DebitValue == 0){

          $('#resultofcredit1').val(tds_Amount);

      }else{

          $('#resultofdebit1').val(tds_Amount);

      }



      var tdsDebit = $('#resultofdebit1').val();

      var tdsCredit = $('#resultofcredit1').val();

     if(tdsDebit){

        $('#tds_rate1').removeClass('tdsratebtnHide');

     }else if(tdsCredit){

        $('#tds_rate1').removeClass('tdsratebtnHide');

     }else{

         $('#tds_rate1').addClass('tdsratebtnHide');

     }



       

});



});

</script>





<script type="text/javascript">



function CalculateTdsRate(TdsId){   

   

      $.ajaxSetup({



            headers: {



              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')



            }



      });



      var accCode = $('#acc_code'+TdsId).val();

      // console.log(accountcode);

        $.ajax({



              url:"{{ url('tds-rate-calculate') }}",



               method : "POST",



               type: "JSON",



               data: {accCode: accCode},



               success:function(data){



                    var data1 = JSON.parse(data);

               

                    if (data1.response == 'error') {



                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      



                    }else if(data1.response == 'success'){

                        // console.log(data1.data);

                       // console.log(data1.data[0].tds_code);

                        $('#tds_section'+TdsId).val(data1.data[0].tds_code);

                        $('#tdsRate'+TdsId).val(data1.data[0].tds_rate);

                        var dr_amt = $('#dr_amount'+TdsId).val();

                        var cr_amount = $('#cr_amount'+TdsId).val();



                        if(dr_amt){

                          $('#tds_base_Amt'+TdsId).val(dr_amt);

                          $('#Net_amount'+TdsId).val(dr_amt);

                        }else{

                          $('#tds_base_Amt'+TdsId).val(cr_amount);

                          $('#Net_amount'+TdsId).val(cr_amount);

                        }







                        var tdsRateval = parseFloat($('#tdsRate'+TdsId).val());

                        var tdsbaseamtval = parseFloat($('#tds_base_Amt'+TdsId).val());



                        var calculatPercnt = tdsbaseamtval / 100 * tdsRateval;



                        var deductBAmtWTdsAmt = tdsbaseamtval - parseFloat(calculatPercnt);

                        $('#deduct_tds_Amt'+TdsId).val(deductBAmtWTdsAmt);

                          //var TdsAmtCalcult =  tdsbaseamtval - parseFloat(calculatPercnt);

                          //  console.log(TdsAmtCalcult);deduct_tds_Amt1



                          $('#tds_Amt_cal'+TdsId).val(calculatPercnt.toFixed(2));

                        

                    }

               }



          });

         

}





function Applytds(aplytdsval){

   var NetAmount = $('#Net_amount'+aplytdsval).val();

   var TdsRate = $('#tdsRate'+aplytdsval).val();

   var DebitAmt = $('#dr_amount'+aplytdsval).val();

   var CreditAmt = $('#cr_amount'+aplytdsval).val();



   var calculateResult =  parseFloat(NetAmount) / 100 * parseFloat(TdsRate);



   if(DebitAmt){

      if(calculateResult){

        $('#resultofdebit'+aplytdsval).val(calculateResult);

      }else{

        $('#resultofdebit'+aplytdsval).val(0);

      }

   }else{

      if(calculateResult){

        $('#resultofcredit'+aplytdsval).val(calculateResult);

      }else{

        $('#resultofcredit'+aplytdsval).val(0);

      }

   }

}

</script>



<script type="text/javascript">

  

  function GetAccountCode(Accid){

    //console.log(Accid);

      $.ajaxSetup({



            headers: {



              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')



            }



      });



      var accountcode =  $('#acc_code'+Accid).val();

    //  alert(accountcode);return false;



        $.ajax({



              url:"{{ url('acc-code-for-cash-bank') }}",



               method : "POST",



               type: "JSON",



               data: {accountcode: accountcode},



               success:function(data){



                    var data1 = JSON.parse(data);

               

                    if (data1.response == 'error') {



                        $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                    }else if(data1.response == 'success'){



                        if(data1.data==''){

                          var accNAme = '';

                          $('#acc_name'+Accid).val(accNAme);

                          $('#inst_type'+Accid).val('');

                          $('#cheque_no'+Accid).val('');

                          $('#discription'+Accid).val('To -');

                          $('#dr_amount'+Accid).val('');

                          $('#cr_amount'+Accid).val('');

                          $('#totldramt'+Accid).val('');

                          $('#resultofdebit1'+Accid).val('');

                          $('#resultofcredit1'+Accid).val('');

                          $('#referencetext'+Accid).val('');

                           $('#tds_rate'+Accid).addClass('tdsratebtnHide');

                        }else{

                          $('#acc_name'+Accid).val(data1.data[0].acc_name);
                          //console.log(data1.data[0].acc_name)

                         var debit_amt = $('#dr_amount'+Accid).val();
                         if(debit_amt==''){

                          $("#submitdata").prop('disabled',true);

                         }else{
                          $("#submitdata").prop('disabled',false);
                         }


                        }



                        if(data1.data_tds == ''){

                          var acctdsrte = '';

                          var NotgetTdsRate = '';

                          var tdssection ='';

                          $('#accNtdsrate'+Accid).val(acctdsrte);

                          $('#TdsRateByAccCode'+Accid).val(NotgetTdsRate);

                           $('#TdsSection'+Accid).val(tdssection);

                        }else{

                          $('#accNtdsrate'+Accid).val(data1.data_tds[0].acc_code);

                          $('#TdsRateByAccCode'+Accid).val(data1.data_tds[0].tds_rate);

                          $('#TdsSection'+Accid).val(data1.data_tds[0].tds_code);

                        }

                        

                        var drAmtIfExist = $('#dr_amount'+Accid).val();

                        var CreditAmtIfExist = $('#cr_amount'+Accid).val();

                        var TdsRateExist = $('#TdsRateByAccCode'+Accid).val();



                        if(drAmtIfExist || CreditAmtIfExist){

                          if(TdsRateExist){

                              $('#tds_rate'+Accid).removeClass('tdsratebtnHide');

                          }else{

                              $('#tds_rate'+Accid).addClass('tdsratebtnHide');

                          }



                        }



                    }

               }



          });



         var seriesCode  = $('#series_code').val();

          var bankCode    = $('#bankid').val();

          var pay_mode    = $('#vr_type').val();

          //console.log(pay_mode);

          var vr_date     = $('#vr_date').val();

          var profit_code = $('#profitId').val();



          if(seriesCode){

            $('#series_code').prop('readonly',true);

          }

          if(bankCode){

            $('#bankid').prop('readonly',true);

          }

          

          if(vr_date){

            $('#vr_date').prop('readonly',true);

          }

          if(profit_code){

            $('#profitId').prop('readonly',true);

          }



  }



</script>







<script type="text/javascript">



$(document).ready(function(){



   $("#submitdata").click(function(event) {



        var data = $("#cahsbanktrans").serialize();

        //  console.log(data);

          $.ajaxSetup({



                headers: {



                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')



                }

          });



          $.ajax({



              type: 'POST',



              url: "{{ url('/finance/journal-update') }}",



              data: data, // here $(this) refers to the ajax object not form



              success: function (data) {



               console.log(data);



                window.location.href = "{{ url('/finance/view-journal-transaction') }}";

              },



          });

           /* Act on the event */





   });



});



</script>





@endsection