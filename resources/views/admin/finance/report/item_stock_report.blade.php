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

  .table-hover tbody tr:hover td, .table-hover tbody tr:hover th {
    background-color: #c2d9ff;
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

  .crBal{
    display:none;
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
  .vdateAlign{
    text-align: center;
    width: 12%;
  }

  .alignRightClass{
    text-align: right;
  }

  .alignCenterClass{
    text-align: center;
  }

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

 }

 .radiolabel input {
  margin-right:20px;
  margin-left: 20px;
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
.hiddencolum{
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
  
   .texIndbox1{
    width: 5%; 
    text-align: center;
  }
  .rateIndbox{
    width: 15%;
    text-align: center;
  }
  .itmdetlheading{
    vertical-align: middle !important;
    text-align: left;
  }
  .modltitletext {
    font-weight: 800;
    color: #5696bb;
    text-align: center;
    font-size: 16px;
  }
  .hsdiv{
    display: none;
  }
  .noDataF{
    color: #f65371;
  }

  .grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto;
  grid-gap: 10px;
  /*background-color: #2196F3;*/
  /*padding: 10px;*/
}
</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Item Stock Summary Report
            <small> Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">List Item Stock Summary Report</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Item Stock Summary Report</h2>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->



            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">



               @csrf

                <?php date_default_timezone_set('Asia/Kolkata'); ?>

              <div class="row">

               <div class="col-md-2">

                   <div class="form-group">

                    <?php $FromDate= date("d-m-Y", strtotime($fromDate));  
                         $ToDate= date("d-m-Y", strtotime($toDate)); 
                         $CurrentDate =date("d-m-Y");

                          ?>

                      <label for="exampleInputEmail1"> From Date: </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                       <input type="hidden" value="{{$FromDate}}" id="frmDate">
                        <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="Select Transaction Date" value="{{$FromDate}} " autocomplete="off">

                      </div>

                      <small id="showmsgfrdate"></small>
                      
                      <small id="show_err_from_date">

      

                      </small>

                  </div>

                 </div> 
 
                



                 <div class="col-md-2">

                   <div class="form-group">

                      <label for="exampleInputEmail1"> To Date: </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                        <input type="hidden" value="{{$CurrentDate}}" id="todateVal">
                        <input type="text" name="to_date" id="to_date" class="form-control datepicker1" placeholder="Select Transaction Date" value="{{$CurrentDate}}" autocomplete="off">

                      </div>

                      <small id="showmsgtodate"></small>

                      <small id="show_err_to_date">

                      </small>

                  </div>

                 </div>

                 
                <!-- /.col -->

                <div class="col-md-2">

                   <div class="form-group">

                      <label for="exampleInputEmail1">ITEM LIST : 

                         <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="itemList"  name="item" id="item" class="form-control" placeholder="Select Item" value="ITEM CODE" autocomplete="off">

                           <datalist id="itemList"> 
                             
                             <option  value ="ITEM CODE">ITEM CODE</option>
                             <option  value ="ITEM TYPE">ITEM TYPE</option>
                             <option  value ="ITEM CATEGORY">ITEM CATEGORY</option>
                             <option  value ="ITEM CLASS">ITEM CLASS</option>
                             <option  value ="ITEM GROUP">ITEM GROUP</option>
                           
                          </datalist>


                      </div>
                      <small id="itemerr" style="color:red;"></small>

                      <small>  

                        <div class="pull-left showSeletedName" id="itemText"></div>

                     </small>

                     <small id="show_err_item">

                        

                     </small>

                  </div>

                  
                </div>

                <div class="col-md-6 text-center">

                  <div class="form-group">

                      <label for="exampleInputEmail1" > Report Type  </label>

                      <div class="input-group">

                      <div class="grid-container" style="margin-top:-3px;">
                        <div class="item2">
                         <input type="radio" class="optionsRadios1" name="qtyvalradio" id="qtyonly" value="clsqty" checked="">&nbsp;&nbsp;&nbsp;<b>Closing Qty & Value</b><br>
                         <p style="margin-top:6%;text-align:center;">(column 2)</p>
                        </div>

                        <div class="item3">
                          <input type="radio" class="optionsRadios1" name="qtyvalradio" id="qtyvalue" value="qtyonly" >&nbsp;&nbsp;&nbsp;<b>Quantity Only</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>
                          <p style="margin-top:6%;text-align:center;">(column 4)</p>
                        </div>  

                        <div class="item4">
                          <input type="radio" class="optionsRadios1" name="qtyvalradio" id="qtyvalue" value="qtyvalue" >&nbsp;&nbsp;&nbsp;<b>Quantity & Value</b><br>
                          <p style="margin-top:6%;text-align:center;">(column 8)</p>
                        </div>
                        
                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="pfctText"></div>

                     </small>

                     <small id="show_err_dept_code">

                      </small>
                     
                  </div>

                </div>
              
              </div>

                

                

              </div><!-- /.row -->

              

              <div class="row">

                 <div class="col-md-3">

                 
                  <div class="form-group">

                      <label for="exampleInputEmail1">Quantity Type : </label>

                      <div class="input-group">

                      
                          <input type="radio" id="quantity" name="qtyradio"  value="quantity" checked=""> &nbsp; <b>Quantity</b> &nbsp;&nbsp;
                          <input type="radio" id="aquantity" name="qtyradio" value="aquantity">  &nbsp; <b>AQuantity</b>


                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="pfctText"></div>

                     </small>

                     <small id="show_err_dept_code">

                      </small>
                     
                  </div>

                </div>

                <div class="col-md-6 text-center" style="margin-top: 0.5%;">

                 <div class="">

                 <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch" style="padding: 0px;width: 78px;"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                  <button type="reset" class="btn btn-warning" name="searchdata" id="" style="width:80px;" onClick="window.location.reload()"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

                 

                </div>

              </div>
               </div>

               <div class="row">

                <div class="col-md-4"></div>
                 
              </div>

              

            
               

             </form>

            </div><!-- /.box-body -->



<div class="box-body divScroll" style="margin-top: 0%;">

<table id="InwardDispatch" class="table table-bordered table-striped table-hover itmLedger tableScroll">

  <thead class="theadC">

    

    <tr>
      <th class="text-center" style="width: 5%;">Sr. No</th>
      <th class="text-center" id="itemlable" style="width:25%">Item</th>
      
      <th class="text-center" style="text-align: center !important;">OP.QTY</th>
      <!--  <th class ="text-center">T-Code</th> -->
      <th class="text-center" style="text-align: center !important;">RECEIVED QTY</th>
      <th class="text-center" style="text-align: center !important;">ISSUED QTY</th>
      <th class="text-center" style=";text-align: center !important;">BAL.QTY</th>
      
    
      

    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>
  <tfoot align="right">
    <tr>
      <th></th><th></th><th></th><th></th><th></th><th></th>
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
      <th class="text-center">ITEM</th>
      <th class="text-center" style="text-align: center !important;">CLO.QTY. </th>
      <!-- <th class="text-center">T Nature </th> -->
      <th class="text-center" style="text-align: center !important;">CLO.VAL </th>
     
     
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

<table id="QtyOnly" class="table table-bordered table-striped table-hover">

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
      <th class="text-center">ITEM</th>
      <th class=""style="text-align: center !important;">OPP.QTY. </th>
      <th class="text-center"style="text-align: center !important;">RECED QTY</th>
      <th class="text-center"style="text-align: center !important;">ISSUED QTY</th>
      <th class="text-center"style="text-align: center !important;">CLO.QTY </th>
     
     
      <!-- <th class="text-center showhideGl">Gl Code </th>  -->
      

    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>

  <tfoot align="right">
    <tr>
      <th></th><th></th><th></th><th></th><th></th><th></th>
    </tr>
  </tfoot>
  

</table>

<table id="QtyValue" class="table table-bordered table-striped table-hover">

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
       <th class="text-center">ITEM</th>
       <th class="">OPP.QTY. </th>
       <th class="text-center">RECED QTY</th>
       <th class="text-center">ISSUED QTY</th>
       <th class="text-center">CLO.QTY </th>
       <th class="" width="10%">OPP.VAL. </th>
       <th class="text-center">CRAMT</th>
       <th class="text-center">DRAMT</th>
       <th class="text-center">CLO.VAL </th>
     
     
      <!-- <th class="text-center showhideGl">Gl Code </th>  -->
      

    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>

  <tfoot align="right">
    <tr>
      <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
    </tr>
  </tfoot>
  

</table>

</div><!-- /.box-body -->

<div class="box-body hsdiv" style="margin-top: 0%;" id="detailsbox">
  <div class="row" style="border: 1px solid #d2d6de;margin: 5px;padding-top:30px;padding-bottom:30px;box-shadow: 0px 0px 8px -3px rgb(0 0 0 / 75%);border-radius: 5px;">

      <div class='row' style="margin-left: 20px;">
        <div class="col-md-4">
        <p id="tNature"></p>
        </div>
        <div class="col-md-4">
        <p id="qtyrecd"></p>
        </div>
        <div class="col-md-4">
        <p id="qtyissued"></p>
        </div>
      </div>
      
      <div class='row' style="margin-left: 20px;">
        <div class="col-md-4">
           <p id="accCode"></p>
        </div>
        <div class="col-md-4">
          <p id="rate"></p>
        </div>
        <div class="col-md-4">
          <p id="dr_amt"></p>
        </div>
         
      </div>
      <div class='row' style="margin-left: 20px;">
        <div class="col-md-4">
          <p id="particuler"></p>
        </div>
      </div>

  </div>
</div>
  </section>

</div>

<div class="modal fade" id="QueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document" style="width: 400px;">
      <div class="modal-content" style='border-radius: 5px;
    -webkit-box-shadow: 0px 1px 8px 0px rgb(0 0 0 / 75%);
    -moz-box-shadow: 0px 1px 8px 0px rgba(0,0,0,0.75);
    box-shadow: 0px 1px 8px 0px rgb(0 0 0 / 75%'>
        <div class="modal-header" style='text-align:center'>
          <div class="modal-title" id="queryModalLabel" style="font-size: 135%;font-weight: 800;">Query</div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="fa fa-times-circle-o" aria-hidden="true"></i>
          </button>
        </div>
        <div class="modal-body">
          <section>
            <div class="row">
              
              <div class="col-sm-12">
                <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Query Fields</th>
                  <th scope="col" class="text-center">Values</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th>1</th>
                  <td class='QueryTableTd'>Item Type :</td>
                 <td>
                 <input list="itemnList" id="itemtype_code" name="itemtype_code" class="form-control  pull-left" value="{{ old('item_code')}}" placeholder="Select Item Code" autocomplete="off">



                          <datalist id="itemnList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($itemt_list as $key)

                            

                            <option value='<?php echo $key->ITEMTYPE_CODE?>'   data-xyz ="<?php echo $key->ITEM_TYPE_NAME; ?>" ><?php echo $key->ITEM_TYPE_NAME ; echo " [".$key->ITEMTYPE_CODE."]" ; ?></option>

                            

                            @endforeach

                          </datalist>
                          </td>
                </tr>
                <tr>
                  <th>2</th>
                  <td class='QueryTableTd'>Item Category :</td>
                  <td style="text-align: center;">
                    <input list="itemcatList" name="item_category" id="item_category" class="form-control" placeholder="Select Item Category"  autocomplete="off">

                        <datalist id="itemcatList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($itemcc_list as $key)

                            

                            <option value='<?php echo $key->ICATG_CODE?>'   data-xyz ="<?php echo $key->ICATG_NAME; ?>" ><?php echo $key->ICATG_NAME ; echo " [".$key->ICATG_CODE."]" ; ?></option>

                            

                            @endforeach

                          </datalist>
                  </td>
                
                </tr>
                <tr>
                  <th>3</th>
                  <td class='QueryTableTd'>Item Group. :</td>
                  <td style="text-align: center;">
                     <input list="itemgroupList" name="item_group" id="item_group" class="form-control" placeholder="Select Item Group" autocomplete="off">


                        <datalist id="itemgroupList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($itemg_list as $key)

                            

                            <option value='<?php echo $key->ITEMGROUP_CODE ?>'   data-xyz ="<?php echo $key->ITEMGROUP_NAME; ?>" ><?php echo $key->ITEMGROUP_NAME ; echo " [".$key->ITEMGROUP_CODE ."]" ; ?></option>

                            

                            @endforeach

                          </datalist>
                  </td>
                 
                </tr>
                <tr>
                  <th>4</th>
                  <td class='QueryTableTd'>Item Class. :</td>
                  <td style="text-align: center;">
                    <input list="itemclassList" id="item_class" name="item_class" class="form-control  pull-left" value="" placeholder="Select Item Class" autocomplete="off">



                          <datalist id="itemclassList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($itemc_list as $key)

                            

                            <option value='<?php echo $key->ITEMCLASS_CODE?>'   data-xyz ="<?php echo $key->ITEMCLASS_NAME; ?>" ><?php echo $key->ITEMCLASS_NAME ; echo " [".$key->ITEMCLASS_CODE."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                  </td>
                 
                </tr>
                <tr>
                  <th>5</th>
                  <td class='QueryTableTd'>Item Age Analysis :</td>
                  <td style="text-align: center;">
                    <input list="itemageList" id="item_age" name="item_age" class="form-control  pull-left" value="" placeholder="Select Item Age">



                          <datalist id="itemageList">

                            <option  value="FIFO" data-xyz="FIFO">FIFO</option>

                            <option  value="batch" data-xyz="Batch">BATCHWISE</option>


                          </datalist>

                  </td>
                 
                </tr>
               
                

                
              </tbody>
            </table>
              </div>
              
            </div>
          </section>  
        </div>
        <div class="modal-footer" style='text-align:center;'>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close &nbsp;&nbsp;<i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
          <button type="button" id="ProceedBtnId" class="btn btn-primary">Proceed &nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button>
        </div>
      </div>
    </div>
  </div>



@include('admin.include.footer')
<!-- 
<script type="text/javascript" src="//cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script> -->

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



      $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

         if(msg=='No Match'){

             $(this).val('');
             document.getElementById("itemText").innerHTML = '';

          }else{
             document.getElementById("itemText").innerHTML = msg;
          }


        });



       $("#pfct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#pfctList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          if(msg == 'No Match'){
            document.getElementById("pfctText").innerHTML = ''; 
            var val = $(this).val('');
          }else{
            document.getElementById("pfctText").innerHTML = msg; 
          }

          

        });


       $("#series_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#seriesList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("seriesText").innerHTML = msg; 

        });





      

    });



  

