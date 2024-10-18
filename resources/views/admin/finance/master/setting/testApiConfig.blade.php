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


  }

  .actionBTN{
    font-size: 10px;
    padding: 0px 2px;
  }

  .beforhidetble{
    display: none;
  }
  .popover{
    left: 70.4922px!important;
    width: 110%!important;
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
    font-size: 12px!important;
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

    <h1> Test Api

      <small>View Details</small>
    </h1>

    <ol class="breadcrumb">


      <li><a href="{{ URL('/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ URL('/dashboard')}}">Configuration</a></li>

      <li class="Active"><a href="#">test Api</a></li>



    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!-- <div class="col-sm-2"></div> -->

      <div class="col-sm-12">

        <div class="box box-primary Custom-Box">

          <div class="box-header with-border" style="text-align: center;">

            <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;" id="getPAgeTitleNAme">All Api List</h2>

            <div class="box-tools pull-right">

              <a href="#" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View Test Api</a>

            </div>

          </div><!-- /.box-header -->



          @if(Session::has('alert-success'))


          <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4><i class="icon fa fa-check"></i>

              Success...!

            </h4>

            {!! session('alert-success') !!}

          </div>

          @endif

          @if(Session::has('alert-error'))
          <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

            <h4> <i class="icon fa fa-ban"></i>

              Error...!
            </h4>

            {!! session('alert-error') !!}
          </div>

          @endif

          <div class="box-body">

            <div id="apiResponseMsg"></div>

            <div class="modalspinner hideloaderOnModl"></div>

            <table id="showTblCol" class="table table-bordered table-striped table-hover">

              <thead>

                <tr>

                  <th class="text-center">API CODE</th>

                  <th class="text-center">API NAME</th>

                  <th class="text-center">USER NAME</th>

                  <th class="text-center">PASSWORD</th>

                  <th class="text-center">ACTION</th>

                </tr>

              </thead>
              
              <tbody>

              </tbody>

            </table>

  <!--------- START : LOGILOCKER API MODAL ---------------->

    <div id="apiModallogylocker" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="text-align:center;">
            <h4 class="modal-title">LOGILOCKER</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="col-md-12">

              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                  <div class="form-group">

                    <label>Vehicle No : </label>
                      
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                        <input list="vehicleNoList" type="text" class="form-control" name="vehicleNo" id="vehicleNo" placeholder="Enter Vehicle No." value="" autocomplete="off">

                        <datalist id="vehicleNoList">

                        </datalist>
                    
                      </div>
                  </div>

                </div>

                <input type="hidden" name="gstin" id="gstinId" value="" />

                <input type="hidden" name="logiLockApiToken" id="logiLockApiToken" value="" />

                <div class="col-md-4">
                  <div class="form-group">

                    <label>Force Update : <span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></span>

                      <input type="text" id="forceUpdate" name="forceUpdate" class="form-control  pull-left" value="true" placeholder="Select Acc Name" maxlength="10" readonly autocomplete="off">

                    </div>

                    <small id="forceUpdateMsg" class="form-text text-muted"></small>

                  </div><!-- /.form-group -->

                </div>

                <div class="col-md-2"></div>

              </div>

            </div>

          </div>

          <div class="modal-footer" style="text-align: center;margin-top:5%;">
            <button type="button" onclick="getApiData('LOGILOCKER')" class="btn btn-success">&nbsp;&nbsp; Run API &nbsp;&nbsp;</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;&nbsp; Reset &nbsp;&nbsp;</button>

          </div>
        </div>
      </div>
    </div>

  <!--------- END : LOGILOCKER API MODAL ---------------->


  <!--------- START : EASY-WAYBILL API MODAL ---------------->

    <div id="apiModalEasyWayBill" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="text-align:center;">
            <h4 class="modal-title">EASY-WAYBILL</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="col-md-12">

              <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                  <div class="form-group">

                    <label>E-WAYBILL NO : </label>
                      
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                        <input type="text" class="form-control" name="ewayBillNo" id="ewayBillNo" placeholder="ENTER E-WAYBILL NO" value="" autocomplete="off">
                    
                      </div>
                  </div>

                </div>
               
                <input type="hidden" name="easyWayBillApiToken" id="easyWayBillApiToken" value="" />

                <div class="col-md-4">
                  <div class="form-group">

                    <label>GST-NO : </label>
                      
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                        <input list="gstNoList" type="text" class="form-control" name="gstNo" id="gstNo" placeholder="Select GST NO" value="" autocomplete="off">

                        <datalist id="gstNoList">

                        </datalist>
                    
                      </div>
                  </div>

                </div>

                <div class="col-md-2"></div>

              </div>

            </div>

          </div>

          <div class="modal-footer" style="text-align: center;margin-top:5%;">
            <button type="button" onclick="getApiData('EWAY-BILL')" class="btn btn-success">&nbsp;&nbsp; Run API &nbsp;&nbsp;</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;&nbsp; Reset &nbsp;&nbsp;</button>

          </div>
        </div>
      </div>
    </div>

  <!--------- END : LOGILOCKER API MODAL ---------------->

  <!--------- START : ETRANS API MODAL ---------------->

    <div id="apiModalEtrans" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="text-align:center;">
            <h4 class="modal-title">ETRANS</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="col-md-12">

              <div class="row">
                <div class="col-md-4"></div>

               <div class="col-md-4">
                  <div class="form-group">

                    <label>Vehicle No : </label>
                      
                      <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-sort-numeric-asc" aria-hidden="true"></i></span>

                        <input list="vehicleNoList" type="text" class="form-control" name="vehicleNo" id="vehicleNo" placeholder="Enter Vehicle No." value="" autocomplete="off">

                        <datalist id="vehicleNoList">

                        </datalist>
                    
                      </div>
                  </div>

                </div>
               
                <input type="hidden" name="etransApiToken" id="etransApiToken" value="" />

                <div class="col-md-4"></div>

              </div>

            </div>

          </div>

          <div class="modal-footer" style="text-align: center;margin-top:5%;">
            <button type="button" onclick="getApiData('ETRANS')" class="btn btn-success">&nbsp;&nbsp; Run API &nbsp;&nbsp;</button>
            <button type="button" class="btn btn-warning" data-dismiss="modal">&nbsp;&nbsp; Reset &nbsp;&nbsp;</button>

          </div>
        </div>
      </div>
    </div>

  <!--------- END : ETRANS API MODAL ---------------->

          </div><!-- /.box-body -->

        </div>

      </div>

<!--   <div class="col-sm-4">


</div> -->

</div>

</section>

</div>



@include('admin.include.footer')


<script type="text/javascript">

 $(document).ready(function() {

  var t = $('#showTblCol').DataTable({
    processing: true,
    serverSide: true,
    scrollX: true,
    pageLength: '25',
    buttons: [{
      extend: 'excelHtml5',
      title: 'testConfig',
      footer: true
    }],
    ajax: {
      url: '{{ url("/configration/test-api-config") }}',
    },
    columns: [
      { data: "API_CODE", className: "" },
      { data: "API_NAME", className: "" },
      { data: "USER_NAME", className: "" },
      { data: "PASSWORD", className: "" },
      {
        render: function(data, type, full, meta) {
          var deletebtn = '<button type="button" class="btn btn-xs btn-primary" onclick="checkedApi('+full['DT_RowIndex']+',\''+full['API_NAME']+'\',\''+full['USER_NAME']+'\',\''+full['PASSWORD']+'\',\''+full['API_LINK']+'\')" style="font-size: 10px;" data-toggle="modal">Test Api</button>';
          return deletebtn;
        },
        className: "text-center",
      },
    ],
  });

  
});


 function checkedApi(rowID,apiName,urName,psWord,apiLink){

  // console.log('rowID', rowID);
  // console.log('apiName', apiName);
  // console.log('userName', urName);
  // console.log('passWord', psWord);
  // console.log('apiLink', apiLink);

  if (urName == '' || urName == null || urName == 'null') {

    var userName = 'swetalenterprises7@gmail.com';
    var passWord = 'Shreyas@123';

  }else{

    var userName = urName;
    var passWord = psWord;

  }

  

  $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('/test-api/get-api-data') }}",

          method : "POST",

          type: "JSON",

          data: {userName:userName,passWord:passWord,apiLink:apiLink,apiName:apiName},
          beforeSend: function() {
            console.log('start spinner');
            $('.modalspinner').removeClass('hideloaderOnModl');
          },
          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#apiResponseMsg').html("<p style='color:red'> Values Of USERNAME or PASSWORD or API-LINK or API-NAME Not Fond...! </p>");

              }else if(data1.response == 'ajax error'){

                $('#apiResponseMsg').html("<p style='color:red'> AJAX ERROR...! </p>");


              }else if(data1.response == 'success'){


                  if (apiName == 'LOGILOCKER') {

                    console.log('logilocker',data1.logiLockerApi_list.response.token); 

                    $('#logiLockApiToken').val(data1.logiLockerApi_list.response.token);

                    if (data1.logiLockerApi_list.status == 1) {

                      $('#apiResponseMsg').html("");

                      $('#apiModallogylocker').modal('show');

                      //console.log('vehicle ',data1.fleet_list);

                      $.each(data1.fleet_list, function(k, getData){

                        $("#vehicleNoList").append($('<option>',{

                          value:getData.TRUCK_NO,
                          'data-xyz':getData.TRUCK_NO,
                          text:getData.TRUCK_NO

                        }));

                      });


                    }else{

                      $('#apiResponseMsg').html("<p style='color:red'> API Not Running Properly...! </p>");

                    }

                  }else if(apiName == 'EWAY-BILL' || apiName == 'EWAYBILL COMPLETE LOGIN'){

                    console.log('eway-bill',data1.easyWayBillLogin_list); 

                    $('#easyWayBillApiToken').val(data1.easyWayBillLogin_list.response.token);

                    if (data1.easyWayBillLogin_list.status == 1) {

                      $('#apiResponseMsg').html("");

                      $('#apiModalEasyWayBill').modal('show');

                      $.each(data1.gst_list, function(k, getData){

                        //console.log('each-gst',getData);

                        $("#gstNoList").append($('<option>',{

                          value:getData.GST_NO,
                          'data-xyz':getData.GST_NO,
                          text:getData.GST_NO

                        }));

                      });


                    }else{

                      $('#apiResponseMsg').html("<p style='color:red'> API Not Running Properly...! </p>");

                    }


                  }else if(apiName == 'ETRANS'){

                    // apiModalEtrans
                    // vehicleNo
                    // etransApiToken

                    console.log('etrans',data1.etransApi_list); 

                    $('#etransApiToken').val(data1.etransApi_list.code);

                    if (data1.etransApi_list.result.length > 0) {

                      $('#apiResponseMsg').html("");

                      $('#apiModalEtrans').modal('show');

                      $.each(data1.fleet_list, function(k, getData){

                        $("#vehicleNoList").append($('<option>',{

                          value:getData.TRUCK_NO,
                          'data-xyz':getData.TRUCK_NO,
                          text:getData.TRUCK_NO

                        }));

                      });


                    }else{

                      $('#apiResponseMsg').html("<p style='color:red'> API Not Running Properly...! </p>");

                    }


                  }else{


                  }

              }

          },
          complete: function() {
            console.log('end spinner');
            $('.modalspinner').addClass('hideloaderOnModl');
          },
    });

 }

 function getApiData(apiName){

  console.log('name',apiName);

  if(apiName == 'LOGILOCKER'){

    var mVar1 = $('#vehicleNo').val();
    var mVar2 = $('#gstinId').val();
    var mVar3 = $('#forceUpdate').val();
    var mVar4 = $('#logiLockApiToken').val();

  }else if(apiName == 'EWAY-BILL' || apiName == 'EWAYBILL COMPLETE LOGIN') {

    var mVar1 = $('#ewayBillNo').val();
    var mVar4 = $('#easyWayBillApiToken').val();
    var mVar3 = $('#gstNo').val();
    var mVar2 = '';

    console.log('mVar1',mVar1);
    console.log('mVar4',mVar4);
    console.log('mVar3',mVar3);


  }else if(apiName == 'ETRANS'){

    var mVar1 = $('#vehicleNo').val();
    var mVar4 = $('#etransApiToken').val();
    var mVar3 = '';
    var mVar2 = '';

  }else{

    var mVar1 = '';
    var mVar4 = '';
    var mVar3 = '';
    var mVar2 = '';

  }
  
    

    $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }
    });

    $.ajax({

          url:"{{ url('/test-api/runAPI') }}",

          method : "POST",

          type: "JSON",

          data: {mVar1:mVar1,mVar2:mVar2,mVar3:mVar3,mVar4:mVar4,apiName:apiName},
          beforeSend: function() {
            console.log('start spinner');
             $('#apiModallogylocker').modal('hide');
             $('#apiModalEasyWayBill').modal('hide');
             $('#apiModalEtrans').modal('hide');  
            $('.modalspinner').removeClass('hideloaderOnModl');
          },
          success:function(data){

            var data1 = JSON.parse(data);

              if (data1.response == 'error') {

                $('#apiResponseMsg').html("<p style='color:red'> Values Of VEHICLE NO or GSTIN-ID or FORCEUPDATE or API-NAME Not Fond...! </p>");

              }else if(data1.response == 'ajax error'){

                $('#apiResponseMsg').html("<p style='color:red'> AJAX ERROR...! </p>");


              }else if(data1.response == 'success'){


                  if (apiName == 'LOGILOCKER') {

                    console.log('IN-LOGILOCKER');

                    //console.log('logilocker',data1.logiLockerApi_list.response); 

                    if (data1.logiLockerApi_list.response !='') {

                      $('#apiModallogylocker').modal('hide');

                      $('#apiResponseMsg').html("");

                      $('#apiResponseMsg').html("<div class='alert alert-success alert-dismissible' style='width: 96%;margin-left: 2%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i>Success...!</h4> API Running Properly...! </div>");


                    }else{

                      $('#apiModallogylocker').modal('hide');

                      $('#apiResponseMsg').html("");

                      $('#apiResponseMsg').html("<div class='alert alert-danger alert-dismissible' style='width: 96%;margin-left: 2%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i>Alert...!</h4> API Not Running Properly...! </div>");

                      $.ajax({

                          url:"{{ url('/test-api/apiNotRun-mail-send') }}",

                          method : "POST",

                          type: "JSON",

                          data: {apiName:apiName},

                          success:function(response){

                            var data0 = JSON.parse(response);

                            console.log('msg',data0);

                            $('#apiResponseMsg').html("");

                            $('#apiResponseMsg').html("<div class='alert alert-success alert-dismissible' style='width: 96%;margin-left: 2%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i>Success...!</h4> Email Send To API Service Provider...! </div>");
                                 

                          }


                      });

                    }

                  }else if(apiName == 'EWAY-BILL' || apiName == 'EWAYBILL COMPLETE LOGIN'){

                    //console.log('IN-EWAY-BILL');

                    console.log('eway-bill101',data1.easyWayBillCompLogin_list);

                    if (data1.easyWayBillCompLogin_list.status == 1) {

                      $('#apiModalEasyWayBill').modal('hide');

                      $('#apiResponseMsg').html("");

                      $('#apiResponseMsg').html("<div class='alert alert-success alert-dismissible' style='width: 96%;margin-left: 2%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i>Success...!</h4> API Running Properly...! </div>");


                    }else{

                      $('#apiModalEasyWayBill').modal('hide');

                      $('#apiResponseMsg').html("");

                      $('#apiResponseMsg').html("<div class='alert alert-danger alert-dismissible' style='width: 96%;margin-left: 2%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i>Alert...!</h4> API Not Running Properly...! </div>");

                      $.ajax({

                          url:"{{ url('/test-api/apiNotRun-mail-send') }}",

                          method : "POST",

                          type: "JSON",

                          data: {apiName:apiName},

                          success:function(response){

                            var data0 = JSON.parse(response);

                            console.log('msg',data0);

                            $('#apiResponseMsg').html("");

                            $('#apiResponseMsg').html("<div class='alert alert-success alert-dismissible' style='width: 96%;margin-left: 2%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i>Success...!</h4> Email Send To API Service Provider...! </div>");
                                 

                          }


                      });


                    }


                  }else if(apiName == 'ETRANS'){


                    console.log('etrans',data1.etransApi_list.result[0].message);

                    if (data1.etransApi_list.code == 0) {

                      $('#apiModalEtrans').modal('hide');

                      $('#apiResponseMsg').html("");

                      $('#apiResponseMsg').html("<div class='alert alert-success alert-dismissible' style='width: 96%;margin-left: 2%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i>Success...!</h4> API Running Properly...! </div>");


                    }else{

                      $('#apiModalEtrans').modal('hide');

                      $('#apiResponseMsg').html("");

                      $('#apiResponseMsg').html("<div class='alert alert-danger alert-dismissible' style='width: 96%;margin-left: 2%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i>Alert...!</h4> API Not Running Properly...! </div>");

                      $.ajax({

                          url:"{{ url('/test-api/apiNotRun-mail-send') }}",

                          method : "POST",

                          type: "JSON",

                          data: {apiName:apiName},

                          success:function(response){

                            var data0 = JSON.parse(response);

                            console.log('msg',data0);

                            $('#apiResponseMsg').html("");

                            $('#apiResponseMsg').html("<div class='alert alert-success alert-dismissible' style='width: 96%;margin-left: 2%;'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button><h4><i class='icon fa fa-check'></i>Success...!</h4> Email Send To API Service Provider...! </div>");
                                 

                          }


                      });


                    }


                  }else{


                  }

              }

          },
          complete: function() {
            console.log('end spinner');
            $('.modalspinner').addClass('hideloaderOnModl');
          },

    });

 }

//handle the api
function testApi(apiCode, userName, password) {
console.log('hii');
   $('#apiCodeField').text(apiCode);
  $('#userNameField').text(userName);
  $('#passwordField').text(password);

    }


</script>




@endsection