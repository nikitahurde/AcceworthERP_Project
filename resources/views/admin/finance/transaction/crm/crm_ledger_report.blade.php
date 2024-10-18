@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.crmnavbar')



@include('admin.include.crmsidebar')



<style type="text/css">



  .Custom-Box {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #c2d9ff;
  }
  .box-header>.box-tools {

    position: absolute !important;

    right: 10px !important;

    top: 2px !important;

  }

  .hsdiv{
    display: none;
  }

  .noDataF{
    color: #f65371;
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
  .crBal{
    display:none;
  }
  .particuwidth{
    width:500px;
  }

  .defualtSearchNew{

    display: none;

  }
  .rightcontent{

  text-align:right;


}

::placeholder {
  
  text-align:left;
}

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

 }
 .alignRightClass{
  text-align: right;
 }
 .widthClassdt{
  width: 15%;

 }
 .widthvrno{
  width: 11%;
 }
 .alignCenterClass{
  text-align: center;
 }
 .aligncenterClass{
  text-align: center;
 }
.showhideGl{
  display: none;
}
.hideAccc{
  display: none;
}
.showhideaccC{
  display: none;
}
.showthforaccgl{
  display: none;
}
 @media only screen and (max-width: 600px) {
  
  .dataTables_filter{
    margin-left: 35%;
  }

  .divScroll{
    overflow-x: scroll;
  }

}

.dt-buttons{
    margin-bottom: -30px!important;
    padding-bottom: 35px !important;
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
  padding-bottom: 15px;
  
}
.showhideaccC{
  display: none;
}
.showhideGl{
  display: none;
}

</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            A/c Ledger Report

            <small> Account Ledger Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">List Account Ledger Report </a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Account Ledger Report </h2>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->



            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">



               @csrf

                <?php date_default_timezone_set('Asia/Kolkata'); ?>

             
              

              <div class="row">
                  <div class="col-md-3">

                  <div class="form-group">
                    <?php

                   $From_date = date("d-m-Y", strtotime($yearstart));
                   $To_date = date("d-m-Y", strtotime($yearend));



                     ?>
                    
                    <input autocomplete="off" type="hidden" name="" id="from_date_default" value="{{ $From_date }}">
                    <input autocomplete="off" type="hidden" name="" id="to_date_default" value="{{ $To_date }}">
                      <label for="exampleInputEmail1">From Date : </label>

                      <div class="input-group">
                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                         <input autocomplete="off" type="text" name="from_date" id="from_date" class="form-control datepicker rightcontent" placeholder="Enter From  Date" value="<?php echo $From_date; ?>">

                      </div>
                    <small id="show_err_from_date" style="color: red;"></small>
                     


                  </div>

                </div><!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">To Date: </label>

                      <div class="input-group">
                            <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                            <input autocomplete="off" type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Enter To  Date" value="<?php echo date('d-m-Y'); ?>">

                      </div>

                      <small id="show_err_to_date" style="color:red;"></small>

                  </div>

                </div><!-- /.col -->

               <!-- /.col -->

                <!-- /.col -->
                 <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Account Code : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>



                           <input autocomplete="off" list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ $acc_code }}" placeholder="Select Account Code" readonly="">

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="accountText"></div>

                     </small>

                     <small id="show_err_acct_code">

                        

                     </small>

                  </div>

                </div>

               

              </div>

              <div class="row">


               <!-- /.col -->
                  
                  
                 
               <div class="col-md-2"></div>
                  
                 <div class="col-md-8" style="text-align: center;margin-top: 1%;">

                    <div class="">

                     <button type="button" class="btn btn-primary btn-sm" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 5px;" onclick="return validation();"><i class="fa fa-search" aria-hidden="true" ></i> &nbsp;&nbsp;Search</button>

                      <button type="button" class="btn btn-default btn-sm" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

                    <button type="button" class="btn btn-primary btn-sm"  id="btnsummary" onclick="return validation();"><i class="fa fa-month" aria-hidden="true"></i>MONTH SUMMARY </button>
                  <button type="button" class="btn btn-success btn-sm"  id="btntransaction" onclick="return validation();"><i class="fa fa-month" aria-hidden="true"></i> TRANSACTION </button>

                     </div>

                </div>
                <div class="col-md-2"></div>

              </div>

           <div style="text-align: center;"><small id="show_err_code" style="color: red;"></small></div>

         


               

             </form>

            </div><!-- /.box-body -->



<div class="box-body divScroll" style="margin-top: -1%;">

          <!-- <button type="button" id="btnpdf"  class="btn btn-danger btn-sm special" style="margin-left: 145px !important;margin-bottom: -50px !important;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF </button> -->
         
          <button type="button" id="btnpdf"  class="btn btn-danger btn-sm special"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF </button>
          <button type="button" id="summarybtnpdf" class="btn btn-danger btn-sm" style="display: none;"><i class="fa fa-file-pdf-o" aria-hidden="true" ></i> PDF 
          </button>  
          <button type="button" id="transbtnpdf" class="btn btn-danger btn-sm" style="display: none;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF 
          </button>

        

  <!-- <button type="button" id="transbtnpdf" class="btn btn-danger btn-sm" style="margin-bottom: -50px !important;display: none;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF 
  </button> -->
 
  <div style="text-align:right;">

    

    </div>