</script>

<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(item_code= '', getqty='',getqtyval='',from_date='',to_date=''){

         /* $("#basic").hide();
          $("#cls_qty").hide();*/

          var date1 = new Date();
          var month = date1.getMonth() + 1;
          var tdate = date1.getDate();
          var mn = month.toString().length > 1 ? month : "0" + month;
          var yr = date1.getFullYear();
          var hr =  date1.getHours(); 
          var min = date1.getMinutes();
          var sec = date1.getSeconds(); 

          var curr_date = tdate+''+mn+''+yr;
          var curr_time = hr+':'+min+':'+sec;
     $('#table_id').hide();
     $('#QtyOnly').hide();
     $('#QtyValue').hide();
      $('#InwardDispatch').DataTable({
           
          

            footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
                var dataobject = api.column(5).data();
                if(dataobject[0] < 0){
                  $('#totl_issu_qty').html(dataobject[0]);
                }else{
                  $('#totl_recv_qty').html(dataobject[0]);
                }
                //$('#getval').html(dataobject[0]);
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var rowcount = data.length;
                
                var getRow = rowcount-1;
                var opebal = api.column(5).data();

                if(rowcount > 0){
                   $('.buttons-excel').attr('disabled',false);
                }else{
                   $('.buttons-excel').attr('disabled',true);
                }

                if(opebal[getRow]){
                 var closngQty = opebal[getRow];
                }else{
                 var closngQty = 0;
                }
     
                var tueTotal = api
                  .column( 2 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );


                var twoTotal = api
                  .column( 3 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                var threeTotal = api
                  .column( 4 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                  var fourTotal = api
                  .column( 5 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

              


                   

                    $( api.column( 2 ).footer() ).html(parseFloat(tueTotal).toFixed(2));

                    $( api.column( 3 ).footer() ).html(parseFloat(twoTotal).toFixed(2));

                    $( api.column( 4 ).footer() ).html(parseFloat(threeTotal).toFixed(2));
                    $( api.column( 5 ).footer() ).html(parseFloat(fourTotal).toFixed(2));

                  },

              
              processing: true,
              serverSide: true,
              responsive: true,
              scrollX: true,
              pageLength:'25',
              dom: "<'top'<'row'  <'col-sm-12'>>" +"<'row'<'col-sm-4'B><'col-sm-4'<'toolbar'> ><'col-sm-4'f>>><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
              columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
              }],

               buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'item_stock_summary_report_'+curr_date+'_'+curr_time,
                        footer: true
                    },
                   
                ],
              ajax:{
                url:'{{ url("/report-item-stock") }}',
                data: {item_code:item_code,getqty:getqty,getqtyval:getqtyval,from_date:from_date,to_date:to_date},
                 
              },
              columns: [

                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    className: "alignCenterClass",
                },
                {
                     render: function (data, type, full, meta) {

                     

                      if(full['ITEMTYPE_CODE']){

                        $("#itemlable").html('ITEM TYPE');
                        var ITEM = full['ITEMTYPE_CODE']+'-'+full['ITEM_TYPE_NAME'];

                      }else if(full['ITEMCLASS_CODE']){
                        $("#itemlable").html('ITEM CLASS');
                        var ITEM = full['ITEMCLASS_CODE']+'-'+full['ITEMCLASS_NAME'];

                      }else if(full['ITEMGROUP_CODE']){
                        $("#itemlable").html('ITEM GROUP');
                        var ITEM = full['ITEMGROUP_CODE']+'-'+full['ITEMGROUP_NAME'];

                      }else if(full['ICATG_CODE']){
                        $("#itemlable").html('ITEM CATEGORY');
                        var ITEM = full['ICATG_CODE']+'-'+full['ICATG_NAME'];
                      }
                      else if(full['ITEM_CODES']){
                        $("#itemlable").html('ITEM CODE');
                        var ITEM = full['ITEM_CODES']+'-'+full['ITEM_NAMES'];
                      }else{

                         var ITEM = '---';
                      }

                      
                        return ITEM;
                        
                    },
                   
                },
                { data:'OPQTY',
                  name:'OPQTY',
                  className:'text-right' 
                    
                    
                },

                {
                  data:'QTYRECD',
                  name:'QTYRECD',
                  className:'alignRightClass', 
                  render: function (data, type, full, meta) {

                     console.log('fulldata',full);
                      if(full['UM_CODE']){

                        
                        var QTYRECD = full['QTYRECD']+' - '+'<small class="label label-primary"><i class="fa fa-cross"></i>'+full['UM_CODE']+'</small>';

                        

                      }else if(full['AUM_CODE']){
                        var QTYRECD = full['QTYRECD']+' - '+'<small class="label label-primary"><i class="fa fa-cross"></i>'+full['AUM_CODE']+'</small>';

                        
                      }
                     else{

                         var QTYRECD = '---';
                      }
                        return QTYRECD;

                      
                       
                        
                    },
                  
                },
               
                { data:'QTYISSUED',
                  name:'QTYISSUED',
                  className:'alignRightClass',
                  render: function (data, type, full, meta) {

                     

                      if(full['QTYISSUED']){

                        
                        var QTYISSUED = full['QTYISSUED']+' - '+full['UM_CODE'];
                      }

                     else{

                         var QTYISSUED = '---';
                      }

                      
                        return QTYISSUED;
                        
                    },
                },

                { data:'balance',
                  name:'balance',
                  className:'alignRightClass'
                  
                },
               
             
                
             
                
               

              ],


          });

           //$("div.toolbar").html('<span class="label label-danger" style="margin-right: 32%;font-size: 12px;">Opening Bal : <b id="getval"></b></span>').css('text-align','center');

       }



   /* $('#qtyonly').click(function(){

              // $('#itemlable').addClass('hiddencolum');
               
               $('#opn_qty').addClass('hiddencolum');
               
               $('#recev_qty').addClass('hiddencolum');
               $('#issued_qty').addClass('hiddencolum');

    


    });

*/

       $('#btnsearch').click(function(){



          var from_date =  $('#from_date').val();
          
          var to_date   =  $('#to_date').val();
          
          var item_code =  $('#item').val();

         // alert(item_code);return false;

         if(item_code==''){

          $("#itemerr").html('item field is required-field');

          return false;

         }else{
          $("#itemerr").html('');
         }

         var getqty1 = $("input[name='qtyradio']:checked").val();

         if(getqty1){


            var getqty =  getqty1;

          }

        var getqtyval1 = $("input[name='qtyvalradio']:checked").val();

          if(getqtyval1){

            var getqtyval =  getqtyval1;
          }
      
          var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();

         //alert(getqty);

         

          if (item_code!='' || getqty!='' || getqtyval!='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');
            $('#show_err_item').html('');

            if(from_date!=''){
                  if(to_date==''){
                    $('#show_err_to_date').html('Please select to date').css('color','red');
                  //  setTimeout(function(){$('#show_err_to_date').html('');},4000);
                    return false;
                  }
                }

                if(to_date!=''){
                  if(from_date==''){
                    $('#show_err_from_date').html('Please select from date').css('color','red');
                  //  setTimeout(function(){$('#show_err_from_date').html('');},4000);
                    return false;
                  }
                }

               // alert(getqtyval);
           if(getqtyval=='clsqty'){

            
            $('#InwardDispatch').DataTable().destroy();
            $('#InwardDispatch').hide();
            $('#QtyOnly').DataTable().destroy();
            $('#QtyOnly').hide();
            $('#QtyValue').DataTable().destroy();
            $('#QtyValue').hide();
            $('#table_id').DataTable().destroy();
            $('#table_id').show();

            //alert(item_code);

            loadclsqty_data(item_code,getqty,getqtyval,from_date,to_date);

           }else if(getqtyval=='qtyonly'){

            $('#InwardDispatch').DataTable().destroy();
            $('#InwardDispatch').hide();
            $('#table_id').DataTable().destroy();
            $('#table_id').hide();
            $('#QtyValue').DataTable().destroy();
            $('#QtyValue').hide();
            $('#QtyOnly').DataTable().destroy();
            $('#QtyOnly').show();

            loadqtyonly_data(item_code,getqty,getqtyval,from_date,to_date);

           }else if(getqtyval=='qtyvalue'){

            $('#InwardDispatch').DataTable().destroy();
            $('#InwardDispatch').hide();
            $('#table_id').DataTable().destroy();
            $('#table_id').hide();
            $('#QtyOnly').DataTable().destroy();
            $('#QtyOnly').hide();
            $('#QtyValue').DataTable().destroy();
            $('#QtyValue').show();

            loadqtyvalue_data(item_code,getqty,getqtyval,from_date,to_date);
           }else{
  

            $('#InwardDispatch').DataTable().destroy();
            $('#InwardDispatch').show();
            $('#table_id').hide();
            $('#table_id').DataTable().destroy();

            load_data(item_code,getqty,getqtyval,from_date,to_date);
           }
                
           

          }else{
            
          // var table =  $('#InwardDispatch').DataTable();

            var t =  $('#InwardDispatch').DataTable();

            t.destroy();

            load_data();
             /*$('#show_err_from_date').html('Please select from date').css('color','red');
            
             $('#show_err_to_date').html('Please select to date').css('color','red');
             $('#show_err_dept_code').html('Please select depot').css('color','red');
             $('#show_err_acct_code').html('Please select account code').css('color','red');
             $('#show_err_trans').html('Please select transporter').css('color','red');*/
          }


        });

       $('#ResetId').click(function(){

              
              
              $('#item_code').val('');
              
              $('#pfct_code').val('');
              $('#vr_num').val('');

          document.getElementById("itemText").innerHTML = '';
          document.getElementById("pfctText").innerHTML = '';
          $('#InwardDispatch').DataTable().destroy();
          load_data();

        });





  });


