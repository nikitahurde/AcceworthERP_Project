@extends('admin.main')



@section('AdminMainContent')



@include('admin.include.header')


<meta name="csrf-token" content="{{ csrf_token() }}">


@include('admin.include.navbar')



@include('admin.include.sidebar')
<style type="text/css">

    .tooltip{
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

.dataTables_filter{
  text-align: right !important;
  margin-top: 1% !important;
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
    -webkit-user-select: none!important;
    -moz-user-select: none!important;
    -ms-user-select: none!important;
    border: 1px solid transparent!important;
    font-size: 13px!important;
    line-height: 1.2!important;
    border-radius: .25rem!important;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out!important;
    margin-right: 19% !important;
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
           Inward Do Change Destination
            <small> : Change Destination Details</small>
          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="javascript:void(0)">Logistics</a></li>

            <li class="active"><a href="{{ url('/logistic/cancel-delivery-order-quantity') }}"> Change Inward Do Destination</a></li>

          </ol>

        </section> 

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Inward Do Change Destination </h2>

              <!-- <div class="box-tools pull-right">

                <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

              </div> -->



            </div><!-- /.box-header -->

            <div class="box-body">

              <?php date_default_timezone_set('Asia/Kolkata'); ?>

              <div class="row">

                 <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">ACC CODE : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="acc_list" id="acc_code" name="acc_code" class="form-control  pull-left" value="" placeholder="Select Acc Code" onchange="getDoDetailsByCust()"  autocomplete="off">


                          <datalist id="acc_list">

                            <?php foreach ($acc_list as $value): ?>

                               <option value="{{$value->ACC_CODE }}" data-xyz ="{{ $value->ACC_NAME }}">{{ $value->ACC_CODE}} - {{ $value->ACC_NAME}}</option>
                              
                            <?php endforeach ?>

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_do_no"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>

                  <div class="col-md-3">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Consinee Code :</label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                          </div>

                          <input list="custList" id="cust_no" name="cust_no" class="form-control  pull-left" value="" placeholder="Select Customer Code" onchange="getcpName()" autocomplete="off">


                          <datalist id="custList">

                            <?php foreach ($dorder_list1 as $value): ?>

                              <option value="<?php echo $value->CP_CODE.'-'.$value->CP_NAME; ?>"data-xyz ="{{ $value->CP_NAME }}">{{ $value->CP_CODE}} = {{$value->CP_NAME}}</option>
                              
                            <?php endforeach ?>
                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>
                  

                </div>

                <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">RAKE No : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="rake_list" id="rake_no" name="rake_no" class="form-control  pull-left" value="" placeholder="Select DO No." autocomplete="off" onchange="getDoNoByRakeNo()">


                          <datalist id="rake_list">

                          
                          <?php foreach ($rake_list as $value): ?>

                              <option value="<?php echo $value->RAKE_NO; ?>"data-xyz ="{{ $value->RAKE_NO }}">{{ $value->RAKE_NO}}</option>
                              
                            <?php endforeach ?>

                          </datalist>

                      </div>


                  </div>

                </div>

                 <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">DO No : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="dorder_list" id="do_no" name="do_no" class="form-control  pull-left" value="" placeholder="Select DO No." autocomplete="off" onchange="getWagonNo()">


                          <datalist id="dorder_list">

                            <?php foreach ($dorder_list as $value): ?>

                               <option value="{{$value->DORDER_NO}}" data-xyz ="{{ $value->DORDER_NO }}">{{ $value->DORDER_NO}}</option>
                              
                            <?php endforeach ?>

                          </datalist>

                      </div>


                  </div>

                </div><!-- /.col -->

                <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Wagon No : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="wagon_list" id="wagon_no" name="wagon_no" class="form-control  pull-left" value="" placeholder="Select Wagon No." onchange="getItemName()" autocomplete="off">

                          <datalist id="wagon_list">


                          </datalist>

                      </div>

                  </div>

                </div>

                
                <!-- /.col-3 -->


              </div><!-- /.row -->

              <div class="row">
                <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">Item Name : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="item_list" id="item_name" name="item_name" class="form-control  pull-left" value="" placeholder="Select Wagon No." autocomplete="off">

                          <datalist id="item_list">

                          </datalist>

                      </div>

                  </div>

                </div>


                <div class="col-md-2">

                    <div class="form-group">

                      <label for="exampleInputEmail1">TO PLACE : </label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="toPlace_list" id="to_place" name="to_place" class="form-control  pull-left" value="" placeholder="Select To Place." autocomplete="off" readonly="">


                          <datalist id="toPlace_list">

                            <?php foreach ($toplace_list as $key): ?>

                               <option value="{{$key->TO_PLACE }}" data-xyz ="{{ $key->TO_PLACE }}">{{ $key->TO_PLACE}} - {{ $key->TO_PLACE}}</option>
                              
                            <?php endforeach ?>

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_do_no"></small>
                     <span id='searcherr' style="color: red;"></span>

                  </div>

                </div>

                <div class="col-md-3">

                    <div style="margin-top: 8px;">

                     <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" style="padding: 2px;">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                     <!--  <button type="button" class="btn btn-success" name="updatebtn" onclick="updateDoDestination()" id="updatebtn" style="padding: 2px;" disabled="">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Update&nbsp;&nbsp;</button> -->
                      <button type="button" class="btn btn-success" name="updatebtn" onclick="updateDestInwardDo()" id="updatebtn" style="padding: 2px;" disabled="">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Update&nbsp;&nbsp;</button>

                      <!-- <div style="text-align: center;">
                      <button type="button" class="btn btn-success" name="updatebtn" onclick="updateDestInwardDo()" id="updatebtn" style="padding: 2px;" >&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Update&nbsp;&nbsp;</button>
                    </div>  -->

                      <button type="button" class="btn btn-warning" onClick="window.location.reload();" name="searchdata" id="ResetId" style="padding: 2px;">&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

                    </div>

                </div>
                
              </div>
              <div class="row">
                  <div class="col-md-4">
                   
                 </div>
                 <div class="col-md-4">
                   <div><small id="updateMsg"></small></div>
                   <small id='submitErrMsg' style="color: red;font-weight: bold;"></small>
                 </div>
                 <div class="col-md-4">
                 </div>
                
              </div>
            </div><!-- /.box-body -->



    <div class="box-body" style="margin-top: -2%;">

      <table id="PurchaseIndentReportTable" class="table table-bordered table-striped table-hover">
        <thead class="theadC">
          <tr>
             <th class="text-center">#</th>
            <th class="text-center">D.O. Date</th>
            <th class="text-center">D.O. No.</th>
            <th class="text-center">Plant Code/Name</th>
            <th class="text-center">Acc Code/Name</th>
            <th class="text-center">Consinee Code/Name</th>
            <th class="text-center">Item Code/Name</th>
            <th class="text-center">From Place</th>
            <th class="text-center">To Place</th>
            <th class="text-center">Qty</th>
          </tr>
        </thead>

        <tbody id="defualtSearch"></tbody>
       
      </table>

      <!-- <div style="text-align: center;">
          <button type="button" class="btn btn-success" name="updatebtn" onclick="updateDestInwardDo()" id="updatebtn" style="padding: 2px;" >&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Update&nbsp;&nbsp;</button>
        </div>  -->   

    </div><!-- /.box-body -->

    
        
  </div>
    <input type="hidden" id="excelName" value="" />
  </section>

</div>

<!-- START : Alert : Cancel Qty Error Modal -->

<div class="modal fade" id="QtyAlertModal" tabindex="-1" role="dialog" aria-labelledby="QtyAlertModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 5px;margin-top: 30%;">
      <div class="modal-header">
        <h5 class="modal-title" id="QtyAlertModalLabel" style="font-size: 20px;text-align: center;font-weight: 800;"> 
          &nbsp; 
          <i class="fa fa-exclamation-triangle" aria-hidden="true" style='color: #df1919;font-size: 22px;'></i> &nbsp;Alert
        </h5>
      </div>
      <div class="modal-body">
        <i class="fa fa-caret-right" aria-hidden="true"></i> &nbsp;<span style='font-weight: 600;'>Please Check Cancel Qty.</span>
      </div>
      <div class="modal-footer" style="text-align: center;">
        <button type="button" data-dismiss="modal" class="btn btn-primary" style="width: 100px;">Ok</button>
      </div>
    </div>
  </div>
</div>



<!-- END : Alert : Cancel Qty Error Modal -->


@include('admin.include.footer')


<script type="text/javascript">
    
    function updateDestInwardDo(valp){  

      var downloadFlg = valp;

      $('#pdfYesNoStatus').val(downloadFlg);

     var to_place =  $('#to_place').val();

      var flitClass=[];
      var newAarry =[];

      $('.flitClass').each(function(){
          if($(this).is(":checked"))
          {
           var flitClass1 = $(this).val();


           flitClass.push(flitClass1);
           
           }
      });

      if(flitClass==''){

        //alert('check atleast one check box');
        $("#submitErrMsg").html('* check atleast one check box');

        return false;

      }else{
        $("#submitErrMsg").html('');

     /* alert(flitClass);
      return false;*/

        $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        $.ajax({

          url:"{{ url('/transaction/update-inward-do-destination-inward') }}",

           method : "POST",

           type: "JSON",

           data: {flitClass: flitClass,to_place:to_place},

           
           success:function(data){

           console.log(data);

              var data1 = JSON.parse(data);


               if (data1.response == 'error') {

                //  $("#QtyAlertModal").modal('show');

              }else if(data1.response == 'success'){

                console.log('response',data1.response);

                 // $('#PurchaseIndentReportTable').DataTable().destroy();
                 
                 $("#updateMsg").html('<button type="button" class="btn btn-success">&nbsp;&nbsp;DO Destination Updated Successfulluy</button>');

                   setTimeout(function() {
                         $("#updateMsg").hide();
                    }, 2000);

                  $('#PurchaseIndentReportTable').DataTable().ajax.reload();


                  //load_data_query(acc_code,do_no,cust_no);

              }

              
             /* if(data1.response == 'error') {
               var responseVar = false;

              var url = "{{url('finance/view-payment-msg')}}";
              setTimeout(function(){ window.location = url+'/'+responseVar; });
              }else{
               
               var responseVar = true;

              var url = "{{url('finance/view-payment-msg')}}";
              setTimeout(function(){ window.location = url+'/'+responseVar; });
              }*/

            
           }

        });

      }


    }

  </script>
 <script type="text/javascript">

    $(document).ready(function(){

      var d = new Date();
      var strDate = d.getDate() + "0" + (d.getMonth()+1) + "" + d.getFullYear();

      var time = d.getHours() + "" + d.getMinutes() + "" + d.getSeconds();

      $('#excelName').val(strDate+'_'+time);

        $( window ).on( "load", function() {

          var fromdateintrans = $('#FromDateFy').val();
          var todateintrans = $('#ToDateFy').val();

          var fromdateintrans_1 = $('#FromDateFy_1').val();
          var todateintrans_1 = $('#ToDateFy_1').val();

          $('.fromDatePc').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans,

            endDate : todateintrans,

            autoclose: 'true'

          });

          $('.toDatePc').datepicker({

            format: 'dd-mm-yyyy',

            orientation: 'bottom',

            todayHighlight: 'true',

            startDate :fromdateintrans_1,

            endDate : todateintrans_1,

            autoclose: 'true'

          });

        });

        $("#item_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#itemList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("itemText").innerHTML = msg; 

        });

        $("#plantCode").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#plantCodeList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("plantText").innerHTML = msg; 

        });


    });


