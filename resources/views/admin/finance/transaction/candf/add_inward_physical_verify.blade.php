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
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Import Inward
      <small>Import Inward Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transation </a></li>
      <li class="active"><a href="{{ url('/form-inward-trans') }}">Import Inward </a></li>
      <li class="active"><a href="{{ url('/form-inward-trans') }}">Add Import Inward</a></li>

    </ol>

  </section>


<form id="inwardImportTran">
    @csrf

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle formTitle" style="font-weight: 800;color: #5696bb;">Add Import Inward</h2>

        <div class="box-tools pull-right">

          <a href="{{ url('transaction/c-and-f/view-inward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View Inward</a>

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

                <label>Rake No: <span class="required-field"></span></label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                  <input list="rakeNoList" class="form-control" name="rake_no" value="" placeholder="Enter Rake No" maxlength="15" id="rake_no" autocomplete="off" onchange="getFieldListData('RAKENO')">

                  <datalist id="rakeNoList">

                    <option value=""> -- Select -- </option>
                    
                     @foreach ($rakeNo_list as $key)

                    <option value='<?php echo $key->RAKE_NO?>'   data-xyz ="<?php echo $key->RAKE_NO; ?>"><?php echo $key->RAKE_NO;?></option>

                    @endforeach

                  </datalist>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label>Wagon No: <span class="required-field"></span></label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                  <input list="wagonList" class="form-control" name="wagon_no" value="" placeholder="Enter Wagon No" maxlength="15" id="wagon_no" autocomplete="off" onchange="getFieldListData('WAGONNO')">

                  <datalist id="wagonList">

                    <option value=""> -- Select -- </option>

                  </datalist>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label>Batch No: </label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                  <input list="batchList" class="form-control" name="batch_no" value="" placeholder="Enter Batch No" maxlength="15" id="batch_no" autocomplete="off" onchange="getFieldListData('BATCHNO')">

                  <datalist id="batchList">

                    <option value=""> -- Select -- </option>

                  </datalist>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label>CP Code: </label>

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                  <input list="cpList" class="form-control" autocomplete="off" name="cp_code" value="" placeholder="Enter CP Code" maxlength="15" id="cp_code">

                  <datalist id="cpList">

                    <option value=""> -- Select -- </option>

                  </datalist>

                </div>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2" style="margin-top: 10px;">

              <button class="btn btn-primary" type="button" id="searchdata"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Search</button>
              
            </div><!-- /.col -->

          </div><!-- /.row -->

      </div><!-- /.box-body -->

      <div class="box-body">

        <table id="inwarPhyVerify" class="table table-bordered table-striped table-hover">

          <thead class="theadC">

            <tr>

              <th class="text-center" width="5%">Rake No</th>
              <th class="text-center" width="5%">Wagon No </th>
              <th class="text-center" width="5%">Batch No</th>
              <th class="text-center" width="5%">Item</th>
              <th class="text-center" width="5%">Qty</th>
              <th class="text-center" width="5%">UM</th>
              <th class="text-center" width="5%">Aqty</th>
              <th class="text-center" width="5%">AUM</th>
              <th class="text-center" width="5%">Verify</th>

            </tr>

          </thead>

          <tbody id="defualtSearch">

          </tbody>
          
        </table>

        <div style="text-align: center;">
 

          <button type="button" name="submit" value="submit" id="submitData" class='btn btn-success' style="width: 16%;" onclick="submitVerifyInward(0)" disabled>&nbsp;Submit&nbsp;&nbsp;<i class="fa fa-sign-in" aria-hidden="true"></i></button> 

        </div>
        
      </div><!-- /.box-body -->

    </div><!-- /. custom box -->

  </section><!-- /.section -->

</form>

</div><!-- /.content-wrapper -->


@include('admin.include.footer')