<table id="InwardDispatch" class="table table-bordered table-striped table-hover">

  <thead class="theadC">

     <!--  < ?php $totalDr=0;$totalcr=0;foreach ($acc_led_list as $key) {
         $totalDr += $key->dr_amt;
         $totalcr += $key->cr_amt;
      } ?> -->
      <input type="hidden" id="totalDebitAmt" value="">
      <input type="hidden" id="totalCreditAmt" value="">
    <tr>

      <th class="text-center">Sr. No</th>
     <!--  <th class="text-center">pfct Code</th> -->
      <th class="text-center" style="width: 65px;">Vr Date</th>
      <th class="" style="width: 65%;">Vr No. </th>
      <!-- <th class="text-center">T Nature </th> -->
      <th class="text-center" style="width: 500px;">Perticular </th>
      <th class="text-center" style="text-align: center;width: 100px;">Debit</th>
      <th class="text-center"style="text-align: center;width: 100px;">Credit</th>
       <th class="text-center" style="text-align: center;width: 100px;">Balence</th>
      <th class="text-center">Bal Type</th>
      <th class="text-center">Ref Code</th>
      <!-- <th class="text-center showhideGl">Gl Code </th>  -->
      

    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>

  <tfoot align="right">
    <tr>
      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
    </tr>
  </tfoot>
  

</table>

<table id="table_id" class="table table-bordered table-striped table-hover">

  <thead class="theadC">

     <!--  < ?php $totalDr=0;$totalcr=0;foreach ($acc_led_list as $key) {
         $totalDr += $key->dr_amt;
         $totalcr += $key->cr_amt;
      } ?> -->
      <input type="hidden" id="totalDebitAmt" value="">
      <input type="hidden" id="totalCreditAmt" value="">
    <tr>

      <th class="text-center">Sr. No</th>
     <!--  <th class="text-center">pfct Code</th> -->
      <th class="text-center">Yr.Mon</th>
      <th class="">DRAMT. </th>
      <!-- <th class="text-center">T Nature </th> -->
      <th class="text-center">CRAMT </th>
      <th class="text-center">BALANCE</th>
     
      <!-- <th class="text-center showhideGl">Gl Code </th>  -->
      

    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>

  <tfoot align="right">
    <tr>
      <th></th><th></th><th></th><th></th>
    </tr>
  </tfoot>
  

</table>


<table id="trans_id" class="table table-bordered table-striped table-hover">

  <thead class="theadC">

      <input type="hidden" id="totalDebitAmt" value="">
      <input type="hidden" id="totalCreditAmt" value="">
    <tr>

      <th class="text-center">Sr. No</th>
      <th class="text-center">SERIES</th>
      <th class="text-center">PARTICULAER</th>
      <th class="">DRAMT. </th>
      <th class="text-center">CRAMT </th>
      <th class="text-center">BALANCE</th>
    

    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>

  <tfoot align="right">
    <tr>
      <th></th><th></th><th></th><th></th><th></th>
    </tr>
  </tfoot>
  

</table>

</div><!-- /.box-body -->
  

   <div class="box-body hsdiv" style="margin-top: 0%;" id="detailsbox">
  <div class="row" style="border: 1px solid #d2d6de;margin: 5px;padding-top:30px;padding-bottom:30px;box-shadow: 0px 0px 8px -3px rgb(0 0 0 / 75%);border-radius: 5px;">
      <div class="col-md-4">
        <p id="tNature"></p>
      </div>
      <div class="col-md-4">
        <p id="partyBlNo"></p>
      </div>
      <div class="col-md-4">
        <p id="partyBlDate"></p>
      </div>
     <!--  <div class="col-md-4">
        <p id="batchNo"></p>
      </div> -->
      <div class="col-md-4">
         <p id="accCode"></p>
      </div>

        <div class="col-md-4">
         <p id="glCode"></p>
      </div>
      <div class="col-md-4">
        <p id="rate"></p>
      </div>
      <div class="col-md-4">
        <p id="dr_amt"></p>
      </div>

  </div>
</div>
           

          </div>

         

  </section>

</div>


 <div class="modal fade" id="view_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document" style="margin-top: 13%;">
          <div class="modal-content" style="border-radius: 5px;">
            <div class="modal-header">
              <center><h5 class="modal-title modltitletext" id="exampleModalLabel" style="font-weight: bold;">Particular</h5></center>
            </div>
            <div class="modal-body">
              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Bill No</label>    :
                    
                  </div>
                  <div class="col-md-6">
                   <span id="bill_no"></span>
                  </div>
                  <div class="col-md-2"></div>
              </div>

              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Bill Date</label> :
                    
                  </div>
                  <div class="col-md-6">
                   <span id="bill_date"></span>
                  </div>
                  <div class="col-md-2"></div>
              </div>

              <div class="row tdsInputBox">
                  <div class="col-md-4">
                    <label class="textSizeTdsModl">Bill Amt</label> :
                    
                  </div>
                  <div class="col-md-6">
                    <span id="bill_amt"></span>
                  </div>

                  <div class="col-md-2"></div>
              </div>

              
            </div>
           
                <span id="errmsg" style="font-size: 12px;
    margin-left: 31px;"></span>
             
            <div class="modal-footer" style="text-align: center;">
              <button type="button" class="btn btn-primary btn-xs"  style="width:50px;" data-dismiss="modal" id="payment_trem_apply">Ok</button>
            </div>
          </div>
        </div>
      </div>