</script>

<script type="text/javascript">



function loadclsqty_data(item_code='',getqty='',getqtyval='',from_date='',to_date=''){

   
   var t =  $('#table_id').DataTable({

    footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
                var dataobject = api.column(3).data();
                if(dataobject[0] < 0){
                  $('#totl_issu_qty').html(dataobject[0]);
                }else{
                  $('#totl_recv_qty').html(dataobject[0]);
                }
                //$('#getval').html(dataobject[0]);
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var rowcount = data.length;
                
                var getRow = rowcount-1;
                var opebal = api.column(3).data();

                var tueTotal = api
                  .column( 2 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );


                var twoTotal = api
                  .column( 3 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
               


                    $( api.column( 2 ).footer() ).html(parseFloat(tueTotal).toFixed(2));

                    $( api.column( 3 ).footer() ).html(parseFloat(twoTotal).toFixed(2));

                  },

              processing: true,
              serverSide: true,
              searching: true,
             /* scrollX: true,*/
              pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
             
             
              language:[
                "thousand"
              ],
               buttons: [{
                          extend: 'excelHtml5',
                          exportOptions: {
                                columns: [0,1,2,3,4]
                          }
                        }
                        ],

              
              ajax:{
                url:'{{ url("/report-item-stock") }}',
                data: {item_code:item_code,getqty:getqty,getqtyval:getqtyval,from_date:from_date,to_date:to_date},
                 
              },

              columns: [
                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    className: "alignCenterClass"
                },
               {
                     render: function (data, type, full, meta) {

                     

                      if(full['ITEMTYPE_CODE']){

                        $("#itemlable").html('ITEM TYPE');
                        var ITEM = full['ITEMTYPE_CODE']+'-'+full['ITEM_TYPE_NAME'];

                      }else if(full['ITEMCLASS_CODE']){
                        $("#itemlable").html('ITEM CLASS');
                        var ITEM = full['ITEMCLASS_CODE']+'-'+full['ITEMCLASS_NAME'];

                      }else if(full['ITEMGROUP_CODE']){
                        $("#itemlable").html('ITEM GROUP');
                        var ITEM = full['ITEMGROUP_CODE']+'-'+full['ITEMGROUP_NAME'];

                      }else if(full['ITEM_CODES']){
                        $("#itemlable").html('ITEM CODE');
                        var ITEM = full['ITEM_CODES']+'-'+full['ITEM_NAMES'];
                      }else if(full['ICATG_CODE']){
                        $("#itemlable").html('ITEM CATEGORY');
                        var ITEM = full['ICATG_CODE']+'-'+full['ICATG_NAME'];
                      }else{

                         var ITEM = '---';
                      }

                      
                        return ITEM;
                        
                    },
                   
                },
                { data:'CLSQTY',
                  name:'CLSQTY',
                  className:'alignRightClass'
                    
                },

                { data:'CLSVAL',
                  name:'CLSVAL',
                 className:'alignRightClass'

                  
                },
            

                ],
          });

}