<script type="text/javascript">


  /*----------- START : GET DATA ----------- */

  function getFieldListData(fieldType){

    var rakeNo = $('#rake_no').val();    
    var wagonNo = $('#wagon_no').val();    
    var batchNo = $('#batch_no').val();    

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({

        url:"{{ url('get-field-data-from-inword-for-physical-verification') }}",
        method : "POST",
        type: "JSON",
        data: {rakeNo: rakeNo,wagonNo:wagonNo,batchNo:batchNo,fieldType:fieldType},
      
        success:function(data){

          var data1 = JSON.parse(data);

          if (data1.response == 'error') {

            $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");
            $("#vehicle_no,#trip_no,#gateEntryVrno,#driver_name,#driver_id,#driver_mobNo,#plant_code,#plant_name,#pfct_code,#pfct_name").val('');
              $("#vehicleList").empty();

          }else if(data1.response == 'success'){

            if(fieldType == 'RAKENO'){

              if(data1.dataList == ''){
              
              }else{
                $("#wagonList").empty();
                $.each(data1.dataList, function(k, getItem){

                  $("#wagonList").append($('<option>',{

                    value:getItem.WAGON_NO,
                    'data-xyz':getItem.WAGON_NO,
                    text:getItem.WAGON_NO

                  }));

                });
                
              }

            }

            if(fieldType == 'WAGONNO'){

              if(data1.dataList == ''){
              
              }else{
                $("#batchList").empty();
                $.each(data1.dataList, function(k, getItem){

                  $("#batchList").append($('<option>',{

                    value:getItem.BATCH_NO,
                    'data-xyz':getItem.BATCH_NO,
                    text:getItem.BATCH_NO

                  }));

                });
                
              }
            }

            if(fieldType == 'BATCHNO'){
                console.log('data1.dataList',data1.dataList);
              if(data1.dataList == ''){
              
              }else{

                $("#cpList").empty();
                $.each(data1.dataList, function(k, getItem){

                  $("#cpList").append($('<option>',{

                    value:getItem.CP_CODE,
                    'data-xyz':getItem.CP_NAME,
                    text:getItem.CP_NAME

                  }));

                });
                
              }
            }

          }/* /. success condition*/

        },/*/. success function*/

    });

  }

  /*----------- END : GET DATA ----------- */

  /* ---------- START : GET DATA FOR DATATABLE ----------- */

    $('#searchdata').click(function(){
        
      var rakeNo  = $('#rake_no').val();
      var wagonNo = $('#wagon_no').val();
      var batchNo = $('#batch_no').val();
      var cpCode  = $('#cp_code').val();

      if(rakeNo){
        $('#rake_no').css('border-color','#d4d4d4');
        if(wagonNo){
          $('#wagon_no').css('border-color','#d4d4d4');
        }else{
          $('#wagon_no').css('border-color','#ff0000');
        }
      }else{
        $('#rake_no').css('border-color','#ff0000');
      }
      
      if(rakeNo && wagonNo){
        $('#inwarPhyVerify').DataTable().destroy();
        load_data(rakeNo,wagonNo,batchNo,cpCode);
      }
                      
    });

    function load_data(rakeNo='',wagonNo='',batchNo='',cpCode=''){
          
      $('#inwarPhyVerify').DataTable({

        processing: true,
        serverSide: true,
        scrollX: true,
         
        ajax:{
            url:'{{ url("get-data-from-inward-for-physical-verification") }}',
            data: {rakeNo:rakeNo,wagonNo:wagonNo,batchNo:batchNo,cpCode:cpCode},
            method:"POST",
        },
        columns: [
          
          {
            data:'RAKE_NO',
            name:'RAKE_NO'
          },
          {
            data:'WAGON_NO',
            name:'WAGON_NO'
          },
          {
            data:'BATCH_NO',
            name:'BATCH_NO'
          }, 
          {
            data:'ITEM_NAME',
            name:'ITEM_NAME'
          }, 
          {
            data:'QTY',
            name:'QTY'
          },
          {
            data:'UM',
            name:'UM'
          },
          {
            data:'AQTY',
            name:'AQTY'
          },
          {
            data:'AUM',
            name:'AUM'
          },
          {  
            render: function (data, type, full, meta){

              var verifyBTN = "<div><input type='checkbox' class='verifyInward' name='trans_type[]' value='"+full['CFINWARDID']+"' onclick='checkboxChecked();'></div>";

              return verifyBTN;
            }
          }
        ]

      });

    }

  /* ---------- END : GET DATA FOR DATATABLE ----------- */

/* --------------- START : SUBMIT DATA ------------ */

  function checkboxChecked(){

    var checkedCount = $("#inwarPhyVerify input:checked").length;
    if(checkedCount > 0){
      $('#submitData').prop('disabled',false);
    }else{
      $('#submitData').prop('disabled',true);
    }

  }

  function submitVerifyInward(){

    var checkVerify = [];
    $('.verifyInward').each(function(){

      if($(this).is(":checked"))
        {
          
         var itmchk = $(this).val();
         checkVerify.push(itmchk);
         
        }

    });

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({

          type: 'POST',

          url: "{{ url('/transaction-CandF-save-inward-physical-verify') }}",

          data: {checkVerify:checkVerify}, // here $(this) refers to the ajax object not form
          success: function (data) {
              
            var data1 = JSON.parse(data);
            if(data1.response == 'error') {

              var responseVar = false;
              var url = "{{url('candf/inward-physical-verification/save-msg')}}"
              setTimeout(function(){ window.location = url+'/'+responseVar; });

            }else{

              var responseVar = true;
              var url = "{{url('candf/inward-physical-verification/save-msg')}}";
              setTimeout(function(){ window.location = url+'/'+responseVar; });
              
            }/* /. condition*/

          },/* /. success function*/

      }); /* /. ajax*/

  }/* /. main function */

/* --------------- END : SUBMIT DATA ------------ */

</script>

@endsection