@include('admin.include.footer')


<!-- cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js -->


<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>

<script type="text/javascript">
  
 $(document).ready(function(){

function summary_data(acct_code='',acct_class='',acct_type='',pfct_code='',glC_code='',comp_code='',from_date='',to_date='',vr_num=''){

   var t =  $('#table_id').DataTable({

              processing: true,
              serverSide: true,
              searching: false,
               destroy: true,
             /* scrollX: true,*/
              pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
             
             
              language:[
                "thousand"
              ],
              
               buttons: [
                    /*{
                        extend: 'print',
                        title: 'Summary Report',
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' );
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' )
                                .css( 'color', 'black' );
                        }
                    },
                    {
                      
                          extend: 'excelHtml5',
                          exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                          }
                        
                    },*/
                ],

              
              ajax:{
                url:'{{ url("/summary-report-acc-ledger-crm") }}',
                data: {acct_code:acct_code,acct_class:acct_class,acct_type:acct_type,pfct_code:pfct_code,glC_code:glC_code,comp_code:comp_code,from_date:from_date,to_date:to_date,vr_num:vr_num}
              },

              columns: [
                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    className: "alignCenterClass"
                },
                {
                    data:'YYYYMM',
                    name:'YYYYMM',
                    className: "widthClassdt",
                   
                },
                {
                    data:'yrdramt',
                    name:'yrdramt',
                    className: "alignRightClass",
                   
                },
                {
                    data:'yrcramt',
                    name:'yrcramt',
                    className: "alignRightClass",
                   
                },
                {
                    data:'balence',
                    name:'balence',
                    className: "alignRightClass",
                   
                },
               

                ],
          });

}

 $('#btnsummary').click(function(){



          var from_date  =  $('#from_date').val();
          
          var to_date    =  $('#to_date').val();
          
          var acct_code  =  $('#acct_code').val();
          var acct_class =  $('#acct_class').val();
          var acct_type  =  $('#acct_type').val();
          var glsch_code =  $('#glsch_code').val();
          var pfct_code  =  $('#pfct_code').val();
          var comp_code  =  $('#comp_code').val();
          var glC_code   =  $('#glC_code').val();
        

          var vr_num = '';
          var btnsummary =  $('#btnsummary').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (acct_code!='' || glC_code!='' || vrno!='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date != ''){

            if(to_date==''){
               $('#show_err_to_date').html('Please select to date');
              return false;
            }
           }

            $('#InwardDispatch').DataTable().destroy();
            $('#InwardDispatch').hide();
            $('#trans_id').DataTable().destroy();
            $('#trans_id').hide();
            $('#table_id').DataTable().destroy();
            $('#table_id').show();
            $('#detailsbox').css('display','none');

            summary_data(acct_code,acct_class,acct_type,pfct_code,glC_code,comp_code,from_date,to_date,vr_num);

            //$("#btnpdf").hide();
         
           // $(".special").attr("id", "summarybtnpdf");

           $("#summarybtnpdf").css('display','block');
           $("#btnpdf").css('display','none');
           $("#transbtnpdf").css('display','none');
          
            /*var pdfbtn ='<button type="button" id="summarybtnpdf"  class="btn btn-danger btn-sm special" style="margin-left: 145px !important;margin-bottom: -50px !important;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF </button>';*/

            //$("#allpdfbtn").append(pdfbtn);

            var totalDebitAmt= $('#totalDebitAmt').val();
            var totalCreditAmt =  $('#totalCreditAmt').val();

            $('#totl_dr_val').html(totalDebitAmt);
            $('#totl_cr_val').html(totalCreditAmt);

           if(totalDebitAmt > totalCreditAmt){
            var balenceAmt = totalDebitAmt - totalCreditAmt;
            $('#totl_balence').html(balenceAmt);
            $('#bal_type').html('Dr');
           }else if(totalCreditAmt > totalDebitAmt){
            var balenceAmt = totalCreditAmt - totalDebitAmt;
            $('#totl_balence').html(balenceAmt);
            $('#totl_balence').html('Cr');
           }else{}

          }else{
            $('#table_id').DataTable().destroy();
            $('#InwardDispatch').DataTable().destroy();
            $('#InwardDispatch').hide();
            $('#trans_id').DataTable().destroy();
            $('#trans_id').hide();
            $('#table_id').show();
            summary_data();
             /*$('#show_err_from_date').html('Please select from date').css('color','red');
            
             $('#show_err_to_date').html('Please select to date').css('color','red');
             $('#show_err_dept_code').html('Please select depot').css('color','red');
             $('#show_err_acct_code').html('Please select account code').css('color','red');
             $('#show_err_trans').html('Please select transporter').css('color','red');*/
          }


        });



});

