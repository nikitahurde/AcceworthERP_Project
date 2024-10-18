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
  .showSeletedName{
    font-size: 12px;
    margin-top: 2%;
    text-align: center;
    font-weight: 600;
    color: #4f90b5;
  }
 
  .inputboxclr{
    border: 1px solid #d7d3d3;
    width: 100%;
    margin-bottom: 2px;
  }

  .space{margin-bottom: 2px;}
  
  .numberRight{
    text-align:right;
  }
  .text-right{
    text-align:right !important;
  }
  .text-left{
    text-align:left !important;
  }
  .selfTrpt{
    display:none;
  }
  .marketTrpt{
    display:none;
  }
  .sisterConcernTrpt{
    display:none;
  }
  .exYardTrpt{
    display:none;
  }

.formInput[type=text] {
  border: none;
  background-color: none;
  outline: 0;
}

.formInput[type=text]:focus {
  border: none;
  background-color: none;
  outline: 0;
}


[data-tip] {
  position:relative;

}
[data-tip]:before {
  content:'';
  /* hides the tooltip when not hovered */
  display:none;
  content:'';
  border-left: 5px solid transparent;
  border-right: 5px solid transparent;
  border-bottom: 5px solid #1a1a1a; 
  position:absolute;
  top:20px;
  left:35px;
  z-index:8;
  font-size:0;
  line-height:0;
  width:0;
  height:0;
}
[data-tip]:after {
  display:none;
  content:attr(data-tip);
  position:absolute;
  top:25px;
  left:0px;
  padding:3px 3px;
  background:#1a1a1a;
  color:#fff;
  z-index:9;
  font-size: 0.75em;
  height:25px;
  line-height:18px;
  -webkit-border-radius: 3px;
  -moz-border-radius: 3px;
  border-radius: 3px;
  white-space:nowrap;
  word-wrap:normal;
}
[data-tip]:hover:before,
[data-tip]:hover:after {
  display:block;
}
</style>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->

  <section class="content-header">

    <h1>

      Create Delivery Order (D.O.)
      <small> : D.O. Details</small>

    </h1>

    <ol class="breadcrumb">

      <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{ url('/dashboard') }}">Transation </a></li>
      <li class="active"><a href="javascript:void(0)">C and F</a></li>
      <li class="active"><a href="{{ url('/transaction/c-and-f/view-create-delivery-order') }}">Create Delivery Order</a></li>

    </ol>

  </section>


  <section class="content">

    <div class="box box-primary Custom-Box">

      <div class="box-header with-border" style="text-align: center;">

        <h2 class="box-title animated bounceInLeft PageTitle formTitle" style="font-weight: 800;color: #5696bb;">Create Delivery Order</h2>

        <div class="box-tools pull-right">

          <a href="{{ url('/transaction/c-and-f/view-create-delivery-order') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp;View Create Delivery Order</a>

        </div>

      </div><!-- /.box-header -->

          @if(Session::has('alert-success'))

            <div class="alert alert-success alert-dismissible" style="width: 96%;margin-left: 2%;">

              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4><i class="icon fa fa-check"></i>Success...!</h4>

                 {!! session('alert-success') !!}

            </div>

          @endif

          @if(Session::has('alert-error'))

            <div class="alert alert-danger alert-dismissible" style="width: 96%;margin-left: 2%;">

              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <h4> <i class="icon fa fa-ban"></i> Error...!</h4>

                {!! session('alert-error') !!}

            </div>

          @endif

      <div class="box-body">

          <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-3">

              <div class="form-group">

                <label for="exampleInputEmail1">Rake No : <span class="required-field"></span></label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input list="rakeList" id="rackNoId" name="rakeNo" class="form-control  pull-left" value="{{ old('rakeNo')}}" onchange="getRakeNo()" placeholder="Select Rake Number">

                  <datalist id="rakeList">

                    @foreach ($rake_list as $key)

                    <option value='<?php echo $key->RAKE_NO; ?>'   data-xyz ="<?php echo $key->RAKE_NO; ?>" ><?php echo $key->RAKE_NO ;?></option>

                    @endforeach
                    
                  </datalist>

                </div>

                <small id="show_err_rake_no"></small>
                <small id="emailHelp" class="form-text text-muted">

                  <?php if(Session::has('alert-rake')){ ?>
                    <p class="help-block" style="color:red;">{!! session('alert-rake') !!}</p>
                  <?php } ?>

                </small>

              </div>

            </div><!-- /.col --> 

            <div class="col-md-3">

              <div class="form-group">

                <label for="exampleInputEmail1">Order No : </label>

                <div class="input-group">

                  <div class="input-group-addon">
                    <i class="fa fa-list-ol" aria-hidden="true"></i>
                  </div>

                  <input list="orderNoList" id="orderNoId" name="orderNo" class="form-control  pull-left" value="{{ old('orderNo')}}" placeholder="Select Order Number" readonly>

                  <datalist id="orderNoList">

                      <option value="" data-xyz ="">----Select Order No----</option>
                  
                    
                  </datalist>

                </div>

                <small id="show_err_rake_no"></small>

              </div>

            </div><!-- /.col --> 


            <div class="col-md-4" style="margin-top: 1%;">
              
              <button type="button" class="btn btn-primary" id="ProceedBtnId">&nbsp;&nbsp;<i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search&nbsp;&nbsp;</button>

              <button type="button" class="btn btn-info" name="searchdata" id="ResetId" onClick="window.location.reload();">&nbsp;&nbsp;<i class="fa fa-refresh" aria-hidden="true"></i> &nbsp;&nbsp;Reset&nbsp;&nbsp;</button>


            </div>

          </div><!-- /.row -->


      </div><!-- /.box-body -->

    </div><!-- /. custom box -->

  </section><!-- /.section -->

  <section class="content"  style="margin-top: -10%;">

    <div class="row">

      <div class="col-sm-12">

        <div class="box box-warning Custom-Box">

          <div class="box-body">

            <div class="modalspinner hideloaderOnModl"></div>

            <div class="">
               <form action="{{ url('/transaction/c-and-f/save-delivery-order-create') }}" method="POST">
                 @csrf
              <table id="createDoTbl" class="table tdthtablebordr">
