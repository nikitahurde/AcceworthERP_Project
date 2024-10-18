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
      box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }

  .showinmobile{
    display: none;
  }

  .secondSection{
    display: none;
  }

  .tolrancehide{
    display: none !important;
  }
  #empInfo{
    text-align: left;
    padding: 5px;
    font-size: 15px;
    font-weight: bold;
  }

  #empInfo1{
    text-align: center;
    padding: 5px;
    font-size: 15px;
    font-weight: bold;
    background-color:  hsl(0deg 100% 50% / 23%);
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

  /*table {
     border-collapse: collapse;
  }

  .table-responsive {
      display: block;
      width: 100%;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;

  }*/

 /* .table {
      width: 100%;
      margin-bottom: 1rem;
      color: #212529;

  }

  .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #dee2e6;

  }*/

 /* .table thead th {
      padding: 10px !important;
    padding-bottom: 0px !important;
    line-height: 1.8;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;

  }*/
 /* .table tbody tr td {
    padding: 15px !important;
    padding-bottom: 0px !important;
    line-height: 1.8;
    vertical-align: top;
    border-top: 1px solid #ddd;
    text-align: center;
}*/

  .container{
      max-width: 1200px
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

  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {

      padding: 10px;
      padding-bottom: 0px !important;
      line-height: 1.8;
      vertical-align: top;
      border-top: 1px solid #ddd;
     

  }

  .rightcontent{
    text-align:right;
  }

  ::placeholder {
    text-align:left;
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
    margin-top: 3% !important;
    font-weight: 600 !important;
    font-size: 10px !important;
  }

  .tdsInputBox{
    margin-bottom: 2%;
  }

  .modltitletext{
    font-weight: 800;
    color: #5696bb;
    font-size: 16px;
    text-align: center;
  }

  .textSizeTdsModl{
    font-size: 13px;
  }

  .companyName{
    font-weight: bold ;
    vertical-align: top;
    border: 1px solid #ddd;
    padding: 30px;
    text-align: center;
  }

  .btn_new{
      display: inline-block;
      font-weight: 600;
      text-align: center;
      vertical-align: middle;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      padding: 0.375rem 0.75rem;
      font-size: 14px;
      line-height: 1.5;
      border-radius: 1.25rem;
      transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;

  }

  .bankshowwhenrecpt{
    display: none !important;
  }

  .setboxWidthIndex{
    width: 25px;
    border: 1px solid #b8b6b6;
  }

  .SetInCenter{
    margin-top: 18%;
  }

  .AddM{
    width: 24px;
  }

  .divhsn{
    color: #3c8dbc;
    font-size: 13px;
    font-weight: 800;
    margin-bottom: 8%;
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

  .settaxcodemodel{
    font-size: 16px;
    font-weight: 800;
    color: #5d9abd;

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

  .boxSalary {
   z-index: 0;
   width: 390%;border:
    1px solid #ddd;
    padding-left: 5px;
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

  .texIndbox{
    text-align: center;
    width: 20%;
  }

  .rateIndbox{
    text-align: center;
    width: 15%;
  }

  .vrnoinbox{
    width: 10%;
    text-align: center;
  }

  .rateBox{
    width: 20%;
    text-align: center;
  }

  .itemIndbox{
    width: 30%;
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

  .showind_Ch{
    display: none;
  }
  .itmbyQc{
    display: none;
  }
  .notshowcnlbtn{
    display: none;
  }
  .aplynotStatus{
    display: none;
  }
  .batchNoC{
    font-weight: 700;
    width: 57px;
    margin-top: 1%;
    margin-right: 2%;
    color: #3c8dbc;
  }
  .showbatchnum{
    width: 135px;
    margin-bottom: 2%;
    height: 26px;
  }
  .setbatchnoandref{
    display: flex;

  }
  .hidebatchnoinput{
    display: none;
  }
  .AddMList{
  width: 40px;
  }
  .taxcodeset{
  margin-right: 11px !important;
}



.tblBorder tr{
  border: 1px solid #a5a2a2;
}

.tblBorder td{
  border: 1px solid #a5a2a2;
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

    .rowClass{
      overflow-x: scroll;
    }
   


  }
</style>







  <div class="content-wrapper">



        <!-- Content Header (Page header) -->



        <section class="content-header">


          <h1>


           View Emp Pay Transaction



            <small>View Details</small>



          </h1>



          <ol class="breadcrumb">



            <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>



            <li><a href="{{ URL('/dashboard')}}">Master</a></li>



            <li class="Active"><a href="{{ URL('/Transaction/EmployeePay/view-pay-trans')}}">Emp Pay Transaction</a></li>



            <li class="Active"><a href="{{ URL('/Transaction/EmployeePay/view-pay-trans')}}">View Emp Pay Transaction</a></li>



          </ol>



        </section>







        <!-- Main content -->



        <section class="content">



          <div class="row">



            <div class="col-xs-12">



              <div class="box box-primary Custom-Box">



                <div class="box-header with-border" style="text-align: center;">



                  <h3 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">View Emp Pay Transaction </h3>



                  <div class="box-tools pull-right">



          <a href="{{ url('/Transaction/EmployeePay/emp-pay-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Emp Pay Tran</a>



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



                  <table id="example" class="table table-bordered table-striped table-hover">



                    <thead>



                      <tr>



                        <th>Sr.No</th>
                        <th>Month</th>
                        <th>Emp Name</th>
                        <th>Department</th>
                        <th>Earning</th>
                        <th>Deduction</th>
                        <th>Total Salary</th>
                        <th>Salary Slip</th>


                    </tr>



                    </thead>



                    <tbody>




                    </tbody>



                  </table>



                  <div id="payment_receipt" class="modal fade" rtabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="">
                        <div class="modal-dialog modal-lg" role="document" style="margin-top: 5%;"><div class="modal-content" style="border-radius: 5px;">

                          <!-- Modal content-->
                          <div class="modal-content">
                              <div class="modal-header">

                                <input type="hidden" class="settaxcodemodel col-md-6" id="empCode_" style="border: none; padding: 0px;" readonly>

                                <h5 class="modal-title modltitletext text-center" id="exampleModalLabel_" style="font-size: 19px;"></h5>

                                <p id="comp_add" class="text-center" style="font-size:17px;font-weight:700;"></p>

                                <h6 class="text-center" style="
                                    font-weight: 700;font-size: 18px;
                                ">SALARY SLIP</h6>
                              
                              </div>


                              <div class="modal-body table-responsive" style="">

                                <div class="modalspinner hideloaderOnModl"></div>

                                <div class="" id="paymentReceipt">
                                  
                                </div>
                                
                              </div>

                              <div class="modal-footer text-center" id="paymentReceipt_footer"></div>
                          </div>

                        </div>
                      </div>
                      
                  </div>

                </div><!-- /.box-body -->



              </div><!-- /.box -->



            </div><!-- /.col -->



          </div><!-- /.row -->



        </section><!-- /.content -->



      </div>







@include('admin.include.footer')




<script type="text/javascript">
   $(document).ready(function(){

     $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

    

    var t = $("#example").DataTable({

       processing: true,
       serverSide:false,
       //scrollY:500,
       scrollX:true,
       paging: true,
       ajax:{

        url : "{{ url('/Transaction/EmployeePay/view_employee-list') }}"

       },
       searching : true,
    

       columns: [
        
       
          { data:"DT_RowIndex"},

          { data:"salary_Month"},
        
        
          { render: function (data, type, full, meta){
             
             var empCode  = full['EMP_CODE'];
             var empName  = full['EMP_NAME'];
            

             var empCodeName = empCode+' ['+empName+' ]';

             return  empCodeName;


            }
          },

          { data: "DEPARTMENT"},
          { data: "TOT_EARNING",className:"text-right"},
          { data: "TOT_DEDUCTION",className:"text-right"},
          { data: "TOT_SALARY",className:'text-right'},

          {  
            render: function (data, type, full, meta){

              var rowCount = full['DT_RowIndex'];
              var emp_Code = full['EMP_CODE'];
              var month_yr = full['salary_Month'];

             var paymentSlipBtn = '<input type="hidden" id="salMonthYr_'+rowCount+'" value="'+month_yr+'"><input type="hidden" id="emp_code_'+rowCount+'" value="'+emp_Code+'"><button class="btn btn-primary btn-sm"  onclick="OkGetTransVal('+rowCount+');"><i class="fa fa-money"></i></button>';
             return  paymentSlipBtn ;    

         },className:"text-left",
        

       },
        
         
        
      ],

       


     });



});
</script>



<script type="text/javascript">

   function OkGetTransVal(rowId){
    
    var salmon_yr = $('#salMonthYr_'+rowId).val();
    var emp_code = $('#emp_code_'+rowId).val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({

    url:"{{ url('/Transaction/EmployeePay/view_employee-details') }}",
    method : "POST",
    type: "JSON",
    data:{salmon_yr:salmon_yr,emp_code:emp_code},
        
    success:function(data){

      var obj = JSON.parse(data);

      if(obj.response == 'success'){

      }

      $('#paymentReceipt').empty();

      $('#paymentReceipt_footer').empty(); 

      var headData       = obj.data.headData;
      var empData        = obj.data.empData;
      var headBodyData   = obj.data.headBodyData;
      var headWageData   = obj.data.headWageData;
      var headForm16Data = obj.data.headForm16Data;
      var empAttendData  = obj.data.empAttendData;
      var ctcData        = obj.data.ctcData;

      //date period

      var date = new Date(headData.MONTH_YR);
    
      var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
      
      var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
      
      var year  = firstDay.getFullYear();
     
      var month = (firstDay.getMonth() + 1).toString().padStart(2, "0");
     
      var daymonth = (firstDay.getDate()).toString().padStart(2, "0");
      
      var startDt = daymonth +'.'+ month +'.'+ year ;

      var endYear  = lastDay.getFullYear();
     
      var endMonth = (lastDay.getMonth() + 1).toString().padStart(2, "0");
     
      var endDayMonth = (lastDay.getDate()).toString().padStart(2, "0");
      
      var endDtMonth = endDayMonth +'.'+ endMonth +'.'+ endYear ;
      
      var payPeriod = startDt +'-'+ endDtMonth;

      var TableHeadData =  "<input type='hidden' id='indiCount"+rowId+"' value=''><input type='hidden' id='startDt"+rowId+"' name='startDt[]' value=''><input type='hidden' id='endDtMonth"+rowId+"' name='endDtMonth[]' value=''><table class='tblBorder' style='width:100%;' id='tblSalReceipt_"+rowId+"'><tr><td id='empInfo'>Employee Name</td><td><input type='text' id='empName_"+rowId+"' value='' style='border: 0px;' readonly></td><td id='empInfo'>PAN</td><td><input type='text' id='pan_"+rowId+"' value='' style='border: 0px;' readonly></td></tr><tr><td id='empInfo'>Employee Code</td><td><input type='text' id='ecode_"+rowId+"' value='' style='border: 0px;' readonly></td><td id='empInfo'>PF Number</td><td><input type='text' id='pfNum_"+rowId+"' value='' style='border: 0px;' readonly></td></tr><tr><td id='empInfo'>Designation</td><td><input type='text' id='empDesig_"+rowId+"' value='' style='border: 0px;' readonly></td><td id='empInfo'>Account No </td><td><input type='text' id='accNo_"+rowId+"' value='' style='border: 0px;' readonly></td></tr><tr><td id='empInfo'>Date Of Joining</td><td><input type='text' id='empDOJ_"+rowId+"' value='' style='border: 0px;' readonly></td><td id='empInfo'>IFSC</td><td><input type='text' id='ifsc_"+rowId+"' value='' style='border: 0px;' readonly></td></tr><tr><td id='empInfo'>CTC</td><td><input type='text' id='amt_1_"+rowId+"' value='"+ctcData.CTC+"' style='border: 0px;' readonly></td><td id='empInfo'>Bank Name</td><td><input type='text' id='bankName_"+rowId+"' value='' style='border: 0px;' readonly></td></tr><tr><td id='empInfo'>Pay Period</td><td><input type='text' id='payPeriod_"+rowId+"' value='"+payPeriod+"' style='border: 0px;' readonly></td><td id='empInfo'>Grade</td><td><input type='text' id='grade_"+rowId+"' value='"+empData.GRADE_CODE+"' style='border: 0px;' readonly></td></tr><tr></tr><tr  height = 20px><td colspan='4'></td></tr><tr class='text-center'><th colspan='2' id='empInfo1'>Income </th><th colspan='2' id='empInfo1'>Deduction</th></tr><tr style='background-color:#efd5d5fa;'><th id='empInfo' style='width:25%;text-align: center;'>Particulars</th><th id='empInfo' style='width:25%;text-align: center;'>Amount</th><th id='empInfo' style='width:25%;text-align: center;'>Particulars</th><th id='empInfo' style='width:25%;text-align: center;'>Amount</th></tr><tr><td colspan='2' id='inParticular_"+rowId+"'></td><td colspan='2' id='deducParticular_"+rowId+"' style='vertical-align:top !important;'></td></tr><tr><td colspan='2'><div class='row'><div class='col-md-5 text-right'><lable><strong>Total Earning</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4'><input type='text' id='tlEarnAmt_"+rowId+"' value='"+headBodyData.TOT_EARNING+"' class='text-center' style='border:0px solid;outline:none;font-weight: 900;' readonly></div></div></td><td colspan='2'><div class='row'><div class='col-md-5 text-right'><lable><strong>Total Deduction</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' class='text-center' id='tlDeducAmt_"+rowId+"' value='"+headBodyData.TOT_DEDUCTION+"' style='border:0px solid;outline:none;font-weight: 900;' readonly><input type='hidden' id='getPITaxAmt_"+rowId+"' value='0'></div></div></td></tr><tr height='20px'></tr><tr><td colspan='3' id='empInfo1'>Net Salary </td><td><input type='hidden' id='total_ded_"+rowId+"' name='total_ded[]' class='form-control text-right inputwageInd' value=''><input type='hidden' id='netSal_"+rowId+"' value='"+headBodyData.TOT_SALARY+"'><p style='padding-top: 5%;font-weight: 900;text-align: center;' id='totalNp_"+rowId+"'>"+headBodyData.TOT_SALARY+"</p><input type='hidden' id='balance_"+rowId+"' value=''></p><input type='hidden' id='pfYrAmt_"+rowId+"'><input type='hidden' id='ptaxAmt_"+rowId+"'></td></tr><tr height='20px'></tr><tr><td colspan='2' style='padding-left: 18px;'><strong>Attendance Details</strong></td><td colspan='2' style='padding-left: 18px;'><strong>Form 16 Summary</strong></td></tr><tr><td colspan='2' style='vertical-align: top;text-align:left'><div class='row' style='padding-top: 4%;'><div class='col-md-5 text-left pl-5'><lable style='padding:20px;'><strong>MM Days</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='totalWorkDays_"+rowId+"' name='totalWorkDays[]' value='"+empAttendData.MONTH_DAYS+"' style='border: 0px solid; outline: none;z-index: 0;' readonly><input type='hidden' id='yr_month_"+rowId+"' value='"+empAttendData.YR_MONTH+"'></div></div><div class='row'><div class='col-md-5 text-left pl-5'><lable style='padding:20px;'><strong>Holidays </strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='holiday_"+rowId+"' name='holiday[]' value='"+empAttendData.HOLIDAY+"' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-5 text-left pl-5'><lable style='padding:20px;'><strong>Leave(SL/CL) </strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='leaves_"+rowId+"' name='leaves[]' value='"+empAttendData.LEAVE+"' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-5  text-left pl-5'><lable style='padding:20px;'><strong>Absent</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='absent_"+rowId+"' name='absent[]' value='"+empAttendData.ABSENT_DAYS+"' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-5'><lable style='padding:20px;'><strong>Working Days </strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='numWorkDay_"+rowId+"' name='numWorkDay[]' value='"+empAttendData.WORKING_DAYS+"' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div></td><td colspan='2' style='vertical-align: top;text-align:left'><div class='row' style='padding-top: 4%;'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Gross Salary  </strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='grossSal_"+rowId+"' name='grossSal[]' value='"+headForm16Data.GROSS_SAL+"' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Deduction</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='deduction"+rowId+"' name='deduction[]' value='"+headForm16Data.DEDUCTION+"' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Taxable Income</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='taxableIn_"+rowId+"' name='taxableIn[]' value='"+headForm16Data.TAXABLE_INCOME+"' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Tax Amt.</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='taxAmt_"+rowId+"' name='taxAmt[]' value='"+headForm16Data.TAX_AMT+"' style='border: 0px solid; outline: none;z-index: 0;'></div></div><div class='row'></div><input type='hidden' id='totalMonth_"+rowId+"' value='' readonly></div><div class='row'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Tax Paid</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left' ><input type='text' id='taxpaid_"+rowId+"' name='taxpaid[]' value='"+headForm16Data.TAX_PAID+"' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div><div class='row'><div class='col-md-6 text-left pl-5'><lable style='padding:20px;'><strong>Net Tax / Due Refund</strong> </label></div><div class='col-md-1'><strong>:  </strong></div><div class='col-md-4 text-left'><input type='text' id='taxDueRefund_"+rowId+"' name='taxDueRefund[]' value='"+headForm16Data.NET_TAX+"' style='border: 0px solid; outline: none;z-index: 0;' readonly></div></div></td></tr><tr height='80px'><td colspan='2' style='font-weight:bold'></td><td colspan='2' style='font-weight:bold'></td></tr><tr><td colspan='2' style='font-weight:bold;padding-left: 18px;'>Employee Signature</td><td colspan='2' style='font-weight:bold;padding-left: 18px;'>Employer Signature</td></tr></table><div class='box-row'><div class='box10 amountBox'><input type='hidden' class='form-control text-right' id='ctc_amt_"+rowId+"' value='' name='ctcAmount[]' readonly style='z-index: 0;width: 90%;'><input type='hidden' class='form-control text-right' id='monthDays_"+rowId+"' value='' name='monthDays' readonly><input type='hidden' id='abs_day_"+rowId+"' name='' class='form-control text-right' style='z-index: 0;' value='' readonly></div></div>";

        $('#paymentReceipt').append(TableHeadData);

        $('#exampleModalLabel_').text(headData.COMP_NAME);

        $('#comp_add').text(obj.data.compAddr);

        $('#empName_'+rowId).val(empData.EMP_NAME);

        var doj = empData.DOJ;

        var slipDate = doj.split('-');

        var doj_y = slipDate[0];
        var doj_m = slipDate[1];
        var doj_d = slipDate[2];

        var final_doj = doj_d+"-"+doj_m+"-"+doj_y;
        
        $('#empDOJ_'+rowId).val(final_doj);

        $('#pan_'+rowId).val(empData.PAN_NO);

        $('#ecode_'+rowId).val(empData.EMP_CODE);
        
        $('#empDesig_'+rowId).val(empData.DESIG_NAME);
        
        $('#accNo_'+rowId).val(empData.BANK_ACCOUNT_NO);

        $('#bankName_'+rowId).val(empData.BANK_NAME);

        $('#ifsc_'+rowId).val(empData.BANK_IFSC);

         var TableDeduct = "<tr><td style='width:46%;'><div class='col-md-9'><input type='text' style='z-index: 0;width:100%; text-align:center; border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;' id='pTaxInd_"+rowId+"' value='P-TAX' name='head_wageInd[]'><input type='hidden'  name='wagetype[]' id='ptaxType_"+rowId+"' value='DEDUCTION'></div></td><td style='width:30%;padding:5px;'><input type='text' id='ptax_"+rowId+"'  name='amount[]' class='form-control text-right'  readonly style='z-index: 0;width:100%;' value='0' autocomplete='off'></td></tr><tr><td style='width:46%;'><div class='col-md-9'><input type='text' id='iTaxInd_"+rowId+"' style='z-index: 0;width:100%; text-align:center; border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;' value='I-TAX' name='head_wageInd[]'><input type='hidden'  name='wagetype[]' id='itaxType_"+rowId+"' value='DEDUCTION'></div><div class='col-md-2'></div></td><td style='width:30%;padding:5px;'><input type='text' id='iTax_"+rowId+"'  name='amount[]' class='form-control text-right'  readonly style='z-index: 0;width:100%;' value='0' autocomplete='off'></td></tr><tr><td style='width:46%;'><div class='col-md-9'><input type='text' id='advaOrLoanInd_"+rowId+"' style='z-index: 0;width:100%; text-align:center; border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;' value='Advance/Loan' name='head_wageInd[]'><input type='hidden'  name='wagetype[]' id='itaxType_"+rowId+"' value='DEDUCTION'></div><div class='col-md-2'></div></td><td style='width:30%;padding:5px;'><input type='text' id='advAmt_"+rowId+"'  name='amount[]' class='form-control text-right'  readonly style='z-index: 0;width:100%;' value='"+headBodyData.TOT_DEDUCTION+"' autocomplete='off'></td></tr>";

          $('#deducParticular_'+rowId).append(TableDeduct);

          var srNo = 1;
          
          $.each(headWageData, function(k, getData) {

          if(getData.WAGE_TYPE == 'EARNING'){

              var TableData = "<tr><td style='width:46%;'><div class='col-md-9'><input type='text' id='wageIndicator_"+srNo+"' name='head_wageInd[]' class='form-control inputtaxInd' style='z-index: 0;width:105%; border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;' value=\""+getData.WAGE_INDICATOR+"\" readonly></div></div><div class='box10 amountBox'></td><td style='width:30%;padding:5px;'><input type='text' id='wageIndAmt_"+srNo+"'  name='indAmount[]'class='form-control text-right' style='z-index: 0;width: 100%;' autocomplete='off' value='"+getData.AMOUNT+"' readonly><input type='hidden' id='wageIndType_"+srNo+"'  name='wageIndType[]' value='"+getData.WAGETYPE+"' readonly></td></tr>";

                $('#inParticular_'+rowId).append(TableData);
                      
          }else{

            if(getData.WAGE_TYPE == 'DEDUCTION'){
                          
                var TableData = "<tr><td style='width:46%;'><div class='col-md-9'><input type='text' id='wageIndicator_"+srNo+"' name='head_wageInd[]' class='form-control inputtaxInd' style='z-index: 0;width:100%; border-top-style: hidden;border-right-style: hidden;border-left-style: hidden;border-bottom-style: hidden;' value=\""+getData.WAGE_INDICATOR+"\" readonly></div></div><div class='box10 amountBox'></td><td style='width:30%;padding:5px;'><input type='text' id='wageIndAmt_"+srNo+"'  name='indAmount[]'class='form-control text-right' style='z-index: 0;width: 100%;' autocomplete='off' value='"+getData.AMOUNT+"' readonly></td></tr>";
                        
                }

                $('#deducParticular_'+rowCount).append(TableData);

          }
          srNo++;

        });

        var payRecFooter = "<button type='button' class='btn btn-primary' data-dismiss='modal' style='width:100px'>OK</button><button class='btn btn-danger' style='width: 100px;'><i class='fa fa-file-pdf-o' aria-hidden='true'></i> PDF</button>";
        
        $('#paymentReceipt_footer').append(payRecFooter);

        $('#payment_receipt').modal('show');
    }
   });

   }

</script>





@endsection