</script>


<script type="text/javascript">
  
 $(document).ready(function(){

function transaction_data(acct_code='',acct_class='',acct_type='',pfct_code='',glC_code='',comp_code='',from_date='',to_date='',vr_num=''){

   var t =  $('#trans_id').DataTable({

              processing: true,
              serverSide: true,
              searching: false,
               destroy: true,
             /* scrollX: true,*/
              pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
             
             
              language:[
                "thousand"
              ],
                buttons: [
                    /*{
                        extend: 'print',
                        title: 'Transaction Report',
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' );
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' )
                                .css( 'color', 'black' );
                        }
                    },
                    {
                      
                          extend: 'excelHtml5',
                          exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                          }
                        
                    },*/
                   /* {
          extend: 'pdfHtml5',
          text: 'PDF',
          orientation: 'landscape',
          pageSize: 'LEGAL',
          customize: function (doc) {
                                  //Remove the title created by datatTables
                                  doc.content.splice(0,1);
                                  var now = new Date();
                                  var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();
                                  doc.pageMargins = [20,60,20,30];
                                  doc.defaultStyle.fontSize = 16;
                                  doc.styles.tableHeader.fontSize = 16;
 
                                  doc['header']=(function() {
                                      return {
                                          columns: [
 
                                              {
                                                  alignment: 'center',
                                                  italics: true,
                                                  text: 'Customer Table ' + now,
                                                  fontSize: 18,
                                                  margin: [10,0]
                                              },
                                              
                                          ],
                                          margin: 25
                                      }
                                  });
 
                                  doc['footer']=(function(page, pages) {
                                      return {
                                          columns: [
                                              {
                                                  alignment: 'left',
                                                  text: ['Created on: ', { text: jsDate.toString() }]
                                              },
                                              {
                                                  alignment: 'right',
                                                  text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                                              }
                                          ],
                                          margin: 25
                                      }

                                       
                                  });

                                  
                                  var objLayout = {};
                                  objLayout['hLineWidth'] = function(i) { return .20; };
                                  objLayout['vLineWidth'] = function(i) { return .20; };
                                  objLayout['hLineColor'] = function(i) { return '#aaa'; };
                                  objLayout['vLineColor'] = function(i) { return '#aaa'; };
                                  objLayout['paddingLeft'] = function(i) { return 4; };
                                  objLayout['paddingRight'] = function(i) { return 4; };
                                  doc.content[0].layout = objLayout;



                          }
        },*/
                ],


              
              ajax:{
                url:'{{ url("/transaction-report-acc-ledger-crm") }}',
                data: {acct_code:acct_code,acct_class:acct_class,acct_type:acct_type,pfct_code:pfct_code,glC_code:glC_code,comp_code:comp_code,from_date:from_date,to_date:to_date,vr_num:vr_num}
              },

              columns: [
                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    className: "alignCenterClass"
                },
                {
                    data:'SERIES',
                    name:'SERIES',
                    className: "widthClassdt",
                   
                },
                {
                    data:'particular',
                    name:'particular',
                    className: "widthClassdt",
                   
                },
                {
                    data:'yrdramt',
                    name:'yrdramt',
                    className: "alignRightClass",
                   
                },
                {
                    data:'yrcramt',
                    name:'yrcramt',
                    className: "alignRightClass",
                   
                },
                {
                    data:'balence',
                    name:'balence',
                    className: "alignRightClass",
                   
                },
               

                ],
          });

}

 $('#btntransaction').click(function(){



          var from_date  =  $('#from_date').val();
          
          var to_date    =  $('#to_date').val();
          
          var acct_code  =  $('#acct_code').val();
          var acct_class =  $('#acct_class').val();
          var acct_type  =  $('#acct_type').val();
          var glsch_code =  $('#glsch_code').val();
          var pfct_code  =  $('#pfct_code').val();
          var comp_code  =  $('#comp_code').val();
          var glC_code   =  $('#glC_code').val();
         
          var vr_num = '';
          var btnsummary =  $('#btnsummary').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (acct_code!='' || glC_code!='' || vrno!='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date != ''){

            if(to_date==''){
               $('#show_err_to_date').html('Please select to date');
              return false;
            }
           }

            $('#InwardDispatch').DataTable().destroy();
            $('#InwardDispatch').hide();
            $('#table_id').DataTable().destroy();
            $('#table_id').hide();
            $('#trans_id').DataTable().destroy();
            $('#trans_id').show();
            $('#detailsbox').css('display','none');

            transaction_data(acct_code,acct_class,acct_type,pfct_code,glC_code,comp_code,from_date,to_date,vr_num);

            $("#transbtnpdf").css('display','block');
            $("#btnpdf").css('display','none');
            $("#summarybtnpdf").css('display','none');

            var totalDebitAmt= $('#totalDebitAmt').val();
            var totalCreditAmt =  $('#totalCreditAmt').val();

            $('#totl_dr_val').html(totalDebitAmt);
            $('#totl_cr_val').html(totalCreditAmt);

           if(totalDebitAmt > totalCreditAmt){
            var balenceAmt = totalDebitAmt - totalCreditAmt;
            $('#totl_balence').html(balenceAmt);
            $('#bal_type').html('Dr');
           }else if(totalCreditAmt > totalDebitAmt){
            var balenceAmt = totalCreditAmt - totalDebitAmt;
            $('#totl_balence').html(balenceAmt);
            $('#totl_balence').html('Cr');
           }else{}

          }else{
            $('#trans_id').DataTable().destroy();

            $('#InwardDispatch').DataTable().destroy();
            $('#InwardDispatch').hide();
            $('#table_id').DataTable().destroy();
            $('#table_id').hide();
            $('#trans_id').show();
            transaction_data();
             /*$('#show_err_from_date').html('Please select from date').css('color','red');
            
             $('#show_err_to_date').html('Please select to date').css('color','red');
             $('#show_err_dept_code').html('Please select depot').css('color','red');
             $('#show_err_acct_code').html('Please select account code').css('color','red');
             $('#show_err_trans').html('Please select transporter').css('color','red');*/
          }


        });



});