<style>
  .textCenter{
    text-align: center !important;
  }
</style>
                <thead>
                  <tr>
                    <th class="textCenter">Sold To Party</th>
                    <th class="textCenter">Ship To Party</th>
                    <th class="textCenter">To Place</th>
                    <th class="textCenter">SO No.</th>
                    <th class="textCenter">Total Qty.</th>
                    <th class="textCenter">AQty.</th>
                    <th class="textCenter">Transpoter Type</th>
                    <th class="textCenter">Transpoter Code/Name</th>
                  </tr>
                </thead>

               
                 
                <tbody>
                  
                </tbody>
                

              </table><!-- /.table -->

            </div><!-- /.table-responsive -->


            <div class="row" style="margin-top: 10px;">

              <div class="col-md-12" style="text-align: center;">
                <button class="btn btn-success" type="submit" id="submitdata" onclick="submitInwardTrans(0)"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save</button>

                <button class="btn btn-warning" type="button" id="CancleBtn" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i>&nbsp;&nbsp; Cancle</button>
              </div>

            </div><!-- /.row -->

          </div><!-- /. box body -->

          </form> <!-- /. form -->

        </div><!-- /.Custom-Box -->

      </div><!-- /.col-sm-12 -->

    </div><!-- /.row -->
    
  </section><!-- /.section -->

</div><!-- /.content-wrapper -->

<style>
 
</style>

@include('admin.include.footer')

<script type="text/javascript">

/* START : Load Data Table */

load_data_query();

