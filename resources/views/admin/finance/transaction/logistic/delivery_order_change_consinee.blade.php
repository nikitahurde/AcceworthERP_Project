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
  ::placeholder {
    text-align:left;
  }

  @media screen and (max-width: 600px) {

    .PageTitle{

      float: left;

    }

  }

  .btn-success {
      color: #fff;
      background-color: #28a745;
      border-color: #28a745;
  }
  .text-center{
    text-align: center;
  }
  .Custom-Box {
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.12), 0 1px 2px 4px rgba(0,0,0,0.08);
  }

</style>



<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>
     Delivery Order Change Consinee
      <small> : Change Consinee Details</small>
    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="javascript:void(0)">Logistics</a></li>

      <li class="active"><a href="{{ url('/logistic/cancel-delivery-order-quantity') }}"> Change D.O. Consinee</a></li>

    </ol>

  </section> 

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Delivery Order Change Consinee </h2>

        <!-- <div class="box-tools pull-right">

          <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

        </div> -->

      </div><!-- /.box-header -->

      <div class="box-body">

        <?php date_default_timezone_set('Asia/Kolkata'); ?>

        <form action="{{url('/transaction/update-delivery-Change-Consinee')}}" method="post">

        <div class="row">

          <div class="col-md-3">

            <div class="form-group">

              <label for="exampleInputEmail1">ACC CODE : </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                  </div>
                 
                  <input list="acc_list" id="acc_code" name="acc_code" class="form-control  pull-left" value="" placeholder="Select ACC CODE" onchange="getDoDetailsByCust('ACCFIELD')" autocomplete="off">

                  <datalist id="acc_list">

                    <?php foreach ($acc_list as $value): ?>

                       <option value="{{$value->ACC_CODE }}" data-xyz ="{{ $value->ACC_NAME }}">{{ $value->ACC_CODE}} - {{ $value->ACC_NAME}}</option>
                      
                    <?php endforeach ?>

                  </datalist>

                </div>

            </div>

          </div>

          <div class="col-md-3">

            <div class="form-group">

              <label for="exampleInputEmail1">DO No : </label>

                <div class="input-group">

                    <div class="input-group-addon">

                      <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                    </div>

                    <input list="dorder_list" id="do_no" name="do_no" class="form-control  pull-left" value="" placeholder="Select DO No." onchange="getDoDetailsByCust('DONOFIELD')" autocomplete="off">

                    <datalist id="dorder_list">

                    </datalist>

                </div>

            </div>

          </div><!-- /.col -->

          <div class="col-md-3">

            <div class="form-group">

              <label for="exampleInputEmail1">Old Consignee Code :</label>

              <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                  </div>

                  <input list="oldCosnignList" id="cust_no" name="cust_no" class="form-control  pull-left" value="" placeholder="Select Customer Code" onchange="getDoDetailsByCust()" autocomplete="off">

                  <datalist id="oldCosnignList">
                   
                  </datalist>

              </div>

            </div>
          
          </div>

          <div class="col-md-3">

            <div class="form-group">

              <label for="exampleInputEmail1">New Consignee Code :</label>

              <div class="input-group">

                <div class="input-group-addon">

                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                </div>

                <input list="custListName" id="new_cust_no" name="cust_no" class="form-control  pull-left" value="" onchange="getDoDetailsByCust()" placeholder="Select Customer Code"  autocomplete="off">

                <datalist id="custListName">

                  <?php foreach ($Change_consinee as $value): ?>

                    <option value="<?php echo $value->ACC_CODE.'-'.$value->ACC_NAME; ?>"data-xyz ="{{ $value->ACC_NAME }}">{{ $value->ACC_CODE}} = {{$value->ACC_NAME}}</option>
                    
                  <?php endforeach ?>
                </datalist>

              </div>

            </div>
          
          </div>

          <div class="col-md-12 text-center" >

              <div style="margin-top: 8px;">

               <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" style="padding: 2px;" disabled="">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

                <button type="submit" class="btn btn-success" name="updatebtn" id="updatebtn" style="padding: 2px;" >&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Update&nbsp;&nbsp;</button>

                <button type="button" class="btn btn-warning" onClick="window.location.reload();" name="searchdata" id="ResetId" style="padding: 2px;">&nbsp;&nbsp;<i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>

              </div>

          </div><!-- /.col-3 -->

        </div><!-- /.row -->

        </form>

      </div><!-- /.box-body -->

    </div>
  
  </section>

</div>

@include('admin.include.footer')

<script type="text/javascript">
  
  function updateDoDestination(){

    var acc_code   =  $('#acc_code').val();
    var do_no      =  $('#do_no').val();
    var cust_no    =  $('#cust_no').val();
    var newcust_no =  $('#new_cust_no').val();

    var hidid =  $('#h_id').val();

    $.ajaxSetup({

        headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

        }

    });

    $.ajax({

        url:"{{ url('/transaction/update-delivery-Change-Consinee') }}",

        method : "POST",

        type: "JSON",

        data: {acc_code:acc_code, do_no:do_no, cust_no:cust_no, newcust_no:newcust_no, hidid:hidid},

        success:function(data){

          var data1 = JSON.parse(data); 

          if (data1.response == 'error') {

          }else if(data1.response == 'success'){

            console.log('response',data1.response);

             // $('#PurchaseIndentReportTable').DataTable().destroy();
             
             // $("#updatebtn").html('<button type="button" class="btn btn-success">Updated</button>');

               // setTimeout(function() {
               //       $("#updatebtn").hide();
               //  }, 2000);
          }

        }

    });

  }
</script>

<script type="text/javascript">

  function getDoDetailsByCust(fieldType){

    var account_code = $("#acc_code").val();
    var do_no        = $("#do_no").val();

    $.ajaxSetup({

      headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }
    });

    $.ajax({

      url:"{{ url('/get-do-No-by-change-Consinee') }}",

      method : "POST",

      type: "JSON",

      data: {account_code: account_code,do_no:do_no,fieldType:fieldType},

      success:function(data){

        var data1 = JSON.parse(data);

        if (data1.response == 'error') {

          $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

        }else if(data1.response == 'success'){
         
          $("#dorder_list").empty();
          $("#oldCosnignList").empty();
          if(fieldType == 'ACCFIELD'){

            $.each(data1.data, function(k, getData){

              $("#dorder_list").append($('<option>',{

                value:getData.DORDER_NO,

                'data-xyz':getData.DORDER_NO,
                text:getData.DORDER_NO+' - '+getData.DORDER_NO


              }));

            });

          }else if(fieldType == 'DONOFIELD'){

            $.each(data1.data, function(k, getData){

              $("#oldCosnignList").append($('<option>',{

                value:getData.CP_CODE,
                'data-xyz':getData.CP_NAME+'~'+getData.DORDERHID,
                text:getData.CP_CODE+' - '+getData.CP_NAME

              })); 

            });

          }
  
        }

      }

    });

  }
</script>
@endsection