</script>

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

    $(document).ready(function(){

       $( window ).on( "load", function() {
            $('#totl_dr_val').html(0);
            $('#totl_cr_val').html(0);
        });

       $("#acct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("accountText").innerHTML = '';
          }else{
            document.getElementById("accountText").innerHTML = msg;
          } 

        });

       $("#acct_class").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accClassList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("accClassText").innerHTML = '';
          }else{
            document.getElementById("accClassText").innerHTML = msg;
          } 

        });

       $("#acct_type").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#acctypeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("acctypeText").innerHTML = '';
          }else{
            document.getElementById("acctypeText").innerHTML = msg;
          } 

        });

       $("#glsch_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#glschList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("glschText").innerHTML = '';
          }else{
            document.getElementById("glschText").innerHTML = msg;
          } 

        });

       $("#pfct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#pfct_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("pfct_codeText").innerHTML = '';
          }else{
            document.getElementById("pfct_codeText").innerHTML = msg;
          } 

        });

       $("#comp_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#comp_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("comp_codeText").innerHTML = '';
          }else{
            document.getElementById("comp_codeText").innerHTML = msg;
          } 

        });

       $("#glC_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#gl_codeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg == 'No Match'){
             $(this).val('');
            document.getElementById("gl_codeText").innerHTML = '';
          }else{
            document.getElementById("gl_codeText").innerHTML = msg;
          } 

        });


    });



</script>