function load_data_query(rakeNo= '',orderNo=''){

      if (rakeNo!='') {
        
        var getDefalutData = '';

      }else{

        var getDefalutData = 'blank';
      }


      $('#createDoTbl').DataTable({

          processing: true,
          serverSide: true,
         
          pageLength:'100',
          dom: "<'top'Bfi><'row'<'col-sm-12'rt>>" +"<'row'<'col-sm-4'l><'col-sm-8'p>>",
          buttons:  [
                     
                    ],
          info: true,
          ajax:{
            url:'{{ url("/transaction/c-and-f/create-do/get-rake-data-from-rakeno") }}',
            data: {rakeNo:rakeNo,getDefalutData:getDefalutData,orderNo:orderNo}
          },
          columns: [
            {
                render: function (data, type, full, meta){

                var cpCode    = full['CP_CODE'];

                var cpName    = full['CP_NAME'];

                var rakeNum   = full['RAKE_NO'];

                var rakeDate  = full['RAKE_DATE'];

                var plantCode = full['PLANT_CODE'];

                var plantName = full['PLANT_NAME'];

                var compCd    = full['COMP_CODE'];
            
                var cpCodeName = cpCode+' - '+cpName;

                var srNo = full['DT_RowIndex'];
                
                return '<span data-tip="'+cpCodeName+'">'+cpCodeName+'<input type="hidden" class="center formInput" id="getCpCdNm'+srNo+'" value="'+cpCodeName+'"/><input type="hidden" class="center formInput" value="'+cpCode+'" name="cpCode[]"/><input type="hidden" class="center formInput" value="'+cpName+'" name="cpName[]"/><input type="hidden" class="center formInput" value="'+rakeNum+'" name="rakeNo[]"/><input type="hidden" class="center formInput" value="'+rakeDate+'" name="rakeDt[]"/><input type="hidden" class="center formInput" value="'+plantCode+'" name="plantCd[]"/><input type="hidden" class="center formInput" value="'+plantName+'" name="plantNm[]"/><input type="hidden" class="center formInput" value="'+compCd+'" name="compCode[]"/><input type="hidden" class="center formInput" value="'+rakeNum+'" name="singleRakeNo"/></span>';


               },
               className: "text-left"
               
            },
            {
              
                render: function (data, type, full, meta){

                if(full['SP_CODE']==null){

                  var spCode = '000';

                }else{
                  var spCode = full['SP_CODE'];
                }

                if(full['SP_NAME']==null){

                  var spName = '000';

                }else{

                  var spName = full['SP_NAME'];
                  

                }
                           
                var spCodeName = spCode+' - '+spName;

                return '<span data-tip="'+spCodeName+'">'+spCodeName+'<input type="hidden" class="center formInput" value="'+spCode+'" name="spCode[]"/><input type="hidden" class="center formInput" value="'+spName+'" name="spName[]"/></span>';


              },
               className: "text-left"
               
            },
            {
              render: function (data, type, full, meta){
       
                var toPlace = full['TO_PLACE'];

                return toPlace+'<input type="hidden" class="center formInput" value="'+toPlace+'" name="toPlace[]"/>';


              },
               className: "text-left"
               
            },
            {
                render: function (data, type, full, meta){
       
                  var orderNo = full['ORDER_NO'];

                  return orderNo+'<input type="hidden" class="center formInput" value="'+orderNo+'" name="orderNo[]"/>';


                },
                 className: "text-right"
               
            },
            {
              
                render: function (data, type, full, meta){

               
                var Qty = full['TOTQTY'];

                var Um = full['UM'];

                var qtyWithUm = Qty+'&nbsp;&nbsp;&nbsp;'+'<span class="label label-success"> '+Um+'</span>';

                return '<span>'+qtyWithUm+'<input type="hidden" class="center formInput" value="'+Qty+'" name="getQty[]"/><input type="hidden" class="center formInput" value="'+Um+'" name="getUm[]"/></span>';


              },
               className: "text-right"
               
            },
            {
              
                render: function (data, type, full, meta){

               
                var AQty = full['AQTY'];
                var AUM = full['AUM'];
               
                return AQty+'&nbsp;&nbsp;&nbsp;'+'<span class="label label-success"> '+AUM+'</span>';


              },
               className: "text-right"
               
            },
            {  
              render: function (data, type, full, meta){

                var srNo = full['DT_RowIndex'];
               
                var trpt  = "<input list='trptList"+srNo+"'  id='trptId"+srNo+"' class='instTypeMode getinstrument' tabindex='"+srNo+"' name='trptName[]' placeholder='Select Transporter Type' onchange='getTrpt("+srNo+")'><datalist id='trptList"+srNo+"'><option selected='selected' value=''>-- Select --</option><option value='SELF' data-xyz ='SELF'>SELF</option><option value='MARKET' data-xyz ='MARKET'>OTHER TRANSPORTER</option><option value='SISTER-CONCERN' data-xyz ='SISTER-CONCERN'>SISTER-CONCERN</option><option value='EX-YARD' data-xyz ='EX-YARD'>EX-YARD ( CUSTOMER SCOPE )</option></datalist>";

                return trpt;

               },
               className: "text-center"
        
            },
            {  
              render: function (data, type, full, meta){
                  
                var srNo = full['DT_RowIndex'];

                var self  = "<span class='selfTrpt' id='selfSpanId"+srNo+"'> <input type='text' id='selfType' name='selfType[]' value='<?php $compName = Session::get('company_name'); echo $compName;?>' readonly> </span><input list='marketList"+srNo+"'  id='marketId"+srNo+"' class='instTypeMode getinstrument marketTrpt' tabindex='"+srNo+"' name='trptTypeCode[]' placeholder='Select Transporter'><datalist id='marketList"+srNo+"'><option selected='selected' value=''>-- Select --</option>/datalist>";

                return self;

               },
               className: "text-center"
        
            },
            
            
          ]


      });


  }


/* END : Load Data Table */


/* ---------- Start : On Change Function Rake No -----------*/


