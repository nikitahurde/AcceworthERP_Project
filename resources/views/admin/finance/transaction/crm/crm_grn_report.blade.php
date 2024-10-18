@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.crmnavbar')



@include('admin.include.crmsidebar')
<style type="text/css">

    .tooltip{f
      color: #66CCFF !important;
    }

  .PageTitle{
    margin-right: 1px !important;
  }

  .required-field::before {
    content: "*";
    color: red;
  }

  

  .secondSection{

    display: none;
  }

  .rightcontent{

  text-align:right;


}
.hidebtn{
display: none;
}

::placeholder {
  
  text-align:left;
}
  @media screen and (max-width: 600px) {

  .PageTitle{

    float: left;

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




.container{

    max-width: 1200px;
    margin: 0px auto;
    padding: 0px 15px;

}

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



.ref::before {

  color: navy;
  content: "Ch :";
}

.toalvaldesn{

    text-align: right;
    font-weight: 800;
    margin-top: 1%;
}

.credittotldesn{

    width: 277%;
    margin-left: -11%;
    text-align: end;
}

.debitcreditbox{

  width: 91px;
  text-align: end;
}

.tdsratebtn{
  margin-top: 24% !important;
  font-weight: 800 !important;
  font-size: 11px !important;

}
.viewbtnitem{
    padding-bottom: 0px;
    padding-top: 0px;
    font-size: 12px;
    margin-bottom: 4px;
}
.modltitletext{
  font-weight: 800;
  color: #5696bb;
  text-align: center;
  font-size: 16px;
}
.SetInCenter{

  margin-top: 18%;

}
.AddM{

  width: 24px;

}
.showdetail{
  display: none;

}
.showcodename{
  color: #5696bb;
    font-size: 13px;
    font-weight: 600;
}
.aplynotStatus{
  display: none;
}

.panel.with-nav-tabs .panel-heading{
    padding: 5px 5px 0 5px;
}
.panel.with-nav-tabs .nav-tabs{
  border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
  margin-bottom: -1px;
}

.with-nav-tabs.panel-info .nav-tabs > li > a,
.with-nav-tabs.panel-info .nav-tabs > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li > a:focus {
  color: #31708f;
}
.with-nav-tabs.panel-info .nav-tabs > .open > a,
.with-nav-tabs.panel-info .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-info .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-info .nav-tabs > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li > a:focus {
  color: #31708f;
  background-color: #bce8f1;
  border-color: transparent;
}
.with-nav-tabs.panel-info .nav-tabs > li.active > a,
.with-nav-tabs.panel-info .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.active > a:focus {
  color: #31708f;
  background-color: #fff;
  border-color: #bce8f1;
  border-bottom-color: transparent;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #d9edf7;
    border-color: #bce8f1;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #31708f;   
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #bce8f1;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #31708f;
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
.boxer .hidebordritm {
  display: table-cell;
  vertical-align: top;
  border: none;
  padding: 5px;
}
.center {
  text-align:center;
}
.right {
  float:right;
}
.texIndbox{
  width: 25%; 
  text-align: center;
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
  text-align: center;
}
.rateBox{
  width: 20%;
  text-align: center;
}
.amountBox{
  width: 20%;
  text-align: center;
}
.inputtaxInd{
  background-color: white !important;
  border: none;
  text-align: center;
}
@media screen and (max-width: 600px) {

  .credittotldesn{

    width: 89px;
    margin-bottom: 5px;
    margin-left: -34%;
  }

  .totlsetinres{

    width: 130%;

  }

  .debitcreditbox{

    margin-top: 0%;

  }

  .rowClass{
    overflow-x: scroll;
  }

}

</style>


<style type="text/css">



  .Custom-Box {

    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);

  }

  .OperatorTd{
    width: 35px !important;
  }
  .ValuesTd{
    width: 50% !important;
  }

  .QueryTableTd{
    font-size: 14px !important;
    font-weight: 600 !important;
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
 .rightcontent{

  text-align:right;


}

.modal-header .close {
    margin-top: -25px !important;
    margin-right: 2% !important;
}

::placeholder {
  
  text-align:left;
}

 @media only screen and (max-width: 600px) {
  
  .dataTables_filter{
    margin-left: 35%;
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

</style>


<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Delivery Report
            <small> : Report Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Report</a></li>

            <li><a href="{{ url('/dashboard') }}">Sales</a></li>

            <li class="active"><a href="{{ url('/report/purchase/purchase-order-report') }}"> Delivery Rep.</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Delivery Report</h2>


            </div><!-- /.box-header -->

            <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

              <div class="row">

                <div class="col-md-3">

                   <div class="form-group">

                    <?php $FromDate= date("d-m-Y", strtotime($yearstart));  
                        $ToDate= date("d-m-Y", strtotime($yearend));   ?>

                      <label for="exampleInputEmail1"> From Date : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                       
                        <input type="text" name="from_date" id="from_date" class="form-control datepicker1 rightcontent" placeholder="Select Transaction Date" value="{{$FromDate}}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_from_date">

                        

                      </small>

                  </div>

                 </div>



                 <div class="col-md-3">

                   <div class="form-group">

                      <label for="exampleInputEmail1"> To Date : </label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <input type="text" name="to_date" id="to_date" class="form-control datepicker1 rightcontent" placeholder="Select Transaction Date" value="{{ $ToDate }}" autocomplete="off">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('to_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_to_date">

                      </small>

                  </div>

                 </div>

                

                 <!-- /.col -->

                <!-- /.col -->


                <div class="col-md-3">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Item Code :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="itemList" id="item_code" name="item_code" class="form-control  pull-left rightcontent" value="{{ old('item_code')}}" placeholder="Enter Item Code" autocomplete="off">


                          <datalist id="itemList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($item_list as $key)

                            

                            <option value='<?php echo $key->ITEM_CODE?>'   data-xyz ="<?php echo $key->ITEM_CODE; ?>" ><?php echo $key->ITEM_CODE; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>

              </div><!-- /.row -->



              <div class="row">

             <!--   <div class="col-md-4">

                 
                  <div class="form-group">

                      <label for="exampleInputEmail1">Report Type : <span class="required-field"></span> </label>

                      <div class="input-group">

                      
                          <input type="radio" id="pendingId" name="reporttype"  value="pending" checked=""> &nbsp; <b>Pending</b> &nbsp;&nbsp;
                          <input type="radio" id="CompleteId" name="reporttype" value="complete">  &nbsp; <b>Complete</b>&nbsp;&nbsp;
                          <input type="radio" id="allId" name="reporttype" value="allitem">  &nbsp; <b>All</b>


                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="pfctText"></div>

                     </small>

                     <small id="show_err_dept_code">

                      </small>
                     
                  </div>

                </div> -->
                <div class="col-md-4"></div>
                <div class="col-md-4">

                    <div class="">

               <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

             <!--    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#QueryModal"><i class="fa fa-hourglass" aria-hidden="true"></i> &nbsp;&nbsp;Query</button>
 -->
                <button class="btn btn-primary" id="PindReprtExl"  onclick="excelReportBtn('excel')" disabled=""><i class="fa fa-file-excel-o" aria-hidden="true"></i> <b>Excel</b></button>

               </div>

                </div>

            

              </div>


            </div><!-- /.box-body -->



            <div class="box-body" style="margin-top: 2%;">

<!-- <button type="button" id="btnpdf" class="btn btn-danger btn-sm" style="margin-left: 75px !important;
    margin-bottom: -49px !important;"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF </button> -->

<table id="PurchaseIndentReportTable" class="table table-bordered table-striped table-hover">
  <thead class="theadC">

    

    <tr>
      <th class="text-center">Sr.No</th>
      <th class="text-center">Vr Date</th>
      <th class="text-center">Vr no. </th>
      <th class="text-center">Trans. code</th>
      <th class="text-center">Party</th>
      <th class="text-center">Plant Code</th>
      <th class="text-center">Series</th>
      <th class="text-center">Profit Cent.</th>
      <th class="text-center">Item Name</th>
      <th class="text-center">Qty</th>
      <th class="text-center">A-Qty</th>
      <th class="text-center">Status</th>
      <!-- <th class="text-center">Action</th> -->
    </tr>

  </thead>

  <tbody id="defualtSearch">

    

  </tbody>
 

</table>



</div><!-- /.box-body -->

           

          </div>

  </section>

</div>






@include('admin.include.footer')



<script type="text/javascript">

  function excelReportBtn(type){

            var from_date  = $("#from_date").val();
            var to_date    = $("#to_date").val();
            var item_codes = $("#item_code").val();
            
            var vrnum      =  $('#vr_num').val();
            
            var vr_no      = vrnum.split(' ');
            
            var vr_nums    = vr_no[2];
            
            
            var pendingId  =  $('#pendingId').is(":checked");
            
            var CompleteId =  $('#CompleteId').is(":checked");
            
            var allId      =  $('#allId').is(":checked");
            
           var ReportTypes;
            
          if(pendingId){
            ReportTypes    = $('#pendingId').val();
            }else if(CompleteId){
            ReportTypes    = $('#CompleteId').val();
            }else if(allId){
            ReportTypes    = $('#allId').val();
            }else{
            ReportTypes    = 'Not Found';
            }


   if(item_codes == ''){
      item_code = 0;
   }else{
    item_code = item_codes;
   }

   if(vr_nums == '' || vr_nums==undefined){
      vr_num = 0;
   }else{
    vr_num = vr_nums;
   }
  

  //alert(vr_num);return false;

   var plantCodeOperators    =  $('#plantCodeOperators').val();
    if (plantCodeOperators == '') {
      plantCodeOperator = 0;
    }else{
      plantCodeOperator = plantCodeOperators;
    }

    var plantCodeValues       =  $('#plantCodeValues').val();
    if (plantCodeValues == '') {
      plantCodeValue = 0;
    }else{
      plantCodeValue = plantCodeValues;
    }

    var seriesCodeOperators   =  $('#seriesCodeOperators').val();
    if (seriesCodeOperators == '') {
      seriesCodeOperator = 0;
    }else{
      seriesCodeOperator = seriesCodeOperators;
    }

    var seriesCodeValues      =  $('#seriesCodeValues').val();

     
    if (seriesCodeValues == '') {
      seriesCodeValue = 0;
    }else{
      seriesCodeValue = seriesCodeValues;
    }



    var profitCenterOperators =  $('#profitCenterOperators').val();
    if (profitCenterOperators == '') {
      profitCenterOperator = 0;
    }else{
      profitCenterOperator = profitCenterOperators;
    }

    var profitCenterValues    =  $('#profitCenterValues').val();
    if (profitCenterValues == '') {
      profitCenterValue = 0;
    }else{
      profitCenterValue = profitCenterValues;
    }


     var accCodeOperators =  $('#accCodeOperators').val();
    if (accCodeOperators == '') {
      accCodeOperator = 0;
    }else{
      accCodeOperator = accCodeOperators;
    }

    var accCodes    =  $('#accCodes').val();

    if (accCodes == '') {
      accCode = 0;
    }else{
      accCode = accCodes;
    }


    var QtyOperators  =  $('#QtyOperators').val();
    if (QtyOperators == '') {
      QtyOperator = 0;
    }else{
      QtyOperator = QtyOperators;
    }

    var QtyValues =  $('#QtyValues').val();
    if (QtyValues == '') {
      QtyValue = 0;
    }else{
      QtyValue = QtyValues;
    }
   

   var pageName = 'purchaseIndent';

    $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }
        });


      window.location.href = "{{ url('/report/sale/sale-challan/sale-challan-report-excel/') }}"+'/'+item_code+'/'+vr_num+'/'+plantCodeOperator+'/'+plantCodeValue+'/'+seriesCodeOperator+'/'+seriesCodeValue+'/'+profitCenterOperator+'/'+profitCenterValue+'/'+accCodeOperator+'/'+accCode+'/'+QtyOperator+'/'+QtyValue+'/'+from_date+'/'+to_date+'/'+ReportTypes+'/'+type;
        /*const win = window.open(
            "{{ url('/report/purchase/purchase-indent/purchase-indent-report-excel/') }}"+'/'+vr_num);
        const timer = setInterval(() => {
          if (win.closed) {
            clearInterval(timer);
            console.log('close');
            //alert('"Secure Payment" window closed!');
          }
        }, 500);*/
      

        /*$.ajax({
            type: 'GET',
            url: "{{ url('/report/purchase/purchase-indent/purchase-indent-report-excel') }}",

            data: {from_date:from_date,to_date:to_date,vr_num:vr_num,item_code:item_code,plantCodeOperator:plantCodeOperator,plantCodeValue:plantCodeValue,seriesCodeOperator:seriesCodeOperator,seriesCodeValue:seriesCodeValue,profitCenterOperator:profitCenterOperator,profitCenterValue:profitCenterValue,departmentOperator:departmentOperator,departmentValue:departmentValue,employeeOperator:employeeOperator,employeeValue:employeeValue,QtyOperator:QtyOperator,QtyValue:QtyValue}, 
            success: function(data){

                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(data);
                link.download = `Invoice_details_report.xlsx`;
                link.click();
            },

            fail: function(data) {
                console.log('fail',  data);
            }

        })*/

  }

</script>

 <script type="text/javascript">

    $(document).ready(function(){



        $("#acct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

        });



        $('#acct_code').change(function(){

         

          var acountCode = $('#acct_code').val();

          $('#showaccCode').val(acountCode);

        });

    });


</script>




<script type="text/javascript">

load_data_query()
  function load_data_query(plantCodeOperator= '', plantCodeValue='',seriesCodeOperator='',seriesCodeValue='',profitCenterOperator='',profitCenterValue='',QtyOperator= '', QtyValue='',accCodeOperator='',accCode='',bank_code= '',from_date='',to_date='',vr_num='',item_code='',ReportTypes=''){
    //  alert(acct_code);
    /*console.log('from_date',from_date);
    console.log('to_date',to_date);
    console.log('bank_code',bank_code);
    console.log('acct_code',acct_code);
    console.log('vr_num',vr_num);
    console.log('AmountValueId',AmountValueId);*/

      $('#PurchaseIndentReportTable').DataTable({

          processing: true,
          serverSide: true,
          scrollX: true,
          pageLength:'25',
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
          
          buttons:  [
                      
                     
                      
                    ],
         
          ajax:{
            url:'{{ url("/get-data-from-query-crm-grn") }}',
            data: {plantCodeOperator:plantCodeOperator,plantCodeValue:plantCodeValue,seriesCodeOperator:seriesCodeOperator,seriesCodeValue:seriesCodeValue,profitCenterOperator:profitCenterOperator,profitCenterValue:profitCenterValue,QtyOperator:QtyOperator,QtyValue:QtyValue,accCodeOperator:accCodeOperator,accCode:accCode,bank_code:bank_code,vr_num:vr_num,item_code:item_code,from_date:from_date,to_date:to_date,ReportTypes:ReportTypes}
          },
          columns: [

            { 
              data:"DT_RowIndex",
              className:"text-center"
            },
            {
                data:'VRDATE',
                name:'VRDATE',
                className:'text-right'
            },
            {
                data:'VRNO',
                name:'VRNO',
                className:'text-right'
            },
            {
                data:'TRAN_CODE',
                name:'TRAN_CODE',
                className: "alignCenterClass"
            },
            {
              data:'accCode',
              name:'accCode',
              className: "alignCenterClass"
            },
            {
                data:'plantCode',
                name:'plantCode'
            },
            {
                data:'seriesCode',
                name:'seriesCode'
                
            },
            {
                data:'pfctCode',
                name:'pfctCode',
                className: "alignRightClass"
               
            },
            {
              render: function (data, type, full, meta){
                  
                var itemName = '<p>'+full['ITEM_NAME']+'</p>'+'<p style="line-height:2px;">('+full['ITEM_CODE']+')<input type="hidden" id="ItemCodeId'+full['DT_RowIndex']+'" value="'+full['ITEM_CODE']+'"></p>';
                return itemName;

              }
            },
            {
                data:'ORDERQTY',
                name:'ORDERQTY',
                className: "alignRightClass"
            },
            {
                data:'ORDERAQTY',
                name:'ORDERAQTY',
                className: "aligncenterClass"
            },
            {
              data:null,
              render: function (data, type, full, meta){

                if(full['SBILLHID']==0 && full['SBILLBID']==0){

                  var itemName = '<small class="label label-danger"><i class="fa fa-clock-o"></i> Pending</small>';

                }else if(full['SBILLHID']!=0 && full['SBILLBID']!=0){

                  var itemName = '<small class="label label-success"><i class="fa fa-check"></i> Completed</small>';

                }else{

                  var itemName = '<a class="btn btn-danger btn-xs"><i class="fa fa-close" aria-hidden="true"></i> Pending </a>';

                }

                
                return itemName;


              }
            },
           
          ]


      });


   }
  

  $(document).ready(function() {

    $('#lastUpdateValueId').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      autoclose: 'true'

    });

$('#ProceedBtnId').click(function(){


            var plantCodeOperator    =  $('#plantCodeOperator').val();
            
            var plantCodeValue       =  $('#plantCodeValue').val();
            
            var seriesCodeOperator   =  $('#seriesCodeOperator').val();
            
            var seriesCodeValue      =  $('#seriesCodeValue').val();
            
            var profitCenterOperator =  $('#profitCenterOperator').val();
            var profitCenterValue    =  $('#profitCenterValue').val();
            
            var QtyOperator          =  $('#QtyOperator').val();
            var QtyValue             =  $('#QtyValue').val();
            
            var accCodeOperator      =  $('#accCodeOperator').val();
            var accCode              =  $('#accCode').val();
            
            var pendingId            =  $('#pendingId').is(":checked");
            
            var CompleteId           =  $('#CompleteId').is(":checked");
            
            var allId                =  $('#allId').is(":checked");
            
           var ReportTypes;
            
          if(pendingId){
            ReportTypes    = $('#pendingId').val();
            }else if(CompleteId){
            ReportTypes    = $('#CompleteId').val();
            }else if(allId){
            ReportTypes    = $('#allId').val();
            }else{
            ReportTypes    = 'Not Found';
            }


        $('#plantCodeOperators').val(plantCodeOperator);
        $('#plantCodeValues').val(plantCodeValue);
        $('#seriesCodeOperators').val(seriesCodeOperator);
        $('#seriesCodeValues').val(seriesCodeValue);
        $('#profitCenterOperators').val(profitCenterOperator);
        $('#profitCenterValues').val(profitCenterValue);
        $('#QtyOperators').val(QtyOperator);
        $('#QtyValues').val(QtyValue);
        $('#accCodeOperators').val(accCodeOperator);
        $('#accCodes').val(accCode);

     var from_date = '';
     var to_date = '';
     var bank_code = '';
     var item_code = '';
     var vr_num = '';


            $("#from_date").prop('readonly',true);
      $("#to_date").prop('readonly',true);        
      $("#item_code").prop('readonly',true);
      $("#vr_num").prop('readonly',true);
      $("#btnsearch").prop('disabled',true);

   
      if (plantCodeOperator!='' || plantCodeValue!='' || seriesCodeOperator!='' || seriesCodeValue!='' || profitCenterOperator!='' || profitCenterValue!='' || QtyOperator!='' || QtyValue!='' || accCodeOperator!='' || accCode!='' || from_date == '' || to_date =='' || bank_code=='' || vr_num=='' || item_code=='' || ReportTypes=='') {
            

          $('#PurchaseIndentReportTable').DataTable().destroy();

          load_data_query(plantCodeOperator,plantCodeValue,seriesCodeOperator,seriesCodeValue,profitCenterOperator,profitCenterValue,QtyOperator,QtyValue,accCodeOperator,accCode,bank_code,from_date,to_date,vr_num,item_code,ReportTypes);

          $('#QueryModal').modal('hide');
          $('#recordNumberId').val('');
          $('#recordNumberValueId').val('');
          $('#plantCodeOperator').val('');
          $('#plantCodeValue').val('');
          $('#seriesCodeOperator').val('');
          $('#seriesCodeValue').val('');
          $('#profitCenterOperator').val('');
          $('#profitCenterValue').val('');
          $('#QtyOperator').val('');
          $('#QtyValue').val('');
          $('#accCodeOperator').val('');
          $('#accCode').val('');
         

      }else{

          $('#PurchaseIndentReportTable').DataTable().destroy();

          load_data_query();

         $('#QueryModal').modal('hide');
          $('#recordNumberId').val('');
          $('#recordNumberValueId').val('');
          $('#plantCodeOperator').val('');
          $('#plantCodeValue').val('');
          $('#seriesCodeOperator').val('');
          $('#seriesCodeValue').val('');
          $('#profitCenterOperator').val('');
          $('#profitCenterValue').val('');
          $('#QtyOperator').val('');
          $('#QtyValue').val('');
          $('#accCodeOperator').val('');
          $('#accCode').val('');
         
      }


    });


    $('#btnsearch').click(function(){

            var from_date  =  $('#from_date').val();
            
            var to_date    =  $('#to_date').val();
            
            var bank_code  =  $('#bank_code').val();
            
            var item_code  =  $('#item_code').val();
            
            
            var pendingId  =  $('#pendingId').is(":checked");
            
            var CompleteId =  $('#CompleteId').is(":checked");
            
            var allId      =  $('#allId').is(":checked");
            
            var ReportTypes;
            
          if(pendingId){
            ReportTypes    = $('#pendingId').val();
            }else if(CompleteId){
            ReportTypes    = $('#CompleteId').val();
            }else if(allId){
            ReportTypes    = $('#allId').val();
            }else{
            ReportTypes    = 'Not Found';
            }

        //  alert();

          var plantCodeOperator    =  '';
          var plantCodeValue       =  '';
          var seriesCodeOperator   =  '';
          var seriesCodeValue      =  '';
          var profitCenterOperator =  '';
          var profitCenterValue    =  '';
          var QtyOperator          =  '';
          var QtyValue             =  '';
          var accCodeOperator      =  '';
          var accCode              =  '';
          var vr_num ='';
        
          

          if (bank_code!=''  || from_date!='' || to_date!='' || vr_num!='' || plantCodeOperator=='' || plantCodeValue=='' || seriesCodeOperator=='' || seriesCodeValue=='' || profitCenterOperator=='' || profitCenterValue=='' || QtyOperator=='' || QtyValue=='' || AccCodeId=='' || accCodeOperator=='' || accCode=='' || item_code=='' || ReportTypes=='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date!=''){
              if(to_date==''){
                $('#show_err_to_date').html('Please select to date').css('color','red');
                return false;
              }
            }

            if(to_date!=''){
              if(from_date==''){
                $('#show_err_from_date').html('Please select from date').css('color','red');
                return false;
              }
            }



            $('#PurchaseIndentReportTable').DataTable().destroy();

            load_data_query(plantCodeOperator,plantCodeValue,seriesCodeOperator,seriesCodeValue,profitCenterOperator,profitCenterValue,QtyOperator,QtyValue,accCodeOperator,accCode,bank_code,from_date,to_date,vr_num,item_code,ReportTypes);

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            
          }


        });


    $('#ResetId').click(function(){


      $('#PurchaseIndentReportTable').DataTable().destroy();
      load_data_query();
  
      $('#bank_code').val('');
      
      $('#item_code').val('');
      $('#vr_num').val('');
      $('#accountText').html('');

     
      $("#from_date").prop('readonly',false);
      $("#to_date").prop('readonly',false);        
      $("#item_code").prop('readonly',false);
      $("#vr_num").prop('readonly',false);
      $("#btnsearch").prop('disabled',false);


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



function showCalTax(srNo,headid,bodyId){

      var headid,bodyId;


        $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

        });

        $.ajax({

              url:"{{ url('/get-calTax-for-saleorder-reports') }}",

               method : "POST",

               type: "JSON",

               data: {headid:headid,bodyId:bodyId},

               success:function(data){

                  var data1 = JSON.parse(data);

                 // console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       
                      }else{
                        var obj_row = data1.data;
                        var obj_row1 = data1.tax_code;

                        console.log('taxC => ',obj_row1[0].TAX_CODE);

                        $('#showTaxCode'+srNo).html('');

                        $('#showTaxCode'+srNo).html(obj_row1[0].TAX_CODE);

                        var srac=1;
                        /*var countAcc= data1.data.length;
                        $('#accCount'+headid+'_'+srNo).html(countAcc);*/
                        $('#getCalTaxData'+srNo).empty();
                        var headData = '<div class="box-row" id="appendbody'+srNo+'"><div class="box10 texIndbox1">Sr.No.</div><div class="box10 rateIndbox">Tax Indicator</div><div class="box10 rateIndbox">Rate Indicator</div><div class="box10 rateIndbox">Rate</div><div class="box10 rateIndbox">Amount</div></div></div>';
                      $('#getCalTaxData'+srNo).append(headData);



                        $.each(obj_row, function (i, obj_row) {

                            var bodyData = '<div class="box-row"><div class="box10 itmdetlheading"><span id="srnum">'+srac+'</span></div><div class="box10 itmdetlheading" style="text-align: left;"><span id="accCode">'+obj_row.TAXIND_NAME+'</span> </div><div class="box10 itmdetlheading"><span id="accName"> '+obj_row.RATE_INDEX+'</span></div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.TAX_RATE+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.TAX_AMT+'</span> </div></div>';

                            srac++;
                            $('#getCalTaxData'+srNo).append(bodyData);
                        });
                      }
                      
                  }
               }

          });
    }


    function showQuaParDetails(srNo,headid,bodyId){

        var headid,bodyId;

            $.ajaxSetup({

              headers: {

                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

              }

            });

        $.ajax({

              url:"{{ url('/get-qua-for-saleorder-reports') }}",

               method : "POST",

               type: "JSON",

               data: {headid:headid,bodyId:bodyId},

               success:function(data){

                  var data1 = JSON.parse(data);

                  console.log(data1);
               
                  if (data1.response == 'error') {

                      $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");                      

                  }else if(data1.response == 'success'){

                      if(data1.data==''){
                       

                      }else{
                        var obj_rows = data1.data;
                        var srac=1;
                        
                        //$('#showItemName').html();
                        /*var countAcc= data1.data.length;
                        $('#accCount'+headid+'_'+srNo).html(countAcc);*/
                        $('#getQuaParData'+srNo).empty();
                        $('#showItemCode'+srNo).empty();
                        var headData = '<div class="box-row" id="appendbody'+srNo+'"><div class="box10 texIndbox1">Sr.No.</div><div class="box10 rateIndbox">Item Category</div><div class="box10 rateIndbox">Quality Char</div><div class="box10 rateIndbox">Description</div><div class="box10 rateIndbox">From Value</div><div class="box10 rateIndbox">To Value</div></div></div>';
                      $('#getQuaParData'+srNo).append(headData);

                       
                        
                        $.each(obj_rows, function (i, obj_row) {

                            if(srac == 1){

                              
                              console.log('itemC => ',obj_row.ITEM_CODE);
                              $('#showItemCode'+srNo).append(obj_row.ITEM_CODE);

                            }


                            var bodyData = '<div class="box-row"><div class="box10 itmdetlheading"><span id="srnum">'+srac+'</span></div><div class="box10 itmdetlheading" style="text-align: left;"><span id="accCode">'+obj_row.ICATG_CODE+'</span> </div><div class="box10 itmdetlheading"><span id="accName"> '+obj_row.IQUA_CHAR+'</span></div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.IQUA_DESC+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.CHAR_FROMVALUE+'</span> </div><div class="box10 itmdetlheading" style="text-align: right;"><span id="accCode">'+obj_row.CHAR_TOVALUE+'</span> </div></div>';

                            srac++;
                            $('#getQuaParData'+srNo).append(bodyData);
                        });
                      }
                      
                  }
               }

          });


    }




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
  
  $('#btnpdf').click(function(){

          var from_date =  $('#from_date').val();

          var to_date =  $('#to_date').val();

          var bank_code =  $('#bank_code').val();

          //var acct_code =  $('#acct_code').val();
         
          var vr_num =  $('#vr_num').val();

          var store_action ='req';

          var recNoId         =  '';
          var recNoValueId    =  '';
          var lastUpId        =  '';
          var lastUpValueId   =  '';
          var VrNoId          =  '';
          var VrNoValueId     =  '';
          var SeriesNoId      =  '';
          var SeriesNoValueId =  '';
          var AccCodeId       =  '';
          var AccCodeValueId  =  '';
          var AmountId        =  '';
          var AmountValueId   =  '';
          var OtherDetailsId  =  '';
          var OtherDetValueId =  '';

        
          

          if (bank_code!='' || acct_code!='' || from_date!='' || to_date!='' || vr_num!='' || recNoId=='' || recNoValueId=='' || lastUpId=='' || lastUpValueId=='' || VrNoId=='' || VrNoValueId=='' || SeriesNoId=='' || SeriesNoValueId=='' || AccCodeId=='' || AccCodeValueId=='' || AmountId=='' || AmountValueId=='' || OtherDetailsId=='' || OtherDetValueId=='') {

            $('#show_err_from_date').html('');
            $('#show_err_to_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            if(from_date!=''){
              if(to_date==''){
                $('#show_err_to_date').html('Please select to date').css('color','red');
                return false;
              }
            }

            if(to_date!=''){
              if(from_date==''){
                $('#show_err_from_date').html('Please select from date').css('color','red');
                return false;
              }
            }

            
                            $.ajaxSetup({
                                headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                              });

                             $.ajax({

                                url:"{{ url('/report/sale-order/pdf') }}",

                                method : "POST",

                                type: "GET",

                                data: {recNoId:recNoId,recNoValueId:recNoValueId,lastUpId:lastUpId,lastUpValueId:lastUpValueId,VrNoId:VrNoId,VrNoValueId:VrNoValueId,SeriesNoId:SeriesNoId,SeriesNoValueId:SeriesNoValueId,AccCodeId:AccCodeId,AccCodeValueId:AccCodeValueId,AmountId:AmountId,AmountValueId:AmountValueId,OtherDetailsId:OtherDetailsId,OtherDetValueId:OtherDetValueId,bank_code:bank_code,acct_code:acct_code,vr_num:vr_num,from_date:from_date,to_date:to_date,store_action:store_action},

                                

                                success: function(response){

                                 console.log('response',response);

                                  if(response.response == 'success' && response.data !=''){

                                      var link = document.createElement('a');
                                      link.href = response.url;
                                      link.download = 'file.pdf';
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

@endsection