<script type="text/javascript">

  $(document).ready(function(){

    load_data();
    $('#table_id').hide();
    $('#trans_id').hide();
        function load_data(acct_code='',acct_class='',acct_type='',pfct_code='',glC_code='',comp_code='',from_date='',to_date='',vr_num=''){


        var table =  $('#InwardDispatch').DataTable({


            footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
     
                var rowcount = data.length;
                var getRow = rowcount-1;
                var opebal = api.column(6).data();
                var baltype = api.column(7).data();
               if(opebal[getRow]){
                 var opntotl = opebal[getRow];
               }else{
                 var opntotl = 0;
               }

               if(baltype[getRow]){
                 var bal_type = baltype[getRow];
               }else{
                 var bal_type = '--';
               }
                var monTotal = api
                  .column( 1 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                  }, 0 );
          
                var tueTotal = api
                  .column( 4 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                  var twoTotal = api
                  .column( 5)
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );


                    $( api.column( 3 ).footer() ).html('Total :-').css('text-align','right');
                    $( api.column( 4).footer() ).html(parseFloat(tueTotal).toFixed(2));
                    $( api.column( 5).footer() ).html(parseFloat(twoTotal).toFixed(2));
                    $( api.column( 6).footer() ).html(opntotl);
                    $( api.column( 7).footer() ).html('<span class="label label-danger">'+bal_type+'</span>');
                    
                  },

                'fnCreatedRow': function (nRow, aData, iDataIndex) {
                
                  $(nRow).attr('onclick', "showDetail("+aData['VRNO']+",\"" + aData['TRAN_CODE'] + "\",\""+aData['acc_code']+"\",\""+aData['gl_code']+"\",\""+aData['particular']+"\");"); // or whatever you choose to set as the id
              },
              
              processing: true,
              serverSide: true,
              searching: false,
              pageLength:'25',
             
             
              language:[
                "thousand"
              ],

             

              dom : 'Bfrtip',
            
               buttons: [
                    /*{
                        extend: 'print',
                        title: 'Account Ledger Report',
                        className: "alignLeftClass",
                        
                        customize: function ( win ) {
                            $(win.document.body)
                                .css( 'font-size', '10pt' );
         
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' )
                                .css( 'color', 'black' );
                        }

                    },
                    {
                      
                          extend: 'excelHtml5',
                          
                          exportOptions: {
                                columns: [0,1,2,3,4,5,6]
                          }
                        
                    },*/
                ],

              
              ajax:{
                url:'{{ url("/report/crm/View-Crm-Ledger-Trans") }}',
                data: {acct_code:acct_code,acct_class:acct_class,acct_type:acct_type,pfct_code:pfct_code,glC_code:glC_code,comp_code:comp_code,from_date:from_date,to_date:to_date,vr_num:vr_num}
              },

              columns: [
                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    className: "crBal"
                },
               
                {
                    data:'VRDATE',
                    className: "widthClassdt",
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
                    render: function (data, type, full, meta) {


                        var vr_date = full['fy_code'];
                        var datevr = vr_date.split('-');
                        var getdate =datevr[1];
                        var series_code = full['series_code'];
                        var vr_no = full['VRNO'];
                       
                        if(getdate!='' && series_code!=''){

                          if(series_code==null){
                            seriescode='';
                          }else{
                            seriescode=series_code;
                          }
                        return  seriescode + ' ' + vr_no;
                        }else{
                          return vr_no;
                        }
                        
                    },
                    className: "alignRightClass",
                    className:"widthvrno"
                },
               
                { data:'particular',
                    render:function(data, type, full, meta){

                     console.log('fulldata',full.particular);

                     var partcular = full.particular;

                      if(partcular =='' || partcular ==null || partcular == 'To - NA :' || partcular == 'By -' || partcular=='To -'){
                        var prticulrdata = ' ';
                        var getdash = ' ';
                         return  prticulrdata;

                      }else{
                        var getdata = partcular.split(',');
                        var prticulrdata =getdata[0];
                        var getdash = '-';


                         return  prticulrdata + '&nbsp;&nbsp;&nbsp;&nbsp;<button type="button" class="btn btn-primary btn-xs viewbtnitem" data-toggle="modal" data-target="#view_detail" onclick="showparticular(\''+partcular+'\')"><i class="fa fa-info" aria-hidden="true" style="font-size: 13px;"></i> </button>';
                        
                      }
                     
                     
                    },
                    className :"particuwidth",
                },
               
                {
                    data:'DrAmt',
                    name:'DrAmt',
                    className: "alignRightClass",
                   
                },
                {
                    data:'CrAmt',
                    name:'CrAmt',
                    className: "alignRightClass",
                },
                {
                    data:'balence',
                    name:'balence',
                    className: "alignRightClass",

                  
                },
                {
                    data:'BalType',
                    className: "aligncenterClass",
                    render: function (data) {
                        var drAmt = data;
                        if(drAmt=='Cr'){
                          return '<span class="label label-success">Cr</span>';
                        }else if(drAmt=='Dr'){
                          return '<span class="label label-info ">Dr</span>';
                        }else{
                          return '<span class="label label-success">--</span>';
                        }
                    }
                },
                
                { render: function (data, type, full, meta){

                
                    if(full['REF_CODE']){

                     return full['REF_CODE']+'-'+full['REF_NAME'];

                    }else{

                      return '<span class="label label-danger">Not Found</span>';
                    }
                         

                },className:"dt-body-right"
               },

                /*{
                    data:'gl_code',
                    name:'gl_code',
                  

                },*/
                
               
              ]



          });


       }


       $('#btnsearch').click(function(){



          var from_date  =  $('#from_date').val();
          
          var to_date    =  $('#to_date').val();
          
          var acct_code  =  $('#acct_code').val();
          var acct_class =  $('#acct_class').val();
          var acct_type  =  $('#acct_type').val();
          var glsch_code =  $('#glsch_code').val();
          var pfct_code  =  $('#pfct_code').val();
          var comp_code  =  $('#comp_code').val();
          var glC_code   =  $('#glC_code').val();
         /* var vrno       =  $('#vr_num').val();


          var vrnum = vrno.split(' ');

          var vr_num = vrnum[2];*/

          var vr_num = '';

          var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
       // alert(vr_num);return false;
           

          if (acct_code!=''  || glC_code!='' || vrno!='') {


            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date != ''){

            if(to_date==''){
               $('#show_err_to_date').html('Please select to date');
              return false;
            }
           }

        
          

           /*if(glC_code){
            $(".showthforaccgl").css('display','block');
            $(".showhideaccC").css('display','block');

           }*/

        
            //$('#InwardDispatch').show();
            $('#InwardDispatch').DataTable().destroy();
            $('#InwardDispatch').show();
            $('#table_id').DataTable().destroy();
            $('#table_id').hide();
            $('#trans_id').DataTable().destroy();
            $('#trans_id').hide();
           
            load_data(acct_code,acct_class,acct_type,pfct_code,glC_code,comp_code,from_date,to_date,vr_num);

            $('.special').attr('id', 'btnpdf');

            $("#transbtnpdf").css('display','none');
            $("#btnpdf").css('display','block');
            $("#summarybtnpdf").css('display','none');

            var totalDebitAmt= $('#totalDebitAmt').val();
            var totalCreditAmt =  $('#totalCreditAmt').val();

            $('#totl_dr_val').html(totalDebitAmt);
            $('#totl_cr_val').html(totalCreditAmt);

           if(totalDebitAmt > totalCreditAmt){
            var balenceAmt = totalDebitAmt - totalCreditAmt;
            $('#totl_balence').html(balenceAmt);
            $('#bal_type').html('Dr');
           }else if(totalCreditAmt > totalDebitAmt){
            var balenceAmt = totalCreditAmt - totalDebitAmt;
            $('#totl_balence').html(balenceAmt);
            $('#totl_balence').html('Cr');
           }else{}

          }else{
            $('#InwardDispatch').DataTable().destroy();
            load_data();
             /*$('#show_err_from_date').html('Please select from date').css('color','red');
            
             $('#show_err_to_date').html('Please select to date').css('color','red');
             $('#show_err_dept_code').html('Please select depot').css('color','red');
             $('#show_err_acct_code').html('Please select account code').css('color','red');
             $('#show_err_trans').html('Please select transporter').css('color','red');*/
          }


        });


      
       $('#ResetId').click(function(){

      

        $("#transbtnpdf").css('display','none');
        $("#btnpdf").css('display','block');
        $("#summarybtnpdf").css('display','none');



          $('#trans_id').DataTable().destroy();    
          $('#table_id').DataTable().destroy();
          $('#trans_id').hide();
          $('#table_id').hide();
          $('#InwardDispatch').show();
          $('#InwardDispatch').DataTable().destroy();
          load_data();

        });

  });