</script>
<script type="text/javascript">



function loadqtyonly_data(item_code='',getqty='',getqtyval='',from_date='',to_date=''){

   
   var t =  $('#QtyOnly').DataTable({

              footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
                var dataobject = api.column(5).data();
                if(dataobject[0] < 0){
                  $('#totl_issu_qty').html(dataobject[0]);
                }else{
                  $('#totl_recv_qty').html(dataobject[0]);
                }
                //$('#getval').html(dataobject[0]);
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var rowcount = data.length;
                
                var getRow = rowcount-1;
                var opebal = api.column(5).data();

                if(opebal[getRow]){
                 var closngQty = opebal[getRow];
                }else{
                 var closngQty = 0;
                }
     
                var tueTotal = api
                  .column( 2 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );


                var twoTotal = api
                  .column( 3 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                var threeTotal = api
                  .column( 4 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                  var fourTotal = api
                  .column( 5 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );


                   

                    $( api.column( 2 ).footer() ).html(parseFloat(tueTotal).toFixed(2));

                    $( api.column( 3 ).footer() ).html(parseFloat(twoTotal).toFixed(2));

                    $( api.column( 4 ).footer() ).html(parseFloat(threeTotal).toFixed(2));

                    $( api.column( 5 ).footer() ).html(parseFloat(fourTotal).toFixed(2));
                    
                  },


              processing: true,
              serverSide: true,
              searching: true,
             // scrollX: true,
              pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
             
             
              language:[
                "thousand"
              ],
               buttons: [{
                          extend: 'excelHtml5',
                          exportOptions: {
                                columns: [0,1,2,3,4,5,6,7]
                          }
                        }
                        ],

              
              ajax:{
                url:'{{ url("/report-item-stock") }}',
                data: {item_code:item_code,getqty:getqty,getqtyval:getqtyval,from_date:from_date,to_date:to_date},
                 
              },

              columns: [
                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    className: "alignCenterClass"
                },
               {
                     render: function (data, type, full, meta) {

                     

                      if(full['ITEMTYPE_CODE']){

                        $("#itemlable").html('ITEM TYPE');
                        var ITEM = full['ITEMTYPE_CODE']+'-'+full['ITEM_TYPE_NAME'];

                      }else if(full['ITEMCLASS_CODE']){
                        $("#itemlable").html('ITEM CLASS');
                        var ITEM = full['ITEMCLASS_CODE']+'-'+full['ITEMCLASS_NAME'];

                      }else if(full['ITEMGROUP_CODE']){
                        $("#itemlable").html('ITEM GROUP');
                        var ITEM = full['ITEMGROUP_CODE']+'-'+full['ITEMGROUP_NAME'];

                      }else if(full['ICATG_CODE']){
                        $("#itemlable").html('ITEM CATEGORY');
                        var ITEM = full['ICATG_CODE']+'-'+full['ICATG_NAME'];
                      }else if(full['ITEM_CODES']){
                        $("#itemlable").html('ITEM CODE');
                        var ITEM = full['ITEM_CODES']+'-'+full['ITEM_NAMES'];
                      }else{

                         var ITEM = '---';
                      }

                      
                        return ITEM;
                        
                    },
                   
                },
                { data:'OPQTY',
                  name:'OPQTY',
                  className:'alignRightClass'
                  
                },

                { data:'QTYRECD',
                  name:'QTYRECD',
                  className:'alignRightClass'

                },
                { data:'QTYISSUED',
                  name:'QTYISSUED',
                  className:'alignRightClass'
                },
                { data:'CLSQTY',
                  name:'CLSQTY',
                  className:'alignRightClass'
                },
            

                ],
          });

}