</script>

<script type="text/javascript">

   $("#do_no").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#dorder_list option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

             $("#btnsearch").prop('disabled',true);

            }else{

              $("#btnsearch").prop('disabled',false);
            }

        });


     $("#to_place").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#toPlace_list option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          if(msg=='No Match'){

            $("#updatebtn").prop('disabled',true);

            }else{

              $("#updatebtn").prop('disabled',false);
            }

        });

</script>

<script type="text/javascript">
  
  function updateDoDestination(){

    
    var acc_code    =  $('#acc_code').val();
    var do_no       =  $('#do_no').val();
    var cust_no     =  $('#cust_no').val();
    var wagon_no    =  $('#wagon_no').val();
    var item_name   =  $('#item_name').val();
    var to_place    =  $('#to_place').val();


        $.ajaxSetup({

            headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $.ajax({

            url:"{{ url('/transaction/update-inward-do-destination') }}",

            method : "POST",

            type: "JSON",

            data: {acc_code:acc_code,do_no:do_no,cust_no:cust_no,to_place:to_place,wagon_no:wagon_no,item_name:item_name},

            success:function(data){

              console.log(data);

              var data1 = JSON.parse(data); 

              if (data1.response == 'error') {

                //  $("#QtyAlertModal").modal('show');

              }else if(data1.response == 'success'){

                console.log('response',data1.response);

                 // $('#PurchaseIndentReportTable').DataTable().destroy();
                 
                 $("#updateMsg").html('<button type="button" class="btn btn-success">&nbsp;&nbsp;DO Destination Updated Successfulluy</button>');

                   setTimeout(function() {
                         $("#updateMsg").hide();
                    }, 2000);

                  $('#PurchaseIndentReportTable').DataTable().ajax.reload();


                  //load_data_query(acc_code,do_no,cust_no);

              }


            }

        });


    


  }
</script>
<script>
  

  function getGrandTotal(rowno,taxD,basic,PoheadId,PoBodyId){
      
      var amtAr = [];
      var pcTax = [];
      amtAr.push(null);
      amtAr.push(basic);
      var pcTaxB = taxD[0].PCNTRTID;
      pcTax.push(pcTaxB);
      for(var l=1;l<taxD.length;l++){
        var no = l+2;
          var rate       = taxD[l].TAX_RATE;
          var indicator  = taxD[l].RATE_INDEX;
          var logic      = taxD[l].TAX_LOGIC;
          var pctId      = taxD[l].PORDERTID;
          var basicAmt   = basic;
          pcTax.push(pctId);
          if(logic == null){
            var blnAmt = 0;
              amtAr.push(blnAmt);
          }else{ 

            if(logic.length >0 || logic.length ==0){

              var logicByAmt = 0;
              for(j=1; j<=logic.length; j++)

              {

                k = logic.substring(j-1,j);
                var getAry = amtAr[k];
                
                if(getAry != undefined){

                  logicByAmt = logicByAmt + amtAr[k];

                }

              }

              if(indicator == 'A'){
                roundofrate= ((parseFloat(logicByAmt) * rate)/100);
                roundof= Math.round(roundofrate) - parseFloat(logicByAmt);
                 amtAr.push(roundof);
           
              }

              if(indicator=="N"){

                  amtMinus= -((parseFloat(logicByAmt) * rate)/100);
                  amtAr.push(amtMinus);

              }

              if(indicator=="P"){

                  addition = ((parseFloat(logicByAmt) * rate)/100);
                  amtAr.push(addition);
              }

              if(indicator=="Q"){

                 additionRoundOff = ((parseFloat(logicByAmt) * rate)/100);
                 amtAr.push(additionRoundOff);

              }

              if(indicator=="O"){

                  deductionRoundOff = -((parseFloat(logicByAmt) * rate)/100);    
                  amtAr.push(deductionRoundOff);

              }
           
              if(indicator=="Z"){

                subtotalview = ((parseFloat(logicByAmt) * rate)/100);    
                amtAr.push(subtotalview);
                
              }
             
            }
          }

      }

      $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

      });

        $.ajax({

            url:"{{ url('/update-order-cancel-cal-tax-amt') }}",

            method : "POST",

            type: "JSON",

            data: {PoheadId:PoheadId,PoBodyId:PoBodyId,amtAr:amtAr,pcTax:pcTax},

            success:function(data){

              var data1 = JSON.parse(data);
              console.log('data',data);

              if (data1.response == 'error') {

                  $('#errorItem').html("<p style='color:red;font-size: 11px;padding-top: 2%;'> Not Found...!</p>");

              }else if(data1.response == 'success'){

              }


            }

        });
  }