</script>

<script type="text/javascript">
  
  function showparticular(partcular){

    var partculrdata = partcular.split(',');

  $("#bill_no").html(partculrdata[0]);
  $("#bill_date").html(partculrdata[1]);
  $("#bill_amt").html(partculrdata[2]);
  

  }
</script>


<script type="text/javascript">

  

  $(document).ready(function() {


    var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date,
      autoclose: 'true'
    });
  
});


$(document).ready(function() {
  
  var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();


    $('.datepicker1').datepicker({

      format: 'dd-mm-yyyy',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date,
      autoclose: 'true'

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
  
  function showDetail(vrNo,transC,acC='',glC='',particular){

    var vrNo,transC,acC,glC,particular;

    var billdata = particular.split(',');

    if(acC=='undefined'){
    	acC ='';
    }else{
    	acC;
    }
    
  

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    $.ajax({

          url:"{{ url('get-detail-from-trans-in-acc-ledger') }}",

          method : "POST",

          type: "JSON",

          data: {vrNo:vrNo,transC:transC,acC:acC,glC:glC},

          success:function(data){

              var data1 = JSON.parse(data);

              console.log(data1);
           
              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){

                  if(data1.data==''){
                   
                  }else{

                     $('#detailsbox').css('display','block');

                    $('#detailsbox').removeClass('hsdiv');

                    var partyRefN='<b class="noDataF">Not Found</b>';



                    var partyRDate ='<b class="noDataF">Not Found</b>';

                     if(billdata[0]){
                      var Bill_No = billdata[0];
                    }else{
                      var Bill_No = '<b class="noDataF">Not Found</b>';
                    }

                    if(billdata[1]){
                      var dateBill = billdata[1];
                    }else{
                      var dateBill = '<b class="noDataF">Not Found</b>';
                    }

                    if(data1.data[0].ACC_CODE){
                      var accCode = data1.data[0].ACC_CODE;
                    }else{
                      var accCode = '<b class="noDataF">Not Found</b>';
                    }

                    if(data1.data[0].GL_CODE){
                      var glCode = data1.data[0].GL_CODE;
                    }else{
                      var glCode = '<b class="noDataF">Not Found</b>';
                    }

                    $('#tNature').html('<b>T Nature </b> : '+data1.data[0].TRAN_CODE+' - '+data1.data[0]. TRAN_HEAD);

                    $('#partyBlNo').html('<b>Party Bill No </b> : '+Bill_No);
                    $('#partyBlDate').html('<b>Party Bill Date </b> : '+dateBill);
                   
                    $('#accCode').html('<b>Acc Code </b> : '+accCode);

                    $('#glCode').html('<b>Gl Code </b> : '+glCode);
                    /*$('#rate').html('<b>Rate </b> : '+rate);
                    $('#dr_amt').html('<b>Amount </b> : '+dramt);*/
                   /* $.each(obj_row, function (i, obj_row) {

                    });*/
                  }
                      
              }
          }

    });


}

</script>

<script type="text/javascript">
  
  $('#btnpdf').click(function(){

          var from_date  =  $('#from_date').val();
          
          var to_date    =  $('#to_date').val();
          
          var acct_code  =  $('#acct_code').val();
          var acct_class =  $('#acct_class').val();
          var acct_type  =  $('#acct_type').val();
          var glsch_code =  $('#glsch_code').val();
          var pfct_code  =  $('#pfct_code').val();
          var comp_code  =  $('#comp_code').val();
          var glC_code   =  $('#glC_code').val();
          var vrno       =  $('#vr_num').val();

          var vrnum = vrno.split(' ');

          var vr_num = vrnum[2];

         // var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (acct_code!='' || from_date!='' || to_date!='' || acct_class!='' || acct_type!='' || glsch_code!='' || pfct_code!='' || comp_code!='' || glC_code!='' || vr_num!='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date != ''){

            if(to_date==''){
               $('#show_err_to_date').html('Please select to date');
              return false;
            }
           }
            
                            $.ajaxSetup({
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                              });

                             $.ajax({

                                url:"{{ url('/report/acc-ledger-report-pdf/pdf') }}",

                                method : "POST",

                                type: "GET",

                                data: {acct_code:acct_code,acct_class:acct_class,acct_type:acct_type,pfct_code:pfct_code,glC_code:glC_code,comp_code:comp_code,from_date:from_date,to_date:to_date,vr_num:vr_num},

                                

                                success: function(response){

                                 console.log('response',response);

                                  if(response.response == 'success' && response.data !=''){

                                      var link = document.createElement('a');
                                      link.href = response.url;
                                      link.download = 'acc_ledger report.pdf';
                                      link.dispatchEvent(new MouseEvent('click'));


                                  }else{
                                    alert('no data');
                                  }

                                   

                                }, 

                                
                          });

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            
          }


        });
</script>


<script type="text/javascript">
  
  $('#summarybtnpdf').click(function(){

          var from_date  =  $('#from_date').val();
          
          var to_date    =  $('#to_date').val();
          
          var acct_code  =  $('#acct_code').val();
          var acct_class =  $('#acct_class').val();
          var acct_type  =  $('#acct_type').val();
          var glsch_code =  $('#glsch_code').val();
          var pfct_code  =  $('#pfct_code').val();
          var comp_code  =  $('#comp_code').val();
          var glC_code   =  $('#glC_code').val();
          var vrno       =  $('#vr_num').val();

          var vrnum = vrno.split(' ');

          var vr_num = vrnum[2];

         // var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (acct_code!='' || from_date!='' || to_date!='' || acct_class!='' || acct_type!='' || glsch_code!='' || pfct_code!='' || comp_code!='' || glC_code!='' || vr_num!='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date != ''){

            if(to_date==''){
               $('#show_err_to_date').html('Please select to date');
              return false;
            }
           }
            
                            $.ajaxSetup({
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                              });

                             $.ajax({

                                url:"{{ url('/report/acc-ledger-summary-report-pdf/pdf') }}",

                                method : "POST",

                                type: "GET",

                                data: {acct_code:acct_code,acct_class:acct_class,acct_type:acct_type,pfct_code:pfct_code,glC_code:glC_code,comp_code:comp_code,from_date:from_date,to_date:to_date,vr_num:vr_num},

                                

                                success: function(response){

                                 console.log('response',response);

                                  if(response.response == 'success' && response.data !=''){

                                      var link = document.createElement('a');
                                      link.href = response.url;
                                      link.download = 'summary.pdf';
                                      link.dispatchEvent(new MouseEvent('click'));


                                  }else{
                                    alert('no data');
                                  }

                                   

                                }, 

                                
                          });

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            
          }


        });
