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

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

 }



</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Trpt Payment Advice

            <small>  Trpt Payment Advice Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Logistic</a></li>

            <li><a href="{{ url('/dashboard') }}">Fleet</a></li>

            <li class="active"><a href="{{ url('/rept-inward-sto-reg') }}">Trpt Payment Advice</a></li>

          </ol>

        </section>

  <section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;"> Trpt Payment Advice</h2>

            </div><!-- /.box-header -->

            <div class="box-body">

             <form id="myForm">



               @csrf



              <div class="row">

                <div class="col-md-4">

                   <div class="form-group">

                      <label for="exampleInputEmail1"> TR Date : <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>
                        <input type="hidden" name="" id="from_date_default" value="{{ $from_date }}">
                        <input type="hidden" name="" id="to_date_default" value="{{ $to_date }}">
                        
                        <input type="text" name="from_date" id="from_date" class="form-control datepicker" placeholder="Select Transaction Date" value="{{ old('from_date')}}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('from_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      <small id="show_err_from_date">

                        

                      </small>

                  </div>

                 </div>


                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Depot : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>

                          <input list="depotList"  id="dept_code" name="dept_code" class="form-control  pull-left" value="{{ old('dept_code')}}" placeholder="Select Depot Name" >



                          <datalist id="depotList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($user_list as $key)

                            

                            <option value='<?php echo $key->depot_name?>'   data-xyz ="<?php echo $key->depot_name; ?>" ><?php echo $key->depot_name ; echo " [".$key->depot_code."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="depotText"></div>

                     </small>

                     <small id="show_err_dept_code">

                        

                      </small>

                     

                  </div>

                </div><!-- /.col -->

              </div><!-- /.row -->



              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Area : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-arrows" aria-hidden="true"></i>

                          </div>



                           <input list="accountList" id="acct_code" name="acct_code" class="form-control  pull-left" value="{{ old('acct_code')}}" placeholder="Select Area Code" >



                           <datalist id="accountList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($area_list as $key)

                            

                            <option value='<?php echo $key->name?>'   data-xyz ="<?php echo $key->name; ?>" ><?php echo $key->name ; echo " [".$key->code."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="accountText"></div>

                     </small>

                     <small id="show_err_acct_code">

                        

                     </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transporter : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-truck" aria-hidden="true"></i>

                          </div>



                          <input list="transList" id="trans_code" name="trans_code" class="form-control  pull-left" value="{{ old('trans_code')}}" placeholder="Select Transporter">



                          <datalist id="transList">

                            @foreach ($transpoter_list as $key)

                            

                            <option value='<?php echo $key->name?>'   data-xyz ="<?php echo $key->name; ?>" ><?php echo $key->name ; echo " [".$key->code."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="transText"></div>

                     </small>

                     <small id="show_err_trans">

                        

                      </small>
                     <span id='searcherr' style="color: red;"></span>
                  </div>

                </div><!-- /.col -->

                <div class="col-md-4" style="margin-top: 3.5%;">

                    <div class="">

               <button type="button" class="btn btn-primary" name="searchdata" id="btnsearch" value="btnsearch"><i class="fa fa-search" aria-hidden="true"></i> &nbsp;&nbsp;Search</button>

                <button type="button" class="btn btn-default" name="searchdata" id="ResetId"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp;&nbsp;Reset</button>

               </div>

                </div>

              </div>

              



               

             </form>

            </div><!-- /.box-body -->



            <div class="box-body">

<table id="TrptPaymentAdvice" class="table table-bordered table-striped table-hover">

  <thead class="theadC">
    
    <tr>

      <th class="text-center">Transporter</th>

      <th class="text-center">Truck No</th>

      <th class="text-center">L R No</th>

      <th class="text-center">Date</th>     

      <th class="text-center">Depot/Plant</th>    

      <th class="text-center">Area</th>

      <th class="text-center">Quantity</th>

      <th class="text-center">Item</th>

      <th class="text-center">L R Received Date</th>         

      <th class="text-center">Rate</th>    

      <th class="text-center">Basic</th>

      <th class="text-center">Service Charges</th>

      <th class="text-center">TDS</th>

      <th class="text-center">Advance</th>

      <th class="text-center">Net Payment</th>           

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



       $("#acct_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

        });



       $("#area_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#areaList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("areaText").innerHTML = msg; 

        });



       $("#trans_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#transList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("transText").innerHTML = msg; 

        });



       $("#dept_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 

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



      $('#acct_code').change(function(){

         

          var acountCode = $('#acct_code').val();

          $('#showaccCode').val(acountCode);

      });



      $('#area_code').change(function(){

         

          var areaCode = $('#area_code').val();

          $('#showAreaCode').val(areaCode);

      });



      $('#trans_code').change(function(){

         

          var transCode = $('#trans_code').val();

          $('#showTransCode').val(transCode);

      }); 



      $('#dept_code').change(function(){

         

          var depotCode = $('#dept_code').val();

          $('#showDepotCode').val(depotCode);

      });



      

    });



   $(document).ready(function() {



    $("#inv_um").change(function(){



            var invqty = $("#inv_um").val();



            var cFactor = $("#cfactor").val();

            var result = invqty*cFactor;

              

            if(invqty<0){

               alert('Pleas Select More Than 0 Quantity');

               $("#inv_um").val('0');

               $("#inv_aum").val('');



            }else{



               $("#inv_aum").val(result);

            }

        });

   });