</script>

<script type="text/javascript">



function loadqtyvalue_data(item_code='',getqty='',getqtyval='',from_date='',to_date=''){

   
   var t =  $('#QtyValue').DataTable({


              footerCallback: function ( row, data, start, end, display ) {
                var api = this.api(), data;
                var dataobject = api.column(9).data();
                if(dataobject[0] < 0){
                  $('#totl_issu_qty').html(dataobject[0]);
                }else{
                  $('#totl_recv_qty').html(dataobject[0]);
                }
                //$('#getval').html(dataobject[0]);
     
                // converting to interger to find total
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                var rowcount = data.length;
                
                var getRow = rowcount-1;
                var opebal = api.column(9).data();

                if(opebal[getRow]){
                 var closngQty = opebal[getRow];
                }else{
                 var closngQty = 0;
                }
     
                var tueTotal = api
                  .column( 2 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );


                var twoTotal = api
                  .column( 3 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                var threeTotal = api
                  .column( 4 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                  var fourTotal = api
                  .column( 5 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                var fiveTotal = api
                  .column( 6 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                  var sixTotal = api
                  .column( 7 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                  var sevenTotal = api
                  .column( 8 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );

                  var eightTotal = api
                  .column( 9 )
                  .data()
                  .reduce( function (a, b) {
                      return intVal(a) + intVal(b);
                }, 0 );
                  
                   

                    $( api.column( 2 ).footer() ).html(parseFloat(tueTotal).toFixed(2));

                    $( api.column( 3 ).footer() ).html(parseFloat(twoTotal).toFixed(2));

                    $( api.column( 4 ).footer() ).html(parseFloat(threeTotal).toFixed(2));
                    $( api.column( 5 ).footer() ).html(parseFloat(fourTotal).toFixed(2));

                    $( api.column( 6 ).footer() ).html(parseFloat(fiveTotal).toFixed(2));
                    $( api.column( 7 ).footer() ).html(parseFloat(sixTotal).toFixed(2));
                    $( api.column( 8 ).footer() ).html(parseFloat(sevenTotal).toFixed(2));
                    $( api.column( 9 ).footer() ).html(parseFloat(eightTotal).toFixed(2));
                    
                  },

              processing: true,
              serverSide: true,
              searching: true,
              scrollX: true,
              pageLength:'25',
              dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
             
             
              language:[
                "thousand"
              ],
               buttons: [{
                          extend: 'excelHtml5',
                          exportOptions: {
                                columns: [0,1,2,3,4,5,6,7]
                          }
                        }
                        ],

              
              ajax:{
                url:'{{ url("/report-item-stock") }}',
                data: {item_code:item_code,getqty:getqty,getqtyval:getqtyval,from_date:from_date,to_date:to_date},
                 
              },

              columns: [
                {
                    data:'DT_RowIndex',
                    name:'DT_RowIndex',
                    className: "alignCenterClass"
                },
               {
                     render: function (data, type, full, meta) {

                     

                      if(full['ITEMTYPE_CODE']){

                        $("#itemlable").html('ITEM TYPE');
                        var ITEM = full['ITEMTYPE_CODE']+'-'+full['ITEM_TYPE_NAME'];

                      }else if(full['ITEMCLASS_CODE']){
                        $("#itemlable").html('ITEM CLASS');
                        var ITEM = full['ITEMCLASS_CODE']+'-'+full['ITEMCLASS_NAME'];

                      }else if(full['ITEMGROUP_CODE']){
                        $("#itemlable").html('ITEM GROUP');
                        var ITEM = full['ITEMGROUP_CODE']+'-'+full['ITEMGROUP_NAME'];

                      }else if(full['ICATG_CODE']){
                        $("#itemlable").html('ITEM CATEGORY');
                        var ITEM = full['ICATG_CODE']+'-'+full['ICATG_NAME'];
                      }else if(full['ITEM_CODES']){
                        $("#itemlable").html('ITEM CODE');
                        var ITEM = full['ITEM_CODES']+'-'+full['ITEM_NAMES'];
                      }else{

                         var ITEM = '---';
                      }

                      
                        return ITEM;
                        
                    },
                   
                },
                { data:'OPQTY',
                  name:'OPQTY', 
                  
                },

                { data:'QTYRECD',
                  name:'QTYRECD', 
                },

                { data:'QTYISSUED',
                  name:'QTYISSUED',

                },
                { data:'CLSQTY',
                  name:'CLSQTY',
                },
                { data:'OPVAL',
                  name:'OPVAL',

                },

                { data:'CRAMT',
                  name:'CRAMT',
                },
                
                { data:'DRAMT',
                  name:'DRAMT',
                },
                { data:'CLSVAL',
                  name:'CLSVAL',
 
                },
            

                ],
          });

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

    $('#from_date').on('change',function(){

      var frDate = $('#from_date').val();
      
      var slipD =  frDate.split('-');
      var Tdate = slipD[0];
      var Tmonth = slipD[1];
      var Tyear = slipD[2];
      var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;
      var selectedDate = new Date(getproperDate);
      var todayDate = new Date();
        if(selectedDate > todayDate){
          $('#showmsgfrdate').html('To Date Can Not Be Greater Than Today').css('color','red');
          $('#from_date').val('');
          var getfrDate = $('#frmDate').val();
          $('#from_date').val(getfrDate);
          return false;
        }else{
          $('#showmsgfrdate').html('');
          return true;
        }
    });


    $('#to_date').on('change',function(){

      var toDate = $('#to_date').val();
      var slipD =  toDate.split('-');
      var Tdate = slipD[0];
      var Tmonth = slipD[1];
      var Tyear = slipD[2];
      var getproperDate = Tmonth+'-'+Tdate+'-'+Tyear;
      var selectedDate = new Date(getproperDate);
      var todayDate = new Date();

        if(selectedDate > todayDate){
          $('#to_date').val('');
          $('#showmsgtodate').html('To Date Can Not Be Greater Than Today').css('color','red');
          var todt = $('#todateVal').val();
          $('#to_date').val(todt);
          return false;
        }else{
          $('#showmsgtodate').html('');
          return true;
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


});


function showDetail(vrNo,transC,itmC){

    var vrNo,transC,itmC;


    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    $.ajax({

          url:"{{ url('get-detail-from-trans-in-item-ledger') }}",

          method : "POST",

          type: "JSON",

          data: {vrNo:vrNo,transC:transC,itmC:itmC},

          success:function(data){

              var data1 = JSON.parse(data);

              console.log(data1);

              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

              }else if(data1.response == 'success'){

                  if(data1.data==''){
                   
                  }else{

                    $('#detailsbox').removeClass('hsdiv');

                    if(data1.data[0].PREFNO){
                      var partyRefN = data1.data[0].PREFNO;
                    }else{
                      var partyRefN = '<b class="noDataF">Not Found</b>';
                    }

                    if(data1.data[0].AQTYRECD){
                      var purBillNo = data1.data[0].AQTYRECD;
                    }else{
                      var purBillNo = '<b class="noDataF">Not Found</b>';
                    }
                    if(data1.data[0].AQTYISSUED){
                      var purBillDate = data1.data[0].AQTYISSUED;
                    }else{
                      var purBillDate = '<b class="">0.00</b>';
                    }

                    if(data1.data[0].PREFDATE){
                      var partyRDate = data1.data[0].PREFDATE;
                    }else{
                      var partyRDate = '<b class="noDataF">Not Found</b>';
                    }

                

                    if(data1.data[0].PARTICULAR){
                      var PARTICULAR = data1.data[0].PARTICULAR;
                    }else{
                      var PARTICULAR = '<b class="noDataF">Not Found</b>';
                    }

                    if(data1.data[0].RATE){
                      var rate = data1.data[0].RATE;
                    }else{
                      var rate = '<b class="noDataF">Not Found</b>';
                    }

                    if(data1.data[0].CRAMT){
                      var dramt = data1.data[0].CRAMT;
                    }else{
                      var dramt = '<b class="noDataF">Not Found</b>';
                    }

                    if(data1.data[0].ACC_CODE){
                      var accCode = data1.data[0].ACC_CODE+' - '+data1.data[0].ACC_NAME;
                    }else{
                      var accCode = '<b class="noDataF">Not Found</b>';
                    }

                    $('#tNature').html('<b>T NATURE </b> : '+data1.data[0].TRAN_CODE+' - '+data1.data[0].TRAN_HEAD);

                     $('#accCode').html('<b>ACC CODE </b> : '+accCode);
                    $('#rate').html('<b>RATE </b> : '+rate);
                    $('#dr_amt').html('<b>AMOUNT </b> : '+dramt);
                    $('#qtyrecd').html('<b>AQTYRECD </b> : '+purBillNo);
                    $('#qtyissued').html('<b>AQTYISSUED  </b> : '+purBillDate);
                    $('#particuler').html('<b>PARTICULAR  </b> : '+PARTICULAR);
                    /*$('#batchNo').html('<b>Batch No </b> : '+batchN);*/
                   
                   /* $.each(obj_row, function (i, obj_row) {

                    });*/
                  }
                      
              }
          }

    });


}

</script>

@endsection