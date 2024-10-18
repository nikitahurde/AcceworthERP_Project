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

  @media only screen and (max-width: 600px) {
    
    .dataTables_filter{
      margin-left: 35%;
    }

    .divScroll{
      overflow-x: scroll;
    }
    
  }
  
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Item Age Analysis Parameter
      <small> Item Age Analysis Parameter</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

      <li><a href="{{ url('/dashboard') }}">Report</a></li>

      <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">List Item Ledger Report</a></li>

    </ol>

  </section>

  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <!-- <h2 class="box-title animated bounceInLeft PageTitle" id="getPAgeTitleNAme" style="font-weight: 800;color: #5696bb;"> Item Ledger Report</h2> -->

        <!-- <div class="box-tools pull-right">

          <a href="{{ url('view-sap-bill') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View  SAP Bill</a>

        </div> -->

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

        <form id="myForm" action="{{ url('/report/stock-inventory/process-item-save')}}" method="post">

        @csrf

        <?php date_default_timezone_set('Asia/Kolkata'); ?>

          <div class="row">

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Plant Code : </label>

                <div class="input-group">

                  <div class="input-group-addon">

                    <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                  </div>

                   <input list="plantList" id="plant_code" name="plantCode" class="form-control  pull-left" value="{{ old('plantCode')}}" placeholder="Select Plant Code" autocomplete="off">

                   <datalist id="plantList">

                    <option selected="selected" value="">-- Select --</option>
                    
                    @foreach ($plantList as $key)

                    <option value='<?php echo $key->PLANT_CODE?>' data-xyz ="<?php echo $key->PLANT_NAME; ?>" ><?php echo $key->PLANT_NAME ; echo " [".$key->PLANT_CODE."]" ; ?></option>

                    @endforeach
                   
                  </datalist>
                </div>

                <small>  

                 {!! $errors->first('plantCode','<p class="help-block" style="color: red">:message</p>' ) !!}

               </small>

               <small id="show_err_item">
                
               </small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">Plant Name : </label>

                <div class="input-group">

                  <div class="input-group-addon">

                  <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>

                  </div>

                  <input  list="" id="plant_name" name="plantName" class="form-control  pull-left" value="{{old('plantName')}}" placeholder="Select Plant Name" autocomplete="off" readonly>

                  <datalist id="plantList">

                    <option selected="selected" value="">-- Select --</option>
                    
                    <option value='' data-xyz ="" ></option>
                   
                  </datalist>

                </div>

                <small>  

                   {!! $errors->first('plantName','<p class="help-block" style="color: red">:message</p>' ) !!}

                </small>

              </div>

            </div><!-- /.col -->

            <div class="col-md-2">

              <div class="form-group">

                <label for="exampleInputEmail1">As On Date : <span class="required-field"></span> </label>

                <div class="input-group">

                    <div class="input-group-addon">

                     <i class="fa fa-calendar" aria-hidden="true"></i>
                    </div>

                    <input type="text" id="asOnDateId" name="asonDate" class="form-control datepicker pull-left" value="{{old('asonDate')}}" placeholder="Select As On Date" autocomplete="off">

                </div>

                <small>  

                 {!! $errors->first('asonDate','<p class="help-block" style="color: red">:message</p>' ) !!}

                </small>
                <small id="show_err_dept_code">

                </small>
                     
              </div>

            </div>

          </div><!-- /.box-body -->

          <div class="box-body divScroll" style="margin-top: -2%;">

            <table id="viewDynamicQuery" class="table table-bordered table-striped table-hover">
              <input type="hidden" name="tablDataId" id="tablDataId">
              <thead>

                <tr>

                  <th class="text-center">Range 1 : <span class="required-field"></span> </th>
                  <th class="text-center">Range 2 : <span class="required-field"></span> </th>
                  <th class="text-center">Range 3 : <span class="required-field"></span></th>
                  <th class="text-center">Range 4 : <span class="required-field"></span></th>
                  <th class="text-center">Range 5 : <span class="required-field"></span></th>
                  
                </tr>

              </thead>

              <tbody>

                <tr>

                  <td class="text-center"  style="padding: 1%;">
                    <input type="text" maxlength="7" size="7" id="rangeOne" name="Rng1" autocomplete="off" value="{{old('Rng1')}}" class="number">

                     <small>  

                     {!! $errors->first('Rng1','<p class="help-block" style="color: red">:message</p>' ) !!}

                   </small>

                  </td>

                  <td class="text-center">
                    <input type="text" maxlength="7" size="7" id="rangeTwo" name="Rng2" autocomplete="off" value="{{old('Rng2')}}" class="number">
                    <small>  

                     {!! $errors->first('Rng2','<p class="help-block" style="color: red">:message</p>' ) !!}

                   </small>
                  </td>

                  <td class="text-center">
                    <input type="text" maxlength="7" size="7" id="rangeThree" name="Rng3" autocomplete="off" class="number">
                     <small>  

                     {!! $errors->first('Rng3','<p class="help-block" style="color: red">:message</p>' ) !!}

                   </small>
                  </td>

                  <td class="text-center">
                    <input type="text" class="number" maxlength="7" size="7" id="rangeFour" name="Rng4" oninput="getrangeValue(this.value)" autocomplete="off" value="{{old('Rng4')}}" >
                     <small>  

                     {!! $errors->first('Rng4','<p class="help-block" style="color: red">:message</p>' ) !!}

                   </small>
                  </td>

                  <td class="text-center" maxlength="4" size="4" >

                    <small style="font-weight: 700;"> > </small>
                    <input type="text"maxlength="7" size="7" id="rangeFive" name="Rng5"autocomplete="off" value="{{old('Rng5')}}" readonly style="background-color: #eeeeee;border: 1px solid gray;">
                     <small>  

                     {!! $errors->first('Rng5','<p class="help-block" style="color: red">:message</p>' ) !!}

                   </small>
                  </td>

                </tr>

              </tbody>

            </table>

            <div class="row" style="padding: 1%;">

              <div class="col-md-4" ></div>

              <div class="col-md-4" style="text-align: center;">

                <div class="">

                  <button type="submit" class="btn btn-primary">Proceed</button>

                  <button type="reset" class="btn btn-danger">Cancel</button>

                 </div>

              </div>
              
              <div class="col-md-4" ></div>

            </div><!-- /.button -->

          </div><!-- /.box-body -->

        </form>

      </div>
    </div><!-- Custom-Box -->

  </section>