</script>
<script type="text/javascript">
  function getcpName(){

      var consignee = $("#cust_no").val();
      var acc_code = $("#acc_code").val();


    var xyz = $('#custList option').filter(function() {

          return this.value == consignee;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

        $("#consignee").val('');

        $("#consineeName").val('');

        $("#sp_code").prop('readonly',true);

      }else{

        
        $("#consineeName").val(msg);
        $("#sp_code").prop('readonly',false);

        $.ajax({

            url:"{{ url('/get-rake-number-by-cpcode') }}",

             method : "POST",

             type: "JSON",

             data: {consignee: consignee,acc_code:acc_code},

             success:function(data){

               // console.log(data);

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                     $("#qty").val('');
                    $("#basicTotal").val('');
                  }else if(data1.response == 'success'){

                   

                      $("#rake_list").empty();

                     $.each(data1.data, function(k, getData){

                       $("#rake_list").append($('<option>',{

                          value:getData.RAKE_NO,

                          'data-xyz':getData.RAKE_NO,
                          text:getData.RAKE_NO


                        }));

                  });

                   
                        
                  }
             }

          });

      }

 }

 function getWagonNo(){

      var consignee = $("#cust_no").val();
      var acc_code = $("#acc_code").val();
      var do_no = $("#do_no").val();

    var xyz = $('#dorder_list option').filter(function() {

          return this.value == do_no;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

       

      }else{

        

        $.ajax({

            url:"{{ url('/get-wagon-no-by-do-no') }}",

             method : "POST",

             type: "JSON",

             data: {consignee:consignee,acc_code:acc_code,do_no:do_no},

             success:function(data){

               // console.log(data);

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                  
                  }else if(data1.response == 'success'){

                    
                      $("#wagon_list").empty();

                     $.each(data1.data, function(k, getData){

                       $("#wagon_list").append($('<option>',{

                          value:getData.DO_WAGON_NO,

                          'data-xyz':getData.DO_WAGON_NO,
                          text:getData.DO_WAGON_NO


                        }));

                  });

                   
                        
                  }
             }

          });

      }

 }


 function getDoNoByRakeNo(){

      var rake_no = $("#rake_no").val();

    var xyz = $('#rake_list option').filter(function() {

          return this.value == rake_no;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

       

      }else{

        

        $.ajax({

            url:"{{ url('/get-do-no-by-rake-no') }}",

             method : "POST",

             type: "JSON",

             data: {rake_no:rake_no},

             success:function(data){

               // console.log(data);

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                  
                  }else if(data1.response == 'success'){

                    
                      $("#dorder_list").empty();

                     $.each(data1.data, function(k, getData){

                       $("#dorder_list").append($('<option>',{

                          value:getData.DORDER_NO,

                          'data-xyz':getData.DORDER_NO,
                          text:getData.DORDER_NO


                        }));

                  });

                   
                        
                  }
             }

          });

      }

 }

 function getItemName(){

      var consignee = $("#cust_no").val();
      var acc_code = $("#acc_code").val();
      var do_no = $("#do_no").val();
      var wagon_no = $("#wagon_no").val();

    var xyz = $('#wagon_list option').filter(function() {

          return this.value == wagon_no;

        }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){

       
        $("#to_place").prop('readonly',true);
      }else{

        

        $.ajax({

            url:"{{ url('/get-item-name-by-wagon-no') }}",

             method : "POST",

             type: "JSON",

             data: {consignee:consignee,acc_code:acc_code,do_no:do_no,wagon_no:wagon_no},

             success:function(data){

               // console.log(data);

                  var data1 = JSON.parse(data);

                  if (data1.response == 'error') {

                  
                  }else if(data1.response == 'success'){


                      $("#to_place").prop('readonly',false);
                      $("#item_list").empty();

                     $.each(data1.data, function(k, getData){

                       $("#item_list").append($('<option>',{

                          value:getData.REMARK,

                          'data-xyz':getData.REMARK,
                          text:getData.REMARK


                        }));

                  });

                   
                        
                  }
             }

          });

      }

 }