</script>

<script type="text/javascript">

  $(document).ready(function(){

    load_data();

        function load_data(dept_code= '', acct_code='',trans_code='', from_date=''){


          $('#TrptPaymentAdvice').DataTable({

              
              processing: true,
              serverSide: true,
              scrollX: true,
              dom : 'Bfrtip',
              buttons: [
                        'excelHtml5'
                        ],
              
              ajax:{
                url:'{{ url("/trpt-payment-advice") }}',
                data: {dept_code:dept_code,acct_code:acct_code,trans_code:trans_code,from_date:from_date}
              },
              columns: [

               {
                    data:'Transporter',
                    name:'Transporter'
                },
                {
                    data:'truck_no',
                    name:'truck_no'
                },
                {
                    data:'LR_NO',
                    name:'LR_NO'
                },
                
                {
                    data:'TR_DATE',
                    name:'TR_DATE'
                },
                {
                    data:'DEPOT_PLANT',
                    name:'DEPOT_PLANT'
                },
                {
                    data:'DESTINATION',
                    name:'DESTINATION'
                },
                {
                    data:'SHORTAGE_QTY',
                    name:'SHORTAGE_QTY'
                },
                {
                    data:'ITEM_CODE',
                    name:'ITEM_CODE'
                },
                {
                    data:'LR_REC_DATE',
                    name:'LR_REC_DATE'
                },
                {
                    data:'RATE',
                    name:'RATE'
                },
                {
                   "data": null,
                   "render": function(data, type, full, meta){
                      var demo = 1;
                       var basicN = parseInt(full["SHORTAGE_QTY"]) * parseInt(full["RATE"]);

                      return basicN;
                   }
                },
                {
                   "data": null,
                   "render": function(data, type, full, meta){
                      var demo = 1;
                       var basicN = parseInt(full["SHORTAGE_QTY"]) * parseInt(full["RATE"]);

                      return (basicN*7)/100;
                   }
                },
                {
                   "data": null,
                   "render": function(data, type, full, meta){
                      var demo = 1;
                       var basicN = parseInt(full["SHORTAGE_QTY"]) * parseInt(full["RATE"]);

                      return (basicN*2)/100;
                   }
                },
                {
                    data:'TOTAL_ADV',
                    name:'TOTAL_ADV'
                },
                {
                   "data": null,
                   "render": function(data, type, full, meta){
                      var demo = 1;
                      var basicN = parseInt(full["SHORTAGE_QTY"]) * parseInt(full["RATE"]);

                      var service_charges=(basicN*7)/100;

                      var tds=(basicN*2)/100;

                      var net_payment = basicN - parseInt(service_charges) - parseInt(tds) - parseInt(full["TOTAL_ADV"]);

                      return net_payment;
                   }
                },

              ]


          });


       }


       $('#btnsearch').click(function(){



          var from_date =  $('#from_date').val();

          var dept_code =  $('#dept_code').val();

          var acct_code =  $('#acct_code').val();

          var trans_code =  $('#trans_code').val();

          var btnsearch =  $('#btnsearch').val();

          //var trans_code =  $('#trans_code').val();
          //alert(from_date);return false;

          if (dept_code!='' || acct_code!='' || trans_code !='' || from_date!='') {

            $('#show_err_from_date').html('');
            $('#show_err_dept_code').html('');
            $('#show_err_acct_code').html('');
            $('#show_err_trans').html('');

            $('#TrptPaymentAdvice').DataTable().destroy();
            load_data(dept_code,acct_code,trans_code,from_date);

          }else{

             $('#show_err_from_date').html('Please select from date').css('color','red');
             $('#show_err_dept_code').html('Please select depot').css('color','red');
             $('#show_err_acct_code').html('Please select Area code').css('color','red');
             $('#show_err_trans').html('Please select transporter').css('color','red');
          }


        });

       $('#ResetId').click(function(){

              $('#from_date').val('');
              
              $('#dept_code').val('');
              
              $('#acct_code').val('');

              $('#trans_code').val('');

          document.getElementById("show_err_from_date").innerHTML = '';
          document.getElementById("show_err_dept_code").innerHTML = '';
          document.getElementById("show_err_acct_code").innerHTML = '';
          document.getElementById("show_err_trans").innerHTML = '';
          $('#TrptPaymentAdvice').DataTable().destroy();
          load_data();

        });

  });





</script>


<script type="text/javascript">

  

  $(document).ready(function() {


    var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker').datepicker({

      format: 'yyyy-mm-dd',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date
    });
  

});

$(document).ready(function() {
  
  var from_date = $('#from_date_default').val();
    var to_date = $('#to_date_default').val();

    $('.datepicker1').datepicker({

      format: 'yyyy-mm-dd',

      orientation: 'bottom',

      todayHighlight: 'true',
      startDate :from_date,
      endDate : to_date

    });

});
</script>

@endsection