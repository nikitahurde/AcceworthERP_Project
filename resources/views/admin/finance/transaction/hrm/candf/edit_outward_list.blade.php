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

  .showSeletedName {

    font-size: 15px;

    margin-top: 2%;

    text-align: center;

    font-weight: 600;

    color: #4f90b5;

  }
  .vehiclenumup{
    text-transform: uppercase;
  }




</style>

<div class="content-wrapper">

        <!-- Content Header (Page header) -->

        <section class="content-header">

          <h1>

            Outward Transaction

            <small> Outward Transaction Details</small>

          </h1>

          <ol class="breadcrumb">

            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>

            <li><a href="{{ url('/dashboard') }}">Transaction</a></li>

            <li class="active"><a href="{{ url('/edit-form-outward-trans/'.$outward_trans_list->id) }}">Outward Trans</a></li>

            <li class="active"><a href="{{ url('/edit-form-outward-trans/'.$outward_trans_list->id) }}">Edit Outward Trans</a></li>

          </ol>

        </section>

	<section class="content">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border" style="text-align: center;">

              <h2 class="box-title animated bounceInLeft PageTitle" style="font-weight: 800;color: #5696bb;">Update  Outward Trans</h2>

              <div class="box-tools pull-right">

                <a href="{{ url('view-outward-trans') }}" class="btn btn-primary" style="margin-right: 10px;"><i class="fa fa-eye"></i> &nbsp;&nbsp; View  Outward Trans</a>

              </div>



            </div><!-- /.box-header -->

            <div class="box-body">

             <form action="{{ url('update-outward-trans') }}" method="POST" id="InwardTrnas">



               @csrf



              <div class="row">

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Company Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-building-o" aria-hidden="true"></i>

                          </div>

                          <input type="hidden" value="{{ $outward_trans_list->id }}" name="outward_id">

                          <input type="text" class="form-control" id="company_code" name="comp_code" placeholder="Enter Company Name" value="{{strtoupper(Session::get('company_name'))}}" readonly>

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('company_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                  </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Fiscal Year : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="fy_year" name="fy_year" placeholder="Enter fy Year" value="{{strtoupper(Session::get('macc_year'))}}" readonly> 

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('fy_year', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div>

                 <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Transaction Date: <span class="required-field"></span></label>

                      <div class="input-group">

                        <div class="input-group-addon">

                          <i class="fa fa-calendar"></i>

                        </div>

                        <?php 
                        $FromDate = date("d-m-Y", strtotime($fromDate));
                        $ToDate = date("d-m-Y", strtotime($toDate));

                        if($outward_trans_list->tr_date=='0000-00-00'){

                           $TransactDate='00-00-0000';

                        }else{

                           $TransactDate = date("d-m-Y", strtotime($outward_trans_list->tr_date));

                        }

                        

                        ?>

                        <input type="hidden" name="" value="<?php echo $FromDate; ?>" id="FromDateFy">
                        <input type="hidden" name="" value="<?php echo $ToDate; ?>" id="ToDateFy">
                        
                        <input type="text" name="transaction_date" id="transaction_date" class="form-control transdatepicker" value="{{ $TransactDate }}">

                      </div>

                      <small id="showmsgfordate"></small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('transaction_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                  </div>

                </div><!-- /.col -->


              </div>



              <div class="row">


                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Depot Code : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>

                          <input list="depotList"  id="depot_code" name="depot_code" class="form-control  pull-left" value="{{$outward_trans_list->depot_code}}" placeholder="Select Depot Name" oninput="this.value = this.value.toUpperCase()">



                          <datalist id="depotList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($user_list as $key)

                            

                            <option value='<?php echo $key->depot_code?>'   data-xyz ="<?php echo $key->depot_name; ?>" ><?php echo $key->depot_name ; echo " [".$key->depot_code."]" ; ?></option>



                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="depotText"></div>

                     </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('depot_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                     

                  </div>

                </div><!-- /.col -->


                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Account Code : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>

                          

                          <input list="accountList" id="account_code" name="account_code" class="form-control  pull-left" value="{{$outward_trans_list->acc_code}}" placeholder="Select Account Code" oninput="this.value = this.value.toUpperCase()"> 



                          <datalist id="accountList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($acc_list as $key)

                            

                            <option value='<?php echo $key->acc_code?>'   data-xyz ="<?php echo $key->acc_name; ?>" ><?php echo $key->acc_name ; echo " [".$key->acc_code."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="accountText"></div>

                     </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('account_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->


                                <div class="col-md-4">

                  <label for="exampleInputEmail1">Area Code : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input list="areaList" id="area_code" name="area_code" class="form-control  pull-left" placeholder="Select Area Code" value="{{ $outward_trans_list->area_code}}" oninput="this.value = this.value.toUpperCase()">



                          <datalist id="areaList">

                            <option selected="selected" value="">-- Select --</option>

                            @foreach ($area_list as $key)

                            

                            <option value='<?php echo $key->code?>'   data-xyz ="<?php echo $key->name; ?>" ><?php echo $key->name ; echo " [".$key->code."]" ; ?></option>

                            

                            @endforeach

                          </datalist>

                      </div>

                      <small>  

                        <div class="pull-left showSeletedName" id="areaText"></div>

                     </small>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('area_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>


               
              </div><!-- /.row -->



              <div class="row">

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1"> Transaction No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="transaction_no" name="transaction_no" placeholder="Enter Invoice No" value="{{ $outward_trans_list->tr_no }}" readonly="">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('transaction_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                     

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Despatch Type : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>

                          </div>

                          <!-- <input type="text" class="form-control" id="desp_type" name="desp_type" placeholder="Enter Invoice No" value="{{ $outward_trans_list->desp_type }}"> -->



                          <select id="despatch_type" name="despatch_type" class="form-control">

                              <option value="">-- Select --</option>

                              <option value="D" <?php if($outward_trans_list->desp_type=='D') { echo "SELECTED"; } ?>>D</option>

                              <option   value="ST" <?php if($outward_trans_list->desp_type=='ST') { echo "SELECTED"; } ?>>ST</option>

         

                          </select>

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('despatch_type', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                  </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Invoice No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-list-ol" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="invoice_no" name="invoice_no" placeholder="Enter Invoice No" value="{{ $outward_trans_list->inv_no }}" oninput="this.value = this.value.toUpperCase()">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('invoice_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                  </div>

                </div><!-- /.col -->

              </div>



              <div class="row">

                

                <div class="col-md-4">

                  <div class="form-group">

                      <label for="exampleInputEmail1">Item : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-ship" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="item" name="item" placeholder="Enter Item " value="{{ $outward_trans_list->item_code }}" oninput="this.value = this.value.toUpperCase()">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('item', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    

                  </div>

                </div><!-- /.col -->



                <div class="col-md-4">

                  <label for="exampleInputEmail1">Despatch Quantity : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="despatch_qty" name="despatch_qty" placeholder="Enter SO Code" value="{{ $outward_trans_list->desp_qty }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('despatch_qty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>

                <div class="col-md-4">

                  <label for="exampleInputEmail1">Despatch AQuantity : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-calculator" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="despatch_aqty" name="despatch_aqty" placeholder="Enter SO Code" value="{{ $outward_trans_list->desp_aqty }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('desp_aqty', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>


              </div> 


              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Vehicle No : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-car" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control vehiclenumup" name="vehicle_no" id="vehicle_no" placeholder="Enter Vehicle No" value="{{ $outward_trans_list->truck_no }}" oninput="this.value = this.value.toUpperCase()">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('vehicle_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        



                    </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Transport : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-truck" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="transport_code" name="transport_code" placeholder="Enter Inv qty aum" value="{{ $outward_trans_list->trans_code }}" oninput="this.value = this.value.toUpperCase()">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('transport_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        

                    </div>

                </div><!-- /.col -->

                 <div class="col-md-4">

                  <label for="exampleInputEmail1">Challan No : <span class="required-field"></span></label>

                      <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-sort-numeric-asc" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" id="chalan_no" name="chalan_no" placeholder="Enter SO Code" value="{{ $outward_trans_list->chalan_no }}">

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('chalan_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                </div>

              </div>


              <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Driver Name : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-car" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control" name="driver_name" id="driver_name" placeholder="Enter Driver Name" value="{{ $outward_trans_list->driver_name}}">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('driver_name', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        



                    </div>

                </div><!-- /.col -->

                <div class="col-md-4">

                    <div class="form-group">

                        <label for="exampleInputEmail1">Driver Contact Number : <span class="required-field"></span></label>

                        <div class="input-group">

                          <div class="input-group-addon">

                            <i class="fa fa-truck" aria-hidden="true"></i>

                          </div>

                          <input type="text" class="form-control Number" id="driver_number" name="driver_number" placeholder="Enter Driver Contact Number" value="{{ $outward_trans_list->driver_number}}" maxlength="10">

                        </div>

                        <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('driver_number', '<p class="help-block" style="color:red;">:message</p>') !!}

                        </small>

                        

                    </div>

                </div><!-- /.col -->

              </div>




               <div class="box-footer" style="text-align: center;">

               <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;&nbsp;Update</button>

               </div>

             </form>

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



       $("#account_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#accountList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("accountText").innerHTML = msg; 

        });



       $("#depot_code").bind('change', function () {  

          var val = $(this).val();

          var xyz = $('#depotList option').filter(function() {

          return this.value == val;

          }).data('xyz');

          var msg = xyz ?  xyz : 'No Match';

          //alert(msg+xyz);

          document.getElementById("depotText").innerHTML = msg; 

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





   $(document).ready(function() {

    

      $("#item_code").change(function(){



         $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });



        var itemcode =  $(this).val();

        console.log('ItemCdoe => ',itemcode);



                  $('#UnitM').val('');

                  $('#unitAum').val('');

                  $('#cfactor').val('');

                  $('#inv_aum').val('');

                  $('#inv_um').val('');



        $.ajax({



          url:"{{ url('item-um-aum') }}",

           method : "POST",

           type: "JSON",

           data: {itemcode: itemcode},

           success:function(data){

            

                var data1 = JSON.parse(data);



                

                //console.log("Data  ==> ",data1.data);

                



                if (data1.response == 'error') {



                    $('#errorItem').html("<p style='color:red'>"+ data1.message +"</p>");



                }else if(data1.response == 'success'){



                  

                 console.log(data1.data[0]);

                  $('#UnitM').val(data1.data[0].um_code);

                  $('#unitAum').val(data1.data[0].aum);

                  $('#cfactor').val(data1.data[0].aum_factor);



                }



           }



        });



      });



    });





     $(document).ready(function() {

    

       $("#invoice_no").on('input',function(){

         $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

        var desp_type =  $('#despatch_type').val();
        //alert(desp_type);
       // console.log(desp_type);
        var inv_no =  $('#invoice_no').val();
        var comp_code =  $('#company_code').val();
        var fy_year =  $('#fy_year').val();


         var datastring = "inv_no="+inv_no+"&comp_code="+comp_code+"&fy_year="+fy_year+"&desp_type="+desp_type;
       //console.log(datastring);
        if(desp_type == 'ST'){

          //console.log(desp_type);

          $.ajax({

          url:"{{ url('get-by-dpt-type') }}",

           method : "POST",

           type: "JSON",

           data: datastring,

           success:function(data){

                var data1 = JSON.parse(data);

                if(data1.response == 'success'){

                getInvoicNo = data1.data[0].invoice_no;

                  if(getInvoicNo == inv_no){

                    $('#item').val(data1.data[0].item_code);

                    $('#vehicle_no').val(data1.data[0].truck_no);

                    $('#transport_code').val(data1.data[0].trpt_code);

                    $('#despatch_qty').val(data1.data[0].sto_qty);

                    $('#despatch_aqty').val(data1.data[0].sto_aqty);

                }else{

                  $('#item').val('');

                  $('#vehicle_no').val('');

                  $('#transport_code').val('');

                  $('#despatch_qty').val('');

                  $('#despatch_aqty').val('');

                }

              }else{

                  $('#item').val('');

                  $('#vehicle_no').val('');

                  $('#transport_code').val('');

                  $('#despatch_qty').val('');

                  $('#despatch_aqty').val('');

                }

           }


        });


        }


      });





      $('#despatch_type').on('change',function(){

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                       }
                });

              var desp_type =  $('#despatch_type').val();

              var inv_no =  $('#invoice_no').val();

              var comp_code =  $('#company_code').val();

              var fy_year =  $('#fy_year').val();

              var datastring = "inv_no="+inv_no+"&comp_code="+comp_code+"&fy_year="+fy_year;

              if(desp_type == 'ST'){
                $( "#invoice_no" ).prop( "disabled", false );

                    $.ajax({

                      url:"{{ url('get-by-dpt-type') }}",

                       method : "POST",

                       type: "JSON",

                       data: datastring,

                       success:function(data){

                            var data1 = JSON.parse(data);

                            if(data1.response == 'success'){

                              $('#item').val(data1.data[0].item_code);

                              $('#vehicle_no').val(data1.data[0].truck_no);

                              $('#transport_code').val(data1.data[0].trpt_code);

                              $('#despatch_qty').val(data1.data[0].sto_qty);

                              $('#despatch_aqty').val(data1.data[0].sto_aqty);
                           
                            }else{

                              $('#item').val('');

                              $('#vehicle_no').val('');

                              $('#transport_code').val('');

                              $('#despatch_qty').val('');

                              $('#despatch_aqty').val('');

                            }

                       }

                    });

            }else{

                        $('#item').val('');
                        $('#vehicle_no').val('');
                        $('#transport_code').val('');
                        $('#despatch_qty').val('');
                        $('#despatch_aqty').val('');
                        $( "#invoice_no" ).val('');

                        $( "#invoice_no" ).prop( "disabled", true );
            }

         });


    });

</script>



<script type="text/javascript">
$(document).ready(function() {
    $(window).on( "load", function() {
      var fromdateintrans = $('#FromDateFy').val();
      var todateintrans = $('#ToDateFy').val();

      

    $('.transdatepicker').datepicker({

      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      startDate :fromdateintrans,
      endDate : todateintrans,
      autoclose:'true'
    });

     });

    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy',
      orientation: 'bottom',
      todayHighlight: 'true',
      endDate: 'today',
      autoclose:'true'
    });
});

</script>

<script type="text/javascript">
  

    $(document).ready(function(){
      
        $('#transaction_date').change(function(){
            var transDate = $('#transaction_date').val();
            var slipD =  transDate.split('-');
            var transdate = slipD[0];
            var transmonth = slipD[1];
            var transyear = slipD[2];
            var getdate = transmonth+'-'+transdate+'-'+transyear;

            var seldates = new Date(getdate);
            var today = new Date();

            if(seldates > today){

                $('#showmsgfordate').html('Transaction Date Can Not Be Greater Than Today').css('color','red');
                $('#transaction_date').val('');
                return false;
            }else{
                $('#showmsgfordate').html('');
                return true;
            }

        }); 

         $('.Number').keypress(function (event) {
          var keycode = event.which;
          if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
              event.preventDefault();
          }
       });
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