</div>


@include('admin.include.footer')

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

    function getrangeValue(rangeFour){
      $('#rangeFive').val(rangeFour);

    }
    $(document).ready(function(){

      $("input.number").keypress(function(event) {
        return /\d/.test(String.fromCharCode(event.keyCode));
      });

      $("#plant_code").bind('change', function () {  

        var val = $(this).val();

        var xyz = $('#plantList option').filter(function() {

          return this.value == val;

        }).data('xyz');

        var msg = xyz ?  xyz : 'No Match';

        if(msg=='No Match'){
          $(this).val('');
          $("#plant_name").val('');
        }else{
          $("#plant_name").val(msg);
        }


      });

    });
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
      endDate : 'today',
      autoclose: 'true'
    });

    $('#asOnDateId').on('change',function(){

      var plantCd = $('#plant_code').val();

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({

          url:"{{ url('get-data-from-item-age-para') }}",
          method : "POST",
          type: "JSON",
          data: {plantCd:plantCd},
          success:function(data){

            var data1 = JSON.parse(data);

            if (data1.response == 'error') {

              $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");

            }else if(data1.response == 'success'){

              if(data1.data_itemAgePara == ''){

              }else{
                $('#rangeOne').val(data1.data_itemAgePara[0].RANGE01);
                $('#rangeTwo').val(data1.data_itemAgePara[0].RANGE02);
                $('#rangeThree').val(data1.data_itemAgePara[0].RANGE03);
                $('#rangeFour').val(data1.data_itemAgePara[0].RANGE04);
                $('#rangeFive').val(data1.data_itemAgePara[0].RANGE05);
                $('#tablDataId').val(data1.data_itemAgePara[0].ITEMAGEPARAID);
              }

            }

          }/* /. success function*/

      }); /* /. ajax*/

    }); /* /. function*/
  

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

@endsection