</script>


<script type="text/javascript">
  
  $('#transbtnpdf').click(function(){

          var from_date  =  $('#from_date').val();
          
          var to_date    =  $('#to_date').val();
          
          var acct_code  =  $('#acct_code').val();
          var acct_class =  $('#acct_class').val();
          var acct_type  =  $('#acct_type').val();
          var glsch_code =  $('#glsch_code').val();
          var pfct_code  =  $('#pfct_code').val();
          var comp_code  =  $('#comp_code').val();
          var glC_code   =  $('#glC_code').val();
          var vrno       =  $('#vr_num').val();

          var vrnum = vrno.split(' ');

          var vr_num = vrnum[2];

         // var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (acct_code!='' || from_date!='' || to_date!='' || acct_class!='' || acct_type!='' || glsch_code!='' || pfct_code!='' || comp_code!='' || glC_code!='' || vr_num!='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date != ''){

            if(to_date==''){
               $('#show_err_to_date').html('Please select to date');
              return false;
            }
           }
            
                            $.ajaxSetup({
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                              });

                             $.ajax({

                                url:"{{ url('/report/acc-ledger-transaction-report-pdf/pdf') }}",

                                method : "POST",

                                type: "GET",

                                data: {acct_code:acct_code,acct_class:acct_class,acct_type:acct_type,pfct_code:pfct_code,glC_code:glC_code,comp_code:comp_code,from_date:from_date,to_date:to_date,vr_num:vr_num},

                                

                                success: function(response){

                                 console.log('response',response);

                                  if(response.response == 'success' && response.data !=''){

                                      var link = document.createElement('a');
                                      link.href = response.url;
                                      link.download = 'transaction report.pdf';
                                      link.dispatchEvent(new MouseEvent('click'));


                                  }else{
                                    alert('no data');
                                  }

                                   

                                }, 

                                
                          });

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            
          }


        });
</script>

<script type="text/javascript">
  
  function validation(){

  
    var acct_code =  $('#acct_code').val();  
    var glC_code  =  $('#glC_code').val();
    var vrno      =  $('#vr_num').val();
    

     if(acct_code=='' && glC_code=='' && vrno==''){
            $('#show_err_code').html('Please select to Acc Code Or Gl Code');
             return false;
           }else{
            $('#show_err_code').html('');
           }
  }
</script>


@endsection
