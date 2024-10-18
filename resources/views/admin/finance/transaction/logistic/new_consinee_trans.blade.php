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
      border-radius: 10px;
    */    
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }
  .content {
    min-height: 80px !important;
    padding: 0px !important;
    margin-right: auto !important;
    margin-left: auto !important;
    padding-left: 15px !important;
    padding-right: 15px !important;
  }
  .vehiclenumup{
    text-transform: uppercase;
  }
  #marketTable{
    display:none;
  }
  .center {
    text-align:center;
  }
  .right {
    float:right;
  }
  .shiToPartyHide{
    display:none;
  }
  .soldtoPartyHide{
    display:none;
  }
  .btnstyle{
    display:none;
  }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Change Consinee
      <small>Add Details</small>
      </h1>
      <ol class="breadcrumb">
      <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('dashboard') }}">Trip Expense</a></li>
      <li><a href="{{ url('logistic/fleet-transaction') }}"> Consinee LR</a></li>
      <li><a href="{{ url('logistic/fleet-transaction') }}"> Consinee LR</a></li>
      </ol>
    </section>
    
    <section class="content">

      <div class="row">

        <div class="col-sm-12" style="padding-top: 2%;">

          <div class="box box-info Custom-Box">

            <div class="box-header with-border" style="text-align: center;">
              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Add  Consinee LR </h2>

               <div class="box-tools pull-right">
              <a href="{{ url('/logistic/view-fleet-transaction') }}" class="btn btn-primary btn-sm" style="margin-right: 10px;"><i class="fa fa-eye"></i>&nbsp;&nbsp;View  Consinee LR </a>
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

            <form action="{{url('/suplimentry-change_Consinee-trans-update')}}" method="post">

            @csrf

            <div class="box-body">
                
              <div class="row">
                
                <center>
                  <div class="col-md-12">

                    <div class="form-group">

                      <div class="input-group">

                          <input type="radio" class="optionsRadios1" name="tranType" value="SOLD_TO_PARTY" onclick="typeFun()" checked="">&nbsp;Sold To Party &nbsp;
                          <input type="radio" class="optionsRadios1" name="tranType" value="SHIP_TO_PARTY" onclick="typeFun()">&nbsp;Ship To Party &nbsp;

                      </div>
                      <input type="hidden" name="funs_type" id="funs_type">
                    </div><!-- /.form-group -->
                    
                  </div><!-- /.col -->
                </center>

              </div><!-- /.row -->

              <div class="row soldtoPartyHide" id="rowOneSold">

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Rake No<span class="required-field"></span></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                      <input list="rakeNoList" class="form-control" name="rake_no" value="" id="rake_no" placeholder="Enter Rake Number"style="text-transform:uppercase">

                      <datalist id="rakeNoList">
                        @foreach($rakeNo_list as $rows)

                          <option value="{{ $rows->RAKE_NO }}" data-xyz="{{ $rows->RAKE_NO }}">{{ $rows->RAKE_NO}}</option>

                       @endforeach
                      
                      </datalist>

                    </div>
                    <input type="hidden" name="tripid" id="tripid">
                    <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('do_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>
                    <small id="invcErr" style="color: red;"></small>
                  </div>
                  <!-- /.form-group -->
                </div>
          
                <div class="col-md-2">

                  <div class="form-group">

                    <label> Do No<span class="required-field"></span></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                      <input list="doList" class="form-control" name="do_no" value="" id="do_no" placeholder="Enter Do Number"style="text-transform:uppercase">

                      <datalist id="doList">
                        @foreach($do_list as $rows)

                          <option value="{{ $rows->DORDER_NO }}" data-xyz="<?= $rows->DORDER_NO?>">{{ $rows->DORDER_NO}}-{{ $rows->FROM_PLACE}}-{{ $rows->TO_PLACE}}-{{ $rows->CP_CODE }}-{{ $rows->CP_NAME}}</option>

                       @endforeach
                      
                      
                      </datalist>

                    </div>
                    <input type="hidden" name="tripid" id="tripid">
                    <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('do_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>
                    <small id="invcErr" style="color: red;"></small>
                  </div>
                  <!-- /.form-group -->
                </div>

                <div class="col-md-2">

                  <div class="form-group">
                    <label>Old CP Code: <span class="required-field"></span></label>
                    <div class="input-group">
                      <span class="input-group-addon">
                      <i class="fa fa-truck" aria-hidden="true"></i>
                      </span>
                      <input list="truckList" name="old_consinee_no" id="old_consinee_no" class="form-control vehiclenumup" placeholder="Enter Consinee No" value="{{ old('old_consinee_no') }}" autocomplete="off">

                      <datalist id="truckList">
                        
                         <option value="" data-xyz=""></option>

                      </datalist>

                    </div>
                    <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('old_consinee_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>
                  
                  </div>

                </div>

                <div class="col-md-2">

                  <div class="form-group">
                    <label>Old CP Name: <span class="required-field"></span></label>
                    <div class="input-group">
                      <span class="input-group-addon">
                      <i class="fa fa-truck" aria-hidden="true"></i>
                      </span>
                      <input list="truckList" name="old_consinee_name" id="old_consinee_name" class="form-control vehiclenumup" placeholder="Enter Consinee No" value="{{ old('old_consinee_name') }}" autocomplete="off" readonly>

                      <datalist id="truckList">

                         <option value="" data-xyz=""></option>
                       
                      </datalist>

                    </div>
                    <small id="emailHelp" class="form-text text-muted">
                    {!! $errors->first('old_consinee_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>
                  
                  </div>
                </div>

                <div class="col-md-2">

                  <div class="form-group">

                    <label>New CP Code:<span class="required-field"></span></label>

                    <div class="input-group">

                      <span class="input-group-addon">
                        <i class="fa fa-truck" aria-hidden="true"></i>
                      </span>

                      <input list="CPList" name="new_Consinee_no" id="new_Consinee_code" class="form-control" placeholder="Enter New Vehicle No" value="{{ old('truck_no') }}">

                      <datalist id="CPList">

                        @foreach($cp_list as $rows)

                          <option value="{{ $rows->ACC_CODE }}" data-xyz="<?= $rows->ACC_NAME?>">{{ $rows->ACC_CODE}}-{{ $rows->ACC_NAME}}</option>

                        @endforeach
                      
                      </datalist>

                    </div>

                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('new_Consinee_no', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>
                    <small id="vehicleerr"></small>
                          
                  </div>

                </div>

                <div class="col-md-2">
                    <div class="form-group">
                      <label>New CP Name:<span class="required-field"></span></label>
                      <div class="input-group">
                        <span class="input-group-addon">
                          <i class="fa fa-truck" aria-hidden="true"></i>
                        </span>
                        <input type="text" name="new_Consinee_name" id="new_Consinee_name" class="form-control" placeholder="New Consinee Name" value="{{ old('truck_no') }}" readonly>
                      
                        </div>
                        <small id="emailHelp" class="form-text text-muted">
                          {!! $errors->first('new_Consinee_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                        </small>
                        <small id="vehicleerr"></small>
                            
                    </div>
                </div>

              </div><!-- /.row -->

              <div class="row soldtoPartyHide" id="rowTwoSold">
                
                <div class="col-md-3">
                  <div class="form-group">
                    <label>CP Address:<span class="required-field"></span></label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="fa fa-truck" aria-hidden="true"></i>
                      </span>
                      <input list="cpAddList" type="text" name="cpAddress" id="cpAddress" class="form-control" placeholder="New CP Address" value="" autocomplete="off">

                      <datalist id="cpAddList">

                      </datalist>
                    </div>
                    <small id="emailHelp" class="form-text text-muted">
                      {!! $errors->first('new_Consinee_name', '<p class="help-block" style="color:red;">:message</p>') !!}
                    </small>
                    <small id="vehicleerr"></small>

                  </div>
                </div>

              </div><!-- /.row -->

              <div class="row shiToPartyHide" id="rowOneShip">
          
                <div class="col-md-2">

                  <div class="form-group">

                    <label> Rake No<span class="required-field"></span></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                      <input list="rakeNoListSP" class="form-control" name="rakeNoSP" value="" id="rakeNoSP" placeholder="Enter Rake No" style="text-transform:uppercase">

                      <datalist id="rakeNoListSP">
                        
                        <?php foreach($rakeNo_list as $rows){ ?>

                          <option value="{{ $rows->RAKE_NO }}" data-xyz="{{ $rows->RAKE_NO }}">{{ $rows->RAKE_NO}}</option>

                        <?php }  ?>

                      </datalist>

                    </div>

                  </div> <!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Do No<span class="required-field"></span></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                      <input list="doListsp" class="form-control" name="do_no_sp" value="" id="do_nosp" placeholder="Enter Do Number"style="text-transform:uppercase">

                      <datalist id="doListsp">
                      
                      </datalist>

                    </div>

                  </div> <!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Batch No</label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                      <input list="batchNoListSP" class="form-control" name="batchNoSP" value="" id="batchNo" placeholder="Enter Batch No"style="text-transform:uppercase">

                      <datalist id="batchNoListSP">
                      
                      </datalist>

                    </div>

                  </div> <!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Old SP Code<span class="required-field"></span></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                      <input list="oldSpList" class="form-control" name="old_spcd_SP" value="" id="old_spcd" placeholder="Enter Old SP Code"style="text-transform:uppercase">

                      <datalist id="oldSpList">
                        
                      </datalist>

                    </div>

                  </div> <!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> Old SP Name<span class="required-field"></span></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                      <input type="text" class="form-control" name="oldSpNameSP" value="" id="oldSpName" placeholder="Enter Old SP Name" readonly style="text-transform:uppercase">

                    </div>

                  </div> <!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-2">

                  <div class="form-group">

                    <label> New SP Code<span class="required-field"></span></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                      <input list="newSpList" class="form-control" name="newSpCd_SP" value="" id="newSpCd" placeholder="Enter New SP Code" style="text-transform:uppercase">

                      <datalist id="newSpList">
                      
                        @foreach($cp_list as $rows)

                          <option value="{{ $rows->ACC_CODE }}" data-xyz="<?= $rows->ACC_NAME?>">{{ $rows->ACC_CODE}}-{{ $rows->ACC_NAME}}</option>

                        @endforeach

                      </datalist>

                    </div>

                  </div> <!-- /.form-group -->

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row shiToPartyHide" id="rowTwoShip">
                
                <div class="col-md-2">

                  <div class="form-group">

                    <label> New SP Name<span class="required-field"></span></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                      <input type="text" class="form-control" name="newspName_SP" value="" id="newspName" placeholder="Enter New SP Name" readonly style="text-transform:uppercase">
                    
                    </div>

                  </div> <!-- /.form-group -->

                </div><!-- /.col -->

                <div class="col-md-3">

                  <div class="form-group">

                    <label> New SP Address<span class="required-field"></span></label>

                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>
                      <input list="newSpAddrList" class="form-control" name="newspAddr_SP" value="" id="newspAddr" placeholder="Enter New SP Address"style="text-transform:uppercase">

                      <datalist id="newSpAddrList">
                      
                      </datalist>

                    </div>

                  </div> <!-- /.form-group -->

                </div><!-- /.col -->

              </div><!-- /.row -->

              <div class="row text-center">
                <div id="fieldReqMsg" style="color:red;margin:5px;">
                  
                </div>
              </div>
              <div class="row text-center btnstyle" id="cofirmBtn">
                
                <button class="btn btn-primary" type="button" onclick="validationFun();"><i class="fa fa-save"></i>&nbsp; Confirm</button>
                <button class="btn btn-warning" type="reset"><i class="fa fa-refresh"></i>&nbsp; Reset</button>

              </div>

              <div class="row text-center btnstyle" id="updateBtn">
                <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i>&nbsp; Update</button>
                <button class="btn btn-warning" type="reset"><i class="fa fa-refresh"></i>&nbsp; Reset</button>
              </div>
            
            </div><!-- /.box-body -->

            </form><!-- /.form -->
              
          </div><!-- /.custom box -->
  
        </div><!-- /.col-sm-12 -->

      </div><!-- /.row -->

    </section><!-- /.section -->
     
  </div>
   
@include('admin.include.footer')

<script type="text/javascript">

  $('#cofirmBtn').removeClass('btnstyle');
  $('#updateBtn').addClass('btnstyle');

  function typeFun(){

    var tranTypeSS = $('input[name="tranType"]:checked').val();

    if(tranTypeSS == 'SOLD_TO_PARTY'){
      $('#rowOneSold').removeClass('soldtoPartyHide');
      $('#rowTwoSold').removeClass('soldtoPartyHide');
      $('#rowOneShip').addClass('shiToPartyHide');
      $('#rowTwoShip').addClass('shiToPartyHide');
      $('#funs_type').val('SOLD_TO_PARTY');

      $('#rakeNoSP,#do_nosp,#batchNo,#old_spcd,#oldSpName,#newSpCd,#newspName,#newspAddr').val('');
      $('#truckList,#doList,#cpAddList').empty();

    }else if(tranTypeSS == 'SHIP_TO_PARTY'){
      $('#rowOneSold').addClass('soldtoPartyHide');
      $('#rowTwoSold').addClass('soldtoPartyHide');
      $('#rowOneShip').removeClass('shiToPartyHide');
      $('#rowTwoShip').removeClass('shiToPartyHide');
      $('#funs_type').val('SHIP_TO_PARTY');

      $('#rake_no,#do_no,#old_consinee_no,#old_consinee_name,#new_Consinee_code,#new_Consinee_name,#cpAddress').val('');
      $('#oldSpList,#batchNoListSP,#doListsp,#newSpAddrList').empty();

    }

  }

  function validationFun(){

    var tranTypeSS = $('input[name="tranType"]:checked').val();

    if(tranTypeSS == 'SHIP_TO_PARTY'){

      var rakeNo_sp    = $('#rakeNoSP').val();
      var doNo_sp      = $('#do_nosp').val();
      var batchNo_sp   = $('#batchNo').val();
      var oldsp_sp     = $('#old_spcd').val();
      var newsp_sp     = $('#newSpCd').val();
      var newspAddr_sp = $('#newspAddr').val();

      if(rakeNo_sp && doNo_sp && oldsp_sp && newsp_sp && newspAddr_sp){

          $('#cofirmBtn').addClass('btnstyle');
          $('#updateBtn').removeClass('btnstyle');
          $('#fieldReqMsg').html("");
      }else{
        $('#fieldReqMsg').html(" * All Field Is Required .... !");
      }

    }else if(tranTypeSS == 'SOLD_TO_PARTY'){

      var doNo_sl    = $('#do_no').val();
      var old_cons_sl    = $('#old_consinee_no').val();
      var newcpCode_sl    = $('#new_Consinee_code').val();
      var newCPAddr_sl    = $('#cpAddress').val();

      if(doNo_sl && old_cons_sl && newcpCode_sl && newCPAddr_sl){

          $('#cofirmBtn').addClass('btnstyle');
          $('#updateBtn').removeClass('btnstyle');
          $('#fieldReqMsg').html("");
      }else{
        $('#fieldReqMsg').html(" * All Field Is Required .... !");
      }

    }

  }

  $(document).ready(function(){

      typeFun();

      $("#new_Consinee_code").on('change', function () {  

        var newConsineeCode = $(this).val();
        console.log('newConsineeCode',newConsineeCode)

        var cpAddress = $("#cpAddress").val();
        console.log('cpAddress',cpAddress)

        var xyz = $('#CPList option').filter(function() {

          return this.value == newConsineeCode;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#new_Consinee_name").val('');
        }else{
          $("#new_Consinee_name").val(msg);
        }

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

           $.ajax({
        url: "{{ url('get-data-newConsineeAddress') }}",
        method: "POST",
        type: "JSON",
        data: { newConsineeCode: newConsineeCode},

        success: function(data) {

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>" + data.message + "</p>");

          } else if (data1.response == 'success'){

            if(data1.datacpAddress == ''){

            }else{

              $("#cpAddList").empty();
              console.log('data1.datacpAddress',data1.datacpAddress);
              $.each(data1.datacpAddress, function(k, getBatchNo){

                $("#cpAddList").append($('<option>',{

                   value:getBatchNo.ADD1,

                  'data-xyz':getBatchNo.ADD1,

                  text :getBatchNo.ADD1

                }));

              });

            }
          }

        }

      });


      });

      $("#old_consinee_no").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#truckList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#old_consinee_name").val('');
        }else{
          $("#old_consinee_name").val(msg);
        }


      });

    });

  

   $(document).ready(function() {

    $("#rake_no").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#rakeNoList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $("#rake_no").val('');
      }else{
      }

      getcpNDo('RAKENO');

    });

    $('#do_no').on('change', function() {

      var val = $('#do_no').val();

      var xyz = $('#doList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $("#do_no").val('');
      }else{
      }

      getcpNDo('DONOSL');

    });


   });

   function getcpNDo(fieldType){

      var rakeNo     = $('#rake_no').val();
      var selectDoNo = $('#do_no').val();

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

        url: "{{ url('get-data-DoNo') }}",
        method: "POST",
        type: "JSON",
        data: { rakeNo:rakeNo,selectDoNo: selectDoNo,fieldType:fieldType},

        success: function(data) {

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>" + data.message + "</p>");

          }else if (data1.response == 'success'){

            console.log('data1 ',data1.dataDoNoList);

            if(fieldType == 'RAKENO'){

              if(data1.dataDoNoList == ''){

              }else{

                $("#doList").empty();

                $.each(data1.dataDoNoList, function(k, getBatchNo){

                  $("#doList").append($('<option>',{

                     value:getBatchNo.DORDER_NO,
                    'data-xyz':getBatchNo.DORDER_NO,
                    text :getBatchNo.DORDER_NO+'-'+getBatchNo.FROM_PLACE+'-'+getBatchNo.TO_PLACE+'-'+getBatchNo.CP_CODE+'-'+getBatchNo.CP_NAME

                  }));

                });

              }

            }else if(fieldType == 'DONOSL'){

              if(data1.dataCpList == ''){

              }else{

                $("#truckList").empty();

                $.each(data1.dataCpList, function(k, getBatchNo){

                  $("#truckList").append($('<option>',{

                     value:getBatchNo.CP_CODE,
                    'data-xyz':getBatchNo.CP_NAME,
                    text :getBatchNo.CP_CODE+'-'+getBatchNo.CP_NAME

                  }));

                });

              }

            }

            /*if(data1.dataItemList == ''){

            }else{

              $("#truckList").empty();

              $.each(data1.dataItemList, function(k, getBatchNo){

                $("#truckList").append($('<option>',{

                   value:getBatchNo.CP_CODE,
                  'data-xyz':getBatchNo.CP_NAME,
                  text :getBatchNo.CP_CODE+'-'+getBatchNo.CP_NAME

                }));

              });

            }*/ /* /.CODN*/

          }/*/.SUCCESS RES*/

        }/*/.SUCCESS FUN*/

      });/*/.AJAX*/

    }/*/.MAIN FUN*/


  $(document).ready(function() {
  $('.datepicker').datepicker({
    format: 'dd-mm-yyyy',
    orientation: 'bottom',
    todayHighlight: 'true',
    endDate:'today',
    autoclose: 'true'
  });


});

  $(document).ready(function(){

    $("#rakeNoSP").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#rakeNoListSP option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';
     
      if(msg=='No Match'){
        $("#rakeNoSP").val('');
      }else{
      }

      $('#do_nosp,#batchNo,#old_spcd,#oldSpName').val('');
      $('#doListsp,#batchNoListSP,#oldSpList').empty();
      ShipToPartyFun('RAKENO');

    });

    $("#do_nosp").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#doListsp option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $(this).val('');
        $("#do_nosp").val('');
      }else{
      }

      $('#batchNo,#old_spcd,#oldSpName').val('');
      $('#batchNoListSP,#oldSpList').empty();

      ShipToPartyFun('DONO');

    });

    $("#batchNo").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#batchNoListSP option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $("#batchNo").val('');
      }else{
      }

      $('#old_spcd,#oldSpName').val('');
      $('#oldSpList').empty();

      ShipToPartyFun('BATCHNO');

    });

    $("#old_spcd").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#oldSpList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $("#old_spcd").val('');
        $("#oldSpName").val('');
      }else{
        $("#oldSpName").val(msg);
      }

    });

    $("#newSpCd").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#newSpList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $("#newSpCd").val('');
        $("#newspName").val('');
      }else{
        $("#newspName").val(msg);
      }
      $("#newspAddr").val('');
      $('#newSpAddrList').empty();

      ShipToPartyFun('SPADDR');

    });

    $("#newspAddr").bind('change', function () {  

      var val = $(this).val();

      var xyz = $('#newSpAddrList option').filter(function() {

        return this.value == val;

      }).data('xyz');

      var msg = xyz ?  xyz : 'No Match';

      if(msg=='No Match'){
        $("#newspAddr").val('');
      }else{
      }
      
    });

  });

  function ShipToPartyFun(fieldType){

    var doNum   = $('#do_nosp').val();
    var rakeNum = $('#rakeNoSP').val();
    var batchNo = $('#batchNo').val();
    var newSpCd = $('#newSpCd').val();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

      url: "{{ url('get-data-for-ship-to-party-field') }}",
      method: "POST",
      type: "JSON",
      data: { doNum: doNum,rakeNum:rakeNum,batchNo:batchNo,newSpCd:newSpCd,fieldType:fieldType},

      success: function(data) {

        var data1 = JSON.parse(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>" + data.message + "</p>");

        }else if (data1.response == 'success'){

          if(fieldType == 'RAKENO'){

            if(data1.data_orderNoList == ''){

            }else{
                $("#doListsp").empty();

                $.each(data1.data_orderNoList, function(k, getItem){

                  $("#doListsp").append($('<option>',{

                    value:getItem.DORDER_NO,
                    'data-xyz':getItem.DORDER_NO,
                    text:getItem.DORDER_NO+'-'+getItem.FROM_PLACE+'-'+getItem.TO_PLACE+'-'+getItem.CP_CODE+'-'+getItem.CP_NAME

                  }));

                });
            } /* /.codn*/

          }else if(fieldType == 'DONO'){

            if(data1.data_batchNoList == ''){

            }else{
              $("#batchNoListSP").empty();

                $.each(data1.data_batchNoList, function(k, getItem){

                  $("#batchNoListSP").append($('<option>',{

                    value:getItem.BATCH_NO,
                    'data-xyz':getItem.BATCH_NO,
                    text:getItem.BATCH_NO+'-'+getItem.DO_WAGON_NO

                  }));

                });

                $("#oldSpList").empty();

                $.each(data1.data_batchNoList, function(k, getItem){

                  $("#oldSpList").append($('<option>',{

                    value:getItem.SP_CODE,
                    'data-xyz':getItem.SP_NAME,
                    text:getItem.SP_CODE+'-'+getItem.SP_NAME

                  }));

                });
            }
          }else if(fieldType == 'BATCHNO'){
            
            if(data1.data_oldSpList == ''){

            }else{
              $("#oldSpList").empty();

                $.each(data1.data_oldSpList, function(k, getItem){

                  $("#oldSpList").append($('<option>',{

                    value:getItem.SP_CODE,
                    'data-xyz':getItem.SP_NAME,
                    text:getItem.SP_CODE+'-'+getItem.SP_NAME

                  }));

                });
            }

          }/*/.codn*/

          if(fieldType == 'SPADDR'){
            if(data1.data_spAddrList == ''){

            }else{
              $("#newSpAddrList").empty();

                $.each(data1.data_spAddrList, function(k, getItem){

                  $("#newSpAddrList").append($('<option>',{

                    value:getItem.ADD1,
                    'data-xyz':getItem.ADD1,
                    text:getItem.ADD1

                  }));

                });
            }

          }
          
        }/*/.success codn*/

      } /* /.success fun*/

    }); /* /. ajax*/

  }/*/.fun*/
 
</script>





@endsection