function getRakeNo(){

  var rakeNo =  $('#rackNoId').val();

  $.ajax({

         url:"{{ url('/transaction/c-and-f/create-do/get-rakeFrom-order-no') }}",

         type: "POST",

         data: {rakeNo:rakeNo},

         beforeSend: function() {
                $('.modalspinner').removeClass('hideloaderOnModl');
         },

         success:function(data){
       
          var data1 = JSON.parse(data);

          console.log('order data',data1);
         
            $("#orderNoList").empty();
            $("#orderNoId").prop('readonly',false);

            $.each(data1.get_data, function(k, getData){

                $("#orderNoList").append($('<option>',{

                  value:getData.ORDER_NO,
                  'data-xyz':getData.ORDER_NO,
                  text:getData.ORDER_NO

                }));
              
            });

        
         },

          complete: function() {
            $('.modalspinner').addClass('hideloaderOnModl');
          },
    });

}


/* ---------- End  : On Change Function Rake No -----------*/

$(document).ready(function(){

  /* ..........START : Search Button Click ......... */

    $('#ProceedBtnId').click(function(){

      var rakeNo   =  $('#rackNoId').val();
      var orderNo  =  $('#orderNoId').val();

      console.log('rakeNo',rakeNo);

      if (rakeNo!='') {
          
        $.ajax({

           url:"{{ url('/transaction/c-and-f/create-do/check-unique-rake') }}",

           type: "POST",

           data: {rakeNo:rakeNo},

           beforeSend: function() {
                  $('.modalspinner').removeClass('hideloaderOnModl');
           },

           success:function(data){
         
            var data1 = JSON.parse(data);

            if(data1.response == 'success'){

              $("#rackNoId").prop('readonly',false);
              $("#orderNoId").prop('readonly',false);

              $('#show_err_rake_no').html('*Rake Number Already Exist...!').css('color','red');

              $('#createDoTbl').DataTable().destroy();

              load_data_query();


            }else{

              $("#rackNoId").prop('readonly',true);
              $("#orderNoId").prop('readonly',true);
             
              $('#show_err_rake_no').html('');
            
              $('#createDoTbl').DataTable().destroy();

              load_data_query(rakeNo,orderNo);

            }
           
            

          
           },

            complete: function() {
              $('.modalspinner').addClass('hideloaderOnModl');
            },
        });
      

    }else{

        $("#rackNoId").prop('readonly',false);
        $("#orderNoId").prop('readonly',false);

        $('#show_err_rake_no').html('*Please Select Rake Number').css('color','red');

        $('#createDoTbl').DataTable().destroy();

        load_data_query();

    }
        


    });

/* ..........END : Search Button Click ......... */

});

function getTrpt(rowId){

  var getRowId = rowId;

  var trptVal = $('#trptId'+getRowId).val();
  var getCpCdNm = $('#getCpCdNm'+getRowId).val();

  if (trptVal == 'SELF'){

    $('#marketId'+getRowId).addClass('marketTrpt');
    $('#selfSpanId'+getRowId).removeClass('selfTrpt');
    
  }else{

    $('#selfSpanId'+getRowId).addClass('selfTrpt');


    $.ajax({

         url:"{{ url('/transaction/c-and-f/create-do/get-trpt-data') }}",

         type: "POST",

         data: {trptVal:trptVal,getCpCdNm:getCpCdNm},

         beforeSend: function() {
                $('.modalspinner').removeClass('hideloaderOnModl');
         },

         success:function(data){
       
          var data1 = JSON.parse(data);
          var lens = data1.count_data;


        
            $('#marketId'+getRowId).removeClass('marketTrpt');

            $("#marketList"+getRowId).empty();
            $.each(data1.market_list, function(k, getData){

               console.log('len',lens);

               if (lens == 1) {

                $("#marketId"+getRowId).val(getData.ACC_CODE+'-'+getData.ACC_NAME).prop('readonly',true).attr('title',getData.ACC_CODE+'-'+getData.ACC_NAME);

              }else{

                $("#marketList"+getRowId).append($('<option>',{

                  value:getData.ACC_CODE+' - '+getData.ACC_NAME,
                  'data-xyz':getData.ACC_CODE,
                  text:getData.ACC_CODE+' [ '+getData.ACC_NAME+' ] '

                }));

              }

            });

        
         },

          complete: function() {
            $('.modalspinner').addClass('hideloaderOnModl');
          },
    });


  }

  console.log('getRowId',getRowId);
  console.log('getValue',trptVal);




}
 
</script>


<script type="text/javascript">
$(document).ready(function(){
    $('.Number').keypress(function (event) {
      var keycode = event.which;
      if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
          event.preventDefault();
      }
  });
});
</script>

<script type="text/javascript">

/* Data Table For Create DO.  */



</script>

@endsection