</script>
<script type="text/javascript">

  load_data_query()

  function load_data_query(acc_code='',cust_no='',do_no='',wagon_no='',item_name='',rake_no=''){

    // console.log('from_date',from_date);
    // console.log('to_date',to_date);
    // console.log('do_no',do_no);
   
    // console.log('cust_no',cust_no);
 

      $('#PurchaseIndentReportTable').DataTable({

          processing: true,
          serverSide: true,
          scrollX: true,
          pageLength:'25',
          dom: "<'top'Bf><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
          
          buttons:  [
                      /*{
                        extend: 'excelHtml5',
                        title: 'DeliveryOrderQtyCancelExcel_'+$("#excelName").val(),
                      }*/
                    ],
         
          ajax:{
            url:'{{ url("/logistic/get-data-change-dest-inward-do") }}',
            data: {acc_code:acc_code,cust_no:cust_no,do_no:do_no,wagon_no:wagon_no,item_name:item_name,rake_no:rake_no}
          },
          columns: [

            // { 
            //   data:"DT_RowIndex",
            //   className:"text-center"
            // },
            { 
              data:"DT_RowIndex",
              name:"DT_RowIndex",
              className:"text-center",
              'render': function (data, type, full, meta){
                         return '<input type="checkbox" name="flit_id[]" onclick="clickCheck()" class="flitClass" value="'+full['DORDERBID']+'"><input type="hidden" name="tripHeadid"  value="'+full['DORDERBID']+'">';
                     }
            },
            {
              render: function (data, type, full, meta){
                  
                var dOrderDate = full['DORDER_DATE'];
               /* var spliteDt = dOrderDate.split('-');
                var yy = spliteDt[0];
                var mm = spliteDt[1];
                var dd = spliteDt[2];*/

                return dOrderDate;              

              },
              className:'text-right'
            },
            {
                data:'DORDER_NO',
                name:'DORDER_NO',
                className:'text-right'
            },
            {
              render: function (data, type, full, meta){
                  
                var itemName = '<span>'+full['PLANT_CODE']+'</span>'+' <span> ('+full['PLANT_NAME']+')<input type="hidden" id="plantCodeId'+full['DT_RowIndex']+'" value="'+full['PLANT_CODE']+'"></span>';
                return itemName;              

              },
              className:'text-left'
            },
            {
              render: function (data, type, full, meta){
                  
                var itemName = '<span>'+full['ACC_CODE']+'</span>'+' <span> ('+full['ACC_NAME']+')<input type="hidden" id="accCodeId'+full['DT_RowIndex']+'" value="'+full['ACC_CODE']+'"></span>';
                return itemName;              

              },
              className:'text-left'
            },
            {
              render: function (data, type, full, meta){
                  
                var itemName = '<span>'+full['CP_CODE']+'</span>'+' <span> ('+full['CP_NAME']+')<input type="hidden" id="cpCodeId'+full['DT_RowIndex']+'" value="'+full['CP_CODE']+'"></span>';
                return itemName;              

              },
              className:'text-left'
            },
            {
              render: function (data, type, full, meta){
                  
                var itemName = '<span>'+full['ITEM_NAME']+'</span>'+' <span style="line-height:2px;"> ('+full['ITEM_CODE']+')<input type="hidden" id="itemCodeId'+full['DT_RowIndex']+'" value="'+full['ITEM_CODE']+'"></span>';
                return itemName;

              },
              className:'text-left'
            },
            {
              render: function (data, type, full, meta){
                  
                var from_place = '<span>'+full['FROM_PLACE'];
                return from_place;

              },
              className:'text-left'
            },
            {
              render: function (data, type, full, meta){
                  
                var toPlace = '<span>'+full['TO_PLACE'];
                return toPlace;

              },
              className:'text-left'
            },
            {
                render: function (data, type, full, meta){

                  var REMANINGQTY = full['QTY'] - full['DISPATCH_PLAN_QTY'];

                  var finalQty = REMANINGQTY - full['CANCEL_QTY'];

                  return finalQty.toFixed(3);

                },
                className:'text-right'
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


    


    $('#btnsearch').click(function(){

          var acc_code  =  $('#acc_code').val();
          var cust_no   =  $('#cust_no').val();
          var do_no     =  $('#do_no').val();
          var rake_no   =  $('#rake_no').val();
          var wagon_no  =  $('#wagon_no').val();
          var item_name =  $('#item_name').val();

          $('#from_date').prop('readonly', 'true');
          $('#to_date').prop('readonly', 'true');
          $('#do_no').prop('readonly', 'true');
          $('#vr_num').prop('readonly', 'true');
          $('#cust_no').prop('readonly', 'true');


          if (acc_code!='' || cust_no=='' || do_no=='' || wagon_no=='' || item_name=='' || rake_no=='') {

            $('#PurchaseIndentReportTable').DataTable().destroy();

            load_data_query(acc_code,cust_no,do_no,wagon_no,item_name,rake_no);

            $("#to_place").prop('readonly',false);

          }else{
            $('#PurchaseIndentReportTable').DataTable().destroy();
            load_data_query();
            $("#to_place").prop('readonly',true);
          }


        });


    $('#ResetId').click(function(){
  
      $("#from_date").val('');
      $("#to_date").val('');
      $("#do_no").val('');
     
      $("#cust_no").val('');

      $("#from_date").prop('readonly', false);
      $("#to_date").prop('readonly', false);
      $("#do_no").prop('readonly', false);
      $("#cust_no").prop('readonly', false);
      
      $('#PurchaseIndentReportTable').DataTable().destroy();
      load_data_query();

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
  
  function clickCheck(){


    $('.flitClass').each(function(){

      if($(this).is(":checked")){

              var chekcValue = $(this).val();

              $("#chekcValue").val(chekcValue);

              //alert(chekcValue);

            // $("#updatebtn").prop('disabled',false);
             
      }else{

           //$("#updatebtn").prop('disabled',true);

      }
    });

  }
  
</script>

<script type="text/javascript">
  
  function getDoDetailsByCust(){

   var account_code = $("#acc_code").val();

   if (account_code=='') {
      $('#account_code').css('border-color','#ff0000').focus();
   }else{
      $('#account_code').css('border-color','#d2d6de');
      
   }

 $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

     $.ajax({

          url:"{{ url('get-do-details-by-customer-woitem') }}",

          method : "POST",

          type: "JSON",

          data: {account_code: account_code},

          success:function(data){

            var data1 = JSON.parse(data);

            //console.log(data1);

            console.log(data1.acc_data);

                  $("#off_days").val(data1.acc_data.OFF_DAYS);

              if (data1.response == 'error') {

                $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

              }else if(data1.response == 'success'){


                   //$("#ConsineeList1").empty();
                   $("#custList").empty();

                  $.each(data1.data, function(k, getData){

                      console.log('qty',);

                      var plan_qty = parseFloat(getData.QTY);
                      var dispacth_qty =parseFloat(getData.DISPATCH_PLAN_QTY);
                      
                      if(plan_qty != dispacth_qty){

                            $("#custList").append($('<option>',{

                          value:getData.CP_CODE,

                          'data-xyz':getData.CP_NAME,
                          text:getData.CP_CODE+' - '+getData.CP_NAME


                        }));
                            

                      }
                     
                    
                    

                  })

                
                
              }

          }

    });

  }
</script>

@endsection